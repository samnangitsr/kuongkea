
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
@foreach ($data as $key => $d)
    <tr class="kh22">
        <td style="text-align:center;width:80px;">{{ ++$key }}</td>
        <td style="padding:0px;width:150px;display:none;">
            <input type="text" class="form-control" style="width:150px;height:45px;" name="cusid[]" value="{{ $d->customer_id }}" readonly>
        </td>
        <td>{{ $d->customer->name }}</td>
        <td style="padding:0px;width:200px;">
            <input type="text" class="form-control colusd tdcanenter inputamt" style="border-style:none;background-color:inherit;" name="balusd[]" value="{{ phpformatnumber($d->balusd) }}" readonly>
        </td>
        <td style="padding:0px;width:100px;">
            <input type="text" class="form-control kh22 inputcur" style="border-style:none;background-color:inherit;"  value="USD" readonly>
        </td>
        <td style="padding:0px;width:200px;">
            <input type="text" class="form-control colkhr tdcanenter inputamt" style="border-style:none;background-color:inherit;" name="balkhr[]" value="{{ phpformatnumber($d->balkhr) }}" readonly>
        </td>
        <td style="padding:0px;width:100px;">
            <input type="text" class="form-control kh22 inputcur" style="border-style:none;background-color:inherit;"  value="KHR" readonly>
        </td>
        <td style="padding:0px;width:200px;">
            <input type="text" class="form-control colthb tdcanenter inputamt" style="border-style:none;background-color:inherit;" name="balthb[]" value="{{ phpformatnumber($d->balthb) }}" readonly>
        </td>
        <td style="padding:0px;width:100px;">
            <input type="text" class="form-control kh22 inputcur" style="border-style:none;background-color:inherit;"  value="THB" readonly>
        </td>
    </tr>
@endforeach
<script>
     $('.colusd').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
        $('.colthb').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
        $('.colkhr').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
        $(document).on('keydown', '.tdcanenter', function (e) {
                if (e.keyCode == 13) {
                    var $this = $(this),
			        index = $this.closest('td').index();
			        $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
			        e.preventDefault();
                }
            })
</script>