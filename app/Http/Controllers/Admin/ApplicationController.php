<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //
    public function services() {
        return view('backend.new-application.services');
    }
    public function finance_services() {
        return view('backend.new-application.finance_services');
    }
    public function utilities_services() {
        return view('backend.new-application.utilities_services');
    }
    public function card_machine() {
        return view('backend.new-application.card_machine');
    }
}
