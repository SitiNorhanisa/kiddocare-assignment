$(document).ready(function() {

    console.log("Connected to sales.js");
    totalSales();

    function totalSales() {

        output = "";
        $.ajax({
            type: "GET",
            url: "sales.php",
            dataType: "JSON",
            success: function(data) {

                var x;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }

                for (var i = 0; i < x.length; i++) {

                    output +=
                        x[i].totalsales + "<br>" + x[i].count + "<br>";

                }

                $("#sales").append(output);

            }
        });
    }
});