<style>
    .hiddenRow {
        padding: 0 !important;
    }
    .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
    .kh14-b{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:14px;
    font-weight:bold;
    }
    .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
    .kh16-b{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:16px;
    font-weight:bold;
    }
    .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
    .kh18-b{
    font-family:'Noto Sans Khmer', sans-serif;
    font-size:18px;
    font-weight:bold;
    }
    .kh22{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:22px;

        }
    .kh22-b{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:22px;
        font-weight:bold;
        }
    label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
</style>


<div class="modal fade" id="user_right_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:10000;">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title kh22-b" id="exampleModalLabel">សិទ្ធបុគ្គលិក</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <input type="hidden" name="us_id" id="us_id">
                        <div class="row">
                            <table>
                                <tr>
                                    <td class="kh22">
                                        សិទ្ធបានផ្តល់អោយបុគ្គលិក <span style="" id="p_username"></span>
                                    </td>
                                    <td>
                                        <button id="btnapplyright" class="btn btn-info btn-md pull-right">Apply to</button>
                                    </td>
                                    <td>
                                        <button id="btndeleteallright" class="btn btn-danger btn-md pull-right">Delete all right</button>
                                    </td>
                                </tr>
                            </table>

                        </div>

                        <table id="tbl_user_right" class="table table-bordered kh16-b tbl_user_right" style="margin-top:5px;">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">No</th>
                                    <th style="text-align:center;">Code</th>
                                    <th style="text-align:center;">Description</th>
                                    {{-- <th style="text-align:center;">Other</th>
                                    <th style="text-align:center;">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody id="userpermission">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="kh22-b">តារាងសិទ្ធ</p>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover tbl_right_list kh16">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">No</th>
                                    <th style="text-align:center;">Code</th>
                                    <th style="text-align:center;">Description</th>
                                    {{-- <th style="text-align:center;">Other</th>
                                    <th style="text-align:center;">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rights as $key => $r)
                                    <tr data-bs-toggle="collapse" data-bs-target="#c{{ $r->code }}"
                                        style="cursor:pointer;">
                                        <td style="width:80px;text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:16px;">{{ ++$key }}</td>
                                        <td style="width:80px;text-align:right;font-family:Arial, Helvetica, sans-serif;font-size:16px;font-weight:bold;">{{ $r->code }}</td>
                                        <td style="font-family: khmer os muol light;font-size:16px;" title="ID:{{ $r->id }}">
                                            {{ $r->name }}</td>
                                        {{-- <td>

                                        </td>
                                        <td style="padding:0px;width:80px;">


                                        </td> --}}
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="hiddenRow" style="">
                                            <div class="accordian-body collapse" id="c{{ $r->code }}">
                                                <table id="" class="table tblrightselect" style="background-color:rgb(188, 236, 237)">
                                                    @foreach (App\Permission::getpermission($r->code) as $key1 => $ps)
                                                        <tr>

                                                            <td style="text-align:right;">{{ $ps->code }}</td>
                                                            <td colspan="2" class="kh16">
                                                                {{ $ps->name }}</td>
                                                            <td style="width:200px;padding-top:0px;">
                                                                @if($ps->hasamt==1)
                                                                    <input type="number" class="form-control p_condition" style="width:200px;font-size:22px;" numeric>
                                                                @endif
                                                            </td>
                                                            <td style="padding:0px;">
                                                                <a href="#" class="btn btn-info btn-sm btnaddright"
                                                                    data-perid="{{ $ps->id }}">Add</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </table>
                                            </div>
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
</div>
<script>
    function isNumberKey(evt, v) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if ((charCode > 31 && (charCode < 45 || charCode > 57)) || charCode == 47) {

            return false;
        }
        if (charCode == 46) {
            if (v.toString().indexOf('.') > 0) {
                return false;
            }
        }
        if (charCode == 45) {
            if (v.toString().length > 0) {
                return false;
            }
            if (v.toString().indexOf('-') > 0) {
                return false;
            }
        }
        return true;
    }
</script>

