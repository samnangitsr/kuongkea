@foreach ($users as $key => $u)
	<tr>
		<td>{{ ++$key }}</td>
		<td>{{ $u->id }}</td>
		<td class="kh16-b">{{ $u->name }}</td>
		<td>
			<div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input customCheck" style="height:20px;width:20px;margin-top:0px;">
          	</div>
		</td>
	</tr>
@endforeach
