<?php


namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  // Importação da classe Controller

class LogController extends Controller
{
    // Exibe todos os logs
    public function index()
    {
        $logs = Log::with('user')->get();  // Carrega os logs e o usuário relacionado
        return view('logs.index', compact('logs'));  // Envie para a view (ajuste conforme necessário)
    }

    // Exibe o formulário para criar um novo log
    public function create()
    {
        return view('logs.create');  // View para criar log (ajuste conforme necessário)
    }

    // Armazena o novo log
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_email' => 'required|email',
            'description' => 'required|string',
            'at_time' => 'required|date',
           
        ]);

        Log::create($validated);  // Cria o log no banco de dados

        return redirect()->route('logs.index')->with('success', 'Log criado com sucesso!');
    }

    // Exibe o formulário de edição de log
    public function edit(Log $log)
    {
        return view('logs.edit', compact('log'));  // View para editar o log (ajuste conforme necessário)
    }

    // Atualiza o log no banco
    public function update(Request $request, Log $log)
    {
        $validated = $request->validate([
            'user_email' => 'required|email',
            'description' => 'required|string',
            'at_time' => 'required|date',
        ]);

        $log->update($validated);  // Atualiza o log com os dados validados

        return redirect()->route('logs.index')->with('success', 'Log atualizado com sucesso!');
    }

    // Deleta um log
    public function destroy(Log $log)
    {
        $log->delete();  // Deleta o log

        return redirect()->route('logs.index')->with('success', 'Log deletado com sucesso!');
    }
}
