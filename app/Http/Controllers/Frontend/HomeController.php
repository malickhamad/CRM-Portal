<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\SubscribtionPlan;

class HomeController extends Controller
{
    public function home()
    {


        // $plans = SubscribtionPlan::with('features')->get();
        $faqs = Faq::all();
        $testimonials = \App\Models\Testimonial::with('user')->latest()->get();

        $plans = SubscribtionPlan::all();





        return view('frontend.home', compact('plans', 'faqs', 'testimonials'));
    }

    public function pricing()
    {
        // dd($plans);
        return view('frontend.pricing', compact('plans'));
    }

    public function about()
    {
        $testimonials = \App\Models\Testimonial::with('user')->latest()->get();
        return view('frontend.about', compact('testimonials'));
    }
    public function career()
    {

        return view('frontend.career');
    }

    public function contact()
    {
        $faqs = Faq::all();

        return view('frontend.contact', compact('faqs'));
    }

    public function help()
    {
        return view('frontend.help');
    }
    public function jobdetail()
    {
        return view('frontend.job-detail');
    }

    public function productdetail()
    {
        return view('frontend.product-detail');
    }
    public function service()
    {
        return view('frontend.service');
    }
    public function shopgrid()
    {
        return view('frontend.shop-grid');
    }
    public function shoplist()
    {
        return view('frontend.shop-list');
    }


    public function team()
    {
        return view('frontend.team');
    }

    public function termconditions()
    {
        return view('frontend.term-conditions');
    }
    public function comingsoon()
    {
        return view('frontend.coming-soon');
    }
}
