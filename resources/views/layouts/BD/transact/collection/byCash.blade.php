    {!! Form::open(['url'=>route('bd.collect.cash'),'method'=>'post','target'=>'_blank', 'id'=>'form-insert-cash','class'=>'col-md-8 ']) !!}  
            <div class="row">
                    <label for="" class="text-center col-md-4"><h5><strong>Invoice No: {{$cash->inv}}</strong></h5></label> 
                    <input type="hidden" id="invno" name="invno" value="{{$cash->inv}}">
                  </div>
                
              <div class="row">
              <label for="" class="text-center col-md-4"><h5><strong>Amount Due: <label id="due">{{$cash->amount}}</label></strong></h5></label> 
              <input type="hidden" id="amtt" name='amtt' value="{{$cash->amount}}">
            </div>
             <div class="row col-md-12">
                <label for="" class="col-md-4 text-center"><h5><strong>Amount Terdered: </strong></h5></label>
                   <div class="input-group col-md-8">  
                          <span class="input-group-addon"><strong>₱</strong></span>
                          <input type="text" id="paymentcost" name="paymentcost" class="form-control" onkeyup="compute()" placeholder="e.g. 0000.00" required maxlength="16">
                          <span class="input-group-btn">
                          <button type="button" class="btn btn-primary" onclick="exact()">Exact Amount</button>
                           </span>
                           <script>
                             $('#paymentcost').numeric({
                          decimalSeparator: ".",
                          maxDecimalPlaces : 2,
                          allowMinus:   false
                      });
                           </script>
                        </div>

                           <span id="duplicatew" class="help-block animation-slideDown col-md-offset-4 ">
                                  Insufficient Payment!
                              </span>
            </div>
                      <br><br>  
            <div class="row">
              <label for="" class="text-center col-md-4"><h5><strong>Change: </h5></strong></label> 
              <label for="" id="change" class="col-md-8"></label>
              <input type="hidden" id="changed" name="changed">

            </div>
            <hr>
            <label class="control-label" for="example-textarea-input">Remarks </label>
                      <textarea id="remarks" name="remarks" rows="2" class="form-control" placeholder="Content.."></textarea>
            <div>
              <hr>
            </div>
             <fieldset class="form-group">
                  <div class="pull-right">
                     {!! Form::submit('Collect',['id'=>'submit','class'=>'btn btn-alt btn-success']) !!}
                     {!! Form::button('Reset',['type'=>'reset','class'=>'btn btn-alt btn-warning']) !!}
                  </div>
                </fieldset>
            </fieldset>
          {!! Form::close() !!}