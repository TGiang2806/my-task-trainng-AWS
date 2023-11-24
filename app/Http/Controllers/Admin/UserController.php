<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExportUser;
use App\Http\Controllers\Controller;
use App\Http\Services\User\UserAdminService;
use App\Imports\ImportUser;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


//use App\Imports\ImportUser;
//use App\Http\Services\UserCustomer\UserService;

///////////////////////
class UserController extends Controller
{

    protected $userSevice;

    /**
     * Search and display data after adding new data
     * @param UserAdminService $userSevice
     */
    public function __construct(UserAdminService $userSevice)
    {
        $this->userSevice = $userSevice;
    }

    public function index(Request $request)
    {
        session()->put('search_criteria', $request->all());

        $query = User::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('updated_at', $request->date);
        });
        if ($request->statususer != null) {
            if ($request->statususer === '0') {
                // Filter for online users based on the last login time
                $query->where('last_login', '>=', now()->subMinutes(2)); // Users logged in within the last 2 minutes are considered "online"
            } elseif ($request->statususer === '1') {
                // Filter for offline users based on the last login time
                $query->where(function ($q) {
                    $q->where('last_login', '<', now()->subMinutes(2))
                        ->orWhereNull('last_login'); // Also include users who haven't logged in
                });
            }
        }

        // Role-based search and other criteria...



        // Role-based search
        if ($request->has('role')) {
            $query->whereHas('roles', function ($query) use ($request) {
                $query->where('name', $request->role);
            });
        }
        $activeSessionMessage = session('statususer');
        $usersWithLastLogin = User::whereNotNull('last_login')
            ->orderBy('last_login', 'desc')
            ->get();


        $query->orderBy('updated_at','DESC');

        $users = $query->paginate(10);
        $userCount = $query->count();

        $roles = Role::pluck('name', 'name'); // Fetch all roles

        return view('admin.users.list', [
            'users' => $users,
            'userCount' => $userCount,
            'selectedstatususer' => $request->input('statususer', ''),
            'selectedGroup' => $request->input('group', ''),
            'selectedRole' => $request->input('role', ''),
            'title' => 'User List',
            'activeSessionMessage' => $activeSessionMessage,
            'usersWithLastLogin' => $usersWithLastLogin, //
            'roles' => $roles,
            'menus' => $this->userSevice->getMenu()
        ]);
    }


    /**
     * Import stored data to csv file
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     *
     */
    public function importView(Request $request){
        return view('importFile');
    }

    public function importUser(Request $request){
        $file = $request->file('file');

        if ($file) {
            Excel::import(new ImportUser, $file->store('files'));
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Please select a valid file for upload.');
        }
    }

    /**
     * Export stored data to csv file.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     *
     */
    public function exportUser(Request $request){
        return Excel::download(new ExportUser, 'user.xlsx');
    }


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\ApplicationShow
     *
     */


    public function create()
    {
        $roles = Role::all(); // Fetch all available roles from the database
        return view('admin.users.add', [
            'title' => 'Add new User',
            'roles' => $roles, // Send roles data to the view
            'menus' => $this->userSevice->getMenu()
        ]);
    }

    public function store(Request $request)
    {
        $userData = $request->except('roles'); // Fetch user data except the 'roles'

        $user = User::create($userData); // Create a new user with the provided data

        $roles = $request->input('roles', []); // Retrieve roles from the request
        $user->syncRoles($roles); // Assign the selected roles to the user

        return redirect()->back()->with('success', 'User created successfully with assigned roles');
    }



    /**
     * Display the specified resource.
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     *
     */
    public function show(User $user)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        $all_column_roles = $user->roles->first();

        return view('admin.users.edit', [
            'title' => 'Edit User',
            'user' => $user,
            'roles' => $roles,
            'all_column_roles' => $all_column_roles,
            'menus' => $this->userSevice->getMenu()
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     */
    public function update(Request $request, User $user)
    {
        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        $result = $this->userSevice->update($request, $user);

        if ($result) {
            return redirect('/admin/users/list')->with('success', 'User information and roles updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update user information and roles');
    }



    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */

    public function destroy(Request $request)
    {
        $userIdToDelete = $request->input('id');
        $loggedInUserId = Auth::id();

        if ($userIdToDelete == $loggedInUserId) {
            return response()->json([
                'error' => true,
                'message' => 'You cannot delete yourself.'
            ]);
        }

        $result = $this->userSevice->delete($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Delete User successfully!'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }







    public function phanquyen($id)
    {
        $user = User::find($id);
        $role= Role::orderBy('id','DESC')->get();
        $all_column_roles = $user->roles->first();
        return view('admin.users.phanquyen', compact('user','role','all_column_roles'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function insert_roles(Request $request,$id)
    {
        $data =$request->all();
        $user =User::find($id);
        $user->syncRoles($data['role']);
        return redirect()->back()->with('status','Theem thanhf coong');
    }


}
