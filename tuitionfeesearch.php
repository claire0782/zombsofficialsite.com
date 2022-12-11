<?php
    include "connection.php";

    if(isset($_POST['search']))
    {
        $input = $_POST['search'];

        $sql = "SELECT students.StudentNo, students.LastName, students.FirstName
        FROM students
        WHERE (students.FirstName LIKE '%$input%' OR students.LastName LIKE '%$input%' OR students.StudentNo LIKE '%$input%')";
        $result = $conn -> query($sql);

        if(mysqli_num_rows($result) > 0)
        {?>
            <table class="table table-bordered">
                    <tr class="table" id="tr">
                        <td id="td">Student No</td>
                        <td id="td">Name</td>
                        <td id="td">Lab Fee</td>
                        <td id="td">Tuition Fee</td>
                        <td id="td">Amount Due</td>
                        <td id="td">Total Paid</td>
                        <td id="td">Balance</td>
                    </tr>
            <?php
                foreach($result as $row)
                {
                    echo '<tr>
                            <td>'.$row['StudentNo'].'</td>
                            <td>'.$row['LastName'].','.$row['FirstName'].'</td>
                        </tr>';
                }
            ?>
            
        <?php
        }else {
            echo "<h4 class='text-danger text-center'><strong>NO DATA FOUND</strong></h4>";
        }

       
    }
    
?>
