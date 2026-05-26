@extends('master')
@section('title') បើកលុយថៃ @endsection
@section('css')
    <style type="text/css">
      body.wait *{
			cursor: wait !important;
		}
    .select2-container--default .select2-results>.select2-results__options{max-height: 360px !important;}
    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:whitesmoke;}
		/* Each result */
	#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:20px;background-color:white}

    #selpartner_continue + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:whitesmoke;}
		/* Each result */
	#select2-selpartner_continue-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
    #selpartner_continue_2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:whitesmoke;}
		/* Each result */
	#select2-selpartner_continue_2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

    #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
		/* Each result */
	#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}


    .bankid + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
      /* Search field */
      .select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 38px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            background-color:rgb(230, 245, 240);
        }
        .select2-selection__arrow {
            height: 35px !important;
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
        td{
            padding:0px;
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
       .tableFixHead1{ overflow: auto;background-color:rgb(237, 240, 48);border:1px dotted black;}
        .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
       .cgr{
        background-color:aquamarine;
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
        /* .zoom-container {
            position: relative;
            display: inline-block;
        }
        #zoomImage {
            max-width: 100%;
            height: auto;
            transition: transform 0.3s ease;
            display: block;
        } */

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
    .tableFixHead{ overflow: auto;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }

    .tbl_usertransaction td{
      word-wrap: break-word;
      padding:2px 5px 2px 5px;
    }
    #tblsearchmore td{
        border-style:none;
    }
    #tbl_bankpayment0 td{
        word-wrap:break-word;
    }
    .ui-autocomplete {
        position: fixed;
        z-index: 1511;
        font-size:18px;
        font-weight:bold;
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
        padding:2px 0px 0px 0px;
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
       #tbl_notyetcashdraw td{
        padding:2px;
       }
       #tbl_notyetcashdraw th{
        padding:2px;
       }
       #tbl_cashdraw td{
        padding:2px;
       }
       #tbl_cashdraw th{
        padding:2px;
       }
       #tbl_child td{
        border-style:none;
       }
       #tblchildren .clickedrow td{
        background-color: #caaf8f;
       }
       #tbl_cashdraw .clickedrow td{
        background-color:blue;
        color:white;
       }
       #tbl_cashdraw .clickedrow td > a{
        background-color:blue;
        color:white;
       }
       #tbl_notyetcashdraw .clickedrow td{
        background-color: blue;
        color:white;
       }
       #tbl_notyetcashdraw .clickedrow td > a{
        background-color: blue;
        color:white;
       }
       #tbl_bankcashdraw .clickedrow td{
        background-color:yellowgreen;
       }
       #tblclearclick .clickedrow td{
        background-color: #caaf8f;
       }
       tr.borderset1{
            border-top:2px solid gray;
            border-left:2px solid gray;
            border-right:2px solid gray;

        }
        tr.borderset2{

            border-bottom:2px solid gray;
            border-left:2px solid gray;
            border-right:2px solid gray;
        }
        #tbl_continue_partner td{
            padding:0px;
        }
       #tbl_notyetcashdraw tr:hover {background-color:lightgray;}
       #tbl_cashdraw tr:hover {background-color:rgb(136, 245, 103);}
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
        .dropdown-menu li a:hover {
            background-color: blue !important;
            border: 1px solid black;
            border-radius: 2px; /* optional: makes it look better */
            color: white !important; /* optional: improves visibility on red */
        }

        .button1:hover {
            background-color: #8fe9c8;
            color: rgb(19, 57, 230);
        }
        #tbl_modalwingcode td{
            padding:0px;
        }
        #tbl_checkamt td{
            padding:3px;
        }
        #tbl_checkamt th{
            padding:3px;
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
                <tr class="kh16-b">
                    <th style="border-style:none;">គិតពី</th>
                    <th style="border-style:none;">ដល់</th>
                </tr>
                <tr>
                    <td style="padding:0px;border-style:none;width:190px;">
                        <div class="input-group" style="width:190px;">
                            <input type="text" name="d1" id="d1" class="kh16-b" style="width:130px;background-color:silver;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                    </td>
                    <td style="padding:0px;border-style:none;width:190px;">
                        <div class="input-group" style="width:190px;">
                            <input type="text" name="d2" id="d2" class="kh16-b" style="width:130px;background-color:silver;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>

                <td style="padding:0px 0px 0px 20px;border-style:none;">
                    @if (Auth::user()->role->name<>'Admin')
                        @if (App\User::checkpermission(Auth::id(),'4.3.1'))
                            <button class="btn-3d kh16-b" id="btnsearch">Search by Date</button>
                        @endif
                    @else
                        <button class="btn-3d kh16-b" id="btnsearch">Search by Date</button>
                        <button class="btn-3d btn-3d-primary btn-sm kh16-b" id="btnclearclick" style="">Clear User Action</button>
                        <button class="btn-3d btn-3d-primary btn-sm kh16-b" id="btnclearclick1" style="">Clear Action Competed</button>

                    @endif
                    <button class="btn-3d kh16-b" id="btnrefreshphonenumber" style="">Refresh Phone</button>

                    <button class="btn-3d btn-3d-primary kh16-b" id="btnsearchmore" style="float:right;" data-bs-toggle="collapse" data-bs-target="#searchmore">...</button>
                </td>
                </tr>

            </table>
        </div>
    </div>
    <div id="searchmore" class="collapse show" style="margin-top:-10px;">
        <div class="row" style="margin-bottom:10px;">
            <div class="col-lg-3">
                <label class="kh16-b" for="searchby">ស្វែងរកតាម</label>
                <select name="selsearchby" id="selsearchby" class="kh16-b" style="width:100%;height:30px;">
                    <option value="time">ម៉ោង</option>
                    <option value="tel">លេខទូរស័ព្ទ</option>
                    @if (Auth::user()->role->name<>'Admin')
                        @if (App\User::checkpermission(Auth::id(),'4.1.3'))
                            <option value="amt">ចំនួនទឹកប្រាក់</option>
                        @endif
                    @else
                        <option value="amt">ចំនួនទឹកប្រាក់</option>
                    @endif

                </select>
            </div>
            <div class="col-lg-3" id="col1">
                <label id="lbltime" class="kh16-b" for="stel">ស្វែងរកតាមម៉ោង</label>
                {{-- <input type="text" id="numtelsearch" value="{{ App\User::permissiongetamt(Auth::id(),'4.3.2') }}"> --}}
                <input type="text" id="txtsearchbytime" class="kh16-b" style="width:100%;" title="">
            </div>
            <div class="col-lg-3" id="col2" style="display:none;">
                <label id="lbltel" class="kh16-b" for="stel">ស្វែងរកតាមលេខទូរស័ព្ទ</label>
                {{-- <input type="text" id="numtelsearch" value="{{ App\User::permissiongetamt(Auth::id(),'4.3.2') }}"> --}}
                <input type="text" id="txtsearchbytel" class="form-control kh16-b" style="width:100%;height:40px;" title="{{ App\User::permissiongetamt(Auth::id(),'4.1.4') }}">
            </div>
            <div class="col-lg-3" id="col3" style="display:none;">
                <label class="kh16" for="samt1">ពីចំនួន</label>
                <input type="text" id="txtsearchbyamt1" class="form-control kh16-b" style="width:100%;height:40px;" title="{{ App\User::permissiongetamt(Auth::id(),'4.1.1') }}">
            </div>
            <div class="col-lg-3" id="col4" style="display:none;">
                <label class="kh16" for="samt2">ដល់ចំនួន</label>
                <input type="text" id="txtsearchbyamt2" class="form-control kh16-b" style="width:100%;height:40px;">
            </div>
            <div class="col-lg-3">
               <button id="btnsearch2" class="btn-3d btn-sm kh16-b" style="margin-top:20px;">Search</button>
               <button class="btn-3d btn-3d-primary btn-sm kh16-b" style="margin-top:20px;" id="btnopenmulticashdraw">Multi Cashdraw</button>
            </div>
        </div>
    </div>
    <div class="tableFixHead" id="cashdrawandnotyet" style="padding:0px;margin:0px;">

    </div>
    @include('thaicashdraws.cashdrawmodal')
    @include('thaicashdraws.cashdrawmodal0')
    @include('moneytransfers.continuemodal')
    @include('moneytransfers.searchchildmodal')
    @include('moneytransfers.clearuseractionmodal')
    @include('thaicashdraws.dowingcodemodal')
    @include('thaicashdraws.cashdrawcodemodal')
    @include('thaicashdraws.addqrcodemodal')
    @include('thaicashdraws.recteltransfermodal')
    @include('thaicashdraws.smsnote_modal')
    @include('thaicashdraws.seephoto_modal')
