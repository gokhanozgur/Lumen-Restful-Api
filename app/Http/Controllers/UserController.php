<?php
/**
 * Created by PhpStorm.
 * User: muzlu
 * Date: 18.06.2019
 * Time: 10:30
 */

namespace App\Http\Controllers;
use App\Repository\UsersRepository;
use App\Transformer\UserTransformer;
use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Bridge\UserRepository;

class UserController extends Controller{

    use Helpers;

    protected $usersRepository;
    protected $userTransformer;

    /**
     * UserController constructor.
     * @param $usersRepository
     * @param $userTransformer
     */
    public function __construct(UsersRepository $usersRepository, UserTransformer $userTransformer)
    {
        $this->usersRepository = $usersRepository;
        $this->userTransformer = $userTransformer;
    }

    public function show(){

        $user = $this->usersRepository->getAll();

        if($user){
            $response = $this->response->collection($user, new UserTransformer());
        }
        else{

            $response = $this->error("User not found.",200);

        }

        return $response;

    }

    public function showUser($id){

        $user = $this->usersRepository->getById($id);

        if($user){
            $response = $this->response->item($user, new UserTransformer());
        }
        else{

            $response = $this->error("User not found.",200);

        }

        return $response;

    }

    public function add(Request $request){

        $user = $this->usersRepository->insertUser($request);
        $response = $user;

        return $response;

    }

    public function update(Request $request,$id){

        $user = $this->usersRepository->updateUser($request,$id);

        $response = $this->response->item($user,new UserTransformer());

        return $response;

    }

    public function softDelete($id){

        $user = $this->usersRepository->softDeleteUser($id);

        $response = $this->response->array(["data" => $user]);

        return $response;

    }


}
