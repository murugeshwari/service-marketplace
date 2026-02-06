<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listings;
use App\Models\EnquiryReply;

class Enquiry extends Model
{
    protected $fillable = [
        'listing_id',
        'customer_id',
        'provider_id',
        'message',
        'reply_message',
        'status'
    ];

    public function listing() {
        return $this->belongsTo(Listings::class);
    }

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function provider() {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function replies() {
        return $this->hasMany(EnquiryReply::class);
    }
}
