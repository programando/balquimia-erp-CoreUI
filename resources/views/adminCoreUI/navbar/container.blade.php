 <header class="app-header navbar">
      @include('adminCoreUI.navbar.logo')
      @include('adminCoreUI.navbar.top-menu')
      <ul class="nav navbar-nav ml-auto">
        @include('adminCoreUI.navbar.notifications')
        @include('adminCoreUI.navbar.user-acount')
      </ul>
      <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
      </button>
</header>
