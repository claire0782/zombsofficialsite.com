<?php
   include "connection.php";

   if(isset($_GET['course'])){
        $course = $_GET['course'];

        $sql = "SELECT students.StudentNo, students.LastName, students.FirstName, LEFT(students.MiddleName, 1) AS middle, course.accro, courseoffering.student_year, registration.Section
        FROM students
        INNER JOIN registration ON registration.StudentNo = students.StudentNo
        INNER JOIN courseoffering ON courseoffering.courseid = registration.Course 
        INNER JOIN course ON course.id = courseoffering.courseid
        WHERE course.accro LIKE '%$course%'
        GROUP BY students.StudentNo;";
        $result = $conn -> query($sql);
        $row = mysqli_fetch_assoc($result);
        if($row > 0)
        {?>
            <p class="first-para"><b>SOUTHERN LEYTE STATE UNIVERSITY</b><br> Main Campus <br>Sogod, Southern Leyte</p><br>
            <h1 class="master-list">Masterlist by coursecode</h1><br>
            <p class="float">Units: 3 <br> Schedule: iLab-3 TF 05:30 PM 06:30 PM/ <br> ICT-3 TF 06:30 PM 8:30 PM</p>
            <p class="second-para">Course Code: <?php echo ''.$row['accro'].''?><br> Course No: IT 301L <br> Course Title: Advance DB Systems <br> Instructor: Nestnie D. Honrada</p>
            <p class="last-para">School Year: 2022 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Semester 1st</p>

            <style>
                table{
                        border-collapse: collapse; 
                            width: 100%;
                       }
                       table, th, td{
                        border: 1px solid black;
                        border-collapse: collapse;
                       }
                       tr,td{
                            padding-left: 10px;
                       }
                       .center{
                            margin-left: auto;
                            margin-right: auto;
                       }
            </style>
            <table class="center">
                <tr>
                    <td>#</td>
                    <td>StudentNo</td>
                    <td>LastName</td>
                    <td>FirstName</td>
                    <td>MI</td>
                    <td>Course</td>
                    <td>Year/Section</td>
                </tr>
                <?php
                    $ctr = 1;
                    foreach($result as $row)
                    {
                        echo '<tr>
                            <td>'.$ctr.'</td>
                            <td>'.$row['StudentNo'].'</td>
                            <td>'.$row['LastName'].'</td>
                            <td>'.$row['FirstName'].'</td>
                            <td>'.$row['middle'].'</td>
                            <td>'.$row['accro'].'</td>
                            <td>'.$row['student_year'].'-'.$row['Section'].'</td>
                        </tr>';

                    }
                ?>
            </table>
        <?php 
        }else{
            echo "<h4 class='text-danger text-center'><strong>NO DATA FOUND</strong></h4>";
        }
   }








       

?>