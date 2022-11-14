<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:dashboard_view', ['only' => ['index']]);
    }

    public function index(Request $request) {
        return view('dashboard');
    }
}
