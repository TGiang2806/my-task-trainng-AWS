<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportCus;
use App\Http\Controllers\Controller;
use App\Http\Services\UserCustomer\UserCustomerAdminService;
use App\Imports\ImportCus;
use App\Models\UserCustomers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;




class UserCustomerController extends Controller
{

    protected $userCustomerSevice;

    public function __construct(UserCustomerAdminService $userCustomerSevice)
    {
        $this->userCustomerSevice = $userCustomerSevice;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        session()->put('search_criteria', $request->all());
        $query = UserCustomers::when($request->date != null, function ($q) use ($request){
            return $q->whereDate('updated_at',$request->date);
        })
            ->when($request->actived != null, function ($q) use ($request){
                return $q->where('active',$request->actived);
            })
            ->when($request->type != null, function ($q) use ($request) {
                return $q->where('type', $request->type);
            })

            ->orderBy('updated_at');

        $usercustomers = $query->search()->paginate(10);
        $usercustomerCount = $query->count();

        return view('admin.usercustomer.list', compact('usercustomers', 'usercustomerCount'), [
            'selectedActived' => $request->input('actived', ''),
            'selectedType' => $request->input('type', ''),
            'title' => 'Customer List',
            'usercustomers' => $this->userCustomerSevice->get(),
            'menus' => $this->userCustomerSevice->getMenu()
        ]);
    }
//
    public function importView(Request $request){
        return view('importFile');
    }

    public function importCus(Request $request){
        $file = $request->file('file');

        if ($file) {
            Excel::import(new ImportCus, $file->store('files'));
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Please select a valid file for upload.');
        }
    }


    public function exportCus(Request $request){
        return Excel::download(new ExportCus, 'cus.xlsx');
    }
//

    /**
     *  Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('admin.usercustomer.add', [
            'title' => 'Add new Customer',

            'menus' => $this->userCustomerSevice->getMenu()
        ]);
    }

    /**
     *  Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->userCustomerSevice->insert($request);

        return redirect()->back();
    }

    /**
     *  Display the specified resource.
     * @param UserCustomers $usercustomer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(UserCustomers $usercustomer)
    {
        return view('admin.usercustomer.edit', [
            'title' => 'Edit Customer',
            'usercustomer' => $usercustomer,
            'menus' => $this->userCustomerSevice->getMenu()
        ]);
    }


    /**Show the form for editing the specified resource.
     * @param string $id
     * @return void
     */
    public function edit(string $id)
    {
        //
    }

    /** Update the specified resource in storage.

     * @param Request $request
     * @param UserCustomers $usercustomer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function update(Request $request, UserCustomers $usercustomer)
    {
        $result = $this->userCustomerSevice->update($request, $usercustomer);
        if ($result) {
            return redirect('/admin/usercustomers/list');
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
        $result = $this->userCustomerSevice->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Delete Customer successfully!!!!!'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
