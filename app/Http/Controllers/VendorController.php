<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Vendor::get();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            $input = $request->all();
            $user = Vendor::create($input);
            return response()->json(['status' => '200'], 200);
        }
        catch (\Throwable $th) {
            return response()->json(['status' => '402'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $c = Vendor::find($id);
           if (!$c) {
               return response()->json(['status' => '404', 'message' => 'Vendor not found'], 404);
           }
          $s= $c->update([
               'name' => $request->name,

           ]);
           return response()->json(['status' => 200], 200);
       } catch (\Throwable $th) {
           return response()->json(['status' => '402'], 200);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor = Vendor::find($vendor->id);
        if (!$vendor) {
            return response()->json(['error' => 'vendor not found'], 404);
        }
        $vendor->delete();
        return response()->json(['status' => 200]);
    }
}
