@extends('master')
@section('title') BANK SUMMARY @endsection
@section('css')
    <style type="text/css">
        #selbank + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:aqua;height:40px;}
		/* Each result */
		#select2-selbank-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:aqua;} 

        #sel_to + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:aquamarine;height:40px;}
		/* Each result */
		#select2-sel_to-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:aquamarine;} 

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
       
       .cblue{
        color:blue;
        font-weight:bold;
       }
       .cred{
        color:red;
        font-weight:bold;
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
        <div class="table-responsive">
            <table class="table kh22">
                <thead style="border-style:none;">
                    <th style="border-style:none;">ថ្ងៃទី</th>
                    <th style="border-style:none;">សកម្មភាព</th>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:250px;border-style:none;">
                            <div class="input-group">
                                <input type="text" name="dd" id="dd" class="form-control" style="background-color:silver;font-size:22px;"> 
                                <span class="input-group-text" style=""><i class="fa fa-calendar fa-2x"></i></span>
                            </div>
                        </td>
                        
                       
                        <td style="border-style:none;">
                            <button id="btnshow" class="btn btn-info kh22" >Show</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
   </div>
   <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered kh22">
                <thead style="text-align:center;">
                    <th>លរ</th>
                    <th>ឈ្មោះធនាគា</th>
                    <th>ដុល្លា</th>
                    <th>រៀល</th>
                    <th>បាត</th>
                    <th>គិតជាដុល្លា</th>
                </thead>
                <tbody id="lists">
                    
                </tbody>
            </table>
        </div>
   </div>
   
@endsection
@section('script')
   
    <script type="text/javascript">
       
$(document).ready(function () {
   
            var today=new Date();
            $('#dd').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
           
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
            
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                //debugger;
                var url="{{ route('banktransfer.doreportsummary') }}";
                var dd=$('#dd').val();
                $.get(url,{dd:dd},function(data){
                    $('#lists').empty().html(data);
                })
                
                
               

                        
                 
            });

    })
          
          
          

function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    function jsformatNumber(num) 
        {
            if(isNumber(num)==false) return 0;
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
    function jsCheckisNumber(num)
    {
        if(isNumber(num)==false) return 0;
        return num;
    }
       
    </script>
@endsection