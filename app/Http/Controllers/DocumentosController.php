<?php

namespace App\Http\Controllers;

use App\Models\Documento;

class DocumentosController extends SiteBaseController
{
    public function index()
    {
        $this->viewData['documentos'] = Documento::all();

        return view('site.documentos', $this->viewData);
    }
}
