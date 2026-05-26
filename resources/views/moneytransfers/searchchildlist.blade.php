@foreach ($children as $key => $c)
<tr class="rowclick">
    <td style="text-align:center;width:60px;">{{ ++$key }}</td>
    <td>{{ $c->name }}</td>
    <td>{{ $c->customer->name }}</td>
    <td>{{'ស្រុក' . $c->district->name . ' ខេត្ត' . $c->province->name}}</td>
    <td style="display:none;">{{ $c->id }}</td>
    <td style="text-align:center;width:60px;">
           <a href="#" class="btn btn-info btn-md btn_select" data-id="{{ $c->id }}">Select</a>
    </td>
</tr>
@endforeach