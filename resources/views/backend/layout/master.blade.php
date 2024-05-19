<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/backend') }}/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('assets/backend') }}/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
		@yield('title') | Rental Mobil
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  @include('backend.layout.partials.css')
</head>

<body class="">
  <div class="wrapper ">
    @include('backend.layout.partials.sidebar.'.\Str::slug(\Auth::user()->role->name))
    <div class="main-panel">
      <!-- Navbar -->
    	@include('backend.layout.partials.navbar')
      
      <!-- End Navbar -->
      <div class="content">
        @yield('content')
      </div>
			@include('backend.layout.partials.footer')
    </div>
  </div>
  {{-- @include('backend.layout.partials.plugin') --}}
  <!--   Core JS Files   -->
  @include('backend.layout.partials.js')  
</body>

</html>