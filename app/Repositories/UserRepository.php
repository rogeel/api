<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * Hash password of the user model that was stored
     * @param  \App\Models\User $user user model
     * @return void
     */
    public function hashPassword(\App\Models\User $user);

    /**
     * Removes confirmation token and sets the user as confirmed
     * @param  Integer $id User's id
     * @return mixed     user's data
     */
    public function removeConfirmationToken($id);

    /**
     * Adds specified role to the user
     * @param  Integer $user_id
     * @param  String  $role_slug short name of the permission
     * @return mixed
     */
    public function attachRole($user_id, $role_slug);
}
