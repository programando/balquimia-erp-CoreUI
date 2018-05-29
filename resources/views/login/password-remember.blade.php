<!DOCTYPE html>
<html>

<head>
 @include('adminCoreUI.files.metas')
 @include('adminCoreUI.files.css')
</head>

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
     <div class="col-sm-8">
       @include('alerts.errors')
     </div>
     <div class="card text-white bg-primary py-4 d-md-down-none" style="width:45%">
      <div class="card-body text-center">
        <h1>{{$APP_NAME }}</h1> <br>
        <div class="text-justify">
          <p class="login-box-msg">
          A través de este proceso enviaremos las indicaciones para que, desde su cuenta de correo electrónico, pueda asignar una nueva contraseña.</p>

          {!! Form::open( ['url'=> route('reset-password'),  ] ) !!}

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
            {!! $errors->first('email', '<div class="invalid-feedback text-white">
              <i class="fa  fa-hand-o-right"></i>&nbsp;:message</div>')
              !!}
            </div>
            <br>
            <div class="row">
              <div class="col-12">
                {!! Form::submit('Enviar correo electrónico', ['class'=>'btn btn-warning px-4 pull-right']) !!}
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

