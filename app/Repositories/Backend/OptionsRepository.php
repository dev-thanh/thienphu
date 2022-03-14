<?php

namespace App\Repositories\Backend;

use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Backend\OptionsRepositoryInterface;
use App\Models\Options;

class OptionsRepository extends BaseRepository implements OptionsRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Options::class;
    }
}
