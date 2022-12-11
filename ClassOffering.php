<?php
session_start();

$hasLog = (isset($_SESSION['hasLog'])?$_SESSION['hasLog']:0);
if (empty($hasLog)){
    header("location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<?php
    include('header.php');
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            include('menu.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                    include('nav.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Class Offerings</h1>
                </div>
                
                <div class="container-fluid">
                        
                    <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-16">
                                <div class="float-right">
                                    <?php
                                        $select = "select course.accro, course.id from course;";
                                        $result = $conn -> query($select);
                                        $row = mysqli_fetch_array($result);
                                    ?>
                                    <label for="course" class="mr-2">COURSES:</label>
                                    <select name="course" id="courses">
                                        <?php
                                            foreach($result as $row)
                                            {
                                                echo '
                                                    <option class="selector" id="'.$row['id'].'">'.$row['accro'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    <button class="btn search"><i class="fa fa-search"></i></button>
                                </div>


                                    <?php
                                        $sql = "SELECT courseoffering.coursecode, course.accro, transcript.courseno, course.course_title, transcript.units, courseoffering.student_year, courseoffering.section, COUNT(courseoffering.schedule_time_id) AS available, courseoffering.max_limit, sched1.tym, LEFT(employees.FirstName,1) AS FirstName, employees.LastName, sched2.tym AS tym2
                                        FROM courseoffering
                                        INNER JOIN course ON course.id = courseoffering.courseid
                                        INNER JOIN transcript ON transcript.id = courseoffering.transcriptid 
                                        INNER JOIN schedule_time AS sched1 ON sched1.id = courseoffering.schedule_time_id
                                        INNER JOIN schedule_time AS sched2 ON sched2.id = courseoffering.schedule_time_id2
                                        INNER JOIN employees ON employees.id = courseoffering.employeeid
                                        GROUP BY course.accro, courseoffering.section";  
                                        $results = $conn->query($sql);
                                        
                                    ?>

                                    <table class="table table-bordered" id="t">
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

                                        foreach($results as $row){
                                            $ctr = 1;
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
                                                <td>'.$row['tym'].'<br>'.$row['tym2'].'</td>
                                                <td>'.$row['LastName'].', '.$row['FirstName'].'.</td>
                                            </tr>';
                                            $ctr++;

                                            
                                        }
                                    ?>
                                    </table>
                                </div>
                            </div>
                        </div>

                        
                                    
                    </div>

                    <div id="output"></div>


                <!-- /.container-fluid -->


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script>
       $('.search').on('click', function () {
            var id = $('#courses option:selected').attr('id');
            console.log(id);
            $.ajax({
                type: "POST",
                url: "classofferingsearch.php",
                data: {id:id},
                success: function (data) {
                    $('#output').html(data);
                    $('#t').hide();
                }
            });
       });
    </script>
</body>

</html>