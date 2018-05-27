<!DOCTYPE html>

<html lang="es">
  <head>
   @include('adminCoreUI.files.metas')
   @include('adminCoreUI.files.css')
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
     @include('adminCoreUI.navbar.container')
    <div class="app-body">
        @include('adminCoreUI.sidebar-left.container')
      <main class="main">
        <!-- Breadcrumb
          @include('adminCoreUI.central-content.breadcrumb')
-->

        <div class="container-fluid" style="margin-top: 20px;">
          <div class="animated fadeIn">
            {{-- Contenido principal --}}
            <div class="row">
                <h1> Contenido principal</h1>
            </div>

          </div>

        </div>
      </main>
           @include('adminCoreUI.sidebar-right.container')
    </div>

    {{--  @include('adminCoreUI.footer.container')  --}}



    <!-- Bootstrap and necessary plugins-->
     @include('adminCoreUI.files.js')

  </body>
</html>
