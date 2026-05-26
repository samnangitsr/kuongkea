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
<div class="table-responsive">
    <table id="tbl_all_partnerlist" class="table table-bordered kh16" style="">
        <thead style="text-align:center;">
            <tr>
                <th rowspan=2 style="width:75px;">លរ</th>
                <th rowspan=2>ឈ្មោះដៃគូ</th>
                <th colspan=4 style="color:blue;">បើកនៅយើង</th>
                <th colspan=4 style="color:red">បើកនៅគេ</th>
                <th colspan=4>សរុបបញ្ជី</th>
            </tr>
            <tr>
                <th style="color:blue;">ដុល្លា</th>
                <th style="color:blue;">បាត</th>
                <th style="color:blue;">រៀល</th>
                <th style="color:blue;">ដុង</th>
                <th style="color:red;">ដុល្លា</th>
                <th style="color:red;">បាត</th>
                <th style="color:red;">រៀល</th>
                <th style="color:red;">ដុង</th>
                <th style="color:black;">ដុល្លា</th>
                <th style="color:black;">បាត</th>
                <th style="color:black;">រៀល</th>
                <th style="color:black;">ដុង</th>
            </tr>
        </thead>
        <tbody>
            @php
                $usd=0;
                $thb=0;
                $khr=0;
                $vnd=0;

            @endphp
            @foreach ($allpartnerlists as $key=>$d)

                <tr class="rowdetail">
                    <td style="text-align:center;">{{ ++$key }}</td>
                    <td>{{ $d->customer->name?$d->customer->name:'លុយសល់មិនទាន់បើក' }}</td>
                    <td style="text-align:right;color:blue;">{{ phpformatnumber($d->usd) . '$'}}</td>
                    <td style="text-align:right;color:blue;">{{ phpformatnumber($d->thb) .'B'}}</td>
                    <td style="text-align:right;color:blue;">{{ phpformatnumber($d->khr) .'R'}}</td>
                    <td style="text-align:right;color:blue;">{{ phpformatnumber($d->vnd) .'V'}}</td>
                    <td style="text-align:right;color:red;">{{ phpformatnumber($d->usd1) . '$'}}</td>
                    <td style="text-align:right;color:red;">{{ phpformatnumber($d->thb1) .'B'}}</td>
                    <td style="text-align:right;color:red;">{{ phpformatnumber($d->khr1) .'R'}}</td>
                    <td style="text-align:right;color:red;">{{ phpformatnumber($d->vnd1) .'V'}}</td>
                    <td style="text-align:right;color:black;">{{ phpformatnumber($d->usd+$d->usd1) . '$'}}</td>
                    <td style="text-align:right;color:black;">{{ phpformatnumber($d->thb+$d->thb1) .'B'}}</td>
                    <td style="text-align:right;color:black;">{{ phpformatnumber($d->khr+$d->khr1) .'R'}}</td>
                    <td style="text-align:right;color:black;">{{ phpformatnumber($d->vnd+$d->vnd1) .'V'}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-title">
                <h1 class="kh22-b" style="text-align:center;">មុនទូទាត់</h1>
            </div>
            <div class="card-body" style="padding:0px;">
                <div class="row">
                    <div class="col-lg-6">


                        <table class="table table-bordered tbl_total kh16-b">
                            <tr style="background-color:azure">
                                <td class="kh16" style="text-align:center">សរុបបើកនៅខាងយើង</td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($totalwe->tusd) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($totalwe->tbat) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($totalwe->tkhr) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($totalwe->tvnd) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">


                        <table class="table table-bordered tbl_total kh16-b">
                            <tr style="background-color:azure">
                                <td class="kh16" style="text-align:center">សរុបបើកនៅខាងគេ</td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($totalthey->tusd1) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($totalthey->tbat1) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($totalthey->tkhr1) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($totalthey->tvnd1) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-title">
                <h1 class="kh22-b" style="text-align:center;">ក្រោយទូទាត់</h1>
            </div>
            <div class="card-body" style="padding:0px;">
                <div class="row">
                    <div class="col-lg-6">
                        @php
                            $usd1=0;
                            $thb1=0;
                            $khr1=0;
                            $vnd1=0;
                            $usd2=0;
                            $thb2=0;
                            $khr2=0;
                            $vnd2=0;
                            $lasttotal->usd<0?$usd1=$lasttotal->usd:$usd2=$lasttotal->usd;
                            $lasttotal->thb<0?$thb1=$lasttotal->thb:$thb2=$lasttotal->thb;
                            $lasttotal->khr<0?$khr1=$lasttotal->khr:$khr2=$lasttotal->khr;
                            $lasttotal->vnd<0?$vnd1=$lasttotal->vnd:$vnd2=$lasttotal->vnd;
                        @endphp

                        <table class="table table-bordered tbl_total kh16-b">
                            <tr style="background-color:azure">
                                <td class="kh16" style="text-align:center">នៅខ្វះខាងយើង</td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($usd1) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($thb1) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($khr1) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($vnd1) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">


                        <table class="table table-bordered tbl_total kh16-b">
                            <tr style="background-color:azure">
                                <td class="kh16" style="text-align:center">នៅខ្វះខាងគេ</td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($usd2) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($thb2) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($khr2) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($vnd2) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


