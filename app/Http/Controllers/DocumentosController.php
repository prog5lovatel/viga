<?php

namespace App\Http\Controllers;


class DocumentosController extends SiteBaseController
{
    public function index()
    {
        return view('site.documentos', $this->viewData);
    }
}
