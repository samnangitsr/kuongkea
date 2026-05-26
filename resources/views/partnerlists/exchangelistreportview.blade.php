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
@php
      $left_in=0;
      $left_out=0;
      $left_in_group=0;
      $left_out_group=0;
    @endphp
<div class="col-lg-6">
  <div class="table-responsive">
      <table id="tblin" class="table kh16-b tblin">
          <thead style="">
              <th>N <sup>o</sup></th>
              <th>ID</th>
              <th style="display:none;">PartnerID</th>
              <th>ឈ្មោះដៃគូ</th>
              <th>អ្នកកាត់កង</th>
              <th>លុយសល់</th>
              <th style="text-align:right;">ទិញចូល</th>
              <th style="display:none;">CURID</th>
          </thead>
          <tbody id="">
              @php
                  $i=0;
                  $curbuy='';
                  $cur_id='';
                  $pname='';
                  $totalbuy=0;
                  $luybuy=0;
                  $totalbuy_group=0;
                  $luyby_group=0;
                  $money_left=0;
                  $total_left=0;
              @endphp
              @foreach ($csc1 as $ckey =>$cs1)
                @php
                    $totalbuy_group=0;
                    $luybuy_group=0;
                    $left_in_group=0;
                    $money_left=0;
                    $pname=$cs1['partnername'];
                @endphp
                {{-- @foreach ($exchangelefts->where('product','>','0') as $key => $e)
                    @php
                        $curbuy=$e->currency->shortcut;
                    @endphp
                    <tr class="rows" style="background-color:aqua">
                        <td>0</td>
                        <td style="width:80px;">
                          <a class="" href="#buy{{ $e->id }}" data-bs-toggle="collapse" style=" text-decoration:underline;">{{ $e->id }}</a>
                        </td>
                        <td style="display:none">{{ $e->partner_id }}</td>
                        <td>{{ '('. $e->partner_id .')' . $e->partner->name }} <br> <span class="kh12-b">{{ date('d-m-Y',strtotime($e->dd)) }}</span> </td>
                        <td>
                          {{ $e->user->name }}
                          <br><span class="kh12-b">{{ $e->tt }}</span>
                        </td>
                        <td>
                          {{ phpformatnumber(abs($e->product)-abs($e->p_inout)) . $e->currency->shortcut }}
                          <br><span>({{ phpformatnumber($e->rate) }})</span>
                        </td>
                        <td style="color:blue;text-align:right;">
                            +{{ phpformatnumber($e->product) . ' ' . $e->currency->shortcut }}
                          <br>
                          <span style="color:red">
                            {{ phpformatnumber($e->amount) . ' ' . $e->maincur }}
                          </span>
                        </td>
                        <td style="display:none">{{ $e->currency_id }}</td>
                    </tr>
                    @php
                        $countdata=0;
                        $datarefs=App\Exchange::showexchangeidfromtransfer($e->id);
                        if($datarefs){
                            $countdata=1;
                        }
                    @endphp
                    @if($countdata>0)
                        @php
                            $total1=0;
                            $left1=$e->product;
                        @endphp
                        @foreach ($datarefs as $item)
                          @php
                              $total1+=$item->amount;
                              $left1-=$item->amount;
                          @endphp
                          <tr id="buy{{ $e->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                              <td></td>
                              <td class="kh12-b">{{ sprintf("%04d",$item->id) }}</td>
                              <td class="kh12-b" style="text-align:left;">
                                {{ date('d-m-Y',strtotime($item->dd)) . ' ' .  $item->tt}}
                              </td>
                              <td class="kh12-b">
                                  {{ $item->user->name }}
                              </td>
                              <td class="kh12-b">
                                  {{ $item->partner->name }}
                              </td>
                              <td class="kh12-b" style="text-align:right;color:black;">
                                -{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}
                              </td>
                          </tr>
                        @endforeach
                        @php
                            $left_in+=$left1;
                        @endphp
                        <tr id="buy{{ $e->id }}" class="collapse" style="background-color:rgb(224, 219, 163);">
                          <td class="kh16-b" colspan=3>
                              សរុបបាញ់ចេញ {{ phpformatnumber(-1 * $total1) . ' ' . $e->currency->shortcut }}
                          </td>
                          <td colspan=3 class="kh16-b" style="text-align:right;">
                            នៅសល់  {{ phpformatnumber($left1) . ' ' . $e->currency->shortcut }}
                          </td>
                        </tr>
                    @endif
                @endforeach --}}
                @foreach ($exchangelefts->where('amount','>','0')->where('partner_id',$cs1['partnerid']) as $key => $e)
                    @php
                         $money_left=$e->amount;
                         $total_left+=$e->amount;
                    @endphp
                    <tr class="rows" style="background-color:aqua">
                        <td class="kh12-b" colspan=2>
                          {{ date('d-m-Y',strtotime($e->exdate)) }}
                        </td>
                        <td style="display:none">{{ $e->partner_id }}</td>
                        <td>{{ '('. $e->partner_id .')' . $e->partner->name }} </td>
                        <td>
                          {{ $e->user->name }}
                        </td>
                        <td>
                          {{ phpformatnumber($e->amount) . $e->currency->shortcut }}
                        </td>
                        <td style="color:blue;text-align:right;">
                            +{{ phpformatnumber($e->amount) . ' ' . $e->currency->shortcut }}
                        </td>
                        <td style="display:none">{{ $e->currency_id }}</td>
                    </tr>
                @endforeach
                @foreach ($exchangelists->where('partner_id',$cs1['partnerid'])->where('product','>','0') as $key => $e)
                    @php
                        $i++;
                        if($i==1){
                          $curbuy=$e->currency->shortcut;
                          $cur_id=$e->currency->id;
                        }
                        $totalbuy+=$e->product;
                        $luybuy+=$e->amount;
                        $totalbuy_group+=$e->product;
                        $luybuy_group+=$e->amount;
                    @endphp
                    <tr class="rows">
                        <td>{{ $i }}</td>
                        <td style="width:80px;">
                          <a class="" href="#buy{{ $e->id }}" data-bs-toggle="collapse" style=" text-decoration:underline;">{{ $e->id }}</a>
                        </td>
                        <td style="display:none">{{ $e->partner_id }}</td>
                        <td>{{ '('. $e->partner_id .')' . $e->partner->name }} <br> <span class="kh12-b">{{ date('d-m-Y',strtotime($e->dd)) }}</span> </td>
                        <td>
                          {{ $e->user->name }}
                          <br><span class="kh12-b">{{ $e->tt }}</span>
                        </td>
                        <td>
                          {{ phpformatnumber(abs($e->product)-abs($e->p_inout)) . $e->currency->shortcut }}
                          <br><span>({{ phpformatnumber($e->rate) }})</span>
                        </td>
                        <td style="color:blue;text-align:right;">
                            +{{ phpformatnumber($e->product) . ' ' . $e->currency->shortcut }}
                          <br>
                          <span style="color:red">
                            {{ phpformatnumber($e->amount) . ' ' . $e->maincur }}
                          </span>
                        </td>
                        <td style="display:none">{{ $e->currency_id }}</td>
                    </tr>
                    @php
                        $countdata=0;
                        $datarefs=App\Exchange::showexchangeidfromtransfer($e->id);
                        if($datarefs){
                            $countdata=1;
                        }
                    @endphp
                    @if($countdata>0)
                        @php
                            $total1=0;
                            $left1=$e->product;
                        @endphp
                        @foreach ($datarefs as $item)
                          @php
                              $total1+=$item->amount;
                              $left1-=$item->amount;
                          @endphp
                          <tr id="buy{{ $e->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                              <td></td>
                              <td class="kh12-b">{{ sprintf("%04d",$item->id) }}</td>
                              <td class="kh12-b" style="text-align:left;">
                                {{ date('d-m-Y',strtotime($item->dd)) . ' ' .  $item->tt}}
                              </td>
                              <td class="kh12-b">
                                  {{ $item->user->name }}
                              </td>
                              <td class="kh12-b">
                                  {{ $item->partner->name }}
                              </td>
                              <td class="kh12-b" style="text-align:right;color:black;">
                                -{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}
                              </td>
                          </tr>
                        @endforeach
                        @php
                            $left_in+=$left1;
                            $left_in_group+=$left1;
                        @endphp
                        <tr id="buy{{ $e->id }}" class="collapse" style="background-color:rgb(224, 219, 163);">
                          <td class="kh16-b" colspan=3>
                              សរុបបាញ់ចេញ {{ phpformatnumber(-1 * $total1) . ' ' . $e->currency->shortcut }}
                          </td>
                          <td colspan=3 class="kh16-b" style="text-align:right;">
                            នៅសល់  {{ phpformatnumber($left1) . ' ' . $e->currency->shortcut }}
                          </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                  <td colspan=2 class="kh16-b" style="padding:0px;color:purple;">ទិញ{{ $pname }}</td>
                  <td colspan=2 class="kh18-b" style="color:purple;padding:0px;">{{ phpformatnumber($totalbuy_group) . $curbuy }}</td>
                  <td colspan=2 class="kh18-b" style="color:purple;padding:0px;text-align:right;">{{ phpformatnumber($luybuy_group) . 'USD' }}</td>
                </tr>
                <tr>
                  <td colspan=2 class="kh16-b" style="padding:0px;color:purple;">សល់{{ $pname }}</td>
                  <td colspan=2 class="kh16-b" style="padding:0px;color:purple;">
                    @if($left_in_group+$money_left<>0)
                      <a href="#" class="btn btn-sm btn-warning btnsavein kh16-b" data-partner_id={{ $cs1['partnerid'] }} data-amount={{ $left_in_group }} data-cur_id={{ $cur_id }}>Save</a>
                    @endif
                  </td>
                  <td colspan=2 class="kh18-b" style="color:purple;padding:0px;text-align:right;"><h4><span class="badge bg-secondary">{{ phpformatnumber($left_in_group+$money_left) . $curbuy }}</span></h4></td>
                </tr>

              @endforeach
              <tr>
                <td colspan=2 class="kh22-b" style="padding:0px;color:green;">សរុបទិញ</td>
                <td colspan=2 class="kh22-b" style="color:green;padding:0px;">{{ phpformatnumber($totalbuy) . $curbuy }}</td>
                <td colspan=2 class="kh22-b" style="color:green;padding:0px;text-align:right;">{{ phpformatnumber($luybuy) . 'USD' }}</td>
              </tr>
              <tr>
                <td colspan=4 class="kh22-b" style="padding:0px;color:green;">សរុបសល់</td>
                <td colspan=2 class="kh22-b" style="color:green;padding:0px;text-align:right;">{{ phpformatnumber($left_in+$total_left) . $curbuy }}</td>
              </tr>
          </tbody>
      </table>
  </div>
