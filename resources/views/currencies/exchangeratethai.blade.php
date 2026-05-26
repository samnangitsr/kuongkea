@extends('master')
@section('title') Thai Rate @endsection
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
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
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
            <td class="kh22-b">
                កំណត់អត្រាលុយថៃ
            </td>
            <td>
                <button type="button" id="btnsetrate" class="btn btn-primary">Save Thai Rate</button>
                
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
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID</th>
                    <th scope="col">Currency</th>
                    <th scope="col">Buy</th>
                    <th scope="col">Sale</th>
                </tr>
            </thead>
            <tbody id="currencylist">
                <form action="" id="frmsetrate">
                    @foreach ($thais as $key => $c)
                        <tr>
                            <td style="text-align:center;padding-top:8px;">{{ ++$key }}</td>
                            
                            <td class="input">
                                <input name="id[]" type="text" class="form-control curid canenter" value="{{ $c->id }}" readonly>
                            </td>
                            <td class="kh16 input">
                                <input name="curname[]" type="text" class="form-control curname canenter" value="{{ $c->curname }}" readonly>
                            </td>
                            
                            
                            <td class="input">
                                <input name="buy[]" type="text" class="form-control buy canenter" value="{{ phpformatnumber($c->buy) }}">     
                            </td>
                            <td class="input">
                                <input name="sale[]" type="text" class="form-control sale canenter" value="{{ phpformatnumber($c->sale) }}">
                            </td>
                            
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>    
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
       
       
       
		$(document).on('click','#btnsetrate',function(e){
            e.preventDefault();
            var formdata = new FormData(frmsetrate);
            var url="{{ route('currency.setratethai') }}";
            $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
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
		

        
    })
</script>
@endsection