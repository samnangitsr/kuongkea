 @foreach ($customers as $key => $a)
                            <tr class="rowclick" style="@if($a->status==0) color:red;text-decoration:line-through; @endif">
                                <td class="kh16" style="text-align:center;">{{ ++$key }}</td>
                                <td class="kh16-b" style="text-align:center;">{{ $a->id }}</td>
                                <td class="kh16-b">{{ $a->name }}</td>
                                <td class="kh16-b">{{ $a->sex==1?'ប្រុស':'ស្រី' }}</td>
                                <td class="kh16">{{ $a->tel }}</td>
                                 <td class="kh16">{{ $a->user->name }}</td>
                                <td style="text-align:right;">
                                    @if($a->status==1)
                                        <a href="#" style="padding-right:3px;" class="btn btn-sm btn-warning btn_edit" data-id="{{ $a->id }}" data-name="{{ $a->name }}" data-sex="{{ $a->sex }}" data-tel="{{ $a->tel }}" ><i class="fa fa-pencil" style="color:green"></i></a>
                                    @else
                                        <a href="#" style="padding-right:3px;color:green;" class="btn btn-sm btn-warning btn_restore" data-id="{{ $a->id }}" data-name="{{ $a->name }}" data-status="{{ $a->status }}" data-action="restore"><i class="fa fa-repeat"></i></a>
                                    @endif
                                    <a href="#" style="padding-right:3px;" class="btn btn-sm btn-danger btn_delete" data-id="{{ $a->id }}" data-name="{{ $a->name }}" data-status="{{ $a->status }}" data-action="delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
