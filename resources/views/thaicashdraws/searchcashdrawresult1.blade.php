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
<div class="row" style="margin:10px 5px;">
    {{-- <p id="tbl_title" style="color:blue;margin-left:-10px;" class="kh22-b">មិនទាន់រួចរាល់</p> --}}
    <div class="table-responsive" style="margin:0px;padding:0px;height:300px;">
        <table id="tbl_notyetcashdraw" class="kh14-b" style="margin-top:0px;padding:0px;table-layout:fixed;width:100%;">
            <thead class="" style="padding:0px;">
                <th style="width:60px;background-color:aquamarine">លរ</th>
                <th style=" width:100px;background-color:aquamarine">ID</th>
                <th style="width:150px;background-color:aquamarine">អ្នកកត់ត្រា</th>
                <th style="width:100px;background-color:aquamarine">កាលបរិច្ឆេទ</th>
                <th style="width:80px;background-color:aquamarine">ម៉ោង</th>
                <th style="width:150px;background-color:aquamarine">វេរចំនួន</th>
                <th style="width:100px;background-color:aquamarine">កាត់សេវ៉ា</th>
                <th style="width:150px;background-color:aquamarine">លុយត្រូវបើក</th>
                <th style="width:60px;background-color:aquamarine">បានកូត</th>
                <th style="width:150px;background-color:aquamarine">ផ្សេងៗ</th>
                <th style="text-align:center;background-color:aquamarine">Action</th>
            </thead>
            @php
                $i=0;
            @endphp

            <tbody id="bodytransfer" style="">
                @foreach ($data as $key => $d)
                        <tr class="rowclick kh14-b borderset1" style="background-color:lightgrey;">
                            <td class="kh14-b" style="width:60px;">{{ ++$key }}</td>
                            <td  style="width:100px;">
                                <a href="#c{{ $d->id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" title="smsID:{{ $d->sms_id }}">{{ $d->id }}</a>
                            </td>
                            <td  style="">{{ $d->user->name }}</td>
                            <td style="">{{ date('d-m-Y',strtotime($d->opdate))}}</td>
                            <td  style="">{{ $d->optime }}</td>
                            <td class="kh14" style="">{{ phpformatnumber($d->thaisms->amount) . ' ' . $d->currency->shortcut }}</td>
                            <td class="kh14" style="">{{ phpformatnumber($d->thaisms->amount-$d->amount) }}</td>

                            <td class="kh14" style="">{{ phpformatnumber($d->amount) . ' ' . $d->currency->shortcut }}</td>
                            <td  style="padding:0px;">
                                @if($d->isgetcode==1)
                                    <a href="{{ route('thaicashdraw1.printcode',['id'=>$d->id,'groupid'=>$d->group_id]) }}" class="btn btn-sm btn-warning kh14-b" style="padding:0px 2px 0px 2px;" target="_blank">បានកូត</a>
                                @endif
                            </td>
                            <td  style="">{{ $d->note }}</td>
                            <td style="text-align:right;">
                                @if($d->step==2 || $d->step==1)
                                    @if(App\Models\SmsProcess::checkselect2($d->id)==true)
                                        <a href="#" class=" btn-sm btnopencashdraw kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}" data-transferamt="{{ $d->thaisms->amount }}" data-openamt="{{ $d->amount }}">កំពុងពិនិត្យ...</a>
                                        <a href="#" class=" btn-sm btnclearselect kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}" data-rowind="{{ $i }}" style="color:red;">Clear Select</a>
                                        @if($d->missioncomplete==0)
                                            <a href="#" class=" btn-sm btncontinue3 kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}" style="display:none;">Goto Step3</a>
                                            {{-- <a href="#" class=" btn-sm btnready kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}" style="display:none;">រួចរាល់</a> --}}
                                        @endif
                                    @else
                                        {{-- <a href="#" class=" btn-sm btnopencashdraw kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}">{{ App\Models\SmsProcess::checkselect2($d->id)==true?'កំពុងពិនិត្យ...':'ពិនិត្យ' }}</a> --}}
                                        <a href="#" class=" btn-sm btnopencashdraw kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}" data-transferamt="{{ $d->thaisms->amount }}" data-openamt="{{ $d->amount }}">ពិនិត្យ</a>
                                        <a href="#" class=" btn-sm btnclearselect kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}" data-rowind="{{ $i }}" style="color:red;display:none;">Clear Select</a>

                                        @if($d->missioncomplete==0)
                                            <a href="#" class=" btn-sm btncontinue3 kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}">Goto Step3</a>
                                            {{-- <a href="#" class=" btn-sm btnready kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}">រួចរាល់</a> --}}
                                        @endif
                                    @endif
                                @else
                                    Processing in step 3...
                                @endif
                            </td>
                        </tr>
                        @php
                            $i+=1
                        @endphp
                        <tr id="c{{ $d->id }}" class="collapse borderset2" style="">
                            <td colspan=10 style="">
                                <div class="table-responsive">
                                    <table class="table table-bordered tbl_sub" style="margin:0px;">
                                        <tr style="font-weight:bold;text-align:center;">
                                            <td class="kh12-b" style="width:60px;">No</td>
                                            <td class="kh12-b" style="width:80px;">ID</td>
                                            <td class="kh12-b" style="width:90px;">Date</td>
                                            <td class="kh12-b" style="width:150px;">ដៃគូ</td>
                                            <td class="kh12-b" style="width:120px;">ចំនួនទឹកប្រាក់</td>
                                            <td class="kh12-b" style="width:80px;">សេវ៉ាដៃគូ</td>
                                            <td class="kh12-b" style="width:150px;">លេខអ្នកទទួល</td>
                                            <td class="kh12-b" style="width:150px;">ឈ្មោះអ្នកទទួល</td>
                                            <td class="kh12-b" style="width:120px;">ប្តូរជាលុយ</td>
                                            <td class="kh12-b" style="width:80px;">អត្រា</td>
                                            <td class="kh12-b" style="">CODE</td>
                                            <td class="kh12-b" style="">Action</td>
                                        </tr>
                                        <tbody>
                                            @foreach (App\Models\SmsProcess::gettransfer($d->id) as $key => $item)
                                            <tr class="kh12-b" style="">
                                                <td style="text-align:center;">{{ ++$key }}</td>
                                                <td style="text-align:center;">{{ $item->id }}</td>
                                                <td>{{ date('d-m-Y',strtotime($item->dd))}}</td>
                                                <td>{{ $item->partner->name }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($item->thai_amt) . ' THB' }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}</td>
                                                <td style="">{{ $item->rectel }}</td>
                                                <td style="">{{ $item->recname }}</td>
                                                <td style="text-align:right;">{{ $item->th_rate?phpformatnumber($item->amount) . ' ' . $item->currency->shortcut:'' }}</td>
                                                <td style="text-align:right;">{{ $item->th_rate }}</td>
                                                <td>{{ str_replace('<br>',' ',$item->moneycode) }}</td>
                                                <td style="padding:0px;">
                                                    <a href="{{ route('thaicashdraw1.printcode',['id'=>$item->id]) }}" class=" btn-sm btnprintcode kh12-b" style="padding:0px;" data-id="{{ $item->id }}"  target="_blank">Print Code</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </td>

                        </tr>

                @endforeach

            </tbody>
        </table>
    </div>

