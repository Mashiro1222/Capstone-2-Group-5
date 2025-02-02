<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetectionHistory extends Model
{
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'detection_histories';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'item_name',
        'scientific_name',
        'description',
        'possible_allergen',
        'symptoms',
        'essential_information',
        'image_path'
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
