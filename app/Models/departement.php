<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\superAdmin;

class departement extends Model
{
    use HasFactory;

    protected $table = 'departement';

    protected $fillable = [
        'name',
        'super_admin_id'
    ];

    public function superAdmin(): BelongsTo
    {
        return $this->belongsTo(superAdmin::class, 'super_admin_id');
    }
}
