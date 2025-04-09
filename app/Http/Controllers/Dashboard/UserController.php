<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $this->authorize('read_user');

        return view('dashboard.users.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = User::orderBy('created_at', 'desc');

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (User $user) {
                return $user->id ?? '-';
            })->editColumn('name', function (User $user) {
                return $user->name ?? '-';
            })->editColumn('email', function (User $user) {
                return $user->email ?? '-';
            })->addColumn('role', function (User $user) {
                return $user->roles->first()->name ?? '-';
            })->editColumn('created_at', function (User $user) {
                return $user->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (User $user) {
                return view('dashboard.users.buttons', compact('user'));
            })
            ->rawColumns(['action'])
            ->startsWithSearch()
            ->make(true);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $this->authorize('create_user');

        $roles = Role::all();

        return view('dashboard.users.create', compact('roles'));

    }


    /**
     * @param CreateUsersRequest $request
     * @return RedirectResponse
     */
    public function store(CreateUsersRequest $request): RedirectResponse
    {
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]);

        $user->roles()->attach($request->role_id);

        return redirect()->route('dashboard.users.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);

    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        $this->authorize('update_user');

        $roles = Role::all();

        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    /**
     * @param UpdateUsersRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUsersRequest $request, User $user): RedirectResponse
    {
        $user->update($request->only('name', 'email'));

        $user->roles()->sync($request->role_id);

        if ($request->password) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('dashboard.users.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);

    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }
}
