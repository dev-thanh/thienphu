<?php

namespace App\Repositories\Backend;

use NamTran\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\Backend\MenuRepositoryInterface;
use App\Models\Menu;
use App\Models\MenuGroup;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    public function getMenuGroup()
    {
    	$data = MenuGroup::all();

    	return $data;
    }
    public function menuGroupDetail($id)
    {
    	$data = MenuGroup::find($id);

    	return $data;
    }
}
