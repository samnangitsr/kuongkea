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

    <table id="tbl_notyetcashdraw" class="table table-bordered kh12" style="table-layout:fixed;padding:0px;margin:0px;">

        <thead class="" style="text-align:center;">
            <th style="width:60px;">លរ</th>
            <th style="width:100px;">SMSID</th>
            <th style="width:200px;">ថ្ងៃវេរចូល</th>
            <th style="width:200px;">វេរមកពី</th>
            <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
            <th style="width:250px;">Action</th>
            <th style="width:150px;">ឈ្មោះអ្នកទទួល</th>
            <th style="width:150px;">លេខអ្នកទទួល</th>
            <th style="text-align:left;width:1500px;">សារ</th>
        </thead>

        <tbody id="">
            @foreach ($notyetcashdraws as $key => $d)
                    <tr class="rowclick">
                        <td class="kh12-b" style="text-align:center;padding:5px 0px;">{{ ++$key }}</td>
                        <td class="kh14-b"  style="">
                            <a href="#c{{ $d->id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" title="{{ $d->smsid }}">{{ $d->id }}</a>
                        </td>
                        <td class="kh12-b" style="">{{ date('d-m-Y',strtotime($d->smsdate)) . "(" . $d->smstime . ")"}}</td>
                        <td class="kh12-b" style="">{{ $d->sendfrom . "(" . $d->account . ")"}}</td>
                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($d->amount) . ' ' . $d->cur }}</td>
                        <td style="text-align:right;">
                            <div class="dropdown" style="display:inline;">
                                <button style="width:80px;" type="button" class="btn btn-primary btn-sm dropdown-toggle kh12-b" data-bs-toggle="dropdown">
                                    បើកលុយ
                                </button>
                                <ul class="dropdown-menu" style="padding:5px;background-color:azure;">

                                    <li style="background-color:rgb(199, 224, 226);padding:5px;">
                                        <a href="#" class="dropdown btnopencashdraw kh16-b" data-classname="btnopencashdraw" data-id="{{ $d->id }}" data-code="{{ $d->smsid }}">បើកលុយ</a>
                                    </li>
                                    <li style="background-color:rgb(199, 224, 226);padding:5px;">
                                        <a href="#" class="dropdown btncontinuepartner kh16-b" data-classname="btncontinuepartner"  data-id="{{ $d->id }}" data-code="{{ $d->smsid }}">បន្តតាមដៃគូ</a>
                                    </li>
                                    <li style="background-color:rgb(199, 224, 226);padding:5px;">
                                        <a href="#" class="dropdown btncontinuewingbank kh16-b" data-classname="btncontinuewingbank" data-id="{{ $d->id }}" data-code="{{ $d->smsid }}">បន្តតាមវីងឬធនាគា</a>
                                    </li>
                                    <li style="background-color:rgb(199, 224, 226);padding:5px;">
                                        <a href="#" style="" class="dropdown btnclearselect kh16-b" data-classname="btnclearselect" data-id="{{ $d->id }}" data-code="{{ $d->smsid }}">Clear Select</a>
                                    </li>
                                    <li style="background-color:rgb(199, 224, 226);padding:5px;">
                                        <a href="#" style="" class="dropdown btnnote kh16-b" data-classname="btnnote" data-id="{{ $d->id }}" data-rowind="{{ $key }}" data-code="{{ $d->smsid }}">កំណត់សំគាល់</a>
                                    </li>
                                </ul>
                                </div>
                            {{-- <a href="#" class="btn btn-info btnopencontinue kh22">បន្តដៃគូ</a> --}}
                            {{-- <a href="#" class="btn btn-info btn-sm btnselectcashdraw kh12-b" data-id="{{ $d->id }}" data-code="{{ $d->smsid }}">{{ App\Models\SmsProcess::checkselect($d->id)==true?'Selected':'Select' }}</a> --}}
                            <a href="#" class="btn btn-info btn-sm btnselectcashdraw kh12-b" data-id="{{ $d->id }}" data-code="{{ $d->smsid }}">{{ $d->is_select==true?'Selected':'Select' }}</a>

                            @if($d->mix_from_id<>null)
                                <a href="#" class="btn btn-warning btn-sm btnclearmixsms kh12-b" data-id="{{ $d->id }}" data-code="{{ $d->smsid }}" data-mixfromid="{{ $d->mix_from_id }}">Clear Mixed</a>
                            @endif
                        </td>
                        <td class="kh12-b opname" style="text-align:center;">{{ $d->opname }}</td>
                        <td class="kh12-b optel" style="text-align:center;">{{ $d->optel }}</td>
                        <td class="kh12-b" style="">{{ $d->smstext }}</td>
                    </tr>
                    @if($d->mix_from_id)
                        <tr id="c{{ $d->id }}" class="collapse borderset2" style="">
                            <td colspan=7 style="">
                                <table class="table table-bordered" style="margin:0px;">
                                    <tbody>
                                        @php
                                            $i=0;
                                        @endphp
                                        @foreach (App\Models\SMS::getmixsms($d->mix_from_id) as $item)
                                            @php
                                                $i=$i+1;
                                            @endphp
                                            @if($i==1)
                                                <tr style="text-align:center;border-top:none;font-weight:bold;">
                                                    <th style="width:60px;">លរ</th>
                                                    <th style="width:100px;">SMSID</th>
                                                    <th style="width:180px;">ថ្ងៃវេរចូល</th>
                                                    <th style="width:200px;">វេរមកពី</th>
                                                    <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                                                    <th>សារ</th>
                                                </tr>
                                            @endif
                                            <tr class="kh16" style="">
                                                <td class="kh14" style="text-align:center;padding-left:0px;padding-right:0px;">{{ $i }}</td>
                                                <td class="kh14-b"  style="" title="{{ $d->smsid }}">
                                                    {{ $item->id }}
                                                </td>
                                                <td class="kh14-b" style="">{{ date('d-m-Y',strtotime($item->smsdate)) . "(" . $item->smstime . ")"}}</td>
                                                <td class="kh14-b" style="">{{ $item->sendfrom . "(" . $item->account . ")"}}</td>
                                                <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $d->cur }}</td>
                                                <td class="kh14" style="">{{ $item->smstext }}</td>

                                            </tr>
                                        @endforeach


                                    </tbody>

                                </table>
                            </td>

                        </tr>
                    @endif


            @endforeach

        </tbody>
    </table>
    <table>
        <tr>
            <td><button id="btnall" class="button1" onclick="searchTable('all')">All</button></td>
            <td><button id="btncash" class="button1" onclick="searchTable('cash')">Cash</button></td>
            <td><button id="btnlist" class="button1" onclick="searchTable('list')">List</button></td>
            <td><button id="btnpartnerlist" class="button1" onclick="searchTable('partner')">Partner</button></td>
        </tr>
    </table>
    <table id="tbl_cashdraw" class="table table-bordered kh12-b" style="table-layout:fixed;background-color:lightgray;margin:0px;padding:0px;">
        <thead class="" style="text-align:center;">
            <th style="width:60px;">លរ</th>
            <th style="width:120px;">Action</th>
            <th style="width:100px;">PID</th>
            <th style="width:100px;">SMSID</th>
            {{-- <th style="width:180px;">ថ្ងៃវេរចូល</th> --}}
            <th style="width:250px;">ថ្ងៃបើកវេរ</th>
            <th style="width:150px;">វេរមកពី</th>
            <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
            <th style="width:80px;">កាត់សេវ៉ា</th>
            <th style="width:150px;">លុយត្រូវបើក</th>
            <th style="width:150px;">ឈ្មោះអ្នកទទួល</th>
            <th style="width:150px;">លេខអ្នកទទួល</th>
            <th style="width:80px;">ប្រភេទទូទាត់</th>
            <th style="width:1500px;text-align:left;">សារ</th>
        </thead>

        <tbody id="">
            @foreach ($cashdraws as $key => $d)
                    <tr class="rowclick borderset1" style="color:black;">
                        <td class="kh12-b" style="text-align:center;padding:5px 0px;">{{ ++$key }}</td>
                        <td style="text-align:left;padding:2px 0px;">
                            @if (Auth::user()->role->name<>'Admin')
                                @if($d->smsp->user_id==Auth::id())
                                    <a href="{{ route('thaicashdraw.showgroupid',['group_id'=>$d->smsp->group_id,'smsid'=>$d->id,'smspid'=>$d->smsp->id]) }}" class="btn btn-danger kh14-b" target="_blank" style="width:50px;padding:0px;"> លុប </a>
                                @endif
                            @else
                                <a href="{{ route('thaicashdraw.showgroupid',['group_id'=>$d->smsp->group_id,'smsid'=>$d->id,'smspid'=>$d->smsp->id]) }}" class="btn btn-danger kh14-b" target="_blank" style="width:50px;padding:0px;"> លុប </a>
                            @endif
                            @if($d->smsp->paymethod=='List')
                                {{-- <a href="#" class=" btnedit btn btn-warning kh14-b" data-id="{{ $d->smsp->id }}" data-smsid="{{ $d->id }}" data-groupid="{{ $d->smsp->group_id }}" data-amount="{{ $d->amount }}" data-cutseva="{{ $d->cutseva }}" style="width:50px;padding:0px;">កែ</a> --}}
                                <a href="#" class=" btnprint btn btn-primary kh14-b" data-id="{{ $d->smsp->id }}" data-smsid="{{ $d->id }}" data-groupid="{{ $d->smsp->group_id }}" style="width:50px;padding:0px;">ព្រីន</a>
                            @else
                                <a href="{{ route('thaicashdraw.prints',['group_id'=>$d->smsp->group_id,'smsid'=>$d->id,'paymethod'=>$d->smsp->paymethod,'invtitle'=>'បើកវេរលុយថៃ(ព្រីនឡើងវិញ)']) }}" class="btn btn-info kh14-b" target="_blank" style="width:50px;padding:0px;"> ព្រីន </a>
                            @endif
                        </td>
                        <td class="kh12-b"  style="">
                            <a href="#c{{ $d->smsp->id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ $d->smsp->id }}</a>
                        </td>
                        <td class="kh12-b"  style="" title="{{ $d->smsid }}">{{ $d->id }}</td>
                        {{-- <td class="kh12-b" style="">{{ date('d-m-Y',strtotime($d->smsdate)) . "(" . $d->smstime . ")"}}</td> --}}
                        <td class="kh12-b" style="">{{ date('d-m-Y',strtotime($d->smsp->opdate)) . "(" . $d->smsp->optime . ")" . "(" . $d->smsp->user->name . ")"}}</td>

                        <td class="kh12-b" style="">{{ $d->sendfrom . "(" . $d->account . ")" }} </td>
                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($d->amount) . ' ' . $d->cur }}</td>
                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($d->cutseva)}}</td>
                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($d->amount-$d->cutseva) . ' ' . $d->cur }}</td>
                        <td class="kh12" style="text-align:center;">{{ $d->opname }}</td>
                        <td class="kh12" style="text-align:center;">{{ $d->optel }}</td>
                        <td class="kh12-b" style="text-align:center;">{{ $d->smsp->paymethod }}</td>
                        <td class="kh12" style="text-align:left;">{{ $d->smstext }}</td>
                    </tr>
                    <tr id="c{{ $d->smsp->id }}" class="collapse borderset2" style="">
                        <td colspan=11 style="">
                            <table class="table-bordered" style="margin:0px;table-layout:fixed;">
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach (App\Models\SmsProcess::gettransfer($d->smsp->id) as $item)
                                        @php
                                            $i=$i+1;
                                        @endphp
                                        @if($i==1)
                                            <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                                <td style="width:70px;">ID</td>
                                                <td style="width:100px;">Date</td>
                                                <td style="width:70px;">Time</td>
                                                <td style="width:150px;">ប្រតិបត្តិការណ៏</td>
                                                <td style="width:200px;">ដៃគូ</td>
                                                <td style="width:120px;">ចំនួនទឹកប្រាក់</td>
                                                <td style="width:100px;">សេវ៉ាដៃគូ</td>
                                                <td style="width:150px;">លេខអ្នកទទួល</td>
                                                <td style="width:150px;">ឈ្មោះអ្នកទទួល</td>
                                                <td style="width:120px;">លុយប្តូរ</td>
                                                <td style="width:100px;">អត្រា</td>
                                                <td style="width:200px;">CODE</td>
                                                <td style="width:100px;">ធ្វើកូតដោយ</td>
                                                <td style="width:100px;">អ្នកកត់ត្រា</td>
                                                <td style="width:100px;">ពាក់ព័ន្ធបុគ្គលិក</td>

                                            </tr>
                                        @endif
                                        <tr class="kh12" style="">
                                            <td style="text-align:center;">{{ $item->id }}</td>
                                            <td>
                                                {{ date('d-m-Y',strtotime($item->dd))}}
                                            </td>
                                            <td>
                                                {{ $item->tt }}
                                            </td>
                                            <td>{{ $item->tranname }}</td>
                                            <td>{{ $item->partner->name }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->sk }}</td>
                                            <td>{{ $item->rectel }}</td>
                                            <td>{{ $item->recname }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->thai_amt) . ' B'   }}</td>
                                            <td style="text-align:right;text-align:center;">{{ $item->th_rate }}</td>
                                            <td>{{ str_replace('<br>',' | ',$item->moneycode) .' | ' . $item->usercode->name }}</td>
                                            <td style="">{{ $item->usercode->name }}</td>
                                            <td style="">{{ $item->user->name }}</td>
                                            <td style="">{{ $item->useraffect->name }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                            <table class="table">
                                @php
                                        $j=0;
                                    @endphp
                                    @foreach (App\Models\SmsProcess::getexchange($d->smsp->id) as $item1)
                                        @php
                                            $j=$j+1;
                                        @endphp
                                        @if($j==1)
                                            <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                                <td style="width:100px;">ID</td>
                                                <td style="width:120px;">Date</td>
                                                <td style="width:100px;">Time</td>
                                                <td style="width:150px">អ្នកកត់ត្រា</td>

                                                <td style="width:150px;">ទិញចូល</td>
                                                <td style="width:150px;">លក់ចេញ</td>
                                                <td style="width:150px;">អត្រា</td>
                                                {{-- <td style="width:250px;text-align:left">Note</td> --}}
                                                <td colspan=3 style="text-align:right;">GroupID</td>

                                            </tr>
                                        @endif
                                        <tr class="kh12" style="">
                                            <td style="text-align:center;">{{ $item1->id }}</td>
                                            <td>{{ date('d-m-Y',strtotime($item1->dd))}}</td>
                                            <td>{{ $item1->tt }}</td>
                                            <td>{{ $item1->user->name }}</td>
                                            <td style="text-align:right;">{{ $item1->product>0? phpformatnumber(abs($item1->product)) . $item1->pcur:phpformatnumber(abs($item1->amount)) . $item1->maincur }}</td>
                                            <td style="text-align:right;">{{ $item1->amount<0? phpformatnumber(abs($item1->amount)) . $item1->maincur:phpformatnumber(abs($item1->product)) . $item1->pcur }}</td>
                                            <td style="text-align:right;">{{ floatval($item1->rate) }}</td>
                                            {{-- <td>{{ $item1->note }}</td> --}}
                                            <td colspan=3 style="text-align:right;">{{ $item1->ref_group_id }}</td>
                                        </tr>
                                    @endforeach
                            </table>
                        </td>

                    </tr>

            @endforeach

        </tbody>
    </table>




