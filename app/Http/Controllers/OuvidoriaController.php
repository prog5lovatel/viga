<?php

namespace App\Http\Controllers;

use App\Mail\SendMailOuvidoria;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OuvidoriaController extends SiteBaseController
{
    public function index()
    {
        return view('site.ouvidoria', $this->viewData);
    }

    public function enviar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => ['nullable'],
            'email' => ['nullable', 'email'],
            'telefone' => ['nullable'],
            'arquivo' => ['nullable', 'mimes:pdf,doc,docx,jpg,jpeg'],
            'mensagem' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'erro' => $validator->errors()->first()
            ], 422);
        }

        $formulario = [
            'nome' => $request->nome ?? null,
            'telefone' => $request->telefone ?? null,
            'relacao' => $request->relacao,
            'mensagem' => $request->mensagem
        ];

        if (config('app.env') == "production") {

            $site = Site::find(1);

            Mail::to($site->email)->send(new SendMailOuvidoria("Nova solicitação de ouvidoria pelo site " . config('app.name'), $formulario, $request->file('arquivo')));
        }

        return response()->json([
            'mensagem' => "Sua mensagem foi enviada. Em breve entraremos em contato."
        ], 200);
    }
}
