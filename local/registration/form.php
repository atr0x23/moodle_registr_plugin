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
 require_once($CFG->dirroot . '/local/registration/classes/form/reg-form.php');

 global $DB;
 
 $PAGE->set_url(new moodle_url('/local/registration/form.php'));
 $PAGE->set_context(\context_system::instance());
 $PAGE->set_title('REGISTER');
 
 //we want to display our form
 $mform = new register_form();

if($mform->is_cancelled()){
    //echo a message
    redirect($CFG->wwwroot . '/my', ' You just cancelled and exited from the plugin ! ');

} else if($fromform = $mform->get_data()){

    // print_r($fromform);
    // die('the end');
    //insert the data to the database
    $input = new stdClass();
    $input->name = $fromform->name;
    $input->surname = $fromform->surname;
    $input->email = $fromform->email;
    $input->country = $fromform->country;
    $input->phone = $fromform->phone;
    $DB->insert_record('local_registration', $input);

    redirect($CFG->wwwroot . '/local/registration/show.php', 'The user has been submited!');

}


 echo $OUTPUT->header();
 // $mform->display();

 $templatecontext = (object)[
    'titletext' => 'Show the user details',
    'userdetails' => array_values($userdetails),
    'editurl' => new moodle_url('/local/registration/editform.php'),
    'createurl' => new moodle_url('/local/registration/form.php'),
 ];
 echo $OUTPUT->render_from_template('local_registration/register', $templatecontext);

 echo $OUTPUT->footer();