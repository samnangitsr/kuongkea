@php
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        //$dc=strlen((float)$fp)-2;
          $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
@endphp
<div class="table-responsive">
    <table class="table table-bordered kh16 tbl_usertransaction">
        <thead style="text-align:center;">
            <th>លរ</th>
            <th>ម៉ោង</th>
            <th>បរិយាយ</th>
            <th>ចំនួនទឹកប្រាក់</th>
            <th>សមតុល្យ</th>
            <th>ផ្សេងៗ</th>
            <th>Action</th>
        </thead>
        <tbody>
            @php
                $balance=0;
            @endphp
            @foreach ($usertransactions as $key => $ut)
                <tr>
                    @php
                        $balance +=$ut->amount;
                    @endphp
                    <td class="en16" style="text-align:center;">{{ ++$key }}</td>
                    <td class="en16" style="text-align:center;">{{ $ut->tt }}</td>
                    <td class="kh16-b">{{ $ut->tranname }}</td>
                    <td class="amt {{ $ut->amount>=0?'blue':'red' }}">
                        @if($ut->amount>0)
                            +
                        @endif
                        {{ phpformatnumber($ut->amount) . ' ' . $ut->currency->shortcut }}
                    </td>
                    <td class="amt">{{ phpformatnumber($balance) . ' ' . $ut->currency->shortcut }}</td>
                    <td>{{ $ut->desr }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="#linkid{{ $ut->id }}" data-bs-toggle="collapse" title="{{ $ut->tablename }}">{{ $ut->link_id }}</a>
                        @if($ut->ref_number)
                            <a class="btn btn-primary btn-sm" href="#ref{{ $ut->id }}" data-bs-toggle="collapse">{{ $ut->ref_number }}</a>
                        @endif
                    </td>
                </tr>
                @foreach (App\UserCapital::showlink_id($ut->link_id,$ut->tablename) as $item)
                    <tr id="linkid{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                        <td colspan=7>
                            @if($ut->tablename=='partner_transfers')
                                <table class="table table-border">
                                    <thead style="text-align:center;">
                                        <th>TID</th>
                                        <th>ថ្ងៃទី</th>
                                        <th>អ្នកកត់ត្រា</th>
                                        <th>ដៃគូ</th>
                                        <th>ប្រតិបត្តិការណ៏</th>
                                        <th>សរុបទឹកប្រាក់</th>
                                        <th>សេវ៉ាដៃគូ</th>
                                        <th>សេវ៉ាអតិថិជន</th>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th>ផ្សេងៗ</th>
                                    </thead>
                                    <tbody>
                                        <tr class="kh16" style="text-align:center;">
                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                            <td>
                                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                            </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->partner->name }}</td>
                                            <td>{{ $item->tranname }}</td>
                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                            <td>{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}</td>
                                            <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                            <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                            <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                            <td>{{ $item->note }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($ut->tablename=='cashdraws')
                                <table class="table table-border">
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
                                    </thead>
                                    <tbody>
                                        <tr class="kh16" style="text-align:center;">
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
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($ut->tablename=='exchanges')
                                <table class="table table-border">
                                    <thead style="text-align:center;">
                                        <th>ID</th>
                                        <th>ថ្ងៃទី</th>
                                        <th>អ្នកកត់ត្រា</th>
                                        <th>ទំនិញ</th>
                                        <th>លុយ</th>
                                        <th>អត្រា</th>
                                        <th>ផ្សេងៗ</th>
                                    </thead>
                                    <tbody>
                                        <tr class="kh16" style="text-align:center;">
                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                            <td>
                                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                            </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ phpformatnumber($item->product) . ' ' . $item->pcur }}</td>
                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->maincur }}</td>
                                            <td>{{ phpformatnumber($item->rate)}}</td>
                                            <td>{{ $item->note }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif($ut->tablename=='user_capitals')
                                <table class="table table-border">
                                    <thead style="text-align:center;">
                                        <th>ID</th>
                                        <th>ថ្ងៃទី</th>
                                        <th>អ្នកកត់ត្រា</th>
                                        <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                        <th>បរិយាយ</th>
                                        <th>ចំនួនទឹកប្រាក់</th>
                                        <th>ផ្សេងៗ</th>
                                    </thead>
                                    <tbody>
                                        <tr class="kh16" style="text-align:center;">
                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                            <td>
                                                {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                            </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->useraffect->name }}</td>
                                            <td>{{ $item->tranname }}</td>
                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                            <td>{{ $item->note }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @php
                    $countdata=0;
                    $datarefs=App\UserCapital::showref_number($ut->ref_number);
                    if($datarefs){
                        $countdata=1;
                    }
                @endphp

                @if($countdata>0)
                    @foreach ($datarefs as $item)

                        @if(explode("-",$ut->ref_number)[0]=='transfer')
                            <tr id="ref{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                <td colspan=7>
                                    <table class="table table-border">
                                        <thead style="text-align:center;">
                                            <th>TID</th>
                                            <th>ថ្ងៃទី</th>
                                            <th>អ្នកកត់ត្រា</th>
                                            <th>ដៃគូ</th>
                                            <th>ប្រតិបត្តិការណ៏</th>
                                            <th>សរុបទឹកប្រាក់</th>
                                            <th>សេវ៉ាដៃគូ</th>
                                            <th>សេវ៉ាអតិថិជន</th>
                                            <th>Sender</th>
                                            <th>Receiver</th>
                                            <th>ផ្សេងៗ</th>
                                        </thead>
                                        <tbody>
                                            <tr class="kh16" style="text-align:center;">
                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                <td>
                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                </td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->partner->name }}</td>
                                                <td>{{ $item->tranname }}</td>
                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                <td>{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}</td>
                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                <td>{{ $item->note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>

                            </tr>
                        @elseif(explode("-",$ut->ref_number)[0]=='exchange')
                            <tr id="ref{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                <td colspan=7>
                                    <table class="table table-border">
                                        <thead style="text-align:center;">
                                            <th>ID</th>
                                            <th>ថ្ងៃទី</th>
                                            <th>អ្នកកត់ត្រា</th>
                                            <th>ទំនិញ</th>
                                            <th>លុយ</th>
                                            <th>អត្រា</th>
                                            <th>ផ្សេងៗ</th>
                                        </thead>
                                        <tbody>
                                            <tr class="kh16" style="text-align:center;">
                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                <td>
                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                </td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                <td>{{ $item->note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @elseif(explode("-",$ut->ref_number)[0]=='cashdraw')
                            <tr id="ref{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                <td colspan=7>
                                    <table class="table table-border">
                                        <thead style="text-align:center;">
                                            <th>TID</th>
                                            <th>ថ្ងៃបើក</th>
                                            <th>អ្នកកត់ត្រា</th>
                                            <th>ដៃគូ</th>
                                            <th>ប្រតិបត្តិការណ៏</th>
                                            <th>សរុបទឹកប្រាក់</th>
                                            <th>កាត់សេវ៉ា</th>
                                            <th>អ្នកទទួលប្រាក់</th>
                                            <th>ផ្សេងៗ</th>
                                        </thead>
                                        <tbody>
                                            <tr class="kh16" style="text-align:center;">
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
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @elseif(explode("-",$ut->ref_number)[0]=='usercapital')
                            <tr id="ref{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                <td colspan=7>
                                    <table class="table table-border">
                                        <thead style="text-align:center;">
                                            <th>ID</th>
                                            <th>ថ្ងៃទី</th>
                                            <th>អ្នកកត់ត្រា</th>
                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                            <th>បរិយាយ</th>
                                            <th>ចំនួនទឹកប្រាក់</th>
                                            <th>ផ្សេងៗ</th>
                                        </thead>
                                        <tbody>
                                            <tr class="kh16" style="text-align:center;">
                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                <td>
                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                </td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->useraffect->name }}</td>
                                                <td>{{ $item->tranname }}</td>
                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                <td>{{ $item->note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endif

                    @endforeach
                @endif
            @endforeach

        </tbody>
    </table>
</div>
