<div class="row">
  <div class="col-md-2">
    <div class="center">
      <img id="img-upload" style="width:100px;display:block;margin:auto;" />
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <div>
        {!! Form::label('strCompClientImage','Client Logo') !!}
        {!! Form::file('strCompClientImage', array('class'=>'form-control')) !!}
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <div>
        {!! Form::label('strCompClientName','Client Company Name') !!}<span class="text-danger">*</span>
        {!! Form::text('strCompClientName',null, array('class'=>'form-control','placeholder'=>'Company Name')) !!}
      </div>
       <script>
        $('#strCompClientName').alpha({
            allow : '-/' });
      </script>
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <div>
        {!! Form::label('strCompClientTIN','Client TIN') !!}<span class="text-danger">*</span>
        {!! Form::text('strCompClientTIN',null, array('class'=>'form-control','placeholder'=>'Client TIN')) !!}
      </div>
      <script>
        $('#strCompClientTIN').mask('999-999-999-999');
      </script>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4 col-md-offset-2">
    <div class="form-group">
      <div>
        {!! Form::label('strCompClientRepresentative','Representative Name') !!}<span class="text-danger">*</span>
        {!! Form::text('strCompClientRepresentative',null, array('class'=>'form-control','placeholder'=>'Representative Name')) !!}
      </div>
       <script>
        $('#strCompClientRepresentative').alphanum({
            allow : '-/' });
      </script>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <div>
        {!! Form::label('strCompClientPosition','Representative Position') !!}<span class="text-danger">*</span>
        {!! Form::text('strCompClientPosition',null, array('class'=>'form-control','placeholder'=>'Representative Position')) !!}
      </div>
      <script>
        $('#strCompClientPosition').alpha({
            allow : '-/' });
      </script>
    </div>
  </div>
  
</div>
<div class="row">
  <div class="col-md-4 col-md-offset-2">
    <div class="form-group">
      <div>
        {!! Form::label('strCompClientContactNo','Contact No') !!}<span class="text-danger">*</span>
        {!! Form::text('strCompClientContactNo',null, array('class'=>'form-control','placeholder'=>'Contact No')) !!}
      </div>
      <script>
        $('#strCompClientContactNo').mask('+63-999-999-9999');
      </script>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <div>
        {!! Form::label('strCompClientEmail','Email') !!}<span class="text-danger">*</span>
        {!! Form::email('strCompClientEmail',null, array('class'=>'form-control','placeholder'=>'Email')) !!}
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4 col-md-offset-1">
    <div class="form-group">
      <div>
        {!! Form::label('strCompClientAddress','Address') !!}<span class="text-danger">*</span>
        {!! Form::text('strCompClientAddress',null, array('class'=>'form-control','placeholder'=>'Address')) !!}
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <div>
        {!! Form::label('strCompClientCity','City') !!}<span class="text-danger">*</span>
        {!! Form::text('strCompClientCity',null, array('class'=>'form-control','placeholder'=>'City')) !!}
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <div>
          
        {!! Form::label('strCompClientProv','Province') !!}<span class="text-danger">*</span>
        <select name="strCompClientProv" id="strCompClientProv" class="form-control select-chosen">
          <option value="Region I">Region I</option>
          <option value="Region II">Region II</option>
          <option value="Region III">Region III</option>
          <option value="NCR">NCR</option>
          <option value="Region IV-A">Region IV-A</option>
          <option value="Region IV-B">Region IV-B</option>
          <option value="Region V">Region V</option>
          <option value="Region VI">Region VI</option>
          <option value="Region VII">Region VII</option>
          <option value="Region VIII">Region VIII</option>
          <option value="Region IX">Region IX</option>
          <option value="Region X">Region X</option>
          <option value="Region XI">Region XI</option>
          <option value="Region XII">Region XII</option>
          <option value="Region XIII">Region XIII</option>
          <option value="Region ARMM">Region ARMM</option>
        </select>
      </div>
    </div>
  </div>
</div>