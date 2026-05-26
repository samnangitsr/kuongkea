@extends('master')
@section('title') CUSTOMER REGISTER @endsection
@section('css')
    <link rel="stylesheet" tyle="text/css" href="{{ config('helper.asset_path') }}/css/virtual-select.min.css">
    <style type="text/css">
         body.wait, body.wait *{
			cursor: wait !important;
		}
        #sel_from + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:aqua;height:40px;}
		/* Each result */
		#select2-sel_from-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:aqua;}

        #sel_to + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:aquamarine;height:40px;}
		/* Each result */
		#select2-sel_to-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:aquamarine;}
        #seluserconnect + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:80px;}
		/* Each result */
		#select2-seluserconnect-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:aquamarine;}

        #sel_province1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_province1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

        #sel_district1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_district1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

        #sel_commune1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_commune1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

        #sel_village1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_village1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:40px;}
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
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
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
        padding: 5px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
      }
    .tbl_customer td{
      word-wrap: break-word;
      /* padding:2px 5px 2px 5px; */
    }
    .tbl_customer .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_partner_account .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_agenttype .clickedrow td{
        background-color: #99CA8F;
    }
    .ui-autocomplete {
        position: fixed;
        z-index: 1511;
        font-size:16px;
        font-family:'Noto Sans Khmer', sans-serif;

    }
    .ui-autocomplete-input{
      border: none;
      margin-bottom: 5px;
      border:1px solid #c8c6c6 !important;
      z-index:1511;
    }
    #myTable td{
      padding:5px;
    }
    /* .photo > input[type='file']{
			display:none;
		}
		.photo{
			width:30px;
			height:30px;
			border-radius:100%;
		} */
         .td_userconnect {
            white-space: normal;
            word-wrap: break-word;
            max-width: 250px;
            }
        .d-none { display: none; }

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

        <table>
            <tr>
                <td>
                    <button id="btnaddcustomer" class="btn btn-info btn-sm kh16-b">ចុះឈ្មោះថ្មី</button>
                    <button id="btnadditem" class="btn btn-info btn-sm kh16-b">បង្កើតឈ្មោះធនាគាដៃគូ</button>
                    <button id="btnadd_agent_type" class="btn btn-info btn-sm kh16-b">បង្កើតប្រភេទភ្នាក់ងារ</button>
                    <a href="{{ route('address.index') }}" class="btn btn-info btn-sm kh16-b" target="_blank">ចុះឈ្មោះខេត្តក្រុង</a>
                    <button id="btnprint" class="btn btn-info btn-sm kh16-b">ព្រីន</button>
                </td>
                <td class="kh16-b" style="text-align:right;">
                    ប្រភេទអតិថិជន
                </td>
                <td>
                  <select multiple class="select" id="sel_customertype" name="sel_customertype">
                      <option value="all">ALL</option>
                      <option value="BANK">BANK</option>
                      <option value="CUSTOMER">CUSTOMER</option>
                      <option value="PARTNER">PARTNER</option>
                      <option value="AGENT">AGENT</option>
                      <option value="NOLIST">NOLIST</option>
                      <option value="BUYER">BUYER</option>
                      <option value="SALER">SALER</option>

                  </select>
                </td>
                <td class="kh16-b" style="text-align:right;">
                 តំរៀបតាម
                </td>
                <td>
                  <select class="form-select kh16-b" name="selsortby" id="selsortby">
                    <option value="no">No</option>
                    <option value="name">Name</option>
                    <option value="customertype">Customer Type</option>
                  </select>
                </td>
                <td>
                    <input type="button" id="btnsearch" class="btn btn-info" value="Search">
                </td>
            </tr>
        </table>


   </div>
   <div class="row" style="margin-top:5px;">
        <div class="col-lg-6">
            <select name="selcompany" id="selcompany" class="form-select kh16-b">
               {{-- <option value="all">All Company</option> --}}
               @foreach ($companies as $comp)
                   <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}}>{{ $comp->name }}</option>
               @endforeach
           </select>
        </div>
        <div class="col-lg-6">
            <input type="text" class="kh16" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
        </div>

   </div>
   <div class="row">
        <table id="myTable" class="table table-bordered tbl_customer kh12-b" style="table-layout:fixed;">
            <thead style="text-align:center;">
                <th style="width:60px;">N <sup>o</sup></th>
                <th style="width:80px;">លរ</th>
                <th style="width:180px;">អតិថិជន</th>

                <th>លេខទូរស័ព្ទ</th>
                <th>អាស័យដ្ឋាន</th>
                <th>ទីតាំងបើកប្រាក់</th>
                <th>ថ្ងៃកត់ត្រា</th>
                <th>លេខបញ្ជីថៃ</th>
                <th>ភ្ជាប់បុគ្គលិក</th>
                <th style="width:100px;">សកម្មភាព</th>
            </thead>
            <tbody id="tbl_customer">
                @foreach ($customers as $key => $c)
                    @php
                        $addr='';
                        if($c->province_id){
                            $addr=$c->province->name;
                        }
                        if($c->district_id){
                            $addr .=' ' .$c->district->name;
                        }
                        if($c->commune_id){
                            $addr .=' ' .$c->commune->name;
                        }
                        if($c->village_id){
                            $addr .=' ' .$c->village->name;
                        }
                    @endphp
                    <tr>
                        <td style="text-align:center;width:50px;">{{ ++$key }}</td>
                        <td style="text-align:center;width:70px;padding:0px;">
                          <input type="text" class="form-control txtno" style="width:70px;text-align:center;" value="{{ $c->no }}" data-id="{{ $c->id }}">
                        </td>
                        <td style="width:180px;" title="id={{$c->id}}">
                            {{ $c->name }} @if($c->customertype!=='AGENT' && $c->customertype!=='BANK') @if($c->sex==1) (ប្រុស) @elseif($c->sex==0) (ស្រី) @else @endif  @endif<br>
                            <span style="font-size:8px;color:gray">
                                {{ $c->customertype . '(' . $c->agenttype->name . ')' }}
                            </span>

                        </td>
                        <td>{{ $c->tel }} <br> {{ 'ID:' . $c->idcard }}</td>
                        <td>{{ $addr }}</td>
                        <td>{{ $c->openaddress }} <br> {{ $c->company->name }}</td>
                        <td style="width:120px;">
                          {{ date('d-m-Y',strtotime($c->created_at)) }} <br> {{ $c->user->name }}
                        </td>
                        <td style="width:120px;">
                            {{ $c->thai_list }} <br> <span>List:{{ $c->showinlist }}</span> <span>Gold:{{ $c->is_gold_list }}</span>
                        </td>
                        {{-- <td style="width:120px;">
                            {{ App\Customer::separate_userconnect($c->user_connect) }}
                        </td> --}}
                        @php
                            $userconnectData = App\Customer::separate_userconnect($c->user_connect, 2, true);
                        @endphp

                        <td class="td_userconnect">
                            <span class="short-text">{!! $userconnectData['html'] !!}</span>
                            <span class="full-text d-none">{!! App\Customer::separate_userconnect($c->user_connect) !!}</span>

                            @if($userconnectData['has_more'])
                                <a href="javascript:void(0)" class="toggle-text kh14" style="color:blue;">more</a>
                            @endif
                        </td>
                        <td style="width:100px;text-align:center;">
                          <a href="#" style="padding:0px;" class="btn btn-sm btn_account" data-id="{{ $c->id }}" data-name="{{ $c->name }}" data-customertype="{{ $c->customertype }}" ><i class="fa fa-address-book-o"></i></a>
                          <a href="#" style="padding:0px;" class="btn btn-sm btn_edit" data-id="{{ $c->id }}" data-company="{{ $c->company_id }}" data-name="{{ $c->name }}" data-sex="{{ $c->sex }}" data-userconnect="{{ $c->user_connect }}" data-idcard="{{ $c->idcard }}" data-tel="{{ $c->tel }}" data-openaddr="{{ $c->openaddress }}" data-customertype="{{ $c->customertype }}" data-no="{{ $c->no }}" data-province="{{ $c->province_id }}" data-district="{{ $c->district_id }}" data-commune="{{ $c->commune_id }}" data-village="{{ $c->village_id }}" data-agent_type="{{ $c->agent_type_id }}"  data-thailist="{{ $c->thai_list }}" data-showinlist="{{ $c->showinlist }}" data-isgoldlist="{{ $c->is_gold_list }}"><i class="fa fa-pencil" style="color:green"></i></a>
                          <a href="#" style="padding:0px;" class="btn btn-sm btn_remove" data-id="{{ $c->id }}"><i class="fa fa-trash" style="color:red;"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
   </div>

    @include('customers.addcustomermodal')
    @include('customers.addaccount')
   @include('customers.additem')
   @include('customers.agenttypemodal')

