@extends('master')
@section('title') Cashdraw @endsection
@section('css')
    <style type="text/css">
      body.wait, body.wait *{
			cursor: wait !important;
		}
    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

    #selpartner_continue + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:whitesmoke;}
		/* Each result */
		#select2-selpartner_continue-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
    #selpartner_continue_2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:whitesmoke;}
		/* Each result */
		#select2-selpartner_continue_2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

    #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:white}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
    .bankid + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
      /* Search field */
      .select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
            background-color:aquamarine;
        }
        .select2-selection__arrow {
            height: 34px !important;
        }
        .kh12{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            }
            .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            }
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
            .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
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
        .kh30-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }
       .txtexchangefix{
        padding:2px;
        font-weight:bold;
        font-size:16px;
        text-align:right;
       }
       .cgr{
        background-color:aquamarine;
       }
    .tableFixHead{ overflow: auto;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    .tbl_usertransaction td{
      word-wrap: break-word;
      padding:2px 5px 2px 5px;
    }
    #tblsearchmore td{
        border-style:none;
    }

    .ui-autocomplete {
        position: fixed;
        z-index: 1511;
        font-size:22px;
    }
    .ui-autocomplete-input{
      border: none;
      margin-bottom: 5px;
      border:1px solid #c8c6c6 !important;
      z-index:1511;
    }
    .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }

       input.blue{
        color:blue;
       }
       input.red{
        color:red;
       }
      #tbl_amount td{
        padding:2px;
        border-style:none;
       }
       #tbl_partner td{
        padding:2px;
        border-style:none;
       }
       #tbl_exchange td{
        padding:2px;
        border-style:none;
       }
       #tbl_continue_partner td{
        padding:2px;
        border-style:none;
       }
       #tbl_child td{
        border-style:none;
       }
       #tblchildren .clickedrow td{
        background-color: #caaf8f;
       }
       #tbl_cashdraw .clickedrow td{
        background-color: #78f5cf;
       }
       #tbl_notyetcashdraw .clickedrow td{
        background-color: #a9f387;
       }
       #tbl_bankcashdraw .clickedrow td{
        background-color: #caaf8f;
       }
       #tblclearclick .clickedrow td{
        background-color: #caaf8f;
       }
       #divfooter{
        /* margin-right:50px; */
        color:white;
        padding:5px;
        position: fixed;
        bottom: 0;
        width: 100%;
        min-height: 50px;
        max-height: 50px;
        /* background-color: inherit; */
        background-color:rgb(201, 214, 218);
        color: white;
        height : 50px;
        overflow:auto;
        clear: both;
        }
        #tbl_notyetcashdraw th{
            padding:5px;
        }
        #tbl_notyetcashdraw td{
            padding:5px;
        }
        #tbl_cashdraw th{
            padding:5px;
        }
        #tbl_cashdraw td{
            padding:5px;
        }
        .mybtn:hover{
            background-color:aqua;
        }
        .mybtn{
            border:1px solid gray;
            padding:0px 5px;
        }
        .mybtn1:hover{
            background-color:aqua;
        }
        .mybtn1{
            border:1px solid gray;
            padding:5px 10px;

        }
        .img-container {
            position: relative;
            display: inline-block;
            width: fit-content;
        }

        .img-container img {
            display: block;
            max-width: 100%;
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border: none;
            padding: 4px 8px;
            cursor: pointer;
            font-size: 12px;
            border-radius: 4px;
        }
        .seebig-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgb(248, 211, 21);
            color: white;
            border: none;
            padding: 4px 8px;
            cursor: pointer;
            font-size: 12px;
            border-radius: 4px;
        }

        .zoom-container {
            position: relative;
            overflow: hidden;
            width: 100vw;
            height: 100vh;
        }

        #zoomImage {
            position: absolute;
            top: 0;
            left: 0;
            cursor: grab;
            transition: transform 0.2s ease;
        }

        #zoomIcon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 48px;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 10px;
            display: none;
            pointer-events: none;
            z-index: 10;
        }

       .student-photo{
			height:250px;
			padding-left:1px;
			padding-right:1px;
			border:1px solid #ccc;
			background:#eee;
			width:320px;
			margin:0 auto;

		}
       .photo > input[type='file']{
			/* display:none; */
		}
		.photo{
			width:30px;
			height:30px;
			border-radius:100%;
		}

        /*css for webcam*/
    #video {
        border: 1px solid black;
        width: 300px;
        height: 300px;
    }
    #canvas {
        display: none;
    }
    .camera {
        width: 300px;
        display: inline-block;
    }

    .output {
        width: 300px;
        display: inline-block;
    }
    .contentarea {
        font-size: 16px;
        font-family: Arial;
        text-align: center;
    }
    #startbutton {
        display: block;
        position: relative;
        margin-left: auto;
        margin-right: auto;
        bottom: 36px;
        padding: 5px;
        background-color: #6a67ce;
        border: 1px solid rgba(255, 255, 255, 0.7);
        font-size: 14px;
        color: rgba(255, 255, 255, 1.0);
        cursor: pointer;
    }
    </style>
