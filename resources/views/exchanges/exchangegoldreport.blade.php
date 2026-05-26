@extends('master')
@section('title') ExchangeListsnew @endsection
@section('css')
<link href="{{ asset('public/admin') }} /assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" crossorigin="anonymous" />
    <style type="text/css">
      body.wait, body.wait *{
			cursor: wait !important;
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
            .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
            .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            }
            .kh12{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
       .tableFixHead{ overflow: auto;background-color:lightgray;}
       .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tableFixHead1{ overflow: auto;background-color:rgb(209, 224, 125);}
       .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:rgb(185, 238, 124) }
    .tblexchangelist .clickedrow td{
        background-color: #caaf8f;
    }
    .tblexchangelist .clickedrow td input{
        background-color: #caaf8f;
    }
    .tbl_modal .clickedrow td{
        background-color: #0b07d8;
        color:white;
    }
    .tbl_modal .clickedrow td input{
        background-color: #0e12e9;
        color:white;
    }
    .tblexchangelist td{
        padding:2px;
    }
    .tblexchangelist th{
        padding:2px;
    }
    .tbl_mainlist .clickedrow td{
        background-color: #6DD8B4FF;
    }
    .tbl_mainlist .clickedrow td input{
        background-color: #6DD8B4FF;
    }
    .tbl_mainlist td{
        padding:2px;
    }
    .tbl_mainlist th{
        padding:2px;
    }
    .bgred{
        background-color:red;
    }
    .mybtn{
        border:1px solid black;
        color:blue;
        padding:0px 5px;
    }
    .mybtn:hover{
        background-color:blue;
        color:white;
    }
     .dropdown-menu li > a:hover{
        background-color:rgb(21, 40, 214);
        color:white;
    }
    .dropdown-menu li{
        padding:0px;
        border-bottom:1px dotted black;
    }
    #tblgolddeposit td{
        border-style:none;
    }
     #tblgolddeposit2 td{
        border-style:none;
        padding-top:3px;
        padding-bottom:3px;
    }
     .buttonstyle{
        border-style:none;
     }
    .buttonstyle:hover{
        background-color:rgb(239, 241, 97);
    }
    /* move able modal */
    .draggable-modal .modal-dialog {
        cursor: move;
    }


    </style>

@endsection
@php
    function phpformatnumber($num)
    {
        if (!is_numeric($num)) {
            return $num;
        }

        $num = (string)$num;
        $dc = 0;

        if (strpos($num, '.') !== false) {
            $decimals = explode('.', $num)[1];
            // Count actual meaningful decimals (but max 4)
            $dc = min(strlen(rtrim($decimals, '0')), 4);
        }

        return number_format((float)$num, $dc, '.', ',');
    }


