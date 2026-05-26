@extends('master')
@section('title')Exchange List Report @endsection
@section('css')
    <style type="text/css">
     body.wait, body.wait *{
			cursor: wait !important;
		}
    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:35px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:white}
    #selcustomer1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:35px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:white}

    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:35px;background-color:whitesmoke;}
		/* Each result */
		#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:white}

    #selpartner2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:35px;background-color:whitesmoke;}
		/* Each result */
		#select2-selpartner2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:white}


    #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:35px;background-color:white}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:white;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:35px;}
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
          .kh30-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            font-weight:bold;
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
       /* td{
        border-style:none;
       } */
    #tbl_exchange_list .clickedrow td{
        background-color: #9eca8f;
    }
    #tbl2 .clickedrow td{
        background-color: #9eca8f;
    }
    #tbl1 .clickedrow td{
        background-color: #9eca8f;
    }
    #tblin .clickedrow td{
        background-color: #9eca8f;
    }
    #tblout .clickedrow td{
        background-color: #9eca8f;
    }
    #tblsearchmore td{
        border-style:none;
    }
    #tbl_partner td{
      border-style:none;
    }
    #tbl_amount td{
      border-style:none;
    }
    #tbl_continue_partner td{
      border-style:none;
    }
    #tblin td{
      padding:0px;
    }
    #tblin th{
      padding:0px;
    }
    #tblout td{
      padding:0px;
    }
    #tblout th{
      padding:0px;
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

    <div style="margin-top:-20px;">
        <table class="kh14-b">
            <tr>
                <td style="border-style:none;width:60px;">គិតចាប់ពី</td>
                <td style="padding:0px;border-style:none;width:170px;">
                    <div class="input-group" style="width:160px;">
                        <input type="text" name="dt1" id="dt1" class="form-control kh14-b" style="width:100px;background-color:silver;">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </td>
                <td style="border-style:none;width:60px;">រហូតដល់</td>
                <td style="padding:0px;border-style:none;width:170px;">
                    <div class="input-group" style="width:160px;">
                        <input type="text" name="dt2" id="dt2" class="form-control kh14-b" style="width:100px;background-color:silver;">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </td>
                <td style="border-style:none;width:70px;">អ្នកកាត់កង</td>
                <td style="padding:0px;border-style:none;width:160px;">
                    <select class="form-select" name="seluser" id="seluser" style="">
                        <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="border-style:none;padding-left:10px;">រូបិយប័ណ្ណ</td>
                <td style="padding:0px 0px 0px 10px;border-style:none;width:150px;">
                    <select name="selcur" id="selcur" class="form-select kh14-b" style="width:150px;">
                        <option value="">ទាំងអស់</option>
                        @foreach ($currencies as $cur)
                            <option value="{{ $cur->id }}">{{ $cur->shortcut }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <table class="kh14-b" style="margin-top:10px;">
            <tr>
                <td style="border-style:none;padding-right:5px;">ប្រភេទអតិថិជន</td>
                <td style="padding-right:5px;border-style:none;">
                    <select name="seltype1" id="seltype1" class="form-select kh14-b">
                        <option value="all">ទាំងអស់</option>
                        <option value="BANK">BANK</option>
                        @if(Auth::user()->role->name=='Admin')
                        <option value="CUSTOMER">CUSTOMER</option>
                        @endif
                        <option value="PARTNER">PARTNER</option>
                        <option value="AGENT">AGENT</option>

                    </select>
                </td>
                <td style="border-style:none;padding-right:5px;">ជ្រើសរើសដៃគូ</td>
                <td style="padding-right:5px;border-style:none;">
                    <select name="selcustomer1" id="selcustomer1" style="margin-top:-60px;" class="form-select kh14-b" required>
                        <option value="">ទាំងអស់</option>
                        @foreach ($partners as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                        @if(Auth::user()->role->name=='Admin')
                        @foreach ($customers as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </td>

                <td style="padding:0px;border-style:none;">
                    <button class="btn btn-primary btn-sm kh14-b" id="btnsearch1">បង្ហាញ</button>
                    <button class="btn btn-primary btn-sm kh14-b" id="btnprint">ព្រីន</button>
                    <button class="btn btn-primary btn-sm kh14-b" id="btnprintdetail">ព្រីនលំអិត</button>
                    <button id="btnkatkong" class="btn btn-info btn-sm kh14-b">កាត់កង</button>
                    <button id="btninout" class="btn btn-info btn-sm kh14-b">ទទួលបន្ត</button>
                </td>
            </tr>

        </table>

    </div>
    @php
      $left_in=0;
      $left_out=0;
      $left_in_group=0;
      $left_out_group=0;
    @endphp
    <div id="exchangelist" class="row" style="margin-top:20px;">
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
                                    $left2-=$item->amount;
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
                          @if($left_out_group+$money_left<>0)
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
                      <td colspan=2 class="kh22-b" style="color:green;padding:0px;text-align:right;">{{ phpformatnumber($left_out+$total_left) . $cursale }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>

    @include('partnerlists.exchangelistmodal');
    @include('partnerlists.exchangelistcontinuemodal');

@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('របាយការណ៏ទិញលក់');
        $(document).ready(function () {
            $("#selcustomer").select2({
                dropdownParent: $('#exchangelistmodal .modal-content')
            });
            $("#selpartner").select2({
                dropdownParent: $('#exchangelistcontinuemodal .modal-content')
            });
            $("#selpartner2").select2({
                dropdownParent: $('#exchangelistcontinuemodal .modal-content')
            });
            $('#seluser').select2();
            $('#selcustomer1').select2();
            $(document).on('click','#tbl1 td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','#tbl2 td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','#tblin td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','#tblout td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            var cleave = new Cleave('#txtbuy', {
                numeral: true,
                numeralPositiveOnly: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#txtsale', {
                numeral: true,
                numeralPositiveOnly: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#txtrate', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#amount', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#fee', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#fee2', {
              numeral: true,
              numeralPositiveOnly: true,
              numeralThousandsGroupStyle: 'thousand'
            });
            var today=new Date();
            $('#dt1,#dt2,#exchangedate,#invdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
        $(document).on('change','#selcur0',function(e){
            var curid=$(this).val();
            var cur=$('#selcur0 option:selected').text();

            $('#txtcur1').val(curid);
            $('#txtcur2').val(curid);

        })

        $(document).on('keyup','#amount',function(e){
            const C = e.key;
            if (C === "Backspace"){
                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey1(C,'#selcur0')
                var cur=$('#selcur0 option:selected').text();
                $('#txtcur1').val($('#selcur0').val());
                $('#txtcur2').val($('#selcur0').val());
            }
        })
        $(document).on('keyup','#fee',function(e){
            const C = e.key;
            if (C === "Backspace"){
                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey1(C,'#txtcur1')
            }
        })
        $(document).on('keyup','#fee2',function(e){
            const C = e.key;
            if (C === "Backspace"){
                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey1(C,'#txtcur2')
            }
        })
            var sel_partner2;
            var main_exchange_id2;
            var sel_partner;
            var main_exchange_id;
            var main_cur1;
            var main_cur2;
            $(document).on("click","#tblin tr.rows td", function(e){
              var row=$(this).closest('tr');
              sel_partner2=row.find("td:eq(2)").text();
              main_exchange_id2=row.find("td:eq(1)").text();
              main_cur1=row.find("td:eq(7)").text();
              //alert(main_cur1)
            });

            $(document).on("click","#tblout tr.rows td", function(e){
              var row=$(this).closest('tr');
              sel_partner=row.find("td:eq(2)").text();
              main_exchange_id=row.find("td:eq(1)").text();
              main_cur2=row.find("td:eq(7)").text();
              //alert(main_cur2)
            });
            $(document).on('click','.btnsavein,.btnsaveout',function(e){
              e.preventDefault();
              var pid=$(this).data('partner_id');
              var amount=$(this).data('amount');
              var cur_id=$(this).data('cur_id');
              var exdate=$('#dt1').val();
              var userid=$('#seluser').val();
              var q = confirm("Do you want to save list?");
                if(!q){
                    return;
                }
              var url="{{ route('partnerlist.saveexchangelistleft') }}";
              $.post(url,{partner_id:pid,amount:amount,currency_id:cur_id,user_id:userid,exdate:exdate},function(data){
                console.log(data)
                if(data.success){
                  toastr.success(data.success);
              }else{
                toastr.error(data.error);
              }
              })
            })
            $(document).on('click','#btninout',function(e){
              e.preventDefault();
              if(main_cur1!=main_cur2){
                alert('currency not the same');
                return;
              }
              $('#exchangelistcontinuemodal').modal('show');
              $('#selpartner2').val(sel_partner2);
              $('#selpartner2').trigger('change');
              $('#selpartner').val(sel_partner);
              $('#selpartner').trigger('change');
              $('#main_exchange_id').val(main_exchange_id);
              $('#main_exchange_id2').val(main_exchange_id2);
              $('#selcur0').val(main_cur1);
              $('#txtcur1').val(main_cur1);
              $('#txtcur2').val(main_cur1);
            })
            $(document).on('click','#btnsaveinout',function(e){
              e.preventDefault();
              $('body').addClass("wait");
              var formdata=new FormData(frmtransfer);
              var sp = document.querySelector("#selpartner");
              var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
              var partner1=$('#selpartner option:selected').text();
              var partner2=$('#selpartner2 option:selected').text();
              formdata.append("customertype", customertype);
              formdata.append("partner1", partner1);
              formdata.append("partner2", partner2);
              var url="{{ route('exchangelistreport.storeinout') }}"
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
                      //debugger;
                      if($.isEmptyObject(data.error)){
                          $('#frmtransfer').trigger('reset');
                          $('#exchangelistcontinuemodal').modal('hide');
                          $('#invdate').datetimepicker({
                              timepicker:false,
                              datepicker:true,
                              value:new Date(),
                              format:'d-m-Y',
                              autoclose:true,
                              todayBtn:true,
                              startDate:new Date(),
                          });
                          $('#invdate').datetimepicker("destroy");
                          SearchList();
                          $('body').removeClass("wait");
                          //location.reload();
                      }else{
                          $('body').removeClass("wait");
                          alert(data.error)
                      }
                  },
                  error: function () {
                      alert('Save Error.')
                  }
              })
        })
        $(document).on('keydown', '.canenter', function (e) {
            if (e.keyCode == 13) {
                var id = $(this).attr("id");
                if (id == 'txtbuy') {
                    $('#txtrate').focus();
                } else if(id == 'txtrate'){

                } else if (id == 'amount'){
                    if($('#mekun').val()==1){
                        $('#cuscharge').focus();
                        $('#cuscharge').select();
                    }else{
                        $('#fee').focus();
                        $('#fee').select();
                    }
                }else if (id == 'cuscharge') {
                    $('#fee').focus();
                    $('#fee').select();
                }else if (id == 'fee') {
                    $('#fee2').focus();
                }else if(id=='rectel'){
                    $('#recname').focus();
                }else if(id=='recname'){
                    $('#sendertel').focus();
                }else if(id=='sendertel'){
                    $('#sendername').focus();
                }else if(id=='sendername'){
                    $('#amount').focus();
                }else if(id=='fee2'){
                    $('#btnsaveinout').focus();
                }
                e.preventDefault();
            }
        })
            $(document).on('click','#btnprint,#btnprintdetail',function(e){
                e.preventDefault();
                var btnid=$(this).attr('id');
                var d1=$('#dt1').val();
                var d2=$('#dt2').val();
                var partnerid=$('#selcustomer1').val();
                var partnername=$('#selcustomer1 option:selected').text();
                var userid=$('#seluser').val();
                var username=$('#seluser option:selected').text();
                var curid=$('#selcur').val();
                var curname=$('#selcur option:selected').text();
                var redirectWindow = window.open('{{ url('/') }}'+'/partnerlist/printexchangereport?d1='+d1+'&d2='+d2+'&partnername='+partnername+'&partnerid='+partnerid+'&username='+username+'&userid='+userid+'&curname='+curname+'&curid='+curid+'&btnid='+btnid, '_blank');
                redirectWindow.location;
          })

            $(document).on('click','#btnsearch1',function(e){
              e.preventDefault();
              SearchList();
            })
            function SearchList()
        {
            $('body').addClass("wait");
            var d1=$('#dt1').val();
            var d2=$('#dt2').val();
            var partnerid=$('#selcustomer1').val();
            var partnername=$('#selcustomer1 option:selected').text();
            var userid=$('#seluser').val();
            var username=$('#seluser option:selected').text();
            var curname=$('#selcur option:selected').text();

            var curid=$('#selcur').val();
            var url="{{ route('partnerlist.searchexchangelistreport') }}";
            // $.get(url,{d1:d1,d2:d2,partner:partner,oldlist:oldlist,partnername:partnername,searchtran:searchtran},function(data){
            //     //console.log(data);
            //     $('#divdisplay').empty().html(data);
            //     document.body.style.cursor = 'pointer';
            // })


            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: { d1:d1,d2:d2,partnerid:partnerid,partnername:partnername,userid:userid,username:username,curid:curid,curname:curname},
                //contentType: 'text/plain',
                //contentType: false,
                //processData: true,
                //cache: false,
                complete: function () {},
                success: function (data) {
                  console.log(data)
                    $('#exchangelist').empty().html(data);
                    $('body').removeClass("wait");
                },
                error: function () {
                    alert('Read Data Error.')
                }
            })
        }
            $(document).on('click','#btnkatkong',function(e){
              e.preventDefault();
              $('#exchangelistmodal').modal('show');
              $('#buysaleid').val('');
              $('#txtdesr').val('');
            })
            $(document).on('click','.btnsaleout',function(e){
              e.preventDefault();
              var desr=$(this).data('desr');
              var mainid=$(this).data('id');
              $('#exchangelistmodal').modal('show');
              $('#txtdesr').val(desr);
              $('#buysaleid').val(mainid);
            })

            $('#exchangelistmodal').on('hidden.bs.modal', function () {
              SearchList();
          })
            $(document).on('change','#seltype1',function(e){
                e.preventDefault();
                var type=$(this).val();
                getpartner(type,'#selcustomer1');
            })
            $(document).on('change','#radio1',function(e){
                e.preventDefault()
                $('#txtsignwe').val('លក់ចេញ');
                $('#txtsignthey').val('ទិញចូល');
                $('#txtsign').val('+');
          })
          $(document).on('change','#radio2',function(e){
                e.preventDefault()
                $('#txtsignwe').val('ទិញចូល');
                $('#txtsignthey').val('លក់ចេញ');
                $('#txtsign').val('-');
          })
          $(document).on('click','.theirbutton',function(e){
                e.preventDefault();
                var row=$(this).closest('tr');
                amt=row.find("td input:eq(0)").val();
                cur=row.find("td input:eq(1)").val();
                $('#txttheircash').val(amt);
                $('#txttheircur').val(cur);
                $('#txttheircur1').val(cur);
                getcurrencybyshortcut(cur,'#lblbuy');
                $('#txtbuy').attr('readonly',false);
          })

          $(document).on('click','.webutton',function(e){
                e.preventDefault();
                var row=$(this).closest('tr');
                amt=row.find("td input:eq(0)").val();
                cur=row.find("td input:eq(1)").val();
                $('#txtwecash').val(amt);
                $('#txtwecur').val(cur);
                $('#txtwecur1').val(cur);
                getcurrencybyshortcut(cur,'#lblsale');
                $('#txtsale').attr('readonly',false);
          })

            $(document).on('click','#btnsearch',function(e){
                e.preventDefault()
                TotalList();
                var partner=$('#selcustomer option:selected').text();
                $('#r_right').text('នៅខ្វះ '+ partner);
                $('#r_right1').text('លុយ '+ partner);
            })
            $(document).on('change','#selcustomer',function(e){
                e.preventDefault();
                TotalList();
                var partner=$('#selcustomer option:selected').text();
                $('#r_right').text('នៅខ្វះ '+ partner);
                $('#r_right1').text('លុយ '+ partner);
            })
            $(document).on('change','#seltype',function(e){
                e.preventDefault();
                var type=$(this).val();

                getpartner(type,'#selcustomer');
            })
            function getpartner(type,el)
                {

                    var url="{{ route('getpartnerbytype') }}";
                    $(el).empty();

                    $.get(url,{type:type},function(data){
                        $(el).append($("<option/>",{
                                    value:'',
                                    text:''
                                }))
                        $.each(data,function(i,item){
                            $(el).append($("<option/>",{
                                    value:item.id,
                                    text:item.name
                                }))
                            //console.log(item)
                        });

                    })
                }

            function TotalList()
            {
                var exchangedate=$('#exchangedate').val();
                var partner=$('#selcustomer').val();
                var partnername=$('#selcustomer option:selected').text();

                var url="{{ route('partnerlist.gettotallist') }}";
                $.get(url,{exchangedate:exchangedate,partner:partner,partnername:partnername,iscloselist:0},function(data){
                    //console.log(data);
                    $('#total_list').empty().html(data);
                })
            }

            $(document).on('keyup', '#txtbuy', function (e) {
                calcuexchange();
                calcubalance();
            })
            $(document).on('keyup', '#txtsale', function (e) {
                calcuexchange1();
                calcubalance();
            })
            $(document).on('keyup', '#txtrate', function (e) {
                //debugger
                //alert(e.key)
                if(isNumber(e.key)){
                    calcuexchange();
                    calcubalance();
                }
                //alert('not a number')
                const C = e.key;
                if (C === "Backspace") {
                    calcuexchange();
                    return;
                }
                if(isNumber(C)==false){
                    getcurrencybykey(C,'#lblsale')
                }
            })
            function clientvalidate(){
                if($('#txtrate').val()==''){
                    alert('please select exchange currency')
                    return false;
                }
                if($('#txtbuy').val()=='' || $('#txtsale').val()=='' ){
                    alert('please input exchange amount')
                    return false;
                }
                return true;
            }
            $(document).on('click','#btnsavelist',function(e){
                e.preventDefault();

              if(clientvalidate()==false){
                return;
              }
                var q = confirm("Do you want to save exchange list?");
                if(!q){
                    return;
                }
                var formdata=new FormData();
                var m1 = $('#lblbuy').attr('title').split(";");
                var m2 = $('#lblsale').attr('title').split(";");
                var pid = 0;
                var mcur = '';
                var pcur = '';
                var luy = 0;
                var product = 0;
                var mekun = 1;
                var item1 = 0;
                var item2 = 0;
                var rate1b = 0;
                var rate1s = 0;
                var rate2b = 0;
                var rate2s = 0;
                var curid1 = 0;
                var curid2 = 0;
                var pcur1 = '';
                var pcur2 = '';
                var buy='0';
                var sale='0';
                var curbuy='';
                var cursale='';
                var receipt2='0';
                var buysaleid=$('#buysaleid').val();
                if ($('#txtsign').val() == '+') {
                    mekun = 1;
                    buy=$('#txtbuy').val();
                    sale=$('#txtsale').val();
                    curbuy=$('#lblbuy').val();
                    cursale=$('#lblsale').val();


                } else {
                    mekun = -1;
                    buy=$('#txtsale').val();
                    sale=$('#txtbuy').val();
                    curbuy=$('#lblsale').val();
                    cursale=$('#lblbuy').val();

                }
                if (m1[4] == '1') {
                    mcur = m1[6];
                    pid = m2[0];
                    pcur = m2[6];
                    luy = mekun * $('#txtbuy').val().replace(/,/g, '');
                    product = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
                } else if (m2[4] == '1') {
                    mcur = m2[6];
                    pid = m1[0];
                    pcur = m1[6];
                    product = mekun * $('#txtbuy').val().replace(/,/g, '');
                    luy = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
                } else {
                    receipt2='1';
                    item1 = $('#txtbuy').val();
                    item2 = $('#txtsale').val();
                    rate1b = m1[1];
                    rate1s = m1[2];
                    rate2b = m2[1];
                    rate2s = m2[2];
                    curid1 = m1[0];
                    curid2 = m2[0];
                    pcur1 = m1[6];
                    pcur2 = m2[6];
                    //url = "{{ route('saveexchangeproduct') }}"
                }
                    formdata.append('partner_id',$('#selcustomer').val());
                    formdata.append("product_id", pid);
                    formdata.append("product_cur", pcur);
                    formdata.append("exchange_amount", luy);
                    formdata.append("maincur", mcur);
                    formdata.append("product", product);
                    formdata.append("agree_rate", $('#txtrate').val());
                    formdata.append("main_rate", $('#txtrate1').val());
                    formdata.append('exchangedate',$('#exchangedate').val());
                    formdata.append("exsign", $('#txtsign').val());
                    formdata.append("item1", item1);
                    formdata.append("item2", item2);
                    formdata.append("rate1buy", rate1b);
                    formdata.append("rate1sale", rate1s);
                    formdata.append("rate2buy", rate2b);
                    formdata.append("rate2sale", rate2s);
                    formdata.append("curid1", curid1);
                    formdata.append("curid2", curid2);
                    formdata.append("pcur1", pcur1);
                    formdata.append("pcur2", pcur2);
                    formdata.append("buy",buy);
                    formdata.append("sale", sale);
                    formdata.append("curbuy", curbuy);
                    formdata.append("cursale", cursale);
                    formdata.append("buysaleid",buysaleid);
                    formdata.append("isexchange_normal","0");
                //frmdata.push({name:'dd',value:$('#invdate').val()});
                var url="{{ route('partnerlist.store') }}"

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
                            TotalList();
                            resetkatkong();
                            //location.reload();
                        }else{
                            alert(data.error)
                        }
                    },
                    error: function () {
                        alert('Save Error')
                    }

                })

            })

        })

        function resetkatkong(){
            $('#txtwecash').val('');
            $('#txttheircash').val('');
            $('#txtbuy').val('');
            $('#txtsale').val('');
            $('#txtwebal').val('');
            $('#txttheirbal').val('');
            $('#txtrate').val('');
            $('#txtrate1').val('');
            $('#txtwecur').val('');
            $('#txtwecur1').val('');
            $('#txttheircur').val('');
            $('#txttheircur1').val('');
            $('#lblbuy').val('');
            $('#lblsale').val('');
            $('#txtsale').attr('readonly',true);
            $('#txtbuy').attr('readonly',true);



        }

        function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
        function getcurrencybyshortcut(key,el)
        {
            var url="{{ route('getcurrencybyshortcut') }}";
            $.get(url,{key:key},function(data){
                //console.log(data)

                    if(data['c']!=null){

                        $(el).val(data['c']['shortcut']);
                        $(el).attr('title', data['c']['id'] + ';' + parseFloat(data['c']['ratebuy']) + ';' + parseFloat(data['c']['ratesale']) + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                        getrate();
                    }
            })
        }
        function runproductrate() {
                //debugger
                var url="{{ route('getproductrate') }}";
                var buycur = $('#lblbuy').val();
                var salecur = $('#lblsale').val();
                var curname = '';
                if ($('#txtsign').val() == '+') {
                    curname = buycur + '-' + salecur;
                } else {
                    curname = salecur + '-' + buycur;
                }
                //alert(curname)
                $.get(url,{curname:curname},function(data){
                    if(data.success){
                        $('#txtrate1').val(formatNumber(parseFloat(data['pr']['rate'])));
                        $('#txtrate').val(formatNumber(parseFloat(data['pr']['rate'])));
                        $('#txtrate').attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                        calcuexchangeproduct();
                    }else{
                        $('#txtrate').val('');
                        $('#txtrate').attr('title','');
                    }
                    console.log(data)

                })

                $('#lblrate').attr('title',$('#txtrate').val());

            }
        function getrate() {

            $('#txtrate').attr('title', '');
            var m = $('#lblbuy').attr('title').split(";");
            var p = $('#lblsale').attr('title').split(";");
            if(m=='' || p==''){
                //alert('can not save')
                return;
            }
            //check if the save curname
            //debugger
            if (m[6] == p[6]) {
                $('#txtrate').val(1);
                $('#txtrate1').val(1);
                calcuexchange();
                return;
            }
            //check if product exchange product
            if (m[4] == '0') {
                if (p[4] == '0') {
                    runproductrate();
                    return;
                }
            }
            if ($('#txtsign').val() == '+') {
                if (m[4] == '1') {//if maincur=true
                    $('#txtrate').val(formatNumber(parseFloat(p[2])));//get rate p sale
                } else {
                    $('#txtrate').val(formatNumber(parseFloat(m[1])));//get rate m buy
                }

            } else {
                if (m[4] == '1') {
                    $('#txtrate').val(formatNumber(parseFloat(p[1])));
                } else {
                    $('#txtrate').val(formatNumber(parseFloat(m[2])));
                }

            }
            $('#txtrate1').val($('#txtrate').val());
            $('#lblrate').attr('title',$('#txtrate').val());
            //calcuexchange();

        }
        function calcuexchangeproduct() {
            //debugger;
            var luy = $('#txtbuy').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var rs = $('#txtrate').attr('title').split(";");
            if ($('#txtsign').val() == '+') {
                if (rs[2] == '*') {
                    $('#txtsale').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (rs[2] == '*') {
                    $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $('#txtsale').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }
            }
        }
        function calcuexchangeproduct1() {
            //debugger;
            var luy = $('#txtsale').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var rs = $('#txtrate').attr('title').split(";");
            if ($('#txtsign').val() == '+') {
                if (rs[2] == '*') {
                    $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $('#txtbuy').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }
            } else {
                if (rs[2] == '*') {
                    $('#txtbuy').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            }
        }
        function calcuexchange() {
            var luy = $('#txtbuy').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var m1 = $('#lblbuy').attr('title').split(";");
            var m2 = $('#lblsale').attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    $('#txtsale').val(formatNumber(luy * r));
                } else {
                    $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    } else {
                        $('#txtsale').val(formatNumber(luy * r));
                    }
                } else {
                    calcuexchangeproduct();
                }
            }
        }
        function calcuexchange1() {
             //debugger
            var luy = $('#txtsale').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var m1 = $('#lblbuy').attr('title').split(";");
            var m2 = $('#lblsale').attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/

                    $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $('#txtbuy').val(formatNumber(luy * r));

                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $('#txtbuy').val(formatNumber(luy * r));
                    } else {
                        $('#txtbuy').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    }
                } else {
                    calcuexchangeproduct1();
                }
            }
        }
        function calcubalance()
        {
            var sign=$('#txtsign').val();
            var wedebt=$('#txtwecash').val().replace(/,/g, '');
            var sale=$('#txtsale').val().replace(/,/g, '');
            if(sign=='+'){
                var webal=formatNumber((parseFloat(wedebt) + parseFloat(sale)).toFixed(2));
            }else{
                var webal=formatNumber((parseFloat(wedebt) - parseFloat(sale)).toFixed(2));
            }
            $('#txtwebal').val(webal);


            var theirdebt=$('#txttheircash').val().replace(/,/g, '');
            var buy=$('#txtbuy').val().replace(/,/g, '');
            if(sign=='+'){
                var theirbal=formatNumber((parseFloat(theirdebt) - parseFloat(buy)).toFixed(2));
            }else{
                var theirbal=formatNumber((parseFloat(theirdebt) + parseFloat(buy)).toFixed(2));
            }
            $('#txttheirbal').val(theirbal);


        }
        function getcurrencybykey1(key,el)
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
    </script>
@endsection
