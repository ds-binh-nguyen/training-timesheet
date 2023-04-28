<header class="p-3 bg-light">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end">
        <img class="img-avt" src="{!! url(auth()->user()->avatar ?? 'images/avatar.png') !!}" alt="avatar" title="{{auth()->user()->username}}">
        <div class="text-end">
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-secondary me-2">Logout</a>
        </div>
    </div>
  </div>
</header>

<style>
  .img-avt {
    max-width: 35px;
    margin-right: 10px;
    border-radius: 16px;
  }
</style>
 