@php
function phpformatnumber($num) {
    // if not numeric, just return as-is
    if (!is_numeric($num)) {
        return $num;
    }

    $dc = 0;
    $num = (float)$num; // force number

    // find decimals
    $p = strpos((string)$num, '.');
    if ($p !== false) {
        $fp = substr((string)$num, $p + 1);
        $dc = strlen(rtrim($fp, '0')); // count decimals without trailing 0
    }

    return number_format($num, $dc, '.', ',');
}

@endphp
@foreach ($agentratelist as $key => $item)
    <tr data-id="{{ $item->id }}">
        <td style="text-align:center;">{{ ++$key }}</td>
        <td style="text-align:center;" class="kh16-b amt1">{{ phpformatnumber($item->amt1) }}</td>
        <td style="text-align:center;" class="kh16-b amt2">{{ phpformatnumber($item->amt2) }}</td>

        <td style="text-align:center;" class="kh16-b customer_rate">{{ phpformatnumber($item->customer_rate) }}</td>
        <td style="text-align:center;" class="kh16-b transfer_rate">{{ phpformatnumber($item->transfer_rate) }}</td>
        <td style="text-align:center;" class="kh16-b cashdraw_rate">{{ phpformatnumber($item->cashdraw_rate) }}</td>
        <td style="padding:0px;text-align:center;">
            <a href="#" class="btn btn-warning btn-sm kh12-b btnedit kh12-b" data-id="{{ $item->id }}"><i class="fa fa-pencil"></i></a>
            <a href="#" class="btn btn-danger btn-sm kh12-b btndel kh12-b" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
@endforeach

