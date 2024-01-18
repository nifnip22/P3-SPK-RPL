<nav class="fixed top-0 left-0 right-0 z-50">
    <div class="navbar bg-base-100">
        <div class="flex-1">
            <a href="{{ route('homepage') }}" class="btn btn-ghost text-xl">Galleria</a>
        </div>
        <div class="flex-none items-center gap-2">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component"
                            src="{{ asset('assets/png/menu (1).png') }}" />
                    </div>
                </div>
                <ul tabindex="0"
                    class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                    <li><a href="{{ Route('foto.index') }}">Foto</a></li>
                    <li><a href="{{ Route('album.index') }}">Album</a></li>
                    <li><a href="{{ Route('like.index') }}">Disukai</a></li>
                    <hr class="mt-2 mb-2 h-1">
                    <li>
                        <a class="justify-between" href="{{ Route('profile.edit') }}">
                            Profile
                        </a>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-error">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
