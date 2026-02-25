@extends('layouts.app')

@section('title', 'EasyColoc - Inscription')

@section('content')
    <div class="bg-navy font-display text-slate-100 min-h-screen flex flex-col relative overflow-x-hidden">
        <div class="absolute inset-0 compass-watermark pointer-events-none"></div>
        <div class="layout-container flex h-full grow flex-col items-center justify-center p-4 sm:p-8">
            <div
                class="w-full max-w-[480px] bg-background-dark/80 backdrop-blur-md border border-slate-800 rounded-xl shadow-2xl overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-primary"></div>
                <header class="flex flex-col items-center pt-10 pb-6 px-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="size-12 bg-primary rounded-full flex items-center justify-center text-white shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-3xl">sailing</span>
                        </div>
                        <h2 class="text-3xl font-bold tracking-tight text-slate-100">EasyColoc</h2>
                    </div>
                    @if (session()->has('invitation_token'))
                        <div class="flex items-center gap-3 bg-gold/20 px-4 py-2 rounded-lg">
                            <span class="material-symbols-outlined text-gold text-3xl">groups_3</span>
                            <p class="text-gold text-sm font-bold uppercase tracking-widest">Invitation</p>
                            <p class="text-slate-100 text-sm">Complete the registration process, to accept or refuse the invitation</p>
                        </div>
                    @endif
                    <div class="rope-divider w-24 mb-6"></div>
                    <h1 class="text-2xl font-bold text-center text-white uppercase tracking-wider">Rejoindre l'Aventure</h1>
                    <p class="text-slate-400 text-sm text-center mt-2">Préparez votre boussole et trouvez votre équipage</p>
                </header>
                <form action="{{ route('register') }}" method="POST" class="px-8 pb-10 flex flex-col gap-5">
                    @csrf
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-semibold uppercase tracking-widest text-gold flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">person</span>
                            Nom du Pirate
                        </label>
                        <input name="name" value="{{ old('name') }}"
                            class="w-full bg-slate-900/50 border border-slate-700 rounded-lg h-12 px-4 text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-slate-600"
                            placeholder="Monkey D. Luffy" type="text" />
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-semibold uppercase tracking-widest text-gold flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">mail</span>
                            Escargophone (Email)
                        </label>
                        <input name="email" value="{{ old('email', session()->has('email') ? session()->get('email') : null) }}"
                            class="w-full bg-slate-900/50 border border-slate-700 rounded-lg h-12 px-4 text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-slate-600"
                            placeholder="luffy@grandline.com" type="email" />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label
                                class="text-xs font-semibold uppercase tracking-widest text-gold flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">lock</span>
                                Secret
                            </label>
                            <input name="password"
                                class="w-full bg-slate-900/50 border border-slate-700 rounded-lg h-12 px-4 text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-slate-600"
                                placeholder="••••••••" type="password" />
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label
                                class="text-xs font-semibold uppercase tracking-widest text-gold flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">verified_user</span>
                                Confirmer
                            </label>
                            <input name="password_confirmation"
                                class="w-full bg-slate-900/50 border border-slate-700 rounded-lg h-12 px-4 text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-slate-600"
                                placeholder="••••••••" type="password" />
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button
                        class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-lg shadow-xl shadow-primary/20 flex items-center justify-center gap-3 group mt-4 transition-all transform active:scale-[0.98]">
                        REJOINDRE L'AVENTURE
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">anchor</span>
                    </button>
                    <div class="flex flex-col items-center gap-4 mt-4">
                        <div class="rope-divider w-full opacity-30"></div>
                        <a class="text-slate-400 hover:text-gold text-sm transition-colors flex items-center gap-1"
                            href="{{ route('login.view') }}">
                            Déjà un compte ? <span class="text-primary font-bold">Se connecter</span>
                        </a>
                    </div>
                </form>
                <div class="bg-primary/5 p-4 flex justify-between items-center border-t border-slate-800">
                    <div class="flex items-center gap-2 text-[10px] text-slate-500 uppercase tracking-tighter">
                        <span class="material-symbols-outlined text-xs">explore</span>
                        Grand Line Navigator v1.0
                    </div>
                    <div class="flex gap-2">
                        <div class="size-2 rounded-full bg-gold"></div>
                        <div class="size-2 rounded-full bg-primary"></div>
                        <div class="size-2 rounded-full bg-slate-700"></div>
                    </div>
                </div>
            </div>
            <footer class="mt-8 text-slate-500 text-xs flex gap-6 items-center">
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">shield</span>
                    Protection de la Marine</span>
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">description</span>
                    Code des Pirates</span>
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">help</span>
                    S.O.S</span>
            </footer>
        </div>
    </div>
@endsection
