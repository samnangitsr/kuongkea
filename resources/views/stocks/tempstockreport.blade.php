@php
$sumprofit=0;
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        $dc=strlen((float)$fp)-2;
            if($dc>6){
                $dc=6;
            }
        }
        return number_format($num,$dc,'.',',');
    }
@endphp
<table class="table table-bordered table-hover tbl_stockreport" style="table-layout:fixed;width:100%;padding:0px;">
  <thead class="kh16" style="text-align:center;">
       <th style="width:30px;">លរ</th>
       <th style="display:none;">លេខកូដ</th>
       <th style="width:70px;">ទឹកមាស</th>
       <th style="width:70px;">រូបិយប័ណ្ណ</th>

       <th style="width:100px;">ស្តុកដើមគ្រា</th>
       <th style="width:100px;">ទិញចូល</th>
       <th style="width:100px;">លក់ចេញ</th>
       {{-- <th style="width:100px;">សរុបលក់</th> --}}
       <th style="width:100px;">សរុបដើម</th>
       <th style="width:100px;">ចំណេញ/ខាត</th>
       <th style="width:150px;">ស្តុកចុងគ្រា</th>
       {{-- <th style="width:150px;">គិតជាលុយ</th> --}}
  </thead>
  <tbody id="stockreport">
    @php
        $total_amount=0;
    @endphp
    @foreach ($report as $key=>$r)
        @php
            $total_amount+=floatval($r->amount);
        @endphp
        @php
            $sumprofit+=$r->totalsale-$r->totalbuy;
        @endphp
        <tr>
            <td style="text-align:center;">{{ ++$key }}</td>
            <td style="display:none;">
                <input type="hidden" name="curid[]" value="{{ $r->currency_id }}">
            </td>
            <td class="kh16-b" style="text-align:center;color:blueviolet;">
                <input type="text" class="form-control kh22-b" name="txtgoldwater[]" value="{{ $r->goldwater }}" style="background-color:gold;text-align:right;" readonly>
            </td>
            <td class="kh16-b" style="">
                <a href="{{ route('stock.viewexchangeprofitdetailbycurrency',['curid'=>$r->currency_id,'tuochek'=>$r->currency->tuochek,'viewdate'=>$r->viewdate,'stockdate'=>$r->stockdate,'todate'=>$r->todate,'userid'=>$r->user_id,'curname'=>$r->currency->curname,'username'=>$r->user->name??'All']) }}" class="btn btn-primary kh16-b" style="width:100%;" target="_blank()">{{ $r->currency->curname . '(' . $r->currency->shortcut . ')' }}</a>
            </td>

            <td class="kh16-b" style="text-align:right;"  title="{{ date('d-M-y',strtotime($r->stockdate)) }}">
              {{ phpformatnumber($r->startstock) . ' ' . $r->currency->sk }} <br> {{ phpformatnumber($r->startamount) . ' $' }} <br>
                @if($r->goldwater>0)
                    @if($r->currency->optsign=='/')
                        @if($r->startamount<>0)
                            <span style="color:black;">{{ '('. phpformatnumber($r->startstock/$r->startamount) . ')' }}</span>
                        @endif
                    @else
                        @if($r->startstock<>0)
                            {{-- <span style="color:black;">{{ '(' . phpformatnumber(($r->startamount * 10000)/($r->startstock * $r->goldwater)) . ')' }}</span> --}}
                            <span style="color:black;">{{ '(' . phpformatnumber($r->startamount/$r->startstock*100) . ')' }}</span>

                        @endif
                    @endif
                @else
                    @if($r->currency->optsign=='/')
                        @if($r->startamount<>0)
                            <span style="color:black;">{{ '('. phpformatnumber($r->startstock/$r->startamount) . ')' }}</span>
                        @endif
                    @else
                        @if($r->startstock<>0)
                            <span style="color:black;">{{ '(' . phpformatnumber($r->startamount/$r->startstock) . ')' }}</span>
                        @endif
                    @endif

                @endif
            </td>

            <td class="kh16-b" style="color:blue;text-align:right;">
                {{ phpformatnumber($r->buyqty) . ' ' . $r->currency->sk}} <br>
                <span style="color:red;">{{ phpformatnumber($r->buyamt) . ' $' }}</span> <br>
                @if($r->goldwater>0)
                    @if($r->currency->optsign=='/')
                        @if($r->buyamt<>0)
                            <span style="color:black;">{{ '('. phpformatnumber($r->buyqty/$r->buyamt) . ')' }}</span>
                        @endif
                    @else
                        @if($r->buyqty<>0)
                            {{-- <span style="color:black;">{{ '(' . phpformatnumber(($r->buyamt*10000)/($r->buyqty*$r->goldwater)) . ')' }}</span> --}}
                            <span style="color:black;">{{ '(' . phpformatnumber($r->buyamt/$r->buyqty*100) . ')' }}</span>
                        @endif
                    @endif
                @else
                    @if($r->currency->optsign=='/')
                        @if($r->buyamt<>0)
                            <span style="color:black;">{{ '('. phpformatnumber($r->buyqty/$r->buyamt) . ')' }}</span>
                        @endif
                    @else
                        @if($r->buyqty<>0)
                            <span style="color:black;">{{ '(' . phpformatnumber($r->buyamt/$r->buyqty) . ')' }}</span>
                        @endif
                    @endif

                @endif
            </td>
            <td class="kh16-b" style="color:red;text-align:right;">
                {{ phpformatnumber($r->qtysale) . ' ' . $r->currency->sk}} <br>
                <span style="color:blue;">{{ phpformatnumber($r->totalsale) . ' $' }}</span> <br>
                @if($r->goldwater>0)
                    @if($r->currency->optsign=='/')
                        @if($r->totalsale<>0)
                            <span style="color:black;">{{ '('. phpformatnumber($r->qtysale/$r->totalsale) . ')' }}</span>
                        @endif
                    @else
                        @if($r->qtysale<>0)
                            {{-- <span style="color:black;">{{ '(' . phpformatnumber(($r->totalsale*10000)/($r->qtysale * $r->goldwater)) . ')' }}</span> --}}
                            <span style="color:black;">{{ '(' . phpformatnumber($r->totalsale/$r->qtysale*100) . ')' }}</span>
                        @endif
                    @endif
                @else
                    @if($r->currency->optsign=='/')
                        @if($r->totalsale<>0)
                            <span style="color:black;">{{ '('. phpformatnumber($r->qtysale/$r->totalsale) . ')' }}</span>
                        @endif
                    @else
                        @if($r->qtysale<>0)
                            <span style="color:black;">{{ '(' . phpformatnumber($r->totalsale/$r->qtysale) . ')' }}</span>
                        @endif
                    @endif
                @endif
            </td>
            {{-- <td class="kh16-b" style="text-align:right;color:red;">{{ phpformatnumber($r->totalsale) . ' $' }}</td> --}}
            <td class="kh16-b" style="color:blue;text-align:right;"><br>{{ phpformatnumber($r->totalbuy) . ' $' }}</td>
            <td class="kh16-b" style="text-align:right;@if($r->totalsale-$r->totalbuy>0) color:blue; @else color:red; @endif">{{ number_format($r->totalsale-$r->totalbuy,2,'.',',') . ' $' }}</td>
            <td class="kh16-b" style="padding:0px">
                <input type="hidden" name="iscurgold[]" value="{{$r->currency->isgold??0}}">
                @if($r->goldwater>0)
                    <input type="text" title="ទម្ងន់ផ្លាទីន" style="padding:5px 10px 0px 10px;; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="stock_platin[]" value="{{ phpformatnumber($r->stock_platin)}}" readonly>
                @else
                    <input type="hidden" style="padding:5px 10px 0px 10px;; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="stock_platin[]" value="{{ phpformatnumber($r->stock_platin)}}" readonly>
                @endif
                <input type="text" title="ទម្ងន់មាស" style="padding:5px 10px 0px 10px;; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="stock[]" value="{{ phpformatnumber($r->stock) . ' ' . $r->currency->sk}}" readonly>
                <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="amtstock[]" value="{{ phpformatnumber($r->amount) . ' $' }}" readonly>
                @if($r->goldwater>0)
                    @if($r->currency->optsign=='/')
                        @if($r->amount<>0)
                            <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="ratestock[]" value="{{phpformatnumber($r->stock/$r->amount) }}" readonly>
                            {{-- <span style="color:black;">{{ '('. phpformatnumber($r->stock/$r->amount) . ')' }}</span> --}}
                        @else
                            <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="ratestock[]" value="1" readonly>
                        @endif
                    @else
                        @if($r->stock<>0)
                            {{-- <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="ratestock[]" value="{{ phpformatnumber(($r->amount * 10000)/($r->stock * $r->goldwater)) }}" readonly> --}}
                            {{-- <span style="color:black;">{{ '(' . phpformatnumber($r->amount/$r->stock) . ')' }}</span> --}}
                            <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="ratestock[]" value="{{ phpformatnumber($r->amount/$r->stock*100) }}" readonly>

                        @else
                            <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="ratestock[]" value="1" readonly>
                        @endif
                    @endif
                @else
                    @if($r->currency->optsign=='/')
                        @if($r->amount<>0)
                            <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="ratestock[]" value="{{phpformatnumber($r->stock/$r->amount) }}" readonly>
                            {{-- <span style="color:black;">{{ '('. phpformatnumber($r->stock/$r->amount) . ')' }}</span> --}}
                        @else
                            <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="ratestock[]" value="1" readonly>
                        @endif
                    @else
                        @if($r->stock<>0)
                            <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="ratestock[]" value="{{ phpformatnumber($r->amount/$r->stock) }}" readonly>
                            {{-- <span style="color:black;">{{ '(' . phpformatnumber($r->amount/$r->stock) . ')' }}</span> --}}
                        @else
                            <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="ratestock[]" value="1" readonly>
                        @endif
                    @endif

                @endif
            </td>

        </tr>
    @endforeach
    <tr style="background-color:aquamarine">
        <td class="kh16-b" colspan=7 style="text-align:center;font-family:Noto Sans Khmer;">សរុបប្រាក់ចំណេញ</td>
        <td class="kh16-b" style="text-align:right;@if($sumprofit>0) color:blue; @else color:red @endif">
          {{ number_format($sumprofit,2,'.',',') . ' $' }}
      </td>
      <td class="kh16-b" style="text-align:right;">
        {{ number_format($total_amount,2,'.',',') . ' $' }}
      </td>
    </tr>
  </tbody>
</table>
