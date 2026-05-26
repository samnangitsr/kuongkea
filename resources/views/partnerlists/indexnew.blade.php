<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>សៀវភៅបញ្ជីថ្មី</title>
    <link rel="icon" href="{{ config('helper.asset_path') }}/admin/assets/images/usdkhr.jpg" type="image/jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ config('helper.asset_path') }}/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
    <link href="{{ config('helper.asset_path') }}/css/jquery.datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ config('helper.asset_path') }}/admin/assets/js/jquery.min.js"></script>
    <script src="{{ config('helper.asset_path') }}/admin/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/legacy.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/picker.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/picker.time.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/picker.date.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/js/jquery.datetimepicker.full.js"></script>
	<script src="{{ config('helper.asset_path') }}/js/moment.js"></script>
</head>
<style type="text/css">
     body.wait *{
			cursor: wait !important;
		}

    thead{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        padding:0px;
        color:black;
    }
    tbody{
        font-family:arial;
        font-size:10px;
        padding:0px;
    }
    .logo{
        font-family:khmer os muol light;
        font-size:22px;
        margin-top:5px;
        color:black;
    }
    .info{
        font-family:khmer os muol light;
        font-size:16px;
        color:black;
    }
    #top p{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        margin-left:0px;
        padding:0px;
        color:black;
    }
    .receipt_info{
        border-style:none;
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        color:black;
        padding:0px;
        margin-left:0px;
    }
    .service{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        color:black;
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
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            }
         .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;

            }
        .kh12{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            }
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            }
        .kh10-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:10px;
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
        .kh30{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
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

        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        td{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            padding:0px;
        }
        .amt{
            text-align:right;
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
        }
        .total{
            text-align:right;
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
            font-weight:bold;
        }
        #tbl_partner_list td{
          padding:2px;
        }
        #tbl_partner_list th{
          padding:2px;
        }
        .cblue{
          color:blue;
        }
        .cred{
          color:red;
        }
        #tbl_before td{
            padding:2px;
        }
         #tbl_after td{
            padding:2px;
        }
        #tblmain td{
            padding:0px;
            border-style:none;
        }
        .buttonstyle:hover{
            background-color:aqua !important;
        }
        .buttonstyle{
            border:1px solid gray;
        }
        td.mainrow:hover{
            background-color:rgb(238, 255, 0);

        }
        .cblue{
            color:blue;
        }
        .cred{
            color:red;
        }
        #tbl_partner_list .clickedrow td{
            background-color:lightblue;
        }
        #tbl_before .clickedrow td{
            background-color:lightblue;
        }
        #tbl_after .clickedrow td{
            background-color:lightblue;
        }
         #tbl_delcloselist1 .clickedrow td{
            background-color:rgb(21, 25, 235);
            color:white;
        }
        .tableFixHead{ overflow: auto;border:1px solid blue;}
        .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:rgb(225, 236, 236) }
        .select2-container--default .select2-results>.select2-results__options{max-height: 350px !important;}
        .select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:40px;}
        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;height:36px;background-color:white;}
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
        #selcustomer1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;height:30px;background-color:white;}
		/* Each result */
	    #select2-selcustomer1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
         #selcustomer2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;height:30px;background-color:white;}
		/* Each result */
	    #select2-selcustomer2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
       #div1, #divdisplay {
        transition: all 0.3s ease;
        }
</style>
@php

    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
            $fp=substr($num,$p,strlen($num)-$p);
            $dc=strlen((float)$fp)-2;
            if($dc>2) $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
    $tusd=0;
    $tkhr=0;
    $tthb=0;
    $tvnd=0;
@endphp
<body>
    <button id="btnback"
        class="buttonstyle kh12-b"
        style="position: fixed; top: 5px; left: 3px; z-index: 1050;
               display: none; background-color: aquamarine;
               padding: 4px; font-size: 12px; line-height: 1;">
  ⇒
