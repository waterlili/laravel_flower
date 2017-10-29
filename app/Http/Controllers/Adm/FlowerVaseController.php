<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FlowerVaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdd()
    {
        dd("sdfs");
        return view('admin.page.flower_vase.add');
    }
}
