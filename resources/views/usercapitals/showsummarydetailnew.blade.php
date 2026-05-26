@extends('master')
@section('title') Summary Transaction Detail @endsection
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
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;

            }
        .en16-b{
            font-family:'Arial', sans-serif;
            font-size:16px;
            font-weight:bold;

            }
        .en14-b{
            font-family:'Arial', sans-serif;
            font-size:14px;
            font-weight:bold;

            }
        .en12-b{
            font-family:'Arial', sans-serif;
            font-size:14px;
            font-weight:bold;

            }
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
        .kh36{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:36px;
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

       .table .clickedrow td{
            background-color: #b0e498;
        }
        .tbl_usertransaction td{
            padding:3px;
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
    <div class="row">
        <h1 class="kh36">{{ $tranname }}</h1>
    </div>

    <div class="row">
        <table class="table table-bordered kh16 tbl_usertransaction" style="table-layout:fixed;width:100%;margin:0px;padding:0px;">
            <thead style="text-align:center;" class="kh16-b">
                <th style="width:60px;">No</th>
                <th style="width:130px;">ថ្ងៃទី</th>
                <th style="width:100px;">បុគ្គលិក</th>
                <th>ប្រតិបត្តិការណ៏</th>
                <th>GOLD</th>
                <th>USD</th>
                <th>THB</th>
                <th>KHR</th>
                <th>VND</th>
                <th>FN</th>

                <th>Description</th>
            </thead>
            <tbody>



            </tbody>
        </table>

    </div>


@endsection
@section('script')

    <script type="text/javascript">

        $(document).ready(function () {

            $(document).on('click','.table td',function(e){
              // Remove previous highlight class
              $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
              // add highlight to the parent tr of the clicked td
              $(this).parent('tr').addClass("clickedrow");
          })


        })
    </script>
@endsection
