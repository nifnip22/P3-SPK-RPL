<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use App\Models\LikeFoto;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFotoRequest;
use App\Http\Requests\UpdateFotoRequest;
use App\Models\KomentarFoto;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $foto = Foto::where('user_id', $user->id)->get();
        $fotoCount = $foto->count();
        $album = Album::where('user_id', $user->id)->get();

        return view('lib.foto', [
            'title' => 'Galeri Foto | Galleria',
            'user' => $user,
            'foto' => $foto,
            'fotoCount' => $fotoCount,
            'album' => $album,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFotoRequest $request)
    {
        $user = Auth::user();
        $file = $request->file('lokasi_file');
        $fileName = Str::random(16) . '.' . $file->getClientOriginalExtension();

        // Pindahkan file langsung ke folder public/assets/data_foto
        $file->move(public_path('assets/data_foto'), $fileName);

        $foto = new Foto([
            'user_id' => $user->id,
            'judul_foto' => $request->input('judul_foto'),
            'deskripsi_foto' => $request->input('deskripsi_foto'),
            'lokasi_file' => $fileName,
            'album_id' => $request->input('album_id'),
        ]);

        if ($foto->save()) {
            return redirect()->route('foto.index')->with('tambah_success', 'Foto Berhasil di Tambahkan!');
        } else {
            return redirect()->route('foto.index')->with('tambah_error', 'Terjadi Kesalahan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $foto = Foto::findOrFail($id);
        $album = Album::where('user_id', $user->id)->get();
        $likedStatus = LikeFoto::where('user_id', $user->id)
        ->where('foto_id', $foto->id)
        ->exists() ? 'liked' : 'unliked';
        $komentar = KomentarFoto::where('foto_id', $foto->id)->get();
        $komentarCount = $komentar->count();

        return view('lib.detail_foto', [
            'title' => 'Detail Foto | Galleria',
            'foto' => $foto,
            'album' => $album,
            'likedStatus' => $likedStatus,
            'komentar' => $komentar,
            'komentarCount' => $komentarCount,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFotoRequest $request, $id)
    {
        $foto = Foto::findOrFail($id);

        $validatedData = $request->validated();

        if ($foto->update([
            'judul_foto' => $validatedData['judul_foto'],
            'deskripsi_foto' => $validatedData['deskripsi_foto'],
            'album_id' => $validatedData['album_id'],
        ])) {
            return redirect()->route('foto.show', ['foto' => $foto->id])->with('edit_success', 'Foto Berhasil di Edit!');
        } else {
            return redirect()->route('foto.show', ['foto' => $foto->id])->with('edit_error', 'Terjadi Kesalahan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);

        $foto->komentarFoto()->delete();

        $filePath = public_path('assets/data_foto/' . $foto->lokasi_file);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        if ($foto->delete()) {
            return redirect()->route('foto.index')->with('delete_success', 'Foto Berhasil di Hapus!');
        } else {
            return redirect()->route('foto.index')->with('delete_error', 'Terjadi Kesalahan!');
        }
    }

    public function toggleLike($id)
    {
        $user = auth()->user();
        $foto = Foto::findOrFail($id);

        $existingLike = LikeFoto::where('user_id', $user->id)
            ->where('foto_id', $foto->id)
            ->first();

        if ($existingLike) {
            // User already liked the photo, unlike it
            $existingLike->delete();

            return response()->json(['status' => 'unliked']);
        } else {
            // User hasn't liked the photo, like it
            LikeFoto::create([
                'user_id' => $user->id,
                'foto_id' => $foto->id,
            ]);

            return response()->json(['status' => 'liked']);
        }
    }
}
