<style>
    .amt{
        font-size:16px;
        text-align:right;
        font-weight:bold;
    }
    .title{
        font-family:'Noto Sans Khmer';
        font-size:16px;
        text-align:center;
        font-weight:bold;
    }
    .curname{
        font-family:'Noto Sans Khmer';
        font-size:16px;
        font-weight:bold;
    }
    .hd{
        font-family:'Noto Sans Khmer';
        font-size:14px;
        text-align:center;
        font-weight:bold;
    }
    .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            }
    .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
    .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            }
    .kh12{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            }
    #tbl_curleft input{
       border:1px solid black;
    }
     #tbl_curleft td,#tbl_thai td{
        border:1px solid black;
        padding:0px;
    }
    .btn-3d {
            background: #3498db;
            color: white;
            margin:0px 2px;
            padding: 2px 10px;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 0 #011d30;
            cursor: pointer;
            transition: all 0.1s ease-in-out;
            font-weight: bold;
            }
        .btn-3d-primary{
            background: #344ddd;
            color: white;
        }
        .btn-3d-danger{
             background: #f3260b;
             color: white;
        }
         .btn-3d-warning{
             background: #c9a506;
             color: white;
        }

        .btn-3d:active {
            transform: translateY(4px);
            box-shadow: 0 1px 0 #2980b9;
            }
        .btn-3d:hover{
            background-color:green !important;
            color:white !important;
        }
</style>

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
<form action="" id="frmsetrate_sidebar">
    <div id="maincol" class="row" style="">

        <table id="tbl_curleft" class="table table-bordered;" style="background-color:rgb(190, 231, 231);table-layout:fixed;">
            <thead class="kh12-b" style="text-align:center;background-color:gold">

                    <th style="display:none;">ID</th>
                    <th style="padding:2px;width:100px;">Currency</th>
                    <th style="display:none;">Short Cut</th>
                    <th style="display:none;">IsP&P</th>
                    <th style="display:none;">Sign</th>
                    <th style="padding:2px;">Buy</th>
                    <th style="padding:2px;">Sale</th>
                    <th style="display:none;">Ratio</th>
                    <th style="display:none;">RateBuy</th>
                    <th style="display:none;">RateSale</th>


            </thead>

            <tbody>
                @foreach ($curleft as $key => $c1)
                    @php
                        if($c1->ispandp==1){
                            $ssh=explode('-',$c1->shortcut);
                        }
                    @endphp
                    <tr>
                        <td class="input" style="display:none;">
                            <input name="curid[]" type="text" class=" curid canenter kh12-b" style="width:80px;" value="{{ $c1->id }}" readonly>
                        </td>
                        <td style="width:250px;" class="kh16-b" style="@if($c1->shortcut=='KHR-THB' || $c1->shortcut=='THB-KHR' || $c1->shortcut=='KHR-VND' || $c1->shortcut=='VND-KHR') padding:10px 0px 0px 5px; @else padding-left:5px; @endif">
                            {{ $c1->shortcut }}
                        </td>
                        <td class="input" style="display:none;">
                            <input name="shortcut[]" type="text" style="width:60px;" class=" shortcut canenter kh16-b" value="{{ $c1->shortcut }}" readonly>
                        </td>
                        <td class="input" style="display:none;">
                            <input name="ispandp[]" type="text" style="width:60px;" class=" ispandp canenter kh16-b" value="{{ $c1->ispandp }}" readonly>
                        </td>
                        <td class="input" style="display:none;">
                            <input name="optsign[]" type="text" style="width:60px;" class=" optsign canenter kh16-b" value="{{ $c1->optsign }}" readonly>
                        </td>
                        @if($c1->ispandp==1)
                        <td class="input" style="text-align:right;padding:0px;">
                            <span style="color:blue;">{{$ssh[1] . '-' . $ssh[0]}}</span>
                            <input name="sale[]" type="text" style="text-align:right;padding:0px 5px 0px 0px;border-style:none;width:100%;" class=" sale canenter kh16-b" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->sale) }}"  autocomplete="off">
                        </td>
                        <td class="input" style="text-align:right;padding:0px;">
                            <span style="color:blue;">{{$ssh[0] . '-' . $ssh[1]}}</span>
                            <input name="buy[]" type="text" style="text-align:right;padding:0px 5px 0px 0px;border-style:none;width:100%;" class=" buy canenter kh16-b" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->buy) }}"  autocomplete="off">
                        </td>
                        @else
                                <td class="input" style="text-align:right;padding:0px;">
                                <input name="buy[]" type="text" style="text-align:right;padding:0px 5px 0px 0px;border-style:none;width:100%;" class=" buy canenter kh16-b" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->buy) }}"  autocomplete="off">
                            </td>
                            <td class="input" style="text-align:right;padding:0px;">
                                <input name="sale[]" type="text" style="text-align:right;padding:0px 5px 0px 0px;border-style:none;width:100%;" class=" sale canenter kh16-b" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->sale) }}"  autocomplete="off">
                            </td>
                            @endif
                        <td class="input" style="display:none;">
                            <input name="ratio[]" style="width:120px;text-align:center;" type="text" class=" ratio canenter kh16-b" value="{{ $c1->ratio }}" readonly>
                        </td>
                        <td class="input" style="display:none;">
                            <input name="ratebuy[]" type="text" style="text-align:right;" class=" ratebuy canenter kh16-b" value="{{ phpformatnumber($c1->ratebuy) }}" readonly>
                        </td>
                        <td class="input" style="display:none;">
                            <input name="ratesale[]" type="text" style="text-align:right;" class=" ratesale canenter kh16-b" value="{{ phpformatnumber($c1->ratesale) }}" readonly>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</form>
