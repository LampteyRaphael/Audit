<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
    <h1>My First Bootstrap Page</h1>
    <p>Resize this responsive page to see the effect!</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <button class="btn btn-danger" onclick="updateChart()">Update</button>
        </div>
        <div class="col-sm-8">
            <canvas id="myChart" width="300%" height="200%"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    var oldData=[0, 10, 5, 2, 20, 30, 45,0, 10, 5, 2, 20, 30, 45];
    var newData=[100, 160, 50, 200, 2660, 360, 645,0, 10, 5, 2, 20, 30, 45];
    var oldDatas=[120, 10, 5, 782, 20, 730, 45,0, 10, 565, 2, 20, 30, 45];
    var newDatas=[100, 160, 50, 200, 2660, 360, 645,0, 10, 5, 2, 20, 30, 45];
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: oldData,
            },

                {
                    label: 'My second dataset',
                    backgroundColor: 'rgb(99,133,255)',
                    borderColor: 'rgb(9,255,169)',
                    data: oldDatas,
                }
            ]
        },

        // Configuration options go here
        options: {}
    });

    function updateChart() {
        chart.data.datasets[0].data=newData;
        chart.data.datasets[0].data=newDatas;
        chart.update();
    }

</script>
</body>
</html>
