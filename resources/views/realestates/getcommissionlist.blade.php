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
    <div class="tableFixHead1" style="padding:0px;">
        <table id="mytable" class="table table-bordered table-hover kh14-b tbl_transferlist" style="table-layout:fixed;">
            <thead style="text-align:center;" class="kh14">
                <th style="width:70px;">No</th>
                <th style="width:100px;">ID</th>
                <th style="width:150px;">អ្នកលក់</th>
                <th style="width:150px;">អតិថិជន</th>
                <th style="width:100px;">អចលនទ្រព្យ</th>
                <th style="width:120px;">ទឹកប្រាក់លក់</th>
                <th style="width:120px;">សរុបលុយកក់</th>
                <th style="width:120px;">ទឹកប្រាក់នៅសល់</th>
                <th style="width:100px;">កក់ចុងក្រោយ</th>
                <th style="width:100px;">បង់ខែ</th>
                <th style="width:120px;">កក់ចំនួន</th>
                <th style="width:120px;">កម្រៃជើងសារ</th>
                <th style="width:120px;">បានទូទាត់រួច</th>
                <th style="width:120px;">នៅខ្វះ</th>
            </thead>

            <tbody id="body_transaction">
                @php
                    $j=0;
                @endphp
                @foreach ($transfers->whereNull('ispaytosaler') as $key => $t)
                    @php
                        $j+=1;
                    @endphp
                   <tr style="@if($t->status==0) background-color:pink; @endif">
                        <td style="text-align:center;padding:0px;" >
                            <div class="dropdown" style="border-style:none;">
                                <button style="width:100%;border-style:none;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ $j }}</button>
                                <ul class="dropdown-menu">
                                    @if($t->status==1)
                                        <li class="li_code16" title="code:1.6"><a href="#" class="dropdown-item kh16-b btnpayment" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-salerid="{{ $t->parrent_id }}" data-salername="{{ $t->partner->name }}" data-commission="{{ $t->commission }}" data-deposited="{{ $t->commission_paid }}" data-balance="{{ abs($t->commission)-abs($t->commission_paid) }}" data-curname="{{ $t->currency->shortcut }}" data-curid="{{ $t->currency_id }}"><i class="fa fa-money"></i> ទូទាត់កំរៃជើងសារ</a></li>
                                        <li class="li_code161" title="code:1.6.1"><a href="#" class="dropdown-item kh16-b btnremovecommission" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-groupid="{{ $t->ref_group_id }}" data-status="{{ $t->status }}"><i class="fa fa-minus" style=""></i> ដកចេញ</a></li>
                                        <li class="li_code162" title="code:1.6.2"><a href="#" class="dropdown-item kh16-b btnfixerrorinfo" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-groupid="{{ $t->ref_group_id }}" data-status="{{ $t->status }}"><i class="fa fa-info" style=""></i> Fix Info Error</a></li>

                                        @else
                                        <li class="li_code161" title="code:1.6.1"><a href="#" class="dropdown-item kh16-b btnremovecommission" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-groupid="{{ $t->ref_group_id }}" data-status="{{ $t->status }}"><i class="fa fa-repeat" style=""></i> យកវិញ</a></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->partner->name }}</td>
                        <td>{{ $t->customername }}</td>
                        <td>{{ $t->propertyname }}</td>
                        <td style="text-align:right;">{{ phpformatnumber(abs($t->sold_amount)) . '$'}}</td>

                        <td class="" style="text-align:right;">
                            <a href="{{ route('realestate.showdeposit',['id'=>$t->main_id,'customer_id'=>$t->main_parrent_id,'customertype'=>$t->main_customertype,'term'=>$t->main_term,'rate'=>$t->main_interest_rate,'startdate'=>$t->main_startdate,'enddate'=>$t->main_enddate,'curid'=>$t->currency_id,'cursk'=>$t->currency->sk,'curname'=>$t->currency->shortcut,'payinmonth'=>$t->main_payinmonth,'sendername'=>$t->propertyname]) }}" class="kh16-b " target="_blank" style="margin:0px;padding:2px;">{{ phpformatnumber($t->sumdeposit) . $t->currency->sk . '(' . $t->countrow . ')' }}</a>
                        </td>
                        <td style="text-align:right;">{{ phpformatnumber(abs($t->sold_amount)-abs($t->sumdeposit)) . '$' }}</td>

                        <td>{{ date('d-m-Y',strtotime($t->deposit_date)) }}</td>
                        <td>{{ date('d-m-Y',strtotime($t->payformonth)) }}</td>
                        <td style="text-align:right;color:red;">{{ phpformatnumber($t->deposit_amount) . $t->currency->sk}}</td>

                        <td style="text-align:right;">{{ phpformatnumber($t->commission) . $t->currency->sk}}</td>
                        <td style="text-align:right;">
                            <a href="{{ route('realestate.showcommissionpaid_detail',['payonid'=>$t->payonid,'customer_id'=>$t->parrent_id,'id'=>$t->id]) }}" class="kh16-b " target="_blank" style="margin:0px;padding:2px;"> {{ phpformatnumber($t->commission_paid) . $t->currency->sk}}{{ '(' . $t->countpay_commission . ')'}}</a>
                        </td>
                        <td style="text-align:right;">{{ phpformatnumber(abs($t->commission)-abs($t->commission_paid)) . $t->currency->sk}}</td>
                   </tr>
                @endforeach
            </tbody>

        </table>
      </div>
