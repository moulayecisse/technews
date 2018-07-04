<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 02/07/2018
 * Time: 07:58
 */

namespace App\Factory;

use App\Entity\Menu;
use App\Request\MenuRequest;

class MenuFactory
{
    /**
     * @param MenuRequest $menuRequest
     * @return Menu
     */
    public static function createFromMenuRequest( MenuRequest $menuRequest ) : Menu
    {
        $menu = new Menu();

        $menu->setName( $menuRequest->getName() );
        $menu->setSlug( $menuRequest->getSlug() );
        $menu->setRoute( $menuRequest->getRoute() );
        $menu->setIsActive( $menuRequest->getIsActive() );
        $menu->setIsPublished( $menuRequest->getIsPublished() );

        return $menu;
    }

}