@endsection
@section('script')
<script src="{{ config('helper.asset_path') }}/js/video1.js"></script>
@include('moneytransfers.searchchildscript')
@include('moneytransfers.exchangescript');
    <script type="text/javascript">
        $('#h1_title').text('បើកវេរលុយថៃ');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-263;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }

      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-263;

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
        window.addEventListener("storage", function(event) {
            if (event.key === "pageAItemAdded") {
                // Handle the event when a new item is added on Page A
                refreshContents();
            }
        });
        function refreshContents() {
            var items = JSON.parse(localStorage.getItem("items")) || [];
            location.href = location.href;
            localStorage.removeItem("pageAItemAdded");
            localStorage.removeItem("items");
        }
        function savephonetolocalstorage(){
             $('body').addClass("wait");
            localStorage.removeItem("recphonelist_thai");
            localStorage.removeItem("recnamelist_thai");
            var url="{{ route('phonenumberlocalstoragethai') }}";
            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {},
                success: function (data) {

                    if ($.isEmptyObject(data.error)) {
                        var recphonelist_thai;
                        var recnamelist_thai;
                        if(localStorage.getItem("recphonelist_thai")==null){
                            recphonelist_thai=[];
                        }else{
                            recphonelist_thai=JSON.parse(localStorage.getItem("recphonelist_thai"));
                        }
                        if(localStorage.getItem("recnamelist_thai")==null){
                            recnamelist_thai=[];
                        }else{
                            recnamelist_thai=JSON.parse(localStorage.getItem("recnamelist_thai"));
                        }
                        $.each(data['recphonelist'],function(i,item){
                            recphonelist_thai.push({
                                value:item.rectel,
                                label:item.rectel,
                                recname:item.recname,
                                qrcode:item.qrcode,
                            })
                            recnamelist_thai.push({
                                value:item.recname,
                                label:item.recname,
                                rectel:item.rectel,
                                qrcode:item.qrcode,
                            })
                        });

                        localStorage.setItem("recphonelist_thai",JSON.stringify(recphonelist_thai));
                        localStorage.setItem("recnamelist_thai",JSON.stringify(recnamelist_thai));
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


        }

        function appendphonetolocalstorage_noupdate(rectel, recname, qrcode) {
            let newitem = { value: rectel, label: rectel, recname: recname, qrcode: qrcode };
            let recphonelist_thai = JSON.parse(localStorage.getItem("recphonelist_thai")) || [];
            // Check if rectel already exists
            let exists = recphonelist_thai.some(item => item.value === rectel);
            if (!exists) {
                recphonelist_thai.push(newitem);  // only push if not exist
                localStorage.setItem("recphonelist_thai", JSON.stringify(recphonelist_thai));
                console.log("Added:", rectel);
            } else {
                console.log("Skipped duplicate:", rectel);
            }
        }
        function appendphonetolocalstorage(rectel, recname, qrcode) {

            let newitem = { value: rectel, label: rectel, recname: recname, qrcode: qrcode };

            let recphonelist_thai = JSON.parse(localStorage.getItem("recphonelist_thai")) || [];

            // Find index of existing item
            let index = recphonelist_thai.findIndex(item => item.value === rectel);

            if (index === -1) {
                // Not exist → add new
                recphonelist_thai.push(newitem);
                console.log("Added new:", rectel);
            } else {
                // Exists → update qrcode (and recname if you want)
                recphonelist_thai[index].qrcode = qrcode;
                recphonelist_thai[index].recname = recname; // optional
                console.log("Updated qrcode for:", rectel);
            }

            localStorage.setItem("recphonelist_thai", JSON.stringify(recphonelist_thai));
        }

        $(document).on('click', '.btnseephoto', function (e) {
            e.preventDefault();
            $('body').addClass("wait");

            var id = $(this).data('id');
            $('#seephoto_modal').modal('show');

            var url = "{{ route('thaicashdraw.seephoto') }}";

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: { id: id,type:'th' },
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
        // $(document).on('click','.seebig-btn',function(e){
        //     e.preventDefault();
        //     var imgpath=$(this).data('imgpath');
        //     $('#zoomImage').attr('src', "{{ config('helper.asset_path') }}/myimages/" + imgpath);
        // })


        // $(document).on('click', '.seebig-btn', function (e) {
        //     e.preventDefault();
        //     const imgpath = $(this).data('imgpath');
        //     const fullSrc = "{{ config('helper.asset_path') }}/myimages/" + imgpath;

        //     // Reset zoom and position
        //     scale = 1;
        //     pos = { x: 0, y: 0 };

        //     $('#zoomImage')
        //         .attr('src', fullSrc)
        //         .css('transform', 'translate(0px, 0px) scale(1)');

        //     $('#zoomIcon').hide();
        // });
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


        // const image = document.getElementById('zoomImage');
        // const icon = document.getElementById('zoomIcon');
        // let scale = 1;
        // let zoomTimeout;

        // image.addEventListener('wheel', function (e) {
        //     e.preventDefault();

        //     // Zoom in or out
        //     if (e.deltaY < 0) {
        //         scale += 0.1;
        //     } else {
        //         scale = Math.max(0.1, scale - 0.1);
        //     }
        //     image.style.transform = `scale(${scale})`;

        //     // Show zoom icon briefly
        //     icon.style.display = 'block';
        //     clearTimeout(zoomTimeout);
        //     zoomTimeout = setTimeout(() => {
        //         icon.style.display = 'none';
        //     }, 500);
        // });
        let scale = 1;
        let pos = { x: 0, y: 0 };
        let isDragging = false;
        let start = { x: 0, y: 0 };

        const img = document.getElementById('zoomImage');
        const icon = document.getElementById('zoomIcon');

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


          //-------------image capture
          $('#browse_file2').on('click',function(){
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
		// $(document).on('click','#btnaddimgtolist',function(e){
		// 	e.preventDefault();
        //     var thimg='';
        //     if($('#clickcapture2').val()==0){
        //         var photopath=$('#image2').val();
        //     }else{
        //         var photopath=$('#photopath').val();
        //     }
        //     thimg=`
        //         <th style="">
        //             <div class="img-container">
        //                 <img src="${photopath}" alt="" style="" title=${photopath}>
        //                 <a href="" class="mybtn remove-btn">remove</a>
        //                 <input type="hidden" name="imgphotopath[]" value="${photopath}" readonly>
        //             </div>
        //         </th>
        //     `;
        //     $('#thead_img').append(thimg);
		// })
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

        $(document).ready(function () {
            $(document).on('click', '.remove-btn', function(e) {
                e.preventDefault();
                $(this).closest('th').remove();
            });
            //savephonetolocalstorage()

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

            var today=new Date();
                $('#d1,#d2,#opdate,#invdate,#opdates,#datecontinue').datetimepicker({
                    timepicker:false,
                    datepicker:true,
                    value:today,
                    format:'d-m-Y',
                    autoclose:true,
                    todayBtn:true,
                    startDate:today,
                });
                $('#opdate').datetimepicker("destroy");
                $('#invdate').datetimepicker("destroy");
                $('#datecontinue').datetimepicker("destroy");
                search_cashdraw(0);
            var cleave = new Cleave('#txtsearchbyamt1', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#txtsearchbyamt2', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#txtsearchbytel', {
                blocks: [0, 3, 3, 4, 10],
                //delimiters: ['(', ') ', '-', ' '],
                numericOnly: true
            });
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
        $(document).on('keydown','.tdcanenter',function(e){
            if (e.keyCode == 13) {
                var $this = $(this),
                index = $this.closest('td').index();
                $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
                e.preventDefault();
            }
        })
        $('input[type=radio][name=radcustype]').change(function() {
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
                            userconnect:item.user_connect

                        }))
                    //console.log(item)
                });
                $(el).select2('open');

            })
        }
        $(document).on('change','#selpartner_continue',function(e){
            e.preventDefault();
            if($(this).val()!==''){
                getwingbalance($(this).val(),$('#selcur_continue option:selected').text(),'#balance1','#balancenext1',1,$('#amount_continue').val(),$('#fee_continue').val(),fillnextbalance);
            }
        })
        $(document).on('click','.btnnote',function(e){
            e.preventDefault();
            $('#frmnote').trigger('reset');
            var rowind=$(this).data('rowind');
            var id=$(this).data('id');
            $('#txtsmsid').val(id);
            $('#txtrowind').val(rowind);
            $('#smsnote_modal').modal('show');
        })
        $(document).on('click','#btnsavenote',function(e){
            e.preventDefault();
            $('body').addClass("wait");
            var formdata=new FormData(frmnote);
            var url="{{ route('thaicashdraw.updatesmsnote') }}"
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                success: function (data) {
                    console.log(data)
                    //debugger;
                    if($.isEmptyObject(data.error)){
                        var rowind=parseFloat($('#txtrowind').val())-1;
                        $('#smsnote_modal').modal('hide');
                        $('.opname').eq(rowind).text(data['opname']);
                        $('.optel').eq(rowind).text(data['optel']);
                        $('body').removeClass("wait");
                    }else{
                        $('body').removeClass("wait");

                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");

                    alert('Save Error.')

                }

            })
        })
        $(document).on('change','#selcur_continue',function(e){
            e.preventDefault();
            var curid=$('#selcur_continue').val();
            var seltext=$('#selcur_continue option:selected').text();
            $('#txtcur').val(seltext);
            $('#txtcur1').val(curid);
            $('#txtcur2').val(curid);

            if($('#selpartner_continue').val()!==''){
                fillnextbalance('#balance1','#balancenext1',$('#selcur_continue option:selected').text(),1,$('#amount_continue').val(),$('#fee_continue').val());
            }
        })
      $(document).on('change','#fee_continue',function(e){
            var amt=$('#amount_continue').val().replace(/,/g,'');
            var fee=$('#fee_continue').val().replace(/,/g,'');
            var fp=0;
            fp=(parseFloat(fee)/parseFloat(amt))*100;
            $('#feeps').val(formatNumber(fp));
          if($('#selpartner_continue').val()!==''){
            fillnextbalance('#balance1','#balancenext1',$('#selcur_continue option:selected').text(),1,$('#amount_continue').val(),$('#fee_continue').val());
          }
      })
      $(document).on('change','#feeps',function(e){
            e.preventDefault();
            var amt=$('#amount_continue').val().replace(/,/g,'');
            var fp=$('#feeps').val().replace(/,/g,'');
            var fee=0;
            fee=(parseFloat(fp)*parseFloat(amt))/100;
            $('#fee_continue').val(formatNumber(fee));
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
          function getwingbalance(cid,cur,elem,elnext,sign,amt,fee,callback)
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
                        $(elem).attr('title',data.usd+';'+data.khr+';'+data.thb);

                        callback(elem,elnext,cur,sign,amt,fee);
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
        $(document).on('change','#selsearchby',function(e){
            e.preventDefault();
            var searchby=$(this).val();
            if(searchby=='tel'){
                $('#col2').css('display','block');
                $('#col3').css('display','none');
                $('#col4').css('display','none');
                $('#col1').css('display','none');
            }else if(searchby=='amt'){
                $('#col2').css('display','none');
                $('#col3').css('display','block');
                $('#col4').css('display','block');
                 $('#col1').css('display','none');
            }else if(searchby=='time'){
                $('#col2').css('display','none');
                $('#col3').css('display','none');
                $('#col4').css('display','none');
                $('#col1').css('display','block');
            }
        })
        $(document).on('change','.input_image',function(e){
            var rowind=$(this).closest('tr').index();
            showFile1(this,$('.qrimg'),rowind,$('.imagepath'));
        })
        $(document).on('change','.input_image0',function(e){
            var rowind=$(this).closest('tr').index();
            showFile1(this,$('.qrimg0'),rowind,$('.imagepath0'));
        })

        function showFile1(fileInput,img,rowind,imgpath){

            if(fileInput.files[0]){
                let filename = fileInput.files[0].name;   // <-- get only file name
                var reader=new FileReader();
                reader.onload=function(e){
                    $(img).eq(rowind).attr('src',e.target.result);
                    $('#qrcode_image').attr('src',e.target.result);
                    $(img).eq(rowind).attr('title',fileInput.value);
                    $(imgpath).val(fileInput.value);
                }
                reader.readAsDataURL(fileInput.files[0]);
            }
            //$(showName).text(fileInput.files[0].name);
        }

        $('#browse_file').on('click',function(){
            $('#image').click();
        })
			$('#image').on('change',function(e){
				showFile(this,'#showPhoto');
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

        $(document).on('click','#btnsearch',function(e){
            e.preventDefault()
            moresearch=0;
            search_cashdraw(0);
        })
        $(document).on('click','#btnrefreshphonenumber',function(e){
            e.preventDefault()
            savephonetolocalstorage();
        })
        $(document).on('click','#btnsearch2',function(e){
            e.preventDefault()
           var searchby=$('#selsearchby').val();
           if(searchby=='tel'){
               var lennum=$('#txtsearchbytel').attr('title');
               var tellen = $('#txtsearchbytel').val().replace(/ /g, '');
               if(lennum>tellen.length){
                    alert('please input phone number')
                    $('#txtsearchbytel').focus();
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
        var moresearch=0;
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
            var url="{{ route('thaicashdraw.searchcashdraw') }}";
            // $.get(url,{d1:d1,d2:d2,partner:partner,user:user,searchby:searchby,tel:tel,amt1:amt1,amt2:amt2,searchmore:searchmore},function(data){
            //     $('#cashdrawandnotyet').empty().html(data);
            // })

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,partner:partner,user:user,searchby:searchby,tel:tel,amt1:amt1,amt2:amt2,searchmore:searchmore},
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#cashdrawandnotyet').empty().html(data);
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
        })
        $("#cashdrawmodal0").on("hidden.bs.modal", function () {
            var transfer_id=$('#transfer_id0').val();
            del_userselectcashdraw0(transfer_id);

        })
        function del_userselectcashdraw0(transfer_id){
            var url="{{ route('thaicashdraw1.delcashdrawaction1') }}";
             $.post(url,{id:transfer_id},function(data){})
        }
        function del_userselectcashdraw(transfer_id){
            var url="{{ route('thaicashdraw.delcashdrawaction') }}";
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
            var url="{{ route('thaicashdraw.clearclick') }}";
            var output='';
            var k=0;
            $.get(url,{d1:d1,d2:d2},function(data){

                for(var i=0;i<data['useractions'].length;i++){
                    k+=1;
                    output +=`
                        <tr>
                            <td class="no1">${k}</td>
                            <td>${data['useractions'][i].sms_id}</td>
                            <td>${data['useractions'][i].thaisms.smsdate}</td>
                            <td>${formatNumber(Math.abs(data['useractions'][i].thaisms.amount)) + data['useractions'][i].thaisms.cur}</td>
                            <td>${data['useractions'][i].user.name}</td>
                            <td>${moment(data['useractions'][i].created_at).format("DD-MM-YYYY")}</td>
                            <td style="text-align:right;"> <a href="#" class="btn btn-danger btndelactionuser" data-id="${ data['useractions'][i].id }" data-smsid="${ data['useractions'][i].sms_id }">Remove</a></td>
                        </tr>
                    `
                }
                $('#tblclearclick').empty().html(output);
            })
       })
       $(document).on('click','#btnclearclick1',function(e){
            e.preventDefault();
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            $('#clearactionmodal').modal('show');
            var url="{{ route('thaicashdraw1.clearclick1') }}";
            var output='';
            var k=0;
            $.get(url,{d1:d1,d2:d2},function(data){

                for(var i=0;i<data['useractions'].length;i++){
                    k+=1;
                    output +=`
                        <tr>
                            <td class="no1">${k}</td>
                            <td>${data['useractions'][i].sms_process_id}</td>
                            <td>${data['useractions'][i].smsprocess.opdate}</td>
                            <td>${formatNumber(Math.abs(data['useractions'][i].smsprocess.amount))} THB</td>
                            <td>${data['useractions'][i].user.name}</td>
                            <td>${moment(data['useractions'][i].created_at).format("DD-MM-YYYY")}</td>
                            <td style="text-align:right;"> <a href="#" class="btn btn-danger btndelactionuser" data-id="${ data['useractions'][i].id }" data-smsprocessid="${ data['useractions'][i].sms_process_id }">Remove</a></td>
                        </tr>
                    `
                }
                $('#tblclearclick').empty().html(output);
            })
       })
       $(document).on('click','.btndelactionuser',function(e){
            e.preventDefault()
            var id=$(this).data('smsid');
            var row = $(this).closest('tr');
            var rowind=row.find("td:eq(0)").text();
            var url="{{ route('thaideleteuseraction') }}";
            $.get(url,{id:id},function(data){
                document.getElementById("tableclearclick").deleteRow(rowind);
                ResetNo1();
            })
       })
       $(document).on('click','.btnclearselect',function(e){
            e.preventDefault()
            var id=$(this).data('id');
            var rowind = $(this).closest('tr').index();

            var url="{{ route('thaideleteuseraction') }}";
            $.get(url,{id:id},function(data){
                $('.btnselectcashdraw').eq(rowind).text('select');
            })
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
        $(document).on('keyup','.bankrate,.bankamt',function(e){
            var rowind = $(this).closest('tr').index();
            if(isNumber(e.key)){
              calcuexchange(rowind,$('.bankamt'),$('.bankamtexchange'),$('.bankrate'),$('.bankcur'),$('.bankcurexchange'));
              return;
          }
          //alert('not a number')
          const C = e.key;
          if (C === "Backspace") {

              calcuexchange(rowind,$('.bankamt'),$('.bankamtexchange'),$('.bankrate'),$('.bankcur'),$('.bankcurexchange'));
              return;
          }
        })

      $(document).on('click','#btnbankpayment',function(e){
          e.preventDefault();
          $('#btnsavestep2').css('display','inline');
          $('#btnsavestep3').css('display','inline');
          $('#divbankpayment').css('display','block');
          $('#hasbankpayment').val(1);

          var table = document.getElementById("tbl_bankpayment");
          var tbodyRowCount = table.tBodies[0].rows.length;
          if(tbodyRowCount==0){
            addrow();
          }

        //   var h = $('#cashdrawmodal .modal-body').height();
        //   $("#cashdrawmodal .modal-body").scrollTop(h+2000);
         // window.scrollTo(0, document.body.scrollHeight);
      })
      function resetbutton(clickfrom){

        if(clickfrom=='btncontinuewingbank'){
            $('#btnsaveprint').css('display','inline');
            $('#btnsaveprintcash').css('display','none');
        }else {
            $('#btnsaveprint').css('display','none');
            $('#btnsaveprintcash').css('display','inline');
        }
            //$('#btnsavestep2').css('display','none');
            //$('#btnsavestep3').css('display','none');
            $('#btncontinue').css('display','inline');
            $('#btnexchange').css('display','inline');
            $('#btnexchange2').css('display','inline');
            $('#btnbankpayment').css('display','inline');

      }
      $(document).on('click','#btnaddrow',function(e){
          e.preventDefault();
          addrow();
      })
      $(document).on('click','.remove',function(e){
          e.preventDefault();
          //$(this).parent().parent().remove();
          $(this).closest("tr").remove();
          //ResetNo();
          totaluseamt();
      });
      $(document).on('click','.remove0',function(e){
          e.preventDefault();
          //$(this).parent().parent().remove();
          $(this).closest("tr").remove();
          totaluseamt0();
          //ResetNo();
      });
      $(document).on('click','.btndowingcode0,.qrimg0',function(e){
          e.preventDefault();
          //debugger;
          try{
              var btntext=$(this).text();
              var moneycode=$(this).data('moneycode');
              var rowind = $(this).closest('tr').index();
              var userconnect=$('.userconnect0').eq(rowind).val().toString().split(',');
              var usercheckid=$('#usercheckid0').val();
              var bankname=$('.bankid0 option:selected').eq(rowind).text();
              var bankid=$('.bankid0').eq(rowind).val();
              var bankrectel=$('.bankrectel0').eq(rowind).val();
              var bankrecname=$('.bankrecname0').eq(rowind).val();
              var imagepath=$('.imagepath0').eq(rowind).val();
              var customertype=$('.customertype0').eq(rowind).val();
              if(btntext=='កែកូត'){

              }else{
                  if(!userconnect.includes(usercheckid)){
                    alert(bankname + ' is not for you.')
                    return;
                  }
                  var docodeby=$(this).data('docodeby');
                  if(docodeby!='' && docodeby!=null){
                    alert('this transaction already do code.');
                    return;
                  }
              }
              $('#btnsavecode').text('Update Code');
              $('#tblcodelist').find('tbody').empty();
              //$('#divqr').css('display','none');
              $('#divcodelist').css('display','none');
              $('#dowingcodemodal').modal('show');
              if(customertype=='BANK'){
                var browseimg=$('.input_image0').eq(rowind).val();
                if(browseimg==''){
                    // $('#qrcode_image').attr('src','{{ asset('public/qrcode') }}'+ '/' + imagepath);
                    $('#qrcode_image').attr('src','{{ asset(config('helper.asset_path'))}}' + '/qrcode/' + imagepath);
                }
               // $('#divqr').css('display','block');

              }else{
                $('#divcodelist').css('display','block');

              }
              $('#accnumber').text(bankrectel);
              $('#accname').text(bankrecname);
              var sp = document.querySelector("#bankid0"+rowind);
              var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
              var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');

              var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
              var maxfee=sp.options[sp.selectedIndex].getAttribute('maxfee');

              var amt1=$('.bankamt0').eq(rowind).val();
              var cur1=$('.bankcur0 option:selected').eq(rowind).text();
              var amt2=$('.bankamtexchange0').eq(rowind).val();
              var cur2=$('.bankcursale0').eq(rowind).val();
              var curid=$('.bankcurexchange0').eq(rowind).val();
              var ex_rate=$('.bankrate0').eq(rowind).val();
              if(amt2!==''){
                $('#wingamount').val(amt2);
                $('#wingcur').val(cur2);
              }else{
                  $('#wingamount').val(amt1);
                  $('#wingcur').val(cur1);
              }

              $('#wingcur').attr('title',curid);
              $('#bankname').attr('title',bankid);
              $('#wingmaxamt').val(maxtransfer);
              $('#wingmaxfee').val(maxfee);
              $('#agenttype').val(agenttype);
              $('#txtmoneycode').val(moneycode);
              $('#rowind').val(rowind);
              $('#wingrecname').val(bankrecname);
              $('#wingrectel').val(bankrectel);
              $('#thaiamt').val(amt1 + ' THB');
              $('#exchangerate').val(ex_rate);
              $('#bankname').text(bankname + '(' + agenttype + ')')
              $('#btngeneratecode').click();

          }catch{

          }



      });
      $(document).on('click','.btncashoutcode0',function(e){
          e.preventDefault();
          //debugger;
          var hascashdrawcode=$(this).data('hascashdrawcode');
          if(hascashdrawcode>0){
            alert('already cashdraw code')
            return;
          }
          var rowind = $(this).closest('tr').index();
          var userconnect=$('.userconnect0').eq(rowind).val().toString().split(',');
          var usercheckid=$('#usercheckid0').val();
          var tranid=$('.banktid0').eq(rowind).val();
          var bankname=$('.bankid0 option:selected').eq(rowind).text();
          var thaiamt=$('.bankamt0').eq(rowind).val();
          var moneycode=$(this).data('moneycode');
          if(!userconnect.includes(usercheckid)){
            alert(bankname + ' is not for you.')
            return;
          }

          $('#tblcashdrawcodelist').find('tbody').empty();
          //debugger;
          $('#cashdrawcodemodal').modal('show');
          var sp = document.querySelector("#bankid0"+rowind);
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
          var customername=$('.bankid0 option:selected').eq(rowind).text();
          var customerid=$('#bankid0'+rowind).val();
          var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
          var maxfee=sp.options[sp.selectedIndex].getAttribute('maxfeedork');

          var amt1=$('.bankamt0').eq(rowind).val();
          var curid1=$('.bankcur0').eq(rowind).val();
          var cur1=$('.bankcur0 option:selected').eq(rowind).text();
          var amt2=$('.bankamtexchange0').eq(rowind).val();
          var cur2=$('.bankcursale0').eq(rowind).val();
          var curid2=$('.bankcurexchange0').eq(rowind).val();
          if(amt2!==''){
            $('#wingamount_out').val(amt2);
            $('#wingcur_out').val(cur2);
            $('#wingcurid_out').val(curid2);

          }else{
              $('#wingamount_out').val(amt1);
              $('#wingcur_out').val(cur1);
              $('#wingcurid_out').val(curid1);

          }
          $('#tid0_out').val(tranid);
          $('#wingmaxamt_out').val(maxtransfer);
          $('#wingmaxfee_out').val(maxfee);
          $('#agenttype_out').val(agenttype);
          $('#rowind_out').val(rowind);
          $('#customerid_out').val(customerid);
          $('#customername_out').val(customername);
          $('#thaiamt_out').val(thaiamt);
          $('#txtmoneycode_out').val(moneycode);
          $('#btngeneratecode_out').click();

      });
      $(document).on('click','.btndowingcode,.qrimg',function(e){
          e.preventDefault();
          $('#btnsavecode').text('Save Code');
          $('#tblcodelist').find('tbody').empty();
          var rowind = $(this).closest('tr').index();
          var userconnect=$('.userconnect').eq(rowind).val().toString().split(',');
          var usercheckid=$('#usercheckid').val();
          //var bankname=$('.bankname').eq(rowind).val();
          var bankid=$('.bankid').eq(rowind).val();
        //   if(!userconnect.includes(usercheckid)){
        //     alert(bankname + ' is not for you.')
        //     return;
        //   }

          var sp = document.querySelector("#bankid"+rowind);
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
          var agenttypename=sp.options[sp.selectedIndex].getAttribute('agenttypename');
          var maxtransfer=sp.options[sp.selectedIndex].getAttribute('transfer_amount');
          var customer_fee=sp.options[sp.selectedIndex].getAttribute('customer_fee');
          var transfer_fee=sp.options[sp.selectedIndex].getAttribute('transfer_fee');

          var amt1=$('.bankamt').eq(rowind).val();
          var cur1=$('.bankcur option:selected').eq(rowind).text();
          var amt2=$('.bankamtexchange').eq(rowind).val();
          var cur2=$('.bankcursale').eq(rowind).val();
          var curid=$('.bankcurexchange').eq(rowind).val();
          var ex_rate=$('.bankrate').eq(rowind).val();
          var bankname=$('.bankid option:selected').eq(rowind).text();
          var rectel=$('.bankrectel').eq(rowind).val();
          var recname=$('.bankrecname').eq(rowind).val();
          var imagepath=$('.imagepath').eq(rowind).val();
          var customertype=$('.customertype').eq(rowind).val();

          $('#dowingcodemodal').modal('show');
          //$('#divqr').css('display','none');

          //$('#divcodelist').css('display','none');
          if(customertype=='BANK'){
            var browseimg=$('.input_image').eq(rowind).val();
            if(browseimg==''){
                $('#qrcode_image').attr('src','{{ asset(config('helper.asset_path'))}}' + '/qrcode/' + imagepath);
            }else{
                //$('#qrcode_image').attr('src','file://'+ '/' + imagepath);
                //$('#qrcode_image').attr('src','file:///D:/images/download.png');
            }
            //$('#divqr').css('display','block');
            $('#tdaccnumber').text('លេខគណនី');
            $('#tdaccname').text('ឈ្មោះគណនី');
          }else{
            //$('#divcodelist').css('display','block');
            $('#tdaccnumber').text('លេខអ្នកទទួល');
            $('#tdaccname').text('ឈ្មោះអ្នកទទួល');
          }
          $('#accnumber').text(rectel);
          $('#accname').text(recname);


          if(amt2!==''){
              $('#wingamount').val(amt2);
              $('#wingcur').val(cur2);
              $('#wingamountdisplay').val(amt2 + ' ' + cur2);
          }else{
              $('#wingamount').val(amt1);
              $('#wingcur').val(cur1);
              $('#wingamountdisplay').val(amt1 + ' ' + cur1);
          }
          $('#wingcur').attr('title',curid);
          $('#bankname').attr('title',bankid);
          $('#thaiamt').val(amt1 + ' THB');
          $('#exchangerate').val(ex_rate);
          $('#wingmaxamt').val(maxtransfer);
          $('#wingmaxcuscharge').val(customer_fee);
          $('#wingmaxtransferfee').val(transfer_fee);
          $('#agenttype').val(agenttype);
          $('#agenttype').attr('title',customertype);

          $('#rowind').val(rowind);
          $('#bankname').text(bankname + '(' + agenttypename + ')')
          $('#btnwingbal').click();

      });
     function fun_generatecode()
     {
        $('#btngeneratecode').click();
     }
      function fillwingbalancenext(moneycode)
      {
        //debugger;
        var i=0;
        var baltitle=$('#wingbalance').attr('title');
        var curwing=$('#wingcur').val();
        var balusd=baltitle.split(";")[0];
        var balkhr=baltitle.split(";")[1];
        var balthb=baltitle.split(";")[2];
        var totalwingcutamount=0;
        $("tr.item").each(function() {
            $(this).find("input.txtwingcode").val(moneycode[i].split('=')[1]);
            i+=1
            totalwingcutamount +=parseFloat($(this).find("input.txtwingamt").val().replace(/,/g, ''))+parseFloat($(this).find("input.txtwingfee").val().replace(/,/g, ''))
        });

        if(curwing=='USD'){
            $('#wingbalancenext').val(formatNumber(parseFloat(balusd)- parseFloat(totalwingcutamount)) + ' USD');
        }else if(curwing=='KHR'){
            $('#wingbalancenext').val(formatNumber(parseFloat(balkhr)- parseFloat(totalwingcutamount)) + ' KHR');
        }else if(curwing=='THB'){
            $('#wingbalancenext').val(formatNumber(parseFloat(balthb)- parseFloat(totalwingcutamount)) + ' THB');
        }
      }
      $(document).on('click','#btngeneratecode',async function(e){
        e.preventDefault();
        //debugger;
        $('#tblcodelist').find('tbody').empty();
        var agenttype=$('#agenttype').val();
        var customertype=$('#agenttype').attr('title');
        if(customertype=='AGENT'){
            await gettranname('#seltranname',agenttype)
            var sp = document.querySelector("#seltranname");
            var sign=sp.options[sp.selectedIndex].getAttribute('sign');
            var agent_logo=sp.options[sp.selectedIndex].getAttribute('logo');
            // get value from <option logo="xxx.png">
            var agent_logo = sp.options[sp.selectedIndex].getAttribute('logo');
            // check if logo exists
            if (agent_logo && agent_logo !== '') {
                // build full path dynamically
                document.getElementById('qrcode_image').src = "{{ asset(config('helper.asset_path').'/logo') }}/" + agent_logo;
            } else {
                // fallback to default
                document.getElementById('qrcode_image').src = "{{ asset(config('helper.asset_path').'/logo/noqr.png') }}";
            }
        }else{
            sign=1;
        }
        var maxamtstr=$('#wingmaxamt').val().replace(/,/g,'');
        var customer_fee=$('#wingmaxcuscharge').val().replace(/,/g,'');
        var transfer_fee=$('#wingmaxtransferfee').val().replace(/,/g,'');
        var moneycode=$('#txtmoneycode').val().split('<br>');
        var maxamtby=maxamtstr.split('/');
        var maxcustomerchargeby=customer_fee.split('/');
        var maxtransferfeeby=transfer_fee.split('/');

        var maxamt=maxamtby[0];
        var maxfee=parseFloat(maxcustomerchargeby[0]) - parseFloat(maxtransferfeeby[0]);

        var cur="USD";
        if($('#wingcur').val()=='KHR'){
            maxamt=maxamtby[1];
            maxfee=parseFloat(maxcustomerchargeby[1]) - parseFloat(maxtransferfeeby[1]);
            cur="KHR";
        }
        if($('#wingcur').val()=='THB'){
            maxamt=maxamtby[2];
            maxfee=parseFloat(maxcustomerchargeby[2]) - parseFloat(maxtransferfeeby[2]);
            cur="THB";
        }
        var amount=$('#wingamount').val().replace(/,/g, '');
        var wingcur=$('#wingcur').val();
        var result=Math.floor(amount / maxamt);
        var somnal=amount % maxamt;
        if(maxamt==0 || maxamt===undefined || maxamt===null){
            //alert('we can not generate code with transfer max amount zero.')
            var data=`
                <tr class="item">
                    <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt kh22 tdcanenter" style="text-align:right;" value="${formatNumber(amount)}" readonly></td>
                    <td class="kh22">${wingcur}</td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingcode kh22 tdcanenter"></td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingfee kh22 tdcanenter" style="text-align:right;" value="0"></td>
                </tr>
            `;
            $('#tblcodelist').find('tbody').append(data);
            fillbalance(amount,'-');
            return;
        }
        for(let i=0;i<result;i++){
            var data=`
                <tr class="item">
                    <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt kh22 tdcanenter" value="${formatNumber(maxamt)}" readonly></td>
                    <td class="kh22">${cur}</td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingcode kh22 tdcanenter"></td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingfee kh22 tdcanenter" value="${formatNumber(maxfee)}"></td>
                </tr>
            `;
            $('#tblcodelist').find('tbody').append(data);
        }
        if(somnal!==0){

              var response = findRates(agenttype, somnal,$('#seltranname').val(), cur);
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

                        totalcuscharge = cuscharge;
                        totalfee = parseFloat(cuscharge) - parseFloat(transfer);

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

                        totalfee = cashdraw;
                        $('#fee').val();
                    }
                }
                 var data=`
                    <tr class="item">
                        <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt kh22 tdcanenter" value="${formatNumber(somnal.toFixed(2))}" readonly></td>
                        <td class="kh22">${cur}</td>
                        <td style="padding:0px;"><input type="text" class="form-control txtwingcode kh22 tdcanenter"></td>
                        <td style="padding:0px;"><input type="text" class="form-control txtwingfee kh22 tdcanenter" value="${formatNumber(totalfee)}"></td>
                    </tr>
                `;
                $('#tblcodelist').find('tbody').append(data);
            //var url="{{ route('thaicashdraw.getwingfee') }}";
            // $.get(url,{agenttype:agenttype,amount:somnal,cur:cur},function(data){

            //     var data=`
            //         <tr class="item">
            //             <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt kh22 tdcanenter" value="${formatNumber(somnal.toFixed(2))}" readonly></td>
            //             <td class="kh22">${cur}</td>
            //             <td style="padding:0px;"><input type="text" class="form-control txtwingcode kh22 tdcanenter"></td>
            //             <td style="padding:0px;"><input type="text" class="form-control txtwingfee kh22 tdcanenter" value="${formatNumber(data['wingfee'].customer_rate-data['wingfee'].transfer_rate)}"></td>
            //         </tr>
            //     `;
            //     $('#tblcodelist').find('tbody').append(data);
            // })
        }

        var total=0;
        $("tr.item").each(function() {
            total +=parseFloat($(this).find("input.txtwingamt").val().replace(/,/g, ''))+parseFloat($(this).find("input.txtwingfee").val().replace(/,/g, ''))
        });
        fillbalance(total,'-');
        $('.txtwingamt').toArray().forEach(function(field){
              new Cleave(field, {
                  numeral: true,
                  numeralPositiveOnly: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
            })
        $('.txtwingfee').toArray().forEach(function(field){
              new Cleave(field, {
                  numeral: true,
                  numeralPositiveOnly: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
            })
      })
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
      function gettranname(el,agenttype) {
            return new Promise((resolve, reject) => {
                $('body').addClass("wait");
                var url = "{{ route('thaicashdraw.getagenttranname') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: { agenttype: agenttype },
                    success: function (data) {
                        console.log(data)
                        if ($.isEmptyObject(data.error)) {
                            $(el).empty();

                            // $(el).append($("<option/>",{
                            //     value:'',
                            //     text:''
                            // }))

                            $.each(data['trannames'],function(i,item){
                                $(el).append($("<option/>",{
                                        value:item.id,
                                        text:item.name,
                                        sign:item.sign,
                                        is_tc:item.is_tc??0,
                                        logo: item.agenttype?.logo ?? ''
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

      $(document).on('click','#btngeneratecode_out',function(e){
        e.preventDefault();
        //debugger;
        $('#tblcashdrawcodelist').find('tbody').empty();
        var agenttype=$('#agenttype_out').val();
        var maxamtstr=$('#wingmaxamt_out').val().replace(/,/g,'');
        var maxfeestr=$('#wingmaxfee_out').val().replace(/,/g,'');
        var moneycode=$('#txtmoneycode_out').val().split('<br>');
        var maxamtby=maxamtstr.split('/');
        var maxfeeby=maxfeestr.split('/');

        var maxamt=maxamtby[0];
        var maxfee=maxfeeby[0];
        var cur="USD";
        if($('#wingcur_out').val()=='KHR'){
            maxamt=maxamtby[1];
            maxfee=maxfeeby[1];
            cur="KHR";
        }
        if($('#wingcur_out').val()=='THB'){
            maxamt=maxamtby[2];
            maxfee=maxfeeby[2];
            cur="THB";
        }
        var amount=$('#wingamount_out').val().replace(/,/g, '');
        var wingcur=$('#wingcur_out').val();
        var result=Math.floor(amount / maxamt);
        var somnal=amount % maxamt;
        if(maxamt==0 || maxamt===undefined || maxamt===null){
            //alert('we can not generate code with transfer max amount zero.')
            var data=`
                <tr class="item_out">
                    <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt_out kh22 tdcanenter" style="text-align:right;" value="${formatNumber(amount)}"></td>
                    <td class="kh22">${wingcur}</td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingcode_out kh22 tdcanenter"></td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingfee_out kh22 tdcanenter" style="text-align:right;" value="0"></td>
                </tr>
            `;
            $('#tblcashdrawcodelist').find('tbody').append(data);
            return;
        }
        for(let i=0;i<result;i++){
            var data=`
                <tr class="item_out">
                    <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt_out kh22 tdcanenter" value="${formatNumber(maxamt)}"></td>
                    <td class="kh22">${cur}</td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingcode_out kh22 tdcanenter"></td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingfee_out kh22 tdcanenter" value="${formatNumber(maxfee)}"></td>
                </tr>
            `;
            $('#tblcashdrawcodelist').find('tbody').append(data);
        }
        if(somnal!==0){
            var url="{{ route('thaicashdraw.getwingfee') }}";
            $.get(url,{agenttype:agenttype,amount:somnal,cur:cur},function(data){

                var data=`
                    <tr class="item_out">
                        <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt_out kh22 tdcanenter" value="${formatNumber(somnal.toFixed(2))}"></td>
                        <td class="kh22">${cur}</td>
                        <td style="padding:0px;"><input type="text" class="form-control txtwingcode_out kh22 tdcanenter"></td>
                        <td style="padding:0px;"><input type="text" class="form-control txtwingfee_out kh22 tdcanenter" value="${formatNumber(data['wingfee'].cashdraw_rate)}"></td>
                    </tr>
                `;
                $('#tblcashdrawcodelist').find('tbody').append(data);
            })
        }
        var i=0;
        $("tr.item_out").each(function() {
            $(this).find("input.txtwingcode_out").val(moneycode[i].split('=')[1]);
            i+=1
        });

      })
      $(document).on('click','#btncashdrawcode',function(e){
        e.preventDefault();
        //debugger;
        $('body').addClass("wait");
        var totalfee=0;
        for(i=0; i<$('.txtwingfee_out').length; i++) {
            fee = $('.txtwingfee_out').eq(i).val().replace(/,/g,'');
            totalfee += parseFloat(fee);
        }
        var formdata=new FormData();
        formdata.append('refgroupid',$('#groupid0').val());
        formdata.append('wingamount_out',$('#wingamount_out').val());
        formdata.append('wingcurid_out',$('#wingcurid_out').val());
        formdata.append('wingfee_out',totalfee);
        formdata.append('customerid_out',$('#customerid_out').val());
        formdata.append('customername_out',$('#customername_out').val());
        formdata.append('tranid',$('#tid0_out').val());
        formdata.append('thaiamt',$('#thaiamt_out').val());


        var url="{{ route('thaicashdraw.savecashdrawwingcode') }}"
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                success: function (data) {

                    if($.isEmptyObject(data.error)){
                        $('#cashdrawcodemodal').modal('hide');
                        //$('#cashdrawmodal0').modal('hide');
                        del_userselectcashdraw0($('#transfer_id0').val());
                        openedit($('#transfer_id0').val(),$('#groupid0').val());
                        $('body').removeClass("wait");

                    }else{
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Save Error.')

                }

            })

      })
      $(document).on('click','#btncancelcode',function(e){
            var rowind=$('#rowind').val();
            $('.wingcodeinfo').eq(rowind).val('');
            $('.wingcodeinfotd').eq(rowind).html('');
            $('.wingcodeinfoby').eq(rowind).val('');
            $('.bankseva').eq(rowind).val(0);
            $('.btndowingcode').eq(rowind).attr('title','');
            $('#dowingcodemodal').modal('hide');
      })
      $(document).on('click','#btnsavecode_qr',function(e){
        e.preventDefault();
        debugger;
        var rowind=$('#rowind_qr').val();
        var filepath=$('#image').val();
        $('.wingcodeinfo').eq(rowind).val(filepath);
            $('.wingcodeinfotd').eq(rowind).html(filepath);
            $('.wingcodeinfoby').eq(rowind).val($('#docodeby_qr').val());
            $('#qrcodemodal').modal('hide');


      })
      $(document).on('click','#btnsavecode',function(e){
        var totalfee=0;
        var codestr='';
        var rowind=$('#rowind').val();
        var foundemptycode=false;
        $("tr.item").each(function() {
            //debugger;
            var wingamt = $(this).find("input.txtwingamt").val();
            var wingcode= $(this).find("input.txtwingcode").val();
            if(wingcode==''){
                foundemptycode=true;
            }
            var wingcur=$(this).find("td:eq(1)").text();
            if(wingcur=='USD'){
                wingcur='ដុល្លា';
            }else if(wingcur=='KHR'){
                wingcur='រៀល';
            }else if(wingcur=='THB'){
                wingcur='បាត';
            }
            if(wingcode==''){
                wingcode=$('#bankname').text();
            }
            var wingfee=$(this).find("input.txtwingfee").val().replace(/,/g,'');
            totalfee += parseFloat(wingfee);
            if(codestr==''){
                codestr = wingamt + ' ' + wingcur + '=' + wingcode + '=' + wingfee;
            }else{
                codestr +='<br>' + wingamt + ' ' + wingcur + '=' + wingcode + '=' + wingfee;
            }

        });
        if(foundemptycode==true){
            alert('please fill all blank code');
            return;
        }
        if(codestr==''){
            alert('no item code found');
            return;
        }else{
            //codestr +='<br>' + $('#docodebyname').val();
        }
        var btntext=$(this).text();
        //debugger;
        if(btntext=='Update Code'){
            $('.wingcodeinfo0').eq(rowind).val(codestr);
            $('.wingcodeinfotd0').eq(rowind).html(codestr);
            $('.wingcodeinfoby0').eq(rowind).val($('#docodeby').val());
            $('.bankseva0').eq(rowind).val(formatNumber(totalfee));
            $('.btndowingcode0').eq(rowind).attr('title',$('#usercheckid0').val());
        }else{
            $('.wingcodeinfo').eq(rowind).val(codestr);
            $('.wingcodeinfotd').eq(rowind).html(codestr);
            $('.wingcodeinfoby').eq(rowind).val($('#docodeby').val());
            $('.bankseva').eq(rowind).val(formatNumber(totalfee));
            $('.btndowingcode').eq(rowind).attr('title',$('#usercheckid').val());
        }
        $('#dowingcodemodal').modal('hide');
      })
      $(document).on('click','#btnresetexchange0',function(e){
            e.preventDefault();
            var q = confirm("Do you want to reset exchange record?");
            if (!q) return;
            $('#body_exchangedata0').empty();
            var groupid=$('#groupid0').val();
            var url="{{ route('thaicashdraw1.resetexchange') }}";
            $.get(url,{groupid:groupid},function(data){


                for(var i=0;i<data['exchanges'].length;i++){
                    row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh22">${i+1}</td>
                        <td class="kh16" style="padding:0px;width:150px;">
                           ${data['exchanges'][i].id}
                        </td>
                        <td class="kh16" style="padding:0px;width:150px;">
                             ${moment(data['exchanges'][i].dd).format("DD-MM-YYYY")}
                        </td>
                        <td class="kh16" style="width:150px;padding:0px;">
                            ${data['exchanges'][i].tt}
                        </td>
                         <td class="kh22" style="width:200px;padding:0px;text-align:right;">
                            ${formatNumber(data['exchanges'][i].product)}
                            ${data['exchanges'][i].pcur}
                        </td>
                         <td class="kh22" style="width:200px;padding:0px;text-align:right;">
                             ${formatNumber(data['exchanges'][i].amount)}
                             ${ data['exchanges'][i].maincur}
                        </td>
                         <td class="kh22" style="width:200px;padding:0px;text-align:right;">
                            ${formatNumber(data['exchanges'][i].rate)}
                        </td>

                    </tr>`;

                    $('#body_exchangedata0').append(row);

                }
                var table = document.getElementById("tbl_exchangedata0");
                //var totalRowCount = table.rows.length; // 5
                var tbodyRowCount = table.tBodies[0].rows.length; // 3
                if(tbodyRowCount==0){
                    $('.bankcurexchange0').each(function(i,e){
                        $(this).attr('disabled',false);
                        $('.bankrate0').eq(i).attr('readonly',false);
                    })
                }
            })

        })
      $(document).on('change','.bankid',function(e){
          e.preventDefault();
          try{
              var rowind = $(this).closest('tr').index();
              var bankname=$('.bankid option:selected').eq(rowind).text();
              var sp = document.querySelector("#bankid"+rowind);
              var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
              var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttypename');
              var userconnect=sp.options[sp.selectedIndex].getAttribute('userconnect');
              $('.customertype').eq(rowind).val(customertype);
              $('.agenttype').eq(rowind).val(agenttype);
              $('.userconnect').eq(rowind).val(userconnect);
              $('.bankname').eq(rowind).val(bankname);
              if(customertype=='BANK'){
                $('.btndowingcode').eq(rowind).css('display','none');
                $('.qrimg').eq(rowind).css('display','inline');
                $('.input_image').eq(rowind).css('display','inline');
                $('.imagepath').eq(rowind).val($('.qrimg').eq(rowind).attr('title'));
              }else{
                  $('.btndowingcode').eq(rowind).css('display','inline');
                  $('.qrimg').eq(rowind).css('display','none');
                  $('.input_image').eq(rowind).css('display','none');
                  $('.imagepath').eq(rowind).val('');
                  //$('.btndowingcode').eq(rowind).text(customertype + ' Code');
              }
          }catch{

          }

      })
      $(document).on('change','.bankid0',function(e){
          e.preventDefault();
          //debugger;
          //$('.select2-selection__rendered').removeAttr('title');
          //var rowind = $(this).closest('tr').index();
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          var bankname=$('.bankid0 option:selected').eq(rowind).text();
          var sp = document.querySelector("#bankid0"+rowind);
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
          var userconnect=sp.options[sp.selectedIndex].getAttribute('userconnect');

          $('.customertype0').eq(rowind).val(customertype);
          $('.agenttype0').eq(rowind).val(agenttype);
          $('.userconnect0').eq(rowind).val(userconnect);
          //$('.bankname0').eq(rowind).val(bankname);

      })
      function addrow(){
            //var nn=$('#tbl_bankpayment tr').length+1;
            //debugger;
            var table = document.getElementById("tbl_bankpayment");
            var nn=table.tBodies[0].rows.length;
            let tst = Math.round(Date.now() / 1000)+nn;
            var row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh16">${nn}</td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control bankname kh22" style="" name="bankname[]">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control customertype kh22" style="" name="customertype[]">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control agenttype kh22" style="" name="agenttype[]">
                        </td>
                         <td style="padding:0px;display:none;">
                            <input type="text" class="form-control userconnect kh22" style="" name="userconnect[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamt kh16-b" style="text-align:right;width:120px;" name="bankamt[]">
                        </td>
                        <td style="width:100px;padding:0px;">
                            <select name="bankcur[]" class="form-select bankcur kh16-b" id="bankcur${nn}" style="width:100px;" title=""></select>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrectel kh16-b" style="width:180px;" name="bankrectel[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="button" class="btn btn-warning btncounttel kh16-b" style="width:50px;" value="">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrecname kh16-b" style="width:180px;" name="bankrecname[]">
                        </td>
                         <td style="width:100px;padding:0px;">
                            <select name="bankcurexchange[]" class="form-select bankcurexchange kh16-b" id="bankcurexchange${nn}" style="width:100px;"></select>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrate kh16-b" style="width:80px;" name="bankrate[]">

                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamtexchange kh16-b" style="width:150px;text-align:right;" name="bankamtexchange[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankcursale kh16-b" style="width:80px;" name="bankcursale[]">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankcurbuy kh16-b" style="" name="bankcurbuy[]">
                        </td>

                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankbuyinfo kh16-b" style="" name="bankbuyinfo[]">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter banksaleinfo kh16-b" style="" name="banksaleinfo[]">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankrateinfo kh16-b" style="" name="bankrateinfo[]">
                        </td>
                        <td style="width:200px;padding:0px;">
                            <select name="bankid[]" class="form-select select2-option1 bankid " id="bankid${nn}"  style="width:200px;"></select>
                        </td>
                        <td style="text-align:center;padding:0px 0px 0px 0px;width:150px;">
                            <a href="#" class="btn btn-danger btn-sm remove" style="border-radius:15px;"><i class="fa fa-minus"></i></a>
                            <a href="#" class="btn btn-info btn-sm btndowingcode" style="border-radius:15px;" title="">WingCode</a>
                            <img src="{{ asset('public/logo/noqr.png') }}" alt="" class="qrimg" style="width:35px;height:35px;display:none;">
                            <input type="file" name="input_image[]" class="input_image" accept="image/x-png,image/png,image/jpg,image/jpeg,image/webp" style="width:90px;display:none;">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter wingcodeinfo kh16-b" style="" name="wingcodeinfo[]">
                            <input type="text" class="form-control tdcanenter imagepath kh16-b" style="" name="imagepath[]">
                        </td>

                        <td class="wingcodeinfotd kh16-b" style="padding:0px;">
                        </td>
                         <td style="display:none;">
                            <input type="text" class="tdcanenter wingcodeinfoby kh16-b" style="width:150px;border-style:none;" name="wingcodeinfoby[]">
                        </td>

                         <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankseva kh16-b" style="text-align:right;width:80px;" name="bankseva[]" value="0">
                        </td>
                    </tr>`;
                $('#body_bankpayment').append(row);

                //$('.unit option').remove();

                $('#selcurthai option').clone().appendTo('#bankcur'+nn);
                $('#selcur_continue option').clone().appendTo('#bankcurexchange'+nn);

                 $('#selbank option').clone().appendTo('#bankid'+nn);

                $('#bankid'+nn).select2({
                  dropdownParent: $("#cashdrawmodal"),
                  //templateResult: formatOption1
                });
                $('.bankamt').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
                $('.bankseva').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
                autocomplereceiver($('.bankrectel'),$('.bankrecname'),$('.qrimg'),$('.imagepath'));
                // getphonenumber($('.bankrectel'),$('.bankrecname'),$('.qrimg'),$('.imagepath'));
                // getreceivename($('.bankrectel'),$('.bankrecname'),$('.qrimg'),$('.imagepath'));

                autofillbankamt();
                $('#bankamt'+ nn).focus();

                //number('.barcode',true);
                //window.scrollTo(0, document.body.scrollHeight);


        }


        $(document).on('change','.bankcurexchange',function(e){
            e.preventDefault();
            var rowind=$(this).closest('tr').index();
            var cursale=$('.bankcurexchange option:selected').eq(rowind).text();
            $('.bankcursale').eq(rowind).val(cursale);
            $('.bankrate').eq(rowind).val('');
            $('.bankamtexchange').eq(rowind).val('');
            $('.banksaleinfo').eq(rowind).val('');
            $('.bankrateinfo').eq(rowind).val('');

            getcurrencybyidlocalstorage($(this).val(),$(this),$('.banksaleinfo').eq(rowind),rowind,$('.bankamt'),$('.bankrate'),$('.bankamtexchange'),$('.bankrateinfo'),$('.bankcur'),$('.bankcurexchange'),$('.bankcur option:selected').eq(rowind).text(),$('.bankcurexchange option:selected').eq(rowind).text())
        })

        $(document).on('change','.bankcur',function(e){
            e.preventDefault();
            var rowind=$(this).closest('tr').index();
             var curbuy=$('.bankcur option:selected').eq(rowind).text();
            $('.bankcurbuy').eq(rowind).val(curbuy);
            getcurrencybyidlocalstorage($(this).val(),$(this),$('.bankbuyinfo').eq(rowind),rowind,$('.bankamt'),$('.bankrate'),$('.bankamtexchange'),$('.bankrateinfo'),$('.bankcur'),$('.bankcurexchange'),$('.bankcur option:selected').eq(rowind).text(),$('.bankcurexchange option:selected').eq(rowind).text())
        })
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

            })
        });
        $(document).on('click','#btnaddrow0',function(e){
            e.preventDefault();
            addrow0();
        })
        function addrow0(){
            //var nn=$('#tbl_bankpayment tr').length+1;
            //debugger;
            var table = document.getElementById("tbl_bankpayment0");
            var nn=parseFloat($('#btnaddrow0').attr('title'))+1;
            $('#btnaddrow0').attr('title',nn);
            let tst = Math.round(Date.now() / 1000)+nn;
            row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh16">${nn}</td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control banktid0 kh16" style="width:100px;" name="banktid0[]" value="" readonly>
                        </td>
                        <td style="width:200px;padding:0px;">
                            <select name="bankid0[]" class="form-select select2-option1 bankid0" id="bankid0${nn}"  style="width:200px;"></select>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control customertype0 kh22" style="" name="customertype0[]" value="">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control agenttype0 kh22" style="" name="agenttype0[]" value="">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control userconnect0 kh22" style="" name="userconnect0[]" value="">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamt0 kh16-b" style="text-align:right;width:130px;" name="bankamt0[]" value="" title=""  >
                        </td>
                        <td style="width:100px;padding:0px;">
                            <select name="bankcur0[]" class="form-select bankcur0 kh16-b" id="bankcur0${nn}" style="width:100px;" title=""></select>
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrectel0 kh14-b" style="width:150px;height:38px;padding:8px 5px 5px 5px;" name="bankrectel0[]" value="">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrecname0 kh14-b" style="width:150px;height:38px;padding:8px 5px 5px 5px;" name="bankrecname0[]" value="">
                        </td>
                         <td style="width:100px;padding:0px;">
                            <select name="bankcurexchange0[]" class="form-select bankcurexchange0 kh16-b" id="bankcurexchange0${nn}" style="width:100px;"></select>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrate0 kh16-b" style="width:100px;" name="bankrate0[]" value="" readonly title="">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamtexchange0 kh16-b" style="width:130px;text-align:right;" name="bankamtexchange0[]" value="" readonly>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankcursale0 kh16-b" style="width:70px;" name="bankcursale0[]" id="bankcursale0${nn}" readonly>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="tdcanenter cuscharge0 kh12-b" style="width:100px;text-align:right;" name="cuscharge0[]" value="" >
                            <div class="form-check" style="margin-top:-3px;">
                                <label class="form-check-label kh14-b" style="">
                                    <input class="form-check-input ckcuscharge0" type="checkbox" name="ckcuscharge0" id="ckcuscharge0${nn}" style="">ដកទឹក
                                </label>
                            </div>
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter totalamt0 kh16-b" style="width:130px;text-align:right;" name="totalamt0[]" value="" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankcurbuy0 kh16-b" style="" name="bankcurbuy0[]" id="bankcurbuy0${nn}" readonly>
                        </td>

                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankbuyinfo0 kh16-b" style="" name="bankbuyinfo0[]" value="" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter banksaleinfo0 kh22" style="" name="banksaleinfo0[]" value="" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankrateinfo0 kh16-b" style="" name="bankrateinfo0[]" value="" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter wingcodeinfo0 kh22" style="" name="wingcodeinfo0[]" value="" title="">
                            <input type="text" class="form-control tdcanenter cashdrawcodeid0 kh22" style="" name="cashdrawcodeid0[]" value="">

                        </td>
                         <td style="text-align:center;padding:0px;">
                            <a href="#" class="btn btn-danger btn-sm remove0" style="border-radius:15px;"><i class="fa fa-minus"></i></a>
                            <a href="#" class="btn btn-info btndowingcode0 kh14-b" style="border-radius:15px;width:60px;"  title="">ធ្វើកូត</a>
                        </td>
                        <td class="wingcodeinfotd0 kh14-b" style="padding:0px 5px 0px 5px;">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter wingcodeinfoby0 kh22" style="" name="wingcodeinfoby0[]" value="">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankseva0 kh16-b" style="text-align:right;width:80px;" name="bankseva0[]" value="">
                        </td>
                    </tr>`;


                $('#body_bankpayment0').append(row);

                //$('.unit option').remove();

                $('#selcurthai option').clone().appendTo('#bankcur0'+nn);
                $('#selcur_continue option').clone().appendTo('#bankcurexchange0'+nn);

                 $('#selbank option').clone().appendTo('#bankid0'+nn);

                $('#bankid0'+nn).select2({
                  dropdownParent: $("#cashdrawmodal0"),
                  //templateResult: formatOption1
                });
                $('.bankamt0').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
                $('.cuscharge0').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
                autocomplereceiver($('.bankrectel0'),$('.bankrecname0'),$('.qrimg0'),$('.imagepath0'));
                // getphonenumber($('.bankrectel0'),$('.bankrecname0'),$('.qrimg0'),$('.imagepath0'));
                // getreceivename($('.bankrectel0'),$('.bankrecname0'),$('.qrimg0'),$('.imagepath0'));
                $('#bankamt0'+ nn).focus();
                filltitlebankcur($('#bankcur0' + nn).val(),$('#bankcur0' + nn));
                //number('.barcode',true);
                //window.scrollTo(0, document.body.scrollHeight);


        }
        $(document).on('change','.txtwingfee',function(e){
            e.preventDefault();
            var total=0;
            $("tr.item").each(function() {
                total +=parseFloat($(this).find("input.txtwingamt").val().replace(/,/g, ''))+parseFloat($(this).find("input.txtwingfee").val().replace(/,/g, ''))
            });
            fillbalance(total,'-');
      })
        $(document).on('click','#btnwingbal',function(e){
                // e.preventDefault();
                // getwingbalance(fun_generatecode)
                var total=0;

                $("tr.item").each(function() {
                    total +=parseFloat($(this).find("input.txtwingamt").val().replace(/,/g, ''))+parseFloat($(this).find("input.txtwingfee").val().replace(/,/g, ''))
                });

                var cid=$('#bankname').attr('title');
                var curid=$('#wingcur').attr('title');

                getbalwing(cid,total,curid,fun_generatecode);

        })
        function getbalwing(cid,total,cur,callback)
      {
        //debugger;
        $('body').addClass("wait");
        $('#wingbalance').attr('title','');
                var d2=moment(new Date).format("YYYY-MMM-DD");
                var op='<=';
                var url="{{ route('closelist.summarypartnerlist') }}";
                $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {cid:cid,showdate:d2,op:op},
                success: function (data) {

                    if($.isEmptyObject(data.error)){
                        $('#wingbalance').attr('title',data.usd+';'+data.khr+';'+data.thb);
                        callback(total,'-');
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
      function fillbalance(total,sign)
      {
        //debugger;

        try{

            var bal=$('#wingbalance').attr('title').replace(/,/g, '');
            var balance=bal.split(';');
            var cur=$('#wingcur').val();
            var balnext=0;
            var balstart=0;
            var cur1='';
            if(sign=='+'){
                if(cur=='USD'){
                    balnext=-1 * (parseFloat(balance[0])- parseFloat(total));
                    balstart=-1 * parseFloat(balance[0]);
                    cur1=' USD';
                }else if(cur=='KHR'){
                    balnext=-1 * (parseFloat(balance[1])- parseFloat(total));
                    balstart=-1 * parseFloat(balance[1]);
                    cur1=' KHR';
                }else if(cur=='THB'){
                    balnext=-1 * (parseFloat(balance[2])- parseFloat(total));
                    balstart=-1 * parseFloat(balance[2]);
                    cur1=' THB';
                }

            }else{
                if(cur=='USD'){
                    balnext=-1 * (parseFloat(balance[0])+ parseFloat(total));
                    balstart=-1 * parseFloat(balance[0]);
                    cur1=' USD';
                }else if(cur=='KHR'){
                    balnext=-1 * (parseFloat(balance[1])+ parseFloat(total));
                    balstart=-1 * parseFloat(balance[1]);
                    cur1=' KHR';
                }else if(cur=='THB'){
                    balnext=-1 * (parseFloat(balance[2])+ parseFloat(total));
                    balstart=-1 * parseFloat(balance[2]);
                    cur1=' THB';
                }
            }
            $('#wingbalancenext').val(formatNumber(balnext) + cur1);
            $('#wingbalance').val(formatNumber(balstart) + cur1);
            if(balstart>0){
                $('#wingbalance').css('color','blue');
            }else{
                $('#wingbalance').css('color','red');
            }
            if(balnext>0){
                $('#wingbalancenext').css('color','blue');
            }else{
                $('#wingbalancenext').css('color','red');
            }
        }catch{

        }

      }
        // function getwingbalance(callback)
        // {
        //     $('body').addClass("wait");
        //         $('#wingbalance').val('');
        //         var amt=0;
        //         var fee=0;
        //         var total=0;
        //         var cid=$('#bankname').attr('title');
        //         var curid=$('#wingcur').attr('title');
        //         var cur=$('#wingcur').val();
        //         var d2=$('#h1_date').text();
        //         //var id=$('#transferid3').val();
        //         var op='<=';
        //         //var url="{{ route('thaicashdraw.getpartnerbalancebycur') }}";
        //         var url="{{ route('closelist.summarypartnerlist') }}";

        //         $.ajax({
        //         async: true,
        //         type: 'GET',
        //         url: url,
        //         //data: {cid:cid,showdate:d2,curid:curid,curshortcut:curshortcut,id:id},
        //         data: {cid:cid,showdate:d2,op:op},
        //         success: function (data) {
        //             //console.log(data)

        //             if($.isEmptyObject(data.error)){
        //                 $('#wingbalance').attr('title',Math.abs(data.usd)+';'+Math.abs(data.khr)+';'+Math.abs(data.thb));
        //                 //$('#wingbalance').val(formatNumber(Math.abs(data.balance)) + ' ' + cur);
        //                 if(cur=='USD'){
        //                     $('#wingbalance').val(formatNumber(Math.abs(data.usd)) + ' ' + cur);
        //                 }else if(cur=='KHR'){
        //                     $('#wingbalance').val(formatNumber(Math.abs(data.khr)) + ' ' + cur);
        //                 }else if(cur=='THB'){
        //                     $('#wingbalance').val(formatNumber(Math.abs(data.thb)) + ' ' + cur);
        //                 }
        //                 callback();
        //                 $('body').removeClass("wait");
        //             }else{
        //                 $('body').removeClass("wait");
        //                 alert(data.error)
        //             }
        //         },
        //         error: function () {
        //             $('body').removeClass("wait");
        //             alert('Read Error.')
        //         }

        //     })
        // }
        $(document).on('click','.btnedit',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            var smsid=$(this).data('smsid');
            var groupid=$(this).data('groupid');
            var amount=$(this).data('amount');
            var cutseva=$(this).data('cutseva');

            openedit(id,groupid,amount,cutseva);
        })
        function openedit(id,groupid,amount,cutseva)
        {
            closemodalfrom='';
            $('#frmcashdraw0').trigger('reset');
            $("#tbl_bankpayment0 tbody tr").remove();
            $('#body_bankpayment0').empty();
            $('#body_exchangedata0').empty();
            $('#transfer_id0').val(id);
            $('#groupid0').val(groupid);
            $('#openamt0').val(formatNumber(amount-cutseva));

            var url="{{ route('thaicashdraw1.opencashdraw1') }}";
            $.get(url,{id:id,groupid:groupid},function(data){

                //debugger;
                if(data.error==true){//if return view
                    alert('You can not open this money.\n' + data.errorsms);
                    return;
                }
                $('#cashdrawmodal0').modal('show');

                var row='';
                for(var i=0;i<data['transfers'].length;i++){
                    row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh16">${i}</td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control banktid0 kh16" style="width:100px;" name="banktid0[]" value="${data['transfers'][i].id}" readonly>
                        </td>
                        <td style="width:200px;padding:0px;">
                            <select name="bankid0[]" class="form-select select2-option1 bankid0" id="bankid0${i}"  style="width:200px;"></select>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control customertype0 kh22" style="" name="customertype0[]" value="${data['transfers'][i].partner.customertype??''}">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control agenttype0 kh22" style="" name="agenttype0[]" value="${data['transfers'][i].partner.agent_type_id??''}">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control userconnect0 kh22" style="" name="userconnect0[]" value="${data['transfers'][i].partner.user_connect??''}">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamt0 kh16-b" style="text-align:right;width:130px;" name="bankamt0[]" value="${formatNumber(data['transfers'][i].thai_amt)}" title="${data['transfers'][i].partner.name}" ${data['transfers'][i].cashdraw_codeid?'':'readonly'} >
                        </td>
                        <td style="width:100px;padding:0px;">
                            <select name="bankcur0[]" class="form-select bankcur0 kh16-b" id="bankcur0${i}" style="width:100px;" title="${data['transfers'][i].th_buyinfo}"></select>
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrectel0 kh14-b" style="width:150px;height:38px;padding:8px 5px 5px 5px;" name="bankrectel0[]" value="${data['transfers'][i].rectel??''}">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrecname0 kh14-b" style="width:150px;height:38px;padding:8px 5px 5px 5px;" name="bankrecname0[]" value="${data['transfers'][i].recname??''}">
                        </td>
                         <td style="width:100px;padding:0px;">
                            <select name="bankcurexchange0[]" class="form-select bankcurexchange0 kh16-b" id="bankcurexchange0${i}" style="width:100px;" disabled></select>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrate0 kh16-b" style="width:100px;" name="bankrate0[]" value="${data['transfers'][i].th_rate??''}" readonly title="${data['transfers'][i].th_rateinfo??''}">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamtexchange0 kh16-b" style="width:130px;text-align:right;" name="bankamtexchange0[]" title="${data['transfers'][i].th_rate?formatNumber(data['transfers'][i].amount):''}" value="${data['transfers'][i].th_rate?formatNumber(data['transfers'][i].amount):''}" readonly>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankcursale0 kh16-b" style="width:70px;" name="bankcursale0[]" id="bankcursale0${i}" readonly>
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="tdcanenter cuscharge0 kh12-b" style="width:100px;text-align:right;" name="cuscharge0[]" value="${data['transfers'][i].cuscharge}" >
                            <div class="form-check" style="margin-top:-3px;">
                                <label class="form-check-label kh14-b" style="">
                                    <input class="form-check-input ckcuscharge0" type="checkbox" name="ckcuscharge0" id="ckcuscharge0${i}" style="">ដកទឹក
                                </label>
                            </div>
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter totalamt0 kh16-b" style="width:130px;text-align:right;" name="totalamt0[]" value="${data['transfers'][i].th_rate?formatNumber(data['transfers'][i].amount):''}" readonly>
                        </td>

                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankcurbuy0 kh16-b" style="" name="bankcurbuy0[]" id="bankcurbuy0${i}" readonly>
                        </td>

                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankbuyinfo0 kh16-b" style="" name="bankbuyinfo0[]" value="${data['transfers'][i].th_buyinfo??''}" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter banksaleinfo0 kh22" style="" name="banksaleinfo0[]" value="${data['transfers'][i].th_saleinfo??''}" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankrateinfo0 kh16-b" style="" name="bankrateinfo0[]" value="${data['transfers'][i].th_rateinfo??''}" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter wingcodeinfo0 kh22" style="" name="wingcodeinfo0[]" value="${data['transfers'][i].moneycode??''}" title="${data['transfers'][i].docodeby}">
                            <input type="text" class="form-control tdcanenter cashdrawcodeid0 kh22" style="" name="cashdrawcodeid0[]" value="${data['transfers'][i].cashdraw_codeid??''}">
                            <input type="text" class="form-control tdcanenter imagepath0 kh16-b" style="" name="imagepath0[]" value="${data['transfers'][i].qrcode??''}">
                            <input type="text" class="form-control tdcanenter imageoldpath0 kh16-b" style="" name="imageoldpath0[]" value="${data['transfers'][i].qrcode??''}">
                        </td>
                        <td style="text-align:center;padding:0px;">
                            <a href="#" class="btn btn-danger btn-sm remove0" style="border-radius:15px;${data['transfers'][i].cashdraw_codeid?'':'display:none;'}"><i class="fa fa-minus"></i></a>
                            <a href="#" class="btn btn-info btndowingcode0 kh14-b" style="border-radius:15px;width:60px;${data['transfers'][i].qrcode?'display:none;':''}" data-docodeby="${data['transfers'][i].docodeby}" data-moneycode="${data['transfers'][i].moneycode}" title="${data['transfers'][i].docodeby}">${data['transfers'][i].docodeby?'កែកូត':'ធ្វើកូត'}</a>
                            <a href="#" class="btn btn-warning btncashoutcode0 kh14-b" style="border-radius:15px;width:60px;${data['transfers'][i].docodeby?'':'display:none;'}" data-docodeby="${data['transfers'][i].docodeby}" data-moneycode="${data['transfers'][i].moneycode}" data-hascashdrawcode="${data['transfers'][i].cashdraw_codeid}" data-refgroupid="${data['transfers'][i].ref_group_id}">${data['transfers'][i].docodeby?'ដកកូត':''} </a>
                            <img src="{{ asset('public/qrcode')}}/${data['transfers'][i].qrcode}"  alt="" class="qrimg0" title="${data['transfers'][i].qrcode}" style="width:35px;height:35px;${data['transfers'][i].qrcode?'':'display:none;'}">

                        </td>
                        <td class="wingcodeinfotd0 kh14-b" style="padding:0px 5px 0px 5px;">
                            <input type="file" name="input_image0[]" class="input_image0" accept="image/x-png,image/png,image/jpg,image/jpeg,image/webp" style="${data['transfers'][i].partner.customertype=='BANK'?'':'display:none;'}">
                            ${data['transfers'][i].moneycode?data['transfers'][i].moneycode + '(' + data['transfers'][i].usercode.name + ')' :''}
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter wingcodeinfoby0 kh22" style="" name="wingcodeinfoby0[]" value="${data['transfers'][i].docodeby??''}">
                        </td>


                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankseva0 kh16-b" style="text-align:right;width:80px;" name="bankseva0[]" value="${formatNumber(data['transfers'][i].fee)}">
                        </td>
                    </tr>`;

                    $('#body_bankpayment0').append(row);
                    $('#selcurthai option').clone().appendTo('#bankcur0'+i);
                    $('#selcur_continue option').clone().appendTo('#bankcurexchange0'+i);
                    $('#selbank option').clone().appendTo('#bankid0'+i);

                    $('#btnaddrow0').attr('title',i);
                    //debugger;
                    $('#bankid0'+i).val(data['transfers'][i].parrent_id);
                    //$('#bankid0'+i).trigger('change');
                    $('#bankid0'+i).select2({
                        dropdownParent: $("#cashdrawmodal0"),
                        //templateResult: formatOption1,

                    });
                    $('#bankcur0'+i).val(data['transfers'][i].thai_cur);
                    if(data['transfers'][i].th_rate!=='' && data['transfers'][i].th_rate!==null){
                        $('#bankcurexchange0'+i).val(data['transfers'][i].currency_id);
                        $('#bankcurexchange0'+i).attr('title',data['transfers'][i].th_saleinfo);
                    }

                    var cursale=$('#bankcurexchange0' + i +' option:selected' ).text();
                    var curbuy=$('#bankcur0' + i +  ' option:selected').text();
                    $('#bankcursale0'+i).val(cursale);
                    $('#bankcurbuy0'+i).val(curbuy);

                }

                totaluseamt0();

                for(var i=0;i<data['exchanges'].length;i++){
                    row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh22">${i+1}</td>
                        <td class="kh16" style="padding:0px;width:150px;">
                           ${data['exchanges'][i].id}
                        </td>
                        <td class="kh16" style="padding:0px;width:150px;">
                             ${moment(data['exchanges'][i].dd).format("DD-MM-YYYY")}
                        </td>
                        <td class="kh16" style="width:150px;padding:0px;">
                            ${data['exchanges'][i].tt}
                        </td>
                         <td class="kh22" style="width:200px;padding:0px;text-align:right;">
                            ${formatNumber(data['exchanges'][i].product)}
                            ${data['exchanges'][i].pcur}
                        </td>
                         <td class="kh22" style="width:200px;padding:0px;text-align:right;">
                             ${formatNumber(data['exchanges'][i].amount)}
                             ${ data['exchanges'][i].maincur}
                        </td>
                         <td class="kh22" style="width:200px;padding:0px;text-align:right;">
                            ${formatNumber(data['exchanges'][i].rate)}
                        </td>

                    </tr>`;

                    $('#body_exchangedata0').append(row);
                }
                var table = document.getElementById("tbl_exchangedata0");
                //var totalRowCount = table.rows.length; // 5
                var tbodyRowCount = table.tBodies[0].rows.length; // 3
                if(tbodyRowCount==0){
                    $('.bankcurexchange0').each(function(i,e){
                        $(this).attr('disabled',false);
                        $('.bankrate0').eq(i).attr('readonly',false);
                    })
                }
                $('.bankamt0').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
                $('.bankseva0').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
            })
            autocomplereceiver($('.bankrectel0'),$('.bankrecname0'),$('.qrimg0'),$('.imagepath0'));
            // getphonenumber($('.bankrectel0'),$('.bankrecname0'),$('.qrimg0'),$('.imagepath0'));
            // getreceivename($('.bankrectel0'),$('.bankrecname0'),$('.qrimg0'),$('.imagepath0'));

        }
        $(document).on('change','.bankcurexchange0',function(e){
            e.preventDefault();
            //debugger;
            var rowind=$(this).closest('tr').index();
            var cursale=$('.bankcurexchange0 option:selected').eq(rowind).text();
            $('.bankcursale0').eq(rowind).val(cursale);
            $('.bankrate0').eq(rowind).val('');
            $('.bankamtexchange0').eq(rowind).val('');
            $('.banksaleinfo0').eq(rowind).val('');
            $('.bankrateinfo0').eq(rowind).val('');
            getcurrencybyidlocalstorage($(this).val(),$(this),$('.banksaleinfo0').eq(rowind),rowind,$('.bankamt0'),$('.bankrate0'),$('.bankamtexchange0'),$('.bankrateinfo0'),$('.bankcur0'),$('.bankcurexchange0'),$('.bankcur0 option:selected').eq(rowind).text(),$('.bankcurexchange0 option:selected').eq(rowind).text())
        })
        $(document).on('click','.btnopencashdraw,.btncontinuepartner,.btncontinuewingbank',function(e){
            e.preventDefault();
            //debugger;
            var id=$(this).data('id');
            var btn=$(this).data('classname');
            $('#divphoto').hide();
            $('#thead_img th').remove();
            $('#showPhoto').attr('src',"{{ config('helper.asset_path')}}/logo/NoPicture.jpg");
            $('#image2').val('');
            $('#photopath').val('');
            $('#clickcapture2').val('');
            $('#diva').css('display','none');
            $('#divm1').css('display','none');
            $('#divm2').css('display','none');
            $('#divb').css('display','block');
            $('#divc').css('display','block');
            $('#hasmulticashdraw').val(0);
            if(btn=='btnopencashdraw'){
                $('#divphoto').show();
                autocomplereceiver1($('#rec_tel'),$('#rec_name'));
            }else if(btn=='btncontinuepartner'){
                autocomplereceiver1($('#rectel_continue'),$('#recname_continue'));
            }
            resetbutton(btn);

            opencashdraw(id,0,'',btn);
            $('#tbl_bankpayment tbody').empty();
        })
        $(document).on('click','.btnselectcashdraw',function(e){
            e.preventDefault();
            //debugger;
            var id=$(this).data('id');

            var text=$(this).text();
            if(text=='unselect'){
              unselect(id,$(this));
            }else{
              opencashdraw(id,1,$(this));
            }
        })
        $(document).on('click','.btnclearmixsms',function(e){
            var id=$(this).data('id');
            var mixid=$(this).data('mixfromid');
            var url="{{ route('thaicashdraw.clearmixsms') }}";
            // $.get(url,{id:id,mixid:mixid},function(data){
            //     search_cashdraw(moresearch);
            // })


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
                            url: url,
                            data: { id:id,mixid:mixid },
                            success: function (data) {

                                if (data.success === true) {
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
        $(document).on('click','#btnclosedivbankpayment',function(e){
          e.preventDefault();
          $('#divbankpayment').css('display','none');
          $('#hasbankpayment').val(0);
          $('#tbl_bankpayment tbody').empty();
          resetbutton($('#clickfrom').val());
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
          var url="{{ route('thaicashdraw.getmulticashdraw') }}";
            $.get(url,{},function(data){
              $('#diva').empty().html(data);
             callback();

            })
        }
        $(document).on('click','.btndeltransfertemp',function(e){
          var id=$(this).data('transferid');
          var url="{{ route('thaicashdraw.unselectcashdraw') }}";
            $.get(url,{id:id},function(data){

              opencashdrawmulti(sumcashdraw);
            })
        })
        $(document).on('click','#btncleartransferlist',function(e){
          var url="{{ route('thaicashdraw.clearcashdrawselect') }}";
            $.get(url,{},function(data){

              opencashdrawmulti(sumcashdraw);
            })
        })
        $(document).on('click','#btnmixsms',function(e){
            //debugger;

            e.preventDefault();
            var q = confirm("Do you want to mix SMS?");
            if(!q){
                return;
            }
            var formdata=new FormData(frmcashdraw);
            //formdata.append('curid',curid);
            var url="{{ route('thaicashdraw.mixsms') }}";
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                success: function (data) {

                    if($.isEmptyObject(data.error)){
                        search_cashdraw(moresearch);
                        alert(data.message);
                        $('#cashdrawmodal').modal('hide');
                    }else{
                        alert(data.error)
                    }
                },
                error: function () {
                    alert('Save Error.')
                }

            })

        })
        $(document).on('keydown','.bankamt',function(e){
            if(e.keyCode==13){
                //debugger;
                var table = document.getElementById("tbl_bankpayment");
                var tbodyRowCount = table.tBodies[0].rows.length;
                var rowind=$(this).closest('tr').index();

                if(rowind==tbodyRowCount-1){
                    addrow();
                }
            }
        })
        $(document).on('change','.bankamt',function(e){
            e.preventDefault();
            totaluseamt();
        })
        $(document).on('change','.bankamt0',function(e){
            e.preventDefault();
            totaluseamt0();
        })
        $(document).on('change','.cuscharge0,.ckcuscharge0',function(e){
            e.preventDefault();
            //debugger;
            var row = $(this).closest('tr');
            var index=row.find("td:eq(0)").text();
            var amttitle=$('.bankamtexchange0').eq(index).attr('title');
            var cuscharge=$('.cuscharge0').eq(index).val();
            var ck = document.getElementById("ckcuscharge0"+index).checked;
            var amount=0;
            var totalamt=0;
            if(ck==true){
                amount=parseFloat(amttitle)-parseFloat(cuscharge);
            }else{
                amount=amttitle;
            }

            $('.bankamtexchange0').eq(index).val(formatNumber(amount));
            $('.totalamt0').eq(index).val(formatNumber(parseFloat(amount)+parseFloat(cuscharge)));

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
                getcurrencybykey('d','#lblsale')
            }else{
                getcurrencybykey('r','#lblsale')
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
          fillcontinueamount();

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
          saveexchange2('','',0,'','');
          //window.scrollTo(0, document.body.scrollHeight);
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
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:150px;" class="form-control kh16-b td_txtseva" value="0"></td>
                    <td colspan=2 style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamtopen" value="${formatNumber(usd)} USD" readonly></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtrectel" value=""></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtrecname" value=""></td>

                    <td style="padding:2px 0px 0px 0px;text-align:center;">
                        <input type="button" title="USD" data-cur="USD" data-amount="${ usd }" data-curid="${idusd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                        <input type="button" title="USD" data-cur="USD" data-amount="${ usd }" data-curid="${idusd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                        <input type="button" data-cur="USD" data-amount="${ usd }" data-curid="${idusd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btncontinue" value="Continue">
                    </td>
                </tr>
                `
          }
          if(thb!=0){
            tr+=`
                <tr>
                    <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(thb)} THB" readonly></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:150px;" class="form-control kh16-b td_txtseva" value="0"></td>
                    <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamtopen" value="${formatNumber(thb)} THB" readonly></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtrectel" value=""></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtrecname" value=""></td>

                    <td style="padding:2px 0px 0px 0px;text-align:center;">
                        <input type="button" title="THB" data-cur="THB" data-amount="${ thb }" data-curid="${idthb}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                        <input type="button" title="THB" data-cur="THB" data-amount="${ thb }" data-curid="${idthb}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                        <input type="button" data-cur="USD" data-amount="${ thb }" data-curid="${idthb}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btncontinue" value="Continue">
                    </td>
                  </tr>
                `
          }
          if(khr!=0){
            tr+=`
                <tr>
                    <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(khr)} KHR" readonly></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:150px;" class="form-control kh16-b td_txtseva" value="0"></td>
                    <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamtopen" value="${formatNumber(khr)} KHR" readonly></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtrectel" value=""></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtrecname" value=""></td>

                    <td style="padding:2px 0px 0px 0px;text-align:center;">
                        <input type="button" title="KHR" data-cur="KHR" data-amount="${ khr }" data-curid="${idkhr}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                        <input type="button" title="KHR" data-cur="KHR" data-amount="${ khr }" data-curid="${idkhr}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                        <input type="button" data-cur="USD" data-amount="${ khr }" data-curid="${idkhr}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btncontinue" value="Continue">
                        </td>
                  </tr>
                `
          }
          if(vnd!=0){
            tr+=`
                <tr>
                    <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(vnd)} VND" readonly></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:150px;" class="form-control kh16-b td_txtseva" value="0"></td>
                    <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamtopen" value="${formatNumber(vnd)} VND" readonly></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtrectel" value=""></td>
                    <td style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtrecname" value=""></td>

                    <td style="padding:2px 0px 0px 0px;text-align:center;">
                        <input type="button" title="VND" data-cur="VND" data-amount="${ vnd }" data-curid="${idvnd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                        <input type="button" title="VND" data-cur="VND" data-amount="${ vnd }" data-curid="${idvnd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                        <input type="button" data-cur="USD" data-amount="${ vnd }" data-curid="${idvnd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btncontinue" value="Continue">
                    </td>
                  </tr>
                `
          }
          $('#tbl_total_cashdraw').empty().html(tr);

        }
        function unselect(id,el)
        {
          var url="{{ route('thaicashdraw.unselectcashdraw') }}";
            $.get(url,{id:id},function(data){
              if(data.del2==1){
                el.text('select');
              }
            })
        }
        function opencashdraw(id,isselect,el,btn)
        {
            closemodalfrom='';
            $('#btnclosedivexchangecard').click();
            $('#btnclosedivcontinue').click();
            $('#transfer_id').val(id);
            var amtset=$('#txtsearchbyamt1').attr('title');
            //debugger;
            var url="{{ route('thaicashdraw.opencashdraw') }}";
            $.get(url,{id:id,amtset:amtset,isselect:isselect},function(data){
                //debugger;
                if(data.error==true){//if return view
                    alert('You can not open this money.\n' + data.errorsms);
                    return;
                }
                if(isselect==1){
                  el.text('unselect');
                  return;
                }
                $('#cashdrawmodal').modal('show');
                $('#clickfrom').val(btn);
                $('#amount').val(formatNumber(Math.abs(data['ptransfer'].amount)));
                $('#useamt').val(0);
                $('#leftamt').val(formatNumber(Math.abs(data['ptransfer'].amount)));

                $('#selcur').val(data['thbcur'].id);
                $('#txtcur_cutseva').val(data['thbcur'].shortcut);
                $('#openamt').val(formatNumber(Math.abs(data['ptransfer'].amount)));
                $('#txtcur_open').val(data['thbcur'].shortcut);
                $('#txtcur_open1').val(data['thbcur'].shortcut);
                $('#txtcur_open2').val(data['thbcur'].shortcut);
                $('#invdate').val(moment(data['ptransfer'].smsdate).format("DD-MM-YYYY"));
                $('#invdate').attr('title',"smstime:"+data['ptransfer'].smstime);

                $('#from_partner').val(data['ptransfer'].sendfrom + '(' + data['ptransfer'].accno + ')' );
                $('#from_partner_id').val(0);
                // $('#rectel').val(data['ptransfer'].rectel);
                // $('#recname').val(data['ptransfer'].recname);
                // $('#sendertel').val(data['ptransfer'].sendertel);
                // $('#sendername').val(data['ptransfer'].sendername);
                $('#rec_tel').val(data['ptransfer'].rectel);
                $('#rec_name').val(data['ptransfer'].recname);
                $('#cuscharge').val('');
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
        $('#cashdrawmodal').on('shown.bs.modal', function () {
            $('#cuscharge').focus();
        })
        $('#cashdrawmodal').on('hide.bs.modal', function () {
            $('#divexchangecard').css('display','none');
            $('#divexchangefixed').css('display','none');
            $('#divexchangelist').css('display','none');
            $('#divbankpayment').css('display','none');
            $('#divcontinue').css('display','none');
            $('#divfooter').css('display','none');
            $('#hasbankpayment').val(0);
            $('#hascontinue').val(0);
        })

        $("#cuscharge").blur(function(){
            if($(this).val()==''){
                //alert('please input customer service charge')
                toastr.error("សូមបញ្ចូលថ្លៃកាត់សេវ៉ាពីអតិថិជន");
                $('#divfooter').css('display','none');
                $(this).focus();
            }else{
                $('#divfooter').css('display','block');
                if($('#clickfrom').val()=='btncontinuewingbank'){
                    $('#btnbankpayment').click();
                }else if($('#clickfrom').val()=='btncontinuepartner'){
                    $('#btncontinue').click();
                }else{
                    $('#hasbankpayment').val(0);
                    $('#hascontinue').val(0);

                }
            }
        });

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
        var cleave = new Cleave('#feeps', {
            numeral: true,
            numeralDecimalScale: 2,
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
            fillcontinueamount();
            //window.scrollTo(0, document.body.scrollHeight);
            $('#selpartner_continue').focus();
            //$('#selpartner_continue').tirgger('change');
        })
        function fillcontinueamount()
        {
            try{
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
            }catch{

            }
        }

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
                    fillcontinueamount();
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
    //     var url1 = "{{ route('rectel.autocomplete') }}";
    //     $( "#rectel_continue" ).autocomplete({
    //     source: function( request, response ) {
    //       $.ajax({
    //         url: url1,
    //         type: 'GET',
    //         dataType: "json",
    //         data: {
    //            search: request.term.replace(/\s+/g, '')
    //         },
    //         success: function( data ) {
    //            response( data );
    //         }
    //       });
    //     },
    //     select: function (event, ui) {
    //         console.log(ui.item);
    //        $('#rectel_continue').val(ui.item.label);
    //        $('#recname_continue').val(ui.item.recname);
    //        var cleave = new Cleave('#rectel_continue', {
    //             blocks: [0, 3, 3, 4, 10],
    //             numericOnly: true
    //         });
    //        return false;
    //     }
    //   });
    //   var url1 = "{{ route('rectel.autocomplete') }}";
    //     $( "#rectel" ).autocomplete({
    //     source: function( request, response ) {
    //       $.ajax({
    //         url: url1,
    //         type: 'GET',
    //         dataType: "json",
    //         data: {
    //            search: request.term.replace(/\s+/g, '')
    //         },
    //         success: function( data ) {
    //            response( data );
    //         }
    //       });
    //     },
    //     select: function (event, ui) {
    //         console.log(ui.item);
    //        $('#rectel').val(ui.item.label);
    //        $('#recname').val(ui.item.recname);
    //        var cleave = new Cleave('#rectel', {
    //             blocks: [0, 3, 3, 4, 10],
    //             numericOnly: true
    //         });
    //        return false;
    //     }
    //   });
      function autocomplereceiver(bankrectel,bankrecname,qrimg,imagepath){
                var sources=JSON.parse(localStorage.getItem("recphonelist_thai"));
                var sources1=JSON.parse(localStorage.getItem("recnamelist_thai"));
                $(bankrectel).autocomplete({
                    source:sources,
                    minLength: 3,
                    select: function( event, ui ) {
                        var bankrowind=$(this).closest('tr').index();
                        $(bankrectel).eq(bankrowind).val( ui.item.value );
                        $(bankrecname).eq(bankrowind).val(ui.item.recname);
                        //$(qrimg).eq(bankrowind).attr('src','{{ asset('public/qrcode') }}'+ '/' + ui.item.qrcode);
                        $(qrimg).eq(bankrowind).attr('src','{{ asset(config('helper.asset_path')) }}'+ '/qrcode/' + ui.item.qrcode);
                        $(qrimg).eq(bankrowind).attr('title',ui.item.qrcode);
                        $(imagepath).eq(bankrowind).val(ui.item.qrcode);
                        countrectel(ui.item.value,bankrowind);
                        return false;
                    }

                });
                $(bankrecname).autocomplete({
                    source:sources1,
                    minLength: 3,
                    select: function( event, ui ) {
                    console.log(ui.item.qrcode)
                        var bankrowind=$(this).closest('tr').index();
                        $(bankrecname).eq(bankrowind).val( ui.item.value );
                        $(bankrectel).eq(bankrowind).val(ui.item.rectel);
                        //$(qrimg).eq(bankrowind).attr('src','{{ asset('public/qrcode') }}'+ '/' + ui.item.qrcode);
                        $(qrimg).eq(bankrowind).attr('src','{{ asset(config('helper.asset_path')) }}'+ '/qrcode/' + ui.item.qrcode);
                        $(qrimg).eq(bankrowind).attr('title',ui.item.qrcode);
                        $(imagepath).eq(bankrowind).val(ui.item.qrcode);
                        countrectel(ui.item.rectel,bankrowind);
                        return false;
                    }

                });
               }
               function autocomplereceiver1(bankrectel,bankrecname){
                    var sources=JSON.parse(localStorage.getItem("recphonelist_thai"));
                    var sources1=JSON.parse(localStorage.getItem("recnamelist_thai"));
                    $(bankrectel).autocomplete({
                        source:sources,
                        minLength: 3,
                        select: function( event, ui ) {
                            $(bankrectel).val( ui.item.value );
                            $(bankrecname).val(ui.item.recname);
                            return false;
                        }

                    });
                    $(bankrecname).autocomplete({
                        source:sources1,
                        minLength: 3,
                        select: function( event, ui ) {
                            $(bankrecname).val( ui.item.value );
                            $(bankrectel).val(ui.item.rectel);
                            return false;
                        }

                    });
               }

    function countrectel(rectel,rowind){
        var url="{{ route('thaicashdraw.countrectel') }}";
        const d = new Date();
        let month = d.getMonth()+1;
        $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {month:month,rectel:rectel},
                success: function (data) {

                    if($.isEmptyObject(data.error)){
                        var k=0;
                        var output='';
                        for(var i=0;i<data['transfers'].length;i++){
                                k+=1;
                                output +=
                                `<tr>
                                    <td style="text-align:center;" class="kh16">${ k }</td>
                                    <td class="kh16">
                                        ${ moment(data['transfers'][i].dd).format("DD-MM-YYYY") }
                                    </td>
                                    <td class="kh16">${data['transfers'][i].user.name}</td>
                                    <td class="kh16">${data['transfers'][i].partner.name}</td>
                                    <td class="kh16">${data['transfers'][i].tranname}</td>
                                    <td class="kh16-b" style="text-align:right;">${formatNumber(data['transfers'][i].amount) } ${ data['transfers'][i].currency .shortcut}</td>
                                    <td class="kh16-b" style="text-align:right;">${formatNumber(data['transfers'][i].thai_amt) + 'B'}</td>

                                    <td class="kh16-b" style="text-align:right;">${data['transfers'][i].rectel??''}</td>
                                    <td class="kh16">${data['transfers'][i].recname??''}</td>
                                </tr>`;
                            }
                            $('#body_divsearchamount').empty().html(output);
                            if(k>0){
                                $('#amttel_modal').modal('show');
                            }else{
                                $('#amttel_modal').modal('hide');
                            }

                        $('.btncounttel').eq(rowind).val(data['countrow']);
                        if(!$('#bankid'+rowind).find("option:contains('" + data['lasttransfer'].parrent_id  + "')").length){
                            $('.bankid').eq(rowind).append($("<option/>",{
                                    value:data['lasttransfer'].parrent_id,
                                    text:data['lasttransfer'].partner.name,
                                    customertype:data['lasttransfer'].partner.customertype
                                }))
                        }
                            $('.bankid').eq(rowind).val(data['lasttransfer'].parrent_id);
                            $('#bankid'+rowind).trigger('change');

                            $('.bankcurexchange').eq(rowind).val(data['lasttransfer'].th_saleinfo.split(';')[0]);
                            $('#bankcurexchange'+rowind).trigger('change');

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
    $(document).on('click','.btncounttel',function(e){
        e.preventDefault();
        const d = new Date();
        let month = d.getMonth()+1;
        var bankrowind=$(this).closest('tr').index();
        var rectel= $('.bankrectel').eq(bankrowind).val();
        var redirectWindow = window.open('{{ url('/') }}'+'/thaicashdraw/showrectelinfo?rectel='+rectel+'&month='+month, '_blank');
        redirectWindow.location;
    })


      function calcuexchange0() {
            //debugger

            var luy = $('#txtbuy').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var m1 = $('#lblbuy').attr('title').split(";");
            var m2 = $('#lblsale').attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    $('#txtsale').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    } else {
                        $('#txtsale').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                    }
                } else {
                    calcuexchangeproduct0();
                }
            }
        }
        $(document).on('keyup', '#txtbuy', function (e) {
            //debugger
            //alert(e.key)
            if(isNumber(e.key)){
                //calcuexchange0();
                calcuexchange();
                return;
            }
            //alert('not a number')
            const C = e.key;
            if (C === "Backspace") {
                //calcuexchange0();
                calcuexchange();
                return;
            }else if(C==="+"){
                e.preventDefault();
                $('#txtbuy').css('color','blue');
                $('#txtsale').css('color','red');
                $('#txtsign').val('+');
                $('#txtsign1').val('-');
                //getrate0();
                getrate();
                return;
            }else if(C==="-"){
                e.preventDefault();
                $('#txtbuy').css('color','red');
                $('#txtsale').css('color','blue');
                $('#txtsign').val('-');
                $('#txtsign1').val('+');
                //getrate0();
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
                //calcuexchange0();
                calcuexchange();

                return;
            }
            //alert('not a number')
            const C = e.key;
            if (C === "Backspace") {
                //calcuexchange0();
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
            totaluseamt();

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
            try{
                var table = document.getElementById("tbl_bankpayment");
            var bankpaymentrow = table.tBodies[0].rows.length;
            let j=0;
            var lbl_title='';
            var transferamt='0';
            var curid='';
            var curname='';
            var lastind=0;
            if($('#hasmulticashdraw').val()==1){
               transferamt=$('.td_btnexchange').eq(0).data('amount');
               curid=$('.td_btnexchange').eq(0).data('curid');
            }else{
               transferamt=$('#openamt').val().replace(/,/g, '');
               curid=$('#selcur').val();
               curname=$('#selcur option:selected').text();
            }

            var hasexchange=$('#hasexchange').val();
            var hasexchange2=$('#hasexchangefix').val();
            if(hasexchange2==1){
              $('.txtsalefix').each(function(i,e){
                lastind=i;
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
            var getamt=0;
            var fillamt=0;

            $('.bankamt').each(function(i,e){
                //debugger;

                lastind=i;
                fillamt=transferamt-getamt;

                if($('.bankamt').eq(i).val()==''){
                    $('.bankamt').eq(i).val(formatNumber(fillamt));
                }else{
                    getamt +=parseFloat($('.bankamt').eq(i).val().replace(/,/g, ''));
                }
              $('.bankcur').eq(i).val(curid);
              $('.bankcurbuy').eq(i).val(curname);

            })
            // $('.bankamt').eq(bankpaymentrow-1).focus();
            // $('.bankamt').eq(bankpaymentrow-1).select();
            $('.bankrectel').eq(bankpaymentrow-1).focus();
            getcurrencybyidlocalstorage(curid,$('.bankcur').eq(lastind),$('.bankbuyinfo').eq(lastind),lastind,$('.bankamt'),$('.bankrate'),$('.bankamtexchange'),$('.bankrateinfo'),$('.bankcur'),$('.bankcurexchange'),$('.bankcur option:selected').eq(lastind).text(),$('.bankcurexchange option:selected').eq(lastind).text());

            }catch{

            }finally{
                totaluseamt();
            }
        }
        function totaluseamt(){
            var totalamt=0;
            var openamt=$('#openamt').val().replace(/,/g, '');
            $('.bankamt').each(function(i,e){
                //debugger;
                totalamt +=parseFloat($('.bankamt').eq(i).val().replace(/,/g, ''));
            })
            $('#useamt').val(formatNumber(totalamt));
            $('#leftamt').val(formatNumber(parseFloat(openamt)-parseFloat(totalamt)));
        }
        function totaluseamt0(){
            var totalamt=0;
            var openamt=$('#openamt0').val().replace(/,/g, '');
            $('.bankamt0').each(function(i,e){
                //debugger;
                if($('.bankamt0').eq(i).val()!==''){
                    totalamt +=parseFloat($('.bankamt0').eq(i).val().replace(/,/g, ''));
                }
            })
            $('#useamt0').val(formatNumber(totalamt));
            $('#leftamt0').val(formatNumber(parseFloat(openamt)-parseFloat(totalamt)));
        }
        $(document).on('click','#btnupdate',function(e){
            e.preventDefault();
            var leftamt=$('#leftamt0').val().replace(/,/g, '');
            if(leftamt!=0){
                alert('លុយបើកនៅសល់សូមត្រួតពិនិត្យឡើងវិញ។')
                return;
            }
            var elem=$(this).attr('id');
            func_updatecashdraw(elem);

        })
        function func_updatecashdraw(elem)
        {
            var isgetcode=1;
            for(i=0; i<$('.bankid0').length; i++) {
                var userdocode=$('.btndowingcode0').eq(i).attr('title');
                var userconnect=$('.userconnect0').eq(i).val().split(',');
                if(userdocode!='' && userdocode!='null'){
                    if(!userconnect.includes(userdocode)){
                        alert('selected bank not match the user generate code')
                        return;
                    }
                }else{
                    isgetcode=0;
                }
            }
            $('body').addClass("wait");
            var curid=$('#selcur').val();
            var topartner=$('#selpartner_continue option:selected').text();
            var frompartner=$('#from_partner').val();

            var formdata=new FormData(frmcashdraw0);
            formdata.append('curid',curid);
            formdata.append('topartner',topartner);
            formdata.append('frompartner',frompartner);
            formdata.append('groupid',$('#groupid0').val());
            formdata.append('isgetcode',isgetcode);

            var url="{{ route('thaicashdraw1.updatetransfer0') }}"
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                success: function (data) {

                    if($.isEmptyObject(data.error)){
                        closemodalfrom='saved';
                         $('#cashdrawmodal0').modal('hide');
                        var transfer_id=$('#transfer_id0').val();
                        del_userselectcashdraw0(transfer_id);
                        search_cashdraw(moresearch);
                        $('body').removeClass("wait");
                    }else{
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Save Error.')
                }

            })

        }
        $(document).on('click','#btnsavemultiimage',function(e){
            e.preventDefault();
            var formdata=new FormData(frmcashdraw);
            var url="{{ route('thaicashdraw.savemultiimage') }}";
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
                        $('body').removeClass("wait");
                        //$(el).removeAttr('disabled').html(buttontext);
                    }else{
                        $('body').removeClass("wait");
                        //$(el).removeAttr('disabled').html(buttontext);
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    $(el).removeAttr('disabled').html(buttontext);
                    alert('Save Error.')
                }

            })
        })
        $(document).on('click','#btnsave,#btnsaveprint,#btnsaveprintcash,#btnsavestep2,#btnsavestep3',function(e){
            e.preventDefault();
            var buttontext=$(this).text();
            $(this).attr('disabled', true).text("Processing");
            if ($('#clickfrom').val() == 'btncontinuewingbank') {
                var leftamt=$('#leftamt').val().replace(/,/g, '');
                if(leftamt!=0){
                    alert('លុយបើកនៅសល់សូមត្រួតពិនិត្យឡើងវិញ។')
                    $(this).removeAttr('disabled').html(buttontext);
                    return;
                }

            }
            var elem=$(this).attr('id');
            if($('#hasexchangefix').val()==1){
            if($('#hasexchange').val()<2){
              saveexchange2(func_savecashdraw,elem,1,buttontext,$(this));
              return;
            }
          }
          func_savecashdraw(elem,buttontext,$(this));

        })

        function func_savecashdraw(elem,buttontext,el)
        {
            // for(i=0; i<$('.bankid').length; i++) {
            //     var bankid=$('.bankid').eq(i).val();
            //     var bankid1=$('.btndowingcode').eq(i).attr('title');
            //     if(bankid1!=undefined && bankid1!=''){
            //         if(bankid1!=bankid){
            //             alert('selected bank not match the generate code')
            //             return;
            //         }
            //     }
            // }

            var isgetcode=1;
            for(i=0; i<$('.bankid').length; i++) {
                var filename='';
                var userdocode=$('.btndowingcode').eq(i).attr('title');
                var userconnect=$('.userconnect').eq(i).val().split(',');
                let path = $('.qrimg').eq(i).attr('title');
                if(path){
                    filename =$('.bankrectel').eq(i).val() + '_' + path.replace(/^.*[\\\/]/, '');
                }
                appendphonetolocalstorage($('.bankrectel').eq(i).val(),$('.bankrecname').eq(i).val(),filename);
                if(userdocode!='' && userdocode!='null'){
                    // if(!userconnect.includes(userdocode)){
                    //     alert('selected bank not match the user generate code')
                    //     return;
                    // }
                }else{
                    isgetcode=0;
                }
            }

            var mission_complete=0;
            var step=1;
            if(elem=='btnsavestep2'){
                step=2;
                //mission_complete=0;
            }else if(elem=='btnsavestep3'){
                step=3;
                //mission_complete=0;
            }else if(elem=='btnsaveprint'){
                mission_complete=1;
            }
            if(mission_complete==1){
                var bp=$('#hasbankpayment').val();
                if(bp==1){
                    var found=0;
                    var custype='';
                    var agenttype='';
                    $('.wingcodeinfoby').each(function(i,e){
                        //debugger;
                        custype=$('.customertype').eq(i).val();
                        agenttype=$('.agenttype').eq(i).val();
                        if(custype=='BANK'){
                            if($(this).val()==''){
                                found=1;
                            }
                        }else if(custype=='AGENT'){
                            if(agenttype!='Cash'){
                                if($(this).val()==''){
                                    found=1;
                                }
                            }
                        }

                    })
                    if(found==1){
                        alert('you can not finish this transacton with empty money code.');
                        $(el).removeAttr('disabled').html(buttontext);
                        return;
                    }
                }
            }
            //debugger;
            $('body').addClass("wait");
            var curid=$('#selcur').val();
            var topartner=$('#selpartner_continue option:selected').text();
            const table = document.getElementById("tbl_image");
            const thCount = table.querySelectorAll("th").length;
            var frompartner=$('#from_partner').val();
            var formdata=new FormData(frmcashdraw);
            formdata.append('smstime',$('#invdate').attr('title'));
            formdata.append('curid',curid);
            formdata.append('foundmulti_image',thCount);
            formdata.append('topartner',topartner);
            formdata.append('frompartner',frompartner);
            formdata.append('mission_complete',mission_complete);
            formdata.append('step',step);
            formdata.append('isgetcode',isgetcode);
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

            var url="{{ route('thaicashdraw.savecashdraw') }}"
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
                        if($('#hasmulticashdraw').val()==0){
                            var transfer_id=$('#transfer_id').val();
                            del_userselectcashdraw(transfer_id);
                        }
                        if(elem=='btnsaveprint'){
                            prints(data.cashdrawid,data.id);
                        }else if(elem=='btnsaveprintcash'){
                            printcashdraw(data.cashdrawid,data.id);
                        }
                        $('#btnclosedivexchangecard').click();
                        $('#btnclosedivcontinue').click();
                        $('#btnclosedivbankpayment').click();
                        $('#btnclosedivexchangefix').click();
                        $("#tbl_bankpayment tbody tr").remove();
                        $('#frmcashdraw').trigger('reset');
                        $('#selpartner_continue').trigger('change');
                        $('#opdate').datetimepicker({
                          timepicker:false,
                          datepicker:true,
                          value:new Date(),
                          format:'d-m-Y',
                          autoclose:true,
                          todayBtn:true,
                          startDate:new Date(),

                      });
                        var today = new Date();
                        //getusercapital_master($('#loginid').val(), today);
                        search_cashdraw(moresearch);
                        //savephonetolocalstorage();

                        $('body').removeClass("wait");
                        $(el).removeAttr('disabled').html(buttontext);
                    }else{
                        $('body').removeClass("wait");
                        $(el).removeAttr('disabled').html(buttontext);
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    $(el).removeAttr('disabled').html(buttontext);
                    alert('Save Error.')

                }

            })

        }
        $(document).on('click','.btnprint',function(e){
            e.preventDefault();
            var groupid=$(this).data('groupid');
            prints(groupid);
        })
        function prints(groupid,id){
                var redirectWindow = window.open('{{ url('/') }}'+'/thaicashdraw1/printcode?id='+ id +'&groupid='+groupid, '_blank');
                redirectWindow.location;
            }
        function printcashdraw(groupid,id){
                var redirectWindow = window.open('{{ url('/') }}'+'/thaicashdraw/prints?id='+ id +'&group_id='+groupid+'&invtitle='+'បង្កាន់បើកវេរលុយថៃ', '_blank');
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
            if($('#selpartner_continue').val()!==''){
                fillnextbalance('#balance1','#balancenext1',$('#selcur_continue option:selected').text(),1,$('#amount_continue').val(),$('#fee_continue').val());
            }
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
    //     function getcurrencybykey(key,el)
    // {


    //     var currencylist;
    //     if(localStorage.getItem("currencylist")==null){
    //         currencylist=[];
    //     }else{
    //         currencylist=JSON.parse(localStorage.getItem("currencylist"));
    //     }
    //     for (let i = 0; i < currencylist.length; i++) {
    //         if(currencylist[i].skey==key){
    //             //debugger;
    //             $(el).val(currencylist[i].shortcut);
    //             $(el).attr('title', currencylist[i].id + ';' + currencylist[i].ratebuy + ';' + currencylist[i].ratesale + ';' + currencylist[i].optsign + ';' + currencylist[i].ismain + ';' + currencylist[i].isfn + ';' + currencylist[i].shortcut);
    //             getrate0();
    //             return;
    //         }
    //     }

    // }
    function getrate0() {
            $('#txtrate').attr('title', '');
            var m = $('#lblbuy').attr('title').split(";");
            var p = $('#lblsale').attr('title').split(";");
            if(m=='' || p==''){
                //alert('can not save')
                return;
            }
            //check if the save curname
            //debugger
            if (m[6] == p[6]) {
                $('#txtrate').val(1);
                calcuexchange0();
                return;
            }
            //check if product exchange product
            if (m[4] == '0') {
                if (p[4] == '0') {
                    runproductrate0();
                    return;
                }
            }
            if ($('#txtsign').val() == '+') {
                if (m[4] == '1') {//if maincur=true
                    $('#txtrate').val(formatNumber(parseFloat(p[2])));//get rate p sale
                } else {
                    $('#txtrate').val(formatNumber(parseFloat(m[1])));//get rate m buy
                }

            } else {
                if (m[4] == '1') {
                    $('#txtrate').val(formatNumber(parseFloat(p[1])));
                } else {
                    $('#txtrate').val(formatNumber(parseFloat(m[2])));
                }

            }

            $('#lblrate').attr('title',$('#txtrate').val());
            calcuexchange0();

        }
        function runproductrate0()
    {
            //debugger
            var url="{{ route('getproductrate') }}";
            var buycur = $('#lblbuy').val();
            var salecur = $('#lblsale').val();
            var curname = '';
            if ($('#txtsign').val() == '+') {
                curname = buycur + '-' + salecur;
            } else {
                curname = salecur + '-' + buycur;
            }
            //alert(curname)
            $.get(url,{curname:curname},function(data){
                if(data.success){

                    $('#txtrate').val(formatNumber(parseFloat(data['pr']['rate'])));
                    $('#txtrate').attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                    calcuexchangeproduct0();
                }else{
                    $('#txtrate').val('');
                    $('#txtrate').attr('title','');
                }


            })

            $('#lblrate').attr('title',$('#txtrate').val());

    }
    function calcuexchangeproduct0() {
            //debugger;
            var luy = $('#txtbuy').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var rs = $('#txtrate').attr('title').split(";");
            if ($('#txtsign').val() == '+') {
                if (rs[2] == '*') {
                    $('#txtsale').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (rs[2] == '*') {
                    $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $('#txtsale').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }
            }
        }
        function getcurrencybykey2(key,el,lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate)
    {
        //debugger;
        var url="{{ route('getcurrencybykey') }}";
        $.get(url,{key:key},function(data){
            //console.log(data)
                if(data['c']!=null){
                    $(el).val(data['c']['shortcut']);
                    $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                    getrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
        })
    }
    function getrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            $(txtrate).attr('title', '');
            var m = $(lblbuy).attr('title').split(";");
            var p = $(lblsale).attr('title').split(";");
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
        function runproductrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate)
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

            })

            $(lblrate).attr('title',$(txtrate).val());
            $(lblrate).val($(txtrate).val());
            //dolabelcico();
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
        function filltitlebankcur(id,el)
        {
            //debugger;
            var currencylist;
            if(localStorage.getItem("currencylist")==null){
            currencylist=[];
            }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
            }
            currencylist.forEach(function(c){
            //debugger;
            if(c.id==id){
                    //$(el).val(c.shortcut);
                    $(el).val(c.id);
                    $(el).attr('title', c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);

                }
            })
        }
        function getcurrencybyidlocalstorage(id,el,el1,ind,bankamt,bankrate,bankamtexchange,bankrateinfo,bankcur,bankcurexchange,bankcur_text,bankcurexchange_text)
        {

            var currencylist;
            if(localStorage.getItem("currencylist")==null){
            currencylist=[];
            }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
            }
            currencylist.forEach(function(c){

            var buythai=c.buy_thai;
            var salethai=c.sale_thai;
            if(c.id==id){
                    //$(el).val(c.shortcut);
                    if(c.buy_thai==null){
                        buythai=c.ratebuy;
                    }
                    if(c.sale_thai==null){
                        salethai=c.ratesale;
                    }
                    $(el).val(c.id);
                    $(el).attr('title', c.id + ';' + parseFloat(buythai) + ';' + parseFloat(salethai) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
                    $(el1).val( c.id + ';' + parseFloat(buythai) + ';' + parseFloat(salethai) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
                    getrate_old(ind,bankamt,bankrate,bankamtexchange,bankrateinfo,bankcur,bankcurexchange,bankcur_text,bankcurexchange_text);
                }
            })
        }
    function getrate_old(ind,bankamt,bankrate,bankamtexchange,bankrateinfo,bankcur,bankcurexchange,bankcur_text,bankcurexchange_text) {
        //debugger;
        $(bankrate).eq(ind).val('');
        $(bankamtexchange).eq(ind).val('');
        $(bankrate).eq(ind).attr('title', '');
        $(bankrateinfo).eq(ind).val('');

        var m = $(bankcur).eq(ind).attr('title').split(";");
        var p = $(bankcurexchange).eq(ind).attr('title').split(";");
        if(m=='' || p==''){
            //alert('can not save')
            return;
        }
        //check if the save curname
        //debugger
        if (m[6] == p[6]) {
            $(bankrate).eq(ind).val(1);
            calcuexchange(ind,bankamt,bankamtexchange,bankrate,bankcur,bankcurexchange);
            return;
        }
        //check if product exchange product
        if (m[4] == '0') {
            if (p[4] == '0') {
                runproductratefast(ind,bankcur_text,bankcurexchange_text,bankrate,bankrateinfo,bankamt,bankamtexchange);
                return;
            }
        }

        if (m[4] == '1') {//if maincur=true
            $(bankrate).eq(ind).val(formatNumber(parseFloat(p[2])));//get rate p sale
        } else {
            //$(bankrate).eq(ind).val(formatNumber(parseFloat(m[1])));//get rate m buy
            $(bankrate).eq(ind).val(formatNumber(parseFloat(p[1])));//get rate m buy
        }
        //$(bankrate).eq(ind).attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
        $(bankrate).eq(ind).attr('title',$(bankrate).eq(ind).val());
        //$(bankrateinfo).eq(ind).val($(bankrate).eq(ind).val());
        $(bankrateinfo).eq(ind).val($(bankrate).eq(ind).attr('title'));
        calcuexchange(ind,bankamt,bankamtexchange,bankrate,bankcur,bankcurexchange);

        //dolabelcico();
    }
    function calcuexchangeproduct(ind,bankamt,bankrate,bankamtexchange) {
          //debugger;
          var examt=0;
          var luy = $(bankamt).eq(ind).val().replace(/,/g, '');
          var r = $(bankrate).eq(ind).val().replace(/,/g, '');
          var rs = $(bankrate).eq(ind).attr('title').split(";");

        if (rs[2] == '*') {
            //$(bankamtexchange).eq(ind).val(formatNumber(parseFloat(luy * r).toFixed(2)));
             examt=bongkotchomnuen(parseFloat(luy * r).toFixed(2),$('.bankcursale').eq(ind).val());
        } else {
             examt=bongkotchomnuen(parseFloat(luy / r).toFixed(2),$('.bankcursale').eq(ind).val());
            //$(bankamtexchange).eq(ind).val(formatNumber(parseFloat(luy / r).toFixed(2)));
        }
        $(bankamtexchange).eq(ind).val(formatNumber(examt));

      }
    // function bongkotchomnuen(amt,cur)
    // {
    //     //debugger;
    //     var newamt=0;
    //     if(cur=='KHR'){
    //         let amt1=amt/100;
    //         let arramt1=amt1.toString().split(".");
    //         let intamt=arramt1[0];
    //          newamt=parseFloat(intamt)*100;

    //     }else if(cur=='USD'){
    //         let arramt1=amt.toString().split(".");
    //         let intamt=arramt1[0];
    //         let float_amt=arramt1[1];
    //         if(arramt1[1]<=60){
    //              newamt=intamt;
    //         }else{
    //              newamt=parseFloat(intamt)+1;
    //         }
    //     }
    //     return newamt;
    // }
    function bongkotchomnuen(amt,cur)
    {
        //debugger;
        //var newamt=0;
        var newamt=amt;
        if(cur=='KHR'){
            let amt1=amt/100;
            let arramt1=amt1.toString().split(".");
            let intamt=arramt1[0];
             newamt=parseFloat(intamt)*100;

        }else if(cur=='USD'){
            @if(config('helper.thai_bangkut_usd') == 1)
                let arramt1=amt.toString().split(".");
                let intamt=arramt1[0];
                //let float_amt=arramt1[1];
                let float_amt = arramt1[1] ? arramt1[1].padEnd(2, '0').slice(0, 2) : "00"; // Ensures two digits
                if(float_amt<=60){
                    newamt=intamt;
                }else{
                    newamt=parseFloat(intamt)+1;
                }
            @else
                newamt=parseFloat(amt);
            @endif
        }
        return newamt;
    }
    function calcuexchange(ind,bankamt,bankamtexchange,bankrate,bankcur,bankcurexchange) {

        //debugger;
        var examt=0;
          var luy = $(bankamt).eq(ind).val().replace(/,/g, '');
          var r = $(bankrate).eq(ind).val().replace(/,/g, '');
          var m1 = $(bankcur).eq(ind).attr('title').split(";");
          var m2 = $(bankcurexchange).eq(ind).attr('title').split(";");
          if (m1[4] == '1') { //if maincur=true
              if (m2[3] == '/') {//if operator=/
                  //$(bankamtexchange).eq(ind).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                   examt=bongkotchomnuen(parseFloat(luy * r).toFixed(2),$('.bankcursale').eq(ind).val());
              } else {
                  //$(bankamtexchange).eq(ind).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                   examt=bongkotchomnuen(parseFloat(luy / r).toFixed(2),$('.bankcursale').eq(ind).val());
              }
              $(bankamtexchange).eq(ind).val(formatNumber(examt));
          } else {
              if (m2[4] == '1') {
                  if (m1[3] == '/') {
                      //$(bankamtexchange).eq(ind).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                       examt=bongkotchomnuen(parseFloat(luy / r).toFixed(2),$('.bankcursale').eq(ind).val());
                  } else {
                      //$(bankamtexchange).eq(ind).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                       examt=bongkotchomnuen(parseFloat(luy * r).toFixed(2),$('.bankcursale').eq(ind).val());
                  }
                  $(bankamtexchange).eq(ind).val(formatNumber(examt));
              } else {
                  calcuexchangeproduct(ind,bankamt,bankrate,bankamtexchange);
              }
          }

        //   var k2=$(bankamtexchange).eq(ind).val().split('.');
        //   if(k2.length==2){
        //       var kak= Math.floor(k2[1]/10);
        //       var amtex=k2[0] + '.' + kak + '0';
        //       $(bankamtexchange).eq(ind).val(amtex);
        //   }
      }
    function runproductrate(ind,buycur,salecur,bankrate,bankrateinfo,bankamt,bankamtexchange) {
          //debugger
          var url="{{ route('getproductrate') }}";
          var curname = '';
          curname = buycur + '-' + salecur;
          //alert(curname)
          $.get(url,{curname:curname},function(data){
              if(data.success){
                    //debugger;
                  $(bankrate).eq(ind).val(formatNumber(parseFloat(data['pr']['rate'])));
                  $(bankrate).eq(ind).attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                  //$(bankrate).eq(ind).attr('title',  data['pr']['rate']);
                  calcuexchangeproduct(ind,bankamt,bankrate,bankamtexchange);
              }else{
                  $(bankrate).eq(ind).val('');
                  $(bankrate).eq(ind).attr('title','');
              }


          })

          //$('.bankrate').eq(ind).attr('title',$('.bankrate').eq(ind).val());
          $(bankrateinfo).eq(ind).val($(bankrate).eq(ind).attr('title'));
          //$(bankrateinfo).eq(ind).val($(bankrate).eq(ind).val());

          //dolabelcico();
      }
      function runproductratefast(ind,buycur,salecur,bankrate,bankrateinfo,bankamt,bankamtexchange)
        {
            var curname = '';
            curname = buycur + '-' + salecur;
            var currencyproductlist;
            if(localStorage.getItem("currencyproductlist")==null){
            currencyproductlist=[];
            }else{
            currencyproductlist=JSON.parse(localStorage.getItem("currencyproductlist"));
            }
            $(bankrate).eq(ind).val('');
            $(bankrate).eq(ind).attr('title','');
            currencyproductlist.forEach(function(c){
            //debugger;
            if(c.pshortcut==curname){
                $(bankrate).eq(ind).val(formatNumber(parseFloat(c.thai_rate)));
                $(bankrate).eq(ind).attr('title', c.pshortcut + ';' +  c.thai_rate + ';' +  c.operator);
                calcuexchangeproduct(ind,bankamt,bankrate,bankamtexchange);

                }
            })
            $(bankrateinfo).eq(ind).val($(bankrate).eq(ind).attr('title'));
        }

    })
    function isEmpty(val){return (val === undefined || val == null || val.length <= 0) ? true : false;}
    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    //search table
    function searchTable(val) {
        var input, filter, found, table, tr, td, i, j;
        // input = document.getElementById("myInput");
        // filter = input.value.toUpperCase();
        filter=val.toUpperCase();
        table = document.getElementById("tbl_cashdraw");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            // td = tr[i].getElementsByTagName("td");
            // for (j = 0; j < td.length; j++) {
            //     if(j==9){
            //         if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
            //             found = true;
            //         }
            //     }
            // }
            // if (found) {
            //     tr[i].style.display = "";
            //     found = false;
            // } else {
            //     tr[i].style.display = "none";
            // }

            if(val=='all'){
                tr[i].style.display = "";
            }else{
                td = tr[i].getElementsByTagName("td")[10];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
    </script>
@endsection
