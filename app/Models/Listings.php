<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
      protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'city',
        'suburb',
        'pricing_type',
        'price',
        'status',
    ];

     protected $casts = [
        'price' => 'decimal:2',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

