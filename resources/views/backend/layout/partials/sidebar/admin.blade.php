<div class="sidebar" data-color="rose" data-background-color="black" data-image="{{ asset('assets/backend') }}/img/sidebar-1.jpg">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="{{ route('admin.dahsboard.index') }}" class="simple-text logo-mini">
            <img src="{{ asset('assets/backend/img/logo.png') }}" width="30" alt="">
        </a>
        <a href="{{ route('admin.dahsboard.index') }}" class="simple-text logo-normal">
            Rental Mobil
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
            <img src="{{ asset('assets/backend') }}/img/placeholder.jpg" />
            {{-- <img src="{{ asset('assets') }}/img/placeholder.jpg" /> --}}
            </div>
            <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
                <span>
                {{ Auth::user()->name }}
                </span>
            </a>
        
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item {{ Request::is('admin/dashboard*')? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.dahsboard.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p> Halama Utama </p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/user*')? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="material-icons">person</i>
                    <p> User </p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/car*')? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.car.index') }}">
                    <i class="material-icons">directions_car</i>
                    <p> Mobil </p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/rentcar*')? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('admin.rentcar.index') }}">
                   <i class="material-icons">no_crash</i>
                    <p> Rental Mobil </p>
                </a>
            </li>
          
            
            
        </ul>
    </div>
    <div class="sidebar-background"></div>
</div>