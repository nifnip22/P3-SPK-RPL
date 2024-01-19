@extends('lib.layouts.main')

@section('main-content')
    <a href="{{ route('album.index') }}" class="text-gray-300 hover:text-primary duration-300">
        <h1 class="text-xl font-bold mb-8"><i class="fa-solid fa-chevron-left"></i> Kembali ke Album</h1>
    </a>
    <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold" data-aos="fade-up">Detail Album {{ $album->nama_album }}
    </h1>
    <hr class="w-20 h-2 bg-primary mt-4 mb-8" data-aos="fade-up">
    <p class="text-md md:text-lg mb-4" data-aos="fade-up" data-aos-delay="500">Anda Memiliki <span
            class="font-bold">{{ $fotoCount }}</span> Foto dalam Album ini</p>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-20" data-aos="fade-up" data-aos-delay="300">
        @foreach ($foto as $f)
            <a href="{{ route('foto.show', ['foto' => $f->id]) }}" class="flex items-center justify-center">
                <div
                    class="card w-40 sm:w-60 md:w-80 bg-base-100 border-4 border-gray-300 hover:border-primary hover:shadow-xl hover:scale-105 duration-300">
                    <figure>
                        <img src="{{ asset('assets/data_foto/' . $f->lokasi_file) }}"
                            class="rounded-xl w-full h-40 sm:h-60 md:h-80 object-cover" draggable="false"/>
                    </figure>
                </div>
            </a>
        @endforeach
    </div>
@endsection
