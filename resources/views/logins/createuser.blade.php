@extends('master')
@section('title') Users @endsection
@section('css')
    <link href="{{ config('helper.asset_path') }}/css/toastr.min.css" rel="stylesheet">
    <style>
         body.wait, body.wait *{
			cursor: wait !important;
		}
        .cred{
            color:red;
        }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
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
            td{
                color:black;
            }
        .tbl_user_right .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_user_right .clickedrow td input{
        background-color: #caaf8f;
    }
    .tbluserlist .clickedrow td{
        background-color: #caaf8f;
    }
    .tblrightselect .clickedrow3 td{
        background-color: #73eca2 !important;
    }
    .tbl_right_list .clickedrow td{
        background-color: #caaf8f;
    }
    #selcustomerconnect + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:80px;}
		/* Each result */
	#select2-selcustomerconnect-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:aquamarine;}
    #selpropertygroup + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:80px;}
		/* Each result */
	#select2-selpropertygroup-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:aquamarine;}
    .ui-autocomplete {
        position: fixed;
        z-index: 1511;
        font-size:22px;
    }
    .ui-autocomplete-input{
      border: none;
      margin-bottom: 5px;
      border:1px solid #c8c6c6 !important;
      z-index:1511;
    }
    .tblrightselect td{
        padding:2px;
    }
    .tbl_right_list td{
        padding:3px 5px;
    }
    .tbl_right_list th{
        padding:3px;
    }
    .tbl_user_right td{
        padding:3px;
    }
    .tbl_user_right th{
        padding:3px;
    }
    .td_customerconnect {
            white-space: normal;
            word-wrap: break-word;
            max-width: 250px;
            }
        .d-none { display: none; }

        .td_propertygroup_connect{
            white-space: normal;
            word-wrap: break-word;
            max-width: 250px;
        }
        .d-none1 { display: none; }
    </style>
