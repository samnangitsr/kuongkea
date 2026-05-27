@extends('master')
@section('title') user offer @endsection
@section('css')
    <style type="text/css">
          body.wait, body.wait *{
			cursor: wait !important;
		}
         #selbank + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;background-color:whitesmoke;}
		/* Each result */
		#select2-selbank-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white}
		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 47px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
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
        }

       .cgr{
        background-color:aquamarine;
       }
       .hiddenrow{
        display:none;
       }
    .tbloffer .clickedrow td{
        background-color: #caaf8f;
    }
    .tbloffer .clickedrow td input{
        background-color: #caaf8f;
    }
    #divfooter{

        color:white;
        margin: auto;
        margin-left:-20px;
        margin-right:0px;
        padding-bottom:0px;
        position: fixed;
        bottom: 40px;
        max-width: 85%;
        /* min-height: 125px;
        max-height: 125px; */
        /* background-color: rgb(195, 201, 206); */
        color: white;
        max-height : 200px;
        overflow:auto;
        clear: both;
    }
    #tbl_offer_accept_modal td{
        border-style:none;
        padding:3px;
    }
     #tbl_offer_accept_modal td input{
        height:36px;
    }
     #tbl_offer_accept_modal td select{
         height:36px;
    }
    #tbl_offer_modal td{
        border-style:none;
    }
    .mybtn{
        border-style:none;
        background-color:rgb(85, 233, 233);
    }
    .mybtn:hover{
        background-color:aqua;
    }

        #tbloffer th{
            padding:5px;
            background-color:azure;
        }
        #tbloffer td{
            padding:3px;
        }
        #tbl_offer_modal td{
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
    <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
    <input id="txtuserid" type="hidden" value="{{ Auth::id() }}">
   <div class="row" style="margin-top:-10px;margin-bottom:10px;">

        <div class="table-responsive">
            <table class="">

                <tr>
                    <td style="border-style:none;" class="kh16">កាលបរិច្ឆេទ</td>
                    <td class="kh16" style="border-style:none;">
                        ក្រុមហ៊ុន
                    </td>
                    <td class="kh16" style="border-style:none;">
                        ជ្រើសរើសបុគ្គលិក
                    </td>

                    <td style="border-style:none;padding-left:10px;">
                        <div class="form-check">
                            <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radoffer" id="radoffer" value="0" checked>
                            <label class="form-check-label kh16" style="color:darkgreen;" for="radoffer">ស្នើរមិនទាន់បានសំរេច</label>
                        </div>

                    </td>
                    <td style="border-style:none;padding-left:10px;">
                        <div class="form-check">
                            <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radoffer" id="radoffercomplete" value="1">
                            <label class="form-check-label kh16" style="color:blue;" for="radoffercomplete">ស្នើរបានសំរេច</label>
                        </div>

                    </td>
                    <td style="border-style:none;padding-left:10px;">
                        <div class="form-check">
                            <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radoffer" id="radofferreject" value="-1" >
                            <label class="form-check-label kh16" style="color:red;" for="radofferreject">បដិសេធការស្នើរ</label>
                        </div>
                    </td>
                    <td style="border-style:none;"></td>
                </tr>
                <tr>
                    <td style="border-style:none;padding:0px;">
                        <div class="input-group" style="width:150px;">
                            <input type="text" name="showdate" id="showdate" class="form-control" style="width:90px;height:30px;background-color:silver;font-size:16px;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td style="padding:0px;border-style:none;width:180px;">

                            <select name="selcompany" id="selcompany" class="kh16-b" style="width:100%;">
                                @foreach ($companies as $comp)
                                    <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}} @if(Auth::user()->role->name!='Admin' && $comp->id!=$selcomid) disabled @endif>{{ $comp->name }}</option>
                                @endforeach
                            </select>

                    </td>

                    <td style="border-style:none;padding:0px;width:120px;">
                        <select name="seluser_record" id="seluser_record" class="kh16" style="">
                            <option value="all">បុគ្គលិកទាំងអស់</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ $u->id==Auth::id()?'selected':'' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td style="border-style:none;padding:5px 10px 10px 10px;">
                        <button id="btnshow" class="btn-3d kh16">បង្ហាញ</button>
                    </td>
                    <td style="padding:5px 10px 10px 10px;">
                        <button id="btnoffer" class="btn-3d btn-3d-primary kh16">ស្នើប្រាក់</button>
                    </td>

                </tr>

            </table>
        </div>
   </div>
   <div id='contentbody'>
       <div class="row">
            <div class="card" style="padding:0px;">
                <div id="cardheader" style="background-color:rgb(216, 231, 216);height:35px;" class="card-header">
                    <h3 id="c_title" class="kh16-b" style="color:rgb(7, 29, 158);">តារាងស្នើរប្រាក់របស់បុគ្គលិក</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="tbloffer" class="table table-bordered table-hover tbloffer kh16">
                                <thead style="text-align:center;">
                                    <th>លរ</th>
                                    <th>ម៉ោង</th>
                                    <th>អ្នកស្នើរ</th>
                                    <th>ស្នើរទៅ</th>
                                    <th>ប្រភេទស្នើ</th>
                                    <th>ចំនួនទឹកប្រាក់</th>
                                    <th>ចំនួនកាត់កង</th>
                                    <th>លេខយោង</th>
                                    <th>ផ្សេងៗ</th>
                                    <th>សកម្មភាព</th>

                                </thead>
                                <tbody id="tbl_useroffer">
                                    @foreach ($moneyoffers as $key =>$m)
                                        <tr>
                                            <td style="text-align:center;">{{ ++$key }}</td>
                                            <td>{{ $m->offer_time }}</td>
                                            <td>{{ $m->offerby->name }}</td>
                                            <td>{{ $m->offerto->name }}</td>
                                            <td>{{ $m->offer_type }}</td>
                                            <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($m->amount) . $m->currency->sk }}</td>
                                            <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($m->amount1) . $m->currency1->sk }}</td>
                                            <td>{{ $m->ref_number }}</td>
                                            <td>{{ $m->accept_note }}</td>
                                            <td style="text-align:center;">
                                                @if(Auth::user()->role->name=='Admin')
                                                    @if($m->status==1)
                                                        @if($m->isaccept==0)
                                                            @if($m->offer_to_user_id==Auth::id())
                                                                <a href="#" class="btn-3d btn-ok" data-offer_id="{{ $m->id }}"
                                                                data-usercashin_id="{{ $m->offer_by_user_id }}" data-usercashin="{{ $m->offerby->name }}"
                                                                data-usercashout_id="{{ $m->offer_to_user_id }}" data-usercashout="{{ $m->offerto->name }}" data-offertype1="{{ $m->offer_type1 }}"
                                                                data-amount3="{{ $m->amount }}" data-selcur3="{{ $m->currency_id }}" data-customer_id="{{ $m->customer_id }}" data-customer_id1="{{ $m->customer_id1 }}"
                                                                data-amount4="{{ $m->amount1 }}" data-selcur4="{{ $m->currency_id1 }}" data-offertype="{{ $m->offer_type }}">យល់ព្រម</a>
                                                            @endif
                                                                <a href="#" class="btn-3d btn-3d-warning btn-continue" data-offer_id="{{ $m->id }}" data-usercashin_id="{{ $m->offer_by_user_id }}"
                                                                data-usercashin="{{ $m->offerby->name }}" data-usercashout_id="{{ $m->offer_to_user_id }}"
                                                                data-usercashout="{{ $m->offerto->name }}">បន្តបុគ្គលិក</a>
                                                                <a href="#" class="btn-3d btn-3d-danger btn-reject" data-offer_id="{{ $m->id }}">លុបសំណើរ</a>
                                                        @else
                                                            <a href="#" class="btn-3d btn-3d-danger btn-ko" data-offer_id="{{ $m->id }}">លុបការយល់ព្រម</a>
                                                        @endif
                                                    @else
                                                        <a href="#" class="btn-3d btn-3d-primary btn-restore" data-offer_id="{{ $m->id }}">យកវិញ</a>
                                                    @endif
                                                @else
                                                    @if($m->offer_to_user_id==Auth::id())
                                                        @if($m->status==1)
                                                            @if($m->isaccept==0)
                                                                <a href="#" class="btn-3d btn-ok" data-offer_id="{{ $m->id }}"
                                                                data-usercashin_id="{{ $m->offer_by_user_id }}" data-usercashin="{{ $m->offerby->name }}"
                                                                data-usercashout_id="{{ $m->offer_to_user_id }}" data-usercashout="{{ $m->offerto->name }}" data-offertype1="{{ $m->offer_type1 }}"
                                                                data-amount3="{{ $m->amount }}" data-selcur3="{{ $m->currency_id }}" data-customer_id="{{ $m->customer_id }}" data-customer_id1="{{ $m->customer_id1 }}"
                                                                data-amount4="{{ $m->amount1 }}" data-selcur4="{{ $m->currency_id1 }}" data-offertype="{{ $m->offer_type }}">យល់ព្រម</a>
                                                                <a id="2.4.5" href="#" class="btn-3d btn-3d-warning btn-continue" data-offer_id="{{ $m->id }}" data-usercashin_id="{{ $m->offer_by_user_id }}"
                                                                data-usercashin="{{ $m->offerby->name }}" data-usercashout_id="{{ $m->offer_to_user_id }}"
                                                                data-usercashout="{{ $m->offerto->name }}">បន្តបុគ្គលិក</a>
                                                            @else
                                                                {{-- <a href="#" class="btn-3d btn-3d-danger btn-ko" data-offer_id="{{ $m->id }}">លុបការយល់ព្រម</a> --}}
                                                            @endif
                                                        @else
                                                            {{-- <a href="#" class="btn-3d btn-3d-primary btn-restore" data-offer_id="{{ $m->id }}">យកវិញ</a> --}}
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
       </div>

   </div>

    @include('usercapitals.offerform')
    @include('usercapitals.offerformaccept')
    @include('usercapitals.offercontinue')
