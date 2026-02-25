<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseDetail extends Model
{
    protected $fillable = [
        'expense_id',
        'debtor_member_id',
        'amount',
        'status',
    ];
    
    protected $casts = [
        'status' => 'string',
    ];

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function debtor(): BelongsTo
    {
        return $this->belongsTo(ColocationMember::class, 'debtor_member_id');
    }
}
