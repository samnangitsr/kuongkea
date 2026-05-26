@extends('master')
@section('title') ShowByID @endsection
@section('css')
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
    .tableFixHead{ overflow: auto;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
       .table .clickedrow td{
        background-color: #caaf8f;
    }
    .table td{
        padding:0px 3px;
    }
    .table th{
        padding:0px 3px;
        background-color:aqua;
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
    <div class="" style="margin-bottom:10px;">
        <table class="kh16-b">
            <tr>
                <td>គិតពី</td>
                <td>
                    <div class="input-group" style="width:160px;">
                        <input type="text" name="fromdate" id="fromdate" class="form-control" style="width:110px;height:30px;background-color:silver;font-size:16px;" value="{{$arrvar['fromdate']}}" readonly>
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </td>
                 <td>ដល់</td>
                <td>
                    <div class="input-group" style="width:160px;">
                        <input type="text" name="todate" id="todate" class="form-control" style="width:110px;height:30px;background-color:silver;font-size:16px;" value="{{$arrvar['todate']}}" readonly>
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </td>
                <td class="kh16" style="padding-left:10px;">
                        ប្រភេទលុយ
                        <span class="kh16-b" style="color:red;">
                            <select name="seltype" id="seltype" class="kh16-b" style="height:30px;">
                                <option value="">ក្នុង + ក្រៅ</option>
                                <option value="cash">ក្រៅ</option>
                                <option value="agent">ក្នុង</option>
                            </select>
                        </span>
                </td>
                <td style="@if($arrvar['linkid']>0) display:none; @endif">
                    <button id="btnshow" class="btn btn-info btn-sm kh16-b" title="{{$table}}">Show</button>
                </td>
                <td class="kh22-b" style="padding-left:20px;">
                    សរុបទឹកប្រាក់
                </td>
                <td id="totalamount" class="kh22-b" style="{{$sumamount>0?'color:blue;':'color:red;'}}padding-left:20px;">
                    {{phpformatnumber($sumamount) . ' ' . $arrvar['curshortcut']}}
                </td>
                <td style="display:none;">
                    <input type="text" id="userid" value="{{$arrvar['userid']}}">
                     <input type="text" id="curid" value="{{$arrvar['curid']}}">
                      <input type="text" id="ismain" value="{{$arrvar['ismain']}}">
                      <input type="text" id="cur" value="{{$arrvar['curshortcut']}}">

                </td>
            </tr>
        </table>
    </div>

    <div class="row" id="rowdisplay">
        @if($table=='transfer' || $table=='partner_useraffect')
            <table class="table table-bordered kh16-b">
                <thead style="text-align:center;">
                    <th>TID</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>បុគ្គលិកពាក់ព័ន្ធ</th>
                    <th>ដៃគូ</th>
                    <th>ប្រតិបត្តិការណ៏</th>
                    <th>សរុបទឹកប្រាក់</th>
                    <th>សេវ៉ាដៃគូ</th>
                    <th>សេវ៉ាអតិថិជន</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>ផ្សេងៗ</th>
                    <th>GroupID</th>

                </thead>
                <tbody>
                    @php
                        $t_amt=0;
                        $t_fee=0;
                        $t_cuscharge=0;
                    @endphp
                    @foreach ($showlink as $key=> $item)
                        @php
                            $t_amt+=$item->amount;
                            $t_fee+=$item->fee;
                            $t_cuscharge+=$item->cuscharge;
                        @endphp
                        <tr class="kh16" style="text-align:center;">
                            <td>{{ sprintf("%04d",$item->id) }}</td>
                            <td>
                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->useraffect->name }}</td>
                            <td>{{ $item->partner->name }}</td>
                            <td>{{ $item->tranname }}</td>
                            <td style="text-align:right;" title="{{phpformatnumber($t_amt)}}">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                            <td style="text-align:right;" title="{{phpformatnumber($t_fee)}}">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}</td>
                            <td style="text-align:right;" title="{{phpformatnumber($t_cuscharge)}}">{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                            <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                            <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                            <td>{{ $item->note }}</td>
                            <td>
                                @if($item->ref_group_id)
                                        <a href="{{ route('usercapital.showrefgroupid',['group_id'=>$item->ref_group_id,'showdelbuton'=>false]) }}" class="mybtn" target="_blank" style="margin:0px;padding:2px;">{{ $item->ref_group_id??'' }}</a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    <tr style="background-color:aqua">
                        <td colspan=6>Total</td>
                        <td style="text-align:right;">{{ phpformatnumber($t_amt) . ' ' . $arrvar['curshortcut'] }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t_fee) . ' ' . $arrvar['curshortcut'] }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t_cuscharge) . ' ' . $arrvar['curshortcut']}}</td>
                    </tr>
                </tbody>
            </table>
        @elseif($table=='usercapital')
            <table class="table table-bordered kh16-b">
                <thead style="text-align:center;">
                    <th>ID</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>បុគ្គលិកពាក់ព័ន្ធ</th>
                    <th>ប្រតិបត្តិការណ៏</th>
                    <th>ប្រភេទ</th>
                    <th>ទឹកប្រាក់</th>
                    <th>ផ្សេងៗ</th>
                    <th>Ref_Number</th>

                </thead>
                <tbody>
                    @foreach ($showlink as $key=> $item)
                        <tr class="kh16" style="text-align:center;">
                            <td>{{ sprintf("%04d",$item->id) }}</td>
                            <td>
                                {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->useraffect->name }}</td>
                            <td>{{ $item->tranname . '(' . $item->trancode . ')' }}</td>
                            <td>{{ $item->agentname->name }}</td>
                            <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>

                            <td>{{ $item->note }}</td>
                            <td>{{ $item->ref_number }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif($table=='cashdraw')
            <table class="table table-bordered kh16-b">
                <thead style="text-align:center;">
                    <th>ID</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>មកពីដៃគូ</th>
                    <th>ទឹកប្រាក់បើក</th>
                    <th>កាត់សេវ៉ា</th>
                    <th>ប្រភេទទូទាត់</th>
                    <th>Receiver</th>
                    <th>ផ្សេងៗ</th>
                    <th>Ref_Number</th>
                </thead>
                <tbody>
                     @php
                        $t_amt=0;
                        $t_cutseva=0;
                    @endphp
                    @foreach ($showlink as $key=> $item)
                        @php
                            $t_amt+=$item->amount;
                            $t_cutseva+=$item->customer_charge;
                        @endphp
                        <tr class="kh16" style="text-align:center;">
                            <td>{{ sprintf("%04d",$item->id) }}</td>
                            <td>
                                {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                            </td>
                            <td>{{ $item->user->name }}</td>

                            <td>{{ $item->frompartner->name }}</td>

                            <td style="text-align:right;" title="{{$t_amt}}">{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>

                            <td style="text-align:right;" title="{{$t_cutseva}}">{{ phpformatnumber($item->customer_charge) . ' ' . $item->cuschargecur->shortcut }}</td>
                            <td>{{ $item->paymethod }}</td>
                            <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                            <td>{{ $item->note }}</td>
                            <td>{{ $item->ref_number }}</td>

                        </tr>
                    @endforeach
                    <tr style="background-color:aqua;">
                            <td colspan=4>Total</td>
                            <td style="text-align:right;">{{phpformatnumber($t_amt) . ' ' . $arrvar['curshortcut']}}</td>
                            <td></td>
                            <td style="text-align:right;">{{phpformatnumber($t_cutseva) . ' ' . $arrvar['curshortcut']}}</td>
                        </tr>
                </tbody>
            </table>
        @elseif($table=='exchangemultis')
            <table class="table table-bordered kh16-b">
                <thead style="text-align:center;">
                    <th>ID</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>ទិញចូល</th>
                    <th>អត្រា</th>
                    <th>លក់ចេញ</th>

                </thead>
                <tbody>
                    @foreach ($showlink as $key=> $item)
                        <tr class="kh16" style="text-align:center;">
                            <td>{{ sprintf("%04d",$item->id) }}</td>
                            <td>
                                {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>

                            <td>{{ phpformatnumber($item->rate) }}</td>

                            <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif($table=='exchanges')
            <div class="tableFixHead">
                <table class="table table-bordered table-hover kh16-b">
                    <thead style="text-align:center;">
                        <th>ID</th>
                        <th>ថ្ងៃទី</th>
                        <th>អ្នកកត់ត្រា</th>
                        <th>រូបិយប័ណ្ណ</th>
                        <th>អត្រា</th>
                        <th>ទឹកប្រាក់</th>

                    </thead>
                    <tbody>
                        @php
                            $t_amt=0;
                            $t_product=0;
                        @endphp
                        @foreach ($showlink as $key=> $item)
                            @php
                                $t_product+=$item->product;
                                $t_amt+=$item->amount;
                            @endphp
                            <tr class="kh16" style="text-align:center;">
                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                <td>
                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td title="{{ phpformatnumber($t_product) }}" style="text-align:right;@if($item->product>0)color:blue; @else color:red; @endif">{{ phpformatnumber($item->product) . ' ' . $item->pcur }}</td>

                                <td>{{ phpformatnumber($item->rate) }}</td>

                                <td title="{{ phpformatnumber($t_amt) }}" style="text-align:right;@if($item->amount>0)color:blue; @else color:red; @endif">{{ phpformatnumber($item->amount) . ' ' . $item->maincur }}</td>
                            </tr>
                        @endforeach
                         <tr style="background-color:aqua;">
                            <td colspan=3>Total</td>
                            <td style="text-align:right;">{{phpformatnumber($t_product) . ' ' .  $arrvar['curshortcut']}}</td>
                            <td></td>
                            <td style="text-align:right;">{{phpformatnumber($t_amt) . ' ' .  $arrvar['curshortcut']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>


@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text({!! json_encode($title) !!});

        function tableFixedhead(h)
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
            var fromdate=new Date($('#fromdate').val());
            var todate=new Date($('#todate').val());
            var today=new Date();
            $('#fromdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:fromdate,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:fromdate,

            });
             $('#todate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:todate,
                format:'d-m-Y',
                autoclose:true,
                todateBtn:true,
                startDate:todate,

            });
            tableFixedhead(200);
            $(window).resize(function() {
                tableFixedhead(200);
            });
            $(document).on('click','.table td',function(e){
              // Remove previous highlight class
              $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
              // add highlight to the parent tr of the clicked td
              $(this).parent('tr').addClass("clickedrow");
          })
          $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var d1=$('#fromdate').val();
                var d2=$('#todate').val();
                var userid=$('#userid').val();
                var curid=$('#curid').val();
                var table=$('#btnshow').attr('title');
                var ismain=$('#ismain').val();
                var seltype=$('#seltype').val();
                var cur=$('#cur').val();
                var url="{{ route('usercapital.linkdetailsearch') }}";

                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {fromdate:d1,todate:d2,userid:userid,curid:curid,tablename:table,ismain:ismain,cur:cur,seltype:seltype},
                    //contentType: 'text/plain',
                    //contentType: false,
                    //processData: true,
                    //cache: false,
                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                        $('#rowdisplay').empty().html(data);
                        $('#totalamount').text($('#totalsearchamount').text());

                        $('body').removeClass("wait");

                    },
                    error: function () {
                        alert('Read Data Error.')
                        $('body').removeClass("wait");
                    }
                })
            })

        })
    </script>
@endsection