@endphp
@section('content')
    <div class="row" style="padding:0px;margin-top:-10px;">
        <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
        <input id="txtuserid" type="hidden" value="{{ Auth::id() }}">
        <div style="margin-bottom:10px;">
            <table>
                <tr>
                    <td class="kh16-b" style="width:40px;">គិតពី</td>
                    <td class="kh16-b" style="width:160px;">
                        <div class="input-group">
                            <input type="text" name="d1" id="d1" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;margin-top:0px;" readonly>
                            <span class="input-group-text" style="height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td class="kh16-b" style="width:40px;padding-left:10px;">ដល់</td>
                    <td class="kh16-b" style="width:160px;">
                        <div class="input-group">
                            <input type="text" name="d2" id="d2" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;margin-top:0px;" readonly>
                            <span class="input-group-text" style="height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>

                    <td class="kh16-b" style="width:85px;padding-left:10px;">អ្នកកត់ត្រា</td>
                    <td style="border-style:none;padding:0px;width:200px;">
                        <select name="seluser" id="seluser" class="kh16-b" style="width:200px;">
                            <option value="">ទាំងអស់</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @if($u->id==Auth::id()) selected @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="width:100px;">
                        <select name="selstatus" id="selstatus" class="kh16-b">
                            <option value="2">ទាំំងអស់</option>
                            <option value="1">ទិញចូល</option>
                            <option value="-1">លក់ចេញ</option>


                        </select>
                    </td>
                    <td style="">
                        <button id="btnsearch" class="mybtn kh14-b" style="height:25px;">Search</button>
                        <button id="btnprintreport" class="mybtn kh14-b" style="height:25px;">Print Report</button>
                        <button id="btnkatkong" class="mybtn kh14-b" style="height:25px;">កាត់កងបញ្ជី</button>

                    </td>
                    <td style="padding-left:5px;">
                        <input type="text" class="kh16" style="height:25px;" id="myInput" onkeyup="searchtblexchangelist()" placeholder="Search telephone..." title="input customer phone number">
                    </td>
                </tr>
            </table>
        </div>
        <div id="row_display">
            <div class="row" style="margin:0px;padding:0px;">
                <div class="col-lg-12" style="margin:0px;padding:0px;">
                    <div class="tableFixHead" style="padding:0px;margin:0px;">
                        <table id="tblexchangelist" class="table table-bordered table-hover tblexchangelist kh14-b" style="table-layout: fixed;">
                            <thead style="text-align:center;">
                                <th style="width:50px;">
                                    <div class="form-check">
                                        <input class="form-check-input ck_all kh22" style="margin-top:2px;margin-left:-15px;background-color:#c9a506;" type="checkbox" value="" id="cksel_all">
                                    </div>
                                </th>
                                <th style="width:60px;">លរ</th>
                                <th style="width:100px;">អតិថិជន</th>
                                <th style="width:100px;">លេខទូរស័ព្ទ</th>
                                <th style="width:100px;">ថ្ងៃទិញលក់</th>
                                <th style="width:80px;">ម៉ោង</th>
                                <th style="width:100px;">រូបិយប័ណ្ណ</th>
                                <th style="width:150px;">ទំនិញ</th>
                                <th style="width:80px;">ទឹក</th>
                                <th style="width:150px;">មាសល្អ</th>
                                <th style="width:100px;">អត្រា</th>
                                <th style="width:150px;">ទឹកប្រាក់</th>
                                <th style="width:150px;">សរុបទឹកប្រាក់</th>
                                <th style="width:100px;">លុយកក់</th>
                                <th style="width:100px;">នៅខ្វះ</th>


                                <th style="width:100px;">ទូទាត់តាម</th>

                                <th style="width:150px;">អ្នកកត់ត្រា</th>
                                <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                                <th style="width:100px;">ថ្ងៃកែប្រែ</th>
                                    <th style="width:180px;">GroupId</th>
                                <th style="width:500px;">សំគាល់</th>

                            </thead>
                            <tbody id="bodyexchangelist">
                                @php
                                    $dd='';
                                    $created_at='';
                                    $total_product=0;
                                    $total_gold=0;
                                    $total_amount=0;
                                    $bal=0;
                                    $total_balance=0;
                                    $total_sumamount=0;
                                    $total_deposit=0;
                                @endphp
                                @foreach ($exchanges as $key=>$e)
                                    @php
                                        $dd=date('Y-m-d',strtotime($e->dd));
                                        $created_at=date('Y-m-d',strtotime($e->created_at));
                                        $total_product += $e->product;
                                        $total_amount += $e->amount;
                                        $total_gold +=  ($e->product*$e->goldwater)/100;
                                        $total_balance +=-1 * floatval($e->balance);
                                        $total_sumamount += $e->sumamount;
                                        $total_deposit += -1 * floatval($e->sumamount+$e->balance);
                                    @endphp
                                    <tr id="tr_object_id_{{ $e->multiexchangecode }}" >
                                        <td style="text-align:center;width:60px;padding-left:20px;">
                                            <div class="form-check" style="margin-top:-5px;">
                                                <input class="form-check-input cknum kh22" type="checkbox" style="padding:0px;" value="" id="ck{{ $key }}">
                                            </div>
                                        </td>
                                        <td style="text-align:center;padding:0px;@if($dd<>$created_at)background-color:brown;color:white; @endif" class="kh14">
                                            @if($e->sumamount<>0)
                                                <div class="dropdown">
                                                    <button style="width:100%;" type="button" class="mybtn dropdown-toggle kh14" data-bs-toggle="dropdown">
                                                    {{ ++$key }}
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="dropdown-item kh16-b btnpayment" data-id="{{ $e->id }}" data-groupid="{{ $e->ref_group_id }}" data-balance="{{ $e->balance }}" data-client="{{$e->client}}" data-phone="{{$e->phone}}" data-examount="{{$e->amount}}">ទូទាត់</a></li>
                                                        <li>
                                                            <a href="{{ route('exchangegoldreport.showpaymentdetail',['exchange_id'=>$e->id,'group_id'=>$e->ref_group_id]) }}" class="dropdown-item kh16-b" target="_blank">Payment Group</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                {{ ++$key }}
                                            @endif
                                        </td>

                                        <td>{{ $e->client }}</td>
                                        <td>{{ $e->phone }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                        <td>{{ $e->tt }}</td>
                                        <td style="@if($e->product>0) color:blue; @else color:red; @endif">
                                            @if($e->product>0)
                                                +{{ $e->currency->curname }}
                                            @else
                                                -{{ $e->currency->curname }}
                                            @endif
                                        </td>
                                        <td style="text-align:right;@if($e->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->product) . ' ' . $e->currency->sk }}</td>
                                        <td style="text-align:right;padding:2px;">{{ ($e->goldwater ?? 0) == 0 ? '' : $e->goldwater }}</td>
                                        <td style="text-align:right;@if($e->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber(($e->product*$e->goldwater)/100) . ' ' . $e->currency->sk }}</td>

                                        <td style="text-align:right;padding:0px;{{ $e->rate<>$e->drate?'background-color:yellow':'' }}">
                                            @if($e->rate==$e->drate)
                                                {{ phpformatnumber($e->rate) }}
                                            @else
                                                {{ phpformatnumber($e->rate) }} <br> <span style="font-size:12px;color:green;position: relative;top:-5px">{{ phpformatnumber($e->drate) }}</span>
                                            @endif
                                        </td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->amount) . '$' }}</td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->sumamount) . '$' }}</td>

                                        <td style="text-align:right;@if($e->amount>0) color:red; @else color:blue; @endif">{{ phpformatnumber(-1 * floatval($e->sumamount+$e->balance)) . '$' }}</td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">
                                            {{ phpformatnumber(-1 * floatval($e->balance)) . '$' }}
                                        </td>
                                        <td>{{ $e->deposit_via }}</td>
                                        <td>{{ $e->user->name }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->created_at)) }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->updated_at)) }}</td>
                                        <td style="">{{ $e->ref_group_id }}</td>
                                        <td style="text-align:center;">{{ $e->note }}</td>
                                    </tr>
                                @endforeach
                                <tr style="background-color:aqua;border:3px solid green;">
                                    <td colspan=6 class="kh16-b" style="text-align:center;background-color:yellow;">សរុប</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_product>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_product) }} Li</td>
                                    <td style="background-color:yellow;"></td>
                                    <td class="kh16-b" style="text-align:right;@if($total_gold>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_gold) }} Li</td>
                                    <td style="background-color:yellow;"></td>
                                    <td class="kh16-b" style="text-align:right;@if($total_amount>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_amount) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_sumamount>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_sumamount) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_deposit>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_deposit) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_balance>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_balance) }}$</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0px;padding:0px;">
                <div class="col-lg-12" style="margin:0px;padding:0px;">
                    <div class="tableFixHead" style="padding:0px;margin:0px;">
                        <table id="tblexchangelist1" class="table table-bordered table-hover tblexchangelist kh14-b" style="table-layout:fixed;">
                            <thead style="text-align:center;">
                                <th style="width:65px;">លរ</th>
                                <th style="width:100px;">អតិថិជន</th>
                                <th style="width:100px;">លេខទូរស័ព្ទ</th>
                                <th style="width:100px;">ថ្ងៃទិញលក់</th>
                                <th style="width:80px;">ម៉ោង</th>
                                <th style="width:100px;">រូបិយប័ណ្ណ</th>
                                <th style="width:150px;">ទំនិញ</th>
                                <th style="width:80px;">ទឹក</th>
                                <th style="width:150px;">មាសល្អ</th>
                                <th style="width:100px;">អត្រា</th>
                                <th style="width:150px;">ទឹកប្រាក់</th>
                                <th style="width:150px;">សរុបទឹកប្រាក់</th>
                                <th style="width:100px;">លុយកក់</th>
                                <th style="width:100px;">នៅខ្វះ</th>
                                <th style="width:100px;">ទូទាត់តាម</th>
                                <th style="width:150px;">អ្នកកត់ត្រា</th>
                                <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                                <th style="width:100px;">ថ្ងៃកែប្រែ</th>
                                <th style="width:180px;">GroupId</th>
                                <th style="width:500px;">សំគាល់</th>
                            </thead>
                            <tbody id="bodyexchangelist1">
                                @php
                                    $dd='';
                                    $created_at='';
                                    $total_product=0;
                                    $total_gold=0;
                                    $total_amount=0;
                                    $total_sumamount=0;
                                    $total_deposit=0;

                                    $bal=0;
                                    $total_balance=0;
                                @endphp
                                @foreach ($exchanges_complete as $key=>$e)
                                    @php
                                        $dd=date('Y-m-d',strtotime($e->dd));
                                        $created_at=date('Y-m-d',strtotime($e->created_at));
                                        $total_product += $e->product;
                                        $total_amount += $e->amount;
                                        $total_sumamount += $e->sumamount;
                                        $total_deposit += -1 * floatval($e->sumamount+$e->balance);
                                        $total_gold +=  ($e->product*$e->goldwater)/100;
                                        $total_balance +=-1 * floatval($e->balance);
                                    @endphp
                                    <tr>

                                        <td style="text-align:center;padding:0px;@if($dd<>$created_at)background-color:brown;color:white; @endif" class="kh14">
                                             @if($e->sumamount<>0)
                                                <div class="dropdown">
                                                    <button style="width:100%;" type="button" class="mybtn dropdown-toggle kh14" data-bs-toggle="dropdown">
                                                    {{ ++$key }}
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('exchangegoldreport.showpaymentdetail',['exchange_id'=>$e->id,'group_id'=>$e->ref_group_id]) }}" class="dropdown-item kh16-b" target="_blank">Payment Group</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                {{ ++$key }}
                                            @endif

                                        </td>
                                        <td>{{ $e->client }}</td>
                                        <td>{{ $e->phone }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                        <td>{{ $e->tt }}</td>
                                        <td style="@if($e->product>0) color:blue; @else color:red; @endif">
                                            @if($e->product>0)
                                                +{{ $e->currency->curname }}
                                            @else
                                                -{{ $e->currency->curname }}
                                            @endif
                                        </td>
                                        <td style="text-align:right;@if($e->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->product) . ' ' . $e->currency->sk }}</td>
                                        <td style="text-align:right;padding:2px;">{{ ($e->goldwater ?? 0) == 0 ? '' : $e->goldwater }}</td>
                                        <td style="text-align:right;@if($e->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber(($e->product*$e->goldwater)/100) . ' ' . $e->currency->sk }}</td>

                                        <td style="text-align:right;padding:0px;{{ $e->rate<>$e->drate?'background-color:yellow':'' }}">
                                            @if($e->rate==$e->drate)
                                                {{ phpformatnumber($e->rate) }}
                                            @else
                                                {{ phpformatnumber($e->rate) }} <br> <span style="font-size:12px;color:green;position: relative;top:-5px">{{ phpformatnumber($e->drate) }}</span>
                                            @endif
                                        </td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->amount) . '$' }}</td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->sumamount) . '$' }}</td>

                                        <td style="text-align:right;@if($e->amount>0) color:red; @else color:blue; @endif">{{ phpformatnumber(-1 * floatval($e->sumamount+$e->balance)) . '$' }}</td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">
                                            {{ phpformatnumber(-1 * floatval($e->balance)) . '$' }}
                                        </td>
                                        <td>{{ $e->deposit_via }}</td>
                                        <td>{{ $e->user->name }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->created_at)) }}</td>
                                        <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->updated_at)) }}</td>
                                        <td style="text-align:center;">{{ $e->ref_group_id }}</td>
                                        <td style="text-align:center;">{{ $e->note }}</td>
                                    </tr>
                                @endforeach
                                <tr style="background-color:aqua;border:3px solid green;">
                                    <td colspan=6 class="kh16-b" style="text-align:center;background-color:yellow;">សរុប</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_product>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_product) }} Li</td>
                                    <td style="background-color:yellow;"></td>
                                    <td class="kh16-b" style="text-align:right;@if($total_gold>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_gold) }} Li</td>
                                    <td style="background-color:yellow;"></td>
                                    <td class="kh16-b" style="text-align:right;@if($total_amount>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_amount) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_sumamount>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_sumamount) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_deposit>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_deposit) }}$</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_balance>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_balance) }}$</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('exchanges.depositgold_modal');
    <div class="modal fade draggable-modal" id="modalSummary" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header kh16-b">
                    <h2 class="modal-title">Summary Selected Rows</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" >
                    <div class="row">
                        <div id="modal_summary_body">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <form action="" id="frmgolddeposit2">

                           <div class="table-responsive">
                                <table id="tblgolddeposit2" class="table kh16-b">
                                    <tr>
                                        <td class="kh16-b" style="">កាលបរិច្ឆេទ</td>
                                        <td class="kh16-b" style="">
                                            <div class="input-group">
                                                <input type="text" name="deposit_date2" id="deposit_date2" class="form-control kh16-b" style="background-color:white;" readonly>
                                                <span class="input-group-text" style="margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ចូលបញ្ជី</td>
                                        <td colspan=2>
                                            <select name="selcustomergold2" id="selcustomergold2" class="form-select kh16-b" style="background-color:#d9ee64;">
                                                @foreach ($partners->where('is_gold_list',1) as $item)
                                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ទឹកប្រាក់ត្រូវទូទាត់</td>
                                        <td style="">
                                            <input type="text" name="txtdebt2" id="txtdebt2" class="form-control canenter kh16-b" style="text-align:right;" autocomplete="off" readonly>
                                        </td>
                                        <td style="width:100px;">
                                            <select name="selcur2" id="selcur2" class="form-select kh16-b" style="width:100px;font-weight:bold;">

                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" lomeang="{{ $c->lomeang }}" isgold="{{ $c->isgold }}" tuochek="{{ $c->tuochek }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ទូទាត់ចំនួន</td>
                                        <td style="">
                                            <input type="text" name="txtdeposit2" id="txtdeposit2" class="form-control canenter kh16-b" style="text-align:right;" autocomplete="off">
                                        </td>
                                        <td style="width:100px;">
                                            <input type="text" value="USD" style="width:100px;" class="form-control kh16-b" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>សមតុល្យ</td>
                                        <td style="">
                                            <input type="text" name="txtbalance2" id="txtbalance2" class="form-control canenter kh16-b" style="text-align:right;" autocomplete="off" readonly>
                                        </td>
                                        <td style="width:100px;">
                                            <input type="text" value="USD" style="width:100px;" class="form-control kh16-b" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>ទូទាត់តាម</td>
                                        <td colspan=2>
                                            <select name="selbankdeposit2" id="selbankdeposit2" class="form-select kh16-b">
                                                <option value="" customertype="">Cash</option>
                                                @foreach ($partners->where('customertype','BANK') as $item)
                                                    <option value="{{$item->id}}" customertype="{{$item->customertype}}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                        <tr>
                                        <td>ចំនួនទូទាត់</td>
                                        <td style="">
                                            <input type="text" name="txtdeposit12" id="txtdeposit12" class="form-control canenter kh16-b" style="text-align:right;" autocomplete="off">
                                        </td>
                                        <td style="width:100px;">
                                            <select name="selcurdeposit12" id="selcurdeposit12" class="form-select kh16-b" style="width:100px;font-weight:bold;">

                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" lomeang="{{ $c->lomeang }}" isgold="{{ $c->isgold }}" tuochek="{{ $c->tuochek }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ឈ្មោះអតិថិជន</td>
                                        <td colspan=2>
                                            <input type="text" class="form-control canenter kh16-b" id="client_name2" name="client_name2" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>លេខទូរស័ព្ទ</td>
                                        <td colspan=2>
                                            <input type="text" class="form-control canenter kh16-b" id="client_tel2" name="client_tel2" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=3 style="text-align:right;">
                                            <button id="btnsavedeposit2" class="buttonstyle kh14-b">រក្សាទុក</button>
                                            <button id="btnsavedepositprint2" class="buttonstyle kh14-b">រក្សាទុកព្រីន</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/admin') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('public/admin') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $('#h1_title').text('របាយការណ៏កក់មាស');
        resizefixhead(170);
        $(window).resize(function() {
           resizefixhead(170);
        });

        function resizefixhead(h)
        {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-h;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
        }

        $(document).ready(function () {
            var cleave_txtdeposit = new Cleave('#txtdeposit', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave_txtdeposit1 = new Cleave('#txtdeposit1', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var today=new Date();
            $('#d1,#d2,#deposit_date,#deposit_date2').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            hilightrow_thesamegroup();
            function hilightrow_thesamegroup(){
                let colors = ["#ffe5e5", "#e5ffe5", "#e5e5ff", "#fff5cc", "#f0e5ff", "#e5f7ff"];
                let groupCounts = {};
                let groupColorMap = {};
                let colorIndex = 0;
                // 1️⃣ Count group occurrences
                $("#tblexchangelist tbody tr").each(function(){
                    let groupId = $(this).find("td:nth-child(19)").text().trim();
                    groupCounts[groupId] = (groupCounts[groupId] || 0) + 1;
                });

                // 2️⃣ Apply highlight only to groups appearing more than once
                $("#tblexchangelist tbody tr").each(function(){
                    let groupId = $(this).find("td:nth-child(19)").text().trim();

                    if(groupCounts[groupId] > 1) {
                        // Assign color if not mapped yet
                        if(!groupColorMap[groupId]){
                            groupColorMap[groupId] = colors[colorIndex % colors.length];
                            colorIndex++;
                        }
                        $(this).css("background-color", groupColorMap[groupId]);
                    } else {
                        $(this).css("background-color", ""); // No highlight
                    }
                });
            }

            function getUserPermissions(userId) {
                const permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
                return permusers
                    .filter(item => item.userid == userId)
                    .map(item => item.code);
            }
            var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
            const userId = "{{ Auth::id() }}";
            const userPerms = new Set(getUserPermissions(userId));
            if (!isAdmin)
            {
                $('#d1').datetimepicker("destroy");
                $('#d2').datetimepicker("destroy");
                $('#seluser').attr('disabled',true);
                $('#seluser').val($('#txtuserid').val());
                if (!userPerms.has('3.1.3')) {
                    $('.btndel').hide();
                }
                if (!userPerms.has('3.1.4')) {
                    $('.btnprint').hide();
                }
            }
            $('.ck_all').click(function(){
                if (this.checked) {
                    $(".cknum").prop("checked", true);
                } else {
                    $(".cknum").prop("checked", false);
                }
            });
            function makeModalDraggable(modalId) {
                const modal = document.getElementById(modalId);
                const dialog = modal.querySelector('.modal-dialog');
                const header = modal.querySelector('.modal-header');

                let offsetX = 0;
                let offsetY = 0;
                let isDragging = false;

                header.style.cursor = "move";

                header.addEventListener('mousedown', function (e) {

                    isDragging = true;

                    const rect = dialog.getBoundingClientRect();
                    offsetX = e.clientX - rect.left;
                    offsetY = e.clientY - rect.top;

                    // Prevent Bootstrap auto-resize / auto-center
                    dialog.classList.remove("modal-dialog-centered");
                    dialog.style.position = "absolute";
                    dialog.style.margin = 0;

                    // ✨ THE FIX — lock modal current size
                    dialog.style.width = rect.width + "px";
                    dialog.style.maxWidth = "none";
                    dialog.style.transform = "none";

                    document.body.style.userSelect = "none";
                });

                document.addEventListener('mousemove', function (e) {
                    if (!isDragging) return;
                    dialog.style.left = (e.clientX - offsetX) + "px";
                    dialog.style.top = (e.clientY - offsetY) + "px";
                });

                document.addEventListener('mouseup', function () {
                    isDragging = false;
                    document.body.style.userSelect = "auto";
                });
            }

            // Enable draggable modal when shown
            document.getElementById('modalSummary').addEventListener('shown.bs.modal', function () {
                makeModalDraggable('modalSummary');
            });

            document.getElementById('btnkatkong').addEventListener('click', function () {
                let selectedRows = [];
                let total_product = 0;
                let total_gold = 0;
                let total_amount = 0;
                let total_sumamount = 0;
                let total_deposit = 0;
                let total_balance = 0;
                let client='';
                let phone='';
                document.querySelectorAll('.cknum:checked').forEach(function (ck) {

                    let tr = ck.closest('tr');
                    let tds = tr.querySelectorAll('td');

                    // Extract values - match by your column index
                    client = tds[2].innerText.trim();
                    phone = tds[3].innerText.trim();
                    let product = parseFloat((tds[7].innerText).replace(/,/g,'')) || 0;
                    let gold = parseFloat((tds[9].innerText).replace(/,/g,'')) || 0;
                    let amount = parseFloat((tds[11].innerText).replace(/,/g,'')) || 0;
                    let sumamount = parseFloat((tds[12].innerText).replace(/,/g,'')) || 0;
                    let deposit = parseFloat((tds[13].innerText).replace(/,/g,'')) || 0;
                    let balance = parseFloat((tds[14].innerText).replace(/,/g,'')) || 0;

                    selectedRows.push({
                        client, phone, product, gold, amount, sumamount, deposit, balance
                    });

                    // Calculate totals
                    total_product += product;
                    total_gold += gold;
                    total_amount += amount;
                    total_sumamount += sumamount;
                    total_deposit += deposit;
                    total_balance += balance;
                });

                // ================================
                // SHOW IN MODAL
                // ================================
                let html = "<table class='table table-bordered table-hover kh16-b tbl_modal'>";
                html += "<thead style='text-align:center;background-color:grey;color:white;'><tr><th>Client</th><th>Phone</th><th>Total</th><th>Deposit</th><th>Balance</th></tr></thead>";
                html += "<tbody>";

                selectedRows.forEach(r => {
                    html += `
                        <tr>
                            <td>${r.client}</td>
                            <td>${r.phone}</td>
                            <td style="text-align:right">${r.sumamount.toLocaleString()}</td>
                            <td style="text-align:right">${r.deposit.toLocaleString()}</td>
                            <td style="text-align:right">${r.balance.toLocaleString()}</td>
                        </tr>
                    `;
                });

                html += `
                    <tr style="background:yellow;font-weight:bold;">
                        <td colspan="2" style="text-align:center">TOTAL</td>
                        <td style="text-align:right">${total_sumamount.toLocaleString()}</td>
                        <td style="text-align:right">${total_deposit.toLocaleString()}</td>
                        <td style="text-align:right">${total_balance.toLocaleString()}</td>
                    </tr>
                `;

                html += "</tbody></table>";

                document.getElementById("modal_summary_body").innerHTML = html;
                $('#client_name2').val(client);
                $('#client_tel2').val(phone);

                // show modal
                let modal = new bootstrap.Modal(document.getElementById('modalSummary'));
                modal.show();

            });

             // Remove previous highlight class
             $(document).on('click','.tblexchangelist td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
             $(document).on('click','.tbl_modal td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.tbl_mainlist td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.item',function(e){
                e.preventDefault();
                var rowind=$(this).closest('tr').index();
                var row=$(this).closest('tr');
                var curname=row.find("td:eq(1)").text();
                $('#btnsearch').attr('title',curname);
                searchtblexchangelist(curname);

            })
            $(document).on('change','#txtdeposit',function(e){
                e.preventDefault();

                let dep=$(this).val().replace(/,/g,'');
                let debt=$('#txtdebt').val().replace(/,/g,'');
                let bal=parseFloat(debt)-parseFloat(dep);
                $('#txtbalance').val(formatNumber(bal));
                $('#txtdeposit1').val(formatNumber(dep));
            })
             $(document).on('keydown', '.canenter', function (e) {
                 if (e.keyCode == 13) {
                    var id = $(this).attr("id");
                    if (id=='txtdeposit'){
                        $('#txtdeposit1').focus();
                    }else if (id=='txtdeposit1'){
                        $('#btnsavedeposit').focus();
                    }
                    e.preventDefault();
                 }
             })
             $(document).on('click','#btnsavedeposit,#btnsavedepositprint',function(e){
                e.preventDefault();

                var btnid=$(this).attr('id');
                let deposit = parseFloat($('#txtdeposit').val().replace(/,/g, '')) || 0;
                let depositBank = parseFloat($('#txtdeposit1').val().replace(/,/g, '')) || 0;
                let payvia = $('#selbankdeposit').val();

                if (deposit < 0 || depositBank < 0) {
                    alert('Invalid deposit amount.');
                    return;
                }

                if (payvia == '') {
                    bank_amount=0;
                    cash_amount=deposit;
                    if (deposit !== depositBank) {
                        alert('Deposit amount must match exactly for cash payment.');
                        return;
                    }
                } else {
                    bank_amount=depositBank;
                    cash_amount=deposit - depositBank;
                    if (deposit < depositBank) {
                        alert('Bank deposit amount cannot be greater than customer deposit.');
                        return;
                    }
                }
                $('body').addClass("wait");
                customertype = $('#selbankdeposit').find(':selected').attr('customertype');

                var formdata=new FormData(frmgolddeposit);
                formdata.append("customertype_deposit",customertype);
                formdata.append("bank_amount",bank_amount);
                formdata.append("cash_amount",cash_amount);
                formdata.append('deposit_via',$('#selbankdeposit option:selected').text());
                var url="{{ route('exchange.savedepositgold') }}";
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    complete: function () {

                    },
                    success: function (data) {
                        console.log(data)
                        if($.isEmptyObject(data.error)){
                            toastr.success("Saved");
                            if(btnid=='btnsavedepositprint'){
                              prints($('#txtex_id').val(),$('#txtex_group').val(),0);
                          }
                            $('#depositgold_modal').modal('hide');
                            $('body').removeClass("wait");
                            getexchangelist();

                        }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                        }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Save Error.')
                    }

                })

             })
            function prints(ex_id,group_id,reprint){
                var redirectWindow = window.open('{{ url('/') }}'+'/exchangegold/prints?ex_id='+ex_id+'&group_id='+group_id+'&reprint='+reprint, '_blank');
                redirectWindow.location;
            }
            $(document).on('click','.btnpayment',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var groupid=$(this).data('groupid');
                var balance=$(this).data('balance');
                var client=$(this).data('client');
                var phone=$(this).data('phone');
                var examount=$(this).data('examount');

                $('#txtex_id').val(id);
                $('#txtex_group').val(groupid);
                $('#client_name').val(client);
                $('#client_tel').val(phone);
                $('#txtdeposit').val('');
                $('#txtdeposit1').val('');

                $('#txtdebt').val(formatNumber(Math.abs(balance)));
                $('#txtbalance').val(formatNumber(Math.abs(balance)));
                $('#depositgold_modal').modal('show');
                $('#examount').val(examount);

            })
            // ✅ Focus after modal fully visible
            $('#depositgold_modal').on('shown.bs.modal', function () {
                $('#txtdeposit').trigger('focus');
            });
            $('#btnprintreport').click(function(e){
                e.preventDefault();
                var userid=$('#seluser').val();
                var username=$('#seluser option:selected').text();
                var status=$('#selstatus').val();
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var redirectWindow = window.open('{{ url('/') }}'+'/getexchangelist?userid='+userid+'&d1='+d1+'&d2='+d2+'&status='+status+'&location='+2+'&isprint='+1+'&username='+username, '_blank');
                redirectWindow.location;
            })
            $('#btnsearch').click(function(e){
                e.preventDefault();
                getexchangelist();
            })

            $(document).on('change','#seluser,#selstatus',function(e){
                e.preventDefault();
                getexchangelist();
            })


            $(document).on('click','.btndel',function(e){
                e.preventDefault();
                //debugger
                //var rowind=$(this).closest('tr').index();
                Swal.fire({
                    title: 'Are you sure to remove this exchange?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var mapid=$(this).data('id');

                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('deleteexchange') }}",
                            data: { id: mapid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //document.getElementById("tblexchangelist").deleteRow(rowind);
                                    getexchangelist();
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    'Delete Error.',
                                    'Error'
                                )
                            }

                        })

                    }
                })
            })

            function getexchangelist()
            {
                $('body').addClass("wait");
                var userid=$('#seluser').val();
                var status=$('#selstatus').val();
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var url="{{ route('getexchangelistgold') }}";

                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {userid:userid,d1:d1,d2:d2,status:status},
                    complete: function () {},
                    success: function (data) {
                        console.log(data)
                        $('#row_display').empty().html(data);

                         resizefixhead(170);
                        hilightrow_thesamegroup();
                        $('body').removeClass("wait");
                        if (!isAdmin)
                        {

                            if (!userPerms.has('3.1.3')) {
                                $('.btndel').hide();
                            }
                            if (!userPerms.has('3.1.4')) {
                                $('.btnprint').hide();
                            }
                        }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            }

        })//end document
        function searchtblexchangelist() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tblexchangelist");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    } else {
                    tr[i].style.display = "none";
                    }
                }
            }
            // ✅ Renumber visible rows
            // var visibleIndex = 1;
            // for (i = 0; i < tr.length; i++) {
            //     if (tr[i].style.display !== "none") {
            //         var tdNo = tr[i].getElementsByTagName("td")[0];
            //         if (tdNo) {
            //             tdNo.textContent = visibleIndex++;
            //         }
            //     }
            // }
        }



    </script>

@endsection
