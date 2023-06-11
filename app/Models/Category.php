<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Portofolio;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
