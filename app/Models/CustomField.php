<?php

namespace App\Models;

use App\Rules\ValidationRuleSyntaxChecker;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $model_type
 * @property string $name
 * @property string|null $validation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomField query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomField whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomField whereValidation($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CustomField extends Model
{
    public $table = 'custom_fields';

    public $fillable = [
        'model_type',
        'name',
        'validation',
        'suggestions',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'model_type' => 'string',
        'name' => 'string',
        'validation' => 'string',
        'suggestions' => 'array',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'model_type' => 'required',
        'name' => 'required',
        'validation' => 'nullable',
        'suggestions' => 'nullable',
    ];

    protected static function boot()
    {
        parent::boot();
        self::$rules['validation'] = ['nullable', new ValidationRuleSyntaxChecker()];
    }
}
