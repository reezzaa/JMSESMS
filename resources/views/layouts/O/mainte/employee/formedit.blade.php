<div class="row">
  <div class="col-md-3 col-md-offset-1">
    <div class="form-group">
      <div>
        <label for="EmpFname">First Name</label> <span class="text-danger">*</span> 
        <input type="text" id="EmpFname" name="EmpFname" class="form-control" placeholder="First Name" required maxlength="50">
      </div>
      <script>
        $('#EmpFname').alpha({
            allow : '-' });
      </script>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <div>
        <label for="EmpMname">Middle Name </label>
        <input type="text" id="EmpMname" name="EmpMname" class="form-control" placeholder="Middle Name" maxlength="50">
      </div>
      <script>
          $('#EmpMname').alpha({
              allow :    '-' });
      </script>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <div>
        <label for="EmpLname">Last Name </label> <span class="text-danger">*</span> 
        <input type="text" id="EmpLname" name="EmpLname" class="form-control" placeholder="Last Name" required maxlength="50">
      </div>
      <script>
          $('#EmpLname').alpha({
              allow :    '-.'});
      </script>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <div>
        <label for="EmpContactNo">Contact Number</label> <span class="text-danger">*</span> 
        <div>
          <div class="col-md-5">
            <select id="contacttype" class="form-control" onchange="changeContType(this.value)">
              <option value="" disabled selected hidden>-------</option>
              <option value="Landline">Landline</option>
              <option value="Phone">Phone</option>
            </select>
          </div>
          <div class="input-group">      
            <input type="text" id="EmpContactNo" name="EmpContactNo" class="form-control" placeholder="Contact No." required maxlength="16">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
          </div>
        </div>
      </div>
      <script>
        function changeContType(val)
        {
          if(val == 'Phone')
          {
            $('#EmpContactNo').val('');
            $('#EmpContactNo').mask('+63-999-999-9999');
          }
          else if(val == 'Landline')
          {
            $('#EmpContactNo').val('');
            $('#EmpContactNo').mask('999-9999');
          }
        }
      </script>
    </div>
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <div>
        <label for="EmpEmail">Email</label>
        <div class="input-group">
          <input type="email" id="EmpEmail" name="EmpEmail" class="form-control" placeholder="Email" maxlength="50">
          <span class="input-group-addon"><i class="hi hi-envelope"></i></span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <div>
        <label for="EmpCity">City</label> <span class="text-danger">*</span> 
        <div class="input-group">
            <input type="text" id="EmpCity" name="EmpCity" class="form-control" placeholder="City" required maxlength="50">
            <span class="input-group-addon"><i class="gi gi-road"></i></span>
        </div>
        <script>
          $('#EmpCity').alpha();
        </script>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <div>
        <label for="EmpProvince">Province</label> <span class="text-danger">*</span> 
        <div class="input-group">
            <input type="text" id="EmpProvince" name="EmpProvince" class="form-control" placeholder="Province" required maxlength="50">
            <span class="input-group-addon"><i class="gi gi-road"></i></span>
        </div>
        <script>
          $('#EmpProvince').alpha();
        </script>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-10">
      <div class="form-group">
        <div>
          <label class="col-md-4 control-label" for="example-chosen-multiple">Specialization <span class="text-danger">*</span> </label>
          <div class="col-md-6">
              <select id="example-chosen-multiple" name="specs[]" class="select-chosen" data-placeholder="Specialization.." style="width: 250px;" multiple>
              @foreach($special as $key)
                  <option value="{{ $key->id }}"> {{ $key->SpecDesc }}
                  </option>
              @endforeach
              </select>
              <span id="duplicate" class="help-block animation-slideDown">
                Select specialization for this employee.
              </span>
          </div>
        </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-offset-9">
      <button type="button" id="resets" class="btn btn-warning"><span class="gi gi-remove_2"></span> Reset</button>
      <button type="submit" class="btn btn-primary"><span class="gi gi-plus"></span> Add</button>
  </div>
</div>