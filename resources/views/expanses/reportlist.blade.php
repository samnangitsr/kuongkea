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
   <table id="tbl_report" class="table table-bordered table-hover tbl_report" style="margin:0px;padding:0px;table-layout:fixed;">
        <thead style="text-align:center;" class="kh16">
            <th style="width:70px;padding:3px;">No</th>
            <th style="width:100px;padding:3px;">ថ្ងៃកត់ត្រា</th>
            <th style="width:200px;padding:3px;">ប្រភេទចំណាយ</th>
            <th style="width:180px;padding:3px;">បរិយាយ</th>
            <th style="width:250px;padding:3px;">ធនាគា</th>
            <th style="width:150px;padding:3px;">ចំនួនទឹកប្រាក់</th>
            <th style="width:100px;padding:3px;">គិតជាដុល្លា</th>
            <th style="width:100px;padding:3px;">អត្រា</th>
            <th style="width:100px;padding:3px;">អ្នកកត់ត្រា</th>
            <th style="width:100px;padding:3px;">ម៉ោង</th>
            <th style="width:100px;padding:3px;">បុ.ពាក់ព័ន្ធ</th>
        </thead>
        <tbody id="body_report">
            @php

            @endphp
            @foreach ($expanses as $k => $tr)
                <tr>
                    <td style="text-align:center;padding:0px;" class="kh16">{{ ++$k }}</td>
                    <td class="kh16" style="">{{ date('d-m-Y',strtotime($tr->dd)) }}</td>
                    <td class="kh16">{{ $tr->type }}</td>
                    <td class="kh16">{{ $tr->desr }}</td>
                    <td class="kh16">{{ $tr->customer->name }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amount) .$tr->currency->sk }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->inusd) . '$' }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ floatval($tr->rate) }}</td>
                    <td class="kh16">{{ $tr->userrecord->name }}</td>
                    <td class="kh16" style="">{{ $tr->tt }}</td>
                    <td class="kh16">{{ $tr->user->name }}</td>
                </tr>
            @endforeach
            <table>
                <thead>
                    <th style="border:1px solid black;padding:5px;">Total</th>
                    @foreach ($total as $t)
                        <th style="border:1px solid black;padding:5px;@if($t->total<0) color:red; @else color:blue; @endif">{{ phpformatnumber($t->total) . ' ' . $t->currency->shortcut}}</th>
                    @endforeach
                </thead>
            </table>
        </tbody>

    </table>

