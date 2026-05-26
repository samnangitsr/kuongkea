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

        <table id="tbl_partner_transfer" class="table table-bordered table-hover kh14" style="table-layout:fixed;">
            <thead style="text-align:center;" class="">
                <th style="width:60px;">លរ</th>
                <th style="width:100px;">ថ្ងៃទី</th>
                <th style="width:130px;">ប្រតិបត្តិការណ៏</th>
                <th style="width:200px;">ឈ្មោះដៃគូ</th>
                <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                <th style="width:100px;">សេវ៉ាវេរ</th>
                <th style="width:100px;">សេវ៉ាដៃគូ</th>
                <th style="width:100px;">សេវ៉ាថៃ</th>
                <th style="width:100px;">ប្រាក់ចំណេញ</th>
                <th style="width:150px;">សមតុល្យ</th>
                <th style="width:280px;">ពត៌មានអតិថិជន</th>
                <th style="width:250px;">កូតលុយ</th>
                <th style="width:100px;">លុយថៃ</th>
                <th style="width:70px;">អត្រា</th>
                <th style="width:80px;">សេវ៉ាថៃ</th>

                <th style="width:300px;">ផ្សេងៗ</th>
                <th style="width:100px;"> TID</th>
                <th style="width:100px;">ម៉ោង</th>
                <th style="width:150px;">អ្នកកត់ត្រា</th>

            </thead>
            @php
                $n=0;
                $balance=0;
            @endphp
            <tbody id="bodytransfer">
                @if($oldlist)
                    @php
                        $n=$n+1;
                        $balance=explode(';',$oldlist)[0];
                    @endphp
                    <tr class="kh12-b">
                        <td style="text-align:center;">{{ $n }}</td>
                        <td>{{ $listdate }}</td>
                        <td>បញ្ជីចាស់</td>
                        <td>{{ explode(';',$oldlist)[2] }}</td>
                        <td style="text-align:right;@if(explode(';',$oldlist)[0]>0) color:red @else color:blue @endif">{{ phpformatnumber(-1 * floatval(explode(';',$oldlist)[0])) . explode(';',$oldlist)[1] }}</td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:right;">0</td>
                        <td style="text-align:right;background-color:powderblue;@if(explode(';',$oldlist)[0]>0) color:red @else color:blue @endif">{{phpformatnumber(-1 * floatval(explode(';',$oldlist)[0])) . explode(';',$oldlist)[1] }}</td>
                        <td colspan=9></td>
                    </tr>
                @endif
                @php
                    $k=0;
                @endphp
                @foreach ($c as $t)
                    @php
                        $n=$n+1;
                        $profit=floatval($t['cuscharge_ex'])-floatval($t['fee_ex'])+floatval($t['thaiseva_ex']);
                         $balance= floatval($balance) + floatval($t['amount'])+ floatval($t['fee_ex']);
                         $k+=1;
                    @endphp
                    @if($k==1)
                        @php
                            $predate=$t['dd'];
                        @endphp
                        <tr class="kh12-b">
                            <td colspan=16>{{ date('d-m-Y',strtotime($t['dd'])) }}</td>
                        </tr>
                    @else
                        @if($t['dd']<>$predate)
                            @php
                                $predate=$t['dd'];
                            @endphp
                            <tr class="kh12-b">
                                <td colspan=16>{{ date('d-m-Y',strtotime($t['dd'])) }}</td>
                            </tr>
                        @endif
                    @endif
                    @php
                        $moneycode=explode("=",$t['moneycode']);
                    @endphp
                    <tr class="kh12-b">
                        <td style="text-align:center;">{{ $n }}</td>

                        <td>{{ date('d-m-Y',strtotime($t['dd'])) }}</td>

                        <td>{{ $t['tranname'] }}</td>
                        <td>{{ $t['partnername'] }}</td>
                        <td style="text-align:right;@if($t['amount']>0) color:red @else color:blue @endif">{{ phpformatnumber(-1 * $t['amount']) . $t['cur1']}}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t['cuscharge_ex']) . $t['cur1'] }}</td>
                        <td style="text-align:right;">{{ phpformatnumber(-1 * $t['fee_ex']) . $t['cur1'] }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t['thaiseva_ex']) . $t['cur1'] }}</td>
                        <td style="text-align:right;@if($profit>0) color:blue; @else color:red; @endif">{{ phpformatnumber($profit) . $t['cur1']}}</td>
                        <td style="text-align:right;background-color:powderblue; @if($balance>0) color:red @else color:blue @endif">{{ phpformatnumber(-1 * $balance) . $t['cur1'] }}</td>
                        <td>{{ $t['recname'] . $t['rectel'] }}</td>
                        <td>@if($t['moneycode']) {{  $moneycode[0] . '=' . $moneycode[1] }} @endif </td>
                        <td style="text-align:right;">{{ phpformatnumber($t['thai_amt']) }}B</td>
                        <td style="text-align:center;">{{ floatval($t['th_rate']) }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t['thai_seva']) }}B</td>

                        <td>{{ $t['note'] }}</td>
                        <td>{{ $t['tid'] }}</td>
                        <td>{{ $t['tt'] }}</td>
                        <td>{{ $t['saveby'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <table class="table-hover kh16-b" style="background-color:aquamarine;">
            <thead>
                <th style="border:1px solid black;padding:5px;">Total Profit:</th>
                @foreach ($totalprofit as $p)
                    <th style="border:1px solid black;padding:5px;">{{ phpformatnumber($p->tprofit) . $p->currency->sk  }}</td>

                @endforeach
            </thead>
        </table>

