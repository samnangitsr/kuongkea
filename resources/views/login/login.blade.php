<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ config('helper.asset_path') }}/admin/assets/images/dollar.png" type="image/png" />
	<!--plugins-->
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ config('helper.asset_path') }}/admin/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{ config('helper.asset_path') }}/admin/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ config('helper.asset_path') }}/admin/assets/css/bootstrap.min.css" rel="stylesheet">
    {{-- select2 --}}
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
	<link href="{{ config('helper.asset_path') }}/admin/assets/css/app.css" rel="stylesheet">
	<link href="{{ config('helper.asset_path') }}/admin/assets/css/icons.css" rel="stylesheet">
	<title>Login</title>
    <style>
        body.wait, body.wait *{
			cursor: wait !important;
		}
        html, body {
            height: 100%;
            overflow: auto;
        }
        #username1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:35px;background-color:whitesmoke;}
		/* Each result */
		#select2-username1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white}
        /* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:35px;}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
        }

        .three-d-text {
            font-size: 6vh;
            font-weight: bold;
            color: #b0cdee;
            text-shadow:
                1px 1px 0 black,
                2px 2px 0 black,
                3px 3px 0 black,
                4px 4px 0 black,
                5px 5px 0 black;
        }

        .three-d-text1{
            text-shadow:
                1px 1px 0 black,
                2px 2px 0 black,
                3px 3px 0 black,
                4px 4px 0 black,
                5px 5px 0 black;
        }
        .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            }
        #com_logo {
            position: absolute;
            top: 0px;  /* adjust distance above card */
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }
        .card {
            border-radius: 20px; /* adjust size (e.g. 10px, 15px, 20px) */

        }
    </style>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div  class="text-center" style="margin-top:50px;">
                            {{-- <img src="{{ config('helper.asset_path') }}/admin/assets/images/angkorwat1.jpg" style="width:100px;" alt="" /> --}}
                            <p class="three-d-text" style="font-family:khmer os muol light;">{{ config('helper.system_title') }}</p>
                        </div>

                        <div class="card" style="background-color:inherit;">
                            <div class="card-body" style="background-color:dimgray;border-radius:20px;padding:0px;">

								<div class="p-4 rounded">
									<div class="form-body">
										<form class="row g-3"  method="POST" action="{{ route('checklogin') }}" autocomplete="off">
                                            @csrf
                                           {{-- {!! csrf_field() !!} --}}
                                            <div class="col-12">
												<label for="company" class="form-label kh16-b" style="color:white;">ជ្រើសរើសក្រុមហ៊ុន/Select Company {{ $get_internet_ip }}</label>
												 <select name="company" id="company" class="form-select kh16-b" style="">
                                                    @foreach ($companies as $comp)
                                                        <option value="{{ $comp->id }}" {{$comp->id==$comid?'selected':''}}>{{ $comp->name }}</option>
                                                    @endforeach
                                                </select>
											</div>
											<div class="col-12">
                                                <label for="username1" class="form-label kh16-b" style="color:white;">ជ្រើសរើសឈ្មោះ/Select Login Name</label>
                                                <select class="form-select kh16-b @error('username1') is-invalid @enderror" id="username1">
                                                    <option value="">-- Select User --</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->username }}" company_id={{$user->company_id}} attempt="{{ $user->attempt }}" {{ $user->attempt>5?'disabled':'' }}>
                                                            {{ $user->username }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="card" style="background-color:rgb(105, 114, 109);">
                                                <div class="card-body">

                                                    <div class="col-12">
                                                        <label for="username" class="form-label kh16-b" style="color:white;">ឈ្មោះអ្នកប្រើប្រាស់/Login Name</label>
                                                        <input type="text" class="form-control kh16-b" id="username" name="username" placeholder="User Name" value="{{ old('username') }}" required autofocus>
                                                        @error('username')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputChoosePassword" class="form-label kh16-b" style="color:white;">បញ្ជូលលេខសំងាត់/Password</label>
                                                        <div class="input-group" id="show_hide_password">
                                                            <input type="password" class="form-control border-end-0" id="password" name="password" placeholder="Enter Password" autocomplete="off"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputChoosePassword" class="form-label kh16-b" style="color:white;">Enter Outside Remote Password</label>
                                                        <div class="input-group" id="show_hide_password1">
                                                            <input type="password" class="form-control border-end-0" id="password1" name="password1" placeholder="Enter Remote Password" autocomplete="off"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
											{{-- <div class="col-md-6" style="margin-top:-5px;">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
													<label class="form-check-label" for="flexSwitchCheckChecked" style="color:white;">Remember Me</label>
												</div>
											</div>
											<div class="col-md-6 text-end" style="margin-top:-5px;"> <a href="authentication-forgot-password.html" style="color:white;">Forgot Password ?</a>
											</div> --}}
											<div class="col-12" style="margin-top:-5px;">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ config('helper.asset_path') }}/admin/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ config('helper.asset_path') }}/admin/assets/js/jquery.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ config('helper.asset_path') }}/admin/assets/plugins/select2/js/select2.min.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
            $('#username1').select2();
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
            $("#show_hide_password1 a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password1 input').attr("type") == "text") {
					$('#show_hide_password1 input').attr('type', 'password');
					$('#show_hide_password1 i').addClass("bx-hide");
					$('#show_hide_password1 i').removeClass("bx-show");
				} else if ($('#show_hide_password1 input').attr("type") == "password") {
					$('#show_hide_password1 input').attr('type', 'text');
					$('#show_hide_password1 i').removeClass("bx-hide");
					$('#show_hide_password1 i').addClass("bx-show");
				}
			});
            // $(document).on('change','#username1',function(e){
            //     e.preventDefault();
            //     var sp = document.querySelector("#username1");
            //     var comp_id=sp.options[sp.selectedIndex].getAttribute('company_id');
            //     var uname=$('#username1 option:selected').text().trim();
            //     $('#username').val(uname);
            //     $('#password').focus();
            //     if(comp_id>0){
            //         $('#company').val(comp_id);
            //     }
            // })
            // For Select2, better to use its event
            $('#username1').on('select2:select', function (e) {
                var sp = document.querySelector("#username1");
                var comp_id = sp.options[sp.selectedIndex].getAttribute('company_id');
                var uname = $('#username1 option:selected').text().trim();

                $('#username').val(uname);

                // Wait a tick before focusing to avoid losing focus
                setTimeout(function () {
                    $('#password').focus();
                }, 100);

                if (comp_id > 0) {
                    $('#company').val(comp_id);
                }
            });

            $(document).on('change', '#company', function (e) {
                e.preventDefault();
                 $('body').addClass("wait");
                let company_id = $(this).val();
                let url = "{{ route('login.getuserbycompany') }}";

                $('#username1').empty().append(
                    $("<option/>", { value: '', text: '-- Select User --' })
                );

                 $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {company_id: company_id},
                    success: function (data) {
                        //console.log(data)
                        if($.isEmptyObject(data.error)){

                            $.each(data, function (i, user) {
                                $('#username1').append($("<option/>", {
                                    value: user.id, // or user.username
                                    text: user.username,
                                    "company_id": user.company_id, // ✅ use HTML5 attribute
                                    "attempt": user.attempt,
                                    disabled: user.attempt > 5
                                }));
                            });
                            $('body').removeClass("wait");
                        }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                        }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Error.')
                    }
                })

            });


		});
	</script>
	<!--app JS-->
	<script src="{{ config('helper.asset_path') }}/admin/assets/js/app.js"></script>
</body>

</html>
