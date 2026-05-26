@extends('master')
@section('title') Check Partner List @endsection
@section('css')
    <style type="text/css">
        body.wait, body.wait *{
			cursor: wait !important;
		}
    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;background-color:white}

    #selcustomer1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:47px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;background-color:white}

    #selcustomer2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:47px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;background-color:white}

    #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:40px;background-color:white}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;background-color:white;}

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
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;

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
       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }
       .cgr{
        background-color:aquamarine;
       }

    td{
        cursor:default;
    }
    #tbl_we .clicktd{
        background-color: rgb(22, 244, 22) !important;
    }
    #tbl_they .clicktd{
        background-color: rgb(22, 244, 22) !important;
    }
    #tbl_they .clickedrow td{
        background-color: #caaf8f !important;
    }
    #tbl_we .clickedrow td{
        background-color: #caaf8f !important;
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

    #tbl_they td{
      padding:2px 5px 2px 5px;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:16px;
      word-wrap: break-word;
    }
    #tbl_they th{
      padding:5px;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:16px;
      border:1px solid black;
    }
    #tbl_we{
      table-layout:fixed;
    }
    #tbl_they{
      table-layout:fixed;
    }
    #tbl_we td{
      padding:2px 5px 2px 5px;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:16px;
      word-wrap: break-word;
    }
    #tbl_we th{
      padding:5px;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:16px;
      border:1px solid black;
    }
    .tableFixHead          { overflow: auto;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }

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

    <div class="row" style="margin-top:0px;position:fixed;top:60px;z-index:1;">
        <div class="table-responsive">
            <table class="table" style="">
                <tr>
                  <td class="kh30" style="border-style:none;">
                    ផ្ទៀងផ្ទាត់បញ្ជីដៃគូ
                  </td>
                  <td style="border-style:none;">
                    <div class="form-check" style="padding-top:10px;">
                      <label class="form-check-label kh22">
                        <input class="form-check-input kh22" type="checkbox" name="ckalldate" id="ckalldate"> ALL Date
                      </label>
                    </div>
                  </td>
                  <td style="border-style:none;">
                    <div class="form-check" style="padding-top:10px;">
                        <label class="form-check-label kh22">
                          <input class="form-check-input kh22" type="checkbox" name="ckoldlist" id="ckoldlist" checked> Old List
                        </label>
                    </div>
                  </td>
                  <td style="border-style:none;">
                    <div class="form-check" style="padding-top:10px;">
                        <label class="form-check-label kh22">
                          <input class="form-check-input kh22" type="checkbox" name="ckbalancesheet" id="ckbalancesheet"> Balance Sheet
                        </label>
                    </div>
                  </td>
                </tr>
                <tr class="kh22">
                    <td style="border-style:none;">គិតពី</td>
                    <td style="border-style:none;">ដល់</td>
                    <td style="border-style:none;">ប្រភេទដៃគូ</td>
                    <td style="border-style:none;"><span id="lblpartner">ជ្រើសរើសដៃគូ</span></td>
                </tr>
                <tr>

                    <td style="padding:0px;border-style:none;width:250px;">
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="d1" id="d1" class="form-control" style="width:170px;background-color:silver;font-size:22px;">
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>

                    </td>
                    <td style="padding:0px;border-style:none;width:260px;">
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="d2" id="d2" class="form-control" style="width:150px;background-color:silver;font-size:22px;">
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>
                    </td>
                    <td style="padding:0px;border-style:none;width:200px;">
                        <select style="width:200px;" name="seltype" id="seltype" class="form-select kh22">
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
                        </select>
                    </td>
                    <td style="padding:0px;border-style:none;width:310px;">
                        <select name="selcustomer" id="selcustomer" style="width:300px;" class="form-select select2-option kh22" required>
                          <option value=""></option>
                          <optgroup label="ដៃគូ">
                              @foreach ($partners->where('customertype','PARTNER') as $p)
                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                              @endforeach
                          </optgroup>
                          <optgroup label="ធនាគា">
                            @foreach ($partners->where('customertype','BANK') as $p)
                              <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                            @endforeach
                          </optgroup>
                          <optgroup label="ភ្នាក់ងារ">
                            @foreach ($partners->where('customertype','AGENT') as $p)
                              <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                            @endforeach
                          </optgroup>
                          @if (Auth::user()->role->name=='Admin')
                            <optgroup label="អតិថិជន">
                              @foreach ($customers as $p)
                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                              @endforeach
                            </optgroup>
                          @endif
                          @if (Auth::user()->role->name=='Admin')
                            <optgroup label="គ្មានបញ្ជី">
                              @foreach ($nolists as $p)
                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                              @endforeach
                            </optgroup>
                          @endif
                        </select>
                    </td>
                    <td style="padding:0px;border-style:none;">
                        <button class="btn btn-info btn-md kh22" id="btnsearch">បង្ហាញបញ្ជី</button>
                        <button class="btn btn-info btn-md kh22" id="btnprint">ព្រីនបញ្ជី</button>
                        <button class="btn btn-md kh22" id="btnsearchmore" data-bs-toggle="collapse" data-bs-target="#searchmore">More...</button>
                    </td>
                </tr>

            </table>
        </div>
        <div id="searchmore" class="collapse show">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                             <table class="table">
                                 <tr>
                                     <td style="border-style:none;padding:0px;width:200px;">
                                         <div class="form-check" style="margin-left:20px;">
                                             <input type="radio" class="form-check-input kh22" id="radio1" name="opttran" value="-1" >
                                             <label class="form-check-label kh22" for="radio1">បើកនៅយើង</label>
                                        </div>
                                        <div class="form-check" style="margin-left:20px;">
                                          <input type="radio" class="form-check-input kh22" id="radio2" name="opttran" value="1">
                                          <label class="form-check-label kh22" for="radio2">បើកនៅគេ</label>
                                        </div>
                                     </td>

                                     <td style="border-style:none;padding:0px;width:200px;">
                                         <div class="form-check">
                                             <input type="radio" class="form-check-input kh22" id="radio3" name="opttran" value="0" checked>
                                             <label class="form-check-label kh22" for="radio3">ទាំងពីរ</label>
                                           </div>
                                           <div class="form-check">
                                            <input type="radio" class="form-check-input kh22" id="radio4" name="opttran" value="2">
                                            <label class="form-check-label kh22" for="radio4">តាមជួររូបិយប័ណ្ណ</label>
                                          </div>
                                     </td>

                                    <td class="kh22" style="border-style:none;padding:0px;width:250px;">

                                      <div>
                                        <select name="selcur" id="selcur" class="form-select kh16-b" style="width:200px;margin-top:0">
                                          <option value="all">រូបិយប័ណ្ណទាំងអស់</option>
                                          @foreach ($currencies as $cur)
                                              <option value="{{ $cur->id }}">{{ $cur->shortcut }}</option>
                                          @endforeach
                                        </select>
                                      </div>

                                    </td>
                                    <td style="border-style:none;padding:0px;width:200px;">
                                      <div class="form-check" style="padding-left:20px;">
                                        <label class="form-check-label kh22">
                                          <input class="form-check-input kh22" type="checkbox" name="ckselect" id="ckselect">Select Check
                                        </label>
                                      </div>
                                    </td>
                                    <td style="border-style:none;padding:0px;">
                                        <button class="btn btn-info btn-md kh22" id="btnkatkong">កាត់កង</button>
                                        <button class="btn btn-info btn-md kh22" id="btncloselist">បិទបញ្ជី</button>
                                        <button class="btn btn-danger btn-md kh22" id="btndelcloselist">លុបបិទបញ្ជី</button>
                                    </td>
                                 </tr>
                             </table>
                        </div>
                    </div>
            </div>

        </div>
    </div>

    <div class="row">
      <div id="divdisplay" class="tableFixHead" style="margin-top:220px;padding:0px;">

      </div>
    </div>



    @include('partnerlists.closelistmodal')
    @include('partnerlists.delcloselistmodal')

