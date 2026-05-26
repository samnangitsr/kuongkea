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
<div class="col-lg-12">

    <table id="tbl1" class="table table-bordered">

        @foreach ($total_list as $tl)
            @php
                if($tl->cur=='USD'){
                    $usd=$tl->total;
                }elseif($tl->cur=='THB'){
                    $thb=$tl->total;
                }elseif($tl->cur=='KHR'){
                    $khr=$tl->total;
                }elseif($tl->cur=='VND'){
                    $vnd=$tl->total;
                }
            @endphp

        @endforeach
        <tr>
            <td class="kh22" style="width:500px;">
                @if($usd<0)
                    ខ្វះ {{ $logo->name }}
                @elseif($usd>0)
                    ខ្វះ {{ $partnername }}
                @endif
            </td>
            <td style="padding:0px;">
                <input type="text" style="text-align:right;width:100%;border-style:none;@if($usd<0) color:blue; @else color:red; @endif" class="form-control kh22-b closeamt" name="close_usd" value="{{ phpformatnumber($usd) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="text" style="border-style:none;@if($usd<0) color:blue; @else color:red; @endif" class="form-control kh22-b" value="USD" readonly>
            </td>
        </tr>
        <tr>
            <td class="kh22" style="width:500px;">
                @if($thb<0)
                    ខ្វះ {{ $logo->name }}
                @elseif($thb>0)
                    ខ្វះ {{ $partnername }}
                @endif
            </td>
            <td style="padding:0px;">
                <input type="text" style="text-align:right;width:100%;border-style:none;@if($thb<0) color:blue; @else color:red; @endif" class="form-control kh22-b closeamt" name="close_thb" value="{{ phpformatnumber($thb) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="text" style="border-style:none;@if($thb<0) color:blue; @else color:red; @endif" class="form-control kh22-b" value="THB" readonly>
            </td>
        </tr>
        <tr>
            <td class="kh22" style="width:500px;">
                @if($khr<0)
                    ខ្វះ {{ $logo->name }}
                @elseif($khr>0)
                    ខ្វះ {{ $partnername }}
                @endif
            </td>
            <td style="padding:0px;">
                <input type="text" style="text-align:right;width:100%;border-style:none;@if($khr<0) color:blue; @else color:red; @endif" class="form-control kh22-b closeamt" name="close_khr" value="{{ phpformatnumber($khr) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="text" style="border-style:none;@if($khr<0) color:blue; @else color:red; @endif" class="form-control kh22-b" value="KHR" readonly>
            </td>
        </tr>
        <tr>
            <td class="kh22" style="width:500px;">
                @if($vnd<0)
                    ខ្វះ {{ $logo->name }}
                @elseif($vnd>0)
                    ខ្វះ {{ $partnername }}
                @endif
            </td>
            <td style="padding:0px;">
                <input type="text" style="text-align:right;width:100%;border-style:none;@if($vnd<0) color:blue; @else color:red; @endif" class="form-control kh22-b closeamt" name="close_vnd" value="{{ phpformatnumber($vnd) }}">
            </td>
            <td style="padding:0px;width:100px;">
                <input style="width:100px;" type="text" style="border-style:none;@if($vnd<0) color:blue; @else color:red; @endif" class="form-control kh22-b" value="VND" readonly>
            </td>
        </tr>
    </table>
</div>


<script>
     $('.closeamt').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
</script>

