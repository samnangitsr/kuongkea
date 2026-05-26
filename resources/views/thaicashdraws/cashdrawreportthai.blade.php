@extends('master')
@section('title') Thai Cashdraw Report @endsection
@section('css')
    <style type="text/css">
      body.wait *{
			cursor: wait !important;
		}
    .select2-container--default .select2-results>.select2-results__options{max-height: 360px !important;}
    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:whitesmoke;}
		/* Each result */
	#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:20px;background-color:white}

    #selpartner_continue + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:whitesmoke;}
		/* Each result */
	#select2-selpartner_continue-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
    #selpartner_continue_2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:whitesmoke;}
		/* Each result */
	#select2-selpartner_continue_2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

    #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
		/* Each result */
	#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}


    .bankid + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
      /* Search field */
      .select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 38px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            background-color:rgb(230, 245, 240);
        }
        .select2-selection__arrow {
            height: 35px !important;
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
       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }
       .txtexchangefix{
        padding:2px;
        font-weight:bold;
        font-size:16px;
        text-align:right;
       }
       .cgr{
        background-color:aquamarine;
       }
       .photo > input[type='file']{
			/* display:none; */
		}
		.photo{
			width:30px;
			height:30px;
			border-radius:100%;
		}
    .tableFixHead{ overflow: auto;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }

    .tbl_usertransaction td{
      word-wrap: break-word;
      padding:2px 5px 2px 5px;
    }
    #tblsearchmore td{
        border-style:none;
    }
    #tbl_bankpayment0 td{
        word-wrap:break-word;
    }
    .ui-autocomplete {
        position: fixed;
        z-index: 1511;
        font-size:18px;
        font-weight:bold;
    }
    .ui-autocomplete-input{
      border: none;
      margin-bottom: 5px;
      border:1px solid #c8c6c6 !important;
      z-index:1511;
    }
    .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }

       input.blue{
        color:blue;
       }
       input.red{
        color:red;
       }
      #tbl_amount td{
        padding:2px;
        border-style:none;
       }
       #tbl_partner td{
        padding:2px 0px 0px 0px;
        border-style:none;
       }
       #tbl_exchange td{
        padding:2px;
        border-style:none;
       }
       #tbl_continue_partner td{
        padding:2px;
        border-style:none;
       }
       #tbl_notyetcashdraw td{
        padding:2px;
       }
       #tbl_notyetcashdraw th{
        padding:2px;
       }
       #tbl_cashdraw td{
        padding:2px;
       }
       #tbl_cashdraw th{
        padding:2px;
       }
       #tbl_child td{
        border-style:none;
       }
       #tblchildren .clickedrow td{
        background-color: #caaf8f;
       }
       #tbl_cashdraw .clickedrow td{
        background-color:blue;
        color:white;
       }
       #tbl_cashdraw .clickedrow td > a{
        background-color:blue;
        color:white;
       }
       #tbl_notyetcashdraw .clickedrow td{
        background-color: blue;
        color:white;
       }
       #tbl_notyetcashdraw .clickedrow td > a{
        background-color: blue;
        color:white;
       }
       #tbl_bankcashdraw .clickedrow td{
        background-color:yellowgreen;
       }
       #tblclearclick .clickedrow td{
        background-color: #caaf8f;
       }
       tr.borderset1{
            border-top:2px solid gray;
            border-left:2px solid gray;
            border-right:2px solid gray;

        }
        tr.borderset2{

            border-bottom:2px solid gray;
            border-left:2px solid gray;
            border-right:2px solid gray;
        }
        #tbl_continue_partner td{
            padding:0px;
        }
       #tbl_notyetcashdraw tr:hover {background-color:lightgray;}
       #tbl_cashdraw tr:hover {background-color:rgb(136, 245, 103);}
       #divfooter{
        /* margin-right:50px; */
        color:white;
        padding:5px;
        position: fixed;
        bottom: 0;
        width: 100%;
        min-height: 50px;
        max-height: 50px;
        /* background-color: inherit; */
        background-color:rgb(201, 214, 218);
        color: white;
        height : 50px;
        overflow:auto;
        clear: both;
        }
        li > a:hover{
            background-color:blue;
            color:white;
            padding:5px;

        }
        .mybtn{
            border:1px solid black;
            padding:3px 10px;
        }
        .mybtn:hover {
            background-color: #8fe9c8;
            color: rgb(19, 57, 230);
        }
        #tbl_modalwingcode td{
            padding:0px;
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
    <div class="row" style="margin-top:-20px;">
        <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
        <div class="table-responsive">
            <table class="table">
                <tr class="kh16-b">
                    <th style="border-style:none;">គិតពី</th>
                    <th style="border-style:none;">ដល់</th>
                </tr>
                <tr>
                    <td style="padding:0px;border-style:none;width:170px;">
                        <div class="input-group" style="width:170px;">
                            <input type="text" name="d1" id="d1" class="form-control kh16-b" style="width:110px;height:30px;background-color:silver;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                    </td>
                    <td style="padding:0px;border-style:none;width:170px;">
                        <div class="input-group" style="width:170px;">
                            <input type="text" name="d2" id="d2" class="form-control kh16-b" style="width:110px;height:30px;background-color:silver;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td style="padding:0px;border-style:none;width:150px;">
                        <select name="selsearchby" id="selsearchby" class="kh16-b" style="height:30px;width:150px;">
                            <option value=""></option>
                            <option value="time">ម៉ោងសារថៃ</option>
                            <option value="tel">លេខទូរស័ព្ទ</option>
                            <option value="amt">ចំនួនទឹកប្រាក់</option>
                        </select>
                    </td>
                    <td id="tdsearchbytime" style="padding:0px;border-style:none;width:200px;">
                        <input type="text" id="txtsearchbytime" class="form-control kh16-b" style="width:200px;height:30px;" title="" placeholder="searchbytime">
                    </td>
                    <td id="tdsearchbytel" style="padding:0px;border-style:none;width:200px;">
                        <input type="text" id="txtsearchbytel" class="form-control kh16-b" style="width:100%;height:30px;"  placeholder="searchbytel">
                    </td>
                    <td id="tdsearchbyamt1" style="padding:0px;border-style:none;width:200px;">
                        <input type="text" id="txtsearchbyamt1" class="form-control kh16-b" style="width:100%;height:30px;" placeholder="from amount">
                    </td>
                    <td id="tdsearchbyamt2" style="padding:0px;border-style:none;width:200px;">
                        <input type="text" id="txtsearchbyamt2" class="form-control kh16-b" style="width:100%;height:30px;" placeholder="from amount">
                    </td>

                    <td style="padding:0px;border-style:none;">
                        <button class="mybtn" id="btnsearch">Search</button>
                    </td>
                </tr>

            </table>
        </div>
    </div>

    <div class="tableFixHead" id="cashdrawandnotyet" style="padding:0px;margin:0px;">

    </div>
    <div class="" style="">
        <table class="table">
            <tr>
                <td class="kh22-b" id="totalamount"></td>
                <td class="kh22-b" id="totalcutseva"></td>
                <td class="kh22-b" id="totalaftercut"></td>
            </tr>
        </table>
    </div>

    @include('thaicashdraws.seephoto_modal')
