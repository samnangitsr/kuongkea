@php
 function phpformatnumber($num)
    {
        if (!is_numeric($num)) {
            return $num;
        }

        $num = (string)$num;
        $dc = 0;

        if (strpos($num, '.') !== false) {
            $decimals = explode('.', $num)[1];
            // Count actual meaningful decimals (but max 4)
            $dc = min(strlen(rtrim($decimals, '0')), 4);
        }

        return number_format((float)$num, $dc, '.', ',');
    }
@endphp
<div class="col-lg-3" style="margin:0px;padding:0px;">
    <div class="tableFixHead" style="padding:0px;margin:0px 5px 0px 0px;">
        <table class="table table-bordered table-hover kh14-b tbl_mainlist" style="table-layout: fixed">
            <thead style="text-align:center;">
                <th style="width:40px;">N <sup>o</sup></th>
                <th>រូបិយប័ណ្ណ</th>
                <th style="width:60px;">ចំនួន</th>

            </thead>
            <tbody>
                @php
                    $allqty=0;
                @endphp
                @foreach ($sumexchangelist as $k =>$item)
                    @php
                        $allqty+=$item->qty;
                    @endphp
                    <tr class="item">
                        <td style="text-align:center;">{{ ++$k }}</td>
                        <td style="text-align:center;">{{ $item->curstr }}</td>
                        <td style="text-align:center;" class="tdqty">{{ $item->qty }}</td>

                    </tr>
                @endforeach
                <tr style="background-color:gold;" class="item">
                    <td style="border:1px solid black"></td>
                    <td style="text-align:center;border:1px solid black">Total</td>
                    <td style="text-align:center;border:1px solid black;" class="tdqty">{{ $allqty }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-lg-9" style="margin:0px;padding:0px;">
    <div class="tableFixHead" style="padding:0px;margin:0px;">
        <table id="tblexchangelist" class="table table-bordered table-hover tblexchangelist kh14-b" style="table-layout: fixed;">
            <thead style="text-align:center;">
                <th style="width:65px;">លរ</th>
                <th style="width:100px;">ប្តូរប្រាក់</th>
                <th style="width:170px;">ទិញចូល</th>
                <th style="width:150px;">អត្រា</th>
                <th style="width:170px;">លក់ចេញ</th>
                <th style="width:150px;">សកម្មភាព</th>
                <th style="width:100px;">ថ្ងៃទី</th>
                <th style="width:80px;">ម៉ោង</th>
                <th style="width:150px;">អ្នកកត់ត្រា</th>
                 <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                <th style="width:500px;">សំគាល់</th>

            </thead>
            <tbody id="bodyexchangelist">
                 @php
                    $dd='';
                    $created_at='';
                @endphp
                @foreach ($exchangelists as $key=>$e)
                    @php
                        $dd=date('Y-m-d',strtotime($e->dd));
                        $created_at=date('Y-m-d',strtotime($e->created_at));
                    @endphp
                    <tr id="tr_object_id_{{ $e->mapcode }}">
                        <td class="kh14" style="text-align:center;">{{ ++$key }}</td>
                        <td style="text-align:center;@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ $e->curbuy . '-' . $e->cursale }}</td>
                        <td style="text-align:right;color:blue;">+{{ phpformatnumber($e->buy) . ' ' . $e->curbuy }}</td>
                        <td style="text-align:right;{{ $e->rate<>$e->drate?'background-color:yellow':'' }}">
                            @if($e->rate <> $e->drate)
                                {{ $e->rate . '(' . $e->drate . ')' }}
                            @else
                                {{ $e->rate }}
                            @endif
                        </td>
                        <td style="text-align:right;color:red;">-{{ phpformatnumber($e->sale) . ' ' . $e->cursale }}</td>
                        <td style="text-align:center;">
                            @if($e->status==1)
                                @if($e->isexchangelist==0)
                                    @if(str_contains($e->action,'d'))
                                    <a data-id="{{ $e->mapcode }}" class="mybtn btndel" href="">Delete</a>
                                    @endif
                                    <a data-id="{{ $e->mapcode }}" class="mybtn btnprint" href="">Print</a>
                                @endif
                            @else
                                {{ $e->userdel }}
                            @endif
                        </td>
                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                        <td>{{ $e->tt }}</td>
                        <td>{{ $e->user->name }}</td>
                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->created_at)) }}</td>
                        <td style="text-align:center;">{{ $e->note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
