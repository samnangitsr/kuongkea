<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExchangeListPrint</title>
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
        #tblin td{
          padding:0px 5px 0px 5px;
        }
        #tblout td{
          padding:0px 5px 0px 5px;
        }
        #tblin th{
          padding:0px 5px 0px 5px;
        }
        #tblout th{
          padding:0px 5px 0px 5px;
        }
</style>

<body>
    <div id="invoice-pos">
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
      <div class="row" style="margin-left:10px;margin-right:10px;">
        <table>
          <tr>
            <td class="kh16-b">របាយការណ៏កាត់កង</td>
            <td class="kh16-b">បុគ្គលិក:{{ $username }}</td>
            <td class="kh16-b">រូបិយប័ណ្ណ:{{ $curname }}</td>
            <td class="kh16-b" style="text-align:right;">
              ថ្ងៃទី:
              {{ date('d-m-Y',strtotime($d1)) }}
            </td>
          </tr>
        </table>
      </div>
      <table class="table">
        <tr>
            <td style="width:50%;border-style:none;">
              <table id="tblin" class="table kh16-b table-bordered table-striped">
                <thead style="text-align:center;">
                    <th style="width:50px;">N.</th>
                    <th>អ្នកកាត់កង</th>
                    <th>ឈ្មោះដៃគូ</th>
                    <th>ទិញចូល</th>
                </thead>
                <tbody id="">
                    @php
                        $i=0;
                        $curbuy='';
                        $cur='';
                        $totalbuy=0;
                        $luybuy=0;
                    @endphp
                    @foreach ($exchangelefts->where('product','>','0') as $key => $e)
                      @php

                          $curbuy=$e->currency->shortcut;
                          if($curbuy=='VND'){
                            $cur='V';
                          }elseif($curbuy=='KHR'){
                            $cur='R';
                          }elseif($curbuy=='THB'){
                            $cur='B';
                          }else{
                            $cur=$curbuy;
                          }

                      @endphp
                        <tr>
                            <td style="width:50px;">0</td>
                            <td style="width:100px;">{{ $e->user->name }} <br> <span>{{ date('d-m-Y',strtotime($e->dd)) }}</span></td>
                            <td style="width:150px;">
                              {{ $e->partner->name }}
                              <br>
                              <span>{{ $e->tt }}</span>
                            </td>
                            <td style="color:blue;text-align:right;width:150px;">
                                +{{ phpformatnumber($e->product) . $cur }}
                              <br>
                              <span>({{ phpformatnumber($e->rate) }})</span>
                              <span style="color:red">
                                {{ phpformatnumber($e->amount) . '$' }}
                              </span>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($exchangelists->where('product','>','0') as $key => $e)
                      @php
                          $i++;
                          $curbuy=$e->currency->shortcut;
                          if($curbuy=='VND'){
                            $cur='V';
                          }elseif($curbuy=='KHR'){
                            $cur='R';
                          }elseif($curbuy=='THB'){
                            $cur='B';
                          }else{
                            $cur=$curbuy;
                          }
                          $totalbuy+=$e->product;
                          $luybuy+=$e->amount
                      @endphp
                      <tr>
                        <td style="width:50px;">{{ $i }}</td>
                        <td style="width:100px;">{{ $e->user->name }} <br> {{ date('d-m-Y',strtotime($e->dd)) }}</td>
                        <td style="width:150px;">
                          {{ $e->partner->name }}
                          <br>
                          {{ $e->tt }}
                        </td>
                        <td style="color:blue;text-align:right;width:150px;">
                            +{{ phpformatnumber($e->product) . $cur }}
                          <br>
                          <span>({{ phpformatnumber($e->rate) }})</span>
                          <span style="color:red">
                            {{ phpformatnumber($e->amount) . '$' }}
                          </span>
                        </td>
                      </tr>

                    @endforeach
                    <tr>
                      <td colspan=2 class="kh12-b">សរុបទិញថ្ងៃនេះ</td>
                      <td class="kh12-b" style="color:blue;text-align:right;">{{ phpformatnumber($totalbuy) . $cur }}</td>
                      <td class="kh12-b" style="color:red;text-align:right;">{{ phpformatnumber($luybuy) . '$' }}</td>
                    </tr>
                </tbody>
              </table>
            </td>
            <td style="width:50%;border-style:none;">
              <table id="tblout" class="table tblout kh16-b table-bordered table-striped" style="">
                <thead style="text-align:center;">
                    <th style="width:px;">N.</th>
                    <th>អ្នកកាត់កង</th>
                    <th>ឈ្មោះដៃគូ</th>
                    <th>លក់ចេញ</th>
                </thead>
                <tbody id="">
                    @php
                        $j=0;
                        $cursale='';
                        $cur='';
                        $totalsale=0;
                        $luysale=0;

                    @endphp
                     @foreach ($exchangelefts->where('product','<','0') as $key => $e)
                     @php
                          $cursale=$e->currency->shortcut;
                          if($cursale=='VND'){
                            $cur='V';
                          }elseif($cursale=='KHR'){
                            $cur='R';
                          }elseif($cursale=='THB'){
                            $cur='B';
                          }else{
                            $cur=$cursale;
                          }
                      @endphp
                        <tr>
                            <td style="width:50px;">0</td>
                            <td style="width:100px;">{{ $e->user->name }} <br> <span>{{ date('d-m-Y',strtotime($e->dd)) }}</span></td>
                            <td style="width:150px;">
                              {{ $e->partner->name }}
                              <br>
                              <span>{{ $e->tt }}</span>

                            </td>
                            <td style="color:red;text-align:right;width:150px;">
                                {{ phpformatnumber($e->product) . $cur }}
                              <br>
                              <span>({{ phpformatnumber($e->rate) }})</span>
                              <span style="color:blue">
                                {{ phpformatnumber($e->amount) . '$' }}
                              </span>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($exchangelists->where('product','<','0') as $key1 => $e)
                      @php
                          $j++;
                          $cursale=$e->currency->shortcut;
                          if($cursale=='VND'){
                            $cur='V';
                          }elseif($cursale=='KHR'){
                            $cur='R';
                          }elseif($cursale=='THB'){
                            $cur='B';
                          }else{
                            $cur=$cursale;
                          }
                          $totalsale+=$e->product;
                          $luysale+=$e->amount
                      @endphp
                         <tr>
                          <td style="width:px;">{{ $j }}</td>
                          <td style="width:100px;">{{ $e->user->name }} <br> <span>{{ date('d-m-Y',strtotime($e->dd)) }}</span></td>
                            <td style="width:150px;">
                              {{ $e->partner->name }}
                              <br>
                              <span>{{ $e->tt }}</span>

                            </td>
                            <td style="color:red;text-align:right;width:150px;">
                                {{ phpformatnumber($e->product) . $cur }}
                              <br>
                              <span>({{ phpformatnumber($e->rate) }})</span>
                              <span style="color:blue">
                                {{ phpformatnumber($e->amount) . '$' }}
                              </span>
                            </td>
                      </tr>

                    @endforeach
                    <tr>
                      <td colspan=2 class="kh12-b">សរុបលក់ថ្ងៃនេះ</td>
                      <td class="kh12-b" style="color:red;text-align:right;">{{ phpformatnumber($totalsale) . $cur }}</td>
                      <td class="kh12-b" style="color:blue;text-align:right;">{{ phpformatnumber($luysale) . '$' }}</td>

                    </tr>
                </tbody>
              </table>
            </td>
        </tr>
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
