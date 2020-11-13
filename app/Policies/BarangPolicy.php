<?php

namespace App\Policies;

use App\Models\Barang;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BarangPolicy
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
        return $user->id_role == 25;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Barang  $barang
     * @return mixed
     */
    public function view(User $user, Barang $barang)
    {
        return $user->id_role == 50;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Barang  $barang
     * @return mixed
     */
    public function update(User $user, Barang $barang)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Barang  $barang
     * @return mixed
     */
    public function delete(User $user, Barang $barang)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Barang  $barang
     * @return mixed
     */
    public function restore(User $user, Barang $barang)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Barang  $barang
     * @return mixed
     */
    public function forceDelete(User $user, Barang $barang)
    {
        //
    }
}
