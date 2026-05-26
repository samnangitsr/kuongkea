@extends('master')
@section('title') buysalegold @endsection
@section('css')
    <style type="text/css">
         #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;} 
		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
        
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
       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }
      
    </style>    
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form id="frminvoice" action="">
                <div class="card">
                    <div class="card-header" style="text-align:center;padding:0px;">
                        <select class="form-select kh22" name="carttitle" id="carttitle" style="background-color:goldenrod;text-align:center;">
                            <option value="1">ទិញលក់មាស</option>
                            <option value="2">ទំនិញដូរទំនិញ</option>
                        </select>
                        <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="kh22">
                                        <tr>
                                            <td colspan=2><label for="date" style="width:120px;" class="kh22">កាលបរិច្ឆេទ</label></td>
                                            <td> 
                                                <input type="text" name="invdate" id="invdate" class="form-control" style="width:280px;background-color:silver;font-size:22px;" readonly> 
                                            </td>
                                            <td style="">
                                                <button class="btn btn-info kh22" style="width:80px;"><i class="fa fa-calendar fa-2x"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan=2><label for="date" style="width:80px;" class="kh22">អតិថិជន</label></td>
                                            <td> 
                                                <select name="selcustomer" id="selcustomer" class="form-select" style="" required>
                                                    <option value="">ជ្រើសរើសអតិថិជន</option>
                                                    @foreach ($customers as $c)
                                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                    @endforeach
                                                </select> 
                                            </td>
                                            <td>
                                                <button class="btn btn-info btnaddcustomer kh22" style="width:80px;"><i class="fa fa-plus fa-2x"></i></button>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td><label for="weight" class="kh22" style="width:80px;">ទម្ងន់</label></td>
                                            <td><input type="text" name="sign" id="sign" value="+" class="form-control txtexchange" style="width:60px;text-align:center;font-size:22px;" readonly></td>
                                            <td><input type="text" name="weight" id="weight" class="form-control txtexchange canenter" style="width:280px;color:blue;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required autocomplete="off"></td> 
                                            <td>
                                                
                                                <input type="text" class="form-control kh22" style="width:80px;text-align:center;" value="លី" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan=2><label for="water" class="kh22" style="width:80px;">ទឺក</label></td>
                                            <td> 
                                                <input type="text" name="water" id="water" class="form-control txtexchange canenter" style="width:280px;text-align:right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required autocomplete="off"> 
                                            </td>
                                            <td>
                                                
                                                <input type="text" class="form-control kh22" style="width:80px;text-align:center;" value="/100" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan=2><label id="lblprice" for="price" class="kh22" style="width:80px;">តំលៃ</label></td>
                                            
                                            <td> 
                                                <input type="text" name="price" id="price" class="form-control txtexchange canenter" style="width:280px;text-align:right;color:red;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required autocomplete="off"> 
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kh22" style="width:80px;text-align:center;" id="txtcur1" name="txtcur1" value="USD" readonly>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="total" class="kh22" style="width:80px;">សរុប</label></td>
                                            <td><input type="text" name="sign1" id="sign1" value="-" class="form-control txtexchange" style="width:60px;text-align:center;font-size:22px;" readonly></td>
                                            
                                            <td> 
                                                <input type="text" name="total" id="total" class="form-control txtexchange" style="width:280px;text-align:right;" readonly autocomplete="off"> 
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kh22" style="width:80px;text-align:center;" value="USD" readonly>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div id="templist">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-bordered kh22">
                                                <thead style="text-align:center;">
                                                    <th>លរ</th>
                                                    <th>ទម្ងន់</th>
                                                    <th>ទឹក</th>
                                                    <th>តំលៃ</th>
                                                    <th>រូបិយ</th>
                                                    <th>សរុបទឹកប្រាក់</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody>
                                                    
                                                    @foreach ($tempinvs as $key => $m)
                                                        <tr>
                                                            <td style="text-align:center;">{{ ++$key }}</td>
                                                            <td style="padding:0px;width:150px;">
                                                                <input type="text" name="weights[]" class="form-control kh22" style="width:150px;border-style:none;padding-left:0px;padding-right:0px;text-align:center;" value="{{ phpformatnumber($m->weight) }}"> 
                                                            </td>
                                                            <td style="padding:0px;width:120px;">
                                                                <input type="text" name="waters[]" class="form-control kh22" style="width:120px;border-style:none;padding-left:0px;padding-right:0px;text-align:center;" value="{{ $m->water }}">
                                                            </td>
                                                            <td style="padding:0px;width:100px;">
                                                                <input type="text" name="prices[]" class="form-control kh22" style="width:100px;border-style:none;padding-left:0px;padding-right:0px;text-align:center;" value="{{ $m->price }}">
                                                            </td>
                                                            <td style="padding:0px;width:80px;">
                                                                <input type="text" name="curs[]" class="form-control kh22" style="width:80px;border-style:none;padding-left:0px;padding-right:0px;text-align:center;" value="{{ $m->cur }}">
                                                            </td>
                                                            
                                                            <td style="padding:0px;width:180px;">
                                                                <input type="text" name="totals[]" class="form-control kh22" style="width:180px;border-style:none;padding-left:0px;padding-right:0px;text-align:center" value="{{ phpformatnumber($m->amount) }}">
                                                            </td>
                                                            <td style="padding:5px;text-align:center;">
                                                                <a data-id="{{ $m->id }}" class="btn btn-danger btn-sm btndelmxlist" href="">Delete</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-lg-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="kh22">
                                                        <th>សរុបទម្ងន់</th>
                                                        
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($totalweight as $key =>$tb)
                                                            <tr>
                                                                <td style="padding:0px;border-style:none;"> 
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" id="totalweight" name="totalweight" class="form-control" style="font-size:22px;color:blue;border-style:none;text-align:right;" value="{{ phpformatnumber($tb->tweight) }}" readonly> 
                                                                        <input type="text" id="totalunit" name="totalunit" class="form-control kh22" value="លី" style="font-size:22px;color:blue;border-style:none;text-align:left;" readonly>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="table-responsive">
                                                <table id="tbl_totalinv" class="table">
                                                    <thead class="kh22">
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($totalinv as $key =>$ts)
                                                        <tr>
                                                            <td style="padding:0px;border-style:none;"> 
                                                                <div class="input-group mb-3">
                                                                    <input type="text" id="totalall" name="totalall" class="form-control" style="font-size:22px;color:red;border-style:none;text-align:right;" value="{{ phpformatnumber($ts->tsale) }}" readonly> 
                                                                    <input type="text" id="totalcur" name="totalcur" class="form-control" value="{{ $ts->cur }}" style="font-size:22px;color:red;border-style:none;text-align:left;" readonly>
                                                                    </div>
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
                    </div>
                    <div class="card-footer">
                        <button id="btnclear" class="btn btn-default">Clear</button>
                        <button id="btnaddlist" class="btn btn-info">Add List</button>
                        <div style="float:right">
                            <button id="btnsave" class="btn btn-info">Save</button>
                            <button id="btnsaveprint" class="btn btn-primary">Save Print</button>
                            <button id="btnpayment" class="btn btn-info">Payment</button>
                        </div>
                    
                    </div>
                </div>
                @include('invoices.paymentmodal')
            </form>
            <form action="" id="frmcustomer">
                @include('customers.addcustomermodal')
            </form>
        </div>
        
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
       
    </div>
    
