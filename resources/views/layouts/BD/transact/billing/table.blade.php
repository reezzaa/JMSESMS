 <table class="table table-striped table-borderless table-hover">
                              <thead>
                              <tr>
                                <th class="text-center"><input type="checkbox" id="checkall"></th>
                                <th class="text-center">Task</th>
                                <th class="text-center">From</th>
                                <th class="text-center">To</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Progress</th>
                                <th class="text-center">Incurrences</th>
                              </tr>
                              </thead>
                              <tbody>
                                @foreach($tasktable as $t)
                              
                              <tr>
                                 @if($t->active==1)
                                  <td class="text-center">
                                 </td>
                                   @else
                                    @if($t->method == 'A')   
                                   <td class="text-center" style="background: #DAE8F2">
                                     <input type="checkbox" class="check"  value="{{$t->serv_id}}">
                                   </td>
                                   @else
                                    <td class="text-center" style="background: #FFD1CC">
                                   <input type="checkbox" class="check"  value="{{$t->serv_id}}">
                                 </td>
                                   @endif
                                @endif
                              
                                <td class="text-center">
                                    {{ $t ->ServTask}}
                                </td>
                                <td class="text-center">
                                    {{\Carbon\Carbon::parse($t ->task_from)->toFormattedDateString()}}
                                </td>
                                <td class="text-center">
                                    {{\Carbon\Carbon::parse($t ->task_to)->toFormattedDateString()}}

                                </td>
                                <td class="text-center">
                                   @if($t->active==1)
                                    @foreach($incur as $incur1)
                                      @if($t->task_id == $incur1->t_id)
                                        @if($incur1->status == 1)
                                        <p>₱ {{ $incur1->paidamount}}</p>
                                        @else
                                        ₱ {{ $t->s_total}}
                                        @endif
                                      @endif
                                    @endforeach
                                   @elseif($t->active==0)
                                   @foreach($incur as $incur0)
                                      @if($t->task_id == $incur0->t_id)
                                        @if($incur0->status == 1)
                                        <p >₱ {{ $incur0->paidamount}}</p>
                                        @else
                                        <b>₱ {{ $t->s_total}}</b>
                                        @endif
                                      @endif
                                    @endforeach
                                  @elseif($t->active==2)
                                   @foreach($incur as $incur2)
                                      @if($t->task_id == $incur2->t_id)
                                        @if($incur2->status == 1)
                                        <p >₱ {{ $incur2->paidamount}}</p>
                                        @else
                                        <b>₱ {{ $t->s_total}}</b>
                                        @endif
                                      @endif
                                    @endforeach
                                   @endif
                                   
                                </td>
                                <td class="text-center">
                                     {{ $t ->percent}} %
                                </td>
                                <td class="text-center">
                                    @foreach($incur as $incure)
                                      @if(($t->task_id == $incure->t_id) )
                                        @if($incure->status == 0)
                                        <b>₱ {{ $incure->incur_amount}}</b>
                                        @endif
                                      @endif
                                    @endforeach
                                </td>
                                
                              </tr>
                                @endforeach
                              
                              </tbody>
                            </table>