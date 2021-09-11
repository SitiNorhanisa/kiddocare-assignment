<?php

include("dbconnect.php");
// Get total sales on May 1995
// $queryDailySales = 'SELECT * FROM orders INNER JOIN order_details ON order_details.OrderID=orders.OrderID Where Month(orders.OrderDate)="05" && YEAR(orders.OrderDate)="1995"';

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
            $totalsalesround = round($totalSales, 2);
            $count = $result->num_rows;

            // $data[] = array("orderId" => $orderid, "productid" => $productid, "customerid" => $customerid, "price" => $priceround, "totalsales" => $totalsalesround, "count" => $count, "dateinitial" => $dateInitial);

        }
        // $data[] = array("orderId" => $orderid, "productid" => $productid, "customerid" => $customerid, "price" => $priceround, "totalsales" => $totalsalesround, "count" => $count, "dateinitial" => $dateInitial);
        $data[] = array("totalsales" => $totalsalesround, "count" => $count, "dateinitial" => $dateInitial);
        echo json_encode($data);
        // echo "<br>";
        // echo "<br>";
    } else {
        echo '0';
    }
}
