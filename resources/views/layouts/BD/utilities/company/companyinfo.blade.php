    @forelse($utilities as $utilities)
            <div class="block">
                <!-- Basic Form Elements Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <a href="javascript:void(0)" class="btn btn-sm btn-alt btn-primary editCompInfo" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                        <!-- Modal Edit -->
                        <div id="edit_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="block">
                                  <div class="block-title themed-background">
                                    <div class="block-options pull-right">
                                        <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                                    </div>
                                    <h3 class="themed-background" style="color:white;"><strong>Edit Company Information</strong></h3>
                                  </div>
                                  {!! Form::model($utilities,['action'=>['BD\UtilitiesController@update', $utilities->intCompanyUtilID], 'id'=>'save-computil','class'=>'form-horizontal', 'method'=>'PATCH', 'files' => true]) !!}
                                    @include('layouts.BD.utilities.company.form2')
                                    <div class="form-group form-actions">
                                        <div class="col-md-9 col-md-offset-3">
                                          {!! Form::submit('Submit',['class'=>'btn btn-alt btn-success']) !!}
                                          {!! Form::button('Reset',['type'=>'reset','class'=>'btn btn-alt btn-warning']) !!}
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                {!! Form::close() !!}
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <!-- END Form Elements Title -->
                <p class="well well-sm">
                    <strong>Company Logo</strong> <br>
                        <img src="{{url('images', $utilities->strCompanyLogo)}}" style="width:80px;" class="col-md-offset-3">
                </p>
                <p class="well well-sm">
                    <strong>Company Name</strong> <br>
                    {{ $utilities->strCompanyName }}
                </p>
                <p class="well well-sm">
                    <strong>Registered TIN</strong> <br>
                    {{ $utilities->strCompanyTIN }}
                </p>
                <p class="well well-sm">
                    <strong>General Manager</strong> <br>
                    {{ $utilities->strGeneralManagerName }}
                </p>
                <p class="well well-sm">
                    <strong>Company Email</strong> <br>
                    {{ $utilities->strCompanyEmail }}
                </p>
                <p class="well well-sm">
                    <strong>Address</strong> <br>
                    {{ $utilities->strCompanyAddress }}
                </p>
            </div>

    @empty

            <div class="block">

                <!-- END Form Elements Title -->

                <!-- Basic Form Elements Content -->
                {!! Form::open(['url'=>'o/utilities', 'id'=>'save-computil','class'=>'form-horizontal', 'method'=>'POST', 'files' => true]) !!}
                    @include('layouts.O.utilities.company.form')
                    <div class="form-group form-actions">
                        <div class="col-md-9 col-md-offset-3">
                          {!! Form::submit('Submit',['class'=>'btn btn-alt btn-success']) !!}
                          {!! Form::button('Reset',['type'=>'reset','class'=>'btn btn-alt btn-warning']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                <!-- END Basic Form Elements Content -->
            </div>
    @endforelse 
    <script>
  $(document).ready( function() {
 $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }); 
     $('.editCompInfo').click(function(){
        $('html,body').animate({
              scrollTop: 0
          }, 500);
        $('#edit_modal').modal('show');
      });

     ////
      $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
      
    });
    function readURL(input) {
        document.getElementById("img-upload").removeAttribute("class");
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#strCompanyLogo").change(function(){
        readURL(this);
    });   
  });


</script>
