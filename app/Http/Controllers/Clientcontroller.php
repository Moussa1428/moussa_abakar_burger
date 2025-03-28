<?php

namespace App\Http\Controllers;

use App\Models\Gestionnaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Clientcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Client.index');
    }

    public function menu(){
        return view('Client.menu');
    }
    public function commandes(){
        return view('Client.commandes');
    }
    public function panier(){
        return view('Client.panier');
    }
    public function facturesclient(){
        return view('Client.factures');
    }

    public function profileclient(){
        return view('Client.profile');
    }
    public function registerclient(){
        return view('Client.register');
    }
    public function loginclient(){
        return view('Client.login');
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

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
