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
                        <h1 class="h3 mb-0 text-gray-800">LEARNING OUTCOMES</h1>
                        
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ol>
                                <li>The student will learn how to use the MySQL Functions, Clauses and Statements</li>
                                <li>The student will learn how to integrate CSS, Ajax, MySQL and PHP into web app</li>
                                <li>The student will learn how to generate report</li>
                                <li>The student will learn how to deploy the system in the cloud server</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <h4 class="text-dark">GENERAL INSTRUCTIONS</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ol>
                                <li>I will give you one month to finish activities 6 to 10</li>
                                <li>Your web app will be deployed online, search for a free hosting site</li>
                                <li>Feel free to ask on how to register a free domain site.</li>
                                <li>To ensure that you made the activities, there will be a follow up questions.</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <h4 class="text-dark">MySQL INSTRUCTIONS</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ol>
                                <li>Use any database name.</li>
                                <li>Create a username with Read permission only</li>
                                    <ul>   
                                        <li>username format: firstname</li>
                                        <li>password format: lastname</li>
                                    </ul>
                                <li>use the above credentials in your dbconnection.php</li>
                                <li>dbconnection.php should be inside the directory "db"</li>
                                <li>Only allowed IP should be able to access your database.</li>
                                <li>Restore the database act6to10.sql found in db directory.</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <h4 class="text-dark">PHP INSTRUCTIONS</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ol>
                                <li>Create your activities in localhost</li>
                                <li>Upload the entire files to the cloud once the activities are finish.</li>
                                <li>Use Filezilla or any FTP app to transfer your files from local to cloud.</li>
                            </ol>
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