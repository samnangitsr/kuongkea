@extends('master')
@section('title') user capital @endsection
@section('css')
    <style type="text/css">
     body.wait *{
        cursor: wait !important;
    }
        #selbank + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:whitesmoke;}
		#select2-selbank-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
		#selbank44 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:whitesmoke;}
		#select2-selbank44-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

        /* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:40px;}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
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
        #tbl_addusercapital td{
            padding:2px;
        }
        #tblcashinout td{
            padding:2px;
        }
        #tbltransferinout td{
            padding:2px;
        }
       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }
       .cgr{
        background-color:aquamarine;
       }
       .hiddenrow{
        display:none;
       }
    .tbl_capital .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_capital .clickedrow td input{
        background-color: #caaf8f;
    }
    .tbl_capital td{
        padding:2px 5px 2px 5px;
    }
    #divfooter{

    color:white;
    margin: auto;
    margin-left:-20px;
    margin-right:0px;
    padding-bottom:0px;
    position: fixed;
    bottom: 40px;
    max-width: 85%;
    /* min-height: 125px;
    max-height: 125px; */
    /* background-color: rgb(195, 201, 206); */
    color: white;
    max-height : 200px;
    overflow:auto;
    clear: both;
    }
    ul.ui-autocomplete {
    z-index: 1100;
}
    .cblue{
        color:blue;
    }
    .cred{
        color:red;
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
        {{-- <div class="col-lg-6">
            <h1 class="kh22-b">ដាក់ដកបុគ្គលិក</h1>
        </div> --}}
        <div class="col-lg-6">
            <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
            <input id="txtuserid" type="hidden" value="{{ Auth::id() }}">
        </div>
    </div>
   <div class="row" style="margin-top:-20px;">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td style="border-style:none;padding:0px;">
                        <button id="btnaddcapital" class="btn-3d kh16">ដាក់ដើមទុន</button>
                        <button id="btntransferinout" class="btn-3d btn-3d-primary kh16">ដាក់ដកបុគ្គលិក</button>
                        <button id="btnendbalance" class="btn-3d btn-3d-warning kh16">ដកចុងគ្រា</button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="" style="margin-top:-5px;margin-bottom:5px;">

                <tr>
                    <td style="border-style:none;width:120px;" class="kh16-b">កាលបរិច្ឆេទ</td>
                    <td style="border-style:none;padding:0px 10px;" class="kh16-b">ក្រុមហ៊ុន</td>

                    <td style="border-style:none;padding:0px">
                        <div class="form-check">
                            <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="raduser" id="raduserrecord" value="userrecord">
                            <label class="form-check-label kh16-b" for="raduserrecord">អ្នកកត់ត្រា</label>
                        </div>
                    </td>
                    <td style="border-style:none;padding:0px 10px;">
                        <div class="form-check">
                            <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="raduser" id="raduseraffect" value="useraffect" checked>
                            <label class="form-check-label kh16-b" for="raduseraffect">បុគ្គលិកពាក់ព័ន្ធ</label>
                        </div>
                    </td>
                    <td class="kh16-b" style="border-style:none;padding:0px 10px;">
                        រូបិយប័ណ្ណ
                    </td>
                    <td class="kh16-b" style="border-style:none;padding:0px;">
                        ប្រតិបត្តិការណ៏
                    </td>
                   <td style="border-style:none;padding:0px">
                        <div class="form-check">
                            <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radstatus" id="radstatus1" value="1" checked>
                            <label class="form-check-label kh16-b" for="radstatus1">ទិន្ន័យ</label>
                        </div>
                    </td>
                    <td style="border-style:none;padding:0px 0px 0px 10px;">
                        @if(Auth::user()->role->name=='Admin')
                            <div class="form-check">
                                <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radstatus" id="radstatus0" value="0" >
                                <label class="form-check-label kh16-b" style="color:red;" for="radstatus0">ទិន្ន័យលុប</label>
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="border-style:none;padding:0px;width:120px;">
                        <input type="text" name="showdate" id="showdate" class="form-control" style="width:120px;font-size:16px;font-weight:bold;height:30px;">
                    </td>
                    <td style="padding:0px 10px;border-style:none;width:200px;">

                        <select name="selcompany" id="selcompany" class="kh16-b" style="width:100%;height:30px;">
                            {{-- <option value="all">All Company</option> --}}
                            @foreach ($companies as $comp)
                                <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}} @if(Auth::user()->role->name!='Admin' && $comp->id!=$selcomid) disabled @endif>{{ $comp->name }}</option>
                            @endforeach
                        </select>

                    </td>


                    <td colspan=2 style="border-style:none;padding:0px;">
                        <select name="seluser" id="seluser" class="kh16-b" style="height:30px;width:100%;">
                            <option value="all">បុគ្គលិកទាំងអស់</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="border-style:none;padding:0px 10px;">
                        <select name="selcur0" id="selcur0" class="kh16-b" style="height:30px;">
                            <option value="all">All Currency</option>
                            @foreach ($currencies as $item)
                                <option value="{{ $item->id }}">{{ $item->shortcut }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="border-style:none;padding:0px;">
                        <select name="seltran" id="seltran" class="kh16-b" style="height:30px;">
                            <option value="all">All Transaction</option>
                            <option value="2">ដើមទុនចាប់ផ្តើម</option>
                            <option value="1">លុយដាក់ចូល</option>
                            <option value="-1">លុយដកចេញ</option>
                            <option value="-2">លុយដកចុងគ្រា</option>
                        </select>
                    </td>
                    <td colspan=2 style="border-style:none;padding:0px 5px 0px 20px;">
                        <button id="btnshow" class="btn-3d btn-3d-primary kh14-b">បង្ហាញ</button>
                        <button id="btnprint" class="btn-3d kh14-b">ព្រីន</button>
                    </td>


                </tr>

            </table>
        </div>
   </div>
   <div id='contentbody'>
       <div class="row">
            <div class="card">
                <div class="card-header" style="height:40px;">
                    <table>
                        <tr>
                            <td>
                                 <h3 class="kh16-b">តារាងដើមទុនបុគ្គលិក</h3>
                            </td>

                        </tr>
                    </table>


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
                                    @foreach ($usercapitals as $key =>$uc)
                                        <tr class="@if($uc->amount>0) cblue @else cred @endif">
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
                                                            <a href="#" class="uc_update kh12-b" style="color:blue" data-id="{{ $uc->id }}" data-ref_number="{{ $uc->ref_number }}">Edit  |</i></a>
                                                            {{-- @endif --}}
                                                        @endif
                                                        @if(str_contains($uc->action,'d'))
                                                            {{-- @if (App\User::checkpermission(Auth::id(),1.6)) --}}
                                                                <a href="#" class="uc_delete kh12-b" style="color:red;" data-id="{{ $uc->id }}" data-status="{{$uc->status}}" data-action="delete" data-ref_number="{{ $uc->ref_number }}" data-location_id="{{ $uc->location_id }}">Delete</i></a>
                                                            {{-- @endif --}}
                                                        @endif

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
            <div class="card" id="" style="padding:0px;margin:0px;">
                <div class="card-header" style="padding:0px 10px;">
                    <h3 style="">Summary</h3>
                </div>
                <div class="card-body" style="margin:0px;padding:0px;">
                    <div class="table-responsive" style="padding:10px;">
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
                                            {{ phpformatnumber(App\UserCapital::summarycapital($c->currency_id,$current,Auth::id(),'useraffect')) }}
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
   </div>
    @include('usercapitals.addstartcapitalmodal')
    @include('usercapitals.cashinoutusermodal')
    @include('usercapitals.transferinoutmodal')

@endsection
@section('script')

    <script type="text/javascript">
         $('#h1_title').text('ដើមទុនបុគ្គលិក');
        function checkright()
        {
            $('#seluser').val($('#txtuserid').val());
            var role=$('#txtrole').val();
            if(role!='Admin'){
                $('#trandate').datetimepicker("destroy");
                $('#trandate1').datetimepicker("destroy");
                $('#seluser').attr('disabled',true);

            }
        }
       $(document).ready(function () {
            var today=new Date();
            $('#trandate,#showdate,#trandate1,#trandate3').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            checkright();
            //getcustomerbyuser();
           $(document).on('change','#selbank44',function(e){
                e.preventDefault();
                // $('#txtaccountnumber44').val('');
                // $('#txtaccountname44').val('');
                // getphonenumber();
                if($('#id3').val()==''){
                    if($(this).val()!==''){
                        $('#rowbal2').css('display','table-row');
                        getwingbalance($(this).val(),$('#selcur33 option:selected').text(),'#balance2','#balancenext2',$('#signout33').val(),$('#amount33').val(),fillnextbalance);
                    }else{
                        $('#rowbal2').css('display','none');
                    }
                }
           })
           $(document).on('change','#selcur',function(e){
                e.preventDefault();
                //debugger;
                let isgold = $(this).find('option:selected').attr('isgold');
                let tuochek = $(this).find('option:selected').attr('tuochek');
                if(isgold==1 && tuochek>1){
                    $('#row_water').css('display','table-row');
                }else{
                    $('#row_water').css('display','none');
                    $('#goldwater').val('');
                }

            });
           $(document).on('change','#sellist33',function(e){
                e.preventDefault();
                if($('#id3').val()==''){
                    if($(this).val()!==''){
                        $('#rowbal1').css('display','table-row');
                        getwingbalance($(this).val(),$('#selcur33 option:selected').text(),'#balance1','#balancenext1',$('#sign33').val(),$('#amount33').val(),fillnextbalance);
                    }else{
                        $('#rowbal1').css('display','none');
                    }
                }
           })
            $("#selbank").select2({
                dropdownParent: $("#cashinoutusermodal")
            });
            $("#selbank44").select2({
                dropdownParent: $("#transferinoutusermodal")
            });
            $("#sellist33").select2({
                dropdownParent: $("#transferinoutusermodal")
            });
           $(document).on('change','#seltype',function(e){
                e.preventDefault();
                var customertype=$('#seltype').val();
                $('#selbank').empty();
                var url="{{ route('usercapital.getcustomerbytype') }}";
                $.get(url,{customertype:customertype},function(data){
                   //console.log(data);
                   $('#selbank').append($("<option/>",{
						value:'',
						text:'Please Select ' + customertype
					}))
                    $.each(data,function(i,item){
                        $('#selbank').append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))
                    });
                })
           })
           $(document).on('change','#seltype44',function(e){
                e.preventDefault();
                var customertype=$('#seltype44').val();
                $('#selbank44').empty();
                var url="{{ route('usercapital.getcustomerbytype') }}";
                $.get(url,{customertype:customertype},function(data){
                   //console.log(data);
                   $('#selbank44').append($("<option/>",{
						value:'',
						text:'Please Select ' + customertype
					}))
                    $.each(data,function(i,item){
                        $('#selbank44').append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))

                    });
                })
           })
            var cleavegoldweater = new Cleave('#goldwater', {
                numeral: true,

            });
             var cleavegoldweater33 = new Cleave('#goldwater33', {
                numeral: true,

            });
           var cleave = new Cleave('#usd_amount', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#khr_amount', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#thb_amount', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });

            var cleave = new Cleave('#amount', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#amount1', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#amount33', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                showdata();
            })

            $(document).on('change','#selcur0,#seluser,#seltran',function(e){
                e.preventDefault();
                showdata();
            })
            $(document).on('click','#btnaddcapital',function(e){
                e.preventDefault();
                $('#userstartcapitalmodal').modal('show');
                $('#trmode').val(2);
                $('#trid').val(0);
                $('#mtitle').text('លុយដាក់ដើមគ្រា');
                $('#tranname').val('លុយដាក់ដើមគ្រា');
                $('#tdreceiver').text('ដាក់អោយបុគ្គលិក');
                $('#note').val('');
                $('#amount').val('');
                $('#selcur').val('');
                $('#selcur').attr('title','');
                $('#btnsavecapital').text('Save');
                // $('#tbl_addusercapital').css('background-color','rgb(159, 232, 231)');
                $('#cashtype').val('cash');
                $('#cashtype').trigger('change');

                document.getElementById("cashtype").disabled = false;
                document.getElementById("useraccount").disabled = false;
                document.getElementById("usd_amount").disabled = false;
                document.getElementById("thb_amount").disabled = false;
                document.getElementById("khr_amount").disabled = false;
            })
            $(document).on('change','#selcompany',function(e){
                e.preventDefault();
                $('#selcompany1').val($(this).val());
                $('#selcompany2').val($(this).val());

                getuserbycompany('#seluser','#selcur0',showdata);
                $('#selcompany1').trigger('change');
                $('#selcompany2').trigger('change');

            })
            $(document).on('change','#selcompany1',function(e){
                e.preventDefault();
                getuserbycompany1('#seluserreceive','#selcur');
            })
             $(document).on('change','#selcompany2',function(e){
                e.preventDefault();
                getuserbycompany2('#seluser33','#seluserout33','#selcur33');
            })
            function getuserbycompany(el,el1,callback)
            {
                $(el).empty();
                $(el1).empty();

                var selcompany=$('#selcompany').val();
                $('body').addClass("wait");
                var url="{{ route('company.getuser') }}";
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {company_id:selcompany},

                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                         $(el).append($("<option/>",{
                                value:'all',
                                text:'បុគ្គលិកទាំងអស់',
                            }))
                        $.each(data['users'],function(i,item){
                            $(el).append($("<option/>",{
                                value:item.id,
                                text:item.name,
                            }))
                        });
                         $(el1).append($("<option/>",{
                                value:'all',
                                text:'all currency',
                            }))
                        $.each(data['currencies'],function(i,item){
                            $(el1).append($("<option/>",{
                                value:item.id,
                                text:item.shortcut,
                            }))
                        });
                        callback();
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            }
            function getuserbycompany1_old(el,el1)
            {
                $(el).empty();
                $(el1).empty();
                $('#selcurusd').empty();
                $('#selcurkhr').empty();
                $('#selcurthb').empty();

                var selcompany=$('#selcompany1').val();
                $('body').addClass("wait");
                var url="{{ route('company.getuser') }}";
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {company_id:selcompany},

                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                         $(el).append($("<option/>",{
                                value:'',
                                text:'',
                            }))
                        $.each(data['users'],function(i,item){
                            $(el).append($("<option/>",{
                                value:item.id,
                                text:item.name,
                            }))
                        });
                         $(el1).append($("<option/>",{
                                value:'',
                                text:'',
                            }))
                        $.each(data['currencies'],function(i,item){
                            $(el1).append($("<option/>",{
                                value:item.id,
                                text:item.shortcut,
                            }))
                        });
                         $('#selcurusd').append($("<option/>",{
                                value:'',
                                text:'',
                            }))
                        $.each(data['currencies'],function(i,item){
                           $('#selcurusd').append($("<option/>",{
                                value:item.id,
                                text:item.shortcut,
                                selected: (item.shortcut === 'USD') // ✅ JS way
                            }))
                        });
                        $('#selcurkhr').append($("<option/>",{
                                value:'',
                                text:'',
                            }))
                        $.each(data['currencies'],function(i,item){
                           $('#selcurkhr').append($("<option/>",{
                                value:item.id,
                                text:item.shortcut,
                                selected: (item.shortcut === 'KHR') // ✅ JS way
                            }))
                        });
                         $('#selcurthb').append($("<option/>",{
                                value:'',
                                text:'',
                            }))
                        $.each(data['currencies'],function(i,item){
                           $('#selcurthb').append($("<option/>",{
                                value:item.id,
                                text:item.shortcut,
                                selected: (item.shortcut === 'THB') // ✅ JS way
                            }))
                        });
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            }
            function getuserbycompany1(el, el1) {
                return new Promise((resolve, reject) => {
                    $(el).empty();
                    $(el1).empty();
                    $('#selcurusd').empty();
                    $('#selcurkhr').empty();
                    $('#selcurthb').empty();

                    var selcompany = $('#selcompany1').val();
                    $('body').addClass("wait");
                    var url = "{{ route('company.getuser') }}";

                    $.ajax({
                        async: true,
                        type: 'GET',
                        url: url,
                        data: { company_id: selcompany },

                        success: function (data) {
                            // ✅ users
                            $(el).append($("<option/>", { value: '', text: '' }));
                            $.each(data['users'], function (i, item) {
                                $(el).append($("<option/>", {
                                    value: item.id,
                                    text: item.name,
                                }));
                            });

                            $(el1).append($("<option/>", { value: '', text: '' }));
                            $.each(data['currencies'], function (i, item) {
                                $(el1).append($("<option/>", {
                                    value: item.id,
                                    text: item.shortcut,
                                }));
                            });

                            // ✅ USD
                            $('#selcurusd').append($("<option/>", { value: '', text: '' }));
                            $.each(data['currencies'], function (i, item) {
                                $('#selcurusd').append($("<option/>", {
                                    value: item.id,
                                    text: item.shortcut,
                                    selected: (item.shortcut === 'USD')
                                }));
                            });

                            // ✅ KHR
                            $('#selcurkhr').append($("<option/>", { value: '', text: '' }));
                            $.each(data['currencies'], function (i, item) {
                                $('#selcurkhr').append($("<option/>", {
                                    value: item.id,
                                    text: item.shortcut,
                                    selected: (item.shortcut === 'KHR')
                                }));
                            });

                            // ✅ THB
                            $('#selcurthb').append($("<option/>", { value: '', text: '' }));
                            $.each(data['currencies'], function (i, item) {
                                $('#selcurthb').append($("<option/>", {
                                    value: item.id,
                                    text: item.shortcut,
                                    selected: (item.shortcut === 'THB')
                                }));
                            });

                            $('body').removeClass("wait");
                            resolve(data); // ✅ resolve the promise with data
                        },

                        error: function (xhr, status, error) {
                            $('body').removeClass("wait");
                            alert('Read Data Error.');
                            reject(error); // ❌ reject the promise
                        }
                    });
                });
            }

             function getuserbycompany2_old(el,el1,el2)
            {
                $(el).empty();
                $(el1).empty();
                $(el2).empty();
                $('#sellist33').empty();
                $('#selbank44').empty();

                var selcompany=$('#selcompany2').val();
                $('body').addClass("wait");
                var url="{{ route('company.getuser') }}";
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {company_id:selcompany},

                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                        $(el).append($("<option/>",{
                                value:'',
                                text:'',
                            }))
                        $.each(data['users'],function(i,item){
                            $(el).append($("<option/>",{
                                value:item.id,
                                text:item.name,
                            }))
                        });
                        $(el1).append($("<option/>",{
                            value:'',
                            text:'',
                        }))
                        $.each(data['users'],function(i,item){
                            $(el1).append($("<option/>",{
                                value:item.id,
                                text:item.name,
                            }))
                        });
                         $(el2).append($("<option/>",{
                                value:'',
                                text:'',
                            }))
                        $.each(data['currencies'],function(i,item){
                            $(el2).append($("<option/>",{
                                value:item.id,
                                text:item.shortcut,
                            }))
                        });

                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            }
            function getuserbycompany2(el, el1, el2) {
                return new Promise((resolve, reject) => {
                    $(el).empty();
                    $(el1).empty();
                    $(el2).empty();
                    $('#sellist33').empty();
                    $('#selbank44').empty();

                    var selcompany = $('#selcompany2').val();
                    $('body').addClass("wait");
                    var url = "{{ route('company.getuser') }}";

                    $.ajax({
                    type: 'GET',
                    url: url,
                    data: { company_id: selcompany },
                    success: function (data) {
                        // ✅ fill users into el
                        $(el).append($("<option/>", { value: '', text: '' }));
                        $.each(data['users'], function (i, item) {
                        $(el).append($("<option/>", { value: item.id, text: item.name }));
                        });

                        // ✅ fill users into el1
                        $(el1).append($("<option/>", { value: '', text: '' }));
                        $.each(data['users'], function (i, item) {
                        $(el1).append($("<option/>", { value: item.id, text: item.name }));
                        });

                        // ✅ fill currencies into el2
                        $(el2).append($("<option/>", { value: '', text: '' }));
                        $.each(data['currencies'], function (i, item) {
                        $(el2).append($("<option/>", { value: item.id, text: item.shortcut }));
                        });

                        $('body').removeClass("wait");

                        resolve(data); // 🔑 resolve when done
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.');
                        reject();
                    }
                    });
                });
            }

            $(document).on('change','#radcashin3,#radcashout3',function(e){
                e.preventDefault();

                C = $("input[name = 'radinout3']:checked").val();
                if(C==="1"){
                    $('#sign33').val('+');
                    $('#signout33').val('-');
                    $('#signlist33').val('+');
                    $('#amtsign33').val('+');
                    $('#sign44').val('-');
                    $('#user33').text('អ្នកទទួល');
                    $('#userout33').text('អ្នកប្រគល់');
                    // $('#userlist33').text('បាញ់ចូល');
                    document.getElementById("seluser33").style.backgroundColor = 'blue';
                    document.getElementById("seluserout33").style.backgroundColor = 'red';

                }else if(C==="-1"){
                    $('#sign33').val('-');
                    $('#signout33').val('+');
                    $('#signlist33').val('-');
                    $('#amtsign33').val('-');
                    $('#sign44').val('+');
                    $('#user33').text('អ្នកប្រគល់');
                    $('#userout33').text('អ្នកទទួល');
                    // $('#userlist33').text('បាញ់ចេញ');
                    document.getElementById("seluser33").style.backgroundColor = 'red';
                    document.getElementById("seluserout33").style.backgroundColor = 'blue';
                }
                if($('#id3').val()==''){
                    if($('#sellist33').val()!==''){
                        fillnextbalance('#balance1','#balancenext1',$('#selcur33 option:selected').text(),$('#sign33').val(),$('#amount33').val());
                    }
                    if($('#selbank44').val()!==''){
                        fillnextbalance('#balance2','#balancenext2',$('#selcur33 option:selected').text(),$('#signout33').val(),$('#amount33').val());
                    }
                }
            })

            $(document).on('click','#btnendbalance',function(e){
                e.preventDefault();
                $('#userstartcapitalmodal').modal('show');
                $('#trmode').val(-2);
                $('#mtitle').text('លុយដកចុងគ្រា');
                $('#tranname').val('លុយដកចុងគ្រា');
                $('#tdreceiver').text('ដកពីបុគ្គលិក');
                // $('#tbl_addusercapital').css('background-color','rgb(243, 211, 220)');
            })

            $(document).on('click','#btnaddcashinoutuser',function(e){
                e.preventDefault();
                $('#cashinoutusermodal').modal('show');
                $('#frmusercashinout').trigger('reset');
                // $('.trbank').addClass("hiddenrow");
                // $('.truser').removeClass("hiddenrow");
                $('#modaltitle').text("ដាក់ដកបុគ្គលិក");
                $('#mode').val(1);
                $('#id1').val(0);
                $('#id2').val(0);
                $('#transfer_id').val(0);
                $('#btnsaveusercashinout').text('Save');
                $('#trandate1').datetimepicker({
                    timepicker:false,
                    datepicker:true,
                    value:today,
                    format:'d-m-Y',
                    autoclose:true,
                    todayBtn:true,
                    startDate:today,

                });
                document.getElementById("seluser2").style.backgroundColor = 'red';
                document.getElementById("seluser1").style.backgroundColor = 'blue';
                $('#selbank').empty();
            })
            $(document).on('click','#btnaddcashinoutuserbank',function(e){
                e.preventDefault();
                $('#cashinoutusermodal').modal('show');
                //$('#frmusercashinout').trigger('reset');
                $('.truser').addClass("hiddenrow");
                $('.trbank').removeClass("hiddenrow");
                $('#modaltitle').text("ដាក់ដកធនាគា");
                $('#mode').val(2);
                $('#id1').val(0);
                $('#id2').val(0);
                clear2();
                $('#btnsaveusercashinout').text('Save');
                // $('#trandate1').datetimepicker({
                //     timepicker:false,
                //     datepicker:true,
                //     value:today,
                //     format:'d-m-Y',
                //     autoclose:true,
                //     todayBtn:true,
                //     startDate:today,

                // });
            })
            function clear2(){
                $('#selbank').val('');
                $('#selbank').trigger('change');
                $('#amount1').val('');
                $('#noteu2').val('');
            }
            $(document).on('click','#btntransferinout',function(e){
                e.preventDefault();
                $('#transferinoutusermodal').modal('show');
                $('#mode').val(2);
                $('#id3').val(0);
                $('#id4').val(0);
                $('#id5').val(0);
                $('#id6').val(0);
                $('#btnsaveusercashinout').text('Save');
                clear3();

            })
            function clear3(){
                // $('#selbank44').val('');
                // $('#selbank44').trigger('change');
                $('#seluser33').trigger('change');
                $('#amount33').val('');
                $('#note33').val('');
                $('#txtaccountnumber44').val('');
                $('#txtaccountname44').val('');
            }
            $('#cashinoutusermodal').on('shown.bs.modal', function () {
                $('#amount1').focus();
            })
            $('#userstartcapitalmodal').on('shown.bs.modal', function () {
                $('#amount').focus();
            })
            $(document).on('keyup','#amount',function(e){
                const C = e.key;
                if (C === "Backspace") return;
                if(isNumber(C)==false){
                    getcurrencybykeylocalstorage1(C,'#selcur')
                }
            })

            $(document).on('keyup','#amount1',function(e){

                if (e.keyCode === 13) {
                    $("#btnsaveusercashinout").focus();
                    return;
                }
                const C = e.key;
                if(C==="+"){
                    e.preventDefault();
                    $('#sign1').val('+');
                    $('#sign2').val('+');
                    $('#sign3').val('-');
                    $('#sign4').val('-');
                    $('#user1').text('ដាក់ចូល');
                    $('#user2').text('ដកចេញ');
                    document.getElementById("seluser2").style.backgroundColor = 'red';
                    document.getElementById("seluser1").style.backgroundColor = 'blue';
                    document.getElementById("radcashin").checked = true;
                    return;
                }else if(C==="-"){
                    e.preventDefault();
                    $('#sign1').val('-');
                    $('#sign2').val('-');
                    $('#sign3').val('+');
                    $('#sign4').val('+');
                    $('#user1').text('ដកចេញ');
                    $('#user2').text('ដាក់ចូល');
                    document.getElementById("seluser2").style.backgroundColor = 'blue';
                    document.getElementById("seluser1").style.backgroundColor = 'red';
                    document.getElementById("radcashout").checked = true;
                    return;
                }
                if (C === "Backspace") return;
                if(isNumber(C)==false){
                    getcurrencybykeylocalstorage1(C,'#selcur1')
                }
            })
            $(document).on('keyup','#amount33',function(e){

                if (e.keyCode === 13) {
                    $("#txtaccountnumber44").focus();
                    return;
                }
                const C = e.key;
                if(C==="+"){
                    e.preventDefault();
                    $('#sign33').val('+');
                    $('#signlist33').val('+');
                    $('#amtsign33').val('+');
                    $('#sign44').val('-');
                    $('#user33').text('បាញ់ចូល');
                    // $('#userlist33').text('ចូលបញ្ជី');
                    document.getElementById("seluser33").style.backgroundColor = 'blue';
                    document.getElementById("radcashin3").checked = true;
                    return;
                }else if(C==="-"){
                    e.preventDefault();
                    $('#sign33').val('-');
                    $('#signlist33').val('-');
                    $('#amtsign33').val('-');
                    $('#sign44').val('+');
                    $('#user33').text('បាញ់ចេញ');
                    // $('#userlist33').text('បាញ់ចេញ');
                    document.getElementById("seluser33").style.backgroundColor = 'red';
                    document.getElementById("radcashout3").checked = true;
                    return;
                }
                if (C === "Backspace") return;
                if(isNumber(C)==false){
                    getcurrencybykeylocalstorage1(C,'#selcur33')
                }
            })
            $(document).on('change','#seluser33',function(e){
                e.preventDefault();
                getcustomerbyuser('#sellist33','#seluser33','cash');
            })
            $(document).on('change','#seluserout33',function(e){
                e.preventDefault();
                getcustomerbyuser('#selbank44','#seluserout33','cash');
            })
             $('input[type=radio][name=radinout]').change(function() {

                C = $("input[name = 'radinout']:checked").val();
                if(C==="1"){

                    $('#sign1').val('+');
                    $('#sign2').val('+');
                    $('#sign3').val('-');
                    $('#sign4').val('-');
                    $('#user1').text('ដាក់ចូល');
                    $('#user2').text('ដកចេញ');
                    document.getElementById("seluser2").style.backgroundColor = 'red';
                    document.getElementById("seluser1").style.backgroundColor = 'blue';

                }else if(C==="-1"){

                    $('#sign1').val('-');
                    $('#sign2').val('-');
                    $('#sign3').val('+');
                    $('#sign4').val('-');
                    $('#user1').text('ដកចេញ');
                    $('#user2').text('ដាក់ចូល');
                    document.getElementById("seluser2").style.backgroundColor = 'blue';
                    document.getElementById("seluser1").style.backgroundColor = 'red';

                }

                 var sign2=$('#sign2').val();
                if(sign2=='-'){
                    seluser='#seluser1';
                }else{
                    seluser='#seluser2';
                }
                getcustomerbyuser('#selbank',seluser,'cash');
            });
            $(document).on('change','#seluser1,#seluser2',function(e){
                e.preventDefault();
                var sign2=$('#sign2').val();
                if(sign2=='-'){
                    seluser='#seluser1';
                }else{
                    seluser='#seluser2';
                }
                getcustomerbyuser('#selbank',seluser,'cash');
            })
            function getcustomerbyuser(el,user,text){
                //debugger;
                var user_id=$(user).val();
                var companyid=$(' #selcompany2').val();
                $(el).empty();
                var url="{{ route('usercapital.getcustomerforuser') }}";
                $.get(url,{user_id:user_id,companyid:companyid},function(data){
                   //console.log(data);
                   $(el).append($("<option/>",{
						value:'',
						text:text,
                        customertype:'cash'
					}))
                    $.each(data,function(i,item){
                        $(el).append($("<option/>",{
                                value:item.id,
                                text:item.name,
                                customertype:item.customertype
                            }))
                    });
                })
            }

            // function getcurrencybykey(key,el)
            // {
            //     var url="{{ route('getcurrencybykey') }}";
            //     $.get(url,{key:key},function(data){
            //         //console.log(data)
            //             if(data['c']!=null){
            //                 $(el).val(data['c']['id']);
            //                 //$(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
            //             }
            //     })
            // }
            function getcurrencybykeylocalstorage1(key,el)
            {
                //debugger;
                var currencylist;
                if(localStorage.getItem("currencylist")==null){
                currencylist=[];
                }else{
                currencylist=JSON.parse(localStorage.getItem("currencylist"));
                }
                currencylist.forEach(function(c){
                //debugger;
                if(c.skey==key){
                    $(el).val(c.id);
                    // $(el).attr('title', c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);

                }
                })
            }
            $(document).on('change','#useraccount',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var cid=$(this).val();
                var d2=$('#trandate').val();
                var trmode=$('#trmode').val();
                var op='';
                if(trmode==2){
                    op='<=';
                }else if(trmode==-2){
                    op='<=';
                }
                var url="{{ route('closelist.summarypartnerlist') }}";
                $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {cid:cid,showdate:d2,op:op},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#usd_amount').val(formatNumber(-1 * data.usd));
                        $('#thb_amount').val(formatNumber(-1 * data.thb));
                        $('#khr_amount').val(formatNumber(-1 * data.khr));

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

            })

            $(document).on('click','#btnsavecapital',function(e){
                e.preventDefault();
                //var d=$('#listdate').val();
                $('body').addClass("wait");
                var buttontext=$(this).text();
                $(this).attr('disabled', true).text("Processing");
                var el=$(this);
                var agentname=$('#useraccount option:selected').text();
                var useraccount_length=document.getElementById("useraccount").options.length
                if(useraccount_length>1){
                    if(agentname==''){
                        $(el).removeAttr('disabled').html(buttontext);
                        $('body').removeClass("wait");
                        alert('please select agent name.')
                        return;
                    }
                }

                if($('#trid').val()>0 && $('#cashtype').val()=='agent'){
                    var selcur=$('#selcur option:selected').text();
                    var oldcur=$('#selcur').attr('title');
                    if(selcur!==oldcur){
                        $(el).removeAttr('disabled').html(buttontext);
                        $('body').removeClass("wait");
                        alert('update agent capital currency not allow')
                        return;
                    }
                }

                var agentid=$('#useraccount').val();
                var selcurusd=$('#selcurusd').val();
                var selcurthb=$('#selcurthb').val();
                var selcurkhr=$('#selcurkhr').val();

                var formdata = new FormData(frmusercapital);
                formdata.append('agentid',agentid);
                formdata.append('agentname',agentname);
                formdata.append('selcurusd',selcurusd);
                formdata.append('selcurthb',selcurthb);
                formdata.append('selcurkhr',selcurkhr);

                var url="{{ route('usercapital.store') }}";
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       if($.isEmptyObject(data.error)){
                            //location.reload();
                            //alert('user capital save')

                            @if(config('helper.show_user_capital_master') == '1')
                                getuseraccount_master(1,1,$('#loginid').val());
                            @endif
                            showdata();
                            if($('#trid').val()==0){
                              cleartext();
                            }else{
                              $('#userstartcapitalmodal').modal('hide');
                            }
                            var today = new Date();

                            $(el).removeAttr('disabled').html(buttontext);
                            $('body').removeClass("wait");
                       }else{
                            $(el).removeAttr('disabled').html(buttontext);
                            $('body').removeClass("wait");
                            alert(data.error)
                       }

                    },
                    error: function () {
                        $(el).removeAttr('disabled').html(buttontext);
                        $('body').removeClass("wait");
                        alert('Save Error')

                    }

                })
            })

            function cleartext(){
                $('#amount').val('');
                $('#goldwater').val('');
                $('#usd_amount').val('');
                $('#khr_amount').val('');
                $('#thb_amount').val('');
                $('#usd_amount').focus();
            }
            function cleartext1(){
                $('#amount1').val('');
                $('#noteu2').val('')
                $('#amount1').focus();
            }
            function cleartext3(){
                $('#amount33').val('');
                $('#goldwater33').val('');
                $('#txtaccountnumber44').val('');
                $('#txtaccountname44').val('');
                $('#note33').val('');
                $('#amount33').focus();
                $('#sellist33').val('');
                $('#selbank44').val('');
                $('#sellist33').trigger('change');
                $('#selbank44').trigger('change');

            }
            $(document).on('click','#btnsaveusercashinout',function(e){
                e.preventDefault();
                //var d=$('#listdate').val();
                var sp = document.querySelector("#selbank");
                var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
                //var mode=$('#mode').val();
                var user1=$('#seluser1 option:selected').text();
                var user2=$('#seluser2 option:selected').text();
                // if(mode==1){
                //     var sender=$('#seluser2 option:selected').text();
                // }else{
                //     var sender=$('#selbank option:selected').text();
                // }
                var curname=$('#selcur1 option:selected').text();
                var formdata = new FormData(frmusercashinout);
                formdata.append('user1',user1);
                formdata.append('user2',user2);
                formdata.append('curname',curname);
                formdata.append('capitaltype',customertype);

                var url="{{ route('usercapital.store1') }}";
                $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       if($.isEmptyObject(data.error)){
                            //location.reload();
                            //alert('user capital save')
                            toastr.success("Save User Cash in out Successfully");
                            if($('#id1').val()>0){
                              $('#cashinoutusermodal').modal('hide');
                            }else{
                              cleartext1();
                            }
                            showdata();
                            var today = new Date();
                            @if(config('helper.show_user_capital_master') == '1')
                                getuseraccount_master(1,1,$('#loginid').val());
                            @endif

                       }else{
                            alert(data.error)
                       }

                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
            })
            $(document).on('click','#btnsaveusertransferinout',function(e){
                e.preventDefault();
                try{
                    // if($('#seluser33').val()==$('#seluserout33').val()){
                    //     alert('same user not allow')
                    //     return;
                    // }
                    $('body').addClass("wait");
                    var buttontext=$(this).text();
                    $(this).attr('disabled', true).text("Processing");
                    var el=$(this);
                    var sp = document.querySelector("#sellist33");
                    var customertype1=sp.options[sp.selectedIndex].getAttribute('customertype');
                    var sp1 = document.querySelector("#selbank44");
                    var customertype2=sp1.options[sp1.selectedIndex].getAttribute('customertype');
                    var receive=$('#seluser33 option:selected').text();
                    var receivelist=$('#sellist33 option:selected').text();
                    var sender=$('#seluserout33 option:selected').text();
                    var senderlist=$('#selbank44 option:selected').text();
                    var curname=$('#selcur33 option:selected').text();
                    var formdata = new FormData(frmusercashinout3);
                    formdata.append('receive',receive);
                    formdata.append('receivelist',receivelist);
                    formdata.append('sender',sender);
                    formdata.append('senderlist',senderlist);
                    formdata.append('curname',curname);
                    formdata.append('customertype1',customertype1);
                    formdata.append('customertype2',customertype2);
                    var url="{{ route('usercapital.store3') }}";
                    $.ajax({
                        async: true,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        url: url,
                        data: formdata,
                        success: function (data) {
                           //console.log(data)
                           if($.isEmptyObject(data.error)){
                                toastr.success("Save User Balance Successfully");
                                showdata();
                                if($('#id3').val()>0){
                                  $('#transferinoutusermodal').modal('hide');
                                }else{
                                  cleartext3();
                                }
                                $(el).removeAttr('disabled').html(buttontext);
                                $('body').removeClass("wait");
                           }else{
                                $(el).removeAttr('disabled').html(buttontext);
                                $('body').removeClass("wait");
                                alert(data.error)
                           }
                        },
                        error: function () {
                            $(el).removeAttr('disabled').html(buttontext);
                            $('body').removeClass("wait");
                            alert('Save Error')
                        }

                    })
                }catch{
                    $(el).removeAttr('disabled').html(buttontext);
                    $('body').removeClass("wait");
                }

            })
             // Remove previous highlight class
            $(document).on('click','.tbl_capital td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
             $(document).on('click','#btnprint',function(e){
                e.preventDefault();
                var user=$('#seluser').val();
                var cur=$('#selcur0').val();
                var showdate=$('#showdate').val();
                var raduser=$('input[name="raduser"]:checked').val();
                var trancode=$('#seltran').val();
                var companyid=$('#selcompany').val();
                var redirectWindow = window.open('{{ url('/') }}'+'/usercapital/search?user='+user + '&searchdate=' + showdate +'&raduser='+raduser + '&cur='+cur+'&trancode='+trancode+'&companyid='+companyid+'&print=1', '_blank');
                redirectWindow.location;
            })
            function showdata()
            {
                $('body').addClass("wait");
                var user=$('#seluser').val();
                var cur=$('#selcur0').val();
                var showdate=$('#showdate').val();
                var raduser=$('input[name="raduser"]:checked').val();
                var radstatus=$('input[name="radstatus"]:checked').val();

                var trancode=$('#seltran').val();
                var companyid=$('#selcompany').val();
                var url="{{ route('usercapital.search') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {user:user,searchdate:showdate,raduser:raduser,radstatus:radstatus,cur:cur,trancode:trancode,companyid:companyid},
                    success: function (data) {
                        //console.log(data)
                        if($.isEmptyObject(data.error)){
                            $('#contentbody').empty().html(data);
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

                // $.get(url,{user:user,searchdate:showdate,raduser:raduser,cur:cur,trancode:trancode},function(data){
                //     //console.log(data)
                //     $('#contentbody').empty().html(data);
                // })
            }
            $(document).on('change', 'input[name="raduser"]', function(e) {
                e.preventDefault();
                showdata();
            })
              $(document).on('change', 'input[name="radstatus"]', function(e) {
                e.preventDefault();
                showdata();
            })
            $(document).on('change','#cashtype,#seluserreceive',function(e){
              e.preventDefault();
              $('#useraccount').empty();
              var cashtype=$('#cashtype').val();
              if(cashtype=='agent'){
                var useragent=$('#seluserreceive').val();
                var url="{{ route('getagentuser') }}";
                $.get(url,{useragent:useragent},function(data){
                    //console.log(data);
                    $('#useraccount').append($("<option/>",{
                                value:'',
                                text:''
                            }))
                    $.each(data['agentuser1'],function(i,item){
                        $('#useraccount').append($("<option/>",{
                            value:item.id,
                            text:item.name
                        }))
                    });
                    // $.each(data['agentuser2'],function(i,item){
                    //     $('#useraccount').append($("<option/>",{
                    //         value:item.id,
                    //         text:item.name
                    //     }))
                    // });
                    // $.each(data['agentuser3'],function(i,item){
                    //     $('#useraccount').append($("<option/>",{
                    //         value:item.id,
                    //         text:item.name
                    //     }))
                    // });
                    // $.each(data['agentuser4'],function(i,item){
                    //     $('#useraccount').append($("<option/>",{
                    //         value:item.id,
                    //         text:item.name
                    //     }))
                    // });
                })
              }
            })

            $(document).on('click','.uc_update',async function(e){
                e.preventDefault();
                //debugger;
                //var modalnum=0;
                var id=$(this).data('id');
                var refnumber=$(this).data('ref_number');
                var url="{{ route('usercapital.edit') }}";
                $.get(url,{id:id,refnumber:refnumber},async function(data){
                    //console.log(data);
                    if(data['record1'].location_id==1){
                        $('#userstartcapitalmodal').modal('show');
                        $('#selcompany1').val(data['record1'].company_id)
                        await getuserbycompany1('#seluserreceive','#selcur');
                        $('#trmode').val(data['record1'].trancode);
                        $('#tranname').val(data['record1'].tranname);
                        $('#trid').val(data['record1'].id);
                        $('#trandate').val(moment(data['record1'].trandate).format('DD-MM-YYYY'));
                        $('#seluserreceive').val(data['record1'].user_id_affect);
                        $('#cashtype').val(data['record1'].capital_type);
                        $('#cashtype').trigger('change');
                        $('#useraccount').val(data['record1'].agent_id);
                        document.getElementById("cashtype").disabled = true;
                        document.getElementById("useraccount").disabled = true;
                        document.getElementById("usd_amount").disabled = true;
                        document.getElementById("thb_amount").disabled = true;
                        document.getElementById("khr_amount").disabled = true;

                        $('#amount').val(formatNumber(Math.abs(data['record1'].amount)));
                        $('#selcur').val(data['record1'].currency_id);
                        $('#selcur').attr('title',$('#selcur option:selected').text());
                        $('#goldwater').val(data['record1'].goldwater);
                        if(data['record1'].goldwater>0){
                            $('#row_water').css('display','table-row')
                        }else{
                            $('#row_water').css('display','none')
                        }
                        $('#note').val(data['record1'].note);
                        $('#mtitle').text('កែប្រែទិន្ន័យ');
                        $('#btnsavecapital').text('Update');
                    }else if(data['record1'].location_id==2){
                        $('#cashinoutusermodal').modal('show');
                          $('#id1').val(data['record1'].id);
                          $('#id2').val(data['record1'].map_id);
                          $('#transfer_id').val(data['record1'].transfer_id);
                          $('#trandate1').val(moment(data['record1'].trandate).format('DD-MM-YYYY'));
                          $('#seluser1').val(data['record1'].user_id_affect);
                          $('#seluser2').val(data['record1'].user_reverse_id);
                          if(data['record1'].trancode==1){
                            const cashinBtn = document.getElementById('radcashin');
                            cashinBtn.checked=true;
                          }else if(data['record1'].trancode==-1){
                            const cashoutBtn = document.getElementById('radcashout');
                            cashoutBtn.checked=true;
                          }
                          $("input[name=radinout]").trigger("change");
                          $('#selbank').val(data['record1'].agent_id);
                          $('#selbank').trigger('change');
                          $('#amount1').val(formatNumber(Math.abs(data['record1'].amount)));
                          $('#selcur1').val(data['record1'].currency_id);
                          $('#noteu2').val(data['record1'.note1]);
                          $('#btnsaveusercashinout').text('Update');
                          $('#modaltitle').text("កែប្រែដាក់ដកបុគ្គលិក");

                    }else if(data['record1'].location_id==3){
                        $('#transferinoutusermodal').modal('show');
                          $('#selcompany2').val(data['record1'].company_id)
                          await getuserbycompany2('#seluser33','#seluserout33','#selcur33');

                          $('#id3').val(data['record1'].id);
                          $('#id4').val(data['record1'].transfer_id);
                          $('#id5').val(data['record1'].transfer_id2);
                          $('#id6').val(data['record1'].map_id);

                          $('#trandate3').val(moment(data['record1'].trandate).format('DD-MM-YYYY'));
                          $('#modaltitle3').text("កែប្រែបាញ់ចេញបាញ់ចូល");

                          if(data['record1'].trancode==4){
                            const cashinBtn = document.getElementById('radcashin3');
                            cashinBtn.checked=true;
                          }else if(data['record1'].trancode==-4){
                            const cashoutBtn = document.getElementById('radcashout3');
                            cashoutBtn.checked=true;
                          }

                          $("input[name=radinout3]").trigger("change");
                          $('#seluser33').val(data['record1'].user_id_affect);
                          $('#seluserout33').val(data['record1'].user_reverse_id);
                          $('#seluser33').trigger('change');
                          $('#seluserout33').trigger('change');
                          $('#amount33').val(formatNumber(Math.abs(data['record1'].amount)));
                          $('#selcur33').val(data['record1'].currency_id);
                          $('#goldwater33').val(data['record1'].goldwater);
                            if(data['record1'].goldwater>0){
                                $('#row_water33').css('display','table-row')
                            }else{
                                $('#row_water33').css('display','none')
                            }
                          $('#note33').val(data['record1'].note1);
                          $('#selbank44').val(data['record1'].agent_id_reverse);
                          $('#selbank44').trigger('change');
                          $('#sellist33').val(data['record1'].agent_id);
                          $('#sellist33').trigger('change');
                        //   $('#txtaccountnumber44').val(accnumber3);
                        //   $('#txtaccountname44').val(accname3);
                          $('#btnsaveusertransferinout').text('Update');
                    }

                })
            })
            $(document).on('click','.uc_delete,.uc_restore',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var status=$(this).data('status');
                var action=$(this).data('action');
                var refnumber=$(this).data('ref_number');
                var location_id=$(this).data('location_id');
                if(action=='restore'){
                    var confirmbuttonText= 'Yes, restore it!';
                    var text='Restored';
                }else{
                    var confirmbuttonText= 'Yes, delete it!';
                     var text='Deleted';
                }
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: confirmbuttonText
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'POST',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('usercapital.delete') }}",
                            data: { id:id,refnumber:refnumber,location_id:location_id,status:status,action:action },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();

                                    @if(config('helper.show_user_capital_master') == '1')
                                        getuseraccount_master(1,1,$('#loginid').val());
                                    @endif
                                    showdata();
                                    Swal.fire(
                                        text,
                                        data.message,
                                        'success'
                                    )
                                    var today = new Date();

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

        $(document).on('keydown', '.canenter', function (e) {
              if (e.keyCode == 13) {
                  var id = $(this).attr("id");
                  if (id == 'usd_amount') {
                      $('#khr_amount').focus();
                  } else if(id == 'khr_amount'){
                    $('#thb_amount').focus();
                  } else if (id == 'thb_amount'){
                      $('#amount').focus();
                  }else if (id == 'amount') {
                    $('#btnsavecapital').focus();
                  }
                  e.preventDefault();
              }
        })
        $(document).on('change','#amount33',function(e){
            e.preventDefault();
            if($('#id3').val()==''){
                if($('#sellist33').val()!==''){
                    fillnextbalance('#balance1','#balancenext1',$('#selcur33 option:selected').text(),$('#sign33').val(),$('#amount33').val());
                }
                if($('#selbank44').val()!==''){
                    fillnextbalance('#balance2','#balancenext2',$('#selcur33 option:selected').text(),$('#signout33').val(),$('#amount33').val());
                }
            }

        })

        $(document).on('change','#selcur33',function(e){
            e.preventDefault();
             let isgold = $(this).find('option:selected').attr('isgold');
            let tuochek = $(this).find('option:selected').attr('tuochek');
            if(isgold==1 && tuochek>1){
                $('#row_water33').css('display','table-row');
            }else{
                $('#row_water33').css('display','none');
                $('#goldwater33').val('');
            }
            if($('#id3').val()==''){
                if($('#sellist33').val()!==''){
                    fillnextbalance('#balance1','#balancenext1',$('#selcur33 option:selected').text(),$('#sign33').val(),$('#amount33').val());
                }
                if($('#selbank44').val()!==''){
                    fillnextbalance('#balance2','#balancenext2',$('#selcur33 option:selected').text(),$('#signout33').val(),$('#amount33').val());
                }
            }
        })

//---------------------------
        function fillnextbalance(elbal,elnext,cur,sign,amount)
            {
                var mekun=0;
                if(sign=='+'){
                    mekun=-1;
                }else{
                    mekun=1;
                }

                var amt=amount.replace(/,/g,'');
                var i=0;
                var baltitle=$(elbal).attr('title');
                var balusd=baltitle.split(";")[0];
                var balkhr=baltitle.split(";")[1];
                var balthb=baltitle.split(";")[2];
                var balnext=0;
                var bal=0;
                var cur1='';


                if(cur=='USD'){
                    balnext=-1 * (parseFloat(balusd)+ parseFloat(mekun * amt));
                    bal=-1 * parseFloat(balusd);
                    cur1=' USD';
                }else if(cur=='KHR'){
                    balnext=-1 * (parseFloat(balkhr)+ parseFloat(mekun * amt));
                    bal=-1 * parseFloat(balkhr);
                    cur1=' KHR';
                }else if(cur=='THB'){
                    balnext=-1 * (parseFloat(balthb)+ parseFloat(mekun * amt));
                    bal=-1 * parseFloat(balthb);
                    cur1=' THB';
                }
                $(elnext).val(formatNumber(balnext) + cur1);
                $(elbal).val(formatNumber(bal) + cur1);
                if(bal>0){
                    $(elbal).css('color','blue');
                }else{
                    $(elbal).css('color','red');
                }
                if(balnext>0){
                    $(elnext).css('color','blue');
                }else{
                    $(elnext).css('color','red');
                }
            }
          function getwingbalance(cid,cur,elem,elnext,sign,amount,callback)
          {
            $('body').addClass("wait");
                //$('#wingbalancenext').val('');
                var amt=0;
                var fee=0;
                var total=0;
                var d2=$('#h1_date').text();
                var op='<=';
                var url="{{ route('closelist.summarypartnerlist') }}";

                $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {cid:cid,showdate:d2,op:op},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        $(elem).attr('title',data.usd+';'+data.khr+';'+data.thb);

                        callback(elem,elnext,cur,sign,amount);
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


        })//end document ready
        function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
        function getphonenumber()
    {
        var parrent_id=$('#selbank44').val();

      $.ajax({
                async: true,
                type: 'GET',
                url: "{{ route('accountnumber.autocomplete') }}",
                data: {parrent_id:parrent_id},
                complete: function () {

                },
                success: function (data) {
                  //console.log(data);
                  $("#txtaccountnumber44").autocomplete({
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
                          $('#txtaccountname44').val(ui.item.recname);
                      }
                  });
                },
                error: function () {
                    alert('Read Phone Number Error.')
                }
            })
    }
    </script>
@endsection
