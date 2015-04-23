<?php

/**
 * ipAccess for Contao Open Source CMS
 *
 * @copyright   (c) 2015 Tastaturberuf <mail@tastaturberuf.de>
 * @author      Daniel Jahnsmüller <mail@jahnsmueller.net>
 * @license     http://opensource.org/licenses/lgpl-3.0.html
 * @package     ipaccess
 */


$GLOBALS['TL_DCA']['tl_ipaccess'] = array
(

    'config' => array
    (
        'dataContainer' => 'Table',
        'sql'           => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),

    'list' => array
    (
        'sorting' => array
        (
            'mode'        => 2,
            'fields'      => array('ip'),
            'flag'        => 1,
            'panelLayout' => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'showColumns'    => true,
            'fields'         => array('tstamp', 'ip', 'hostname'),
            'label_callback' => array('tl_ipaccess', 'formatDate')
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_user']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_user']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_user']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_user']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),

    'palettes' => array
    (
        'default' => 'hostname,ip'
    ),

    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'label'   => &$GLOBALS['TL_LANG']['tl_ipaccess']['tstamp'],
            'sorting' => true,
            'flag'    => 1,
            'sql'     => "int(10) unsigned NOT NULL default '0'"
        ),
        'hostname' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_ipaccess']['hostname'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => array
            (
                'unique'    => true,
                'maxlength' => 64,
                'tl_class'  => 'w50'
            ),
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'ip' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_ipaccess']['ip'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => array
            (
                'maxlength' => 15,
                'tl_class'  => 'w50'
            ),
            'sql' => "varchar(15) NOT NULL default ''"
        )
    )

);


class tl_ipaccess
{

    public function formatDate($row, $label, DataContainer $dc, $args)
    {
        $args[0] = \Date::parse(\Config::get('datimFormat'), $args[0]);

        return $args;
    }

}