@endsection
@section('script')
    <script type="text/javascript">
        $('#h1_title').text('របាយការណ៏បើកវេរលុយថៃ');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-263;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }

      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-263;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
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
        function formatOption1(option) {
				if (!option.id) {
					return option.text;
				}
				// Use a <div> to display the main text and a second line
         // option.element.value is get value from select

				var $option = $(
					'<div class="select2-option1">' +
						'<div class="select2-option-main">' + option.text + '</div>' +
						'<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('customertype') : option.element.getAttribute('customertype')) + '</div>' +
					'</div>'
				);
				return $option;
			}
            $(document).ready(function () {
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
                var cleave = new Cleave('#txtsearchbyamt1', {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
                var cleave = new Cleave('#txtsearchbyamt2', {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
                $(document).on('click','#tbl_cashdraw td,#tbl_notyetcashdraw td',function(e){
                    // Remove previous highlight class
                    $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                    // add highlight to the parent tr of the clicked td
                    $(this).parent('tr').addClass("clickedrow");
                })
                $('#tdsearchbytel').hide();
                $('#tdsearchbyamt1').hide();
                $('#tdsearchbyamt2').hide();
                $('#tdsearchbytime').hide();
                $(document).on('change','#selsearchby',function(e){
                    e.preventDefault();
                    var searchby=$(this).val();
                    $('#tdsearchbytel').hide();
                    $('#tdsearchbyamt1').hide();
                    $('#tdsearchbyamt2').hide();
                    $('#tdsearchbytime').hide();
                    if(searchby=='tel'){
                        $('#tdsearchbytel').show();
                    }else if(searchby=='amt'){
                        $('#tdsearchbyamt1').show();
                        $('#tdsearchbyamt2').show();
                    }else if(searchby=='time'){
                        $('#tdsearchbytime').show();
                    }
                })
                $(document).on('click', '.btnseephoto', function (e) {
                    e.preventDefault();
                    $('body').addClass("wait");
                    var id = $(this).data('id');
                    $('#seephoto_modal').modal('show');
                    var url = "{{ route('thaicashdraw.seephoto') }}";
                    $.ajax({
                        async: true,
                        type: 'GET',
                        url: url,
                        data: { id: id,type:'th' },
                        success: function (data) {
                            console.log(data);
                            if ($.isEmptyObject(data.error)) {
                                var item = data['cashdraw_photoes'];
                                var thimg = '';

                                // Clear existing content
                                $('#thead_img1').empty();
                                $('#zoomImage').attr('src','');
                                for (let i = 0; i < item.length; i++) {
                                    thimg += `
                                        <th>
                                            <div class="img-container">
                                                <img src="{{ config('helper.asset_path')}}/myimages/${item[i].imgpath}" alt="">
                                                <a href="" data-imgpath="${item[i].imgpath}" class="mybtn seebig-btn">View 100%</a>
                                            </div>
                                        </th>
                                    `;
                                }

                                $('#thead_img1').append(thimg);
                                $('body').removeClass("wait");
                            } else {
                                $('body').removeClass("wait");
                                alert(data.error);
                            }
                        },
                        error: function () {
                            $('body').removeClass("wait");
                            alert('Read Error.');
                        }
                    });
                });
                $(document).on('click','#btnsearch',function(e){
                    e.preventDefault()
                    search_cashdraw();
                })
                function search_cashdraw()
                {
                    $('body').addClass("wait");
                    var d1=$('#d1').val();
                    var d2=$('#d2').val();
                    var tel=$('#txtsearchbytel').val().replace(/\s+/g, '');
                    var amt1=$('#txtsearchbyamt1').val().replace(/,/g, '');
                    var amt2=$('#txtsearchbyamt2').val().replace(/,/g, '');
                    var searchby=$('#selsearchby').val();
                    var url="{{ route('thaicashdraw.searchcashdrawreport') }}";
                    $.ajax({
                        async: true,
                        type: 'GET',
                        url: url,
                        data: {d1:d1,d2:d2,searchby:searchby,tel:tel,amt1:amt1,amt2:amt2},
                        success: function (data) {
                            //console.log(data)
                            if($.isEmptyObject(data.error)){
                                $('#cashdrawandnotyet').empty().html(data);
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
            })


        function searchTable(val) {
            var filter = val.toUpperCase();
            var table = document.getElementById("tbl_cashdraw");
            var tr = table.getElementsByTagName("tr");
              $('#rowtotal').hide();
            let totalAmount = 0;
            let totalCutseva = 0;
            let total22=0;
            for (let i = 0; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName("td")[10]; // paymethod column
                if (val === 'all') {
                    $('#rowtotal').show();
                    tr[i].style.display = "";
                    td = tr[i].getElementsByTagName("td")[5]; // amount
                } else if (td) {
                    let txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                        continue;
                    }
                }

                // Only sum rows with amount if visible
                if (tr[i].style.display !== "none" && tr[i].classList.contains("rowclick")) {
                    let amount = parseFloat(tr[i].getElementsByTagName("td")[5].textContent.replace(/,/g, '').replace('THB', '').trim()) || 0;
                    let cutseva = parseFloat(tr[i].getElementsByTagName("td")[6].textContent.replace(/,/g, '').trim()) || 0;
                    totalAmount += amount;
                    totalCutseva += cutseva;
                }
            }

            total22=parseFloat(totalAmount)-parseFloat(totalCutseva);
            $("#totalamount").text("Total: " + formatNumber(totalAmount.toFixed(2)) + ' THB' );
            $("#totalcutseva").text("seva: " + formatNumber(totalCutseva.toFixed(2)) + ' THB' );
            $("#totalaftercut").text("Total: " + formatNumber(total22.toFixed(2)) + ' THB' );
        }
    </script>
@endsection
