<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Laboratoire;
use App\Models\superAdmin;

class EquipeRecherche extends Model
{
    use HasFactory;

    protected $table = 'equipe_recherche';


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'laboratoire_id',
        'super_admin_id'
    ];

    public function superAdmin(): BelongsTo
    {
        return $this->belongsTo(superAdmin::class, 'super_admin_id');
    }

    public function laboratoire(): BelongsTo
    {
        return $this->belongsTo(Laboratoire::class, 'laboratoire_id');
    }
}