<form action="" id="frmsetratethai_sidebar">
    <div id="" class="row" style="margin-top:-20px;">
        <table class="table">
            <tr>
                <td class="kh16-b" style="border-style:none;color:brown">
                    កំណត់អត្រាលុយថៃ
                </td>
                <td style="text-align:right;padding:10px 0px;">
                    @if(Auth::user()->role->name=='Admin')
                        <button type="button" id="btnsetrate0" class="btn-3d btn-3d-primary kh12-b" style="">Save Rate</button>
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <div id="maincol1" class="row" style="margin-top:-25px;">
        <table id="tbl_thai" class="table table-bordered;table-layout:fixed;" style="background-color:beige;">
            <thead class="kh12-b" style="text-align:center;background-color:blue;color:white;">
                <tr>
                    <th scope="col" style="display:none;">ID</th>
                    <th scope="col" style="padding:2px;width:80px;">Currency</th>
                    <th scope="col" style="padding:2px;">Buy</th>
                    <th scope="col" style="padding:2px;">Sale</th>

                </tr>
            </thead>
            <tbody id="currencylist">
                    @foreach ($thais as $key => $c)
                        <tr>
                            <td class="input" style="display:none;">
                                <input name="curid1[]" type="text" style="width:60px;" class=" curid1 canenter kh16-b" value="{{ $c->id }}" readonly>
                            </td>
                            <td class="input" style="padding:0px;width:100px;">
                                <input name="curname[]" type="text" style="border-style:none;background-color:inherit;width:60px;padding:2px 0px 0px 5px;width:100%;" class=" curname1 canenter kh16-b" value="{{ $c->curname }}" readonly>
                            </td>
                            <td class="input" style="padding:0px;">
                                <input name="buy[]" type="text" style="text-align:right;padding:0px 5px 0px 0px;width:100%;" class=" buy1 canenter kh16-b" value="{{ phpformatnumber($c->buy) }}" data-table="thai"  autocomplete="off">
                            </td>
                            <td class="input" style="padding:0px;">
                                <input name="sale[]" type="text" style="text-align:right;padding:0px 5px 0px 0px;width:100%;" class=" sale1 canenter kh16-b" value="{{ phpformatnumber($c->sale) }}" data-table="thai" autocomplete="off">
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</form>
