@php
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
            $fp=substr($num,$p,strlen($num)-$p);
            $dc=strlen((float)$fp)-2;
            if($dc>2) $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
    if($seelist=='2'){
        $oldlistv=$oldlist;
        $recordsv=$records;

    }else if($seelist=='1'){ //see they record
        $oldlistv=$theyopen_oldlist;
        $recordsv=$theyopen_records;
    }else if($seelist=='-1'){//see we record
        $oldlistv=$weopen_oldlist;
        $recordsv=$weopen_records;
    }
@endphp

<div class="row" style="">
    <div class="table-responsive">
        <table id="tbl_partner_list" class="table table-hover table-bordered" style="table-layout:fixed;">

            <tbody id="bodytransfer">
                @php
                    $total=0;
                    $amount=0;
                    $i=0;
                @endphp
                <tr style="text-align:center;background-color:pink;" class="kh14">
                    <th style="width:60px;">លរ</th>
                    <th style="width:90px;">ថ្ងៃទី</th>
                    <th style="width:80px;">ម៉ោង</th>
                    <th style="width:220px;">ប្រតិបត្តិការណ៏</th>
                    <th style="width:150px;">លុយវេរ</th>
                    <th style="width:100px;">សេវ៉ាដៃគូ</th>
                    <th style="width:150px;">សរុបទឹកប្រាក់</th>
                    <th style="width:150px;">សមតុល្យ</th>
                    <th style="width:400px;">Receiver</th>
                    <th style="width:200px;">អ្នកកត់ត្រា</th>
                    <th style="width:400px;">ផ្សេងៗ</th>
                </tr>
                <tr class="tr_usd" style="background-color:antiquewhite;">
                    <td colspan=11 class="kh14-b mainrow">ដុល្លា/USD</td>
                </tr>

                @if($oldlist)
                    @foreach ($oldlistv->where('cur','USD') as $l)
                        @php
                            $total+=$l->total;
                            $amount+=$l->amount;
                            ++$i;
                        @endphp
                        <tr class="tr_usd" style="">
                            <td class="no" style="text-align:center;">{{ $i }}</td>
                            <td class="kh12-b">{{ date('d-m-Y',strtotime($last_trandate_usd)) }}</td>
                            <td class="kh12-b">{{ $l->tt }}</td>
                            <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                            <td style="text-align:right;" class="kh14-b @if($l->total>0) cred @else cblue @endif">{{ phpformatnumber(-1 * $l->total) .  '$'  }}</td>
                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber(-1 * $l->fee) . '$'}}</td>
                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber(-1 * $l->total) .  '$'  }}</td>
                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber(-1 * $total) .  '$'  }}</td>
                            <td>{{ $l->receive??'' }}</td>
                            <td>{{ $l->recordby??'' }}</td>
                            <td>{{ $l->desr??$l->note }}</td>
                        </tr>
                    @endforeach
                @endif
                @foreach ($recordsv->where('cur','USD') as $l)
                    @php
                        $total+=$l->total;
                        $amount+=$l->amount;
                        ++$i;
                    @endphp
                    <tr class="tr_usd" style="">
                            <td class="no kh12-b" style="text-align:center;">{{ $i }}</td>
                            <td class="kh12-b">{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                            <td class="kh12-b">{{ $l->tt }}</td>

                            <td class="kh12-b">
                                @if($l->idtransfer)
                                    @if($linkdetail=='true')
                                        <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse">  {{ $l->tranname??'' }}</a>
                                        {{-- @if($l->ref_number)
                                            <a href="#ref{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                        @endif --}}
                                        @if($l->ref_group_id)
                                            <a href="#group{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                        @endif
                                    @else
                                        {{ $l->tranname??'' }}
                                    @endif
                                @else
                                    {{ $l->tranname??'' }}
                                @endif

                            </td>
                            <td style="text-align:right;" class="kh12-b @if($l->amount>0) cred @else cblue @endif">{{ phpformatnumber(-1 * $l->amount) . '$' }}</td>
                            <td style="text-align:right;" class="kh12-b">
                                @if($l->fee && $l->fee<>0)
                                {{ phpformatnumber(-1 * $l->fee)}}
                                    @if($l->feecur=='USD')
                                        $
                                    @elseif($l->feecur=='THB')
                                        B
                                    @elseif($l->feecur=='KHR')
                                        R
                                    @elseif($l->feecur=='VND')
                                        D
                                    @endif
                                @endif
                                @if($l->interest && $l->interest<>0)
                                {{ phpformatnumber(-1 * $l->interest) . '$'}}
                                @endif
                            </td>
                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(-1 * $l->total) . '$' }}</td>
                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(-1 * $total) . '$' }}</td>
                            <td class="kh12-b" style="text-align:right;">{{ trim($l->sender) !== '' ? $l->sender . '=>' : '' }}{{ $l->receive ?? '' }}</td>
                            <td class="kh12-b">{{ $l->recordby??'' }} {{ $l->idtransfer }}</td>
                            <td class="kh12-b">{{ $l->desr??$l->note }}</td>
                    </tr>
                    @if($linkdetail=='true')
                        @if($l->idtransfer && !$l->ref_group_id)
                            @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                    <td colspan=11>
                                        <table class="table-bordered" style="margin:0px;">
                                            <thead style="text-align:center;">
                                                <th>ថ្ងៃទី</th>
                                                <th>អ្នកកត់ត្រា</th>
                                                <th>ដៃគូ</th>
                                                <th>TID</th>
                                                <th>ប្រតិបត្តិការណ៏</th>
                                                <th>សរុបទឹកប្រាក់</th>
                                                <th>សេវ៉ា/ការប្រាក់</th>
                                                <th>សេវ៉ាអតិថិជន</th>
                                                <th>Receiver</th>
                                                <th>Sender</th>
                                                <th>ផ្សេងៗ</th>
                                                <th>ថ្ងៃកត់ត្រា</th>
                                                <th>UserAffect</th>

                                            </thead>
                                            <tbody>
                                                <tr class="kh12-b" style="text-align:center;">
                                                    <td>
                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                    </td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->partner->name }}</td>
                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                    <td>{{ $item->tranname }}</td>
                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                    <td>
                                                    @if($item->fee && $item->fee<>0)
                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                    @endif
                                                    @if($item->interest && $item->interest<>0)
                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                    @endif
                                                    </td>
                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                    <td>{{ $item->note }}</td>
                                                    <td>
                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                    </td>
                                                     <td>{{ $item->useraffect->name }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        {{-- @if($l->ref_number)
                            @php
                                $countdata=0;
                                $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                if($datarefs){
                                $countdata=1;
                                }
                            @endphp
                            @if($countdata>0)
                                @foreach ($datarefs as $item)
                                    @if(explode("-",$l->ref_number)[0]=='transfer')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>TID</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        <th>សេវ៉ា/ការប្រាក់</th>
                                                        <th>សេវ៉ាអតិថិជន</th>
                                                        <th>Receiver</th>
                                                        <th>Sender</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->partner->name }}</td>
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>{{ $item->tranname }}</td>
                                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>
                                                            @if($item->fee && $item->fee<>0)
                                                                {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                            @endif
                                                            @if($item->interest && $item->interest<>0)
                                                                {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                            @endif
                                                            </td>
                                                            <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                            <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                            <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រា</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                            <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                            <td>{{ phpformatnumber($item->rate)}}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-border">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                        <th>បរិយាយ</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->useraffect->name }}</td>
                                                            <td>{{ $item->tranname }}</td>
                                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>TID</th>
                                                        <th>ថ្ងៃបើក</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>កាត់សេវ៉ា</th>
                                                        <th>អ្នកទទួលប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->frompartner->name }}</td>
                                                            <td>បើកវេរ</td>
                                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូកាត់កង</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រាព្រមព្រាង</th>
                                                        <th>អត្រាគោល</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->partner->name }}</td>
                                                            <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                            <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                            <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                            <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endif --}}
                        @if($l->ref_group_id)
                            @php
                                $countdata=0;
                                $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                if($datarefs){
                                    $countdata=1;
                                }
                            @endphp
                            @if($countdata>0)
                                    @if(explode("-",$l->ref_group_id)[0]=='transfer' || explode("-",$l->ref_group_id)[0]=='moneyoffer')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>TID</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        <th>សេវ៉ា/ការប្រាក់</th>
                                                        <th>សេវ៉ាអតិថិជន</th>
                                                        <th>Receiver</th>
                                                        <th>Sender</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                        <th>UserAffect</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->partner->name }}</td>
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>
                                                                    @if($item->fee && $item->fee<>0)
                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                    @endif
                                                                    @if($item->interest && $item->interest<>0)
                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                                <td>{{ $item->useraffect->name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រា</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                        <th>បរិយាយ</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->useraffect->name }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                {{-- <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>TID</th>
                                                        <th>ថ្ងៃបើក</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>កាត់សេវ៉ា</th>
                                                        <th>អ្នកទទួលប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->frompartner->name }}</td>
                                                                <td>បើកវេរ</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table> --}}
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>TID</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        <th>សេវ៉ា/ការប្រាក់</th>
                                                        <th>សេវ៉ាអតិថិជន</th>
                                                        <th>Receiver</th>
                                                        <th>Sender</th>
                                                        <th>UserAffect</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->saveby }}</td>
                                                                <td>{{ $item->partner_name }}</td>
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ $item->amount }}</td>
                                                                <td>
                                                                    @if($item->fee)
                                                                    {{ $item->fee }}
                                                                    @endif
                                                                    @if($item->interest)
                                                                    |{{ $item->interest }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->cuscharge}}</td>
                                                                <td>{{ $item->receive }}</td>
                                                                <td>{{ $item->sender }}</td>
                                                                <td>{{ $item->useraffect }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូកាត់កង</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រាព្រមព្រាង</th>
                                                        <th>អត្រាគោល</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>

                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->partner->name }}</td>
                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif
                            @endif
                        @endif
                    @endif
                @endforeach
                <tr class="tr_usd" style="">
                    <td colspan=7 style="text-align:right;" class="kh16-b @if($total>0) cred @else cblue @endif"> {{ phpformatnumber(-1 * $total).' USD'}}</td>
                    <td colspan=4></td>
                </tr>
                 {{--  THB --}}
                @php
                    $total=0;
                    $amount=0;
                    $i=0;
                @endphp
                <tr class="tr_thb" style="background-color:antiquewhite;">
                    <td colspan=11 class="kh14-b mainrow">បាត/THB</td>
                </tr>
                @if($oldlist)
                    @foreach ($oldlistv->where('cur','THB') as $l)
                        @php
                            $total+=$l->total;
                            $amount+=$l->amount;
                            ++$i;
                        @endphp
                        <tr class="tr_thb" style="">
                            <td class="no" style="text-align:center;">{{ $i }}</td>
                            <td class="kh12-b">{{ date('d-m-Y',strtotime($last_trandate_thb)) }}</td>
                            <td class="kh12-b">{{ $l->tt }}</td>
                            <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                            <td style="text-align:right;" class="kh14-b @if($l->total>0) cred @else cblue @endif">{{ phpformatnumber(-1 * $l->total) .  'B'  }}</td>
                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber(-1 * $l->fee) . 'B'}}</td>
                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber(-1 * $l->total) .  'B'  }}</td>
                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber(-1 * $total) .  'B'  }}</td>
                            <td>{{ $l->receive??'' }}</td>
                            <td>{{ $l->recordby??'' }}</td>
                            <td>{{ $l->desr??$l->note }}</td>
                        </tr>
                    @endforeach
                @endif
                @foreach ($recordsv->where('cur','THB') as $l)
                    @php
                        $total+=$l->total;
                        $amount+=$l->amount;
                        ++$i;
                    @endphp
                    <tr class="tr_thb" style="">
                            <td class="no kh12-b" style="text-align:center;">{{ $i }}</td>
                            <td class="kh12-b">{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                            <td class="kh12-b">{{ $l->tt }}</td>
                            <td class="kh12-b">
                                @if($l->idtransfer)
                                    @if($linkdetail=='true')
                                        <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse">  {{ $l->tranname??'' }}</a>
                                        {{-- @if($l->ref_number)
                                            <a href="#ref{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                        @endif --}}
                                        @if($l->ref_group_id)
                                            <a href="#group{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                        @endif
                                    @else
                                        {{ $l->tranname??'' }}
                                    @endif
                                @else
                                    {{ $l->tranname??'' }}
                                @endif

                            </td>
                            <td style="text-align:right;" class="kh12-b @if($l->amount>0) cred @else cblue @endif">{{ phpformatnumber(-1 * $l->amount) . 'B' }}</td>
                            <td style="text-align:right;" class="kh12-b">
                                @if($l->fee && $l->fee<>0)
                                {{ phpformatnumber(-1 * $l->fee)}}
                                    @if($l->feecur=='USD')
                                        $
                                    @elseif($l->feecur=='THB')
                                        B
                                    @elseif($l->feecur=='KHR')
                                        R
                                    @elseif($l->feecur=='VND')
                                        D
                                    @endif
                                @endif
                                @if($l->interest && $l->interest<>0)
                                {{ phpformatnumber(-1 * $l->interest) . 'B'}}
                                @endif
                            </td>
                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(-1 * $l->total) . 'B' }}</td>
                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(-1 * $total) . 'B' }}</td>
                            <td class="kh12-b" style="text-align:right;">{{ trim($l->sender) !== '' ? $l->sender . '=>' : '' }}{{ $l->receive ?? '' }}</td>
                            <td class="kh12-b">{{ $l->recordby??'' }} {{ $l->idtransfer }}</td>
                            <td class="kh12-b">{{ $l->desr??$l->note }}</td>
                    </tr>
                    @if($linkdetail=='true')
                        @if($l->idtransfer && !$l->ref_group_id)
                            @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                    <td colspan=11>
                                        <table class="table-bordered" style="margin:0px;">
                                            <thead style="text-align:center;">
                                                <th>ថ្ងៃទី</th>
                                                <th>អ្នកកត់ត្រា</th>
                                                <th>ដៃគូ</th>
                                                <th>TID</th>
                                                <th>ប្រតិបត្តិការណ៏</th>
                                                <th>សរុបទឹកប្រាក់</th>
                                                <th>សេវ៉ា/ការប្រាក់</th>
                                                <th>សេវ៉ាអតិថិជន</th>
                                                <th>Receiver</th>
                                                <th>Sender</th>
                                                <th>ផ្សេងៗ</th>
                                                <th>ថ្ងៃកត់ត្រា</th>
                                                <th>UserAffect</th>
                                            </thead>
                                            <tbody>
                                                <tr class="kh12-b" style="text-align:center;">
                                                    <td>
                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                    </td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->partner->name }}</td>
                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                    <td>{{ $item->tranname }}</td>
                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                    <td>
                                                    @if($item->fee && $item->fee<>0)
                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                    @endif
                                                    @if($item->interest && $item->interest<>0)
                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                    @endif
                                                    </td>
                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                    <td>{{ $item->note }}</td>
                                                    <td>
                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                    </td>
                                                    <td>{{ $item->useraffect->name }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        {{-- @if($l->ref_number)
                            @php
                                $countdata=0;
                                $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                if($datarefs){
                                $countdata=1;
                                }
                            @endphp
                            @if($countdata>0)
                                @foreach ($datarefs as $item)
                                    @if(explode("-",$l->ref_number)[0]=='transfer')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>TID</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        <th>សេវ៉ា/ការប្រាក់</th>
                                                        <th>សេវ៉ាអតិថិជន</th>
                                                        <th>Receiver</th>
                                                        <th>Sender</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->partner->name }}</td>
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>{{ $item->tranname }}</td>
                                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>
                                                            @if($item->fee && $item->fee<>0)
                                                                {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                            @endif
                                                            @if($item->interest && $item->interest<>0)
                                                                {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                            @endif
                                                            </td>
                                                            <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                            <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                            <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រា</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                            <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                            <td>{{ phpformatnumber($item->rate)}}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-border">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                        <th>បរិយាយ</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->useraffect->name }}</td>
                                                            <td>{{ $item->tranname }}</td>
                                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>TID</th>
                                                        <th>ថ្ងៃបើក</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>កាត់សេវ៉ា</th>
                                                        <th>អ្នកទទួលប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->frompartner->name }}</td>
                                                            <td>បើកវេរ</td>
                                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូកាត់កង</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រាព្រមព្រាង</th>
                                                        <th>អត្រាគោល</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->partner->name }}</td>
                                                            <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                            <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                            <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                            <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endif --}}
                        @if($l->ref_group_id)
                            @php
                                $countdata=0;
                                $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                if($datarefs){
                                    $countdata=1;
                                }
                            @endphp
                            @if($countdata>0)
                                    @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>TID</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        <th>សេវ៉ា/ការប្រាក់</th>
                                                        <th>សេវ៉ាអតិថិជន</th>
                                                        <th>Receiver</th>
                                                        <th>Sender</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                        <th>UserAffect</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->partner->name }}</td>
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>
                                                                    @if($item->fee && $item->fee<>0)
                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                    @endif
                                                                    @if($item->interest && $item->interest<>0)
                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                                 <td>{{ $item->useraffect->name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រា</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                        <th>បរិយាយ</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->useraffect->name }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                {{-- <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>TID</th>
                                                        <th>ថ្ងៃបើក</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>កាត់សេវ៉ា</th>
                                                        <th>អ្នកទទួលប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->frompartner->name }}</td>
                                                                <td>បើកវេរ</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table> --}}
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>TID</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        <th>សេវ៉ា/ការប្រាក់</th>
                                                        <th>សេវ៉ាអតិថិជន</th>
                                                        <th>Receiver</th>
                                                        <th>Sender</th>
                                                        <th>UserAffect</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->saveby }}</td>
                                                                <td>{{ $item->partner_name }}</td>
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ $item->amount }}</td>
                                                                <td>
                                                                    @if($item->fee)
                                                                    {{ $item->fee }}
                                                                    @endif
                                                                    @if($item->interest)
                                                                    |{{ $item->interest }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->cuscharge}}</td>
                                                                <td>{{ $item->receive }}</td>
                                                                <td>{{ $item->sender }}</td>
                                                                <td>{{ $item->useraffect }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូកាត់កង</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រាព្រមព្រាង</th>
                                                        <th>អត្រាគោល</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>

                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->partner->name }}</td>
                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif
                            @endif
                        @endif
                    @endif
                @endforeach
                <tr class="tr_thb" style="">
                    <td colspan=7 style="text-align:right;" class="kh16-b @if($total>0) cred @else cblue @endif">{{ phpformatnumber(-1 * $total).' THB'}}</td>
                    <td colspan=4></td>
                </tr>
                 {{--  KHR --}}
                 @php
                 $total=0;
                 $amount=0;
                 $i=0;
             @endphp
             <tr class="tr_khr" style="background-color:antiquewhite;">
                 <td colspan=11 class="kh14-b mainrow">រៀល/KHR</td>
             </tr>
                @if($oldlist)
                    @foreach ($oldlistv->where('cur','KHR') as $l)
                        @php
                            $total+=$l->total;
                            $amount+=$l->amount;
                            ++$i;
                        @endphp
                        <tr class="tr_khr" style="">
                            <td class="no" style="text-align:center;">{{ $i }}</td>
                            <td class="kh12-b">{{ date('d-m-Y',strtotime($last_trandate_khr)) }}</td>
                            <td class="kh12-b">{{ $l->tt }}</td>
                            <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                            <td style="text-align:right;" class="kh14-b @if($l->total>0) cred @else cblue @endif">{{ phpformatnumber(-1 * $l->total) .  'R'  }}</td>
                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber(-1 * $l->fee) . 'R'}}</td>
                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber(-1 * $l->total) .  'R'  }}</td>
                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber(-1 * $total) .  'R'  }}</td>
                            <td>{{ $l->receive??'' }}</td>
                            <td>{{ $l->recordby??'' }}</td>
                            <td>{{ $l->desr??$l->note }}</td>
                        </tr>
                    @endforeach
                @endif
                @foreach ($recordsv->where('cur','KHR') as $l)
                    @php
                        $total+=$l->total;
                        $amount+=$l->amount;
                        ++$i;
                    @endphp
                    <tr class="tr_khr" style="">
                            <td class="no kh12-b" style="text-align:center;">{{ $i }}</td>
                            <td class="kh12-b">{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                            <td class="kh12-b">{{ $l->tt }}</td>
                            <td class="kh12-b">
                                @if($l->idtransfer)
                                    @if($linkdetail=='true')
                                        <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse">  {{ $l->tranname??'' }}</a>
                                        {{-- @if($l->ref_number)
                                            <a href="#ref{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                        @endif --}}
                                        @if($l->ref_group_id)
                                            <a href="#group{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                        @endif
                                    @else
                                        {{ $l->tranname??'' }}
                                    @endif
                                @else
                                    {{ $l->tranname??'' }}
                                @endif

                            </td>
                            <td style="text-align:right;" class="kh12-b @if($l->amount>0) cred @else cblue @endif">{{ phpformatnumber(-1 * $l->amount) . 'R' }}</td>
                            <td style="text-align:right;" class="kh12-b">
                                @if($l->fee && $l->fee<>0)
                                {{ phpformatnumber(-1 * $l->fee)}}
                                    @if($l->feecur=='USD')
                                        $
                                    @elseif($l->feecur=='THB')
                                        B
                                    @elseif($l->feecur=='KHR')
                                        R
                                    @elseif($l->feecur=='VND')
                                        D
                                    @endif
                                @endif
                                @if($l->interest && $l->interest<>0)
                                {{ phpformatnumber(-1 * $l->interest) . 'R'}}
                                @endif
                            </td>
                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(-1 * $l->total) . 'R' }}</td>
                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(-1 * $total) . 'R' }}</td>
                            <td class="kh12-b" style="text-align:right;"> {{ trim($l->sender) !== '' ? $l->sender . '=>' : '' }}{{ $l->receive ?? '' }}</td>
                            <td class="kh12-b">{{ $l->recordby??'' }} {{ $l->idtransfer }}</td>
                            <td class="kh12-b">{{ $l->desr??$l->note }}</td>
                    </tr>
                    @if($linkdetail=='true')
                        @if($l->idtransfer && !$l->ref_group_id)
                            @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                    <td colspan=11>
                                        <table class="table-bordered" style="margin:0px;">
                                            <thead style="text-align:center;">
                                                <th>ថ្ងៃទី</th>
                                                <th>អ្នកកត់ត្រា</th>
                                                <th>ដៃគូ</th>
                                                <th>TID</th>
                                                <th>ប្រតិបត្តិការណ៏</th>
                                                <th>សរុបទឹកប្រាក់</th>
                                                <th>សេវ៉ា/ការប្រាក់</th>
                                                <th>សេវ៉ាអតិថិជន</th>
                                                <th>Receiver</th>
                                                <th>Sender</th>
                                                <th>ផ្សេងៗ</th>
                                                <th>ថ្ងៃកត់ត្រា</th>
                                                <th>UserAffect</th>
                                            </thead>
                                            <tbody>
                                                <tr class="kh12-b" style="text-align:center;">
                                                    <td>
                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                    </td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->partner->name }}</td>
                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                    <td>{{ $item->tranname }}</td>
                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                    <td>
                                                    @if($item->fee && $item->fee<>0)
                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                    @endif
                                                    @if($item->interest && $item->interest<>0)
                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                    @endif
                                                    </td>
                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                    <td>{{ $item->note }}</td>
                                                    <td>
                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                    </td>
                                                    <td>{{ $item->useraffect->name }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        {{-- @if($l->ref_number)
                            @php
                                $countdata=0;
                                $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                if($datarefs){
                                $countdata=1;
                                }
                            @endphp
                            @if($countdata>0)
                                @foreach ($datarefs as $item)
                                    @if(explode("-",$l->ref_number)[0]=='transfer')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>TID</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        <th>សេវ៉ា/ការប្រាក់</th>
                                                        <th>សេវ៉ាអតិថិជន</th>
                                                        <th>Receiver</th>
                                                        <th>Sender</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->partner->name }}</td>
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>{{ $item->tranname }}</td>
                                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>
                                                            @if($item->fee && $item->fee<>0)
                                                                {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                            @endif
                                                            @if($item->interest && $item->interest<>0)
                                                                {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                            @endif
                                                            </td>
                                                            <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                            <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                            <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រា</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                            <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                            <td>{{ phpformatnumber($item->rate)}}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-border">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                        <th>បរិយាយ</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->useraffect->name }}</td>
                                                            <td>{{ $item->tranname }}</td>
                                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>TID</th>
                                                        <th>ថ្ងៃបើក</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>កាត់សេវ៉ា</th>
                                                        <th>អ្នកទទួលប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->frompartner->name }}</td>
                                                            <td>បើកវេរ</td>
                                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                            <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                        <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូកាត់កង</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រាព្រមព្រាង</th>
                                                        <th>អត្រាគោល</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="kh12-b" style="text-align:center;">
                                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                                            <td>
                                                                {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                            </td>
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->partner->name }}</td>
                                                            <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                            <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                            <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                            <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                            <td>{{ $item->note }}</td>
                                                            <td>
                                                            {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endif --}}
                        @if($l->ref_group_id)
                            @php
                                $countdata=0;
                                $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                if($datarefs){
                                    $countdata=1;
                                }
                            @endphp
                            @if($countdata>0)
                                    @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>TID</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        <th>សេវ៉ា/ការប្រាក់</th>
                                                        <th>សេវ៉ាអតិថិជន</th>
                                                        <th>Receiver</th>
                                                        <th>Sender</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                        <th>UserAffect</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->partner->name }}</td>
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>
                                                                    @if($item->fee && $item->fee<>0)
                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                    @endif
                                                                    @if($item->interest && $item->interest<>0)
                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                                <td>{{ $item->useraffect->name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រា</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                        <th>បរិយាយ</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->useraffect->name }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                {{-- <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>TID</th>
                                                        <th>ថ្ងៃបើក</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>កាត់សេវ៉ា</th>
                                                        <th>អ្នកទទួលប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->frompartner->name }}</td>
                                                                <td>បើកវេរ</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table> --}}
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>TID</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        <th>សេវ៉ា/ការប្រាក់</th>
                                                        <th>សេវ៉ាអតិថិជន</th>
                                                        <th>Receiver</th>
                                                        <th>Sender</th>
                                                        <th>UserAffect</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->saveby }}</td>
                                                                <td>{{ $item->partner_name }}</td>
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ $item->amount }}</td>
                                                                <td>
                                                                    @if($item->fee)
                                                                    {{ $item->fee }}
                                                                    @endif
                                                                    @if($item->interest)
                                                                    |{{ $item->interest }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->cuscharge}}</td>
                                                                <td>{{ $item->receive }}</td>
                                                                <td>{{ $item->sender }}</td>
                                                                <td>{{ $item->useraffect }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូកាត់កង</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រាព្រមព្រាង</th>
                                                        <th>អត្រាគោល</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>

                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->partner->name }}</td>
                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif
                            @endif
                        @endif
                    @endif
                @endforeach
                <tr class="tr_khr" style="">
                    <td colspan=7 style="text-align:right;" class="kh16-b  @if($total>0) cred @else cblue @endif">{{ phpformatnumber(-1 * $total).' KHR'}}</td>
                    <td colspan=4></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        @php
            $weusd=0;
            $wethb=0;
            $wekhr=0;
            $wevnd=0;
            foreach($befortotalwe as $w){
                if($w->cur=='USD'){
                    $weusd=$w->total;
                }else if($w->cur=='THB'){
                    $wethb=$w->total;
                }else if($w->cur=='KHR'){
                    $wekhr=$w->total;
                }else if($w->cur=='VND'){
                    $wevnd=$w->total;
                }
            }

            $theyusd=0;
            $theythb=0;
            $theykhr=0;
            $theyvnd=0;
            foreach($befortotalthey as $they){
                if($they->cur=='USD'){
                    $theyusd=$they->total;
                }else if($they->cur=='THB'){
                    $theythb=$they->total;
                }else if($they->cur=='KHR'){
                    $theykhr=$they->total;
                }else if($they->cur=='VND'){
                    $theyvnd=$they->total;
                }
            }
        @endphp
        <table id="tbl_before" class="table table-bordered table-hover">
            <tr>
                <td colspan=2 style="font-family:khmer os muol light;text-align:center;font-size:16px;padding:2px;">មុនទូទាត់</td>
            </tr>
            <tr>
                <td class="kh16-b" style="text-align:center;">បើកនៅ {{ $logo->name }}</td>
                <td class="kh16-b" style="text-align:center;">បើកនៅ {{ $partnername }}</td>
            </tr>
            <tr>
                <td class="kh16-b" style="text-align:right;color:blue;">
                    {{ phpformatnumber(abs($weusd)) . ' USD' }}
                </td>
                <td class="kh16-b" style="text-align:right;color:red;">
                    {{ phpformatnumber(abs($theyusd)) . ' USD' }}
                </td>
            </tr>
            <tr>
                <td class="kh16-b" style="text-align:right;color:blue;">
                    {{ phpformatnumber(abs($wethb)) . ' THB' }}
                </td>
                <td class="kh16-b" style="text-align:right;color:red;">
                    {{ phpformatnumber(abs($theythb)) . ' THB' }}
                </td>
            </tr>
            <tr>
                <td class="kh16-b" style="text-align:right;color:blue;">
                    {{ phpformatnumber(abs($wekhr)) . ' KHR' }}
                </td>
                <td class="kh16-b" style="text-align:right;color:red;">
                    {{ phpformatnumber(abs($theykhr)) . ' KHR' }}
                </td>
            </tr>
            {{-- <tr>
                <td class="kh16-b" style="text-align:right;color:blue;">
                    {{ phpformatnumber(abs($wevnd)) . ' VND' }}
                </td>
                <td class="kh16-b" style="text-align:right;color:red;">
                    {{ phpformatnumber(abs($theyvnd)) . ' VND' }}
                </td>
            </tr> --}}
        </table>

    </div>
    <div class="col-lg-6">
        @php
            $usd1=0;
            $thb1=0;
            $khr1=0;
            $vnd1=0;
            $usd2=0;
            $thb2=0;
            $khr2=0;
            $vnd2=0;
            foreach($aftertotal as $a){
                if($a->cur=='USD'){
                    if($a->total>0){
                        $usd2=$a->total;
                    }else{
                        $usd1=$a->total;
                    }

                }else if($a->cur=='THB'){
                    if($a->total>0){
                        $thb2=$a->total;
                    }else{
                        $thb1=$a->total;
                    }
                }else if($a->cur=='KHR'){
                    if($a->total>0){
                        $khr2=$a->total;
                    }else{
                        $khr1=$a->total;
                    }
                }else if($a->cur=='VND'){
                    if($a->total>0){
                        $vnd2=$a->total;
                    }else{
                        $vnd1=$a->total;
                    }
                }
            }
        @endphp

        <table id="tbl_after" class="table table-bordered table-hover">
            <tr>
                <td colspan=2 style="font-family:khmer os muol light;text-align:center;font-size:16px;padding:2px;">ក្រោយទូទាត់</td>
            </tr>
            <tr>
                <td class="kh16-b" style="text-align:center;">នៅខ្វះ {{ $logo->name }}</td>
                <td class="kh16-b" style="text-align:center;">នៅខ្វះ {{ $partnername }}</td>
            </tr>
            <tr>
                <td class="kh16-b" style="text-align:right;color:blue;">
                    {{ phpformatnumber(abs($usd1)) . ' USD' }}
                </td>
                <td class="kh16-b" style="text-align:right;color:red;">
                    {{ phpformatnumber(abs($usd2)) . ' USD' }}
                </td>
            </tr>
            <tr>
                <td class="kh16-b" style="text-align:right;color:blue;">
                    {{ phpformatnumber(abs($thb1)) . ' THB' }}
                </td>
                <td class="kh16-b" style="text-align:right;color:red;">
                    {{ phpformatnumber(abs($thb2)) . ' THB' }}
                </td>
            </tr>
            <tr>
                <td class="kh16-b" style="text-align:right;color:blue;">
                    {{ phpformatnumber(abs($khr1)) . ' KHR' }}
                </td>
                <td class="kh16-b" style="text-align:right;color:red;">
                    {{ phpformatnumber(abs($khr2)) . ' KHR' }}
                </td>
            </tr>
            {{-- <tr>
                <td class="kh16-b" style="text-align:right;color:blue;">
                    {{ phpformatnumber(abs($vnd1)) . ' VND' }}
                </td>
                <td class="kh16-b" style="text-align:right;color:red;">
                    {{ phpformatnumber(abs($vnd2)) . ' VND' }}
                </td>
            </tr> --}}
        </table>

    </div>
</div>
