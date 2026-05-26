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
        function dokhmermonth($m)
        {
            if($m==1) return 'មករា';
            if($m==2) return 'គុម្ភះ';
            if($m==3) return 'មិនា';
            if($m==4) return 'មេសា';
            if($m==5) return 'ឧសភា';
            if($m==6) return 'មិថុនា';
            if($m==7) return 'កក្កដា';
            if($m==8) return 'សីហា';
            if($m==9) return 'កញ្ញា';
            if($m==10) return 'តុលា';
            if($m==11) return 'វិច្ចិកា';
            if($m==12) return 'ធ្នូ';
        }
    @endphp

<div class="row" style="margin-top:5px;">
    <div class="tableFixHead" style="padding:0px;">
        <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
            <thead style="text-align:center;" class="kh16">
                <th style="width:70px;">No</th>
                <th style="width:100px;">វិក័យប័ត្រ</th>

                <th style="width:200px;">ឈ្មោះអចលនទ្រព្យ</th>
                <th id="th_customer" style="width:200px;">ឈ្មោះអតិថិជន</th>
                <th style="width:100px;">ខែទូទាត់</th>
                <th style="width:100px;">ចំនួន</th>
                <th style="width:100px;">សរុបបង់</th>
                <th style="width:100px;">ថ្ងៃទូទាត់</th>

                <th style="width:100px;">សំរាប់ខែ</th>
                <th style="width:100px;">ខែបន្ទាប់</th>

                <th style="width:100px;">សាច់ប្រាក់</th>
                <th style="width:100px;">ធនាគា</th>
                <th style="width:100px;">ពិន័យ</th>
                <th style="width:100px;">លើកលែង</th>

                {{-- <th style="width:100px;">ចំនួនថ្ងៃ</th> --}}
                <th style="width:150px;">តំលៃលក់</th>
                <th style="width:150px;">បានទូទាត់រួច</th>
                <th style="width:150px;">នៅខ្វះ</th>
                <th id="th_saler" style="width:150px;">អ្នកលក់គំរោង</th>
                <th style="width:100px;">កំរៃជើងសារ</th>
                <th style="width:130px;">អ្នកកត់ត្រា</th>
                <th style="width:100px;">ថ្ងៃលក់</th>
                <th style="width:300px;">ផ្សេងៗ</th>
                <th style="width:300px;">លេខទូរស័ព្ទ</th>
                <th style="width:300px;">លេខអត្តសញ្ញាណប័ណ្ណ</th>
                <th style="width:150px;">ប្រភេទទូទាត់</th>
                <th style="width:150px;">តាមរយះ</th>

                <th style="width:100px;">ប្រភេទបង់</th>
                <th style="width:100px;">រយះពេល</th>
                <th style="width:100px;">ការប្រាក់</th>
                <th style="width:100px;">បង់ក្នុង១ខែ</th>
                <th style="width:150px;">គិតពី</th>
                <th style="width:150px;">ដល់</th>

            </thead>
            <tbody id="body_closelist">
                @php
                    $i=0;
                    $totalpay=0;
                    $paybycash=0;
                    $paybybank=0;
                    $cuscharge=0;
                    $discount=0;
                    $totalsale=0;
                    $totaldeposit=0;
                    $skip_qty=0;
                    $qtypay=0;
                    $total_amount=0;
                    $total_cash=0;
                    $total_bank=0;
                @endphp
                @foreach ($transfers as $k => $tr)
                    @php
                        $i+=1;
                        $total_amount=floatval($tr->amt_cash) + floatval($tr->more_cash)+floatval($tr->amt_bank) + floatval($tr->more_bank)+floatval($tr->amt_cash_over)+floatval($tr->amt_bank_over);
                        $total_cash=floatval($tr->amt_cash) + floatval($tr->more_cash)+floatval($tr->amt_cash_over);
                        $total_bank=floatval($tr->amt_bank) + floatval($tr->more_bank)+floatval($tr->amt_bank_over);
                        $totalpay +=$total_amount;
                        $paybycash +=$total_cash;
                        $paybybank +=$total_bank;
                        if($tr->trancode<>-8 && $tr->qtyleftday>=0 && floatval($tr->count_pay + $tr->count_moredeposit +$tr->count_pay_over)>0){
                            $cuscharge +=floatval($tr->cuscharge_new);
                            $discount +=floatval($tr->discount_new);
                        }
                        // if($tr->deposit_via_id=='cash'){
                        //     $paybycash +=floatval($tr->amt_pay);
                        // }
                       if($tr->count_pay >0 || $tr->count_pay_over>0 || $tr->count_moredeposit>0){
                            $qtypay+=1;
                        }
                        if(floatval($tr->count_pay + $tr->count_moredeposit + $tr->count_pay_over)==0 && $tr->qtyleftday>=0){
                            $skip_qty +=1;
                        }
                        $totalsale +=$tr->main_amount;
                        $totaldeposit +=$tr->deposited;
                    @endphp
                    <tr class="@if(floatval($tr->count_pay + $tr->count_moredeposit + $tr->count_pay_over)<=0 && $tr->qtyleftday<0) c_red @endif">
                        <td style="text-align:center;padding:0px;" class="kh14-b">
                            <div class="dropdown">
                                <button style="width:70px;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ $i }}</button>
                                <ul class="dropdown-menu">
                                    @if (Auth::user()->role->name<>'Admin')
                                        @if (App\User::checkpermission(Auth::id(),'1.1.5'))
                                            <li>
                                                <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-building"></i> តារាងបង់រំលស់</a>
                                            </li>
                                            <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" ><i class="fa fa-money"></i> កក់ប្រាក់បន្ថែម</a></li>
                                        @endif
                                    @else
                                        <li>
                                            <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-building"></i> តារាងបង់រំលស់</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item kh16-b" href="{{ route('realestate.printromloslistforcustomer',['id'=>$tr->id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-print"></i> ព្រីនតារាងបង់ប្រាក់</a>
                                        </li>
                                        <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->main_id }}"><i class="fa fa-money"></i> កក់ប្រាក់បន្ថែម</a></li>
                                    @endif

                                </ul>
                            </div>
                        </td>
                        <td class="en16" title="{{$tr->id}}">{{ sprintf("%04d",$tr->id) . $tr->qtyleftday }}</td>


                        <td class="kh16">{{ $tr->sendername }}</td>
                        <td class="kh16">{{ $tr->partner->name }}</td>
                        <td class="kh16-b" style="text-align:center;">{{ dokhmermonth($tr->inmonth)}}</td>
                        <td class="kh16" style="text-align:center;">{{ $tr->count_pay + $tr->count_moredeposit + $tr->count_pay_over . ' ដង'}}</td>
                        <td class="kh16-b" style="text-align:right;" title="{{ number_format($totalpay,0,'.',' ') }}">{{ phpformatnumber($total_amount) .$tr->currency->sk }}</td>
                        <td class="en16">{{ $tr->paymentdate?date('d-m-Y',strtotime($tr->paymentdate)):''}}</td>
                        <td class="en16">{{ $tr->payformonths?date('d-m-Y',strtotime($tr->payformonths)):''}}</td>
                        <td class="en16">{{ $tr->nextpayments?date('d-m-Y',strtotime($tr->nextpayments)):'' }}</td>

                        <td class="kh16-b" style="text-align:right;" title="{{number_format($paybycash,0,'.',' ')}}">{{ phpformatnumber($total_cash) .$tr->currency->sk }}</td>
                        <td class="kh16-b" style="text-align:right;"  title="{{number_format($paybybank,0,'.',' ')}}">{{ phpformatnumber($total_bank) .$tr->currency->sk }}</td>
                        <td class="kh16-b" style="text-align:right;"  title="{{number_format($cuscharge,0,'.',' ')}}">{{ phpformatnumber($tr->trancode==-8?0:$tr->cuscharge) .$tr->currency->sk }}</td>
                        <td class="kh16-b" style="text-align:right;"  title="{{$discount}}">{{ phpformatnumber($tr->discount_amount) .$tr->currency->sk }}</td>
                        {{-- <td class="en16" style="text-align:center;">{{ floatval($tr->qtyleftday) }}</td> --}}
                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->amount)) .$tr->currency->sk }}</td>
                        <td class="kh16-b" style="text-align:right;">
                            <a href="{{ route('realestate.showdeposit',['id'=>$tr->id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->payinmonth,'sendername'=>$tr->sendername]) }}" class="mybtn kh16-b " target="_blank" style="margin:0px;padding:2px;@if(floatval($tr->count_pay)<=0 && $tr->qtyleftday<0) color:white; @endif">{{ phpformatnumber(abs($tr->deposited)) .$tr->currency->sk }}</a>
                        </td>
                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->amount)-abs($tr->deposited)) .$tr->currency->sk }}</td>

                        <td class="kh16">{{ $tr->saler }}</td>
                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->cuscharge) .$tr->currency->sk }}</td>
                        <td class="kh16">{{ $tr->user->name }}</td>
                        <td class="en16">{{ date('d-m-Y',strtotime($tr->dd)) }}</td>
                        <td class="kh16">{{ $tr->note }}</td>
                        <td class="kh16">{{ $tr->partner->tel }}</td>
                        <td class="kh16">{{ $tr->partner->idcard }}</td>
                        <td class="kh16">{{ $tr->deposit_by_id }}</td>
                        <td class="kh16">{{ $tr->deposit_by }}</td>

                        <td class="kh16">{{ $tr->paymenttype==1?'បង់ផ្តាច់':'រំលស់' }}</td>
                        <td class="kh16" style="text-align:center;">{{ $tr->term?$tr->term . 'ខែ':'' }}</td>
                        <td class="kh16" style="text-align:center;">{{ $tr->interest_rate??0 }}%</td>
                        <td class="kh16" style="text-align:right;">{{ phpformatnumber($tr->payinmonth??0) . $tr->currency->sk}}</td>
                        <td class="kh16">{{ $tr->startdate?date('d-m-Y',strtotime($tr->startdate)):''}}</td>
                        <td class="kh16">{{ $tr->enddate?date('d-m-Y',strtotime($tr->enddate)):''}}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
      </div>
