@extends('layouts.app')

@section('title', 'EasyColoc - Accueil')

@section('content')
    <main>
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-20 lg:py-32">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 -z-10 h-full w-full">
                <div class="absolute inset-0 hero-gradient"></div>
                <img alt="Dark sea background" class="h-full w-full object-cover opacity-30"
                    data-alt="Abstract dark sea with waves at night"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCEZhtDsAJMd4yrOhYVlVakuFMp1DRx06ubdp8ZejCgKahaT4MvDpzloxO06FWYq0FAtGDF4m_vcNWW7vSRVdVaeE54M_yC3Synaq6cYIyB4fFveWNjIc2Muji2NpnONObZJ--iQotoe6u_560dbzXkEyhVIP0BXNd5alawEkSIbJ95wuP7rwj4Stq-s4_DshF6j6HMLlmd-J0gYePIHbAkuRkb_rvHbJEhywFZotiJn-FB8WA-h3Es6JGdkXM3DRIoUxPvvprFtso" />
            </div>
            <div class="mx-auto max-w-7xl px-6">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div class="flex flex-col gap-8 text-left">
                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-gold/30 bg-gold/10 px-4 py-1.5 text-gold">
                            <span class="material-symbols-outlined text-sm">stars</span>
                            <span class="text-xs font-bold uppercase tracking-widest">Le Trésor de la Coloc</span>
                        </div>
                        <h1 class="text-5xl font-black leading-tight tracking-tight text-white sm:text-7xl">
                            Gérez votre colocation comme un <span
                                class="text-primary underline decoration-gold/40 underline-offset-8">équipage</span>
                        </h1>
                        <p class="max-w-xl text-lg leading-relaxed text-slate-300">
                            Le livre de bord ultime pour suivre vos dépenses, équilibrer les trésors et bâtir votre
                            réputation de colocataire exemplaire sur la Grand Line du quotidien.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <button
                                class="flex h-14 items-center justify-center rounded-xl bg-primary px-8 text-lg font-bold text-white transition-all hover:bg-primary/90 hover:shadow-2xl hover:shadow-primary/40">
                                Embarquez maintenant
                            </button>
                            <button
                                class="flex h-14 items-center justify-center rounded-xl border-2 border-slate-700 bg-transparent px-8 text-lg font-bold text-white transition-all hover:border-gold hover:text-gold">
                                <span class="material-symbols-outlined mr-2">play_circle</span>
                                Voir la démo
                            </button>
                        </div>
                    </div>
                    <!-- Nautical Illustration Motif -->
                    <div class="relative flex justify-center lg:justify-end">
                        <div class="relative h-80 w-80 sm:h-[450px] sm:w-[450px]">
                            <!-- Rotating Compass Background -->
                            <div
                                class="absolute inset-0 animate-[spin_60s_linear_infinite] rounded-full border-[1px] border-dashed border-gold/20">
                            </div>
                            <div class="absolute inset-4 rounded-full border-[1px] border-gold/30"></div>
                            <!-- Central Ship Image -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="h-64 w-64 rounded-full bg-primary/10 p-4 backdrop-blur-sm sm:h-96 sm:w-96">
                                    <div
                                        class="flex h-full w-full items-center justify-center rounded-full border-4 border-gold shadow-2xl shadow-gold/20">
                                        <span
                                            class="material-symbols-outlined text-[120px] text-gold sm:text-[180px]">explore</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Stats Section -->
        <section class="py-12 bg-background-dark">
            <div class="mx-auto max-w-7xl px-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div
                        class="group flex flex-col gap-2 rounded-xl border border-primary/20 bg-primary/5 p-8 transition-all hover:bg-primary/10">
                        <p class="text-sm font-bold uppercase tracking-wider text-primary">Navires Actifs</p>
                        <p class="text-4xl font-black text-white">1,200+</p>
                        <p class="text-sm text-green-500 font-medium">+12% cette semaine</p>
                    </div>
                    <div
                        class="group flex flex-col gap-2 rounded-xl border border-gold/20 bg-gold/5 p-8 transition-all hover:bg-gold/10">
                        <p class="text-sm font-bold uppercase tracking-wider text-gold">Berries Partagés</p>
                        <p class="text-4xl font-black text-white">€450k+</p>
                        <p class="text-sm text-green-500 font-medium">+25% d'épargne</p>
                    </div>
                    <div
                        class="group flex flex-col gap-2 rounded-xl border border-slate-700 bg-slate-800/20 p-8 transition-all hover:bg-slate-800/40">
                        <p class="text-sm font-bold uppercase tracking-wider text-slate-400">Moral de l'équipage</p>
                        <p class="text-4xl font-black text-white">98%</p>
                        <p class="text-sm text-green-500 font-medium">Satisfaction totale</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Features Section -->
        <section class="py-24 bg-background-dark/50">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-4xl font-black text-white sm:text-5xl">Arsenal de navigation</h2>
                    <p class="mx-auto max-w-2xl text-lg text-slate-400">
                        Tout ce dont votre équipage a besoin pour naviguer sereinement sans jamais finir en mutinerie.
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Feature 1 -->
                    <div
                        class="group relative flex flex-col gap-4 rounded-xl border border-slate-800 bg-slate-900/40 p-8 transition-all hover:-translate-y-2 hover:border-primary/50 hover:shadow-xl hover:shadow-primary/10">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-lg bg-primary/20 text-primary group-hover:bg-primary group-hover:text-white transition-all">
                            <span class="material-symbols-outlined text-3xl">menu_book</span>
                        </div>
                        <h3 class="text-xl font-bold text-white">Dépenses</h3>
                        <p class="text-sm leading-relaxed text-slate-400">
                            Enregistrez chaque frais comme dans un livre de bord de pirate. Plus aucune pièce d'or ne
                            sera oubliée.
                        </p>
                        <div
                            class="mt-auto pt-4 text-xs font-bold text-primary opacity-0 group-hover:opacity-100 transition-opacity">
                            VOIR LE REGISTRE →
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div
                        class="group relative flex flex-col gap-4 rounded-xl border border-slate-800 bg-slate-900/40 p-8 transition-all hover:-translate-y-2 hover:border-gold/50 hover:shadow-xl hover:shadow-gold/10">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-lg bg-gold/20 text-gold group-hover:bg-gold group-hover:text-black transition-all">
                            <span class="material-symbols-outlined text-3xl">payments</span>
                        </div>
                        <h3 class="text-xl font-bold text-white">Soldes</h3>
                        <p class="text-sm leading-relaxed text-slate-400">
                            Équilibrez le trésor commun et réglez vos dettes facilement. La justice du capitaine est
                            impartiale.
                        </p>
                        <div
                            class="mt-auto pt-4 text-xs font-bold text-gold opacity-0 group-hover:opacity-100 transition-opacity">
                            PARTAGER LE BUTIN →
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div
                        class="group relative flex flex-col gap-4 rounded-xl border border-slate-800 bg-slate-900/40 p-8 transition-all hover:-translate-y-2 hover:border-red-500/50 hover:shadow-xl hover:shadow-red-500/10">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-lg bg-red-500/20 text-red-500 group-hover:bg-red-500 group-hover:text-white transition-all">
                            <span class="material-symbols-outlined text-3xl">workspace_premium</span>
                        </div>
                        <h3 class="text-xl font-bold text-white">Réputation</h3>
                        <p class="text-sm leading-relaxed text-slate-400">
                            Gagnez des points de 'Bounty' en étant exemplaire. Votre prime augmente avec votre
                            fiabilité.
                        </p>
                        <div
                            class="mt-auto pt-4 text-xs font-bold text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                            MA PRIME ACTUELLE →
                        </div>
                    </div>
                    <!-- Feature 4 -->
                    <div
                        class="group relative flex flex-col gap-4 rounded-xl border border-slate-800 bg-slate-900/40 p-8 transition-all hover:-translate-y-2 hover:border-blue-500/50 hover:shadow-xl hover:shadow-blue-500/10">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-lg bg-blue-500/20 text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-all">
                            <span class="material-symbols-outlined text-3xl">anchor</span>
                        </div>
                        <h3 class="text-xl font-bold text-white">Admin</h3>
                        <p class="text-sm leading-relaxed text-slate-400">
                            Gérez les règles du navire et les membres de votre équipage. Le code d'honneur est la loi.
                        </p>
                        <div
                            class="mt-auto pt-4 text-xs font-bold text-blue-500 opacity-0 group-hover:opacity-100 transition-opacity">
                            PANNEAU DE CONTRÔLE →
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA Section -->
        <section class="py-20">
            <div class="mx-auto max-w-5xl px-6">
                <div class="relative overflow-hidden rounded-3xl bg-primary px-8 py-16 text-center shadow-2xl">
                    <div
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/leather.png')] opacity-20">
                    </div>
                    <div class="relative z-10">
                        <h2 class="mb-6 text-4xl font-black text-white sm:text-5xl">Prêt à rejoindre l'équipage ?</h2>
                        <p class="mx-auto mb-10 max-w-xl text-lg text-white/80">
                            Ne laissez plus les comptes de la colocation devenir une bataille navale. Rejoignez des
                            milliers de colocataires sereins.
                        </p>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            <button
                                class="w-full sm:w-auto rounded-xl bg-white px-10 py-4 text-lg font-bold text-primary transition-all hover:scale-105">
                                Créer ma colocation gratuitement
                            </button>
                            <button
                                class="w-full sm:w-auto rounded-xl border-2 border-white/30 bg-white/10 px-10 py-4 text-lg font-bold text-white transition-all hover:bg-white/20">
                                En savoir plus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
