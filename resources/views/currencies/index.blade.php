@extends('master')
@section('title') currency @endsection
@section('css')
    <style type="text/css">
         body.wait, body.wait *{
			cursor: wait !important;
		}
         #seluserconnect + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;}
		/* Each result */
		#select2-seluserconnect-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:aquamarine;}
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            }
         .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        td{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            word-wrap: break-word;
        }
        th{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
        }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        .student-photo{
			height:100px;
			padding-left:1px;
			padding-right:1px;
			border:1px solid #ccc;
			background:#eee;
			width:270px;
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
            height:25px;
            }
            fieldset{
            margin-top:0px;
            }
            fieldset legend{
            display:block;
            width:100%;
            padding:0;
            font-size:15px;
            line-height:inherit;
            color:#797979;
            border:0;
            border-bottom:1px solid #e5e5e5;
            }

            	/*css for webcam*/
            #video {
                border: 1px solid black;
                width: 500px;
                height: 500px;
            }
            #canvas {
        display: none;
    }

    .camera {
        width: 500px;
        display: inline-block;
    }

    .output {
        width: 500px;
        display: inline-block;
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

    .contentarea {
        font-size: 16px;
        font-family: Arial;
        text-align: center;
    }
    .circular--landscape { display: inline-block; position: relative; width: 100px; height: 100px; overflow: hidden; border-radius: 50%;background-color:rgb(180, 199, 216);border-style:solid solid solid solid;}
    .circular--landscape-img { width: auto; height: 100%; margin-left: -50px; }

    .tbl_currency .clickedrow td{
        background-color: #caaf8f;
    }

    #tbl_curbutton td{
        padding:0px;
    }
    #tbl_curbutton th{
        padding:5px;
    }
    .tbl_curbutton .clickedrow td{
        background-color: #96e970 !important;
    }
    .mybtn:hover{
        background-color:cyan;
    }
    .mybtn{
        padding:0px 5px;
        border:1px solid black;
    }
    .rotate-text {
        writing-mode: vertical-lr;
        transform: rotate(180deg);
        text-align: center;
        height: 100px; /* Adjust height as needed */
    }
    .rotate-input {
        transform: rotate(90deg);
        transform-origin: left top;
    }
     .td_userconnect {
            white-space: normal;
            word-wrap: break-word;
            max-width: 250px;
            }
        .d-none { display: none; }
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
    <table class="table">
        <tr>
            <td>
                <button type="button" id="btnaddcurrency" class="btn btn-primary">Add Currency</button>
                <button type="button" id="btnsetproductrate" class="btn btn-primary">P&P Rate</button>
                <button type="button" id="btnsetbutton" class="btn btn-primary">Create Button</button>

                <button type="button" id="btnactive" class="btn btn-outline-primary"><i class="fa fa-list"></i> Currency List</button>
                <button type="button" id="btndisactive" class="btn btn-outline-primary" style="color:red;"><i class="fa fa-trash"></i> Trash List</button>
                <input type="hidden" id="txtstatus" value="1">
            </td>
            <td>
                <select name="selcompany" id="selcompany" class="form-select kh16-b">
                    <option value="all">All Company</option>
                    @foreach ($companies as $comp)
                        <option value="{{ $comp->id }}" {{ $comp->id==$selcomid?'selected':'' }}>{{ $comp->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-select kh22" name="viewcol" id="viewcol">
                    <option value="">Select L M R</option>
                    <option value="l">Left</option>
                    <option value="m">Middle</option>
                    <option value="r">Right</option>
                </select>
            </td>

        </tr>
    </table>
</div>

<div class="row" id="currency_table">
    <table class="table table-bordered tbl_currency" id="tbl_currency" style="width:100%;table-layout:fixed">
        <thead class="table-dark" id="myHeader"  style="text-align:center;position:sticky;top:60px;">
            <tr>
                <th style="width:60px;" scope="col">N <sup>o</sup></th>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th style="width:120px;" scope="col">Currency</th>
                <th scope="col">Buy</th>
                <th scope="col">Sale</th>
                <th scope="col">Ratio</th>
                <th scope="col">RateBuy</th>
                <th scope="col">RateSale</th>
                <th scope="col">OperCol</th>
                <th scope="col">iMFP</th>
                <th scope="col">PCUR</th>
                <th scope="col">ImgDec</th>
                <th scope="col">UserAffect</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody id="currencylist">
            @foreach ($currencies as $key => $c)
                <tr>
                    <td style="text-align:center;">{{ ++$key }}</td>
                    <td style="border-style:none;padding:0px 0px 0px 20px;">
                        <input type="text" class="rotate-input kh14-b" style="width:105px" value="{{$c->company->name??''}}" readonly>
                        <input type="text" class="form-control txtno kh22" style="text-align:center;width:75px;" value="{{ $c->no }}" data-id="{{ $c->id }}">
                    </td>

                    <td style="padding:0px;">
                        <div class="circular--landscape">
                            <img style=" width: auto; height: 100%; margin-left:{{ $c->imglocation . 'px' }};"
                                src="{{ config('helper.asset_path')}}/myimages/{{ $c->imgpath }}" />
                        </div>
                    </td>
                    <td class="kh16" style="text-align:center;">
                        {{ $c->curname }} <br>
                        <span style="font-size:12px;">{{  $c->shortcut . '(' . $c->sk . ')' }}</span> <br>
                        <span style="font-size:12px;">{{  $c->id . $c->skey  }}</span>

                    </td>

                    <td class="kh16">{{ phpformatnumber($c->buy) }}</td>
                    <td class="kh16">{{ phpformatnumber($c->sale) }}</td>
                    <td class="kh16">{{ $c->ratio }}</td>
                    <td class="kh16">{{ phpformatnumber($c->ratebuy) }}</td>
                    <td class="kh16">{{ phpformatnumber($c->ratesale) }}</td>
                    <td>
                       OP: {{ $c->optsign }} <br>
                       Col:{{ $c->lmr }} <br>
                       តួចែក:{{ $c->tuochek??1 }}

                    </td>
                    <td>
                        Main:{{ $c->ismain }} <br>
                        Fn:{{ $c->isfn }} <br>
                        PP:{{ $c->ispandp }}
                    </td>

                    <td>
                        Pcur:{{ $c->partner_cur }} <br>
                        CD: {{ $c->iscustomerdisplay }} <br>
                        isGold:{{ $c->isgold??0 }}
                    </td>

                    <td>
                        ImgL:{{ phpformatnumber($c->imglocation) }} <br>
                        ក្បៀស:{{ $c->decpoint }} <br>
                        លំអៀង:{{ phpformatnumber($c->lomeang) }}

                    </td>
                    {{-- <td style="">
                        {{ App\Customer::separate_userconnect($c->user_connect) }}
                    </td> --}}
                    @php
                        $userconnectData = App\Customer::separate_userconnect($c->user_connect, 2, true);
                    @endphp

                    <td class="td_userconnect">
                        <span class="short-text">{!! $userconnectData['html'] !!}</span>
                        <span class="full-text d-none">{!! App\Customer::separate_userconnect($c->user_connect) !!}</span>

                        @if($userconnectData['has_more'])
                            <a href="javascript:void(0)" class="toggle-text kh14" style="color:blue;">more</a>
                        @endif
                    </td>
                    <td style="">
                        <a href="" class="btn btn-warning btnedit kh16" data-id="{{ $c->id }}" style="width:60px;margin-bottom:5px;">កែ</a> <br>
                        <a href="" class="btn btn-danger btndel kh16" data-id="{{ $c->id }}" style="width:60px;">លុប</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@include('currencies.createcurrency')
@include('currencies.productrate')
@include('currencies.webcam_modal')
@include('currencies.button_modal')
@endsection
@section('script')
<script src="{{ config('helper.asset_path') }}/js/video.js"></script>
<script src="{{ config('helper.asset_path') }}/js/numberinput.js"></script>

<script type="text/javascript">
    $('#h1_title').text('កំណត់រូបិយប័ណ្ណ');
    $(document).ready(function(){
        $('.seluserconnect').select2();

        var today=new Date();

        $('#invdate,#invdate1').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            var cleave = new Cleave('#buy', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#sale', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleavelomeang = new Cleave('#lomeang', {
                numeral: true,
                numeralDecimalScale: 6,
            });
            var cleave = new Cleave('#p_rate', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
             $(document).on('click', '.toggle-text', function() {
                const $td = $(this).closest('td');
                const $short = $td.find('.short-text');
                const $full = $td.find('.full-text');

                if ($full.hasClass('d-none')) {
                    // show full
                    $short.addClass('d-none');
                    $full.removeClass('d-none');
                    $(this).text('less');
                } else {
                    // show short
                    $short.removeClass('d-none');
                    $full.addClass('d-none');
                    $(this).text('more');
                }
            });
         //Highlight clicked row
         $(document).on('click','.tbl_currency td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })

         $(document).on('click','.tbl_curbutton td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
        $(document).keydown(function (event) {
           if(event.keyCode==13){
                return false;
           }
        })
        $(document).on('keydown','.txtno',function(e){

	 	if (e.keyCode == 13) {
	 		// var row = $(this).closest('tr');
         	//var rowind=row.find("td:eq(0)").text();
        	var curid=$(this).data('id');
        	var no=$(this).val();

	 		var url="{{ route('updatecurrencyno') }}";
	 		$.post(url,{curid:curid,no:no},function(data){
	 			//console.log(data)
	 			//alert(data.v);

	 			if(data.v==1){
                    getcurrencylist()
				    toastr.success('Update Currency No Successfully');
	 			}
	 		})

	 		var $this = $(this),
			index = $this.closest('td').index();
			$this.closest('tr').next().find('td').eq(index).find('input').focus().select();
	 		e.preventDefault();
	 	}
	 })
        $(document).on('keyup','#circleleft',function(e){
            e.preventDefault();
            var imgleft='-50px';
            imgleft=$(this).val();

             var cols = document.getElementsByClassName('circular--landscape-img');
            //var cols = document.querySelectorAll('.circular--landscape');
            //debugger;
            for(i=0; i<cols.length; i++) {
                cols[i].style.marginLeft=imgleft +'px';
                //cols[i].style.backgroundColor = 'transparent';
                // cols[i].style.width = 'inheret';
                // cols[i].style.borderRadius = '0';
                // cols[i].style.padding = '0';
                // cols[i].style.border = 'none';
            }
        })
        //-------------image capture
        $('#browse_file').on('click',function(){
			$('#clickcapture').val(0);
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
                    $('#imgcircle').attr('src',e.target.result);

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
		$(document).on('click','#capture',function(e){
			e.preventDefault();
			$('#webcam_modal').modal('show');
		})
        $(document).on('keydown','.canenter',function(e){
				 if (e.keyCode == 13) {
			        var $this = $(this),
			        index = $this.closest('td').index();
			        $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
			        e.preventDefault();
			    }
			})
        $('.crate').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
        $('#btnaddcurrency').click(function(e){
            e.preventDefault();
            $('#modalcurrency').modal('show');
            $('#frmcurrency').trigger('reset');
            $('#seluserconnect').trigger('change');
            $('#invdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            $('#showPhoto').attr('src','{{ config('helper.asset_path') }}/logo/NoPicture.jpg');
            $('#imgcircle').attr('src','{{ config('helper.asset_path') }}logo/NoPicture.jpg');
            $('#modalheader').text('ចុះឈ្មោះរូបិយប័ណ្ណ');
            $('#btnsave').text('រក្សាទុក');
            getmaxnumber();
        })
        $('#btnsetproductrate').click(function(e){
            e.preventDefault();
            $('#modalproductrate').modal('show');

        })
        $('#newbutton').click(function(e){
            e.preventDefault();
            $('#selcur9').val('');
            $('#selcur8').val('');
            var lastRowIndex = $('#tbl_curbutton tr').length;
            $('#button_no').val(lastRowIndex);
        })
        $('#btnsetbutton').click(function(e){
            e.preventDefault();
            $('#buttonmodal').modal('show');
            var lastRowIndex = $('#tbl_curbutton tr').length;
            $('#button_no').val(lastRowIndex);
        })
        $(document).on('click','.btnedit',function(e){
                    e.preventDefault();
                    var id =$(this).data('id');

                    $.get("{{ route('currencyedit') }}",{id:id},function(data){
                        //console.log(data)
                        $('#modalcurrency').modal('show');
                        //triggerchangeselect2(data['loan']['customer_id'],data['loan']['location_id'],data['loan']['itemgroup_id'],data['loan']['itemtype_id'])
                        //$('#invdate').val(moment(data['loan']['trdate']).format('DD-MM-YYYY'));
                        //$('#ratedate').val(moment(data['loan']['ratedate']).format('DD-MM-YYYY'));
                        //debugger;
                        var userconnect=data['currency']['user_connect'];
                        if(userconnect!==null){
                            if(userconnect.indexOf(',')>=0){
                                userconnect=data['currency']['user_connect'].split(',');
                            }
                        }
                        $('#seluserconnect').val(userconnect);
                        $('#seluserconnect').trigger('change');
                        $('#curname').val(data['currency']['curname']);
                        $('#no').val(data['currency']['no']);
                        $('#shortcut').val(data['currency']['shortcut']);
                        $('#shortcut1').val(data['currency']['sk']);
                        $('#skey').val(data['currency']['skey']);
                        $('#optsign').val(data['currency']['optsign']);
                        $('#ratio').val(data['currency']['ratio']);
                        $('#tuochek').val(data['currency']['tuochek']);
                        $('#decpoint').val(data['currency']['decpoint']);
                        $('#lomeang').val(formatNumber(data['currency']['lomeang']));
                        $('#buy').val(formatNumber(data['currency']['buy'],data['currency']['decpoint']));
                        $('#sale').val(formatNumber(data['currency']['sale'],data['currency']['decpoint']));
                        $('#ratebuy').val(formatNumber(data['currency']['ratebuy'],data['currency']['decpoint']));
                        $('#ratesale').val(formatNumber(data['currency']['ratesale'],data['currency']['decpoint']));
                        $('#circleleft').val(formatNumber(data['currency']['imglocation']));
                        $('#company').val(data['currency']['company_id']);
                        if(data['currency']['lmr']=='m'){
                            const lm = document.getElementById('loc_middle');
                            lm.checked = true;
                        }else if(data['currency']['lmr']=='r'){

                            const lr = document.getElementById('loc_right');
                            lr.checked = true;
                        }else{
                            const ll = document.getElementById('loc_left');
                            ll.checked = true;

                        }

                        if(data['currency']['ismain']==1){
                            $('#ismaincur').prop('checked',true);
                        }else{
                            $('#ismaincur').prop('checked',false);
                        }

                        if (data['currency']['isfn'] == 1) {
                            $('#isfn').prop('checked', true);
                        } else {
                            $('#isfn').prop('checked', false);
                        }

                        if(data['currency']['active']==1){
                            $('#isactive').prop('checked',true);
                        }else{
                            $('#isactive').prop('checked',false);
                        }

                        if(data['currency']['ispandp']==1){
                            $('#ispandp').prop('checked',true);
                        }else{
                            $('#ispandp').prop('checked',false);
                        }
                        if(data['currency']['partner_cur']==1){
                            $('#ispartnercurrency').prop('checked',true);
                        }else{
                            $('#ispartnercurrency').prop('checked',false);
                        }
                        if(data['currency']['iscustomerdisplay']==1){
                            $('#iscustomerdisplay').prop('checked',true);
                        }else{
                            $('#iscustomerdisplay').prop('checked',false);
                        }
                        if(data['currency']['isgold']==1){
                            $('#isgold').prop('checked',true);
                        }else{
                            $('#isgold').prop('checked',false);
                        }
                        // data['currency']['ismain']? $('#ismaincur').attr('checked',true):$('#ismaincur').attr('checked',false)
                        // data['currency']['isfn']? $('#isfn').attr('checked',true): $('#isfn').attr('checked',false)
                        // data['currency']['active']? $('#isactive').attr('checked',true): $('#isactive').attr('checked',false)
                        // data['currency']['ispandp']? $('#ispandp').attr('checked',true): $('#ispandp').attr('checked',false)
                        $('#image').val('');
                        $('#curid').val(data['currency']['id'])
                        if(data['currency']['imgpath']==''){
                            $('#showPhoto').attr('src','{{ config('helper.asset_path') }}/logo/NoPicture.jpg');
                            $('#imgcircle').attr('src','{{ config('helper.asset_path') }}/logo/NoPicture.jpg');
                        }else{
                            $('#showPhoto').attr('src','{{ config('helper.asset_path') }}/myimages/'+data['currency']['imgpath']);
                            $('#imgcircle').attr('src','{{ config('helper.asset_path') }}/myimages/'+data['currency']['imgpath']);

                        }
                        var cols = document.getElementsByClassName('circular--landscape-img');
                        for(i=0; i<cols.length; i++) {
                            cols[i].style.marginLeft=$('#circleleft').val() +'px';
                        }
                        $('#old_image').val(data['currency']['imgpath']);
			            $('#modalheader').text('កែប្រែរូបិយប័ណ្ណ');
                        $('#btnsave').text('កែប្រែ');
                    })
                })

                $(document).on('click','.btnpedit',function(e){
                    e.preventDefault();
                    var id=$(this).data('id');
                    var row=$(this).closest('tr');
		  	        var rate=row.find("td:eq(3) input[type='text']").val();
                    var sign=row.find("td:eq(4) .coperator :selected").text();

                    var url="{{ route('updateproduct') }}";
                    $.post(url,{id:id,rate:rate,sign:sign},function(data){
                        console.log(data)
                        if(!data.error){

                            getproductlist();
                        }else{
                            alert(data.error)
                        }
                    })

                })
                $(document).on('click','.btnpdel',function(e){
                    e.preventDefault();
                    var id=$(this).data('id');
                    var q = confirm("Do you want to remove this item?");
                    if (q) {
                        var url="{{ route('deleteproduct') }}";
                       $.post(url,{id:id},function(data){
                            //console.log(data)
                            if(!data.error){
                                //alert(data.success);
                                getproductlist();
                            }else{
                                alert(data.error)
                            }
                       })
                    }
                })
                $(document).on('click','.btndel',function(e){
                    e.preventDefault();
                    var status=$(this).data('status');

                    Swal.fire({
                    title: 'Are you sure to remove this currency?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var curid = $(this).data("id");

                            $.ajax({
                                async: true,
                                type: 'POST',
                                dataType:'JSON',
                                contentType: 'application/json;charset=utf-8',
                                url: "{{ route('deletecurrency') }}",
                                data: { id: curid,status:status },
                                success: function (data) {
                                    console.log(data);
                                    if (data.success === true) {
                                        getcurrencylist();
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
                $(document).on('click','.btndelbutton',function(e){
                    e.preventDefault();
                    Swal.fire({
                    title: 'Are you sure to remove this button?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var bid = $(this).data("id");

                            $.ajax({
                                async: true,
                                type: 'POST',
                                dataType:'JSON',
                                contentType: 'application/json;charset=utf-8',
                                url: "{{ route('deletecurrencybutton') }}",
                                data: { id: bid },
                                success: function (data) {
                                    console.log(data);
                                    if (data.success === true) {
                                        getbuttonlist();
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
            $(document).on('click','.btnrestore',function(e){
                    e.preventDefault();
                    Swal.fire({
                    title: 'Are you sure to restore this currency?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var curid = $(this).data("id");

                        $.ajax({
                            async: true,
                            type: 'POST',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('restorecurrency') }}",
                            data: { id: curid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    getcurrencylist();
                                    Swal.fire(
                                        'Restore!',
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
        function checkexistsproduct(){
            var see=false;
            var url="{{ route('checkcurrencyproduct') }}";
            var cur=$('#selcur1').val() + '-' + $('#selcur2').val();
            $.get(url,{cur:cur},function(data){
                //console.log(data)
                see=data.exists;

            })
            return see;
        }
        $('#btnupdateall').click(function(e){
            var frmdata=$('#frmproductrate').serialize();
            var url="{{ route('updateallpprate') }}"
            $.post(url,frmdata,function(data){
                //console.log(data)
               if(data.success){
                    toastr.success(data.success);
                    getproductlist();
               }else{
                toastr.error(data.error);

               }
            })
        })
        $('#btnsavepp').click(function(e){
            e.preventDefault();
            var b=checkexistsproduct();
            if(b==true){
                alert('this currency rate already exists')
                return;
            }

            var frmdata=$('#frmproductrate').serialize();
            var url="{{ route('savepexchangep') }}"
            $.post(url,frmdata,function(data){
                //console.log(data)
               if(data.success){
                    toastr.success(data.success);
                    getproductlist();
               }else{
                //toastr.error(data.error);
                alert(data.error);
               }
            })
        })
        $('#btnsavebutton').click(function(e){
            e.preventDefault();
            $('body').addClass("wait");
            var s1=$('#selcur8 option:selected').text();
            var s2=$('#selcur9 option:selected').text();
            var shortcut2=s1 + '-' + s2;
            var formdata=new FormData(frmsetbutton);
            formdata.append('shortcut2',shortcut2);
            var url="{{ route('saveexchangebutton') }}"
            $.ajax({
              async: true,
              type: 'POST',
              contentType: false,
              processData: false,
              url: url,
              data: formdata,
              complete: function () {

              },
              success: function (data) {

                  //console.log(data)
                  if($.isEmptyObject(data.error)){

                    toastr.success("Save Currency Button Successfully");
                    var btnlist=data.currencybuttons;
                    var output='';
                    var k=0;
                    for(var i=0;i<btnlist.length;i++){
                            k+=1;
                            output +=
                            `<tr>
                                <td class="kh16-b" style="text-align:center;">
                                    ${k}
                                </td>
                                <td class="kh16-b" style="width:80px;">
                                    <input type="text" value="${btnlist[i].no}" class="kh16-b" style="border-style:none;width:80px;text-align:center;border:1px solid black;">
                                </td>
                                <td class="kh16-b" style="text-align:center;">
                                    ${btnlist[i].id12}
                                </td>
                                <td class="kh16-b" style="text-align:center;">
                                    ${btnlist[i].btnname}
                                </td>
                                <td class="kh16-b" style="text-align:center;">
                                    <a href="" class="mybtn btndelbutton" style="color:red;" data-id="${btnlist[i].id}">លុប</a>
                                </td>
                            </tr>`;
                        }
                        $('#buttonlist').empty().html(output);
                        $('#button_no').val(k);
                        $('body').removeClass("wait");
                        //$(el).removeAttr('disabled').html(buttontext);
                  }else{
                      $('body').removeClass("wait");
                      alert(data.error)
                      //$(el).removeAttr('disabled').html(buttontext);
                  }
              },
              error: function () {
                  $('body').removeClass("wait");
                  alert('Save Error.')
                  //$(el).removeAttr('disabled').html(buttontext);
              }

          })

        })
        $('#frmcurrency').on('submit',function(e){
				e.preventDefault();
				var data= new FormData(this)
                var update=0;
                if($('#curid').val()==''){
					remsearch=0;
					var urlset="{{ route('createcurrency') }}"
				}else{
					var urlset="{{ route('updatecurrency') }}"
					update=1;
				}

				$.ajax({
						type:"POST",
						url:urlset,
						data:data,
						datatype:"JSON",
						contentType:false,
						cache:false,
						processData:false,
						success:function(data){
							//console.log(data)
							if($.isEmptyObject(data.error)){
                                //$('#frmcurrency').trigger("reset");
                                $('#curname').val('');
                                $('#buy').val('');
                                $('#sale').val('');
                                $('#ratebuy').val('');
                                $('#ratesale').val('');
                                $('#skey').val('');
                                $('#shortcut').val('');
                                $('#shortcut1').val('');

                                if(update==1){
                                    console.log(data);
                                    toastr.success('Update Currency Successfully');

                                    $('#modalcurrency').modal('hide');

                                }else{
                                    toastr.success(data.success);

                                    getmaxnumber();

                                    $('#showPhoto').attr('src','{{ config('helper.asset_path') }}/logo/NoPicture.jpg');
                                    $('#imgcircle').attr('src','{{ config('helper.asset_path') }}logo/NoPicture.jpg');
                                    $('#clickcapture').val(0);
                                    //location.reload();
                                }
                                $('#invdate').datetimepicker({
                                        timepicker:false,
                                        datepicker:true,
                                        value:today,
                                        format:'d-m-Y',
                                        autoclose:true,
                                        todayBtn:true,
                                        startDate:today,

                                    });
                                getcurrencylist();
                                //$('#addloanModal').modal('hide');

							}else{
								alert(data.error)
							}
						}
					});
				});
        $(document).on('change','#buy,#sale',function(){
            calculrate();
        })
        $(document).on('change','#ratio',function(){
            calculrate();
        })
        $(document).on('change','input.bnum',function(e){
            e.preventDefault();
            $('body').addClass("wait");
            var row = $(this).closest('tr');
            var id = row.find('.btndelbutton').data('id');
            var no=$(this).val();
            var url="{{ route('update_currency_button') }}"
              $.ajax({
                  async: true,
                  type: 'GET',
                  url: url,
                  data: {id:id,no:no},
                  success: function (data) {
                    //console.log(data)
                     if($.isEmptyObject(data.error)){
                          toastr.success(data.success);
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

    })
    function calculrate()
    {
        var ratio=$('#ratio').val();
        var buy=$('#buy').val().replace(/,/g,'');
        var sale=$('#sale').val().replace(/,/g,'');
        var decp=$('#decpoint').val();
        var ratebuy=(buy/ratio).toFixed(6);
        var ratesale=(sale/ratio).toFixed(6);
        $('#ratebuy').val(formatNumber(ratebuy,decp));
        $('#ratesale').val(formatNumber(ratesale,decp));
        // $('#ratebuy').val(ratebuy);
        // $('#ratesale').val(ratesale);
    }
    function getmaxnumber(){
        $('#ratio').val(1);
        var lastRowIndex = $('#tbl_currency tr').length;
        $('#no').val(lastRowIndex);
        // var url="{{ route('getcurrencynumber') }}";
        // $.get(url,{},function(data){
        //     if($.isEmptyObject(data.error)){
        //         $('#no').val(data.maxno+1);

        //     }else{
        //         $('#no').val(1);
        //     }
        // })

    }
    $(document).on('input', '.bnum', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $(document).on('keydown','.tdcanenter',function(e){
       if (e.keyCode == 13) {
            var $this = $(this),
            index = $this.closest('td').index();
            $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
            e.preventDefault();
        }
      })
    $(document).on('click','#btnrefreshbutton',function(e){
        e.preventDefault();
        getbuttonlist();
    })
    $(document).on('click','#btnactive',function(e){
        e.preventDefault();
        $('#txtstatus').val(1)
        getcurrencylist()
    })
    $(document).on('click','#btndisactive',function(e){
        e.preventDefault();
        $('#txtstatus').val(0)
        getcurrencylist()
    })
    $(document).on('change','#viewcol,#selcompany',function(e){
        e.preventDefault();
        getcurrencylist()
    })
    function getcurrencylist(){
        var url="{{ route('currencylist') }}";
        var active=$('#txtstatus').val();
        var viewcol=$('#viewcol').val();
        var company=$('#selcompany').val();
        $.get(url,{active:active,viewcol:viewcol,company:company},function(data){
            //console.log(data)
            if(!data.error){
                $('#currencylist').empty().html(data);
            }else{
                alert(data.error)
            }
        })
    }
    function getproductlist(){
        var url="{{ route('productlist') }}";
        $.get(url,{},function(data){
            //console.log(data)
            if(!data.error){
                $('#productlists').empty().html(data);
            }else{
                alert(data.error)
            }
        })
    }

    function getbuttonlist(){
        $('body').addClass("wait");
        var url="{{ route('getcurrencybutton') }}";
        $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {},
                complete: function () {

                },
                success: function (data) {
                  //console.log(data);
                  var k=0;
                  var btnlist=data['currencybuttons'];
                  var output='';
                  for(var i=0;i<btnlist.length;i++){
                        k+=1;
                        output +=
                        `<tr>
                            <td class="kh16-b" style="text-align:center;">
                                ${k}
                            </td>
                            <td class="kh16-b" style="width:80px;">
                                <input type="text" value="${btnlist[i].no}" class="kh16-b bnum tdcanenter" style="border-style:none;width:80px;text-align:center;border:1px solid black;">
                            </td>
                            <td class="kh16-b" style="text-align:center;">
                                ${btnlist[i].id12}
                            </td>
                            <td class="kh16-b" style="text-align:center;">
                                ${btnlist[i].btnname}
                            </td>
                            <td class="kh16-b" style="text-align:center;">
                                <a href="" class="mybtn btndelbutton" style="color:red;" data-id="${btnlist[i].id}">លុប</a>
                            </td>
                        </tr>`;
                    }
                    $('#buttonlist').empty().html(output);
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read currency button error.')
                }
            })
      }



</script>
@endsection
