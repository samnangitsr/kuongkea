@extends('master')
@section('title') closelist-stock @endsection
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
                <table>
                    <tr>
                        <td ><h3 class="kh22-b" style="margin-top:7px;">{{ $title }} </h3></td>
                        <td style="text-align:right;"><input type="text" id="txtclosedate" name="txtclosedate" value="{{ date('d-m-Y',strtotime($viewdate)) }}" class="kh22-b" style="background-color:transparent;border-style:none;text-align:right;" readonly></td>
                    </tr>
                </table>


            </div>
            <div class="card-body">
                <div class="row">
                    <table>
                        <tr>
                            <td class="kh22-b" style="text-align:right;">សរុបទឹកប្រាក់: &nbsp;&nbsp;</td>
                            <td class="kh22-b" style="text-align:left;">{{ phpformatnumber($fnstock->tamt) . ' USD' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="row" style="margin-top:20px;">
                    <div class="table-responsive">
                        <table id="tbl_list" class="table table-bordered tbl_list kh22">
                            <thead class="" style="text-align:center;">
                                <th>លរ</th>
                                <th>បរិយាយ</th>
                                <th>ស្តុក</th>
                                <th>ចំនួនទឹកប្រាក់</th>
                            </thead>

                                <tbody id="tbl_closelist">
                                   @foreach ($fnstockdetails as $key => $item)
                                       <tr>
                                        <td style="text-align:center;">{{ ++$key }}</td>
                                        <td class="">{{ $item->currency->curname }}</td>
                                        <td style="text-align:right;">{{ phpformatnumber($item->stock) }} {{ $item->currency->shortcut }}</td>
                                        <td class="" style="text-align:right;">
                                            {{ phpformatnumber($item->amount) . ' USD' }}
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
    $('#h1_title').text('ពិនិត្យបិទបញ្ជី');
      $(document).on('click','.tbl_list td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
    </script>

@endsection
