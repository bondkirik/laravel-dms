<?php

namespace App\Models;

use App\Rules\ValidationRuleSyntaxChecker;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App
 * @property int $id
 * @property string $name
 * @property int $no_of_files
 * @property string $labels
 * @property string $file_validations
 * @property int $file_maxsize
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType whereFileMaxsize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType whereFileValidations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType whereLabels($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType whereNoOfFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileType whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FileType extends Model
{
    public $table = 'file_types';

    public $fillable = [
        'name',
        'no_of_files',
        'labels',
        'file_validations',
        'file_maxsize',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'no_of_files' => 'integer',
        'labels' => 'string',
        'file_validations' => 'string',
        'file_maxsize' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'no_of_files' => 'required|integer',
        'labels' => 'required',
        'file_validations' => 'required',
        'file_maxsize' => 'required|integer',
    ];

    protected static function boot()
    {
        parent::boot();
        self::$rules['file_validations'] = ['required', new ValidationRuleSyntaxChecker()];
    }
}
