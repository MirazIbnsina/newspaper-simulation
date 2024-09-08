<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simulation of Inventory System (Purchase of Newspaper)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }
        h3 {
            font-weight: 600;
            color: #007aff;
        }
        table {
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #007aff;
            color: white;
            font-weight: 600;
        }
        tbody tr:nth-child(odd) {
            background-color: #f2f2f7;
        }
        tbody tr:hover {
            background-color: #e5e5ea;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
error_reporting(0);

if ($_REQUEST['action_type'] == 'final') {
    // from first page
    $rDigit = $_POST['rDigit'];
    $tNewspaper = $_POST['tNewspaper'];
    $pnCost = $_POST['pnCost'];
    $saleRate = $_POST['saleRate'];
    $sRate = $_POST['sRate'];

    // from 2nd page
    $demand = $_POST['demand'];
    $good = $_POST['good'];
    $fair = $_POST['fair'];
    $poor = $_POST['poor'];

    $rdNewsday = $_POST['rdNewsday'];
    $rdDemand = $_POST['rdDemand'];

    $goodNewsday = $_POST['goodNewsday'];
    $fairNewsday = $_POST['fairNewsday'];
    $poorNewsday = $_POST['poorNewsday'];

    // Cumulative probability
    $goodCum = $goodNewsday;
    $fairCum = $goodNewsday + $fairNewsday;
    $poorCum = $goodNewsday + $fairNewsday + $poorNewsday;

    // Random-digit assignment
    $goodMin = 1;
    $goodMax = $goodCum * 100;
    $fairMin = $goodMax + 1;
    $fairMax = $fairCum * 100;
    $poorMin = $fairMax + 1;
    $poorMax = $poorCum * 100;

    // Variable for last table
    $totalPapers = $tNewspaper;
    $totalcost = $tNewspaper * $pnCost;
    $perProfit = $saleRate - $pnCost;
    $salvageRate = $sRate;
    $type = '';
    $revenue = '';
    $maindemand = '';
    $lostProfit = '';
    $salvage = '';
    $profit = '';
}
?>

<div class="container">
    <h3>Simulation Table for Purchase of <?php echo $tNewspaper; ?> Newspapers</h3>

    <div class="row">
        <div class="col-md-6">
            <!-- 1st table -->
            <p>Distribution of Newspaper Demanded</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">Demand</th>
                        <th colspan="3">Cumulative Distribution</th>
                        <th colspan="3">Random-Digit Assignment</th>
                    </tr>
                    <tr>
                        <th>Good</th>
                        <th>Fair</th>
                        <th>Poor</th>
                        <th>Good</th>
                        <th>Fair</th>
                        <th>Poor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sumGood = 0;
                    $sumFair = 0;
                    $sumPoor = 0;
                    for ($i = 0, $count = $rDigit; $i < $count; $i++) {
                    ?>
                        <tr>
                            <td><?php echo $demand[$i]; ?></td>
                            <td><?php $sumGood = $good[$i] + $sumGood;
                                echo $sumGood; ?></td>
                            <td><?php $sumFair = $fair[$i] + $sumFair;
                                echo $sumFair; ?></td>
                            <td><?php $sumPoor = $poor[$i] + $sumPoor;
                                echo $sumPoor; ?></td>

                            <td>
                                <?php
                                if ($i == 0) {
                                    $goodNPMin = 1;
                                } else if ($i > 0) {
                                    $goodNPMin = $goodNPMax + 1;
                                }
                                $goodNPMax = $sumGood * 100;
                                echo $goodNPMin . '-' . $goodNPMax;

                                $dataGood[] = array(
                                    'demand' => $demand[$i],
                                    'min' => $goodNPMin,
                                    'max' => $goodNPMax
                                );
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($i == 0) {
                                    $fairNPMin = 1;
                                } else if ($i > 0) {
                                    $fairNPMin = $fairNPMax + 1;
                                }
                                $fairNPMax = $sumFair * 100;
                                echo $fairNPMin . '-' . $fairNPMax;

                                $dataFair[] = array(
                                    'demand' => $demand[$i],
                                    'min' => $fairNPMin,
                                    'max' => $fairNPMax
                                );
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($i == 0) {
                                    $poorNPMin = 1;
                                } else if ($i > 0) {
                                    $poorNPMin = $poorNPMax + 1;
                                }
                                $poorNPMax = $sumPoor * 100;
                                echo $poorNPMin . '-' . $poorNPMax;

                                $dataPoor[] = array(
                                    'demand' => $demand[$i],
                                    'min' => $poorNPMin,
                                    'max' => $poorNPMax
                                );
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- 2nd table -->
        <div class="col-md-6">
            <p>Random-Digit Assignment for Type of Newsday</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Type of Newsday</th>
                        <th>Probability</th>
                        <th>Cumulative Probability</th>
                        <th>Random-Digit Assignment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Good</td>
                        <td><?php echo $goodNewsday; ?></td>
                        <td><?php echo $goodCum; ?></td>
                        <td><?php echo $goodMin . '-' . $goodMax; ?></td>
                    </tr>
                    <tr>
                        <td>Fair</td>
                        <td><?php echo $fairNewsday; ?></td>
                        <td><?php echo $fairCum; ?></td>
                        <td><?php echo $fairMin . '-' . $fairMax; ?></td>
                    </tr>
                    <tr>
                        <td>Poor</td>
                        <td><?php echo $poorNewsday; ?></td>
                        <td><?php echo $poorCum; ?></td>
                        <td><?php echo $poorMin . '-' . $poorMax; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- lat table -->
    <!-- lat table -->
<p>Simulation Table for Purchase of Newspaper</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Day</th>
            <th>RD for Newsday</th>
            <th>Type of Newsday</th>
            <th>RD for Demand</th>
            <th>Demand</th>
            <th>Revenue</th>
            <th>LP from Excess Demand</th>
            <th>SS of Scrap</th>
            <th>Daily Profit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalRevenue = 0;
        $totalLP = 0;
        $totalSalvage = 0;
        $totalProfit = 0;
        for ($i = 0; $i < $rDigit; $i++) {
        ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $rdNewsday[$i]; ?></td>
                <td>
                    <?php
                    if ($rdNewsday[$i] >= $goodMin && $rdNewsday[$i] <= $goodMax) {
                        echo 'Good';
                        $type = 'Good';
                    } elseif ($rdNewsday[$i] >= $fairMin && $rdNewsday[$i] <= $fairMax) {
                        echo 'Fair';
                        $type = 'Fair';
                    } else {
                        echo 'Poor';
                        $type = 'Poor';
                    }
                    ?>
                </td>
                <td><?php echo $rdDemand[$i]; ?></td>
                <td>
                    <?php
                    $maindemand = 0;
                    if ($type == 'Good') {
                        $data = $dataGood;
                    } elseif ($type == 'Fair') {
                        $data = $dataFair;
                    } else {
                        $data = $dataPoor;
                    }
                    
                    foreach ($data as $row) {
                        if ($rdDemand[$i] >= $row['min'] && $rdDemand[$i] <= $row['max']) {
                            $maindemand = $row['demand'];
                            break;
                        }
                    }
                    echo $maindemand;
                    ?>
                </td>
                <td>
                    <?php
                    $revenue = $maindemand * $saleRate;
                    echo $revenue;
                    $totalRevenue += $revenue;
                    ?>
                </td>
                <td>
                    <?php
                    $lostProfit = max(0, ($maindemand - $totalPapers) * $perProfit);
                    echo $lostProfit;
                    $totalLP += $lostProfit;
                    ?>
                </td>
                <td>
                    <?php
                    $salvage = max(0, ($totalPapers - $maindemand) * $salvageRate);
                    echo $salvage;
                    $totalSalvage += $salvage;
                    ?>
                </td>
                <td>
                    <?php
                    $profit = $revenue - $totalcost + $salvage - $lostProfit;
                    echo $profit;
                    $totalProfit += $profit;
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<div class="row">
    <div class="col-md-6">
        <p>Total Revenue: <?php echo $totalRevenue; ?></p>
        <p>Total Lost Profit from Excess Demand: <?php echo $totalLP; ?></p>
    </div>
    <div class="col-md-6">
        <p>Total Salvage: <?php echo $totalSalvage; ?></p>
        <p>Total Profit: <?php echo $totalProfit; ?></p>
    </div>
</div>