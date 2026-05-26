
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
<div id="divheader" class="row">
    <div class="col-lg-4">
        <div class="row">
            <div id="divtitle" style="text-align:center;
            font-family:'Khmer Os Muol light', sans-serif;
            padding:20px;
            overflow:hidden;">
                <h1 id="companyname" style="font-size:56px;">{{ $company->name1 }}</h1>
            </div>
            <div class="row">
                <div class="relative_phone">
                    <h1 id='currentdate'>{{ date('d-m-Y h:i:s A',strtotime($maxdate)) }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="relative_phone">
                    <h1>{{ $company->tel }}</h1>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="divheader1" class="row">
    <div class="col-lg-4 col-md-12 col-sm-12">
       <div id="hd1" class="row" style="padding:0px;">
           <table class="table" style="width:100%">
               <thead>
                   <th class="thd"> រូបិយប័ណ្ណ </th>
                   <th class="thd" style="color:red;">  ទិញ/BUY </th>
                   <th class="thd" style="color:blue;">  លក់/SELL </th>

               </thead>
           </table>
       </div>
    </div>

</div>

    <div class="row" id="displayrate">
        <div class="col-lg-4 col-md-12 col-sm-12">

            <div id="divcol1" class="row" style="margin-left:0px;">
                <div class="card" style="overflow:auto;padding:0px;margin:0px;">
                    <div class="card-body" style="padding:0px;">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped"  style="width:100%;">

                                    <tbody>
                                        <tr style="background-color:rgb(217, 157, 37)">

                                            <td class="thaibank" colspan=3>

                                                    {{-- <img src="{{ config('helper.asset_path').'/logo' . '/banklogo1.png' }}" alt="" style="width:100px;border-radius: 50%;" class=""> --}}

                                                    ធនាគាថៃ/THAI BANK

                                                    {{-- <img src="{{ config('helper.asset_path').'/logo' . '/banklogo1.png' }}" alt="" style="width:100px;border-radius: 50%;" class=""> --}}

                                            </td>

                                        </tr>

                                        <tr style="background-color:rgb(217, 157, 37)">

                                            <td class="bc12" style="color:white;">
                                                <div class="mainshortcut">
                                                    <div class="imgflag">
                                                        <div class="circular--landscape"> <img src="{{ config('helper.asset_path').'/logo' . '/usd.png'}}" /> </div>
                                                    </div>
                                                    <div class="khshortcut">
                                                        ដុល្លា
                                                    </div>
                                                    <div class="enshortcut">
                                                        USD
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="bc3" style="color:white;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ number_format($thai_usd->buy,2,'.','') }}
                                                </div>
                                            </td>

                                            <td class="bc4" style="color:white;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ number_format($thai_usd->sale,2,'.','') }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="background-color:rgb(217, 157, 37)">

                                            <td class="bc12" style="color:white;">
                                                <div class="mainshortcut">
                                                    <div class="circular--landscapekhr"> <img src="{{ config('helper.asset_path').'/logo' . '/khmer.png'}}" /> </div>
                                                    <div class="khshortcut">
                                                        រៀល
                                                    </div>
                                                    <div class="enshortcut">
                                                        KHR
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="bc3" style="color:white;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ phpformatnumber($thai_khr->buy) }}
                                                </div>
                                            </td>
                                            <td class="bc4" style="color:white;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ phpformatnumber($thai_khr->sale) }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="background-color:rgb(217, 157, 37)">

                                            <td class="bc12" style="color:white;">
                                                <div class="mainshortcut">
                                                    <div class="circular--landscapekhr"> <img src="{{ config('helper.asset_path').'/logo' . '/khmer.png'}}" /> </div>
                                                    <div class="khshortcut">
                                                        ដុល្លា-រៀល
                                                    </div>
                                                    <div class="enshortcut">
                                                        USD-KHR
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="bc3" style="color:white;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ phpformatnumber($thai_usd_khr->buy) }}
                                                </div>
                                            </td>
                                            <td class="bc4" style="color:white;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ phpformatnumber($thai_usd_khr->sale) }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan=3 class="thd1">
                                                សាច់ប្រាក់នៅភ្នំពេញ/CASH AT PHNOM PENH
                                            </td>

                                        </tr>

                                        @foreach ($cur1 as $c1)
                                        <tr style="">


                                            <td class="bc12">
                                                <div class="mainshortcut">
                                                    <div class="imgflag">
                                                        <div class="circular--landscape">
                                                            <img style=" width: auto; height: 100%; margin-left:{{ $c1->imglocation . 'px' }};"
                                                                src="{{ config('helper.asset_path').'/myimages/' . $c1->imgpath }}" />
                                                        </div>
                                                    </div>
                                                    <div class="khshortcut">
                                                        {{ $c1->curname }}
                                                    </div>
                                                    <div class="enshortcut">
                                                        {{ $c1->shortcut }}
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="bc3" style="color:red;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ number_format($c1->buy,$c1->decpoint,'.','') }}
                                                </div>
                                            </td>

                                            <td class="bc4" style="color:blue;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ number_format($c1->sale,$c1->decpoint,'.','') }}
                                                </div>
                                            </td>
                                        </tr>

                                        @endforeach

                                        <tr style="background-color: rgb(4, 44, 79);">
                                            <td colspan=2 class="bc12" style="padding:25px;border-style:none;color:white;">
                                                <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> ប្តូរប្រាក់រូបិយប័ណ្ណបរទេស</span>
                                            </td>
                                            <td rowspan=5 style="text-align:center;">
                                                <div style="margin:25px;">
                                                    <img src="{{ config('helper.asset_path').'/logo' . '/chivra4.png' }}" alt="" style="width:200px;" class="">
                                                </div>
                                                <div style="margin:25px;">
                                                    <img src="{{ config('helper.asset_path').'/logo' . '/chivra5.png' }}" alt="" style="width:200px;" class="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="background-color: rgb(4, 44, 79);">
                                            <td colspan=2 class="bc12" style="padding:25px;border-style:none;color:white;">
                                                <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> វេរលុយទៅកុងធនាគាថៃ វៀតណាម​ និងវីង</span>
                                            </td>
                                        </tr>
                                        <tr style="background-color: rgb(4, 44, 79);">
                                            <td colspan=2 class="bc12" style="padding:25px;border-style:none;color:white;">
                                                <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> វេរលុយគ្រប់ខេត្តក្រុង</span>
                                            </td>
                                        </tr>
                                        {{-- <tr style="background-color: rgb(4, 44, 79);">
                                            <td colspan=2 class="bc12" style="padding:25px;border-style:none;color:white;">
                                                <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> ប្តូរប្រាក់ពុក រហែក ប្រឡាក់</span>
                                            </td>
                                        </tr> --}}
                                        <tr style="background-color: rgb(4, 44, 79);">
                                            <td colspan=2 class="bc12" style="padding:25px;border-style:none;color:white;">
                                                <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> ទទួលបង់ពន្ធជំនួស</span>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>


                    </div>
                </div>
            </div>
        </div>

    </div>









