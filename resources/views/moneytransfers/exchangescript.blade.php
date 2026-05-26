<script>
    var cleave = new Cleave('#txtbuy', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
     function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    function getcurrencybykey1(key,el)
        {
            var url="{{ route('getcurrencybykey') }}";
            $.get(url,{key:key},function(data){
                //console.log(data)
                    if(data['c']!=null){
                        $(el).val(data['c']['id']);
                        //$(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                    }
            })
        }
    function getcurrencybykey(key,el)
    {
        // var url="{{ route('getcurrencybykey') }}";
        // $.get(url,{key:key},function(data){
        //         if(data['c']!=null){
        //             $(el).val(data['c']['shortcut']);
        //             $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
        //             getrate();
        //         }
        // })

        var currencylist;
        if(localStorage.getItem("currencylist")==null){
            currencylist=[];
        }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
        }
        for (let i = 0; i < currencylist.length; i++) {
            if(currencylist[i].skey==key){
                $(el).val(currencylist[i].shortcut);
                $(el).attr('title', currencylist[i].id + ';' + currencylist[i].ratebuy + ';' + currencylist[i].ratesale + ';' + currencylist[i].optsign + ';' + currencylist[i].ismain + ';' + currencylist[i].isfn + ';' + currencylist[i].shortcut);
                getrate();
                return;
            }
        }
    }
    function getcurrencybyshortcut_old(key,el)
    {
        var url="{{ route('getcurrencybyshortcut') }}";
        $.get(url,{key:key},function(data){
             //console.log(data)

                if(data['c']!=null){

                    $(el).val(data['c']['shortcut']);
                    $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                    getrate();
                }
        })
    }
    function getcurrencybyshortcut(key,el)
    {
        var currencylist;
        if(localStorage.getItem("currencylist")==null){
            currencylist=[];
        }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
        }
        currencylist.forEach(function(c){
            //debugger;
            if(c.shortcut==key){
                $(el).val(c.shortcut);
                //$(el).val(c.id);
                $(el).attr('title', c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
                getrate();
            }
        })
    }
    function getcurrencybyid(key,el)
    {
        // var url="{{ route('getcurrencybyid') }}";
        // $.get(url,{key:key},function(data){
        //     if(data['c']!=null){

        //         $(el).val(data['c']['shortcut']);
        //         $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
        //         getrate();
        //     }
        // })
         var currencylist;
        if(localStorage.getItem("currencylist")==null){
            currencylist=[];
        }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
        }
        for (let i = 0; i < currencylist.length; i++) {
            if(currencylist[i].id==key){
                $(el).val(currencylist[i].shortcut);
                $(el).attr('title', currencylist[i].id + ';' + currencylist[i].ratebuy + ';' + currencylist[i].ratesale + ';' + currencylist[i].optsign + ';' + currencylist[i].ismain + ';' + currencylist[i].isfn + ';' + currencylist[i].shortcut);
                return;
            }
        }
    }
    function runproductrate_old() {
            //debugger
            var url="{{ route('getproductrate') }}";
            var buycur = $('#lblbuy').val();
            var salecur = $('#lblsale').val();
            var curname = '';
            if ($('#txtsign').val() == '+') {
                curname = buycur + '-' + salecur;
            } else {
                curname = salecur + '-' + buycur;
            }
            //alert(curname)
            $.get(url,{curname:curname},function(data){
                if(data.success){

                    $('#txtrate').val(formatNumber(parseFloat(data['pr']['rate'])));
                    $('#txtrate').attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                    calcuexchangeproduct();
                }else{
                    $('#txtrate').val('');
                    $('#txtrate').attr('title','');
                }
                console.log(data)

            })

            $('#lblrate').attr('title',$('#txtrate').val());
            dolabelcico();
        }
     function runproductrate()
  {
    var buycur = $('#lblbuy').val();
    var salecur = $('#lblsale').val();
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
    function getrate() {
            //debugger;
            $('#txtrate').attr('title', '');
            try{
                var m = $('#lblbuy').attr('title').split(";");
                var p = $('#lblsale').attr('title').split(";");
            }catch{
                return;
            }
            if(m=='' || p==''){
                //alert('can not save')
                return;
            }
            //check if the save curname
            //debugger
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
                    $('#txtrate').val(formatNumber(parseFloat(p[2])));//get rate p sale
                } else {
                    $('#txtrate').val(formatNumber(parseFloat(m[1])));//get rate m buy
                }

            } else {
                if (m[4] == '1') {
                    $('#txtrate').val(formatNumber(parseFloat(p[1])));
                } else {
                    $('#txtrate').val(formatNumber(parseFloat(m[2])));
                }

            }

            $('#lblrate').attr('title',$('#txtrate').val());
            calcuexchange();
            dolabelcico();
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
            if ($('#txtsign').val() == '+') {
                if (rs[2] == '*') {
                    $('#txtsale').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (rs[2] == '*') {
                    $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $('#txtsale').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }
            }
        }
        function calcuexchange() {
             //debugger
            $('#txtcashreceive').val('');
            $('#txtcashreturn').val('');


            var luy = $('#txtbuy').val().replace(/,/g, '');
            var r = $('#txtrate').val().replace(/,/g, '');
            var m1 = $('#lblbuy').attr('title').split(";");
            var m2 = $('#lblsale').attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    $('#txtsale').val(formatNumber(luy * r));
                } else {
                    $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $('#txtsale').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    } else {
                        $('#txtsale').val(formatNumber(luy * r));
                    }
                } else {
                    calcuexchangeproduct();
                }
            }
        }

        function docashin() {
            if ($('#txtsign').val() == '+') {
                var luy = parseFloat($('#txtbuy').val().replace(/,/g, ''));
                var cashreturn='';
                var cashin = parseFloat($('#txtcashreceive').val().replace(/,/g, ''));
                if(isNaN(cashin)){
                    cashreturn = $('#txtsale').val() + $('#lblsale').val();
                }else{
                    cashreturn=formatNumber(parseFloat(cashin - luy)) + $('#lblbuy').val();
                    if(cashin-luy==0){
                        cashreturn =$('#txtsale').val() + $('#lblsale').val();
                    }else{
                        cashreturn +="\n" + $('#txtsale').val() + $('#lblsale').val();
                    }
                }
                $('#txtcashreturn').val(cashreturn);

            } else {
                var luy = parseFloat($('#txtsale').val().replace(/,/g, ''));
                var cashin = parseFloat($('#txtcashreceive').val().replace(/,/g, ''));
                //$('#txtcashreturn').val(formatNumber(parseFloat(cashin - luy)));

                if(isNaN(cashin)){
                    cashreturn = $('#txtbuy').val() + $('#lblbuy').val();
                }else{
                    cashreturn=formatNumber(parseFloat(cashin - luy)) + $('#lblsale').val();
                    if(cashin-luy==0){
                        cashreturn =$('#txtbuy').val() + $('#lblbuy').val();
                    }else{
                        cashreturn +="\n" + $('#txtbuy').val() + $('#lblbuy').val();
                    }
                }
                $('#txtcashreturn').val(cashreturn);

            }
        }
        function getmultiexchangelist(){
            var url="{{ route('getmultiexchangelist') }}";
            $.get(url,{},function(data){
                $('#multiexchangecard').empty().html(data);
            })
        }
        $(document).on('click','#btnaddlist',function(e){
            e.preventDefault();
            disablebutton($(this).attr('id'));
            $('#divexchangelist').css('display','block');
            var formdata = new FormData;
            if($('#txtsign').val()=='+'){
                formdata.append("buy",$('#txtbuy').val());
                formdata.append("curbuy",$('#lblbuy').val());
                formdata.append("sale",$('#txtsale').val());
                formdata.append("cursale",$('#lblsale').val());
                formdata.append("buyinfo",$('#lblbuy').attr('title'));
                formdata.append("saleinfo",$('#lblsale').attr('title'));

            }else{
                formdata.append("buy",$('#txtsale').val());
                formdata.append("curbuy",$('#lblsale').val());
                formdata.append("sale",$('#txtbuy').val());
                formdata.append("cursale",$('#lblbuy').val());
                formdata.append("buyinfo",$('#lblsale').attr('title'));
                formdata.append("saleinfo",$('#lblbuy').attr('title'));
            }
            formdata.append("rateinfo",$('#txtrate').attr('title'));
            formdata.append('rate',$('#txtrate').val());
            formdata.append('drate',$('#lblrate').attr('title'));
            formdata.append('dd',$('#invdate').val());

            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: "{{ route('saveaddlist') }}",
                data: formdata,
                success: function (data) {
                    $('#hasexchange').val(2);
                   //console.log(data)
                   //$('#frmexchange').trigger('reset');
                    //$('#lblbuy').attr('title','');
                    $('#lblsale').attr('title','');
                    $('#lblrate').attr('title','');
                    $('#txtrate').attr('title','');
                    $('#txtbuy').val('');
                    $('#txtsale').val('');
                    $('#txtrate').val('');
                    //$('#lblbuy').val('');
                    $('#lblsale').val('');

                    $('#txtbuy').focus();
                    getmultiexchangelist();
                    sumamtexchangelist();
                },
                error: function () {
                    alert('Save Error.')
                }

            })
            window.scrollTo(0, document.body.scrollHeight);
        })
        function sumamtexchangelist(){
            //debugger;
            var amtbuy=0;
            var amtleft=0;
            var amt=$('#amount').val().replace(/,/g,'');
            var curbuy=$('#lblbuy').val();
            $('.txtbuys').each(function(i,e){
                    if($('.txtcurbuys').eq(i).val()==curbuy){
                        amtbuy +=parseFloat($('.txtbuys').eq(i).val().replace(/,/g,''));
                    }
                })

            amtleft=parseFloat(amt)-parseFloat(amtbuy);
            $('#txtbuy').val(formatNumber(amtleft));
            $('#txtrate').focus();
        }
        $(document).on('click','.btndelmxlist',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            var url="{{ route('delete_multiexchangelist') }}";
            $.post(url,{id:id},function(data){
                console.log(data)
                if(data.success){
                    getmultiexchangelist();
                    sumamtexchangelist();
                }else{
                    alert(data.error)
                }
            })
        })
        $('#btnclearlist').click(function(e){
            e.preventDefault();
            var q = confirm("Do you want to clear list?");
                if (q) {
                    var url="{{ route('clearexchangelist') }}";
                   $.post(url,{},function(data){
                    getmultiexchangelist();
                    sumamtexchangelist();
                   })
                }
        })
        function visiblebutton()
        {
            $('#btncontinue').css('display','inline');
            $('#btncontinue1').css('display','inline');
            $('#btncontinue2').css('display','inline');

            $('#btnexchange').css('display','inline');
            $('#btnsavecashdraw').css('display','inline');
            $('#btnsavecashdrawprint').css('display','inline');
            $('#btnsavecashdraw1').css('display','inline');
            $('#btnsavecashdrawprint1').css('display','inline');
            $('#btnsavecashdraw2').css('display','inline');
            $('#btnsavecashdrawprint2').css('display','inline');
        }
        function disablebutton(sender)
        {
            visiblebutton();
            if(sender=='btnexchange'){
                var hascontinue=$('#hascontinue').val();
                if(hascontinue==1){
                    $('#btnsavecashdraw1').css('display','none');
                    $('#btnsavecashdrawprint1').css('display','none');
                    $('#btncontinue1').css('display','none');
                }
                $('#btnsavecashdraw').css('display','none');
                $('#btnsavecashdrawprint').css('display','none');
                $('#btnexchange').css('display','none');
                $('#btncontinue').css('display','none');
            }else if(sender=='btncontinue' || sender=='btncontinue1' || sender=='btncontinue2'){
                $('#btnsavecashdraw').css('display','none');
                $('#btnsavecashdrawprint').css('display','none');
                $('#btnsavecashdraw1').css('display','none');
                $('#btnsavecashdrawprint1').css('display','none');
                $('#btnsavecashdraw2').css('display','none');
                $('#btnsavecashdrawprint2').css('display','none');
                var hasexchange=$('#hasexchange').val();
                if(hasexchange!=0){
                    $('#btnexchange').css('display','none');
                }
                $('#btncontinue').css('display','none');
                $('#btncontinue1').css('display','none');
                $('#btncontinue2').css('display','none');
            }else if(sender=='btnaddlist'){
                var hascontinue=$('#hascontinue').val();
                if(hascontinue==1){
                    $('#btnsavecashdraw2').css('display','none');
                    $('#btnsavecashdrawprint2').css('display','none');
                    $('#btncontinue2').css('display','none');
                }
                $('#btnsavecashdraw').css('display','none');
                $('#btnsavecashdrawprint').css('display','none');
                $('#btnsavecashdraw1').css('display','none');
                $('#btnsavecashdrawprint1').css('display','none');
                $('#btnexchange').css('display','none');
                $('#btncontinue').css('display','none');
                $('#btncontinue1').css('display','none');
            }
        }
        function buttonclose(sender)
        {
            if(sender=='btnclosedivexchangecard'){
                var hascontinue=$('#hascontinue').val();
                if(hascontinue==1){
                    $('#btnexchange').css('display','inline');
                }else{
                    $('#btnsavecashdraw').css('display','inline');
                    $('#btnsavecashdrawprint').css('display','inline');
                    $('#btncontinue').css('display','inline');
                    $('#btnexchange').css('display','inline');
                }
            }else if(sender=='btnclosedivexchangelist'){
                var hascontinue=$('#hascontinue').val();
                if(hascontinue==1){

                }else{
                    $('#btnsavecashdraw1').css('display','inline');
                    $('#btnsavecashdrawprint1').css('display','inline');
                    $('#btncontinue1').css('display','inline');
                }

            }else if(sender=='btnclosedivcontinue'){
                var hasexchange=$('#hasexchange').val();
                if(hasexchange==0){
                    $('#btnsavecashdraw').css('display','inline');
                    $('#btnsavecashdrawprint').css('display','inline');
                    $('#btnexchange').css('display','inline');
                    $('#btncontinue').css('display','inline');

                }else if(hasexchange==1){
                    $('#btnsavecashdraw1').css('display','inline');
                    $('#btnsavecashdrawprint1').css('display','inline');
                    $('#btncontinue1').css('display','inline');
                }else if(hasexchange==2){
                    $('#btnsavecashdraw2').css('display','inline');
                    $('#btnsavecashdrawprint2').css('display','inline');
                    $('#btncontinue2').css('display','inline');
                }
            }
        }
</script>
