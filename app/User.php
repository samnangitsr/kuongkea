<?php

namespace App;

use Carbon\Carbon;
use App\Models\PropertyGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;


    protected $fillable = [
        'name','username','email', 'password','active','role_id','remember_token','verifyToken','customer_connect','company_id','remote_password','block_time','attempt'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
     public function permission()
    {
        return $this->belongsToMany(Permission::class,'permission_users')->withPivot(['pcdt'])->withTimeStamps();
    }
     public function role(){
        return $this->hasOne('App\Role','id','role_id');
    }
     public function company()
    {
    	return $this->belongsTo('App\Company','company_id')->withDefault(['name' =>'']);
    }
    private function CheckifuserhasRole($need_role)
    {
        return (strtolower($need_role) == strtolower($this->role->name)) ? true : null;
    }

    public function hasRole($roles){
        if(is_array($roles))
        {
            foreach ($roles as $need_role){

                if($this->CheckifuserhasRole($need_role)){
                    return true;
                }

            }
        }else
        {
            return $this->CheckifuserhasRole($roles);
        }
        return false;
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function checkpermission($uid,$code)
    {
        $pm_id=DB::table('permissions')->where('code',$code)->first();
        if($pm_id){
            $per_id=$pm_id->id;
        }else{
            $per_id=0;
        }
        $user=User::find($uid);
        if($user->permission()->where('permission_id',$per_id)->exists()){
            return 1;
        }else{
            return 0;
        }
    }

    public static function permissiongetamt($uid,$code)
    {
        $pm_id=DB::table('permissions')->where('code',$code)->first();
        if($pm_id){
            $per_id=$pm_id->id;
        }else{
            $per_id=0;
        }
        $user=User::find($uid);
        $puser=$user->permission()->where('permission_id',$per_id)->first();

        if($puser){
            return $puser->pivot->pcdt;
        }else{
            return 0;
        }
    }
    public static function maxdateopenmoney($uid,$code,$sentdate)
    {
        $pm_id=DB::table('permissions')->where('code',$code)->first();
        if($pm_id){
            $per_id=$pm_id->id;
        }else{
            $per_id=0;
        }
        $user=User::find($uid);
        $puser=$user->permission()->where('permission_id',$per_id)->first();

        if($puser){
            $setday= $puser->pivot->pcdt;
            $date1= date_create($sentdate);
            $current = Carbon::now();
            $current->timezone('Asia/Phnom_Penh');
            $date = date("Y-m-d",strtotime($current));
            $date2=date_create($date);

            $l=date_diff($date1,$date2);
            $durationday=floatval($l->format('%R%a')) ;

            return floatval($setday)-floatval($durationday);
        }else{
            return -1;
        }
    }

    // public static function separate_customerconnect_old($customerconnect)
    // {
    //   $customerconnects=explode(',',$customerconnect);
    //   $customernames='';
    // 	foreach($customerconnects as $key => $value){
    //     $customer=Customer::where('id',$value)->first();
    //     if($customernames==''){
    //         if($customer){
    //             $customernames = $customer->name . ',';
    //         }
    //     }else{
    //         if($customer){
    //             $customernames .='<br>'  . $customer->name . ',';
    //         }
    //     }

    //   }
    //   return $customernames;
    // }

    public static function separate_customerconnect1($customerconnect, $limit = null)
    {
        if (!$customerconnect) return '';
        $ids = explode(',', $customerconnect);
        $names = [];

        foreach ($ids as $id) {
            $customer = Customer::find($id);
            if ($customer) {
                $names[] = e($customer->name);
            }
        }

        if ($limit && count($names) > $limit) {
            $short = array_slice($names, 0, $limit);
            return implode('<br>', $short) . '<br>...';
        }

        return implode('<br>', $names);
    }
    public static function separate_customerconnect($customerconnect, $limit = null, $returnArray = false)
    {
        if (!$customerconnect) {
            return $returnArray ? ['html' => '', 'has_more' => false] : '';
        }

        $ids = explode(',', $customerconnect);
        $names = [];

        foreach ($ids as $id) {
            $customer = Customer::find($id);
            if ($customer) {
                $names[] = e($customer->name);
            }
        }

        $hasMore = false;
        $html = '';

        if ($limit && count($names) > $limit) {
            $short = array_slice($names, 0, $limit);
            $html = implode('<br>', $short) . '...';
            $hasMore = true;
        } else {
            $html = implode('<br>', $names);
        }

        if ($returnArray) {
            return [
                'html' => $html,
                'has_more' => $hasMore,
            ];
        }

        return $html;
    }
    public static function separate_property_group_connect($groupconnect, $limit = null, $returnArray = false)
    {
        if (!$groupconnect) {
            return $returnArray ? ['html' => '', 'has_more' => false] : '';
        }

        $ids = explode(',', $groupconnect);
        $names = [];

        foreach ($ids as $id) {
            $propertyGroup = PropertyGroup::find($id);
            if ($propertyGroup) {
                $names[] = e($propertyGroup->name);
            }
        }

        $hasMore = false;
        $html = '';

        if ($limit && count($names) > $limit) {
            $short = array_slice($names, 0, $limit);
            $html = implode('<br>', $short) . '...';
            $hasMore = true;
        } else {
            $html = implode('<br>', $names);
        }

        if ($returnArray) {
            return [
                'html' => $html,
                'has_more' => $hasMore,
            ];
        }

        return $html;
    }

    public static function separate_property_group_connect1($groupconnect, $limit = null)
    {
        if (!$groupconnect) return '';
        $ids = explode(',', $groupconnect);
        $names = [];

        foreach ($ids as $id) {
            $property_groups = PropertyGroup::find($id);

            if ($property_groups) {
                $names[] = e($property_groups->name);
            }
        }

        if ($limit && count($names) > $limit) {
            $short = array_slice($names, 0, $limit);
            return implode('<br>', $short) . '<br>...';
        }

        return implode('<br>', $names);
    }

    public static function separate_property_group_connect_old($groupconnect)
    {
      $groupconnects=explode(',',$groupconnect);
      $groupnames='';
    	foreach($groupconnects as $key => $value){
        $property_groups=PropertyGroup::where('id',$value)->first();
        if($groupnames==''){
            if($property_groups){
                $groupnames = $property_groups->name . ',';
            }
        }else{
            if($property_groups){
                $groupnames .='<br>'  . $property_groups->name . ',';
            }
        }

      }
      return $groupnames;
    }

}
