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
        .cma{
          color:rgb(255, 0, 111)
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
        $left_in=0;
        $left_out=0;
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
              <table id="tblin" class="table kh16-b tblin">
                <thead style="">
                    <th>N <sup>o</sup></th>
                    {{-- <th>ID</th> --}}
                    <th style="display:none;">PartnerID</th>
                    <th>ឈ្មោះដៃគូ</th>
                    <th>អ្នកកាត់កង</th>
                    <th style="text-align:right;">ទិញចូល</th>
                    <th style="display:none;">CURID</th>
                </thead>
                <tbody id="">
                    @php
                        $i=0;
                        $curbuy='';
                        $totalbuy=0;
                        $luybuy=0;
                    @endphp
                    @foreach ($exchangelefts->where('product','>','0') as $key => $e)
                        @php
                            $curbuy=$e->currency->shortcut;
                        @endphp
                        <tr class="rows" style="background-color:aqua">
                            <td>0</td>
                            {{-- <td style="">
                              <a class="" href="#buy{{ $e->id }}" data-bs-toggle="collapse" style=" text-decoration:underline;">{{ $e->id }}</a>
                            </td> --}}
                            <td style="display:none">{{ $e->partner_id }}</td>
                            <td>{{ '('. $e->partner_id .')' . $e->partner->name }} <br> <span class="kh12-b">{{ date('d-m-Y',strtotime($e->dd)) }}</span> </td>
                            <td>
                              {{ $e->user->name }}
                              <br><span class="kh12-b">{{ $e->tt }}</span>

                            </td>
                            <td style="color:blue;text-align:right;">
                                +{{ phpformatnumber($e->product) . ' ' . $e->currency->shortcut }}
                              <br>
                              <span>({{ phpformatnumber($e->rate) }})</span>
                              <span style="color:red">
                                {{ phpformatnumber($e->amount) . ' ' . $e->maincur }}
                              </span>
                            </td>
                            <td style="display:none">{{ $e->currency_id }}</td>
                        </tr>
                        @php
                            $countdata=0;
                            $datarefs=App\Exchange::showexchangeidfromtransfer($e->id);
                            if($datarefs){
                                $countdata=1;
                            }
                        @endphp
                        @if($countdata>0)
                            @php
                                $total1=0;
                                $left1=$e->product;
                            @endphp
                            @foreach ($datarefs as $item)
                              @php
                                  $total1+=$item->amount;
                                  $left1-=$item->amount;
                              @endphp
                              <tr id="buy{{ $e->id }}" style="background-color:rgb(206, 240, 229);">
                                <td colspan=4 style="border-style:none;">
                                  <table class="table" style="margin:0px;padding:0px;">
                                      <tr>
                                        <td style="border-style:none;padding:0px;"></td>
                                        {{-- <td style="padding:0px;border-style:none;" class="kh12-b">{{ sprintf("%04d",$item->id) }}</td> --}}
                                        <td class="kh12-b" style="padding:0px;border-style:none;">
                                          {{ date('d-m-Y',strtotime($item->dd)) . ' ' .  $item->tt}}
                                          <span>
                                            {{ $item->partner->name }} {{ $item->user->name }}
                                          </span>
                                        </td>
                                        <td class="kh12-b" style="padding:0px;text-align:right;color:black;border-style:none;">
                                          -{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}
                                        </td>
                                      </tr>
                                  </table>
                                </td>
                              </tr>
                            @endforeach
                            @php
                                $left_in+=$left1;
                            @endphp
                            <tr id="buy{{ $e->id }}" style="background-color:rgb(224, 219, 163);">
                              <td colspan=4 style="border-style:none;padding:0px;">
                                <table class="table" style="margin:0px;padding:0px;">
                                  <tr>
                                    <td colspan=2 class="kh14-b @if($left1<>0) cma @endif" style="padding:0px;">
                                      សល់  {{ phpformatnumber($left1) . ' ' . $e->currency->shortcut }}
                                    </td>
                                    <td class="kh14-b" style="text-align:right;padding:0px;border-top:1px solid black" colspan=2>
                                      {{ phpformatnumber(-1 * $total1) . ' ' . $e->currency->shortcut }}
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($exchangelists->where('product','>','0') as $key => $e)
                        @php
                            $i++;
                            if($i==1){
                              $curbuy=$e->currency->shortcut;
                            }
                            $totalbuy+=$e->product;
                            $luybuy+=$e->amount
                        @endphp
                        <tr class="rows">
                            <td>{{ $i }}</td>
                            {{-- <td style="">
                              <a class="" href="#buy{{ $e->id }}" data-bs-toggle="collapse" style=" text-decoration:underline;">{{ $e->id }}</a>
                            </td> --}}
                            <td style="display:none">{{ $e->partner_id }}</td>
                            <td>{{ '('. $e->partner_id .')' . $e->partner->name }} <br> <span class="kh12-b">{{ date('d-m-Y',strtotime($e->dd)) }}</span> </td>
                            <td>
                              {{ $e->user->name }}
                              <br><span class="kh12-b">{{ $e->tt }}</span>

                            </td>
                            <td style="color:blue;text-align:right;">
                                +{{ phpformatnumber($e->product) . ' ' . $e->currency->shortcut }}
                              <br>
                              <span>({{ phpformatnumber($e->rate) }})</span>
                              <span style="color:red">
                                {{ phpformatnumber($e->amount) . ' ' . $e->maincur }}
                              </span>
                            </td>
                            <td style="display:none">{{ $e->currency_id }}</td>
                        </tr>
                        @php
                            $countdata=0;
                            $datarefs=App\Exchange::showexchangeidfromtransfer($e->id);
                            if($datarefs){
                                $countdata=1;
                            }
                        @endphp
                        @if($countdata>0)
                            @php
                                $total1=0;
                                $left1=$e->product;
                            @endphp
                            @foreach ($datarefs as $item)
                              @php
                                  $total1+=$item->amount;
                                  $left1-=$item->amount;
                              @endphp
                              <tr id="buy{{ $e->id }}" style="background-color:rgb(206, 240, 229);">
                                <td colspan=4 style="border-style:none;">
                                  <table class="table" style="margin:0px;padding:0px;">
                                      <tr>
                                        <td style="border-style:none;padding:0px;"></td>
                                        {{-- <td style="padding:0px;border-style:none;" class="kh12-b">{{ sprintf("%04d",$item->id) }}</td> --}}
                                        <td class="kh12-b" style="padding:0px;border-style:none;">
                                          {{ date('d-m-Y',strtotime($item->dd)) . ' ' .  $item->tt}}
                                          <span>
                                            {{ $item->partner->name }} {{ $item->user->name }}
                                          </span>
                                        </td>
                                        <td class="kh12-b" style="padding:0px;text-align:right;color:black;border-style:none;">
                                          -{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}
                                        </td>
                                      </tr>
                                  </table>
                                </td>
                              </tr>
                            @endforeach
                            @php
                                $left_in+=$left1;
                            @endphp
                            <tr id="buy{{ $e->id }}" style="background-color:rgb(224, 219, 163);">
                              <td colspan=4 style="border-style:none;padding:0px;">
                                <table class="table" style="margin:0px;padding:0px;">
                                  <tr>
                                    <td colspan=2 class="kh14-b @if($left1<>0) cma @endif" style="padding:0px;">
                                      សល់  {{ phpformatnumber($left1) . ' ' . $e->currency->shortcut }}
                                    </td>
                                    <td class="kh14-b" style="text-align:right;padding:0px;border-top:1px solid black" colspan=2>
                                      {{ phpformatnumber(-1 * $total1) . ' ' . $e->currency->shortcut }}
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                        @endif
                    @endforeach
                    <tr style="background-color:green;">
                      <td style="padding:0px;color:green;" colspan=3 class="kh14-b">សរុបទិញ {{ phpformatnumber($totalbuy) . $curbuy }}</td>
                      <td  class="kh14-b" style="color:green;text-align:right;padding:0px;">{{ phpformatnumber($luybuy) . 'USD' }}</td>
                    </tr>
                    <tr style="background-color:green;">
                      <td style="padding:0px;color:green;" colspan=3 class="kh14-b">សរុបទំនិញសល់</td>
                      <td  class="kh14-b" style="color:green;text-align:right;padding:0px;">{{ phpformatnumber($left_in) . $curbuy }}</td>
                    </tr>
                </tbody>
              </table>
            </td>
            <td style="width:50%;border-style:none;">
              <table id="tblout" class="table tblout kh16-b">
                <thead style="">
                    <th>N <sup>o</sup></th>
                    {{-- <th>ID</th> --}}
                    <th style="display:none;">PartnerID</th>
                    <th>ឈ្មោះដៃគូ</th>
                    <th>អ្នកកាត់កង</th>
                    <th style="text-align:right;">លក់ចេញ</th>
                    <th style="display:none;">CurID</th>
                </thead>
                <tbody id="">
                    @php
                        $j=0;
                        $cursale='';
                        $totalsale=0;
                        $luysale=0;

                    @endphp
                    @foreach ($exchangelefts->where('product','<','0') as $key => $e)
                        @php
                            $cursale=$e->currency->shortcut;
                        @endphp
                        <tr class="rows" style="background-color:aqua">
                            <td>0</td>
                            {{-- <td>
                              <a class="" href="#sale{{ $e->id }}" data-bs-toggle="collapse" style=" text-decoration:underline;">{{ $e->id }}</a>
                            </td> --}}
                            <td style="display:none">{{ $e->partner_id }}</td>
                            <td>{{ '('. $e->partner_id .')' . $e->partner->name }} <br> <span class="kh12-b">{{ date('d-m-Y',strtotime($e->dd)) }}</span> </td>
                            <td>
                              {{ $e->user->name }}
                              <br><span class="kh12-b">{{ $e->tt }}</span>
                            </td>
                            <td style="color:red;text-align:right;">
                                {{ phpformatnumber($e->product) . ' ' . $e->currency->shortcut }}
                              <br>
                              <span>({{ phpformatnumber($e->rate) }})</span>
                              <span style="color:blue">
                                {{ phpformatnumber($e->amount) . ' ' . $e->maincur }}
                              </span>
                            </td>
                            <td style="display:none">{{ $e->currency_id }}</td>
                        </tr>
                        @php
                            $countdata=0;
                            $datarefs=App\Exchange::showexchangeidfromtransfer($e->id);
                            if($datarefs){
                                $countdata=1;
                            }
                        @endphp
                        @if($countdata>0)
                            @php
                                $total2=0;
                                $left2=abs($e->product);
                            @endphp
                            @foreach ($datarefs as $item)
                              @php
                                  $total2+=$item->amount;
                                  $left2-=abs($item->amount);
                              @endphp
                               <tr id="sale{{ $e->id }}" style="background-color:rgb(206, 240, 229);">
                                <td colspan=4 style="border-style:none;">
                                  <table class="table" style="margin:0px;padding:0px;">
                                      <tr>
                                        <td style="border-style:none;padding:0px;"></td>
                                        {{-- <td style="padding:0px;border-style:none;" class="kh12-b">{{ sprintf("%04d",$item->id) }}</td> --}}
                                        <td class="kh12-b" style="padding:0px;border-style:none;">
                                          {{ date('d-m-Y',strtotime($item->dd)) . ' ' .  $item->tt}}
                                          <span>
                                            {{ $item->partner->name }} {{ $item->user->name }}
                                          </span>
                                        </td>
                                        <td class="kh12-b" style="padding:0px;text-align:right;color:black;border-style:none;">
                                          +{{ phpformatnumber(abs($item->amount)) . ' ' . $item->currency->shortcut }}
                                        </td>
                                      </tr>
                                  </table>
                                </td>
                              </tr>

                            @endforeach
                            @php
                                $left_out+=$left2;
                            @endphp
                            <tr id="sale{{ $e->id }}" style="background-color:rgb(224, 219, 163);">
                              <td colspan=4 style="border-style:none;padding:0px;">
                                <table class="table" style="margin:0px;padding:0px;">
                                  <tr>
                                    <td colspan=2 class="kh14-b @if($left2<>0) cma @endif" style="padding:0px;">
                                      សល់  {{ phpformatnumber($left2) . ' ' . $e->currency->shortcut }}
                                    </td>
                                    <td class="kh14-b" style="text-align:right;padding:0px;border-top:1px solid black" colspan=2>
                                      {{ phpformatnumber(abs($total2)) . ' ' . $e->currency->shortcut }}
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($exchangelists->where('product','<','0') as $key1 => $e)
                      @php
                          $j++;
                          if($j==1){
                            $cursale=$e->currency->shortcut;
                          }
                          $totalsale+=$e->product;
                          $luysale+=$e->amount
                      @endphp
                         <tr class='rows'>
                          <td>{{ $j }}</td>
                          {{-- <td>
                            <a class="" href="#sale{{ $e->id }}" data-bs-toggle="collapse" style=" text-decoration:underline;">{{ $e->id }}</a>
                          </td> --}}
                          <td style="display:none">{{ $e->partner_id }}</td>
                          <td>{{ '('. $e->partner_id .')' . $e->partner->name }} <br> <span class="kh12-b">{{ date('d-m-Y',strtotime($e->dd)) }}</span> </td>
                          <td>
                            {{ $e->user->name }}
                            <br><span class="kh12-b">{{ $e->tt }}</span>
                          </td>
                          <td style="color:red;text-align:right;">
                              {{ phpformatnumber($e->product) . ' ' . $e->currency->shortcut }}
                            <br>
                            <span>({{ phpformatnumber($e->rate) }})</span>
                            <span style="color:blue">
                              {{ phpformatnumber($e->amount) . ' ' . $e->maincur }}
                            </span>
                          </td>
                          <td style="display:none">{{ $e->currency_id }}</td>
                      </tr>
                      @php
                          $countdata=0;
                          $datarefs=App\Exchange::showexchangeidfromtransfer($e->id);
                          if($datarefs){
                              $countdata=1;
                          }
                        @endphp
                        @if($countdata>0)
                            @php
                                $total2=0;
                                $left2=abs($e->product);
                            @endphp
                            @foreach ($datarefs as $item)
                              @php
                                  $total2+=$item->amount;
                                  $left2-=abs($item->amount);
                              @endphp
                              <tr id="sale{{ $e->id }}" style="background-color:rgb(206, 240, 229);">
                                <td colspan=4 style="border-style:none;">
                                  <table class="table" style="margin:0px;padding:0px;">
                                      <tr>
                                        <td style="border-style:none;padding:0px;"></td>
                                        {{-- <td style="padding:0px;border-style:none;" class="kh12-b">{{ sprintf("%04d",$item->id) }}</td> --}}
                                        <td class="kh12-b" style="padding:0px;border-style:none;">
                                          {{ date('d-m-Y',strtotime($item->dd)) . ' ' .  $item->tt}}
                                          <span>
                                            {{ $item->partner->name }} {{ $item->user->name }}
                                          </span>
                                        </td>
                                        <td class="kh12-b" style="padding:0px;text-align:right;color:black;border-style:none;">
                                          +{{ phpformatnumber(abs($item->amount)) . ' ' . $item->currency->shortcut }}
                                        </td>
                                      </tr>
                                  </table>
                                </td>
                              </tr>
                            @endforeach
                            @php
                                $left_out+=$left2;
                            @endphp
                            <tr id="sale{{ $e->id }}" style="background-color:rgb(224, 219, 163);">
                              <td colspan=4 style="border-style:none;padding:0px;">
                                <table class="table" style="margin:0px;padding:0px;">
                                  <tr>
                                    <td colspan=2 class="kh14-b @if($left2<>0) cma @endif" style="padding:0px;">
                                      សល់  {{ phpformatnumber($left2) . ' ' . $e->currency->shortcut }}
                                    </td>
                                    <td class="kh14-b" style="text-align:right;padding:0px;border-top:1px solid black" colspan=2>
                                      {{ phpformatnumber(abs($total2)) . ' ' . $e->currency->shortcut }}
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                      <td colspan=3 class="kh14-b" style="padding:0px;color:green;">សរុបលក់ {{ phpformatnumber($totalsale) . $cursale }}</td>
                      <td class="kh14-b" style="color:green;padding:0px;text-align:right;">{{ phpformatnumber($luysale) . 'USD' }}</td>
                    </tr>
                    <tr>
                      <td colspan=3 class="kh14-b" style="padding:0px;color:green;">សរុបទំនិញសល់</td>
                      <td class="kh14-b" style="color:green;padding:0px;text-align:right;">{{ phpformatnumber($left_out) . $cursale }}</td>
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
