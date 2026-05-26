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
     margin: 5mm;
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
     .kh12-b{
         font-family:'Noto Sans Khmer', sans-serif;
         font-size:12px;
         font-weight:bold;
         }
     .kh14-b{
         font-family:'Noto Sans Khmer', sans-serif;
         font-size:14px;
         font-weight:bold;
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
     }
     .amt{
         text-align:right;
         font-family:Arial, Helvetica, sans-serif;
         font-size:16px;
     }
     .total{
         text-align:right;
         font-family:Arial, Helvetica, sans-serif;
         font-size:16px;
         font-weight:bold;
     }
     #tbl_partner_list td{
       padding:0px 5px 0px 5px;
     }
     #tbl_partner_list th{
       padding:0px 5px 0px 5px;
     }
     #tbla td{
      padding:3px;
     }
     #tbla th{
      padding:0px;
     }
     #tblb th{
      padding:0px;
     }
</style>
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
<body>
    <div id="invoice-pos">
      <div class="row" style="margin:0px 5px 0px 5px; ">
        <table class="table">
          <tr>
            <td class="kh16-b" style="border-style:none;">របាយការណ៏បើកវេរ របស់បុគ្គលិក {{ $username }}</td>
            <td class="kh16-b" style="text-align:right;border-style:none;">{{ $datestr }}</td>
          </tr>
        </table>
      </div>
      <div class="row" style="margin-top:0px;">
          <div class="table-responsive">
              <table id="tbla" class="table table-bordered kh16">
                  <thead class="kh12-b" style="text-align:center;padding:0px;">
                      <th>លរ</th>
                      <th>ថ្ងៃបើកវេរ</th>
                      <th>ចំនួនទឹកប្រាក់</th>
                      <th>ពត៌មានអ្នកបើកវេរ</th>
                      <th>ប្រភេទទូទាត់</th>
                      <th>ផ្សេងៗ</th>
                  </thead>

                  <tbody id="bodytransfer">
                      @foreach ($data->where('currency_id') as $key => $d)
                        <tr class="rowclick">
                            <td style="text-align:center;" class="kh12-b">{{ ++$key }}</td>
                            <td class="kh12-b">{{ date('d-m-Y',strtotime($d->opdate)) . ' ' . $d->optime }}</td>
                            <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($d->amount) . ' ' .  $d->currency->shortcut }}</td>
                            <td class="kh12-b">{{ $d->receive_tel . ' ' . $d->receive_name }}</td>
                            <td class="kh12-b">{{ $d->paymethod }}</td>
                            <td class="kh12-b">{{ $d->other }}</td>
                        </tr>
                      @endforeach
                      <tr>
                        <td colspan=6>
                            <table id="tbl_summary" class="kh16-b tbl_summary">
                                <thead>
                                    <th>ប្រភេទទូទាត់</th>
                                    <th>សរុបលុយវេរ</th>
                                    <th>សរុបសេវ៉ា</th>
                                    <th>សរុបលុយបើក</th>
                                </thead>
                                <tbody>
                                    @foreach ($summary as $s)
                                    <tr class="rowclick">
                                        <td>{{ $s->paymethod }}</td>
                                        <td style="text-align:right;">{{ phpformatnumber($s->tamt) .  $s->currency->sk }}</td>
                                        <td style="text-align:right;">{{ phpformatnumber($s->tcharge) . $s->currency->sk }}</td>
                                        <td style="text-align:right;">{{ phpformatnumber($s->tamt-$s->tcharge) . $s->currency->sk }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>


                    </tr>
                  </tbody>
              </table>
          </div>
      </div>


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
