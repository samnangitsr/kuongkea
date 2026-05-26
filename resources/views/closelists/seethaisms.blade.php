@extends('master')
@section('title') closelist-ThaiSMS @endsection
@section('css')
<link rel="stylesheet" tyle="text/css" href="{{ asset('public') }}/css/virtual-select.min.css">


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
       .hiddenrow{
        display:none;
       }
       .tbl_list .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_list .clickedrow td input{
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


   <div class="row" style="margin-top:20px;">
        <div class="card">
            <div class="card-header">
                <table class="table">
                    <tr>
                        <td ><h3 class="kh22" style="margin-top:7px;">{{ $title }}</h3></td>
                        <td class="kh22">  គិតត្រឹមថ្ងៃទី<input type="text" id="txtclosedate" name="txtclosedate" class="kh22" value="{{ date('d-m-Y',strtotime($viewdate)) }}" style="background-color:transparent;border-style:none;" readonly></td>
                    </tr>
                </table>


            </div>
            <div class="card-body">
                <div class="row">

                    <table class="table table-bordered kh22" style="background-color:rgb(181, 205, 197)">
                        <thead class="" style="text-align:center;">

                            <th>សរុបបាត(THB)</th>

                        </thead>
                        <tbody>
                            <tr>

                               <td class="kh22" style="text-align:center;"> {{ phpformatnumber($total) . ' THB'}}</td>

                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="tbl_list" class="table table-bordered tbl_list kh22">
                            <thead style="text-align:center;">
                                <th>លរ</th>
                                <th>DATE</th>
                                <th>TIME</th>
                                <th>Send From</th>
                                <th>ចំនួនទឹកប្រាក់</th>
                                <th>សមតុល្យ</th>
                                <th>សារថៃ</th>
                            </thead>
                                @php
                                    $balance=0;
                                @endphp
                                <tbody id="tbl_closelist">

                                    @foreach ($c as $key => $item)
                                        @php
                                            $balance +=$item['amount'];
                                        @endphp
                                        <tr>
                                            <td class="kh16" style="text-align:center;">{{ ++$key }}</td>
                                            <td class="kh16">{{ date('d-M-y',strtotime($item['smsdate'])) }}</td>
                                            <td class="kh16">{{ $item['smstime'] }}</td>
                                            <td class="kh16">{{ $item['sendfrom'] }}</td>
                                            <td class="kh16" style="text-align:right;">
                                                {{ phpformatnumber($item['amount']) }} THB
                                            </td>
                                            <td class="kh16" style="text-align:right;">
                                                {{ phpformatnumber($balance) }} THB
                                            </td>
                                            <td class="kh16">{{ $item['smstext'] }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
   </div>


@endsection
@section('script')
<script>
    $(document).ready(function (){
        // Remove previous highlight class
        $(document).on('click','.tbl_list td',function(e){
            $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
           // add highlight to the parent tr of the clicked td
           $(this).parent('tr').addClass("clickedrow");
        })
    })
</script>
@endsection
