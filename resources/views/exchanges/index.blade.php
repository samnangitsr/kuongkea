@extends('master')
@section('title')ប្តូរប្រាក់@endsection
@section('css')
    <style type="text/css">
        body.wait, body.wait *{
			cursor: wait !important;
		}
        .bankid + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;}
        #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:35px;}
		/* Each result */
	    #select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;}

     /* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;}
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
        }
        .select2-selection__arrow {
            height: 35px !important;
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
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh32{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:32px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        .buttonstyle:hover{
            background-color:aqua;
        }
        .buttonstyle{
            border:1px solid gray;
        }
        .buttonstyle1:hover{
            background-color:rgb(130, 221, 130);
        }
        .buttonstyle1{
            border-style:none;
            background-color:inherit;
            color:rgb(2, 34, 2);
            padding:0px 10px 0px 10px;
            font-family: 'khmer os muol light';
            font-size:22px;
        }
        .threedtext {
            font-size: 2em;
            font-weight: bold;
            color: #e4f314;
            text-shadow:
                1px 1px 0 black,
                2px 2px 0 black,
                3px 3px 0 black,
                4px 4px 0 black,
                5px 5px 0 black;
        }
       .txtexchange{
        font-weight:bold;
        font-size:16px;
        text-align:right;
       }

       input.blue{
        color:blue;
       }
       input.red{
        color:red;
       }
      #tableexchange td{
        border-style:none;
       }
       #tablemultiexchange td{
        padding:5px;
       }
       #tbl_pnl td{
        border-style:none;
        padding:5px 0px 0px 0px;
       }
    #tblratedisplay .clickedrow td{
        background-color: #d9ee64;
    }
    .tblexchangelist .clickedrow td{
        background-color: #caaf8f;
    }
    .tblexchangelist .clickedrow td input{
        background-color: #caaf8f;
    }
    #tblexchangemultiple td{
        padding:0px;
    }
    #tblexchangemultiple td input{
        padding:0px;
    }
    #tblgolddeposit td{
        border-style:none;
        padding:5px;
    }
    .tableFixHead{ overflow: auto;background-color:lightgray;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
      .dropdown-menu li > a:hover{
            background-color:rgb(57, 8, 233);
            color:white;
        }
        .dropdown-menu li{
            padding:0px;
        }
        #tbl_viewmoney th{
            padding:2px;
        }
        #tbl_viewmoney td{
            padding:2px;
        }
        #tbl_moneycashin th{
            padding:2px;
        }
        #tbl_moneycashin td{
            padding:2px;
            border:1px solid black;
        }
        #tbl_moneycashout th{
            padding:2px;
        }
        #tbl_moneycashout td{
            padding:2px;
            border:1px solid black;
        }
        .btnshowrate:hover{
            background-color:pink;
        }
        ul.ui-autocomplete {
            z-index: 1100;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
        }
    </style>
@endsection
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
@section('content')
    <div class="row" style="margin-top:-20px;">
        <div class="col-lg-6">
            <div id="part1" class="">

              <form id="frmexchange" action="">
                <div class="card" style="border:1px solid silver;">
                    <div class="card-body" style="padding:0px 25px 0px 25px;">
                        <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                        <div class="row" style="margin-top:5px;">
                            <table>
                                <tr>
                                    <td colspan=3>
                                        @foreach ($currencybuttons as $cb)
                                            <button style="display:inline;" class="buttonstyle kh16-b currencybtn" id="{{ $cb->id }}" data-id12="{{ $cb->id12 }}">{{ $cb->btnname }}</button>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr style="border:1px solid green;border-style:dashed;">
                                    <td style="width:100px;">
                                        <input type="text" name="invdate" id="invdate" class="form-control kh16-b" style="padding:2px;width:100px;background-color:inherit;" readonly>
                                    </td>
                                    <td>
                                        <span class="input-group-text" style="border-style:none;width:40px;background-color:inherit;"><i class="fa fa-calendar"></i></span>
                                    </td>
                                    <td style="padding:0px;">
                                        <div style="position: relative;left:150px;">
                                            <button class="buttonstyle1 threedtext" id="curcur" style="">CUR1-CUR2</button>
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </div>
                        <div class="row mb-3" style="">
                            {{-- <div class="table-responsive"> --}}
                                <table id="tableexchange" class="kh16-b">


                                    <tr>
                                        <td style="">
                                            {{-- <button id="btntolistbuy" class="btn btn-info kh16-b">ចូលបញ្ជី</button> --}}
                                            <div class="circular--landscape" style="display:inline;">
                                                <img id="imgbuy" style=" width: 100px;"
                                                    src="" />
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="txtsign" id="txtsign" value="+" class="form-control txtexchange" style="width:80px;text-align:center;float:right;display:inline;color:blue;" readonly>
                                        </td>
                                        <td style="">
                                            <input type="text" name="txtbuy" id="txtbuy" class="form-control txtexchange canenter" style="color:blue;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                                        </td>
                                        {{-- <td style="width:100px;"><input type="text" name="lblbuy" id="lblbuy" value="" class="form-control txtexchange" style="width:100px;text-align:center;" readonly></td> --}}
                                        <td style="width:100px;">
                                            <select name="lblbuy" id="lblbuy" class="form-select kh16-b" style="width:100px;font-weight:bold;">
                                                <option value=""></option>
                                                @foreach ($allcurrencies as $c)
                                                    <option value="{{ $c->id }}" lomeang="{{ $c->lomeang }}" isgold="{{ $c->isgold }}" tuochek="{{ $c->tuochek }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=2><input type="text" value="Rate" id="lblrate" class="form-control txtexchange" style="width:80px;text-align:center;float:right;" readonly></td>
                                        <td style=""><input type="text" name="txtrate" id="txtrate" class="form-control txtexchange canenter" style="" autocomplete="off"></td>
                                        <td style="width:100px;"><input type="button" id="btnaddlist" value="ADD" class="buttonstyle txtexchange" style="width:100px;height:37px;text-align:center;" readonly></td>
                                    </tr>
                                    <tr class="watergold" style="display:none;background-color:gold;">
                                        <td colspan=2><input type="text" value="ទឹកមាស" id="lblgoldwater" class="form-control txtexchange" style="width:80px;text-align:center;float:right;background-color:gold;" readonly></td>
                                        <td style=""><input type="text" name="txtgoldwater" id="txtgoldwater" class="form-control txtexchange canenter" value="100" style="background-color:rgb(223, 210, 139);" autocomplete="off"></td>
                                        <td class="kh16" style="width:100px; padding-left:10px;"> /100</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{-- <button id="btntolistsale" class="btn btn-info kh16-b">ចូលបញ្ជី</button> --}}
                                            <div class="circular--landscape" style="display:inline;">
                                                <img id="imgsale" style=" width: 100px;"
                                                    src="" />
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" id="txtsign1" value="-" class="form-control txtexchange" style="width:80px;text-align:center;float:right;display:inline;color:red;" readonly>
                                        </td>
                                        <td style=""><input type="text" name="txtsale" id="txtsale" class="form-control txtexchange canenter" style="color:red;" autocomplete="off"></td>
                                        {{-- <td style="width:100px;"><input type="text" name="lblsale" id="lblsale" value="" class="form-control txtexchange" style="width:100px;text-align:center;" readonly></td> --}}
                                        <td style="width:100px;">
                                            <select name="lblsale" id="lblsale" class="form-select kh16-b" style="width:100px;font-weight:bold;">
                                                <option value=""></option>
                                                @foreach ($allcurrencies as $c)
                                                    <option value="{{ $c->id }}" lomeang="{{ $c->lomeang }}" isgold="{{ $c->isgold }}" tuochek="{{ $c->tuochek }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=2>
                                            <label id="lblcashreceive" for="" style="font-weight:bold;" class="kh16">ប្រាក់ទទួល</label>
                                        </td>

                                        <td style=""><input type="text" name="txtcashreceive" id="txtcashreceive" class="form-control txtexchange canenter" style=""></td>
                                        <td style="width:100px;">

                                            <select name="lblcashin" id="lblcashin" class="form-select kh16-b" style="width:100px;font-weight:bold;">
                                                <option value=""></option>
                                                @foreach ($allcurrencies as $c)
                                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=2>
                                            <label id="lblcashreturn" for="" style="font-weight:bold;" class="kh16">ប្រាក់អាប់</label>
                                        </td>
                                        <td colspan=2><textarea class="form-control txtexchange" id="txtcashreturn" name="txtcashreturn" rows="2" style=""></textarea></td>
                                    </tr>
                                    <tr>
                                      <td colspan=2>
                                         ***សំគាល់
                                      </td>
                                      <td colspan=2><textarea class="form-control kh16" id="txtdesr" name="txtdesr" rows="2" style=""></textarea></td>
                                  </tr>
                                </table>
                            {{-- </div> --}}
                        </div>

                    </div>
                    <div class="card-footer">
                        <button id="btnclear" class="buttonstyle kh14-b">សំអាត</button>

                        <button class="buttonstyle kh14-b" id="btnhasmoney" style="color:blue;">មានលុយ</button>
                        <button class="buttonstyle kh14-b" id="btnneedmoney" style="color:red;">ត្រូវការលុយ</button>
                        <button class="buttonstyle kh14-b" data-sign='-1' id="btnbankin" style="color:blue;">បាញ់ចូល</button>
                        <button class="buttonstyle kh14-b" data-sign='1' id="btnbankout" style="color:red;">បាញ់ចេញ</button>
                        @if(config('helper.haveexchangegold')==1)
                            <button class="buttonstyle kh14-b" id="btngolddeposit" style="color:rgb(175, 10, 180);">កក់មាស</button>
                        @endif

                        <div style="float:right">
                            <button class="buttonstyle kh14-b" id="btnprint_test" style="">Print Test</button>
                            <button class="buttonstyle kh14-b" id="btnviewmoney" style="">ផ្ទៀងផ្ទាត់លុយ</button>
                            <button id="btnsave" class="buttonstyle kh14-b">រក្សាទុក</button>
                            <button id="btnsaveprint" class="buttonstyle kh14-b">រក្សាទុកព្រីន</button>
                        </div>

                    </div>
                </div>
              </form>
            </div>
            <div id="div_viewmoney" class="" style="margin-top:-15px;display:none;">
                <table id="tbl_viewmoney" class="table table-bordered table-hover kh14-b">
                    <thead style="text-align:center;">
                        <th>បរិយាយ <button id="btnclosediv_viewmoney" class="buttonstyle kh12-b" style="float:left;">x</button></th>
                        <th colspan=2>លុយទទួល</th>
                        <th colspan=2>លុយប្រគល់</th>
                    </thead>
                    <tbody id="body_viewmoney">

                    </tbody>
                </table>

            </div>
            <div class="row" style="">
                <div id="divcashin" class="col-lg-6" style="display:none;">
                    <table id="tbl_moneycashin" class="table table-bordered table-hover" style="">
                        <thead>
                            <th colspan=2 style="text-align:center;background-color:blue;color:white;">
                                Cash In
                            </th>
                        </thead>
                        <tbody id="body_moneycashin">

                        </tbody>

                    </table>

                </div>
                <div id="divcashout" class="col-lg-6" style="display:none;">
                    <table id="tbl_moneycashout" class="table table-bordered table-hover" style="">
                        <thead>
                            <th colspan=2 style="text-align:center;background-color:red;color:white;">
                                Cash Out
                            </th>
                        </thead>
                        <tbody id="body_moneycashout">

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <div class="col-lg-6">
            <div id="part2" class="" style="margin:0px;padding:0px;">
                <div class="row" id="rowmultiexchange" style="margin:0px;padding:0px;">
                    <form id="frmmultiexchange" action="" style="padding:0px;">
                        <div class="card" style="">
                            <div class="card-header" style="height:40px;">
                                <p class="kh16-b">Multi Exchange</p>
                            </div>
                            <div class="card-body" id="tblexchangemultiple" style="padding:0px;">
                                <div class="row" style="">
                                    <div class="table-responsive">
                                        <table id="tablemultiexchange" class="table table-bordered">
                                            <thead style="text-align:center;">
                                                <th>No</th>
                                                <th>Buy</th>
                                                <th>Cur</th>
                                                <th style="display:none;">Buyinfo</th>
                                                <th>Rate</th>
                                                <th style="display:none;">Rateinfo</th>
                                                <th>GW</th>
                                                <th>Sale</th>
                                                <th>Cur</th>
                                                <th style="display:none;">Saleinfo</th>
                                                <th style="display:none;">Drate</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody id="multiexlist">
                                                @foreach ($mex as $key => $m)
                                                    <tr class="multiexchange">
                                                        <td style="text-align:center;">{{ ++$key }}</td>
                                                        <td>
                                                            <input type="text" name="txtbuys[]" class="form-control txtbuys" style="width:100%;border-style:none;text-align:right;background-color:white;font-weight:bold;" readonly value="{{ phpformatnumber($m->buy) }}">
                                                        </td>
                                                        <td style="width:60px;">
                                                            <input type="text" name="txtcurbuys[]" class="form-control txtcurbuys" style="width:60px;border-style:none;text-align:center;background-color:white;font-weight:bold;" readonly value="{{ $m->curbuy }}">
                                                        </td>
                                                        <td style="display:none;">
                                                            <input type="text" name="txtbuyinfoes[]" class="form-control txtbuyinfoes" style="width:50px;border-style:none;font-weight:bold;" readonly value="{{ $m->buyinfo }}">
                                                        </td>
                                                        <td style="width:100px;">
                                                            <input type="text" name="txtrates[]" class="form-control txtrates" style="width:100px;border-style:none;text-align:center;background-color:white;font-weight:bold;" readonly value="{{ floatval($m->rate) }}">
                                                        </td>
                                                        <td style="display:none;">
                                                            <input type="text" name="txtrateinfoes[]" class="form-control txtrateinfoes" style="width:50px;border-style:none;padding:0px;font-weight:bold;" readonly value="{{ $m->rateinfo }}">
                                                        </td>
                                                        <td style="width:70px;">
                                                            <input type="text" name="txtgoldwaters[]" class="txtgoldwaters" style="width:100%;border-style:none;text-align:right;background-color:white;font-weight:bold;" readonly value="{{ phpformatnumber($m->goldwater) }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="txtsales[]" class="form-control txtsales" style="width:100%;border-style:none;text-align:right;background-color:white;font-weight:bold;" readonly value="{{ phpformatnumber($m->sale) }}">
                                                        </td>
                                                        <td style="width:60px;">
                                                            <input type="text" name="txtcursales[]" class="form-control txtcursales" style="width:60px;border-style:none;text-align:center;background-color:white;font-weight:bold;" readonly value="{{ $m->cursale }}">
                                                        </td>
                                                        <td style="display:none;">
                                                            <input type="text" name="txtsaleinfoes[]" class="form-control txtsaleinfoes" style="width:50px;border-style:none;font-weight:bold;" value="{{ $m->saleinfo }}">
                                                        </td>
                                                        <td style="display:none;">
                                                            <input type="text" name="txtdrates[]" class="form-control txtdrates" style="width:50px;border-style:none;padding:5px;font-weight:bold;" value="{{ $m->drate }}">
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <a data-id="{{ $m->id }}" class="btn btn-danger btn-sm btndelmxlist" style="padding:0px 5px 0px 5px;" href="">Del</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:-20px;">
                                    <div class="col-lg-8">
                                        <div class="table-responsive">
                                            <table class="table" id="tbl_in">
                                                <thead class="kh16" style="text-align:center;">
                                                    <th style="display:none;">No</th>
                                                    <th style="width:33.33%">សរុប</th>
                                                    <th style="display:none;">Amount</th>
                                                    <th style="display:none;">Cur</th>
                                                    <th style="display:none;">Action</th>
                                                    <th style="width:33.33%">ប្រាក់ទទួល</th>
                                                    <th style="width:33.33%">ប្រាក់អាប់</th>
                                                </thead>
                                                <tbody>

                                                    @php
                                                        $i1=0;
                                                    @endphp
                                                    @foreach ($cashin as $ci)
                                                    @php
                                                        $i1+=1
                                                    @endphp
                                                    <tr style="color:blue">
                                                        <td class="no1" style="display:none;">{{ $i1 }}</td>
                                                        <td style="font-size:16px;text-align:right;font-weight:bold;border:1px solid black;">{{ phpformatnumber($ci['value']) }} {{ $ci['cur'] }}</td>
                                                        <td class="amt1" style="font-size:16px;text-align:right;display:none;">{{ phpformatnumber($ci['value']) }} </td>
                                                        <td class="cur1" style="font-size:16px;text-align:right;display:none;">{{ $ci['cur'] }}</td>
                                                        <td class="action1" style="display:none;"></td>
                                                        <td style="padding:0px;">
                                                            <input type="text" class="exmulti_receive_amt tdcanenter" style="width:100%;text-align:right;font-size:16px;font-weight:bold;border-style:none;padding-right:5px;">
                                                        </td>
                                                        <td style="padding:0px;">
                                                            <input type="text" class="exmulti_return_amt tdcanenter" style="width:100%;text-align:right;font-size:16px;font-weight:bold;border-style:none;" readonly>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="table-responsive">
                                            <table class="table" id="tbl_out">
                                                <thead class="kh16" style="text-align:center;">
                                                    <th style="display:none;">No</th>
                                                    <th>ប្រាក់ប្រគល់</th>
                                                    <th style="display:none;">Amount</th>
                                                    <th style="display:none;">Cur</th>
                                                    <th style="display:none;">Action</th>
                                                </thead>
                                                <tbody>

                                                    @php
                                                        $i2=0;
                                                    @endphp
                                                    @foreach ($cashout as $co)
                                                        @php
                                                            $i2+=1
                                                        @endphp
                                                        <tr style="color:red">
                                                        <td class="no2" style="display:none;">{{ $i2 }}</td>
                                                        <td style="font-size:16px;text-align:right;font-weight:bold;">{{ phpformatnumber($co['value']) }} {{ $co['cur'] }}</td>
                                                        <td class="amt2" style="font-size:16px;text-align:right;display:none;">{{ phpformatnumber($co['value']) }} </td>
                                                        <td class="cur2" style="font-size:16px;text-align:right;display:none;">{{ $co['cur'] }}</td>
                                                        <td class="action2" style="display:none;"></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="btnclearlist" class="buttonstyle kh14-b">Clear List</button>
                                <button id="btnprint_test2" class="buttonstyle kh14-b">Print Test</button>
                                <div style="float:right">
                                    <button id="btnsavelist" class="buttonstyle kh14-b">រក្សាទុក</button>
                                    <button id="btnsavelistprint" class="buttonstyle kh14-b">រក្សាទុកព្រីន</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="divr2" class="row" style="display:none;">
                    <div class="card">
                        <input type="hidden" id="txt_hn">
                        <div class="card-header" style="height:35px;">

                            <div class="row">
                                <div class="col-lg-6">
                                    <h1 id="hd_r2" class="kh16-b">អតិថិជនមានលុយ</h1>
                                </div>
                                <div class="col-lg-6">
                                <span style="float:right;font-size:16px;margin-top:-5px;"><button id="btnclosedivr2" class="buttonstyle" style="color:red;">X</button></span>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td class="kh16" style="padding:0px;border-style:none;width:100px;">ចំនួនទឹកប្រាក់</td>
                                    <td style="padding:0px; border-style:none;">
                                        <input type="text" class="form-control kh16-b amt_hn" style="text-align:right;">
                                    </td>
                                    <td style="padding:0px; border-style:none;width:130px;">
                                        <select id="selcur_hn" class="form-select selcur_hn kh16" style="width:130px;">
                                            <option value=""></option>
                                            @foreach ($allcurrencies as $c)
                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16" style="padding:0px; border-style:none;">សរុប</td>
                                    <td style="padding:0px; border-style:none;">
                                        <input type="text" class="form-control kh16-b cut_hn" style="text-align:right;">
                                    </td>
                                    <td style="padding:0px; border-style:none;">
                                        <input type="text" id="hnc1" class="form-control kh16" style="width:130px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16" style="padding:0px;border-style:none;">នៅសល់</td>
                                    <td style="padding:0px;border-style:none;">
                                        <input type="text" class="form-control kh16-b bal_hn" style="text-align:right;">
                                    </td>
                                    <td style="padding:0px; border-style:none;">
                                        <input type="text" id="hnc2" class="form-control kh16" style="width:130px;">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" id="notelist">
                    <input type="hidden" id="partnersign" name="partnersign" value="0">
                    <div id="divpartnerlist" style="display:none;">
                                <div class="row">
                                    <table>
                                        <tr style="background-color:silver;">

                                            <td style="padding-left:20px;">
                                                <div class="form-check form-check-inline" style="">
                                                    <input style="margin-top:5px;" type="radio" class="form-check-input" id="radio_in" name="optinout" value="-1">
                                                    <label style="" class="form-check-label kh16-b" for="radio_in">បាញ់ចូល(គេខ្វះយើង)</label>
                                                </div>
                                                <div class="form-check form-check-inline" style="">
                                                    <input style="margin-top:5px;" type="radio" class="form-check-input" id="radio_out" name="optinout" value="1">
                                                    <label style="color:red;" class="form-check-label kh16-b" for="radio_out">បាញ់ចេញ(យើងខ្វះគេ)</label>
                                                </div>
                                            </td>

                                            <td style="padding:0px;">
                                                <span style="float:right;font-size:12px;margin-left:20px;"><button id="btnclosedivpartnerlist" class="buttonstyle" style="color:red;">X</button></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <input type="hidden" id="txtsignlist" name="txtsignlist">
                                <input type="hidden" id="ex_no" name="ex_no">
                                <form action="" id="frmtolist">
                                    <table id="tbl_pnl" class="table kh14-b">
                                        <tr>
                                            <td colspan=3 style="text-align:right;">
                                                <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radall" value="all" >
                                                <label class="form-check-label kh16-b" for="radall">ទាំងអស់</label>
                                                <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radpartner" value="PARTNER">
                                                <label class="form-check-label kh16-b" for="radpartner">ដៃគូ</label>
                                                <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radbank" value="BANK" checked>
                                                <label class="form-check-label kh16-b" for="radbank">ធនាគា</label>
                                                <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radcustomer" value="CUSTOMER">
                                                <label class="form-check-label kh16-b" for="radcustomer">អតិថិជន</label>
                                                <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radagent" value="AGENT">
                                                <label class="form-check-label kh16-b" for="radagent">ភ្នាក់ងារ</label>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="">ជ្រើសរើសដៃគូ</td>
                                            <td colspan=2 style="">
                                                <select class=" select2-option kh14-b" name="selpartner" id="selpartner" style="width:100%;">
                                                    <option value=""></option>

                                                    @foreach ($partners->where('customertype','BANK') as $p)
                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" agenttype="{{ $p->agent_type_id }}" countrycode="{{ $p->tel }}" maxtransfer="{{ $p->agenttype->transfer_amount }}" maxcuscharge="{{ $p->agenttype->customer_fee }}" maxfee="{{ $p->agenttype->cashdraw_fee }}" maxtransferfee="{{ $p->agenttype->transfer_fee }}" userconnect="{{ $p->user_connect }}" thai_list="{{ $p->thai_list }}" @if(Auth::id()==$p->user_connect) selected @endif>{{ $p->name }}</option>
                                                @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="background-color:bisque;">
                                            <td class="kh16-b">សមតុល្យ</td>
                                            <td style="padding:0px;" colspan=2>
                                                <input type="text" id="balance1" class="form-control kh16-b" style="border-style:none;background-color:bisque;;text-align:right;color:red;width:49%;display:inline;" readonly>
                                                <input type="text" id="balancenext1" class="form-control kh16-b" style="border-style:none;background-color:bisque;;text-align:right;color:blue;width:50%;display:inline;" readonly>
                                            </td>

                                        </tr>
                                        <tr id="row_seltranname" style="display:none;">
                                            <td style="">ប្រតិបត្តិការណ៏</td>
                                            <td colspan=2>
                                                <select class="form-select select2-option kh14-b" name="seltranname" id="seltranname" style="width:100%;height:35px;">
                                                    {{-- <option value=""></option>
                                                    @foreach ($trannames as $trn)
                                                        <option value="{{ $trn->id }}" sign="{{ $trn->sign }}">{{ $trn->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                        <td>បុគ្គលិកពាក់ព័ន្ធ</td>
                                        <td colspan=2>
                                            <select class="select2-option kh14" name="seluseraffect" id="seluseraffect" style="width:100%;height:30px;">
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        </tr>
                                        <tr id="rowitem">
                                            <td><label class="kh14" style="width:120px;">កុងធនាគា</label></td>
                                            <td colspan=2>
                                                <select class="kh14" name="selitem" id="selitem" style="width:100%;height:30px;">

                                                </select>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td id="tdamtlist">ចំនួនទឹកប្រាក់</td>
                                            <td><input id="amtlist" name="amtlist" type="text" class="form-control kh16-b canenter numbertext" value="0" style="padding:2px;text-align:right;width:100%;"></td>
                                            <td style="width:80px;">
                                                {{-- <input id="txtcur1" type="text" class="form-control kh22" readonly> --}}
                                                <select name="selcurlist" id="selcurlist" class="kh16-b" style="width:80px;height:30px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" {{ $c->shortcut=='USD'?'selected':'' }}>{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>សេវ៉ា
                                            <span>
                                                <input class="form-check-input" type="checkbox" id="ckwater" name="ckwater" value="" >
                                                <label for="ckwater" class="form-check-label kh14-b">ដកទឹក</label>
                                            </span>
                                        </td>
                                        <td><input id="cuschargelist" name="cuschargelist" type="text" class="form-control kh16-b canenter numbertext" value="0" style="padding:2px;text-align:right;width:100%;"></td>
                                        <td style="width:80px;">

                                            <select name="cuschargelistcur" id="cuschargelistcur" class="kh16-b" style="width:80px;height:30px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" {{ $c->shortcut=='USD'?'selected':'' }}>{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>អោយដៃគូ</td>
                                        <td><input id="partnerfeelist" name="partnerfeelist" type="text" class="form-control kh16-b canenter numbertext" value="0" style="padding:2px;text-align:right;width:100%;"></td>
                                        <td style="width:80px;">

                                            <select name="partnerfeelistcur" id="partnerfeelistcur" class="kh16-b" style="width:80px;height:30px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" {{ $c->shortcut=='USD'?'selected':'' }}>{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>ទូទាត់សាច់ប្រាក់</td>
                                            <td><input id="payincash" name="payincash" type="text" class="form-control kh16-b" style="padding:2px;text-align:right;" value="0" readonly></td>
                                            <td style="width:80px;">
                                                <input id="txtcur2" type="text" class="form-control kh16-b" style="padding:2px;" readonly value="USD">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>លេខអ្នកទទួល</td>
                                            <td colspan=2><input id="txtrecphonelist" name="txtrecphonelist" placeholder="លេខអ្នកទទួល" type="text" class="form-control kh16-b canenter" style="padding:2px;"></td>
                                        </tr>
                                        <tr>
                                            <td>ឈ្មោះអ្នកទទួល</td>
                                            <td colspan=2><input id="txtrecnamelist" name="txtrecnamelist" placeholder="ឈ្មោះអ្នកទទួល" type="text" class="form-control kh16-b canenter" style="padding:2px;"></td>
                                        </tr>
                                        <tr>
                                            <td>លេខអ្នកផ្ញើ</td>
                                            <td colspan=2><input id="txtsendphonelist" name="txtsendphonelist" placeholder="លេខអ្នកផ្ញើ" type="text" class="form-control kh16-b canenter" style="padding:2px;"></td>
                                        </tr>
                                        <tr>
                                            <td>ឈ្មោះអ្នកផ្ញើ</td>
                                            <td colspan=2><input id="txtsendnamelist" name="txtsendnamelist" placeholder="ឈ្មោះអ្នកផ្ញើ" type="text" class="form-control kh16-b canenter" style="padding:2px;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan=3 style="padding:20px 0px 0px 0px;">
                                                {{-- <button id="btnbankpayment" class="btn btn-info">Bank Payment</button> --}}
                                                <button  id="btnaddtolist" class="buttonstyle kh14-b">ADD TO LIST</button>
                                                <button id="btncleartablelist" class="buttonstyle kh14-b" style="float:right;">CLEAR LIST</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>


                    </div>
                </div>
                <div class="row">
                    <form action="" id="frmpartnerlist">
                        <div id="divfrmpartnerlist" style="display:none">
                            <div class="card">
                                <div class="card-header" style="height:30px;">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3 class="kh16-b" id="pnl">Partner List</h3>
                                        </div>
                                        <div class="col-lg-6">
                                            <span style="float:right;font-size:12px;margin-top:-5px;"><button id="btnclosefrmpartnerlist" class="buttonstyle" style="color:red;font-weight:bold;">X</button></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tbl_partnerlist" class="table table-bordered">
                                            <thead style="text-align:center;">
                                                <th>No</th>
                                                <th style="display:none;">ID</th>
                                                <th>Act</th>
                                                <th>Partner Name</th>
                                                <th>Amount</th>
                                                <th>Cur</th>
                                                <th>Cuscharge</th>
                                                <th>Cur</th>
                                                <th>Fee</th>
                                                <th>Cur</th>
                                                <th>TotalCash</th>
                                                <th>Cur</th>
                                                <th>RecTel</th>
                                                <th>RecName</th>
                                                <th>SendTel</th>
                                                <th>SendName</th>
                                                <th>Transign</th>
                                                <th>Useraffect</th>
                                                <th>Exno</th>
                                                <th>ThaiList</th>

                                            </thead>
                                            <tbody id="body_partnerlist">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div  style="float:right">
                                        <button id="btnsavepartnerlist" class="buttonstyle kh14-b">Save</button>
                                        <button id="btnsavepartnerlistprint" class="buttonstyle kh14-b">Save Print</button>
                                        <button id="btnsavepartnerlist2" class="buttonstyle kh14-b">រក្សាទុក</button>
                                        <button id="btnsavepartnerlistprint2" class="buttonstyle kh14-b">រក្សាទុកព្រីន</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <form action="" id="frmbankpayment">
                        <input type="hidden" id="hasbankpayment" name="hasbankpayment" value='0'>
                        <input type="hidden" id="banksign" name="banksign" value="1">
                        <input type="hidden" id="haspartnerlist" name="haspartnerlist" value='0'>
                        <div id="divbankpayment" style="display:none">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3 class="kh22-b" id="bpm">Bank Payment</h3>
                                        </div>
                                        <div class="col-lg-6">
                                            <span style="float:right;font-size:22px;margin-left:20px;"><button id="btnclosedivbankpayment" class="btn btn-danger btn-md">X</button></span>
                                            <button id="btnaddrow" class="btn btn-info btn-md" style="float:right;">add row</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tbl_bankpayment" class="table table-bordered">
                                            <thead style="text-align:center;">
                                                <th style="display:none;">No</th>
                                                <th>Bank ID</th>
                                                <th style="display:none;">Bank Name</th>
                                                <th>Amount</th>
                                                <th>Cur</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody id="body_bankpayment">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <form action="" id="frmgolddeposit">

                        <div id="divgolddeposit" style="display:none">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3 class="kh22-b" id="bpm">Gold Deposit</h3>
                                        </div>
                                        <div class="col-lg-6">
                                            <span style="float:right;font-size:22px;margin-left:20px;"><button id="btnclosedivdeposit" class="btn btn-danger btn-md">X</button></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding:10px 10px 0px 10px;">
                                    <div class="table-responsive">
                                        <table id="tblgolddeposit" class="table kh16-b">
                                            <tr>
                                                <td>ចូលបញ្ជី</td>
                                                <td colspan=2>
                                                    <select name="selcustomergold" id="selcustomergold" class="form-select kh16-b" style="background-color:#d9ee64;">
                                                        @foreach ($partners->where('is_gold_list',1) as $item)
                                                            <option value="{{$item->id}}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>កក់ចំនួន</td>
                                                <td style="">
                                                    <input type="text" name="txtdeposit" id="txtdeposit" class="form-control canenter kh16-b" style="color:red;text-align:right;" autocomplete="off">
                                                </td>
                                                <td style="width:100px;">
                                                    <select name="selcurdeposit" id="selcurdeposit" class="form-select kh16-b" style="width:100px;font-weight:bold;">
                                                        <option value=""></option>
                                                        @foreach ($allcurrencies as $c)
                                                            <option value="{{ $c->id }}" {{ $c->shortcut == 'USD' ? 'selected' : '' }} lomeang="{{ $c->lomeang }}" isgold="{{ $c->isgold }}" tuochek="{{ $c->tuochek }}">{{ $c->shortcut }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>ទូទាត់តាម</td>
                                                <td colspan=2>
                                                    <select name="selbankdeposit" id="selbankdeposit" class="form-select kh16-b">
                                                        <option value="" customertype=""></option>
                                                        <option value="0" customertype="">Cash</option>
                                                        @foreach ($partners->where('customertype','BANK') as $item)
                                                            <option value="{{$item->id}}" customertype="{{$item->customertype}}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>ចំនួនទូទាត់</td>
                                                <td style="">
                                                    <input type="text" name="txtdeposit1" id="txtdeposit1" class="form-control canenter kh16-b" style="color:red;text-align:right;" autocomplete="off">
                                                </td>
                                                <td style="width:100px;">
                                                    <select name="selcurdeposit1" id="selcurdeposit1" class="form-select kh16-b" style="width:100px;font-weight:bold;">
                                                        <option value=""></option>
                                                        @foreach ($allcurrencies as $c)
                                                            <option value="{{ $c->id }}" {{ $c->shortcut == 'USD' ? 'selected' : '' }} lomeang="{{ $c->lomeang }}" isgold="{{ $c->isgold }}" tuochek="{{ $c->tuochek }}">{{ $c->shortcut }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ឈ្មោះអតិថិជន</td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control canenter kh16-b" id="client_name" name="client_name">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>លេខទូរស័ព្ទ</td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control canenter kh16-b" id="client_tel" name="client_tel">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=3 style="text-align:right;">
                                                    <button id="btnsavedeposit" class="buttonstyle kh14-b">រក្សាទុក</button>
                                                    <button id="btnsavedepositprint" class="buttonstyle kh14-b">រក្សាទុកព្រីន</button>
                                                    <button id="btnsavedeposit2" class="buttonstyle kh14-b" style="color:#0e33d8">រក្សាទុក</button>
                                                    <button id="btnsavedepositprint2" class="buttonstyle kh14-b" style="color:#1518e0">រក្សាទុកព្រីន</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <select name="selbank" id="selbank" class="form-select kh22" style="display:none;">
                <option value="">Select Bank</option>
                @foreach ($banks as $b)
                    <option value="{{ $b->id }}" customertype="{{ $b->customertype }}">{{ $b->name }}</option>
                @endforeach
            </select>
            <select name="selcur" id="selcur" class="form-select kh22" style="width:150px;display:none;">
                <option value=""></option>
                @foreach ($currencies as $c)
                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                @endforeach
            </select>
            <div id="rowexchangelist" class="row">
                <table>
                    <tr>
                        <td style="">
                             <label class="form-check-label kh16-b">
                            <input class="form-check-input kh16-b" type="checkbox" name="ckinputdate" id="ckinputdate"> ថ្ងៃកត់ត្រា</label>
                            <select name="filteruser" id="filteruser" style="height:25px;" class="kh14-b">
                                <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                @endforeach
                            </select>
                            <button id="btnshow" class="buttonstyle kh14-b" style="height:25px;">Data</button>
                            <button id="btnrefreshrate" class="buttonstyle kh14-b" style="height:25px;">Rate</button>
                        </td>

                    </tr>
                </table>
                <div class="tableFixHead" style="padding:0px;margin:0px;">
                    <table id="tblexchangelist" class="table table-bordered table-hover tblexchangelist kh12-b" style="table-layout:fixed;margin:0px;">
                        <thead style="text-align:center;">
                            <th style="padding:2px;width:70px;">លរ</th>
                            <th style="padding:2px;width:100px;">ថ្ងៃទី</th>
                            <th style="padding:2px;width:80px;">ម៉ោង</th>
                            <th style="padding:2px;width:80px;">ប្តូរប្រាក់</th>
                            <th style="padding:2px;width:150px;">ទិញចូល</th>
                            <th style="padding:2px;width:100px;">អត្រា</th>
                            <th style="padding:2px;width:70px;">ទឺកមាស</th>
                            <th style="padding:2px;width:150px;">លក់ចេញ</th>
                            <th style="padding:2px;width:120px;">អ្នកកត់ត្រា</th>
                            <th style="padding:2px;width:100px;">ថ្ងៃកត់ត្រា</th>
                            <th style="padding:2px;width:150px;">ក្រុម</th>
                            <th style="padding:2px;width:500px;">សំគាល់</th>

                        </thead>
                        <tbody id="bodyexchangelist">
                            @php
                                $dd='';
                                $created_at='';
                            @endphp
                            @foreach ($exchangelists as $key=>$e)
                                @php
                                    $dd=date('Y-m-d',strtotime($e->dd));
                                    $created_at=date('Y-m-d',strtotime($e->created_at));
                                @endphp
                                <tr id="tr_object_id_{{ $e->mapcode }}">
                                    <td style="text-align:center;padding:0px;">
                                        <div class="dropdown">
                                            <button style="width:70px;" type="button" class=" dropdown-toggle kh12-b" data-bs-toggle="dropdown">
                                                {{ ++$key }}
                                            </button>
                                            <ul class="dropdown-menu" style="padding:0px;">
                                                @if($e->status==1)
                                                    @if($e->isexchangelist==0)

                                                        @if(str_contains($e->action,'d'))
                                                            <li style=""><a data-id="{{ $e->mapcode }}" class="btndel dropdown-item kh16-b"  href="">Delete</a></li>
                                                        @endif
                                                        <li style=""><a data-id="{{ $e->mapcode }}" class="btnprint dropdown-item kh16-b"  href="">Print</a></li>

                                                    @endif
                                                @else
                                                    {{ $e->userdel }}
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                    <td style="padding:2px;@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                    <td style="padding:2px;">{{ $e->tt }}</td>

                                    <td style="text-align:center;padding:2px;">{{ $e->curbuy . '-' . $e->cursale }}</td>
                                    <td style="text-align:right;color:blue;padding:2px;">+{{ phpformatnumber($e->buy) . ' ' . $e->curbuy }}</td>
                                    <td style="text-align:right;padding:2px;{{ $e->rate<>$e->drate?'background-color:yellow;':'' }}">
                                        {{ $e->rate<>$e->drate ? floatval($e->rate) . '(' . floatval($e->drate) . ')' : floatval($e->rate) }}
                                    </td>
                                    <td style="text-align:right;padding:2px;">{{ ($e->goldwater ?? 0) == 0 ? '' : $e->goldwater }}</td>

                                    <td style="text-align:right;color:red;padding:2px;">-{{ phpformatnumber($e->sale) . ' ' . $e->cursale }}</td>
                                    <td style="padding:0px;"><input type="text" class="kh12-b" style="width:100%;border-style:none;background-color:inherit;" value="{{ $e->user->name }}" readonly></td>
                                    <td style="padding:2px;@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->created_at)) }}</td>
                                    <td style="text-align:center;padding:2px;">{{ $e->ref_group_id }}</td>
                                    <td style="text-align:center;padding:2px;">{{ $e->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table id="tblratedisplay" class="table table-bordered table-hover table-striped" style="table-layout: fixed;display:none;">
                        <thead class="kh22-b" style="text-align:center;">
                            <th style="width:200px;">រូបិយប័ណ្ណ</th>
                            <th style="width:50%;">ទិញចូល</th>
                            <th style="width:50%;">លក់ចេញ</th>

                        </thead>
                        <tbody id="body_displayrate">
                            @php
                                $nbuy='';
                                $nsale='';
                            @endphp
                            @foreach ($curleft as $c1)
                                @php
                                    if($c1->ispandp==1){
                                        $ssh=explode('-',$c1->shortcut);
                                        $nbuy=$ssh[0].'-'.$ssh[1];
                                        $nsale=$ssh[1].'-'.$ssh[0];
                                    }else{
                                        $nbuy=$c1->shortcut . '-USD';
                                        $nsale='USD-' . $c1->shortcut;
                                    }
                                @endphp
                                <tr class="kh22-b">
                                    <td style="text-align:center;">
                                        <span>
                                            {{ $c1->curname }}
                                        </span>
                                        <br>
                                        <span>
                                            {{$c1->shortcut}}
                                        </span>
                                    </td>
                                    @if($c1->ispandp==1)

                                        <td style="text-align:right;color:blue;">
                                            <button class="btnshowrate" title="{{$nsale}}" style="width:100%;">
                                                <span class="kh16-b badge bg-secondary" style="position: relative;top:-10px;color:white;">
                                                    {{$nsale}}
                                                </span>
                                                <br>
                                                <span style="position: relative;top:-10px;font-weight:bold;font-size:32px;color:blue;">
                                                    {{ $c1->ratesale }}
                                                </span>

                                            </button>
                                        </td>
                                        <td style="text-align:right;color:red;">
                                            <button class="btnshowrate" title="{{$nbuy}}" style="width:100%;">
                                                <span class="kh16-b badge bg-secondary" style="position: relative;top:-10px;color:white;">
                                                    {{$nbuy}}
                                                </span>
                                                <br>
                                                <span style="position: relative;top:-10px;font-weight:bold;font-size:32px;color:red;">
                                                    {{ $c1->ratebuy }}
                                                </span>
                                            </button>
                                        </td>
                                    @else
                                         <td style="text-align:right;color:blue;">
                                            <button class="btnshowrate" title="{{$nbuy}}" style="width:100%;">
                                                <span class="kh16-b badge bg-secondary" style="position: relative;top:-10px;color:white;">
                                                    {{$nbuy}}
                                                </span>
                                                <br>
                                                <span style="position: relative;top:-10px;font-weight:bold;font-size:32px;color:blue;">
                                                    {{ $c1->ratebuy }}
                                                </span>
                                            </button>
                                        </td>
                                        <td style="text-align:right;color:red;">
                                            <button class="btnshowrate" title="{{$nsale}}" style="width:100%;">
                                                <span class="kh16-b badge bg-secondary" style="position: relative;top:-10px;color:white;">
                                                    {{$nsale}}
                                                </span>
                                                <br>
                                                <span style="position: relative;top:-10px;font-weight:bold;font-size:32px;color:red;">
                                                    {{ $c1->ratesale }}
                                                </span>

                                            </button>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    {{-- @vite('resources/js/app.js'); --}}
@endsection
@section('script')
    @include('exchanges.exchangescript');
@endsection
