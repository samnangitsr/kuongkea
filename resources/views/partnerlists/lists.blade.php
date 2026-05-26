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
        $tusd=0;
        $tkhr=0;
        $tthb=0;
        $tvnd=0;
    @endphp
    <div class="row" style="margin-top:20px;">

        <table id="tbl_we" class="table table-bordered kh16" style="margin-left:20px;margin-right:20px;">
            <thead style="text-align:center;" class="">
                <th style="width:60px;">លរ</th>
                <th style="width:120px;">ថ្ងៃទី</th>
                <th style="width:100px;">ម៉ោង</th>
                <th style="width:100px;">អ្នកកត់ត្រា</th>
                <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
                <th style="width:200px;">USD</th>
                <th style="width:200px;">KHR</th>
                <th style="width:200px;">THB</th>
                <th style="width:200px;"> VND</th>
                <th style="width:300px;">Sender</th>
                <th style="width:500px;">Receiver</th>
                <th style="width:300px;">ផ្សេងៗ</th>
                <th style="width:200px;">ចំនួនទឹកប្រាក់</th>
                <th style="width:150px;">សេវ៉ា/ការប្រាក់</th>
            </thead>
            <tbody id="bodytransfer">
                @foreach ($ptls as $key =>$l)
                    @php
                        $tusd+=$l->usd;
                        $tkhr+=$l->khr;
                        $tthb+=$l->thb;
                        $tvnd+=$l->vnd;
                    @endphp
                    <tr>
                        <td style="text-align:center;">{{ ++$key }}</td>
                        <td>{{ date('d-m-Y',strtotime($l->trandate)) }}</td>
                        <td>{{ $l->trantime }}</td>
                        <td>{{ $l->recordby }}</td>
                        <td>{{ $l->tranname }}</td>
                        <td style="text-align:right;width:200px;" class="kh16-b">{{ $l->usd<>0?phpformatnumber($l->usd). '$':''  }}</td>
                        <td style="text-align:right;width:200px;" class="kh16-b">{{ $l->khr<>0?phpformatnumber($l->khr).'R':'' }}</td>
                        <td style="text-align:right;width:200px;" class="kh16-b">{{ $l->thb<>0?phpformatnumber($l->thb) .'B':''}}</td>
                        <td style="text-align:right;width:200px;" class="kh16-b">{{ $l->vnd<>0?phpformatnumber($l->vnd).'D':'' }}</td>
                        <td>{{ $l->sendertel }}</td>
                        <td>{{ $l->rectel }}</td>
                        <td>{{ $l->note }}</td>
                        <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                        <td style="text-align:right;" class="kh16-b">
                            @if($l->fee && $l->fee<>0)
                            {{ phpformatnumber($l->fee) . $l->feecur }}
                            @endif
                            @if($l->interest && $l->interest<>0)
                            {{ phpformatnumber($l->interest) . $l->cur }}
                            @endif
                        </td>

                    </tr>
                @endforeach
                <tr style="background-color:aqua">
                    <td colspan=5>សរុប</td>

                    <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($tusd) . '$' }}</td>
                    <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($tkhr) .'R'}}</td>
                    <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($tthb) .'B'}}</td>
                    <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($tvnd) .'D'}}</td>
                    <td colspan=5></td>
                </tr>
            </tbody>
        </table>

    </div>

    {{-- <div class="row">
        <div class="card">
            <div class="card-title">
                <h1 class="kh22-b" style="text-align:center;margin-top:10px;">មុនទូទាត់</h1>
            </div>
            <div class="card-body">
                <div class="row" style="margin-top:-20px;">
                    <div class="col-lg-6">
                        @php
                            $weusd=0;
                            $wethb=0;
                            $wekhr=0;
                            $wevnd=0;
                            foreach($befortotalwe as $w){
                                if($w->cur=='USD'){
                                    $weusd=$w->total;
                                }else if($w->cur=='THB'){
                                    $wethb=$w->total;
                                }else if($w->cur=='KHR'){
                                    $wekhr=$w->total;
                                }else if($w->cur=='VND'){
                                    $wevnd=$w->total;
                                }
                            }
                        @endphp

                        <table class="table table-bordered kh22-b">
                            <tr style="background-color:azure">
                                <td class="kh22" style="text-align:center">សរុបបើកនៅ {{ $logo->name }}</td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($weusd)) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($wethb)) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($wekhr)) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($wevnd)) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        @php
                            $theyusd=0;
                            $theythb=0;
                            $theykhr=0;
                            $theyvnd=0;
                            foreach($befortotalthey as $they){
                                if($they->cur=='USD'){
                                    $theyusd=$they->total;
                                }else if($they->cur=='THB'){
                                    $theythb=$they->total;
                                }else if($they->cur=='KHR'){
                                    $theykhr=$they->total;
                                }else if($they->cur=='VND'){
                                    $theyvnd=$they->total;
                                }
                            }
                        @endphp

                        <table class="table table-bordered kh22-b">
                            <tr style="background-color:azure">
                                <td class="kh22" style="text-align:center">សរុបបើកនៅ {{ $partnername }}</td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($theyusd)) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($theythb)) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($theykhr)) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($theyvnd)) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-title">
                <h1 class="kh22-b" style="text-align:center;margin-top:10px;">ក្រោយទូទាត់</h1>
            </div>
            <div class="card-body">
                <div class="row" style="margin-top:-20px;">
                    <div class="col-lg-6">
                        @php
                            $usd1=0;
                            $thb1=0;
                            $khr1=0;
                            $vnd1=0;
                            $usd2=0;
                            $thb2=0;
                            $khr2=0;
                            $vnd2=0;
                            foreach($aftertotal as $a){
                                if($a->cur=='USD'){
                                    if($a->total>0){
                                        $usd2=$a->total;
                                    }else{
                                        $usd1=$a->total;
                                    }

                                }else if($a->cur=='THB'){
                                    if($a->total>0){
                                        $thb2=$a->total;
                                    }else{
                                        $thb1=$a->total;
                                    }
                                }else if($a->cur=='KHR'){
                                    if($a->total>0){
                                        $khr2=$a->total;
                                    }else{
                                        $khr1=$a->total;
                                    }
                                }else if($a->cur=='VND'){
                                    if($a->total>0){
                                        $vnd2=$a->total;
                                    }else{
                                        $vnd1=$a->total;
                                    }
                                }
                            }
                        @endphp

                        <table class="table table-bordered kh22-b">
                            <tr style="background-color:azure">
                                <td class="kh22" style="text-align:center">នៅខ្វះ {{ $logo->name }}</td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($usd1)) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($thb1)) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($khr1)) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($vnd1)) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">


                        <table class="table table-bordered kh22-b">
                            <tr style="background-color:azure">
                                <td class="kh22" style="text-align:center">នៅខ្វះ {{ $partnername }}</td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($usd2)) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($thb2)) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($khr2)) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($vnd2)) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row" style="margin-top:10px;">
        <div class="col-lg-6">
          <div class="row" style="">
              <div class="card" style="padding:0px;margin:0px;">
                  <div class="card-title">
                      <h1 class="kh22-b" style="text-align:center;margin-top:0px;padding:0px;">មុនទូទាត់</h1>
                  </div>
                  <div class="card-body" style="padding:0px;margin:10px 5px 0px 5px;">
                      <div class="row" style="margin-top:-20px;">
                          <div class="col-lg-6">
                              @php
                                  $weusd=0;
                                  $wethb=0;
                                  $wekhr=0;
                                  $wevnd=0;
                                  foreach($befortotalwe as $w){
                                      if($w->cur=='USD'){
                                          $weusd=$w->total;
                                      }else if($w->cur=='THB'){
                                          $wethb=$w->total;
                                      }else if($w->cur=='KHR'){
                                          $wekhr=$w->total;
                                      }else if($w->cur=='VND'){
                                          $wevnd=$w->total;
                                      }
                                  }
                              @endphp

                              <table id="tbl_before_total_we" class="table table-bordered kh16-b">
                                  <tr style="background-color:azure">
                                      <td class="kh14-b" style="text-align:center">បើកនៅ {{ $logo->name }}</td>
                                  </tr>

                                  <tr>
                                      <td style="text-align:right;">
                                          {{ phpformatnumber(abs($weusd)) . ' USD' }}
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:right;">
                                          {{ phpformatnumber(abs($wethb)) . ' THB' }}
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:right;">
                                          {{ phpformatnumber(abs($wekhr)) . ' KHR' }}
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:right;">
                                          {{ phpformatnumber(abs($wevnd)) . ' VND' }}
                                      </td>
                                  </tr>
                              </table>
                          </div>
                          <div class="col-lg-6">
                              @php
                                  $theyusd=0;
                                  $theythb=0;
                                  $theykhr=0;
                                  $theyvnd=0;
                                  foreach($befortotalthey as $they){
                                      if($they->cur=='USD'){
                                          $theyusd=$they->total;
                                      }else if($they->cur=='THB'){
                                          $theythb=$they->total;
                                      }else if($they->cur=='KHR'){
                                          $theykhr=$they->total;
                                      }else if($they->cur=='VND'){
                                          $theyvnd=$they->total;
                                      }
                                  }
                              @endphp

                              <table id="tbl_before_total_they" class="table table-bordered kh16-b">
                                  <tr style="background-color:azure">
                                      <td class="kh14" style="text-align:center">បើកនៅ {{ $partnername }}</td>
                                  </tr>

                                  <tr>
                                      <td style="text-align:right;">
                                          {{ phpformatnumber($theyusd) . ' USD' }}
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:right;">
                                          {{ phpformatnumber($theythb) . ' THB' }}
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:right;">
                                          {{ phpformatnumber($theykhr) . ' KHR' }}
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:right;">
                                          {{ phpformatnumber($theyvnd) . ' VND' }}
                                      </td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
              <div class="card-title">
                  <h1 class="kh22-b" style="text-align:center;margin-top:0px;">ក្រោយទូទាត់</h1>
              </div>
              <div class="card-body" style="padding:0px;margin:10px 5px 0px 5px;">
                  <div class="row" style="margin-top:-20px;">
                      <div class="col-lg-6">
                          @php
                              $usd1=0;
                              $thb1=0;
                              $khr1=0;
                              $vnd1=0;
                              $usd2=0;
                              $thb2=0;
                              $khr2=0;
                              $vnd2=0;
                              foreach($aftertotal as $a){
                                  if($a->cur=='USD'){
                                      if($a->total>0){
                                          $usd2=$a->total;
                                      }else{
                                          $usd1=$a->total;
                                      }

                                  }else if($a->cur=='THB'){
                                      if($a->total>0){
                                          $thb2=$a->total;
                                      }else{
                                          $thb1=$a->total;
                                      }
                                  }else if($a->cur=='KHR'){
                                      if($a->total>0){
                                          $khr2=$a->total;
                                      }else{
                                          $khr1=$a->total;
                                      }
                                  }else if($a->cur=='VND'){
                                      if($a->total>0){
                                          $vnd2=$a->total;
                                      }else{
                                          $vnd1=$a->total;
                                      }
                                  }
                              }
                          @endphp

                          <table id="tbl_after_total_we" class="table table-bordered kh16-b">
                              <tr style="background-color:azure">
                                  <td class="kh14-b" style="text-align:center">នៅខ្វះ {{ $logo->name }}</td>
                              </tr>

                              <tr>
                                  <td style="text-align:right;">
                                      {{ phpformatnumber(abs($usd1)) . ' USD' }}
                                  </td>
                              </tr>
                              <tr>
                                  <td style="text-align:right;">
                                      {{ phpformatnumber(abs($thb1)) . ' THB' }}
                                  </td>
                              </tr>
                              <tr>
                                  <td style="text-align:right;">
                                      {{ phpformatnumber(abs($khr1)) . ' KHR' }}
                                  </td>
                              </tr>
                              <tr>
                                  <td style="text-align:right;">
                                      {{ phpformatnumber(abs($vnd1)) . ' VND' }}
                                  </td>
                              </tr>
                          </table>
                      </div>
                      <div class="col-lg-6">


                          <table id="tbl_after_total_they" class="table table-bordered kh16-b">
                              <tr style="background-color:azure">
                                  <td class="kh14-b" style="text-align:center">នៅខ្វះ {{ $partnername }}</td>
                              </tr>

                              <tr>
                                  <td style="text-align:right;">
                                      {{ phpformatnumber($usd2) . ' USD' }}
                                  </td>
                              </tr>
                              <tr>
                                  <td style="text-align:right;">
                                      {{ phpformatnumber($thb2) . ' THB' }}
                                  </td>
                              </tr>
                              <tr>
                                  <td style="text-align:right;">
                                      {{ phpformatnumber($khr2) . ' KHR' }}
                                  </td>
                              </tr>
                              <tr>
                                  <td style="text-align:right;">
                                      {{ phpformatnumber($vnd2) . ' VND' }}
                                  </td>
                              </tr>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
        </div>

      </div>