@endsection
@section('script')
    @include('invoices.paymentjs')
    <script type="text/javascript">
      
        $(document).ready(function () {
            //setlabel();
            $('#selcustomer').select2();
            
             $('#weight').focus();
            window.addEventListener('keydown', function(e) {
                if (e.keyIdentifier == 'U+000A' || e.keyIdentifier == 'Enter' || e.keyCode == 13) {
                    if (e.target.nodeName == 'INPUT' && e.target.type == 'text') {
                        e.preventDefault();
                        return false;
                    }
                }
            }, true);
            var today=new Date();
            $('#invdate,#paiddate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            checkright();
            function checkright()
            {
                var role=$('#txtrole').val();
                if(role!='Admin'){
                    $('#invdate').datetimepicker("destroy");
                    $('#paiddate').datetimepicker("destroy");
                }
            }
            var cleave = new Cleave('#weight', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#total', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#rate', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
           $(document).on('click','.btnaddcustomer',function(e){
                $('#addcustomermodal').modal('show');
                getmaxno();
           })
           function getmaxno(){
                var url="{{ route('customer.getmaxcustomerno') }}";
                $.get(url,{},function(data){
                    $('#no').val(data['maxno']);
                })
            }
            $(document).keydown(function (event) {
                //alert(event.keyCode)
                if (event.keyCode == 123) { // Prevent F12
                    return false;
                } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
                    return false;
                }else if(event.ctrlKey && event.keyCode==83){ //ctrl + s
                    $('#btnsavepos').click();
                }else if(event.ctrlKey && event.keyCode==66){ //ctrl + b
                    //if($('#btnpayment').css('display',))
                    //$('#btnpayment').click();
                }
		    });
            $(document).on('change','#carttitle',function(e){
                var opid=$(this).val();
               
                if(opid==1){
                    $('#txtcur1').val('USD');
                    $('#txtcur2').text('USD')
                    $('#lblprice').text('តំលៃ')
                }else if(opid==2){
                    $('#txtcur1').val('LI');
                    $('#txtcur2').text('LI')
                    $('#lblprice').text('កាត់លី')
                }
                calculatebuysale();
            })
            $(document).on('keydown', '.canenter', function (e) {
                if (e.keyCode == 13) {
                    var id = $(this).attr("id");
                    if (id == 'weight') {
                        $('#water').focus();
                    } else if(id == 'water'){
                        $('#price').focus();
                    } else if (id == 'price') {
                        $('#btnsave').focus();
                    }
                    e.preventDefault();
                }
            })
          
            $('#btnclear').click(function(e){
                e.preventDefault();

                $('#frminvoice').trigger('reset');
                cleartemplist();
                $('#invdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            })
          function cleartemplist()
          {
            var url="{{ route('invoice.cleartemplist') }}";
            $.post(url,{},function(data){
                getmultiexchangelist();
            })
          }
            $(document).on('keyup', '#weight', function (e) {
                //debugger
                //alert(e.key)
                if(isNumber(e.key)){
                    calculatebuysale();
                    return;
                } 
                //alert('not a number')
                const C = e.key;
                if (C === "Backspace") {
                    calculatebuysale();
                    return;
                }else if(C==="+"){
                    e.preventDefault();
                    $('#sign').val('+');
                    $('#sign1').val('-');
                    $('#weight').css('color','blue');
                    $('#price').css('color','red');
                    //getrate();
                    
                    return;
                }else if(C==="-"){
                    e.preventDefault();
                    $('#sign').val('-');
                    $('#sign1').val('+');
                    $('#weight').css('color','red');
                    $('#price').css('color','blue');
                    //getrate();
                    
                    return;
                }
                
            })
          
            function calculatebuysale()
            {
                //debugger;
                var pep=$('#carttitle').val();
                var weight=$('#weight').val().replace(/,/g, '');
                var water=$('#water').val();
                var price=$('#price').val();
                var total=0;
                var water1=0;
                if(pep==2){
                    if(water<100){
                        price=price/100;
                        water1=(water - price)/100;
                    }else{
                        water1=(water - price)/1000;
                    }
                    
                    total=weight * water1;
                }else{
                    weight=weight/1000;
                    water1=water/100;
                    total=weight * water1 * price;
                }
                $('#total').val(jsformatNumber(parseFloat(total.toFixed(2))));
            }
            $(document).on('keyup', '#water,#price', function (e) {
                //debugger
                //alert(e.key)
                if(isNumber(e.key)){
                    calculatebuysale();
                    return;
                } 
                //alert('not a number')
                const C = e.key;
                if (C === "Backspace") {
                    calculatebuysale();
                    return;
                }
                //getcurrencybykey(C,'#lblsale')
            })
            $(document).on('click','#btnsavecustomer',function(e){
                e.preventDefault();
               
               
                var formdata = new FormData(frmcustomer);
                // var cus_id=$('#customer_id').text();
                 //formdata.append("cur1",cur1);
                 var btntext=$(this).text();
                var url="{{ route('customer.store') }}";
                $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       console.log(data)
                       if($.isEmptyObject(data.error)){
                            //location.reload();
                            $('#selcustomer').append($('<option>', {
                                value: data['cid'],
                                text: data['cname']
                            }));
                            $('#selcustomer').val(data['cid']);
                            $('#addcustomermodal').modal('hide');
                        
                       }else{
                            alert(data.error)
                       } 
                    },
                    error: function () {
                        alert('Save Error')
                        
                    }

                })
            })

            $(document).on('click', '#btnsave,#btnsaveprint,#btnsavepayment,#btnsavepaymentprint', function (e) {
                e.preventDefault();
                //debugger
                var actionfrom=$(this).attr('id');
                var bankname=$("#selbank option:selected").text();
                var formdata = new FormData(frminvoice);
                formdata.append('actionfrom',actionfrom);
                formdata.append('bankname',bankname);
                var url = "{{ route('invoice.store') }}";
                $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       if($.isEmptyObject(data.error)){
                        var selcustomerid=$('#selcustomer').val();
                        $('#frminvoice').trigger('reset');
                        $('#selcustomer').val(selcustomerid);
                        $('#weight').focus();
                        $('#bodypayment').empty();
                        $('#paymentmodal').modal('hide');
                        cleartemplist();
                        if(actionfrom=='btnsaveprint'||actionfrom=='btnsavepaymentprint'){
                            print(data.invid);
                        }
                        //location.reload();
                        $('#invdate,#paiddate').datetimepicker({
                            timepicker:false,
                            datepicker:true,
                            value:today,
                            format:'d-m-Y',
                            autoclose:true,
                            todayBtn:true,
                            startDate:today,
                        });
                       }else{
                            alert(data.error)
                       }
                       //alert(data.invid)
                    //    if(receipt2==1){ 
                    //     prints(data.id);
                    //    }else{
                    //     prints(data.id);
                    //    }
                       
                        
                        // $('#lblbuy').attr('title','');
                        // $('#lblsale').attr('title','');
                        // $('#txtrate').attr('title','');
                        // $('#txtbuy').focus();
                        
                    },
                    error: function () {
                        alert('Save Error')
                        
                    }

                })
            })
            function print(id){
                var htp=window.location.protocol;
                var htn=window.location.hostname;
                var redirectWindow = window.open(htp+'//'+htn+'/chaybros.com/invoice/print?id='+id, '_blank');
                redirectWindow.location;
            }
            $('#btnaddlist').click(function(e){
                e.preventDefault();
                
                var formdata = new FormData;
                var mekun=0;
                if($('#sign').val()=='+'){
                    mekun=1;
                }else{
                    mekun=-1;
                }
                var formdata = new FormData();
                //formdata.append("selcustomer", $('#selcustomer').val());
                //formdata.append("txtsign", $('#txtsign').val());
                formdata.append("weight",mekun * parseFloat($('#weight').val().replace(/,/g, '')));
                formdata.append("water", $('#water').val());
                formdata.append("price", $('#price').val());
                formdata.append('cur',$('#txtcur1').val());
                formdata.append("amount",-1 * mekun * parseFloat($('#total').val().replace(/,/g, '')));
               
                $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: "{{ route('invoice.savetemplist') }}",
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       
                       //$('#frminvoice').trigger('reset');
                       clearinvoicetext();
                       getmultiexchangelist();
                       $('#invdate').datetimepicker({
                        timepicker:false,
                        datepicker:true,
                        value:today,
                        format:'d-m-Y',
                        autoclose:true,
                        todayBtn:true,
                        startDate:today,
                        });
                    },
                    error: function () {
                        alert('Save Error.')
                    }
                   
                })

            })
            function clearinvoicetext(){
                
                $('#weight').val('');
                $('#water').val('');
                $('#price').val('');
                $('#total').val('');
                $('#weight').focus();
            }
            $(document).on('click','.btndelmxlist',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var url="{{ route('invoice.deltemplist') }}";
                $.post(url,{id:id},function(data){
                    console.log(data)
                    if(data.success){
                        getmultiexchangelist();
                    }else{
                        alert(data.error)
                    }
                })
            })
            
            $(document).on('click','#btnpayment',function(e){
                e.preventDefault();
                var selcustomer=$('#selcustomer').val();
                if(selcustomer==''){
                    alert('please select customer');
                    return;
                }
                
                $('#paymentmodal').modal('show'); 
                var table = document.getElementById("tbl_totalinv");
                var tbodyRowCount = table.tBodies[0].rows.length; 
                if(tbodyRowCount==0){
                    var totalall=0;
                }else{
                    var totalall=$('#totalall').val().replace(/,/g, '');
                }
                var mekun=1;
                var sign=$('#sign').val();
                if(sign=='-'){
                    mekun=-1;
                }
                var total=-1 * mekun * parseFloat($('#total').val().replace(/,/g, ''));
                var selcustomer=$("#selcustomer option:selected").text();
                if(totalall!=0){
                    $('#invtotal').val(jsformatNumber(totalall));
                }else{
                    $('#invtotal').val(jsformatNumber(total));    
                }
                calcubalance();
                $('#customername').val(selcustomer);
            })
            function calcubalance(){
                var invtotal=$('#invtotal').val().replace(/,/g, '');
                var deposit=$('#deposit').val().replace(/,/g, '');
                var deposited=$('#deposited').val().replace(/,/g, '');
                var balance=invtotal-deposit-deposited;
                $('#balance').val(jsformatNumber(balance.toFixed(2)));
            }
            function getmultiexchangelist()
            {
                var url="{{ route('invoice.gettemplist') }}";
                $.get(url,{},function(data){
                    console.log(data)
                    $('#templist').empty().html(data);
                })
            }
        })
       
        //-------------------------------------------//
        function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
       
           
        function jsformatNumber(num) 
        {
			num=parseFloat(num);
			var k=String(num).split('.');
			if(k.length==2){
				var fnum=k[0].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
				var snum=k[1];
				return fnum + '.' + snum;
				//return num.toFixed(2);
			}else{
				return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
			}
		}

       
        function print(id){
            var htp=window.location.protocol;
            var htn=window.location.hostname;
            var redirectWindow = window.open(htp+'//'+htn+'/chaybros.com/exchange/print?id='+id, '_blank');
            redirectWindow.location;
        }
        function prints(mapid){
            var htp=window.location.protocol;
            var htn=window.location.hostname;
            var redirectWindow = window.open(htp+'//'+htn+'/chaybros.com/exchange/prints?mapid='+mapid, '_blank');
            redirectWindow.location;
        }
    </script>
@endsection