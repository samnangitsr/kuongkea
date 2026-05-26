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
{{-- <div class="row" style=""> --}}
    {{-- <h1 class="kh16-b">មិនទាន់បើកវេរ</h1> --}}
    <div class="table-responsive">
        <table id="tbl_notyetcashdraw" class="table table-bordered table-hover kh12-b" style="table-layout:fixed,width:100%;margin:0px;padding:0px;">
            <thead class="">
                <th>លរ</th>
                <th>TID</th>
                <th>ថ្ងៃទី</th>
                <th>ម៉ោង</th>
                <th>អ្នកកត់ត្រា</th>
                <th>ប្រតិបត្តិការណ៏</th>
                <th>ឈ្មោះដៃគូ</th>
                <th>អតិថិជន</th>
                <th>ចំនួនទឹកប្រាក់</th>
                <th>សេវ៉ាវេរ</th>
                <th>សេវ៉ាដៃគូ</th>
                <th>ពត៌មានអតិថិជន</th>
                <th>ផ្សេងៗ</th>

                <th>សកម្មភាព</th>
            </thead>
            <tbody id="bodytransfer">
                @foreach ($notyetcashdraws as $key => $d)
                        <tr class="tblnotyetcashdrawrowclick">
                            <td style="text-align:center;">{{ ++$key }}</td>
                            <td>{{ $d->id }}</td>
                            <td>{{ date('d-m-Y',strtotime($d->dd)) }}</td>
                            <td>{{ $d->tt }}</td>
                            <td>{{ $d->user->name }}</td>
                            <td>{{ $d->tranname }}</td>
                            <td>
                                @if($d->child)
                                    {{ $d->partner->name }} <br> {{ 'បន្តទៅ' . $d->child }}
                                @else
                                    {{ $d->partner->name }}
                                @endif

                            </td>
                            <td>{{ $d->customer->name }}</td>
                            <td class="kh14-b" style="text-align:right;">
                                {{ phpformatnumber(abs($d->amount)) . ' ' . $d->currency->shortcut }}
                            </td>
                            <td class="kh14-b" style="text-align:right;">
                                {{ phpformatnumber($d->cuscharge) . ' ' . $d->cuschargecur->shortcut }}
                            </td>
                            <td class="kh14-b" style="text-align:right;">
                                {{ phpformatnumber($d->fee) . ' ' . $d->currency->shortcut }}
                            </td>
                            <td>
                                @php
                                    $info1='';
                                    $info2='';
                                    if($d->recname){
                                        $info1='អ្នកទទួល:' . $d->recname;
                                    }
                                    if($d->rectel){
                                        if($info1==''){
                                            $info1='អ្នកទទួល' . $d->rectel;
                                        }else{
                                            $info1=$info1 . ' ' . $d->rectel;
                                        }
                                    }
                                    if($d->sendername){
                                        $info2='អ្នកផ្ញើ:' . $d->sendername;
                                    }
                                    if($d->sendertel){
                                        if($info2==''){
                                            $info2='អ្នកផ្ញើ' . $d->sendertel;
                                        }else{
                                            $info2=$info2 . ' ' . $d->sendertel;
                                        }
                                    }
                                @endphp
                                {{ $info1 }} <br> {{ $info2 }}
                            </td>
                            <td>{{ $d->note }}</td>

                            {{-- @if($d->ref_number==null) --}}
                                <td style="text-align:center;">

                                    {{-- <a href="{{ route('moneytransfer.opencashdraw',['id'=>$d->id]) }}" class="btn btn-warning btn-sm" target="_blank">បើកលុយ</a> --}}
                                    {{-- @if (Auth::user()->role->name<>'Admin')
                                        @if( App\User::maxdateopenmoney(Auth::id(),'4.1.5',$d->dd)>=0)
                                            <a href="#" class="mybtn btnopencashdraw" data-id="{{ $d->id }}">បើកលុយ</a>
                                            <a href="#" class="mybtn btnselectcashdraw" data-id="{{ $d->id }}">{{ App\Cashdraw::checkselect($d->id)==true?'Selected':'Select' }}</a>

                                        @endif
                                    @else
                                        <a href="#" class="mybtn btnopencashdraw" data-id="{{ $d->id }}">បើកលុយ</a>
                                        <a href="#" class="mybtn btnselectcashdraw" data-id="{{ $d->id }}">{{ App\Cashdraw::checkselect($d->id)==true?'Selected':'Select' }}</a>
                                    @endif --}}
                                    <a href="#" class="mybtn btnopencashdraw" data-id="{{ $d->id }}" data-examt="{{ number_format($d->amtinusd_upd,2,'.') }}" title="{{ number_format($d->amtinusd_upd,2,'.') }}">បើកលុយ</a>
                                    <a href="#" class="mybtn btnselectcashdraw" data-id="{{ $d->id }}" data-examt="{{ number_format($d->amtinusd_upd,2,'.') }}" title="{{ number_format($d->amtinusd_upd,2,'.') }}">{{ $d->issel_cashdraw_upd==true?'selected':'select' }}</a>

                                </td>
                            {{-- @else
                                <td style="text-align:center;background-color:yellow;">{{ $d->ref_number }}</td>
                            @endif --}}
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
{{-- </div> --}}
{{-- <div class="row" style=""> --}}
  {{-- <h1 class="kh16-b">បើកវេររួចរាល់</h1> --}}
  <div class="table-responsive">
      <table id="tbl_cashdraw" class="table table-bordered table-hover kh12-b" style="table-layout:fixed,width:100%;margin:10px 0px;padding:0px;background-color:lightgray">
          <thead class="" style="text-align:center;">
              <th style="width:60px;">លរ</th>
              <th>សកម្មភាព</th>
              <th style="width:100px;">TID</th>
              <th style="width:150px;">ថ្ងៃវេរ</th>
              <th style="width:320px;">ថ្ងៃបើក</th>
              <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
              <th style="width:150px;">ឈ្មោះដៃគូ</th>
              {{-- <th style="width:50px;">អតិថិជន</th> --}}
              <th style="width:200px;">ចំនួនទឹកប្រាក់</th>
              <th style="width:200px;">សេវ៉ាវេរ</th>
              <th style="width:200px;">សេវ៉ាដៃគូ</th>
              <th style="width:300px;">ពត៌មានអតិថិជន</th>
              <th style="width:300px;">ផ្សេងៗ</th>
              <th style="width:120px;">អ្នកកត់ត្រា</th>

          </thead>
          <tbody id="bodytransfer">
              @foreach ($cashdraws as $key => $d)
                      <tr class="rowclick">
                          <td style="text-align:center;">{{ ++$key }}</td>
                          <td style="text-align:center;">
                              {{-- <a href="{{ route('moneytransfer.opencashdraw',['id'=>$d->id]) }}" class="btn btn-warning btn-sm" target="_blank">បើកលុយ</a> --}}
                              @if(str_contains($d->action,'d'))
                                  <a href="#" class="mybtn btndelcashdraw" data-id="{{ $d->id }}" data-cashdraw_id="{{ $d->cashdraw_id }}"><i class="fa fa-trash" style="color:red;"></i></a>
                              @endif
                              <a href="#c{{ $d->id }}" class="mybtn btnviewcashdraw" data-id="{{ $d->id }}" data-bs-toggle="collapse"><i class="fa fa-eye"></i></a>
                          </td>
                          <td>{{ $d->id }}</td>
                          <td>{{ date('d-m-Y',strtotime($d->dd))}}</td>

                          <td>{{ date('d-m-Y',strtotime($d->cashdraw->opdate??$d->dd)) . ' '  }} {{ $d->cashdraw->optime??$d->tt }} {{ $d->cashdraw->user->name??'' }}</td>

                          <td>{{ $d->tranname }}</td>
                          <td>
                              @if($d->child)
                                  {{ $d->partner->name }} <br> {{ 'បន្តទៅ' . $d->child }}
                              @else
                                  {{ $d->partner->name }}
                              @endif

                          </td>
                          {{-- <td>{{ $d->customer->name }}</td> --}}
                          <td class="kh14-b" style="text-align:right;">
                              {{ phpformatnumber(abs($d->amount)) . ' ' . $d->currency->shortcut }}
                          </td>
                          <td class="kh14-b" style="text-align:right;">
                              {{ phpformatnumber($d->cuscharge) . ' ' . $d->cuschargecur->shortcut }}
                          </td>
                          <td class="kh14-b" style="text-align:right;">
                              {{ phpformatnumber($d->fee) . ' ' . $d->currency->shortcut }}
                          </td>
                          <td>
                              @php
                                  $info1='';
                                  $info2='';
                                  if($d->recname){
                                      $info1='អ្នកទទួល:' . $d->recname;
                                  }
                                  if($d->rectel){
                                      if($info1==''){
                                          $info1='អ្នកទទួល' . $d->rectel;
                                      }else{
                                          $info1=$info1 . ' ' . $d->rectel;
                                      }
                                  }
                                  if($d->sendername){
                                      $info2='អ្នកផ្ញើ:' . $d->sendername;
                                  }
                                  if($d->sendertel){
                                      if($info2==''){
                                          $info2='អ្នកផ្ញើ' . $d->sendertel;
                                      }else{
                                          $info2=$info2 . ' ' . $d->sendertel;
                                      }
                                  }
                              @endphp
                              {{ $info1 }} <br> {{ $info2 }}
                          </td>
                          <td>{{ $d->note }}</td>
                          <td>{{ $d->user->name }}</td>


                      </tr>

                      @foreach (App\Cashdraw::showcashdraw($d->id) as $item)
                          <tr id="c{{ $d->id }}" class="collapse" style="background-color:rgb(243, 191, 230);">
                              <td colspan=13>
                                  <table class="">
                                      <tr class="kh12">
                                          <th>ថ្ងៃបើក</th>
                                          <th>លុយបើក</th>
                                          <th>កាត់សេវ៉ា</th>
                                          <th>លុយត្រូវបើក</th>
                                          <th>ទូទាត់តាម</th>
                                          <th>អ្នកមកបើក</th>
                                          <th>សំគាល់</th>
                                          <th>ផ្សេងៗ</th>
                                          <th>សកម្មភាព</th>
                                      </tr>
                                      <tbody>
                                          <tr class="kh12-b">
                                              <td>
                                                  {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                              </td>
                                              <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                              <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                              <td>{{ phpformatnumber($item->amount-$item->customer_charge) . ' ' . $item->currency->shortcut }}</td>

                                              <td>{{ $item->paymethod }}</td>
                                              <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                              <td>{{ $item->note }}</td>
                                              <td>{{ $item->other }}</td>
                                              <td>
                                                <a href="#" class="mybtn btnseephoto" data-id="{{ $d->id }}" data-cashdraw_id="{{ $d->cashdraw_id }}"><i class="fa fa-address-card" style="color:black;"></i></a>
                                                  @if(str_contains($item->action,'d'))
                                                      <a href="#" class="mybtn btndelcashdraw" data-id="{{ $d->id }}" data-cashdraw_id="{{ $d->cashdraw_id }}"><i class="fa fa-trash" style="color:red;"></i></a>
                                                  @endif
                                                  @if($item->other)
                                                      <a href="{{ route('cashdraw.checkother',['id'=>$item->id,'transfer_id'=>$item->transfer_id]) }}" class="mybtn checkother" data-id="{{ $item->id }}" target="_blank">ផ្សេងៗ</a>
                                                  @endif
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </td>

                          </tr>
                      @endforeach

              @endforeach


          </tbody>
      </table>
  </div>
{{-- </div> --}}
{{-- <div class="row" style="margin-top:20px;">
    <h1 class="kh30-b">បើកធនាគា</h1>
    <div class="table-responsive">
        <table id="tbl_bankcashdraw" class="table table-bordered kh16">
            <thead class="">
                <th>លរ</th>
                <th>TID</th>
                <th>ថ្ងៃទី</th>
                <th>ម៉ោង</th>
                <th>អ្នកកត់ត្រា</th>
                <th>ប្រតិបត្តិការណ៏</th>
                <th>ឈ្មោះដៃគូ</th>
                <th>អតិថិជន</th>
                <th>ចំនួនទឹកប្រាក់</th>
                <th>សេវ៉ាវេរ</th>
                <th>សេវ៉ាដៃគូ</th>
                <th>ពត៌មានអតិថិជន</th>
                <th>ផ្សេងៗ</th>

                <th>សកម្មភាព</th>
            </thead>
            <tbody id="bodybanktransfer">
                @foreach ($bankcashdraws as $key => $d)
                        <tr class="tblbankcashdrawrowclick">
                            <td style="text-align:center;">{{ ++$key }}</td>
                            <td>{{ $d->id }}</td>
                            <td>{{ date('d-m-Y',strtotime($d->dd)) }}</td>
                            <td>{{ $d->tt }}</td>
                            <td>{{ $d->user->name }}</td>
                            <td>{{ $d->tranname }}</td>
                            <td>
                                @if($d->child)
                                    {{ $d->partner->name }} <br> {{ 'បន្តទៅ' . $d->child }}
                                @else
                                    {{ $d->partner->name }}
                                @endif

                            </td>
                            <td>{{ $d->customer->name }}</td>
                            <td class="kh18" style="text-align:right;">
                                {{ phpformatnumber(abs($d->amount))  . $d->currency->shortcut }}
                            </td>
                            <td class="kh18" style="text-align:right;">
                                {{ phpformatnumber($d->cuscharge) . $d->cuschargecur->shortcut }}
                            </td>
                            <td class="kh18" style="text-align:right;">
                                {{ phpformatnumber($d->fee) . $d->currency->shortcut }}
                            </td>
                            <td>
                                @php
                                    $info1='';
                                    $info2='';
                                    if($d->recname){
                                        $info1='អ្នកទទួល:' . $d->recname;
                                    }
                                    if($d->rectel){
                                        if($info1==''){
                                            $info1='អ្នកទទួល' . $d->rectel;
                                        }else{
                                            $info1=$info1 . ' ' . $d->rectel;
                                        }
                                    }
                                    if($d->sendername){
                                        $info2='អ្នកផ្ញើ:' . $d->sendername;
                                    }
                                    if($d->sendertel){
                                        if($info2==''){
                                            $info2='អ្នកផ្ញើ' . $d->sendertel;
                                        }else{
                                            $info2=$info2 . ' ' . $d->sendertel;
                                        }
                                    }
                                @endphp
                                {{ $info1 }} <br> {{ $info2 }}
                            </td>
                            <td>{{ $d->note }}</td>

                            @if($d->ref_number==null || $d->ref_number=='')
                                <td style="text-align:center;">
                                    @if (Auth::user()->role->name<>'Admin')
                                        @if( App\User::maxdateopenmoney(Auth::id(),'4.1.8',$d->dd)>=0)
                                            <a href="#" class="btn btn-warning btn-sm btntolist" data-id="{{ $d->id }}" data-amount="{{ $d->amount }}" data-curid="{{ $d->currency_id }}" data-partnername="{{ $d->partner->name }}">ចូលបញ្ជី</a>
                                        @endif
                                    @else
                                        <a href="#" class="btn btn-warning btn-sm btntolist" data-id="{{ $d->id }}" data-amount="{{ $d->amount }}" data-curid="{{ $d->currency_id }}" data-partnername="{{ $d->partner->name }}">ចូលបញ្ជី</a>
                                    @endif
                                </td>
                            @else
                                <td>
                                    <a href="#ref{{ $d->id }}" class="btn btn-sm btn-info" data-bs-toggle="collapse">{{ $d->ref_number }}</a>
                                </td>
                            @endif
                        </tr>
                        @if($d->ref_number!=null)
                          @php
                              $getdata=App\UserCapital::showref_number($d->ref_number);
                          @endphp
                          @if($getdata)
                            @foreach ($getdata as $item)
                              <tr id="ref{{ $d->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                  <td colspan=14>
                                      <table class="table table-border">
                                          <thead style="text-align:center;">
                                              <th>ថ្ងៃទី</th>
                                              <th>អ្នកកត់ត្រា</th>
                                              <th>ដៃគូ</th>
                                              <th>TID</th>
                                              <th>ប្រតិបត្តិការណ៏</th>
                                              <th>សរុបទឹកប្រាក់</th>
                                              <th>សេវ៉ាដៃគូ</th>
                                              <th>សេវ៉ាអតិថិជន</th>
                                              <th>Sender</th>
                                              <th>Receiver</th>
                                              <th>ផ្សេងៗ</th>
                                              <th>សកម្មភាព</th>
                                          </thead>
                                          <tbody>
                                              <tr class="kh16" style="text-align:center;">
                                                  <td>
                                                      {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                  </td>
                                                  <td>{{ $item->user->name??'' }}</td>
                                                  <td>{{ $item->partner->name??'' }}</td>
                                                  <td>{{ sprintf("%04d",$item->id) }}</td>
                                                  <td>{{ $item->tranname }}</td>
                                                  <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                  <td>{{ phpformatnumber($item->fee) . ' ' . $item->currency->shortcut }}</td>
                                                  <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                  <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                                  <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                  <td>{{ $item->note }}</td>
                                                  <td>
                                                    @if(str_contains($item->action,'d'))
                                                      <a href="#" class="btn btn-danger btn-sm btndelcashdrawbankcontinue" data-id="{{ $item->id }}" data-fromid="{{ $d->id }}"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                  </td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </td>
                              </tr>
                            @endforeach
                          @endif
                        @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div> --}}
