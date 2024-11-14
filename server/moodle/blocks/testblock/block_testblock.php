<?php

use core_external\util as external_util;

global $PAGE;
$PAGE->requires->css('/css/CSS.css');

class block_testblock extends block_base
{
    function init()
    {
        $this->title = get_string('pluginname', 'block_testblock');
    }


    // HAS settings.php 
    function has_config()
    {
        return true;
    }

    function get_content()
    {
        global $DB;
        global $USER;
        global $PAGE; 
        $content = '';


        if ($this->content !== NULL) {
            return $this->content;
        }

        // LIBRAIRIES BOOTSTRAP & JAVASCRIPT 
        $libraries = block_testblock::include_assets(); 
        $content .= $libraries; 


        // CALL TO PLUGIN SETTINGS 
        $shownotes = get_config('block_testblock', 'shownotes');
        if ($shownotes) {


            $createNote = <<<HTML
            <div class="container">
                <h2>Student grades manager</h2>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModalStudentNote" style="float: right;">New grade </button>        
                <br><br>
                <hr>
            </div>
            HTML;
            $content .= $createNote;

            $stCourses = block_testblock::get_studentcourses();
            $content .= block_testblock::get_modalCreateStudentNote($stCourses);

            // Affichage des notes
            $notes = block_testblock::get_studentnotes();

            // HTML table containing course notes saved by the user.  
            if (!empty($notes)) {
                $nbrows = 1;
                $htmlTableHead = <<<HTML
                    <form action="" method="post">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">UserID</th>
                            <th scope="col">Module</th>
                            <th scope="col">Grade</th>
                            <th scope="col">Percentage</th>
                            <th scope="col">Update</th>
                            <td colspan="2">CRUD</td>
                        </tr>
                    </thead>
                    <tbody>
                HTML;

                $content .= $htmlTableHead;

                foreach ($notes as $note) {
                    $inputdate = $note->record_date;
                    // $mydate = date('Y-m-d', strtotime($inputdate));  // 2019-11-30 
                    $mydate = date('d.m.Y', strtotime($inputdate));  // 30.11.2019

                    $content .=
                        '<tr>
                        <th scope="row">' . $nbrows . '</th>
                        <td>' . $note->userid . '</td>
                        <td>' . $note->course_name . '</td>
                        <th>' . $note->note . '</th>
                        <td>' . $note->percentage . '</td>
                        <td>' . $mydate . '</td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updateModalStudentNote-' . $note->id . '">Update</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalStudentNote-' . $note->id . '" style="float: right;">Delete</button>
                        </td>                       
                    </tr>';


                    // Ajout du modal de mise à jour spécifique à cette note
                    $content .= block_testblock::get_modalUpdateStudentNote($note, $note->course_name, $stCourses); 


                    // Insère le code du modal de suppression spécifique à cette note
                    $content .= block_testblock::get_modalDeleteStudentNote($note, $note->course_name);
                   
                    $nbrows = $nbrows + 1;
                }


                $htmlTableEnd = <<<HTML
                </tbody>
                </table>
                </form>
                HTML;

                $content .= $htmlTableEnd;
                $content .= '<br>';
                $content .= "Number of notes " . (count($notes)) . '<br><br>';
                $content .= ' Student Info : <br> ID = ' . $USER->id . ' | Username =' . $USER->username . ' |  Email =' . $USER->email .' |  Name =' . $USER->firstname.' '. $USER->lastname.'<br> <br>';
    

            }// END IF 

        } else {

            // Eingeschriebene Kurse | Cours inscrits
            $content .= "<h4> Enrolled courses (ID / name) </h4>";
            $courses = block_testblock::get_studentcourses();

            // COURSES LIST 
            // List of courses in which the logged-in user is enrolled | Anzahl der Kurse, für die Sie eingeschrieben sind 
            $content .= "Number of courses you are enrolled in: " . (count($courses)) . '<br>';
            $content .= '<ul>';
            foreach ($courses as $course) {
                $content .= '<li>' . $course->id . ' / ' . $course->fullname . '</li>';
            }
            $content .= '</ul><br><br>';

        }// END ELSEE 



        // Form handling for note update
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'updateStudentNote') {
            $note_id = $_POST['updatenote_id'];
            $updated_note = $_POST['note'];
            $updated_percentage = $_POST['percentage'];
            $updated_date = $_POST['record_date']; 

            $courseId = $_POST['selectCourseId'];
            $courseGrade = $DB->get_record('course', array('id'=>$courseId));
        
            
            // Update the note in the database
            $record = new stdClass();
            $record->id = $note_id; // ID de la note à mettre à jour
            $record->coursid = $courseId ; 
            $record->note = $updated_note;
            $record->percentage = $updated_percentage;
            $record->record_date = $updated_date; 

            $record->course_name =  $courseGrade->fullname; 
            $record->categorieid =  $courseGrade-> category; 

             $record->catparentid = $DB->get_field('course_categories', 'parent', array('id' => $courseGrade->category ));            
             $content .= $record->catparentid.'<br>';       
            if(empty($record->catparentid ) ){
                $record->catparentid = $courseGrade-> category;  
            }
            $content .= $record->catparentid.'<br>' ;     

            $DB->update_record('studentnotes', $record);

            // Redirect to avoid form resubmission on page refresh
            // redirect(new moodle_url($_SERVER['REQUEST_URI']));
            
            // Redirect to avoid resubmission after reloading
            // redirect(new moodle_url($_SERVER['REQUEST_URI']));// redirect(new moodle_url('/blocks/testblock/view.php')); 
            redirect($PAGE->url);
       
        }

       


