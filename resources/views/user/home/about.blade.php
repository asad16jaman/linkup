<!-- About Start -->
        <div class="container-fluid about bg-light py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="about-img">
                            
                            <img src="{{ asset('storage/'.$about->picture ) }}" class="img-fluid w-100 rounded-bottom" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                        <h4 class="text-primary">About Us</h4>
                        <h1 class="display-5 mb-4">{{ $about->title }}</h1>
                        <p class="text ps-4 mb-4">{{ $about->about }}
                        </p>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->