@endsection
@section('script')

    <script type="text/javascript">
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-350;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-300;

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
    $(document).ready(function () {
        $('#selcustomer').select2({templateResult: formatOption});
        $('#seluser').select2();
        $('#selcustomer1').select2({
              dropdownParent: $('#closelistmodal')
        });
        $('#selcustomer2').select2({
              dropdownParent: $('#delcloselistmodal')
        });
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
            $(document).on('change','#selcustomer',function(e){
              e.preventDefault();
              var sp = document.querySelector("#selcustomer");
              var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
              $('#lblpartner').text(customertype);
            })
        //     $(document).on('click','#tbl_they td',function(e){
        //      // Remove previous highlight class
        //      var cksel = document.getElementById("ckselect").checked;
        //      if(cksel==false){
        //        $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
        //      }
        //     // add highlight to the parent tr of the clicked td
        //     $(this).parent('tr').toggleClass("clickedrow");
        //  })
         $(document).on('click','#tbl_we td,#tbl_they td',function(e){
             // Remove previous highlight class4
             var cksel = document.getElementById("ckselect").checked;
             if(cksel==false){
               //$(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               $(this).closest('table').find('td').removeClass("clicktd");
               $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
             }
            // add highlight to the parent tr of the clicked td
            //$(this).parent('tr').toggleClass("clickedrow");
            $(this).toggleClass("clicktd");
         })
         $(document).on('click','#tbl_we td.no,#tbl_they td.no',function(e){
             // Remove previous highlight class4
             var cksel = document.getElementById("ckselect").checked;
             if(cksel==false){
               $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
             }
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').toggleClass("clickedrow");
         })
         $(document).on('click','#tbl_after_total_we td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_after_total_they td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_before_total_we td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_before_total_they td',function(e){
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
         $(document).on('change','#selcur',function(e){
            e.preventDefault();
            displaybycurrency();
         })
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
        $(document).on('click','#btnkatkong',function(e){
            e.preventDefault();
            var partnerid=$('#selcustomer').val();
            //var param1 = "customer";
            //var param2= "document";
            var url = '{{ route("partnerlist.exchangelist", [":param1"]) }}';
                url = url.replace(':param1', partnerid);
                //url = url.replace(':param2',param2)
            window.open(url,'_blank');
        })
        $(document).on('click','#btnsummarylist',function(e){
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
          var partner=$('#selcustomer2').val();
           var url="{{ route('partnerlist.showcloselist') }}";
           $.get(url,{partner:partner},function(data){
                console.log(data);
                $('#closelistbody').empty().html(data);
           })
       }
       $(document).on('click','#btnsavelist',function(e){
           e.preventDefault();

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
                    console.log(data)
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

                        //TotalList();
                        //resetkatkong();
                        //location.reload();
                    }else{
                        alert(data.error)
                    }
                },
                error: function () {
                    alert('Save Error')
                }

            })

       })
       $(document).on('change','#radio1,#radio2,#radio3,#radio4',function(e){
            e.preventDefault()
            SearchList();
       })
        $(document).on('click','#btnsearch',function(e){
            e.preventDefault()
            SearchList();

        })
        function TotalList()
        {
            var exchangedate=$('#closedate').val();
            var partner=$('#selcustomer1').val();
            var partnername=$('#selcustomer1 option:selected').text();

            var url="{{ route('partnerlist.gettotallist') }}";
            $.get(url,{exchangedate:exchangedate,partner:partner,partnername:partnername,iscloselist:1},function(data){
                //console.log(data);
                $('#tbl_closelist').empty().html(data);
                var maxtid=$('#maxtid').val();
                var maxeid=$('#maxeid').val();
                $('#txt_lasttid').val(maxtid);
                $('#txt_lasteid').val(maxeid);
            })
        }

        $(document).on('change','#seltype',function(e){
            e.preventDefault();
            var type=$(this).val();

            getpartner(type,'#selcustomer');
        })
        function getpartner(type,el)
            {

                var url="{{ route('getpartnerbytype') }}";
                $(el).empty();

                $.get(url,{type:type},function(data){
                    //console.log(data)
                    $(el).append($("<option/>",{
                                value:'',
                                text:''
                            }))
                    $.each(data,function(i,item){
                        $(el).append($("<option/>",{
                                value:item.id,
                                text:item.name,
                                customertype:item.customertype
                            }))
                        //console.log(item)
                    });

                })
            }
        function SearchList()
        {
            $('body').addClass("wait");
            var isbooklist=1;
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var partner=$('#selcustomer').val();
            var partnername=$('#selcustomer option:selected').text();
            var oldlist = document.getElementById("ckoldlist").checked;
            var alldate = document.getElementById("ckalldate").checked;
            var balancesheet = document.getElementById("ckbalancesheet").checked;
            if(balancesheet==true){
              isbooklist=3;
            }
            var searchtran=document.querySelector('input[name="opttran"]:checked').value;
            var url="{{ route('partnerlist.showdata') }}";
            // $.get(url,{d1:d1,d2:d2,partner:partner,oldlist:oldlist,partnername:partnername,searchtran:searchtran},function(data){
            //     //console.log(data);
            //     $('#divdisplay').empty().html(data);
            //     document.body.style.cursor = 'pointer';
            // })
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: { d1:d1,d2:d2,partner:partner,oldlist:oldlist,alldate:alldate,partnername:partnername,searchtran:searchtran,isbooklist:isbooklist},
                //contentType: 'text/plain',
                //contentType: false,
                //processData: true,
                //cache: false,
                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#divdisplay').empty().html(data);
                    $('body').removeClass("wait");
                    displaybycurrency();
                },
                error: function () {
                    alert('Read Data Error.')
                }
            })
        }
       $(document).on('click','#btnprint',function(e){
            e.preventDefault();
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var isbooklist=1;
            var balancesheet = document.getElementById("ckbalancesheet").checked;
            if(balancesheet==true){
              isbooklist=3;
            }
            var partnername=$('#selcustomer option:selected').text();
            var partner=$('#selcustomer').val();
            var oldlist = document.getElementById("ckoldlist").checked;
            var alldate = document.getElementById("ckalldate").checked;
            var searchtran=document.querySelector('input[name="opttran"]:checked').value;
            var redirectWindow = window.open('{{ url('/') }}'+'/partnerlist/print?d1='+d1+'&d2='+d2+'&partnername='+partnername+'&partner='+partner+'&oldlist='+oldlist+'&searchtran='+searchtran+'&alldate='+alldate+'&isbooklist='+isbooklist, '_blank');
            redirectWindow.location;
       })
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


    })



    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }


    </script>
@endsection
