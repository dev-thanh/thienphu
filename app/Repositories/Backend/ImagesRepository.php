<?php

namespace App\Repositories\Backend;

use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Backend\ImagesRepositoryInterface;
use App\Models\Image;

class ImagesRepository extends BaseRepository implements ImagesRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Image::class;
    }

    public function getImageSlide()
    {
    	$data = Image::where('status', 1)->get();

    	return $data;
    }

    public function getPartner()
    {
        $data = Image::where('type','partner')->first();

        return $data;
    }
}
