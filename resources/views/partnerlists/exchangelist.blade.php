@extends('master')
@section('title') Exchange List @endsection
@section('css')
    <style type="text/css">
         body.wait, body.wait *{
			cursor: wait !important;
		}
        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:37px;background-color:whitesmoke;border:1px solid blue;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

        #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:37px;background-color:white}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:37px;}
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
       .cgr{
        background-color:aquamarine;
       }
       /* td{
        border-style:none;
       } */
    #tbl1 .clickedrow td{
        background-color: #9eca8f;
    }
    #tbl2 .clickedrow td{
        background-color: #9eca8f;
    }
    #tblsearchmore td{
        border-style:none;
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
        <div class="table-responsive">
            <table class="table">
                <tr class="kh16">
                    <th style="border-style:none;">ថ្ងៃកាត់កង</th>
                    <th style="border-style:none;">ប្រភេទអតិថិជន</th>
                    <th style="border-style:none;"><span id="lblpartner">ជ្រើសរើសដៃគូ</span></th>
                    <th style="border-style:none;"></th>

                    <th style="border-style:none;">អត្រាគោល</th>
                    <th style="border-style:none;">អត្រាព្រមព្រាង</th>

                </tr>
                <tr>

                    <td style="padding:0px;border-style:none;width:160px;">
                        <div class="input-group" style="width:160px;">
                            <input type="text" name="exchangedate" id="exchangedate" class="form-control" style="width:100px;background-color:silver;font-size:16px;font-weight:bold;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                    </td>
                    <td style="padding:0px;border-style:none;width:200px;">
                        <select name="seltype" id="seltype" class="form-select kh16-b">
                            <option value="all">ទាំងអស់</option>
                            <option value="BANK">BANK</option>
                            @if(Auth::user()->role->name=='Admin')
                            <option value="CUSTOMER">CUSTOMER</option>
                            @endif
                            <option value="PARTNER">PARTNER</option>
                            <option value="PARTNER">AGENT</option>
                        </select>
                    </td>
                    <td style="padding:0px;border-style:none;width:310px;">
                        <select name="selcustomer" id="selcustomer" style="width:300px;margin-top:-60px;" class="form-select kh16-b" required>
                            <option value=""></option>
                            @foreach ($partners as $p)
                                <option value="{{ $p->id }}" {{ $p->id==$partnerid?'selected':'' }} customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                            @endforeach
                            {{-- <optgroup label="ដៃគូ">
                              @foreach ($partners->where('customertype','PARTNER') as $p)
                                <option value="{{ $p->id }}" {{ $p->id==$partnerid?'selected':'' }} customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                              @endforeach
                            </optgroup>
                            <optgroup label="ធនាគា">
                              @foreach ($partners->where('customertype','BANK') as $p)
                                <option value="{{ $p->id }}" {{ $p->id==$partnerid?'selected':'' }} customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                              @endforeach
                            </optgroup>
                            <optgroup label="ភ្នាក់ងារ">
                              @foreach ($partners->where('customertype','AGENT') as $p)
                                <option value="{{ $p->id }}" {{ $p->id==$partnerid?'selected':'' }} customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                              @endforeach
                            </optgroup>
                            @if (Auth::user()->role->name=='Admin')
                              <optgroup label="អតិថិជន">
                                @foreach ($customers as $p)
                                  <option value="{{ $p->id }}" {{ $p->id==$partnerid?'selected':'' }} customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                @endforeach
                              </optgroup>
                            @endif --}}
                        </select>
                    </td>
                    <td style="padding:0px;border-style:none;">
                        <button class="btn btn-primary btn-md kh16-b" id="btnsearch">សរុបបញ្ជី</button>
                        <a href="{{ route('exchangelist.delkatkong') }}" class="btn btn-info kh16-b" target="_blank">លុបកាត់កង</a>
                    </td>
                    <td style="padding:0px;border-style:none;width:120px;">
                        <input type="text" class="form-control kh16-b" id="txtrate1" style="width:120px;" readonly>
                        <input type="hidden" id="txtsign" value="+">
                    </td>
                    <td style="padding:0px;border-style:none;width:120px;">
                        <input type="text" class="form-control kh16-b" id="txtrate" style="width:120px;">
                    </td>
                </tr>
                <tr>
                    <td style="border-style:none;padding-top:10px;width:100px;">
                        <div class="form-check" style="margin-left:0px;">
                            <input type="radio" class="form-check-input kh16-b" id="radio1" name="optkatkong" value="-1" checked>
                            <label class="form-check-label kh16-b" for="radio1" style="color:red;">លក់ចេញ</label>
                       </div>
                    </td>
                    <td style="border-style:none;padding-top:10px;width:100px;">
                        <div class="form-check">
                            <input type="radio" class="form-check-input kh16-b" id="radio2" name="optkatkong" value="1">
                            <label class="form-check-label kh16-b" for="radio2" style="color:blue">ទិញចូល</label>
                          </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div id="total_list" class="row" style="margin-top:-10px;">


    </div>

    <div class="row">
        <div class="col-lg-6">
            <table class="table table-bordered table-hover" style="background-color:azure">
                <tr style="background-color:rgb(164, 232, 240)">
                    <td class="kh22-b" style="text-align:center;" colspan=3>{{ 'លុយ '.$logo->name }}</td>
                </tr>

                <tr>
                    <td colspan=2 style="padding:0px;">
                        <input type="button" style="text-align:right;width:100%" class="btn kh22-b" id="txtwecash" value="0">
                    </td>
                    <td style="padding:0px;width:100px;">
                        <input style="width:100px;" type="button" class="btn kh22-b" id="txtwecur" value="">
                    </td>
                </tr>
                <tr>
                    <td style="width:120px;padding:0px;">
                        <input type="text" style="text-align:center;width:120px;background-color:azure" class="form-control kh22-b" id="txtsignwe" name="txtsignwe" value="លក់ចេញ" readonly>
                    </td>
                    <td style="padding:0px;">
                        <input type="text" style="text-align:right;width:100%;background-color:azure" class="form-control kh22-b" id="txtsale" name="txtsale" value="" placeholder="កាត់ចំនួន" autocomplete="off" readonly>
                    </td>
                    <td style="padding:0px;width:100px;">
                        <input style="width:100px;" type="button" class="btn kh22-b" id="lblsale" value="" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 style="padding:0px;">
                        <input type="button" style="text-align:right;width:100%" class="btn kh22-b" id="txtwebal" value="">
                    </td>
                    <td style="padding:0px;width:100px;">
                        <input style="width:100px;" type="button" class="btn kh22-b" id="txtwecur1" value="">
                    </td>
                </tr>

            </table>
        </div>
        <div class="col-lg-6">
            <table class="table table-bordered table-hover" style="background-color:azure">
                <tr style="background-color:rgb(164, 232, 240)">
                    <td class="kh22-b" style="text-align:center;" colspan=3><span id="r_right1">{{ 'លុយគេ' }}</span></td>
                </tr>

                <tr>
                    <td colspan=2 style="padding:0px;">
                        <input type="button" style="text-align:right;width:100%" class="btn kh22-b" id="txttheircash" value="0">
                    </td>
                    <td style="padding:0px;width:100px;">
                        <input style="width:100px;" type="button" class="btn kh22-b" id="txttheircur" value="">
                    </td>
                </tr>
                <tr>
                    <td style="width:120px;padding:0px;">
                        <input type="text" style="text-align:center;width:120px;background-color:azure" class="form-control kh22-b" id="txtsignthey" name="txtsignthey" value="ទិញចូល" readonly>
                    </td>
                    <td style="padding:0px;">
                        <input type="text" style="text-align:right;width:100%;background-color:azure" class="form-control kh22-b" id="txtbuy" name="txtbuy" value="" placeholder="កាត់ចំនួន" autocomplete="off" readonly>
                    </td>
                    <td style="padding:0px;width:100px;">
                        <input style="width:100px;" type="button" class="btn kh22-b" id="lblbuy" value="" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 style="padding:0px;">
                        <input type="button" style="text-align:right;width:100%" class="btn kh22-b" id="txttheirbal" value="">
                    </td>
                    <td style="padding:0px;width:100px;">
                        <input style="width:100px;" type="button" class="btn kh22-b" id="txttheircur1" value="">
                    </td>
                </tr>

            </table>
        </div>
    </div>

   <div class="row" style="margin-bottom:60px;">
        <button id="btnsavelist" class="btn btn-info kh22">រក្សាទុកកាត់កង</button>
   </div>
