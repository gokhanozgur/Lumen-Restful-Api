<?php
/**
 * Created by PhpStorm.
 * User: muzlu
 * Date: 18.06.2019
 * Time: 17:57
 */

namespace App\Repository;


use App\User;
use Illuminate\Support\Facades\Hash;

class UsersRepository
{

    public function getAll(){

        $users = User::all();
        return $users;

    }

    public function getById($id){

        $user = User::find($id);
        return $user;

    }

    public function insertUser($input){

        $user = new User();

        $user->first_name = $input["first_name"];
        $user->last_name = $input["last_name"];
        $user->email = $input["email"];
        $user->password = Hash::make($input["password"]);
        $user->city = $input["city"];
        $user->status = $input["status"];

        $user->save();


        return $user;

    }

    public function updateUser($input,$id){

        $user = User::find($id);

        $user->first_name = $input["first_name"];
        $user->last_name = $input["last_name"];
        $user->email = $input["email"];
        $user->password = Hash::make($input["password"]);
        $user->city = $input["city"];
        $user->status = $input["status"];

        $user->save();

        return $user;

    }

    public function deleteUser($id){

        $user = User::find($id);

        if($user){
            $user->delete();

            return "User deleted.";
        }
        else{
            return "User not found.";
        }


    }


}
