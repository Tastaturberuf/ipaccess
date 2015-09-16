<?php

/**
 * ipAccess for Contao Open Source CMS
 *
 * @copyright   (c) 2015 Tastaturberuf <mail@tastaturberuf.de>
 * @author      Daniel Jahnsmüller <mail@jahnsmueller.net>
 * @license     http://opensource.org/licenses/lgpl-3.0.html
 * @package     ipaccess
 */

namespace ipaccess;

class tl_ipaccess
{

    public function formatDate($row, $label, \DataContainer $dc, $args)
    {
        $args[0] = \Date::parse(\Config::get('datimFormat'), $args[0]);

        return $args;
    }


    public function updateAllIps()
    {
        $ipAccess = new IpAccess();
        $ipAccess->updateAllIps();

        \Message::addInfo($GLOBALS['TL_LANG']['tl_ipaccess']['msg']);
        \Controller::redirect(\Controller::getReferer());
    }

}
