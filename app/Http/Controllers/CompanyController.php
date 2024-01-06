<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Company::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'address' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 401);
                }
                $input = $request->all();
                $user = Company::create($input);
                return response()->json(['status' => '200'], 200);
            }
            catch (\Throwable $th) {
                return response()->json(['status' => '402'], 200);

            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
             $c = Company::find($id);
            if (!$c) {
                return response()->json(['status' => '404', 'message' => 'Company not found'], 404);
            }
           $input = $request->all();
           $s= $c->update( $input);
            return response()->json(['status' => 200], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => '402'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company = Company::find($company->id);
        if (!$company) {
            return response()->json(['error' => 'company not found'], 404);
        }
        $company->delete();
        return response()->json(['status' => 200]);
    }
}
