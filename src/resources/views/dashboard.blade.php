@extends('layouts.app')

@section('title', 'EasyColoc - Dashboard')

@section('content')
    <main class="mx-auto w-full max-w-[960px] flex-1 px-6 py-8 lg:px-0">
        <!-- Filter Section -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Tableau de bord</h1>
                <p class="text-slate-500 dark:text-slate-400">Suivi de vos dépenses personnelles</p>
            </div>
            <div class="relative min-w-[200px]">
                <form action="" method="get" onchange="this.submit()">
                    <input type="month" name="month-year" value="{{ request('month-year') }}"
                        class="custom-select w-full rounded-xl border border-primary/20 bg-white px-4 py-3 pr-10 text-sm font-medium focus:border-accent-gold focus:ring-accent-gold dark:bg-slate-900 dark:text-slate-100"
                        id="month-select" />
                </form>
            </div>
        </div>
        <!-- Total Expenses Card -->
        <div class="mb-10 @container">
            <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-primary to-[#8b1c1c] p-8 shadow-2xl">
                <div class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-accent-gold/10 blur-3xl"></div>
                <div class="absolute -bottom-8 left-1/4 h-32 w-32 rounded-full bg-white/5 blur-2xl"></div>
                <div class="relative z-10 flex flex-col items-center justify-between gap-6 sm:flex-row">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-widest text-white/80">Total des Dépenses
                        </p>
                        <h2 class="mt-2 text-5xl font-black text-white">{{ $total_amounts }} €</h2>
                    </div>
                    <div class="flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2 backdrop-blur-md">
                        <span class="material-symbols-outlined text-accent-gold">trending_up</span>
                        <span class="text-sm font-bold text-white">+12% vs mois dernier</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Expenses List -->
        <div class="mb-4 flex items-center justify-between">
            <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100">Mes Dépenses</h3>
        </div>
        <div
            class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900/50">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900">
                            <th
                                class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                Titre</th>
                            <th
                                class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                Catégorie</th>
                            <th
                                class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                Date</th>
                            <th
                                class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                Montant</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse ($expenses as $expense)
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded bg-primary/10 text-primary">
                                            <span class="material-symbols-outlined text-lg">category</span>
                                        </div>
                                        <span class="font-medium text-slate-900 dark:text-slate-100">{{ $expense->title }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-800 dark:bg-slate-800 dark:text-slate-300">{{ $expense->category->name }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $expense->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-slate-100">{{ $expense->amount }} €
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
            <div class="border-t border-slate-200 px-6 py-4 dark:border-slate-800">
                <button
                    class="w-full text-center text-sm font-medium text-slate-500 hover:text-primary dark:text-slate-400">Voir
                    tout l'historique</button>
            </div>
        </div>
    </main>
@endsection
