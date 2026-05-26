@foreach ($addresses as $key => $a)
                        <tr>
                            <td style="text-align:center;width:60px;">{{ ++$key }}</td>
                            <td style="text-align:center;">{{ $a->id }}</td>
                            <td style="text-align:center;">{{ $a->type }}</td>
                            <td>{{ $a->name }}</td>
                            <td>
                              {{ $a->provinceofdistrict->name }}
                            </td>
                            <td>{{ $a->districtofcommune->name }}</td>
                           
                            <td>{{ $a->communeofvillage->name}}</td>
                            
                            <td style="width:100px;text-align:center;">
                                <a href="#" class="btn btn-warning btn-sm btn_edit" data-id="{{ $a->id }}" data-type="{{ $a->type }}" data-name="{{ $a->name }}" 
                                    data-province_id="{{ $a->province_id }}" data-district_id="{{ $a->district_id }}" data-commune_id="{{ $a->commune_id }}">Edit</a>
                                
                                <a href="#" class="btn btn-danger btn-sm btn_remove" data-id="{{ $a->id }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach