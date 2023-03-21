<?php

namespace App\Repositories;

use App\Models\Products;
use App\Repositories\BaseRepository;

class ProductsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'slug',
        'image',
        'image_mime',
        'image_size',
        'description',
        'status',
        'price',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Products::class;
    }
}
