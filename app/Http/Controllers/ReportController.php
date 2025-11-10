<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Log; // Importa o model Log para registrar logs
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // Exibe o formulário para upload de relatório
    public function uploadForm()
    {
        return view('reports.upload');
    }

    // Processa o upload do relatório enviado pelo usuário
    public function upload(Request $request)
    {
        $request->validate([
            'report' => 'required|file|mimes:pdf|max:10240',
            'title' => 'required|string|max:255',
        ], [
            'title.required' => 'O campo título é obrigatório.',
        ]);

        if ($request->hasFile('report')) {
            $file = $request->file('report');

            // Salva o arquivo na pasta storage/app/reports
            $path = $file->store('reports');

            if (!$path) {
                return back()->withErrors(['report' => 'Erro ao salvar o arquivo.']);
            }

            $report = new Report();
            $report->user_id = auth()->id();
            $report->file_path = $path;
            $report->original_filename = $file->getClientOriginalName();
            $report->status = 'pending';
            $report->title = $request->input('title');
            $report->save();

            // Registra log de upload
            Log::create([
                'user_id' => auth()->id(),
                'action' => 'upload',
                'description' => "Relatório ID {$report->id} enviado com sucesso",
                'message' => "Relatório ID {$report->id} enviado com sucesso",
            ]);

            return redirect()->route('dashboard')->with('success', 'Relatório enviado com sucesso!');
        }

        return back()->withErrors(['report' => 'Arquivo não enviado.']);
    }

    // Lista relatórios do usuário autenticado (paginação)
    public function myReports()
    {
        $reports = auth()->user()->reports()->orderBy('created_at', 'desc')->paginate(10);
        return view('reports.my', compact('reports'));
    }

    // Lista relatórios validados
    public function validatedList()
    {
        $reports = Report::where('status', 'validated')->paginate(10);
        return view('reports.validated', compact('reports'));
    }

    // Lista relatórios pendentes para validação
    public function validationList()
    {
        $reports = Report::where('status', 'pending')->paginate(10);
        return view('reports.validation', compact('reports'));
    }

    // Download dos arquivos gravados na pasta reports
    public function download($id)
    {
        $report = Report::findOrFail($id);

        // Verifica que o usuário autenticado é o dono do arquivo
        if ($report->user_id !== auth()->id()) {
            abort(403, 'Acesso negado');
        }

        if (!Storage::exists($report->file_path)) {
            abort(404, 'Arquivo não encontrado');
        }

        // Registra log de download
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'download',
            'description' => "Relatório ID {$report->id} baixado",
            'message' => "Relatório ID {$report->id} enviado com sucesso",
        ]);

        return Storage::download($report->file_path, $report->original_filename ?? 'relatorio.pdf');
    }

    // Deleta um relatório
    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        // Verifica se é o dono do relatório
        if ($report->user_id !== auth()->id()) {
            abort(403, 'Acesso negado');
        }

        // Deleta arquivo do storage
        if ($report->file_path && Storage::exists($report->file_path)) {
            Storage::delete($report->file_path);
        }

        // Deleta registro do banco
        $report->delete();

        // Registra log de exclusão
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'description' => "Relatório ID {$id} excluído",
            'message' => "Relatório ID {$report->id} enviado com sucesso",
        ]);

        return redirect()->route('reports.my')->with('success', 'Relatório excluído com sucesso!');
    }

    // Validar relatórios
    public function validateReport($id)
    {
        $report = Report::findOrFail($id);

        // Verifica permissão (exemplo)
        if ($report->user_id !== auth()->id() && !auth()->user()->hasRole('supervisor')) {
            abort(403, 'Acesso negado');
        }

        // Atualiza status do relatório para validado
        $report->status = 'validated';
        $report->save();

        return redirect()->route('reports.validation')->with('success', 'Relatório validado com sucesso!');
    }

    // Cancelar a validação
    public function cancelValidation($id)
    {
        $report = Report::findOrFail($id);

        // Verifique se usuário tem permissão para desfazer validação
        if (!auth()->user()->hasRole('supervisor')) {
            abort(403, 'Acesso negado');
        }

        $report->status = 'pending';
        $report->validated_at = null; // se possuir campo de data de validação
        $report->save();

        return redirect()->route('reports.validated')->with('success', 'Validação cancelada com sucesso!');
    }
}
