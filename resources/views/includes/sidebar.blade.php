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
        <div class="sidebar-header" style="margin:0px;padding:0px;background-color:{{ $com->logobg }}">
            <div>
                <table>

                    <tr>
                        <td>
                            <a href="{{ route('dashboard') }}" class="" style="">
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
            <li id="code0" style="display:none;">
                <a href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-desktop'></i>
                    </div>
                    <div class="menu-title" style="">ពេញនិយម</div>
                </a>
                <ul>
                    <li id="code0_1" style="display:none;"> <a href="{{ route('thaicashdraw.thaisms_pop') }}" style="">01. សារថៃ</a>
                    </li>
                    <li id="code0_2" style="display:none;"> <a href="{{ route('thaicashdraw.cashdraw_pop') }}" style="">02. បើកលុយថៃ</a>
                    </li>
                    <li id="code0_3" style="display:none;"> <a href="{{ route('thaicashdraw.cashdraw1_pop') }}" style="">03. ទំនាក់ទំនងអតិថិជន</a>
                    </li>
                    <li id="code0_4" style="display:none;"> <a href="{{ route('moneytransfer.formtransfer_pop') }}" style="">04. ផ្ទេរប្រាក់</a>
                    </li>
                    <li id="code0_5" style="display:none;"> <a href="{{ route('moneytransfer.banktransfer_pop') }}" style="">05. បាញ់ឆ្លងធនាគា</a>
                    </li>
                    <li id="code0_6" style="display:none;"> <a href="{{ route('moneytransfer.wingtransfer_pop') }}" style="">06. វេរតាមវីង</a>
                    </li>
                    <li id="code0_7" style="display:none;"> <a href="{{ route('moneytransfer.customertransfer_pop') }}" style="">07. ដាក់ដកអតិថិជន</a>
                    </li>
                    <li id="code0_8" style="display:none;"> <a href="{{ route('moneytransfer.quicktransfer_pop') }}" style="">08. ដាក់ដករហ័ស</a>
                    </li>
                    <li id="code0_9" style="display:none;"> <a href="{{ route('exchange.index_pop') }}" @if(config('helper.exchange_auto_capture')==1) onclick="window.open('{{ route('exchange.recognit') }}', 'recognitWindow');" @endif style="">09. ប្តូរប្រាក់</a>
                    </li>
                    <li id="code0_10" style="display:none;"> <a href="{{ route('moneytransfer.cashdraw_pop') }}" style="">10. បើកវេរក្នុងស្រុក</a>
                    </li>
                    <li id="code0_11" style="display:none;"> <a href="{{ route('usercapital.index_pop') }}" style="">11. ដើមទុនបុគ្គលិក</a>
                    </li>
                    <li id="code0_12" style="display:none;"> <a href="{{ route('usercapital.closelist_pop') }}" style="">12. បិទបញ្ជីបុគ្គលិក</a>
                    </li>
                    <li id="code0_13" style="display:none;"> <a href="{{ route('usercapital.usertransactionreport_pop') }}" style="">13. ប្រតិបត្តិការណ៏បុគ្គលិក</a>
                    </li>
                    <li id="code0_14" style="display:none;"> <a href="{{ route('expanseincome.index_pop') }}" style="">14. ចំណូលចំណាយ</a>
                    </li>
                    <li id="code0_15" style="display:none;"> <a href="{{ route('partnerlist.indexnew_pop') }}" style="" target="_blank">15. សៀវភៅបញ្ជីថ្មី</a>
                    </li>
                    <li id="code0_16" style="display:none;">
                        <a href="{{ route('partnerlist.exchangelist_pop',0) }}" style="" class="">16. កាត់កងបញ្ជីដៃគូ</a>
                    </li>
                    <li id="code0_17" style="display:none;">
                        <a href="{{ route('closelist.index_pop') }}" style="" class="">17. បិទបញ្ជីប្រចាំថ្ងៃ</a>
                    </li>
                </ul>
            </li>
            <li id="code1" style="display:none;">
                <a href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-bank'></i>
                    </div>
                    <div class="menu-title" style="">អចលនទ្រព្យ</div>
                </a>

                <ul>
                    <li id="code1_6" style="display:none;"> <a href="{{ route('realestate.docontract') }}" style="" target="_blank">1. ធ្វើកុងត្រា</a>
                    </li>
                    <li id="code1_1" style="display:none;"> <a href="{{ route('realestate.index') }}" style="">2. លក់</a>
                    </li>
                    <li id="code1_2" style="display:none;"> <a href="{{ route('realestate.soldpropertylist') }}" style="">3. តារាងលក់</a>
                    </li>
                    <li id="code1_3" style="display:none;"> <a href="{{ route('realestate.customerromloslist') }}" style="">4. អ្នកទិញបង់រំលស់</a>
                    </li>
                    {{-- <li id="code1_4" style="display:none;"> <a href="{{ route('realestate.romloslist') }}" style="">4. តារាងបង់រំលស់</a>
                    </li>
                    <li id="code1_5" style="display:none;"> <a href="{{ route('realestate.paymentlist') }}" style="">5. តារាងបង់ប្រាក់</a>
                    </li> --}}
                    <li id="code1_4" style="display:none;"> <a href="{{ route('realestate.commissionlist') }}" style="">5. ទូទាត់កម្រៃជើងសារ</a>
                    </li>
                    <li id="code1_12" style="display:none;"> <a href="{{ route('realestate.commissionlistall') }}" style="">6. ទូទាត់កម្រៃជើងសារសរុប</a>
                    </li>
                    <li id="code1_5" style="display:none;"> <a href="{{ route('land.index') }}" style="">7. ចុះឈ្មោះអចលនទ្រព្យ</a>
                    </li>

                    <li id="code1_7" style="display:none;"> <a href="{{ route('realestate.incomeexpansereport') }}" style="" target="_blank">8. ចំណូលចំណាយលក់</a>
                    </li>
                    <li id="code1_8" style="display:none;"> <a href="{{ route('realestate.generalexpanse') }}" style="" target="_blank">9. ចំណូលចំណាយទូទៅ</a>
                    </li>
                    <li id="code1_9" style="display:none;"> <a href="{{ route('realestate.closelist') }}" style="" target="_blank">10. បិទបញ្ជីប្រចាំខែ</a>
                    </li>
                    <li id="code1_10" style="display:none;"> <a href="{{ route('deletepropertysold') }}" style="" target="_blank">11. លុបអចលលក់រួច</a>
                    </li>
                    <li id="code1_11" style="display:none;"> <a href="{{ route('realestate.commissionreport') }}" style="" target="_blank">12. របាយការណ៏កម្រៃជើងសារ</a>
                    </li>
                </ul>
            </li>
            <li id="code2" style="display:none;">
                <a href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-money'></i>
                    </div>
                    <div class="menu-title" style="">ដើមទុន</div>
                </a>
                <ul>
                    <li id="code2_1" style="display:none;"> <a href="{{ route('usercapital.index') }}" style="">1. ដើមទុនបុគ្គលិក</a>
                    </li>
                    <li id="code2_2" style="display:none;"> <a href="{{ route('usercapital.closelist') }}" style="">2. បិទបញ្ជីបុគ្គលិក</a>
                    </li>
                    <li id="code2_3" style="display:none;"> <a href="{{ route('usercapital.usertransactionreport') }}" style="">3. ប្រតិបត្តិការណ៏បុគ្គលិក</a>
                    </li>
                    <li id="code2_4" style="display:none;"> <a href="{{ route('usercapital.moneyoffer') }}" style="">4. បុគ្គលិកស្នើរប្រាក់</a>
                    </li>
                    <li id="code2_5" style="display:none;"> <a href="{{ route('expanseincome.inusercapital') }}" style="">5. ចំណូលចំណាយ</a>
                    </li>
                </ul>
            </li>
            <li id="code3" style="display:none;">
                <a href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-calculator'></i>
                    </div>
                    <div class="menu-title" style="">ប្តូរប្រាក់</div>
                </a>
                <ul>
                    <li id="code3_1" style="display:none;">
                        <a
                            href="{{ route('exchange.index') }}"
                            @if(config('helper.exchange_auto_capture')==1) onclick="window.open('{{ route('exchange.recognit') }}', 'recognitWindow');" @endif
                            style="">1. ប្តូរប្រាក់
                        </a>

                    </li>
                    <li id="code3_2" style="display:none;"> <a href="{{ route('exchangelists') }}" style="">2. របាយការណ៏ប្តូរប្រាក់</a>
                    </li>
                    <li id="code3_3" style="display:none;">
                        <a href="{{ route('currency.exchangeratenew') }}" style="" class="">3. កំណត់អត្រាប្តូរប្រាក់ថ្មី</a>
                    </li>
                    <li id="code3_4" style="display:none;">
                        <a href="{{ route('usercapital.userprofit') }}" style="" class="">4. ប្រាក់ចំណេញ</a>
                    </li>
                    <li id="code3_5" style="display:none;">
                        <a href="{{ route('currency.index') }}" style="" class="">5. កំណត់រូបិយប័ណ្ណ</a>
                    </li>
                    <li id="code3_6" style="display:none;">
                        <a href="{{ route('currency.ratedisplayforcustomer') }}" style="" class="" target="_blank">6. ផ្ទាំំងបង្ហោះអត្រាប្តូរប្រាក់</a>
                    </li>
                    <li id="code3_7" style="display:none;">
                        <a href="{{ route('currency.ratedisplaytv') }}" style="" class="" target="_blank">7. ប៉ុស្តិ៍អត្រាប្តូរប្រាក់</a>
                    </li>
                </ul>
            </li>
            <li id="code4" style="display:none;">
                <a href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-paper-plane'></i>
                    </div>
                    <div class="menu-title" style="">វេរលុយ</div>
                </a>
                <ul>
                    <li id="code4_1" style="display:none;"> <a href="{{ route('moneytransfer.formtransfer') }}" style="">1. ផ្ទេរប្រាក់</a>
                    </li>
                    <li id="code4_2" style="display:none;"> <a href="{{ route('moneytransfer.banktransfer') }}" style="">2. បាញ់ឆ្លងធនាគា</a>
                    </li>
                    <li id="code4_3" style="display:none;"> <a href="{{ route('moneytransfer.wingtransfer') }}" style="">3. វេរតាមភ្នាក់ងារ</a>
                    </li>
                    <li id="code4_4" style="display:none;"> <a href="{{ route('moneytransfer.customertransfer') }}" style="">4. ដាក់ដកអតិថិជន</a>
                    </li>
                    <li id="code4_5" style="display:none;"> <a href="{{ route('moneytransfer.quicktransfer') }}" style="">5. ដាក់ដករហ័ស</a>
                    </li>
                    <li id="code4_6" style="display:none;">
                        <a href="{{ route('moneytransfer.settransferrate') }}" style="" class="">6. កំណត់អត្រាផ្ទេរប្រាក់</a>
                    </li>
                    <li id="code4_7" style="display:none;">
                        <a href="{{ route('moneytransfer.index') }}" style="" class="">7. របាយការណ៏ផ្ទេរប្រាក់</a>
                    </li>
                    <li id="code4_8" style="display:none;">
                        <a href="{{ route('moneytransfer.sendpartnerslip') }}" style="" class="">8. ផ្ញើអោយដៃគូ</a>
                    </li>
                     <li id="code4_9" style="display:none;">
                        <a href="{{ route('moneytransfer.update_delete_report') }}" style="" class="">9. របាយការណ៏កែលុប</a>
                    </li>
                </ul>
            </li>
            <li id="code11" style="display:none;">
                <a href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-space-shuttle'></i>
                    </div>
                    <div class="menu-title" style="">វេរពីថៃ</div>
                </a>
                <ul>
                    <li id="code11_1" style="display:none;"> <a href="{{ route('thaicashdraw.thaisms') }}" style="">1. សារថៃ</a>
                    </li>
                    <li id="code11_2" style="display:none;"> <a href="{{ route('thaicashdraw.cashdraw') }}" style="">2. បើកលុយថៃ</a>
                    </li>
                    <li id="code11_3" style="display:none;"> <a href="{{ route('thaicashdraw.cashdraw1') }}" style="">3. ទំនាក់ទំនងអតិថិជន</a>
                    </li>
                </ul>
            </li>

            <li id="code8" style="display:none;">
                <a href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-credit-card'></i>
                    </div>
                    <div class="menu-title" style="">បើកវេរ</div>
                </a>
                <ul>
                    <li id="code8_1" style="display:none;"> <a href="{{ route('moneytransfer.cashdraw') }}" style="">1. បើកវេរក្នុងស្រុក</a>
                    </li>
                    <li id="code8_2" style="display:none;"> <a href="{{ route('moneytransfer.cashdrawreport') }}" style="">2. របាយការណ៏បើកវេរ</a>
                    </li>
                    <li id="code8_3" style="display:none;"> <a href="{{ route('moneytransfer.notyetcashdrawreport') }}" style="">3. របាយការណ៏ស្តុក</a>
                    </li>
                    <li id="code8_4" style="display:none;"> <a href="{{ route('thaicashdraws.cashdrawreport') }}" style="">4. របាយការណ៏បើកវេរថៃ</a>
                    </li>
                </ul>
            </li>


            <li id="code5" style="display:none;">
                <a href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-book'></i>
                    </div>
                    <div class="menu-title" style="">បញ្ជីដៃគូ</div>
                </a>
                <ul>

                    <li id="code5_1" style="display:none;"> <a href="{{ route('partnerlist.indexnew') }}" style="" target="_blank">1. សៀវភៅបញ្ជីថ្មី</a>
                    </li>
                    <li id="code5_2" style="display:none;">
                        <a href="{{ route('partnerlist.index') }}" style="" class="">2. សៀវភៅបញ្ជីចាស់</a>
                    </li>
                    <li id="code5_3" style="display:none;">
                        <a href="{{ route('partnerlist.alllist') }}" style="" class="">3. បញ្ជីដៃគូទាំំងអស់</a>
                    </li>
                    <li id="code5_4" style="display:none;">
                        <a href="{{ route('partnerlist.exchangelist',0) }}" style="" class="">4. កាត់កងបញ្ជីដៃគូ</a>
                    </li>
                    <li id="code5_5" style="display:none;">
                        <a href="{{ route('exchangelist.delkatkong') }}" style="" class="">5. របាយការណ៏កាត់កង</a>
                    </li>
                    <li id="code5_6" style="display:none;">
                        <a href="{{ route('partnerlist.exchangelistreport',0) }}" style="" class="">6. របាយការណ៏ទិញលក់</a>
                    </li>

                </ul>
            </li>

            <li id="code6" style="display:none;">
                <a href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-bar-chart-o'></i>
                    </div>
                    <div class="menu-title" style="">របាយការណ៏</div>
                </a>
                <ul>

                    <li id="code6_1" style="display:none;">
                        <a href="{{ route('closelist.index') }}" style="" class="">1. បិទបញ្ជីប្រចាំថ្ងៃ</a>
                    </li>
                    <li id="code6_2" style="display:none;">
                        <a href="{{ route('closelist.report') }}" style="" class="">2. របាយការណ៏បិទបញ្ជី</a>
                    </li>
                    <li id="code6_3" style="display:none;">
                        <a href="{{ route('closelist.summaryreport') }}" style="" class="">3. របក បិទបញ្ជីសង្ខេប</a>
                    </li>
                    <li id="code6_4" style="display:none;">
                        <a href="{{ route('report.transferprofit') }}" style="" class="">4. ប្រាក់ចំណេញផ្ទេរប្រាក់</a>
                    </li>
                    <li id="code6_5" style="display:none;">
                        <a href="{{ route('stock.report') }}" style="" class="">5. របាយការណ៌ស្តុក</a>
                    </li>
                    {{-- <li id="code6_6" style="display:none;">
                        <a href="{{ route('stock.reportbuysale') }}" style="" class="">6. របាយការណ៏ទិញលក់</a>
                    </li> --}}
                    <li id="code6_7" style="display:none;">
                        <a href="{{ route('stock.index') }}" style="" class="">6. ព៌តមានស្តុក</a>
                    </li>
                     <li id="code6_8" style="display:none;">
                        <a href="{{ route('expanseincome.report') }}" style="" class="">7. ចំណូលចំណាយ</a>
                    </li>
                </ul>
            </li>

            <li id="code7" style="display:none;">
                <a href="javascript:;" class="has-arrow" style="">
                    <div class="parent-icon"><i class='fa fa-address-book-o'></i>
                    </div>
                    <div class="menu-title" style="">ចុះឈ្មោះ</div>
                </a>
                <ul>


                    <li id="code7_1" style="display:none;">
                        <a href="{{ route('customer.index') }}" style="" class="">1. អតិថិជន</a>
                    </li>
                    <li id="code7_4" style="display:none;">
                        <a href="{{ route('userregister') }}" style="" class="">2. បុគ្គលិក</a>
                    </li>
                    <li id="code7_5" style="display:none;">
                        <a href="{{ route('company.register') }}" style="" class="">3. យីហោអាជីវកម្ម</a>
                    </li>
                    <li id="code7_2" style="display:none;">
                        <a href="{{ route('child.index') }}" style="" class="">4. កូនសាខា</a>
                    </li>
                    <li id="code7_3" style="display:none;">
                        <a href="{{ route('address.index') }}" style="" class="">5. ខេត្តក្រុង</a>
                    </li>
                </ul>
            </li>


        </ul>


    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
