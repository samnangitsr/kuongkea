<script type="text/javascript">
    $(document).ready(function () {
        //prevent enter key
        // $(document).keypress(
        //     function(event){
        //         if (event.which == '13') {
        //         event.preventDefault();
        //         }
        // });

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
                var bankid=$("#selbank").val();
                var bankname=$("#selbank option:selected").text();
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
                
                $('#bodypayment').append(`
                <tr>
                    <td class="no" style="padding:5px;text-align:center;font-size:20px;width:80px;">${rowCount}</td>
                    <td class="paymethod" style="padding:5px;width:150px;">
                        <input type="text"  name="tdpaymethod[]" class="form-control" style="width:150px;padding:0px;border-style:none;font-size:22px;" value="${paymethod}">   
                    </td>
                
                    <td style="padding:5px;width:250px;">
                        <input type="text"  name="tdpayamt[]" class="form-control payamt" style="width:250px;padding:0px;text-align:right;border-style:none;font-size:22px;" value="${payamt}">
                    </td>
                    <td style="padding:5px;width:60px;">
                        <input type="text" name="tdcur[]" class="form-control" style="width:60px;padding:0px 0px 0px 2px;border-style:none;font-size:22px;" value="${cur}">
                    </td>
                    <td style="padding:5px;width:250px;">
                        <input type="text" name="tdexchangeamount[]" class="form-control" style="width:250px;text-align:right;padding:0px;border-style:none;font-size:22px;" value="${examt}">    
                    </td>
                    <td style="padding:5px;width:60px;">
                        <input type="text"  name="tdcutluy[]" class="form-control" style="width:60px;padding:0px 0px 0px 2px;border-style:none;font-size:22px" value="${cutluy}">
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
                    <td style="padding:5px;width:300px;">
                        <input type="text"  name="tdbankname[]" class="form-control" style="width:300px;padding:0px;border-style:none;font-size:20px;" value="${bankname}">
                        <input type="hidden"  name="tdbankid[]" class="form-control" style="width:250px;padding:0px;border-style:none;" value="${bankid}">    
                    </td>
                    <td style="padding:5px;width:100px;">
                        <button class="btn btn-danger btn-md paymentrowremove" style="">Remove</button>
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
            var v = document.getElementById('ckpayinmoney').checked;
            if(v==true){
                $('#hasdeposit').val(jsformatNumber(totaldeposit));
            }else{
                $('#deposit').val(jsformatNumber(totaldeposit));
            }
       }
       $(document).on('change','#deposit',function(e){
                e.preventDefault();
               calcubalance();
            })
            $(document).on('change','#payamount',function(e){
                e.preventDefault();
                //$('#deposit').val($(this).val());
                var balance=parseFloat($('#paiddepositall').val().replace(/,/g,''));
                var deposit=Math.abs($(this).val().replace(/,/g,''));
                if(balance>0){
                    deposit=deposit;
                }else{
                    deposit=-1 * deposit;
                }
                var v = document.getElementById('ckpayinmoney').checked;
                if(v==true){
                    $('#hasdeposit').val(jsformatNumber(deposit));
                }else{
                    $('#deposit').val(jsformatNumber(deposit));
                }
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
                $('#rate').val(ratesale);
                $('#rateset').val(ratesale);
                $('#rate').attr('title',opsign);
                exchange();
            })
            function exchange()
            {
                var s=$('#rate').attr('title');
                var r=$('#rate').val();
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
            $(document).on('keydown', '.paidbalance', function (e) {
                if (e.keyCode == 13) {
                    var $this = $(this),
			        index = $this.closest('td').index();
			        $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
			        e.preventDefault();
                }
            })
        $(document).on('change','#ckpayinmoney',function(e){
            var v = document.getElementById('ckpayinmoney').checked;
            if(v==true){
                $('#paycur').val('USD')
                $('#selexchangecur').prop('disabled',false)
            }else{
                $('#paycur').val('LI')
                $('#selexchangecur').prop('disabled',true)
            }
        })
    })
</script>