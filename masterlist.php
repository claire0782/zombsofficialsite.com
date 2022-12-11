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
                        <h1 class="h3 mb-0 text-gray-800">Masterlist</h1>
                        
                    </div>

                    
                    <style>
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
                       
                       .float{
                            float: right;
                       }
                    </style>
                    <div class="float">
                        <form method="GET">
                            <label for="course"> <i class="fa fa-search"></i> Search Course:</label> 
                            <input type="text" id="search-course" name='course'>
                            <button class="btn btn-primary ml-3" id="search">SEARCH</button>
                        </form>
                    </div>
                    <?php
                       $courseResult = isset($_GET['course'])

                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="document" id="document">
                                <p class="first-para"><b>SOUTHERN LEYTE STATE UNIVERSITY</b><br> Main Campus <br>Sogod, Southern Leyte</p><br>
                                <h1 class="master-list">Masterlist by coursecode</h1><br>
                                <p class="float">Units: 3 <br> Schedule: iLab-3 TF 05:30 PM 06:30 PM/ <br> ICT-3 TF 06:30 PM 8:30 PM</p>
                                <form method="get">
                                <p class="second-para">Course Code:<?$courseResult?><br> Course No: IT 301L <br> Course Title: Advance DB Systems <br> Instructor: Nestnie D. Honrada</p>
                                </form>
                               
                                <p class="last-para">School Year: 2022 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Semester 1st</p>

                                
                                <div id="result"></div>
                               
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
    <script>

        $('#search').on('click', function (e) {
            e.preventDefault();
            var course = $('#search-course').val();
            if(course != ""){
                $.ajax({
                type: "GET",
                url: "masterajax.php",
                data: {course:course},
                success: function (data) {
                    $('#document').html(data);
                }
            });
            }

        });


        var options = {
            importCSS: false,
            importStyle: true
        }
        $('#print-image').click(function (e) {
            e.preventDefault();
            $('#document').printThis(options);
        });
    </script>

</body>

</html>