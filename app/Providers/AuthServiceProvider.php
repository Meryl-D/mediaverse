<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot(Gate $gate)

    {
        $this->registerPolicies($gate);
        //dd($gate);

        //check if the user is a secretariat member
        //  $gate->define('isSecretariat', function($user){
        //     return $user->role_id == '1';
        // });

        //check if the user is a teacher
        $gate->define('isTeacher', function($user){
            return $user->role_id == 2;
        });

        //check if the user is a student
        $gate->define('isStudent', function($user){
            return $user->role_id == 3;
        });
        
    }
}
