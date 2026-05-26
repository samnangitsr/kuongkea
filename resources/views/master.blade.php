<!doctype html>
<html lang="en">
    <head>
        @include('includes.head')
        @yield('css')
        <style>
            @media screen and (max-width: 600px) {
                .switcher-wrapper {
                    width: 390px;
                    right: -390px;
                }
            }
             #tbl_useraccount_master td,#tbl_useraccount_master th {
                white-space: normal;
                word-wrap: break-word;   /* For older browsers */
                word-break: break-word;  /* For modern browsers */
            }
             #tbl_useraccount_master .clickedrow td{
                background-color:lightgray;
            }

            .mybutton:hover{
                background-color:aqua;
            }
            .cred{
                color:red;
            }
            .cblue{
                color:blue;
            }
            .btnrefreshcapitalmaster:hover{
                background-color:aqua !important;
                border:1px solid blue;
            }
           .clickth{
            background-color:aqua;
           }
           #tbl_showusercashmster th:hover{
                background-color:aquamarine !important;
           }
            .responsive-text {
                font-size: clamp(12px, 2vw, 30px);
            }
            .responsive-text_big {
                font-size: clamp(16px, 4vw, 30px);
            }
            .btn-3d {
            background: #3498db;
            color: white;
            margin:0px 2px;
            padding: 2px 10px;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 0 #011d30;
            cursor: pointer;
            transition: all 0.1s ease-in-out;
            font-weight: bold;
            }
        .btn-3d-primary{
            background: #344ddd;
            color: white;
        }
        .btn-3d-danger{
             background: #f3260b;
             color: white;
        }
         .btn-3d-warning{
             background: #c9a506;
             color: white;
        }

        .btn-3d:active {
            transform: translateY(4px);
            box-shadow: 0 1px 0 #2980b9;
            }
        .btn-3d:hover{
            background-color:green !important;
            color:white !important;
        }
        .input-3d {
            margin:0px 2px;
            padding: 0px 2px;
            border-radius: 6px;
            background: white;

            font-size: 16px;

            outline: none;
            border:1px solid black;
            box-shadow: 0 5px 0 #011d30;
            cursor: pointer;
            transition: all 0.1s ease-in-out;

            }

        .input-3d:focus {
            box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.15),
                        inset -2px -2px 4px rgba(255, 255, 255, 0.7);
            background: #e4f311 !important;
            }
        </style>
    </head>
