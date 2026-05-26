@php
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        //$dc=strlen((float)$fp)-2;
        $dc=2;

        }
        return number_format($num,$dc,'.',',');
    }
@endphp
@php
$i=0;
@endphp
{{-- <div class="table-responsive"> --}}
    <table class="table table-bordered table-hover kh16 tbl_usertransaction" style="table-layout:fixed;margin:0px;padding:0px;">
        <thead style="text-align:center;">
            <th style="width:60px;">No</th>
            <th style="width:100px;">ថ្ងៃទី</th>
            <th style="width:300px;">ប្រតិបត្តិការណ៏</th>
            <th style="width:150px;">ក្រុម</th>
            <th style="width:150px;">USD</th>
            <th style="width:150px;">THB</th>
            <th style="width:200px;">KHR</th>
            <th style="width:200px;">VND</th>
            <th style="width:120px;">GOLD</th>
            <th style="width:120px;">FN</th>
            <th style="width:100px;">ID</th>
            {{-- <th>គេខ្វះ</th>
            <th>ខ្វះគេ</th>
            <th>ធនាគា</th> --}}
            <th style="width:500px;">Description</th>

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
                <tr>
                    @php

                      if($ut->issum==1){
                        $usd+=$ut->usd;
                        $gold+=$ut->gold;
                        $khr+=$ut->khr;
                        $thb+=$ut->thb;
                        $vnd+=$ut->vnd;
                        $theylack+=$ut->theylack;
                        $welack+=$ut->welack;
                        $bank+=$ut->paybybank;
                        $sumusd+=$ut->usd+$ut->theylack+$ut->welack+$ut->paybybank;
                      }
                      $trdate=date('Y-m-d',strtotime($ut->dd));
                      $created_at=date('Y-m-d',strtotime($ut->inputdate));

                    //   $showlinkid=explode(',',$ut->link_id);
                    //   if(count($showlinkid)>1){
                    //     $linkid=$showlinkid[0] . ',...';
                    //   }else{
                    //     $linkid=$showlinkid[0];
                    //   }

                    @endphp
                    <td class="en14" style="text-align:center;">{{ ++$key }}</td>
                    <td class="en14" style="text-align:center;@if($trdate<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($ut->dd)) }} <br> {{ $ut->tt }} </td>
                    <td class="kh16">
                        <a class="" href="#linkid{{ $ut->id }}" data-bs-toggle="collapse" title="{{ $ut->link_id }}" style=" text-decoration:underline;">{{ $ut->tranname }}</a>
                        @if($ut->ref_number)
                        <br>
                          <a class="" href="#ref{{ $ut->id }}" data-bs-toggle="collapse" style=" text-decoration:underline;color:red;">{{ $ut->ref_number }}</a>
                        @endif

                    </td>
                    <td>
                      @if($ut->ref_group_id)
                        <a href="{{ route('usercapital.showrefgroupid',['group_id'=>$ut->ref_group_id]) }}" class="btn btn-warning btn-sm en14" target="_blank" style="margin:0px;padding:2px;">{{ $ut->ref_group_id }}</a>
                      @endif
                      @if($trdate<>$created_at)
                        <br><span style="font-size:14px;background-color:brown;color:white;">កត់ត្រា{{ date('d-m-Y',strtotime($ut->inputdate)) }}</span>
                      @endif
                    </td>
                    <td class="en16-b @if($ut->usd>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">@if($ut->usd<>0){{ phpformatnumber($ut->usd) . '$' }} @endif @if($ut->issum==1) @if($ut->usd<>0) <br> <span class="amt12">{{ phpformatnumber($usd) . '$' }}</span> @endif @endif</td>
                    <td class="en16-b @if($ut->thb>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">@if($ut->thb<>0) {{ phpformatnumber($ut->thb) . 'B' }} @endif @if($ut->issum==1) @if($ut->thb<>0) <br> <span class="amt12">{{ phpformatnumber($thb) . 'B' }} @endif @endif</td>
                        <td class="en16-b @if($ut->khr>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">@if($ut->khr<>0){{ phpformatnumber($ut->khr) . 'R' }} @endif @if($ut->issum==1) @if($ut->khr<>0) <br> <span class="amt12">{{ phpformatnumber($khr) . 'R' }} @endif @endif</td>
                            <td class="en16-b @if($ut->vnd>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">@if($ut->vnd<>0){{ phpformatnumber($ut->vnd) . 'V' }}@endif @if($ut->issum==1) @if($ut->vnd<>0) <br> <span class="amt12">{{ phpformatnumber($vnd) . 'V' }} @endif @endif</td>
                                <td class="en16-b @if($ut->gold>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">@if($ut->gold<>0) {{ phpformatnumber($ut->gold) . 'G' }} @endif @if($ut->issum==1) @if($ut->gold<>0) <br> <span class="amt12">{{ phpformatnumber($gold) . 'G' }} @endif @endif</td>
                    <td class="en16-b @if($ut->vnd>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">
                        @if($ut->fn<>'0')
                          {{ phpformatnumber($ut->fn) . $ut->shortcut }}
                        @else

                        @endif

                    </td>
                    <td class="en14" style="text-align:center;">{{ $ut->link_id }} <br> {{ $ut->user->name }}</td>

                    {{-- <td class="amt">{{ phpformatnumber($ut->theylack) . '$' }}</td>
                    <td class="amt">{{ phpformatnumber($ut->welack) . '$' }}</td>
                    <td class="amt">{{ phpformatnumber($ut->paybybank) . '$' }}</td> --}}
                    <td class="kh16">{{ $ut->desr }}</td>
                </tr>
                @php
                  $i=0;
                @endphp
                  <tr id="linkid{{ $ut->id }}" class="collapse" style="background-color:rgb(216, 238, 206)">
                      <td colspan=12 style="padding:0px;">
                            @if($ut->tablename=='partner_transfers')
                                <table class="table table-border tbl_sub">
                                    <thead>
                                        <th style="width:80px;">TID</th>
                                        <th style="width:100px;">ថ្ងៃទី</th>
                                        <th style="width:100px;">អ្នកកត់ត្រា</th>
                                        <th style="width:200px;">ដៃគូ</th>
                                        <th style="width:120px;">ប្រតិបត្តិការណ៏</th>
                                        <th style="width:150px;">សរុបទឹកប្រាក់</th>
                                        <th style="width:120px;">សេវ៉ាដៃគូ</th>
                                        <th style="width:100px;">សេវ៉ាអតិថិជន</th>
                                        <th style="width:100px;">Sender</th>
                                        <th style="width:200px;">Receiver</th>
                                        <th>ផ្សេងៗ</th>
                                        <th style="width:80px;">សកម្មភាព</th>
                                    </thead>
                                    <tbody>
                                      @foreach (App\UserCapital::showlink_ids($ut->link_id,$ut->tablename) as $item)
                                        <tr>
                                            <td style="border-style:none;">{{ sprintf("%04d",$item->id) }}</td>
                                            <td>
                                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                            </td>
                                            <td>{{ $item->user->name }} <br> {{ $item->useraffect->name }}</td>
                                            <td>{{ $item->partner->name }}</td>
                                            <td>{{ $item->tranname }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->sk }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->sk }}</td>
                                            <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                            <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                            <td>{{ $item->note }}</td>
                                            <td style="padding:5px;">
                                                @if(!$item->ref_group_id)
                                                  @if(str_contains($item->action,'d'))
                                                    <a href="#" class="btn btn-danger btn-sm btndeltransfer" data-id="{{ $item->id }}" data-ref_number="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                    {{-- @if (Auth::user()->role->name<>'Admin')
                                                      @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                        <a href="#" class="btn btn-danger btn-sm btndeltransfer" data-id="{{ $item->id }}" data-ref_number="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                      @endif
                                                    @else
                                                        <a href="#" class="btn btn-danger btn-sm btndeltransfer" data-id="{{ $item->id }}" data-ref_number="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                    @endif --}}
                                                  @endif
                                                @endif
                                                @if(str_contains($item->action,'u'))
                                                  <a href="{{ route('usercapital.updatetransactiongroup',['id'=>$item->id,'ref_group_id'=>$item->ref_group_id,'user_id'=>$item->user_id]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                @endif
                                            </td>
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
                                      @foreach (App\UserCapital::showlink_ids($ut->link_id,$ut->tablename) as $item)
                                        <tr>
                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                            <td>
                                                {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                            </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->frompartner->name }}</td>
                                            <td>បើកវេរ</td>
                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                            <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                            <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                            <td>{{ $item->note }}</td>
                                            <td>
                                              @if(!$item->ref_group_id)
                                                @if(str_contains($item->action,'d'))
                                                    <a href="#" class="btn btn-danger btn-sm btndelcashdraw" data-id="{{ $item->id }}" data-transfer_id="{{ $item->transfer_id }}"><i class="fa fa-trash"></i></a>
                                                    {{-- @if (Auth::user()->role->name<>'Admin')
                                                        @if (App\User::checkpermission(Auth::id(),3.7))
                                                        <a href="#" class="btn btn-danger btn-sm btndelcashdraw" data-id="{{ $item->id }}" data-transfer_id="{{ $item->transfer_id }}"><i class="fa fa-trash"></i></a>
                                                        @endif
                                                    @else
                                                        <a href="#" class="btn btn-danger btn-sm btndelcashdraw" data-id="{{ $item->id }}" data-transfer_id="{{ $item->transfer_id }}"><i class="fa fa-trash"></i></a>
                                                    @endif --}}
                                                @endif
                                              @endif
                                          </td>
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
                                        <th>លុយវេរចូល</th>
                                        <th>កាត់សេវ៉ា</th>
                                        <th>លុយបើក</th>
                                        <th>អ្នកទទួលប្រាក់</th>
                                        <th>ផ្សេងៗ</th>

                                    </thead>
                                    <tbody>
                                      @foreach (App\UserCapital::showlink_ids($ut->link_id,$ut->tablename) as $item)
                                        <tr>
                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                            <td>
                                                {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                            </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ phpformatnumber($item->thaisms->amount) . ' THB' }}</td>
                                            <td>{{ phpformatnumber($item->thaisms->amount - $item->amount). ' THB'}}</td>
                                            <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>

                                            <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                            <td>{{ $item->note }}</td>

                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            @elseif($ut->tablename=='exchanges')
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
                                      @foreach (App\UserCapital::showlink_ids($ut->link_id,$ut->tablename) as $item)
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
                                            <td>{{ $item->tranname . ' ' . $item->agentname->name??'' }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                            <td>{{ $item->note }}</td>
                                            <td style="padding:5px;">
                                              @if(str_contains($item->action,'d'))
                                                <a href="#" class="btn btn-danger btn-sm btndelusercapital" data-id="{{ $item->id }}" data-refnumber="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                {{-- @if (Auth::user()->role->name<>'Admin')
                                                  @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                    <a href="#" class="btn btn-danger btn-sm btndelusercapital" data-id="{{ $item->id }}" data-refnumber="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                  @endif
                                                @else
                                                    <a href="#" class="btn btn-danger btn-sm btndelusercapital" data-id="{{ $item->id }}" data-refnumber="{{ $item->ref_number }}"><i class="fa fa-trash"></i></a>
                                                @endif --}}
                                              @endif

                                              @if(str_contains($item->action,'u'))
                                                <a href="{{ route('usercapital.updateusercapital',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                {{-- @if (Auth::user()->role->name<>'Admin')
                                                  @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                    <a href="{{ route('usercapital.updateusercapital',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                  @endif
                                                @else
                                                    <a href="{{ route('usercapital.updateusercapital',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                @endif --}}
                                              @endif
                                          </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            @elseif($ut->tablename=='expanses')
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
                                      @foreach (App\UserCapital::showlink_ids($ut->link_id,$ut->tablename) as $item)
                                        <tr>
                                            <td>{{ sprintf("%04d",$item->id) }}</td>
                                            <td>
                                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                            </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                            <td>{{ $item->desr }}</td>
                                            {{-- <td style="padding:5px;">
                                              @if(str_contains($item->action,'d'))
                                                @if (Auth::user()->role->name<>'Admin')
                                                  @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                    <a href="#" class="btn btn-danger btn-sm btndelexpanse" data-id="{{ $item->id }}" ><i class="fa fa-trash"></i></a>
                                                  @endif
                                                @else
                                                    <a href="#" class="btn btn-danger btn-sm btndelexpanse" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                @endif
                                              @endif

                                              @if(str_contains($item->action,'u'))
                                                @if (Auth::user()->role->name<>'Admin')
                                                  @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                    <a href="{{ route('usercapital.updateexpanse',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                  @endif
                                                @else
                                                    <a href="{{ route('usercapital.updateexpanse',['id'=>$item->id,'refnumber'=>$item->ref_number]) }}" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>
                                                @endif
                                              @endif
                                          </td> --}}
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            @endif
                          </td>
                        </tr>
                @php
                    $countdata=0;
                    $datarefs=App\UserCapital::showref_number($ut->ref_number);
                    if($datarefs){
                        $countdata=1;
                    }
                @endphp

                @if($countdata>0)
                    @foreach ($datarefs as $item)

                        @if(explode("-",$ut->ref_number)[0]=='transfer')
                            <tr id="ref{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                <td colspan=12 style="padding:0px;">
                                    <table class="table table-border tbl_sub">
                                        <thead>
                                            <th style="width:80px;">TID</th>
                                            <th style="width:100px;">ថ្ងៃទី</th>
                                            <th style="width:100px;">អ្នកកត់ត្រា</th>
                                            <th style="width:200px;">ដៃគូ</th>
                                            <th style="width:120px;">ប្រតិបត្តិការណ៏</th>
                                            <th style="width:150px;">សរុបទឹកប្រាក់</th>
                                            <th style="width:120px;">សេវ៉ាដៃគូ</th>
                                            <th style="width:100px;">សេវ៉ាអតិថិជន</th>
                                            <th style="width:100px;">Sender</th>
                                            <th style="width:200px;">Receiver</th>
                                            <th>ផ្សេងៗ</th>
                                        </thead>
                                        <tbody>
                                            <tr class="kh16" style="text-align:center;">
                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                <td>
                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                </td>
                                                <td>{{ $item->user->name }} <br> {{ $item->useraffect->name }}</td>
                                                <td>{{ $item->partner->name }}</td>
                                                <td>{{ $item->tranname }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->sk }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->sk }}</td>
                                                <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                <td>{{ $item->note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>

                            </tr>
                        @elseif(explode("-",$ut->ref_number)[0]=='exchange')
                            <tr id="ref{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                <td colspan=12>
                                    <table class="table table-border tbl_sub">
                                        <thead style="text-align:center;">
                                            <th>ID</th>
                                            <th>ថ្ងៃទី</th>
                                            <th>អ្នកកត់ត្រា</th>
                                            <th>ទំនិញ</th>
                                            <th>លុយ</th>
                                            <th>អត្រា</th>
                                            <th>ផ្សេងៗ</th>
                                        </thead>
                                        <tbody>
                                            <tr class="kh16" style="text-align:center;">
                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                <td>
                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                </td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                <td>{{ $item->note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @elseif(explode("-",$ut->ref_number)[0]=='cashdraw')
                            <tr id="ref{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                <td colspan=12>
                                    <table class="table table-border tbl_sub">
                                        <thead style="text-align:center;">
                                            <th>TID</th>
                                            <th>ថ្ងៃបើក</th>
                                            <th>អ្នកកត់ត្រា</th>
                                            <th>ដៃគូ</th>
                                            <th>ប្រតិបត្តិការណ៏</th>
                                            <th>ចំនួនទឹកប្រាក់</th>
                                            <th>កាត់សេវ៉ា</th>
                                            <th>អ្នកទទួលប្រាក់</th>
                                            <th>ផ្សេងៗ</th>
                                        </thead>
                                        <tbody>
                                            <tr class="kh16" style="text-align:center;">
                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                <td>
                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                </td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->frompartner->name }}</td>
                                                <td>បើកវេរ</td>
                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->cuschargecur->shortcut }}</td>

                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                <td>{{ $item->note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @elseif(explode("-",$ut->ref_number)[0]=='usercapital')
                            <tr id="ref{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                <td colspan=12>
                                    <table class="table table-border tbl_sub">
                                        <thead style="text-align:center;">
                                            <th>ID</th>
                                            <th>ថ្ងៃទី</th>
                                            <th>អ្នកកត់ត្រា</th>
                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                            <th>បរិយាយ</th>
                                            <th>ចំនួនទឹកប្រាក់</th>
                                            <th>ផ្សេងៗ</th>
                                        </thead>
                                        <tbody>
                                            <tr class="kh16" style="text-align:center;">
                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                <td>
                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                </td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->useraffect->name }}</td>
                                                <td>{{ $item->tranname }}</td>
                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                <td>{{ $item->note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @elseif(explode("-",$ut->ref_number)[0]=='exchangelist')
                            <tr id="ref{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                <td colspan=12>
                                    <table class="table table-border tbl_sub">
                                        <thead style="text-align:center;">
                                            <th>ID</th>
                                            <th>ថ្ងៃទី</th>
                                            <th>អ្នកកត់ត្រា</th>
                                            <th>ដៃគូកាត់កង</th>
                                            <th>ទិញ</th>
                                            <th>លក់</th>
                                            <th>អត្រាព្រមព្រាង</th>
                                            <th>អត្រាគោល</th>
                                            <th>ផ្សេងៗ</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <tr class="kh16" style="text-align:center;">
                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                <td>
                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                </td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->partner->name }}</td>
                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                <td>{{ $item->agree_rate }}</td>
                                                <td>{{ $item->main_rate }}</td>
                                                <td>{{ $item->note }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-danger btn-sm btndelexchangelist" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                    {{-- @if (Auth::user()->role->name<>'Admin')
                                                      @if (App\User::checkpermission(Auth::id(),3.7))
                                                        <a href="#" class="btn btn-danger btn-sm btndelexchangelist" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                      @endif
                                                    @else
                                                        <a href="#" class="btn btn-danger btn-sm btndelexchangelist" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                    @endif --}}

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endif

                    @endforeach
                @endif
            @endforeach
            <tr style="background-color:aqua">
                <td colspan=4 style="font-size:16px;font-weight:bold;">Total</td>
                {{-- <td class="total" style="text-align:left;">{{ phpformatnumber($sumusd) . 'USD' }}</td> --}}
                <td class="total">{{ phpformatnumber($usd) . '$'}}</td>
                <td class="total">{{ phpformatnumber($thb) . 'B' }}</td>
                <td class="total">{{ phpformatnumber($khr) . 'R'}}</td>
                <td class="total">{{ phpformatnumber($vnd) . 'V'}}</td>
                <td class="total">{{ phpformatnumber($gold) . 'G' }}</td>
                <td colspan=2 class="total">0</td>
                {{-- <td class="total">{{ phpformatnumber($theylack) . '$'}}</td>
                <td class="total">{{ phpformatnumber($welack) . '$'}}</td>
                <td class="total">{{ phpformatnumber($bank) . '$'}}</td> --}}
            </tr>
        </tbody>
    </table>
{{-- </div> --}}

<div class="row" style="margin:0px;padding:0px;">
    <div class="col-lg-4">
        <div class="table-responsive">
            <table class="table table-bordered kh22-b" style="background-color:rgb(0, 255, 234);">
                @foreach ($sumfns as $key => $fn)
                    <tr>
                        {{-- <td style="text-align:center;">{{ ++$key }}</td> --}}
                        <td style="text-align:right;width:250px;">{{ phpformatnumber($fn->fn) }}</td>
                        <td>{{ $fn->shortcut }}</td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
</div>