@endsection
@section('content')
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
    <div class="row" style="margin-top:-20px;">
        <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
        <div class="table-responsive">
            <table class="table">
                <tr class="kh16">
                    <th style="border-style:none;">គិតពី</th>
                    <th style="border-style:none;">ដល់</th>
                    <th style="border-style:none;" class ="colselcustomer">ជ្រើសរើសដៃគូ</th>
                    {{-- <th style="border-style:none;">បុគ្គលិក</th> --}}

                </tr>
                <tr>

                    <td style="padding:0px;border-style:none;width:180px;">
                        <div class="input-group" style="width:180px;">
                            <input type="text" name="d1" id="d1" class="form-control" style="width:120px;background-color:silver;font-size:16px;height:35px;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                    </td>
                    <td style="padding:0px;border-style:none;width:180px;">
                        <div class="input-group" style="width:180px;">
                            <input type="text" name="d2" id="d2" class="form-control" style="width:120px;background-color:silver;font-size:16px;height:35px;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td style="padding:0px;border-style:none;width:310px;" class ="colselcustomer">
                        <select name="selcustomer" id="selcustomer" style="width:300px;margin-top:-60px;" class="form-select select2-option kh16" required>
                            {{-- <option value="">ទាំងអស់</option>
                            @foreach ($customers->whereIn('customertype',['BANK','PARTNER']) as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach --}}
                            <option value=""></option>
                            @foreach ($partners as $p)
                                  <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                              @endforeach
                            @if(Auth::user()->role->name=='Admin')
                              @foreach ($customers as $c)
                                  <option value="{{ $c->id }}" customertype="{{ $p->customertype }}">{{ $c->name }}</option>
                              @endforeach
                            @endif
                        </select>
                    </td>
                    {{-- <td style="border-style:none;padding:0px;width:260px;">
                        <select class="form-select kh22" name="seluser" id="seluser" style="width:250px;">
                            <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td> --}}
                <td style="padding:0px;border-style:none;">
                    <button class="mybtn1 kh12-b" id="btnsearch" title="8.1.1">Search</button>
                    @if(Auth::user()->role->name=='Admin')
                        <button class="mybtn1 kh12-b" id="btnclearclick" title="" style="">Clear User Action</button>
                    @endif
                    <button class="mybtn1 kh12-b" id="btnsearchmore" style="float:right;" data-bs-toggle="collapse" data-bs-target="#searchmore">...</button>
                </td>
                </tr>

            </table>
        </div>
    </div>
    <div id="searchmore" class="collapse show">
        <div class="row">
            <div class="col-lg-3">
                <label class="kh16" for="searchby">ស្វែងរកតាម</label>
                <select name="selsearchby" id="selsearchby" class="form-select kh16" style="height:40px;width:100%;">
                    <option value="tel" code="813">លេខទូរស័ព្ទ</option>
                    <option value="amt" code="814">ចំនួនទឹកប្រាក់</option>
                </select>
            </div>
            <div class="col-lg-3" id="col2">
                <label class="kh16" for="stel">លេខទូរស័ព្ទ</label>
                {{-- <input type="text" id="numtelsearch" value="{{ App\User::permissiongetamt(Auth::id(),'4.3.2') }}"> --}}
                {{-- <input type="text" id="txtsearchbytel" class="form-control kh16" style="width:100%;height:40px;" title="{{ App\User::permissiongetamt(Auth::id(),'8.1.3') }}"> --}}
                <input type="text" id="txtsearchbytel" class="form-control kh16" style="width:100%;height:40px;" title="">

            </div>
            <div class="col-lg-3" id="col3" style="display:none;">
                <label class="kh16" for="samt1">ពីចំនួន</label>
                {{-- <input type="text" id="txtsearchbyamt1" class="form-control kh16" style="width:100%;height:40px;" title="{{ App\User::permissiongetamt(Auth::id(),'8.1.4') }}"> --}}
                <input type="text" id="txtsearchbyamt1" class="form-control kh16" style="width:100%;height:40px;" title="">

            </div>
            <div class="col-lg-3" id="col4" style="display:none;">
                <label class="kh16" for="samt2">ដល់ចំនួន</label>
                <input type="text" id="txtsearchbyamt2" class="form-control kh16" style="width:100%;height:40px;">
            </div>
            <div class="col-lg-3">
               <button id="btnsearch2" class="mybtn1 kh12-b" style="margin-top:28px;" title="no item search">Search</button>
               <button class="mybtn1 kh12-b" style="margin-top:28px;" id="btnopenmulticashdraw">Open Multi Cashdraw</button>
            </div>
        </div>
    </div>
    <div class="tableFixHead" id="cashdrawandnotyet" style="padding:0px;margin:10px 0px;">

    </div>
    @include('moneytransfers.cashdrawmodal')
    @include('moneytransfers.continuemodal')
    @include('moneytransfers.searchchildmodal')
    @include('moneytransfers.clearuseractionmodal')
    @include('thaicashdraws.seephoto_modal')
@endsection
@section('script')
<script src="{{ config('helper.asset_path') }}/js/video1.js"></script>
    @include('moneytransfers.searchchildscript')
    @include('moneytransfers.exchangescript')

    <script type="text/javascript">
        $('#h1_title').text('បើកវេរលុយក្នុងស្រុក');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-330;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-330;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
      });
      function formatOption(option) {
          if (!option.id) {
            return option.text;
          }
          // Use a <div> to display the main text and a second line
          // option.element.value is get value from select
          var $option = $(
            '<div class="select2-option">' +
              '<div class="select2-option-main">' + option.text + '</div>' +
              '<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('customertype') : option.element.getAttribute('customertype')) + '</div>' +
            '</div>'
          );
          return $option;
        }
        function formatOption1(option) {
				if (!option.id) {
					return option.text;
				}
				// Use a <div> to display the main text and a second line
         // option.element.value is get value from select

				var $option = $(
					'<div class="select2-option1">' +
						'<div class="select2-option-main">' + option.text + '</div>' +
						'<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('customertype') : option.element.getAttribute('customertype')) + '</div>' +
					'</div>'
				);
				return $option;
			}

    $(document).on('click','#browse_file2',function(e){
        e.preventDefault();
        $('#clickcapture2').val(0);
        $('#image2').val('');
        $('#image2').click();
    })

    $('#image2').on('change',function(e){
        showFile4(this,'#showPhoto');
    })
    function showFile4(fileInput,img,showName){
        if(fileInput.files[0]){
            var reader=new FileReader();
            reader.onload=function(e){
                $(img).attr('src',e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
        $(showName).text(fileInput.files[0].name);
    }

    function showFile2(fileInput,img,showName){
        if(fileInput.files[0]){
            var reader=new FileReader();
            reader.onload=function(e){
                $(img).attr('src',e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
        $(showName).text(fileInput.files[0].name);
    }

        $(document).on('click', '.remove-btn', function(e) {
            e.preventDefault();
            $(this).closest('th').remove();
        });
        $(document).on('click', '#btnaddimgtolist', function (e) {
            e.preventDefault();
            if ($('#clickcapture2').val() == 0) {
                const file = $('#image2')[0].files[0];
                if (!file) {
                    alert("Please choose an image first.");
                    return;
                }
                const reader = new FileReader();
                reader.onload = function (e) {
                    const photopath = e.target.result; // base64 image data
                    const thimg = `
                        <th>
                            <div class="img-container">
                                <img src="${photopath}" alt="" title="${file.name}">
                                <a href="#" class="mybtn remove-btn">remove</a>
                                <input type="hidden" name="imgphotopath[]" value="${photopath}" readonly>
                            </div>
                        </th>
                    `;

                    $('#thead_img').append(thimg);
                };
                reader.readAsDataURL(file); // read image as data URL
            } else {
                const photopath = $('#photopath').val();
                const thimg = `
                    <th>
                        <div class="img-container">
                            <img src="${photopath}" alt="" title="${photopath}">
                            <a href="#" class="mybtn remove-btn">remove</a>
                            <input type="hidden" name="imgphotopath[]" value="${photopath}" readonly>
                        </div>
                    </th>
                `;
                $('#thead_img').append(thimg);
            }
        });
        $(document).on('click', '.btnseephoto', function (e) {
            e.preventDefault();
            $('body').addClass("wait");

            var id = $(this).data('cashdraw_id');
            $('#seephoto_modal').modal('show');

            var url = "{{ route('thaicashdraw.seephoto') }}";

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: { id: id,type:'kh' },
                success: function (data) {
                    console.log(data);
                    if ($.isEmptyObject(data.error)) {
                        var item = data['cashdraw_photoes'];
                        var thimg = '';

                        // Clear existing content
                        $('#thead_img1').empty();
                        $('#zoomImage').attr('src','');
                        for (let i = 0; i < item.length; i++) {
                            thimg += `
                                <th>
                                    <div class="img-container">
                                        <img src="{{ config('helper.asset_path')}}/myimages/${item[i].imgpath}" alt="">
                                         <a href="" data-imgpath="${item[i].imgpath}" class="mybtn seebig-btn">View 100%</a>
                                    </div>
                                </th>
                            `;
                        }

                        $('#thead_img1').append(thimg);
                        $('body').removeClass("wait");
                    } else {
                        $('body').removeClass("wait");
                        alert(data.error);
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Error.');
                }
            });
        });
        $(document).on('click', '.seebig-btn', function (e) {
            e.preventDefault();
            const imgpath = $(this).data('imgpath');
            const fullSrc = "{{ config('helper.asset_path') }}/myimages/" + imgpath;

            // Reset zoom and position
            scale = 1;
            pos = { x: 0, y: 0 };

            // Set src first
            $('#zoomImage').attr('src', fullSrc);

            // Wait for image to load so we can get its dimensions
            $('#zoomImage').on('load', function () {
                const img = $(this);
                const container = $('.zoom-container');

                const containerWidth = container.width();
                const containerHeight = container.height();
                const imgWidth = img[0].naturalWidth;
                const imgHeight = img[0].naturalHeight;

                // Scale image down if it's bigger than container
                const scaleFit = Math.min(containerWidth / imgWidth, containerHeight / imgHeight, 1);
                scale = scaleFit;

                // Calculate centered position
                const x = (containerWidth - imgWidth * scale) / 2;
                const y =(containerHeight - imgHeight * scale) / 2;
                pos = { x, y };

                // Apply transform
                img.css('transform', `translate(${x}px, ${y}px) scale(${scale})`);
                $('#zoomIcon').hide();
            });
        });


        $(document).on('keyup', '#txtbuy', function (e) {
            //debugger
            //alert(e.key)
            if(isNumber(e.key)){
                calcuexchange();
                return;
            }
            //alert('not a number')
            const C = e.key;
            if (C === "Backspace") {
                calcuexchange();
                return;
            }else if(C==="+"){
                e.preventDefault();
                $('#txtbuy').css('color','blue');
                $('#txtsale').css('color','red');
                $('#txtsign').val('+');
                $('#txtsign1').val('-');
                getrate();
                return;
            }else if(C==="-"){
                e.preventDefault();
                $('#txtbuy').css('color','red');
                $('#txtsale').css('color','blue');
                $('#txtsign').val('-');
                $('#txtsign1').val('+');
                getrate();

                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey(C,'#lblbuy')
            }
        })
        $(document).on('keyup', '#txtrate', function (e) {
            //debugger
            //alert(e.key)
            if(isNumber(e.key)){
                calcuexchange();
                return;
            }
            //alert('not a number')
            const C = e.key;
            if (C === "Backspace") {
                calcuexchange();
                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey(C,'#lblsale')
            }
        })

        $(document).on('keyup','#cuscharge',function(e){
            const C = e.key;
            openamount();
        })
        function openamount()
        {

            var openamt=0;
            var amt=$('#amount').val().replace(/,/g, '');
            var cuscharge=$('#cuscharge').val().replace(/,/g, '');
            openamt=parseFloat(amt)-parseFloat(cuscharge);
            if(isNaN(openamt)){
                openamt=amt;
            }
            $('#openamt').val(formatNumber(parseFloat(openamt)));

        }
        // $(document).on('click','#btnsavecontinue',function(e){
        //     e.preventDefault();
        //     var formdata=new FormData(frm_continue);
        //     var partnername=$('#selpartner_continue_2 option:selected').text();
        //     formdata.append('partnername',partnername);
        //     var url="{{ route('moneytransfer.savebankcontinue') }}"
        //     $.ajax({
        //         async: true,
        //         type: 'POST',
        //         contentType: false,
        //         processData: false,
        //         url: url,
        //         data: formdata,
        //         success: function (data) {
        //             console.log(data)
        //             if($.isEmptyObject(data.error)){
        //                 $('#cashdrawcontinuemodal').modal('hide');
        //                 search_cashdraw(moresearch);
        //             }else{
        //                 alert(data.error)
        //             }
        //         },
        //         error: function () {
        //             alert('Save Error.')
        //         }

        //     })
        // })
        $(document).on('click','#btnclosedivexchangefix',function(e){
          e.preventDefault();
          $('#divexchangefix').css('display','none');
          $('#hasexchangefix').val(0)
        })
        function autofillbankamt()
        {
            var table = document.getElementById("tbl_bankpayment");
            var bankpaymentrow = table.tBodies[0].rows.length;
            let j=0;
            var lbl_title='';
            var transferamt='0';
            var curid='';

            if($('#hasmulticashdraw').val()==1){
               transferamt=$('.td_btnexchange').eq(0).data('amount');
               curid=$('.td_btnexchange').eq(0).data('curid');
            }else{
               transferamt=$('#openamt').val().replace(/,/g, '');
               curid=$('#selcur').val();
            }

            var hasexchange=$('#hasexchange').val();
            var hasexchange2=$('#hasexchangefix').val();
            if(hasexchange2==1){
              $('.txtsalefix').each(function(i,e){
                bamt=$('.txtsalefix').eq(i).val().replace(/,/g, '');
                if(isNumber(bamt) && bamt!=0){
                  transferamt=bamt;
                  lbl_title=$('.lblsalefix').eq(i).attr('title');
                  curid=lbl_title.split(';')[0];
                  if($('.bankamt').eq(j).val()==0 || $('.bankamt').eq(j).val()==''){
                    $('.bankamt').eq(j).val(formatNumber(bamt));
                    $('.bankcur').eq(j).val(curid);
                  }
                  j+=1;
                }else{

                }
              })
              $('.bankamt').eq(bankpaymentrow-1).focus();
              return;
            }else{
              if(hasexchange==1){
                if($('#txtsign').val()=='+'){
                  transferamt=$('#txtsale').val().replace(/,/g, '');
                  curid=$('#lblsale').attr('title').split(';')[0];
                }else{
                  transferamt=$('#txtbuy').val().replace(/,/g, '');
                  curid=$('#lblbuy').attr('title').split(';')[0];
                }
              }else if(hasexchange==2){

              }
            }
            $('.bankamt').each(function(i,e){
              $('.bankamt').eq(i).val(formatNumber(transferamt));
              $('.bankcur').eq(i).val(curid);
            })
            $('.bankamt').eq(bankpaymentrow-1).focus();

        }
        $(document).on('click','#btnsave,#btnsaveprint',function(e){
            e.preventDefault();
            var elem=$(this).attr('id');
            var buttontext=$(this).text();
            $(this).attr('disabled', true).text("Processing");
            if($('#hasexchangefix').val()==1){
            if($('#hasexchange').val()<2){
              saveexchange2(func_savecashdraw,elem,1,buttontext,$(this));
              return;
            }
          }
          func_savecashdraw(elem,buttontext,$(this));

        })
        function saveexchange2(func,elem,isclear,buttontext,el)
        {
            $('#divexchangelist').css('display','block');
            var formdata=new FormData;
            $('.txtbuyfix').each(function(i,e){
                bamt=$('.txtbuyfix').eq(i).val().replace(/,/g, '');
                if(isNumber(bamt) && bamt!=0){
                formdata.append("curbuy[]",$('.lblbuyfix').eq(i).val());
                formdata.append("buy[]",$('.txtbuyfix').eq(i).val());
                formdata.append("sale[]",$('.txtsalefix').eq(i).val());
                formdata.append("cursale[]",$('.lblsalefix').eq(i).val());
                formdata.append("buyinfo[]",$('.lblbuyfix').eq(i).attr('title'));
                formdata.append("saleinfo[]",$('.lblsalefix').eq(i).attr('title'));
                formdata.append("rateinfo[]",$('.txtratefix').eq(i).attr('title'));
                formdata.append('rate[]',$('.txtratefix').eq(i).val());
                formdata.append('drate[]',$('.lblratefix').eq(i).attr('title'));
                }
            })
                formdata.append('dd',$('#invdate').val());
                formdata.append('isclear',isclear);
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: "{{ route('saveaddlistmulti') }}",
                data: formdata,
                success: function (data) {
                    $('#hasexchange').val(2);
                    getmultiexchangelist();
                    func(elem,buttontext,el);
                },
                error: function () {
                    alert('Save Exchange2 Error.')
                }

            })
        }
        function func_savecashdraw(elem,buttontext,el)
        {
            $('body').addClass("wait");
            var curid=$('#selcur').val();
            var topartner=$('#selpartner_continue option:selected').text();
            var frompartner=$('#from_partner').val();
            const table = document.getElementById("tbl_image");
            const thCount = table.querySelectorAll("th").length;
            var formdata=new FormData(frmcashdraw);
            formdata.append('foundmulti_image',thCount);
            formdata.append('curid',curid);
            formdata.append('topartner',topartner);
            formdata.append('frompartner',frompartner);
            var hasexchange=$('#hasexchange').val();
            //append exchange
            if(hasexchange==1){
                //var cashreceive=$('#txtcashreceive').val() + $('#lblcashin').val();
                // var cashreturn=$('#txtcashreturn').val();
                var m1 = $('#lblbuy').attr('title').split(";");
                var m2 = $('#lblsale').attr('title').split(";");
                var buyinfo='';
                var saleinfo='';
                var pid = 0;
                var mcur = '';
                var pcur = '';
                var luy = 0;
                var product = 0;
                var mekun = 1;
                var item1 = 0;
                var item2 = 0;
                var rate1b = 0;
                var rate1s = 0;
                var rate2b = 0;
                var rate2s = 0;
                var curid1 = 0;
                var curid2 = 0;
                var pcur1 = '';
                var pcur2 = '';
                var buy='0';
                var sale='0';
                var curbuy='';
                var cursale='';
                var receipt2='0';

                if ($('#txtsign').val() == '+') {
                    mekun = 1;
                    buy=$('#txtbuy').val();
                    sale=$('#txtsale').val();
                    curbuy=$('#lblbuy').val();
                    cursale=$('#lblsale').val();
                    // if($('#txtcashreceive').val()==''){
                    //     cashreceive=$('#txtbuy').val() + curbuy;
                    //     cashreturn=$('#txtsale').val() + cursale;
                    // }
                    buyinfo=$('#lblbuy').attr('title');
                    saleinfo=$('#lblsale').attr('title');

                } else {
                    mekun = -1;
                    buy=$('#txtsale').val();
                    sale=$('#txtbuy').val();
                    curbuy=$('#lblsale').val();
                    cursale=$('#lblbuy').val();
                    // if($('#txtcashreceive').val()==''){
                    //     cashreceive=$('#txtsale').val() + cursale;
                    //     cashreturn=$('#txtbuy').val()+curbuy;
                    // }
                    saleinfo=$('#lblbuy').attr('title');
                    buyinfo=$('#lblsale').attr('title');
                }
                if (m1[4] == '1') {
                    mcur = m1[6];
                    pid = m2[0];
                    pcur = m2[6];
                    luy = mekun * $('#txtbuy').val().replace(/,/g, '');
                    product = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
                } else if (m2[4] == '1') {
                    mcur = m2[6];
                    pid = m1[0];
                    pcur = m1[6];
                    product = mekun * $('#txtbuy').val().replace(/,/g, '');
                    luy = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
                } else {
                    receipt2='1';
                    item1 = $('#txtbuy').val();
                    item2 = $('#txtsale').val();
                    rate1b = m1[1];
                    rate1s = m1[2];
                    rate2b = m2[1];
                    rate2s = m2[2];
                    curid1 = m1[0];
                    curid2 = m2[0];
                    pcur1 = m1[6];
                    pcur2 = m2[6];
                    //url = "{{ route('saveexchangeproduct') }}"
                }
                var curshortcut=$('#txtcur_open').val();
                formdata.append("curshortcut",curshortcut);
                formdata.append("buyinfo", buyinfo);
                formdata.append("saleinfo", saleinfo);
                formdata.append("product_id", pid);
                formdata.append("product_cur", pcur);
                formdata.append("exchange_amount", luy);
                formdata.append("maincur", mcur);
                formdata.append("product", product);
                formdata.append("exchange_rate", $('#txtrate').val());
                formdata.append("origin_rate", $('#lblrate').attr('title'));

                formdata.append("exsign", $('#txtsign').val());
                formdata.append("item1", item1);
                formdata.append("item2", item2);
                formdata.append("rate1buy", rate1b);
                formdata.append("rate1sale", rate1s);
                formdata.append("rate2buy", rate2b);
                formdata.append("rate2sale", rate2s);
                formdata.append("curid1", curid1);
                formdata.append("curid2", curid2);
                formdata.append("pcur1", pcur1);
                formdata.append("pcur2", pcur2);
                formdata.append("buy",buy);
                formdata.append("sale", sale);
                formdata.append("curbuy", curbuy);
                formdata.append("cursale", cursale);

            }

            var url="{{ route('moneytransfer.savecashdraw') }}"
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        closemodalfrom='saved';
                        $('#cashdrawmodal').modal('hide');
                        if(elem=='btnsaveprint'){
                            prints(data.cashdrawid);
                        }
                        $('#btnclosedivexchangecard').click();
                        $('#btnclosedivcontinue').click();
                        $('#btnclosedivbankpayment').click();
                        $('#btnclosedivexchangefix').click();
                        $("#tbl_bankpayment tr").remove();
                        $('#frmcashdraw').trigger('reset');
                        $('#opdate').datetimepicker({
                                timepicker:false,
                                datepicker:true,
                                value:new Date(),
                                format:'d-m-Y',
                                autoclose:true,
                                todayBtn:true,
                                startDate:new Date(),
                            });
                            $('#opdate').datetimepicker("destroy");
                        // $('#rec_tel').val('');
                        // $('#rec_name').val('');
                        // $('#txtnote').val('');
                        search_cashdraw(moresearch);
                         $(el).removeAttr('disabled').html(buttontext);
                        $('body').removeClass("wait");
                    }else{
                         $(el).removeAttr('disabled').html(buttontext);
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function () {
                     $(el).removeAttr('disabled').html(buttontext);
                    $('body').removeClass("wait");
                    alert('Save Error.')
                }

            })
        }
        function prints(ref_number){
                var redirectWindow = window.open('{{ url('/') }}'+'/cashdraw/prints?ref_number='+ref_number, '_blank');
                redirectWindow.location;
            }
        var clickson='';
        $(document).on('click','#btnbrowseson',function(e){
            e.preventDefault();
            clickson=1;
            $('#searchchildmodal').modal('show');
            var selpartner=$('#selpartner').val();
            $('#sel_customer_search').val(selpartner);
            $('#sel_customer_search').trigger('change');
        })
        $(document).on('click','#btnbrowseson_2',function(e){
            e.preventDefault();
            clickson=2;
            $('#searchchildmodal').modal('show');
            var selpartner=$('#selpartner_continue_2').val();
            $('#sel_customer_search').val(selpartner);
            $('#sel_customer_search').trigger('change');
        })
        $(document).on('click','.btn_select',function(e){
            e.preventDefault();
            var row = $(this).closest('tr');
            var rowind=row.find("td:eq(0)").text();
            childname=row.find("td:eq(1)").text();
            addr=row.find("td:eq(3)").text();
            if(clickson==1){
                $('#son').val(childname + '(' + addr + ')');
            }else if(clickson==2){
                $('#son_2').val(childname + '(' + addr + ')');
            }
            $('#searchchildmodal').modal('hide');

        })
        $('#tblchildren').on('dblclick', '.rowclick', function(event) {

            var ind=$(this).index();
            var row=$(this).closest('tr');
            childname=row.find("td:eq(1)").text();
            addr=row.find("td:eq(3)").text();
            if(clickson==1){
                $('#son').val(childname + '(' + addr + ')');
            }else if(clickson==2){
                $('#son_2').val(childname + '(' + addr + ')');
            }
            $('#searchchildmodal').modal('hide');

		});
        $(document).on('keyup','#amount_continue',function(e){
            const C = e.key;
            cutwater(1);
            if(isNumber(C)==false){
              getcurrencybykeylocalstorage(C,'#selcur_continue');
              var cur=$('#selcur_continue option:selected').text();
              $('#selcur_continue').trigger('change');
          }
        })
        $(document).on('keyup','#cuscharge_continue',function(e){
            const C = e.key;
            cutwater(0);
        })
        $(document).on('change','#txtcur2',function(e){
          cutwater(0);
      })
        $(document).ready(function () {

            getreceivetel();
            $('#selcustomer').select2({templateResult: formatOption});
            $('#seluser').select2();
            $("#selpartner_continue_2").select2({
                dropdownParent: $("#cashdrawcontinuemodal"),
                templateResult: formatOption
            });
            $('#selpartner').select2({templateResult: formatOption});
            $("#selpartner_continue").select2({
              dropdownParent: $("#cashdrawmodal"),
              templateResult: formatOption
            });
            function getPermissionPcdt(userId, code) {
                const permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
                const perm = permusers.find(item => item.userid == userId && item.code == code);
                return perm ? perm.pcdt : null;
            }
            function hasPermission(userId, code) {
                let permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
                return permusers.some(item => item.userid == userId && item.code == code);
            }
            var pcdt=7;
            var currentUserId=$('#loginid').val();
            var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
            if (!isAdmin) {
                pcdt = getPermissionPcdt(currentUserId, '8.1.2') || 0;
                tels = getPermissionPcdt(currentUserId, '8.1.3') || 0;
                amt1 = getPermissionPcdt(currentUserId, '8.1') || 0;//កំណត់ទឹកប្រាក់បើកវេរ
                $('#txtsearchbytel').attr('title',tels);
                $('#txtsearchbyamt1').attr('title',amt1);

                if (!hasPermission(currentUserId, '8.1.3')) {
                    $('#selsearchby option[code="813"]').prop('disabled', true);
                    $('#txtsearchbytel').prop('disabled',true);
                }else{
                    $('#btnsearch2').attr('title','tel');
                }
                if (!hasPermission(currentUserId, '8.1.4')) {
                    $('#selsearchby option[code="814"]').prop('disabled', true);
                    $('#txtsearchbyamt1').prop('disabled',true);
                    $('#txtsearchbyamt2').prop('disabled',true);
                }

                if (!hasPermission(currentUserId, '8.1.1')) {
                    $('#btnsearch').css('display','none');
                    $('.colselcustomer').css('display','none');
                }
                if (!hasPermission(currentUserId, '8.1.5')) {
                    $('#btnopenmulticashdraw').css('display','none');
                }

            }
            var today = new Date();
            var sevenDaysAgo = new Date();
            sevenDaysAgo.setDate(today.getDate() - pcdt);

            // Setup datetimepicker
            $('#d1').datetimepicker({
                timepicker: false,
                datepicker: true,
                format: 'd-m-Y',
                autoclose: true,
                todayBtn: true,
                value: today,
                minDate: isAdmin ? false : sevenDaysAgo, // only set minDate if not admin
            });

            $('#d2,#opdate,#invdate,#opdates,#datecontinue').datetimepicker({
                timepicker: false,
                datepicker: true,
                format: 'd-m-Y',
                autoclose: true,
                todayBtn: true,
                startDate: today,
                value: today,
            });
                $('#opdate').datetimepicker("destroy");
                $('#invdate').datetimepicker("destroy");
                $('#datecontinue').datetimepicker("destroy");
            var cleave = new Cleave('#txtsearchbyamt1', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#txtsearchbyamt2', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            // var cleave = new Cleave('#txtsearchbytel', {
            //     blocks: [0, 3, 3, 4, 10],
            //     //delimiters: ['(', ') ', '-', ' '],
            //     numericOnly: true
            // });
            $('.txtbuyfix').toArray().forEach(function(field){
              new Cleave(field, {
                  numeral: true,
                  numeralPositiveOnly: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
            })
            $('.txtsalefix').toArray().forEach(function(field){
                new Cleave(field, {
                    numeral: true,
                    numeralPositiveOnly: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            })
            $('.txtratefix').toArray().forEach(function(field){
                new Cleave(field, {
                    numeral: true,
                    numeralPositiveOnly: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            })
            $(document).on('dblclick', '.tblnotyetcashdrawrowclick', function(event) {

                var ind=$(this).index();
                var row=$(this).closest('tr');
                id=row.find("td:eq(1)").text();
                opencashdraw(id);

        });
        $(document).on('change','#selsearchby',function(e){
            e.preventDefault();
            var searchby=$(this).val();
            if(searchby=='tel'){
                $('#col2').css('display','block');
                $('#col3').css('display','none');
                $('#col4').css('display','none');
            }else if(searchby=='amt'){
                $('#col2').css('display','none');
                $('#col3').css('display','block');
                $('#col4').css('display','block');
            }
            $('#btnsearch2').attr('title',searchby);
        })
        $(document).on('click','#btnsearch',function(e){
            e.preventDefault()
            moresearch=0;
            search_cashdraw(0);
        })
        $(document).on('click','#btnsearch2',function(e){
            e.preventDefault()
            var a=$('#btnsearch2').attr('title');
            if(a=='no item search') return;
           var searchby=$('#selsearchby').val();
           if(searchby=='tel'){
               var lennum=$('#txtsearchbytel').attr('title');
               var tellen = $('#txtsearchbytel').val().replace(/ /g, '');
               if(lennum>tellen.length){
                    alert('please input phone number')
                    $('#txtsearchbytel').focus();
                    return;
                }
           }else if(searchby=='amt'){
                var amt1=$('#txtsearchbyamt1').val();
                var amt2=$('#txtsearchbyamt2').val();
                if(amt1=='' || amt2==''){
                    return;
                }
           }
            moresearch=1;
            search_cashdraw(1);
        })
        $(document).on('change','#selcustomer,#seluser',function(e){
            e.preventDefault()
            moresearch=0;
            search_cashdraw(0);
        })

        function getcurrencybykeylocalstorage(key,el)
        {
            var currencylist;
            if(localStorage.getItem("currencylist")==null){
            currencylist=[];
            }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
            }
            currencylist.forEach(function(c){
            //debugger;
            if(c.skey==key){
                //$(el).val(c.shortcut);
                $(el).val(c.id);

            }
            })
        }
        $(document).on('keydown','#txtsearchbyamt1,#txtsearchbytel,#txtsearchbyamt2',function(e){

            if(e.keyCode==13){
                //debugger;
                var el=$(this).attr('id');
                var lennum=$('#txtsearchbytel').attr('title');
                //alert(lennum)
                var tellen = $('#txtsearchbytel').val().replace(/ /g, '');
                //alert(tellen.length)
                if(el=='txtsearchbytel'){
                    if(lennum>tellen.length){
                        return;
                    }
                }else if(el=='txtsearchbyamt1'){
                    var amt2=$('#txtsearchbyamt2').val();
                    var amt1=$('#txtsearchbyamt1').val();
                    if(amt2==''){
                        $('#txtsearchbyamt2').val(amt1)
                    }
                    $('#txtsearchbyamt2').focus();
                }
                moresearch=1;
                search_cashdraw(1);
            }
        })
        $(document).on('click','.btndelcashdraw',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var cashdraw_id=$(this).data('cashdraw_id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('cashdraw.delete') }}",
                            data: { id:id,cashdraw_id:cashdraw_id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    del_userselectcashdraw(id);
                                    search_cashdraw(moresearch);
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    'Delete Error.',
                                    'Error'
                                )
                            }

                        })

                    }
                })
            })
            $(document).on('click','.btndelcashdrawbankcontinue',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var fromid=$(this).data('fromid');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('cashdraw.deletebankcontinue') }}",
                            data: { id:id,fromid:fromid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    del_userselectcashdraw(id);
                                    search_cashdraw(moresearch);
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    'Delete Error.',
                                    'Error'
                                )
                            }

                        })

                    }
                })
            })
        //cash draw part
        $(document).on('click','#tbl_cashdraw td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_notyetcashdraw td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_bankcashdraw td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tblclearclick td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
        var closemodalfrom='';
        $("#cashdrawmodal").on("hidden.bs.modal", function () {
            if(closemodalfrom==''){
               if($('#hasmulticashdraw').val()==0){
                 var transfer_id=$('#transfer_id').val();
                 del_userselectcashdraw(transfer_id);
               }
            }
        });
        function del_userselectcashdraw(transfer_id){
            var url="{{ route('cashdrawselect.delaction') }}";
            $.post(url,{id:transfer_id},function(data){})
        }
        function checkright()
        {
            //$('#seluser').val($('#txtuserid').val());
            var role=$('#txtrole').val();
            if(role!='Admin'){
                //$('#showdate').datetimepicker("destroy");
                $('#opdate').datetimepicker("destroy");
                //$('#seluser_record').attr('disabled',true);

            }
        }

       $(document).on('click','#btnclearclick',function(e){
            e.preventDefault();
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            $('#clearactionmodal').modal('show');
            var url="{{ route('cashdraw.clearclick') }}";
            var output='';
            var k=0;
            $.get(url,{d1:d1,d2:d2},function(data){
                console.log(data);
                for(var i=0;i<data['useractions'].length;i++){
                    k+=1;
                    output +=`
                        <tr>
                            <td class="no1">${k}</td>
                            <td>${data['useractions'][i].transfer_id}</td>
                            <td>${data['useractions'][i].transfer.dd}</td>
                            <td>${formatNumber(Math.abs(data['useractions'][i].transfer.amount))}</td>
                            <td>${data['useractions'][i].user.name}</td>
                            <td>${moment(data['useractions'][i].created_at).format("DD-MM-YYYY")}</td>
                            <td style="text-align:right;"> <a href="#" class="btn btn-danger btndelactionuser" data-id="${ data['useractions'][i].id }" data-transferid="${ data['useractions'][i].transfer_id }">Remove</a></td>
                        </tr>
                    `
                }
                $('#tblclearclick').empty().html(output);
            })
       })
       $(document).on('click','.btndelactionuser',function(e){
            e.preventDefault()
            var id=$(this).data('transferid');
            var row = $(this).closest('tr');
            var rowind=row.find("td:eq(0)").text();
            var url="{{ route('deleteuseraction') }}";
            $.get(url,{id:id},function(data){
                document.getElementById("tableclearclick").deleteRow(rowind);
                ResetNo1();
            })
       })

        $('input[type=radio][name=radcustype2]').change(function() {
            getpartner(this.value,'#selpartner_continue');
        });
        function getpartner(type,el)
        {
            var url="{{ route('getpartnerbytype') }}";
            $(el).empty();

            $.get(url,{type:type},function(data){
                $(el).append($("<option/>",{
                            value:'',
                            text:''
                        }))
                $.each(data,function(i,item){
                    $(el).append($("<option/>",{
                            value:item.id,
                            text:item.name,
                            customertype:item.customertype,
                            userconnect:item.user_connect,
                            thai_list:item.thai_list,
                            countrycode:item.tel,
                            agenttype:item.agent_type_id,
                            maxtransfer:item.agenttype.transfer_amount,
                            maxcuscharge:item.agenttype.customer_fee,
                            maxfee:item.agenttype.cashdraw_fee,
                            maxtransferfee:item.agenttype.transfer_fee
                        }))
                    //console.log(item)
                });
                $(el).select2('open');

            })
        }
        $(document).on('change','#selpartner_continue',async function(e){
            e.preventDefault();

            var sp = document.querySelector("#selpartner_continue");
            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            var countrycode=sp.options[sp.selectedIndex].getAttribute('countrycode');

            if(customertype=='AGENT'){
                await gettranname('#seltranname1','#selpartner_continue');
               refreshwingratefast(totalcash_continue,fillnextbalance,'#balance2','#balancenext2',$('#selcur_continue option:selected').text(),-1,$('#amount_continue').val().replace(/,/g, ''),$('#fee_continue').val(),'#seltranname1','#cuscharge_continue','#fee_continue','#selpartner_continue');
                $('#row_wing_tranname1').css('display','table-row');
            }else{
                $('#row_wing_tranname').css('display','none');
            }


            if (document.getElementById("rowbalance2")) {
                if ($("#rowbalance2").length && $("#rowbalance2").is(":visible")) {
                    if($(this).val()!==''){
                        getwingbalance($(this).val(),$('#selcur_continue option:selected').text(),'#balance2','#balancenext2',-1,$('#amount_continue').val(),$('#fee_continue').val(),fillnextbalance);
                    }
                }
            }
        })
         function fillnextbalance(elbal,elnext,cur,sign,amt,fee)
        {
            //debugger;
            var mekun= sign;
            var amt1=amt.toString().replace(/,/g,'');
            var fee1=fee.toString().replace(/,/g,'');
            var amount=parseFloat(amt1)+parseFloat(fee1);
            //var amt2=$('#amount2').val().replace(/,/g,'');
            var i=0;
            var baltitle=$(elbal).attr('title');
            var balusd=baltitle.split(";")[0];
            var balkhr=baltitle.split(";")[1];
            var balthb=baltitle.split(";")[2];
            var balvnd=baltitle.split(";")[3];

            var balnext=0;
            var bal=0;
            var cur1='';

            if(cur=='USD'){
                    balnext=-1 * (parseFloat(balusd)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balusd);
                    cur1=' USD';
            }else if(cur=='KHR'){
                    balnext=-1 * (parseFloat(balkhr)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balkhr);
                    cur1=' KHR';
            }else if(cur=='THB'){
                    balnext=-1 * (parseFloat(balthb)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balthb);
                    cur1=' THB';
            }else if(cur=='VND'){
                    balnext=-1 * (parseFloat(balvnd)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balvnd);
                    cur1=' VND';
            }

            $(elnext).val(formatNumber(balnext) + cur1);
            $(elbal).val(formatNumber(bal) + cur1);
            if(bal>0){
                $(elbal).css('color','blue');
            }else{
                $(elbal).css('color','red');
            }
            if(balnext>0){
                $(elnext).css('color','blue');
            }else{
                $(elnext).css('color','red');
            }

        }
          function getwingbalance(cid,cur,elem,elnext,sign,amt,fee,fillnext_balance)
        {
            $('body').addClass("wait");

            var total=0;
            var d2=$('#h1_date').text();
            var op='<=';
            var url="{{ route('closelist.summarypartnerlist') }}";

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {cid:cid,showdate:d2,op:op},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        $(elem).attr('title',data.usd+';'+data.khr+';'+data.thb+';'+data.vnd);

                        fillnext_balance(elem,elnext,cur,sign,amt,fee);
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
         function findRates(agentTypeId, amount, tranNameId, cur) {
            let data = [];
            if (cur === 'USD') {
                data = JSON.parse(localStorage.getItem("wingrate_usd") || "[]");
            } else if (cur === 'KHR') {
                data = JSON.parse(localStorage.getItem("wingrate_khr") || "[]");
            }
            return data.filter(row =>
                Number(row.agenttype_id) === Number(agentTypeId) &&
                Number(amount) >= Number(row.amt1) &&
                Number(amount) <= Number(row.amt2) &&
                row.tranname_id.split(",").map(x => x.trim()).includes(String(tranNameId)) &&
                row.currency === cur
            ).map(row => ({
                customer_rate: row.customer_rate,
                transfer_rate: row.transfer_rate,
                cashdraw_rate: row.cashdraw_rate
            }));
        }

       function refreshwingratefast(callback1,callback2,el_balance1,el_balancenext1,selcur,mekun,amount,fee,el_seltraname,el_cuscharge,el_fee,el_partner)
      {
        //debugger;
        try{
            var sp = document.querySelector(el_seltraname);
            var sign=sp.options[sp.selectedIndex].getAttribute('sign');
            var is_tc=sp.options[sp.selectedIndex].getAttribute('is_tc');
            var trannameid=$(el_seltraname).val();

            if(sign==4 || sign==-4){
                $(el_cuscharge).val(0);
                $(el_fee).val(0);
                callback2(el_balance1,el_balancenext1,selcur,mekun,amount,fee);
                return;
            }
            var totalcuscharge=0;
            var totalfee=0;
            var totaltransferfee=0;

            var wingcur=selcur;
            var cur=selcur;
            var sp = document.querySelector(el_partner);

            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
            var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
            var maxfee=sp.options[sp.selectedIndex].getAttribute('maxfee');
            var maxcuscharge=sp.options[sp.selectedIndex].getAttribute('maxcuscharge');
            var maxtransferfee=sp.options[sp.selectedIndex].getAttribute('maxtransferfee');


            if(trannameid=='' || agenttype=='' || cur=='' || amount=='' || amount==0){
                callback2(el_balance1,el_balancenext1,selcur,mekun,amount,fee);
                return;
            }
            if(customertype=='AGENT'){
                if (is_tc == 0) {
                    var response = findRates(agenttype, amount, trannameid, cur);

                    if (response.length > 0) {
                        let customerRate = response[0]['customer_rate'];
                        let fee11 = (sign == 1)
                            ? response[0]['transfer_rate']
                            : response[0]['cashdraw_rate'];

                        // 🔹 Handle Customer Rate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            $(el_cuscharge).val((parseFloat(customerRate) * parseFloat(amount)) / 100);
                        } else {
                            $(el_cuscharge).val(parseFloat(customerRate));
                        }

                        // 🔹 Handle Fee
                        if (typeof fee11 === "string" && fee11.includes("%")) {
                            fee11 = fee11.replace("%", "").trim();
                            $(el_fee).val((parseFloat(fee11) * parseFloat(amount)) / 100);
                        } else {
                            $(el_fee).val(parseFloat(fee11));
                        }
                    }
                    callback1();
                    callback2(el_balance1,el_balancenext1,selcur,mekun,amount, $(el_fee).val());
                    return;
                }

                var maxamtstr=maxtransfer.replace(/,/g,'');
                var maxfeestr=maxfee.replace(/,/g,'');
                var maxcuschargestr=maxcuscharge.replace(/,/g,'');
                var maxtransferfeestr=maxtransferfee.replace(/,/g,'');

                var maxamtby=maxamtstr.split('/');
                var maxfeeby=maxfeestr.split('/');
                var maxcuschargeby=maxcuschargestr.split('/');
                var maxtransferfeeby=maxtransferfeestr.split('/');

                var maxamt2=0;
                var maxfee2=0;
                var maxcuscharge2=0;
                var maxtransferfee2=0;
                if(cur=='USD'){
                    maxamt2=maxamtby[0];
                    maxfee2=maxfeeby[0];
                    maxcuscharge2=maxcuschargeby[0];
                    maxtransferfee2=maxtransferfeeby[0];
                }

                if(cur=='KHR'){
                    maxamt2=maxamtby[1];
                    maxfee2=maxfeeby[1];
                    maxcuscharge2=maxcuschargeby[1];
                    maxtransferfee2=maxtransferfeeby[1];
                }
                if(cur=='THB'){
                    maxamt2=maxamtby[2];
                    maxfee2=maxfeeby[2];
                    maxcuscharge2=maxcuschargeby[2];
                    maxtransferfee2=maxtransferfeeby[2];
                }


                if(maxamt2==0) return;
                var result=Math.floor(amount / maxamt2);
                var somnal=amount % maxamt2;

                for(let i=0;i<result;i++){
                    if(sign==1){
                        totalcuscharge+=parseFloat(maxcuscharge2);
                        totalfee+=parseFloat(maxcuscharge2)-parseFloat(maxtransferfee2);
                    }else{
                        totalfee+=parseFloat(maxfee2);
                    }

                }
            }else{
                //var somnal=$('#amount').val().replace(/,/g, '');
                var somnal=amount;

            }

            if(somnal!==0 && isNaN(somnal)==false){
                var wingrate;
                if(cur=='USD'){
                    if(localStorage.getItem("wingrate_usd")==null){
                        wingrate=[];
                    }else{
                        wingrate=JSON.parse(localStorage.getItem("wingrate_usd"));
                    }

                }else if(cur=='KHR'){
                    if(localStorage.getItem("wingrate_khr")==null){
                        wingrate=[];
                    }else{
                        wingrate=JSON.parse(localStorage.getItem("wingrate_khr"));
                    }

                }
                var response = findRates(agenttype, somnal, trannameid, cur);
                if (response.length > 0) {
                    if (sign == 1) {
                        let customerRate = response[0]['customer_rate'];
                        let transferRate = response[0]['transfer_rate'];

                        // declare variables outside
                        let cuscharge = 0;
                        let transfer = 0;

                        // ✅ Handle customerRate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            cuscharge = (parseFloat(customerRate) * parseFloat(somnal)) / 100;
                        } else {
                            cuscharge = parseFloat(customerRate);
                        }

                        // ✅ Handle transferRate
                        if (typeof transferRate === "string" && transferRate.includes("%")) {
                            transferRate = transferRate.replace("%", "").trim();
                            transfer = (parseFloat(transferRate) * parseFloat(somnal)) / 100;
                        } else {
                            transfer = parseFloat(transferRate);
                        }

                        totalcuscharge += cuscharge;
                        totalfee += parseFloat(cuscharge) - parseFloat(transfer);

                    } else if (sign == -1) {
                        let cashdrawRate = response[0]['cashdraw_rate'];

                        let cashdraw = 0;

                        // ✅ Handle cashdrawRate
                        if (typeof cashdrawRate === "string" && cashdrawRate.includes("%")) {
                            cashdrawRate = cashdrawRate.replace("%", "").trim();
                            cashdraw = (parseFloat(cashdrawRate) * parseFloat(somnal)) / 100;
                        } else {
                            cashdraw = parseFloat(cashdrawRate);
                        }

                        totalfee += cashdraw;
                        $(el_fee).val(0);
                    }
                }

            }
            $(el_cuscharge).val(formatNumber(totalcuscharge,4));
            $(el_fee).val(formatNumber(totalfee,4));
            callback1();
            callback2(el_balance1,el_balancenext1,selcur,mekun,amount,totalfee);
        }catch(e){
            console.log(e)
        }
      }

         function gettranname(el,selpartner) {
            return new Promise((resolve, reject) => {
                var sp = document.querySelector(selpartner);
                var customertype = sp.options[sp.selectedIndex].getAttribute('customertype');
                var agenttype = sp.options[sp.selectedIndex].getAttribute('agenttype');
                $('body').addClass("wait");
                var url = "{{ route('wingtransfer.gettransactionname') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: { agenttype: agenttype },
                    success: function (data) {
                        if ($.isEmptyObject(data.error)) {
                            $(el).empty();

                            $(el).append($("<option/>",{
                                value:'',
                                text:''
                            }))

                            $.each(data['wtn'],function(i,item){
                                $(el).append($("<option/>",{
                                        value:item.id,
                                        text:item.name,
                                        sign:item.sign,
                                        is_tc:item.is_tc??0,
                                    }))

                            });

                            $('body').removeClass("wait");
                            resolve(data); // ✅ resolve when done
                        } else {
                            $('body').removeClass("wait");
                            alert(data.error);
                            reject(data.error);
                        }
                    },
                    error: function (xhr) {
                        $('body').removeClass("wait");
                        alert('Read Error.');
                        reject(xhr);
                    }
                });
            });
        }

        $(document).on('change','#selcur_continue',function(e){
            e.preventDefault();
            var sp = document.querySelector("#selpartner_continue");
            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          var curid=$(this).val();
          $('#txtcur1').val(curid);
          $('#txtcur2').val(curid);
          var cur=$('#selcur_continue option:selected').text();
          $('#txtcur').val(cur);
          if($('#selpartner_continue').val()!==''){
                if(customertype=='AGENT'){
                    refreshwingratefast(totalcash_continue,fillnextbalance,'#balance2','#balancenext2',$('#selcur_continue option:selected').text(),-1,$('#amount_continue').val().replace(/,/g, ''),$('#fee_continue').val(),'#seltranname1','#cuscharge_continue','#fee_continue','#selpartner_continue');
                }else{
                    fillnextbalance('#balance2','#balancenext2',$('#selcur_continue option:selected').text(),-1,$('#amount_continue').val(),$('#fee_continue').val());
                }
            }
      })
       $(document).on('change','#seltranname1',function(e){
        e.preventDefault();
        var amt=$('#amount_continue').val();
        var cur=$('#selcur_continue').val();
        if(amt=='') return;
        if(cur=='') return;
        refreshwingratefast(totalcash_continue,fillnextbalance,'#balance2','#balancenext2',$('#selcur_continue option:selected').text(),-1,$('#amount_continue').val().replace(/,/g, ''),$('#fee_continue').val(),'#seltranname1','#cuscharge_continue','#fee_continue','#selpartner_continue');
      })
       function ResetNo1(){
            $('.no1').each(function(i,e){
                $(this).text(i+1);
            })
        }
       function ResetNo(){
            $('.no').each(function(i,e){
                $(this).text(i+1);
            })
        }
        $(document).on('keyup','.bankamt',function(e){
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          const C = e.key;
          if (C === "Backspace") return;
          if(isNumber(C)==false){
              getcurrencybykey1(C,$('.bankcur').eq(rowind-1));
          }
      })
      $(document).on('click','#btnbankpayment',function(e){
          e.preventDefault();
          $('#divbankpayment').css('display','block');
          $('#hasbankpayment').val(1);
          var table = document.getElementById("tbl_bankpayment");
          var tbodyRowCount = table.tBodies[0].rows.length;
          if(tbodyRowCount==0){
            addrow();
            autofillbankamt();
          }
      })
      $(document).on('click','#btnaddrow',function(e){
          e.preventDefault();
          addrow();
          autofillbankamt();

      })
      $(document).on('click','.remove',function(e){
          e.preventDefault();
          //$(this).parent().parent().remove();
          $(this).closest("tr").remove();
          ResetNo();
      });
      $(document).on('change','.bankid',function(e){
          e.preventDefault();
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          var bankname=$('.bankid option:selected').eq(rowind-1).text();

          $('.bankname').eq(rowind-1).val(bankname);
      })
      function addrow(){
            //var nn=$('#tbl_bankpayment tr').length+1;
            var table = document.getElementById("tbl_bankpayment");
            var nn=table.tBodies[0].rows.length+1;
            let tst = Math.round(Date.now() / 1000)+nn;
            var row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh16">${nn}</td>
                        <td style="width:250px;padding:0px;">
                            <select name="bankid[]" class="form-select select2-option1 bankid" id="bankid${nn}"  style="width:250px;"></select>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control bankname kh16" style="" name="bankname[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamt kh16-b" style="text-align:right;height:35px;" name="bankamt[]">
                        </td>
                        <td style="width:100px;padding:0px;">
                            <select name="bankcur[]" class="form-select bankcur kh16" id="bankcur${nn}" style="width:130px;height:35px;"></select>
                        </td>

                        <td style="text-align:center;padding:2px;">
                            <a href="#" class="btn btn-danger btn-sm remove" style="border-radius:15px;"><i class="fa fa-minus"></i></a>
                        </td>
                        <td style="padding:0px;width:100px;">
                            <input type="text" class="form-control tdcanenter bankcuscharge kh16-b" style="text-align:right;height:30px;width:100px;" name="bankcuscharge[]" placeholder="charge" value="0" title="customercharge">
                        </td>
                        <td style="padding:0px;width:100px;">
                            <input type="text" class="form-control tdcanenter bankpartnerfee kh16-b" style="text-align:right;height:30px;width:100px;" name="bankpartnerfee[]" placeholder="fee" value="0" title="partner fee">
                        </td>
                    </tr>`;
                $('#body_bankpayment').append(row);

                //$('.unit option').remove();

                $('#selcur option').clone().appendTo('#bankcur'+nn);
                $('#selbank option').clone().appendTo('#bankid'+nn);
                $('#bankid'+nn).select2({
                  dropdownParent: $("#cashdrawmodal"),
                  templateResult: formatOption1
                });
                $('.bankamt').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
                //number('.barcode',true);
                window.scrollTo(0, document.body.scrollHeight);

        }
        $(document).on('click','.btntolist',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            var amt=Math.abs($(this).data('amount'));
            var curid=$(this).data('curid');
            //check if already add to partner list
            var partnername=$(this).data('partnername');
            refid='transfer-'+ id;
            var url1="{{ route('moneytransfer.check_reference_id') }}";
            $.get(url1,{refid:refid},function(data){
                console.log(data)
                if(data.see==true){
                    alert('this transaction already add to partner list')
                }else{
                    var url="{{ route('saveuseraction') }}";
                    $.post(url,{id:id},function(data){
                        if(data.error==true){//if return view
                            alert('You can not open this money.\n' + data.errorsms);
                        }else{
                            $('#receive_id').val(id);
                            $('#receive_name').val(partnername);
                            $('#amount_continue_2').val(formatNumber(amt));
                            $('#amount_continue_2').attr('title',parseFloat(amt));
                            $('#selcur_continue_2').val(curid);
                            var curname=$('#selcur_continue_2 option:selected').text();
                            $('#txtcur2_2').val(curname);
                            $('#txtcur_2').val(curname);
                            $('#txtcur1_2').val(curname);
                            totalcash2();
                            $('#cashdrawcontinuemodal').modal('show');
                        }
                    })
                }
            });

        })
        $("#cashdrawcontinuemodal").on("hidden.bs.modal", function () {
            var url="{{ route('deleteuseractionbytransferid') }}";
            var id=$('#receive_id').val();

            $.get(url,{id:id},function(data){
                console.log(data);
            })
        });

        $(document).on('click','.btnopencashdraw',function(e){
            e.preventDefault();

            var id=$(this).data('id');
            var examt=$(this).data('examt');
            var setamt=$('#txtsearchbyamt1').attr('title');
            if(Math.abs(parseFloat(examt))>Math.abs(parseFloat(setamt))){
                alert('លុយបើកច្រើនជាងលុយកំណត់អោយបើក។')
                return;
            }
            $('#diva').css('display','none');
            $('#divm1').css('display','none');
            $('#divm2').css('display','none');

            $('#divb').css('display','block');
            $('#divc').css('display','block');
            $('#hasmulticashdraw').val(0);
            opencashdraw(id,0,'');
        })
        $(document).on('click','.btnselectcashdraw',function(e){
            e.preventDefault();
            debugger;
            var examt=$(this).data('examt');
            var setamt=$('#txtsearchbyamt1').attr('title');
            if(Math.abs(parseFloat(examt))>Math.abs(parseFloat(setamt))){
                alert('លុយបើកច្រើនជាងលុយកំណត់អោយបើក។')
                return;
            }
            var id=$(this).data('id');
            var text=$(this).text();
            if(text=='unselect'){
              unselect(id,$(this));
            }else{
              opencashdraw(id,1,$(this));
            }
        })
        $(document).on('click','#btnclosedivbankpayment',function(e){
          e.preventDefault();
          $('#divbankpayment').css('display','none');
          $('#hasbankpayment').val(0);
      })
        $(document).on('click','#btnopenmulticashdraw',function(e){
            e.preventDefault();
            $('#btnclosedivexchangecard').click();
            $('#btnclosedivcontinue').click();
            $('#cashdrawmodal').modal('show');
            $('#diva').css('display','block');
            $('#divm1').css('display','block');
            $('#divm2').css('display','block');

            $('#divb').css('display','none');
            $('#divc').css('display','none');

            $('#hasmulticashdraw').val(1);
            opencashdrawmulti(sumcashdraw);
        })
        function opencashdrawmulti(callback)
        {
            $('#thead_img th').remove();
            $('#showPhoto').attr('src',"{{ config('helper.asset_path')}}/logo/NoPicture.jpg");
            $('#image2').val('');
            $('#photopath').val('');
            $('#clickcapture2').val('');
          var url="{{ route('moneytransfer.getmulticashdraw') }}";
            $.get(url,{},function(data){
              $('#diva').empty().html(data);
             callback();

            })
        }
        $(document).on('click','.btndeltransfertemp',function(e){
          var id=$(this).data('transferid');
          var url="{{ route('moneytransfer.unselectcashdraw') }}";
            $.get(url,{id:id},function(data){
              //console.log(data)
              opencashdrawmulti(sumcashdraw);
            })
        })
        $(document).on('click','#btncleartransferlist',function(e){
          var url="{{ route('moneytransfer.clearcashdrawselect') }}";
            $.get(url,{},function(data){
              //console.log(data)
              opencashdrawmulti(sumcashdraw);
            })
        })
        $(document).on('keydown','.tdcanenter2',function(e){
          if (e.keyCode == 13) {
              sumcashdraw();
              var $this = $(this),
              index = $this.closest('td').index();
              $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
              e.preventDefault();
          }
        })
        $(document).on('keyup', '.txtratefix', function (e) {
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          if(isNumber(e.key)){
            calcuexchange2($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              return;
          }
          //alert('not a number')
          const C = e.key;
          if (C === "Backspace") {
            calcuexchange2($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              return;
          }

      })
      $(document).on('keyup','.txtbuyfix,.txtsalefix',function(e){
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();

          var clickfrom=$(this).attr('class');
          if(isNumber(e.key)){
              if(clickfrom.includes('txtsalefix')==true){
                calcuexchange3($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              }else{
                calcuexchange2($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              }
              return;
          }
          //alert('not a number')

          const C = e.key;
          if (C === "Backspace") {
            if(clickfrom.includes('txtsalefix')==true){
                calcuexchange3($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              }else{
                calcuexchange2($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              }
              return;
          }

      })
      $(document).on('click','#btnexchange2',function(e){
          e.preventDefault();
          var sale=$('#openamt').val().replace(/,/g, '');
          var curid=$('#selcur').val();
          var cur=$('#selcur option:selected').text();
          getcurrencybyid(curid,'#lblbuy');
          doexchange2(sale,cur)
        })

        $(document).on('click','.td_btnexchange2',function(e){
          e.preventDefault();
          var cur=$(this).data('cur');
          var sale=$(this).data('amount');
          getcurrencybyshortcut(cur,'#lblbuy');
          //var curname=$('#selcur option:selected').text();
          doexchange2(sale,cur)
        })
      function doexchange2(sale,cur)
      {
          var arr_cur=['USD','THB','KHR','VND'];
          var arr_key=['d','b','r','v']
          let j=0;
          let curind=0;
          $('.lblbuyfix').each(function(i,e){
              //debugger;
                if(i==0){
                    $('.txtbuyfix').eq(i).val(formatNumber(sale));
                }else{
                    $('.txtbuyfix').eq(i).val('');
                    $('.txtsalefix').eq(i).val('');
                }
                j=j+1;
                $(this).attr('title',$('#lblbuy').attr('title'));
                $(this).val($('#lblbuy').val());
                if(arr_cur[i]==$(this).val()){
                    j+=1;
                    curind=i;
                }

                $('.txtsignfix').eq(i).val('+');
                $('.txtsign1fix').eq(i).val('-');
                $('.txtbuyfix').eq(i).css('color','blue');
                $('.lblbuyfix').eq(i).css('color','blue');
                $('.txtsalefix').eq(i).css('color','red');
                $('.lblsalefix').eq(i).css('color','red');

                if(isEmpty(arr_key[j-1])==true){
                  getcurrencybykey2(arr_key[curind],$('.lblsalefix').eq(i),$('.lblbuyfix').eq(i),$('.txtbuyfix').eq(i),$('.txtratefix').eq(i),$('.lblsalefix').eq(i),$('.txtsalefix').eq(i),$('.txtsignfix').eq(i),$('.lblratefix').eq(i));
                }else{
                  getcurrencybykey2(arr_key[j-1],$('.lblsalefix').eq(i),$('.lblbuyfix').eq(i),$('.txtbuyfix').eq(i),$('.txtratefix').eq(i),$('.lblsalefix').eq(i),$('.txtsalefix').eq(i),$('.txtsignfix').eq(i),$('.lblratefix').eq(i));
                }

          })
          $('#divexchangefix').css('display','block');
          $('#hasexchangefix').val(1);
          $('#txtleftamt').val(0);
          $('#txtmainamt').val(formatNumber(sale));
          $('#txtleftcur').val(cur);
          $('#btnaddexchange2').focus();
      }

      $(document).on('keydown','.tdcanenter2',function(e){
        if (e.keyCode == 13) {
            totalamtleft();
            var $this = $(this),
            index = $this.closest('td').index();
            $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
            e.preventDefault();
          }
      })
      function totalamtleft()
      {
        let j=0;
        var bamt=0;
        var total=0;
        var leftamt=0;
        var mainamt=$('#txtmainamt').val().replace(/,/g, '');
        $('.txtbuyfix').each(function(i,e){
          bamt=$('.txtbuyfix').eq(i).val().replace(/,/g, '');
          if(isNumber(bamt)){
            total+=parseFloat($('.txtbuyfix').eq(i).val().replace(/,/g, ''));
            leftamt=parseFloat(mainamt)-parseFloat(total);
            $('#txtleftamt').val(formatNumber(leftamt.toFixed(2)));
          }else{
            j=j+1;
            if(j==1){
              leftamt=parseFloat(mainamt)-parseFloat(total);
               $('.txtbuyfix').eq(i).val(formatNumber(leftamt.toFixed(2)));
               calcuexchange2($('.lblbuyfix').eq(i),$('.txtbuyfix').eq(i),$('.txtratefix').eq(i),$('.lblsalefix').eq(i),$('.txtsalefix').eq(i),$('.txtsignfix').eq(i),$('.lblratefix').eq(i));
               $('#txtleftamt').val(formatNumber(0));
            }
          }
        })
      }
        $(document).on('click','.td_btnexchange',function(e){
          e.preventDefault();
          var cur=$(this).data('cur');
          var amt=$(this).data('amount');
          doexchange1(amt,cur);

        })
        function doexchange1(amt,cur)
        {
            $('#divexchangecard').css('display','block');
            $('#hasexchange').val(1);
            $('#txtbuy').val(formatNumber(amt));
            $('#lblrate').attr('title',1);
            getcurrencybyshortcut(cur,'#lblbuy');
            if(cur!='USD'){
                getcurrencybykey('d','#lblsale');
            }else{
                getcurrencybykey('r','#lblsale');
            }
            $('#txtbuy').css('color','blue');
            $('#txtsale').css('color','red');
            $('#txtsign').val('+');
            $('#txtsign1').val('-');
            $('#txtsale').focus();
        }
        $(document).on('click','#btnexchange',function(e){
          e.preventDefault();
          var sale=$('#openamt').val().replace(/,/g, '');
          var curid=$('#selcur').val();
          var cur=$('#selcur option:selected').text();
          doexchange1(sale,cur);

        })
        $(document).on('keyup','.list_cuscharge',function(e){
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          calcuamtopen(rowind);
        })
        $(document).on('change','.list_curcharge_id',function(e){
          e.preventDefault();
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          calcuamtopen(rowind);

        })
        $(document).on('click','#btnaddexchange2',function(e){
          e.preventDefault();
          saveexchange2('',0,0,0);
          //window.scrollTo(0, document.body.scrollHeight);
      })

        function calcuamtopen(rowind)
        {
          var amt=$('.list_amount').eq(rowind-1).val().replace(/,/g, '');
          var seva=$('.list_cuscharge').eq(rowind-1).val();
          var cur1=$('.list_cur').eq(rowind-1).attr('title');
          var cur2=$('.list_curcharge_id').eq(rowind-1).val();
          if(cur1==cur2){
            var amt1=parseFloat(amt)-parseFloat(seva);
          }else{
            var amt1=parseFloat(amt);
          }
          $('.list_amount_open').eq(rowind-1).val(formatNumber(amt1));
        }
        function sumcashdraw()
        {
          var idusd='';
          var idthb='';
          var idkhr='';
          var idvnd='';
          var usd=0;
          var thb=0;
          var khr=0;
          var vnd=0;
          var cur='';
          var curid='';
          var amt=0;
          var rectel='';
          var recname='';
          $('.list_amount_open').each(function(i,e){
            cur=$('.list_cur_open').eq(i).val();
            curid=$('.list_currencyid').eq(i).val();
            amt=$('.list_amount_open').eq(i).val().replace(/,/g, '');
            if(cur=='USD'){
              usd += parseFloat(amt);
              idusd=curid;
            }else if(cur=='THB'){
              thb += parseFloat(amt);
              idthb=curid;
            }else if(cur=='KHR'){
              khr += parseFloat(amt);
              idkhr=curid;
            }else if(cur=='VND'){
              vnd += parseFloat(amt);
              idvnd=curid;
            }
          })
          var td='';
          var tr='';
          if(usd!=0){
            tr=`
                <tr>
                  <td colspan=2 style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(usd)} USD" readonly></td>
                  <td style="padding:2px 0px 0px 0px;text-align:center;">
                    <input type="button" title="USD" data-cur="USD" data-amount="${ usd }" data-curid="${idusd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                    <input type="button" title="USD" data-cur="USD" data-amount="${ usd }" data-curid="${idusd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                  </td>
                  </tr>
                `
          }
          if(thb!=0){
            tr+=`
                <tr>
                  <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(thb)} THB" readonly></td>
                  <td style="padding:2px 0px 0px 0px;text-align:center;">
                    <input type="button" title="THB" data-cur="THB" data-amount="${ thb }" data-curid="${idthb}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                    <input type="button" title="THB" data-cur="THB" data-amount="${ thb }" data-curid="${idthb}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                  </td>
                  </tr>
                `
          }
          if(khr!=0){
            tr+=`
                <tr>
                  <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(khr)} KHR" readonly></td>
                  <td style="padding:2px 0px 0px 0px;text-align:center;">
                    <input type="button" title="KHR" data-cur="KHR" data-amount="${ khr }" data-curid="${idkhr}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                    <input type="button" title="KHR" data-cur="KHR" data-amount="${ khr }" data-curid="${idkhr}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                    </td>
                  </tr>
                `
          }
          if(vnd!=0){
            tr+=`
                <tr>
                  <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(vnd)} VND" readonly></td>
                  <td style="padding:2px 0px 0px 0px;text-align:center;">
                    <input type="button" title="VND" data-cur="VND" data-amount="${ vnd }" data-curid="${idvnd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                    <input type="button" title="VND" data-cur="VND" data-amount="${ vnd }" data-curid="${idvnd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                  </td>
                  </tr>
                `
          }
          $('#tbl_total_cashdraw').empty().html(tr);

        }
        function unselect(id,el)
        {
          var url="{{ route('moneytransfer.unselectcashdraw') }}";
            $.get(url,{id:id},function(data){
              if(data.del2==1){
                el.text('select');
              }
            })
        }
        function opencashdraw(id,isselect,el)
        {
            closemodalfrom='';
            $('#thead_img th').remove();
            $('#showPhoto').attr('src',"{{ config('helper.asset_path')}}/logo/NoPicture.jpg");
            $('#image2').val('');
            $('#photopath').val('');
            $('#clickcapture2').val('');

            $('#btnclosedivexchangecard').click();
            $('#btnclosedivcontinue').click();
            $('#transfer_id').val(id);
            var amtset=$('#txtsearchbyamt1').attr('title');

            var url="{{ route('moneytransfer.opencashdraw') }}";
            $.get(url,{id:id,amtset:amtset,isselect:isselect},function(data){
               //console.log(data)
                if(data.error==true){//if return view
                    alert('You can not open this money.\n' + data.errorsms);
                    return;
                }
                if(isselect==1){
                  el.text('unselect');
                  return;
                }
                $('#cashdrawmodal').modal('show');
                $('#amount').val(formatNumber(Math.abs(data['ptransfer'].amount)));
                $('#selcur').val(data['ptransfer'].currency_id);
                $('#txtcur_cutseva').val(data['ptransfer'].currency.shortcut);
                $('#openamt').val(formatNumber(Math.abs(data['ptransfer'].amount)));
                $('#txtcur_open').val(data['ptransfer'].currency.shortcut);
                $('#invdate').val(moment(data['ptransfer'].dd).format("DD-MM-YYYY"));
                $('#from_partner').val(data['ptransfer'].partner.name);
                $('#from_partner_id').val(data['ptransfer'].parrent_id);
                $('#rectel').val(data['ptransfer'].rectel);
                $('#recname').val(data['ptransfer'].recname);
                $('#sendertel').val(data['ptransfer'].sendertel);
                $('#sendername').val(data['ptransfer'].sendername);
                $('#rec_tel').val(data['ptransfer'].rectel);
                $('#rec_name').val(data['ptransfer'].recname);
                var cleave = new Cleave('#rectel', {
                    blocks: [0, 3, 3, 4, 10],
                    //delimiters: ['(', ') ', '-', ' '],
                    numericOnly: true
                });
                var cleave = new Cleave('#sendertel', {
                    blocks: [0, 3, 3, 4, 10],
                    //delimiters: ['(', ') ', '-', ' '],
                    numericOnly: true
                });
                var output='';
                for(var i=0;i<data['mex'].length;i++){
                    output +=
                            `<tr>
                                <td style="text-align:center;">${i+1}</td>
                                <td>
                                    <input type="text" name="txtbuys[]" class="form-control txtbuys" style="width:100%;border-style:none;padding:5px;text-align:right;" value="${formatNumber(data['mex'][i].buy)}">
                                </td>
                                <td>
                                    <input type="text" name="txtcurbuys[]" class="form-control txtcurbuys" style="width:50px;border-style:none;padding:5px;text-align:center;" value="${data['mex'][i].curbuy}">
                                </td>
                                <td style="display:none;">
                                    <input type="text" name="txtbuyinfoes[]" class="form-control" style="width:50px;border-style:none;padding:5px;" value="${data['mex'][i].buyinfo}">
                                </td>
                                <td style="">
                                    <input type="text" name="txtrates[]" class="form-control" style="width:80px;border-style:none;padding:5px;text-align:center;" value="${formatNumber(data['mex'][i].rate)}">
                                </td>
                                <td style="display:none;">
                                    <input type="text" name="txtrateinfoes[]" class="form-control" style="width:50px;border-style:none;padding:0px;" value="${data['mex'][i].rateinfo}">
                                </td>
                                <td>
                                    <input type="text" name="txtsales[]" class="form-control" style="width:100%;border-style:none;padding:5px;text-align:right;" value="${formatNumber(data['mex'][i].sale)}">
                                </td>
                                <td>
                                    <input type="text" name="txtcursales[]" class="form-control" style="width:50px;border-style:none;padding:5px;text-align:center;" value="${data['mex'][i].cursale}">
                                </td>
                                <td style="display:none;">
                                    <input type="text" name="txtsaleinfoes[]" class="form-control" style="width:50px;border-style:none;padding:5px;" value="${data['mex'][i].saleinfo}">
                                </td>
                                <td style="display:none;">
                                    <input type="text" name="txtdrates[]" class="form-control" style="width:50px;border-style:none;padding:5px;" value="${data['mex'][i].drate}">
                                </td>
                                <td style="text-align:center;">
                                    <a data-id="${data['mex'][i].id}" class="btn btn-danger btn-sm btndelmxlist" href="">Del</a>
                                </td>
                            </tr>`

                }

                $('#multiexlist').empty().html(output);
                var output1='';
                for(var j=0;j<data['cashin'].length;j++){
                    output1+=`<tr>
                                <td style="font-size:22px;color:blue;text-align:right;">${data['cashin'][j].value} &nbsp; ${data['cashin'][j].cur}</td>
                            </tr>`
                }
                $('#t_cashin').empty().html(output1);

                var output2='';
                for(var k=0;k<data['cashout'].length;k++){
                    output2+=`<tr>
                                <td style="font-size:22px;color:blue;text-align:right;">${data['cashout'][k].value} &nbsp; ${data['cashout'][k].cur}</td>
                            </tr>`
                }
                $('#t_cashout').empty().html(output2);
            })
        }
        // var cleave = new Cleave('#rectel', {
        //     blocks: [0, 3, 3, 4, 10],
        //     //delimiters: ['(', ') ', '-', ' '],
        //     numericOnly: true
        // });
        // var cleave = new Cleave('#sendertel', {
        //     blocks: [0, 3, 3, 4, 10],
        //     //delimiters: ['(', ') ', '-', ' '],
        //     numericOnly: true
        // });
        // var cleave = new Cleave('#rec_tel', {
        //     blocks: [0, 3, 3, 4, 10],
        //     //delimiters: ['(', ') ', '-', ' '],
        //     numericOnly: true
        // });

        // var cleave = new Cleave('#rectel_continue', {
        //     blocks: [0, 3, 3, 4, 10],
        //     //delimiters: ['(', ') ', '-', ' '],
        //     numericOnly: true
        // });
        // var cleave = new Cleave('#rectel_continue_2', {
        //     blocks: [0, 3, 3, 4, 10],
        //     //delimiters: ['(', ') ', '-', ' '],
        //     numericOnly: true
        // });
        var cleave = new Cleave('#cuscharge', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#amount_continue', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#amount_continue_2', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#cuscharge_continue', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#cuscharge_continue_2', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#fee_continue', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#fee_continue_2', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });

        $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
          $(this).closest(".select2-container").siblings('select:enabled').select2('open');
        });

        $('#selpartner_continue').on("select2:select", function(e) {
            //console.log($(this).val());
            $('#btnsave').focus();
        });
        $(document).on('click','#btncontinue',function(e){
            e.preventDefault();
            //disablebutton($(this).attr('id'));
            $('#hascontinue').val(1);
            $('#divcontinue').css('display','block');
            $('#selpartner').focus();
            var hasexchange=$('#hasexchange').val();
            var amt_continue=0;
            var lblsale='';
            var cur_continue='';
            if(hasexchange==1){
                amt_continue=$('#txtsale').val();
                lblsale=$('#lblsale').attr('title').split(";");
                cur_continue=lblsale[0];
            }else{
                amt_continue=$('#openamt').val();
                cur_continue=$('#selcur').val();
            }
            $('#amount_continue').val(amt_continue);
            totalcash();
            $('#selcur_continue').val(cur_continue);
            $('#amount_continue').attr('title',amt_continue);
            filltxtcur();
            //window.scrollTo(0, document.body.scrollHeight);
            $('#selpartner_continue').focus();
        })

        function filltxtcur()
        {
            var curid=$('#selcur_continue').val();
            var seltext=$('#selcur_continue option:selected').text();
            $('#txtcur').val(seltext);
            $('#txtcur1').val(curid);
            $('#txtcur2').val(curid);
        }
        $(document).on('change','#selcur_continue_2',function(e){
            filltxtcur2();
        })
        function filltxtcur2()
        {
            var seltext=$('#selcur_continue_2 option:selected').text();
            $('#txtcur_2').val(seltext);
            $('#txtcur1_2').val(seltext);
            $('#txtcur2_2').val(seltext);
        }
        $(document).on('click','#btnclosedivcontinue',function(e){
            e.preventDefault();
            $('#hascontinue').val(0);
            $('#divcontinue').css('display','none');
            buttonclose($(this).attr('id'));

        })
        $(document).on('click','#btnclosedivexchangecard',function(e){
            e.preventDefault();
            buttonclose($(this).attr('id'));

            $('#divexchangecard').css('display','none');
            $('#divexchangelist').css('display','none');
            $('#hasexchange').val(0)
        })
        $(document).on('click','#btnclosedivexchangelist',function(e){
            e.preventDefault();
            buttonclose($(this).attr('id'));
            $('#divexchangelist').css('display','none');
            $('#hasexchange').val(1)
        })
        $(document).on('keydown', '.canenter', function (e) {
            if (e.keyCode == 13) {
                var id = $(this).attr("id");
                if (id == 'txtbuy') {
                    $('#txtrate').focus();
                } else if(id == 'txtrate'){
                   $('#btnsave').focus();
                } else if (id == 'cuscharge'){
                    $('#rec_tel').focus();
                }else if (id == 'rec_tel') {
                    $('#rec_name').focus();
                }else if (id == 'rec_name') {
                    $('#txtother').focus();
                }else if(id=='amount_continue'){
                    $('#cuscharge_continue').focus();
                }else if(id=='cuscharge_continue'){
                    $('#fee_continue').focus();
                }else if(id=='fee_continue'){
                    $('#btnsave').focus();
                }else if(id=='rectel_continue'){
                    $('#recname_continue').focus();
                }else if(id=='recname_continue'){
                    $('#sendertel_continue').focus();
                }else if(id=='sendertel_continue'){
                    $('#sendername_continue').focus();
                }else if(id=='sendername_continue'){
                    $('#amount_continue').focus();
                }
                e.preventDefault();
            }
        })
        autocomplereceiver();
        autocomplesender();
        function autocomplereceiver(){
                var sources=JSON.parse(localStorage.getItem("recphonelist"));
                var sources1=JSON.parse(localStorage.getItem("recnamelist"));
                $( "#rectel_continue" ).autocomplete({
                    source:sources,
                    minLength: 3,
                    select: function( event, ui ) {
                        $( "#rectel_continue" ).val( ui.item.value );
                        $( "#recname_continue" ).val( ui.item.recname );
                        return false;
                    }
                    //    select : showResult,
                    //     focus : showResult,
                    //     change :showResult
                });
                $( "#recname_continue" ).autocomplete({
                    source:sources1,
                    minLength: 3,
                    select: function( event, ui ) {
                        $( "#recname_continue" ).val( ui.item.value );
                        $( "#rectel_continue" ).val( ui.item.rectel );
                        return false;
                    }

                });
            }
            function autocomplesender(){
                var sources=JSON.parse(localStorage.getItem("sendphonelist"));
                var sources1=JSON.parse(localStorage.getItem("sendernamelist"));
                $( "#sendertel_continue" ).autocomplete({
                    source:sources,
                    minLength: 3,
                    select: function( event, ui ) {
                        $( "#sendertel_continue" ).val( ui.item.value );
                        $( "#sendername_continue" ).val( ui.item.sendername );
                        return false;
                    }
                    //    select : showResult,
                    //     focus : showResult,
                    //     change :showResult
                });
                $( "#sendername_continue" ).autocomplete({
                    source:sources1,
                    minLength: 3,
                    select: function( event, ui ) {
                        $( "#sendername_continue" ).val( ui.item.value );
                        $( "#sendertel_continue" ).val( ui.item.sendertel );
                        return false;
                    }

                });
            }


      function getreceivetel()
    {
      $.ajax({
                async: true,
                type: 'GET',
                url: "{{ route('cashdrawrectel.autocomplete') }}",
                data: {},
                complete: function () {

                },
                success: function (data) {
                  console.log(data);
                  $("#rec_tel").autocomplete({
                      source: function (request, response) { // use a function so you can trim the request and ignore ""
                          var term = $.trim(request.term).replace(/\s+/g, '')
                          var reg = new RegExp($.ui.autocomplete.escapeRegex(term), "i")
                          if (term !== "") response($.grep(data, function (tag) {
                              //return tag.value.match(reg)
                              return tag.value.match(reg)

                          }))
                      },
                      minLength: 3,
                      select: function (e, ui) {
                          //location.href = ui.item.the_link;
                          //console.log(ui.item.recname);
                          $('#rec_name').val(ui.item.recname);
                      }
                  });
                },
                error: function () {
                    alert('Read Error.')
                }
            })
    }

        $(document).on('change','#amount_continue',function(e){
            $('#amount_continue').attr('title',$(this).val());
        })

        $(document).on('keyup','#amount_continue_2',function(e){
            const C = e.key;
            cutwater2(1);
        })
        $(document).on('keyup','#cuscharge_continue_2',function(e){
            const C = e.key;
            cutwater2(0);
        })
        $(document).on('change','#amount_continue_2',function(e){
            $('#amount_continue_2').attr('title',$(this).val());
        })

        $(document).on('change','#ckwater',function(e){
           cutwater(0);
        })
        $(document).on('change','#ckwater_2',function(e){
           cutwater2(0);
        })
        function cutwater(isamtkeyup)
        {

            if(isamtkeyup!=1){
                var ck = document.getElementById("ckwater").checked;
                var amt=$('#amount_continue').attr('title').replace(/,/g, '');
                var cuscharge=$('#cuscharge_continue').val().replace(/,/g, '');
                if(ck==true){
                    amt=amt-cuscharge;
                    $('#amount_continue').val(formatNumber(amt));
                }else{
                    $('#amount_continue').val(formatNumber(amt));
                }
            }

            totalcash();
        }
        function totalcash()
        {
            var totalcash=0;
            var amt=$('#amount_continue').val().replace(/,/g, '');
            var cur=$('#selcur_continue option:selected').text();
            var cuscharge=$('#cuscharge_continue').val().replace(/,/g, '');
            var cur1=$('#txtcur2 option:selected').text();
            if(cur==cur1){
              totalcash=parseFloat(amt)+parseFloat(cuscharge);
            }else{
                totalcash=amt;
            }
            $('#totalcash').val(formatNumber(parseFloat(totalcash)));

        }

        function cutwater2(isamtkeyup)
        {
            if(isamtkeyup!=1){
                var ck = document.getElementById("ckwater_2").checked;
                var amt=$('#amount_continue_2').attr('title').replace(/,/g, '');
                var cuscharge=$('#cuscharge_continue_2').val().replace(/,/g, '');
                if(ck==true){
                    amt=amt-cuscharge;
                    $('#amount_continue_2').val(formatNumber(amt));
                }else{
                    $('#amount_continue_2').val(formatNumber(amt));
                }
            }

            totalcash2();
        }
        function totalcash2()
        {
            var totalcash=0;
            var amt=$('#amount_continue_2').val().replace(/,/g, '');
            var cuscharge=$('#cuscharge_continue_2').val().replace(/,/g, '');
            totalcash=parseFloat(amt)+parseFloat(cuscharge);
            $('#totalcash_2').val(formatNumber(parseFloat(totalcash)));

        }
         function totalcash_continue()
      {
          var totalcash=0;
          var amt=$('#amount_continue').val().replace(/,/g, '');
          var cur=$('#selcur_continue option:selected').text();
          var cuscharge=$('#cuscharge_continue').val().replace(/,/g, '');
          var cur1=$('#txtcur2 option:selected').text();
          if(cur==cur1){
              totalcash=parseFloat(amt)+parseFloat(cuscharge);
          }else{
              totalcash=amt;
          }
          $('#totalcash').val(formatNumber(parseFloat(totalcash)));
      }
        function getcurrencybykey2(key,el,lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate)
    {
        // var url="{{ route('getcurrencybykey') }}";
        // $.get(url,{key:key},function(data){
        //         if(data['c']!=null){
        //             $(el).val(data['c']['shortcut']);
        //             $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
        //             getrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
        //         }
        // })
        var currencylist;
        if(localStorage.getItem("currencylist")==null){
            currencylist=[];
        }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
        }
         for (let i = 0; i < currencylist.length; i++) {
            if(currencylist[i].skey==key){
                $(el).val(currencylist[i].shortcut);
                $(el).attr('title', currencylist[i].id + ';' + currencylist[i].ratebuy + ';' + currencylist[i].ratesale + ';' + currencylist[i].optsign + ';' + currencylist[i].ismain + ';' + currencylist[i].isfn + ';' + currencylist[i].shortcut);
                getrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                return;
            }
        }
    }
    //  function getcurrencybykey(key,el)
    // {
    //     // var url="{{ route('getcurrencybykey') }}";
    //     // $.get(url,{key:key},function(data){
    //     //         if(data['c']!=null){
    //     //             $(el).val(data['c']['shortcut']);
    //     //             $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
    //     //             getrate();
    //     //         }
    //     // })

    //     var currencylist;
    //     if(localStorage.getItem("currencylist")==null){
    //         currencylist=[];
    //     }else{
    //         currencylist=JSON.parse(localStorage.getItem("currencylist"));
    //     }
    //     for (let i = 0; i < currencylist.length; i++) {
    //         if(currencylist[i].skey==key){
    //             $(el).val(currencylist[i].shortcut);
    //             $(el).attr('title', currencylist[i].id + ';' + currencylist[i].ratebuy + ';' + currencylist[i].ratesale + ';' + currencylist[i].optsign + ';' + currencylist[i].ismain + ';' + currencylist[i].isfn + ';' + currencylist[i].shortcut);
    //             getrate();
    //             return;
    //         }
    //     }
    // }
    function getrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            $(txtrate).attr('title', '');
            try{
                var m = $(lblbuy).attr('title').split(";");
                var p = $(lblsale).attr('title').split(";");
            }catch{
                return;
            }
            if(m=='' || p==''){
                //alert('can not save')
                return;
            }
            //check if the save curname
            //debugger
            if (m[6] == p[6]) {
                $(txtrate).val(1);
                if(txtbuy.val()!='' || txtsale.val()!=''){
                    calcuexchange2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
                return;
            }
            //check if product exchange product
            if (m[4] == '0') {
                if (p[4] == '0') {
                    runproductrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                    return;
                }
            }
            if ($(txtsign).val() == '+') {
                if (m[4] == '1') {//if maincur=true
                    $(txtrate).val(formatNumber(parseFloat(p[2])));//get rate p sale
                } else {
                    $(txtrate).val(formatNumber(parseFloat(m[1])));//get rate m buy
                }

            } else {
                if (m[4] == '1') {
                    $(txtrate).val(formatNumber(parseFloat(p[1])));
                } else {
                    $(txtrate).val(formatNumber(parseFloat(m[2])));
                }

            }
            $(lblrate).attr('title',$(txtrate).val());
            $(lblrate).val($(txtrate).val());
            if(txtbuy.val()!='' || txtsale.val()!=''){
                calcuexchange2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
            }
            //dolabelcico();
        }
        function runproductrate2_old(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate)
    {
            var url="{{ route('getproductrate') }}";
            var buycur = $(lblbuy).val();
            var salecur = $(lblsale).val();
            var curname = '';
            if ($(txtsign).val() == '+') {
                curname = buycur + '-' + salecur;
            } else {
                curname = salecur + '-' + buycur;
            }
            //alert(curname)
            $.get(url,{curname:curname},function(data){
                if(data.success){
                    if($('#countrycode').val()=='+66'){
                      $(txtrate).val(formatNumber(parseFloat(data['pr']['thai_rate'])));
                      $(txtrate).attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['thai_rate'] + ';' +  data['pr']['operator']);
                    }else{
                      $(txtrate).val(formatNumber(parseFloat(data['pr']['rate'])));
                      $(txtrate).attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                    }
                    if(txtbuy.val()!='' || txtsale.val()!=''){
                        calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                    }
                }else{
                    $(txtrate).val('');
                    $(txtrate).attr('title','');
                }
                console.log(data)
            })

            $(lblrate).attr('title',$(txtrate).val());
            $(lblrate).val($(txtrate).val());
            //dolabelcico();
    }
    function runproductrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate)
    {
        var buycur = $(lblbuy).val();
        var salecur = $(lblsale).val();
        var curname = '';
        if ($(txtsign).val() == '+') {
            curname = buycur + '-' + salecur;
        } else {
            curname = salecur + '-' + buycur;
        }
        var currencylist;
        if(localStorage.getItem("currencyproductlist")==null){
            currencylist=[];
        }else{
            currencylist=JSON.parse(localStorage.getItem("currencyproductlist"));
        }
        $(txtrate).val('');
        $(txtrate).attr('title','');
        currencylist.forEach(function(c){
            if(c.pshortcut==curname){
                $(txtrate).val(parseFloat(c.rate));
                $(txtrate).attr('title', c.pshortcut + ';' +  c.rate + ';' +  c.operator);
                if(txtbuy.val()!='' || txtsale.val()!=''){
                    calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
            }
        })
        $(lblrate).attr('title',$(txtrate).val());
        $(lblrate).val($(txtrate).val());
    }
        function calcuexchange2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger
            var luy = $(txtbuy).val().replace(/,/g, '');
            var r = $(txtrate).val().replace(/,/g, '');
            var m1 = $(lblbuy).attr('title').split(";");
            var m2 = $(lblsale).attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    } else {
                        $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                    }
                } else {
                    calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
            }
        }
        function calcuexchange3(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger
            // $('#txtcashreceive').val('');
            // $('#txtcashreturn').val('');
            var luy = $(txtsale).val().replace(/,/g, '');
            var r = $(txtrate).val().replace(/,/g, '');
            var m1 = $(lblsale).attr('title').split(";");
            var m2 = $(lblbuy).attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    $(txtbuy).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $(txtbuy).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $(txtbuy).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    } else {
                        $(txtbuy).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                    }
                } else {
                    calcuexchangeproduct3(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
            }
        }
        function calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger;
            var luy = $(txtbuy).val().replace(/,/g, '');
            var r = $(txtrate).val().replace(/,/g, '');
            var rs = $(txtrate).attr('title').split(";");
            if ($(txtsign).val() == '+') {
                if (rs[2] == '*') {
                    $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (rs[2] == '*') {
                    $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }
            }
        }
    })
    function isEmpty(val){return (val === undefined || val == null || val.length <= 0) ? true : false;}
    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    let scale = 1;
    let pos = { x: 0, y: 0 };
    let isDragging = false;
    let start = { x: 0, y: 0 };

    const img = document.getElementById('zoomImage');
    const icon = document.getElementById('zoomIcon');
    var moresearch=0;
// Mouse wheel zoom
    img.addEventListener('wheel', function (e) {
    e.preventDefault();

    if (e.deltaY < 0) {
        scale += 0.1;
    } else {
        scale = Math.max(1, scale - 0.1);
        if (scale === 1) {
        pos = { x: 0, y: 0 }; // reset position
        }
    }

    updateTransform();

    icon.style.display = 'block';
    setTimeout(() => icon.style.display = 'none', 500);
    });

// Mouse down to start dragging
    img.addEventListener('mousedown', function (e) {
    if (scale <= 1) return;

    isDragging = true;
    start = { x: e.clientX - pos.x, y: e.clientY - pos.y };
    img.style.cursor = 'grabbing';
    });

// Mouse move to drag
    window.addEventListener('mousemove', function (e) {
        if (!isDragging) return;
        pos = {
            x: e.clientX - start.x,
            y: e.clientY - start.y
        };
        updateTransform();
    });

// Mouse up to stop dragging
    window.addEventListener('mouseup', function () {
        isDragging = false;
        img.style.cursor = 'grab';
    });

// Helper: apply scale + translation
    function updateTransform() {
        img.style.transform = `translate(${pos.x}px, ${pos.y}px) scale(${scale})`;
    }

        function search_cashdraw(searchmore)
        {
            $('body').addClass("wait");
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var partner=$('#selcustomer').val();
            var user=$('#seluser').val();
            var tel=$('#txtsearchbytel').val().replace(/\s+/g, '');
            var amt1=$('#txtsearchbyamt1').val().replace(/,/g, '');
            var amt2=$('#txtsearchbyamt2').val().replace(/,/g, '');
            var searchby=$('#selsearchby').val();
            var url="{{ route('moneytransfer.searchcashdraw') }}";

            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,partner:partner,user:user,searchby:searchby,tel:tel,amt1:amt1,amt2:amt2,searchmore:searchmore},

                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#cashdrawandnotyet').empty().html(data);
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
    </script>
@endsection
