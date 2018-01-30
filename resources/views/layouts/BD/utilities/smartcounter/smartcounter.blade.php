         <div class="block">
            <!-- Horizontal Form Content -->
            
            @forelse($clientID as $clientID)
            <table class="table table-vcenter table-striped table-condensed table-hover">
              <tbody>
                <tr>
                  <td class="text-center">Client No.
                  </td>
                  <td class="text-center">
                      {{ $clientID->strClientIDUtil }}
                  </td>
                </tr>
              </tbody>
            </table>
            @empty
                {!! Form::open(['action'=>'BD\UtilitiesController@storeClientID', 'id'=>'save-clientNoSC','class'=>'form-horizontal form-bordered', 'method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('strClientIDUtil','Client No.',array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-5">
                            {!! Form::text('strClientIDUtil',null, array('class'=>'form-control','placeholder'=>'Client No.')) !!}
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-alt btn-info"><span class="fa fa-check"></span></button>
                            <button type="reset" class="btn btn-alt btn-warning"><span class="gi gi-restart"></span></button>
                        </div>
                    </div>
                {!! Form::close() !!}
            @endforelse   

            @forelse($contractID as $contractID)
            <table class="table table-vcenter table-striped table-condensed table-hover">
              <tbody>
                <tr>
                  <td class="text-center">Contract No.
                  </td>
                  <td class="text-center">
                      {{ $contractID->strContractIDUtil }}
                  </td>
                </tr>
              </tbody>
            </table>
            @empty
                {!! Form::open(['action'=>'BD\UtilitiesController@storeContractID', 'id'=>'save-contractNoSC','class'=>'form-horizontal form-bordered', 'method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('strContractIDUtil','Contract No.',array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-5">
                            {!! Form::text('strContractIDUtil',null, array('class'=>'form-control','placeholder'=>'Contract No.')) !!}
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-alt btn-info"><span class="fa fa-check"></span></button>
                            <button type="reset" class="btn btn-alt btn-warning"><span class="gi gi-restart"></span></button>
                        </div>
                    </div>
                {!! Form::close() !!}
            @endforelse  


            @forelse($invoiceID as $invoiceID)
            <table class="table table-vcenter table-striped table-condensed table-hover">
              <tbody>
                <tr>
                  <td class="text-center">Invoice No.
                  </td>
                  <td class="text-center">
                      {{ $invoiceID->strInvoiceIDUtil }}
                  </td>
                </tr>
              </tbody>
            </table>
            @empty
                {!! Form::open(['action'=>'BD\UtilitiesController@storeInvoiceID', 'id'=>'save-invoiceNoSC','class'=>'form-horizontal form-bordered', 'method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('strInvoiceIDUtil','Invoice No.',array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-5">
                            {!! Form::text('strInvoiceIDUtil',null, array('class'=>'form-control','placeholder'=>'Invoice No.')) !!}
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-alt btn-info"><span class="fa fa-check"></span></button>
                            <button type="reset" class="btn btn-alt btn-warning"><span class="gi gi-restart"></span></button>
                        </div>
                    </div>
                {!! Form::close() !!}
            @endforelse 
            @forelse($orID as $orID)
            <table class="table table-vcenter table-striped table-condensed table-hover">
              <tbody>
                <tr>
                  <td class="text-center">OR No.
                  </td>
                  <td class="text-center">
                      {{ $orID->strOrIDUtil }}
                  </td>
                </tr>
              </tbody>
            </table>
            @empty
                {!! Form::open(['action'=>'BD\UtilitiesController@storeOrID', 'id'=>'save-orNoSC','class'=>'form-horizontal form-bordered', 'method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('strOrIDUtil','Or No.',array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-5">
                            {!! Form::text('strOrIDUtil',null, array('class'=>'form-control','placeholder'=>'Or No.')) !!}
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-alt btn-info"><span class="fa fa-check"></span></button>
                            <button type="reset" class="btn btn-alt btn-warning"><span class="gi gi-restart"></span></button>
                        </div>
                    </div>
                {!! Form::close() !!}
            @endforelse 

          
            <!-- END Horizontal Form Content -->
        </div>