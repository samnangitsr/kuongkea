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
    $totalamt=0;
    $totaldeposit=0;
@endphp

    <div class="row" style="margin-top:0px;">
        <div class="tableFixHead" style="padding:0px;">
           <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
               <thead style="text-align:center;" class="kh16">
                   <th style="width:60px;">No</th>
                   <th style="width:100px;">ID</th>
                   <th style="width:100px;">ថ្ងៃលក់</th>
                   <th style="width:200px;">ឈ្មោះអចលនទ្រព្យ</th>
                   <th id="th_customer" style="width:200px;">អ្នកលក់គំរោង</th>
                   <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                   <th style="width:150px;">បានទូទាត់រួច</th>
                   <th style="width:150px;">នៅខ្វះ</th>
               </thead>
               <tbody id="body_transaction">
                    @php
                        $i=0;
                    @endphp
                    @foreach ($transfers as $key => $item)
                        @php
                            $totalamt +=floatval($item->amount);
                            $totaldeposit +=floatval($item->deposited);
                            $i +=1;
                        @endphp
                        <tr>
                            <td style="text-align:center;">{{ $i }}</td>
                            <td>{{ sprintf('%04d',$item->id)}}</td>
                            <td>{{ date('d-m-Y',strtotime($item->dd)) }}</td>
                            <td class="kh14-b">{{ $item->sendername }}</td>
                            <td class="kh14-b">{{ $item->partner->name }}</td>
                            <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($item->amount) . $item->currency->sk }}</td>

                            <td style="text-align:right;">
                                <a href="{{ route('realestate.showcommissionpaid_detail',['payonid'=>$item->id,'customer_id'=>$item->parrent_id,'id'=>$item->id]) }}" class="mybtn kh16-b " target="_blank" style="margin:0px;padding:2px;"> {{ phpformatnumber($item->deposited) . $item->currency->sk}}{{ '(' . $item->countpay . ')'}}</a>
                            </td>
                            <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($item->amount+$item->deposited) . $item->currency->sk}}</td>
                        </tr>
                    @endforeach
               </tbody>

           </table>
        </div>
    </div>
    <div class="row" style="">
        <table id="tbl_total" class="table table-bordered kh16-b" style='margin:0px;'>
            <tr style="text-align:center;background-color:aqua;">
                <th>សរុបកម្រៃជើងសារ</th>
                <th>ទូទាត់រួច</th>
                <th>នៅខ្វះ</th>

            </tr>
            <tr style="background-color:aqua">
                <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($totalamt) . ' USD'}}</td>
                <td  style="text-align:right;" class="kh16-b">{{ phpformatnumber($totaldeposit) . ' USD'}}</td>
                <td  style="text-align:right;" class="kh16-b">{{ phpformatnumber($totalamt+$totaldeposit) . ' USD'}}</td>

            </tr>
        </table>
    </div>
