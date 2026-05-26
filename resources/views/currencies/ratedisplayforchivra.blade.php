<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=0.55, maximum-scale=1, user-scalable=no">
    {{-- <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no"> --}}
    <title>56 Exchange Rate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<style>
    /* img {
  border-radius: 50%;
} */

.circular--landscape { display: inline-block; position: relative; width: 100px; height: 100px; overflow: hidden; border-radius: 50%; }
.circular--landscape img { width: auto; height: 100%; margin-left: -50px; }

.circular--logo { display: inline-block; position: relative; width: 60px; height: 60px; overflow: hidden; border-radius: 50%; }
.circular--logo img { width: auto; height: 100%; margin-left: 0px; }

.circular--landscape200 { display: inline-block; position: relative; width: 200px; height: 200px; overflow: hidden; border-radius: 50%; }
.circular--landscape200 img { width: auto; height: 100%; margin-left: -100px; }

.circular--landscapekhr { display: inline-block; position: relative; width: 100px; height: 100px; overflow: hidden; border-radius: 50%; }
.circular--landscapekhr img {
    width: auto;
    height: 100%;
    margin-left: -28px;

    }

.circular_image {
  width: 200px;
  height: 200px;
  border-radius: 50%;
  overflow: hidden;
  background-color: blue;
  /* commented for demo
  float: left;
  margin-left: 125px;
  margin-top: 20px;
  */

  /*for demo*/
  display:inline-block;
  vertical-align:middle;
}
.circular_image img{
  width:100%;
}
div.relative_phone {
  position: relative;
  float: right;
  top:15px;
  text-align:right;

  /* border: 3px solid #73AD21; */
}
.relative_title {
  position: relative;
  left: 100px;
  top:10px;
  font-family:'Khmer Os Muol light', sans-serif;
  padding:20px;
  overflow:hidden;
  /* border: 3px solid #73AD21; */
}
.mainshortcut{
    position:relative;
}
.khshortcut{
    position:absolute;
    top:0px;
    left:110px;
    font-family:'Noto Sans Khmer', sans-serif;
    font-weight:bold;
    font-size:40px;

}
.enshortcut{
    position:absolute;
    top:50px;
    left:110px;
    font-weight:bold;
    font-size:30px;
}
div.relative {
  position: relative;
  left: 0px;
  top:30px;
  padding:0px;
  font-size:60px;
  /* border: 3px solid #73AD21; */
}
div.relative1 {
  position: relative;
  left: 0px;
  top:-20px;
  padding:0px;
  font-size:40px;
  /* border: 3px solid #73AD21; */
}
div.relativeamt {
  position: relative;
  left: 0px;
  top:0px;
  font-size:66px;
  display:inline;
  /* border: 3px solid #73AD21; */
}
.qrfooter{
    padding:10px;0px 0px 0px;
    text-align:right;
    border-style:none;
    color:white;
    position:relative;
    right:0px;
}
.falgcounter{
    display:block;

}
.kh16{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:16px;
    }
.kh16-b{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:16px;
    font-weight:bold;
}
.kh22-b{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:22px;
    font-weight:bold;
    }
.kh22{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:22px;

    }
td.thaibank{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:56px;
    padding:15px 0px 15px 0px;
    text-align:center;
    color:black;
    }
.kh36{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:36px;

    }
.fontfooter{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:36px;
}
th.thd{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:46px;
    font-weight:bold;
    padding:23px 0px 23px 0px;
    text-align:center;
    color:rgb(7, 7, 148);
    background-color:silver;
}
td.thd{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:46px;
    font-weight:bold;
    padding:23px 0px 23px 0px;
    text-align:center;
    color:rgb(7, 7, 148);
    background-color:silver;
    border-style:none;
}
td.thd1{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:36px;
    font-weight:bold;
    padding:15px 0px 15px 0px;
    text-align:center;
    color:black;
    background-color:white;
}

.table-striped>tbody>tr:nth-child(odd)>td.zipbra,
.table-striped>tbody>tr:nth-child(odd)>th {
 background-color: rgb(215, 243, 225);
}

.table-striped>tbody>tr:nth-child(even)>td.zipbra,
.table-striped>tbody>tr:nth-child(even)>th {
 background-color: rgb(239, 240, 221);
}
.table-striped1>tbody>tr:nth-child(odd)>td,
.table-striped1>tbody>tr:nth-child(odd)>th {
 background-color: white;
}

.table-striped1>tbody>tr:nth-child(even)>td,
.table-striped1>tbody>tr:nth-child(even)>th {
 background-color: whitesmoke;
}
.table-striped2>tbody>tr:nth-child(odd)>td,
.table-striped2>tbody>tr:nth-child(odd)>th {
 background-color: white;
}

.table-striped2>tbody>tr:nth-child(even)>td,
.table-striped2>tbody>tr:nth-child(even)>th {
 background-color: whitesmoke;
}

#divfooter{

    color:white;
    margin: auto;
    margin-left:0px;
    margin-right:0px;
    padding-bottom:0px;
    position: fixed;
    bottom: 0;
    width: 100%;
    min-height: 350px;
    max-height: 350px;
    background-color: rgb(4, 44, 79);
    color: white;
    height : 350px;
    overflow:auto;

    clear: both;
}
#displayrate {
  -moz-box-shadow: 1px 1px 2px 0 #d0d0d0;
  -webkit-box-shadow: 1px 1px 2px 0 #d0d0d0;
  box-shadow: 1px 1px 2px 0 #d0d0d0;
  background: #fff;
  border: 1px solid #ccc;
  border-color: #e4e4e4 #bebebd #bebebd #e4e4e4;
  padding: 0px;

  margin-bottom: 10px;
  clear: both;
}

