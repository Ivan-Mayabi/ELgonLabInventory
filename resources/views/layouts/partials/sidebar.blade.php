<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="light">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="{{ URL::to('/') }}" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="{{ asset('favicon.png') }}"
        alt="{{env('APP_NAME')}} Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span style="font-size:48px;" class="brand-text fw-light waterfall-regular">{{env('APP_NAME')}}</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
      >
        {{-- Dashboard --}}
        <li class="nav-item">
          <a href="{{ URL::to('/') }}" class="nav-link {{ request()->is('/') ? 'active' : ""; }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Home</p>
          </a>
        </li>     
        
          </a>
        </li>
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->