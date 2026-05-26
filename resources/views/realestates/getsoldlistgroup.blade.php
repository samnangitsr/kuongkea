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
<div class="tableFixHead" style="padding:0px;">
    <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
        <thead style="text-align:center;" class="kh16">
            <th style="width:70px;">No</th>
            <th style="width:100px;">វិក័យប័ត្រ</th>
            <th style="width:100px;">ថ្ងៃលក់</th>
            <th id="th_customer" style="width:200px;">ឈ្មោះអតិថិជន</th>
            <th id="th_saler" style="width:200px;">អ្នកលក់គំរោង</th>
            <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
            <th style="width:150px;">បានទូទាត់រួច</th>
            <th style="width:150px;">នៅខ្វះ</th>
            <th style="width:100px;">ប្រភេទទូទាត់</th>
            <th style="width:100px;">កំរៃជើងសារ</th>
            <th style="width:180px;">ប្រតិបត្តិការណ៏</th>
            <th style="width:160px;">អ្នកកត់ត្រា</th>
            <th style="width:160px;">ថ្ងៃកត់ត្រា</th>
            <th style="width:300px;">ផ្សេងៗ</th>
            <th style="width:300px;">លេខទូរស័ព្ទ</th>
            <th style="width:300px;">លេខអត្តសញ្ញាណប័ណ្ណ</th>
            <th style="width:100px;">ប្រភេទទូទាត់</th>
            <th style="width:80px;">រយះពេល</th>
            <th style="width:80px;">អត្រា</th>
            <th style="width:120px;">បង់ប្រចាំខែ</th>
            <th style="width:120px;">គិតពី</th>
            <th style="width:120px;">ដល់</th>
        </thead>
        <tbody id="body_transaction">
            @php
                $totalamount=0;
                $totaldeposited=0;

            @endphp
            @foreach ($transfers as $k => $tr)
                @php
                    $totalamount +=$tr->amount;
                    $totaldeposited +=$tr->deposited;

                @endphp
                <tr>
                    <td style="text-align:center;padding:0px;" class="kh14-b">
                        <div class="dropdown">
                            <button style="width:70px;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                            <ul class="dropdown-menu">

                                  @if($tr->trancode==-8)

                                    <li class="li_code132"><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                                    <li class="li_code131">
                                        <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->id,'group_id'=>$tr->ref_group_id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->cursk,'curname'=>$tr->cur_shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                                    </li>
                                    <li class="li_code138"><a class="dropdown-item kh16-b btnready" style="@if(abs($tr->amount)-abs($tr->deposited)==0) display:block @else display:none @endif" href="#" data-id="{{ $tr->id }}" data-balance="{{ abs($tr->amount)-abs($tr->deposited) }}"><i class="fa fa-check"></i> ល្វែងនេះទូទាត់រួចរាល់</a></li>

                                    {{-- <li>
                                        <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->id,'group_id'=>$tr->ref_group_id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>0,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-building-o"></i> តារាងបង់ប្រាក់</a>
                                    </li> --}}


                                @endif
                                {{-- @if($tr->trancode==8)
                                    @if (Auth::user()->role->name<>'Admin')
                                        @if (App\User::checkpermission(Auth::id(),'1.6'))
                                            <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                                            <li>
                                                <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->id,'group_id'=>$tr->ref_group_id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->cursk,'curname'=>$tr->cur_shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                                            </li>
                                        @endif
                                    @else
                                        <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                                        <li>
                                            <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->id,'group_id'=>$tr->ref_group_id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->cursk,'curname'=>$tr->cur_shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                                        </li>
                                    @endif
                                @endif --}}
                            </ul>
                        </div>

                    </td>
                    <td class="kh16">{{ sprintf("%04d",$tr->id) }}</td>
                    <td class="kh16">{{ date('d-m-Y',strtotime($tr->dd)) }}</td>
                    <td class="kh16">{{ $tr->buyername }}</td>
                    <td class="kh16">{{ $tr->salername }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->amount)) .$tr->cursk }}</td>
                    <td class="kh16-b" style="text-align:right;">
                        <a href="{{ route('realestate.showdeposit',['id'=>$tr->id,'group_id'=>$tr->ref_group_id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->cursk,'curname'=>$tr->cur_shortcut,'payinmonth'=>$tr->payinmonth,'sendername'=>$tr->sendername]) }}" class="kh16-b" target="_blank" style="margin:0px;padding:2px;text-decoration:underline;">{{ phpformatnumber(abs($tr->deposited)) .$tr->cursk }}</a>
                    </td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->amount)-abs($tr->deposited)) .$tr->cursk }}</td>
                    <td class="kh16" style="text-align:right;">{{ $tr->paymenttype==1?'បង់ផ្តាច់':'បង់រំលស់' }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->cuscharge) .$tr->cuscharge_sk }}</td>
                    <td class="kh16">{{ $tr->tranname }}</td>
                    <td class="kh16">{{ $tr->username }}</td>
                    <td class="kh16">{{ date('d-m-Y',strtotime($tr->created_at)) }}</td>
                    <td class="kh16">{{ $tr->note }}</td>
                    <td class="kh16">{{ $tr->buyertel }}</td>
                    <td class="kh16">{{ $tr->buyer_identity }}</td>
                    <td class="kh16">{{ $tr->paymenttype==1?'បង់ផ្តាច់':'បង់រំលស់' }}</td>
                    <td class="kh16">{{ $tr->term??'' }}</td>
                    <td class="kh16">{{ $tr->interest_rate??'0' }}</td>
                    <td class="kh16" style="text-align:right;">{{ phpformatnumber($tr->payinmonth??'0') . $tr->cursk}}</td>
                    <td class="kh16">{{ date('d-m-Y',strtotime($tr->startdate))}}</td>
                    <td class="kh16">{{ date('d-m-Y',strtotime($tr->enddate))}}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
<div class="">
    <table id="tbl_summary" class="table kh22-b" style="margin:0px;">

        <tbody>
            <tr>
                <td style="width:140px;">សរុបទឹកប្រាក់ :</td> <td>{{ phpformatnumber(abs($totalamount)) . ' USD'}}</td>
                <td style="width:100px;">ទូទាត់រួច :</td><td>{{ phpformatnumber(abs($totaldeposited)) . ' USD'}}</td>
                <td style="width:100px;">សមតុល្យ :</td><td>{{ phpformatnumber(abs($totalamount)-abs($totaldeposited)) . ' USD'}}</td>
            </tr>
        </tbody>
    </table>
</div>
