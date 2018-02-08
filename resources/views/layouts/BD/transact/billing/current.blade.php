 <div class="block" id="current">
                          <table class="table table-borderless">
                          @foreach($utilities as $utilities)

                            <td class="col-md-2">
                                  <img src="{{url('images', $utilities->strCompanyLogo)}}" style="width:100px;" class="col-md-offset-3">
                            </td>
                            <td class="col-md-8 text-center">
                               
                                            <strong style="font-family: 'Bodoni Black';font-size: 200%;"> {{ $utilities->strCompanyName }}</strong>  
                                        <br>
                                            <b>{{ $utilities->strCompanyAddress }}
                                            <br>
                                            {{ $utilities->strGeneralManagerName }} - Proprietor
                                          <br>
                                            Email: {{ $utilities->strCompanyEmail }}
                                          <br>
                                            VAT Reg. TIN {{ $utilities->strCompanyTIN }}</b>
                            </td>
                            
                              @endforeach
                            <td class="col-md-2"><br><br>
                              <p style="font-size: 150%;" id="invid"><b>{{$invoiceid}}</b></p>
                            </td>
                          </table>
                          <p class="text-center"><b style="font-family: 'Bodoni Black';font-size: 150%;">SERVICE INVOICE</b></p>
                          @foreach($down as $down)
                          <table class=" table-borderless">
                            <tr>
                              <td class="col-md-4"><h5><b>Customer: {{$down->strCompClientName}}</b></h5></td>
                              <td class="col-md-4"><h5><b>Date: {{\Carbon\Carbon::parse($date)->toFormattedDateString()}}</b></h5></td>
                              <td></td>

                            </tr>
                            <tr>
                              <td class="col-md-8"><h5><b>Address: {{$down->strCompClientAddress}} {{$down->strCompClientCity}}, {{$down->strCompClientProv}}</b></h5></td>
                              <td ></td>
                              <td ></td>

                            </tr>
                            <tr>
                              <td class="col-md-4"><h5><b>TIN: {{$down->strCompClientTIN}} </b></h5></td>
                              <td class="col-md-4"><h5><b>Terms: {{$down->term}} {{$down->termdate}}</b></h5></td>
                                <input type="hidden" id="term" name='term' value="{{$down->term}}">
                                <input type="hidden" id="termdate" name="termdate" value="{{$down->termdate}}">
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
                              <td style="height: 300px" class="text-center">
                                <br><br>
                                @if($down->active==0)
                                <h4><b>30 % Downpayment for the {{$down->name}}</b></h4>
                                <input type="hidden" id="desc" name="desc" value="30 % Downpayment for the {{$down->name}}">
                                @endif

                              </td>
                              <td style="height: 500px" class="text-center">
                                <br><br>
                                <h4>PHP {{$down->initialtax}}</h4>

                              </td>
                            </tr>
                            <tr>
                              <td style="text-align: right"> TOTAL AMOUNT DUE</td>
                              <td class="text-center"> <b>PHP {{$down->initialtax}}</b></td>
                            </tr>
                            <tr>
                              <td style="text-align: right;"> VALUE ADDED TAX</td>
                              <td class="text-center"> <b>PHP {{$down->taxValue}}</b></td>
                            </tr>
                            <tr>
                              <td style="text-align: right;"> <h4>TOTAL </h4></td>
                              <td class="text-center"> <h4><b>PHP {{$down->down_amount}}</b></h4></td>

                            </tr>

                          </table>
                          <table class="table table-borderless">
                            <tr>
                              <td class="col-md-10" style="text-align: right;"><b>Prepared By:</b></td>
                              <td class="col-md-2"> {{Auth::user()->fname}} {{Auth::user()->lname}}</td>
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
                           
                          @endforeach 
                        <br>
                        <input type="hidden" id="amount" name="amount" value="{{$down1->amount}}">
                        <input type="hidden" id="subtotal" name="subtotal" value="{{$down1->initialtax}}">

                        </div>
                        <div class="clearfix">
                                <div class="btn-group pull-right">
                                 
                                <button type="submit" id="bill" class="btn btn-primary"><i class="fa fa-angle-right"></i> Bill </a>
                                </div>
                            </div>