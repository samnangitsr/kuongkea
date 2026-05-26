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
<div class="table-responsive">
    <table class="table table-bordered table-hover tbl3">
        <thead style="text-align:center;">
            <th>No</th>
            <th>ID</th>
            <th>GroupID</th>
            <th>Date</th>
            <th>Tranname</th>
            <th>Customer</th>
            <th>Amount</th>
            <th>Charge</th>
            <th>PayMonth</th>
            <th>Act</th>
            <th>CreatedAt</th>

        </thead>
        <tbody>
            @foreach ($payinfos as $key => $item)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $item->id }}</td>
                    <td>
                        <a href="#group{{ $item->ref_group_id }}" data-groupid="{{ $item->ref_group_id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ $item->ref_group_id }}</a>
                    </td>
                    <td>{{ date('d-M-y',strtotime($item->dd))}}</td>
                    <td class="kh14-b">{{ $item->tranname }}</td>
                    <td class="kh14-b">{{ $item->partner->name }}</td>
                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($item->amount) . $item->currency->sk  }}</td>
                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($item->cuscharge) . $item->cuschargecur->sk  }}</td>
                    <td>{{ date('d-M-y',strtotime($item->payformonth))}}</td>
                    <td>

                        <a href="#" style="padding:0px;" class="btn btn-sm btnremovegroup" data-ref_group_id="{{ $item->ref_group_id }}">
                            <i class="fa fa-trash" style="color:red;"></i>
                        </a>
                    </td>
                    <td>{{ date('d-M-y',strtotime($item->created_at))}}</td>

                </tr>
                <tr id="group{{ $item->ref_group_id }}" class="collapse borderset2" style="">
                    <td colspan=10 style="">
                        <table class="table table-bordered" style="margin:0px;">
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach (App\PartnerTransfer::showbygroupall($item->ref_group_id) as $item1)
                                    @php
                                        $i=$i+1;
                                    @endphp
                                    @if($i==1)
                                        <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                            <td style="width:100px;">ID</td>
                                            <td style="width:90px;">Date</td>
                                            <td style="width:80px;">Time</td>
                                            <td style="width:150px;">ប្រតិបត្តិការណ៏</td>
                                            <td style="width:250px;">ដៃគូ</td>
                                            <td style="width:120px;">ចំនួនទឹកប្រាក់</td>
                                            <td style="width:80px;">ពិន័យ</td>
                                            <td style="width:80px;">Status</td>
                                            <td style="width:100px;">អ្នកកត់ត្រា</td>
                                            <td style="width:100px;">CreatedAt</td>
                                            <td style="">ផ្សេងៗ</td>
                                        </tr>
                                    @endif
                                    <tr class="kh12-b" style="">
                                        <td style="text-align:center;">{{ $item1->id }}</td>
                                        <td>{{ date('d-m-Y',strtotime($item1->dd))}}</td>
                                        <td>{{ $item1->tt }}</td>
                                        <td>{{ $item1->tranname }}</td>
                                        <td>{{ $item1->partner->name }}</td>
                                        <td style="text-align:right;">{{ phpformatnumber($item1->amount) . ' ' . $item1->currency->sk }}</td>
                                        <td style="text-align:right;">{{ phpformatnumber($item1->cuscharge) . ' ' . $item1->cuschargecur->sk }}</td>
                                        <td>{{ $item1->status }}</td>
                                        <td>{{ $item1->user->name }}</td>
                                        <td>{{ date('d-m-Y',strtotime($item1->created_at))}}</td>
                                        <td>{{ $item1->note }}</td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
