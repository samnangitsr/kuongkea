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
        <table id="tbl_notyetcomplete" class="table table-hover table-bordered kh14-b" style="margin-top:0px;padding:0px;">
            <thead class="">
                <th style="width:60px;">លរ</th>
                <th style=" width:100px;display:none;">ID</th>
                <th style=" width:100px;">SPID</th>
                <th style=" width:100px;display:none;">GroupID</th>
                <th style="width:100px;">កាលបរិច្ឆេទ</th>
                <th style="width:80px;">ម៉ោង</th>
                <th style="width:150px;">លុយថៃ</th>
                <th style="width:100px;">អត្រា</th>
                <th style="width:150px;">លុយប្តូរបាន</th>
                <th style="width:150px;">លេខអ្នកទទួល</th>
                <th style="width:150px;">ឈ្មោះអ្នកទទួល</th>
                <th style="width:150px;">អ្នកកត់ត្រា</th>
                <th style="width:150px;">ផ្សេងៗ</th>
                <th style="width:150px;">ឈ្មោះដៃគូ</th>
                <th style="width:150px;">ប្រភេទភ្នាក់ងារ</th>
                <th style="width:150px;display:none;">UserPartner</th>
                <th style="text-align:center;">Action</th>
            </thead>
            @php
                $i=0;
                $j=0;
            @endphp

            <tbody id="body_notyetcomplete">
                @foreach ($data as $key => $d)
                        <tr class="rowclick kh14-b borderset1  @if($d->docodeby &&  is_null($d->cashdraw_codeid)==1) cgreen @endif">
                            <td class="kh14-b" style="width:60px;text-align:center;">{{ ++$key }}</td>
                            <td  style="width:100px;display:none;">{{ $d->id }}</td>
                            <td class=""  style="width:100px;">
                                <a href="#c{{ explode('-',$d->ref_group_id)[1] }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ explode('-',$d->ref_group_id)[1] }}</a>
                            </td>
                            <td  style="width:100px;display:none;">{{ $d->ref_group_id }}</td>
                            <td>{{ date('d-m-Y',strtotime($d->dd))}}</td>
                            <td>{{ $d->tt }}</td>
                            <td class="kh14" style="text-align:right;">{{ phpformatnumber($d->thai_amt) . ' THB' }}</td>
                            <td class="kh14" style="text-align:right;">{{ phpformatnumber($d->th_rate) }}</td>
                            <td class="kh14" style="text-align:right;">{{ phpformatnumber($d->amount) . ' ' . $d->currency->shortcut }}</td>
                            <td class="kh14">{{ $d->rectel }}</td>
                            <td class="kh14">{{ $d->recname }}</td>
                            {{-- <td  style="padding:0px;">
                                @if($d->docodeby &&  is_null($d->cashdraw_codeid)==1)
                                    <a href="{{ route('thaicashdraw1.printcode',['id'=>$d->id,'groupid'=>$d->ref_group_id]) }}" class="btn btn-sm btn-warning kh14-b" style="padding:0px 2px 0px 2px;" target="_blank">បានកូត</a>
                                @endif
                            </td> --}}
                            <td >{{ $d->user->name }}</td>
                            <td >{{ $d->note }}</td>
                            <td >{{ $d->partner->name }}</td>
                            <td >{{ $d->partner->agenttype->name }}</td>

                            <td  style="display:none;">
                                <input type="text" class="form-control userconnect" value="{{ $d->partner->user_connect }}">
                            </td>

                            <td style="text-align:right;">
                                    @if(App\Models\SmsProcess::checkselect3($d->id)==true)
                                        <a href="#" class=" btn-sm btnopencashdraw kh14-b" data-id="{{ $d->id }}"  data-groupid="{{ $d->ref_group_id }}">កំពុងពិនិត្យ...</a>
                                        <a href="#" class=" btn-sm btnclearselect kh14-b" data-id="{{ $d->id }}" data-groupid="{{ $d->ref_group_id }}" data-rowind="{{ $i }}" style="color:red;">Clear Select</a>
                                    @else
                                        <a href="#" class=" btn-sm btnopencashdraw kh14-b" data-id="{{ $d->id }}"  data-groupid="{{ $d->ref_group_id }}" data-agenttype="{{ $d->partner->agenttype->name }}" data-agenttypeid="{{ $d->partner->agent_type_id }}" data-customertype="{{ $d->partner->customertype }}" data-bankname="{{ $d->partner->name }}" data-maxtransfer="{{ $d->partner->max_transfer }}" data-maxcuscharge="{{ $d->partner->max_fee }}" data-maxagentfee="{{ $d->partner->cashdraw_agentfee }}" data-thbuyinfo="{{ $d->th_buyinfo }}">ពិនិត្យ</a>
                                        <a href="#" class=" btn-sm btnclearselect kh14-b" data-id="{{ $d->id }}" data-groupid="{{ $d->ref_group_id }}" data-rowind="{{ $i }}" style="color:red;display:none;">Clear Select</a>
                                    @endif
                            </td>
                        </tr>
                        <tr id="c{{ explode('-',$d->ref_group_id)[1] }}" class="collapse borderset2">
                            <td colspan=14>
                                <table class="table-bordered" style="margin:0px;table-layout:fixed;">
                                    <tbody>
                                        @php
                                            $i=0;
                                        @endphp
                                        @foreach (App\Models\SmsProcess::getsmsprocess(explode('-',$d->ref_group_id)[1]) as $item)
                                            @php
                                                $i=$i+1;
                                            @endphp
                                            @if($i==1)
                                                <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                                    <td style="width:70px;">ID</td>
                                                    <td style="width:100px;">SMSID</td>

                                                    <td style="width:80px;">Date</td>
                                                    <td style="width:70px;">Time</td>
                                                    <td style="width:150px;">លុយដាក់ចូល</td>
                                                    <td style="width:150px;">កាត់សេវ៉ា</td>
                                                    <td style="width:120px;">ទឹកប្រាក់នៅសល់</td>
                                                    <td style="width:100px;">ប្រភេទទូទាត់</td>


                                                </tr>
                                            @endif
                                            <tr class="kh12">
                                                <td style="text-align:center;">{{ $item->id }}</td>
                                                <td style="text-align:center;">{{ $item->sms_id }}</td>

                                                <td>{{ date('d-m-Y',strtotime($item->opdate))}}</td>
                                                <td>{{ $item->optime }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($item->thai_amount) . ' ' . $item->currency->sk }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($item->cut_seva) . ' ' . $item->currency->sk }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                                                <td>{{ $item->paymethod }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </td>

                        </tr>
                        @php
                            $i+=1
                        @endphp


                @endforeach

            </tbody>
        </table>
    </div>

</div>

<div class="row" style="margin:10px 5px;">
    <div class="table-responsive" style="margin:0px;padding:0px;">
        <table id="tbl_complete" class="table table-bordered kh14-b" style="margin-top:0px;">
            <thead class="" style="padding:0px;">
                <th style="width:60px;">លរ</th>
                <th style=" width:100px;display:none;">ID</th>
                <th style=" width:100px;">SPID</th>
                <th style=" width:100px;display:none;">GroupID</th>
                <th style="width:100px;">កាលបរិច្ឆេទ</th>
                <th style="width:80px;">ម៉ោង</th>
                <th style="width:150px;">លុយថៃ</th>
                <th style="width:150px;">អត្រា</th>
                <th style="width:150px;">លុយប្តូរបាន</th>
                <th style="width:150px;">លេខអ្នកទទួល</th>
                <th style="width:150px;">ឈ្មោះអ្នកទទួល</th>
                <th style="width:150px;">អ្នកកត់ត្រា</th>
                <th style="width:150px;">ផ្សេងៗ</th>
                <th style="width:150px;">ឈ្មោះដៃគូ</th>
                <th style="width:150px;">ប្រភេទភ្នាក់ងារ</th>

                <th style="width:150px;display:none;">UserPartner</th>
                <th style="text-align:center;">Action</th>
            </thead>

            <tbody id="body_complete">
                @foreach ($data1 as $key => $d)
                    <tr class="rowclick kh14-b borderset1" style="background-color:lightgrey;">
                        <td class="kh14-b" style="width:60px;text-align:center;">{{ ++$key }}</td>
                        <td  style="width:100px;display:none;">{{ $d->id }}</td>

                        <td class=""  style="width:100px;">
                            <a href="#c{{ explode('-',$d->ref_group_id)[1] }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ explode('-',$d->ref_group_id)[1] }}</a>
                        </td>
                        <td  style="width:100px;display:none;">{{ $d->ref_group_id }}</td>
                        <td>{{ date('d-m-Y',strtotime($d->dd))}}</td>
                        <td >{{ $d->tt }}</td>
                        <td class="kh14" style="text-align:right;">{{ phpformatnumber($d->thai_amt) . ' THB' }}</td>
                        <td class="kh14" style="text-align:right;">{{ phpformatnumber($d->th_rate) }}</td>
                        <td class="kh14" style="text-align:right;">{{ phpformatnumber($d->amount) . ' ' . $d->currency->shortcut }}</td>
                        <td class="kh14">{{ $d->rectel }}</td>
                        <td class="kh14">{{ $d->recname }}</td>

                        <td >{{ $d->user->name }}</td>
                        <td >{{ $d->note }}</td>
                        <td >{{ $d->partner->name }}</td>
                        <td >{{ $d->partner->agenttype->name }}</td>

                        <td  style="display:none;">
                            <input type="text" class="form-control userconnect" value="{{ $d->partner->user_connect }}">
                        </td>
                        <td style="text-align:right;">
                                @if(App\Models\SmsProcess::checkselect2($d->id)==true)
                                    <a href="#" class=" btn-sm btnopencashdraw kh14-b" data-id="{{ $d->id }}"  data-groupid="{{ $d->ref_group_id }}">កំពុងពិនិត្យ...</a>
                                    <a href="#" class=" btn-sm btnclearselect kh14-b" data-id="{{ $d->id }}" data-groupid="{{ $d->ref_group_id }}" data-rowind="{{ $j }}" style="color:red;">Clear Select</a>
                                @else
                                    <a href="#" class=" btn-sm btnopencashdraw kh14-b" data-id="{{ $d->id }}"  data-groupid="{{ $d->ref_group_id }}" data-agenttype="{{ $d->partner->agenttype->name }}" data-agenttypeid="{{ $d->partner->agent_type_id }}" data-customertype="{{ $d->partner->customertype }}" data-bankname="{{ $d->partner->name }}" data-maxtransfer="{{ $d->partner->max_transfer }}" data-maxcuscharge="{{ $d->partner->max_fee }}" data-maxagentfee="{{ $d->partner->cashdraw_agentfee }}" data-thbuyinfo="{{ $d->th_buyinfo }}">ពិនិត្យ</a>
                                    <a href="#" class=" btn-sm btnclearselect kh14-b" data-id="{{ $d->id }}" data-groupid="{{ $d->ref_group_id }}" data-rowind="{{ $j }}" style="color:red;display:none;">Clear Select</a>
                                @endif
                        </td>
                    </tr>
                    <tr id="c{{ explode('-',$d->ref_group_id)[1] }}" class="collapse borderset2">
                        <td colspan=14>
                            <table class="table-bordered" style="margin:0px;table-layout:fixed;">
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach (App\Models\SmsProcess::getsmsprocess(explode('-',$d->ref_group_id)[1]) as $item)
                                        @php
                                            $i=$i+1;
                                        @endphp
                                        @if($i==1)
                                            <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                                <td style="width:70px;">ID</td>
                                                <td style="width:100px;">SMSID</td>

                                                <td style="width:80px;">Date</td>
                                                <td style="width:70px;">Time</td>
                                                <td style="width:150px;">លុយដាក់ចូល</td>
                                                <td style="width:150px;">កាត់សេវ៉ា</td>
                                                <td style="width:120px;">ទឹកប្រាក់នៅសល់</td>
                                                <td style="width:100px;">ប្រភេទទូទាត់</td>


                                            </tr>
                                        @endif
                                        <tr class="kh12">
                                            <td style="text-align:center;">{{ $item->id }}</td>
                                            <td style="text-align:center;">{{ $item->sms_id }}</td>

                                            <td>{{ date('d-m-Y',strtotime($item->opdate))}}</td>
                                            <td>{{ $item->optime }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->thai_amount) . ' ' . $item->currency->sk }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->cut_seva) . ' ' . $item->currency->sk }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                                            <td>{{ $item->paymethod }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </td>

                    </tr>
                    @php
                        $j+=1
                    @endphp

                @endforeach

            </tbody>
        </table>
    </div>

</div>