</div>
<div class="row" style="margin-top:10px;">
    <table id="mytable" class="table table-bordered table-hover kh14-b tbl_transferlist" style="">
        <thead style="text-align:center;" class="kh14">
            <th style="width:70px;">No</th>
            <th style="width:100px;">ID</th>
            <th style="width:100px;">អតិថិជនកក់</th>
            <th style="width:100px;">ថ្ងៃកក់</th>

            <th style="width:150px;">អ្នកលក់</th>
            <th style="width:150px;">ថ្ងៃទូទាត់</th>
            <th style="width:80px;">ចំនួនទូទាត់</th>
            <th style="width:200px;">ទូទាត់តាម</th>
            <th style="width:80px;">អចល</th>
            <th style="width:120px;">កម្រៃជើងសារ</th>
            <th style="width:120px;">បានទូទាត់រួច</th>
            <th style="width:120px;">នៅខ្វះ</th>
        </thead>
        <tbody id="body_transaction">
            @php
                $i=0;
            @endphp
            @foreach ($transfers->where('ispaytosaler',1) as $key => $t)
                @php
                    $i+=1;
                @endphp
                <tr>
                    <td style="text-align:center;padding:0px;" >
                        <div class="dropdown" style="border-style:none;">
                            <button style="width:100%;border-style:none;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ $i }}</button>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-groupid="{{ $t->ref_group_id }}"><i class="fa fa-print"></i> ព្រីនឡើងវិញ</a></li>
                                <li class="li_code161" title="code:1.6.1"><a href="#" class="dropdown-item kh16-b btndelete" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-groupid="{{ $t->ref_group_id }}"><i class="fa fa-trash" style="color:red;"></i> លុប</a></li>
                                @if(Auth::user()->role->name=='Admin')
                                    <li>
                                        <a href="{{ route('realestate.showcommissionlink',['payonid'=>$t->payonid,'customer_id'=>$t->parrent_id,'id'=>$t->id,'group_id' => $t->ref_group_id]) }}" class="dropdown-item kh16-b " target="_blank" style=""><i class="fa fa-pencil"></i> LinkGroup</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                    <td>{{ $t->id }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($t->deposit_amount) . $t->currency->sk}}</td>
                    <td>{{ date('d-m-Y',strtotime($t->deposit_date)) }}</td>
                    <td>{{ $t->partner->name }}</td>
                    <td>{{ date('d-m-Y',strtotime($t->dd)) . ' ' . $t->tt }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($t->amount) . $t->currency->sk}}</td>
                    <td>
                        <a href="#c{{ $t->id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse">{{ $t->deposit_via }}</a>
                    </td>
                    <td>{{ $t->propertyname }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($t->commission) . $t->currency->sk}}</td>
                    <td style="text-align:right;">
                        <a href="{{ route('realestate.showcommissionpaid_detail',['payonid'=>$t->payonid,'customer_id'=>$t->parrent_id,'id'=>$t->id]) }}" class="kh16-b " target="_blank" style="margin:0px;padding:2px;"> {{ phpformatnumber($t->commission_paid) . $t->currency->sk}}{{ '(' . $t->countpay_commission . ')'}}</a>
                    </td>
                    <td style="text-align:right;">{{ phpformatnumber(abs($t->commission)-abs($t->commission_paid)) . $t->currency->sk}}</td>
                </tr>
                <tr id="c{{ $t->id }}" class="collapse borderset2" style="">
                    <td colspan=5 style="">
                        <table class="" style="margin:0px 0px 2px 0px;">
                            <thead style="text-align:center;">
                                <th style="border:1px solid black;">ID</th>
                                <th style="border:1px solid black;">ថ្ងៃទី</th>
                                <th style="border:1px solid black;">ប្រតិបត្តិការណ៏</th>
                                <th style="border:1px solid black;">ឈ្មោះដៃគូ</th>
                                <th style="border:1px solid black;">ចំនួនទឹកប្រាក់</th>
                            </thead>
                            <tbody>
                                @foreach (App\PartnerTransfer::showbyrefgroupid8($t->id,$t->ref_group_id)[1] as $trf)
                                    <tr>
                                        <td>{{ $trf->id }}</td>
                                        <td>{{ date('d-m-Y',strtotime($trf->dd)) . ' ' . $trf->tt }}</td>
                                        <td>{{ $trf->tranname }}</td>
                                        <td>{{ $trf->partner->name }}</td>
                                        <td style="text-align:right;">{{ phpformatnumber($trf->amount) . $trf->currency->sk }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </td>
                    <td colspan=5>
                        <table class="" style="margin:0px 0px 2px 0px;">
                            <thead style="text-align:center;">
                                <th style="border:1px solid black;">ID</th>
                                <th style="border:1px solid black;">ថ្ងៃបើក</th>
                                <th style="border:1px solid black;">អ្នកកត់ត្រា</th>
                                <th style="border:1px solid black;">ចំនួនទឹកប្រាក់</th>

                            </thead>
                            <tbody>
                                @foreach (App\PartnerTransfer::showbyrefgroupid8($t->id,$t->ref_group_id)[0] as $cd)
                                    <tr>
                                        <td>{{ $cd->id }}</td>
                                        <td>{{ date('d-m-Y',strtotime($cd->opdate)) . ' ' . $cd->optime }}</td>
                                        <td>{{ $cd->user->name }}</td>
                                        <td style="text-align:right;">{{ phpformatnumber($cd->amount) . $cd->currency->sk }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
