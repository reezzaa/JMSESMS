 <div class="block" id="current">
                          <table class="table table-borderless">
                          <td class="col-md-2">
                                  
                            </td>
                            <td class="col-md-8 text-center">
                               
                                            <strong style="font-family: 'Bodoni Black';font-size: 200%;">MACHINE SHOP & ENGINEERING SERVICES</strong>  
                                        <br>
                                           
                            </td>
                            <td class="col-md-2"><br><br>
                              <p style="font-size: 150%;" id="invid"><b>{{$invoiceid}}</b></p>
                            </td>
                          </table>
                          <p class="text-center"><b style="font-family: 'Bodoni Black';font-size: 150%;">SERVICE INVOICE</b></p>
                          <table class=" table-borderless">
                            <tr>
                              <td class="col-md-4"><h5><b>Customer: {{$prog->strCompClientName}}</b></h5></td>
                              <td class="col-md-4"><h5><b>Date: {{\Carbon\Carbon::parse($date)->toFormattedDateString()}}</b></h5></td>
                              <td></td>

                            </tr>
                            <tr>
                              <td class="col-md-8"><h5><b>Address: {{$prog->strCompClientAddress}} {{$prog->strCompClientCity}}, {{$prog->strCompClientProv}}</b></h5></td>
                              <td ></td>
                              <td ></td>

                            </tr>
                            <tr>
                              <td class="col-md-4"><h5><b>TIN: {{$prog->strCompClientTIN}} </b></h5></td>
                              <td class="col-md-4"><h5><b>Terms: {{$prog->term}} {{$prog->termdate}}</b></h5></td>
                                <input type="hidden" id="term" name='term' value="{{$prog->term}}">
                                <input type="hidden" id="termdate" name="termdate" value="{{$prog->termdate}}">
                              <td class="col-md-4"></td>

                            </tr>
                          </table>
                          
                          <br>
                          <table class="table table-bordered">
                            <tr>
                              <th class="col-md-8 text-center">DESCRIPTION</th>
                              <th class="col-md-4 text-center">AMOUNT</th>
                            </tr>
                            <tr>
                              <td style="height: 300px" >
                                <br><br>
                                <h4 class="text-center"><b> {{$prog->Mode}} % Progress Billing for the {{$prog->name}}</b></h4>
                                <input type="hidden" id="desc" name="desc" value="{{$prog->Mode}} % Progress Billing for the {{$prog->name}}">
                                <br><h5 class="col-md-offset-1"><b>THIS PAYMENT: {{$prog->Mode}} % </b> PHP {{$prog->initial}}</h5>
                                <br><h5 class="col-md-offset-1"><b> LESS: 10% Retention </b> PHP {{$prog->retValue}}</h5>
                                <br><h5 class="col-md-offset-1"><b> LESS: 30% Recoupment </b> PHP {{$prog->recValue}}</h5>
                                
                              </td>
                              <td style="height: 500px" class="text-center">
                                <br><br>
                                <h4>PHP {{$prog->pb_amount}}</h4>

                              </td>
                            </tr>
                            <tr>
                              <td style="text-align: right"> TOTAL AMOUNT DUE</td>
                              <td class="text-center"> <b>PHP {{$prog->initialtax}}</b></td>
                            </tr>
                            <tr>
                              <td style="text-align: right;"> VALUE ADDED TAX</td>
                              <td class="text-center"> <b>PHP {{$prog->taxValue}}</b></td>
                            </tr>
                            <tr>
                              <td style="text-align: right;"> <h4>TOTAL </h4></td>
                              <td class="text-center"> <h4><b>PHP {{$prog->pb_amount}}</b></h4></td>

                            </tr>

                          </table>
                          <table class="table table-borderless">
                            <tr>
                              <td class="col-md-10" style="text-align: right;"><b>Prepared By:</b></td>
                              <td class="col-md-2"></td>
                            </tr>
                            <tr>
                              <td class="col-md-10" style="text-align: right;"><b>Received By:</b></td>
                              <td class="col-md-2"></td>
                            </tr>
                            <tr>
                              <td class="col-md-10" style="text-align: right;"><b>Date Received:</b></td>
                              <td class="col-md-2"></td>
                            </tr>
                          </table>
                          <br>
                           
                        <br>
                        <input type="hidden" id="amount" name="amount" value="{{$prog1->amount}}">
                        <input type="hidden" id="subtotal" name="subtotal" value="{{$prog1->initialtax}}">

                        </div>
                        <div class="clearfix">
                                <div class="btn-group pull-right">
                                 
                                <button type="submit" id="bill" class="btn btn-primary"><i class="fa fa-angle-right"></i> Bill </a>
                                </div>
                            </div>