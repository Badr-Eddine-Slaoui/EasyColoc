@extends('layouts.app')

@section('title', 'EasyColoc - Active Colocation')

@section('content')
    @php
        $is_owner = auth()->user()->id == $colocation->owner->user_id;
    @endphp
    <main class="max-w-5xl mx-auto w-full px-6 py-8 flex flex-col gap-8">
        <!-- Header: Summary Section -->
        <section class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div class="space-y-1">
                <h1
                    class="text-4xl font-black tracking-tighter text-slate-900 dark:text-slate-100 uppercase italic border-l-4 border-primary pl-4">
                    {{ $colocation->name }}</h1>
                <p class="text-slate-500 dark:text-slate-400 font-medium">Tableau de bord de la colocation</p>
            </div>
            <div class="flex gap-4 w-full md:w-auto">
                <div
                    class="flex-1 md:min-w-[180px] p-5 rounded-xl bg-slate-100 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700">
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">
                        Dépenses (Mois)</p>
                    <p class="text-2xl font-black text-slate-900 dark:text-slate-100">{{ $total_amount }}€</p>
                </div>
                <div class="flex-1 md:min-w-[180px] p-5 rounded-xl bg-primary/10 border border-primary/20">
                    <p class="text-xs font-bold text-primary uppercase tracking-wider mb-1">Votre Solde</p>
                    <p
                        class="text-2xl font-black @if ($sold >= 0) text-green-500 @else text-primary @endif">
                        {{ $sold }}€</p>
                </div>
            </div>
        </section>
        <!-- Action Bar -->
        <section
            class="flex flex-wrap items-center justify-between gap-4 p-4 rounded-xl bg-slate-100 dark:bg-slate-800/30 border border-slate-200 dark:border-slate-800">
            <div class="flex gap-3 flex-wrap">
                <button onclick="showAddExpenseModal()"
                    class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-bold rounded-lg hover:brightness-110 transition-all shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Ajouter une dépense
                </button>
                <!-- Owner Only Action -->
                @if ($is_owner)
                    <button onclick="showAddInvitationModal()"
                        class="flex items-center gap-2 px-5 py-2.5 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold rounded-lg hover:bg-accent-gold hover:text-slate-900 transition-all">
                        <span class="material-symbols-outlined text-sm">person_add</span>
                        Recruter un membre
                    </button>
                    <a href="{{ route('colocation.category.index', $colocation->id) }}"
                        class="flex items-center gap-2 px-5 py-2.5 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold rounded-lg hover:bg-accent-gold hover:text-slate-900 transition-all">
                        <span class="material-symbols-outlined text-sm">category</span>
                        Gérer les catégories
                    </a>
                @endif
            </div>
            <a href="{{ route('colocation.members', $colocation->id) }}"
                class="text-sm font-bold text-primary hover:underline underline-offset-4 flex items-center gap-1">
                Voir tous les membres <span class="material-symbols-outlined text-xs">arrow_forward</span>
            </a>
        </section>
        <!-- Filter & Table Section -->
        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-accent-gold">receipt_long</span>
                    Historique des dépenses
                </h3>
                <div class="relative">
                    <form action="" method="get" onchange="this.submit()">
                        <input type="month" name="month-year" value="{{ request('month-year') }}"
                            class="custom-select w-full rounded-xl border border-primary/20 bg-white px-4 py-3 pr-10 text-sm font-medium focus:border-accent-gold focus:ring-accent-gold dark:bg-slate-900 dark:text-slate-100"
                            id="month-select" />
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto rounded-xl border border-slate-200 dark:border-slate-800">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-100 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-xs uppercase font-black tracking-widest">
                            <th class="px-6 py-4">Titre</th>
                            <th class="px-6 py-4">Catégorie</th>
                            <th class="px-6 py-4">Montant</th>
                            <th class="px-6 py-4">Créateur</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse ($expenses as $expense)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                                <td class="px-6 py-4 font-bold">{{ $expense->title }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 text-[10px] font-black uppercase">{{ $expense->category->name }}</span>
                                </td>
                                <td
                                    class="px-6 py-4 font-bold @if ($expense->creator->user_id == auth()->id()) text-accent-gold @else text-primary @endif">
                                    {{ $expense->amount }}€</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-slate-300 dark:bg-slate-700 overflow-hidden">
                                            <img alt="" data-alt="Cartoon avatar of a young man with a straw hat"
                                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCBOX_W5FFcinG-0HrSMrOWbLMQpgFIPOD1avCS684cy6XAhnx08W7QdF-BXRS_nfBxVq_sdlGiFNlofjSiXXLhtHvt9Qz94hDzVm3_nY3kRPXe0nTswrtt3-gX9Jtze1Z_GlqB_BW9Tk9Xu3iyBe8aLAA2MfQ0CrDc8ZwToDHYva6gfdh-2c6JD54m3mTPVKwkF1cEIabm0E_jopCyJoSzAPWYxke9LDohQ1KQ1A9XmiQh2CD3J6dxWpi4kW81Eu22eptbG7jLY0o" />
                                        </div>
                                        <span class="text-sm">{{ $expense->creator->user->name }} @if ($expense->creator->user_id == auth()->id())
                                                (Moi)
                                            @endif
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if ($expense->creator->user_id == auth()->id())
                                        <div class="flex justify-end gap-2">
                                            <button
                                                onclick='showExpenseDetailsModal({{ auth()->id() }}, @json($expense->details), {{ $expense->details->count() }}, "{{ $expense->title }}", "{{ $expense->amount }}", "{{ $expense->category->name }}")'
                                                class="p-1.5 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg text-slate-500 hover:text-primary transition-colors">
                                                <span class="material-symbols-outlined text-lg">visibility</span>
                                            </button>
                                            <button
                                                onclick="showEditExpenseModal({{ $expense->id }}, '{{ $expense->title }}', {{ $expense->category_id }}, {{ $expense->amount }})"
                                                class="p-1.5 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg text-slate-500 hover:text-primary transition-colors">
                                                <span class="material-symbols-outlined text-lg">edit</span>
                                            </button>
                                            <button
                                                onclick="showDeleteExpenseModal({{ $expense->id }}, '{{ $expense->title }}', '{{ $expense->amount }}', '{{ $expense->category->name }}')"
                                                class="p-1.5 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg text-slate-500 hover:text-primary transition-colors">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">Aucune expense pour ce mois</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        <!-- Balance Details: Qui doit combien -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <h3 class="text-xl font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">balance</span>
                    Qui doit combien ?
                </h3>
                <div class="space-y-3">
                    @forelse ($colocation->members as $member)
                        @if ($member->owed > 0)
                            <!-- Owed to user -->
                            <div
                                class="flex items-center justify-between p-4 rounded-xl bg-green-500/5 border border-green-500/20">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center text-green-600">
                                        <span class="material-symbols-outlined">arrow_downward</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold">{{ $member->user->name }}</p>
                                        <p class="text-xs text-slate-500">Tu lui dois</p>
                                    </div>
                                </div>
                                <span class="font-black text-green-600">+{{ $member->owed }}€</span>
                            </div>
                        @elseif($member->owed < 0)
                            <!-- User owes -->
                            <div
                                class="flex items-center justify-between p-4 rounded-xl bg-primary/5 border border-primary/20">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined">arrow_upward</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold">{{ $member->user->name }}</p>
                                        <p class="text-xs text-slate-500">Il vous doit</p>
                                    </div>
                                </div>
                                <span class="font-black text-primary">-{{ abs($member->owed) }}€</span>
                            </div>
                        @else
                            <div
                                class="flex items-center justify-between p-4 rounded-xl bg-primary/5 border border-primary/20">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined">arrow_upward</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold">{{ $member->user->name }}</p>

                                        <p class="text-xs text-slate-500">Aucune dette</p>
                                    </div>
                                </div>
                                <span class="font-black text-primary">0€</span>
                            </div>
                        @endif
                    @empty
                        <div
                            class="flex items-center justify-between p-4 rounded-xl bg-primary/5 border border-primary/20">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">arrow_upward</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Aucun membre</p>
                                </div>
                            </div>
                            <span class="font-black text-primary">0€</span>
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- Management Section -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-400">settings</span>
                    Gestion de l'équipage
                </h3>
                @if ($is_owner)
                    <div class="p-6 rounded-xl border border-primary/20 bg-primary/5 flex flex-col gap-4">
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                            En tant que <span class="text-primary font-bold">Capitaine</span>, vous avez le pouvoir de
                            dissoudre cette colocation. Attention, cette action est irréversible.
                        </p>
                        <div class="pt-2 border-t border-primary/10">
                            <button onclick="showDisactivateModal({{ $colocation->id }})"
                                class="w-full flex items-center justify-center gap-2 py-3 bg-primary/10 hover:bg-primary text-primary hover:text-white font-black uppercase text-sm tracking-widest rounded-lg transition-all border border-primary/30">
                                <span class="material-symbols-outlined">cancel</span>
                                Annuler la colocation
                            </button>
                        </div>
                    </div>
                @else
                    <div class="p-6 rounded-xl border border-primary/20 bg-primary/5 flex flex-col gap-4">
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">En tant que <span
                                class="text-primary font-bold">Membre</span>, vous pouvez quitter cette colocation à tout
                            moment. Assurez-vous d'avoir soldé vos comptes avant de partir.</p>
                        <div class="pt-2 border-t border-primary/10">
                            <button onclick="showLeaveModal({{ $colocation->id }})"
                                class="w-full flex items-center justify-center gap-2 py-3 bg-red-600 hover:bg-red-700 text-white font-black uppercase text-sm tracking-widest rounded-lg transition-all border border-red-700 shadow-lg shadow-red-500/20">
                                <span class="material-symbols-outlined">logout</span> QUITTER LA COLOCATION </button>
                        </div>
                    </div>
                @endif
            </div>
        </section>
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
                <div
                    class="absolute bottom-0 left-0 border-b-4 border-l-4 border-accent-gold/40 w-8 h-8 m-2 rounded-bl-lg">
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

    @php
        $is_there_add_expense_errors = $errors->addExpense->any();
    @endphp
    <div id="add-expense-modal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 @if (!$is_there_add_expense_errors) hidden @endif">
        <!-- Modal Container -->
        <div
            class="relative w-full max-w-lg nautical-gradient border border-slate-700/50 rounded-xl shadow-2xl overflow-hidden">
            <!-- Nautical Accent Header -->
            <div class="h-2 bg-primary w-full"></div>
            <div class="p-8">
                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div class="bg-primary/20 p-2 rounded-lg">
                            <span class="material-symbols-outlined text-primary text-3xl">payments</span>
                        </div>
                        <h2 class="text-2xl font-bold tracking-tight text-slate-100 uppercase">Nouvelle Dépense</h2>
                    </div>
                    <button onclick="closeAddExpenseModal()" class="text-slate-400 hover:text-white transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <!-- Form -->
                <form action="{{ route('expense.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Title -->
                    <div class="space-y-2">
                        <label
                            class="text-xs font-semibold uppercase tracking-widest text-slate-400 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">label</span> Titre
                        </label>
                        <input name="title" value="{{ old('title') }}"
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-lg py-3 px-4 text-slate-100 placeholder:text-slate-500 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                            placeholder="Ex: Courses hebdomadaires" type="text" />
                        @error('title', 'addExpense')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Category -->
                        <div class="space-y-2">
                            <label
                                class="text-xs font-semibold uppercase tracking-widest text-slate-400 flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">category</span> Catégorie
                            </label>
                            <select name="category_id"
                                class="form-select-icon w-full bg-slate-800/50 border border-slate-700 rounded-lg py-3 px-4 text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none">
                                <option disabled="" selected="" value="">Choisir Catégorie...</option>
                                @foreach ($colocation->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Amount -->
                        <div class="space-y-2">
                            <label
                                class="text-xs font-semibold uppercase tracking-widest text-slate-400 flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">euro</span> Montant
                            </label>
                            <div class="relative">
                                <input name="amount" value="{{ old('amount') }}"
                                    class="w-full bg-slate-800/50 border border-slate-700 rounded-lg py-3 px-4 text-slate-100 placeholder:text-slate-500 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                    placeholder="0.00" step="0.01" type="number" />
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500">€</span>
                            </div>
                            @error('amount', 'addExpense')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Actions -->
                    <div class="flex items-center gap-4 pt-6">
                        <button onclick="closeAddExpenseModal()"
                            class="flex-1 py-3 px-4 rounded-lg border border-slate-700 text-slate-300 font-medium hover:bg-slate-800 transition-colors"
                            type="button">
                            Annuler
                        </button>
                        <button
                            class="flex-1 py-3 px-4 rounded-lg bg-accent-gold hover:bg-[#c19b2e] text-slate-900 font-bold uppercase tracking-wider transition-all shadow-lg shadow-accent-gold/20 flex items-center justify-center gap-2"
                            type="submit">
                            <span class="material-symbols-outlined font-bold">anchor</span>
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showAddExpenseModal() {
            const modal = document.getElementById('add-expense-modal');
            modal.classList.remove('hidden');
        }

        function closeAddExpenseModal() {
            const modal = document.getElementById('add-expense-modal');
            const form = modal.querySelector('form');
            form.reset();
            modal.classList.add('hidden');
        }
    </script>

    @php
        $is_there_edit_expense_errors = $errors->editExpense->any();
    @endphp
    <div id="edit-expense-modal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 @if (!$is_there_edit_expense_errors) hidden @endif">
        <!-- Modal Container -->
        <div
            class="relative w-full max-w-lg overflow-hidden rounded-xl border border-primary/20 bg-background-light dark:bg-background-dark shadow-2xl shadow-black/50">
            <!-- Header -->
            <header class="flex items-center justify-between border-b border-primary/20 px-6 py-4 bg-primary/5">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center size-10 rounded-full bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-2xl">edit_square</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100">Modifier la Dépense
                        </h2>
                        <p class="text-xs uppercase tracking-widest text-primary/70 font-semibold">Révision de l'entrée</p>
                    </div>
                </div>
                <button onclick="closeEditExpenseModal()"
                    class="flex items-center justify-center size-10 rounded-full hover:bg-primary/10 text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </header>
            <!-- Form Content -->
            <form action="" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')
                <!-- Title Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Titre de la
                        dépense</label>
                    <div class="relative group">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary/50 group-focus-within:text-primary transition-colors">label</span>
                        <input name="title"
                            class="w-full pl-12 pr-4 py-3.5 rounded-lg border border-primary/20 bg-white dark:bg-primary/5 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all"
                            placeholder="Ex: Fournitures de bureau" type="text" value="{{ old('title') }}" />
                    </div>
                    @error('title', 'editExpense')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Category Field -->
                    <div class="space-y-2">
                        <label
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Catégorie</label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary/50 group-focus-within:text-primary transition-colors">category</span>
                            <select name="category_id"
                                class="form-select-icon w-full bg-slate-800/50 border border-slate-700 rounded-lg py-3 px-4 text-slate-100 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none">
                                <option disabled="" selected="" value="">Choisir Catégorie...</option>
                                @foreach ($colocation->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id', 'editExpense')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Amount Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Montant</label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary/50 group-focus-within:text-primary transition-colors">euro_symbol</span>
                            <input name="amount"
                                class="w-full pl-12 pr-4 py-3.5 rounded-lg border border-primary/20 bg-white dark:bg-primary/5 text-slate-900 dark:text-slate-100 font-bold focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all"
                                type="text" value="{{ old('amount') }}" />
                        </div>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex flex-col-reverse sm:flex-row gap-3 pt-4 border-t border-primary/10">
                    <button onclick="closeEditExpenseModal()"
                        class="flex-1 px-6 py-3.5 rounded-lg border border-primary/30 text-primary font-bold hover:bg-primary/10 transition-colors uppercase tracking-wider text-sm"
                        type="button">
                        Anuller
                    </button>
                    <button
                        class="flex-[2] px-6 py-3.5 rounded-lg bg-accent-gold text-background-dark font-extrabold shadow-lg shadow-accent-gold/20 hover:bg-[#c29d2d] transition-colors uppercase tracking-wider text-sm flex items-center justify-center gap-2"
                        type="submit">
                        <span class="material-symbols-outlined text-xl">save</span>
                        Sauvegarder les modifications
                    </button>
                </div>
            </form>
            <!-- Visual Accent Footer -->
            <div class="h-1.5 w-full bg-gradient-to-r from-primary via-accent-gold to-primary"></div>
        </div>
    </div>

    <script>
        function showEditExpenseModal(id, title, category_id, amount) {
            const modal = document.getElementById('edit-expense-modal');
            const form = modal.querySelector('form');
            form.action = "{{ route('expense.update', ':id') }}".replace(':id', id);
            form.querySelector('input[name="title"]').value = title;
            form.querySelector('select[name="category_id"]').value = category_id;
            form.querySelector('input[name="amount"]').value = amount;
            modal.classList.remove('hidden');
        }

        function closeEditExpenseModal() {
            const modal = document.getElementById('edit-expense-modal');
            const form = modal.querySelector('form');
            form.reset();
            form.action = "";
            modal.classList.add('hidden');
        }
    </script>

    <div id="delete-expense-modal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="relative flex min-h-screen w-full flex-col items-center justify-center overflow-x-hidden p-4">
            <!-- Modal Container -->
            <div
                class="relative z-10 w-full max-w-[480px] bg-background-light dark:bg-[#2d1a1a] rounded-xl shadow-2xl border border-primary/10 overflow-hidden">
                <!-- Header/Icon -->
                <div class="flex flex-col items-center pt-8 pb-2">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary mb-4">
                        <span class="material-symbols-outlined text-4xl">delete_forever</span>
                    </div>
                </div>
                <!-- Content -->
                <div class="px-6 pb-6 text-center">
                    <h1 class="text-slate-900 dark:text-slate-100 text-2xl font-bold leading-tight tracking-tight mb-3">
                        Supprimer du Logbook ?
                    </h1>
                    <p class="text-slate-600 dark:text-slate-300 text-base font-normal leading-relaxed">
                        Êtes-vous sûr de vouloir supprimer cette dépense ? Cette action est irréversible.
                    </p>
                </div>
                <!-- Expense Summary Card (Contextual helper) -->
                <div
                    class="mx-6 mb-8 p-4 bg-background-light/50 dark:bg-background-dark/50 rounded-lg border border-primary/5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary/20 rounded-lg text-primary">
                            <span class="material-symbols-outlined">receipt_long</span>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-semibold text-slate-900 dark:text-slate-100 title"></p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 category"></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-primary amount"></p>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 px-6 pb-8">
                    <button onclick="closeDeleteExpenseModal()"
                        class="flex-1 flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-slate-200 dark:bg-[#432828] text-slate-900 dark:text-white text-sm font-bold transition-colors hover:bg-slate-300 dark:hover:bg-[#5a3636]">
                        <span>Annuler</span>
                    </button>
                    <form action="" method="post">
                        @csrf
                        @method('DELETE')
                        <button
                            class="flex-1 flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-sm font-bold shadow-lg shadow-primary/20 transition-all hover:brightness-110 active:scale-95">
                            <span>Supprimer</span>
                        </button>
                    </form>
                </div>
            </div>
            <!-- Secondary Info -->
            <div class="relative z-10 mt-6 text-center">
                <p class="text-slate-500 dark:text-slate-400 text-xs">
                    Logbook Manager • Version 2.4.0
                </p>
            </div>
        </div>
    </div>

    <script>
        function showDeleteExpenseModal(id, title, amount, category) {
            const modal = document.getElementById('delete-expense-modal');
            const form = modal.querySelector('form');
            form.action = "{{ route('expense.destroy', ':id') }}".replace(':id', id);
            modal.querySelector('.title').textContent = title;
            modal.querySelector('.amount').textContent = amount;
            modal.querySelector('.category').textContent = category;
            modal.classList.remove('hidden');
        }

        function closeDeleteExpenseModal() {
            const modal = document.getElementById('delete-expense-modal');
            const form = modal.querySelector('form');
            form.action = "";
            modal.querySelector('.title').textContent = "";
            modal.querySelector('.amount').textContent = "";
            modal.querySelector('.category').textContent = "";
            modal.classList.add('hidden');
        }
    </script>

    <div id="desactivate-colocation-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div class="flex flex-1 items-center justify-center p-4">
            <div
                class="w-full max-w-[520px] rounded-xl bg-white/5 p-8 shadow-2xl border border-primary/10 backdrop-blur-sm">
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

    <div id="left-colocation-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div
            class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark overflow-x-hidden">
            <div class="layout-container flex h-full grow flex-col">
                <!-- Main Content Container -->
                <div class="px-4 md:px-40 flex flex-1 justify-center py-10 items-center">
                    <div
                        class="layout-content-container flex flex-col max-w-[480px] flex-1 bg-background-dark/50 border border-primary/20 rounded-xl overflow-hidden shadow-2xl backdrop-blur-sm">
                        <!-- Header with Branding -->
                        <header
                            class="flex items-center justify-between border-b border-solid border-primary/20 px-6 py-4 bg-background-dark/80">
                            <div class="flex items-center gap-3">
                                <div class="text-primary flex items-center justify-center">
                                    <span class="material-symbols-outlined text-3xl">sailing</span>
                                </div>
                                <h2 class="text-slate-100 text-lg font-bold leading-tight tracking-[-0.015em]">EasyColoc
                                </h2>
                            </div>
                            <button onclick="closeLeaveModal()"
                                class="flex items-center justify-center rounded-lg h-10 w-10 bg-primary/10 text-primary hover:bg-primary/20 transition-colors">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </header>
                        <!-- Modal Body -->
                        <div class="p-6 flex flex-col items-center">
                            <!-- Icon/Illustration Area -->
                            <div class="mb-6 relative">
                                <div class="absolute inset-0 bg-primary/20 blur-3xl rounded-full"></div>
                                <div
                                    class="relative w-24 h-24 bg-background-dark border-2 border-primary/30 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(199,41,41,0.3)]">
                                    <span class="material-symbols-outlined text-primary text-5xl"
                                        style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 48;">anchor</span>
                                    <div
                                        class="absolute -bottom-1 -right-1 bg-primary rounded-full p-1 border-2 border-background-dark">
                                        <span class="material-symbols-outlined text-white text-sm">warning</span>
                                    </div>
                                </div>
                            </div>
                            <h2 class="text-slate-100 tracking-tight text-2xl font-bold leading-tight text-center pb-4">
                                Quitter la Colocation ?
                            </h2>
                            <!-- Visual Divider/Graphic -->
                            <div
                                class="w-full h-48 mb-6 rounded-lg overflow-hidden border border-primary/10 relative group">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent z-10">
                                </div>
                                <img alt="Cozy living room shared space" class="w-full h-full object-cover opacity-60"
                                    data-alt="Modern shared apartment living room with warm lighting"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_8CqzLPx_ibsGor6I23bB5f9ptculdNO1OmBtXOna-KCPoBI7urc-gPFB6u_D62VCyxzvXVeCKQoemnHkTYUpK-saZZd0vh0LhIIr7Rq80LwBVId9TOFcr6A1wq1V8e2SsRCsNW9KJJVMoyPISuwxbaGYUDNawRkk_OgwwcwGTIRVuIaxIbSQeM5Tvpx2dH3xBTozh_4bYfa4L8joYpEB1rZV86D7SrqFGerJevEoReiGlm-_mgWSWutxNycaNCD_rs7cWxKlvBw" />
                                <div class="absolute bottom-3 left-0 right-0 z-20 px-4 text-center">
                                    <span class="text-accent-gold text-xs font-semibold tracking-widest uppercase">Dernière
                                        escale</span>
                                </div>
                            </div>
                            <p class="text-slate-300 text-base font-normal leading-relaxed text-center px-2">
                                Attention ! Vous êtes sur le point de quitter cet équipage. Assurez-vous d'avoir soldé tous
                                vos comptes avec vos <span class="text-primary font-semibold">nakamas</span> avant de
                                partir.
                            </p>
                        </div>
                        <!-- Actions -->
                        <div class="flex flex-col gap-3 px-6 pb-8">
                            <form action="" method="post">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="flex items-center justify-center rounded-lg h-14 px-5 bg-primary text-white text-base font-bold leading-normal tracking-wide w-full hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 active:scale-[0.98]">
                                    <span class="material-symbols-outlined mr-2">logout</span>
                                    <span class="truncate">Confirmer le départ</span>
                                </button>
                            </form>
                            <button onclick="closeLeaveModal()"
                                class="flex items-center justify-center rounded-lg h-14 px-5 bg-slate-800 dark:bg-slate-800/50 text-slate-100 text-base font-bold leading-normal tracking-wide w-full border border-slate-700 hover:bg-slate-700 transition-all active:scale-[0.98]">
                                <span class="material-symbols-outlined mr-2">explore</span>
                                <span class="truncate">Rester à Bord</span>
                            </button>
                        </div>
                        <!-- Nautical Footer Motif -->
                        <div class="h-1 bg-gradient-to-r from-transparent via-accent-gold/40 to-transparent"></div>
                    </div>
                </div>
                <!-- Subtle background elements -->
                <div class="fixed top-0 left-0 w-full h-full pointer-events-none opacity-5 overflow-hidden -z-10">
                    <span class="material-symbols-outlined absolute top-10 left-10 text-[200px]">explore</span>
                    <span class="material-symbols-outlined absolute bottom-20 right-10 text-[150px]">sailing</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showLeaveModal(id) {
            const modal = document.getElementById('left-colocation-modal');
            const form = modal.querySelector('form');
            form.action = "{{ route('colocation.leave', ':id') }}".replace(':id', id);
            modal.classList.remove('hidden');
        }

        function closeLeaveModal() {
            const modal = document.getElementById('left-colocation-modal');
            const form = modal.querySelector('form');
            form.action = "";
            modal.classList.add('hidden');
        }
    </script>

    <div id="expense-details-modal"
        class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <!-- Modal Container -->
        <div class="max-w-[800px] w-full bg-card-dark rounded-xl shadow-2xl border border-border-dark overflow-hidden">
            <!-- Modal Header -->
            <div class="relative p-6 sm:p-8 border-b border-border-dark bg-gradient-to-br from-card-dark to-[#161d2b]">
                <div class="absolute top-4 right-4 text-accent-gold/20">
                    <span class="material-symbols-outlined text-6xl rotate-12">sailing</span>
                </div>
                <div class="flex flex-col gap-2 relative z-10">
                    <div class="flex items-center gap-2 text-accent-gold uppercase tracking-[0.2em] text-xs font-bold">
                        <span class="material-symbols-outlined text-sm">menu_book</span>
                        Journal du Thousand Sunny
                    </div>
                    <h1 class="text-slate-100 text-3xl font-black leading-tight tracking-tight">Détails du
                        "<span class="expense-name text-accent-gold"></span>"</h1>
                    <div class="mt-4 flex flex-wrap items-center gap-4">
                        <div class="bg-primary/10 border border-primary/30 px-4 py-2 rounded-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">category</span>
                            <span class="expense-category text-slate-200 font-medium"></span>
                        </div>
                        <div
                            class="bg-accent-gold/10 border border-accent-gold/30 px-4 py-2 rounded-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-accent-gold">payments</span>
                            <span class="text-slate-200 font-bold"><span class="expense-amount"></span>€</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Expense Summary Card -->
            <div class="p-6 sm:p-8">
                <!-- Division List -->
                <div class="mt-10">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-slate-100 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">groups</span>
                            Répartition par membre
                        </h2>
                        <span class="text-sm text-slate-400">Total : <span class="members-count"></span> membres</span>
                    </div>
                    <div id="details" class="space-y-3">
                    </div>
                </div>
            </div>
            <!-- Modal Footer Actions -->
            <div
                class="p-6 bg-background-dark/80 border-t border-border-dark flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex justify-end w-full gap-3">
                    <button onclick="closeExpenseDetailsModal()"
                        class="w-full sm:w-auto px-6 py-2.5 rounded-lg border border-border-dark text-slate-200 font-bold hover:bg-slate-700 transition-all">
                        Fermer le journal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showExpenseDetailsModal(user_id, details, member_count, expense_name, expense_amount, expense_category) {
            const modal = document.getElementById('expense-details-modal');
            const detailsContainer = document.getElementById('details');

            const expenseName = modal.querySelector('.expense-name').textContent = expense_name;
            const expenseAmount = modal.querySelector('.expense-amount').textContent = expense_amount;
            const expenseCategory = modal.querySelector('.expense-category').textContent = expense_category;
            const membersCount = modal.querySelector('.members-count').textContent = member_count;

            let html = ``;
            if(details.length > 0) {
                details.forEach((detail) => {
                    if(detail.status == 'PENDING') {
                        html += `
                            <div
                                class="flex items-center justify-between bg-background-dark/30 hover:bg-background-dark/60 transition-colors p-4 rounded-xl border border-border-dark group">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <div class="h-12 w-12 rounded-full border-2 border-slate-700 overflow-hidden">
                                            <img class="w-full h-full object-cover" data-alt="Avatar de ${detail.debtor.user.name}"
                                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqcUWy1p9109H2n-uEV6Zpcu-q92Gm7KlMYYtEAZGXTAq0_BW_buipDPlw9AH7DTi2OG4L358Pwz3_iwaD0sKRO3-V8wfKVCU_eCLzeBHttEtzPUPBxxdRFUSPyy_eTW7-qrQEnsG1_4-bZvL4qodntaPY-GPCPly6IhdonBde8c5LeP6Y2TqrU_f0kerJPmAFa3meMhmSr8YnahBgWxRfg2OlPoxOUoIkPznmbxBMQSyex_K8OoBE8D_oE-_Ea9MbGejr8gPf630" />
                                        </div>
                                        <div
                                            class="absolute -bottom-1 -right-1 bg-red-500 h-4 w-4 rounded-full border-2 border-card-dark">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-slate-100 font-bold">${detail.debtor.user.name}</p>
                                        <p class="text-primary text-sm font-medium">Reste à payer : ${detail.amount} ฿</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span
                                        class="hidden sm:inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-500/10 text-red-500 text-xs font-bold border border-red-500/20">
                                        Dû
                                    </span>
                                    ${
                                        user_id == detail.expense.creator.user_id ? `
                                            <form action="${"{{ route('colocation.detail.mark-paid', ':id') }}".replace(':id', detail.id)}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button
                                                    class="bg-primary hover:bg-primary/90 text-white text-xs font-bold px-4 py-2 rounded-lg transition-all shadow-lg shadow-primary/20">
                                                    Marquer payé
                                                </button>
                                            </form>
                                        ` : ``
                                    }
                                </div>
                            </div>
                        `;
                    }else if(detail.status == 'PAID') {
                        html += `
                            <div
                                class="flex items-center justify-between bg-background-dark/30 hover:bg-background-dark/60 transition-colors p-4 rounded-xl border border-border-dark group">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <div class="h-12 w-12 rounded-full border-2 border-accent-gold overflow-hidden">
                                            <img class="w-full h-full object-cover" data-alt="Avatar de ${detail.debtor.user.name}"
                                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCSDzEsQkON6WlFdZT16fj4xEXT1EeFWyXKWZCdx1iErDclRewWKCjJelYGee4jbCkXKrf3A1jWlzZhQ8Sdy3LwCFao7bHz3egkGA5iygJ5kehfEjOw4spPdgXWZ675_x2VdSfrq8umvra8-56ewqW5X8Wczk5cKln5WcBdIOcRVQ5bFrNo-ynsd-FZBdExEA7wte_KrdZuSuP2DaQePIqxBCx-VlOar3oI7zK8_Ae5n2QqTyuw0GvpVanIO_L1taNUMsBP0Knbc4Y" />
                                        </div>
                                        <div
                                            class="absolute -bottom-1 -right-1 bg-emerald-500 h-4 w-4 rounded-full border-2 border-card-dark">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-slate-100 font-bold">${detail.debtor.user.name}</p>
                                        <p class="text-emerald-500 text-sm font-medium">Réglé : ${detail.amount} ฿</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-500 text-xs font-bold border border-emerald-500/20">
                                        <span class="material-symbols-outlined text-xs">check_circle</span>
                                        Réglé
                                    </span>
                                    <button
                                        class="bg-slate-700 cursor-not-allowed text-slate-400 text-xs font-bold px-4 py-2 rounded-lg"
                                        disabled="">
                                        Confirmé
                                    </button>
                                </div>
                            </div>
                        `;
                    }
                });
            }else {
                html += `
                    <p class="text-slate-100 text-sm font-medium">Aucun details disponibles</p>
                `;
            }
            detailsContainer.innerHTML = html;
            modal.classList.remove('hidden');
        }

        function closeExpenseDetailsModal() {
            const modal = document.getElementById('expense-details-modal');
            const expenseName = modal.querySelector('.expense-name').textContent = "";
            const expenseAmount = modal.querySelector('.expense-amount').textContent = "";
            const expenseCategory = modal.querySelector('.expense-category').textContent = "";
            const membersCount = modal.querySelector('.members-count').textContent = "";
            modal.classList.add('hidden');
        }
    </script>
@endsection
