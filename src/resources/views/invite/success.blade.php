@extends('layouts.app')

@section('title', 'EasyColoc - Success Invitation')

@section('content')
    <main class="flex-1 flex items-center justify-center p-6 @container">
        <div class="max-w-4xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Left Side: Celebration Visual -->
            <div class="hidden lg:flex flex-col items-center justify-center relative">
                <div class="absolute inset-0 bg-primary/5 rounded-full blur-3xl scale-75"></div>
                <div class="relative z-10 w-full aspect-square flex items-center justify-center">
                    <!-- Central Thematic Illustration -->
                    <div
                        class="relative w-80 h-80 bg-background-dark/40 rounded-full border-4 border-accent-gold/20 flex items-center justify-center card-border shadow-2xl">
                        <span class="material-symbols-outlined text-[160px] text-accent-gold gold-glow">
                            settings_backup_restore
                        </span>
                        <!-- Floating Icons / Nautical Elements -->
                        <div class="absolute top-8 right-8 animate-bounce">
                            <span class="material-symbols-outlined text-primary text-4xl">anchor</span>
                        </div>
                        <div class="absolute bottom-12 left-6">
                            <span class="material-symbols-outlined text-accent-gold text-3xl">currency_exchange</span>
                        </div>
                        <div class="absolute top-1/2 -right-4">
                            <span class="material-symbols-outlined text-slate-400 text-2xl">grade</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Side: Success Content Card -->
            <div
                class="bg-white dark:bg-[#251616] rounded-2xl p-8 lg:p-10 shadow-2xl card-border relative overflow-hidden">
                <!-- Decorative corner -->
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-primary/10 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-6">
                        <span
                            class="px-3 py-1 bg-primary/20 text-primary text-xs font-bold rounded-full uppercase tracking-widest">Nouvel
                            Équipage</span>
                        <div class="h-px flex-1 bg-primary/20"></div>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-bold text-slate-900 dark:text-slate-100 mb-4 leading-tight">
                        Bienvenue à Bord, <span class="text-primary italic">Matelot !</span>
                    </h1>
                    <p class="text-slate-600 dark:text-slate-400 text-lg mb-8 leading-relaxed">
                        Félicitations ! Tu viens de lever l'ancre. Tu fais désormais partie de l'aventure EasyColoc avec
                        ton nouvel équipage.
                    </p>
                    <!-- Crew Info Section -->
                    <div
                        class="bg-background-light dark:bg-background-dark/60 rounded-xl p-6 mb-8 border border-primary/10 flex items-center gap-5">
                        <div
                            class="w-16 h-16 rounded-lg bg-primary flex items-center justify-center shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-white text-3xl">groups</span>
                        </div>
                        <div>
                            <p class="text-xs text-primary font-bold uppercase tracking-wider mb-1">Équipage rejoint</p>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100">L'Équipage de l'Atlantique
                            </h3>
                            <p class="text-sm text-slate-500 dark:text-slate-500">4 membres actifs • Quartier Général
                                prêt</p>
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <a href="{{ route('colocation.index') }}"
                            class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 px-6 rounded-xl flex items-center justify-center gap-3 transition-all transform hover:scale-[1.02] active:scale-95 shadow-lg shadow-primary/30">
                            <span class="material-symbols-outlined">dashboard</span>
                            Accéder au Tableau de Bord
                        </a>
                        <a href="{{ route('colocation.members', $colocationId) }}"
                            class="w-full bg-transparent hover:bg-primary/5 text-slate-600 dark:text-slate-400 font-medium py-3 px-6 rounded-xl border border-slate-200 dark:border-primary/20 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">group</span>
                            Voir mes coéquipiers
                        </a>
                    </div>
                    <!-- Small Pirate Sign-off -->
                    <div
                        class="mt-10 flex items-center justify-center gap-2 opacity-40 hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-sm">explore</span>
                        <p class="text-xs uppercase tracking-[0.2em] font-medium italic">Bon vent et mer calme</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
