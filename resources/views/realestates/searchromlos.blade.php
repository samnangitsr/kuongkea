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

    <td style="text-align:center;padding:0px;border-left:none;" class="kh14-b">
        @if($tr['action']=='p')
            <div class="dropdown">
                <button style="width:70px;background-color:aquamarine;border-style:none;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                <ul class="dropdown-menu">
                    <li class="li_code131" title="code:1.3.1"><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-payonid="{{ $tr['payonid'] }}" data-payformonth="{{ $tr['dd'] }}" data-payamt="{{ $tr['amount'] }}" data-curid="{{ $tr['curid'] }}" ><i class="fa fa-money"></i> បង់ខែនេះ</a></li>
                </ul>
            </div>
        @elseif($tr['action']=='d')
            <div class="dropdown">
                <button style="width:70px;color:red;background-color:yellow;border-style:none;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                <ul class="dropdown-menu">
                    <li class="li_code135" title="code:1.3.5"><a class="dropdown-item kh16-b btndel" style="color:red;" href="#" data-payonid="{{ $tr['payonid'] }}" data-id="{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" ><i class="fa fa-trash"></i> លុបចោល</a></li>
                    <li class="li_code136" title="code:1.3.6"><a class="dropdown-item kh16-b btnreprint" style="" href="#" data-payonid="{{ $tr['payonid'] }}" data-payformonth="{{ $tr['payformonth']??'' }}"  data-id="{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" ><i class="fa fa-print"></i> ព្រីនឡើងវិញ</a></li>

                </ul>
            </div>
        @else
            {{ ++$k }}
        @endif
    </td>
    <td class="kh16">
        <a href="#inv{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ $tr['id']?sprintf("%04d",$tr['id']):'' }}</a>
    </td>


    <td class="kh16">
        {{ date('d-m-Y',strtotime($tr['dd'])) }}
    </td>

    <td class="kh16">{{ $tr['tranname'] }} {{ $tr['trancode']<>-8?$tr['sendername']:'' }}</td>

    <td class="kh16-b" style="text-align:right;@if($tr['amount']>0) color:blue; @else color:red; @endif">{{ $tr['amount']>0?'+':'' }} {{ phpformatnumber($tr['amount']) .$tr['currency'] }}</td>

    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($balance) .$tr['currency'] }}</td>
    <td class="kh16">{{ $tr['usersave'] }}</td>
    <td class="kh16">
        {{ $tr['trandate']? date('d-m-Y',strtotime($tr['trandate'])):'' }}
    </td>
    <td class="kh16">{{ $tr['tt'] }}</td>
</tr>
<tr id="inv{{ $tr['id'] }}" class="collapse borderset2" style="">
    <td colspan=9 style="">
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
                            <td style="width:100px;">ថ្ងៃទូទាត់</td>
                            <td style="width:80px;">Time</td>
                            <td style="width:90px;">បង់ខែ</td>
                            <td style="width:150px;">ប្រតិបត្តិការណ៏</td>
                            <td style="width:150px;">ដៃគូ</td>
                            <td style="width:120px;">ចំនួនទឹកប្រាក់</td>
                            <td style="width:80px;">ពិន័យ</td>
                            <td style="width:80px;">លើកលែង</td>
                            <td style="width:100px;">អ្នកកត់ត្រា</td>
                            <td style="width:100px;">ថ្ងៃកត់ត្រា</td>
                            <td style="width:200px;">ផ្សេងៗ</td>
                        </tr>
                    @endif
                    <tr class="kh12-b" style="">
                        <td style="text-align:center;">{{ $item->id }}
                            @if($item->id==explode('-',$item->ref_group_id)[1])
                                @if($i==1)
                                    <br>
                                    <a href="" class="btnupdatepayment" data-id="{{$item->id}}" data-group_id="{{$item->ref_group_id}}" style="color:purple;border-style:none;">Fix Paid</a>
                                @endif
                            @endif
                        </td>
                        <td>{{ date('d-m-Y',strtotime($item->dd))}}
                                @if($item->id==explode('-',$item->ref_group_id)[1])
                                @if($i==1)
                                    <br>
                                    <a class="btnreprint" style="color:rgb(57, 54, 233);border-style:none;" href="#" data-id="{{ $item->id }}" data-payformonth="{{ $item->payformonth??'' }}"  data-groupid="{{ $item->ref_group_id }}">ព្រីនឡើងវិញ</a>
                                @endif
                            @endif
                        </td>
                        <td>{{ $item->tt }}</td>
                        <td>{{ $item->payformonth?date('d-m-Y',strtotime($item->payformonth)):''}}</td>
                        <td>{{ $item->tranname }}</td>
                        <td>{{ $item->partner->name }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($item->trancode==-8?0:$item->cuscharge) . ' ' . $item->cuschargecur->sk }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($item->discount_amount) . ' ' . $item->cuschargecur->sk }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ date('d-m-Y',strtotime($item->created_at))}}</td>
                        <td>{{ $item->note }}</td>

                    </tr>
                @endforeach

            </tbody>

        </table>
    </td>

</tr>
@endforeach
