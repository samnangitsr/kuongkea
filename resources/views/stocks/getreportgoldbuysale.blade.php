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

    <div class="row" style="margin:0px;padding:0px;">
        <div class="col-lg-12" style="margin:0px;padding:0px;">
            <div class="tableFixHead" style="padding:0px;margin:0px;">
                <table id="tblexchangelist" class="table table-bordered table-hover tblexchangelist kh14-b" style="table-layout: fixed;">
                    <thead style="text-align:center;">
                        <th style="width:65px;">លរ</th>
                        <th style="width:100px;">អតិថិជន</th>
                        <th style="width:120px;">លេខទូរស័ព្ទ</th>
                        <th style="width:100px;">ថ្ងៃទិញលក់</th>
                        <th style="width:80px;">ម៉ោង</th>
                        <th style="width:100px;">រូបិយប័ណ្ណ</th>
                        <th style="width:150px;">ទំនិញ</th>
                        <th style="width:80px;">ទឹក</th>
                        <th style="width:150px;">មាសល្អ</th>
                        <th style="width:100px;">អត្រា</th>
                        <th style="width:150px;">ទឹកប្រាក់</th>


                        <th style="width:150px;">អ្នកកត់ត្រា</th>

                        <th style="width:180px;">GroupId</th>
                        <th style="width:500px;">សំគាល់</th>

                    </thead>
                    <tbody id="bodyexchangelist">
                        @php

                            $total_product=0;
                            $total_gold=0;
                            $total_amount=0;



                            $total_product2=0;
                            $total_gold2=0;
                            $total_amount2=0;

                        @endphp
                        @foreach ($exchanges->where('product','>',0) as $key=>$e)
                            @php

                                $total_product += $e->product;
                                $total_amount += $e->amount;
                                $total_gold +=  ($e->product*$e->goldwater)/100;

                            @endphp
                            <tr>

                                <td style="text-align:center;padding:0px" class="kh14">
                                    {{ ++$key }}
                                </td>
                                <td>{{ $e->client }}</td>
                                <td>{{ $e->phone }}</td>
                                <td style="">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                <td>{{ $e->tt }}</td>
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

                                <td style="text-align:right;padding:0px;{{ $e->rate<>$e->drate?'background-color:pink':'' }}">
                                    @if($e->rate==$e->drate)
                                        {{ phpformatnumber($e->rate) }}
                                    @else
                                        {{ phpformatnumber($e->rate) }} <br> <span style="font-size:12px;color:green;position: relative;top:-5px">{{ phpformatnumber($e->drate) }}</span>
                                    @endif
                                </td>
                                <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->amount) . '$' }}</td>

                                <td>{{ $e->user->name }}</td>

                                <td style="">{{ $e->ref_group_id }}</td>
                                <td style="text-align:center;">{{ $e->note }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color:aqua;border:3px solid green;">
                            <td colspan=6 class="kh16-b" style="text-align:center;background-color:yellow;color:blue;">សរុបទិញ</td>
                            <td class="kh16-b" style="text-align:right;@if($total_product>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_product) }} Li</td>
                            <td style="background-color:yellow;"></td>
                            <td class="kh16-b" style="text-align:right;@if($total_gold>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_gold) }} Li</td>
                            <td class="kh16-b" style="background-color:yellow;text-align:right;">
                                {{ $total_gold > 0 ? phpformatnumber(abs(($total_amount / $total_gold) * 100)) : 0 }}
                            </td>
                            <td class="kh16-b" style="text-align:right;@if($total_amount>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_amount) }}$</td>
                            <td class="kh16-b" style="background-color:yellow;text-align:right;">
                                ទឹក {{ $total_product > 0 ? phpformatnumber(($total_gold / $total_product) * 100) : 0 }}
                            </td>
                        </tr>
                        {{-- ផ្នែកលក់ --}}
                            @foreach ($exchanges->where('product','<',0) as $key=>$e)
                            @php

                                $total_product += $e->product;
                                $total_amount += $e->amount;
                                $total_gold +=  ($e->product*$e->goldwater)/100;

                                $total_product2 += $e->product;
                                $total_amount2 += $e->amount;
                                $total_gold2 +=  ($e->product*$e->goldwater)/100;

                            @endphp
                            <tr>

                                <td style="text-align:center;padding:0px" class="kh14">
                                    {{ ++$key }}
                                </td>
                                <td>{{ $e->client }}</td>
                                <td>{{ $e->phone }}</td>
                                <td style="">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                <td>{{ $e->tt }}</td>
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

                                <td style="text-align:right;padding:0px;{{ $e->rate<>$e->drate?'background-color:pink':'' }}">
                                    @if($e->rate==$e->drate)
                                        {{ phpformatnumber($e->rate) }}
                                    @else
                                        {{ phpformatnumber($e->rate) }} <br> <span style="font-size:12px;color:green;position: relative;top:-5px">{{ phpformatnumber($e->drate) }}</span>
                                    @endif
                                </td>
                                <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->amount) . '$' }}</td>

                                <td>{{ $e->user->name }}</td>

                                <td style="">{{ $e->ref_group_id }}</td>
                                <td style="text-align:center;">{{ $e->note }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color:aqua;border:3px solid green;">
                            <td colspan=6 class="kh16-b" style="text-align:center;background-color:yellow;color:red;">សរុបលក់</td>
                            <td class="kh16-b" style="text-align:right;@if($total_product2>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_product2) }} Li</td>
                            <td style="background-color:yellow;"></td>
                            <td class="kh16-b" style="text-align:right;@if($total_gold2>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_gold2) }} Li</td>
                            <td class="kh16-b" style="background-color:yellow;text-align:right;">
                                {{ $total_gold2 <> 0 ? phpformatnumber(abs(($total_amount2 / $total_gold2) * 100)) : 0 }}
                            </td>
                            <td class="kh16-b" style="text-align:right;@if($total_amount2>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_amount2) }}$</td>
                            <td class="kh16-b" style="background-color:yellow;text-align:right;">
                                ទឺក {{ $total_product2 <> 0 ? phpformatnumber(($total_gold2 / $total_product2) * 100) : 0 }}
                            </td>
                        </tr>

                        <tr style="background-color:aqua;border:3px solid;">
                            <td colspan=6 class="kh16-b" style="text-align:center;background-color:green;color:white">សរុបទិញលក់</td>
                            <td class="kh16-b" style="text-align:right;background-color:green;color:white;" >{{ phpformatnumber($total_product) }} Li</td>
                            <td style="background-color:green;"></td>
                            <td class="kh16-b" style="text-align:right;background-color:green;color:white" >{{ phpformatnumber($total_gold) }} Li</td>
                            <td class="kh16-b" style="background-color:green;text-align:right;color:white;">
                                {{ $total_gold <> 0 ? phpformatnumber(abs(($total_amount / $total_gold) * 100)) : 0 }}
                            </td>
                            <td class="kh16-b" style="text-align:right;background-color:green;color:white;">{{ phpformatnumber($total_amount) }}$</td>
                            <td class="kh16-b" style="background-color:green;text-align:right;color:white;">
                                ទឹក {{ $total_product <> 0 ? phpformatnumber(($total_gold / $total_product) * 100) : 0 }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
