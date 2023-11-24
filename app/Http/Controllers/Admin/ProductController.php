<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductAdminService $productService)
    {
        $this->productService = $productService;
    }

    /** Search and display data after adding new data
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
 */
    public function index(Request $request)
    {
        session()->put('search_criteria', $request->all());
        $query = Product::when($request->date != null, function ($q) use ($request){
                return $q->whereDate('updated_at',$request->date);
             })
            ->when($request->actived != null, function ($q) use ($request){
                return $q->where('active',$request->actived);
            })
            ->when($request->menu_id, function ($q) use ($request) {
                return $q->where('menu_id', $request->menu_id);
            })
            //is_numeric kiểm tra đó là số

            ->when($request->has('price_min') && is_numeric($request->input('price_min')), function ($q) use ($request) {
                return $q->where('price', '>=', $request->input('price_min'));
            })
            ->when($request->has('price_max') && is_numeric($request->input('price_max')), function ($q) use ($request) {
                return $q->where('price', '<=', $request->input('price_max'));
            })
            ->orderBy('updated_at');

        $products = $query->search()->paginate(4);
        $productCount = $query->count();

        return view('admin.product.list', compact('products', 'productCount'), [
            'selectedActived' => $request->input('actived', ''),
            'title' => 'List of products',
            'products' => $this->productService->get(),
            'menus' => $this->productService->getMenu()
        ]);
    }

    /**  Import stored data to csv file
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
 */
    public function importView(Request $request){
        return view('importFile');
    }

    public function importProducts(Request $request){
        $file = $request->file('file');

        if ($file) {
            Excel::import(new ExcelImport, $file->store('files'));
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Please select a valid file for upload.');
        }
    }

    /** Export stored data to csv file.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
 */
    public function exportProducts(Request $request){
        return Excel::download(new ExcelExport, 'product.xlsx');
    }

    /** create new product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
 */
    public function create()
    {
        return view('admin.product.add', [
            'title' => 'Add new products',
            'menus' => $this->productService->getMenu()
        ]);
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);

        return redirect()->back();
    }

    /**
     * Upload image local
     * @param Request $request
     * @return array
 */
    public function upload(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
 */
    public function show(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Edit products',
            'product' => $product,
            'menus' => $this->productService->getMenu()
        ]);
    }

    /**
     *  Update the specified resource in storage.
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
 */
    public function update(Request $request, Product $product)
    {
        $result = $this->productService->update($request, $product);
        if ($result) {
            return redirect('/admin/products/list');
        }

        return redirect()->back();
    }

    /**
     *  Remove the specified resource from storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
 */
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Successfully deleted the product!!!!'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
