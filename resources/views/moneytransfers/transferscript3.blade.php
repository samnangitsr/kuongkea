<script type="text/javascript">
    //var pathname=window.location.pathname.split("/");

    $('#h1_title').text('អតិថិជន ដាក់ប្រាក់ ដកប្រាក់');

        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-220;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
    $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-220;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
    });
    $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
            return false;
        }else if(event.ctrlKey && event.keyCode==83){
            $('#btnsavetransfer').click();
        // }else if(event.ctrlKey && event.keyCode==49){
        //     $('#btnexchange').click();
        }else if(event.ctrlKey && event.keyCode==66){//ctrl + b
          if(document.getElementById("btnbankpayment").style.display !== "none") {
            $('#btnbankpayment').click();
          }
        // }else if(event.ctrlKey && event.keyCode==50){
        //     $('#btnexchange2').click();
        // }else if(event.ctrlKey && event.keyCode==97){
        //     $('#btnexchange').click();
        }else if(event.ctrlKey && event.keyCode==69){ //ctrl +e
            $('#btnexchange2').click();
        }else if(event.altKey && event.keyCode==69){ //ctrl +e
            $('#btnexchange2').click();
        }else if(event.ctrlKey && event.keyCode==80){ //ctrl +p
            if(document.getElementById("btnsavetransferprint").style.display !== "none") {
                $('#btnsavetransferprint').click();
            }
        }else if(event.ctrlKey && event.keyCode==71){ //ctrl +G
            if(document.getElementById("btncontinue").style.display !== "none") {
                $('#btncontinue').click();
            }
        }
    });
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
    $(document).on('click','#tbl_transferlist td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
    $(document).on('click','.btnclick',function(e){
            //debugger;
            $('.btnclick').removeClass('btnbg');
            $(this).addClass('btnbg');
            document.getElementById('amount').removeAttribute('readonly');

         })
    $(document).on('click','#btntransfer',function(e){
          e.preventDefault();
          $('#cardpartner').css('background-color','blue');
          $('#amtsign').text('+');
          btnclick($(this).text(),1,1);
        // $('#lblpayby').text('ដាក់ចូល');

      })
      $(document).on('click','#btnreceive',function(e){
          e.preventDefault();
          $('#cardpartner').css('background-color','red');
          $('#amtsign').text('-');
          btnclick($(this).text(),-1,-1);
        //   $('#lblpayby').text('ដកពី');
      })
      function btnclick(trname,trcode,mekun)
      {
          $('#tranname').text(trname);
          $('#trancode').val(trcode);
          $('#mekun').val(mekun);
          if($('#id1').val()==''){
                if($('#selpartner').val()!==''){
                    fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#amtsign').text(),1);
                }
                if($('#selpartner2').val()!==''){
                    fillnextbalance('#balance2','#balancenext2',$('#selcur option:selected').text(),$('#amtsign').text(),-1);
                }
            }
          document.getElementById("btnsavetransfer").disabled = false;
          $('#amount').focus();
      }
      $(document).on('click','.btndeltransfer',function(e){
            e.preventDefault();
            var id=$(this).data('id');
              //var ref_num=$(this).data('ref_number');
              //var fromid=ref_num.split('-')[1];

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
                        url: "{{ route('moneytransfer.delete') }}",
                        data: { id:id },
                        success: function (data) {
                            console.log(data);
                            if (data.success === true) {
                                //location.reload();
                                gettransferlist();

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
      $(document).on('click','.btnedit',function(e){
        var id=$(this).data('id');
        var groupid=$(this).data('groupid');
        var url="{{ route('customertransfer.edit') }}";
        $.get(url,{id:id,groupid:groupid},function(data){
            console.log(data)
            //;
            if(data.success){
                $('#id1').val(data['transfers']['id']);
                $('#id2').val(data['transfers']['map_id']);
                $('#selpartner').val(data['transfers']['parrent_id']);
                $('#selpartner').trigger('change');
                $('#selpartner2').val(data['transfers']['from_partner_id']);
                $('#selpartner2').trigger('change');
                $('#amount').val(formatNumber(Math.abs(data['transfers']['amount'])));
                $('#selcur').val(data['transfers']['currency_id']);
                $('#note').val(data['transfers']['note']);
                $('#trancode').val(data['transfers']['trancode']);
                $('#mekun').val(data['transfers']['mekun']);
                $('#tranname').text(data['transfers']['tranname']);
                $('#seluseraffect').val(data['transfers']['user_id']);

                $('#btnsavetransfer').text('កែប្រែ');
                if(data['transfers']['mekun']==1)
                {
                    $('#amtsign').text('+')
                }else{
                    $('#amtsign').text('-')
                }
                $('#cashdrawid').val(data['transfers']['cashdraw_id']);
                // if(data['transfers']['cashdraw_id']>0)
                // {
                //     $('#amount').attr('readonly',true);
                // }
                $(' #btndelete').css('display','table-row');
                document.getElementById("btnsavetransfer").disabled = false;
                document.getElementById("btntransfer").disabled = true;
                document.getElementById("btnreceive").disabled = true;
            }else{

            }
        })
      })
      $(document).on('click','#btnnew',function(e){
        location.reload();
      })
    $(document).on('click','#btndelete',function(e){
                e.preventDefault();
                var id2=$('#id2').val();
                var id1=$('#id1').val();
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
                            url: "{{ route('customertransfer.delete') }}",
                            data: { id1:id1,id2:id2 },
                            success: function (data) {
                                //console.log(data);
                                if (data.success === true) {
                                    resetform1();
                                    gettransferlist();
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

    $(document).bind('keydown', function(e) {
      //prevent shortcut browser
      console.log(e.which)
      // if(e.ctrlKey && (e.which == 49)) {
      //   e.preventDefault();
      //   return false;
      // }
      if(e.ctrlKey && (e.which == 83)) {
        e.preventDefault();
        return false;
      }
      if(e.ctrlKey && (e.which == 80)) {
        e.preventDefault();
        return false;
      }
      if(e.ctrlKey && (e.which == 66)) {
        e.preventDefault();
        return false;
      }
      // if(e.ctrlKey && (e.which == 50)) {
      //   e.preventDefault();
      //   return false;
      // }
      // if(e.ctrlKey && (e.which == 97)) {
      //   e.preventDefault();
      //   return false;
      // }
      if(e.ctrlKey && (e.which == 69)) {
        e.preventDefault();
        return false;
      }
      if(e.ctrlKey && (e.which == 71)) {
        e.preventDefault();
        return false;
      }
      if(e.altKey && (e.which == 69)) {
        e.preventDefault();
        return false;
      }
    });
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

      	// Custom function to format the option text
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
        $('.table-responsive').on('show.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "inherit" );
        });

        $('.table-responsive').on('hide.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "auto" );
        })
        $('#selpartner').select2({templateResult: formatOption});
        $('#selpartner2').select2({templateResult: formatOption});
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
      $('#invdate').datetimepicker("destroy");
      //checkright();
      function checkright()
      {
          var role=$('#txtrole').val();
          if(role!='Admin'){
            $('#invdate').datetimepicker("destroy");
          }
      }
        var cleave = new Cleave('#amount', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
          $(document).on('change','#selpartner',function(e){
            e.preventDefault();
            if($('#id1').val()==''){
                if($(this).val()!==''){
                    getwingbalance($(this).val(),$('#selcur option:selected').text(),'#balance1','#balancenext1',$('#amtsign').text(),1,fillnextbalance);
                }
            }

          })
          $(document).on('change','#selpartner2',function(e){
            e.preventDefault();
            if($('#id1').val()==''){
                if($(this).val()!==''){
                    getwingbalance($(this).val(),$('#selcur option:selected').text(),'#balance2','#balancenext2',$('#amtsign').text(),-1,fillnextbalance);
                }
            }

          })
          $(document).on('change','#amount',function(e){
                e.preventDefault();
                if($('#id1').val()==''){
                    if($('#selpartner').val()!==''){
                        fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#amtsign').text(),1);
                    }
                    if($('#selpartner2').val()!==''){
                        fillnextbalance('#balance2','#balancenext2',$('#selcur option:selected').text(),$('#amtsign').text(),-1);
                    }
                }

            })

          function getwingbalance(cid,cur,elem,elnext,sign,mekun,callback)
          {
            $('body').addClass("wait");
                //$('#wingbalancenext').val('');
                var amt=0;
                var fee=0;
                var total=0;
                var d2=$('#h1_date').text();
                var op='<=';
                var url="{{ route('closelist.summarypartnerlist') }}";

                $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {cid:cid,showdate:d2,op:op},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        $(elem).attr('title',data.usd+';'+data.khr+';'+data.thb);
                        // if(cur=='USD'){
                        //     $(elem).val(formatNumber(-1 * parseFloat(data.usd)) + ' ' + cur);
                        // }else if(cur=='KHR'){
                        //     $(elem).val(formatNumber(-1 * parseFloat(data.khr)) + ' ' + cur);
                        // }else if(cur=='THB'){
                        //     $(elem).val(formatNumber(-1 * parseFloat(data.thb)) + ' ' + cur);
                        // }
                        callback(elem,elnext,cur,sign,mekun);
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
          $(document).on('keydown', '.canenter', function (e) {
          if (e.keyCode == 13) {
              var id = $(this).attr("id");
              if (id == 'amount') {
                  $('#txtrate').focus();
                  if($('#txtrate').val()==''){
                    $('#amount2').val($('#amount').val());
                    $('#selcur2').val($('#selcur').val());
                    $('#selcur2').trigger('change');
                  }
              } else if(id == 'txtrate'){
                $('#amount2').focus();
              } else if (id == 'amount2'){
                  $('#btnsavetransfer').focus();
              }
              e.preventDefault();
          }
      })

        $(document).on('keyup','#amount',function(e){
              const C = e.key;
              if (C === "Backspace"){
                  return;
              }else if(C==="+"){
                e.preventDefault();
                $('#btntransfer').click();
                return;

              }else if(C==="-"){
                e.preventDefault();
                $('#btnreceive').click();
                return;
              }
              if(isNumber(C)==false){
                  getcurrencybykeylocalstorage(C,'#selcur');
                  var cur=$('#selcur option:selected').text();

              }
          })

          $(document).on('change','#selcur',function(e){
            e.preventDefault();
            getcurrencybyidlocalstorage($(this).val(),'#selcur')
            if($('#selpartner').val()!==''){
                fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#amtsign').text());
            }
            if($('#selpartner2').val()!==''){
                fillnextbalance('#balance2','#balancenext2',$('#selcur option:selected').text(),$('#amtsign').text());
            }
        })
        $(document).on('change','#selcur2',function(e){
            e.preventDefault();
            getcurrencybyidlocalstorage($(this).val(),'#selcur2')
        })
          $(document).on('keyup','#amount',function(e){
              const C = e.key;
              if(isNumber(e.key)){
                    //calcuexchange();
                    return;
                }
              if (C === "Backspace"){
                //calcuexchange();
                return;
              }
              if(isNumber(C)==false){
                  getcurrencybykeylocalstorage(C,'#selcur');
              }

          })
          $(document).on('keyup', '#txtrate', function (e) {


          if(isNumber(e.key)){
              calcuexchange();
              return;
          }

          const C = e.key;
          if (C === "Backspace") {
              calcuexchange();
              return;
          }

          if(isNumber(C)==false){

              getcurrencybykeylocalstorage(C,'#selcur2');
          }
      })
      $(document).on('click','#btnsavetransfer',function(e){
        e.preventDefault();
        func_savetransfer(0,$(this),$(this).text());
      })
      $(document).on('click','#btnrefresh',function(e){
        e.preventDefault();
        gettransferlist();
        //countrecordsaved();
      })
      $(document).on('change','#filteruser',function(e){
        e.preventDefault();
        gettransferlist();
        //countrecordsaved();
      })
      function countrecordsaved()
      {
        var d=$('#invdate').val();
        var url="{{ route('moneytransfer.countrecordsaved') }}";
        $.get(url,{d:d},function(data){
          console.log(data)
          $('#precord').text(data.precords + ' Records');
          $('#brecord').text(data.brecords + ' Records');
        })
      }
      function func_savetransfer(isprint,el,btntext)
      {
          $('body').addClass("wait");
          $(el).attr('disabled', true).text("Processing");
          var cklockdata = document.getElementById("cklockdata").checked;
          var formdata=new FormData(frmtransfer);
          var bank=$('#selpartner2 option:selected').text();
          var bankid=$('#selpartner2').val();
          var customer=$('#selpartner option:selected').text();
          var trancode=$('#trancode').val();
          var mekun=$('#mekun').val();
          var tranname=$('#tranname').text();
          var tranname1='';
            if(bankid!=''){
                if(mekun==1){
                    trancode=4;
                    //tranname="បាញ់ចេញ";
                    tranname1='ទទួលប្រាក់';
                }else{
                    trancode=-4;
                    //tranname="បាញ់ចូល";
                    tranname1='ផ្ទេរប្រាក់'
                }
            }else{
                trancode=mekun;
            }


          formdata.append("bank", bank);
          formdata.append("customer", customer);
          formdata.append("tranname1", tranname1);
          formdata.append("trancode_change",trancode);
          formdata.append("tranname",tranname);

          var url="{{ route('customertransfer.store') }}";
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

                  //console.log(data)
                  if($.isEmptyObject(data.error)){
                    if(isprint==1){
                          //printtransfers(data.id,hasexchange,hasbankpayment);
                      }
                      if(cklockdata==true){
                         var rem_partner1=$('#selpartner').val();
                         var rem_partner2=$('#selpartner2').val();
                      }
                      //debugger;


                    //   $('#precord').text(data.partner_records + ' Records');
                    //   $('#brecord').text(data.bank_records + ' Records');

                      gettransferlist();
                      //getusercapital_master($('#loginid').val(),$('#invdate').val());
                      getuseraccount_master(1,1,$('#loginid').val());
                      toastr.success("Save Transfer Successfully");
                       $("#tbl_transferlist tr:last").css("background-color", "pink");
                       $('#tbl_transferlist tr:last td:nth-child(2) input').focus();
                       $(el).removeAttr('disabled').html(btntext);

                      if($('#id1').val()==''){
                          resetform();
                      }else{
                        resetform1();
                      }
                      if(cklockdata==true){
                            $('#selpartner').val(rem_partner1);
                            $('#selpartner').trigger('change');
                            $('#selpartner').select2("close");

                            $('#selpartner2').val(rem_partner2);
                            $('#selpartner2').trigger('change');
                            $('#selpartner2').select2("close");

                            $('#cklockdata').prop('checked',true);
                            $('#amount').focus();
                        }
                        $('body').removeClass("wait");
                      //location.reload();
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

    })//end document ready
    function fillnextbalance(elbal,elnext,cur,sign,mekun)
    {
        //debugger;
        var amt1=$('#amount').val().replace(/,/g,'');
        //var amt2=$('#amount2').val().replace(/,/g,'');
        var i=0;
        var baltitle=$(elbal).attr('title');
        var balusd=baltitle.split(";")[0];
        var balkhr=baltitle.split(";")[1];
        var balthb=baltitle.split(";")[2];
        var balnext=0;
        var bal=0;
        var cur1='';
        if(sign=='-'){
            if(cur=='USD'){
                balnext=-1 * (parseFloat(balusd)- parseFloat(mekun * amt1));
                bal=-1 * parseFloat(balusd);
                cur1=' USD';
            }else if(cur=='KHR'){
                balnext=-1 * (parseFloat(balkhr)- parseFloat(mekun * amt1));
                bal=-1 * parseFloat(balkhr);
                cur1=' KHR';
            }else if(cur=='THB'){
                balnext=-1 * (parseFloat(balthb)- parseFloat(mekun * amt1));
                bal=-1 * parseFloat(balthb);
                cur1=' THB';
            }
        }else{
            if(cur=='USD'){
                balnext=-1 * (parseFloat(balusd)+ parseFloat(mekun * amt1));
                bal=-1 * parseFloat(balusd);
                cur1=' USD';
            }else if(cur=='KHR'){
                balnext=-1 * (parseFloat(balkhr)+ parseFloat(mekun * amt1));
                bal=-1 * parseFloat(balkhr);
                cur1=' KHR';
            }else if(cur=='THB'){
                balnext=-1 * (parseFloat(balthb)+ parseFloat(mekun * amt1));
                bal=-1 * parseFloat(balthb);
                cur1=' THB';
            }
        }

        $(elnext).val(formatNumber(balnext) + cur1);
        $(elbal).val(formatNumber(bal) + cur1);
        if(bal>0){
            $(elbal).css('color','blue');
        }else{
            $(elbal).css('color','red');
        }
        if(balnext>0){
            $(elnext).css('color','blue');
        }else{
            $(elnext).css('color','red');
        }
    }
    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    function gettransferlist()
      {
        $('body').addClass("wait");
        var d=$('#invdate').val();
        var user_id=$('#filteruser').val();
        var url="{{ route('moneytransfer.gettransferlist') }}";
        $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {d:d,location_id:4,user_id:user_id},

                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#body_transaction').empty().html(data);
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
      }
      function resetform()
      {
        //$('#frmtransfer').trigger('reset');
        $('#selpartner').val('');
        $('#selpartner2').val('');
        $('#selpartner').trigger('change');
        $('#selpartner2').trigger('change');
        $('#amount').val('');
        $('#note').val('');
        $('#balance1').val('');
        $('#balancenext1').val('');
        $('#balance2').val('');
        $('#balancenext2').val('');
        $('#balance1').attr('title','');
        $('#balance2').attr('title','');

        // $('#invdate').datetimepicker({
        //     timepicker:false,
        //     datepicker:true,
        //     value:new Date(),
        //     format:'d-m-Y',
        //     autoclose:true,
        //     todayBtn:true,
        //     startDate:new Date(),

        // });
        // $('#invdate').datetimepicker("destroy");
        // $('#btndelete').css('display','none');
        // document.getElementById("btnsavetransfer").disabled = true;

      }
      function resetform1()
      {
        $('#frmtransfer').trigger('reset');
        $('#selpartner').trigger('change');
        $('#selpartner2').trigger('change');
        $('#amount').val('');
        $('#note').val('');
        $('#invdate').datetimepicker({
            timepicker:false,
            datepicker:true,
            value:new Date(),
            format:'d-m-Y',
            autoclose:true,
            todayBtn:true,
            startDate:new Date(),

        });
        $('#invdate').datetimepicker("destroy");
        $('#btndelete').css('display','none');
        document.getElementById("btnsavetransfer").disabled = true;
        document.getElementById("btntransfer").disabled = false;
        document.getElementById("btnreceive").disabled = false;

        $('#btnsavetransfer').text('រក្សាទុក');
        $('#amtsign').text('');

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

            //getrate();
        }
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
            //getrate();
        }
        })
    }
    function getrate() {

        $('#txtrate').attr('title', '');
        var m = $('#selcur').attr('title').split(";");
        var p = $('#selcur2').attr('title').split(";");
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
            $('#txtrate').val(formatNumber(parseFloat(p[2])));//get rate p sale
        } else {
            $('#txtrate').val(formatNumber(parseFloat(m[1])));//get rate m buy
        }


        $('#txtrate').attr('title',$('#txtrate').val());
        calcuexchange();

    }
    function runproductrate() {
          //debugger
          var url="{{ route('getproductrate') }}";
          var buycur = $('#selcur option:selected').text();
          var salecur = $('#selcur2 option:selected').text();
          var curname = '';

            curname = buycur + '-' + salecur;

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

          $('#txtrate').attr('title',$('#txtrate').val());

      }
    function calcuexchangeproduct() {
          //debugger;
        var luy = $('#amount').val().replace(/,/g, '');
        var r = $('#txtrate').val().replace(/,/g, '');
        var rs = $('#txtrate').attr('title').split(";");

        if (rs[2] == '*') {
            $('#amount2').val(formatNumber(parseFloat(luy * r).toFixed(2)));
        } else {
            $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
        }

      }
      function calcuexchange() {
          // debugger
          var luy = $('#amount').val().replace(/,/g, '');
          var r = $('#txtrate').val().replace(/,/g, '');
          var m1 = $('#selcur').attr('title').split(";");
          var m2 = $('#selcur2').attr('title').split(";");
          if (m1[4] == '1') { //if maincur=true
              if (m2[3] == '/') {//if operator=/
                  $('#amount2').val(formatNumber(parseFloat(luy * r).toFixed(2)));
              } else {
                  $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
              }
          } else {
              if (m2[4] == '1') {
                  if (m1[3] == '/') {
                      $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                  } else {
                      $('#amount2').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                  }
              } else {
                  calcuexchangeproduct();
              }
          }
      }
</script>
