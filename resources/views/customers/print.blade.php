<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserCloseList</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style type="text/css" media="print">
     @page
		  {
        size: A4;
		  	margin:10mm 20px 50px 20px;
		   }

    div.pagebreak, div.appendix {page-break-after: always;}
    #invoice-pos{
        box-shadow: 0 0 1in -0.25in rgb(0,0,0.5);
        padding:0mm;
        margin:0 auto;
        width:60mm;
        background:#fff;
    }
    #invoice-pos ::selection{
        background:#34495E;
        color:#fff;
    }
    #invoice-pos ::-mox-selection{
        background:#34495E;
        color:#fff;
    }

    thead{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        padding:0px;
        color:black;
    }
    tbody{
        font-family:arial;
        font-size:10px;
        padding:0px;
    }
    .logo{
        font-family:khmer os muol light;
        font-size:22px;
        margin-top:5px;
        color:black;
    }
    .info{
        font-family:khmer os muol light;
        font-size:16px;
        color:black;
    }
    #top p{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        margin-left:0px;
        padding:0px;
        color:black;
    }
    .receipt_info{
        border-style:none;
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        color:black;
        padding:0px;
        margin-left:0px;
    }
    .service{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        color:black;
    }

    .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            color:black;
            }
            .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            color:black
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
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            color:black;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            color:black
            }
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh30{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
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
        td{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            padding:0px;
            color:black;
        }


        #tblcustomer td{
          border:1px solid black;
          padding:2px;
        }
        #tblcustomer tr{
          border:1px solid black;
        }
        #tblcustomer th{
          border:1px solid black;
          padding:5px;
        }




</style>
@php

    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        //$dc=strlen((float)$fp)-2;
        $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
@endphp
<body>
    <div id="invoice-pos">
        <div class="" style="margin-top:20px;">
            <div class="row" style="margin:0px 5px 10px 5px;">
                <table>
                    <tr>
                        <td class="kh16-b">បញ្ជីឈ្មោះអតិថិជន</td>
                        <td class="kh16-b" style="text-align:right;">{{ $customertype }}</td>

                    </tr>
                </table>
            </div>

        </div>


          <table id="tblcustomer" class="table table-bordered table-fixed">
              <thead class="kh12" style="text-align:center;">
                <th>លរ</th>
                <th>ឈ្មោះអតិថិជន</th>
                <th>ប្រភេទអតិថិជន</th>
                <th style="width:120px;">លេខទូរស័ព្ទ</th>
                <th>ថ្ងៃកត់ត្រា</th>
                <th>អ្នកកត់ត្រា</th>
                <th>អាស័យដ្ឋាន</th>
              </thead>
              <tbody>
                @foreach ($customers as $key => $c)
                    @php
                        $addr='';
                        if($c->province_id){
                            $addr=$c->province->name;
                        }
                        if($c->district_id){
                            $addr .=' ' .$c->district->name;
                        }
                        if($c->commune_id){
                            $addr .=' ' .$c->commune->name;
                        }
                        if($c->village_id){
                            $addr .=' ' .$c->village->name;
                        }
                    @endphp
                    <tr>
                        <td class="kh12-b" style="text-align:center;">{{ ++$key }}</td>
                        <td class="kh12-b">{{ $c->name }}</td>
                        <td class="kh12-b">{{ $c->customertype }}</td>
                        <td class="kh12-b" style="width:120px;">{{ $c->tel }}</td>
                        <td class="kh12-b" style="width:120px;">
                          {{ date('d-m-Y',strtotime($c->created_at)) }}
                        </td>
                        <td class="kh12-b" style="width:120px;">
                          {{ $c->user->name }}
                        </td>
                        <td class="kh12-b">{{ $addr }}</td>
                    </tr>
                @endforeach
              </tbody>
          </table>




    </div>

</body>
<script type="text/javascript">

    printContent('invoice-pos');
    function printContent(el)
    {

      //var restorpage=document.body.innerHTML;
      var printloc=document.getElementById(el).innerHTML;
      document.body.innerHTML=printloc;
      window.print();
      window.onafterprint = function(){ window.close()};
      //history.back();
      //document.body.innerTHML=restorpage;

    }
</script>
</html>
