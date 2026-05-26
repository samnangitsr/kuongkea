@extends('master')
@section('title') Payment @endsection
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
       .cgr{
        background-color:aquamarine;
       }
       .tbl_invoice .clickedrow td{
        background-color: #caaf8f;
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
<div class="row">
    <h1 class="kh22-b">អតិថិជនទូទាត់</h1>
</div>
   <div class="row">
        <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
        <div class="table-responsive">
            <table class=" kh22">
                <tr>
                    <th style="border-style:none;">គិតពី</th>
                    <th style="border-style:none;">ដល់</th>
                    <th style="border-style:none;">អតិថិជន</th>
                    <th style="border-style:none;">បុគ្គលិក</th>
                </tr>
                <tr>
                    
                    <td style="padding:0px;border-style:none;"> 
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="fromdate" id="fromdate" class="form-control" style="width:150px;background-color:silver;font-size:22px;"> 
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>
                    </td>
                    <td style="padding:0px;border-style:none;"> 
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="todate" id="todate" class="form-control" style="width:150px;background-color:silver;font-size:22px;"> 
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>
                    </td>
                    <td style="padding:0px;border-style:none;">
                        <select name="selcustomer" id="selcustomer" style="width:300px;" class="form-select kh22" required>
                            <option value="">ជ្រើសរើសអតិថិជន</option>
                            @foreach ($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select> 
                    </td>
                    <td style="border-style:none;padding:0px;">
                        <select class="form-select kh22" name="seluser" id="seluser" style="width:250px;">
                            <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                   <td style="padding:0px;border-style:none;">
                        <button class="btn btn-info" id="btnsearch" style="font-size:22px;">Search</button>
                   </td>
                </tr>
                
            </table>
        </div>
   </div>
   <div class="row">
        <div class="table-responsive">
            <table class=" kh22">
                <tr>
                    <td style="padding:0px;border-style:none;width:150px;">
                        <button class="btn btn-info kh22" id="btnpaid">ទូទាត់</button>
                    </td>
                   
                    <td style="border-style:none;">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rad3" id="notyet" value="0" checked>
                            <label class="form-check-label kh22" for="notyet">មិនទាន់ទូទាត់</label>
                        </div> 
                    </td>
                    <td style="border-style:none;">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rad3" id="paidcompleted" value="1">
                            <label class="form-check-label kh22" for="paidcompleted">ទូទាត់រួច</label>
                        </div>
                    </td>
                    <td style="border-style:none;">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rad3" id="radboth" value="2">
                            <label class="form-check-label kh22" for="radboth">ទាំងអស់</label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
   <div class="row">
        <div class="table-responsive" style="">
            <table class="table table-bordered tbl_invoice kh22" id="tbl_invoice">
                <thead class="" style="text-align:center;">
                    <th>លរ</th>
                    <th>    
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="ckall">
                            <label class="form-check-label kh22" for="ckall">លេខវិក័យបត្រ</label>
                        </div>
                    </th>
                    <th>ថ្ងៃទី</th>
                    <th>ម៉ោង</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>អតិថិជន</th>
                    <th>សរុបទម្ងន់</th>
                    <th colspan=2>សរុបទឹកប្រាក់</th>
                    <th colspan=2>បានទូទាត់</th>
                    <th colspan=2>នៅខ្វះ</th>
                    <th>សកម្មភាព</th>
                </thead>
                <tbody id="invlist">
                    @foreach ($invlist as $key => $inv)
                        <tr class="@if($inv->total>0) cgr @endif">
                            <td style="text-align:center;">{{ ++$key }}</td>
                            <td title="{{ $inv->id }}">
                                <div class="form-check">
                                    <input class="form-check-input ckinv" type="checkbox" value="" id="ck{{ $key }}">
                                    <label class="form-check-label kh22" for="ck{{ $key }}">{{ sprintf("%04d",$inv->id) }}</label>
                                </div>
                                {{-- <a href="{{ route('invoice.invoicedetail',['invid'=>$inv->id]) }}" target="_blank">
                                    {{ sprintf("%04d",$inv->id) }} 
                                </a> --}}
                            </td>
                            <td>
                                {{ date('d-m-Y',strtotime($inv->invdate)) }}
                            </td>
                            <td>
                                {{ $inv->invtime }}
                            </td>
                            <td>
                                {{ $inv->user->name }}
                            </td>
                           
                            <td title="{{ $inv->customer_id }}">
                                {{ $inv->customer->name }}
                            </td>
                            <td>
                                {{ phpformatnumber($inv->totalweight) . 'លី' }}
                            </td>
                            
                            <td style="text-align:right;">
                                {{ phpformatnumber($inv->total) }}
                            </td>
                            <td >
                                {{ $inv->cur }}
                            </td>
                            <td style="text-align:right;">
                                {{ phpformatnumber($inv->deposit) }}
                            </td>
                            <td>
                                {{ $inv->cur }}
                            </td>
                            <td style="text-align:right;">
                                {{ phpformatnumber($inv->total-$inv->deposit) }}
                            </td>
                            <td>
                                {{ $inv->cur }}
                            </td>
                            <td style="text-align:center;padding-top:10px;">
                                <a href="{{ route('invoice.invoicedetail',['invid'=>$inv->id]) }}" target="_blank">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>
   <form action="" id="frmpayment">
       @include('payments.paidmodal');
   </form>
@endsection
@section('script')
   @include('payments.paymentjs');
    <script type="text/javascript">
       function onlyNumberKey(txt, evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode == 46) {
                //Check if the text already contains the . character
                if (txt.value.indexOf('.') === -1) {
                return true;
                } else {
                return false;
                }
            }else if(charCode==45){
                if (txt.value.indexOf('-') === -1) {
                return true;
                } else {
                return false;
                }
            }else {
                if (charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;
            }
            return true;
        }
       $(document).ready(function () {
        
        var today=new Date();
            $('#fromdate,#todate,#paiddate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            $('#selcustomer').select2();
            function checkright()
            {
                var role=$('#txtrole').val();
                
                if(role!='Admin'){
                    $('#paiddate').datetimepicker("destroy");
                    
                }
            }
            $(document).on('click','.tbl_invoice td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
            $(document).on('click','#btnsavepayment,#btnsavepaymentprint',function(e){
                e.preventDefault();
                var actionfrom=$(this).attr('id');
                var bankname=$("#selbank option:selected").text();
                var v = document.getElementById('ckpayinmoney').checked;
                if(v==true){
                    var a=$('#totalamount').val().replace(/,/g,'');
                    var b=$('#hasdeposit').val().replace(/,/g,'');
                }else{
                    var a=$('#paiddepositall').val().replace(/,/g,'');
                    var b=$('#deposit').val().replace(/,/g,'');
                }
                if(a!=b){
                    alert('save payment not allow')
                    return;
                }
                var formdata = new FormData(frmpayment);
                // var cus_id=$('#customer_id').text();
                formdata.append("bankname",bankname);
                formdata.append("ckpayinmoneyval",v);
                var url="{{ route('payment.store') }}";
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
                            if(actionfrom=='btnsavepaymentprint'){
                                print(data.paymentid);
                            }
                            location.reload();

                        // $('#frmpayment').trigger('reset');
                        // $('#bodypayment').empty();
                        // $('#paymentmodal').modal('hide');
                       
                        // $('#paiddate').datetimepicker({
                        //     timepicker:false,
                        //     datepicker:true,
                        //     value:today,
                        //     format:'d-m-Y',
                        //     autoclose:true,
                        //     todayBtn:true,
                        //     startDate:today,
                        // });
                       }else{
                            alert(data.error)
                       } 
                    },
                    error: function () {
                        alert('Save Error')
                        
                    }

                })
            })
            function print(id){
                var htp=window.location.protocol;
                var htn=window.location.hostname;
                var redirectWindow = window.open(htp+'//'+htn+'/chaybros.com/payment/print?id='+id, '_blank');
                redirectWindow.location;
            }
            $(document).on('click','#btnsearch',function(e){
                e.preventDefault();
                search();
            })
            $(document).on('change','#notyet,#paidcompleted,#radboth',function(e){
                e.preventDefault();
                search();
            })
            function search()
            {
                var fdate=$('#fromdate').val();
                var tdate=$('#todate').val();
                var radsel=$('input[name="rad3"]:checked').val();

                var seluser=$('#seluser').val();
                var selcustomer=$('#selcustomer').val();
                var url="{{ route('payment.search') }}";
                $.get(url,{fdate:fdate,tdate:tdate,selcustomer:selcustomer,seluser:seluser,radsel:radsel},function(data){
                    $('#invlist').empty().html(data);
                })
            }
            $(document).on('click','#btnpaid',function() {
            	var total=0;
            	var deposited=0;
            	var balance=0;
            	var cur='';
            	var invnums='';
            	var i=0;
                var customer='';
            	var cus_id0='';
            	var cur0='';
            	var totalallinv=0;
            	var totalpayment=0;
                var totalbalance=0;
                $('#paymentmodal').modal('show');
                $('#frmpayment').trigger('reset');
                $('#paiddate').datetimepicker({
                            timepicker:false,
                            datepicker:true,
                            value:new Date(),
                            format:'d-m-Y',
                            autoclose:true,
                            todayBtn:true,
                            startDate:today,
                        });
            	// $('#paydate').val(moment().format('DD-MM-YYYY'));
                checkright();
            	$('#invselectpayment').empty();
	            $("#invlist input[type=checkbox]:checked").each(function (){
	                var row = $(this).closest("tr");
	                if(i==0){
	                	 customer=row.find("td:eq(5)").text();
	                	 cur0=row.find("td:eq(8)").text();
	                	 cus_id0=row.find("td:eq(5)").attr('title');
	                }
	                var cus_id=row.find("td:eq(5)").attr('title');
	                cur=row.find("td:eq(8)").text();
	                if(cus_id0 != cus_id || cur0 != cur){
	                	alert('paid invoice not the same name please check again')
	                	//$('#btncancel').click();
	                	return false;
	                }

	               	total=row.find("td:eq(7)").text();
                    deposited=row.find("td:eq(9)").text();
                    balance=row.find("td:eq(11)").text().replace(/,/g,'');
	                invnums =row.find("td:eq(1)").attr('title');
                    totalbalance +=parseFloat(row.find("td:eq(11)").text().replace(/,/g,'')) ;
	                
	                i++;
	                
	                  var tr=`<tr>+
	                  		<td style="padding:0px;width:70px;text-align:center;" class="no"> ${i} </td>
	                  		<td style="padding:0px;width:200px;">
	                  		    <input type="text" style="border-style:none;width:200px;height:45px;background-color:white;font-size:22px;" class="form-control paidinv" name="paidinv[]" readonly value="${invnums}">
	                  		</td>
                            <td style="padding:0px;width:200px;">
                                <input type="text" style="border-style:none;font-size:22px;color:blue;text-align:right;width:250px;" class="form-control paidtotal" name="paidtotal[]" value="${jsformatNumber(balance)}" readonly> 
                            </td>
                            <td style="padding:0px;width:70px;">
                                <input type="text" style="border-style:none;font-size:22px;color:blue;text-align:left;width:70px;" class="form-control paidcur" name="paidcur[]" value="${cur.trim()}" readonly>
                            </td>

	                  		<td style="padding:0px;width:200px;">
	                  		    <input type="text" style="border-style:none;font-size:22px;width:250px;text-align:right;" class="form-control paiddeposit numfont" name="paiddeposit[]" value="${jsformatNumber(balance)}" readonly>
	                  		</td>
                            <td style="padding:0px;width:70px;">
	                  		    <input type="text" style="border-style:none;font-size:22px;width:70px;" class="form-control paidcur1" name="paidcur1[]" readonly value="${cur.trim()}" readonly>
	                  		</td>
	                  		<td style="padding:0px;width:200px;">
	                  		    <input type="text" style="border-style:none;font-size:22px;text-align:right;width:250px;" onkeypress="return onlyNumberKey(this,event)" class="form-control paidbalance numfont" name="paidbalance[]" value="0">
	                  		</td>
                            <td style="padding:0px;width:70px;">
	                  		    <input type="text" style="border-style:none;font-size:22px;width:70px;" class="form-control paidcur2" name="paidcur2[]" readonly value="${cur.trim()}">
	                  		</td>
	                  		<td style="padding:7px 5px 5px 5px;text-align:center;width:100px;">
	                  		    <a href="#" class="btn btn-danger btn-sm minus_inv"><i class="fa fa-minus"></i></a>
	                  		</td>
	                  		</tr>`
	                  	$('#invselectpayment').append(tr);
	                  })
                      $('#invtotal').val(jsformatNumber(totalbalance.toFixed(2)));
                      $('#weight').val(jsformatNumber(-1 * totalbalance));
                      $('#water').val(100);
                      $('#invtotalcur').val(cur0.trim());
                      $('#paidcurall1').val(cur0.trim());
                      $('#paidcurall2').val(cur0.trim());
                      $('#paycur').val(cur0.trim());
                      $('#paiddepositall').val(jsformatNumber(totalbalance.toFixed(2)));
                      $('#paidbalanceall').val(0);
                      $('#customer').text(customer);
                      $('#customername').val(customer);
                      $('#customerid').val(cus_id0);
                      if(cur0.trim()=='LI'){
                        $("#rowinmoney").css("display", "block");
                        $('#selexchangecur').prop('disabled',true);
                        $('#btnaddpaymentlist').prop('disabled',true);
                      }else{
                        $('#selexchangecur').prop('disabled',false);
                        $("#rowinmoney").css("display", "none");
                        $('#btnaddpaymentlist').prop('disabled',false);
                      } 
	            });
               
                 $(document).on('keyup','.paidbalance',function(e){
                    e.preventDefault();
                    if(e.keyCode==13){
                        var sign=1;
                        var row = $(this).closest("tr");
                        var total=row.find("td:eq(2) input").val().replace(/,/g,'');
                        if(total<0){
                            sign=-1;
                        }
                        var bal=sign * Math.abs($(this).val());
                        var deposit=total-bal; 
                        row.find("td:eq(4) input").val(deposit);
                        row.find("td:eq(6) input").val(bal);
                        sumrowinvselectpayment();
                        $('#paymethod').focus();
                    }
                   
                 })
                 $(document).on('click','.minus_inv',function(e){
                    e.preventDefault();
                    $(this).closest("tr").remove();
                    sumrowinvselectpayment();
                    ResetNo();

                })
// -------------------------- start invoice -----------------------------------
          
            function calculatebuysale()
            {
                //debugger;
                
                var weight=$('#weight').val().replace(/,/g, '');
                var water=$('#water').val();
                var price=$('#price').val();
                var total=0;
                var water1=0;
               
                weight=weight/1000;
                water1=water/100;
                total=-1 * weight * water1 * price;
                
                $('#totalamount').val(jsformatNumber(parseFloat(total.toFixed(2))));
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
            function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
           //----------------------------------------end invoice ----------------------
	           
       })
       function ResetNo(){
			$('.no').each(function(i,e){
				$(this).text(i+1);
			})
		}
       
       function sumrowinvselectpayment(){
            var totalinv=0;
            var totaldeposit=0;
            var totalbalance=0;
            var total=0;
            var deposit=0;
            var balance=0;
        // $('.paiddeposit').each(function(i,e){
        //     debugger;
        //     deposit=$(this).val().replace(/,/g,'');
           
        //     totaldeposit +=parseFloat(deposit);
        // })
            $("#invselectpayment tr").each(function (){
                
                var row = $(this).closest("tr");        
                total=row.find("td:eq(2) input").val().replace(/,/g,'');
                deposit=row.find("td:eq(4) input").val().replace(/,/g,'');
                balance=row.find("td:eq(6) input").val().replace(/,/g,'');
                totalinv += parseFloat(total);
                totaldeposit += parseFloat(deposit);
                totalbalance += parseFloat(balance);
            })
            $('#invtotal').val(jsformatNumber(totalinv));
            $('#paiddepositall').val(jsformatNumber(totaldeposit));
            $('#paidbalanceall').val(jsformatNumber(totalbalance));
       }
       $('#ckall').click(function(event) {   
            if(this.checked) {
                // Iterate each checkbox
                $('.ckinv').each(function() {
                    this.checked = true;                        
                });
            } else {
                $('.ckinv').each(function() {
                    this.checked = false;                       
                });
            }
        }); 
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
    </script>
@endsection