@extends('master')
@section('title') Stock @endsection
@section('css')
    <style type="text/css">
         body.wait, body.wait *{
			cursor: wait !important;
		}
        .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
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
    .tbl_stock .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_stock .clickedrow td input{
        background-color: #caaf8f;
    }
    .tbl_stockdate .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_stock td{
        padding:0px 5px;
    }
    .tbl_stock th{
        padding:3px;
    }
    .tbl_stockdate td{
        padding:5px;
    }
    .tbl_stockdate th{
        padding:3px;
    }
    .btn-3d {
            background: #3498db;
            color: white;
            margin:0px 2px;
            padding: 2px 10px;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 0 #011d30;
            cursor: pointer;
            transition: all 0.1s ease-in-out;
            font-weight: bold;
            }
        .btn-3d-primary{
            background: #344ddd;
            color: white;
        }
        .btn-3d-danger{
             background: #f3260b;
             color: white;
        }
         .btn-3d-warning{
             background: #c9a506;
             color: white;
        }

        .btn-3d:active {
            transform: translateY(4px);
            box-shadow: 0 1px 0 #2980b9;
            }
        .btn-3d:hover{
            background-color:green !important;
            color:white !important;
        }
        .input-3d {
            margin:0px 2px;
            padding: 0px 2px;
            border-radius: 6px;
            background: white;

            font-size: 16px;

            outline: none;
            border:1px solid black;
            box-shadow: 0 5px 0 #011d30;
            cursor: pointer;
            transition: all 0.1s ease-in-out;

            }

        .input-3d:focus {
            box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.15),
                        inset -2px -2px 4px rgba(255, 255, 255, 0.7);
            background: #e4f311 !important;
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
        if($dc>6){
            $dc=6;
        }
        }
        return number_format($num,$dc,'.',',');
    }

@endphp

   <div class="row">
        <div class="table-responsive">
            <table class="">
                <tr>
                    <td style="border-style:none;" class="kh22">ថ្ងៃទី</td>
                    <td style="border-style:none;">
                        <div class="input-group" style="width:170px;">
                            <input type="text" name="stockdate" id="stockdate" class="form-control" style="width:100px;height:30px;background-color:silver;font-size:16px;font-weight:bold;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td>
                        <select name="selgold" id="selgold" class="kh16-b">
                            <option value="0">លុយ</option>
                            <option value="1">មាស</option>
                            <option value="2">លុយ+មាស</option>
                        </select>
                    </td>
                     <td style="border-style:none;padding:0px 0px 0px 10px;" class="">
                        <button id="btnshow" class="btn-3d kh16-b">បង្ហាញ</button>
                    </td>
                    <td style="border-style:none;" class="">
                        <button id="btnselectprint" class="btn-3d kh16-b">ជ្រើសរើសព្រីន</button>
                    </td>
                    <td style="border-style:none;" class="">
                        <button id="btneditstock" class="btn-3d btn-3d-warning kh16-b">កែស្តុក</button>
                    </td>
                </tr>

            </table>
        </div>
   </div>
   <div class="row" style="margin-top:10px;">
        <div class="col-lg-2">
            <div class="table-responsive">
                <table class="table table-bordered tbl_stockdate">
                    {{-- <thead style="text-align:center;">
                        <th>Stock Date</th>
                        <th>Action</th>
                    </thead> --}}
                    <tbody>
                        @foreach ($stockdates as $stdate)
                            <tr>
                                <td class="kh16-b" style="">{{ date('d-m-Y',strtotime($stdate->stockdate)) }}</td>
                                <td class="kh16" style="text-align:center;width:60px;">
                                    <a href="#" class="btn btn-primary btn-sm btnview" data-date="{{ date('d-m-Y',strtotime($stdate->stockdate)) }}">View</a>
                                    <a href="#" class="btn btn-danger btn-sm btndelete" data-date="{{ date('d-m-Y',strtotime($stdate->stockdate)) }}">Del</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="table-responsive">
                <form id="frmstockreport" action="">
                    <table id="tbl_stock" class="table table-bordered tbl_stock">
                    <thead class="kh16" style="text-align:center;">
                            <th style="width:120px;">
                                <div class="form-check">
                                    <input class="form-check-input ck_all kh22" style="margin-left:-22px;margin-top:2px;background-color:#c9a506;" type="checkbox" value="" id="cksel_all">
                                    <label class="form-check-label kh16" for="cksel_all">
                                        លរ
                                    </label>
                                </div>
                            </th>
                            <th style="display:none;">លេខកូដ</th>
                            <th>ទឹកមាស</th>
                            <th>រូបិយប័ណ្ណ</th>
                            <th>ស្តុកទំនិញ</th>
                            <th>Shortcut</th>
                            <th>សរុបទឹកប្រាក់</th>
                            <th>អត្រា</th>
                    </thead>
                    <tbody id="stock">

                    </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
   @include('stocks.editstockmodal');
   <form id="frmsaveselectstock" action="">
        @include('stocks.selectstockprintmodal');
   </form>

