@extends('master')
@section('title') all Partner List @endsection
@section('css')
<link rel="stylesheet" tyle="text/css" href="{{ config('helper.asset_path') }}/css/virtual-select.min.css">
    <style type="text/css">
         body.wait, body.wait *{
			cursor: wait !important;
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
        .kh30{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
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
       #tbl_all_partnerlist .clickedrow td{
        background-color: #caaf8f;
    }
    #tbl_all_partnerlist_detail .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_total .clickedrow td{
        background-color: #2eceee;
    }
    .tableFixHead          { overflow: auto;height:350px;}
    .tableFixHead thead th { position: sticky; top: 0; z-index:0;background-color:aqua }

    /* .tableFixHead thead tr>th { position: sticky; top: 0; z-index: 1;background-color:rgb(0, 255, 42) } */
    /* .tableFixHead thead tr td { position: sticky; top: 0; z-index: 1;background-color:aqua } */
    #tbl_all_partnerlist td{
      word-wrap: break-word;
      padding:2px;
    }
    /* #tbl_all_partnerlist td:first-child{
      position:sticky;
      left:0;
      z-index:2;
    }
    #tbl_all_partnerlist th:first-child{
      position:sticky;
      left:0;
      z-index:2;
    }
    #tbl_all_partnerlist td:nth-child(2){
      position:sticky;
      left:67px;
      z-index:2;
    }
    #tbl_all_partnerlist th:nth-child(2){
      position:sticky;
      left:67px;
      z-index:2;
    }
    #tbl_all_partnerlist th:first-child{
      z-index:3;
    }
    #tbl_all_partnerlist th:nth-child(2){
      z-index:3;
    } */
    .mybtn{
        border:1px sold black;
        height:33px;
    }
    .mybtn:hover{
        background-color:aquamarine;
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

    <div class="row">
        {{-- <div class="row">
          <table>
            <tr>
              <td class="kh16-b" style="text-align:right;">
                (+) យើងខ្វះគេ (-) គេខ្វះយើង
              </td>
            </tr>
          </table>

        </div> --}}
        <div class="table-responsive" style="">
            <table class="table" style="">
                <tr class="kh16-b">
                    <td style="border-style:none;padding:0px;text-align:left;width:110px;">
                        <div class="form-check">
                        <label class="form-check-label kh16-b">
                            <input class="form-check-input kh16-b" style="" type="checkbox" name="ckluysal" id="ckluysal" checked> លុយសល់
                        </label>
                        </div>
                    </td>
                    <td style="border-style:none;padding:0px;width:160px;">គិតពី</td>
                    <td style="border-style:none;padding:0px;width:160px;">ដល់</td>
                    <td style="border-style:none;padding:0px;width:180px;">ប្រភេទដៃគូ</td>

                </tr>
                <tr>
                    <td style="padding:0px;border-style:none;">
                        <div class="form-check">
                            <label class="form-check-label kh16">
                                <input class="form-check-input kh16-b" style="margin-left:-20px;" type="checkbox" name="ckoldlist" id="ckoldlist" checked> Old List
                            </label>
                        </div>
                    </td>
                    <td style="padding:0px;border-style:none;width:180px;">
                        <div class="input-group" style="width:180px;">
                            <input type="text" name="d1" id="d1" class="kh16-b" style="width:120px;height:36px;background-color:silver;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                    </td>
                    <td style="padding:0px;border-style:none;width:180px;">
                        <div class="input-group" style="width:180px;">
                            <input type="text" name="d2" id="d2" class="kh16-b" style="width:120px;height:36px;background-color:silver;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>

                    <td style="padding:0px;border-style:none;">
                        <select style="width:160px;" multiple name="seltype" id="seltype" class="kh12-b" placeholder="Select Type" data-search="false" data-silent-initial-value-set="true" z-index=1>
                            <option value="PARTNER">PARTNER</option>
                            <option value="BANK">BANK</option>
                            @if(Auth::user()->role->name=='Admin')
                            <option value="CUSTOMER">CUSTOMER</option>
                            @endif
                            <option value="AGENT">AGENT</option>
                            @if(Auth::user()->role->name=='Admin')
                            <option value="NOLIST">NOLIST</option>
                            @endif
                            <option value="BUYER">BUYER</option>
                            <option value="SALER">SALER</option>
                        </select>
                    </td>
                    <td style="padding:2px 0px 0px 5px;border-style:none;">
                        <button class="mybtn kh14-b" id="btnsearch">បង្ហាញបញ្ជី</button>
                        <button class="mybtn kh14-b" id="btnsearchdetail">បង្ហាញបញ្ជីលំអិត</button>
                        <button class="mybtn kh14-b" id="btnprint" disabled>ព្រីនបញ្ជី</button>
                        @if (Auth::user()->role->name<>'Admin')
                            @if (App\User::checkpermission(Auth::id(),'5.5'))
                                <button class="mybtn kh14-b" id="btnclearallviewer">ClearallViewer</button>
                            @endif
                        @else
                            <button class="mybtn kh14-b" id="btnclearallviewer">ClearallViewer</button>
                        @endif
                    </td>
                    <td style="padding:2px 0px 0px 5px;border-style:none;">
                        <input type="text" class="kh16-b" style="width:300px;" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </td>
                </tr>

            </table>
        </div>


    </div>
    <div class="row" style="margin-top:0px;">
      <div id="divdisplay" class="" style="padding:0px;">

      </div>
    </div>

   @include('partnerlists.showlistmodal')

@endsection
@section('script')
<script src="{{ config('helper.asset_path') }}/js/virtual-select.min.js"></script>
    <script type="text/javascript">
        $('#h1_title').text('បញ្ជីដៃគូទាំងអស់');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-220;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-220;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
      });
      $(document).ready(function () {
          VirtualSelect.init({ele: '#seltype',});
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

          $(document).on('click','#tbl_all_partnerlist td',function(e){
              // Remove previous highlight class
              $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
              // add highlight to the parent tr of the clicked td
              $(this).parent('tr').addClass("clickedrow");
          })
          $(document).on('click','#tbl_all_partnerlist_detail td',function(e){
              // Remove previous highlight class
              $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
              // add highlight to the parent tr of the clicked td
              $(this).parent('tr').addClass("clickedrow");
          })
          $(document).on('click','.tbl_total td',function(e){
              // Remove previous highlight class
              $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
              // add highlight to the parent tr of the clicked td
              $(this).parent('tr').addClass("clickedrow");
          })
          $(document).on('dblclick', '.rowdetail', function(event) {
              //event can use  #tbl_all_partnerlist_detail tr
              var ind=$(this).index();
              var row=$(this).closest('tr');
              var partnername=row.find("td:eq(1)").text();
              var weusd=row.find("td:eq(2)").text();
              var wethb=row.find("td:eq(3)").text();
              var wekhr=row.find("td:eq(4)").text();
              var wevnd=row.find("td:eq(5)").text();

              var theyusd=row.find("td:eq(6)").text();
              var theythb=row.find("td:eq(7)").text();
              var theykhr=row.find("td:eq(8)").text();
              var theyvnd=row.find("td:eq(9)").text();

              var usd=row.find("td:eq(10)").text();
              var thb=row.find("td:eq(11)").text();
              var khr=row.find("td:eq(12)").text();
              var vnd=row.find("td:eq(13)").text();

              $('#showlistmodal').modal('show');
              $('#weusd').text(weusd);
              $('#wethb').text(wethb);
              $('#wekhr').text(wekhr);
              $('#wevnd').text(wevnd);

              $('#theyusd').text(theyusd);
              $('#theythb').text(theythb);
              $('#theykhr').text(theykhr);
              $('#theyvnd').text(theyvnd);

              $('#usd').text(usd);
              $('#thb').text(thb);
              $('#khr').text(khr);
              $('#vnd').text(vnd);

              $('#partnername').text('បើកនៅ ' + partnername);
              $('#modalheader').text('បញ្ជីដៃគូ ' + partnername);

          })
          $(document).on('click','#btnsearch',function(e){
              e.preventDefault();
              $('#btnprint').attr('disabled',true);
              $('#btnsearch').attr('disabled',true);
              $('#btnprint').attr('title','0');
              ShowallList();
          })
          $(document).on('click','#btnsearchdetail',function(e){
              e.preventDefault();
              $('#btnprint').attr('disabled',true);
              $('#btnsearchdetail').attr('disabled',true);
              $('#btnprint').attr('title','1');
              ShowallListdetail();
          })
          $(document).on('click','#btnprint',function(e){
              e.preventDefault()
              var viewdetail=$('#btnprint').attr('title');
              var d1=$('#d1').val();
              var d2=$('#d2').val();
              var ptype=$('#seltype').val();
              var oldlist = document.getElementById("ckoldlist").checked;
              var htp=window.location.protocol;
              var htn=window.location.hostname;
              var redirectWindow = window.open('{{ url('/') }}'+'/partnerlist/printallpartnerlist?ptype='+ptype +'&d1='+d1+'&d2='+d2+'&oldlist='+oldlist+'&viewdetail='+viewdetail, '_blank');
              redirectWindow.location;
          })
          $(document).on('click','#btnclearallviewer',function(e){
              var url="{{ route('partnerlist.clearallviewer') }}";
              $.post(url,{},function(data){
                console.log(data)
                if(!data.error){
                  alert('Clear all viewer completed');
                }else{
                  alert('Clear Fail');
                }
              })
          })
          function ShowallList()
          {
              $('body').addClass("wait");
              var ptype=$('#seltype').val();
              var d1=$('#d1').val();
              var d2=$('#d2').val();
              var oldlist = document.getElementById("ckoldlist").checked;
              var luysal = document.getElementById("ckluysal").checked;

              var url="{{ route('partnerlist.summaryallpartnerlist') }}";
              $.ajax({
                  async: true,
                  type: 'GET',
                  url: url,
                  data: { d1:d1,d2:d2,oldlist:oldlist,ptype:ptype,luysal:luysal},
                  complete: function () {

                  },
                  success: function (data) {
                    console.log(data);
                    $('#divdisplay').empty().html(data);
                    $('body').removeClass("wait");
                    $('#btnprint').attr('disabled',false);
                    $('#btnsearch').attr('disabled',false);
                  },
                  error: function () {
                      alert('Read Error.')
                      $('#btnsearch').attr('disabled',false);
                  }
              })

          }
          function ShowallListdetail()
          {
              $('body').addClass("wait");

              var ptype=$('#seltype').val();
              var d1=$('#d1').val();
              var d2=$('#d2').val();
              var oldlist = document.getElementById("ckoldlist").checked;
              var luysal = document.getElementById("ckluysal").checked;
              var url="{{ route('partnerlist.summaryallpartnerlistdetail') }}";
              $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: { d1:d1,d2:d2,oldlist:oldlist,ptype:ptype,luysal:luysal},
                contentType: 'text/plain',
                cache: false,
                complete: function () {

                },
                success: function (data) {
                  //console.log(data);
                  $('#divdisplay').empty().html(data);
                  $('body').removeClass("wait");
                  $('#btnprint').attr('disabled',false);
                  $('#btnsearchdetail').attr('disabled',false);
                },
                error: function () {
                    alert('Read Error.')
                    $('#btnsearchdetail').attr('disabled',false);
                }

              })

          }
      })

    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("tbl_all_partnerlist");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }


    </script>
@endsection