</div>

<div class="row" style="margin:10px 5px;">
    {{-- <p id="tbl_title1" style="color:blue;margin-left:-10px;" class="kh22-b">ការងាររួចរាល់</p> --}}
    <table id="tbl_cashdraw" class="kh14-b" style="margin-top:0px;">
        <thead class="" style="">
            <th style="width:60px;background-color:aquamarine">លរ</th>
            <th style=" width:100px;background-color:aquamarine">ID</th>
            <th style="width:150px;background-color:aquamarine">អ្នកកត់ត្រា</th>
            <th style="width:100px;background-color:aquamarine">កាលបរិច្ឆេទ</th>
            <th style="width:80px;background-color:aquamarine">ម៉ោង</th>
            <th style="width:150px;background-color:aquamarine">វេរចំនួន</th>
            <th style="width:100px;background-color:aquamarine">កាត់សេវ៉ា</th>
            <th style="width:150px;background-color:aquamarine">លុយត្រូវបើក</th>
            <th style="width:60px;background-color:aquamarine">មើលកូត</th>
            <th style="width:150px;background-color:aquamarine">ផ្សេងៗ</th>
            <th style="text-align:center;background-color:aquamarine">Action</th>
        </thead>

        <tbody id="bodytransfer1">
            @foreach ($data1 as $key => $d)
                    <tr class="rowclick kh14-b borderset1" style="background-color:lightgrey;">
                        <td class="kh14-b" style="width:60px;">{{ ++$key }}</td>
                        <td  style="width:100px;">
                            <a href="#c{{ $d->id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" title="smsID:{{ $d->sms_id }}">{{ $d->id }}</a>
                        </td>
                        <td  style="">{{ $d->user->name }}</td>
                        <td style="">{{ date('d-m-Y',strtotime($d->opdate))}}</td>
                        <td  style="">{{ $d->optime }}</td>
                        <td class="kh14" style="">{{ phpformatnumber($d->thaisms->amount) . ' ' . $d->currency->shortcut }}</td>
                        <td class="kh14" style="">{{ phpformatnumber($d->thaisms->amount-$d->amount) }}</td>
                        <td class="kh14" style="">{{ phpformatnumber($d->amount) . ' ' . $d->currency->shortcut }}</td>
                        <td  style="padding:0px;">
                            @if($d->isgetcode==1)
                                <a href="{{ route('thaicashdraw1.printcode',['id'=>$d->id,'groupid'=>$d->group_id]) }}" class="btn btn-sm btn-info kh14-b" style="padding:0px 2px 0px 2px;"  target="_blank">មើលកូត</a>
                            @endif
                        </td>
                        <td  style="">{{ $d->note }}</td>
                        <td style="text-align:right;">
                            <a href="#" class=" btn-sm btnopencashdraw kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}" data-transferamt="{{ $d->thaisms->amount }}" data-openamt="{{ $d->amount }}" >{{ App\Models\SmsProcess::checkselect2($d->id)==true?'កំពុងពិនិត្យ...':'ពិនិត្យ' }}</a>
                        </td>
                    </tr>

                    <tr id="c{{ $d->id }}" class="collapse borderset2" style="">
                        <td colspan=10 style="">
                            <div class="table-responsive">
                                <table class="table table-bordered tbl_sub" style="margin:0px;">
                                    <tr style="font-weight:bold;text-align:center;">
                                        <td class="kh12-b" style="width:60px;">No</td>
                                        <td class="kh12-b" style="width:80px;">ID</td>
                                        <td class="kh12-b" style="width:90px;">Date</td>
                                        <td class="kh12-b" style="width:150px;">ដៃគូ</td>
                                        <td class="kh12-b" style="width:120px;">ចំនួនទឹកប្រាក់</td>
                                        <td class="kh12-b" style="width:80px;">សេវ៉ាដៃគូ</td>
                                        <td class="kh12-b" style="width:150px;">លេខអ្នកទទួល</td>
                                        <td class="kh12-b" style="width:150px;">ឈ្មោះអ្នកទទួល</td>
                                        <td class="kh12-b" style="width:120px;">ប្តូរជាលុយ</td>
                                        <td class="kh12-b" style="width:80px;">អត្រា</td>
                                        <td class="kh12-b" style="">CODE</td>
                                        <td class="kh12-b">Action</td>
                                    </tr>
                                    <tbody>
                                        @foreach (App\Models\SmsProcess::gettransfer($d->id) as $key => $item)
                                        <tr class="kh12-b" style="">
                                            <td style="text-align:center;">{{ ++$key }}</td>
                                            <td style="text-align:center;">{{ $item->id }}</td>
                                            <td>{{ date('d-m-Y',strtotime($item->dd))}}</td>
                                            <td>{{ $item->partner->name }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->thai_amt) . ' THB' }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}</td>
                                            <td style="">{{ $item->rectel }}</td>
                                            <td style="">{{ $item->recname }}</td>
                                            <td style="text-align:right;">{{ $item->th_rate?phpformatnumber($item->amount) . ' ' . $item->currency->shortcut:'' }}</td>
                                            <td style="text-align:right;">{{ $item->th_rate }}</td>
                                            <td>{{ str_replace('<br>',' | ',$item->moneycode) . ' | ' . $item->usercode->name }}</td>
                                            <td style="padding:0px;">
                                                <a href="{{ route('thaicashdraw1.printcode',['id'=>$item->id]) }}" class=" btn-sm btnprintcode kh12-b" style="padding:0px;" data-id="{{ $item->id }}"  target="_blank">Print Code</a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </td>

                    </tr>

            @endforeach

        </tbody>
    </table>

</div>

