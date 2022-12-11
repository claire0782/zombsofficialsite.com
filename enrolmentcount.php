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
                        <h1 class="h3 mb-0 text-gray-800">Enrolment Count</h1>
                        
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <style>
                                table{
                                    border-collapse: collapse; 
                                        width: 100%;
                                        text-align: center;
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
                                .document{
                            font-family: Cambria;
                                }
                                .first-para{
                                    font-size: 16px;
                                }
                                .master-list{
                                    font-size: 20px;
                                    font-weight: 900;
                                }
                                .float-right{
                                    padding-top: 10px;
                                }
                                .date{
                                    float: right;
                                }
                                .inline p{
                                    display: inline-block;
                                }
                            
                            </style>
                            <div class="document" id="document">
                                <p class="first-para"><b>SOUTHERN LEYTE STATE UNIVERSITY</b><br> Main Campus <br>Sogod, Southern Leyte</p><br>
                                <h1 class="master-list">Enrollment Count</h1><br>
                                
                                <div class="inline">
                                    <p class="last-para">School Year: 2022 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Semester 1st</p> <p class="date">Data as of&nbsp<?php date_default_timezone_set('Asia/Kolkata');
                                                                        $date = date('F d, Y');
                                                                        echo $date;?></p>
                                </div>
                               
                               

                                
                                
                            <table class="center">
                                <tr>
                                    <td>COURSE</td>
                                    <td colspan="2">1st Year</td>
                                    <td colspan="2">2nd Year</td>
                                    <td colspan="2">3rd Year</td>
                                    <td colspan="2">4th Year</td>
                                    <td colspan="2">Total</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>MALE</td>
                                    <td>FEMALE</td>
                                    <td>MALE</td>
                                    <td>FEMALE</td>
                                    <td>MALE</td>
                                    <td>FEMALE</td>
                                    <td>MALE</td>
                                    <td>FEMALE</td>
                                    <td>MALE</td>
                                    <td>FEMALE</td>
                                </tr>
                                <tr>
                                    <td>BSCrim</td>
                                    <td>2</td>
                                    <td>5</td>
                                    <td>10</td>
                                    <td>25</td>
                                    <td>12</td>
                                    <td>25</td>
                                    <td>14</td>
                                    <td>1</td>
                                    <td>38</td>
                                    <td>56</td>
                                </tr>
                                <tr>
                                    <td>BSInfoTech</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                    <td>16</td>
                                    <td>20</td>
                                </tr>
                        
                                <?php
                                    $course = "SELECT course.accro, registration.StudentYear, 
                                    COUNT(DISTINCT IF(students.Sex LIKE 'M%' AND registration.StudentYear = '1', students.StudentNo, NULL)) AS firstMale,
                                    COUNT(DISTINCT IF(students.Sex LIKE 'F%' AND registration.StudentYear = '1', students.StudentNo, NULL)) AS firstFemale,
                                    COUNT(DISTINCT IF(students.Sex LIKE 'M%' AND registration.StudentYear = '2', students.StudentNo, NULL)) AS secondMale,
                                    COUNT(DISTINCT IF(students.Sex LIKE 'F%' AND registration.StudentYear = '2', students.StudentNo, NULL)) AS secondFemale,
                                    COUNT(DISTINCT IF(students.Sex LIKE 'M%' AND registration.StudentYear = '3', students.StudentNo, NULL)) AS thirdMale,
                                    COUNT(DISTINCT IF(students.Sex LIKE 'F%' AND registration.StudentYear = '3', students.StudentNo, NULL)) AS thirdFemale,
                                    COUNT(DISTINCT IF(students.Sex LIKE 'M%' AND registration.StudentYear = '4', students.StudentNo, NULL)) AS fourthMale,
                                    COUNT(DISTINCT IF(students.Sex LIKE 'F%' AND registration.StudentYear = '4', students.StudentNo, NULL)) AS fourthFemale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'M%', students.StudentNo, NULL)) AS totalMale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'F%', students.StudentNo, NULL)) AS totalFemale
                                    FROM course
                                    INNER JOIN registration ON registration.Course = course.id
                                    INNER JOIN students ON students.StudentNo = registration.StudentNo
                                    GROUP BY course.id;";
                                    $result = $conn -> query($course);
                                    $row = mysqli_fetch_array($result);
                                    foreach($result as $row){
                                        echo '
                                        <tr>
                                            <td>'.$row['accro'].'</td>
                                            <td>'.$row['firstMale'].'</td>
                                            <td>'.$row['firstFemale'].'</td>
                                            <td>'.$row['secondMale'].'</td>
                                            <td>'.$row['secondFemale'].'</td>
                                            <td>'.$row['thirdMale'].'</td>
                                            <td>'.$row['thirdFemale'].'</td>
                                            <td>'.$row['fourthMale'].'</td>
                                            <td>'.$row['fourthFemale'].'</td>
                                            <td>'.$row['totalMale'].'</td>
                                            <td>'.$row['totalFemale'].'</td>
                                        </tr>';

                                    }
                                    $totalsql = "SELECT course.accro, 
                                    COUNT(DISTINCT IF (students.Sex LIKE 'M%' AND registration.StudentYear = '1', students.StudentNo, NULL)) as totalfirstmale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'F%' AND registration.StudentYear = '1', students.StudentNo, NULL)) as totalfirstfemale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'M%' AND registration.StudentYear = '2', students.StudentNo, NULL)) as totalsecondmale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'F%' AND registration.StudentYear = '2', students.StudentNo, NULL)) as totalsecondfemale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'M%' AND registration.StudentYear = '3', students.StudentNo, NULL)) as totalthirdmale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'F%' AND registration.StudentYear = '3', students.StudentNo, NULL)) as totalthirdfemale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'M%' AND registration.StudentYear = '4', students.StudentNo, NULL)) as totalfourthmale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'F%' AND registration.StudentYear = '4', students.StudentNo, NULL)) as totalfourthfemale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'M%', students.StudentNo, NULL)) as totalmale,
                                    COUNT(DISTINCT IF (students.Sex LIKE 'F%', students.StudentNo, NULL)) as totalfemale
                                    FROM course
                                    INNER JOIN registration ON registration.Course = course.id
                                    INNER JOIN students ON students.StudentNo = registration.StudentNo;";
                                    $totalresult = $conn -> query($totalsql);
                                    ?>
                                        <td>Total</td>
                                        <?php
                                            foreach($totalresult as $totalrow){
                                                echo'
                                                <td>'.$totalrow['totalfirstmale'].'</td>
                                                <td>'.$totalrow['totalfirstfemale'].'</td>
                                                <td>'.$totalrow['totalsecondmale'].'</td>
                                                <td>'.$totalrow['totalsecondfemale'].'</td>
                                                <td>'.$totalrow['totalthirdmale'].'</td>
                                                <td>'.$totalrow['totalthirdfemale'].'</td>
                                                <td>'.$totalrow['totalfourthmale'].'</td>
                                                <td>'.$totalrow['totalfourthfemale'].'</td>
                                                <td>'.$totalrow['totalmale'].'</td>
                                                <td>'.$totalrow['totalmale'].'</td>';
                                                
                                            }
                                        ?>
                                    <?php
                                ?>
                            </table>
                               
                            </div>
                            

                            <button class="btn btn-primary mt-3" id="print-image"> PRINT THIS</button>

                            
                        </div>
                    </div>
                    
                </div>
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

</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
<script>
     var options = {
            importCSS: false,
            importStyle: true
        }
    $('#print-image').click(function (e) {
            e.preventDefault();
            $('#document').printThis(options);
        });
</script>