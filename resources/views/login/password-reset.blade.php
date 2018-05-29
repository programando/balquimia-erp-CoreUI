<!DOCTYPE html>
<html>
  <head>
 @include('adminCoreUI.files.metas')
 @include('adminCoreUI.files.css')
  </head>

  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">

       <div class="card text-white bg-primary py-4 d-md-down-none" style="width:45%">
          <div class="card-body text-center">
            <h1>{{$APP_NAME }}</h1>
             <h5>{{ trans('_app.pass_remember_title') }}</h5>
             <div class="text-justify">
                <p> Registre y confirme su contraseña para realizar los cambios en el sistema de información</p>
               {!! Form::open( ['url'=> route( 'update-password' ), 'method'=>'POST' ] ) !!}
                    {!! Form::hidden('token',$token ) !!}   {!! Form::hidden('email',$email ) !!}
                      <div class="input-group mb-4">
                        <div class="input-group-prepend ">
                          <span class="input-group-text">
                            <i class="icon-lock"></i>
                          </span>
                        </div>
                        <input type="password"
                                class       ="{{ $errors->has('password') ? "form-control is-invalid " : "form-control" }}"
                                placeholder="contraseña" name="password">

                        {!! $errors->first('password', '<div class="invalid-feedback text-white">
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
                               class       ="{{ $errors->has('password') ? "form-control is-invalid " : "form-control" }}"
                              placeholder="confirme la contraseña" name="password_confirmation">

                        {!! $errors->first('password_confirmation', '<div class="invalid-feedback text-white">
                                <i class="fa  fa-hand-o-right"></i>&nbsp;:message</div>')
                        !!}
                      </div>
                      <br>
                    <div class="row">
                        <div class="col-12">
                          {!! Form::submit('Actualizar contraseña', ['class'=>'btn btn-success px-4 pull-right']) !!}
                        </div>
                      </div>
                {!! Form::close() !!}
          </div>
      </div>
    </div>
</div>
</div>
@include('adminCoreUI.files.js')
</body>
</html>





