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
        $i=0;
    @endphp

@foreach ($closelists as $key =>$cl)
    {{ $i++ }}
    <tr>
        <td class="kh16" style="text-align:center;width:60px;">{{ ++$key }}</td>
        <td class="kh16" style="width:100px;">{{ date('d-m-Y',strtotime($cl->closedate)) }}</td>
        <td class="kh16" style="width:80px;">{{ $cl->closetime }}</td>
        <td class="kh16" style="width:150px;">{{ $cl->closeby }}</td>
        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($cl->usd) }}</td>
        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($cl->thb) }}</td>
        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($cl->khr) }}</td>
        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($cl->vnd) }}</td>
        <td class="kh12-b" style="text-align:right;">{{ $cl->transaction_id }}</td>
       <td class="kh12-b" style="text-align:right;">{{ $cl->exchange_id }}</td>
       <td class="kh12-b" style="text-align:right;">{{ $cl->sms_id }}</td>
        @if($i==1)
            <td style="width:60px;text-align:center;">
                <a href="" class="btn btn-danger btn-sm btn-delcloselist" data-id="{{ $cl->id }}">Del</a>
            </td>
        @else
            <td style="width:60px;"></td>
        @endif
    </tr>
@endforeach
