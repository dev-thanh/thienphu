<?php

namespace App\Repositories\Backend;

use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Backend\PagesRepositoryInterface;
use Illuminate\Support\Facades\Lang;
use SEO;
use SEOMeta;
use OpenGraph;
use App\Models\Pages;
use App\Models\Menu;

class PagesRepository extends BaseRepository implements PagesRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pages::class;
    }

    public function getSiteInfo()
    {
        $site_info = \App\Models\Options::where('type', 'general')->first();

        return $site_info;
    }

    public function seoGeneral()
    {
        $options = \App\Models\Options::whereIn('type', ['general','css-js-config'])->get();

        $site_info = $options->where('type','general')->first();

        $config = $options->where('type','css-js-config')->first();

        if ($site_info) {
            $site_info = json_decode($site_info->content);
            $config = json_decode($config->content);
            OpenGraph::setUrl(\URL::current());
            OpenGraph::addProperty('locale', 'vi');
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('author', 'GCO-GROUP');
            SEOMeta::addKeyword($site_info->site_keyword);

            $menu = \App\Models\Menu::whereIn('id_group',[1,2])->with('get_child_cate')->orderBy('position')->get();

            $menuHeader = $menu->where('id_group', 1);

            $menuFooter = $menu->where('id_group', 2);

            $policy = \App\Models\Policy::where('status', 1)->orderBy('created_at','ASC')->get();

            view()->share(compact('site_info', 'config', 'menuHeader', 'menuFooter', 'policy'));

        }
    }

    public function createSeo($dataSeo = null)
    {
        $site_info = $this->getSiteInfo();
        if (!empty($dataSeo->meta_title)) {
            SEO::setTitle($dataSeo->meta_title);
        } else {
            SEO::setTitle($site_info->site_title);
        }
        if (!empty($dataSeo->meta_description)) {
            SEOMeta::setDescription($dataSeo->meta_description);
            OpenGraph::setDescription($dataSeo->meta_description);
        } else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
        }
        if (!empty($dataSeo->image)) {
            OpenGraph::addImage($dataSeo->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($site_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($dataSeo->meta_keyword)) {
            SEOMeta::addKeyword($dataSeo->meta_keyword);
        }
    }

    public function createSeoPost($data)
    {
        $site_info = $this->getSiteInfo();

        if(!empty($data->meta_title)){
            SEO::setTitle($data->meta_title);
        }else {
            SEO::setTitle($data->name);
        }
        if(!empty($data->meta_description)){
            SEOMeta::setDescription($data->meta_description);
            OpenGraph::setDescription($data->meta_description);
        }else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
        }
        if (!empty($data->image)) {
            OpenGraph::addImage($data->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($site_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($data->meta_keyword)) {
            SEOMeta::addKeyword($data->meta_keyword);
        }
    }

    public function seoTitle($title)
    {
        SEO::setTitle($title);
    }
}
