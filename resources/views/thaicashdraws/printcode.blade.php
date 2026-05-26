@extends('master')
@section('title') Print Code @endsection
@section('css')
    <style type="text/css">

        .kh12{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            }
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            }
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
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
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            font-weight:bold;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;

            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh30-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }

    .ui-autocomplete {
        position: fixed;
        z-index: 1511;
        font-size:22px;
    }
    .ui-autocomplete-input{
      border: none;
      margin-bottom: 5px;
      border:1px solid #c8c6c6 !important;
      z-index:1511;
    }

    #tbl1 .clickedrow td{
        background-color:blue;
        color:white;
       }

    .divbg{
        background-color:rgb(206, 241, 124);

       }

        .tbl1 td.title{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
        }
        .tbl1 td.value{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
        }
        .tbl1 td.value1{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            font-weight:bold;
        }
        .tbl1 td{
            border-style:none;
            padding:0px 5px 0px 5px;
            text-align:left;
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
    <div class="row" style="margin-top:-20px;margin-bottom:10px;">
        <div class="col-lg-12">
                <table>
                    <tr>
                        @if($ready==1)
                            @if($mission_complete==0)
                                <td><button class="btn btn-info kh16-b" id="btnready">រួចរាល់</button></td>
                            @endif
                        @else
                            <td class="kh22-b" style="color:blueviolet">មិនទាន់បានលេខកូតអស់</td>
                        @endif
                    </tr>
                </table>

        </div>
    </div>
    <form action="" id="frmprintcode">
        <input type="hidden" id="txtid" value="{{ $process_id }}">
        <input type="hidden" id="txtgroupid" value="{{ $groupid }}">
        <input type="hidden" id="transferid3" name="transferid3" value="{{ $transferid3 }}">
        <input type="hidden" id="thaicurid3" name="thaicurid3" value="{{ $thaicurid3 }}">
        <input type="hidden" id="thaiamt3" name="thaiamt3" value="{{ $thaiamt3 }}">
        <input type="hidden" id="exchangeamount3" name="exchangeamount3" value="{{ $exchangeamount3 }}">
        <input type="hidden" id="thaicur3" name="thaicur3" value="{{ $thaicur3 }}">
        <input type="hidden" id="exchangecur3" name="exchangecur3" value="{{ $exchangecur3 }}">
        <input type="hidden" id="exchangerate3" name="exchangerate3" value="{{ $exchangerate3 }}">
        <input type="hidden" id="exchangerateinfo3" name="exchangerateinfo3" value="{{ $exchangerateinfo3 }}">
        <input type="hidden" id="exchangebuyinfo3" name="exchangebuyinfo3" value="{{ $exchangebuyinfo3 }}">
        <input type="hidden" id="exchangesaleinfo3" name="exchangesaleinfo3" value="{{ $exchangesaleinfo3 }}">
    </form>


    <div class="row">
        <div class="col-lg-12">
            @foreach ($c1 as $item)
                <button style="padding:0px;">
                    <div class="card divcard" style="width:300px;padding:10px;margin:0px;">
                        @if($item['customertype']=='BANK')
                            <div class="row">
                                <div class="col-lg-4">
                                    <table>
                                        <tr>
                                            <td style="width:60px;padding:5px;">
                                                {{-- <img src="{{ $item['logo']<>''?asset('public/logo/' . $item['logo']):'' }}" alt="" style="width:60px;height:60px;"> --}}
                                                @if(!empty($item['logo']))
                                                    <img src="{{ asset(config('helper.asset_path').'/logo/'.$item['logo']) }}"
                                                        alt="wing bank"
                                                        style="width:60px;">
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-8">
                                    <table  class="tbl1" style="margin:0px;padding:0px;">
                                        <tr>

                                            <td  class="kh18" style="padding:0px;">ផ្ទេរប្រាក់ទៅ </td>
                                        </tr>
                                        <tr>
                                            <td  class="kh18-b" style="padding:0px;">
                                                {{ $item['recname'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="kh22-b" style="padding:0px;color:brown">
                                                {{ $item['amount'] }}
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table  class="table tbl1" style="margin:0px;padding:0px;">
                                        <tr>
                                            <td class="kh16-b">ផ្ទេរប្រាក់ពី</td>
                                            <td class="kh16-b">:</td>
                                            <td class="kh16-b" style="">
                                                {{ $item['accname'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b">លេខគណនី</td>
                                            <td class="kh16-b">:</td>
                                            <td class="kh16-b" style="">
                                                {{ $item['accnum'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b" style="">ទឹកប្រាក់កាត់ចេញ</td>
                                            <td class="kh16-b">:</td>
                                            <td class="value1" style="color:red;">-{{ $item['amount'] }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan=3><hr></td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b">អ្នកទទួលប្រាក់</td>
                                            <td class="kh16-b">:</td>
                                            <td class="value" style="">{{ $item['recname'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b">លេខគណនី</td>
                                            <td class="kh16-b">:</td>
                                            <td class="value" style="">{{ $item['rectel'] }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan=3>
                                                <hr>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b">លេខយោង</td>
                                            <td class="kh16-b">:</td>
                                            <td class="value" style="">{{ sprintf('%08d',$item['tranid'])}}</td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b">កាលបរិច្ឆេទ</td>
                                            <td class="kh16-b">:</td>
                                            <td class="value" style="">{{ date('d-m-Y',strtotime($wingdate)) }}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        @else
                            <table id="" class="table tbl1" style="margin:0px;padding:0px;">
                                <tr>
                                    <td class="title">បើកនៅ <span class="kh22-b">{{ $item['ptype'] }}</span></td>
                                    <td class="kh22-b" style="text-align:right;">
                                        @if(!empty($item['logo']))
                                            <img src="{{ asset(config('helper.asset_path').'/logo/'.$item['logo']) }}"
                                                alt="wing bank"
                                                style="width:100px;">
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title" style="padding-top:2px;">ចំនួនទឹកប្រាក់</td>
                                    <td class="value1" style="text-align:right;color:red;">{{ $item['amount'] }}</td>
                                </tr>

                                <tr>
                                    <td class="title" style="padding-top:2px;">លេខកូតបើកប្រាក់</td>
                                    <td class="value1" style="text-align:right;color:brown;">{{ $item['code'] }}</td>
                                </tr>
                                <tr>
                                    <td class="title">លេខអ្នកទទួល</td>
                                    <td class="value" style="text-align:right;">{{ $item['rectel'] }}</td>
                                </tr>
                                <tr>
                                    <td colspan=2><hr></td>
                                </tr>
                                <tr>
                                    <td class="kh16-b">លេខយោង</td>
                                    <td class="value" style="text-align:right;">{{ sprintf('%08d',$item['tranid'])}}</td>
                                </tr>
                                <tr>
                                    <td class="title">កាលបរិច្ឆេទ</td>
                                    <td class="value" style="text-align:right;">{{ date('d-m-Y',strtotime($wingdate)) }}</td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </button>
            @endforeach

        </div>

    </div>




@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('ផ្ញើកូតអោយអតិថិជន');
        $(document).ready(function () {


         $(document).on('click','.divcard',function(e){
            //debugger;
            $('.divcard').removeClass('divbg');
            $(this).addClass('divbg');

         })
         $('body').click(function(){
            //console.log('cliked')
            $('.divcard').removeClass('divbg');
        });
        $(document).on('click','#btnready',function(e) {
            var q = confirm("Do you want to complete this transaction?");
            if (!q) return;
            var formdata=new FormData(frmprintcode);
            var url="{{ route('thaicashdraw1.updatetransferready') }}";
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
                        var newItem = "printcodepage " + new Date().toLocaleString();
                        addItemToStorage(newItem);
                        // sendMessage();
                        // window.close();
                        // $('body').removeClass("wait");
                        sendMessage().then(() => {
                            window.close();
                            $('body').removeClass("wait");
                        }).catch(err => {
                            console.error('Send message error:', err);
                            $('body').removeClass("wait");
                        });
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


        // async function sendMessage() {

        //     var ably = new Ably.Realtime('ij19Fw.YrH3Cg:H-ZTKXRF_d8UvWh7bwfd_cXfpTGvpu1_3TltUpz55cA'); //remember to pass your ably API key
        //     var channel = ably.channels.get('chatting'); // here i create a channel or initialize the existing channel
        //     var message ='transaction send code to customer complete'; //get the message from input
        //     var name = 'thaidocode'; //get the sender name from input
        //     var sender = "{{ Auth::user()->name }}";
        //     var customername="{{ config('helper.transfer_option') }}";
        //     if (message !== '') { //if input message is not empty publish a message
        //         // Publish the message to the chat channel
        //         channel.publish('messageEvent', { name: name, text: message, sender: sender,customername:customername });
        //     }
        // }

        async function sendMessage() {
            var ably = new Ably.Realtime('ij19Fw.YrH3Cg:H-ZTKXRF_d8UvWh7bwfd_cXfpTGvpu1_3TltUpz55cA'); // Use your API key
            var channel = ably.channels.get('chatting');

            var message = 'transaction send code to customer complete';
            var name = 'thaidocode';
            var sender = "{{ Auth::user()->name }}";
            var customername = "{{ config('helper.transfer_option') }}";

            return new Promise((resolve, reject) => {
                ably.connection.once('connected', function () {
                    channel.publish('messageEvent', { name, text: message, sender, customername }, function (err) {
                        if (err) {
                            console.error('Failed to send message:', err);
                            reject(err);
                        } else {
                            console.log('Message sent successfully');
                            resolve();
                        }
                    });
                });

                ably.connection.on('failed', function (err) {
                    console.error('Ably connection failed:', err);
                    reject(err);
                });
            });
        }


        //  $(document).on('click','#btnready',function(e){

        //     var step=2;
        //     var mscp=1;
        //     var id=$('#txtid').val();
        //     var groupid=$('#txtgroupid').val();
        //     var url="{{ route('thaicashdraw.updatestep') }}";



        //     Swal.fire({
        //             title: 'តើលោកអ្នកពិតជាចង់បញ្ចប់ការងារមួយនេះមែនឬ?',
        //             text: "Do you want to finish this task?",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Yes, Confirm it!'
        //             }).then((result) => {
        //             if (result.isConfirmed) {
        //                 $.ajax({
        //                     async: true,
        //                     type: 'GET',
        //                     dataType:'JSON',
        //                     contentType: 'application/json;charset=utf-8',
        //                     url: url,
        //                     data:{step:step,mscp:mscp,id:id,groupid:groupid},
        //                     success: function (data) {
        //                         console.log(data);
        //                         if (data.success === true) {

        //                             Swal.fire(
        //                                 'Ready!',
        //                                 data.message,
        //                                 'success'
        //                             )
        //                             window.close();
        //                         } else {
        //                             Swal.fire(
        //                                 'Error!',
        //                                 data.message,
        //                                 'error'
        //                             )
        //                         }
        //                     },
        //                     error: function () {
        //                         Swal.fire(
        //                             'Error!',
        //                             'Delete Error.',
        //                             'Error'
        //                         )
        //                     }

        //                 })

        //             }
        //         })


        //  })

        })
        function addItemToStorage(item) {
            // Add the new item to localStorage
            var items = JSON.parse(localStorage.getItem("items")) || [];
            items.push(item);
            localStorage.setItem("pageprintcode", JSON.stringify(items));
            // Trigger an event to notify Page B
            localStorage.setItem("pageprintcode1", "true");
        }

    </script>
@endsection
