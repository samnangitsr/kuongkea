<?php

namespace App\Http\Controllers\CustomAuth;

use App\User;
use App\Right;
use App\Company;
use App\Customer;

use App\Permission;
use App\PermissionUser;
use App\Mail\VerifyMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyGroup;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginController extends Controller
{
     use AuthenticatesUsers;
     protected $username='username';
     protected $redirectTo = '/dashboard';
     protected $guard='web';

     public function savepermuserstorage()
     {
         $permusers = PermissionUser::join('permissions', 'permission_users.permission_id', '=', 'permissions.id')
             ->where('user_id', Auth::id())
             ->select('permissions.code', 'permission_users.user_id','permission_users.pcdt')
             ->get();
         return response()->json(['success' => true, 'permusers' => $permusers]);
     }
     public function getuserbycompany(Request $request){

        $selcomid=$request->company_id;
        $users = User::where('active', 1)->where('is_activated',1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->orderBy('no')->get();

        return response()->json($users);
     }
     public function showlogin()
     {

        DB::table('user_onlines')->whereNull('user_id')->delete();
     	if(Auth::guard('web')->check()){
     		return redirect()->route('dashboard');
     	}
        $companies=Company::where('status',1)->get();
        $get_internet_ip=$this->get_client_ip();
        //return($get_internet_ip);
        $comid=Company::where('public_ip','like', '%' . $get_internet_ip . '%')->value('id');
        if($comid){
            $users = User::where('active', 1)->where('is_activated',1)
            ->where(function ($q) use ($comid) {
                $q->where('company_id', $comid)
                ->orWhere('company_id', '')
                ->orWhereNull('company_id');
            })->orderBy('no')->get();
        }else{
            $users = User::select('id', 'username','company_id')->where('active',1)->where('is_activated',1)->orderBy('no')->get(); // fetch only needed fields
        }
     	return view('login.login',compact('companies','users','comid','get_internet_ip'));
     }
     public function showdashboard(){
      //return view('master');
      $startwork=1;
      if(strtoupper(Auth::user()->role->name)=='ADMIN'){
          return view('mainfunction',compact('startwork'));
      }else{
        return view('master',compact('startwork'));
      }

     }

     public function checklogin(Request $request)
     {

        $get_internet_ip=$this->get_client_ip();
        //return $get_internet_ip;
       $public_ip='192.168.168.168';
       $company=Company::find($request->input('company'));
        if($company){
            $public_ip=explode('/',$company->public_ip) ;
        }

        $U=User::where('username',$request->input('username'))->first();

        if($U){
            $attempt=$U->attempt??0;
            if($attempt>5){
                Auth::guard('web')->logout();
                return redirect()->route('showlogin');
            }
            if($U->role->name=='Admin'){
                $attemp=['username' => $request->input('username'), 'password' => $request->input('password'),'active'=>1,'is_activated'=>1];
            }else{
                $attemp=['username' => $request->input('username'), 'password' => $request->input('password'),'active'=>1,'is_activated'=>1,'company_id'=>$request->input('company')];
            }
              if (Auth()->guard('web')->attempt($attemp)) {
                $new_sessid   = Session::getId(); //get new session_id after user sign in
                if($U->session_id != '') {
                    $last_session = Session::getHandler()->read($U->session_id);
                    if ($last_session) {
                        if (Session::getHandler()->destroy($U->session_id)) {

                        }
                    }
                }
                    session([
                    'log_into_company_id' => $request->input('company'),
                ]);
                setcookie("company_id_cookie", $request->input('company'), time() + (365 * 24 * 60 * 60), "/");

                //DB::table('users')->where('id', $U->id)->update(['session_id' => $new_sessid]);


                if(in_array($get_internet_ip, $public_ip)){
                    DB::table('users')->where('id', $U->id)->update(['session_id' => $new_sessid,'attempt'=>0]);
                    return redirect($this->redirectTo);
                }else{

                    //return 'You can not access from outside '. $get_interet_ip;
                    if ($U->remote_password && Hash::check($request->password1, $U->remote_password)) {
                        DB::table('users')->where('id', $U->id)->update(['session_id' => $new_sessid,'attempt'=>0]);
                        return redirect($this->redirectTo);
                    }else{
                        DB::table('users')->where('id', $U->id)->update(['attempt' => $attempt+1]);
                        Auth::guard('web')->logout();
                        return redirect()->route('showlogin');

                    }
                }
            }else{
                DB::table('users')->where('id', $U->id)->update(['attempt' => $attempt+1]);
            }
        }

        Session::put('login_error', 'Your username and password wrong!!');
        return back()->withInput($request->only(['username']));


     }

     public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
     public function getlogout()
     {
        DB::table('user_onlines')->where('user_id',Auth::id())->delete();
        Session::flush();
        Session::put('success','you are logout Successfully');
     	Auth::guard('web')->logout();
     	return redirect()->route('showlogin');
     }
    public function getcustomercompany(Request $request)
    {
        $selcomid=$request->company;
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['BANK','AGENT'])->orderBy('customertype')->get();
        return response($customers);
    }
    public function create()
    {
        $selcomid=Session('log_into_company_id');
        //$users=User::where('active',1)->where('company_id',$selcomid)->orderBy('id')->get();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        $roles=DB::table('roles')->orderBy('id')->get();
        $rights=Right::orderBy('code','ASC')->get();
        $permissions=Permission::orderBy('id')->get();
        $companies=Company::where('status',1)->get();
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['BANK','AGENT'])->orderBy('customertype')->get();
        $pgroups=PropertyGroup::where('status',1)->get();
        return view('logins.createuser',compact('users','roles','permissions','rights','customers','pgroups','companies','selcomid'));
    }

    public function refreshuser(Request $request)
    {
        $comid = $request->selcompany;
        if ($comid == '') {
            $users = User::where('active', $request->radact)
                ->orderBy('id')
                ->get();
        } else {
            $users = User::where('active', $request->radact)
                ->where(function ($q) use ($comid) {
                    $q->whereNull('company_id')
                    ->orWhere('company_id', '')
                    ->orWhere('company_id', $comid);
                })
                ->orderBy('id')
                ->get();
        }
        return view('logins.tbl_user', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'username' =>'required | unique:users',
        'email' => 'required | email | unique:users',
        'password' => 'required| min:6 | confirmed',
        'password_confirmation' => 'required| min:6'
        ]);
        $seluserconnect='';
        if($request->selcustomerconnect){
            $seluserconnect=implode(',',$request->selcustomerconnect);
        }
        $selpgroup='';
        if($request->selpropertygroup){
            $selpgroup=implode(',',$request->selpropertygroup);
        }
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }else{
            $user = User::create([
              'name'=>$request->name,
              'username'=>$request->username,
              'role_id'=>$request->role,
              'email'=>$request->email,
              'customer_connect'=>$seluserconnect ,
              'company_id'=>$request->company,
              'property_group_connect'=>$selpgroup ,
              'password'=>bcrypt($request->password),
              'active'=>$request->active,
              'remember_token'=>Str::random(10),
              'verifyToken'=>Str::random(50),
            ]);
            //Mail::to('tang.heng98999@gmail.com')->send(new VerifyMail($user));
            return $user;
            // $user=new User;
            // $user->name=$request->name;
            // $user->username=$request->username;
            // $user->role_id=$request->role;
            // $user->email=$request->email;
            // $user->password=bcrypt($request->password);
            // $user->active=$request->active;
            // $user->remember_token=str_random(10);
            // $user->verifyToken=str_random(50);
            // $user->save();
            // $thisUser = User::findOrFail($user->id);
            //   return response()->json(['sms'=>'Create User Completed.','user'=>$user]);
        }
    }
  //   public function sendEmail($thisUser){
  //     Mail::to('tang.heng98999@gmail.com')->send(new VerifyMail($thisUser));
  //  }

   public function sendEmailDone($verifyToken){
    $user = User::where(['verifyToken'=>$verifyToken])->first();
    if($user){
            $user::where(['verifyToken'=>$verifyToken])->update([
            'is_activated' => 1, 'verifyToken' => null
        ]);
        return redirect()->route('showlogin');
    } else {
        return "User not found";
    }
  }

  protected function registered(Request $request, $user)
  {
      $this->guard()->logout();
      return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
  }
    public function switchstatus(Request $request)
    {
      DB::table('users')->where('id',$request->id)->update(['active'=>!$request->active]);
    }
     public function switchblock(Request $request)
    {
        if($request->block>5){
            $block=0;
        }else{
            $block=6;
        }

      DB::table('users')->where('id',$request->id)->update(['attempt'=>$block]);
    }
     public function update(Request $request)
    {
        $user=User::findOrFail($request->userid);
        $seluserconnect='';
        if($request->selcustomerconnect){
            $seluserconnect=implode(',',$request->selcustomerconnect);
        }
        $selpgroup='';
        if($request->selpropertygroup){
            $selpgroup=implode(',',$request->selpropertygroup);
        }
        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'username' =>'required | unique:users,username,'.$user->id.',id',
        'email' => 'required | email | unique:users,email,'.$user->id.',id',

        ]);

        if ($validator->fails()) {
            return response()->json(['sms'=>$validator->errors()->all()]);
        }else{
            $user->name=$request->name;
            $user->username=$request->username;
            $user->role_id=$request->role;
            $user->company_id=$request->company;
            $user->email=$request->email;
            $user->active=$request->active;
            $user->customer_connect=$seluserconnect;
            $user->property_group_connect=$selpgroup;
            $user->save();
            return response()->json(['sms'=>'Update User Completed.']);
        }

    }
    public function resetpassword(Request $request)
    {
        //return $request->all();
          $validator = Validator::make($request->all(), [
            'newpassword' => ['required','min:6'],
            'newpassword-confirm' => ['same:newpassword'],
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }else{
            if($request->is_remotepwd==1){
                 User::find($request->user_id)->update(['remote_password'=> Hash::make($request->newpassword)]);
                 return response()->json(['sms'=>'Update Remote Password Completed.']);
            }else{
                User::find($request->user_id)->update(['password'=> Hash::make($request->newpassword)]);
                return response()->json(['sms'=>'Update User Password Completed.']);
            }
        }

    }
    public function destroy(Request $request)
    {
        $user=User::findOrFail($request->userid);
        $user->active=0;
        $user->save();
    }
    public function changepassword()
    {
        return view('logins.changepassword');
    }
    public function storepwd(Request $request)
    {
        $request->validate([
            'current_password' =>
            [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],
            'new_password' => ['required','min:6'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);

        Auth::guard('web')->logout();
        return redirect()->route('showlogin');
    }
    public function getuser_right(Request $request)
    {
        $user=User::find($request->id);
        //return($user->permission);
        //$pu=PermissionUser::where('user_id',$request->id)->orderBy('permission_id')->get();
        $pu=PermissionUser::join('permissions','permissions.id','=','permission_users.permission_id')->where('permission_users.user_id',$request->id)->orderBy('permissions.maincode')->orderBy('permissions.id')->get();

        return view('logins.user_permissionlist',compact('user','pu'));
    }
    public function saveuserpermission(Request $request)
    {
      //return($request->all());
      $user=User::find($request->uid);
            if($user->permission()->where('permission_id',$request->per_id)->exists()){
                return response()->json(['error'=>'This right already exists.']);
            }
            $user->permission()->attach($request->per_id,['pcdt'=>$request->pcdt]);
           return response()->json(['success'=>'Save Completed.']);
    }
    public function updateuserpermission(Request $request)
    {
      //return($request->all());
      $user=User::find($request->uid);
      $user->permission()->detach($request->per_id);
      $user->permission()->attach($request->per_id,['pcdt'=>$request->pcdt]);

    }
     public function deleteuserpermission(Request $request)
    {
      //return($request->all());
      $user=User::find($request->uid);
      if($request->removeall==1){
        PermissionUser::where('user_id',$request->uid)->delete();
      }else{
          $user->permission()->detach($request->per_id);
      }
    }

    public function applyright(Request $request)
    {
      $users=User::where('id','<>',$request->uid)->where('role_id','<>',1)->get();
      return view('logins.userlist_modal',compact('users'));
    }
    public function saveapplyright(Request $request)
    {
      DB::table('permission_users')->where('user_id',$request->id)->delete();
      $user_right=DB::table('permission_users')->where('user_id',$request->ap_id)->orderBy('id')->get();
      foreach ($user_right as $key => $ur) {
        $pu=new Permissionuser;
        $pu->user_id=$request->id;
        $pu->permission_id=$ur->permission_id;
        $pu->pcdt=$ur->pcdt;
        $pu->save();
      }
      return response()->json(['success'=>'Save Sale Completed.']);
    }

    //logout other device after login


  // public function login(Request $request)
  //     {
  //       $this->validate($request, [
  //           'email' => 'required',
  //           'password' => 'required',
  //       ]);
  //       $user = \DB::table('users')->where('email', $request->input('email'))->first();
  //       if (Auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
  //           $new_sessid   = Session::getId(); //get new session_id after user sign in
  //           if($user->session_id != '') {
  //             $last_session = Session::getHandler()->read($user->session_id);
  //             if ($last_session) {
  //               if (Session::getHandler()->destroy($user->session_id)) {

  //               }
  //             }
  //           }

  //           \DB::table('users')->where('id', $user->id)->update(['session_id' => $new_sessid]);
  //           $user = auth()->guard('web')->user();
  //           return redirect($this->redirectTo);
  //       }
  //       Session::put('login_error', 'Your email and password wrong!!');
  //       return back();
  //     }

  //   public function logout(Request $request)
  //   {
  //     Session::flush();
  //     Session::put('success','you are logout Successfully');
  //     return redirect()->to('/login');
  //   }


}
