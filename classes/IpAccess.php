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


class IpAccess
{

    public function initializeSystem()
    {
        $strRemoteIp = \Environment::get('remoteAddr');
        $strServerIp = \Environment::get('serverAddr');

        if ( $this->cutIp($strRemoteIp) != $this->cutIp($strServerIp) )
        {
            if ( ($objHostname = IpAccessModel::findBy('ip', $strRemoteIp)) == null )
            {
                $objPage = new $GLOBALS['TL_PTY']['error_403']();
                $objPage->generate(\Frontend::getPageIdFromUrl());
            }
        }
    }


    protected function updateAllIps()
    {
        $objHostnames = IpAccessModel::findAll();

        if ( $objHostnames == null )
        {
            return;
        }

        foreach ( $objHostnames as $objHostname )
        {
            $this->updateIp($objHostname);
        }
    }


    protected function updateIp(IpAccessModel $objHostname)
    {
        if ( $objHostname->hostname == '' )
        {
            return;
        }

        $strIp = gethostbyname($objHostname->hostname);

        if ( $this->isIp($strIp) )
        {
            $objHostname->tstamp = time();
            $objHostname->ip     = $strIp;
            $objHostname->save();
        }
        else
        {
            \System::log("Can't resolve hostname '{$objHostname->hostname}'", __METHOD__, TL_ERROR);
        }
    }


    /**
     * @param string $strIp
     * @return bool
     */
    protected function isIp($strIp)
    {
        return (boolean) filter_var($strIp, FILTER_VALIDATE_IP);
    }


    /**
     * @param string $strIp
     * @return string
     */
    protected function cutIp($strIp)
    {
        return substr($strIp, 0, strrpos($strIp, '.'));
    }

}
