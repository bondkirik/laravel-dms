<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package App
 * @property \App\Models\Document $document
 * @property \App\Models\FileType $fileType
 * @property \App\Models\User $createdBy
 * @property string $name
 * @property string $file
 * @property integer $document_id
 * @property integer $file_type_id
 * @property integer $created_by
 * @property string $custom_fields
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCustomFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereFileTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class File extends Model
{

    public $table = 'files';

    public $fillable = [
        'name',
        'file',
        'document_id',
        'file_type_id',
        'created_by',
        'custom_fields',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'file' => 'string',
        'document_id' => 'integer',
        'file_type_id' => 'integer',
        'created_by' => 'integer',
        'custom_fields' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function document()
    {
        return $this->belongsTo(\App\Models\Document::class, 'document_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function fileType()
    {
        return $this->belongsTo(\App\Models\FileType::class, 'file_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function createdBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
    }
}
