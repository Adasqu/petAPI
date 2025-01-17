<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class petController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $status = 'available')
    {
        //
        $response = Http::get("https://petstore.swagger.io/v2/pet/findByStatus",['status' => $status]);
        return view('index', ['pets'=>json_decode( $response->body)]);
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
    public function show(string $id)
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
