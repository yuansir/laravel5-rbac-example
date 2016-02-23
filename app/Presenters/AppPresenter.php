<?php namespace App\Presenters;

use Route;
/**
 * Class RbacPresenter
 *
 * @package namespace App\Presenters;
 */
class AppPresenter
{

    /**
     * Set the menu to active by current
     * @param null $name
     * @return string
     */
    public function activeMenuByRoute($name = null)
    {
        $currentRouteName = Route::currentRouteName();
        $routeSections = explode('.', $currentRouteName);

        if(isset($routeSections[1]) && $routeSections[1] === $name) {
            return 'active';
        }

        return '';
    }

}
