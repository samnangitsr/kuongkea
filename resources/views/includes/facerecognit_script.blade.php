<script>
       let pageUrl = window.location.pathname;
         //localStorage.setItem("closeE2", "closed");
        // 1️⃣ Send "page open" when page loads
        fetch("{{ route('track.time') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                url: pageUrl,
                action: "open"
            })
        });




// When user leaves page, send final update

       window.addEventListener("beforeunload", function() {
            try {

                let formData = new FormData();
                formData.append("url", pageUrl);
                formData.append("action", "close");
                navigator.sendBeacon("{{ route('track.time') }}", formData);
                localStorage.setItem("user_url", "/dashboard");
                localStorage.setItem("closeE2", Date.now());

            } catch (e) {
                // ignore errors
            }
        });
        window.addEventListener("storage", function(e) {
            if (e.key === "closeE1") {
                // localStorage.removeItem("closeE1");
                // localStorage.removeItem("closeE2");
                window.close();
            }
        });
        const video   = document.getElementById('video');
        const overlay = document.getElementById('overlay');
        const ctx     = overlay.getContext('2d');
        const detEl   = document.getElementById('det');
        const sentEl  = document.getElementById('sent');

        const MODELS_URL = '/models'; // put models in public/models
        const modelPath = "{{ asset('public/models') }}";
        // Start webcam
        async function startCam() {
            try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' }, audio: false });
            video.srcObject = stream;
            } catch (e) {
            alert('Camera error: ' + e.message);
            }
        }

        // Load models
        async function loadModels() {
            await faceapi.nets.tinyFaceDetector.loadFromUri(modelPath);
            await faceapi.nets.faceLandmark68Net.loadFromUri(modelPath);
            await faceapi.nets.faceRecognitionNet.loadFromUri(modelPath);
        }

        // Helpers
        function drawDetections(detections) {
            ctx.clearRect(0, 0, overlay.width, overlay.height);
            detections.forEach(d => {
            const { x, y, width, height } = d.box;
            ctx.lineWidth = 2;
            ctx.strokeRect(x, y, width, height);
            });
        }

        // Throttle sending
        let lastSent = 0;
        const SEND_EVERY_MS = 3000; // send at most once per 3s when a face is present

          async function detectLoop() {
            const options = new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 });

            setInterval(async () => {
              if (video.readyState !== 4) return;

              // Single detection with descriptor for recognition
              const result = await faceapi
                .detectSingleFace(video, options)
                .withFaceLandmarks()
                .withFaceDescriptor();

              if (result) {
                detEl.textContent = 'Face ✓';
                drawDetections([result.detection]);

                const now = Date.now();
                nls=now-lastSent;
                console.log('Now-LastSend= ' + nls)
                console.log('SEND EVERY MS= ' + SEND_EVERY_MS)
                if (nls > SEND_EVERY_MS) {
                  console.log('sent')
                  lastSent = now;
                  await sendCapture(result);
                  sentEl.textContent = new Date().toLocaleTimeString();
                }
              } else {
                detEl.textContent = 'No face';
                ctx.clearRect(0, 0, overlay.width, overlay.height);
              }
            }, 200); // run detector ~5 fps
          }
        function isFaceCentered(landmarks) {
            const leftEye = landmarks.getLeftEye();
            const rightEye = landmarks.getRightEye();
            const nose = landmarks.getNose();

            const eyeCenterX = (leftEye[0].x + rightEye[3].x) / 2;
            const noseX = nose[3].x; // tip of nose

            const diff = Math.abs(noseX - eyeCenterX);

            // threshold depends on video resolution and your tolerance
            return diff < 30;
        }
        function faceAngleStatus(landmarks) {
            const leftEye = landmarks.getLeftEye();
            const rightEye = landmarks.getRightEye();
            const nose = landmarks.getNose();

            const leftEyeX = (leftEye[0].x + leftEye[3].x) / 2;
            const rightEyeX = (rightEye[0].x + rightEye[3].x) / 2;
            const eyeCenterX = (leftEyeX + rightEyeX) / 2;
            const noseX = nose[3].x;
            const eyeWidth = rightEyeX - leftEyeX;
            const deviation = Math.abs(noseX - eyeCenterX);
            const ratio = deviation / eyeWidth;

            if (ratio < 0.25) return 'front';
            if (ratio < 0.7) return 'side'; // ~±45°
            return 'turned';
        }

        function isFaceFrontal(landmarks) {
            const leftEye = landmarks.getLeftEye();
            const rightEye = landmarks.getRightEye();
            const nose = landmarks.getNose();

            // eye centers
            const leftEyeX = (leftEye[0].x + leftEye[3].x) / 2;
            const rightEyeX = (rightEye[0].x + rightEye[3].x) / 2;
            const eyeCenterX = (leftEyeX + rightEyeX) / 2;

            // nose tip
            const noseX = nose[3].x;

            // width between eyes
            const eyeWidth = rightEyeX - leftEyeX;

            // how far nose deviates from center of eyes
            const deviation = Math.abs(noseX - eyeCenterX);

            // if deviation is more than ~25% of eye distance, probably turned
            return deviation < eyeWidth * 0.25;
        }
        function isFaceFrontal_new(landmarks) {
            const leftEye = landmarks.getLeftEye();
            const rightEye = landmarks.getRightEye();
            const nose = landmarks.getNose();

            // Eye centers
            const leftEyeCenter = {
                x: (leftEye[0].x + leftEye[3].x) / 2,
                y: (leftEye[1].y + leftEye[4].y) / 2
            };
            const rightEyeCenter = {
                x: (rightEye[0].x + rightEye[3].x) / 2,
                y: (rightEye[1].y + rightEye[4].y) / 2
            };

            // Nose tip
            const noseTip = nose[3];

            // Eye distance
            const eyeDist = Math.abs(rightEyeCenter.x - leftEyeCenter.x);

            // Nose deviation from midpoint
            const eyeMidX = (leftEyeCenter.x + rightEyeCenter.x) / 2;
            const noseDeviation = Math.abs(noseTip.x - eyeMidX);

            // Vertical alignment (to catch tilt up/down)
            const eyeHeightDiff = Math.abs(leftEyeCenter.y - rightEyeCenter.y);

            // Thresholds
            const maxDeviation = eyeDist * 0.2;   // nose must be within 20% of center
            const maxEyeTilt   = eyeDist * 0.1;   // eyes must be mostly level

            return (noseDeviation < maxDeviation) && (eyeHeightDiff < maxEyeTilt);
        }

        async function detectLoop_new() {
            const options = new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 });

            setInterval(async () => {
                if (video.readyState !== 4) return;

                const result = await faceapi
                    .detectSingleFace(video, options)
                    .withFaceLandmarks()
                    .withFaceDescriptor();

                if (result) {
                    detEl.textContent = 'Face ✓';
                    drawDetections([result.detection]);

                    const box = result.detection.box;
                    const faceWidth = box.width;

                    const MIN_FACE_SIZE = 120;
                    const MAX_FACE_SIZE = 1080;//default 280


                    // ✅ check if face is centered
                    const centered = isFaceCentered(result.landmarks);

                    if (faceWidth > MIN_FACE_SIZE && faceWidth < MAX_FACE_SIZE && isFaceFrontal(result.landmarks)) {
                        detEl.textContent = 'Face ✓ (good distance & centered)';
                        const now = Date.now();
                        if (now - lastSent > SEND_EVERY_MS) {
                            lastSent = now;
                            await sendCapture(result);
                            sentEl.textContent = new Date().toLocaleTimeString();
                        }
                    } else if (!isFaceFrontal(result.landmarks)) {
                        detEl.textContent = 'Turn face to the front';
                    } else if (faceWidth <= MIN_FACE_SIZE) {
                        detEl.textContent = 'Too far, move closer';
                    } else {
                        detEl.textContent = 'Too close, move back';
                    }
                } else {
                    detEl.textContent = 'No face';
                    ctx.clearRect(0, 0, overlay.width, overlay.height);
                }
            }, 200);
        }

        async function detectLoop_old() {// this code can set distance of customer stand far or closed
            const options = new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 });

            setInterval(async () => {
            if (video.readyState !== 4) return;

            // Single detection with descriptor for recognition
            const result = await faceapi
                .detectSingleFace(video, options)
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (result) {
                detEl.textContent = 'Face ✓';
                drawDetections([result.detection]);

                const box = result.detection.box;
                const faceWidth = box.width;
                const faceHeight = box.height;

                // ---- distance check ----
                // adjust these values depending on your camera & preference
                const MIN_FACE_SIZE = 120; // too far if smaller
                const MAX_FACE_SIZE = 280; // too close if larger

                if (faceWidth > MIN_FACE_SIZE && faceWidth < MAX_FACE_SIZE) {
                    detEl.textContent = 'Face ✓ (good distance)';

                    const now = Date.now();
                    if (now - lastSent > SEND_EVERY_MS) {
                    lastSent = now;
                    await sendCapture(result);
                    sentEl.textContent = new Date().toLocaleTimeString();
                    }
                    } else if (faceWidth <= MIN_FACE_SIZE) {
                        detEl.textContent = 'Too far, move closer';
                    } else {
                        detEl.textContent = 'Too close, move back';
                    }
                } else {
                    detEl.textContent = 'No face';
                    ctx.clearRect(0, 0, overlay.width, overlay.height);
                }
            }, 200); // run detector ~5 fps
        }
        function grabFrameDataURL() {
            // Create temp canvas to snapshot video frame
            const c = document.createElement('canvas');
            c.width = video.videoWidth || 640;
            c.height = video.videoHeight || 480;
            const cctx = c.getContext('2d');
            cctx.drawImage(video, 0, 0, c.width, c.height);
            return c.toDataURL('image/png'); // data:image/png;base64,...
        }

        async function sendCapture(result) {

            const frame = grabFrameDataURL();
            const descriptor = Array.from(result.descriptor); // Float32Array -> plain array

            await fetch("{{ route('customer.capture') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                image: frame,
                descriptor: descriptor
            })
            })
            .then(r => r.json())
            .then(j => console.log('Saved:', j))
            .catch(err => console.error('Upload error:', err));
        }

        (async function init() {
            await startCam();
            await loadModels();
            detectLoop();
        })();
  </script>
