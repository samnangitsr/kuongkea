<script type="text/javascript">
     $('#h1_title').text('Update Transaction Group');
  	function formatOption(option) {
				if (!option.id) {
					return option.text;
				}
				// Use a <div> to display the main text and a second line
         // option.element.value is get value from select
				var $option = $(
					'<div class="select2-option">' +
						'<div class="select2-option-main">' + option.text + '</div>' +
						'<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('customertype') : option.element.getAttribute('customertype')) + '</div>' +
					'</div>'
				);
				return $option;
			}

  	function formatOption1(option) {
				if (!option.id) {
					return option.text;
				}
				// Use a <div> to display the main text and a second line
         // option.element.value is get value from select

				var $option = $(
					'<div class="select2-option1">' +
						'<div class="select2-option-main">' + option.text + '</div>' +
						'<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('customertype') : option.element.getAttribute('customertype')) + '</div>' +
					'</div>'
				);
				return $option;
			}
  $(document).ready(function () {
      $('.bankid').select2({templateResult: formatOption1});
      $('#selpartner').select2({templateResult: formatOption1});
      $('#selpartner2').select2({templateResult: formatOption1});
      $('#selcustomer').select2({templateResult: formatOption1});
      $('.list_partnername').select2({templateResult: formatOption1});

      $("#sel_province_search").select2({
          dropdownParent: $("#searchchildmodal")
      });
      $("#sel_district_search").select2({
          dropdownParent: $("#searchchildmodal")
      });
      $("#sel_customer_search").select2({
          dropdownParent: $("#searchchildmodal")
      });

      $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
        $(this).closest(".select2-container").siblings('select:enabled').select2('open');
      });
      var today=new Date();
      $('#invdate').datetimepicker({
          timepicker:false,
          datepicker:true,
          //value:today,
          format:'d-m-Y',
          autoclose:true,
          todayBtn:true,
          startDate:today,

      });
      $('#invdate').datetimepicker("destroy");
      //checkright();
      function checkright()
      {
          var role=$('#txtrole').val();
          if(role!='Admin'){
            $('#invdate').datetimepicker("destroy");
          }
      }
      $(document).on('click','.btnchangedate',function(e){
        e.preventDefault();
        $('#invdate').datetimepicker({
          timepicker:false,
          datepicker:true,
          value:new Date(),
          format:'d-m-Y',
          autoclose:true,
          todayBtn:true,
          startDate:new Date(),

        });
      })
      function getuseraffectbypartner(partner_id,el,elnum){
          var url="{{ route('getuserpartner') }}";
          $(el).empty();
          if(elnum==1){
            $('#rowseluseraffect1').css('display','none');
          }else if(elnum==2){
            $('#rowseluseraffect2').css('display','none');
          }

          $.get(url,{customer_id:partner_id},function(data){
              //console.log(data);
              $(el).append($("<option/>",{
                          value:'',
                          text:''
                      }))
              $.each(data['useraffect'],function(i,item){
                  $(el).append($("<option/>",{
                          value:item.id,
                          text:item.name
                      }))
              });
          })
          if(elnum==1){
            var countselectoption=$('#seluseraffect1 option').length;
            if(countselectoption>1){
              $('#rowseluseraffect1').css('display','table-row');
            }
          }else if(elnum==2){
            var countselectoption=$('#seluseraffect2 option').length;
            if(countselectoption>1){
              $('#rowseluseraffect2').css('display','table-row');
            }
          }
      }
      $(document).on('change','#selpartner',function(e){
        e.preventDefault();
        //getuseraffectbypartner($(this).val(),'#seluseraffect1',1);
        var sp = document.querySelector("#selpartner");
        var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
        if(customertype=='CUSTOMER'){
            $('#row_kabrak1').css('display','table-row');
            var cur=$('#selcur option:selected').text();
            $('#txtcur_rate1').val(cur);
        }else{
            $('#row_kabrak1').css('display','none');
        }
        $('#lblpartner').text(customertype);
      })
      $(document).on('change','#selpartner2',function(e){
        e.preventDefault();
        //getuseraffectbypartner($(this).val(),'#seluseraffect2',2);
        var sp = document.querySelector("#selpartner2");
        var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
        if(customertype=='CUSTOMER'){
          var cur=$('#selcur option:selected').text();
          $('#txtcur_rate2').val(cur);
          $('#row_kabrak2').css('display','table-row');
        }else{
            $('#row_kabrak2').css('display','none');
        }
        $('#lblpartner2').text(customertype);
      })

      $(document).on('click','#btnchangedate',function(e){
            e.preventDefault();
            $('#invdate').datetimepicker({
            timepicker:false,
            datepicker:true,
            value:new Date(),
            format:'d-m-Y',
            autoclose:true,
            todayBtn:true,
            startDate:new Date(),
        })
      })
      var cleave = new Cleave('#amount', {
          numeral: true,
          numeralPositiveOnly: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave = new Cleave('#amountcontinue', {
          numeral: true,
          numeralPositiveOnly: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave = new Cleave('#cuscharge2', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave = new Cleave('#txtbuy', {
          numeral: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave = new Cleave('#txtrate', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave = new Cleave('#cuscharge', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave = new Cleave('#totalcash', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave = new Cleave('#fee', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave = new Cleave('#fee2', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave = new Cleave('#interest1', {
          numeral: true,
          numeralPositiveOnly: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });

      $('.bankamt').toArray().forEach(function(field){
          new Cleave(field, {
              numeral: true,
              numeralThousandsGroupStyle: 'thousand'
          });
      })
      $('.list_amount').toArray().forEach(function(field){
          new Cleave(field, {
              numeral: true,
              //numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
      })
      $('.list_cuscharge').toArray().forEach(function(field){
          new Cleave(field, {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
      })
      $('.list_fee').toArray().forEach(function(field){
          new Cleave(field, {
              numeral: true,
              numeralThousandsGroupStyle: 'thousand'
          });
      })

      $(document).on('click','#tbl_checkamt td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
        autocomplereceiver();
        function autocomplereceiver(){
                var sources=JSON.parse(localStorage.getItem("recphonelist"));
                var sources1=JSON.parse(localStorage.getItem("recnamelist"));
                $( "#rectel" ).autocomplete({
                    source:sources,
                    select: function( event, ui ) {
                        $( "#rectel" ).val( ui.item.value );
                        $( "#recname" ).val( ui.item.recname );
                        return false;
                    }
                    //    select : showResult,
                    //     focus : showResult,
                    //     change :showResult
                });
                $( "#recname" ).autocomplete({
                    source:sources1,
                    select: function( event, ui ) {
                        $( "#recname" ).val( ui.item.value );
                        $( "#rectel" ).val( ui.item.rectel );
                        return false;
                    }

                });
            }
      $(document).on('click','#btncontinue',function(e){
          e.preventDefault();
          $('#trancode1').val(-4);
          $('#trancode2').val(4);
          $('#divcontinue').css('display','block');
          window.scrollTo(0, document.body.scrollHeight);
          $('#selpartner2').focus();
          $('#fee2').val(0);

          $('#amountcontinue').val($('#amount').val());
          $('#amountcontinue').attr('title',$('#amount').val());
          $('#selcurcontinue').val($('#selcur').val());
          $('#selcuschargecontinuecur').val($('#selcur').val());
          $('#txtcur2').val($('#selcur').val());
          var cur=$('#selcur option:selected').text();
          $('#totalcash2').val($('#amount').val());
          $('#txtcur3').val(cur);
          var cleave = new Cleave('#amountcontinue', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
          var cleave = new Cleave('#fee2', {
              numeral: true,
              numeralDecimalScale: 6,
              numeralThousandsGroupStyle: 'thousand'
          });
          var cleave = new Cleave('#interest2', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralDecimalScale: 6,
              numeralThousandsGroupStyle: 'thousand'
          });

      })
      $('#selpartner2').on('select2:close', function (e)
      {
          $('#fee2').focus();
      });
      $(document).on('click','#btnbrowseson',function(e){
          e.preventDefault();
          $('#searchchildmodal').modal('show');
          var selpartner=$('#selpartner').val();
          $('#sel_customer_search').val(selpartner);
          $('#sel_customer_search').trigger('change');
      })
      $(document).on('click','.btn_select',function(e){
          e.preventDefault();
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          childname=row.find("td:eq(1)").text();
          addr=row.find("td:eq(3)").text();
          child_id=row.find("td:eq(4)").text();
          $('#child_id').val(child_id);
          $('#son').val(childname + '(' + addr + ')');
          $('#searchchildmodal').modal('hide');

      })
      $('#tblchildren').on('dblclick', '.rowclick', function(event) {

          var ind=$(this).index();
          var row=$(this).closest('tr');
          childname=row.find("td:eq(1)").text();
          addr=row.find("td:eq(3)").text();
          child_id=row.find("td:eq(4)").text();
          $('#son').val(childname + '(' + addr + ')');
          $('#child_id').val(child_id);
          $('#searchchildmodal').modal('hide');

      });

      $(document).on('click','#btnclosedivcontinue',function(e){
          e.preventDefault();
          $('#trancode1').val(-1);
          $('#trancode2').val('');
          $('#divcontinue').css('display','none');
      })
      $(document).on('click','#btnclosedivexchangecard',function(e){
          e.preventDefault();
          $('#divexchangecard').css('display','none');
          $('#divexchangelist').css('display','none');
          $('#hasexchange').val(0)
      })
      $(document).on('click','#btnclosedivexchangelist',function(e){
          e.preventDefault();
          //debugger;
          $('#divexchangelist').css('display','none');
          const element = document.getElementById("divexchangecard");
          var el=isElementDisplayed(element);
         if(el==true){
            $('#hasexchange').val(1)
         }else{
             $('#hasexchange').val(0)
         }
      })
      function isElementDisplayed(element) {
            return window.getComputedStyle(element).display !== "none";
        }
      $(document).on('click','#btnclosedivbankpayment',function(e){
          e.preventDefault();
          $('#divbankpayment').css('display','none');
          $('#hasbankpayment').val(0);
      })
      $(document).on('change','#selcur',function(e){
          var curid=$(this).val();
          var cur=$('#selcur option:selected').text();
          $('#txtcur').val(cur);
          $('#txtcur1').val(curid);
          $('#txtcur2').val(curid);
          $('#selcur1').val(curid);
          $('#txtcur_rate1').val(cur);
          $('#txtcur_rate2').val(cur);

      })
      $(document).on('change','#selcurcontinue',function(e){
          var curid=$(this).val();
          $('#txtcur2').val(curid);
          $('#selcuschargecontinuecur').val(curid);
          var cur=$('#selcurcontinue option:selected').text();
          $('#txtcur3').val(cur);

      })
      $(document).on('change','#selcur1',function(e){
          cutwater(0);
      })
      $(document).on('keyup','#amount',function(e){
          const C = e.key;
          if (C === "Backspace"){
              //cutwater(1);
              return;
          }
          if(isNumber(C)==false){
              getcurrencybykey1(C,'#selcur')
              var cur=$('#selcur option:selected').text();
              $('#txtcur').val(cur);
              $('#txtcur1').val($('#selcur').val());
              $('#txtcur2').val($('#selcur').val());
              $('#selcur1').val($('#selcur').val());
              $('#txtcur_rate1').val(cur);
              $('#txtcur_rate2').val(cur);

          }
          //cutwater(1);
      })
      $(document).on('keyup','#amountcontinue',function(e){
          const C = e.key;
          if (C === "Backspace"){
              return;
          }
          if(isNumber(C)==false){
              getcurrencybykey1(C,'#selcurcontinue')
              $('#txtcur2').val($('#selcurcontinue').val());
              $('#selcuschargecontinuecur').val($('#selcurcontinue').val());
              var cur=$('#selcurcontinue option:selected').text();
              $('#txtcur3').val(cur);
          }
      })
      $(document).on('keyup','#cuscharge2',function(e){
          const C = e.key;
          if (C === "Backspace"){
              return;
          }
          if(isNumber(C)==false){
              getcurrencybykey1(C,'#selcuschargecontinuecur')
              totalcash2();
          }
      })
      $(document).on('change','#cuscharge2',function(e){
          cutwater2(0);
      })
      $(document).on('change','#amountcontinue',function(e){
          cutwater2(1);
          $('#amountcontinue').attr('title',$(this).val());
      })
      function cutwater2(isamtkeyup)
      {
          if(isamtkeyup!=1){
              var ck = document.getElementById("ckwater2").checked;
              var amt=$('#amountcontinue').attr('title').replace(/,/g, '');
              var cuscharge=$('#cuscharge2').val().replace(/,/g, '');
              if(ck==true){
                  var cur=$('#selcurcontinue option:selected').text();
                  var cur1=$('#selcuschargecontinuecur option:selected').text();
                  if(cur==cur1){
                      amt=amt-cuscharge;
                  }
                  $('#amountcontinue').val(formatNumber(amt));
              }else{
                  amt=$('#amountcontinue').attr('title').replace(/,/g, '');
                  $('#amountcontinue').val(formatNumber(amt));
              }
          }
          totalcash2();
      }
      function totalcash2()
      {
          var totalcash=0;
          var amt=$('#amountcontinue').val().replace(/,/g, '');
          var cur=$('#selcurcontinue option:selected').text();
          var cuscharge=$('#cuscharge2').val().replace(/,/g, '');
          var cur1=$('#selcuschargecontinuecur option:selected').text();
          if(cur==cur1){
              totalcash=parseFloat(amt)+parseFloat(cuscharge);
          }else{
              totalcash=amt;
          }
          $('#totalcash2').val(formatNumber(parseFloat(totalcash)));
      }
      $(document).on('keyup','#fee',function(e){
          const C = e.key;
          if (C === "Backspace"){
              return;
          }
          if(isNumber(C)==false){
              getcurrencybykey1(C,'#txtcur1')
          }
      })
      $(document).on('keyup','#fee2',function(e){
          const C = e.key;
          if (C === "Backspace"){
              return;
          }
          if(isNumber(C)==false){
              getcurrencybykey1(C,'#txtcur2')
          }
      })
      $(document).on('keyup','#cuscharge',function(e){
          const C = e.key;

          if (C === "Backspace"){
              //cutwater(0);
              return;
          }
          if(isNumber(C)==false){
              getcurrencybykey1(C,'#selcur1')
              totalcash();
          }
          //cutwater(0);
      })
      $(document).on('change','#cuscharge',function(e){
          cutwater(0);
      })
      $(document).on('change','#amount',function(e){
          cutwater(1);
          $('#amount').attr('title',$(this).val());
          checkamountORtel($(this).val(),'amt');
      })
      $(document).on('change','#rectel',function(e){
          checkamountORtel($(this).val(),'tel');
      })
      $(document).on('click','#btnclosedivsearchamount',function(e){
        e.preventDefault();
        $('#divsearchamount').css('display','none');
      })
      $(document).on('click','#btnclosedivtransferlist',function(e){
        e.preventDefault();
        $('#divtransferlist').css('display','none');
        $('#hasmultitransfer').val(0);
      })
      function checkamountORtel(value,searchby){
        var url="{{ route('moneytransfer.checkamountortel') }}";
        $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: { search:value,searchby:searchby},
                complete: function () {

                },
                success: function (data) {
                  console.log(data);
                  var k=0;
                  var output='';
                  for(var i=0;i<data['transfers'].length;i++){
                        k+=1;
                        output +=
                        `<tr>
                            <td style="text-align:center;" class="kh16">${ k }</td>
                            <td class="kh16-b">
                                ${ moment(data['transfers'][i].dd).format("DD-MM-YYYY") }
                            </td>
                            <td class="kh16-b">${data['transfers'][i].user.name}</td>
                            <td class="kh16-b">${data['transfers'][i].partner.name}</td>
                            <td class="kh16-b">${data['transfers'][i].tranname}</td>
                            <td class="kh16-b" style="text-align:right;">${formatNumber(data['transfers'][i].amount) } ${ data['transfers'][i].currency .shortcut}</td>

                            <td class="kh16-b" style="text-align:right;">${data['transfers'][i].rectel}</td>
                            <td class="kh16-b">${data['transfers'][i].recname}</td>
                        </tr>`;
                    }
                    $('#body_divsearchamount').empty().html(output);
                    if(k>0){
                      $('#divsearchamount').css('display','inline');
                    }else{
                      $('#divsearchamount').css('display','none');
                    }
                },
                error: function () {
                    alert('Read Error.')
                }
            })
      }
      $(document).on('click','.btndeltransfertemp,#btncleartransferlist',function(e){
        e.preventDefault();
        var id=$(this).data('id');
        var elem=$(this).attr('id');
        var delall=0;
        if(elem=='btncleartransferlist'){
            delall=1;
        }
        var q = confirm("Do you want to delete this record?");
              if (q) {
                  var url="{{ route('moneytransfer.deltransfertemplist') }}";
                 $.post(url,{id:id,delall:delall},function(data){
                  gettransfertlist();
                 })
              }

      })
      $(document).on('click','#btnshowtemplist',function(e){
        e.preventDefault();
        gettransfertlist();

      })
      function gettransfertlist(){
        var url="{{ route('moneytransfer.gettemptransferlist') }}";
        $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {},
                complete: function () {

                },
                success: function (data) {
                    //console.log(data);
                    $('#body_divtransferlist').empty().html(data);
                    $('.list_partnername').select2({templateResult: formatOption1});
                    var table = document.getElementById("tbl_tranferlist");
                    var tbodyRowCount = table.tBodies[0].rows.length;
                    if(tbodyRowCount>0){
                      $('.list_amount').toArray().forEach(function(field){
                        new Cleave(field, {
                                numeral: true,
                                numeralPositiveOnly: true,
                                numeralThousandsGroupStyle: 'thousand'
                            });
                        })
                        $('.list_cuscharge').toArray().forEach(function(field){
                            new Cleave(field, {
                                numeral: true,
                                numeralPositiveOnly: true,
                                numeralThousandsGroupStyle: 'thousand'
                            });
                        })
                        $('.list_fee').toArray().forEach(function(field){
                            new Cleave(field, {
                                numeral: true,
                                numeralThousandsGroupStyle: 'thousand'
                            });
                        })
                      $('#divtransferlist').css('display','inline');
                      $('#hasmultitransfer').val(1);
                    }else{
                      $('#divtransferlist').css('display','none');
                      $('#hasmultitransfer').val(0);
                      toastr.success("Empty Transfer Temp List");
                    }
                    window.scrollTo(0, document.body.scrollHeight);
                },
                error: function () {
                    alert('Read Error.')
                }
            })
      }
      $(document).on('change','#ckwater',function(e){
         cutwater(0);
      })
      $(document).on('change','#ckwater2',function(e){
         cutwater2(0);
      })
      function cutwater(isamtkeyup)
      {
          if(isamtkeyup!=1){
              var ck = document.getElementById("ckwater").checked;
              var amt=$('#amount').attr('title').replace(/,/g, '');
              var cuscharge=$('#cuscharge').val().replace(/,/g, '');
              if(ck==true){
                  var cur=$('#selcur option:selected').text();
                  var cur1=$('#selcur1 option:selected').text();
                  if(cur==cur1){
                      amt=amt-cuscharge;
                  }
                  $('#amount').val(formatNumber(amt));
              }else{
                  amt=$('#amount').attr('title').replace(/,/g, '');
                  $('#amount').val(formatNumber(amt));
              }
          }
          totalcash();
      }
      function totalcash()
      {
          var totalcash=0;
          var amt=$('#amount').val().replace(/,/g, '');
          var cur=$('#selcur option:selected').text();
          var cuscharge=$('#cuscharge').val().replace(/,/g, '');
          var cur1=$('#selcur1 option:selected').text();
          if(cur==cur1){
              totalcash=parseFloat(amt)+parseFloat(cuscharge);
          }else{
              totalcash=amt;
          }
          $('#totalcash').val(formatNumber(parseFloat(totalcash)));
      }
      $(document).on('keyup','.bankamt',function(e){
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          const C = e.key;
          if (C === "Backspace") return;
          if(isNumber(C)==false){
              getcurrencybykey1(C,$('.bankcur').eq(rowind-1));
          }
      })
      $(document).on('click','#btnbankpayment',function(e){
          e.preventDefault();
          $('#divbankpayment').css('display','block');
          $('#hasbankpayment').val(1);
          addrow();
          $('.bankamt').toArray().forEach(function(field){
              new Cleave(field, {
                  numeral: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
          })
          window.scrollTo(0, document.body.scrollHeight);
      })

      $(document).on('click','#btnexchange',function(e){
          e.preventDefault();

          var hasmultitransfer=$('#hasmultitransfer').val();
          if(hasmultitransfer==1){
            var amt=0;
            var amount=0;
            var curid='';
            var curname='';
            $('.list_amount').each(function(i,e){
                  amt=$(this).val().replace(/,/g, '');
                  curid=$('.list_curid').eq(i).val();
                  curname=$('.list_currency').eq(i).val();
                  amount+=parseFloat(Math.abs(amt));
              })
              var sale=0;
              sale=amount;
              var curname=curname;
          }else{
            var sale=0;
            var curid=$('#selcur').val();
            var curid1=$('#selcur1').val();
            if(curid==curid1){
                sale=parseFloat($('#amount').val().replace(/,/g, ''))+parseFloat($('#cuscharge').val().replace(/,/g, ''));
            }else{
                sale=$('#amount').val().replace(/,/g, '');
            }
            var curname=$('#selcur option:selected').text();

          }
          $('#divexchangecard').css('display','block');
          //$('#divexchangelist').css('display','block');
          $('#hasexchange').val(1);

          $('#txtbuy').val(formatNumber(sale));
          $('#lblrate').attr('title',1);
          getcurrencybyid(curid,'#lblbuy');
          //getcurrencybykey('d','#lblsale')
          if(curname!='USD'){
              getcurrencybykey('d','#lblsale')
          }else{
              getcurrencybykey('r','#lblsale')
          }
          //getrate();
          $('#txtbuy').css('color','red');
          $('#txtsale').css('color','blue');
          $('#txtsign').val('-');
          $('#txtsign1').val('+');
          window.scrollTo(0, document.body.scrollHeight);


      })
      $(document).on('keydown','.tdcanenter',function(e){
       if (e.keyCode == 13) {
            var $this = $(this),
            index = $this.closest('td').index();
            $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
            e.preventDefault();
        }
      })

      $(document).on('keydown', '.canenter', function (e) {
          if (e.keyCode == 13) {
              var id = $(this).attr("id");
              if (id == 'txtbuy') {
                  $('#txtrate').focus();
              } else if(id == 'txtrate'){

              } else if (id == 'amount'){
                  if($('#mekun').val()==1){
                      $('#cuscharge').focus();
                      $('#cuscharge').select();
                  }else{
                      $('#fee').focus();
                      $('#fee').select();
                  }
              }else if (id == 'cuscharge') {
                  $('#fee').focus();
                  $('#fee').select();
              }else if (id == 'fee') {
                  $('#btnsavetransfer').focus();
              }else if(id=='rectel'){
                  $('#recname').focus();
              }else if(id=='recname'){
                  $('#sendertel').focus();
              }else if(id=='sendertel'){
                  $('#sendername').focus();
              }else if(id=='sendername'){
                  $('#amount').focus();
              }else if(id=='fee2'){
                  $('#btnsavetransfer').focus();
              }else if(id=='amountcontinue'){
                  $('#cuscharge2').focus();
              }else if(id=='cuscharge2'){
                  $('#fee2').focus();
              }
              e.preventDefault();
          }
      })
      $('#btnclearlist').click(function(e){
          e.preventDefault();
          var q = confirm("Do you want to clear exchange list?");
              if (q) {
                var ref_group_id=$('#ref_group_id').val();
                var url="{{ route('usercapital.clear_multiexchangelist') }}";
                $.post(url,{ref_group_id:ref_group_id},function(data){
                    getmultiexchangelist();

                })
              }
      })

      $('#btnnew').click(function(e){
          e.preventDefault();
          location.reload();
      })
      $(document).on('click','#btnaddlist',function(e){
          e.preventDefault();
          $('#divexchangelist').css('display','block');
          var formdata = new FormData;
          if($('#txtsign').val()=='+'){
              formdata.append("buy",$('#txtbuy').val());
              formdata.append("curbuy",$('#lblbuy').val());
              formdata.append("sale",$('#txtsale').val());
              formdata.append("cursale",$('#lblsale').val());
              formdata.append("buyinfo",$('#lblbuy').attr('title'));
              formdata.append("saleinfo",$('#lblsale').attr('title'));

          }else{
              formdata.append("buy",$('#txtsale').val());
              formdata.append("curbuy",$('#lblsale').val());
              formdata.append("sale",$('#txtbuy').val());
              formdata.append("cursale",$('#lblbuy').val());
              formdata.append("buyinfo",$('#lblsale').attr('title'));
              formdata.append("saleinfo",$('#lblbuy').attr('title'));
          }
          formdata.append("rateinfo",$('#txtrate').attr('title'));
          formdata.append('rate',$('#txtrate').val());
          formdata.append('drate',$('#lblrate').attr('title'));
          formdata.append('dd',$('#invdate').val());

          $.ajax({
              async: true,
              type: 'POST',
              contentType: false,
              processData: false,
              url: "{{ route('saveaddlist') }}",
              data: formdata,
              success: function (data) {
                  $('#hasexchange').val(2);
                 //console.log(data)
                 //$('#frmexchange').trigger('reset');
                  $('#lblbuy').attr('title','');
                  $('#lblsale').attr('title','');
                  $('#lblrate').attr('title','');
                  $('#txtrate').attr('title','');
                  $('#txtbuy').val('');
                  $('#txtsale').val('');
                  $('#txtrate').val('');
                  $('#lblbuy').val('');
                  $('#lblsale').val('');
                  $('#txtbuy').focus();
                  getmultiexchangelist();

              },
              error: function () {
                  alert('Save Error.')
              }

          })
          //window.scrollTo(0, document.body.scrollHeight);
      })
      $(document).on('click','#btnaddrow',function(e){
          e.preventDefault();
          addrow();
          $('.bankamt').toArray().forEach(function(field){
              new Cleave(field, {
                  numeral: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
          })
          window.scrollTo(0, document.body.scrollHeight);
      })
      $(document).on('click','.remove',function(e){
          e.preventDefault();
          //$(this).parent().parent().remove();
          $(this).closest("tr").remove();
          ResetNo();
      });
      function ResetNo(){
          $('.no').each(function(i,e){
              $(this).text(i+1);
          })
      }
      $(document).on('click','.btndelmxlist',function(e){
          e.preventDefault();
          var q = confirm("Do you want to delete this exchange record?");
              if (q) {
                var id=$(this).data('id');
                var mapcode=$(this).data('mapcode');
                var url="{{ route('usercapital.delete_multiexchangelist') }}";
                $.post(url,{id:id,mapcode:mapcode},function(data){
                    getmultiexchangelist();
                })
              }
      })


      $('#btnsavelist').click(function(e){
          e.preventDefault();
          var frmdata=$('#frmmultiexchange').serializeArray();
          frmdata.push({name:'dd',value:$('#invdate').val()});
          var url="{{ route('savemultiexchanges') }}"
          $.post(url,frmdata,function(data){
              console.log(data)
          if(data.success){
                  toastr.success(data.success);
                  getmultiexchangelist();
                  prints(data.mapid);
          }else{
              toastr.error(data.error);

          }
          })
      })

      function printtransfers(tr_id,hasexchange,hasbankpayment){
          var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/print?tr_id='+tr_id  + '&hasexchange='+hasexchange+ '&hasbankpayment='+hasbankpayment, '_blank');
          redirectWindow.location;
      }
      $(document).on('click','#btnaddtransferlist',function(e){
        e.preventDefault();
        var countselectoption=$('#seluseraffect1 option').length;
        if(countselectoption>1){
          if($('#seluseraffect1').val()==''){
            alert('please select user affect')
            return;
          }
        }
        $('body').addClass("wait");
        var formdata=new FormData(frmtransfer);
        var url="{{ route('moneytransfer.savetotemplist') }}";
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
                  //debugger;
                  if($.isEmptyObject(data.error)){
                    gettransfertlist();
                    $('#amount').val('');
                    $('#cuscharge').val('0');
                    $('#totalcash').val('');
                    $('#fee').val('0');
                    $('#amount').focus();
                    $('body').removeClass("wait");
                      //location.reload();
                  }else{
                      $('body').removeClass("wait");
                      alert(data.error)
                  }
              },
              error: function () {
                  alert('Save Error.')
              }
          })
      })

      $(document).on('click','#btnsavetransfer,#btnsavetransferprint',function(e){
          e.preventDefault();
          //debugger;
          var t_amount1=$('#amount').val().replace(/,/g, '');
          var t_interest1=$('#interest1').val().replace(/,/g, '');
          if(t_amount1==""){
            t_amount1=0;
          }
          if(t_interest1>t_amount1){
            alert('You can not add interest with amount zero.');
            return;
          }
        //   if($('#seluseraffect1 option').length>1){
        //     if($('#seluseraffect1').val()==''){
        //       alert('please select user affect')
        //       return;
        //     }
        //   }
        //   if($('#seluseraffect2 option').length>1){
        //     if($('#seluseraffect2').val()==''){
        //       alert('please select user affect2')
        //       return;
        //     }
        //   }
          var trancode1=$('#trancode1').val();
          if(trancode1==-4){
            var t_amount2=$('#amountcontinue').val().replace(/,/g, '');
            var t_interest2=$('#interest2').val().replace(/,/g, '');
            if(t_amount2==""){
              t_amount2=0;
            }
            if(t_interest2>t_amount2){
              alert('You can not add interest with amount zero.');
              return;
            }
          }
          $('body').addClass("wait");
          //var cklockdata = document.getElementById("cklockdata").checked;
          var transfer_sign=0;
          var idclick=$(this).attr('id');
          var isprint=0;
          if(idclick=='btnsavetransferprint'){
              isprint=1;
          }

          var hasmultitransfer=$('#hasmultitransfer').val();
          if(hasmultitransfer==0){
            transfer_sign=$('#mekun').val();
            if(transfer_sign==0){
                $('body').removeClass("wait");
                alert('Save without title not allow');
                return;
            }
            if(transfer_sign==1){
                var cuscharge=$('#cuscharge').val();
                var curcharge=$('#selcur1').val();
                if(cuscharge=='' || curcharge==''){
                    $('body').removeClass("wait");
                    alert('Please input customer charge')
                    return;
                }
            }
          }else{
            transfer_sign=1;
          }
          //var formdata=$('#frmtransfer').serializeArray();
          var formdata=new FormData(frmtransfer);
          var hasexchange=$('#hasexchange').val();
          var hasbankpayment=$('#hasbankpayment').val();
          var sp = document.querySelector("#selpartner");
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');

          var sp1 = document.querySelector("#selcustomer");
          var customertype1=sp.options[sp1.selectedIndex].getAttribute('customertype');
          var sp2 = document.querySelector("#selpartner2");
          var customertype2=sp.options[sp2.selectedIndex].getAttribute('customertype');

          var partner1=$('#selpartner option:selected').text();
          var partner2=$('#selpartner2 option:selected').text();
          var foundcontinue=0;
            if($('#divcontinue').css('display') != 'none'){
                foundcontinue=1;
            }
          formdata.append("customertype", customertype);
          formdata.append("customertype1", customertype1);
          formdata.append("customertype2", customertype2);
          formdata.append("partner1", partner1);
          formdata.append("partner2", partner2);
          formdata.append("foundcontinue", foundcontinue);
          //append exchange
          if(hasexchange==1){
              //var cashreceive=$('#txtcashreceive').val() + $('#lblcashin').val();
              // var cashreturn=$('#txtcashreturn').val();
              var m1 = $('#lblbuy').attr('title').split(";");
              var m2 = $('#lblsale').attr('title').split(";");
              var buyinfo='';
              var saleinfo='';
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
              var buy='0';
              var sale='0';
              var curbuy='';
              var cursale='';
              var receipt2='0';

              if ($('#txtsign').val() == '+') {
                  mekun = 1;
                  buy=$('#txtbuy').val();
                  sale=$('#txtsale').val();
                  curbuy=$('#lblbuy').val();
                  cursale=$('#lblsale').val();
                  // if($('#txtcashreceive').val()==''){
                  //     cashreceive=$('#txtbuy').val() + curbuy;
                  //     cashreturn=$('#txtsale').val() + cursale;
                  // }
                  buyinfo=$('#lblbuy').attr('title');
                  saleinfo=$('#lblsale').attr('title');
              } else {
                  mekun = -1;
                  buy=$('#txtsale').val();
                  sale=$('#txtbuy').val();
                  curbuy=$('#lblsale').val();
                  cursale=$('#lblbuy').val();
                  // if($('#txtcashreceive').val()==''){
                  //     cashreceive=$('#txtsale').val() + cursale;
                  //     cashreturn=$('#txtbuy').val()+curbuy;
                  // }
                  saleinfo=$('#lblbuy').attr('title');
                  buyinfo=$('#lblsale').attr('title');
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
                  receipt2='1';
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
                  //url = "{{ route('saveexchangeproduct') }}"
              }
              formdata.append("buyinfo", buyinfo);
              formdata.append("saleinfo", saleinfo);

              formdata.append("product_id", pid);
              formdata.append("product_cur", pcur);
              formdata.append("exchange_amount", luy);
              formdata.append("maincur", mcur);
              formdata.append("product", product);
              formdata.append("exchange_rate", $('#txtrate').val());
              formdata.append("origin_rate", $('#lblrate').attr('title'));

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
              formdata.append("buy",buy);
              formdata.append("sale", sale);
              formdata.append("curbuy", curbuy);
              formdata.append("cursale", cursale);

          }

          var url="{{ route('moneytransfer.store') }}"
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
                  //debugger;
                  if($.isEmptyObject(data.error)){
                      if(isprint==1){
                          printtransfers(data.id,hasexchange,hasbankpayment);
                      }else{
                        //alert("Update Completed")
                      }
                      $('body').removeClass("wait");
                      window.close();
                  }else{
                      $('body').removeClass("wait");
                      alert(data.error)
                  }
              },
              error: function () {
                  alert('Save Error.')
              }

          })
      })
    function resetform()
    {
      $('#divsearchamount').css('display','none');
      $("#ckwater").prop("checked", false);
      $('#divcontinue').css('display','none');
      $('#divexchangecard').css('display','none');
      $('#divexchangelist').css('display','none');
      $('#divbankpayment').css('display','none');
      $('#hasexchange').val(0);
      $('#hasbankpayment').val(0);
      $('#selpartner').val('');
      $('#selpartner2').val('');
      $('#selcustomer').val('');
      $('#selpartner').trigger('change');
      $('#selpartner2').trigger('change');
      $('#selcustomer').trigger('change');
      $('#selpartner').focus();
      $("#tbl_bankpayment tr").remove();
    }
    $('#selpartner').on('select2:close', function (e)
      {
          $('#rectel').focus();
      });
      $(document).on('keyup', '#txtbuy', function (e) {
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
          }else if(C==="+"){
              e.preventDefault();
              $('#txtbuy').css('color','blue');
              $('#txtsale').css('color','red');
              $('#txtsign').val('+');
              $('#txtsign1').val('-');
              getrate();


              return;
          }else if(C==="-"){
              e.preventDefault();
              $('#txtbuy').css('color','red');
              $('#txtsale').css('color','blue');
              $('#txtsign').val('-');
              $('#txtsign1').val('+');
              getrate();

              return;
          }
          if(isNumber(C)==false){
              getcurrencybykey(C,'#lblbuy')
          }
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
          if(C==="ArrowRight"){
                  $('#btnaddlist').click();
                  return;
              }
          if(isNumber(C)==false){
              getcurrencybykey(C,'#lblsale')
          }
      })
      $(document).on('keyup', '#txtcashreceive', function (e) {
          docashin();
      })
      $(document).on('change','.bankid',function(e){
          e.preventDefault();
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();

          var bankname=$('.bankid option:selected').eq(rowind-1).text();
          $('.bankname').eq(rowind-1).val(bankname);
      })
      $(document).on('click', '#btnsave,#btnsaveprint', function (e) {
          e.preventDefault();
          //debugger
          var btnid=$(this).attr('id');

          var cashreceive=$('#txtcashreceive').val() + $('#lblcashin').val();
          var cashreturn=$('#txtcashreturn').val();
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
          var buy='0';
          var sale='0';
          var curbuy='';
          var cursale='';
          var receipt2='0';
          var url = "{{ route('saveexchange') }}";
          if ($('#txtsign').val() == '+') {
              mekun = 1;
              buy=$('#txtbuy').val();
              sale=$('#txtsale').val();
              curbuy=$('#lblbuy').val();
              cursale=$('#lblsale').val();
              if($('#txtcashreceive').val()==''){
                  cashreceive=$('#txtbuy').val() + curbuy;
                  cashreturn=$('#txtsale').val() + cursale;
              }

          } else {
              mekun = -1;
              buy=$('#txtsale').val();
              sale=$('#txtbuy').val();
              curbuy=$('#lblsale').val();
              cursale=$('#lblbuy').val();
              if($('#txtcashreceive').val()==''){
                  cashreceive=$('#txtsale').val() + cursale;
                  cashreturn=$('#txtbuy').val()+curbuy;
              }
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
              receipt2='1';
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
              url = "{{ route('saveexchangeproduct') }}"
          }
          //debugger
          var today = new Date();
          // var d = $('#exchangedate').val().split("-");
          // var Dd = moment(new Date(d[2] + '-' + d[1] + '-' + d[0])).format("YYYY-MMM-DD")
          var time = ("0" + today.getHours()).slice(-2) + ":" + ("0" + today.getMinutes()).slice(-2) + ":" + ("0" + today.getSeconds()).slice(-2);
          var dd=$('#invdate').val();
          var formdata = new FormData;
          formdata.append("currency_id", pid);
          formdata.append("pcur", pcur);
          formdata.append("amount", luy);
          formdata.append("maincur", mcur);
          formdata.append("product", product);
          formdata.append("rate", $('#txtrate').val());
          formdata.append("drate", $('#lblrate').attr('title'));

          formdata.append("dd", dd);
          formdata.append("tt", time);
          formdata.append("cashreceive",cashreceive);
          formdata.append("cashreturn", cashreturn);


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
          formdata.append("buy",buy);
          formdata.append("sale", sale);
          formdata.append("curbuy", curbuy);
          formdata.append("cursale", cursale);
          $.ajax({
              async: true,
              type: 'POST',
              contentType: false,
              processData: false,
              url: url,
              data: formdata,
              success: function (data) {
                 //console.log(data)
                 //alert(data.id)
                 if(receipt2==1){
                  if(btnid=='btnsaveprint'){
                      prints(data.id);
                  }
                 }else{
                  if(btnid=='btnsaveprint'){
                      prints(data.id);
                  }
                 }

                  $('#frmexchange').trigger('reset');
                  $('#lblbuy').attr('title','');
                  $('#lblsale').attr('title','');
                  $('#txtrate').attr('title','');
                  $('#txtbuy').focus();
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
      //end document
  })

  function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    function getcurrencybykey1(key,el)
        {
            var url="{{ route('getcurrencybykey') }}";
            $.get(url,{key:key},function(data){
                //console.log(data)
                    if(data['c']!=null){
                        $(el).val(data['c']['id']);
                        //$(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                    }
            })
        }
    function getcurrencybykey(key,el)
    {
        var url="{{ route('getcurrencybykey') }}";
        $.get(url,{key:key},function(data){
            //console.log(data)

                if(data['c']!=null){

                    $(el).val(data['c']['shortcut']);
                    $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                    getrate();
                }
        })
    }
    function getcurrencybyid(key,el)
    {
        var url="{{ route('getcurrencybyid') }}";
        $.get(url,{key:key},function(data){

            //console.log(data)

                if(data['c']!=null){

                    $(el).val(data['c']['shortcut']);
                    $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                    getrate();
                }
        })
    }
    function runproductrate()
    {
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
            dolabelcico();
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

            $('#lblrate').attr('title',$('#txtrate').val());
            calcuexchange();
            dolabelcico();
        }
        function dolabelcico() {

            if ($('#txtsign').val() == '+') {
                $('#lblcashin').val($('#lblbuy').val());
            } else {
                $('#lblcashin').val($('#lblsale').val());
            }
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
        function calcuexchange() {
            //debugger
            $('#txtcashreceive').val('');
            $('#txtcashreturn').val('');


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

        function docashin() {
            if ($('#txtsign').val() == '+') {
                var luy = parseFloat($('#txtbuy').val().replace(/,/g, ''));
                var cashreturn='';
                var cashin = parseFloat($('#txtcashreceive').val().replace(/,/g, ''));
                if(isNaN(cashin)){
                    cashreturn = $('#txtsale').val() + $('#lblsale').val();
                }else{
                    cashreturn=formatNumber(parseFloat(cashin - luy)) + $('#lblbuy').val();
                    if(cashin-luy==0){
                        cashreturn =$('#txtsale').val() + $('#lblsale').val();
                    }else{
                        cashreturn +="\n" + $('#txtsale').val() + $('#lblsale').val();
                    }
                }
                $('#txtcashreturn').val(cashreturn);

            } else {
                var luy = parseFloat($('#txtsale').val().replace(/,/g, ''));
                var cashin = parseFloat($('#txtcashreceive').val().replace(/,/g, ''));
                //$('#txtcashreturn').val(formatNumber(parseFloat(cashin - luy)));

                if(isNaN(cashin)){
                    cashreturn = $('#txtbuy').val() + $('#lblbuy').val();
                }else{
                    cashreturn=formatNumber(parseFloat(cashin - luy)) + $('#lblsale').val();
                    if(cashin-luy==0){
                        cashreturn =$('#txtbuy').val() + $('#lblbuy').val();
                    }else{
                        cashreturn +="\n" + $('#txtbuy').val() + $('#lblbuy').val();
                    }
                }
                $('#txtcashreturn').val(cashreturn);

            }
        }
        function getmultiexchangelist(){
            var ref_group_id=$('#ref_group_id').val();
            var url="{{ route('usercapital.getmultiexchangelist') }}";
            $.get(url,{ref_group_id:ref_group_id},function(data){
                $('#multiexchangecard').empty().html(data);
            })
            var table = document.getElementById("tablemultiexchange");
            var tbodyRowCount = table.tBodies[0].rows.length;
            if(tbodyRowCount==0){
              $('#divexchangelist').css('display','none');
              $('#hasexchange').val(1)
            }
            window.scrollTo(0, document.body.scrollHeight);
        }
        function print(id){

            var redirectWindow = window.open('{{ url('/') }}'+'/exchange/print?id='+id, '_blank');
            redirectWindow.location;
        }
        function prints(mapid){

            var redirectWindow = window.open('{{ url('/') }}'+'/exchange/prints?mapid='+mapid, '_blank');
            redirectWindow.location;
        }
        function addrow(){
            //var nn=$('#tbl_bankpayment tr').length+1;
            var table = document.getElementById("tbl_bankpayment");
            var nn=table.tBodies[0].rows.length+1;
            let tst = Math.round(Date.now() / 1000)+nn;
            var row=`<tr>
                        <td style="text-align:center;padding:3px 0px 0px 0px;" class="no kh16">${nn}</td>
                        <td style="width:250px;padding:0px;">
                            <select name="bankid[]" class="form-select bankid" id="bankid${nn}"  style="width:250px;"></select>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control bankname kh16" style="height:47px;" name="bankname[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamt kh16-b" style="text-align:right;height:30px;" name="bankamt[]">
                        </td>
                        <td style="width:100px;padding:0px;">
                            <select name="bankcur[]" class="bankcur kh16-b" id="bankcur${nn}" style="width:100px;height:30px;"></select>
                        </td>

                        <td style="text-align:center;padding:0px;">
                            <a href="#" class="btn btn-danger btn-sm remove" style="border-radius:15px;"><i class="fa fa-minus"></i></a>
                        </td>
                    </tr>`;
                $('#body_bankpayment').append(row);

                //$('.unit option').remove();

                $('#selcur option').clone().appendTo('#bankcur'+nn);
                $('#selbank option').clone().appendTo('#bankid'+nn);
                $('#bankid'+nn).select2();
                //number('.barcode',true);

        }
        const scrollToBottom = (id) => {
        const element = document.getElementById(id);
        element.scrollTop = element.scrollHeight;
        }

        const scrollToTop = (id) => {
        const element = document.getElementById(id);
        element.scrollTop = 0;
        }

        // Require jQuery
        const scrollSmoothToBottom = (id) => {
        const element = $(`#${id}`);
        element.animate({
        scrollTop: element.prop("scrollHeight")
        }, 500);
        }

        // Require jQuery
        const scrollSmoothToTop = (id) => {
        $(`#${id}`).animate({
        scrollTop: 0,
        }, 500);
    }



</script>
