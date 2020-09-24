<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Atividade;
use App\Projeto;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atividades = Atividade::all();

        if (!$atividades->isEmpty()) {
            $atividades = Atividade::first()
                ->paginate(5);
        }

        return view('atividades.view', compact('atividades'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projetos = Projeto::all();

        return view('atividades.add', compact('projetos'));
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
            'projeto_id' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required'
        ];

        $validator = Validator::make($request->all(), $validacao);

        // Valida se a data fim é maior que a data inicio
        if (Carbon::create($request->input('data_inicio'))->greaterThan($request->input('data_fim'))) {
            $validator->errors()->add('data_inicio', 'Data início não pode ser maior que a data fim!');
        }

        if (count($validator->errors())) {
            return redirect()->route('atividades.create')->withErrors($validator->messages());
        }

        $data = $request->all();

        // Verifica se a data final da atividade é ou igual a data atual
        // Para definir se a atividade está finalizada ou não
        $data['finalizada'] = Carbon::now()->greaterThan($request->input('data_fim')) ? 1 : 0;

        // Cria o novo registro no banco de dados
        Atividade::create($data);

        // Redireciona para a mesma página informando sucesso
        return redirect()->route('atividades.create')
            ->with('success', 'Atividade cadastrada com sucesso!');
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
        $atividade = Atividade::find($id);

        return view('atividades.edit', compact('atividade'));
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

        $atividade = Atividade::find($id);

        if (count($validator->errors())) {
            return redirect()->route('atividades.create', $atividade)->withErrors($validator->messages());
        }

        $atividade->nome = $request->get('nome');
        $atividade->data_inicio = $request->get('data_inicio');
        $atividade->data_fim = $request->get('data_fim');
        $atividade->finalizada = Carbon::now()->greaterThan($request->input('data_fim')) ? 1 : 0;
        $atividade->save();

        // Redireciona para a mesma página informando sucesso
        return redirect()->route('atividades.edit', $atividade)
            ->with('success', 'Atividade alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atividade = Atividade::find($id);
        $atividade->delete();

        return redirect()->route('atividades.index');
    }
}
