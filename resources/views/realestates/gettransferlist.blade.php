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
@foreach ($transfers as $k =>$tr)
    <tr>
        <td style="text-align:center;padding:0px;" class="kh14-b">
            {{-- <div class="dropdown">
                <button style="width:70px;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}" data-trancode="{{ $tr->trancode }}" data-sendername="{{ $tr->sendername }}" data-sendertel="{{ $tr->sendertel }}"><i class="fa fa-print"></i> Print</a></li>
                    @if($tr->trancode==-8)
                        @if(str_contains($tr->action,'u'))
                            <li><a href="#" class="dropdown-item kh16-b btnedit" style="color:green;" data-id="{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}"><i class="fa fa-pencil"></i> Edit</a></li>
                        @endif
                    @endif
                    @if(str_contains($tr->action,'d'))
                        @if (Auth::user()->role->name<>'Admin')
                            @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                <li><a class="dropdown-item kh16-b btndeltransfer" style="color:red;" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}"><i class="fa fa-trash"></i> Delete</a></li>
                            @endif
                        @else
                            <li><a class="dropdown-item kh16-b btndeltransfer" style="color:red;" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}"><i class="fa fa-trash"></i> Delete</a></li>
                        @endif
                    @endif
                    @if($tr->trancode==8 || $tr->trancode==-8)
                        <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                    @endif
                </ul>
            </div> --}}
            <div class="dropdown">
                <button style="width:70px;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                 <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}" data-trancode="{{ $tr->trancode }}" data-sendername="{{ $tr->sendername }}" data-sendertel="{{ $tr->sendertel }}"><i class="fa fa-print"></i> Print</a></li>
                    @if($tr->trancode==-8)
                        @if(str_contains($tr->action,'u'))
                            <li class="li_code111" title="code:1.1.1"><a href="#" class="dropdown-item kh16-b btnedit" style="color:green;" data-id="{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}"><i class="fa fa-pencil"></i> Edit</a></li>
                        @endif
                        @if($tr->term && $tr->term>0)
                            <li class="li_code113" title="code:1.1.3">
                                <a class="dropdown-item kh16-b" href="{{ route('realestate.printromloslistforcustomer',['id'=>$tr->id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-print"></i> ព្រីនតារាងបង់ប្រាក់</a>
                            </li>
                        @endif
                    @endif
                    @if(str_contains($tr->action,'d'))
                        <li class="li_code112" title="code:1.1.2"><a class="dropdown-item kh16-b btndeltransfer" style="color:red;" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}"><i class="fa fa-trash"></i> Delete</a></li>
                    @endif
                    {{-- @if($tr->trancode==-8)
                        @if (Auth::user()->role->name<>'Admin')
                            @if (App\User::checkpermission(Auth::id(),'1.1.5'))
                                <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                            @endif
                        @else
                            <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                        @endif
                    @endif --}}
                </ul>
            </div>
        </td>
        <td class="kh16">
            {{ date('d-m-Y',strtotime($tr->dd)) }}
        </td>
        <td class="kh16">
            <a href="#inv{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ sprintf("%04d",$tr->id) }}</a>
        </td>
        <td class="kh16">{{ $tr->tranname }}</td>
        <td class="kh16">{{ $tr->partner->name }}</td>
        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amount) .$tr->currency->sk }}</td>
        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->discount) .$tr->disc_by }}</td>
        <td class="kh16" style="text-align:right;">{{ $tr->paymenttype==1?'បង់ផ្តាច់':'បង់រំលស់' }}</td>
        <td class="kh16">{{ $tr->customer->name }}</td>
        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->cuscharge) .$tr->cuschargecur->sk }}</td>
        <td class="kh16">{{ $tr->user->name }}</td>
        <td class="kh16">{{ date('d-m-Y',strtotime($tr->created_at)) }}</td>
        <td class="kh16">{{ $tr->tt }}</td>
        <td class="kh16">{{ $tr->ref_group_id }}</td>
        <td class="kh16">{{ $tr->note }}</td>
    </tr>
    <tr id="inv{{ $tr->id }}" class="collapse borderset2" style="">
        <td colspan=13 style="">
            <table class="table table-bordered kh12-b" style="margin:0px;">
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach (App\PartnerTransfer::showbygroupsale($tr->id,$tr->ref_group_id) as $item)
                        @php
                            $i=$i+1;
                        @endphp
                        @if($i==1)
                            <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                <td style="width:100px;">ID</td>
                                <td style="width:90px;">Date</td>
                                <td style="width:80px;">Time</td>
                                <td style="width:150px;">ប្រតិបត្តិការណ៏</td>
                                <td style="width:150px;">ដៃគូ</td>
                                <td style="width:120px;">ចំនួនទឹកប្រាក់</td>
                                <td style="width:80px;">សេវ៉ាដៃគូ</td>
                                <td style="width:100px;">អ្នកកត់ត្រា</td>
                                <td style="">ផ្សេងៗ</td>
                            </tr>
                        @endif
                        <tr class="kh12-b" style="">
                            <td style="text-align:center;">{{ $item->id }}</td>
                            <td>{{ date('d-m-Y',strtotime($item->dd))}}</td>
                            <td>{{ $item->tt }}</td>
                            <td>{{ $item->tranname }}</td>
                            <td>{{ $item->partner->name }}</td>
                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                            <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->sk }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->note }}</td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </td>
    </tr>
@endforeach
