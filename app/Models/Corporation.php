<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Corporation
 *
 * @property int $id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @property \App\Models\Company[] $companies
 * @property \App\Models\Relation[] $relations
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @package App\Models
 */
final class Corporation extends Model
{
    use SoftDeletes;

    protected $table = 'corporations';

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

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function relations(): HasMany
    {
        return $this->hasMany(Relation::class);
    }
}
