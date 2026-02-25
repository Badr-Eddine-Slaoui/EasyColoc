@extends('layouts.app')

@section('title', 'EasyColoc - Invitation Conflict')

@section('content')
    <main class="flex-1 flex items-center justify-center p-6 sm:p-12 relative">
        <div class="absolute inset-0 ship-clash-gradient pointer-events-none"></div>
        <div class="max-w-[640px] w-full flex flex-col items-center text-center space-y-8 z-10">
            <div class="relative">
                <div
                    class="flex items-center justify-center size-32 sm:size-48 rounded-full bg-primary/10 border-4 border-dashed border-primary/30 relative overflow-visible">
                    <span
                        class="material-symbols-outlined text-7xl sm:text-9xl text-primary animate-pulse">anchor</span>
                    <div
                        class="absolute -top-2 -right-2 bg-primary text-white p-2 rounded-full shadow-lg border-4 border-background-dark">
                        <span class="material-symbols-outlined text-2xl font-bold">close</span>
                    </div>
                    <div class="absolute -bottom-4 -left-4 flex space-x-[-15px]">
                        <span
                            class="material-symbols-outlined text-5xl text-gold-accent opacity-50">directions_boat</span>
                        <span
                            class="material-symbols-outlined text-5xl text-primary transform scale-x-[-1]">directions_boat</span>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <div
                    class="inline-flex items-center px-3 py-1 rounded-full bg-primary/20 text-primary text-xs font-bold tracking-widest uppercase">
                    Erreur de Navigation
                </div>
                <h1
                    class="text-slate-900 dark:text-white text-4xl sm:text-5xl font-black leading-tight tracking-tight uppercase">
                    Conflit d'Équipage !
                </h1>
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed max-w-md mx-auto italic">
                    "Mille sabords ! Un pirate ne peut naviguer sur deux navires à la fois."
                </p>
            </div>
            <div
                class="bg-white/5 dark:bg-white/5 backdrop-blur-sm border border-slate-200 dark:border-white/10 rounded-xl p-8 shadow-xl w-full">
                <div class="flex items-start gap-4 text-left">
                    <span class="material-symbols-outlined text-primary mt-1">warning</span>
                    <div class="space-y-3">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white uppercase tracking-wide">
                            Déjà en mer</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                            Votre loyauté est actuellement réservée à un autre navire. Dans le code des pirates
                            d'EasyColoc, chaque marin doit quitter son bord actuel avant de pouvoir signer un
                            nouveau contrat d'engagement.
                        </p>
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                            Voulez-vous retourner sur votre navire actuel ou rentrer au port ?
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full pt-4">
                <a href="{{ route('colocation.index') }}"
                    class="flex-1 flex items-center justify-center gap-2 rounded-lg py-4 bg-primary text-white text-base font-bold uppercase tracking-widest hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined">group</span>
                    Voir mon équipage
                </a>
                <a href="{{ route('dashboard') }}"
                    class="flex-1 flex items-center justify-center gap-2 rounded-lg py-4 bg-transparent border-2 border-slate-300 dark:border-white/20 text-slate-700 dark:text-white text-base font-bold uppercase tracking-widest hover:bg-slate-100 dark:hover:bg-white/5 transition-all">
                    <span class="material-symbols-outlined">home</span>
                    Retour à l'accueil
                </a>
            </div>
            <div class="pt-8 opacity-40">
                <div class="flex justify-center gap-6">
                    <span class="material-symbols-outlined text-3xl">map</span>
                    <span class="material-symbols-outlined text-3xl">explore</span>
                    <span class="material-symbols-outlined text-3xl">set_meal</span>
                </div>
            </div>
        </div>
    </main>
@endsection
