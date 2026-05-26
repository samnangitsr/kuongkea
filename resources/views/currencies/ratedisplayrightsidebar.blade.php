

<style>
    .amt{
        font-size:16px;
        text-align:right;
        font-weight:bold;
    }
    .title{
        font-family:'Noto Sans Khmer';
        font-size:16px;
        text-align:center;
        font-weight:bold;
    }
    .curname{
        font-family:'Noto Sans Khmer';
        font-size:16px;
        font-weight:bold;
    }
    .hd{
        font-family:'Noto Sans Khmer';
        font-size:14px;
        text-align:center;
        font-weight:bold;
    }

</style>

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
<body id="myrate">



    <div id="hd1" class="row" style="padding:0px;">
        <table class="table table-bordered" style="width:100%">
            <thead style="font-famil:'Noto Sans Khmer', sans-serif;">
                <th class="hd"> រូបិយប័ណ្ណ </th>
                <th class="hd">  ទិញ/BUY </th>
                <th class="hd">  លក់/SELL </th>

            </thead>
            <tbody>
                <tr style="background-color:rgb(217, 157, 37)">
                    <td class="title" colspan=3>
                        ធនាគាថៃ/THAI BANK
                    </td>
                </tr>
                <tr style="background-color:rgb(217, 157, 37)">
                    <td class="curname">ដុល្លា</td>
                    <td class="amt" style="color:white;">
                        {{ number_format($thai_usd->buy,2,'.','') }}
                    </td>

                    <td class="amt" style="color:white;">
                        {{ number_format($thai_usd->sale,2,'.','') }}
                    </td>

                </tr>
                <tr style="background-color:rgb(217, 157, 37)">

                    <td class="curname">រៀល</td>
                    <td class="amt" style="color:white;">
                        {{ phpformatnumber($thai_khr->buy) }}
                    </td>
                    <td class="amt" style="color:white;">
                        {{ phpformatnumber($thai_khr->sale) }}
                    </td>
                </tr>
                <tr>
                    <td colspan=3 class="title">
                        អត្រាប្តូរប្រាក់មុខផ្ទះ
                    </td>
                </tr>
                @foreach ($cur1 as $c1)
                <tr>
                    <td class="curname">{{ $c1->curname }}</td>
                    <td class="amt" style="color:red;">
                        {{ number_format($c1->buy,$c1->decpoint,'.','') }}
                    </td>
                    <td class="amt" style="color:blue;">
                        {{ number_format($c1->sale,$c1->decpoint,'.','') }}
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
    </div>



</body>
