@extends('master')
@section('title') Check Group ID @endsection
@section('css')
    <style type="text/css">
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

        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }

       .table .clickedrow td{
        background-color: #caaf8f;
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
    <div class="row" style="margin-bottom:20px;">
        <div class="col-lg-8">
          <h1 class="kh22" style="font-size:36px;">Transaction Group: {{ $groupid }}</h1>
        </div>
        <div class="col-lg-4">
            @if($showdelbtn==true)
                @if (Auth::user()->role->name<>'Admin')
                    @if (App\User::checkpermission(Auth::id(),'4.1.2'))
                    <a href="#" class="btn btn-danger btn-lg delete" data-groupid={{ $groupid }}>Delete Transacton Group</a>
                    @endif
                @else
                    <a href="#" class="btn btn-danger btn-lg delete" data-groupid={{ $groupid }}>Delete Transacton Group</a>
                @endif
          @endif
        </div>
    </div>

    <div class="row">
      <table class="table">
            @if($exchanges->count()>0)
                <tr>
                    <td style="border-style:none;">
                    <h1>Exchanges</h1>
                    <table class="table table-bordered kh16-b">
                        <thead style="text-align:center;">
                            <th>ID</th>
                            <th>ថ្ងៃទី</th>
                            <th>អ្នកកត់ត្រា</th>
                            <th>ទិញ</th>
                            <th>លក់</th>
                            <th>អត្រា</th>
                            <th>ទឹកមាស</th>
                            <th>ផ្សេងៗ</th>
                            <th>GroupID</th>
                        </thead>
                        <tbody>
                            {{-- @foreach ($exchangemultis as $key => $item)
                            <tr class="kh16" style="text-align:center;">
                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                <td>
                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                <td>{{ phpformatnumber($item->rate)}}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->ref_group_id }}</td>

                            </tr>
                            @endforeach --}}
                            @foreach ($exchanges as $key => $item)
                            <tr class="kh16" style="text-align:center;">
                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                <td>
                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td style="text-align:right;">{{ $item->product>0?phpformatnumber(abs($item->product)) . ' ' . $item->pcur:phpformatnumber(abs($item->amount)) . ' ' . $item->maincur }}</td>
                                <td style="text-align:right;">{{ $item->amount<0?phpformatnumber(abs($item->amount)) . ' ' . $item->maincur:phpformatnumber(abs($item->product)) . ' ' . $item->pcur }}</td>
                                <td>{{ phpformatnumber($item->rate)}}</td>
                                <td>{{ phpformatnumber($item->goldwater)}}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->ref_group_id }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </td>
                </tr>
            @endif
             @if($exchangemultis->count()>0)
                <tr>
                    <td style="border-style:none;">
                    <h1>ExchangeDetail</h1>
                    <table class="table table-bordered kh16-b">
                        <thead style="text-align:center;">
                            <th>ID</th>
                            <th>ថ្ងៃទី</th>
                            <th>អ្នកកត់ត្រា</th>
                            <th>ទិញ</th>
                            <th>លក់</th>
                            <th>អត្រា</th>
                            <th>ទឹកមាស</th>

                            <th>ផ្សេងៗ</th>
                            <th>GroupID</th>
                        </thead>
                        <tbody>

                            @foreach ($exchangemultis as $key => $item)
                            <tr class="kh16" style="text-align:center;">
                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                <td>
                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td style="text-align:right;color:blue;">+{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                <td style="text-align:right;color:red;">-{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                <td>{{ phpformatnumber($item->rate)}}</td>
                                <td>{{ phpformatnumber($item->goldwater)}}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->ref_group_id }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </td>
                </tr>
            @endif
            @if($transfers->count()>0)
                <tr>
                    <td style="border-style:none;">
                    <h1>Transfers</h1>
                    <table class="table table-bordered kh16-b">
                        <thead style="text-align:center;">
                            <th>TID</th>
                            <th>ថ្ងៃទី</th>
                            <th>អ្នកកត់ត្រា</th>
                            <th>បុគ្គលិកពាក់ព័ន្ធ</th>
                            <th>ដៃគូ</th>
                            <th>ប្រតិបត្តិការណ៏</th>
                            <th>សរុបទឹកប្រាក់</th>
                            <th>សេវ៉ាដៃគូ</th>
                            <th>សេវ៉ាអតិថិជន</th>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>ផ្សេងៗ</th>
                            <th>GroupID</th>

                        </thead>
                        <tbody>
                            @foreach ($transfers as $key=> $item)
                            <tr class="kh16" style="text-align:center;">
                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                <td>
                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                </td>
                                <td>{{ $item->user->name }}</td>
                                 <td>{{ $item->useraffect->name }}</td>
                                <td>{{ $item->partner->name }}</td>
                                <td title="trancode">{{ $item->tranname . '(' . $item->trancode . ')' }}</td>
                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                <td>{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}</td>
                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->ref_group_id }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </td>
                </tr>
            @endif
            @if($cashdraws->count()>0)
                <tr>
                    <td style="border-style:none;">
                    <h1>Cashdraw</h1>
                    <table class="table table-bordered kh16-b">
                        <thead style="text-align:center;">
                            <th>TID</th>
                            <th>ថ្ងៃបើក</th>
                            <th>អ្នកកត់ត្រា</th>
                            <th>ដៃគូ</th>
                            <th>ប្រតិបត្តិការណ៏</th>
                            <th>ចំនួនទឹកប្រាក់</th>
                            <th>កាត់សេវ៉ា</th>
                            <th>អ្នកទទួលប្រាក់</th>
                            <th>ផ្សេងៗ</th>
                            <th>GroupID</th>
                        </thead>
                        <tbody>
                            @foreach ($cashdraws as $key=> $item)
                            <tr class="kh16" style="text-align:center;">
                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                <td>
                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->frompartner->name }}</td>
                                <td>បើកវេរ</td>
                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->cuschargecur->shortcut }}</td>

                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->ref_group_id }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </td>
                </tr>
            @endif
            @if($smsprocess->count()>0)
                <tr>
                    <td style="border-style:none;">
                    <h1>Thai Cashdraw</h1>
                    <table class="table table-bordered kh16-b">
                        <thead style="text-align:center;">
                            <th>TID</th>
                            <th>SMS ID</th>
                            <th>SMS CODE</th>
                            <th>អ្នកកត់ត្រា</th>
                            <th>ថ្ងៃបើក</th>
                            <th>ចំនួនទឹកប្រាក់</th>
                            <th>អ្នកទទួល</th>
                            <th>ប្រភេទទូទាត់</th>
                            <th>ផ្សេងៗ</th>
                            <th>GroupID</th>
                        </thead>
                        <tbody>
                            @foreach ($smsprocess as $key=> $item)
                            <tr class="kh16" style="text-align:center;">
                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                <td>{{ $item->sms_id }}</td>
                                <td>{{ $item->sms_code }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                </td>
                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                <td>{{ $item->paymethod }}</td>

                                <td>{{ $item->note }}</td>
                                <td>{{ $item->group_id }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </td>
                </tr>
            @endif
      </table>

    </div>


@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('លុបក្រុមប្រតិបត្តិការណ៏');
        $(document).ready(function () {

            $(document).on('click','.table td',function(e){
              // Remove previous highlight class
              $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
              // add highlight to the parent tr of the clicked td
              $(this).parent('tr').addClass("clickedrow");
          })
          $(document).on('click','.delete',function(e){
              e.preventDefault();
              var groupid=$(this).data('groupid');
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
                            url: "{{ route('usercapital.deletetransactiongroup') }}",
                            data: { groupid:groupid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();

                                    // Swal.fire(
                                    //     'Deleted!',
                                    //     data.message,
                                    //     'success'
                                    // )
                                    window.close();
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
    </script>
@endsection
