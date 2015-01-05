<?php
/**
 * @author Amila Bandara
 * @copyright Amila Bandara
 * @license GNU General Public License
 */

defined("_JEXEC") or die("Restricted access");

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';
$items = ModAspireContactsHelper::getItems();
$item = ModAspireContactsHelper::getItem();
$country_dropdown  = ModAspireContactsHelper::getCountriesDropdown();

require JModuleHelper::getLayoutPath('mod_aspire_contacts', $params->get('layout', 'default'));