$(document).ready(function () {
  $('#selcustomer').select2();
  $('#selcustomer1').select2();
  $('#seluser').select2();
  $(document).on('click','#tbl_exchange_list td',function(e){
       // Remove previous highlight class
       $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
      // add highlight to the parent tr of the clicked td
      $(this).parent('tr').addClass("clickedrow");
   })
   $(document).on('click','#tbl1 td',function(e){
       // Remove previous highlight class
       $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
      // add highlight to the parent tr of the clicked td
      $(this).parent('tr').addClass("clickedrow");
   })
   $(document).on('click','#tbl2 td',function(e){
       // Remove previous highlight class
       $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
      // add highlight to the parent tr of the clicked td
      $(this).parent('tr').addClass("clickedrow");
   })
   var cleave = new Cleave('#txtbuy', {
      numeral: true,
      numeralPositiveOnly: true,
      numeralThousandsGroupStyle: 'thousand'
  });
  var cleave = new Cleave('#txtsale', {
      numeral: true,
      numeralPositiveOnly: true,
      numeralThousandsGroupStyle: 'thousand'
  });
  var cleave = new Cleave('#txtrate', {
      numeral: true,
      numeralDecimalScale: 6,
      numeralThousandsGroupStyle: 'thousand'
  });
  var today=new Date();
      $('#dt1,#dt2','#exchangedate').datetimepicker({
          timepicker:false,
          datepicker:true,
          value:today,
          format:'d-m-Y',
          autoclose:true,
          todayBtn:true,
          startDate:today,

      });
  //exchangelist report
      $(document).on('click','#btnkatkong',function(e){
        e.preventDefault();
        $('#exchangelistmodal').modal('show');
      })

  //end exchangelist report


  $(document).on('change','#seltype1',function(e){
      e.preventDefault();
      var type=$(this).val();
      getpartner(type,'#selcustomer1');
  })
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
                          text:item.name
                      }))
                  //console.log(item)
              });

          })
      }

  $(document).on('click','#btnsearch',function(e){
      e.preventDefault()
      showexchangelist();
  })

  function showexchangelist()
  {
      var d1=$('#dt1').val();
      var d2=$('#dt2').val();
      var partner=$('#selcustomer').val();
      var user=$('#seluser').val();
      var url="{{ route('exchangelist.show') }}";
      $.get(url,{d1:d1,d2:d2,partner:partner,user:user},function(data){
          //console.log(data);
          $('#bodyexchangelist').empty().html(data);
      })
  }

  $(document).on('click','.btndelete',function(e){
          e.preventDefault();
          var katkongid=$(this).data('id');


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
                      url: "{{ route('exchangelist.delete') }}",
                      data: { id:katkongid },
                      success: function (data) {
                          console.log(data);
                          if (data.success === true) {
                              showexchangelist();
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


})
