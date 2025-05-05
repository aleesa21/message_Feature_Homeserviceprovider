<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'user_id', // Make sure this foreign key exists in your service_requests table
        'service_details',
        'preferred_time',
        'contact_info',
        'status',
        // ... other fillable fields
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // You might also have a provider relationship:
    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id'); // Assuming providers are also in the users table
    }
}