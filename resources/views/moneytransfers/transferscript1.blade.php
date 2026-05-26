<script type="text/javascript">
    //var pathname=window.location.pathname.split("/");

    $('#h1_title').text('បាញ់ឆ្លងធនាគា');
    var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-170;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
    $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-170;

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
    $(document).on('click','.tbl_transferlist td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
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
        $('#selpartner').select2({
            //templateResult: formatOption

        });
        $('#selpartner2').select2({
            //templateResult: formatOption
        });
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
          var cleave = new Cleave('#amount2', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
          var cleave = new Cleave('#txtrate', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
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
      $(document).on('change','#amount',function(e){
        e.preventDefault();
        if($('#selpartner').val()!==''){
            fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),'-',1,$('#amount').val());
        }
        if($('#selpartner2').val()!==''){
            fillnextbalance('#balance2','#balancenext2',$('#selcur2 option:selected').text(),'+',-1,$('#amount2').val());
        }

      })

        $(document).on('keyup','#amount',function(e){
              const C = e.key;
              if (C === "Backspace"){
                  return;
              }
              if(isNumber(C)==false){
                  getcurrencybykeylocalstorage(C,'#selcur');
                  var cur=$('#selcur option:selected').text();

              }
          })
          $(document).on('keyup','#amount2',function(e){
              const C = e.key;
              if (C === "Backspace"){
                  return;
              }
              if(isNumber(C)==false){
                  getcurrencybykeylocalstorage(C,'#selcur2');
              }

          })
          $(document).on('change','#selpartner',function(e){
            e.preventDefault();
            if($(this).val()!==''){
                getwingbalance($(this).val(),$('#selcur option:selected').text(),'#balance1','#balancenext1','-',1,$('#amount').val(),fillnextbalance);
            }

          })
          $(document).on('change','#selpartner2',function(e){
            e.preventDefault();
            if($(this).val()!==''){
                getwingbalance($(this).val(),$('#selcur2 option:selected').text(),'#balance2','#balancenext2','+',-1,$('#amount2').val(),fillnextbalance);
            }

          })
          function fillnextbalance(elbal,elnext,cur,sign,mekun,amount)
            {
                var amt=amount.replace(/,/g,'');
                var i=0;
                var baltitle=$(elbal).attr('title');
                var balusd=baltitle.split(";")[0];
                var balkhr=baltitle.split(";")[1];
                var balthb=baltitle.split(";")[2];
                var balnext=0;
                var bal=0;
                var cur1='';

                // if(sign=='-'){
                //     if(cur=='USD'){
                //         balnext=-1 * (parseFloat(balusd)+ parseFloat(mekun * amt1));
                //         bal=-1 * parseFloat(balusd);
                //         cur1=' USD';
                //     }else if(cur=='KHR'){
                //         balnext=-1 * (parseFloat(balkhr)+ parseFloat(mekun * amt1));
                //         bal=-1 * parseFloat(balkhr);
                //         cur1=' KHR';
                //     }else if(cur=='THB'){
                //         balnext=-1 * (parseFloat(balthb)+ parseFloat(mekun * amt1));
                //         bal=-1 * parseFloat(balthb);
                //         cur1=' THB';
                //     }
                // }else{
                //     if(cur=='USD'){
                //         balnext=-1 * (parseFloat(balusd)+ parseFloat(mekun * amt1));
                //         bal=-1 * parseFloat(balusd);
                //         cur1=' USD';
                //     }else if(cur=='KHR'){
                //         balnext=-1 * (parseFloat(balkhr)+ parseFloat(mekun * amt1));
                //         bal=-1 * parseFloat(balkhr);
                //         cur1=' KHR';
                //     }else if(cur=='THB'){
                //         balnext=-1 * (parseFloat(balthb)+ parseFloat(mekun * amt1));
                //         bal=-1 * parseFloat(balthb);
                //         cur1=' THB';
                //     }
                // }
                if(cur=='USD'){
                    balnext=-1 * (parseFloat(balusd)+ parseFloat(mekun * amt));
                    bal=-1 * parseFloat(balusd);
                    cur1=' USD';
                }else if(cur=='KHR'){
                    balnext=-1 * (parseFloat(balkhr)+ parseFloat(mekun * amt));
                    bal=-1 * parseFloat(balkhr);
                    cur1=' KHR';
                }else if(cur=='THB'){
                    balnext=-1 * (parseFloat(balthb)+ parseFloat(mekun * amt));
                    bal=-1 * parseFloat(balthb);
                    cur1=' THB';
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
          function getwingbalance(cid,cur,elem,elnext,sign,mekun,amount,callback)
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
                        //     $(elem).val(formatNumber(Math.abs(data.usd)) + ' ' + cur);
                        // }else if(cur=='KHR'){
                        //     $(elem).val(formatNumber(Math.abs(data.khr)) + ' ' + cur);
                        // }else if(cur=='THB'){
                        //     $(elem).val(formatNumber(Math.abs(data.thb)) + ' ' + cur);
                        // }
                        callback(elem,elnext,cur,sign,mekun,amount);
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
          $(document).on('change','#selcur',function(e){
            e.preventDefault();
            getcurrencybyidlocalstorage($(this).val(),'#selcur')
            if($('#selpartner').val()!==''){
                fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),'-',1,$('#amount').val());
            }
            if($('#selpartner2').val()!==''){
                fillnextbalance('#balance2','#balancenext2',$('#selcur2 option:selected').text(),'+',-1,$('#amount2').val());
            }
        })
        $(document).on('change','#selcur2',function(e){
            e.preventDefault();
            getcurrencybyidlocalstorage($(this).val(),'#selcur2')
            if($('#selpartner2').val()!==''){
                fillnextbalance('#balance2','#balancenext2',$('#selcur2 option:selected').text(),'+',-1,$('#amount2').val());
            }
        })
          $(document).on('keyup','#amount',function(e){
              const C = e.key;
              if(isNumber(e.key)){
                    calcuexchange();
                    return;
                }
              if (C === "Backspace"){
                calcuexchange();
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
        var buttontext=$(this).text();
        $(this).attr('disabled', true).text("Processing");
        func_savetransfer(0,$(this),buttontext);
      })
      $(document).on('click','#btnrefresh',function(e){
        e.preventDefault();
        gettransferlist();
        //countrecordsaved();
        $('#selpartner').trigger('change');
        $('#selpartner2').trigger('change');
      })
      $(document).on('change','#filteruser',function(e){
        e.preventDefault();
        gettransferlist();

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
      function func_savetransfer(isprint,el,buttontext)
      {
          $('body').addClass("wait");
          var cklockdata = document.getElementById("cklockdata").checked;
          var formdata=new FormData(frmtransfer);
          var sender=$('#selpartner option:selected').text();
          var receiver=$('#selpartner2 option:selected').text();
          var frompartner_id=$('#selpartner').val();
          var topartner_id=$('#selpartner2').val();
          formdata.append("sendername", sender);
          formdata.append("recname", receiver);
          formdata.append("frompartner_id", frompartner_id);
          formdata.append("topartner_id", topartner_id);
          var url="{{ route('banktransfer.store') }}";
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
                          //printtransfers(data.id,hasexchange,hasbankpayment);
                      }
                      //$('#frmtransfer').trigger('reset');
                      $('#amount').val('');
                      $('#txtrate').val('');
                      $('#amount2').val('');
                    //   $('#selcur').attr('title','');
                    //   $('#selcur2').attr('title','');
                      $('#selpartner').trigger('change');
                      $('#selpartner2').trigger('change');

                    //   $('#precord').text(data.partner_records + ' Records');
                    //   $('#brecord').text(data.bank_records + ' Records');
                    //   if(cklockdata==true){
                    //      var rem_partner1=$('#selpartner').val();
                    //      var rem_partner2=$('#selpartner2').val();
                    //   }

                      $('#invdate').datetimepicker({
                          timepicker:false,
                          datepicker:true,
                          value:new Date(),
                          format:'d-m-Y',
                          autoclose:true,
                          todayBtn:true,
                          startDate:new Date(),

                      });

                      if(cklockdata==true){

                        $('#selpartner').val(rem_partner1);
                        $('#selpartner').trigger('change');
                        $('#selpartner').select2("close");

                        $('#selpartner2').val(rem_partner1);
                        $('#selpartner2').trigger('change');
                        $('#selpartner2').select2("close");

                        $('#cklockdata').prop('checked',true);
                        $('#amount').focus();
                      }
                      $('#invdate').datetimepicker("destroy");

                      gettransferlist();
                      //getusercapital_master($('#loginid').val(),$('#invdate').val());
                      toastr.success("Save Transfer Successfully");
                      $("#tbl_transferlist tr:last").css("background-color", "greenyellow");
                      $('#tbl_transferlist tr:last td:nth-child(2) input').focus();
                      $(el).removeAttr('disabled').html(buttontext);
                      $('body').removeClass("wait");

                      //location.reload();
                  }else{
                    $(el).removeAttr('disabled').html(buttontext);
                      $('body').removeClass("wait");
                      alert(data.error)
                  }
              },
              error: function () {
                $(el).removeAttr('disabled').html(buttontext);
                  $('body').removeClass("wait");
                  alert('Save Error.')
              }

          })
      }
      function gettransferlist()
      {
        $('body').addClass("wait");
        var d=$('#invdate').val();
        var userid=$('#filteruser').val();
        var url="{{ route('moneytransfer.gettransferlist') }}";
        $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {d:d,location_id:2,user_id:userid},

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
      $('input[type=radio][name=radcustype]').change(function() {
            getpartner(this.value,'#selpartner');
        });
        $('input[type=radio][name=radcustype1]').change(function() {
            getpartner(this.value,'#selpartner2');
        });
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
                            text:item.name,
                            customertype:item.customertype,
                            userconnect:item.user_connect

                        }))
                    //console.log(item)
                });
                $(el).select2('open');

            })
        }
    })

    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
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

            getrate();
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
            getrate();
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
