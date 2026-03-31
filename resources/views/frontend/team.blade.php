@extends('frontend.layouts.app')


@section('content')
    <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
      <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-content-area">
          <div class="mobile-logo"><a class="d-flex" href="index.html"><img alt="IORI" src="{{asset('asset/frontend/imgs/template/logo.svg')}}"></a></div>
          <div class="burger-icon"><span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
          <div class="perfect-scroll">
            <div class="mobile-menu-wrap mobile-header-border">
              <ul class="nav nav-tabs nav-tabs-mobile mt-25" role="tablist">
                <li><a class="active" href="#tab-menu" data-bs-toggle="tab" role="tab" aria-controls="tab-menu" aria-selected="true">
                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>Menu</a></li>
                <li><a href="#tab-account" data-bs-toggle="tab" role="tab" aria-controls="tab-account" aria-selected="false">
                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>Account</a></li>
                <li><a href="#tab-notification" data-bs-toggle="tab" role="tab" aria-controls="tab-notification" aria-selected="false">
                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>Notification</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade active show" id="tab-menu" role="tabpanel" aria-labelledby="tab-menu">
                  <nav class="mt-15">
                    <ul class="mobile-menu font-heading">
                      <li class="has-children"><a class="active" href="index.html">Home</a>
                        <ul class="sub-menu">
                          <li><a href="index.html">Homepage - 1</a></li>
                          <li><a href="index-2.html">Homepage - 2</a></li>
                          <li><a href="index-3.html">Homepage - 3</a></li>
                          <li><a href="index-4.html">Homepage - 4</a></li>
                          <li><a href="index-5.html">Homepage - 5</a></li>
                          <li><a href="index-6.html">Homepage - 6</a></li>
                          <li><a href="index-7.html">Homepage - 7</a></li>
                          <li><a href="index-8.html">Homepage - 8</a></li>
                          <li><a href="index-9.html">Homepage - 9</a></li>
                          <li><a href="index-10.html">Homepage - 10</a></li>
                          <li><a href="index-11.html">Homepage - 11</a></li>
                          <li><a href="index-12.html">Homepage - 12</a></li>
                        </ul>
                      </li>
                      <li class="has-children"><a href="#">Company</a>
                        <ul class="sub-menu">
                          <li><a href="about.html">About Us</a></li>
                          <li><a href="service.html">Our Services</a></li>
                          <li><a href="pricing.html">Pricing Plan</a></li>
                          <li><a href="team.html">Meet Our Team</a></li>
                          <li><a href="help.html">Help Center</a></li>
                          <li><a href="term-conditions.html">Term and Conditions</a></li>
                        </ul>
                      </li>
                      <li class="has-children"><a href="#">Career</a>
                        <ul class="sub-menu">
                          <li><a href="career.html">Jobs Listing</a></li>
                          <li><a href="job-detail.html">Job Details</a></li>
                        </ul>
                      </li>
                      <li class="has-children"><a href="blog.html">Blog</a>
                        <ul class="sub-menu">
                          <li><a href="blog.html">Blog Listing 1</a></li>
                          <li><a href="blog-2.html">Blog Listing 2</a></li>
                          <li><a href="blog-detail.html">Blog Details</a></li>
                        </ul>
                      </li>
                      <li class="has-children"><a href="#">Shop</a>
                        <ul class="sub-menu">
                          <li><a href="shop-grid.html">Products Listing 1</a></li>
                          <li><a href="shop-list.html">Products Listing 2</a></li>
                          <li><a href="product-detail.html">Product Details</a></li>
                        </ul>
                      </li>
                      <li class="has-children"><a href="#">Pages</a>
                        <ul class="sub-menu">
                          <li><a href="register.html">Register</a></li>
                          <li><a href="login.html">Login</a></li>
                          <li><a href="coming-soon.html">Coming soon</a></li>
                          <li><a href="404.html">Error 404</a></li>
                        </ul>
                      </li>
                      <li><a href="contact.html">Contact</a></li>
                    </ul>
                  </nav>
                </div>
                <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account">
                  <nav class="mt-15">
                    <ul class="mobile-menu font-heading">
                      <li><a class="active" href="login.html">My Profile</a></li>
                      <li><a href="#">Work Preferences</a></li>
                      <li><a href="#">My Boosted Shots</a></li>
                      <li><a href="#">My Collections</a></li>
                      <li><a href="#">Account Settings</a></li>
                      <li><a href="#">Go Pro</a></li>
                      <li><a href="register.html">Sign Out</a></li>
                    </ul>
                  </nav>
                </div>
                <div class="tab-pane fade" id="tab-notification" role="tabpanel" aria-labelledby="tab-notification">
                  <p class="font-sm-bold color-brand-1 mt-30">Today</p>
                  <div class="notifications-item">
                    <div class="item-notify">
                      <div class="item-image"><img src="{{asset('asset/frontend/imgs/template/user1.png')}}" alt="iori"></div>
                      <div class="item-info">
                        <p class="color-grey-500 font-xs"><strong class="font-xs-bold">Steven Job</strong>like started a poll in your post “How to be a good trader in 2023”</p>
                      </div>
                      <div class="item-time"><span class="color-grey-500 font-xs">Just now</span></div>
                    </div>
                    <div class="item-notify">
                      <div class="item-image"><img src="{{asset('asset/frontend/imgs/template/user2.png')}}" alt="iori"></div>
                      <div class="item-info">
                        <p class="color-grey-500 font-xs"><strong class="font-xs-bold">Steven Job</strong>like started a poll in your post “How to be a good trader in 2023”</p>
                      </div>
                      <div class="item-time"><span class="color-grey-500 font-xs">Just now</span></div>
                    </div>
                  </div>
                  <p class="font-sm-bold color-brand-1 mt-30">Yesterday</p>
                  <div class="notifications-item">
                    <div class="item-notify">
                      <div class="item-image"><img src="{{asset('asset/frontend/imgs/template/user3.png')}}" alt="iori"></div>
                      <div class="item-info">
                        <p class="color-grey-500 font-xs"><strong class="font-xs-bold">Steven Job</strong>like started a poll in your post “How to be a good trader in 2023”</p>
                      </div>
                      <div class="item-time"><span class="color-grey-500 font-xs">Just now</span></div>
                    </div>
                    <div class="item-notify">
                      <div class="item-image"><img src="{{asset('asset/frontend/imgs/template/user4.png')}}" alt="iori"></div>
                      <div class="item-info">
                        <p class="color-grey-500 font-xs"><strong class="font-xs-bold">Steven Job</strong>like started a poll in your post “How to be a good trader in 2023”</p>
                      </div>
                      <div class="item-time"><span class="color-grey-500 font-xs">Just now</span></div>
                    </div>
                    <div class="item-notify">
                      <div class="item-image"><img src="{{asset('asset/frontend/imgs/template/user5.png')}}" alt="iori"></div>
                      <div class="item-info">
                        <p class="color-grey-500 font-xs"><strong class="font-xs-bold">Steven Job</strong>like started a poll in your post “How to be a good trader in 2023”</p>
                      </div>
                      <div class="item-time"><span class="color-grey-500 font-xs">Just now</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="site-copyright color-grey-400 mt-0">
              <div class="box-download-app">
                <p class="font-xs color-grey-400 mb-25">Download our Apps and get extra 15% Discount on your first Order…!</p>
                <div class="mb-25"><a class="mr-10" href="#"><img src="{{asset('asset/frontend/imgs/template/appstore.png')}}" alt="iori"></a><a href="#"><img src="{{asset('asset/frontend/imgs/template/google-play.png')}}" alt="iori"></a></div>
                <p class="font-sm color-grey-400 mt-20 mb-10">Secured Payment Gateways</p><img src="{{asset('asset/frontend/imgs/template/payment-method.png')}}" alt="iori">
              </div>
              <div class="mb-0">Copyright 2023 &copy; IORI - Marketplace Template.<br>Designed by<a href="http://alithemes.com" target="_blank">&nbsp; AliThemes</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <main class="main">
      <section class="section banner-team">
        <div class="container">
          <div class="banner-1">
            <div class="row align-items-center">
              <div class="col-lg-5">
                <h2 class="color-brand-1 mb-20 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Customers Love Our Creative Team, and So Will You</h2>
                <div class="box-button mt-30 mb-60 wow animate__animated animate__fadeIn" data-wow-delay=".2s"><a class="btn btn-brand-1 hover-up" href="#">Contact Us</a><a class="btn btn-default font-sm-bold hover-up" href="#">Support Center
                    <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg></a></div>
                <p class="font-md color-grey-500 mb-25 wow animate__animated animate__fadeIn" data-wow-delay=".4s">“Highly recommend Iori Agency! They guide us on marketing initiatives and develop great strategies to increase our return on investment. The agency is excellent at being cooperative and responding quickly.”</p>
                <div class="box-author wow animate__animated animate__fadeIn" data-wow-delay=".6s"><a href="#"><img src="{{asset('asset/frontend/imgs/page/team/author.png')}}" alt="iori"></a>
                  <div class="author-info"><a href="#"><span class="font-md-bold color-brand-1 author-name">Bessie Cooper</span></a>
                    <div class="rating d-inline-block"><img src="{{asset('asset/frontend/imgs/template/icons/star.svg')}}" alt="iori"><img src="{{asset('asset/frontend/imgs/template/icons/star.svg')}}" alt="iori"><img src="{{asset('asset/frontend/imgs/template/icons/star.svg')}}" alt="iori"><img src="{{asset('asset/frontend/imgs/template/icons/star.svg')}}" alt="iori"><img src="{{asset('asset/frontend/imgs/template/icons/star.svg')}}" alt="iori"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 d-none d-lg-block">
                <div class="box-banner-team">
                  <div class="arrow-down-banner shape-1"></div>
                  <div class="arrow-right-banner shape-2"></div>
                  <div class="banner-col-1">
                    <div class="img-banner wow animate__animated animate__zoomIn" data-wow-delay=".0s"><img src="{{asset('asset/frontend/imgs/page/team/banner1.png')}}" alt="iori"></div>
                  </div>
                  <div class="banner-col-2">
                    <div class="img-banner wow animate__animated animate__zoomIn" data-wow-delay=".2s"><img src="{{asset('asset/frontend/imgs/page/team/banner2.png')}}" alt="iori"></div>
                    <div class="img-banner hasBorder wow animate__animated animate__zoomIn" data-wow-delay=".4s"><img src="{{asset('asset/frontend/imgs/page/team/banner3.png')}}" alt="iori"></div>
                  </div>
                  <div class="banner-col-3">
                    <div class="img-banner hasBorder2 wow animate__animated animate__zoomIn" data-wow-delay=".6s"><img src="{{asset('asset/frontend/imgs/page/team/banner4.png')}}" alt="iori"></div>
                    <div class="img-banner wow animate__animated animate__zoomIn" data-wow-delay=".8s"><img src="{{asset('asset/frontend/imgs/page/team/banner5.png')}}" alt="iori"></div>
                    <div class="img-banner wow animate__animated animate__zoomIn" data-wow-delay="1s"><img src="{{asset('asset/frontend/imgs/page/team/banner6.png')}}" alt="iori"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="section bg-grey-80 pt-70 pb-70">
        <div class="container">
          <ul class="list-partners">
            <li class="wow animate__animated animate__fadeIn" data-wow-delay=".0s"><img src="{{asset('asset/frontend/imgs/page/homepage1/placed.png')}}" alt="iori"></li>
            <li class="wow animate__animated animate__fadeIn" data-wow-delay=".1s"><img src="{{asset('asset/frontend/imgs/page/homepage1/cuebiq.png')}}" alt="iori"></li>
            <li class="wow animate__animated animate__fadeIn" data-wow-delay=".2s"><img src="{{asset('asset/frontend/imgs/page/homepage1/factual.png')}}" alt="iori"></li>
            <li class="wow animate__animated animate__fadeIn" data-wow-delay=".3s"><img src="{{asset('asset/frontend/imgs/page/homepage1/placeiq.png')}}" alt="iori"></li>
            <li class="wow animate__animated animate__fadeIn" data-wow-delay=".4s"><img src="{{asset('asset/frontend/imgs/page/homepage1/airmeet.png')}}" alt="iori"></li>
            <li class="wow animate__animated animate__fadeIn" data-wow-delay=".5s"><img src="{{asset('asset/frontend/imgs/page/homepage1/spen.png')}}" alt="iori"></li>
            <li class="wow animate__animated animate__fadeIn" data-wow-delay=".6s"><img src="{{asset('asset/frontend/imgs/page/homepage1/klippa.png')}}" alt="iori"></li>
            <li class="wow animate__animated animate__fadeIn" data-wow-delay=".7s"><img src="{{asset('asset/frontend/imgs/page/homepage1/matrix.png')}}" alt="iori"></li>
          </ul>
        </div>
      </div>
      <section class="section mt-90">
        <div class="container">
          <div class="row align-items-start">
            <div class="col-lg-6">
              <h6 class="color-brand-1 mb-20 wow animate__animated animate__fadeInUp" data-wow-delay=".s">Our leadership team</h6>
              <h2 class="color-brand-1 mb-50 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">Meet the amazing team behind Iori</h2>
            </div>
          </div>
          <div class="row align-items-start">
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".s">
              <div class="card-team mb-30">
                <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/about/team1.png')}}" alt="iori"></div>
                <div class="card-info"><a class="font-lg" href="#">Devon Lane</a>
                  <p class="font-xs color-grey-200 mb-10">CEO</p>
                  <p class="font-xs color-grey-400">Sharing content online allows you to craft an online persona that reflects your personal values and professional skills. Even if you only use social media occasionally</p>
                  <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".s">
              <div class="card-team mb-30">
                <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/about/team2.png')}}" alt="iori"></div>
                <div class="card-info"><a class="font-lg" href="#">Jennie Tho</a>
                  <p class="font-xs color-grey-200 mb-10">Finance Manager</p>
                  <p class="font-xs color-grey-400">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit laborum — semper quis lectus.</p>
                  <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".s">
              <div class="card-team mb-30">
                <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/about/team3.png')}}" alt="iori"></div>
                <div class="card-info"><a class="font-lg" href="#">Symon Lesin</a>
                  <p class="font-xs color-grey-200 mb-10">Technology Manager</p>
                  <p class="font-xs color-grey-400">In a professional context it often happens that private or corporate clientsorder a publication to publish news. Excepteur sint occaecat cupidatat non proident,</p>
                  <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".s">
              <div class="card-team mb-30">
                <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/team1.png')}}" alt="iori"></div>
                <div class="card-info"><a class="font-lg" href="#">Virginia Aguilar</a>
                  <p class="font-xs color-grey-200 mb-10">Director of People</p>
                  <p class="font-xs color-grey-400">In a professional context it often happens that private or corporate clientsorder a publication to publish news. Excepteur sint occaecat cupidatat non proident,</p>
                  <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="border-bottom mt-30"></div>
      </section>
      <section class="section mt-90">
        <div class="container">
          <h6 class="color-brand-1 mb-20 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Board members</h6>
          <h2 class="color-brand-1 mb-50 wow animate__animated animate__fadeIn" data-wow-delay=".2s">Together we are strong</h2>
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member1.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Darrell Steward</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member2.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Guy Hawkins</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member3.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Darlene Robertson</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member4.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Ronald Richards</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member5.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Kathryn Murphy</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member6.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Cameron Williamson</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member7.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Floyd Miles</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member8.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Devon Lane</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member9.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Albert Flores</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member10.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Jenny Wilson</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member11.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Arlene McCoy</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wow animate__animated animate__fadeIn">
              <div class="card-member">
                <div class="card-top">
                  <div class="card-image"><img src="{{asset('asset/frontend/imgs/page/team/member12.png')}}" alt="iori"></div>
                  <div class="card-info"><span class="font-lg-bold color-brand-1">Theresa Webb</span>
                    <p class="font-xs color-grey-200">Product Designer</p>
                    <div class="list-socials"><a class="icon-socials icon-facebook" href="#"></a><a class="icon-socials icon-instagram" href="#"></a><a class="icon-socials icon-twitter" href="#"></a></div>
                  </div>
                </div>
                <div class="card-bottom">
                  <p class="font-xs color-grey-500">Joined since 2012, when we were just established. He is a great companion.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section mt-50">
        <div class="container">
          <div class="row mt-50 align-items-center">
            <div class="col-xl-5 col-lg-12 mb-40">
              <h2 class="color-brand-1 mt-10 mb-15 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Have a question?<br class="d-none d-lg-block">Our team is happy to help you</h2>
              <div class="row">
                <div class="col-lg-10 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
                  <p class="font-md color-grey-500">Access advanced order types including limit, market, stop limit and dollar cost averaging. Track your total asset holdings, values and equity over time. Monitor markets, manage your portfolio, and trade crypto on the go.</p>
                </div>
              </div>
              <div class="mt-50 text-start wow animate__animated animate__fadeIn" data-wow-delay=".4s"><a class="btn btn-brand-1 hover-up" href="#">Contact Us</a><a class="btn btn-default font-sm-bold hover-up" href="#">Learn More
                  <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                  </svg></a></div>
            </div>
            <div class="col-xl-7 col-lg-12">
              <div class="box-video-business box-images-team">
                <div class="item-video wow animate__animated animate__fadeIn" data-wow-delay=".0s"><img src="{{asset('asset/frontend/imgs/page/team/question1.png')}}" alt="iori"></div>
                <div class="box-image-right">
                  <div class="wow animate__animated animate__fadeIn" data-wow-delay=".2s"><img class="mb-20" src="{{asset('asset/frontend/imgs/page/team/question2.png')}}" alt="iori"></div>
                  <div class="wow animate__animated animate__fadeIn" data-wow-delay=".4s"><img src="{{asset('asset/frontend/imgs/page/team/question3.png')}}" alt="iori"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section pt-0 pb-50 bg-core-value bg-7 mb-40 mt-100">
        <div class="container">
          <div class="row box-list-core-value">
            <div class="col-lg-4 mb-70">
              <div class="box-core-value pl-0">
                <h1 class="color-brand-1 mb-15 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Core values</h1>
                <p class="font-md color-grey-400 wow animate__animated animate__fadeIn" data-wow-delay=".2s">We break down barriers so teams can focus on what matters – working together to create products their customers love.</p>
                <div class="mt-30 wow animate__animated animate__fadeIn" data-wow-delay=".4s"><a class="btn btn-white-circle font-sm-bold border-brand" href="#">JOIN OUR TEAM TODAY</a></div>
              </div>
            </div>
            <div class="col-lg-4">
              <ul class="list-core-value list-core-value-white">
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
              <ul class="list-core-value list-core-value-white">
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
      <section class="section mt-50">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-8 col-md-8">
              <h2 class="color-brand-1 mb-20 wow animate__animated animate__fadeInUp" data-wow-delay=".0s">From our blog</h2>
              <p class="font-lg color-gray-500 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">Aenean velit nisl, aliquam eget diam eu, rhoncus tristique dolor.<br class="d-none d-lg-block">Aenean vulputate sodales urna ut vestibulum</p>
            </div>
            <div class="col-lg-4 col-md-4 text-md-end text-start wow animate__animated animate__fadeInUp" data-wow-delay=".4s"><a class="btn btn-default font-sm-bold pl-0">View All
                <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
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
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>29 May 2022</span><span class="time-read font-xs color-grey-300">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
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
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>29 May 2022</span><span class="time-read font-xs color-grey-300">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
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
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>29 May 2022</span><span class="time-read font-xs color-grey-300">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
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
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>29 May 2022</span><span class="time-read font-xs color-grey-300">
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
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
                      <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
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
