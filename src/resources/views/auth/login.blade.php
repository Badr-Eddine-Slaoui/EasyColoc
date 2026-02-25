@extends('layouts.app')

@section('title', 'EasyColoc - Connexion')

@section('content')
    <div
        class="font-display bg-navy min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="grain-overlay absolute inset-0 pointer-events-none"></div>
        <div class="relative z-10 w-full max-w-[440px] px-6">
            <div
                class="bg-white dark:bg-slate-900/80 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-xl shadow-2xl overflow-hidden">
                <div class="bg-primary p-8 text-center relative">
                    <div class="absolute top-4 right-4 text-gold/40">
                        <span class="material-symbols-outlined text-4xl">sailing</span>
                    </div>
                    <div class="flex justify-center mb-4">
                        <div class="bg-gold p-3 rounded-full shadow-lg border-2 border-white/20">
                            <span class="material-symbols-outlined text-background-dark text-3xl font-bold">sailing</span>
                        </div>
                    </div>
                    @if (session()->has('invitation_token'))
                        <div class="flex items-center gap-3 bg-gold/20 px-4 py-2 rounded-lg">
                            <span class="material-symbols-outlined text-gold text-3xl">groups_3</span>
                            <p class="text-gold text-sm font-bold uppercase tracking-widest">Invitation</p>
                            <p class="text-slate-100 text-sm">Complete the login process, to accept or refuse the invitation</p>
                        </div>
                    @endif
                    <h1 class="text-white text-3xl font-black tracking-tight uppercase">EasyColoc</h1>
                    <p class="text-white/80 text-sm mt-1 font-medium">Rejoignez l'équipage des colocataires</p>
                </div>
                <div class="p-8">
                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-2"
                                for="email">
                                <span class="material-symbols-outlined text-primary text-sm">alternate_email</span>
                                Email du pirate
                            </label>
                            <input name="email" value="{{ old('email', session()->has('email') ? session()->get('email') : null) }}"
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-slate-400"
                                id="email" placeholder="luffy@grandline.com" type="email" />
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 flex items-center gap-2"
                                    for="password">
                                    <span class="material-symbols-outlined text-primary text-sm">lock</span>
                                    Mot de passe
                                </label>
                            </div>
                            <div class="relative">
                                <input name="password"
                                    class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-slate-400"
                                    id="password" placeholder="••••••••" type="password" />
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center">
                            <input
                                class="h-4 w-4 text-primary focus:ring-primary border-slate-300 dark:border-slate-700 rounded bg-slate-50 dark:bg-slate-800"
                                id="remember" name="remember" type="checkbox" />
                            <label class="ml-2 block text-sm text-slate-600 dark:text-slate-400" for="remember">
                                Rester à bord du navire
                            </label>
                        </div>
                        @if (session()->has('error'))
                            <p class="text-red-500 text-xs mt-1">{{ session()->get('error') }}</p>
                        @endif
                        <button
                            class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-lg shadow-lg shadow-primary/20 flex items-center justify-center gap-3 group transition-all transform active:scale-[0.98]"
                            type="submit">
                            <span class="uppercase tracking-widest">Se Connecter</span>
                            <span
                                class="material-symbols-outlined group-hover:translate-x-1 transition-transform">anchor</span>
                        </button>
                    </form>
                    <div class="mt-10 pt-6 border-t border-slate-100 dark:border-slate-800 text-center">
                        <p class="text-sm text-slate-600 dark:text-slate-400">
                            Nouveau sur Grand Line ?
                            <a class="text-primary font-bold ml-1 hover:underline decoration-2 underline-offset-4"
                                href="{{ route('register.view') }}">
                                Créer un compte
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
