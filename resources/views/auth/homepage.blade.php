<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Wash Up, Doc? Laundry Hub</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('partials.header')

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center shadow-sm">
        <div class="container d-flex align-items-center">

            <div class="logo me-auto">
                <h6><a href="homepage">{{ $info->name ?? 'Shop Name' }}</a></h6>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar order-last order-lg-0 ">
                @guest
                    <ul>
                        <li><a class="nav-link scrollto active" href="login">Login</a></li>
                        <li><a class="nav-link scrollto active" href="register">Register</a></li>
                    </ul>
                @endguest
                @auth
                    <div class="dropdown">
                        <a class="nav-link text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Welcome, {{ Str::upper(auth()->user()->name) }}
                        </a>
                        <ul class="dropdown-menu">
                            @can('customer')
                                <li><a class="dropdown-item" href="{{ route('customer.profile') }}">My Profile</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('staff.profile') }}">My Profile</a></li>
                            @endcan
                            {{-- <li>
                                <a class="dropdown-item" href="#">Role:
                                    @foreach (auth()->user()->roles as $role)
                                        {{ Str::upper($role->role_name) }}
                                    @endforeach
                                </a>
                            </li> --}}
                            <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                @endauth


            </nav><!-- .navbar -->


        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center"
                    data-aos="fade-up">
                    <div>
                        <h1>Welcome to Fresh Threads Laundry Service</h1>
                        <h2>Your Trusted Partner for Convenient and Quality Laundry Solutions</h2>
                        <a href="register" class="btn-get-started scrollto">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
                    <img src="uploads/homepage-image.jpg" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">


        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6 mt-2 mb-tg-0 order-2 order-lg-1">
                        <ul class="nav nav-tabs flex-column">
                            <li class="nav-item" data-aos="fade-up">
                                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">
                                    <h4>Seamless Connectivity</h4>
                                    <p>Our platform is a one-stop hub for both existing and potential clients to
                                        effortlessly connect, inquire, and explore our services.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2" data-aos="fade-up" data-aos-delay="100">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">
                                    <h4>User Friendly</h4>
                                    <p>Navigate with ease through our intuitive design, making your laundry experience
                                        smooth and enjoyable.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2" data-aos="fade-up" data-aos-delay="200">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">
                                    <h4>Efficient Scheduling</h4>
                                    <p>Customize your laundry schedule to fit your lifestyle, making laundry day a
                                        breeze.</p>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1">
                                <figure>
                                    <img src="uploads/features.png" alt="" width="400px" height="400px"
                                        class="img-fluid">
                                </figure>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <figure>
                                    <img src="uploads/ol.png" alt="" width="490px" height="490px"
                                        class="img-fluid">
                                </figure>
                            </div>
                            <div class="tab-pane" id="tab-3">
                                <figure>
                                    <img src="uploads/book.png" alt="" width="480px" height="480px"
                                        class="img-fluid">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Features Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Services</h2>

                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in">
                        <div class="icon-box icon-box-pink">
                            <div class="icon"><i class="bx bx-water"></i></div>
                            <h4 class="title"><a href="">Wash and Fold</a></h4>
                            <p>Effortless laundry care—just drop off, and we'll handle the rest. Your clothes expertly
                                cleaned, perfectly folded.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in"
                        data-aos-delay="100">
                        <div class="icon-box icon-box-cyan">
                            <div class="icon"><i class="bx bxs-dryer"></i></div>
                            <h4 class="title"><a href="">Dry Cleaning</a></h4>
                            <p>Preserve the quality of your delicate garments with our specialized Dry Cleaning service.
                                Exceptional care for exceptional fabrics.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div class="icon-box icon-box-green">
                            <div class="icon"><i class="bx bx-vial"></i></div>
                            <h4 class="title"><a href="">Free Detergent and <br> Fabcon</a></h4>
                            <p>Enjoy a little extra freshness on us! Complimentary detergent and fabric conditioner with
                                every wash.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in"
                        data-aos-delay="300">
                        <div class="icon-box icon-box-blue">
                            <div class="icon"><i class="bx bxs-car"></i></div>
                            <h4 class="title"><a href="">Delivery/PickUp Delivery</a></h4>
                            <p class="description">Laundry made easy. Schedule delivery/pick-up, and we'll bring the
                                cleanliness to you. Effortless, convenient, and tailored to your schedule.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Portfolio</h2>
                    <p>Welcome to Wash Up, Doc? Laundry Hub, where precision meets perfection in every load. Our arsenal
                        of cutting-edge tools, advanced equipment, and state-of-the-art machines ensures that your
                        laundry receives the care it deserves. Trusted by a community of loyal clients, our commitment
                        to quality has earned us their unwavering trust.</p>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="uploads/load1.png" class="w-100" style="height: 320px;" alt="">

                            <div class="portfolio-links">
                                <a href="uploads/load1.png" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="uploads/washing2.png" class="w-100" style="height: 320px;" alt="">

                            <div class="portfolio-links">
                                <a href="uploads/washing2.png" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="uploads/washing1.png" class="w-100" style="height: 320px;" alt="">

                            <div class="portfolio-links">
                                <a href="uploads/washing1.png" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="uploads/load2.png" class="w-100" style="height: 320px;" alt="">

                            <div class="portfolio-links">
                                <a href="uploads/load2.png" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="uploads/washing3.png" class="w-100" style="height: 320px;" alt="">

                            <div class="portfolio-links">
                                <a href="uploads/washing3.png" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="uploads/washing4.png" class="w-100" style="height: 320px;" alt="">

                            <div class="portfolio-links">
                                <a href="uploads/washing4.png" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            </div>
        </section><!-- End Portfolio Section -->

        <section id="team" class="team">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Developers</h2>
                </div>

                <div class="team-members" style="display: flex; justify-content: center;">

                    <div class="col-lg-4 col-md-4">
                        <div class="member" data-aos="zoom-in">
                            <div class="pic"><img src="assets/img/team/team1.png" class="img-fluid"
                                    alt=""></div>
                            <div class="member-info mt-3">
                                <h4>Rojene Domingo Haro</h4>
                                <span>Chief Executive Officer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="member" data-aos="zoom-in" data-aos-delay="200">
                            <div class="pic"><img src="assets/img/team/team2.png" class="img-fluid"
                                    alt=""></div>
                            <div class="member-info">
                                <h4>Karl Jayson Mercado</h4>
                                <span>Software Developer</span>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Team Section -->


        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact section-bg">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Contact Us</h2>
                </div>

                <div class="row">

                    <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-right">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>{{ $info->location ?? 'Shop Location' }}</p>
                            </div>


                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>{{ $info->contact_number ?? 'Contact Number' }}</p>
                            </div>

                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                                frameborder="0" style="border:0; width: 100%; height: 290px;"
                                allowfullscreen></iframe>
                        </div>

                    </div>

                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-left">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Your Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        required>
                                </div>
                                <div class="form-group col-md-6 mt-3 mt-md-0">
                                    <label for="name">Your Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="name">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="name">Message</label>
                                <textarea class="form-control" name="message" rows="10" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>{{ $info->name ?? 'Shop Name' }}</h3>
                            <p>
                                {{ $info->location ?? 'Shop Location' }}<br><br>
                                <strong>Contact Number:</strong> {{ $info->contact_number ?? 'Contact Number' }}<br>
                                <strong>Facebook Page:</strong> {{ $info->facebook ?? 'Facebook Page' }}<br>
                            </p>
                        </div>
                    </div>





                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#features">Features</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#portfolio">Portfolio</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>

                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>{{ $info->name ?? 'Shop Name' }}</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