@endsection
@section('content')
<div class="row">
    <table>
        <tr>
            <td>
                 <ul class="nav nav-pills">
                    <li style="padding-bottom:10px;"><a href="#" class="kh22"  id="btnadduser" style="font-family:arial;"><i class="fa fa-user-plus"></i> Add User</a></li>
                </ul>
            </td>
            @if(Auth::user()->role->name=='Admin')
                <td>
                    <ul class="nav nav-pills">
                        <li style="padding-bottom:10px;"><a href="#" class="kh22"  id="btnsetremotepassword" style="font-family:arial;">Set Remote Password</a></li>
                    </ul>
                </td>
            @endif
            <td>
                 <div class="form-check">
                    <input class="form-check-input kh22" type="radio" name="radact" id="rad_active" value="1" checked>
                    <label class="form-check-label kh22" for="rad_active">Active Users</label>
                </div>
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input kh22" type="radio" name="radact" id="rad_disactive" value="0">
                    <label class="form-check-label kh22" for="rad_disactive" style="color:red">Disactive Users</label>
                </div>
            </td>
            <td>
                <select name="selcompany" id="selcompany" class="form-select kh16-b">
                    <option value="">All Company</option>
                    @foreach ($companies as $comp)
                        <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}}>{{ $comp->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    </table>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-hover kh16 tbluserlist" style="">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Name</th>
                <th>Login Name</th>
                <th>Company</th>
                <th>Role</th>
                <th>Active</th>
                <th>Block</th>
                <th>Customer Connect</th>
                <th>Group Connect</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbl_user">
            @foreach ($users as $key => $user)
                <tr  class={{ $user->active == 0 ? 'cred' : '' }}>
                    <td>{{ ++$key }}</td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td style="color:black;">
                        {{ $user->username }}
                    </td>
                    <td style="color:black;">{{$user->company->name}}</td>
                    <td>{{ $user->role->name??'' }}</td>
                    <td style="text-align:center;">
                        <div class="form-check-danger form-check form-switch" style="text-align:center;">
                            <input class="form-check-input s_active" type="checkbox" data-id="{{ $user->id }}" value="{{ $user->active }}" {{ $user->active==1?'checked':'' }}>
                        </div>
                    </td>
                    <td style="text-align:center;">
                        <div class="form-check-danger form-check form-switch" style="text-align:center;">
                            <input class="form-check-input s_block" type="checkbox" data-id="{{ $user->id }}" value="{{ $user->attempt }}" {{ $user->attempt>5?'checked':'' }}>
                        </div>
                    </td>


                    @php
                        $customerconnectData = App\User::separate_customerconnect($user->customer_connect, 2, true);
                    @endphp

                    <td class="td_customerconnect">
                        <span class="short-text">{!! $customerconnectData['html'] !!}</span>
                        <span class="full-text d-none">{!! App\User::separate_customerconnect($user->customer_connect) !!}</span>

                        @if($customerconnectData['has_more'])
                            <a href="javascript:void(0)" class="toggle-text kh14" style="color:blue;">more</a>
                        @endif
                    </td>


                    @php
                        $groupData = App\User::separate_property_group_connect($user->property_group_connect, 2, true);
                    @endphp

                    <td class="td_propertygroupconnect">
                        <span class="short-text">{!! $groupData['html'] !!}</span>
                        <span class="full-text d-none">
                            {!! App\User::separate_property_group_connect($user->property_group_connect) !!}
                        </span>

                        @if($groupData['has_more'])
                            <a href="javascript:void(0)" class="toggle-text kh14" style="color:blue;">more</a>
                        @endif
                    </td>


                    <td>
                        <a href="" class="btn btn-info btn-sm changepwd" data-id="{{ $user->id }}" style="font-weight:bold;">Change PWD</a>
                        <a href="" class="btn btn-warning btn-sm user-edit" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-company="{{ $user->company_id }}" data-username="{{ $user->username }}" data-email="{{ $user->email }}" data-role="{{ $user->role_id }}" data-active="{{ $user->active }}" data-customerconnect="{{ $user->customer_connect }}" data-groupconnect="{{ $user->property_group_connect }}" style="font-weight:bold;color:blue;">Edit</a>
                        <a href="" class="btn btn-danger btn-sm user-delete" data-id="{{ $user->id }}" style="font-weight:bold;">Remove</a>
                        <a href="" class="btn btn-info btn-sm add_user_right" data-id="{{ $user->id }}" data-username="{{ $user->username }}" style="font-weight:bold;">User Right</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

</div>
    @include('logins.createuser_modal')
    @include('logins.edituser_modal')
    @include('logins.applyright_modal')
    @include('logins.user_right_modal')
    @include('logins.changepwd')
@endsection

@section('script')

    <script src="{{ config('helper.asset_path') }}/js/toastr.min.js"></script>
    <script>
        $('#h1_title').text('ចុះឈ្មោះអ្នកប្រើប្រាស់');
        $(document).ready(function(){
            $('.selcustomerconnect').select2({
                dropdownParent: $('#create_user_modal')
            });
            $('.selpropertygroup').select2({
                dropdownParent: $('#create_user_modal')
            });
            $(document).on('click','#btnadduser',function(e){
                e.preventDefault();
                $('#create_user_modal').modal('show');
                $('#h4modal').text('Add New User');
                $('#selcustomerconnect').val('');
                $('#selcustomerconnect').trigger('change');
                $('#selpropertygroup').val('');
                $('#selpropertygroup').trigger('change');
                $('#frm_add_user').trigger('reset');
            })
             $(document).on('change','#company',function(e){
                e.preventDefault();
                getcustomerbycompany($(this).val(),'#selcustomerconnect');
             })
             function getcustomerbycompany(company,el)
            {
                var arr;
                var url="{{ route('getcustomercompany') }}";
                $(el).empty();
                var arr=[];
                $.post(url,{company:company},function(data){
                    // $(el).append($("<option/>",{
                    //             value:'',
                    //             text:''
                    //         }))
                    $.each(data,function(i,item){
                        $(el).append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))

                        arr.push({value:item.id,label:item.name,});
                    });


                })
            }
             $(document).on('click', '.toggle-text', function() {
                const $td = $(this).closest('td');
                const $short = $td.find('.short-text');
                const $full = $td.find('.full-text');

                if ($full.hasClass('d-none')) {
                    // show full
                    $short.addClass('d-none');
                    $full.removeClass('d-none');
                    $(this).text('less');
                } else {
                    // show short
                    $short.removeClass('d-none');
                    $full.addClass('d-none');
                    $(this).text('more');
                }
            });
             $(document).on('click', '.toggle-text1', function() {
                const $td = $(this).closest('td');
                const $short = $td.find('.short-text1');
                const $full = $td.find('.full-text1');

                if ($full.hasClass('d-none1')) {
                    // show full
                    $short.addClass('d-none1');
                    $full.removeClass('d-none1');
                    $(this).text('less');
                } else {
                    // show short
                    $short.removeClass('d-none1');
                    $full.addClass('d-none1');
                    $(this).text('more');
                }
            });
            $(document).on('click','#btnsubmit',function(e){
                $('body').addClass("wait");
                //var data=$('#frm_add_user').serialize();
                var formdata=new FormData(frm_add_user);
                if($('#userid').val()==''){
                    var url="{{ route('saveuser') }}";
                }else{
                    var url="{{ route('updateuser') }}";
                }
                $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                complete: function () {

                },
              success: function (data) {
                  console.log(data)
                  //debugger;
                  if($.isEmptyObject(data.error)){
                    if($('#userid').val()==''){
                        $('#frm_add_user').trigger('reset');
                        $('#selcustomerconnect').val('');
                        $('#selcustomerconnect').trigger('change');
                        $('#selpropertygroup').val('');
                        $('#selpropertygroup').trigger('change');
                        toastr.success('Crate User Completed');
                    }else{
                        toastr.success('Update User Completed');
                        $('#closemodalsave').click();
                    }
                    refresh();
                    $('body').removeClass("wait");
                  }else{
                      $('body').removeClass("wait");
                      alert(data.error)
                  }
              },
              error: function () {
                  $('body').removeClass("wait");
                  alert('Save Error.')
              }

            })


            })
            $(document).on('change','.s_active',function(e){
                var active=$(this).val();
                var id=$(this).data('id');

                var url="{{ route('switchstatus') }}";
                $.post(url,{id:id,active:active},function(data){
                    refresh();
                })
            })
             $(document).on('change','.s_block',function(e){
                var block=$(this).val();
                var id=$(this).data('id');

                var url="{{ route('switchblock') }}";
                $.post(url,{id:id,block:block},function(data){
                    refresh();
                })
            })
            $(document).on('click','#btnupdate',function(e){
                var data=$('#frm_edit_user').serialize();
                var url="{{ route('updateuser') }}";
                $.post(url,data,function(data){
                        //alert(data.sms)
                        $('#closemodal').click();
                        refresh();
                })
            })
            $(document).on('click','.changepwd',function(e){
                e.preventDefault();
                $('#user_id').val($(this).data('id'));
                $('#newpassword').val('');
                $('#newpassword-confirm').val('');
                $('#is_remotepwd').val(0);
                $('#btnresetpwd').text('Save New Password');
                $('#changepwd_modal').modal('show');
            })
             $(document).on('click','#btnsetremotepassword',function(e){
                e.preventDefault();
                const userid = "{{ Auth::id() }}";
                $('#user_id').val(userid);
                $('#newpassword').val('');
                $('#newpassword-confirm').val('');
                $('#is_remotepwd').val(1);
                $('#btnresetpwd').text('Save New Remote Password');
                $('#changepwd_modal').modal('show');
            })
            $(document).on('click','#btnresetpwd',function(e){
                var url="{{ route('resetpwd') }}";
                var data=$('#frmchangepwd').serialize();
                $.post(url,data,function(data){
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        //alert(data.sms)
                        $('#btncancelresetpwd').click();
                    }else{
                        alert(data.error)
                    }

                })
            })

            $(document).on('click','.user-delete',function(e){
                e.preventDefault();
                var c=confirm('do you want to remove this user?');
                if(c==true){
                    var userid=$(this).data('id');
                    var url="{{ route('deleteuser') }}";
                    $.post(url,{userid:userid},function(data){
                        refresh();
                    })
                }

            })
            $(document).on('click','.user-edit',function(e){
                 e.preventDefault();
                $('#create_user_modal').modal('show');
                var customerconnect=$(this).data('customerconnect').toString();
                //debugger;
                if(customerconnect.indexOf(',')>=0){
                  var customerconnect=$(this).data('customerconnect').split(',');
                }
                var groupconnect=$(this).data('groupconnect').toString();
                if(groupconnect.indexOf(',')>=0){
                  var groupconnect=$(this).data('groupconnect').split(',');
                }
                $('#userid').val($(this).data('id'))
                $('#name').val($(this).data('name'));
                $('#username').val($(this).data('username'));
                $('#email').val($(this).data('email'));
                $('#role').val($(this).data('role'));
                $('#company').val($(this).data('company'));
                $('#active').val($(this).data('active'));
                $('#selcustomerconnect').val(customerconnect);
                $('#selcustomerconnect').trigger('change');
                $('#selpropertygroup').val(groupconnect);
                $('#selpropertygroup').trigger('change');
            })
            $(document).on('change','#rad_active,#rad_disactive,#selcompany',function(e){
                e.preventDefault();
                refresh();
            })
            function refresh() {
                var url="{{ route('refreshuser') }}";
                var radsel=$('input[name="radact"]:checked').val();
                var company=$('#selcompany').val();
                $.post(url,{radact:radsel,selcompany:company},function(data){
                    $('#tbl_user').empty().html(data);
                })
            }

            $(document).on('click','.add_user_right',function(e){
                e.preventDefault();
                $('#user_right_modal').modal('show');

                var id=$(this).data('id');
                var usname=$(this).data('username');
                $('#us_id').val(id);
                $('#p_username').text(usname);
                getuser_right(id);
            })
            function getuser_right(id) {

                var url="{{ route('getuser_right') }}";
                $.post(url,{id:id},function(data){
                    //console.log(data)
                    //alert(data[0]['pivot'].pcdt)
                    $('#userpermission').empty().html(data);
                })
            }
            $(document).on('click','.btnaddright',function(e){
                e.preventDefault();
                var per_id=$(this).data('perid');
                var row=$(this).closest('tr');
                var pcdt = row.find("td:eq(2) input[type='number']").val();

                var uid=$('#us_id').val();
                var url="{{ route('saveuserpermission') }}";
                $.post(url,{uid:uid,per_id:per_id,pcdt:pcdt},function(data){
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        getuser_right(uid);
                        toastr.success('Update User Permission Successfully');
                      }else{
                        alert(data.error)
                      }

                })
            })
            $(document).on('click','.tbl_user_right td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.tbluserlist td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.tblrightselect td',function(e){
                $(this).closest('table').find('tr.clickedrow3').removeClass('clickedrow3');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow3");
            })
            $(document).on('click','.tbl_right_list td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.btn_update_p',function(e){
                e.preventDefault();

                var perid=$(this).data('perid');
                var row=$(this).closest('tr');
                var pcdt = row.find("td:eq(3) input[type='number']").val();
                //var no=row.find("td:eq(0)").text();
                var uid=$('#us_id').val();

                var url="{{ route('updateuserpermission') }}";
                $.post(url,{uid:uid,per_id:perid,pcdt:pcdt},function(data){
                    //console.log(data)
                    getuser_right(uid);
                    toastr.success('Update User Permission Successfully');
                })
            })
             $(document).on('click','.btn_delete_p',function(e){
                e.preventDefault();
                var conf=confirm("Do you want to remove this right?");
                if(conf==true){
                    var perid=$(this).data('perid');
                    var uid=$('#us_id').val();

                    var url="{{ route('deleteuserpermission') }}";
                    $.post(url,{uid:uid,per_id:perid,removeall:0},function(data){
                        //console.log(data)
                        getuser_right(uid);
                    })
                }

            })
            $(document).on('click','#btndeleteallright',function(e){
                e.preventDefault();
                var conf=confirm("Do you want to remove all right?");
                if(conf==true){
                    var perid=$(this).data('perid');
                    var uid=$('#us_id').val();

                    var url="{{ route('deleteuserpermission') }}";
                    $.post(url,{uid:uid,per_id:perid,removeall:1},function(data){
                        //console.log(data)
                        getuser_right(uid);
                    })
                }

            })
            $(document).on('click','#btnapplyright',function(e){
                e.preventDefault();
                $('#applyright_modal').modal('show');
                var url="{{ route('applyright') }}";
                var uid=$('#us_id').val();
                $.post(url,{uid:uid},function(data){
                    $('#userlist').empty().html(data);
                })
            })
            $(document).on('click','#btnapply',function(e){
                e.preventDefault();
                $("#tbl_userlist input[type=checkbox]:checked").each(function (){
                    var row = $(this).closest("tr");
                    var id=row.find("td:eq(1)").text();
                    var ap_id=$('#us_id').val();
                    var url="{{ route('saveapplyright') }}";
                    $.post(url,{ap_id:ap_id,id:id},function(data){
                        toastr.success('Apply Permission Successfully');
                    })
                })
            })
            //-----------------------------
        })

    </script>
@endsection
