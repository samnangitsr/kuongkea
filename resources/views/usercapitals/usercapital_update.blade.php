@extends('master')
@section('title') user capital update @endsection
@section('css')
    <style type="text/css">
         #selbank + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;background-color:whitesmoke;}
		/* Each result */
		#select2-selbank-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white}
		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 47px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
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
       .cgr{
        background-color:aquamarine;
       }
       .hiddenrow{
        display:none;
       }
    .tbl_capital .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_capital .clickedrow td input{
        background-color: #caaf8f;
    }
    #divfooter{

    color:white;
    margin: auto;
    margin-left:-20px;
    margin-right:0px;
    padding-bottom:0px;
    position: fixed;
    bottom: 40px;
    max-width: 85%;
    /* min-height: 125px;
    max-height: 125px; */
    /* background-color: rgb(195, 201, 206); */
    color: white;
    max-height : 200px;
    overflow:auto;
    clear: both;
    }
    td{
        border-style:none;
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
    <div class="row" style="@if($record1->trancode==2 || $record1->trancode==-2) @else display:none; @endif">
        <div class="card">
          <div class="card-header">
            <h1 class="kh22">@if($record1->trancode==2) កែប្រែដើមទុនបុគ្គលិក @else កែប្រែលុយដកចុងគ្រាបុគ្គលិក @endif</h1>
          </div>
          <div class="card-body">
              <form action="" id="frmusercapital">
                <input type="hidden" id="trmode" name="trmode" value="{{ $record1->trancode }}">
                <input type="hidden" id="tranname" name="tranname" value="{{ $record1->tranname }}">
                <input type="hidden" id="trid" name="trid" value="{{ $record1->id }}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table kh22" id="tbl_addusercapital">
                                    <tr>
                                        <td>ថ្ងៃទី</td>
                                        <td>
                                            <div class="input-group" style="width:280px;">
                                                <input type="text" name="trandate" id="trandate" class="form-control" style="width:200px;height:45px;background-color:rgb(239, 229, 229);font-size:22px;" value="{{ date('d-m-Y',strtotime($record1->trandate)) }}" readonly>
                                                <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>

                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="trantime" id="trantime" class="form-control kh22" style="display:inline" value="{{ $record1->trantime }}" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span id="tdreceiver">អ្នកទទួលប្រាក់</span>
                                        </td>
                                        <td colspan=2>
                                            <select class="form-select" name="seluserreceive" id="seluserreceive" style="width:100%;height:45px;font-size:22px;">

                                                <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}></option>
                                                @foreach ($users as $u)
                                                    <option value="{{ $u->id }}" {{ $record1->user_id_affect==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ចំនួនទឹកប្រាក់</td>
                                        <td>
                                            <input type="text" class="form-control kh22" name="amount" id="amount" style="height:45px;text-align:right;" value="{{ phpformatnumber(abs($record1->amount)) }}">
                                        </td>
                                        <td>
                                            <select class="form-select kh22" name="selcur" id="selcur" style="height:45px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $cur)
                                                    <option value="{{ $cur->id }}" {{ $cur->id==$record1->currency_id?'selected':'' }}>{{ $cur->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>បរិយាយ</td>
                                        <td colspan=2>
                                            <textarea class="form-control kh22" rows="5" id="note" name="note" value="{{ $record1->note1 }}"></textarea>
                                        </td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </form>
          </div>
          <div class="card-footer">
            <button type="button" id="btnclose1" style="float:right;margin-left:25px;" class="btn btn-danger kh22">Close</button>
            <button class="btn btn-info kh22" style="float:right;" id="btnsavecapital">Update</button>
          </div>
        </div>
    </div>
    <div class="row" style="@if($record1->trancode==1 || $record1->trancode==-1) @else display:none; @endif">
      <div class="card" style="@if($record2_istransfer==1) @else display:none; @endif">
        <div class="card-header">
            <h1 class="kh22">កែប្រែដាក់ដកបុគ្គលិក</h1>
        </div>
        <div class="card-body">
            <form action="" id="frmusercashinout">
              <input type="hidden" id="mode" name="mode" value="@if($record2_istransfer==1) 2 @else 1 @endif" >
              <input type="hidden" id="id1" name="id1" value="{{ $record1->id??'' }}">
              <input type="hidden" id="id2" name="id2" value="{{ $record2->id??'' }}">

              <div class="container">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table kh22">
                                  <tr>
                                      <td colspan=2 style="text-align:center;">
                                          <input class="form-check-input" style="margin-top:10px;font-size:16px;" type="radio" name="radinout" id="radcashin" value="1" @if($record1->trancode==1) checked @endif>
                                          <label class="form-check-label kh22" for="radcashin">លុយដាក់ចូល</label>
                                      </td>
                                      <td>
                                        <input class="form-check-input" style="margin-top:10px;font-size:16px;" type="radio" name="radinout" id="radcashout" value="-1" @if($record1->trancode==-1) checked @endif>
                                        <label style="color:red;" class="form-check-label kh22" for="radcashout">លុយដកចេញ</label>
                                      </td>

                                  </tr>
                                  <tr>
                                      <td>ថ្ងៃទី</td>
                                      <td></td>
                                      <td style="width:280px;">
                                          <div class="input-group" style="width:280px;">
                                              <input type="text" name="trandate1" id="trandate1" class="form-control" style="width:200px;height:45px;background-color:silver;font-size:22px;" value="{{ date('d-m-Y',strtotime($record1->trandate)) }}" readonly>
                                              <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                                          </div>
                                      </td>
                                      <td>
                                        <input type="text" name="trantime1" id="trantime1" class="form-control kh22" style="" value="{{ $record1->trantime }}" readonly>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td id="user1">@if($record1->trancode==1) ដាក់ចូល @else ដកចេញ @endif</td>
                                      <td style="width:60px;">
                                          <input type="text" class="form-control kh22" name="sign2" id="sign2" style="height:45px;text-align:center;width:60px;" value="@if($record1->trancode==1)+@else-@endif" readonly>
                                      </td>
                                      <td colspan=2>
                                          <select class="form-select kh22" name="seluser1" id="seluser1" style="width:100%;height:45px;@if($record1->trancode==1) background-color:blue; @else background-color:red; @endif color:white;">

                                              {{-- @foreach ($users as $u)
                                                  <option value="{{ $u->id }}" @if($u->id==Auth::id()) selected @endif>{{ $u->name }}</option>
                                              @endforeach --}}

                                              <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}></option>
                                              @foreach ($users as $u)
                                                  <option value="{{ $u->id }}" {{ $record1->user_id_affect==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                              @endforeach
                                          </select>
                                      </td>
                                  </tr>

                                  <tr class="truser @if($record2_istransfer==1) hiddenrow @endif">
                                          <td id="user2">@if($record1->trancode==1)ដកចេញ@else ដាក់ចូល @endif</td>
                                          <td style="width:60px;">
                                              <input type="text" class="form-control kh22" name="sign3" id="sign3" style="height:45px;text-align:center;width:60px;" value="@if($record1->trancode==1)-@else+@endif" readonly>
                                          </td>
                                          <td colspan=2>
                                              <select class="form-select kh22" name="seluser2" id="seluser2" style="width:100%;height:45px;@if($record1->trancode==1) background-color:red; @else background-color:blue; @endif;color:white;">
                                                  <option value="">please select user name</option>
                                                  @foreach ($users as $u)
                                                      <option value="{{ $u->id }}" @if($record2) {{ $record2->user_id_affect==$u->id?'selected':'' }} @endif>{{ $u->name }}</option>
                                                  @endforeach
                                              </select>
                                          </td>
                                  </tr>
                                  <tr class="trbank @if($record2_istransfer==0) hiddenrow @endif">

                                          <td>
                                            <select name="seltype" id="seltype" class="form-select kh22">
                                                  <option value="BANK" @if($record2->partner->customertype=='BANK') selected @endif>Bank</option>
                                                  <option value="PARTNER" @if($record2->partner->customertype=='PARTNER') selected @endif>Partner</option>
                                                  <option value="AGENT" @if($record2->partner->customertype=='AGENT') selected @endif>Agent</option>
                                                  <option value="NOLIST" @if($record2->partner->customertype=='NOLIST') selected @endif>No List</option>

                                                  @if(Auth::user()->role->name=='Admin')
                                                    <option value="CUSTOMER">Customer</option>
                                                  @endif
                                            </select>
                                          </td>
                                          <td style="width:60px;">
                                              <input type="text" class="form-control kh22" name="sign4" id="sign4" style="height:45px;text-align:center;width:60px;" value="@if($record1->trancode==1)-@else+@endif" readonly>
                                          </td>
                                          <td colspan=2>
                                              <select class="form-select kh22" name="selbank" id="selbank" style="width:100%;height:45px;">
                                                  <option value=""></option>
                                                  @if($record2->partner->customertype=='BANK')
                                                    @foreach ($banks->where('customertype','BANK') as $b)
                                                        <option value="{{ $b->id }}" @if($record2) {{ $record2->parrent_id==$b->id?'selected':'' }} @endif>{{ $b->name }}</option>
                                                    @endforeach
                                                  @endif
                                                  @if($record2->partner->customertype=='PARTNER')
                                                    @foreach ($banks->where('customertype','PARTNER') as $b)
                                                        <option value="{{ $b->id }}" @if($record2) {{ $record2->parrent_id==$b->id?'selected':'' }} @endif>{{ $b->name }}</option>
                                                    @endforeach
                                                  @endif
                                                  @if($record2->partner->customertype=='AGENT')
                                                    @foreach ($banks->where('customertype','AGENT') as $b)
                                                        <option value="{{ $b->id }}" @if($record2) {{ $record2->parrent_id==$b->id?'selected':'' }} @endif>{{ $b->name }}</option>
                                                    @endforeach
                                                  @endif
                                                  @if($record2->partner->customertype=='NOLIST')
                                                    @foreach ($banks->where('customertype','NOLIST') as $b)
                                                        <option value="{{ $b->id }}" @if($record2) {{ $record2->parrent_id==$b->id?'selected':'' }} @endif>{{ $b->name }}</option>
                                                    @endforeach
                                                  @endif
                                              </select>
                                          </td>
                                  </tr>
                                  <tr>
                                      <td>ចំនួនទឹកប្រាក់</td>
                                      <td style="width:60px;">
                                          <input type="text" class="form-control kh22" name="sign1" id="sign1" style="height:45px;text-align:center;width:60px;" value="@if($record1->trancode==1)+@else-@endif" readonly>
                                      </td>
                                      <td>
                                          <input type="text" class="form-control kh22" name="amount1" id="amount1" style="height:45px;text-align:right;" value="{{ phpformatnumber(abs($record1->amount)) }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                      </td>
                                      <td>
                                          <select class="form-select kh22" name="selcur1" id="selcur1" style="height:45px;">
                                              <option value=""></option>
                                              @foreach ($currencies as $cur)
                                                  <option value="{{ $cur->id }}" {{ $record1->currency_id==$cur->id?'selected':'' }}>{{ $cur->shortcut }}</option>
                                              @endforeach
                                          </select>
                                      </td>
                                  </tr>
                                  <tr>
                                    <td>បរិយាយ</td>
                                    <td colspan=3>
                                        <textarea class="form-control kh22" rows="5" id="noteu2" name="noteu2" >@if($record2) @if($record2_istransfer==1) {{ $record2->note }} @else {{ $record2->note1 }} @endif @endif</textarea>
                                    </td>

                                </tr>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>

            </form>
        </div>
        <div class="card-footer">
          <button type="button" id="btnclose2" style="float:right;margin-left:25px;" class="btn btn-danger kh22">Close</button>
          <button class="btn btn-info kh22" style="float:right;" id="btnsaveusercashinout">Update</button>
        </div>
      </div>
      <div class="card" style="@if($record2_istransfer==2) @else display:none; @endif">
        <div class="card-header">
            <h1 class="kh22">កែប្រែបាញ់ចេញបាញ់ចូលបុគ្គលិក</h1>
        </div>
        <div class="card-body">
            <form action="" id="frmusercashinout3">
              <input type="hidden" id="id3" name="id3" value="{{ $record1->id??'' }}">
              <input type="hidden" id="id4" name="id4" value="{{ $record2->id??'' }}">
              <input type="hidden" id="id5" name="id5" value="{{ $record3->id??'' }}">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="table-responsive">
                              <table class="table kh22">
                                  <tr>
                                      <td colspan=2 style="text-align:center;">
                                          <input class="form-check-input" style="margin-top:10px;font-size:16px;" type="radio" name="radinout3" id="radcashin3" value="1" @if($record1->trancode==1) checked @endif>
                                          <label class="form-check-label kh22" for="radcashin3">លុយបាញ់ចូល</label>
                                      </td>
                                      <td>
                                        <input class="form-check-input" style="margin-top:10px;font-size:16px;" type="radio" name="radinout3" id="radcashout3" value="-1" @if($record1->trancode==-1) checked @endif>
                                        <label style="color:red;" class="form-check-label kh22" for="radcashout3">លុយបាញ់ចេញ</label>
                                      </td>

                                  </tr>
                                  <tr>
                                      <td>ថ្ងៃទី</td>
                                      <td></td>
                                      <td style="width:280px;">
                                          <div class="input-group" style="width:280px;">
                                              <input type="text" name="trandate3" id="trandate3" class="form-control" style="width:200px;height:45px;background-color:silver;font-size:22px;" value="{{ date('d-m-Y',strtotime($record1->trandate)) }}" readonly>
                                              <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                                          </div>
                                      </td>
                                      <td>
                                        <input type="text" name="trantime3" id="trantime3" class="form-control kh22" style="" value="{{ $record1->trantime }}" readonly>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td id="user33">@if($record1->trancode==1) បាញ់ចូល @else បាញ់ចេញ @endif</td>
                                      <td style="width:60px;">
                                          <input type="text" class="form-control kh22" name="sign33" id="sign33" style="height:45px;text-align:center;width:60px;" value="@if($record1->trancode==1)+@else-@endif" readonly>
                                      </td>
                                      <td colspan=2>
                                          <select class="form-select kh22" name="seluser33" id="seluser33" style="width:100%;height:45px;@if($record1->trancode==1) background-color:blue; @else background-color:red; @endif color:white;">

                                              {{-- @foreach ($users as $u)
                                                  <option value="{{ $u->id }}" @if($u->id==Auth::id()) selected @endif>{{ $u->name }}</option>
                                              @endforeach --}}

                                              <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}></option>
                                              @foreach ($users as $u)
                                                  <option value="{{ $u->id }}" {{ $record1->user_id_affect==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                              @endforeach
                                          </select>
                                      </td>
                                  </tr>
                                    <tr class="">
                                        <td id="userlist33">@if($record1->trancode==1) បាញ់ចូល @else បាញ់ចេញ @endif</td>
                                        <td style="width:60px;">
                                            <input type="text" class="form-control kh22" name="signlist33" id="signlist33" style="height:45px;text-align:center;width:60px;" value="@if($record1->trancode==1)+@else-@endif" readonly>
                                        </td>
                                        <td colspan=2>
                                            <select class="form-select kh22" name="sellist33" id="sellist33" style="width:100%;height:45px;">
                                                <option value="">please select user account</option>
                                                @foreach ($banks as $b)
                                                    <option value="{{ $b->id }}" @if($record3) {{ $record3->parrent_id==$b->id?'selected':'' }} @endif>{{ $b->name }}</option>
                                                @endforeach

                                            </select>
                                        </td>
                                    </tr>
                                 
                                  <tr class="">

                                          <td>
                                            <select name="seltype" id="seltype44" class="form-select kh22">
                                                  <option value="BANK" @if($record2->partner->customertype=='BANK') selected @endif>Bank</option>
                                                  <option value="PARTNER" @if($record2->partner->customertype=='PARTNER') selected @endif>Partner</option>
                                                  <option value="AGENT" @if($record2->partner->customertype=='AGENT') selected @endif>Agent</option>
                                                  <option value="NOLIST" @if($record2->partner->customertype=='NOLIST') selected @endif>No List</option>

                                                  @if(Auth::user()->role->name=='Admin')
                                                    <option value="CUSTOMER">Customer</option>
                                                  @endif
                                            </select>
                                          </td>
                                          <td style="width:60px;">
                                              <input type="text" class="form-control kh22" name="sign44" id="sign44" style="height:45px;text-align:center;width:60px;" value="@if($record1->trancode==1)-@else+@endif" readonly>
                                          </td>
                                          <td colspan=2>
                                              <select class="form-select kh22" name="selbank44" id="selbank44" style="width:100%;height:45px;">
                                                  <option value=""></option>
                                                  @if($record2->partner->customertype=='BANK')
                                                    @foreach ($banks->where('customertype','BANK') as $b)
                                                        <option value="{{ $b->id }}" @if($record2) {{ $record2->parrent_id==$b->id?'selected':'' }} @endif>{{ $b->name }}</option>
                                                    @endforeach
                                                  @endif
                                                  @if($record2->partner->customertype=='PARTNER')
                                                    @foreach ($banks->where('customertype','PARTNER') as $b)
                                                        <option value="{{ $b->id }}" @if($record2) {{ $record2->parrent_id==$b->id?'selected':'' }} @endif>{{ $b->name }}</option>
                                                    @endforeach
                                                  @endif
                                                  @if($record2->partner->customertype=='AGENT')
                                                    @foreach ($banks->where('customertype','AGENT') as $b)
                                                        <option value="{{ $b->id }}" @if($record2) {{ $record2->parrent_id==$b->id?'selected':'' }} @endif>{{ $b->name }}</option>
                                                    @endforeach
                                                  @endif
                                                  @if($record2->partner->customertype=='NOLIST')
                                                    @foreach ($banks->where('customertype','NOLIST') as $b)
                                                        <option value="{{ $b->id }}" @if($record2) {{ $record2->parrent_id==$b->id?'selected':'' }} @endif>{{ $b->name }}</option>
                                                    @endforeach
                                                  @endif
                                              </select>
                                          </td>
                                  </tr>
                                  <tr>
                                      <td>ចំនួនទឹកប្រាក់</td>
                                      <td style="width:60px;">
                                          <input type="text" class="form-control kh22" name="amtsign33" id="amtsign33" style="height:45px;text-align:center;width:60px;" value="@if($record1->trancode==1)+@else-@endif" readonly>
                                      </td>
                                      <td>
                                          <input type="text" class="form-control kh22" name="amount33" id="amount33" style="height:45px;text-align:right;" value="{{ phpformatnumber(abs($record1->amount)) }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                      </td>
                                      <td>
                                          <select class="form-select kh22" name="selcur33" id="selcur33" style="height:45px;">
                                              <option value=""></option>
                                              @foreach ($currencies as $cur)
                                                  <option value="{{ $cur->id }}" {{ $record1->currency_id==$cur->id?'selected':'' }}>{{ $cur->shortcut }}</option>
                                              @endforeach
                                          </select>
                                      </td>
                                  </tr>
                                  <tr>
                                    <td>ជ្រើសរើសគណនី</td>
                                    <td colspan=3>
                                        <input type="text" class="form-control" style="height:45px;" id="txtaccountnumber44" name="txtaccountnumber44" value="{{ $record2->rectel }}">
                                    </td>
                                </tr>
                                 <tr>
                                    <td>ឈ្មោះគណនី</td>
                                    <td colspan=3>
                                        <input type="text" class="form-control" style="height:45px;" id="txtaccountname44" name="txtaccountname44" value="{{ $record2->recname }}">
                                    </td>
                                </tr>
                               
                                  <tr>
                                    <td>បរិយាយ</td>
                                    <td colspan=3>
                                        <textarea class="form-control kh22" rows="5" id="note33" name="note33" >{{ $record1->note1 }}</textarea>
                                    </td>

                                </tr>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>

            </form>
        </div>
        <div class="card-footer">
          <button type="button" id="btnclose2" style="float:right;margin-left:25px;" class="btn btn-danger kh22">Close</button>
          <button class="btn btn-info kh22" style="float:right;" id="btnsaveusertransferinout">Update</button>
        </div>
      </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript">

        function checkright()
        {
            $('#seluser').val($('#txtuserid').val());
            var role=$('#txtrole').val();
            if(role!='Admin'){
                $('#trandate').datetimepicker("destroy");
                $('#trandate1').datetimepicker("destroy");
                $('#seluser').attr('disabled',true);

            }
        }
       $(document).ready(function () {
            var today=new Date();
            $('#trandate,#showdate,#trandate1,#trandate3').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            $(document).on('click','#btnclose1,#btnclose2',function(e){
              e.preventDefault();
              window.close();
            })
            $("#selbank").select2();
           $(document).on('change','#seltype',function(e){
                e.preventDefault();
                var customertype=$('#seltype').val();
                $('#selbank').empty();
                var url="{{ route('usercapital.getcustomerbytype') }}";
                $.get(url,{customertype:customertype},function(data){
                   console.log(data);
                   $('#selbank').append($("<option/>",{
						value:'',
						text:'Please Select ' + customertype
					}))
                    $.each(data,function(i,item){
                        $('#selbank').append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))

                    });
                })
           })
            checkright();
            var cleave = new Cleave('#amount', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#amount1', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#amount33', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                showdata();
            })
            $(document).on('change','#selcur0,#seluser,#seltran',function(e){
                e.preventDefault();
                showdata();
            })
            $(document).on('click','#btnaddcapital',function(e){
                e.preventDefault();
                $('#userstartcapitalmodal').modal('show');
                $('#trmode').val(2);
                $('#trid').val(0);
                $('#mtitle').text('ដាក់លុយដើមគ្រា');
                $('#tranname').val('លុយដាក់ដើមគ្រា');
                $('#tdreceiver').text('ដាក់អោយបុគ្គលិក');
                $('#note').val('');
                $('#amount').val('');
                $('#selcur').val('');
                $('#btnsavecapital').text('Save');
                $('#tbl_addusercapital').css('background-color','rgb(159, 232, 231)');
            })
            //event1
            $(document).on('change','#radcashin,#radcashout',function(e){
                e.preventDefault();

                C = $("input[name = 'radinout']:checked").val();
                if(C==="1"){

                    $('#sign1').val('+');
                    $('#sign2').val('+');
                    $('#sign3').val('-');
                    $('#sign4').val('-');
                    $('#user1').text('ដាក់ចូល');
                    $('#user2').text('ដកចេញ');
                    document.getElementById("seluser2").style.backgroundColor = 'red';
                    document.getElementById("seluser1").style.backgroundColor = 'blue';

                }else if(C==="-1"){

                    $('#sign1').val('-');
                    $('#sign2').val('-');
                    $('#sign3').val('+');
                    $('#sign4').val('+');
                    $('#user1').text('ដកចេញ');
                    $('#user2').text('ដាក់ចូល');
                    document.getElementById("seluser2").style.backgroundColor = 'blue';
                    document.getElementById("seluser1").style.backgroundColor = 'red';

                }
            })
            $(document).on('change','#radcashin3,#radcashout3',function(e){
                e.preventDefault();

                C = $("input[name = 'radinout3']:checked").val();
                if(C==="1"){
                    $('#sign33').val('+');
                    $('#signlist33').val('+');
                    $('#amtsign33').val('+');
                    $('#sign44').val('-');
                    $('#user33').text('បាញ់ចូល');
                    $('#userlist33').text('បាញ់ចូល');
                    document.getElementById("seluser33").style.backgroundColor = 'blue';
                }else if(C==="-1"){
                    $('#sign33').val('-');
                    $('#signlist33').val('-');
                    $('#amtsign33').val('-');
                    $('#sign44').val('+');
                    $('#user33').text('បាញ់ចេញ');
                    $('#userlist33').text('បាញ់ចេញ');
                    document.getElementById("seluser33").style.backgroundColor = 'red';
                }
            })
            //event 2
            // $('input[type=radio][name=radinout]').change(function() {
            //     if (this.value == 1) {
            //         alert("Select Male");
            //     }else if (this.value == -1) {
            //         alert("Select Female");
            //     }
            // });
            $(document).on('click','#btnendbalance',function(e){
                e.preventDefault();
                $('#userstartcapitalmodal').modal('show');
                $('#trmode').val(-2);
                $('#mtitle').text('ដកលុយចុងគ្រា');
                $('#tranname').val('លុយដកចុងគ្រា');
                $('#tdreceiver').text('ដកពីបុគ្គលិក');
                $('#tbl_addusercapital').css('background-color','rgb(243, 211, 220)');
            })

            $(document).on('click','#btnaddcashinoutuser',function(e){
                e.preventDefault();
                $('#cashinoutusermodal').modal('show');
                $('#frmusercashinout').trigger('reset');
                $('.trbank').addClass("hiddenrow");
                $('.truser').removeClass("hiddenrow");
                $('#modaltitle').text("ដាក់ដកបុគ្គលិក");
                $('#mode').val(1);
                $('#id1').val(0);
                $('#id2').val(0);
                $('#btnsaveusercashinout').text('Save');
                $('#trandate1').datetimepicker({
                    timepicker:false,
                    datepicker:true,
                    value:today,
                    format:'d-m-Y',
                    autoclose:true,
                    todayBtn:true,
                    startDate:today,

                });
                document.getElementById("seluser2").style.backgroundColor = 'red';
                document.getElementById("seluser1").style.backgroundColor = 'blue';
            })
            $(document).on('click','#btnaddcashinoutuserbank',function(e){
                e.preventDefault();
                $('#cashinoutusermodal').modal('show');
                //$('#frmusercashinout').trigger('reset');
                $('.truser').addClass("hiddenrow");
                $('.trbank').removeClass("hiddenrow");
                $('#modaltitle').text("ដាក់ដកធនាគា");
                $('#mode').val(2);
                $('#id1').val(0);
                $('#id2').val(0);
                $('#btnsaveusercashinout').text('Save');
                // $('#trandate1').datetimepicker({
                //     timepicker:false,
                //     datepicker:true,
                //     value:today,
                //     format:'d-m-Y',
                //     autoclose:true,
                //     todayBtn:true,
                //     startDate:today,

                // });
            })
            $('#cashinoutusermodal').on('shown.bs.modal', function () {
                $('#amount1').focus();
            })
            $('#userstartcapitalmodal').on('shown.bs.modal', function () {
                $('#amount').focus();
            })
            $(document).on('keyup','#amount',function(e){
                const C = e.key;
                if (C === "Backspace") return;
                if(isNumber(C)==false){
                    getcurrencybykey(C,'#selcur')
                }
            })

            $(document).on('keyup','#amount1',function(e){

                if (e.keyCode === 13) {
                    $("#btnsaveusercashinout").focus();
                    return;
                }
                const C = e.key;
                if(C==="+"){
                    e.preventDefault();
                    $('#sign1').val('+');
                    $('#sign2').val('+');
                    $('#sign3').val('-');
                    $('#sign4').val('-');
                    $('#user1').text('ដាក់ចូល');
                    $('#user2').text('ដកចេញ');
                    document.getElementById("seluser2").style.backgroundColor = 'red';
                    document.getElementById("seluser1").style.backgroundColor = 'blue';
                    document.getElementById("radcashin").checked = true;
                    return;
                }else if(C==="-"){
                    e.preventDefault();
                    $('#sign1').val('-');
                    $('#sign2').val('-');
                    $('#sign3').val('+');
                    $('#sign4').val('+');
                    $('#user1').text('ដកចេញ');
                    $('#user2').text('ដាក់ចូល');
                    document.getElementById("seluser2").style.backgroundColor = 'blue';
                    document.getElementById("seluser1").style.backgroundColor = 'red';
                    document.getElementById("radcashout").checked = true;
                    return;
                }
                if (C === "Backspace") return;
                if(isNumber(C)==false){
                    getcurrencybykey(C,'#selcur1')
                }
            })
            $(document).on('keyup','#amount33',function(e){

                if (e.keyCode === 13) {
                    $("#txtaccountnumber44").focus();
                    return;
                }
                const C = e.key;
                if(C==="+"){
                    e.preventDefault();
                    $('#sign33').val('+');
                    $('#signlist33').val('+');
                    $('#amtsign33').val('+');
                    $('#sign44').val('-');
                    $('#user33').text('បាញ់ចូល');
                    $('#userlist33').text('ចូលបញ្ជី');
                    document.getElementById("seluser33").style.backgroundColor = 'blue';
                    document.getElementById("radcashin3").checked = true;
                    return;
                }else if(C==="-"){
                    e.preventDefault();
                    $('#sign33').val('-');
                    $('#signlist33').val('-');
                    $('#amtsign33').val('-');
                    $('#sign44').val('+');
                    $('#user33').text('បាញ់ចេញ');
                    $('#userlist33').text('បាញ់ចេញ');
                    document.getElementById("seluser33").style.backgroundColor = 'red';
                    document.getElementById("radcashout3").checked = true;
                    return;
                }
                if (C === "Backspace") return;
                if(isNumber(C)==false){
                    getcurrencybykey(C,'#selcur33')
                }
            })
            function getcurrencybykey(key,el)
            {
                var url="{{ route('getcurrencybykey') }}";
                $.get(url,{key:key},function(data){
                    //console.log(data)
                        if(data['c']!=null){
                            $(el).val(data['c']['id']);
                            //$(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                        }
                })
            }
            $(document).on('click','#btnsavecapital',function(e){
                e.preventDefault();
                //var d=$('#listdate').val();
                var formdata = new FormData(frmusercapital);
                //formdata.append('listdate',d);
                var url="{{ route('usercapital.store') }}";
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       console.log(data)
                       if($.isEmptyObject(data.error)){
                           window.close();
                       }else{
                            alert(data.error)
                       }
                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
            })

            function cleartext(){
                $('#amount').val('');
                $('#amount').focus();
            }
            function cleartext1(){
                $('#amount1').val('');
                $('#noteu2').val('')
                $('#amount1').focus();
            }
            $(document).on('click','#btnsaveusercashinout',function(e){
                e.preventDefault();
                //var d=$('#listdate').val();
                var mode=$('#mode').val();
                var receive=$('#seluser1 option:selected').text();
                if(mode==1){
                    var sender=$('#seluser2 option:selected').text();
                }else{
                    var sender=$('#selbank option:selected').text();
                }
                var curname=$('#selcur1 option:selected').text();
                var formdata = new FormData(frmusercashinout);
                formdata.append('receive',receive);
                formdata.append('sender',sender);
                formdata.append('curname',curname);
                var url="{{ route('usercapital.store1') }}";
                $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       console.log(data)
                       if($.isEmptyObject(data.error)){
                            window.close();

                       }else{
                            alert(data.error)
                       }


                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
            })
            $(document).on('click','#btnsaveusertransferinout',function(e){
                e.preventDefault();
                var receive=$('#seluser33 option:selected').text();
                var receivelist=$('#sellist33 option:selected').text();
                var sender=$('#selbank44 option:selected').text();
                var curname=$('#selcur33 option:selected').text();
                var formdata = new FormData(frmusercashinout3);
                formdata.append('receive',receive);
                formdata.append('receivelist',receivelist);
                formdata.append('sender',sender);
                formdata.append('curname',curname);
                var url="{{ route('usercapital.store3') }}";
                $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       console.log(data)
                       if($.isEmptyObject(data.error)){
                            toastr.success("Save User Balance Successfully");
                            window.close();
                       }else{
                            alert(data.error)
                       }

                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
            })
             // Remove previous highlight class
            $(document).on('click','.tbl_capital td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
            })
            function showdata()
            {
                var user=$('#seluser').val();
                var cur=$('#selcur0').val();
                var showdate=$('#showdate').val();
                var raduser=$('input[name="raduser"]:checked').val();
                var trancode=$('#seltran').val();
                var url="{{ route('usercapital.search') }}";
                $.get(url,{user:user,searchdate:showdate,raduser:raduser,cur:cur,trancode:trancode},function(data){
                    //console.log(data)
                    $('#contentbody').empty().html(data);
                })
            }
            $(document).on('change','#raduserrecord,#raduseraffect',function(e){
                e.preventDefault();
                showdata();
            })
            $(document).on('click','.uc_update',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var refnumber=$(this).data('ref_number');
                var url="{{ route('usercapital.edit') }}";
                $.get(url,{id:id,refnumber:refnumber},function(data){
                    console.log(data);
                    var user1=data['record1'].user_id_affect;
                    var id1=data['record1'].id;
                    var trname1=data['record1'].tranname;
                    var trancode1=data['record1'].trancode;
                    var amt1=data['record1'].amount;
                    var cur1=data['record1'].currency_id;
                    var dd1=data['record1'].trandate;
                    var note=data['record1'].note;
                    var note1=data['record1'].note1;
                    if(data['record2']==null){
                      //alert('record2 null')
                    }else{
                      if(data['record2_istransfer']==1){
                        var user2=data['record2'].parrent_id;
                        var id2=data['record2'].id;
                        var trname2=data['record2'].tranname;
                        var trancode2=data['record2'].trancode;
                        var note2=data['record2'].note;
                        var amt2=data['record2'].amount;
                        var cur2=data['record2'].currency_id;
                      }else{
                        var user2=data['record2'].user_id_affect;
                        var id2=data['record2'].id;
                        var trname2=data['record2'].tranname;
                        var trancode2=data['record2'].trancode;
                        var note2=data['record2'].note1;
                        var amt2=data['record2'].amount;
                        var cur2=data['record2'].currency_id;
                      }
                    }
                    if(trancode1==2 || trancode1==-2){
                      $('#userstartcapitalmodal').modal('show');
                      $('#trmode').val(trancode1);
                      $('#tranname').val(trname1);
                      $('#trid').val(id1);
                      $('#trandate').val(moment(dd1).format('DD-MM-YYYY'));
                      $('#seluserreceive').val(user1);
                      $('#amount').val(formatNumber(Math.abs(amt1)));
                      $('#selcur').val(cur1);
                      $('#note').val(note);
                      $('#mtitle').text('កែប្រែទិន្ន័យ');
                      $('#btnsavecapital').text('Update');
                    }else{
                      $('#cashinoutusermodal').modal('show');
                      $('#id1').val(id1);
                      $('#id2').val(id2);
                      $('#trandate1').val(moment(dd1).format('DD-MM-YYYY'));
                      if(data['record2_istransfer']==1){

                        $('.trbank').removeClass("hiddenrow");
                        $('.truser').addClass("hiddenrow");
                        $('#mode').val(2);
                        $('#selbank').val(user2);
                        $('#selbank').trigger('change');
                      }else{

                        $('.trbank').addClass("hiddenrow");
                        $('.truser').removeClass("hiddenrow");
                        $('#mode').val(1);
                        $('#seluser2').val(user2);
                      }
                      $('#modaltitle').text("កែប្រែដាក់ដកបុគ្គលិក");
                      $('#id1').val(id1);
                      $('#id2').val(id2);
                      if(trancode1==1){
                        const cashinBtn = document.getElementById('radcashin');
                        cashinBtn.checked=true;
                      }else if(trancode1==-1){
                        const cashoutBtn = document.getElementById('radcashout');
                        cashoutBtn.checked=true;
                      }
                      $("input[name=radinout]").trigger("change");
                      $('#seluser1').val(user1);

                      $('#amount1').val(formatNumber(Math.abs(amt1)));
                      $('#selcur1').val(cur1);
                      $('#noteu2').val(note1);
                      $('#btnsaveusercashinout').text('Update');
                    }
                })
            })
            $(document).on('click','.uc_delete',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var refnumber=$(this).data('ref_number');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('usercapital.delete') }}",
                            data: { id:id,refnumber:refnumber },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    showdata();
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
           $(document).on('keydown','#amount',function(e){
            if (e.keyCode == 13) {
                    $('#btnsavecapital').focus();
                    e.preventDefault();
                }

           })
        })
        function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    </script>
@endsection
