<script type="text/javascript">

    $('#h1_title').text('ប្តូរប្រាក់');
//   setTimeout(() => {
//         window.Echo.channel('refreshChannel')
//         .listen('.App\\Events\\RefreshPageEvent',(e)=>{
//             console.log(e);
//             savecurrencytostorage();
//             savecurrencyproducttostorage();
//         })
//     }, 1000);
    // var ably = new Ably.Realtime('oM-FXA.0iCetQ:XLfafSYaOaTfVjkISU703q3TDqU52ZjdZyxl_Xzf-LA'); //remember to pass your ably API key
    // var channel = ably.channels.get('chatting'); // here i create a channel or initialize the existing channel

    // channel.subscribe('messageEvent', function(message) { // message this is message from channel
    //     // Handle incoming messages (create a message body div tag)
    //     console.log(message)
    //     savecurrencytostorage();
    //     savecurrencyproducttostorage();
    // });

    // document.addEventListener('keyup', function(e) {
    //     if (e.target.classList.contains('exmulti_receive_amt')) {

    //         let row = e.target.closest('tr');              // get current row
    //         let amt = parseFloat(row.querySelector('.amt1').innerText.replace(/,/g,'')) || 0;
    //         let receive = parseFloat(e.target.value.replace(/,/g,'')) || 0;

    //         let result = receive - amt;

    //         row.querySelector('.exmulti_return_amt').value = result.toFixed(2);
    //     }
    // });
    // document.addEventListener('keydown', function(e) {
    //     if (e.target.classList.contains('exmulti_receive_amt')) {

    //         // Allowed keys
    //         const allowedKeys = [
    //             "Backspace","Tab","ArrowLeft","ArrowRight","Delete",
    //         ];

    //         if (allowedKeys.includes(e.key)) return;

    //         // Allow only numbers
    //         if (!e.key.match(/[0-9.]/)) {
    //             e.preventDefault();
    //         }

    //         // Allow only one decimal point
    //         if (e.key === "." && e.target.value.includes(".")) {
    //             e.preventDefault();
    //         }
    //     }
    // });
    function format_Number(num) {
    if (num === "" || isNaN(num)) return "";
    return parseFloat(num).toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
}

function unformat(num) {
    return num.replace(/,/g, "");
}

document.addEventListener('input', function(e) {
    if (e.target.classList.contains('exmulti_receive_amt')) {

        // --- 1. Remove invalid characters ---
        let v = unformat(e.target.value);
        v = v.replace(/[^0-9.]/g, "");     // allow only number + decimal

        // --- 2. Allow only one decimal ---
        if ((v.match(/\./g) || []).length > 1) {
            v = v.replace(/\.(?=.*\.)/, "");
        }

        // --- 3. Format with thousand separators ---
        let formatted = format_Number(v);

        e.target.value = formatted;

        // --- 4. Auto Calculate Return Amount ---
        let row = e.target.closest("tr");
        let amt = parseFloat(unformat(row.querySelector(".amt1").innerText)) || 0;
        let receive = parseFloat(unformat(v)) || 0;
        let result =  receive - amt;

        row.querySelector(".exmulti_return_amt").value =
            isNaN(result) ? "" : format_Number(result);
    }
});


//permission code
    let pageUrl = window.location.pathname;
    window.addEventListener("beforeunload", function() {
        try {
            fetch("{{ route('track.time') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        url: pageUrl,
                        action: "close"
                    })
                });
                let parts = pageUrl.split("/");
                if (parts.length > 2) {
                    path = "/" + parts.slice(2).join("/"); // -> "/exchange/index"
                }else{
                    path = "/" + parts.slice(1).join("/"); // -> "/exchange/index"
                }
                let url=localStorage.getItem("user_url");
                localStorage.setItem("user_url", "/dashboard");
                if(path!==url){
                    localStorage.setItem("closeE1", Date.now());
                }
        } catch (e) {
            // ignore errors
        }
    });
    window.addEventListener("storage", function(e) {
        //debugger;
        if (e.key === "closeE2") {
            let pageUrl = window.location.pathname;
            let url=localStorage.getItem("user_url");

            window.location.href = '{{ url('/') }}/dashboard';
            let parts = pageUrl.split("/");
                if (parts.length > 2) {
                    path = "/" + parts.slice(2).join("/"); // -> "/exchange/index"
                }

                 if(url == "/exchange" || url == "/exchange/pop"){
                    window.location.href = '{{ url('/') }}' + '/exchange';
                 }else{
                     localStorage.setItem("user_url", "/dashboard");
                 }

        }
    });
 function getUserPermissions(userId) {
    const permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
    return permusers
        .filter(item => item.userid == userId)
        .map(item => item.code);
}
var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
const userId = "{{ Auth::id() }}";
const userPerms = new Set(getUserPermissions(userId));

    function refreshdisplayrate()
    {
        $('body').addClass("wait");
        var url="{{ route('exchange.refreshdisplayrate') }}";

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {},
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#body_displayrate').empty().html(data);
                        $('body').removeClass("wait");
                    }else{
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Error.')
                }

            })
    }
    var ably = new Ably.Realtime('DF1ung.N3Jwqw:30ezVuIjqesSJZRbGMoD8NsqtIij6_uqR6soVWetP0Q'); //remember to pass your ably API key
            var channel = ably.channels.get('chatting'); // here i create a channel or initialize the existing channel
            channel.subscribe('messageEvent', function(message) { // message this is message from channel
                // Handle incoming messages (create a message body div tag)
                console.log(message)
                const currentUser = "{{ Auth::user()->name }}"; // Server renders this per user
                const domainnameis="{{ config('helper.transfer_option') }}";
                if(message.data.customername==domainnameis){
                    refreshdisplayrate();
                    //savecurrencytostorage();
                    //savecurrencyproducttostorage();
                }
            });
  var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-145;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
    $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-145;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
    });
  //var w= window.screen.availWidth;
