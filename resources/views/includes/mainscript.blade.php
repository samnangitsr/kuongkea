<script type="text/javascript">
        function getusercapital_master(userid,showdate){
            $('body').addClass("wait");
            var dd=moment(showdate).format("DD-MM-YYYY")
            var url="{{ route('usercapital.getusercapitalmaster') }}";
            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#div_tbl_mycapital').empty().html(data);
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


            //   $.get(url,{userid:userid,showdate:dd},function(data){
            //     //console.log(data)
            //     $('#div_tbl_mycapital').empty().html(data);
            //   })
        }

      function savecurrencytostorage(){
        $('body').addClass("wait");
        localStorage.removeItem("currencylist");
        var url="{{ route('savecurrencytostorage') }}";

        $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        var currencylist;
                        if(localStorage.getItem("currencylist")==null){
                            currencylist=[];
                        }else{
                            currencylist=JSON.parse(localStorage.getItem("currencylist"));
                        }
                        $.each(data['currencies'],function(i,item){
                            currencylist.push({
                                id:item.id,
                                khname:item.curname,
                                shortcut:item.shortcut,
                                ratebuy: isNaN(parseFloat(item.ratebuy)) ? "0.00" : parseFloat(item.ratebuy).toFixed(item.decpoint),
                                ratesale: isNaN(parseFloat(item.ratesale)) ? "0.00" : parseFloat(item.ratesale).toFixed(item.decpoint),
                                optsign:item.optsign,
                                ismain:item.ismain,
                                isfn:item.isfn,
                                skey:item.skey,
                                imgpath:item.imgpath,
                                buy_thai:item.buy_thai,
                                sale_thai:item.sale_thai,
                                isgold:item.isgold ?? 0,
                                tuochek:item.tuochek ?? 1
                            })
                        });
                        localStorage.setItem("currencylist",JSON.stringify(currencylist));
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

      function savecurrencyproducttostorage(){
        $('body').addClass("wait");
        localStorage.removeItem("currencyproductlist");
        var url="{{ route('savecurrencyproducttostorage') }}";
        $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        var currencyproductlist;
                        if(localStorage.getItem("currencyproductlist")==null){
                            currencyproductlist=[];
                        }else{
                            currencyproductlist=JSON.parse(localStorage.getItem("currencyproductlist"));
                        }
                        $.each(data['productrates'],function(i,item){
                            currencyproductlist.push({
                                id:item.id,
                                pshortcut:item.pshortcut,
                                rate:item.rate,
                                thai_rate:item.thai_rate,
                                operator:item.operator
                            })
                        });
                        localStorage.setItem("currencyproductlist",JSON.stringify(currencyproductlist));
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


        // $.get(url,{},function(data){
        //   //console.log(data);
        //   var currencyproductlist;
        //   if(localStorage.getItem("currencyproductlist")==null){
        //     currencyproductlist=[];
        //   }else{
        //     currencyproductlist=JSON.parse(localStorage.getItem("currencyproductlist"));
        //   }
        //   $.each(data['productrates'],function(i,item){
        //       currencyproductlist.push({
        //         id:item.id,
        //         pshortcut:item.pshortcut,
        //         rate:item.rate,
        //         thai_rate:item.thai_rate,
        //         operator:item.operator
        //       })
        //   });
        //   localStorage.setItem("currencyproductlist",JSON.stringify(currencyproductlist));
        // })
      }
      function savephonetolocalstorage(){
        //alert('do phone localstorage')
        localStorage.removeItem("recphonelist");
        localStorage.removeItem("sendphonelist");
        localStorage.removeItem("sendernamelist");
        localStorage.removeItem("recnamelist");
        localStorage.removeItem("phone_exchange");
        localStorage.removeItem("name_exchange");

        var url="{{ route('phonenumberlocalstorage') }}";
        $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        var recphonelist;
                        var sendphonelist;
                        var recnamelist;
                        var sendernamelist;
                        var phone_exchange;
                        var name_exchange;
                        if(localStorage.getItem("recphonelist")==null){
                            recphonelist=[];
                        }else{
                            recphonelist=JSON.parse(localStorage.getItem("recphonelist"));
                        }
                        if(localStorage.getItem("recnamelist")==null){
                            recnamelist=[];
                        }else{
                            recnamelist=JSON.parse(localStorage.getItem("recnamelist"));
                        }
                        $.each(data['recphonelist'],function(i,item){
                            recphonelist.push({
                                value:item.rectel,
                                label:item.rectel,
                                recname:item.recname,
                            })
                            recnamelist.push({
                                value:item.recname,
                                label:item.recname,
                                rectel:item.rectel,
                            })
                        });

                        localStorage.setItem("recphonelist",JSON.stringify(recphonelist));
                        localStorage.setItem("recnamelist",JSON.stringify(recnamelist));

                        // sender phone
                        if(localStorage.getItem("sendphonelist")==null){
                            sendphonelist=[];
                        }else{
                            sendphonelist=JSON.parse(localStorage.getItem("sendphonelist"));
                        }
                        if(localStorage.getItem("sendernamelist")==null){
                            sendernamelist=[];
                        }else{
                            sendernamelist=JSON.parse(localStorage.getItem("sendernamelist"));
                        }
                        $.each(data['sendphonelist'],function(i,item){
                            sendphonelist.push({
                                value:item.sendertel,
                                label:item.sendertel,
                                sendername:item.sendername,
                            })
                            sendernamelist.push({
                                value:item.sendername,
                                label:item.sendername,
                                sendertel:item.sendertel,
                            })
                        });
                        localStorage.setItem("sendphonelist",JSON.stringify(sendphonelist));
                        localStorage.setItem("sendernamelist",JSON.stringify(sendernamelist));

                        //exchange phone
                         if(localStorage.getItem("phone_exchange")==null){
                            phone_exchange=[];
                        }else{
                            phone_exchange=JSON.parse(localStorage.getItem("phone_exchange"));
                        }
                        if(localStorage.getItem("name_exchange")==null){
                            name_exchange=[];
                        }else{
                            name_exchange=JSON.parse(localStorage.getItem("name_exchange"));
                        }
                        $.each(data['customerexchanges'],function(i,item){
                            phone_exchange.push({
                                value:item.phone,
                                label:item.phone,
                                client:item.client,
                            })
                            name_exchange.push({
                                value:item.client,
                                label:item.client,
                                phone:item.phone,
                            })
                        });

                        localStorage.setItem("phone_exchange",JSON.stringify(phone_exchange));
                        localStorage.setItem("name_exchange",JSON.stringify(name_exchange));

                        $('body').removeClass("wait");
                    }else{
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function (e) {
                    $('body').removeClass("wait");
                    alert(e.message)
                }

            })

    }
      function saveuserpermittolocalstorage(callback){
        $('body').addClass("wait");
        localStorage.removeItem("permusers");
        var url="{{ route('savepermuserstorage') }}";
        $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        var permusers;
                        if(localStorage.getItem("permusers")==null){
                            permusers=[];
                        }else{
                            permusers=JSON.parse(localStorage.getItem("permusers"));
                        }
                        $.each(data['permusers'],function(i,item){
                                permusers.push({
                                id:item.id,
                                userid:item.user_id,
                                code:item.code,
                                pcdt:item.pcdt??0,
                            })
                        });
                        localStorage.setItem("permusers",JSON.stringify(permusers));
                        callback();
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

        // $.get(url,{},function(data){
        //   //console.log(data);
        //   var permusers;
        //   if(localStorage.getItem("permusers")==null){
        //     permusers=[];
        //   }else{
        //     permusers=JSON.parse(localStorage.getItem("permusers"));
        //   }
        //   $.each(data['permusers'],function(i,item){
        //         permusers.push({
        //         id:item.id,
        //         userid:item.user_id,
        //         code:item.code,

        //       })
        //   });
        //   localStorage.setItem("permusers",JSON.stringify(permusers));
        //   callback();
        // })
      }
    function checkpermit()
    {

    var permits;
    if(localStorage.getItem("permusers")==null){
      permits=[];
    }else{
      permits=JSON.parse(localStorage.getItem("permusers"));
    }
    permits.forEach(function(c){
      //debugger;
      $("#code" + c.code.replace(/\W/g, '_')).css('display','block');
    })
  }
</script>
