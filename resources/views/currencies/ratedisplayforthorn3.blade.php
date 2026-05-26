
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
  <div class="row" id="displayrate" style="margin:20px;">
        <div class="col-lg-6 col-md-12 col-sm-12" style="">
            <div id="divcol1" class="row" style="margin-left:0px;">
                <div class="card" style="background-color:rgb(121, 208, 230)">
                    <div class="card-body">
                        <table class="table" style="margin:0px;">
                            <tr style="background-color:rgb(121, 208, 230);">
                                <td style="width:25%;border-style:none;">
                                    <img style="width:200px;" src="{{ config('helper.asset_path').'/logo/' . 'ksplogo.png'  }}" />
                                </td>
                                <td style="text-align:center;border-style:none;color:green;">
                                    <div class="mainshortcut">

                                        <div class="" style="font-family:khmer os muol light;font-size:52px;font-weight:bold;">
                                            អត្រាប្តូរប្រាក់
                                        </div>
                                        <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:42px;font-weight:bold;margin-top:0px;">
                                           Exchange Rate
                                        </div>
                                    </div>

                                </td>
                                <td style="width:25%;border-style:none;font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;text-align:right;">

                                    <div class="mainshortcut">
                                        <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;margin-top:73px;">
                                            {{ date('d-m-Y',strtotime($updated_at))  }}
                                        </div>
                                        <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;margin-top:-20px;">
                                            {{ date('h:i:s',strtotime($updated_at))  }}

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered"  style="width:100%;background-color:whitesmoke;">

                            <tbody>


                                <tr style="">

                                    <td class="" style="text-align:center;">
                                        <div class="mainshortcut">

                                            <div class="" style="font-family:khmer os muol light;font-size:52px;">
                                                រូបិយប័ណ្ណ
                                            </div>
                                            <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;margin-top:-20px;color:rgb(184, 157, 9);">
                                                Currency
                                            </div>
                                        </div>
                                    </td>
                                     <td class="" style="text-align:center;">
                                        <div class="mainshortcut">

                                            <div class="" style="font-family:khmer os muol light;font-size:52px;">
                                                ទិញ
                                            </div>
                                            <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;margin-top:-20px;color:rgb(184, 157, 9);">
                                                Bid
                                            </div>
                                        </div>
                                    </td>
                                      <td class="" style="text-align:center;border-right:1px solid silver;">
                                        <div class="mainshortcut">

                                            <div class="" style="font-family:khmer os muol light;font-size:52px;">
                                                លក់
                                            </div>
                                            <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;margin-top:-20px;color:rgb(184, 157, 9);">
                                                Ask
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr style="border:1px solid grey;">

                                    <td class="bc12" style="color:black;">
                                        <div class="mainshortcut">
                                            <div class="circular--landscapekhr" style=""> <img style="margin-left:-50px;" src="{{ config('helper.asset_path').'/logo/' . 'thb-khr1.png'}}" /> </div>
                                            <div class="khshortcut">
                                                បាត-រៀល
                                            </div>
                                            <div class="enshortcut">
                                                THB-KHR
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bc3" style="color:blue;text-align:center;">
                                        <div class="relativeamt" style="padding-right:20px;">
                                            {{ phpformatnumber($thai_khr->buy??0) }}
                                        </div>
                                    </td>
                                    <td class="bc4" style="color:red;text-align:center;">
                                        <div class="relativeamt" style="padding-right:20px;">
                                            {{ phpformatnumber($thai_khr->sale??0) }}
                                        </div>
                                    </td>
                                </tr>
                                <tr style="border:1px solid grey;">

                                    <td class="bc12" style="color:black;">
                                        <div class="mainshortcut">
                                            <div class="imgflag">
                                                <div class="circular--landscape"> <img style="margin-left:-20px;" src="{{ config('helper.asset_path').'/logo/' . 'usd-thb.png'}}" /> </div>
                                            </div>
                                            <div class="khshortcut">
                                                ដុល្លា-បាត
                                            </div>
                                            <div class="enshortcut">
                                                USD-THB
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bc3" style="color:blue;text-align:center;">
                                        <div class="relativeamt" style="padding-right:20px;">
                                            {{-- {{ number_format($thai_usd->buy,2,'.','') }} --}}
                                            {{ number_format($thai_usd->sale??0,2,'.','') }}
                                        </div>
                                    </td>

                                    <td class="bc4" style="color:red;text-align:center;">
                                        <div class="relativeamt" style="padding-right:20px;">
                                            {{-- {{ number_format($thai_usd->sale,2,'.','') }} --}}
                                            {{ number_format($thai_usd->buy??0,2,'.','') }}
                                        </div>
                                    </td>
                                </tr>

                                <tr style="border:1px solid grey;">

                                    <td class="bc12" style="color:black;">
                                        <div class="mainshortcut">
                                            <div class="circular--landscapekhr"> <img src="{{config('helper.asset_path').'/logo/' . 'usd-khr.png'}}" /> </div>
                                            <div class="khshortcut">
                                                ដុល្លា-រៀល
                                            </div>
                                            <div class="enshortcut">
                                                USD-KHR
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bc3" style="color:blue;text-align:center;">
                                        <div class="relativeamt" style="padding-right:20px;">
                                            {{ phpformatnumber($thai_usd_khr->buy??0) }}
                                        </div>
                                    </td>
                                    <td class="bc4" style="color:red;text-align:center;">
                                        <div class="relativeamt" style="padding-right:20px;">
                                            {{ phpformatnumber($thai_usd_khr->sale??0) }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                         <table class="table" style="margin-top:-10px;">
                            <tr style="background-color:rgb(121, 208, 230);">
                                <td style="font-family:khmer os muol light; font-size:42px;padding-top:50px;border-style:none;">
                                    ទំនាក់ទំនង៖
                                    <span style="font-family:Arial, Helvetica, sans-serif;font-size:42px;font-weight:bold;">{{ $company->tel }}</span> <br>
                                    <span class="kh32">
                                        {{ $company->note_text??'ចំណាំ៖អត្រាប្តូរប្រាក់ខាងលើនិងមានការផ្លាស់ប្តូរដោយពុំចាំបាច់ផ្តល់ដំណឹងជូនមុន។' }}

                                    </span>
                                </td>
                                <td rowspan=2 style="text-align:right;border-style:none;">
                                    <img style=" width:200px;" src="{{ config('helper.asset_path').'/logo/' . $company->qrlogo  }}" />
                                </td>
                            </tr>
                            <tr style="background-color:rgb(121, 208, 230);">
                                <td colspan=2 style="border-style:none;margin-top:-25px;" class="kh22-b">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <div id="divcol1" class="row" style="margin-left:0px;">
                <div class="card" style="background-color:#ffe699">
                    <div class="card-body">
                        <table class="table" style="margin:0px;">
                            <tr style="background-color:#ffe699;">
                                <td style="width:25%;border-style:none;">
                                    <img style="width:200px;" src="{{ config('helper.asset_path').'/logo/' . 'ksp.png'  }}" />
                                </td>
                                <td style="text-align:center;border-style:none;color:green;">
                                    <div class="mainshortcut">

                                        <div class="" style="font-family:khmer os muol light;font-size:52px;font-weight:bold;">
                                            អត្រាប្តូរប្រាក់
                                        </div>
                                        <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:42px;font-weight:bold;margin-top:0px;">
                                            Exchange Rate
                                        </div>
                                    </div>

                                </td>
                                <td style="width:25%;border-style:none;font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;text-align:right;">

                                    <div class="mainshortcut">
                                        <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;margin-top:73px;">
                                            {{ date('d-m-Y',strtotime($updated_at))  }}
                                        </div>
                                        <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;margin-top:-20px;">
                                            {{ date('h:i:s',strtotime($updated_at))  }}

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered"  style="width:100%;background-color:whitesmoke;">
                            <tbody>
                                <tr style="">

                                    <td class="" style="text-align:center;">
                                        <div class="mainshortcut">

                                            <div class="" style="font-family:khmer os muol light;font-size:52px;">
                                                រូបិយប័ណ្ណ
                                            </div>
                                            <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;margin-top:-20px;color:rgb(184, 157, 9);">
                                                Currency
                                            </div>
                                        </div>
                                    </td>
                                        <td class="" style="text-align:center;">
                                        <div class="mainshortcut">

                                            <div class="" style="font-family:khmer os muol light;font-size:52px;">
                                                ទិញ
                                            </div>
                                            <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;margin-top:-20px;color:rgb(184, 157, 9);">
                                                Bid
                                            </div>
                                        </div>
                                    </td>
                                        <td class="" style="text-align:center;">
                                        <div class="mainshortcut">

                                            <div class="" style="font-family:khmer os muol light;font-size:52px;">
                                                លក់
                                            </div>
                                            <div class="" style="font-family:Arial, Helvetica, sans-serif;font-size:36px;font-weight:bold;margin-top:-20px;color:rgb(184, 157, 9);">
                                                Ask
                                            </div>
                                        </div>
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
                                                @if($c1->ispandp==1)

                                                    <div class="khshortcut">
                                                         {{ $c1->curname }}
                                                    </div>
                                                     <div class="enshortcut">
                                                        {{$c1->shortcut}}
                                                    </div>

                                                @else
                                                    <div class="khshortcut">
                                                        {{ 'ដុល្លា-' .$c1->curname }}
                                                    </div>
                                                    <div class="enshortcut">
                                                        {{ 'USD-' . $c1->shortcut }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        @if($c1->ispandp==1)
                                            <td class="bc4" style="color:blue;text-align:center;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ number_format($c1->buy,$c1->decpoint,'.','') }}
                                                </div>
                                            </td>
                                            <td class="bc3" style="color:red;text-align:center;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ number_format($c1->sale,$c1->decpoint,'.','') }}
                                                </div>
                                            </td>
                                        @else
                                            <td class="bc4" style="color:blue;text-align:center;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ number_format($c1->sale,$c1->decpoint,'.','') }}
                                                </div>
                                            </td>
                                            <td class="bc3" style="color:red;text-align:center;">
                                                <div class="relativeamt" style="padding-right:20px;">
                                                    {{ number_format($c1->buy,$c1->decpoint,'.','') }}
                                                </div>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                         <table class="table" style="margin-top:-10px;">
                            <tr style="background-color:#ffe699;">
                                <td style="font-family:khmer os muol light; font-size:42px;padding-top:50px;border-style:none;">
                                    ទំនាក់ទំនង៖
                                    <span style="font-family:Arial, Helvetica, sans-serif;font-size:42px;font-weight:bold;">{{ $company->tel }}</span> <br>
                                    <span class="kh32">
                                        {{ $company->note_text??'ចំណាំ៖អត្រាប្តូរប្រាក់ខាងលើនិងមានការផ្លាស់ប្តូរដោយពុំចាំបាច់ផ្តល់ដំណឹងជូនមុន។' }}

                                    </span>
                                </td>
                                <td rowspan=2 style="text-align:right;border-style:none;">
                                    <img style=" width:200px;" src="{{ config('helper.asset_path').'/logo/' . $company->qrlogo  }}" />
                                </td>
                            </tr>
                            <tr style="background-color:#ffe699;">
                                <td colspan=2 style="border-style:none;margin-top:-25px;" class="kh22-b">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
