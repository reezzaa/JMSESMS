        
        <div class="panel  setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title"></h3>
            </div>
            <div class="panel-body">
              <div class="form-group col-md-10">
                    <label class="control-label">Client</label><span class="text-danger">*</span> 

                        <select name="client" id="client" required="required" class="form-control select-chosen">
                        <option value=""></option>
                        @foreach($client as $client)
                        <option value="{{$client->strCompClientID}}">{{$client->strCompClientName}}</option>
                        @endforeach
                    </select>

                    </div>
                   
                <div class="form-group col-md-12">
                    <label class="control-label">Contract Name <span class="text-danger">*</span></label>
                    <input maxlength="200" id="contractname" name="contractname" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                </div>
                <div class="form-group col-md-5">
                    <label class="control-label">Date Signed <span class="text-danger">*</span></label>
                      <input type="text" id="datesigned" name="datesigned" class="form-control input-datepicker text-center" required="required" data-date-format="yyyy-mm-dd" >
                          
                </div>
                <div class="form-group col-md-7">
                    <label class="control-label" for="example-daterange1">Contract Validity Period <span class="text-danger">*</span></label>
                    <div class="input-group input-daterange" data-date-format="yyyy-mm-dd">
                            <input type="text" id="from" name="from" class="form-control text-center val" placeholder="From" required="required">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input type="text" id="to" name="to" class="form-control text-center val" placeholder="To" required="required">
                    </div>
                  
                </div>
                <hr>
                <div class="form-group col-md-12">
                    <label class="control-label">Service Location <span class="text-danger">*</span></label>
                    <input maxlength="200" id="location" name="location " type="text" required="required" class="form-control" placeholder="Enter Service Location" />
                </div>
                <hr>
                <div class="form-group col-md-6">
                    <label class="control-label">Contract Order Number <span class="text-danger">*</span></label>
                    <input maxlength="45" id="co" name="co " type="text" required="required" class="form-control" placeholder="Enter Contract or Job Order Number" />
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label">Date Received <span class="text-danger">*</span></label>
                    <input maxlength="45" id="co_date" name="co_date " type="text" required="required" class="form-control input-datepicker text-center" placeholder="CO date received" data-date-format="yyyy-mm-dd" />
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel  setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title"></h3>
            </div>
            <div class="panel-body">
                 

                <table id="" class="table table-vcenter table-striped table-borderless table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">Service</th>
                      <th class="text-center" >Task</th>
                      <th class="text-center" >Cost</th>
                      <th class="text-center" >Duration</th>
                      <th class="text-center" >Starting Date</th>
                      <th></th>
                    </tr>
                  </thead>
                 <tbody id="tbltask">
                    
                 </tbody>
                </table>
                <hr>
                <table id="" class="table table-vcenter table-striped table-borderless table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">Expenses</th>
                      <th class="text-center">Cost</th>
                      <th></th>
                    </tr>
                  </thead>
                 <tbody id="tblexp">
                    
                 </tbody>
                </table>
                <hr>
                <table id="" class="table table-vcenter table-striped table-borderless table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">Miscellaneous Fees </th>
                      <th class="text-center">Value</th>
                      <th></th>
                    </tr>
                  </thead>
                 <tbody id="tblfees">
                    
                 </tbody>
                </table>
                
                 <div id="addtask_modal" class="modal fade add-spec-modal" tabindex="-1" role="dialog" aria-labelledby="AddSpecModal" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="block">
                                  <div class="block-title themed-background">
                                    <div class="block-options pull-right">
                                        <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                                    </div>
                                    <h3 class="themed-background" style="color:white;"><strong>Add Task</strong></h3>
                                  </div>
                                    <div class="row">
                                      <div class="col-md-offset-1">
                                        <span class="fa fa-filter"> </span>  Filter by:
                                      </div><br>
                                      <div class="col-md-9 col-md-offset-1">
                                        <div class="form-group">
                                          <div>
                                            <label for="service">Service</label>
                                            <select id="service" name="service" onchange="findTask(this.value)" style="width: 250px;" class="select-chosen" data-placeholder="Filter by Service">
                                              <option></option>
                                              <option value=""></option>
                                              @foreach($service as $service)
                                              <option value="{{$service->id}}">{{$service->ServiceOffName}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      
                                    </div>
                                    <!-- <div class="row"> -->
                                      <div class="col-md-9">
                                        <div class="form-group">
                                          <div>
                                            <label for="material">Task</label> <span class="text-danger">*</span>
                                            <select id="task" name="task" onchange="findPrice(this.value)" style="width: 250px;" class="select-chosen" data-placeholder="Select Task">
                                              <option></option>
                                               @foreach($task as $task)
                                              <option value="{{$task->id}}">{{$task->ServTask}}</option>
                                              @endforeach
                                            </select>
                                            <span id="duplicate" class="help-block animation-slideDown">
                                                  Duplicate Material Classification Name
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <div>
                                            <label for="price">Cost</label>
                                            {!! Form::text('text',null ,['id'=>'price','placeholder'=>'0', 'class' => 'form-control', 'maxlength'=>'30','disabled'=>'disabled']) !!}
                                          </div>
                                        </div>
                                      </div>
                                    <!-- </div> -->
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <div>
                                            <label for="duration">Duration</label>
                                            {!! Form::text('text',null ,['id'=>'duration','placeholder'=>'0', 'class' => 'form-control', 'maxlength'=>'30','disabled'=>'disabled']) !!}
                                          </div>
                                        </div>
                                      </div>
                                       <div class="form-group col-md-8">
                                          <label class="control-label" for="example-daterange1">Starting Date <span class="text-danger">*</span></label>
                                          <!-- <div class="input-group input-daterange" data-date-format="yyyy-mm-dd"> -->
                                                  <input type="text" id="task_from" name="task_from" class="form-control text-center val input-datepicker" placeholder="From" required="required" data-date-format="yyyy-mm-dd">
                                                 <!--  <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                                                  <input type="text" id="task_to" name="task_to" class="form-control text-center val" placeholder="To" required="required"> -->
                                          <!-- </div> -->
                                        
                                      </div>
                                   <hr>
                                    <div class="col-md-offset-10">
                                        <a id="addtask" class="btn btn-primary btn-alt">Add </a>
                                    </div><br>
                                    <div class="clearfix"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="addexp_modal" class="modal fade add-spec-modal" tabindex="-1" role="dialog" aria-labelledby="AddSpecModal" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="block">
                                  <div class="block-title themed-background">
                                    <div class="block-options pull-right">
                                        <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                                    </div>
                                    <h3 class="themed-background" style="color:white;"><strong>Add Fees and Expenses </strong></h3>
                                  </div>
                                    
                                    <!-- <div class="row"> -->
                                      <div class="col-md-9">
                                        <div class="form-group">
                                          <div>
                                            <label for="material">Select </label> <span class="text-danger">*</span>
                                            <select id="misc" name="misc" onchange="findExpPrice(this.value)" style="width: 250px;" class="select-chosen" data-placeholder="Select Task">
                                              <option></option>
                                               @foreach($misc as $misc)
                                              <option value="{{$misc->id}}">{{$misc->MiscDesc}}</option>
                                              @endforeach
                                              
                                            </select>
                                            <span id="duplicate" class="help-block animation-slideDown">
                                                  Duplicate Material Classification Name
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <div>
                                            <label for="price">Cost</label>
                                            {!! Form::text('text',null ,['id'=>'miscprice','placeholder'=>'0', 'class' => 'form-control', 'maxlength'=>'30','disabled'=>'disabled']) !!}
                                          </div>
                                        </div>
                                      </div>
                                    <!-- </div> -->
                                     
                                   <hr>
                                    <div class="col-md-offset-10">
                                        <a id="addmisc" class="btn btn-primary btn-alt">Add </a>
                                    </div><br>
                                    <div class="clearfix"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="addrate_modal" class="modal fade add-spec-modal" tabindex="-1" role="dialog" aria-labelledby="AddSpecModal" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="block">
                                  <div class="block-title themed-background">
                                    <div class="block-options pull-right">
                                        <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                                    </div>
                                    <h3 class="themed-background" style="color:white;"><strong>Add Fees and Expenses </strong></h3>
                                  </div>
                                    
                                    <!-- <div class="row"> -->
                                      <div class="col-md-9">
                                        <div class="form-group">
                                          <div>
                                            <label for="material">Select </label> <span class="text-danger">*</span>
                                            <select id="rate" name="rate" onchange="findRateValue(this.value)" style="width: 250px;" class="select-chosen" data-placeholder="Select Task">
                                              <option></option>
                                               @foreach($rate as $rate)
                                              <option value="{{$rate->id}}">{{$rate->RateDesc}}</option>
                                              @endforeach
                                              
                                            </select>
                                            <span id="duplicate" class="help-block animation-slideDown">
                                                  Duplicate Material Classification Name
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <div>
                                            <label for="value">Value</label>
                                            {!! Form::text('text',null ,['id'=>'value','placeholder'=>'0', 'class' => 'form-control', 'maxlength'=>'30','disabled'=>'disabled']) !!}
                                          </div>
                                        </div>
                                      </div>
                                    <!-- </div> -->
                                     
                                   <hr>
                                    <div class="col-md-offset-10">
                                        <a id="addrate" class="btn btn-primary btn-alt">Add </a>
                                    </div><br>
                                    <div class="clearfix"></div>
                                </div>
                              </div>
                            </div>
                          </div>
              <div class="pull-right">
                  <a id="" class="btn btn-md btn-default addtaskBtn" data-placement="top" data-toggle="tooltip" title="Add Task"><i class="fa fa-plus"></i> Add Task</a> 
                  <a id="" class="btn btn-md btn-default addexpBtn" data-placement="top" data-toggle="tooltip" title="Add Miscellaneous Fees & Expenses"><i class="fa fa-plus"></i> Add Expenses</a> 
                  <a id="" class="btn btn-md btn-default addrateBtn" data-placement="top" data-toggle="tooltip" title="Add Miscellaneous Fees & Expenses"><i class="fa fa-plus"></i> Add Fees</a> 
                <button class="btn btn-primary nextBtn" type="button">Next</button>
              </div>
            </div>
           
        </div>
        
        <div class="panel  setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title"></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                  <div class="form-group col-md-6">
                        <label for="strFormPayment" class="col-sm-4 text-center">Mode of Payment</label>         

                  <div class="col-sm-12 form-inline">
                       <select id="progress" name="progress[]" class="select-chosen" data-placeholder="Choose.." style="width: 250px;" multiple>
                            @foreach($mode as $mode)
                            <option value="{{$mode->ModeValue}}">{{$mode->ModeValue}} %</option>
                            @endforeach
                        </select>
                      </div>
                </div>
                  <div class="form-group col-md-4">
                  <div>
                   <div class="col-sm-12 form-inline form-group">
                    <label for="term">Terms of Payment <span class="text-danger">*</span></label><br> 
                     <input type="text"  name="term" class="form-control" required="required" id="term" maxlength="10" placeholder="0" style="text-align:right;" >
                      <select name="termdate" id="termdate" class='form-control'>
                       <option value="days">days</option>
                       <option value="month">month</option>
                       <option value="year">year</option>
                     </select>
                    <script>
                      $('#term').numeric(
                        {
                         allowMinus:   false,
                         allowThouSep: false,
                         allowDecSep: false
                        });
                    </script>
                    <br></div>
                  </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="vat">VAT <span class="text-danger">*</span></label><br> 
                  <select name="vat" id="vat" class="form-control select-chosen" onchange="computetax()">
                    <option value=""></option>
                    @foreach($tax as $tax)
                    <option value="{{$tax->id}}">{{$tax->TaxValue}} </option>
                    @endforeach
                  </select>
                </div>
                
                </div>
              <table class="table table-vcenter">
                                    <tr class="">
                                        <td colspan="4" class="text-right"><span class="h4">SUBTOTAL</span></td>
                                        <td colspan="4" class="text-right"><span class="h4" id="subtotal" >0.00</span></td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="4" class="text-right"><span class="h4">VAT RATE</span></td>
                                        <td colspan="4" class="text-right"><span class="h4" id="vatrate">0.00</span></td>
                                        <input type="hidden" id="vatrate_val">
                                    </tr>
                                    <tr class="">
                                        <td colspan="4" class="text-right"><span class="h4">VAT DUE</span></td>
                                        <td colspan="4" class="text-right"><span class="h4" id="vatdue">0.00</span></td>
                                    </tr>
                                    <tr class="active">
                                        <td colspan="4" class="text-right"><span class="h3"><strong>TOTAL DUE</strong></span></td>
                                        <td colspan="4" class="text-right"><span class="h3" id="totaldue">0.00<strong></strong></span></td>
                                    </tr>
                </table>
              
                <button class="btn btn-success pull-right" type="submit">Save</button>
            </div>
        </div>