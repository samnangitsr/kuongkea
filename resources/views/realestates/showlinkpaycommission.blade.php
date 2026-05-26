@extends('master')
@section('title') ពិនិត្យក្រុមកម្រៃជើងសារ @endsection
@section('css')
<link rel="stylesheet" tyle="text/css" href="{{ config('helper.asset_path') }}/css/virtual-select.min.css">
    <style type="text/css">
        body.wait, body.wait *{
			cursor: wait !important;
		}


    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;}
		/* Each result */
	#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selsaler + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selsaler-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #sel_property + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-sel_property-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selbank + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selbank-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 30px !important;
        }
        .select2-container .select2-selection--single {
            height: 30px !important;
            background-color:white;
        }
        .select2-selection__arrow {
            height: 30px !important;
        }
        .en12{
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            }
        .en12-b{
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
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
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            }
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            }
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            font-weight:bold;

            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .en16{
            font-family: Arial, Helvetica, sans-serif;
            font-size:16px;
        }
        .en16-b{
            font-family: Arial, Helvetica, sans-serif;
            font-size:16px;
            font-weight:bold;
        }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        .modalleft{
            margin-left:0;
            margin-top:0;
        }
        .modalright{
            margin-top:0;
            margin-right:0;
        }
        ul.ui-autocomplete {
            z-index: 1100;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
        }
        #tbl_partner input[type='text']:focus {
            background-color: yellow;
        }
        #tbl_partner td{
            padding:2px;
            border-style:none;
       }

       input.blue{
        color:blue;
       }
       input.red{
        color:red;
       }

       th{
        word-wrap: break-word;
       }
       hr.new2 {
        border-top: 1px dashed brown;
        margin:5px;
        }

        /* Dotted red border */
        hr.new3 {
        border-top: 1px dotted brown;
        margin:5px;
        }
       #divfooter{
        /* margin:0px; */
        color:white;
        padding:0px 20px 0px 0px;
        position: fixed;
        bottom: 0;
        width: 84.5%;
        min-height: 98px;
        max-height: 98px;
        /* background-color: inherit; */
        background-color:rgb(201, 214, 218);
        color: white;
        height : 98px;
        overflow:auto;
        clear: both;
        }
        .tableFixHead{ overflow: auto;border:1px solid blue;}
        .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }


        .tableFixHead1{ overflow: auto;background-color:rgb(237, 240, 48);}
        .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tbl_checkamt td{
          word-wrap: break-word;
          padding:2px 5px 2px 5px;
        }
        .tbl_transferlist td{
          word-wrap: break-word !important;
          padding:2px 5px 2px 5px;
        }
        .tbl_transferlist .clickedrow td,
        .tbl_transferlist .clickedrow input,
        .tbl_transferlist .clickedrow td > a
        {
            background-color: blue;
            color:white !important;
        }

        .tbl_transferlist th{
            padding:2px;
            border:1px solid black;
            background-color:silver;
        }
        .button1:hover {
                background-color: #8fe9c8;
                color: rgb(19, 57, 230);

            }
        .button1{
            border:none;
            background-color:inherit;
            padding:2px 5px;
            border:1px solid gray;
        }
        #tbl_partner input[type='text']:focus {
            background-color: yellow;
            }
        #tablemultiexchange th{
            padding:3px;
        }

        #tablemultiexchange td{
            padding:3px;
        }
        .mybtn{
            border:1px solid black;
        }
        .mybtn:hover{
            background-color:#8fe9c8;
        }
        #tbl_sale_detail td{
            border:1px solid blue;
            padding:4px 5px;
        }
        #tbl_sale_detail th{
            border:1px solid blue;
            padding:4px;
            background-color:aquamarine;
        }
        .btnremoveitem:hover{
            background-color:yellow;
        }
        .btnremoveitem{

            padding:5px 10px;
            border:1px solid black;
        }
        ul.ui-autocomplete {
            z-index: 1100;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
        }
        .mybtn{
            border:1px solid black;
            padding:2px 5px;
        }
        .mybtn:hover{
            background-color:#8fe9c8;
        }
        .c_orange{
            background-color:orange;
        }
        .c_yellow{
            background-color:yellow;
        }
        .c_red{
            background-color:red;
            color:white;
        }
        #mytable td{
            border:1px solid black;
        }
        #tbl_total th{
            border:1px solid black;
            padding:3px;
        }
        #tbl_total td{
            border:1px solid black;
            padding:3px;
        }
       .modal-dialog-slide-up {
        position: fixed;
        bottom: 0;
        margin: 0;
        left:40%;
        width: 100%;
        max-width: 600px;
        transition: transform 0.3s ease-out;
        }

        .modal.fade .modal-dialog-slide-up {
        transform: translateY(100%);
        }

        .modal.show .modal-dialog-slide-up {
        transform: translateY(0);
        }

        .cursor-move {
        cursor: move;
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

   <div id="rowdisplay">
        <div class="row" style="margin-top:0px;">

               <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                   <thead style="text-align:center;" class="kh16">
                        <th style="width:60px;">No</th>
                        <th style="width:100px;">ID</th>
                        <th style="width:120px;">GroupID</th>

                        <th style="width:120px;">ថ្ងៃទី</th>
                        <th style="width:150px;">អ្នកកត់ត្រា</th>
                        <th style="width:200px;">អតិថិជន</th>

                        <th style="width:200px;">បរិយាយ</th>
                        <th style="width:150px;">ចំនួនទឹកប្រាក់</th>

                        <th style="width:150px;">អចលនទ្រព្យ</th>
                        <th style="width:150px;">បង់សំរាប់ខែ</th>


                   </thead>
                   <tbody id="body_transaction">
                        @foreach ($transfers as $key => $item)
                            <tr class="kh14-b">
                                <td style="text-align:center;">{{ ++$key }}</td>
                                <td style="color:red;">{{ $item->id }}</td>
                                <td style="">
                                    <a href="#c{{ $item->ref_group_id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse">{{ explode('-',$item->ref_group_id)[1] }}</a>
                                </td>
                                <td>{{ date('d-m-Y',strtotime($item->dd)) }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->partner->name }}</td>
                                <td>{{ $item->tranname }}</td>
                                <td style="text-align:right;color:blue;">{{ phpformatnumber($item->amount)}} {{ $item->currency->shortcut }}</td>
                                <td>{{ $item->sendername }}
                                <td>{{ date('d-m-Y',strtotime($item->payformonth)) }}

                            </tr>
                            <tr id="c{{ $item->ref_group_id }}" class="collapse borderset2" style="">
                                <td colspan=10 style="background-color:antiquewhite;">
                                    <table class="kh12-b" style="margin:0px 0px 2px 0px;" >
                                         <thead style="text-align:center;" class="kh12">
                                                <th style="width:60px;">No</th>
                                                <th style="width:100px;">ID</th>
                                                <th style="width:120px;">ថ្ងៃទី</th>
                                                <th style="width:150px;">អ្នកកត់ត្រា</th>
                                                <th style="width:200px;">អតិថិជន</th>
                                                <th style="width:200px;">បរិយាយ</th>
                                                <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                                                <th style="width:150px;">អចលនទ្រព្យ</th>
                                                <th style="width:150px;">បង់សំរាប់ខែ</th>
                                        </thead>
                                        <tbody>
                                            @foreach (App\PartnerTransfer::showbygroupall($item->ref_group_id) as $k => $trf)
                                                <tr>
                                                   <td style="text-align:center;">{{ ++$k }}</td>
                                                    <td style="color:red;">{{ $trf->id }}</td>
                                                    <td>{{ date('d-m-Y',strtotime($trf->dd)) }}</td>
                                                    <td>{{ $trf->user->name }}</td>
                                                    <td>{{ $trf->partner->name }}</td>
                                                    <td>{{ $trf->tranname }}</td>
                                                    <td style="text-align:right;color:blue;">{{ phpformatnumber($trf->amount)}} {{ $trf->currency->shortcut }}</td>
                                                    <td>{{ $trf->sendername }}
                                                    <td>{{ date('d-m-Y',strtotime($trf->payformonth)) }}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
        $('#h1_title').text('ពិនិត្យកម្រៃជើងសារដែលបានបង់រួច');
        $(document).ready(function () {
            $(document).on('click','.tbl_transferlist td',function(e){
                  // Remove previous highlight class
                  $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                  // add highlight to the parent tr of the clicked td
                  $(this).parent('tr').addClass("clickedrow");
              })
        })
    </script>


@endsection
