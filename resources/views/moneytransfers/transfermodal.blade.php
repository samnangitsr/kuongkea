<div class="modal fade" id="transfermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh16-b">ផ្ទេរប្រាក់</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form id="regForm" action="">

                            <h1>Register:</h1>
                            
                            <!-- One "tab" for each step in the form: -->
                            <div class="tab">Name:
                              <p><input placeholder="First name..." oninput="this.className = ''"></p>
                              <p><input placeholder="Last name..." oninput="this.className = ''"></p>
                            </div>
                            
                            <div class="tab">Contact Info:
                              <p><input placeholder="E-mail..." oninput="this.className = ''"></p>
                              <p><input placeholder="Phone..." oninput="this.className = ''"></p>
                            </div>
                            
                            <div class="tab">Birthday:
                              <p><input placeholder="dd" oninput="this.className = ''"></p>
                              <p><input placeholder="mm" oninput="this.className = ''"></p>
                              <p><input placeholder="yyyy" oninput="this.className = ''"></p>
                            </div>
                            
                            <div class="tab">Login Info:
                              <p><input placeholder="Username..." oninput="this.className = ''"></p>
                              <p><input placeholder="Password..." oninput="this.className = ''"></p>
                            </div>
                            
                            <div style="overflow:auto;">
                              <div style="float:right;">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                              </div>
                            </div>
                            
                            <!-- Circles which indicates the steps of the form: -->
                            <div style="text-align:center;margin-top:40px;">
                              <span class="step"></span>
                              <span class="step"></span>
                              <span class="step"></span>
                              <span class="step"></span>
                            </div>
                            
                            </form>
    
                    </div>
                   
                </div>
               
            </div>
            
        </div>
    </div>
</div>