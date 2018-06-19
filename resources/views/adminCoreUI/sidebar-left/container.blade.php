<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">

      <li class="nav-item">
        <router-link :to="{name:'inicio'}" class="nav-link"> <i class="nav-icon icon-speedometer"></i> Inicio</router-link>
      </li>

      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle collapsed" href="#"><i class="nav-icon icon-puzzle"></i>
            Configuración
        </a>
        <ul class="nav-dropdown-items">
           <li class="nav-item">
              <router-link :to="{name: 'cargos'}"     class="nav-link opc"> Cargos </router-link>
              <router-link :to="{name: 'medidas'}"    class="nav-link opc"> Unds. Medida </router-link>
              <router-link :to="{name: 'lineas'}"    class="nav-link opc"> Líneas </router-link>
              <router-link :to="{name: 'sublineas'}"  class="nav-link opc"> Sub-Líneas </router-link>
            </li>
          </ul>
        </li>

      </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
  </div>


