@extends('master')
@section('title') Main Function @endsection
@section('css')
    <style type="text/css">
        body.wait, body.wait *{
			cursor: wait !important;
		}
        .button1:hover {
                background-color: #8fe9c8;
                color: rgb(19, 57, 230);

            }
        .button1{
            border:1px solid blue;
            background-color:inherit;
            padding:15px;
        }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            }
        .mainfunc ul {
            padding: 0;
            margin: 0;
            list-style: none;
            background: 0 0
        }
         .mainfunc a {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: left;
            padding: 5px;
            font-size: 18px;
            color: darkgreen;
            outline-width: 0;
            text-overflow: ellipsis;
            overflow: hidden;
            letter-spacing: .5px;
            border: 1px solid #ffffff00;
            transition: all .3s ease-out;
            font-family:'Noto Sans Khmer', sans-serif;
        }
        .mainfunc li > a:hover{
            background-color:rgb(206, 247, 169);
        }
        .mainfunc li{
            padding:0px;
        }


    </style>
@endsection
@section('content')
    <div class="row" style="">
        <div class="col-lg-3" style="">
            <div class="card" style="padding:0px;margin:0px;">
                <div class="card-header" style="padding:5px;text-align:center;">
                    <h1 class="kh22-b">ដើមទុនបុគ្គលិក</h1>
                </div>
                <div class="card-body" style="padding:0px;">
                        <ol class="mainfunc">

                            <li>
                                <a href="{{ route('usercapital.index') }}" class="">ដើមទុនបុគ្គលិក</a>
                            </li>
                            <li>
                                <a href="{{ route('usercapital.closelist') }}" class="">បិទបញ្ជីបុគ្គលិក</a>
                            </li>
                            <li>
                                <a href="{{ route('usercapital.usertransactionreport') }}" class="">ប្រតិបត្តិការណ៏បុគ្គលិក</a>
                            </li>
                            <li>
                                <a href="{{ route('usercapital.userstatementreport') }}" class="">របាយការណ៏បុគ្គលិក</a>
                            </li>
                            <li>
                                <a href="{{ route('usercapital.moneyoffer') }}" class="">បុគ្គលិកស្នើរប្រាក់</a>
                            </li>

                            <li>
                                <a href="{{ route('expanseincome.index') }}" class="">ចំណូលចំណាយ</a>
                            </li>

                        </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-3" style="">
            <div class="card" style="padding:0px;margin:0px;">
                <div class="card-header" style="padding:5px;text-align:center;">
                    <h1 class="kh22-b">ប្តូរប្រាក់</h1>
                </div>
                <div class="card-body" style="padding:0px;">
                        <ol class="mainfunc">

                            <li>
                                 <a
                                    href="{{ route('exchange.index') }}"
                                    @if(config('helper.exchange_auto_capture')==1) onclick="window.open('{{ route('exchange.recognit') }}', '_blank');" @endif
                                    style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">ប្តូរប្រាក់
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('exchangelists') }}" class="">របាយការណ៏ប្តូរប្រាក់</a>
                            </li>
                            <li>
                                <a href="{{ route('currency.exchangeratenew') }}" class="">កំណត់អត្រាប្តូរប្រាក់ថ្មី</a>
                            </li>
                            <li>
                                <a href="{{ route('usercapital.userprofit') }}" class="">ប្រាក់ចំណេញ</a>
                            </li>
                            <li>
                                <a href="{{ route('currency.index') }}" class="">កំណត់រូបិយប័ណ្ណ</a>
                            </li>
                            <li>
                                <a href="{{ route('moneytransfer.settransferrate') }}" class="">កំណត់អត្រាផ្ទេរប្រាក់</a>
                            </li>
                        </ol>
                </div>
            </div>
        </div>
        <div class="col-lg-3" style="">
            <div class="card" style="padding:0px;margin:0px;">
                <div class="card-header" style="padding:5px;text-align:center;">
                    <h1 class="kh22-b">ផ្ទេរប្រាក់</h1>
                </div>
                <div class="card-body" style="padding:0px;">
                    <ol class="mainfunc">
                        <li>
                            <a href="{{ route('moneytransfer.formtransfer') }}" class="">ផ្ទេរប្រាក់ដៃគូ</a>
                        </li>
                        <li>
                            <a href="{{ route('moneytransfer.banktransfer') }}" class="">ផ្ទេរតាមធនាគា</a>
                        </li>
                        <li>
                            <a href="{{ route('moneytransfer.wingtransfer') }}" class="">ផ្ទេរតាមវីង</a>
                        </li>
                        <li>
                            <a href="{{ route('moneytransfer.customertransfer') }}" class="">អតិថិជនដាក់ដក</a>
                        </li>
                        <li>
                            <a href="{{ route('moneytransfer.quicktransfer') }}" class="">ដាក់ដករហ័ស</a>
                        </li>
                        <li>
                            <a href="{{ route('moneytransfer.cashdraw') }}" class="">បើកវេរក្នុងស្រុក</a>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card" style="padding:0px;margin:0px;">
                <div class="card-header" style="padding:5px;text-align:center;">
                    <h1 class="kh22-b">បញ្ជីដៃគូ</h1>
                </div>
                <div class="card-body" style="padding:0px;">
                    <ol class="mainfunc">
                        <li>
                            <a href="{{ route('partnerlist.indexnew') }}" target="_blank()" class="">សៀវភៅបញ្ជីថ្មី</a>
                        </li>
                        <li>
                            <a href="{{ route('partnerlist.index') }}" class="">សៀវភៅបញ្ជីចាស់</a>
                        </li>
                        <li>
                            <a href="{{ route('partnerlist.alllist') }}" class="">បញ្ជីដៃគូទាំំងអស់</a>
                        </li>
                        <li>
                            <a href="{{ route('partnerlist.exchangelist',0) }}" class="">កាត់កងបញ្ជីដៃគូ</a>
                        </li>
                        <li>
                            <a href="{{ route('exchangelist.delkatkong') }}" class="">លុបកាត់កង</a>
                        </li>
                        <li>
                            <a href="{{ route('partnerlist.exchangelistreport',0) }}" class="">របាយការណ៏កាត់កង</a>
                        </li>

                    </ol>

                </div>
            </div>
        </div>

    </div>

    <div class="row" style="margin-top:10px;">
        <div class="col-lg-3">
            <div class="card" style="padding:0px;margin:0px;">
                <div class="card-header" style="padding:5px;text-align:center;">
                    <h1 class="kh22-b">លុយថៃ</h1>
                </div>
                <div class="card-body" style="padding:0px;">
                    <ol class="mainfunc">
                        <li>
                            <a href="{{ route('thaicashdraw.thaisms') }}" class="">សារថៃ</a>
                        </li>
                        <li>
                            <a href="{{ route('thaicashdraw.cashdraw') }}" class="">បើកវេរលុយថៃ</a>
                        </li>
                        <li>
                            <a href="{{ route('thaicashdraw.cashdraw1') }}" class="">ទំនាក់ទំនងអតិថិជន</a>
                        </li>
                        <li> <a href="{{ route('thaicashdraw.cashdrawreport') }}" >របាយការណ៏បើកវេរថៃ</a>
                        </li>
                        <li> <a href="{{ route('thaicashdraw.notyetcashdrawreport') }}" >របាយការណ៏ស្តុកថៃ</a>
                        </li>
                        <li> <a href="{{ route('thaicashdraw.accountregister') }}" >ចុះលេខបញ្ជី</a>
                        </li>
                        <li> <a href="{{ route('thaicashdraw.closelist') }}" >បិទបញ្ជីលុយថៃ</a>
                        </li>


                    </ol>

                </div>
            </div>
        </div>
        <div class="col-lg-3" style="">
            <div class="card" style="padding:0px;margin:0px;">
                <div class="card-header" style="padding:5px;text-align:center;">
                    <h1 class="kh22-b">អចលនទ្រព្យ</h1>
                </div>
                <div class="card-body" style="padding:0px;">
                        <ol class="mainfunc">
                            <li>
                                <a href="{{ route('realestate.index') }}" class="">លក់អចលនទ្រព្យ</a>
                            </li>
                            <li>
                                <a href="{{ route('realestate.soldpropertylist') }}" class="">តារាងលក់</a>
                            </li>
                            <li> <a href="{{ route('realestate.customerromloslist') }}">តារាងឈ្មោះបង់រំលស់</a>
                            </li>
                            <li>
                                <a href="{{ route('land.index') }}" class="">ចុះឈ្មោះអចលនទ្រព្យ</a>
                            </li>
                            <li>
                                <a href="{{ route('realestate.docontract') }}" class="">ធ្វើកុងត្រាលក់</a>
                            </li>
                        </ol>
                </div>
            </div>
        </div>
        <div class="col-lg-3" style="">
            <div class="card" style="padding:0px;margin:0px;">
                <div class="card-header" style="padding:5px;text-align:center;">
                    <h1 class="kh22-b">ការចុះឈ្មោះ</h1>
                </div>
                <div class="card-body" style="padding:0px;">
                        <ol class="mainfunc">

                            <li>
                                <a href="{{ route('customer.index') }}" class="">ចុះឈ្មោះអតិថិជន</a>
                            </li>
                            <li>
                                <a href="{{ route('child.index') }}" class="">ចុះឈ្មោះកូនសាខា</a>
                            </li>
                            <li>
                                <a href="{{ route('address.index') }}" class="">ចុះឈ្មោះខេត្តក្រុង</a>
                            </li>

                            <li>
                                <a href="{{ route('userregister') }}" class="">ចុះឈ្មោះអ្នកប្រើប្រាស់</a>
                            </li>
                            <li>
                                <a href="{{ route('company.register') }}" class="">ចុះឈ្មោះក្រុមហ៊ុន</a>
                            </li>



                        </ol>
                </div>
            </div>
        </div>
        <div class="col-lg-3" style="">
            <div class="card" style="padding:0px;margin:0px;">
                <div class="card-header" style="padding:5px;text-align:center;">
                    <h1 class="kh22-b">របាយការណ៏</h1>
                </div>
                <div class="card-body" style="padding:0px;">
                    <ol class="mainfunc">
                        <li>
                            <a href="{{ route('closelist.index') }}" class="">បញ្ជីលុយកាក់</a>
                        </li>
                        <li>
                            <a href="{{ route('closelist.report') }}" class="">របាយការណ៏បិទបញ្ជី</a>
                        </li>
                        <li>
                            <a href="{{ route('closelist.summaryreport') }}" class="">របាយការណ៏សង្ខេប</a>
                        </li>
                        <li>
                            <a href="{{ route('report.transferprofit') }}" class="">ប្រាក់ចំណេញផ្ទេរប្រាក់</a>
                        </li>
                        <li>
                            <a href="{{ route('stock.report') }}" class="">របាយការណ៌ស្តុក</a>
                        </li>
                        <li>
                            <a href="{{ route('stock.reportbuysale') }}" class="">របាយការណ៏ទិញលក់</a>
                        </li>
                        <li>
                            <a href="{{ route('stock.index') }}" class="">ព៌តមានស្តុក</a>
                        </li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-3">

        </div>
        <div class="col-lg-3">
        </div>
        <div class="col-lg-3" style="">

        </div>
    </div>

@endsection
@section('script')
<script type="text/javascript">
    $('#h1_title').text('មុខងារប្រើប្រាស់');
</script>
@endsection