<body>
	<!--wrapper-->
	<div class="wrapper">
        @if (Auth::user()->role->name<>'Admin')
		    @include('includes.sidebar')
        @else
            @include('includes.sidebar_admin')
        @endif
		@include('includes.header')

		<div class="page-wrapper">
			<div class="page-content" style="margin-bottom:0px;padding-bottom:0px;">
                @yield('content')
            </div>
        </div>
		<footer class="page-footer" style="height:45px;padding:0px;margin:0px;">
            <div class="table-responsive" id="div_tbl_mycapital">

            </div>
		</footer>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">

            <div class="row">
                <div class="row" style="padding:0px;margin:0px;">
                    <table class="" style="padding:0px;margin-top:-15px;margin-bottom:10px;">
                        <tr>
                            <td style="width:160px;">
                                <div class="input-group" style="width:160px;">
                                    <input type="text" name="showdate_master" id="showdate_master" class="form-control" style="width:110px;height:30px;background-color:silver;font-size:16px;font-weight:bold;">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </td>
                            <td style="">
                                <select class="kh16-b" name="selusermaster" id="selusermaster" style="width:100%;height:30px;background-color:aquamarine">

                                </select>
                            </td>
                            <td style="">
                                <button class="mybutton" id="btnrefreshinmaster" style="border:1px solid black;float:right;height:30px;">Refresh</button>
                            </td>
                        </tr>
                    </table>
                    {{-- <div id="divuser" class="col-lg-9" style="padding:0px;margin:-10px 0px 5px 0px;">
                        <select class="kh16-b" name="selusermaster" id="selusermaster" style="width:100%;height:30px;margin-top:-10px;background-color:aquamarine">

                        </select>
                    </div>
                    <div class="col-lg-3" style="padding:0px;margin:0px;">
                        <button class="mybutton" id="btnrefresh" style="margin:-15px 0px 5px 0px;border:1px solid black;float:right;height:30px;padding:0px 5px;">Refresh</button>
                    </div> --}}
                </div>
                <div class="row" style="padding:0px;margin:0px;">
                    <div class="table-responsive" style="padding:0px;margin:0px;">
                        <table id="tbl_useraccount_master" class="table table-bordered table-hover" style="width:100%;overflow:auto;">
                            <tbody id="useraccount_master">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="displayratebar" style="margin-top:-10px;">

            </div>
		</div>
	</div>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{ config('helper.asset_path') }}/admin/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ config('helper.asset_path') }}/admin/assets/js/jquery.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/select2/js/select2.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ config('helper.asset_path') }}/admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/chartjs/js/Chart.extension.js"></script>
	{{-- <script src="{{ asset('public/admin') }}/assets/js/index.js"></script> --}}

	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/legacy.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/picker.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/picker.time.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/picker.date.js"></script>
	 <script src="{{ config('helper.asset_path') }}/admin/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>

	<script src="{{ config('helper.asset_path') }}/js/jquery.datetimepicker.full.js"></script>
	<script src="{{ config('helper.asset_path') }}/js/moment.js"></script>

	<script src="{{ config('helper.asset_path') }}/js/cleave.js"></script>
	<script src="{{ config('helper.asset_path') }}/js/cleave-phone.i18n.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!--app JS-->
	<script src="{{ config('helper.asset_path') }}/admin/assets/js/app.js"></script>
	{{-- toar --}}
	<script src="{{ config('helper.asset_path') }}/js/toastr.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.ably.io/lib/ably.min-1.js"></script>
  @include('includes.mainscript')
    @yield('script')
    <script>
        const tabId = Date.now() + "_" + Math.random(); // unique id for this tab
        const STORAGE_KEY = "active_tabs";
        function updateTabs(add = true) {
            //debugger;
            let tabs = JSON.parse(localStorage.getItem(STORAGE_KEY) || "[]");
            if (add) {
                // Add current tab if not exists
                if (!tabs.includes(tabId)) {
                    tabs.push(tabId);
                }
            } else {
                // Remove current tab
                tabs = tabs.filter(t => t !== tabId);
            }

            localStorage.setItem(STORAGE_KEY, JSON.stringify(tabs));
            return tabs;
        }

        // Register this tab
        updateTabs(true);
        window.addEventListener("beforeunload", function() {
        try {
            updateTabs(false);
            let tabs = JSON.parse(localStorage.getItem(STORAGE_KEY) || "[]");
            let tablength=tabs.length;
            let url=window.location.pathname;
            fetch("{{ route('user.offline') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        url: url,
                        tabcount: tablength
                    })
                });

        } catch (e) {
            // ignore errors
        }
    });

        document.addEventListener("click", function(e) {
            //debugger;
            //let link = e.target.closest("a");
             let link = e.target.closest("a[href]"); // only <a> with href
            if (link && link.href && link.getAttribute("href") !== "javascript:;") {
                // Get pathname without domain
                let path = new URL(link.href).pathname;  // e.g. "/moneyexchange/exchange/index"

                // Remove first segment "moneyexchange"
                let parts = path.split("/");
                if (parts.length > 2) {
                    path = "/" + parts.slice(2).join("/"); // -> "/exchange/index"
                }
                localStorage.setItem("user_url", path);

            }
        });



        $(document).ready(function(){
            $.ajaxSetup({
                async:false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            var today=new Date();
            $('#h1_date').text(moment(today).format("DD-MM-YYYY"));
            $('#showdate_master').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });

            var ably = new Ably.Realtime('DF1ung.N3Jwqw:30ezVuIjqesSJZRbGMoD8NsqtIij6_uqR6soVWetP0Q'); //remember to pass your ably API key
            var channel = ably.channels.get('chatting'); // here i create a channel or initialize the existing channel
            channel.subscribe('messageEvent', function(message) { // message this is message from channel
                // Handle incoming messages (create a message body div tag)
                console.log(message)
                const currentUser = "{{ Auth::user()->name }}"; // Server renders this per user
                const domainnameis="{{ config('helper.transfer_option') }}";
                if(message.data.customername==domainnameis){
                    @if(config('helper.transfer_option') !== '52')
                        getdisplayrate();
                    @endif
                    savecurrencytostorage();
                    savecurrencyproducttostorage();
                }
            });

            @if(isset($startwork))
                var startwork = {!! json_encode($startwork) !!};
            @else
                var startwork = 0; // Default to 0 if not set
            @endif
            if (startwork==1) {
                savecurrencytostorage();
                savecurrencyproducttostorage();
                savephonetolocalstorage();
                //getuseraccountname();
                @if(config('helper.show_user_capital_master') == 1)
                    //getusercapital_master($('#loginid').val(),today);
                    getusermaster();
                    getuseraccount_master(0,1,$('#loginid').val());
                    getdisplayrate();
                @endif
                saveuserpermittolocalstorage(checkpermit);
            }else{
                @if(config('helper.show_user_capital_master') == 1)
                    getusermaster();
                    getuseraccount_master(0,1,$('#loginid').val());
                @endif
                @if(Auth::user()->role->name<>'Admin')
                    checkpermit();
                @endif
            }

            $(document).on('change','#cashtypemaster',function(e){
              e.preventDefault();
              getuseraccountname();
            })
            function getusermaster(){
                $('#selusermaster').empty();
                var url="{{ route('getallusermaster') }}";
                $.get(url,{},function(data){
                    $('#selusermaster').append($("<option/>",{
                                    value:'',
                                    text:''
                                }))
                        $.each(data['users'],function(i,item){

                            $('#selusermaster').append($("<option/>",{
                                value:item.id,
                                text:item.name,
                                selected:item.id==$('#loginid').val()?true:false
                            }))
                        });
                })
            }
            function getuseraccountname(){
                $('#useraccountmaster').empty();
                var cashtype=$('#cashtypemaster').val();
                if(cashtype=='agent'){
                    var useragent=$('#loginid').val();
                    var url="{{ route('getagentuser') }}";
                    $.get(url,{useragent:useragent},function(data){
                        //console.log(data);
                        $('#useraccountmaster').append($("<option/>",{
                                    value:'',
                                    text:''
                                }))
                        $.each(data['agentuser1'],function(i,item){
                            $('#useraccountmaster').append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))
                        });
                        $.each(data['agentuser2'],function(i,item){
                            $('#useraccountmaster').append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))
                        });
                        $.each(data['agentuser3'],function(i,item){
                            $('#useraccountmaster').append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))
                        });
                        $.each(data['agentuser4'],function(i,item){
                            $('#useraccountmaster').append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))
                        });
                    })
                }else if(cashtype=='cash'){

                    $('#usd_amount_master').val('');
                    $('#khr_amount_master').val('');
                    $('#thb_amount_master').val('');
                    var dd=new Date();
                    var viewdate=moment(dd).format("DD-MM-YYYY")
                    var userid=$('#loginid').val();
                    var url="{{ route('usercapital.getusercapitalmaster') }}";
                    $.get(url,{userid:userid,showdate:viewdate,isrightsidebarview:1},function(data){
                        //console.log(data)
                        for(var i=0;i<data['sumusercash'].length;i++){
                            if(data['sumusercash'][i].cur=='USD'){
                                $('#usd_amount_master').val(formatNumber(data['sumusercash'][i].tamt));
                            }else if(data['sumusercash'][i].cur=='KHR'){
                                $('#khr_amount_master').val(formatNumber(data['sumusercash'][i].tamt));
                            }else if(data['sumusercash'][i].cur=='THB'){
                                $('#thb_amount_master').val(formatNumber(data['sumusercash'][i].tamt));
                            }
                        }
                    })
                }
            }
            function getdisplayrate(){
                var url="{{ route('currency.ratedisplayrightsidebar1') }}";
                $.get(url,{},function(data){
                    $('#displayratebar').empty().html(data);
                    $('.buy').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralDecimalScale: 6,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
                    $('.sale').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralDecimalScale: 6,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
                    $('.buy1_1').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralDecimalScale: 6,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
                    $('.sale1_1').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralDecimalScale: 6,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
                })
            }
            $(document).on('click','#btnsetrate0',function(e){
                e.preventDefault();
                setrate(setthairate,sendMessage);

            })
            function setrate(callback1,callback2){
                $('body').addClass("wait");
                var formdata = new FormData(frmsetrate_sidebar);
                var url="{{ route('currency.setrate') }}";
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
                            callback1();
                            callback2();
                            $('body').removeClass("wait");
                                //alert(data.message);
                                //location.reload();
                        }else{
                                alert(data.error)
                        }

                        },
                        error: function () {
                            alert('Save Error')

                        }

                    })
            }
        async function setthairate(){
            $('body').addClass("wait");
            var formdata = new FormData(frmsetratethai_sidebar);
            formdata.append('exchangetype','THAI');
            var url="{{ route('currency.setratethai') }}";
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
                        $('body').removeClass("wait");
                        //callback();
                        alert(data.message);
                        //location.reload();
                       }else{
                            alert(data.error)
                       }


                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
        }
       async function sendMessage() {
            //var ably = new Ably.Realtime('oM-FXA.0iCetQ:XLfafSYaOaTfVjkISU703q3TDqU52ZjdZyxl_Xzf-LA'); //remember to pass your ably API key
            //var channel = ably.channels.get('chatting'); // here i create a channel or initialize the existing channel
            var message ='refresh rate'; //get the message from input
            var name = 'exchange'; //get the sender name from input
            var sender = "{{ Auth::user()->name }}";
            var customername="{{ config('helper.transfer_option') }}";
            if (message !== '') { //if input message is not empty publish a message
                // Publish the message to the chat channel
                channel.publish('messageEvent', { name: name, text: message, sender: sender,customername:customername });
            }
        }
        async function setbankrate(){
            $('body').addClass("wait");
            var formdata = new FormData(frmsetratebank);
            formdata.append('exchangetype','BANK');
            var url="{{ route('currency.setratethai') }}";
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
                        $('body').removeClass("wait");
                        alert(data.message);
                        location.reload();

                       }else{
                            alert(data.error)
                       }


                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
        }

        $(document).on('keyup','.buy,.sale',function(e){
            e.preventDefault();
            //debugger;
            var rowind = $(this).closest('tr').index();
        	//var rowind=row.find("td:eq(0)").text();
            var operator=$('.optsign').eq(rowind).val();
            var ratio=$('.ratio').eq(rowind).val().replace(/,/g,'');
            var buy=$('.buy').eq(rowind).val().replace(/,/g,'');
            var sale=$('.sale').eq(rowind).val().replace(/,/g,'');
            var ratebuy=0;
            var ratesale=0;
            //var shortcut=$('.shortcut0').eq(rowind-1).val();
            // if(shortcut=='KHR'){
            //     autoratethai();
            // }
            ratebuy=buy/ratio;
            ratesale=sale/ratio;
            var khrbuy=0;
            var khrsale=0;
            var thbbuy=0;
            var thbsale=0;
            var vndbuy=0;
            var vndsale=0;
            $('.ratebuy').eq(rowind).val(ratebuy);
            $('.ratesale').eq(rowind).val(ratesale);
            // if(shortcut=='KHR' || shortcut=='THB' || shortcut=='VND'){
            //     $('.curid0').each(function(i,e){

            //         if($('.shortcut0').eq(i).val()=='KHR'){
            //             khrbuy=$('.buy0').eq(i).val().replace(/,/g,'');
            //             khrsale=$('.sale0').eq(i).val().replace(/,/g,'');
            //         }
            //         if($('.shortcut0').eq(i).val()=='THB'){
            //             thbbuy=$('.buy0').eq(i).val().replace(/,/g,'');
            //             thbsale=$('.sale0').eq(i).val().replace(/,/g,'');
            //         }
            //         if($('.shortcut0').eq(i).val()=='VND'){
            //             vndbuy=$('.buy0').eq(i).val().replace(/,/g,'');
            //             vndsale=$('.sale0').eq(i).val().replace(/,/g,'');
            //         }

            //         if($('.shortcut0').eq(i).val()=='KHR-THB' || $('.shortcut0').eq(i).val()=='THB-KHR'){

            //             $('.buy0').eq(i).val(formatNumber((khrbuy/thbsale).toFixed(2)));
            //             $('.sale0').eq(i).val(formatNumber((khrsale/thbbuy).toFixed(2)));
            //             $('.ratebuy0').eq(i).val(formatNumber((khrbuy/thbsale).toFixed(2)));
            //             $('.ratesale0').eq(i).val(formatNumber((khrsale/thbbuy).toFixed(2)));
            //         }

            //         if($('.shortcut0').eq(i).val()=='VND-KHR' || $('.shortcut0').eq(i).val()=='KHR-VND'){

            //             var decbuy=$('.buy0').eq(i).attr('title');
            //             var decsale=$('.sale0').eq(i).attr('title');
            //             $('.buy0').eq(i).val((khrbuy/vndsale).toFixed(decbuy));
            //             $('.sale0').eq(i).val((khrsale/vndbuy).toFixed(decsale));
            //             $('.ratesale0').eq(i).val((khrsale/vndbuy).toFixed(decsale));
            //             $('.ratebuy0').eq(i).val((khrbuy/vndsale).toFixed(decbuy));
            //         }

            //     })
            // }

        })
        // $(document).on('keyup','.buy1,.sale1',function(e){
        //     e.preventDefault();
        //     autoratethai();
        // })
        function autoratethai()
        {
            var khrbuy=0;
            var khrsale=0;
            var usdbuy=0;
            var usdsale=0;
                $('.curid').each(function(i,e){
                    if($('.shortcut').eq(i).val()=='KHR'){
                        khrbuy=$('.buy').eq(i).val().replace(/,/g,'');
                        khrsale=$('.sale').eq(i).val().replace(/,/g,'');
                    }
                })
                $('.curid1').each(function(i,e){
                    if($('.curname').eq(i).val()=='USD'){
                        usdbuy=$('.buy1').eq(i).val().replace(/,/g,'');
                        usdsale=$('.sale1').eq(i).val().replace(/,/g,'');
                    }
                    if($('.curname').eq(i).val()=='KHR'){

                        $('.buy1').eq(i).val(formatNumber((khrbuy/usdsale).toFixed(2)));
                        $('.sale1').eq(i).val(formatNumber((khrsale/usdbuy).toFixed(2)));

                    }
                })
        }



            $(document).on('change','#useraccountmaster',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var cid=$(this).val();
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
                            $('#usd_amount_master').val(formatNumber(Math.abs(data.usd)));
                            $('#thb_amount_master').val(formatNumber(Math.abs(data.thb)));
                            $('#khr_amount_master').val(formatNumber(Math.abs(data.khr)));

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
            $(document).on('click','#tbl_useraccount_master td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
         $(document).on('click','#tbl_showusercashmster th',function(e){
            $(this).closest('table').find('th').removeClass("clickth");
            $(this).toggleClass("clickth");
         })
         $(document).on('click','.btnrefreshcapitalmaster',function(e){
            e.preventDefault();
            getuseraccount_master(1,1,$('#loginid').val());
         })
            $(document).on('click','#btnrefreshinmaster',function(e){
                e.preventDefault();
                getuseraccount_master(0,0,$('#selusermaster').val());
                getdisplayrate();
                //getusercapital_master($('#loginid').val(),today);
                savecurrencytostorage();
                savecurrencyproducttostorage();
                savephonetolocalstorage();
            })
            $(document).on('change','#selusermaster',function(e){
                e.preventDefault();
                if($(this).val()!==''){
                    getuseraccount_master(0,0,$('#selusermaster').val());
                }

            })

        })

        function bongkot(amount,cur)
      {
        var amt=0;
        if(cur=='R'){
            amt = Math.round(amount / 100) * 100;
        }else if(cur=='B'){
            amt = Math.round(amount);
        }else{
            amt=amount;
        }

        return formatNumber(amt);

      }

        function getuseraccount_master(dontshowthaiaccount,refreshmycash,userid)
        {

            var output='';
            var showcash=' <table id="tbl_showusercashmster" class="" style="padding:0px;margin:0px;"><tr>';
            $('body').addClass("wait");
            //var userid=$('#selusermaster').val();
            var cid=0;
            var showdate=$('#showdate_master').val();
            var op='<=';
            var url="{{ route('usercapital.summaryuserpartnerlist') }}";
            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {cid:cid,showdate:showdate,op:op,userid:userid,enddingbalance:dontshowthaiaccount},
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        // show all cash currency
                        if(refreshmycash==1){
                            var n=data['newcash'].length;

                            for(var i=0;i<data['newcash'].length;i++){
                                if(i==0){
                                    showcash +=`
                                    <th style="font-weight:bold;padding:0px;border:1px solid green;"><button class="btnrefreshcapitalmaster" style="border:none;">${data['newcash'][i].customer}</button></th>`
                                }
                                showcash +=`
                                <th style="font-weight:bold;padding:2px 5px;text-align:right;border:1px solid green;" class="${data['newcash'][i].amount>=0?'cblue':'cred'}">${bongkot(data['newcash'][i].amount,data['newcash'][i].shortcut)}${data['newcash'][i].cursk}</th>`
                                if(i==n-1){
                                    showcash +=`<th>&nbsp;&nbsp;</th>`
                                }
                            }
                        }
                        for(var i=0;i<data['useraccount'].length;i++){
                            output +=`
                                <tr>
                                    <td style="padding:2px;border:1px solid green;">${data['useraccount'][i].customer}</td>
                                    <td style="font-weight:bold;padding:2px;text-align:right;border:1px solid green;" class="${data['useraccount'][i].usd>=0?'cblue':'cred'}">${bongkot(data['useraccount'][i].usd,'$')}$</td>
                                    <td style="font-weight:bold;padding:2px;text-align:right;border:1px solid green;" class="${data['useraccount'][i].thb>=0?'cblue':'cred'}">${bongkot(data['useraccount'][i].thb,'B')}B</td>
                                    <td style="font-weight:bold;padding:2px;text-align:right;border:1px solid green;" class="${data['useraccount'][i].khr>=0?'cblue':'cred'}">${bongkot(data['useraccount'][i].khr,'R')}R</td>
                                </tr>
                            `
                            // if(refreshmycash==1){
                            //     if(data['useraccount'][i].display==1){
                            //         showcash +=`
                            //             <th style="font-weight:bold;padding:0px;border:1px solid green;"><button class="btnrefreshcapitalmaster" style="border:none;">${data['useraccount'][i].customer}</button></th>
                            //             <th style="font-weight:bold;padding:2px;text-align:right;border:1px solid green;" class="${data['useraccount'][i].usd>=0?'cblue':'cred'}">${bongkot(data['useraccount'][i].usd,'$')}$</th>
                            //             <th style="font-weight:bold;padding:2px;text-align:right;border:1px solid green;" class="${data['useraccount'][i].thb>=0?'cblue':'cred'}">${bongkot(data['useraccount'][i].thb,'B')}B</th>
                            //             <th style="font-weight:bold;padding:2px;text-align:right;border:1px solid green;" class="${data['useraccount'][i].khr>=0?'cblue':'cred'}">${bongkot(data['useraccount'][i].khr,'R')}R</th>
                            //             <th>&nbsp;&nbsp;</th>
                            //         `
                            //     }
                            // }

                             if(refreshmycash==1){
                                 if(data['useraccount'][i].display==1){
                                    if(data['useraccount'][i].customer!=='CASH'){
                                        showcash +=`
                                            <th style="font-weight:bold;padding:0px;border:1px solid green;"><button class="btnrefreshcapitalmaster" style="border:none;">${data['useraccount'][i].customer}</button></th>
                                            <th style="font-weight:bold;padding:2px 5px;text-align:right;border:1px solid green;" class="${data['useraccount'][i].usd>=0?'cblue':'cred'}">${bongkot(data['useraccount'][i].usd,'$')}$</th>
                                            <th style="font-weight:bold;padding:2px 5px;text-align:right;border:1px solid green;" class="${data['useraccount'][i].thb>=0?'cblue':'cred'}">${bongkot(data['useraccount'][i].thb,'B')}B</th>
                                            <th style="font-weight:bold;padding:2px 5px;text-align:right;border:1px solid green;" class="${data['useraccount'][i].khr>=0?'cblue':'cred'}">${bongkot(data['useraccount'][i].khr,'R')}R</th>
                                            <th>&nbsp;&nbsp;</th>
                                        `
                                    }
                                 }
                             }
                        }


                        if(refreshmycash==1){
                            $('#div_tbl_mycapital').empty().html(showcash + '</tr></table>');
                        }
                        $('#useraccount_master').empty().html(output);
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
		function formatNumber(n,d=2) {
            var num=n;
			if(num=='' || isNaN(num)){
				return 0;
			}else{
                num=parseFloat(n).toFixed(d);
            }

			num=parseFloat(num);
			var k=String(num).split('.');
			if(k.length==2){
				var fnum=k[0].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
				var snum=k[1];
				return fnum + '.' + snum;
				//return num.toFixed(2);
			}else{
				return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
			}
		}
    </script>
</body>

</html>
