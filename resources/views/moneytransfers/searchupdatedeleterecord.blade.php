
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
  $i=0;
@endphp

    @foreach ($data as $key => $item)
        @php
            $i+=1;
        @endphp
        @foreach ($item as $n => $d)
            <tr style="background-color: {{ $i % 2 == 1 ? 'rgb(245, 243, 241)' : 'azure' }}">
            <td style="text-align:center;@if($d->status==0) background-color:red;color:white; @endif">{{ $i }}</td>
            <td>
                <a href="#group{{ $key }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $key }}</a>
            </td>
            <td>{{ date('d-m-Y',strtotime($d->dd)) }}</td>
                <td>{{ $d->tt }}</td>
                <td>{{ $d->user->name }}</td>
                <td>{{ $d->tranname }}</td>
                <td>
                    @if($d->child)
                        {{ $d->partner->name }} <br> {{ 'បន្តទៅ' . $d->child }}
                    @else
                        {{ $d->partner->name }}
                    @endif
                </td>

                <td class="kh18" style="text-align:right;">
                    {{ phpformatnumber($d->amount)  . $d->currency->sk }}
                </td>
                <td class="kh18" style="text-align:right;">
                    {{ phpformatnumber($d->cuscharge) . $d->cuschargecur->sk }}
                </td>
                <td class="kh18" style="text-align:right;">
                    {{ phpformatnumber($d->fee) . $d->feecurrency->sk }}
                </td>
                <td>
                    @php
                        $info1='';
                        $info2='';
                        if($d->recname){
                            $info1='អ្នកទទួល:' . $d->recname;
                        }
                        if($d->rectel){
                            if($info1==''){
                                $info1='អ្នកទទួល' . $d->rectel;
                            }else{
                                $info1=$info1 . ' ' . $d->rectel;
                            }
                        }
                        if($d->sendername){
                            $info2='អ្នកផ្ញើ:' . $d->sendername;
                        }
                        if($d->sendertel){
                            if($info2==''){
                                $info2='អ្នកផ្ញើ' . $d->sendertel;
                            }else{
                                $info2=$info2 . ' ' . $d->sendertel;
                            }
                        }
                    @endphp

                {{ $info1 }} <br> {{ $info2 }}
                </td>
                <td>{{ $d->note }}</td>
                <td></td>
                <td>{{ date('d-m-Y H:i:s',strtotime($d->updated_at)) }}</td>
            </tr>

        @endforeach
        @if($seltran==2)
            @php

                $countdata=0;
                $datarefs=App\PartnerTransfer::showByIdAndGroup($key);
            @endphp


            @foreach ($datarefs ?? [] as $trf)
                    @php
                    $info1='';
                    $info2='';
                    if($trf->recname){
                        $info1='អ្នកទទួល:' . $trf->recname;
                    }
                    if($d->rectel){
                        if($info1==''){
                            $info1='អ្នកទទួល' . $trf->rectel;
                        }else{
                            $info1=$info1 . ' ' . $trf->rectel;
                        }
                    }
                    if($trf->sendername){
                        $info2='អ្នកផ្ញើ:' . $trf->sendername;
                    }
                    if($trf->sendertel){
                        if($info2==''){
                            $info2='អ្នកផ្ញើ' . $trf->sendertel;
                        }else{
                            $info2=$info2 . ' ' . $trf->sendertel;
                        }
                    }
                @endphp
                <tr id="group{{ $key }}" class="collapse show kh16" style="background-color: {{ $i % 2 == 1 ? 'rgb(245, 243, 241)' : 'azure' }}">
                    <td style="text-align:center;@if($trf->status==0) background-color:red;color:white; @endif">{{ $i }}</td>
                    <td>{{ sprintf("%04d",$trf->id) }}</td>
                    <td>
                        {{ date('d-m-Y',strtotime($trf->dd)) }}
                    </td>
                        <td>
                        {{ $trf->tt }}
                    </td>
                    <td>{{ $trf->user->name }}</td>
                    <td>{{ $trf->tranname . '(' . $trf->trancode . ')'}}</td>
                    <td>{{ $trf->partner->name }}</td>
                    <td style="text-align:right;font-size:18px;">{{ phpformatnumber($trf->amount) . $trf->currency->sk }}</td>
                    <td style="text-align:right;font-size:18px;">{{ phpformatnumber($trf->cuscharge) . $trf->cuschargecur->sk }}</td>
                    <td style="text-align:right;font-size:18px;">
                        @if($trf->fee && $trf->fee<>0)
                        {{ phpformatnumber($trf->fee) . $trf->feecurrency->sk }}
                        @endif
                        @if($trf->interest && $trf->interest<>0)
                        {{ phpformatnumber($trf->interest) . $trf->currency->sk }}
                        @endif
                    </td>
                    <td> {{ $info1 }} <br> {{ $info2 }}</td>
                    <td>{{ $trf->note }}</td>
                    <td style="@if($trf->status==0) color:red; @endif">{{ $trf->status==0?$trf->userdelete->name:'' }}</td>
                        <td>{{ date('d-m-Y H:i:s',strtotime($trf->updated_at)) }}</td>
                </tr>
            @endforeach
        @endif


    @endforeach
