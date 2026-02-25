<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ColocationMember extends Model
{
    protected $fillable = [
        'user_id',
        'colocation_id',
        'role',
        'left_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function colocation(): BelongsTo
    {
        return $this->belongsTo(Colocation::class);
    }


    public function createdExpenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'creator_member_id');
    }


    public function debts(): HasMany
    {
        return $this->hasMany(ExpenseDetail::class, 'debtor_member_id');
    }
}
