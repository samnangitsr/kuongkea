@foreach ($pls as $key => $item)
<tr>
    <td style="padding:5px;">
        <input type="text" value="{{ ++$key }}" class="form-control" style="border-style:none;width:80px;" readonly>  
    </td>
    <td style="padding:5px;display:none;">
        <input type="text" name="productid[]" value="{{ $item->id }}" class="form-control" style="border-style:none;" readonly>
    </td>
    <td style="padding:5px;">
        <input type="text" value="{{ $item->pshortcut }}" name="ppshortcut[]" class="form-control" style="border-style:none;" readonly>
    </td>
    <td style="padding:5px;">
        <input type="text" value="{{ $item->rate }}" name="pprate[]" class="form-control crate" style="border-style:none;">
    </td>
    <td style="padding:5px;width:100px;">
        <select class="form-select coperator" name="ppoperator[]">
            <option value="*" {{ $item->operator=='*'?'selected':'' }}>*</option>
            <option value="/" {{ $item->operator=='/'?'selected':'' }}>/</option> 
        </select>
        {{-- <input type="text" value="{{ $item->operator }}" class="form-control" style="border-style:none;"> --}}
    </td>
    <td style="padding:5px 0px 5px 15px;">
        <a href="" class="btn btn-warning btnpedit kh16" data-id="{{ $item->id }}">កែ</a>
        <a href="" class="btn btn-danger btnpdel kh16" data-id="{{ $item->id }}">លុប</a>
    </td>
</tr>
@endforeach