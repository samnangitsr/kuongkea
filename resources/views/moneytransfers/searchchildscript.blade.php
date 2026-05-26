<script>
       //Highlight clicked row
       $(document).on('click','#tblchildren td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         
        
           
            $(document).on('change','#sel_province_search',function(e){
                
                e.preventDefault();
                var id=$(this).attr("id");
                getdistrict($(this).val(),'#sel_district_search');
                searchchild();
               
                
            })
            function getdistrict(province_id,el)
            {
            
                var url="{{ route('address.getdistrict') }}";
                $(el).empty();
                
                $.get(url,{province_id:province_id},function(data){
                    $(el).append($("<option/>",{
                                value:'',
                                text:'ទាំងអស់'
                            }))
                    $.each(data,function(i,item){
                        $(el).append($("<option/>",{
                                value:item.id,
                                text:item.name
                            }))
                        //console.log(item)
                    });
                    
                })
            }
            $(document).on('change','#sel_district_search',function(e){
                e.preventDefault();
                var id=$(this).attr("id");
               
                getcommune($(this).val(),'#sel_commune_search');
                searchchild();
               
                
            })
            function getcommune(district_id,el)
            {
               
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
                        //console.log(item)
                    });
                    
                })
            }
            $(document).on('change','#sel_commune_search',function(e){
                e.preventDefault();
                var id=$(this).attr('id');
                getvillage($(this).val(),'#sel_village_search');
                searchchild();
               
            })
            function getvillage(commune_id,el)
            {
               
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
                        //console.log(item)
                    });
                    
                })
            }
            $(document).on('change','#sel_village_search,#sel_customer_search',function(e){
                e.preventDefault();
                searchchild();
                
            })
            function searchchild()
            {
                var province=$('#sel_province_search').val();
                var district=$('#sel_district_search').val();
                var commune=$('#sel_commune_search').val();
                var village=$('#sel_village_search').val();
                var customer=$('#sel_customer_search').val();
                var url="{{ route('child.search') }}"
                $.get(url,{province:province,district:district,commune:commune,village:village,customer:customer,searchfrom:'transfer'},function(data){
                     //console.log(data)
                    $('#tbl_children').empty().html(data);
                    
                })
            }
</script>