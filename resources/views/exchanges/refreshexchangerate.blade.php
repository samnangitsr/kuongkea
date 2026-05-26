@php
    $nbuy='';
    $nsale='';
@endphp
@foreach ($curleft as $c1)
@php
    if($c1->ispandp==1){
        $ssh=explode('-',$c1->shortcut);
        $nbuy=$ssh[0].'-'.$ssh[1];
        $nsale=$ssh[1].'-'.$ssh[0];
    }else{
        $nbuy=$c1->shortcut . '-USD';
        $nsale='USD-' . $c1->shortcut;
    }
@endphp
 <tr class="kh22-b">
    <td style="text-align:center;">
        <span>
            {{ $c1->curname }}
        </span>
        <br>
        <span>
            {{$c1->shortcut}}
        </span>
    </td>
    <td style="text-align:right;color:blue;">
        <button class="btnshowrate" title="{{$nbuy}}" style="width:100%;">
            <span class="kh16-b badge bg-secondary" style="position: relative;top:-10px;color:white;">
                {{$nbuy}}
            </span>
            <br>
            <span style="position: relative;top:-10px;font-weight:bold;font-size:32px;color:blue;">
                {{ $c1->ratebuy }}
            </span>
        </button>
    </td>
    <td style="text-align:right;color:red;">
        <button class="btnshowrate" title="{{$nsale}}" style="width:100%;">
            <span class="kh16-b badge bg-secondary" style="position: relative;top:-10px;color:white;">
                {{$nsale}}
            </span>
            <br>
            <span style="position: relative;top:-10px;font-weight:bold;font-size:32px;color:red;">
                {{ $c1->ratesale }}
            </span>
        </button>
    </td>
</tr>
@endforeach
