<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('admins.view');
        $admins=Admin::paginate(10);
        return view('dashboard.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admins.create',[
                    'roles'=>Role::all(),
                    'admin'=>new Admin()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required',
            'super_admin'=>'required|exists:admin,super_admin',
            // 'roles'=>'required|array'
        ]);

        $admin=Admin::create($request->all());
        // RoleAbility::create($request->role_id);
        // $admin->roles()->attach($request->roles);

        return redirect()
                ->route('dashboard.admins.index')
                ->with('success','admin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles=Role::all();
        $admin_roles=$admin->roles()->pluck('id')->toArray();

        return view('dashboard.admins.edit',compact('admin','roles','admin_roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'roles'=>'required|array'
        ]);
        $admin->update($request->all());
        $admin->roles()->sync($request->roles);

        return redirect()
            ->route('dashboard.admins.index')
            ->with('success','Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::destroy($id);
        return redirect()
                ->route('dashboard.admins.index')
                ->with('success','Admin deleted successfully');
    }
}
