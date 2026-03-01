<header class="sticky top-0 z-50 w-full border-b border-primary/20 bg-background-dark/80 backdrop-blur-md">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
        <div class="flex items-center gap-3">
            <div
                class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-white shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-3xl">sailing</span>
            </div>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-100">Easy<span class="text-primary">Coloc</span>
            </h2>
        </div>
        @php
            function isActive($name)
            {
                $activeClass = 'text-primary font-semibold';
                $inactiveClass = 'text-slate-300 hover:text-primary transition-colors';
                return request()->routeIs($name) ? $activeClass : $inactiveClass;
            }
        @endphp
        <nav class="hidden md:flex items-center gap-8">
            <a class="{{ isActive('home') }}" href="{{ route('home') }}">Home</a>
            <a class="{{ isActive('dashboard') }}" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="{{ isActive('colocation.index') }}" href="{{ route('colocation.index') }}">Colocation</a>
            @auth
                @if (auth()->user()->role == 'ADMIN')
                    <a class="{{ isActive('admin.index') }}" href="{{ route('admin.index') }}">Admin</a>
                @endif
            @endauth
        </nav>
        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login.view') }}"
                    class="hidden sm:block text-sm font-bold text-slate-100 hover:text-primary transition-colors px-4 py-2">Se
                    connecter</a>
                <a href="{{ route('register.view') }}"
                    class="rounded-lg bg-primary px-5 py-2.5 text-sm font-bold text-white transition-all hover:scale-105 active:scale-95 shadow-lg shadow-primary/30">
                    inscription
                </a>
            @endguest
            @auth
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button href="{{ route('logout') }}"
                        class="rounded-lg bg-primary px-5 py-2.5 text-sm font-bold text-white transition-all hover:scale-105 active:scale-95 shadow-lg shadow-primary/30">Se
                        Deconnecter</button>
                </form>
            @endauth
        </div>
    </div>
</header>
