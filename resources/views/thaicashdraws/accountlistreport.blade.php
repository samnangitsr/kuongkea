@extends('master')
@section('title') ThaiAccountRegister @endsection
@section('css')
    <style type="text/css">
      body.wait *{
			cursor: wait !important;
		}
        /* .select2-container--default .select2-results>.select2-results__options{max-height: 660px !important;} */
    #selcus + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:whitesmoke;}
		/* Each result */
	#select2-selcus-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}
        .kh12{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
        .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
        .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh30-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
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
        td{
            padding:0px;
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
    .tableFixHead{ overflow: auto;border:1px groove silver;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    .tbl_usertransaction td{
      word-wrap: break-word;
      padding:2px 5px 2px 5px;
    }

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
       #tblacclist .clickedrow td{
        background-color: #aae688;
       }

       #tbl_accreport td{
        padding:0px 5px;
       }
       #tblacclist thead th{
        padding:2px;
        text-align:center;
       }
        #tblacclist td{
        padding:2px 5px;

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
    <div class="table-responsive" style="margin-bottom:10px;">
        <table id="tbl_accreport" class="">

            <tr>

                    <td class="kh16-b" style="width:120px;">
                        <input type="text" name="d1" id="d1" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>

                    </td>
                    <td class="kh16-b" style="">-</td>
                    <td class="kh16-b" style="width:120px;">
                        <input type="text" name="d2" id="d2" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>

                    </td>

                    <td class="kh14-b" style="">ធនាគា</td>
                    <td style="border-style:none;">
                        <select name="selbank" id="selbank" class=" kh16-b">
                            <option value=""></option>
                            @foreach ($banks as $b)
                                <option value="{{ $b->name }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="kh14-b" style="">លេខបញ្ជី</td>
                    <td style="border-style:none;">
                        <select name="sellist" id="sellist" class="kh16-b">
                            <option value=""></option>
                            @foreach ($accounts as $a)
                                <option value="{{ $a->id }}" accno="{{$a->accno}}">{{ $a->accno . ' [' . $a->bankname . ']' }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="kh14-b" style="">អតិថិជន</td>
                    <td style="border-style:none;width:150px;">
                        <select name="selcus" id="selcus" class="kh16-b" style="width:150px;">
                            <option value=""></option>
                            @foreach ($thaicus as $a)
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select class="kh16-b" name="seltran" id="seltran">
                            <option value="2">ដាក់ចូល+ដកចេញ</option>
                            <option value="1">ដាក់ចូល</option>
                            <option value="-1">ដកចេញ</option>

                        </select>
                    </td>
                    <td style=""><label class="form-check-label kh16-b">
                        <input class="form-check-input kh16-b" type="checkbox" name="ckoldlish" id="ckoldlist" checked> បញ្ជីចាស់</label>
                    </td>
                    <td style="padding-bottom:10px;">
                        <button class="btn-3d" id="btnshow" data-action="show">Show</button>
                        <button class="btn-3d btn-3d-primary" id="btnprint" data-action="print">Print</button>
                    </td>
            </tr>



        </table>
    </div>
    <div class="tableFixHead">
        <table id="tblacclist" class="table table-bordered table-hover kh12-b">
            <thead>
                <th>No</th>
                <th>ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Transaction</th>
                <th>Amount</th>
                <th>Balance</th>
                <th>SMS</th>
                <th>អតិថិជន</th>
                <th>SaveBy</th>
            </thead>
            <tbody id="bodyacclist">

            </tbody>
        </table>
    </div>
@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('របាយការណ៏លេខបញ្ជីថៃ');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-190;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-190;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
      });


        $(document).ready(function () {
            $('#selcus').select2();
            var today=new Date();
            $('#d1,#d2').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            $(document).on('click','#tblacclist td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })

            $(document).on('change','#selbank',function(e){
                e.preventDefault();
                getaccountlistbybank($(this).val());
            })
            function getaccountlistbybank(bankname)
            {
                $('body').addClass("wait");
                $('#sellist').empty();
                var url="{{ route('thaisms.getaccountlistbybank') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {bankname:bankname},
                    success: function (data) {
                        console.log(data)
                        if($.isEmptyObject(data.error)){
                            $('#sellist').append($("<option/>",{
                                value:'',
                                text:'',
                                accno:''
                            }))
                            $.each(data['acclist'],function(i,item){
                                $('#sellist').append($("<option/>",{
                                        value:item.id,
                                        text:item.accno + ' [' + item.bankname + ']',
                                        accno:item.accno
                                    }))
                            });

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
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                var action=$(this).data('action');

                $('body').addClass("wait");
                var oldlist = document.getElementById("ckoldlist");
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var id=$('#sellist').val();
                let select = document.getElementById('sellist');
                let accno = select.options[select.selectedIndex].getAttribute('accno');
                let customer=$('#selcus').val();
                let seltran=$('#seltran').val();
                var url="{{ route('thaiaccount.getaccountlistreport') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {oldlist:oldlist.checked,d1:d1,d2:d2,accno:accno,id:id,customer:customer,seltran:seltran,action:action},
                    success: function (data) {
                        console.log(data)
                        if($.isEmptyObject(data.error)){
                            $('#bodyacclist').empty().html(data);
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
             $(document).on('click','#btnprint',function(e){
                e.preventDefault();
                var action=$(this).data('action');
                var oldlist = document.getElementById("ckoldlist");
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var id=$('#sellist').val();
                let select = document.getElementById('sellist');
                let accno = select.options[select.selectedIndex].getAttribute('accno');
                let customer=$('#selcus').val();
                let cusname=$('#selcus option:selected').text();
                let seltran=$('#seltran').val();

                var redirectWindow = window.open('{{ url('/') }}'+'/thaiaccount/getaccountlistreport?d1='+d1+'&d2='+ d2 +'&oldlist='+oldlist.checked+'&accno='+accno+'&customer='+customer+'&cusname='+ cusname +'&id='+id+'&seltran='+seltran+'&action='+action, '_blank');

                redirectWindow.location;

            })

        })

        function isEmpty(val){return (val === undefined || val == null || val.length <= 0) ? true : false;}
        function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    </script>
@endsection
