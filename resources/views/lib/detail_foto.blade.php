@extends('lib.layouts.main')

@section('main-content')
    <a href="{{ route('foto.index') }}" class="text-gray-300 hover:text-success duration-300">
        <h1 class="text-xl font-bold mb-8"><i class="fa-solid fa-chevron-left"></i> Kembali ke Galleri</h1>
    </a>
    <div class="flex flex-col lg:flex-row items-center justify-center gap-4 mb-10">
        <a>
            <div class="card w-96 bg-base-200 border-4 border-success" data-aos="fade-right">
                <img src="{{ asset('assets/data_foto/' . $foto->lokasi_file) }}"
                    class="rounded-xl max-w-full h-auto object-cover" draggable="false">
            </div>
        </a>
        <div class="bg-base-200 w-full rounded-xl p-6" data-aos="fade-left">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $foto->judul_foto }}</h1>
            <p class="text-xl md:text-2xl font-medium bg-white p-3 rounded-xl mb-8">{{ $foto->deskripsi_foto }}</p>
            <h2 class="text-lg md:text-xl font-bold mb-4">Detail Lebih Lanjut:</h2>
            <p class="text-md md:text-lg font-medium mb-2"><i class="fa fa-user"></i> <span
                    class="font-semibold">{{ $foto->user->name }}</span></p>
            <p class="text-md md:text-lg font-medium mb-2"><i class="fa fa-images"></i> <span
                    class="font-semibold">{{ $foto->album ? $foto->album->nama_album : 'Tidak Ada Album' }}</span></p>
            <p class="text-md md:text-lg font-medium mb-8"><i class="fa fa-calendar"></i> <span
                    class="font-semibold">{{ $foto->created_at->format('d/M/Y') }}</span></p>
            <h2 class="text-lg md:text-xl font-bold mb-4">Opsi:</h2>
            <div class="flex flex-wrap items-center gap-x-3 gap-y-4">
                <button class="btn btn-secondary text-white" onclick="toggleLike()" data-foto-id="{{ $foto->id }}">
                    <i id="like-icon" class="{{ $likedStatus === 'liked' ? 'fas' : 'far' }} fa-heart"></i> Suka
                </button>
                <script>
                    var likedStatus = @json($likedStatus);

                    function toggleLike() {
                        var fotoId = $('[data-foto-id]').data('foto-id');

                        $.ajax({
                            url: '/foto/' + fotoId + '/like',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.status === 'liked') {
                                    new Noty({
                                        text: '<i class="fa-solid fa-heart mr-2"></i> Foto di Sukai!',
                                        theme: 'sunset',
                                        type: 'error',
                                        layout: 'bottomRight',
                                        timeout: 3000,
                                        progressBar: true,
                                    }).show();

                                    $('#like-icon').removeClass('far').addClass('fas');
                                    likedStatus = 'liked';
                                } else if (response.status === 'unliked') {
                                    new Noty({
                                        text: '<i class="fa-solid fa-heart-crack mr-2"></i> Foto Batal di Sukai!',
                                        theme: 'sunset',
                                        type: 'error',
                                        layout: 'bottomRight',
                                        timeout: 3000,
                                        progressBar: true,
                                    }).show();

                                    $('#like-icon').removeClass('fas').addClass('far');
                                    likedStatus = 'unliked';
                                }
                            },
                            error: function(error) {
                                console.error('Error:', error);
                            }
                        });
                    }
                </script>

                @if (auth()->check() && $foto->user_id == auth()->user()->id)
                    <button class="btn btn-warning" onclick="my_modal_5.showModal()"><i class="fa fa-pen-to-square"></i>
                        Edit
                        Foto</button>
                    <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <h3 class="font-bold text-lg">Edit Foto</h3>
                            <p class="py-4">Isi inputan di bawah</p>
                            <form method="post" action="{{ route('foto.update', ['foto' => $foto->id]) }}">
                                @csrf
                                @method('PUT')

                                <input type="text" name="judul_foto" placeholder="Masukkan Judul Foto"
                                    class="input input-bordered focus:input-warning w-full mb-6"
                                    value="{{ $foto->judul_foto }}" required />
                                <textarea name="deskripsi_foto" class="textarea textarea-bordered focus:textarea-warning w-full mb-6"
                                    placeholder="Masukkan Deskripsi Foto" required>{{ $foto->deskripsi_foto }}</textarea>
                                <select name="album_id" class="select select-bordered focus:select-warning w-full mb-6">
                                    <option value="{{ optional($foto->album)->id }}" selected>
                                        *Album Sekarang: {{ optional($foto->album)->nama_album ?: 'Tidak Ada' }}*
                                    </option>
                                    <option disabled>===Pilih Album di Bawah===</option>
                                    <option value="">Tidak Memiliki Album</option>
                                    @foreach ($album as $a)
                                        <option value="{{ $a->id }}">{{ $a->nama_album }}</option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                    class="btn btn-warning text-warning hover:text-white duration-300 w-full">Edit
                                    Foto</button>
                            </form>
                            <div class="modal-action">
                                <form method="dialog">
                                    <!-- if there is a button in form, it will close the modal -->
                                    <button class="btn btn-error text-gray-100">Batal</button>
                                </form>
                            </div>
                        </div>
                    </dialog>

                    <form action="{{ route('foto.destroy', ['foto' => $foto->id]) }}" method="POST"
                        id="delete-form-{{ $foto->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-button btn btn-error text-error hover:text-gray-100"
                            data-id="{{ $foto->id }}"><i class="fa fa-trash-can"></i> Hapus Foto</button>
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const deleteButtons = document.querySelectorAll('.delete-button');

                            deleteButtons.forEach(button => {
                                button.addEventListener('click', function() {
                                    const dataId = button.getAttribute('data-id');

                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Apakah Anda Yakin Data ini Dihapus?',
                                        showDenyButton: true,
                                        showCancelButton: false,
                                        confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus!',
                                        confirmButtonColor: 'red',
                                        denyButtonText: `<i class="fa fa-times"></i> Batal`,
                                        denyButtonColor: 'grey',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            const form = document.getElementById(`delete-form-${dataId}`);
                                            form.submit();
                                        }
                                    });
                                });
                            });
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>
    <div class="bg-base-200 w-full p-6 rounded-xl" data-aos="fade-up" data-aos-delay="400">
        <h2 class="text-xl md:text-2xl font-bold mb-3">Komentar</h2>
        <p class="text-sm md:text-md mb-6">Ada <span class="font-bold">{{ $komentarCount }}</span> Komentar di Foto ini,
            Anda juga Bisa
            Berkomentar pada Foto ini</p>

        <form id="komentarForm" action="{{ route('komentar.store') }}" method="POST"
            class="flex gap-x-3 items-center mb-20">
            @csrf
            <input type="text" name="user_id" placeholder="Username" class="input input-bordered w-full"
                value="{{ auth()->id() }}" hidden />
            <input type="text" name="foto_id" placeholder="Foto" class="input input-bordered w-full"
                value="{{ $foto->id }}" hidden />
            <textarea name="isi_komentar" rows="2"
                class="w-full rounded-xl ring-2 ring-gray-300 focus:ring-green-600 outline-none p-3" required></textarea>
            <button class="btn btn-success text-gray-100 flex"><i class="fa fa-paper-plane"></i></button>
        </form>

        @foreach ($komentar as $k)
            <div id="daftarKomentar" class="mb-5">
                <div class="bg-white w-full p-4 rounded-xl">
                    <h2 class="text-lg text-success font-bold mb-3">{{ $k->user->name }} <span
                            class="text-sm font-normal">{{ $k->created_at->format('d/M/Y') }}</span>
                    </h2>
                    <p class="text-md font-semibold">{{ $k->isi_komentar }}</p>
                </div>
            </div>
        @endforeach
        {{-- Komentar SweetAlert2 --}}
        @if (session('komentar'))
            <script>
                new Noty({
                    text: '<i class="fa-solid fa-message mr-2"></i> Komentar Anda Telah Terkirim!',
                    theme: 'sunset',
                    type: 'alert',
                    layout: 'bottomRight',
                    timeout: 3000,
                    progressBar: true,
                }).show();
            </script>
        @endif
    </div>
    {{-- Edit SweetAlert --}}
    @if (session('edit_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Foto Berhasil di Edit!',
                    showConfirmButton: false,
                    timer: 2000
                });
                // Hapus pesan sesi setelah ditampilkan
                {{ Session::forget('edit_success') }}
            });
        </script>
    @endif
    @if (session('edit_error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                });
                // Hapus pesan sesi setelah ditampilkan
                {{ Session::forget('edit_error') }}
            });
        </script>
    @endif
@endsection
