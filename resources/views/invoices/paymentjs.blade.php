<script type="text/javascript">
    $(document).ready(function () {
        var cleave = new Cleave('#payamount', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        $(document).on('change','#paymethod',function(e){
                e.preventDefault();
                var value=this.value;
                var paycur=$('#paycur').val();
                if(paycur=='LI'){
                    if(value=='bank'){
                        alert('payment with this option not allow')
                        $('#paymethod').val('cash');
                        return;
                    }
                }else{

                }
                
                $('#selbank').val('');
                if(value=='bank'){
                    $('#selbank').prop('disabled', false);
                }else{
                    $('#selbank').prop('disabled', true);
                }
            })
            $(document).on('click','#btnaddpaymentlist',function(e){
                e.preventDefault();
                var rowCount = document.getElementById('paymenttable').rows.length;
                var paymethod=$('#paymethod').val();
                var bankname=$("#selbank option:selected").text();
                var bankid=$('#selbank').val();
                var payamount=$('#payamount').val();
                var payamt=jsformatNumber($('#payamount').val().replace(/,/g, ''));
                var cur='USD';
                var cutluy=$('#selexchangecur option:selected').text();
                var curid=$('#selexchangecur').val();
                var rate=$('#rate').val();
                var rateset=$('#rateset').val();
                var examt=0;
                if(cutluy!=''){
                    //xamt=$('#exchangeamount').val().replace(/,/g, '');
                    examt=$('#exchangeamount').val();
                }
                if(paymethod==''){
                    alert('please select payment method.')
                    return;
                }else if(paymethod=='bank'){
                    if(bankname==''){
                        alert('please select bank name.')
                        return;
                    }
                }
                if(payamount==0 || payamount==''){
                    alert('please input payment amount')
                    return;
                }
                $('#bodypayment').append(`
                <tr>
                    <td class="no" style="text-align:center;padding-top:12px;">${rowCount}</td>
                    <td class="paymethod" style="padding:0px;width:150px;">
                        <input type="text"  name="tdpaymethod[]" class="form-control" style="width:150px;border-style:none;font-size:22px;" value="${paymethod}">   
                    </td>
                
                    <td style="padding:0px;width:200px;">
                        <input type="text"  name="tdpayamt[]" class="form-control payamt" style="width:200px;text-align:right;border-style:none;font-size:22px;" value="${payamt}">
                    </td>
                    <td style="padding:0px;width:70px;">
                        <input type="text" name="tdcur[]" class="form-control" style="width:70px;border-style:none;font-size:22px;" value="${cur}">
                    </td>
                    <td style="padding:0px;width:250px;">
                        <input type="text" name="tdexchangeamount[]" class="form-control" style="width:250px;text-align:right;border-style:none;font-size:22px;" value="${examt}">    
                    </td>
                    <td style="padding:0px;width:70px;">
                        <input type="text"  name="tdcutluy[]" class="form-control" style="width:70px;border-style:none;font-size:22px;" value="${cutluy}">
                    </td>
                    <td style="display:none;padding:0px;">
                        <input type="text" name="tdcurid[]" class="form-control" value="${curid}">
                    </td>
                    <td style="display:none;">
                        <input type="text" name="tdrate[]" class="form-control" value="${rate}">
                    </td>
                    <td style="display:none;padding:0px;">
                        <input type="text"  name="tdrateset[]" class="form-control" value="${rateset}">
                    </td>
                    <td style="padding:0px;width:300px;">
                        <input type="text"  name="tdbankname[]" class="form-control" style="width:300px;border-style:none;font-size:22px;" value="${bankname}">
                    </td>
                    <td style="padding:0px;width:50px;display:none;">
                        <input type="text"  name="tdbankid[]" class="form-control" style="width:50px;border-style:none;font-size:22px;" value="${bankid}">
                    </td>
                    <td style="text-align:center;">
                        <button class="btn btn-default btn-sm paymentrowremove" style="color:red;">Remove</button>
                    </td>
                </tr>
                
                `);
                cleartext();
                totaldeposit();
                calcubalance();
            })
            $(document).on('click','.paymentrowremove',function(e){
                e.preventDefault();
                $(this).closest("tr").remove();
                totaldeposit();
                calcubalance();
                ResetNo();

            })
        function calcubalance(){
            var invtotal=$('#invtotal').val().replace(/,/g, '');
            var deposit=$('#deposit').val().replace(/,/g, '');
            var deposited=$('#deposited').val().replace(/,/g, '');
            var balance=invtotal-deposit-deposited;
            $('#balance').val(jsformatNumber(balance.toFixed(2)));
        }
       
        function cleartext(){
            $('#selbank').val('');
            $('#payamount').val('');
            $('#selexchangecur').val('');
            $('#rate').val('');
            $('#exchangeamount').val('');
        }
        function ResetNo(){
			$('.no').each(function(i,e){
				$(this).text(i+1);
			})
		}
       function totaldeposit(){
            var totaldeposit=0;
            $('.payamt').each(function(i,e){
                totaldeposit +=parseFloat($(this).val().replace(/,/g, ''));
            })
            $('#deposit').val(jsformatNumber(totaldeposit));
       }
       $(document).on('change','#deposit',function(e){
                e.preventDefault();
               calcubalance();
            })
            $(document).on('change','#payamount',function(e){
                e.preventDefault();
                var balance=parseFloat($('#balance').val().replace(/,/g,''));
                var deposit=Math.abs($(this).val().replace(/,/g,''));
                if(balance>0){
                    deposit=deposit;
                }else{
                    deposit=-1 * deposit;
                }
                $('#deposit').val(jsformatNumber(deposit));
                $('#payamount').val(jsformatNumber(deposit));
                calcubalance();
            })
            $(document).on('change','#selexchangecur',function(e){
                e.preventDefault();
                var opsign=$(this).find(':selected').data('opsign');
                var ratebuy=$(this).find(':selected').attr('data-ratebuy');
                var ratesale=$(this).find(':selected').attr('data-ratesale');
                var seltext=$("#selexchangecur option:selected").text();
                $('#exchangecur').val(seltext);
                $('#rate').val(jsformatNumber(ratesale));
                $('#rateset').val(ratesale);
                $('#rate').attr('title',opsign);
                exchange();
            })
            function exchange()
            {
                var s=$('#rate').attr('title');
                var r=$('#rate').val().replace(/,/g, '');
                var amt=$('#payamount').val().replace(/,/g, '');
                var exchange=0;
                if(s=='/'){
                    exchange=amt * r;
                }else{
                    exchange=amt / r;
                }
                $('#exchangeamount').val(jsformatNumber(exchange.toFixed(2)));
            }
            $(document).on('keyup','#rate,#payamount',function(e){
                e.preventDefault();
                if($('#selexchangecur').val()!='')
                {
                    exchange();
                }
            })
            $(document).on('keydown', '.canenter', function (e) {
                if (e.keyCode == 13) {
                    var id = $(this).attr("id");
                    if (id == 'payamount') {
                        $('#selexchangecur').focus();
                    } else if(id == 'selexchangecur'){
                        $('#rate').focus();
                    } else if (id == 'rate') {
                        $('#btnaddpaymentlist').focus();
                    }
                    e.preventDefault();
                }
            })
    })
</script>