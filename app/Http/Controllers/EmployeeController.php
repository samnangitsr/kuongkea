<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function multiautocomplete(){
        return view('employees.multiautocompleteinputtable');
    }
    public function getCountries(Request $request)
    {
        $name=$request->get('name');
        $fieldName=$request->get('fieldName');
        $name=strtolower(trim($name));
        if(empty($fieldName)){
            $fieldName='name';
        }
        $countries=DB::table('users')
        ->select('users.*')
        ->where(`LOWER(`.$fieldName.`)`,'LIKE',"$name%")
        ->limit(25)
        ->get();
        return $countries;
    }
}
