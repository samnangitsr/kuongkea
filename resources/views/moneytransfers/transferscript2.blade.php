<script type="text/javascript">
    var pathname=window.location.pathname.split("/");
    savewingratetostorage();

    $('#h1_title').text('វេរតាមភ្នាក់ងារ');
    var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-192;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
    $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-192;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
    });
    function reply_click(btn,id)
      {
        $('.btntranname').removeClass('bkaqua');
        $(btn).addClass('bkaqua');
        $('#seltranname').val(id);
        $('#seltranname').trigger('change');
        $('#amount').focus();
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

    function savephonetolocalstorage(callback){
        localStorage.removeItem("recphonelist");
        localStorage.removeItem("sendphonelist");
        localStorage.removeItem("recnamelist");
        var url="{{ route('phonenumberlocalstorage') }}";
        $.get(url,{},function(data){
        //console.log(data);
        var recphonelist;
        var sendphonelist;
        var recnamelist;
        if(localStorage.getItem("recphonelist")==null){
            recphonelist=[];
        }else{
            recphonelist=JSON.parse(localStorage.getItem("recphonelist"));
        }
        if(localStorage.getItem("recnamelist")==null){
            recnamelist=[];
        }else{
            recnamelist=JSON.parse(localStorage.getItem("recnamelist"));
        }
        $.each(data['recphonelist'],function(i,item){
            recphonelist.push({
                value:item.rectel,
                label:item.rectel,
                recname:item.recname,
            })
            recnamelist.push({
                value:item.recname,
                label:item.recname,
                rectel:item.rectel,
            })
        });

        localStorage.setItem("recphonelist",JSON.stringify(recphonelist));
        localStorage.setItem("recnamelist",JSON.stringify(recnamelist));

        // sender phone
        if(localStorage.getItem("sendphonelist")==null){
            sendphonelist=[];
        }else{
            sendphonelist=JSON.parse(localStorage.getItem("sendphonelist"));
        }
        $.each(data['sendphonelist'],function(i,item){
            sendphonelist.push({
                sendertel:item.sendertel,
                sendername:item.sendername,
            })
        });
        localStorage.setItem("sendphonelist",JSON.stringify(sendphonelist));
        callback();
        })
    }

    $(document).ready(function () {
        savephonetolocalstorage(autocomplereceiver);
        gettranname(seltranname,seltranname1);
        $('.table-responsive').on('show.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "inherit" );
        });

        $('.table-responsive').on('hide.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "auto" );
        })

        // $('#selpartner').select2({templateResult: formatOption});
         $('#selpartner2').select2({templateResult: formatOption});
        $('#selpartner').select2();

        //$('#selpartner2').select2();
        $('#seltranname').select2();

        var today=new Date();
        $('#invdate,#invdate1').datetimepicker({
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
      gettransferlist();
      getbalwing($('#selpartner').val(),'',fillbalance);
      function checkright()
      {
          var role=$('#txtrole').val();
          if(role!='Admin'){
            $('#invdate').datetimepicker("destroy");
          }
      }
       var cleave_amount_continue = new Cleave('#amount_continue', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
        var cleave = new Cleave('#amount', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
          var cleave = new Cleave('#fee', {
              numeral: true,
              //numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
          var cleave = new Cleave('#partnerfee', {
              numeral: true,
              numeralDecimalScale: 6,
              //numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
          var cleave = new Cleave('#cuscharge', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralDecimalScale: 6,
              numeralThousandsGroupStyle: 'thousand'
          });
          var cleave = new Cleave('#balance', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
          });
          $(document).on('keydown', '.canenter', function (e) {
          if (e.keyCode == 13) {
              var id = $(this).attr("id");
              if (id == 'amount') {
                  $('#cuscharge').focus();

              } else if(id == 'cuscharge'){
                $('#fee').focus();
              } else if (id == 'fee'){
                  $('#btnsavetransfer').focus();
              } else if(id=='sendertel'){
                  $('#sendername').focus();
              }else if(id=='sendername'){
                 $('#rectel').focus();
              }else if(id=='rectel'){
                $('#recname').focus();
              }else if(id=='recname'){
                $('#amount').focus();
              }else if(id=='amount_continue'){
                 $('#btnsavetransfer').focus();
              }
              e.preventDefault();
          }
      })
      $(document).on('click','#tbl_transferlist td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
      $(document).on('change','#selpartner',async function(e){
        e.preventDefault();
        var cur=$('#selcur option:selected').text();
        if($('#id1').val()==''){
            await gettranname(seltranname,seltranname1);
            getbalwing($(this).val(),cur,fillbalance);
        }
        $('#selaccount').val($(this).val());

      })
      $('input[type=radio][name=radcustype1]').change(function(e) {
            e.preventDefault();
            //console.log('change')
            getpartner(this.value,'#selpartner','#selaccount');
        });
        function getpartner(type,el,el1)
        {

            var url="{{ route('getpartnerbytype') }}";
            $(el).empty();
            $(el1).empty();
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
                            agenttype:item.agent_type_id,
                            countrycode:item.tel,
                            maxtransfer:item.agenttype.transfer_amount,
                            maxcuscharge:item.agenttype.customer_fee,
                            maxfee:item.agenttype.cashdraw_fee,
                            maxtransferfee:item.agenttype.transfer_fee,
                            userconnect:item.user_connect,
                            thai_list:item.thai_list,

                        }))
                        $(el1).append($("<option/>",{
                            value:item.id,
                            text:item.name,
                            customertype:item.customertype,
                            agenttype:item.agent_type_id,
                            countrycode:item.tel,
                            maxtransfer:item.agenttype.transfer_amount,
                            maxcuscharge:item.agenttype.customer_fee,
                            maxfee:item.agenttype.cashdraw_fee,
                            maxtransferfee:item.agenttype.transfer_fee,
                            userconnect:item.user_connect,
                            thai_list:item.thai_list,

                        }))
                    //console.log(item)
                });
                $(el).select2('open');

            })
        }
      function cleartext()
      {
        $('#balance').attr('title','');
        $('#balance').val('');
        $('#balancenext').val('');
        $('#amount').val('');
        $('#cuscharge').val('0');
        $('#totalcash').val('0');
        $('#fee').val('0');

      }
      function getbalwing(cid,cur,callback)
      {
        //debugger;
        $('body').addClass("wait");
        $('#balance').attr('title','');
                var d2=moment(new Date).format("YYYY-MMM-DD");
                var op='<=';
                var url="{{ route('closelist.summarypartnerlist') }}";
                $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {cid:cid,showdate:d2,op:op},
                success: function (data) {
                    //console.log(data)
                       //cleartext();
                    if($.isEmptyObject(data.error)){
                        $('#balance').attr('title',data.usd+';'+data.khr+';'+data.thb);
                        callback();
                        // if(cur=='USD'){
                        //     $('#balance').val(formatNumber(Math.abs(data.usd)));
                        // }else if(cur=='KHR'){
                        //     $('#balance').val(formatNumber(Math.abs(data.khr)));
                        // }else if(cur=='THB'){
                        //     $('#balance').val(formatNumber(Math.abs(data.thb)));
                        // }
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
      function fillbalance()
      {
        //debugger;
        try{
            var amt=0;
            var fee=0;
            var total=0;
            var scc1=$('#s_acc1').val();
            amt=$('#amount').val().replace(/,/g, '');
            fee=$('#fee').val().replace(/,/g, '');
            total=parseFloat(amt)+parseFloat(fee);
            var bal=$('#balance').attr('title').replace(/,/g, '');
            var balance=bal.split(';');
            var cur=$('#selcur option:selected').text();

            var balnext=0;
            var balstart=0;
            var cur1='';
            if(scc1=='+'){
                if(cur=='USD'){
                    // $('#balancenext').val(formatNumber(parseFloat(balance[0])+parseFloat(total)));
                    // $('#balance').val(formatNumber(balance[0]));
                    balnext=-1 * (parseFloat(balance[0])- parseFloat(total));
                    balstart=-1 * parseFloat(balance[0]);
                    cur1=' USD';
                }else if(cur=='KHR'){
                    // $('#balancenext').val(formatNumber(parseFloat(balance[1])+parseFloat(total)));
                    // $('#balance').val(formatNumber(balance[1]));
                    balnext=-1 * (parseFloat(balance[1])- parseFloat(total));
                    balstart=-1 * parseFloat(balance[1]);
                    cur1=' KHR';
                }else if(cur=='THB'){
                    // $('#balancenext').val(formatNumber(parseFloat(balance[2])+parseFloat(total)));
                    // $('#balance').val(formatNumber(balance[2]));
                    balnext=-1 * (parseFloat(balance[2])- parseFloat(total));
                    balstart=-1 * parseFloat(balance[2]);
                    cur1=' THB';
                }

            }else{
                if(cur=='USD'){
                    // $('#balancenext').val(formatNumber(parseFloat(balance[0])-parseFloat(total)));
                    // $('#balance').val(formatNumber(balance[0]));
                    balnext=-1 * (parseFloat(balance[0])+ parseFloat(total));
                    balstart=-1 * parseFloat(balance[0]);
                    cur1=' USD';
                }else if(cur=='KHR'){
                    // $('#balancenext').val(formatNumber(parseFloat(balance[1])-parseFloat(total)));
                    // $('#balance').val(formatNumber(balance[1]));
                    balnext=-1 * (parseFloat(balance[1])+ parseFloat(total));
                    balstart=-1 * parseFloat(balance[1]);
                    cur1=' KHR';
                }else if(cur=='THB'){
                    // $('#balancenext').val(formatNumber(parseFloat(balance[2])-parseFloat(total)));
                    // $('#balance').val(formatNumber(balance[2]));
                    balnext=-1 * (parseFloat(balance[2])+ parseFloat(total));
                    balstart=-1 * parseFloat(balance[2]);
                    cur1=' THB';
                }
            }
            $('#balancenext').val(formatNumber(balnext));
            $('#balance').val(formatNumber(balstart));
            if(balstart>0){
                $('#balance').css('color','blue');
            }else{
                $('#balance').css('color','red');
            }
            if(balnext>0){
                $('#balancenext').css('color','blue');
            }else{
                $('#balancenext').css('color','red');
            }
        }catch{

        }

      }
        $(document).on('click','#btnshowbal',function(e){
            e.preventDefault();
            getbalwing($('#selpartner').val(),$('#selcur option:selected').text(),fillbalance);
        })
        function gettranname_old(el,el1)
      {
        //debugger;
        var sp = document.querySelector("#selpartner");
        var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
        var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
        $('body').addClass("wait");


                var url="{{ route('wingtransfer.gettransactionname') }}";
                $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {agenttype:agenttype},
                success: function (data) {
                    console.log(data)

                    if($.isEmptyObject(data.error)){
                        $(el).empty();
                        $(el1).empty();

                        $(el).append($("<option/>",{
                                value:'',
                                text:''
                            }))
                        $(el1).append($("<option/>",{
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
                        $(el1).append($("<option/>",{
                                value:item.id,
                                text:item.name,
                                sign:item.sign,
                                is_tc:item.is_tc??0,
                            }))
                        //console.log(item)
                    });
                    var td = '';
                    for (let i = 0; i < data['wtnp'].length; i++) {
                        td += `
                                <td>
                                    <button class="mybtn kh16-b btntranname" id="${data['wtnp'][i].id}" onClick="reply_click(this, '${data['wtnp'][i].id}')">
                                        ${data['wtnp'][i].name}
                                    </button>
                                </td>
                        `;
                    }
                    $('#row_tranname').empty().append(td);
                    //$(el).select2('open');
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
      function gettranname(el,el1) {
            return new Promise((resolve, reject) => {
                var sp = document.querySelector("#selpartner");
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
                            $(el1).empty();
                            $(el).append($("<option/>",{
                                value:'',
                                text:''
                            }))
                            $(el1).append($("<option/>",{
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
                                $(el1).append($("<option/>",{
                                        value:item.id,
                                        text:item.name,
                                        sign:item.sign,
                                        is_tc:item.is_tc??0,
                                    }))
                            });
                            var td = '';
                            for (let i = 0; i < data['wtnp'].length; i++) {
                                td += `
                                        <td>
                                            <button class="mybtn kh16-b btntranname" id="${data['wtnp'][i].id}" onClick="reply_click(this, '${data['wtnp'][i].id}')">
                                                ${data['wtnp'][i].name}
                                            </button>
                                        </td>
                                `;
                            }
                            $('#row_tranname').empty().append(td);
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
                                    $('#selpartner').trigger('change');
                                    gettransferlist();
                                    //countrecordsaved();
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
            $(document).on('click','#btnclosecontinue',function(e){
                e.preventDefault();
                $('#rowacc2').css('display','none');
                $('#row_amount_continue').css('display','none');
                $('#rowseltype').css('display','none');
                $('#btnclosecontinue').css('display','none');
            })
            $(document).on('click','#btncontinue',function(e){
                e.preventDefault();
                var sp = document.querySelector("#seltranname");
                var sign=sp.options[sp.selectedIndex].getAttribute('sign');
                $('#btnclosecontinue').css('display','table-row');
                // $('#s_acc1').attr('title',parseFloat(sign) * 4);
                // $('#s_acc2').attr('title',-4 * parseFloat(sign));
                $('#rowpartnerfee').css('display','table-row');
                $('#rowacc2').css('display','table-row');
                $('#row_amount_continue').css('display','table-row');
                $('#amount_continue').val(formatNumber($('#totalcash').val().replace(/,/g,'')));
                $('#rowseltype').css('display','table-row');
                if(sign==1){
                    $('#s_acc1').val("-");
                    $('#s_acc2').val("+");

                }else if(sign==-1){
                    $('#s_acc1').val("+");
                    $('#s_acc2').val("-");
                }

            })
      $(document).on('change','#seltranname',function(e){
            var sp = document.querySelector("#seltranname");
            var sign=sp.options[sp.selectedIndex].getAttribute('sign');
            $('#s_acc1').attr('title',sign);
            $('#s_acc2').attr('title',-1 * sign);
            $('#rowacc2').css('display','none');
            $('#rowpartnerfee').css('display','none');
            $('#rowseltype').css('display','none');
            $('#row_amount_continue').css('display','none');
            $('#btncontinue').css('display','none');
            $('#btnclosecontinue').css('display','none');

            document.getElementById('amount').removeAttribute('readonly');
            if(sign==1){
                $('#s_acc1').val("-");
                $('#btncontinue').css('display','table-row');
            }else if(sign==-1){
                $('#s_acc1').val("+");
                $('#btncontinue').css('display','table-row');
            }else if(sign==4){
                $('#rowpartnerfee').css('display','table-row');
                $('#rowacc2').css('display','table-row');
                $('#rowseltype').css('display','table-row');
                $('#row_amount_continue').css('display','table-row');

                $('#s_acc1').val("-");
                $('#s_acc2').val("+");
            }else if(sign==-4){
                $('#rowpartnerfee').css('display','table-row');
                $('#rowacc2').css('display','table-row');
                $('#rowseltype').css('display','table-row');
                $('#row_amount_continue').css('display','table-row');
                $('#s_acc1').val("+");
                $('#s_acc2').val("-");
            }
            $('#amount').val('');
            $('#amount_continue').val('');
            $('#cuscharge').val('');
            $('#totalcash').val('');
            $('#fee').val('');
            $('#partnerfee').val('0');
            $('#balance').val('');
            $('#balancenext').val('');
            $('#amount').attr('title','');
      })

      $('input[type=radio][name=radcustype]').change(function() {
            getpartner(this.value,'#selpartner2','');
        });
            // function getpartner(type,el)
            // {
            //     var url="{{ route('getpartnerbytype') }}";
            //     $(el).empty();
            //     $.get(url,{type:type},function(data){
            //         $(el).append($("<option/>",{
            //                     value:'',
            //                     text:''
            //                 }))
            //         $.each(data,function(i,item){
            //             $(el).append($("<option/>",{
            //                     value:item.id,
            //                     text:item.name,
            //                     customertype:item.customertype
            //                 }))
            //             //console.log(item)
            //         });
            //         $(el).select2('open');
            //     })
            // }
      $(document).on('change','#amount',function(e){
        cutwater(1);
        $('#amount').attr('title',$(this).val());
        //debugger;
        const row = document.getElementById('row_amount_continue');
        const isVisible = window.getComputedStyle(row).display !== 'none';
        if(isVisible){
            let amt=$('#amount').val().replace(/,/g,'');
            $('#amount_continue').val(formatNumber(amt));
        }
        refreshwingratefast(totalcash,fillbalance);

      })
      $(document).on('change','#cuscharge',function(e){
          cutwater(0);
      })
      $(document).on('change','#ckwater',function(e){
         cutwater(0);
         fillbalance();
      })
      $(document).on('change','#fee',function(e){
        fillbalance();
      })
     function findRates(agentTypeId, amount, tranNameId, cur) {
        let data = [];
        if (cur === 'USD') {
            data = JSON.parse(localStorage.getItem("wingrate_usd") || "[]");
        } else if (cur === 'KHR') {
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


      function refreshwingratefast(callback1,callback2)
      {
        //debugger;
        try{
            var sign=$('#s_acc1').attr('title');
            if(sign==4 || sign==-4){
                $('#cuscharge').val(0);
                $('#fee').val(0);
                callback2();
                return;
            }
            var totalcuscharge=0;
            var totalfee=0;
            var totaltransferfee=0;
            var amount=$('#amount').val().replace(/,/g, '');
            var wingcur=$('#selcur').val();
            var cur=$('#selcur option:selected').text();
            var sp = document.querySelector("#selpartner");
            var spn = document.querySelector("#seltranname");
            var is_tc=spn.options[spn.selectedIndex].getAttribute('is_tc');
            var trannameid=$('#seltranname').val();
            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
            var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
            var maxfee=sp.options[sp.selectedIndex].getAttribute('maxfee');
            var maxcuscharge=sp.options[sp.selectedIndex].getAttribute('maxcuscharge');
            var maxtransferfee=sp.options[sp.selectedIndex].getAttribute('maxtransferfee');

            if(trannameid=='' || agenttype=='' || cur=='' || amount=='' || amount==0){
                callback2();
                return;
            }

            if(customertype=='AGENT'){
                if (is_tc == 0) {
                    var response = findRates(agenttype, amount, trannameid, cur);

                    if (response.length > 0) {
                        let customerRate = response[0]['customer_rate'];
                        let fee = (sign == 1)
                            ? response[0]['transfer_rate']
                            : response[0]['cashdraw_rate'];

                        // 🔹 Handle Customer Rate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            $('#cuscharge').val((parseFloat(customerRate) * parseFloat(amount)) / 100);
                        } else {
                            $('#cuscharge').val(parseFloat(customerRate));
                        }

                        // 🔹 Handle Fee
                        if (typeof fee === "string" && fee.includes("%")) {
                            fee = fee.replace("%", "").trim();
                            $('#fee').val((parseFloat(fee) * parseFloat(amount)) / 100);
                        } else {
                            $('#fee').val(parseFloat(fee));
                        }
                    }
                    callback1();
                    callback2();
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
                var somnal=$('#amount').val().replace(/,/g, '');
            }

            if(somnal!==0 && isNaN(somnal)==false){
                // var wingrate;
                // if(cur=='USD'){
                //     if(localStorage.getItem("wingrate_usd")==null){
                //         wingrate=[];
                //     }else{
                //         wingrate=JSON.parse(localStorage.getItem("wingrate_usd"));
                //     }

                // }else if(cur=='KHR'){
                //     if(localStorage.getItem("wingrate_khr")==null){
                //         wingrate=[];
                //     }else{
                //         wingrate=JSON.parse(localStorage.getItem("wingrate_khr"));
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
                        $('#fee').val();
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
                //                     $('#fee').val();
                //                 }
                //                 founditem=1;
                //                 break;
                //             }
                //         }
                //     }
                // }
            }
            $('#cuscharge').val(formatNumber(totalcuscharge,4));
            $('#fee').val(formatNumber(totalfee,4));
            callback1();
            callback2();
        }catch{

        }
      }

      function refreshwingrate(callback1,callback2)
      {
        //debugger;
        try{
            var sign=$('#s_acc1').attr('title');
            if(sign==4 || sign==-4){
                $('#cuscharge').val(0);
                $('#fee').val(0);
                return;
            }
            var amount=$('#amount').val();
            var cur=$('#selcur option:selected').text();
            var sp = document.querySelector("#selpartner");
            var trannameid=$('#seltranname').val();
            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
            var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
            var maxfee=sp.options[sp.selectedIndex].getAttribute('maxfee');
            var maxcuscharge=sp.options[sp.selectedIndex].getAttribute('maxcuscharge');

            if(trannameid=='' || agenttype=='' || cur=='' || amount=='' || amount==0){
                return;
            }

            var url="{{ route('moneytransfer.getwingrate') }}";
                $.get(url,{agenttype:agenttype,amount:amount,cur:cur,trannameid:trannameid},function(data){
                    console.log(data)
                    //debugger;
                    if(data['wingrate']!==null){
                        if(sign==1){
                            $('#cuscharge').val(data['wingrate'].customer_rate);
                            $('#fee').val(data['wingrate'].customer_rate-data['wingrate'].transfer_rate);
                        }else if(sign==-1){
                            $('#cuscharge').val(0);
                            $('#fee').val(data['wingrate'].cashdraw_rate);
                        }
                    }else{
                        var maxamtstr=maxtransfer.replace(/,/g,'');
                        var maxfeestr=maxfee.replace(/,/g,'');
                        var maxcuschargestr=maxcuscharge.replace(/,/g,'');

                        var maxamtby=maxamtstr.split('/');
                        var maxfeeby=maxfeestr.split('/');
                        var maxcuschargeby=maxcuschargestr.split('/');

                        var maxamt2=0;
                        var maxfee2=0;
                        var maxcuscharge2=0;
                        if(cur=='USD'){
                             maxamt2=maxamtby[0];
                             maxfee2=maxfeeby[0];
                             maxcuscharge2=maxcuschargeby[0];
                        }

                        if(cur=='KHR'){
                            maxamt2=maxamtby[1];
                             maxfee2=maxfeeby[1];
                             maxcuscharge2=maxcuschargeby[1];
                        }
                        if(cur=='THB'){
                            maxamt2=maxamtby[2];
                            maxfee2=maxfeeby[2];
                            maxcuscharge2=maxcuschargeby[2];
                        }
                        var amount=$('#amount').val().replace(/,/g, '');
                        var wingcur=$('#selcur').val();

                        if(maxamt2==0) return;
                        var result=Math.floor(amount / maxamt2);
                        var somnal=amount % maxamt2;
                        var totalcuscharge=0;
                        var totalfee=0;
                        for(let i=0;i<result;i++){
                            totalcuscharge+=parseFloat(maxcuscharge2);
                            totalfee+=parseFloat(maxfee2);
                        }
                        if(somnal!==0 && isNaN(somnal)==false){
                            //debugger;
                            $.get(url,{agenttype:agenttype,amount:somnal,cur:cur,trannameid:trannameid},function(data){
                                if(sign==1){
                                    totalcuscharge+=parseFloat(data['wingrate'].customer_rate);
                                    totalfee+=parseFloat(data['wingrate'].customer_rate)-parseFloat(data['wingrate'].transfer_rate);

                                }else if(sign==-1){
                                    totalfee+=data['wingrate'].cashdraw_rate
                                    $('#fee').val();
                                }


                            })
                        }
                        $('#cuscharge').val(totalcuscharge);
                        $('#fee').val(totalfee);
                        callback1();
                        callback2();

                    }

                })
        }catch{

        }
      }
      function cutwater(isamtkeyup)
      {
          if(isamtkeyup!=1){
              var ck = document.getElementById("ckwater").checked;
              var amt=$('#amount').attr('title').replace(/,/g, '');
              var cur=$('#selcur').val();
              var cur1=$('#selcur1').val();
              var cuscharge=$('#cuscharge').val().replace(/,/g, '');
              if(ck==true){
                  //var cur=$('#selcur option:selected').text();
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
          var cur1=$('#selcur1 option:selected').text();
          var cuscharge=$('#cuscharge').val().replace(/,/g, '');
          if(cuscharge=='') cuscharge=0;
          if(amt=='') amt=0;
          if(cur==cur1){
              totalcash=parseFloat(amt)+parseFloat(cuscharge);
          }else{
            totalcash=parseFloat(amt);
          }

          $('#totalcash').val(formatNumber(parseFloat(totalcash)));
      }
        $(document).on('keyup','#amount',function(e){
              const C = e.key;
              if (C === "Backspace"){
                  return;
              }
              if(isNumber(C)==false){
                  getcurrencybykeylocalstorage(C,'#selcur');
              }
          })

          $(document).on('keyup','#cuscharge',function(e){
              const C = e.key;
              if (C === "Backspace"){
                  return;
              }
              if(isNumber(C)==false){
                  getcurrencybykeylocalstorage(C,'#selcur1');
              }
          })

          $(document).on('change','#selcur',function(e){

            e.preventDefault();
            var cur=$('#selcur option:selected').text();
            $('#selcur1').val($(this).val());
            $('#selcur_continue').val($(this).val());
            $('#txtcur2').val(cur);
            $('#txtcur3').val(cur);
            $('#txtcur4').val(cur);
            $('#txtcur5').val(cur);
            $('#txtcur6').val(cur);
            // var cur=$('#selcur option:selected').text();
            // var cid=$('#selpartner').val();
            // if(cid!=''){
            //     getbalwing(cid,cur);
            // }
            getcurrencybyidlocalstorage($(this).val(),'#selcur')
            refreshwingratefast(totalcash,fillbalance);


        })
        $(document).on('change','#selcur1',function(e){
            cutwater(0);
        })
        const cloneOptions = (sourceSelectId, targetSelectId) => {
            const sourceSelect = document.getElementById(sourceSelectId);
            const targetSelect = document.getElementById(targetSelectId);

            // Clear existing options in target select
            targetSelect.innerHTML = '';

            // Clone options from source to target
            Array.from(sourceSelect.options).forEach(option => {
                const newOption = new Option(option.text, option.value);
                targetSelect.add(newOption);
            });
        };
      $(document).on('click','.btnedit',function(e){

        e.preventDefault();
        cloneOptions('seltranname1', 'seltranname');
        $('#id1').val('');
        $('#id2').val('');
        $('#seltranname').prop('disabled', false);
        $('#btnsavetransfer').text('កែប្រែ')
        var id=$(this).data('id');
        var groupid=$(this).data('groupid');
        var url="{{ route('moneytransfer.wingedit') }}";
        $.get(url,{id:id,groupid:groupid},function(data){
            console.log(data)
            //document.getElementById("seltranname").disabled = true;
            //debugger;
            const selectElement = document.getElementById('seltranname');
            const valueToKeep = data['transfer1'].tranname_id;
            Array.from(selectElement.options).forEach(option => {
                if (parseFloat(option.value) !== parseFloat(valueToKeep)) {
                    option.disabled = true;
                }else{
                    option.disabled = false;
                }
            });
            //debugger;
            $(".btntranname").prop('disabled', true);
            $('#id1').val(data['transfer1'].id);
            $('#rowseltype').css('display','none');
            $('#rowacc2').css('display','none');
            $('#rowpartnerfee').css('display','none');

            $('#selpartner').val(data['transfer1'].parrent_id);
            $('#selpartner').trigger('change');
            $('#seltranname').val(data['transfer1'].tranname_id);
            $('#seltranname').trigger('change');
            $('#sendertel').val(data['transfer1'].sendertel);
            $('#sendername').val(data['transfer1'].sendername);
            $('#rectel').val(data['transfer1'].rectel);
            $('#recname').val(data['transfer1'].recname);
            $('#amount').val(formatNumber(parseFloat(data['transfer1'].mekun) * parseFloat(data['transfer1'].amount)));
            $('#selcur').val(data['transfer1'].currency_id);
           // $('#selcur').trigger('change');
            $('#cuscharge').val(formatNumber(parseFloat(data['transfer1'].mekun) * parseFloat(data['transfer1'].cuscharge)));
            $('#selcur1').val(data['transfer1'].cuscharge_currency_id);
            $('#fee').val(formatNumber(parseFloat(data['transfer1'].mekun) * parseFloat(data['transfer1'].fee)));
            $('#totalcash').val(formatNumber(parseFloat(data['transfer1'].mekun) * (parseFloat(data['transfer1'].amount)+parseFloat(data['transfer1'].cuscharge))));
            $('#txtcur2').val($('#selcur option:selected').text());
            $('#txtcur3').val($('#selcur option:selected').text());
            $('#txtcur4').val($('#selcur option:selected').text());
            $('#txtcur5').val($('#selcur option:selected').text());
            $('#invdate').val(moment(data['transfer1'].dd).format("DD-MM-YYYY"));
            $('#s_acc1').attr('title',data['transfer1'].trancode);
            if(parseFloat(data['transfer1'].trancode)<0){
                $('#s_acc1').val('+');
            }else{
                $('#s_acc1').val('-');
            }
            if(data['transfer1'].wingbal==null){
                $('#balance').val(0);
                $('#balancenext').val(0);

            }else{
                $('#balance').val(formatNumber(data['transfer1'].wingbal));
                $('#balancenext').val(formatNumber(data['transfer1'].wingbal));
            }
            if(data['transfer2']!==null){
                $('#rowseltype').css('display','table-row');
                $('#rowacc2').css('display','table-row');
                $('#rowpartnerfee').css('display','table-row');
                $('#id2').val(data['transfer2'].id);
                $('#selpartner2').val(data['transfer2'].parrent_id);
                $('#selpartner2').trigger('change');
                $('#partnerfee').val(formatNumber(parseFloat(data['transfer2'].mekun) * parseFloat(data['transfer2'].fee)));
                $('#selpartner2').trigger('change');

                $('#s_acc2').attr('title',data['transfer2'].trancode);
                if(parseFloat(data['transfer2'].trancode)<0){
                $('#s_acc2').val('+');
                }else{
                    $('#s_acc2').val('-');
                }
            }

        })
      })
      $(document).on('click','#btnsearch',function(e){
        e.preventDefault();
        gettransferlist();
      })
      $(document).on('change','#seluser,#selaccount',function(e){
        e.preventDefault();
        gettransferlist();
      })
      $(document).on('click','#btnsavetransfer',function(e){
        e.preventDefault();
        var buttontext=$(this).text();
        $(this).attr('disabled', true).text("Processing");
        func_savetransfer($(this),buttontext);
      })
      $(document).on('click','#btnrefresh',function(e){
        e.preventDefault();
        gettransferlist();
        countrecordsaved();
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
      function func_savetransfer(el,buttontext)
      {
          $('body').addClass("wait");
          //var cklockdata = document.getElementById("cklockdata").checked;
        let ck_water = $('#ckwater').is(':checked');
        var formdata=new FormData(frmtransfer);
        formdata.append('ck_water',ck_water==true?1:0);
        //   var sender=$('#selpartner option:selected').text();
        //   var receiver=$('#selpartner2 option:selected').text();
        //   var frompartner_id=$('#selpartner').val();
        //   var topartner_id=$('#selpartner2').val();

          var tranname=$('#seltranname option:selected').text();
          var trancode=$('#s_acc1').attr('title');
          var scc1=$('#s_acc1').val();
          var mekun=0;
          if(scc1=='+'){//គណនីកើន
            mekun=-1;
          }else{
            mekun=1;
          }
        //   formdata.append("sendername", sender);
        //   formdata.append("recname", receiver);
        //   formdata.append("frompartner_id", frompartner_id);
        //   formdata.append("topartner_id", topartner_id);
          formdata.append("userclickcontinue", $('#rowacc2').is(':visible') ? 1 : 0);
          formdata.append("trancode", trancode);
          formdata.append("mekun", mekun);
          formdata.append("tranname", tranname);
          formdata.append("cuscharge_cur", $('#selcur1 option:selected').text());
          formdata.append("transfer_cur", $('#selcur option:selected').text());
          formdata.append("partner2",$('#selpartner2 option:selected').text());
          formdata.append("location_id", 3);
          formdata.append("id1", $('#id1').val());
          formdata.append("id2", $('#id2').val());
          var url="{{ route('wingtransfer.store') }}";
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
                    // if(isprint==1){
                    //       printtransfers(data.id,hasexchange,hasbankpayment);
                    //   }
                    //   var partnerid=$('#selpartner').val();
                    //   var tranid=$('#seltranname').val();
                      //$('#frmtransfer').trigger('reset');
                      $('#btnsavetransfer').text('រក្សាទុក');
                    //   $('#seltranname').trigger('change');
                    //   //$('#selpartner').val(partnerid);
                    //   $('#selpartner').trigger('change');
                      //document.getElementById('amount').readOnly = true;
                      $('#amount').val('');
                      $('#amount_continue').val('');
                      $('#totalcash').val('');
                      $('#seltranname').trigger('change');
                      document.getElementById('ckwater').checked=false;
                      @if(config('helper.show_user_capital_master') == '1')
                        getuseraccount_master(1,1,$('#loginid').val());
                      @endif
                    //   $('#precord').text(data.partner_records + ' Records');
                    //   $('#brecord').text(data.bank_records + ' Records');
                    //   if(cklockdata==true){
                    //      var rem_partner1=$('#selpartner').val();
                    //      var rem_partner2=$('#selpartner2').val();
                    //   }

                    //   $('#invdate').datetimepicker({
                    //       timepicker:false,
                    //       datepicker:true,
                    //       value:new Date(),
                    //       format:'d-m-Y',
                    //       autoclose:true,
                    //       todayBtn:true,
                    //       startDate:new Date(),

                    //   });
                    //$('#invdate').datetimepicker("destroy");
                    //   if(cklockdata==true){

                    //     $('#selpartner').val(rem_partner1);
                    //     $('#selpartner').trigger('change');
                    //     $('#selpartner').select2("close");

                    //     $('#selpartner2').val(rem_partner1);
                    //     $('#selpartner2').trigger('change');
                    //     $('#selpartner2').select2("close");

                    //     $('#cklockdata').prop('checked',true);
                    //     $('#amount').focus();
                    //   }


                      gettransferlist();
                      //savephonetolocalstorage(autocomplereceiver);

                      toastr.success("Save Transfer Successfully");
                      $("#tbl_transferlist tr:last").css("background-color", "greenyellow");
                      $('#tbl_transferlist tr:last td:nth-child(2) input').focus();
                      $('#amount').focus();
                      $('#rectel').val('');
                      $('#recname').val('');
                      $('#seltranname').trigger('change');
                      //getbalwing($('#selpartner').val(),$('#selcur option:selected').text());
                      $('body').removeClass("wait");
                      $(el).removeAttr('disabled').html(buttontext);
                      //location.reload();
                  }else{
                      $('body').removeClass("wait");
                      $(el).removeAttr('disabled').html(buttontext);
                      alert(data.error)
                  }
              },
              error: function () {
                  $('body').removeClass("wait");
                  $(el).removeAttr('disabled').html(buttontext);
                  alert('Save Error.')
              }

          })
      }
      function gettransferlist()
      {
        var d=$('#invdate1').val();
        var location_id=3;
        var user_id=$('#seluser').val();
        var parrent_id=$('#selaccount').val();
        var url="{{ route('moneytransfer.gettransferlist') }}";
        $.get(url,{d:d,user_id:user_id,parrent_id:parrent_id,location_id:location_id},function(data){
          //console.log(data)
          $('#body_transaction').empty().html(data);
        })
      }
    })

    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    function savewingratetostorage(){
        localStorage.removeItem("wingrate_usd");
        localStorage.removeItem("wingrate_khr");

        var url="{{ route('moneytransfer.getwingratestorage') }}";
        $.get(url,{},function(data){
          //console.log(data);
          var wingrate_usd;
          if(localStorage.getItem("wingrate_usd")==null){
            wingrate_usd=[];
          }else{
            wingrate_usd=JSON.parse(localStorage.getItem("wingrate_usd"));
          }
          var wingrate_khr;
          if(localStorage.getItem("wingrate_khr")==null){
            wingrate_khr=[];
          }else{
            wingrate_khr=JSON.parse(localStorage.getItem("wingrate_khr"));
          }
          var wingrate_thb;
          if(localStorage.getItem("wingrate_thb")==null){
            wingrate_thb=[];
          }else{
            wingrate_thb=JSON.parse(localStorage.getItem("wingrate_thb"));
          }
          $.each(data['wingrate'],function(i,item){
            if(item.currency=='USD'){
                wingrate_usd.push({
                  id:item.id,
                  customer_id:item.customer_id,
                  agenttype_id:item.agent_type_id,
                  tranname_id:item.transaction_name_id,
                  wingcompany_id:item.wing_company_id,
                  amt1:item.amt1,
                  amt2:item.amt2,
                  currency:item.currency,
                  transfer_rate:item.transfer_rate,
                  cashdraw_rate:item.cashdraw_rate,
                  customer_rate:item.customer_rate,

                })

            }else if(item.currency=='KHR'){
                wingrate_khr.push({
                  id:item.id,
                  customer_id:item.customer_id,
                  agenttype_id:item.agent_type_id,
                  tranname_id:item.transaction_name_id,
                  wingcompany_id:item.wing_company_id,
                  amt1:item.amt1,
                  amt2:item.amt2,
                  currency:item.currency,
                  transfer_rate:item.transfer_rate,
                  cashdraw_rate:item.cashdraw_rate,
                  customer_rate:item.customer_rate,

                })
            }else if(item.currency=='THB'){
                wingrate_thb.push({
                  id:item.id,
                  customer_id:item.customer_id,
                  agenttype_id:item.agent_type_id,
                  tranname_id:item.transaction_name_id,
                  wingcompany_id:item.wing_company_id,
                  amt1:item.amt1,
                  amt2:item.amt2,
                  currency:item.currency,
                  transfer_rate:item.transfer_rate,
                  cashdraw_rate:item.cashdraw_rate,
                  customer_rate:item.customer_rate,

                })
            }
          });
          localStorage.setItem("wingrate_usd",JSON.stringify(wingrate_usd));
          localStorage.setItem("wingrate_khr",JSON.stringify(wingrate_khr));
          localStorage.setItem("wingrate_thb",JSON.stringify(wingrate_thb));

        })
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
            $(el).trigger('change');
            $(el).css('color','blue');
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



$("#tableSearch").on("keyup", function () {
    var rawInput = $(this).val().toUpperCase().trim();

    // Identify currency symbol from user input
    var currencySymbol = '';
    if (rawInput.includes('$')) currencySymbol = '$';
    else if (rawInput.includes('R') || rawInput.includes('៛')) currencySymbol = 'R';

    // Clean range input (remove all non-numeric/dot/dash characters except range dash)
    var cleanInput = rawInput.replace(/[^0-9.\-]/g, '');
    var rangeMatch = cleanInput.match(/^(\d+(?:\.\d+)?)-(\d+(?:\.\d+)?)$/);
    var isRange = rangeMatch !== null;

    var min = isRange ? parseFloat(rangeMatch[1]) : null;
    var max = isRange ? parseFloat(rangeMatch[2]) : null;

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
                    // Skip if the currency symbol in this cell does not match user input
                    if (!fullText.includes(currencySymbol)) return;

                    var numberOnly = fullText.replace(/[^\d.-]/g, '');
                    var num = parseFloat(numberOnly);
                    if (!isNaN(num) && num >= min && num <= max) {
                        matchFound = true;
                        return false;
                    }
                } else {
                    var searchText = rawInput.replace(/[ ,]/g, '');
                    var target = fullText.replace(/[ ,]/g, '');
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
