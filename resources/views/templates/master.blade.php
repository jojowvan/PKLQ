    @include('templates.partials.header')
    
    <!-- Page Header -->
    @yield('header')
    

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        
        @yield('content')

        </div>
      </div>
    </div>

    @include('templates.partials.footer')
    
