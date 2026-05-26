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
<div class="table-responsive">
    <table class="table table-bordered kh16 tbl_usertransaction">
        <thead style="text-align:center;">
            <th>No</th>
            <th>Time</th>
            <th>TranName</th>
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
            @endphp
            @foreach ($usertransactions as $key => $ut)
                <tr>
                    @php
                        $usd+=$ut->usd;
                        $gold+=$ut->gold;
                        $khr+=$ut->khr;
                        $thb+=$ut->thb;
                        $vnd+=$ut->vnd;
                        $theylack+=$ut->theylack;
                        $welack+=$ut->welack;
                        $bank+=$ut->paybybank;
                        $sumusd+=$ut->usd+$ut->theylack+$ut->welack+$ut->paybybank;
                    @endphp
                    <td class="en16" style="text-align:center;">{{ ++$key }}</td>
                    <td class="en16" style="text-align:center;">{{ $ut->tt }}</td>
                    <td class="kh16-b">
                        <a class="btn btn-info btn-sm" href="#linkid{{ $ut->id }}" data-bs-toggle="collapse" title="{{ $ut->link_id }}">{{ $ut->tranname }}</a>
                    </td>
                    <td class="amt @if($ut->gold>=0) blue @else red @endif">@if($ut->gold<>0) {{ phpformatnumber($ut->gold) . 'G' }} @endif </td>
                    <td class="amt @if($ut->usd>=0) blue @else red @endif">@if($ut->usd<>0){{ phpformatnumber($ut->usd) . '$' }} @endif</td>
                    <td class="amt @if($ut->thb>=0) blue @else red @endif">@if($ut->thb<>0) {{ phpformatnumber($ut->thb) . 'B' }} @endif</td>
                    <td class="amt @if($ut->khr>=0) blue @else red @endif">@if($ut->khr<>0){{ phpformatnumber($ut->khr) . 'R' }} @endif</td>
                    <td class="amt @if($ut->vnd>=0) blue @else red @endif">@if($ut->vnd<>0){{ phpformatnumber($ut->vnd) . 'V' }}@endif</td>
                    <td class="amt @if($ut->vnd>=0) blue @else red @endif">
                        @if($ut->fn<>'0')
                          {{ phpformatnumber($ut->fn) . $ut->shortcut }}
                        @else

                        @endif

                    </td>

                    {{-- <td class="amt">{{ phpformatnumber($ut->theylack) . '$' }}</td>
                    <td class="amt">{{ phpformatnumber($ut->welack) . '$' }}</td>
                    <td class="amt">{{ phpformatnumber($ut->paybybank) . '$' }}</td> --}}
                    <td>{{ $ut->desr }}</td>
                </tr>
                @foreach (App\UserCapital::showlink_ids($ut->link_id,$ut->tablename) as $item)
                  <tr id="linkid{{ $ut->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                      <td colspan=10>
                          @if($ut->tablename=='partner_transfers')
                              <table class="table table-border">
                                  <thead style="text-align:center;">
                                      <th>TID</th>
                                      <th>ថ្ងៃទី</th>
                                      <th>អ្នកកត់ត្រា</th>
                                      <th>ដៃគូ</th>
                                      <th>ប្រតិបត្តិការណ៏</th>
                                      <th>សរុបទឹកប្រាក់</th>
                                      <th>សេវ៉ាដៃគូ</th>
                                      <th>សេវ៉ាអតិថិជន</th>
                                      <th>Sender</th>
                                      <th>Receiver</th>
                                      <th>ផ្សេងៗ</th>
                                  </thead>
                                  <tbody>
                                      <tr class="kh16" style="text-align:center;">
                                          <td>{{ sprintf("%04d",$item->id) }}</td>
                                          <td>
                                              {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                          </td>
                                          <td>{{ $item->user->name }}</td>
                                          <td>{{ $item->partner->name }}</td>
                                          <td>{{ $item->tranname }}</td>
                                          <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                          <td>{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}</td>
                                          <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                          <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                          <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                          <td>{{ $item->note }}</td>
                                      </tr>
                                  </tbody>
                              </table>
                          @elseif($ut->tablename=='cashdraws')
                              <table class="table table-border">
                                  <thead style="text-align:center;">
                                      <th>TID</th>
                                      <th>ថ្ងៃបើក</th>
                                      <th>អ្នកកត់ត្រា</th>
                                      <th>ដៃគូ</th>
                                      <th>ប្រតិបត្តិការណ៏</th>
                                      <th>សរុបទឹកប្រាក់</th>
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
                                          <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                          <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                          <td>{{ $item->note }}</td>
                                      </tr>
                                  </tbody>
                              </table>
                          @elseif($ut->tablename=='exchanges')
                              <table class="table table-border">
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
                                          <td>{{ sprintf("%04d",$item->id) }}</td>
                                          <td>
                                              {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                          </td>
                                          <td>{{ $item->user->name }}</td>
                                          <td>{{ phpformatnumber($item->product) . ' ' . $item->pcur }}</td>
                                          <td>{{ phpformatnumber($item->amount) . ' ' . $item->maincur }}</td>
                                          <td>{{ phpformatnumber($item->rate) . '(' . phpformatnumber($item->drate). ')'}}</td>
                                          <td>{{ $item->note }}</td>
                                      </tr>
                                  </tbody>
                              </table>
                          @elseif($ut->tablename=='user_capitals')
                              <table class="table table-border">
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
                          @endif
                      </td>

                  </tr>
                @endforeach
            @endforeach
            <tr style="background-color:aqua">
                <td colspan=3 style="font-size:22px;font-weight:bold;">Total</td>
                {{-- <td class="total" style="text-align:left;">{{ phpformatnumber($sumusd) . 'USD' }}</td> --}}
                <td class="total">{{ phpformatnumber($gold) . 'G' }}</td>
                <td class="total">{{ phpformatnumber($usd) . '$'}}</td>
                <td class="total">{{ phpformatnumber($thb) . 'B' }}</td>
                <td class="total">{{ phpformatnumber($khr) . 'R'}}</td>
                <td class="total">{{ phpformatnumber($vnd) . 'V'}}</td>
                <td colspan=2 class="total">0</td>
                {{-- <td class="total">{{ phpformatnumber($theylack) . '$'}}</td>
                <td class="total">{{ phpformatnumber($welack) . '$'}}</td>
                <td class="total">{{ phpformatnumber($bank) . '$'}}</td> --}}
            </tr>
        </tbody>
    </table>
</div>
<div class="row">
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
