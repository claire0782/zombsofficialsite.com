<?php
    include "connection.php";

    if(isset($_POST['search']))
    {
        $input = $_POST['search'];

        $sql = "SELECT students.StudentNo, students.LastName, students.FirstName, course.course_title, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), students.Birthdate)), '%Y') + 0 AS age, DATE_FORMAT(students.Birthdate, ' %M %d %Y') AS date, SUM(transcript.units) AS total
        FROM students
        INNER JOIN course ON course.id = students.CourseID
        INNER JOIN transcript ON transcript.course = course.id
        WHERE (students.FirstName LIKE '%$input%' OR students.LastName LIKE '%$input%' OR students.StudentNo LIKE '%$input%')
        GROUP BY transcript.course;";
        $result = $conn -> query($sql);
        $row = mysqli_num_rows($result);





        if($row > 0)
        {
            for($i = 0; $i < $row; $i++)
            {?>
                <table class="table table-bordered">    
                    <tr class="table" id="tr">
                        <td id="td">StudentNo</td>
                        <td id="td">LastName</td>
                        <td id="td">FirstName</td>
                        <td id="td">Course</td>
                        <td id="td">BirthDate</td>
                        <td id="td">Age</td>
                        <td id="td">Total Units Enrolled</td>
                    </tr>
                    <?php
                        foreach($result as $row)
                        {?>
                            <tr class="table">
                                <td><?php echo ''.$row['StudentNo'].''?></td>
                                <td><?php echo ''.$row['LastName'].''?></td>
                                <td><?php echo ''.$row['FirstName'].''?></td>
                                <td><?php echo ''.$row['course_title'].''?></td>
                                <td><?php echo ''.$row['date'].''?></td>
                                <td><?php echo ''.$row['age'].''?></td>
                                <td><?php echo ''.$row['total'].''?></td>
                            </tr>

                        <?php
                        }

                    ?>
                </table>
               <?php
               break;
            }
        }else{
            echo "<h4 class='text-danger text-center'><strong>NO DATA FOUND</strong></h4>";
        }
            
       
    }
    
?>

