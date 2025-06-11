@extends('theme.app')

@section('title', 'Test')

@section('content')
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-5" id="departments">
        <div class="container">
            <div class="row">
                <div class="col-12 py-3">
                    <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/bg-departments.png') }});background-position:top center;background-size:contain;">
                    </div>
                    <!--/.bg-holder-->
                    <h1 class="text-center">OUR DEPARTMENTS</h1>
                </div>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-0">
        <div class="container">
            <div class="row py-5 align-items-center justify-content-center justify-content-lg-evenly">
                <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box text-center"><a class="text-decoration-none" href="#"><img class="mb-3 deparment-icon" src="{{ asset('assets/img/icons/neurology.png') }}" alt="Neurology" /><img class="mb-3 deparment-icon-hover" src="{{ asset('assets/img/icons/neurology.svg') }}" alt="Neurology" />
                                <p class="fs-1 fs-xxl-2 text-center">Neurology</p>
                            </a></div>
                    </div>
                </div>
                <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box text-center"><a class="text-decoration-none" href="#"><img class="mb-3 deparment-icon" src="{{ asset('assets/img/icons/eye-care.png') }}" alt="Eye care" /><img class="mb-3 deparment-icon-hover" src="{{ asset('assets/img/icons/eye-care.svg') }}" alt="Eye care" />
                                <p class="fs-1 fs-xxl-2 text-center">Eye care</p>
                            </a></div>
                    </div>
                </div>
                <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box text-center"><a class="text-decoration-none" href="#"><img class="mb-3 deparment-icon" src="{{ asset('assets/img/icons/cardiac.png') }}" alt="Cardiac" /><img class="mb-3 deparment-icon-hover" src="{{ asset('assets/img/icons/cardiac.svg') }}" alt="Cardiac" />
                                <p class="fs-1 fs-xxl-2 text-center">Cardiac care</p>
                            </a></div>
                    </div>
                </div>
                <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box text-center"><a class="text-decoration-none" href="#"><img class="mb-3 deparment-icon" src="{{ asset('assets/img/icons/heart.png') }}" alt="Heart" /><img class="mb-3 deparment-icon-hover" src="{{ asset('assets/img/icons/heart.svg') }}" alt="Heart" />
                                <p class="fs-1 fs-xxl-2 text-center">Heart care</p>
                            </a></div>
                    </div>
                </div>
                <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box text-center"><a class="text-decoration-none" href="#"><img class="mb-3 deparment-icon" src="{{ asset('assets/img/icons/osteoporosis.png') }}" alt="Osteoporosis" /><img class="mb-3 deparment-icon-hover" src="{{ asset('assets/img/icons/osteoporosis.svg') }}" alt="Osteoporosis" />
                                <p class="fs-1 fs-xxl-2 text-center">Osteoporosis</p>
                            </a></div>
                    </div>
                </div>
                <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box text-center"><a class="text-decoration-none" href="#"><img class="mb-3 deparment-icon" src="{{ asset('assets/img/icons/ent.png') }}" alt="ENT" /><img class="mb-3 deparment-icon-hover" src="{{ asset('assets/img/icons/ent.svg') }}" alt="ENT" />
                                <p class="fs-1 fs-xxl-2 text-center">ENT</p>
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

    <section class="bg-secondary">
        <div class="bg-holder" style="background-image:url({{ asset('assets/img/gallery/bg-eye-care.png') }});background-position:center;background-size:contain;">
        </div>
        <!--/.bg-holder-->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 col-xxl-6"><img class="img-fluid" src="{{ asset('assets/img/gallery/eye-care.png') }}" alt="Eye Care" /></div>
                <div class="col-md-7 col-xxl-6 text-center text-md-start">
                    <h2 class="fw-bold text-light mb-4 mt-4 mt-lg-0">Eye Care with Top Professionals<br class="d-none d-sm-block" />and In Budget.</h2>
                    <p class="text-light">We've built a healthcare system that puts your needs first.<br class="d-none d-sm-block" />For us, there is nothing more important than the health of <br class="d-none d-sm-block" />you and your loved ones. </p>
                    <div class="py-3"><a class="btn btn-lg btn-light rounded-pill" href="#" role="button">Learn more </a></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT US SECTION -->
    <section class="pb-0" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12 py-3">
                    <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/about-us.png') }});background-position:top center;background-size:contain;">
                    </div>
                    <h1 class="text-center">ABOUT US</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/about-bg.png') }});background-position:top center;background-size:contain;">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-lg-1 mb-5 mb-lg-0"><img class="fit-cover rounded-circle w-100" src="{{ asset('assets/img/gallery/health-care.png') }}" alt="Health Care" /></div>
                <div class="col-md-6 text-center text-md-start">
                    <h2 class="fw-bold mb-4">We are developing a healthcare <br class="d-none d-sm-block" />system around you</h2>
                    <p>We think that everyone should have easy access to excellent <br class="d-none d-sm-block" />healthcare. Our aim is to make the procedure as simple as <br class="d-none d-sm-block" />possible for our patients and to offer treatment no matter<br class="d-none d-sm-block" />where they are — in person or at their convenience. </p>
                    <div class="py-3">
                        <button class="btn btn-lg btn-outline-primary rounded-pill" type="submit">Learn more </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- OUR DOCTORS -->
    <section class="pb-0">
        <div class="container">
            <div class="row">
                <div class="col-12 py-3">
                    <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/doctors-us.png') }});background-position:top center;background-size:contain;">
                    </div>
                    <h1 class="text-center">OUR DOCTORS</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/doctors-bg.png') }});background-position:top center;background-size:contain;">
        </div>
        <div class="container">
            <div class="row flex-center">
                <div class="col-xl-10 px-0">
                    <div class="carousel slide" id="carouselExampleDark" data-bs-ride="carousel">
                        <a class="carousel-control-prev carousel-icon z-index-2" href="#carouselExampleDark" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a>
                        <a class="carousel-control-next carousel-icon z-index-2" href="#carouselExampleDark" role="button" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a>
                        <div class="carousel-inner">
                            <!-- Duplicated doctor cards preserved from template -->
                            @for($i=0;$i<3;$i++)
                            <div class="carousel-item {{ $i==0 ? 'active' : '' }}" data-bs-interval="{{ $i==0 ? '10000':'2000' }}">
                                <div class="row h-100 m-lg-7 mx-3 mt-6 mx-md-4 my-md-7">
                                    <div class="col-md-4 mb-8 mb-md-0">
                                        <div class="card card-span h-100 shadow">
                                            <div class="card-body d-flex flex-column flex-center py-5"><img src="{{ asset('assets/img/gallery/anita.png') }}" width="128" alt="Anita" />
                                                <h5 class="mt-3">Anita Deshai</h5>
                                                <p class="mb-0 fs-xxl-1">Pediatrics, Gochi Medicine</p>
                                                <p class="text-600 mb-0">Florida, United States</p>
                                                <p class="text-600 mb-4">10 years experience</p>
                                                <div class="text-center">
                                                    <button class="btn btn-outline-secondary rounded-pill" type="submit">View Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-8 mb-md-0">
                                        <div class="card card-span h-100 shadow">
                                            <div class="card-body d-flex flex-column flex-center py-5"><img src="{{ asset('assets/img/gallery/jane.png') }}" width="128" alt="Jane" />
                                                <h5 class="mt-3">Jane Flakis</h5>
                                                <p class="mb-0 fs-xxl-1">Gynaecology, Abenka Care</p>
                                                <p class="text-600 mb-0">Melbourne, Australia</p>
                                                <p class="text-600 mb-4">12 years experience</p>
                                                <div class="text-center">
                                                    <button class="btn btn-outline-secondary rounded-pill" type="submit">View Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-8 mb-md-0">
                                        <div class="card card-span h-100 shadow">
                                            <div class="card-body d-flex flex-column flex-center py-5"><img src="{{ asset('assets/img/gallery/leo-mario.png') }}" width="128" alt="Leo" />
                                                <h5 class="mt-3">Leo Mario</h5>
                                                <p class="mb-0 fs-xxl-1">Physiotherapy, FitCare</p>
                                                <p class="text-600 mb-0">London, England</p>
                                                <p class="text-600 mb-4">25 years experience</p>
                                                <div class="text-center">
                                                    <button class="btn btn-secondary hover-top rounded-pill border-0" type="submit">View Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PEOPLE WHO LOVE US -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 py-3">
                    <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/people.png') }});background-position:top center;background-size:contain;">
                    </div>
                    <h1 class="text-center">PEOPLE WHO LOVE US</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8">
        <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/people-bg-1.png') }});background-position:center;background-size:cover;">
        </div>
        <div class="container">
            <div class="row align-items-center offset-sm-1">
                <div class="carousel slide" id="carouselPeople" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @for($i=0;$i<3;$i++)
                        <div class="carousel-item {{ $i==0 ? 'active' : '' }}" data-bs-interval="{{ $i==0 ? '10000':'2000' }}">
                            <div class="row h-100">
                                <div class="col-sm-3 text-center"><img src="{{ asset('assets/img/gallery/people-who-loves.png') }}" width="100" alt="person" />
                                    <h5 class="mt-3 fw-medium text-secondary">{{ ['Edward Newgate','Jhon Doe','Jeny Doe'][$i] }}</h5>
                                    <p class="fw-normal mb-0">{{ ['Founder Circle','UI/UX Designer','Web Designer'][$i] }}</p>
                                </div>
                                <div class="col-sm-9 text-center text-sm-start pt-3 pt-sm-0">
                                    <h2>Fantastic Response!</h2>
                                    <div class="my-2"><i class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i class="fas fa-star-half-alt me-2"></i><i class="far fa-star"></i></div>
                                    <p>This medical and health care facility distinguishes itself from the competition by providing technologically advanced medical and health care. A mobile app and a website are available via which you can easily schedule appointments, get online consultations, and see physicians, who will assist you through the whole procedure. And all of the prescriptions, medications, and other services they offer are 100% genuine, medically verified, and proved. I believe that the Livedoc staff is doing an outstanding job. Highly recommended their health care services.</p>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="row">
                        <div class="position-relative z-index-2 mt-5">
                            <ol class="carousel-indicators">
                                <li class="active" data-bs-target="#carouselPeople" data-bs-slide-to="0"></li>
                                <li data-bs-target="#carouselPeople" data-bs-slide-to="1"></li>
                                <li data-bs-target="#carouselPeople" data-bs-slide-to="2"></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- APPOINTMENT SECTION -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 py-3">
                    <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/people.png') }});background-position:top center;background-size:contain;">
                    </div>
                    <h1 class="text-center">APPOINTMENT</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8">
        <div class="container">
            <div class="row">
                <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/dot-bg.png') }});background-position:bottom right;background-size:auto;">
                </div>
                <div class="col-lg-6 z-index-2 mb-5"><img class="w-100" src="{{ asset('assets/img/gallery/appointment.png') }}" alt="Appointment" /></div>
                <div class="col-lg-6 z-index-2">
                    <form class="row g-3">
                        <div class="col-md-6"><label class="visually-hidden" for="inputName">Name</label><input class="form-control form-livedoc-control" id="inputName" type="text" placeholder="Name" /></div>
                        <div class="col-md-6"><label class="visually-hidden" for="inputPhone">Phone</label><input class="form-control form-livedoc-control" id="inputPhone" type="text" placeholder="Phone" /></div>
                        <div class="col-md-6"><label class="form-label visually-hidden" for="inputCategory">Category</label><select class="form-select" id="inputCategory"><option selected>Category</option><option>Category One</option><option>Category Two</option><option>Category Three</option></select></div>
                        <div class="col-md-6"><label class="form-label visually-hidden" for="inputEmail">Email</label><input class="form-control form-livedoc-control" id="inputEmail" type="email" placeholder="Email" /></div>
                        <div class="col-md-12"><label class="form-label visually-hidden" for="validationTextarea">Message</label><textarea class="form-control form-livedoc-control" id="validationTextarea" placeholder="Message" style="height:250px;"></textarea></div>
                        <div class="col-12"><div class="d-grid"><button class="btn btn-primary rounded-pill" type="submit">Sign in</button></div></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOG POSTS -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 py-3">
                    <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/blog-post.png') }});background-position:top center;background-size:contain;">
                    </div>
                    <h1 class="text-center">RECENT BLOGPOSTS</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWS CARDS & CTA -->
    <section>
        <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/dot-bg.png') }});background-position:top left;background-size:auto;"></div>
        <div class="container">
            <div class="row">
                @php
                    $news = [
                        ['img'=>'covid-19.png','cat'=>'Health','date'=>'Nov 21, 2021','title'=>'COVID-19: The Most Up-to-Date Information'],
                        ['img'=>'laboratories.png','cat'=>'Lifestyle','date'=>'Nov 25, 2021','title'=>'Importance of Accreditation for Laboratories'],
                        ['img'=>'nicotine.png','cat'=>'Health','date'=>'Nov 28, 2021','title'=>'The dangers of nicotine are addressed in depth'],
                        ['img'=>'treatment.png','cat'=>'Health','date'=>'Nov 30, 2021','title'=>'Treatment of patients with diabetes during COVID-19'],
                    ];
                @endphp
                @foreach($news as $n)
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="card h-100 shadow card-span rounded-3"><img class="card-img-top rounded-top-3" src="{{ asset('assets/img/gallery/'.$n['img']) }}" alt="news" />
                        <div class="card-body"><span class="fs--1 text-primary me-3">{{ $n['cat'] }}</span>
                            <svg class="bi bi-calendar2 me-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"></path>
                                <path d="M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"></path>
                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"></path>
                            </svg><span class="fs--1 text-900">{{ $n['date'] }}</span>
                            <h5 class="font-base fs-lg-0 fs-xl-1 my-3">{{ $n['title'] }}</h5><a class="stretched-link" href="#">read full article</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-primary">
        <div class="bg-holder bg-size" style="background-image:url({{ asset('assets/img/gallery/cta-bg.png') }});background-position:center right;margin-top:-8.125rem;background-size:contain;"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="fw-bold text-light">Get an update every week</h2>
                    <p class="text-soft-primary">Livedoc was created in order to improve the patient experience. <br />Providing world-class tests, and a wide range of other services.</p>
                </div>
                <div class="col-lg-6">
                    <h5 class="mb-3 text-soft-primary">SUBSCRIBE TO NEWSLETTER </h5>
                    <form class="row gx-2 gy-2 align-items-center">
                        <div class="col">
                            <div class="input-group-icon">
                                <label class="visually-hidden" for="inputEmailCta">Address</label>
                                <input class="form-control form-livedoc-control form-cta-control text-soft-primary" id="inputEmailCta" type="email" placeholder="Email" />
                            </div>
                        </div>
                        <div class="d-grid gap-3 col-sm-auto">
                            <button class="btn btn-lg btn-light rounded-3 px-5 py-3" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
