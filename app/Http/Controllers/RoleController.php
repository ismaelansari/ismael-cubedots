<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Module;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
       $filter = $request->all();
       $data['roles'] =  Role::where(function($query) use ($filter){
                              if($filter){
                                 if(isset($filter['search']) && !empty($filter['search'])){
                                     $query->whereRaw('LOWER(roles.name) like ?' , '%'.strtolower($filter['search']).'%');
                                 }
                              }
                           })->where('id','!=','1')->paginate();
       return view('role.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data['role'] = Role::find(decrypt($id));
         $data['modules']          = Module::select( 'id' , 'module_name')->where('id','!=','3')->orderBy('module_name', 'ASC')->get();
         return view('role.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $id          = decrypt($id);
        $role        = $request->name;
        $permissions = $request->permissions;
        $description = $request->description;

        $validatedData = $request->validate([
        'role_title'    => 'required|min:2|max:50|unique:roles,name,'.$id.',id,deleted_at,NULL',
        ]);

        $role              = Role::find($id);
        $role->name  = $request->role_title;
        $role->description = $request->description;

        if(!empty($permissions)){
        $role->permissions()->sync($permissions);
        }

        if($role->save()){
        return  redirect()->route('role.index')->with('status' , true )->with('message' , 'Role updated uccessfully');
        }else{
        return  redirect()->route('role.index')->with('status' , false )->with('message' , 'Failed to update role');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $Role = Role::findOrFail(decrypt($id));
       if($Role->delete()){
          return redirect()->route('role.index')->with('status',true)->with('message','Successfully deleted role');
       }else{
          return redirect()->route('role.index')->with('status',false)->with('message','Failed to delete role');
       }
    }

     public function status(Request $request){
       $input  = $request->all();
       $id     = decrypt($input['id']);
       $status = $input['status'];

       if(strtolower($status) == 'active'){
          $is_active = '1';
       }

       if(strtolower($status) == 'inactive'){
          $is_active = '0';
       }
      $Role = Role::find($id);
      $Role->is_active = $is_active;
      if($Role->update()){
         return back()->with('status',true)->with('message','Role status updated successfully');
      }else{

      }

    }
}
