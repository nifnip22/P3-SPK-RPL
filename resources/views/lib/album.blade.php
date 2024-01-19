@extends('lib.layouts.main')

@section('main-content')
    <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold" data-aos="fade-up">Album</h1>
    <hr class="w-20 h-2 bg-primary mt-4 mb-8" data-aos="fade-up">
    <div class="flex items-center gap-4 mb-4" data-aos="fade-up" data-aos-delay="500">
        <p class="text-md md:text-lg">Anda Memiliki Total <span class="font-bold">{{ $albumCount }}</span> Album</p>
        <button class="btn btn-primary text-gray-100" onclick="my_modal_5.showModal()"><i class="fa-solid fa-plus"></i>
            Tambah Album</button>
    </div>
    <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Tambah Album</h3>
            <p class="py-4">Isi inputan di bawah</p>
            <form method="post" action="{{ route('album.store') }}">
                @csrf

                @auth
                    <input type="text" name="user_id" placeholder="Username"
                        class="input input-bordered input-primary w-full mb-6" required value="{{ auth()->id() }}" hidden />
                @endauth
                <input type="text" name="nama_album" placeholder="Masukkan Nama Album"
                    class="input input-primary w-full mb-6" required />
                <textarea name="deskripsi" class="textarea textarea-primary w-full mb-6" placeholder="Masukkan Deskripsi Album"></textarea>
                <button type="submit" class="btn btn-primary text-primary hover:text-white duration-300 w-full">Tambah
                    Album</button>
            </form>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn btn-error text-white">Batal</button>
                </form>
            </div>
        </div>
    </dialog>
    @if ($album->isNotEmpty())
        <div class="mb-10 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 md:gap-x-8 xl:gap-x-20 gap-y-10"
            data-aos="fade-up" data-aos-delay="300">
            @foreach ($album as $a)
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
                                {{-- <p>{{ $a->created_at->format('d/M/Y') }}</p> --}}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="message" data-aos="fade-up" data-aos-delay="700">
            <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold opacity-30 text-center mt-28 mb-28">Tekan
                Tombol Tambah Album untuk Mengunggah Album</h1>
        </div>
    @endif

    {{-- Tambah SweetAlert --}}
    @if (session('tambah_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Album Berhasil di Tambahkan!',
                    showConfirmButton: false,
                    timer: 2000
                });
                // Hapus pesan sesi setelah ditampilkan
                {{ Session::forget('tambah_success') }}
            });
        </script>
    @endif
    @if (session('tambah_error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                });
                // Hapus pesan sesi setelah ditampilkan
                {{ Session::forget('tambah_error') }}
            });
        </script>
    @endif
@endsection
