<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vegetable extends Model
{
    protected $fillable = ['name', 'scientific_name', 'description', 'possible_allergen', 'essential_information', 'symptoms'];
}
