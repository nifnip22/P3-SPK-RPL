@extends('lib.layouts.main')

@section('main-content')
    <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold" data-aos="fade-up">Galeri Foto</h1>
    <hr class="w-20 h-2 bg-success mt-4 mb-8" data-aos="fade-up">
    <div class="flex items-center gap-4 mb-4" data-aos="fade-up" data-aos-delay="500">
        <p class="text-md md:text-lg">Anda Memiliki Total <span class="font-bold">{{ $fotoCount }}</span> Foto</p>
        <button class="btn btn-success text-gray-100" onclick="my_modal_5.showModal()"><i class="fa-solid fa-plus"></i>
            Tambah Foto</button>
        <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Tambah Foto</h3>
                <p class="py-4">Isi inputan di bawah</p>
                <form method="post" action="{{ route('foto.store') }}" enctype="multipart/form-data">
                    @csrf

                    @auth
                        <input type="text" name="user_id" placeholder="Username"
                            class="input input-bordered input-primary w-full mb-6" required value="{{ auth()->id() }}"
                            hidden />
                    @endauth
                    <input type="text" name="judul_foto" placeholder="Masukkan Judul Foto"
                        class="input input-bordered focus:input-success w-full mb-6" required />
                    <textarea name="deskripsi_foto" class="textarea textarea-bordered focus:textarea-success w-full mb-6"
                        placeholder="Masukkan Deskripsi Foto" required></textarea>
                    <input type="file" name="lokasi_file"
                        class="file-input file-input-bordered file-input-success w-full mb-6" required accept="image/png, image/jpeg"/>
                    <select name="album_id" class="select select-bordered focus:select-success w-full mb-6">
                        <option disabled selected>Pilih Album (Opsional)</option>
                        @foreach ($album as $a)
                            <option value="{{ $a->id }}">{{ $a->nama_album }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success text-success hover:text-white duration-300 w-full">Tambah
                        Foto</button>
                </form>
                <div class="modal-action">
                    <form method="dialog">
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn btn-error text-white">Batal</button>
                    </form>
                </div>
            </div>
        </dialog>
    </div>
    @if ($foto->isNotEmpty())
    <div class="mb-10 grid grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 md:gap-x-8 xl:gap-x-20 gap-y-10" data-aos="fade-up" data-aos-delay="300">
        @foreach ($foto as $f)
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
    @else
    <div class="message" data-aos="fade-up" data-aos-delay="700">
        <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold opacity-30 text-center mt-28 mb-28">Tekan Tombol Tambah Foto untuk Mengunggah Foto</h1>
    </div>
    @endif

    {{-- Delete SweetAlert --}}
    @if (session('delete_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Foto Berhasil di Hapus!',
                    showConfirmButton: false,
                    timer: 2000
                });
                // Hapus pesan sesi setelah ditampilkan
                {{ Session::forget('delete_success') }}
            });
        </script>
    @endif
    @if (session('delete_error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                });
                // Hapus pesan sesi setelah ditampilkan
                {{ Session::forget('delete_error') }}
            });
        </script>
    @endif

    {{-- Tambah SweetAlert --}}
    @if (session('tambah_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Foto Berhasil di Tambahkan!',
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
