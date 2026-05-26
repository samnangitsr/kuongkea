@extends('master')
@section('title') Check Cashdraw Other @endsection
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

        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }

       #tblexchange .clickedrow td{
        background-color: #caaf8f;
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
    <div class="row">
        <h1 class="kh22" style="font-size:36px;">ព៌តមានបើកវេរ</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div id="cardpartner"  class="card-header" style="text-align:center;background-color:silver;">
                    <h1 id="partner_title" class="kh22-b">ព៌តមានវេរ</h1>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="table-responsive">
                            <table id="tbl_partner_transfer" class="table kh22">
                                <tr>
                                    <td>
                                        ថ្ងៃវេរមក
                                    </td>
                                    <td>
                                        {{ date('d-m-Y',strtotime($pt->dd)) . ' ' . $pt->tt }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>វេរមកពីដៃគូ</td>
                                    <td>
                                        {{ $pt->partner->name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>លេខអ្នកទទួល</td>
                                    <td>
                                        {{ $pt->rectel }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>ឈ្មោះអ្នកទទួល</td>
                                    <td>
                                        {{ $pt->recname }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>លេខអ្នកផ្ញើ</td>
                                    <td>
                                        {{ $pt->sendertel }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>ឈ្មោះអ្នកផ្ញើ</td>
                                    <td>
                                        {{ $pt->sendername }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>


            </div>


        </div>
        <div class="col-lg-6">
            <div class="card">
                <div id="cardamount" class="card-header" style="background-color:silver;">
                    <h1 id="transfer_title" class="kh22-b" style="text-align:center;">បើកវេរ</h1>
                </div>
                <div class="card-body" id="">
                    <div class="table-responsive">
                        <table id="tbl_cashdraw" class="table kh22">
                            <tr>
                                <td>ចំនួនទឹកប្រាក់វេរ</td>
                                <td>
                                    {{ phpformatnumber($cashdraw->amount) . ' ' . $cashdraw->currency->shortcut  }}
                                </td>
                            </tr>

                            <tr>
                                <td>កាត់សេវ៉ា</td>
                                <td>
                                    {{ phpformatnumber($cashdraw->customer_charge) . ' ' . $cashdraw->currency->shortcut  }}
                                </td>
                            </tr>
                            <tr>
                                <td>លុយត្រូវបើក</td>
                                <td>
                                    {{ phpformatnumber($cashdraw->amount - $cashdraw->customer_charge) }}
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកមកបើក</td>
                                <td>
                                    {{ $cashdraw->receive_tel }}
                                </td>
                            </tr>
                            <tr>
                                <td>ឈ្មោះ</td>
                                <td>
                                    {{ $cashdraw->receive_name }}
                                </td>
                            </tr>
                            <tr>
                                <td>កំណត់សំគាល់</td>
                                <td>
                                    {{ $cashdraw->note }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ថ្ងៃបើកវេរ
                                </td>
                                <td>
                                    {{ date('d-m-Y',strtotime($cashdraw->opdate))  . ' ' . $cashdraw->optime }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($exchanges->count())
        <div class="row">
            <h1 class="kh22" style="font-size:36px;">ប្តូរប្រាក់</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="kh16" style="text-align:center;">
                        <th>No</th>
                        <th>Buy</th>
                        <th>Rate</th>
                        <th>Sale</th>
                    </thead>
                    <tbody>
                        @foreach ($exchanges as $key => $e)
                            <tr class="kh22">
                                <td>{{ ++$key }}</td>
                                <td style="text-align:right;">{{ $e->product>0?phpformatnumber($e->product) . ' ' . $e->pcur:phpformatnumber($e->amount) . ' USD' }}</td>
                                <td style="text-align:center;">{{ $e->rate }}</td>
                                <td style="text-align:right;">{{ $e->amount>0?phpformatnumber($e->product) . ' ' . $e->pcur:phpformatnumber($e->amount) . ' USD' }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if($transfers->count())
        <div class="row">
            <h1 class="kh22" style="font-size:36px;">ពាក់ព័ន្ធបញ្ជី</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="kh16" style="text-align:center;">
                        <th>លរ</th>
                        <th>ថ្ងៃទី</th>
                        <th>ឈ្មោះដៃគូ</th>
                        <th>ប្រតិបត្តិការណ៏</th>
                        <th>ចំនួនទឹកប្រាក់</th>
                        <th>សេវ៉ាវេរ</th>
                        <th>អោយដៃគូ</th>
                        <th>លេខអ្នកទទួល</th>
                        <th>លេខអ្នកផ្ញើរ</th>
                        <th>ផ្សេងៗ</th>
                        <th>លេខយោង</th>
                    </thead>
                    <tbody>
                        @foreach ($transfers as $key => $t)
                            <tr class="kh16">
                                <td style="text-align:center;">{{ ++$key }}</td>
                                <td>{{ date('d-m-Y',strtotime($t->dd)) . ' ' . $t->tt }}</td>
                                <td>{{ $t->partner->name }}</td>
                                <td>{{ $t->tranname }}</td>
                                <td style="text-align:right;">{{ phpformatnumber($t->amount) . ' ' . $t->currency->shortcut }}</td>
                                <td style="text-align:right;">{{ phpformatnumber($t->cuscharge) . ' ' . $t->cuschargecur->shortcut }}</td>
                                <td style="text-align:right;">{{ phpformatnumber($t->fee) . ' ' . $t->currency->shortcut }}</td>
                                <td>{{ $t->rectel . ' ' . $t->recname }}</td>
                                <td>{{ $t->sendertel . ' ' . $t->sendername }}</td>
                                <td>{{ $t->note }}</td>
                                <td>{{ $t->ref_number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
@section('script')

    <script type="text/javascript">

        $(document).ready(function () {



        })
    </script>
@endsection
