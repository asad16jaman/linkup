<!-- Carousel Start -->
<div class="header-carousel owl-carousel">


    @foreach ($carousels as $carousel)


        <div class="header-carousel-item">
            <div class="header-carousel-item-img-1">
                <img src="{{ 'storage/'.$carousel->img }}" class="img-fluid w-100" alt="Image">
            </div>
            <div class="carousel-caption">
                <div class="carousel-caption-inner text-start p-3">
                    <h1 class="display-1 text-capitalize text-white mb-4 fadeInUp animate__animated"
                        data-animation="fadeInUp" data-delay="1.3s" style="animation-delay: 1.3s;">{{ $carousel->title }}</h1>
                    <p class="mb-5 fs-5 fadeInUp animate__animated" data-animation="fadeInUp" data-delay="1.5s"
                        style="animation-delay: 1.5s;">{{ $carousel->description }}
                    </p>
                    <a class="btn btn-primary rounded-pill py-3 px-5 mb-4 me-4 fadeInUp animate__animated"
                        data-animation="fadeInUp" data-delay="1.5s" style="animation-delay: 1.7s;" href="#">Apply Now</a>
                    <a class="btn btn-dark rounded-pill py-3 px-5 mb-4 fadeInUp animate__animated" data-animation="fadeInUp"
                        data-delay="1.5s" style="animation-delay: 1.7s;" href="#">Read More</a>
                </div>
            </div>
        </div>

    @endforeach





</div>
<!-- Carousel End -->