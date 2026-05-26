<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckUserCloseList</title>
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
         .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
            .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
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
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
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
       .tbl_seedetail .clickedrow td{
        background-color: blue !important;
        color:white !important;
    }
    .tbl_seedetail .clickedrow td input{
        background-color: blue !important;
        color:white !important;
    }
    .tbl_seedetail .clickedrow td a{
        background-color: blue;
        color:white !important;
    }
     .tbl_seedetail .clickedrow td span{
        background-color: blue;
        color:white !important;
    }
    .red{
        color:red;
    }
    .blue{
        color:blue;
    }
    .tbl_seedetail td{
        padding:2px;
    }
    .tbl_seedetail th{
        padding:2px;
    }
    .mybtn{
        border:1px solid black;
        padding:0px 2px;
    }
    .mybtn:hover{
        background-color:greenyellow;
    }
    .tableFixHead{ overflow: auto;border:1px solid blue;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:silver }
    .group-odd {
        background-color: rgb(221, 243, 232);
    }
    .group-even {
        background-color: rgb(236, 219, 232);
    }
</style>
@php
        function phpformatnumber_long($num) {
            // Convert to string to avoid float precision issues
            $str = (string)$num;

            // Check if number has a decimal point
            if (strpos($str, '.') !== false) {

                // Get part after decimal
                $decimalPart = substr($str, strpos($str, '.') + 1);

                // Count decimals (limit max 2)
                $dc = strlen(rtrim($decimalPart, '0')); // remove trailing zeros
                if ($dc > 2) $dc = 2;

            } else {
                $dc = 0;  // no decimal
            }

            return number_format((float)$num, $dc, '.', ',');
        }
     function phpformatnumber($num) {
            $str = (string)$num;
            $dc = 0;

            if (strpos($str, '.') !== false) {
                $dec = rtrim(substr($str, strpos($str) + 1), '0');
                $dc = min(strlen($dec), 2);
            }

            return number_format((float)$num, $dc, '.', ',');
        }
         function phpformatnumber2d($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
            $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
    function bongkot($amount,$cur)
      {
        if($cur=='រៀល'){
            $amt = round($amount / 100) * 100;
        }else if($cur=='បាត'){
            $amt = round($amount);
        }else{
            $amt=$amount;
        }
        if($cur=='ដុល្លា'){
            return phpformatnumber2d($amt);
        }else{
            return phpformatnumber($amt);
        }
      }

@endphp
<body>
    @php
        $sumproduct =0;
        $sumamount =0;
        $sumdebt =0;
        $balance=0;
    @endphp
    <div class="row" style="margin-bottom:10px;margin-top:-10px;">
    <input type="hidden" id="ismain" value="{{ $ismain }}">
    <div class="table-responsive">
        <table class="">
            <tr>
                <td  class="kh16">
                    <input type="hidden" id="curid" value="{{$curid}}">
                    បុគ្គលិក
                     {{-- <span class="kh22-b" id="spuser" title="{{$userid}}" style="color:blue;">{{ $username }}</span> --}}
                    <span class="kh16-b">
                        <select name="seluser" id="seluser" class="kh16-b" style="height:30px;">
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ $userid==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </span>
                </td>
                <td class="kh16" style="padding-left:10px;">
                    ថ្ងៃទី
                    {{-- <span class="kh22-b" style="color:blue;">{{ date('d-m-Y',strtotime($viewdate)) }}</span> --}}
                        <span>
                            <input type="text" name="stockdate" id="stockdate" class="" style="width:110px;background-color:silver;font-size:16px;" value="{{ date('d-m-Y',strtotime($viewdate)) }}" readonly>
                        </span>
                        <span>
                            <input type="hidden" id="fromdate" value="{{$fromdate}}">
                        </span>

                </td>
                <td class="kh16" style="padding-left:10px;">
                     រូបិយប័ណ្ណ
                    {{-- <span id="curname" class="kh22-b" style="color:blue;" title="{{$curshortcut}}">{{ $curname }}</span> --}}
                    <span id="curname" class="kh16-b">
                        <select name="selcur" id="selcur" class="kh16-b" style="height:30px;">
                            @foreach ($currencies as $c)
                                <option value="{{$c->id}}" {{ $c->id==$curid?'selected':'' }} isexchangecur="{{$c->isexchangecur}}" ismain="{{$c->ismain}}" curname="{{$c->curname}}">{{ $c->shortcut }}</option>
                            @endforeach
                        </select>
                    </span>

                </td>
                <td class="kh16" style="padding-left:10px;">
                        ប្រភេទលុយ
                        <span class="kh16-b" style="color:red;">
                        {{-- ({{ $ckcash=='both'?'ក្នុង+ក្រៅ':$ckcash }}) --}}
                        <select name="seltype" id="seltype" class="kh16-b" style="height:30px;">
                            <option value="cash" {{$ckcash=='cash'?'selected':''}}>ក្រៅ</option>
                            <option value="bank" {{$ckcash=='bank'?'selected':''}}>ក្នុង</option>
                            <option value="both" {{$ckcash=='both'?'selected':''}}>ក្នុង + ក្រៅ</option>

                        </select>
                    </span>
                </td>
                <td style="padding-left:5px;">
                    <label style="display:block;margin-top:-2px">
                        <input type="checkbox" id="ckshowall" />
                        Show all transaction
                    </label>

                    <label style="display:block;margin-top:-3px">
                        <input type="checkbox" id="ckclearalluserview" />
                        Clear all User View
                    </label>
                </td>
                <td style="padding-left:10px;">
                    <button id="btnshow"  class="mybtn" style="height:28px;width:60px;">Show</button>
                </td>
                <td style="padding-left:10px;">
                    <select class="kh16-b" name="selfilter" id="selfilter" style="width:200px;height:30px;">
                        <option value="">All</option>
                        <option value="startbal">លុយដើមគ្រា</option>
                        <option value="endbal">លុយដកចុងគ្រា</option>
                        <option value="allbalin">សរុបលុយដាក់ចូល</option>
                        <option value="allbalout">សរុបលុយដកចេញ</option>
                        <option value="exchange">ប្តូរប្រាក់</option>
                        <option value="transfer">លុយវេរមុខផ្ទះ</option>
                        <option value="capital_cashin">ថែមដើមទុន</option>
                        <option value="capital_cashout">ដកដើមទុន</option>
                        <option value="cashdraw">បើកវេរក្នុងស្រុក</option>
                        <option value="income">ចំណូល</option>
                        <option value="expanse">ចំណាយ</option>
                        <option value="transfer_balout_user">ដកលុយពីកុងបុគ្គលិក</option>
                        <option value="transfer_balin_user">ដាក់លុយចូលកុងបុគ្គលិក</option>
                        <option value="thaicashdraw">បើកលុយថៃ</option>
                    </select>
                </td>
                 <td>
                    <input type="text" class="kh16" id="tableSearch" style="width:250px;"  placeholder="Search here ..." title="Type what you khnow">
                </td>

            </tr>
        </table>
    </div>
</div>

   <div class="row">
    <div class="tableFixHead" style="padding:0px;">
        <form id="frmusercapitaldetails" action="">
            <div id="userreportdetail">
                <table id="tbl_seedetail" class="table table-bordered table-hover kh14 tbl_seedetail">
                    <thead style="text-align:center;background-color:rgb(241, 172, 230);">
                        <th>លរ</th>
                        <th> <button type="button" class="mybtn" id="updateSelected" style="float:left;">Hide</button> TrID</th>
                        <th>បរិយាយ</th>
                        <th>ប្រភេទ</th>
                        <th style="width:200px;">
                            <select class="" style="width:200px;" name="sel_agent" id="sel_agent">
                                <option value="all">all</option>
                                @foreach ($agentnames as $item)
                                    <option value="{{ $item->agent_name }}">{{ $item->agent_name }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th>ទិញ/លក់</th>
                        <th>សរុបទឹកប្រាក់</th>
                        {{-- <th>ប្រាក់កក់</th>
                        <th>នៅខ្វះ</th> --}}
                        {{-- <th>សមតុល្យ</th> --}}
                        <th>ថ្ងៃទី</th>
                        <th>ផ្សេងៗ</th>
                         <th>អ្នកកត់ត្រា</th>
                         <th>GroupId</th>

                    </thead>
                    <tbody id="body_seedetail">
                        @foreach ($userreportdetails as $key =>$d)
                            @php
                                $sumproduct += $d->buysale;
                                $sumamount += $d->amount;
                                $sumdebt +=$d->debt;
                                $balance +=$d->amount-$d->debt;
                            @endphp
                            <tr>
                                <td style="text-align:center;">{{ ++$key }}</td>
                                 <td class="kh12-b" style="text-align:right;">
                                    <input type="checkbox" name="ids[]" value="{{ $d->id }}" style="float:left;">
                                    <a  href="{{ route('usercapital.seedetaillink',['id'=>$d->tran_id,'group_id'=>$d->group_id,'tablename'=>$d->table,'fromdate'=>$d->from_date,'todate'=>$d->to_date,'ismain'=>$ismain,'userid'=>$userid,'curid'=>$curid,'curshortcut'=>$curshortcut,'username'=>$username]) }}" target="_blank" style="padding:2px;" class="mybtn">
                                        {{ $d->tran_id?$d->tran_id:'View' }}
                                    </a>
                                    @if($d->group_id)
                                        <a href="{{ route('usercapital.showrefgroupid',['group_id'=>$d->group_id,'showdelbuton'=>false]) }}" class="mybtn" target="_blank" style="margin:0px;padding:2px;">{{ $d->group_id??'' }}</a>
                                    @endif
                                </td>
                                <td class="kh14-b">
                                    @if($d->invnum==null)
                                        {{ $d->description }}
                                    @else
                                        <a href="{{ route('invoice.invoicedetail',['invid'=>$d->invnum]) }}" target="_blank" class="@if($d->buysale>0) blue  @else red @endif">
                                            {{ $d->description }}
                                        </a>
                                    @endif
                                </td>
                                <td class="kh14-b">
                                  {{ $d->capital_type }}
                                </td>
                                <td class="kh14-b">
                                  {{ $d->agent_name }}
                                </td>

                                <td class="kh14-b buysale" style="text-align:right;@if($d->buysale>0) color:blue; @elseif($d->buysale<0) color:red; @endif">{{ phpformatnumber2d($d->buysale) . ' ' . $d->cur }} @if($d->buysale<>0)<br> <span class="kh10-b" style="color:grey;">{{ phpformatnumber2d($sumproduct) }} </span> @endif</td>
                                <td class="kh14-b amount" style="text-align:right;@if($d->amount>0) color:blue; @elseif($d->amount<0) color:red; @endif">{{ phpformatnumber2d($d->amount) . ' USD'}}  @if($d->amount<>0)<br> <span class="kh10-b" style="color:grey;">{{ phpformatnumber2d($balance) }} </span> @endif</td>
                                {{-- <td style="text-align:right;">{{ phpformatnumber($d->deposit) . ' USD'}}</td>
                                <td style="text-align:right;">{{ phpformatnumber($d->debt) . ' USD'}}</td> --}}
                                {{-- <td class="kh14-b" style="text-align:right;">{{ phpformatnumber2d($balance) . ' USD'}}</td> --}}

                                <td class="kh12-b" style="text-align:right;">
                                    {{ date('d-m-y',strtotime($d->dd))}}
                                    @if($d->trantime>0)
                                       {{  ' ' . $d->trantime}}
                                    @endif
                                </td>
                                <td class="kh12-b" style="text-align:right;">{{ $d->note??'' }}</td>
                                 <td class="kh12-b" style="text-align:right;@if($d->recordby<>$username)color:red;@endif">{{ $d->recordby??'' }}</td>
                                <td>{{ $d->group_id }}</td>
                            </tr>
                        @endforeach
                        <tr class="kh18-b">
                            <td colspan=5 style="text-align:center;">សរុប</td>
                            @if($ismain==0)
                                <td style="text-align:right;background-color:greenyellow">{{ bongkot($sumproduct,$curname) . ' ' . $curname }}</td>
                            @else
                                <td></td>
                            @endif

                            <td style="text-align:right;background-color:greenyellow">{{ phpformatnumber($sumamount) . ' USD' }}</td>
                            <td colspan=3 style="text-align:right;"></td>
                            {{-- <td style="text-align:right;">{{ phpformatnumber($sumdebt) . ' USD'}}</td> --}}
                        </tr>
                        <tr class="kh18-b" style="background-color:aqua">
                            <td colspan=4 style="text-align:center;">សរុបទូទាត់</td>
                            <td colspan=5 style="text-align:right;">{{ phpformatnumber($sumamount-$sumdebt) . ' USD' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </form>
    </div>
</div>
<div id="totalAmountDisplay" class="kh22-b" style=""></div>
</body>
<script src="{{ config('helper.asset_path') }}/js/cleave.js"></script>
<script src="{{ config('helper.asset_path') }}/js/cleave-phone.i18n.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    tablefixhead(175);
    $(window).resize(function() {
        tablefixhead(175);

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
    function hilight_bygroup()
    {
        let lastGroup = null;
        let groupToggle = false;
        $("#tbl_seedetail tbody tr").each(function(){
            let groupId = $(this).find("td:eq(10)").text().trim(); // 2nd column = group_id
            // if new group_id → switch color
            if (groupId !== lastGroup) {
                groupToggle = !groupToggle;
                lastGroup = groupId;
            }
            // apply class based on toggle
            $(this).addClass(groupToggle ? "group-even" : "group-odd");
        });
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        hilight_bygroup();
            var today=new Date();
            let currentVal = $('#stockdate').val(); // get value from Blade
            $('#stockdate').datetimepicker({
                timepicker: false,
                datepicker: true,
                format: 'd-m-Y',
                autoclose: true,
                todayBtn: true,
                startDate: new Date(),
                value: currentVal ? currentVal : new Date() // keep Blade date, fallback today
            });
            // $(document).on('click','.tbl_seedetail td',function(e){
            //     $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            //    // add highlight to the parent tr of the clicked td
            //    $(this).parent('tr').addClass("clickedrow");
            // })
            $(document).on('click', '.tbl_seedetail td', function(e) {
                let $td = $(this);
                let $tr = $td.parent('tr');
                let $table = $tr.closest('table');

                // remove old highlights
                $table.find('tr.clickedrow').removeClass('clickedrow');

                let groupId = $tr.find('td:eq(10)').text().trim(); // assuming 2nd column = group_id
                if(groupId===''){
                      $(this).parent('tr').addClass("clickedrow");
                }else{
                    $table.find('tbody tr').each(function() {
                        if ($(this).find('td:eq(10)').text().trim() === groupId) {
                            $(this).addClass('clickedrow');
                        }
                    });
                }

            });

            $(document).on('change','#sel_agent',function(e){
                e.preventDefault();

                    $('body').addClass("wait");
                    var url="{{ route('usercapital.seebyagentname') }}"
                    var seeby=$(this).val();
                    var selected = $('#selcur').find(':selected');
                    var curname=selected.attr('curname');
                    var ismain=selected.attr('ismain');
                    var cur=$('#selcur option:selected').text();
                    var userid=$('#seluser').val();
                    var username=$('#seluser option:selected').text();
                    var curid=$('#selcur').val();

                $.ajax({
                        async:true,
                        type: 'GET',
                        url: url,
                        data: {seeby:seeby,ismain:ismain,curname:curname,shortcut:cur,userid:userid,curid:curid,username:username},
                        //contentType: 'text/plain',
                        //contentType: false,
                        //processData: true,
                        //cache: false,
                        complete: function () {},
                        success: function (data) {
                            //console.log(data)
                            $('#body_seedetail').empty().html(data);
                            $('body').removeClass("wait");
                        },
                        error: function () {
                            alert('Read Data Error.')
                            $('body').removeClass("wait");
                        }
                    })

            })
           $(document).on('change','#selfilter',function(e){
                e.preventDefault();
                showdetail();
           })
            function showdetail()
           {
                $('body').addClass("wait");
                var url="{{ route('usercapital.seedetail1by1') }}";
                var seeby=$('#selfilter').val();
                var selected = $('#selcur').find(':selected');
                var curname=selected.attr('curname');
                var ismain=selected.attr('ismain');
                var cur=$('#selcur option:selected').text();
                var userid=$('#seluser').val();
                var username=$('#seluser option:selected').text();
                var curid=$('#selcur').val();

                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {seeby:seeby,ismain:ismain,curname:curname,shortcut:cur,userid:userid,curid:curid,username:username},
                    //contentType: 'text/plain',
                    //contentType: false,
                    //processData: true,
                    //cache: false,
                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                        $('#body_seedetail').empty().html(data);
                         hilight_bygroup();
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        alert('Read Data Error.')
                        $('body').removeClass("wait");
                    }
                })
           }
            $(document).on('click','#updateSelected',function(e){
                e.preventDefault();
                    var formdata=new FormData(frmusercapitaldetails);
                    $('body').addClass("wait");
                    var url="{{ route('usercapital.updatehideview') }}"

                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                        showdetail();
                       $('body').removeClass("wait");
                    },
                    error: function () {
                        alert('Update Error')
                        $('body').removeClass("wait");
                    }

                })
            })

             $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                    ('#selfilter').val('');
                    const showall = document.getElementById("ckshowall");
                    const ckclearall = document.getElementById("ckclearalluserview");
                    let hide_view=1;
                    if(showall.checked){
                        hide_view=2;
                    }
                    let clearall=0;
                    if(ckclearall.checked){
                        clearall=1;
                    }
                    let currency_id=$('#selcur').val();
                    let shortcut=$('#selcur option:selected').text();
                    let selected = $('#selcur').find(':selected');
                    let isExchangeCur = selected.attr('isexchangecur');
                    let isMain = selected.attr('ismain');
                    let curname = selected.attr('curname');
                    let viewdate=$('#stockdate').val();
                    let userid=$('#seluser').val();
                    let username=$('#seluser option:selected').text();
                    let ckcash=$('#seltype').val();
                    let fromdate=$('#fromdate').val();
                    let seedetailUrl = "{{ url('/usercapital/seedetail/:curid/:curname/:curshortcut/:isexchangecur/:ismain/:viewdate/:userid/:username/:fromdate/:ckcash/:islink/:hide_view/:clearall') }}";
                    let url = seedetailUrl
                        .replace(':curid', currency_id)
                        .replace(':curname', encodeURIComponent(curname))
                        .replace(':curshortcut', shortcut)
                        .replace(':isexchangecur', isExchangeCur)
                        .replace(':ismain', isMain)
                        .replace(':viewdate', viewdate)
                        .replace(':userid', userid)
                        .replace(':username', encodeURIComponent(username))
                        .replace(':fromdate', fromdate)
                        .replace(':ckcash', ckcash)
                        .replace(':islink',0)
                        .replace(':hide_view',hide_view)
                        .replace(':clearall',clearall);
                $.ajax({
                    async: true,
                    type: 'GET',
                    contentType: false,
                    processData: false,
                    url: url,
                    success: function (data) {
                        //console.log(data)
                        $('#userreportdetail').empty().html(data);
                        hilight_bygroup();
                       $('body').removeClass("wait");
                    },
                    error: function () {
                        alert('Search Error')
                        $('body').removeClass("wait");
                    }

                })
            })

    })//document
      $("#tableSearch").on("keyup", function () {
            var rawInput = $(this).val().toUpperCase().trim();
            var currencySymbol = '';
            if (rawInput.includes('$')) currencySymbol = '$';
            else if (rawInput.includes('R') || rawInput.includes('៛')) currencySymbol = 'R';

            var cleanInput = rawInput.replace(/[^0-9.\-]/g, '');
            var rangeMatch = cleanInput.match(/^(-?\d+(?:\.\d+)?)\-(-?\d+(?:\.\d+)?)$/);
            var isRange = rangeMatch !== null;

            var min = isRange ? Math.abs(parseFloat(rangeMatch[1])) : null;
            var max = isRange ? Math.abs(parseFloat(rangeMatch[2])) : null;

            var totalAmount = 0;

            $("#tbl_seedetail tr").each(function (index) {
                if (index !== 0) {
                    var $row = $(this);
                    var matchFound = false;

                    $row.find('td').each(function () {
                        var cell = $(this);
                        var cellText = cell.text().toUpperCase();
                        var inputValue = cell.find('input').val() || '';

                        var fullText = cellText + " " + inputValue;

                        if (isRange) {
                            if (!fullText.includes(currencySymbol)) return;

                            var numberOnly = fullText.replace(/[^\d.]/g, '');
                            var num = parseFloat(numberOnly);
                            var absNum = Math.abs(num);

                            if (!isNaN(absNum) && absNum >= min && absNum <= max) {
                                matchFound = true;
                                return false;
                            }
                        } else {
                            var searchText = rawInput.replace(/[ ,\-]/g, '');
                            var target = fullText.replace(/[ ,\-]/g, '');
                            if (target.includes(searchText)) {
                                matchFound = true;
                                return false;
                            }
                        }
                    });

                    $row.toggle(matchFound);

                   if (matchFound) {
                        var amountCell = $row.find("td.buysale");
                        if (amountCell.length > 0) {
                            var amountText = amountCell.text()
                                .replace(/,/g, '')        // remove commas from number
                                .replace(/[^\d.-]/g, ''); // strip out non-numeric and non-dot/dash (removes KHR, USD etc.)
                            var amountValue = parseFloat(amountText);
                            if (!isNaN(amountValue)) {
                                totalAmount += amountValue;
                            }
                        }
                    }
                }
            });
            var curname=$('#curname').text();
            // Display the totalAmount somewhere
            $("#totalAmountDisplay").text("Total: " + formatNumber(totalAmount.toFixed(2)) + ' ' + curname );
        });
</script>
</html>
