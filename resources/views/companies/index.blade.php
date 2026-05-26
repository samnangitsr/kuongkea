@extends('master')
@section('title') CompaySetup @endsection
@section('css')
    <style type="text/css">
          body.wait *{
            cursor: wait !important;
        }
         #tblcmp td,th {
                white-space: normal;
                word-wrap: break-word;   /* For older browsers */
                word-break: break-word;  /* For modern browsers */
            }
         .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
        .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
            .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;

            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
            padding:10px 0px 10px 0px;
        }


        .student-photo{
			height:300px;
			padding-left:1px;
			padding-right:1px;
			border:1px solid #ccc;
			background:#eee;
			width:100px;
			margin:0 auto;

		}
		.photo > input[type='file']{
			display:none;
		}
		.photo{
			width:30px;
			height:30px;
			border-radius:100%;
		}
		.student-id{

			background-repeat:repeat-x;
			border-color:#ccc;
			padding:1px;
			text-align:center;
			background:#eee;
			border-bottom:1px solid #ccc;
		}
		.btn-browse{
			border-color:#ccc;
			padding:1px;
			text-align:center;
			background:#eee;
			border:none;
			border-top:1px solid #ccc;
			height:50px;
		}
        #tblcmp .clickedrow td{
            background-color: #caaf8f;
        }
    </style>
@endsection
@php
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        $dc=strlen((float)$fp)-2;

        }
        return number_format($num,$dc,'.',',');
    }
