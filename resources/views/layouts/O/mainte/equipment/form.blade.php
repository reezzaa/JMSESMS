<div class="row">
  <div class="col-md-6">
      <div class="form-group">
      <label for="equiptype">Equipment Type</label> <span class="text-danger">*</span> 
      {!! Form::text('equiptype', null,  ['id'=>'equiptype','class'=>'form-control', 'placeholder'=>'e.g. Excavator, Crane', 'maxlength'=>'45']) !!}
      <span id="duplicate4" class="help-block animation-slideDown">
          Duplicate Material Name
      </span>
      <script>
          $('#equiptype').alphanum({
                  allow :    '-,.()/', // Specify characters to allow
                });
        </script>
    </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
        <label for="equipname">Equipment Name</label> <span class="text-danger">*</span>
        {!! Form::text('equipname',null ,['id'=>'equipname','placeholder'=>'', 'class' => 'form-control', 'maxlength'=>'30']) !!}
        <span id="duplicate" class="help-block animation-slideDown">
          Duplicate Material Name
        </span>
        <script>
          $('#equipname').alphanum({
                  allow :    '-,.()/', // Specify characters to allow
                });
        </script>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="equipkey">Equipment key (<em>identifier</em>)</label> <span class="text-danger">*</span> 
      {!! Form::text('equipkey',null ,['id'=>'equipkey','placeholder'=>'e.g. Serial key', 'class' => 'form-control', 'maxlength'=>'45']) !!}
      <span id="duplicatez3" class="help-block animation-slideDown">
        Duplicate Material Name
      </span>
      <script>
       $('#equipkey').alphanum({
              allow :    '-./', // Specify characters to allow
            });
        
      </script>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="equipleaser">Equipment Leaser </label> <span class="text-danger">*</span> 
      {!! Form::text('equipleaser',null ,['id'=>'equipleaser','placeholder'=>'Leaser', 'class' => 'form-control', 'maxlength'=>'50']) !!}
      <span id="duplicate3" class="help-block animation-slideDown">
        Duplicate Material Name
      </span>
      <script>
        $('#equipleaser').alphanum({
            allow :    '-./', // Specify characters to allow
          });
      </script>
    </div>
  </div>
  
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="equipprice">Status</label> <span class="text-danger">*</span> 
     <select name="rent" id="rent" class="form-control" onchange="hidePrice(this.value)">
       <option value="1">Rented</option>
       <option value="0">Owned</option>
     </select>
      <span id="duplicate3" class="help-block animation-slideDown">
        Duplicate Material Name
      </span>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" id="here" >
      <div id="this">
        <label for="equipprice">Rental Price per Day</label> <span class="text-danger">*</span> 
        <input type="text" id="equipprice" name="equipprice" placeholder="e.g 999999" class="form-control" maxlength="30">
      </div>
      <span id="duplicate3" class="help-block animation-slideDown">
        Duplicate Material Name
      </span>
      <script>
        $('#equipprice').numeric({
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
  <button type="submit" class="btn btn-primary"><span class="gi gi-plus"></span> Add</button>
</div>