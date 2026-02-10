<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Practice extends Model
{
    protected $fillable = [
        'external_code',
        'file_path',
    ];

    /**
     * Metadati dinamici associati alla pratica
     */
    public function metadata(): HasMany
    {
        return $this->hasMany(PracticeMetadata::class);
    }
}
