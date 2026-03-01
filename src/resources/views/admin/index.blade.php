@extends('layouts.app')

@section('title', 'EasyColoc - Admin')

@section('content')
    <main class="flex-1 flex flex-col overflow-hidden relative">
        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-navy border border-admin-primary/20 rounded-xl p-6 relative overflow-hidden group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Total Effectifs</p>
                            <h3 class="text-3xl font-bold text-white mt-1">{{ $total_users }}</h3>
                        </div>
                        <div class="bg-admin-primary/10 p-3 rounded-lg text-admin-primary">
                            <span class="material-symbols-outlined">groups</span>
                        </div>
                    </div>
                </div>
                <div class="bg-navy border border-admin-primary/20 rounded-xl p-6 relative overflow-hidden group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Soldats Actifs</p>
                            <h3 class="text-3xl font-bold text-white mt-1">{{ $total_active }}</h3>
                            <p class="text-green-400 text-xs mt-2 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">check_circle</span> Statut
                                opérationnel
                            </p>
                        </div>
                        <div class="bg-admin-primary/10 p-3 rounded-lg text-admin-primary">
                            <span class="material-symbols-outlined">verified_user</span>
                        </div>
                    </div>
                </div>
                <div class="bg-navy border border-danger/20 rounded-xl p-6 relative overflow-hidden group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Prisonniers / Bannis</p>
                            <h3 class="text-3xl font-bold text-white mt-1">{{ $total_inactive }}</h3>
                            <p class="text-danger text-xs mt-2 flex items-center gap-1 font-bold">
                                <span class="material-symbols-outlined text-xs">gavel</span> Action disciplinaire
                                requise
                            </p>
                        </div>
                        <div class="bg-danger/10 p-3 rounded-lg text-danger">
                            <span class="material-symbols-outlined">block</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Table Card -->
            <div
                class="bg-white dark:bg-navy/40 border border-slate-200 dark:border-admin-primary/20 rounded-xl shadow-xl overflow-hidden backdrop-blur-sm">
                <div
                    class="px-6 py-4 border-b border-slate-200 dark:border-admin-primary/20 flex items-center justify-between bg-navy/20">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-admin-primary flex items-center gap-2">
                        <span class="material-symbols-outlined">list_alt</span> Répertoire des Effectifs
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50 dark:bg-navy/60 text-slate-500 dark:text-slate-400 uppercase text-[10px] tracking-widest font-bold">
                                <th class="px-6 py-4">Soldat</th>
                                <th class="px-6 py-4">Contact HQ</th>
                                <th class="px-6 py-4 text-center">Statut</th>
                                <th class="px-6 py-4 text-center">Casier</th>
                                <th class="px-6 py-4">Enrôlement</th>
                                <th class="px-6 py-4 text-right">Actions Disciplinaires</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-admin-primary/10">
                            @forelse($users as $user)
                                <tr class="hover:bg-slate-50 dark:hover:bg-admin-primary/5 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full overflow-hidden bg-slate-200">
                                                <img alt="User" class="w-full h-full object-cover"
                                                    data-alt="Portrait of a user for management table"
                                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAfrL1vWY-G0gKYiLtFsBQh2YX6DjkmknydFpF9sHORagOgAzEnuaJvLuj9H65z86zHTMW_5TKfFZYyCzAk2QqVBAc3YDYa24ta7jZkjb8JLmuadX_mjZZ1aaR3Kw8-nap11bFFL_tEDi_sb_bugR88YQeHmB-mg78cuOdNRBNw3rWj45mwyj5tBDblCC131uB7f6hrObjo_UnT5_muqhiY0LJTq2d4MqiDC4FBlrPGTpta7rIJLcHsPXir3K4TQYBCxkXWbJGG7Mg" />
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold dark:text-slate-100">{{ ucwords($user->name) }}
                                                </p>
                                                <p class="text-[10px] text-admin-primary/80 font-medium">
                                                    {{ strtoupper($user->role) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-slate-600 dark:text-slate-400 italic">{{ $user->email }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($user->status == 'ACTIVE')
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-[10px] font-bold bg-green-500/10 text-green-500 border border-green-500/20 uppercase tracking-tighter">
                                                <span class="size-1.5 rounded-full bg-green-500 mr-1"></span> Actif
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-[10px] font-bold bg-slate-500/10 text-slate-500 border border-slate-500/20 uppercase tracking-tighter">
                                                <span class="size-1.5 rounded-full bg-slate-500 mr-1"></span> Inactif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($user->is_banned)
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-[10px] font-bold bg-danger/10 text-danger border border-danger/20 uppercase tracking-tighter">
                                                Banni
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-[10px] font-bold bg-admin-primary/10 text-admin-primary border border-admin-primary/20 uppercase tracking-tighter">
                                                Vierge
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm dark:text-slate-300">{{ $user->created_at->format('d M Y') }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($user->role == 'USER')
                                            <div class="flex justify-end gap-2">
                                                @if ($user->status == 'ACTIVE')
                                                    <button onclick="showDeactivateModal({{ $user->id }})"
                                                        class="px-3 py-1.5 bg-slate-100 dark:bg-navy/40 text-slate-700 dark:text-slate-300 rounded text-[11px] font-bold hover:bg-slate-200 dark:hover:bg-navy/60 transition-colors">DÉSACTIVER</button>
                                                @else
                                                    <button onclick="showActivateModal({{ $user->id }})"
                                                        class="px-3 py-1.5 bg-green-500/10 text-green-500 border border-green-500/20 rounded text-[11px] font-bold hover:bg-green-500 hover:text-white transition-all">ACTIVER</button>
                                                @endif
                                                @if ($user->is_banned)
                                                    <button
                                                        onclick="showUnBanModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->reputation }}')"
                                                        class="px-3 py-1.5 bg-admin-primary/10 text-admin-primary border border-admin-primary/20 rounded text-[11px] font-bold hover:bg-admin-primary hover:text-navy transition-all">GRACIER</button>
                                                @else
                                                    <button
                                                        onclick="showBanModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->reputation }}')"
                                                        class="px-3 py-1.5 bg-danger/10 text-danger border border-danger/20 rounded text-[11px] font-bold hover:bg-danger hover:text-white transition-all">BANNIR</button>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center">Aucun utilisateur</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('modals')
    <div id="ban-user-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
            <main
                class="flex flex-1 items-center justify-center p-4 sm:p-6 lg:p-10 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-primary/5 via-background-dark to-background-dark">
                <!-- Modal Container -->
                <div
                    class="relative w-full max-w-lg overflow-hidden rounded-xl border border-primary/30 bg-navy-deep shadow-2xl">
                    <!-- Modal Decoration Header -->
                    <div class="h-1.5 w-full bg-gradient-to-r from-primary via-accent-gold to-primary"></div>
                    <div class="p-8">
                        <!-- Warning Icon Section -->
                        <div class="mb-6 flex justify-center">
                            <div class="relative">
                                <div class="absolute inset-0 animate-ping rounded-full bg-primary/20"></div>
                                <div
                                    class="relative flex h-20 w-20 items-center justify-center rounded-full bg-primary/10 border-2 border-primary">
                                    <span class="material-symbols-outlined text-5xl text-primary">anchor</span>
                                    <div
                                        class="absolute -right-1 -top-1 flex h-7 w-7 items-center justify-center rounded-full bg-primary text-white ring-4 ring-navy-deep">
                                        <span class="material-symbols-outlined text-sm font-bold">close</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Text Content -->
                        <div class="text-center">
                            <h2 class="mb-3 text-3xl font-bold tracking-tight text-slate-100 uppercase tracking-widest">
                                Sentence de Bannissement
                            </h2>
                            <div class="mx-auto mb-6 h-px w-24 bg-accent-gold/30"></div>
                            <p class="text-lg leading-relaxed text-slate-300">
                                Êtes-vous sûr de vouloir bannir cet utilisateur ? <br />
                                <span class="mt-2 block font-medium text-primary/90">Il n'aura plus accès à aucun navire
                                    sur Grand Line.</span>
                            </p>
                        </div>
                        <!-- User Preview Card -->
                        <div class="mt-8 flex items-center gap-4 rounded-lg border border-primary/10 bg-primary/5 p-4">
                            <div class="h-14 w-14 overflow-hidden rounded-lg border border-accent-gold/20">
                                <img class="h-full w-full object-cover" data-alt="User suspected of piracy to be banned"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBthCK0cgtzjGCUd4TrwA0GrwXYrFKPqL-p0cQhXWizAk40K26pqLsiWzHV6sRJIqbRb7WIsyYt3I5Zb04Ycdik6b_zVJjaGO5OZ9WbM6Kz8Ko9lgDvsuCNUmsA9BbdSStVswmorquSEDrwDgflbSoSpAkFm0vu3R0Yg7oJ47Vogj3-IjYMJmC77Lthiuq7QqoELmWmAaK6AVTn7f5ogvGVfKmkTXd1vjiJ7bZmrBNiOc75Wkge-kF_jJiX-1d4pQKZ0VwmtRbuXMM" />
                            </div>
                            <div class="flex-1 text-left">
                                <p class="text-sm font-semibold text-accent-gold uppercase tracking-wider">Criminel
                                    Recherché</p>
                                <p class="text-lg font-bold text-slate-100 italic">"<span class="name"></span>"</p>
                            </div>
                            <div class="text-right">
                                <span
                                    class="inline-flex items-center rounded-full bg-primary/20 px-2.5 py-0.5 text-xs font-medium text-primary border border-primary/20">
                                    Reputation: <span class="reputation"></span>
                                </span>
                            </div>
                        </div>
                        <!-- Actions -->
                        <div class="mt-10 flex flex-col gap-3">
                            <form action="" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="flex w-full items-center justify-center gap-2 rounded-lg bg-primary px-6 py-4 text-lg font-bold text-white shadow-lg transition-all hover:bg-primary/90 active:scale-[0.98] border border-white/10">
                                    <span class="material-symbols-outlined">gavel</span>
                                    Confirmer le Bannissement
                                </button>
                            </form>
                            <button onclick="closeBanModal()"
                                class="group flex w-full items-center justify-center gap-2 rounded-lg bg-transparent border-2 border-accent-gold/20 px-6 py-3 text-lg font-semibold text-accent-gold transition-all hover:bg-accent-gold/10 hover:border-accent-gold/50">
                                <span
                                    class="material-symbols-outlined text-accent-gold/70 group-hover:text-accent-gold transition-colors">undo</span>
                                Annuler la Procédure
                            </button>
                        </div>
                    </div>
                    <!-- Footer Visual Decoration -->
                    <div class="flex items-center justify-center gap-2 py-4 bg-primary/5 border-t border-primary/10">
                        <span class="material-symbols-outlined text-xs text-accent-gold/40">verified_user</span>
                        <span class="text-[10px] uppercase tracking-[0.2em] text-accent-gold/40 font-bold">Sceau de Justice
                            de la Marine</span>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function showBanModal(id, name, reputation) {
            const modal = document.getElementById('ban-user-modal');
            modal.querySelector('.name').textContent = name;
            modal.querySelector('.reputation').textContent = reputation;

            const form = modal.querySelector('form');
            form.action = "{{ route('admin.ban', ':id') }}".replace(':id', id);
            modal.classList.remove('hidden');
        }

        function closeBanModal() {
            const modal = document.getElementById('ban-user-modal');
            modal.querySelector('.name').textContent = "";
            modal.querySelector('.reputation').textContent = "";

            const form = modal.querySelector('form');
            form.action = "";
            modal.classList.add('hidden');
        }
    </script>

    <div id="unban-user-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
            <div class="layout-container flex h-full grow flex-col">
                <main class="flex-1 flex items-center justify-center p-4 relative">
                    <!-- Background Content (Blurred) -->
                    <div class="absolute inset-0 opacity-20 pointer-events-none filter blur-sm flex flex-col p-10 gap-8">
                        <div class="h-8 w-48 bg-slate-300 dark:bg-primary/20 rounded"></div>
                        <div class="grid grid-cols-3 gap-6">
                            <div class="h-40 bg-slate-300 dark:bg-primary/10 rounded-xl"></div>
                            <div class="h-40 bg-slate-300 dark:bg-primary/10 rounded-xl"></div>
                            <div class="h-40 bg-slate-300 dark:bg-primary/10 rounded-xl"></div>
                        </div>
                        <div class="h-64 bg-slate-300 dark:bg-primary/10 rounded-xl"></div>
                    </div>
                    <!-- Confirmation Modal (Grâce Marine) -->
                    <div
                        class="relative w-full max-w-md bg-white dark:bg-[#2a1a1a] rounded-xl shadow-2xl border border-slate-200 dark:border-primary/30 overflow-hidden z-10">
                        <!-- Top Decorative Bar -->
                        <div class="h-1.5 w-full bg-gradient-to-r from-accent-gold via-primary to-accent-gold"></div>
                        <div class="p-8 flex flex-col items-center text-center">
                            <!-- Icon Container -->
                            <div class="mb-6 relative">
                                <div
                                    class="size-20 rounded-full bg-accent-gold/10 dark:bg-accent-gold/20 flex items-center justify-center border-2 border-accent-gold/30">
                                    <span class="material-symbols-outlined text-accent-gold text-5xl fill-1">sunny</span>
                                </div>
                                <div
                                    class="absolute -bottom-1 -right-1 size-8 rounded-full bg-white dark:bg-[#2a1a1a] flex items-center justify-center border border-slate-200 dark:border-primary/30 shadow-sm">
                                    <span class="material-symbols-outlined text-primary text-xl">verified_user</span>
                                </div>
                            </div>
                            <!-- Text Content -->
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">Grâce Marine</h3>
                            <p class="text-slate-600 dark:text-slate-300 leading-relaxed mb-8">
                                Souhaitez-vous lever le bannissement de cet utilisateur ? <br class="hidden sm:block" />
                                Il pourra à nouveau rejoindre des équipages et naviguer sous la surveillance du QG.
                            </p>
                            <!-- User Card Preview -->
                            <div
                                class="w-full flex items-center gap-4 p-3 mb-8 rounded-lg bg-slate-50 dark:bg-primary/5 border border-slate-100 dark:border-primary/10">
                                <div class="size-12 rounded-lg bg-center bg-cover border border-slate-200 dark:border-primary/20"
                                    data-alt="Avatar of the pirate to be pardoned"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCltVTbPgAXnVYituH49n44SsQJ0l5g4UQqkadlAb6eopnpV7SLvxn--BFGpvmQhe2QGomextw_AoAoPbVrKuV57zWynqbmXbPuq1rznxEN2uRhlJMUgsoF1BxowXUWTDWusKWILOEYRitG4ItW2ZQJfnH7g-rwF7M0lJ1qk-fT7sK40X5T7t6nhevWF_TuwuJf4qDyWr8zmku30wVWusv_X9yd-4wQY3fGwhuqF7fnYuriboeKtn8n0AS2PTeN09U37o5h-_XxSjY");'>
                                </div>
                                <div class="text-left">
                                    <p class="name font-bold text-slate-800 dark:text-slate-200"></p>
                                    <p class="text-xs text-primary font-medium tracking-wider uppercase">Reputation: <span
                                            class="reputation"></span></p>
                                </div>
                            </div>
                            <!-- Buttons Section -->
                            <div class="flex flex-col sm:flex-row gap-3 w-full">
                                <form action="" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="flex-1 px-6 py-3.5 bg-accent-gold hover:bg-[#c4a030] text-marine-navy font-bold rounded-lg transition-all shadow-lg shadow-accent-gold/20 flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-xl">gavel</span>
                                        Accorder la Grâce
                                    </button>
                                </form>
                                <button onclick="closeUnBanModal()"
                                    class="flex-1 px-6 py-3.5 bg-slate-100 dark:bg-marine-navy hover:bg-slate-200 dark:hover:bg-opacity-80 text-slate-700 dark:text-white font-bold rounded-lg transition-all border border-slate-200 dark:border-primary/10">
                                    Annuler
                                </button>
                            </div>
                        </div>
                        <!-- Footer Note -->
                        <div
                            class="px-8 py-4 bg-slate-50 dark:bg-black/20 border-t border-slate-100 dark:border-primary/10">
                            <p
                                class="text-[10px] text-slate-400 dark:text-slate-500 text-center uppercase tracking-widest">
                                Conformément aux décrets de la Justice Absolue • Marine HQ
                            </p>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        function showUnBanModal(id, name, reputation) {
            const modal = document.getElementById('unban-user-modal');
            modal.querySelector('.name').textContent = name;
            modal.querySelector('.reputation').textContent = reputation;
            modal.querySelector('form').action = "{{ route('admin.unban', ':id') }}".replace(':id', id);
            modal.classList.remove('hidden');
        }

        function closeUnBanModal() {
            const modal = document.getElementById('unban-user-modal');
            modal.querySelector('form').action = "";
            modal.classList.add('hidden');
        }
    </script>

    <div id="deactivate-user-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden">
            <div class="layout-container flex h-full grow flex-col">
                <main class="flex-1 flex items-center justify-center p-4 bg-slate-100 dark:bg-background-dark/95">
                    <!-- Deactivation Modal -->
                    <div
                        class="w-full max-w-[480px] bg-white dark:bg-[#2a1818] rounded-xl shadow-2xl border border-slate-200 dark:border-primary/20 overflow-hidden">
                        <!-- Modal Header Icon -->
                        <div class="flex flex-col items-center pt-8 pb-4">
                            <div
                                class="flex items-center justify-center w-20 h-20 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 mb-4 ring-8 ring-blue-50/50 dark:ring-blue-900/10">
                                <span class="material-symbols-outlined !text-5xl" data-icon="bedtime">bedtime</span>
                            </div>
                            <h3 class="text-slate-900 dark:text-white text-2xl font-bold tracking-tight px-6 text-center">
                                Désactivation du Profil
                            </h3>
                        </div>
                        <!-- Modal Body -->
                        <div class="px-8 py-4">
                            <div
                                class="flex items-center gap-3 rounded-lg border border-slate-200 dark:border-primary/30 bg-slate-50 dark:bg-primary/5 p-4 mb-6">
                                <span class="material-symbols-outlined text-primary" data-icon="info">info</span>
                                <h2
                                    class="text-slate-700 dark:text-slate-200 text-sm font-semibold uppercase tracking-wider">
                                    Information de sécurité</h2>
                            </div>
                            <p
                                class="text-slate-600 dark:text-slate-300 text-base font-normal leading-relaxed text-center">
                                Voulez-vous mettre ce profil en sommeil ? L'utilisateur sera déconnecté et ses activités
                                suspendues immédiatement.
                            </p>
                        </div>
                        <!-- Modal Footer Actions -->
                        <div class="px-8 pb-8 pt-4 flex flex-col gap-3">
                            <form action="" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="flex items-center justify-center rounded-lg h-12 px-5 bg-primary hover:bg-primary/90 text-white text-base font-bold transition-colors w-full shadow-lg shadow-primary/20">
                                    <span class="truncate">Désactiver</span>
                                </button>
                            </form>
                            <button onclick="closeDeactivateModal()"
                                class="flex items-center justify-center rounded-lg h-12 px-5 bg-transparent border border-slate-200 dark:border-primary/20 hover:bg-slate-50 dark:hover:bg-primary/10 text-slate-700 dark:text-slate-200 text-base font-bold transition-colors w-full">
                                <span class="truncate">Annuler</span>
                            </button>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        function showDeactivateModal(id) {
            const modal = document.getElementById('deactivate-user-modal');
            const form = modal.querySelector('form');
            form.action = "{{ route('admin.deactivate', ':id') }}".replace(':id', id);
            modal.classList.remove('hidden');
        }

        function closeDeactivateModal() {
            const modal = document.getElementById('deactivate-user-modal');
            const form = modal.querySelector('form');
            form.action = "";
            modal.classList.add('hidden');
        }
    </script>

    <div id="activate-user-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <main class="flex-1 flex items-center justify-center p-4 bg-slate-950/40">
            <div class="max-w-[480px] w-full bg-surface-dark border border-border-dark rounded-xl shadow-2xl overflow-hidden">
                <!-- Top Visual Section -->
                <div class="relative h-32 bg-gradient-to-b from-primary/20 to-surface-dark flex items-center justify-center">
                    <div class="absolute inset-0 opacity-20" data-alt="Subtle red dot pattern background"
                        style="background-image: radial-gradient(circle at 2px 2px, #c72929 1px, transparent 0); background-size: 24px 24px;">
                    </div>
                    <div
                        class="relative size-20 rounded-full bg-surface-dark border-4 border-accent/50 flex items-center justify-center shadow-[0_0_20px_rgba(212,175,55,0.3)]">
                        <span class="material-symbols-outlined text-accent text-5xl font-bold animate-pulse"
                            style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                    </div>
                </div>
                <!-- Modal Body -->
                <div class="p-8 text-center">
                    <h2 class="text-slate-100 text-2xl md:text-3xl font-bold leading-tight mb-4">Réactivation du Profil
                    </h2>
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="size-24 rounded-full border-2 border-border-dark p-1">
                                <img alt="Avatar"
                                    class="w-full h-full rounded-full object-cover grayscale brightness-75 border border-border-dark"
                                    data-alt="Portrait of a sailor with a beard"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuB9iAWP9teyvlegK-QZJXRU2TPoQBZOMNWftSUWtwPS-Vc1bKr8n4ZHkTpzu_XKibDpBmiA1vHZzpO0bzs_Ehqvkx0OP-e-MylMcl9ign82JzpIzhA4ujr_MOusgkEHZbaDeei70msOKIgDhpMVWDA5U2jre7K_zr4CJPTp3Os1NLjkrf3Zpc_DV6EPMio-zydF5mEQHyGIR4uzKIMi4RJTwD4fej7X8BTkOy2DhlKr_gmJeGXMhvy3bY5N8bZo4CemTxqh8YXj4_Q" />
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 size-8 bg-background-dark rounded-full border-2 border-border-dark flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary text-sm">anchor</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-slate-400 text-base font-normal leading-relaxed mb-8">
                        Prêt à réveiller ce matelot ? <br />
                        <span class="text-slate-200">Le profil sera à nouveau opérationnel sur la plateforme Marine
                            HQ.</span>
                    </p>
                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-3">
                        <form action="" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="flex w-full items-center justify-center rounded-lg h-12 px-5 bg-accent text-background-dark text-base font-bold leading-normal tracking-wide hover:brightness-110 active:scale-[0.98] transition-all shadow-lg shadow-accent/10">
                                <span class="material-symbols-outlined mr-2">bolt</span>
                                Réactiver
                            </button>
                        </form>
                        <button onclick="closeActivateModal()"
                            class="flex w-full items-center justify-center rounded-lg h-12 px-5 bg-transparent border border-border-dark text-slate-400 text-base font-bold leading-normal tracking-wide hover:bg-border-dark hover:text-slate-100 transition-all">
                            Annuler
                        </button>
                    </div>
                </div>
                <!-- Footer Decoration -->
                <div class="px-8 pb-4">
                    <div class="flex items-center justify-center gap-2 opacity-30">
                        <div class="h-[1px] flex-1 bg-border-dark"></div>
                        <span class="material-symbols-outlined text-xs text-slate-500">waves</span>
                        <div class="h-[1px] flex-1 bg-border-dark"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function showActivateModal(id) {
            const modal = document.getElementById('activate-user-modal');
            const form = modal.querySelector('form');
            form.action = "{{ route('admin.activate', ':id') }}".replace(':id', id);
            modal.classList.remove('hidden');
        }

        function closeActivateModal() {
            const modal = document.getElementById('activate-user-modal');
            const form = modal.querySelector('form');
            form.action = "";
            modal.classList.add('hidden');
        }
    </script>

@endsection
