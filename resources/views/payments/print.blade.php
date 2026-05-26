<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
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
        .kh12{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
        <div class="row" style="margin-top:0px;">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:20%;text-align:center;padding:0px;">
                            <img src="{{ asset('public/logo/logo.jpg') }}" alt="" style="width:32px;">
                        </td>
                        <td style="width:60%;text-align:center;font-family:khmer os muol light;font-size:22px;padding:0px;">ឆាយប្រុស</td>
                        <td style="width:20%;text-align:center;padding:0px;">
                            <img src="{{ asset('public/logo/logo.jpg') }}" alt="" style="width:32px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:0%;text-align:center;"></td>
                        <td style="width:0%;text-align:center;"></td>
                    </tr>
                    
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:100%;text-align:center;font-family:khmer os muol light;font-size:12px;padding:0px;">ប្តូរប្រាក់ ទិញលក់មាស</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:100%;text-align:center;padding:0px;">Tel:012 999 666 / 010 554 669 / 097 7 8888 78</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh10" style="width:100%;text-align:center;padding:0px;">អាស័យដ្ឋាន:ផ្ទះលេខ 87 ខាងកើតផ្សារអូឡាំពិច ភ្នំពេញ</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh16" style="width:100%;text-align:center;padding:0px;">បង្កាន់ដៃបង់ប្រាក់</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <table style="width:50%;margin-left:15px;">
                <tr>
                    <td>អតិថិជន</td>
                    <td>{{ $payment->customer->name }}</td>
                </tr>
                <tr>
                    <td>Tel</td>
                    <td>{{ $payment->customer->tel }}</td>
                </tr>
                <tr>
                    <td>Addr</td>
                    <td>{{ $payment->customer->address }}</td>
                </tr>
            </table>
            <table style="width:40%">
                <tr>
                    <td>លេខបង់.</td>
                    <td>{{ sprintf('%04d',$payment->id) }}</td>
                </tr>
                
                <tr>
                    <td>ថ្ងៃកត់ត្រា</td>
                    <td>{{ date('d-m-Y',strtotime($payment->paiddate))}}</td>
                </tr>
                <tr>
                    <td>ម៉ោង</td>
                    <td>{{  $payment->paidtime }}</td>
                </tr>
                <tr>
                    <td class="kh10">អ្នកកត់ត្រា</td>
                    <td>{{ $payment->user->name }}</td>
                </tr>
            </table>         
        </div>
        
        <div class="row" style="margin-top:0px;">
            <div class="table-responsive">
                <table class="table table-bordered" style=""> 
                    <thead style="text-align:center;">
                        <th>No</th>
                        <th>ទូទាត់តាម</th>
                        <th>បរិយាយ</th>
                        <th>ចំនួនទឹកប្រាក់</th>
                    </thead>
                    <tbody>
                        @php
                            
                        @endphp
                        @foreach ($paymentdetails as $key =>$d)
                            
                            <tr>
                                <td style="text-align:center;padding:5px 0px 5px 0px;">{{ ++$key }}</td>
                                <td style="text-align:center;padding:5px 0px 5px 0px;">{{ $d->paymethod }}</td>
                                <td style="text-align:center;padding:5px 0px 5px 0px;">{{ $d->paynote??'' }}</td>
                                <td style="text-align:right;padding:5px 0px 5px 0px;">{{ phpformatnumber($d->amount) . ' ' . $d->cur }}</td>
                                
                            </tr>
                         
                        @endforeach
                        
                           
                       
                        
                       
                    </tbody>
                    
                    
                </table>
            </div>
            
            <div class="legalcopy" style="margin-top:-30px;">
                <p class=""legal>
                    <p style="font-family:Noto Sans Khmer,sans-serif;font-size:12px;text-align:center;color:black;">សូមអរគុណចំពោះការអញ្ជើញមក <br>
                        ** Thank you for your visiting **
                    </p>
                    
                </p>
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