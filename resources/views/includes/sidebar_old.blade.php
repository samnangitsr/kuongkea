<!--sidebar wrapper -->
<style>
    ul.metismenu li{
        background-color:rgb(204, 235, 220);
    }

    ul.metismenu li:hover{
        background-color:aquamarine;
    }
</style>
<div class="sidebar-wrapper" data-simplebar="true">
    @foreach (App\Company::getbranceinfo() as $com)
        <div class="sidebar-header" style="margin:0px;padding:0px;background-color:{{ $com->logobg }}">
            <div>
                <table>

                    <tr>
                        <td><a href="{{ route('dashboard') }}" class="" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                            {{-- <img src="{{ asset('public/logo') }}/myapplogo.png" class="logo-icon" alt="logo icon" > --}}
                            <img src="{{ $com->logo <> '' ? asset('public/logo/'. $com->logo):'' }}" alt="" style="width:{{ $com->logosize }}">
                        </a>
                        </td>
                        <td style="padding-left:5px;">
                            <a href="{{ route('dashboard') }}" class="" style="font-family: 'khmer os muol light';font-size:16px;text-shadow: 2px 2px 4px #000000;color:{{ $com->textcolor }}">
                                {{-- {{ config('helper.system_title') }} <br> {{ config('helper.system_subtitle') }} --}}
                                {{ $com->name }} <br> {{ $com->subtext }}

                            </a>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left' style="color:darkgreen;"></i>
            </div>
        </div>
    @endforeach
    <!--navigation-->


        <ul class="metismenu" id="menu" style="">

                <li>
                    <a href="javascript:;" class="has-arrow" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                        <div class="parent-icon"><i class='fa fa-desktop'></i>
                        </div>
                        <div class="menu-title" style="font-family:khmer os muol light;display:none;">ពេញនិយម</div>
                    </a>
                    <ul>

                        @if (App\User::checkpermission(Auth::id(),2.1))
                            <li> <a href="{{ route('thaicashdraw.thaisms_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">01. សារថៃ</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.2))
                            <li> <a href="{{ route('thaicashdraw.cashdraw_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">02. បើកលុយថៃ</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.3))
                            <li> <a href="{{ route('thaicashdraw.cashdraw1_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">03. ទំនាក់ទំនងអតិថិជន</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.4))
                            <li> <a href="{{ route('moneytransfer.formtransfer_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">04. ផ្ទេរប្រាក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.5))
                            <li> <a href="{{ route('moneytransfer.banktransfer_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">05. បាញ់ឆ្លងធនាគា</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.6))
                            <li> <a href="{{ route('moneytransfer.wingtransfer_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">06. វេរតាមវីង</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.7))
                            <li> <a href="{{ route('moneytransfer.customertransfer_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">07. ដាក់ដកអតិថិជន</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.8))
                            <li> <a href="{{ route('moneytransfer.quicktransfer_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">08. ដាក់ដករហ័ស</a>
                            </li>
                        @endif
                        <li> <a href="{{ route('exchange.index_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">09. ប្តូរប្រាក់</a>
                        </li>
                        <li> <a href="{{ route('moneytransfer.cashdraw_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">10. បើកវេរក្នុងស្រុក</a>
                        </li>
                        <li> <a href="{{ route('usercapital.index_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">11. ដើមទុនបុគ្គលិក</a>
                        </li>
                        <li> <a href="{{ route('usercapital.closelist_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">12. បិទបញ្ជីបុគ្គលិក</a>
                        </li>
                        <li> <a href="{{ route('usercapital.usertransactionreport_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">13. ប្រតិបត្តិការណ៏បុគ្គលិក</a>
                        </li>
                        <li> <a href="{{ route('expanseincome.index_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;">14. ចំណូលចំណាយ</a>
                        </li>
                        <li> <a href="{{ route('partnerlist.indexnew_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;" target="_blank">15. សៀវភៅបញ្ជីថ្មី</a>
                        </li>
                        <li>
                            <a href="{{ route('partnerlist.exchangelist_pop',0) }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;" class="">16. កាត់កងបញ្ជីដៃគូ</a>
                        </li>
                        <li>
                            <a href="{{ route('closelist.index_pop') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;" class="">17. បិទបញ្ជីប្រចាំថ្ងៃ</a>
                        </li>
                    </ul>
                </li>
                <li>
                    @if (App\User::checkpermission(Auth::id(),1))
                        <a href="javascript:;" class="has-arrow" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                            <div class="parent-icon"><i class='fa fa-bank'></i>
                            </div>
                            <div class="menu-title" style="font-family:khmer os muol light;">អចលនទ្រព្យ</div>
                        </a>
                    @endif
                    <ul>
                        @if (App\User::checkpermission(Auth::id(),1.1))
                            <li> <a href="{{ route('realestate.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">1. លក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),1.2))
                            <li> <a href="{{ route('realestate.soldpropertylist') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">2. តារាងលក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),1.3))
                            <li> <a href="{{ route('realestate.customerromloslist') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">3. អ្នកទិញបង់រំលស់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),1.4))
                            <li> <a href="{{ route('realestate.romloslist') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">4. តារាងបង់រំលស់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),1.5))
                            <li> <a href="{{ route('realestate.paymentlist') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">5. តារាងបង់ប្រាក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),1.6))
                            <li> <a href="{{ route('realestate.commissionlist') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">6. ទូទាត់កម្រៃជើងសារ</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),1.7))
                            <li> <a href="{{ route('land.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">7. ចុះឈ្មោះអចលនទ្រព្យ</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),1.8))
                            <li> <a href="{{ route('realestate.docontract') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" target="_blank">8. ធ្វើកុងត្រា</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),1.9))
                            <li> <a href="{{ route('realestate.incomeexpansereport') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" target="_blank">9. ចំណូលចំណាយលក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),1.10))
                            <li> <a href="{{ route('realestate.generalexpanse') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" target="_blank">10. ចំណូលចំណាយទូទៅ</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li>
                    @if (App\User::checkpermission(Auth::id(),2))
                        <a href="javascript:;" class="has-arrow" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                            <div class="parent-icon"><i class='fa fa-paper-plane'></i>
                            </div>
                            <div class="menu-title" style="font-family:khmer os muol light;">វេរលុយ</div>
                        </a>
                    @endif
                    <ul>
                        @if (App\User::checkpermission(Auth::id(),2.4))
                            <li> <a href="{{ route('moneytransfer.formtransfer') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">1. ផ្ទេរប្រាក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.5))
                            <li> <a href="{{ route('moneytransfer.banktransfer') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">2. បាញ់ឆ្លងធនាគា</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.6))
                            <li> <a href="{{ route('moneytransfer.wingtransfer') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">3. វេរតាមវីង</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.7))
                            <li> <a href="{{ route('moneytransfer.customertransfer') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">4. ដាក់ដកអតិថិជន</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.8))
                            <li> <a href="{{ route('moneytransfer.quicktransfer') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">5. ដាក់ដករហ័ស</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.9))
                            <li>
                                <a href="{{ route('moneytransfer.settransferrate') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">6. កំណត់អត្រាផ្ទេរប្រាក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.10))
                            <li>
                                <a href="{{ route('moneytransfer.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">7. របាយការណ៏ផ្ទេរប្រាក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),2.11))
                            <li>
                                <a href="{{ route('moneytransfer.sendpartnerslip') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">8. ផ្ញើអោយដៃគូ</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li>
                    @if (App\User::checkpermission(Auth::id(),2))
                        <a href="javascript:;" class="has-arrow" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                            <div class="parent-icon"><i class='fa fa-space-shuttle'></i>
                            </div>
                            <div class="menu-title" style="font-family:khmer os muol light;">លុយថៃ</div>
                        </a>
                    @endif
                    <ul>
                        @if (App\User::checkpermission(Auth::id(),'2.1'))
                        <li> <a href="{{ route('thaicashdraw.thaisms') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">1. សារថៃ</a>
                        </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),'2.2'))
                        <li> <a href="{{ route('thaicashdraw.cashdraw') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">2. បើកលុយថៃ</a>
                        </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),'2.3'))
                        <li> <a href="{{ route('thaicashdraw.cashdraw1') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">3. ទំនាក់ទំនងអតិថិជន</a>
                        </li>
                        @endif

                    </ul>
                </li>
                <li>
                    @if (App\User::checkpermission(Auth::id(),3))
                        <a href="javascript:;" class="has-arrow" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                            <div class="parent-icon"><i class='fa fa-calculator'></i>
                            </div>
                            <div class="menu-title" style="font-family:khmer os muol light;">ប្តូរប្រាក់</div>
                        </a>
                    @endif
                    <ul>
                        @if (App\User::checkpermission(Auth::id(),3.1))
                            <li> <a href="{{ route('exchange.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">1. ប្តូរប្រាក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),3.2))
                            <li> <a href="{{ route('exchangelists') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">2. របាយការណ៏ប្តូរប្រាក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),3.3))
                            <li>
                                <a href="{{ route('currency.exchangeratenew') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">3. កំណត់អត្រាប្តូរប្រាក់ថ្មី</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),3.4))
                            <li>
                                <a href="{{ route('usercapital.userprofit') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">4. ប្រាក់ចំណេញ</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),3.5))
                            <li>
                                <a href="{{ route('currency.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">5. កំណត់រូបិយប័ណ្ណ</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),3.6))
                            <li>
                                <a href="{{ route('currency.ratedisplayforcustomer') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="" target="_blank">6. ផ្ទាំំងបង្ហោះអត្រាប្តូរប្រាក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),3.7))
                            <li>
                                <a href="{{ route('currency.ratedisplaytv') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="" target="_blank">7. Display Rate Board</a>
                            </li>
                        @endif

                    </ul>
                </li>
                <li>
                    @if (App\User::checkpermission(Auth::id(),8))
                        <a href="javascript:;" class="has-arrow" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                            <div class="parent-icon"><i class='fa fa-credit-card'></i>
                            </div>
                            <div class="menu-title" style="font-family:khmer os muol light;">បើកវេរ</div>
                        </a>
                    @endif
                    <ul>
                        @if (App\User::checkpermission(Auth::id(),8.1))
                            <li> <a href="{{ route('moneytransfer.cashdraw') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">1. បើកវេរក្នុងស្រុក</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),8.2))
                        <li> <a href="{{ route('moneytransfer.cashdrawreport') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;">2. របាយការណ៏បើកវេរ</a>
                        </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),8.3))
                        <li> <a href="{{ route('moneytransfer.notyetcashdrawreport') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;">3. របាយការណ៏ស្តុក</a>
                        </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),8.4))
                        <li> <a href="{{ route('thaicashdraws.cashdrawreport') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;">4. របាយការណ៏បើកវេរថៃ</a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li>
                    @if (App\User::checkpermission(Auth::id(),4))
                        <a href="javascript:;" class="has-arrow" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                            <div class="parent-icon"><i class='fa fa-money'></i>
                            </div>
                            <div class="menu-title" style="font-family:khmer os muol light;">ដើមទុន</div>
                        </a>
                    @endif
                    <ul>
                        @if (App\User::checkpermission(Auth::id(),4.1))
                            <li> <a href="{{ route('usercapital.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">1. ដើមទុនបុគ្គលិក</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),4.2))
                            <li> <a href="{{ route('usercapital.closelist') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">2. បិទបញ្ជីបុគ្គលិក</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),4.3))
                            <li> <a href="{{ route('usercapital.usertransactionreport') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">3. ប្រតិបត្តិការណ៏បុគ្គលិក</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),4.4))
                            <li> <a href="{{ route('usercapital.moneyoffer') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">4. បុគ្គលិកស្នើរប្រាក់</a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li>
                    @if (App\User::checkpermission(Auth::id(),5))
                        <a href="javascript:;" class="has-arrow" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                            <div class="parent-icon"><i class='fa fa-book'></i>
                            </div>
                            <div class="menu-title" style="font-family:khmer os muol light;">បញ្ជីដៃគូ</div>
                        </a>
                    @endif
                    <ul>
                        @if (App\User::checkpermission(Auth::id(),5.1))
                        <li> <a href="{{ route('partnerlist.indexnew') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" target="_blank">1. សៀវភៅបញ្ជីថ្មី</a>
                        </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),5.2))
                        <li>
                            <a href="{{ route('partnerlist.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">2. សៀវភៅបញ្ជីចាស់</a>
                        </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),5.3))
                        <li>
                            <a href="{{ route('partnerlist.alllist') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">3. បញ្ជីដៃគូទាំំងអស់</a>
                        </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),5.4))
                        <li>
                            <a href="{{ route('partnerlist.exchangelist',0) }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">4. កាត់កងបញ្ជីដៃគូ</a>
                        </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),5.5))
                        <li>
                            <a href="{{ route('exchangelist.delkatkong') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">5. លុបកាត់កង</a>
                        </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),5.6))
                        <li>
                            <a href="{{ route('partnerlist.exchangelistreport',0) }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">6. របាយការណ៏កាត់កង</a>
                        </li>
                        @endif
                    </ul>
                </li>

                <li>
                    @if (App\User::checkpermission(Auth::id(),6))
                        <a href="javascript:;" class="has-arrow" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                            <div class="parent-icon"><i class='fa fa-bar-chart-o'></i>
                            </div>
                            <div class="menu-title" style="font-family:khmer os muol light;">របាយការណ៏</div>
                        </a>
                    @endif
                    <ul>
                        @if (App\User::checkpermission(Auth::id(),6.1))
                            <li>
                                <a href="{{ route('closelist.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">1. បិទបញ្ជីប្រចាំថ្ងៃ</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),6.2))
                            <li>
                                <a href="{{ route('closelist.report') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">2. របាយការណ៏បិទបញ្ជី</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),6.3))
                            <li>
                                <a href="{{ route('closelist.summaryreport') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">3. របក បិទបញ្ជីសង្ខេប</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),6.4))
                            <li>
                                <a href="{{ route('report.transferprofit') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">4. ប្រាក់ចំណេញផ្ទេរប្រាក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),6.5))
                            <li>
                                <a href="{{ route('stock.report') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">5. របាយការណ៌ស្តុក</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),6.6))
                            <li>
                                <a href="{{ route('stock.reportbuysale') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">6. របាយការណ៏ទិញលក់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),6.7))
                            <li>
                                <a href="{{ route('stock.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">7. ព៌តមានស្តុក</a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li>
                    @if (App\User::checkpermission(Auth::id(),7))
                        <a href="javascript:;" class="has-arrow" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">
                            <div class="parent-icon"><i class='fa fa-address-book-o'></i>
                            </div>
                            <div class="menu-title" style="font-family:khmer os muol light;">ចុះឈ្មោះ</div>
                        </a>
                    @endif
                    <ul>

                        @if (App\User::checkpermission(Auth::id(),7.1))
                            <li>
                                <a href="{{ route('customer.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">1. ចុះឈ្មោះអតិថិជន</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),7.2))
                            <li>
                                <a href="{{ route('child.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">2. ចុះឈ្មោះកូនសាខា</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),7.3))
                            <li>
                                <a href="{{ route('address.index') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">3. ចុះឈ្មោះខេត្តក្រុង</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),7.4))
                            <li>
                                <a href="{{ route('userregister') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">4. ចុះឈ្មោះអ្នកប្រើប្រាស់</a>
                            </li>
                        @endif
                        @if (App\User::checkpermission(Auth::id(),7.5))
                            <li>
                                <a href="{{ route('company.register') }}" style="font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;" class="">5. ចុះឈ្មោះក្រុមហ៊ុន</a>
                            </li>
                        @endif

                    </ul>
                </li>




        </ul>


    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
