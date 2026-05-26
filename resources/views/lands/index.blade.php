@extends('master')
@section('title') Land REGISTER @endsection
@section('css')
    <link rel="stylesheet" tyle="text/css" href="{{ asset('public') }}/css/virtual-select.min.css">
    <style type="text/css">
         body.wait, body.wait *{
			cursor: wait !important;
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
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
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
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }
       .cgr{
        background-color:aquamarine;
       }
       .csold{
        background-color:yellow;
        color:blue;
       }
       .bkaqua{
        background-color:blue !important;
        color:white !important;
       }
       #myInput {
        /* background-image: url("{{ asset('public/logo') }}/search-icon.jpg"); */
        /* background-image: url('/logo/search-icon.jpg'); */
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 5px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
      }
      .tbl_customer td{
      word-wrap: break-word;
      /* padding:2px 5px 2px 5px; */
    }
      .tblproperty .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_group .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_group td{
        padding:3px;
    }
    .tbl_group th{
        padding:3px;
    }

    .tblproperty td{
        padding:3px;
    }
    .tblproperty th{
        padding:3px;
    }
    .tableFixHead{ overflow: auto;border:1px solid blue;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }

    .ui-autocomplete {
        position: fixed;
        z-index: 1511;
        font-size:16px;
        font-family:'Noto Sans Khmer', sans-serif;

    }
    .ui-autocomplete-input{
      border: none;
      margin-bottom: 5px;
      border:1px solid #c8c6c6 !important;
      z-index:1511;
    }
    #myTable td{
      padding:5px;
    }
    /* .photo > input[type='file']{
			display:none;
		}
		.photo{
			width:30px;
			height:30px;
			border-radius:100%;
		} */
    #tbl_form_group td{
        border-style:none;
        padding:3px;
    }
    .mybtn{
        border:1px solid black;
        padding:5px 10px;
    }
    .mybtn:hover{
        background-color:aquamarine;
    }
    .mybtn_edit{
        border:1px solid black;
        padding:0px 4px;
        background-color:yellow;
    }
    .mybtn_edit:hover{
        background-color:aquamarine;
    }
    .mybtn_delete{
        border:1px solid black;
        background-color:pink;
        padding:0px 4px;
    }
    .mybtn_delete:hover{
        background-color:aquamarine;
    }
    #tblfrmland td{
        padding:5px;
        border-style:none;
    }
    .cred{
        background-color:rgb(233, 200, 205);
    }
    </style>