@endsection
@section('script')

    <script type="text/javascript">
         $('#h1_title').text('ការស្នើប្រាក់');
        function checkright()
        {
            $('#seluser').val($('#txtuserid').val());
            var role=$('#txtrole').val();
            if(role!='Admin'){
                $('#showdate').datetimepicker("destroy");
                $('#offerdate').datetimepicker("destroy");
                $('#seluser_record').attr('disabled',true);

            }
        }
       $(document).ready(function () {
            var today=new Date();
            $('#trandate,#showdate,#offerdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });

            checkright();
            var cleave = new Cleave('#amount1', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#txtrate', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            $(document).on('change','#selcur1',function(e){
                e.preventDefault();
                getcurrencybyidlocalstorage($(this).val(),'#selcur1');
            })
            $(document).on('change','#selcurkatkong',function(e){

                e.preventDefault();
                var cur=$('#selcurkatkong option:selected').text();
                $('#cur2').val(cur);
                getcurrencybyidlocalstorage($(this).val(),'#selcurkatkong');

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
                    getcurrencybykeylocalstorage(C,'#selcurkatkong')
                }
            })
            function getrate() {
                //debugger;
                $('#txtrate').attr('title', '');
                var m = $('#selcur1').attr('title').split(";");
                var p = $('#selcurkatkong').attr('title').split(";");
                if(m=='' || p==''){
                    //alert('can not save')
                    return;
                }
                //check if the save curname
                //debugger
                if (m[6] == p[6]) {
                    $('#txtrate').val(1);
                    calcuexchange();
                    return;
                }
                //check if product exchange product
                if (m[4] == '0') {
                    if (p[4] == '0') {
                        runproductrate();
                        return;
                    }
                }

                if (m[4] == '1') {//if maincur=true
                    //$('#txtrate').val(formatNumber(parseFloat(p[2])));//get rate p sale
                    $('#txtrate').val(formatNumber(parseFloat(p[1])));//get rate p sale

                } else {
                    //$('#txtrate').val(formatNumber(parseFloat(m[1])));//get rate m buy
                    $('#txtrate').val(formatNumber(parseFloat(m[2])));//get rate m buy
                }

                $('#txtrate').attr('title',$('#txtrate').val());
                calcuexchange();

            }

            function calcuexchangeproduct() {
                //debugger;
                var luy = $('#amount1').val().replace(/,/g, '');
                var r = $('#txtrate').val().replace(/,/g, '');
                var rs = $('#txtrate').attr('title').split(";");

                // if (rs[2] == '*') {
                //     $('#amount2').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                // } else {
                //     $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                // }

                if (rs[2] == '*') {
                    $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $('#amount2').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }

            }
            function calcuexchange() {
                 //debugger
                var luy = $('#amount1').val().replace(/,/g, '');
                var r = $('#txtrate').val().replace(/,/g, '');
                var m1 = $('#selcur1').attr('title').split(";");
                var m2 = $('#selcurkatkong').attr('title').split(";");
                if (m1[4] == '1') { //if maincur=true
                    if (m2[3] == '/') {//if operator=/
                        $('#amount2').val(formatNumber(luy * r));
                    } else {
                        $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    }
                } else {
                    if (m2[4] == '1') {
                        if (m1[3] == '/') {
                            $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                        } else {
                            $('#amount2').val(formatNumber(luy * r));
                        }
                    } else {
                        calcuexchangeproduct();
                    }
                }
            }

        //     function getcurrencybykey(key,el)
        // {
        //     var url="{{ route('getcurrencybykey') }}";
        //     $.get(url,{key:key},function(data){
        //          //console.log(data)

        //             if(data['c']!=null){

        //                 $(el).val(data['c']['shortcut']);
        //                 $(el).attr('title', data['c']['id'] + ';' + parseFloat(data['c']['ratebuy']) + ';' + parseFloat(data['c']['ratesale']) + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
        //                 getrate();
        //             }



        //     })
        // }
        function runproductrate() {
                //debugger
                var url="{{ route('getproductrate') }}";
                var buycur = $('#selcur1 option:selected').text();
                var salecur = $('#selcurkatkong option:selected').text();
                var curname = '';
                //curname = buycur + '-' + salecur;
                curname = salecur + '-' + buycur;

                //alert(curname)
                // $.get(url,{curname:curname},function(data){
                //     if(data.success){

                //         $('#txtrate').val(formatNumber(parseFloat(data['pr']['rate'])));
                //         $('#txtrate').attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                //         calcuexchangeproduct();
                //     }else{
                //         $('#txtrate').val('');
                //         $('#txtrate').attr('title','');
                //     }
                //     console.log(data)

                // })

                var currencylist;
                if(localStorage.getItem("currencyproductlist")==null){
                    currencylist=[];
                }else{
                    currencylist=JSON.parse(localStorage.getItem("currencyproductlist"));
                }
                currencylist.forEach(function(c){

                    if(c.pshortcut==curname){
                        $('#txtrate').val(parseFloat(c.rate));
                        $('#txtrate').attr('title', c.pshortcut + ';' +  c.rate + ';' +  c.operator);
                        calcuexchangeproduct();
                    }
                })

            }

             $(document).on('change','#seltype',function(e){
                e.preventDefault();
                getcustomerbyseltype('#sel_customer_id',$(this).val());

            })
             $(document).on('change','#seltype1',function(e){
                e.preventDefault();
                getcustomerbyseltype('#sel_customer_id1',$(this).val());

            })
              function getcustomerbyseltype(el,seltype)
            {
                $(el).empty();
                var selcompany=$('#selcompany').val();

                $('body').addClass("wait");
                var url="{{ route('company.customerbytype') }}";
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {company_id:selcompany,seltype:seltype},

                    complete: function () {},
                    success: function (data) {
                         //console.log(data)
                         $(el).append($("<option/>",{
                                    value:'',
                                    text:'',
                            }))
                        $.each(data['banks'],function(i,item){
                            $(el).append($("<option/>",{
                                    value:item.id,
                                    text:item.name,
                            }))
                        });

                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            }
            $(document).on('change','#selcompany',function(e){
                e.preventDefault();
                getuserbycompany('#seluser_record','#seluser',showdata);

            })
            function getuserbycompany(el,el1,callback)
            {
                $(el).empty();
                $(el1).empty();
                $('#sellistin').empty();
                $('#sellistin1').empty();
                $('#sellistout').empty();
                $('#sellistout1').empty();

                var selcompany=$('#selcompany').val();
                $('body').addClass("wait");
                var url="{{ route('company.getuser') }}";
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {company_id:selcompany},

                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                         $(el).append($("<option/>",{
                                    value:'all',
                                    text:'បុគ្គលិកទាំងអស់',
                            }))
                        $.each(data['users'],function(i,item){
                            $(el).append($("<option/>",{
                                    value:item.id,
                                    text:item.name,
                            }))
                        });
                        $(el1).append($("<option/>",{
                                    value:'',
                                    text:'',
                            }))
                        $.each(data['users'],function(i,item){
                            $(el1).append($("<option/>",{
                                    value:item.id,
                                    text:item.name,
                            }))
                        });

                        $('#sellistout').append($("<option/>",{
                                value:'',
                                text:'cash',
                                customertype:'cash'
                        }))
                        $.each(data['banks'],function(i,item){
                            $('#sellistout').append($("<option/>",{
                                    value:item.id,
                                    text:item.name,
                                    customertype:item.customertype
                            }))
                        });
                        $('#sellistin').append($("<option/>",{
                                value:'',
                                text:'cash',
                                customertype:'cash'
                        }))
                        $.each(data['banks'],function(i,item){
                            $('#sellistin').append($("<option/>",{
                                    value:item.id,
                                    text:item.name,
                                    customertype:item.customertype
                            }))
                        });

                        $('#sellistout1').append($("<option/>",{
                                value:'',
                                text:'cash',
                                customertype:'cash'
                        }))
                        $.each(data['banks'],function(i,item){
                            $('#sellistout1').append($("<option/>",{
                                    value:item.id,
                                    text:item.name,
                                    customertype:item.customertype
                            }))
                        });
                        $('#sellistin1').append($("<option/>",{
                                value:'',
                                text:'cash',
                                customertype:'cash'
                        }))
                        $.each(data['banks'],function(i,item){
                            $('#sellistin1').append($("<option/>",{
                                    value:item.id,
                                    text:item.name,
                                    customertype:item.customertype
                            }))
                        });
                        callback();
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            }
            $(document).on('change','#ckkatkong',function(e){
                e.preventDefault();
               // debugger;
                var vk=document.getElementById('ckkatkong').checked;
                $('#selcurkatkong').prop('disabled', !vk);

            })
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                showdata();
            })
            $(document).on('change','#seluser_record,#radoffer,#radoffercomplete,#radofferreject',function(e){
                e.preventDefault();
                var id=$(this).attr('id');
                if(id=='radoffer'){
                    $('#c_title').text('តារាងស្នើរប្រាក់របស់បុគ្គលិក');
                   // $('#cardheader').css('background-color','green');
                }else if(id=='radoffercomplete'){
                    $('#c_title').text('តារាងស្នើរប្រាក់បានជោគជ័យ');
                    //$('#cardheader').css('background-color','blue');
                }else if(id=='radofferreject'){
                    $('#c_title').text('តារាងលុបចោលការស្នើរប្រាក់');
                    //$('#cardheader').css('background-color','red');
                }
                showdata();
            })
             $(document).on('click','.btn-continue',function(e){
                e.preventDefault();
                $('#offercontinue').modal('show')
                $('#offerfrom').val($(this).data('usercashin'));
                $('#offerto').val($(this).data('usercashout'));
                $('#offer_continue_id').val($(this).data('offer_id'));
            })
            $(document).on('click','#btnupdatecontinue',function(e){
                e.preventDefault();
                 $('body').addClass("wait");
                var formdata = new FormData(frmoffer_continue);
                var url="{{ route('usercapital.updatemoneyoffer') }}";
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       if(data.success===true){
                            $('#offercontinue').modal('hide');
                            showdata();
                            $('body').removeClass("wait");
                            //cleartext();
                       }else{
                            $('body').removeClass("wait");
                            alert(data.message)
                       }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Save Error')

                    }

                })
            })
            $(document).on('click','.btn-ok',function(e){
                e.preventDefault();
                $('#accept_offerform_modal').modal('show')
                $('#frmoffer_accept').trigger('reset');
                $('#offer_id').val($(this).data('offer_id'));
                $('#usercashin_id').val($(this).data('usercashin_id'));
                $('#usercashin').val($(this).data('usercashin'));
                $('#userreceive').val($(this).data('usercashin'));
                $('#usercashout1').val($(this).data('usercashin'));
                $('#usercashout_id').val($(this).data('usercashout_id'));
                $('#usercashout').val($(this).data('usercashout'));
                $('#amount3').val(formatNumber($(this).data('amount3')));
                $('#selcur3').val($(this).data('selcur3'));
                $('#amount4').val(formatNumber($(this).data('amount4')));
                $('#selcur4').val($(this).data('selcur4'));
                $('#offertype').val($(this).data('offertype'));
                $('#sellistin').attr('title',$(this).data('customer_id'));
                $('#sellistin').val($(this).data('customer_id'));
                $('#sellistout1').attr('title',$(this).data('customer_id1'));
                $('#sellistout1').val($(this).data('customer_id1'));
                $('#selusercashout').val($(this).data('usercashout_id'));
                $('#selusercashin1').val($(this).data('usercashout_id'));
               if (parseFloat($('#amount4').val()) === 0) {
                    $('.rowkatkong').hide();
                }
                $('#offerdate_accept').datetimepicker({
                    timepicker:false,
                    datepicker:true,
                    value:today,
                    format:'d-m-Y',
                    autoclose:true,
                    todayBtn:true,
                    startDate:today,

                });
                $('#offerdate_accept').datetimepicker("destroy");
                // getcustomerbyuser('#sellistin','#usercashin_id','cash');
                // getcustomerbyuser('#sellistout1','#usercashin_id','cash');

                // $('#selusercashout').trigger('change');
                // $('#selusercashin1').trigger('change');
            })
            $(document).on('click','#btnoffer',function(e){
                e.preventDefault();
                $('#offerformmodal').modal('show');
                $('#frmoffer').trigger('reset');
                $('#selcurkatkong').prop('disabled', true);
                $('#selcurkatkong').attr('title','');
                $('#selcur1').attr('title','');
                $('#offerdate').datetimepicker({
                    timepicker:false,
                    datepicker:true,
                    value:today,
                    format:'d-m-Y',
                    autoclose:true,
                    todayBtn:true,
                    startDate:today,
                });
            })

             $(document).on('change','#selusercashout',function(e){
                e.preventDefault();
                getcustomerbyuser('#sellistout','#selusercashout','cash');
            })
             $(document).on('change','#selusercashin1',function(e){
                e.preventDefault();
                getcustomerbyuser('#sellistin1','#selusercashin1','cash');
            })
             function getcustomerbyuser(el,user,text){

                var user_id=$(user).val();
                var offertype=$('#offertype').val();
                var companyid=$('#selcompany').val();
                $(el).empty();
                var url="{{ route('usercapital.getcustomer_without_userconnect') }}";
                $('body').addClass("wait");
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {user_id:user_id,offertype:offertype,companyid:companyid},
                    success: function (data) {
                        //console.log(data)
                        if($.isEmptyObject(data.error)){
                            if($('#offertype').val()=='CASH'){
                                $(el).append($("<option/>",{
                                        value:'',
                                        text:text,
                                        customertype:'cash'
                                    }))
                                }
                                $.each(data,function(i,item){
                                    $(el).append($("<option/>",{
                                            value:item.id,
                                            text:item.name,
                                            customertype:item.customertype
                                        }))
                                });
                                if($('#offertype').val()!=='CASH'){
                                    $(el).append($("<option/>",{
                                        value:'',
                                        text:text,
                                        customertype:'cash'
                                    }))
                            }
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
            $('#userstartcapitalmodal').on('shown.bs.modal', function () {
                $('#amount').focus();
            })


            $(document).on('keyup','#amount1',function(e){

                if (e.keyCode === 13) {
                    $("#btnsaveuseroffer").focus();
                    return;
                }
                const C = e.key;
                if(isNumber(C) || C==="Backspace"){
                    calcuexchange();
                    return;
                }

                if(isNumber(C)==false){
                    getcurrencybykeylocalstorage(C,'#selcur1')
                }
            })
            function getcurrencybykey(key,el)
            {
                var url="{{ route('getcurrencybykey') }}";
                $.get(url,{key:key},function(data){
                    //console.log(data)
                        if(data['c']!=null){
                            $(el).val(data['c']['id']);
                            $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                        }
                    getrate();
                })
            }
            function getcurrencybyid(id,el)
            {
                var url="{{ route('getcurrencybyid') }}";
                $.get(url,{key:id},function(data){
                    //console.log(data)
                        if(data['c']!=null){
                            $(el).val(data['c']['id']);
                            $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                        }
                    getrate();
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
                    $(el).attr('title', c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
                    getrate();
                }
                })
            }
            function getcurrencybyidlocalstorage(id,el)
            {

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

                    getrate();
                }
                })
            }
            $(document).on('click','#btnsaveuseroffer',function(e){
                e.preventDefault();
                var user1=$('#useroffer_id').val();
                var user2=$('#seluser').val();
                if(user1==user2){
                    alert('you can not offer same user.')
                    return;
                }
                 $('body').addClass("wait");
                var formdata = new FormData(frmoffer);
                var offertype=$('#seltype option:selected').text();
                var offertype1=$('#seltype1 option:selected').text();

                formdata.append('offertype',offertype);
                formdata.append('offertype1',offertype1);
                var url="{{ route('usercapital.savemoneyoffer') }}";
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       if($.isEmptyObject(data.error)){
                            //location.reload();
                            //alert('user capital save')
                             printoffer(data.id);
                            $('#offerformmodal').modal('hide');
                            showdata();
                            $('body').removeClass("wait");
                            //cleartext();
                       }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                       }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Save Error')

                    }

                })
            })
            $(document).on('click','#btnsaveuserofferaccept',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var formdata = new FormData(frmoffer_accept);
                var curid3=$('#selcur3').val();
                var curid4=$('#selcur4').val();
                formdata.append('selcur3',curid3);
                formdata.append('selcur4',curid4);
                var user_cashout=$('#usercashout_id').val();
                var selusercashout=$('#selusercashout').val();
                var acceptnote='';
                if(user_cashout!=selusercashout){
                    acceptnote=' បន្តបើកពី'+ $('#selusercashout option:selected').text();
                }
                var sp = document.querySelector("#sellistout");
                var customertype1=sp.options[sp.selectedIndex].getAttribute('customertype');
                var sp1 = document.querySelector("#sellistin");
                var customertype2=sp1.options[sp1.selectedIndex].getAttribute('customertype');
                formdata.append('customertype1',customertype1);
                formdata.append('customertype2',customertype2);

                var sp3 = document.querySelector("#sellistin1");
                var customertype3=sp3.options[sp3.selectedIndex].getAttribute('customertype');
                var sp4 = document.querySelector("#sellistout1");
                var customertype4=sp4.options[sp4.selectedIndex].getAttribute('customertype');
                formdata.append('customertype3',customertype3);
                formdata.append('customertype4',customertype4);

                var receivelist=$('#sellistin option:selected').text();
                var sender=$('#selusercashout option:selected').text();
                var senderlist=$('#sellistout option:selected').text();

                var receive_back=$('#selusercashin1 option:selected').text();
                var receive_back_list=$('#sellistin1 option:selected').text();
                var sender_back_list=$('#sellistout1 option:selected').text();
                formdata.append('receivelist',receivelist);
                formdata.append('sender',sender);
                formdata.append('senderlist',senderlist);
                formdata.append('receive_back',receive_back);
                formdata.append('receive_back_list',receive_back_list);
                formdata.append('sender_back_list',sender_back_list);

                formdata.append('acceptnote',acceptnote);
                var url="{{ route('usercapital.savemoneyofferaccept') }}";
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       if(data.success===true){
                            //location.reload();
                            //alert('user capital save')
                            $('#accept_offerform_modal').modal('hide');
                            showdata();
                            $('body').removeClass("wait");
                            //cleartext();
                       }else{
                            $('body').removeClass("wait");
                            alert(data.message)
                       }


                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Save Error')

                    }

                })
            })
            function printoffer(offerid){

                var redirectWindow = window.open('{{ url('/') }}'+'/moneyoffer/print?id='+offerid , '_blank');
                redirectWindow.location;
        }
             // Remove previous highlight class
            $(document).on('click','.tbloffer td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
            })
            function showdata()
            {

                //debugger;
                 $('body').addClass("wait");
                var user=$('#seluser_record').val();
                var showdate=$('#showdate').val();
                var companyid=$('#selcompany').val();
                var rad=$('input[name="radoffer"]:checked').val();

                var url="{{ route('usercapital.showuseroffer') }}";
                // $.get(url,{user:user,searchdate:showdate,rad:rad},function(data){
                //     console.log(data)
                //     $('#tbl_useroffer').empty().html(data);
                // })
                 $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {user:user,searchdate:showdate,rad:rad,companyid:companyid},
                    success: function (data) {
                        //console.log(data)
                        if($.isEmptyObject(data.error)){
                            $('#tbl_useroffer').empty().html(data);
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

            $(document).on('click','.btn-ko',function(e){
                e.preventDefault();
                var id=$(this).data('offer_id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete User Offer Record.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'POST',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('useroffer.delete') }}",
                            data: { id:id},
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    showdata();
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
            $(document).on('click','.btn-reject',function(e){
                e.preventDefault();
                var id=$(this).data('offer_id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Reject User Offer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reject it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('useroffer.reject') }}",
                            data: { id:id},
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    showdata();
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
            $(document).on('click','.btn-restore',function(e){
                e.preventDefault();
                var id=$(this).data('offer_id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Restore User Offer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('useroffer.restore') }}",
                            data: { id:id},
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    showdata();
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
        })
        function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    </script>
@endsection