#divheader{
   /* position:sticky;
   top:0;
   z-index:1000; */
    background-color:rgb(4, 44, 79);
    padding:20px 0px 50px 0px;color:white;
    margin:0px;
    width:100%;

}
#divheader1{
   /* position:sticky;
   top:150px; */
   z-index:1;
    background-color:white;
    padding:0px;
    color:white;
    margin:0px;
    width:100%;
    height:115px;
}

td.bc1{
    border-style:solid solid solid solid;
    text-align:right;
    /* padding:0px 0px 0px 20px; */
    width:10%;
}
td.bc12{
    text-align:left;
    border-style:solid none solid none;
    padding:18px 0px 18px 0px;
    width:33.33%;

}
td.bc3{

    padding:18px 0px 18px 0px;
    font-size:40px;
    font-weight:bold;
    text-align:right;
    border:1px solid silver;
    width:33.33%;
    color:red;
}
td.bc4{
    padding:18px 0px 18px 0px;
    font-size:40px;
    font-weight:bold;
    text-align:right;
    border:1px solid silver;
    width:33.33%;
    color:blue;
}

/* ::-webkit-scrollbar {
    display: none;
} */
html {
    overflow: scroll;
    overflow-x: hidden;
}

::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
}
/* optional: show position indicator in red */
::-webkit-scrollbar-thumb {
    background: #e8efee;
}

