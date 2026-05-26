
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

<div class="col-lg-12">
     <div class="tableFixHead" style="padding:0px;margin:0px;">
    <table id="tbl_income" class="table table-bordered table-hover kh14-b tbl">
        <thead style="text-align:center;">
            <th>លរ</th>
            <th>ថ្ងៃទី</th>
            <th>ID</th>
            <th>ឈ្មោះអ្នកទិញ</th>
            <th>ប្រតិបត្តិការណ៏</th>
            <th>ចំនួនទឹកប្រាក់</th>
            <th>ប្រាក់ពិន័យ</th>
            <th>សរុប</th>
            <th>លើកលែង</th>
            <th>ទូទាត់តាម</th>
            <th>សំរាប់ខែ</th>
            <th>អ្នកកត់ត្រា</th>
            <th>កំណត់សំគាល់</th>
        </thead>
        <tbody>
            @php
                $total=0;
                $cuscharge=0;
                $discount=0;
            @endphp
            @foreach ($incomes as $key => $in)
                @php
                    $total +=$in->amount;
                    $cuscharge +=$in->cuscharge;
                    $discount +=$in->discount_amount
                @endphp
                <tr>
                    <td style="text-align:center;">{{ ++$key }}</td>
                    <td>{{ date('d-m-Y',strtotime($in->dd)) }}</td>
                    <td>{{ $in->id }}</td>
                    <td>{{ $in->customername }}</td>
                    <td>{{ $in->tranname . ' ' . $in->sendername }}</td>
                    <td style="text-align:right;color:blue;">{{ phpformatnumber($in->amount) . $in->currency->sk}}</td>
                    <td style="text-align:right;@if($in->cuscharge!=0) color:red; @endif">{{ phpformatnumber($in->cuscharge) . $in->cuschargecur->sk}}</td>
                    <td class="totalpay" style="text-align:right;color:blue;">{{ phpformatnumber($in->amount+$in->cuscharge) . $in->currency->sk}}</td>
                    <td style="text-align:right;">
                        <a href="" style="@if($in->discount_amount!=0) color:red; @else color:black; @endif" class="btndiscount" data-id="{{ $in->id }}" data-cusname="{{ $in->partner->name }}" data-tranname="{{ $in->tranname }}" data-amount="{{ $in->amount }}" data-cuscharge="{{ $in->cuscharge }}" data-cur="{{ $in->currency->shortcut }}" data-overday="{{ $in->overday }}" data-overprice="{{ $in->overprice }}" data-setoverday="{{ $in->setoverday }}" data-setoverprice="{{ $in->setoverprice }}" data-discount="{{ $in->discount_amount }}"> {{ phpformatnumber($in->discount_amount) . $in->cuschargecur->sk}}</a>
                    </td>
                    <td>{{ $in->deposit_via }}</td>
                    <td>{{ $in->payformonth?date('d-m-Y',strtotime($in->payformonth)):'' }}</td>
                    <td>{{ $in->user->name }}</td>
                    <td>{{ $in->note }}</td>
                </tr>
            @endforeach
            <tr style="background-color:blue;">
                <td class="kh16-b" style="color:white;" colspan=5>សរុបចំណូល</td>
                <td class="kh16-b" style="text-align:right;color:white;">{{ phpformatnumber($total) . '$'}}</td>
                <td class="kh16-b" style="text-align:right;color:white;">{{ phpformatnumber($cuscharge) . '$'}}</td>
                <td class="kh16-b" style="text-align:right;color:white;">{{ phpformatnumber($total+$cuscharge) . '$'}}</td>
                <td class="kh16-b" style="text-align:right;color:white;">{{ phpformatnumber($discount) . '$'}}</td>
                <td colspan=4></td>
            </tr>
        </tbody>

    </table>
    <div id="totalAmountDisplay" class="kh22-b" style=""></div>
    </div>
</div>
<div class="col-lg-12">
    <div class="tableFixHead" style="padding:0px;margin:0px;">
    <table id="tbl_expanse" class="table table-bordered table-hover kh14-b tbl">
        <thead style="text-align:center;background-color:aqua">
            <th>លរ</th>
            <th>ថ្ងៃទី</th>
            <th>ID</th>
            <th>ឈ្មោះអ្នកលក់</th>
            <th>ប្រតិបត្តិការណ៏</th>
            <th>ចំនួនទឹកប្រាក់</th>
            <th>ទូទាត់តាម</th>
            <th>អ្នកកត់ត្រា</th>

        </thead>
        <tbody style="background-color:rgb(235, 186, 231);">
            @php
                $total=0;
            @endphp
            @foreach ($expanses as $key => $out)
                @php
                    $total +=$out->amount;
                @endphp
                <tr>
                    <td style="text-align:center;">{{ ++$key }}</td>
                    <td>{{ date('d-m-Y',strtotime($out->dd)) }}</td>
                    <td>{{ $out->id }}</td>
                    <td>{{ $out->customername }}</td>
                    <td>{{ $out->tranname . ' ' . $out->sendername }}</td>
                    <td style="text-align:right;color:red;">{{ phpformatnumber($out->amount) . $out->currency->sk}}</td>
                    <td>{{ $out->deposit_via }}</td>
                    <td>{{ $out->user->name }}</td>
                </tr>
            @endforeach
                <tr style="background-color:red;">
                    <td class="kh16-b" style="color:white;" colspan=5>សរុបចំណាយ</td>
                    <td class="kh16-b" style="text-align:right;color:white;">{{ phpformatnumber($total) . '$'}}</td>
                    <td colspan=2></td>
                </tr>
        </tbody>
    </table>
</div>
</div>


