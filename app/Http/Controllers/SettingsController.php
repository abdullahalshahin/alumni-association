<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:setting_view|setting_edit', ['only' => ['index']]);
        $this->middleware('permission:setting_edit', ['only' => ['update']]);
    }

    public function index() {
        return view('settings.index');
    }

    public function update() {
        //
    }
}
