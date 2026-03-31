<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function services() {
        return view('crm.services');
    }
    public function finance_services() {
        return view('crm.finance_services');
    }
    public function utilities_services() {
        return view('crm.utilities_services');
    }
    public function card_machine() {
        return view('crm.card_machine');
    }
}
