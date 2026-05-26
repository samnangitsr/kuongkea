@extends('master')
@section('title') buysalecurrency @endsection
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
       .tbl_exchangedetail .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_stockreport .clickedrow td input{
        background-color: #caaf8f;
    }
    </style>
@endsection
@section('content')
@php
    $totalbuy=0;
    $totalamtbuy=0;
    $totalsale=0;
    $totalamtsale=0;
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        // $fp=substr($num,$p,strlen($num)-$p);
        // $dc=strlen((float)$fp)-2;
            $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
@endphp
<div class="row" style="background-color:rgb(208, 234, 137);padding:10px;">
    <div class="col-lg-3">
        <h1 class="kh22-b">របាយការណ៌ទិញលក់ <span id="curname" style="font-size:32px;color:green">{{ $curname }}</span></h1>
    </div>
    <div class="col-lg-3">
        <h1 class="kh22-b"> បុគ្គលិក <span id="username" style="font-size:32px;color:green">{{ $username }}</span></h1>
    </div>
    <div class="col-lg-3">
        <h1 class="kh22-b" style="text-align:right;"> គិតពី <span style="font-size:32px;color:green">{{ date('d-m-Y',strtotime($viewdate)) }}</span></h1>
    </div>
    <div class="col-lg-3">
        <h1 class="kh22-b" style="text-align:right;"> ដល់ <span style="font-size:32px;color:green">{{ date('d-m-Y',strtotime($enddate)) }}</span></h1>
    </div>
    <input type="hidden" id="curid" value="{{ $curid }}">
    <input type="hidden" id="userid" value="{{ $userid }}">
    <input type="hidden" id="viewdate" value="{{ $viewdate }}">
    <input type="hidden" id="enddate" value="{{ $enddate }}">
</div>
<div class="row">
    <div class="table-responsive">
        <table class="table table-bordered kh22 tbl_exchangedetail">
            <thead style="text-align:center;">
                <th>លរ</th>
                <th>ម៉ោង</th>
                <th>រូបិយប័ណ្ណ</th>
                <th>ទិញចូល</th>
                <th>សរុបទឹកប្រាក់</th>
                <th>អត្រា</th>
                <th>ផ្សេងៗ</th>
            </thead>
            <tbody>
                @foreach ($buys as $k =>$b)
                    @php
                        $totalbuy+=$b->product;
                        $totalamtbuy+=$b->amount;
                    @endphp
                    <tr style="background-color:rgb(199, 199, 232)">
                        <td style="text-align:center;">{{ ++$k }}</td>
                        <td>{{ $b->tt }}</td>
                        <td>{{ $b->currency->curname }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($b->product) . ' ' . $b->currency->shortcut }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($b->amount) . ' ' . $b->maincur }}</td>
                        <td style="text-align:center;">{{ floatval($b->rate) }}</td>
                        <td>{{ $b->note }}</td>

                    </tr>
                @endforeach
                <tr class="kh22-b" style="background-color:rgb(183, 183, 233)">
                    <td colspan=3>សរុបទិញ/Total Buy</td>
                    <td style="text-align:right;">{{ phpformatnumber($totalbuy) . ' ' . $curreport->currency->shortcut }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($totalamtbuy) . ' USD' }}</td>
                    <td colspan=2></td>
                </tr>
                @foreach ($sales as $k1 =>$s)
                    @php
                        $totalsale+=$s->product;
                        $totalamtsale+=$s->amount;
                    @endphp
                    <tr style="background-color:rgb(237, 209, 209)">
                        <td style="text-align:center;">{{ ++$k1 }}</td>
                        <td>{{ $s->tt }}</td>
                        <td>{{ $s->currency->curname }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($s->product) . ' ' . $s->currency->shortcut }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($s->amount) . ' ' . $s->maincur }}</td>
                        <td style="text-align:center;">{{ floatval($s->rate) }}</td>
                        <td>{{ $s->note }}</td>

                    </tr>
                @endforeach
                <tr class="kh22-b" style="background-color:rgb(231, 179, 179)">
                    <td colspan=3>សរុបលក់/Total Sale</td>
                    <td style="text-align:right;">{{ phpformatnumber($totalsale) . ' ' . $curreport->currency->shortcut }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($totalamtsale) . ' USD' }}</td>
                    <td colspan=2></td>
                </tr>
                <tr class="kh22-b" style="">
                    <td colspan=3>សរុបទិញ/Total Buy</td>
                    <td style="text-align:right;">{{ phpformatnumber($curreport->qtysale) . ' ' . $curreport->currency->shortcut }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($curreport->totalbuy) . ' USD' }}</td>
                    <td colspan=2 style="text-align:center;">P/L={{ phpformatnumber($curreport->totalsale-$curreport->totalbuy) . ' USD' }}</td>
                </tr>
                <tr class="kh22-b" style="">
                    <td colspan=3>សមតុល្យ/Balance</td>
                    <td style="text-align:right;">{{ phpformatnumber($curreport->stock) . ' ' . $curreport->currency->shortcut }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($curreport->amount) . ' USD' }}</td>
                    <td colspan=2></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <button id="btnprint" class="btn btn-info">Print</button>
        </div>
    </div>

</div>

@endsection
@section('script')

    <script type="text/javascript">
       $(document).ready(function () {
            var today=new Date();
            $('#stockdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            //Highlight clicked row
            $(document).on('click','.tbl_exchangedetail td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
           $(document).on('click','#btnprint',function(e){
                e.preventDefault();
                var curid=$('#curid').val();
                var userid=$('#userid').val();
                var d1=$('#viewdate').val();
                var d2=$('#enddate').val();
                var curname=$('#curname').text();
                var username=$('#username').text();
                var redirectWindow = window.open('{{ url('/') }}'+'/stockexchangecur1/print?curid='+curid  + '&userid='+userid+ '&d1='+d1+'&d2='+d2+'&curname='+curname+'&username='+username, '_blank');
                redirectWindow.location;
           })

        })
    </script>
@endsection
