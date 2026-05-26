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
@foreach ($olddata as $key => $od)
<tr>
    <td>{{ ++$key }}</td>
    <td>{{ date('d-m-Y',strtotime($od->trandate)) . ' ' . $od->trantime }}</td>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align:right;">{{ phpformatnumber($od->tamount) }}</td>
    <td></td>
    
    <td></td>
   
</tr>
@endforeach
@foreach ($newdata as $key => $bt)
<tr>
    <td>{{ ++$key }}</td>
    <td>{{ date('d-m-Y',strtotime($bt->trandate)) . ' ' . $bt->trantime }}</td>
    <td>{{ $bt->user->name }}</td>
    <td>{{ $bt->customer->name }}</td>
    <td>{{ $bt->tranname }}</td>
    <td style="text-align:right;">{{ phpformatnumber($bt->amount) }}</td>
    <td>{{ $bt->cur }}</td>
    
    <td>{{ $bt->note }}</td>
   
</tr>
@endforeach