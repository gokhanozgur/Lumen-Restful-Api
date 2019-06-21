<?php
/**
 * Created by PhpStorm.
 * User: muzlu
 * Date: 18.06.2019
 * Time: 10:30
 */

namespace App\Http\Controllers;
use App\Repository\UsersRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Bridge\UserRepository;

class UserController extends Controller{


    protected $usersRepository;

    /**
     * UserController constructor.
     * @param $usersRepository
     * @param $userTransformer
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function show(){

        $users = $this->usersRepository->getAll();

        if($users){

            $response = [
                "message"   => "All user data list",
                "status"    => 200,
                "data"      => $users,
            ];

        }
        else{

            $response = [
                "message"  => "Empty data",
                "status"   => 200,
            ];

        }

        return response()->json($response);

    }

    public function showUser($id){

        $user = $this->usersRepository->getById($id);

        if($user){

            $response = [
                "message"   => "User data",
                "status"    => 200,
                "data"      => $user,
            ];

        }
        else{

            $response = [
                "message"  => "User not exist",
                "status"   => 200,
            ];

        }

        return response()->json($response);

    }

    public function add(Request $request){

        $isUserExist = User::where("email",$request["email"])->first();


        if(is_null($isUserExist))
        {
            $user = $this->usersRepository->insertUser($request);

            $response = [
                "message"   => "Create user process successful",
                "status"    => 200,
                "data"      => $user,
            ];

        }
        else{

            $response = [
                "message"  => "User is already exist.",
                "status"   => 200,
            ];

        }

        return response()->json($response);

    }

    public function update(Request $request,$id){

        $isUserExist = User::find($id);

        if(!is_null($isUserExist))
        {
            $user = $this->usersRepository->updateUser($request,$id);

            $response = [
                "message"   => "Update user process successful",
                "status"    => 200,
                "data"      => $user,
            ];

        }
        else{

            $response = [
                "message"  => "User not exist",
                "status"   => 200,
            ];

        }

        return response()->json($response);

    }

    public function softDelete($id){

        $user = User::find($id);

        if(!is_null($user))
        {

            if($user->status == 1 && is_null($user->deleted_at)){

                $deletedUserInfo = $this->usersRepository->softDeleteUser($id);

                $response = [
                    "message"   => "User delete process successful",
                    "status"    => 200,
                    "data"      => $deletedUserInfo,
                ];

            }
            else{

                $response = [
                    "message"  => "User already deleted",
                    "status"   => 200,
                ];

            }

        }
        else{

            $response = [
                "message"  => "User not exist",
                "status"   => 200,
            ];

        }

        return response()->json($response);

    }


}
