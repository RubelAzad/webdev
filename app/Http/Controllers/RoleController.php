<?php

namespace App\Http\Controllers;

use App\Ability;
use App\Role;
use App\User;
use App\RoleAbility;
use App\UserAbility;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        if (Gate::denies('see_all_roles', Role::class)) {
            alert()->error('You are not allowed to see roles!')->persistent('Close');
            flash()->error('You are not allowed to see roles!')->important();
            return redirect('/home');
        }

        activity()->log('View users role page');

        $roles = Role::All();

        return view('back-end.role.index', array('roles' => $roles));
    }

    public function add_new_role(){

        if (Gate::denies('add_new_role', Role::class)) {
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/home');
        }

        $roles = Role::All();

        $data = array('roles' => $roles);

        activity()->log('Add new role page visited');

        return view('back-end.role.add_new', $data );

    }

    public function edit_role($id = 0){

        $role = Role::find($id);

        $roles = Role::All();

        $data = array('roles' => $roles);

        if (Gate::denies('edit_role', $role)) {
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/home');
        }


        $data['role'] = $role;

        activity()->performedOn($role)->log('Visited page: edit users role');

        return view('back-end.role.add_new', $data );

    }

    public function update_role(Request $request){

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);


        if($request->id){
            $role = Role::find($request->id);

            if (Gate::denies('edit_role', $role)){
                alert()->error('Access Denied!')->persistent('Close');
                flash()->error('Access Denied!')->important();
                return redirect('/home');
            }

        }else{

            if (Gate::denies('add_new_role', Role::class)){
                alert()->error('Access Denied!')->persistent('Close');
                flash()->error('Access Denied!')->important();
                return redirect('/home');
            }

            $role = new Role;
        }

        $role->name = $request->name;

        if($id = $role->save()){

            // we need to check to see if this role was based on another role, copy that
            if($request->based_on){

                $abilities = Role::find($request->based_on)->abilities;

                foreach ($abilities as $ability){
                    $roleAbility = new RoleAbility;
                    $roleAbility->role_id = $role->id;
                    $roleAbility->ability = $ability->ability;
                    $roleAbility->allow = $ability->allow;
                    $roleAbility->save();
                }
            }

        }

        return redirect('roles');
    }

    public function update_status($id){
        $role = Role::find($id);

        if (Gate::denies('update_role_status', $role)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/home');
        }


        if($role->active){
            $role->active = 0;
        }else{
            $role->active = 1;
        }

        if($role->save()){
            alert()->success('Status Updated!')->persistent('Close');
            flash()->success('Status Updated!')->important();
        }

        return redirect()->back();
    }

    public function delete($id){

        $role = Role::find($id);

        if (Gate::denies('delete_role', $role)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/home');
        }

        if($role->delete()){
            alert()->success('Role '. $role->name .' has been deleted!')->persistent('Close');
            flash()->success('Role '. $role->name .' has been deleted!')->important();
        }

        return redirect()->back();
    }


    public function view_role_definition(Request $request, $id = 0){
        $role = Role::find($id);
        if (Gate::denies('view_role_definition', $role)) {
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/home');
        }

        activity()->performedOn($role)->log('View role definitions');

        $abilities = Ability::all();

        $temp = $role->abilities;

        $assigned = array();
        foreach ($temp as $tmp){
            $assigned[$tmp->ability] = $tmp;
        }

        $data = array('role' => $role, 'abilities' => $abilities, 'assigned' => $assigned);

        return view('back-end.role.definition',$data);
    }

    public function update_single_ability(Request $request){

        $role = Role::find($request->role);
        $ability = Ability::find($request->ability);

        $roleAbility = RoleAbility::where('ability', '=', $ability->ability)
            ->where('role_id', '=', $role->id)
            ->first();

        $allow = false;

        if($roleAbility){
            $roleAbility->delete();
        }else{
            $roleAbility = new RoleAbility;
            $roleAbility->role_id = $role->id;
            $roleAbility->ability = $ability->ability;
            $roleAbility->allow = 1;
            if($roleAbility->save()){
                $allow = true;
            }
        }

        return response()->json(array('role' => $role->name, 'ability' => $ability->title, 'allowed' => $allow));
    }

    public function assign_to_user($id = 0){

        if(! $id ) return redirect()->back();

        $role = Role::findOrFail($id);

        if (Gate::denies('view_current_role_assignment', $role)) {
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/home');
        }

        $temp = Role::find($id)->users()->get();
        $assigned = array();
        foreach ($temp as $tmp){
            $assigned[$tmp->id] = $tmp;
        }

        //dd($assigned->toArray());
        //dd($assigned);


        activity()->log('Visit role assign page');

        $users = User::all();

        return view('back-end.role.assign', array('role' => $role, 'users' => $users, 'assigned' =>$assigned));
    }

    public function save_roll_assign(Request $request){

        $role = Role::find($request->role_id);

        // possible removal of users role assignment
        $role->users()->detach();

        // possible assign new role to user
        foreach ($request->user_list as $user_id){
            $role->users()->attach($user_id);
        }

        alert()->success('Successfully Updated!')->persistent('Close');

        return redirect('role/all');

    }

    public function view_user_abilities(Request $request, $id = 0){

        $assigned = array();

        if($id){
            $user = User::find($id);
            $temp = $user->abilities;

            foreach ($temp as $tmp){
                $assigned[$tmp->ability] = $tmp;
            }
            activity()->log('View user specific role override of '.$user->name);
        }else{
            return redirect()->back();
        }

        //dd($assigned);


        $abilities = Ability::all();


        return view(
            'back-end.role.override',
            array(
                'user' => $user,
                'abilities' => $abilities,
                'assigned' => $assigned
            )
        );
    }

    public function override_user_abilities(Request $request){

        $user = User::find($request->user_id);

        $inputs = $request->input();


        $currentAssignment = $user->abilities;

        //collect ability names
        $abilities = array();
        foreach ($inputs as $key => $value){
            $tmp = substr($key,0,8);
            if($tmp == 'override'){
                $abilities[substr($key,9)] = 0; // initially set as not allowed
            }

        }

        // collect values
        foreach ($abilities as $ability => $value){
            if(isset($inputs['allowed-'.$ability])){
                if($inputs['allowed-'.$ability] == 'on'){
                    $abilities[$ability] = 1;
                }else{
                    $abilities[$ability] = 0;
                }

            }else{
                $abilities[$ability] = 0;
            }
        }

        // remove from current assignment
        foreach ($currentAssignment as $item){
            if( ! isset($abilities[$item->ability])){
                // just delete from database
                if(UserAbility::destroy($item->id)){

                }
            }
        }

        // add new or save override
        foreach ($abilities as $ability => $value){

            $ua = DB::table('user_abilities')->where('ability', $ability)->first();
            //var_dump($UserAbility);
            if($ua){
                $UserAbility = UserAbility::find($ua->id);
                $log['description'] = 'Update value for user role override';
                $log['changes'] = array('new' => $ability .'='. $value);
            }else{
                $UserAbility = new UserAbility;
                $log['description'] = 'Add new user role override item';
                $log['changes'] = array('new' => $ability .'='. $value);
            }

            $UserAbility->user_id = $inputs['user_id'];
            $UserAbility->ability = $ability;
            $UserAbility->allow = $value;
            if($UserAbility->save()){
                activity()->log('Override user ability');
            }


        }

        alert()->success('User abilities overridden!')->persistent('Close');


        return redirect()->back();
    }
}
