<?php

namespace App\Models;

use App\Definitions\BaseDefinition;
use App\Models\Traits\HasApproval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends BaseModel
{
    use HasFactory, HasApproval;

    protected $table = 'customers';

    protected $fillable = ['user_id', 'is_approved', 'subscription_id'];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscription_id', 'id');
    }

    public function scopeIsApproved($query)
    {
        return $query->where('user_id', auth()->user()->id)->where('is_approved', BaseDefinition::APPROVED)->exists();
    }
}
