<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class DocumentoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Documento $documento)
    {
        return response()->file($documento->arquivo, [
            'Content-Type' => File::mimeType($documento->arquivo),
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 0
        ]);
    }
}
