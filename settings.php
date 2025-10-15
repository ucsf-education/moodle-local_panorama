<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    local_panorama
 * @author     Darren Mei
 * @copyright  Copyright (c) 2020 YuJa Inc. (https://www.yuja.com/)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $PAGE;

if ($hassiteconfig) {
	$ADMIN->add('modules', new admin_category('panorama', new lang_string('panorama', 'local_panorama')));

	require_once('classes/panorama_admin_page.php');
	$settings = new \local_panorama\panorama_admin_page('panoramasettings', new lang_string('settings', 'local_panorama'));

	$settings->add(new admin_setting_configpasswordunmask(
		'panorama/key1',
		new lang_string('key1', 'local_panorama'),
		new lang_string('key1desc', 'local_panorama'),
		'',
		PARAM_TEXT
	));

	$settings->add(new admin_setting_configpasswordunmask(
		'panorama/key2',
		new lang_string('key2', 'local_panorama'),
		new lang_string('key2desc', 'local_panorama'),
		'',
		PARAM_TEXT
	));

	$settings->add(new admin_setting_configpasswordunmask(
		'panorama/consumerkey',
		new lang_string('consumerkey', 'local_panorama'),
		new lang_string('consumerkeydesc', 'local_panorama'),
		'',
		PARAM_TEXT
	));

	$settings->add(new admin_setting_configpasswordunmask(
		'panorama/ltikey',
		new lang_string('ltikey', 'local_panorama'),
		new lang_string('ltikeydesc', 'local_panorama'),
		'',
		PARAM_TEXT
	));

	$environment_setting = new admin_setting_configselect(
		'panorama/environment',
		new lang_string('environment', 'local_panorama'),
		new lang_string('environmentdesc', 'local_panorama'),
		'Production US',
		array('Staging' => 'Staging', 'Production US' => 'Production US', 'Production CA' => 'Production CA', 'Production EU' => 'Production EU', 'Production AZ' => 'Production AZ')
	);

	if (method_exists($environment_setting, 'set_lockable')) {
		$environment_setting->set_lockable(true);
	}


	$settings->add($environment_setting);

	$ADMIN->add('panorama', $settings);
}
