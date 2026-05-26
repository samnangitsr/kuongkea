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
                                <th style="width:50px;">
                                    <div class="form-check">
                                        <input class="form-check-input ck_all kh22" style="margin-top:2px;margin-left:-15px;background-color:#c9a506;" type="checkbox" value="" id="cksel_all">
                                    </div>
                                </th>
                                <th style="width:65px;">លរ</th>
                                <th style="width:100px;">អតិថិជន</th>
                                <th style="width:100px;">លេខទូរស័ព្ទ</th>
                                <th style="width:100px;">ថ្ងៃទិញលក់</th>
                                <th style="width:80px;">ម៉ោង</th>
                                <th style="width:100px;">រូបិយប័ណ្ណ</th>
                                <th style="width:150px;">ទំនិញ</th>
                                <th style="width:80px;">ទឹក</th>
                                <th style="width:150px;">មាសល្អ</th>
                                <th style="width:100px;">អត្រា</th>
                                <th style="width:150px;">ទឹកប្រាក់</th>
                                <th style="width:150px;">សរុបទឹកប្រាក់</th>
                                <th style="width:100px;">លុយកក់</th>
                                <th style="width:100px;">នៅខ្វះ</th>


                                <th style="width:100px;">ទូទាត់តាម</th>

                                <th style="width:150px;">អ្នកកត់ត្រា</th>
                                <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                                <th style="width:100px;">ថ្ងៃកែប្រែ</th>
                                    <th style="width:180px;">GroupId</th>
                                <th style="width:500px;">សំគាល់</th>

                            </thead>
                            <tbody id="bodyexchangelist">
                                @php
                                    $dd='';
                                    $created_at='';
                                    $total_product=0;
                                    $total_gold=0;
                                    $total_amount=0;
                                    $bal=0;
                                    $total_balance=0;
                                    $total_sumamount=0;
                                    $total_deposit=0;
                                @endphp
                                @foreach ($exchanges as $key=>$e)
                                    @php
                                        $dd=date('Y-m-d',strtotime($e->dd));
                                        $created_at=date('Y-m-d',strtotime($e->created_at));
                                        $total_product += $e->product;
                                        $total_amount += $e->amount;
                                        $total_gold +=  ($e->product*$e->goldwater)/100;
                                        $total_balance +=-1 * floatval($e->balance);
                                        $total_sumamount += $e->sumamount;
                                        $total_deposit += -1 * floatval($e->sumamount+$e->balance);
                                    @endphp
                                    <tr id="tr_object_id_{{ $e->multiexchangecode }}" >
                                        <td style="text-align:center;width:60px;padding-left:20px;">
                                            <div class="form-check" style="margin-top:-5px;">
                                                <input class="form-check-input cknum kh22" type="checkbox" style="padding:0px;" value="" id="ck{{ $key }}">
                                            </div>
                                        </td>
                                        <td style="text-align:center;padding:0px;@if($dd<>$created_at)background-color:brown;color:white; @endif" class="kh14">
                                             @if($e->sumamount<>0)
                                                <div class="dropdown">
                                                    <button style="width:100%;" type="button" class="mybtn dropdown-toggle kh14" data-bs-toggle="dropdown">
                                                    {{ ++$key }}
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="dropdown-item kh16-b btnpayment" data-id="{{ $e->id }}" data-groupid="{{ $e->ref_group_id }}" data-balance="{{ $e->balance }}" data-client="{{$e->client}}" data-phone="{{$e->phone}}" data-examount="{{$e->amount}}">ទូទាត់</a></li>
                                                        <li>
                                                            <a href="{{ route('exchangegoldreport.showpaymentdetail',['exchange_id'=>$e->id,'group_id'=>$e->ref_group_id]) }}" class="dropdown-item kh16-b" target="_blank">Payment Group</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                {{ ++$key }}
                                            @endif
                                        </td>
                                        <td>{{ $e->client }}</td>
                                        <td>{{ $e->phone }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
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

                                        <td style="text-align:right;padding:0px;{{ $e->rate<>$e->drate?'background-color:yellow':'' }}">
                                            @if($e->rate==$e->drate)
                                                {{ phpformatnumber($e->rate) }}
                                            @else
                                                {{ phpformatnumber($e->rate) }} <br> <span style="font-size:12px;color:green;position: relative;top:-5px">{{ phpformatnumber($e->drate) }}</span>
                                            @endif
                                        </td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->amount) . '$' }}</td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->sumamount) . '$' }}</td>

                                        <td style="text-align:right;@if($e->amount>0) color:red; @else color:blue; @endif">{{ phpformatnumber(-1 * floatval($e->sumamount+$e->balance)) . '$' }}</td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">
                                            {{ phpformatnumber(-1 * floatval($e->balance)) . '$' }}
                                        </td>
                                        <td>{{ $e->deposit_via }}</td>
                                        <td>{{ $e->user->name }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->created_at)) }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->updated_at)) }}</td>
                                        <td style="">{{ $e->ref_group_id }}</td>
                                        <td style="text-align:center;">{{ $e->note }}</td>
                                    </tr>
                                @endforeach
                                <tr style="background-color:aqua;border:3px solid green;">
                                    <td colspan=6 class="kh16-b" style="text-align:center;background-color:yellow;">សរុប</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_product>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_product) }} Li</td>
                                    <td style="background-color:yellow;"></td>
                                    <td class="kh16-b" style="text-align:right;@if($total_gold>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_gold) }} Li</td>
                                    <td style="background-color:yellow;"></td>
                                    <td class="kh16-b" style="text-align:right;@if($total_amount>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_amount) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_sumamount>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_sumamount) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_deposit>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_deposit) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_balance>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_balance) }}$</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0px;padding:0px;">
                <div class="col-lg-12" style="margin:0px;padding:0px;">
                    <div class="tableFixHead" style="padding:0px;margin:0px;">
                        <table id="tblexchangelist1" class="table table-bordered table-hover tblexchangelist kh14-b" style="table-layout:fixed;">
                            <thead style="text-align:center;">
                                <th style="width:65px;">លរ</th>
                                <th style="width:100px;">អតិថិជន</th>
                                <th style="width:100px;">លេខទូរស័ព្ទ</th>
                                <th style="width:100px;">ថ្ងៃទិញលក់</th>
                                <th style="width:80px;">ម៉ោង</th>
                                <th style="width:100px;">រូបិយប័ណ្ណ</th>
                                <th style="width:150px;">ទំនិញ</th>
                                <th style="width:80px;">ទឹក</th>
                                <th style="width:150px;">មាសល្អ</th>
                                <th style="width:100px;">អត្រា</th>
                                <th style="width:150px;">ទឹកប្រាក់</th>
                                <th style="width:150px;">សរុបទឹកប្រាក់</th>
                                <th style="width:100px;">លុយកក់</th>
                                <th style="width:100px;">នៅខ្វះ</th>
                                <th style="width:100px;">ទូទាត់តាម</th>
                                <th style="width:150px;">អ្នកកត់ត្រា</th>
                                <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                                <th style="width:100px;">ថ្ងៃកែប្រែ</th>
                                <th style="width:180px;">GroupId</th>
                                <th style="width:500px;">សំគាល់</th>
                            </thead>
                            <tbody id="bodyexchangelist1">
                                @php
                                    $dd='';
                                    $created_at='';
                                    $total_product=0;
                                    $total_gold=0;
                                    $total_amount=0;
                                    $total_sumamount=0;
                                    $total_deposit=0;

                                    $bal=0;
                                    $total_balance=0;
                                @endphp
                                @foreach ($exchanges_complete as $key=>$e)
                                    @php
                                        $dd=date('Y-m-d',strtotime($e->dd));
                                        $created_at=date('Y-m-d',strtotime($e->created_at));
                                        $total_product += $e->product;
                                        $total_amount += $e->amount;
                                        $total_sumamount += $e->sumamount;
                                        $total_deposit += -1 * floatval($e->sumamount+$e->balance);
                                        $total_gold +=  ($e->product*$e->goldwater)/100;
                                        $total_balance +=-1 * floatval($e->balance);
                                    @endphp
                                    <tr>

                                        <td style="text-align:center;padding:0px;@if($dd<>$created_at)background-color:brown;color:white; @endif" class="kh14">
                                            @if($e->sumamount<>0)
                                                <div class="dropdown">
                                                    <button style="width:100%;" type="button" class="mybtn dropdown-toggle kh14" data-bs-toggle="dropdown">
                                                    {{ ++$key }}
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('exchangegoldreport.showpaymentdetail',['exchange_id'=>$e->id,'group_id'=>$e->ref_group_id]) }}" class="dropdown-item kh16-b" target="_blank">Payment Group</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                {{ ++$key }}
                                            @endif
                                        </td>
                                        <td>{{ $e->client }}</td>
                                        <td>{{ $e->phone }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
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

                                        <td style="text-align:right;padding:0px;{{ $e->rate<>$e->drate?'background-color:yellow':'' }}">
                                            @if($e->rate==$e->drate)
                                                {{ phpformatnumber($e->rate) }}
                                            @else
                                                {{ phpformatnumber($e->rate) }} <br> <span style="font-size:12px;color:green;position: relative;top:-5px">{{ phpformatnumber($e->drate) }}</span>
                                            @endif
                                        </td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->amount) . '$' }}</td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->sumamount) . '$' }}</td>

                                        <td style="text-align:right;@if($e->amount>0) color:red; @else color:blue; @endif">{{ phpformatnumber(-1 * floatval($e->sumamount+$e->balance)) . '$' }}</td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">
                                            {{ phpformatnumber(-1 * floatval($e->balance)) . '$' }}
                                        </td>
                                        <td>{{ $e->deposit_via }}</td>
                                        <td>{{ $e->user->name }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->created_at)) }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->updated_at)) }}</td>
                                        <td style="text-align:center;">{{ $e->ref_group_id }}</td>
                                        <td style="text-align:center;">{{ $e->note }}</td>
                                    </tr>
                                @endforeach
                                <tr style="background-color:aqua;border:3px solid green;">
                                    <td colspan=6 class="kh16-b" style="text-align:center;background-color:yellow;">សរុប</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_product>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_product) }} Li</td>
                                    <td style="background-color:yellow;"></td>
                                    <td class="kh16-b" style="text-align:right;@if($total_gold>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_gold) }} Li</td>
                                    <td style="background-color:yellow;"></td>
                                    <td class="kh16-b" style="text-align:right;@if($total_amount>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_amount) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_sumamount>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_sumamount) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_deposit>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_deposit) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_balance>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_balance) }}$</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
