<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cliente;
use App\Models\Obra;
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

        $this->viewData['obras'] = Obra::all();

        $this->viewData['clientes'] = Cliente::all();

        return view('site.home', $this->viewData);
    }
}
