@php
function phpformatnumber($num){
    $dc=0;
    $p=strpos((float)$num,'.');
    if($p>0){
    $fp=substr($num,$p,strlen($num)-$p);
    $dc=strlen((float)$fp)-2;

    }
    if($dc>2){
        $dc=2;
    }
    return number_format($num,$dc,'.',',');
}
@endphp

@foreach ($closelist as $key => $cl)
    <tr>
        <td class="en16" style="text-align:center;">{{ ++$key }}</td>
        <td class="en16">
            {{ $cl->closeby }}
        </td>
        <td class="en16">
           {{ date('d-m-Y',strtotime($cl->closedate))  }}
        </td>
        <td class="en16">
            {{ date('d-m-Y',strtotime($cl->olddate))  }}
         </td>
         <td class="en16 old {{ $cl->oldinusd>0?'cblue':'cred' }}">
            {{ phpformatnumber($cl->oldinusd) }}
         </td>
         <td class="en16 new {{ $cl->newinusd>0?'cblue':'cred' }}">
            {{ phpformatnumber($cl->newinusd) .'$'}}
         </td>
         <td class="en16 new">
            {{ phpformatnumber($cl->expanse) .'$'}}
         </td>
         <td class="en16 new">
            {{ phpformatnumber($cl->income) .'$'}}
         </td>

         <td class="en16 @if($cl->newinusd-$cl->oldinusd+$cl->expanse+$cl->income>0) cblue @else cred @endif" style="background-color:yellow;text-align:right;">
            {{ phpformatnumber($cl->newinusd-$cl->oldinusd+$cl->expanse+$cl->income) . '$' }}
         </td>

         <td class="en16 old">
            {{ phpformatnumber($cl->oldusd) }}
         </td>
         <td class="en16 old">
             {{ phpformatnumber($cl->oldthb) }}
          </td>
          <td class="en16 old">
            {{ phpformatnumber($cl->oldkhr) }}
         </td>
         {{-- <td class="en16 old">
          {{ phpformatnumber($cl->oldvnd) }}
        </td> --}}

        <td class="en16 new {{ $cl->newusd>0?'cblue':'cred' }}">
            {{ phpformatnumber($cl->newusd) . '$'}}
         </td>
         <td class="en16 new {{ $cl->newthb>0?'cblue':'cred' }}">
             {{ phpformatnumber($cl->newthb) .'B'}}
          </td>
          <td class="en16 new {{ $cl->newkhr>0?'cblue':'cred' }}">
            {{ phpformatnumber($cl->newkhr) .'R'}}
         </td>
         {{-- <td class="en16 new">
           {{ phpformatnumber($cl->newvnd) .'V'}}
        </td> --}}

          <td class="en16" style="text-align:right;">
            {{ $cl->rate_thb }}
         </td>
         <td class="en16" style="text-align:right;">
            {{ $cl->rate_khr }}
         </td>
         {{-- <td class="en16">
          {{ $cl->rate_vnd }}
       </td> --}}
    </tr>
@endforeach
