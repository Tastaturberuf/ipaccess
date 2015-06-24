<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package IpAccess
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'ipaccess',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Models
	'ipaccess\IpAccessModel' => 'system/modules/ipAccess/models/IpAccessModel.php',

	// Dcac
	'ipaccess\tl_ipaccess'   => 'system/modules/ipAccess/dcac/tl_ipaccess.php',

	// Classes
	'ipaccess\IpAccess'      => 'system/modules/ipAccess/classes/IpAccess.php',
));
