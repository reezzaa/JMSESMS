  {!! Form::open(['url'=>'bd/collection','method'=>'post','target'=>'_blank', 'id'=>'form-insert-cheque','class'=>'col-md-8 ']) !!}  
            <div class="row">
                    <label for="" class="col-md-4"><h5><strong>Invoice No: {{$cheque->inv}}</strong></h5></label> 
                    <input type="hidden" id="invno" name="invno" value="{{$cheque->inv}}">
                  </div>
                
              <div class="row">
              <label for="" class="col-md-12"><h5><strong>Amount Due: <label id="due">₱ {{$chec}}</label></strong></h5></label> 
              <input type="hidden" id="amtt" name="amtt" value="{{$cheque->amount}}">
            </div>
             <div class="row col-md-12">
                <label for="" class="text-center"><h5><strong>Cheque No. <span class="text-danger">*</span></strong></h5></label>
                   <input type="text" id="cheque_no" name="cheque_no" maxlength="20" class="form-control col-md-8"> 
                   <script>
                    $('#cheque_no').alphanum({
                       allow :    '-/',
                     });
                      </script>         
            </div>
            <div class="row">
               <div class="col-md-12">
                  <label for="" class="text-center"><h5><strong>Bank <span class="text-danger">*</span></strong></h5></label>
                  <select name="bank" id="bank" class="form-control">
                    @foreach($bank as $bank)
                      <option value="{{$bank->id}}">{{$bank->BankName}}</option>
                    @endforeach
                  </select>       
              </div>
              
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