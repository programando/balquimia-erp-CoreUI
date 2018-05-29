<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">

      <li class="nav-item">
        <a class="nav-link" href="main.html">
          <i class="nav-icon icon-speedometer"></i> Inicio
        </a>
      </li>

      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle collapsed" href="#">
          <i class="nav-icon icon-puzzle"></i> Configuración</a>
          <ul class="nav-dropdown-items">
            <li class="nav-item">
              <a class="nav-link" href="{{route('mstro.lineas.show.form')}}" >
                <i class="nav-icon icon-puzzle"></i> Líneas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('mstro.cargos.show.form')}}" >
                  <i class="nav-icon icon-puzzle"></i> SubLíneas</a>
                </li>
              </ul>
            </li>

            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle collapsed" href="#">
                <i class="nav-icon icon-puzzle"></i> Contabilidad</a>
                <ul class="nav-dropdown-items">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('mstro.cargos.show.form')}}" >
                      <i class="nav-icon icon-puzzle"></i> Opc1</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('mstro.lineas.show.form')}}" >
                        <i class="nav-icon icon-puzzle"></i> Opc1</a>
                      </li>
                    </ul>
                  </li>

                </ul>
      </nav>
      <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>


