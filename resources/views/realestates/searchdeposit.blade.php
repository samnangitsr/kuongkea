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

@php
    $balance=0;
@endphp
@foreach ($myc as $k => $tr)
    @php
    $balance += floatval($tr['amount']);
    @endphp
    <tr>
        <td style="text-align:center;padding:3px 0px;" class="kh14-b">
            @if($tr['action']=='d')
            <div class="dropdown">
                <button style="width:70px;color:red;background-color:yellow;border-style:none;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item kh16-b btndel" style="color:red;" href="#" data-payonid="{{ $tr['payonid'] }}" data-id="{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" ><i class="fa fa-trash"></i> លុបចោល</a></li>
                    <li><a class="dropdown-item kh16-b btnreprint" style="" href="#" data-payonid="{{ $tr['payonid'] }}" data-id="{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" ><i class="fa fa-print"></i> ព្រីនឡើងវិញ</a></li>

                </ul>
            </div>
            @else
                {{ ++$k }}
            @endif
        </td>
        <td class="kh16">
            <a href="#inv{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ sprintf("%04d",$tr['id']) }}</a>
        </td>

        <td class="kh16">
            {{ date('d-m-Y',strtotime($tr['payformonth']??$tr['trandate'])) }}
        </td>

        <td class="kh16">{{ $tr['tranname'] }} {{ $tr['trancode']<>-8?$tr['sendername']:'' }}</td>

        <td class="kh16-b" style="text-align:right;@if($tr['amount']>0) color:blue; @else color:red; @endif">{{ $tr['amount']>0?'+':'' }} {{ phpformatnumber($tr['amount']) .$tr['currency'] }}</td>

        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($balance) .$tr['currency'] }}</td>
        <td class="kh16">
            {{ $tr['usersave'] }}
        </td>
        <td class="kh16">
            {{ $tr['trandate']? date('d-m-Y',strtotime($tr['trandate'])):'' }}
        </td>
        <td class="kh16">
            {{ $tr['tt'] }}
        </td>
        @if(Auth::user()->role->name=='Admin')
        @if(str_contains($tr['main_action'],'d') && $tr['trancode']<>8 && $tr['trancode']<>-8)
                <td style="text-align:center;">
                    <a class="kh16-b btndel" style="color:red;" href="#" data-payonid="{{ $tr['payonid'] }}" data-id="{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" ><i class="fa fa-trash"></i></a>
                </td>
            @endif
        @endif
    </tr>
    <tr id="inv{{ $tr['id'] }}" class="collapse borderset2" style="">
        <td colspan=8 style="">
            <table class="table table-bordered" style="margin:0px;">
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach (App\PartnerTransfer::showbygroup($tr['id'],$tr['groupid']) as $item)
                        @php
                            $i=$i+1;
                        @endphp
                        @if($i==1)
                            <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                <td style="width:100px;">ID</td>
                                <td style="width:90px;">Date</td>
                                <td style="width:80px;">Time</td>
                                <td style="width:100px;">ប្រតិបត្តិការណ៏</td>
                                <td style="width:150px;">ដៃគូ</td>
                                <td style="width:120px;">ចំនួនទឹកប្រាក់</td>
                                <td style="width:80px;">សេវ៉ាដៃគូ</td>
                                <td style="width:100px;">អ្នកកត់ត្រា</td>
                                <td style="">ផ្សេងៗ</td>
                            </tr>
                        @endif
                        <tr class="kh12-b" style="">
                            <td style="text-align:center;">{{ $item->id }}
                                @if(Auth::user()->role->name=='Admin')
                                    @if($item->trancode==1 || $item->trancode==4)
                                        @if($i==1)
                                            <br>
                                            <a href="" class="mybtn btnaddcommission" data-id="{{$item->id}}" data-group_id="{{$item->ref_group_id}}" style="color:purple;border-style:none;">Fix Comm</a>
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>{{ date('d-m-Y',strtotime($item->dd))}}</td>
                            <td>{{ $item->tt }}</td>
                            <td>{{ $item->tranname }}</td>
                            <td>{{ $item->partner->name }}</td>
                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                            <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->sk }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td{{ $item->note }}</td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </td>
    </tr>
@endforeach
