@extends('master')
@section('title') CHILD REGISTER @endsection
@section('css')
    <style type="text/css">
        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;height:40px;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;} 
       
        #sel_customer_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_customer_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;} 
       

        #sel_province + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_province-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;} 
       
        #sel_district + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_district-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;} 

        #sel_province_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_province_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;} 
       
        #sel_district_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_district_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;} 


        #sel_province1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_province1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;} 
       
        #sel_district1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_district1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;} 

        #sel_commune1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_commune1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;} 

        #sel_village1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_village1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;} 

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
       
       #myInput {
        /* background-image: url("{{ asset('public/logo') }}/search-icon.jpg"); */
        /* background-image: url('/logo/search-icon.jpg'); */
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
      }
      .tbl_customer .clickedrow td{
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
    @endphp
   <div class="row" style="margin-top:-20px;margin-bottom:10px">
        <table id="tbl_header">
            <tr>
                <td></td>
                <td class="kh22">ខេត្ត</td>
                <td class="kh22">ស្រុក</td>
                <td class="kh22">មេសាខា</td>
                
            </tr>
            <tr>
                <td>
                    <button id="btnaddcustomer" class="btn btn-info kh22">ចុះឈ្មោះកូនសាខា</button>
                    <button id="btnaddprovince" class="btn btn-info kh22">ចុះឈ្មោះខេត្តក្រុង</button>
                </td>
                <td>
                    <select class="form-select kh22" name="sel_province_search" id="sel_province_search" style="width:300px;">
                        <option value="">ខេត្តទាំំងអស់</option>
                        @foreach ($provinces as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-select" name="sel_district_search" id="sel_district_search" style="width:300px;">
                                           
                    </select>
                </td>
                
                <td>
                    <select class="form-select kh22" id="sel_customer_search">
                        <option value="">ទាំងអស់</option>
                        @foreach ($customers as $cus)
                            <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="button" id="btnsearch" class="btn btn-info" style="margin-top:10px;" value="Search">
                </td>
            </tr>
        </table>
       
        
   </div>
   <div class="row" style="margin-top:5px;">
        <input type="text" class="kh16" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
      
   </div>
   <div class="row">
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered tbl_customer kh22">
                <thead style="text-align:center;">
                    <th>N <sup>o</sup></th>
                    <th>លរ</th>
                    <th>មេសាខា</th>
                    <th>កូនសាខា</th>
                    <th>អាស័យដ្ឋាន</th>
                    <th>លេខទូរស័ព្ទ</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>ថ្ងៃកត់ត្រា</th>
                    <th>សកម្មភាព</th>
                </thead>
                <tbody id="tbl_customer">
                    @foreach ($children as $key => $c)
                        <tr>
                            <td style="text-align:center;">{{ ++$key }}</td>
                            <td style="text-align:center;">{{ $c->no }}</td>
                            <td>{{ $c->customer->name }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->district->name . ' ' . $c->province->name}}</td>
                            <td>{{ $c->tel }}</td>
                            
                            <td>{{ $c->recordby }}</td>
                            <td>{{ date('d-m-Y',strtotime($c->created_at)) }}</td>
                            <td>
                               <a href="#" class="btn btn-warning btn-md btn_edit" data-id="{{ $c->id }}" data-name="{{ $c->name }}" data-tel="{{ $c->tel }}"
                                data-parent_id="{{ $c->customer_id }}" data-province_id="{{ $c->province_id }}" data-district_id="{{ $c->district_id }}" 
                                data-commune_id="{{ $c->commune_id }}" data-village_id="{{ $c->village_id }}" data-no="{{ $c->no }}">Edit</a>
                               <a href="#" class="btn btn-danger btn-md btn_remove" data-id="{{ $c->id }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>
   <form action="" id="frmcustomer">
       @include('customers.addchildmodal')
   </form>
   @include('customers.addaddressmodal');
@endsection
@section('script')
   @include('customers.addressscript');
    <script type="text/javascript">
      
$(document).ready(function () {
            $('#sel_customer_search').select2();
            $('#sel_province_search').select2();
            $('#sel_district_search').select2();
            
            $("#selcustomer").select2({
                dropdownParent: $("#addchildmodal")
            });
            $("#sel_province").select2({
                dropdownParent: $("#addaddressmodal")
            });
            $("#sel_district").select2({
                dropdownParent: $("#addaddressmodal")
            });
            $("#sel_province1").select2({
                dropdownParent: $("#addchildmodal")
            });
            $("#sel_district1").select2({
                dropdownParent: $("#addchildmodal")
            });
            $("#sel_commune1").select2({
                dropdownParent: $("#addchildmodal")
            });
            $("#sel_village1").select2({
                dropdownParent: $("#addchildmodal")
            });
           
            document.querySelector("#frmcustomer").addEventListener("keydown", (evt) => {
                if (evt.key === "Enter" && !evt.target.matches("textarea")) {
                    evt.preventDefault(); // Don't trigger form submit
                    console.log("ENTER-KEY PREVENTED ON NON-TEXTAREA ELEMENTS");
                }
            });
             //Highlight clicked row
         $(document).on('click','.tbl_customer td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         function resetfrmchild(){
            $('#selcustomer').val('');
            $('#sel_province1').val('');
            $('#sel_district1').val('');
            $('#sel_commune1').val('');
            $('#sel_village1').val('');
            $('#selcustomer').trigger('change');
            $('#sel_province1').trigger('change');
            $('#sel_district1').trigger('change');
            $('#sel_commune1').trigger('change');
            $('#sel_village1').trigger('change');
            $('#frmcustomer').trigger('reset');
         }
         $(document).on('change','#sel_province_search,#sel_district_search,#sel_customer_search',function(e){
            e.preventDefault();
            search('');
         })
         $(document).on('click','#btnsearch',function(e){
            e.preventDefault();
            search('');
         })
            $(document).on('click','#btnaddcustomer',function(){
                resetfrmchild();
                $('#addchildmodal').modal('show');
                $('#modalheader').text('ចុះឈ្មោះកូនសាខា');
                $('#btnsavecustomer').text('Save');
                
            })
            $(document).on('click','#btnaddprovince',function(){
                $('#addaddressmodal').modal('show');
            })
            $(document).on('change','#selcustomer',function(e){
                getmaxno($('#selcustomer').val());
            })
            function getmaxno(parentid){
                var url="{{ route('child.getmaxchildno') }}";
                $.get(url,{parentid:parentid},function(data){
                    $('#no').val(data['maxno']);
                })
            }
            $(document).on('click','.btn_edit',function(){
                
                var id=$(this).data('id');
                var name=$(this).data('name');
                var tel=$(this).data('tel');
                var parrent=$(this).data('parent_id');
                var province=$(this).data('province_id');
                var district=$(this).data('district_id');
                var commune=$(this).data('commune_id');
                var village=$(this).data('village_id');
                var no=$(this).data('no');
                
                $('#addchildmodal').modal('show');
                $('#modalheader').text('កែប្រែព៌តមានអតិថិជន');
                $('#btnsavecustomer').text('Update');

                $('#no').val(no);
                $('#child_id').val(id);
                $('#childname').val(name);
                $('#tel').val(tel);
                $('#selcustomer').val(parrent);
                $('#selcustomer').trigger('change');
                $('#sel_province1').val(province);
                $('#sel_province1').trigger('change');
                $('#sel_district1').val(district);
                $('#sel_district1').trigger('change');
                $('#sel_commune1').val(commune);
                $('#sel_commune1').trigger('change');
                $('#sel_village1').val(village);
                $('#sel_village1').trigger('change');

            })
            $(document).on('click','#btnupdate',function(e){
                e.preventDefault();

            })
            $(document).on('click','#btnsavecustomer',function(e){
                e.preventDefault();
                var formdata = new FormData(frmcustomer);
                // var cus_id=$('#customer_id').text();
                 //formdata.append("cur1",cur1);
                var btntext=$(this).text();
                var url="{{ route('child.store') }}";
                $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       console.log(data)
                       if($.isEmptyObject(data.error)){
                            //location.reload();
                            if(btntext=='Save'){
                                cleartext();
                            }else{
                                $('#addchildmodal').modal('hide');
                            }
                            
                            search('registerdate');
                       }else{
                            alert(data.error)
                       } 
                    },
                    error: function () {
                        alert('Save Error')
                        
                    }

                })
            })
            function cleartext()
            {
                getmaxno($('#selcustomer').val());
                $('#childname').val('');
                $('#tel').val('');
                $('#province').val('');
                $('#district').val('');
                $('#childname').focus();
            }
            function search(searchby)
            {
                var url="{{ route('child.search') }}";
                var province=$('#sel_province_search').val();
                var district=$('#sel_district_search').val();
                var customer=$('#sel_customer_search').val();
                
                $.get(url,{searchby:searchby,province:province,district:district,customer:customer},function(data){
                    $('#tbl_customer').empty().html(data);
                })
            }
            $(document).on('change','#sel_customertype',function(e){
                
                getcustomer();
            })
            $(document).on('click','#btnsearch',function(e){
                
                getcustomer();
            })
            $(document).on('click','.btn_remove',function(e){
                e.preventDefault();
                var row = $(this).closest("tr");  
                
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
                            url: "{{ route('child.delete') }}",
                            data: { id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    row.remove();
                                    
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
            $(document).on('keyup','#amount1',function(e){
                const C = e.key;
                if(isNumber(C)==false){
                    if(C=='Enter'){
                        $('#sel_cur1').focus();
                    }else{
                        getcurrencybykey(C,'#sel_cur1')
                    }
                   
                }
                
               
            })
            $(document).on('keyup','#amount2',function(e){
                const C = e.key;
                getcurrencybykey(C,'#sel_cur2')
            })
            $(document).on('change','#sel_cur2',function(e){
                e.preventDefault();
                $('#rate').attr('title', '');
                $('#rate').val('');
                $('#amount2').val('');
                getcurrencybyid($(this).val(),'#sel_cur2')
                var exchangecur=$("#sel_cur2 option:selected").text();
                $('#amtcur2').val(exchangecur);
            })
            $(document).on('change','#sel_cur1',function(e){
                e.preventDefault();
                getcurrencybyid($(this).val(),'#sel_cur1')
            })
            $(document).on('keyup', '#rate', function (e) {
                //debugger
                //alert(e.key)
                if(isNumber(e.key)){
                    calcuexchange();
                    return;
                } 
                //alert('not a number')
                const C = e.key;
                if (C === "Backspace") {
                    calcuexchange();
                    return;
                }
                
            })
          
})
function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
            function calcuexchangeproduct() {
                var luy = $('#amount1').val().replace(/,/g, '');
                var r = $('#rate').val().replace(/,/g, '');
                var rs = $('#rate').attr('title').split(";");
               
                if (rs[2] == '*') {
                    $('#amount2').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
                
            }
            function calcuexchange() {
                 //debugger
               
                var luy = $('#amount1').val().replace(/,/g, '');
                var r = $('#rate').val().replace(/,/g, '');
                var m1 = $('#sel_cur1').attr('title').split(";");
                var m2 = $('#sel_cur2').attr('title').split(";");
                if (m1[4] == '1') { //if maincur=true
                    if (m2[3] == '/') {//if operator=/
                        $('#amount2').val(formatNumber(luy * r));
                    } else {
                        $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    }
                } else {
                    if (m2[4] == '1') {
                        if (m1[3] == '/') {
                            $('#amount2').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                        } else {
                            $('#amount2').val(formatNumber(luy * r));
                        }
                    } else {
                        calcuexchangeproduct();
                    }
                }
            }
           
        function getcurrencybykey(key,el)
        {
            var url="{{ route('getcurrencybykey') }}";
            $.get(url,{key:key},function(data){
                 //console.log(data)
                
                    if(data['c']!=null){
                    
                        $(el).val(data['c']['id']);
                        $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                        getrate();
                    }         
            })
        }
        function getcurrencybyid(id,el)
        {
            var url="{{ route('getcurrencybyid') }}";
            $.get(url,{id:id},function(data){
                 //console.log(data)
                
                    if(data['c']!=null){
                    
                        $(el).val(data['c']['id']);
                        $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                        getrate();
                    }         
            })
        }
        function getrate() {
                
                $('#rate').attr('title', '');
                $('#rate').val('');
                $('#amount2').val('');
                var m = $('#sel_cur1').attr('title').split(";");
                var p = $('#sel_cur2').attr('title').split(";");
                if(m=='' || p==''){
                    //alert('can not save')
                    return;
                }
                //check if the save curname
                //debugger
                if (m[6] == p[6]) {
                    $('#rate').val(1);
                    calcuexchange();
                    return;
                }
                //check if product exchange product
                
                if (m[4] == '0') {
                    if (p[4] == '0') {
                        runproductrate();
                        return;
                    }
                }
                
                if (m[4] == '1') {//if maincur=true
                    $('#rate').val(p[2]);//get rate p sale
                } else {
                    $('#rate').val(m[1]);//get rate m buy
                }

                //$('#lblrate').attr('title',$('#txtrate').val());
                calcuexchange();
                
            }
            function runproductrate() {
                //debugger
                var url="{{ route('getproductrate') }}";
                var buycur =$("#sel_cur1 option:selected").text();
                var salecur = $("#sel_cur2 option:selected").text();
                var curname = '';
                
                curname = buycur + '-' + salecur;
                //alert(curname)
                //alert(curname)
                $.get(url,{curname:curname},function(data){
                    
                    if(data.success){
                        $('#rate').val(data['pr']['rate']);
                        $('#rate').attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                        calcuexchangeproduct();
                    }else{
                        $('#rate').val('');
                        $('#rate').attr('title','');
                    }
                    console.log(data)
                    
                })

               
            }
        function onlyNumberKey(txt, evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode == 46) {
                //Check if the text already contains the . character
                if (txt.value.indexOf('.') === -1) {
                return true;
                } else {
                return false;
                }
            }else if(charCode==45){
                if (txt.value.indexOf('-') === -1) {
                return true;
                } else {
                return false;
                }
            }else {
                if (charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;
            }
            return true;
        }

        function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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
    </script>
@endsection