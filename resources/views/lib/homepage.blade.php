@extends('lib.layouts.main')

@section('hero')
    <div class="mt-16">
        <div class="hero" id="parallax" transition-style="in:square:center"
            style="background-image: url(https://images.unsplash.com/photo-1558185348-c1e6420f12d2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-center text-white">
                <div>
                    <h1 class="hero-title mb-4 text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-bold">Abadikan
                        Momen
                        Spesialmu<br>dengan Galleria</h1>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="foto_section mb-20">
        <h1 class="section_title text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">Foto yang Telah
            Anda Unggah Baru-Baru ini</h1>
        <hr class="animated-hr w-72 h-2 bg-green-500 mt-4 mb-12">
        @if ($fotoUser->isNotEmpty())
            <div class="mb-12 flex flex-wrap lg:flex-nowrap gap-x-10 justify-center" data-aos="fade-up">
                @foreach ($fotoUser as $f)
                    <a href="{{ route('foto.show', ['foto' => $f->id]) }}" class="flex items-center justify-center">
                        <div
                            class="card w-40 sm:w-60 md:w-80 bg-base-100 border-4 border-gray-300 hover:border-success hover:shadow-xl hover:scale-105 duration-300">
                            <figure>
                                <img src="{{ asset('assets/data_foto/' . $f->lokasi_file) }}"
                                    class="rounded-xl w-full h-40 sm:h-60 md:h-80 object-cover" draggable="false"/>
                            </figure>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="flex justify-end items-center">
                <button class="btn btn-success text-gray-100 hover:scale-110 duration-300" onclick="redirectToFoto()" data-aos="fade-up"
                    data-aos-delay="200">Lihat Foto
                    Lainnya <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        @else
            <div class="mb-12 mt-32 flex flex-col gap-y-10 justify-center items-center" data-aos="fade-up">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold opacity-30">
                    Anda Belum Memiliki Foto
                </h1>
                <button class="btn btn-success text-gray-100 hover:scale-110 duration-300 mb-32" onclick="redirectToFoto()" data-aos="fade-up"
                    data-aos-delay="200">Unggah Foto <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        @endif
    </div>

    <div class="album_section mb-20">
        <h1 class="section_title text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">Album Terbaru yang Anda
            Buat</h1>
        <hr class="animated-hr w-72 h-2 bg-primary mt-4 mb-12">
        @if ($albumUser->isNotEmpty())
            <div class="mb-12 flex flex-wrap lg:flex-nowrap gap-x-10 justify-center" data-aos="fade-up">
                @foreach ($albumUser as $a)
                    <a href="{{ route('album.show', ['album' => $a->id]) }}" class="flex items-center justify-center">
                        <div
                            class="card w-80 md:w-96 bg-base-100 ring-2 ring-gray-300 hover:ring-primary hover:shadow-xl hover:shadow-teal-100 duration-300">
                            <figure class="px-10 pt-10">
                                <img src="{{ asset('assets/png/album.png') }}" class="rounded-xl w-20 object-cover" />
                            </figure>
                            <div class="card-body items-center text-center">
                                <h2 class="card-title font-bold text-ellipsis">{{ $a->nama_album }}</h2>
                                <p class="font-semibold">{{ $a->deskripsi }}</p>
                                <p><span class="font-bold">{{ $a->foto_count }}</span> Foto
                                <p>{{ $a->created_at }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="flex justify-end items-center">
                <button class="btn btn-primary text-gray-100 hover:scale-110 duration-300" onclick="redirectToAlbum()" data-aos="fade-up"
                    data-aos-delay="200">Lihat Album
                    Lainnya <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        @else
            <div class="mb-12 mt-32 flex flex-col gap-y-10 justify-center items-center" data-aos="fade-up">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold opacity-30">
                    Anda Belum Memiliki Album
                </h1>
                <button class="btn btn-primary text-gray-100 hover:scale-110 duration-300 mb-32" onclick="redirectToAlbum()" data-aos="fade-up"
                    data-aos-delay="200">Buat Album <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        @endif
    </div>

    <div class="favorit_section mb-32">
        <h1 class="section_title text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">Foto Terbaru yang mungkin
            Anda Juga Suka
        </h1>
        <hr class="animated-hr w-72 h-2 bg-secondary mt-4 mb-12">
        <div class="popular_slider mb-12 flex gap-x-4">
            @foreach ($fotoRandom as $f)
                <a href="{{ route('foto.show', ['foto' => $f->id]) }}" class="flex items-center justify-center">
                    <div
                        class="card w-40 sm:w-60 md:w-80 bg-base-100 border-4 border-gray-300 hover:border-secondary hover:shadow-xl duration-300">
                        <figure>
                            <img src="{{ asset('assets/data_foto/' . $f->lokasi_file) }}"
                                class="rounded-xl w-full h-40 sm:h-60 md:h-80 object-cover" />
                        </figure>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
