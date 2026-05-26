<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MoneyCam</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    body { font-family: sans-serif; margin: 0; display:flex; height:100vh; }
    .wrap { margin:auto; display:grid; gap:10px; justify-items:center; }
    #video { border-radius: 10px; }
    #canvas, #overlay { position:absolute; left:0; top:0; }
    .stage { position:relative; width:640px; height:480px; }
    .status { text-align:center; }
  </style>
</head>
<body>
  <div class="wrap">
    <h2>Auto Face Capture</h2>
    <div class="stage">
      <video id="video" width="640" height="480" autoplay muted playsinline></video>
      <canvas id="overlay" width="640" height="480"></canvas>
    </div>
    <div class="status">
      <div>Detection: <span id="det">—</span></div>
      <div>Last sent: <span id="sent">never</span></div>
    </div>
  </div>

  <!-- face-api.js -->
  <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
  @include('includes.facerecognit_script');
  {{-- <script>
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

        //   async function detectLoop() {
        //     const options = new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 });

        //     setInterval(async () => {
        //       if (video.readyState !== 4) return;

        //       // Single detection with descriptor for recognition
        //       const result = await faceapi
        //         .detectSingleFace(video, options)
        //         .withFaceLandmarks()
        //         .withFaceDescriptor();

        //       if (result) {
        //         detEl.textContent = 'Face ✓';
        //         drawDetections([result.detection]);

        //         const now = Date.now();
        //         if (now - lastSent > SEND_EVERY_MS) {
        //           lastSent = now;
        //           await sendCapture(result);
        //           sentEl.textContent = new Date().toLocaleTimeString();
        //         }
        //       } else {
        //         detEl.textContent = 'No face';
        //         ctx.clearRect(0, 0, overlay.width, overlay.height);
        //       }
        //     }, 200); // run detector ~5 fps
        //   }
        async function detectLoop() {// this code can set distance of customer stand far or closed
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
  </script> --}}
</body>
</html>
