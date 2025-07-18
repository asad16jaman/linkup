<div class="container-fluid project">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Projects</h4>
                    <h1 class="display-4">Explore Our Latest Projects</h1>
                </div>
                <div class="project-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">
                    @foreach ($projects as $project)
                    
                    
                    <div class="project-item h-100 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="project-img">
                            <img src="{{ 'storage/'.$project->image->img }}" class="img-fluid w-100 rounded" alt="Image">
                        </div>
                        <div class="project-content bg-light rounded p-4">
                            <div class="project-content-inner">
                                <div class="project-icon mb-3"><i class="fas fa-chart-line fa-4x text-primary"></i></div>
                                <p class="text-dark fs-5 mb-3">{{ $project->name }}</p>
                                <a href="#" class="h4">{{ $project->description }}</a>
                                <div class="pt-4">
                                    <a class="btn btn-light rounded-pill py-3 px-5" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>