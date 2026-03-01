@extends('layouts.app')

@section('title', 'EasyColoc - Categories')

@section('content')
    <main class="flex-grow max-w-6xl mx-auto w-full px-6 py-12 lg:px-20">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <nav class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-sm mb-4">
                    <span class="material-symbols-outlined text-sm">home</span>
                    <a href="{{ route('colocation.show', $colocationId) }}">Colocation</a>
                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                    <span class="text-primary font-medium">Catégories</span>
                </nav>
                @if (!$is_active)
                    <div
                        class="my-5 p-4 rounded-xl bg-slate-100 dark:bg-slate-800/30 border border-slate-200 dark:border-slate-800">
                        <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            Colocation non active</p>
                    </div>
                @endif
                <h1 class="text-4xl md:text-5xl font-black tracking-tight dark:text-slate-100">
                    Catégories de <span
                        class="text-primary underline decoration-accent decoration-4 underline-offset-8">Dépenses</span>
                </h1>
                <p class="mt-6 text-slate-600 dark:text-slate-400 text-lg">
                    Organisez les trésors de votre équipage avec précision.
                </p>
            </div>
            <div class="md:hidden">
                <button
                    class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-primary text-white rounded-xl font-bold">
                    <span class="material-symbols-outlined">add</span>
                    <span>Nouvelle Catégorie</span>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($categories as $category)
                <div
                    class="group flex flex-col p-6 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 hover:border-primary transition-all cursor-pointer relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-full -mr-12 -mt-12 group-hover:bg-primary/10 transition-colors">
                    </div>
                    <div
                        class="size-14 rounded-xl bg-primary/10 dark:bg-primary/20 flex items-center justify-center text-primary mb-6">
                        <span class="material-symbols-outlined text-3xl">category</span>
                    </div>
                    <h3 class="text-xl font-bold dark:text-slate-100">{{ $category->name }}</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">{{ $category->description }}</p>
                    <div class="mt-6 flex items-center gap-1 text-accent-gold font-bold text-xs uppercase tracking-wider">
                        <div class="flex items-center justify-end w-full">
                            <div class="flex items-center gap-4">
                                <button @disabled(!$is_active)
                                    onclick="showEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')"
                                    class="text-slate-400 hover:text-accent-gold transition-colors" title="Modifier"><span
                                        class="material-symbols-outlined text-sm">edit</span></button>
                                <button @disabled(!$is_active) onclick="showDeleteModal({{ $category->id }})" class="text-slate-400 hover:text-primary transition-colors" title="Supprimer"><span
                                        class="material-symbols-outlined text-sm">delete</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Ajouter Nouveau - Ghost State -->
            <div @if($is_active) onclick="showCreateModal()" @endif
                class="group flex flex-col items-center justify-center p-6 rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-800 bg-transparent hover:border-primary/50 transition-all cursor-pointer h-full min-h-[220px]">
                <div
                    class="size-12 rounded-full bg-slate-100 dark:bg-slate-800/50 flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors mb-4">
                    <span class="material-symbols-outlined text-3xl">add_circle</span>
                </div>
                <span
                    class="text-slate-500 dark:text-slate-400 font-semibold group-hover:text-primary transition-colors">Nouvelle
                    Catégorie</span>
            </div>
        </div>
    </main>
@endsection

