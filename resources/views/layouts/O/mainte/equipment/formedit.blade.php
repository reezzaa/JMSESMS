<div class="row">
  <div class="col-md-6">
     <div class="form-group">
      <label for="equiptypes">Equipment Type</label> <span class="text-danger">*</span> 
      {!! Form::text('equiptypes', null,  ['id'=>'equiptypes','class'=>'form-control', 'placeholder'=>'e.g. Excavator, Crane', 'maxlength'=>'45']) !!}
      <span id="duplicate" class="help-block animation-slideDown">
          Duplicate Material Name
      </span>
      <script>
          $('#equiptypes').alphanum({
                  allow :    '-,.()/', // Specify characters to allow
                });
        </script>
    </div>
  </div>
  <div class="col-md-6">
     <div class="form-group">
      <label for="equipnames">Equipment Name</label>
        {!!Form::text('equipnames',null,['id'=>'equipnames', 'class'=>'form-control', 'maxLength'=>'30'])!!}
          <span id="duplicates2" class="help-block animation-slideDown">
          Duplicate Material Name
         </span>
         <script>
         $('#equipnames').alphanum({
          allow :    '-,.()/', // Specify characters to allow
          });
        </script>
     </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group" >
      
        <label for="equipkeys">Equipment key (<em>identifier</em>)</label> <span class="text-danger">*</span> 
      {!! Form::text('equipkeys',null ,['id'=>'equipkeys','placeholder'=>'e.g. Serial key', 'class' => 'form-control', 'maxlength'=>'45']) !!}
    
      <span id="duplicatez3" class="help-block animation-slideDown">
        Duplicate Material Name
      </span>
      <script>
        $('#equipkeys').alphanum({
              allow :    '-./', // Specify characters to allow
            });
      </script>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" id="editlease">
      <div id="remos">
      <label for="equipleasers">Equipment Leaser </label> <span class="text-danger">*</span> 
      {!! Form::text('equipleasers',null ,['id'=>'equipleasers','placeholder'=>'Leaser', 'class' => 'form-control', 'maxlength'=>'50']) !!}
    </div>
      <span id="duplicate3" class="help-block animation-slideDown">
        Duplicate Material Name
      </span>
      <script>
        $('#equipleasers').alphanum({
            allow :    '-./', // Specify characters to allow
          });
      </script>
    </div>
  </div>
  
</div>
<div class="row">
   <div class="col-md-6">
    <div class="form-group">
      <label for="">Status</label> <span class="text-danger">*</span> 
     <select name="rents" id="rents"  class="form-control" onchange="editPrice(this.value)">
       <option value="1">Rented</option>
       <option value="0">Owned</option>
     </select>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" id="there">
      <div id="that">
        <label for="equipprices">Rental Price per Day</label> <span class="text-danger">*</span> 
        <input type="text" id="equipprices" name="equipprices" placeholder="e.g 999999" class="form-control" maxlength="30">
      </div>
      <span id="duplicate3" class="help-block animation-slideDown">
        Duplicate Material Name
      </span>
      <script>
        $('#equipprices').numeric({
          decimalSeparator: ".",
          maxDecimalPlaces : 2,
          allowMinus:   false
      });
      </script>
    </div>
  </div>
</div>
<div class="pull-right">
  <button id="cancel" type="button" class="btn btn-warning" data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
  <button type="submit" class="btn btn-primary"><span class="gi gi-pen"></span> Save Changes</button>
</div>