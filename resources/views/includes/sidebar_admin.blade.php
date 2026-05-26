<!--sidebar wrapper -->
<style>
    ul.metismenu li{
        background-color:whitesmoke;
    }

    ul.metismenu li:hover{
        background-color:aquamarine;
    }
    .menu-title{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:22px;
        font-weight:100;
    }
    ul li a{
        font-family: 'khmer os system', sans-serif;
        font-weight:300;
    }
</style>
<div class="sidebar-wrapper" data-simplebar="true">
    @php
        $com=App\Company::getbranceinfo();
    @endphp
    {{-- @foreach (App\Company::getbranceinfo() as $com) --}}
        <div class="sidebar-header" style="margin:0px;padding:0px;background-color:{{ $com->logobg??'' }}">
            <div>
                <table>

                    <tr>
                        <td>
                            <a href="{{ route('dashboard') }}" class="" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                                @if(!empty($com?->logo))
                                    <img src="{{ $com->logo <> '' ? config('helper.asset_path').'/logo/'. $com->logo:'' }}" alt="" style="width:{{ $com->logosize??'64px' }}">
                                @endif
                            </a>
                        </td>
                        <td style="padding-left:5px;">
                            <a href="{{ route('dashboard') }}" class="" style="font-family: 'khmer os muol light';font-size:{{$com->fontsize??'16px'}};text-shadow: 2px 2px 4px #000000;color:{{ $com->textcolor??'' }}">
                                {{ $com->name??'' }} <br> {{ $com->subtext??'' }}
                            </a>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left' style="color:darkgreen;"></i>
            </div>
        </div>
    {{-- @endforeach --}}
    <!--navigation-->
        <ul class="metismenu" id="menu" style="">
            <li>
                <a title="code:0" href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-desktop'></i>
                    </div>
                    <div class="menu-title" style="">ពេញនិយម</div>
                </a>
                <ul>

                    <li title="code:0.1"> <a href="{{ route('thaicashdraw.thaisms_pop') }}" style="">01. សារថៃ</a>
                    </li>
                    <li title="code:0.2"> <a href="{{ route('thaicashdraw.cashdraw_pop') }}" style="">02. បើកលុយថៃ</a>
                    </li>
                    <li title="code:0.3"> <a href="{{ route('thaicashdraw.cashdraw1_pop') }}" style="">03. ទំនាក់ទំនងអតិថិជន</a>
                    </li>

                    <li title="code:0.4"> <a href="{{ route('moneytransfer.formtransfer_pop') }}" style="">04. ផ្ទេរប្រាក់</a>
                    </li>
                    <li title="code:0.5"> <a href="{{ route('moneytransfer.banktransfer_pop') }}" style="">05. បាញ់ឆ្លងធនាគា</a>
                    </li>
                    <li title="code:0.6"> <a href="{{ route('moneytransfer.wingtransfer_pop') }}" style="">06. វេរតាមវីង</a>
                    </li>
                    <li title="code:0.7"> <a href="{{ route('moneytransfer.customertransfer_pop') }}" style="">07. ដាក់ដកអតិថិជន</a>
                    </li>
                    <li title="code:0.8"> <a href="{{ route('moneytransfer.quicktransfer_pop') }}" style="">08. ដាក់ដករហ័ស</a>
                    </li>
                    <li title="code:0.9"> <a href="{{ route('exchange.index_pop') }}" @if(config('helper.exchange_auto_capture')==1) onclick="window.open('{{ route('exchange.recognit') }}', 'recognitWindow');" @endif style="">09. ប្តូរប្រាក់</a>
                    </li>
                    <li title="code:0.10"> <a href="{{ route('moneytransfer.cashdraw_pop') }}" style="">10. បើកវេរក្នុងស្រុក</a>
                    </li>
                    <li title="code:0.11"> <a href="{{ route('usercapital.index_pop') }}" style="">11. ដើមទុនបុគ្គលិក</a>
                    </li>
                    <li title="code:0.12"> <a href="{{ route('usercapital.closelist_pop') }}" style="">12. បិទបញ្ជីបុគ្គលិក</a>
                    </li>
                    <li title="code:0.13"> <a href="{{ route('usercapital.usertransactionreport_pop') }}" style="">13. ប្រតិបត្តិការណ៏បុគ្គលិក</a>
                    </li>
                    <li title="code:0.14"> <a href="{{ route('expanseincome.index_pop') }}" style="">14. ចំណូលចំណាយ</a>
                    </li>
                    <li title="code:0.15"> <a href="{{ route('partnerlist.indexnew_pop') }}" style="" target="_blank">15. សៀវភៅបញ្ជីថ្មី</a>
                    </li>
                    <li title="code:0.16">
                        <a href="{{ route('partnerlist.exchangelist_pop',0) }}" style="" class="">16. កាត់កងបញ្ជីដៃគូ</a>
                    </li>
                    <li title="code:0.17">
                        <a href="{{ route('closelist.index_pop') }}" style="" class="">17. បិទបញ្ជីប្រចាំថ្ងៃ</a>
                    </li>
                </ul>
            </li>

            <li style="{{ config('helper.realestate')==0?'display:none':'' }}">
                <a href="javascript:;" class="has-arrow" style="" title="code:1">
                    <div class="parent-icon"><i class='fa fa-bank'></i>
                    </div>
                    <div class="menu-title" style="">អចលនទ្រព្យ</div>
                </a>

                <ul>
                    <li title="code:1.6"> <a href="{{ route('realestate.docontract') }}" style="" target="_blank">1. ធ្វើកុងត្រា</a>
                    </li>
                    <li title="code:1.1"> <a href="{{ route('realestate.index') }}" style="">2. លក់</a>
                    </li>
                    <li title="code:1.2"> <a href="{{ route('realestate.soldpropertylist') }}" style="">3. តារាងលក់</a>
                    </li>
                    <li title="code:1.3"> <a href="{{ route('realestate.customerromloslist') }}" style="">4. អ្នកទិញបង់រំលស់</a>
                    </li>
                    {{-- <li> <a href="{{ route('realestate.romloslist') }}" style="">4. តារាងបង់រំលស់</a>
                    </li>
                    <li> <a href="{{ route('realestate.paymentlist') }}" style="">5. តារាងបង់ប្រាក់</a>
                    </li> --}}
                    <li title="code:1.4"> <a href="{{ route('realestate.commissionlist') }}" style="">5. ទូទាត់កម្រៃជើងសារ</a>
                    </li>
                    <li title="code:1.4"> <a href="{{ route('realestate.commissionlistall') }}" style="">6. ទូទាត់កម្រៃជើងសារសរុប</a>
                    </li>
                    <li title="code:1.5"> <a href="{{ route('land.index') }}" style="">7. ចុះឈ្មោះអចលនទ្រព្យ</a>
                    </li>

                    <li title="code:1.7"> <a href="{{ route('realestate.incomeexpansereport') }}" style="" target="_blank">8. ចំណូលចំណាយលក់</a>
                    </li>
                    <li title="code:1.8"> <a href="{{ route('realestate.generalexpanse') }}" style="" target="_blank">9. ចំណូលចំណាយទូទៅ</a>
                    </li>
                    <li title="code:1.9"> <a href="{{ route('realestate.closelist') }}" style="" target="_blank">10. បិទបញ្ជីប្រចាំខែ</a>
                    </li>
                    <li title="code:1.10"> <a href="{{ route('deletepropertysold') }}" style="" target="_blank">11. លុបអចលលក់រួច</a>
                    </li>
                    <li title="code:1.11"> <a href="{{ route('realestate.commissionreport') }}" style="" target="_blank">12. របាយការណ៏កម្រៃជើងសារ</a>
                    </li>
                    <li title="code:1.12"> <a href="{{ route('realestate.closelistuser') }}" style="" target="_blank">13. បិទបញ្ជីបុគ្គលិក</a>
                    </li>
                    <li title="code:1.13"> <a href="{{ route('realestate.paymentreport') }}" style="" target="_blank">14. របាយការណ៏បង់ប្រាក់</a>
                    </li>
                </ul>
            </li>
            <li>
                <a title="code:2" href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-money'></i>
                    </div>
                    <div class="menu-title" style="">ដើមទុន</div>
                </a>
                <ul>
                    <li title="code:2.1"> <a href="{{ route('usercapital.index') }}" style="">1. ដើមទុនបុគ្គលិក</a>
                    </li>
                    <li title="code:2.2"> <a href="{{ route('usercapital.closelist') }}" style="">2. បិទបញ្ជីបុគ្គលិក</a>
                    </li>
                    <li title="code:2.3"> <a href="{{ route('usercapital.usertransactionreport') }}" style="">3. ប្រតិបត្តិការណ៏បុគ្គលិក</a>
                    </li>
                    <li title="code:2.4"> <a href="{{ route('usercapital.moneyoffer') }}" style="">4. បុគ្គលិកស្នើរប្រាក់</a>
                    </li>
                    <li title="code:2.5"> <a href="{{ route('expanseincome.inusercapital') }}" style="">5. ចំណូលចំណាយ</a>
                    </li>
                </ul>
            </li>
            <li>
                <a title="code:3" href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-calculator'></i>
                    </div>
                    <div class="menu-title" style="">ប្តូរប្រាក់</div>
                </a>
                <ul>

                    <li title="code:3.1">

                        <a
                            href="{{ route('exchange.index') }}"
                            @if(config('helper.exchange_auto_capture')==1) onclick="window.open('{{ route('exchange.recognit') }}', 'recognitWindow');" @endif
                            style="">1. ប្តូរប្រាក់
                        </a>


                    </li>
                    <li title="code:3.2"> <a href="{{ route('exchangelists') }}" style="">2. របាយការណ៏ប្តូរប្រាក់</a>
                    </li>
                    <li title="code:3.2"> <a href="{{ route('exchangelistsnew') }}" style="">3. របាយការណ៏ប្តូរប្រាក់ថ្មី</a>
                    </li>
                    @if(config('helper.haveexchangegold')==1)
                        <li title="code:3.2"> <a href="{{ route('exchangegoldreport') }}" style="">4. របាយការណ៏កក់មាស</a>
                        </li>
                    @endif
                    <li title="code:3.3">
                        <a href="{{ route('currency.exchangeratenew') }}" style="" class="">5. កំណត់អត្រាប្តូរប្រាក់ថ្មី</a>
                    </li>
                    <li title="code:3.4">
                        <a href="{{ route('usercapital.userprofit') }}" style="" class="">6. ប្រាក់ចំណេញ</a>
                    </li>
                    <li title="code:3.5">
                        <a href="{{ route('currency.index') }}" style="" class="">7. កំណត់រូបិយប័ណ្ណ</a>
                    </li>
                    <li title="code:3.6">
                        <a href="{{ route('currency.ratedisplayforcustomer') }}" style="" class="" target="_blank">8. ផ្ទាំំងបង្ហោះអត្រាប្តូរប្រាក់</a>
                    </li>
                    <li title="code:3.7">
                        <a href="{{ route('currency.ratedisplaytv') }}" style="" class="" target="_blank">9. ប៉ុស្តិ៍អត្រាប្តូរប្រាក់</a>
                    </li>
                    @if(config('helper.exchange_auto_capture')==1)
                        <li title="code:3.8"> <a href="{{ route('customerexchangelist') }}" style="">10. រូបអតិថិជនប្តូរប្រាក់</a>
                        </li>
                        <li title="code:3.9"> <a href="{{ route('pagetime') }}" style="font-family:'Arial';font-size:16px;font-weight:bold;">11. Page Time</a>
                        </li>
                    @endif
                </ul>
            </li>

            <li>
                <a title="code:4" href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-paper-plane'></i>
                    </div>
                    <div class="menu-title" style="">វេរលុយ</div>
                </a>
                <ul>
                    <li title="code:4.1"> <a href="{{ route('moneytransfer.formtransfer') }}" style="">1. ផ្ទេរប្រាក់</a>
                    </li>
                    <li title="code:4.2"> <a href="{{ route('moneytransfer.banktransfer') }}" style="">2. បាញ់ឆ្លងធនាគា</a>
                    </li>
                    <li title="code:4.3"> <a href="{{ route('moneytransfer.wingtransfer') }}" style="">3. វេរតាមភ្នាក់ងារ</a>
                    </li>
                    <li title="code:4.4"> <a href="{{ route('moneytransfer.customertransfer') }}" style="">4. ដាក់ដកអតិថិជន</a>
                    </li>
                    <li title="code:4.5"> <a href="{{ route('moneytransfer.quicktransfer') }}" style="">5. ដាក់ដករហ័ស</a>
                    </li>
                    <li title="code:4.6">
                        <a href="{{ route('moneytransfer.settransferrate') }}" style="" class="">6. កំណត់អត្រាផ្ទេរប្រាក់</a>
                    </li>
                    <li title="code:4.7">
                        <a href="{{ route('moneytransfer.index') }}" style="" class="">7. របាយការណ៏ផ្ទេរប្រាក់</a>
                    </li>
                    <li title="code:4.8">
                        <a href="{{ route('moneytransfer.sendpartnerslip') }}" style="" class="">8. ផ្ញើអោយដៃគូ</a>
                    </li>
                    <li title="code:4.9">
                        <a href="{{ route('moneytransfer.update_delete_report') }}" style="" class="">9. របាយការណ៏កែលុប</a>
                    </li>
                </ul>
            </li>
            <li>
                <a title="code:11" href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-space-shuttle'></i>
                    </div>
                    <div class="menu-title" style="">វេរពីថៃ</div>
                </a>
                <ul>
                    <li title="code:11.1"> <a href="{{ route('thaicashdraw.thaisms') }}" style="">1. សារថៃ</a>
                    </li>
                    <li title="code:11.2"> <a href="{{ route('thaicashdraw.cashdraw') }}" style="">2. បើកលុយថៃ</a>
                    </li>
                    <li title="code:11.3"> <a href="{{ route('thaicashdraw.cashdraw1') }}" style="">3. ទំនាក់ទំនងអតិថិជន</a>
                    </li>
                    <li title="code:11.4"> <a href="{{ route('thaicashdraw.accountregister') }}" style="">4. ចុះលេខបញ្ជី</a>
                    </li>
                    <li title="code:11.5"> <a href="{{ route('thaicashdraw.accountlistreport') }}" style="">5. របាយការណ៏លេខបញ្ជី</a>
                    </li>
                    <li title="code:11.6"> <a href="{{ route('thaicashdraw.closelist') }}" style="">6. កំណត់ទឹកប្រាក់បញ្ជី</a>
                    </li>
                     <li> <a href="{{ route('thaicashdraw.cashdrawreport') }}" >7. របាយការណ៏បើកវេរថៃ</a>
                    </li>
                    <li> <a href="{{ route('thaicashdraw.notyetcashdrawreport') }}" >8. របាយការណ៏ស្តុកថៃ</a>
                    </li>
                     <li> <a href="{{ route('thaicashdraw.registerthaicustomer') }}" >9. ចុះឈ្មោះអតិថិជនថៃ</a>
                    </li>
                </ul>
            </li>
            <li>
                <a title="code:8" href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-credit-card'></i>
                    </div>
                    <div class="menu-title" style="">បើកវេរ</div>
                </a>
                <ul>

                    <li title="code:8.1"> <a href="{{ route('moneytransfer.cashdraw') }}" style="">1. បើកវេរក្នុងស្រុក</a>
                    </li>
                    <li title="code:8.2"> <a href="{{ route('moneytransfer.cashdrawreport') }}" style="">2. របាយការណ៏បើកវេរ</a>
                    </li>
                    <li title="code:8.3"> <a href="{{ route('moneytransfer.notyetcashdrawreport') }}" style="">3. របាយការណ៏ស្តុក</a>
                    </li>
                    <li title="code:8.4"> <a href="{{ route('thaicashdraws.cashdrawreport') }}" style="">4. របាយការណ៏បើកវេរថៃ</a>
                    </li>
                </ul>
            </li>

            <li>
                <a title="code:5" href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-book'></i>
                    </div>
                    <div class="menu-title" style="">បញ្ជីដៃគូ</div>
                </a>
                <ul>

                    <li title="code:5.1"> <a href="{{ route('partnerlist.indexnew') }}" style="" target="_blank">1. សៀវភៅបញ្ជីថ្មី</a>
                    </li>
                    <li title="code:5.2">
                        <a href="{{ route('partnerlist.index') }}" style="" class="">2. សៀវភៅបញ្ជីចាស់</a>
                    </li>
                    <li title="code:5.3">
                        <a href="{{ route('partnerlist.alllist') }}" style="" class="">3. បញ្ជីដៃគូទាំំងអស់</a>
                    </li>
                    <li title="code:5.4">
                        <a href="{{ route('partnerlist.exchangelist',0) }}" style="" class="">4. កាត់កងបញ្ជីដៃគូ</a>
                    </li>
                    <li title="code:5.5">
                        <a href="{{ route('exchangelist.delkatkong') }}" style="" class="">5. របាយការណ៏កាត់កង</a>
                    </li>
                    <li title="code:5.6">
                        <a href="{{ route('partnerlist.exchangelistreport',0) }}" style="" class="">6. របាយការណ៏ទិញលក់</a>
                    </li>

                </ul>
            </li>

            <li>
                <a title="code:6" href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-bar-chart-o'></i>
                    </div>
                    <div class="menu-title" style="">របាយការណ៏</div>
                </a>
                <ul>
                    <li title="code:4.7"><a href="{{ route('moneytransfer.indexreport') }}" style="font-weight:100;" class="">* របាយការណ៏ផ្ទេរប្រាក់</a></li>
                    <li title="code:8.2"> <a href="{{ route('moneytransfer.cashdrawreportreport') }}" style="font-weight:100;">* របាយការណ៏បើកវេរ</a></li>
                    <li title="code:4.9"><a href="{{ route('moneytransfer.update_delete_report_report') }}" style="font-weight:100;" class="">* របាយការណ៏កែលុប</a></li>
                    <li title="code:3.2"> <a href="{{ route('exchangelistsreport') }}" style="font-weight:100;">* របាយការណ៏ប្តូរប្រាក់</a></li>
                    <li title="code:6.1">
                        <a href="{{ route('closelist.index') }}" style="" class="">1. បិទបញ្ជីប្រចាំថ្ងៃ</a>
                    </li>
                    <li title="code:6.2">
                        <a href="{{ route('closelist.report') }}" style="" class="">2. របាយការណ៏បិទបញ្ជី</a>
                    </li>
                    <li title="code:6.3">
                        <a href="{{ route('closelist.summaryreport') }}" style="" class="">3. របក បិទបញ្ជីសង្ខេប</a>
                    </li>
                    <li title="code:6.4">
                        <a href="{{ route('report.transferprofit') }}" style="" class="">4. ប្រាក់ចំណេញផ្ទេរប្រាក់</a>
                    </li>

                    <li title="code:6.8">
                        <a href="{{ route('expanseincome.report') }}" style="" class="">5. ចំណូលចំណាយ</a>
                    </li>

                </ul>
            </li>

            <li>
                <a title="code:6" href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-bar-chart-o'></i>
                    </div>
                    <div class="menu-title" style="">ស្តុក</div>
                </a>
                <ul>

                    <li title="code:6.5">
                        <a href="{{ route('stock.report') }}" style="" class="">1. របាយការណ៌ស្តុក</a>
                    </li>
                     <li title="code:6.6">
                        <a href="{{ route('stock.buysalegoldreport') }}" style="" class="">2. របាយការណ៌ទិញលក់មាស</a>
                    </li>
                    {{-- <li title="code:6.6">
                        <a href="{{ route('stock.reportbuysale') }}" style="" class="">2. របាយការណ៏ទិញលក់</a>
                    </li> --}}
                    <li title="code:6.7">
                        <a href="{{ route('stock.index') }}" style="" class="">3. ព៌តមានស្តុក</a>
                    </li>


                </ul>
            </li>

            <li>
                <a title="code:7" href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-address-book-o'></i>
                    </div>
                    <div class="menu-title" style="">ចុះឈ្មោះ</div>
                </a>
                <ul>
                    <li title="code:7.1">
                        <a href="{{ route('customer.index') }}" style="" class="">1. អតិថិជន</a>
                    </li>
                    <li title="code:7.4">
                        <a href="{{ route('userregister') }}" style="" class="">2. បុគ្គលិក</a>
                    </li>
                    <li title="code:7.5">
                        <a href="{{ route('company.register') }}" style="" class="">3. យីហោអាជីវកម្ម</a>
                    </li>
                    <li title="code:7.2">
                        <a href="{{ route('child.index') }}" style="" class="">4. ចុះឈ្មោះកូនសាខា</a>
                    </li>
                    <li title="code:7.3">
                        <a href="{{ route('address.index') }}" style="" class="">5. ចុះឈ្មោះខេត្តក្រុង</a>
                    </li>
                </ul>
            </li>


        </ul>


    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
