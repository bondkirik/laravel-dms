<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Relation
 *
 * @property int $id
 * @property int $corporation_id
 * @property int $company_id
 * @property int $department_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Models\Corporation $corporation
 * @property \App\Models\Company $company
 * @property \App\Models\Department $department
 * @property \App\Models\User $user
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @package App\Models
 */
final class Relation extends Model
{
    protected $table = 'user_relations';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function corporation(): BelongsTo
    {
        return $this->belongsTo(Corporation::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
