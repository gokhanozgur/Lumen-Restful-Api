<?php
/**
 * Created by PhpStorm.
 * User: muzlu
 * Date: 18.06.2019
 * Time: 18:06
 */

namespace App\Transformer;



use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    function transform(User $user){

        return[

            "id"            => $user->id,
            "first_name"    => $user->first_name,
            "last_name"     => $user->last_name,
            "email"         => $user->email,
            "city"          => $user->city,
            "status"        => $user->status,
            "deleted_at"    => $user->deleted_at

        ];

    }

}
