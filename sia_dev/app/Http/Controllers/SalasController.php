<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use App\Models\ModelSalaAula;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SalasController extends Controller
{
   public function index()
    {
        
        $sala= ModelSalaAula::all();
        return view('pages.salas.sala', compact('sala'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'nome_sala' => 'required|string|max:250',
           
        ]);
    
        ModelSalaAula::create([
            'nome_sala' => $request->nome_sala,
          
            'observacao' => $request->observacao,
        ]);
    
        return redirect()->back()->with('success', 'Salas Aumenta com Sucesso !');
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_sala' => 'required|string|max:250',
           
        ]);
    
        $materia = ModelSalaAula::findOrFail($id);
        $materia->update([
            'nome_sala' => $request->nome_sala,
            'observacao' => $request->observacao,
           
        ]);
    
        return redirect()->back()->with('success', 'Salas Atualiza com sucesso!');
    }
    



    public function edit($id)
    {
        $sala= ModelSalaAula::all();
        $mat = ModelSalaAula::findOrFail($id); // Fetch the specific record
        return view('pages.salas.sala', compact('mat','sala')); // Return the form view with the fetched data
    }
    

public function destroy($id)
{
    // Check if the record exists before attempting deletion
    $sala = DB::table('salas')->where('id_sala', $id)->first();

    if ($sala) {
        // Perform the delete action
        DB::table('salas')->where('id_sala', $id)->delete();

        return redirect()->back()->with('success', 'Dados apaga com sucesso!');
    } else {
        return redirect()->back()->with('error', 'salas not found.');
    }
}






}
