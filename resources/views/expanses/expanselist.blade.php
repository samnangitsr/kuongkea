@php
    function phpformatnumber($num)
    {
        $dc = 0;
        $p = strpos((float) $num, '.');
        if ($p > 0) {
            $fp = substr($num, $p, strlen($num) - $p);
            $dc = strlen((float) $fp) - 2;
        }
        return number_format($num, $dc, '.', ',');
    }
@endphp
@foreach ($expanses as $k => $tr)
    <tr>
        <td style="text-align:center;padding:0px;" class="kh16">
            {{-- <input style="width:60px;text-align:center;" type="button" readonly value="{{ ++$k }}"> --}}
            <div class="dropdown">
                <button style="width:70px;" type="button" class="btn btn-primary dropdown-toggle kh16"
                    data-bs-toggle="dropdown">
                    {{ ++$k }}
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $tr->id }}">Print</a>
                    </li>
                    <li><a href="#" class="dropdown-item kh16-b btnedit" data-id="{{ $tr->id }}">Edit</a>
                    </li>
                </ul>
            </div>
        </td>

        <td class="kh16">{{ $tr->type }}</td>
        <td class="kh16">{{ $tr->customer->name }}</td>
        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amount) . $tr->currency->sk }}</td>
        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->inusd) . '$' }}</td>
        <td class="kh16-b" style="text-align:right;">{{ floatval($tr->rate) }}</td>
        <td class="kh16">{{ $tr->desr }}</td>
        <td class="kh16">{{ $tr->userrecord->name }}</td>
         <td class="kh16" style="">{{ $tr->tt }}</td>
        <td class="kh16">{{ $tr->user->name }}</td>
    </tr>
@endforeach