//   if(w<1920){
//     $('#part1').removeClass('col-lg-5').addClass('col-lg-12');
//     $('#part2').removeClass('col-lg-7').addClass('col-lg-12');
//   }else{
//     $('#part1').removeClass('col-lg-12').addClass('col-lg-5');
//     $('#part2').removeClass('col-lg-12').addClass('col-lg-7');
//   }

    // Custom function to format the option text
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

      // Custom function to format the option text
    function formatOption1(option) {
      if (!option.id) {
        return option.text;
      }
      // Use a <div> to display the main text and a second line
       // option.element.value is get value from select

      var $option = $(
        '<div class="select2-option1">' +
          '<div class="select2-option-main">' + option.text + '</div>' +
          '<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('customertype') : option.element.getAttribute('customertype')) + '</div>' +
        '</div>'
      );
      return $option;
    }
  $(document).ready(function () {
      $('#selpartner').select2({
        //templateResult: formatOption

      });
        resetform();
        autocomple_customer_exchange();
      $('#txtbuy').focus();
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
       if (!isAdmin) {
            if (!userPerms.has('3.1.1')) {
                $('#txtrate').attr('readonly',true);
            }
            if (!userPerms.has('3.1.2')) {
                //$('#invdate').attr('readonly',true);
                $('#invdate').datetimepicker("destroy");
            }
            if (!userPerms.has('3.1.3')) {
               $('.btndel').hide();
            }
            if (!userPerms.has('3.1.4')) {
               $('.btnprint').hide();
            }
        }
         function autocomple_customer_exchange(){
                var sources=JSON.parse(localStorage.getItem("phone_exchange"));
                var sources1=JSON.parse(localStorage.getItem("name_exchange"));
                $( "#client_tel" ).autocomplete({
                    source:sources,
                    minLength: 3,
                    select: function( event, ui ) {
                        $( "#client_tel" ).val( ui.item.value );
                        $( "#client_name" ).val( ui.item.client );
                        return false;
                    }
                    //    select : showResult,
                    //     focus : showResult,
                    //     change :showResult
                });
                $( "#client_name" ).autocomplete({
                    source:sources1,
                    minLength: 3,
                    select: function( event, ui ) {
                        $( "#client_name" ).val( ui.item.value );
                        $( "#client_tel" ).val( ui.item.phone );
                        return false;
                    }

                });
            }
      $(document).on('click','.tblexchangelist td',function(e){
        $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
        // add highlight to the parent tr of the clicked td
        $(this).parent('tr').addClass("clickedrow");
    })
    $(document).on('click','#tblratedisplay td',function(e){
        $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
        // add highlight to the parent tr of the clicked td
        $(this).parent('tr').addClass("clickedrow");
    })

      var cleave_payincash = new Cleave('#payincash', {
          numeral: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave_amtlist = new Cleave('#amtlist', {
          numeral: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave_cuschargelist = new Cleave('#cuschargelist', {
          numeral: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave_partnerfeelist = new Cleave('#partnerfeelist', {
          numeral: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave_txtbuy = new Cleave('#txtbuy', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave_txtsale = new Cleave('#txtsale', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave_txtrate = new Cleave('#txtrate', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave_txtcashreceive = new Cleave('#txtcashreceive', {
          numeral: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave_txtdeposit = new Cleave('#txtdeposit', {
          numeral: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleave_txtdeposit1 = new Cleave('#txtdeposit1', {
          numeral: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      $('.amt_hn').toArray().forEach(function(field){
          new Cleave(field, {
              numeral: true,
              numeralThousandsGroupStyle: 'thousand'
          });
      })
      $('.cut_hn').toArray().forEach(function(field){
          new Cleave(field, {
              numeral: true,
              numeralThousandsGroupStyle: 'thousand'
          });
      })
      $('.bal_hn').toArray().forEach(function(field){
          new Cleave(field, {
              numeral: true,
              numeralThousandsGroupStyle: 'thousand'
          });
      })
      $(document).on('click','#btnrefreshrate',function(e){
        e.preventDefault();
        $('#tblexchangelist').hide();
        $('#tblratedisplay').show();
        refreshdisplayrate();
      })
      $(document).on('click','.currencybtn',function(e){
        e.preventDefault();
        var id=$(this).data('id');
        var id12=$(this).data('id12');
        var arr_id=id12.split('-');
        $('#lblbuy').val(arr_id[0]);
        $('#lblbuy').trigger('change');
        $('#lblsale').val(arr_id[1]);
        $('#lblsale').trigger('change');
        $('#txtbuy').focus();

      })
       $(document).on('click','.btnshowrate',function(e){
        e.preventDefault();
        var shortcut12=$(this).attr('title');
         var arr_sk=shortcut12.split('-');
        var id1=searchTextSelect(arr_sk[0]);
        var id2=searchTextSelect(arr_sk[1]);
        $('#lblbuy').val(id1);
        $('#lblbuy').trigger('change');
        $('#lblsale').val(id2);
        $('#lblsale').trigger('change');
        $('#txtbuy').focus();

      })
      function searchTextSelect(searchText) {
        const select = document.getElementById('lblbuy');
        for (let i = 0; i < select.options.length; i++) {
            if (select.options[i].text.toLowerCase().includes(searchText.toLowerCase())) {
            select.selectedIndex = i; // Optional: selects the match in UI
            const matchedValue = select.options[i].value;
            //console.log('Matched Value:', matchedValue);
            return matchedValue;
            }
        }
        console.log('No match found');
        return null;
        }
      function viewmultiexchangepayment(){
        //var myarr=[];
        var myjstable=[];
        $("tr.multiexchange").each(function() {
                //debugger;
                var buy = $(this).find("input.txtbuys").val().replace(/,/g,'');
                var curbuy= $(this).find("input.txtcurbuys").val();
                var sale =-1 * parseFloat($(this).find("input.txtsales").val().replace(/,/g,''));

                var cursale= $(this).find("input.txtcursales").val();
                 row=`
                    <tr class="exchangeview">
                        <td class="kh14-b">ប្តូរប្រាក់</td>
                        <td class="kh14-b" style="text-align:right;color:blue;">${formatNumber(buy)}</td>
                        <td class="kh14-b" style="color:blue;width:50px;">${curbuy}</td>
                        <td class="kh14-b" style="text-align:right;color:red;">${formatNumber(sale)}</td>
                        <td class="kh14-b" style="color:red;width:50px;">${cursale}</td>

                    </tr>
                `
                //myarr.push({desr:'exchange',buy:buy,curbuy:curbuy,sale:sale,cursale:cursale});
                myjstable.push({amount:buy,cur:curbuy});
                myjstable.push({amount:sale,cur:cursale});

                $('#body_viewmoney').append(row);
            });

            $("tr.paybybank").each(function() {
                //debugger;
                var bankname = $(this).find("input.parrent_name").val();
                var cur= $(this).find("input.listcur").val();
                var amt=$(this).find("input.listamt").val().replace(/,/g,'');
                var cuscharge=$(this).find("input.listcuscharge").val().replace(/,/g,'');
                if(amt>0){
                    buy=-1 * parseFloat(amt);
                    curbuy=cur;
                    sale=0;
                    cursale='';
                    bankname += '(បាញ់ចូល)';
                }else{
                    sale=-1 * parseFloat(amt-cuscharge);
                    cursale=cur;
                    buy=0;
                    curbuy='';
                    bankname += '(បាញ់ចេញ)';
                }

                 row=`
                    <tr class="exchangeview">
                        <td class="kh14-b">${bankname}</td>
                        <td class="kh14-b" style="text-align:right;color:blue;">${ buy==0 ? '': formatNumber(buy)}</td>
                        <td class="kh14-b" style="color:blue;width:50px;">${curbuy}</td>
                        <td class="kh14-b" style="text-align:right;color:red;">${ sale==0 ?'' : formatNumber(sale)}</td>
                        <td class="kh14-b" style="color:red;width:50px;">${cursale}</td>

                    </tr>
                `
                //myarr.push({desr:bankname,buy:buy,curbuy:curbuy,sale:sale,cursale:cursale});
                myjstable.push({amount:buy,cur:curbuy});
                myjstable.push({amount:sale,cur:cursale});
                $('#body_viewmoney').append(row);
            });
            var cashreceive=$('#txtcashreceive').val().replace(/,/g,'');
            if(cashreceive!=='0' && cashreceive!==''){
                curbuy=$('#lblcashin option:selected').text();
                row=`
                <tr class="exchangeview">
                    <td class="kh14-b">លុយទទួលបាន</td>
                    <td class="kh14-b" style="text-align:right;color:blue;">${formatNumber(-1 * parseFloat(cashreceive))}</td>
                    <td class="kh14-b" style="color:blue;width:50px;">${curbuy}</td>
                    <td class="kh14-b" style="text-align:right;color:red;"></td>
                    <td class="kh14-b" style="color:red;width:50px;"></td>

                </tr>
            `
                myjstable.push({amount:-1 * parseFloat(cashreceive),cur:curbuy});
                $('#body_viewmoney').append(row);
            }
            // const totalbuycur=myarr.reduce((group,mycur)=>{
            //     const cur=mycur.curbuy;
            //     if(group[cur]==null)group[cur]=[]
            //         group[cur].push(mycur)
            //         return group;
            // },{})

            // const totalsalecur=myarr.reduce((group,mycur)=>{
            //     const cur=mycur.cursale;
            //     if(group[cur]==null)group[cur]=[]
            //         group[cur].push(mycur)
            //         return group;
            // },{})

            const totalcur=myjstable.reduce((group,mycur)=>{
                const cur=mycur.cur;
                if(group[cur]==null)group[cur]=[]
                    group[cur].push(mycur)
                    return group;
            },{})

        //     let sumbuy = Object.values(totalbuycur)
        //    .map(arr => arr.reduce((sums,{curbuy, buy}) => ({curbuy, buy: sums.buy + +buy}), {buy:0}))
//console.log(sumbuy)


        //     let sumsale = Object.values(totalsalecur)
        //    .map(arr => arr.reduce((sums,{cursale, sale}) => ({cursale, sale: sums.sale + +sale}), {sale:0}))
//console.log(sumsale)

            let sumamount = Object.values(totalcur)
           .map(arr => arr.reduce((sums,{cur, amount}) => ({cur, amount: sums.amount + +amount}), {amount:0}))
//console.log(sumamount)
            sumamount.forEach(value=>{

                    row=`
                        <tr class="">
                            <td class="kh14-b" style="text-align:right;${value.amount>0?'color:blue;':'color:red;'}">${formatNumber(value.amount)}</td>
                            <td class="kh14-b" style="${value.amount>0?'color:blue;':'color:red;'}width:50px;">${value.cur}</td>
                        </tr>
                    `
                if(value.amount<0){
                    $('#body_moneycashout').append(row);
                }else if(value.amount>0){
                    $('#body_moneycashin').append(row);
                }
            })

            // sumsale.forEach(value=>{
            //     if(value.sale!==0){
            //         row=`
            //             <tr class="">
            //                 <td class="kh14-b" style="text-align:right;color:red;">${formatNumber(value.sale)}</td>
            //                 <td class="kh14-b" style="color:red;width:50px;">${value.cursale}</td>
            //             </tr>
            //         `
            //         $('#body_moneycashout').append(row);
            //     }

            // })

            // sumbuy.forEach(value=>{
            //     if(value.buy!==0){
            //         row=`
            //             <tr class="">
            //                 <td class="kh14-b" style="text-align:right;color:blue;">${formatNumber(value.buy)}</td>
            //                 <td class="kh14-b" style="color:blue;width:50px;">${value.curbuy}</td>
            //             </tr>
            //         `
            //         $('#body_moneycashin').append(row);
            //     }

            // })

      }
      function viewexchangepayment(){
        var myjstable=[];
        var buy=0;
        var curbuy='';
        var cursale='';
        var sign=$('#txtsign').val();
        var sale=0;
        var row='';
        if(sign=='+'){
            buy=$('#txtbuy').val().replace(/,/g,'');
            curbuy=$('#lblbuy option:selected').text();
            sale=$('#txtsale').val().replace(/,/g,'');
            cursale=$('#lblsale option:selected').text();
        }else{
            buy=$('#txtsale').val().replace(/,/g,'');
            curbuy=$('#lblsale option:selected').text();
            sale=$('#txtbuy').val().replace(/,/g,'');
            cursale=$('#lblbuy option:selected').text();

        }
         row=`
            <tr class="exchangeview">
                <td class="kh14-b">លុយប្តូរ</td>
                <td class="kh14-b" style="text-align:right;color:blue;">${formatNumber(buy)}</td>
                <td class="kh14-b" style="color:blue;width:50px;">${curbuy}</td>
                <td class="kh14-b" style="text-align:right;color:red;">${formatNumber(-1 * parseFloat(sale))}</td>
                <td class="kh14-b" style="color:red;width:50px;">${cursale}</td>

            </tr>
        `
        myjstable.push({amount:buy,cur:curbuy});
        myjstable.push({amount:-1 * parseFloat(sale),cur:cursale});
        $('#body_viewmoney').append(row);

        var cashreceive=$('#txtcashreceive').val().replace(/,/g,'');
        if(cashreceive!=='0' && cashreceive!==''){
            curbuy=$('#lblcashin option:selected').text();
            row=`
            <tr class="exchangeview">
                <td class="kh14-b">លុយទទួលបាន</td>
                <td class="kh14-b" style="text-align:right;color:blue;">${formatNumber(-1 * parseFloat(cashreceive))}</td>
                <td class="kh14-b" style="color:blue;width:50px;">${curbuy}</td>
                <td class="kh14-b" style="text-align:right;color:red;"></td>
                <td class="kh14-b" style="color:red;width:50px;"></td>

            </tr>
        `
            myjstable.push({amount:-1 * parseFloat(cashreceive),cur:curbuy});
            $('#body_viewmoney').append(row);
        }

        $("tr.paybybank").each(function() {
                //debugger;
                var bankname = $(this).find("input.parrent_name").val();
                var cur= $(this).find("input.listcur").val();
                var amt=$(this).find("input.listamt").val().replace(/,/g,'');
                var cuscharge=$(this).find("input.listcuscharge").val().replace(/,/g,'');

                if(amt>0){
                    buy=-1 * parseFloat(amt);
                    curbuy=cur;
                    sale=0;
                    cursale='';
                    bankname += '(បាញ់ចូល)';
                }else{
                    sale=-1 * parseFloat(amt-cuscharge);
                    cursale=cur;
                    buy=0;
                    curbuy='';
                    bankname += '(បាញ់ចេញ)';
                }

                 row=`
                    <tr class="exchangeview">
                        <td class="kh14-b">${bankname}</td>
                        <td class="kh14-b" style="text-align:right;color:blue;">${ buy==0 ? '': formatNumber(buy)}</td>
                        <td class="kh14-b" style="color:blue;width:50px;">${curbuy}</td>
                        <td class="kh14-b" style="text-align:right;color:red;">${ sale==0 ?'' : formatNumber(sale)}</td>
                        <td class="kh14-b" style="color:red;width:50px;">${cursale}</td>

                    </tr>
                `
                myjstable.push({amount:buy,cur:curbuy});
                myjstable.push({amount:sale,cur:cursale});
                $('#body_viewmoney').append(row);
            });


            const totalcur=myjstable.reduce((group,mycur)=>{
                const cur=mycur.cur;
                if(group[cur]==null)group[cur]=[]
                    group[cur].push(mycur)
                    return group;
            },{})

console.log(totalcur)
            let sumamount = Object.values(totalcur)
           .map(arr => arr.reduce((sums,{cur, amount}) => ({cur, amount: sums.amount + +amount}), {amount:0}))

console.log(sumamount)
            sumamount.forEach(value=>{

                    row=`
                        <tr class="">
                            <td class="kh14-b" style="text-align:right;${value.amount>0?'color:blue;':'color:red;'}">${formatNumber(value.amount)}</td>
                            <td class="kh14-b" style="${value.amount>0?'color:blue;':'color:red;'}width:50px;">${value.cur}</td>
                        </tr>
                    `
                if(value.amount<0){
                    $('#body_moneycashout').append(row);
                }else if(value.amount>0){
                    $('#body_moneycashin').append(row);
                }
            })

      }
      $(document).on('click','#btnclosediv_viewmoney',function(e){
        e.preventDefault();
        $('#div_viewmoney').css('display','none');
        $('#divcashin').css('display','none');
        $('#divcashout').css('display','none');

      })
      $(document).on('click','#btnviewmoney',function(e){
        e.preventDefault();
        $('#divcashin').css('display','block');
        $('#divcashout').css('display','block');

        $('#div_viewmoney').css('display','inline');
        $('#body_viewmoney').empty();
        $('#body_moneycashin').empty();
        $('#body_moneycashout').empty();
        var rownum=$('#tablemultiexchange tr').length -1 ;
        if(rownum>0){
            viewmultiexchangepayment();
        }else{
            viewexchangepayment();
        }
      })
      $(document).on('keydown','.tdcanenter',function(e){
           if (e.keyCode == 13) {
              var $this = $(this),
              index = $this.closest('td').index();
              $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
              e.preventDefault();
          }
      })
      $(document).on('keyup','#partnerfeelist',function(e){
          const C = e.key;
          if (C === "Backspace"){
              return;
          }
          if(isNumber(C)==false){
              //getcurrencybykey1(C,'#txtcur2')
              getcurrencybykeylocalstorage1(C,'#partnerfeelistcur');
          }
      })
      $('#btnclosedivr2').click(function(e){
        $('#divr2').css('display','none');
      })
      $(document).on('keyup','#cuschargelist',function(e){
          const C = e.key;

          if (C === "Backspace"){
              //cutwater(0);
              return;
          }
          if(isNumber(C)==false){
              //getcurrencybykey1(C,'#selcur1')
              getcurrencybykeylocalstorage1(C,'#cuschargelistcur')
              totalcash();
          }
          //cutwater(0);
      })
      $(document).on('keyup','#amtlist',function(e){
          const C = e.key;
          if (C === "Backspace"){
              //cutwater(1);
              return;
          }
          if(isNumber(C)==false){
              //getcurrencybykey1(C,'#selcur')
              getcurrencybykeylocalstorage1(C,'#selcurlist')
              var cur=$('#selcurlist option:selected').text();
              $('#txtcur2').val(cur);
              $('#cuschargelistcur').val($('#selcurlist').val());
              $('#partnerfeelistcur').val($('#selcurlist').val());
          }
          //cutwater(1);
      })
      $(document).on('change','#ckwater',function(e){
         cutwater(0);
         totalcash();
         if($('#selpartner').val()!==''){
              var mekun= document.querySelector('input[name = optinout]:checked').value;
              fillnextbalance('#balance1','#balancenext1',$('#selcurlist option:selected').text(),mekun,$('#amtlist').val(),$('#partnerfeelist').val());
          }
      })
      $(document).on('change','#selcurlist',function(e){
          //fillaccount();
            var cur=$('#selcurlist option:selected').text();
            $('#cuschargelistcur').val($(this).val());
            $('#partnerfeelistcur').val($(this).val());
            $('#txtcur2').val(cur);
          cutwater(0);
          var radv= document.querySelector('input[name="radcustype"]:checked').value;
          if($('#selpartner').val()!==''){
                var mekun= document.querySelector('input[name = optinout]:checked').value;
                if(radv=='AGENT'){
                    refreshwingratefastnext(totalcash,fillnextbalance,'#balance1','#balancenext1',$('#selcurlist option:selected').text(),mekun,$('#amtlist').val(),$('#partnerfeelist').val());
                }else{
                    fillnextbalance('#balance1','#balancenext1',$('#selcurlist option:selected').text(),mekun,$('#amtlist').val(),$('#partnerfeelist').val());
                    totalcash();
                }
          }

      })
      $(document).on('change','#seltranname',function(e){
        var mekun= document.querySelector('input[name = optinout]:checked').value;
        var sp = document.querySelector("#selpartner");
        var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
        if(customertype=='AGENT'){
            refreshwingratefastnext(totalcash,fillnextbalance,'#balance1','#balancenext1',$('#selcurlist option:selected').text(),mekun,$('#amtlist').val(),$('#partnerfeelist').val());
        }

        //   var radv= document.querySelector('input[name="radcustype"]:checked').value;
        //   if($('#selpartner').val()!==''){
        //         var mekun= document.querySelector('input[name = optinout]:checked').value;
        //         if(radv=='AGENT'){
        //             refreshwingratefastnext(totalcash,fillnextbalance,'#balance1','#balancenext1',$('#selcurlist option:selected').text(),mekun,$('#amtlist').val(),$('#partnerfeelist').val());
        //         }
        //   }

      })
      $(document).on('change','#cuschargelistcur',function(e){
          cutwater(0);
          totalcash();
      })
      $(document).on('change','#cuschargelist',function(e){
          cutwater(0);
          totalcash();
      })
      $(document).on('change','#amtlist',function(e){
        e.preventDefault();
          cutwater(1);
          $('#amtlist').attr('title',$(this).val());
          var radv= document.querySelector('input[name="radcustype"]:checked').value;
          if($('#selpartner').val()!==''){
              var mekun= document.querySelector('input[name = optinout]:checked').value;
                if(radv=='AGENT'){
                    refreshwingratefastnext(totalcash,fillnextbalance,'#balance1','#balancenext1',$('#selcurlist option:selected').text(),mekun,$('#amtlist').val(),$('#partnerfeelist').val());
                }else{
                    fillnextbalance('#balance1','#balancenext1',$('#selcurlist option:selected').text(),mekun,$('#amtlist').val(),$('#partnerfeelist').val());
                    totalcash();
                }
          }
      })

      function refreshwingratefast(callback1,callback2,cid,cur0,elem,elnext,sign0,amt0,fee0,fillnextbal)
      {
        //debugger;
         //try{
            var sp1 = document.querySelector("#seltranname");
            var sign=sp1.options[sp1.selectedIndex].getAttribute('sign');
            var is_tc=sp1.options[sp1.selectedIndex].getAttribute('is_tc');
            if(sign==4 || sign==-4){
                $('#cuschargelist').val(0);
                $('#partnerfeelist').val(0);
                callback2(cid,cur0,elem,elnext,sign0,amt0,fee0,fillnextbal);
                return;
            }

            var amount=$('#amtlist').val().replace(/,/g,'');
            var wingcur=$('#selcurlist').val();
            var cur=$('#selcurlist option:selected').text();
            var sp = document.querySelector("#selpartner");
            var trannameid=$('#seltranname').val();
            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
            var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
            var maxfee=sp.options[sp.selectedIndex].getAttribute('maxfee');
            var maxcuscharge=sp.options[sp.selectedIndex].getAttribute('maxcuscharge');
            var maxtransferfee=sp.options[sp.selectedIndex].getAttribute('maxtransferfee');

            if(trannameid=='' || agenttype=='' || cur=='' || amount=='' || amount==0){
                callback2(cid,cur0,elem,elnext,sign0,amt0,fee0,fillnextbal);
                return;
            }

             if (is_tc == 0) {
                var response = findRates(agenttype, amount, trannameid, cur);
                if (response.length > 0) {
                    let customerRate = response[0]['customer_rate'];
                    let fee = (sign == 1)
                        ? response[0]['transfer_rate']
                        : response[0]['cashdraw_rate'];

                    // 🔹 Handle Customer Rate
                    if (typeof customerRate === "string" && customerRate.includes("%")) {
                        customerRate = customerRate.replace("%", "").trim();
                        $('#cuschargelist').val((parseFloat(customerRate) * parseFloat(amount)) / 100);
                    } else {
                        $('#cuschargelist').val(parseFloat(customerRate));
                    }

                    // 🔹 Handle Fee
                    if (typeof fee === "string" && fee.includes("%")) {
                        fee = fee.replace("%", "").trim();
                        $('#partnerfeelist').val((parseFloat(fee) * parseFloat(amount)) / 100);
                    } else {
                        $('#partnerfeelist').val(parseFloat(fee));
                    }
                    callback1();
                    callback2(cid,cur0,elem,elnext,sign0,amt0, $('#partnerfeelist').val(),fillnextbal);
                }
                return;
            }

            var maxamtstr=maxtransfer.replace(/,/g,'');
            var maxfeestr=maxfee.replace(/,/g,'');
            var maxcuschargestr=maxcuscharge.replace(/,/g,'');
            var maxtransferfeestr=maxtransferfee.replace(/,/g,'');

            var maxamtby=maxamtstr.split('/');
            var maxfeeby=maxfeestr.split('/');
            var maxcuschargeby=maxcuschargestr.split('/');
            var maxtransferfeeby=maxtransferfeestr.split('/');

            var maxamt2=0;
            var maxfee2=0;
            var maxcuscharge2=0;
            var maxtransferfee2=0;
            if(cur=='USD'){
                maxamt2=maxamtby[0];
                maxfee2=maxfeeby[0];
                maxcuscharge2=maxcuschargeby[0];
                maxtransferfee2=maxtransferfeeby[0];
            }

            if(cur=='KHR'){
                maxamt2=maxamtby[1];
                maxfee2=maxfeeby[1];
                maxcuscharge2=maxcuschargeby[1];
                maxtransferfee2=maxtransferfeeby[1];
            }
            if(cur=='THB'){
                maxamt2=maxamtby[2];
                maxfee2=maxfeeby[2];
                maxcuscharge2=maxcuschargeby[2];
                maxtransferfee2=maxtransferfeeby[2];
            }

            if(maxamt2==0) return;
            var result=Math.floor(amount / maxamt2);
            var somnal=amount % maxamt2;
            var totalcuscharge=0;
            var totalfee=0;
            var totaltransferfee=0;
            for(let i=0;i<result;i++){
                if(sign==1){
                    totalcuscharge+=parseFloat(maxcuscharge2);
                    totalfee+=parseFloat(maxcuscharge2)-parseFloat(maxtransferfee2);
                }else{
                    totalfee+=parseFloat(maxfee2);
                }

            }
            if(somnal!==0 && isNaN(somnal)==false){
                var wingrate;
                if(cur=='USD'){
                    if(localStorage.getItem("wingrate_usd")==null){
                        wingrate=[];
                    }else{
                        wingrate=JSON.parse(localStorage.getItem("wingrate_usd"));
                    }

                }else if(cur=='KHR'){
                    if(localStorage.getItem("wingrate_khr")==null){
                        wingrate=[];
                    }else{
                        wingrate=JSON.parse(localStorage.getItem("wingrate_khr"));
                    }

                }
                // var founditem=0;
                // for(k=0;k<wingrate.length;k++){
                //     if(founditem==1){
                //         break;
                //     }
                //     if(wingrate[k].amt1<somnal && wingrate[k].amt2>=somnal && wingrate[k].currency==cur){
                //         var arr_tranname_id=wingrate[k].tranname_id.split(',');
                //         for(x=0;x<arr_tranname_id.length;x++){
                //             if(arr_tranname_id[x]==trannameid){
                //                 if(sign==1){
                //                     totalcuscharge+=parseFloat(wingrate[k].customer_rate);
                //                     totalfee+=parseFloat(wingrate[k].customer_rate)-parseFloat(wingrate[k].transfer_rate);

                //                 }else if(sign==-1){
                //                     totalfee+=wingrate[k].cashdraw_rate
                //                     $('#partnerfeelist').val();
                //                 }
                //                 founditem=1;
                //                 break;
                //             }
                //         }
                //     }
                // }
                var response = findRates(agenttype, somnal, trannameid, cur);
                if (response.length > 0) {
                    if (sign == 1) {
                        let customerRate = response[0]['customer_rate'];
                        let transferRate = response[0]['transfer_rate'];

                        // declare variables outside
                        let cuscharge = 0;
                        let transfer = 0;

                        // ✅ Handle customerRate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            cuscharge = (parseFloat(customerRate) * parseFloat(somnal)) / 100;
                        } else {
                            cuscharge = parseFloat(customerRate);
                        }

                        // ✅ Handle transferRate
                        if (typeof transferRate === "string" && transferRate.includes("%")) {
                            transferRate = transferRate.replace("%", "").trim();
                            transfer = (parseFloat(transferRate) * parseFloat(somnal)) / 100;
                        } else {
                            transfer = parseFloat(transferRate);
                        }

                        totalcuscharge += cuscharge;
                        totalfee += parseFloat(cuscharge) - parseFloat(transfer);

                    } else if (sign == -1) {
                        let cashdrawRate = response[0]['cashdraw_rate'];

                        let cashdraw = 0;

                        // ✅ Handle cashdrawRate
                        if (typeof cashdrawRate === "string" && cashdrawRate.includes("%")) {
                            cashdrawRate = cashdrawRate.replace("%", "").trim();
                            cashdraw = (parseFloat(cashdrawRate) * parseFloat(somnal)) / 100;
                        } else {
                            cashdraw = parseFloat(cashdrawRate);
                        }

                        totalfee += cashdraw;
                        $('#partnerfeelist').val();
                    }
                }
            }

            $('#cuschargelist').val(formatNumber(totalcuscharge,4));
            $('#partnerfeelist').val(formatNumber(totalfee,4));
            callback1();
            callback2(cid,cur0,elem,elnext,sign0,amt0,totalfee,fillnextbal);
        // }catch{

        // }
      }
       function findRates(agentTypeId, amount, tranNameId, cur) {
        let data = [];

        if (cur === 'USD') {
            data = JSON.parse(localStorage.getItem("wingrate_usd") || "[]");
        }else if (cur === 'KHR') {
            data = JSON.parse(localStorage.getItem("wingrate_khr") || "[]");
        }else if (cur === 'THB') {
            data = JSON.parse(localStorage.getItem("wingrate_thb") || "[]");
        }

        return data.filter(row =>
            Number(row.agenttype_id) === Number(agentTypeId) &&
            Number(amount) >= Number(row.amt1) &&
            Number(amount) <= Number(row.amt2) &&
            row.tranname_id.split(",").map(x => x.trim()).includes(String(tranNameId)) &&
            row.currency === cur
        ).map(row => ({
            customer_rate: row.customer_rate,
            transfer_rate: row.transfer_rate,
            cashdraw_rate: row.cashdraw_rate
        }));
    }
      function refreshwingratefastnext(totalcash,fillnextbal,elem,elnext,cur0,sign0,amt0,fee0)
      {
        //debugger;
         //try{
            var sp1 = document.querySelector("#seltranname");
            var sign=sp1.options[sp1.selectedIndex].getAttribute('sign');
            var is_tc=sp1.options[sp1.selectedIndex].getAttribute('is_tc');
            if(sign==4 || sign==-4){
                $('#cuschargelist').val(0);
                $('#partnerfeelist').val(0);
                fillnextbal(elem,elnext,cur0,sign0,amt0,fee0);
                return;
            }

            var amount=$('#amtlist').val().replace(/,/g,'');
            var wingcur=$('#selcurlist').val();
            var cur=$('#selcurlist option:selected').text();
            var sp = document.querySelector("#selpartner");
            var trannameid=$('#seltranname').val();
            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
            var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
            var maxfee=sp.options[sp.selectedIndex].getAttribute('maxfee');
            var maxcuscharge=sp.options[sp.selectedIndex].getAttribute('maxcuscharge');
            var maxtransferfee=sp.options[sp.selectedIndex].getAttribute('maxtransferfee');

            if(trannameid=='' || agenttype=='' || cur=='' || amount=='' || amount==0){
                fillnextbal(elem,elnext,cur0,sign0,amt0,fee0);
                return;
            }

            if (is_tc == 0) {
                var response = findRates(agenttype, amount, trannameid, cur);
                if (response.length > 0) {
                    let customerRate = response[0]['customer_rate'];
                    let fee = (sign == 1)
                        ? response[0]['transfer_rate']
                        : response[0]['cashdraw_rate'];

                    // 🔹 Handle Customer Rate
                    if (typeof customerRate === "string" && customerRate.includes("%")) {
                        customerRate = customerRate.replace("%", "").trim();
                        $('#cuschargelist').val((parseFloat(customerRate) * parseFloat(amount)) / 100);
                    } else {
                        $('#cuschargelist').val(parseFloat(customerRate));
                    }

                    // 🔹 Handle Fee
                    if (typeof fee === "string" && fee.includes("%")) {
                        fee = fee.replace("%", "").trim();
                        $('#partnerfeelist').val((parseFloat(fee) * parseFloat(amount)) / 100);
                    } else {
                        $('#partnerfeelist').val(parseFloat(fee));
                    }
                    totalcash();
                    fillnextbal(elem,elnext,cur0,sign0,amt0, $('#partnerfeelist').val());
                }
                return;
            }

            var maxamtstr=maxtransfer.replace(/,/g,'');
            var maxfeestr=maxfee.replace(/,/g,'');
            var maxcuschargestr=maxcuscharge.replace(/,/g,'');
            var maxtransferfeestr=maxtransferfee.replace(/,/g,'');

            var maxamtby=maxamtstr.split('/');
            var maxfeeby=maxfeestr.split('/');
            var maxcuschargeby=maxcuschargestr.split('/');
            var maxtransferfeeby=maxtransferfeestr.split('/');

            var maxamt2=0;
            var maxfee2=0;
            var maxcuscharge2=0;
            var maxtransferfee2=0;
            if(cur=='USD'){
                maxamt2=maxamtby[0];
                maxfee2=maxfeeby[0];
                maxcuscharge2=maxcuschargeby[0];
                maxtransferfee2=maxtransferfeeby[0];
            }

            if(cur=='KHR'){
                maxamt2=maxamtby[1];
                maxfee2=maxfeeby[1];
                maxcuscharge2=maxcuschargeby[1];
                maxtransferfee2=maxtransferfeeby[1];
            }
            if(cur=='THB'){
                maxamt2=maxamtby[2];
                maxfee2=maxfeeby[2];
                maxcuscharge2=maxcuschargeby[2];
                maxtransferfee2=maxtransferfeeby[2];
            }


            if(maxamt2==0) return;
            var result=Math.floor(amount / maxamt2);
            var somnal=amount % maxamt2;
            var totalcuscharge=0;
            var totalfee=0;
            var totaltransferfee=0;
            for(let i=0;i<result;i++){
                if(sign==1){
                    totalcuscharge+=parseFloat(maxcuscharge2);
                    totalfee+=parseFloat(maxcuscharge2)-parseFloat(maxtransferfee2);
                }else{
                    totalfee+=parseFloat(maxfee2);
                }

            }
            if(somnal!==0 && isNaN(somnal)==false){
                var wingrate;
                if(cur=='USD'){
                    if(localStorage.getItem("wingrate_usd")==null){
                        wingrate=[];
                    }else{
                        wingrate=JSON.parse(localStorage.getItem("wingrate_usd"));
                    }

                }else if(cur=='KHR'){
                    if(localStorage.getItem("wingrate_khr")==null){
                        wingrate=[];
                    }else{
                        wingrate=JSON.parse(localStorage.getItem("wingrate_khr"));
                    }

                }
                // var founditem=0;
                // for(k=0;k<wingrate.length;k++){
                //     if(founditem==1){
                //         break;
                //     }

                //     if(wingrate[k].amt1<somnal && wingrate[k].amt2>=somnal && wingrate[k].currency==cur){
                //         var arr_tranname_id=wingrate[k].tranname_id.split(',');
                //         for(x=0;x<arr_tranname_id.length;x++){
                //             if(arr_tranname_id[x]==trannameid){
                //                 if(sign==1){
                //                     totalcuscharge+=parseFloat(wingrate[k].customer_rate);
                //                     totalfee+=parseFloat(wingrate[k].customer_rate)-parseFloat(wingrate[k].transfer_rate);

                //                 }else if(sign==-1){
                //                     totalfee+=wingrate[k].cashdraw_rate
                //                     $('#partnerfeelist').val();
                //                 }
                //                 founditem=1;
                //                 break;
                //             }
                //         }
                //     }
                // }
                var response = findRates(agenttype, somnal, trannameid, cur);
                if (response.length > 0) {
                    if (sign == 1) {
                        let customerRate = response[0]['customer_rate'];
                        let transferRate = response[0]['transfer_rate'];

                        // declare variables outside
                        let cuscharge = 0;
                        let transfer = 0;

                        // ✅ Handle customerRate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            cuscharge = (parseFloat(customerRate) * parseFloat(somnal)) / 100;
                        } else {
                            cuscharge = parseFloat(customerRate);
                        }

                        // ✅ Handle transferRate
                        if (typeof transferRate === "string" && transferRate.includes("%")) {
                            transferRate = transferRate.replace("%", "").trim();
                            transfer = (parseFloat(transferRate) * parseFloat(somnal)) / 100;
                        } else {
                            transfer = parseFloat(transferRate);
                        }

                        totalcuscharge += cuscharge;
                        totalfee += parseFloat(cuscharge) - parseFloat(transfer);

                    } else if (sign == -1) {
                        let cashdrawRate = response[0]['cashdraw_rate'];

                        let cashdraw = 0;

                        // ✅ Handle cashdrawRate
                        if (typeof cashdrawRate === "string" && cashdrawRate.includes("%")) {
                            cashdrawRate = cashdrawRate.replace("%", "").trim();
                            cashdraw = (parseFloat(cashdrawRate) * parseFloat(somnal)) / 100;
                        } else {
                            cashdraw = parseFloat(cashdrawRate);
                        }

                        totalfee += cashdraw;
                        $('#partnerfeelist').val();
                    }
                }

            }
            $('#cuschargelist').val(formatNumber(totalcuscharge,4));
            $('#partnerfeelist').val(formatNumber(totalfee,4));
            totalcash();
            fillnextbal(elem,elnext,cur0,sign0,amt0,totalfee);
        // }catch{

        // }
      }

      function cutwater(isamtkeyup)
      {
          if(isamtkeyup!=1){
              var ck = document.getElementById("ckwater").checked;
              var amt=$('#amtlist').attr('title').replace(/,/g, '');
              var cuscharge=$('#cuschargelist').val().replace(/,/g, '');
              if(ck==true){
                  var cur=$('#selcurlist option:selected').text();
                  var cur1=$('#cuschargelistcur option:selected').text();
                  if(cur==cur1){
                      amt=amt-cuscharge;
                  }
                  $('#amtlist').val(formatNumber(amt));
              }else{
                  amt=$('#amtlist').attr('title').replace(/,/g, '');
                  $('#amtlist').val(formatNumber(amt));
              }
          }
          //totalcash();
      }
      function totalcash()
      {
          var totalcash=0;
          var amt=$('#amtlist').val().replace(/,/g, '');
          var cur=$('#selcurlist option:selected').text();
          var cuscharge=$('#cuschargelist').val().replace(/,/g, '');
          var cur1=$('#cuschargelistcur option:selected').text();
          if(cur==cur1){
              totalcash=parseFloat(amt)+parseFloat(cuscharge);
          }else{
              totalcash=amt;
          }
          $('#payincash').val(formatNumber(parseFloat(totalcash)));
      }
  $(document).on('change','#selpartner',async function(e){
      e.preventDefault();
      var partner_id=$(this).val();

    if($(this).val()=='') return;
    var mekun= document.querySelector('input[name = optinout]:checked').value;
    var sp = document.querySelector("#selpartner");
    var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
    if(customertype=='AGENT'){
        await gettranname(seltranname);
        $('#row_seltranname').css('display','table-row');
        refreshwingratefast(totalcash,getwingbalance,$(this).val(),$('#selcurlist option:selected').text(),'#balance1','#balancenext1',mekun,$('#amtlist').val(),$('#partnerfeelist').val(),fillnextbalance);
    }else{
        $('#row_seltranname').css('display','none');
        getwingbalance($(this).val(),$('#selcurlist option:selected').text(),'#balance1','#balancenext1',mekun,$('#amtlist').val(),$('#partnerfeelist').val(),fillnextbalance);
        totalcash();
    }


  })

      function gettranname(el) {

            return new Promise((resolve, reject) => {
                var sp = document.querySelector("#selpartner");
                var customertype = sp.options[sp.selectedIndex].getAttribute('customertype');
                var agenttype = sp.options[sp.selectedIndex].getAttribute('agenttype');
                $('body').addClass("wait");
                var url = "{{ route('wingtransfer.gettransactionname') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: { agenttype: agenttype },
                    success: function (data) {
                        if ($.isEmptyObject(data.error)) {
                            $(el).empty();

                            $.each(data['wtn'], function (i, item) {
                                $(el).append($("<option/>", {
                                    value: item.id,
                                    text: item.name,
                                    sign: item.sign,
                                    is_tc: item.is_tc ?? 0,
                                }));
                            });

                            $('body').removeClass("wait");
                            resolve(data); // ✅ resolve when done
                        } else {
                            $('body').removeClass("wait");
                            alert(data.error);
                            reject(data.error);
                        }
                    },
                    error: function (xhr) {
                        $('body').removeClass("wait");
                        alert('Read Error.');
                        reject(xhr);
                    }
                });
            });
        }

        function fillnextbalance(elbal,elnext,cur,sign,amt,fee)
        {
            //debugger;
            var mekun= sign;
            var amt1=amt.toString().replace(/,/g,'');
            var fee1=fee.toString().replace(/,/g,'');
            var amount=parseFloat(amt1)+parseFloat(fee1);
            //var amt2=$('#amount2').val().replace(/,/g,'');
            var i=0;
            var baltitle=$(elbal).attr('title');
            var balusd=baltitle.split(";")[0];
            var balkhr=baltitle.split(";")[1];
            var balthb=baltitle.split(";")[2];
            var balnext=0;
            var bal=0;
            var cur1='';

            if(cur=='USD'){
                    balnext=-1 * (parseFloat(balusd)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balusd);
                    cur1=' USD';
                }else if(cur=='KHR'){
                    balnext=-1 * (parseFloat(balkhr)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balkhr);
                    cur1=' KHR';
                }else if(cur=='THB'){
                    balnext=-1 * (parseFloat(balthb)+ parseFloat(mekun * amount));
                    bal=-1 * parseFloat(balthb);
                    cur1=' THB';
                }

            $(elnext).val(formatNumber(balnext) + cur1);
            $(elbal).val(formatNumber(bal) + cur1);
            if(bal>0){
                $(elbal).css('color','blue');
            }else{
                $(elbal).css('color','red');
            }
            if(balnext>0){
                $(elnext).css('color','blue');
            }else{
                $(elnext).css('color','red');
            }
        }
          function getwingbalance(cid,cur,elem,elnext,sign,amt,fee,callback)
          {
            $('body').addClass("wait");
            var total=0;
            var d2=$('#h1_date').text();
            var op='<=';
            var url="{{ route('closelist.summarypartnerlist') }}";

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {cid:cid,showdate:d2,op:op},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        $(elem).attr('title',data.usd+';'+data.khr+';'+data.thb);

                        callback(elem,elnext,cur,sign,amt,fee);
                        $('body').removeClass("wait");
                    }else{
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Error.')
                }

            })
          }
  $(document).on('change','#selitem',function(e){
        e.preventDefault();
        fillaccount();
      })
      function fillaccount()
      {
        var sp = document.querySelector("#selitem");
        var acr=sp.options[sp.selectedIndex].getAttribute('acr');
        var acnr=sp.options[sp.selectedIndex].getAttribute('acnr');
        var acd=sp.options[sp.selectedIndex].getAttribute('acd');
        var acnd=sp.options[sp.selectedIndex].getAttribute('acnd');
        var acb=sp.options[sp.selectedIndex].getAttribute('acb');
        var acnb=sp.options[sp.selectedIndex].getAttribute('acnb');
        var getcur=$('#selcurlist option:selected').text();
        if(getcur=='KHR'){
            $('#txtrecnamelist').val(acnr);
            $('#txtrecphonelist').val(acr);
        }else if(getcur=='USD'){
            $('#txtrecnamelist').val(acnd);
            $('#txtrecphonelist').val(acd);
        }else if(getcur=='THB'){
            $('#txtrecnamelist').val(acnb);
            $('#txtrecphonelist').val(acb);
        }
      }
  // $("input[type=text]").focus(function() {
  //   $(this).select();
  // })
  $(".numbertext").focus(function() {
    $(this).select();
  })
  $(document).on('keydown', '.canenter', function (e) {
          if (e.keyCode == 13) {
              var id = $(this).attr("id");
              if (id == 'txtbuy') {
                  $('#txtrate').focus();
              } else if(id == 'txtrate'){
                let el = document.getElementById('txtgoldwater');
                if (el && el.offsetParent !== null) {
                    $('#txtgoldwater').focus();
                }else{
                    $('#txtcashreceive').focus();
                }
              } else if (id == 'txtcashreceive') {
                  $('#btnsaveprint').focus();
              }else if (id=='amtlist'){
                $('#cuschargelist').focus();
              }else if (id=='cuschargelist'){
                $('#partnerfeelist').focus();
              }else if (id=='partnerfeelist'){
                $('#txtrecphonelist').focus();
              }else if (id=='txtrecphonelist'){
                $('#txtrecnamelist').focus();
              }else if (id=='txtrecnamelist'){
                $('#btnaddtolist').focus();
              }else if (id=='txtsale'){
                 $('#txtcashreceive').focus();
              }else if (id=='txtgoldwater'){
                  $('#txtcashreceive').focus();
              }else if (id=='txtdeposit'){
                  $('#txtdeposit1').focus();
              }else if (id=='txtdeposit1'){
                  $('#client_name').focus();
              }else if (id=='client_name'){
                  $('#client_tel').focus();
              }else if (id=='client_tel'){
                  $('#btnsavedeposit').focus();
              }
              e.preventDefault();
          }
      })
      $('#btnclearlist').click(function(e){
          e.preventDefault();
          var q = confirm("Do you want to clear list?");
              if (q) {
                  var url="{{ route('clearexchangelist') }}";
                 $.post(url,{},function(data){
                  getmultiexchangelist();
                 })
              }
              visiblebutton();
      })
      $(document).on('click','#btnaddrow',function(e){
          e.preventDefault();
          addrow();
          autofillbankamt(clickbanksign);
          $('.bankamt').toArray().forEach(function(field){
              new Cleave(field, {
                  numeral: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
          })
      })
      function updatetbl_in(n,v){
        $('.no1').each(function(i,e){
            var no=$(this).text();
            if(no==n){
              $('.action1').eq(i).text(v);
            }
        })
      }
      function resetaction1(){
        $('.no1').each(function(i,e){
          $('.action1').eq(i).text('');
        })
      }
      function resetaction2(){
        $('.no2').each(function(i,e){
          $('.action2').eq(i).text('');
        })
      }
      function updatetbl_out(n,v){
        $('.no2').each(function(i,e){
          var no=$(this).text();
          if(no==n){
            $('.action2').eq(i).text(v);
          }
        })
      }
      function refill_tbl_in(){
        var amt=0;
        var cur='';
        var curid=0;
        var exno=0;

        $('.action1').each(function(i,e){
          //debugger;
          var act=$(this).text();
          if(act==''){
            if(parseFloat(amt)==0){
              amt=$('.amt1').eq(i).text().replace(/,/g, '');
              cur=$('.cur1').eq(i).text();
              exno=$('.no1').eq(i).text();

              var currencylist;
              if(localStorage.getItem("currencylist")==null){
                currencylist=[];
              }else{
                currencylist=JSON.parse(localStorage.getItem("currencylist"));
              }
              currencylist.forEach(function(c){
                if(c.shortcut==cur){
                  curid=c.id;
                }
              })
            }
          }
            $('#selcurlist').val(curid)
            $('#txtcur2').val($('#selcurlist option:selected').text());
            var allamt=Math.abs(amt);
            var sumamtlist=sumAmountByCurrency($('#selcurlist option:selected').text());
            var leftamt=parseFloat(allamt)-parseFloat(sumamtlist);

            $('#amtlist').val(formatNumber(leftamt));
            $('#amtlist').attr('title',leftamt);
            $('#tdamtlist').attr('title',leftamt);

            // $('#amtlist').val(formatNumber(Math.abs(amt)));
            // $('#amtlist').attr('title',Math.abs(amt));
            // $('#tdamtlist').attr('title',Math.abs(amt));

            //$('#txtcur2').val(curid);
            $('#cuschargelistcur').val(curid);
            $('#partnerfeelistcur').val(curid);
            $('#ex_no').val(exno);

        })

      }
      function refill_tbl_out(){

        var amt=0;
        var cur='';
        var curid=0;
        var exno=0;
        $('.action2').each(function(i,e){
          var act=$(this).text();
          if(act==''){
            if(parseFloat(amt)==0){
              amt=$('.amt2').eq(i).text().replace(/,/g, '');
              cur=$('.cur2').eq(i).text();
              exno=$('.no2').eq(i).text();
              var currencylist;
              if(localStorage.getItem("currencylist")==null){
                currencylist=[];
              }else{
                currencylist=JSON.parse(localStorage.getItem("currencylist"));
              }
              currencylist.forEach(function(c){
                if(c.shortcut==cur){
                  curid=c.id;
                }
              })
            }
          }
        //   $('#amtlist').val(formatNumber(Math.abs(amt)));
        //   $('#amtlist').attr('title',Math.abs(amt));
        //   $('#tdamtlist').attr('title',Math.abs(amt));
            $('#selcurlist').val(curid);
            $('#txtcur2').val(curid);
            $('#cuschargelistcur').val(curid);
            $('#partnerfeelistcur').val(curid);
            $('#txtcur2').val($('#selcurlist option:selected').text());

            var allamt=Math.abs(amt);
            var sumamtlist=sumAmountByCurrency($('#selcurlist option:selected').text());
            var leftamt=parseFloat(allamt)-parseFloat(sumamtlist);
            $('#amtlist').val(formatNumber(leftamt));
            $('#amtlist').attr('title',leftamt);
            $('#tdamtlist').attr('title',leftamt);
            $('#ex_no').val(exno);

        })

      }
      $(document).on('click','#btncleartablelist',function(e){
        e.preventDefault();
        $('#body_partnerlist').empty();
      })
      $(document).on('click','#btnaddtolist',function(e){
          e.preventDefault();
          var sp = document.querySelector("#selpartner");
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          //var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
          var userconnect=sp.options[sp.selectedIndex].getAttribute('userconnect');
          var thai_list=sp.options[sp.selectedIndex].getAttribute('thai_list');

        //   if(customertype=='BANK' || customertype=='AGENT'){
        //     var userid=$('#loginid').val();
        //     var partneruser=userconnect.split(',');
        //     if(!partneruser.includes(userid)){
        //         alert('selected bank not match user')
        //         return;
        //     }
        //   }
          $('#haspartnerlist').val(1);
          $('#btnsave').css('display','none');
          $('#btnsaveprint').css('display','none');
          $('#btnsavelist').css('display','none');
          $('#btnsavelistprint').css('display','none');
          var pid=$('#selpartner').val();
          var pname=$('#selpartner option:selected').text();
          var amtlist=$('#amtlist').val().replace(/,/g,'');
          var cur1=$('#selcurlist option:selected').text();
          var curid1=$('#selcurlist').val();
          var selcurtext=$('#selcurlist option:selected').text();
          var cuschargelist=$('#cuschargelist').val().replace(/,/g,'');
          var cur2=$('#cuschargelistcur option:selected').text();
          var curid2=$('#cuschargelistcur').val();
          var feelist=$('#partnerfeelist').val();
          var cur3=$('#partnerfeelistcur option:selected').text();
          var curid3=$('#partnerfeelistcur').val();
          var payincash=$('#payincash').val();
          var recphonelist=$('#txtrecphonelist').val();
          var recnamelist=$('#txtrecnamelist').val();
          var sendphonelist=$('#txtsendphonelist').val();
          var sendnamelist=$('#txtsendnamelist').val();

          var transign=$('#txtsignlist').val();
          var useraffect=$('#seluseraffect').val();
          if(useraffect==null){
            useraffect='';
          }
          var ex_no=$('#ex_no').val();
          //var countselectoption=$('#seluseraffect option').length;
          if(pid==''){
            alert('please select partner name')
            return;
          }
        //   if(countselectoption>1){
        //     if(useraffect==''){
        //       alert('please select user affect')
        //       return;
        //     }
        //   }
          if(amtlist=='' || amtlist=='0'){
            alert('please input transfer amount')
            return;
          }
          if(curid1=='' || selcurtext==''){
            alert('please select currency')
            return;
          }
          if(cuschargelist==''){
            alert('please input customer charge amount')
            return;
          }
          if(curid2==''){
            alert('please select currency')
            return;
          }
          if(feelist==''){
            alert('please input fee amount')
            return;
          }
          if(curid3==''){
            alert('please select currency')
            return;
          }

          addrowlist(pid,pname,-1 * parseFloat(transign) * parseFloat(amtlist) ,cur1,curid1,cuschargelist,cur2,curid2,feelist,cur3,curid3,payincash,recnamelist,recphonelist,sendnamelist,sendphonelist,transign,useraffect,ex_no,thai_list);
          //window.scrollTo(0, document.body.scrollHeight);
          //$('#frmtolist').trigger('reset');
          clearfrmtolist();
          //$('#selpartner').val('').trigger('change');
          //debugger;

        var leftamt=parseFloat($('#selcurlist').attr('title'));
          if(ex_no!=''){
            if(transign==1){
                if(leftamt<=0){updatetbl_out(ex_no,1);}
                refill_tbl_out();
            }else{
                if(leftamt<=0){updatetbl_in(ex_no,1);}
                refill_tbl_in();
            }
            if($('#selcurlist option:selected').text()!==''){
                $('#selpartner').trigger('change');
            }
          }

          // $('.amtlist').toArray().forEach(function(field){
          //     new Cleave(field, {
          //         numeral: true,
          //         numeralThousandsGroupStyle: 'thousand'
          //     });
          // })
      })
   function sumAmountByCurrency(targetCur) {
        let total = 0;

        document.querySelectorAll("#body_partnerlist tr").forEach(row => {
            const amountInput = row.querySelector("input[name='listamt[]']");
            const curInput = row.querySelector("input[name='listcur[]']");

            if (amountInput && curInput) {
                let amt = parseFloat(amountInput.value.replace(/,/g, '').trim());
                let cur = curInput.value.trim();

                if (!isNaN(amt) && cur === targetCur) {
                    total += amt;
                }
            }
        });

        return Math.abs(total);
    }

      function clearfrmtolist()
      {
        var allamt=$('#tdamtlist').attr('title');
        var sumamtlist=sumAmountByCurrency($('#selcurlist option:selected').text());
        var leftamt=parseFloat(allamt)-parseFloat(sumamtlist);
        $('#selcurlist').attr('title',leftamt);
        $('#amtlist').val(formatNumber(leftamt.toFixed(2)));
        $('#cuschargelist').val(0);
        $('#partnerfeelist').val(0);
        $('#payincash').val(0);

      }
      var clicktolistfrom='';
      $(document).on('click','#btntolistbuy',function(e){
          e.preventDefault();
          clicktolistfrom='btntolistbuy';
          var notelist='';
          var lblbuy=$('#lblbuy').attr('title').split(";");
          var curbuy=$('#lblbuy').val();
          var amtbuy=$('#txtbuy').val();
          var sign=$('#txtsign').val();
          $('#amtlist').val(amtbuy);
          $('#txtcur1').val(curbuy);
          $('#txtcur2').val(curbuy);
          $('#txtcur1').attr('title',lblbuy[0]);
          $('#haspartnerlist').val(1);
          $('#payincash').val(0);
          if(sign=='+'){

            $('#partnersign').val(-1);
            notelist='ទិញ ' + $('#txtsale').val() + ' ' + $('#lblsale').val();
          }else{

            $('#partnersign').val(1);
            notelist='លក់ ' + $('#txtsale').val() + ' ' + $('#lblsale').val();
          }
          $('#divpartnerlist').css('display','inline');
          $('#notelist').val(notelist);
      })
      $(document).on('click','#btntolistsale',function(e){
          e.preventDefault();
          clicktolistfrom='btntolistsale';
          var notelist='';
          var lblsale=$('#lblsale').attr('title').split(";");
          var cursale=$('#lblsale').val();
          var amtsale=$('#txtsale').val();
          var sign=$('#txtsign1').val();
          $('#amtlist').val(amtsale);
          $('#txtcur1').val(cursale);
          $('#txtcur2').val(cursale);
          $('#txtcur1').attr('title',lblsale[0]);
          $('#haspartnerlist').val(1);
          $('#payincash').val(0);
          if(sign=='+'){

            $('#partnersign').val(-1);
            notelist='ទិញ ' + $('#txtbuy').val() + ' ' + $('#lblbuy').val();
          }else{

            $('#partnersign').val(1);
            notelist='លក់ ' + $('#txtbuy').val() + ' ' + $('#lblbuy').val();
          }
          $('#notelist').val(notelist);
          $('#divpartnerlist').css('display','inline');
      })
      $(document).on('click','#btnclosedivpartnerlist',function(e){
          e.preventDefault();
          var rownum=$('#tablemultiexchange tr').length -1 ;
          var hasbankpayment=$('#haspartnerlist').val();
          if(hasbankpayment==0){
              if(rownum>0){
                $('#btnsavelist').css('display','inline');
                $('#btnsavelistprint').css('display','inline');
              }else{
                $('#btnsave').css('display','inline');
                $('#btnsaveprint').css('display','inline');
              }
              //$('#btnviewmoney').css('display','none');
          }

          $('#divpartnerlist').css('display','none');
          $('#rowexchangelist').css('display','block');

      })
      $(document).on('click','#btnclosefrmpartnerlist',function(e){
          e.preventDefault();
          $('#haspartnerlist').val(0);
          $('#divfrmpartnerlist').css('display','none');
          $('#body_partnerlist').empty();
          resetaction1();
          resetaction2();
          var rownum=$('#tablemultiexchange tr').length -1 ;
        if(rownum>0){
            $('#btnsavelist').css('display','inline');
            $('#btnsavelistprint').css('display','inline');
        }else{
            $('#btnsave').css('display','inline');
            $('#btnsaveprint').css('display','inline');
        }
        //$('#btnviewmoney').css('display','none');

      })
      $(document).on('click','.rowremove',function(e){
          e.preventDefault();
          //$(this).parent().parent().remove();
          var n=$(this).data('exno');
          var transign=$(this).data('transign');
          $(this).closest("tr").remove();
          ResetNoes();
          if(transign==1){
            updatetbl_out(n,'');
          }else{
            updatetbl_in(n,'');
          }
      });
      function ResetNo(){
          $('.no').each(function(i,e){
              $(this).text(i+1);
          })
      }
      function ResetNoes(){
          $('.noes').each(function(i,e){
              $(this).text(i+1);
          })
      }
      $(document).on('change','.bankid',function(e){
          e.preventDefault();
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();

          var bankname=$('.bankid option:selected').eq(rowind-1).text();
          $('.bankname').eq(rowind-1).val(bankname);
      })
      $(document).on('keyup','.bankamt',function(e){
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          var amtset=parseFloat($(this).val().replace(/,/g, ''));
          if(amtset>0){
            $(this).css('color','blue');
          }else{
            $(this).css('color','red');
          }
          const C = e.key;
          if (C === "Backspace") return;
          if(isNumber(C)==false){
              getcurrencybykey1(C,$('.bankcur').eq(rowind-1));
          }
      })

      $(document).on('click','#btnclosedivbankpayment',function(e){
          e.preventDefault();
          $('#divbankpayment').css('display','none');
          $('#hasbankpayment').val(0);
      })
      $(document).on('click','#btnclosedivdeposit',function(e){
          e.preventDefault();
          $('#divgolddeposit').css('display','none');
          $('#btnsave').css('display','table-row');
          $('#btnsaveprint').css('display','table-row');

      })
      function autofillbankamt(trsign)
      {
        //debugger;
          var table = document.getElementById("tablemultiexchange");
          var tbodyRowCount = table.tBodies[0].rows.length;
          var s=$('#txtsign').val();
          var lbl_title='';
          var examt=0;

          if(tbodyRowCount==0){
            if(trsign==1){//user click បាញ់ចេញ
              if(s=='+'){
                examt=$('#txtsale').val();
                lbl_title=$('#lblsale').attr('title');
                curid=lbl_title.split(';')[0];
              }else{
                examt=$('#txtbuy').val();
                lbl_title=$('#lblbuy').attr('title');
                curid=lbl_title.split(';')[0];
              }
            }else{//user click បាញ់ចូល
              if(s=='+'){
                examt=$('#txtbuy').val();
                lbl_title=$('#lblbuy').attr('title');
                curid=lbl_title.split(';')[0];
              }else{
                examt=$('#txtsale').val();
                lbl_title=$('#lblsale').attr('title');
                curid=lbl_title.split(';')[0];
              }
            }
            $('.bankamt').each(function(i,e){
              $(this).val(examt);
              $('.bankcur').eq(i).val(curid);
            })
          }else{

              $('.txtbuys').each(function(i,e){
                if(trsign==1){
                  examt=$('.txtsales').eq(i).val().replace(/,/g, '');
                  lbl_title=$('.txtsaleinfoes').eq(i).val();
                }else{
                  examt=$('.txtbuys').eq(i).val().replace(/,/g, '');
                  lbl_title=$('.txtbuyinfoes').eq(i).val();
                }
                curid=lbl_title.split(';')[0];
                if($('.bankamt').eq(i).val()==0 || $('.bankamt').eq(i).val()==''){
                    $('.bankamt').eq(i).val(examt);
                    $('.bankcur').eq(i).val(curid);
                  }
                })
          }

      }
      var clickbanksign=0;
      $(document).on('click','#btnbankin,#btnbankout,#btnbankpayment',function(e){
           e.preventDefault();
           //debugger;
          $('#frmtolist').trigger('reset');
          $('#selpartner').val('').trigger('change');
          $('#btnsave').css('display','none');
          $('#btnsaveprint').css('display','none');
          $('#btnsavelist').css('display','none');
          $('#btnsavelistprint').css('display','none');
          $('#rowexchangelist').css('display','none');
          //$('#btnviewmoney').css('display','inline');
          // var s=0;
          // var btitle='';
          // $('#tbl_bankpayment tbody').empty();
          // $('#divbankpayment').css('display','block');
          // $('#hasbankpayment').val(1);
          // var clickfrom=$(this).attr('id');
          // if(clickfrom=='btnbankpayment'){
          //     if($('#partnersign').val()=='1'){
          //         s=-1
          //     }else{
          //         s=1;
          //     }
          // }else{
          //     s=$(this).data('sign');
          // }
          // if(s==1){
          //   btitle='បាញ់ចេញ';
          // }else if(s==-1){
          //   btitle='បាញ់ចូល';
          // }
          // $('#banksign').val(s);
          // $('#bpm').text(btitle);
          // clickbanksign=s;
          // if(s==1){
          //     $('#bpm').css('color','red');
          // }else{
          //     $('#bpm').css('color','blue');
          // }
          // addrow();
          // autofillbankamt(s);
          // $('.bankamt').toArray().forEach(function(field){
          //     new Cleave(field, {
          //         numeral: true,
          //         numeralThousandsGroupStyle: 'thousand'
          //     });
          // })
          // window.scrollTo(0, document.body.scrollHeight);
          //var lblsale=$('#lblsale').attr('title').split(";");
          //var cursale=$('#lblsale').val();
          paymentby($(this).data('sign'));
          var cleave = new Cleave('#amtlist', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        //window.scrollTo(0, document.body.scrollHeight);
      })
      $(document).on('click','#btngolddeposit',function(e){
        e.preventDefault();
        var rowmultiexchange=$('#tablemultiexchange tr').length -1 ;
        if(rowmultiexchange==0){
            var m1 = $('#lblbuy').attr('title').split(";");
            var m2 = $('#lblsale').attr('title').split(";");

            if (m1[7] == '1') {//is gold
                allow=1;
            } else{
                allow=0;
            }
            if(allow==0){
                alert('invalid exchange gold')
                return;
            }
        }
        $('#btnsave').css('display','none');
        $('#btnsaveprint').css('display','none');
        $('#btnsavelist').css('display','none');
        $('#btnsavelistprint').css('display','none');
        $('#divgolddeposit').css('display','block');
        // $('#selcurdeposit').val($('#lblsale').val());
        // $('#selcurdeposit1').val($('#lblsale').val());
        $('#selbankdeposit').val('');
        $('#txtdeposit').focus();
        $('#txtdeposit').css('color', $('#txtsale').css('color'));
        $('#txtdeposit1').css('color', $('#txtsale').css('color'));
        if(rowmultiexchange>0){
            $('#btnsavedeposit').css('display','none');
            $('#btnsavedepositprint').css('display','none');
            $('#btnsavedeposit2').css('display','table-row');
            $('#btnsavedepositprint2').css('display','table-row');

        }else{
            $('#btnsavedeposit').css('display','table-row');
            $('#btnsavedepositprint').css('display','table-row');
            $('#btnsavedeposit2').css('display','none');
            $('#btnsavedepositprint2').css('display','none');
        }
      })
      $(document).on('change','#txtdeposit',function(e){
        e.preventDefault();
        $('#txtdeposit1').val($(this).val());
      })
       $(document).on('change','#selcurdeposit',function(e){
        e.preventDefault();
        $('#selcurdeposit1').val($(this).val());
      })
      $('input:radio[name="optinout"]').change(function() {
        $('#cuschargelist').val(0);
        $('#partnerfeelist').val(0);
        $('#payincash').val(0);
        if ($(this).val() == '1') {
          paymentby(1);
        } else {
          paymentby(-1);
        }
        var allamt=$('#tdamtlist').attr('title');
        var sumamtlist=sumAmountByCurrency($('#selcurlist option:selected').text());
        var leftamt=parseFloat(allamt)-parseFloat(sumamtlist);
        $('#amtlist').val(formatNumber(leftamt.toFixed(2)));
      });
      function addrow(){
          var nn=$('#tbl_bankpayment tr').length+1;
          let tst = Math.round(Date.now() / 1000)+nn;
          var row=`<tr>
                      <td style="text-align:center;display:none;" class="no kh16">${nn}</td>
                      <td style="width:250px;padding:0px;">
                          <select name="bankid[]" class="form-select select2-option1 bankid" id="bankid${nn}"  style="width:250px;"></select>
                      </td>
                      <td style="padding:0px;display:none;">
                          <input type="text" class="form-control bankname kh22" style="text-align:right;" name="bankname[]">
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter bankamt kh22" style="text-align:right;" name="bankamt[]">
                      </td>
                      <td style="width:100px;padding:0px;">
                          <select name="bankcur[]" class="form-select bankcur kh22" id="bankcur${nn}" style="width:130px;"></select>
                      </td>

                      <td style="text-align:center;padding:5px 0px 0px 0px;">
                          <a href="#" class="btn btn-danger remove" style="border-radius:15px;"><i class="fa fa-minus"></i></a>
                      </td>
                  </tr>`;
              $('#body_bankpayment').append(row);

              //$('.unit option').remove();

              $('#selcur option').clone().appendTo('#bankcur'+nn);
              $('#selbank option').clone().appendTo('#bankid'+nn);
              //$('#bankid'+nn).select2();
              $('#bankid'+nn).select2({
                templateResult: formatOption1
              });
              //number('.barcode',true);

      }
      function paymentby(s)
      {
        //debugger;

        var ismultiexchange=$('#tablemultiexchange tr').length -1 ;
        $('#divpartnerlist').css('display','inline');
          $('#radio_in').prop('checked',true);
          clicktolistfrom='btntolistsale';
          var notelist='';
          var amt=0;
          var curid='';
          var cur='';

          var sign=$('#txtsign').val();
          if(sign=='+'){
            if(s=='1'){//user click បាញ់ចេញ
              if(ismultiexchange>0){

              }else{
                amt=$('#txtsale').val().replace(/,/g, '');
                curid=$('#lblsale').attr('title').split(";")[0];
              }
              $('#radio_out').prop('checked',true);

            }else{
              if(ismultiexchange>0){

              }else{
                amt=$('#txtbuy').val().replace(/,/g, '');
                curid=$('#lblbuy').attr('title').split(";")[0];
              }
              $('#radio_in').prop('checked',true);

            }
          }else{
            if(s=='1'){//user click បាញ់ចេញ

              amt=$('#txtbuy').val().replace(/,/g, '');
              curid=$('#lblbuy').attr('title').split(";")[0];
              $('#radio_out').prop('checked',true);

            }else{
              amt=$('#txtsale').val().replace(/,/g, '');
              curid=$('#lblsale').attr('title').split(";")[0];
              $('#radio_in').prop('checked',true);

            }
          }

          $('#amtlist').val(Math.abs(amt));
          $('#amtlist').attr('title',Math.abs(amt));
          $('#tdamtlist').attr('title',Math.abs(amt));
          $('#selcurlist').val(curid);
          $('#txtcur2').val(curid);
          $('#cuschargelistcur').val(curid);
          $('#partnerfeelistcur').val(curid);
          $('#txtcur2').val($('#selcurlist option:selected').text());
          //$('#haspartnerlist').val(1);
          $('#payincash').val(0);
          $('#txtsignlist').val(s);

          if(ismultiexchange>0){
            if(s==1){//user click បាញ់ចេញ
              // var col_no= $('#tbl_out').find("tr:eq(1)").find("td:eq(0)").html();
              //   amt=$('#tbl_out').find("tr:eq(1)").find("td:eq(2)").html();
              //   cur=$('#tbl_out').find("tr:eq(1)").find("td:eq(3)").html();
              //   var currencylist;
              //   if(localStorage.getItem("currencylist")==null){
              //     currencylist=[];
              //   }else{
              //     currencylist=JSON.parse(localStorage.getItem("currencylist"));
              //   }
              //   currencylist.forEach(function(c){
              //     if(c.shortcut==cur){
              //       curid=c.id;
              //     }
              //   })
              refill_tbl_out();
            }else{
              // var col_no= $('#tbl_in').find("tr:eq(1)").find("td:eq(0)").html();
              //   amt=$('#tbl_in').find("tr:eq(1)").find("td:eq(2)").html();
              //   cur=$('#tbl_in').find("tr:eq(1)").find("td:eq(3)").html();
              //   var currencylist;
              //   if(localStorage.getItem("currencylist")==null){
              //     currencylist=[];
              //   }else{
              //     currencylist=JSON.parse(localStorage.getItem("currencylist"));
              //   }
              //   currencylist.forEach(function(c){
              //     if(c.shortcut==cur){
              //       curid=c.id;
              //     }
              //   })
              refill_tbl_in();
            }
          }

          if(sign=='+'){

            $('#partnersign').val(-1);
            notelist='ទិញ ' + $('#txtbuy').val() + ' ' + $('#lblbuy').val();
          }else{

            $('#partnersign').val(1);
            notelist='លក់ ' + $('#txtbuy').val() + ' ' + $('#lblbuy').val();
          }
          $('#notelist').val(notelist);
          var cleave = new Cleave('#amtlist', {
          numeral: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      if($('#selpartner').val()!==''){
              var mekun= document.querySelector('input[name = optinout]:checked').value;
              fillnextbalance('#balance1','#balancenext1',$('#selcurlist option:selected').text(),mekun,$('#amtlist').val(),$('#partnerfeelist').val());
          }

      }
      function addrowlist(pid,pname,amt,cur1,idcur1,cuscharge,cur2,idcur2,fee,cur3,idcur3,totalcash,recname,rectel,sendname,sendtel,transign,useraffect,ex_no,thai_list)
      {
          var nn=$('#tbl_partnerlist tr').length;
          let tst = Math.round(Date.now() / 1000)+nn;
          var row=`<tr class="paybybank">
                      <td style="text-align:center;" class="noes kh12-b">${nn}</td>
                      <td style="padding:0px;display:none;">
                          <input type="text" class="form-control partner_id kh12-b" style="width:50px;" name="partner_id[]" value="${pid}" readonly>
                      </td>
                       <td style="text-align:center;padding:2px 0px;">
                          <a href="#" class="btn btn-danger btn-sm rowremove" style="border-radius:15px;height:25px;width:25px;color:white;" data-exno="${ex_no}" data-transign="${transign}"><span style="position:relative;top:-18px;left:-3px;font-size:32px;font-weight:bold;">-</span></a>
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control parrent_name kh12-b" style="width:200px;" name="parrent_name[]" value="${pname}" readonly>
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listamt kh12-b" style="text-align:right;width:150px;" name="listamt[]" value="${formatNumber(amt)}" readonly>
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listcur kh12-b" style="width:80px;" name="listcur[]" value="${cur1}" readonly>
                          <input type="hidden" class="form-control tdcanenter listcurid kh12-b" style="width:80px;" name="listcurid[]" value="${idcur1}">
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listcuscharge kh12-b" style="text-align:right;width:100px;" name="listcuscharge[]" value="${cuscharge}" readonly>
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listcuschargecur kh12-b" style="width:80px;" name="listcuschargecur[]" value="${cur2}" readonly>
                          <input type="hidden" class="form-control tdcanenter listcuschargecurid kh12-b" style="width:80px;" name="listcuschargecurid[]" value="${idcur2}">
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listfee kh12-b" style="text-align:right;width:100px;" name="listfee[]" value="${fee}" readonly>
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listfeecur kh12-b" style="width:80px;" name="listfeecur[]" value="${cur3}" readonly>
                          <input type="hidden" class="form-control tdcanenter listfeecurid kh12-b" style="width:80px;" name="listfeecurid[]" value="${idcur3}">
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listtotalcash kh12-b" style="text-align:right;width:150px;" name="listtotalcash[]" value="${totalcash}" readonly>
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listtotalcashcur kh12-b" style="text-align:right;width:80px;" name="listtotalcashcur[]" value="${cur1}" readonly>
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listrectel kh12-b" style="width:200px;" name="listrectel[]" value="${rectel}">
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listrecname kh12-b" style="width:200px;" name="listrecname[]" value="${recname}">
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listsendtel kh12-b" style="width:200px;" name="listsendtel[]" value="${sendtel}">
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter listsendname kh12-b" style="width:200px;" name="listsendname[]" value="${sendname}">
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter transign kh12-b" style="width:100px;" name="transign[]" value="${transign}" readonly>
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter useraffect kh12-b" style="width:200px;" name="useraffect[]" value="${useraffect}" readonly>
                      </td>
                      <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter exno kh12-b" style="width:200px;" name="exno[]" value="${ex_no}" readonly>
                      </td>
                       <td style="padding:0px;">
                          <input type="text" class="form-control tdcanenter thai_list kh12-b" style="width:200px;" name="thai_list[]" value="${thai_list}" readonly>
                      </td>

                  </tr>`;
              $('#body_partnerlist').append(row);
              $('#divfrmpartnerlist').css('display','inline')


      }
      $('btnclear').click(function(e){
          e.preventDefault();
          $('#frmexchange').trigger('reset');
          $('#lblbuy').attr('title','');
          $('#lblsale').attr('title','');
          $('#txtrate').attr('title','');
      })
      $('#btnhasmoney').click(function(e){
        e.preventDefault();
        $('#txt_hn').val(1);
        $('#divr2').css('display','block');
        $('#hd_r2').text('អតិថិជនមានលុយ');
        $('#hd_r2').css('color','blue');
        $('.amt_hn').eq(0).val('');
        $('.cut_hn').eq(0).val('');
        $('.bal_hn').eq(0).val('');
        $('.amt_hn').css('color','blue');
        $('.cut_hn').css('color','blue');
        $('.bal_hn').css('color','blue');
        $('.amt_hn').focus();
      })
      $('#btnneedmoney').click(function(e){
        e.preventDefault();
        $('#txt_hn').val(-1);
        $('#divr2').css('display','block');
        $('#hd_r2').text('អតិថិជនត្រូវការលុយ');
        $('#hd_r2').css('color','red');
        $('.amt_hn').eq(0).val('');
        $('.cut_hn').eq(0).val('');
        $('.bal_hn').eq(0).val('');
        $('.amt_hn').css('color','red');
        $('.cut_hn').css('color','red');
        $('.bal_hn').css('color','red');
        $('.amt_hn').focus();
      })

    function validate(txtbuy, txtsale, txtrate,lomeang) {
        if (txtbuy === '' || txtsale === '' || txtrate === '') return 1;

        let buy = Math.abs(parseFloat(txtbuy.replace(/,/g, '')));
        let sale = Math.abs(parseFloat(txtsale.replace(/,/g, '')));
        let rate = Math.abs(parseFloat(txtrate.replace(/,/g, '')));

        if (isNaN(buy) || isNaN(sale) || isNaN(rate) || rate === 0) return 1;

        // Compute expected sale value from buy using rate
        let salecompare = 0;
        if (buy > sale) {
            salecompare = (rate < 1) ? buy * rate : buy / rate;
        } else {
            salecompare = (rate < 1) ? buy / rate : buy * rate;
        }

        let cm = salecompare - sale;
        return Math.abs(cm) >= lomeang ? 1 : 0; // 1 means invalid, 0 valid

    }

    function validategold(txtbuy, txtsale, txtrate) {
        if (txtbuy === '' || txtsale === '' || txtrate === '') return 1;
    }
      $('#btnaddlist').click(function(e){
        e.preventDefault();
        var sp = document.querySelector("#lblsale");
        var lomeang=sp.options[sp.selectedIndex].getAttribute('lomeang');
         let elg = document.getElementById('txtgoldwater');
        var watergold=0;
        if (elg && elg.offsetParent !== null) {
            if(validategold($('#txtbuy').val(),$('#txtsale').val(),$('#txtrate').val())){
                alert('invalid exchange')
                return;
            }
            watergold=$('#txtgoldwater').val();
            if(watergold==''){
                alert('please input gold of water')
                return;
            }
        }else{
            if(validate($('#txtbuy').val(),$('#txtsale').val(),$('#txtrate').val(),lomeang)==1){
                alert('invalid exchange')
                return;
            }
        }
        $('body').addClass("wait");
          $('#rowmultiexchange').css('display','inline');
          var formdata = new FormData;
          if($('#txtsign').val()=='+'){
              formdata.append("buy",$('#txtbuy').val());
              formdata.append("curbuy",$('#lblbuy option:selected').text());
              formdata.append("sale",$('#txtsale').val());
              formdata.append("cursale",$('#lblsale option:selected').text());
              formdata.append("buyinfo",$('#lblbuy').attr('title'));
              formdata.append("saleinfo",$('#lblsale').attr('title'));

          }else{
              formdata.append("buy",$('#txtsale').val());
              formdata.append("curbuy",$('#lblsale option:selected').text());
              formdata.append("sale",$('#txtbuy').val());
              formdata.append("cursale",$('#lblbuy option:selected').text());
              formdata.append("buyinfo",$('#lblsale').attr('title'));
              formdata.append("saleinfo",$('#lblbuy').attr('title'));
          }
          formdata.append("rateinfo",$('#txtrate').attr('title'));
          formdata.append('rate',$('#txtrate').val());
          formdata.append('drate',$('#lblrate').attr('title'));
          formdata.append('dd',$('#invdate').val());
          formdata.append('watergold',watergold);
          $.ajax({
              async: true,
              type: 'POST',
              contentType: false,
              processData: false,
              url: "{{ route('saveaddlist') }}",
              data: formdata,
              success: function (data) {
                 //console.log(data)
                 //$('#frmexchange').trigger('reset');
                 //$('#txtbuy').css('color','blue');
                 //$('#txtsale').css('color','red');
                 //$('#lblbuy').attr('title','');
                 //$('#lblsale').attr('title','');
                 //$('#txtrate').attr('title','');
                 $('#txtbuy').val('');
                 $('#txtsale').val('');
                 $('#txtbuy').focus();
                 getmultiexchangelist();
                 calcuhasneedmoney();
                 $('#invdate').datetimepicker({
                  timepicker:false,
                  datepicker:true,
                  value:today,
                  format:'d-m-Y',
                  autoclose:true,
                  todayBtn:true,
                  startDate:today,

                  });
                  visiblebutton();
                $('body').removeClass("wait");
              },
              error: function () {
                 $('body').removeClass("wait");
                  alert('Save Error.')
              }

          })
      })
      function calcuhasneedmoney()
      {
        //debugger;
        var amthn=$('.amt_hn').eq(0).val().replace(/,/g, '');
        var amt1= $('.amt1').eq(0).text().replace(/,/g, '');
        var amt2= $('.amt2').eq(0).text().replace(/,/g, '');
        if($('#txt_hn').val()==1){
            var bal=parseFloat(amthn) - parseFloat(amt1);
            $('.cut_hn').eq(0).val(formatNumber(amt1));
        }else{
            var bal=parseFloat(amthn) + parseFloat(amt2);
            $('.cut_hn').eq(0).val(formatNumber(Math.abs(amt2)));
        }

        $('.bal_hn').eq(0).val(formatNumber(bal.toFixed(2)));
      }
      visiblebutton();
      function visiblebutton()
      {
          var rownum=$('#tablemultiexchange tr').length -1 ;

          if(rownum>0){
              $('#rowmultiexchange').css('display','inline');
              $('#btnsave').css('display','none');
              $('#btnsaveprint').css('display','none');
              $('#btnsavepartnerlist').css('display','none');
              $('#btnsavepartnerlistprint').css('display','none');
              $('#btnsavelist').css('display','inline');
              $('#btnsavelistprint').css('display','inline');
              $('#btnsavepartnerlist2').css('display','inline');
              $('#btnsavepartnerlistprint2').css('display','inline');

          }else{
            $('#divgolddeposit').css('display','none');
            $('#rowmultiexchange').css('display','none');
              $('#btnsave').css('display','inline');
              $('#btnsaveprint').css('display','inline');
              $('#btnsavepartnerlist').css('display','inline');
              $('#btnsavepartnerlistprint').css('display','inline');
              $('#btnsavelist').css('display','none');
              $('#btnsavelistprint').css('display','none');
              $('#btnsavepartnerlist2').css('display','none');
              $('#btnsavepartnerlistprint2').css('display','none');
          }

      }
      $(document).on('click','.btndelmxlist',function(e){
          e.preventDefault();
          var id=$(this).data('id');
          var url="{{ route('delete_multiexchangelist') }}";
          $.post(url,{id:id},function(data){
              console.log(data)
              if(data.success){
                  getmultiexchangelist();
                  visiblebutton();
              }else{
                  alert(data.error)
              }
          })
      })
      $(document).on('click','.btnprint',function(e){
                e.preventDefault();
                var mapid=$(this).data('id');
                //alert(mapid)
                prints(mapid,1,0)
            })

            $(document).on('click','.btndel',function(e){
                e.preventDefault();
                //debugger
                Swal.fire({
                    title: 'Are you sure to remove this exchange?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var mapid=$(this).data('id');

                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('deleteexchange') }}",
                            data: { id: mapid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //$("tbody #tr_object_id_" + mapid).remove();
                                    refreshexchangelist();
                                    //location.reload();
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
        $("#txtgoldwater").on("focus", function () {
            $(this).select();
        });
        function prints(mapid,reprint,isgold_deposit,status=1){

            var redirectWindow = window.open('{{ url('/') }}'+'/exchange/prints?mapid='+mapid+'&reprint='+reprint+'&isgold_deposit=' + isgold_deposit+'&status='+status, '_blank');
            redirectWindow.location;
        }
        function prints_xxx(mapid, reprint, isgold_deposit) {

            // // --- Collect all receive amounts ---
            // let receive_list = [];
            // document.querySelectorAll('.exmulti_receive_amt').forEach(function(input) {
            //     receive_list.push(input.value.replace(/,/g,'')); // remove comma
            // });

            // // --- Collect all return amounts ---
            // let return_list = [];
            // document.querySelectorAll('.exmulti_return_amt').forEach(function(input) {
            //     return_list.push(input.value.replace(/,/g,'')); // remove comma
            // });

            // let cur_list = [];
            // document.querySelectorAll('.cur1').forEach(function(td) {
            //     cur_list.push(td.innerText.trim());   // get text inside <td>
            // });
            // let cur_json = encodeURIComponent(JSON.stringify(cur_list));
            // // Convert to JSON (safe for URL)
            // let rec_json   = encodeURIComponent(JSON.stringify(receive_list));
            // let ret_json   = encodeURIComponent(JSON.stringify(return_list));




            // --- Open print receipt page with parameters ---
            // var redirectWindow = window.open(
            //     '{{ url('/') }}' +
            //     '/exchange/prints?mapid=' + mapid +
            //     '&reprint=' + reprint +
            //     '&isgold_deposit=' + isgold_deposit +
            //     '&receive=' + rec_json +
            //     '&return=' + ret_json + '&cur=' + cur_json,
            //     '_blank'
            // );
             var redirectWindow = window.open(
                '{{ url('/') }}' +
                '/exchange/prints?mapid=' + mapid +
                '&reprint=' + reprint +
                '&isgold_deposit=' + isgold_deposit +
                '&receive=' + rec_json +
                '&return=' + ret_json + '&cur=' + cur_json,
                '_blank'
            );
        }

        function prints_wait(mapid, reprint, isgold_deposit,status) {

            return new Promise((resolve) => {

                // // --- Collect all receive amounts ---
                // let receive_list = [];
                // document.querySelectorAll('.exmulti_receive_amt').forEach(function(input) {
                //     receive_list.push(input.value.replace(/,/g,'')); // remove comma
                // });

                // // --- Collect all return amounts ---
                // let return_list = [];
                // document.querySelectorAll('.exmulti_return_amt').forEach(function(input) {
                //     return_list.push(input.value.replace(/,/g,'')); // remove comma
                // });

                // // --- Collect currency ---
                // let cur_list = [];
                // document.querySelectorAll('.cur1').forEach(function(td) {
                //     cur_list.push(td.innerText.trim());
                // });

                // let rec_json = encodeURIComponent(JSON.stringify(receive_list));
                // let ret_json = encodeURIComponent(JSON.stringify(return_list));
                // let cur_json = encodeURIComponent(JSON.stringify(cur_list));
               let cashreceive = "";
                let cashreturn = "";
                let found_cashreceive = 0;

                const table_in = document.getElementById('tbl_in');

                // Loop rows
                table_in.querySelectorAll('tbody tr').forEach((row) => {
                    const amt = row.querySelector('td.amt1')?.textContent.trim();
                    const cur = row.querySelector('td.cur1')?.textContent.trim();
                    const receive = row.querySelector('input.exmulti_receive_amt')?.value.trim();
                    const returnAmt = row.querySelector('input.exmulti_return_amt')?.value.trim();

                    if (cashreceive === "") {
                        // first line
                        if (receive === "") {
                            cashreceive = amt + cur;
                        } else {
                            found_cashreceive = 1;
                            cashreceive = receive + cur;
                            if (returnAmt != 0 && returnAmt !== "") {
                                cashreturn = returnAmt + cur;
                            }
                        }
                    } else {
                        // next lines
                        if (receive === "") {
                            cashreceive += ";" + amt + cur;
                        } else {
                            found_cashreceive = 1;
                            cashreceive += ";" + receive + cur;

                            if (returnAmt != 0 && returnAmt !== "") {
                                cashreturn += (cashreturn === "" ? "" : ";") + returnAmt + cur;
                            }
                        }
                    }
                });

                // Get the table_out
                const table_out = document.getElementById('tbl_out');
                // Loop through all rows in tbody
                table_out.querySelectorAll('tbody tr').forEach((row) => {
                    const amt2 = row.querySelector('td.amt2')?.textContent.trim();          // hidden amount
                    const cur2 = row.querySelector('td.cur2')?.textContent.trim();          // hidden currency
                    if(cashreturn==''){
                        cashreturn = amt2 + cur2;
                    }else{
                        cashreturn +=';' + amt2 + cur2;
                    }

                });
                // --- Open print receipt page ---
                // let url =
                //     '{{ url('/') }}' +
                //     '/exchange/prints?mapid=' + mapid +
                //     '&reprint=' + reprint +
                //     '&isgold_deposit=' + isgold_deposit +
                //     '&cash_receive=' + rec_json +
                //     '&cash_return=' + ret_json +
                //     '&cur_receive=' + cur_json;

                 let url =
                    '{{ url('/') }}' +
                    '/exchange/prints?mapid=' + mapid +
                    '&reprint=' + reprint +
                    '&isgold_deposit=' + isgold_deposit +
                    '&cash_receive=' + cashreceive +
                    '&cash_return=' + cashreturn +
                    '&found_cashreceive=' + found_cashreceive +
                    '&status=' + status;

                window.open(url, "_blank");

                // --- WAIT for print done ---
                window.addEventListener("message", function(e) {
                    if (e.data.printDone === true) {
                        resolve(); // printing completed
                    }
                });
            });
        }

      $(document).on('click','#btnsavelist,#btnsavelistprint,#btnsavepartnerlist2,#btnsavepartnerlistprint2,#btnsavedeposit2,#btnsavedepositprint2,#btnprint_test2',function(e){
          e.preventDefault();

          try{

                 var idclick=$(this).attr('id');
                 var status=1;
                 if(idclick=='btnprint_test2'){
                    status=0;
                 }
               if (idclick == 'btnsavedeposit2' || idclick == 'btnsavedepositprint2') {
                    isgold_deposit = 1;

                    let deposit = parseFloat($('#txtdeposit').val().replace(/,/g, '')) || 0;
                    let depositBank = parseFloat($('#txtdeposit1').val().replace(/,/g, '')) || 0;
                    let payvia = $('#selbankdeposit').val();

                    if (deposit < 0 || depositBank < 0) {
                        alert('Invalid deposit amount.');
                        return;
                    }
                    if (payvia == '') {
                        alert('please select bank');
                        return;
                    }
                    if (payvia == '0') {
                        bank_amount=0;
                        cash_amount=deposit;
                        if (deposit !== depositBank) {
                            alert('Deposit amount must match exactly for cash payment.');
                            return;
                        }
                    } else {
                        bank_amount=depositBank;
                        cash_amount=deposit - depositBank;
                        if (deposit < depositBank) {
                            alert('Bank deposit amount cannot be greater than customer deposit.');
                            return;
                        }
                    }
                    if($('#client_tel').val()==''){
                        alert('please input customer tel')
                        return;
                    }

                } else {
                    isgold_deposit = 0;

                }

              $('body').addClass("wait");
              var buttontext=$(this).text();
              $(this).attr('disabled', true).text("Processing");
              var el=$(this);

              var dd=$('#invdate').val();
              var hasbankpayment=$('#hasbankpayment').val();
              var formdata=new FormData(frmmultiexchange);
              formdata.append("dd",dd);
              formdata.append("status",status);
            let ck_water = $('#ckwater').is(':checked');
             formdata.append('ck_water',ck_water==true?1:0);
            var table = document.getElementById("tbl_partnerlist");
            var totalRowCount = table.rows.length;
            var tbodyRowCount = table.tBodies[0].rows.length;
            var foundpartnerlist=0;
            if(tbodyRowCount>0){
              foundpartnerlist=1;
              $('.partner_id').each(function(i,e){
                  formdata.append("partner_id[]",$(this).val());
              })
              $('.parrent_name').each(function(i,e){
                  formdata.append("parrent_name[]",$(this).val());
              })
              $('.listamt').each(function(i,e){
                  formdata.append("listamt[]",$(this).val());
              })
              $('.listcurid').each(function(i,e){
                  formdata.append("listcurid[]",$(this).val());
              })
              $('.listcuscharge').each(function(i,e){
                  formdata.append("listcuscharge[]",$(this).val());
              })
              $('.listcuschargecurid').each(function(i,e){
                  formdata.append("listcuschargecurid[]",$(this).val());
              })
              $('.listfee').each(function(i,e){
                  formdata.append("listfee[]",$(this).val());
              })
              $('.listfeecurid').each(function(i,e){
                  formdata.append("listfeecurid[]",$(this).val());
              })
              $('.listrecname').each(function(i,e){
                formdata.append("listrecname[]", $(this).val());
              })
              $('.listrectel').each(function(i,e){
                  formdata.append("listrectel[]",$(this).val());
              })
               $('.listsendname').each(function(i,e){
                formdata.append("listsendname[]", $(this).val());
              })
              $('.listsendtel').each(function(i,e){
                  formdata.append("listsendtel[]",$(this).val());
              })
              $('.transign').each(function(i,e){
                  formdata.append("transign[]",$(this).val());
              })
              $('.useraffect').each(function(i,e){
                  formdata.append("useraffect[]",$(this).val());
              })
              $('.thai_list').each(function(i,e){
                formdata.append("thai_list[]", $(this).val());
              })
            }
            formdata.append("foundpartnerlist",foundpartnerlist);
             formdata.append("isgold_deposit", isgold_deposit);
              if(isgold_deposit==1){
                formdata.append('selcustomergold',$('#selcustomergold').val());
                formdata.append('txtdeposit',$('#txtdeposit').val());
                formdata.append('selcurdeposit',$('#selcurdeposit').val());
                formdata.append('txtdeposit1',$('#txtdeposit1').val());
                formdata.append('selcurdeposit1',$('#selcurdeposit1').val());
                formdata.append('selbankdeposit',$('#selbankdeposit').val());
                formdata.append('client_name',$('#client_name').val());
                formdata.append('client_tel',$('#client_tel').val());

                customertype = $('#selbankdeposit').find(':selected').attr('customertype');
                formdata.append("customertype_deposit",customertype);
                formdata.append("bank_amount",bank_amount);
                formdata.append("cash_amount",cash_amount);
                formdata.append('deposit_via',$('#selbankdeposit option:selected').text());
              }
              var url="{{ route('savemultiexchanges') }}"
              $.ajax({
                  async: true,
                  type: 'POST',
                  contentType: false,
                  processData: false,
                  url: url,
                  data: formdata,
                  success:async function (data) {
                     console.log(data)
                     if($.isEmptyObject(data.error)){
                          toastr.success(data.success);

                          if(idclick=='btnsavelistprint' || idclick=='btnsavepartnerlistprint2' || idclick=='btnsavedepositprint2' || idclick=='btnprint_test2'){
                              await prints_wait(data.mapid,0,isgold_deposit,status);
                          }
                          if(idclick!=='btnprint_test2'){
                              getmultiexchangelist();
                              visiblebutton();
                              RefreshForm();
                              refreshexchangelist();
                              //getusercapital_master($('#loginid').val(),$('#invdate').val());
                              getuseraccount_master(1,1,$('#loginid').val());
                          }
                          $(el).removeAttr('disabled').html(buttontext);
                          $('body').removeClass("wait");
                     }else{
                        $(el).removeAttr('disabled').html(buttontext);
                          $('body').removeClass("wait");
                          alert(data.error)
                     }

                  },
                  error: function () {
                    $(el).removeAttr('disabled').html(buttontext);
                      $('body').removeClass("wait");
                      alert('Save Error.')
                  }

              })

          }catch{
            $(el).removeAttr('disabled').html(buttontext);
            $('body').removeClass("wait");
          }
      })
      $(document).on('keyup','.amt_hn',function(e){
            //debugger;
            const C = e.key;
            if (C === "Backspace") {return;}
            if(C==='Enter'){
                $('#selcur_hn').trigger('change');
                $('#txtbuy').focus();
                return;
            }
            if(isNumber(C)==false){
              getcurrencybykeylocalstorage(C,'#selcur_hn','')
              //$('#selcur_hn').trigger('change');
            }
            e.preventDefault();
      })
      $(document).on('change','#selcur_hn',function(e){
        e.preventDefault();
        var cur=$('#selcur_hn option:selected').text();
        $('#hnc1').val(cur);
        $('#hnc2').val(cur);

      })
      $(document).on('keyup', '#txtsale', function (e) {
        if(isNumber(e.key)){
              calcuexchange1();
              return;
          }
          const C = e.key;
          if (C === "Backspace") {
              calcuexchange1();
              return;
          }
      })
    $(document).on('keyup', '#txtgoldwater', function (e) {
        if(isNumber(e.key)){
              calcuexchange();
              return;
          }
          const C = e.key;
          if (C === "Backspace") {
              calcuexchange();
              return;
          }
      })
      $(document).on('keyup', '#txtbuy', function (e) {
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
          }else if(C==="+"){
              e.preventDefault();
              $('#txtbuy').css('color','blue');
              $('#txtsale').css('color','red');
              $('#txtsign').val('+');
              $('#txtsign').css('color','blue');
              $('#txtsign1').val('-');
              $('#txtsign1').css('color','red');
              $('#lblbuy').css('color','blue');
              $('#lblsale').css('color','red');
              fillcurcur();
              getrate();
              return;
          }else if(C==="-"){
              e.preventDefault();
              $('#txtbuy').css('color','red');
              $('#txtsale').css('color','blue');
              $('#txtsign').val('-');
              $('#txtsign1').val('+');
              $('#txtsign').css('color','red');
              $('#txtsign1').css('color','blue');
              $('#lblbuy').css('color','red');
              $('#lblsale').css('color','blue');
              fillcurcur();
              getrate();
              return;
          }
          if(isNumber(C)==false){
              //getcurrencybykey(C,'#lblbuy')
              getcurrencybykeylocalstorage(C,'#lblbuy','#imgbuy');

          }
      })

      $(document).on('change','#lblbuy',function(e){
        e.preventDefault();
        getcurrencybyidlocalstorage($(this).val(),'#lblbuy','#imgbuy')
      })
      $(document).on('change','#lblsale',function(e){
        e.preventDefault();
        getcurrencybyidlocalstorage($(this).val(),'#lblsale','#imgsale')
      })
      $(document).on('keyup', '#txtrate', function (e) {
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
          if(C==="ArrowDown" || C==='+'){
              $('#btnaddlist').click();
              return;
          }
          if(isNumber(C)==false){
              //getcurrencybykey(C,'#lblsale')
              getcurrencybykeylocalstorage(C,'#lblsale','#imgsale');
          }
      })
      $(document).on('keyup', '#txtcashreceive', function (e) {
          docashin();
      })
      $('input[type=radio][name=radcustype]').change(function() {
            getpartner(this.value,'#selpartner');
        });
        function getpartner(type,el)
        {

            var url="{{ route('getpartnerbytype') }}";
            $(el).empty();

            $.get(url,{type:type},function(data){
                $(el).append($("<option/>",{
                            value:'',
                            text:''
                        }))
                $.each(data,function(i,item){
                    $(el).append($("<option/>",{
                            value:item.id,
                            text:item.name,
                            customertype:item.customertype,
                            agenttype:item.agent_type_id,
                            countrycode:item.tel,
                            maxtransfer:item.agenttype.transfer_amount,
                            maxcuscharge:item.agenttype.customer_fee,
                            maxfee:item.agenttype.cashdraw_fee,
                            maxtransferfee:item.agenttype.transfer_fee,
                            userconnect:item.user_connect,
                            thai_list:item.thai_list

                        }))
                    //console.log(item)
                });

            })
        }
      $(document).on('click', '#btnsave,#btnsaveprint,#btnsavepartnerlist,#btnsavepartnerlistprint,#btnsavedeposit,#btnsavedepositprint,#btnprint_test', function (e) {
        e.preventDefault();
        var sp = document.querySelector("#lblsale");
        var lomeang=sp.options[sp.selectedIndex].getAttribute('lomeang');
        // var isgold=sp.options[sp.selectedIndex].getAttribute('isgold');
        // var tuochek=sp.options[sp.selectedIndex].getAttribute('tuocheck');
        let elg = document.getElementById('txtgoldwater');
        var watergold=0;
        if (elg && elg.offsetParent !== null) {
             if(validategold($('#txtbuy').val(),$('#txtsale').val(),$('#txtrate').val())){
                alert('invalid exchange')
                return;
            }
            watergold=$('#txtgoldwater').val();
        }else{
            if(validate($('#txtbuy').val(),$('#txtsale').val(),$('#txtrate').val(),lomeang)==1){
                alert('invalid exchange')
                return;
            }
        }


        const inputDateStr = $('#invdate').val(); // e.g., "19-05-2025"
        const parts = inputDateStr.split("-"); // ["19", "05", "2025"]

        // Convert to "YYYY-MM-DD"
        const formattedInputDateStr = `${parts[2]}-${parts[1]}-${parts[0]}`;
        const inputDate = new Date(formattedInputDateStr);
        const currentDate = new Date();

        // Remove time part from current date for accurate comparison
        currentDate.setHours(0, 0, 0, 0);
        inputDate.setHours(0, 0, 0, 0);

        if (inputDate.getTime() !== currentDate.getTime()) {
            const confirmSave = confirm("The selected date is not today.\nDo you still want to save?");
            if (!confirmSave) {
                return; // User clicked Cancel → stop saving
            }
        }
          try{

                var buttontext=$(this).text();
                var cashreceive='';
                var cashreturn='';
                var btnid=$(this).attr('id');
                var status=1;
                if(btnid=='btnprint_test'){
                    status=0;
                }
            if (btnid == 'btnsavedeposit' || btnid == 'btnsavedepositprint') {
                isgold_deposit = 1;

                let deposit = parseFloat($('#txtdeposit').val().replace(/,/g, '')) || 0;
                let depositBank = parseFloat($('#txtdeposit1').val().replace(/,/g, '')) || 0;
                let payvia = $('#selbankdeposit').val();

                if (deposit < 0 || depositBank < 0) {
                    alert('Invalid deposit amount.');
                    return;
                }
                if (payvia == '') {
                    alert('please select bank');
                    return;
                }
                if (payvia == '0') {
                    bank_amount=0;
                    cash_amount=deposit;
                    if (deposit !== depositBank) {
                        alert('Deposit amount must match exactly for cash payment.');
                        return;
                    }
                } else {
                    bank_amount=depositBank;
                    cash_amount=deposit - depositBank;
                    if (deposit < depositBank) {
                        alert('Bank deposit amount cannot be greater than customer deposit.');
                        return;
                    }
                }
                  if($('#client_tel').val()==''){
                        alert('please input customer tel')
                        return;
                    }

            } else {
                isgold_deposit = 0;

            }

              $('body').addClass("wait");
              $(this).attr('disabled', true).text("Processing");
              var el=$(this);
              if($('#txtcashreceive').val()!='' && $('#txtcashreceive').val()!='0'){
                cashreceive=$('#txtcashreceive').val() + ' ' + $('#lblcashin option:selected').text();
                cashreturn=$('#txtcashreturn').val();
              }
              let ck_water = $('#ckwater').is(':checked');
              var m1 = $('#lblbuy').attr('title').split(";");
              var m2 = $('#lblsale').attr('title').split(";");
              var pid = 0;
              var mcur = '';
              var pcur = '';
              var luy = 0;
              var product = 0;
              var mekun = 1;
              var item1 = 0;
              var item2 = 0;
              var rate1b = 0;
              var rate1s = 0;
              var rate2b = 0;
              var rate2s = 0;
              var curid1 = 0;
              var curid2 = 0;
              var pcur1 = '';
              var pcur2 = '';
              var buy='0';
              var sale='0';
              var curbuy='';
              var cursale='';
              var receipt2='0';
              var url = "{{ route('saveexchange') }}";

              if ($('#txtsign').val() == '+') {
                  mekun = 1;
                  buy=$('#txtbuy').val();
                  sale=$('#txtsale').val();
                  curbuy=$('#lblbuy option:selected').text();
                  cursale=$('#lblsale option:selected').text();

              } else {
                  mekun = -1;
                  buy=$('#txtsale').val();
                  sale=$('#txtbuy').val();
                  curbuy=$('#lblsale option:selected').text();
                  cursale=$('#lblbuy option:selected').text();

              }
              if (m1[4] == '1') {
                  mcur = m1[6];
                  pid = m2[0];
                  pcur = m2[6];
                  luy = mekun * $('#txtbuy').val().replace(/,/g, '');
                  product = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
              } else if (m2[4] == '1') {
                  mcur = m2[6];
                  pid = m1[0];
                  pcur = m1[6];
                  product = mekun * $('#txtbuy').val().replace(/,/g, '');
                  luy = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
              } else {
                  receipt2='1';
                  item1 = $('#txtbuy').val();
                  item2 = $('#txtsale').val();
                  rate1b = m1[1];
                  rate1s = m1[2];
                  rate2b = m2[1];
                  rate2s = m2[2];
                  curid1 = m1[0];
                  curid2 = m2[0];
                  pcur1 = m1[6];
                  pcur2 = m2[6];
                  url = "{{ route('saveexchangeproduct') }}"
              }
              //debugger
              var today = new Date();
              // var d = $('#exchangedate').val().split("-");
              // var Dd = moment(new Date(d[2] + '-' + d[1] + '-' + d[0])).format("YYYY-MMM-DD")
              var time = ("0" + today.getHours()).slice(-2) + ":" + ("0" + today.getMinutes()).slice(-2) + ":" + ("0" + today.getSeconds()).slice(-2);
              var dd=$('#invdate').val();
              //var formdata = new FormData(frmbankpayment);
              var formdata = new FormData(frmpartnerlist);
              var table = document.getElementById("tbl_partnerlist");
              var totalRowCount = table.rows.length;
              var tbodyRowCount = table.tBodies[0].rows.length;
              var foundpartnerlist=0;
              if(tbodyRowCount>0){
                foundpartnerlist=1;
              }
              formdata.append('watergold',watergold);
              formdata.append('ck_water',ck_water==true?1:0);
              formdata.append("foundpartnerlist",foundpartnerlist);
              formdata.append("currency_id", pid);
              formdata.append("status", status);

              formdata.append("pcur", pcur);
              formdata.append("amount", luy);
              formdata.append("maincur", mcur);
              formdata.append("product", product);
              formdata.append("rate", $('#txtrate').val());
              formdata.append("drate", $('#lblrate').attr('title'));

              formdata.append("dd", dd);
              formdata.append("tt", time);
              formdata.append("cashreceive",cashreceive);
              formdata.append("cashreturn", cashreturn);
              formdata.append('desr',$('#txtdesr').val());
              formdata.append("exsign", $('#txtsign').val());
              formdata.append("item1", item1);
              formdata.append("item2", item2);
              formdata.append("rate1buy", rate1b);
              formdata.append("rate1sale", rate1s);
              formdata.append("rate2buy", rate2b);
              formdata.append("rate2sale", rate2s);
              formdata.append("curid1", curid1);
              formdata.append("curid2", curid2);
              formdata.append("pcur1", pcur1);
              formdata.append("pcur2", pcur2);
              formdata.append("buy",buy);
              formdata.append("sale", sale);
              formdata.append("curbuy", curbuy);
              formdata.append("cursale", cursale);

                formdata.append("isgold_deposit", isgold_deposit);
              if(isgold_deposit==1){
                formdata.append('selcustomergold',$('#selcustomergold').val());
                formdata.append('txtdeposit',$('#txtdeposit').val());
                formdata.append('selcurdeposit',$('#selcurdeposit').val());
                formdata.append('txtdeposit1',$('#txtdeposit1').val());
                formdata.append('selcurdeposit1',$('#selcurdeposit1').val());
                formdata.append('selbankdeposit',$('#selbankdeposit').val());
                formdata.append('client_name',$('#client_name').val());
                formdata.append('client_tel',$('#client_tel').val());
                formdata.append("luy_id", $('#lblsale').val());
                customertype = $('#selbankdeposit').find(':selected').attr('customertype');
                formdata.append("customertype_deposit",customertype);
                formdata.append("bank_amount",bank_amount);
                formdata.append("cash_amount",cash_amount);
                formdata.append('deposit_via',$('#selbankdeposit option:selected').text());
              }
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
                        if(receipt2==1){
                          if(btnid=='btnsaveprint' || btnid=='btnsavepartnerlistprint' || btnid=='btnsavedepositprint' || btnid=='btnprint_test'){
                              prints(data.id,0,isgold_deposit,status);
                          }
                        }else{
                            if(btnid=='btnsaveprint' || btnid=='btnsavepartnerlistprint' || btnid=='btnsavedepositprint' || btnid=='btnprint_test'){
                                prints(data.id,0,isgold_deposit,status);
                            }
                        }
                        toastr.success("Save exchange Successfully");
                        if(btnid!=='btnprint_test'){
                            //RefreshForm();
                            refreshexchangelist();
                            resetform();
                            //getusercapital_master($('#loginid').val(),$('#invdate').val());
                            getuseraccount_master(1,1,$('#loginid').val());
                        }
                        $(el).removeAttr('disabled').html(buttontext);
                        $('body').removeClass("wait");

                         $('#txtbuy').focus();
                     }else{
                        $('body').removeClass("wait");
                        $(el).removeAttr('disabled').html(buttontext);
                        alert(data.error)
                     }

                  },
                  error: function () {
                      $(el).removeAttr('disabled').html(buttontext);
                      $('body').removeClass("wait");
                      alert('Save Error.')
                  }

              })
          }catch{
            $(el).removeAttr('disabled').html(buttontext);
            $('body').removeClass("wait");
          }

      })

      $(document).on('click','#curcur',function(e){
        e.preventDefault();
        var id12=$('#curcur').attr('title');
        var arr_id=id12.split('-');
        var id1=arr_id[0];
        var id2=arr_id[1];
        $('#lblbuy').val(id2);
        $('#lblbuy').trigger('change');
        $('#lblsale').val(id1);
        $('#lblsale').trigger('change');
      })

      $(document).on('click','#btnshow',function(e){
        e.preventDefault();
        $('#tblexchangelist').show();
        $('#tblratedisplay').hide();
        refreshexchangelist();
      })
      $(document).on('change','#filteruser',function(e){
        e.preventDefault();
        refreshexchangelist();
      })
      function refreshexchangelist(){
            $('body').addClass("wait");
            var isinputdate = document.getElementById("ckinputdate").checked;
            var userid=$('#filteruser').val();
            var status=1;
            var d1=$('#invdate').val();
            var d2=$('#invdate').val();
            var url="{{ route('getexchangelist') }}";

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {userid:userid,d1:d1,d2:d2,status:status,location:1,isinputdate:isinputdate},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#bodyexchangelist').empty().html(data);
                        $('body').removeClass("wait");
                         $("#tblexchangelist").focus();
                         $("#tblexchangelist tr:last").css("background-color", "pink");
                        $('#tblexchangelist tr:last td:nth-child(4) input').focus();
                        if (!isAdmin) {
                            if (!userPerms.has('3.1.3')) {
                                $('.btndel').hide();
                            }
                            if (!userPerms.has('3.1.4')) {
                                $('.btnprint').hide();
                            }
                        }
                    }else{
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Error.')
                }
            })
        }
  })


  //-------------------------------------------//
  function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
  function getcurrencybykey(key,el)
  {
      var url="{{ route('getcurrencybykey') }}";
      $.get(url,{key:key},function(data){
          if(data['c']!=null){
              $(el).val(data['c']['shortcut']);
              $(el).attr('title', data['c']['id'] + ';' + parseFloat(data['c']['ratebuy']) + ';' + parseFloat(data['c']['ratesale']) + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
              getrate();
          }
      })
  }
  function getcurrencybykey1(key,el)
      {
          var url="{{ route('getcurrencybykey') }}";
          $.get(url,{key:key},function(data){
              console.log(data)
                  if(data['c']!=null){
                      $(el).val(data['c']['id']);
                      //$(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                  }
          })
      }
    function getcurrencybykeylocalstorage1(key,el)
  {
    //debugger;
    var currencylist;
    if(localStorage.getItem("currencylist")==null){
      currencylist=[];
    }else{
      currencylist=JSON.parse(localStorage.getItem("currencylist"));
    }
    currencylist.forEach(function(c){
      //debugger;
      if(c.skey==key){
        $(el).val(c.id);
        // $(el).attr('title', c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
        // getrate();
      }
    })
  }
  function getcurrencybykeylocalstorage(key,el,imgel)
  {
    var currencylist;
    if(localStorage.getItem("currencylist")==null){
      currencylist=[];
    }else{
      currencylist=JSON.parse(localStorage.getItem("currencylist"));
    }
    currencylist.forEach(function(c){
      //debugger;
      if(c.skey==key){
        //$(el).val(c.shortcut);
        $(el).val(c.id);
        $(el).attr('title', c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut + ';' + c.isgold + ';' + c.tuochek);
        $(imgel).attr('src','{{ config('helper.asset_path') }}/myimages/' + c.imgpath);
        $(imgel).attr('title',c.khname);
        fillcurcur();
        getrate();

      }
    })
  }

  function getcurrencybyidlocalstorage(id,el,imgel)
  {

    var currencylist;
    if(localStorage.getItem("currencylist")==null){
      currencylist=[];
    }else{
      currencylist=JSON.parse(localStorage.getItem("currencylist"));
    }
    currencylist.forEach(function(c){
      //debugger;
      if(c.id==id){
        //$(el).val(c.shortcut);
        $(el).val(c.id);
        $(el).attr('title', c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
        $(imgel).attr('src','{{ config('helper.asset_path') }}/myimages/' + c.imgpath);
        $(imgel).attr('title',c.khname);
        fillcurcur();
        getrate();
      }
    })
  }

  function resetform()
  {
    $('#btnsave').css('display','inline');
    $('#btnsaveprint').css('display','inline');
    $("#tbl_bankpayment tr").remove();
    $('#divbankpayment').css('display','none');
    $('#hasbankpayment').val(0);
    $('#divpartnerlist').css('display','none');
    $('#haspartnerlist').val(0);
    $('#divfrmpartnerlist').css('display','none');
    $('#divgolddeposit').css('display','none');
    $('#txtdeposit').val('');
    $('#txtdeposit1').val('');
    $('#client_name').val('');
    $('#client_tel').val('');
    $('#rowexchangelist').css('display','block');
    $('#body_partnerlist').empty();
    $('#divr2').css('display','none');
    $('#txtbuy').val('');
    $('#txtsale').val('');
    $('#txtrate').val($('#lblrate').attr('title'));
    $('#txtcashreceive').val('');
    $('#txtcashreturn').val('');
    $('#txtdesr').val('');
    $('#selcurlist').attr('title','');
    //$('btnviewmoney').css('display','none');
    $('#div_viewmoney').css('display','none');
    $('#divcashin').css('display','none');
    $('#divcashout').css('display','none');

  }
  function RefreshForm()
  {
    resetform();
    $('#frmexchange').trigger('reset');
    $('#lblbuy').attr('title','');
    $('#lblsale').attr('title','');
    $('#txtrate').attr('title','');
    $('#curcur').text('CUR1-CUR2');
    $('#txtsign').css('color','blue');
    $('#txtbuy').css('color','blue');
    $('#lblbuy').css('color','blue');
    $('#txtsale').css('color','red');
    $('#txtsign1').css('color','red');
    $('#lblsale').css('color','red');
    $('#imgbuy').attr('src','');
    $('#imgsale').attr('src','');
    $('#txtbuy').focus();
    $('#invdate').datetimepicker({
        timepicker:false,
        datepicker:true,
        value:new Date(),
        format:'d-m-Y',
        autoclose:true,
        todayBtn:true,
        startDate:new Date(),
    });
  }
  function runproductrate()
  {
    var buycur = $('#lblbuy option:selected').text();
    var salecur = $('#lblsale option:selected').text();
    var curname = '';
    if ($('#txtsign').val() == '+') {
        curname = buycur + '-' + salecur;
    } else {
        curname = salecur + '-' + buycur;
    }
    var currencylist;
    if(localStorage.getItem("currencyproductlist")==null){
      currencylist=[];
    }else{
      currencylist=JSON.parse(localStorage.getItem("currencyproductlist"));
    }
    $('#txtrate').val('');
    $('#txtrate').attr('title','');
    currencylist.forEach(function(c){
      //debugger;
      if(c.pshortcut==curname){
        $('#txtrate').val(parseFloat(c.rate));
        $('#txtrate').attr('title', c.pshortcut + ';' +  c.rate + ';' +  c.operator);
        calcuexchangeproduct();
      }
    })
    $('#lblrate').attr('title',$('#txtrate').val());
    dolabelcico();
  }
//   function runproductrate()
//   {
//           var url="{{ route('getproductrate') }}";
//           var buycur = $('#lblbuy option:selected').text();
//           var salecur = $('#lblsale option:selected').text();
//           var curname = '';
//           if ($('#txtsign').val() == '+') {
//               curname = buycur + '-' + salecur;
//           } else {
//               curname = salecur + '-' + buycur;
//           }
//           $.get(url,{curname:curname},function(data){
//               if(data.success){

//                   $('#txtrate').val(formatNumber(parseFloat(data['pr']['rate'])));
//                   $('#txtrate').attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
//                   calcuexchangeproduct();
//               }else{
//                   $('#txtrate').val('');
//                   $('#txtrate').attr('title','');
//               }
//               console.log(data)

//           })

//           $('#lblrate').attr('title',$('#txtrate').val());
//           dolabelcico();
//       }

  function getrate() {
        try{
            //debugger;
            $('.watergold').css('display','none');
            $('#txtrate').attr('title', '');
            var m = $('#lblbuy').attr('title').split(";");
            var p = $('#lblsale').attr('title').split(";");
            var haveexchangegold="{{ config('helper.haveexchangegold') }}";
            if(haveexchangegold==1){
                if(m[7]==1 && m[8]>1){
                    $('.watergold').css('display','table-row');
                }else if(p[7]==1 && p[8]>1){
                    $('.watergold').css('display','table-row');
                }
                $('#txtgoldwater').val(100);
            }
            if(m=='' || p==''){
                //alert('can not save')
                return;
            }
            //check if the save curname

            if (m[6] == p[6]) {
                $('#txtrate').val(1);
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
            if ($('#txtsign').val() == '+') {
                if (m[4] == '1') {//if maincur=true
                    $('#txtrate').val(parseFloat(p[2]));//get rate p sale

                } else {
                    $('#txtrate').val(parseFloat(m[1]));//get rate m buy
                }

            } else {
                if (m[4] == '1') {
                    $('#txtrate').val(parseFloat(p[1]));
                } else {
                    $('#txtrate').val(parseFloat(m[2]));
                }

            }
            $('#lblrate').attr('title',$('#txtrate').val());
            calcuexchange();
            dolabelcico();
        }catch{

        }

      }
      function dolabelcico() {

          if ($('#txtsign').val() == '+') {
              $('#lblcashin').val($('#lblbuy').val());
          } else {
              $('#lblcashin').val($('#lblsale').val());
          }
      }
      function calcuexchangeproduct() {
          //debugger;
          var luy = $('#txtbuy').val().replace(/,/g, '');
          var r = $('#txtrate').val().replace(/,/g, '');
          var rs = $('#txtrate').attr('title').split(";");
           var cur=$('#lblsale option:selected').text();
          if ($('#txtsign').val() == '+') {
              if (rs[2] == '*') {
                  $('#txtsale').val(weEarnsale(parseFloat(luy * r).toFixed(2),cur));
              } else {
                  $('#txtsale').val(weEarnsale(parseFloat(luy / r).toFixed(2),cur));
              }
          } else {
              if (rs[2] == '*') {
                  $('#txtsale').val(weEarnsale(parseFloat(luy / r).toFixed(2),cur));
              } else {
                  $('#txtsale').val(weEarnsale(parseFloat(luy * r).toFixed(2),cur));
              }
          }
      }
      function calcuexchangeproduct1() {
          //debugger;
          var luy = $('#txtsale').val().replace(/,/g, '');
          var r = $('#txtrate').val().replace(/,/g, '');
          var rs = $('#txtrate').attr('title').split(";");
           var cur=$('#lblbuy option:selected').text();
          if ($('#txtsign').val() == '+') {
              if (rs[2] == '*') {
                  $('#txtbuy').val(weEarnbuy(parseFloat(luy / r).toFixed(2),cur));
              } else {
                  $('#txtbuy').val(weEarnbuy(parseFloat(luy * r).toFixed(2),cur));
              }
          } else {
              if (rs[2] == '*') {
                  $('#txtbuy').val(weEarnbuy(parseFloat(luy * r).toFixed(2),cur));
              } else {
                  $('#txtbuy').val(weEarnbuy(parseFloat(luy / r).toFixed(2),cur));
              }
          }
      }
      function weEarnsale(amount,cur)
      {
        //debugger;
        var sign1=$('#txtsign1').val();
        if(sign1=='+'){
            if(cur=='KHR'){
                famt = Math.ceil(amount / 100) * 100;
            }else if(cur=='THB'){
                famt = Math.ceil(amount);
            }else{
                famt=amount;
            }
        }else{
            if(cur=='KHR'){
                famt = Math.floor(amount / 100) * 100;
            }else if(cur=='THB'){
                famt = Math.floor(amount);
            }else{
                famt=amount;
            }
        }

         return formatNumber(famt);
      }
    function weEarnbuy(amount,cur)
      {
        //debugger;
       var sign=$('#txtsign').val();
        if(sign=='+'){
            if(cur=='KHR'){
                famt = Math.ceil(amount / 100) * 100;
            }else if(cur=='THB'){
                famt = Math.ceil(amount);
            }else{
                famt=amount;
            }
        }else{
            if(cur=='KHR'){
                famt = Math.floor(amount / 100) * 100;
            }else if(cur=='THB'){
                famt = Math.floor(amount);
            }else{
                famt=amount;
            }
        }
        return formatNumber(famt);
      }
      function calcuexchange() {

        $('#txtcashreceive').val('');
        $('#txtcashreturn').val('');
        var cur=$('#lblsale option:selected').text();

          var luy = $('#txtbuy').val().replace(/,/g, '');
          var r = $('#txtrate').val().replace(/,/g, '');
          var buy = $('#lblbuy').attr('title').split(";");
          var sale = $('#lblsale').attr('title').split(";");
          if (buy[4] == '1') { //if maincur=true
              if (sale[3] == '/') {//if operator=/
                  $('#txtsale').val(weEarnsale(parseFloat(luy * r).toFixed(2),cur));
              } else {//មាសប្រើសញ្ញា គុណ
                if(sale[7]=='1' && sale[8]>1){
                        let watergold=$('#txtgoldwater').val();
                        watergold=watergold ? watergold : 1 ;
                        $('#txtsale').val(weEarnsale(parseFloat((luy * sale[8]) / (r * watergold)).toFixed(2),cur));
                    }else{
                        $('#txtsale').val(weEarnsale(parseFloat(luy / r).toFixed(2),cur));

                    }
              }
          } else {
              if (sale[4] == '1') {
                if (buy[3] == '/') {
                    $('#txtsale').val(weEarnsale(parseFloat(luy / r).toFixed(2),cur));
                } else {
                    if(buy[7]=='1' && buy[8]>1){
                        let watergold=$('#txtgoldwater').val();
                        watergold=watergold ? watergold : 1 ;

                        $('#txtsale').val(weEarnsale(parseFloat(luy * r * watergold / buy[8]).toFixed(2),cur));
                    }else{
                        $('#txtsale').val(weEarnsale(parseFloat(luy * r).toFixed(2),cur));

                    }
                }
              } else {
                calcuexchangeproduct();
              }
          }
      }
      function calcuexchange1() {
           //debugger
          $('#txtcashreceive').val('');
          $('#txtcashreturn').val('');
          var cur=$('#lblbuy option:selected').text();

          var luy = $('#txtsale').val().replace(/,/g, '');
          var r = $('#txtrate').val().replace(/,/g, '');
          var sale = $('#lblsale').attr('title').split(";");
          var buy = $('#lblbuy').attr('title').split(";");
          if (sale[4] == '1') { //if maincur=true

              if (buy[3] == '/') {//if operator=/
                  $('#txtbuy').val(weEarnbuy(parseFloat(luy * r).toFixed(2),cur));
              } else {// មាស ប្រើតែសញ្ញាគុណ
                if(buy[7]=='1' && buy[8]>1){
                        let watergold=$('#txtgoldwater').val();
                        watergold=watergold ? watergold : 1 ;
                        $('#txtbuy').val(weEarnbuy(parseFloat((luy * buy[8]) / (watergold * r)).toFixed(2),cur));
                    }else{

                        $('#txtbuy').val(weEarnbuy(parseFloat(luy / r).toFixed(2),cur));
                    }
              }
          } else {
              if (buy[4] == '1') {
                  if (sale[3] == '/') {
                      $('#txtbuy').val(weEarnbuy(parseFloat(luy / r).toFixed(2),cur));
                  } else {
                    if(sale[7]=='1' && sale[8]>1){
                        let watergold=$('#txtgoldwater').val();
                        watergold=watergold ? watergold : 1 ;
                        $('#txtbuy').val(weEarnbuy(parseFloat(luy * watergold * r / sale[8]).toFixed(2),cur));
                    }else{
                        $('#txtbuy').val(weEarnbuy(parseFloat(luy * r).toFixed(2),cur));
                    }
                  }
              } else {
                  calcuexchangeproduct1();
              }
          }
      }

      function docashin() {
          if ($('#txtsign').val() == '+') {
              var luy = parseFloat($('#txtbuy').val().replace(/,/g, ''));
              var cashreturn='';
              var cashin = parseFloat($('#txtcashreceive').val().replace(/,/g, ''));
              if(isNaN(cashin)){
                  cashreturn = $('#txtsale').val()+ ' ' + $('#lblsale option:selected').text();
              }else{
                  cashreturn=formatNumber(parseFloat(cashin - luy)) + ' ' + $('#lblbuy option:selected').text();
                  if(cashin-luy==0){
                      cashreturn =$('#txtsale').val() + ' ' + $('#lblsale option:selected').text();
                  }else{
                      cashreturn +="\n" + $('#txtsale').val() + ' ' + $('#lblsale option:selected').text();
                  }
              }
              $('#txtcashreturn').val(cashreturn);

          } else {
              var luy = parseFloat($('#txtsale').val().replace(/,/g, ''));
              var cashin = parseFloat($('#txtcashreceive').val().replace(/,/g, ''));
              //$('#txtcashreturn').val(formatNumber(parseFloat(cashin - luy)));

              if(isNaN(cashin)){
                  cashreturn = $('#txtbuy').val() + ' ' + $('#lblbuy option:selected').text();
              }else{
                  cashreturn=formatNumber(parseFloat(cashin - luy)) + ' ' + $('#lblsale option:selected').text();
                  if(cashin-luy==0){
                      cashreturn =$('#txtbuy').val() + ' ' + $('#lblbuy option:selected').text();
                  }else{
                      cashreturn +="\n" + $('#txtbuy').val() + ' ' + $('#lblbuy option:selected').text();
                  }
              }
              $('#txtcashreturn').val(cashreturn);

          }
      }
      function getmultiexchangelist(){
          var url="{{ route('getmultiexchangelist') }}";
          $.get(url,{},function(data){
              $('#tblexchangemultiple').empty().html(data);
          })
      }

      function print(id){
          var htp=window.location.protocol;
          var htn=window.location.hostname;
          var redirectWindow = window.open('{{ url('/') }}'+'/exchange/print?id='+id, '_blank');
          redirectWindow.location;
      }

      function fillcurcur()
      {
        var curbuy='';
        var cursale='';
        var idbuy='';
        var idsale='';
        if($('#txtsign').val()=='+'){
            // curbuy=$('#lblbuy option:selected').text();
            // cursale=$('#lblsale option:selected').text();
            curbuy=$('#imgbuy').attr('title');
            cursale=$('#imgsale').attr('title');
            idbuy=$('#lblbuy').val();
            idsale=$('#lblsale').val();
        }else{
            // curbuy=$('#lblsale option:selected').text();
            // cursale=$('#lblbuy option:selected').text();
            curbuy=$('#imgsale').attr('title');
            cursale=$('#imgbuy').attr('title');
            idbuy=$('#lblsale').val();
            idsale=$('#lblbuy').val();
        }
        $('#curcur').text(curbuy + '-' + cursale);
        $('#curcur').attr('title',idbuy + '-' + idsale);
      }
</script>
