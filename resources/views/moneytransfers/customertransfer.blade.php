@extends('master')
@section('title') Customer Transfer @endsection
@section('css')
    <style type="text/css">
        body.wait *{
			cursor: wait !important;
		}
    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;}

    #selpartner2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-selpartner2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;}

    #sel_customer_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_customer_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;}

    #sel_province_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_province_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;}

    #sel_district_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_district_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;}

    .bankid + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 40px !important;
            background-color:white;
        }
        .select2-selection__arrow {
            height: 34px !important;
        }
        .en12{
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            }
        .en12-b{
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            font-weight:bold;
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
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            font-weight:bold;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
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
        .btnbg{
            background-color:rgb(206, 241, 124);
        }
       .txtexchange{
        padding:2px;
        /* font-weight:bold; */
        font-size:22px;
        text-align:right;
       }
       .txtexchangefix{
        padding:2px;
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
      #tbl_amount td{
        padding:2px;
        border-style:none;
       }
       #tbl_partner td{
        padding:2px;
        border-style:none;
       }
       #tbl_exchange td{
        padding:2px;
        border-style:none;
       }
       #tbl_continue_partner td{
        padding:2px;
        border-style:none;
       }
       #tbl_child td{
        border-style:none;
       }

       #tbl_checkamt .clickedrow td{
        background-color: #caaf8f;
       }

       #divfooter{
        /* margin:0px; */
        color:white;
        padding:0px 20px 0px 0px;
        position: fixed;
        bottom: 0;
        width: 84.5%;
        min-height: 98px;
        max-height: 98px;
        /* background-color: inherit; */
        background-color:rgb(201, 214, 218);
        color: white;
        height : 98px;
        overflow:auto;
        clear: both;
        }
        .tableFixHead{ overflow: auto;background-color:white;}
        .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tbl_transferlist td{
          word-wrap: break-word;
          padding:2px 5px 2px 5px;
        }
        .tableFixHead1{ overflow: auto;height:260px;background-color:white;}
        .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tbl_checkamt td{
          word-wrap: break-word;
          padding:2px 5px 2px 5px;
        }
        .tbl_transferlist .clickedrow td{
            background-color: pink;
        }
        .tbl_transferlist .clickedrow input{
            background-color: pink;
        }
        .tbl_transferlist th{
            padding:0px;
        }
        .mybtn{
            border:1px solid black;
            padding:5px 10px;
        }
        .mybtn:hover{
            background-color:aquamarine;
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
    <div class="row" style="margin-bottom:10px;margin-top:-20px;">
        <div class="col-lg-6">
            <table>
                <tr>
                    <td style="border-style:none;">
                        @if (Auth::user()->role->name<>'Admin')

                                <button class="mybtn btnclick kh16-b" id="btntransfer" style="color:blue;">ដាក់ប្រាក់</button>

                                <button class="mybtn btnclick  kh16-b" id="btnreceive" style="color:red;">ដកប្រាក់</button>

                            <div class="dropdown" style="display:inline">
                              <button type="button" class="btn dropdown-toggle kh16-b" style="background-color:green;" data-bs-toggle="dropdown">
                                ផ្សេងៗ
                              </button>
                              <ul class="dropdown-menu">
                                @if (Auth::user()->role->name<>'Admin')
                                  @if (App\User::checkpermission(Auth::id(),'3.1.6'))
                                    <li><a class="dropdown-item kh16-b btnchangedate" href="#">ផ្លាស់ប្តូរថ្ងៃទី</a></li>
                                  @endif
                                @else
                                  <li><a class="dropdown-item kh16-b btnchangedate" href="#">ផ្លាស់ប្តូរថ្ងៃទី</a></li>
                                @endif
                              </ul>
                            </div>
                        @else
                            <button class="mybtn btnclick kh16-b" id="btntransfer" style="color:blue;">ដាក់ប្រាក់</button>
                            <button class="mybtn btnclick kh16-b" id="btnreceive" style="color:red;">ដកប្រាក់</button>

                            {{-- <button class="btn btn-default kh22-b" id="btnchangedate">ផ្លាស់ប្តូរថ្ងៃទី</button> --}}
                            <div class="dropdown" style="display:inline">
                                <button type="button" class="mybtn dropdown-toggle kh16-b" data-bs-toggle="dropdown">
                                  ផ្សេងៗ
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item kh16-b btnchangedate" href="#">ផ្លាស់ប្តូរថ្ងៃទី</a></li>
                                </ul>
                            </div>
                        @endif
                    </td>

                </tr>
            </table>
        </div>
        <div class="col-lg-6">
          <table class="table">
            <tr>
              <td style="text-align:right;border-style:none;">
                <select name="filteruser" id="filteruser" style="height:30px;" class="kh16-b">
                    <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary btn-md kh16-b"  id="btnrefresh">Refresh Data</button>
              </td>
            </tr>
          </table>
        </div>
    </div>

    <form id="frmtransfer" action="">
        <div class="row" style="margin-top:-20px;">
            <div class="col-lg-6">

                <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                <input type="hidden" id="trancode" name="trancode" title="trancode">
                <input type="hidden" id="mekun" name="mekun" title="mekun">
                <input type="hidden" id="id1" name="id1" title="id1">
                <input type="hidden" id="id2" name="id2" title="id2">
                <input type="hidden" id="cashdrawid" name="cashdrawid" title="idcashdraw">

                <div class="row">
                  <div class="card" style="background-color:inherit;">
                      <div id="cardpartner"  class="card-header" style="text-align:center;background-color:black;height:40px;">
                        <table class="table" style="margin:0px;">
                            <tr >
                                <td style="border-style:none;padding:0px;width:100px;">
                                    <div id="divcklockdata" class="form-check">
                                        <label class="form-check-label kh16-b" style="color:white;">
                                          <input class="form-check-input kh16-b" type="checkbox" id="cklockdata" name="cklockdata" style=""> ចងចាំទិន្ន័យ
                                        </label>
                                      </div>

                                </td>
                                <td style="border-style:none;padding:0px;text-align:center;">
                                  <h1 id="tranname" class="kh18-b" style="display:inline;color:white;"></h1>
                                </td>
                                <td style="width:100px;border-style:none;">

                                </td>
                            </tr>
                        </table>
                      </div>
                      <div class="card-body" style="padding:0px;">
                          <table id="tbl_partner" class="table" style="table-layout:fixed;padding:0px;">
                                <tr>
                                    <td style="width:130px;">
                                        <label for="date" class="kh18" style="width:120px;">កាលបរិច្ឆេទ</label>
                                    </td>
                                    <td>
                                        <input type="text" name="invdate" id="invdate" class="form-control kh16-b" style="background-color:white;height:40px;" readonly>
                                    </td>
                                    <td style="width:40px;">
                                        <span class="input-group-text" style="width:40px;height:40px;"><i class="fa fa-calendar"></i></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16-b" style="">ចំនួនទឹកប្រាក់</td>
                                    <td colspan=2>
                                        <div class="input-group ">
                                            <span class="input-group-text kh16-b" id="amtsign" style="width:40px;"></span>
                                            <input type="text" class="form-control kh16-b canenter" id="amount" name="amount" style="text-align:right;height:40px;border:2px solid green;" autocomplete="off" readonly>
                                            <select name="selcur" id="selcur" class="input-group kh16-b" style="width:80px;height:40px;padding-top:7px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:130px;"><label for="selpartner" class="kh18" style="">អតិថិជន</label></td>
                                    <td colspan=2>
                                        <select class="form-select select2-option kh16" name="selpartner" id="selpartner" style="width:100%">
                                            <option value=""></option>
                                                @foreach ($customers as $p)
                                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                                @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr style="background-color:aliceblue;">
                                    <td class="kh16-b">សមតុល្យ</td>
                                    <td style="padding:0px;" colspan=2>
                                        <input type="text" id="balance1" class="form-control kh16-b" style="border-style:none;background-color:aliceblue;text-align:right;color:red;width:49%;display:inline;">
                                        <input type="text" id="balancenext1" class="form-control kh16-b" style="border-style:none;background-color:aliceblue;text-align:right;color:blue;width:50%;display:inline;">
                                    </td>

                                </tr>
                                <tr>
                                    <td class="kh16-b">បុគ្គលិកពាក់ព័ន្ធ</td>
                                    <td colspan=2>
                                        <select class="kh16-b" name="seluseraffect" id="seluseraffect" style="width:100%;height:35px;background-color:rgb(247, 243, 39);color:black;">
                                            <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}></option>
                                            @foreach ($users as $u)
                                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:130px;"><label id="lblpayby" for="selpartner2" class="kh18" style="">ទូទាត់តាម</label></td>
                                    <td colspan=2>
                                        <select class="form-select select2-option kh16" name="selpartner2" id="selpartner2" style="width:100%">
                                            <option value="">Cash</option>

                                            <optgroup label="ធនាគា">
                                                @foreach ($banks->where('customertype','BANK') as $p)
                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="ភ្នាក់ងារ">
                                                @foreach ($banks->where('customertype','AGENT') as $p)
                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                                @endforeach
                                            </optgroup>

                                        </select>
                                    </td>
                                </tr>
                                <tr style="background-color:aliceblue;">
                                    <td class="kh16-b">សមតុល្យ</td>
                                    <td style="padding:0px;" colspan=2>
                                        <input type="text" id="balance2" class="form-control kh16-b" style="border-style:none;background-color:aliceblue;text-align:right;color:red;width:49%;display:inline;">
                                        <input type="text" id="balancenext2" class="form-control kh16-b" style="border-style:none;background-color:aliceblue;text-align:right;color:blue;width:50%;display:inline;">
                                    </td>

                                </tr>


                               <tr>
                                    <td class="kh16-b">ផ្សេងៗ</td>
                                    <td colspan=2>
                                        <textarea name="note" id="note" cols="" rows="5" style="width:100%;" placeholder="note"></textarea>
                                    </td>
                               </tr>
                               <tr>
                                    <td>
                                        <button id="btnnew" class="mybtn kh16-b">សំអាតថ្មី</button>

                                    </td>
                                    <td colspan=2 style="text-align:right;">
                                        <button id="btndelete" class="mybtn kh16-b" style="width:100px;display:none;color:red;" >លុប</button>
                                        <button id="btnsavetransfer" class="mybtn kh16-b" style="width:120px;" disabled>រក្សាទុក</button>
                                    </td>

                               </tr>

                          </table>
                      </div>
                  </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="row">
                  <div id="divgettransaction" style="margin-bottom:0px;">
                    <div class="card" style="">
                        <div class="card-header" style="height:40px;background-color:rgb(210, 150, 76)">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="kh18-b">តារាងផ្ទេរប្រាក់រួចរាល់</h3>
                                </div>
                                <div class="col-lg-6">
                                    {{-- <span style="float:right;font-size:16px;margin-left:20px;margin-top:-5px;"><button id="btnclosedivtransferlist" class="btn btn-danger btn-sm">X</button></span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding:0px;margin:0px;">
                          <div class="tableFixHead">
                            <table id="tbl_transferlist" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                                <thead style="text-align:center;" class="kh16">
                                    <th style="width:70px;">No</th>
                                    <th style="width:100px;">ម៉ោង</th>
                                    <th style="width:280px;">ដៃគូពាក់ព័ន្ធ</th>
                                    <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                                    <th style="width:200px;">លេខអ្នកទទួល</th>
                                    <th style="width:200px;">ឈ្មោះអ្នកទទួល</th>
                                    <th style="width:200px;">លេខអ្នកផ្ញើ</th>
                                    <th style="width:200px;">ឈ្មោះអ្នកផ្ញើ</th>
                                    <th style="width:100px;">សេវ៉ាវេរ</th>
                                    <th style="width:100px;">សេវ៉ាដៃគូ</th>
                                    <th style="width:130px;">ពាក់ព័ន្ធបុគ្គលិក</th>
                                    <th style="width:130px;">អ្នកកត់ត្រា</th>
                                    <th style="width:300px;">ផ្សេងៗ</th>

                                </thead>
                                <tbody id="body_transaction">
                                    @foreach ($transfers as $k => $tr)
                                        <tr>
                                            <td style="text-align:center;padding:0px;" class="kh12">
                                            {{-- <input style="width:60px;text-align:center;" type="button" readonly value="{{ ++$k }}"> --}}
                                            <div class="dropdown">
                                                <button style="width:70px;" type="button" class="btn btn-primary dropdown-toggle kh12" data-bs-toggle="dropdown">
                                                    {{ ++$k }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $tr->id }}">Print</a></li>
                                                    @if(str_contains($tr->action,'u'))
                                                        {{-- <li><a href="{{ route('usercapital.updatetransactiongroup',['id'=>$tr->id,'ref_group_id'=>$tr->ref_group_id,'user_id'=>$tr->user_id]) }}" class="dropdown-item kh16-b btnupdate" target="_blank">Update</a></li> --}}
                                                        @if (Auth::user()->role->name<>'Admin')
                                                            @if ($tr->sentby==$tr->user->name)
                                                                <li><a href="#" class="dropdown-item kh16-b btnedit" data-id="{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}">Edit</a></li>
                                                            @endif
                                                        @else
                                                            <li><a href="#" class="dropdown-item kh16-b btnedit" data-id="{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}">Edit</a></li>
                                                        @endif
                                                    @endif
                                                    @if(!$tr->ref_group_id)
                                                        @if(str_contains($tr->action,'d'))
                                                            @if (Auth::user()->role->name<>'Admin')
                                                                @if ($tr->sentby==$tr->user->name)
                                                                    <li><a class="dropdown-item kh16-b btndeltransfer" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}">Delete by ID</a></li>
                                                                @endif
                                                            @else
                                                                <li><a class="dropdown-item kh16-b btndeltransfer" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}">Delete by ID</a></li>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <li><a href="{{ route('usercapital.showrefgroupid',['group_id'=>$tr->ref_group_id]) }}" class="dropdown-item kh16-b" target="_blank" style="">Delete by Group</a></li>
                                                    @endif

                                                </ul>
                                            </div>
                                            </td>
                                            <td class="kh16" style="padding:0px;">
                                            <input type="text" style="border-style:none;width:100px;text-align:center;background-color:inherit;" readonly value="{{ $tr->tt }}">
                                            </td>

                                            <td class="kh16">{{ $tr->partner->name . ' ' . $tr->tranname }}</td>
                                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amount) .$tr->currency->sk }}</td>
                                            <td class="kh16" style="text-align:right;">{{ $tr->rectel }}</td>
                                            <td class="kh16">{{ $tr->recname }}</td>
                                            <td class="kh16" style="text-align:right;">{{ $tr->sendertel }}</td>
                                            <td class="kh16">{{ $tr->sendername }}</td>
                                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->cuscharge) .$tr->cuschargecur->sk }}</td>
                                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->fee) .$tr->feecurrency->sk }}</td>
                                            <td class="kh16">{{ $tr->user->name }}</td>
                                            <td class="kh16">{{ $tr->sentby }}</td>
                                            <td class="kh16">{{ $tr->note }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

    </form>

@endsection
@section('script')
    @include('moneytransfers.transferscript3')


@endsection
