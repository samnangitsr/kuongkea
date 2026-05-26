@extends('master')
@section('title') closelist-expanse @endsection
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


   <div class="row" style="margin-top:0px;">
        <div class="card">
            <div class="card-header">
                <table class="table">
                    <tr>
                        <td ><h3 class="kh22" style="margin-top:7px;">{{ $title }}</h3></td>
                        <td class="kh22">  ថ្ងៃទី<input type="text" id="txtclosedate" name="txtclosedate" class="kh22" value="{{ date('d-m-Y',strtotime($viewdate)) }}" style="background-color:transparent;border-style:none;" readonly></td>
                    </tr>
                </table>


            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $usd=0;
                        $thb=0;
                        $khr=0;
                        $vnd=0;
                        foreach($summary as $s){

                            if($s->currency->shortcut=='USD'){
                              $usd=abs($s->total);
                            }elseif($s->currency->shortcut=='THB'){
                                $thb=abs($s->total);
                            }elseif($s->currency->shortcut=='KHR'){
                                $khr=abs($s->total);
                            }elseif($s->currency->shortcut=='VND'){
                                $vnd=abs($s->total);
                            }
                        }
                    @endphp
                    <table class="table table-bordered kh22" style="background-color:rgb(181, 205, 197)">
                        <thead class="" style="text-align:center;">
                            <th>សរុបដុល្លា(USD)</th>
                            <th>សរុបបាត(THB)</th>
                            <th>សរុបរៀល(KHR)</th>
                            <th>សរុបដុង(VND)</th>
                        </thead>
                        <tbody>
                            <tr>
                               <td class="kh22" style="text-align:center;"> {{ phpformatnumber($usd) . ' USD' }}</td>
                               <td class="kh22" style="text-align:center;"> {{ phpformatnumber($thb) . ' THB'}}</td>
                               <td class="kh22" style="text-align:center;"> {{ phpformatnumber($khr) . ' KHR'}}</td>
                               <td class="kh22" style="text-align:center;"> {{ phpformatnumber($vnd) . ' VND'}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="tbl_list" class="table table-bordered tbl_list kh16">
                            <thead style="text-align:center;">
                                <th>លរ</th>
                                <th>ថ្ងៃទី</th>
                                <th>អ្នកកត់ត្រា</th>
                                <th>បរិយាយ</th>
                                <th>ដុល្លា</th>
                                <th>បាត</th>
                                <th>រៀល</th>
                                <th>ដុង</th>
                                <th>ប្រភេទទូទាត់</th>

                            </thead>

                                <tbody id="tbl_closelist">

                                   @foreach ($expanses as $key => $item)
                                        @php
                                            $usd1=0;
                                            $thb1=0;
                                            $khr1=0;
                                            $vnd1=0;
                                            if($item->currency->shortcut=='USD'){
                                                $usd1=abs($item->amount);
                                            }elseif($item->currency->shortcut=='THB'){
                                                $thb1=abs($item->amount);
                                            }elseif($item->currency->shortcut=='KHR'){
                                                $khr1=abs($item->amount);
                                            }elseif($item->currency->shortcut=='KHR'){
                                                $vnd1=abs($item->amount);
                                            }
                                        @endphp
                                       <tr>
                                          <td class="kh16" style="text-align:center;">{{ ++$key }}</td>
                                          <td class="kh16">{{ date('d-M-y',strtotime($item->dd)) }}</td>
                                          <td class="kh16">{{ $item->user->name }}</td>
                                          <td class="kh16">{{ $item->tranname . '(' . $item->type . ')' }}</td>
                                          <td class="kh16" style="text-align:right;">
                                              {{ phpformatnumber($usd1) }}
                                          </td>
                                          <td class="kh16" style="text-align:right;">
                                              {{ phpformatnumber($thb1) }}
                                          </td>
                                          <td class="kh16" style="text-align:right;">
                                              {{ phpformatnumber($khr1) }}
                                          </td>
                                          <td class="kh16" style="text-align:right;">
                                            {{ phpformatnumber($vnd1) }}
                                          </td>

                                          <td class="kh16">
                                              {{ $item->customer->name }}
                                          </td>
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
