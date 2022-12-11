<?php
    include_once "db/connection.php";

    if(isset($_POST['search'])){
        $search = $_POST['search'];

        $sql = "SELECT students.StudentNo, students.LastName, students.FirstName, course.course_title, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), students.Birthdate)), '%Y') + 0 AS age, DATE_FORMAT(students.Birthdate, ' %M %d %Y') AS date 
        FROM students
        INNER JOIN course ON course.id = students.CourseID
        WHERE students.FirstName LIKE '%$input%';";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0)
        {?>
            <<table class="table table-bordered" id="table">
                                    <tr class="table" id="tr">
                                        <td id="td">Student No</td>
                                        <td id="td">Last Name</td>
                                        <td id="td">First Name</td>
                                        <td id="td">Course</td>
                                        <td id="td">Birth Date</td>
                                        <td id="td">Age</td>
                                        <td id="td">Total Units Enrolled</td>
                                     </tr>

                                     <?php
                                        foreach($results as $row){
                                            echo 
                                            '<tr>
                                                <td>'.$row['StudentNo'].'</td>
                                                <td>'.$row['LastName'].'</td>
                                                <td>'.$row['FirstName'].'</td>
                                                <td>'.$row['course_title'].'</td>
                                                <td>'.$row['date'].'</td>
                                                <td>'.$row['age'].'</td>
                                                
                                            </tr>';
                                        }
                                    ?>
        <?php
        }
        else{
            echo 'data not found'
        }
    }
?>