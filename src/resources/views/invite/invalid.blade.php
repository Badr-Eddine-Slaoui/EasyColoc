@extends('layouts.app')

@section('title', 'EasyColoc - Invalid Invite')

@section('content')
    <main class="flex flex-1 justify-center py-12 px-6">
        <div class="layout-content-container flex flex-col max-w-[640px] flex-1 items-center text-center">
            <div class="relative w-full aspect-square max-w-[320px] mb-8">
                <div class="absolute inset-0 bg-primary/20 blur-[80px] rounded-full"></div>
                <div
                    class="relative z-10 w-full h-full bg-neutral-800 rounded-2xl border-2 border-primary/30 flex items-center justify-center overflow-hidden shadow-2xl shadow-primary/20">
                    <div class="absolute inset-0 opacity-20 pointer-events-none"
                        data-alt="Vintage nautical map texture overlay"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAKve9g7kmmBR6-s97Z8vzMa0o2Jq1S-DHsnvU1RTr3G3Rg-0TFLX_O6lnkYiKkZphYD8SJZPRGYHGMyQq8HYxLIrp_vLHsVwHJVN0Pw6EPsJjNEacoQaJB2CpWDlgyiV9aNedHO7ZXytOqiBvj_LMv0twqtS838lufldLr2hPs_PNL0tXxIv6qcXSOK4kDP7AC7EDazyl5m6_64GgWy0tzK2uGm6loywp496Ti5b8cWSfJW1nYkmv7WLehU4g6wYG8kbzWAPl2F0E');">
                    </div>
                    <span class="material-symbols-outlined text-[120px] text-primary/60">location_off</span>
                    <div
                        class="absolute bottom-4 right-4 bg-primary text-white p-2 rounded-full rotate-12 shadow-lg">
                        <span class="material-symbols-outlined">close</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4 mb-10">
                <h1
                    class="text-slate-900 dark:text-slate-100 text-3xl md:text-4xl font-extrabold leading-tight tracking-tight">
                    Lien de Recrutement Invalide
                </h1>
                <p
                    class="text-slate-600 dark:text-slate-400 text-lg font-normal leading-relaxed max-w-[520px] mx-auto">
                    Mille sabords ! Ce lien semble avoir sombré dans les profondeurs de l'océan ou a expiré.
                </p>
            </div>
            <div class="bg-primary/5 border border-primary/20 rounded-2xl p-6 mb-10 max-w-[480px] w-full">
                <div class="flex items-start gap-4 text-left">
                    <div class="bg-primary/20 p-2 rounded-lg mt-1">
                        <span class="material-symbols-outlined text-primary text-xl">anchor</span>
                    </div>
                    <div>
                        <h3 class="text-primary font-bold mb-1 uppercase tracking-wider text-sm">Instructions de
                            l'Équipage</h3>
                        <p class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed">
                            Veuillez demander au <span class="text-primary font-semibold">Capitaine</span> de
                            vous envoyer une nouvelle invitation pour rejoindre l'aventure. Le lien que vous
                            avez utilisé n'est plus en état de naviguer.
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full justify-center">
                <a href="{{ route('home') }}"
                    class="flex min-w-[200px] cursor-pointer items-center justify-center rounded-xl h-12 px-6 bg-primary text-white text-base font-bold transition-transform active:scale-95 hover:bg-primary/90 shadow-lg shadow-primary/20">
                    <span class="truncate">Retour à l'accueil</span>
                </a>
            </div>
            <div class="mt-16 flex flex-col items-center gap-2">
                <p class="text-slate-500 dark:text-slate-500 text-xs font-medium uppercase tracking-[0.2em]">
                    Code d'erreur</p>
                <span
                    class="px-3 py-1 bg-neutral-800 rounded-full border border-primary/30 text-primary font-mono text-sm">
                    INV-EXP-404-GRANDLINE
                </span>
            </div>
        </div>
    </main>
@endsection