</div>
<div class="row" style="">
    <table id="tbl_total" class="table table-bordered kh16-b" style='margin:0px;'>
        <tr style="text-align:center;">
            <th>សរុបអតិ</th>
            <th>បង់រួច</th>
            <th>មិនដល់បង់</th>
            <th>មិនបានបង់</th>
            <th>សរុបបង់</th>
            <th>ប្រាក់ពិន័យ</th>
            <th>ប្រាក់លើកលែង</th>
            <th>ជាសាច់ប្រាក់</th>
            <th>ធនាគា</th>
            <th>សរុបលក់</th>
            <th>បានសង</th>
            <th>នៅខ្វះ</th>
        </tr>
        <tr>
            <td style="text-align:center;">{{ $i . ' នាក់' }}</td>
            <td style="text-align:center;">{{ $qtypay . ' នាក់'}}</td>
            <td style="text-align:center;">{{ $skip_qty . ' នាក់'}}</td>
            <td style="text-align:center;">{{ $i-$qtypay-$skip_qty . ' នាក់'}}</td>
            <td>{{ phpformatnumber($totalpay) . '$' }}</td>
            <td>{{ phpformatnumber($cuscharge) . '$' }}</td>
            <td>{{ phpformatnumber($discount) . '$' }}</td>
            <td>{{ phpformatnumber($paybycash) . '$' }}</td>
            <td>{{ phpformatnumber($paybybank) . '$' }}</td>
            <td>{{ phpformatnumber(abs($totalsale)) . '$' }}</td>
            <td>{{ phpformatnumber($totaldeposit) . '$' }}</td>
            <td>{{ phpformatnumber(abs($totalsale)-$totaldeposit) . '$' }}</td>

        </tr>
    </table>
</div>
