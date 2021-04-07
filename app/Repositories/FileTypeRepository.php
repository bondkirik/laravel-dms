<?php

namespace App\Repositories;

use App\Models\FileType;

class FileTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'no_of_files',
        'labels',
        'file_validations',
        'file_maxsize',
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
        return FileType::class;
    }
}