</div>
<div class="col-lg-6">
  <div class="table-responsive">
      <table id="tblout" class="table tblout kh16-b">
          <thead style="">
              <th>N <sup>o</sup></th>
              <th>ID</th>
              <th style="display:none;">PartnerID</th>
              <th>ឈ្មោះដៃគូ</th>
              <th>អ្នកកាត់កង</th>
              <th>លុយសល់</th>
              <th style="text-align:right;">លក់ចេញ</th>
              <th style="display:none;">CurID</th>
          </thead>
          <tbody id="">
              @php
                  $j=0;
                  $cursale='';
                  $cur_id='';
                  $totalsale=0;
                  $luysale=0;
                  $totalsale_group=0;
                  $luysale_group=0;
                  $pname='';
                  $money_left=0;
                  $total_left=0;
              @endphp
              @foreach ($csc2 as $ckey2 =>$cs2)
                @php
                    $totalsale_group=0;
                    $luysale_group=0;
                    $left_out_group=0;
                    $pname=$cs2['partnername'];
                    $money_left=0;
                @endphp
                {{-- @foreach ($exchangelefts->where('product','<','0') as $key => $e)
                  @php
                    $cursale=$e->currency->shortcut;
                  @endphp
                    <tr class="rows" style="background-color:aqua">
                        <td>0</td>
                        <td style="width:80px;">
                          <a class="" href="#sale{{ $e->id }}" data-bs-toggle="collapse" style=" text-decoration:underline;">{{ $e->id }}</a>

                        </td>
                        <td style="display:none">{{ $e->partner_id }}</td>
                        <td>{{ '('. $e->partner_id .')' . $e->partner->name }} <br> <span class="kh12-b">{{ date('d-m-Y',strtotime($e->dd)) }}</span> </td>
                        <td>
                          {{ $e->user->name }}
                          <br><span class="kh12-b">{{ $e->tt }}</span>
                        </td>
                        <td>
                          {{ phpformatnumber(abs($e->product)-abs($e->p_inout)) . $e->currency->shortcut }}
                          <br><span>({{ phpformatnumber($e->rate) }})</span>
                        </td>
                        <td style="color:red;text-align:right;">
                            {{ phpformatnumber($e->product) . ' ' . $e->currency->shortcut }}
                          <br>
                          <span style="color:blue">
                            {{ phpformatnumber($e->amount) . ' ' . $e->maincur }}
                          </span>
                        </td>
                        <td style="display:none">{{ $e->currency_id }}</td>
                    </tr>
                    @php
                        $countdata=0;
                        $datarefs=App\Exchange::showexchangeidfromtransfer($e->id);
                        if($datarefs){
                            $countdata=1;
                        }
                    @endphp
                    @if($countdata>0)
                        @php
                            $total2=0;
                            $left2=abs($e->product);
                        @endphp
                        @foreach ($datarefs as $item)
                          @php
                              $total2+=$item->amount;
                              $left2-=abs($item->amount);
                          @endphp
                          <tr id="sale{{ $e->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                              <td></td>
                              <td class="kh12-b">{{ sprintf("%04d",$item->id) }}</td>
                              <td class="kh12-b" style="text-align:left;">
                                {{ date('d-m-Y',strtotime($item->dd)) . ' ' .  $item->tt}}
                              </td>
                              <td class="kh12-b">
                                  {{ $item->user->name }}
                              </td>
                              <td class="kh12-b">
                                  {{ $item->partner->name }}
                              </td>
                              <td class="kh12-b" style="text-align:right;color:black;">
                                +{{ phpformatnumber(abs($item->amount)) . ' ' . $item->currency->shortcut }}
                              </td>
                          </tr>
                        @endforeach
                        @php
                          $left_out+=$left2;
                        @endphp
                        <tr id="sale{{ $e->id }}" class="collapse" style="background-color:rgb(224, 219, 163);">
                          <td class="kh16" colspan=3>
                              សរុបបាញ់ចូល {{ phpformatnumber(abs($total2)) . ' ' . $e->currency->shortcut }}
                          </td>
                          <td colspan=3 class="kh16" style="text-align:right;">
                            នៅសល់  {{ phpformatnumber($left2) . ' ' . $e->currency->shortcut }}
                          </td>
                        </tr>
                    @endif
                @endforeach --}}
                @foreach ($exchangelefts->where('amount','<','0')->where('partner_id',$cs2['partnerid']) as $key => $e)
                    @php
                         $money_left=$e->amount;
                         $total_left+=$e->amount;

                    @endphp
                    <tr class="rows" style="background-color:aqua">
                        <td class="kh12-b" colspan=2>
                          {{ date('d-m-Y',strtotime($e->exdate)) }}
                        </td>
                        <td style="display:none">{{ $e->partner_id }}</td>
                        <td>{{ '('. $e->partner_id .')' . $e->partner->name }} </td>
                        <td>
                          {{ $e->user->name }}
                        </td>
                        <td>
                          {{ phpformatnumber($e->amount) . $e->currency->shortcut }}
                        </td>
                        <td style="color:blue;text-align:right;">
                            {{ phpformatnumber($e->amount) . ' ' . $e->currency->shortcut }}
                        </td>
                        <td style="display:none">{{ $e->currency_id }}</td>
                    </tr>
                @endforeach
                @foreach ($exchangelists->where('product','<','0')->where('partner_id',$cs2['partnerid']) as $key1 => $e)
                  @php
                      $j++;
                      if($j==1){
                        $cursale=$e->currency->shortcut;
                        $cur_id=$e->currency->id;
                      }
                      $totalsale+=$e->product;
                      $luysale+=$e->amount;
                      $totalsale_group+=$e->product;
                      $luysale_group+=$e->amount;
                  @endphp
                    <tr class='rows'>
                      <td>{{ $j }}</td>
                      <td>
                        <a class="" href="#sale{{ $e->id }}" data-bs-toggle="collapse" style=" text-decoration:underline;">{{ $e->id }}</a>

                      </td>
                      <td style="display:none;">{{ $e->partner_id }}</td>
                      <td>{{ '('. $e->partner_id .')'. $e->partner->name }} <br> <span class="kh12-b">{{ date('d-m-Y',strtotime($e->dd)) }}</span> </td>
                      <td>
                        {{ $e->user->name }}<br><span class="kh12-b">{{ $e->tt }}</span>

                      </td>
                      <td>
                        {{ phpformatnumber($e->product-$e->p_inout) . $e->currency->shortcut }}
                        <br>
                        ({{ phpformatnumber($e->rate) }})
                      </td>
                      <td style="color:red;text-align:right;">
                          {{ phpformatnumber($e->product) . ' ' . $e->currency->shortcut }}
                        <br>
                        <span style="color:blue">
                          {{ phpformatnumber($e->amount) . ' ' . $e->maincur }}
                        </span>
                      </td>
                      <td style="display:none">{{ $e->currency_id }}</td>
                  </tr>
                  @php
                      $countdata=0;
                      $datarefs=App\Exchange::showexchangeidfromtransfer($e->id);
                      if($datarefs){
                          $countdata=1;
                      }
                    @endphp
                    @if($countdata>0)
                        @php
                            $total2=0;
                            $left2=$e->product;
                        @endphp
                        @foreach ($datarefs as $item)
                          @php
                              $total2+=$item->amount;
                              $left2+=$item->amount;
                          @endphp
                          <tr id="sale{{ $e->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                            <td></td>
                            <td class="kh12-b">{{ sprintf("%04d",$item->id) }}</td>
                            <td class="kh12-b" style="text-align:left;">
                              {{ date('d-m-Y',strtotime($item->dd)) . ' ' .  $item->tt}}
                            </td>
                            <td class="kh12-b">
                                {{ $item->user->name }}
                            </td>
                            <td class="kh12-b">
                                {{ $item->partner->name }}
                            </td>
                            <td class="kh12-b" style="text-align:right;color:black;">
                              +{{ phpformatnumber(abs($item->amount)) . ' ' . $item->currency->shortcut }}
                            </td>
                          </tr>
                        @endforeach
                        @php
                          $left_out+=$left2;
                          $left_out_group+=$left2;
                        @endphp
                        <tr id="sale{{ $e->id }}" class="collapse" style="background-color:rgb(224, 219, 163);">
                          <td class="kh16" colspan=3>
                              សរុបបាញ់ចូល {{ phpformatnumber(abs($total2)) . ' ' . $e->currency->shortcut }}
                          </td>
                          <td colspan=3 class="kh16" style="text-align:right;">
                            នៅសល់  {{ phpformatnumber($left2) . ' ' . $e->currency->shortcut }}
                          </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                  <td colspan=2 class="kh16-b" style="padding:0px;color:purple;">លក់{{ $pname }}</td>
                  <td colspan=2 class="kh18-b" style="color:purple;padding:0px;">{{ phpformatnumber($totalsale_group) . $cursale }}</td>
                  <td colspan=2 class="kh18-b" style="color:purple;padding:0px;text-align:right;">{{ phpformatnumber($luysale_group) . 'USD' }}</td>
                </tr>
                <tr>

                  <td colspan=2 class="kh16-b" style="padding:0px;color:purple;">សល់{{ $pname }}</td>
                  <td colspan=2 class="kh16-b" style="padding:0px;color:purple;">
                    @if($left_out_group-$money_left<>0)
                      <a href="#" class="btn btn-sm btn-warning btnsaveout kh16-b" data-partner_id={{ $cs2['partnerid'] }} data-amount={{ -1 * $left_out_group }} data-cur_id={{ $cur_id }}>Save</a>
                    @endif
                  </td>
                  <td colspan=2 class="kh18-b" style="color:purple;padding:0px;text-align:right;"><h4><span class="badge bg-secondary">{{ phpformatnumber($left_out_group+$money_left) . $cursale }}</span></h4> </td>
                </tr>
              @endforeach
              <tr>
                <td colspan=2 class="kh22-b" style="padding:0px;color:green;">សរុបលក់</td>
                <td colspan=2 class="kh22-b" style="color:green;padding:0px;">{{ phpformatnumber($totalsale) . $cursale }}</td>
                <td colspan=2 class="kh22-b" style="color:green;padding:0px;text-align:right;">{{ phpformatnumber($luysale) . 'USD' }}</td>
              </tr>
              <tr>
                <td colspan=4 class="kh22-b" style="padding:0px;color:green;">សរុបសល់</td>
                <td colspan=2 class="kh22-b" style="color:green;padding:0px;text-align:right;">{{ phpformatnumber($left_out-$total_left) . $cursale }}</td>
              </tr>
          </tbody>
      </table>
  </div>
</div>
