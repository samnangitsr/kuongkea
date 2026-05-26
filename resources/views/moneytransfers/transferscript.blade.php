<script type="text/javascript">
    var pathname=window.location.pathname.split("/");
    if(pathname.includes('quicktransfer')){
        $('#h1_title').text('ផ្ទេរប្រាក់រហ័ស');
    }else{
        $('#h1_title').text('ផ្ទេរប្រាក់ដៃគូ');
    }
    tablefixhead(160);
    $(window).resize(function() {
        tablefixhead(160);
        updateDivClass();
    });
    function tablefixhead(h)
    {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-h;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
    }
    updateDivClass();
    //window.addEventListener("resize", updateDivClass);
    function updateDivClass()
    {
        let div1 = document.getElementById("myDiv1"); // Change "myDiv" to your actual class name
        let div2=document.getElementById("myDiv2");
        let divbtnphone=document.getElementById("divbtnphone");

        if (window.innerWidth <= 900) {
                div1.classList.remove("col-lg-6");
                div1.classList.add("col-lg-12");
                div2.classList.remove("col-lg-6");
                div2.classList.add("col-lg-12");
                div2.style.marginTop = "-30px";
                div2.style.marginBottom = "60px"; // Correct way to set inline CSS
                divbtnphone.style.display = 'block';
            } else {
                div1.classList.remove("col-lg-12");
                div1.classList.add("col-lg-6");
                div2.classList.remove("col-lg-12");
                div2.classList.add("col-lg-6");
                div2.style.marginBottom = "0px"; // Correct way to set inline CSS
                div2.style.marginTop = "0px";
                divbtnphone.style.display = 'none';
            }
    }

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
        }else if(event.keyCode==27){
            var isShown = $('#amttel_modal').hasClass('show');
            if(isShown){
                $('#amttel_modal').modal('hide');
            }
        }
    });
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
  // Initialize Select2

    // Custom function to format the option text
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
        function hasPermission(userId, code) {
            let permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
            return permusers.some(item => item.userid == userId && item.code == code);
        }

    function getrecnamefromlocalstorage(inputtel,el)
    {

        var recphonelist;
        if(localStorage.getItem("recphonelist")==null){
            recphonelist=[];
        }else{
            recphonelist=JSON.parse(localStorage.getItem("recphonelist"));
        }
        recphonelist.forEach(function(item){
        //debugger;
        if(item.value==inputtel){
            $(el).val(item.recname);
        }
        })
    }
    function getsendnamefromlocalstorage(inputtel,el)
    {

        var sendphonelist;
        if(localStorage.getItem("sendphonelist")==null){
            sendphonelist=[];
        }else{
            sendphonelist=JSON.parse(localStorage.getItem("sendphonelist"));
        }
        sendphonelist.forEach(function(item){
        //debugger;
        if(item.sendertel==inputtel){
            $(el).val(item.sendername);
        }
        })
    }
    // function savephonetolocalstorage(callback,callback1){
    //     localStorage.removeItem("recphonelist");
    //     localStorage.removeItem("sendphonelist");
    //     localStorage.removeItem("sendernamelist");
    //     localStorage.removeItem("recnamelist");
    //     var url="{{ route('phonenumberlocalstorage') }}";
    //     $.ajax({
    //             async: true,
    //             type: 'GET',
    //             url: url,
    //             data: {},
    //             success: function (data) {
    //                 console.log(data)
    //                 if($.isEmptyObject(data.error)){
    //                     var recphonelist;
    //                     var sendphonelist;
    //                     var recnamelist;
    //                     var sendernamelist;
    //                     if(localStorage.getItem("recphonelist")==null){
    //                         recphonelist=[];
    //                     }else{
    //                         recphonelist=JSON.parse(localStorage.getItem("recphonelist"));
    //                     }
    //                     if(localStorage.getItem("recnamelist")==null){
    //                         recnamelist=[];
    //                     }else{
    //                         recnamelist=JSON.parse(localStorage.getItem("recnamelist"));
    //                     }
    //                     $.each(data['recphonelist'],function(i,item){
    //                         recphonelist.push({
    //                             value:item.rectel,
    //                             label:item.rectel,
    //                             recname:item.recname,
    //                         })
    //                         recnamelist.push({
    //                             value:item.recname,
    //                             label:item.recname,
    //                             rectel:item.rectel,
    //                         })
    //                     });

    //                     localStorage.setItem("recphonelist",JSON.stringify(recphonelist));
    //                     localStorage.setItem("recnamelist",JSON.stringify(recnamelist));

    //                     // sender phone
    //                     if(localStorage.getItem("sendphonelist")==null){
    //                         sendphonelist=[];
    //                     }else{
    //                         sendphonelist=JSON.parse(localStorage.getItem("sendphonelist"));
    //                     }
    //                     if(localStorage.getItem("sendernamelist")==null){
    //                         sendernamelist=[];
    //                     }else{
    //                         sendernamelist=JSON.parse(localStorage.getItem("sendernamelist"));
    //                     }
    //                     $.each(data['sendphonelist'],function(i,item){
    //                         sendphonelist.push({
    //                             value:item.sendertel,
    //                             label:item.sendertel,
    //                             sendername:item.sendername,
    //                         })
    //                         sendernamelist.push({
    //                             value:item.sendername,
    //                             label:item.sendername,
    //                             sendertel:item.sendertel,
    //                         })
    //                     });
    //                     localStorage.setItem("sendphonelist",JSON.stringify(sendphonelist));
    //                     localStorage.setItem("sendernamelist",JSON.stringify(sendernamelist));
    //                     callback();
    //                     callback1();

    //                     $('body').removeClass("wait");
    //                 }else{
    //                     $('body').removeClass("wait");
    //                     alert(data.error)
    //                 }
    //             },
    //             error: function (e) {
    //                 $('body').removeClass("wait");
    //                 alert(e.message)
    //             }

    //         })
    // }

  $(document).ready(function () {
    var currentUserId=$('#loginid').val();
    var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
    if(!isAdmin){
        CheckUserPermit();
    }
      //savephonetolocalstorage(autocomplereceiver,autocomplesender);
      autocomplereceiver();
      autocomplesender();
      function CheckUserPermit()
      {
        if (!hasPermission(currentUserId, '2.4.1')) {$('#li_changedate').css('display','none');}
        if (!hasPermission(currentUserId, '2.4.2'))
        {
            $('#rowbalance1').css('display','none');
            $('#rowbalance3').css('display','none');
            $('#rowbalance2').css('display','none');
        }
      }
      $('#btntransfer').focus();
      //btntransferclick();
    //   $('#selpartner').select2({
    //     dropdownParent: $("#formtransfermodal"),
    //     templateResult: formatOption
    // });
    $('#selpartner').select2({
        templateResult: function (data) {
            if (!data.id) return data.text; // placeholder
            // Use attr() instead of data()
            let customertype = $(data.element).attr('customertype');
            return $('<span>' + data.text +
                ' <span style="font-size:10px; color:brown;">[' + customertype + ']</span></span>');
        }
    });

      $('#selpartner2').select2({
        //templateResult: formatOption
    });
      $('#selcustomer').select2();
      $("#sel_province_search").select2({
          dropdownParent: $("#searchchildmodal")
      });
      $("#sel_district_search").select2({
          dropdownParent: $("#searchchildmodal")
      });
      $("#sel_customer_search").select2({
          dropdownParent: $("#searchchildmodal")
      });
      $(document).on('click','.tbl_transferlist td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
      $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
        $(this).closest(".select2-container").siblings('select:enabled').select2('open');
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


            var projects = [
               {
                  value: "java",
                  label: "Java",
                  desc: "write once run anywhere",
               },
               {
                  value: "jquery-ui",
                  label: "jQuery UI",
                  desc: "the official user interface library for jQuery",
               },
               {
                  value: "Bootstrap",
                  label: "Twitter Bootstrap",
                  desc: "popular front end frameworks ",
               }
            ];

            function autocomplereceiver(){
                var sources=JSON.parse(localStorage.getItem("recphonelist"));
                var sources1=JSON.parse(localStorage.getItem("recnamelist"));
                $( "#rectel" ).autocomplete({
                    source:sources,
                    minLength: 3,
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
                    minLength: 3,
                    select: function( event, ui ) {
                        $( "#recname" ).val( ui.item.value );
                        $( "#rectel" ).val( ui.item.rectel );
                        return false;
                    }

                });
            }
            function autocomplesender(){
                var sources=JSON.parse(localStorage.getItem("sendphonelist"));
                var sources1=JSON.parse(localStorage.getItem("sendernamelist"));
                $( "#sendertel" ).autocomplete({
                    source:sources,
                    minLength: 3,
                    select: function( event, ui ) {
                        $( "#sendertel" ).val( ui.item.value );
                        $( "#sendername" ).val( ui.item.sendername );
                        return false;
                    }
                    //    select : showResult,
                    //     focus : showResult,
                    //     change :showResult
                });
                $( "#sendername" ).autocomplete({
                    source:sources1,
                    minLength: 3,
                    select: function( event, ui ) {
                        $( "#sendername" ).val( ui.item.value );
                        $( "#sendertel" ).val( ui.item.sendertel );
                        return false;
                    }

                });
            }
            // function showResult(event, ui) {
            //     $( "#rectel" ).val( ui.item.phone );
            //     $( "#recname" ).val( ui.item.value );
            // }
        $('.table-responsive').on('show.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "inherit" );
        });

        $('.table-responsive').on('hide.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "auto" );
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
              console.log(data);
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

              $('#selitem').empty();

              $('#selitem').append($("<option/>",{
                          value:'',
                          text:''
                      }))
              $.each(data['items'],function(i,item1){
                    //alert(item1['item'].id);
                  $('#selitem').append($("<option/>",{
                          value:item1.item_id,
                          text:item1['item'].name  + " [" + item1.location + "]",
                          acnr:item1.ac_name_r,
                          acr:item1.ac_r,
                          acnd:item1.ac_name_d,
                          acd:item1.ac_d,
                          acnb:item1.ac_name_b,
                          acb:item1.ac_b
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
      $("input").focus(function() {
            $(this).select();
        });
      $(document).on('change','#selitem',function(e){
        e.preventDefault();
        //fillaccount();
      })
      function fillaccount()
      {
        //debugger;
        var sp = document.querySelector("#selitem");
        var acr=sp.options[sp.selectedIndex].getAttribute('acr');
        var acnr=sp.options[sp.selectedIndex].getAttribute('acnr');
        var acd=sp.options[sp.selectedIndex].getAttribute('acd');
        var acnd=sp.options[sp.selectedIndex].getAttribute('acnd');
        var acb=sp.options[sp.selectedIndex].getAttribute('acb');
        var acnb=sp.options[sp.selectedIndex].getAttribute('acnb');
        var getcur=$('#selcur option:selected').text();
        if(getcur=='KHR'){
            $('#recname').val(acnr);
            $('#rectel').val(acr);
        }else if(getcur=='USD'){
            $('#recname').val(acnd);
            $('#rectel').val(acd);
        }else if(getcur=='THB'){
            $('#recname').val(acnb);
            $('#rectel').val(acb);
        }else{
            $('#recname').val('');
            $('#rectel').val('');
        }
      }
      $(document).on('change','#selpartner',async function(e){
        e.preventDefault();
        //getuseraffectbypartner($(this).val(),'#seluseraffect1',1);
        var sp = document.querySelector("#selpartner");
        var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
        var countrycode=sp.options[sp.selectedIndex].getAttribute('countrycode');
        $('#countrycode').val(countrycode);
        if(customertype=='CUSTOMER'){
            $('#row_kabrak1').css('display','table-row');
            var cur=$('#selcur option:selected').text();
            $('#txtcur_rate1').val(cur);
        }else{
            $('#row_kabrak1').css('display','none');
        }
        if(customertype=='AGENT'){
            await gettranname('#seltranname','#selpartner');
            $('#row_wing_tranname').css('display','table-row');
            // var trancode1=$('#trancode1').val();
            // $('#seltranname option').each(function () {
            //     if ($(this).attr('sign') == trancode1) {
            //         $('#seltranname').val($(this).val()).trigger('change');
            //         return false; // break the loop
            //     }
            // });

        }else{
            $('#row_wing_tranname').css('display','none');
        }
        $('#lblpartner').text(customertype);
        if($('#location_id').val()==1){
            if($('#trancode1').val()==-1){
                if($('#lblpartner').text()=='AGENT' || $('#lblpartner').text()=='BANK'){
                    $('#btnaddtransferlist').css('display','inline')
                    $('#btnshowtemplist').css('display','inline')

                }else{
                    $('#btnaddtransferlist').css('display','none')
                    $('#btnshowtemplist').css('display','none')

                }
            }
        }
        if (document.getElementById("rowbalance1")) {
            if ($("#rowbalance1").length && $("#rowbalance1").is(":visible")) {
                if($(this).val()!==''){
                    getwingbalance($(this).val(),$('#selcur option:selected').text(),'#balance1','#balancenext1',$('#mekun').val(),$('#amount').val(),$('#fee').val(),fillnextbalance);
                }
            }
        }

      })
       function gettranname(el,selpartner) {
            return new Promise((resolve, reject) => {
                var sp = document.querySelector(selpartner);
                var customertype = sp.options[sp.selectedIndex].getAttribute('customertype');
                var agenttype = sp.options[sp.selectedIndex].getAttribute('agenttype');
                $('body').addClass("wait");
                var url = "{{ route('wingtransfer.gettransactionname') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: { agenttype: agenttype },
                    success: function (data) {
                        if ($.isEmptyObject(data.error)) {
                            $(el).empty();

                            $(el).append($("<option/>",{
                                value:'',
                                text:''
                            }))

                            $.each(data['wtn'],function(i,item){
                                $(el).append($("<option/>",{
                                        value:item.id,
                                        text:item.name,
                                        sign:item.sign,
                                        is_tc:item.is_tc??0,
                                    }))

                            });

                            $('body').removeClass("wait");
                            resolve(data); // ✅ resolve when done
                        } else {
                            $('body').removeClass("wait");
                            alert(data.error);
                            reject(data.error);
                        }
                    },
                    error: function (xhr) {
                        $('body').removeClass("wait");
                        alert('Read Error.');
                        reject(xhr);
                    }
                });
            });
        }
      $(document).on('change','#selcustomer',function(e){
        e.preventDefault();
        //getuseraffectbypartner($(this).val(),'#seluseraffect2',2);
        var sp = document.querySelector("#selcustomer");
        var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
        var countrycode=sp.options[sp.selectedIndex].getAttribute('countrycode');
        if (document.getElementById("rowbalance3")) {
            if ($("#rowbalance3").length && $("#rowbalance3").is(":visible")) {
                if($(this).val()!==''){
                    getwingbalance($(this).val(),$('#selcur option:selected').text(),'#balance3','#balancenext3',-1 * parseFloat($('#mekun').val()),$('#amount').val(),$('#cuscharge').val(),fillnextbalance);
                }
            }
        }
      })
      $(document).on('change','#selpartner2',async function(e){
        e.preventDefault();
        //getuseraffectbypartner($(this).val(),'#seluseraffect2',2);
        var sp = document.querySelector("#selpartner2");
        var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
        var countrycode=sp.options[sp.selectedIndex].getAttribute('countrycode');

        if(customertype=='CUSTOMER'){
          var cur=$('#selcur option:selected').text();
          $('#txtcur_rate2').val(cur);
          $('#row_kabrak2').css('display','table-row');
        }else{
            $('#row_kabrak2').css('display','none');
        }

        if(customertype=='AGENT'){
             await gettranname('#seltranname1','#selpartner2');
            refreshwingratefast2( cutwater2,1);
            $('#row_wing_tranname1').css('display','table-row');
        }else{
            $('#row_wing_tranname').css('display','none');
        }

        $('#lblpartner2').text(customertype);
        if (document.getElementById("rowbalance2")) {
            if ($("#rowbalance2").length && $("#rowbalance2").is(":visible")) {
                if($(this).val()!==''){
                    getwingbalance($(this).val(),$('#selcurcontinue option:selected').text(),'#balance2','#balancenext2',-1 * parseFloat($('#mekun').val()),$('#amountcontinue').val(),$('#fee2').val(),fillnextbalance);
                }
            }
        }
      })
    //   $("#tbl_amount td>input").focus(function(){
    //     $(this).css("background-color", "cyan");
    //   });
    //   $("#tbl_amount td>input").blur(function(){
    //     $(this).css("background-color", "white");
    //   });
    //   $("#tbl_partner input").focus(function(){
    //     $(this).css("background-color", "cyan");

    //   });
    //   $("#tbl_partner input").blur(function(){
    //     $(this).css("background-color", "white");
    //   });
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
      if(!pathname.includes('quicktransfer')){
        var cleave = new Cleave('#feeps', {
                numeral: true,
                numeralDecimalScale: 2,
            });
        }
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
      var cleave = new Cleave('#cuscharge2', {
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
      var cleave = new Cleave('#interest2', {
          numeral: true,
          numeralPositiveOnly: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });


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
      $('.txtbuyfix').toArray().forEach(function(field){
          new Cleave(field, {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
      })
      $('.txtsalefix').toArray().forEach(function(field){
          new Cleave(field, {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
      })
      $('.txtratefix').toArray().forEach(function(field){
          new Cleave(field, {
              numeral: true,
              numeralPositiveOnly: true,
              numeralDecimalScale: 6,
              numeralThousandsGroupStyle: 'thousand'
          });
      })

      $(document).on('click','#tbl_checkamt td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })

      $(document).on('click','#btntransfer',function(e){
          e.preventDefault();
          //$('#formtransfermodal').modal('show');
          btntransferclick();
          $('#row_title').css('background-color','red')
          $('#divaction').css('display','block');

      })
      $(document).on('click','#btntransferdebt',function(e){
          e.preventDefault();
          //$('#formtransfermodal').modal('show');
          btntransferdebtclick();
          $('#row_title').css('background-color','orange')
          $('#divaction').css('display','block');

      })
      function btntransferclick()
      {
          document.getElementById('amount').removeAttribute('readonly');
          $('#btnaddtransferlist').css('display','inline');
          $('#btnshowtemplist').css('display','inline');
          $('#tblbutton').css('display','block');
          $('#trancode1').val(1);
          $('#trancode2').val('');
          $('#rowcustomer').css('display','none');
          $('#rowbalance3').css('display','none');

          $('#mekun').val(1);
          $('#btnexchange').css('display','inline');
          if($('#location_id').val()==1){
              $('#tranname').val('ផ្ញើ');
              $('.btnbankpayment').css('display','inline');
          }else{
              $('#tranname').val('ភ្ញៀវយកក្នុង');
          }
          $('.btncontinue').css('display','none');
          $('#btntransfer').css('background-color','red');
          $('#btntransfer').css('color','white');
          $('#btnreceive').css('background-color','inherit');
          $('#btnreceive').css('color','black');
          $('#btntransferdebt').css('background-color','inherit');
          $('#btntransferdebt').css('color','black');
        //   $('#transfer_title').text('ផ្ញើ/ដាក់ប្រាក់');
          $('#cardpartner').css('background-color','red');
        //   $('#cardamount').css('background-color','red');
        //   $('#partner_title').css('color','white');
        //   $('#transfer_title').css('color','white');
          $('#row_cuscharge').css('display','table-row');
          $('#row_totalcash').css('display','table-row');
          $('#row_son').css('display','table-row');
          $('.btnsavetransfer').css('display','inline');
          $('.btnsavetransferprint').css('display','inline');
          $('.btnsavewithcashdraw').css('display','none');
          $('.btnsavewithcashdrawprint').css('display','none');



          $('#divckwater').css('display','inline');
          $('#spanseva').text('សេវ៉ាវេរ');
          $('#m_title').text('ផ្ញើ|ដាក់ប្រាក់');
          resetform();

      }
      function btntransferdebtclick()
      {
          $('#tranname').val('វេរបំណុល');
          $('#mekun').val(1);
          $('#trancode1').val(3);
          $('#trancode2').val(-3);
          $('#rowcustomer').css('display','table-row');
          $('.btnexchange').css('display','inline');
          $('.btnbankpayment').css('display','inline');
          $('.btncontinue').css('display','none');
          $('#btntransferdebt').css('background-color','orange');
          $('#btntransferdebt').css('color','white');
          $('#btnreceive').css('background-color','inherit');
          $('#btnreceive').css('color','black');
          $('#btntransfer').css('background-color','inherit');
          $('#btntransfer').css('color','black');
        //   $('#transfer_title').text('វេរបំណុល/TransferDebt');
          $('#cardpartner').css('background-color','orange');
        //   $('#cardamount').css('background-color','orange');
        //   $('#partner_title').css('color','white');
        //   $('#transfer_title').css('color','white');
          $('#row_cuscharge').css('display','table-row');
          $('#row_totalcash').css('display','table-row');
          $('#rowbalance3').css('display','table-row');
          $('#row_son').css('display','table-row');
          $('.btnsavetransfer').css('display','inline');
          $('.btnsavetransferprint').css('display','inline');
          $('.btnsavewithcashdraw').css('display','none');
          $('.btnsavewithcashdrawprint').css('display','none');
          $('#divckwater').css('display','inline');
          $('#spanseva').text('សេវ៉ាវេរ');
          $('#m_title').text('វេរបំណុល');
          resetform();
      }
      $(document).on('click','#btncontinue,#btncontinue1,#btncontinue_phone',function(e){
          e.preventDefault();
          if($('#divbankpayment').css('display') != 'none'){
            alert('not allow this function this time')
            return;
          }
          $('#trancode1').val(-4);
          $('#trancode2').val(4);
          $('#divcontinue').css('display','block');
          $('#divgettransaction').css('display','none');
          refreshbtncashdraw();
          //$('#btnsavewithcashdraw').css('display','none');
          //window.scrollTo(0, document.body.scrollHeight);
          $('#selpartner2').focus();
          $('#fee2').val(0);
          $('#cuscharge2').val(0);
        //   $('#amountcontinue').val($('#amount').val());
        //   $('#selcurcontinue').val($('#selcur').val());
        //   $('#selcurcontinue').trigger('change');
        //   $('#totalcash2').val($('#amount').val());
        //   $('#amountcontinue').attr('title',$('#amount').val());

            if($('#hasexchange').val()>0){
                autofillbankamt();
            }else{
                autofillamtcontinue()
            }
            $('#totalcash2').val($('#amountcontinue').val());
            $('#amountcontinue').attr('title',$('#amountcontinue').val());
            $('#selcurcontinue').trigger('change');

      })
      function refreshbtncashdraw()
      {
        // let btncontinue = document.getElementById("btncontinue");
        // if(isElementVisible(btncontinue)){

        if($('#mekun').val()==-1){
            $('#btnsavetransfer').css('display','inline');
            $('#btnsavetransferprint').css('display','inline');
            $('#btnsavewithcashdraw').css('display','inline');
            $('#btnsavewithcashdrawprint').css('display','inline');

            if($('#divexchangefix').css('display') != 'none' || $('#divbankpayment').css('display') != 'none'){
                $('#btnsavetransfer').css('display','none');
                $('#btnsavetransferprint').css('display','none');

            }
            if($('#divcontinue').css('display') != 'none'){
                if($('#divexchangefix').css('display') == 'none' &&  $('#divbankpayment').css('display') == 'none'){
                    $('#btnsavewithcashdraw').css('display','none');
                    $('#btnsavewithcashdrawprint').css('display','none');
                }
            }

        }
      }
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
      $(document).on('click','#btnreceive',function(e){
          e.preventDefault();
          //$('#formtransfermodal').modal('show');
          btnreceiveclick();
          $('#row_title').css('background-color','blue')
          $('#divaction').css('display','block');

      })
      $("#formtransfermodal").on('show.bs.modal', function () {

      });
      function btnreceiveclick(){
        document.getElementById('amount').removeAttribute('readonly');

        @if(config('helper.transfer_option') == '52')
            document.getElementById('row_cuscharge').style.display = 'none';
        @endif
        //use jquery
        // @if(config('helper.transfer_option') == '52')
        //     $('#row_cuscharge').hide();
        // @endif

        if($('#location_id').val()==1){
            $('#btncontinue').css('display','inline');
            if($('#lblpartner').text()=='AGENT'){
              $('#btnaddtransferlist').css('display','inline')
              $('#btnshowtemplist').css('display','inline')

            }else{
              $('#btnaddtransferlist').css('display','none')
              $('#btnshowtemplist').css('display','none')
            //   $('#btnexchange').css('display','none');
            //   $('#btnbankpayment').css('display','none');
            //   $('#btnsavetransferprint').css('display','none');
            }
        }else{
            $('.btnsavetransferprint').css('display','none');
            $('.btnsavetransfer').css('display','none');
            $('.btnbankpayment').css('display','none');
            $('.btnexchange').css('display','inline');
            $('.btncontinue').css('display','none');
        }
            $('.btnexchange').css('display','inline');
            $('.btnbankpayment').css('display','inline');
            $('.btnsavetransfer').css('display','inline');
            $('.btnsavetransferprint').css('display','inline');
            $('.btnsavewithcashdraw').css('display','inline');
            $('.btnsavewithcashdrawprint').css('display','inline');

          if($('#location_id').val()==1){
              $('#tranname').val('ទទួល');
          }else{
              $('#tranname').val('ភ្ញៀវយកក្រៅ');
          }
          $('#trancode1').val(-1);
          $('#trancode2').val('');
          $('#mekun').val(-1);
          $('#rowcustomer').css('display','none');
          $('#rowbalance3').css('display','none');

          $('#btntransfer').css('background-color','inherit');
          $('#btntransfer').css('color','black');
          $('#btntransferdebt').css('background-color','inherit');
          $('#btntransferdebt').css('color','black');
          $('#btnreceive').css('background-color','blue');
          $('#btnreceive').css('color','white');

        //   $('#transfer_title').text('ទទួល/ដកប្រាក់');
          $('#cardpartner').css('background-color','blue');
        //   $('#cardamount').css('background-color','blue');
        //   $('#partner_title').css('color','white');
        //   $('#transfer_title').css('color','white');
          //$('#row_cuscharge').css('display','none');
          $('#row_totalcash').css('display','none');
          $('#row_son').css('display','none');
          $('#divckwater').css('display','none');
          $('#spanseva').text('កាត់សេវ៉ា');
          $('#m_title').text('ទទួល|ដកប្រាក់');
          resetform();
      }
      $(document).on('click','#btnclosedivcontinue',function(e){
          e.preventDefault();
          $('#trancode1').val(-1);
          $('#trancode2').val('');
          $('#divcontinue').css('display','none');
          refreshbtncashdraw();
      })
      $(document).on('click','#btnclosedivexchangecard',function(e){
          e.preventDefault();
          $('#divexchangecard').css('display','none');
          $('#divexchangelist').css('display','none');
          refreshbtncashdraw();
          resethasexchange();
      })
      function resethasexchange(){
        var found=0;
        if(document.getElementById("divexchangecard").style.display !== "none") {
          found=1;
        }
        if(document.getElementById("divexchangefix").style.display !== "none") {
          found=2;
        }
        if(document.getElementById("divexchangelist").style.display !== "none") {
          found=2;
        }
        $('#hasexchange').val(found);
      }
      $(document).on('click','#btnclosedivexchangefix',function(e){
          e.preventDefault();
          $('#divexchangefix').css('display','none');
          $('#hasexchangefix').val(0)
          refreshbtncashdraw();
          resethasexchange();
      })
      $(document).on('click','#btnclosedivexchangelist',function(e){
          e.preventDefault();
          $('#divexchangelist').css('display','none');
          resethasexchange();
      })
      $(document).on('click','#btnclosedivbankpayment',function(e){
          e.preventDefault();
          $('#divbankpayment').css('display','none');
          $('#hasbankpayment').val(0);
          refreshbtncashdraw();
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
        if($('#lblpartner').text()=='AGENT'){
            refreshwingratefast(totalcash,fillnextbalance,'#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amount').val().replace(/,/g, ''),$('#fee').val(),'#seltranname','#cuscharge','#fee','#selpartner');
        }else{
            if($('#selpartner').val()!==''){
                fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amount').val(),$('#fee').val());
            }
            if($('#trancode1').val()==3){
              if($('#selcustomer').val()!==''){
                  fillnextbalance('#balance3','#balancenext3',$('#selcur option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amount').val(),$('#cuscharge').val());
              }
            }
        }
        if($('#location_id').val()==1){
            var selitem=$('#selitem').val();
            if(selitem!==''){
                //fillaccount();
            }
        }
      })
        function fillnextbalance(elbal,elnext,cur,sign,amt,fee)
        {
            //debugger;
            var mekun= sign;
            var amt1=amt.toString().replace(/,/g,'');
            var fee1=fee.toString().replace(/,/g,'');
            var amount=parseFloat(amt1)+parseFloat(fee1);
            //var amt2=$('#amount2').val().replace(/,/g,'');
            var i=0;
            var baltitle=$(elbal).attr('title');
            var balusd=baltitle.split(";")[0];
            var balkhr=baltitle.split(";")[1];
            var balthb=baltitle.split(";")[2];
            var balvnd=baltitle.split(";")[3];

            var balnext=0;
            var bal=0;
            var cur1='';

            if(cur=='USD'){
                    balnext=-1 * (parseFloat(balusd)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balusd);
                    cur1=' USD';
            }else if(cur=='KHR'){
                    balnext=-1 * (parseFloat(balkhr)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balkhr);
                    cur1=' KHR';
            }else if(cur=='THB'){
                    balnext=-1 * (parseFloat(balthb)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balthb);
                    cur1=' THB';
            }else if(cur=='VND'){
                    balnext=-1 * (parseFloat(balvnd)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balvnd);
                    cur1=' VND';
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
        function getwingbalance(cid,cur,elem,elnext,sign,amt,fee,fillnext_balance)
        {
            $('body').addClass("wait");
                //$('#wingbalancenext').val('');
                // var amt=0;
                // var fee=0;
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
                        $(elem).attr('title',data.usd+';'+data.khr+';'+data.thb+';'+data.vnd);
                        // if(cur=='USD'){
                        //     $(elem).val(formatNumber(Math.abs(data.usd)) + ' ' + cur);
                        // }else if(cur=='KHR'){
                        //     $(elem).val(formatNumber(Math.abs(data.khr)) + ' ' + cur);
                        // }else if(cur=='THB'){
                        //     $(elem).val(formatNumber(Math.abs(data.thb)) + ' ' + cur);
                        // }
                        fillnext_balance(elem,elnext,cur,sign,amt,fee);
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
      $(document).on('change','#selcurcontinue',function(e){
          var curid=$(this).val();
          $('#txtcur2').val(curid);
          $('#selcuschargecontinuecur').val(curid);
          var cur=$('#selcurcontinue option:selected').text();
          $('#txtcur3').val(cur);
          if($('#selpartner2').val()!==''){
                if($('#lblpartner2').text()=='AGENT'){
                    refreshwingratefast(totalcash2,fillnextbalance,'#balance2','#balancenext2',$('#selcurcontinue option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amountcontinue').val().replace(/,/g, ''),$('#fee2').val(),'#seltranname1','#cuscharge2','#fee2','#selpartner2');
                }else{
                    fillnextbalance('#balance2','#balancenext2',$('#selcurcontinue option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amountcontinue').val(),$('#fee2').val());
                }
            }
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
              //getcurrencybykey1(C,'#selcur')
              getcurrencybykeylocalstorage(C,'#selcur');
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
              //getcurrencybykey1(C,'#selcurcontinue')
              getcurrencybykeylocalstorage(C,'#selcurcontinue');
              $('#txtcur2').val($('#selcurcontinue').val());
              $('#selcuschargecontinuecur').val($('#selcurcontinue').val());
              var cur=$('#selcurcontinue option:selected').text();
              $('#txtcur3').val(cur);
          }
      })
      $(document).on('keyup','#fee',function(e){
          const C = e.key;
          if (C === "Backspace"){
              return;
          }
          if(isNumber(C)==false){
            //   getcurrencybykey1(C,'#txtcur1')
              getcurrencybykeylocalstorage(C,'#txtcur1');
          }
      })
      $(document).on('keyup','#fee2',function(e){
          const C = e.key;
          if (C === "Backspace"){
              return;
          }
          if(isNumber(C)==false){
              //getcurrencybykey1(C,'#txtcur2')
              getcurrencybykeylocalstorage(C,'#txtcur2');
          }
      })
      $(document).on('keyup','#cuscharge',function(e){
          const C = e.key;
          if (C === "Backspace"){
              //cutwater(0);
              return;
          }
          if(isNumber(C)==false){
              //getcurrencybykey1(C,'#selcur1')
              getcurrencybykeylocalstorage(C,'#selcur1');
              totalcash();
          }
          //cutwater(0);
      })
      $(document).on('keyup','#cuscharge2',function(e){
          const C = e.key;
          if (C === "Backspace"){
              //cutwater(0);
              return;
          }
          if(isNumber(C)==false){
              //getcurrencybykey1(C,'#selcuschargecontinuecur')
              getcurrencybykeylocalstorage(C,'#selcuschargecontinuecur');
              totalcash2();
          }
          //cutwater(0);
      })
      $(document).on('change','#cuscharge',function(e){
          cutwater(0);
          if($('#trancode1').val()==3){
            if($('#selcustomer').val()!==''){
                fillnextbalance('#balance3','#balancenext3',$('#selcur option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amount').val(),$('#cuscharge').val());
            }
          }
      })
      $(document).on('change','#seltranname',function(e){
        var amt=$('#amount').val();
        var cur=$('#selcur').val();
        if(amt=='') return;
        if(cur=='') return;
        refreshwingratefast(totalcash,fillnextbalance,'#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amount').val().replace(/,/g, ''),$('#fee').val(),'#seltranname','#cuscharge','#fee','#selpartner');
      })
      $(document).on('change','.bankamt,.bankcur,.bankid',function(e){
        e.preventDefault
        var $row = $(this).closest('tr');
        var ind=$(this).closest('tr').index();
        var bankname=$('.bankid option:selected').eq(ind).text();
        $('.bankname').eq(ind).val(bankname);
        //debugger;
        var sign=$('#mekun').val();
        var totalcuscharge=0;
        var totalfee=0;
        var totaltransferfee=0;


        var $bankid = $row.find('.bankid');
        var $bankcur = $row.find('.bankcur');
        var cur=$bankcur.find(':selected').text();
        var trannameid=$('#seltranname').val();
        var amount=$('.bankamt').eq(ind).val().replace(/,/g, '');
        var customertype = $bankid.find(':selected').attr('customertype');

        if(customertype=='AGENT'){
            var maxtransfer=$bankid.find(':selected').attr('maxtransfer');
            var maxfee=$bankid.find(':selected').attr('maxfee');
            var maxcuscharge=$bankid.find(':selected').attr('maxcuscharge');
            var maxtransferfee=$bankid.find(':selected').attr('maxtransferfee');
            var maxamtstr=maxtransfer.replace(/,/g,'');
                var maxfeestr=maxfee.replace(/,/g,'');
                var maxcuschargestr=maxcuscharge.replace(/,/g,'');
                var maxtransferfeestr=maxtransferfee.replace(/,/g,'');

                var maxamtby=maxamtstr.split('/');
                var maxfeeby=maxfeestr.split('/');
                var maxcuschargeby=maxcuschargestr.split('/');
                var maxtransferfeeby=maxtransferfeestr.split('/');

                var maxamt2=0;
                var maxfee2=0;
                var maxcuscharge2=0;
                var maxtransferfee2=0;
                if(cur=='USD'){
                    maxamt2=maxamtby[0];
                    maxfee2=maxfeeby[0];
                    maxcuscharge2=maxcuschargeby[0];
                    maxtransferfee2=maxtransferfeeby[0];
                }

                if(cur=='KHR'){
                    maxamt2=maxamtby[1];
                    maxfee2=maxfeeby[1];
                    maxcuscharge2=maxcuschargeby[1];
                    maxtransferfee2=maxtransferfeeby[1];
                }
                if(cur=='THB'){
                    maxamt2=maxamtby[2];
                    maxfee2=maxfeeby[2];
                    maxcuscharge2=maxcuschargeby[2];
                    maxtransferfee2=maxtransferfeeby[2];
                }


                if(maxamt2==0) return;
                var result=Math.floor(amount / maxamt2);
                var somnal=amount % maxamt2;

                for(let i=0;i<result;i++){
                    if(sign==-1){
                        totalcuscharge+=parseFloat(maxcuscharge2);
                        totalfee+=parseFloat(maxcuscharge2)-parseFloat(maxtransferfee2);
                    }else{
                        totalfee+=parseFloat(maxfee2);
                    }

                }
                if(somnal!==0 && isNaN(somnal)==false){
                    var wingrate;
                    if(cur=='USD'){
                        if(localStorage.getItem("wingrate_usd")==null){
                            wingrate=[];
                        }else{
                            wingrate=JSON.parse(localStorage.getItem("wingrate_usd"));
                        }

                    }else if(cur=='KHR'){
                        if(localStorage.getItem("wingrate_khr")==null){
                            wingrate=[];
                        }else{
                            wingrate=JSON.parse(localStorage.getItem("wingrate_khr"));
                        }

                    }
                    var founditem=0;
                    for(k=0;k<wingrate.length;k++){
                        //debugger;
                        if(founditem==1){
                            break;
                        }

                        if(wingrate[k].amt1<somnal && wingrate[k].amt2>=somnal && wingrate[k].currency==cur){
                            var arr_tranname_id=wingrate[k].tranname_id.split(',');
                            for(x=0;x<arr_tranname_id.length;x++){
                                if(arr_tranname_id[x]==trannameid){
                                    if(sign==-1){
                                        totalcuscharge+=parseFloat(wingrate[k].customer_rate);
                                        totalfee+=parseFloat(wingrate[k].customer_rate)-parseFloat(wingrate[k].transfer_rate);

                                    }else if(sign==1){
                                        totalfee+=parseFloat(wingrate[k].cashdraw_rate);
                                        $('.bankpartnerfee').eq(ind).val(0);
                                    }
                                    founditem=1;
                                    break;
                                }
                            }
                        }
                    }
            }
            $('.bankcuscharge').eq(ind).val(formatNumber(totalcuscharge,4));
            $('.bankpartnerfee').eq(ind).val(formatNumber(totalfee,4));


        }
      })

      $(document).on('change','#amount',function(e){
        $('#amount').attr('title',$(this).val());
        if($('#lblpartner').text()=='AGENT'){
            refreshwingratefast(totalcash,fillnextbalance,'#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amount').val().replace(/,/g, ''),$('#fee').val(),'#seltranname','#cuscharge','#fee','#selpartner');
        }else{
            cutwater(1);
            checkamountORtel($(this).val(),'amt');
            if (document.getElementById("rowbalance1")) {
                if ($("#rowbalance1").length && $("#rowbalance1").is(":visible")) {
                    if($('#selpartner').val()!==''){
                        fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amount').val(),$('#fee').val());
                    }
                    if($('#trancode1').val()==3){
                    if($('#selcustomer').val()!==''){
                        fillnextbalance('#balance3','#balancenext3',$('#selcur option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amount').val(),$('#cuscharge').val());
                    }
                    }
                }
            }
        }
      })
      function refreshwingratefast2(callback,m)
      {
        //debugger;
        try{
            var sp = document.querySelector('#seltranname1');
            var sign=sp.options[sp.selectedIndex].getAttribute('sign');
             var is_tc=sp.options[sp.selectedIndex].getAttribute('is_tc');
            var trannameid=$('#seltranname1').val();
            //var sign=$('#trancode1').val();
            if(sign==4 || sign==-4){
                $('#cuscharge2').val(0);
                $('#fee2').val(0);
                return;
            }
            var totalcuscharge=0;
            var totalfee=0;
            var totaltransferfee=0;
            var amount=$('#amountcontinue').val().replace(/,/g, '');
            var wingcur=$('#selcurcontinue').val();
            var cur=$('#selcurcontinue option:selected').text();

            var sp = document.querySelector('#selpartner2');

            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
            var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
            var maxfee=sp.options[sp.selectedIndex].getAttribute('maxfee');
            var maxcuscharge=sp.options[sp.selectedIndex].getAttribute('maxcuscharge');
            var maxtransferfee=sp.options[sp.selectedIndex].getAttribute('maxtransferfee');

            if(trannameid=='' || agenttype=='' || cur=='' || amount=='' || amount==0){
                return;
            }
            if(customertype=='AGENT'){
                if (is_tc == 0) {
                    var response = findRates(agenttype, amount, trannameid, cur);
                    if (response.length > 0) {
                        let customerRate = response[0]['customer_rate'];
                        let fee11 = (sign == 1)
                            ? response[0]['transfer_rate']
                            : response[0]['cashdraw_rate'];

                        // 🔹 Handle Customer Rate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            $('#cuscharge2').val((parseFloat(customerRate) * parseFloat(amount)) / 100);
                        } else {
                            $('#cuscharge2').val(parseFloat(customerRate));
                        }

                        // 🔹 Handle Fee
                        if (typeof fee11 === "string" && fee11.includes("%")) {
                            fee11 = fee11.replace("%", "").trim();
                            $('#fee2').val((parseFloat(fee11) * parseFloat(amount)) / 100);
                        } else {
                            $('#fee2').val(parseFloat(fee11));
                        }
                    }
                   callback(m);
                    return;
                }
                var maxamtstr=maxtransfer.replace(/,/g,'');
                var maxfeestr=maxfee.replace(/,/g,'');
                var maxcuschargestr=maxcuscharge.replace(/,/g,'');
                var maxtransferfeestr=maxtransferfee.replace(/,/g,'');

                var maxamtby=maxamtstr.split('/');
                var maxfeeby=maxfeestr.split('/');
                var maxcuschargeby=maxcuschargestr.split('/');
                var maxtransferfeeby=maxtransferfeestr.split('/');

                var maxamt2=0;
                var maxfee2=0;
                var maxcuscharge2=0;
                var maxtransferfee2=0;
                if(cur=='USD'){
                    maxamt2=maxamtby[0];
                    maxfee2=maxfeeby[0];
                    maxcuscharge2=maxcuschargeby[0];
                    maxtransferfee2=maxtransferfeeby[0];
                }

                if(cur=='KHR'){
                    maxamt2=maxamtby[1];
                    maxfee2=maxfeeby[1];
                    maxcuscharge2=maxcuschargeby[1];
                    maxtransferfee2=maxtransferfeeby[1];
                }
                if(cur=='THB'){
                    maxamt2=maxamtby[2];
                    maxfee2=maxfeeby[2];
                    maxcuscharge2=maxcuschargeby[2];
                    maxtransferfee2=maxtransferfeeby[2];
                }


                if(maxamt2==0) return;
                var result=Math.floor(amount / maxamt2);
                var somnal=amount % maxamt2;

                for(let i=0;i<result;i++){
                    if(sign==1){
                        totalcuscharge+=parseFloat(maxcuscharge2);
                        totalfee+=parseFloat(maxcuscharge2)-parseFloat(maxtransferfee2);
                    }else{
                        totalfee+=parseFloat(maxfee2);
                    }

                }
            }else{
                var somnal=amount;
            }

            if(somnal!==0 && isNaN(somnal)==false){
                var wingrate;
                if(cur=='USD'){
                    if(localStorage.getItem("wingrate_usd")==null){
                        wingrate=[];
                    }else{
                        wingrate=JSON.parse(localStorage.getItem("wingrate_usd"));
                    }

                }else if(cur=='KHR'){
                    if(localStorage.getItem("wingrate_khr")==null){
                        wingrate=[];
                    }else{
                        wingrate=JSON.parse(localStorage.getItem("wingrate_khr"));
                    }

                }
                // var founditem=0;
                // for(k=0;k<wingrate.length;k++){
                //     if(founditem==1){
                //         break;
                //     }

                //     if(wingrate[k].amt1<somnal && wingrate[k].amt2>=somnal && wingrate[k].currency==cur){
                //         var arr_tranname_id=wingrate[k].tranname_id.split(',');
                //         for(x=0;x<arr_tranname_id.length;x++){
                //             if(arr_tranname_id[x]==trannameid){
                //                 if(sign==1){
                //                     totalcuscharge+=parseFloat(wingrate[k].customer_rate);
                //                     totalfee+=parseFloat(wingrate[k].customer_rate)-parseFloat(wingrate[k].transfer_rate);

                //                 }else if(sign==-1){
                //                     totalfee+=wingrate[k].cashdraw_rate
                //                     $('#fee2').val(0);
                //                 }
                //                 founditem=1;
                //                 break;
                //             }
                //         }
                //     }
                // }
                var response = findRates(agenttype, somnal, trannameid, cur);
                if (response.length > 0) {
                    if (sign == 1) {
                        let customerRate = response[0]['customer_rate'];
                        let transferRate = response[0]['transfer_rate'];

                        // declare variables outside
                        let cuscharge = 0;
                        let transfer = 0;

                        // ✅ Handle customerRate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            cuscharge = (parseFloat(customerRate) * parseFloat(somnal)) / 100;
                        } else {
                            cuscharge = parseFloat(customerRate);
                        }

                        // ✅ Handle transferRate
                        if (typeof transferRate === "string" && transferRate.includes("%")) {
                            transferRate = transferRate.replace("%", "").trim();
                            transfer = (parseFloat(transferRate) * parseFloat(somnal)) / 100;
                        } else {
                            transfer = parseFloat(transferRate);
                        }

                        totalcuscharge += cuscharge;
                        totalfee += parseFloat(cuscharge) - parseFloat(transfer);

                    } else if (sign == -1) {
                        let cashdrawRate = response[0]['cashdraw_rate'];

                        let cashdraw = 0;

                        // ✅ Handle cashdrawRate
                        if (typeof cashdrawRate === "string" && cashdrawRate.includes("%")) {
                            cashdrawRate = cashdrawRate.replace("%", "").trim();
                            cashdraw = (parseFloat(cashdrawRate) * parseFloat(somnal)) / 100;
                        } else {
                            cashdraw = parseFloat(cashdrawRate);
                        }

                        totalfee += cashdraw;
                        $('#fee2').val();
                    }
                }
            }
            $('#cuscharge2').val(formatNumber(totalcuscharge,4));
            $('#fee2').val(formatNumber(totalfee,4));
            callback(m);
        }catch{

        }
      }
        function findRates(agentTypeId, amount, tranNameId, cur) {
            let data = [];
            if (cur === 'USD') {
                data = JSON.parse(localStorage.getItem("wingrate_usd") || "[]");
            }else if (cur === 'KHR') {
                data = JSON.parse(localStorage.getItem("wingrate_khr") || "[]");
            }else if (cur === 'THB') {
                data = JSON.parse(localStorage.getItem("wingrate_thb") || "[]");
            }
            return data.filter(row =>
                Number(row.agenttype_id) === Number(agentTypeId) &&
                Number(amount) >= Number(row.amt1) &&
                Number(amount) <= Number(row.amt2) &&
                row.tranname_id.split(",").map(x => x.trim()).includes(String(tranNameId)) &&
                row.currency === cur
            ).map(row => ({
                customer_rate: row.customer_rate,
                transfer_rate: row.transfer_rate,
                cashdraw_rate: row.cashdraw_rate
            }));
        }
      function refreshwingratefast(callback1,callback2,el_balance1,el_balancenext1,selcur,mekun,amount,fee,el_seltraname,el_cuscharge,el_fee,el_partner)
      {
        //debugger;
        try{
            var sp = document.querySelector(el_seltraname);
            var sign=sp.options[sp.selectedIndex].getAttribute('sign');
            var is_tc=sp.options[sp.selectedIndex].getAttribute('is_tc');
            var trannameid=$(el_seltraname).val();
            //var sign=$('#trancode1').val();
            if(sign==4 || sign==-4){
                $(el_cuscharge).val(0);
                $(el_fee).val(0);
                callback2(el_balance1,el_balancenext1,selcur,mekun,amount,fee);
                return;
            }
            var totalcuscharge=0;
            var totalfee=0;
            var totaltransferfee=0;
            //var amount=$('#amount').val().replace(/,/g, '');
            //var wingcur=$('#selcur').val();
            //var cur=$('#selcur option:selected').text();
            var wingcur=selcur;
            var cur=selcur;
            var sp = document.querySelector(el_partner);

            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
            var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
            var maxfee=sp.options[sp.selectedIndex].getAttribute('maxfee');
            var maxcuscharge=sp.options[sp.selectedIndex].getAttribute('maxcuscharge');
            var maxtransferfee=sp.options[sp.selectedIndex].getAttribute('maxtransferfee');


            if(trannameid=='' || agenttype=='' || cur=='' || amount=='' || amount==0){
                callback2(el_balance1,el_balancenext1,selcur,mekun,amount,fee);
                return;
            }
            if(customertype=='AGENT'){
                if (is_tc == 0) {
                    var response = findRates(agenttype, amount, trannameid, cur);

                    if (response.length > 0) {
                        let customerRate = response[0]['customer_rate'];
                        let fee11 = (sign == 1)
                            ? response[0]['transfer_rate']
                            : response[0]['cashdraw_rate'];

                        // 🔹 Handle Customer Rate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            $(el_cuscharge).val((parseFloat(customerRate) * parseFloat(amount)) / 100);
                        } else {
                            $(el_cuscharge).val(parseFloat(customerRate));
                        }

                        // 🔹 Handle Fee
                        if (typeof fee11 === "string" && fee11.includes("%")) {
                            fee11 = fee11.replace("%", "").trim();
                            $(el_fee).val((parseFloat(fee11) * parseFloat(amount)) / 100);
                        } else {
                            $(el_fee).val(parseFloat(fee11));
                        }
                    }
                    callback1();
                    callback2(el_balance1,el_balancenext1,selcur,mekun,amount, $(el_fee).val());
                    return;
                }

                var maxamtstr=maxtransfer.replace(/,/g,'');
                var maxfeestr=maxfee.replace(/,/g,'');
                var maxcuschargestr=maxcuscharge.replace(/,/g,'');
                var maxtransferfeestr=maxtransferfee.replace(/,/g,'');

                var maxamtby=maxamtstr.split('/');
                var maxfeeby=maxfeestr.split('/');
                var maxcuschargeby=maxcuschargestr.split('/');
                var maxtransferfeeby=maxtransferfeestr.split('/');

                var maxamt2=0;
                var maxfee2=0;
                var maxcuscharge2=0;
                var maxtransferfee2=0;
                if(cur=='USD'){
                    maxamt2=maxamtby[0];
                    maxfee2=maxfeeby[0];
                    maxcuscharge2=maxcuschargeby[0];
                    maxtransferfee2=maxtransferfeeby[0];
                }

                if(cur=='KHR'){
                    maxamt2=maxamtby[1];
                    maxfee2=maxfeeby[1];
                    maxcuscharge2=maxcuschargeby[1];
                    maxtransferfee2=maxtransferfeeby[1];
                }
                if(cur=='THB'){
                    maxamt2=maxamtby[2];
                    maxfee2=maxfeeby[2];
                    maxcuscharge2=maxcuschargeby[2];
                    maxtransferfee2=maxtransferfeeby[2];
                }


                if(maxamt2==0) return;
                var result=Math.floor(amount / maxamt2);
                var somnal=amount % maxamt2;

                for(let i=0;i<result;i++){
                    if(sign==1){
                        totalcuscharge+=parseFloat(maxcuscharge2);
                        totalfee+=parseFloat(maxcuscharge2)-parseFloat(maxtransferfee2);
                    }else{
                        totalfee+=parseFloat(maxfee2);
                    }

                }
            }else{
                //var somnal=$('#amount').val().replace(/,/g, '');
                var somnal=amount;

            }

            if(somnal!==0 && isNaN(somnal)==false){
                var wingrate;
                if(cur=='USD'){
                    if(localStorage.getItem("wingrate_usd")==null){
                        wingrate=[];
                    }else{
                        wingrate=JSON.parse(localStorage.getItem("wingrate_usd"));
                    }

                }else if(cur=='KHR'){
                    if(localStorage.getItem("wingrate_khr")==null){
                        wingrate=[];
                    }else{
                        wingrate=JSON.parse(localStorage.getItem("wingrate_khr"));
                    }

                }
                var response = findRates(agenttype, somnal, trannameid, cur);
                if (response.length > 0) {
                    if (sign == 1) {
                        let customerRate = response[0]['customer_rate'];
                        let transferRate = response[0]['transfer_rate'];

                        // declare variables outside
                        let cuscharge = 0;
                        let transfer = 0;

                        // ✅ Handle customerRate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            cuscharge = (parseFloat(customerRate) * parseFloat(somnal)) / 100;
                        } else {
                            cuscharge = parseFloat(customerRate);
                        }

                        // ✅ Handle transferRate
                        if (typeof transferRate === "string" && transferRate.includes("%")) {
                            transferRate = transferRate.replace("%", "").trim();
                            transfer = (parseFloat(transferRate) * parseFloat(somnal)) / 100;
                        } else {
                            transfer = parseFloat(transferRate);
                        }

                        totalcuscharge += cuscharge;
                        totalfee += parseFloat(cuscharge) - parseFloat(transfer);

                    } else if (sign == -1) {
                        let cashdrawRate = response[0]['cashdraw_rate'];

                        let cashdraw = 0;

                        // ✅ Handle cashdrawRate
                        if (typeof cashdrawRate === "string" && cashdrawRate.includes("%")) {
                            cashdrawRate = cashdrawRate.replace("%", "").trim();
                            cashdraw = (parseFloat(cashdrawRate) * parseFloat(somnal)) / 100;
                        } else {
                            cashdraw = parseFloat(cashdrawRate);
                        }

                        totalfee += cashdraw;
                        $(el_fee).val(0);
                    }
                }
                // var founditem=0;
                // for(k=0;k<wingrate.length;k++){
                //     if(founditem==1){
                //         break;
                //     }
                //     if(wingrate[k].amt1<somnal && wingrate[k].amt2>=somnal && wingrate[k].currency==cur){
                //         var arr_tranname_id=wingrate[k].tranname_id.split(',');
                //         for(x=0;x<arr_tranname_id.length;x++){
                //             if(arr_tranname_id[x]==trannameid){
                //                 if(sign==1){
                //                     totalcuscharge+=parseFloat(wingrate[k].customer_rate);
                //                     totalfee+=parseFloat(wingrate[k].customer_rate)-parseFloat(wingrate[k].transfer_rate);

                //                 }else if(sign==-1){
                //                     totalfee+=wingrate[k].cashdraw_rate
                //                     $('#fee').val(0);
                //                 }
                //                 founditem=1;
                //                 break;
                //             }
                //         }
                //     }
                // }
            }
            $(el_cuscharge).val(formatNumber(totalcuscharge,4));
            $(el_fee).val(formatNumber(totalfee,4));
            callback1();
            callback2(el_balance1,el_balancenext1,selcur,mekun,amount,totalfee);
        }catch(e){
            console.log(e)
        }
      }
      $(document).on('change','#fee',function(e){
            var amt=$('#amount').val().replace(/,/g,'');
            var fee=$('#fee').val().replace(/,/g,'');
            var fp=0;
            fp=(parseFloat(fee)/parseFloat(amt))*100;
            $('#feeps').val(formatNumber(fp));
          if($('#selpartner').val()!==''){
              fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amount').val(),$('#fee').val());
          }
      })
      $(document).on('change','#feeps',function(e){
            e.preventDefault();
            var amt=$('#amount').val().replace(/,/g,'');
            var fp=$('#feeps').val().replace(/,/g,'');
            var fee=0;
            fee=(parseFloat(fp)*parseFloat(amt))/100;
            $('#fee').val(formatNumber(fee));
      })

      $(document).on('change','#fee2',function(e){
          if($('#selpartner2').val()!==''){
              fillnextbalance('#balance2','#balancenext2',$('#selcurcontinue option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amountcontinue').val(),$('#fee2').val());
          }
      })
      $(document).on('change','#cuscharge2',function(e){
          cutwater2(0);
      })
      $(document).on('change','#amountcontinue',function(e){
          cutwater2(1);
          $('#amountcontinue').attr('title',$(this).val());
          if($('#lblpartner2').text()=='AGENT'){
            refreshwingratefast(totalcash2,fillnextbalance,'#balance2','#balancenext2',$('#selcurcontinue option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amountcontinue').val().replace(/,/g, ''),$('#fee2').val(),'#seltranname1','#cuscharge2','#fee2','#selpartner2');
          }else{
              if($('#selpartner2').val()!==''){
                  fillnextbalance('#balance2','#balancenext2',$('#selcurcontinue option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amountcontinue').val(),$('#fee2').val());
              }
          }

      })
      $(document).on('change','#seltranname1',function(e){
        e.preventDefault();
        var amt=$('#amountcontinue').val();
        var cur=$('#selcurcontinue').val();
        if(amt=='') return;
        if(cur=='') return;
        refreshwingratefast(totalcash2,fillnextbalance,'#balance2','#balancenext2',$('#selcurcontinue option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amountcontinue').val().replace(/,/g, ''),$('#fee2').val(),'#seltranname1','#cuscharge2','#fee2','#selpartner2');
      })
      $(document).on('change','#rectel',function(e){
        e.preventDefault();
        @if(config('helper.transfer_option') !== '52')
            checkamountORtel($(this).val(),'tel');
        @endif
      })
      $(document).on('blur','#recname,#cuscharge',function(e){
          $('#amttel_modal').modal('hide');
      })
      $(document).on('click','#btnclosedivtransferlist',function(e){
        e.preventDefault();
        $('#divtemplist').css('display','none');
        $('#hasmultitransfer').val(0);
      })
      function checkamountORtel(value,searchby){
        var url="{{ route('moneytransfer.checkamountortel') }}";
        var partner_id=$('#selpartner').val();
        $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: { search:value,searchby:searchby,partner_id:partner_id},
                complete: function () {

                },
                success: function (data) {
                  //console.log(data);
                  var k=0;
                  var output='';
                  for(var i=0;i<data['transfers'].length;i++){
                        k+=1;
                        output +=
                        `<tr>
                            <td style="text-align:center;" class="kh16">${ k }</td>
                            <td class="kh16">
                                ${ moment(data['transfers'][i].dd).format("DD-MM-YYYY") }
                            </td>
                            <td class="kh16">${data['transfers'][i].user.name}</td>
                            <td class="kh16">${data['transfers'][i].partner.name}</td>
                            <td class="kh16">${data['transfers'][i].tranname}</td>
                            <td class="kh16-b" style="text-align:right;">${formatNumber(data['transfers'][i].amount) } ${ data['transfers'][i].currency .shortcut}</td>

                            <td class="kh16" style="text-align:right;">${data['transfers'][i].rectel??''}</td>
                            <td class="kh16">${data['transfers'][i].recname??''}</td>
                        </tr>`;
                    }
                    $('#body_divsearchamount').empty().html(output);
                    if(k>0){

                      $('#amttel_modal').modal('show');

                      if(searchby=='amt'){
                        $('#mo_dialog').removeClass('modalright').addClass('modalleft');
                      }else{
                        $('#mo_dialog').removeClass('modalleft').addClass('modalright');
                      }
                    }else{
                      $('#amttel_modal').modal('hide');
                    }
                },
                error: function () {
                    alert('Read Amount or Tel Checker Error.')
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
                    gettemptransfertlist();
                 })
              }

      })
     function gettransferlist()
        {
            $('body').addClass("wait");
            var location_id=$('#location_id').val();
            $('#divgettransaction').css('display','block');
            var d=$('#invdate').val();
            var userid=$('#filteruser').val();
            var url="{{ route('moneytransfer.gettransferlist') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {d:d,location_id:location_id,user_id:userid},

                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#body_transaction').empty().html(data);
                    $('body').removeClass("wait");
                    $("#tbl_transferlist tr:last").css("background-color", "pink");
                    $('#tbl_transferlist tr:last td:nth-child(2) input').focus();
                    if($('#location_id').val()==-1){
                        $('#amount').focus();
                     }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
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
      $(document).on('click','.btndeltransfer',function(e){
        e.preventDefault();
        var id=$(this).data('id');
        //var ref_num=$(this).data('ref_number');
        //var fromid=ref_num.split('-')[1];

        if(!isAdmin){
            if (!hasPermission(currentUserId, '1.3.1')) {
               alert('you have no permission to delete this transaction')
               return;
            }
        }
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
                            countrecordsaved();
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
      $(document).on('click','#btnshowtemplist',function(e){
        e.preventDefault();
        gettemptransfertlist();

      })
      function gettemptransfertlist(){
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
                  $('#body_divtemlist').empty().html(data);
                  $('.list_partnername').select2({templateResult: formatOption1});
                  var table = document.getElementById("tbl_templist");
                  var tbodyRowCount = table.tBodies[0].rows.length;

                    if(tbodyRowCount>0){
                      $('#divtemplist').css('display','inline');
                      $('#hasmultitransfer').val(1);
                      //$('#btncontinue').css('display','none');
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
                    }else{
                      $('#divtemplist').css('display','none');
                      $('#hasmultitransfer').val(0);
                    //   if($('#trancode1').val()==-1){
                    //     $('#btncontinue').css('display','inline');
                    //   }
                      toastr.success("Empty Transfer Temp List");
                    }
                    window.scrollTo(0, document.body.scrollHeight);
                },
                error: function () {
                    alert('Read Get Transfer List Error.')
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
          if($('#selpartner').val()!==''){
              fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amount').val(),$('#fee').val());
          }
          if($('#trancode1').val()==3){
            if($('#selcustomer').val()!==''){
                fillnextbalance('#balance3','#balancenext3',$('#selcur option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amount').val(),$('#cuscharge').val());
            }
          }

      }
      function totalcash()
      {
          var totalcash=0;
          var amt=$('#amount').val().replace(/,/g, '');
          var cur=$('#selcur option:selected').text();
          var cuscharge=$('#cuscharge').val().replace(/,/g, '');
          if(cuscharge=='') cuscharge=0;
          if(amt=='') amt=0;
          var cur1=$('#selcur1 option:selected').text();
          if(cur==cur1){
              totalcash=parseFloat(amt)+parseFloat(cuscharge);
          }else{
              totalcash=amt;
          }
          $('#totalcash').val(formatNumber(parseFloat(totalcash)));
      }
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
          if($('#selpartner2').val()!==''){
            fillnextbalance('#balance2','#balancenext2',$('#selcurcontinue option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amountcontinue').val(),$('#fee2').val());
            }

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
      $(document).on('keyup','.bankamt',function(e){
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          const C = e.key;
          if (C === "Backspace") return;
          if(isNumber(C)==false){
              //getcurrencybykey1(C,$('.bankcur').eq(rowind-1));
              getcurrencybykeylocalstorage(C,$('.bankcur').eq(rowind-1));
          }
      })
      $(document).on('click','#btnrefershbankamt',function(e){
        e.preventDefault();
        autofillbankamt();
      })
      $(document).on('click','#btnbankpayment,#btnbankpayment1,#btnbankpayment_phone',function(e){
          e.preventDefault();
          if($('#divcontinue').css('display') != 'none'){
            alert('not allow this function this time')
            return;
          }
          $('#divgettransaction').css('display','none');
          $('#divbankpayment').css('display','block');
          $('#hasbankpayment').val(1);
          refreshbtncashdraw();
          addrow();
          autofillbankamt();

          //var h = $('#formtransfermodal .modal-body').height();
          //$("#formtransfermodal .modal-body").scrollTop(h+1000);
          //window.scrollTo(0, document.body.scrollHeight);
      })
      function isEmpty(val){
            return (val === undefined || val == null || val.length <= 0) ? true : false;
        }
        $(document).on('click','#btnexchange2,#btnexchangerow,#btnexchange2_phone',function(e){
            e.preventDefault();
            $('.bankamt').each(function(i,e){
                $('.bankamt').eq(i).val('');
                $('.bankcur').eq(i).val('');
            })

        let btncontinue = document.getElementById("btncontinue");
        if(isElementVisible(btncontinue)){
            $('#btncontinue1').show();
        }else{
            $('#btncontinue1').hide();
        }

        let btnbankpayment = document.getElementById("btnbankpayment");
        if(isElementVisible(btnbankpayment)){
            $('#btnbankpayment1').show();
        }else{
            $('#btnbankpayment1').hide();
        }

          $('#divgettransaction').css('display','none');
          var curname='';
          var hasmultitransfer=$('#hasmultitransfer').val();
          $('#divexchangefix').css('display','block');
          refreshbtncashdraw();
          if(hasmultitransfer==1){
            var amt=0;
            var curid='';
            var curid1='';
            var cuscharge=0;
            var totalcuscharge=0;
            var sale=0;
            $('.list_amount').each(function(i,e){
                  amt=$(this).val().replace(/,/g, '');
                  cuscharge=$('.list_cuscharge').eq(i).val().replace(/,/g, '');
                  totalcuscharge +=parseFloat(cuscharge);
                  curid=$('.list_curid').eq(i).val();
                  curid1=$('.list_curcharge_id').eq(i).val();
                  curname=$('.list_curid option:selected').eq(i).text();
                  if(curid==curid1){
                      sale+=parseFloat(Math.abs(amt))+parseFloat(Math.abs(cuscharge));
                  }else{
                    $('#cuscharge').val(totalcuscharge);
                    $('#selcur1').val(curid1);
                    sale+=parseFloat(Math.abs(amt));
                  }
              })
          }else{
            var sale=0;
            var curid=$('#selcur').val();
            var curid1=$('#selcur1').val();
            if(curid==curid1){
                if($('#mekun').val()==-1){
                    sale=parseFloat($('#amount').val().replace(/,/g, ''))-parseFloat($('#cuscharge').val().replace(/,/g, ''));
                }else{
                    sale=parseFloat($('#amount').val().replace(/,/g, ''))+parseFloat($('#cuscharge').val().replace(/,/g, ''));
                }
            }else{
                sale=$('#amount').val().replace(/,/g, '');
            }
             curname=$('#selcur option:selected').text();
          }

            $('.txtratefix').each(function(i,e){
            $('.txtratefix').eq(i).val('');
            $('.lblratefix').eq(i).val('');
          })

          getcurrencybyid(curid,'#lblbuy');

          var arr_cur=['USD','THB','KHR','VND'];
          var arr_key=['d','b','r','v']
          let j=0;
          let curind=0;
            $('.lblbuyfix').each(function(i,e){
                if(i==0){
                    $('.txtbuyfix').eq(i).val(formatNumber(sale));
                }else{
                    $('.txtbuyfix').eq(i).val('');
                    $('.txtsalefix').eq(i).val('');
                }
                j=j+1;
                $(this).attr('title',$('#lblbuy').attr('title'));
                $('#txtleftcur').attr('title',$('#lblbuy').attr('title'))
                $(this).val($('#lblbuy').val());
                if(arr_cur[i]==$(this).val()){
                    j+=1;
                    curind=i;
                }
                if($('#trancode1').val()==-1){
                    $('.txtsignfix').eq(i).val('+');
                    $('.txtsign1fix').eq(i).val('-');
                    $('.txtbuyfix').eq(i).css('color','blue');
                    $('.txtsalefix').eq(i).css('color','red');
                    $('.txtsignfix').eq(i).css('color','blue');
                    $('.txtsign1fix').eq(i).css('color','red');
                    $('.lblbuyfix').eq(i).css('color','blue');
                    $('.lblsalefix').eq(i).css('color','red');

                    $('#thbuy').text('លក់ចេញ');
                    $('#thsale').text('ទិញចូល');
                }else{
                    $('.txtsignfix').eq(i).val('-');
                    $('.txtsign1fix').eq(i).val('+');
                    $('.txtbuyfix').eq(i).css('color','red');
                    $('.txtsalefix').eq(i).css('color','blue');
                    $('.txtsignfix').eq(i).css('color','red');
                    $('.txtsign1fix').eq(i).css('color','blue');
                    $('.lblbuyfix').eq(i).css('color','red');
                    $('.lblsalefix').eq(i).css('color','blue');
                    $('#thbuy').text('ទិញចូល');
                    $('#thsale').text('លក់ចេញ');
                }

                if(isEmpty(arr_key[j-1])==true){
                    if($('#countrycode').val()=='+66'){getcurrencybycountrycode('THB',arr_cur[curind],$('.lblbuyfix').eq(i));}
                    getcurrencybykey2(arr_key[curind],$('.lblsalefix').eq(i),$('.lblbuyfix').eq(i),$('.txtbuyfix').eq(i),$('.txtratefix').eq(i),$('.lblsalefix').eq(i),$('.txtsalefix').eq(i),$('.txtsignfix').eq(i),$('.lblratefix').eq(i));
                }else{
                    if($('#countrycode').val()=='+66'){getcurrencybycountrycode('THB',arr_cur[j-1],$('.lblbuyfix').eq(i));}
                    getcurrencybykey2(arr_key[j-1],$('.lblsalefix').eq(i),$('.lblbuyfix').eq(i),$('.txtbuyfix').eq(i),$('.txtratefix').eq(i),$('.lblsalefix').eq(i),$('.txtsalefix').eq(i),$('.txtsignfix').eq(i),$('.lblratefix').eq(i));
                }

            })


          $('#hasexchangefix').val(1);
          $('#hasexchange').val(2);
          $('#txtleftamt').val(0);
          $('#txtmainamt').val(formatNumber(sale));
          $('#txtleftcur').val(curname);
          $('.txtbuyfix').eq(0).focus();
          $('.txtbuyfix').eq(0).select();

          resetaction1();
          //window.scrollTo(0, document.body.scrollHeight);
          var h = $('#formtransfermodal .modal-body').height();
          $("#formtransfermodal .modal-body").scrollTop(h+1000);
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
          if($('#hasexchangefix').val()==0){
            if(document.getElementById("divexchangelist").style.display == "none") {
                $('#hasexchange').val(1);
            }
          }
          $('#txtbuy').val(formatNumber(sale));
          $('#txtleftamt').val(formatNumber(sale));
          $('#txtmainamt').val(formatNumber(sale));
          $('#txtleftcur').val(curname);
          $('#lblrate').attr('title',1);
          getcurrencybyid(curid,'#lblbuy');

          if(curname!='USD'){
              getcurrencybykey('d','#lblsale')
          }else{
              getcurrencybykey('r','#lblsale')
          }

          if($('#trancode1').val()==-1){
            $('#txtsign').val('+');
            $('#txtsign1').val('-');
            $('#txtbuy').css('color','blue');
            $('#txtsale').css('color','red');
          }else{
            $('#txtsign').val('-');
            $('#txtsign1').val('+');
            $('#txtbuy').css('color','red');
            $('#txtsale').css('color','blue');
          }

          window.scrollTo(0, document.body.scrollHeight);

      })
      $(document).on('click','#btnexchangemore',function(e){
          e.preventDefault();
            $('#btnaddexchange2').click();
            var sale=$('#txtleftamt').val().replace(/,/g, '');
            var curid=$('#txtleftcur').attr('title').split(';')[0];
            var curname=$('#txtleftcur').val();

          $('#divexchangecard').css('display','block');
          //$('#divexchangelist').css('display','block');
          //$('#hasexchange').val(1);
          $('#txtbuy').val(formatNumber(sale));
          // $('#txtleftamt').val(formatNumber(sale));
          // $('#txtmainamt').val(formatNumber(sale));
          // $('#txtleftcur').val(curname);
          $('#lblrate').attr('title',1);
          getcurrencybyid(curid,'#lblbuy');

          // if(curname!='USD'){
          //     getcurrencybykey('d','#lblsale')
          // }else{
          //     getcurrencybykey('r','#lblsale')
          // }

          if($('#trancode1').val()==-1){
            $('#txtsign').val('+');
            $('#txtsign1').val('-');
            $('#txtbuy').css('color','blue');
            $('#txtsale').css('color','red');
          }else{
            $('#txtsign').val('-');
            $('#txtsign1').val('+');
            $('#txtbuy').css('color','red');
            $('#txtsale').css('color','blue');
          }
          $('#txtbuy').focus();
          $('#txtbuy').select();
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
      $(document).on('keydown','.tdcanenter2',function(e){
       if (e.keyCode == 13) {
          totalamtleft();
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
                //   if($('#mekun').val()==1){
                //       $('#cuscharge').focus();
                //       $('#cuscharge').select();
                //   }else{
                //       $('#fee').focus();
                //       $('#fee').select();
                //   }
                if ($('#row_cuscharge').is(':hidden')) {
                    $('#fee').focus();
                    $('#fee').select();
                }else{
                    $('#cuscharge').focus();
                    $('#cuscharge').select();
                }
              }else if (id == 'cuscharge') {
                  $('#fee').focus();
                  $('#fee').select();
              }else if (id == 'fee') {
                  $('#btnsavetransfer').focus();
              }else if(id=='rectel'){
                    getrecnamefromlocalstorage($('#rectel').val().replace(/\s+/g, ''),'#recname');
                  $('#recname').focus();
              }else if(id=='recname'){
                  $('#amount').focus();
              }else if(id=='sendertel'){
                    getsendnamefromlocalstorage($('#sendertel').val().replace(/\s+/g, ''),'#sendername');
                  $('#sendername').focus();
              }else if(id=='sendername'){
                  $('#rectel').focus();
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
          var q = confirm("Do you want to clear list?");
              if (q) {
                  var url="{{ route('clearexchangelist') }}";
                 $.post(url,{},function(data){
                  getmultiexchangelist();
                 })
              }
      })


      $(document).on('click','.btnnew',function(e){
        e.preventDefault();
        location.reload();
      })
      function savetoexchangemulti()
      {
        $('.lblbuyfix').each(function(i,e){
            var formdata = new FormData;
            if($('.txtsignfix').eq(i).val()=='+'){
                formdata.append("buy",$('.txtbuyfix').eq(i).val());
                formdata.append("curbuy",$('.lblbuyfix').eq(i).val());
                formdata.append("sale",$('.txtsalefix').eq(i).val());
                formdata.append("cursale",$('.lblsalefix').eq(i).val());
                formdata.append("buyinfo",$('.lblbuyfix').eq(i).attr('title'));
                formdata.append("saleinfo",$('lblsalefix').eq(i).attr('title'));
            }else{
                formdata.append("buy",$('.txtsalefix').eq(i).val());
                formdata.append("curbuy",$('.lblsalefix').eq(i).val());
                formdata.append("sale",$('.txtbuyfix').eq(i).val());
                formdata.append("cursale",$('.lblbuyfix').eq(i).val());
                formdata.append("buyinfo",$('.lblsalefix').eq(i).attr('title'));
                formdata.append("saleinfo",$('.lblbuyfix').eq(i).attr('title'));
            }
            formdata.append("rateinfo",$('.txtratefix').eq(i).attr('title'));
            formdata.append('rate',$('.txtratefix').eq(i).val());
            formdata.append('drate',$('.lblratefix').eq(i).attr('title'));
            formdata.append('dd',$('#invdate').val());
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: "{{ route('saveaddlist') }}",
                data: formdata,
                success: function (data) {

                },
                error: function () {
                    alert('Save multi exchange list Error.')
                }

            })
        })

      }
      $(document).on('click','#btnaddexchange2',function(e){
          e.preventDefault();
          //clear list after add exchange2
          var url="{{ route('clearexchangelist') }}";
          $.post(url,{},function(data){})
          saveexchange2('',0,0,0,0,0,'','');
          //window.scrollTo(0, document.body.scrollHeight);
      })
      function saveexchange2(func,isprint,autocashdraw,transfer_sign,isclear,foundcontinue,buttontext,el)
      {
        $('#divexchangelist').css('display','block');
          var formdata=new FormData;
          $('.txtbuyfix').each(function(i,e){
            bamt=$('.txtbuyfix').eq(i).val().replace(/,/g, '');
            if(isNumber(bamt) && bamt!=0){
              if(transfer_sign==-1){
                formdata.append("curbuy[]",$('.lblbuyfix').eq(i).val());
                formdata.append("buy[]",$('.txtbuyfix').eq(i).val());
                formdata.append("sale[]",$('.txtsalefix').eq(i).val());
                formdata.append("cursale[]",$('.lblsalefix').eq(i).val());
                formdata.append("buyinfo[]",$('.lblbuyfix').eq(i).attr('title'));
                formdata.append("saleinfo[]",$('.lblsalefix').eq(i).attr('title'));
              }else{
                formdata.append("curbuy[]",$('.lblsalefix').eq(i).val());
                formdata.append("buy[]",$('.txtsalefix').eq(i).val());
                formdata.append("sale[]",$('.txtbuyfix').eq(i).val());
                formdata.append("cursale[]",$('.lblbuyfix').eq(i).val());
                formdata.append("buyinfo[]",$('.lblsalefix').eq(i).attr('title'));
                formdata.append("saleinfo[]",$('.lblbuyfix').eq(i).attr('title'));
              }

              formdata.append("rateinfo[]",$('.txtratefix').eq(i).attr('title'));
              formdata.append('rate[]',$('.txtratefix').eq(i).val());
              formdata.append('drate[]',$('.lblratefix').eq(i).attr('title'));
            }
          })
              formdata.append('dd',$('#invdate').val());
              formdata.append('isclear',isclear);
          $.ajax({
              async: true,
              type: 'POST',
              contentType: false,
              processData: false,
              url: "{{ route('saveaddlistmulti') }}",
              data: formdata,
              success: function (data) {
                //$('#hasexchange').val(2);
                getmultiexchangelist();
                if(func!=''){
                  func(isprint,autocashdraw,transfer_sign,foundcontinue,buttontext,el);
                }
              },
              error: function () {
                  alert('Save Exchange2 Error.')
              }

          })
      }
        $('input[type=radio][name=radcustype]').change(function() {
            getpartner(this.value,'#selpartner');
        });
        $('input[type=radio][name=radcustype2]').change(function() {
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
                            userconnect:item.user_connect,
                            thai_list:item.thai_list,
                            countrycode:item.tel,
                            agenttype:item.agent_type_id,
                            maxtransfer:item.agenttype.transfer_amount,
                            maxcuscharge:item.agenttype.customer_fee,
                            maxfee:item.agenttype.cashdraw_fee,
                            maxtransferfee:item.agenttype.transfer_fee
                        }))
                    //console.log(item)
                });
                $(el).select2('open');

            })
        }
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
      $('#selpartner').on('select2:close', function (e)
        {
            $('#rectel').focus();
        });
      $(document).on('click','#btnaddrow',function(e){
          e.preventDefault();
          addrow();
          autofillbankamt();

          //window.scrollTo(0, document.body.scrollHeight);
      })
      $(document).on('click','.remove',function(e){
          e.preventDefault();
          //$(this).parent().parent().remove();
          var n=$(this).closest('tr').index();
          $(this).closest("tr").remove();
          updatetbl_in(n+1,'');
          ResetNo();
      });
      function ResetNo(){
          $('.no').each(function(i,e){
              $(this).text(i+1);
          })
      }
      $(document).on('click','.btndelmxlist',function(e){
          e.preventDefault();
          var id=$(this).data('id');
          var url="{{ route('delete_multiexchangelist') }}";
          $.post(url,{id:id},function(data){
              console.log(data)
              if(data.success){
                  getmultiexchangelist();
              }else{
                  alert(data.error)
              }
          })
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
      function printcashdraw(ref_number){
                var redirectWindow = window.open('{{ url('/') }}'+'/cashdraw/prints?ref_number='+ref_number, '_blank');
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
        formdata.append("invdate",$('#invdate').val());
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
                    gettemptransfertlist();
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
      function func_savetransfer(isprint,autocashdraw,transfer_sign,foundcontinue,buttontext,el)
      {

          $('body').addClass("wait");
          var cklockdata = document.getElementById("cklockdata").checked;
          let ck_water2 = $('#ckwater2').is(':checked');
          let ck_water = $('#ckwater').is(':checked');

          var formdata=new FormData(frmtransfer);
            formdata.append('ck_water',ck_water==true?1:0);
            formdata.append('ck_water2',ck_water2==true?1:0);

          var hasexchange=$('#hasexchange').val();
          var hasbankpayment=$('#hasbankpayment').val();
          var sp = document.querySelector("#selpartner");
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          var thai_list_partner=sp.options[sp.selectedIndex].getAttribute('thai_list');

          var sp1 = document.querySelector("#selcustomer");
          var customertype1=sp1.options[sp1.selectedIndex].getAttribute('customertype');
          var thai_list_customer=sp1.options[sp1.selectedIndex].getAttribute('thai_list');

          var sp2 = document.querySelector("#selpartner2");
          var customertype2=sp2.options[sp2.selectedIndex].getAttribute('customertype');
          var thai_list_continue=sp2.options[sp2.selectedIndex].getAttribute('thai_list');

          var trancode1=$('#trancode1').val();
          if(trancode1==-4 || trancode1==4){
              if(thai_list_partner==null || thai_list_partner==""){
                if(thai_list_continue!==null || thai_list_continue!==""){
                    thai_list_partner=thai_list_continue;
                    thai_list_continue='';
                }
              }else{
                if(thai_list_continue==null || thai_list_continue==""){
                    thai_list_continue=thai_list_partner;
                    thai_list_partner='';
                }
              }

          }
          if(trancode1==-3 || trancode1==3){
              if(thai_list_partner==null || thai_list_partner==""){
                if(thai_list_customer!==null || thai_list_customer!==""){
                    thai_list_partner=thai_list_customer;
                    thai_list_customer='';
                }
              }else{
                if(thai_list_customer==null || thai_list_customer==""){
                    thai_list_customer=thai_list_partner;
                    thai_list_partner='';
                }
              }

          }

          if(trancode1==-1){
            formdata.append('g_sender','អតិថិជនមុខផ្ទះ');
            formdata.append('g_receive',$('#selpartner option:selected').text());

          }else if(trancode1==1){
              formdata.append('g_sender',$('#selpartner option:selected').text());
              formdata.append('g_receive','អតិថិជនមុខផ្ទះ');
          }

          var partner1=$('#selpartner option:selected').text();
          var partner2=$('#selpartner2 option:selected').text();
          var partnerid1=$('#selpartner').val();
          var partnerid2=$('#selpartner2').val();

          var cur_transfer=$('#selcur option:selected').text();
          var cur_cuscharge=$('#selcur1 option:selected').text();
          var cur_fee=$('#txtcur1 option:selected').text();

          var cur_transfer_continue=$('#selcurcontinue option:selected').text();
          var cur_cuscharge_continue=$('#selcuschargecontinuecur option:selected').text();
          var cur_fee_continue=$('#txtcur2 option:selected').text();

          formdata.append('cur_transfer',cur_transfer);
          formdata.append('cur_cuscharge',cur_cuscharge);
          formdata.append('cur_fee',cur_fee);

          formdata.append('cur_transfer_continue',cur_transfer_continue);
          formdata.append('cur_cuscharge_continue',cur_cuscharge_continue);
          formdata.append('cur_fee_continue',cur_fee_continue);


          formdata.append("invdate",$('#invdate').val());
          formdata.append("customertype", customertype);
          formdata.append("customertype1", customertype1);
          formdata.append("customertype2", customertype2);
          formdata.append("partner1", partner1);
          formdata.append("partner2", partner2);
          formdata.append("partnerid1", partnerid1);
          formdata.append("partnerid2", partnerid2);
          formdata.append("autocashdraw", autocashdraw);
          formdata.append("foundcontinue", foundcontinue);
          formdata.append("thai_list_partner", thai_list_partner);
          formdata.append("thai_list_customer", thai_list_customer);
          formdata.append("thai_list_continue", thai_list_continue);

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

          var url="{{ route('moneytransfer.store') }}";
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
                    if(isprint==1 && autocashdraw==0){
                        printtransfers(data.id,hasexchange,hasbankpayment);
                    }
                    if(autocashdraw==1 && isprint==1){
                        // if(!pathname.includes('quicktransfer')){
                        //     printcashdraw(data.cashdraw_id);
                        // }
                        printcashdraw(data.cashdraw_id);
                    }

                    //   $('#precord').text(data.partner_records + ' Records');
                    //   $('#brecord').text(data.bank_records + ' Records');
                      if(cklockdata==true){
                         var rem_partner1=$('#selpartner').val();
                         var rem_rectel=$('#rectel').val();
                         var rem_recname=$('#recname').val();
                         var rem_sendertel=$('#sendertel').val();
                         var rem_sendername=$('#sendername').val();
                      }

                        if($('#location_id').val()==-1){
                            $('#amount').val("");
                            $('#cuscharge').val("0");
                            $('#fee').val("0");
                            $('#rectel').val("");
                            $('#recname').val("");
                            $('#totalcash').val(0);
                            resetform();
                            //$('#amount').focus();
                            $('#selpartner').trigger('change');
                        }else{
                            var selectedValue = $('input[name="radcustype"]:checked').val();
                            $('#frmtransfer').trigger('reset');
                            if(transfer_sign==1){
                                btntransferclick();
                            }else{
                                btnreceiveclick();
                            }

                            document.querySelector('input[name="radcustype"][value="' + selectedValue + '"]').checked = true;

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
                        }

                      gettransferlist();
                      //savephonetolocalstorage(autocomplereceiver,autocomplesender);
                      @if(config('helper.show_user_capital_master') == '1')
                        //getusercapital_master($('#loginid').val(),$('#invdate').val());
                         getuseraccount_master(1,1,$('#loginid').val());
                      @endif
                      toastr.success("Save Transfer Successfully");

                      $('#divtemplist').css('display','none');
                      $('#hasmultitransfer').val(0);
                      $('body').removeClass("wait");
                      if(cklockdata==true){
                        $('#selpartner').val(rem_partner1);
                        $('#selpartner').trigger('change');
                        $('#rectel').val(rem_rectel);
                        $('#recname').val(rem_recname);
                        $('#sendertel').val(rem_sendertel);
                        $('#sendername').val(rem_sendername);
                        $('#cklockdata').prop('checked',true);
                        $('#selpartner').select2("close");
                    }

                    $(el).removeAttr('disabled').html(buttontext);
                  }else{
                      $('body').removeClass("wait");
                      alert(data.error)
                      $(el).removeAttr('disabled').html(buttontext);
                  }
              },
              error: function () {
                  $('body').removeClass("wait");
                  alert('Save Error.')
                  $(el).removeAttr('disabled').html(buttontext);
              }

          })

      }

      $(document).on('click','#btnrefresh',function(e){
        e.preventDefault();
        gettransferlist();
        //countrecordsaved();
      })
      $(document).on('change','#filteruser',function(e){
        e.preventDefault();
        gettransferlist();
      })
      $(document).on('click','.btnsavetransfer,.btnsavetransferprint,.btnsavewithcashdraw,.btnsavewithcashdrawprint',function(e){
          e.preventDefault();
          var allowsave=1;
          //var btnid=$(this).attr('id');
          //document.getElementById(btnid).disabled=true;
          var buttontext=$(this).text();
          $(this).attr('disabled', true).text("Processing");
          var sp = document.querySelector("#selpartner");
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          //var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');

        //   var userconnect=sp.options[sp.selectedIndex].getAttribute('userconnect');
        //   @if(config('helper.transfer_option') !== '52')
        //     if($('#txtrole').val().toLowerCase()!=='admin'){
        //         if(customertype=='BANK' || customertype=='AGENT'){
        //                 var userid=$('#loginid').val();
        //                 var partneruser=userconnect.split(',');
        //                 if(!partneruser.includes(userid)){
        //                         alert('selected bank not match user')
        //                         allowsave=0;
        //                     }
        //         }
        //     }
        //   @endif

        //   var ckbank=document.getElementById('radbank').checked;
        //   var ckagent=document.getElementById('radagent').checked;

          var foundcontinue=0;
          var isprint=0;
          var autocashdraw=0;
        //   var idclick=$(this).attr('id');
        //   if(idclick=='btnsavetransferprint'){
        //       isprint=1;
        //   }else if(idclick=='btnsavewithcashdraw'){
        //     autocashdraw=1;
        //     //isprint=1;
        //     $('#trancode1').val(-1);
        //     $('#trancode2').val(1);
        //   }else if(idclick=='btnsavewithcashdrawprint'){
        //     autocashdraw=1;
        //     isprint=1;
        //     $('#trancode1').val(-1);
        //     $('#trancode2').val(1);
        //   }

            if ($(this).hasClass('btnsavetransfer')) {
                console.log('Clicked: btnsavetransfer');
            } else if ($(this).hasClass('btnsavetransferprint')) {
                isprint=1;
            } else if ($(this).hasClass('btnsavewithcashdraw')) {
                autocashdraw=1;
                //isprint=1;
                $('#trancode1').val(-1);
                $('#trancode2').val(1);
            } else if ($(this).hasClass('btnsavewithcashdrawprint')) {
                autocashdraw=1;
                isprint=1;
                $('#trancode1').val(-1);
                $('#trancode2').val(1);
            }

          if($('#trancode1').val()==-1){
              if(customertype=='BANK' || customertype=='AGENT'){
                 autocashdraw=1;
               }
          }
        if($('#divcontinue').css('display') != 'none'){
            foundcontinue=1;
        }

          var t_amount1=$('#amount').val().replace(/,/g, '');
          var t_amount2=$('#amountcontinue').val().replace(/,/g, '');
          if(t_amount1==""){
            t_amount1=0;
          }
          if(t_amount2==""){
            t_amount2=0;
          }
          var t_interest1=$('#interest1').val().replace(/,/g, '');
          var t_interest2=$('#interest2').val().replace(/,/g, '');
          if(t_interest1>t_amount1){
            alert('You can not add interest with amount zero.')
            allowsave=0;
          }
          if(t_interest2>t_amount2){
            alert('You can not add interest with amount zero.')
            allowsave=0;
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

          var totalbuyamt=0;
          var totalcash=$('#totalcash').val().replace(/,/g,'');
          var foundnegative=0;
          $('.txtbuyfix').each(function(i,e){
            bamt=$('.txtbuyfix').eq(i).val().replace(/,/g, '');
            totalbuyamt+=parseFloat(bamt);
            if(isNumber(bamt) && parseFloat(bamt)<0){
                foundnegative=1;
            }
          })
          if(foundnegative==1){
            alert('save with exchange negative not allow');
            allowsave=0;
          }
          if(parseFloat(totalbuyamt)>parseFloat(totalcash)){
            alert('exchange amount is bigger than transfer amount');
            allowsave=0;
          }
          //var transfer_sign=0;
          var hasmultitransfer=$('#hasmultitransfer').val();
          var transfer_sign=$('#mekun').val();
          if(hasmultitransfer==0){
            if(transfer_sign==0){
                $('body').removeClass("wait");
                alert('Save without title not allow');
                allowsave=0;
            }
            if(transfer_sign==1){
                var cuscharge=$('#cuscharge').val();
                var curcharge=$('#selcur1').val();
                if(cuscharge=='' || curcharge==''){
                    $('body').removeClass("wait");
                    alert('Please input customer charge')
                    allowsave=0;
                }
            }
          }
          if(allowsave==0){
            $(this).removeAttr('disabled').html(buttontext);
            return;
          }
         // debugger;
          //var hasexchangefix=$('#hasexchangefix').val();
          //alert(hasexchangefix)
          if($('#hasexchangefix').val()==1){
            if(document.getElementById("divexchangelist").style.display == "none") {
              saveexchange2(func_savetransfer,isprint,autocashdraw,transfer_sign,1,foundcontinue,buttontext,$(this));
              return;
            }else{
              func_savetransfer(isprint,autocashdraw,transfer_sign,foundcontinue,buttontext,$(this));
            }
          }else{
            func_savetransfer(isprint,autocashdraw,transfer_sign,foundcontinue,buttontext,$(this));
          }
      })

    function resetform()
    {
      $('#amttel_modal').modal('hide');
      $("#ckwater").prop("checked", false);
      $('#divcontinue').css('display','none');
      $('#divexchangecard').css('display','none');
      $('#divexchangefix').css('display','none');
      $('#divexchangelist').css('display','none');
      $('#divbankpayment').css('display','none');
      $('#hasexchange').val(0);
      $('#hasbankpayment').val(0);
      $('#hasexchangefix').val(0);
      $('#selpartner').val('');
      $('#selpartner2').val('');
      $('#selcustomer').val('');
      $('#selpartner').trigger('change');
      $('#selpartner2').trigger('change');
      $('#selcustomer').trigger('change');
      if($('#location_id').val()==1){
          $('#selpartner').focus();
      }else{
          $('#amount').focus();
          $('#balance1').val('');
          $('#balancenext1').val('');

      }
      $("#tbl_bankpayment tr").remove();
    }
    $('#selpartner').on('select2:close', function (e)
      {
          $('#sendertel').focus();
      });
      function totalamtleft()
      {
        let j=0;
        var bamt=0;
        var total=0;
        var leftamt=0;
        var mainamt=$('#txtmainamt').val().replace(/,/g, '');
        $('.txtbuyfix').each(function(i,e){
          bamt=$('.txtbuyfix').eq(i).val().replace(/,/g, '');
          if(isNumber(bamt)){
            total+=parseFloat($('.txtbuyfix').eq(i).val().replace(/,/g, ''));
            leftamt=parseFloat(mainamt)-parseFloat(total);
            $('#txtleftamt').val(formatNumber(leftamt.toFixed(2)));
          }else{
            j=j+1;
            if(j==1){
              leftamt=parseFloat(mainamt)-parseFloat(total);
               $('.txtbuyfix').eq(i).val(formatNumber(leftamt.toFixed(2)));
               calcuexchange2($('.lblbuyfix').eq(i),$('.txtbuyfix').eq(i),$('.txtratefix').eq(i),$('.lblsalefix').eq(i),$('.txtsalefix').eq(i),$('.txtsignfix').eq(i),$('.lblratefix').eq(i));
               $('#txtleftamt').val(formatNumber(0));
            }
          }
        })
      }
      $(document).on('keyup', '.txtratefix', function (e) {
          var row = $(this).closest('tr');
          var rowind=$(this).closest('tr').index();
          if(isNumber(e.key)){
            calcuexchange2($('.lblbuyfix').eq(rowind),$('.txtbuyfix').eq(rowind),$('.txtratefix').eq(rowind),$('.lblsalefix').eq(rowind),$('.txtsalefix').eq(rowind),$('.txtsignfix').eq(rowind),$('.lblratefix').eq(rowind));
              return;
          }
          //alert('not a number')
          const C = e.key;
          if (C === "Backspace") {
            calcuexchange2($('.lblbuyfix').eq(rowind),$('.txtbuyfix').eq(rowind),$('.txtratefix').eq(rowind),$('.lblsalefix').eq(rowind),$('.txtsalefix').eq(rowind),$('.txtsignfix').eq(rowind),$('.lblratefix').eq(rowind));
              return;
          }

      })
      $(document).on('keyup','.txtbuyfix,.txtsalefix',function(e){
          var row = $(this).closest('tr');
          var rowind=$(this).closest('tr').index();

          var clickfrom=$(this).attr('class');
          if(isNumber(e.key)){
              if(clickfrom.includes('txtsalefix')==true){
                calcuexchange3($('.lblbuyfix').eq(rowind),$('.txtbuyfix').eq(rowind),$('.txtratefix').eq(rowind),$('.lblsalefix').eq(rowind),$('.txtsalefix').eq(rowind),$('.txtsignfix').eq(rowind),$('.lblratefix').eq(rowind));
              }else{
                calcuexchange2($('.lblbuyfix').eq(rowind),$('.txtbuyfix').eq(rowind),$('.txtratefix').eq(rowind),$('.lblsalefix').eq(rowind),$('.txtsalefix').eq(rowind),$('.txtsignfix').eq(rowind),$('.lblratefix').eq(rowind));
              }
              return;
          }
          //alert('not a number')

          const C = e.key;
          if (C === "Backspace") {
            if(clickfrom.includes('txtsalefix')==true){
                calcuexchange3($('.lblbuyfix').eq(rowind),$('.txtbuyfix').eq(rowind),$('.txtratefix').eq(rowind),$('.lblsalefix').eq(rowind),$('.txtsalefix').eq(rowind),$('.txtsignfix').eq(rowind),$('.lblratefix').eq(rowind));
              }else{
                calcuexchange2($('.lblbuyfix').eq(rowind),$('.txtbuyfix').eq(rowind),$('.txtratefix').eq(rowind),$('.lblsalefix').eq(rowind),$('.txtsalefix').eq(rowind),$('.txtsignfix').eq(rowind),$('.lblratefix').eq(rowind));
              }
              return;
          }

      })
      $(document).on('keyup', '#txtbuy,#txtsale', function (e) {
          //debugger
          //alert(e.key)
          var clickfrom=$(this).attr('id');

          if(isNumber(e.key)){
              if(clickfrom=='txtsale'){
                calcuexchange1();
              }else{
                calcuexchange();
              }
              return;
          }
          //alert('not a number')
          const C = e.key;
          if (C === "Backspace") {
            if(clickfrom=='txtsale'){
              calcuexchange1();
            }else{
              calcuexchange();
            }

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

      $(document).on('click','.btnprint',function(e){
        e.preventDefault();
        //debugger;
        var id=$(this).data('id');
        var cashdraw_id=$(this).data('cashdraw_id');
        if(cashdraw_id>0){
            printcashdraw('cashdraw-'+cashdraw_id);
        }else{
            printtransfers(id,1,1);
        }
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
        // $(el).attr('title', c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
        // $(imgel).attr('src','{{ asset('public/myimages') }}'+ '/' + c.imgpath);
        // getrate();
      }
    })
  }
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

        // var url="{{ route('getcurrencybykey') }}";
        // $.get(url,{key:key},function(data){
        //         if(data['c']!=null){
        //             $(el).val(data['c']['shortcut']);
        //             $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
        //             getrate();
        //         }
        // })
        var currencylist;
        if(localStorage.getItem("currencylist")==null){
            currencylist=[];
        }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
        }
        for (let i = 0; i < currencylist.length; i++) {
            if(currencylist[i].skey==key){
                //debugger;
                $(el).val(currencylist[i].shortcut);
                $(el).attr('title', currencylist[i].id + ';' + currencylist[i].ratebuy + ';' + currencylist[i].ratesale + ';' + currencylist[i].optsign + ';' + currencylist[i].ismain + ';' + currencylist[i].isfn + ';' + currencylist[i].shortcut);
                getrate();
                return;
            }
        }

    }
    function getcurrencybykey2(key,el,lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate)
    {

        var currencylist;
        if(localStorage.getItem("currencylist")==null){
            currencylist=[];
        }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
        }

        for (let i = 0; i < currencylist.length; i++) {
            if(currencylist[i].skey==key){
                //debugger;
                $(el).val(currencylist[i].shortcut);
                $(el).attr('title', currencylist[i].id + ';' + currencylist[i].ratebuy + ';' + currencylist[i].ratesale + ';' + currencylist[i].optsign + ';' + currencylist[i].ismain + ';' + currencylist[i].isfn + ';' + currencylist[i].shortcut);
                getrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                return;
            }
        }
    }
    function getcurrencybyid(key,el)
    {
        var currencylist;
        if(localStorage.getItem("currencylist")==null){
            currencylist=[];
        }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
        }
        for (let i = 0; i < currencylist.length; i++) {
            if(currencylist[i].id==key){
                $(el).val(currencylist[i].shortcut);
                $(el).attr('title', currencylist[i].id + ';' + currencylist[i].ratebuy + ';' + currencylist[i].ratesale + ';' + currencylist[i].optsign + ';' + currencylist[i].ismain + ';' + currencylist[i].isfn + ';' + currencylist[i].shortcut);
                return;
            }
        }
    }
    function getcurrencybycountrycode(shortcut1,shortcut2,el)
    {
        var url="{{ route('getcurrencybyshortcut2') }}";
        $.get(url,{shortcut1:shortcut1,shortcut2:shortcut2},function(data){
              if(data['c1']!=null){
                  $(el).val(data['c1']['shortcut']);
                  $(el).attr('title', data['c1']['id'] + ';' + data['c2']['buy_thai'] + ';' + data['c2']['sale_thai'] + ';' + data['c1']['optsign'] + ';' + data['c1']['ismain'] + ';' + data['c1']['isfn'] + ';' + data['c1']['shortcut']);

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
    function runproductrate2_old(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate)
    {
            var url="{{ route('getproductrate') }}";
            var buycur = $(lblbuy).val();
            var salecur = $(lblsale).val();
            var curname = '';
            if ($(txtsign).val() == '+') {
                curname = buycur + '-' + salecur;
            } else {
                curname = salecur + '-' + buycur;
            }
            //alert(curname)
            $.get(url,{curname:curname},function(data){
                if(data.success){
                    if($('#countrycode').val()=='+66'){
                      $(txtrate).val(formatNumber(parseFloat(data['pr']['thai_rate']),6));
                      $(txtrate).attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['thai_rate'] + ';' +  data['pr']['operator']);
                    }else{
                      $(txtrate).val(formatNumber(parseFloat(data['pr']['rate']),6));
                      $(txtrate).attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                    }
                    if(txtbuy.val()!='' || txtsale.val()!=''){
                        calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                    }
                }else{
                    $(txtrate).val('');
                    $(txtrate).attr('title','');
                }
                console.log(data)
            })

            $(lblrate).attr('title',$(txtrate).val());
            $(lblrate).val($(txtrate).val());
            //dolabelcico();
    }
     function runproductrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate)
    {
        var buycur = $(lblbuy).val();
        var salecur = $(lblsale).val();
        var curname = '';
        if ($(txtsign).val() == '+') {
            curname = buycur + '-' + salecur;
        } else {
            curname = salecur + '-' + buycur;
        }
        var currencylist;
        if(localStorage.getItem("currencyproductlist")==null){
            currencylist=[];
        }else{
            currencylist=JSON.parse(localStorage.getItem("currencyproductlist"));
        }
        $(txtrate).val('');
        $(txtrate).attr('title','');
        currencylist.forEach(function(c){
            if(c.pshortcut==curname){
                $(txtrate).val(parseFloat(c.rate));
                $(txtrate).attr('title', c.pshortcut + ';' +  c.rate + ';' +  c.operator);
                if(txtbuy.val()!='' || txtsale.val()!=''){
                    calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
            }
        })
        $(lblrate).attr('title',$(txtrate).val());
        $(lblrate).val($(txtrate).val());
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
            //dolabelcico();
        }
        function getrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger;
            $(txtrate).attr('title', '');
            var m = $(lblbuy).attr('title').split(";");
            var p = $(lblsale).attr('title').split(";");
            if(m=='' || p==''){
                //alert('can not save')
                return;
            }
            //check if the save curname
            //debugger
            if (m[6] == p[6]) {
                $(txtrate).val(1);
                if(txtbuy.val()!='' || txtsale.val()!=''){
                    calcuexchange2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
                return;
            }
            //check if product exchange product
            if (m[4] == '0') {
                if (p[4] == '0') {
                    runproductrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                    return;
                }
            }
            if ($(txtsign).val() == '+') {
                if (m[4] == '1') {//if maincur=true
                    $(txtrate).val(formatNumber(parseFloat(p[2]),6));//get rate p sale
                } else {
                    $(txtrate).val(formatNumber(parseFloat(m[1]),6));//get rate m buy
                }

            } else {
                if (m[4] == '1') {
                    $(txtrate).val(formatNumber(parseFloat(p[1]),6));
                } else {
                    $(txtrate).val(formatNumber(parseFloat(m[2]),6));
                }

            }
            $(lblrate).attr('title',$(txtrate).val());
            $(lblrate).val($(txtrate).val());
            if(txtbuy.val()!='' || txtsale.val()!=''){
                calcuexchange2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
            }
            //dolabelcico();
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
        function calcuexchangeproduct1() {
            //debugger;
            var luy = $('#txtsale').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var rs = $('#txtrate').attr('title').split(";");
            if ($('#txtsign').val() == '+') {
                if (rs[2] == '*') {
                    $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $('#txtbuy').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }
            } else {
                if (rs[2] == '*') {
                    $('#txtbuy').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            }
        }
        function calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger;
            var luy = $(txtbuy).val().replace(/,/g, '');
            var r = $(txtrate).val().replace(/,/g, '');
            var rs = $(txtrate).attr('title').split(";");
            if ($(txtsign).val() == '+') {
                if (rs[2] == '*') {
                    $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (rs[2] == '*') {
                    $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }
            }
        }
        function calcuexchangeproduct3(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger;
            var luy = $(txtsale).val().replace(/,/g, '');
            var r = $(txtrate).val().replace(/,/g, '');
            var rs = $(txtrate).attr('title').split(";");
            if ($(txtsign).val() == '+') {
                if (rs[2] == '*') {
                    $(txtbuy).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $(txtbuy).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }
            } else {
                if (rs[2] == '*') {
                    $(txtbuy).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $(txtbuy).val(formatNumber(parseFloat(luy / r).toFixed(2)));
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
        function calcuexchange2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger
            var luy = $(txtbuy).val().replace(/,/g, '');
            var r = $(txtrate).val().replace(/,/g, '');
            var m1 = $(lblbuy).attr('title').split(";");
            var m2 = $(lblsale).attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    } else {
                        $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                    }
                } else {
                    calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
            }
        }
        function calcuexchange3(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger
            // $('#txtcashreceive').val('');
            // $('#txtcashreturn').val('');
            var luy = $(txtsale).val().replace(/,/g, '');
            var r = $(txtrate).val().replace(/,/g, '');
            var m1 = $(lblsale).attr('title').split(";");
            var m2 = $(lblbuy).attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    $(txtbuy).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $(txtbuy).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $(txtbuy).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    } else {
                        $(txtbuy).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                    }
                } else {
                    calcuexchangeproduct3(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
            }
        }
        function calcuexchange1() {
            //debugger
            $('#txtcashreceive').val('');
            $('#txtcashreturn').val('');
            var luy = $('#txtsale').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var m1 = $('#lblsale').attr('title').split(";");
            var m2 = $('#lblbuy').attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    $('#txtbuy').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    } else {
                        $('#txtbuy').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                    }
                } else {
                    calcuexchangeproduct1();
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
            var url="{{ route('getmultiexchangelist') }}";
            $.get(url,{},function(data){
                $('#multiexchangecard').empty().html(data);
            })
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
        function isElementVisible(element) {
            return element.offsetWidth > 0 && element.offsetHeight > 0;
        }
        function refill_tbl_in(callback)
        {
            var amt=0;
            var cur='';
            var curid=0;
            var exno=0;
            var cuscharge_usd=$('#cuscharge').val().replace(/,/g, '');
            $('.action1').each(function(i,e){
            //debugger;
                var act=$(this).text();
                if(act==''){
                    if(parseFloat(amt)==0){
                        amt=$('.amt1').eq(i).text().replace(/,/g, '');
                        cur=$('.cur1').eq(i).text();
                        exno=$('.no1').eq(i).text();

                        if(cur=='USD' && $('#selcur1 option:selected').text()=='USD'){
                            amt=parseFloat(amt) + parseFloat(cuscharge_usd);
                        }
                        var currencylist;
                        if(localStorage.getItem("currencylist")==null){
                            currencylist=[];
                        }else{
                            currencylist=JSON.parse(localStorage.getItem("currencylist"));
                        }
                        currencylist.forEach(function(c){
                            if(c.shortcut==cur){
                            curid=c.id;
                            }
                        })
                    }
                }

            })
            $('.bankamt').each(function(i,e){
                //debugger;

                if($('.bankamt').eq(i).val()==''){
                    $('.bankamt').eq(i).val(formatNumber(amt));
                    $('.bankcur').eq(i).val(curid);
                }
            })
            callback(exno,1);

      }
      function updatetbl_in(n,v){
        $('.no1').each(function(i,e){
            var no=$(this).text();
            if(no==n){
              $('.action1').eq(i).text(v);
            }
        })
      }
      function resetaction1(){
        $('.no1').each(function(i,e){
          $('.action1').eq(i).text('');
        })
      }
        function autofillbankamt()
        {
            //debugger;
            var totalbankamt=0;
            let j=0;
            var lbl_title='';
            var cur3='';
            var trancode=$('#trancode1').val();
            var cuscharge_usd=$('#cuscharge').val().replace(/,/g, '');
            var transferamt=$('#amount').val().replace(/,/g, '');
            var curid=$('#selcur').val();
            var curid1=$('#selcur1').val();
            if(curid==curid1){
                if(trancode==-1){
                    transferamt =parseFloat(transferamt)- parseFloat(cuscharge_usd);
                }else{
                    transferamt =parseFloat(transferamt)+ parseFloat(cuscharge_usd);
                }
            }
            var hasexchange=$('#hasexchange').val();
            var hasexchange2=$('#hasexchangefix').val();
            //debugger;
            var hasbankpayment=$('#hasbankpayment').val();
            let elem = document.getElementById("tablemultiexchange");

            let tblmultiexchangeisshow=isElementVisible(elem);
            if(tblmultiexchangeisshow==true){
                refill_tbl_in(updatetbl_in);
                return;
            }

            if(hasexchange2==1){
              $('.txtsalefix').each(function(i,e){
                bamt=$('.txtsalefix').eq(i).val().replace(/,/g, '');
                if(isNumber(bamt) && bamt!=0){
                    transferamt=bamt;
                    lbl_title=$('.lblsalefix').eq(i).attr('title');
                    cur3=$('.lblsalefix').eq(i).val();
                    curid=lbl_title.split(';')[0];
                    if(cur3=='USD' && $('#selcur1 option:selected').text()=='USD'){
                        bamt=parseFloat(bamt) + parseFloat(cuscharge_usd);
                    }
                    if(hasbankpayment==1){
                        if($('.bankamt').eq(j).val()==0 || $('.bankamt').eq(j).val()==''){
                            $('.bankamt').eq(j).val(formatNumber(bamt));
                            $('.bankcur').eq(j).val(curid);
                        }else{

                            let emptyIndex = -1;

                            // loop once
                            $('.bankamt').each(function(i, e) {
                                let $amt = $(this);
                                let $cur = $('.bankcur').eq(i);

                                let bankamt = $amt.val().replace(/,/g, '') || 0;
                                let bankcur = $cur.find(':selected').text();

                                totalbankamt += (cur3 == bankcur) ? parseFloat(bankamt) : 0;

                                // remember first empty field
                                if (emptyIndex === -1 && !$amt.val()) {
                                    emptyIndex = i;
                                }
                            });

                            // calculate left amount
                            let leftamt = parseFloat(transferamt) - parseFloat(totalbankamt);

                            // auto-fill only first empty row if leftamt > 0
                            if (leftamt > 0 && emptyIndex !== -1) {
                                $('.bankamt').eq(emptyIndex).val(formatNumber(leftamt));
                                $('.bankcur').eq(emptyIndex).val(curid);
                            }

                        }
                        //  $('.bankamt').each(function(i,e){
                        //         let bankamt=$('.bankamt').eq(i).val().replace(/,/g,'');
                        //         let bankcur=$('.bankcur option:selected').eq(i).text();
                        //         if(bankamt=='') bankamt=0;
                        //         if(cur3==bankcur){
                        //             totalbankamt += parseFloat(bankamt);
                        //         }

                        // })
                        // let leftamt=parseFloat(transferamt)- parseFloat(totalbankamt);
                        //  $('.bankamt').each(function(i,e){
                        //      if(leftamt>0){
                        //          if($('.bankamt').eq(i).val()==''){
                        //             $('.bankamt').eq(i).val(formatNumber(leftamt));
                        //             $('.bankcur').eq(i).val(curid);
                        //         }
                        //      }
                        //  })
                    }else{
                        $('#amountcontinue').val(formatNumber(bamt));
                        $('#amountcontinue').attr('title',bamt);
                        $('#selcurcontinue').val(curid);
                    }
                    j=j+1;
                }else{

                }
                totalbankamt=0;
              })
              return;
            }else{
              if(hasexchange==1){
                if($('#txtsign').val()=='+'){
                  transferamt=$('#txtbuy').val().replace(/,/g, '');
                  curid=$('#lblbuy').attr('title').split(';')[0];
                }else{
                  transferamt=$('#txtsale').val().replace(/,/g, '');
                  curid=$('#lblsale').attr('title').split(';')[0];
                }
              }else if(hasexchange==2){

              }else{

              }
            }

            var getamt=transferamt.toString().replace(/,/g,'');

            if(hasbankpayment==1){
                $('.bankamt').each(function(i,e){
                    //debugger;
                    let bankamt=$('.bankamt').eq(i).val().replace(/,/g,'');
                    if(bankamt=='') bankamt=0;
                    totalbankamt += parseFloat(bankamt);
                    let nextamt=parseFloat(getamt)-parseFloat(totalbankamt);
                    if(nextamt<0) nextamt=0;
                    if($('.bankamt').eq(i).val()==''){
                        $('.bankamt').eq(i).val(formatNumber(nextamt));
                        $('.bankcur').eq(i).val(curid);
                    }
              })
            }else{
                $('#amountcontinue').val(formatNumber(getamt));
                $('#amountcontinue').attr('title',getamt);
                $('#selcurcontinue').val(curid);
            }
        }
        function autofillamtcontinue()
        {
            //debugger;
           let j=0;
            var lbl_title=''
            var transferamt=$('#amount').val().replace(/,/g,'');
            var curid=$('#selcur').val();
            var hasexchange=$('#hasexchange').val();
            var hasexchange2=$('#hasexchangefix').val();
            if(hasexchange2==1){
              $('.txtsalefix').each(function(i,e){
                bamt=$('.txtsalefix').eq(i).val().replace(/,/g, '');
                if(isNumber(bamt)){
                  transferamt=bamt;
                  lbl_title=$('.lblsalefix').eq(i).attr('title');
                  curid=lbl_title.split(';')[0];
                  if($('#amountcontinue').eq(i).val()==0 || $('#amountcontinue').eq(i).val()==''){
                    $('#amountcontinue').eq(i).val(formatNumber(bamt));
                    $('#selcurcontinue').eq(i).val(curid);
                  }
                }else{

                }
              })
              return;
            }else{
              if(hasexchange==1){
                if($('#txtsign').val()=='+'){
                  transferamt=$('#txtbuy').val().replace(/,/g, '');
                  curid=$('#lblbuy').attr('title').split(';')[0];
                }else{
                  transferamt=$('#txtsale').val().replace(/,/g, '');
                  curid=$('#lblsale').attr('title').split(';')[0];
                }
              }else if(hasexchange==2){

              }
            }

            $('#amountcontinue').val(formatNumber(transferamt));
            $('#selcurcontinue').val(curid);
            // $('#cuscharge2').val(0);
            // $('#totalcash2').val(formatNumber(transferamt));

        }
        function addrow(){
            //var nn=$('#tbl_bankpayment tr').length+1;
            var table = document.getElementById("tbl_bankpayment");
            var nn=table.tBodies[0].rows.length+1;
            let tst = Math.round(Date.now() / 1000)+nn;
            var row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh16">${nn}</td>
                        <td style="width:250px;padding:0px;">
                            <select name="bankid[]" class="form-select select2-option1 bankid" id="bankid${nn}"  style="width:250px;"></select>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control bankname kh16" style="" name="bankname[]">
                        </td>
                        <td style="padding:0px;width:180px;">
                            <input type="text" class="form-control tdcanenter bankamt kh16-b" style="text-align:right;height:30px;width:180px;" name="bankamt[]">
                        </td>
                        <td style="width:80px;padding:0px;">
                            <select name="bankcur[]" class="bankcur kh16" id="bankcur${nn}" style="width:80px;height:30px;"></select>
                        </td>
                         <td style="text-align:center;padding:2px 0px;">
                          <a href="#" class="btn btn-danger btn-sm remove" style="border-radius:15px;height:25px;width:25px;color:white;"><span style="position:relative;top:-18px;left:-3px;font-size:32px;font-weight:bold;">-</span></a>
                        </td>
                         <td style="padding:0px;width:100px;">
                            <input type="text" class="form-control tdcanenter bankcuscharge kh16-b" style="text-align:right;height:30px;width:100px;" name="bankcuscharge[]" placeholder="charge" value="0" title="customercharge">
                        </td>
                        <td style="padding:0px;width:100px;">
                            <input type="text" class="form-control tdcanenter bankpartnerfee kh16-b" style="text-align:right;height:30px;width:100px;" name="bankpartnerfee[]" placeholder="fee" value="0" title="partner fee">
                        </td>
                    </tr>`;
                $('#body_bankpayment').append(row);

                //$('.unit option').remove();

                $('#selcur option').clone().appendTo('#bankcur'+nn);
                $('#selbank option').clone().appendTo('#bankid'+nn);
                $('#bankid'+nn).select2({
                  templateResult: formatOption1
                });
                $('.bankamt').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
                $('.bankpartnerfee').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
                $('.bankcuscharge').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
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

    $("#tableSearch").on("keyup", function () {
        var rawInput = $(this).val().toUpperCase().trim();
        var currencySymbol = '';
        if (rawInput.includes('$')) currencySymbol = '$';
        else if (rawInput.includes('R') || rawInput.includes('៛')) currencySymbol = 'R';

        var cleanInput = rawInput.replace(/[^0-9.\-]/g, '');
        var rangeMatch = cleanInput.match(/^(-?\d+(?:\.\d+)?)\-(-?\d+(?:\.\d+)?)$/);
        var isRange = rangeMatch !== null;

        var min = isRange ? Math.abs(parseFloat(rangeMatch[1])) : null;
        var max = isRange ? Math.abs(parseFloat(rangeMatch[2])) : null;

        $("#tbl_transferlist tr").each(function (index) {
            if (index !== 0) {
                var $row = $(this);
                var matchFound = false;

                $row.find('td').each(function () {
                    var cell = $(this);
                    var cellText = cell.text().toUpperCase();
                    var inputValue = cell.find('input').val() || '';

                    var fullText = cellText + " " + inputValue;

                    if (isRange) {
                        if (!fullText.includes(currencySymbol)) return;

                        var numberOnly = fullText.replace(/[^\d.]/g, '');
                        var num = parseFloat(numberOnly);
                        var absNum = Math.abs(num);

                        if (!isNaN(absNum) && absNum >= min && absNum <= max) {
                            matchFound = true;
                            return false;
                        }
                    } else {
                        var searchText = rawInput.replace(/[ ,\-]/g, ''); // remove minus too
                        var target = fullText.replace(/[ ,\-]/g, '');
                        if (target.includes(searchText)) {
                            matchFound = true;
                            return false;
                        }
                    }
                });

                $row.toggle(matchFound);
            }
        });
    });

</script>
