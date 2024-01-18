<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\User;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $album = Album::where('user_id', $user->id)->withCount('foto')->get();
        $albumCount = $album->count();

        return view('lib.album', [
            'title' => 'Album | Galleria',
            'user' => $user,
            'album' => $album,
            'albumCount' => $albumCount,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumRequest $request)
    {
        $user = Auth::user();

        $album = new Album([
            'user_id' => $user->id,
            'nama_album' => $request->input('nama_album'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        if($album->save()) {
            return redirect()->route('album.index')->with('tambah_success', 'Album Berhasil di Tambahkan!');
        } else {
            return redirect()->route('album.index')->with('tambah_error', 'Terjadi Kesalahan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $album = Album::findOrFail($id);
        $foto = $album->foto;
        $fotoCount = $foto->count();
        $title = "Detail Album";

        return view('lib.detail_album', compact('album', 'foto', 'fotoCount' ,'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }
}
