<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="{{ asset('css/portofolio.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('icons/branding.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!-- Home Component Start -->

    <section class="Home-Page">

        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-md fixed-top bg-light shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html">Minur</a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item me-4">
                            <a class="nav-link text-center" aria-current="page" href="/">Home</a>
                        </li>
                        @if ($profiles->count() === 1)
                            <li class="nav-item me-4">
                                <a class="nav-link text-center" href="#about">About</a>
                            </li>
                        @endif
                        @if ($skills->count() >= 1)
                            <li class="nav-item me-4">
                                <a class="nav-link text-center" href="#skills">Skills</a>
                            </li>
                        @endif
                        <li class="nav-item me-4">
                            <a class="nav-link text-center" href="#services">Services</a>
                        </li>
                        @if ($projects->count() >= 1)
                            <li class="nav-item me-4">
                                <a class="nav-link text-center" href="#projects">Projects</a>
                            </li>
                        @endif
                        @if ($profiles->count() === 1)
                            <li class="nav-item">
                                <a class="nav-link text-center" href="#contact">Contact</a>
                            </li>
                        @endif

                    </ul>
                </div>
                <ul class="nav-contact-icon ms-auto">
                    @if ($contact->count() >= 1 && $contact->first()->akun_instagram !== '')
                        <a href="https://www.instagram.com/{{ $contact->first()->akun_instagram }}/" target="blank"><i
                                class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if ($contact->count() >= 1 && $contact->first()->akun_github !== '')
                        <a href="https://github.com/{{ $contact->first()->akun_github }}" target="blank"><i
                                class="fa-brands fa-github"></i></a>
                    @endif
                </ul>
            </div>
        </nav>

        <!-- Navbar End -->

        @if ($sliders->count() >= 1)
            <!-- Carousel Component Start -->
            <div id="carouselExampleControls" class="carousel slide slider-home " data-bs-ride="carousel">
                <div class="carousel-inner">
                    @if ($sliders->count() > 1)
                        @php
                            $randomIndex = rand(0, count($sliders) - 1);
                        @endphp
                        @foreach ($sliders as $key => $slider)
                            <div class="carousel-item @if ($key === $randomIndex) active @endif">
                                <img src="{{ asset('storage/' . $slider->gambar) }}" class="d-block w-100">
                            </div>
                        @endforeach
                    @elseif ($sliders->count() == 1)
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $sliders->first()->gambar) }}" class="d-block w-100">
                        </div>
                    @endif
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif

        <!-- Carousel Component End -->
    </section>

    <!-- Home Component Start -->

    <!-- About Component Start -->

    @forelse ($profiles as $profile)
        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="background-img d-flex justify-content-center align-items-center">
                            <img src="{{ asset('storage/' . $profile->gambar) }}" alt="" class="">
                        </div>
                    </div>
                    <div class="col-md-6 ps-md-5 side-about-info">
                        <h1 class="about-header fw-bold">About Me</h1>
                        <div class="text-light my-5 lh-1">{!! $profile->bio !!}</div>
                        <ul class="about-info mt-5">
                            <li class="d-flex">
                                <p class="fw-bold">Name:</p>
                                <p>{{ $profile->nama }}</p>
                            </li>
                            <li class="d-flex">
                                <p class="fw-bold">Date of birth:</p>
                                <p>{{ $profile->tanggal_lahir }}</p>
                            </li>
                            <li class="d-flex">
                                <p class="fw-bold">Address:</p>
                                <p>{{ $profile->alamat }}</p>
                            </li>
                            <li class="d-flex">
                                <p class="fw-bold">Email:</p>
                                <p>{{ $profile->email }}</p>
                            </li>
                            <li class="d-flex">
                                <p class="fw-bold">Phone:</p>
                                <p>{{ $profile->first()->nomor_hp }}</p>
                            </li>
                        </ul>
                        <div class="d-flex gap-3">
                            <a href="#hire-me" class="hire-btn mt-4">HIRE ME</a>
                            <a href="#cv" class="cv-btn mt-4">DOWNLOAD CV</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @empty
    @endforelse

    <!-- About Component End -->

    <!-- Skills Component Start -->
    @if ($skills->count() >= 1)
        <section id="skills">
            <div class="container">
                <div class="row text-center mb-5">
                    <h3 class="skills-header-1 fw-semibold">Why Choose Me</h3>
                    <h1 class="skills-header-2 fw-bold">My Experience Area</h1>
                </div>
                <div class="row">
                    @foreach ($skills as $skill)
                        <div class="col-md-6 px-4">
                            <ul class="experience-items left">
                                <li class="experience-item">
                                    <div class="experience-info d-flex justify-content-between ">
                                        <p class="name fw-semibold">{{ $skill->nama }}</p>
                                        <div class="skill fw-semibold">{{ $skill->tingkat }}%</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar rounded-end" role="progressbar"
                                            style="width: {{ $skill->tingkat }}%;"
                                            aria-valuenow="{{ $skill->tingkat }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Skills Component End -->

    <!-- Services Component Start -->

    <section id="services">
        <div class="container">
            <div class="row text-center">
                <h4 class="header-services-1">WHAT I DO</h4>
                <h1 class="header-services-2">Services</h1>
            </div>
            <div class="row mt-5">
                <div class="col-md-4 text-center">
                    <div class="card-services">
                        <div class="services-icon m-auto">
                            <img src="{{ asset('icons/App Developing.png') }}" alt="">
                        </div>
                        <p class="name-services">APP DEVELOPING</p>
                        <p class="description-services">Membuat Aplikasi Android dengan menggunakan Framework
                            Flutter.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="card-services">
                        <div class="services-icon m-auto">
                            <img src="{{ asset('icons/web-design.png') }}" alt="">
                        </div>
                        <p class="name-services">SERVER MANAGEMENT</p>
                        <p class="description-services">Menginstall server dengan system operasi Ubuntu dan CentOS,
                            konfigurasi Webserver NGINX dan APACHE, Konfigurasi Load Balancer NGINX</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="card-services">
                        <div class="services-icon m-auto">
                            <img src="{{ asset('icons/web-developer.png') }}" alt="">
                        </div>
                        <p class="name-services">WEB DEVELOPER</p>
                        <p class="description-services">Membuat Website dengan menggunkan Framework Laravel dan
                            Codeigniter.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Component End -->

    <!-- Projects Component Start -->

    @if ($projects->count() >= 1)
        <section id="projects">
            <div class="container">
                <div class="row text-center">
                    <h1 class="header-project mb-5">Our Project</h1>
                </div>
            </div>
            <div class="container-projects">
                @foreach ($projects as $project)
                    <div class="card-project">
                        <img src="{{ asset('storage/' . $project->gambar) }}">
                        <div class="overlay">
                            <h1 class="header-overlay">{{ $project->nama }}</h1>
                            <div class="info-project">
                                <span class="date-project">
                                    <ion-icon name="today"></ion-icon>{{ $project->tahun_dibuat }}
                                </span>
                                <a href="{{ $project->link }}" target="blank" class="btn-preview">Live Preview</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Projects Component End -->

    <!-- Contact Component Start -->

    @forelse ($profiles as $profile)
        <section id="contact" class="py-5">
            <div class="container">
                <div class="row text-center">
                    <h1 class="contact-header fw-bold">Contact Me</h1>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card-contact text-center mt-5">
                            <div class="img-contact m-auto">
                                <ion-icon name="call-outline" class="icon"></ion-icon>
                            </div>
                            <div class="header-card-contact">
                                Contact Number
                            </div>
                            <p class="info-card-contact">
                                {{ $profile->nomor_hp }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-contact text-center mt-5">
                            <div class="img-contact m-auto">
                                <ion-icon name="location-outline" class="icon"></ion-icon>
                            </div>
                            <div class="header-card-contact">
                                Address
                            </div>
                            <p class="info-card-contact">
                                {{ $profile->alamat }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-contact text-center mt-5">
                            <div class="img-contact m-auto">
                                <ion-icon name="navigate-outline" class="icon"></ion-icon>
                            </div>
                            <div class="header-card-contact">
                                Email Address
                            </div>
                            <p class="info-card-contact">
                                {{ $profile->email }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @empty
    @endforelse

    <!-- Contact Component End -->

    <!-- Footer Component Start -->

    <footer id="footer" class="pt-5">
        <div class="container">
            <div class="row text-center">
                <div class="logo-footer my-3">Minur</div>
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#skills">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>

                <ul class="list-icon">

                    <a href="https://www.facebook.com/misteryirfannur?mibextid=LQQJ4d"
                        class="icon mx-2 d-flex justify-content-center align-items-center"><i
                            class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="https://www.instagram.com/min_software/"
                        class="icon mx-2 d-flex justify-content-center align-items-center"><i
                            class="fa-brands fa-square-instagram"></i>
                    </a>
                    <a href="https://github.com/enelogy"
                        class="icon mx-2 d-flex justify-content-center align-items-center"><i
                            class="fa-brands fa-github"></i>
                    </a>
                </ul>
            </div>
            <div class="copyright">Copyright &copy;2023 All rights reserved | made with ❤️ Minur tech</div>
        </div>
    </footer>

    <!-- Footer Component End -->

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
