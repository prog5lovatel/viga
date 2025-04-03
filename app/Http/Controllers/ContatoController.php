<?php

namespace App\Http\Controllers;

use App\Mail\SendMailContato;
use App\Models\Setor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContatoController extends SiteBaseController
{
    public function index()
    {
        $this->viewData['setores'] = Setor::all();
        return view('site.contato', $this->viewData);
    }

    public function trabalhe()
    {
        return view('site.trabalhe', $this->viewData);
    }

    public function enviar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => ['required'],
            'email' => ['required', 'email'],
            'telefone' => ['required'],
            'setor' => ['required', 'integer', 'exists:setores,id']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'erro' => $validator->errors()->first()
            ], 422);
        }

        $setor = Setor::find($request->setor);

        $formulario = [
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'assunto' => $setor->nome,
            'mensagem' => $request->mensagem
        ];

        if (config('app.env') == "production") {

            Mail::to($setor->email)->send(new SendMailContato($formulario['nome'] . " entrou em contato pelo site " . config('app.name'), $formulario));
        }

        return response()->json([
            'mensagem' => "Sua mensagem foi enviada. Em breve entraremos em contato."
        ], 200);
    }
}
