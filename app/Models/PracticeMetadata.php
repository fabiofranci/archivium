<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PracticeMetadata extends Model
{
    protected $table = 'practice_metadata';

    protected $fillable = [
        'practice_id',
        'metadata_definition_id',
        'value',
    ];

    public function practice(): BelongsTo
    {
        return $this->belongsTo(Practice::class);
    }

    public function definition(): BelongsTo
    {
        return $this->belongsTo(MetadataDefinition::class, 'metadata_definition_id');
    }
}
