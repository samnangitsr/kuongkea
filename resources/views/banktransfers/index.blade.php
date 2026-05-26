@extends('master')
@section('title') BANK TRANSFER @endsection
@section('css')
    <style type="text/css">
        #sel_from + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:aqua;height:40px;}
		/* Each result */
		#select2-sel_from-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:aqua;} 

        #sel_to + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:aquamarine;height:40px;}
		/* Each result */
		#select2-sel_to-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:aquamarine;} 

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;}
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
    .tbl_banktransfer .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_banktransfer .clickedrow td input{
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
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>
                        <button id="btntransfer" class="btn btn-info kh22">ផ្ទេរប្រាក់</button>
                        
                    </td>
                </tr>
            </table>
        </div>
   </div>
   <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered kh22 tbl_banktransfer">
                <thead>
                    <th>លរ</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>ឈ្មោះធនាគា</th>
                    <th>ប្រតិបត្តិការណ៏</th>
                    <th>ចំនួនទឹកប្រាក់</th>
                    <th>រូបិយ</th>
                    
                    <th>ផ្សេងៗ</th>
                    <th>សកម្មភាព</th>
                </thead>
                <tbody id="tbl_banktransaction">
                    @foreach ($BankTransactions as $key => $bt)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ date('d-m-Y',strtotime($bt->trandate)) . ' ' . $bt->trantime }}</td>
                            <td>{{ $bt->user->name }}</td>
                            <td>{{ $bt->customer->name }}</td>
                            <td>{{ $bt->tranname }}</td>
                            <td style="text-align:right;">{{ phpformatnumber($bt->amount) }}</td>
                            <td>{{ $bt->currency->shortcut }}</td>
                            
                            <td>{{ $bt->note }}</td>
                            <td>
                                @if($bt->payment_id=='' && $bt->ref_number=='')
                                <a href="javascript:void(0)" data-id="{{ $bt->id }}" data-payment_id="{{ $bt->payment_id }}" data-ref_number="{{ $bt->ref_number }}" class="btn btn-danger btn-sm btnremove">Remove</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>
   <form action="" id="frmbanktransaction">
       @include('banktransfers.transfermodal')
   </form>
@endsection
@section('script')
   
    <script type="text/javascript">
       
$(document).ready(function () {
    $("#sel_from").select2({
        dropdownParent: $("#transfermodal")
    });
    $("#sel_to").select2({
        dropdownParent: $("#transfermodal")
    });
            var today=new Date();
            $('#trdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            var cleave1 = new Cleave('#amount1', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave2 = new Cleave('#amount2', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
            $(document).on('click','.tbl_banktransfer td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','#btntransfer',function(){
                $('#transfermodal').modal('show');
            })
            $(document).on('click','#btnsavetransfer',function(e){
                e.preventDefault();
                var cur1=$('#sel_cur1 option:selected').text();
                var cur2=$('#sel_cur2 option:selected').text();
                var receiver=$('#sel_to option:selected').text();
                var sender=$('#sel_from option:selected').text();
                
                var formdata = new FormData(frmbanktransaction);
                // var cus_id=$('#customer_id').text();
                 formdata.append("cur1",cur1);
                 formdata.append("cur2",cur2);
                 formdata.append("sender",sender);
                 formdata.append("receiver",receiver);
                var url="{{ route('banktransfer.savetransfer') }}";
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
                            location.reload();
                        
                       }else{
                            alert(data.error)
                       } 
                    },
                    error: function () {
                        alert('Save Error')
                        
                    }

                })
            })
            $(document).on('click','.btnremove',function(e){
                e.preventDefault();
                var id=$(this).data('id');
               
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
                            url: "{{ route('banktransfer.delete') }}",
                            data: { id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    location.reload();
                                    //$('#btnsearch').click();
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
            $(document).on('keyup','#amount1',function(e){
                const C = e.key;
                if (C === "Backspace") {
                    return;
                }
                if(isNumber(C)==false){
                    if(C=='Enter'){
                        $('#sel_cur1').focus();
                    }else{
                        getcurrencybykey(C,'#sel_cur1');
                    }
                }
            })
            $(document).on('keyup','#amount2',function(e){
                const C = e.key;
                if (C === "Backspace") {
                    return;
                }
                if(isNumber(C)==false){
                    getcurrencybykey(C,'#sel_cur2');
                }
            })
            $(document).on('change','#sel_cur2',function(e){
                e.preventDefault();
                $('#rate').attr('title', '');
                $('#rate').val('');
                $('#amount2').val('');
                getcurrencybyid($(this).val(),'#sel_cur2')
                var exchangecur=$("#sel_cur2 option:selected").text();
                $('#amtcur2').val(exchangecur);
            })
            $(document).on('change','#sel_cur1',function(e){
                e.preventDefault();
                getcurrencybyid($(this).val(),'#sel_cur1')
            })
            $(document).on('keyup', '#rate', function (e) {
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
                
            })
          
})
function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
            function calcuexchangeproduct() {
                var luy = $('#amount1').val().replace(/,/g, '');
                var r = $('#rate').val().replace(/,/g, '');
                var rs = $('#rate').attr('title').split(";");
               
                if (rs[2] == '*') {
                    $('#amount2').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
                
            }
            function calcuexchange() {
                 //debugger
               
                var luy = $('#amount1').val().replace(/,/g, '');
                var r = $('#rate').val().replace(/,/g, '');
                var m1 = $('#sel_cur1').attr('title').split(";");
                var m2 = $('#sel_cur2').attr('title').split(";");
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
           
        function getcurrencybykey(key,el)
        {
            var url="{{ route('getcurrencybykey') }}";
            $.get(url,{key:key},function(data){
                 //console.log(data)
                
                    if(data['c']!=null){
                    
                        $(el).val(data['c']['id']);
                        $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                        getrate();
                    }         
            })
        }
        function getcurrencybyid(id,el)
        {
            var url="{{ route('getcurrencybyid') }}";
            $.get(url,{id:id},function(data){
                 //console.log(data)
                
                    if(data['c']!=null){
                    
                        $(el).val(data['c']['id']);
                        $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                        getrate();
                    }         
            })
        }
        function getrate() {
                
                $('#rate').attr('title', '');
                $('#rate').val('');
                $('#amount2').val('');
                var m = $('#sel_cur1').attr('title').split(";");
                var p = $('#sel_cur2').attr('title').split(";");
                if(m=='' || p==''){
                    //alert('can not save')
                    return;
                }
                //check if the save curname
                //debugger
                if (m[6] == p[6]) {
                    $('#rate').val(1);
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
                    $('#rate').val(formatNumber(parseFloat(p[2])));//get rate p sale
                } else {
                    $('#rate').val(formatNumber(parseFloat(m[1])));//get rate m buy
                }

                //$('#lblrate').attr('title',$('#txtrate').val());
                calcuexchange();
                
            }
            function runproductrate() {
                //debugger
                var url="{{ route('getproductrate') }}";
                var buycur =$("#sel_cur1 option:selected").text();
                var salecur = $("#sel_cur2 option:selected").text();
                var curname = '';
                
                curname = buycur + '-' + salecur;
                //alert(curname)
                //alert(curname)
                $.get(url,{curname:curname},function(data){
                    
                    if(data.success){
                        $('#rate').val(formatNumber(parseFloat(data['pr']['rate'])));
                        $('#rate').attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                        calcuexchangeproduct();
                    }else{
                        $('#rate').val('');
                        $('#rate').attr('title','');
                    }
                    console.log(data)
                    
                })

               
            }
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
    </script>
@endsection