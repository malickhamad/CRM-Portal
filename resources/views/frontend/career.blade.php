@extends('frontend.layouts.app')


@section('content')

    <main class="main">
      <section class="section mt-90">
        <div class="container">
          <div class="text-center">
            <h6 class="color-grey-500 mb-15 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Take a look at our current openings</h6>
            <h2 class="color-brand-1 wow animate__animated animate__fadeIn" data-wow-delay=".2s">We’re Always Searching For<br class="d-none d-lg-block">Amazing People to Join Our Team.</h2>
          </div>
          <div class="box-video mt-70"><img src="{{asset('asset/frontend/imgs/page/career/img-video.png')}}" alt="iori">
            <div class="image-1 shape-1"><img src="{{asset('asset/frontend/imgs/page/career/certify.png')}}" alt="iori"></div>
          </div>
        </div>
      </section>
      <section class="section mt-100">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="color-brand-1 mb-20 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Why You Should Consider Applying</h2>
              <p class="font-lg color-gray-500 wow animate__animated animate__fadeIn" data-wow-delay=".2s">We're lively, not corporate. We have the energy and boldness of a startup and<br class="d-none d-lg-block">the expertise and pragmatism of a scale-up. All in one place.</p>
            </div>
          </div>
          <div class="row mt-65">
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".0s">
              <div class="card-small card-small-2">
                <div class="card-image"><a href="#">
                    <div class="box-image"><img src="{{asset('asset/frontend/imgs/page/homepage1/free.svg')}}" alt="iori"></div></a></div>
                <div class="card-info"><a href="#">
                    <h6 class="color-brand-1 mb-10">Connected</h6></a>
                  <p class="font-xs color-grey-500">We come together wherever we are – across time zones, regions, offices and screens. You will receive support from your teammates anytime and anywhere.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
              <div class="card-small card-small-2">
                <div class="card-image"><a href="#">
                    <div class="box-image"><img src="{{asset('asset/frontend/imgs/page/homepage1/cross.png')}}" alt="iori"></div></a></div>
                <div class="card-info"><a href="#">
                    <h6 class="color-brand-1 mb-10">Inclusive</h6></a>
                  <p class="font-xs color-grey-500">Our teams reflect the rich diversity of our world, with equitable access to opportunity for everyone. No matter where you come from</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
              <div class="card-small card-small-2">
                <div class="card-image"><a href="#">
                    <div class="box-image"><img src="{{asset('asset/frontend/imgs/page/homepage2/identity.png')}}" alt="iori"></div></a></div>
                <div class="card-info"><a href="#">
                    <h6 class="color-brand-1 mb-10">Flexible</h6></a>
                  <p class="font-xs color-grey-500">We believe in your freedom to work when and how you work best, to help us all thrive. Only freedom and independent work can bring out the best in you.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".3s">
              <div class="card-small card-small-2">
                <div class="card-image"><a href="#">
                    <div class="box-image"><img src="{{asset('asset/frontend/imgs/page/career/persuasion.png')}}" alt="iori"></div></a></div>
                <div class="card-info"><a href="#">
                    <h6 class="color-brand-1 mb-10">Persuasion</h6></a>
                  <p class="font-xs color-grey-500">Knowing that there is real value to be gained from helping people to simplify whatever it is that they do and bring.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section mt-100">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="color-brand-1 mb-20 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Career Opportunities</h2>
              <p class="font-lg color-gray-500 wow animate__animated animate__fadeIn" data-wow-delay=".2s">Explore our open roles for working totally remotely, from the<br class="d-none d-lg-block">office or somewhere in between.</p>
            </div>
          </div>
          <div class="row mt-50">
            <div class="col-lg-6 wow animate__animated animate__fadeIn" data-wow-delay=".0s">
              <div class="card-offer card-we-do hover-up">
                <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/homepage4/offer1.png')}}" alt="iori"></div>
                <div class="card-info">
                  <h4 class="color-brand-1 mb-10"><a class="color-brand-1" href="job-detail.html">Manage budgets and resources</a></h4>
                  <p class="font-md color-grey-500 mb-5">Seamless importing and round-tripping of Microsoft Project plans, Excel files &amp; CSV files.</p>
                  <div class="box-button-offer"><a class="btn btn-default font-sm-bold pl-0 color-brand-1">Learn More
                      <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg></a></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
              <div class="card-offer card-we-do hover-up">
                <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/homepage4/offer2.png')}}" alt="iori"></div>
                <div class="card-info">
                  <h4 class="color-brand-1 mb-10"><a class="color-brand-1" href="job-detail.html">Employee Assessments</a></h4>
                  <p class="font-md color-grey-500 mb-5">What makes us different from others? We give holistic solutions with strategy, design &amp; technology.</p>
                  <div class="box-button-offer"><a class="btn btn-default font-sm-bold pl-0 color-brand-1">Learn More
                      <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg></a></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 wow animate__animated animate__fadeIn" data-wow-delay=".0s">
              <div class="card-offer card-we-do hover-up">
                <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/homepage4/offer3.png')}}" alt="iori"></div>
                <div class="card-info">
                  <h4 class="color-brand-1 mb-10"><a class="color-brand-1" href="job-detail.html">Smart Installation Tools</a></h4>
                  <p class="font-md color-grey-500 mb-5">No lag time, no lost effort when priorities change, no email black hole. As team collaboration improves</p>
                  <div class="box-button-offer"><a class="btn btn-default font-sm-bold pl-0 color-brand-1">Learn More
                      <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg></a></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
              <div class="card-offer card-we-do hover-up">
                <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/homepage4/offer4.png')}}" alt="iori"></div>
                <div class="card-info">
                  <h4 class="color-brand-1 mb-10"><a class="color-brand-1" href="job-detail.html">Collaborative to the core.</a></h4>
                  <p class="font-md color-grey-500 mb-5">Share updates instantly within our project management software, and get the entire team collaborating</p>
                  <div class="box-button-offer"><a class="btn btn-default font-sm-bold pl-0 color-brand-1">Learn More
                      <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg></a></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 wow animate__animated animate__fadeIn" data-wow-delay=".0s">
              <div class="card-offer card-we-do hover-up">
                <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/homepage4/offer5.png')}}" alt="iori"></div>
                <div class="card-info">
                  <h4 class="color-brand-1 mb-10"><a class="color-brand-1" href="job-detail.html">Manage budgets and resources</a></h4>
                  <p class="font-md color-grey-500 mb-5">Seamless importing and round-tripping of Microsoft Project plans, Excel files &amp; CSV files.</p>
                  <div class="box-button-offer"><a class="btn btn-default font-sm-bold pl-0 color-brand-1">Learn More
                      <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg></a></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
              <div class="card-offer card-we-do hover-up">
                <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/homepage4/offer6.png')}}" alt="iori"></div>
                <div class="card-info">
                  <h4 class="color-brand-1 mb-10"><a class="color-brand-1" href="job-detail.html">Unlimited ways to work</a></h4>
                  <p class="font-md color-grey-500 mb-5">What makes us different from others? We give holistic solutions with strategy, design &amp; technology.</p>
                  <div class="box-button-offer"><a class="btn btn-default font-sm-bold pl-0 color-brand-1">Learn More
                      <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg></a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-40 mb-50 text-center wow animate__animated animate__fadeIn" data-wow-delay=".0s"><a class="btn btn-brand-1 hover-up" href="contact.html">Contact Us</a><a class="btn btn-default font-sm-bold hover-up" href="#">Learn More
              <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
              </svg></a></div>
        </div>
      </section>
      <section class="section pt-0 pb-50 bg-core-value bg-grey-60 mb-40">
        <div class="container">
          <div class="row box-list-core-value">
            <div class="col-lg-4 mb-70">
              <div class="box-core-value">
                <div class="shape-left shape-1"></div>
                <h3 class="color-brand-1 mb-15 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Core values</h3>
                <p class="font-md color-grey-400 wow animate__animated animate__fadeIn" data-wow-delay=".2s">We break down barriers so teams can focus on what matters – working together to create products their customers love.</p>
              </div>
            </div>
            <div class="col-lg-4">
              <ul class="list-core-value">
                <li class="wow animate__animated animate__fadeIn" data-wow-delay=".0s"><span class="ticked"></span>
                  <h5 class="color-brand-1 mb-5">Customers First</h5>
                  <div class="box-border-dashed">
                    <p class="font-md color-grey-500 mb-20">Our company exists to help merchants sell more. We make every decision and measure every outcome based on how well it serves our customers.</p>
                  </div>
                </li>
                <li class="wow animate__animated animate__fadeIn" data-wow-delay=".2s"><span class="ticked"></span>
                  <h5 class="color-brand-1 mb-5">Act With Integrity</h5>
                  <div class="box-border-dashed">
                    <p class="font-md color-grey-500 mb-20">We’re honest, transparent and committed to doing what’s best for our customers and our company. We openly collaborate in pursuit of the truth. We have no tolerance for politics, hidden agendas or passive-aggressive behavior.</p>
                  </div>
                </li>
                <li class="wow animate__animated animate__fadeIn" data-wow-delay=".4s"><span class="ticked"></span>
                  <h5 class="color-brand-1 mb-5">Make a Difference Every Day</h5>
                  <div class="box-border-dashed">
                    <p class="font-md color-grey-500 mb-20">Our company exists to help merchants sell more. We make every decision and measure every outcome based on how well it serves our customers.</p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-lg-4">
              <ul class="list-core-value">
                <li class="wow animate__animated animate__fadeIn" data-wow-delay=".0s"><span class="ticked"></span>
                  <h5 class="color-brand-1 mb-5">Think Big</h5>
                  <div class="box-border-dashed">
                    <p class="font-md color-grey-500 mb-20">Being the world's leading commerce platform requires unrivaled vision, innovation and execution. We never settle. We challenge our ideas of what’s possible in order to better meet the needs of our customers.</p>
                  </div>
                </li>
                <li class="wow animate__animated animate__fadeIn" data-wow-delay=".2s"><span class="ticked"></span>
                  <h5 class="color-brand-1 mb-5">Do the right thing</h5>
                  <div class="box-border-dashed">
                    <p class="font-md color-grey-500 mb-20">Integrity is the foundation for everything we do. We are admired and respected for our commitment to honesty, trust, and transparency.</p>
                  </div>
                </li>
                <li class="wow animate__animated animate__fadeIn" data-wow-delay=".4s"><span class="ticked"></span>
                  <h5 class="color-brand-1 mb-5">Stronger united</h5>
                  <div class="box-border-dashed">
                    <p class="font-md color-grey-500 mb-20">We’ve created a positive and inclusive culture that fosters open, honest, and meaningful relationships.</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <section class="section mt-80 mb-30">
        <div class="container">
          <div class="text-start">
            <h3 class="color-brand-1 mb-20 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">Loved By Developers<br class="d-none d-lg-block">Trusted By Enterprises</h3>
            <p class="font-lg color-grey-500 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">We helped these brands turn online assessments into success stories.</p>
          </div>
          <div class="mt-50 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
            <ul class="list-partners list-partners-left text-start">
              <li><img src="{{asset('asset/frontend/imgs/page/homepage1/placed.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage1/cuebiq.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage1/factual.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage1/placeiq.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage1/airmeet.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage1/spen.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage1/klippa.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage1/matrix.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage2/reed.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage2/vuori.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage2/versed.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage1/klippa.png')}}" alt="iori"></li>
              <li><img src="{{asset('asset/frontend/imgs/page/homepage1/factual.png')}}" alt="iori"></li>
            </ul>
          </div>
        </div>
      </section>
      <section class="section mt-50 pt-50 pb-40">
        <div class="container">
          <div class="box-cover-border">
            <div class="row align-items-center">
              <div class="col-lg-6">
                <div class="img-reveal"><img class="d-block" src="{{asset('asset/frontend/imgs/page/homepage2/img-marketing.png')}}" alt="iori"></div>
              </div>
              <div class="col-lg-6">
                <div class="box-info-video"><span class="btn btn-tag wow animate__animated animate__fadeInUp" data-wow-delay=".0s">Get in touch</span>
                  <h2 class="color-brand-1 mt-15 mb-20 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Want to talk to a marketing expert?</h2>
                  <p class="font-md color-grey-500 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit laborum — semper quis lectus nulla. Interactively transform magnetic growth strategies whereas prospective "outside the box" thinking.</p>
                  <div class="box-button text-start mt-65 wow animate__animated animate__fadeInUp" data-wow-delay=".3s"><a class="btn btn-brand-1 hover-up" href="#">Contact Us</a><a class="btn btn-default font-sm-bold hover-up" href="#">Support Center
                      <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section mt-50">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-8 col-md-8">
              <h2 class="color-brand-1 mb-20 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">From our blog</h2>
              <p class="font-lg color-gray-500 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">Aenean velit nisl, aliquam eget diam eu, rhoncus tristique dolor.<br class="d-none d-lg-block">Aenean vulputate sodales urna ut vestibulum</p>
            </div>
            <div class="col-lg-4 col-md-4 text-md-end text-start wow animate__animated animate__fadeInUp" data-wow-delay=".4s"><a class="btn btn-default font-sm-bold pl-0">View All
                <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg></a></div>
          </div>
          <div class="row mt-55">
            <div class="col-xl-3 col-lg-6 col-md-6 wow animate__animated animate__fadeIn" data-wow-delay=".0s">
              <div class="card-blog-grid card-blog-grid-2 hover-up">
                <div class="card-image img-reveal"><a href="blog-detail.html"><img src="{{asset('asset/frontend/imgs/page/homepage2/news1.png')}}" alt="iori"></a></div>
                <div class="card-info"><a href="blog-detail.html">
                    <h6 class="color-brand-1">Easy Ways to Make Money While You Sleep</h6></a>
                  <p class="font-sm color-grey-500 mt-20">Fusce dictum ullamcorper dui, id dignissim arcu volutpat vitae. Aenean mattis vestibulum odio eu facilisis. Aenean quam arcu, blandit at aliquet sit amet, convallis nec risus.</p>
                  <div class="mt-20 d-flex align-items-center border-top pt-20"><a class="btn btn-border-brand-1 mr-15" href="blog.html">Technology</a><span class="date-post font-xs color-grey-300 mr-15">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>29 May 2022</span><span class="time-read font-xs color-grey-300">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>3 mins read</span></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
              <div class="card-blog-grid card-blog-grid-2 hover-up">
                <div class="card-image img-reveal"><a href="blog-detail.html"><img src="{{asset('asset/frontend/imgs/page/homepage2/news2.png')}}" alt="iori"></a></div>
                <div class="card-info"><a href="blog-detail.html">
                    <h6 class="color-brand-1">Tiktok video size guide: Everything you need to know</h6></a>
                  <p class="font-sm color-grey-500 mt-20">Fusce dictum ullamcorper dui, id dignissim arcu volutpat vitae. Aenean mattis vestibulum odio eu facilisis. Aenean quam arcu, blandit at aliquet sit amet, convallis nec risus.</p>
                  <div class="mt-20 d-flex align-items-center border-top pt-20"><a class="btn btn-border-brand-1 mr-15" href="blog.html">Marketting</a><span class="date-post font-xs color-grey-300 mr-15">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>29 May 2022</span><span class="time-read font-xs color-grey-300">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>3 mins read</span></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
              <div class="card-blog-grid card-blog-grid-2 hover-up">
                <div class="card-image img-reveal"><a href="blog-detail.html"><img src="{{asset('asset/frontend/imgs/page/homepage1/news2.png')}}" alt="iori"></a></div>
                <div class="card-info"><a href="blog-detail.html">
                    <h6 class="color-brand-1">How to convert video to MP4 for free online</h6></a>
                  <p class="font-sm color-grey-500 mt-20">Fusce dictum ullamcorper dui, id dignissim arcu volutpat vitae. Aenean mattis vestibulum odio eu facilisis. Aenean quam arcu, blandit at aliquet sit amet, convallis nec risus.</p>
                  <div class="mt-20 d-flex align-items-center border-top pt-20"><a class="btn btn-border-brand-1 mr-15" href="blog.html">Media</a><span class="date-post font-xs color-grey-300 mr-15">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>29 May 2022</span><span class="time-read font-xs color-grey-300">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>3 mins read</span></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 wow animate__animated animate__fadeIn" data-wow-delay=".3s">
              <div class="card-blog-grid card-blog-grid-2 hover-up">
                <div class="card-image img-reveal"><a href="blog-detail.html"><img src="{{asset('asset/frontend/imgs/page/homepage2/news3.png')}}" alt="iori"></a></div>
                <div class="card-info"><a href="blog-detail.html">
                    <h6 class="color-brand-1">5 fastest ways to increase search engine rankings</h6></a>
                  <p class="font-sm color-grey-500 mt-20">Fusce dictum ullamcorper dui, id dignissim arcu volutpat vitae. Aenean mattis vestibulum odio eu facilisis. Aenean quam arcu, blandit at aliquet sit amet, convallis nec risus.</p>
                  <div class="mt-20 d-flex align-items-center border-top pt-20"><a class="btn btn-border-brand-1 mr-15" href="blog.html">SEO</a><span class="date-post font-xs color-grey-300 mr-15">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>29 May 2022</span><span class="time-read font-xs color-grey-300">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>3 mins read</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section mt-50">
        <div class="container">
          <div class="box-newsletter box-newsletter-2 wow animate__animated animate__fadeIn">
            <div class="row align-items-center">
              <div class="col-lg-6 col-md-7 m-auto text-center"><span class="font-lg color-brand-1 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Newsletter</span>
                <h2 class="color-brand-1 mb-15 mt-5 wow animate__animated animate__fadeIn" data-wow-delay=".1s">Subcribe our newsletter</h2>
                <p class="font-md color-grey-500 wow animate__animated animate__fadeIn" data-wow-delay=".2s">Do not miss the latest information from us about the trending in the market. By clicking the button, you are agreeing with our Term & Conditions</p>
                <div class="form-newsletter mt-30 wow animate__animated animate__fadeIn" data-wow-delay=".3s">
                  <form action="#">
                    <input type="text" placeholder="Enter you mail ..">
                    <button class="btn btn-submit-newsletter" type="submit">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                      </svg>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

@endsection
