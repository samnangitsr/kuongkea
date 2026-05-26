<script>

        if(window.location.href.indexOf("address") > -1){
            autocompleteprovince();
        }
        $(document).on('click','#btnsaveprovince',function(e){
            e.preventDefault();
            var url="{{ route('address.saveprovince') }}";
            var id=$('#address_id').val();
            var province=$('#province').val();
            $.post(url,{province:province,id:id},function(data){
                console.log(data)
                if(!data.error){
                    $('#sel_province').append($("<option/>",{
                        value:data.id,
                        text:data.name
                    }))
                    $('#sel_province').val(data.id);
                    $('#sel_province').select2().trigger('change');
                    $('#province').val('');
                    $('#province').focus();
                    autocompleteprovince();
                }
            })
        })
        $(document).on('click','#btnsavedistrict',function(e){
            e.preventDefault();
            var url="{{ route('address.savedistrict') }}";
            var id=$('#address_id').val();
            var province_id=$('#sel_province').val();
            var district=$('#district').val();
            $.post(url,{province_id:province_id,district:district,id:id},function(data){
                console.log(data)
                if(!data.error){
                    $('#sel_district').append($("<option/>",{
                        value:data.id,
                        text:data.name
                    }))
                    $('#sel_district').val(data.id);
                    $('#sel_district').select2().trigger('change');
                    $('#district').val('');
                    $('#district').focus();
                    autocompletedistrict();
                }
            })
        })
        $(document).on('click','#btnsavecommune',function(e){
            e.preventDefault();
            var url="{{ route('address.savecommune') }}";
            var id=$('#address_id').val();
            var province_id=$('#sel_province').val();
            var district_id=$('#sel_district').val();
            var commune=$('#commune').val();
            $.post(url,{province_id:province_id,district_id:district_id,commune:commune,id:id},function(data){
                console.log(data)
                if(!data.error){
                    $('#sel_commune').append($("<option/>",{
                        value:data.id,
                        text:data.name
                    }))
                    $('#sel_commune').val(data.id);
                    $('#sel_commune').select2().trigger('change');
                    $('#commune').val('');
                    $('#commune').focus();
                    autocompletecommune();
                }
            })
        })
        $(document).on('click','#btnsavevillage',function(e){
            e.preventDefault();
            var url="{{ route('address.savevillage') }}";
            var id=$('#address_id').val();
            var province_id=$('#sel_province').val();
            var district_id=$('#sel_district').val();
            var commune_id=$('#sel_commune').val();
            var village=$('#village').val();
            $.post(url,{province_id:province_id,district_id:district_id,commune_id:commune_id,village:village,id:id},function(data){
                console.log(data)
                if(!data.error){
                    $('#sel_village').append($("<option/>",{
                        value:data.id,
                        text:data.name
                    }))
                    $('#sel_village').val(data.id);
                    $('#sel_village').select2().trigger('change');
                    $('#village').val('');
                    $('#village').focus();
                    autocompletevillage();
                }
            })
        })
        function autocompleteprovince(){
            var arr=[];
            var selprovince = document.getElementById('sel_province');
            for(var i=0; i < selprovince.length; i++)
            {
                if(selprovince.options[i].value!==''){
                    let value=selprovince.options[i].value;
                    let text=selprovince.options[i].text;
                    arr.push({value:value,label:text,});
                }
            }
            $( "#province" ).autocomplete({
                source:arr,
                select: function( event, ui ) {
                    $( "#province" ).val( ui.item.label );
                    return false;
                }
            });
        }
        function autocompletedistrict(){
            var arr=[];
            var seldistrict = document.getElementById('sel_district');
            for(var i=0; i < seldistrict.length; i++)
            {
                if(seldistrict.options[i].value!==''){

                    let value=seldistrict.options[i].value;
                    let text=seldistrict.options[i].text;
                    arr.push({value:value,label:text,});
                }
            }
            $( "#district" ).autocomplete({
                source:arr,
                select: function( event, ui ) {
                    $( "#district" ).val( ui.item.label );
                    return false;
                }
            });
        }
        function autocompletecommune(){
            var arr=[];
            var selcommune = document.getElementById('sel_commune');
            for(var i=0; i < selcommune.length; i++)
            {
                if(selcommune.options[i].value!==''){

                    let value=selcommune.options[i].value;
                    let text=selcommune.options[i].text;
                    arr.push({value:value,label:text,});
                }
            }
            $( "#commune" ).autocomplete({
                source:arr,
                select: function( event, ui ) {
                    $( "#commune" ).val( ui.item.label );
                    return false;
                }
            });
        }
        function autocompletevillage(){
            var arr=[];
            var selvillage = document.getElementById('sel_village');
            for(var i=0; i < selvillage.length; i++)
            {
                if(selvillage.options[i].value!==''){

                    let value=selvillage.options[i].value;
                    let text=selvillage.options[i].text;
                    arr.push({value:value,label:text,});
                }
            }
            $( "#village" ).autocomplete({
                source:arr,
                select: function( event, ui ) {
                    $( "#village" ).val( ui.item.label );
                    return false;
                }
            });
        }
        $(document).on('change','#sel_province,#sel_province_search,#sel_province1',function(e){
            e.preventDefault();
            var id=$(this).attr("id");
            if(id=="sel_province"){
                if($('#sel_province').val()=='') return;
                getdistrict($(this).val(),'#sel_district');
            }else if(id=="sel_province_search"){
                getdistrict($(this).val(),'#sel_district_search');
                searchaddress();
            }else if(id=='sel_province1'){
                if($('#sel_province1').val()=='') return;
                getdistrict($(this).val(),'#sel_district1');
            }

        })
        function getdistrict(province_id,el)
        {
            //localStorage.removeItem("district");
            var arr;
            // if(localStorage.getItem("district")==null){
            //     arr=[];
            // }else{
            //     arr=JSON.parse(localStorage.getItem("district"));
            // }
            var url="{{ route('address.getdistrict') }}";
            $(el).empty();
            var arr=[];
            $.get(url,{province_id:province_id},function(data){
                $(el).append($("<option/>",{
                            value:'',
                            text:''
                        }))
                $.each(data,function(i,item){
                    $(el).append($("<option/>",{
                            value:item.id,
                            text:item.name
                        }))
                    //console.log(item)
                    arr.push({value:item.name,label:item.name,});
                });
                //localStorage.setItem("district",JSON.stringify(arr));
                //callback();
                $( "#district" ).autocomplete({source:arr});
            })
        }
        // function autocompletedistrict(){
        //     var sources=JSON.parse(localStorage.getItem("district"));
        //     $( "#district" ).autocomplete({
        //         source:sources,
        //         select: function( event, ui ) {
        //             $( "#district" ).val( ui.item.label );
        //             return false;
        //         }
        //     });

        //  }

        $(document).on('change','#sel_district,#sel_district_search,#sel_district1',function(e){
            e.preventDefault();
            var id=$(this).attr("id");
            if(id=="sel_district"){
                if($('#sel_district').val()=='') return;
                getcommune($(this).val(),'#sel_commune');
            }else if(id=="sel_district_search"){
                getcommune($(this).val(),'#sel_commune_search');
                searchaddress();
            }else if(id=='sel_district1'){
                if($('#sel_district1').val()=='') return;
                getcommune($(this).val(),'#sel_commune1');
            }

        })
        function getcommune(district_id,el)
        {
            var arr=[];
            var url="{{ route('address.getcommune') }}";
            $(el).empty();

            $.get(url,{district_id:district_id},function(data){
                $(el).append($("<option/>",{
                            value:'',
                            text:''
                        }))
                $.each(data,function(i,item){
                    $(el).append($("<option/>",{
                            value:item.id,
                            text:item.name
                        }))
                        arr.push({value:item.name,label:item.name,});
                });

                $( "#commune" ).autocomplete({source:arr});

            })
        }
        $(document).on('change','#sel_commune,#sel_commune_search,#sel_commune1',function(e){

            e.preventDefault();
            var id=$(this).attr('id');
            if(id=='sel_commune'){
                if($('#sel_commune').val()=='') return;
                getvillage($(this).val(),'#sel_village');
            }else if(id=='sel_commune_search'){
                getvillage($(this).val(),'#sel_village_search');
                searchaddress();
            }else if(id=='sel_commune1'){
                if($('#sel_commune1').val()=='') return;
                getvillage($(this).val(),'#sel_village1');
            }
        })
        function getvillage(commune_id,el)
        {
            var arr=[];
            var url="{{ route('address.getvillage') }}";
            $(el).empty();

            $.get(url,{commune_id:commune_id},function(data){
                console.log(data)

                $(el).append($("<option/>",{
                            value:'',
                            text:''
                        }))
                $.each(data,function(i,item){
                    $(el).append($("<option/>",{
                            value:item.id,
                            text:item.name
                        }))
                        arr.push({value:item.name,label:item.name,});
                });
                $( "#village" ).autocomplete({source:arr});
            })
        }
        $(document).on('change','#sel_village_search',function(e){
            e.preventDefault();
            searchaddress();

        })


        function searchaddress()
        {
            var province=$('#sel_province_search').val();
            var district=$('#sel_district_search').val();
            var commune=$('#sel_commune_search').val();
            var village=$('#sel_village_search').val();
            var url="{{ route('address.search') }}"
            $.get(url,{province:province,district:district,commune:commune,village:village},function(data){
                // console.log(data)
                $('#tbl_addresses').empty().html(data);

            })
        }

</script>
