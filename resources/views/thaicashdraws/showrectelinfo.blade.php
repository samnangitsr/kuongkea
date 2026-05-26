@extends('master')
@section('title') ShowRectelTransfer @endsection
@section('css')
    <style type="text/css">
         .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
            .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
            .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }
       .cgr{
        background-color:aquamarine;
       }
       .tbl_seedetail .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_seedetail .clickedrow td input{
        background-color: #caaf8f;
    }
    .red{
        color:red;
    }
    .blue{
        color:blue;
    }
    </style>
@endsection
@section('content')
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

<div class="row" style="margin-bottom:10px;">
    <div class="col-lg-6">
        <h1 class="kh22-b" style="color:red;text-decoration:underline;">លេខអ្នកទទួល {{ $rectel }}</h1>
    </div>

</div>

   <div class="row">
    <div class="table-responsive">
        <table class="table table-bordered kh16-b tbl_seedetail">
            <thead>
                <th>លរ</th>
                <th>ថ្ងៃទី</th>
                <th>ប្រតិបត្តិការណ៏</th>
                <th>អ្នកកត់ត្រា</th>
                <th>ឈ្មោះដៃគូ</th>
                <th>ចំនួនទឹកប្រាក់</th>
                <th>សេវ៉ាវេរ</th>
                <th>សេវ៉ាដៃគូ</th>
                <th>អ្នកទទួល</th>
                <th>អ្នកផ្ញើ</th>
                <th>លុយថៃ</th>
                <th>ធ្វើកូតដោយ</th>
                <th>ផ្សេងៗ</th>
            </thead>
            <tbody>
                @foreach ($transfers as $key =>$t)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ date('d-m-Y',strtotime($t->dd)) }} <br> {{ $t->tt }}</td>
                        <td>{{ $t->tranname }}</td>
                        <td>{{ $t->user->name }}</td>
                        <td>{{ $t->partner->name }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t->amount) . ' ' . $t->currency->shortcut }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t->cuscharge) . ' ' . $t->cuschargecur->shortcut }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t->fee) . ' ' . $t->feecurrency->shortcut }}</td>
                        <td>{{ $t->rectel }} <br> {{ $t->recname }}</td>
                        <td>{{ $t->sendertel }} <br> {{ $t->sendername }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t->thai_amt) . ' THB' }}</td>
                        <td>{{ $t->usercode->name??'' }}</td>
                        <td>{{ $t->note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('script')

    <script type="text/javascript">
       $(document).ready(function () {
            $(document).on('click','.tbl_seedetail td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })

       })
    </script>
@endsection



