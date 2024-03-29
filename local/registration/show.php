<?php
// This file is part of Moodle Course Rollover Plugin
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
 * @package     local_registration
 * @author      Thanos Trompoukis
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');

global $DB;
global $_GET;


$PAGE->set_url(new moodle_url('/local/registration/show.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('details');

   //get all the messages from db
$userdetails = $DB->get_records('local_registration');



echo $OUTPUT->header();

$templatecontext = (object)[
   'titletext' => 'User\'s details',
   'userdetails' => array_values($userdetails),
   'createurl' => new moodle_url('/local/registration/form.php'),
];
echo $OUTPUT->render_from_template('local_registration/register', $templatecontext);

echo $OUTPUT->footer();