@endphp
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="" method="post" id="frmcompany" enctype="multipart/form-data" autocomplete="off">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header" style="text-align:center;">
                        <h3 class="kh22-b">ចុះឈ្មោះយីហោ</h3>

                        <input type="hidden" name="comid" id="comid">
                        <input type="hidden" name="old_image" id="old_image">
                         <input type="hidden" name="old_imageqr" id="old_imageqr">
                    </div>
                    <div class="card-body">
                       <div class="row">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="name">Company Name</label>
                                    <textarea class="form-control kh22" name="companyname" id="companyname" cols="30" rows="1"></textarea>
                                    <label for="name">Company Name1</label>
                                    <textarea class="form-control kh22" name="companyname1" id="companyname1" cols="30" rows="1"></textarea>

                                    <label for="title">Sub Title</label>
                                    <textarea class="form-control kh22" name="subname" id="subname" cols="30" rows="1"></textarea>

                                    <label for="tel">Tel</label>
                                    <textarea class="form-control kh22" name="tel" id="tel" cols="30" rows="2"></textarea>
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control kh22" name="email" id="email">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control kh22" name="website" id="website">
                                    <label for="public_ip">Internet IP (Ex:203.205.207.54/123.335.125.88/192.168.1.1)</label>
                                    <input type="text" class="form-control kh22" name="public_ip" id="public_ip">

                                    <label for="address">Address</label>
                                    <textarea class="form-control kh22" style="" name="address" id="address" cols="30" rows="3"></textarea>
                                    <label for="note_text">Note</label>
                                    <textarea class="form-control kh22" style="" name="note_text" id="note_text" cols="30" rows="5"></textarea>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="name">Owner Name</label>
                                            <input type="text" class="form-control kh16-b" name="ownername" id="ownername">

                                        </div>
                                        <div class="col-lg-3">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="age">Age</label>
                                                    <input type="text" class="form-control kh16-b" name="age" id="age">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="sex">Sex</label>
                                                    <select class="form-select kh16-b" name="sex" id="sex">
                                                        <option value="1">ប្រុស</option>
                                                        <option value="0">ស្រី</option>
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-lg-3">
                                            <label for="nation">Nation</label>
                                            <select name="nation" id="nation" class="form-select kh16-b">
                                                <option value="khr">ខ្មែរ</option>
                                                <option value="thb">ថៃ</option>
                                                <option value="vnd">វៀតណាម</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="idcard">Identity</label>
                                            <input type="text" class="form-control kh16-b" name="idcard" id="idcard">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="owneraddress">Owner Address</label>
                                            <input type="text" class="form-control kh16-b" name="owneraddress" id="owneraddress">
                                        </div>
                                    </div>



                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group form-group-login">
                                    <table style="margin:0 auto;">
                                      <thead>
                                        <tr>
                                          <th style="text-align:center;">Logo</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td class="photo">
                                            {{-- {!! Html::image('logo/nologo.jpg',null,['class'=>'student-photo','id'=>'showPhoto']) !!} --}}
                                            <img src="{{ config('helper.asset_path') }}/logo/angkor.png" alt="" class="student-photo" id="showPhoto" style="width:256px;height:256px;">
                                            <input type="file" name="image" id="image" accept="image/x-png,image/png,image/jpg,image/jpeg,image/webp">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="text-align:center;background:#ddd;">
                                            <button type="button" name="browse_file" id="browse_file" class="btn btn-info btn-browse en" value="Browse Logo" style="width:100%;color:blue;">Browse Logo</button>
                                          </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="kh22" id="subtext" name="subtext" placeholder="Logo Sub Title" style="width:100%;">
                                            </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                </div>
                                <div class="form-group form-group-login">
                                    <table style="margin:0 auto;">
                                      <thead>
                                        <tr>
                                          <th style="text-align:center;">QRCODE</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td class="photo">

                                            <img src="{{ config('helper.asset_path') }}/logo/angkor.png" alt="" class="student-photo" id="showPhotoqr" style="width:256px;height:256px;">
                                            <input type="file" name="imageqr" id="imageqr" accept="image/x-png,image/png,image/jpg,image/jpeg,image/webp">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="text-align:center;background:#ddd;">
                                            <button type="button" name="browse_fileqr" id="browse_fileqr" class="btn btn-info btn-browseqr en" value="Browse QRCODE" style="width:100%;color:blue;">Browse QR</button>
                                          </td>
                                        </tr>

                                      </tbody>
                                    </table>
                                </div>

                            </div>

                       </div>
                    </div>
                    <div class="card-footer">
                        <table>
                            <tr>
                                <td>
                                    <button type="submit" class="btn btn-primary" id="btnsave">Save</button>
                                </td>
                                <td style="padding-left:10px;">
                                    <button class="btn btn-info" id="btnnew" style="font-weight:bold;color:black;">New</button>
                                </td>
                                <td style="border-style:none;padding-left:25px;">
                                    <div class="form-check">
                                        <input class="form-check-input radtable" style="font-size:16px;" type="radio" name="radtable" id="rad_company" value="1" checked>
                                        <label class="form-check-label kh16-b" style="margin-top:-10px;" for="rad_company">Company List</label>
                                    </div>
                                </td>
                                <td style="border-style:none;padding-left:25px;">
                                    <div class="form-check">
                                        <input class="form-check-input radtable" style="font-size:16px;" type="radio" name="radtable" id="rad_delete" value="0" >
                                        <label class="form-check-label kh16-b" style="margin-top:-10px;color:red;" for="rad_delete">Deleted List</label>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </form>

        </div>


    </div>
    <div class="row" style="margin-bottom:60px;">
        <div class="table-responsive">
			<table id="tblcmp" class="table table-bordered table-hover kh16-b" style="table-layout:fixed;">
				<thead class="kh16" style="text-align:center;">
					<tr style="background-color:#fff;">
                        <th style="width:100px;">Action</th>
						<th style="width:70px;">No</th>
						<th style="width:70px;">ID</th>
						<th style="width:300px;">Company Name</th>
                        <th style="width:300px;">Company Name1</th>

						<th style="width:250px;">Email</th>
						<th style="width:250px;">Website</th>
						<th style="width:300px;">Address</th>
						<th style="width:150px;">Logo</th>
						<th style="width:150px;">QRCODE</th>
                        <th style="width:400px;">Note</th>
					</tr>
				</thead>
				<tbody id="tbl_company">
					@foreach ($companies as $key => $com)
						<tr>
                            <td>
								<a href="#" class="btn btn-warning row-edit" style="width:80px;" data-id="{{ $com->id }}">Edit</a> <br>
								<a href="#" class="btn btn-danger row-delete" style="width:80px;" data-id="{{ $com->id }}" data-status="{{ $com->status }}" data-logo="{{ $com->logo }}">Delete</a>
							</td>
							<td style="text-align:center;">{{ ++$key }}</td>
							<td style="text-align:center;">{{ $com->id }}</td>
							<td>{{ $com->name }} <br> {{ $com->subname }} <br> {{ $com->tel }}</td>
                            <td>{{ $com->name1 }}</td>

							<td>{{ $com->email }}</td>
							<td>{{ $com->website }} <br> {!! str_replace('/', '<br>', $com->public_ip) !!}</td>
							<td>{{ $com->address }}</td>
							<td><img src="{{ $com->logo != '' ?  config('helper.asset_path').'/logo/'. $com->logo:'' }}" alt="" style="width:128px;height:128px;"></td>
							<td><img src="{{ $com->qrlogo != '' ?  config('helper.asset_path').'/logo/'. $com->qrlogo:'' }}" alt="" style="width:128px;height:128px;"></td>
                            <td>{{ $com->note_text }}</td>
                        </tr>
					@endforeach
				</tbody>
			</table>
		</div>
    </div>
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function(){

			$('#frmcompany').on('submit',function(e){
				e.preventDefault();

				if($('#comid').val()==''){
					var urlset="{{ route('company.store') }}"
				}else{
					var urlset="{{ route('company.update') }}"
				}
				var data= new FormData(this);
				$.ajax({
						type:"POST",
						url:urlset,
						data:data,
						datatype:"JSON",
						contentType:false,
						cache:false,
						processData:false,
						success:function(data){
							console.log(data)

							if($.isEmptyObject(data.error)){
								readdata();
								$('#frmcompany').trigger('reset');
								$('#companyname').focus();
								$('#btnsave').text('Save');
                                $('#showPhoto').attr('src','{{ config('helper.asset_path') }}/logo/logo.jpg');
                                $('#showPhotoqr').attr('src','{{ config('helper.asset_path') }}/logo/logo.jpg');
								document.body.scrollTop = scrolledit; // For Safari
  							    document.documentElement.scrollTop = scrolledit; // For Chrome, Firefox, IE and Opera
                                alert(data.message)
							}else{
								alert(data.error)
							}
						}
					});
				})
			var iscroll=0;
			window.addEventListener("scroll", function (event) {
			     iscroll = this.scrollY;
			    console.log(iscroll)
			});
            $(document).on('click','#tblcmp td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
             $(document).on('change','.radtable',function(e){
                e.preventDefault();
                var status = $(this).val();
                readdata();
            })

              function readdata()
            {
                $('body').addClass("wait");
                var status=$('input[name="radtable"]:checked').val();
                var url="{{ route('company.readdata') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {status:status},
                    success: function (data) {
                        //console.log(data)
                        if($.isEmptyObject(data.error)){
                            $('#tbl_company').empty().html(data);
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


            }
			$(document).on('click','#btnnew',function(e){
				e.preventDefault();
				location.reload();
			})
			$('.btn-browse').on('click',function(){
				$('#image').click();
			})
			$('#image').on('change',function(e){
				showFile(this,'#showPhoto');
			})
            $('.btn-browseqr').on('click',function(){
				$('#imageqr').click();
			})
			$('#imageqr').on('change',function(e){
				showFile(this,'#showPhotoqr');
			})
			function showFile(fileInput,img,showName){
				if(fileInput.files[0]){
					var reader=new FileReader();
					reader.onload=function(e){
						$(img).attr('src',e.target.result);
					}
					reader.readAsDataURL(fileInput.files[0]);
				}
				$(showName).text(fileInput.files[0].name);
			}

			function showFile1(fileInput,img,showName){
				if(fileInput.files[0]){
					var reader=new FileReader();
					reader.onload=function(e){
						$(img).attr('src',e.target.result);
					}
					reader.readAsDataURL(fileInput.files[0]);
				}
				$(showName).text(fileInput.files[0].name);
			}
			var scrolledit=0;
			$(document).on('click','.row-edit',function(e){
				e.preventDefault();
				var id=$(this).data('id');
				$('#comid').val(id);
				$('#btnsave').text('Update');
				scrolledit=iscroll;
				///var domain = $(location).attr('hostname');
				var domain=window.location.hostname;
				var protocol=window.location.protocol;
				var pathname=window.location.pathname.split('/')[1];

				var url="{{ route('company.getinfobyid') }}";
				$.get(url,{id:id},function(data){
					$('#companyname').val(data.name);
                    $('#companyname1').val(data.name1);
					$('#subname').val(data.subname);
					$('#tel').val(data.tel);
					$('#email').val(data.email);
					$('#website').val(data.website);
                    $('#public_ip').val(data.public_ip);
					$('#address').val(data.address);
					$('#old_image').val(data.logo);
                    $('#old_imageqr').val(data.qrlogo);
                    $('#subtext').val(data.subtext);
                    $('#ownername').val(data.bossname);
                    $('#sex').val(data.sex);
                    $('#age').val(data.age);
                    $('#nation').val(data.nation);
                    $('#idcard').val(data.idcard);
                    $('#note_text').val(data.note_text);
                    $('#owneraddress').val(data.boss_address);

					if(data.logo!=''){
                        $('#showPhoto').attr('src','{{ config('helper.asset_path') }}/logo/' + data.logo);
					}else{
                        $('#showPhoto').attr('src','{{ config('helper.asset_path') }}/logo/logo.jpg');
					}
                    if(data.qrlogo!=''){
                        $('#showPhotoqr').attr('src','{{ config('helper.asset_path') }}/logo/' + data.qrlogo);
					}else{
                        $('#showPhotoqr').attr('src','{{ config('helper.asset_path') }}/logo/logo.jpg');
					}

				})
				document.body.scrollTop = 0; // For Safari
  				document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
			})

			$(document).on('click','.row-delete',function(e){
				e.preventDefault();
                var status=$(this).data('status');
                if(status==0){
                    var c=confirm("Do you want to remove this item from bin?");
                }else{
                    var c=confirm("Do you want to delete this item?");
                }
				if(c==true){
					var url="{{ route('company.destroy') }}";
					var id=$(this).data('id');
					var logo=$(this).data('logo');
					$.post(url,{id:id,logo:logo,restore:0},function(data){
						readdata();
					})
				}
			})

            $(document).on('click','.row-restore',function(e){
				e.preventDefault();
				var c=confirm("Do you want to restore this item?");
				if(c==true){
					var url="{{ route('company.destroy') }}";
					var id=$(this).data('id');
					var logo=$(this).data('logo');
					$.post(url,{id:id,logo:logo,restore:1},function(data){
						readdata();
					})
				}
			})



	})

	</script>
@endsection
