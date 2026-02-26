@extends('layouts.app')

@section('title', 'EasyColoc - Mes Colocations')

@section('content')
    <main class="flex flex-1 justify-center py-10 px-6">
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1 gap-8">
            <!-- Header Section -->
            @if (session()->has('addColocationError'))
                <div class="flex flex-col gap-4 bg-white dark:bg-slate-900/50 p-4 rounded-xl">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-crimson text-3xl">error</span>
                        <h2 class="text-2xl font-bold text-crimson">Une erreur est survenue</h2>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-base leading-relaxed">
                        {{ session()->get('addColocationError') }}
                    </p>
                </div>
            @endif
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-slate-900 dark:text-white text-4xl font-black tracking-tight">Mes
                        Colocations</h1>
                    <div class="flex items-center gap-2">
                        <span class="size-2 rounded-full bg-gold animate-pulse"></span>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-widest">
                            Total de Colocations: {{ $count }}</p>
                    </div>
                </div>
                @if ($count > 0)
                    <div>
                        <button onclick="showCreateModal()"
                            class="hidden md:flex min-w-[120px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-5 bg-crimson hover:bg-crimson/90 text-white text-sm font-bold transition-all shadow-lg shadow-crimson/20">
                            <span class="truncate">Créer une colocation</span>
                        </button>
                        <button onclick="showCreateModal()"
                            class="md:hidden flex size-10 items-center justify-center rounded-xl bg-crimson text-white">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                    </div>
                @endif
            </div>
            @if ($count > 0)
                <!-- Main Content: Active Colocation -->
                <section class="flex flex-col gap-4">
                    <h3
                        class="text-slate-900 dark:text-white text-lg font-bold flex items-center gap-2 uppercase tracking-tighter">
                        <span class="material-symbols-outlined text-gold">anchor</span>
                        En cours
                    </h3>
                    <!-- Active Card -->
                    @if ($active)
                        <div
                            class="group relative flex flex-col items-stretch justify-start rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 shadow-sm overflow-hidden hover:border-gold/30 transition-all">
                            <div class="flex flex-col @container md:flex-row">
                                <div class="relative flex flex-1 flex-col justify-between p-6 pt-12 gap-4">
                                    @if ($active->owner->user_id === auth()->user()->id)
                                        <div class="absolute top-3 left-3 flex gap-2">
                                            <span
                                                class="bg-gold text-black text-[10px] font-black px-2 py-1 rounded-md tracking-tighter flex items-center gap-1 shadow-lg">
                                                <span class="material-symbols-outlined text-[12px]">crown</span>
                                                PROPRIÉTAIRE
                                            </span>
                                        </div>
                                    @else
                                        <div class="absolute top-3 left-3 flex gap-2">
                                            <span
                                                class="bg-slate-500 text-white text-[10px] font-black px-2 py-1 rounded-md tracking-tighter flex items-center gap-1 shadow-lg">
                                                <span class="material-symbols-outlined text-[12px]">group</span>
                                                PARTICIPANT
                                            </span>
                                        </div>
                                    @endif
                                    <div class="flex flex-col gap-2">
                                        <div class="flex items-start justify-between">
                                            <h4 class="text-slate-900 dark:text-white text-xl font-bold leading-tight">
                                                {{ $active->name }}</h4>
                                            <span
                                                class="flex items-center gap-1 text-emerald-500 text-xs font-bold bg-emerald-500/10 px-2 py-1 rounded-full uppercase tracking-widest">
                                                <span class="material-symbols-outlined text-sm">check_circle</span>
                                                Actif
                                            </span>
                                        </div>
                                        <p class="text-slate-600 dark:text-slate-400 text-base leading-relaxed">
                                            {{ $active->description }}
                                        </p>
                                    </div>
                                    <div
                                        class="flex flex-wrap items-center @if($active->owner->user_id === auth()->user()->id) justify-between @else justify-end @endif gap-4 pt-4 border-t border-slate-100 dark:border-slate-800/50">
                                        @if ($active->owner->user_id === auth()->user()->id)
                                            <button onclick="showDisactivateModal({{ $active->id }})"
                                                class="flex items-center gap-2 px-4 py-2 text-crimson hover:bg-crimson/10 rounded-xl text-sm font-bold transition-colors">
                                                <span class="material-symbols-outlined text-lg">cancel</span>
                                                Annuler la colocation
                                            </button>
                                        @endif
                                        <a href="{{ route('colocation.show', $active->id) }}"
                                            class="flex items-center justify-center jus min-w-[100px] h-10 px-6 rounded-xl bg-slate-900 dark:bg-white text-white dark:text-navy-dark text-sm font-black transition-transform active:scale-95 shadow-md">
                                            Voir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div
                            class="flex flex-col items-stretch justify-start rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 shadow-sm overflow-hidden">
                            <div class="flex flex-col @container md:flex-row">
                                <div class="flex flex-1 flex-col justify-between p-6 pt-12 gap-4">
                                    <div class="flex flex-col gap-2">
                                        <h4 class="text-slate-900 dark:text-white text-xl font-bold leading-tight">
                                            Vous n'avez aucune colocation actuellement.</h4>
                                        <p class="text-slate-600 dark:text-slate-400 text-base leading-relaxed">
                                            Vous pouvez créer une colocation en cliquant sur le bouton ci-dessous.
                                        </p>
                                    </div>
                                    <div
                                        class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-slate-100 dark:border-slate-800/50">
                                        <button onclick="showCreateModal()"
                                            class="flex items-center gap-2 px-4 py-2 text-crimson hover:bg-crimson/10 rounded-xl text-sm font-bold transition-colors">
                                            <span class="material-symbols-outlined text-lg">add</span>
                                            Créer une colocation
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </section>
                <!-- History Section: Cancelled items -->
                <section class="flex flex-col gap-4 mt-6">
                    <h3
                        class="text-slate-900 dark:text-white text-lg font-bold flex items-center gap-2 uppercase tracking-tighter">
                        <span class="material-symbols-outlined text-slate-400">history</span>
                        Historique
                    </h3>
                    <div class="grid grid-cols-1 gap-4">
                        @forelse ($inactives as $inactive)
                            <div
                                class="flex items-center justify-between p-4 rounded-xl border border-dashed border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/20 grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="size-12 rounded-lg bg-slate-200 dark:bg-slate-800 flex items-center justify-center text-slate-400">
                                        <span class="material-symbols-outlined">apartment</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex items-center gap-2">
                                            <p class="text-slate-900 dark:text-white font-bold">{{ $inactive->name }}</p>
                                            <span
                                                class="bg-crimson/10 text-crimson text-[10px] font-black px-2 py-0.5 rounded uppercase tracking-widest border border-crimson/20">ANNULÉE</span>
                                        </div>
                                        <p class="text-slate-500 dark:text-slate-500 text-xs">Created {{ $inactive->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('colocation.show', $inactive->id) }}"
                                    class="size-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-800 text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-white dark:hover:bg-slate-800 transition-all">
                                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                                </a>
                            </div>
                        @empty
                            <p class="text-slate-500 dark:text-slate-400 text-sm">Aucune colocation annulée</p>
                        @endforelse
                    </div>
                </section>
            @else
                <main class="flex-1 flex flex-col items-center justify-center p-8 bg-background-dark">
                    <div class="max-w-2xl w-full flex flex-col items-center text-center">
                        <!-- Illustration Container -->
                        <div
                            class="relative w-full aspect-video max-w-md mb-8 rounded-2xl overflow-hidden shadow-2xl bg-gradient-to-b from-surface-dark to-background-dark border border-border-dark flex items-center justify-center">
                            <!-- Stylized Nautical Empty State Illustration -->
                            <div class="absolute inset-0 opacity-20 pointer-events-none">
                                <div
                                    class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-primary/40 via-transparent to-transparent">
                                </div>
                            </div>
                            <div class="flex flex-col items-center justify-center gap-4 relative z-10">
                                <div
                                    class="w-32 h-32 rounded-full bg-primary/10 flex items-center justify-center border border-primary/20">
                                    <span
                                        class="material-symbols-outlined text-7xl text-primary opacity-80">explore_off</span>
                                </div>
                                <!-- SVG Wave Decoration -->
                                <div class="w-48 h-12 flex items-end justify-center gap-1">
                                    <div class="w-3 h-4 bg-primary/30 rounded-full animate-pulse"></div>
                                    <div class="w-3 h-8 bg-primary/40 rounded-full"></div>
                                    <div class="w-3 h-6 bg-primary/20 rounded-full animate-pulse"></div>
                                    <div class="w-3 h-10 bg-primary/50 rounded-full"></div>
                                    <div class="w-3 h-4 bg-primary/30 rounded-full"></div>
                                </div>
                            </div>
                            <!-- Fallback Background Image -->
                            <div class="absolute inset-0 -z-10 bg-center bg-cover opacity-10"
                                data-alt="Une mer calme et sombre sous un ciel étoilé"
                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA3xGxZRIAMJUOuFAX3DkgZ81nKT6u3s_wCVP3fb7n8PMf0PnDs_X_dP5sVNyhL0mLlMCGRGd002FZj6o1JhkL2OJWYCMlgYv54s9AIWRnNPQZ0qr7-FyMc0QPZlJTseji6jpdqOJQ5uPuGqrFdINGdgWF09rOeu2Qur1iHbxgP__YAzJkGTtxtTNAbY_imxovjBJM9-thY8MKCb6BPAUcHG8HdtWgbMkLLFDhah51UdIAqqhflvtbZg83eLv3Q3Rd17SbirksY4gs');">
                            </div>
                        </div>
                        <!-- Text Content -->
                        <div class="space-y-4 mb-10">
                            <h1 class="text-slate-100 text-3xl md:text-4xl font-bold tracking-tight">Aucun
                                navire à l'horizon</h1>
                            <div class="h-1 w-20 bg-accent mx-auto rounded-full"></div>
                            <p class="text-slate-400 text-lg max-w-md mx-auto leading-relaxed">
                                Il semblerait que vous ne fassiez partie d'aucune colocation pour le moment.
                                Hissez les voiles et commencez votre aventure !
                            </p>
                        </div>
                        <!-- Call to Action -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button onclick="showCreateModal()"
                                class="flex items-center gap-2 px-8 py-4 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg shadow-primary/20">
                                <span class="material-symbols-outlined">add_circle</span>
                                Créer une colocation
                            </button>
                            <a href="{{ route('home') }}"
                                class="flex items-center gap-2 px-8 py-4 bg-surface-dark border border-border-dark hover:border-accent text-slate-100 font-bold rounded-xl transition-all">
                                <span class="material-symbols-outlined">home</span>
                                Back to home
                            </a>
                        </div>
                    </div>
                </main>
            @endif
        </div>
    </main>
