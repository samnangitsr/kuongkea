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
        $tusd=0;
        $tkhr=0;
        $tthb=0;
        $tvnd=0;
    @endphp
  <div class="row" style="margin-top:20px;">

      <p class="kh22-b" style="text-align:center;color:rgb(237, 19, 19);padding:0px;">បើកនៅ{{ $partnername }}</p>

      <div class="table-responsive">
          <table id="tbl_partner_list" class="table table-bordered kh16">
              <thead style="text-align:center;">
                  <th>លរ</th>
                  <th>ថ្ងៃទី</th>
                  <th>ម៉ោង</th>
                  <th>អ្នកកត់ត្រា</th>
                  <th>TID/RefNumber</th>
                  <th>ប្រតិបត្តិការណ៏</th>
                  <th>សរុបទឹកប្រាក់</th>
                  <th>រូបិយប័ណ្ណ</th>
                  <th>Sender</th>
                  <th>Receiver</th>
                  <th>ផ្សេងៗ</th>
                  <th>ចំនួនទឹកប្រាក់​</th>
                  <th>សេវ៉ា/ការប្រាក់</th>
              </thead>
              <tbody id="bodytransfer">
                @php
                    $total=0;
                    $amount=0;
                    $i=0;
                @endphp
                <tr style="background-color:gainsboro">
                    <td colspan=13 class="kh16-b">ដុល្លា</td>
                </tr>
                @if($theyopen_oldlist)
                  @foreach ($theyopen_oldlist->where('cur','USD') as $l)
                      @php
                          $total+=$l->total;
                          $amount+=$l->amount;
                          ++$i;
                      @endphp
                      <tr>
                          <td style="text-align:center;">{{ $i }}</td>
                          <td>{{ date('d-m-Y',strtotime($predate)) }}</td>
                          <td>{{ $l->tt }}</td>
                          <td>{{ $l->recordby??'' }}</td>
                          <td></td>
                          <td>{{ $l->tranname??'បញ្ជីយោង' }}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->total) }}</td>
                          <td style="" class="kh16">{{ $l->cur }}</td>
                          <td>{{ $l->sender??'' }}</td>
                          <td>
                            @if($l->desr)
                              {{ $l->desr }}
                              @if($l->note)
                                <br>
                                {{ $l->note }}
                              @endif
                            @else
                              @if($l->note)
                                {{ $l->note }}
                              @endif
                            @endif
                          </td>
                          <td>{{ $l->desr??'' . $l->note??'' }}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->fee)}}</td>
                      </tr>
                  @endforeach
                @endif
                @foreach ($theyopen_records->where('cur','USD') as $l)
                    @php
                        $total+=$l->total;
                        $amount+=$l->amount;
                        ++$i;
                    @endphp
                    <tr>
                        <td style="text-align:center;">{{ $i }}</td>
                        <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                        <td>{{ $l->tt }}</td>
                        <td>{{ $l->recordby??'' }}</td>
                        <td>
                            @if($l->idtransfer)
                              <a href="#c{{ $l->id }}" class="" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                            @endif
                            @if($l->ref_number)
                              <a href="#ref{{ $l->id }}" class="" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                            @endif
                        </td>
                        <td>{{ $l->tranname??'' }}</td>
                        <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->total) }}</td>
                        <td style="" class="kh16">{{ $l->cur }}</td>
                        <td>{{ $l->sender??'' }}</td>
                        <td>{{ $l->receive??'' }}</td>
                        <td>
                          @if($l->desr)
                            {{ $l->desr }}
                            @if($l->note)
                              <br>
                              {{ $l->note }}
                            @endif
                          @else
                            @if($l->note)
                              {{ $l->note }}
                            @endif
                          @endif
                        </td>
                        <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                        <td style="text-align:right;" class="kh16">
                            @if($l->fee && $l->fee<>0)
                              {{ phpformatnumber($l->fee) . $l->feecur}}
                            @endif
                            @if($l->interest && $l->interest<>0)
                              {{ phpformatnumber($l->interest) . $l->cur}}
                            @endif
                        </td>
                    </tr>
                    @if($l->idtransfer)
                      @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                          <tr id="c{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                              <td colspan=13>
                                  <table class="table table-border" style="margin:0px;">
                                      <thead style="text-align:center;">
                                          <th>ថ្ងៃទី</th>
                                          <th>អ្នកកត់ត្រា</th>
                                          <th>ដៃគូ</th>
                                          <th>TID</th>
                                          <th>ប្រតិបត្តិការណ៏</th>
                                          <th>សរុបទឹកប្រាក់</th>
                                          <th>សេវ៉ា/ការប្រាក់</th>
                                          <th>សេវ៉ាអតិថិជន</th>
                                          <th>Sender</th>
                                          <th>Receiver</th>
                                          <th>ផ្សេងៗ</th>
                                      </thead>
                                      <tbody>
                                          <tr class="kh16" style="text-align:center;">
                                              <td>
                                                  {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                              </td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->partner->name }}</td>
                                              <td>{{ sprintf("%04d",$item->id) }}</td>
                                              <td>{{ $item->tranname }}</td>
                                              <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                              <td>
                                                @if($item->fee && $item->fee<>0)
                                                  {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                @endif
                                                @if($item->interest && $item->interest<>0)
                                                  {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                @endif
                                              </td>
                                              <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                              <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                              <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                              <td>{{ $item->note }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </td>

                          </tr>
                      @endforeach
                    @endif
                    @if($l->ref_number)
                      @php
                          $countdata=0;
                          $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                          if($datarefs){
                            $countdata=1;
                          }
                      @endphp
                      @if($countdata>0)
                          @foreach ($datarefs as $item)
                              @if(explode("-",$l->ref_number)[0]=='transfer')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
                                              <thead style="text-align:center;">
                                                  <th>ថ្ងៃទី</th>
                                                  <th>អ្នកកត់ត្រា</th>
                                                  <th>ដៃគូ</th>
                                                  <th>TID</th>
                                                  <th>ប្រតិបត្តិការណ៏</th>
                                                  <th>សរុបទឹកប្រាក់</th>
                                                  <th>សេវ៉ា/ការប្រាក់</th>
                                                  <th>សេវ៉ាអតិថិជន</th>
                                                  <th>Sender</th>
                                                  <th>Receiver</th>
                                                  <th>ផ្សេងៗ</th>
                                              </thead>
                                              <tbody>
                                                  <tr class="kh16" style="text-align:center;">
                                                      <td>
                                                          {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                      </td>
                                                      <td>{{ $item->user->name }}</td>
                                                      <td>{{ $item->partner->name }}</td>
                                                      <td>{{ sprintf("%04d",$item->id) }}</td>
                                                      <td>{{ $item->tranname }}</td>
                                                      <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                      <td>
                                                        @if($item->fee && $item->fee<>0)
                                                          {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                        @endif
                                                        @if($item->interest && $item->interest<>0)
                                                          {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                        @endif
                                                      </td>
                                                      <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                      <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                                      <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                      <td>{{ $item->note }}</td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>

                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
                                              <thead style="text-align:center;">
                                                  <th>ID</th>
                                                  <th>ថ្ងៃទី</th>
                                                  <th>អ្នកកត់ត្រា</th>
                                                  <th>ទិញ</th>
                                                  <th>លក់</th>
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
                              @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
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
                                      </td>
                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
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
                                                      <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>

                                                      <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                      <td>{{ $item->note }}</td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>
                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
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
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>
                                  </tr>
                              @endif
                          @endforeach
                      @endif
                    @endif
                @endforeach

                <tr style="">
                    <td colspan=5 class="kh16-b">សរុប ដុល្លា</td>
                    <td colspan=2 style="text-align:right;" class="kh16-b">{{ phpformatnumber($total) . 'USD' }}</td>
                    <td class="kh16-b">USD</td>
                    <td colspan=2></td>
                    <td colspan=2 class="kh16-b" style="text-align:right;">{{ phpformatnumber($amount) .'USD'}}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total-$amount) }}</td>
                </tr>
                {{--  THB --}}
                @php
                    $total=0;
                    $amount=0;
                    $i=0;
                @endphp
                <tr style="background-color:gainsboro">
                    <td colspan=13 class="kh16-b">បាត</td>
                </tr>
                @if($theyopen_oldlist)
                  @foreach ($theyopen_oldlist->where('cur','THB') as $l)
                      @php
                          $total+=$l->total;
                          $amount+=$l->amount;
                          ++$i;
                      @endphp
                      <tr>
                          <td style="text-align:center;">{{ $i }}</td>
                          <td>{{ date('d-m-Y',strtotime($predate)) }}</td>
                          <td>{{ $l->tt }}</td>
                          <td>{{ $l->recordby??'' }}</td>
                          <td></td>
                          <td>{{ $l->tranname??'បញ្ជីយោង' }}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->total) }}</td>
                          <td style="" class="kh16">{{ $l->cur }}</td>
                          <td>{{ $l->sender??'' }}</td>
                          <td>
                            @if($l->desr)
                              {{ $l->desr }}
                              @if($l->note)
                                <br>
                                {{ $l->note }}
                              @endif
                            @else
                              @if($l->note)
                                {{ $l->note }}
                              @endif
                            @endif
                          </td>
                          <td>{{ $l->desr??'' . $l->note??'' }}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->fee)}}</td>
                      </tr>
                  @endforeach
                @endif
                @foreach ($theyopen_records->where('cur','THB') as $l)
                    @php
                        $total+=$l->total;
                        $amount+=$l->amount;
                        ++$i;
                    @endphp
                    <tr>
                        <td style="text-align:center;">{{ $i }}</td>
                        <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                        <td>{{ $l->tt }}</td>
                        <td>{{ $l->recordby??'' }}</td>
                        <td>
                            @if($l->idtransfer)
                              <a href="#c{{ $l->id }}" class="" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                            @endif
                            @if($l->ref_number)
                              <a href="#ref{{ $l->id }}" class="" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                            @endif
                        </td>
                        <td>{{ $l->tranname??'' }}</td>
                        <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->total) }}</td>
                        <td style="" class="kh16">{{ $l->cur }}</td>
                        <td>{{ $l->sender??'' }}</td>
                        <td>{{ $l->receive??'' }}</td>
                        <td>
                          @if($l->desr)
                            {{ $l->desr }}
                            @if($l->note)
                              <br>
                              {{ $l->note }}
                            @endif
                          @else
                            @if($l->note)
                              {{ $l->note }}
                            @endif
                          @endif
                        </td>
                        <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                        <td style="text-align:right;" class="kh16">
                          @if($l->fee && $l->fee<>0)
                            {{ phpformatnumber($l->fee) . $l->feecur}}
                          @endif
                          @if($l->interest && $l->interest<>0)
                            {{ phpformatnumber($l->interest) . $l->cur}}
                          @endif
                      </td>
                    </tr>
                    @if($l->idtransfer)
                      @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                          <tr id="c{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                              <td colspan=13>
                                  <table class="table table-border">
                                      <thead style="text-align:center;">
                                          <th>ថ្ងៃទី</th>
                                          <th>អ្នកកត់ត្រា</th>
                                          <th>ដៃគូ</th>
                                          <th>TID</th>
                                          <th>ប្រតិបត្តិការណ៏</th>
                                          <th>សរុបទឹកប្រាក់</th>
                                          <th>សេវ៉ា/ការប្រាក់</th>
                                          <th>សេវ៉ាអតិថិជន</th>
                                          <th>Sender</th>
                                          <th>Receiver</th>
                                          <th>ផ្សេងៗ</th>
                                      </thead>
                                      <tbody>
                                          <tr class="kh16" style="text-align:center;">
                                              <td>
                                                  {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                              </td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->partner->name }}</td>
                                              <td>{{ sprintf("%04d",$item->id) }}</td>
                                              <td>{{ $item->tranname }}</td>
                                              <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                              <td>
                                                @if($item->fee && $item->fee<>0)
                                                  {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                @endif
                                                @if($item->interest && $item->interest<>0)
                                                  {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                @endif
                                              </td>
                                              <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                              <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                              <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                              <td>{{ $item->note }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </td>

                          </tr>
                      @endforeach
                    @endif
                    @if($l->ref_number)
                      @php
                          $countdata=0;
                          $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                          if($datarefs){
                            $countdata=1;
                          }
                      @endphp
                      @if($countdata>0)
                          @foreach ($datarefs as $item)
                              @if(explode("-",$l->ref_number)[0]=='transfer')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
                                              <thead style="text-align:center;">
                                                  <th>ថ្ងៃទី</th>
                                                  <th>អ្នកកត់ត្រា</th>
                                                  <th>ដៃគូ</th>
                                                  <th>TID</th>
                                                  <th>ប្រតិបត្តិការណ៏</th>
                                                  <th>សរុបទឹកប្រាក់</th>
                                                  <th>សេវ៉ា/ការប្រាក់</th>
                                                  <th>សេវ៉ាអតិថិជន</th>
                                                  <th>Sender</th>
                                                  <th>Receiver</th>
                                                  <th>ផ្សេងៗ</th>
                                              </thead>
                                              <tbody>
                                                  <tr class="kh16" style="text-align:center;">
                                                      <td>
                                                          {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                      </td>
                                                      <td>{{ $item->user->name }}</td>
                                                      <td>{{ $item->partner->name }}</td>
                                                      <td>{{ sprintf("%04d",$item->id) }}</td>
                                                      <td>{{ $item->tranname }}</td>
                                                      <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                      <td>
                                                        @if($item->fee && $item->fee<>0)
                                                          {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                        @endif
                                                        @if($item->interest && $item->interest<>0)
                                                          {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                        @endif
                                                      </td>
                                                      <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                      <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                                      <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                      <td>{{ $item->note }}</td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>

                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
                                              <thead style="text-align:center;">
                                                  <th>ID</th>
                                                  <th>ថ្ងៃទី</th>
                                                  <th>អ្នកកត់ត្រា</th>
                                                  <th>ទិញ</th>
                                                  <th>លក់</th>
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
                              @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
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
                                      </td>
                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
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
                                                      <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>

                                                      <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                      <td>{{ $item->note }}</td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>
                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
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
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>
                                  </tr>
                              @endif
                          @endforeach
                      @endif
                    @endif
                @endforeach

                <tr style="">
                    <td colspan=5 class="kh16-b">សរុប បាត</td>
                    <td colspan=2 style="text-align:right;" class="kh16-b">{{ phpformatnumber($total) . 'THB' }}</td>
                    <td class="kh16-b">THB</td>
                    <td colspan=2></td>
                    <td colspan=2 class="kh16-b" style="text-align:right;">{{ phpformatnumber($amount) .'THB'}}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total-$amount) }}</td>
                </tr>
                {{-- KHR --}}
                @php
                    $total=0;
                    $amount=0;
                    $i=0;
                @endphp
                <tr style="background-color:gainsboro">
                    <td colspan=13 class="kh16-b">រៀល</td>
                </tr>
                @if($theyopen_oldlist)
                  @foreach ($theyopen_oldlist->where('cur','KHR') as $l)
                      @php
                          $total+=$l->total;
                          $amount+=$l->amount;
                          ++$i;
                      @endphp
                      <tr>
                          <td style="text-align:center;">{{ $i }}</td>
                          <td>{{ date('d-m-Y',strtotime($predate)) }}</td>
                          <td>{{ $l->tt }}</td>
                          <td>{{ $l->recordby??'' }}</td>
                          <td></td>
                          <td>{{ $l->tranname??'បញ្ជីយោង' }}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->total) }}</td>
                          <td style="" class="kh16">{{ $l->cur }}</td>
                          <td>{{ $l->sender??'' }}</td>
                          <td>
                            @if($l->desr)
                              {{ $l->desr }}
                              @if($l->note)
                                <br>
                                {{ $l->note }}
                              @endif
                            @else
                              @if($l->note)
                                {{ $l->note }}
                              @endif
                            @endif
                          </td>
                          <td>{{ $l->desr??'' . $l->note??'' }}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->fee)}}</td>
                      </tr>
                  @endforeach
                @endif
                @foreach ($theyopen_records->where('cur','KHR') as $l)
                    @php
                        $total+=$l->total;
                        $amount+=$l->amount;
                        ++$i;
                    @endphp
                    <tr>
                        <td style="text-align:center;">{{ $i }}</td>
                        <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                        <td>{{ $l->tt }}</td>
                        <td>{{ $l->recordby??'' }}</td>
                        <td>
                            @if($l->idtransfer)
                              <a href="#c{{ $l->id }}" class="" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                            @endif
                            @if($l->ref_number)
                              <a href="#ref{{ $l->id }}" class="" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                            @endif
                        </td>
                        <td>{{ $l->tranname??'' }}</td>
                        <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->total) }}</td>
                        <td style="" class="kh16">{{ $l->cur }}</td>
                        <td>{{ $l->sender??'' }}</td>
                        <td>{{ $l->receive??'' }}</td>
                        <td>
                          @if($l->desr)
                            {{ $l->desr }}
                            @if($l->note)
                              <br>
                              {{ $l->note }}
                            @endif
                          @else
                            @if($l->note)
                              {{ $l->note }}
                            @endif
                          @endif
                        </td>
                        <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                        <td style="text-align:right;" class="kh16">
                          @if($l->fee && $l->fee<>0)
                            {{ phpformatnumber($l->fee) . $l->feecur}}
                          @endif
                          @if($l->interest && $l->interest<>0)
                            {{ phpformatnumber($l->interest) . $l->cur}}
                          @endif
                        </td>
                    </tr>
                    @if($l->idtransfer)
                      @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                          <tr id="c{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                              <td colspan=13>
                                  <table class="table table-border">
                                      <thead style="text-align:center;">
                                          <th>ថ្ងៃទី</th>
                                          <th>អ្នកកត់ត្រា</th>
                                          <th>ដៃគូ</th>
                                          <th>TID</th>
                                          <th>ប្រតិបត្តិការណ៏</th>
                                          <th>សរុបទឹកប្រាក់</th>
                                          <th>សេវ៉ា/ការប្រាក់</th>
                                          <th>សេវ៉ាអតិថិជន</th>
                                          <th>Sender</th>
                                          <th>Receiver</th>
                                          <th>ផ្សេងៗ</th>
                                      </thead>
                                      <tbody>
                                          <tr class="kh16" style="text-align:center;">
                                              <td>
                                                  {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                              </td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->partner->name }}</td>
                                              <td>{{ sprintf("%04d",$item->id) }}</td>
                                              <td>{{ $item->tranname }}</td>
                                              <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                              <td>
                                                @if($item->fee && $item->fee<>0)
                                                  {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                @endif
                                                @if($item->interest && $item->interest<>0)
                                                  {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                @endif
                                              </td>
                                              <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                              <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                              <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                              <td>{{ $item->note }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </td>

                          </tr>
                      @endforeach
                    @endif
                    @if($l->ref_number)
                      @php
                          $countdata=0;
                          $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                          if($datarefs){
                            $countdata=1;
                          }
                      @endphp
                      @if($countdata>0)
                          @foreach ($datarefs as $item)
                              @if(explode("-",$l->ref_number)[0]=='transfer')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
                                              <thead style="text-align:center;">
                                                  <th>ថ្ងៃទី</th>
                                                  <th>អ្នកកត់ត្រា</th>
                                                  <th>ដៃគូ</th>
                                                  <th>TID</th>
                                                  <th>ប្រតិបត្តិការណ៏</th>
                                                  <th>សរុបទឹកប្រាក់</th>
                                                  <th>សេវ៉ា/ការប្រាក់</th>
                                                  <th>សេវ៉ាអតិថិជន</th>
                                                  <th>Sender</th>
                                                  <th>Receiver</th>
                                                  <th>ផ្សេងៗ</th>
                                              </thead>
                                              <tbody>
                                                  <tr class="kh16" style="text-align:center;">
                                                      <td>
                                                          {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                      </td>
                                                      <td>{{ $item->user->name }}</td>
                                                      <td>{{ $item->partner->name }}</td>
                                                      <td>{{ sprintf("%04d",$item->id) }}</td>
                                                      <td>{{ $item->tranname }}</td>
                                                      <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                      <td>
                                                        @if($item->fee && $item->fee<>0)
                                                          {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                        @endif
                                                        @if($item->interest && $item->interest<>0)
                                                          {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                        @endif
                                                      </td>
                                                      <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                      <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                                      <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                      <td>{{ $item->note }}</td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>

                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
                                              <thead style="text-align:center;">
                                                  <th>ID</th>
                                                  <th>ថ្ងៃទី</th>
                                                  <th>អ្នកកត់ត្រា</th>
                                                  <th>ទិញ</th>
                                                  <th>លក់</th>
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
                              @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
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
                                      </td>
                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
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
                                                      <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>

                                                      <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                      <td>{{ $item->note }}</td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>
                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
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
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>
                                  </tr>
                              @endif
                          @endforeach
                      @endif
                    @endif
                @endforeach

                <tr style="">
                    <td colspan=5 class="kh16-b">សរុប រៀល</td>
                    <td colspan=2 style="text-align:right;" class="kh16-b">{{ phpformatnumber($total) . 'KHR' }}</td>
                    <td class="kh16-b">KHR</td>
                    <td colspan=2></td>
                    <td colspan=2 class="kh16-b" style="text-align:right;">{{ phpformatnumber($amount) .'KHR'}}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total-$amount) }}</td>
                </tr>
                {{-- VND --}}
                @php
                    $total=0;
                    $amount=0;
                    $i=0;
                @endphp
                <tr style="background-color:gainsboro">
                    <td colspan=13 class="kh16-b">ដុង</td>
                </tr>
                @if($theyopen_oldlist)
                  @foreach ($theyopen_oldlist->where('cur','VND') as $l)
                      @php
                          $total+=$l->total;
                          $amount+=$l->amount;
                          ++$i;
                      @endphp
                      <tr>
                          <td style="text-align:center;">{{ $i }}</td>
                          <td>{{ date('d-m-Y',strtotime($predate)) }}</td>
                          <td>{{ $l->tt }}</td>
                          <td>{{ $l->recordby??'' }}</td>
                          <td></td>
                          <td>{{ $l->tranname??'បញ្ជីយោង' }}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->total) }}</td>
                          <td style="" class="kh16">{{ $l->cur }}</td>
                          <td>{{ $l->sender??'' }}</td>
                          <td>
                            @if($l->desr)
                              {{ $l->desr }}
                              @if($l->note)
                                <br>
                                {{ $l->note }}
                              @endif
                            @else
                              @if($l->note)
                                {{ $l->note }}
                              @endif
                            @endif
                          </td>
                          <td>{{ $l->desr??'' . $l->note??'' }}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                          <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->fee)}}</td>
                      </tr>
                  @endforeach
                @endif
                @foreach ($theyopen_records->where('cur','VND') as $l)
                    @php
                        $total+=$l->total;
                        $amount+=$l->amount;
                        ++$i;
                    @endphp
                    <tr>
                        <td style="text-align:center;">{{ $i }}</td>
                        <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                        <td>{{ $l->tt }}</td>
                        <td>{{ $l->recordby??'' }}</td>
                        <td>
                            @if($l->idtransfer)
                              <a href="#c{{ $l->id }}" class="" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                            @endif
                            @if($l->ref_number)
                              <a href="#ref{{ $l->id }}" class="" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                            @endif
                        </td>
                        <td>{{ $l->tranname??'' }}</td>
                        <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->total) }}</td>
                        <td style="" class="kh16">{{ $l->cur }}</td>
                        <td>{{ $l->sender??'' }}</td>
                        <td>{{ $l->receive??'' }}</td>
                        <td>
                          @if($l->desr)
                            {{ $l->desr }}
                            @if($l->note)
                              <br>
                              {{ $l->note }}
                            @endif
                          @else
                            @if($l->note)
                              {{ $l->note }}
                            @endif
                          @endif
                        </td>
                        <td style="text-align:right;" class="kh16">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                        <td style="text-align:right;" class="kh16">
                          @if($l->fee && $l->fee<>0)
                            {{ phpformatnumber($l->fee) . $l->feecur}}
                          @endif
                          @if($l->interest && $l->interest<>0)
                            {{ phpformatnumber($l->interest) . $l->cur}}
                          @endif
                        </td>

                    </tr>
                    @if($l->idtransfer)
                      @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                          <tr id="c{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                              <td colspan=13>
                                  <table class="table table-border">
                                      <thead style="text-align:center;">
                                          <th>ថ្ងៃទី</th>
                                          <th>អ្នកកត់ត្រា</th>
                                          <th>ដៃគូ</th>
                                          <th>TID</th>
                                          <th>ប្រតិបត្តិការណ៏</th>
                                          <th>សរុបទឹកប្រាក់</th>
                                          <th>សេវ៉ា/ការប្រាក់</th>
                                          <th>សេវ៉ាអតិថិជន</th>
                                          <th>Sender</th>
                                          <th>Receiver</th>
                                          <th>ផ្សេងៗ</th>
                                      </thead>
                                      <tbody>
                                          <tr class="kh16" style="text-align:center;">
                                              <td>
                                                  {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                              </td>
                                              <td>{{ $item->user->name }}</td>
                                              <td>{{ $item->partner->name }}</td>
                                              <td>{{ sprintf("%04d",$item->id) }}</td>
                                              <td>{{ $item->tranname }}</td>
                                              <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                              <td>
                                                @if($item->fee && $item->fee<>0)
                                                  {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                @endif
                                                @if($item->interest && $item->interest<>0)
                                                  {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                @endif
                                              </td>
                                              <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                              <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                              <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                              <td>{{ $item->note }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </td>

                          </tr>
                      @endforeach
                    @endif
                    @if($l->ref_number)
                      @php
                          $countdata=0;
                          $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                          if($datarefs){
                            $countdata=1;
                          }
                      @endphp
                      @if($countdata>0)
                          @foreach ($datarefs as $item)
                              @if(explode("-",$l->ref_number)[0]=='transfer')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
                                              <thead style="text-align:center;">
                                                  <th>ថ្ងៃទី</th>
                                                  <th>អ្នកកត់ត្រា</th>
                                                  <th>ដៃគូ</th>
                                                  <th>TID</th>
                                                  <th>ប្រតិបត្តិការណ៏</th>
                                                  <th>សរុបទឹកប្រាក់</th>
                                                  <th>សេវ៉ា/ការប្រាក់</th>
                                                  <th>សេវ៉ាអតិថិជន</th>
                                                  <th>Sender</th>
                                                  <th>Receiver</th>
                                                  <th>ផ្សេងៗ</th>
                                              </thead>
                                              <tbody>
                                                  <tr class="kh16" style="text-align:center;">
                                                      <td>
                                                          {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                      </td>
                                                      <td>{{ $item->user->name }}</td>
                                                      <td>{{ $item->partner->name }}</td>
                                                      <td>{{ sprintf("%04d",$item->id) }}</td>
                                                      <td>{{ $item->tranname }}</td>
                                                      <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                      <td>
                                                        @if($item->fee && $item->fee<>0)
                                                          {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                        @endif
                                                        @if($item->interest && $item->interest<>0)
                                                          {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                        @endif
                                                      </td>
                                                      <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                      <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                                      <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                      <td>{{ $item->note }}</td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>

                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
                                              <thead style="text-align:center;">
                                                  <th>ID</th>
                                                  <th>ថ្ងៃទី</th>
                                                  <th>អ្នកកត់ត្រា</th>
                                                  <th>ទិញ</th>
                                                  <th>លក់</th>
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
                              @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
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
                                      </td>
                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
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
                                                      <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>

                                                      <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                      <td>{{ $item->note }}</td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>
                                  </tr>
                              @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                  <tr id="ref{{ $l->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=13>
                                          <table class="table table-border">
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
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </td>
                                  </tr>
                              @endif
                          @endforeach
                      @endif
                    @endif
                @endforeach

                <tr style="">
                    <td colspan=5 class="kh16-b">សរុប ដុង</td>
                    <td colspan=2 style="text-align:right;" class="kh16-b">{{ phpformatnumber($total) . 'VND' }}</td>
                    <td class="kh16-b">VND</td>
                    <td colspan=2></td>
                    <td colspan=2 class="kh16-b" style="text-align:right;">{{ phpformatnumber($amount) .'VND'}}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total-$amount) }}</td>
                </tr>
            </tbody>
          </table>
      </div>
  </div>
  <div class="row">
    <div class="card">
        <div class="card-title">
            <h1 class="kh26-b" style="text-align:center;margin-top:20px;">ក្រោយទូទាត់</h1>
        </div>
        <div class="card-body">
            <div class="row" style="margin-top:-20px;">
                <div class="col-lg-6">
                    @php
                        $usd1=0;
                        $thb1=0;
                        $khr1=0;
                        $vnd1=0;
                        $usd2=0;
                        $thb2=0;
                        $khr2=0;
                        $vnd2=0;
                        foreach($aftertotal as $a){
                            if($a->cur=='USD'){
                                if($a->total>0){
                                    $usd2=$a->total;
                                }else{
                                    $usd1=$a->total;
                                }

                            }else if($a->cur=='THB'){
                                if($a->total>0){
                                    $thb2=$a->total;
                                }else{
                                    $thb1=$a->total;
                                }
                            }else if($a->cur=='KHR'){
                                if($a->total>0){
                                    $khr2=$a->total;
                                }else{
                                    $khr1=$a->total;
                                }
                            }else if($a->cur=='VND'){
                                if($a->total>0){
                                    $vnd2=$a->total;
                                }else{
                                    $vnd1=$a->total;
                                }
                            }
                        }
                    @endphp

                    <table id="tbl_after_total_we" class="table table-bordered kh22-b">
                        <tr style="background-color:azure">
                            <td class="kh22" style="text-align:center">នៅខ្វះ {{ $logo->name }}</td>
                        </tr>

                        <tr>
                            <td style="text-align:right;">
                                {{ phpformatnumber($usd1) . ' USD' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">
                                {{ phpformatnumber($thb1) . ' THB' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">
                                {{ phpformatnumber($khr1) . ' KHR' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">
                                {{ phpformatnumber($vnd1) . ' VND' }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">


                    <table id="tbl_after_total_they" class="table table-bordered kh22-b">
                        <tr style="background-color:azure">
                            <td class="kh22" style="text-align:center">នៅខ្វះ {{ $partnername }}</td>
                        </tr>

                        <tr>
                            <td style="text-align:right;">
                                {{ phpformatnumber($usd2) . ' USD' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">
                                {{ phpformatnumber($thb2) . ' THB' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">
                                {{ phpformatnumber($khr2) . ' KHR' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">
                                {{ phpformatnumber($vnd2) . ' VND' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="row" style="">
      <div class="card" style="">
          <div class="card-title">
              <h1 class="kh26-b" style="text-align:center;margin-top:10px;padding:0px;">មុនទូទាត់</h1>
          </div>
          <div class="card-body">
              <div class="row" style="margin-top:-20px;">
                  <div class="col-lg-6">
                      @php
                          $weusd=0;
                          $wethb=0;
                          $wekhr=0;
                          $wevnd=0;
                          foreach($befortotalwe as $w){
                              if($w->cur=='USD'){
                                  $weusd=$w->total;
                              }else if($w->cur=='THB'){
                                  $wethb=$w->total;
                              }else if($w->cur=='KHR'){
                                  $wekhr=$w->total;
                              }else if($w->cur=='VND'){
                                  $wevnd=$w->total;
                              }
                          }
                      @endphp

                      <table id="tbl_before_total_we" class="table table-bordered kh22-b">
                          <tr style="background-color:azure">
                              <td class="kh22" style="text-align:center">សរុបបើកនៅ {{ $logo->name }}</td>
                          </tr>

                          <tr>
                              <td style="text-align:right;">
                                  {{ phpformatnumber($weusd) . ' USD' }}
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align:right;">
                                  {{ phpformatnumber($wethb) . ' THB' }}
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align:right;">
                                  {{ phpformatnumber($wekhr) . ' KHR' }}
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align:right;">
                                  {{ phpformatnumber($wevnd) . ' VND' }}
                              </td>
                          </tr>
                      </table>
                  </div>
                  <div class="col-lg-6">
                      @php
                          $theyusd=0;
                          $theythb=0;
                          $theykhr=0;
                          $theyvnd=0;
                          foreach($befortotalthey as $they){
                              if($they->cur=='USD'){
                                  $theyusd=$they->total;
                              }else if($they->cur=='THB'){
                                  $theythb=$they->total;
                              }else if($they->cur=='KHR'){
                                  $theykhr=$they->total;
                              }else if($they->cur=='VND'){
                                  $theyvnd=$they->total;
                              }
                          }
                      @endphp

                      <table id="tbl_before_total_they" class="table table-bordered kh22-b">
                          <tr style="background-color:azure">
                              <td class="kh22" style="text-align:center">សរុបបើកនៅ {{ $partnername }}</td>
                          </tr>

                          <tr>
                              <td style="text-align:right;">
                                  {{ phpformatnumber($theyusd) . ' USD' }}
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align:right;">
                                  {{ phpformatnumber($theythb) . ' THB' }}
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align:right;">
                                  {{ phpformatnumber($theykhr) . ' KHR' }}
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align:right;">
                                  {{ phpformatnumber($theyvnd) . ' VND' }}
                              </td>
                          </tr>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
