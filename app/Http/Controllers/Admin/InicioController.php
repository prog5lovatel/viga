<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class InicioController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('admin.inicio');
    }
}
