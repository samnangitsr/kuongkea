@extends('master')
@section('title') របាយការណ៏ចំណូលចំណាយ @endsection
@section('css')
    <link rel="stylesheet" tyle="text/css" href="{{ config('helper.asset_path') }}/css/virtual-select.min.css">
    <style type="text/css">
     body.wait *{
			cursor: wait !important;
		}
        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:30px;background-color:whitesmoke;font-weight:bold;}
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight:bold;}

       #sel_property + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:30px;background-color:whitesmoke;font-weight:bold;}
		#select2-sel_property-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight:bold;}

       #selbank + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:30px;background-color:whitesmoke;font-weight:bold;}
	    #select2-selbank-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight:bold;}


        #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:30px;background-color:white;font-weight:bold;}
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight:bold;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:30px;font-weight:bold;}
         .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
        .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            }
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
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
       #tbl_income .clickedrow td{
            background-color: #caaf8f;
        }
        #tbl_expanse .clickedrow td{
            background-color: #caaf8f;
        }
        #tblsearchmore td{
            border-style:none;
        }
        .delrecord{
            background-color:red;
        }


    .tableFixHead{ overflow: auto;border:1px solid black;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:rgb(165, 234, 243) }
    .tbl td{
        padding:2px 5px;
    }
    .tbl th{
        padding:3px;
    }
    .mybtn{
        border:1px solid black;
        height:27px;
    }
    .mybtn:hover{
        background-color:aquamarine;
    }
    .tbl1 td{
        padding:3px;
        border-style:none;
    }
    .tbl2 td{
        padding:5px 0px 0px 20px;
        border-style:none;
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

        <div class="row" style="margin-top:-20px;">

                <table class="table">
                    <tr class="kh14-b">
                        <th style="border-style:none;">គិតពី</th>
                        <th style="border-style:none;">ដល់</th>
                        @if(Auth::user()->role->name=='Admin')
                            <th style="border-style:none;">ក្រុមហ៊ុន</th>
                        @endif
                        <th style="border-style:none;">ធនាគា</th>
                        <th style="border-style:none;">ប្លុក</th>
                        <th style="border-style:none;">អចលនទ្រព្យ</th>
                    </tr>
                    <tr>
                        <td style="padding:0px;border-style:none;width:100px;">
                            <div class="input-group" style="width:100px;">
                                <input type="text" name="d1" id="d1" class="kh14-b" style="width:100px;background-color:silver;height:30px;padding:0px 5px 0px 5px;">
                            </div>
                        </td>
                        <td style="padding:0px;border-style:none;width:100px;">
                            <div class="input-group" style="width:100px;">
                                <input type="text" name="d2" id="d2" class="kh14-b" style="width:100px;background-color:silver;height:30px;padding:0px 5px 0px 5px;">
                            </div>
                        </td>
                        @if(Auth::user()->role->name=='Admin')
                            <td style="padding:0px;border-style:none;width:200px;">
                                <select name="selcompany" id="selcompany" class="kh16-b" style="width:100%;height:30px;">
                                    {{-- <option value="all">All Company</option> --}}
                                    @foreach ($companies as $comp)
                                        <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}}>{{ $comp->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        @endif
                         <td style="padding:0px;border-style:none;width:200px;">
                            <select name="selbank" id="selbank" class="kh16-b" style="width:200px;">
                                <option value="all">ទាំងអស់</option>
                                <option value="cash">សាច់ប្រាក់</option>
                                @foreach ($partners->where('customertype','BANK') as $b)
                                    <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" thai_list="{{ $b->thai_list }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </td>
                         <td class="kh16-b" style="padding:0px;width:220px;border-style:none;">
                            <select multiple class="select" name="selblock" id="selblock" style="width:200px;">
                                {{-- <option value="">all block</option> --}}
                                @foreach ($groups as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="width:150px;padding:0px;border-style:none;">
                            <select class="kh16-b" name="sel_property" id="sel_property" style="width:150px;">
                                <option value="">all property</option>
                                @foreach ($allproperty as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="padding:0px 0px 0px 5px;border-style:none;">
                            <button class="mybtn kh14-b" id="btnsearch">Search</button>
                            <button class="mybtn kh14-b" id="btnprintincome">Print income</button>
                            <button class="mybtn kh14-b" id="btnprintexpanse">Print Expanse</button>

                        </td>
                        <td style="padding:0px;border-style:none;">
                            <input type="text" class="kh16" id="tableSearch" style="width:100%;"  placeholder="Search What You Want..." title="Type what you khnow">
                        </td>
                    </tr>
                </table>

        </div>
        <div class="row" id="display_row">
            <div class="col-lg-12">
                 <div class="tableFixHead" style="padding:0px;margin:0px;">
                <table id="tbl_income" class="table table-bordered table-hover kh14-b tbl">
                    <thead style="text-align:center;">
                        <th>លរ</th>
                        <th>ថ្ងៃទី</th>
                        <th>ID</th>
                        <th>ឈ្មោះអ្នកទិញ</th>
                        <th>ប្រតិបត្តិការណ៏</th>
                        <th>ចំនួនទឹកប្រាក់</th>
                        <th>ប្រាក់ពិន័យ</th>
                        <th>សរុប</th>
                        <th>លើកលែង</th>
                        <th>ទូទាត់តាម</th>
                        <th>បង់សំរាប់ខែ</th>
                        <th>អ្នកកត់ត្រា</th>
                         <th>កំណត់សំគាល់</th>
                    </thead>
                    <tbody>
                        @php
                            $total=0;
                            $cuscharge=0;
                            $discount=0;
                        @endphp
                        @foreach ($incomes as $key => $in)
                            @php
                                $total +=$in->amount;
                                $cuscharge +=$in->cuscharge;
                                $discount +=$in->discount_amount
                            @endphp
                            <tr>
                                <td style="text-align:center;">{{ ++$key }}</td>
                                <td>{{ date('d-m-Y',strtotime($in->dd)) }}</td>
                                <td>{{ $in->id }}</td>
                                <td>{{ $in->customername }}</td>
                                <td>{{ $in->tranname . ' ' . $in->sendername }}</td>
                                <td style="text-align:right;color:blue;">{{ phpformatnumber($in->amount) . $in->currency->sk}}</td>
                                <td style="text-align:right;@if($in->cuscharge!=0) color:red; @endif">{{ phpformatnumber($in->cuscharge) . $in->cuschargecur->sk}}</td>
                                <td style="text-align:right;color:blue;">{{ phpformatnumber($in->amount+$in->cuscharge) . $in->currency->sk}}</td>
                                <td style="text-align:right;">
                                    <a href="" style="@if($in->discount_amount!=0) color:red; @else color:black; @endif" class="btndiscount" data-id="{{ $in->id }}" data-cusname="{{ $in->partner->name }}" data-tranname="{{ $in->tranname }}" data-amount="{{ $in->amount }}" data-cuscharge="{{ $in->cuscharge }}" data-cur="{{ $in->currency->shortcut }}" data-overday="{{ $in->overday }}" data-overprice="{{ $in->overprice }}" data-setoverday="{{ $in->setoverday }}" data-setoverprice="{{ $in->setoverprice }}" data-discount="{{ $in->discount_amount }}"> {{ phpformatnumber($in->discount_amount) . $in->cuschargecur->sk}}</a>
                                </td>
                                <td>{{ $in->deposit_via }}</td>
                                <td>{{ $in->payformonth?date('d-m-Y',strtotime($in->payformonth)):'' }}</td>
                                <td>{{ $in->user->name }}</td>
                                <td>{{ $in->note }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color:blue;">
                            <td class="kh16-b" style="color:white;" colspan=5>សរុបចំណូល</td>
                            <td class="kh16-b" style="text-align:right;color:white;">{{ phpformatnumber($total) . '$'}}</td>
                            <td class="kh16-b" style="text-align:right;color:white;">{{ phpformatnumber($cuscharge) . '$'}}</td>
                            <td class="kh16-b" style="text-align:right;color:white;">{{ phpformatnumber($total+$cuscharge) . '$'}}</td>
                            <td class="kh16-b" style="text-align:right;color:white;">{{ phpformatnumber($discount) . '$'}}</td>
                            <td colspan=4></td>
                        </tr>
                    </tbody>

                </table>
                </div>
            </div>
            <div class="col-lg-12">
                <table id="tbl_expanse" class="table table-bordered table-hover kh14-b tbl">
                    <thead style="text-align:center;background-color:aqua">
                        <th>លរ</th>
                        <th>ថ្ងៃទី</th>
                        <th>ID</th>
                        <th>ឈ្មោះអ្នកលក់</th>
                        <th>ប្រតិបត្តិការណ៏</th>
                        <th>ចំនួនទឹកប្រាក់</th>
                        <th>ទូទាត់តាម</th>
                        <th>អ្នកកត់ត្រា</th>

                    </thead>
                    <tbody style="background-color:rgb(235, 186, 231);">
                        @php
                            $total=0;
                        @endphp
                        @foreach ($expanses as $key => $out)
                            @php
                                $total +=$out->amount;
                            @endphp
                            <tr>
                                <td style="text-align:center;">{{ ++$key }}</td>
                                <td>{{ date('d-m-Y',strtotime($out->dd)) }}</td>
                                <td>{{ $out->id }}</td>
                                <td>{{ $out->customername }}</td>
                                <td>{{ $out->tranname }}</td>
                                <td style="text-align:right;color:red;">{{ phpformatnumber($out->amount) . $out->currency->sk}}</td>
                                <td>{{ $out->deposit_via }}</td>
                                <td>{{ $out->user->name }}</td>
                            </tr>
                        @endforeach
                            <tr style="background-color:red;">
                                <td class="kh16-b" style="color:white;" colspan=5>សរុបចំណាយ</td>
                                <td class="kh16-b" style="text-align:right;color:white;">{{ phpformatnumber($total) . '$'}}</td>
                                <td colspan=2></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @include('realestates.discountmodal');
@endsection
@section('script')
        <script src="{{ config('helper.asset_path') }}/js/virtual-select.min.js"></script>
    <script type="text/javascript">

    $(document).ready(function () {
         VirtualSelect.init({
                ele: '#selblock' ,
                 multiple: true,
            });
        $('#sel_property').select2();
        $('#selcustomer').select2();
        $('#selbank').select2();
        $('#seluser').select2();
        $('#h1_title').text('របាយការណ៏ចំណូលចំណាយពីការលក់អចលនទ្រព្យ');
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
        setheighttablefixhead(210);
        $(window).resize(function() {
            setheighttablefixhead(210);
        });
        function setheighttablefixhead(h)
        {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-h;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
            }
        }
        var cleave = new Cleave('#discount_amount', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
        $(document).on('click','#tbl_income td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })

         $(document).on('click','#tbl_expanse td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('change','#selcompany',function(e){
            e.preventDefault();
            getbankbycompany('#selbank');
         })
        function getbankbycompany(el)
        {
            $(el).empty();
            var selcompany=$('#selcompany').val();
            $('body').addClass("wait");
            var url="{{ route('company.getbank') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {company_id:selcompany},

                complete: function () {},
                success: function (data) {
                    //console.log(data)

                     $(el).append($("<option/>",{
                            value:'all',
                            text:'ទាំងអស់',
                        }))
                        $(el).append($("<option/>",{
                        value:'cash',
                        text:'សាច់ប្រាក់',

                    }))
                     $.each(data['banks'],function(i,item){
                        $(el).append($("<option/>",{
                                value:item.id,
                                text:item.name,
                        }))
                    });
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
         $(document).on('click','.btndiscount',function(e){
            e.preventDefault()
            var id=$(this).data('id');
            var cusname=$(this).data('cusname');
            var tranname=$(this).data('tranname');
            var amount=$(this).data('amount');
            var cuscharge=$(this).data('cuscharge');
            var cur=$(this).data('cur');
            var overday=$(this).data('overday');
            var overprice=$(this).data('overprice');
            var setoverday=$(this).data('setoverday');
            var setoverprice=$(this).data('setoverprice');
            var discount=$(this).data('discount');
            $('#id').val(id);
            $('#cusname').val(cusname);
            $('#tranname').val(tranname);
            $('#amount').val(formatNumber(amount));
            $('#overday').val(overday);
            $('#overprice').val(formatNumber(overprice));
            $('#overamount').val(formatNumber(cuscharge));
            $('#discount_amount').val(formatNumber(discount));
            $('#setoverday').val(setoverday);
            $('#setoverprice').val(formatNumber(setoverprice));
            $('#balance').val(formatNumber(cuscharge-discount));
            $('.cur').val(cur);
            $('#discountmodal').modal('show');
        })
        $(document).on('click','#btnupdatediscount',function(e){
            e.preventDefault()
            updatecuscharge();
        })
        function updatecuscharge()
      {
          $('body').addClass("wait");
          var formdata=new FormData(frmdiscount);
          var url="{{ route('realestate.updatecuscharge') }}";
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

                    toastr.success("Update Successfully");

                    $('#discountmodal').modal('hide');
                    $('body').removeClass("wait");
                    SearchTransfer();
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

      }
        $(document).on('change','#discount_amount',function(e){
            e.preventDefault()
            var cuscharge=$('#overamount').val().replace(/,/g,'');
            var discount=$('#discount_amount').val().replace(/,/g,'');
            var balance=parseFloat(cuscharge)-parseFloat(discount);
            $('#balance').val(formatNumber(balance));
        })
        $(document).on('click','#btnprintincome',function(e){
            e.preventDefault()
            printincomeexpanse('-8')
        })
        $(document).on('click','#btnprintexpanse',function(e){
            e.preventDefault()
            printincomeexpanse('8')
        })
        function printincomeexpanse(type){
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var selbank=$('#selbank').val();
            var selbankname=$('#selbank option:selected').text();
            var pid=$('#sel_property').val();
            var selgroup=$('#selblock').val();
            if(selgroup.includes('all')){
                selgroup="all";
            }
            var redirectWindow = window.open('{{ url('/') }}'+'/realestate/incomeexpanse/print?type='+type+'&d1='+d1+'&d2='+d2+'&selbank='+selbank+'&pid='+pid+'&selgroup='+selgroup+'&selbankname='+selbankname , '_blank');
            redirectWindow.location;
        }
        $(document).on('click','#btnsearch',function(e){
            e.preventDefault()
            SearchTransfer();
        })

        function SearchTransfer()
        {
            $('body').addClass("wait");

            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var selbank=$('#selbank').val();
            var pid=$('#sel_property').val();

            var selgroup=$('#selblock').val();
            if(selgroup.includes('all')){
                selgroup="all";
            }
            var url="{{ route('realestate.show_incomeexpansereport') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,selbank:selbank,pid:pid,selgroup:selgroup},
                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#display_row').empty().html(data);
                    $('body').removeClass("wait");
                    setheighttablefixhead(210);
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })

        }



    })



    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
        $("#tableSearch1").on("keyup", function() {
            var value = $(this).val().toUpperCase();
            $("#tbl_income tr").each(function(index) {
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

            var totalAmount = 0;

            $("#tbl_income tr").each(function (index) {
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
                            var searchText = rawInput.replace(/[ ,\-]/g, '');
                            var target = fullText.replace(/[ ,\-]/g, '');
                            if (target.includes(searchText)) {
                                matchFound = true;
                                return false;
                            }
                        }
                    });

                    $row.toggle(matchFound);

                   if (matchFound) {
                        var amountCell = $row.find("td.totalpay");
                        if (amountCell.length > 0) {
                            var amountText = amountCell.text()
                                .replace(/,/g, '')        // remove commas from number
                                .replace(/[^\d.-]/g, ''); // strip out non-numeric and non-dot/dash (removes KHR, USD etc.)
                            var amountValue = parseFloat(amountText);
                            if (!isNaN(amountValue)) {
                                totalAmount += amountValue;
                            }
                        }
                    }
                }
            });
            //var curname=$('#curname').text();
            // Display the totalAmount somewhere
            $("#totalAmountDisplay").text("Total: " + formatNumber(totalAmount.toFixed(2)) + ' USD' );
        });

    </script>
@endsection
