<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
  <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

        @role('Super|Admin')
          @role('Super|Admin')
          <li class="nav-item">
            <a class="nav-link text-secondary px-0 align-middle" href="{{ route('home') }}">
              <i class="bi bi-speedometer2" style="font-size: 1.5rem;"></i>
              <h5 class="d-none d-md-inline">{{ __('Dashboard') }}</h5>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-secondary px-0 align-middle" href="{{ route('services.index') }}">
              <i class="bi bi-stars" style="font-size: 1.5rem;"></i>
              <h5 class="d-none d-md-inline">{{ __('Services') }}</h5>
            </a>
          </li>

        @endrole
        @endrole

        @role('User')
          <li class="nav-item">
            <a class="nav-link text-secondary px-0 align-middle" href="{{ route('home') }}">
              <i class="bi bi-speedometer2" style="font-size: 1.5rem;"></i>
              <h5 class="d-none d-md-inline">{{ __('Dashboard') }}</h5>
            </a>
          </li> 
        @endrole
    </ul>
  </div>
</div>

