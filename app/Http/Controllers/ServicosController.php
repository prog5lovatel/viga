<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicosController extends SiteBaseController
{
    public function index()
    {
        $perPage = 16;

        $this->viewData['servicos'] = Servico::paginate($perPage);

        return view('site.servicos', $this->viewData);
    }
    public function detalhes($slugServico)
    {
        $servico = Servico::with('fotos')->where('slug', $slugServico)->firstOrFail();
        $this->viewData['servico'] = $servico;
        return view('site.servicosDetalhes', $this->viewData);

    }
}
