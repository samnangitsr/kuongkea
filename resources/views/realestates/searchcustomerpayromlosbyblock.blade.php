@php
$i=0;
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

@foreach ($transfers as $k => $tr)
@php
    $i+=1;
    $bal=abs($tr->main_amount)-abs($tr->deposited);
@endphp
<tr class="@if($bal==0) @elseif(floatval($tr->qtyleftday)<=0 && floatval($tr->qtyleftday+10)>=0) c_orange @elseif(floatval($tr->qtyleftday)<0 && floatval($tr->qtyleftday+10)<0) c_red @endif">
    <td style="text-align:center;padding:0px;" class="kh14-b">
        <div class="dropdown">
            <button style="width:70px;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ $i }}</button>
             <ul class="dropdown-menu">
                @if (Auth::user()->role->name<>'Admin')
                    @php
                        $bal=abs($tr->main_amount)-abs($tr->deposited);
                    @endphp
                    @if($tr->qtyleftday<=-90 && $bal>0)
                        <li class="kh16-b" style="margin:5px;">អតិថិជននេះត្រូវបាន ប្លុក ដោយសារមិនបានបង់បីខែហើយ</li>
                    @else
                        <li class="li_code131">
                            <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->main_id,'property_group'=>$tr->main_property_group,'property_id'=>$tr->main_property_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->main_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->sk,'curname'=>$tr->main_shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property,'qtyleftday'=>$tr->qtyleftday]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                        </li>
                        <li class="li_code132"><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->main_id }}" data-property_group="{{ $tr->main_property_group }}" data-property_id="{{ $tr->main_property_id }}" data-qtyleftday="{{ $tr->qtyleftday }}"><i class="fa fa-money"></i> កក់ប្រាក់បន្ថែម</a></li>
                        <li class="li_code133">
                            <a class="dropdown-item kh16-b" href="{{ route('realestate.printromloslistforcustomer',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->main_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->sk,'curname'=>$tr->main_shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property,'qtyleftday'=>$tr->qtyleftday]) }}" target="_blank"><i class="fa fa-print"></i> ព្រីនតារាងបង់ប្រាក់</a>
                            <a class="dropdown-item kh16-b btnnewpayment" data-id="{{ $tr->main_id }}" href="" target=""><i class="fa fa-cog"></i> កំណត់ការបង់ប្រាក់ថ្មី</a>
                        </li>
                    @endif
                @else
                    <li title="Code:1.3.1">
                        <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->main_id,'property_group'=>$tr->main_property_group,'property_id'=>$tr->main_property_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->main_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->sk,'curname'=>$tr->main_shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property,'qtyleftday'=>$tr->qtyleftday]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                    </li>
                    <li title="Code:1.3.2"><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->main_id }}" data-property_group="{{ $tr->main_property_group }}" data-property_id="{{ $tr->main_property_id }}" data-qtyleftday="{{ $tr->qtyleftday }}"><i class="fa fa-money"></i> កក់ប្រាក់បន្ថែម</a></li>
                    <li title="Code:1.3.3">
                        <a class="dropdown-item kh16-b" href="{{ route('realestate.printromloslistforcustomer',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->main_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->sk,'curname'=>$tr->main_shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property,'qtyleftday'=>$tr->qtyleftday]) }}" target="_blank"><i class="fa fa-print"></i> ព្រីនតារាងបង់ប្រាក់</a>
                        <a class="dropdown-item kh16-b btnnewpayment" data-id="{{ $tr->main_id }}" href="" target=""><i class="fa fa-cog"></i> កំណត់ការបង់ប្រាក់ថ្មី</a>
                    </li>
                    <li title="Code:1.3.4"><a class="dropdown-item kh16-b btnready" style="@if(abs($tr->main_amount)-abs($tr->deposited)==0) display:block @else display:none @endif" href="#" data-id="{{ $tr->main_id }}" data-balance="{{ abs($tr->main_amount)-abs($tr->deposited) }}"><i class="fa fa-check"></i> ល្វែងនេះទូទាត់រួចរាល់</a></li>
                @endif
            </ul>
        </div>
    </td>
    <td class="en16">{{ sprintf("%04d",$tr->main_id) . $tr->qtyleftday }}</td>
    <td class="en16">{{ date('d-m-Y',strtotime($tr->main_dd)) }}</td>

    <td class="kh16">{{ $tr->main_property }}</td>
    <td class="kh16">{{ $tr->buyer }}</td>
    <td class="en16">{{ date('d-m-Y',strtotime($tr->nextpayment_new))}}</td>

    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->main_amount)) .$tr->sk }}</td>
    <td class="kh16-b" style="text-align:right;">
        <a href="{{ route('realestate.showdeposit',['id'=>$tr->main_id,'property_group'=>$tr->main_property_group,'property_id'=>$tr->main_property_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->main_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->sk,'curname'=>$tr->main_shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property,'qtyleftday'=>$tr->qtyleftday]) }}" class="kh16-b " target="_blank" style="margin:0px;padding:2px;@if($bal==0) @elseif(floatval($tr->qtyleftday)<=0 && floatval($tr->qtyleftday+10)>=0) color:black; @elseif(floatval($tr->qtyleftday)<0 && floatval($tr->qtyleftday+10)<0) color:white; @endif">{{ phpformatnumber(abs($tr->deposited)) .$tr->sk }}</a>
    </td>
    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->main_amount)-abs($tr->deposited)) .$tr->sk }}</td>

    <td class="kh16">{{ $tr->saler }}</td>
    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->main_cuscharge) .$tr->sk }}</td>
    <td class="kh16" style="text-align:center;">{{ $tr->main_saveby }}</td>
    <td class="kh16">{{ $tr->main_note }}</td>
    <td class="kh16">{{ $tr->main_tel }}</td>
    <td class="kh16">{{ $tr->main_idcard }}</td>
    <td class="kh16">{{ $tr->main_paymenttype==1?'បង់ផ្តាច់':'បង់រំលស់' }}</td>
    <td class="kh16">{{ $tr->main_term??'' }}</td>
    <td class="kh16">{{ $tr->main_interest_rate??'0' }}</td>
    <td class="kh16" style="text-align:right;">{{ phpformatnumber($tr->main_payinmonth??'0') . $tr->sk}}</td>
    <td class="kh16">{{ date('d-m-Y',strtotime($tr->main_startdate))}}</td>
    <td class="kh16">{{ date('d-m-Y',strtotime($tr->main_enddate))}}</td>
</tr>
@endforeach
