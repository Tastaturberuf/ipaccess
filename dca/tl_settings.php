<?php

/**
 * ipAccess for Contao Open Source CMS
 *
 * @copyright   (c) 2015 Tastaturberuf <mail@tastaturberuf.de>
 * @author      Daniel Jahnsmüller <mail@jahnsmueller.net>
 * @license     http://opensource.org/licenses/lgpl-3.0.html
 * @package     ipaccess
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{ipaccess_legend},enableIpAccess';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['enableIpAccess'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['enableIpAccess'],
    'inputType' => 'checkbox',
    'eval'      => array
    (
        'tl_class' => 'w50, m12'
    ),
    'sql' => "char(1) NOT NULL default ''"
);
