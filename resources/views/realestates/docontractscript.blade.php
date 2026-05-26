<script type="text/javascript">
     document.getElementById("size1").addEventListener("keydown", function (event) {
        event.preventDefault(); // Prevent any input
    });
    $(document).ready(function () {
        $('#selpartner').select2();
        $('#sel_property').select2();
         $("#sel_province1").select2();
        // $("#sel_district1").select2();
        // $("#sel_commune1").select2();
        // $("#sel_village1").select2();
         $("#sel_province2").select2();
         $("#sel_province22").select2();
         $("#sel_province3").select2();
        // $("#sel_district2").select2();
        // $("#sel_commune2").select2();
        // $("#sel_village2").select2();
        var cleave = new Cleave('#deposit', {
                numeral: true,
                numeralPositiveOnly: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        var cleave = new Cleave('#discount', {
                numeral: true,
                numeralPositiveOnly: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            $(document).on('change','#name1',function(e){
                e.preventDefault();
                var sp = document.querySelector("#name1");
                var sex=sp.options[sp.selectedIndex].getAttribute('sex');
                var age=sp.options[sp.selectedIndex].getAttribute('age');
                var nation=sp.options[sp.selectedIndex].getAttribute('nation');
                var idcard=sp.options[sp.selectedIndex].getAttribute('idcard');
                var address=sp.options[sp.selectedIndex].getAttribute('address');
               $('#sex1').val(sex);
               $('#age1').val(age);
               $('#nation1').val(nation);
               $('#id1').val(idcard);
               $('#address1').val(address);
            })
        $(document).on('change','#sel_property',function(e){
            e.preventDefault();
            if($('#sel_property').val()=='') return;
            var sp = document.querySelector("#sel_property");
            var size=sp.options[sp.selectedIndex].getAttribute('size');
            var size1=sp.options[sp.selectedIndex].getAttribute('size1');
            var price=sp.options[sp.selectedIndex].getAttribute('price');
            var cur=sp.options[sp.selectedIndex].getAttribute('cur');
            var curid=sp.options[sp.selectedIndex].getAttribute('curid');
            var com_payoff=sp.options[sp.selectedIndex].getAttribute('com_payoff');
            var com_payloan=sp.options[sp.selectedIndex].getAttribute('com_payloan');
            var address=sp.options[sp.selectedIndex].getAttribute('com_address');
            var north=sp.options[sp.selectedIndex].getAttribute('north');
            var south=sp.options[sp.selectedIndex].getAttribute('south');
            var east=sp.options[sp.selectedIndex].getAttribute('east');
            var west=sp.options[sp.selectedIndex].getAttribute('west');
            var groupname=sp.options[sp.selectedIndex].getAttribute('groupname');
            $('#price').val(formatNumber(price));
            $('#size1').html(size1);
            $('#price').trigger('change');
            $('#property_address').val(address);$('#north').val(north);
            $('#north').val(north);
            $('#south').val(south);
            $('#east').val(east);
            $('#west').val(west);
            $('#blocname').val(groupname);
            $('#discount').trigger('change');

        })
        $(document).on('click','#btnnew_customerid',function(e){
            e.preventDefault();
            $('#customer_id').val('');
            $('#name2').val('');
            $('#age2').val('');
            $('#id2').val('');
        })
        $(document).on('click','#btnnew_salerid',function(e){
            e.preventDefault();
            $('#saler_id').val('');
            $('#name3').val('');
            $('#age3').val('');
            $('#id3').val('');

        })
        $(document).on('change','#discount,#disc_by',function(e){
            e.preventDefault();
            dodiscount();
        })
        $(document).on('click','.tbllist td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
        function dodiscount(){
            var price=$('#price').val().replace(/,/g,'');
            var disc=$('#discount').val().replace(/,/g,'');
            var disby=$('#disc_by').val();
            var pricedisc=0;
            if(disby=='%'){
                pricedisc=(parseFloat(price)*parseFloat(disc))/100;
            }else{
                pricedisc=disc;
            }
            var priceafterdiscount=parseFloat(price)-parseFloat(pricedisc);
            $('#pricediscount').val(formatNumber(priceafterdiscount));
            $('#pricediscount').trigger('change');
        }
        $(document).on('change','#pricediscount',function(e){
            e.preventDefault();
            var amount=$('#pricediscount').val().replace(/,/g,'');
            var el=$('#price_text1');
            var curname=$('#curname').text();
            var khcur='';
            if(curname=='USD'){
                khcur='ដុល្លាអាមេរិច';
            }else if(curname=='KHR'){
                khcur='រៀល';
            }else if(curname=='THB'){
                khcur='បាត';
            }
            convertToKhmerWords(amount,el,khcur);
        })
        $(document).on('change','#price',function(e){
            e.preventDefault();
            var amount=$('#price').val().replace(/,/g,'');
            var el=$('#price_text');
            var curname=$('#curname').text();
            var khcur='';
            if(curname=='USD'){
                khcur='ដុល្លាអាមេរិច';
            }else if(curname=='KHR'){
                khcur='រៀល';
            }else if(curname=='THB'){
                khcur='បាត';
            }
            convertToKhmerWords(amount,el,khcur);
        })
        $(document).on('change','#deposit',function(e){
            e.preventDefault();
            var amount=$('#deposit').val().replace(/,/g,'');
            var el=$('#deposit_text');
            var curname=$('#curname').text();
            var khcur='';
            if(curname=='USD'){
                khcur='ដុល្លាអាមេរិច';
            }else if(curname=='KHR'){
                khcur='រៀល';
            }else if(curname=='THB'){
                khcur='បាត';
            }
            convertToKhmerWords(amount,el,khcur);
        })
        $(document).on('click','#btnnew',function(e){
            e.preventDefault();
            location.reload();
        })
        $(document).on('click','#btnsave',function(e){
            e.preventDefault();
            savecontract(0,$(this),$(this).text());
        })
        $(document).on('click','#btnprint',function(e){
            e.preventDefault();
            savecontract(1,$(this),$(this).text());
        })
        function savecontract(isprint,el,btntext)
        {
            $('body').addClass("wait");
            $(el).attr('disabled', true).text("Processing");
            var formdata=new FormData(frmkongtra);
            var address2=''
            var province2=$('#sel_province2 option:selected').text();
            var district2=$('#sel_district2 option:selected').text();
            var commune2=$('#sel_commune2 option:selected').text();
            var village2=$('#sel_village2 option:selected').text();
            address2="ភូមិ"+village2+" ឃុំ/សង្កាត់"+commune2+" ស្រុក/ក្រុង"+district2+" ខេត្ត"+province2;

            var address22=''
            var province22=$('#sel_province22 option:selected').text();
            var district22=$('#sel_district22 option:selected').text();
            var commune22=$('#sel_commune22 option:selected').text();
            var village22=$('#sel_village22 option:selected').text();
            address22="ភូមិ"+village22+" ឃុំ/សង្កាត់"+commune22+" ស្រុក/ក្រុង"+district22+" ខេត្ត"+province22;

            var address3=''
            var province3=$('#sel_province3 option:selected').text();
            var district3=$('#sel_district3 option:selected').text();
            var commune3=$('#sel_commune3 option:selected').text();
            var village3=$('#sel_village3 option:selected').text();
            address3="ភូមិ"+village3+" ឃុំ/សង្កាត់"+commune3+" ស្រុក/ក្រុង"+district3+" ខេត្ត"+province3;
            var size1=$('#size1').html();
            formdata.append('size1',size1);
             formdata.append('address2',address2);
             formdata.append('address22',address22);
             formdata.append('address3',address3);
             formdata.append('propertyname',$('#sel_property option:selected').text());
             formdata.append('district22',district22);
             formdata.append('commune22',commune22);
             formdata.append('village22',village22);

          var url="{{ route('realestate.savedocontract') }}";
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
                        printcontract(data.id);
                    }
                    var ckbuymulti=document.getElementById('ckbuymulti').checked;
                    if(!ckbuymulti){
                        $('#frmkongtra').trigger('reset');
                        $('#sel_property').trigger('change');
                        var today=new Date();
                        $('#paiddate,#paiddatelast,#dd,#d1,#d2').datetimepicker({
                            timepicker:false,
                            datepicker:true,
                            value:today,
                            format:'d-m-Y',
                            autoclose:true,
                            todayBtn:true,
                            startDate:today,

                        });
                    }else{
                        $('#customer_id').val(data.cid);
                    }
                     $('#btnnew_customerid').css('display','inline');

                      toastr.success("Save Sale Successfully");
                      $(el).removeAttr('disabled').html(btntext);
                      $('#btnsave').text('រក្សាទុក');
                      $('#btnprint').text('រក្សាទុកព្រីន');
                      getcontract('','');
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

        $(document).on('click','#btnshow',function(e){
            e.preventDefault();
            getcontract('','');
        })
        $(document).on('click','#btnsearchmore',function(e){
            e.preventDefault();
            getcontract($('#selsearchby').val(),$('#txtsearch').val().trim());
        })
        $(document).on('click','.btndel',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var row = $(this).closest('tr'); // Store reference to the row
                var url="{{ route('realestate.deletecontract') }}";
                Swal.fire({
                        title: 'Are you sure?',
                        text: "to remove this property!",
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
                                url: url,
                                data: { id:id},
                                success: function (data) {

                                    if (data.success === true) {
                                        row.remove();
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
            e.preventDefault();
            var id=$(this).data('id');
            edit(id);
        })
        function edit(id){
            $('body').addClass("wait");
            var url="{{ route('realestate.editcontract') }}";

            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {id:id},

                complete: function () {},
                success: function (data) {
                    console.log(data)
                    //$('#btnnew_salerid').css('display','none');
                    $('#btnnew_customerid').css('display','none');
                    $('#name1').val(data['contract'].company_id)
                    $('#name1').trigger('change');
                    $('#customer_id').val(data['contract'].customer_id);
                    $('#name2').val(data['contract'].name_b);
                    $('#sex2').val(data['contract'].sex_b);
                    $('#age2').val(data['contract'].age_b);
                    $('#nation2').val(data['contract'].nation_b);
                    $('#id2').val(data['contract'].id_b);
                    $('#tel2').val(data['contract']['buyer'].tel);
                    $('#sel_province2').val(data['contract']['buyer'].province_id);
                    $('#sel_province2').trigger('change');
                    $('#sel_district2').empty().append($("<option/>",{
                        value:data['contract']['buyer'].district_id,
                        text:data['contract']['buyer'].district.name,
                    }))
                    $('#sel_commune2').empty().append($("<option/>",{
                        value:data['contract']['buyer'].commune_id,
                        text:data['contract']['buyer'].commune.name,
                    }))
                    $('#sel_village2').empty().append($("<option/>",{
                        value:data['contract']['buyer'].village_id,
                        text:data['contract']['buyer'].village.name,
                    }))

                    $('#name22').val(data['contract'].name_bb);
                    $('#sex22').val(data['contract'].sex_bb);
                    $('#age22').val(data['contract'].age_bb);
                    $('#nation22').val(data['contract'].nation_bb);
                    $('#id22').val(data['contract'].id_bb);
                    $('#tel22').val(data['contract'].tel_bb);
                    $('#sel_province22').val(data['contract'].province_id_bb);
                    $('#sel_province22').trigger('change');
                    $('#sel_district22').empty().append($("<option/>",{
                        value:data['contract'].district_id_bb,
                        text:data['contract'].district_name_bb,
                    }))
                    $('#sel_commune22').empty().append($("<option/>",{
                        value:data['contract'].commune_id_bb,
                        text:data['contract'].commune_name_bb,
                    }))
                    $('#sel_village22').empty().append($("<option/>",{
                        value:data['contract'].village_id_bb,
                        text:data['contract'].village_name_bb,
                    }))
                    $('#saler_id').val(data['contract'].saler_id??'');
                    $('#name3').val(data['contract'].name_c??'');
                    $('#sex3').val(data['contract'].sex_c??'');
                    $('#age3').val(data['contract'].age_c??'');
                    $('#nation3').val(data['contract'].nation_c??'');
                    $('#id3').val(data['contract'].id_c??'');
                    $('#tel3').val(data['contract']['saler'].tel??'');
                    $('#sel_province3').val(data['contract']['saler'].province_id??'');
                    $('#sel_province3').trigger('change');
                    $('#sel_district3').empty().append($("<option/>",{
                        value:data['contract']['saler'].district_id??'',
                        text:data['contract']['saler'].district?.name??'',
                    }))
                    $('#sel_commune3').empty().append($("<option/>",{
                        value:data['contract']['saler'].commune_id??'',
                        text:data['contract']['saler'].commune?.name??'',
                    }))
                    $('#sel_village3').empty().append($("<option/>",{
                        value:data['contract']['saler'].village_id??'',
                        text:data['contract']['saler'].village?.name??'',
                    }))

                    //search select option
                    let found=0;
                    document.querySelectorAll("#sel_property option").forEach(opt => {
                        if (parseFloat(opt.value) == parseFloat(data['contract'].property_id)) {
                            found=1;
                        }
                    });

                    if(found==0){
                        $('#sel_property').append($("<option/>",{
                            value:data['contract'].property_id,
                            text:data['contract']['property'].name,
                            price:data['contract']['property'].price,
                            size:data['contract']['property'].size,
                            size1:data['contract']['property'].size1,
                            cur:data['contract']['property'].currency.shortcut,
                            curid:data['contract']['property'].currency_id,
                            com_payoff:data['contract']['property'].com_payoff,
                            com_payloan:data['contract']['property'].com_payloan,
                            com_address:data['contract']['property'].group.address,
                            north:data['contract']['property'].north,
                            south:data['contract']['property'].south,
                            east:data['contract']['property'].east,
                            west:data['contract']['property'].west,


                        }))
                    }
                    $('#sel_property').val(data['contract'].property_id);
                    $('#sel_property').trigger('change');
                    $('#north').val(data['contract'].north);
                    $('#south').val(data['contract'].south);
                    $('#east').val(data['contract'].east);
                    $('#west').val(data['contract'].west);
                    $('#discount').val(data['contract'].discount);
                    $('#disc_by').val(data['contract'].disc_by);
                    $('#pricediscount').val(data['contract'].priceafterdiscount);
                    $('#price_text1').val(data['contract'].price_text1);
                    $('#doat').val(data['contract'].doat);
                    $('#dodate').val(data['contract'].dodate);
                    $('#domonth').val(data['contract'].domonth);
                    $('#doyear').val(data['contract'].doyear);

                    $('#dd').val(moment(data['contract'].reg_date).format("DD-MM-YYYY"));
                    $('#deposit').val(formatNumber(data['contract'].pay));
                    $('#deposit_text').val(data['contract'].pay_text);
                    $('#paiddate').val(moment(data['contract'].paiddate1).format("DD-MM-YYYY"));
                    $('#paiddatelast').val(moment(data['contract'].paiddate2).format("DD-MM-YYYY"));
                    $('#btnsave').text('កែប្រែ')
                    $('#btnprint').text('កែប្រែព្រីន')
                    $('#ctid').val(data['contract'].id);
                    if (data['contract'].paytype == 1) {
                        $('#optpaycash').prop('checked', true);
                    } else if (data['contract'].paytype == 2) {
                        $('#optromlos').prop('checked', true);
                    }
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
         }
         function getcontract(searchby,propertyname){
            $('body').addClass("wait");
            var url="{{ route('realestate.getcontract') }}";
            var ckcreate = document.getElementById("ckcreated_at").checked;
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var userid=$('#filteruser').val();
            $('#bodycontract').empty();
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,userid:userid,ckcreate:ckcreate,propertyname:propertyname,searchby:searchby},

                complete: function () {},
                success: function (data) {
                    console.log(data)
                    // var row='';
                    // var k=0;
                    // for(i=0;i<data['contracts'].length;i++){
                    //     k+=1;
                    //     row=`
                    //         <tr>
                    //             <td class="kh14" style="text-align:center;">${k}</td>
                    //             <td class="kh14">${ moment(data['contracts'][i].reg_date).format("DD-MM-YYYY") }</td>
                    //             <td class="kh14">${ data['contracts'][i].name_b }</td>
                    //             <td class="kh14">${ data['contracts'][i].name_c }</td>
                    //             <td class="kh14">${ data['contracts'][i].propertyname }</td>
                    //             <td class="kh14">${ data['contracts'][i].size??'' }</td>
                    //             <td class="kh14-b" style="text-align:right;">${ formatNumber(data['contracts'][i].price) }$</td>
                    //             <td class="kh14-b" style="text-align:right;">${ formatNumber(data['contracts'][i].discount ?? 0) } ${ data['contracts'][i].disc_by ?? '' }</td>
                    //             <td class="kh14-b" style="text-align:right;">${ formatNumber(data['contracts'][i].priceafterdiscount) }$</td>

                    //             <td class="kh14-b" style="text-align:right;">${ formatNumber(data['contracts'][i].pay) }$</td>
                    //             <td class="kh14" style="text-align:center;">${ data['contracts'][i].d + ' ' + data['contracts'][i].m + ' ' + data['contracts'][i].y }</td>
                    //             <td class="kh14">${ data['contracts'][i].paytype==1?'បង់ផ្តាច់':'រំលស់' }</td>

                    //             <td style="text-align:center;">
                    //                 <a href="" class="mybtn1 btnprint" data-id=${data['contracts'][i].id}><i class="fa fa-print" style="color:black;"></i></a>
                    //                 <a href="" class="btndel mybtn1" data-id=${data['contracts'][i].id}><i class="fa fa-trash" style="color:red;"></i></a>
                    //                 <a href="" class="btnedit mybtn1" data-id=${data['contracts'][i].id}><i class="fa fa-pencil" style="color:green;"></i></a>

                    //             </td>
                    //         </tr>
                    //     `;
                    //     $('#bodycontract').append(row);
                    // }
                    $('#bodycontract').empty().html(data);
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
         }
         $(document).on('click','.btnprint',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            printcontract(id);
         })
         function printcontract(id){
                var redirectWindow = window.open('{{ url('/') }}'+'/realestate/printcontract?id='+id, '_blank');
                redirectWindow.location;
            }
        $(document).on('change','#sel_province2,#sel_province3,#sel_province22',function(e){
            e.preventDefault();
            var id=$(this).attr("id");
            if(id=="sel_province2"){
                if($('#sel_province2').val()=='') return;
                getdistrict($(this).val(),'#sel_district2');
            }else if(id=='sel_province3'){
                if($('#sel_province3').val()=='') return;
                getdistrict($(this).val(),'#sel_district3');
            }else if(id=='sel_province22'){
                if($('#sel_province22').val()=='') return;
                getdistrict($(this).val(),'#sel_district22');
            }

        })
        function getdistrict(province_id,el)
        {
            var url="{{ route('address.getdistrict') }}";
            $(el).empty();
            $.get(url,{province_id:province_id},function(data){
                $(el).append($("<option/>",{
                            value:'',
                            text:''
                        }))
                $.each(data,function(i,item){
                    $(el).append($("<option/>",{
                            value:item.id,
                            text:item.name
                        }))
                });

            })
        }


        $(document).on('change','#sel_district2,#sel_district3,#sel_district22',function(e){
            e.preventDefault();
            var id=$(this).attr("id");
            if(id=="sel_district2"){
                if($('#sel_district2').val()=='') return;
                getcommune($(this).val(),'#sel_commune2');
            }else if(id=='sel_district3'){
                if($('#sel_district3').val()=='') return;
                getcommune($(this).val(),'#sel_commune3');
            }else if(id=='sel_district22'){
                if($('#sel_district22').val()=='') return;
                getcommune($(this).val(),'#sel_commune22');
            }

        })
        function getcommune(district_id,el)
        {

            var url="{{ route('address.getcommune') }}";
            $(el).empty();

            $.get(url,{district_id:district_id},function(data){
                $(el).append($("<option/>",{
                            value:'',
                            text:''
                        }))
                $.each(data,function(i,item){
                    $(el).append($("<option/>",{
                            value:item.id,
                            text:item.name
                        }))

                });



            })
        }
        $(document).on('change','#sel_commune2,#sel_commune3,#sel_commune22',function(e){

            e.preventDefault();
            var id=$(this).attr('id');
            if(id=='sel_commune2'){
                if($('#sel_commune2').val()=='') return;
                getvillage($(this).val(),'#sel_village2');
            }else if(id=='sel_commune3'){
                if($('#sel_commune3').val()=='') return;
                getvillage($(this).val(),'#sel_village3');
            }else if(id=='sel_commune22'){
                if($('#sel_commune22').val()=='') return;
                getvillage($(this).val(),'#sel_village22');
            }
        })
        function getvillage(commune_id,el)
        {

            var url="{{ route('address.getvillage') }}";
            $(el).empty();

            $.get(url,{commune_id:commune_id},function(data){
                console.log(data)

                $(el).append($("<option/>",{
                            value:'',
                            text:''
                        }))
                $.each(data,function(i,item){
                    $(el).append($("<option/>",{
                            value:item.id,
                            text:item.name
                        }))

                });

            })
        }
        var today=new Date();
            $('#paiddate,#paiddatelast,#dd,#d1,#d2').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });

        $(document).on('click','#tbl_partner_list td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         savecustomertolocalstorage(autocompletebuyer,autocompletesaler,autocompletedoat);
         function autocompletebuyer(){
            var sources=JSON.parse(localStorage.getItem("buyers"));
            var sources1=JSON.parse(localStorage.getItem("idbuyers"));
            $('#name2').autocomplete({
                source:sources,
                select: function( event, ui ) {
                    $('#name2').val( ui.item.value );
                    $('#customer_id').val(ui.item.id);
                    $('#sex2').val(ui.item.sex);
                    $('#age2').val(ui.item.age);
                    $('#nation2').val(ui.item.nation);
                    $('#id2').val(ui.item.idcard);
                    $('#tel2').val(ui.item.tel);
                    $('#sel_province2').val(ui.item.province_id);
                    $('#sel_province2').trigger('change');

                    $('#sel_district2').empty().append($("<option/>",{
                        value:ui.item.district_id,
                        text:ui.item.districtname,
                    }))
                    $('#sel_commune2').empty().append($("<option/>",{
                        value:ui.item.commune_id,
                        text:ui.item.communename,
                    }))
                    $('#sel_village2').empty().append($("<option/>",{
                        value:ui.item.village_id,
                        text:ui.item.villagename,
                    }))
                    return false;
                }
            });

            $('#id2').autocomplete({
                source:sources1,
                select: function( event, ui ) {
                    $('#id2').val( ui.item.value );
                    $('#sex2').val(ui.item.sex);
                    $('#age2').val(ui.item.age);
                    $('#nation2').val(ui.item.nation);
                    $('#name2').val(ui.item.name);
                    $('#customer_id').val(ui.item.id);
                    $('#tel2').val(ui.item.tel);
                    $('#sel_province2').val(ui.item.province_id);
                    $('#sel_province2').trigger('change');

                    $('#sel_district2').empty().append($("<option/>",{
                        value:ui.item.district_id,
                        text:ui.item.districtname,
                    }))
                    $('#sel_commune2').empty().append($("<option/>",{
                        value:ui.item.commune_id,
                        text:ui.item.communename,
                    }))
                    $('#sel_village2').empty().append($("<option/>",{
                        value:ui.item.village_id,
                        text:ui.item.villagename,
                    }))
                    return false;
                }
            });

        }
        function autocompletesaler(){
            var sources=JSON.parse(localStorage.getItem("salers"));
            var sources1=JSON.parse(localStorage.getItem("idsalers"));

            $('#name3').autocomplete({
                source:sources,
                select: function( event, ui ) {
                    $('#name3').val( ui.item.value );
                    $('#saler_id').val(ui.item.id);
                    $('#sex3').val(ui.item.sex);
                    $('#age3').val(ui.item.age);
                    $('#nation3').val(ui.item.nation);
                    $('#tel3').val(ui.item.tel);
                    $('#id3').val(ui.item.idcard);
                    $('#sel_province3').val(ui.item.province_id);
                    $('#sel_province3').trigger('change');

                    $('#sel_district3').empty().append($("<option/>",{
                        value:ui.item.district_id,
                        text:ui.item.districtname,
                    }))
                    $('#sel_commune3').empty().append($("<option/>",{
                        value:ui.item.commune_id,
                        text:ui.item.communename,
                    }))
                    $('#sel_village3').empty().append($("<option/>",{
                        value:ui.item.village_id,
                        text:ui.item.villagename,
                    }))

                    return false;
                }
            });

            $('#id3').autocomplete({
                source:sources1,
                select: function( event, ui ) {
                    $('#id3').val( ui.item.value );
                    $('#sex3').val(ui.item.sex);
                    $('#age3').val(ui.item.age);
                    $('#nation3').val(ui.item.nation);
                    $('#name3').val(ui.item.name);
                    $('#saler_id').val(ui.item.id);
                    $('#tel3').val(ui.item.tel);
                    $('#sel_province3').val(ui.item.province_id);
                    $('#sel_province3').trigger('change');

                    $('#sel_district3').empty().append($("<option/>",{
                        value:ui.item.district_id,
                        text:ui.item.districtname,
                    }))
                    $('#sel_commune3').empty().append($("<option/>",{
                        value:ui.item.commune_id,
                        text:ui.item.communename,
                    }))
                    $('#sel_village3').empty().append($("<option/>",{
                        value:ui.item.village_id,
                        text:ui.item.villagename,
                    }))

                    return false;
                }
            });

        }
        function autocompletedoat(){
            var sources=JSON.parse(localStorage.getItem("doats"));
            $('#doat').autocomplete({
                source:sources,
                select: function( event, ui ) {
                    $('#doat').val( ui.item.value );
                    return false;
                }
            });
        }
        function savecustomertolocalstorage(callback1,callback2,callback3){
            localStorage.removeItem("buyers");
            localStorage.removeItem("salers");
            localStorage.removeItem("idbuyers");
            localStorage.removeItem("idsalers");
            localStorage.removeItem("doats");
            var url="{{ route('realestate.buyersalerlocalstorage') }}";
            $.get(url,{},function(data){
            console.log(data);
            var buyers;
            var salers;
            var idbuyers;
            var idsalers;
            var doats;
            if(localStorage.getItem("buyers")==null){
                buyers=[];
            }else{
                buyers=JSON.parse(localStorage.getItem("buyers"));
            }
            if(localStorage.getItem("salers")==null){
                salers=[];
            }else{
                salers=JSON.parse(localStorage.getItem("salers"));
            }
            if(localStorage.getItem("idbuyers")==null){
                idbuyers=[];
            }else{
                idbuyers=JSON.parse(localStorage.getItem("idbuyers"));
            }
            if(localStorage.getItem("idsalers")==null){
                idsalers=[];
            }else{
                idsalers=JSON.parse(localStorage.getItem("idsalers"));
            }
            if(localStorage.getItem("doats")==null){
                doats=[];
            }else{
                doats=JSON.parse(localStorage.getItem("doats"));
            }
            $.each(data['buyers'],function(i,item){
                buyers.push({
                    value:item.name,
                    label:item.name,
                    id:item.id,
                    idcard:item.idcard,
                    sex:item.sex,
                    age:item.age,
                    nation:item.nation,
                    tel:item.tel,
                    province_id:item.province_id,
                    district_id:item.district_id,
                    districtname:item['district'].name,
                    commune_id:item.commune_id,
                    communename:item['commune'].name,
                    village_id:item.village_id,
                    villagename:item['village'].name,
                })

                idbuyers.push({
                    value:item.idcard,
                    label:item.idcard,
                    id:item.id,
                    name:item.name,
                    sex:item.sex,
                    age:item.age,
                    nation:item.nation,
                    tel:item.tel,
                    province_id:item.province_id,
                    district_id:item.district_id,
                    districtname:item['district'].name,
                    commune_id:item.commune_id,
                    communename:item['commune'].name,
                    village_id:item.village_id,
                    villagename:item['village'].name,
                })

            });
            $.each(data['salers'],function(i,item){
                salers.push({
                    value:item.name,
                    label:item.name,
                    id:item.id,
                    idcard:item.idcard,
                    sex:item.sex,
                    age:item.age,
                    nation:item.nation,
                    tel:item.tel,
                    province_id:item.province_id,
                    district_id:item.district_id,
                    districtname:item['district'].name,
                    commune_id:item.commune_id,
                    communename:item['commune'].name,
                    village_id:item.village_id,
                    villagename:item['village'].name,
                })

                idsalers.push({
                    value:item.idcard,
                    label:item.idcard,
                    id:item.id,
                    name:item.name,
                    sex:item.sex,
                    age:item.age,
                    nation:item.nation,
                    tel:item.tel,
                    province_id:item.province_id,
                    district_id:item.district_id,
                    districtname:item['district'].name,
                    commune_id:item.commune_id,
                    communename:item['commune'].name,
                    village_id:item.village_id,
                    villagename:item['village'].name,
                })

            });

            $.each(data['doats'],function(i,item){
                doats.push({
                    value:item,
                    label:item,
                })
            });

            localStorage.setItem("buyers",JSON.stringify(buyers));
            localStorage.setItem("salers",JSON.stringify(salers));
            localStorage.setItem("idbuyers",JSON.stringify(idbuyers));
            localStorage.setItem("idsalers",JSON.stringify(idsalers));
            localStorage.setItem("doats",JSON.stringify(doats));
            callback1();
            callback2();
            callback3();
            })
        }



    })//document
    function formatNumber(n,d=2) {
            var num=n;
			if(num=='' || isNaN(num)){
				return 0;
			}else{
                num=parseFloat(n).toFixed(d);
            }

			num=parseFloat(num);
			var k=String(num).split('.');
			if(k.length==2){
				var fnum=k[0].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
				var snum=k[1];
				return fnum + '.' + snum;
				//return num.toFixed(2);
			}else{
				return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
			}
		}
        $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toUpperCase();
            $("#tbllist tr").each(function(index) {
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
        });
</script>
