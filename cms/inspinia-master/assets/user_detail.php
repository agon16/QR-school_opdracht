<?php

    session_start();

    include '../../../backend/config.php';

    if(isset($_POST['deactivate'])) {

        $user_id = $_POST['user_id'];
        $sql = "UPDATE users SET active = 0 WHERE id = '$user_id'";
        $con->query($sql);

        header("Location: home.php");
    } else if(isset($_POST['activate'])) {

        $user_id = $_POST['user_id'];
        $sql = "UPDATE users SET active = 1 WHERE id = '$user_id'";
        $con->query($sql);

        header("Location: home.php");
    } else if(isset($_POST['generate'])) {
        $user_id = $_POST['user_id'];
        
 
    } else if(isset($_POST['recharge'])) {
        $user_id = $_POST['user_id'];
        $amount = $_POST['amount'];

        $sql = "SELECT credits FROM users WHERE id = '$user_id'";
        $query = $con->query($sql);
        $credits = '';
        while ($row = $query->fetch_assoc()) {
            $credits = $row['credits'];
        }

        $credits += $amount; //Sum credits with amount

        //Update creditss
        $sql = "UPDATE users SET credits = '$credits' WHERE id = '$user_id'";
        $con->query($sql);

        header("Location: home.php");
 
    } else if(isset($_GET['id'])) { //If user ID is set in url. Else terminate page
        $user_id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id = '$user_id'";
        $query = $con->query($sql);
        while($result = $query->fetch_assoc()) {
            $id_card = $result['id_card'];
            $firstname = $result['firstname'];
            $lastname = $result['lastname'];
            $birth = $result['birth_date'];
            $gender = ucfirst($result['gender']);
            $active = $result['active'];

            $birth_parts = explode('-', $birth);
            $year = $birth_parts[0];
            $month = $birth_parts[1];
            $day = $birth_parts[2];
            $current_year = date('Y');
            $current_month = date('m');
            $current_day = date('d');

            $date = $year.'-'.$month.'-'.$day;
            $age = '';

            //Calculate age
            $sql_age = "SELECT TIMESTAMPDIFF(YEAR, '$date', CURDATE()) AS age";
            $query_age = $con->query($sql_age);
            while($row = $query_age->fetch_assoc()) {
                $age = $row['age'];
            }

            if($active == 1) {
                $active_text = '<button type="submit" name="deactivate" class="btn btn-w-m btn-danger">Account deactiveren</button>';
                $generate_qrcode = '<button type="submit" name="generate" class="btn btn-w-m btn-primary">Generate QR-Code</button>';
                $credits_text = '<button type="button" class="btn btn-w-m btn-success" data-toggle="modal" data-target="#myModal">Credits opwaarderen</button>';
                $active_status = 'Activated';
            } else {
                $active_text = '<button name="activate" type="submit" class="btn btn-w-m btn-primary">Account activeren</button>';
                $generate_qrcode = '';
                $credits_text = '';
                $active_status = 'Not activated';
            }
        }
        $con->close(); //Close connection
    } else {
        header("Location: 404.php");
    }
    
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Dashboard</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span></span> </a>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li>
                        <a href="home.php"><i class="fa fa-user"></i> <span class="nav-label">Home</a>
                    </li>
                    <li>
                        <a href="qrregistreted.php"><i class="fa fa-qrcode"></i> <span class="nav-label">Qr code registrated</a>
                    </li>
                    <li>
                        <a href="log.php"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Log</a>
                    </li>
                    <li>
                        <a href="statistics.php"><i class="fa fa-line-chart"></i> <span class="nav-label">Statistics</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out"></i> <span class="nav-label">Log out</a>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
        </nav>
        </div>
        <div class="row  border-bottom white-bg dashboard-header">

        </div>
        <div class="row white-bg">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                        <h2>User details</h2>
                        <div class="col-md-3">
                        <ul class="list-group clear-list m-t">
                            <li class="list-group-item fist-item">
                                <span class="pull-right">
                                    <?php echo $id_card; ?>
                                </span>
                                <p><label  style="display: inline-block; width: 100px;" class="">IDnummer</label>:</p>
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    <?php echo $firstname; ?>
                                </span>
                                <p><label  style="display: inline-block; width: 100px;" class="">Firstname</label>:</p>
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    <?php echo $lastname; ?>
                                </span>
                                <p><label  style="display: inline-block; width: 100px;" class="">Lastname</label>:</p>
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    <?php echo $age; ?>
                                </span>
                                <p><label style="display: inline-block; width: 100px;" class="">Age</label>:</p>
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    <?php echo $gender; ?>
                                </span>
                                <p><label style="display: inline-block; width: 100px;" class="">Gender</label>:</p>
                            </li><li class="list-group-item">
                                <span class="pull-right">
                                    <?php echo $active_status; ?>
                                </span>
                                <p><label style="display: inline-block; width: 100px;" class="">Status</label>:</p>
                            </li>
                        </ul>
                        <br>
                        
                        <br>
                        <br>
                        <br>
                    </div>
                    <!-- <div class="col-md-3"></div> -->
                    <div class="col-md-offset-4 col-md-3">
                        <!-- <div style="width: 165px;" class="panel panel-success">
                            <div class="panel-heading">
                                QR code
                            </div>
                            <div class="panel-body">
                                <img style="height: 130px;" src="img/project_img/qrcode.jpg" alt="">
                            </div>
                        </div> -->
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <?php echo $generate_qrcode; ?>
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        </form>
                            <br>
                            <?php echo $credits_text; ?>
                            
                            <br><br>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <?php echo $active_text; ?>
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Voeg credits toe voor de gebruiker</h4>
              </div>
              <div class="modal-body">
                <!-- <img src="qrcode.jpg" width="150" class="img-responsive center-block"> -->
                <div align="center">
                    <p>Geef aan het aantal credits.</p>
                    <input placeholder="5.25" class="form-control" type="text" name="amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0 || event.charCode == 46'>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="recharge" class="btn btn-default">Submit</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>


    <script>
        $(document).ready(function() {


            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#464f88"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 50,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 100,
                    color: "#b5b8cf",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
            };

            var ctx = document.getElementById("doughnutChart").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

            var polarData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 140,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 200,
                    color: "#b5b8cf",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var polarOptions = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: "rgba(255,255,255,0.75)",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
            };
            var ctx = document.getElementById("polarChart").getContext("2d");
            var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

        });
    </script>
</body>
</html>