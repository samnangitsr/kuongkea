@extends('master')
@section('title') បិទបញ្ជីបុគ្គលិក @endsection
@section('css')
    <style type="text/css">
           body.wait *{
			cursor: wait !important;
		}
    body {position: relative;}
         .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
        .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            }
            .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
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
       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }
       .cgr{
        background-color:aquamarine;
       }
       .tbl_userreport .clickedrow td{
        background-color: yellow;
    }
    .tableFixHead{ overflow: auto;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    .tbl_userreport td{
        padding:2px;
    }
    .tbl_userreport th{
        padding:2px;
    }
    .mybtn{
        border:1px dotted black;
        padding:0px 5px;
    }
    .mybtn:hover{
        background-color:green;
        color:white !important;
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

   <div class="row" style="margin-top:-25px;">
    <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
        <div class="table-responsive">
            <table class="">
                <tr>
                    <td style="border-style:none;width:110px;" class="kh16-b">កាលបរិច្ឆេទ</td>
                    @if(Auth::user()->role->name=='Admin')
                        <td style="border-style:none;" class="kh16-b">ក្រុមហ៊ុន</td>
                    @endif
                    <td style="border-style:none;width:220px;" class="kh16-b">
                        បុគ្គលិក
                        <label class="form-check-label kh16-b">
                            <input class="form-check-input kh16-b" type="radio" name="money_type" id="ckcash" value="cash"> លុយក្រៅ
                        </label>

                        <label class="form-check-label kh16-b">
                            <input class="form-check-input kh16-b" type="radio" name="money_type" id="ckbank" value="bank"> លុយក្នុង
                        </label>
                        <label class="form-check-label kh16-b">
                            <input class="form-check-input kh16-b" type="radio" name="money_type" id="ckboth" value="both" checked> ទាំងពីរ
                        </label>
                    </td>

                    <td style="border-style:none;"></td>
                </tr>
                <tr>
                    <td style="border-style:none;padding:0px;">
                        <input type="text" name="stockdate" id="stockdate" class="" style="width:110px;background-color:silver;font-size:16px;" readonly>

                    </td>
                    <td style="padding:0px;border-style:none;width:200px;">
                        @if(Auth::user()->role->name=='Admin')
                            <select name="selcompany" id="selcompany" class="kh16-b" style="width:100%;height:30px;">
                                {{-- <option value="all">All Company</option> --}}
                                @foreach ($companies as $comp)
                                    <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}}>{{ $comp->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </td>

                    <td style="border-style:none;padding:0px;">
                        <select class="kh16-b" name="seluser" id="seluser" style="height:30px;width:100%;">
                            {{-- <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option> --}}
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="border-style:none;padding:0px;">

                        <button id="btnshow" class="mybtn kh14-b" style="margin-left:20px;">បង្ហាញ</button>
                    </td>
                    <td style="border-style:none;padding:0px;">
                        <button id="btnprint" class="mybtn kh14-b" style="width:50px;">ព្រីន</button>
                    </td>
                    <td style="border-style:none;padding:0px;text-align:right;" class="kh14-b">
                        <button id="btnendbalance" class="mybtn kh14-b" style="color:rgb(6, 44, 148);">ដកចុងគ្រាសរុប</button>
                    </td>
                    <td style="border-style:none;padding:0px;">
                        <button id="btnprintend" class="mybtn kh14-b" style="">ព្រីនដកចុងគ្រា</button>
                    </td>
                    <td style="border-style:none;padding:0px;text-align:right;" class="kh14-b">
                        <button id="btndelendbalance" style="color:red;" class="mybtn kh14-b">លុបដកចុងគ្រាទាំងអស់</button>
                    </td>
                    <td style="border-style:none;padding:0px;text-align:right;" class="kh14-b">
                        <button id="btncontinue" class="mybtn kh14-b" style="color:blue;">បន្តថ្ងៃស្អែក</button>
                    </td>
                    <td style="border-style:none;padding:0px;text-align:right;" class="kh14-b">
                        <button id="btncontinueall" class="mybtn kh14-b" style="color:blue;">បន្តថ្ងៃស្អែកទាំងអស់</button>
                    </td>
                </tr>
            </table>
        </div>
   </div>
   <div class="row" style="margin-top:10px;">
    {{-- <div class="table-responsive"> --}}
        <form id="frmstockreport" action="">
            <div class="tableFixHead" id="userreport1" style="padding:0px;margin:0px;">
                <table id="tbl_userreport" class="table table-bordered table-striped table-hover tbl_userreport" style="table-layout:fixed;">
                    <thead class="kh14-b" style="text-align:center;">
                         <th style="width:60px;">លរ</th>
                         <th style="display:none;">លេខកូដ</th>
                         <th style="width:80px;">រូបិយប័ណ្ណ</th>
                         <th style="width:130px;">លុយដើមគ្រា</th>
                         <th style="width:130px;">ទិញចូល</th>
                         <th style="width:130px;">លក់ចេញ</th>
                         <th style="width:130px;">លុយដាក់ចូល</th>
                         <th style="width:130px;">លុយដកចេញ</th>
                         <th style="width:160px;">សមតុល្យ</th>
                         <th style="width:160px;">ដកចុងគ្រា</th>
                         <th style="width:150px;">លើសខ្វះ</th>
                         {{-- <th>ខ្វះគេ(+)</th>
                         <th>គេខ្វះ(-)</th> --}}
                         <th style="width:170px;" title="cashout + capitalend + feeout -(cashin + capital + feein)">ចំណេញខាត</th>

                    </thead>
                    <tbody id="tbody_user_report">

                    </tbody>
                </table>
            </div>

        </form>
    {{-- </div> --}}
</div>
@include('usercapitals.cashout_user_enddingbalance_modal')
@include('usercapitals.continue_all_modal')
@endsection
@section('script')

    <script type="text/javascript">
     $('#h1_title').text('បិទបញ្ជីបុគ្គលិក');
        function checkright()
        {
            var role=$('#txtrole').val();
            if(role!='Admin'){
                $('#stockdate').datetimepicker("destroy");

            }
        }
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-180;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
        $(window).resize(function() {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-180;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
        });
       $(document).ready(function () {

            var today=new Date();
            $('#stockdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            checkright();
            //Highlight clicked row
         $(document).on('click','.tbl_userreport td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var d=$('#stockdate').val();
                var userid=$('#seluser').val();
                // var ckcash = document.getElementById("ckcash").checked;
                // var ckbank = document.getElementById("ckbank").checked;
                let moneytype = document.querySelector('input[name="money_type"]:checked').value;

                var url="{{ route('usercapital.showcloselist') }}";
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {viewdate:d,userid:userid,moneytype:moneytype},
                    //contentType: 'text/plain',
                    //contentType: false,
                    //processData: true,
                    //cache: false,
                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                        $('#tbody_user_report').empty().html(data);
                        $('#btnsavecontinue').prop('disabled',false);
                        $('body').removeClass("wait");

                    },
                    error: function () {
                        alert('Read Data Error.')
                        $('body').removeClass("wait");
                    }
                })
            })
            $(document).on('click','#btnprint',function(e){
                e.preventDefault();
                var d=$('#stockdate').val();
                var username=$('#seluser option:selected').text();
                var userid=$('#seluser').val();
                // var htp=window.location.protocol;
                // var htn=window.location.hostname;
                var redirectWindow = window.open('{{ url('/') }}'+'/usercapital/printusercloselist?username='+username + '&userid=' + userid +'&date='+d, '_blank');
                redirectWindow.location;
            })
            $(document).on('click','#btnprintend',function(e){
                e.preventDefault();
                var d=$('#stockdate').val();
                var username=$('#seluser option:selected').text();
                var userid=$('#seluser').val();
                var htp=window.location.protocol;
                var htn=window.location.hostname;
                var redirectWindow = window.open('{{ url('/') }}'+'/usercapital/printuserendlist?username='+username + '&userid=' + userid +'&dd='+d, '_blank');
                redirectWindow.location;
            })
            $('.stock').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
            $(document).on('click','#btnendbalance',function(e){
                e.preventDefault();
                var data='';
                var n=0;
                var table = document.getElementById("tbl_userreport");
                var tbodyRowCount = table.tBodies[0].rows.length;
                if(tbodyRowCount==0){
                    alert('no data  endding balance');
                    return;
                }
                $('#enddingbalance_modal').modal('show');
                $('#modalheader').text('ដកចុងគ្រាសរុប');
                $('#rowmix').css('display','block');
                $('#btnsavecashdrawall').css('display','block');
                $('#btnsavecontinue').css('display','none');
                $('.tdcontinue').css('display','none');
                $('.tdcontinue1').css('display','none');
                $('.userbalance').each(function(i,e){

                    var row = $(this).closest('tr');
                    var rowind=$(this).closest('tr').index();
                    curid=row.find("td:eq(1) input").val();
                    cur_name=row.find("td:eq(2)").text();
                    amtstock=$(this).text();
                    shortcut=row.find("td:eq(2)").text();
                    n=n+1;
                    data +=`
                        <tr>
                            <td style="padding:0px;text-align:center;width:60px;">
                                <input type="text" style="border-style:none;width:80px;text-align:center;" class="form-control kh16-b" value="${n}" readonly>
                            </td>
                            <td style="padding:0px;">
                                <input type="text" style="border-style:none;width:100px;text-align:center;" name="curid[]" class="form-control kh16-b" value="${curid}" readonly>
                            </td>
                            <td style="padding:0px;">
                                <input type="text" style="border-style:none;width:120px;" name="curname[]" class="form-control kh16-b" value="${cur_name}" readonly>
                            </td>
                            <td style="padding:0px;">
                                <input type="text" style="border-style:none;text-align:right;" name="stock[]" class="form-control tdcanenter stock kh16-b" value="${amtstock}">
                            </td>
                            <td style="padding:0px;">
                                <input type="text" style="border-style:none;width:120px;" name="shortcut[]" class="form-control kh16-b" value="${shortcut}" readonly>
                            </td>
                        </tr>
                    `
				})

                $('#bodyendbalance').empty().html(data);
                $('.stock').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralPositiveOnly: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
                getenddingbalance();

            })
            $(document).on('click','#btncontinue',function(e){
                e.preventDefault();

                $('#enddingbalance_modal').modal('show');
                $('#modalheader').text('បន្តថ្ងៃស្អែក');
                $('#rowmix').css('display','none');
                $('#btnsavecashdrawall').css('display','none');
                $('#btnsavecontinue').css('display','block');
                $('.tdcontinue').css('display','block');
                $('.tdcontinue1').css('display','block');
                get_true_enddingbalance();

            })
             $(document).on('click','#btncontinueall',function(e){
                e.preventDefault();

                $('#continue_all_modal').modal('show');

                get_true_enddingbalanceall();

            })
            function get_true_enddingbalance()
            {

                var output='';
                var output1='';
                $('body').addClass("wait");
                var userid=$('#seluser').val();
                var showdate=$('#stockdate').val();

                var url="{{ route('usercapital.gettrueenddingbalance') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {showdate:showdate,userid:userid},
                    success: function (data) {
                        console.log(data)
                        if($.isEmptyObject(data.error)){


                            for(var i=0;i<data['cash'].length;i++){
                                output +=`
                                    <tr>
                                        <td style="border:1px solid green;padding:0px;display:none;">
                                            <input type="text" style="padding:5px;" class="kh16-b cid9" name="cid9[]" value="${data['cash'][i].agent_id??'0'}" readonly>
                                        </td>
                                        <td style="border:1px solid green;padding:0px">
                                            <input type="text" style="padding:5px;width:100%;" class="kh16-b cname9" name="cname9[]" value="${data['cash'][i].capital_type}" readonly>
                                        </td>
                                        <td style="width:200px;border:1px solid green;padding:0px">
                                            <input type="text" style="text-align:right;width:200px;padding:5px;" name="amount9[]" class="kh16-b amount9 ${data['cash'][i].amount>=0?'cblue':'cred'}" value="${formatNumber(data['cash'][i].amount)}" readonly>
                                        </td>

                                        <td style="width:50px;border:1px solid green;padding:0px">
                                            <input type="text" style="width:50px;padding:5px;" name="curname9[]" class="kh16-b curname9 ${data['cash'][i].amount>=0?'cblue':'cred'}" value="${data['cash'][i]['currency'].shortcut}" readonly>
                                        </td>
                                        <td style="border:1px solid green;padding:0px;display:none;">
                                            <input type="text" style="padding:5px;" class="kh16-b curid9" name="curid9[]" value="${data['cash'][i].currency_id}" readonly>
                                        </td>
                                    </tr>
                                `
                            }
                            $('#bodymymoney').empty().html(output);

                            for(var i=0;i<data['agent'].length;i++){
                                output1 +=`
                                     <tr>
                                        <td style="border:1px solid green;padding:0px;display:none;">
                                            <input type="text" style="padding:5px;" class="kh16-b cid9" name="cid9[]" value="${data['agent'][i].agent_id??'0'}" readonly>
                                        </td>
                                        <td style="border:1px solid green;padding:0px">
                                            <input type="text" style="padding:5px;width:100%;" class="kh16-b cname9" name="cname9[]" value="${data['agent'][i]['agentname'].name}" readonly>
                                        </td>
                                        <td style="width:200px;border:1px solid green;padding:0px">
                                            <input type="text" style="text-align:right;width:200px;padding:5px;" name="amount9[]" class="kh16-b amount9 ${data['agent'][i].amount>=0?'cblue':'cred'}" value="${formatNumber(data['agent'][i].amount)}" readonly>
                                        </td>

                                        <td style="width:50px;border:1px solid green;padding:0px">
                                            <input type="text" style="width:50px;padding:5px;" name="curname9[]" class="kh16-b curname9 ${data['agent'][i].amount>=0?'cblue':'cred'}" value="${data['agent'][i]['currency'].shortcut}" readonly>
                                        </td>
                                        <td style="border:1px solid green;padding:0px;display:none;">
                                            <input type="text" style="padding:5px;" class="kh16-b curid9" name="curid9[]" value="${data['agent'][i].currency_id}" readonly>
                                        </td>
                                    </tr>
                                `
                            }
                            $('#bodymymoney1').empty().html(output1);
                            $('.amount9').toArray().forEach(function(field){
                                new Cleave(field, {
                                    numeral: true,
                                    numeralPositiveOnly: true,
                                    numeralThousandsGroupStyle: 'thousand'
                                });
                            })
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
            $(document).on('change','#selectAllUsers', function () {
                const isChecked = $(this).is(':checked');
                $('input[name="selected_users[]"]').prop('checked', isChecked);
            });
            function get_true_enddingbalanceall()
            {


                $('body').addClass("wait");
                var userid=$('#seluser').val();
                var showdate=$('#stockdate').val();

                var url="{{ route('usercapital.gettrueenddingbalanceall') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {showdate:showdate,userid:userid},
                    success: function (data) {
                        console.log(data)
                        if($.isEmptyObject(data.error)){
                            let output = '';

                            // Build table header
                            let headerRow = `
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAllUsers" checked>
                                    </th>
                                    <th><label class="kh16-b" for="selectAllUsers"> ឈ្មោះបុគ្គលិក </label></th>
                            `;
                            for (let i = 0; i < data['currencies'].length; i++) {
                                headerRow += `<th style="text-align:center;">${data['currencies'][i]}</th>`;
                            }
                            headerRow += '</tr>';
                            $('#headermymoney').html(headerRow);

                            // Build table body
                            for (let i = 0; i < data['endbals'].length; i++) {
                                const user = data['endbals'][i];

                                output += `<tr>`;

                                // Checkbox cell
                                output += `
                                   <td>
                                        <input type="checkbox" class="row-check" name="selected_users[]" value="${user.user_id}" checked>
                                    </td>
                                `;

                                // User name cell
                                output += `
                                    <td>
                                        <input type="text" class="kh16-b" value="${user.user_name ?? ''}" readonly style="width:100%;">
                                    </td>
                                `;

                                // Currency amount cells
                                for (let j = 0; j < data['currencies'].length; j++) {
                                    const cur = data['currencies'][j];
                                    const value = user[cur] ?? 0;

                                    output += `
                                        <td>
                                            <input type="text" class="kh16-b" value="${formatNumber(value) + ' ' + cur}" readonly style="width:100%;text-align:right;">
                                        </td>
                                    `;
                                }

                                output += `</tr>`;
                            }

                            $('#bodycontinueall').empty().html(output); // assuming this is your <tbody>

                            $('.amount9').toArray().forEach(function(field){
                                new Cleave(field, {
                                    numeral: true,
                                    numeralPositiveOnly: true,
                                    numeralThousandsGroupStyle: 'thousand'
                                });
                            })
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
            function getenddingbalance()
            {

                var output='';
                var output1='';
                $('body').addClass("wait");
                var userid=$('#seluser').val();
                var cid=0;
                var showdate=$('#stockdate').val();
                var op='<=';
                var url="{{ route('usercapital.summaryuserpartnerlist') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {cid:cid,showdate:showdate,op:op,userid:userid,enddingbalance:1},
                    success: function (data) {
                        console.log(data)
                        if($.isEmptyObject(data.error)){
                            let j=0;
                            for(var i=0;i<data['newcash'].length;i++){
                                j=j+1;
                                output +=`
                                    <tr>
                                        <td style="text-align:center;font-size:16px;width:60px;">${j}</td>
                                        <td style="border:1px solid green;padding:0px;display:none;">
                                            <input type="text" style="padding:5px;" class="kh16-b cid7" name="cid7[]" value="${data['newcash'][i].customer_id}">
                                        </td>
                                        <td style="border:1px solid green;padding:0px">
                                            <input type="text" style="padding:5px;width:100%;" class="kh16-b cname7" name="cname7[]" value="${data['newcash'][i].customer}" readonly>
                                        </td>
                                        <td style="width:200px;border:1px solid green;padding:0px">
                                            <input type="text" style="text-align:right;width:200px;padding:5px;" name="amount7[]" class="kh16-b amount7 ${data['newcash'][i].amount>=0?'cblue':'cred'}" value="${formatNumber(data['newcash'][i].amount)}">
                                        </td>

                                        <td style="width:50px;border:1px solid green;padding:0px">
                                            <input type="text" style="width:50px;padding:5px;" name="curname7[]" class="kh16-b curname7 ${data['newcash'][i].amount>=0?'cblue':'cred'}" value="${data['newcash'][i].shortcut}" readonly>
                                        </td>
                                        <td style="border:1px solid green;padding:0px;display:none;">
                                            <input type="text" style="padding:5px;" class="kh16-b curid7" name="curid7[]" value="${data['newcash'][i].curid}">
                                        </td>
                                    </tr>
                                `
                            }
                            $('#bodymymoney').empty().html(output);

                            for(var i=0;i<data['newagent'].length;i++){
                                output1 +=`
                                    <tr>
                                        <td style="border:1px solid green;padding:0px;display:none;">
                                            <input type="text" style="padding:5px;" class="kh16-b cid7" name="cid7[]" value="${data['newagent'][i].customer_id}">
                                        </td>
                                        <td style="border:1px solid green;padding:0px">
                                            <input type="text" style="padding:5px;width:100%;" class="kh16-b cname7" name="cname7[]" value="${data['newagent'][i].customer}" readonly>
                                        </td>
                                        <td style="width:200px;border:1px solid green;padding:0px">
                                            <input type="text" style="text-align:right;width:200px;padding:5px;" name="amount7[]" class="kh16-b amount7 ${data['newagent'][i].amount>=0?'cblue':'cred'}" value="${formatNumber(data['newagent'][i].amount)}">
                                        </td>

                                        <td style="width:50px;border:1px solid green;padding:0px">
                                            <input type="text" style="width:50px;padding:5px;" name="curname7[]" class="kh16-b curname7 ${data['newagent'][i].amount>=0?'cblue':'cred'}" value="${data['newagent'][i].shortcut}" readonly>
                                        </td>
                                        <td style="border:1px solid green;padding:0px;display:none;">
                                            <input type="text" style="padding:5px;" class="kh16-b curid7" name="curid7[]" value="${data['newagent'][i].curid}">
                                        </td>
                                    </tr>
                                `
                            }
                            $('#bodymymoney1').empty().html(output1);
                            $('.amount7').toArray().forEach(function(field){
                                new Cleave(field, {
                                    numeral: true,
                                    numeralPositiveOnly: true,
                                    numeralThousandsGroupStyle: 'thousand'
                                });
                            })
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
            $(document).on('click','#btnsavecashdrawall',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var d=$('#stockdate').val();
                var formdata = new FormData(frmcashoutendbalance);
                var iscontinue = document.getElementById("ckcontinue").checked;
                formdata.append('iscontinue',iscontinue);
                formdata.append('usercontinue',$('#selusercontinue').val());
                formdata.append('trandate',d);
                formdata.append('useraffect',$('#seluser').val());
                var url="{{ route('usercapital.store_endbalance_all') }}";
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
                            //location.reload();
                            $('#enddingbalance_modal').modal('hide');
                            alert('all balance have been saved')
                            $('#btnshow').click();

                       }else{
                            alert(data.error)
                       }
                       $('body').removeClass("wait");
                    },
                    error: function () {
                        alert('Save Error')
                        $('body').removeClass("wait");
                    }

                })
            })
            $(document).on('click','#btndelendbalance',function(e){
                e.preventDefault();
                var d=$('#stockdate').val();
                var userid=$('#seluser').val();
                var formdata=new FormData();
                formdata.append('dd',d);
                formdata.append('userid',userid);
                var url="{{ route('usercapital.del_endbalance_all') }}";
                Swal.fire({
                    title: 'Are You Sure Delete User Endding Capital?',
                    text: "User Endding Capital Will Delete?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, continue it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $('body').addClass("wait");
                        $.ajax({
                            async: true,
                            type: 'POST',
                            dataType:'JSON',
                            processData: false,
                            contentType: false,
                            //contentType: 'application/json;charset=utf-8',
                            url: url,
                            data: formdata,
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {

                                    Swal.fire(
                                        'Delete!',
                                        data.message,
                                        'success'
                                    )
                                    $('#btnshow').click();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    )
                                }
                                $('body').removeClass("wait");
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    'Delete Error.',
                                    'Error'
                                )
                                $('body').removeClass("wait");
                            }

                        })

                    }
                })

                //end cinfirm



            })
            $(document).on('keydown', '.tdcanenter', function (e) {
                if (e.keyCode == 13) {
                    var $this = $(this),
			        index = $this.closest('td').index();
			        $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
			        e.preventDefault();
                    totalamount();

                }
            })
              $(document).on('click','#btnsavecontinueall,#btndeletecontinueall',function(e){
                e.preventDefault();
                //debugger;
                var id=$(this).attr('id');
                var isdel=0;
                var Succtext='Continue!';
                var Errtext='Continue Error!';
                if(id=='btndeletecontinueall'){
                    isdel=1;
                    Succtext='Delete!';
                    Errtext='Delete Error!';
                }
                var today = new Date();
                var today1=moment(today).format("YYYY-MM-DD");

                var d=$('#stockdate').val();
                var nextdate = moment(d, "DD-MM-YYYY").add(1, 'days');
                var tomorrow=nextdate.format("YYYY-MM-DD");
                var iscontinue = document.getElementById("ckcontinue").checked;

                // if(tomorrow<=today1){
                //     alert('Save Continue Capital Date Time Error')
                //     return;
                // }
                var userid=$('#seluser').val();
                var formdata=new FormData(frmcontinuealluser);
                formdata.append('dd',d);
                formdata.append('userid',userid);
                formdata.append('tomorrow',tomorrow);
                formdata.append('isdel',isdel);
                var url="{{ route('usercapital.capitalcontinueall') }}";


                //confirm to continue tommorow
                Swal.fire({
                    title: isdel==0?'Are You Sure Continue User Capital?':'Are You Sure Delete User Tomorrow Capital?',
                    text: isdel==0?"User Capital Will Create Automatic For Tomorrow?":"User Capital Will Delete Automatic For Tomorrow?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText:isdel==0?'Yes, continue it!':'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $('body').addClass("wait");
                        $.ajax({
                            async: true,
                            type: 'POST',
                            dataType:'JSON',
                            processData: false,
                            contentType: false,
                            //contentType: 'application/json;charset=utf-8',
                            url: url,
                            data: formdata,
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    $('#continue_all_modal').modal('hide');
                                    Swal.fire(
                                        Succtext,
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
                                $('body').removeClass("wait");
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    Errtext,
                                    'Error'
                                )
                                $('body').removeClass("wait");
                            }

                        })

                    }
                })

                //end cinfirm
            })
            $(document).on('click','#btnsavecontinue',function(e){
                e.preventDefault();
                //debugger;
                var today = new Date();
                var today1=moment(today).format("YYYY-MM-DD");

                var d=$('#stockdate').val();
                var nextdate = moment(d, "DD-MM-YYYY").add(1, 'days');
                var tomorrow=nextdate.format("YYYY-MM-DD");
                var iscontinue = document.getElementById("ckcontinue").checked;

                // if(tomorrow<=today1){
                //     alert('Save Continue Capital Date Time Error')
                //     return;
                // }
                var userid=$('#seluser').val();
                //var formdata=new FormData(frmstockreport);
                var formdata=new FormData();
                formdata.append('dd',d);
                formdata.append('userid',userid);
                formdata.append('tomorrow',tomorrow);
                formdata.append('iscontinue',iscontinue);
                formdata.append('fromuser',$('#seluser').val());
                formdata.append('usercontinue',$('#selusercontinue').val());
                var url="{{ route('usercapital.capitalcontinue') }}";
                // $.ajax({
                //     async: false,
                //     type: 'POST',
                //     contentType: false,
                //     processData: false,
                //     url: url,
                //     data: formdata,
                //     success: function (data) {
                //        console.log(data)
                //        if($.isEmptyObject(data.error)){
                //            alert(data.message)
                //        }else{
                //             alert(data.error)
                //        }
                //     },
                //     error: function () {
                //         alert('Save Error')

                //     }

                // })

                //confirm to continue tommorow
                Swal.fire({
                    title: 'Are You Sure Continue User Capital?',
                    text: "User Capital Will Create Automatic For Tomorrow?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, continue it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $('body').addClass("wait");
                        $.ajax({
                            async: true,
                            type: 'POST',
                            dataType:'JSON',
                            processData: false,
                            contentType: false,
                            //contentType: 'application/json;charset=utf-8',
                            url: url,
                            data: formdata,
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {

                                    Swal.fire(
                                        'Continue!',
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
                                $('body').removeClass("wait");
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    'Continue Error.',
                                    'Error'
                                )
                                $('body').removeClass("wait");
                            }

                        })

                    }
                })

                //end cinfirm
            })
            $(document).on('change','#stockdate',function(e){
                e.preventDefault();
                $('#btnsavestock').prop('disabled',true);
            })
            $(document).on('change','#selcompany',function(e){
                e.preventDefault();
                getuserbycompany('#seluser');
            })
            function getuserbycompany(el)
            {
                $(el).empty();
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
                        $.each(data['users'],function(i,item){
                            $(el).append($("<option/>",{
                                    value:item.id,
                                    text:item.name,
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
        })
    </script>
@endsection
