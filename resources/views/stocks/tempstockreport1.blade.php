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
       <th style="width:70px;">រូបិយប័ណ្ណ</th>
       <th style="width:100px;">ស្តុកដើមគ្រា</th>
       <th style="width:100px;">ទិញចូល</th>
       <th style="width:100px;">លក់ចេញ</th>
       {{-- <th style="width:100px;">សរុបលក់</th> --}}
       <th style="width:100px;">សរុបដើម</th>
       <th style="width:100px;">ចំណេញ</th>
       <th style="width:150px;">ស្តុកចុងគ្រា</th>
       {{-- <th style="width:150px;">គិតជាលុយ</th> --}}
  </thead>
  <tbody id="stockreport">
    @foreach ($report as $key=>$r)
        @php
            $sumprofit+=$r->totalsale-$r->totalbuy;
        @endphp
        <tr>
            <td style="text-align:center;">{{ ++$key }}</td>
            <td style="display:none;">
                <input type="hidden" name="curid[]" value="{{ $r->currency_id }}">
            </td>
            <td class="kh16-b" style="">
                <a href="{{ route('stock.viewexchangeprofitdetailbycurrency1',['curid'=>$r->currency_id,'viewdate'=>$r->viewdate,'enddate'=>$r->enddate,'userid'=>$r->user_id,'curname'=>$r->currency->curname,'username'=>$r->user->name]) }}" class="btn btn-primary kh16-b" style="width:100%;" target="_blank()">{{ $r->currency->curname . '(' . $r->currency->shortcut . ')' }}</a>
            </td>
            <td class="kh16-b" style="text-align:right;"  title="{{ date('d-M-y',strtotime($r->stockdate)) }}">
              {{ phpformatnumber($r->startstock) . ' ' . $r->currency->sk }} <br> {{ phpformatnumber($r->startamount) . ' $' }} <br>
                @if($r->currency->optsign=='/')
                    @if($r->startamount<>0)
                        <span style="color:black;">{{ '('. phpformatnumber($r->startstock/$r->startamount) . ')' }}</span>
                    @endif
                @else
                    @if($r->startstock<>0)
                        <span style="color:black;">{{ '(' . phpformatnumber($r->startamount/$r->startstock) . ')' }}</span>
                    @endif
                @endif
            </td>

            <td class="kh16-b" style="color:blue;text-align:right;">
                {{ phpformatnumber($r->buyqty) . ' ' . $r->currency->sk}} <br>
                <span style="color:red;">{{ phpformatnumber($r->buyamt) . ' $' }}</span> <br>
                @if($r->currency->optsign=='/')
                    @if($r->buyamt<>0)
                        <span style="color:black;">{{ '('. phpformatnumber($r->buyqty/$r->buyamt) . ')' }}</span>
                    @endif
                @else
                    @if($r->buyqty<>0)
                        <span style="color:black;">{{ '(' . phpformatnumber($r->buyamt/$r->buyqty) . ')' }}</span>
                    @endif
                @endif
            </td>

            <td class="kh16-b" style="color:red;text-align:right;">
                {{ phpformatnumber($r->qtysale) . ' ' . $r->currency->sk}} <br>
                <span style="color:blue;">{{ phpformatnumber($r->totalsale) . ' $' }}</span> <br>
                @if($r->currency->optsign=='/')
                    @if($r->totalsale<>0)
                        <span style="color:black;">{{ '('. phpformatnumber($r->qtysale/$r->totalsale) . ')' }}</span>
                    @endif
                @else
                    @if($r->qtysale<>0)
                        <span style="color:black;">{{ '(' . phpformatnumber($r->totalsale/$r->qtysale) . ')' }}</span>
                    @endif
                @endif
            </td>
            {{-- <td class="kh16-b" style="text-align:right;color:red;">{{ phpformatnumber($r->totalsale) . ' $' }}</td> --}}
            <td class="kh16-b" style="color:blue;text-align:right;"><br>{{ phpformatnumber($r->totalbuy) . ' $' }}</td>
            <td class="kh16-b" style="text-align:right;">{{ number_format($r->totalsale-$r->totalbuy,2,'.',',') . ' $' }}</td>
            <td class="kh16-b" style="padding:0px">
                <input type="text" style="padding:5px 10px 0px 10px;; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="stock[]" value="{{ phpformatnumber($r->stock) . ' ' . $r->currency->sk}}" readonly>
                <input type="text" style="padding:0px 10px 0px 10px; border-style:none;text-align:right;background-color:inherit;font-weight:bold;" class="form-control" name="amtstock[]" value="{{ phpformatnumber($r->amount) . ' $' }}" readonly>
                @if($r->currency->optsign=='/')
                    @if($r->amount<>0)
                        <span style="color:black;">{{ '('. phpformatnumber($r->stock/$r->amount) . ')' }}</span>
                    @endif
                @else
                    @if($r->stock<>0)
                        <span style="color:black;">{{ '(' . phpformatnumber($r->amount/$r->stock) . ')' }}</span>
                    @endif
                @endif
            </td>

        </tr>
    @endforeach
    <tr style="background-color:aquamarine">
        <td class="kh16-b" colspan=6 style="text-align:center;font-family:Noto Sans Khmer;">សរុបប្រាក់ចំណេញ</td>
        <td class="kh16-b" style="text-align:right;">
          {{ number_format($sumprofit,2,'.',',') . ' $' }}
      </td>
      <td class="kh16-b">

      </td>
    </tr>
  </tbody>
</table>
