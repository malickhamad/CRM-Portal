@extends('frontend.layouts.app')

@section('content')


    <main class="main">
      <div class="section mt-35">
        <div class="container">
          <div class="breadcrumbs wow animate__animated animate__fadeIn" data-wow-delay=".0s">
            <ul>
              <li><a href="#">
                  <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                  </svg>Home</a></li>
              <li><a href="#">Products</a></li>
              <li><a href="#">Nikon D3500 DX-Format DSLR Two Lens Kit with AF-P DX</a></li>
            </ul>
          </div>
        </div>
      </div>
      <section class="section mt-50">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-5 mb-30">
              <h3 class="color-gray-800 mb-20 wow animate__animated animate__fadeIn" data-wow-delay=".0s">Nikon D3500 DX-Format DSLR Two Lens Kit with AF-P DX</h3>
              <div class="d-flex align-items-center mb-30 box-price-banner">
                <h3 class="color-success mr-30">$318.00</h3>
                <h4 class="color-grey-200 mr-30">$420.00</h4>
                <p class="font-md color-grey-200">(In stock)</p>
              </div>
              <div class="mb-50">
                <ul class="list-dots">
                  <li class="font-xs">Class leading image quality, ISO range, image processing and metering equivalent to the award winning D500</li>
                  <li class="font-xs">Large 3.2” 922k dot, tilting Lcd screen with touch functionality. Temperature: 0 °c to 40 °c (32 °f to 104 °f) humidity: 85 percentage or less (no condensation)</li>
                  <li class="font-xs">51 point AF system with 15 cross type sensors and group area AF paired with up to 8 fps continuous shooting capability</li>
                  <li class="font-xs">Built in Wi-Fi and Bluetooth for easy connectivity through the Nikon snap bridge app</li>
                </ul>
              </div>
              <div class="box-quantity">
                <div class="form-quantity mr-10">
                  <input class="input-quantity" type="text" value="1"><span class="button-quantity button-up"></span><span class="button-quantity button-down"></span>
                </div><a class="btn btn-brand-1 mr-10" href="#">Add To Cart</a><a class="btn btn-brand-1 btn-wish" href="#">
                  <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                  </svg></a>
              </div>
            </div>
            <div class="col-lg-7 text-center mb-30">
              <div class="detail-gallery">
                <div class="product-image-slider">
                  <figure class="border-radius-10"><img src="{{asset('asset/frontend/imgs/page/product/sp1.png')}}" alt="product image"></figure>
                  <figure class="border-radius-10"><img src="{{asset('asset/frontend/imgs/page/product/sp1.png')}}" alt="product image"></figure>
                  <figure class="border-radius-10"><img src="{{asset('asset/frontend/imgs/page/product/sp1.png')}}" alt="product image"></figure>
                  <figure class="border-radius-10"><img src="{{asset('asset/frontend/imgs/page/product/sp1.png')}}" alt="product image"></figure>
                  <figure class="border-radius-10"><img src="{{asset('asset/frontend/imgs/page/product/sp1.png')}}" alt="product image"></figure>
                  <figure class="border-radius-10"><img src="{{asset('asset/frontend/imgs/page/product/sp1.png')}}" alt="product image"></figure>
                </div>
              </div>
              <div class="slider-nav-thumbnails">
                <div>
                  <div class="item-thumb"><img src="{{asset('asset/frontend/imgs/page/product/thumn1.png')}}" alt="product image"></div>
                </div>
                <div>
                  <div class="item-thumb"><img src="{{asset('asset/frontend/imgs/page/product/thumn2.png')}}" alt="product image"></div>
                </div>
                <div>
                  <div class="item-thumb"><img src="{{asset('asset/frontend/imgs/page/product/thumn3.png')}}" alt="product image"></div>
                </div>
                <div>
                  <div class="item-thumb"><img src="{{asset('asset/frontend/imgs/page/product/thumn4.png')}}" alt="product image"></div>
                </div>
                <div>
                  <div class="item-thumb"><img src="{{asset('asset/frontend/imgs/page/product/thumn5.png')}}" alt="product image"></div>
                </div>
                <div>
                  <div class="item-thumb"><img src="{{asset('asset/frontend/imgs/page/product/thumn1.png')}}" alt="product image"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="border-bottom bd-grey-80 mt-50"></div>
      </section>
      <section class="section mt-70">
        <div class="container">
          <div class="row align-items-center mb-40">
            <div class="col-lg-1"></div>
            <div class="col-lg-5 mb-30">
              <div class="img-reveal"><img src="{{asset('asset/frontend/imgs/page/product/collection1.png')}}" alt="iori"></div>
            </div>
            <div class="col-lg-5 mb-30">
              <div class="box-info-collection pr-0">
                <h3 class="color-brand-1 mb-25">Beautiful Pictures For All</h3>
                <p class="font-md color-grey-500 mb-10">You don't need to be a photographer to know a great photo when you see one. And you don't need to be a photographer to take a great photo—you just need the D3500. It's as easy to use as a point-and-shoot, but it takes beautiful DSLR photos and videos that get noticed. It feels outstanding in your hands, sturdy and balanced with controls where you want them</p>
                <div class="box-button mt-30"><a class="btn btn-brand-1 hover-up" href="#">View Collections</a><a class="btn btn-default font-sm-bold hover-up" href="#">Learn More
                    <svg class="w-6 h-6 icon-16 ml-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg></a></div>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-lg-1"></div>
            <div class="col-lg-5 mb-30">
              <div class="box-info-collection pl-0">
                <h3 class="color-brand-1 mb-25">Easy. Portable. Amazing</h3>
                <p class="font-md color-grey-500 mb-10">Take more memorable images. The photos you take with the D3500 capture more than the moment—they capture the feeling of the moment, a feeling that can be shared immediately with your friends and family and then relived for a lifetime.</p>
                <div class="mt-20"></div>
                <ul class="list-ticks">
                  <li>
                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>Less thinking. More shooting
                  </li>
                  <li>
                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>Picture after amazing picture
                  </li>
                  <li>
                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>The day tripper
                  </li>
                  <li>
                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>Colors that pop in any light
                  </li>
                  <li>
                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>Newbies welcome
                  </li>
                  <li>
                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg')}}">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>Fast, accurate focusing
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-5 mb-30">
              <div class="img-reveal"><img src="{{asset('asset/frontend/imgs/page/product/collection2.png')}}" alt="iori"></div>
            </div>
          </div>
        </div>
      </section>
      <section class="section mt-50 pt-50">
        <div class="container">
          <div class="bg-brand-1 box-cover-video">
            <div class="row align-items-center">
              <div class="col-xl-6 col-lg-6">
                <div class="img-reveal"><img class="d-block" src="{{asset('asset/frontend/imgs/page/product/img-video.png')}}" alt="iori"></div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <div class="box-info-video"><span class="btn btn-tag wow animate__animated animate__fadeIn" data-wow-delay=".0s">Twice the fun</span>
                  <h3 class="color-brand-2 mt-10 mb-15 wow animate__animated animate__fadeIn" data-wow-delay=".2s">Your camera's bridge to your world</h3>
                  <p class="font-md color-white wow animate__animated animate__fadeIn" data-wow-delay=".4s">The D3500 Two Lens Kit includes two matched lenses to help you cover all the angles. The AF-P DX NIKKOR 18-55mm f/3.5-5.6G VR lens is great for portraits, landscapes, videos and other wide perspective shots. The AF-P DX NIKKOR 70-300mm f/4.5-6.3G ED is a versatile telephoto zoom lens that's great for sports, concerts, nature and more.</p>
                  <div class="box-button-video"><a class="btn btn-play font-sm-bold popup-youtube hover-up" href="https://www.youtube.com/watch?v=sVPYIRF9RCQ">Play Video</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section mt-50">
        <div class="container">
          <div class="row mt-50">
            <div class="col-xl-4 col-lg-3">
              <h3 class="color-brand-1 mb-20 wow animate__animated animate__fadeIn" data-wow-delay=".0s">See why we are<br class="d-none d-lg-block">trusted the world over</h3>
            </div>
            <div class="col-xl-8 col-lg-9">
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-lg-end text-center mb-20">
                  <h2 class="color-brand-1"><span class="counter">469</span><span>K</span></h2>
                  <p class="font-lg color-brand-1">Social followers</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-lg-end text-center mb-20">
                  <h2 class="color-brand-1"><span class="count">25</span><span>K+</span></h2>
                  <p class="font-lg color-brand-1">Happy Clients</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-lg-end text-center mb-20">
                  <h2 class="color-brand-1"><span class="count">756</span><span>K</span></h2>
                  <p class="font-lg color-brand-1">Project Done</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-lg-end text-center mb-20">
                  <h2 class="color-brand-1"><span class="count">120</span></h2>
                  <p class="font-lg color-brand-1">Global branch</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="border-bottom mt-70"></div>
      </section>
      <section class="section mt-100">
        <div class="container">
          <h2 class="color-brand-1 mb-60">Product information</h2>
          <h6 class="font-2xl color-brand-1 mb-15">Item details</h6>
          <div class="row">
            <div class="col-lg-6">
              <div class="table-responsive">
                <table class="table table-product-info">
                  <tr>
                    <th>Model Name</th>
                    <td>Z fc DX-format Mirrorless</td>
                  </tr>
                  <tr>
                    <th>Brand</th>
                    <td>Nikon</td>
                  </tr>
                  <tr>
                    <th>Model Number</th>
                    <td>1675</td>
                  </tr>
                  <tr>
                    <th>Color</th>
                    <td>Silver / Black / Gold</td>
                  </tr>
                  <tr>
                    <th>Included Components</th>
                    <td>Camera Body & Lens</td>
                  </tr>
                  <tr>
                    <th>Age Range (Description)</th>
                    <td>Adult</td>
                  </tr>
                  <tr>
                    <th>Processor Description</th>
                    <td>Nikon Expeed 6</td>
                  </tr>
                  <tr>
                    <th>Operating Humidity</th>
                    <td>Less than 85%</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-info-product">
                <ul class="list-dots mt-5">
                  <li class="font-md">Superb image quality: 20.9 MP DX CMOS sensor paired with EXPEED 6 processing engine</li>
                  <li class="font-md">Vlogger Ready: 4K UHD, Flip out Vari-angle LCD, full time AF with eye detection, built-in stereo microphone, external microphone jack, live stream and web conference compatible</li>
                  <li class="font-md">Heritage Design: Classic tactile design with analog controls for shutter speed, ISO and exposure compensation</li>
                  <li class="font-md">Send images to your phone: Always connected using the free Nikon SnapBridge app and a compatible smart device. Intuitive: Easy access to Auto Mode, quick settings and the Menu help guide.</li>
                  <li class="font-md">Lens Compatibility: Compatible with NIKKOR Z lenses as well as F Mount NIKKOR lenses using FTZ Mount Adapter (sold separately).</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row mt-30">
            <div class="col-lg-6 mb-30">
              <h6 class="font-2xl color-brand-1 mb-15">Imaging</h6>
              <div class="table-responsive">
                <table class="table table-product-info">
                  <tr>
                    <th>Auto Focus Technology</th>
                    <td>Phase Detection</td>
                  </tr>
                  <tr>
                    <th>Product information</th>
                    <td>1.50:1, 16:9</td>
                  </tr>
                  <tr>
                    <th>Display Resolution Maximum</th>
                    <td>Approx. 1040 k-dot</td>
                  </tr>
                  <tr>
                    <th>Photo Sensor Size</th>
                    <td>APS-C</td>
                  </tr>
                  <tr>
                    <th>Photo Sensor Technology</th>
                    <td>CMOS</td>
                  </tr>
                  <tr>
                    <th>Effective Still Resolution</th>
                    <td>20.9 MP</td>
                  </tr>
                  <tr>
                    <th>Maximum Webcam Image Resolution</th>
                    <td>16 MP</td>
                  </tr>
                  <tr>
                    <th>Frame Rate</th>
                    <td>Up to 120 fps</td>
                  </tr>
                  <tr>
                    <th>White balance settings</th>
                    <td>Auto</td>
                  </tr>
                  <tr>
                    <th>Self Timer Duration</th>
                    <td>20 seconds</td>
                  </tr>
                  <tr>
                    <th>JPEG quality level</th>
                    <td>Basic, Fine, Normal</td>
                  </tr>
                  <tr>
                    <th>Camera Flash</th>
                    <td>Hotshoe</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-lg-6 mb-30">
              <h6 class="font-2xl color-brand-1 mb-15">Exposure</h6>
              <div class="table-responsive">
                <table class="table table-product-info">
                  <tr>
                    <th>Expanded ISO Max / Min</th>
                    <td>204800 /100 </td>
                  </tr>
                  <tr>
                    <th>Shooting Modes</th>
                    <td>1/4000 seconds</td>
                  </tr>
                  <tr>
                    <th>Max Shutter Speed</th>
                    <td>900 seconds</td>
                  </tr>
                  <tr>
                    <th>Min Shutter Speed</th>
                    <td>Manual, Automatic</td>
                  </tr>
                  <tr>
                    <th>Exposure Control Type</th>
                    <td>Evaluative</td>
                  </tr>
                  <tr>
                    <th>Metering Description</th>
                    <td>Automatic</td>
                  </tr>
                </table>
              </div>
              <h6 class="font-2xl color-brand-1 mb-15 mt-25">Lens</h6>
              <div class="table-responsive">
                <table class="table table-product-info">
                  <tr>
                    <th>Lens Type, Aperture Modes  </th>
                    <td>Wide Angle / F3.5-F6.3</td>
                  </tr>
                  <tr>
                    <th>Optical Zoom</th>
                    <td>3 x</td>
                  </tr>
                  <tr>
                    <th>Focus Type</th>
                    <td>Auto Focus, Manual Focus</td>
                  </tr>
                  <tr>
                    <th>Photo Filter Thread Size</th>
                    <td>46 Millimeters</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section mt-50 mb-40 pt-55 pb-55 bg-grey-80">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".0s">
              <div class="card-small card-small-2">
                <div class="card-image"><a href="#">
                    <div class="box-image"><img src="{{asset('asset/frontend/imgs/page/product/delivery.svg')}}" alt="iori"></div></a></div>
                <div class="card-info"><a href="#">
                    <h6 class="color-brand-1 mb-10">Fast Delivery</h6></a>
                  <p class="font-xs color-grey-500">We come together wherever we are – across time zones, regions, offices and screens. You will receive support from your teammates anytime and anywhere.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
              <div class="card-small card-small-2">
                <div class="card-image"><a href="#">
                    <div class="box-image"><img src="{{asset('asset/frontend/imgs/page/product/secure.svg')}}" alt="iori"></div></a></div>
                <div class="card-info"><a href="#">
                    <h6 class="color-brand-1 mb-10">Secure payment</h6></a>
                  <p class="font-xs color-grey-500">Our teams reflect the rich diversity of our world, with equitable access to opportunity for everyone. No matter where you come from</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
              <div class="card-small card-small-2">
                <div class="card-image"><a href="#">
                    <div class="box-image"><img src="{{asset('asset/frontend/imgs/page/product/support.svg')}}" alt="iori"></div></a></div>
                <div class="card-info"><a href="#">
                    <h6 class="color-brand-1 mb-10">Support 24/7</h6></a>
                  <p class="font-xs color-grey-500">We believe in your freedom to work when and how you work best, to help us all thrive. Only freedom and independent work can bring out the best in you.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 wow animate__animated animate__fadeIn" data-wow-delay=".6s">
              <div class="card-small card-small-2">
                <div class="card-image"><a href="#">
                    <div class="box-image"><img src="{{asset('asset/frontend/imgs/page/product/return.svg')}}" alt="iori"></div></a></div>
                <div class="card-info"><a href="#">
                    <h6 class="color-brand-1 mb-10">Return &amp; Refund</h6></a>
                  <p class="font-xs color-grey-500">Knowing that there is real value to be gained from helping people to simplify whatever it is that they do and bring.</p>
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
