<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="viewport" id="viewport" content="width=device-width, initial-scale=0.55, maximum-scale=1, user-scalable=no"> --}}
    {{-- <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no"> --}}
    <title>Exchange Rate Display</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
</head>
    <style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

      html, body {
        height: 100%;
        width: 100%;
        font-family: Arial, sans-serif;


      }

      body {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to right, rgb(55, 200, 226), rgb(16, 223, 34));
        color: white;
        text-align: center;
      }

      .container {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .card {
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: black;
        padding: 0px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        border-radius: 10px;
      }

      table {
        width: 100%;
      }

      /* Responsive text sizing (optional) */
      h1 {
        font-size: 3vw;
      }

      p, td, div {
        font-size: 1.5vw;
      }

      @media (max-width: 768px) {
        h1 {
          font-size: 6vw;
        }

        p, td, div {
          font-size: 3.5vw;
        }

        .card img {
          width: 100px !important;
        }
      }

      /* -------------------------------------- */
     @font-face {
        font-family: 'DS-Digital';
        font-style: normal;
        font-weight: 400;
        src: url('{{ config('helper.asset_path') }}/fonts/DS-DIGI.woff') format('woff'),
            url('{{ config('helper.asset_path') }}/fonts/DS-DIGI.TTF') format('truetype');
    }

    @font-face {
        font-family: 'DS-Digital';
        font-style: normal;
        font-weight: 700;
        src: url('{{ config('helper.asset_path') }}/fonts/DS-DIGIB.woff') format('woff'),
            url('{{ config('helper.asset_path') }}/fonts/DS-DIGIB.TTF') format('truetype');
    }

    @font-face {
        font-family: 'DS-Digital';
        font-style: italic;
        font-weight: 400;
        src: url('{{ config('helper.asset_path') }}/fonts/DS-DIGII.woff') format('woff'),
            url('{{ config('helper.asset_path') }}/fonts/DS-DIGII.TTF') format('truetype');
    }

    @font-face {
        font-family: 'DS-Digital';
        font-style: italic;
        font-weight: 700;
        src: url('{{ config('helper.asset_path') }}/fonts/DS-DIGIT.woff') format('woff'),
            url('{{ config('helper.asset_path') }}/fonts/DS-DIGIT.TTF') format('truetype');
    }

    .digital {
        font-family: 'DS-Digital',sans-serif;
    }
    .digital.bold {
        font-weight: bold;
    }

    .digital.italic {
        font-style: italic;
    }

    .circular--landscape { display: inline-block; position: relative; width: 100px; height: 100px; overflow: hidden; border-radius: 50%;left:10px; }
    .circular--landscape img { width: auto; height: 100%; margin-left: -50px; }

    .circular--logo { display: inline-block; position: relative; width: 120px; height: 120px; overflow: hidden; border-radius: 50%;top:5px;left:5px; }
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
        top:-130px;
        left:5px;
        font-family:'Noto Sans Khmer', sans-serif;
        font-weight:bold;
        font-size:95px;
        color:white;
    }
    .enshortcut{
        position:absolute;
        top:0px;
        left:10px;
        font-weight:bold;
        font-size:80px;
        color:white;
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
    font-size:300px;
    display:inline;
     line-height: 1;        /* ← remove vertical space */
    padding:0px;
    /* border: 3px solid #73AD21; */
    }
    td.no-space {
        padding: 0 !important;       /* ensure no padding */
        vertical-align: middle;      /* center inside td */
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
    .kh32{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:32px;
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
    /* border: 1px solid #ccc;
    border-color: #e4e4e4 #bebebd #bebebd #e4e4e4; */
    padding: 0px;

    /* margin-bottom: 10px; */
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
    /* border-style:solid solid solid solid; */
    text-align:right;
    /* padding:0px 0px 0px 20px; */
    width:10%;
}
td.bc12{
    text-align:left;
    /* border-style:solid none solid none; */
    padding:0px;
    width:22%;
    border:2px solid yellow;
}
td.bc3{
    border:2px solid yellow;
    padding:0px;
    font-size:60px;
    font-weight:bold;
    text-align:right;
    /* border:1px solid silver; */
    width:39%;
    color:red;
}
td.bc4{
    border:2px solid yellow;
    padding:0px;
    font-size:60px;
    font-weight:bold;
    text-align:right;
    /* border:1px solid silver; */
    width:39%;
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
    table td{
        border-style:none;
    }
.three-d-text {
    font-size: 60px;
    font-weight: bold;
    color: #e436db;
    text-shadow:
        1px 1px 0 black,
        2px 2px 0 black,
        3px 3px 0 black,
        4px 4px 0 black,
        5px 5px 0 black;
}
.three-d-text1{
     text-shadow:
        1px 1px 0 black,
        2px 2px 0 black,
        3px 3px 0 black,
        4px 4px 0 black,
        5px 5px 0 black;
}
.marquee-wrapper {
    white-space: nowrap;
    overflow: hidden;
    position: relative;
}

.marquee-content span {
    display: inline-block;
    padding-left: 100%;
    animation: marquee 80s linear infinite;
}

@keyframes marquee {
    0%   { transform: translateX(0%); }
    100% { transform: translateX(-100%); }
}
.cbk1{
    background-color:skyblue;
}
.cbk2{
    background-color:rgb(213, 226, 26);
}
.cbk3{
    background-color:rgb(119, 243, 252);
}
.cbk{
    background-color:rgb(148, 243, 38);
}
    </style>



<body>

  <div class="container">

        <div class="card" style="">

            <table class="table table-bordered"  style="width:100%;margin-top:5px;">
                <tbody>
                    @php
                        $k=0;
                        $cbk='';
                    @endphp
                    <tr style="background-color:blue;">

                        <td class="" style="text-align:center;padding:0px;border:2px solid yellow;">
                            <div class="mainshortcut">

                                <div class="three-d-text" style="font-family:khmer os system;font-size:82px;color:white;margin-left:10px;">
                                    រូបិយប័ណ្ណ
                                </div>
                                <div class="three-d-text" style="font-family:Arial, Helvetica, sans-serif;font-size:56px;font-weight:bold;margin-top:-20px;color:white;">
                                    Currency
                                </div>
                            </div>
                        </td>
                        <td class="" style="text-align:center;padding:0px;border:2px solid yellow;">
                            <div class="mainshortcut">

                                <div class="three-d-text" style="font-family:khmer os system;font-size:82px;color:white;">
                                    ទិញ
                                </div>
                                <div class="three-d-text" style="font-family:Arial, Helvetica, sans-serif;font-size:56px;font-weight:bold;margin-top:-20px;color:white">
                                    Bid
                                </div>
                            </div>
                        </td>
                        <td class="" style="text-align:center;padding:0px;border:2px solid yellow;">
                            <div class="mainshortcut">

                                <div class="three-d-text" style="font-family:khmer os system;font-size:82px;color:white">
                                    លក់
                                </div>
                                <div class="three-d-text" style="font-family:Arial, Helvetica, sans-serif;font-size:56px;font-weight:bold;margin-top:-20px;color:white">
                                    Ask
                                </div>
                            </div>
                        </td>

                    </tr>
                    @foreach ($cur1 as $c1)


                        <tr style="background-color:rgb(68, 7, 4);">
                            <td class="bc12" style="color:black;padding:0px;">
                                <div class="mainshortcut">

                                    @if($c1->ispandp==1)

                                        <div class="khshortcut three-d-text1">
                                            {{ $c1->curname }}
                                        </div>
                                            <div class="enshortcut three-d-text1">
                                            {{$c1->shortcut}}
                                        </div>

                                    @else
                                        <div class="khshortcut three-d-text1">
                                            {{ 'ដុល្លា-' .$c1->curname }}
                                        </div>
                                        <div class="enshortcut three-d-text1">
                                            {{ 'USD-' . $c1->shortcut }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            @if($c1->ispandp==1)
                                <td class="bc4 three-d-text" style="color:white;text-align:center;padding:0px;">
                                    <div class="relativeamt" style="padding:0px;">
                                        {{ number_format($c1->buy,$c1->decpoint,'.','') }}
                                    </div>

                                </td>
                                <td class="bc3 three-d-text" style="color:white;text-align:center;padding:0px;">
                                    <div class="relativeamt" style="padding:0px;">
                                        {{ number_format($c1->sale,$c1->decpoint,'.','') }}
                                    </div>

                                </td>
                            @else
                                <td class="bc4 three-d-text" style="color:white;text-align:center;padding:0px;">
                                    <div class="relativeamt" style="padding:0px;">
                                        {{ number_format($c1->sale,$c1->decpoint,'.','') }}
                                    </div>
                                </td>
                                <td class="bc3 three-d-text" style="color:white;text-align:center;padding:0px;">
                                    <div class="relativeamt" style="padding:0px;">
                                        {{ number_format($c1->buy,$c1->decpoint,'.','') }}
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
    <script src="https://cdn.ably.io/lib/ably.min-1.js"></script>

</body>
<script>
   document.addEventListener("click", function handleFirstClick() {
    document.documentElement.requestFullscreen();
    document.removeEventListener("click", handleFirstClick);
    });
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
    }

    // setInterval(updateClock, 1000); // update every second
    // updateClock(); // run once immediately
     var ably = new Ably.Realtime('DF1ung.N3Jwqw:30ezVuIjqesSJZRbGMoD8NsqtIij6_uqR6soVWetP0Q'); //remember to pass your ably API key
        var channel = ably.channels.get('chatting'); // here i create a channel or initialize the existing channel
        channel.subscribe('messageEvent', function(message) { // message this is message from channel
            // Handle incoming messages (create a message body div tag)
            console.log(message)
             //const currentUser = ""; // Server renders this per user
            const domainnameis="{{ config('helper.transfer_option') }}";
                if(message.data.customername==domainnameis){
                    console.log('reload page')
                    location.reload();
                }
        });
</script>
</html>
