
@php
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
          $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
@endphp
<div class="table-responsive">
  <table id="tbl_mycapital" class="table table-border" style="margin:0px;padding:0px;">
    <thead style="background-color:bisque">

      @foreach ($sumusercash as $item)
        <th style="font-size:22px;text-align:right;;border:1px solid black;padding:0px 5px 0px 0px;">{{ phpformatnumber($item->tamt) . ' ' .$item->cur }}</th>
      @endforeach

    </thead>

  </table>

</div>

