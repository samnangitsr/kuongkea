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


<div class="row">
    <div class="card">
        <div class="card-header" style="height:40px;">
            <h3 class="kh16-b">តារាងដើមទុនបុគ្គលិក</h3>
        </div>
        <div class="card-body" style="padding:0px;">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover tbl_capital kh14-b">
                        <thead style="text-align:center;">
                            <th>លរ</th>
                            <th>ម៉ោង</th>
                            <th>អ្នកកត់ត្រា</th>
                            <th>បុគ្គលិកពាក់ព័ន្ធ</th>
                            <th>ប្រតិបត្តិការណ៌</th>
                            <th>ប្រភេទ</th>
                            <th>ឈ្មោះគណនេយ្យ</th>
                            <th>ចំនួនទឹកប្រាក់</th>
                            {{-- <th>លេខយោង</th> --}}
                            <th>ផ្សេងៗ</th>
                            <th>សំគាល់</th>
                            <th>សកម្មភាព</th>

                        </thead>
                        <tbody id="tbl_usercapital">
                            @foreach ($ucs as $key =>$uc)
                                <tr class="@if($uc->amount>0) cblue @else cred @endif" style="@if($uc->status==0) text-decoration-line: line-through;text-decoration-color: red; @endif">
                                    <td style="text-align:center;border-style:solid;">{{ ++$key }}</td>
                                    <td style="border-style:solid;">{{ $uc->trantime }}</td>
                                    <td style="border-style:solid;">{{ $uc->user->name }}</td>
                                    <td style="border-style:solid;">{{ $uc->useraffect->name }}</td>
                                    <td style="border-style:solid;" title="{{ $uc->id }}">{{ $uc->tranname }}</td>
                                    <td style="border-style:solid;">{{ $uc->capital_type }}</td>
                                    <td style="border-style:solid;">{{ $uc->agentname->name }}</td>
                                    <td style="text-align:right;border-style:solid;">
                                        @if($uc->goldwater>0)
                                            <span style="float:left;color:gray;">{{ floatval($uc->goldwater) }}</span>
                                        @endif
                                        {{ phpformatnumber($uc->amount) . ' ' . $uc->currency->shortcut}}
                                    </td>
                                    {{-- <td style="text-align:center;border-style:solid;">{{ $uc->ref_number }}</td> --}}
                                    <td style="border-style:solid;">{{ $uc->note }}</td>
                                    <td style="border-style:solid;">{{ $uc->note1??'' }}</td>
                                    <td style="padding:0px;text-align:center;border-style:solid;">
                                        @if($uc->status==1)
                                            @if(Auth::user()->role->name=='Admin')
                                                @if(str_contains($uc->action,'u'))
                                                    <a href="#" class="uc_update kh12-b" style="color:blue" data-id="{{ $uc->id }}" data-ref_number="{{ $uc->ref_number }}">Edit  |</i></a>
                                                @endif
                                                @if(str_contains($uc->action,'d'))
                                                    <a href="#" class="uc_delete kh12-b" style="color:red;" data-id="{{ $uc->id }}" data-status="{{$uc->status}}" data-action="delete" data-ref_number="{{ $uc->ref_number }}" data-location_id="{{ $uc->location_id }}">Delete</i></a>
                                                @endif
                                            @else
                                                @if($uc->user_id==Auth::id())
                                                    @if(str_contains($uc->action,'u'))
                                                        {{-- @if (App\User::checkpermission(Auth::id(),1.6)) --}}
                                                            <a href="#" class="uc_update kh12-b" style="color:blue" data-id="{{ $uc->id }}" data-ref_number="{{ $uc->ref_number }}">Edit |</i></a>
                                                        {{-- @endif --}}
                                                    @endif
                                                    @if(str_contains($uc->action,'d'))
                                                        {{-- @if (App\User::checkpermission(Auth::id(),1.6)) --}}
                                                            <a href="#" class="uc_delete kh12-b" style="color:red;" data-id="{{ $uc->id }}" data-status="{{$uc->status}}" data-action="delete" data-ref_number="{{ $uc->ref_number }}" data-location_id="{{ $uc->location_id }}">Delete</i></a>
                                                        {{-- @endif --}}
                                                    @endif
                                                @endif
                                            @endif
                                        @else
                                                @if(str_contains($uc->action,'u'))
                                                    <a href="#" class="uc_restore kh12-b" style="color:blue" data-id="{{ $uc->id }}" data-status="{{$uc->status}}" data-action="restore"  data-ref_number="{{ $uc->ref_number }}" data-location_id="{{ $uc->location_id }}">Restore  |</i></a>
                                                @endif
                                                @if(str_contains($uc->action,'d'))
                                                    <a href="#" class="uc_delete kh12-b" style="color:red;" data-id="{{ $uc->id }}" data-status="{{$uc->status}}" data-action="delete" data-ref_number="{{ $uc->ref_number }}" data-location_id="{{ $uc->location_id }}">Delete</i></a>
                                                @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="summary">
    <div class="card" id="">
        <div class="card-header" style="padding:0px;">
            <h3>Summary</h3>
        </div>
        <div class="card-body" style="padding:0px;">
            <div class="table-responsive" style="padding:0px;">
                <table class="table table-bordered" style="width:100%;">
                    <thead class="kh16-b" style="text-align:center;">
                        @foreach ($usercurrencies as $c)
                            <th>{{ $c->currency->shortcut }}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($usercurrencies as $c)
                                <td style="font-size:16px;font-weight:bold;border-style:solid;text-align:center;">
                                    {{ phpformatnumber(App\UserCapital::summarycapital($c->currency_id,$trandate,$userid,$raduser)) }}
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
