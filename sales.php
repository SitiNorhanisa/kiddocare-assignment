<?php

include("dbconnect.php");
// Get total sales on May 1995
$queryProduct = 'SELECT * FROM orders INNER JOIN order_details ON order_details.OrderID=orders.OrderID Where Month(orders.OrderDate)="05" && YEAR(orders.OrderDate)="1995"';

$result = $conn->query($queryProduct);
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
        // $data[] = array("orderId" => $orderid, "productid" => $productid, "customerid" => $customerid, "price" => $priceround, "totalsales" => $totalsalesround, "count" => $count);
    }
    $data[] = array("totalsales" => $totalsalesround, "count" => $count);
    echo json_encode($data);
} else {
    echo '0';
}
