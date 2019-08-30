
<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <style type="text/css">
        .header-cell{
            width: 100%;
            height: 90px;
            background: #555555;
            color: white;
            padding: 20px;
            column-span: all;
            -webkit-column-span: all;
        }
            .upper{width:100%; height:100px; background-color: #000;}
       </style>
       <style>
       table {
         font-family: arial, sans-serif;
         border-collapse: collapse;
         width: 100%;
       }
       td, th {
         border: o solid #dddddd;
         text-align: center;
         padding: 8px;
       }
       tr:nth-child(even) {
         background-color: #dddddd;
       }
       </style>
       <script type="text/javascript">
            function delete_item(id, row){
                var table=document.getElementById("cart_tab");
                table.deleteRow(row);
                if(table.rows.length<=1){
                    table.parentNode.removeChild(table);
                    document.getElementById("cart_div").innerHTML="<h2>Shopping cart is empty</h2>";
                }
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                      }
                  };
                xhttp.open("GET", "checkAvailability.php?action=delete&id="+id, true);
                xhttp.send();
            }

            function check_cart(){
                var table=document.getElementById("cart_tab");
                if(table==null || table.rows.length<=1){
                    alert("No items to be checked out.");
                }else{
//                    window.location.href="checkout.php";
                    window.navigate("checkout.php");
                }
            }
        </script>
    </head>
    <body>

        <div class="upper">
            <div class="header-cell">
                <table width="100%">
                    <tr>
                        <td width="15%" align="left">
                          <h2 style="color: white;">Hertz-UTS</h2>
                        </td>
                        <td width="70" align="center">
                            <h1 style="color: white;">Shopping Cart</h1>
                        </td>
                        <td width="15%" align="center">
                            <button type="button" class="btn btn-primary" onclick="window.location.href='carsHomePage.php'">Continue Selection</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
                <?php
                session_start();
                if (empty($_SESSION["cart"])){
                    echo '<div class="container text-center">';
                    echo '<h2>No car has been reserved.</h2>';
                    echo '<a href="carsHomePage.php" class="btn btn-primary">Back to Home</a></div>';
                }else{
                    echo '<form id="checkoutForm" method="post" action="checkout.php">';
                    echo '<div class="container">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Thumbnail</th>
                                        <th scope="col">Vehicle</th>
                                        <th scope="col">Price Per Day</th>
                                        <th scope="col">Rental Days</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
                    foreach ($_SESSION["cart"] as $id => $item) {
                       // $rentalPrice =  $item["RentalDays"] * $item["PricePerDay"];
                        echo '<tr>';
                        echo '<td class="align-middle" scope="row"><img style="width: 80px; height: 80px;" class="img-thumbnail" src="images/'.$item["Model"].'.jpg"></td>';
                        echo '<td class="align-middle" class="align-middle">'.$item["Year"].'-'.$item["Brand"].'-'.$item["Model"].'</td>';
                        echo '<td class="align-middle">'.$item["PricePerDay"].'</td>';
                        echo '<td class="align-middle"><input name="rentalDays[]" type="number" required max="300" min="1" value="'.$item["RentalDays"].'" </td>';
                        // echo '<td class="align-middle"> $'. $rentalPrice .' </td>';
                        echo '<td class="align-middle"><button type="submit" onclick="document.getElementById(\'deleteId\').value=' . $id . '" class="btn btn-danger" form="deleteForm">Delete</button></td></tr>';
                    }

                    echo '</tbody></table>
                    <div class="text-right">
                        <button type="submit" form="checkoutForm" class="btn btn-primary">Processing to Checkout</button>
                    </div></div></form>';

                }
                ?>
        <form id="deleteForm" method="post" action="deleteCar.php">
            <input hidden name="id" id="deleteId" value="">
        </form>
            </form>
        </div>
    </body>
</html>
