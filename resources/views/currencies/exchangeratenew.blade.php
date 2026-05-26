@extends('master')
@section('title') Exchange Rate New @endsection
@section('css')
    <style type="text/css">
           body.wait *{
			cursor: wait !important;
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
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;

            }
            .kh20{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:20px;
            }
            .kh20-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:20px;
            font-weight:bold;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }

    .circular--landscape { display: inline-block; position: relative; width: 100px; height: 100px; overflow: hidden; border-radius: 50%;background-color:rgb(180, 199, 216);border-style:solid solid solid solid;}
    .circular--landscape-img { width: auto; height: 100%; margin-left: -50px; }
    td.input{
        padding:0px;
    }
    input.inp{
        border-style:none;

    }
    input{
        padding:0px;
    }
    .ratetable td{
        padding:0px;
        border:1px solid black;
    }
    .ratetable tr{
        border:1px solid black;
    }
    </style>
@endsection
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
@section('content')
<div class="row" style="margin-bottom:10px;">
    <div class="col-lg-12">
        <table class="">
            <tr>
                <td style="text-align:right;">
                    <label for="date" class="kh22">កាលបរិច្ឆេទ</label>
                </td>
                <td style="width:250px;">


                        <div class="form-group">

                            <div class="input-group" style="">
                                <input type="text" name="setdate" id="setdate" class="form-control" style="font-size:22px;">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            </div>
                        </div>

                </td>
                <td style="padding-left:20px;">
                    <button type="button" id="btnsetrate" class="btn btn-primary">Save Rate</button>
                </td>


            </tr>
        </table>
    </div>
</div>

@php
    $index=0;
