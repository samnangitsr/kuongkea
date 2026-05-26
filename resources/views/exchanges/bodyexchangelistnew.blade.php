@php
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
 <div class="col-lg-4" style="margin:0px;padding:0px;">
                <div class="tableFixHead" style="padding:0px;margin:0px 5px 0px 0px;">
                    <table class="table table-bordered table-hover kh14-b tbl_mainlist" style="table-layout: fixed">
                        <thead style="text-align:center;">
                            <th style="width:40px;">N <sup>o</sup></th>
                            <th style="width:100%;">រូបិយប័ណ្ណ</th>
                            <th style="width:130px;">ចំនួន</th>
                            <th style="width:130px;">ទឹកប្រាក់</th>
                            <th style="width:90px;">អត្រា</th>
                        </thead>
                        <tbody>
                            @php
                                $allamount=0;
                            @endphp
                            @foreach ($sumexchanges as $k =>$item)
                                @php
                                    $allamount+=$item->total_amount;
                                @endphp
                                <tr class="item">
                                    <td style="text-align:center;">{{ ++$k }}</td>
                                    <td style="@if($item->total_product>0) color:blue; @else color:red @endif">
                                        @if($item->total_product>0)
                                            +{{ $item->curname }}
                                        @else
                                            -{{ $item->curname }}
                                        @endif
                                    </td>
                                    <td class="td_total_product" style="text-align:right; @if($item->total_product>0) color:blue; @else color:red @endif">
                                        {{ phpformatnumber($item->total_product) . $item->sk }}
                                        @if($item->total_product1<>0)
                                            <br>
                                            =មាស {{ phpformatnumber($item->total_product1) . $item->sk }}
                                        @endif

                                    </td>
                                    <td class="td_total_amount" style="text-align:right; @if($item->total_amount>0) color:blue; @else color:red @endif">
                                        {{ phpformatnumber($item->total_amount) . '$' }}
                                        @if($item->total_product1<>0)
                                            <br>
                                            =ទឺក {{ phpformatnumber($item->total_product1/$item->total_product*100) }}
                                        @endif
                                    </td>
                                    @if($item->tuochek>1)
                                        <td style="text-align:right;" class="td_avg_rate">{{ phpformatnumber((abs($item->total_amount/$item->total_product1)*100))}}</td>
                                    @else
                                        @if($item->optsign=='/')
                                            <td style="text-align:right;" class="td_total_amount">{{ phpformatnumber(abs($item->total_product / $item->total_amount)) }}</td>
                                        @else
                                            <td style="text-align:right;" class="td_total_amount">{{ phpformatnumber(abs($item->total_amount / $item->total_product)) }}</td>
                                        @endif

                                    @endif
                                </tr>
                            @endforeach
                                <tr style="background-color:gold;" class="item">
                                    <td style="border:1px solid black"></td>
                                    <td colspan=2 style="border:1px solid black">Total Amount</td>
                                    <td style="text-align:right;border:1px solid black;" class="tdamount">{{ phpformatnumber($allamount) . '$' }}</td>
                                    <td style="text-align:right;border:1px solid black;"></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-8" style="margin:0px;padding:0px;">
                <div class="tableFixHead" style="padding:0px;margin:0px;">
                    <table id="tblexchangelist" class="table table-bordered table-hover tblexchangelist kh14-b" style="table-layout: fixed;">
                        <thead style="text-align:center;">
                            <th style="width:65px;">លរ</th>
                            <th style="width:100px;">រូបិយប័ណ្ណ</th>
                            <th style="width:150px;">ទំនិញ</th>
                            <th style="width:80px;">ទឹក</th>
                            <th style="width:150px;">មាសល្អ</th>
                            <th style="width:100px;">អត្រា</th>
                            <th style="width:150px;">ទឹកប្រាក់</th>

                            <th style="width:100px;">ថ្ងៃទី</th>
                            <th style="width:80px;">ម៉ោង</th>
                            <th style="width:150px;">អ្នកកត់ត្រា</th>
                            <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                            <th style="width:500px;">សំគាល់</th>

                        </thead>
                        <tbody id="bodyexchangelist">
                            @php
                                $dd='';
                                $created_at='';
                            @endphp
                            @foreach ($exchanges as $key=>$e)
                                @php
                                    $dd=date('Y-m-d',strtotime($e->dd));
                                    $created_at=date('Y-m-d',strtotime($e->created_at));
                                @endphp
                                <tr id="tr_object_id_{{ $e->multiexchangecode }}">
                                    <td class="kh14" style="text-align:center;@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ ++$key }}</td>

                                    <td style="@if($e->product>0) color:blue; @else color:red; @endif">
                                        @if($e->product>0)
                                            +{{ $e->currency->curname }}
                                        @else
                                            -{{ $e->currency->curname }}
                                        @endif
                                    </td>
                                    <td style="text-align:right;@if($e->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->product) . ' ' . $e->currency->sk }}</td>
                                    <td style="text-align:right;padding:2px;">{{ ($e->goldwater ?? 0) == 0 ? '' : $e->goldwater }}</td>
                                    <td style="text-align:right;@if($e->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber(($e->product*$e->goldwater)/100) . ' ' . $e->currency->sk }}</td>

                                    <td style="text-align:right;padding:0px;{{ $e->rate<>$e->drate?'background-color:yellow':'' }}">
                                        @if($e->rate==$e->drate)
                                            {{ phpformatnumber($e->rate) }}
                                        @else
                                            {{ phpformatnumber($e->rate) }} <br> <span style="font-size:12px;color:green;position: relative;top:-5px">{{ phpformatnumber($e->drate) }}</span>
                                        @endif
                                    </td>
                                    <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->amount) . ' ' . $e->maincur }}</td>

                                    <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                    <td>{{ $e->tt }}</td>
                                    <td>{{ $e->user->name }}</td>
                                    <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->created_at)) }}</td>
                                    <td style="text-align:center;">{{ $e->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
