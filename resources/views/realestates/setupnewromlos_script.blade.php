<script type="text/javascript">
    $(document).on('change','#term_newpay',function(e){
        e.preventDefault();
        setenddate();
      })

      function setenddate(){

        var dd=$('#start_date_newpay').val();
        var d=dd.split("-")[0];
        var m=dd.split("-")[1];
        var y=dd.split("-")[2];
        const startdate=new Date(y + '-' + m + '-' + d);
        var month= $('#term_newpay').val();
        var enddate= addMonths(parseFloat(month),startdate);
        $('#end_date_newpay').val(moment(enddate).format("DD-MM-YYYY"));
      }
     function addMonths(numOfMonths, date = new Date()) {
            date.setMonth(date.getMonth() + numOfMonths);
            return date;
        }
    $(document).on('click','.tbl_newpay_list td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                $(this).parent('tr').addClass("clickedrow");
            })
     $(document).on('click','.btnnewpayment',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            $('#newpayromlos_modal').modal('show');
            clearnewpay();
            getnewpaymentlist(id,1);
        })
        $(document).on('click','.refresh_list',function(e){
              e.preventDefault();
              var status=$(this).data('status');
              $('#txtstatus').val(status);
              var id=$('#saleid_newpay').val();
              getnewpaymentlist(id,status);
        })
        function getnewpaymentlist(main_id,status)
        {
             $('body').addClass("wait");
            var url="{{ route('realestate.getnewpayment') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {id:main_id,status:status},

                complete: function () {},
                success: function (data) {
                    console.log(data)
                    $('#property_newpay').val(data['transfer']['sendername']);
                    $('#saleid_newpay').val(data['transfer']['id']);
                    $('#start_date_newpay').val(moment(data['transfer']['startdate']).format("DD-MM-YYYY"));
                    $('#end_date_newpay').val(moment(data['transfer']['enddate']).format('DD-MM-YYYY'));
                    $('#payinmonth_newpay').val(formatNumber(data['transfer']['payinmonth']) + ' ' + data['transfer']['currency'].shortcut);
                    $('#nextpayment_newpay').val(moment(data['transfer']['nextpayment']).format("DD-MM-YYYY"));
                    $('#term_newpay').val(data['transfer']['term']);
                    getnewpaylist(data.newpayment);
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }

          $(document).on('click','#btnsavenewpay',function(e){
            e.preventDefault();
            $('body').addClass("wait");
            var formdata=new FormData(frmnewpayment);
            var url="{{ route('realestate.savenewpayromlos') }}";
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
                        toastr.success("Save Sale Successfully");
                        getnewpaylist(data.newpaylist);
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
          $(document).on('click','#btnupdateterm',function(e){
            e.preventDefault();
            $('body').addClass("wait");
            var formdata=new FormData();
            var term=$('#term_newpay').val();
            var startdate=$('#start_date_newpay').val();
            var enddate=$('#end_date_newpay').val();
            var id=$('#saleid_newpay').val();
            formdata.append('id',id);
            formdata.append('term',term);
            formdata.append('startdate',startdate);
            formdata.append('enddate',enddate);
            var url="{{ route('realestate.updateterm') }}";
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
                        toastr.success("Update term Successfully");

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
        $(document).on('click','#btnnewpay',function(e){
            e.preventDefault();
           clearnewpay();
        })
        $(document).on('click','#btnrefreshnewpay',function(e){
            e.preventDefault();

        })
        function clearnewpay()
        {
            $('#newpayid').val('');
            $('#txtstatus').val(1);
            $('#d1').val(moment(new Date()).format('DD-MM-YYYY'));
            $('#d2').val(moment(new Date()).format('DD-MM-YYYY'));
            $('#payamtnew').val('');
            $('#selcur_paynew').val('');
            $('#btnsavenewpay').text('Save');
            //$('#selcur_paynew').trigger('change');
        }
        $(document).on('click','.btnedit_newpay',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            var startdate=$(this).data('start_date');
            var enddate=$(this).data('end_date');
            var note=$(this).data('note');
            var amount=$(this).data('amount');
            var cur=$(this).data('cur');
            $('#newpayid').val(id);
            $('#d1').val(moment(startdate).format('DD-MM-YYYY'));
            $('#d2').val(moment(enddate).format('DD-MM-YYYY'));
            $('#payamtnew').val(formatNumber(amount));
            $('#selcur_paynew').val(cur);
            $('#note_newpay').val(note);
            $('#btnsavenewpay').text('Update');
        })
        function getnewpaylist(data)
        {
            //console.log(data);
            var output='';
            $('#body_newpay').empty();
            for (let i = 0; i < data.length; i++) {
                const newpay = data[i];
                output += `
                    <tr style="${newpay.status == 0 ? 'background-color:pink;' : ''}">
                        <td class="kh14" style="text-align:center;">${i + 1}</td>
                        <td class="kh16">${moment(newpay.start_date).format('DD-MM-YYYY')}</td>
                        <td class="kh16">${moment(newpay.end_date).format('DD-MM-YYYY')}</td>
                        <td class="kh16-b" style="text-align:right;color:red;">${formatNumber(newpay.amount)} ${ newpay.currency.shortcut }</td>
                        <td class="kh14">${newpay.note??''}</td>
                        <td class="kh14">${moment(newpay.dd).format('DD-MM-YYYY')}</td>
                        <td class="kh14">${newpay.user.name}</td>

                        <td class="kh14" style="text-align:center;">
                            ${newpay.status == 1 ? `
                                <a href="#" class="mybtn_edit btnedit_newpay"
                                data-id="${newpay.id}"
                                data-transfer_id="${newpay.transfer_id}"
                                data-start_date="${newpay.start_date}"
                                data-end_date="${newpay.end_date}"
                                data-note="${newpay.note}"
                                data-amount="${newpay.amount}"
                                data-cur="${newpay.currency_id}"
                                data-status="${newpay.status}">
                                    <i class="fa fa-pencil"></i>
                                </a> &nbsp;
                                <a href="#" class="mybtn_delete btndel_newpay"
                                data-id="${newpay.id}" data-restore=0
                                data-status="${newpay.status}"
                                data-transfer_id="${newpay.transfer_id}">
                                    <i class="fa fa-trash" style="color:red;"></i>
                                </a>
                            ` : `
                                <a href="#" class="mybtn_edit btndel_newpay"
                                data-id="${newpay.id}" data-restore=1
                                data-status="${newpay.status}" data-transfer_id="${newpay.transfer_id}">
                                    <i class="fa fa-repeat" style=""></i>
                                </a>
                                <a href="#" class="mybtn_delete btndel_newpay"
                                data-id="${newpay.id}" data-restore=0
                                data-status="${newpay.status}"
                                data-transfer_id="${newpay.transfer_id}">

                                    <i class="fa fa-trash" style="color:red;"></i>
                                </a>
                            `}
                        </td>
                    </tr>
                `;
            }
            $('#body_newpay').append(output);
        }
            $(document).on('click','.btndel_newpay',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var status=$(this).data('status');
                var txtstatus=$('#txtstatus').val();
                var restore=$(this).data('restore');
                var transfer_id=$(this).data('transfer_id');
                var text='';
                var confirmtext='';
                var suctext='';
                if(status==1){
                    text='to remove this item!';
                    confirmtext='Yes, remove it!';
                    suctext='Deleted';
                }else{
                    if(restore==1){
                        text='to restore this item!';
                        confirmtext='Yes, restore it!';
                        suctext='Restored';
                    }else{
                        text='to delete this item from bin!';
                        confirmtext='Yes, delete it!';
                        suctext='Deleted';
                    }
                }
                var url="{{ route('realestate.deletenewpayromlos') }}";
                Swal.fire({
                        title: 'Are you sure?',
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: confirmtext
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                async: true,
                                type: 'GET',
                                dataType:'JSON',
                                contentType: 'application/json;charset=utf-8',
                                url: url,
                                data: { id:id,status:status,transfer_id:transfer_id,restore:restore,txtstatus:txtstatus},
                                success: function (data) {
                                    console.log(data)
                                    getnewpaylist(data.newpaylist);
                                    if (data.success === true) {
                                        Swal.fire(
                                            suctext,
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

</script>