</button>

    <div class="row" style="margin:5px;">
        <div id="div1" class="col-lg-4">
            <table id="tblmain" class="table">
                <tr>
                    <td class="kh16-b" style="width:50%;">គិតពី
                        <label class="form-check-label kh16-b">
                            <input class="form-check-input kh16-b" type="checkbox" name="ckalldate" id="ckalldate" style="display:inline;"> ALL Date
                        </label>
                    </td>
                    <td class="kh16-b" style="width:50%;">រហូតដល់
                        <label class="form-check-label kh16-b">
                            <input class="form-check-input kh16-b" type="checkbox" name="ckoldlist" id="ckoldlist" checked> Old List
                          </label>
                          <button id="btnmoveleft" class="buttonstyle kh12-b" style="float:right;background-color:aquamarine;padding:4px; font-size: 12px; line-height: 1;">⇦</button>

                    </td>

                </tr>
                <tr>
                    <td class="kh16-b" style="width:50%;">
                        <div class="input-group" style="">
                            <input type="text" name="d1" id="d1" class="form-control kh16-b" style="width:120px;background-color:silver;padding:0px 5px 0px 5px;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                    </td>
                    <td class="kh16-b" style="width:50%;">
                        <div class="input-group" style="">
                            <input type="text" name="d2" id="d2" class="form-control kh16-b" style="width:120px;background-color:silver;padding:0px 5px 0px 5px;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="kh16-b" style="width:50%;">ប្រភេទដៃគូ

                    </td>
                    <td class="kh16-b" style="width:50%;">
                        ជ្រើសរើសរូបិយប័ណ្ណ
                    </td>
                </tr>
                <tr>
                    <td class="kh16-b" style="width:50%;">
                        <select style="width:100%;" name="seltype" id="seltype" class="form-select kh16">
                            <option value="all">ទាំងអស់</option>
                            <option value="BANK">BANK</option>
                            @if(Auth::user()->role->name=='Admin')
                            <option value="CUSTOMER">CUSTOMER</option>
                            @endif
                            <option value="PARTNER">PARTNER</option>
                            <option value="AGENT">AGENT</option>
                            @if(Auth::user()->role->name=='Admin')
                                <option value="NOLIST">NOLIST</option>
                            @endif
                            <option value="BUYER">BUYER</option>
                            <option value="SALER">SALER</option>
                        </select>
                    </td>
                    <td class="kh16-b" style="width:50%;">
                        <select name="selcur" id="selcur" class="form-select kh16-b" style="width:100%;margin-top:0">
                            <option value="all">all Currency</option>
                            @foreach ($currencies as $cur)
                                <option value="{{ $cur->id }}">{{ $cur->shortcut }}</option>
                            @endforeach
                          </select>
                    </td>
                </tr>
                <tr>
                    <td class="kh16-b" style="width:50%;">ជ្រើសរើសដៃគូ

                    </td>
                    <td class="kh16-b" style="width:50%;">

                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        @php
                            $allowroles = ['Admin', 'Manager']; // add any role you want
                        @endphp
                        <select name="selcustomer" id="selcustomer" style="width:100%" class="form-select select2-option" required>
                            <option value=""></option>
                            @foreach ($partners->whereIn('customertype',['PARTNER','BANK','AGENT']) as $p)
                                <option value="{{ $p->id }}" data-customertype="{{ $p->customertype }}" thai_list="{{ $p->thai_list }}">{{ $p->name}}</option>
                            @endforeach

                            @if (in_array(Auth::user()->role->name, $allowroles))
                                @foreach ($partners->whereIn('customertype',['CUSTOMER','NOLIST']) as $p)
                                    <option value="{{ $p->id }}" data-customertype="{{ $p->customertype }}" thai_list="{{ $p->thai_list }}">{{ $p->name }}</option>
                                @endforeach
                            @endif

                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 style="padding-top:20px;">
                        <input type="radio" class="form-check-input kh16-b" id="radbycol" name="optshow" value="col" checked>
                        <label class="form-check-label kh16-b" for="radbycol">បង្ហាញតាមជួរ</label>
                        &nbsp;
                        <input type="radio" class="form-check-input kh16-b" id="radbycur" name="optshow" value="cur">
                        <label class="form-check-label kh16-b" for="radbycur">បង្ហាញតាមរូបិយប័ណ្ណ</label>
                        <label class="form-check-label kh16-b" style="margin-left:10px;">
                            <input class="form-check-input kh16-b" type="checkbox" name="cklinkdetail" id="cklinkdetail" style=""> LinkDetail
                        </label>
                        <button id="btnshow" class="buttonstyle kh16-b" style="float:right;width:120px;">Show Report</button>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 style="padding-top:10px;">
                        <input type="radio" class="form-check-input kh16-b" id="optall" name="optlist" value="2" checked>
                        <label class="form-check-label kh16-b" for="optall">ទាំងអស់</label>

                        <input type="radio" class="form-check-input kh16-b" id="optwe" name="optlist" value="-1">
                        <label class="form-check-label kh16-b" for="optwe">បើកនៅយើង</label>

                        <input type="radio" class="form-check-input kh16-b" id="optthey" name="optlist" value="1">
                        <label class="form-check-label kh16-b" for="optthey">បើកនៅគេ</label>
                        <button id="btnprint" class="buttonstyle kh16-b" style="float:right;width:120px;">Print Report</button>
                    </td>

                </tr>
                <tr>
                     <td colspan=2 style="border-style:none;padding:10px 0px;">
                        <button class="buttonstyle kh14-b" style="height:25px;" id="btnkatkong">កាត់កង</button>
                        <button class="buttonstyle kh14-b" style="height:25px;" id="btncloselist">បិទបញ្ជី</button>
                        <button class="buttonstyle kh14-b" style="color:rgb(188, 6, 212);height:25px;" id="btndelcloselist">តារាងបិទបញ្ជី</button>

                    </td>
                </tr>
            </table>
        </div>
        <div id="divdisplay" class="col-lg-8">

        </div>
    </div>
    @include('partnerlists.closelistmodal')
    @include('partnerlists.delcloselistmodal')
