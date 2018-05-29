<!DOCTYPE html>
<html lang="en">
  <head>
   @include('adminCoreUI.files.metas')
   @include('adminCoreUI.files.css')
  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">

        <div class="col-md-8">
          <div class="card-group">

          <div class="card text-white bg-primary py-4 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h1>{{$APP_NAME }}</h1> <br><br>  <br>
                        <blockquote >
                          <div class="row">
                            <div class="col-xs-8">
                              <div class="frase text-justify">
                                <p> {{ $Frase }}</p>
                              </div>
                              <small class="frase font-bold pull-right"><b>{{ $Autor }}</b></small>
                            </div>
                            <div class="col-xs-4"></div>
                          </div>
                        </blockquote>
                </div>
              </div>
            </div>

            <div class="card p-4">
              {!! Form::open( ['url'=> route('login'),  ] ) !!}
                <div class="card-body">
                  <h1>Login</h1>
                  <p class="text-muted">Ingresar al sistema</p>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text ">
                        <i class="icon-envelope-open"></i>
                      </span>
                    </div>
                    <input type="text"
                        class       ="{{ $errors->has('email') ? "form-control is-invalid" : "form-control" }}"
                        placeholder ="E-mail"
                        name        ="email"
                        value       ="{{ old('email') }}">
                    {!! $errors->first('email', '<div class="invalid-feedback">
                            <i class="fa  fa-hand-o-right"></i>&nbsp;:message</div>')
                    !!}
                  </div>


                  <div class="input-group mb-4">
                    <div class="input-group-prepend ">
                      <span class="input-group-text">
                        <i class="icon-lock"></i>
                      </span>
                    </div>
                    <input type="password"
                    class       ="{{ $errors->has('password') ? "form-control is-invalid" : "form-control" }}"
                     placeholder="Password" name="password">

                    {!! $errors->first('password', '<div class="invalid-feedback">
                            <i class="fa  fa-hand-o-right"></i>&nbsp;:message</div>')
                    !!}
                  </div>



                  <div class="input-group mb-4">
                    <label class="container-chk"value="" id="remember_me" name='remember_me'>
                      No cerrar mi sesión
                      <input type="checkbox" checked="checked">
                      <span class="checkmark"></span>
                    </label>
                  </div>


                  <div class="row">
                    <div class="col-6">
                      {!! Form::submit('Ingresar', ['class'=>'btn btn-primary px-4']) !!}
                    </div>
                  </div>

                  <br>
                  <div class="row">
                  <div class="col-12 text-justify">
                      <a href="{{ route( 'password.reset.show.form' )}}">No tengo contraseña u olvidé la que tenía. Quiero asignar una para ingreso al sistema.</a><br>
                    </div>
                  </div>

                </div>
              {!! Form::close() !!}
            </div>

          </div>
        </div>
      </div>
    </div>

       <!-- Bootstrap and necessary plugins-->
      @include('adminCoreUI.files.js')
  </body>
</html>
