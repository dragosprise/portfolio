<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory;
    protected $table = 'abouts';
    protected $fillable = [
        'name',
        'title',
        'short_bio',
        'description',
        'location',
        'email',
        'github_url',
        'linkedin_url',
        'website_url',
        'cv',
        'home_image',
        'banner_image'
    ];
}