@endsection

@section('modals')
    @php
        $is_there_add_colocation_errors = $errors->addColocation->any();
    @endphp
    <div id="add-colocation-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 @if (!$is_there_add_colocation_errors) hidden @endif">
        <!-- Modal Container -->
        <div
            class="relative w-full max-w-2xl bg-[#1a0f0f] rounded-xl overflow-hidden nautical-border shadow-2xl parchment-texture">
            <!-- Header Pattern/Decoration -->
            <div
                class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gold to-transparent opacity-50">
            </div>
            <!-- Modal Content -->
            <div class="p-8 md:p-12">
                <!-- Close Button -->
                <button onclick="closeCreateModal()"
                    class="absolute top-6 right-6 text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-3xl">close</span>
                </button>
                <!-- Heading Section -->
                <div class="flex flex-col gap-4 mb-10">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-4xl">explore</span>
                        <h2 class="text-3xl font-bold tracking-tight text-slate-100 uppercase">
                            Nouvel Horizon
                        </h2>
                    </div>
                    <div class="h-px w-24 bg-gold"></div>
                    <p class="text-slate-400 text-lg">Prêt à hisser les voiles avec votre nouvel équipage ? Créez votre
                        colocation maintenant.</p>
                </div>
                <!-- Form Section -->
                <form action="{{ route('colocation.store') }}" method="POST" class="flex flex-col gap-8">
                    @csrf
                    <!-- Title Field -->
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-2 text-gold font-semibold uppercase tracking-wider text-sm">
                            <span class="material-symbols-outlined text-sm">anchor</span>
                            Nom du Navire / Nom de la Coloc
                        </label>
                        <div class="relative group">
                            <input name="name" value="{{ old('name') }}"
                                class="w-full bg-background-dark/50 border-2 border-primary/20 rounded-lg py-4 px-5 text-slate-100 placeholder:text-slate-600 focus:border-primary focus:ring-0 focus:outline-none transition-all group-hover:border-primary/40"
                                placeholder="Ex: Thousand Sunny" type="text" />
                        </div>
                        @error('name', 'addColocation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Description Field -->
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-2 text-gold font-semibold uppercase tracking-wider text-sm">
                            <span class="material-symbols-outlined text-sm">description</span>
                            Votre mission / Détails du logement
                        </label>
                        <div class="relative group">
                            <textarea name="description"
                                class="w-full bg-background-dark/50 border-2 border-primary/20 rounded-lg py-4 px-5 text-slate-100 placeholder:text-slate-600 focus:border-primary focus:ring-0 focus:outline-none transition-all resize-none group-hover:border-primary/40"
                                placeholder="Décrivez l'aventure, les trésors cachés du quartier et les règles de vie à bord..." rows="5">{{ old('description') }}</textarea>
                        </div>
                        @error('description', 'addColocation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-end gap-4 mt-4">
                        <button onclick="closeCreateModal()"
                            class="w-full sm:w-auto px-8 py-3 rounded-lg font-bold text-primary hover:bg-primary/10 border-2 border-transparent transition-all uppercase tracking-widest flex items-center justify-center gap-2"
                            type="button">
                            Annuler
                        </button>
                        <button
                            class="w-full sm:w-auto px-10 py-4 bg-primary text-white rounded-lg font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 hover:scale-[1.02] active:scale-[0.98] transition-all uppercase tracking-widest flex items-center justify-center gap-3"
                            type="submit">
                            <span class="truncate">Lancer l'Aventure</span>
                            <span class="material-symbols-outlined">sailing</span>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Bottom Accent -->
            <div class="bg-primary/5 p-4 flex justify-center border-t border-primary/10">
                <div class="flex gap-6 opacity-30">
                    <span class="material-symbols-outlined text-gold">sailing</span>
                    <span class="material-symbols-outlined text-gold">map</span>
                    <span class="material-symbols-outlined text-gold">compass_calibration</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCreateModal() {
            const modal = document.getElementById('add-colocation-modal');
            modal.classList.remove('hidden');
        }

        function closeCreateModal() {
            const modal = document.getElementById('add-colocation-modal');
            const form = modal.querySelector('form');
            form.reset();
            modal.classList.add('hidden');
        }
    </script>

    <div id="desactivate-colocation-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div class="flex flex-1 items-center justify-center p-4">
            <div class="w-full max-w-[520px] rounded-xl bg-white/5 p-8 shadow-2xl border border-primary/10 backdrop-blur-sm">
                <!-- Icon Section -->
                <div class="flex justify-center mb-6">
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-primary/20 text-primary">
                        <span class="material-symbols-outlined text-5xl">warning</span>
                    </div>
                </div>
                <!-- Text Content -->
                <div class="text-center space-y-4">
                    <h3 class="text-3xl font-bold leading-tight tracking-tight">
                        Dissoudre l'Équipage ?
                    </h3>
                    <p class="text-slate-300 text-lg font-normal leading-relaxed">
                        Attention Capitaine ! Voulez-vous vraiment dissoudre cette colocation ? Tous les membres
                        seront expulsés et les données seront archivées.
                    </p>
                </div>
                <!-- Action Buttons -->
                <div class="mt-10 flex flex-col gap-4">
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            class="flex h-14 w-full cursor-pointer items-center justify-center rounded-lg bg-primary text-white text-lg font-bold tracking-wide hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">
                            <span class="truncate">Abandonner le Navire</span>
                        </button>
                    </form>
                    <button onclick="closeDisactivateModal()"
                        class="flex h-14 w-full cursor-pointer items-center justify-center rounded-lg bg-slate-800 text-slate-100 text-lg font-bold tracking-wide hover:bg-slate-700 transition-all border border-slate-700">
                        <span class="truncate">Rester à Bord</span>
                    </button>
                </div>
                <!-- Additional Context (Optional) -->
                <div class="mt-8 text-center">
                    <p class="text-xs uppercase tracking-widest text-slate-500 font-semibold">Action Irréversible
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDisactivateModal(id) {
            const modal = document.getElementById('desactivate-colocation-modal');
            const form = modal.querySelector('form');
            form.action = "{{ route('colocation.destroy', ':id') }}".replace(':id', id);
            modal.classList.remove('hidden');
        }

        function closeDisactivateModal() {
            const modal = document.getElementById('desactivate-colocation-modal');
            const form = modal.querySelector('form');
            form.action = "";
            modal.classList.add('hidden');
        }
    </script>
@endsection
