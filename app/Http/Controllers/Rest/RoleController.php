<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
   
    public function addRole(){
        $roles = [
            ["name"=>"Manager"],
            ["name"=>"Supervisor"],
            ["name"=>"Staff"]
        ];

        Role::insert($roles);
        return "Roles successfully created";
    }

    public function addUser()
    {
        $user = new User();
        $user->name = "SuSu";
        $user->email = "suu@gmail.com";
        $user->password=encrypt('secrect');
        $user->save();

        $roleids = [1,2];
        $user->roles()->attach($roleids);
        return "Record has been created";

    }

    public function getAllRolesByUser($id){
        $user = User::find($id);
        $roles = $user->roles;
        return $roles;
    }

    public function getAllUsersByRole($id){
        $role = Role::find($id);
        $users = $role->users;
        return $users;
    }
}
