<?php

namespace App\Repositories\Backend;

use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Backend\VideosRepositoryInterface;
use App\Models\Videos;

class VideosRepository extends BaseRepository implements VideosRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Videos::class;
    }
}
