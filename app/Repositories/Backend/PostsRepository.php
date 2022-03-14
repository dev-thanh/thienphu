<?php

namespace App\Repositories\Backend;

use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Backend\PostsRepositoryInterface;
use App\Models\Posts;
use App\Models\NewsCategory;

class PostsRepository extends BaseRepository implements PostsRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Posts::class;
    }

    public function getPostsHotHome($take)
    {
        $data = $this->model->where([
            'status' =>1,
            'show_home' =>1,
        ])->orderBy('created_at','DESC')->take($take)->get();

        return $data;
    }

    public function postSameCate($id, $array_id)
    {
        $data = $this->model->where('id', '!=', $id)->where('status', 1)
                ->whereIn('id', $array_id)->orderBy('created_at', 'DESC')->get();

        return $data;
    }

    public function getPostsTb()
    {
        $data = $this->model->where('status',1)->where('tieubieu',1)->take(8)->get();

        return $data;
    }

    public function cateSame($id_cate)
    {
        return NewsCategory::whereIn('id_category', $id_cate)->get()->pluck('id_news')->toArray();
    }

    public function postsHot($id, $take)
    {
        $data = $this->model->where('id','!=',$id)->where([
            'status' =>1,
            'hot' =>1,
        ])->orderBy('created_at','DESC')->paginate($take);

        return $data;
    }
}
