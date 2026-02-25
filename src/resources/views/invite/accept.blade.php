@extends('layouts.app')

@section('title', 'EasyColoc - Accept Invitation')

@section('content')
    <main class="flex-grow flex items-center justify-center p-6 lg:py-12">
        <div class="max-w-4xl w-full">
            <!-- Invitation Decree Card -->
            <div
                class="invitation-parchment-texture rounded-xl shadow-2xl overflow-hidden relative border-[12px] border-slate-900 dark:border-slate-950/50">
                <!-- Decorative Corners -->
                <div class="absolute top-0 left-0 w-16 h-16 border-t-4 border-l-4 border-nautical-gold m-2"></div>
                <div class="absolute top-0 right-0 w-16 h-16 border-t-4 border-r-4 border-nautical-gold m-2"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 border-b-4 border-l-4 border-nautical-gold m-2">
                </div>
                <div class="absolute bottom-0 right-0 w-16 h-16 border-b-4 border-r-4 border-nautical-gold m-2">
                </div>
                <div class="px-8 py-12 lg:px-16 lg:py-16 text-center text-slate-900">
                    <!-- Decree Header -->
                    <div class="mb-10">
                        <span class="block text-primary font-black tracking-[0.2em] text-xs uppercase mb-2">Décret
                            Officiel</span>
                        <h2 class="text-3xl md:text-5xl font-black tracking-tight uppercase leading-none">Ordre de
                            Recrutement Officiel</h2>
                        <div class="h-1 w-32 bg-nautical-gold mx-auto mt-6 rounded-full opacity-50"></div>
                    </div>
                    <!-- Captain Info -->
                    <div class="flex flex-col items-center mb-10">
                        <div class="relative mb-6">
                            <div
                                class="w-28 h-28 rounded-full border-4 border-nautical-gold p-1 shadow-lg bg-white overflow-hidden">
                                <img alt="Capitaine" class="w-full h-full object-cover rounded-full"
                                    data-alt="A portrait of a charismatic ship captain with a friendly smile"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSrqL3B0TXxvtm1-JHODwxHFeCyLfRDHa3VzOeF9VYiL5oDi9NGUIBkRplW11fo0PQh4hNrakAeMDc-l_7ntezzF3RPoIMpGgBJWOywrFsEzy43NlIovCuUhTEKB4oIPEB55g5iyPxoVg62AKVzcRekvqLmCLxpMYz1v_6lZLMZ5vWSji2x6i_M6slVEIqZdxmYetO9YD3XWf1vuwR47WXbshVsVgZAkb6sLfa8fvfMSbFc31npnBL0qMlSzgfUOAKU2FeSCj4hNk" />
                            </div>
                            <div
                                class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-slate-900 text-white text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-wider">
                                Le Capitaine
                            </div>
                        </div>
                        <div class="max-w-xl mx-auto italic text-lg text-slate-700 leading-relaxed font-medium">
                            "Vous avez été convoqué pour rejoindre la colocation la plus redoutée de l'Atlantique.
                            Nous ne cherchons pas seulement des colocataires, mais des membres de notre propre
                            équipage."
                        </div>
                    </div>
                    <!-- Fleet Branding -->
                    <div class="mb-10 p-6 rounded-lg border-2 border-dashed border-primary/30 bg-primary/5">
                        <p class="text-sm font-bold uppercase tracking-widest text-slate-500 mb-2">Votre future
                            destination :</p>
                        <h3 class="text-3xl md:text-5xl font-black text-primary italic uppercase tracking-tight">
                            L'ÉQUIPAGE DE L'ATLANTIQUE
                        </h3>
                    </div>
                    <!-- Metadata -->
                    <div class="flex flex-col md:flex-row items-center justify-center gap-4 md:gap-12 mb-10">
                        <div class="flex items-center gap-2 text-slate-600">
                            <span class="material-symbols-outlined text-nautical-gold">calendar_today</span>
                            <span class="text-sm font-semibold uppercase">Expire le : 24/05/2024</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600">
                            <span class="material-symbols-outlined text-nautical-gold">location_on</span>
                            <span class="text-sm font-semibold uppercase">Port d'attache : La Rochelle</span>
                        </div>
                    </div>
                    <!-- Warning Box -->
                    <div
                        class="max-w-2xl mx-auto mb-12 p-5 bg-background-dark/5 border-l-4 border-primary rounded-r-lg text-left flex items-start gap-4">
                        <div class="bg-primary/10 p-2 rounded-lg">
                            <span class="material-symbols-outlined text-primary">warning</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 uppercase text-sm mb-1">Attention, Matelot !</h4>
                            <p class="text-sm text-slate-600 leading-snug">
                                En acceptant cet ordre, vous quitterez officiellement votre équipage actuel. Cette
                                action est irréversible et marquera le début d'une nouvelle ère.
                            </p>
                        </div>
                    </div>
                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 px-4">
                        <form action="{{ route('invite.confirm', $colocationId) }}" method="post">
                            @csrf
                            <button
                                type="submit"
                                class="w-full sm:w-auto glow-button bg-slate-900 hover:bg-black text-white px-10 py-4 rounded-lg font-black uppercase tracking-widest flex items-center justify-center gap-3 group">
                                <span>Accepter l'Ordre</span>
                                <span
                                    class="material-symbols-outlined text-nautical-gold group-hover:translate-x-1 transition-transform">auto_awesome</span>
                            </button>
                        </form>
                        <form action="{{ route('invite.refuse') }}" method="post">
                            @csrf
                            <button
                                class="w-full sm:w-auto border-2 border-primary/30 text-primary hover:bg-primary hover:text-white px-10 py-4 rounded-lg font-bold uppercase tracking-widest transition-all">
                                Décliner
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Seal Decor -->
                <div class="absolute bottom-6 left-6 opacity-30 pointer-events-none hidden md:block">
                    <span class="material-symbols-outlined text-6xl text-primary">verified</span>
                </div>
            </div>
            <!-- Footer Link -->
            <div class="mt-8 text-center">
                <a class="text-slate-500 dark:text-slate-400 text-sm font-medium flex items-center justify-center gap-2 hover:text-primary transition-colors"
                    href="#">
                    Consulter les conditions générales de l'équipage
                    <span class="material-symbols-outlined text-base">arrow_right_alt</span>
                </a>
            </div>
        </div>
    </main>
@endsection
