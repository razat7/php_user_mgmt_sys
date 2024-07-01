<?php
require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';

$count = new Admin();
?>

<div class="row">
   <div class="col-lg-12">
    <div class="card-deck mt-3 text-light text-center font-weight-bold">
        <div class="card bg-primary">
            <div class="card-header"> Total Users </div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount('users'); ?>
                    </h1>
                </div>
        </div>
        <div class="card bg-primary">
            <div class="card-header"> Verified Users </div>
                <div class="card-body">
                    <h1 class="display-4">
                    <?= $count->verified_users('1'); ?>
                    </h1>
                </div>
        </div>
        <div class="card bg-primary">
            <div class="card-header"> Unverified Users </div>
                <div class="card-body">
                    <h1 class="display-4">
                    <?= $count->verified_users('0'); ?>
                    </h1>
                </div>
        </div>
        <div class="card bg-primary">
            <div class="card-header">Website Hits </div>
                <div class="card-body">
                    <h1 class="display-4">
                    <?php $data = $count->hitsCount(); echo $data['hits']; ?>
                    </h1>
                </div>
        </div>
    </div>
   </div>
</div>

<div class="row">
    <div class="col-lg-12">
    <div class="card-deck mt-3 text-light text-center font-weight-bold"> 
        <div class="card bg-primary">
            <div class="card-header">Total Notes</div>
            <div class="card-body">
                <h1 class="display-4">
                <?= $count->totalCount('notes'); ?>
                </h1>
            </div>
        </div>

        <div class="card bg-primary">
            <div class="card-header">Total Feedback</div>
            <div class="card-body">
                <h1 class="display-4">
                <?= $count->totalCount('feedbak'); ?>
                </h1>
            </div>
        </div>

        <div class="card bg-primary">
            <div class="card-header">Total Notification</div>
            <div class="card-body">
                <h1 class="display-4">
                <?= $count->totalCount('notification'); ?>
                </h1>
            </div>
        </div>
    </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-deck my-3">

            <div class="card border-success">
                 <!--Div that will hold the pie chart-->
                <div class="card-header bg-success text-center text-white lead">
                    Male / Female User's Percentage
                </div>
                <div id="chartOne" style="width: 99%; height:400px;"> </div>
            </div>

            <div class="card border-success">
                 <!--Div that will hold the pie chart-->
                <div class="card-header bg-success text-center text-white lead">
                   Verified / Unverified User's Percentage
                </div>
                <div id="chartTwo" style="width: 99%; height:400px;"> </div>
            </div>

        </div>
    </div>
</div>
<!-- Footer Area -->
            </div>
        </div>
    </div>
     <!--Load the AJAX API-->
    <script type="text/javascript" src="assets/js/loader.js"></script>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

         // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(pieChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function pieChart(){

             // Create the data table.
            var data = google.visualization.arrayToDataTable([
                ['Gender', 'Number'],
                <?php 
                $gender = $count->genderPer();
                foreach ($gender as $row){
                    echo '["'.$row['gender'].'",'.$row['number'].'],';
                }
                ?>
                ]);

                // Set chart options
                var options = {
                    is3D: false
                };

                  // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('chartOne'));
                chart.draw(data, options);
              
        }
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(piebar);
        function piebar(){
            var data = google.visualization.arrayToDataTable([
                ['Verified', 'Number'],
                <?php 
                $verified = $count->verifiedPer();
                foreach ($verified as $row){
                    echo '["'.$row['verified'].'", '.$row['number'].'],';
                }
                ?>
            ]);
            var options = {
                is3D:false
            };
            var chart = new google.visualization.PieChart(document.getElementById('chartTwo'));
            chart.draw(data, options);

        }
    </script>
</body>
</html>