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

        $user = User::where("email",$input["email"])->first();

        if(is_null($user)){

            $user = new User();

            $user->first_name   = $input["first_name"];
            $user->last_name    = $input["last_name"];
            $user->email        = $input["email"];
            $user->password     = Hash::make($input["password"]);
            $user->city         = $input["city"];
            $user->status       = $input["status"];

            $user->save();

            $response = [
                "message"   => "Create user process successful",
                "data"      => $user
            ];

            return response()->json($response);

        }
        else{

            $response = [
                "message" => "User is already exist."
            ];

            return response()->json($response);

        }

    }

    public function updateUser($input,$id){

        $user = User::find($id);

        $user->first_name   = $input["first_name"];
        $user->last_name    = $input["last_name"];
        $user->email        = $input["email"];
        $user->password     = Hash::make($input["password"]);
        $user->city         = $input["city"];
        $user->status       = $input["status"];

        $user->save();

        return $user;

    }

    public function softDeleteUser($id){

        $user = User::find($id);

        if($user){

            if($user->status == 1 && is_null($user->deleted_at)){

                $user->status = 0;
                $user->deleted_at = date("Y-m-d H:i:s");

                $user->save();

                return $user;

            }
            else{
                return "User already deleted.";
            }

        }
        else{
            return "User not found.";
        }

    }


}
