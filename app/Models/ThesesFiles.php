<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\These;

class ThesesFiles extends Model
{
    use HasFactory;

    protected $table = 'theses_files';

    protected $fillable = [
        'name',
        'original_name',
        'these_id'
    ];

    public function theses() : BelongsTo
    {
        return $this->belongsTo(These::class, 'these_id');
    }

}
