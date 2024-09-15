<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = ModeModuleall();
        return view('modules.index', compact('modules'));
    }

    public function create()
    {
        return view('modules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_name' => 'required|string|max:255',
        ]);

        ModeModulecreate($request->all());

        return redirect()->route('modules.index')
                         ->with('success', 'Module created successfully.');
    }

    public function show(Module $module)
    {
        return view('modules.show', compact('module'));
    }

    public function edit(Module $module)
    {
        return view('modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $request->validate([
            'module_name' => 'required|string|max:255',
        ]);

        $module->update($request->all());

        return redirect()->route('modules.index')
                         ->with('success', 'Module updated successfully.');
    }

    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('modules.index')
                         ->with('success', 'Module deleted successfully.');
    }
}
