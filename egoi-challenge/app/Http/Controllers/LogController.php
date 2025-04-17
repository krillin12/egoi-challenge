<?php


namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  

class LogController extends Controller
{
    private function isAdmin()
    {
        return auth()->user()->email === 'admin@gmail.com';
    }

    private function checkAdmin()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('logs.my');
        }
    }

   
    public function index()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('logs.my');
        }

        $query = Log::query();
        
        if (request()->has('search')) {
            $search = request('search');
            $query->where('user_email', 'like', "%{$search}%");
        }
        
        $logs = $query->orderBy('at_time', 'desc')->get();
        return view('logs.admin', compact('logs'));
    }

    
    public function create()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('logs.my');
        }
        return view('logs.create');
    }

   
    public function store(Request $request)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('logs.my');
        }

        $validated = $request->validate([
            'user_email' => 'required|email',
            'description' => 'required|string',
            'at_time' => 'required|date',
        ]);

        Log::create($validated);

        return redirect()->route('logs.index')->with('success', 'Log criado com sucesso!');
    }

   
    public function edit(Log $log)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('logs.my');
        }
        return view('logs.edit', compact('log'));
    }

    
    public function update(Request $request, Log $log)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('logs.my');
        }

        $validated = $request->validate([
            'user_email' => 'required|email',
            'description' => 'required|string',
            'at_time' => 'required|date',
        ]);

        $log->update($validated);

        return redirect()->route('logs.index')->with('success', 'Log atualizado com sucesso!');
    }

   
    public function destroy(Log $log)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('logs.my');
        }

        $log->delete();

        return redirect()->route('logs.index')->with('success', 'Log deletado com sucesso!');
    }

    
    public function myLogs()
    {
        $userEmail = auth()->user()->email;
        $logs = Log::where('user_email', $userEmail)
            ->orderBy('at_time', 'desc')
            ->get();
        return view('logs.my', compact('logs'));
    }

    public function download()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('logs.my');
        }

        $query = Log::query();
        
        if (request()->has('search')) {
            $search = request('search');
            $query->where('user_email', 'like', "%{$search}%");
        }
        
        $logs = $query->orderBy('at_time', 'desc')->get();
        return $this->generateCSV($logs, 'all_logs.csv');
    }

    public function downloadMy()
    {
        $userEmail = auth()->user()->email;
        $logs = Log::where('user_email', $userEmail)
            ->orderBy('at_time', 'desc')
            ->get();
        return $this->generateCSV($logs, 'my_logs.csv');
    }

    private function generateCSV($logs, $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use($logs) {
            $file = fopen('php://output', 'w');
            
            
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
           
            fputcsv($file, ['User Email', 'Description', 'Time']);

           
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->user_email,
                    $log->description,
                    $log->at_time,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
