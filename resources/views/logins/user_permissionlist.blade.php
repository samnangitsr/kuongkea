{{-- @foreach ($user->permission as $key => $usp)
	<tr>
		<td style="width:50px;text-align:center;">{{ ++$key }}</td>
		<td style="font-family:arial;text-align:right;">{{ $usp->code }}</td>
		<td style="font-family:khmer os system;">{{ $usp->name }}</td>
		<td style="padding:0px;width:100px;">
			<input type="number" name="pcdt1" class="form-control" style="width:100px;" value="{{ $usp->pivot->pcdt }}">
		</td>
		<td style="width:85px;padding-left:5px;padding-top:2px;">
			<a href="#" class="btn btn-warning btn-sm btn_update_p" data-perid="{{ $usp->id }}"><i class="fa fa-pencil"></i></a>
			<a href="#" class="btn btn-danger btn-sm btn_delete_p" data-perid="{{ $usp->id }}"><i class="fa fa-trash"></i></a>
		</td>
	</tr>
@endforeach --}}

@foreach ($pu as $key => $usp)
	<tr>
		<td style="width:80px;text-align:center;">{{ ++$key }}</td>
		<td style="text-align:right;width:80px;">{{ $usp->permission->code }}</td>
		<td style="">{{ $usp->permission->name }}</td>
		<td style="padding:0px;width:150px;">
			<input type="number" name="pcdt1" class="form-control" style="width:150px;height:30px;font-size:16px;" value="{{ floatval($usp->pcdt) }}">
		</td>
		<td style="width:120px;padding:0px;text-align:center;">
			<a href="#" class="btn btn-warning btn-sm btn_update_p" data-perid="{{ $usp->permission->id }}"><i class="fa fa-pencil"></i></a>
			<a href="#" class="btn btn-danger btn-sm btn_delete_p" data-perid="{{ $usp->permission->id }}"><i class="fa fa-trash"></i></a>
		</td>
	</tr>
@endforeach
