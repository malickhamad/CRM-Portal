
 {{-- for mobile header --}}



      <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#0E0E0E">
    <meta name="template-color" content="#0E0E0E">
    <meta name="description" content="Index page">
    <meta name="keywords" content="index, page">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="32x32"
    href="{{ isset($siteSettings['favicon']) ? asset('storage/' . $siteSettings['favicon']) : asset('asset/backend/images/fivestarlogo.png') }}">    <link href="{{ asset('asset/frontend/css/style.css?v=5.0.0') }}" rel="stylesheet">
    <title>{{ $siteSettings['site_title'] ?? 'Five Star Solutions' }}</title>
</head>

<body>
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="page-loading">
                    <div class="page-loading-inner">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header class="header sticky-bar">
        <div class="container">
            <div class="main-header">
                <div class="header-left">
                    <div class="header-logo"><a class="d-flex" href="{{ route('frontend.home') }}">
                        <img src="{{ isset($siteSettings['site_logo']) && file_exists(storage_path('app/public/' . $siteSettings['site_logo'])) ? asset('storage/' . $siteSettings['site_logo']) : asset('asset/backend/images/fivestarlogo.png') }}"
                        alt="Site Logo" height="70" width="300">                            </a>
                        </div>
                    <div class="header-nav">
                        <nav class="nav-main-menu d-none d-xl-block">
                            <ul class="main-menu">
                                <li ><a class="active" href="{{ route('frontend.home') }}">Home</a>
                               
                                </li>
                                <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                                <li><a href="{{ route('frontend.service') }}">Our Services</a></li>

                              
                                <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                                  <li class="has-children"><a href="#">Account</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                        <li><a href="{{ route('login') }}">Login</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span
                                class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
                    </div>
                    <div class="header-right">
                        <!-- <div class="d-inline-block box-search-top">
                            <div class="form-search-top">
                                <form action="#">
                                    <input class="input-search" type="text" placeholder="Search...">
                                    <button class="btn btn-search">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div><span class="font-lg icon-list search-post">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg></span>
                        </div> -->
                    
                        <div class="d-none d-sm-inline-block"><a class="btn btn-brand-1 hover-up"
                                href="{{ route('login') }}">Get Started</a></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-content-area">
                <div class="mobile-logo"><a class="d-flex" href="{{ route('frontend.home') }}">
                 <img src="{{ isset($siteSettings['site_logo']) && file_exists(storage_path('app/public/' . $siteSettings['site_logo'])) ? asset('storage/' . $siteSettings['site_logo']) : asset('asset/backend/images/fivestarlogo.png') }}"
                        alt="Site Logo" height="100" width="120">   
                </a></div></a></div>
                <div class="burger-icon"><span class="burger-icon-top"></span><span
                        class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
                <div class="perfect-scroll">
                    <div class="mobile-menu-wrap mobile-header-border">
                        <ul class="nav nav-tabs nav-tabs-mobile mt-25" role="tablist">
                            <li><a class="active" href="#tab-menu" data-bs-toggle="tab" role="tab"
                                    aria-controls="tab-menu" aria-selected="true">
                                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor"
                                        viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>Menu</a></li>
                            <!-- <li><a href="#tab-account" data-bs-toggle="tab" role="tab"
                                    aria-controls="tab-account" aria-selected="false">
                                    <svg class="w-6 h-6 icon-16" fill="none" stroke="currentColor"
                                        viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>Account</a></li> -->
                          
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tab-menu" role="tabpanel"
                                aria-labelledby="tab-menu">
                                <nav class="mt-15">
                                    <ul class="mobile-menu font-heading">
                                          <li class='pt-3'><a class="active" href="{{ route('frontend.home') }}">Home</a>
                               
                                </li>
                                <li class='pt-3'><a href="{{ route('frontend.about') }}">About Us</a></li>
                                <li class='pt-3'><a href="{{ route('frontend.service') }}">Our Services</a></li>

                              
                                <li class='pt-3'><a href="{{ route('frontend.contact') }}">Contact</a></li>
                                  <li class="has-children pt-3"><a href="#">Account</a>
                                    <ul class="sub-menu">
                                        <li class='pt-3'><a href="{{ route('register') }}">Register</a></li>
                                        <li class='pt-3'><a href="{{ route('login') }}">Login</a></li>

                                    </ul>
                                </li>
                                    </ul>
                                </nav>
                            </div>
                          
                     
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
