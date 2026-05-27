<script type="text/javascript">
    //var pathname=window.location.pathname.split("/");

    $('#h1_title').text('កត់ត្រាចំណូលចំណាយ');
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
     $(document).on('click','#tbl_group td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
    $(document).on('click','.btnclick',function(e){
            //debugger;
            $('.btnclick').removeClass('btnbg');
            $(this).addClass('btnbg');

         })
    $(document).on('click','#btnincome',function(e){
          e.preventDefault();
          btnclick($(this).text(),1,1);
          $('#cardpartner').css('background-color','blue');
         $('#amtsign').text('+');


      })
      $(document).on('click','#btnexpanse',function(e){
          e.preventDefault();
          btnclick($(this).text(),-1,-1);
          $('#cardpartner').css('background-color','red');
          $('#amtsign').text('-');

      })
      function btnclick(trname,trcode,mekun)
      {
          $('#tranname').text(trname);
          $('#trancode').val(trcode);
          $('#mekun').val(mekun);
          getexpansetype(mekun);
          document.getElementById("btnsavetransfer").disabled = false;
          if($('#selpartner2').val()!==''){
              fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amount').val(),0);
          }
      }
      function getexpansetype(group_id)
      {
        $('#seltype').empty();
        var url="{{ route('expanseincome.getexpansetypebygroup') }}";
        $.get(url,{group_id:group_id},function(data){
            $('#seltype').append($("<option/>",{
                value:'',
                text:''
            }))
            $.each(data['expansetype'],function(i,item){
                $('#seltype').append($("<option/>",{
                    value:item.id,
                    text:item.name
                }))
            });
        })
      }
      $(document).on('change','#amount',function(e){
        e.preventDefault();
        if($('#selpartner2').val()!==''){
              fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amount').val(),0);
          }
      })
      $(document).on('change','#selcur',function(e){
        e.preventDefault();
        if($('#selpartner2').val()!==''){
              fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amount').val(),0);
          }
      })
      $(document).on('change','#selpartner2',function(e){
        e.preventDefault();
        var sp = document.querySelector("#selpartner2");
        var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
        var countrycode=sp.options[sp.selectedIndex].getAttribute('countrycode');
        if($(this).val()!==''){
            getwingbalance($(this).val(),$('#selcur option:selected').text(),'#balance1','#balancenext1',-1 * parseFloat($('#mekun').val()),$('#amount').val(),0,fillnextbalance);
        }

      })
      function fillnextbalance(elbal,elnext,cur,sign,amt,fee)
            {
                //debugger;
                var mekun= sign;
                var amt1=amt.toString().replace(/,/g,'');
                var fee1=fee.toString().replace(/,/g,'');
                var amount=parseFloat(amt1)+parseFloat(fee1);

                var i=0;
                var baltitle=$(elbal).attr('title');
                var balusd=baltitle.split(";")[0];
                var balkhr=baltitle.split(";")[1];
                var balthb=baltitle.split(";")[2];
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
          function getwingbalance(cid,cur,elem,elnext,sign,amt,fee,callback)
          {
            $('body').addClass("wait");

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

                        callback(elem,elnext,cur,sign,amt,fee);
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
      $(document).on('change','#seltype',function(e){
        e.preventDefault();
        $('#inputtype').val($('#seltype option:selected').text());
      })
      $(document).on('click','.btnedit',function(e){
        var id=$(this).data('id');
        var url="{{ route('expanseincome.edit') }}";
        $.get(url,{id:id},function(data){
            //console.log(data)
            if(data.success){
                $('#seltype').empty();
                $('#seltype').append($("<option/>",{
                    value:'',
                    text:''
                }))
                $.each(data['expansetype'],function(i,item){
                    $('#seltype').append($("<option/>",{
                        value:item.id,
                        text:item.name
                    }))
                });
                $('#seluseraffect').val(data['expanse']['user_id']);
                $('#seltype').val(data['expanse']['expanse_type_id']);
                $('#seltype').trigger('change');
                $('#selpartner2').val(data['expanse']['customer_id']);
                $('#selpartner2').trigger('change');
                $('#amount').val(formatNumber(Math.abs(data['expanse']['amount'])));
                $('#selcur').val(data['expanse']['currency_id']);
                $('#amount2').val(formatNumber(Math.abs(data['expanse']['inusd'])));
                $('#txtrate').val(parseFloat(data['expanse']['rate']));
                $('#desr').val(data['expanse']['desr']);
                $('#trancode').val(data['expanse']['trancode']);
                $('#mekun').val(data['expanse']['mekun']);
                $('#tranname').text(data['expanse']['tranname']);
                $('#id1').val(data['expanse']['id']);
                $('#id2').val(data['expanse']['transfer_id']);
                $('#btnsavetransfer').text('កែប្រែ');
                if(data['expanse']['mekun']==1)
                {
                    $('#amtsign').text('+')
                }else{
                    $('#amtsign').text('-')
                }

                // if(data['transfers']['cashdraw_id']>0)
                // {
                //     $('#amount').attr('readonly',true);
                // }
                $(' #btndelete').css('display','table-row');
                document.getElementById("btnsavetransfer").disabled = false;
                document.getElementById("btnexpanse").disabled = true;
                document.getElementById("btnincome").disabled = true;
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
                    type: 'POST',
                    dataType:'JSON',
                    contentType: 'application/json;charset=utf-8',
                    url: "{{ route('expanseincome.delete') }}",
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
     $(document).on('click','.btndel_type',function(e){
        e.preventDefault();
        var id=$(this).data('id');
        var btn = $(this);
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
                    type: 'POST',
                    dataType:'JSON',
                    contentType: 'application/json;charset=utf-8',
                    url: "{{ route('expanseincome.deletetype') }}",
                    data: { id:id },
                    success: function (data) {
                        //console.log(data);
                        if (data.success === true) {
                            btn.closest('tr').remove();
                            // Re-number the "No" column (assumes it's the first <td>)
                            $('#tbl_group tbody tr').each(function(index) {
                                $(this).find('td:first').text(index + 1);
                            });
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
        // $('#selpartner').select2({templateResult: formatOption});
        // $('#selpartner2').select2({templateResult: formatOption});
        $('#selpartner').select2();
        $('#selpartner2').select2();
        $('#seltype').select2();
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
                $('#btnsavetransfer').focus();
              } else if (id == 'amount2'){
                  $('#btnsavetransfer').focus();
              }
              e.preventDefault();
          }
      })

 $(document).on('click','.btndelexpansetype',function(e){
            e.preventDefault();
            $('#expansetype_modal').modal('show');
        })


          $(document).on('change','#selcur',function(e){
            e.preventDefault();
            getcurrencybyidlocalstorage($(this).val(),'#selcur')
            getcurrencybyidlocalstorage($('#selcur2').val(),'#selcur2')
        })
        $(document).on('change','#selcur2',function(e){
            e.preventDefault();
            getcurrencybyidlocalstorage($(this).val(),'#selcur2')
        })

          $(document).on('keyup','#amount',function(e){
              const C = e.key;
              if (C === "Backspace"){
                  return;
              }else if(C==="+"){
                e.preventDefault();
                $('#btnreceive').click();
                return;

              }else if(C==="-"){
                e.preventDefault();
                $('#btnexpanse').click();
                return;
              }

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
                  getcurrencybykeylocalstorage('d','#selcur2');
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
       $(document).on('click','.btnedit_type',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            var groupid=$(this).data('group_id');
            var name=$(this).data('name');
            $('#exptype_id').val(id);
            $('#group_id').val(groupid);
            $('#type_name').val(name);
            $('#btnsavetype').text('Update')
       })
        $(document).on('click','#btnnewtype',function(e){
            e.preventDefault();
            $('#frmexpansetype').trigger('reset');
            $('#btnsavetype').text('Save');
            $('#type_name').focus();
        })
         $(document).on('change','#group_id',function(e){
            e.preventDefault();
           getexpansetypelist();
        })
          $(document).on('click','#btnrefreshtype',function(e){
            e.preventDefault();
           getexpansetypelist();
        })
       $(document).on('click','#btnsavetype',function(e){
            e.preventDefault();
            $('body').addClass("wait");
          var formdata=new FormData(frmexpansetype);
          var url="{{ route('expanseincome.savetype') }}";
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
                      if($('#exptype_id').val()==''){

                      }

                      toastr.success("Save Type Successfully");
                      getexpansetypelist();
                      $('body').removeClass("wait");
                  }else{
                      $('body').removeClass("wait");
                      alert(data.error)
                  }
              },
              error: function () {
                  $('body').removeClass("wait");
                  alert('Save Error.')
              }

          })

      })
      function getexpansetypelist()
      {
        $('body').addClass("wait");
        var group_id=$('#group_id').val();
        var url="{{ route('expanseincome.getexpansetypebygroup') }}";

        $.ajax({
                async:true,
                type: 'POST',
                url: url,
                data: {group_id:group_id},
                //contentType: 'text/plain',
                //contentType: false,
                //processData: true,
                //cache: false,
                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    var row='';
                    $('#body_group').empty();
                    var ep=data['expansetype'];
                    for(let i=0;i<data['expansetype'].length;i++){
                        row +=`
                        <tr>
                            <td class="kh16" style="text-align:center;">${i+1}</td>
                            <td class="kh16">${ moment(ep[i].created_at).format('DD-MM-YYYY') }</td>
                            <td class="kh16">${ ep[i].group_id==1?'ចំណូល':'ចំណាយ' }</td>
                            <td class="kh16">${ep[i].name }</td>
                            <td class="kh16" style="text-align:center;">
                                <a href="" class="btn btn-warning btn-sm btnedit_type" data-id="${ep[i].id}" data-group_id="${ep[i].group_id}" data-name="${ep[i].name}"><i class="fa fa-pencil"></i></a>
                                <a href="" class="btn btn-danger btn-sm btndel_type" data-id="${ep[i].id}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                        `;
                    }
                     $('#body_group').append(row);
                    $('body').removeClass("wait");
                },
                error: function () {
                    alert('Read Data Error.')
                }
            })
      }
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
      function func_savetransfer(isprint,el,buttontext)
      {
          $('body').addClass("wait");
          var cklockdata = document.getElementById("cklockdata").checked;
          var formdata=new FormData(frmtransfer);
          var bankid=$('#selpartner2').val();
          var bank=$('#selpartner2 option:selected').text();
          var customer=$('#seltype option:selected').text();
          var inputtype=$('#inputtype').val();
          if(customer==''){
            customer=$('#inputtype').val();
          }
          var trancode=$('#trancode').val();
          var mekun=$('#mekun').val();
          var tranname=$('#tranname').text();
          var tranname1='';
            if(bankid!=''){
                if(mekun==1){
                    trancode=4;
                    tranname1='បាញ់ចូល';
                }else{
                    trancode=-4;
                    tranname1='បាញ់ចេញ'
                }
            }

          formdata.append("bank", bank);
          formdata.append("expansetype", customer);
          formdata.append("tranname1", tranname1);
          formdata.append("trancode_change",trancode);
          formdata.append("tranname",tranname);


          var url="{{ route('expanseincome.store') }}";
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
                      //debugger;
                      if($('#id1').val()==''){
                          resetform();
                      }

                      gettransferlist();
                      toastr.success("Save Transfer Successfully");
                    $(el).removeAttr('disabled').html(buttontext);
                      $('body').removeClass("wait");

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

    })

    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    function gettransferlist()
      {
        $('body').addClass("wait");
        var d=$('#invdate').val();
        var user_id=$('#filteruser').val();
        var url="{{ route('expanseincome.getexpanselist') }}";

        $.ajax({
                async:true,
                type: 'POST',
                url: url,
                data: {d:d,user_id:user_id,location_id:5},
                //contentType: 'text/plain',
                //contentType: false,
                //processData: true,
                //cache: false,
                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#body_transaction').empty().html(data);
                    $('body').removeClass("wait");
                },
                error: function () {
                    alert('Read Data Error.')
                }
            })
      }
      function resetform()
      {
        //$('#frmtransfer').trigger('reset');
        $('#seltype').val('');
        $('#selpartner2').val('');
        $('#seltype').trigger('change');
        $('#selpartner2').trigger('change');
        $('#amount').val('');
        $('#amount2').val('');
        $('#selcur').val('');
        $('#txtrate').val('');
        $('#desr').val('');
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
        $('#seltype').trigger('change');
        $('#selpartner2').trigger('change');
        $('#id1').val('');
        $('#id2').val('');
        $('#amount').val('');
        $('#amount2').val('');
        $('#txtrate').val('');
        $('#desr').val('');
        $('#tranname').text('');
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
        document.getElementById("btnexpanse").disabled = false;
        document.getElementById("btnincome").disabled = false;
        $('.btnclick').removeClass('btnbg');
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
        try{
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

        }catch{

        }

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
