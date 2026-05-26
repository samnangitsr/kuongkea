@extends('master')
@section('title') Summary Transaction Detail @endsection
@section('css')
    <style type="text/css">
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
        .en16-b{
            font-family:'Arial', sans-serif;
            font-size:16px;
            font-weight:bold;

            }
        .en14-b{
            font-family:'Arial', sans-serif;
            font-size:14px;
            font-weight:bold;

            }
        .en12-b{
            font-family:'Arial', sans-serif;
            font-size:14px;
            font-weight:bold;

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
        .kh36{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:36px;
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

       .table .clickedrow td{
            background-color: #b0e498;
        }
        .tbl_usertransaction td{
            padding:3px;
        }
        .red{
            color:red;
        }
        .blue{
            color:blue;
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
    <div class="row">
        <h1 class="kh36">{{ $tranname }}</h1>
    </div>

    <div class="row">
        <table class="table table-bordered kh16 tbl_usertransaction" style="table-layout:fixed;width:100%;margin:0px;padding:0px;">
            <thead style="text-align:center;" class="kh16-b">
                <th style="width:60px;">No</th>
                <th style="width:130px;">ថ្ងៃទី</th>
                <th style="width:100px;">បុគ្គលិក</th>
                <th>ប្រតិបត្តិការណ៏</th>
                <th>GOLD</th>
                <th>USD</th>
                <th>THB</th>
                <th>KHR</th>
                <th>VND</th>
                <th>FN</th>
                {{-- <th>គេខ្វះ</th>
                <th>ខ្វះគេ</th>
                <th>ធនាគា</th> --}}
                <th>Description</th>
            </thead>
            <tbody>
                @php
                    $usd=0;
                    $gold=0;
                    $khr=0;
                    $thb=0;
                    $vnd=0;
                    $theylack=0;
                    $welack=0;
                    $bank=0;
                    $sumusd=0;
                    $trdate='';
                    $create_at='';
                @endphp
                @foreach ($usertransactions as $key => $ut)
                    <tr style="background-color:lightgrey;">
                        @php

                          $trdate=date('Y-m-d',strtotime($ut->dd));
                          $created_at=date('Y-m-d',strtotime($ut->inputdate));
                          if($d1<>$d2){
                                $strdate=date('d-m-Y',strtotime($d1)) . '<br>'. date('d-m-Y',strtotime($d2));
                          }else{
                            $strdate=date('d-m-Y',strtotime($d1));
                          }
                        @endphp
                        <td class="en12-b" style="text-align:center;padding:4px 0px;">{{ ++$key }}</td>
                        {{-- <td class="en14" style="text-align:center;@if($trdate<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($ut->dd)) }} <br> {{ $ut->tt }} </td> --}}
                        <td class="en14-b" style="padding:4px 2px">{{ $strdate }}</td>
                        <td class="en14-b" style="padding:4px 2px;"> {{ $ut->user->name }}</td>
                        <td class="kh14-b" style="padding:2px;">
                            <a class="" href="#linkid{{ $ut->id }}" data-bs-toggle="collapse" title="{{ $ut->id }}" style=" text-decoration:underline;">{{ $ut->tranname }}</a>
                        </td>

                        <td class="en16-b @if($ut->gold>=0) red @else blue @endif">@if($ut->gold<>0) {{ phpformatnumber($ut->gold) . 'G' }} @endif @if($ut->issum==1) @if($ut->gold<>0) @endif @endif</td>
                        <td class="en16-b @if($ut->usd>=0) red @else blue @endif">@if($ut->usd<>0){{ phpformatnumber($ut->usd) . '$' }} @endif @if($ut->issum==1) @if($ut->usd<>0)  @endif @endif</td>
                        <td class="en16-b @if($ut->thb>=0) red @else blue @endif">@if($ut->thb<>0) {{ phpformatnumber($ut->thb) . 'B' }} @endif @if($ut->issum==1) @if($ut->thb<>0) @endif @endif</td>
                        <td class="en16-b @if($ut->khr>=0) red @else blue @endif">@if($ut->khr<>0){{ phpformatnumber($ut->khr) . 'R' }} @endif @if($ut->issum==1) @if($ut->khr<>0) @endif @endif</td>
                        <td class="en16-b @if($ut->vnd>=0) red @else blue @endif">@if($ut->vnd<>0){{ phpformatnumber($ut->vnd) . 'V' }}@endif @if($ut->issum==1) @if($ut->vnd<>0)  @endif @endif</td>
                        <td class="en16-b @if($ut->vnd>=0) red @else blue @endif">
                            @if($ut->fn<>'0')
                              {{ phpformatnumber($ut->fn) . $ut->shortcut }}
                            @else

                            @endif

                        </td>

                        {{-- <td class="amt">{{ phpformatnumber($ut->theylack) . '$' }}</td>
                        <td class="amt">{{ phpformatnumber($ut->welack) . '$' }}</td>
                        <td class="amt">{{ phpformatnumber($ut->paybybank) . '$' }}</td> --}}
                        <td class="kh16">{{ $ut->desr }}</td>
                    </tr>

                    <tr id="linkid{{ $ut->id }}" class="collapse show" style="">
                        <td colspan=11 style="padding:0px;">

                              @if(str_contains($ut->tablename,'partner_transfers'))
                                  <table class="kh12-b">
                                      <thead>
                                          <th style="width:80px;">TID</th>
                                          <th style="width:200px;">ថ្ងៃទី</th>
                                          <th style="width:100px;">អ្នកកត់ត្រា</th>
                                          {{-- <th style="width:200px;">ដៃគូ</th> --}}
                                          <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
                                          <th style="width:150px;">សរុបទឹកប្រាក់</th>
                                          <th style="width:120px;">សេវ៉ាដៃគូ</th>
                                          <th style="width:100px;">អតិថិជន</th>
                                          <th style="width:200px;">អ្នកទទួល</th>
                                          <th style="width:200px;">អ្នកផ្ញើ</th>
                                          <th style="width:200px;">លុយថៃ</th>
                                          <th>ផ្សេងៗ</th>
                                      </thead>
                                      <tbody>

                                        @foreach (App\UserCapital::showtransactiondetail($ut->tablename,$d1,$d2,$ut->user_id) as $item)
                                          <tr>
                                              <td style="">{{ sprintf("%04d",$item->id) }}</td>
                                              <td style="width:120px;">
                                                  {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                              </td>
                                              <td>{{ $item->user->name }}</td>
                                              {{-- <td>{{ $item->partner->name }}</td> --}}
                                              <td>{{ $item->tranname }}</td>
                                              <td style="">{{ phpformatnumber($item->amount) . $item->currency->sk }}</td>
                                              <td style="">{{ phpformatnumber($item->fee) . $item->feecurrency->sk }}</td>
                                              <td style="">{{ phpformatnumber($item->cuscharge) . $item->cuschargecur->sk }}</td>
                                              <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                              <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                              <td style="">{{ phpformatnumber($item->thai_amt) . 'B' }} @if($item->thai_amt)  {{ $item->usercode->name }} @endif</td>

                                              <td>{{ $item->note }}</td>

                                          </tr>
                                        @endforeach
                                      </tbody>
                                  </table>
                              @elseif($ut->tablename=='cashdraws')
                                  <table class="table table-border tbl_sub">
                                      <thead>
                                          <th style="width:80px;">TID</th>
                                          <th style="width:100px;">ថ្ងៃបើក</th>
                                          <th style="width:100px;">អ្នកកត់ត្រា</th>
                                          <th>ដៃគូ</th>
                                          <th>ប្រតិបត្តិការណ៏</th>
                                          <th>ចំនួនទឹកប្រាក់</th>
                                          <th>កាត់សេវ៉ា</th>
                                          <th>អ្នកទទួលប្រាក់</th>
                                          <th>ផ្សេងៗ</th>
                                          <th style="width:100px;">សកម្មភាព</th>
                                      </thead>
                                      <tbody>
                                        @foreach (App\UserCapital::showtransactiondetail($ut->link_id,$ut->tablename,$ut->dd,$ut->user_id,$ut->shortcut) as $item)

                                          <tr>
                                              <td>{{ sprintf("%04d",$item->id) }}</td>
                                              <td>
                                                  {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                              </td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->frompartner->name }}</td>
                                              <td>បើកវេរ</td>
                                              <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                              <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                              <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                              <td>{{ $item->note }}</td>
                                              <td>
                                                @if(!$item->ref_group_id)
                                                  @if(str_contains($item->action,'d'))
                                                    @if (Auth::user()->role->name<>'Admin')
                                                      @if (App\User::checkpermission(Auth::id(),3.7))
                                                        <a href="#" class="btn btn-danger btn-sm btndelcashdraw" data-id="{{ $item->id }}" data-transfer_id="{{ $item->transfer_id }}"><i class="fa fa-trash"></i></a>
                                                      @endif
                                                    @else
                                                        <a href="#" class="btn btn-danger btn-sm btndelcashdraw" data-id="{{ $item->id }}" data-transfer_id="{{ $item->transfer_id }}"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                  @endif
                                                @endif
                                            </td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                  </table>

                              @elseif(str_contains($ut->tablename,'exchanges'))
                                  <table class="table table-border tbl_sub">
                                      <thead>
                                          <th style="width:80px;">ID</th>
                                          <th style="width:150px;">ថ្ងៃទី</th>
                                          <th style="width:100px;">អ្នកកត់ត្រា</th>
                                          <th>ទំនិញ</th>
                                          <th>លុយ</th>
                                          <th style="width:150px;">អត្រា</th>
                                          <th>ផ្សេងៗ</th>
                                      </thead>
                                      <tbody>
                                        @foreach (App\UserCapital::showtransactiondetail($ut->link_id,$ut->tablename,$ut->dd,$ut->user_id,$ut->shortcut) as $item)
                                          <tr>
                                              <td style="width:60px;">{{ sprintf("%04d",$item->id) }}</td>
                                              <td style="width:150px;">
                                                  {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                              </td>
                                              <td style="width:100px;">{{ $item->user->name }}</td>
                                              <td class="subtdamt">{{ phpformatnumber($item->product) . ' ' . $item->pcur }}</td>
                                              <td class="subtdamt">{{ phpformatnumber($item->amount) . ' ' . $item->maincur }}</td>
                                              <td style="width:150px;">{{ phpformatnumber($item->rate) . '(' . phpformatnumber($item->drate). ')'}}</td>
                                              <td>{{ $item->note }}</td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>

                              @elseif($ut->tablename=='user_capitals')
                                  <table class="table table-border tbl_sub">
                                      <thead>
                                          <th style="width:80px;">ID</th>
                                          <th style="width:100px;">ថ្ងៃទី</th>
                                          <th style="width:100px;">អ្នកកត់ត្រា</th>
                                          <th style="width:150px;">ពាក់ព័ន្ធបុគ្គលិក</th>
                                          <th>បរិយាយ</th>
                                          <th>ចំនួនទឹកប្រាក់</th>
                                          <th>ផ្សេងៗ</th>
                                          <th style="width:100px;">សកម្មភាព</th>
                                      </thead>
                                      <tbody>
                                        @foreach (App\UserCapital::showlink_ids($ut->link_id,$ut->tablename) as $item)
                                          <tr>
                                              <td>{{ sprintf("%04d",$item->id) }}</td>
                                              <td>
                                                  {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                              </td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->useraffect->name }}</td>
                                              <td>{{ $item->tranname . ' ' . $item->agent_name??'' }}</td>
                                              <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                              <td>{{ $item->note }}</td>
                                              <td style="padding:5px;">
                                                @if(str_contains($item->action,'d'))
                                                  @if (Auth::user()->role->name<>'Admin')
                                                    @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                      <a href="#" class="btn btn-danger btn-sm btndelusercapital" data-id="{{ $item->id }}" data-refnumber="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                  @else
                                                      <a href="#" class="btn btn-danger btn-sm btndelusercapital" data-id="{{ $item->id }}" data-refnumber="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                  @endif
                                                @endif

                                                @if(str_contains($item->action,'u'))
                                                  @if (Auth::user()->role->name<>'Admin')
                                                    @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                      <a href="{{ route('usercapital.updateusercapital',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                    @endif
                                                  @else
                                                      <a href="{{ route('usercapital.updateusercapital',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                  @endif
                                                @endif
                                            </td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                  </table>
                              @elseif($ut->tablename=='expanses-1')
                                  <table class="table table-border tbl_sub">
                                      <thead>
                                          <th style="width:80px;">ID</th>
                                          <th style="width:100px;">ថ្ងៃទី</th>
                                          <th style="width:100px;">អ្នកកត់ត្រា</th>
                                          <th style="width:150px;">ពាក់ព័ន្ធបុគ្គលិក</th>
                                          <th>បរិយាយ</th>
                                          <th>ចំនួនទឹកប្រាក់</th>
                                          <th>ផ្សេងៗ</th>
                                          {{-- <th style="width:100px;">សកម្មភាព</th> --}}
                                      </thead>
                                      <tbody>
                                        @foreach (App\UserCapital::showtransactiondetail($ut->link_id,$ut->tablename,$ut->dd,$ut->user_id,$ut->shortcut) as $item)
                                          <tr>
                                              <td>{{ sprintf("%04d",$item->id) }}</td>
                                              <td>
                                                  {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                              </td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->type  }}</td>
                                              <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                              <td>{{ $item->desr }}</td>
                                              {{-- <td style="padding:5px;">
                                                @if(str_contains($item->action,'d'))
                                                  @if (Auth::user()->role->name<>'Admin')
                                                    @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                      <a href="#" class="btn btn-danger btn-sm btndelusercapital" data-id="{{ $item->id }}" data-refnumber="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                  @else
                                                      <a href="#" class="btn btn-danger btn-sm btndelusercapital" data-id="{{ $item->id }}" data-refnumber="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                  @endif
                                                @endif

                                                @if(str_contains($item->action,'u'))
                                                  @if (Auth::user()->role->name<>'Admin')
                                                    @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                      <a href="{{ route('usercapital.updateusercapital',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                    @endif
                                                  @else
                                                      <a href="{{ route('usercapital.updateusercapital',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                  @endif
                                                @endif
                                            </td> --}}
                                          </tr>
                                        @endforeach
                                      </tbody>
                                  </table>
                               @elseif($ut->tablename=='expanses1')
                                  <table class="table table-border tbl_sub">
                                      <thead>
                                          <th style="width:80px;">ID</th>
                                          <th style="width:100px;">ថ្ងៃទី</th>
                                          <th style="width:100px;">អ្នកកត់ត្រា</th>
                                          <th style="width:150px;">ពាក់ព័ន្ធបុគ្គលិក</th>
                                          <th>បរិយាយ</th>
                                          <th>ចំនួនទឹកប្រាក់</th>
                                          <th>ផ្សេងៗ</th>
                                          {{-- <th style="width:100px;">សកម្មភាព</th> --}}
                                      </thead>
                                      <tbody>
                                        @foreach (App\UserCapital::showtransactiondetail($ut->link_id,$ut->tablename,$ut->dd,$ut->user_id,$ut->shortcut) as $item)
                                          <tr>
                                              <td>{{ sprintf("%04d",$item->id) }}</td>
                                              <td>
                                                  {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                              </td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->type  }}</td>
                                              <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                              <td>{{ $item->desr }}</td>
                                              {{-- <td style="padding:5px;">
                                                @if(str_contains($item->action,'d'))
                                                  @if (Auth::user()->role->name<>'Admin')
                                                    @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                      <a href="#" class="btn btn-danger btn-sm btndelusercapital" data-id="{{ $item->id }}" data-refnumber="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                  @else
                                                      <a href="#" class="btn btn-danger btn-sm btndelusercapital" data-id="{{ $item->id }}" data-refnumber="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                  @endif
                                                @endif

                                                @if(str_contains($item->action,'u'))
                                                  @if (Auth::user()->role->name<>'Admin')
                                                    @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                      <a href="{{ route('usercapital.updateusercapital',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                    @endif
                                                  @else
                                                      <a href="{{ route('usercapital.updateusercapital',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                  @endif
                                                @endif
                                            </td> --}}
                                          </tr>
                                        @endforeach
                                      </tbody>
                                  </table>
                              @elseif($ut->tablename=='sms_processes')
                                  <table class="table table-border tbl_sub">
                                      <thead>
                                          <th style="width:80px;">TID</th>
                                          <th style="width:100px;">ថ្ងៃបើក</th>
                                          <th style="width:100px;">អ្នកកត់ត្រា</th>
                                          <th>ដៃគូ</th>
                                          <th>ប្រតិបត្តិការណ៏</th>
                                          <th>ចំនួនទឹកប្រាក់</th>
                                          <th>កាត់សេវ៉ា</th>
                                          <th>អ្នកទទួលប្រាក់</th>
                                          <th>ផ្សេងៗ</th>

                                      </thead>
                                      <tbody>
                                        @foreach (App\UserCapital::showtransactiondetail($ut->link_id,$ut->tablename,$ut->dd,$ut->user_id,$ut->shortcut) as $item)

                                          <tr>
                                              <td>{{ sprintf("%04d",$item->id) }}</td>
                                              <td style="width:130px;">
                                                  {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                              </td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->thaisms->sendfrom }}</td>
                                              <td>{{ $item->thaisms->accno }}</td>
                                              <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                              <td>{{ phpformatnumber($item->thaisms->cutseva) . ' ' . $item->currency->shortcut }}</td>
                                              <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                              <td>{{ $item->note }}</td>

                                          </tr>
                                        @endforeach
                                      </tbody>
                                  </table>
                              @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>


@endsection
@section('script')

    <script type="text/javascript">

        $(document).ready(function () {

            $(document).on('click','.table td',function(e){
              // Remove previous highlight class
              $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
              // add highlight to the parent tr of the clicked td
              $(this).parent('tr').addClass("clickedrow");
          })


        })
    </script>
@endsection
