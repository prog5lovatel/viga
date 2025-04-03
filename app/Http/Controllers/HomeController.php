<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Popup;
use App\Models\Servico;

class HomeController extends SiteBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->viewData['popup'] = Popup::first();
        $this->viewData['banners'] = Banner::all();
        $this->viewData['servicos'] = Servico::all();

        return view('site.home', $this->viewData);
    }
}
