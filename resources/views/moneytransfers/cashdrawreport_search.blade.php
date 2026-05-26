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
<div class="row" style="margin-top:0px;">
    <div class="tableFixHead" style="padding:0px;">
        <table id="tbl_partner_transfer" class="table table-bordered table-hover kh14" style="table-layout:fixed;">
            <thead style="text-align:center;">
                <th style="width:60px;">លរ</th>
                <th style="width:150px;">ថ្ងៃបើកវេរ</th>
                <th style="width:120px;">អ្នកបើក</th>
                <th style="width:120px;">ចំនួនទឹកប្រាក់</th>
                <th style="width:100px;">កាត់សេវ៉ា</th>
                <th style="width:120px;">លុយបើក</th>
                <th style="width:200px;">ពត៌មានអ្នកបើកវេរ</th>
                <th style="width:100px;">ប្រភេទទូទាត់</th>
                <th style="width:100px;">Action</th>

                <th style="width:150px;">ថ្ងៃវេរ</th>
                <th style="width:120px;">អ្នកកត់ត្រា</th>
                <th style="width:120px;">វេរមកពី</th>
                <th style="width:2000px;">ផ្សេងៗ</th>

            </thead>

             <tbody id="bodytransfer">
                            @foreach ($data as $key => $d)

                                    <tr class="rowclick">
                                        <td style="text-align:center;">{{ ++$key }}</td>

                                        <td>{{ date('d-m-y',strtotime($d->opdate)) . ' ' . $d->optime }}</td>
                                        <td>{{ $d->user->name }}</td>
                                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($d->amount) .  $d->currency->sk }}</td>
                                        <td class="kh14-b" style="text-align:right;@if($d->customer_charge<=0)color:red;@endif">{{ phpformatnumber($d->customer_charge) .  $d->currency->sk }}</td>
                                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($d->amount-$d->customer_charge) .  $d->currency->sk }}</td>
                                        <td>{{ $d->receive_tel . ' ' . $d->receive_name }}</td>
                                        <td>{{ $d->paymethod }}</td>
                                        <td style="">
                                          @if(str_contains($d->action,'d'))
                                            <a href="#" class="mybtn btndelcashdraw" style="color:red;padding:0px 5px;" data-id="{{ $d->id }}" data-transfer_id="{{ $d->transfer_id }}"><i class="fa fa-trash" style=""></i></a>
                                          @endif
                                            <a href="#ref{{ $d->id }}" class="mybtn kh14-b" style="padding:0px 5px;@if($d->have_exchange==true) background-color:blue;color:white; @elseif($d->have_exchange==false && $d->customer_charge>0) background-color:yellow;color:black; @elseif($d->have_exchange==false && $d->customer_charge<=0) background-color:red;color:white; @endif" data-bs-toggle="collapse" >{{ $d->id }}</a>
                                        </td>
                                         <td>{{ date('d-m-y',strtotime($d->partnertransfer->dd)) . ' ' .  $d->partnertransfer->tt }}</td>
                                        <td>{{ $d->partnertransfer->user->name }}</td>
                                        <td>{{ $d->partnertransfer->partner->name }}</td>
                                        <td>{{ $d->other }}</td>
                                    </tr>
                                  @php

                                    $datarefs=App\Cashdraw::showlinkgroup_new($d->ref_group_id,$d->transfer_id);
                                  @endphp
                                  @if($datarefs['transfers'] && !$datarefs['transfers']->isEmpty())
                                    <tr id="ref{{ $d->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                        <td colspan=14>
                                            <table class="tbldetail">
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
                                                    @foreach ($datarefs['transfers'] as $key => $item)
                                                    <tr class="kh16" style="">
                                                        <td>{{ sprintf("%04d",$item->id) }}</td>
                                                        <td>
                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                        </td>
                                                        <td>{{ $item->user->name }}</td>
                                                        <td>{{ $item->partner->name }}</td>
                                                        <td>{{ $item->tranname }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->amount) . $item->currency->sk }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->fee) . $item->currency->sk }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->cuscharge) . $item->cuschargecur->sk }}</td>
                                                        <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                                        <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                        <td>{{ $item->note }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>

                                    </tr>
                                  @endif

                                 @if($datarefs['exchanges'] && !$datarefs['exchanges']->isEmpty())

                                    <tr id="ref{{ $d->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=14>
                                          <table class="tbldetail">
                                              <thead style="text-align:center;">
                                                  <th>ID</th>
                                                  <th>ថ្ងៃទី</th>
                                                  <th>អ្នកកត់ត្រា</th>
                                                  <th>ទិញចូល</th>
                                                  <th>លក់ចេញ</th>
                                                  <th>អត្រា</th>
                                                  <th>ផ្សេងៗ</th>
                                              </thead>
                                              <tbody>
                                                 @foreach ($datarefs['exchanges'] as $item)
                                                    <tr class="kh16" style="text-align:center;">
                                                        <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                        <td>
                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                        </td>
                                                        <td>{{ $item->user->name }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                        <td>{{ phpformatnumber($item->rate)}}</td>
                                                        <td>{{ $item->note }}</td>
                                                    </tr>
                                                 @endforeach
                                              </tbody>
                                          </table>
                                      </td>
                                    </tr>

                                @endif
                            @endforeach
                            <tr>
                                <td colspan=13>
                                    <table id="tbl_summary" class="kh16-b tbl_summary">
                                        <thead>
                                            <th>ប្រភេទទូទាត់</th>
                                            <th>សរុបលុយវេរ</th>
                                            <th>សរុបសេវ៉ា</th>
                                            <th>សរុបលុយបើក</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($summary as $s)
                                            <tr class="rowclick">
                                                <td>{{ $s->paymethod }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($s->tamt) .  $s->currency->sk }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($s->tcharge) . $s->currency->sk }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($s->tamt-$s->tcharge) . $s->currency->sk }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>


                            </tr>
                        </tbody>
        </table>
    </div>
</div>
