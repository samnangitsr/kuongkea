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
        $balance=0;
        $cashin=0;
        $cashout=0;
    @endphp
@if($startbal<>0)
        @php
            $balance+=$startbal;
        @endphp
        <tr style="">
            <td style="text-align:center;"></td>
            <td></td>
            <td>{{ date('d-m-Y',strtotime($closedate)) }}</td>
            <td>{{ $closetime }}</td>
            <td style="border-right:1px solid black;">លុយចាប់ផ្តើមបញ្ជី</td>
            <td style="text-align:right;border:1px solid black;@if($startbal>0) color:blue; @else color:red; @endif">{{$startbal>0?'+' . phpformatnumber($startbal): phpformatnumber($startbal) }} THB</td>
            <td style="text-align:right;@if($balance>0) color:blue; @else color:red; @endif">{{ phpformatnumber($balance) . ' THB'}}</td>
            <td></td>
        </tr>
@endif
@if($oldlist<>0)
        @php
            $balance+=$oldlist;
        @endphp
        <tr style="">
            <td style="text-align:center;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border-right:1px solid black;">បញ្ជីចាស់</td>
            <td style="text-align:right;border:1px solid black;@if($oldlist>0) color:blue; @else color:red; @endif">{{$oldlist>0?'+' . phpformatnumber($oldlist): phpformatnumber($oldlist) }} THB</td>
            <td style="text-align:right;@if($balance>0) color:blue; @else color:red; @endif">{{ phpformatnumber($balance) . ' THB'}}</td>
            <td>គិតពី {{ date('d-m-Y',strtotime($closedate)) }} ដល់ {{ date('d-m-Y',strtotime($d1)) }}</td>
        </tr>
@endif
@foreach ($data as $key => $item)
    @php
        $balance+=$item->amount;
        if($item->amount>0){
            $cashin+=$item->amount;
        }elseif($item->amount<0){
            $cashout+=$item->amount;
        }
    @endphp
    <tr style="">
        <td style="text-align:center;">{{ ++$key }}</td>
        <td>{{ $item->id }}</td>
        <td>{{ date('d-m-Y',strtotime($item->smsdate)) }}</td>
        <td>{{ $item->smstime }}</td>
        <td style="border-right:1px solid black;">{{ $item->amount>0?'ដាក់ចូល':'ដកចេញ' }}</td>
        <td style="text-align:right;border:1px solid black;@if($item->amount>0) color:blue; @else color:red; @endif">{{$item->amount>0?'+' . phpformatnumber($item->amount): phpformatnumber($item->amount) }} {{ $item->cur }}</td>
        <td style="text-align:right;@if($balance>0) color:blue; @else color:red; @endif">{{ phpformatnumber($balance) . ' THB'}}</td>
        <td>{{ $item->smstext }}</td>
        <td>{{ $item->customer->name??'' }}</td>

        <td>{{ $item->smsby }}</td>
    </tr>
@endforeach
<tr>
    <td colspan=7>
        <table class="kh16-b">
            <tr>
                <td>លុយចាប់ផ្តើមបញ្ជី</td>
                <td>បញ្ជីចាស់</td>
                <td>លុយដាក់ចូល</td>
                <td>លុយដកចេញ</td>
                <td>សមតុល្យ</td>

            </tr>
            <tr>
                <td style="color:blue;">{{ phpformatnumber($startbal) }}B</td>
                <td style="@if($oldlist>0)color:blue; @else color:red; @endif">{{ phpformatnumber($oldlist) }}B</td>
                <td style="color:blue;">{{ phpformatnumber($cashin) }}B</td>
                <td style="color:red;">{{ phpformatnumber($cashout) }}B</td>
                <td style="@if($balance>0)color:blue; @else color:red; @endif">{{ phpformatnumber($balance) }}B</td>

            </tr>
        </table>
    </td>
</tr>
