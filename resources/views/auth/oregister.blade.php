<!DOCTYPE html>
<html>
<head>
  @include('layouts.reg')
   <style>
          html, body{
            background-color: white;
                 color: black;
                font-family: 'Candara', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
          }
             .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            #duplicate2{
            color: red;
            }

        </style>
</head>
<body>
  
</body>

        <!-- <img src="img/login_bg.png" alt="Login Full Background" class="full-bg animation-pulseSlow"> -->
        <div class="flex-center position-ref full-height animation-fadeInRight">
            <div class="login-title text-center">
                <h1> <strong>OPERATIONS</strong><br><br> <strong>Register</strong></h1>
              <form class="form-horizontal form-borderless" method="POST" id="form-validation" action="{{ route('o.register.submit') }}">
                        {{ csrf_field() }}

                                 <fieldset class="row">
                                     <div class="form-group col-md-4">
                                    <label for="fname"> First Name <span class="text-danger">*</span> </label>
                                    <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter First Name">
                                    <span id="duplicate2" class="help-block animation-slideDown">
                                      <!-- Duplicate  First name -->
                                    </span>
                                    <script>
                                      $('#fname').alpha();
                                    </script>
                                  </div>
                                   <div class="form-group col-md-4">
                                    <label for="mname"> Middle Name </label>
                                    <input type="text" id="mname" name="mname" class="form-control" placeholder="Enter Middle Name">
                                    
                                    <span id="duplicate2" class="help-block animation-slideDown">
                                      <!-- Duplicate name -->
                                    </span>
                                    <script>
                                      $('#mname').alpha();
                                    </script>
                                  </div>
                                   <div class="form-group col-md-4">
                                    <label for="lname"> Last Name <span class="text-danger">*</span> </label>
                                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Enter Last Name">
                                    <span id="duplicate2" class="help-block animation-slideDown">
                                      <!-- Duplicate  name -->
                                    </span>
                                    <script>
                                      $('#lname').alpha();
                                    </script>
                                  </div>
                                  <div class="form-group col-md-2">
                                    <label for="lname"> Suffix</label>
                                    <input type="text" id="suffix" name="suffix" class="form-control" placeholder="Jr., III">
                                  </div>
                                  </fieldset><hr>
                                   <fieldset>
                                <div class="form-group">
                                  <label for="email" class="col-md-3 text-center">Email address <span class="text-danger">*</span> </label>
                                 <div class="col-md-9">
                                      <input type="text" id="email" name="email" class="form-control" placeholder="test@example.com">
                                 </div>
                                  <span id="duplicate2" class="help-block animation-slideDown">
                                    Duplicate Email Address 
                                  </span>
                                  
                                </div>
                                 </fieldset>
                                 <hr>
                                 <fieldset>
                                     <div class="form-group">
                                    <label for="username" class="col-md-3 text-center">User Name <span class="text-danger">*</span> </label>
                                    <div class="col-md-9">
                                      <input type="text" id="val_username" name="val_username" class="form-control" placeholder="Your username..">
                                    </div>
                                    
                                  </div>
                                 </fieldset><br>
                                <fieldset>
                                   <div class="form-group">
                                   <label for="password" class="col-md-3 text-center">Password <span class="text-danger">*</span> </label>
                                  <div class="col-md-9">
                                     <input type="password" name="val_password" class="form-control " id="val_password" maxlength="30" placeholder="Choose a crazy one..">
                                  </div>
                                   <span id="duplicate2" class="help-block animation-slideDown">
                                    Duplicate password 
                                  </span>
                                  
                                </div>
                                </fieldset><br>
                                <fieldset>
                                   <div class="form-group">
                                   <label for="confirmpassword" class="col-md-3 text-center">Confirm Password <span class="text-danger">*</span> </label>
                                  <div class="col-md-9">
                                    <input type="password" name="val_confirm_password" class="form-control " id="val_confirm_password" maxlength="30" placeholder="and confirm it">
                                  </div>
                                   <span id="duplicate2" class="help-block animation-slideDown">
                                    Duplicate password 
                                  </span>
                                  
                                </div>
                                </fieldset><br>
                                 <div class="col-xs-8 col-xs-offset-6">
                                  <a href="{{ route('o.login')}}" type="btn" class="btn btn-primary btn-lg">
                                        Go back to Login
                                    </a>
                                     <button type="submit" class="btn btn-primary btn-lg">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>


    <script >
        $(document).ready(function(){
      

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
       $('span#duplicate2').hide();
          /////////////////////////////////////////////////////
          //clear on focus
          
          $('#username').focus(function(){
            $('span#duplicate2').hide();
          });
          $('#password').focus(function(){
            $('span#duplicate2').hide();
          });
          $('#email').focus(function(){
            $('span#duplicate2').hide();
          });

          //////////////////////////////////////////////////////////////
         //insert data
         $('#form-validation').on('submit', function(e){
          e.preventDefault();
          var ddata = $("#form-validation").serialize();
          console.log(ddata);
        var $form = $(this);
        if(! $form.valid()) return false;
        {
          $.ajax({
            type : 'post',
            url  : 'register',
            data : ddata,
            dataType: 'json',
            success:function(data){
              swal("Success","Register Successful!", "success");
              window.location ='login';
            },
            error:function(data){
                $('#email').focus(function(){
                    $('span#duplicate2').show();
                  });
            }
          })
        }
          
        });
         

  });
  </script>
</html