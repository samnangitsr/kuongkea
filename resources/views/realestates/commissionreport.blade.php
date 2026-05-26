@extends('master')
@section('title') របាយការណ៏កំរៃជើងសារ @endsection
@section('css')
<link rel="stylesheet" tyle="text/css" href="{{ config('helper.asset_path') }}/css/virtual-select.min.css">
    <style type="text/css">
        body.wait, body.wait *{
			cursor: wait !important;
		}


    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selsaler + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selsaler-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #sel_property + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-sel_property-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selbank + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selbank-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 30px !important;
        }
        .select2-container .select2-selection--single {
            height: 30px !important;
            background-color:white;
        }
        .select2-selection__arrow {
            height: 30px !important;
        }
        .en12{
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            }
        .en12-b{
            font-family:Arial, Helvetica, sans-serif;
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
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            font-weight:bold;

            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .en16{
            font-family: Arial, Helvetica, sans-serif;
            font-size:16px;
        }
        .en16-b{
            font-family: Arial, Helvetica, sans-serif;
            font-size:16px;
            font-weight:bold;
        }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        .modalleft{
            margin-left:0;
            margin-top:0;
        }
        .modalright{
            margin-top:0;
            margin-right:0;
        }
        ul.ui-autocomplete {
            z-index: 1100;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
        }
        #tbl_partner input[type='text']:focus {
            background-color: yellow;
        }
        #tbl_partner td{
            padding:2px;
            border-style:none;
       }

       input.blue{
        color:blue;
       }
       input.red{
        color:red;
       }

       th{
        word-wrap: break-word;
       }
       hr.new2 {
        border-top: 1px dashed brown;
        margin:5px;
        }

        /* Dotted red border */
        hr.new3 {
        border-top: 1px dotted brown;
        margin:5px;
        }
       #divfooter{
        /* margin:0px; */
        color:white;
        padding:0px 20px 0px 0px;
        position: fixed;
        bottom: 0;
        width: 84.5%;
        min-height: 98px;
        max-height: 98px;
        /* background-color: inherit; */
        background-color:rgb(201, 214, 218);
        color: white;
        height : 98px;
        overflow:auto;
        clear: both;
        }
        .tableFixHead{ overflow: auto;border:1px solid blue;}
        .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }


        .tableFixHead1{ overflow: auto;background-color:rgb(237, 240, 48);}
        .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tbl_checkamt td{
          word-wrap: break-word;
          padding:2px 5px 2px 5px;
        }
        .tbl_transferlist td{
          word-wrap: break-word !important;
          padding:2px 5px 2px 5px;
        }
        .tbl_transferlist .clickedrow td,
        .tbl_transferlist .clickedrow input,
        .tbl_transferlist .clickedrow td > a
        {
            background-color: blue;
            color:white !important;
        }

        .tbl_transferlist th{
            padding:2px;
            background-color:silver;
        }
        .button1:hover {
                background-color: #8fe9c8;
                color: rgb(19, 57, 230);

            }
        .button1{
            border:none;
            background-color:inherit;
            padding:2px 5px;
            border:1px solid gray;
        }
        #tbl_partner input[type='text']:focus {
            background-color: yellow;
            }
        #tablemultiexchange th{
            padding:3px;
        }

        #tablemultiexchange td{
            padding:3px;
        }
        .mybtn{
            border:1px solid black;
        }
        .mybtn:hover{
            background-color:#8fe9c8;
        }
        #tbl_sale_detail td{
            border:1px solid blue;
            padding:4px 5px;
        }
        #tbl_sale_detail th{
            border:1px solid blue;
            padding:4px;
            background-color:aquamarine;
        }
        .btnremoveitem:hover{
            background-color:yellow;
        }
        .btnremoveitem{

            padding:5px 10px;
            border:1px solid black;
        }
        ul.ui-autocomplete {
            z-index: 1100;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
        }
        .mybtn{
            border:1px solid black;
            padding:2px 5px;
        }
        .mybtn:hover{
            background-color:#8fe9c8;
        }
        .c_orange{
            background-color:orange;
        }
        .c_yellow{
            background-color:yellow;
        }
        .c_red{
            background-color:red;
            color:white;
        }
        #mytable td{
            border:1px solid black;
        }
        #tbl_total th{
            border:1px solid black;
            padding:3px;
        }
        #tbl_total td{
            border:1px solid black;
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

    <table style="margin-top:-20px;">
        <tr>
            <td style="">
                <select class="kh16-b form-select" name="selpartner" id="selpartner" style="">
                    <option value="">all saler</option>
                    @foreach ($partners->where('customertype','SALER') as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </td>
            <td class="kh16-b" style="padding-left:5px;">ប្លុក</td>
            <td class="kh16-b" style="width:200px;">
                <select multiple class="select" name="selblock" id="selblock" style="width:200px;">
                    @foreach ($groups as $b)
                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                    @endforeach
                </select>
                {{-- <select class="form-select kh16-b" name="selblock" id="selblock">
                    <option value="">all block</option>
                    @foreach ($groups as $b)
                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                    @endforeach
                </select> --}}
            </td>
            <td style="">
                <select class="form-select kh16-b" name="search_property" id="search_property">
                    <option value="">all property</option>
                    @foreach ($allproperty as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </td>
            <td style="">
                <button id="btnsearch" class="mybtn kh16-b">Search</button>
            </td>
            <td style="">
                <button id="btnprint" class="mybtn kh16-b">Print</button>
            </td>
            <td style="">
                <button id="btnupdategroup" class="mybtn kh16-b">UpdateGroup</button>
            </td>
            <td style="text-align:right;">
                <input type="text" class="kh16" id="tableSearch" style="width:200px;"  placeholder="Search from table below..." title="Type what you khnow">
            </td>
        </tr>
    </table>




   <div id="rowdisplay">
        <div class="row" style="margin-top:0px;">
            <div class="tableFixHead" style="padding:0px;">
               <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                   <thead style="text-align:center;" class="kh16">
                       <th style="width:60px;">No</th>
                       <th style="width:100px;">វិក័យប័ត្រ</th>
                       <th style="width:100px;">ថ្ងៃលក់</th>
                       <th style="width:200px;">ឈ្មោះអចលនទ្រព្យ</th>
                       <th id="th_customer" style="width:200px;">អ្នកលក់គំរោង</th>
                       <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                       <th style="width:150px;">បានទូទាត់រួច</th>
                       <th style="width:150px;">នៅខ្វះ</th>
                   </thead>
                   <tbody id="body_transaction">

                   </tbody>

               </table>
            </div>
        </div>
        <div class="row" style="">
            <table id="tbl_total" class="table table-bordered kh16-b" style='margin:0px;'>
                <tr style="text-align:center;">
                    <th>សរុបកម្រៃជើងសារ</th>
                    <th>ទូទាត់រួច</th>
                    <th>នៅខ្វះ</th>

                </tr>
                <tr>
                    <td style="text-align:center;">0</td>
                    <td style="text-align:center;">0</td>
                    <td style="text-align:center;">0</td>

                </tr>
            </table>
        </div>
   </div>

    @include('realestates.paymentmodal');
@endsection
@section('script')
<script src="{{ config('helper.asset_path') }}/js/virtual-select.min.js"></script>
    <script type="text/javascript">
        $('#h1_title').text('របាយការណ៏កម្រៃជើងសារ');
        function refreshtableFixHead(h)
        {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-h;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
        }
        refreshtableFixHead(210);
        $(window).resize(function() {
            refreshtableFixHead(210);
        });
        $(document).ready(function () {
            var today=new Date();
            $('#invdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            VirtualSelect.init({
                ele: '#selblock' ,
            });
            $('#search_property').select2();
            $('#selpartner').select2();
            //$('#selblock').select2();
            var cleave = new Cleave('#deposit', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
            $('#selbank').select2();
            $(document).on('change','#deposit',function(e){
                e.preventDefault();
                var bal=$('#balance').val().replace(/,/g, '');
                var dep=$('#deposit').val().replace(/,/g, '');
                var bal1=parseFloat(bal)-parseFloat(dep);
                $('#balance1').val(formatNumber(bal1));
            })
            $(document).on('click','#btnupdategroup',function(e){
                e.preventDefault();
                //var url="{{ route('realestate.updatesalegroup') }}";
                // $.ajax({
                //     async:true,
                //     type: 'GET',
                //     url: url,
                //     data: {},

                //     complete: function () {},
                //     success: function (data) {
                //         //console.log(data)
                //         alert('all sale group have been updated')
                //         $('body').removeClass("wait");
                //     },
                //     error: function () {
                //         $('body').removeClass("wait");
                //         alert('Read Data Error.')
                //     }
                // })
                Swal.fire({

                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Update Sale Group!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('body').addClass("wait");
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('realestate.updatesalegroup') }}",
                            data: {},
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    $('body').removeClass("wait");
                                    Swal.fire(
                                        'Update!',
                                        data.message,
                                        'success'
                                    )
                                } else {
                                    $('body').removeClass("wait");
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function () {
                                $('body').removeClass("wait");
                                Swal.fire(
                                    'Error!',
                                    'Update Error.',
                                    'Error'
                                )
                            }

                        })

                    }
                })
            })
        $(document).on('click','#btnsearch',function(e){
            e.preventDefault();
            getsearch();
        })
        $(document).on('click','#btnprint',function(e){
            e.preventDefault();
            printcommissionpaid();

        })
        function printcommissionpaid(){
            var customer=$('#selpartner').val();
            var customername=$('#selpartner option:selected').text();
            var property_id=$('#search_property').val();
            var selgroup=$('#selblock').val();
            var blockname=$('#selblock option:selected').text();
            //const selblock = document.querySelector('#selblock');
            //const selectedOptions = selblock.virtualSelect.getSelectedOptions();
// To get just the labels (text)
            //const labels = selectedOptions.map(opt => opt.label);
//console.log(labels); // ["Group A", "Group B"]

            // if(selgroup.includes('all')==true || selgroup=='' || selgroup.length==0){
            //     selgroup="all";
            // }
            var redirectWindow = window.open('{{ url('/') }}'+'/realestate/showcommissionpaid?isprint='+1+'&selgroup='+selgroup+'&blockname='+blockname+'&property_id='+property_id+'&customer='+customer+'&customername='+customername , '_blank');
            redirectWindow.location;
        }
        function getsearch()
        {
            $('body').addClass("wait");
            var property_id=$('#search_property').val();
            var selgroup=$('#selblock').val();
            var blockname=$('#selblock option:selected').text();
            var customer=$('#selpartner').val();

            // if(selgroup.includes('all')==true || selgroup=='' || selgroup.length==0){
            //     selgroup="all";
            // }
            var url="{{ route('realestate.showcommissionpaid') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {customer:customer,selgroup:selgroup,property_id:property_id,blockname:blockname},

                complete: function () {},
                success: function (data) {
                    console.log(data)
                    $('#rowdisplay').empty().html(data);
                    refreshtableFixHead(210);
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
        $(document).on('click','#btnsavedeposit,#btnsavedepositprint',function(e){
            e.preventDefault();
            var table = document.getElementById("tbl_sale_detail");
            var tbodyRowCount = table.tBodies[0].rows.length;
            if(tbodyRowCount==0){
                alert('save not allow')
                return;
            }
            var elid=$(this).attr('id');
            if(elid=='btnsavedeposit'){
                savedeposit(0,$(this),$(this).text());
            }else{
                savedeposit(1,$(this),$(this).text());
            }

        })
        function savedeposit(isprint,el,btntext)
        {
            $('body').addClass("wait");
            $(el).attr('disabled', true).text("Processing");
            var formdata=new FormData(frmdeposit);
            var curid=$('#txtcur').attr('title');
            var payby=$('#selbank option:selected').text();
            var partner_id=$('#txtname').attr('title');
            formdata.append('payby',payby);
            formdata.append('curid',curid);
            formdata.append('partner_id',partner_id);
            var url="{{ route('realestate.savedeposit') }}";
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

                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        if(isprint==1){
                            printdeposit(data.id,data.groupid,'បង្កាន់ដៃកក់ប្រាក់',$('#amount').attr('title'));
                        }
                        toastr.success("Save Sale Successfully");
                        location.reload();
                        // $(el).removeAttr('disabled').html(btntext);
                        //     $('#frmdeposit').trigger('reset');
                        //     $('#body_sale_detail').empty();
                        //     $('#selbank').trigger('change');
                        //     $('#paymentmodal').modal('hide');
                        $('body').removeClass("wait");

                    }else{
                        $(el).removeAttr('disabled').html(btntext);
                        $('body').removeClass("wait");
                        alert(data.error)

                    }
                },
                error: function () {
                    $(el).removeAttr('disabled').html(btntext);
                    $('body').removeClass("wait");
                    alert('Save Error.')

                }

            })

        }

        function printdeposit(id,groupid,rpttitle,propertyname){
            var redirectWindow = window.open('{{ url('/') }}'+'/realestate/depositprint?id='+id+'&groupid='+groupid+'&rpttitle='+rpttitle+'&propertyname='+propertyname , '_blank');
            redirectWindow.location;
        }


            $(document).on('click','.tbl_transferlist td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.btnpayment',function(e){
                e.preventDefault();
                $('#paymentmodal').modal('show');
                var id=$(this).data('id');
                var url="{{ route('realestate.payment') }}";
                $.get(url,{id:id},function(data){

                    if(data.success){
                        $('#m_title').text('បង់ប្រាក់');
                        $('#id1').val(data['transfers']['id']);
                        $('#id2').val(data['transfers']['map_id']);
                        $('#trancode').val(data['transfers']['trancode']);
                        $('#invdate').val(moment(new Date()).format("DD-MM-YYYY"));
                        if(data['transfers']['trancode']==-8){
                            $('#labelname').text("អតិថិជន");
                        }else{
                            $('#labelname').text("អ្នកលក់គំរោង");
                        }
                        $('#txtname').val(data['transfers'].partner.name);
                        $('#txtname').attr('title',data['transfers']['parrent_id']);
                        $('#amount').attr('title',data['transfers']['sendername']);
                        $('#amount').val(formatNumber(Math.abs(data['transfers']['amount'])));
                        $('#txtcur').val(data['transfers']['currency'].shortcut);
                        $('#txtcur').attr('title',data['transfers'].currency_id);
                        $('#row_deposited').css('display','table-row');
                        $('#row_balance').css('display','table-row');
                        $('#deposited').val(formatNumber(data['totalpayment']));
                        $('.cur').val(data['transfers']['currency'].shortcut);
                        $('#balance').val(formatNumber(parseFloat(Math.abs(data['transfers']['amount']) - parseFloat(Math.abs(data['totalpayment'])) )));

                        for(let i=0;i<data['saledetails'].length;i++){
                            row=`
                                <tr class="item">
                                    <td class="kh14 no" style="text-align:center;">${i+1}</td>
                                    <td style="display:none;">
                                        <input type="text" class="input-group pid kh14-b" name="pid[]" style="width:60px;padding:0px 5px;" value="${data['saledetails'][i].property_id}" readonly>
                                    </td>
                                    <td class="kh14-b pname" name="pname[]">${data['saledetails'][i].property.name}</td>
                                    <td class="kh14-b psize" name="psize[]">${data['saledetails'][i].property.size}</td>
                                    <td class="kh14-b" style="padding:0px;">
                                        <div class="input-group">
                                            <input type="text" class="form-control p_price kh14-b" name="p_price[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(data['saledetails'][i].price)}">
                                            <input type="text" class="input-group p_cur kh14-b" name="p_cur[]" style="width:60px;padding:0px 5px;border-style:none;height:25px;margin-top:3px;background-color:transparent;" value="${data['saledetails'][i].currency.shortcut}" readonly>
                                        </div>
                                    </td>

                                    <td style="display:none;">
                                        <input type="text" class="input-group p_cur_id kh14-b" name="p_cur_id[]" style="width:60px;padding:0px 5px;" value="${data['saledetails'][i].currency_id}" readonly>
                                    </td>
                                    <td style="text-align:center;padding:5px 0px;display:none;">
                                        <a href="" class="btnremoveitem"><i class="fa fa-trash" style="color:red;"></i></a>
                                    </td>
                                </tr>
                            `;

                        }
                        $('#haction').css('display','none');
                        $('#body_sale_detail').empty().append(row);
                    }else{

                    }
                })
            })
        })
        $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toUpperCase();
            $("#mytable tr").each(function(index) {
                if (index !== 0) {
                    $row = $(this);

                    $row.find('td').each (function() {
                        var id = $(this).text();
                        if (id.toUpperCase().search(value) < 0) {
                            $row.hide();
                        }
                        else {
                            $row.show();
                            return false;
                        }
                    });

                }
            });
        });

    </script>


@endsection
