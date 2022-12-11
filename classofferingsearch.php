<?php
    include_once "connection.php";

        $id = $_POST['id'];

        $sql = "SELECT courseoffering.coursecode, course.accro, transcript.courseno, course.course_title, transcript.units, courseoffering.student_year, courseoffering.section, COUNT(courseoffering.schedule_time_id) AS available, courseoffering.max_limit, courseoffering.max_limit, schedule_time.tym, LEFT(employees.FirstName,1) AS FirstName, employees.LastName
        FROM courseoffering
        INNER JOIN course ON course.id = courseoffering.courseid
        INNER JOIN transcript ON transcript.id = courseoffering.transcriptid 
        INNER JOIN schedule_time ON schedule_time.id = courseoffering.schedule_time_id 
        INNER JOIN employees ON employees.id = courseoffering.employeeid
        WHERE course.id = $id
        GROUP BY course.accro, courseoffering.section;";
        $result = $conn -> query($sql);

        ?>
           <div class="container-fluid">
                        
                        <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-16">
                                  
                                        <table class="table table-bordered mt-5">
                                            <tr class="table" id="tr">
                                                <td id="td">#</td>
                                                <td id="td">Course Code</td>
                                                <td id="td">Course</td>
                                                <td id="td">Course No</td>
                                                <td id="td">Course Title</td>
                                                <td id="td">Units</td>
                                                <td id="td">Section/Student Year</td>
                                                <td id="td">Available/Max Limit</td>
                                                <td id="td">Schedule</td>
                                                <td id="td">Instructor</td>
                                            </tr>
    
                                        <?php
                                            $ctr =1;
                                            foreach($result as $row){
                                                echo 
                                                '<tr>
                                                    <td>'.$ctr.'</td>
                                                    <td>'.$row['coursecode'].'</td>
                                                    <td>'.$row['accro'].'</td>
                                                    <td>'.$row['courseno'].'</td>
                                                    <td>'.$row['course_title'].'</td>
                                                    <td>'.$row['units'].'</td>
                                                    <td>'.$row['student_year'].'/'.$row['section'].'</td>
                                                    <td>'.$row['available'].'/'.$row['max_limit'].'</td>
                                                    <td>'.$row['tym'].'</td>
                                                    <td>'.$row['LastName'].', '.$row['FirstName'].'.</td>
                                                </tr>';
                                                $ctr++;
                                                
                                            }
                                        ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
