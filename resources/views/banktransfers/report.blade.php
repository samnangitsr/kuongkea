@extends('master')
@section('title') BANK REPORT @endsection
@section('css')
    <style type="text/css">
        #selbank + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;}
		/* Each result */
		#select2-selbank-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;} 

        #sel_to + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;}
		/* Each result */
		#select2-sel_to-results {font-family: 'Noto Sans Khmer', sans-serif;} 

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}

        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 47px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
        }
        .tbl_bank .clickedrow td{
        background-color: #caaf8f;
        }
        .tbl_bank .clickedrow td input{
            background-color: #caaf8f;
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
            <table class="kh22">
                <thead style="">
                    <th>គិតពី</th>
                    <th>ដល់</th>
                    <th>ធនាគា</th>
                    <th>រូបិយប័ណ្ណ</th>
                    <th>សកម្មភាព</th>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:250px;border-style:none;">
                            <div class="input-group">
                                <input type="text" name="fdate" id="fdate" class="form-control" style="background-color:silver;font-size:22px;"> 
                                <span class="input-group-text" style=""><i class="fa fa-calendar fa-2x"></i></span>
                            </div>
                        </td>
                        <td style="width:250px;border-style:none;">
                            <div class="input-group">
                                <input type="text" name="tdate" id="tdate" class="form-control" style="background-color:silver;font-size:22px;"> 
                                <span class="input-group-text" style=""><i class="fa fa-calendar fa-2x"></i></span>
                            </div>
                        </td>
                        <td style="border-style:none;">
                            <select name="selbank" id="selbank" class="form-select kh22" style="width:250px;background-color:aquamarine;">
                                @foreach ($banks as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="border-style:none;">
                            <select name="selcur" id="selcur" class="form-select" style="width:150px;font-size:22px;">
                                
                                @foreach ($currencies as $c)
                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="border-style:none;">
                            <button id="btnshow" class="btn btn-info kh22" >Show</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
   </div>
   <div class="row" style="margin-top:10px;">
        <div class="table-responsive">
            <table class="table table-bordered kh22 tbl_bank">
                <thead style="text-align:center;">
                    <th>លរ</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>ឈ្មោះធនាគា</th>
                    <th>ប្រតិបត្តិការណ៏</th>
                    <th>ចំនួនទឹកប្រាក់</th>
                    <th>រូបិយ</th>
                    <th>សមតុល្យ</th>
                    <th>ផ្សេងៗ</th>
                   
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
    $("#selbank").select2();
            var today=new Date();
            $('#fdate,#tdate').datetimepicker({
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
            // Remove previous highlight class
            $(document).on('click','.tbl_bank td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                //debugger;
                //var url="{{ route('banktransfer.search') }}";
                var d1=$('#fdate').val();
                var d2=$('#tdate').val();
                var bankid=$('#selbank').val();
                var bankname=$('#selbank option:selected').text();
                var cur=$('#selcur option:selected').text();
                // $.get(url,{d1:d1,d2:d2,bankid:bankid,cur:cur},function(data){
                //     $('#lists').empty().html(data);
                // })
                var fdate=d1.split("-");
                var dd=fdate[0];
                var mm=fdate[1];
                var yy=fdate[2];
                var nfdate=mm +'/' + dd + '/' + yy;
                var d=new Date(moment(nfdate).format("MM/DD/YYYY"));
                var d0=moment(d).add(-1,'days').format('DD/MM/YYYY');
                
                $.ajax({
                
                url:"{{ route('banktransfer.search') }}",
                type:'GET',
                dataType:'json',
                async: false,
                cache: false,
                data:{d1:d1,d2:d2,bankid:bankid,cur:cur},
                //it will fired when the data is currently processing
                beforeSend: function(){ 
                    
                   
                },
                complete:function(){
                    
                },
                success: function(data){
                   

                     console.log(data)
                     var k=0;
                     var output='';
                     var balance=0;
                     var colortext='';
                     var balamt=0;
                     //debugger;
                     
                        k+=1;
                        if(cur=='USD'){
                            balamt=parseFloat(jsCheckisNumber(data['closelist'].balusd));
                            balance +=parseFloat(jsCheckisNumber(data['closelist'].balusd));
                        }else if(cur=='KHR'){
                            balamt=parseFloat(jsCheckisNumber(data['closelist'].balkhr));
                            balance +=parseFloat(jsCheckisNumber(data['closelist'].balkhr));
                        }else if(cur=='THB'){
                            balamt=parseFloat(jsCheckisNumber(data['closelist'].balthb));
                            balance +=parseFloat(jsCheckisNumber(data['closelist'].balthb));
                        }
                        
                        
                        output +=`<tr>
                            <td style="text-align:center;">${k}</td>
                            <td>${moment(data['closelist'].closedate).format("DD/MM/YYYY")}</td>
                            
                            <td>ទាំងអស់</td>
                            <td>${bankname}</td>
                            <td>លុយយោងបិទបញ្ជី</td>
                            <td style="text-align:right;font-weight:bold;">${jsformatNumber(balamt)}</td>
                            <td>${cur}</td>
                            <td style="font-weight:bold;">${jsformatNumber(balance)}</td>
                            <td></td>
                            
                            </tr>`;
                        
                    

                    for(var i=0;i<data['olddebt'].length;i++){
                        k+=1;
                        balance +=parseFloat(jsCheckisNumber(data['olddebt'][i].tamount));
                        
                        output +=`<tr>
                            <td style="text-align:center;">${k}</td>
                            <td>${d0}</td>
                            <td>ទាំងអស់</td>
                            <td>${bankname}</td>
                            <td>លុយយោង</td>
                            <td style="text-align:right;font-weight:bold;">${jsformatNumber(data['olddebt'][i].tamount)}</td>
                            <td>${cur}</td>
                            <td style="font-weight:bold;">${jsformatNumber(balance)}</td>
                            <td></td>
                            
                            </tr>`;
                        
                    }
                    for(var j=0;j<data['newdebt'].length;j++){
                        k+=1;
                        balance +=parseFloat(jsCheckisNumber(data['newdebt'][j].amount));
                        if(parseFloat(data['newdebt'][j].amount)>0){
                            colortext='cblue';
                        }else{
                            colortext='cred';
                        }
                        output +=`<tr>
                            <td style="text-align:center;">${k}</td>
                            <td>${moment(data['newdebt'][j].trandate).format("DD/MM/YYYY")}</td>
                            <td>${data['newdebt'][j].user.name}</td>
                            <td>${data['newdebt'][j].customer.name}</td>
                            <td>${data['newdebt'][j].tranname}</td>
                            <td class="${colortext}" style="text-align:right;">${jsformatNumber(data['newdebt'][j].amount)}</td>
                            <td>${data['newdebt'][j].cur}</td>
                            <td style="font-weight:bold;">${jsformatNumber(balance)}</td>
                            <td>${data['newdebt'][j].note}</td>
                            
                            </tr>`;
                        
                    }
                    $('#lists').empty().html(output);
                },
                error: function(){
                }
            });

            })
          
          
          
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