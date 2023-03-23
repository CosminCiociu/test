<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        return ProjectResource::collection($project);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // {
        //     "name" : "Cosmin",
        //     "description": "Description",
        //     "start_date": "2022-01-01",
        //     "end_date": "2022-01-06"
        // }
        $validator = Validator::make($request->all(), [
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['string', 'max:255'],
            'start_date'    => ['date', 'max:255'],
            'end_date'      => ['date', 'max:255'],
        ]);

        if($validator->fails()){
            return response()->json(['message' => "Couldn't create project"], 500);
        }else {
            $project = new Project([
            'name'          => $request->name,
            'description'   => $request->description ?? "",
            'start_date'    => date($request->start_date) ?? "",
            'end_date'      => date($request->end_date) ?? "",
        ]);
            $project->save();
            return response()->json($project->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($request->all(), [
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['string', 'max:255'],
            'start_date'    => ['date', 'max:255'],
            'end_date'      => ['date', 'max:255'],
        ]);

        if($validator->fails()){
            return response()->json(['message' => "Couldn't create project"], 500);
        }else {
            $project = Project::findOrFail($id);
            $project->update([
            'name'          => $request->name,
            'description'   => $request->description ?? "",
            'start_date'    => date($request->start_date) ?? "",
            'end_date'      => date($request->end_date) ?? "",
            ]);
            $project->save();
            return response()->json($project);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json($project->id);
    }
}
