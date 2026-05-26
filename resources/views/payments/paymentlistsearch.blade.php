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
@foreach ($payments as $key => $pm)
                        <tr class="kh22-b" data-bs-toggle="collapse" data-bs-target="#payment-{{ $pm->id }}" style="background-color:rgb(144, 243, 225)">
                            <td style="text-align:center;">{{ ++$key }}</td>
                            <td style="text-align:center;">
                               {{ $pm->id }}
                            </td>
                            <td>
                                {{ date('d-m-Y',strtotime($pm->paiddate)) }}
                            </td>
                            <td>
                                {{ $pm->paidtime }}
                            </td>
                            <td>
                                {{ $pm->user->name }}
                            </td>
                           
                            <td title="{{ $pm->customer_id }}">
                                {{ $pm->customer->name }}
                            </td>
                            <td style="text-align:right;">
                                {{ phpformatnumber($pm->amount) . ' ' . $pm->cur }}
                            </td> 
                            <td>
                                {{ $pm->note }}
                            </td>
                        </tr>
                                <tr id="payment-{{ $pm->id }}" class="collapse show" style="text-align:center;">
                                    <td>No</td>
                                    <td>inv#</td>
                                    <td>InvDate</td>
                                    <td>T.Weight</td>
                                    <td>T.Amount</td>
                                    <td>T.Deposit</td>
                                    <td>Balance</td>
                                    <td>Payment</td>
                                </tr>
                                @foreach ($pm->invoice as $key1 => $pinv)

                                        <tr id="payment-{{ $pm->id }}" class="collapse show" style="">
                                            <td style="text-align:center;">{{ ++$key1 }}</td>
                                            <td style="text-align:center;">
                                                <a href="{{ route('invoice.invoicedetail',['invid'=>$pinv->id]) }}" target="_blank">
                                                    {{ $pinv->id }}
                                                </a>
                                            </td>
                                            <td>{{ date('d-m-Y',strtotime($pinv->invdate)) }}</td>
                                            <td style="text-align:right">{{ phpformatnumber($pinv->totalweight) . ' Li' }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($pinv->total) . ' ' . $pinv->cur }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($pinv->deposit) . ' ' . $pinv->cur }}</td>
                                            <td style="text-align:right;">
                                                {{ phpformatnumber($pinv->total-$pinv->deposit) . ' ' . $pinv->cur }}
                                            </td>
                                            <td style="text-align:right;">{{ phpformatnumber($pinv->pivot['amount']) . ' ' . $pinv->pivot['cur'] }}</td>
                                        </tr>
                                   
                                @endforeach
                        
                        
                    @endforeach