<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index () {
        $user = Auth::user();
        $fotoUser = Foto::where('user_id', $user->id)->orderBy('created_at', 'desc')->take(4)->get();
        $albumUser = Album::where('user_id', $user->id)->orderBy('created_at', 'desc')->take(4)->get();
        $fotoRandom = Foto::whereNotIn('user_id', [$user->id])->get();

        return view('lib.homepage', [
            'title' => 'Homepage | Galleria',
            'user' => $user,
            'fotoRandom' => $fotoRandom,
            'fotoUser' => $fotoUser,
            'albumUser' => $albumUser,
        ]);
    }
}
