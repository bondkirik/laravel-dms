<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Department
 *
 * @property int $id
 * @property int $company_id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @property \App\Models\Company $company
 * @property \App\Models\Relation[] $relations
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @package App\Models
 */
final class Department extends Model
{
    use SoftDeletes;

    protected $table = 'departments';

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

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function relations(): HasMany
    {
        return $this->hasMany(Relation::class);
    }
}