.qrcode{
    margin-Right:0px;
    display:inline;
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
                    <h1 id='currentdate' style="font-size:26px;">{{ date('d-m-Y h:i:s A',strtotime($maxdate)) }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="relative_phone">
                    <h1 style="font-size:26px;">{{ $company->tel }}</h1>
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
                                            <td colspan=2 class="bc12" style="padding:20px;border-style:none;color:white;">
                                                <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter">យើងខ្ញុំរក្សាសិទ្ធផ្លាស់ប្តូរអត្រាខាងលើ ដោយមិនមានការជូនដំណឹងជាមុនឡើយ<span>
                                            </td>
                                            <td rowspan=2 style="text-align:center;">
                                                <div style="margin:25px;">
                                                    <img src="{{ config('helper.asset_path').'/logo' . '/line.png' }}" alt="" style="width:200px;" class="">
                                                </div>
                                                <div style="margin:25px;">
                                                    <img src="{{ config('helper.asset_path').'/logo' . '/whatapp.png' }}" alt="" style="width:200px;" class="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="background-color: rgb(4, 44, 79);">
                                            <td colspan=2 class="bc12" style="padding:25px;border-style:none;color:white;">
                                                <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> ប្តូរប្រាក់រូបិយប័ណ្ណបរទេស</span>
                                                <br>
                                                 <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter">វេរលុយទៅកុងធនាគាថៃ វៀតណាម​ និងវីង</span>
                                                <br>
                                                <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> ទទួលបង់ពន្ធជំនួស</span>
                                            </td>

                                        </tr>
                                        <!--<tr style="background-color: rgb(4, 44, 79);">-->
                                        <!--    <td colspan=2 class="bc12" style="padding:20px;border-style:none;color:white;">-->
                                        <!--        <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> វេរលុយគ្រប់ខេត្តក្រុង</span>-->
                                        <!--    </td>-->
                                        <!--</tr>-->
                                        <!--<tr style="background-color: rgb(4, 44, 79);">-->
                                        <!--    <td colspan=2 class="bc12" style="padding:20px;border-style:none;color:white;">-->
                                        <!--        <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> ប្តូរប្រាក់ពុក រហែក ប្រឡាក់</span>-->
                                        <!--    </td>-->
                                        <!--</tr>-->
                                        <!--<tr style="background-color: rgb(4, 44, 79);">-->
                                        <!--    <td colspan=2 class="bc12" style="padding:20px;border-style:none;color:white;">-->
                                        <!--        <i style="color:gold" class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><span class="fontfooter"> ទទួលបង់ពន្ធជំនួស</span>-->
                                        <!--    </td>-->
                                        <!--</tr>-->
                                    </tbody>
                                </table>
                            </div>


                    </div>
                </div>
            </div>
        </div>


    </div>


</body>
<script type="text/javascript">


    $(document).ready(function(){
        window.scrollTo(0,0);
        //window.parent.document.body.style.zoom = "50%";
        var h =  window.screen.availHeight
        var w= window.screen.availWidth
        //var sw=screen.width;

        //alert(w + '+' +h)
        // if (w <= 480) {
        //     document.getElementById("viewport").setAttribute("content","initial-scale=0.7, maximum-scale=0.7, user-scalable=0");
        // }
        function checkrefreshpage(){

            //getcurrentdate();
             checkscreenwidth();
             //checkscreenheight();
            var url="{{ route('currency.checkrefreshpage') }}";

            $.get(url,{},function(data){

                if(sumid!=data['maxid'])
                {
                    sumid=data['maxid'];
                    refreshpage();
                }

            })
        }
         checkscreenwidth();
         //checkscreenheight();
        function checkscreenwidth(){

//             if (screen.width <= 480) {
//  document.getElementById("viewport").setAttribute("content", " initial-scale=0.5");
// }
            if(w>=1024){
                var qrcode=document.getElementsByClassName('qrcode');
                 for(i=0; i<qrcode.length; i++) {
                    qrcode[i].style.marginRight='120px';
                    //classamt[i].style.fontFamily="Khmer Os Muol light, sans-serif";
                }
            }
           if(w==1920){
            window.parent.document.body.style.zoom = "75%";

            var thaibank=document.getElementsByClassName('thaibank');
                    for(i=0; i<thaibank.length; i++) {
                        thaibank[i].style.fontSize='56px';
                        //thaibank[i].style.padding='10px 0px 10px 0px';
                        //classamt[i].style.fontFamily="Khmer Os Muol light, sans-serif";
                    }
                    var classbc12=document.getElementsByClassName('bc12');
                     for(i=0; i<classbc12.length; i++) {
                        classbc12[i].style.padding='25px 0px 25px 0px';
                    }
                    var classbc3=document.getElementsByClassName('bc3');
                     for(i=0; i<classbc3.length; i++) {
                        classbc3[i].style.padding='25px 0px 25px 0px';
                    }
                    var classbc4=document.getElementsByClassName('bc4');
                     for(i=0; i<classbc4.length; i++) {
                        classbc4[i].style.padding='25px 0px 25px 0px';
                    }
           }else if(w==1366){
            window.parent.document.body.style.zoom = "50%";

           }else if(w==1600){
            window.parent.document.body.style.zoom = "60%";
           }else{
            window.parent.document.body.style.zoom = "50%";
           }

            if(w>3000){

                //window.parent.document.body.style.zoom = "100%";


                var classamt=document.getElementsByClassName('relativeamt');
                     for(i=0; i<classamt.length; i++) {
                        classamt[i].style.fontSize='100px';
                        //classamt[i].style.fontFamily="Khmer Os Muol light, sans-serif";
                    }

                var khshortcut=document.getElementsByClassName('khshortcut');
                     for(i=0; i<khshortcut.length; i++) {
                        khshortcut[i].style.fontSize='56px';
                        //classamt[i].style.fontFamily="Khmer Os Muol light, sans-serif";
                    }
                    var enshortcut=document.getElementsByClassName('enshortcut');
                     for(i=0; i<enshortcut.length; i++) {
                        enshortcut[i].style.fontSize='40px';
                        enshortcut[i].style.top='80px';

                        //classamt[i].style.fontFamily="Khmer Os Muol light, sans-serif";
                    }
                    var classimgflag=document.getElementsByClassName('imgflag');
                     for(i=0; i<classimgflag.length; i++) {
                        classimgflag[i].style.paddingTop='20px';

                    }
                    var thaibank=document.getElementsByClassName('thaibank');
                    for(i=0; i<thaibank.length; i++) {
                        thaibank[i].style.fontSize='82px';
                        // thaibank[i].style.padding='63px 0px 63px 0px';
                        //classamt[i].style.fontFamily="Khmer Os Muol light, sans-serif";
                    }
                    var classbc12=document.getElementsByClassName('bc12');
                     for(i=0; i<classbc12.length; i++) {
                        classbc12[i].style.padding='41px 0px 41px 0px';
                    }
                    var classbc3=document.getElementsByClassName('bc3');
                     for(i=0; i<classbc3.length; i++) {
                        classbc3[i].style.padding='41px 0px 41px 0px';
                    }
                    var classbc4=document.getElementsByClassName('bc4');
                     for(i=0; i<classbc4.length; i++) {
                        classbc4[i].style.padding='41px 0px 41px 0px';
                    }
            }
            if(w<=900){
                document.getElementById("divcol1").style.marginLeft = '0px';
                // document.getElementById("divcol2").style.marginLeft = '0px';
                // document.getElementById("divcol3").style.marginLeft = '0px';
                document.getElementById("divcol1").style.marginRight = '0px';
                // document.getElementById("divcol2").style.marginRight = '0px';
                // document.getElementById("divcol3").style.marginRight = '0px';

                document.getElementById("companyname").style.textAlign = 'center';
                document.getElementById("divtitle").style.left = '0px';
                var khshortcut=document.getElementsByClassName('khshortcut');
                     for(i=0; i<khshortcut.length; i++) {
                        khshortcut[i].style.fontSize='32px';

                    }
                    var enshortcut=document.getElementsByClassName('enshortcut');
                     for(i=0; i<enshortcut.length; i++) {
                        enshortcut[i].style.fontSize='25px';

                    }
                // var qrcode=document.getElementsByClassName('qrcode');
                //  for(i=0; i<qrcode.length; i++) {
                //     qrcode[i].style.marginRight='0px';

                // }

                // if(w>=600){
                //     document.getElementById("textfooter").style.display = 'inline';
                //     document.getElementById("textfooter").style.marginLeft = '25px';
                // }else{
                //     document.getElementById("textfooter").style.display = 'block';
                //     document.getElementById("textfooter").style.marginLeft = '0px';
                // }

                if(w<600){

                    window.parent.document.body.style.zoom = "75%";
                    document.getElementById("companyname").style.fontSize = '48px';
                    document.getElementById("companyname").style.fontWeight = 'bold';
                    // document.getElementById("hd2").style.display = 'none';
                    // document.getElementById("hd3").style.display = 'none';
                    //document.getElementById("divheader1").style.top = '230px';


                    var classamt=document.getElementsByClassName('relativeamt');
                     for(i=0; i<classamt.length; i++) {
                        classamt[i].style.fontSize='60px';

                    }
                    var khshortcut=document.getElementsByClassName('khshortcut');
                     for(i=0; i<khshortcut.length; i++) {
                        khshortcut[i].style.fontSize='30px';

                    }
                    var enshortcut=document.getElementsByClassName('enshortcut');
                     for(i=0; i<enshortcut.length; i++) {
                        enshortcut[i].style.fontSize='24px';

                    }
                    // var falgcounter=document.getElementsByClassName('falgcounter');
                    //  for(i=0; i<falgcounter.length; i++) {
                    //     falgcounter[i].style.display='none';

                    // }
                }

                var classfontfooter=document.getElementsByClassName('fontfooter');
                 for(i=0; i<classfontfooter.length; i++) {
                    classfontfooter[i].style.fontSize='32px';

                 }
                // var qrfooter=document.getElementsByClassName('qrfooter');
                //  for(i=0; i<qrfooter.length; i++) {
                //     qrfooter[i].style.right='0px';

                // }
                var thaibank=document.getElementsByClassName('thaibank');
                 for(i=0; i<thaibank.length; i++) {
                    thaibank[i].style.fontSize='46px';
                    //thaibank[i].style.padding='30px 0px 30px 0px';

                }

            }else if(w>900 && w<1000){

            }
        }
		function checkscreenheight() {
			if(screen.height>1080){
                window.parent.document.body.style.zoom = "100%";
            }else if(screen.height=1080){
                window.parent.document.body.style.zoom = "75%";
			}else if(screen.height<1080 && screen.height>=1024){
                window.parent.document.body.style.zoom = "72%";
			}else if(screen.height<1024 && screen.height>900){
                window.parent.document.body.style.zoom = "70%";
			}else if(screen.height<=900 && screen.height>800){
                window.parent.document.body.style.zoom = "60%";
			}else if(screen.height<=800 && screen.height>=700){
                window.parent.document.body.style.zoom = "55%";
			}else if(screen.height<700 && screen.height>=600){
                window.parent.document.body.style.zoom = "40%";
			}else if(screen.height<600 && screen.height>0){
                window.parent.document.body.style.zoom = "20%";
			}
            else{
                window.parent.document.body.style.zoom = "10%";
			}

		}


        var sumid=0;
        checkrefreshpage();
        setInterval(checkrefreshpage, 1000);

        function refreshpage(){
            var url="{{ route('currency.refreshdisplayrateforcustomer') }}";
            $.get(url,{},function(data){
                $('#myrate').empty().html(data);
            })
        }
       function getcurrentdate()
       {
        var date = new Date();
        var dayIn2Digit = String(date.getDate()).padStart(2, '0');

        var monthIn2Digit = String(date.getMonth() + 1).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minuts = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        // var current_date = date.getDate() + "-" + (date.getMonth()+1) + "-" +  date.getFullYear();
        var current_date = dayIn2Digit + "-" + monthIn2Digit + "-" +  date.getFullYear();
        // var current_time = date.getHours()+":"+date.getMinutes()+":"+ date.getSeconds();
        var current_time = hours+":"+minuts+":"+ seconds;
        var date_time = current_date+" "+current_time;
        document.getElementById("currentdate").innerHTML = date_time;
       }



    })

</script>
</html>
