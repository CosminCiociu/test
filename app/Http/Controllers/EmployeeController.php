<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return EmployeeResource::collection($employee);
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
        //     "name" : "Cosmin",
        //     "email": "cosmin@gmail.com",
        //     "password": "test1234",
        //     "phone": "072026569",
        //     "company_id": "1"
        // }

        $validator = Validator::make($request->all(), [
            'name'          => ['required', 'string', 'max:255'],
            'phone'         => ['string', 'max:255'],
            'company_id'    => ['string', 'required'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:employees,email'],
            'password'      => ['required', 'string', 'min:8'],
        ]);

        if($validator->fails()){
            return response()->json(['message' => "Couldn't create employee"], 500);
        }else {
            $employee = new Employee([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone ?? "",
            'password' => Hash::make($request->password)
        ]);
            $employee->company()->associate($request->company_id);
            $employee->save();
            return response()->json($employee->id);
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
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
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
            'phone'         => ['string', 'max:255'],
            'company_id'    => ['string', 'required'],
            'email'         => ['required', 'string', 'email', 'max:255'],
            'password'      => ['required', 'string', 'min:8'],
        ]);

        if($validator->fails()){
            return response()->json(['message' => "Couldn't update employee"], 500);
        }else {
            $employee = Employee::findOrFail($id);
            $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone ?? "",
            'password' => Hash::make($request->password)
        ]);
            $employee->company()->associate($request->company_id);
            $employee->save();
            return response()->json($employee);
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
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json($employee->id);
    }
}
