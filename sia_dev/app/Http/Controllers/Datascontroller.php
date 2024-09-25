<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelDatas;
use Illuminate\Support\Facades\DB;


class Datascontroller extends Controller
{
    public function index()
    {
        
        $data= ModelDatas::all();
        return view('pages.datas.data', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|string|max:250',
           
        ]);
    
        ModelDatas::create([
            'data' => $request->data,
          
            'observacao' => $request->observacao,
        ]);
    
        return redirect()->back()->with('success', 'Datas Aumenta com Sucesso !');
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'data' => 'required|string|max:250',
           
        ]);
    
        $materia = ModelDatas::findOrFail($id);
        $materia->update([
            'data' => $request->data,
            'observacao' => $request->observacao,
           
        ]);
    
        return redirect()->back()->with('success', 'Datas Atualiza com sucesso!');
    }
    



    public function edit($id)
    {
        $data= ModelDatas::all();
        $mat = ModelDatas::findOrFail($id); // Fetch the specific record
        return view('pages.datas.data', compact('mat','data')); // Return the form view with the fetched data
    }
    

public function destroy($id)
{
    // Check if the record exists before attempting deletion
    $sala = DB::table('datas')->where('id_datas', $id)->first();

    if ($sala) {
        // Perform the delete action
        DB::table('datas')->where('id_datas', $id)->delete();

        return redirect()->back()->with('success', 'Dados apaga com sucesso!');
    } else {
        return redirect()->back()->with('error', 'salas not found.');
    }
}





}
