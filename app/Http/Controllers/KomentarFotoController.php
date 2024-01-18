<?php

namespace App\Http\Controllers;

use App\Models\KomentarFoto;
use App\Http\Requests\StoreKomentarFotoRequest;
use App\Http\Requests\UpdateKomentarFotoRequest;

class KomentarFotoController extends Controller
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
    public function store(StoreKomentarFotoRequest $request)
    {
        $validatedData = $request->validated();
        $komentar = KomentarFoto::create($validatedData);

        // Load relasi 'user' dan 'foto' untuk mendapatkan informasi yang diperlukan
        $komentar->load('user', 'foto');

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back()->with('komentar', $komentar);
    }

    /**
     * Display the specified resource.
     */
    public function show(KomentarFoto $komentarFoto)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KomentarFoto $komentarFoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKomentarFotoRequest $request, KomentarFoto $komentarFoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KomentarFoto $komentarFoto)
    {
        //
    }
}
