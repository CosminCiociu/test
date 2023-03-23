<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::all();
        return CompanyResource::collection($company);
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
        // Postman Data that works :3
        // {
        //     "name" : "Company 4",
        //     "address": "Adress 4"
        // }

        $validator = Validator::make($request->all(), [
            'name'          => ['required', 'string', 'max:255'],
            'address'       => ['string', 'max:255'],
        ]);

        if($validator->fails()){
            return response()->json(['message' => "Couldn't create company"], 500);
        }else {
            $company = new Company([
            'name' => $request->name,
            'address' => $request->address,
        ]);
            $company->save();
            return response()->json($company->id);
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
        $company = Company::findOrFail($id);
        return response()->json($company);
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
            'address'       => ['string', 'max:255'],
        ]);

        if($validator->fails()){
            return response()->json(['message' => "Couldn't update company"], 500);
        }else {
            $company = Company::findOrFail($id);
            $company->update([
            'name' => $request->name,
            'email' => $request->address,
            ]);
            $company->save();
            return response()->json($company);
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
        $company = Company::findOrFail($id);
        $company->employees()->update(['company_id' => null]);
        $company->projects()->update(['company_id' => null]);
        $company->delete();
        return response()->json($company->id);
    }
}
