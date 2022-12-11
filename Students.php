<?php
session_start();

$hasLog = (isset($_SESSION['hasLog'])?$_SESSION['hasLog']:0);
if (empty($hasLog)){
    header("location: login.php");
    exit;
}

//pagination



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
                        <h1 class="h3 mb-0 text-gray-800">Students</h1>
                        
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="right">
                            <button type ="submit" class="btn btn-primary float-right mr-4 mb-2" name = "saveadd" id="search">Search</button><input type="text" name = acro class = "mr-2 float-right" id="txtsearch"> <i class="fa fa-search float-right mr-3 mt-2"></i>
                            </div>
                            <?php
                                if(isset($_GET['page_no']) && $_GET['page_no'] !== '')
                                {
                                    $page = $_GET['page_no'];
                                }else{
                                    $page = 1;
                                }
                                
                                $prevpage = $page - 1;
                                $nextpage = $page + 1;
                                $totalPage = 50;
                                $offset = ($page -1) * $totalPage;

                                $resultcount = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM students;");
                                $records = mysqli_fetch_array($resultcount);
                                $total_records = $records['total_records'];

                                $totalpages = ceil($total_records / $totalPage);





                                $sql = "SELECT students.StudentNo, students.LastName, students.FirstName, course.course_title, TIMESTAMPDIFF(YEAR, STR_TO_DATE(students.Birthdate,'%m %d %Y'), CURDATE()) AS age, students.Birthdate As date, SUM(transcript.units) AS total
                                FROM students
                                INNER JOIN course ON course.id = students.CourseID
                                INNER JOIN transcript ON transcript.course = course.id
                                GROUP BY students.StudentNo
                                ORDER BY LastName ASC
                                LIMIT $offset, $totalPage";
                                $results = $conn -> query($sql);
                                $row = mysqli_fetch_assoc($results);
                            ?>
                            <div id="showtable"></div>
                            <table class="table table-bordered" id="table">
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
                                                <td>'.$row['total'].'</td>
                                            </tr>';
                                        }
                                    ?>
                            </table>
                            

                            
                            

                            <div id="output" class="mb-5 mt-5"></div>
                            
                            
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <div class="p-10 text-center" id="page">
                <strong>Page <?= $page;?> of <?=$totalPage;?></strong>
            </div>
            <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link <?= ($page <= 1)? 'disabled': '';?>" <?=($page > 1)? 'href=?page_no='.$prevpage : '';?>>Previous</a></li>

                    <li class="page-item"><a class="page-link <?= ($page >= $totalpages)? 'disabled': '';?>" <?=($page < $totalpages)? 'href=?page_no='.$nextpage : '';?>>Next</a></li>
                </ul>
            </nav>
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
         $('#search').on('click', function (e) {
            e.preventDefault();
            var search = $('#txtsearch').val();
            
            if(search != ""){
                $.ajax({
                type: "POST",
                url: "studentsearch.php",
                data: {search:search},
                success: function (data) {
                    $('#output').html(data);
                    $('#table').hide();
                    $('#page').hide();
                    $('.pagination').hide();
                }
            });
            }else {
                $('#output').hide();
                $('#table').show();
            }
           
        
        });

    </script>

</body>

</html>