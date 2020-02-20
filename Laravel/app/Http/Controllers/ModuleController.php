<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $modules,
            ]);
        }

        return view('modules.index', compact('modules'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module = Module::create($request->all());
        $response = [
            'message' => 'Módulo criado com sucesso.',
            'data'    => $module->toArray(),
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }

        return redirect()->route('modules.edit', ['module' => $module->id] );


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        $module = Module::find($module->id);

        return view('modules.edit', compact('module'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $module = Module::find($module->id);
        $module->title = $request['title'];
        $module->description = $request['description'];
        $module->status = $request['status'];
        $module->save();

        return redirect()->route('modules.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {

        $deletedActivities = Activity::where('module_id', $module->id)->delete();

        $deleted = Module::destroy($module->id);



        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Módulo deletado.',
                'deleted' => $deleted,
                'activities' => $deletedActivities,
            ]);
        }

        return redirect()->route('modules.index' )->with('message', 'Módulo deletado.');
    }
}
