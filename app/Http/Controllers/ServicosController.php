<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicosController extends SiteBaseController
{
    public function index()
    {
        return view('site.servicos', $this->viewData);
    }
    public function detalhes()
    {
        return view('site.servicosDetalhes', $this->viewData);
    }
}
