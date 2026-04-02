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
        return view('backend.new-application.finance_services.card_machine');
    }
    public function loan() {
        return view('backend.new-application.finance_services.loan');
    }
    public function open_banking() {
        return view('backend.new-application.finance_services.open_banking');
    }


    // Utilities Services Pages

    public function water() {
        return view('backend.new-application.utilities_services.water');
    }

    public function broadband() {
        return view('backend.new-application.utilities_services.broadband');
    }

    public function telecom() {
        return view('backend.new-application.utilities_services.telecom');
    }

    public function gas() {
        return view('backend.new-application.utilities_services.gas');
    }

    public function electricity() {
        return view('backend.new-application.utilities_services.electricity');
    }

    public function electric_gas() {
        return view('backend.new-application.utilities_services.electric_gas');
    }
}
