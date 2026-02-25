<!DOCTYPE html>

<html class="dark" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', config('app.name', 'EasyColoc'))</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#c72929",
                        "gold": "#D4AF37",
                        "background-light": "#f8f6f6",
                        "background-dark": "#201212",
                        "navy": "#0a192f",
                        "sand": "#f4ede4",
                        "crimson": "#C62828",
                        "navy-dark": "#0a111a",
                        "navy-deep": "#0a1128",
                        "accent-gold": "#fbbf24",
                        "neutral-800": "#2d1b14",
                        "neutral-900": "#1a0f0a",
                        "parchment": "#fdf8e1",
                        "nautical-gold": "#b8860b",
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .parchment-texture {
            background-color: #2a1a1a;
            background-image: radial-gradient(#3a2a2a 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .hero-gradient {
            background: linear-gradient(180deg, rgba(32, 18, 18, 0.6) 0%, rgba(32, 18, 18, 1) 100%);
        }
        .nautical-gradient {
            background: linear-gradient(135deg, #121a20 0%, #1c2e3a 100%);
        }
        .modal-overlay {
            background-color: rgba(15, 10, 10, 0.85);
            backdrop-filter: blur(8px);
        }
        .invitation-parchment-texture {
            background-color: #fdf8e1;
            background-image: linear-gradient(135deg, rgba(184, 134, 11, 0.05) 25%, transparent 25%),
                linear-gradient(225deg, rgba(184, 134, 11, 0.05) 25%, transparent 25%),
                linear-gradient(45deg, rgba(184, 134, 11, 0.05) 25%, transparent 25%),
                linear-gradient(315deg, rgba(184, 134, 11, 0.05) 25%, transparent 25%);
            background-position: 10px 0, 10px 0, 0 0, 0 0;
            background-size: 20px 20px;
            background-repeat: repeat;
        }

        .glow-button {
            box-shadow: 0 0 15px rgba(184, 134, 11, 0.4);
            transition: all 0.3s ease;
        }

        .glow-button:hover {
            box-shadow: 0 0 25px rgba(184, 134, 11, 0.6);
            transform: translateY(-2px);
        }
    </style>
</head>

<body
    class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 selection:bg-primary selection:text-white">
    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-50 w-full border-b border-primary/20 bg-background-dark/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <div class="flex items-center gap-3">
                <div
                    class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-white shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-3xl">sailing</span>
                </div>
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-100">Easy<span
                        class="text-primary">Coloc</span></h2>
            </div>
            @php
                function isActive($name) {
                    $activeClass = "text-primary font-semibold";
                    $inactiveClass = "text-slate-300 hover:text-primary transition-colors";
                    return request()->routeIs($name) ? $activeClass : $inactiveClass;
                }
            @endphp
            <nav class="hidden md:flex items-center gap-8">
                <a class="{{ isActive('home') }}"
                    href="{{ route('home') }}">Home</a>
                <a class="{{ isActive('dashboard') }}"
                    href="{{ route('dashboard') }}">Dashboard</a>
                <a class="{{ isActive('colocation.index') }}"
                    href="{{ route('colocation.index') }}">Colocation</a>
                <a class="{{ isActive('/') }}"
                    href="#">Admin</a>
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
    @yield('content')
    <!-- Footer -->
    <footer class="parchment-texture border-t border-slate-800 py-16">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-4">
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-3xl">sailing</span>
                        <h2 class="text-2xl font-extrabold text-white">Easy<span class="text-primary">Coloc</span>
                        </h2>
                    </div>
                    <p class="text-sm text-slate-400">
                        L'outil de gestion préféré des pirates urbains. Simplifiez votre vie en communauté avec style et
                        efficacité.
                    </p>
                    <div class="flex gap-4">
                        <a class="h-10 w-10 flex items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:text-primary"
                            href="#"><span class="material-symbols-outlined">share</span></a>
                        <a class="h-10 w-10 flex items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:text-primary"
                            href="#"><span class="material-symbols-outlined">public</span></a>
                    </div>
                </div>
                <div>
                    <h4 class="mb-6 font-bold text-white uppercase tracking-widest text-sm">Navigation</h4>
                    <ul class="flex flex-col gap-4 text-sm text-slate-400">
                        <li><a class="hover:text-gold transition-colors" href="#">Dépenses</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Calcul des Soldes</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Tableau des Primes</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Blog de l'Équipage</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-6 font-bold text-white uppercase tracking-widest text-sm">Légal</h4>
                    <ul class="flex flex-col gap-4 text-sm text-slate-400">
                        <li><a class="hover:text-gold transition-colors" href="#">Code d'Honneur</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Confidentialité</a></li>
                        <li><a class="hover:text-gold transition-colors" href="#">Conditions Générales</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-6 font-bold text-white uppercase tracking-widest text-sm">Newsletter du Port</h4>
                    <p class="mb-4 text-sm text-slate-400">Recevez les dernières nouvelles de la Grand Line.</p>
                    <div class="flex gap-2">
                        <input
                            class="w-full rounded-lg border border-slate-700 bg-slate-800/50 px-4 py-2 text-sm text-white focus:border-primary focus:ring-0"
                            placeholder="Votre email" type="email" />
                        <button class="rounded-lg bg-primary px-4 py-2 text-white hover:bg-primary/80">
                            <span class="material-symbols-outlined">send</span>
                        </button>
                    </div>
                </div>
            </div>
            <div
                class="mt-16 flex flex-col items-center justify-between gap-6 border-t border-slate-800 pt-8 sm:flex-row">
                <p class="text-xs text-slate-500">© 2024 EasyColoc. Tous droits réservés à l'équipage.</p>
                <div class="flex gap-8 text-xs text-slate-500">
                    <span class="flex items-center gap-1"><span
                            class="material-symbols-outlined text-[14px]">shield</span> Sécurisé par Haki</span>
                    <span class="flex items-center gap-1"><span
                            class="material-symbols-outlined text-[14px]">location_on</span> Grand Line, East
                        Blue</span>
                </div>
            </div>
        </div>
    </footer>
    @yield('modals')
</body>

</html>
