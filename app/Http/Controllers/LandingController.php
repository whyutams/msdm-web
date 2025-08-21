<?php

namespace App\Http\Controllers;

use App\Models\sc;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
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
    public function show(sc $sc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sc $sc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sc $sc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sc $sc)
    {
        //
    }

    public function login() {
        return view("login");
    }

    public function register() {
        return view("register");
    }

    public function cerita() {
        return view("cerita");
    }

    public function detail() {
        return view("detail-cerita");
    }
}
