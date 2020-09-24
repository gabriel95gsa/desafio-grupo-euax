<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Projeto;
use Illuminate\Support\Facades\Validator;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projetos = Projeto::all();

        if (!$projetos->isEmpty()) {
            $projetos = Projeto::first()
                ->paginate(5);
        }

        return view('projetos.view', compact('projetos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projetos.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação de valores vindos do formulário
        $validacao = [
            'nome' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required'
        ];

        $validator = Validator::make($request->all(), $validacao);

        // Valida se a data fim é maior que a data inicio
        if (Carbon::create($request->input('data_inicio'))->greaterThan($request->input('data_fim'))) {
            $validator->errors()->add('data_inicio', 'Data início não pode ser maior que a data fim!');
        }

        if (count($validator->errors())) {
            return redirect()->route('projetos.create')->withErrors($validator->messages());
        }

        // Cria o novo registro no banco de dados
        Projeto::create($request->all());

        // Redireciona para a mesma página informando sucesso
        return redirect()->route('projetos.create')
            ->with('success', 'Projeto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projeto = Projeto::find($id);
        return view('projetos.edit', compact('projeto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validação de valores vindos do formulário
        $validacao = [
            'nome' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required'
        ];

        $validator = Validator::make($request->all(), $validacao);

        // Valida se a data fim é maior que a data inicio
        if (Carbon::create($request->input('data_inicio'))->greaterThan($request->input('data_fim'))) {
            $validator->errors()->add('data_inicio', 'Data início não pode ser maior que a data fim!');
        }

        $projeto = Projeto::find($id);

        if (count($validator->errors())) {
            return redirect()->route('projetos.edit', $projeto)->withErrors($validator->messages());
        }

        $projeto->nome = $request->get('nome');
        $projeto->data_inicio = $request->get('data_inicio');
        $projeto->data_fim = $request->get('data_fim');
        $projeto->save();

        // Redireciona para a mesma página informando sucesso
        return redirect()->route('projetos.edit', $projeto)
            ->with('success', 'Projeto alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projeto = Projeto::find($id);
        $projeto->delete();

        return redirect()->route('projetos.index');
    }
}
