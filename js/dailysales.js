$(document).ready(function() {
    console.log("Connected to dailysales.js");

    totalDailySales();

    function totalDailySales() {

        outputDaily = "";
        $.ajax({
            type: "GET",
            url: "dailysales.php ",
            dataType: "JSON",
            success: function(data) {

                var x;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }

                for (var i = 0; i < x.length; i++) {

                    outputDaily += "<tr><td>" + x[i].totalsales + "</td></tr>";
                    console.log(x[i].totalsales);

                }
                console.log(x);

                $("#dailySalesBody").append(outputDaily);

            }
        });
    }
});