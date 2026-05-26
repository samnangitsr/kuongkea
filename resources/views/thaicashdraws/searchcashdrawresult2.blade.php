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
<div class="row" style="margin:10px 5px 5px 5px;">
    <h1 id="table_title" style="color:red;margin-left:-10px;" class="kh22-b">តារាងទិន្ន័យ</h1>
    <table id="tbl_notyetcashdraw" class="kh12-b" style="">
        <thead class="" style="padding:5px;">
            <th style="width:50px;background-color:aquamarine">លរ</th>
            <th style=" width:100px;background-color:aquamarine">ID</th>
            <th style="width:100px;background-color:aquamarine">អ្នកកត់ត្រា</th>
            <th style="width:80px;background-color:aquamarine">ថ្ងៃកត់ត្រា</th>
            <th style="width:70px;background-color:aquamarine">ម៉ោង</th>
            <th style="width:150px;background-color:aquamarine">វេរចំនួន</th>
            <th style="width:100px;background-color:aquamarine">កាត់សេវ៉ា</th>
            <th style="width:150px;background-color:aquamarine">លុយត្រូវបើក</th>
            <th style="width:60px;background-color:aquamarine">ជំហាន</th>
            <th style="width:80px;background-color:aquamarine">ថ្ងៃប្រតិបត្តិ</th>
            <th style="width:150px;background-color:aquamarine">ផ្សេងៗ</th>
            <th style="background-color:aquamarine;text-align:center;">Action</th>
        </thead>

        <tbody id="bodytransfer">
            @foreach ($data as $key => $d)
                    <tr class="rowclick kh12-b borderset1" style="background-color:lightgrey;">
                        <td class="kh12-b" style="padding:5px;width:60px;">{{ ++$key }}</td>
                        <td class="kh12-b"  style="padding:5px;width:100px;">
                            <a href="#c{{ $d->id }}" class="kh12-b" style="text-decoration:underline;" data-bs-toggle="collapse">{{ $d->id }}</a>
                        </td>
                        <td class="kh12-b" style="">{{ $d->user->name }}</td>
                        <td class="kh12-b" style="">{{ date('d-m-Y',strtotime($d->opdate))}}</td>
                        <td class="kh12-b"  style="">{{ $d->optime }}</td>
                        <td class="kh14" style="">{{ phpformatnumber($d->thaisms->amount) . ' ' . $d->currency->shortcut }}</td>
                        <td class="kh14" style="">{{ phpformatnumber($d->thaisms->amount-$d->amount) }}</td>
                        <td class="kh12-b" style="padding:5px;">{{ phpformatnumber($d->amount) . ' ' . $d->currency->shortcut }}</td>
                        <td class="kh12-b" style="">{{ $d->step }}</td>
                        <td class="kh12-b" style="">{{ date('d-m-Y',strtotime($d->updated_at))}}</td>

                        <td  style="">{{ $d->note }}</td>
                        <td style="text-align:right;">
                            @if(App\Models\SmsProcess::checkselect2($d->id)==true)
                                @if($d->step==3)
                                    <a href="#" class="btncontinue2 kh12-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}" style="display:none;">Goto Step2 |</a>
                                    <a href="#" class="btnopencashdraw kh12-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}">កំពុងធ្វើលេខកូត</a>
                                    <a href="#" class=" btn-sm btnclearselect kh14-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}" style="color:red;">Clear Select</a>

                                @endif
                            @else
                                @if($d->step==3)
                                    <a href="#" class="btncontinue2 kh12-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}">Goto Step2 |</a>
                                    {{-- <a href="#" class="btnopencashdraw kh12-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}">{{ App\Models\SmsProcess::checkselect2($d->id)==true?'កំពុងធ្វើលេខកូត...':'ធ្វើលេខកូត' }}</a> --}}
                                    <a href="#" class="btnopencashdraw kh12-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}">ធ្វើលេខកូត</a>

                                    @endif
                            @endif
                        </td>
                    </tr>

                        <tr id="c{{ $d->id }}" class="collapse borderset2" style="">
                            <td colspan=10 style="">
                                <div class="table-responsive">
                                    <table class="table table-bordered tbl_sub kh12-b" style="margin:0px;">
                                        <tr style="font-weight:bold;text-align:center;">
                                            <td style="width:80px;">ID</td>
                                            <td style="width:80px;">Date</td>
                                            <td style="width:200px;">ដៃគូ</td>
                                            <td style="width:150px;">ចំនួនទឹកប្រាក់</td>
                                            <td style="width:120px;">សេវ៉ាដៃគូ</td>
                                            <td style="width:150px;">លេខអ្នកទទួល</td>
                                            <td style="width:150px;">ឈ្មោះអ្នកទទួល</td>
                                            <td style="width:150px;">ប្តូរជាលុយ</td>
                                            <td style="width:100px;">អត្រា</td>
                                            <td> CODE</td>

                                        </tr>
                                        <tbody>
                                            @foreach (App\Models\SmsProcess::gettransfer($d->id) as $item)
                                            <tr class="kh12-b">
                                                <td style="text-align:center;">{{ $item->id }}</td>
                                                <td>{{ date('d-m-Y',strtotime($item->dd))}}</td>
                                                <td>{{ $item->partner->name }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($item->thai_amt) . ' THB' }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}</td>
                                                <td>{{ $item->rectel }}</td>
                                                <td>{{ $item->recname }}</td>
                                                <td style="text-align:right;">{{ $item->th_rate?phpformatnumber($item->amount) . ' ' . $item->currency->shortcut:'' }}</td>
                                                <td style="text-align:right;">{{ $item->th_rate }}</td>
                                                <td>{{ str_replace('<br>',' ',$item->moneycode) }}</td>
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
