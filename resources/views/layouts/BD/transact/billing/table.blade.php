 <table class="table table-striped table-borderless table-hover">
                              <thead>
                              <tr>
                                <th class="text-center">Task</th>
                                <th class="text-center">From</th>
                                <th class="text-center">To</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Progress</th>
                                <th class="text-center">Incurrences</th>
                                <th class="text-center"></th>
                              </tr>
                              </thead>
                              <tbody>
                                @foreach($tasktable as $t)

                              <tr>
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
                                    ₱ {{ $t ->total}}
                                </td>
                                <td class="text-center">
                                     {{ $t ->progress}} %
                                </td>
                                <td class="text-center">
                                     
                                </td>
                                <td class="text-center">
                                  <button class="btn btn-alt btn-info" data-toggle="tooltip" data-placement="top" data-original-title="View"><i class="gi gi-eye_open"></i></button>
                                  <button class="btn btn-alt btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Add Skill"><i class="fa fa-lightbulb-o"></i></button>
                                  <button class="btn btn-alt btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Add Material"><i class="fa fa-cubes"></i></button>
                                  <button class="btn btn-alt btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Add Equipment"><i class="gi gi-blacksmith"></i></button>
                                  </td>
                              </tr>
                                @endforeach
                              
                              </tbody>
                            </table>