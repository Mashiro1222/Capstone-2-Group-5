<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAllergen extends Model
{
    use HasFactory;

    protected $table = 'user_allergens';

    protected $fillable = [
        'user_id',
        'allergen_name',
    ];

    // Relationship back to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


