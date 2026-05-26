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

@foreach ($contracts as $key =>$ct)
<tr>
    <td class="kh14" style="text-align:center;">{{ ++$key }}</td>
    <td class="kh14">{{ date('d-m-Y',strtotime($ct->reg_date)) }}</td>
    <td class="kh14">{{ $ct->user->name ?? '' }}</td>
    <td class="kh14" title="{{ $ct->customer_id }}">{{ $ct->name_b }}</td>
    <td class="kh14" title="{{ $ct->saler_id }}">{{ $ct->name_c }}</td>
    <td class="kh14" title="{{ $ct->property_id }}">{{ $ct->propertyname }}</td>
    <td class="kh14">{!! $ct->size !!}</td>
    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($ct->price) }}$</td>
    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($ct->discount ?? 0) }} {{ $ct->disc_by ?? '' }}</td>
    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($ct->priceafterdiscount) }}$</td>
    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($ct->pay) }}$</td>
    <td class="kh14" style="text-align:center;">{{ $ct->d . ' ' . $ct->m . ' ' . $ct->y }}</td>
    <td class="kh14">{{ $ct->paytype==1?'បង់ផ្តាច់':'រំលស់' }}</td>

    <td style="text-align:center;">
        <a href="{{ route('realestate.printcontract',['id'=>$ct->id]) }}" class="mybtn1" target="_blank"><i class="fa fa-print" style="color:black;"></i></a>
        @if (Auth::user()->role->name<>'Admin')
            @if (App\User::checkpermission(Auth::id(),'1.8.2'))
                <a href="" class="btndel mybtn1" data-id="{{ $ct->id }}"><i class="fa fa-trash" style="color:red;"></i></a>
            @endif
            @if (App\User::checkpermission(Auth::id(),'1.8.1'))
                <a href="" class="btnedit mybtn1" data-id="{{ $ct->id }}"><i class="fa fa-pencil" style="color:green;"></i></a>
            @endif
        @else
            <a href="" class="btndel mybtn1" data-id="{{ $ct->id }}"><i class="fa fa-trash" style="color:red;"></i></a>
            <a href="" class="btnedit mybtn1" data-id="{{ $ct->id }}"><i class="fa fa-pencil" style="color:green;"></i></a>
        @endif

    </td>
    <td class="kh14">{{ date('d-m-Y',strtotime($ct->created_at)) }}</td>
</tr>
@endforeach