@section('modals')
    @php
        $is_there_add_category_errors = $errors->addCategory->any();
    @endphp
    <div id="add-category-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 @if (!$is_there_add_category_errors) hidden @endif">
        <div class="relative flex min-h-screen w-full flex-col items-center justify-center p-4 overflow-x-hidden">
            <!-- Background Overlay (Simulating the app behind) -->
            <div class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm z-0"
                data-alt="Dark navy ocean background with blur effect"></div>
            <!-- Modal Container -->
            <form action="{{ route('colocation.category.store', $colocationId) }}" method="POST"
                class="relative z-10 w-full max-w-lg overflow-hidden rounded-xl border border-primary/30 shadow-2xl parchment-texture">
                @csrf
                <!-- Header -->
                <header class="flex items-center justify-between border-b border-primary/20 bg-primary/10 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-primary text-white shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-2xl">sailing</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold tracking-tight text-slate-100">Nouvel Inventaire</h2>
                            <p class="text-xs font-medium uppercase tracking-widest text-accent-gold/80">Logbook de
                                l'Équipage</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeCreateModal()"
                        class="text-slate-400 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </header>
                <!-- Form Content -->
                <div class="p-6 space-y-6">
                    <div class="space-y-2">
                        <p class="text-slate-300 text-sm leading-relaxed">
                            Ajoutez une nouvelle mission à l'équipage. Définissez les trésors ou les vivres à surveiller.
                        </p>
                    </div>
                    <!-- Input Category -->
                    <div class="flex flex-col gap-2">
                        <label class="flex items-center gap-2 text-sm font-semibold text-accent-gold">
                            <span class="material-symbols-outlined text-lg">label</span>
                            Nom de la catégorie
                        </label>
                        <input name="name" value="{{ old('name') }}"
                            class="w-full rounded-lg border border-primary/30 bg-background-dark/50 p-3.5 text-slate-100 placeholder:text-slate-500 focus:border-accent-gold focus:ring-1 focus:ring-accent-gold outline-none transition-all"
                            placeholder="ex: Rhum et Provisions" type="text" />
                        @error('name', 'addCategory')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Input Description -->
                    <div class="flex flex-col gap-2">
                        <label class="flex items-center gap-2 text-sm font-semibold text-accent-gold">
                            <span class="material-symbols-outlined text-lg">description</span>
                            Mission de la catégorie
                        </label>
                        <textarea name="description"
                            class="w-full resize-none rounded-lg border border-primary/30 bg-background-dark/50 p-3.5 text-slate-100 placeholder:text-slate-500 focus:border-accent-gold focus:ring-1 focus:ring-accent-gold outline-none transition-all"
                            placeholder="Décrivez le rôle de cet inventaire pour le navire..." rows="4">{{ old('description') }}</textarea>
                        @error('description', 'addCategory')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 border-t border-primary/10 bg-black/20 p-6">
                    <button type="button" onclick="closeCreateModal()"
                        class="flex items-center justify-center gap-2 px-5 h-11 rounded-lg border border-primary/40 text-slate-300 hover:bg-primary/10 hover:text-white transition-all font-bold text-sm">
                        <span>Annuler</span>
                    </button>
                    <button type="submit"
                        class="flex items-center justify-center gap-2 px-6 h-11 rounded-lg bg-primary text-white shadow-lg shadow-primary/30 hover:bg-primary/80 transition-all font-bold text-sm">
                        <span class="material-symbols-outlined text-lg">anchor</span>
                        <span>Ajouter au Navire</span>
                    </button>
                </div>
                <!-- Decorative Corner Element -->
                <div class="absolute bottom-0 left-0 p-2 opacity-20 pointer-events-none">
                    <span class="material-symbols-outlined text-4xl text-accent-gold">skull</span>
                </div>
            </form>
            <!-- Background Decoration Elements -->
            <div class="fixed top-10 left-10 opacity-10 pointer-events-none">
                <span class="material-symbols-outlined text-[120px] text-primary">explore</span>
            </div>
            <div class="fixed bottom-10 right-10 opacity-10 pointer-events-none rotate-12">
                <span class="material-symbols-outlined text-[150px] text-accent-gold">history_edu</span>
            </div>
        </div>
    </div>

    <script>
        function showCreateModal() {
            const modal = document.getElementById('add-category-modal');
            modal.classList.remove('hidden');
        }

        function closeCreateModal() {
            const modal = document.getElementById('add-category-modal');
            const form = modal.querySelector('form');
            form.reset();
            modal.classList.add('hidden');
        }
    </script>


    @php
        $is_there_edit_category_errors = $errors->editCategory->any();
    @endphp
    <div id="edit-category-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 @if (!$is_there_edit_category_errors) hidden @endif">
        <div class="relative flex min-h-screen w-full flex-col items-center justify-center p-4 overflow-x-hidden">
            <!-- Background Overlay (Simulating the app behind) -->
            <div class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm z-0"
                data-alt="Dark navy ocean background with blur effect"></div>
            <!-- Modal Container -->
            <form
                action="@if (session()->has('categoryId')) {{ route('colocation.category.update', [session()->get('categoryId')]) }} @endif"
                method="POST"
                class="relative z-10 w-full max-w-lg overflow-hidden rounded-xl border border-primary/30 shadow-2xl parchment-texture">
                @csrf
                @method('PUT')
                <!-- Header -->
                <header class="flex items-center justify-between border-b border-primary/20 bg-primary/10 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-primary text-white shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-2xl">sailing</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold tracking-tight text-slate-100">Réviser Inventaire</h2>
                            <p class="text-xs font-medium uppercase tracking-widest text-accent-gold/80">Quartier maitre</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeEditModal()"
                        class="text-slate-400 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </header>
                <!-- Form Content -->
                <div class="p-6 space-y-6">
                    <div class="space-y-2">
                        <p class="text-slate-300 text-sm leading-relaxed">
                            Ajustez les détails de votre catégorie de butin.
                        </p>
                    </div>
                    <!-- Input Category -->
                    <div class="flex flex-col gap-2">
                        <label class="flex items-center gap-2 text-sm font-semibold text-accent-gold">
                            <span class="material-symbols-outlined text-lg">label</span>
                            Nom de la catégorie
                        </label>
                        <input name="name" value="{{ old('name') }}"
                            class="w-full rounded-lg border border-primary/30 bg-background-dark/50 p-3.5 text-slate-100 placeholder:text-slate-500 focus:border-accent-gold focus:ring-1 focus:ring-accent-gold outline-none transition-all"
                            placeholder="ex: Rhum et Provisions" type="text" />
                        @error('name', 'editCategory')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Input Description -->
                    <div class="flex flex-col gap-2">
                        <label class="flex items-center gap-2 text-sm font-semibold text-accent-gold">
                            <span class="material-symbols-outlined text-lg">description</span>
                            Mission de la catégorie
                        </label>
                        <textarea name="description"
                            class="w-full resize-none rounded-lg border border-primary/30 bg-background-dark/50 p-3.5 text-slate-100 placeholder:text-slate-500 focus:border-accent-gold focus:ring-1 focus:ring-accent-gold outline-none transition-all"
                            placeholder="Décrivez le rôle de cet inventaire pour le navire..." rows="4">{{ old('description') }}</textarea>
                        @error('description', 'editCategory')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 border-t border-primary/10 bg-black/20 p-6">
                    <button type="button" onclick="closeEditModal()"
                        class="flex items-center justify-center gap-2 px-5 h-11 rounded-lg border border-primary/40 text-slate-300 hover:bg-primary/10 hover:text-white transition-all font-bold text-sm">
                        <span>Annuler</span>
                    </button>
                    <button type="submit"
                        class="flex items-center justify-center gap-2 px-6 h-11 rounded-lg bg-primary text-white shadow-lg shadow-primary/30 hover:bg-primary/80 transition-all font-bold text-sm">
                        <span class="material-symbols-outlined text-lg">anchor</span>
                        <span>Mettre à jour</span>
                    </button>
                </div>
                <!-- Decorative Corner Element -->
                <div class="absolute bottom-0 left-0 p-2 opacity-20 pointer-events-none">
                    <span class="material-symbols-outlined text-4xl text-accent-gold">skull</span>
                </div>
            </form>
            <!-- Background Decoration Elements -->
            <div class="fixed top-10 left-10 opacity-10 pointer-events-none">
                <span class="material-symbols-outlined text-[120px] text-primary">explore</span>
            </div>
            <div class="fixed bottom-10 right-10 opacity-10 pointer-events-none rotate-12">
                <span class="material-symbols-outlined text-[150px] text-accent-gold">history_edu</span>
            </div>
        </div>
    </div>

    <script>
        function showEditModal(id, name, description) {
            const modal = document.getElementById('edit-category-modal');
            const form = modal.querySelector('form');
            form.action = "{{ route('colocation.category.update', ':id') }}".replace(':id', id);
            form.querySelector('input[name="name"]').value = name;
            form.querySelector('textarea[name="description"]').value = description;
            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            const modal = document.getElementById('edit-category-modal');
            const form = modal.querySelector('form');
            form.reset();
            form.action = "";
            modal.classList.add('hidden');
        }
    </script>

    <div id="delete-category-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
            <main
                class="flex flex-1 items-center justify-center p-4 sm:p-6 lg:p-8 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-primary/10 via-background-dark to-background-dark">
                <!-- Confirmation Modal Container -->
                <div
                    class="max-w-md w-full bg-navy-accent/40 border border-primary/30 backdrop-blur-xl rounded-xl shadow-2xl overflow-hidden">
                    <!-- Header/Icon Section -->
                    <div class="relative h-32 flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-b from-primary/20 to-transparent"></div>
                        <div
                            class="relative flex items-center justify-center size-16 rounded-full bg-background-dark border-2 border-primary shadow-[0_0_20px_rgba(199,41,41,0.4)]">
                            <span class="material-symbols-outlined text-primary text-4xl font-bold">close</span>
                        </div>
                    </div>
                    <!-- Content Section -->
                    <div class="px-8 pt-2 pb-8 text-center">
                        <div
                            class="inline-flex items-center gap-2 mb-4 px-3 py-1 rounded-full bg-primary/10 border border-primary/20">
                            <span class="material-symbols-outlined text-primary text-sm">warning</span>
                            <span class="text-primary text-xs font-bold uppercase tracking-widest">Zone de Danger</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-100 mb-3 tracking-tight">Supprimer cette catégorie ?
                        </h2>
                        <p class="text-slate-400 text-sm leading-relaxed mb-8">
                            Attention, cette action est irréversible et affectera les logs associés. Êtes-vous sûr de
                            vouloir envoyer ce contenu au fond des océans ?
                        </p>
                        <!-- Action Buttons -->
                        <div class="flex flex-col gap-3">
                            <form action="" method="post">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="w-full py-3.5 rounded-lg bg-primary hover:bg-primary/90 text-white font-bold text-sm tracking-wide transition-all shadow-lg shadow-primary/20 active:scale-[0.98]">
                                    Jeter par-dessus bord
                                </button>
                            </form>
                            <button onclick="closeDeleteModal()"
                                class="w-full py-3.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-sm tracking-wide transition-all active:scale-[0.98]">
                                Garder
                            </button>
                        </div>
                    </div>
                    <!-- Bottom Accent -->
                    <div class="h-1 w-full bg-gradient-to-r from-transparent via-gold-accent/50 to-transparent opacity-30">
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function showDeleteModal(id) {
            const modal = document.getElementById('delete-category-modal');
            const form = modal.querySelector('form');
            form.action = "{{ route('colocation.category.destroy', ':id') }}".replace(':id', id);
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-category-modal');
            const form = modal.querySelector('form');
            form.action = "";
            modal.classList.add('hidden');
        }
    </script>

@endsection
