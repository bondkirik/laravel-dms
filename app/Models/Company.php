<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 *
 * @property int $id
 * @property int $corporation_id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @property \App\Models\Corporation $corporation
 * @property \App\Models\Department[] $departments
 * @property \App\Models\Relation[] $relations
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @package App\Models
 */
final class Company extends Model
{
    use SoftDeletes;

    protected $table = 'companies';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function relations(): HasMany
    {
        return $this->hasMany(Relation::class);
    }
}
