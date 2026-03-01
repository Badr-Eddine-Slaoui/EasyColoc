@extends('layouts.app')

@section('title', 'EasyColoc - Colocation Members')

@section('content')
    @php
        $is_owner = auth()->user()->id == $colocation->owner->user_id;
    @endphp
    <main class="flex-1 max-w-7xl mx-auto w-full px-6 md:px-10 py-8 relative z-10">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-sm font-medium mb-8">
            <a class="text-slate-500 hover:text-primary transition-colors" href="{{ route('dashboard') }}">Dashboard</a>
            <span class="material-symbols-outlined text-xs text-slate-600">chevron_right</span>
            <a class="text-slate-500 hover:text-primary transition-colors"
                href="{{ route('colocation.show', $colocation->id) }}">Colocation</a>
            <span class="material-symbols-outlined text-xs text-slate-600">chevron_right</span>
            <span class="text-primary uppercase tracking-wider">Membres</span>
        </nav>
        @if (!$is_active)
            <div
                class="my-5 p-4 rounded-xl bg-slate-100 dark:bg-slate-800/30 border border-slate-200 dark:border-slate-800">
                <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                    Colocation non active</p>
            </div>
        @endif
        <!-- Hero Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="max-w-2xl">
                <h1 class="text-white text-5xl font-black leading-tight tracking-tighter mb-4 uppercase italic">
                    L'ÉQUIPAGE DU <span class="text-primary">NAVIRE</span>
                </h1>
                <p class="text-slate-400 text-lg leading-relaxed">
                    Gérez les membres de votre colocation, surveillez les bourses et maintenez l'honneur de
                    l'équipage au plus haut.
                </p>
            </div>
            @if ($is_owner)
                <button @disabled(!$is_active) onclick="showAddInvitationModal()"
                    class="flex items-center justify-center gap-2 bg-primary hover:bg-primary/80 text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-primary/20 transition-all transform hover:-translate-y-1 active:scale-95">
                    <span class="material-symbols-outlined">person_add</span>
                    <span>Ajouter un Membre</span>
                </button>
            @endif
        </div>
        <!-- Members Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
            @foreach ($members as $member)
                <div
                    class="bg-card-dark border border-slate-800 rounded-xl p-6 relative overflow-hidden group hover:border-primary/50 transition-all shadow-xl">
                    @if ($member->role == 'Owner')
                        <div class="absolute top-0 right-0 p-4">
                            <span
                                class="text-[10px] font-bold tracking-widest bg-primary/20 text-primary px-2 py-1 rounded border border-primary/30 uppercase">Owner</span>
                        </div>
                    @elseif ($member->role == 'Member')
                        <div class="absolute top-0 right-0 p-4">
                            <span
                                class="text-[10px] font-bold tracking-widest bg-slate-800 text-slate-400 px-2 py-1 rounded border border-slate-700 uppercase">Member</span>
                        </div>
                    @endif
                    <div class="flex flex-col items-center text-center">
                        <div class="relative mb-4">
                            <div
                                class="size-24 rounded-full border-4 border-slate-700 p-1 bg-background-dark shadow-inner group-hover:border-primary/30 transition-colors">
                                <img class="rounded-full w-full h-full object-cover"
                                    data-alt="Portrait of Nami the Navigator"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuBSc0HZzmE6dxrGLQ6FOLOiolD-A1sXsvhUYir4SgFFBj5-Kb741N5QebeIxXpLlKPXKI97c6ivLyUmUE-MrOjjTB0S6owCmoeVDRcF2FCmjIafzdcd_8hvttC03lMdS-8Z6_ifbnc0muCFALDWZgrid0wEp2AiSgy1UckTiVC0VVYigWGJSzQW4vRiETPzRErTvghnL6OzxkB-C8zsF_Fnpgw3AbQ6MpEaOijpJM4nUbq-XKwpJIqeH3qGgs6C694e6Qqgl4o24" />
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1">{{ $member->user->name }}</h3>
                        <p class="text-primary font-black text-xs tracking-widest uppercase mb-4">{{ $member->user->role }}
                        </p>
                        <div class="w-full grid grid-cols-2 gap-4 mt-2 border-t border-slate-800 pt-4">
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-bold mb-1">Reputation</p>
                                <div class="flex items-center justify-center gap-1 text-accent-gold font-black">
                                    <span class="material-symbols-outlined text-sm">stars</span>
                                    <span>{{ $member->user->reputation }}</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-bold mb-1">Solde</p>
                                <p
                                    class="@if ($member->sold >= 0) text-green-500 @else text-primary @endif font-black">
                                    {{ $member->sold }}€</p>
                            </div>
                        </div>
                    </div>
                    @if ($member->role == 'Member' && $is_owner)
                        <div class="mt-6 pt-4 border-t border-slate-800">
                            <button @disabled(!$is_active) onclick="showRemoveMemberModal({{ $colocation->id }}, {{ $member->id }})"
                                class="w-full flex items-center justify-center gap-2 text-primary hover:text-white hover:bg-primary/10 py-2 px-4 rounded-lg border border-primary/20 transition-all text-xs font-bold uppercase tracking-widest">
                                <span class="material-symbols-outlined text-sm">delete</span>
                                <span>Retirer le membre</span>
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </main>
@endsection

