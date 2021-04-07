<?php

namespace App\Repositories;

use App\Models\CustomField;

class CustomFieldRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'model_type',
        'name',
        'validation',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CustomField::class;
    }

    public function getForModel($model)
    {
        return $this->allQuery()
            ->where('model_type', $model)
            ->get();
    }
}
