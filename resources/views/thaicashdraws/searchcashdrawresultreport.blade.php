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
            <th style="width:70px;">លរ</th>
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
            @php
                $totalamount=0;
                $totalcutseva=0;
            @endphp
            @foreach ($cashdraws as $key => $d)
                @php
                    $totalamount +=$d->amount;
                    $totalcutseva +=$d->cutseva;
                @endphp
                    <tr class="rowclick borderset1" style="color:black;">

                        <td style="text-align:center;padding:0px;">
                            <div class="dropdown">
                                <button style="width:70px;" type="button" class="mybtn dropdown-toggle kh12-b" data-bs-toggle="dropdown">
                                  {{ ++$key }}
                                </button>
                                <ul class="dropdown-menu" style="width:280px;">
                                    <li>
                                        @if (Auth::user()->role->name<>'Admin')
                                            @if($d->smsp->user_id==Auth::id())
                                                <a href="{{ route('thaicashdraw.showgroupid',['group_id'=>$d->smsp->group_id,'smsid'=>$d->id,'smspid'=>$d->smsp->id]) }}" class="btn btn-danger kh14-b" target="_blank" style="width:50px;padding:5px;"> លុប </a>
                                            @endif
                                        @else
                                            <a href="{{ route('thaicashdraw.showgroupid',['group_id'=>$d->smsp->group_id,'smsid'=>$d->id,'smspid'=>$d->smsp->id]) }}" class="btn btn-danger kh14-b" target="_blank" style="width:50px;padding:5px;"> លុប </a>
                                        @endif
                                        @if($d->smsp->paymethod=='List')
                                            {{-- <a href="#" class=" btnedit btn btn-warning kh14-b" data-id="{{ $d->smsp->id }}" data-smsid="{{ $d->id }}" data-groupid="{{ $d->smsp->group_id }}" data-amount="{{ $d->amount }}" data-cutseva="{{ $d->cutseva }}" style="width:50px;padding:0px;">កែ</a> --}}
                                            <a href="#" class=" btnprint btn btn-primary kh14-b" data-id="{{ $d->smsp->id }}" data-smsid="{{ $d->id }}" data-groupid="{{ $d->smsp->group_id }}" style="width:50px;padding:5px;">ព្រីន</a>
                                        @else
                                            <a href="{{ route('thaicashdraw.prints',['group_id'=>$d->smsp->group_id,'smsid'=>$d->id,'paymethod'=>$d->smsp->paymethod,'invtitle'=>'បើកវេរលុយថៃ(ព្រីនឡើងវិញ)']) }}" class="btn btn-info kh14-b" target="_blank" style="width:50px;padding:5px;"> ព្រីន </a>
                                        @endif
                                        <a href="#" class=" btnseephoto btn btn-primary kh14-b" data-id="{{ $d->smsp->id }}" data-smsid="{{ $d->id }}" data-groupid="{{ $d->smsp->group_id }}" style="width:160px;padding:5px;">បង្ហាញរូបអ្នកបើកលុយ</a>
                                    </li>

                                </ul>
                              </div>
                        </td>
                        <td class="kh12-b"  style="text-align:center;">
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
                                    @foreach ($d->transferlist as $item)
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
                                            <td style="text-align:center;">{{ $item['id'] }}</td>
                                            <td>
                                                {{ date('d-m-Y',strtotime($item['dd']))}}
                                            </td>
                                            <td>
                                                {{ $item['tt'] }}
                                            </td>
                                            <td>{{ $item['tranname'] }}</td>
                                            <td>{{ $item['partnername'] }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item['amount']) . ' ' . $item['cur'] }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item['fee']) . ' ' . $item['curfee'] }}</td>
                                            <td>{{ $item['rectel'] }}</td>
                                            <td>{{ $item['recname'] }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item['thai_amt']) . ' B'   }}</td>
                                            <td style="text-align:right;text-align:center;">{{ $item['th_rate'] }}</td>
                                            <td>{{ str_replace('<br>',' | ',$item['moneycode']) .' | ' . $item['docodeby'] }}</td>
                                            <td style="">{{ $item['docodeby'] }}</td>
                                            <td style="">{{ $item['recordby'] }}</td>
                                            <td style="">{{ $item['useraffect'] }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>


                        </td>

                    </tr>

            @endforeach
                      <tr id="rowtotal" style="background-color:aqua;">
                        <td class="kh16-b" colspan=5>Total</td>
                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($totalamount) }} THB</td>
                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($totalcutseva) }}</td>
                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($totalamount-$totalcutseva) }} THB</td>
                        <td colspan=4></td>
                    </tr>
        </tbody>
    </table>




