<?php

namespace App\Policies;

use App\Models\Inventori;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class InventoriPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Inventori  $inventori
     * @return mixed
     */
    public function view(User $user, Inventori $inventori)
    {
        return $user->id === $inventori->id_user || $user->id_role === 37 || $user->id_role === 23 ? Response::allow() : Response::deny('Tidak ada akses ke sini');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Inventori  $inventori
     * @return mixed
     */
    public function update(User $user, Inventori $inventori)
    {
        return $user->id === $inventori->id_user || $user->id_role === 37 || $user->id_role === 23 ? Response::allow() : Response::deny('Tidak ada akses ke sini');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Inventori  $inventori
     * @return mixed
     */
    public function delete(User $user, Inventori $inventori)
    {
        return $user->id_role === 23 ? Response::allow() : Response::deny('Tidak ada akses ke sini');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Inventori  $inventori
     * @return mixed
     */
    public function restore(User $user, Inventori $inventori)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Inventori  $inventori
     * @return mixed
     */
    public function forceDelete(User $user, Inventori $inventori)
    {
        //
    }
}
