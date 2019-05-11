<?php

namespace App\Providers;

use App\Rating;
use App\Role;
use App\Status;
use App\User;
use App\OrderUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('userEmailConfirmed', function ($user) {
            if($user->confirmedEmail()) {
                return true;
            }

            return false;
        });

        Gate::define('admin', function(User $user) {
            $role = Role::where('name', 'Администратор')->get()->first();
            return $user->roles->contains($role);
        });

        Gate::define('notRespondFeedback', function(User $user){
            $ordersUser = $user->orders1;//получаем все заказы текущего пользователя
            if($ordersUser->isEmpty()) return false;
            $orderMasters = OrderUser::whereIn('order_id', $ordersUser->pluck('id'))->get(); // получаем всех откликнувшихся на заказы
            $orderMasters = $orderMasters->where('status_id',Status::where('name','Принят')->first()->id); // отфильтрованные  значения только принятых к исполнению заказа
            $allFeedbacks = Rating::whereIn('order_user', $orderMasters->pluck('id'))->get();
//            dd($orderMasters->pluck('id'), $allFeedbacks->pluck('order_user'));
            $notFeeds = $orderMasters->pluck('id')->diffKeys($allFeedbacks->pluck('order_user')); // получили количество мастеров, на который текущий пользователь не оставил отзыв

//            dd($orderMasters->pluck('id'), $allFeedbacks->pluck('order_user'), $notFeeds);
            if($notFeeds->count() > 0)
                return true;
            return false;
        });

    }
}
