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
     function phpformatnumber2d($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
            $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
    function bongkot($amount,$cur)
      {
        if($cur=='រៀល'){
            $amt = round($amount / 100) * 100;
        }else if($cur=='បាត'){
            $amt = round($amount);
        }else{
            $amt=$amount;
        }
        if($cur=='ដុល្លា'){
            return phpformatnumber2d($amt);
        }else{
            return phpformatnumber($amt);
        }
      }
@endphp
@php
    $sumproduct =0;
    $sumamount =0;
    $sumdebt =0;
    $balance=0;
@endphp
<table id="tbl_seedetail" class="table table-bordered table-hover kh14 tbl_seedetail">
                    <thead style="text-align:center;background-color:rgb(241, 172, 230);">
                        <th>លរ</th>
                        <th> <button type="button" class="mybtn" id="updateSelected" style="float:left;">Hide</button> TrID</th>
                        <th>បរិយាយ</th>
                        <th>ប្រភេទ</th>
                        <th style="width:200px;">
                            <select class="" style="width:200px;" name="sel_agent" id="sel_agent">
                                <option value="all">all</option>
                                @foreach ($agentnames as $item)
                                    <option value="{{ $item->agent_name }}">{{ $item->agent_name }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th>ទិញ/លក់</th>
                        <th>សរុបទឹកប្រាក់</th>
                        {{-- <th>ប្រាក់កក់</th>
                        <th>នៅខ្វះ</th> --}}
                        {{-- <th>សមតុល្យ</th> --}}
                        <th>ថ្ងៃទី</th>
                        <th>ផ្សេងៗ</th>
                        <th>អ្នកកត់ត្រា</th>
                        <th>GroupId</th>

                    </thead>
                    <tbody id="body_seedetail">
                        @foreach ($userreportdetails as $key =>$d)
                            @php
                                $sumproduct += $d->buysale;
                                $sumamount += $d->amount;
                                $sumdebt +=$d->debt;
                                $balance +=$d->amount-$d->debt;
                            @endphp
                            <tr>
                                <td style="text-align:center;">{{ ++$key }}</td>
                                 <td class="kh12-b" style="text-align:right;">
                                    <input type="checkbox" name="ids[]" value="{{ $d->id }}" style="float:left;">
                                    <a  href="{{ route('usercapital.seedetaillink',['id'=>$d->tran_id,'group_id'=>$d->group_id,'tablename'=>$d->table,'fromdate'=>$d->from_date,'todate'=>$d->to_date,'ismain'=>$ismain,'userid'=>$userid,'curid'=>$curid,'curshortcut'=>$curshortcut,'username'=>$username]) }}" target="_blank" style="padding:2px;" class="mybtn">
                                        {{ $d->tran_id?$d->tran_id:'View' }}
                                    </a>
                                    @if($d->group_id)
                                        <a href="{{ route('usercapital.showrefgroupid',['group_id'=>$d->group_id,'showdelbuton'=>false]) }}" class="mybtn" target="_blank" style="margin:0px;padding:2px;">{{ $d->group_id??'' }}</a>
                                    @endif
                                </td>
                                <td class="kh14-b">
                                    @if($d->invnum==null)
                                        {{ $d->description }}
                                    @else
                                        <a href="{{ route('invoice.invoicedetail',['invid'=>$d->invnum]) }}" target="_blank" class="@if($d->buysale>0) blue  @else red @endif">
                                            {{ $d->description }}
                                        </a>
                                    @endif
                                </td>
                                <td class="kh14-b">
                                  {{ $d->capital_type }}
                                </td>
                                <td class="kh14-b">
                                  {{ $d->agent_name }}
                                </td>

                                <td class="kh14-b buysale" style="text-align:right;@if($d->buysale>0) color:blue; @elseif($d->buysale<0) color:red; @endif">{{ phpformatnumber2d($d->buysale) . ' ' . $d->cur }} @if($d->buysale<>0) <br> <span class="kh10-b" style="color:grey;">{{ phpformatnumber2d($sumproduct) }}</span>@endif</td>
                                <td class="kh14-b amount" style="text-align:right;@if($d->amount>0) color:blue; @elseif($d->amount<0) color:red; @endif">{{ phpformatnumber2d($d->amount) . ' USD'}} @if($d->amount<>0)<br> <span class="kh10-b" style="color:grey;">{{ phpformatnumber2d($balance) }} </span> @endif</td>
                                {{-- <td style="text-align:right;">{{ phpformatnumber($d->deposit) . ' USD'}}</td>
                                <td style="text-align:right;">{{ phpformatnumber($d->debt) . ' USD'}}</td> --}}
                                {{-- <td class="kh14-b" style="text-align:right;">{{ phpformatnumber2d($balance) . ' USD'}}</td> --}}

                                <td class="kh12-b" style="text-align:right;">
                                    {{ date('d-m-y',strtotime($d->dd))}}
                                    @if($d->trantime>0)
                                       {{  ' ' . $d->trantime}}
                                    @endif
                                </td>
                                <td class="kh12-b" style="text-align:right;">{{ $d->note??'' }}</td>
                                <td class="kh12-b" style="text-align:right;@if($d->recordby<>$username)color:red;@endif">{{ $d->recordby??'' }}</td>
                                <td>{{ $d->group_id }}</td>
                            </tr>
                        @endforeach
                        <tr class="kh18-b">
                            <td colspan=5 style="text-align:center;">សរុប</td>
                            @if($ismain==0)
                                <td style="text-align:right;background-color:greenyellow">{{ bongkot($sumproduct,$curname) . ' ' . $curname }}</td>
                            @else
                                <td></td>
                            @endif

                            <td style="text-align:right;background-color:greenyellow">{{ phpformatnumber($sumamount) . ' USD' }}</td>
                            <td colspan=3 style="text-align:right;"></td>
                            {{-- <td style="text-align:right;">{{ phpformatnumber($sumdebt) . ' USD'}}</td> --}}
                        </tr>
                        <tr class="kh18-b" style="background-color:aqua">
                            <td colspan=4 style="text-align:center;">សរុបទូទាត់</td>
                            <td colspan=5 style="text-align:right;">{{ phpformatnumber($sumamount-$sumdebt) . ' USD' }}</td>
                        </tr>
                    </tbody>
                </table>
