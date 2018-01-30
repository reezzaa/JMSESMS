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
        {!! Form::label('strCompClientEmail','Email') !!}
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
        {!! Form::text('strCompClientProv',null, array('class'=>'form-control','placeholder'=>'Province')) !!}
      </div>
    </div>
  </div>
</div>