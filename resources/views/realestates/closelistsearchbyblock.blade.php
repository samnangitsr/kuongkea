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
<div  class="print-title" style="margin-top:-50px;">
    <span class="kh22-b" id="rpt_title"></span>
    <span class="kh16-b" id="rpt_title1" style="float:right;"></span>
</div>

<div class="table-responsive" style="height:70vh;
    overflow-y: auto;">

        <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="">
            <thead style="text-align:center;" class="kh16">
                <th data-col="0" class="selected selected_header" style="width:60px;">No</th>
                <th data-col="1" class="" style="">វិក័យប័ត្រ</th>
                <th data-col="2" class="selected selected_header" style="">ថ្ងៃលក់</th>
                <th data-col="3" class="selected selected_header" style="padding:0px 30px;">អចលនទ្រព្យ</th>
                <th data-col="4" class="selected selected_header" id="th_customer" style="padding:0px 50px;">​អតិថិជន</th>
                <th data-col="5" class="selected selected_header" style="">ខែទូទាត់</th>
                <th data-col="6" class="selected selected_header" style="">ចំនួន</th>
                <th data-col="7" class="selected selected_header" style="">សរុបបង់</th>
                <th data-col="8" class="selected selected_header" style="">សំរាប់ខែ</th>
                <th data-col="9" class="selected selected_header" style="">ខែបន្ទាប់</th>
                <th data-col="10" class="selected selected_header" style="">សាច់ប្រាក់</th>
                <th data-col="11" class="selected selected_header" style="">ធនាគា</th>
                <th data-col="12" class="selected selected_header" style="">ពិន័យ</th>
                <th data-col="13" class="selected selected_header" style="">លើកលែង</th>
                {{-- <th style="width:100px;">ចំនួនថ្ងៃ</th> --}}
                <th data-col="14" class="selected selected_header" style="">តំលៃលក់</th>
                <th data-col="15" class="selected selected_header" style="">បានទូទាត់រួច</th>
                <th data-col="16" class="selected selected_header" style="">នៅខ្វះ</th>
                <th data-col="17" class="" id="th_saler" style="">អ្នកលក់គំរោង</th>
                <th data-col="18" class="" style="">កំរៃជើងសារ</th>
                <th data-col="19" class="" style="">អ្នកកត់ត្រា</th>
                <th data-col="20" class="" style="">ផ្សេងៗ</th>
                <th data-col="21" class="" style="">លេខទូរស័ព្ទ</th>
                <th data-col="22" class="" style="">លេខអត្តសញ្ញាណប័ណ្ណ</th>
                <th data-col="23" class="" style="">ប្រភេទទូទាត់</th>
                <th data-col="24" class="" style="">តាមរយះ</th>
                <th data-col="25" class="" style="">ប្រភេទបង់</th>
                <th data-col="26" class="" style="">រយះពេល</th>
                <th data-col="27" class="" style="">ការប្រាក់</th>
                <th data-col="28" class="" style="">បង់ក្នុង១ខែ</th>
                <th data-col="29" class="" style="">គិតពី</th>
                <th data-col="30" class="" style="">ដល់</th>
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
                {{-- $transfers->sortBy('property_id') as $k => $tr --}}
                    @php
                        $i+=1;
                        $total_amount=floatval($tr->amt_cash) + floatval($tr->more_cash)+floatval($tr->amt_bank) + floatval($tr->more_bank)+floatval($tr->amt_cash_over)+floatval($tr->amt_bank_over);
                        $total_cash=floatval($tr->amt_cash) + floatval($tr->more_cash)+floatval($tr->amt_cash_over);
                        $total_bank=floatval($tr->amt_bank) + floatval($tr->more_bank)+floatval($tr->amt_bank_over);
                        $totalpay +=$total_amount;
                        $paybycash +=$total_cash;
                        $paybybank +=$total_bank;

                        if($tr->trancode_new<>-8 && floatval($tr->count_pay + $tr->count_moredeposit + $tr->count_pay_over)>0){
                            $cuscharge +=floatval($tr->punish) + floatval($tr->punish_over)-floatval($tr->punish_debt)-floatval($tr->punish_debt_over);
                            $discount +=floatval($tr->discount_punish) + floatval($tr->discount_punish_over);
                        }

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
                        <td style="text-align:center;padding:0px;" class="kh12-b">
                            <div class="dropdown">
                                <button style="width:60px;" type="button" class="mybtn dropdown-toggle kh12-b" data-bs-toggle="dropdown">{{ $i }}</button>
                                <ul class="dropdown-menu">
                                    @if (Auth::user()->role->name<>'Admin')
                                        @if (App\User::checkpermission(Auth::id(),'1.1.5'))
                                            <li>
                                                <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->main_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->sk,'curname'=>$tr->shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property]) }}" target="_blank"><i class="fa fa-building"></i> តារាងបង់រំលស់</a>
                                            </li>
                                            <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->main_id }}" ><i class="fa fa-money"></i> កក់ប្រាក់បន្ថែម</a></li>
                                        @endif
                                    @else
                                        <li>
                                            <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->main_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->sk,'curname'=>$tr->shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property]) }}" target="_blank"><i class="fa fa-building"></i> តារាងបង់រំលស់</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item kh16-b" href="{{ route('realestate.printromloslistforcustomer',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->main_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->sk,'curname'=>$tr->shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property]) }}" target="_blank"><i class="fa fa-print"></i> ព្រីនតារាងបង់ប្រាក់</a>
                                        </li>
                                        <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->main_id }}"><i class="fa fa-money"></i> កក់ប្រាក់បន្ថែម</a></li>
                                    @endif

                                </ul>
                            </div>
                        </td>

                        <td data-col="1" class="en16" title="{{$tr->trid_new}}">{{ sprintf("%04d",$tr->main_id) . $tr->qtyleftday }}</td>
                        <td data-col="2" class="en16 selected">{{ date('d-m-y',strtotime($tr->main_dd)) }}</td>
                        <td data-col="3" class="kh16 selected wraptext">{{ $tr->main_property }}</td>
                        <td data-col="4" class="kh16 selected ">{{ $tr->buyer }}</td>
                        <td data-col="5" class="kh16-b selected" style="text-align:center;">{{ dokhmermonth($tr->inmonth)}}</td>
                        <td data-col="6" class="kh16 selected" style="text-align:center;">{{ $tr->count_pay + $tr->count_moredeposit + $tr->count_pay_over . ' ដង' }}</td>
                        <td data-col="7" class="kh16-b selected" style="text-align:right;" title="{{number_format($totalpay,0,'.',' ')}}">{{ phpformatnumber($total_amount) .$tr->sk }}</td>
                        <td data-col="8" class="en16 selected">{{ $tr->payformonth_new?date('d-m-y',strtotime($tr->payformonth_new)):''}}</td>
                        <td data-col="9" class="en16 selected">{{ $tr->nextpayment_new?date('d-m-y',strtotime($tr->nextpayment_new)) : ''}}</td>
                        <td data-col="10" class="kh16-b selected" style="text-align:right;" title="{{number_format($paybycash,0,'.',' ')}}">{{ phpformatnumber($total_cash) .$tr->sk }}</td>
                        <td data-col="11" class="kh16-b selected" style="text-align:right;"  title="{{number_format($paybybank,0,'.',' ')}}">{{ phpformatnumber($total_bank) .$tr->sk }}</td>
                        {{-- <td class="kh16-b" style="text-align:right;"  title="{{$cuscharge}}">{{ phpformatnumber($tr->trancode_new==-8?0:$tr->cuscharge_new) .$tr->sk }}</td>
                        <td class="kh16-b" style="text-align:right;"  title="{{$discount}}">{{ phpformatnumber($tr->discount_new) .$tr->sk }}</td> --}}

                        <td data-col="12" class="kh16-b selected" style="text-align:right;"  title="{{$cuscharge}}">{{ phpformatnumber($tr->punish+$tr->punish_over-$tr->punish_debt-$tr->punish_debt_over) .$tr->sk }}</td>
                        <td data-col="13" class="kh16-b selected" style="text-align:right;"  title="{{$discount}}">{{ phpformatnumber($tr->discount_punish+$tr->discount_punish_over) . $tr->sk }}</td>
                        {{-- <td class="en16" style="text-align:center;">{{ floatval($tr->qtyleftday) }}</td> --}}
                        <td data-col="14" class="kh16-b selected" style="text-align:right;">{{ phpformatnumber(abs($tr->main_amount)) .$tr->sk }}</td>
                        <td data-col="15" class="kh16-b selected" style="text-align:right;">
                            <a href="{{ route('realestate.showdeposit',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->main_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->sk,'curname'=>$tr->shortcut,'payinmonth'=>$tr->main_payinmonth,'sendername'=>$tr->main_property]) }}" class="kh16-b " target="_blank" style="margin:0px;padding:2px;@if((floatval($tr->count_pay) + floatval($tr->count_moredeposit) + floatval($tr->count_pay_over))<=0 && $tr->qtyleftday<0) color:white; @endif">{{ phpformatnumber(abs($tr->deposited)) .$tr->sk }}</a>
                        </td>
                        <td data-col="16" class="kh16-b selected" style="text-align:right;">{{ phpformatnumber(abs($tr->main_amount)-abs($tr->deposited)) .$tr->sk }}</td>

                        <td data-col="17" class="kh16">{{ $tr->saler }}</td>
                        <td data-col="18" class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->main_cuscharge) .$tr->sk }}</td>
                        <td data-col="19" class="kh16">{{ $tr->main_saveby }}</td>
                        <td data-col="20" class="kh16">{{ $tr->main_note }}</td>
                        <td data-col="21" class="kh16">{{ $tr->main_tel }}</td>
                        <td data-col="22" class="kh16">{{ $tr->main_idcard }}</td>
                        <td data-col="23" class="kh16">{{ $tr->deposit_via_id }}</td>
                        <td data-col="24" class="kh16">{{ $tr->deposit_via }}</td>

                        <td data-col="25" class="kh16">{{ $tr->main_paymenttype==1?'បង់ផ្តាច់':'រំលស់' }}</td>
                        <td data-col="26" class="kh16" style="text-align:center;">{{ $tr->main_term?$tr->main_term . 'ខែ':'' }}</td>
                        <td data-col="27" class="kh16" style="text-align:center;">{{ $tr->main_interest_rate??0 }}%</td>
                        <td data-col="28" class="kh16" style="text-align:right;">{{ phpformatnumber($tr->main_payinmonth??0) . $tr->sk}}</td>
                        <td data-col="29" class="kh16">{{ $tr->main_startdate?date('d-m-Y',strtotime($tr->main_startdate)):''}}</td>
                        <td data-col="30" class="kh16">{{ $tr->main_enddate?date('d-m-Y',strtotime($tr->main_enddate)):''}}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

</div>

<div class="table-responsive" style="">
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
