                    <div id="addworker_modal" class="modal fade add-spec-modal" tabindex="-1" role="dialog" aria-labelledby="AddSpecModal" aria-hidden="true" data-backdrop="static">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                  <div class="block">
                                    <div class="block-title themed-background">
                                      <div class="block-options pull-right">
                                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                                      </div>
                                      <h3 class="themed-background" style="color:white;"><strong>Add Jobs</strong></h3>
                                    </div>
                                  {!! Form::open(['url'=>'contract/newJob/{{id}}','method'=>'POST','id'=>'frm-newjob']) !!}

                                    <div class="row">
                                      <div class="col-md-12">
                                        <div>
                                              <label for="new_task">Tasks</label> <span class="text-danger">*</span>
                                              <select id="new_task" name="new_task" style="width: 250px;" onchange="findTaskJob(this.value)" class="select-chosen hehe" data-placeholder="Select Jobs">
                                                <option></option>
                                                <option value=""></option>
                                                 @foreach($o_task as $task)
                                                <option value="{{ $task->id }}">{{ $task->ServTask }}
                                                </option>
                                                @endforeach
                                              </select>
                                              <span id="duplicate" class="help-block animation-slideDown">
                                                    Duplicate Material Classification Name
                                              </span>
                                              
                                            </div>
                                      </div>
                                    </div><br>  
                                    <div class="row">
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <div>
                                              <label for="task_job">Jobs Description</label> <span class="text-danger">*</span>
                                              <select id="task_job" name="task_job" style="width: 250px;" onchange="findRPD(this.value)" class="select-chosen hehe" data-placeholder="Select Jobs">
                                                <option></option>
                                                <option value=""></option>
                                                 
                                              </select>
                                              <span id="duplicate" class="help-block animation-slideDown">
                                                    Duplicate Material Classification Name
                                              </span>
                                              <input type="hidden" name="rpd" id="rpd">
                                              <input type="hidden" name="job_name" id="job_name">
                                              
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <div>
                                              <label for="workerqty">Quantity</label> <span class="text-danger">*</span>

                                              {!! Form::text('number',null ,['id'=>'workerqty','placeholder'=>'Qty', 'class' => 'form-control', 'maxlength'=>'30']) !!}
                                               <script>
                                                $('#workerqty').numeric({
                                                    decimalSeparator: ".",
                                                    maxDecimalPlaces : 2,
                                                    allowMinus:   false
                                                });
                                              </script>
                                              <span id="duplicate3" class="help-block animation-slideDown">
                                                    Duplicate Material Classification Name
                                              </span>
                                            </div>
                                          </div>
                                        </div><br>
                                          <div class="col-md-6">
                                          <label for=""> Additional Fee</label>
                                          <select id="addworkfee" name="addworkfee" style="width: 250px;" class="select-chosen hehe" data-placeholder="Choose.." onchange="findFee(this.value)">
                                              <option></option>
                                               @foreach($addfee as $mfee)
                                                <option value="{{ $mfee->id }}">{{$mfee->FeeValue}}% {{ $mfee->FeeDesc }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="wfee">
                                        </div>
                                      </div><br>
                                        
                                       <div class="row">  
                                         <div class="col-md-offset-9">
                                          <button type="submit" class="btn btn-primary btn-alt">Add </button>
                                        </div>
                                       </div>
                                       <br> 
                                    {!!Form::close()!!}
                                      
                                  </div>
                                </div>
                              </div>
                            </div>

                <div id="addmat_modal" class="modal fade add-spec-modal" tabindex="-1" role="dialog" aria-labelledby="AddSpecModal" aria-hidden="true" data-backdrop="static">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                  <div class="block">
                                    <div class="block-title themed-background">
                                      <div class="block-options pull-right">
                                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                                      </div>
                                      <h3 class="themed-background" style="color:white;"><strong>Add Materials</strong></h3>
                                    </div>
                                  {!! Form::open(['url'=>'contract/newMat/{{id}}','method'=>'POST','id'=>'frm-newmat']) !!}

                                    <div class="row">
                                      <div class="col-md-12">
                                        <div>
                                              <label for="new_mtask">Tasks</label> <span class="text-danger">*</span>
                                              <select id="new_mtask" name="new_mtask" style="width: 250px;" onchange="findTaskMat(this.value)" class="select-chosen hehe" data-placeholder="Select Task">
                                                <option></option>
                                                <option value=""></option>
                                                 @foreach($o_task as $mtask)
                                                <option value="{{ $mtask->id }}">{{ $mtask->ServTask }}
                                                </option>
                                                @endforeach
                                              </select>
                                              <span id="duplicate" class="help-block animation-slideDown">
                                                    Duplicate Material Classification Name
                                              </span>
                                              
                                            </div>
                                      </div>
                                    </div><br>  
                                    <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <div>
                                              <label for="task_mat">Material</label> <span class="text-danger">*</span>
                                              <select id="task_mat" name="task_mat" style="width: 250px;" onchange="findMatPrice(this.value)" class="select-chosen hehe" data-placeholder="Select Materials">
                                                <option></option>
                                                <option value=""></option>
                                                 
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
                                              <label for="matprice">Price</label> <span class="text-danger">*</span>

                                              {!! Form::text('number',null ,['id'=>'matprice','placeholder'=>'Price', 'class' => 'form-control', 'maxlength'=>'30' ,'disabled'=>'disabled']) !!}
                                               <script>
                                                $('#matprice').numeric({
                                                    decimalSeparator: ".",
                                                    maxDecimalPlaces : 2,
                                                    allowMinus:   false
                                                });
                                              </script>
                                              <span id="duplicate3" class="help-block animation-slideDown">
                                                    Duplicate Material Classification Name
                                              </span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group">
                                            <div>
                                              <label for="matqty">Quantity</label> <span class="text-danger">*</span>

                                              {!! Form::text('number',null ,['id'=>'matqty','placeholder'=>'Qty', 'class' => 'form-control', 'maxlength'=>'30']) !!}
                                               <script>
                                                $('#matqty').numeric({
                                                    decimalSeparator: ".",
                                                    maxDecimalPlaces : 2,
                                                    allowMinus:   false
                                                });
                                              </script>
                                              <span id="duplicate3" class="help-block animation-slideDown">
                                                    Duplicate Material Classification Name
                                              </span>
                                            </div>
                                          </div>
                                        </div>

                                        <br>
                                          <div class="col-md-6">
                                          <label for=""> Additional Fee</label>
                                          <select id="addmatfee" name="addmatfee" style="width: 250px;" class="select-chosen hehe" data-placeholder="Choose.." onchange="findMFee(this.value)">
                                              <option></option>
                                               @foreach($addfee as $mmfee)
                                                <option value="{{ $mmfee->id }}">{{$mmfee->FeeValue}}% {{ $mmfee->FeeDesc }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="mfee">
                                            <input type="hidden" id="mat_name">

                                        </div>
                                      </div><br>
                                        
                                       <div class="row">  
                                         <div class="col-md-offset-9">
                                          <button type="submit" class="btn btn-primary btn-alt">Add </button>
                                        </div>
                                       </div>
                                       <br> 
                                      {!!Form::close()!!}
                                  </div>
                                </div>
                              </div>
                            </div>

                  <div id="addequip_modal" class="modal fade add-spec-modal" tabindex="-1" role="dialog" aria-labelledby="AddSpecModal" aria-hidden="true" data-backdrop="static">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                  <div class="block">
                                    <div class="block-title themed-background">
                                      <div class="block-options pull-right">
                                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                                      </div>
                                      <h3 class="themed-background" style="color:white;"><strong>Add Equipments</strong></h3>
                                    </div>
                                  {!! Form::open(['url'=>'contract/newEquip/{{id}}','method'=>'POST','id'=>'frm-newequip']) !!}

                                   <div class="row">
                                    <div class="col-md-12">
                                              <label for="new_etask">Tasks</label> <span class="text-danger">*</span>
                                              <select id="new_etask" name="new_etask" style="width: 250px;"  class="select-chosen hehe" data-placeholder="Select Task">
                                                <option></option>
                                                <option value=""></option>
                                                 @foreach($o_task as $etask)
                                                <option value="{{ $etask->id }}">{{ $etask->ServTask }}
                                                </option>
                                                @endforeach
                                              </select>
                                              <span id="duplicate" class="help-block animation-slideDown">
                                                    Duplicate Material Classification Name
                                              </span>
                                              
                                      </div><br><br>
                                          <div class="col-md-6 col-md-offset-1">
                                            <div class="form-group">
                                              <div>
                                                <label for="task_equip">Equipment Name</label> <span class="text-danger">*</span>
                                                <select id="task_equip" name="task_equip" onchange="findEPrice(this.value)" style="width: 250px;" class="select-chosen hehe" data-placeholder="Select Equipment">
                                                  <option></option>
                                                  <option value=""></option>
                                                  @foreach($equip as $equip)
                                              <option value="{{$equip->id}}">{{$equip->EquipName}}</option>
                                              @endforeach
                                                </select>
                                                 <span id="duplicate2" class="help-block animation-slideDown">
                                                      Duplicate Material Classification Name
                                                </span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <div>
                                                <label for="equipprice">Rental Price</label> <span class="text-danger">*</span>
                                                {!! Form::text('text',null ,['id'=>'equipprice','placeholder'=>'0', 'class' => 'form-control', 'maxlength'=>'30','disabled'=>'disabled']) !!}
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                            <input type="hidden" id="equip_name">
                                        
                                       <div class="row">  
                                         <div class="col-md-offset-9">
                                          <button type="submit" class="btn btn-primary btn-alt">Add </button>
                                        </div>
                                       </div>
                                       <br> 
                                      {!!Form::close()!!}
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
                                    <h3 class="themed-background" style="color:white;"><strong>Add Miscellaneous Fee</strong></h3>
                                  </div>
                                  {!! Form::open(['url'=>'contract/newMisc/{{id}}','method'=>'POST','id'=>'frm-newmisc']) !!}
                                    
                                    <!-- <div class="row"> -->
                                      <div class="col-md-9">
                                        <div class="form-group">
                                          <div>
                                            <label for="material">Select </label> <span class="text-danger">*</span>
                                            <select id="rate" name="rate" style="width: 250px;" class="select-chosen" data-placeholder="Select Task">
                                              <option></option>
                                               @foreach($rate as $rate)
                                              <option value="{{$rate->id}}">{{$rate->RateValue}}% {{$rate->RateDesc}}</option>
                                              @endforeach
                                              
                                            </select>
                                            <span id="duplicate" class="help-block animation-slideDown">
                                                  Duplicate Material Classification Name
                                            </span>
                                          </div>
                                        </div>
                                      </div>

                                      
                                    <!-- </div> -->
                                     
                                    <div class="col-md-offset-10">
                                        <button type="submit" class="btn btn-primary btn-alt">Add </button>
                                    </div><br>
                                    <div class="clearfix"></div>
                                    {!!Form::close()!!}
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
                                  {!! Form::open(['url'=>'contract/newExp/{{id}}','method'=>'POST','id'=>'frm-newexp']) !!}
                                    
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
                                        <button type="submit" class="btn btn-primary btn-alt">Add </button>
                                    </div><br>
                                    <div class="clearfix"></div>
                                    {!!Form::close()!!}
                                </div>
                              </div>
                            </div>
                          </div>

