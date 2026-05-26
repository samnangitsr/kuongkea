@extends('master')
@section('title') របាយការណ៏កាត់កង @endsection
@section('css')
    <style type="text/css">
        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:30px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:white}

        #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:30px;background-color:white}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:white;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:30px;}
         .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
        .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
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
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
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
       /* td{
        border-style:none;
       } */
    #tbl_exchange_list .clickedrow td{
        background-color: #9eca8f;
    }
    #tbl2 .clickedrow td{
        background-color: #9eca8f;
    }
    #tblsearchmore td{
        border-style:none;
    }
    #tbl_exchange_list td{
        padding:3px;
        border:1px solid black;
    }
    #tbl_exchange_list th{
        padding:3px;
        border:1px solid black;
    }
    .btndelete{
        padding:0px 5px;
        border:1px solid red;
        color:red;
    }
    .btndelete:hover{
        color:blue;
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
    <div class="" style="margin-top:-20px;">
        <table class="kh14-b">
            <tr>
                <th style="border-style:none;">គិតចាប់ពី</th>
                <th style="border-style:none;">រហូតដល់</th>
                <th style="border-style:none;">អ្នកកាត់កង</th>
                <th style="border-style:none;">ប្រភេទអតិថិជន</th>
                <th style="border-style:none;"><span id="lblpartner">ជ្រើសរើសដៃគូ</span></th>
                <th style="border-style:none;">
                     <label style="color:red;">
                        <input type="checkbox" id="ckdel">
                        របាយការណ៏លុប
                    </label>
                </th>
            </tr>
            <tr>

                <td style="padding:0px;border-style:none;width:160px;">
                    <div class="input-group" style="width:160px;">
                        <input type="text" name="dt1" id="dt1" class="form-control" style="width:100px;height:30px;background-color:silver;">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>

                </td>
                <td style="padding-right:5px;border-style:none;width:160px;">
                    <div class="input-group" style="width:160px;">
                        <input type="text" name="dt2" id="dt2" class="form-control" style="width:100px;height:30px;background-color:silver;">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>

                </td>
                <td style="padding-right:5px;border-style:none;">
                    <select class="form-select kh14-b" name="seluser" id="seluser">
                        <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="padding-right:5px;border-style:none;">
                    <select name="seltype" id="seltype" class="kh14-b" style="height:30px;">
                        <option value="all">ទាំងអស់</option>
                        <option value="BANK">BANK</option>
                        @if(Auth::user()->role->name=='Admin')
                            <option value="CUSTOMER">CUSTOMER</option>
                        @endif
                        <option value="PARTNER">PARTNER</option>
                        <option value="AGENT">AGENT</option>
                    </select>
                </td>
                <td style="padding-right:5px;border-style:none;">
                    <select name="selcustomer" id="selcustomer" style="margin-top:-60px;" class="form-select kh14-b" required>
                        <option value=""></option>
                        <optgroup label="ដៃគូ">
                        @foreach ($partners->where('customertype','PARTNER') as $p)
                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                        @endforeach
                        </optgroup>
                        <optgroup label="ធនាគា">
                        @foreach ($partners->where('customertype','BANK') as $p)
                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                        @endforeach
                        </optgroup>
                        <optgroup label="ភ្នាក់ងារ">
                        @foreach ($partners->where('customertype','AGENT') as $p)
                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                        @endforeach
                        </optgroup>
                        @if (Auth::user()->role->name=='Admin')
                        <optgroup label="អតិថិជន">
                            @foreach ($customers as $p)
                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                            @endforeach
                        </optgroup>
                        @endif
                    </select>
                </td>
                <td style="padding:0px;border-style:none;">

                    <button class="btn btn-primary btn-sm kh14-b" id="btnsearch">បង្ហាញ</button>
                </td>
            </tr>
        </table>
    </div>

    <div id="exchangelist" class="row" style="margin-top:20px;">
        <div class="table-responsive">
            <table id="tbl_exchange_list" class="table table-bordered table-hover kh14-b">
                <thead style="text-align:center;">
                    <th>N <sup>o</sup></th>
                    <th>ឈ្មោះដៃគូ</th>
                    <th>ថ្ងៃកាត់កង</th>
                    <th>ម៉ោង</th>
                    <th>អ្នកកាត់កង</th>
                    <th>ទិញចូល</th>
                    <th>លក់ចេញ</th>
                    <th>អត្រាគោល</th>
                    <th>អត្រាព្រមព្រាង</th>
                    <th>សកម្មភាព</th>
                </thead>
                <tbody id="bodyexchangelist">
                    @foreach ($exchangelists as $key => $el)
                        <tr style="@if($el->status==0) background-color:red;color:white; @endif">
                            <td style="text-align:center;">{{ ++$key }}</td>
                            <td>{{ $el->partner->name }}</td>
                            <td>{{ date('d-m-Y',strtotime($el->ex_date)) }}</td>
                            <td>{{ $el->ex_time }}</td>
                            <td>{{ $el->user->name }}</td>
                            <td style="color:blue;text-align:right;">+{{ phpformatnumber($el->buy) . ' ' . $el->curbuy }}</td>
                            <td style="color:red;text-align:right;">-{{ phpformatnumber($el->sale) . ' ' . $el->cursale }}</td>
                            <td style="text-align:center;">{{ phpformatnumber($el->main_rate) }}</td>
                            <td style="text-align:center;">{{ phpformatnumber($el->agree_rate) }}</td>
                            <td style="text-align:center;">
                                <a href="#" class="btndelete" data-id="{{ $el->id }}" data-status="{{ $el->status }}"><i class="@if($el->status==1) fa fa-trash @else fa fa-recycle  @endif"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('របាយការណ៏កាត់កង');
        $(document).ready(function () {
            $('#selcustomer').select2();
            $('#seluser').select2();
            $(document).on('click','#tbl_exchange_list td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','#tbl2 td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('change','#selcustomer',function(e){
                e.preventDefault();
                var sp = document.querySelector("#selcustomer");
                var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
                $('#lblpartner').text(customertype);
            })
            var today=new Date();
                $('#dt1,#dt2').datetimepicker({
                    timepicker:false,
                    datepicker:true,
                    value:today,
                    format:'d-m-Y',
                    autoclose:true,
                    todayBtn:true,
                    startDate:today,

                });
                $(document).on('change','#seltype',function(e){
                e.preventDefault();
                var type=$(this).val();

                getpartner(type,'#selcustomer');
            })
            function getpartner(type,el)
                {

                    var url="{{ route('getpartnerbytype') }}";
                    $(el).empty();

                    $.get(url,{type:type},function(data){
                        $(el).append($("<option/>",{
                                    value:'',
                                    text:''
                                }))
                        $.each(data,function(i,item){
                            $(el).append($("<option/>",{
                                    value:item.id,
                                    text:item.name
                                }))
                            //console.log(item)
                        });

                    })
                }

            $(document).on('click','#btnsearch',function(e){
                e.preventDefault()
                showexchangelist();
            })

            function showexchangelist()
            {

                $('body').addClass("wait");
                var d1=$('#dt1').val();
                var d2=$('#dt2').val();
                var partner=$('#selcustomer').val();
                var user=$('#seluser').val();
                var isdel=document.getElementById('ckdel').checked;

                var url="{{ route('exchangelist.show') }}";
                // $.get(url,{d1:d1,d2:d2,partner:partner,user:user},function(data){
                //     //console.log(data);
                //     $('#bodyexchangelist').empty().html(data);
                // })

                 $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {d1:d1,d2:d2,partner:partner,user:user,isdel:isdel},
                    success: function (data) {
                        //console.log(data)
                        if($.isEmptyObject(data.error)){
                            $('#bodyexchangelist').empty().html(data);
                            $('body').removeClass("wait");
                        }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                        }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Error.')
                    }

                })
            }

            $(document).on('click','.btndelete',function(e){
                    e.preventDefault();
                    var katkongid=$(this).data('id');
                    var status=$(this).data('status');
                    var confirmButtonText='Yes, delete it!';
                    var dtext='Deleted!';
                    var text='Do you want to delete it?';
                    if(status==0){
                        confirmButtonText='Yes, restore it!';
                        dtext='Restored!';
                        text="Do you want to restore it?"
                    }
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
                                url: "{{ route('exchangelist.delete') }}",
                                data: { id:katkongid,status:status },
                                success: function (data) {
                                    //console.log(data);
                                    if (data.success === true) {
                                        showexchangelist();
                                        Swal.fire(
                                            dtext,
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


        })

        function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    </script>
@endsection