@endsection
@section('content')
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

        <table>
            <tr>
                <td>
                    <button id="btnaddproperty" class="btn btn-info btn-sm kh16-b">ចុះឈ្មោះអចលនទ្រព្យ</button>
                    <button id="btnaddgroup" class="btn btn-info btn-sm kh16-b">ចុះឈ្មោះប្លុក</button>

                    <button id="btnprint" class="btn btn-info btn-sm kh16-b">ព្រីន</button>


                </td>
                <td class="kh16-b" style="text-align:right;">
                    ប្លុក
                </td>
                <td>
                  <select multiple class="select" id="sel_customertype" name="sel_customertype">
                    <option value="">All</option>
                    @foreach ($groups as $g)
                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                    @endforeach

                  </select>
                </td>

                <td>
                    <input type="button" id="btnsearch" class="btn btn-info" value="Search" title="1">
                </td>
            </tr>
        </table>
   </div>
   <div class="row" style="margin-top:5px;">
        <div class="col-lg-6" style="padding:0px;">
            <button id="btndata" class="mybtn btnx kh16-b" data-x='1'><i class="fa fa-list"></i> អចលនទ្រព្យ</button>
            <button id="btnrecycle" class="mybtn btnx kh16-b" data-x='0' style=""><i class="fa fa-trash" style=""></i> ធុងសំរាម</button>
            <select class="kh16-b" style="height:35px;" name="selclose" id="selclose">
                <option value="2">បើកលក់+មិនទាន់បើកលក់</option>
                <option value="0">បើកលក់</option>
                <option value="1">មិនទាន់បើកលក់</option>
            </select>
        </div>
        <div class="col-lg-6">
            <input type="text" class="kh16" id="myInput" onkeyup="searchmyTable()" placeholder="Search for names.." title="Type in a name">
        </div>

   </div>
   <div class="row">
        <div class="tableFixHead" style="padding:0px;">
            <table id="tblproperty" class="table table-bordered table-hover tbl_customer kh12-b tblproperty" style="table-layout:fixed;">
                <thead style="text-align:center;background-color:aqua;" class="kh14-b">
                    <th style="width:60px;">N <sup>o</sup></th>
                    <th style="width:80px;">សក</th>
                    <th style="width:220px;">អចលនទ្រព្យ</th>
                    <th style="width:100px;">ទំហំ</th>
                    <th style="width:120px;">តំលៃលក់</th>
                    <th style="width:120px;">កម្រៃបង់ផ្តាច់</th>
                    <th style="width:120px;">កម្រៃបង់រំលស់</th>
                    <th style="width:120px;">ប្លុក</th>
                    <th style="width:100px;">ប្រភេទ</th>
                    <th style="width:500px;">ទីតាំង</th>
                    <th style="width:160px;">អ្នកកត់ត្រា</th>
                    <th style="width:120px;">ថ្ងៃកត់ត្រា</th>
                    <th style="width:320px;">ផ្សេងៗ</th>


                </thead>
                <tbody id="body_land">
                    @foreach ($myproperty as $key => $c)
                    <tr class="{{ $c['saleid']==null?'':'csold' }}">
                        <td style="text-align:center;width:50px;@if($c['pisclose']==1) background-color:black; @endif">{{ ++$key }}</td>
                        <td style="width:100px;text-align:center;">
                            @if($c['pstatus']==1)
                                <a href="#" style="padding:0px;" class="btn btn-sm btn_edit" data-id="{{ $c['pid'] }}" data-status="{{ $c['pstatus'] }}" data-isclose="{{ $c['pisclose'] }}" data-name="{{ $c['pname'] }}"  data-size="{{ $c['size'] }}" data-size1="{{ $c['size1'] }}" data-price="{{ $c['price'] }}" data-north="{{ $c['north'] }}" data-south="{{ $c['south'] }}" data-east="{{ $c['east'] }}" data-west="{{ $c['west'] }}" data-com_payoff="{{ $c['com_payoff'] }}" data-com_payloan="{{ $c['com_payloan'] }}" data-currency_id="{{ $c['currency_id'] }}" data-groupid="{{ $c['property_group_id'] }}"  data-desr="{{ $c['desr'] }}" ><i class="fa fa-pencil" style="color:green"></i></a>
                                <a href="#" style="padding:0px;" class="btn btn-sm btn_remove" data-id="{{ $c['pid'] }}" data-status="{{ $c['pstatus'] }}" data-restore="0"><i class="fa fa-trash" style="color:red;"></i></a>
                            @else
                                <a href="#" style="padding:0px;" class="btn btn-sm btn_restore" data-id="{{ $c['pid'] }}" data-restore="1" data-status="{{ $c['pstatus'] }}" data-isclose="{{ $c['pisclose'] }}" data-name="{{ $c['pname'] }}"  data-size="{{ $c['size'] }}" data-size1="{{ $c['size1'] }}" data-price="{{ $c['price'] }}" data-north="{{ $c['north'] }}" data-south="{{ $c['south'] }}" data-east="{{ $c['east'] }}" data-west="{{ $c['west'] }}" data-com_payoff="{{ $c['com_payoff'] }}" data-com_payloan="{{ $c['com_payloan'] }}" data-currency_id="{{ $c['currency_id'] }}" data-groupid="{{ $c['property_group_id'] }}"  data-desr="{{ $c['desr'] }}" ><i class="fa fa-repeat" style="color:green"></i></a>
                                <a href="#" style="padding:0px;" class="btn btn-sm btn_remove" data-id="{{ $c['pid'] }}" data-status="{{ $c['pstatus'] }}" data-restore="0"><i class="fa fa-trash" style="color:red;"></i></a>
                            @endif
                        </td>
                        <td style="width:220px;" title="{{ $c['pid'] }}">
                            {{ $c['pname'] }} {{ $c['saleid']==null?'': '('.$c['buyer'].')' }}
                        </td>
                        <td>{!! $c['size1'] !!}</td>
                        <td style="text-align:right;">{{ phpformatnumber($c['price']) . ' ' . $c['currency_shortcut']}}</td>
                        <td style="text-align:right;">{{ phpformatnumber($c['com_payoff']) . ' ' . $c['currency_shortcut']}}</td>
                        <td style="text-align:right;">{{ phpformatnumber($c['com_payloan']) . ' ' . $c['currency_shortcut']}}</td>

                        <td>{{ $c['gname'] }}</td>
                        <td>{{ $c['gtype'] }}</td>
                        <td>{{ $c['gaddress'] }}</td>
                        <td>{{ $c['username'] }}</td>
                        <td style="width:120px;">{{ date('d-m-Y',strtotime($c['created_at'])) }}</td>
                        <td>{{ $c['desr'] }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
   </div>

    @include('lands.addlandmodal')
    @include('lands.addgroupmodal')


@endsection
@section('script')
<script src="{{ asset('public/js') }}/virtual-select.min.js"></script>

    <script type="text/javascript">
         $('#h1_title').text('ចុះឈ្មោះអចលនទ្រព្យ');
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-230;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
            $(window).resize(function() {
                var windowWidth = $(window).width();
                var windowHeight = $(window).height();

                var divheight=windowHeight-230;

                var tableFixHead=document.getElementsByClassName('tableFixHead');
                for(i=0; i<tableFixHead.length; i++) {
                    tableFixHead[i].style.height=divheight+'px';
                }
            });
        $(document).ready(function () {
            landnameautocomplete();
            var cleave = new Cleave('#price', {
                numeral: true,
                numeralPositiveOnly: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#com_payoff', {
                numeral: true,
                numeralPositiveOnly: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#com_payloan', {
                numeral: true,
                numeralPositiveOnly: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            VirtualSelect.init({
                ele: '#sel_customertype' ,
            });
            $('#btndata').addClass('bkaqua');
            $(document).on('click','.btnx',function(e){
                e.preventDefault();
                $('#btnsearch').attr('title',$(this).data('x'));
                getproperty($(this).data('x'));
                $('.btnx').removeClass('bkaqua');
                $(this).addClass('bkaqua');
            })

            $(document).on('click','.tbl_group td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.tblproperty td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('blur','#size',function(e){
               e.preventDefault();
              // debugger
               let s=$('#size').val();

               const reg1 = /m2/gi;
               const reg2 = /ម2/gi;
               const reg3 = /ម២/gi;

                let newsize=s.replace(reg1,'m<sup>2</sup>');
                newsize=newsize.replace(reg2,'ម<sup>2</sup>');
                newsize=newsize.replace(reg3,'ម<sup>២</sup>');

                document.getElementById("size1").innerHTML = newsize //+'<sup>2</sup>';

            })
            $(document).on('click','#btnsavegroup',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var url="{{ route('savelandgroup') }}";
                var btntext=$(this).text();
                var formdata=new FormData(frmpropertygroup);
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       console.log(data)
                       if($.isEmptyObject(data.error)){

                            getpropertygroup(1);
                            if(btntext=='Save'){
                                toastr.success('Save Group Successfully');
                            }else{
                                toastr.success('Update Group Successfully');
                            }
                            $('body').removeClass("wait");
                       }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                       }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Save Error')

                    }

                })

            })
            $(document).on('click','#selgroupstatus',function(e){
                e.preventDefault();
                getpropertygroup($(this).val());
            })
            function getpropertygroup(status)
            {
                    $('body').addClass("wait");
                    var url="{{ route('getpropertygroup') }}";
                    $.ajax({
                        async:true,
                        type: 'GET',
                        url: url,
                        data: {status:status},

                        complete: function () {},
                        success: function (data) {
                            //console.log(data)
                            var output='';
                            $('#body_group').empty();
                            for (let i = 0; i < data['groups'].length; i++) {
                                const group = data['groups'][i];
                                output += `
                                    <tr style="${group.status == 0 ? 'background-color:pink;' : ''}">
                                        <td class="kh14" style="text-align:center;">${i + 1}</td>
                                        <td class="kh14">${moment(group.created_at).format('DD-MM-YYYY')}</td>
                                        <td class="kh14">${group.name}</td>
                                        <td class="kh14">${group.type}</td>
                                        <td class="kh14">${group.address ?? ''}</td>
                                        <td class="kh14">${group.addrhead ?? ''}</td>
                                        <td class="kh14">${group.isclose==0?'បើកលក់':'មិនទាន់បើកលក់'}</td>
                                        <td class="kh14" style="text-align:center;">
                                            ${group.status == 1 ? `
                                                <a href="#" class="mybtn_edit btnedit_group"
                                                data-id="${group.id}"
                                                data-name="${group.name}"
                                                data-type="${group.type}"
                                                data-address="${group.address}"
                                                data-addrhead="${group.addrhead}"
                                                data-status="${group.status}"
                                                data-isclose="${group.isclose}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="#" class="mybtn_delete btndel_group"
                                                data-id="${group.id}"
                                                data-status="${group.status}">
                                                    <i class="fa fa-trash" style="color:red;"></i>
                                                </a>
                                            ` : `
                                                <a href="#" class="mybtn_delete btndel_group"
                                                data-id="${group.id}"
                                                data-status="${group.status}">
                                                    <i class="fa fa-repeat" style=""></i>
                                                </a>
                                            `}
                                        </td>
                                    </tr>
                                `;
                            }

                            $('#body_group').append(output);
                            $('body').removeClass("wait");
                        },
                        error: function () {
                            $('body').removeClass("wait");
                            alert('Read Data Error.')
                        }
                    })
            }
            $(document).on('click','#btnaddgroup',function(e){
                e.preventDefault();
                $('#addgroupmodal').modal('show');
                $('#frmpropertygroup').trigger('reset');
            })
            $(document).on('click','#btnrefreshgroup',function(e){
                e.preventDefault();
                getpropertygroup();
            })
            $(document).on('click','.btnedit_group',function(e){

                e.preventDefault();
                var name=$(this).data('name');
                var type=$(this).data('type');
                var addr=$(this).data('address');
                var addrhead=$(this).data('addrhead');
                var id=$(this).data('id');
                var status=$(this).data('status');
                var isclose=$(this).data('isclose');

                $('#groupid').val(id);
                $('#groupname').val(name);
                $('#grouptype').val(type);
                $('#groupaddress').val(addr);
                $('#addrhead').val(addrhead);
                $('#group_status').val(status);
                $('#group_close').val(isclose);
                $('#btnsavegroup').text('Update');
            })
            $(document).on('click','#btnnewgroup',function(e){
                e.preventDefault();
                $('#frmpropertygroup').trigger('reset');
                $('#btnsavegroup').text('Save');
            })
            $(document).on('click','.btndel_group',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var status=$(this).data('status');
                var text='';
                var confirmtext='';
                var suctext='';
                if(status==1){
                    text='to remove this bloc!';
                    confirmtext='Yes, delete it!';
                    suctext='Deleted';
                }else{
                     text='to retore this bloc!';
                    confirmtext='Yes, restore it!';
                     suctext='Restored';
                }
                var url="{{ route('propertygroup.delete') }}";
                Swal.fire({
                        title: 'Are you sure?',
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: confirmtext
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                async: true,
                                type: 'GET',
                                dataType:'JSON',
                                contentType: 'application/json;charset=utf-8',
                                url: url,
                                data: { id:id,status:status},
                                success: function (data) {
                                    getpropertygroup(status);
                                    if (data.success === true) {
                                        Swal.fire(
                                            suctext,
                                            data.message,
                                            'success'
                                        )
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            data.message,
                                            'error'
                                        )
                                    }
                                },
                                error: function () {
                                    Swal.fire(
                                        'Error!',
                                        'Delete Error.',
                                        'Error'
                                    )
                                }

                            })

                        }
                    })

            })
            //property section
            $(document).on('click','.btn_remove,.btn_restore',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var status=$(this).data('status');
                var restore=$(this).data('restore');
                if(restore==1){
                    var text="to restore this property!";
                    var confirmButtonText="Yes, restore it!";
                    var succtext="restore!";
                }else{
                    if(status==0){
                        var text="to remove this property from bin! you will no longer to get it back";
                         var confirmButtonText="Yes, delete it!";
                         var succtext="Deleted!";
                    }else{
                        var text="to remove this property!";
                        var confirmButtonText="Yes, delete it!";
                        var succtext="Deleted!";
                    }
                }
                var url="{{ route('property.delete') }}";
                Swal.fire({
                        title: 'Are you sure?',
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: confirmButtonText
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                async: true,
                                type: 'GET',
                                dataType:'JSON',
                                contentType: 'application/json;charset=utf-8',
                                url: url,
                                data: { id:id,status:status,restore:restore},
                                success: function (data) {
                                    getproperty($('#btnsearch').attr('title'));
                                    if (data.success === true) {

                                        Swal.fire(
                                            succtext,
                                            data.message,
                                            'success'
                                        )
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            data.message,
                                            'error'
                                        )
                                    }
                                },
                                error: function () {
                                    Swal.fire(
                                        'Error!',
                                        'Delete Error.',
                                        'Error'
                                    )
                                }

                            })

                        }
                    })

            })
            $(document).on('click','#btnaddproperty',function(e){
                e.preventDefault();
                $('#addlandmodal').modal('show');
                $('#frmproperty').trigger('reset');
            })
            $(document).on('click','#btnsearch',function(e){
                e.preventDefault();
                getproperty($(this).attr('title'));
            })
            $(document).on('change','#selclose',function(e){
                e.preventDefault();
                getproperty($('#btnsearch').attr('title'));
            })
            $(document).on('click','#btnsaveland',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var url="{{ route('property.saveland') }}";
                var btntext=$(this).text();
                var formdata=new FormData(frmproperty);
                var size1=$('#size1').html();
                formdata.append('size1',size1);
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       console.log(data)
                       if($.isEmptyObject(data.error)){
                            getproperty($('#btnsearch').attr('title'));

                            if(btntext=='Save'){
                                landnameautocomplete();
                                $('#landname').focus();
                                toastr.success('Save Land Successfully');
                            }else{
                                $('#addlandmodal').modal('hide');
                                toastr.success('Update Land Successfully');
                            }
                            $('body').removeClass("wait");
                       }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                       }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Save Error')

                    }

                })

            })
            $(document).on('click','.btn_edit',function(e){
                e.preventDefault();

                var name=$(this).data('name');
                var size=$(this).data('size');
                var size1=$(this).data('size1');
                var status=$(this).data('status');
                var price=$(this).data('price');
                var com_payoff=$(this).data('com_payoff');
                var com_payloan=$(this).data('com_payloan');
                var curid=$(this).data('currency_id');
                var groupid=$(this).data('groupid');
                var desr=$(this).data('desr');
                var id=$(this).data('id');
                var north=$(this).data('north');
                var south=$(this).data('south');
                var east=$(this).data('east');
                var west=$(this).data('west');
                var isclose=$(this).data('isclose');

                $('#landid').val(id);
                $('#selbloc').val(groupid);
                $('#landname').val(name);
                $('#size').val(size);
                $('#size1').html(size1);
                $('#price').val(formatNumber(price));
                $('#selcur').val(curid);
                $('#selcur').trigger('change');
                $('#com_payoff').val(formatNumber(com_payoff));
                $('#com_payloan').val(formatNumber(com_payloan));
                $('#desr').val(desr);
                $('#north').val(north);
                $('#south').val(south);
                $('#east').val(east);
                $('#west').val(west);
                $('#selstatus').val(status);
                $('#isclose').val(isclose);
                //$('#selstatus').trigger('change');
                $('#btnsaveland').text('Update');
                $('#addlandmodal').modal('show');
            })
            $(document).on('change','#selcur',function(e){
                e.preventDefault();
                var cur=$('#selcur option:selected').text();
                $('.cur').val(cur);
            })
            $(document).on('keydown', '.canenter', function (e) {
                if (e.keyCode == 13) {
                    var id = $(this).attr("id");
                    if (id == 'landname') {
                        $('#size').focus();
                    } else if(id == 'size'){
                        $('#price').focus();
                    } else if (id == 'price'){
                        $('#com_payoff').focus();
                    }else if (id == 'com_payoff'){
                        $('#com_payloan').focus();
                    }else if (id == 'com_payloan'){
                        $('#btnsaveland').focus();
                    }
                    e.preventDefault();
                }
            })

            function landnameautocomplete()
            {
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: "{{ route('propertyname.autocomplete') }}",
                    data: {},
                    complete: function () {

                    },
                    success: function (data) {
                    console.log(data);
                    $("#landname").autocomplete({
                        source: function (request, response) { // use a function so you can trim the request and ignore ""
                            var term = $.trim(request.term).replace(/\s+/g, '')
                            var reg = new RegExp($.ui.autocomplete.escapeRegex(term), "i")
                            if (term !== "") response($.grep(data, function (tag) {
                                //return tag.value.match(reg)
                                return tag.value.match(reg)

                            }))
                        },

                        select: function (e, ui) {
                            //location.href = ui.item.the_link;
                            //console.log(ui.item.recname);
                            $('#landname').val(ui.item.value);
                        }

                    });
                    },
                    error: function () {
                        alert('Read Phone Number Error.')
                    }
                })
            }
            function getproperty(status)
            {
                    $('body').addClass("wait");
                    var isclose=$('#selclose').val();
                    var selgroup=$('#sel_customertype').val();
                    if(selgroup.includes('all')==true || selgroup=='' || selgroup.length==0){
                        selgroup="all";
                    }
                    var url="{{ route('getpropertylist') }}";
                    $.ajax({
                        async:true,
                        type: 'GET',
                        url: url,
                        data: {selgroup:selgroup,status:status,isclose:isclose},

                        complete: function () {},
                        success: function (data) {
                            console.log(data)
                            var output='';
                            $('#body_land').empty();
                            for(let i=0;i<data['p'].length;i++){
                                output +=`
                                    <tr class="${data['p'][i].saleid==null?'':'csold'} ${data['p'][i].pstatus==1?'':'cred'}">

                                        <td style="text-align:center;width:50px;${data['p'][i].pisclose==1 ? 'background-color:black;' : ''}">${i+1}</td>



                                        <td style="width:100px;text-align:center;">
                                        ${data['p'][i].pstatus == 1
                                            ? `
                                                <a href="#" style="padding:0px;" class="btn btn-sm btn_edit"
                                                    data-id="${data['p'][i].pid}"
                                                    data-status="${data['p'][i].pstatus}"
                                                    data-isclose="${data['p'][i].pisclose}"
                                                    data-name="${data['p'][i].pname}"
                                                    data-size="${data['p'][i].size}"
                                                    data-size1="${data['p'][i].size1}"
                                                    data-price="${data['p'][i].price}"
                                                    data-north="${data['p'][i].north}"
                                                    data-south="${data['p'][i].south}"
                                                    data-east="${data['p'][i].east}"
                                                    data-west="${data['p'][i].west}"
                                                    data-com_payoff="${data['p'][i].com_payoff ?? '0'}"
                                                    data-com_payloan="${data['p'][i].com_payloan ?? '0'}"
                                                    data-currency_id="${data['p'][i].currency_id}"
                                                    data-groupid="${data['p'][i].property_group_id}"
                                                    data-desr="${data['p'][i].desr}">
                                                    <i class="fa fa-pencil" style="color:green"></i>
                                                </a>
                                                <a href="#" style="padding:0px;" class="btn btn-sm btn_remove"
                                                    data-id="${data['p'][i].pid}"
                                                    data-status="${data['p'][i].pstatus}"
                                                    data-restore="0">
                                                    <i class="fa fa-trash" style="color:red;"></i>
                                                </a>
                                            `
                                                : `
                                                    <a href="#" style="padding:0px;" class="btn btn-sm btn_restore"
                                                        data-id="${data['p'][i].pid}"
                                                        data-status="${data['p'][i].pstatus}"
                                                        data-isclose="${data['p'][i].pisclose}"
                                                        data-name="${data['p'][i].pname}"
                                                        data-size="${data['p'][i].size}"
                                                        data-size1="${data['p'][i].size1}"
                                                        data-price="${data['p'][i].price}"
                                                        data-north="${data['p'][i].north}"
                                                        data-south="${data['p'][i].south}"
                                                        data-east="${data['p'][i].east}"
                                                        data-west="${data['p'][i].west}"
                                                        data-com_payoff="${data['p'][i].com_payoff ?? '0'}"
                                                        data-com_payloan="${data['p'][i].com_payloan ?? '0'}"
                                                        data-currency_id="${data['p'][i].currency_id}"
                                                        data-groupid="${data['p'][i].property_group_id}"
                                                        data-desr="${data['p'][i].desr}"
                                                        data-restore="1">

                                                        <i class="fa fa-repeat" style="color:green"></i>
                                                    </a>
                                                    <a href="#" style="padding:0px;" class="btn btn-sm btn_remove"
                                                        data-id="${data['p'][i].pid}"
                                                        data-status="${data['p'][i].pstatus}"  data-restore="0">

                                                        <i class="fa fa-trash" style="color:red;"></i>
                                                    </a>
                                                `
                                            }
                                        </td>

                                        <td style="width:220px;" title="${data['p'][i].pid}">
                                            ${data['p'][i].pname} ${data['p'][i].saleid==null?'':'(' + data['p'][i].buyer + ')' }
                                        </td>
                                        <td>${data['p'][i].size1 }</td>
                                        <td style="text-align:right;">${formatNumber(data['p'][i].price) + ' ' + data['p'][i].currency_shortcut}</td>
                                        <td style="text-align:right;">${formatNumber(data['p'][i].com_payoff??0) + ' ' + data['p'][i].currency_shortcut}</td>
                                        <td style="text-align:right;">${formatNumber(data['p'][i].com_payloan??0) + ' ' + data['p'][i].currency_shortcut}</td>

                                        <td>${data['p'][i].gname}</td>
                                        <td>${data['p'][i].gtype}</td>
                                        <td>${data['p'][i].gaddress}</td>
                                        <td>${data['p'][i].username}</td>
                                        <td style="width:120px;">${moment(data['p'][i].created_at).format('DD-MM-YYYY') }</td>
                                        <td>${data['p'][i].desr??''}</td>

                                    </tr>
                                `;
                            }
                            $('#body_land').append(output);
                            $('body').removeClass("wait");
                        },
                        error: function () {
                            $('body').removeClass("wait");
                            alert('Read Data Error.')
                        }
                    })
            }

        })
        function searchmyTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tblproperty");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                } else {
                tr[i].style.display = "none";
                }
            }
            }
        }
    </script>
@endsection
