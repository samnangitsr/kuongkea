@extends('master')
@section('title') Address Register @endsection
@section('css')
    <style type="text/css">
         #sel_province + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;height:30px;}
		/* Each result */
		#select2-sel_province-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;}

        #sel_district + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;height:30px;}
		/* Each result */
		#select2-sel_district-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;}

        #sel_commune + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;height:30px;}
		/* Each result */
		#select2-sel_commune-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;}

        #sel_village + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;height:30px;}
		/* Each result */
		#select2-sel_village-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;}

        #sel_province_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;height:30px;}
		/* Each result */
		#select2-sel_province_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;}

        #sel_district_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;height:30px;}
		/* Each result */
		#select2-sel_district_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;}

        #sel_commune_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;height:30px;}
		/* Each result */
		#select2-sel_commune_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;}

        #sel_village_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;height:30px;}
		/* Each result */
		#select2-sel_village_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;background-color:white;}
		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16x;height:30px;}
        ul.ui-autocomplete {
            z-index: 1100;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
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
       .mybtn{
            border:1px solid black;
            padding:5px;
       }
       .mybtn:hover{
        background-color:aquamarine;
       }
       #myInput {
        /* background-image: url("{{ asset('public/logo') }}/search-icon.jpg"); */
        /* background-image: url('/logo/search-icon.jpg'); */
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 5px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
      }
      .tbl_address .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_address td{
        padding:3px;
    }
    .tbl_address th{
        padding:2px;
    }
    #address_form td{
        border-style:none;
    }
    #tbl_header td{
        border-style:none;
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
   <div class="row">
        <div class="table-responsive">
            <table id="tbl_header" class="table">
                <tr class="kh16">
                    <td></td>
                    <td>ខេត្ត</td>
                    <td>ស្រុក</td>
                    <td>ឃុំ</td>
                    <td>ភូមិ</td>

                </tr>
                <tr>
                    <td>
                        <button id="btnaddaddress" class="mybtn kh16">ចុះឈ្មោះខេត្តក្រុង</button>
                    </td>
                    <td>
                        <select class="kh16" name="sel_province_search" id="sel_province_search" style="width:100%">
                            <option value="">ខេត្តទាំំងអស់</option>
                            @foreach ($provinces as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="" name="sel_district_search" id="sel_district_search" style="width:100%;">

                        </select>
                    </td>
                    <td>
                        <select class="" name="sel_commune_search" id="sel_commune_search" style="width:100%;">

                        </select>
                    </td>
                    <td>
                        <select class="" name="sel_village_search" id="sel_village_search" style="width:100%;">

                        </select>
                    </td>

                    <td style="padding-left:10px;">
                        <input type="button" id="btnsearch" class="mybtn" value="Search">
                    </td>
                </tr>
            </table>
        </div>


   </div>
   <div class="row" style="margin-top:5px;">
        <input type="text" class="kh16" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

   </div>
   <div class="row">
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-hover tbl_address kh16">
                <thead style="text-align:center;">
                    <th>N <sup>o</sup></th>
                    <th>ID</th>
                    <th>ប្រភេទ</th>
                    <th>ឈ្មោះ</th>
                    <th>ខេត្ត</th>
                    <th>ស្រុក</th>
                    <th>ឃុំ</th>

                    <th>សកម្មភាព</th>
                </thead>
                <tbody id="tbl_addresses">
                    @foreach ($addresses as $key => $a)
                        <tr>
                            <td style="text-align:center;width:60px;">{{ ++$key }}</td>
                            <td style="text-align:center;">{{ $a->id }}</td>
                            <td style="text-align:center">{{ $a->type }}</td>
                            <td>{{ $a->name }}</td>
                            <td>
                              {{ $a->provinceofdistrict->name }}
                            </td>
                            <td>{{ $a->districtofcommune->name }}</td>

                            <td>{{ $a->communeofvillage->name}}</td>

                            <td style="width:100px;text-align:center;">
                                <a href="#" class="btn btn-warning btn-sm btn_edit" data-id="{{ $a->id }}" data-type="{{ $a->type }}" data-name="{{ $a->name }}"
                                    data-province_id="{{ $a->province_id }}" data-district_id="{{ $a->district_id }}" data-commune_id="{{ $a->commune_id }}">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm btn_remove" data-id="{{ $a->id }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>

       @include('customers.addaddressmodal')

@endsection
@section('script')
   @include('customers.addressscript');
    <script type="text/javascript">
$(document).ready(function () {
        $('#h1_title').text('ចុះឈ្មោះខេត្តក្រុង');

            $("#selcustomer").select2({
                dropdownParent: $("#addcustomermodal")
            });
            $("#sel_province").select2({
                dropdownParent: $("#addaddressmodal")
            });
            $("#sel_district").select2({
                dropdownParent: $("#addaddressmodal")
            });
            $("#sel_commune").select2({
                dropdownParent: $("#addaddressmodal")
            });
            $("#sel_village").select2({
                dropdownParent: $("#addaddressmodal")
            });
            $('#sel_province_search').select2();
            $('#sel_district_search').select2();
            $('#sel_commune_search').select2();
            $('#sel_village_search').select2();

             //Highlight clicked row
         $(document).on('click','.tbl_address td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
            $(document).on('click','#btnaddaddress',function(){

                $('#addaddressmodal').modal('show');
                $('#modalheader').text('ចុះឈ្មោះអាស័យដ្ឋាន');
                resetaddressmodal();
                $('#address_id').val('');

            })

            function getmaxno(parentid){
                var url="{{ route('child.getmaxchildno') }}";
                $.get(url,{parentid:parentid},function(data){
                    $('#no').val(data['maxno']);
                })
            }
            function resetaddressmodal(){
                $('#btnsaveprovince').css('display','inline');
                $('#btnsavedistrict').css('display','inline');
                $('#btnsavecommune').css('display','inline');
                $('#btnsavevillage').css('display','inline');
                $('#sel_province').val('');
                $('#sel_province').trigger('change');
                $('#sel_district').val('');
                $('#sel_district').trigger('change');
                $('#sel_commune').val('');
                $('#sel_commune').trigger('change');
                $('#sel_village').val('');
                $('#sel_village').trigger('change');
                $('#province').val('');
                $('#district').val('');
                $('#commune').val('');
                $('#village').val('');

            }
            $(document).on('click','.btn_edit',function(){
                resetaddressmodal();
                var id=$(this).data('id');
                var type=$(this).data('type');
                var name=$(this).data('name');
                var province_id=$(this).data('province_id');
                var district_id=$(this).data('district_id');
                var commune_id=$(this).data('commune_id');

                $('#addaddressmodal').modal('show');
                $('#address_id').val(id);
                if(type=='ខេត្ត'){
                    $('#province').val(name);
                    $('#sel_province').val(id);
                    $('#sel_province').trigger('change');
                    $('#btnsavedistrict').css('display','none');
                    $('#btnsavecommune').css('display','none');
                    $('#btnsavevillage').css('display','none');
                }else if(type=='ស្រុក'){
                    $('#district').val(name);
                    $('#sel_province').val(province_id);
                    $('#sel_province').trigger('change');
                    $('#sel_district').val(id);
                    $('#sel_district').trigger('change');
                    $('#btnsaveprovince').css('display','none');
                    $('#btnsavecommune').css('display','none');
                    $('#btnsavevillage').css('display','none');
                }else if(type=='ឃុំ'){
                    $('#commune').val(name);
                    $('#sel_province').val(province_id);
                    $('#sel_province').trigger('change');
                    $('#sel_district').val(district_id);
                    $('#sel_district').trigger('change');
                    $('#sel_commune').val(id);
                    $('#sel_commune').trigger('change');
                    $('#btnsavedistrict').css('display','none');
                    $('#btnsaveprovince').css('display','none');
                    $('#btnsavevillage').css('display','none');
                }else if(type=='ភូមិ'){
                    $('#village').val(name);
                    $('#sel_province').val(province_id);
                    $('#sel_province').trigger('change');
                    $('#sel_district').val(district_id);
                    $('#sel_district').trigger('change');
                    $('#sel_commune').val(commune_id);
                    $('#sel_commune').trigger('change');
                    $('#sel_village').val(id);
                    $('#sel_village').trigger('change');
                    $('#btnsavedistrict').css('display','none');
                    $('#btnsavecommune').css('display','none');
                    $('#btnsaveprovince').css('display','none');
                }


                $('#modalheader').text('កែប្រែព៌តមាន');


            })
            $(document).on('click','#btnupdate',function(e){
                e.preventDefault();

            })

            function cleartext()
            {
                $('#childname').val('');
                $('#tel').val('');
                $('#province').val('');
                $('#district').val('');
                $('#childname').focus();
            }


            $(document).on('click','#btnsearch',function(e){

                searchaddress();
            })
            $(document).on('click','.btn_remove',function(e){
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
                            url: "{{ route('address.delete') }}",
                            data: { id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    searchaddress();
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
    td = tr[i].getElementsByTagName("td")[3];
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
