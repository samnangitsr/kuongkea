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
<div class="table-responsive">
    <table class="table table-bordered table-hover kh14-b tbl_transferlist" style="">
       <thead style="text-align:center;" class="kh14">
           <th style="width:40px;">No</th>
           <th style="width:60px;">ID</th>
           <th style="width:100px;">ថ្ងៃទូទាត់</th>
           <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
           <th style="width:150px;">ប្រភេទទូទាត់</th>
           <th style="width:150px;">អ្នកលក់</th>
           <th style="width:200px;">ប្លុក</th>
           <th style="width:100px;">គិតពី</th>
           <th style="width:100px;">រហូតដល់</th>
           <th style="width:150px;">អ្នកកត់ត្រា</th>
           <th style="width:100px;">ម៉ោងកត់ត្រា</th>
           <th style="width:100px;">សក</th>
       </thead>
       <tbody id="">
           @foreach ($paidcoms as $key => $p)
               <tr>
                   <td style="width:40px;text-align:center;">{{ ++$key }}</td>
                   <td style="width:60px;text-align:center;">{{ $p->id }}</td>
                   <td>{{ date('d-m-Y',strtotime($p->dd)) }}</td>
                   <td style="text-align:right;">
                        <a href="{{ route('realestate.linkpaycommission',['id'=>$p->id]) }}" class="kh16-b " target="_blank" style="">{{ phpformatnumber($p->amount) . ' ' . $p->cur }}</a>

                    </td>
                   <td>{{ $p->payment_type }}</td>
                   <td>{{ $p->saler??'' }}</td>
                   {{-- <td>{{ $p->selblock??'' }}</td> --}}
                    <td class="td_selblock">
                        <span class="short-text">
                            {{ Str::limit($p->selblock, 20, '...') }}
                        </span>
                        <span class="full-text d-none">{{ $p->selblock }}</span>
                        <a href="javascript:void(0)" class="toggle-text kh14" style="color:blue;">more</a>
                    </td>

                   <td>{{ date('d-m-Y',strtotime($p->d1)) }}</td>
                   <td>{{ date('d-m-Y',strtotime($p->d2)) }}</td>
                   <td>{{ $p->user->name }}</td>
                   <td>{{ $p->tt }}</td>
                   <td style="text-align:center;">
                       <a href="" class="btndelete" data-id="{{$p->id}}" style="color:red;">Remove</a>
                   </td>
               </tr>
           @endforeach
       </tbody>

   </table>
</div>
