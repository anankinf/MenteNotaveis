<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Module;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activity = Activity::create($request->all());
        $response = [
            'message' => 'Atividade criada com sucesso.',
            'data'    => $activity->toArray(),
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }

        return redirect()->route('modules.edit', ['module' => $activity->module_id]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $activity = Activity::find($activity->id);

        return view('activities.edit', compact('activity'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $activity = Activity::find($activity->id);
        $activity->module_id = $request['module_id'];
        $activity->title = $request['title'];
        $activity->description = $request['description'];
        $activity->status = $request['status'];
        $activity->save();

        return redirect()->route('modules.edit', ['module' => $request['module_id']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {

        $deleted = Activity::destroy($activity->id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Atividade deletada.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('modules.edit', ['module' => $activity['module_id']])->with('message', 'Atividade deletada.');
    }
}
