<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner Slip Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>


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


        .kh10{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:10px;
            }
        .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
        .en16{
            font-family:Arial, Helvetica, sans-serif;
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
        .kh28{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:28px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        #tbl_body td{
            padding:0px;
            border-style:none;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
        }
        #tbl_header td{
            padding:0px;
            border-style:none;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
        }
        #tbl_cashin td{
            padding:0px;
            border-style:none;
        }
        #tbl_cashin th{
            padding:0px;
            border-style:none;
        }
        #tbl1 td{
            border-style:none;
        }
        #tbl1 th{
            /* border-style:none; */
        }
        #tbl2 td{
            /* border-style:none; */
        }
        #tbl2 th{
            /* border-style:none; */
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


            <div class="container" style="margin-top:10px;padding:10px;">
                @foreach ($slips as $key => $s)
                    <div class="row" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-header" style="background-color:rgb(182, 201, 182);height:60px;">
                                <div class="row" style="margin-top:-10px;">
                                    <table id="tbl1" class="table kh22" style="width:100%;">
                                        <tr>
                                            <td class="kh28">
                                                {{ $logo->name }} ផ្ញើអោយ {{ $s->partner->name }} {{ $s->child?'ជួយបន្តទៅ ' .$s->child:'' }}
                                            </td>

                                            <td class="kh22" style="text-align:center;color:red;">{{ $s->issend==1?'ផ្ញើឡើងវិញ':'' }}</td>
                                            <td class="kh22" style="float:right;">{{ date('d-m-Y',strtotime($s->dd)) }}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" style="padding:0px 20px 20px 20px;">
                                    <table id="tbl2" class="table table-bordered" style="width:100%;">
                                        <thead class="kh22" style="text-align:center;">
                                            <th>លរ</th>
                                            <th>លេខអ្នកទទូល</th>
                                            <th>ឈ្មោះអ្នកទទូល</th>
                                            <th>ចំនួនទឹកប្រាក់</th>
                                            <th>សេវ៉ាដៃគូ</th>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="kh22" style="text-align:center;">{{ ++$key }}</td>
                                                <td class="kh22">{{ $s->rectel }}</td>
                                                <td class="kh22">{{ $s->recname }}</td>
                                                <td class="kh22-b" style="text-align:right;">{{ phpformatnumber($s->amount) . ' ' . $s->currency->shortcut }}</td>
                                                <td class="kh22-b" style="text-align:right;">{{ phpformatnumber($s->fee) . ' ' . $s->feecurrency->shortcut }}</td>

                                            </tr>

                                        </tbody>
                                    </table>


                                </div>
                                <div class="row" style="margin-top:-20px;">
                                    <table>
                                        <tr>
                                            <td class="kh22 badge bg-primary"> TID:{{ $s->id }}</td>
                                            <td class="kh16" style="float:right;">
                                                {{ date('d-m-Y h:i:s a',strtotime($current))  }}
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



                <div class="row">
                    <button id="btnclosepage" class="btn btn-info" onclick="window.close()">Close</button>
                </div>
            </div>



</body>
<script type="text/javascript">


    // printContent('invoice-pos');
    // function printContent(el)
    // {onclick="window.close()"

    //   //var restorpage=document.body.innerHTML;
    //   var printloc=document.getElementById(el).innerHTML;
    //   document.body.innerHTML=printloc;
    //   window.print();
    //   window.onafterprint = function(){ window.close()};
    //   //history.back();
    //   //document.body.innerTHML=restorpage;

    // }
</script>
</html>
