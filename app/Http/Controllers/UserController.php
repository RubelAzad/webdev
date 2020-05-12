<?php

namespace App\Http\Controllers;

use App\File;
use App\Notifications\UserAccountCreated;
use App\Role;
use App\User;
use App\UserPic;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if (Gate::denies('see_all_users', User::class)){
            alert()->error('Access restricted!')->persistent('close');
            flash()->error('Access restricted!')->important();
            return redirect('/dashboard');
        }
        //activity()->performedOn(User::find(1))->log('View user list');
        $users = User::all();
        return view('back-end.user.index', array('users' => $users, 'i' => 1));
    }

    /*
     * Show user profile
     */
    public function show($id=0){

        if(! $id){
            $id = auth()->id();
        }

        $user = User::find($id);

        if (Gate::denies('see_user_profile', $user)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/dashboard');
        }
        $data = array();

        $data['user'] = $user;

        activity()->performedOn($user)->log('View page: user profile');

        return view('back-end.user.show', $data);
    }

    public function add_new_user(Request $request){
        if (Gate::denies('add_new_user', User::class)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/dashboard');
        }

        activity()->log('View page: create new user');

        $roles = Role::all();

        return view('back-end.user.add_new_user', array('roles' => $roles));
    }

    public function insert_new_user(Request $request){

        if (Gate::denies('add_new_user', User::class)){
            alert()->error('Access restricted!')->persistent('Close');
            flash()->error('Access restricted!')->important();
            return redirect('/dashboard');
        }
        // all the fields are required for new user creation
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);


        if($request->has('active')){
            $active = 1;
        }else{
            $active = 0;
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->verify_token = md5(time());
        $user->active = $active;

        if($user->save()){

            if($request->has('send_email')){
                $user->notify(new UserAccountCreated($user));
            }

            // attach role
            $user->roles()->attach($request->role_id);

            alert()->success('A new user account has been created!')->persistent('Close');
            flash()->success('A new user account has been created!')->important();

        }

        return redirect('users');
    }

    /*
     * Show form to edit user information
     */
    public function edit_user($id = 0){

        if (Gate::denies('edit_user', User::class)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/dashboard');
        }

        $user = User::find( $id );

        activity()->performedOn($user)->log('Attempted to edit user info');

        $roles = Role::all();
        return view('back-end.user.edit', array('user' => $user, 'roles' => $roles));
    }

    /*
     * Update user account detail info
     */
    public function update_user(Request $request){

        // no need to check the authentication as this is a post request

        $user = User::find($request->user_id);
        $name = $request->input('name');
        $email = $request->input('email');

        // we will update if there is new name
        if($user->name != $name){
            $user->name = $name;
        }

        if($user->email != $email){
            $another_user = User::find($request->input('email')); // check is this email has been used already
            if(! $another_user ){
                $user->email = $email;
            }
        }

        $user->roles()->detach(); // detach all current role
        $user->roles()->attach($request->role_id); // attach again


        if($request->has('active')){
            $active = 1;
        }else{
            $active = 0;
        }

        if($user->active != $active){
            $user->active = $active;
        }

        if($request->password){
            $user->password = bcrypt($request->password);
        }

        if($user->save()){
            activity()
                ->performedOn($user)
                ->withProperties($user->toArray())
                ->log('Edited');
            alert()->success('User account has been updated!')->persistent('Close');
            flash()->success('User account has been updated!')->important();
        }

        return redirect('users');

    }

    public function change_password(Request $request){
        $this->validate($request, [
            'password' => 'required|min:6',
        ]);

        $user = User::find($request->user_id);

        $user->password = bcrypt($request->input('password'));

        if($user->save()){
            alert()->success('User password has been updated!')->persistent('Close');
        }

        return redirect()->back();
    }

    /*
     * Delete an user account
     */
    public function delete($id){
        if (Gate::denies('delete_user', User::class)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/dashboard');
        }

        $user = User::find($id);
        if($user->delete()){
            activity()->performedOn($user)->log('Deleted');
            alert()->success('User account has been deleted!')->persistent('Close');
        }

        return redirect()->back();
    }

    /*
     * This will change the user status
     * Mainly it will toggle the status
     */
    public function change_status(Request $request){

        if (Gate::denies('change_user_status', User::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return ['error' => 1, 'msg' => 'Access Denied!'];
        }

        $user = User::find( $request->id );

        if($user->active){
            $user->active = 0;
            $msg = 'Account has been successfully disabled!';
        }else{
            $user->active = 1;
            $msg = 'Account has been successfully enabled!';
        }

        if($user->save()){
            activity()->performedOn($user)->withProperties($user->toArray())->log('Edited');
            return ['result'=> $user->active, 'error' => 0, 'msg' => $msg];
        }
        return ['error' => 1, 'msg' => 'Something is wrong. Try again later!'];
    }

    /*
     * Login as another user
     */
    public function login_as(Request $request,$id=0){

        $new_user = User::find( $id );

        if (Gate::denies('login_as', $new_user)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/dashboard');
        }

        activity()->performedOn($new_user)->log('Login as :subject.name');

        $request->session()->put( 'orig_user', Auth::id() );

        auth()->login( $new_user );

        alert()->success($new_user->name .'', 'logged in as: ')->persistent('Close');


        return redirect('dashboard');
    }

    /*
     * Back to the original login when logged in as another user
     */
    public function back_to_original_user(Request $request){
        $id = $request->session()->pull( 'orig_user' );

        $user = auth()->user();

        $orig_user = User::find( $id );
        auth()->login( $orig_user );
        activity()->log('Back to original login from '. $user->name);
        flash()->success('Back to original login')->important();
        return redirect('dashboard');
    }

    public function change_pro_pic($id){
        $user = User::find($id);

        if (Gate::denies('change_profile_pic', $user)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data['user'] = $user;

        activity()->performedOn($user)->log('View page: user profile picture');

        return view('back-end.user.profile.pic', $data);

    }

    public function update_pro_pic(Request $request){

        $user = User::find($request->user_id);

        $path = 'persons/'.$user->person_id.'pro-pic/';
        $hash = md5(time().auth()->id());
        //dd($request->input());
        Storage::put($path.$hash, file_get_contents($request->file('file')->getRealPath()));

        $file = new File;

        $file->hash = $hash;
        $file->name = $request->file->getClientOriginalName();
        $file->mimetype = Storage::mimeType($path.$hash);
        $file->extension = $request->file('file')->getClientOriginalExtension();
        $file->disk = config('filesystems.default');
        $file->path = $path;


        $file->user_id = auth()->id(); // uploaded by ???

        if($file->save()){
            // now it is time to store this information to the person document
            $user->pics()->save(new UserPic(['file_id' => $file->id]));

            flash()->success('New profile picture uploaded!')->important();
        }

        return redirect()->back();
    }

    public function select_pro_pic($pic_id){

        $pic = UserPic::find($pic_id);
        $user = $pic->user;
        $user->pic = '/file/serve/' . $pic->actual_file->hash;

        if($user->save()){
            flash()->success('New profile picture selected!')->important();
        }

        if($user->id == auth()->id()){
            $url = 'user/view';
        }else{
            $url = 'user/view/' . $user->id;
        }

        return redirect($url);

    }

    public function delete_pro_pic($pic_id){

        $pic = UserPic::find($pic_id);

        if($pic->delete()){
            flash()->success('Profile picture deleted!')->important();
        }

        return redirect()->back();

    }

    // get one user information to support role page
    public function get_user_ajax(Request $request){
        //dd($request->input());
        $user = User::find($request->user_id);

        return response()->json(array(
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->roleAll()->implode(', '),
        ));
    }

    public function create_profile(){
        $users = User::all();

        foreach ($users as $user){
            if( ! $user->person){
                $person = new Person;
                $name = explode(' ', $user->name);
                if(count($name) == 1){
                    $person->first_name = $name[0];
                }elseif (count($name) == 2){
                    $person->first_name = $name[0];
                    $person->last_name = $name[1];
                }else{// more than 2
                    $person->first_name = $name[0];
                    $person->middle_name = $name[1];
                    $person->last_name = $name[2];
                }

                $user->person()->save($person);

                dump($user->name . ' created...');
            }
        }
    }

    public function get_for_select2(Request $request){
        $user = User::select('id', 'name')->where('name', 'like', '%' . $request->term . '%')->get();

        return $user;
    }
}
