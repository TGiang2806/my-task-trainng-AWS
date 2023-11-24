<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFromRequest;
use http\Env\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use mysql_xdevapi\Result;
use Illuminate\Http\JsonResponse;
use App\Models\Menu;
class MenuController extends Controller
{

    protected  $menuService;

    public  function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
//        $this->middleware('permission:add category|edit category |remove category' ,['only'=>['index','show']]);
//        $this->middleware('permission:add category' ,['only'=>['create','store']]);
//        $this->middleware('permission:edit category' ,['only'=>['update','show']]);
//        $this->middleware('permission:remove category  ' ,['only'=>['destroy']]);
    }

    /**
     *  create new product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * create new product
     */
    public function create(){
        return view('admin.menu.add', [
            'title' => 'Add new category',
            'menus' => $this->menuService->getParent()
        ]);
    }
    public function store(CreateFromRequest $request)
    {
       $this->menuService->create($request);
       return redirect()->back();
    }

    /**
     * view list table
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     *
     */
    public function  index()
    {
        return view('admin.menu.list', [
            'title' => 'Category List',
            'menus' => $this->menuService->getAll()
        ]);
    }

    /**
     * Display the specified resource.
     * @param Menu $menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     *
     */
    public function show(Menu $menu)
    {
        $menus = Menu::all();
        return view('admin.menu.edit', [
            'title' => 'Edit categories ' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getParent()
        ]);
    }

    /**
     *  Update the specified resource in storage.
     * @param Menu $menu
     * @param CreateFromRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
 */
    public function update(Menu $menu, CreateFromRequest $request )
    {
        $this->menuService->update($request, $menu);
        return redirect('/admin/menus/list');
    }

    /**
     *  Remove the specified resource from storage.
     * @param Request $request
     * @return JsonResponse
 */
    public function destroy(Request $request): JsonResponse
    {
        $result= $this->menuService->destroy($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'message' => ' Successfully deleted directory!!!!!'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}
