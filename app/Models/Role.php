<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'role'
    ];

    protected $casts = [
        'id' => 'string'
    ];

    const ROLES = ['ADMIN', 'DISTRIBUTOR', 'FACTORY_MANAGER', 'CUSTOMER'];

    const ADMIN = self::ROLES[0];
    const DISTRIBUTOR = self::ROLES[1];
    const FACTORY_MANAGER = self::ROLES[2];
    const CUSTOMER = self::ROLES[3];

    /**
     * Get all of the users for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
