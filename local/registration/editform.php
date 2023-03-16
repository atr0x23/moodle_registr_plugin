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

 global $CFG;
 global $DB;
 global $_GET;

 require_once(__DIR__ . '/../../config.php');
 require_once($CFG->dirroot . '/local/registration/classes/form/edit-form.php');

 

 
 $PAGE->set_url(new moodle_url('/local/registration/editform.php'));
 $PAGE->set_context(\context_system::instance());
 $PAGE->set_title('EDIT');
 
 $mform = new edit_form();

if(isset($_GET['id'])){

 $conditions = [
  'id' => $_GET['id'],
];

$fromdb = $DB->get_record('local_registration', $conditions, $fields="*", $strictness=IGNORE_MISSING); //object

//to display our form
$mform->set_data($fromdb);
}

if($mform->is_cancelled()){
    //redirect and echo a message
    redirect($CFG->wwwroot . '/local/registration/show.php', ' You just cancelled the edit action! ');
    die;
}else if($fromform = $mform->get_data()){
    //insert the data to the database
    $input = new stdClass();
    $input->id = $fromform->id;
    $input->name = $fromform->name;
    $input->surname = $fromform->surname;
    $input->email = $fromform->email;
    $input->country = $fromform->country;
    $input->phone = $fromform->phone;
    $DB->update_record('local_registration', $input);

    redirect($CFG->wwwroot . '/local/registration/show.php', 'Record has been updated!');

}


 echo $OUTPUT->header();
  $mform->display();
 echo $OUTPUT->footer();