@endsection
@section('script')
<script type="text/javascript">
    $('#h1_title').text('ស្តុកលុយ');
       $(document).ready(function () {
            var today=new Date();
            $('#stockdate,#savedate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
        //     var cleave1 = new Cleave('.stock', {
		// 	numeral: true,
		// 	numeralThousandsGroupStyle: 'thousand'
		// });
        $('.ck_all').click(function(){
            if (this.checked) {
                $(".cknum").prop("checked", true);
            } else {
                $(".cknum").prop("checked", false);
            }
        });
        $(document).on('click','.btnview',function(e){
            e.preventDefault();
            var d=$(this).data('date');
            $('#stockdate').val(d);
            $('#btnshow').click();

        })
        $(document).on('click','.btndelete',function(e){
            var d=$(this).data('date');
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
                        url: "{{ route('stock.delete') }}",
                        data: { stockdate:d },
                        success: function (data) {
                            //console.log(data);
                            if (data.success === true) {
                                location.reload();

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
        $(document).on('click','.tbl_stock td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','.tbl_stockdate td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
        $(document).on('keydown', '.tdcanenter', function (e) {
                if (e.keyCode == 13) {
                    var $this = $(this),
			        index = $this.closest('td').index();
			        $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
			        e.preventDefault();
                    totalamount();

                }
            })
            function totalamount()
            {
                var totalamt=0;
                $('.amtstock').each(function(i,e){
					totalamt +=parseFloat($(this).val().replace(/,/g,''));
                    $('#totalamount').text(formatNumber(totalamt));
				})

            }
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                 $('body').addClass("wait");
                $(".ck_all").prop("checked", false);
                var d=$('#stockdate').val();
                var isgold=$('#selgold').val();
                var url="{{ route('stock.showstock') }}";
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {stockdate:d,isgold:isgold},
                    //contentType: 'text/plain',
                    //contentType: false,
                    //processData: true,
                    //cache: false,
                    complete: function () {},
                    success: function (data) {
                        $('#stock').empty().html(data);
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })

            })
            $(document).on('click','#btnprintselectstock',function(e){
                e.preventDefault();
                //var d=$('#savedate').val();
                var formdata = new FormData(frmsaveselectstock);
                //formdata.append('stockdate',d);
                var url="{{ route('stock.saveselectstock') }}";
                $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       console.log(data)
                       if($.isEmptyObject(data.error)){
                        printselectstock(data.userprint);

                       }else{
                            alert(data.error)
                       }


                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
            })
        function printselectstock(userprint){
          var redirectWindow = window.open('{{ url('/') }}'+'/selectstock/print?printby='+userprint , '_blank');
          redirectWindow.location;
        }
            $(document).on('click','#btnselectprint',function(e){
                e.preventDefault();
                $('#selectprintmodal').modal('show');
                $('#body_select_print').empty();
                var nn=0;
                $("#stock input[type=checkbox]:checked").each(function () {
                    var row = $(this).closest("tr")[0];
                    nn=nn+1;
                    var row1=`<tr>
                      <td style="text-align:center;" class="no kh16">${nn}</td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control amtstock kh22" style="text-align:right;" name="amtstock[]" value="${row.cells[4].innerHTML.trim()}">
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control curstock kh22" style="text-align:left;width:100%;" name="curstock[]" value="&nbsp;&nbsp; ${row.cells[3].innerHTML}" readonly>
                      </td>
                  </tr>`;
                    $('#body_select_print').append(row1);
                });
                $('.amtstock').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })


            })


           $(document).on('click','#btneditstock',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                $('#editstockmodal').modal('show');
                var url="{{ route('stock.editstock') }}";

                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {},

                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                        var row='';
                        var total_usd=0;
                        for(let i=0;i<data.length;i++){

                            total_usd += parseFloat(data[i].stock_amount);
                            row +=`
                                <tr>
                                    <td style="padding:0px;text-align:center;">
                                        <input type="text" style="border-style:none;width:80px;text-align:center;" class="form-control kh22" value="${ i+1 }" readonly>
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" style="border-style:none;width:100px;text-align:center;" name="curid[]" class="form-control kh22" value="${ data[i].id }">
                                    </td>
                                    <td style="padding:0px;display:none;">
                                        <input type="text" style="border-style:none;width:100px;" name="opsign[]" class="form-control opsign kh22" value="${data[i].optsign }">
                                        <input type="text" style="border-style:none;width:100px;" name="isgold[]" class="form-control opsign kh22" value="${data[i].isgold??0 }">

                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" style="border-style:none;width:120px;" name="shortcut[]" class="form-control kh22" value="${data[i].curname}">
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" style="border-style:none;width:120px;" name="shortcut[]" class="form-control kh22" value="${data[i].shortcut}">
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" style="border-style:none;text-align:right;" name="stock[]" class="form-control tdcanenter stock kh22" value="${data[i].stock}">
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" style="border-style:none;text-align:center;" name="rate[]" class="form-control tdcanenter rate kh22" value="${data[i].stock_rate}">
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" style="border-style:none;text-align:right;" name="amtstock[]" class="form-control tdcanenter amtstock kh22" value="${data[i].stock_amount}">
                                    </td>
                                    <td>USD</td>
                                </tr>
                            `;
                        }
                        row += `
                            <tr style="background-color:aqua">
                                <td style="font-size:22px;" colspan=6>Total Amount</td>
                                <td id="totalamount" style="text-align:right;font-size:22px;">${ formatNumber(total_usd) }</td>
                                <td>USD</td>
                            </tr>
                        `;
                        $('#bodyeditstock').empty().html(row);
                        $('.stock').toArray().forEach(function(field){
                            new Cleave(field, {
                                numeral: true,
                                numeralThousandsGroupStyle: 'thousand'
                            });
                        })
                        $('.amtstock').toArray().forEach(function(field){
                            new Cleave(field, {
                                numeral: true,
                                numeralDecimalScale: 6,
                                numeralThousandsGroupStyle: 'thousand'
                            });
                        })
                        $('.rate').toArray().forEach(function(field){
                            new Cleave(field, {
                                numeral: true,
                                numeralDecimalScale: 6,
                                numeralThousandsGroupStyle: 'thousand'
                            });
                        })

                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })

           })
           function getoldstock()
           {
                var url="{{ route('stock.getlaststock') }}";
                $.get(url,{},function(data){
                    console.log(data)
                })
           }
           $(document).on('click','#btnsavestockedit',function(e){
                e.preventDefault();
                 $('body').addClass("wait");
                var d=$('#savedate').val();
                var formdata = new FormData(frmeditstock);
                formdata.append('stockdate',d);
                var url="{{ route('stock.saveeditstock') }}";
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       if($.isEmptyObject(data.error)){
                            //location.reload();
                            $('#editstockmodal').modal('hide');
                            alert('all product stock have been saved')
                            $('#btnshow').click();
                             $('body').removeClass("wait");
                       }else{
                         $('body').removeClass("wait");
                            alert(data.error)
                       }


                    },
                    error: function () {
                         $('body').removeClass("wait");
                        alert('Save Error')

                    }

                })
            })

            $(document).on('keyup','.stock,.rate',function(e){
                e.preventDefault();
                var row = $(this).closest('tr');
                var rowind=row.find("td input:eq(0)").val();
                var opsign=$('.opsign').eq(rowind-1).val();
                var rate=$('.rate').eq(rowind-1).val().replace(/,/g,'');
                var stock=$('.stock').eq(rowind-1).val().replace(/,/g,'');
                var amt=0;
                if(rate==0){
                    rate=1
                }
                if(opsign=='/'){
                    amt=stock/rate;
                }else{
                    amt=stock*rate;
                }
                $('.amtstock').eq(rowind-1).val(jsformatNumber(amt.toFixed(2)));
            })
            $(document).on('keyup','.amtstock',function(e){
                e.preventDefault();
                var row = $(this).closest('tr');
                var rowind=row.find("td input:eq(0)").val();
                var opsign=$('.opsign').eq(rowind-1).val();
                var amtstock=$('.amtstock').eq(rowind-1).val().replace(/,/g,'');
                var stock=$('.stock').eq(rowind-1).val().replace(/,/g,'');
                var rate=0;

                if(opsign=='/'){
                    rate=stock/amtstock;
                }else{
                    rate=amtstock/stock;
                }
                $('.rate').eq(rowind-1).val(jsformatNumber(rate.toFixed(6)));
            })
        })
        function jsformatNumber(num)
        {
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
    </script>
@endsection
