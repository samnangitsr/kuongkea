@extends('master')
@section('title') buysalecurrency @endsection
@section('css')
    <style type="text/css">
         .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            }
         .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
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
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            font-weight:bold;
            }
         .kh20-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:20px;
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
    .tbl_exchangedetail td{
        padding:3px 6px;
    }
    .tbl_exchangedetail th{
        padding:3px;
    }
    .mybtn{
        border:1px solid black;
    }
    .mybtn:hover{
        background-color:rgb(61, 211, 238);
    }
    </style>
@endsection
@section('content')
@php
    $totalbuy=0;
    $totalbuygold=0;
    $totalamtbuy=0;
    $totalsale=0;
    $totalsalegold=0;
    $totalamtsale=0;
     function phpformatnumber($num)
    {
        if (!is_numeric($num)) {
            return $num;
        }

        $num = (string)$num;
        $dc = 0;

        if (strpos($num, '.') !== false) {
            $decimals = explode('.', $num)[1];
            // Count actual meaningful decimals (but max 4)
            $dc = min(strlen(rtrim($decimals, '0')), 4);
        }

        return number_format((float)$num, $dc, '.', ',');
    }

@endphp
<div style="background-color:rgb(236, 240, 226);padding:5px;margin:-20px 5px 5px 5px;">

    <table class="kh16-b">
        <tr>
            <td>រូបិយប័ណ្ណ:</td>
            <td style="padding-left:3px;"><span id="curname" style="font-size:22px;color:green">{{ $curname }}</span></td>
            <td style="padding-left:10px;">បុគ្គលិក:</td>
            <td style="padding-left:3px;"><span id="username" style="font-size:22px;color:green">{{ $username }}</span></td>
            <td style="padding-left:10px;">គិតពី</td>
            <td style="padding-left:3px;"><span style="font-size:22px;color:green">{{ date('d-m-Y',strtotime($stockdate)) }}</span></td>
            <td style="padding-left:10px;">ថ្ងៃទី:</td>
            <td style="padding-left:3px;"><span style="font-size:22px;color:green">{{ date('d-m-Y',strtotime($todate)) }}</span></td>
            <td style="text-align:right;padding-left:20px;"><button id="btnprint" class="mybtn kh16-b">Print</button></td>
        </tr>
    </table>


    <input type="hidden" id="curid" value="{{ $curid }}">
    <input type="hidden" id="userid" value="{{ $userid }}">
    <input type="hidden" id="viewdate" value="{{ $viewdate }}">
    <input type="hidden" id="stockdate" value="{{ $stockdate }}">
    <input type="hidden" id="todate" value="{{ $todate }}">
    <input type="hidden" id="gold_tuochek" value="{{ $gold_tuochek }}">


