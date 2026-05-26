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

@foreach ($sms as $key => $s)
<tr style="@if($s->amount>0)color:blue; @else color:red;@endif">
    <td class="kh12-b" style="text-align:center;">{{ ++$key }}</td>
    <td style="text-align:center;padding:0px;" class="kh14-b">
        @if($s->transfer_id || $s->isopen==1)
            <a href="#c{{ $s->id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ $s->id }}</a>
        @else
            <div class="dropdown">
                <button style="width:100px;" type="button" class="mybtn dropdown-toggle kh12-b" data-bs-toggle="dropdown">
                {{ $s->id }}
                </button>
                <ul class="dropdown-menu" style="padding:0px;margin:0px;">
                    <li style="background-color:rgb(137, 203, 230)"><a href="#" class="dropdown-item kh14-b btntolist" data-id="{{ $s->id }}" data-accno="{{ $s->accno }}" data-frombank="{{ $s->sendfrom }}" data-mekun="{{ $s->amount>0?'1':'-1' }}" data-amount="{{ $s->amount }}">ចូលបញ្ជី</a></li>
                    <li style="background-color:pink"><a href="#" class="dropdown-item kh14-b btndelsms1" data-id="{{ $s->id }}">លុប</a></li>
                </ul>
            </div>
        @endif
    </td>
    <td class="kh12-b" style="">{{ date('d-m-Y',strtotime($s->smsdate)) . "(" . $s->smstime . ")"}}</td>
    <td class="kh12-b" style="">{{ $s->sendfrom }}</td>
    <td class="kh12-b" style="">{{ $s->accno }}</td>
    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($s->amount) . ' B' }}</td>
    @if($s->opmethod=='Cash')
        <td class="kh12-b" style="text-align:center;">{{ $s->isopen==1?$s->opname?$s->opname:'បើករួច':'' }}</td>
    @else
        @if($s->transfer_id)
            <td>
                <div class="dropdown">
                    <button style="width:200px;" type="button" class="mybtn dropdown-toggle kh12-b" data-bs-toggle="dropdown">
                        {{ $s->opname }}
                    </button>
                    <ul class="dropdown-menu" style="padding:0px;margin:0px;">
                        <li style="background-color:pink"><a href="#" class="dropdown-item kh14-b btndeltolist" data-id="{{ $s->id }}" data-transfer_id="{{ $s->transfer_id }}">លុបចូលបញ្ជី</a></li>
                    </ul>
                </div>
            </td>
        @else
            <td style="text-align:center;">
                {{ $s->opmethod=='List'?'ពាក់ព័ន្ធបញ្ជីផ្សេងៗ':'' }}
            </td>
        @endif

    @endif
    <td class="kh12-b" style="">{{ $s->opmethod }}</td>
     <td class="kh12-b" style="">{{ $s->customer->name??'' }}</td>
    <td class="kh12-b" style="">{{ $s->smstext . '(' . $s->smsby . ')' }}{{ $s->mix_from_id?' ID:' . $s->mix_from_id:'' }}</td>

</tr>

<tr id="c{{ $s->id }}" class="collapse borderset2" style="">
    <td colspan=9 style="">
        <table class="tbl88" style="margin:0px;border:1px solid blue;">
            <tbody>
                @php
                    $i=0;
                @endphp
                @if($s->opmethod=='Cash')
                    <tr class="kh12-b" style="text-align:center;border-top:none;">
                        <td style="width:100px;border:1px solid black;">ID</td>
                        <td style="width:100px;">ថ្ងៃបើក</td>
                        <td style="width:80px;">ម៉ោង</td>
                        <td style="width:150px;">លុយថៃ</td>
                        <td style="width:100px;">កាត់សេវ៉ា</td>
                        <td style="width:150px;">ចំនួនបើក</td>
                        <td style="width:100px;">ការទូទាត់</td>
                        <td style="width:200px;">លេខអ្នកទទួល</td>
                        <td style="width:200px;">ឈ្មោះអ្នកទទួល</td>
                        <td style="width:120px;">GroupID</td>
                        <td style="width:120px;">TransferID</td>
                        <td style="width:120px;">ExchangeID</td>


                    </tr>
                    @foreach(App\Models\SmsProcess::getsmsprocessbysmsid($s->id) as $p)
                        <tr class="kh12" style="">
                            <td style="text-align:center;">{{ $p->id }}</td>
                            <td>{{ date('d-m-Y',strtotime($p->opdate))}}</td>
                            <td>{{ $p->optime }}</td>

                            <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($p->thai_amount) . $p->currency->sk }}</td>
                            <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($p->cut_seva) . $p->currency->sk }}</td>
                            <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($p->amount) . $p->currency->sk }}</td>
                            <td>{{ $p->paymethod }}</td>
                            <td>{{ $p->rectel }}</td>
                            <td>{{ $p->recname }}</td>
                            <td>{{ $p->group_id }}</td>
                            <td>{{ $p->transfer_id }}</td>
                            <td>{{ $p->exchange_id }}</td>

                        </tr>
                    @endforeach
                @else
                    @foreach (App\Models\SmsProcess::gettransferbyid($s->transfer_id,$s->id) as $item)
                        @php
                            $i=$i+1;
                        @endphp
                        @if($i==1)

                            <tr class="kh12-b" style="text-align:center;border-top:none;">
                                <td style="width:100px;border:1px solid black;">ID</td>
                                <td style="width:100px;">Date</td>
                                <td style="width:80px;">Time</td>
                                <td style="width:200px;">ដៃគូ</td>
                                <td style="width:150px;">ចំនួនទឹកប្រាក់</td>
                                <td style="width:120px;">សេវ៉ាដៃគូ</td>
                                <td style="width:180px;">លេខអ្នកទទួល</td>
                                <td style="width:200px;">ឈ្មោះអ្នកទទួល</td>
                                <td style="width:300px;">ផ្សេងៗ</td>
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
                            <td>{{ $item->partner->name }}</td>
                            <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($item->amount) . $item->currency->sk }}</td>
                            <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($item->fee) . $item->feecurrency->sk }}</td>
                            <td>{{ $item->rectel }}</td>
                            <td>{{ $item->recname }}</td>
                            <td>{{ $item->note }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </td>

</tr>
@endforeach



