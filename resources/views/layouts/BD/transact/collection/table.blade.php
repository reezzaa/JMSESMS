 <table class="table table-striped table-bordered table-hover">
                              <thead>
                              <tr>
                                <th class="text-center">Invoice No.</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Date Billed</th>
                                <th class="text-center">Due Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                              </tr>
                              </thead>
                              <tbody>
                               @foreach($colle as $t)

                              <tr>
                                <td class="text-center">
                                    {{ $t ->inv}}
                                </td>
                                <td class="text-center">
                                    @foreach($detail as $d)
                                      @if($t->inv==$d->serv)
                                        {{$d->desc}} <br>
                                      @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                   @foreach($detail as $d)
                                      @if($t->inv==$d->serv)
                                        ₱ {{$d->total}} <br>
                                      @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                     {{\Carbon\Carbon::parse($t->date)->toFormattedDateString()}}
                                </td>
                                <td class="text-center">
                                     {{\Carbon\Carbon::parse($t->duedate)->toFormattedDateString()}}
                                </td>
                                <td class="text-center">
                                    @if($t->status==0)
                                     <label class="label label-danger">Unpaid</label>
                                    @else
                                      @if($t->isclear==0)
                                        <label class="label label-success">Paid</label>
                                        <label class="label label-default">Not Clear</label>
                                      @else
                                        <label class="label label-success">Paid</label>
                                        <label class="label label-info">Clear</label>
                                      @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                  @if($t->status==0)
                                        @if($t->duedate >= $t->s_date)
                                         <label class="label label-default"></label>
                                        @else
                                         <label class="label label-danger">Overdue</label>
                                        @endif
                                    @else
                                     @if($t->isclear==0)
                                        <span></span> 
                                      @else
                                         @if($t->duedate >= $t->date)
                                          {{$t->OrID}} <br>
                                       <p style="color: green"> {{\Carbon\Carbon::parse($t->p_date)->toFormattedDateString()}}</p>
                                        @else
                                           {{$t->OrID}} <br>
                                       <p style="color: red"> {{\Carbon\Carbon::parse($t->p_date)->toFormattedDateString()}}</p>
                                        @endif
                                      @endif
                                      
                                    @endif
                                  
                                </td>
                                <td class="text-center">
                                  @if($t->status==0)
                                      <a href="{{ route('bd.process',$t->inv)}}" class="btn btn-default" >Process</a>
                                    @else
                                      @if($t->isclear==0)
                                        @if($t->validity > $date)
                                        <button class="btn btn-default upd" value="{{$t->OrID}}">Update</button> 
                                        @elseif($t->validity <= $date)
                                        <button class="btn btn-default upd"  value="{{$t->OrID}}" >Update</button> 
                                        @endif  
                                      @else
                                        {{$t->cheque_no}}
                                      @endif
                                    @endif
                                  </td>
                              </tr>
                                @endforeach
                              </tbody>
                            </table>