<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simulation of Inventory System (Purchase of Newspaper)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h3 {
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        p {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
            color: #555;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }
        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
        }
        .table th, .table td {
            padding: 12px;
            text-align: center;
            border-top: 1px solid #ddd;
        }
        .table th {
            background-color: #f1f1f1;
            color: #555;
            font-weight: 600;
        }
        .btn-primary {
            background-color: #007aff;
            border-color: #007aff;
            font-size: 18px;
            font-weight: 600;
            border-radius: 12px;
            padding: 12px 20px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #005ecb;
            border-color: #005ecb;
        }
    </style>
</head>
<body>
<?php 
if ($_REQUEST['action_type'] == 'step2') {
    $nDemand = $_POST['nDemand'];
    $rDigit = $_POST['nDemand'];
    $tNewspaper = $_POST['tNewspaper'];
    $pnCost = $_POST['pnCost'];
    $saleRate = $_POST['saleRate'];
    $sRate = $_POST['sRate'];
}
?>

<div class="container">

    <h3>Simulation Table for Purchase of <?php echo $tNewspaper; ?> Newspapers</h3>

    <form action="final.php" method="POST">

        <div class="row">
            <div class="col-md-6">
                <p>Distribution of Newspaper Demanded</p>            
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Demand</th>
                            <th>Good</th>
                            <th>Fair</th>
                            <th>Poor</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        for ($i = 0, $iMaxSize = $nDemand; $i < $iMaxSize; $i++) {
                    ?>
                        <tr>
                            <td><input type="text" class="form-control" name="demand[]" ></td>
                            <td><input type="text" class="form-control" name="good[]" ></td>
                            <td><input type="text" class="form-control" name="fair[]" ></td>
                            <td><input type="text" class="form-control" name="poor[]" ></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <p>Random-Digit Assignment for Type of Newsday</p>            
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Type of Newsday</th>
                            <th>Probability</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Good</td>
                            <td><input type="text" class="form-control" name="goodNewsday"></td>
                        </tr>
                        <tr>
                            <td>Fair</td>
                            <td><input type="text" class="form-control" name="fairNewsday"></td>
                        </tr>
                        <tr>
                            <td>Poor</td>
                            <td><input type="text" class="form-control" name="poorNewsday"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <p>Random-Digit Assignment for Type of Newsday & Demand</p>            
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Random Digit for Type of Newsday</th>
                            <th>Random Digit for Demand</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        for ($i = 0, $iMaxSize = $rDigit; $i < $iMaxSize; $i++) {
                    ?>
                        <tr>
                            <td><input type="text" class="form-control" name="rdNewsday[]"></td>
                            <td><input type="text" class="form-control" name="rdDemand[]"></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>

        <input type="hidden" name="rDigit" value="<?php echo $rDigit; ?>">
        <input type="hidden" name="tNewspaper" value="<?php echo $tNewspaper; ?>">
        <input type="hidden" name="pnCost" value="<?php echo $pnCost; ?>">
        <input type="hidden" name="saleRate" value="<?php echo $saleRate; ?>">
        <input type="hidden" name="sRate" value="<?php echo $sRate; ?>">
        <input type="hidden" name="action_type" value="final">
        <input type="submit" name='submit' value="Show Result" class='btn btn-primary'/>

    </form>

</div>

</body>
</html>
