<script type="text/javascript">
    $('#h1_title').text('តារាងលក់អចលនទ្រព្យ');
    VirtualSelect.init({
        ele: '#selblock' ,
    });
    $('#search_property').select2();

     refresh_fixhead(210);
    $(window).resize(function() {
        refresh_fixhead(210);
    });
    function refresh_fixhead(h)
    {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-h;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
    }
     function getUserPermissions(userId) {
        const permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
        return permusers
            .filter(item => item.userid == userId)
            .map(item => item.code);
    }
    var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
    const userId = "{{ Auth::id() }}";
    const userPerms = new Set(getUserPermissions(userId));

    $(document).ready(function () {
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
      var cleave = new Cleave('#deposit', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
        var cleave = new Cleave('#payamt', {
            numeral: true,
            numeralDecimalScale: 6,
            numeralThousandsGroupStyle: 'thousand'
        });
      //$('#invdate').datetimepicker("destroy");
      $('#selbank').select2();
      $(document).on('change','#deposit',function(e){
        e.preventDefault();
        var bal=$('#balance').val().replace(/,/g, '');
        var dep=$('#deposit').val().replace(/,/g, '');
        var bal1=parseFloat(bal)-parseFloat(dep);
        $('#balance1').val(formatNumber(bal1));
        $('#payamt').val(formatNumber(dep));
      })

        $(document).on('click','.btnpayment',function(e){
            e.preventDefault();
            $('#paymentmodal').modal('show');
            var id=$(this).data('id');
            var map_id=$(this).data('map_id');
            var groupid=$(this).data('refgroupid');
            var propertyname=$(this).data('sendername');
            var url="{{ route('realestate.payment') }}";
            $.get(url,{id:id,groupid:groupid,map_id:map_id},function(data){

                if(data.success){
                    $('#m_title').text('បង់ប្រាក់');
                    $('#id1').val(data['transfers']['id']);
                    $('#id2').val(data['transfers']['map_id']);
                    $('#trancode').val(data['transfers']['trancode']);
                    $('#invdate').val(moment(new Date()).format("DD-MM-YYYY"));
                    if(data['transfers']['trancode']==-8){
                        $('#labelname').text("អតិថិជន");
                    }else{
                        $('#labelname').text("អ្នកលក់គំរោង");
                    }
                    $('#txtname').val(data['transfers'].partner.name);
                    $('#txtname').attr('title',data['transfers']['parrent_id']);
                    $('#amount').attr('title',propertyname);
                    $('#amount').val(formatNumber(Math.abs(data['transfers']['amount'])));
                    $('#txtcur').val(data['transfers']['currency'].shortcut);
                    $('#txtcur').attr('title',data['transfers'].currency_id);
                    $('#row_deposited').css('display','table-row');
                    $('#row_balance').css('display','table-row');
                    $('#deposited').val(formatNumber(data['totalpayment']));
                    $('.cur').val(data['transfers']['currency'].shortcut);
                    //$('#balance').val(formatNumber(parseFloat(Math.abs(data['transfers']['amount']) - parseFloat(Math.abs(data['totalpayment'])) )));
                    var balance=parseFloat(Math.abs(data['transfers']['amount'])) - parseFloat(Math.abs(data['totalpayment']));
                    $('#balance').val(formatNumber(balance));
                    $('#deposited').attr('title',data['transfers']['property_group']);
                    $('#balance').attr('title',data['transfers']['property_id']);
                    if(balance==0){
                        $('#btncomplete').css('display','block');
                    }else{
                        $('#btncomplete').css('display','none');
                    }
                    for(let i=0;i<data['saledetails'].length;i++){
                        row=`
                            <tr class="item">
                                <td class="kh14 no" style="text-align:center;">${i+1}</td>
                                <td style="display:none;">
                                    <input type="text" class="input-group pid kh14-b" name="pid[]" style="width:60px;padding:0px 5px;" value="${data['saledetails'][i].property_id}" readonly>
                                </td>
                                <td class="kh14-b pname" name="pname[]">${data['saledetails'][i].property.name}</td>
                                <td class="kh14-b psize" name="psize[]">${data['saledetails'][i].property.size}</td>
                                <td class="kh14-b" style="padding:0px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control p_price kh14-b" name="p_price[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(data['saledetails'][i].price)}">
                                        <input type="text" class="input-group p_cur kh14-b" name="p_cur[]" style="width:60px;padding:0px 5px;border-style:none;height:25px;margin-top:3px;background-color:transparent;" value="${data['saledetails'][i].currency.shortcut}" readonly>
                                    </div>
                                </td>

                                <td style="display:none;">
                                    <input type="text" class="input-group p_cur_id kh14-b" name="p_cur_id[]" style="width:60px;padding:0px 5px;" value="${data['saledetails'][i].currency_id}" readonly>
                                </td>
                                <td style="text-align:center;padding:5px 0px;display:none;">
                                    <a href="" class="btnremoveitem"><i class="fa fa-trash" style="color:red;"></i></a>
                                </td>
                            </tr>
                        `;
                    }
                    $('#qtybuy').val(i);
                    $('#haction').css('display','none');
                    $('#body_sale_detail').empty().append(row);
                }else{

                }
            })
        })
        $(document).on('click','.tbl_transferlist td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
        $(document).on('click','#btncomplete',function(e){
            e.preventDefault();
            var bal=$('#balance').val();
            if(parseFloat(bal)!==0){
                alert('you can not set loan complete with balance bigger than zero')
                return;
            }
            var id=$('#id1').val();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Payment Complete!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        async: true,
                        type: 'GET',
                        dataType:'JSON',
                        contentType: 'application/json;charset=utf-8',
                        url: "{{ route('realestate.buypaymentcompleted') }}",
                        data: { id:id },
                        success: function (data) {
                            console.log(data);
                            if (data.success === true) {
                               $('#paymentmodal').modal('hide');
                                Swal.fire(
                                    'Update!',
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
        $(document).on('click','.btnready',function(e){
                e.preventDefault();

                var id=$(this).data('id');
                var bal=$(this).data('balance');
                if(parseFloat(bal)!==0){
                    alert('you can not set loan complete with balance bigger than zero')
                    return;
                }
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Payment Complete!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('realestate.buypaymentcompleted') }}",
                            data: { id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                $('#paymentmodal').modal('hide');
                                    Swal.fire(
                                        'Update!',
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
        $(document).on('click','#btnsavedeposit,#btnsavedepositprint',function(e){
            e.preventDefault();
            var table = document.getElementById("tbl_sale_detail");
            var tbodyRowCount = table.tBodies[0].rows.length;
            if(tbodyRowCount==0){
                alert('save not allow')
                return;
            }

            var deposit=$('#deposit').val().replace(/,/g,'');
            var overamount=$('#overamount').val().replace(/,/g,'');
            var discount=$('#discount_amount').val().replace(/,/g,'');
            var paythismonth=parseFloat(deposit)+parseFloat(overamount)-parseFloat(discount);
            var payamt=$('#payamt').val().replace(/,/g,'');
            if(parseFloat(deposit)<=0){
                alert('no deposit amount')
                return;
            }
            if(parseFloat(payamt)>parseFloat(paythismonth)){
                alert('receive amount can not bigger than month payment amount');
                return;
            }
            if($('#selbank').val()=='cash'){
                if(parseFloat(payamt)!==parseFloat(paythismonth)){
                    alert('receive amount must be the same to payment amount');
                    return;
                }
            }

            var elid=$(this).attr('id');
            if(elid=='btnsavedeposit'){
                savedeposit(0,$(this),$(this).text());
            }else{
                savedeposit(1,$(this),$(this).text());
            }

        })
        function savedeposit(isprint,el,btntext)
      {
          $('body').addClass("wait");
          $(el).attr('disabled', true).text("Processing");
          var formdata=new FormData(frmdeposit);
          var curid=$('#txtcur').attr('title');
          var payby=$('#selbank option:selected').text();
          var partner_id=$('#txtname').attr('title');
          formdata.append('payby',payby);
          formdata.append('curid',curid);
          formdata.append('partner_id',partner_id);
          formdata.append('property_group',$('#deposited').attr('title'));
          formdata.append('property_id',$('#balance').attr('title'));
          var url="{{ route('realestate.savedeposit') }}";
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
                        printdeposit(data.id,data.groupid,'បង្កាន់ដៃកក់ប្រាក់',$('#amount').attr('title'));
                    }
                    toastr.success("Save Sale Successfully");
                      getsolelist();
                      $(el).removeAttr('disabled').html(btntext);
                        $('#frmdeposit').trigger('reset');
                        $('#body_sale_detail').empty();
                        $('#selbank').trigger('change');
                        $('#paymentmodal').modal('hide');
                      $('body').removeClass("wait");

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

      function printdeposit(id,groupid,rpttitle,propertyname){
          var redirectWindow = window.open('{{ url('/') }}'+'/realestate/depositprint?id='+id+'&groupid='+groupid+'&rpttitle='+rpttitle+'&propertyname='+propertyname , '_blank');
          redirectWindow.location;
        }

    })//end document
    $(document).on('click','#btnsearch',function(e){
        e.preventDefault();
        getsolelist();
    })
    $(document).on('change','#seltrancode',function(e){
        e.preventDefault();
        getsolelist();
    })
    function getsolelist()
    {

        $('body').addClass("wait");
        var property_id=$('#search_property').val();
        var selgroup=$('#selblock').val();
        @if(Auth::user()->role->name=='Admin')
            if(selgroup.includes('all')==true || selgroup=='' || selgroup.length==0){
                selgroup="all";
            }
        @else
            if(selgroup.includes('all')==true){
                selgroup="all";
            }
        @endif

        var trancode=$('#seltrancode').val();
        var paymenttype=document.querySelector('input[name="optlist"]:checked')?.value;
        var url="{{ route('realestate.getsoldlist') }}";
        $.ajax({
            async:true,
            type: 'GET',
            url: url,
            data: {trancode:trancode,paymenttype:paymenttype,selgroup:selgroup,property_id:property_id},

            complete: function () {},
            success: function (data) {
                console.log(data)

                $('#row_display').empty().html(data);
                refresh_fixhead(210);
                $("#tableSearch").keyup();
                if(trancode==-8){
                    $('#th_customer').text("ឈ្មោះអតិថិជន");
                }else{
                    $('#th_customer').text("ឈ្មោះអ្នកលក់គំរោង");
                }
                $('body').removeClass("wait");
                if (!isAdmin) {
                    if (!userPerms.has('1.3.1')) {
                        $('.li_code131').hide(); // Shorter way to hide
                    }
                    if (!userPerms.has('1.3.2')) {
                        $('.li_code132').hide();
                    }

                    if (!userPerms.has('1.3.8')) {
                        $('.li_code138').hide();
                    }


                }
            },
            error: function () {
                $('body').removeClass("wait");
                alert('Read Data Error.')
            }
        })
    }
    $(document).on('change','input[name="optlist"]',function(e){
        e.preventDefault()
        getsolelist();

    })
    // $("#tableSearch").on("keyup", function() {
    //     //searchteable($(this).val().toUpperCase());
    //     var value=$(this).val().toUpperCase();
    //     $("#mytable tr").each(function(index) {
    //         if (index !== 0) {
    //             $row = $(this);

    //             $row.find('td').each (function() {
    //                 var id = $(this).text();
    //                 if (id.toUpperCase().search(value) < 0) {
    //                     $row.hide();
    //                 }
    //                 else {
    //                     $row.show();
    //                     return false;
    //                 }
    //             });

    //         }
    //     });
    // });
    $("#tableSearch").on("keyup", function() {
        var value = $(this).val().toUpperCase();
        $("#mytable tr").each(function(index) {
            if (index === 0) return; // Skip header row
            var $row = $(this);
            var match = false;
            $row.find('td').each(function() {
                if ($(this).text().toUpperCase().indexOf(value) > -1) {
                    match = true;
                    return false; // Exit inner loop if a match is found
                }
            });
            match ? $row.show() : $row.hide(); // Show or hide the row
        });
    });
    function searchteable(value)
    {
        //debugger;

        $("#mytable tr").each(function(index) {
            if (index !== 0) {
                $row = $(this);

                $row.find('td').each (function() {
                    var id = $(this).text();
                    if (id.toUpperCase().search(value) < 0) {
                        $row.hide();
                    }
                    else {
                        $row.show();
                        return false;
                    }
                });

            }
        });
    }
</script>
