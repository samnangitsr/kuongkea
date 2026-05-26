@extends('master')
@section('title') Exchange Rate @endsection
@section('css')
    <style type="text/css">
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
        .student-photo{
			height:100px;
			padding-left:1px;
			padding-right:1px;
			border:1px solid #ccc;
			background:#eee;
			width:270px;
			margin:0 auto;
			
		}
		.photo > input[type='file']{
			display:none;
		}
		.photo{
			width:30px;
			height:30px;
			border-radius:100%;
		}
        .student-id{
            background-repeat:repeat-x;
            border-color:#ccc;
            padding:1px;
            text-align:center;
            background:#eee;
            border-bottom:1px solid #ccc;
            }
        .btn-browse{
            border-color:#ccc;
            padding:1px;
            text-align:center;
            background:#eee;
            border:none;
            border-top:1px solid #ccc;
            height:25px;
            }
            fieldset{
            margin-top:0px;
            }
            fieldset legend{
            display:block;
            width:100%;
            padding:0;
            font-size:15px;
            line-height:inherit;
            color:#797979;
            border:0;
            border-bottom:1px solid #e5e5e5;
            }

            	/*css for webcam*/
            #video {
                border: 1px solid black;
                width: 320px;
                height: 320px;
            }
            #canvas {
        display: none;
    }

    .camera {
        width: 340px;
        display: inline-block;
    }

    .output {
        width: 340px;
        display: inline-block;
    }

    #startbutton {
        display: block;
        position: relative;
        margin-left: auto;
        margin-right: auto;
        bottom: 36px;
        padding: 5px;
        background-color: #6a67ce;
        border: 1px solid rgba(255, 255, 255, 0.7);
        font-size: 14px;
        color: rgba(255, 255, 255, 1.0);
        cursor: pointer;
    }

    .contentarea {
        font-size: 16px;
        font-family: Arial;
        text-align: center;
    }
    .circular--landscape { display: inline-block; position: relative; width: 100px; height: 100px; overflow: hidden; border-radius: 50%;background-color:rgb(180, 199, 216);border-style:solid solid solid solid;} 
    .circular--landscape-img { width: auto; height: 100%; margin-left: -50px; }
    td.input{
        padding:0px;
    }
    input.inp{
        border-style:none;
    }
    
    </style>    
@endsection
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
@section('content')
<div class="row">
    <table class="table">
        <tr>
            <td>
                <button type="button" id="btnsetrate" class="btn btn-primary">Save Rate</button>
                
            </td>
            <td>
                <select class="form-select kh22" name="viewcol" id="viewcol">
                    <option value="">Select L M R</option>
                    <option value="l">Left</option>
                    <option value="m">Middle</option>
                    <option value="r">Right</option>
                </select>
            </td>
            <td style="text-align:right;">
                <label for="date" class="kh16">កាលបរិច្ឆេទ</label>
            </td>
            <td style="width:250px;">
                
                 
                    <div class="form-group">
                        
                        <div class="input-group" style="">
                            <input type="text" name="setdate" id="setdate" class="form-control" style="">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                        </div>
                    </div>
                
            </td>
        </tr> 
    </table>
    
    
</div>