@section('modals')
    @php
        $is_there_add_invitation_errors = $errors->addInvitation->any();
    @endphp
    <div id="invite-member-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-overlay @if (!$is_there_add_invitation_errors) hidden @endif">
        <!-- Modal Card -->
        <form action="{{ route('invite.invite', $colocation->id) }}" method="POST"
            class="relative w-full max-w-lg parchment-texture border-2 border-primary/30 rounded-xl shadow-2xl overflow-hidden">
            @csrf
            <!-- Gold Accent Corner -->
            <div class="absolute top-0 right-0 w-16 h-16 pointer-events-none">
                <div class="absolute top-0 right-0 border-t-4 border-r-4 border-accent-gold/40 w-8 h-8 m-2 rounded-tr-lg">
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-16 h-16 pointer-events-none">
                <div class="absolute bottom-0 left-0 border-b-4 border-l-4 border-accent-gold/40 w-8 h-8 m-2 rounded-bl-lg">
                </div>
            </div>
            <!-- Header Section -->
            <div class="p-8 pb-4">
                <div class="flex items-center gap-4 mb-2">
                    <div class="p-3 bg-primary/20 rounded-lg text-primary">
                        <span class="material-symbols-outlined text-3xl">groups_3</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-100 tracking-tight">Recruter un nouveau Matelot</h2>
                        <p class="text-primary/70 text-sm font-medium uppercase tracking-widest">Agrandissez votre
                            équipage</p>
                    </div>
                </div>
                <div class="h-px w-full bg-gradient-to-r from-transparent via-primary/30 to-transparent mt-4"></div>
            </div>
            <!-- Form Content -->
            <div class="px-8 py-4 space-y-6">
                <!-- Email Field -->
                <div class="flex flex-col gap-2">
                    <label class="text-slate-300 text-sm font-semibold uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-lg">alternate_email</span>
                        Email du nouveau membre
                    </label>
                    <div class="relative group">
                        <input name="email" value="{{ old('email') }}"
                            class="w-full bg-navy-deep/50 border border-primary/20 focus:border-primary focus:ring-1 focus:ring-primary rounded-lg px-4 py-3.5 text-slate-100 placeholder-slate-500 transition-all outline-none"
                            placeholder="pirate@grandline.com" type="email" />
                        <div
                            class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-500 group-focus-within:text-primary">
                            <span class="material-symbols-outlined">send</span>
                        </div>
                    </div>
                    @error('email', 'addInvitation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Message Field -->
                <div class="flex flex-col gap-2">
                    <label class="text-slate-300 text-sm font-semibold uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-lg">chat_bubble</span>
                        Message de bienvenue
                    </label>
                    <textarea name="message"
                        class="w-full bg-navy-deep/50 border border-primary/20 focus:border-primary focus:ring-1 focus:ring-primary rounded-lg px-4 py-3.5 text-slate-100 placeholder-slate-500 transition-all outline-none min-h-[140px] resize-none"
                        placeholder="Bienvenue à bord, nakama ! Prêt pour la colocation ?">{{ old('message') }}</textarea>
                    <p class="text-[10px] text-slate-500 italic text-right">Personnalisez votre invitation pour plus de
                        chance de réponse !</p>
                    @error('message', 'addInvitation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Footer Buttons -->
            <div class="p-8 pt-4 flex items-center justify-end gap-4">
                <button onclick="closeAddInvitationModal()" type="button"
                    class="px-6 py-3 rounded-lg text-slate-400 hover:text-slate-100 hover:bg-slate-800 transition-colors font-bold text-sm uppercase tracking-widest">
                    Annuler
                </button>
                <button type="submit"
                    class="relative group px-8 py-3 bg-primary hover:bg-primary/90 rounded-lg text-white font-bold text-sm uppercase tracking-widest shadow-lg shadow-primary/20 transition-transform active:scale-95 flex items-center gap-2 overflow-hidden">
                    <span class="relative z-10">Envoyer l'invitation</span>
                    <span class="material-symbols-outlined relative z-10 text-lg">rocket_launch</span>
                    <!-- Button Glow Effect -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700">
                    </div>
                </button>
            </div>
            <!-- Bottom Decorative Bar -->
            <div class="h-1.5 w-full bg-gradient-to-r from-accent-gold via-primary to-accent-gold opacity-50"></div>
        </form>
    </div>

    <script>
        function showAddInvitationModal() {
            const modal = document.getElementById('invite-member-modal');
            modal.classList.remove('hidden');
        }

        function closeAddInvitationModal() {
            const modal = document.getElementById('invite-member-modal');
            const form = modal.querySelector('form');
            form.reset();
            modal.classList.add('hidden');
        }
    </script>

    <div id="remove-member-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div class="relative flex h-screen w-full flex-col overflow-x-hidden nautical-texture">
            <div class="layout-container flex h-full grow flex-col">
                <!-- Header Section -->
                <header
                    class="flex items-center justify-between border-b border-primary/20 px-6 py-4 lg:px-40 bg-background-dark/80 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="text-primary">
                            <span class="material-symbols-outlined text-3xl">sailing</span>
                        </div>
                        <h2 class="text-slate-100 text-xl font-bold tracking-tight">Équipage</h2>
                    </div>
                    <button
                        class="flex items-center justify-center rounded-lg h-10 w-10 bg-neutral-muted text-accent-gold gold-border hover:bg-neutral-muted/80 transition-colors">
                        <span class="material-symbols-outlined">anchor</span>
                    </button>
                </header>
                <!-- Main Content / Modal Simulation -->
                <main class="flex-1 flex items-center justify-center p-4">
                    <div
                        class="max-w-[520px] w-full bg-neutral-muted/40 rounded-xl border border-primary/30 p-8 shadow-2xl backdrop-blur-md">
                        <!-- Icon Header -->
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div class="absolute -inset-4 bg-primary/20 rounded-full blur-xl"></div>
                                <div
                                    class="relative bg-background-dark rounded-full p-6 border-2 border-primary shadow-[0_0_20px_rgba(199,41,41,0.4)]">
                                    <span class="material-symbols-outlined text-5xl text-primary">skull</span>
                                </div>
                            </div>
                        </div>
                        <!-- Title -->
                        <h1 class="text-slate-100 text-3xl font-bold leading-tight text-center mb-4">
                            Jeter par-dessus bord ?
                        </h1>
                        <!-- Visual Representation -->
                        <div class="w-full mb-6 rounded-lg overflow-hidden border border-primary/20">
                            <div class="w-full aspect-video bg-center bg-no-repeat bg-cover flex items-end p-4 bg-gradient-to-t from-black/80 to-transparent"
                                data-alt="Stormy sea with a wooden pirate ship deck"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAg6za4z9PZ7Yl0PzNRYPz-TzHQYks-kPHYISRxEfgRTI0zGKYOjWxQ2A4OhILlIV7Ad7z-RwqHAnPHZORdzYc6zDEI-jBDDnx8Qlt7iMIJiIumlrVN9oWLE4qDL-ynWwPeQQ7zMIQ5snVOlvT9FXCnleHpij0tZXbhbX7moSalaEjL5nrmGIf4XOHljhWj1YwLrtFnK2bvVqHYedAuLjlb1EDS4duOIK8v52siTNs1lHuT72NL-TUToc7JC6FL5aM8ZmUH8WV0vnQ");'>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-accent-gold">warning</span>
                                    <span class="text-xs font-semibold uppercase tracking-widest text-accent-gold">Zone de
                                        Danger</span>
                                </div>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="space-y-4 text-center mb-8 px-2">
                            <p class="text-slate-300 text-base leading-relaxed">
                                Attention ! Cette action est irréversible. Êtes-vous sûr de vouloir retirer ce membre de
                                l'équipage ?
                            </p>
                            <p class="text-slate-400 text-sm italic border-t border-primary/10 pt-4">
                                Ses dettes et contributions resteront enregistrées dans le journal de bord permanent.
                            </p>
                        </div>
                        <!-- Actions -->
                        <div class="flex flex-col gap-3">
                            <form class="w-full" action="" method="post">
                                @csrf
                                <button
                                    class="w-full group flex items-center justify-center gap-2 rounded-lg h-14 bg-primary hover:bg-primary/90 text-white text-lg font-bold transition-all shadow-lg active:scale-95">
                                    <span
                                        class="material-symbols-outlined group-hover:rotate-12 transition-transform">directions_walk</span>
                                    <span>Confirmer l'expulsion</span>
                                </button>
                            </form>
                            <button onclick="closeRemoveMemberModal()"
                                class="flex items-center justify-center gap-2 rounded-lg h-12 bg-neutral-muted hover:bg-neutral-muted/80 text-slate-100 text-base font-semibold border border-white/5 transition-all">
                                <span>Garder à bord</span>
                            </button>
                        </div>
                        <!-- Small Pirate Accent -->
                        <div class="mt-6 flex justify-center gap-1">
                            <div class="h-1 w-8 rounded-full bg-primary/30"></div>
                            <div class="h-1 w-2 rounded-full bg-accent-gold"></div>
                            <div class="h-1 w-8 rounded-full bg-primary/30"></div>
                        </div>
                    </div>
                </main>
                <!-- Footer Decorative -->
                <footer class="p-6 text-center opacity-30">
                    <p class="text-xs uppercase tracking-[0.2em] text-accent-gold">Pirate Code Section 4.2 - Mutiny</p>
                </footer>
            </div>
        </div>
    </div>

    <script>
        function showRemoveMemberModal(id, memberId) {
            const modal = document.getElementById('remove-member-modal');
            const form = modal.querySelector('form');
            form.action = "{{ route('colocation.removeMember', [':id', ':memberId']) }}".replace(':id', id).replace(':memberId', memberId);
            modal.classList.remove('hidden');
        }

        function closeRemoveMemberModal() {
            const modal = document.getElementById('remove-member-modal');
            const form = modal.querySelector('form');
            form.action = "";
            modal.classList.add('hidden');
        }
    </script>
@endsection