</div>
<div class="row">
     <div class="table-responsive">
        <table>
        <tbody>
                <tr>
                    <td>
                        <a href="#rowbuy"  style="font-family: khmer os muol light;font-size:22px;color:blue;" data-bs-toggle="collapse">ផ្នែកទិញ</a>
                    </td>
                </tr>
                <tr id="rowbuy" class="collapse show">
                    <td>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover kh14-b tbl_exchangedetail">
                                <thead style="text-align:center;">
                                    <th style="width:80px;">លរ</th>
                                    <th style="width:100px;">ថ្ងៃទី</th>
                                    <th style="width:100px;">ម៉ោង</th>
                                    <th style="width:100px;">រូបិយប័ណ្ណ</th>
                                    <th style="width:200px;">ទំនិញ</th>
                                    @if($gold_tuochek>1)
                                        <th style="width:100px;">ទឹក</th>
                                        <th style="width:200px;">ទម្ងន់មាស</th>
                                    @endif
                                    <th style="width:100px;">អត្រា</th>
                                    <th style="width:200px;">សរុបទឹកប្រាក់</th>
                                    <th style="width:100px;">អត្រាគោល</th>
                                    <th style="width:180px;">Group</th>
                                    <th>ផ្សេងៗ</th>
                                </thead>
                                <tbody>

                                    @foreach ($buys as $k =>$b)
                                        @php
                                            $totalbuy+=$b->product;
                                            $totalbuygold += $b->product * $b->goldwater / 100;

                                            $totalamtbuy+=$b->amount;
                                        @endphp

                                        <tr style="background-color:rgb(188, 235, 223)">
                                            <td style="text-align:center;">{{ ++$k }}</td>
                                            <td>{{ date('d-m-Y',strtotime($b->dd))}}</td>
                                            <td>{{ $b->tt }}</td>
                                            <td>{{ $b->currency->curname }}</td>
                                            <td style="text-align:right;@if($b->product>0) color:blue; @else color:red; @endif">
                                                {{ phpformatnumber($b->product) . ' ' . $b->currency->shortcut }}
                                            </td>
                                            @if($gold_tuochek>1)
                                                <td style="text-align:center;">
                                                    {{ $b->goldwater }}
                                                </td>
                                                <td style="text-align:right;@if($b->product>0) color:blue; @else color:red; @endif">
                                                    {{ phpformatnumber($b->product * $b->goldwater / 100) . ' ' . $b->currency->shortcut }}
                                                </td>
                                            @endif
                                            <td style="text-align:center;">{{ floatval($b->rate) }}</td>
                                            <td style="text-align:right;@if($b->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($b->amount) . ' ' . $b->maincur }}</td>
                                            <td style="text-align:center;">{{ floatval($b->drate) }}</td>
                                            <td class="">
                                                <a href="#inv{{ $b->id }}" data-groupid="{{ $b->ref_group_id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ $b->ref_group_id }}</a>
                                            </td>
                                            <td>{{ $b->note }}</td>

                                        </tr>
                                        <tr id="inv{{ $b->id }}" class="collapse borderset2" style="">
                                            <td colspan=8 style="">
                                                <table class="table table-bordered kh12-b" style="margin:0px;">
                                                    <tbody>
                                                        @php
                                                            $i=0;
                                                        @endphp
                                                        @foreach (App\Exchange::showbygroup($b->id,$b->ref_group_id) as $item)
                                                            @php
                                                                $i=$i+1;
                                                            @endphp
                                                            @if($i==1)
                                                                <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                                                    <th>ID</th>
                                                                    <th>ម៉ោង</th>
                                                                    <th>Product</th>
                                                                    <th>ទឺក</th>
                                                                    <th>Amount</th>
                                                                    <th>អត្រា</th>
                                                                    <th>អត្រាគោល</th>
                                                                    <th>Group</th>
                                                                    <th>ផ្សេងៗ</th>
                                                                </tr>
                                                            @endif
                                                            <tr class="kh12-b" style="">
                                                                <td style="text-align:center;">{{ $item->id }}</td>
                                                                <td>{{ date('d-m-Y',strtotime($item->dd))}} {{ $item->tt }}</td>
                                                                <td style="text-align:right;">{{ phpformatnumber($item->product) . ' ' . $item->pcur }}</td>
                                                                <td style="text-align:center;">{{ floatval($item->goldwater??'') }}</td>
                                                                <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->maincur }}</td>
                                                                <td style="text-align:center;">{{ floatval($item->rate) }}</td>
                                                                <td style="text-align:center;">{{ floatval($item->drate) }}</td>
                                                                <td style="text-align:center;">{{ $item->ref_group_id }}</td>
                                                                <td>{{ $item->note }}</td>

                                                            </tr>
                                                        @endforeach

                                                    </tbody>

                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="kh18-b" style="background-color:rgb(188, 235, 223);border:2px solid black;">
                                        <td colspan=4>សរុបទិញ/Total Buy</td>
                                        <td style="text-align:right;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuy) . ' ' . $curreport->currency->shortcut }}</td>
                                        @if($gold_tuochek>1)
                                            <td style="text-align:center;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuy<>0?$totalbuygold/$totalbuy*100:0)}}</td>
                                            <td style="text-align:right;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuygold) . ' ' . $curreport->currency->shortcut }}</td>
                                            <td style="text-align:right;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuygold<>0?abs($totalamtbuy/$totalbuygold*100):0) }}</td>
                                        @else
                                            @if($curreport->currency->sign=='/')
                                                <td style="text-align:right;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuy<>0?abs($totalamtbuy/$totalbuy):0) }}</td>
                                            @else
                                                <td style="text-align:right;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalamtbuy<>0?abs($totalbuy/$totalamtbuy):0) }}</td>
                                            @endif
                                        @endif
                                        <td style="text-align:right;@if($totalamtbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalamtbuy) . ' USD' }}</td>
                                        <td colspan=4></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#rowsale"  style="font-family: khmer os muol light;font-size:22px;color:red;" data-bs-toggle="collapse">ផ្នែកលក់</a>
                    </td>
                </tr>
                <tr id="rowsale" class="collapse show">
                    <td>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover kh14-b tbl_exchangedetail">
                                <thead style="text-align:center;">
                                    <th style="width:80px;">លរ</th>
                                    <th style="width:100px;">ថ្ងៃទី</th>
                                    <th style="width:100px;">ម៉ោង</th>
                                    <th style="width:100px;">រូបិយប័ណ្ណ</th>
                                    <th style="width:200px;">ទំនិញ</th>
                                    @if($gold_tuochek>1)
                                        <th style="width:100px;">ទឹក</th>
                                        <th style="width:200px;">ទម្ងន់មាស</th>
                                    @endif
                                    <th style="width:100px;">អត្រា</th>

                                    <th style="width:200px;">សរុបទឹកប្រាក់</th>
                                    <th style="width:100px;">អត្រាគោល</th>
                                    <th style="width:180px;">Group</th>
                                    <th>ផ្សេងៗ</th>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $k1 =>$s)
                                        @php
                                            $totalsale+=$s->product;
                                            $totalsalegold +=$s->product * $s->goldwater / 100;
                                            $totalamtsale+=$s->amount;
                                        @endphp
                                        <tr style="background-color:rgb(237, 209, 209)">
                                            <td style="text-align:center;">{{ ++$k1 }}</td>
                                            <td>{{ date('d-m-Y',strtotime($s->dd))}}</td>
                                            <td>{{ $s->tt }}</td>
                                            <td>{{ $s->currency->curname }}</td>
                                            <td style="text-align:right;@if($s->product>0) color:blue; @else color:red; @endif">
                                                {{ phpformatnumber($s->product) . ' ' . $s->currency->shortcut }}

                                            </td>
                                             @if($gold_tuochek>1)
                                                <td style="text-align:center;">
                                                    {{ $s->goldwater }}
                                                </td>
                                                <td style="text-align:right;@if($s->product>0) color:blue; @else color:red; @endif">
                                                    {{phpformatnumber($s->product * $s->goldwater / 100) . ' ' . $s->currency->shortcut}}
                                                </td>
                                             @endif
                                            <td style="text-align:center;">{{ floatval($s->rate) }}</td>
                                            <td style="text-align:right;@if($s->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($s->amount) . ' ' . $s->maincur }}</td>
                                            <td style="text-align:center;">{{ floatval($s->drate) }}</td>

                                            <td class="">
                                                <a href="#inv{{ $s->id }}" data-groupid="{{ $s->ref_group_id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ $s->ref_group_id }}</a>
                                            </td>
                                            <td>{{ $s->note }}</td>
                                        </tr>
                                        <tr id="inv{{ $s->id }}" class="collapse borderset2" style="">
                                            <td colspan=8 style="">
                                                <table class="table table-bordered kh12-b" style="margin:0px;">
                                                    <tbody>
                                                        @php
                                                            $i=0;
                                                        @endphp
                                                        @foreach (App\Exchange::showbygroup($s->id,$s->ref_group_id) as $item)
                                                            @php
                                                                $i=$i+1;
                                                            @endphp
                                                            @if($i==1)
                                                                <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                                                    <th>ID</th>
                                                                    <th>ម៉ោង</th>
                                                                    <th>Product</th>
                                                                    <th>ទឺក</th>
                                                                    <th>Amount</th>
                                                                    <th>អត្រា</th>
                                                                    <th>អត្រាគោល</th>
                                                                    <th>Group</th>
                                                                    <th>ផ្សេងៗ</th>
                                                                </tr>
                                                            @endif
                                                            <tr class="kh12-b" style="">
                                                                <td style="text-align:center;">{{ $item->id }}</td>
                                                                <td>{{ date('d-m-Y',strtotime($item->dd))}} {{ $item->tt }}</td>
                                                                <td style="text-align:right;">{{ phpformatnumber($item->product) . ' ' . $item->pcur }}</td>
                                                                <td style="text-align:center;">{{ floatval($item->goldwater??'') }}</td>
                                                                <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->maincur }}</td>
                                                                <td style="text-align:center;">{{ floatval($item->rate) }}</td>
                                                                <td style="text-align:center;">{{ floatval($item->drate) }}</td>
                                                                <td style="text-align:center;">{{ $item->ref_group_id }}</td>
                                                                <td>{{ $item->note }}</td>

                                                            </tr>
                                                        @endforeach

                                                    </tbody>

                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="kh18-b" style="background-color:rgb(237, 209, 209);border:2px solid black;">
                                        <td colspan=4>សរុបលក់/Total Sale</td>
                                        <td style="text-align:right;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsale) . ' ' . $curreport->currency->shortcut }}</td>
                                        @if($gold_tuochek>1)
                                            <td style="text-align:center;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsale<>0?$totalsalegold/$totalsale*100:0)}}</td>
                                            <td style="text-align:right;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsalegold) . ' ' . $curreport->currency->shortcut }}</td>
                                            <td style="text-align:right;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsalegold<>0?abs($totalamtsale/$totalsalegold*100):0) }}</td>
                                        @else
                                            @if($curreport->currency->sign=='/')
                                                <td style="text-align:right;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsale<>0?abs($totalamtsale/$totalsale):0) }}</td>
                                            @else
                                                <td style="text-align:right;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalamtsale<>0?abs($totalsale/$totalamtsale):0) }}</td>
                                            @endif
                                        @endif
                                        <td style="text-align:right;@if($totalamtsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalamtsale) . ' USD' }}</td>
                                        <td colspan=4></td>
                                    </tr>
                                    <tr class="kh18-b" style="background-color:yellow;">
                                        <td colspan=5>ប្រាក់ចំណេញ/PL</td>
                                        {{-- <td style="text-align:right;">{{ phpformatnumber($curreport->qtysale) . ' ' . $curreport->currency->shortcut }}</td> --}}
                                        @if($gold_tuochek>1)
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td style="text-align:right;color:red;">-{{ phpformatnumber($curreport->totalbuy) . ' USD' }}</td>

                                        <td colspan=4 style="text-align:center;">P/L=  {{ phpformatnumber($curreport->totalsale-$curreport->totalbuy) . ' USD' }}</td>
                                    </tr>
                                    <tr class="kh18-b" style="background-color:aquamarine">
                                        <td colspan=4>សមតុល្យ/Balance</td>
                                        @if($gold_tuochek>1)
                                             <td style="text-align:right;">{{ phpformatnumber($curreport->stock_platin) . ' ' . $curreport->currency->shortcut }}</td>
                                             <td style="text-align:right;">{{ phpformatnumber($curreport->stock_platin<>0?$curreport->stock/$curreport->stock_platin * 100:0) }}</td>
                                             <td style="text-align:right;">{{ phpformatnumber($curreport->stock) . ' ' . $curreport->currency->shortcut }}</td>
                                             <td style="text-align:right;">
                                                  @if($curreport->stock<>0)
                                                        {{ phpformatnumber($curreport->stock<>0?$curreport->amount/$curreport->stock * 100:0) }}
                                                    @else

                                                    @endif
                                             </td>
                                        @else
                                             <td style="text-align:right;">{{ phpformatnumber($curreport->stock) . ' ' . $curreport->currency->shortcut }}</td>
                                             <td style="text-align:right;">
                                                 @if($curreport->currency->optsign=='/')
                                                    @if($curreport->amount<>0)
                                                        {{phpformatnumber($curreport->stock/$curreport->amount) }}
                                                    @else

                                                    @endif
                                                @else
                                                    @if($curreport->stock<>0)
                                                        {{ phpformatnumber($curreport->amount/$curreport->stock) }}
                                                    @else

                                                    @endif
                                                @endif
                                            </td>
                                        @endif

                                        <td style="text-align:right;">{{ phpformatnumber($curreport->amount) . ' USD' }}</td>
                                        <td colspan=4>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
        </tbody>
        </table>
    </div>
    {{-- <div class="table-responsive">
        <table class="table table-bordered table-hover kh14-b tbl_exchangedetail">
            <thead style="text-align:center;">
                <th>លរ</th>
                <th>ម៉ោង</th>
                <th>រូបិយប័ណ្ណ</th>
                <th>ទំនិញ</th>
                <th>សរុបទឹកប្រាក់</th>
                <th>អត្រា</th>
                <th>អត្រាគោល</th>
                <th>Group</th>
                <th>ផ្សេងៗ</th>
            </thead>
            <tbody>

                @foreach ($buys as $k =>$b)
                    @php
                        $totalbuy+=$b->product;
                        $totalamtbuy+=$b->amount;
                    @endphp

                    <tr style="background-color:rgb(188, 235, 223)">
                        <td style="text-align:center;">{{ ++$k }}</td>
                        <td>{{ $b->tt }}</td>
                        <td>{{ $b->currency->curname }}</td>
                        <td style="text-align:right;@if($b->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber($b->product) . ' ' . $b->currency->shortcut }}</td>
                        <td style="text-align:right;@if($b->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($b->amount) . ' ' . $b->maincur }}</td>
                        <td style="text-align:center;">{{ floatval($b->rate) }}</td>
                        <td style="text-align:center;">{{ floatval($b->drate) }}</td>
                        <td class="">
                            <a href="#inv{{ $b->id }}" data-groupid="{{ $b->ref_group_id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ $b->ref_group_id }}</a>
                        </td>
                        <td>{{ $b->note }}</td>

                    </tr>
                    <tr id="inv{{ $b->id }}" class="collapse borderset2" style="">
                        <td colspan=8 style="">
                            <table class="table table-bordered kh12-b" style="margin:0px;">
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach (App\Exchange::showbygroup($b->id,$b->ref_group_id) as $item)
                                        @php
                                            $i=$i+1;
                                        @endphp
                                        @if($i==1)
                                            <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                                <th>ID</th>
                                                <th>ម៉ោង</th>
                                                <th>Product</th>
                                                <th>Amount</th>
                                                <th>អត្រា</th>
                                                <th>អត្រាគោល</th>
                                                <th>Group</th>
                                                <th>ផ្សេងៗ</th>
                                            </tr>
                                        @endif
                                        <tr class="kh12-b" style="">
                                            <td style="text-align:center;">{{ $item->id }}</td>
                                            <td>{{ date('d-m-Y',strtotime($item->dd))}} {{ $item->tt }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->product) . ' ' . $item->pcur }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->maincur }}</td>
                                            <td style="text-align:center;">{{ floatval($item->rate) }}</td>
                                            <td style="text-align:center;">{{ floatval($item->drate) }}</td>
                                            <td style="text-align:center;">{{ $item->ref_group_id }}</td>
                                            <td>{{ $item->note }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </td>
                    </tr>
                @endforeach
                <tr class="kh18-b" style="background-color:rgb(188, 235, 223);border:2px solid black;">
                    <td colspan=3>សរុបទិញ/Total Buy</td>
                    <td style="text-align:right;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuy) . ' ' . $curreport->currency->shortcut }}</td>
                    <td style="text-align:right;@if($totalamtbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalamtbuy) . ' USD' }}</td>
                    <td colspan=4></td>
                </tr>
                <tr>
                    <td style="font-family: khmer os muol light;font-size:22px;color:red;" colspan=9>
                        ផ្នែកលក់
                    </td>
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
                        <td style="text-align:right;@if($s->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber($s->product) . ' ' . $s->currency->shortcut }}</td>
                        <td style="text-align:right;@if($s->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($s->amount) . ' ' . $s->maincur }}</td>
                        <td style="text-align:center;">{{ floatval($s->rate) }}</td>
                        <td style="text-align:center;">{{ floatval($s->drate) }}</td>

                        <td class="">
                            <a href="#inv{{ $s->id }}" data-groupid="{{ $s->ref_group_id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ $s->ref_group_id }}</a>
                        </td>
                        <td>{{ $s->note }}</td>
                    </tr>
                    <tr id="inv{{ $s->id }}" class="collapse borderset2" style="">
                        <td colspan=8 style="">
                            <table class="table table-bordered kh12-b" style="margin:0px;">
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach (App\Exchange::showbygroup($s->id,$s->ref_group_id) as $item)
                                        @php
                                            $i=$i+1;
                                        @endphp
                                        @if($i==1)
                                            <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                                <th>ID</th>
                                                <th>ម៉ោង</th>
                                                <th>Product</th>
                                                <th>Amount</th>
                                                <th>អត្រា</th>
                                                <th>អត្រាគោល</th>
                                                <th>Group</th>
                                                <th>ផ្សេងៗ</th>
                                            </tr>
                                        @endif
                                        <tr class="kh12-b" style="">
                                            <td style="text-align:center;">{{ $item->id }}</td>
                                            <td>{{ date('d-m-Y',strtotime($item->dd))}} {{ $item->tt }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->product) . ' ' . $item->pcur }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->maincur }}</td>
                                            <td style="text-align:center;">{{ floatval($item->rate) }}</td>
                                            <td style="text-align:center;">{{ floatval($item->drate) }}</td>
                                            <td style="text-align:center;">{{ $item->ref_group_id }}</td>
                                            <td>{{ $item->note }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </td>
                    </tr>
                @endforeach
                <tr class="kh18-b" style="background-color:rgb(237, 209, 209);border:2px solid black;">
                    <td colspan=3>សរុបលក់/Total Sale</td>
                    <td style="text-align:right;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsale) . ' ' . $curreport->currency->shortcut }}</td>
                    <td style="text-align:right;@if($totalamtsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalamtsale) . ' USD' }}</td>
                    <td colspan=4></td>
                </tr>
                <tr class="kh18-b" style="background-color:yellow;">
                    <td colspan=3>ប្រាក់ចំណេញ/PL</td>
                    <td style="text-align:right;">{{ phpformatnumber($curreport->qtysale) . ' ' . $curreport->currency->shortcut }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($curreport->totalbuy) . ' USD' }}</td>
                    <td colspan=4 style="text-align:center;">P/L={{ phpformatnumber($curreport->totalsale-$curreport->totalbuy) . ' USD' }}</td>
                </tr>
                <tr class="kh18-b" style="background-color:aquamarine">
                    <td colspan=3>សមតុល្យ/Balance</td>
                    <td style="text-align:right;">{{ phpformatnumber($curreport->stock) . ' ' . $curreport->currency->shortcut }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($curreport->amount) . ' USD' }}</td>
                    <td colspan=4>
                        @if($curreport->currency->optsign=='/')
                            @if($curreport->amount<>0)
                               {{phpformatnumber($curreport->stock/$curreport->amount) }}
                            @else

                            @endif
                        @else
                            @if($r->stock<>0)
                               {{ phpformatnumber($curreport->amount/$curreport->stock) }}
                            @else

                            @endif
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div> --}}
</div>


@endsection
@section('script')

    <script type="text/javascript">
      $('#h1_title').text('ទិញលក់រូបិយប័ណ្ណ');
       $(document).ready(function () {

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
                var viewdate=$('#viewdate').val();
                var stockdate=$('#stockdate').val();
                var todate=$('#todate').val();
                var gold_tuochek=$('#gold_tuochek').val();
                var curname=$('#curname').text();
                var username=$('#username').text();
                //var redirectWindow = window.open('{{ url('/') }}'+'/stockexchangecur/print?curid='+curid  + '&userid='+userid+ '&viewdate='+viewdate+'&stockdate='+stockdate+'&todate='+todate+'&curname='+curname+'&username='+username+'&isprint='+1, '_blank');
                var redirectWindow = window.open('{{ url('/') }}'+'/viewexchangeprofitdetailbycurrency?curid='+curid  + '&userid='+userid+ '&viewdate='+viewdate+'&stockdate='+stockdate+'&todate='+todate+'&curname='+curname+'&username='+username+'&isprint='+1+'&tuochek='+gold_tuochek, '_blank');

                redirectWindow.location;
           })

        })
    </script>
@endsection
