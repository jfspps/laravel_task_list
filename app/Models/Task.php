<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // explicitly indicate/permit which members can be filled in via create() and update()
    protected $fillable = ['title', 'description', 'long_description'];
}
