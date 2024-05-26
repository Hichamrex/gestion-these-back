<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\superAdmin;

class AgentBibliotheque extends Model
{
    use HasFactory;

    protected $table = 'agent_bibliotheque';


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'super_admin_id'
    ];

    public function superAdmin(): BelongsTo
    {
        return $this->belongsTo(superAdmin::class, 'super_admin_id');
    }
}
