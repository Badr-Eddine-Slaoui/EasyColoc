@extends('layouts.app')

@section('title', 'EasyColoc - Reject Invitation')

@section('content')
    <main class="flex-grow flex items-center justify-center p-4 @container">
        <div class="max-w-[560px] w-full">
            <!-- Main Content Card -->
            <div class="invitation-parchment-texture dark:bg-navy-muted rounded-xl shadow-2xl overflow-hidden border border-muted">
                <!-- Illustration Section -->
                <div
                    class="relative h-64 w-full bg-slate-200 dark:bg-[#150e0e] flex items-center justify-center overflow-hidden">
                    <div class="absolute inset-0 opacity-40 bg-gradient-to-t from-background-dark to-transparent"></div>
                    <!-- Thematic Illustration (Sunset ship/Closed logbook concept) -->
                    <img alt="A lonely ship sailing towards a dark red sunset" class="w-full h-full object-cover"
                        data-alt="A lonely ship sailing towards a dark red sunset"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCr0XQBzPHwh3FTHFTUcU5lPulN_NYmwzS6H-YVWH3OuegO4Ov7aiHtQNRYaxGi9ocyok0wtEWcCI-g3r5bPgk5aWr6QsFeijs051VOPQ2f-sRKvZfYuA8UU15gULE6jMvykC9jdLA5iu6Tj6x9ygzcipK9bh9vdrlGnfA7fpHBEwWrGHsvxbCNxeKVMGNTNrKcVX0QDxh1IzuMFvSA_EJXua6j7k6fNy0UYAu-GSao3RQ12Dm2TRIKUr-yqLiXVaobJ0yT5Xtkcjs" />
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-background-dark/60 backdrop-blur-sm p-4 rounded-full border border-primary/30">
                            <span class="material-symbols-outlined text-primary text-6xl">close</span>
                        </div>
                    </div>
                </div>
                <!-- Text Content -->
                <div class="p-8 text-center">
                    <h1 class="text-3xl font-bold mb-2 text-slate-900">Fair Winds, Traveler</h1>
                    <p class="text-primary font-medium tracking-wide uppercase text-sm mb-6">Order Declined</p>
                    <div class="space-y-4 mb-8">
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                            You have chosen not to join the crew. Your decision has been logged, and the recruitment
                            order is now closed.
                        </p>
                        <p class="text-slate-500 dark:text-slate-500 italic">
                            "The sea is vast, and every sailor must choose their own course. May your own journey be
                            prosperous."
                        </p>
                    </div>
                    <!-- Action Button -->
                    <div class="flex flex-col gap-3">
                        <a class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white font-bold py-4 px-8 rounded-lg transition-all shadow-lg shadow-primary/20"
                            href="{{ route('dashboard') }}">
                            <span class="material-symbols-outlined text-xl">home</span>
                            Retourner à l'accueil
                        </a>
                        <button
                            class="text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors text-sm py-2">
                            Besoin d'aide ? Contacter le support
                        </button>
                    </div>
                </div>
            </div>
            <!-- Footer Note -->
            <footer class="mt-8 text-center text-slate-500 dark:text-slate-600 text-xs">
                <p>© 1522 EasyColoc - Logbook Entry #88219</p>
                <div class="flex justify-center gap-4 mt-2">
                    <a class="hover:underline" href="#">Mentions légales</a>
                    <span>•</span>
                    <a class="hover:underline" href="#">Code du pirate</a>
                </div>
            </footer>
        </div>
    </main>
@endsection
