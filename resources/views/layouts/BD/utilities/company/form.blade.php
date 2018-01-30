<div class="form-group">
    <div style="height:100px;">
        <div class="center">
          <img id="img-upload" style="width:100px;display:block;margin:auto;"/>
        </div>
    </div>
    {!! Form::label('strCompanyLogo','Company Logo',array('class'=>'col-md-4 control-label')) !!}
    <div class="col-md-8">
        {!! Form::file('strCompanyLogo', array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('strCompanyName','Company Name',array('class'=>'col-md-4 control-label')) !!}
    <div class="col-md-8">
        {!! Form::text('strCompanyName',null, array('class'=>'form-control','placeholder'=>'Company Name')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('strCompanyTIN','Registered TIN',array('class'=>'col-md-4 control-label')) !!}
    <div class="col-md-8">
        {!! Form::text('strCompanyTIN',null, array('class'=>'form-control','placeholder'=>'Company TIN')) !!}
    </div>
    <script>
        $('#strCompanyTIN').mask('999-999-999-999');
    </script>
</div>
<div class="form-group">
    {!! Form::label('strGeneralManagerName','General Manager Name',array('class'=>'col-md-4 control-label')) !!}
    <div class="col-md-8">
        {!! Form::text('strGeneralManagerName',null, array('class'=>'form-control','placeholder'=>'GM Name')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('strCompanyAddress','Address',array('class'=>'col-md-4 control-label')) !!}
    <div class="col-md-8">
        {!! Form::text('strCompanyAddress',null, array('class'=>'form-control','placeholder'=>'Full Address')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('strCompanyEmail','Email',array('class'=>'col-md-4 control-label')) !!}
    <div class="col-md-8">
        {!! Form::email('strCompanyEmail',null, array('class'=>'form-control','placeholder'=>'Email')) !!}
    </div>
</div>