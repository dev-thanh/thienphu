<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\MenuRepository;

class MenuController extends Controller
{
	protected $menu;

	public function __construct(MenuRepository $menu)
	{
		$this->menu = $menu;
	}

    public function getListMenu()
    {
        $data = $this->menu->getMenuGroup();

        return view('backend.menu.list-group', compact('data'));
    }

    public function getEditMenu($id)
    {
        $data = $this->menu->where('id_group', $id)->orderBy('position')->get();

        $menuGroup = $this->menu->menuGroupDetail($id);

        return view('backend.menu.menu-edit', compact('id', 'data', 'menuGroup'));
    }

    public function postAddItem(Request $request, $id)
    {
        $data = [
            'title' => $request->title,
            'url' => $request->url,
            'position' => 0,
            'id_group' => $id,
            'class' => $request->class
        ];

        $this->menu->create($data);

        return redirect()->back()->with('success', 'Thêm mới thành công');

    }

    public function postUpdateMenu(Request $request)
    {
        $jsonMenu = json_decode($request->jsonMenu);

        $this->saveMenu($jsonMenu);

        if (!$request->ajax()) {
            flash('Cập nhập thành công.')->success();
            return back();
        }

    }

    public function saveMenu($jsonMenu, $parent_id = null)
    {
        $count = 0;
        foreach ($jsonMenu as $item) {
            $menu = $this->menu->find($item->id);
            if ($menu) {
                $menu->position  = $count;
                $menu->parent_id = $parent_id;
                $menu->save();
                if (!empty($item->children)) {
                    $this->saveMenu($item->children, $menu->id);
                }
            }
            $count++;
        }
    }

    public function getDelete($id)
    {
        $menu = $this->menu->deleteById($id);
        
        return back()->with('success', 'Xóa menu thành công.');
    }

    public function postEditItem(Request $request)
    {
        $id = $request->id;

        $data = [
            'title' => $request->title,
            'url' => $request->url,
        ];

        $this->menu->updateById($id, $data);

        return back()->with('success', 'Cập nhập thành công.');
    }

    public function getEditItem($id)
    {
        $menu = $this->menu->find($id);

        if (isset($menu)) {
            $data = [
                'status' => 'success',
                'data'   => $menu
            ];
        } else {
            $data = [
                'status' => 'error'
            ];
        }

        return response()->json($data);
    }
}
