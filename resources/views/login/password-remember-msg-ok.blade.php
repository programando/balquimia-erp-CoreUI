<!DOCTYPE html>
<html>
<head>

 @include('adminCoreUI.files.metas')
 @include('adminCoreUI.files.css')

</head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 CentrarCol">
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> {{ trans('_app.pass_remember_title_msg_ok') }}</h4>
            <p class="text-justify">{!! trans('_app.pass_remember_text_ok',['email'=>$email]) !!}</p>
          </div>

          <a  class ="btn btn-success pull-right" href="{{ route('login') }}"> {{ trans('_app.btn_cerrar') }}</a>
        </div>
      </div>
    </div>
  </body>
</html>
