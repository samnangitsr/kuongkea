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
  <div class="tableFixHead1" style="padding:0px;">
            <table id="tbl_commission_list" class="table table-bordered table-hover kh14-b tbl_transferlist" style="table-layout:fixed;">
                <thead style="text-align:center;" class="kh14">
                    <th style="width:70px;">No</th>
                    <th style="width:100px;text-align:left;padding-left:5px;">
                        <input class="form-check-input" type="checkbox" name="ckidall" value="" id="ckidall" />
                        <label class="form-check-label" for="ckidall">ALL</label>
                    </th>
                    <th style="width:100px;">
                        <button id="btnsortproperty" class="mybtn kh12-b">Sort A->Z</button>
                    </th>
                    <th style="width:150px;">អ្នកលក់</th>
                    <th style="width:150px;">អតិថិជន</th>

                    <th style="width:100px;">បង់ខែ</th>
                    <th style="width:120px;">កក់ចំនួន</th>
                    <th style="width:120px;">បង់ជើងសារ</th>
                    <th style="width:120px;">កម្រៃជើងសារ</th>
                    <th style="width:120px;">បានទូទាត់រួច</th>
                    <th style="width:120px;">នៅខ្វះ</th>
                    <th style="width:120px;">ទឹកប្រាក់លក់</th>
                    <th style="width:120px;">សរុបលុយកក់</th>
                    <th style="width:120px;">ទឹកប្រាក់នៅសល់</th>
                    <th style="width:100px;">កក់ចុងក្រោយ</th>
                    <th style="width:100px;">Action</th>
                </thead>
                <tbody id="body_transaction">
                    @php
                        $j=0;
                    @endphp
                    @foreach ($transfers as $key => $t)
                        @php
                            $j+=1;
                        @endphp
                        <tr>
                            <td style="text-align:center;padding:0px;" >
                                {{ $j }}
                            </td>
                            <td>
                                @if($t->over_pay==0 && !$t->ispaytosaler)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="ckid" value="{{ $t->id }}" id="ckid{{ $t->id }}" />
                                        <label class="form-check-label" for="ckid{{ $t->id }}"> {{ $t->id }}</label>
                                    </div>
                                @else
                                     {{ $t->id }}
                                @endif
                            </td>
                            <td>{{ $t->propertyname }}</td>
                            <td>{{ $t->partner->name }}</td>
                            <td>{{ $t->customername }}</td>
                            <td>{{ $t->payformonth?date('d-m-Y',strtotime($t->payformonth)) : '' }}</td>
                            <td style="text-align:right;color:red;">{{ phpformatnumber($t->deposit_amount) . $t->currency->sk}}</td>
                            <td style="padding:0px;">
                                <input type="text" style="text-align:right;width:100%;height:100%;@if($t->ispaytosaler==1) border-style:none; @else background-color:yellow; @endif" class="kh16-b txtcommission tdcanenter" data-default="{{ phpformatnumber($t->getcommission) }}"  value="{{ phpformatnumber($t->getcommission) }}"  @if($t->ispaytosaler) readonly @endif>
                            </td>
                            <td style="text-align:right;">{{ phpformatnumber($t->commission) . $t->currency->sk}}</td>
                            <td style="text-align:right;">
                                <a href="{{ route('realestate.showcommissionpaid_detail',['payonid'=>$t->payonid,'customer_id'=>$t->parrent_id,'id'=>$t->id]) }}" class=" " target="_blank" style="margin:0px;padding:2px;text-decoration:underline;"> {{ phpformatnumber($t->commission_paid) . $t->currency->sk}}{{ '(' . $t->countpay_commission . ')'}}</a>
                            </td>
                            <td style="text-align:right;background-color:yellow;">{{ phpformatnumber(abs($t->commission)-abs($t->commission_paid)) . $t->currency->sk}}</td>
                            <td style="text-align:right;">{{ phpformatnumber(abs($t->sold_amount)) . '$'}}</td>
                            <td class="" style="text-align:right;">
                                <a href="{{ route('realestate.showdeposit',['id'=>$t->main_id,'customer_id'=>$t->main_parrent_id,'customertype'=>$t->main_customertype,'term'=>$t->main_term,'rate'=>$t->main_interest_rate,'startdate'=>$t->main_startdate,'enddate'=>$t->main_enddate,'curid'=>$t->currency_id,'cursk'=>$t->currency->sk,'curname'=>$t->currency->shortcut,'payinmonth'=>$t->main_payinmonth,'sendername'=>$t->propertyname]) }}" class="" target="_blank" style="margin:0px;padding:2px;text-decoration:underline;">{{ phpformatnumber($t->sumdeposit) . $t->currency->sk . '(' . $t->countrow . ')' }}</a>
                            </td>
                            <td style="text-align:right;">{{ phpformatnumber(abs($t->sold_amount)-abs($t->sumdeposit)) . '$' }}</td>

                            <td>{{ date('d-m-Y',strtotime($t->deposit_date)) }}</td>
                            <td style="text-align:center;">
                                <a href="" class="btnupdatecommission" data-id="{{ $t->id }}" style="color:red;">Update</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