@endsection
@section('script')

    <script type="text/javascript">
    $('#h1_title').text('កាត់កងបញ្ជី');
    $(document).ready(function () {
        $('#selcustomer').select2();
        $('#seluser').select2();
        $(document).on('change','#selcustomer',function(e){
            e.preventDefault();
            var sp = document.querySelector("#selcustomer");
            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            $('#lblpartner').text(customertype);
        })
        $(document).on('click','#tbl1 td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl2 td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
        var today=new Date();
            $('#exchangedate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
        var cleave = new Cleave('#txtbuy', {
            numeral: true,
            numeralDecimalScale: 6,
            numeralPositiveOnly: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#txtsale', {
            numeral: true,
            numeralDecimalScale: 6,
            numeralPositiveOnly: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#txtrate', {
            numeral: true,
            numeralDecimalScale: 6,
            numeralThousandsGroupStyle: 'thousand'
        });
        $(document).on('change','#radio1',function(e){
            e.preventDefault()
            $('#txtsignwe').val('លក់ចេញ');
            $('#txtsignthey').val('ទិញចូល');
            $('#txtsign').val('+');
       })
       $(document).on('change','#radio2',function(e){
            e.preventDefault()
            $('#txtsignwe').val('ទិញចូល');
            $('#txtsignthey').val('លក់ចេញ');
            $('#txtsign').val('-');
       })
       $(document).on('click','.theirbutton',function(e){
            e.preventDefault();
            var row=$(this).closest('tr');
            amt=row.find("td input:eq(0)").val();
            cur=row.find("td input:eq(1)").val();
            curid=row.find("td input:eq(1)").attr('title');
            $('#txttheircash').val(amt);
            $('#txttheircur').val(cur);
            $('#txttheircur1').val(cur);
            $('#txtbuy').attr('title',curid);
            //getcurrencybyshortcut(cur,'#lblbuy');
            getcurrencybyidlocalstorage(curid,'#lblbuy');
            $('#txtbuy').attr('readonly',false);
       })

       $(document).on('click','.webutton',function(e){
            e.preventDefault();
            var row=$(this).closest('tr');
            amt=row.find("td input:eq(0)").val();
            cur=row.find("td input:eq(1)").val();
            curid=row.find("td input:eq(1)").attr('title');
            $('#txtwecash').val(amt);
            $('#txtwecur').val(cur);
            $('#txtwecur1').val(cur);
            $('#txtsale').attr('title',curid);
            //getcurrencybyshortcut(cur,'#lblsale');
            getcurrencybyidlocalstorage(curid,'#lblsale');
            $('#txtsale').attr('readonly',false);
       })

        $(document).on('click','#btnsearch',function(e){
            e.preventDefault()
            doexchangelist();
        })
        function doexchangelist(){
            TotalList();
            var partner=$('#selcustomer option:selected').text();
            $('#r_right').text('នៅខ្វះ '+ partner);
            $('#r_right1').text('លុយ '+ partner);
        }
        $(document).on('change','#selcustomer',function(e){
            e.preventDefault();
            doexchangelist();
        })
        $(document).on('change','#seltype',function(e){
            e.preventDefault();
            var type=$(this).val();

            getpartner(type,'#selcustomer');
        })
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
                                text:item.name
                            }))
                        //console.log(item)
                    });

                })
            }

        function TotalList()
        {
            var exchangedate=$('#exchangedate').val();
            var partner=$('#selcustomer').val();
            var partnername=$('#selcustomer option:selected').text();

            $('body').addClass("wait");
            var url="{{ route('partnerlist.gettotallist') }}";

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {exchangedate:exchangedate,partner:partner,partnername:partnername,iscloselist:0},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#total_list').empty().html(data);
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

        $(document).on('keyup', '#txtbuy', function (e) {
            calcuexchange();
            calcubalance();
        })
        $(document).on('keyup', '#txtsale', function (e) {
            calcuexchange1();
            calcubalance();
        })
        $(document).on('keyup', '#txtrate', function (e) {
            //debugger
            //alert(e.key)
            if(isNumber(e.key)){
                calcuexchange();
                calcubalance();
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
        function clientvalidate(){
            if($('#txtrate').val()==''){
                alert('please select exchange currency')
                return false;
            }
            if($('#txtbuy').val()=='' || $('#txtsale').val()=='' ){
                alert('please input exchange amount')
                return false;
            }
            return true;
        }
        // $(document).on('click','#btnsavelist',function(e){
        //     e.preventDefault();
        //    if(clientvalidate()==false){
        //     return;
        //    }
        //     var q = confirm("Do you want to save exchange list?");
        //     if(!q){
        //         return;
        //     }
        //     var formdata=new FormData();
        //     var m1 = $('#lblbuy').attr('title').split(";");
        //     var m2 = $('#lblsale').attr('title').split(";");
        //     var pid = 0;
        //     var mcur = '';
        //     var pcur = '';
        //     var luy = 0;
        //     var product = 0;
        //     var mekun = 1;
        //     var item1 = 0;
        //     var item2 = 0;
        //     var rate1b = 0;
        //     var rate1s = 0;
        //     var rate2b = 0;
        //     var rate2s = 0;
        //     var curid1 = 0;
        //     var curid2 = 0;
        //     var pcur1 = '';
        //     var pcur2 = '';
        //     var buy='0';
        //     var sale='0';
        //     var curbuy='';
        //     var cursale='';
        //     var curbuy_id='';
        //     var cursale_id='';

        //     var receipt2='0';

        //     if ($('#txtsign').val() == '+') {
        //         mekun = 1;
        //         buy=$('#txtbuy').val();
        //         sale=$('#txtsale').val();
        //         curbuy=$('#lblbuy').val();
        //         cursale=$('#lblsale').val();
        //         curbuy_id=$('#txtbuy').attr('title');
        //         cursale_id=$('#txtsale').attr('title');

        //     } else {
        //         mekun = -1;
        //         buy=$('#txtsale').val();
        //         sale=$('#txtbuy').val();
        //         curbuy=$('#lblsale').val();
        //         cursale=$('#lblbuy').val();
        //         curbuy_id=$('#txtsale').attr('title');
        //         cursale_id=$('#txtbuy').attr('title');
        //     }
        //     if (m1[4] == '1') {
        //         mcur = m1[6];
        //         pid = m2[0];
        //         pcur = m2[6];
        //         luy = mekun * $('#txtbuy').val().replace(/,/g, '');
        //         product = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
        //     } else if (m2[4] == '1') {
        //         mcur = m2[6];
        //         pid = m1[0];
        //         pcur = m1[6];
        //         product = mekun * $('#txtbuy').val().replace(/,/g, '');
        //         luy = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
        //     } else {
        //         receipt2='1';
        //         item1 = $('#txtbuy').val();
        //         item2 = $('#txtsale').val();
        //         rate1b = m1[1];
        //         rate1s = m1[2];
        //         rate2b = m2[1];
        //         rate2s = m2[2];
        //         curid1 = m1[0];
        //         curid2 = m2[0];
        //         pcur1 = m1[6];
        //         pcur2 = m2[6];
        //         //url = "{{ route('saveexchangeproduct') }}"
        //     }
        //         formdata.append('partner_id',$('#selcustomer').val());
        //         formdata.append("product_id", pid);
        //         formdata.append("product_cur", pcur);
        //         formdata.append("exchange_amount", luy);
        //         formdata.append("maincur", mcur);
        //         formdata.append("product", product);
        //         formdata.append("agree_rate", $('#txtrate').val());
        //         formdata.append("main_rate", $('#txtrate1').val());
        //         formdata.append('exchangedate',$('#exchangedate').val());
        //         formdata.append("exsign", $('#txtsign').val());
        //         formdata.append("item1", item1);
        //         formdata.append("item2", item2);
        //         formdata.append("rate1buy", rate1b);
        //         formdata.append("rate1sale", rate1s);
        //         formdata.append("rate2buy", rate2b);
        //         formdata.append("rate2sale", rate2s);
        //         formdata.append("curid1", curid1);
        //         formdata.append("curid2", curid2);
        //         formdata.append("pcur1", pcur1);
        //         formdata.append("pcur2", pcur2);
        //         formdata.append("buy",buy);
        //         formdata.append("sale", sale);
        //         formdata.append("curbuy", curbuy);
        //         formdata.append("cursale", cursale);
        //         formdata.append("curbuy_id", curbuy_id);
        //         formdata.append("cursale_id", cursale_id);
        //         formdata.append("isexchange_normal","1");
        //     //frmdata.push({name:'dd',value:$('#invdate').val()});
        //     var url="{{ route('partnerlist.store') }}"

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
        //                 TotalList();
        //                 resetkatkong();
        //                 //location.reload();
        //             }else{
        //                 alert(data.error)
        //             }
        //         },
        //         error: function () {
        //             alert('Save Error')
        //         }

        //     })

        // })
        $(document).on('click', '#btnsavelist', function (e) {
            e.preventDefault();
            if (clientvalidate() == false) {
                return;
            }
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to save the exchange list?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, save it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formdata = new FormData();
                    var m1 = $('#lblbuy').attr('title').split(";");
                    var m2 = $('#lblsale').attr('title').split(";");
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
                    var buy = '0';
                    var sale = '0';
                    var curbuy = '';
                    var cursale = '';
                    var curbuy_id = '';
                    var cursale_id = '';
                    var receipt2 = '0';

                    if ($('#txtsign').val() == '+') {
                        mekun = 1;
                        buy = $('#txtbuy').val();
                        sale = $('#txtsale').val();
                        curbuy = $('#lblbuy').val();
                        cursale = $('#lblsale').val();
                        curbuy_id = $('#txtbuy').attr('title');
                        cursale_id = $('#txtsale').attr('title');
                    } else {
                        mekun = -1;
                        buy = $('#txtsale').val();
                        sale = $('#txtbuy').val();
                        curbuy = $('#lblsale').val();
                        cursale = $('#lblbuy').val();
                        curbuy_id = $('#txtsale').attr('title');
                        cursale_id = $('#txtbuy').attr('title');
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
                        receipt2 = '1';
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
                    }

                    formdata.append('partner_id', $('#selcustomer').val());
                    formdata.append("product_id", pid);
                    formdata.append("product_cur", pcur);
                    formdata.append("exchange_amount", luy);
                    formdata.append("maincur", mcur);
                    formdata.append("product", product);
                    formdata.append("agree_rate", $('#txtrate').val());
                    formdata.append("main_rate", $('#txtrate1').val());
                    formdata.append('exchangedate', $('#exchangedate').val());
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
                    formdata.append("buy", buy);
                    formdata.append("sale", sale);
                    formdata.append("curbuy", curbuy);
                    formdata.append("cursale", cursale);
                    formdata.append("curbuy_id", curbuy_id);
                    formdata.append("cursale_id", cursale_id);
                    formdata.append("isexchange_normal", "1");

                    var url = "{{ route('partnerlist.store') }}";

                    $.ajax({
                        async: true,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        url: url,
                        data: formdata,
                        success: function (data) {
                            console.log(data)
                            if ($.isEmptyObject(data.error)) {
                                TotalList();
                                resetkatkong();
                                Swal.fire('Saved!', 'The exchange list has been saved.', 'success');
                            } else {
                                Swal.fire('Error', data.error, 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error', 'Save Error', 'error');
                        }
                    });
                }
            });
        });

    })

    function resetkatkong(){
        $('#txtwecash').val('');
        $('#txttheircash').val('');
        $('#txtbuy').val('');
        $('#txtsale').val('');
        $('#txtwebal').val('');
        $('#txttheirbal').val('');
        $('#txtrate').val('');
        $('#txtrate1').val('');
        $('#txtwecur').val('');
        $('#txtwecur1').val('');
        $('#txttheircur').val('');
        $('#txttheircur1').val('');
        $('#lblbuy').val('');
        $('#lblsale').val('');
        $('#txtsale').attr('readonly',true);
        $('#txtbuy').attr('readonly',true);



    }

    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    function getcurrencybyidlocalstorage(id,el)
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
        $(el).val(c.shortcut);
        $(el).attr('title', c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
        getratefast();
      }
    })
  }
  function getratefast() {
        try{
            //debugger;
            $('#txtrate').attr('title', '');
            var m = $('#lblbuy').attr('title').split(";");
            var p = $('#lblsale').attr('title').split(";");
            if(m=='' || p==''){
                //alert('can not save')
                return;
            }
            //check if the save curname

            if (m[6] == p[6]) {
                $('#txtrate').val(1);
                calcuexchange();
                return;
            }
            //check if product exchange product
            if (m[4] == '0') {
                if (p[4] == '0') {
                    runproductratefast();
                    return;
                }
            }
            if ($('#txtsign').val() == '+') {
                if (m[4] == '1') {//if maincur=true
                    $('#txtrate').val(parseFloat(p[2]));//get rate p sale

                } else {
                    $('#txtrate').val(parseFloat(m[1]));//get rate m buy
                }

            } else {
                if (m[4] == '1') {
                    $('#txtrate').val(parseFloat(p[1]));
                } else {
                    $('#txtrate').val(parseFloat(m[2]));
                }

            }
            $('#txtrate1').val($('#txtrate').val());
            $('#lblrate').attr('title',$('#txtrate').val());
            //calcuexchange();

        }catch{

        }

      }
      function runproductratefast()
    {
        var buycur = $('#lblbuy').val();
        var salecur = $('#lblsale').val();
        var curname = '';
        if ($('#txtsign').val() == '+') {
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
        $('#txtrate').val('');
        $('#txtrate1').val('');
        $('#txtrate').attr('title','');
        currencylist.forEach(function(c){
        //debugger;
        if(c.pshortcut==curname){
            $('#txtrate1').val(parseFloat(c.rate));
            $('#txtrate').val(parseFloat(c.rate));
            $('#txtrate').attr('title', c.pshortcut + ';' +  c.rate + ';' +  c.operator);
            calcuexchangeproduct();
        }
        })
        $('#lblrate').attr('title',$('#txtrate').val());

    }
    function getcurrencybyshortcut(key,el)
    {
        var url="{{ route('getcurrencybyshortcut') }}";
        $.get(url,{key:key},function(data){
             //console.log(data)
                if(data['c']!=null){
                    $(el).val(data['c']['shortcut']);
                    $(el).attr('title', data['c']['id'] + ';' + parseFloat(data['c']['ratebuy']) + ';' + parseFloat(data['c']['ratesale']) + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                    getrate();
                }
        })
    }
    function runproductrate() {
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
                    $('#txtrate1').val(formatNumber(parseFloat(data['pr']['rate'])));
                    $('#txtrate').val(formatNumber(parseFloat(data['pr']['rate'])));
                    $('#txtrate').attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                    calcuexchangeproduct();
                }else{
                    $('#txtrate').val('');
                    $('#txtrate').attr('title','');
                }
                console.log(data)

            })

            $('#lblrate').attr('title',$('#txtrate').val());

        }
    function getrate() {

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
                $('#txtrate1').val(1);
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
            $('#txtrate1').val($('#txtrate').val());
            $('#lblrate').attr('title',$('#txtrate').val());
            //calcuexchange();

        }
        function calcuexchangeproduct() {
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
        function calcuexchangeproduct1() {
            //debugger;
            var luy = $('#txtsale').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var rs = $('#txtrate').attr('title').split(";");
            if ($('#txtsign').val() == '+') {
                if (rs[2] == '*') {
                    $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $('#txtbuy').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }
            } else {
                if (rs[2] == '*') {
                    $('#txtbuy').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            }
        }
        function calcuexchange() {
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
                    calcuexchangeproduct();
                }
            }
        }
        function calcuexchange1() {
             //debugger
            var luy = $('#txtsale').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var m1 = $('#lblbuy').attr('title').split(";");
            var m2 = $('#lblsale').attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/

                    $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $('#txtbuy').val(formatNumber(parseFloat(luy * r).toFixed(2)));

                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $('#txtbuy').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                    } else {
                        $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    }
                } else {
                    calcuexchangeproduct1();
                }
            }
        }
        function calcubalance()
        {
            var sign=$('#txtsign').val();
            var wedebt=$('#txtwecash').val().replace(/,/g, '');
            var sale=$('#txtsale').val().replace(/,/g, '');
            if(sign=='+'){
                var webal=formatNumber((parseFloat(wedebt) + parseFloat(sale)).toFixed(2));
            }else{
                var webal=formatNumber((parseFloat(wedebt) - parseFloat(sale)).toFixed(2));
            }
            $('#txtwebal').val(webal);


            var theirdebt=$('#txttheircash').val().replace(/,/g, '');
            var buy=$('#txtbuy').val().replace(/,/g, '');
            if(sign=='+'){
                var theirbal=formatNumber((parseFloat(theirdebt) - parseFloat(buy)).toFixed(2));
            }else{
                var theirbal=formatNumber((parseFloat(theirdebt) + parseFloat(buy)).toFixed(2));
            }
            $('#txttheirbal').val(theirbal);


        }
    </script>
@endsection
