@extends('master')
@section('title') closelist-usercapital @endsection
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
    #tbl_capital .clickedrow td{
        background-color: blue;
        color:white;
    }
    </style>
@endsection
@section('content')
@php
    function phpformatnumber($num,$shortcut=''){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        $dc=strlen((float)$fp)-2;

        }
        if($shortcut=='KHR'){
            $dc=0;
        }
        return number_format($num,$dc,'.',',');
    }
@endphp


   <div class="row" style="margin-top:20px;">
        <div class="card">
            <div class="card-header">
                <table>
                    <tr>
                        <td ><h3 class="kh22-b" style="margin-top:7px;">តារាងលុយដកចុងគ្រាបុគ្គលិក</h3></td>
                        <td><input type="text" id="txtclosedate" name="txtclosedate" class="kh22-b" style="background-color:transparent;border-style:none;text-align:right;" value="{{ date('d-m-Y',strtotime($viewdate)) }}" readonly></td>
                    </tr>
                </table>


            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $usd=0;
                        $thb=0;
                        $khr=0;
                        foreach($summary as $s){
                            if($s->currency->shortcut=='USD'){
                                $usd=$s->tamt;
                            }elseif($s->currency->shortcut=='THB'){
                                $thb=$s->tamt;
                            }elseif($s->currency->shortcut=='KHR'){
                                $khr=$s->tamt;
                            }
                        }
                    @endphp
                    <table class="table table-bordered kh22" style="background-color:rgb(181, 205, 197)">
                        <thead class="" style="text-align:center;">
                            <th>សរុបដុល្លា(USD)</th>
                            <th>សរុបបាត(THB)</th>
                            <th>សរុបរៀល(KHR)</th>
                        </thead>
                        <tbody>
                            <tr>
                               <td class="kh22" style="text-align:center;"> {{ phpformatnumber($usd) . ' USD' }}</td>
                               <td class="kh22" style="text-align:center;"> {{ phpformatnumber($thb) . ' THB'}}</td>
                               <td class="kh22" style="text-align:center;"> {{ phpformatnumber($khr,'KHR') . ' KHR'}}</td>

                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="tbl_capital" class="table table-bordered table-hover kh16-b">
                            <thead class="" style="text-align:center;">
                                <th>លរ</th>
                                <th>បរិយាយ</th>
                                <th>ប្រភេទ</th>

                                <th>ចំនួនទឹកប្រាក់</th>
                                <th>ផ្សេងៗ</th>
                            </thead>

                                <tbody>
                                   @foreach ($usercapitals as $key => $item)
                                       <tr>
                                        <td style="text-align:center;">{{ ++$key }}</td>
                                        <td>{{ $item->tranname . '(' . $item->useraffect->name . ')' }}</td>
                                        <td>{{ $item->capital_type }}</td>

                                        <td style="text-align:right;">
                                            {{ phpformatnumber($item->amount,$item->currency->shortcut) . ' ' . $item->currency->shortcut }}
                                        </td>
                                        <td>
                                            {{ $item->note }}
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
    <script type="text/javascript">

        $(document).on('click','#tbl_capital td',function(e){
            // Remove previous highlight class
            $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
        })
    </script>
@endsection
