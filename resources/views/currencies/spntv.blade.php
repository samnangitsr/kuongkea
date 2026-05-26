<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Rotated Rate Board</title>
<link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
<style>
body {
    margin: 0;
    background: red;
    overflow: hidden;
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ✅ Rotation Wrapper */
.rotate-wrapper {
    transform: rotate(-90deg);
    transform-origin: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 50px; /* space between header & table */
}

/* ✅ Header Style */
.logo {
    font-size: 100px;
    font-weight: bold;
    color: #daf10b;
    text-shadow:
        1px 1px 0 black,
        2px 2px 0 black,
        3px 3px 0 black,
        4px 4px 0 black,
        5px 5px 0 black;

    font-family:"Khmer os muol light";
    white-space: nowrap;
    flex-shrink: 1; /* Let logo shrink if needed */
}
.title1 {
    font-family:"Khmer os muol light";
    font-size: 70px;
    font-weight: bold;
    color: white;
    white-space: nowrap;
    text-shadow:
        1px 1px 0 black,
        2px 2px 0 black,
        3px 3px 0 black,
        4px 4px 0 black,
        5px 5px 0 black;

}
/* ✅ Table Style */
table {
    width: 1050px;
    flex-shrink: 0;
    border-collapse: collapse;
    background: white;
    font-family:Arial, Helvetica, sans-serif;
    font-size: 70px;
    background-color:red;

}

th, td {
    border: 1px solid rgb(207, 139, 139);
    padding: 10px 0px;
    text-align: center;
    font-weight: bold;
    color:white;

}

th {
    background: #f2f2f2;
    background-color:red;
    font-family:"Khmer os muol light";
    font-size:50px;
}
td.number{
    font-size:130px;
    font-family: Arial, Helvetica, sans-serif;
}
td.text{
    font-family: 'Noto Sans Khmer', sans-serif;
    font-size:60px;
    text-align: left;
    padding-left:0px;
}
td.text1{
    font-family: 'Noto Sans Khmer', sans-serif;
    font-size:80px;
    text-align: left;
    padding-left:0px;
}
.threedtime{
    font-size: 50px;
    font-weight: bold;
    color:white;
    text-shadow:
        1px 1px 0 black,
        2px 2px 0 black,
        3px 3px 0 black,
        4px 4px 0 black,
        5px 5px 0 black;
}
.three-d-text {
    font-size: 150px;
    font-weight: bold;
    color: #daf10b;
    text-shadow:
        1px 1px 0 black,
        2px 2px 0 black,
        3px 3px 0 black,
        4px 4px 0 black,
        5px 5px 0 black;
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

</style>
</head>
<body>

<!-- ✅ Rotated Content Centered -->
<div class="rotate-wrapper">

    <div class="logo">សុផានិចប្តូរប្រាក់</div>
    <table class="table" style="">
        <tr>
            <td rowspan=2 class="title1" style="border-style:none;">
                អត្រាប្តូរប្រាក់ខ្មែរ
            </td>
            <td class="threedtime" style="border-style:none;">
                {{ date('d-m-Y',strtotime($maxdate)) }}
            </td>
        </tr>
        <tr>
            <td class="threedtime" style="border-style:none;">
                <span id="clock" style="font-size:50px;">{{ date('H:i:s') }}</span>
            </td>

        </tr>
    </table>


    <table>
        <thead class="three-d-text">
            <tr>
                <th>រូបិយប័ណ្ណ</th>
                <th>ទិញចូល</th>
                <th>លក់ចេញ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cur1->whereIn('shortcut',['KHR','THB','THB-KHR']) as $c1)
                <tr>
                    <td class="text three-d-text">
                        @if($c1->ispandp==1)
                            {{ $c1->curname }}
                        @else
                          ដុល្លា-{{ $c1->curname }}
                        @endif
                    </td>
                    @if($c1->ispandp==1)
                        <td class="three-d-text number" style="text-align:left;padding-left:5px;">{{ number_format($c1->ratebuy,$c1->decpoint,'.','') }}</td>
                        <td class="three-d-text number" style="text-align:right;">{{ number_format($c1->ratesale,$c1->decpoint,'.','') }}</td>
                    @else
                        <td class="three-d-text number" style="text-align:left;padding-left:5px;">{{ number_format($c1->ratesale,$c1->decpoint,'.','') }}</td>
                        <td class="three-d-text number" style="text-align:right;">{{ number_format($c1->ratebuy,$c1->decpoint,'.','') }}</td>
                    @endif
                </tr>

            @endforeach
                <tr style="">
                    <td colspan=3 class="title1">អត្រាលុយបាតកុងថៃ</td>
                </tr>
                <tr>
                    <td class="text three-d-text">បាត-រៀល</td>
                    <td class="three-d-text number" style="text-align:left;">{{ floatval($thai_khr->buy) }}</td>
                    <td class="three-d-text number" style="text-align:right;">{{ floatval($thai_khr->sale) }}</td>

                </tr>
                <tr>
                    <td class="text three-d-text">ដុល្លា-បាត</td>
                    <td class="three-d-text number" style="text-align:left;">{{ floatval($thai_usd->buy) }}</td>
                    <td class="three-d-text number" style="text-align:right;">{{ floatval($thai_usd->sale) }}</td>

                </tr>
                <tr>
                    <td class="text1" colspan=3 style="border-style:none;text-align:center;">
                        <span>មានទទួលបង់ ទឹក ភ្លើង ផ្ទេរប្រាក់ ខ្មែរ ថៃ</span>
                    </td>
                </tr>
        </tbody>
    </table>


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

    setInterval(updateClock, 1000); // update every second
    updateClock(); // run once immediately
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