        // deleteNote
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deleteStudentNote') {
            $noteid = $_POST['note_id']; 
            block_testblock::delete_student_note($noteid); 

            // Redirect to avoid resubmission after reloading
            // redirect(new moodle_url($_SERVER['REQUEST_URI']));// redirect(new moodle_url('/blocks/testblock/view.php')); 
            redirect($PAGE->url);

        }// END IF 



        // Form handling for note insertion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'InsertStudentNote') {
            $userid = $USER->id;
            $courseid = $_POST['selectCourse'];
            $note = $_POST['stGrade'];
            $percentage = $_POST['stPercentage'];


            $stCourses = block_testblock::get_studentcourses(); 
            foreach( $stCourses as $cours){
                if(!empty($cours) && $cours->id == $courseid ){  
                    $findCourse = $cours; 

                }
            }

            $course_fullename = $findCourse->fullname ; 
            $categorieid = $findCourse->category; 
            $catparentid = $DB->get_field('course_categories', 'parent', array('id' => $categorieid ));

            if(empty($catparentid) ){
                $catparentid = $categorieid;                        
            }

            // insert_student_note($userid, $courseid, $categorieid, $catparentid, $course_name, $note, $percentage)
            block_testblock::insert_student_note($userid, $courseid, $categorieid, $catparentid, $course_fullename, $note, $percentage); 
            
            // Redirect to avoid resubmission after reloading
            // redirect(new moodle_url($_SERVER['REQUEST_URI']));// redirect(new moodle_url('/blocks/testblock/view.php')); 
            redirect($PAGE->url);
        }// END IF 




        // BLOCK CONTENT (VIEW)
        $this->content = new stdClass;

        // BODY 
        $this->content->text = $content;// $this->content->text = 'This is the text.'; 

        // MANAGE FOOTER 
        $footer = '<hr><br>' . $USER->username. '@https://learn.bit.ch/moodle/ <br>';

        // Add a link to an other page, for example, view.php 
        // $url = new moodle_url('/blocks/testblock/view.php'); // http://localhost/my/courses.php
        $url = new moodle_url('https://learn.bit.ch/moodle/my/courses.php'); 
        $footer .= html_writer::link($url, 'View my courses page');

        // ADD FOOTER TO VIEW BODY (CONTENT)
        $this->content->footer = $footer; // $this->content->footer = html_writer::link($url, 'Voir la page de test');


        return $this->content;
    }// END FUNCTION 



  function get_modalUpdateStudentNote($note, $course_name, $courses) {
        global $DB;
        $optionsHtml = '';
    
        // Générer le HTML des options pour le <select>
        foreach ($courses as $course) {
            $selected = ($course->fullname === $course_name) ? 'selected' : '';
            $optionsHtml .= '<option value="' . htmlspecialchars($course->id) . '" ' . $selected . '>' . htmlspecialchars($course->fullname) . '</option>';
        }
    
        // Créer le HTML du modal avec le champ sélectionné par défaut
        $modal_id = 'updateModalStudentNote-' . $note->id; 
    
        return '
            <div class="modal fade" id="' . $modal_id . '" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
    
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Update grade </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
    
                        <div class="modal-body">
                            <form method="post">
                                <input type="hidden" id="updatenote_id" name="updatenote_id" value="'. $note->id . '">
                                <input type="hidden" name="action" value="updateStudentNote">
    
                                <div class="mb-3">
                                    <h5><span style="color:brown;">Courses</span></h5>
                                    <select name="selectCourseId" id="selectCourseId" class="form-control">
                                        <optgroup label="Select a course" class="form-control">
                                            ' . $optionsHtml . '
                                        </optgroup>
                                    </select>
                                </div>
    
                                <div class="mb-3">
                                    <label for="note" class="form-label">Note</label>
                                    <input type="text" class="form-control" id="note" name="note" value="' . htmlspecialchars($note->note) . '">
                                </div>
    
                                <div class="mb-3">
                                    <label for="percentage" class="form-label">Pourcentage</label>
                                    <input type="number" class="form-control" id="percentage" name="percentage" value="' . htmlspecialchars($note->percentage) . '">
                                </div>
    
                                <div class="mb-3">
                                    <label for="record_date" class="form-label">Date d\'enregistrement</label>
                                    <input type="date" class="form-control" id="record_date" name="record_date" value="' . date('Y-m-d', strtotime($note->record_date)) . '">
                                </div>
    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
    }
    


    function get_modalDeleteStudentNote($note, $course_name)
    {
        $modal_deleteNote = <<<EOD
            <div class="modal fade" id="deleteModalStudentNote-{$note->id}" tabindex="-1" role="dialog" aria-labelledby="deleteModalStudentNote" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
    
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h3 class="modal-title text-center" id="deleteModalStudentNote"><span style="color:#6c8c48;">Are you sure?</span></h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 15px;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
    
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <p>Do you really want to delete this grade (Course / grade: {$course_name} / {$note->note})?</p>
                        </div>
    
                        <!-- Modal Footer & Form Submission -->
                        <form method="POST">
                            <input type="hidden" name="action" value="deleteStudentNote">
                            <input type="hidden" name="note_id" value="{$note->id}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="deleteNote" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        EOD;
    
        return $modal_deleteNote;
    }
    

    function get_modalCreateStudentNote($courses)
    {
        // Construire le HTML des options pour le <select> en dehors du bloc Heredoc
        $optionsHtml = '';
        foreach ($courses as $course) {
            $optionsHtml .= '<option value="' . htmlspecialchars($course->id) . '" name="' . htmlspecialchars($course->id) . '">' . htmlspecialchars($course->fullname) . '</option>';
        }

        // Bloc Heredoc avec l'insertion de $optionsHtml
        $modal_createNote = <<<EOD
            <div class="modal fade" id="createModalStudentNote" tabindex="-1" role="dialog" aria-labelledby="createModalStudentNoteLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                
                    <div class="modal-header justify-content-center">
                        <h3 class="modal-title text-center" id="ModalStudentNote"><span style="color:#6c8c48;">New student grade</span></h3>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 15px;">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
        
                    <form method="POST" name="Form_CreateTasked">
                        <input type="hidden" name="action" value="InsertStudentNote">
                        <div class="modal-body">
        
                            <!--Courses  -->   
                            <div class="form-group">
                                <h5><span style="color:brown;">Courses</span></h5>
                                <select name="selectCourse" id="selectCourse" class="form-control">
                                    <optgroup label="Select a course " class="form-control">
                                        $optionsHtml
                                    </optgroup>
                                </select>

                            </div>
                            <br>      

                            <!-- NEW STUDENT GRADE  -->    
                            <div class="form-group">
                                <label for="Grad"><h5><span style="color:brown;">Grade obtained</span></h5></label>
                                <input type="text" class="form-control" id="stGrade" name="stGrade" placeholder="Grade obtained ..." required>
                            </div>
                            <br>
        
                            <!-- PERCENTAGE OF GRADE OBTAINED  -->    
                            <div class="form-group">
                                <label for="Grad"><h5><span style="color:brown;">Percentage of grade obtained (%)</span></h5></label>
                                <input type="text" class="form-control" id="stPercentage" name="stPercentage" placeholder="Percentage of grade ..." required>
                            </div>
                            <br>                    
        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                
                </div>
            </div>
        </div>
        EOD;

        return $modal_createNote;
    }

    function get_studentnotes()
    {
        global $DB;
        global $USER;
        $notes = $DB->get_records('studentnotes', array('userid' => $USER->id));
        return $notes;
    }


    function get_studentcourses()
    {

        global $DB;
        global $USER;
        // Get the “student” role ID in Moodle
        $student_role = $DB->get_field('role', 'id', array('shortname' => 'student'));


        // SQL query to retrieve courses in which the user is enrolled as a student
        $sql = "SELECT c.id, c.fullname AS fullname, ue.timeend, c.category, c.shortname 
        FROM {course} c
        JOIN {enrol} e ON e.courseid = c.id
        JOIN {user_enrolments} ue ON ue.enrolid = e.id
        JOIN {context} ctx ON ctx.instanceid = c.id AND ctx.contextlevel = 50
        JOIN {role_assignments} ra ON ra.userid = ue.userid AND ra.contextid = ctx.id
        WHERE ue.userid = :userid AND ra.roleid = :student_role";

        $params = array('userid' => $USER->id, 'student_role' => $student_role, );
        $courses = $DB->get_records_sql($sql, $params);
        return $courses;

    }


    function include_assets() {
        $required = ''; 
        $required .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
        $required .= '<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>';
        $required .=  '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>';
        return $required; 
    }

    function insert_student_note($userid, $courseid, $categorieid, $catparentid, $course_name, $note, $percentage) {
        global $DB;
    
        $record = new stdClass();
        $record->userid = $userid;
        $record->coursid = $courseid;
        $record->categorieid = $categorieid; // Ajustez si nécessaire
        $record->catparentid = $catparentid; // Ajustez si nécessaire
        $record->course_name = $course_name; // Ajoutez la logique pour obtenir le nom du cours si nécessaire
        $record->note = $note;
        $record->percentage = $percentage;
        $record->record_date = date('Y-m-d H:i:s');
    
        $DB->insert_record('studentnotes', $record);

    }
    
    function delete_student_note($note_id) {
        global $DB;
        $DB->delete_records('studentnotes', array('id' => $note_id));

        // Redirect to avoid resubmission after reloading
        // redirect(new moodle_url($_SERVER['REQUEST_URI'])); // redirect(new moodle_url('/blocks/testblock/view.php'));

    }

function update_student_note($note){
    // update_note.php

    require_once('../../config.php'); // Inclure le fichier de configuration Moodle

    // Récupérer les données POST
    $note_id = required_param('note_id', PARAM_INT);
    $note = required_param('note', PARAM_TEXT);
    $percentage = required_param('percentage', PARAM_INT);
    $record_date = required_param('record_date', PARAM_RAW);

    global $DB;

    // Mettre à jour la note dans la base de données
    $DB->update_record('studentnotes', [
        'id' => $note_id,
        'note' => $note,
        'percentage' => $percentage,
        'record_date' => $record_date
    ]);

    // Rediriger vers la page d'origine avec un message de succès
    redirect(new moodle_url($_SERVER['REQUEST_URI']), get_string('noteupdated', 'block_testblock'));
}

}
