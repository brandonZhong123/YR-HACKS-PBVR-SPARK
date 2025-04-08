<?php

namespace App\Http\Controllers;

use App\Models\GuidanceCounsellor;
use Illuminate\Http\Request;

class GuidanceController extends Controller
{
    public function index() {
        return view('pages/guidance/index',);
    }
}