<div class="row">
    <div class="table-responsive">
        <form action="" id="frmsetrate">
            <table class="table table-bordered kh22">
                <thead class="table-dark kh16" style="text-align:center;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Num</th>
                        <th scope="col">ID</th>
                        <th scope="col">Currency</th>
                        <th scope="col">ShortCut</th>
                        <th scope="col">IsP&P</th>
                        <th scope="col">Sign</th>
                        <th scope="col">Buy</th>
                        <th scope="col">Sale</th>
                        <th scope="col">Ratio</th>
                        <th scope="col">RateBuy</th>
                        <th scope="col">RateSale</th>

                        {{-- <th scope="col">Action</th> --}}
                        
                    </tr>
                </thead>
           
                <tbody id="currencylist">
                    @foreach ($currencies as $key => $c)
                        <tr>
                            <td style="text-align:center;padding-top:8px;width:60px;">{{ ++$key }}</td>
                            <td class="input">
                                <input name="curno[]" type="text" class="form-control curno canenter kh22" style="width:75px;" value="{{ $c->no }}" readonly>
                            </td>
                            <td class="input">
                                <input name="curid[]" type="text" class="form-control curid canenter kh22" style="width:80px;" value="{{ $c->id }}" readonly>
                            </td>
                            <td class="input">
                                <input name="curname[]" type="text" class="form-control curname canenter kh22" value="{{ $c->curname }}" readonly>
                            </td>
                            <td class="input">
                                <input name="shortcut[]" type="text" style="width:120px;" class="form-control shortcut canenter kh22" value="{{ $c->shortcut }}" readonly>    
                            </td>
                            <td class="input">
                                <input name="ispandp[]" type="text" style="width:60px;" class="form-control ispandp canenter kh22" value="{{ $c->ispandp }}" readonly>    
                            </td>
                            <td class="input">
                                <input name="optsign[]" type="text" style="width:60px;" class="form-control optsign canenter kh22" value="{{ $c->optsign }}" readonly>
                            </td>
                            <td class="input">
                                <input name="buy[]" type="text" style="text-align:right;" class="form-control buy canenter kh22" value="{{ phpformatnumber($c->buy) }}">     
                            </td>
                            <td class="input">
                                <input name="sale[]" type="text" style="text-align:right;" class="form-control sale canenter kh22" value="{{ phpformatnumber($c->sale) }}">
                            </td>
                            <td class="input">
                                <input name="ratio[]" style="width:120px;text-align:center;" type="text" class="form-control ratio canenter kh22" value="{{ $c->ratio }}" readonly>
                            </td>
                            <td class="input">
                                <input name="ratebuy[]" type="text" style="text-align:right;" class="form-control ratebuy canenter kh22" value="{{ phpformatnumber($c->ratebuy) }}" readonly>   
                            </td>
                            <td class="input">
                                <input name="ratesale[]" type="text" style="text-align:right;" class="form-control ratesale canenter kh22" value="{{ phpformatnumber($c->ratesale) }}" readonly>
                            </td>
                            {{-- <td class="input">
                                <input name="txtchk[]" type="hidden" class="form-control txtchk" value="false">
                                <input class="form-check-input chk" type="checkbox">
                                <a href="#" class="btn btn-warning btnedit">Edit</a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </form>
    </div>
</div>

@endsection
@section('script')

<script src="{{ asset('public/js') }}/numberinput.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var today=new Date();
        
        $('#setdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
        $('.buy').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
        $('.sale').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
        $(document).keydown(function (event) {
           if(event.keyCode==13){
                return false;
           }
        })
        $(document).on('keydown','.canenter',function(e){
				 if (e.keyCode == 13) {
			        var $this = $(this),
			        index = $this.closest('td').index();
			        $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
			        e.preventDefault();
			    }
			})
        $(document).on('click','.btnedit',function(e){
            e.preventDefault();
            
            var row = $(this).closest('tr');
        	var rowind=row.find("td:eq(0)").text();
            var ck=$('.chk').eq(rowind-1).prop('checked');
            $('.chk').eq(rowind-1).attr('checked',!ck);
            $('.buy').eq(rowind-1).attr('readonly',ck);
            $('.sale').eq(rowind-1).attr('readonly',ck);
            $('.txtchk').eq(rowind-1).val(!ck);
        })
        $(document).on('keyup','.buy,.sale',function(e){
            e.preventDefault();
            var row = $(this).closest('tr');
        	var rowind=row.find("td:eq(0)").text();
            var operator=$('.optsign').eq(rowind-1).val();
            var ratio=$('.ratio').eq(rowind-1).val().replace(/,/g,'');
            var buy=$('.buy').eq(rowind-1).val().replace(/,/g,'');
            var sale=$('.sale').eq(rowind-1).val().replace(/,/g,'');
            var ratebuy=0;
            var ratesale=0;
            
            ratebuy=buy/ratio;
            ratesale=sale/ratio;
            
            $('.ratebuy').eq(rowind-1).val(ratebuy);
            $('.ratesale').eq(rowind-1).val(ratesale);
            
        })
       
		$(document).on('click','#btnsetrate',function(e){
            e.preventDefault();
            
            var formdata = new FormData(frmsetrate);
            var url="{{ route('currency.setrate') }}";
            $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                      // console.log(data)
                       if($.isEmptyObject(data.error)){
                        alert(data.message);
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
    $(document).on('change','#viewcol',function(e){
        e.preventDefault();
        getcurrencyrate();
    })
    function getcurrencyrate(){
        var url="{{ route('currencyrate') }}";
        var viewcol=$('#viewcol').val();
        $.get(url,{active:1,viewcol:viewcol},function(data){
            //console.log(data)
            if(!data.error){
                $('#currencylist').empty().html(data);
            }else{
                alert(data.error)
            }
        })
    }
        
    })
</script>
@endsection