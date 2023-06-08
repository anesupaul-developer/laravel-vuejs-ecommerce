<?php

namespace App\Models;

use App\Models\Traits\HasApproval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasApproval;

    protected $fillable = ['name', 'price', 'user_id', 'description', 'image_url', 'is_approved'];

    protected $casts = [
        'is_approved' => 'boolean'
    ];

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }


}
