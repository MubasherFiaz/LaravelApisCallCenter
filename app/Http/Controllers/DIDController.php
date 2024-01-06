<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\DID;
use Illuminate\Http\Request;

class DIDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DID::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.    'number','score','flagged','is_external','is_enabled','user_id','vendor_id','company_id'
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'number' => 'required',
                'user_id' => 'required',
                'vendor_id' => 'required',
                'company_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            $input = $request->all();
            $user = DID::create($input);
            return response()->json(['status' => '200'], 200);
        }
        catch (\Throwable $th) {
            return response()->json(['status' => '402'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($dID)
    {
        return DID::with('user','company','vendor')->where('id',$dID)->get();

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DID $dID)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $c = DID::find($id);
           if (!$c) {
               return response()->json(['status' => '404', 'message' => 'DID not found'], 404);
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
    public function destroy($dID)
    {
        $did = DID::find($dID);
        if (!$did) {
            return response()->json(['error' => 'did not found'], 404);
        }
        $did->delete();
        return response()->json(['status' => 200]);
    }
}
