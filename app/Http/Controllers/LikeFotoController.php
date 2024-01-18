<?php

namespace App\Http\Controllers;

use App\Models\LikeFoto;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLikeFotoRequest;
use App\Http\Requests\UpdateLikeFotoRequest;

class LikeFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $like = LikeFoto::where('user_id', $user->id)->with('foto')->get();
        $likeCount = $like->count();

        // Mendapatkan semua foto yang difavoritkan oleh pengguna
        $likedFoto = $like->pluck('foto')->flatten();

        return view('lib.like_foto', [
            'title' => 'Disukai | Galleria',
            'user' => $user,
            'like' => $like,
            'likeCount' => $likeCount,
            'likedFoto' => $likedFoto,
        ]);
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
    public function store(StoreLikeFotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LikeFoto $likeFoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeFoto $likeFoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeFotoRequest $request, LikeFoto $likeFoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeFoto $likeFoto)
    {
        //
    }
}
