@php
function phpformatnumber($num){
    $dc=0;
    $p=strpos((float)$num,'.');
    if($p>0){
    $fp=substr($num,$p,strlen($num)-$p);
    $dc=strlen((float)$fp)-2;
    if($dc>2){
        $dc=2;
    }
    }
    return number_format($num,$dc,'.',',');
}
@endphp

<table id="tbl_all_partnerlist" class="table table-bordered kh14-b" style="table-layout:fixed;width:100%;">
    <thead style="text-align:center;">
        <th style="width:60px;padding:0px;">លរ</th>
        <th style="padding:0px;">ឈ្មោះដៃគូ</th>
        <th style="width:120px;padding:0px;">ប្រភេទ</th>
        <th style="padding:0px;">ដុល្លា</th>
        <th style="padding:0px;">បាត</th>
        <th style="padding:0px;">រៀល</th>
        <th style="padding:0px;">ដុង</th>
        <th style="padding:0px;">គិតជាដុល្លា</th>
    </thead>
    <tbody>
        @php
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;

        @endphp
        @foreach ($allpartnerlists as $key=>$d)

            @php
                $khr_usd=array(0,0,'/');
                $thb_usd=array(0,0,'/');
                $vnd_usd=array(0,0,'/');
                if($d->khr!=0){
                    $khr_usd=App\AllPartnerList::exchangetousd($d->khr,'KHR');
                }
                if($d->thb!=0){
                    $thb_usd=App\AllPartnerList::exchangetousd($d->thb,'THB');
                }
                if($d->vnd!=0){
                    $vnd_usd=App\AllPartnerList::exchangetousd($d->vnd,'VND');
                }
                $inusd=$d->usd+$khr_usd[0]+$thb_usd[0]+$vnd_usd[0];
                $usd+=$d->usd;
                $thb+=$d->thb;
                $khr+=$d->khr;
                $vnd+=$d->vnd;
            @endphp
            <tr>
                <td class="kh12-b" style="text-align:center;padding-top:4px;">{{ ++$key }}</td>
                <td>{{ $d->customer->name?$d->customer->name:'លុយសល់មិនទាន់បើក' }}</td>
                <td>{{ $d->customer->customertype }}</td>
                <td style="text-align:right;@if($d->usd<0) color:blue; @elseif($d->usd>0) color:red; @else color:black; @endif">{{ phpformatnumber(-1 * $d->usd) . '$'}}</td>
                <td style="text-align:right;@if($d->thb<0) color:blue; @elseif($d->thb>0) color:red; @else color:black; @endif">{{ phpformatnumber(-1 * $d->thb) .'B'}}</td>
                <td style="text-align:right;@if($d->khr<0) color:blue; @elseif($d->khr>0) color:red; @else color:black; @endif">{{ phpformatnumber(-1 * $d->khr) .'R'}}</td>
                <td style="text-align:right;@if($d->vnd<0) color:blue; @elseif($d->vnd>0) color:red; @else color:black; @endif">{{ phpformatnumber(-1 * $d->vnd) .'V'}}</td>
                <td style="text-align:right;@if($inusd<0) color:blue; @elseif($inusd>0) color:red; @else color:black; @endif">{{ phpformatnumber(-1 * $inusd) .'$'}}</td>
            </tr>
        @endforeach
        @php
            $khr_usd=array(0,0,'/');
            $thb_usd=array(0,0,'/');
            $vnd_usd=array(0,0,'/');
                if($khr!=0){
                    $khr_usd=App\AllPartnerList::exchangetousd($khr,'KHR');
                }
                if($thb!=0){
                    $thb_usd=App\AllPartnerList::exchangetousd($thb,'THB');
                }
                if($vnd!=0){
                    $vnd_usd=App\AllPartnerList::exchangetousd($vnd,'VND');
                }
                $inusd=$usd+$khr_usd[0]+$thb_usd[0]+$vnd_usd[0];
        @endphp
        <tr class="kh16-b" style="background-color:beige">
            <td colspan=3 style="text-align:center;">សរុប</td>
            <td style="text-align:right;font-weight:bold;@if($usd<0) color:blue; @elseif($usd>0) color:red; @else color:black; @endif">{{ phpformatnumber(-1 * $usd) .'$'}}</td>
            <td style="text-align:right;font-weight:bold;@if($thb<0) color:blue; @elseif($thb>0) color:red; @else color:black; @endif">{{ phpformatnumber(-1 * $thb) .'B'}}</td>
            <td style="text-align:right;font-weight:bold;@if($khr<0) color:blue; @elseif($khr>0) color:red; @else color:black; @endif">{{ phpformatnumber(-1 * $khr) .'R'}}</td>
            <td style="text-align:right;font-weight:bold;@if($vnd<0) color:blue; @elseif($vnd>0) color:red; @else color:black; @endif">{{ phpformatnumber(-1 * $vnd) .'V'}}</td>
            <td style="text-align:right;font-weight:bold;@if($inusd<0) color:blue; @elseif($inusd>0) color:red; @else color:black; @endif">{{ phpformatnumber(-1 * $inusd) .'$'}}</td>
        </tr>
    </tbody>
</table>

