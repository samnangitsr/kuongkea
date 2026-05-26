@foreach ($children as $key => $c)
<tr>
    <td style="text-align:center;">{{ ++$key }}</td>
    <td style="text-align:center;">{{ $c->no }}</td>
    <td>{{ $c->customer->name }}</td>
    <td>{{ $c->name }}</td>
    <td>{{ $c->district->name . ' ' . $c->province->name}}</td>
    <td>{{ $c->tel }}</td>
    
    <td>{{ $c->recordby }}</td>
    <td>{{ date('d-m-Y',strtotime($c->created_at)) }}</td>
    <td>
        <a href="#" class="btn btn-warning btn-md btn_edit" data-id="{{ $c->id }}" data-name="{{ $c->name }}" data-tel="{{ $c->tel }}"
            data-parent_id="{{ $c->customer_id }}" data-province_id="{{ $c->province_id }}" data-district_id="{{ $c->district_id }}" 
            data-commune_id="{{ $c->commune_id }}" data-village_id="{{ $c->village_id }}" data-no="{{ $c->no }}">Edit</a>
           <a href="#" class="btn btn-danger btn-md btn_remove" data-id="{{ $c->id }}">Delete</a>
    </td>
</tr>
@endforeach