@extends('master')
@section('title')See Partner List @endsection
@section('css')
    <style type="text/css">
        body.wait, body.wait *{
			cursor: wait !important;
		}
        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white}

        #selcustomer1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:47px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white}

        #selcustomer2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:47px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white}

        #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;background-color:white}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;}
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
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh26-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:26px;
            font-weight:bold;
            }
        .kh26{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:26px;
            }
        .kh30{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
            }
        .kh32-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:32px;
            font-weight:bold;
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
       #tbl_partner_list .clickedrow td{
        background-color: #caaf8f;
    }
    #tblsearchmore td{
        border-style:none;
    }
    #tbl_after_total_we td{
      padding:2px;
    }
    #tbl_after_total_we .clickedrow td{
        background-color: #caaf8f;
    }
    #tbl_after_total_they td{
      padding:2px;
    }
    #tbl_after_total_they .clickedrow td{
        background-color: #caaf8f;
    }

    #tbl_before_total_we td{
      padding:2px;
    }
    #tbl_before_total_we .clickedrow td{
        background-color: #caaf8f;
    }
    #tbl_before_total_they td{
      padding:2px;
    }
    #tbl_before_total_they .clickedrow td{
        background-color: #caaf8f;
    }
    #tbl_delcloselist1 .clickedrow td{
        background-color: #caaf8f;
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
        $tusd=0;
        $tkhr=0;
        $tthb=0;
        $tvnd=0;
    @endphp
    <div class="row" style="margin:-15px 10px 10px 5px;">
        <table>
            <tr>
                <td class="kh16-b">បញ្ជីដៃគូ {{ $partnername }}</td>
            </tr>
        </table>
    </div>

    <div class="row" style="">
        <table id="tbl_partner_list" class="table table-bordered table-hover" style="table-layout:fixed;">
            <thead style="text-align:center;" class="kh14">
                <th style="padding:0px;width:60px;">លរ</th>
                <th style="padding:0px;width:80px;">ID</th>
                <th style="padding:0px;width:150px;">ថ្ងៃទី</th>
                <th style="padding:0px;width:200px;">ប្រតិបត្តិការណ៏</th>
                <th style="padding:0px;width:120px;">USD</th>
                <th style="padding:0px;width:120px;">KHR</th>
                <th style="padding:0px;width:120px;">THB</th>
                <th style="padding:0px;width:150px;">VND</th>
                <th style="padding:0px;width:120px;">GroupID</th>
                <th style="padding:0px;width:400px;">ផ្សេងៗ</th>
            </thead>
            <tbody id="bodytransfer">
                @foreach ($ptls_new as $key =>$l)
                    @php
                        $tusd+=$l->usd;
                        $tkhr+=$l->khr;
                        $tthb+=$l->thb;
                        $tvnd+=$l->vnd;
                    @endphp
                    <tr style="">
                        <td class="kh14" style="text-align:center;padding:0px;width:80px;">{{ ++$key }}</td>
                        <td class="kh14" style="text-align:center;padding:0px;width:80px;">
                                @if($l->tranid)
                                    @if($linkdetail=='true')
                                        <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse">  {{ $l->tranid??'' }}</a>
                                    @else
                                        {{ $l->tranid??'' }}
                                    @endif
                                @else
                                    {{ $l->tranid??'' }}
                                @endif
                        </td>
                        <td class="kh14" style="padding:0px 5px 0px 5px;width:180px;">{{ date('d-m-Y',strtotime($l->trandate)) }} {{ $l->trantime }}</td>
                        <td class="kh14" style="padding:0px;">
                            @if($l->amount>0)
                                {{ $l->tranname }} ({{ $l->rectel}})
                            @else
                                {{ $l->tranname }} ({{ $l->sendertel}})
                            @endif
                        </td>
                        <td style="text-align:right;padding:0px;width:150px;" class="kh14-b @if($l->usd>0) cred @else cblue @endif"> {{ $l->usd<>0?phpformatnumber(-1 * $l->usd) .'$':'' }}</td>
                        <td style="text-align:right;padding:0px;width:150px;" class="kh14-b @if($l->khr>0) cred @else cblue @endif">{{ $l->khr<>0?phpformatnumber(-1 * $l->khr) .'R':''}}</td>
                        <td style="text-align:right;padding:0px;width:150px;" class="kh14-b @if($l->thb>0) cred @else cblue @endif">{{ $l->thb<>0?phpformatnumber(-1 * $l->thb) .'B':''}}</td>
                        <td style="text-align:right;padding:0px;width:150px;" class="kh14-b @if($l->vnd>0) cred @else cblue @endif">{{ $l->vnd<>0?phpformatnumber(-1 * $l->vnd) .'D':''}}</td>
                        <td class="kh14" style="text-align:center;padding:0px;width:120px;">
                            @if($l->ref_group_id)
                                @if($linkdetail=='true')
                                    <a href="#group{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                @endif
                            @endif
                        </td>
                        <td class="kh14" style="padding:0px 0px 0px 5px;">
                            {{ $l->note }}
                        </td>
                    </tr>
                    @if($linkdetail=='true')
                        @if($l->tranid)
                            @foreach (App\PartnerTransfer::showbyid($l->tranid) as $item)
                                <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                    <td colspan=11>
                                        <table class="table-bordered" style="margin:0px;">
                                            <thead style="text-align:center;">
                                                <th>ថ្ងៃទី</th>
                                                <th>អ្នកកត់ត្រា</th>
                                                <th>ដៃគូ</th>
                                                <th>TID</th>
                                                <th>ប្រតិបត្តិការណ៏</th>
                                                <th>សរុបទឹកប្រាក់</th>
                                                <th>សេវ៉ា/ការប្រាក់</th>
                                                <th>សេវ៉ាអតិថិជន</th>
                                                <th>Receiver</th>
                                                <th>Sender</th>
                                                <th>ផ្សេងៗ</th>
                                                <th>ថ្ងៃកត់ត្រា</th>
                                            </thead>
                                            <tbody>
                                                <tr class="kh12-b" style="text-align:center;">
                                                    <td>
                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                    </td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->partner->name }}</td>
                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                    <td>{{ $item->tranname }}</td>
                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                    <td>
                                                    @if($item->fee && $item->fee<>0)
                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                    @endif
                                                    @if($item->interest && $item->interest<>0)
                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                    @endif
                                                    </td>
                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                    <td>{{ $item->note }}</td>
                                                    <td>
                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        @if($l->ref_group_id)
                            @php
                                $countdata=0;
                                $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                if($datarefs){
                                    $countdata=1;
                                }
                            @endphp
                            @if($countdata>0)
                                    @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>TID</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>សរុបទឹកប្រាក់</th>
                                                        <th>សេវ៉ា/ការប្រាក់</th>
                                                        <th>សេវ៉ាអតិថិជន</th>
                                                        <th>Receiver</th>
                                                        <th>Sender</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->partner->name }}</td>
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>
                                                                    @if($item->fee && $item->fee<>0)
                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                    @endif
                                                                    @if($item->interest && $item->interest<>0)
                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រា</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                        <th>បរិយាយ</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->useraffect->name }}</td>
                                                                <td>{{ $item->tranname }}</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>TID</th>
                                                        <th>ថ្ងៃបើក</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូ</th>
                                                        <th>ប្រតិបត្តិការណ៏</th>
                                                        <th>ចំនួនទឹកប្រាក់</th>
                                                        <th>កាត់សេវ៉ា</th>
                                                        <th>អ្នកទទួលប្រាក់</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->frompartner->name }}</td>
                                                                <td>បើកវេរ</td>
                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                        <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                            <td colspan=11>
                                                <table class="table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th>ID</th>
                                                        <th>ថ្ងៃទី</th>
                                                        <th>អ្នកកត់ត្រា</th>
                                                        <th>ដៃគូកាត់កង</th>
                                                        <th>ទិញ</th>
                                                        <th>លក់</th>
                                                        <th>អត្រាព្រមព្រាង</th>
                                                        <th>អត្រាគោល</th>
                                                        <th>ផ្សេងៗ</th>
                                                        <th>ថ្ងៃកត់ត្រា</th>

                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datarefs as $item)
                                                            <tr class="kh12-b" style="text-align:center;">
                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->partner->name }}</td>
                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                <td>{{ $item->note }}</td>
                                                                <td>
                                                                    {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif
                            @endif
                        @endif
                    @endif
                @endforeach
                <tr style="background-color:aqua">
                    <td colspan=4 class="kh16-b" style="color:black;padding:2px 5px 2px 20px;">សរុប</td>
                    <td style="text-align:right;padding:2px;font-family:Arial, Helvetica, sans-serif;font-weight:bold;" class="kh16-b @if($tusd>=0) cred @else cblue @endif">{{ $tusd<>0?phpformatnumber(-1 * $tusd) . '$':'' }}</td>
                    <td style="text-align:right;padding:2px;font-family:Arial, Helvetica, sans-serif;font-weight:bold;" class="kh16-b @if($tkhr>=0) cred @else cblue @endif">{{ $tkhr<>0?phpformatnumber(-1 * $tkhr) .'R':''}}</td>
                    <td style="text-align:right;padding:2px;font-family:Arial, Helvetica, sans-serif;font-weight:bold;" class="kh16-b @if($tthb>=0) cred @else cblue @endif">{{ $tthb<>0?phpformatnumber(-1 * $tthb) .'B':''}}</td>
                    <td style="text-align:right;padding:2px;font-family:Arial, Helvetica, sans-serif;font-weight:bold;" class="kh16-b @if($tvnd>=0) cred @else cblue @endif">{{ $tvnd<>0?phpformatnumber(-1 * $tvnd) .'D':''}}</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row" style="margin:0px 10px 0px 10px;">
        <div class="col-lg-6">
            @php
                $weusd=0;
                $wethb=0;
                $wekhr=0;
                $wevnd=0;
                foreach($befortotalwe as $w){
                    if($w->cur=='USD'){
                        $weusd=$w->total;
                    }else if($w->cur=='THB'){
                        $wethb=$w->total;
                    }else if($w->cur=='KHR'){
                        $wekhr=$w->total;
                    }else if($w->cur=='VND'){
                        $wevnd=$w->total;
                    }
                }

                $theyusd=0;
                $theythb=0;
                $theykhr=0;
                $theyvnd=0;
                foreach($befortotalthey as $they){
                    if($they->cur=='USD'){
                        $theyusd=$they->total;
                    }else if($they->cur=='THB'){
                        $theythb=$they->total;
                    }else if($they->cur=='KHR'){
                        $theykhr=$they->total;
                    }else if($they->cur=='VND'){
                        $theyvnd=$they->total;
                    }
                }
            @endphp
            <table id="tbl_before" class="table table-bordered table-hover tbl_before">
                <tr>
                    <td colspan=2 style="font-family:khmer os muol light;text-align:center;font-size:16px;padding:2px;">មុនទូទាត់</td>
                </tr>
                <tr>
                    <td class="kh16-b" style="text-align:center;">បើកនៅ {{ $logo->name }}</td>
                    <td class="kh16-b" style="text-align:center;">បើកនៅ {{ $partnername }}</td>
                </tr>
                <tr>
                    <td class="kh16-b" style="text-align:right;color:blue;">
                        {{ phpformatnumber(abs($weusd)) . ' USD' }}
                    </td>
                    <td class="kh16-b" style="text-align:right;color:red;">
                        {{ phpformatnumber(abs($theyusd)) . ' USD' }}
                    </td>
                </tr>
                <tr>
                    <td class="kh16-b" style="text-align:right;color:blue;">
                        {{ phpformatnumber(abs($wethb)) . ' THB' }}
                    </td>
                    <td class="kh16-b" style="text-align:right;color:red;">
                        {{ phpformatnumber(abs($theythb)) . ' THB' }}
                    </td>
                </tr>
                <tr>
                    <td class="kh16-b" style="text-align:right;color:blue;">
                        {{ phpformatnumber(abs($wekhr)) . ' KHR' }}
                    </td>
                    <td class="kh16-b" style="text-align:right;color:red;">
                        {{ phpformatnumber(abs($theykhr)) . ' KHR' }}
                    </td>
                </tr>
                <tr>
                    <td class="kh16-b" style="text-align:right;color:blue;">
                        {{ phpformatnumber(abs($wevnd)) . ' VND' }}
                    </td>
                    <td class="kh16-b" style="text-align:right;color:red;">
                        {{ phpformatnumber(abs($theyvnd)) . ' VND' }}
                    </td>
                </tr>
            </table>

        </div>
        <div class="col-lg-6">
            @php
                $usd1=0;
                $thb1=0;
                $khr1=0;
                $vnd1=0;
                $usd2=0;
                $thb2=0;
                $khr2=0;
                $vnd2=0;
                foreach($aftertotal as $a){
                    if($a->cur=='USD'){
                        if($a->total>0){
                            $usd2=$a->total;
                        }else{
                            $usd1=$a->total;
                        }

                    }else if($a->cur=='THB'){
                        if($a->total>0){
                            $thb2=$a->total;
                        }else{
                            $thb1=$a->total;
                        }
                    }else if($a->cur=='KHR'){
                        if($a->total>0){
                            $khr2=$a->total;
                        }else{
                            $khr1=$a->total;
                        }
                    }else if($a->cur=='VND'){
                        if($a->total>0){
                            $vnd2=$a->total;
                        }else{
                            $vnd1=$a->total;
                        }
                    }
                }
            @endphp

            <table id="tbl_after" class="table table-bordered table- tbl_after">
                <tr>
                    <td colspan=2 style="font-family:khmer os muol light;text-align:center;font-size:16px;padding:2px;">ក្រោយទូទាត់</td>
                </tr>
                <tr>
                    <td class="kh16-b" style="text-align:center;">នៅខ្វះ {{ $logo->name }}</td>
                    <td class="kh16-b" style="text-align:center;">នៅខ្វះ {{ $partnername }}</td>
                </tr>
                <tr>
                    <td class="kh16-b" style="text-align:right;color:blue;">
                        {{ phpformatnumber(abs($usd1)) . ' USD' }}
                    </td>
                    <td class="kh16-b" style="text-align:right;color:red;">
                        {{ phpformatnumber(abs($usd2)) . ' USD' }}
                    </td>
                </tr>
                <tr>
                    <td class="kh16-b" style="text-align:right;color:blue;">
                        {{ phpformatnumber(abs($thb1)) . ' THB' }}
                    </td>
                    <td class="kh16-b" style="text-align:right;color:red;">
                        {{ phpformatnumber(abs($thb2)) . ' THB' }}
                    </td>
                </tr>
                <tr>
                    <td class="kh16-b" style="text-align:right;color:blue;">
                        {{ phpformatnumber(abs($khr1)) . ' KHR' }}
                    </td>
                    <td class="kh16-b" style="text-align:right;color:red;">
                        {{ phpformatnumber(abs($khr2)) . ' KHR' }}
                    </td>
                </tr>
                <tr>
                    <td class="kh16-b" style="text-align:right;color:blue;">
                        {{ phpformatnumber(abs($vnd1)) . ' VND' }}
                    </td>
                    <td class="kh16-b" style="text-align:right;color:red;">
                        {{ phpformatnumber(abs($vnd2)) . ' VND' }}
                    </td>
                </tr>
            </table>

        </div>
    </div>



@endsection

