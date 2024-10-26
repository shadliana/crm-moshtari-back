<?php

namespace Modules\UserManagement\app\Models;

use App\Casts\EnumCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserRole extends Model
{
    protected $table = 'user_role';

    public static array $roles = [
        'MANAGER' => 1,
        'USER' => 2,
    ];


    protected $casts = [
        'role' => EnumCast::class . ':roles'
    ];

    protected $fillable = [
        'role',
        'user_id',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
