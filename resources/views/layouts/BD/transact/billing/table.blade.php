 <table class="table table-striped table-borderless table-hover">
                              <thead>
                              <tr>
                                <th class="text-center"><input type="checkbox" id="checkall"></th>
                                <th class="text-center">Task</th>
                                <!-- <th class="text-center">From</th>
                                <th class="text-center">To</th> -->
                                <th class="text-center">Description</th>
                                <th class="text-center">Service Amount</th>
                                <!-- <th class="text-center">Incurrences</th> -->
                                <!-- <th class="text-center">Actions</th> -->
                              </tr>
                              </thead>
                              <tbody>
                                @foreach($tasktable as $t)
                              
                              <tr>
                              {!!Form::open(['url'=>'billing','method'=>'PUT','id'=>'frm-incur'])!!}

                                 @if($t->active==1 )
                                  <td class="text-center">
                                    @foreach($incur as $incur1)
                                      @if($t->task_id == $incur1->t_id)
                                        @if($incur1->status==null)
                                        <span></span>                                        
                                       @elseif($incur1->status==1)
                                       <span></span>
                                       @elseif($incur1->status==0)
                                        <input type="checkbox" class="check" name="check[]" id="check" value="{{$incur1->i_id}}">
                                       @else
                                       <span></span>
                                        @endif

                                      @endif
                                    @endforeach
                                 </td>
                                   @else
                                   <td class="text-center" >
                                    @foreach($incur as $incur1)
                                      @if($t->task_id == $incur1->t_id)
                                        @if($incur1->status==1)
                                       <span></span>
                                       @else
                                     <input type="checkbox" class="check" name="check[]" id="check" value="{{$incur1->i_id}}">
                                        @endif
                                      @endif
                                    @endforeach
                                   </td>
                                  
                                @endif
                              
                                <td class="text-center">
                                    {{ $t ->ServTask}}
                                </td>
                                <td class="text-center">
                                  @foreach($incur as $incur1)
                                      @if($t->task_id == $incur1->t_id)
                                        @if($incur1->method == 'S')
                                        <p> {{ $incur1->desc}}</p>
                                        @else
                                        <b>PROGRESS:  {{ $t ->percent}} %</b>
                                        @break
                                        @endif
                                      @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                   @if($t->active==1)
                                    @foreach($incur as $incur1)
                                      @if($t->task_id == $incur1->t_id)
                                        @if($incur1->status == 1)
                                        <p>₱ {{ $incur1->incur_amount}}</p>
                                        @else
                                        ₱ {{ $t->s_total}}
                                        @endif
                                        @break
                                      @endif
                                    @endforeach
                                   @elseif($t->active==0)
                                   @foreach($incur as $incur0)
                                      @if($t->task_id == $incur0->t_id)
                                        @if($incur0->status == 1)
                                        <p >₱ {{ $incur0->incur_amount}}</p>
                                        @else
                                        ₱ {{ $t->s_total}}
                                        @endif
                                        @break
                                      @endif
                                    @endforeach
                                  @elseif($t->active==2)
                                   @foreach($incur as $incur2)
                                      @if($t->task_id == $incur2->t_id)
                                        @if($incur2->status == 1)
                                        <p >₱ {{ $incur2->incur_amount}}</p>
                                        @else
                                        ₱ {{ $t->s_total}}
                                        @endif
                                        @break
                                      @endif
                                    @endforeach
                                  

                                   @endif

                                   
                                </td>
                                
                                <!-- <td class="text-center">
                                    @foreach($incur as $incure)
                                      @if(($t->task_id == $incure->t_id) )
                                        @if($incure->status == 0)
                                        <b>₱ {{ $incure->incur_amount}}</b>
                                        @endif
                                      @endif
                                    @endforeach
                                </td> -->
                                <!-- <td class="text-center">
                                   <a href="{{ route('stock.show',$t->task_id)}}" class="btn btn-default btn-alt"> Adjust Stocks</a>
                                </td> -->
                                
                              </tr>
                                @endforeach
                                @foreach($incurtable as $ic)
                              
                              <tr>
                                 @if($ic->status==1)
                                  <td class="text-center">
                                 </td>
                                   @else
                                    @if($ic->status == 0)   
                                   <td class="text-center" >
                                     <input type="checkbox" class="check" name="check[]" id="check" value="{{$ic->i_id}}">
                                   </td>
                                   @else
                                   <td></td>
                                   
                                   @endif
                                @endif
                              
                                <td class="text-center">
                                    {{ $ic ->ServTask}}
                                </td>
                                <td class="text-center">
                                     {{ $ic ->desc}} 
                                </td>
                                <td class="text-center">
                                 ₱ {{$ic->amount}}
                                </td>
                                
                              
                                <!-- <td class="text-center">
                                   <a href="{{ route('stock.show',$ic->TaskID)}}" class="btn btn-default btn-alt"> Adjust Stocks</a>
                                </td> -->
                                
                              </tr>
                                @endforeach
                              {!!Form::close()!!}
                              
                              </tbody>
                            </table>