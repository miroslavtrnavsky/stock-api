<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    protected $guarded = ['id'];

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }
}