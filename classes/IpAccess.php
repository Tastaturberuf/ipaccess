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
        if ( \Config::get('enableIpAccess') )
        {
            // Get remote ip tokens
            $arrIpToken  = explode('.', \Environment::get('remoteAddr'));

            // Build regex pattern
            $strRgxp = sprintf('^(%d|\\\*).(%d|\\\*).(%d|\\\*).(%d|\\\*)$',
                $arrIpToken[0],
                $arrIpToken[1],
                $arrIpToken[2],
                $arrIpToken[3]
            );

            // Build query
            $strQuery = "SELECT * FROM tl_ipaccess WHERE ip REGEXP '$strRgxp'";

            // If no pattern match
            if ( !\Database::getInstance()->query($strQuery)->numRows )
            {
                \System::log("Blocked access for '{$strRemoteIp}'", __METHOD__, TL_ERROR);

                $objPage = new $GLOBALS['TL_PTY']['error_403']();
                $objPage->generate(\Frontend::getPageIdFromUrl());
            }
        }
    }


    public function updateAllIps()
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

        if ( $this->validateIp($strIp) )
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
    protected function validateIp($strIp)
    {
        return (boolean) filter_var($strIp, FILTER_VALIDATE_IP);
    }

}
