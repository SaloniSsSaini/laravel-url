<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * A company has many users.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * A company has many short URLs.
     */
    public function shortUrls()
    {
        return $this->hasMany(ShortUrl::class);
    }
}
