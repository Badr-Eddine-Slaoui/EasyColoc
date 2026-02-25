<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'category_id',
        'creator_member_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(ColocationMember::class, 'creator_member_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(ExpenseDetail::class);
    }
}
