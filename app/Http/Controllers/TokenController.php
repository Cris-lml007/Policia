<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\token;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(token $token)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(token $token)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, token $token)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(token $token)
    {
        //
    }
    public function register(Request $request)
    {
        $userAuth = Auth::user();
        $registerAgent = token::where("token",$request->qrData)->where("agent_id",$userAuth->ci)->first();
        if($registerAgent){
            $registerAgent->validation = 1;
            $registerAgent->save();
            return response()->json(true);
        }
        return response()->json(false);
    }
    
}
