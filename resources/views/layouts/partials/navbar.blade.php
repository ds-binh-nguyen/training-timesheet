<header class="p-3 bg-light shadow-box">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" 
          id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{!! url(auth()->user()->avatar ?? 'images/avatar.png') !!}" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong>{{ auth()->user()->username }}</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" {{ route('logout.perform') }}>Sign out</a></li>
        </ul>
    </div>
  </div>
</header>
