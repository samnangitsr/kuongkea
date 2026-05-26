@extends('master')
@section('title') Settransferrate @endsection
@section('css')
    <style type="text/css">
         body.wait *{
			cursor: wait !important;
		}
        #seltranname + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:30px;}
		/* Each result */
		#select2-seltranname-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:aquamarine;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;font-weight:bold;}
        .en16{
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
            }
        .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
        .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }

       .cgr{
        background-color:aquamarine;
       }
       /* td{
        border-style:none;
       } */
       #tbl_setratelist .clickedrow td{
        background-color: #caaf8f;
    }
    #tbl_tranname .clickedrow td{
        background-color: #caaf8f;
    }
    #tblsearchmore td{
        border-style:none;
    }
    .delrecord{
        background-color:red;
    }
    #tbl_setratelist td{
        padding:2px;
    }
    #tbl_tranname_register td{
        padding:0px;
        border-style:none;
    }
    #tbl_setrate td input{
        padding:2px;
    }
    </style>
@endsection
@section('content')
    @php
        function phpformatnumber($num){
            $dc=0;
            $p=strpos((float)$num,'.');
            if($p>0){
            $fp=substr($num,$p,strlen($num)-$p);
            $dc=strlen((float)$fp)-2;

            }
            return number_format($num,$dc,'.',',');
        }
    @endphp
    <div class="row">
        <div class="table-responsive">
            <table class="">
                <tr class="kh16">
                    <th style="border-style:none;">កាលបរិច្ឆេទ</th>
                    <th style="border-style:none;">ប្រភេទអាជីវកម្ម</th>
                    <th style="border-style:none;">ប្រតិបត្តិការណ៏</th>
                    <th style="border-style:none;">រូបិយប័ណ្ណ</th>
                    <th style="border-style:none;">For USD</th>
                    <th style="border-style:none;">អត្រា</th>
                    <th style="border-style:none;">For THB</th>
                    <th style="border-style:none;">អត្រា</th>
                </tr>
                <tr>
                    <td style="padding:0px;border-style:none;width:160px;">
                        <div class="input-group" style="width:160px;">
                            <input type="text" name="d1" id="d1" class="form-control kh16-b" style="width:100px;background-color:silver;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                    </td>
                    <td style="border-style:none;padding:0px;">
                        <select name="selagenttype" id="selagenttype" class="form-select kh16-b" style="width:150px;">
                            <option value=""></option>
                            @foreach ($agenttypes as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="border-style:none;padding:0px;">
                        <select multiple="multiple" class="kh16-b seltranname" name="seltranname[]" id="seltranname" style="width:300px;">

                        </select>
                    </td>
                    <td>
                        <select name="selcur" id="selcur" class="form-select kh16-b">
                            <option value="KHR">KHR</option>
                            <option value="USD">USD</option>
                            <option value="THB">THB</option>
                        </select>
                    </td>
                    <td>
                        <select name="applycur" id="applycur" class="form-select kh16-b" style="background-color:yellow;">
                            <option value=""></option>
                            <option value="USD">USD</option>
                            {{-- <option value="KHR">KHR</option>
                            <option value="THB">THB</option> --}}
                        </select>
                    </td>
                    <td>
                        <input type="text" id="txtrate" name="txtrate" style="width:100px;" class="form-control kh16-b" value="4000.00">
                    </td>
                      <td>
                        <select name="applycur_thb" id="applycur_thb" class="form-select kh16-b" style="background-color:aqua">
                            <option value=""></option>
                            {{-- <option value="USD">USD</option>
                            <option value="KHR">KHR</option> --}}
                            <option value="THB">THB</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" id="txtrate_khr_thb" name="txtratekhr__thb" style="width:80px;" class="form-control kh16-b" value="100">
                    </td>
                    <td style="padding:0px 0px 0px 5px;border-style:none;">
                        <button class="btn btn-info btn-md kh16-b" id="btnaddrow">AddRow</button>
                    </td>

                    <td style="padding-left:5px;">
                        <input type="button" class="btn btn-primary kh16-b" id="btnsearch" style="" value="Search">
                    </td>
                    <td style="padding-left:5px;">
                        <input type="button" class="btn btn-primary kh16-b" id="btntrannameregister" style="" value="ចុះឈ្មោះប្រតិបត្តិការណ៏">
                    </td>
                </tr>

            </table>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-6">
            <form id="frmsetwingrate" action="">
                <div class="row" style="margin-top:20px;">
                        <div class="table-responsive">
                            <table id="tbl_setrate" class="table table-bordered kh16">
                                <thead class="" style="text-align:center;">
                                    <th>លរ</th>
                                    <th>ទឹកប្រាក់ចាប់ពី</th>
                                    <th>រហូតដល់</th>
                                    <th>សេវ៉ាវេរ</th>
                                    <th>ភ្នាក់ងារវេរ</th>
                                    <th>ភ្នាក់ងារដក</th>
                                    <th>សក</th>
                                </thead>

                                <tbody id="bodysetrate">


                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="row">
                    <table>
                        <tr>
                            <td style="padding:0px 0px 0px 5px;border-style:none;">
                                <button class="btn btn-info btn-md kh16-b" id="btnsetwingrate">Save Rate</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
        <div class="col-lg-6" style="">
            <div class="row" style="margin-top:20px;">
                <div class="table-responsive">
                    <table id="tbl_setratelist" class="table table-bordered kh16">
                        <thead style="text-align:center;" class="">
                            <th>លរ</th>
                            <th>ទឹកប្រាក់ចាប់ពី</th>
                            <th>រហូតដល់</th>
                            <th>សេវ៉ាវេរ</th>
                            <th>ភ្នាក់ងារវេរ</th>
                            <th>ភ្នាក់ងារដក</th>
                            <th>សក</th>
                        </thead>

                        <tbody id="bodysetratelist">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

     {{-- @include('moneytransfers.settransferratemodal') --}}
     @include('moneytransfers.trannameregistermodal')

@endsection
@section('script')

    <script type="text/javascript">
    $('#h1_title').text('កំណត់អត្រាវេរលុយ');
    $(document).ready(function () {

        $('#seltranname').select2({
            // dropdownParent: $("#settransferratemodal")

        });

        addrow();
        var today=new Date();
            $('#d1,#d2').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
        var cleave = new Cleave('#txtrate', {
          numeral: true,
          numeralPositiveOnly: true,
          //numeralThousandsGroupStyle: 'thousand'
        });
        $(document).on('click','#tbl_setrate td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_setratelist td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_tranname td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#btnaddnewrate',function(e){
            $('#settransferratemodal').modal('show');
         })
         $(document).on('click','#btnsearch',function(e){
            showratelist();
         })
         function showratelist()
         {
            $('body').addClass("wait");
            var agenttype=$('#selagenttype').val();
            var tranname=$('#seltranname').val();
            var cur=$('#selcur').val();
            var url="{{ route('moneytransfer.showratelist') }}";
            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {agenttype:agenttype,tranname:tranname,cur:cur},
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#bodysetratelist').empty().html(data);
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
        $(document).on("click", ".btnedit", function (e) {
            e.preventDefault();
            let row = $(this).closest("tr");
            let id = row.data("id");
            // Save original values to data attributes (so we can restore on cancel)
            row.data("orig-amt1", row.find("td.amt1").text().trim());
            row.data("orig-amt2", row.find("td.amt2").text().trim());
            row.data("orig-transfer_rate", row.find("td.transfer_rate").text().trim());
            row.data("orig-cashdraw_rate", row.find("td.cashdraw_rate").text().trim());
            row.data("orig-customer_rate", row.find("td.customer_rate").text().trim());

            // Convert cells to input fields
            row.find("td.amt1").html('<input type="text" class="form-control form-control-sm edit-amt1 en16" value="'+ row.data("orig-amt1") +'">');
            row.find("td.amt2").html('<input type="text" class="form-control form-control-sm edit-amt2 en16" value="'+ row.data("orig-amt2") +'">');
            row.find("td.transfer_rate").html('<input type="text" class="form-control form-control-sm edit-transfer_rate en16" value="'+ row.data("orig-transfer_rate") +'">');
            row.find("td.cashdraw_rate").html('<input type="text" class="form-control form-control-sm edit-cashdraw_rate en16" value="'+ row.data("orig-cashdraw_rate") +'">');
            row.find("td.customer_rate").html('<input type="text" class="form-control form-control-sm edit-customer_rate en16" value="'+ row.data("orig-customer_rate") +'">');

            // Change buttons → Save + Cancel
            row.find(".btnedit").replaceWith(
                '<a href="#" class="btn btn-success btn-sm kh12-b btnsaveupdate" data-id="'+ id +'"><i class="fa fa-check"></i></a> ' +
                '<a href="#" class="btn btn-secondary btn-sm kh12-b btncancel" data-id="'+ id +'"><i class="fa fa-times"></i></a>'
            );
        });

       // ✅ Cancel Edit
        $(document).on("click", ".btncancel", function (e) {
            e.preventDefault();

            let row = $(this).closest("tr");
            let id = $(this).data("id");

            // Restore original text values
            row.find("td.amt1").text(row.data("orig-amt1"));
            row.find("td.amt2").text(row.data("orig-amt2"));
            row.find("td.transfer_rate").text(row.data("orig-transfer_rate"));
            row.find("td.cashdraw_rate").text(row.data("orig-cashdraw_rate"));
            row.find("td.customer_rate").text(row.data("orig-customer_rate"));

            // 🔥 Remove ALL buttons in last cell, then put Edit + Delete back
            let actionCell = row.find("td:last");
            actionCell.html(
                '<a href="#" class="btn btn-warning btn-sm kh12-b btnedit" data-id="'+ id +'"><i class="fa fa-pencil"></i></a> ' +
                '<a href="#" class="btn btn-danger btn-sm kh12-b btndel" data-id="'+ id +'"><i class="fa fa-trash"></i></a>'
            );
        });


        $(document).on("click", ".btnsaveupdate", function (e) {
            e.preventDefault();
            $('body').addClass("wait");

            let row = $(this).closest("tr");
            let id = $(this).data("id");

            let data = {
                id: id,
                amt1: row.find(".edit-amt1").val(),
                amt2: row.find(".edit-amt2").val(),
                transfer_rate: row.find(".edit-transfer_rate").val(),
                cashdraw_rate: row.find(".edit-cashdraw_rate").val(),
                customer_rate: row.find(".edit-customer_rate").val(),
                _token: "{{ csrf_token() }}"
            };

            let url = "{{ route('moneytransfer.updateratelist') }}";

            $.ajax({
                async:true,
                type: "POST",
                url: url,
                data: data,
                success: function (res) {
                    //console.log(res);
                    if ($.isEmptyObject(res.error)) {
                    // Restore original text values
                        row.find("td.amt1").text(formatNumber(res['data'].amt1));
                        row.find("td.amt2").text(formatNumber(res['data'].amt2));
                        row.find("td.transfer_rate").text(res['data'].transfer_rate);
                        row.find("td.cashdraw_rate").text(res['data'].cashdraw_rate);
                        row.find("td.customer_rate").text(res['data'].customer_rate);

                        // 🔥 Remove ALL buttons in last cell, then put Edit + Delete back
                        let actionCell = row.find("td:last");
                        actionCell.html(
                            '<a href="#" class="btn btn-warning btn-sm kh12-b btnedit" data-id="'+ res['data'].id +'"><i class="fa fa-pencil"></i></a> ' +
                            '<a href="#" class="btn btn-danger btn-sm kh12-b btndel" data-id="'+ res['data'].id +'"><i class="fa fa-trash"></i></a>'
                        );
                    } else {
                        alert(res.error);
                    }

                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert("Update Error.");
                }
            });
        });

         $(document).on('click','.btnedit_tranname',function(e){
            //debugger;
            var id=$(this).data('id');
            var typeid=$(this).data('agenttypeid');
            var tranname=$(this).data('tranname');
            var sign=$(this).data('sign');
            var num=$(this).data('num');
            var popular=$(this).data('popular');
            var istc=$(this).data('istc');

            $('#tranname_id').val(id);
            $('#selagenttype1').val(typeid);
            $('#selagenttype1').trigger('change');
            $('#tranname').val(tranname);
            $('#no').val(num);
            if(sign<0){
                const rbu = document.getElementById('radbalup');
                rbu.checked = true;
            }else{
                const rbd = document.getElementById('radbaldown');
                rbd.checked = true;

            }
            if(sign==-4 || sign==4){
                const ra = document.getElementById('radaffect');
                ra.checked = true;
            }else{
                const rna = document.getElementById('radnotaffect');
                rna.checked = true;

            }
            const isfav = document.getElementById('isfav');
            if(popular==1){
                isfav.checked=true;
            }else{
                isfav.checked=false;
            }
            document.getElementById('istransfer').checked=istc;
            $('#btnsavetranname').text('កែប្រែ');
            $('#btndeltranname').css('display','inline');

         })
         $(document).on('click','#btntrannameregister',function(e){
            $('#trannameregistermodal').modal('show');
         })
         $(document).on('click','#btndeltranname',function(e){
            e.preventDefault();
                var id=$('#tranname_id').val();

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
                            url: "{{ route('moneytransfer.deletetranname') }}",
                            data: { id:id },
                            success: function (data) {
                                //console.log(data);
                                if (data.success === true) {

                                    showtranname($('#selagenttype1').val());
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
         $(document).on('click','#btnnewtranname',function(e){
            e.preventDefault();
            $('#tranname_id').val('');
            $('#btndeltranname').css('display','none');
            $('#btnsavetranname').text('រក្សាទុក');
            $('#tranname').val('');
            getmaxno($('#selagenttype1').val());
         })
         function getmaxno(agenttypeid)
         {

            var url="{{ route('moneytransfer.getmaxtrannameno') }}";
            $.get(url,{agenttypeid:agenttypeid},function(data){
                $('#no').val(data['maxno']);
            })
         }
         $(document).on('click','#btnsavetranname',function(e){
            e.preventDefault();
            //debugger;
            $('body').addClass("wait");
            var isfav=document.getElementById("isfav").checked;
            var istransfer=document.getElementById("istransfer").checked;

            var formdata=new FormData(frmtranname);
            formdata.append('isfav',isfav);
            formdata.append('istransfer',istransfer);

            var url="{{ route('moneytransfer.storetranname') }}"
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                success: function (data) {
                    console.log(data);
                    if($.isEmptyObject(data.error)){
                        showtranname($('#selagenttype1').val());
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
         $(document).on('change','#selagenttype1',function(e){

            e.preventDefault();
            showtranname($(this).val());
            if($('#tranname_id').val()==''){
                getmaxno($('#selagenttype1').val());
            }
         })
         function showtranname(agentid)
         {

            $('body').removeClass("wait");

            var url="{{ route('moneytransfer.showtranname') }}";
            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {agentid:agentid},
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#body_tranname').empty().html(data);
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

         $(document).on('change','#selagenttype',function(e){
                e.preventDefault();
                var agenttypeid=$('#selagenttype').val();
                $('#seltranname').empty();
                var url="{{ route('moneytransfer.gettranname') }}";
                $.get(url,{id:agenttypeid},function(data){
                   console.log(data);
                   $('#seltranname').append($("<option/>",{
						value:'',
						text:''
					}))
                    $.each(data['trannames'],function(i,item){
                        $('#seltranname').append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))
                    });
                })
           })
           $(document).on('click','.btndel',function(e){
                e.preventDefault();
                var q = confirm("Do you want to remove this item?");
                if (!q) return;
                var removed=0;
                var id=$(this).data('id');
                var url="{{ route('moneytransfer.delsetrate') }}";
                $.get(url,{id:id},function(data){

                    if(data['del']=='1'){
                        removed=1;

                    }
                    //alert(data['message']);
                })
                if(removed==1){
                    $(this).closest("tr").remove();
                }
           })
           $(document).on('change','#selagenttype1',function(e){
                e.preventDefault();
                var agenttypeid=$('#selagenttype1').val();
                $('#seltranname1').empty();
                var url="{{ route('moneytransfer.gettranname') }}";
                $.get(url,{id:agenttypeid},function(data){
                   console.log(data);
                   $('#seltranname1').append($("<option/>",{
						value:'',
						text:''
					}))
                    $.each(data['trannames'],function(i,item){
                        $('#seltranname1').append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))
                    });
                })
           })
           $(document).on('click','#btnaddrow',function(e){
            e.preventDefault();
            addrow();
           })
           $(document).on('click','.btnremove',function(e){
                e.preventDefault();
                $(this).closest("tr").remove();
                ResetNo();

            });
            function ResetNo(){
                $('.no').each(function(i,e){
                    $(this).text(i+1);
                })
            }
           function addrow()
           {
            //debugger;
            var amt1=0;
            var table = document.getElementById("tbl_setrate");
            var nn=table.tBodies[0].rows.length+1;
            if(nn>1){
                amt1=$('.amt2').eq(nn-2).val();
            }
            var row=`
                <tr>
                            <td class="no" style="text-align:center;padding:2px;">${nn}</td>
                            <td style="padding:0px;">
                                <input type="text" name="amt1[]" class="form-control tdcanenter amt1 kh16-b" style="width:150px;" value="${amt1}">
                            </td>
                            <td style="padding:0px;">
                                <input type="text" name="amt2[]" class="form-control tdcanenter amt2 kh16-b" style="width:150px;">
                            </td>
                            <td style="padding:0px;">
                                <input type="text" name="customercharge[]" class="form-control tdcanenter kh16-b customercharge">
                            </td>
                            <td style="padding:0px;">
                                <input type="text" name="agentvey[]" class="form-control tdcanenter kh16-b agentvey">
                            </td>
                            <td style="padding:0px;">
                                <input type="text" name="agentdork[]" class="form-control tdcanenter kh16-b agentdork">
                            </td>

                            <td style="padding:0px;">
                                <a href="#" class="btn btn-danger btn-sm btnremove kh12-b" style="height:30px;">លុប</a>
                            </td>
                        </tr>
                    `;
                    $('#bodysetrate').append(row);
                    $('.amt1').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
                    $('.amt2').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
                    // $('.agentvey').toArray().forEach(function(field){
                    //     new Cleave(field, {
                    //         numeral: true,
                    //         numeralDecimalScale: 6,
                    //         numeralThousandsGroupStyle: 'thousand'
                    //     });
                    // })
                    // $('.agentdork').toArray().forEach(function(field){
                    //     new Cleave(field, {
                    //         numeral: true,
                    //         numeralDecimalScale: 6,
                    //         numeralThousandsGroupStyle: 'thousand'
                    //     });
                    // })
                    // $('.customercharge').toArray().forEach(function(field){
                    //     new Cleave(field, {
                    //         numeral: true,
                    //         numeralDecimalScale: 6,
                    //         numeralThousandsGroupStyle: 'thousand'
                    //     });
                    // })
           }

           $(document).on('click','#btnsetwingrate',function(e){
            e.preventDefault();


            var applycur=$('#applycur').val();
            var applycur_thb=$('#applycur_thb').val();

            var selcur=$('#selcur').val();
            var rate=$('#txtrate').val().replace(/,/g,"");
            var rate_thb=$('#txtrate_khr_thb').val().replace(/,/g,"");
            var formdata=new FormData(frmsetwingrate);
            if(selcur=='USD' && applycur !=='' || selcur=='USD' && applycur_thb !==''){
                alert('you can not apply USD currency ')
                return;
            }
             $('body').addClass("wait");
            if(selcur=='KHR' && applycur !==''){
                if(rate!==''){
                    let number = rate // as string
                    // Remove commas first
                    //number = number.replace(/,/g, "");
                    let decimals = 0;
                    if (number.includes(".")) {
                        decimals = number.split(".")[1].length;
                    }
                    formdata.append('isapplycur_usd',1);
                    formdata.append('sign','/');
                    formdata.append('decimals',decimals);

                }
            }
            if(selcur=='KHR' && applycur_thb !==''){
                if(rate_thb!==''){
                    formdata.append('isapplycur_thb',1);
                    formdata.append('signthb','/');
                }
            }
            formdata.append('selcur',selcur);
            formdata.append('selcur_usd',applycur);
            formdata.append('selcur_thb',applycur_thb);
            formdata.append('rate',rate);
            formdata.append('rate_thb',rate_thb);

            formdata.append('selagenttype',$('#selagenttype').val());
            formdata.append('seltranname',$('#seltranname').val());
            formdata.append('d1',$('#d1').val());

            var url="{{ route('moneytransfer.storerateset') }}"
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                success: function (data) {
                    //console.log(data);
                    if($.isEmptyObject(data.error)){
                        showratelist();
                        $('#tbl_setrate').find('tbody').empty();
                        addrow();
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

           $(document).on('keydown','.tdcanenter',function(e){
                if (e.keyCode == 13) {
                    var table = document.getElementById("tbl_setrate");
                    var tbodyRowCount = table.tBodies[0].rows.length;
                    var rowind=$(this).closest('tr').index();
                    if(rowind==tbodyRowCount-1){
                        addrow();
                    }
                    var $this = $(this),
                    index = $this.closest('td').index();
                    $this.closest('tr').next().find('td').eq(index).find('input').focus().select();


                    e.preventDefault();
                }
            })


    })



    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }


    </script>
@endsection
