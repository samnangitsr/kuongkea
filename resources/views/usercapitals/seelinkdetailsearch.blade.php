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
        <table style="display:none;">
            <tr>
                <td id="totalsearchamount">{{ phpformatnumber($sumamount) . ' ' . $cur }}</td>
            </tr>
        </table>

        @if($tablename=='transfer' || $tablename=='partner_useraffect')
            <table class="table table-bordered kh16-b">
                <thead style="text-align:center;">
                    <th>TID</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>បុគ្គលិកពាក់ព័ន្ធ</th>
                    <th>ដៃគូ</th>
                    <th>ប្រតិបត្តិការណ៏</th>
                    <th>សរុបទឹកប្រាក់</th>
                    <th>សេវ៉ាដៃគូ</th>
                    <th>សេវ៉ាអតិថិជន</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>ផ្សេងៗ</th>

                    <th>GroupID</th>

                </thead>
                <tbody>
                    @php
                        $t_amt=0;
                        $t_fee=0;
                        $t_cuscharge=0;
                    @endphp
                    @foreach ($showlink as $key=> $item)
                        @php
                            $t_amt=$t_amt+$item->amount;
                            $t_fee+=$item->fee;
                            $t_cuscharge+=$item->cuscharge;
                        @endphp
                        <tr class="kh16" style="text-align:center;">
                            <td>{{ sprintf("%04d",$item->id) }}</td>
                            <td>
                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->useraffect->name }}</td>
                            <td>{{ $item->partner->name }}</td>
                            <td>{{ $item->tranname }}</td>
                            <td style="text-align:right;" title="{{phpformatnumber($t_amt)}}">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                            <td style="text-align:right;" title="{{phpformatnumber($t_fee)}}">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}</td>
                            <td style="text-align:right;" title="{{phpformatnumber($t_cuscharge)}}">{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                            <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                            <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                            <td>{{ $item->note }}</td>
                            <td>
                                @if($item->ref_group_id)
                                        <a href="{{ route('usercapital.showrefgroupid',['group_id'=>$item->ref_group_id,'showdelbuton'=>false]) }}" class="mybtn" target="_blank" style="margin:0px;padding:2px;">{{ $item->ref_group_id??'' }}</a>
                                @endif
                            </td>

                        </tr>

                    @endforeach
                     <tr style="background-color:aqua">
                        <td colspan=6>Total</td>
                        <td style="text-align:right;">{{ phpformatnumber($t_amt) . ' ' . $cur }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t_fee) . ' ' . $cur }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t_cuscharge) . ' ' . $cur}}</td>
                    </tr>
                </tbody>
            </table>
        @elseif($tablename=='usercapital')
            <table class="table table-bordered kh16-b">
                <thead style="text-align:center;">
                    <th>ID</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>បុគ្គលិកពាក់ព័ន្ធ</th>
                    <th>ប្រតិបត្តិការណ៏</th>
                    <th>ប្រភេទ</th>
                    <th>ទឹកប្រាក់</th>
                    <th>ផ្សេងៗ</th>
                    <th>Ref_Number</th>

                </thead>
                <tbody>
                    @foreach ($showlink as $key=> $item)
                        <tr class="kh16" style="text-align:center;">
                            <td>{{ sprintf("%04d",$item->id) }}</td>
                            <td>
                                {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->useraffect->name }}</td>
                            <td>{{ $item->tranname . '(' . $item->trancode . ')' }}</td>
                            <td>{{ $item->agentname->name }}</td>
                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>

                            <td>{{ $item->note }}</td>
                            <td>{{ $item->ref_number }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif($tablename=='cashdraw')
            <table class="table table-bordered kh16-b">
                <thead style="text-align:center;">
                    <th>ID</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>មកពីដៃគូ</th>
                    <th>ទឹកប្រាក់បើក</th>
                    <th>កាត់សេវ៉ា</th>
                    <th>ប្រភេទទូទាត់</th>
                    <th>Receiver</th>
                    <th>ផ្សេងៗ</th>
                    <th>Ref_Number</th>
                </thead>
                <tbody>
                    @php
                        $t_amt=0;
                        $t_cutseva=0;
                    @endphp
                    @foreach ($showlink as $key=> $item)
                        @php
                            $t_amt+=$item->amount;
                            $t_cutseva+=$item->customer_charge;
                        @endphp
                        <tr class="kh16" style="text-align:center;">
                            <td>{{ sprintf("%04d",$item->id) }}</td>
                            <td>
                                {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                            </td>
                            <td>{{ $item->user->name }}</td>

                            <td>{{ $item->frompartner->name }}</td>

                            <td style="text-align:right;" title="{{$t_amt}}">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>

                            <td style="text-align:right;" title="{{$t_cutseva}}">{{ phpformatnumber($item->customer_charge) . ' ' . $item->cuschargecur->shortcut }}</td>
                            <td>{{ $item->paymethod }}</td>
                            <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                            <td>{{ $item->note }}</td>
                            <td>{{ $item->ref_number }}</td>

                        </tr>
                    @endforeach
                        <tr style="background-color:aqua;">
                            <td colspan=4>Total</td>
                            <td style="text-align:right;">{{phpformatnumber($t_amt) . ' ' . $cur}}</td>
                            <td></td>
                            <td style="text-align:right;">{{phpformatnumber($t_cutseva) . ' ' . $cur}}</td>
                        </tr>
                </tbody>
            </table>
        @elseif($tablename=='exchangemultis')
            <table class="table table-bordered kh16-b">
                <thead style="text-align:center;">
                    <th>ID</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>ទិញចូល</th>
                    <th>អត្រា</th>
                    <th>លក់ចេញ</th>

                </thead>
                <tbody>
                    @foreach ($showlink as $key=> $item)
                        <tr class="kh16" style="text-align:center;">
                            <td>{{ sprintf("%04d",$item->id) }}</td>
                            <td>
                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>

                            <td>{{ phpformatnumber($item->rate) }}</td>

                            <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif($tablename=='exchanges')
            <div class="tableFixHead">
                <table class="table table-bordered table-hover kh16-b">
                    <thead style="text-align:center;">
                        <th>ID</th>
                        <th>ថ្ងៃទី</th>
                        <th>អ្នកកត់ត្រា</th>
                        <th>រូបិយប័ណ្ណ</th>
                        <th>អត្រា</th>
                        <th>ទឹកប្រាក់</th>

                    </thead>
                    <tbody>
                        @php
                            $t_amt=0;
                            $t_product=0;
                        @endphp
                        @foreach ($showlink as $key=> $item)
                            @php
                                $t_product+=$item->product;
                                $t_amt+=$item->amount;
                            @endphp
                            <tr class="kh16" style="text-align:center;">
                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                <td>
                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td title="{{phpformatnumber($t_product)}}" style="text-align:right;@if($item->product>0)color:blue; @else color:red; @endif">{{ phpformatnumber($item->product) . ' ' . $item->pcur }}</td>
                                <td>{{ phpformatnumber($item->rate) }}</td>
                                <td title="{{phpformatnumber($t_amt)}}" style="text-align:right;@if($item->amount>0)color:blue; @else color:red; @endif">{{ phpformatnumber($item->amount) . ' ' . $item->maincur }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color:aqua;">
                            <td colspan=3>Total</td>
                            <td style="text-align:right;">{{phpformatnumber($t_product) . ' ' . $cur}}</td>
                            <td></td>
                            <td style="text-align:right;">{{phpformatnumber($t_amt) . ' ' . $cur}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @elseif($tablename=='expanse')
            <table class="table table-bordered kh16-b">
                <thead style="text-align:center;">
                    <th>ID</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>បុគ្គលិកពាក់ព័ន្ធ</th>
                    <th>ប្រតិបត្តិការណ៏</th>
                    <th>ទឹកប្រាក់</th>
                    <th>ផ្សេងៗ</th>
                    <th>Ref_Number</th>

                </thead>
                <tbody>
                    @foreach ($showlink as $key=> $item)
                        <tr class="kh16" style="text-align:center;">
                            <td>{{ sprintf("%04d",$item->id) }}</td>
                            <td>
                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                            </td>
                            <td>{{ $item->userrecord->name }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->tranname . '(' . $item->trancode . ')' }}</td>

                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>

                            <td>{{ $item->note }}</td>
                            <td>{{ $item->transfer_id }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

