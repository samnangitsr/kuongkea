<script type="text/javascript">
    $('#h1_title').text('លក់អចលនទ្រព្យ');
    var windowWidth = $(window).width();
    var windowHeight = $(window).height();
    var divheight=windowHeight-200;
    var tableFixHead=document.getElementsByClassName('tableFixHead');
    for(i=0; i<tableFixHead.length; i++) {
        tableFixHead[i].style.height=divheight+'px';
    }
    $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-200;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
    });

    var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
    const userId = "{{ Auth::id() }}";

    //ជំរើសទី១
    // const userPerms = new Set(getUserPermissions(userId));
    // function getUserPermissions(userId) {
    //     const permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
    //     return permusers
    //         .filter(item => item.userid == userId)
    //         .map(item => item.code);
    // }

    // if (!isAdmin) {
    //     if (!userPerms.has('1.1.1')) {
    //         $('.li_code111').hide(); // Shorter way to hide
    //     }
    //     if (!userPerms.has('1.1.2')) {
    //         $('.li_code112').hide();
    //     }
    //     if (!userPerms.has('1.1.3')) {
    //         $('.li_code113').hide();
    //     }
    // }



    //ជំរើសទី២ call back function
    function getUserPermissions(userId, callback) {
        const permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
        const codes = permusers
            .filter(item => item.userid == userId)
            .map(item => item.code);

        if (typeof callback === 'function') {
            callback(new Set(codes)); // Pass Set to match previous usage
        }
    }


    function checkright(userPerms) {
        //console.log(userPerms)
        if (!userPerms.has('1.1.1')) $('.li_code111').hide();
        if (!userPerms.has('1.1.2')) $('.li_code112').hide();
        if (!userPerms.has('1.1.3')) $('.li_code113').hide();

    }




    $(document).ready(function () {
        if (!isAdmin) {
            getUserPermissions(userId, function(userPerms) {
                checkright(userPerms); // ✅ Call after data is ready
            });
        }
    var today=new Date();
      $('#invdate,#d1,#d2,#startdate,#enddate').datetimepicker({
          timepicker:false,
          datepicker:true,
          value:today,
          format:'d-m-Y',
          autoclose:true,
          todayBtn:true,
          startDate:today,
      });
      //$('#invdate').datetimepicker("destroy");
      $('#selpartner').select2({templateResult: formatOption});
      $('#selsaler').select2();
      $('#sel_property').select2();
      $('#search_property').select2();
      $('#selbank').select2();

      function formatOption(option) {
            if (!option.id) {
                return option.text;
            }
		// Use a <div> to display the main text and a second line
        // option.element.value is get value from select
            var $option = $(
                '<div class="select2-option">' +
                    '<div class="select2-option-main">' + option.text + '</div>' +
                    '<div class="select2-option-sub" class="kh12-b" style="border-bottom:1px dashed grey;">' + (option.selected ? 'ID:'+ option.element.getAttribute('idcard')+ ' Tel:'+option.element.getAttribute('tel')+ ' Sex:'+option.element.getAttribute('sex')+ ' Age:'+option.element.getAttribute('age') : 'ID:'+option.element.getAttribute('idcard')+ ' Tel:' +option.element.getAttribute('tel')+ ' Sex:'+option.element.getAttribute('sex')+ ' Age:'+option.element.getAttribute('age')) + '</div>' +
                '</div>'
            );
            return $option;
			}
        var cleavebankamt = new Cleave('#bankamt', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
    var cleavecommission = new Cleave('#commission', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleavedeposit = new Cleave('#deposit', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleavepaycomission = new Cleave('#paycommission', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleavediscount = new Cleave('#discount', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleavepayinmonth = new Cleave('#payinmonth', {
          numeral: true,
          numeralDecimalScale: 2,
          numeralThousandsGroupStyle: 'thousand'
      });
      $(document).on('change','#term',function(e){
        e.preventDefault();
        setenddate();
      })
      $(document).on('blur','#startdate',function(e){
        e.preventDefault();
        setenddate();
      })
      function setenddate(){

        var dd=$('#startdate').val();
        var d=dd.split("-")[0];
        var m=dd.split("-")[1];
        var y=dd.split("-")[2];
        const startdate=new Date(y + '-' + m + '-' + d);
        var month= $('#term').val();
        var enddate= addMonths(parseFloat(month),startdate);
        console.log(enddate)
        $('#enddate').val(moment(enddate).format("DD-MM-YYYY"));
      }

      function setnextmonth(){
            var trdate=$('#invdate').val();
            var arr_date=trdate.split('-');
            const dd = new Date(arr_date[2] + '-' + arr_date[1] + '-' + arr_date[0]);
            var paydate=addMonths(1, dd);
            $('#ratedate').val(moment(paydate).format("DD-MM-YYYY"));
        }
      function addMonths(numOfMonths, date = new Date()) {
            date.setMonth(date.getMonth() + numOfMonths);
            return date;
        }
        $(document).on('change','#selpartner',function(e){
            e.preventDefault();
            var sp = document.querySelector("#selpartner");
            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype') ?? '';
            var tel=sp.options[sp.selectedIndex].getAttribute('tel') ?? '';
            var idcard=sp.options[sp.selectedIndex].getAttribute('idcard') ?? '';
            var age=sp.options[sp.selectedIndex].getAttribute('age') ?? '';
            var sex=sp.options[sp.selectedIndex].getAttribute('sex') ?? '';
            $('#idcard').val(idcard);
            $('#idcard').attr('title',$(this).val());
            $('#tel').val(tel);
            $('#sex').val(sex);
            $('#age').val(age ? age + ' ឆ្នាំ' : '');
        })
        $(document).on('change','#sel_property',function(e){
            e.preventDefault();
            $('#btnaddlist').attr('title',$(this).val());
        })
        $(document).on('change','#selsaler',function(e){
            e.preventDefault();
            $('#lblsaler').attr('title',$(this).val());
        })
        $(document).on('change','#discount,#disc_by',function(e){
            e.preventDefault();
            dodiscount();
            dodeposit();
        })
        function dodiscount(){
            var price=$('#amount').val().replace(/,/g,'');
            var disc=$('#discount').val().replace(/,/g,'');
            var disby=$('#disc_by').val();
            var pricedisc=0;
            if(disby=='%'){
                pricedisc=(parseFloat(price)*parseFloat(disc))/100;
            }else{
                pricedisc=disc;
            }
            var priceafterdiscount=parseFloat(price)-parseFloat(pricedisc);
            $('#amountdiscount').val(formatNumber(priceafterdiscount));

        }
        $(document).on('change','#deposit',function(e){
            e.preventDefault();
            dodeposit();
        })
        function dodeposit(){
            var amtdis=0;
            if($('#m_title').text()=='បង់ប្រាក់'){
                amtdis=$('#balance').val().replace(/,/g,'');
            }else{
                amtdis=$('#amountdiscount').val().replace(/,/g,'');
            }
            var deposit=$('#deposit').val().replace(/,/g,'');
            var balance=0;
            balance=parseFloat(amtdis)-parseFloat(deposit);
            $('#balance1').val(formatNumber(balance));
            $('#bankamt').val(formatNumber(deposit));

        }
      $(document).on('change','#selproject',function(e){
        e.preventDefault();

            var url="{{ route('realestate.getpropertybygroup') }}";
            $('#sel_property').empty();
            var group=$(this).val();
            $.get(url,{groupid:group},function(data){
                console.log(data)
                $("#sel_property").append($("<option/>",{
                            value:'',
                            text:''
                        }))
                $.each(data['myproperty'],function(i,item){
                    $('#sel_property').append($("<option/>",{
                            value:item.pid,
                            text:item.pname,
                            size:item.size,
                            price:item.price,
                            cur:item.currency_shortcut,
                            curid:item.currency_id,
                            com_payoff:item.com_payoff,
                            com_payloan:item.com_payloan,
                            property_group:item.pgroupid
                        }))
                    //console.log(item)
                });
                $('#sel_property').select2('open');

            })

      })
      $(document).on('change','#paymenttype',function(e){
        e.preventDefault();
        if($(this).val()==2){
            $('#row_term').css('display','table-row');
            $('#row_duration').css('display','table-row');
            $('#row_payinmonth').css('display','table-row');

        }else{
            $('#row_term').css('display','none');
            $('#row_duration').css('display','none');
            $('#row_payinmonth').css('display','none');
        }

        if($('#id1').val()==''){
            totalamount();
        }else{
            refreshcommission();
        }
      })
      $(document).on('click','.tbl_transferlist td',function(e){
            // Remove previous highlight class
            $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
        })
        function checkcontract(customerid,salerid,pid,callback){
            $('body').addClass("wait");
            var url="{{ route('realestate.checkcontract') }}";

            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {customerid:customerid,salerid:salerid,pid:pid},

                complete: function () {},
                success: function (data) {
                    console.log(data)
                    if(data['check']==true){
                        callback();
                    }else{
                        alert('this property not match to customer and saler');
                    }
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
        $(document).on('click','.tbllist td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
        $(document).on('click','#btnfindcontract',function(e){
            e.preventDefault();
            $('.tbllist').css('display','block');
            $('#btnclosecontract').css('display','table-row');
            findcontract();
        })
        $(document).on('click','#btnclosecontract',function(e){
            e.preventDefault();
            $('.tbllist').css('display','none');
            $('#btnclosecontract').css('display','none');

        })
        function findcontract(){
            $('body').addClass("wait");
            var url="{{ route('realestate.findcontract') }}";
            // var d1=$('#d1').val();
            // var d2=$('#d2').val();
            var customer_id=$('#selpartner').val();
            $('#bodycontract').empty();
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {customer_id:customer_id},

                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    var row='';
                    var k=0;
                    for(i=0;i<data['contracts'].length;i++){
                        k+=1;
                        row=`
                            <tr>
                                <td class="kh14" style="text-align:center;">${k}</td>
                                <td class="kh14">${ moment(data['contracts'][i].reg_date).format("DD-MM-YYYY") }</td>
                                <td class="kh14" title="${data['contracts'][i].customer_id}">${ data['contracts'][i].name_b }</td>
                                <td class="kh14" title="${data['contracts'][i].saler_id}">${ data['contracts'][i].name_c }</td>
                                <td class="kh14" title="${data['contracts'][i].property_id}">${ data['contracts'][i].propertyname }</td>
                                <td class="kh14">${ data['contracts'][i].size??'' }</td>
                                <td class="kh14-b" style="text-align:right;">${ formatNumber(data['contracts'][i].price) }$</td>
                                <td class="kh14-b" style="text-align:right;">${ formatNumber(data['contracts'][i].discount ?? 0) } ${ data['contracts'][i].disc_by ?? '' }</td>
                                <td class="kh14-b" style="text-align:right;">${ formatNumber(data['contracts'][i].priceafterdiscount??data['contracts'][i].price) }$</td>

                                <td class="kh14-b" style="text-align:right;">${ formatNumber(data['contracts'][i].pay) }$</td>
                                <td class="kh14" style="text-align:center;">${ data['contracts'][i].d + ' ' + data['contracts'][i].m + ' ' + data['contracts'][i].y }</td>
                                <td class="kh14">${ data['contracts'][i].paytype==1?'បង់ផ្តាច់':'រំលស់' }</td>
                            </tr>
                        `;
                        $('#bodycontract').append(row);
                    }
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
         }
        function addlist()
        {
            if($('#sel_property').val()=='') return;
            var sp = document.querySelector("#sel_property");
            var size=sp.options[sp.selectedIndex].getAttribute('size');
            var size1=sp.options[sp.selectedIndex].getAttribute('size1');
            var price=sp.options[sp.selectedIndex].getAttribute('price');
            var cur=sp.options[sp.selectedIndex].getAttribute('cur');
            var curid=sp.options[sp.selectedIndex].getAttribute('curid');
            var com_payoff=sp.options[sp.selectedIndex].getAttribute('com_payoff');
            var com_payloan=sp.options[sp.selectedIndex].getAttribute('com_payloan');
            var pgroup=sp.options[sp.selectedIndex].getAttribute('property_group');

            $('#txtcur').val(cur);
            $('#txtcur1').val(cur);
            $('.cur').val(cur);
            $('#txtcur').attr('title',curid);
            var pname=$('#sel_property option:selected').text();
            var pid=$('#sel_property').val();
            var row='';
           var checkname=$('#body_sale_detail tr > td:contains('+ pname +')').length;
           if(checkname>0){
                alert('this property already add')
                return;
           }
            var table = document.getElementById("tbl_sale_detail");
            var numrow = table.tBodies[0].rows.length;
            row=`
                <tr class="item">
                    <td class="kh14 no" style="text-align:center;">${numrow+1}</td>
                    <td style="display:none;">
                         <input type="text" class="input-group pid kh14-b" name="pid[]" style="width:60px;padding:0px 5px;" value="${pid}" readonly>
                    </td>
                    <td class="kh14-b pname" name="pname[]">${pname}</td>
                    <td class="kh14-b psize" name="psize[]">${size1}</td>
                    <td class="kh14-b" style="padding:0px;border-right:none;">
                        <div class="input-group">
                            <input type="text" class="form-control p_price kh14-b" name="p_price[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(price)}" readonly>
                            <input type="text" class="input-group p_cur kh14-b" name="p_cur[]" style="width:60px;padding:0px 5px;border-style:none;height:25px;margin-top:3px;background-color:transparent;" value="${cur}" readonly>
                        </div>
                    </td>

                    <td style="display:none;">
                        <input type="text" class="input-group p_cur_id kh14-b" name="p_cur_id[]" style="width:60px;padding:0px 5px;" value="${curid}" readonly>
                    </td>
                    <td style="padding:0px;">
                        <input type="text" class="form-control com_payoff kh14-b" name="com_payoff[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(com_payoff)}" readonly>


                    </td>
                   <td style="padding:0px;">
                        <input type="text" class="form-control com_payloan kh14-b" name="com_payloan[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(com_payloan)}" readonly>
                    </td>
                    <td style="text-align:center;padding:5px 0px;">
                        <a href="" class="btnremoveitem"><i class="fa fa-trash" style="color:red;"></i></a>
                    </td>
                    <td class="kh14-b pgroup" name="pgroup[]" style="display:none;">${pgroup}</td>
                </tr>
            `;
            $('#body_sale_detail').append(row);
            $('.p_price').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
            $('#sel_property').val('');
            $('#sel_property').trigger('change');
            totalamount();
        }
        $(document).on('click','#btnaddlist',function(e){
            e.preventDefault();
            //debugger;
            checkcontract($('#selpartner').val(),$('#selsaler').val(),$('#sel_property').val(),addlist);
        })
        $(document).on('click','.btnremoveitem',function(e){
            e.preventDefault();
            var index=$(this).closest('tr').index();
            document.getElementById("body_sale_detail").deleteRow(index);
            ResetNo();
            totalamount();
        })//btnremoveitem
        function ResetNo(){
          $('.no').each(function(i,e){
              $(this).text(i+1);
          })
      }
      $(document).on('change','.p_price',function(e){
        e.preventDefault();
        totalamount();
      })
      function totalamount()
      {
        //debugger;
        var total=0;
        var total_payoff=0;
        var total_payloan=0;
        var propertyname='';
        var property_id='';
        var groupid='';
        $("tr.item").each(function() {
            total +=parseFloat($(this).find("input.p_price").val().replace(/,/g, ''));
            total_payoff +=parseFloat($(this).find("input.com_payoff").val().replace(/,/g, ''));
            total_payloan +=parseFloat($(this).find("input.com_payloan").val().replace(/,/g, ''));
            if(propertyname==''){
                property_id ='(' + $(this).find("input.pid").val() + ')';
                propertyname=$(this).find("td").eq(2).text();
                groupid='('+$(this).find("td").eq(9).text()+')';
            }else{
                property_id =property_id + '(' + $(this).find("input.pid").val() + ')';
                propertyname  =propertyname + ' , ' + $(this).find("td").eq(2).text();
                groupid  =groupid + '(' + $(this).find("td").eq(9).text()+')';
            }
        })
        $('#amount').val(formatNumber(total));
        $('#amount').attr('title',property_id);
        $('#commission').attr('title',propertyname);
        $('#discount').attr('title',groupid);
        if($('#paymenttype').val()==1){
            $('#commission').val(formatNumber(total_payoff));
        }else if($('#paymenttype').val()==2){
            $('#commission').val(formatNumber(total_payloan));
        }
        dodiscount();
      }
      function refreshcommission()
      {
        //debugger;

        var total_payoff=0;
        var total_payloan=0;
        var propertyname='';
        var property_id='';
        var groupid='';
        $("tr.item").each(function() {

            total_payoff +=parseFloat($(this).find("input.com_payoff").val().replace(/,/g, ''));
            total_payloan +=parseFloat($(this).find("input.com_payloan").val().replace(/,/g, ''));
            if(propertyname==''){
                property_id ='(' + $(this).find("input.pid").val() + ')';
                propertyname=$(this).find("td").eq(2).text();
                groupid='('+$(this).find("td").eq(9).text()+')';
            }else{
                property_id =property_id + '(' + $(this).find("input.pid").val() + ')';
                propertyname  =propertyname + ' , ' + $(this).find("td").eq(2).text();
                groupid  =groupid + '(' + $(this).find("td").eq(9).text()+')';
            }
        })

        $('#amount').attr('title',property_id);
        $('#commission').attr('title',propertyname);
        $('#discount').attr('title',groupid);
        if($('#paymenttype').val()==1){
            $('#commission').val(formatNumber(total_payoff));
        }else if($('#paymenttype').val()==2){
            $('#commission').val(formatNumber(total_payloan));
        }

      }
      $(document).on('keydown', '.canenter', function (e) {
          if (e.keyCode == 13) {
              var id = $(this).attr("id");
              if (id == 'amount') {
                $('#discount').focus();
              } else if(id == 'discount'){
                $('#deposit').focus();
              } else if (id == 'deposit'){
                $('#balance1').focus();
              }else if (id == 'balance1'){
                $('#paymenttype').focus();
              }else if (id == 'commission'){
                $('#btnsavesale').focus();
              }else if (id == 'paymenttype'){
                $('#commission').focus();
              }
              e.preventDefault();
          }
      })
      $(document).on('click','#btnsavesale,#btnsavesaleprint',function(e){

        e.preventDefault();
        var table = document.getElementById("tbl_sale_detail");
        var tbodyRowCount = table.tBodies[0].rows.length;
        if(tbodyRowCount==0){
            alert('save not allow')
            return;
        }

        var deposit=$('#deposit').val().replace(/,/g,'');
        var payamt=$('#bankamt').val().replace(/,/g,'');
        if(parseFloat(payamt)>parseFloat(deposit)){
            alert('receive amount can not bigger than month payment amount');
            return;
        }
        if($('#selbank').val()=='cash'){
            if(parseFloat(payamt)!==parseFloat(deposit)){
                alert('receive amount must be the same to payment amount');
                return;
            }
        }

        var elid=$(this).attr('id');
        if(elid=='btnsavesale'){
            savesale(0,$(this),$(this).text());
        }else{
            savesale(1,$(this),$(this).text());
        }
      })
      $(document).on('click','#btnsavedeposit,#btnsavedepositprint',function(e){

        e.preventDefault();
        var table = document.getElementById("tbl_sale_detail");
        var tbodyRowCount = table.tBodies[0].rows.length;
        if(tbodyRowCount==0){
            alert('save not allow')
            return;
        }
        var deposit=$('#deposit').val().replace(/,/g,'');
        var payamt=$('#bankamt').val().replace(/,/g,'');
        if(parseFloat(payamt)>parseFloat(deposit)){
            alert('receive amount can not bigger than month payment amount');
            return;
        }
        if($('#selbank').val()=='cash'){
            if(parseFloat(payamt)!==parseFloat(deposit)){
                alert('receive amount must be the same to payment amount');
                return;
            }
        }
        var elid=$(this).attr('id');
        if(elid=='btnsavedeposit'){
            savedeposit(0,$(this),$(this).text());
        }else{
            savedeposit(1,$(this),$(this).text());
        }

    })
      function savesale(isprint,el,btntext)
      {
          $('body').addClass("wait");
          $(el).attr('disabled', true).text("Processing");
          var formdata=new FormData(frmsaleland);
          var curid=$('#txtcur').attr('title');
          var invdate=$('#invdate').val();
          var deposit_via=$('#selbank option:selected').text();
          var propertyname=$('#commission').attr('title');
          var groupid=$('#discount').attr('title');
          var propertyid=$('#amount').attr('title');
          formdata.append('invdate',invdate);
          formdata.append('curid',curid);
          formdata.append('deposit_via',deposit_via);
          formdata.append('propertyname',propertyname);
          formdata.append('groupid',groupid);
          formdata.append('propertyid',propertyid);
          var url="{{ route('realestate.store') }}";
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
                  console.log(data)
                  if($.isEmptyObject(data.error)){
                    if(isprint==1){
                        printtransfers(data.id,'បង្កាន់ដៃលក់');
                    }

                      gettransferlist($('#d1').val(),$('#d2').val(),1);
                      toastr.success("Save Sale Successfully");
                      $(el).removeAttr('disabled').html(btntext);
                      if($('#id1').val()==''){

                          $('#frmsaleland').trigger('reset');
                          $('#body_sale_detail').empty();
                          $('#selpartner').trigger('change');
                          $('#selsaler').trigger('change');
                          var today=new Date();
                            $('#invdate').datetimepicker({
                                timepicker:false,
                                datepicker:true,
                                value:today,
                                format:'d-m-Y',
                                autoclose:true,
                                todayBtn:true,
                                startDate:today,
                            });
                      }

                      $('body').removeClass("wait");

                  }else{
                    $(el).removeAttr('disabled').html(btntext);
                      $('body').removeClass("wait");
                      alert(data.error)

                  }
              },
              error: function () {
                $(el).removeAttr('disabled').html(btntext);
                  $('body').removeClass("wait");
                  alert('Save Error.')

              }

          })

      }
      function savedeposit(isprint,el,btntext)
      {
            $('body').addClass("wait");
            $(el).attr('disabled', true).text("Processing");
            var formdata=new FormData(frmsaleland);
            var curid=$('#txtcur').attr('title');
            var invdate=$('#invdate').val();
            var payby=$('#selbank option:selected').text();
            var partner_id=$('#txtname').attr('title');
            var sendertel=$('#amount').attr('title');
            formdata.append('partner_id',partner_id);
            formdata.append('invdate',invdate);
            formdata.append('curid',curid);
            formdata.append('payby',payby);
            formdata.append('sendertel',sendertel);
            var url="{{ route('realestate.savedeposit') }}";
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

                  console.log(data)
                  if($.isEmptyObject(data.error)){
                    if(isprint==1){
                        printdeposit(data.id,data.groupid,'បង្កាន់ដៃកក់ប្រាក់',$('#amount').attr('title'));
                    }

                      gettransferlist($('#d1').val(),$('#d2').val());
                      toastr.success("Save Sale Successfully");
                      $(el).removeAttr('disabled').html(btntext);

                        $('#frmsaleland').trigger('reset');
                        $('#body_sale_detail').empty();
                        $('#selpartner').trigger('change');
                        $('#selsaler').trigger('change');


                      $('body').removeClass("wait");

                  }else{
                    $(el).removeAttr('disabled').html(btntext);
                      $('body').removeClass("wait");
                      alert(data.error)

                  }
              },
              error: function () {
                $(el).removeAttr('disabled').html(btntext);
                  $('body').removeClass("wait");
                  alert('Save Error.')

              }

          })

      }
      function printdeposit(id,groupid,rpttitle,propertyname){
          var redirectWindow = window.open('{{ url('/') }}'+'/realestate/depositprint?id='+id+'&groupid='+groupid+'&rpttitle='+rpttitle+'&propertyname='+propertyname , '_blank');
          redirectWindow.location;
        }
      $(document).on('click','.btnprint',function(e){
        e.preventDefault();
        var tr_id=$(this).data('id');
        var groupid=$(this).data('groupid');
        var trancode=$(this).data('trancode');
        if(trancode==-8){
            printtransfers(tr_id,'បង្កាន់ដៃលក់(ព្រីនឡើងវិញ)');
        }else{
            var sendername=$(this).data('sendertel');
            printdeposit(tr_id,groupid,'បង្កាន់ដៃកក់ប្រាក់',sendername);
        }
      })
      function printtransfers(tr_id,title){
          var redirectWindow = window.open('{{ url('/') }}'+'/realestate/saleprint?tr_id='+tr_id+'&title='+title , '_blank');
          redirectWindow.location;
      }
      $(document).on('click','.btnpayment',function(e){
        var id=$(this).data('id');
        var map_id=$(this).data('map_id');
        var groupid=$(this).data('groupid');
        var propertyname=$(this).data('sendername');
        var deltitle=id + ',' + groupid;
        var url="{{ route('realestate.payment') }}";
        $.get(url,{id:id,groupid:groupid,map_id:map_id},function(data){
            //console.log(data)
            if(data.success){
                $('#m_title').text('បង់ប្រាក់');
                $('#row_txtname').css('display','table-row');
                $('#row_selpartner').css('display','none');
                $('#row_selsaler').css('display','none');
                $('#row_selproject').css('display','none');
                $('#row_sel_property').css('display','none');
                $('#row_commission').css('display','none');
                $('#row_paymenttype').css('display','none');
                $('#row_term').css('display','none');
                $('#row_duration').css('display','none');
                $('#row_payinmonth').css('display','none');
                $('#row_discount').css('display','none');
                $('#row_amountdiscount').css('display','none');
                $('#row_deposited').css('display','table-row');
                $('#row_balance').css('display','table-row');
                // $('#row_deposit').css('display','table-row');
                //$('#row_selbank').css('display','table-row');
                $('#id1').val(data['transfers']['id']);
                $('#id2').val(data['transfers']['map_id']);
                $('#trancode').val(data['transfers']['trancode']);
                $('#invdate').val(moment(new Date()).format("DD-MM-YYYY"));
                if(data['transfers']['trancode']==-8){
                    $('#labelname').text("អតិថិជន");
                }else{
                    $('#labelname').text("អ្នកលក់គំរោង");
                }
                $('#txtname').val(data['transfers'].partner.name);
                $('#idcard').val(data['transfers'].partner.idcard);
                $('#age').val(data['transfers'].partner.age + ' ឆ្នាំ');
                $('#tel').val(data['transfers'].partner.tel);
                $('#sex').val(data['transfers'].partner.sex==1?'ប្រុស':'ស្រី');

                $('#txtname').attr('title',data['transfers']['parrent_id']);

                // if(data['transfers']['trancode']==-8){
                //     $('#selpartner').val(data['transfers']['parrent_id']);
                //     $('#selpartner').trigger('change');
                //     $('#row_selpartner').css('display','table-row');
                //     $('#row_selsaler').css('display','none');
                // }else{
                //     $('#selsaler').val(data['transfers']['parrent_id']);
                //     $('#selsaler').trigger('change');
                //     $('#row_selpartner').css('display','none');
                //     $('#row_selsaler').css('display','table-row');
                // }
                $('#amount').attr('title',propertyname);
                $('#amount').val(formatNumber(Math.abs(data['transfers']['amount'])));
                $('#txtcur').val(data['transfers']['currency'].shortcut);
                $('#txtcur').attr('title',data['transfers'].currency_id);

                $('#deposited').val(formatNumber(data['totalpayment']));
                $('.cur').val(data['transfers']['currency'].shortcut);
                $('#balance').val(formatNumber(parseFloat(Math.abs(data['transfers']['amount']) - parseFloat(Math.abs(data['totalpayment'])) )));

                //$('#note').val(data['transfers']['note']);
                // $('#paymenttype').val(data['transfers']['paymenttype']);
                // $('#paymenttype').trigger('change');
                // $('#term').val(data['transfers']['term']);
                // $('#interest_rate').val(data['transfers']['interest_rate']);
                // $('#startdate').val(moment(data['transfers']['startdate']).format('DD-MM-YYYY'));
                // $('#enddate').val(moment(data['transfers']['enddate']).format('DD-MM-YYYY'));
                $('#btnsavesale').css('display','none');
                $('#btnsavesaleprint').css('display','none');
                $('#btndelete').css('display','none');
                $('#btnsavedeposit').css('display','table-row');
                $('#btnsavedepositprint').css('display','table-row');
                for(let i=0;i<data['saledetails'].length;i++){
                    row=`
                        <tr class="item">
                            <td class="kh14 no" style="text-align:center;">${i+1}</td>
                            <td style="display:none;">
                                <input type="text" class="input-group pid kh14-b" name="pid[]" style="width:60px;padding:0px 5px;" value="${data['saledetails'][i].property_id}" readonly>
                            </td>
                            <td class="kh14-b pname" name="pname[]">${data['saledetails'][i].property.name}</td>
                            <td class="kh14-b psize" name="psize[]">${data['saledetails'][i].property.size}</td>
                            <td class="kh14-b" style="padding:0px;">
                                <div class="input-group">
                                    <input type="text" class="form-control p_price kh14-b" name="p_price[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(data['saledetails'][i].price)}" readonly>
                                    <input type="text" class="input-group p_cur kh14-b" name="p_cur[]" style="width:60px;padding:0px 5px;border-style:none;height:25px;margin-top:3px;background-color:transparent;" value="${data['saledetails'][i].currency.shortcut}" readonly>
                                </div>
                            </td>

                            <td style="display:none;">
                                <input type="text" class="input-group p_cur_id kh14-b" name="p_cur_id[]" style="width:60px;padding:0px 5px;" value="${data['saledetails'][i].currency_id}" readonly>
                            </td>
                            <td style="padding:0px;">
                                <input type="text" class="form-control com_payoff kh14-b" name="com_payoff[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(data['saledetails'][i].property.com_payoff)}" readonly>
                            </td>
                            <td style="padding:0px;">
                                <input type="text" class="form-control com_payloan kh14-b" name="com_payloan[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(data['saledetails'][i].property.com_payloan)}" readonly>
                            </td>

                            <td style="text-align:center;padding:5px 0px;">

                            </td>
                        </tr>
                    `;

                }

                $('#body_sale_detail').empty().append(row);
            }else{

            }
        })
      })
      $(document).on('click','.btnedit',function(e){
        var id=$(this).data('id');
        var groupid=$(this).data('groupid');
        var deltitle=id + ',' + groupid;
        var url="{{ route('realestate.edit') }}";
        $.get(url,{id:id,groupid:groupid},function(data){
            //console.log(data)
            if(data.success){
                $('#id1').val(data['transfers']['id']);
                $('#id2').val(data['transfers']['map_id']);
                $('#id3').val(data?.deposit?.id ?? '');
                $('#id4').val(data?.bankrec?.id ?? '');
                $('#trancode').val(data['transfers']['trancode']);
                $('#invdate').val(moment(data['transfers']['dd']).format("DD-MM-YYYY"));
                $('#selpartner').val(data['transfers']['parrent_id']);
                $('#selpartner').trigger('change');
                $('#selsaler').val(data['transfers']['customer_id']);
                $('#selsaler').trigger('change');
                $('#amount').val(formatNumber(Math.abs(data['transfers']['amountbeforediscount'])));
                $('#discount').val(formatNumber(Math.abs(data['transfers']['discount'])));
                $('#disc_by').val(data['transfers'].disc_by);
                $('#amountdiscount').val(formatNumber(Math.abs(data['transfers']['amount'])));
                $('#deposit').val(formatNumber(Math.abs(data['transfers']['deposit'])));
                $('#deposit').trigger('change');
                $('#txtcur1').val(data['transfers']['currency'].shortcut);
                $('#txtcur').val(data['transfers']['currency'].shortcut);
                $('#txtcur').attr('title',data['transfers'].currency_id);
                //$('#amount').attr('title',data['transfers'].property_id);
                $('.cur').val(data['transfers']['currency'].shortcut);
                $('#note').val(data['transfers']['note']);
                $('#selbank').val(data['transfers']['deposit_via_id']??'cash');
                $('#selbank').trigger('change');
                if(data['transfers']['deposit_via_id']=='cash'){
                    $('#bankamt').val(formatNumber(data['transfers']['cash_amount']??0));
                }else{
                    $('#bankamt').val(formatNumber(data['transfers']['bank_amount']??0));
                }
                $('#paymenttype').val(data['transfers']['paymenttype']);
                $('#term').val(data['transfers']['term']??0);
                $('#payinmonth').val(formatNumber(data['transfers']['payinmonth']??0));
                $('#interest_rate').val(data['transfers']['interest_rate']??0);
                $('#startdate').val(moment(data['transfers']['startdate']??new Date).format('DD-MM-YYYY'));
                $('#enddate').val(moment(data['transfers']['enddate']??new Date).format('DD-MM-YYYY'));
                $('#btnsavesale').text('កែប្រែ');
                $('#btnsavesaleprint').text('កែប្រែព្រីន');
                $('#btndelete').css('display','table-row');
                $('#btndelete').attr('title',deltitle);
                var propertyname='';
                var property_group='';
                var property_id='';
                var row='';
                for(let i=0;i<data['saledetails'].length;i++){
                    if(i==0){
                        property_id ='(' + data['saledetails'][i].property_id + ')';
                        propertyname =data['saledetails'][i].property.name;
                        property_group ='(' + data['saledetails'][i].property.property_group_id +')';
                    }else{
                        propertyname +=',' + data['saledetails'][i].property.name;
                        property_group +='(' + data['saledetails'][i].property.property_group_id +')';
                        property_id =property_id + '(' + data['saledetails'][i].property_id + ')';
                    }
                    row +=`
                        <tr class="item">
                            <td class="kh14 no" style="text-align:center;">${i+1}</td>
                            <td style="display:none;">
                                <input type="text" class="input-group pid kh14-b" name="pid[]" style="width:60px;padding:0px 5px;" value="${data['saledetails'][i].property_id}" readonly>
                            </td>
                            <td class="kh14-b pname" name="pname[]">${data['saledetails'][i].property.name}</td>
                            <td class="kh14-b psize" name="psize[]">${data['saledetails'][i].property.size}</td>
                            <td class="kh14-b" style="padding:0px;border-right:none;">
                                <div class="input-group">
                                    <input type="text" class="form-control p_price kh14-b" name="p_price[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(data['saledetails'][i].price)}" readonly>
                                    <input type="text" class="input-group p_cur kh14-b" name="p_cur[]" style="width:60px;padding:0px 5px;border-style:none;height:25px;margin-top:3px;background-color:transparent;" value="${data['saledetails'][i].currency.shortcut}" readonly>
                                </div>
                            </td>

                            <td style="display:none;">
                                <input type="text" class="input-group p_cur_id kh14-b" name="p_cur_id[]" style="width:60px;padding:0px 5px;" value="${data['saledetails'][i].currency_id}" readonly>
                            </td>
                            <td class="kh14-b" style="padding:0px;">
                                <input type="text" class="form-control com_payoff kh14-b" name="com_payoff[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(data['saledetails'][i].property.com_payoff)}" readonly>
                            </td>
                            <td class="kh14-b" style="padding:0px;">
                                <input type="text" class="form-control com_payloan kh14-b" name="com_payloan[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(data['saledetails'][i].property.com_payloan)}" readonly>
                            </td>
                            <td style="text-align:center;padding:5px 0px;">
                                <a href="" class="btnremoveitem"><i class="fa fa-trash" style="color:red;"></i></a>
                            </td>
                            <td class="kh14-b pgroup" name="pgroup[]" style="display:none;">${data['saledetails'][i].property.property_group_id}</td>
                        </tr>
                    `;

                }
                $('#paymenttype').trigger('change');
                $('#commission').val(formatNumber(Math.abs(data['transfers']['cuscharge'])));
                $('#paycommission').val(formatNumber(Math.abs(data['transfers']['temp_amount'])));
                $('#commission').attr('title',propertyname);
                $('#discount').attr('title',property_group);
                $('#amount').attr('title',property_id);
                $('#body_sale_detail').empty().append(row);
                $('#row_txtname').css('display','none');
                $('#row_selpartner').css('display','table-row');
                $('#row_selsaler').css('display','table-row');
                $('#row_selproject').css('display','table-row');
                $('#row_sel_property').css('display','table-row');
                $('#row_commission').css('display','table-row');
                $('#row_paymenttype').css('display','table-row');

                // document.getElementById("btnsavesale").disabled = false;
                // document.getElementById("btntransfer").disabled = true;
                // document.getElementById("btnreceive").disabled = true;
            }else{
                alert('no data found')
            }
        })
      })
      $(document).on('click','#btnnew',function(e){
        e.preventDefault();
        location.reload();
      })
      $(document).on('click','.btndeltransfer,#btndelete',function(e){
            e.preventDefault();
            var el=$(this).attr('id');
            if(el=='btndelete'){
                var tl=$(this).attr('title');
                var id=tl.split(",")[0];
                var groupid=tl.split(",")[1];
            }else{
                var id=$(this).data('id');
                var groupid=$(this).data('refgroupid');
            }
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
                        type: 'POST',
                        dataType:'JSON',
                        contentType: 'application/json;charset=utf-8',
                        url: "{{ route('realestate.delete') }}",
                        data: { id:id,groupid:groupid },
                        success: function (data) {
                            console.log(data);
                            if (data.success === true) {
                                if(el=='btndelete'){
                                    location.reload();
                                }else{
                                    gettransferlist($('#d1').val(),$('#d2').val());
                                    $('#frmsaleland').trigger('reset');
                                    $('#selpartner').trigger('change');
                                    $('#selsaler').trigger('change');
                                    $('#sel_property').trigger('change');
                                    $('#body_sale_detail').empty();
                                    $('#btnsavesale').text('រក្សាទុក');
                                    $('#btnsavesaleprint').text('រក្សាទុកព្រីន');
                                    $('#btndelete').css('display','none');
                                    $('#btndelete').attr('title','');
                                    var today=new Date();
                                    $('#invdate').datetimepicker({
                                        timepicker:false,
                                        datepicker:true,
                                        value:today,
                                        format:'d-m-Y',
                                        autoclose:true,
                                        todayBtn:true,
                                        startDate:today,
                                    });
                                }
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
        $(document).on('click','#btnsearchproperty',function(e){
            e.preventDefault();
            var pid=$('#search_property').val();
            gettransferlist($('#d1').val(),$('#d2').val(),2,pid);

        })
        $(document).on('click','#btnshow',function(e){
            e.preventDefault();
            gettransferlist($('#d1').val(),$('#d2').val(),1);

        })
        $(document).on('click','#btntrash',function(e){
            e.preventDefault();
            gettransferlist($('#d1').val(),$('#d2').val(),0);

        })
      function gettransferlist(d1,d2,status=1,pid=0)
        {
            $('body').addClass("wait");
            var location_id=8;
            $('#divgettransaction').css('display','block');
            var ckcreate = document.getElementById("ckcreated_at").checked;
            var userid=$('#filteruser').val();
            var url="{{ route('realestate.getsalelist') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,location_id:location_id,ckcreate:ckcreate,userid:userid,status:status,pid:pid},

                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    if(status==0){
                        $('#title_list').text('ទិន្ន័យលុបចោល');
                        $('#title_list').css('color','white');
                        $('#cardheader').css('background-color','red');
                    }else{
                        $('#title_list').text('ទិន្ន័យលក់');
                        $('#title_list').css('color','black');
                        $('#cardheader').css('background-color','lightgreen');
                    }

                    $('#body_transaction').empty().html(data);
                    $('body').removeClass("wait");
                    if (!isAdmin) {
                        if (!userPerms.has('1.1.1')) {
                            $('.li_code111').hide(); // Shorter way to hide
                        }
                        if (!userPerms.has('1.1.2')) {
                            $('.li_code112').hide();
                        }
                        if (!userPerms.has('1.1.3')) {
                            $('.li_code113').hide();
                        }
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
    })
    // $("#tableSearch").on("keyup", function() {
    //         var value = $(this).val().toUpperCase();
    //         $("#tbl_transferlist tr").each(function(index) {
    //             if (index !== 0) {
    //                 $row = $(this);

    //                 $row.find('td').each (function() {
    //                     var id = $(this).text();
    //                     if (id.toUpperCase().search(value) < 0) {
    //                         $row.hide();
    //                     }
    //                     else {
    //                         $row.show();
    //                         return false;
    //                     }
    //                 });

    //             }
    //         });
    //     });

  $("#tableSearch").on("keyup", function () {
    var value = $(this).val().toUpperCase();

    $("#tbl_transferlist tbody tr").each(function () {
      var $row = $(this);

      // Skip collapse rows completely from search
      if ($row.hasClass("collapse")) {
        // Use Bootstrap's collapse API to hide instead of jQuery
        $row.removeClass("show"); // Bootstrap needs this for proper toggle to work
        return;
      }

      // Search text within the main row only
      var found = false;
      $row.find("td").each(function () {
        var text = $(this).text();
        if (text.toUpperCase().indexOf(value) > -1) {
          found = true;
          return false; // break
        }
      });

      // Toggle visibility of main row
      if (found) {
        $row.show();
      } else {
        $row.hide();
      }

      // Always remove collapse row visibility during search
      var $collapseRow = $row.next(".collapse");
      $collapseRow.removeClass("show"); // Make sure Bootstrap can open it again
    });
  });







</script>