@endphp
<div class="row">
    <form action="" id="frmsetrate">
        <div id="maincol" class="row" style="">
            <div id="divcol1" class="col-lg-4" style="margin-left:0px;">

                    <div class="table-responsive">
                        <table id="curleft" class="table table-bordered kh22 ratetable">
                            <thead class="table-dark kh16" style="text-align:center;">
                                <tr>
                                    <th style="display:none;">index</th>
                                    <th scope="col">No</th>
                                    <th scope="col" style="display:none;">ID</th>
                                    <th scope="col">Currency</th>
                                    <th scope="col" style="display:none;">Short Cut</th>
                                    <th scope="col" style="display:none;">IsP&P</th>
                                    <th scope="col" style="display:none;">Sign</th>
                                    <th scope="col">Buy</th>
                                    <th scope="col">Sale</th>
                                    <th scope="col" style="display:none;">Ratio</th>
                                    <th scope="col" style="display:none;">RateBuy</th>
                                    <th scope="col" style="display:none;">RateSale</th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($curleft as $key => $c1)
                                    @php
                                        $index+=1;
                                    @endphp
                                    <tr>
                                        <td style="display:none;">{{ $index }}</td>
                                        <td style="text-align:center;padding:8px 0px 0px 0px;width:50px;">{{ ++$key }}</td>

                                        <td class="input" style="display:none;">
                                            <input name="curid[]" type="text" class="form-control curid canenter kh22" style="width:80px;" value="{{ $c1->id }}" readonly>
                                        </td>
                                        <td style="text-align:center; @if($c1->shortcut=='KHR-THB' || $c1->shortcut=='THB-KHR' || $c1->shortcut=='KHR-VND' || $c1->shortcut=='VND-KHR') padding:10px 0px 0px 0px; @else padding:0px; @endif">
                                            {{ $c1->curname }} <br> {{ $c1->shortcut }}
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="shortcut[]" type="text" style="width:60px;" class="form-control shortcut canenter kh22" value="{{ $c1->shortcut }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ispandp[]" type="text" style="width:60px;" class="form-control ispandp canenter kh22" value="{{ $c1->ispandp }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="optsign[]" type="text" style="width:60px;" class="form-control optsign canenter kh22" value="{{ $c1->optsign }}" readonly>
                                        </td>
                                        <td class="input" style="text-align:center;padding:10px;">
                                             @if(config('helper.set_rate_pandp_mode') == '1')
                                                @if($c1->shortcut=='KHR-THB')
                                                    <span style="color:red;font-weight:bold;">THB-KHR</span>
                                                @elseif($c1->shortcut=='THB-KHR')
                                                    <span style="color:red;font-weight:bold;">KHR-THB</span>
                                                @elseif($c1->shortcut=='KHR-VND')
                                                    <span style="color:red;font-weight:bold;">VND-KHR</span>
                                                @elseif($c1->shortcut=='VND-KHR')
                                                    <span style="color:red;font-weight:bold;">KHR-VND</span>
                                                @else
                                                    @if(config('helper.isphnompenhrate') == '0')
                                                        <span style="color:red;font-weight:bold;">{{ $c1->shortcut }}-USD</span>
                                                     @endif
                                                @endif
                                             @else
                                                 @if($c1->shortcut=='KHR-THB')
                                                    <span style="color:blue;">KHR-THB</span>
                                                @elseif($c1->shortcut=='THB-KHR')
                                                    <span style="color:blue;">THB-KHR</span>
                                                @elseif($c1->shortcut=='KHR-VND')
                                                    <span style="color:blue;">KHR-VND</span>
                                                @elseif($c1->shortcut=='VND-KHR')
                                                    <span style="color:blue;">VND-KHR</span>
                                                @else
                                                    @if(config('helper.isphnompenhrate') == '0')
                                                        <span style="color:blue;font-weight:bold;">{{ $c1->shortcut }}-USD</span>
                                                     @endif
                                                @endif

                                             @endif
                                            @if($c1->ispandp)
                                                @if(config('helper.set_rate_pandp_mode') == '1')
                                                    <input name="sale[]" type="text" style="text-align:right;padding-left:0px;" class="form-control sale canenter kh22" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->sale) }}">
                                                @else
                                                    <input name="buy[]" type="text" style="text-align:right;padding-left:0px;" class="form-control buy canenter kh22" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->buy) }}">
                                                @endif
                                            @else
                                                <input name="buy[]" type="text" style="text-align:right;padding-left:0px;" class="form-control buy canenter kh22" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->buy) }}">
                                            @endif
                                        </td>
                                        <td class="input" style="text-align:center;padding:10px;">
                                            @if(config('helper.set_rate_pandp_mode') == '1')
                                                @if($c1->shortcut=='KHR-THB')
                                                    <span style="color:blue;font-weight:bold;">KHR-THB</span>
                                                @elseif($c1->shortcut=='THB-KHR')
                                                    <span style="color:blue;font-weight:bold;">THB-KHR</span>
                                                @elseif($c1->shortcut=='KHR-VND')
                                                    <span style="color:blue;font-weight:bold;">KHR-VND</span>
                                                @elseif($c1->shortcut=='VND-KHR')
                                                    <span style="color:blue;font-weight:bold;">VND-KHR</span>
                                                @else
                                                    @if(config('helper.isphnompenhrate') == '0')
                                                        <span style="color:blue;font-weight:bold;">USD-{{ $c1->shortcut }}</span>
                                                     @endif
                                                @endif
                                             @else
                                                @if($c1->shortcut=='KHR-THB')
                                                    <span style="color:red;">THB-KHR</span>
                                                @elseif($c1->shortcut=='THB-KHR')
                                                    <span style="color:red;">KHR-THB</span>
                                                @elseif($c1->shortcut=='KHR-VND')
                                                    <span style="color:red;">VND-KHR</span>
                                                @elseif($c1->shortcut=='VND-KHR')
                                                    <span style="color:red;">KHR-VND</span>
                                                @else
                                                    @if(config('helper.isphnompenhrate') == '0')
                                                        <span style="color:red;font-weight:bold;">USD-{{ $c1->shortcut }}</span>
                                                     @endif
                                                @endif

                                             @endif
                                            @if($c1->ispandp)
                                                @if(config('helper.set_rate_pandp_mode') == '1')
                                                    <input name="buy[]" type="text" style="text-align:right;padding-left:0px;" class="form-control buy canenter kh22" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->buy) }}">
                                                @else
                                                    <input name="sale[]" type="text" style="text-align:right;padding-left:0px;" class="form-control sale canenter kh22" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->sale) }}">
                                                @endif
                                            @else
                                                <input name="sale[]" type="text" style="text-align:right;padding-left:0px;" class="form-control sale canenter kh22" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->sale) }}">
                                            @endif
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ratio[]" style="width:120px;text-align:center;" type="text" class="form-control ratio canenter kh22" value="{{ $c1->ratio }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ratebuy[]" type="text" style="text-align:right;" class="form-control ratebuy canenter kh22" value="{{ phpformatnumber($c1->ratebuy) }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ratesale[]" type="text" style="text-align:right;" class="form-control ratesale canenter kh22" value="{{ phpformatnumber($c1->ratesale) }}" readonly>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            </div>
            <div id="divcol2" class="col-lg-4" style="margin-left:0px;">

                    <div class="table-responsive">
                        <table id="curmiddle" class="table table-bordered kh22 ratetable">
                            <thead class="table-dark kh16" style="text-align:center;">
                                <tr>
                                    <th style="display:none;">index</th>
                                    <th scope="col">No</th>
                                    <th scope="col" style="display:none;">ID</th>
                                    <th scope="col">Currency</th>
                                    <th scope="col" style="display:none;">Short Cut</th>
                                    <th scope="col" style="display:none;">IsP&P</th>
                                    <th scope="col" style="display:none;">Sign</th>
                                    <th scope="col">Buy</th>
                                    <th scope="col">Sale</th>
                                    <th scope="col" style="display:none;">Ratio</th>
                                    <th scope="col" style="display:none;">RateBuy</th>
                                    <th scope="col" style="display:none;">RateSale</th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($curmiddle as $key => $c2)
                                    @php
                                        $index+=1;
                                    @endphp
                                    <tr>
                                        <td style="display:none;">{{ $index }}</td>
                                        <td style="text-align:center;padding:8px 0px 0px 0px;width:50px;">{{ ++$key }}</td>

                                        <td class="input" style="display:none;">
                                            <input name="curid[]" type="text" class="form-control curid canenter kh22" style="width:80px;" value="{{ $c2->id }}" readonly>
                                        </td>
                                        <td style="padding:0px;text-align:center;">
                                            {{ $c2->curname }} <br>{{ $c2->shortcut }}
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="shortcut[]" type="text" style="width:60px;" class="form-control shortcut canenter kh22" value="{{ $c2->shortcut }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ispandp[]" type="text" style="width:60px;" class="form-control ispandp canenter kh22" value="{{ $c2->ispandp }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="optsign[]" type="text" style="width:60px;" class="form-control optsign canenter kh22" value="{{ $c2->optsign }}" readonly>
                                        </td>
                                        <td class="input">
                                            <input name="buy[]" type="text" style="text-align:right;padding-left:0px;" class="form-control buy canenter kh22" value="{{ phpformatnumber($c2->buy) }}">
                                        </td>
                                        <td class="input">
                                            <input name="sale[]" type="text" style="text-align:right;padding-left:0px;" class="form-control sale canenter kh22" value="{{ phpformatnumber($c2->sale) }}">
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ratio[]" style="width:120px;text-align:center;" type="text" class="form-control ratio canenter kh22" value="{{ $c2->ratio }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ratebuy[]" type="text" style="text-align:right;" class="form-control ratebuy canenter kh22" value="{{ phpformatnumber($c2->ratebuy) }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ratesale[]" type="text" style="text-align:right;" class="form-control ratesale canenter kh22" value="{{ phpformatnumber($c2->ratesale) }}" readonly>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            </div>

            <div id="divcol3" class="col-lg-4" style="margin-left:0px;">

                    <div class="table-responsive">
                        <table id="curright" class="table table-bordered kh22 ratetable">
                            <thead class="table-dark kh16" style="text-align:center;">
                                <tr>
                                    <th style="display:none;">index</th>
                                    <th scope="col">No</th>
                                    <th scope="col" style="display:none;">ID</th>
                                    <th scope="col">Currency</th>
                                    <th scope="col" style="display:none;">Short Cut</th>
                                    <th scope="col" style="display:none;">IsP&P</th>
                                    <th scope="col" style="display:none;">Sign</th>
                                    <th scope="col">Buy</th>
                                    <th scope="col">Sale</th>
                                    <th scope="col" style="display:none;">Ratio</th>
                                    <th scope="col" style="display:none;">RateBuy</th>
                                    <th scope="col" style="display:none;">RateSale</th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($curright as $key => $c3)
                                    @php
                                        $index+=1;
                                    @endphp
                                    <tr>
                                        <td style="display:none;">{{ $index }}</td>
                                        <td style="text-align:center;padding:8px 0px 0px 0px;width:50px;">{{ ++$key }}</td>

                                        <td class="input" style="display:none;">
                                            <input name="curid[]" type="text" class="form-control curid canenter kh22" style="width:80px;" value="{{ $c3->id }}" readonly>
                                        </td>
                                        <td style="padding:0px;text-align:center;">
                                            {{ $c3->curname }} <br>{{ $c3->shortcut }}
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="shortcut[]" type="text" style="width:60px;" class="form-control shortcut canenter kh22" value="{{ $c3->shortcut }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ispandp[]" type="text" style="width:60px;" class="form-control ispandp canenter kh22" value="{{ $c3->ispandp }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="optsign[]" type="text" style="width:60px;" class="form-control optsign canenter kh22" value="{{ $c3->optsign }}" readonly>
                                        </td>
                                        <td class="input">
                                            <input name="buy[]" type="text" style="text-align:right;padding-left:0px;" class="form-control buy canenter kh22" value="{{ phpformatnumber($c3->buy) }}">
                                        </td>
                                        <td class="input">
                                            <input name="sale[]" type="text" style="text-align:right;padding-left:0px;" class="form-control sale canenter kh22" value="{{ phpformatnumber($c3->sale) }}">
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ratio[]" style="width:120px;text-align:center;" type="text" class="form-control ratio canenter kh22" value="{{ $c3->ratio }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ratebuy[]" type="text" style="text-align:right;" class="form-control ratebuy canenter kh22" value="{{ phpformatnumber($c3->ratebuy) }}" readonly>
                                        </td>
                                        <td class="input" style="display:none;">
                                            <input name="ratesale[]" type="text" style="text-align:right;" class="form-control ratesale canenter kh22" value="{{ phpformatnumber($c3->ratesale) }}" readonly>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            </div>
        </div>
    </form>

</div>
<div class="row">
    <div class="col-lg-6">
        <form action="" id="frmsetratethai">
            <div id="" class="row" style="margin-top:0px;">
                <table class="table">
                    <tr>
                        <td class="kh22-b" style="border-style:none;color:brown;background-color:aqua;">
                            កំណត់អត្រាលុយថៃ
                        </td>
                        <td style="border-style:none;background-color:aqua;">
                            {{-- <button type="button" id="btnsetratethai" class="btn btn-primary">Save Thai Rate</button> --}}
                        </td>

                    </tr>
                </table>
            </div>
            <div id="" class="row" style="margin-top:-10px;">
                <div class="table-responsive">
                    <table class="table table-bordered kh22 ratetable">
                        <thead class="table-dark kh16" style="text-align:center;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" style="display:none;">ID</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Buy</th>
                                <th scope="col">Sale</th>
                            </tr>
                        </thead>
                        <tbody id="currencylist">

                                @foreach ($thais as $key => $c)
                                    <tr>
                                        <td style="text-align:center;padding-top:8px;width:50px;">{{ ++$key }}</td>

                                        <td class="input" style="display:none;">
                                            <input name="curid1[]" type="text" style="width:60px;" class="form-control curid1 canenter kh16-b" value="{{ $c->id }}" readonly>
                                        </td>
                                        <td class="input">
                                            <input name="curname[]" type="text" style="width:120px;padding-left:0px;padding-right:0px;text-align:center;border-style:none;background-color:inherit;" class="form-control curname canenter kh22" value="{{ $c->curname }}" readonly>
                                        </td>
                                        <td class="input" style="text-align:center;">
                                            @if(!str_contains($c->curname, '-'))
                                             <span style="color:blue;font-weight:bold;text-align:center;">{{$c->curname}}-THB</span>
                                             @endif
                                            <input name="buy[]" type="text" style="text-align:right;" class="form-control buy1 canenter kh22" value="{{ phpformatnumber($c->buy) }}" data-table="thai">
                                        </td>
                                        <td class="input" style="text-align:center;">
                                            @if(!str_contains($c->curname, '-'))
                                                <span style="color:red;font-weight:bold;text-align:center;">THB-{{$c->curname}}</span>
                                             @endif
                                            <input name="sale[]" type="text" style="text-align:right;" class="form-control sale1 canenter kh22" value="{{ phpformatnumber($c->sale) }}" data-table="thai">
                                        </td>

                                    </tr>
                                @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-6">
        <form action="" id="frmsetratebank">
            <div id="" class="row" style="margin-top:0px;">
                <table class="table">
                    <tr>
                        <td class="kh22-b" style="border-style:none;color:brown;background-color:aquamarine;">
                            កំណត់អត្រាវេរតាមធនាគា
                        </td>
                        <td style="border-style:none;background-color:aquamarine">
                            {{-- <button type="button" id="btnsetratethai" class="btn btn-primary">Save Thai Rate</button> --}}
                        </td>

                    </tr>
                </table>
            </div>
            <div id="" class="row" style="margin-top:-10px;">
                <div class="table-responsive">
                    <table class="table table-bordered kh22 ratetable">
                        <thead class="table-dark kh16" style="text-align:center;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" style="display:none;">ID</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Buy</th>
                                <th scope="col">Sale</th>
                            </tr>
                        </thead>
                        <tbody id="currencylistbank">

                                @foreach ($banks as $key => $c)
                                    <tr>
                                        <td style="text-align:center;padding-top:8px;width:50px;">{{ ++$key }}</td>

                                        <td class="input" style="display:none;">
                                            <input name="curid1[]" type="text" style="width:60px;" class="form-control curid2 canenter kh22" value="{{ $c->id }}" readonly>
                                        </td>
                                        <td class="input">
                                            <input name="curname[]" type="text" style="width:120px;padding-left:0px;padding-right:0px;text-align:center;border-style:none;background-color:inherit;" class="form-control curname2 canenter kh22" value="{{ $c->curname }}" readonly>

                                        </td>


                                        <td class="input" style="">
                                            <input name="buy[]" type="text" style="text-align:right;" class="form-control buy2 canenter kh22" value="{{ phpformatnumber($c->buy) }}" data-table="thai">
                                        </td>
                                        <td class="input" style="">
                                            <input name="sale[]" type="text" style="text-align:right;" class="form-control sale2 canenter kh22" value="{{ phpformatnumber($c->sale) }}" data-table="thai">
                                        </td>

                                    </tr>
                                @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>




@endsection
@section('script')

<script src="{{ config('helper.asset_path') }}/js/numberinput.js"></script>
<script type="text/javascript">
     $('#h1_title').text('កំណត់អត្រាប្តូរប្រាក់ថ្មី');
     updateDivClass();
     window.addEventListener("resize", updateDivClass);
     function updateDivClass()
    {
        let div1 = document.getElementById("divcol1"); // Change "myDiv" to your actual class name
        let div2=document.getElementById("divcol2");
        let div3=document.getElementById("divcol3");

        if (window.innerWidth < 1600) {
                div1.classList.remove("col-lg-4");
                div1.classList.add("col-lg-6");
                div2.classList.remove("col-lg-4");
                div2.classList.add("col-lg-6");
                div3.classList.remove("col-lg-4");
                div3.classList.add("col-lg-6");
            } else {
                div1.classList.remove("col-lg-6");
                div1.classList.add("col-lg-4");
                div2.classList.remove("col-lg-6");
                div2.classList.add("col-lg-4");
                div3.classList.remove("col-lg-6");
                div3.classList.add("col-lg-4");
            }
    }

     var ably = new Ably.Realtime('DF1ung.N3Jwqw:30ezVuIjqesSJZRbGMoD8NsqtIij6_uqR6soVWetP0Q'); //remember to pass your ably API key
            var channel = ably.channels.get('chatting'); // here i create a channel or initialize the existing channel
            channel.subscribe('messageEvent', function(message) { // message this is message from channel
                // Handle incoming messages (create a message body div tag)
                console.log(message)
                const username = "{{ Auth::user()->name }}"; // Server renders this per user
                const sender   = message.data.sender; // 👈 this is what you want
                if (username !== sender) {
                    location.reload();
                } else {
                    console.log("Skip reload because sender is me");
                }
            });
    $(document).ready(function(){
        var today=new Date();
        $('#setdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
        var h =  window.screen.availHeight
        var w= window.screen.availWidth
        checkscreenwidth();
        function checkscreenwidth(){
            if(w<=900){
                document.getElementById("divcol1").style.marginLeft = '0px';
                document.getElementById("divcol2").style.marginLeft = '0px';
                document.getElementById("divcol3").style.marginLeft = '0px';
                //document.getElementById("divcol4").style.marginLeft = '0px';
                document.getElementById("divcol1").style.marginRight = '0px';
                document.getElementById("divcol2").style.marginRight = '0px';
                document.getElementById("divcol3").style.marginRight = '0px';
                //document.getElementById("divcol4").style.marginRight = '0px';
                document.getElementById("maincol").style.marginLeft = '-30px';
                document.getElementById("maincol").style.marginRight = '-30px';
                // document.getElementById("maincol1").style.marginLeft = '-30px';
                // document.getElementById("maincol1").style.marginRight = '-30px';
            }

        }



        $('.buy').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
        $('.sale').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
        $('.buy2').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
        $('.sale2').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
        $(document).keydown(function (event) {
           if(event.keyCode==13){
                return false;
           }
        })
        $(document).on('keydown','.canenter',function(e){
				 if (e.keyCode == 13) {
			        var $this = $(this),
			        index = $this.closest('td').index();
			        $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
			        e.preventDefault();
			    }
			})
        $(document).on('click','.btnedit',function(e){
            e.preventDefault();

            var rowind = $(this).closest('tr').index();
        	//var rowind=row.find("td:eq(0)").text();
            var ck=$('.chk').eq(rowind).prop('checked');
            $('.chk').eq(rowind).attr('checked',!ck);
            $('.buy').eq(rowind).attr('readonly',ck);
            $('.sale').eq(rowind).attr('readonly',ck);
            $('.txtchk').eq(rowind).val(!ck);
        })
        // $(document).on('keyup','#curleft .buy,#curleft .sale',function(e){
        //     e.preventDefault();
        //     debugger;
        //     var rowind = $(this).closest('tr').index();
        // 	//var rowind=row.find("td:eq(0)").text();
        //     var operator=$('.optsign').eq(rowind).val();
        //     var ratio=$('.ratio').eq(rowind).val().replace(/,/g,'');
        //     var buy=$('.buy').eq(rowind).val().replace(/,/g,'');
        //     var sale=$('.sale').eq(rowind).val().replace(/,/g,'');
        //     var ratebuy=0;
        //     var ratesale=0;
        //     var shortcut=$('.shortcut').eq(rowind).val();
        //     if(shortcut=='KHR'){
        //         autoratethai(0);
        //     }
        //     ratebuy=buy/ratio;
        //     ratesale=sale/ratio;
        //     var khrbuy=0;
        //     var khrsale=0;
        //     var thbbuy=0;
        //     var thbsale=0;
        //     var vndbuy=0;
        //     var vndsale=0;
        //     $('.ratebuy').eq(rowind).val(ratebuy);
        //     $('.ratesale').eq(rowind).val(ratesale);
        //     if(shortcut=='KHR' || shortcut=='THB' || shortcut=='VND'){
        //         $('.curid').each(function(i,e){

        //             if($('.shortcut').eq(i).val()=='KHR'){
        //                 khrbuy=$('.buy').eq(i).val().replace(/,/g,'');
        //                 khrsale=$('.sale').eq(i).val().replace(/,/g,'');
        //             }
        //             if($('.shortcut').eq(i).val()=='THB'){
        //                 thbbuy=$('.buy').eq(i).val().replace(/,/g,'');
        //                 thbsale=$('.sale').eq(i).val().replace(/,/g,'');
        //             }
        //             if($('.shortcut').eq(i).val()=='VND'){
        //                 vndbuy=$('.buy').eq(i).val().replace(/,/g,'');
        //                 vndsale=$('.sale').eq(i).val().replace(/,/g,'');
        //             }

        //             if($('.shortcut').eq(i).val()=='KHR-THB' || $('.shortcut').eq(i).val()=='THB-KHR'){

        //                 $('.buy').eq(i).val(formatNumber((khrbuy/thbsale).toFixed(2)));
        //                 $('.sale').eq(i).val(formatNumber((khrsale/thbbuy).toFixed(2)));
        //                 $('.ratebuy').eq(i).val(formatNumber((khrbuy/thbsale).toFixed(2)));
        //                 $('.ratesale').eq(i).val(formatNumber((khrsale/thbbuy).toFixed(2)));
        //             }

        //             if($('.shortcut').eq(i).val()=='VND-KHR' || $('.shortcut').eq(i).val()=='KHR-VND'){
        //                 // $('.sale').eq(i).val((khrbuy/vndsale).toFixed(5));
        //                 // $('.buy').eq(i).val((khrsale/vndbuy).toFixed(5));
        //                 // $('.ratesale').eq(i).val((khrbuy/vndsale).toFixed(5));
        //                 // $('.ratebuy').eq(i).val((khrsale/vndbuy).toFixed(5));
        //                 //debugger;
        //                 var decbuy=$('.buy').eq(i).attr('title');
        //                 var decsale=$('.sale').eq(i).attr('title');
        //                 $('.buy').eq(i).val((khrbuy/vndsale).toFixed(decbuy));
        //                 $('.sale').eq(i).val((khrsale/vndbuy).toFixed(decsale));
        //                 $('.ratesale').eq(i).val((khrsale/vndbuy).toFixed(decsale));
        //                 $('.ratebuy').eq(i).val((khrbuy/vndsale).toFixed(decbuy));
        //             }

        //         })
        //     }

        // })
        $(document).on('keyup','.buy,.sale',function(e){
            e.preventDefault();

            var $row = $(this).closest('tr'); // Get the row where the event was triggered
            var $table = $row.closest('table'); // Identify the parent table
            var rowind = $(this).closest('tr').index();

            var operator=$table.find('.optsign').eq(rowind).val();
            var ratio=$table.find('.ratio').eq(rowind).val().replace(/,/g,'');
            var buy = $table.find('.buy').eq(rowind).val().replace(/,/g, '');
            var sale=$table.find('.sale').eq(rowind).val().replace(/,/g,'');
            var ratebuy=0;
            var ratesale=0;
            var shortcut=$table.find('.shortcut').eq(rowind).val();
            if(shortcut=='KHR'){
                autoratethai(0);
            }
            ratebuy=buy/ratio;
            ratesale=sale/ratio;
            var khrbuy=0;
            var khrsale=0;
            var thbbuy=0;
            var thbsale=0;
            var vndbuy=0;
            var vndsale=0;
            $table.find('.ratebuy').eq(rowind).val(ratebuy);
            $table.find('.ratesale').eq(rowind).val(ratesale);
            if(shortcut=='KHR' || shortcut=='THB' || shortcut=='VND'){
                $table.find('.curid').each(function(i,e){
                    if($table.find('.shortcut').eq(i).val()=='KHR'){
                        khrbuy=$table.find('.buy').eq(i).val().replace(/,/g,'');
                        khrsale=$table.find('.sale').eq(i).val().replace(/,/g,'');
                    }
                    if($table.find('.shortcut').eq(i).val()=='THB'){
                        thbbuy=$table.find('.buy').eq(i).val().replace(/,/g,'');
                        thbsale=$table.find('.sale').eq(i).val().replace(/,/g,'');
                    }
                    if($table.find('.shortcut').eq(i).val()=='VND'){
                        vndbuy=$table.find('.buy').eq(i).val().replace(/,/g,'');
                        vndsale=$table.find('.sale').eq(i).val().replace(/,/g,'');
                    }
                    @if(config('helper.transfer_option') == 'chivra')
                        if($table.find('.shortcut').eq(i).val()=='KHR-THB' || $table.find('.shortcut').eq(i).val()=='THB-KHR'){
                            $table.find('.buy').eq(i).val(formatNumber((khrbuy/thbsale).toFixed(2)));
                            $table.find('.sale').eq(i).val(formatNumber((khrsale/thbbuy).toFixed(2)));
                            $table.find('.ratebuy').eq(i).val(formatNumber((khrbuy/thbsale).toFixed(2)));
                            $table.find('.ratesale').eq(i).val(formatNumber((khrsale/thbbuy).toFixed(2)));
                        }
                        if($table.find('.shortcut').eq(i).val()=='VND-KHR' || $table.find('.shortcut').eq(i).val()=='KHR-VND'){
                            var decbuy=$table.find('.buy').eq(i).attr('title');
                            var decsale=$table.find('.sale').eq(i).attr('title');
                            $table.find('.buy').eq(i).val((khrbuy/vndsale).toFixed(decbuy));
                            $table.find('.sale').eq(i).val((khrsale/vndbuy).toFixed(decsale));
                            $table.find('.ratesale').eq(i).val((khrsale/vndbuy).toFixed(decsale));
                            $table.find('.ratebuy').eq(i).val((khrbuy/vndsale).toFixed(decbuy));
                        }
                    @endif


                })
            }

        })
        $(document).on('keyup','.buy1,.sale1',function(e){
            e.preventDefault();
            var rowind=$(this).closest('tr').index();
            autoratethai(rowind);

        })
        function autoratethai(rowind)
        {
            var khrbuy=0;
            var khrsale=0;
            var usdbuy=0;
            var usdsale=0;
                $('.curid').each(function(i,e){
                    if($('.shortcut').eq(i).val()=='KHR'){
                        khrbuy=$('.buy').eq(i).val().replace(/,/g,'');
                        khrsale=$('.sale').eq(i).val().replace(/,/g,'');
                    }
                })
                $('.curid1').each(function(i,e){
                    if($('.curname').eq(i).val()=='USD'){
                        usdbuy=$('.buy1').eq(i).val().replace(/,/g,'');
                        usdsale=$('.sale1').eq(i).val().replace(/,/g,'');
                    }
                    if(rowind==0){
                        if($('.curname').eq(i).val()=='KHR'){
                            $('.buy1').eq(i).val(formatNumber((khrbuy/usdsale).toFixed(2)));
                            $('.sale1').eq(i).val(formatNumber((khrsale/usdbuy).toFixed(2)));
                        }
                    }
                })
        }
        function setrate(callback1,callback2,callably){
            $('body').addClass("wait");
            var formdata = new FormData(frmsetrate);
            var url="{{ route('currency.setrate') }}";
            $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       if($.isEmptyObject(data.error)){
                            //console.log('callback1');
                          callback1(callback2,callably);
                          //callback2();
                           $('body').removeClass("wait");
                        //alert(data.message);
                        //location.reload();


                       }else{
                            alert(data.error)
                       }


                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
        }

		$(document).on('click','#btnsetrate',function(e){
            e.preventDefault();
            setrate(setthairate,setbankrate,sendMessage);

        })
        async function sendMessage() {
            var ably = new Ably.Realtime('DF1ung.N3Jwqw:30ezVuIjqesSJZRbGMoD8NsqtIij6_uqR6soVWetP0Q'); //remember to pass your ably API key
            var channel = ably.channels.get('chatting'); // here i create a channel or initialize the existing channel
            var message ='refresh rate'; //get the message from input
            var name = 'exchange'; //get the sender name from input
            var sender = "{{ Auth::user()->name }}";
            var customername="{{ config('helper.transfer_option') }}";
            if (message !== '') { //if input message is not empty publish a message
                // Publish the message to the chat channel
                channel.publish('messageEvent', { name: name, text: message, sender: sender,customername:customername });
            }
        }
        async function setthairate(callback,callably){
            $('body').addClass("wait");
            var formdata = new FormData(frmsetratethai);
            formdata.append('exchangetype','THAI');
            var url="{{ route('currency.setratethai') }}";
            $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       if($.isEmptyObject(data.error)){
                        $('body').removeClass("wait");
                        if($('#currencylistbank tr').length<=0){
                            callably();
                            alert(data.message);
                            //location.reload();
                        }else{
                            callback(callably);

                        }
                       }else{
                            alert(data.error)
                       }

                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
        }
        async function setbankrate(callback){
            alert('hi from setbankrate')
            if($('#currencylistbank tr').length<=0){
                return;
            }
            $('body').addClass("wait");
            var formdata = new FormData(frmsetratebank);
            formdata.append('exchangetype','BANK');
            var url="{{ route('currency.setratethai') }}";
            $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       //console.log(data)
                       callback();
                       if($.isEmptyObject(data.error)){
                        $('body').removeClass("wait");
                        alert(data.message);
                        location.reload();

                       }else{
                            alert(data.error)
                       }
                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
        }

        $(document).on('click','#btnsetratethai',function(e){
            e.preventDefault();
            setthairate();
        })


    $(document).on('change','#viewcol',function(e){
        e.preventDefault();
        getcurrencyrate()
    })
    function getcurrencyrate(){
        var url="{{ route('currencyrate') }}";
        var viewcol=$('#viewcol').val();
        $.get(url,{active:1,viewcol:viewcol},function(data){
            //console.log(data)
            if(!data.error){
                $('#currencylist').empty().html(data);
            }else{
                alert(data.error)
            }
        })
    }

    })
</script>
@endsection
