@extends('master')
@section('title') Invoice Detail @endsection
@section('css')
    <style type="text/css">
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
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-bordered kh22">
                        <tr>
                            <td style="width:100px;">លេខវិក្ក័យបត្រ</td>
                            <td  style="">{{ sprintf("%04d",$inv->id) }}</td>
                        </tr>
                        <tr>
                            <td  style="width:100px;">ថ្ងៃទី</td>
                            <td  style="">{{ date('d-m-Y',strtotime($inv->invdate)) }}</td>
                        </tr>
                        <tr>
                            <td  style="width:100px;">ម៉ោង</td>
                            <td  style="">{{ $inv->invtime }}</td>
                        </tr>
                        <tr>
                            <td  style="width:100px;">អ្នកកត់ត្រា</td>
                            <td  style="">{{ $inv->user->name }}</td>
                        </tr>
                        <tr>
                            <td  style="width:100px;">អតិថិជន</td>
                            <td  style="">
                                {{ $inv->customer->name }}
                                (<span id="customer_id">{{ $inv->customer_id }}</span>)
                            </td>
    
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-bordered kh22">
                        <tr>
                            <td style="width:100px;">សរុបទម្ងន់</td>
                            <td style="">{{ $inv->totalweight . 'លី' }}</td>
                        </tr>
                        <tr>
                            <td style="width:100px;">សរុបទឹកប្រាក់</td>
                            <td style="">{{ phpformatnumber($inv->total) . $inv->cur }}</td>
                        </tr>
                        <tr>
                            <td style="width:100px;">លុយកក់</td>
                            <td style="">{{ phpformatnumber($inv->deposit) . $inv->cur }}</td>
                        </tr>
                        <tr>
                            <td style="width:100px;">នៅខ្វះ</td>
                            <td style="">
                                {{ phpformatnumber($inv->total - $inv->deposit) . $inv->cur }}
                                <button class="btn btn-primary" id="btnpayment" data-id="{{ $inv->id }}" style="float:right;">Payment</button>
                                {{-- <a href="#" class="btn btn-primary" target="_blank">Payment</a> --}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
   </div>
   <div class="row">
        <div class="table-responsive" style="">
            <div class="container">
                <div class="card" style="background-color:rgb(139, 199, 225);">
                    <table class="table kh22">
                        <thead>
                            <th>លរ</th>
                            <th>ទម្ងន់</th>
                            <th>ទឹក</th>
                            <th>តំលៃ</th>
                            <th>សរុប</th>
                        </thead>
                        <tbody id="invlist">
                            @foreach ($invdetail as $key => $d)
                                <tr class="kh22">
                                    <td style="border-style:none;">{{ ++$key }}</td>
                                    <td style="border-style:none;">
                                        {{ $d->weight . 'លី' }}
                                    </td>
                                    
                                    <td style="border-style:none;">
                                        {{ $d->water }}
                                    </td>
                                    <td style="border-style:none;">
                                        {{ phpformatnumber($d->price) . $d->cur }}
                                    </td>
                                    <td style="border-style:none;">
                                        {{ phpformatnumber($d->amount) . $d->cur }}
                                    </td>  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
   </div>
   
   <div class="container">
        <div class="card" style="">
            <div class="card bg-primary text-white" style="padding:5px;">
                <h1 class="kh22" style="color:white;">តារាងទូទាត់</h1>
            </div>
            <div class="card-body" style="margin-top:-30px;">
                @foreach ($inv->payment->where('status',1) as $key => $payment)
                    <div class="card" style="background-color:rgb(212, 222, 223)">
                        <div class="container">
                            <table class="table kh22">
                                <thead style="text-align:center;">
                                    <th>កូតបង់ប្រាក់</th>
                                    <th>ថ្ងៃបង់ប្រាក់</th>
                                    <th>ម៉ោង</th>
                                    <th>ចំនួនទឹកប្រាក់</th>
                                    <th>សកម្មភាព</th>
                                </thead>
                                <tbody>
                                    <tr class="kh22">
                                        <td style="border-style:none">
                                            {{ $payment->id }}
                                            
                                        </td>
                                        <td style="border-style:none;text-align:center;">
                                            {{ date('d-m-Y',strtotime($payment->paiddate)) }}
                                        </td>
                                        <td style="border-style:none;text-align:center;">
                                            {{ $payment->paidtime}}
                                        </td>
                                        <td style="border-style:none;text-align:right;">
                                            {{ phpformatnumber($payment->amount) . $payment->cur}}
                                        </td>
                                        <td style="border-style:none;text-align:right;">
                                            <button class="btn btn-danger btn-md btn_payment_remove" data-paymentid="{{ $payment->id }}">លុប</button>
                                            <button class="btn btn-info btn-md btn_paymentcode_check" data-paymentid="{{ $payment->id }}">ពិនិត្យ</button>
                                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table id="tbl_paydetail" class="table table-bordered">
                                <thead class="kh22">
                                    <th>ប្រភេទបង់ប្រាក់</th>
                                    <th>ធនាគា</th>
                                    <th>ចំនួនទឹកប្រាក់</th>
                                    <th>លុយទទួល</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach ($payment->detail as $k => $pd)
                                        <tr class="kh22">
                                            <td>{{ $pd->paymethod }}</td>
                                            <td>{{ $pd->paynote }}</td>
                                            <td>{{ phpformatnumber($pd->amount) . $pd->cur }}</td>
                                            <td>{{ $pd->bankamount==0?phpformatnumber($pd->amount) . $pd->cur:phpformatnumber($pd->bankamount) . $pd->bankcur }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
   </div>
   <form id="frmpayment" action="">
       @include('invoices.paymentmodal')
   </form>
   @include('invoices.checkpaymentcodemodal')
@endsection
@section('script')
   @include('invoices.paymentjs')
    <script type="text/javascript">
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
            $(document).on('click','#btnsearch',function(e){
                e.preventDefault();
                var fdate=$('#fromdate').val();
                var tdate=$('#todate').val();
                var selcustomer=$('#selcustomer').val();
                var url="{{ route('invoice.search') }}";
                $.get(url,{fdate:fdate,tdate:tdate,selcustomer:selcustomer},function(data){
                    $('#invlist').empty().html(data);
                })
            })
            $(document).on('click','#btnpayment',function(e){
                e.preventDefault();
                var invid=$(this).data('id')
                var url="{{ route('invoice.showpaymentmodal') }}"
                $.get(url,{id:invid},function(data){
                    console.log(data)
                    $('#paymentmodal').modal('show'); 
                    $('#invoice_id').val(data['inv'].id);
                    $('#customername').val(data['inv']['customer'].name);
                    $('#invtotal').val(jsformatNumber(data['inv'].total));
                    $('#invcur1').val(data['inv'].cur);
                    $('#invcur2').val(data['inv'].cur);
                    $('#invcur3').val(data['inv'].cur);
                    $('#invcur4').val(data['inv'].cur);
                    $('#paycur').val(data['inv'].cur);
                    if(data['inv'].cur=='LI'){
                        document.getElementById("selexchangecur").disabled = true;
                        document.getElementById("exchangeamount").disabled = true;
                        document.getElementById("btnaddpaymentlist").disabled = true;
                        document.getElementById("rate").disabled = true;
                    }else{
                        document.getElementById("selexchangecur").disabled = false;
                        document.getElementById("exchangeamount").disabled = false;
                        document.getElementById("btnaddpaymentlist").disabled = false;
                        document.getElementById("rate").disabled = false;
                    }
                    var deposited=data['sumpaid'].totalpaid;
                    if (deposited==null) deposited = 0;
                    $('#deposited').val(jsformatNumber(deposited));
                    $('#balance').val(jsformatNumber(parseFloat(data['inv'].total)-parseFloat(deposited)));
                    
                    
                })
               
            })
            $(document).on('click','#btnsavepayment',function(e){
                e.preventDefault();
                // var paymethod=$('#paymethod').val();
                 var bankname=$("#selbank option:selected").text();
                // if(paymethod==''){
                //     alert('please select payment method.')
                //     return;
                // }else if(paymethod=='bank'){
                //     if(bankname==''){
                //         alert('please select bank name.')
                //         return;
                //     }
                // }
                var formdata = new FormData(frmpayment);
                var cus_id=$('#customer_id').text();
                formdata.append("customerID",cus_id);
                formdata.append("bankname",bankname);
                var url="{{ route('invoice.payment1') }}";
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
            $(document).on('click','.btn_payment_remove',function(e){
                e.preventDefault();
                var paymentid=$(this).data('paymentid');
               
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
                            url: "{{ route('invoice.deletepayment') }}",
                            data: { id: paymentid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    location.reload();
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
            $(document).on('click','.btn_paymentcode_check',function(e){
                e.preventDefault();
                var paymentid=$(this).data('paymentid');
                $('#paymentcodecheckmodal').modal('show');
                var url="{{ route('invoice.getinvpaymentbypaymentcode') }}";
                $.get(url,{paymentid:paymentid},function(data){
                    //console.log(data);
                    var k=0;
                    var totalusd=0;
                    var totalli=0;
                    var cur='';
                    var output='';
                    for (var i=0; i<data['payinv'].length; i++) {
                        k+=1;
                        cur=data['payinv'][i].cur;
                        if(cur=='USD'){
                            totalusd+=parseFloat(data['payinv'][i].amount);
                        }else{
                            totalli+=parseFloat(data['payinv'][i].amount);
                        }
                        output +=`<tr>
                                    <td style="text-align:center;">${k}</td>
                                    <td>${data['payinv'][i].payment_id}</td>
                                    <td>${data['payinv'][i].invoice_id}</td>
                                    <td style="text-align:right;">${jsformatNumber(data['payinv'][i].amount)}</td>
                                    <td>${data['payinv'][i].cur}</td>
                                </tr>`;

                    }
                    var totalrow='';
                    if(totalli!=0){
                        totalrow=jsformatNumber(totalli.toFixed(2)) + 'LI';
                    }
                    if(totalusd!=0){
                        totalrow +=' = ' + jsformatNumber(totalusd.toFixed(2)) + 'USD';
                    }
                    
                    output +=`<tr style="background-color:yellow;">
                                    
                                    <td class="kh22" colspan=2>សរុបលុយទូទាត់</td>
                                    <td style="text-align:right;font-size:22px;" colspan='3'>
                                        ${totalrow}
                                        
                                    </td>
                                    
                            </tr>`;
                    $('#tbl_check_payment_code').empty().html(output);
                })
            })
       })
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