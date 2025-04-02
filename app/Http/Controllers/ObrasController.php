<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObrasController extends SiteBaseController
{
    public function index()
    {
        return view('site.obras', $this->viewData);
    }

    public function detalhes()
    {
        return view('site.obrasDetalhes', $this->viewData);
    }
}