</body>
<script src="{{ config('helper.asset_path') }}/js/cleave.js"></script>
<script src="{{ config('helper.asset_path') }}/js/cleave-phone.i18n.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

    //tablefixhead(10);
    $(window).resize(function() {
        tablefixhead(10);
    });
    function tablefixhead(h)
    {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-h;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
    }
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

         $('#selcustomer1').select2({
              dropdownParent: $('#closelistmodal')
        });
        $('#selcustomer2').select2({
              dropdownParent: $('#delcloselistmodal')
        });
        //$('#selcustomer').select2({templateResult: formatOption});
        $('#selcustomer').select2({
             templateResult: function (data) {
                if (!data.id) return data.text; // placeholder
                let customertype = $(data.element).data('customertype');
                return $('<span>' + data.text.replace('['+customertype+']', '') +
                    ' <span style="font-size:10px; color:brown;">[' + customertype + ']</span></span>');
            }
        });
        function formatOption(option) {
          if (!option.id) {
            return option.text;
          }
          // Use a <div> to display the main text and a second line
          // option.element.value is get value from select
          var $option = $(
            '<div class="select2-option">' +
              '<div class="select2-option-main">' + option.text + '</div>' +
              '<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('customertype') : option.element.getAttribute('customertype')) + '</div>' +
            '</div>'
          );
          return $option;
        }
        var today=new Date();
            $('#d1,#d2,#closedate').datetimepicker({
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
            getpartner(this.value,'#selcustomer');

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
                            text:item.name,
                            customertype:item.customertype,
                            userconnect:item.user_connect

                        }))
                    //console.log(item)
                });
                $(el).select2('open');

            })
        }
        $('#btnmoveleft').on('click', function () {
            // Hide left panel, expand right panel
            $('#div1').removeClass('col-lg-4').addClass('d-none');
            $('#divdisplay').removeClass('col-lg-8').addClass('col-lg-12');
            $('#btnback').show().text('⇒');
            });

            $('#btnback').on('click', function () {
            if ($('#div1').hasClass('d-none')) {
                // Show left panel, restore original layout
                $('#div1').removeClass('d-none').addClass('col-lg-4');
                $('#divdisplay').removeClass('col-lg-12').addClass('col-lg-8');
                $('#btnback').hide(); // Optionally hide or keep showing as toggle
            }
            });

        $(document).on('click','#tbl_partner_list td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_after td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
        $(document).on('click','#tbl_delcloselist1 td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_before td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
        $(document).on('click','#btnshow',function(e){
            e.preventDefault()
            SearchList(tablefixhead);
        })
        $(document).on('click','#btnprint',function(e){
            e.preventDefault()
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var partner=$('#selcustomer').val();
            var partnername=$('#selcustomer option:selected').text();
            var oldlist = document.getElementById("ckoldlist").checked;
            var alldate = document.getElementById("ckalldate").checked;
            var showby=document.querySelector('input[name="optshow"]:checked').value;
            var seelist=document.querySelector('input[name="optlist"]:checked').value;
            var linkdetail = document.getElementById("cklinkdetail").checked;
            var usd_id = $("#selcur option").filter(function() {
                return $(this).text() === 'USD';
            }).val();
            var thb_id = $("#selcur option").filter(function() {
                return $(this).text() === 'THB';
            }).val();
            var khr_id = $("#selcur option").filter(function() {
                return $(this).text() === 'KHR';
            }).val();
            var vnd_id = $("#selcur option").filter(function() {
                return $(this).text() === 'VND';
            }).val();
            var searchtran=10;
            var redirectWindow = window.open('{{ url('/') }}'+'/partnerlist/showdata?d1='+d1+'&d2='+d2+'&partnername='+partnername+'&partner='+partner+'&oldlist='+oldlist+'&searchtran='+searchtran+'&alldate='+alldate+'&isbooklist='+2+'&usd_id='+usd_id+'&thb_id='+thb_id+'&khr_id='+khr_id+'&vnd_id='+vnd_id+'&seelist='+seelist+'&showby='+showby+'&isprint='+1, '_blank');
            redirectWindow.location;
        })
        function SearchList(callback)
        {
            //debugger;
            $('body').addClass("wait");
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            let select = document.getElementById('selcustomer');
            let thai_list = select.options[select.selectedIndex].getAttribute('thai_list');

            var partner=$('#selcustomer').val();
            var partnername=$('#selcustomer option:selected').text();
            var oldlist = document.getElementById("ckoldlist").checked;
            var alldate = document.getElementById("ckalldate").checked;
            var showby=document.querySelector('input[name="optshow"]:checked').value;
            var seelist=document.querySelector('input[name="optlist"]:checked').value;
            var linkdetail = document.getElementById("cklinkdetail").checked;
            var usd_id = $("#selcur option").filter(function() {
                return $(this).text() === 'USD';
            }).val();
            var thb_id = $("#selcur option").filter(function() {
                return $(this).text() === 'THB';
            }).val();
            var khr_id = $("#selcur option").filter(function() {
                return $(this).text() === 'KHR';
            }).val();
            var vnd_id = $("#selcur option").filter(function() {
                return $(this).text() === 'VND';
            }).val();
            var searchtran=10;
            var url="{{ route('partnerlist.showdata') }}";

            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: { d1:d1,d2:d2,partner:partner,oldlist:oldlist,alldate:alldate,partnername:partnername,searchtran:searchtran,isbooklist:2,usd_id:usd_id,thb_id:thb_id,khr_id:khr_id,vnd_id:vnd_id,showby:showby,seelist:seelist,linkdetail:linkdetail,thai_list:thai_list},
                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#divdisplay').empty().html(data);
                    $('body').removeClass("wait");
                    //displaybycurrency();
                    callback(10);
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
        function refreshlist()
        {
            //debugger;
            $('body').addClass("wait");
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var partner=$('#selcustomer').val();
            var partnername=$('#selcustomer option:selected').text();
            var oldlist = document.getElementById("ckoldlist").checked;
            var alldate = document.getElementById("ckalldate").checked;
            var showby=document.querySelector('input[name="optshow"]:checked').value;
            var seelist=document.querySelector('input[name="optlist"]:checked').value;
            var linkdetail = document.getElementById("cklinkdetail").checked;
            var searchtran=10;
            var url="{{ route('partnerlist.justrefreshdata') }}";

            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: { d1:d1,d2:d2,partner:partner,oldlist:oldlist,alldate:alldate,partnername:partnername,searchtran:searchtran,isbooklist:2,showby:showby,seelist:seelist,linkdetail:linkdetail},

                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#divdisplay').empty().html(data);
                    $('body').removeClass("wait");
                    //displaybycurrency();
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
        $(document).on('change','input[name="optshow"]',function(e){
            e.preventDefault()
            var v=$(this).val();

       })
       $(document).on('change','input[name="optlist"]',function(e){
            e.preventDefault()
            refreshlist();

       })
       $(document).on('change','#selcur',function(e){
            e.preventDefault();
            displaybycurrency();
         })
        $(document).on('click','#btnsummarylist',function(e){
            e.preventDefault();
            TotalList();
        })
        $(document).on('click','#btnsavelist',function(e){
           e.preventDefault();
           $('body').addClass("wait");
           var formdata=new FormData(frmcloselist);
           var url="{{ route('partnerlist.storecloselist') }}"

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
                        alert(data.sms)
                        $('#closelistmodal').modal('hide');
                        $('#frmcloselist').trigger('reset');
                        var today=new Date();
                        $('#closedate').datetimepicker({
                            timepicker:false,
                            datepicker:true,
                            value:today,
                            format:'d-m-Y',
                            autoclose:true,
                            todayBtn:true,
                            startDate:today,

                        });
                        $('body').removeClass("wait");
                        //TotalList();
                        //resetkatkong();
                        //location.reload();
                    }else{
                        $('body').removeClass("wait");
                        alert(data.sms)
                    }
                },
                error: function () {
                     $('body').removeClass("wait");
                    alert('Save Error')
                }

            })

       })
        $(document).on('click','#btnkatkong',function(e){
            e.preventDefault();
            var partnerid=$('#selcustomer').val();
            if(partnerid=='') partnerid=0;
            //var param1 = "customer";
            //var param2= "document";
            var url = '{{ route("partnerlist.exchangelist", [":param1"]) }}';
                url = url.replace(':param1', partnerid);
                //url = url.replace(':param2',param2)
            window.open(url,'_blank');
        })
         $(document).on('change','#selcustomer1',function(e){
            e.preventDefault();
            TotalList();
        })
         $(document).on('click','#btncloselist',function(e){
            $('#closelistmodal').modal('show');
            var partnerid=$('#selcustomer').val();
            $('#selcustomer1').val(partnerid);
            $('#selcustomer1').trigger('change');
            TotalList();
       })
       $(document).on('click','#btndelcloselist',function(e){
            $('#delcloselistmodal').modal('show');
            var partnerid=$('#selcustomer').val();
            $('#selcustomer2').val(partnerid);
            $('#selcustomer2').trigger('change');
            //showcloselist();
       })
        $(document).on('click','#btnshowcloselist',function(e){
           e.preventDefault();
           showcloselist();
       })
       $(document).on('change','#selcustomer2',function(e){
        e.preventDefault();
        showcloselist();
       })
       function showcloselist(){
            $('body').addClass("wait");
            var partner=$('#selcustomer2').val();
            var url="{{ route('partnerlist.showcloselist') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {partner:partner},

                complete: function () {},
                success: function (data) {
                      //console.log(data);
                    $('#closelistbody').empty().html(data);
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
       }
          $(document).on('click','.btn-delcloselist',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('closelist.delete') }}",
                            data: { id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    $('#btnshowcloselist').click();
                                    Swal.fire(
                                        'Deleted!',
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
        function TotalList()
        {
            $('body').addClass("wait");
            var exchangedate=$('#closedate').val();
            var partner=$('#selcustomer1').val();
            var partnername=$('#selcustomer1 option:selected').text();
            var url="{{ route('partnerlist.gettotallist') }}";
             $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {exchangedate:exchangedate,partner:partner,partnername:partnername,iscloselist:1},
                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#tbl_closelist').empty().html(data);
                    var maxtid=$('#maxtid').val();
                    var maxeid=$('#maxeid').val();
                    var maxsmsid=$('#maxsmsid').val();
                    // $('#txt_lasttid').val(maxtid);
                    // $('#txt_lasteid').val(maxeid);
                    // $('#txt_lastsmsid').val(maxsmsid);
                    $('body').removeClass("wait");

                },
                error: function () {
                    $('body').removeClass("wait");
                    //alert('Read Data Error.')
                }
            })
        }
       function displaybycurrency()
        {
            var cur=$('#selcur option:selected').text();
            var curid=$('#selcur').val();
            if(curid=='all'){
              visiblecur();
            }else{
              invisiblecur();
            }
            if(cur=='USD'){
              var tr_usd=document.getElementsByClassName('tr_usd');
              for(i=0; i<tr_usd.length; i++) {tr_usd[i].style.display='';}
            }else if(cur=='THB'){
              var tr_thb=document.getElementsByClassName('tr_thb');
              for(i=0; i<tr_thb.length; i++) {tr_thb[i].style.display='';}
            }else if(cur=='KHR'){
              var tr_khr=document.getElementsByClassName('tr_khr');
              for(i=0; i<tr_khr.length; i++) {tr_khr[i].style.display='';}
            }else if(cur=='VND'){
              var tr_vnd=document.getElementsByClassName('tr_vnd');
              for(i=0; i<tr_vnd.length; i++) {tr_vnd[i].style.display='';}
            }

        }
        function invisiblecur()
        {
          var tr_usd=document.getElementsByClassName('tr_usd');
          for(i=0; i<tr_usd.length; i++) {tr_usd[i].style.display='none';}
          var tr_thb=document.getElementsByClassName('tr_thb');
          for(i=0; i<tr_thb.length; i++) {tr_thb[i].style.display='none';}
          var tr_khr=document.getElementsByClassName('tr_khr');
          for(i=0; i<tr_khr.length; i++) {tr_khr[i].style.display='none';}
          var tr_vnd=document.getElementsByClassName('tr_vnd');
          for(i=0; i<tr_vnd.length; i++) {tr_vnd[i].style.display='none';}
        }
        function visiblecur()
        {
          var tr_usd=document.getElementsByClassName('tr_usd');
          for(i=0; i<tr_usd.length; i++) {tr_usd[i].style.display='';}
          var tr_thb=document.getElementsByClassName('tr_thb');
          for(i=0; i<tr_thb.length; i++) {tr_thb[i].style.display='';}
          var tr_khr=document.getElementsByClassName('tr_khr');
          for(i=0; i<tr_khr.length; i++) {tr_khr[i].style.display='';}
          var tr_vnd=document.getElementsByClassName('tr_vnd');
          for(i=0; i<tr_vnd.length; i++) {tr_vnd[i].style.display='';}

        }

    })//document

</script>
</html>
