@extends('master')
@section('title') Stock @endsection
@section('css')
    <style type="text/css">
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
        <div class="col-lg-12">
            <h1 class="kh22-b">ស្តុកទំនិញ</h1>
        </div>
    </div>
   <div class="row">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td style="border-style:none;width:220px;" class="kh22">កាលបរិច្ឆេទ</td>
                    <td style="border-style:none;"></td>
                    <td style="border-style:none;"></td>
                </tr>
                <tr>
                    <td style="border-style:none;padding:0px;">
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="stockdate" id="stockdate" class="form-control" style="width:170px;height:45px;background-color:silver;font-size:22px;">
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>
                    </td>
                    <td style="border-style:none;padding:0px 0px 0px 10px;" class="">
                        <button id="btnshow" class="btn btn-info kh22">បង្ហាញ</button>
                    </td>
                    <td style="border-style:none;padding:0px;" class="">
                        <button id="btnselectprint" class="btn btn-info kh22">ជ្រើសរើសព្រីន</button>
                    </td>
                    <td style="border-style:none;padding:0px;" class="">
                        <button id="btneditstock" class="btn btn-warning kh22">កែស្តុក</button>
                    </td>
                </tr>
            </table>
        </div>
   </div>
   <div class="row">
        <div class="col-lg-2">
            <div class="table-responsive">
                <table class="table table-bordered tbl_stockdate">
                    <thead>
                        <th>Stock Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($stockdates as $stdate)
                            <tr>
                                <td class="kh22" style="padding:0px;">{{ date('d-m-Y',strtotime($stdate->stockdate)) }}</td>
                                <td class="kh22" style="padding:0px;text-align:center;">
                                    <a href="#" class=" btnview" data-date="{{ date('d-m-Y',strtotime($stdate->stockdate)) }}">View</a>
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
                    <thead class="kh22" style="text-align:center;">
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input ck_all kh22" type="checkbox" value="" id="cksel_all">
                                    <label class="form-check-label kh22" for="cksel_all">
                                        លរ
                                    </label>
                                </div>
                            </th>
                            <th style="display:none;">លេខកូដ</th>
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
        $(document).on('click','.btnview',function(e){
            e.preventDefault();
            var d=$(this).data('date');
            $('#stockdate').val(d);
            $('#btnshow').click();

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
                $(".ck_all").prop("checked", false);
                var d=$('#stockdate').val();
                var url="{{ route('stock.showstock') }}";
                $.get(url,{stockdate:d},function(data){
                    $('#stock').empty().html(data);
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
                          <input type="text" class="form-control amtstock kh22" style="text-align:right;" name="amtstock[]" value="${row.cells[3].innerHTML.trim()}">
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control curstock kh22" style="text-align:left;width:100%;" name="curstock[]" value="&nbsp;&nbsp; ${row.cells[2].innerHTML}" readonly>
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
                $('#editstockmodal').modal('show');

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
                var d=$('#savedate').val();
                var formdata = new FormData(frmeditstock);
                formdata.append('stockdate',d);
                var url="{{ route('stock.saveeditstock') }}";
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
                            //location.reload();
                            $('#editstockmodal').modal('hide');
                            alert('all product stock have been saved')
                            $('#btnshow').click();

                       }else{
                            alert(data.error)
                       }


                    },
                    error: function () {
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
