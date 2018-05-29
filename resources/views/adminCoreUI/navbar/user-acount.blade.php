        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="img/avatars/6.jpg" alt="admin@bootstrapmaster.com">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Usuario(a)</strong>
            </div>

            <a class="dropdown-item" href="#">
              <i class="fa fa-envelope-o"></i> Mensajes
              <span class="badge badge-success">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-tasks"></i> Tareas
              <span class="badge badge-danger">42</span>
            </a>

            <div class="dropdown-header text-center">
              <strong>Configuración</strong>
            </div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-user"></i> Perfil</a>
            <div class="divider"></div>

            <a class="dropdown-item" href="{{ route('cerrar-sistema') }}">
              <i class="fa fa-lock"></i> Cerrar Sistema</a>
          </div>
        </li>
