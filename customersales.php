<?php

include("dbconnect.php");
// Get total sales on May 1995
$queryCustSales = "SELECT DISTINCT orders.CustomerID FROM orders WHERE Month(orders.OrderDate)='05' && YEAR(orders.OrderDate)='1995'";

// for ($i = 1; $i <= 9; $i++) {
//     $employeeid = $i;

// $queryCustSales = "SELECT * FROM orders INNER JOIN order_details ON order_details.OrderID=orders.OrderID WHERE Month(orders.OrderDate)='05' && YEAR(orders.OrderDate)='1995' && orders.EmployeeID='$employeeid'";

$result = $conn->query($queryCustSales);
$totalSales = 0;
$totalQuantity = 0;
if ($result->num_rows > 0) {
    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        $count = $result->num_rows;
        $custID = $row['CustomerID'];

        echo $result->num_rows . "<br>";
        echo $custID . "<br>";

        $queryCust2 = "SELECT * FROM orders INNER JOIN order_details ON order_details.OrderID=orders.OrderID WHERE orders.CustomerID='$custID' && Month(orders.OrderDate)='05' && YEAR(orders.OrderDate)='1995'";
        $result2 = $conn->query($queryCust2);
        while ($row2 = mysqli_fetch_array($result2)) {
            $rowCount =
                $result2->num_rows;
            $orderid = $row2['OrderID'];
            $productid = $row2['ProductID'];
            $customerid = $row2['CustomerID'];
            $unitprice = $row2['UnitPrice'];
            $quantity = $row2['Quantity'];
            $discount = $row2['Discount'];

            $price = $unitprice * $quantity;
            $afterdiscount = $price * (1 - $discount);
            $totalSales += $afterdiscount;

            $priceround = round($price, 2);
            $totalsalesround = round($totalSales, 2);
            $count = $result->num_rows;
        }


        $data[] = array("totalsales" => $totalsalesround, "count" => $rowCount, "customerid" => $customerid);
    }
    // $data[] = array("orderId" => $orderid, "productid" => $productid, "customerid" => $customerid, "price" => $priceround, "totalsales" => $totalsalesround, "count" => $count, "dateinitial" => $dateInitial);
    // $data[] = array("totalsales" => $totalsalesround, "count" => $count, "customerid" => $customerid);
    echo json_encode($data);
    echo "<br>";
    // echo "<br>";
} else {
    echo '0';
}
// }
