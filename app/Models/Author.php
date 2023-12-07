<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'given_name',
        'family_name',
        'is_company'
    ];

    protected $casts = [
        'is_company' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function books() {
        return $this->hasMany(Book::class);
    }

    public function getFullNameAttribute(): string
    {
        if (empty($this->given_name) && empty($this->family_name)) {
            return 'Unknown Author';
        }
        return trim($this->given_name . ' ' . $this->family_name);
    }

}
