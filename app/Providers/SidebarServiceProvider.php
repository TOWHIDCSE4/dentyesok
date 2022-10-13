<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadSidebar();
    }

    public function loadSidebar()
    {
        $menus = config('menus.user');
        $menus = $this->renderSidebar($menus);
        view()->share('menus', $menus);
    }

    public function renderSidebar($menus)
    {
        $menus = collect($menus)->sortBy('order')->toArray();
        $path = '/'.app('request')->path();

        foreach ($menus as &$menu){
            if (isset($menu['sub']) && count($menu['sub'])>0) {
                $menu['sub'] = collect($menu['sub'])->sortBy('order')->toArray();
            }
            if ($path==$menu['route']) {
                $menu['active'] = true;
            } elseif ( isset($menu['sub']) && count($menu['sub'])>0 ) {
                foreach ($menu['sub'] as &$sub) {
                    if ($sub['route']==$path) {
                        $sub['active'] = true;
                        $menu['active'] = true;
                        break;
                    }
                }
            }
        }

        return $menus;
    }

}
