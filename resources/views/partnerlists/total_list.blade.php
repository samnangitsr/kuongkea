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
    $usd=0;
    $khr=0;
    $thb=0;
    $vnd=0;
@endphp
<div class="col-lg-6">
    <table id="tbl1" class="table table-bordered table-hover">
        <tr>
            <td class="kh22-b" style="text-align:center;" colspan=2>{{ 'នៅខ្វះ '.$logo->name }}</td>
        </tr>
        @foreach ($mycash as $mc)
            @php
                if($mc->cur=='USD'){
                    $usd=$mc->total;
                }elseif($mc->cur=='THB'){
                    $thb=$mc->total;
                }elseif($mc->cur=='KHR'){
                    $khr=$mc->total;
                }elseif($mc->cur=='VND'){
                    $vnd=$mc->total;
                }
            @endphp

        @endforeach
        <tr>
            <td style="padding:0px;">
                <input type="button" style="text-align:right;width:100%" class="btn kh22-b webutton" value="{{ phpformatnumber($usd) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="button" class="btn kh22-b" value="USD" title="{{ $usd_id->id }}">
            </td>
        </tr>
        <tr>
            <td style="padding:0px;">
                <input type="button" style="text-align:right;width:100%" class="btn kh22-b webutton" value="{{ phpformatnumber($thb) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="button" class="btn kh22-b" value="THB" title="{{ $thb_id->id }}">
            </td>
        </tr>
        <tr>
            <td style="padding:0px;">
                <input type="button" style="text-align:right;width:100%" class="btn kh22-b webutton" value="{{ phpformatnumber($khr) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="button" class="btn kh22-b" value="KHR" title="{{ $khr_id->id }}">
            </td>
        </tr>
        <tr>
            <td style="padding:0px;">
                <input type="button" style="text-align:right;width:100%" class="btn kh22-b webutton" value="{{ phpformatnumber($vnd) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="button" class="btn kh22-b" value="VND" title="{{ $vnd_id->id??'' }}">
            </td>
        </tr>
    </table>
</div>
@php
    $usd=0;
    $khr=0;
    $thb=0;
    $vnd=0;
@endphp
<div class="col-lg-6">
    <table id="tbl2" class="table table-bordered table-hover">
        <tr>
            <td class="kh22-b" style="text-align:center;" colspan=2><span id="r_right">{{ 'នៅខ្វះ' . $partnername }}</span></td>
        </tr>
        @foreach ($theircash as $tc)
        @php
            if($tc->cur=='USD'){
                $usd=$tc->total;
            }elseif($tc->cur=='THB'){
                $thb=$tc->total;
            }elseif($tc->cur=='KHR'){
                $khr=$tc->total;
            }elseif($tc->cur=='VND'){
                $vnd=$tc->total;
            }
        @endphp

    @endforeach
        <tr>
            <td style="padding:0px;">
                <input type="button" style="text-align:right;width:100%" class="btn kh22-b theirbutton" value="{{ phpformatnumber($usd) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="button" class="btn kh22-b" value="USD" title="{{ $usd_id->id }}">
            </td>
        </tr>
        <tr>
            <td style="padding:0px;">
                <input type="button" style="text-align:right;width:100%" class="btn kh22-b theirbutton" value="{{ phpformatnumber($thb) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="button" class="btn kh22-b" value="THB" title="{{ $thb_id->id }}">
            </td>
        </tr>
        <tr>
            <td style="padding:0px;">
                <input type="button" style="text-align:right;width:100%" class="btn kh22-b theirbutton" value="{{ phpformatnumber($khr) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="button" class="btn kh22-b" value="KHR" title="{{ $khr_id->id }}">
            </td>
        </tr>
        <tr>
            <td style="padding:0px;">
                <input type="button" style="text-align:right;width:100%" class="btn kh22-b theirbutton" value="{{ phpformatnumber($vnd) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="button" class="btn kh22-b" value="VND" title="{{ $vnd_id->id??'' }}">
            </td>
        </tr>
    </table>
</div>