@endsection
@section('script')
<script src="{{ config('helper.asset_path') }}/js/virtual-select.min.js"></script>
    @include('customers.addressscript');
    <script type="text/javascript">
        $('#h1_title').text('ចុះឈ្មោះអតិថិជន');
      $(document).ready(function () {
        getcustomerauto();
        $('.seluserconnect').select2();
            VirtualSelect.init({
                ele: '#sel_customertype' ,
            });
            $("#sel_province1").select2({
                dropdownParent: $("#addcustomermodal")
            });
            $("#sel_district1").select2({
                dropdownParent: $("#addcustomermodal")
            });
            $("#sel_commune1").select2({
                dropdownParent: $("#addcustomermodal")
            });
            $("#sel_village1").select2({
                dropdownParent: $("#addcustomermodal")
            });

        //     var url1 = "{{ route('cusname.autocomplete') }}";
        //   $( "#cusname" ).autocomplete({
        //   source: function( request, response ) {
        //     $.ajax({
        //       url: url1,
        //       type: 'GET',
        //       dataType: "json",
        //       data: {
        //         search: request.term.replace(/\s+/g, '')
        //       },
        //       success: function( data ) {
        //         response( data );
        //       }
        //     });
        //   },
        //   select: function (event, ui) {
        //       console.log(ui.item);
        //     $('#cusname').val(ui.item.label);
        //     //$('#recname').val(ui.item.recname);

        //     return false;
        //   }
        // });

        $('#image').on('change',function(e){
				showFile(this,'#showPhoto');
		})
        function showFile(fileInput,img,showName){
            if(fileInput.files[0]){
                var reader=new FileReader();
                reader.onload=function(e){
                    $(img).attr('src',e.target.result);
                }
                reader.readAsDataURL(fileInput.files[0]);
            }
            $(showName).text(fileInput.files[0].name);
        }
          $(document).on('click', '.toggle-text', function() {
                const $td = $(this).closest('td');
                const $short = $td.find('.short-text');
                const $full = $td.find('.full-text');

                if ($full.hasClass('d-none')) {
                    // show full
                    $short.addClass('d-none');
                    $full.removeClass('d-none');
                    $(this).text('less');
                } else {
                    // show short
                    $short.removeClass('d-none');
                    $full.addClass('d-none');
                    $(this).text('more');
                }
            });
        $(document).on('click','.row-edit',function(e){
				e.preventDefault();
				var id=$(this).data('id');
                var name=$(this).data('name');
                var logo=$(this).data('logo');
                var transfer_amount=$(this).data('transfer_amount');
                var customer_fee=$(this).data('customer_fee');
                var transfer_fee=$(this).data('transfer_fee');
                var cashdraw_fee=$(this).data('cashdraw_fee');

				$('#typeid').val(id);
                $('#txtitemtype').val(name);
                $('#old_image').val(logo);
                $('#transfer_amount').val(transfer_amount);
                $('#customer_fee').val(customer_fee);
                $('#transfer_fee').val(transfer_fee);
                $('#cashdraw_fee').val(cashdraw_fee);

				$('#btnsaveagenttype').val('Update');
                if(logo!=''){
                    $('#showPhoto').attr('src','{{ config('helper.asset_path') }}/logo/' + logo);
                }else{
                    $('#showPhoto').attr('src','{{ config('helper.asset_path') }}/logo/angkor.png');
                }
			})
            $(document).on('click','.row-delete',function(e){
				e.preventDefault();
				var c=confirm("Do you want to delete this item?");
				if(c==true){
					var url="{{ route('deleteagenttype') }}";
					var id=$(this).data('id');
					var logo=$(this).data('logo');
					$.post(url,{id:id,logo:logo},function(data){
						$('#btnnewagenttype').click();
                        readagenttype();
					})
				}
			})
            $(document).on('change','#company',function(e){
                e.preventDefault();

                getcustomerauto();
                getthaiacclist($(this).val(),'#thai_account')
                getuserbycompany($(this).val(),'#seluserconnect')
             })
        function getthaiacclist(company,el)
        {
            var arr;
            var url="{{ route('getthaiaccount') }}";
            $(el).empty();
            var arr=[];
            $.get(url,{company:company},function(data){
                $(el).append($("<option/>",{
                            value:'',
                            text:''
                        }))
                $.each(data,function(i,item){
                    $(el).append($("<option/>",{
                            value:item.accno,
                            text:item.accno
                        }))

                    arr.push({value:item.accno,label:item.accno,});
                });


            })
        }
         function getuserbycompany(company,el)
        {
            var arr;
            var url="{{ route('getusercompany') }}";
            $(el).empty();
            var arr=[];
            $.get(url,{company:company},function(data){
                // $(el).append($("<option/>",{
                //             value:'',
                //             text:''
                //         }))
                $.each(data,function(i,item){
                    $(el).append($("<option/>",{
                            value:item.id,
                            text:item.name
                        }))

                    arr.push({value:item.id,label:item.name,});
                });


            })
        }
        $('#frmagenttype').on('submit',function(e){
				e.preventDefault();
				var urlset="{{ route('storeagenttype') }}"

				var data= new FormData(this);
				$.ajax({
						type:"POST",
						url:urlset,
						data:data,
						datatype:"JSON",
						contentType:false,
						cache:false,
						processData:false,
						success:function(data){

							if($.isEmptyObject(data.error)){
								readagenttype();
								newagenttype();
								// document.body.scrollTop = scrolledit; // For Safari
  							    // document.documentElement.scrollTop = scrolledit; // For Chrome, Firefox, IE and Opera
							}else{
								alert(data.error)
							}
						}
					});
				})
            $(document).on('click','#btnnewagenttype',function(e){
                e.preventDefault();
                newagenttype();
            })
            function newagenttype()
            {
                $('#frmagenttype').trigger('reset');
                $('#txtitemtype').focus();
                $('#btnsaveagenttype').text('Save');
                $('#showPhoto').attr('src','{{ config('helper.asset_path') }}/logo/angkor.png');
            }
            function readagenttype() {
				var url="{{ route('readagenttype') }}";
				$.get(url,{a:'a'},function(data){
					$('#body_mainitemtypelist').empty().html(data);
				})
			}

        function getcustomerauto()
        {
            var company=$('#company').val();
            $.ajax({
                    async: true,
                    type: 'GET',
                    url: "{{ route('cusname.autocomplete') }}",
                    data: {company:company},
                    complete: function () {

                    },
                    success: function (data) {

                    $("#cusname").autocomplete({
                        source: function (request, response) { // use a function so you can trim the request and ignore ""
                            var term = $.trim(request.term).replace(/\s+/g, '')
                            var reg = new RegExp($.ui.autocomplete.escapeRegex(term), "i")
                            if (term !== "") response($.grep(data, function (tag) {
                                //return tag.value.match(reg)
                                return tag.value.match(reg)

                            }))
                        },

                        select: function (e, ui) {
                            //location.href = ui.item.the_link;
                            //console.log(ui.item.recname);
                            $('#cusname').val(ui.item.value);
                        }

                    });
                    },
                    error: function () {
                        alert('Read Phone Number Error.')
                    }
                })
        }
        // $(document).on('keydown','.tdcanenter',function(e){

        //   if (e.keyCode == 13) {
        //         var $this = $(this),
        //         index = $this.closest('td').index();
        //         $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
        //         e.preventDefault();
        //     }
        //   })

          $(document).on('keydown','.txtno',function(e){

            if (e.keyCode == 13) {
              var id=$(this).data('id');
              var no=$(this).val();
              var url="{{ route('customer.updateno') }}";
              $.post(url,{id:id,no:no},function(data){
                toastr.success('Update Product No Successfully');

              })

              var $this = $(this),
              index = $this.closest('td').index();
              $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
              e.preventDefault();
            }
          })


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
         $(document).on('click','.tbl_agenttype td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','.tbl_partner_account td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
            $(document).on('click','#btnaddcustomer',function(){
                $('#txtcusid').val('');
                $('#frmcustomer').trigger('reset');
                $('#seluserconnect').val(0);
                $('#seluserconnect').trigger('change');
                $('#addcustomermodal').modal('show');
                $('#modalheader').text('ចុះឈ្មោះអតិថិជន');
                $('#btnsavecustomer').text('Save');
                getmaxno();
            })
            function getmaxno(){
                var url="{{ route('customer.getmaxcustomerno') }}";
                $.get(url,{},function(data){
                    $('#no').val(data['maxno']);
                })
            }
            $(document).on('click','.btn_account',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var name=$(this).data('name');
                $('#addaccount').modal('show');
                $('#acc_partner_id').val(id);
                $('#acc_partner_name').val(name);
                getpartneraccount(id);
                getitem('#selitem');
                getlocation();
            })

            $(document).on('click','#btnsave_account',function(e){
              e.preventDefault();
              var url="{{ route('customer.savepartneraccount') }}";
              var formdata=new FormData(frm_partner_account);
              $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                complete: function () {

                },
                success: function (data) {

                    //debugger;
                    clearaccount();
                    getlocation();
                    getpartneraccount($('#acc_partner_id').val());
                    if($.isEmptyObject(data.error)){
                        $('body').removeClass("wait");
                    }else{
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Save Error.')
                }

            })
          })
          $(document).on('click','#btnnew_account',function(e){
            e.preventDefault();
            clearaccount();
            $('#account_id').val('');
            $('#btnsave_account').text('រក្សាទុក');
            $('#location').val('');

          })
          function clearaccount()
          {

            $('#ac_name_r').val('');
            $('#ac_r').val('');
            $('#ac_name_b').val('');
            $('#ac_b').val('');
            $('#ac_name_d').val('');
            $('#ac_d').val('');
          }
          $(document).on('click','#btnadditem',function(e){
            e.preventDefault();
            $('#additem').modal('show');
            getmainitemlist();
          })
          $(document).on('click','#btnadd_agent_type',function(e){
            e.preventDefault();
            $('#addagenttypemodal').modal('show');
            readagenttype();

          })
          $(document).on('click','#btnsaveitem',function(e){
            e.preventDefault();
            var url="{{ route('storeitem') }}";
            var itemname=$('#txtitem').val();
            $.post(url,{itemname:itemname},function(data){
                if($.isEmptyObject(data.error)){
                  getmainitemlist();
                  $('#txtitem').val('');
                  $('#txtitem').focus();
                }else{

                    alert(data.error)
                }
            })
          })
          function getlocation()
          {
            var locationoptions = '';
            var url="{{ route('customer.getlocationinfo') }}";
            $.get(url,{},function(data){

              //use with datalist
              $.each(data['data'],function(i,item){
                locationoptions += '<option value="' + item.location + '" />';
              });
              document.getElementById('locationlist').innerHTML = locationoptions;
            })

          }
          function getitem(el)
          {
            //debugger;
            $(el).empty();

            var url="{{ route('customer.getiteminfo') }}";
            $.get(url,{},function(data){

              //use with datalist
              // $.each(data['item'],function(i,item){
              //   itemlistoptions += '<option value="' + item.item + '" />';
              // });
              // document.getElementById('itemlist').innerHTML = itemlistoptions;

              $(el).append($("<option/>",{
                          value:'',
                          text:''
                      }))
              $.each(data['data'],function(i,item){
                  $(el).append($("<option/>",{
                          value:item.id,
                          text:item.name
                      }))
              });
            })
          }
          function getpartneraccount(customerid)
          {
            var url="{{ route('customer.getcustomeraccount') }}";
            $.get(url,{customerid:customerid},function(data){
              $('#body_account').empty();

                 var output='';
                      for(var i=0;i<data['account'].length;i++){
                        output +=
                        `<tr>
                            <td style="text-align:center;" class="kh16">
                              ${i+1}
                            </td>

                            <td class="kh16">
                                ${data['account'][i].customer.name}
                            </td>
                            <td class="kh16">
                                ${data['account'][i].item.name}
                            </td>
                            <td class="kh16">
                                ${data['account'][i].location??''}
                            </td>
                            <td class="kh16">
                                ${data['account'][i].ac_name_r??''}
                            </td>
                             <td class="kh16">
                                ${data['account'][i].ac_r??''}
                            </td>
                            <td class="kh16">
                                ${data['account'][i].ac_name_d??''}
                            </td>
                             <td class="kh16">
                                ${data['account'][i].ac_d??''}
                            </td>
                            <td class="kh16">
                                ${data['account'][i].ac_name_b??''}
                            </td>
                             <td class="kh16">
                                ${data['account'][i].ac_b??''}
                            </td>
                            <td class="kh16">
                                ${data['account'][i].regby}
                            </td>
                            <td class="kh16">
                                ${ moment(data['account'][i].regdate).format("DD-MM-YYYY") }
                            </td>
                            <td class="kh16" style="text-align:center;">
                              <a href="#" style="padding:0px;" class="btn btn-sm btn_edit_account" data-id="${data['account'][i].id}" data-selitem="${data['account'][i].item_id}" data-location="${data['account'][i].location}"
                                data-acr="${data['account'][i].ac_r}" data-acnr="${data['account'][i].ac_name_r}" data-acd="${data['account'][i].ac_d}" data-acnd="${data['account'][i].ac_name_d}" data-acb="${data['account'][i].ac_b}" data-acnb="${data['account'][i].ac_name_b}">
                                <i class="fa fa-pencil" style="color:green"></i>
                              </a>
                              <a href="#" style="padding:0px;" class="btn btn-sm btn_remove_account" data-id="${data['account'][i].id}"><i class="fa fa-trash" style="color:red;"></i></a>
                            </td>

                        </tr>`;
                    }
                    $('#body_account').empty().html(output);
            })
          }
          function getmainitemlist()
          {
            var url="{{ route('getmainitemlist') }}";
            $.get(url,{},function(data){
              $('#body_mainitemlist').empty();

                 var output='';
                      for(var i=0;i<data['mainitem'].length;i++){
                        output +=
                        `<tr>
                            <td class="kh16">
                              ${i+1}
                            </td>
                            <td class="kh16">
                                ${data['mainitem'][i].name}
                            </td>
                            <td class="kh16">
                                ${ moment(data['mainitem'][i].created_at).format("DD-MM-YYYY hh:mm:ss") }
                            </td>
                            <td class="kh16">
                                <button class="btn btn-danger btn-sm btndelmainitem" data-id=" ${data['mainitem'][i].id}">Del</button>
                            </td>
                        </tr>`;
                    }
                    $('#body_mainitemlist').empty().html(output);
            })
          }
          $(document).on('click','.btndelmainitem',function(e){
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
                            url: "{{ route('deletemainitem') }}",
                            data: { id:id },
                            success: function (data) {

                                if (data.success === true) {
                                    getmainitemlist();
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
          $(document).on('click','.btn_edit_account',function(e){
                $('#account_id').val($(this).data('id'));
                $('#selitem').val($(this).data('selitem'));
                $('#location').val($(this).data('location'));
                $('#ac_name_r').val($(this).data('acnr'));
                $('#ac_r').val($(this).data('acr'));
                $('#ac_name_d').val($(this).data('acnd'));
                $('#ac_d').val($(this).data('acd'));
                $('#ac_name_b').val($(this).data('acnb'));
                $('#ac_b').val($(this).data('acb'));
                $('#btnsave_account').text('កែប្រែ');

          })
            $(document).on('click','.btn_edit',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var name=$(this).data('name');
                var tel=$(this).data('tel');
                var userconnect=$(this).data('userconnect').toString();
                //debugger;
                if(userconnect.indexOf(',')>=0){
                   userconnect=$(this).data('userconnect').split(',');
                }
                var company_id=$(this).data('company');
                var openaddr=$(this).data('openaddr');
                var province=$(this).data('province');
                var district=$(this).data('district');
                var commune=$(this).data('commune');
                var village=$(this).data('village');
                var custype=$(this).data('customertype');
                var agentype=$(this).data('agent_type');
                var idcard=$(this).data('idcard');
                var sex=$(this).data('sex');
                var no=$(this).data('no');
                var showinlist=$(this).data('showinlist');
                var isgoldlist=$(this).data('isgoldlist');
                var thailist=$(this).data('thailist');
                $('#txtcusid').val(id);
                $('#cusname').val(name);
                $('#tel').val(tel);
                $('#no').val(no);
                $('#idcard').val(idcard);
                $('#addr').val(openaddr);
                $('#company').val(company_id);
                $('#seluserconnect').val(userconnect);
                $('#seluserconnect').trigger('change');
                $('#sel_province1').val(province);
                $('#sel_province1').trigger('change');
                $('#sel_district1').val(district);
                $('#sel_district1').trigger('change');
                $('#sel_commune1').val(commune);
                $('#sel_commune1').trigger('change');
                $('#sel_village1').val(village);
                $('#sel_village1').trigger('change');
                $('#seltype').val(custype);
                $('#selagenttype').val(agentype);
                if(parseFloat(sex)==1){
                    const m = document.getElementById('radmale');
                    m.checked=true;
                }else if(sex==0){
                    const m = document.getElementById('radfemale');
                    m.checked=true;
                }else{
                    const m = document.getElementById('radnosex');
                    m.checked=true;
                }

                $('#thai_account').val(thailist);
                $('#addcustomermodal').modal('show');
                $('#modalheader').text('កែប្រែព៌តមានអតិថិជន');
                $('#btnsavecustomer').text('Update');

                if(showinlist==1){
                    $('#showinlist').attr('checked',true);
                }else{
                    $('#showinlist').attr('checked',false);
                }
                if(isgoldlist==1){
                    $('#is_gold_list').attr('checked',true);
                }else{
                    $('#is_gold_list').attr('checked',false);
                }

            })

            $(document).on('click','#btnsavecustomer',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var formdata = new FormData(frmcustomer);
                // var cus_id=$('#customer_id').text();
                 //formdata.append("cur1",cur1);
                 var btntext=$(this).text();
                var url="{{ route('customer.store') }}";
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                        //console.log(data)
                       if($.isEmptyObject(data.error)){
                            //location.reload();
                            toastr.success('Save Customer Successfully');
                            getcustomer();
                            getcustomerauto();
                            if(btntext=='Save'){
                                cleartext();
                                getmaxno();
                            }else{
                                $('#frmcustomer').trigger('reset');
                                $('#addcustomermodal').modal('hide');
                            }
                            $('body').removeClass("wait");
                       }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                       }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Save Error')

                    }

                })
            })
            function cleartext()
            {
                $('#cusname').val('');
                $('#tel').val('');
                $('#addr').val('');
                $('#seluserconnect').val('');
                $('#seluserconnect').trigger('change');
                $('#cusname').focus();
                $('#thai_account').val('');
            }
            function getcustomer()
            {
                var seltype=$('#sel_customertype').val();
                if(seltype.includes('all')==true || seltype=='' || seltype.length==0){
                  seltype="all";
                }
                var sortby=$('#selsortby').val();
                var selcompany=$('#selcompany').val();
                $('body').addClass("wait");
                var url="{{ route('customer.searchbytype') }}";
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {custype:seltype,sortby:sortby,selcompany:selcompany},

                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                        $('#tbl_customer').empty().html(data);
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            }
            $(document).on('change','#sel_customertype',function(e){
                //getcustomer();
            })
            $(document).on('click','#btnsearch',function(e){
                e.preventDefault();
                getcustomer();
            })
            $(document).on('change','#selcompany',function(e){
                e.preventDefault();
                getcustomer();
            })
            $(document).on('change','#selagenttype',function(e){
                e.preventDefault();
                var id=$('#txtcusid').val();
                if(id==''){
                    $('#maxtransferamt').val('');
                    $('#maxfeeagent').val('');
                }
            })
            $(document).on('click','#btnprint',function(e){
                  e.preventDefault();
                  var seltype=$('#sel_customertype').val();
                  var sortby=$('#selsortby').val();
                  var redirectWindow = window.open('{{ url('/') }}'+'/customer/print?custype='+seltype+'&sortby='+sortby, '_blank');
                  redirectWindow.location;
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
                            url: "{{ route('customer.delete') }}",
                            data: { id:id },
                            success: function (data) {

                                if (data.success === true) {
                                    //location.reload();
                                    getcustomer();
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
            $(document).on('click','.btn_remove_account',function(e){
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
                            url: "{{ route('customer.deleteaccount') }}",
                            data: { id:id },
                            success: function (data) {

                                if (data.success === true) {
                                    //location.reload();
                                    getpartneraccount($('#acc_partner_id').val());
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
