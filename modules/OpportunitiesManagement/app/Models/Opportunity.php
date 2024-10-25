<?php

namespace Modules\OpportunitiesManagement\app\Models;


use App\Casts\EnumCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\UserManagement\app\Models\User;

class Opportunity extends Model
{
    use SoftDeletes;

    protected $table = 'opportunity_management';

    public static array $statuses = [
        'NEW' => 1,
        'PROCESSING' => 2,
        'WINE' => 3,
        'LOSE' => 4,
    ];

    protected $casts = [
        'status' => EnumCast::class . ':statuses',
    ];

    protected $fillable = [
        'title',
        'related_customer',
        'cost',
        'status',
        'created_by_id',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by_id'
        );
    }
}
