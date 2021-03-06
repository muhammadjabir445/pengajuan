<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Inventori' => 'App\Policies\InventoriPolicy',
         'App\Models\Barang' => 'App\Policies\BarangPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('akses-pengajuan', function($user,$id_divisi) {
            if ($user->id_role != 36 && $user->id_role != 37 && $user->id_role != 42) {
                return $user->id_role == $id_divisi;
            } else {
                return true;
            }

        });

        Gate::define('create-pengajuan', function($user,$parent_pengajuan) {
            return $user->id_role == $parent_pengajuan->divisi && $parent_pengajuan->status == 0;
        });

        Gate::define('update-pengajuan',function($user,$pengajuan) {
            return $user->id == $pengajuan->created_by && $pengajuan->status_pengajuan == 0;
        });

        Gate::define('pembelian-input', function($user) {
            return $user->id_role == 37 || $user->id_role == 23 || $user->id_role == 36;
        });
        Gate::define('edit-profile',function($user,$edit_user) {
            return $user->id === $edit_user->id;
        });
    }
}
