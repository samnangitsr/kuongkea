
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
        <div class="col-lg-6">
            <div class="row">
                <div id="divtitle" style="position: relative;
                left: 100px;
                top:10px;
                font-family:'Khmer Os Muol light', sans-serif;
                padding:20px;
                overflow:hidden;">
                    <h1 id="companyname" style="font-size:56px;">{{ $company->name1 }}</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
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
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div id="hd2" class="row" style="padding:0px;">
                <table class="table" style="width:100%">
                    <thead>
                        <th class="thd"> រូបិយប័ណ្ណ </th>
                        <th class="thd" style="color:red;">  ទិញ/BUY </th>
                        <th class="thd" style="color:blue;">  លក់/SELL </th>
                    </thead>
                </table>
            </div>
         </div>
         <div class="col-lg-4 col-md-12 col-sm-12">
            <div id="hd3" class="row" style="padding:0px;">
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
                                    {{-- <thead>
                                        <th class="thd"> រូបិយប័ណ្ណ </th>
                                        <th class="thd" style="color:red;">  ទិញ/BUY </th>
                                        <th class="thd" style="color:blue;">  លក់/SELL </th>

                                    </thead> --}}
                                    <tbody>
                                        <tr style="background-color:rgb(217, 157, 37)">

                                            <td class="thaibank" colspan=3>

                                                    {{-- <img src="{{ asset('public/logo') . '/banklogo1.png' }}" alt="" style="width:100px;border-radius: 50%;" class=""> --}}

                                                    ធនាគាថៃ/THAI BANK

                                                    {{-- <img src="{{ asset('public/logo') . '/banklogo1.png' }}" alt="" style="width:100px;border-radius: 50%;" class=""> --}}

                                            </td>

                                        </tr>

                                        <tr style="background-color:rgb(217, 157, 37)">

                                            <td class="bc12" style="color:white;">
                                                <div class="mainshortcut">
                                                    <div class="imgflag">
                                                        <div class="circular--landscape"> <img src="{{ asset('public/logo') . '/usd.png'}}" /> </div>
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
                                                    <div class="circular--landscapekhr"> <img src="{{ asset('public/logo') . '/khmer.png'}}" /> </div>
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
                                        <tr>
                                            <td colspan=3 class="thd1">
                                                សាច់ប្រាក់នៅភ្នំពេញ/CASH AT PHNOM PENH
                                            </td>

                                        </tr>

                                        @foreach ($cur1 as $c1)
                                        <tr>


                                            <td class="bc12">
                                                <div class="mainshortcut">
                                                    <div class="imgflag">
                                                        <div class="circular--landscape">
                                                            <img style=" width: auto; height: 100%; margin-left:{{ $c1->imglocation . 'px' }};"
                                                                src="{{ asset('public/myimages') . '/' . $c1->imgpath }}" />
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
                                    </tbody>
                                </table>
                            </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div id="divcol2" class="row">
                <div class="card" style="overflow:auto;padding:0px;margin:0px;">
                    <div class="card-body" style="padding:0px;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped1" style="width:100%;">
                                {{-- <thead>
                                    <th class="thd"> រូបិយប័ណ្ណ </th>
                                    <th class="thd" style="color:red;">  ទិញ/BUY </th>
                                    <th class="thd" style="color:blue;">  លក់/SELL </th>

                                </thead> --}}
                                @foreach ($cur2 as $c2)

                                <tr>
                                    {{-- <td class="bc1" style="">

                                    </td> --}}
                                    <td class="bc12" style="">
                                        <div class="mainshortcut">
                                            <div class="imgflag">
                                                <div class="circular--landscape">
                                                    <img style=" width: auto; height: 100%; margin-left:{{ $c2->imglocation . 'px' }};"
                                                        src="{{ asset('public/myimages') . '/' . $c2->imgpath }}" />
                                                </div>
                                            </div>
                                            <div class="khshortcut">
                                                {{ $c2->curname }}
                                            </div>
                                            <div class="enshortcut">
                                                {{ $c2->shortcut }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bc3" style="">
                                        <div class="relativeamt" style="padding-right:20px;">
                                            {{ number_format($c2->buy,$c2->decpoint,'.','') }}
                                        </div>
                                    </td>

                                    <td class="bc4" style="">
                                        <div class="relativeamt" style="padding-right:20px;">
                                            {{ number_format($c2->sale,$c2->decpoint,'.','') }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div id="divcol3" class="row" style="margin-right:0px;">
                <div class="card" style="overflow:auto;padding:0px;margin:0px;">
                    <div class="card-body" style="padding:0px;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped2"  style="width:100%;">

                                    {{-- <thead>
                                        <th class="thd"> រូបិយប័ណ្ណ </th>
                                        <th class="thd" style="color:red;">  ទិញ/BUY </th>
                                        <th class="thd" style="color:blue;">  លក់/SELL </th>

                                    </thead> --}}


                                @foreach ($cur3 as $c3)
                                <tr>
                                    {{-- <td class="bc1" style="">
                                        <div class="circular--landscape">
                                            <img style=" width: auto; height: 100%; margin-left:{{ $c3->imglocation . 'px' }};"
                                                src="{{ asset('public/myimages') . '/' . $c3->imgpath }}" />
                                        </div>
                                    </td> --}}
                                    <td class="bc12" style="">
                                        <div class="mainshortcut">
                                            <div class="imgflag">
                                                <div class="circular--landscape">
                                                    <img style=" width: auto; height: 100%; margin-left:{{ $c3->imglocation . 'px' }};"
                                                        src="{{ asset('public/myimages') . '/' . $c3->imgpath }}" />
                                                </div>
                                            </div>
                                            <div class="khshortcut">
                                                {{ $c3->curname }}
                                            </div>
                                            <div class="enshortcut">
                                                {{ $c3->shortcut }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bc3" style="">
                                        <div class="relativeamt" style="padding-right:20px;">
                                            {{ number_format($c3->buy,$c3->decpoint,'.','') }}
                                        </div>
                                    </td>

                                    <td class="bc4" style="">
                                        <div class="relativeamt" style="padding-right:20px;">
                                            {{ number_format($c3->sale,$c3->decpoint,'.','') }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row" id="divfooter">
        <div class="table-responsive" style="">
            <table class="table" style="">
                <tr>
                    <td style="padding:10px 0px 0px 20px;border-style:none;color:white;">
                        <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> វេរលុយទៅកុងធនាគាថៃ វៀតណាម​ និងវីង</span>
                    </td>
                    <td class="qrfooter" rowspan=2 style="">
                        <div class="qrcode">
                            <img src="{{ asset('public/logo') . '/chivra2.png' }}" alt="" style="width:100px;" class="">
                        </div>
                        <div class="qrcode">
                            <img src="{{ asset('public/logo') . '/chivraqr1.jpg' }}" alt="" style="width:100px;" class="">
                        </div>
                        <div class="qrcode">
                            <img src="{{ asset('public/logo') . '/chivra3.jpg' }}" alt="" style="width:100px;" class="">
                        </div>
                    </td>

                </tr>
                <tr>
                    <td style="padding:0px 0px 0px 20px;border-style:none;color:white;">
                        <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> ទទួលបង់ពន្ធជំនួស</span>
                        <span id="textfooter" style="margin-left:25px;">
                            <i style="color:gold;" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> ប្តូរប្រាក់ពុក រហែក ប្រឡាក់</span>
                        </span>

                    </td>
                </tr>
            </table>
        </div>
    </div>








