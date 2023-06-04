<div class="container-fluid p-0 " >
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
        <a href="{{route('home')}}" class="navbar-brand ml-lg-3">
            <h1 class="m-0 text-uppercase text-primary">Edutech</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{route('home')}}" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="#" class="nav-item nav-link">Courses</a>
                {{-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="detail.html" class="dropdown-item">Course Detail</a>
                        <a href="feature.html" class="dropdown-item">Our Features</a>
                        <a href="team.html" class="dropdown-item">Instructors</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    </div>
                </div> --}}
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            @if (auth()->check())
<div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle btn btn-primary py-2 px-4 d-none d-lg-block rounded" data-toggle="dropdown">{{ auth()->user()->name }}</a>
                <div class="dropdown-menu m-0">
                    <a href="{{ route('dashboard') }}" class="dropdown-item">Panel</a>
                    <a href="{{route('logout')}}" class="dropdown-item">Đăng xuất</a>
                </div>
            </div>
            @else
            <a href="{{route('login')}}" class="btn btn-primary py-2 px-4 d-none d-lg-block rounded">Đăng nhập</a>
            <a href="{{route('register')}}" class="btn btn-primary py-2 px-4 d-none d-lg-block ml-1 rounded">Đăng ký</a>
            @endif



        </div>
    </nav>
</div>
