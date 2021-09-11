<?php

/*
* This file should be a secure protected file, which cannot be accessed unless the user
* has successfully logged in with his/her credentials from users.txt.
* 
* This file should display a dashboard with data from the northwind database
*/

include('dbconnect.php');

// Get order date on May 1995
$queryOrder = 'SELECT orders.OrderID, order_details.ProductID, orders.CustomerID, orders.CustomerID, orders.OrderDate, order_details.Quantity FROM orders INNER JOIN order_details ON order_details.OrderID=orders.OrderID Where Month(orders.OrderDate)="05" && YEAR(orders.OrderDate)="1995" GROUP BY order_details.OrderID';

$result = $conn->query($queryOrder);
$totalSales = 0;
$totalQuantity = 0;
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $count = $result->num_rows;
    }
} else {
    echo '0';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootsrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Index</title>
</head>

<body>
    <div class="container" style="margin-top: 20px;">
        <h4>Sales Dashboard</h4>
        <br>
        <h5>May 1995</h5>
        <br>
        <h5>Total sales: <span id="sales"></span></h5>
        <br>
        <h5>Total order: <?php echo $count; ?></h5>
        <br>
        <h5>Daily sales:
        </h5>
        <br>
        <table id="dailySalesTbl">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <?php
            for ($i = 1; $i <= 31; $i++) {
                $dateInitial = "1995-05-" . $i;

                $queryDailySales = "SELECT * FROM orders INNER JOIN order_details ON order_details.OrderID=orders.OrderID WHERE orders.OrderDate='$dateInitial'";

                $result = $conn->query($queryDailySales);
                $totalSales = 0;
                $totalQuantity = 0;
                if ($result->num_rows > 0) {
                    $data = array();
                    while ($row = mysqli_fetch_array($result)) {
                        $count = $result->num_rows;
                        $orderid = $row['OrderID'];
                        $productid = $row['ProductID'];
                        $customerid = $row['CustomerID'];
                        $unitprice = $row['UnitPrice'];
                        $quantity = $row['Quantity'];
                        $discount = $row['Discount'];

                        $price = $unitprice * $quantity;
                        $afterdiscount = $price * (1 - $discount);
                        $totalSales += $afterdiscount;

                        $priceround = round($price, 2);
                        $totalSales = round($totalSales, 2);
                        $count = $result->num_rows;
                    }

                    $data[] = array("totalsales" => $totalSales, "count" => $count, "dateinitial" => $dateInitial);
                    // echo json_encode($data);
                    // echo ("<br>");
                } else {
                    // echo '0';
                }

            ?>

                <tbody id="dailySalesBody">
                    <tr>

                        <td><?php echo $dateInitial; ?></td>
                        <td>RM<?php echo $totalSales; ?></td>
                    </tr>

                </tbody>

            <?php
            }
            ?>
        </table>

        <br>
        <h5>Sales by Product Category: </h5>
        <h5></h5>
        <br>
        <h5>Sales by Customers: </h5>
        <br>
        <h5>Sales by Employees: </h5>
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <?php

            for (
                $i = 1;
                $i <= 9;
                $i++
            ) {
                $employeeid = $i;

                $queryEmpSales = "SELECT * FROM orders INNER JOIN order_details ON order_details.OrderID=orders.OrderID WHERE Month(orders.OrderDate)='05' && YEAR(orders.OrderDate)='1995' && orders.EmployeeID='$employeeid'";

                $result = $conn->query($queryEmpSales);
                $totalSalesEmp = 0;
                $totalQuantity = 0;
                if ($result->num_rows > 0) {
                    $data = array();
                    while ($row = mysqli_fetch_array($result)) {
                        $count = $result->num_rows;
                        $orderid = $row['OrderID'];
                        $productid = $row['ProductID'];
                        $customerid = $row['CustomerID'];
                        $unitprice = $row['UnitPrice'];
                        $quantity = $row['Quantity'];
                        $discount = $row['Discount'];

                        $price = $unitprice * $quantity;
                        $afterdiscount = $price * (1 - $discount);
                        $totalSalesEmp += $afterdiscount;

                        $priceround = round($price, 2);
                        $totalSalesEmp = round($totalSalesEmp, 2);
                        $count = $result->num_rows;
                    }

                    $data[] = array("totalsales" => $totalSalesEmp, "count" => $count, "employeeid" => $employeeid);
                    // echo json_encode($data);
                    // echo "<br>";
                    // echo "<br>";
                } else {
                    // echo '0';
                }
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $employeeid; ?></td>
                        <td><?php echo $totalSalesEmp ?></td>
                    </tr>
                </tbody>

            <?php
            }
            ?>
        </table>
    </div>

    <!-- SRIPT TAG -->
    <script src="js/sales.js"></script>
    <script src="js/dailysales.js"></script>


</body>

</html>