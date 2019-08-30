
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        list_cars(this);
    }
};
xhttp.open("GET", "carsXML.xml", true);
xhttp.send();

function list_cars(xml){
    var xmlDoc = xml.responseXML;
    var carList = "";
    var cars = xmlDoc.getElementsByTagName("cars")[0].children;
    var fields = new Array("id","brand","model","model_year","mileage","fuel_type","seats","price_per_day","description","availability");
    for (var i=0; i<cars.length; i++){
        var car = cars[i];
        var car_detail_items = car.children;
        var car_details = new Array(10);
        for(var j=0;j<car_details.length;j++){
            if(car_detail_items[j].nodeName===fields[j]){
                car_details[j] = car_detail_items[j].childNodes[0].nodeValue;
            }else{
                alert("Not valid details.");
                continue;
            }
        }
        carList += "<div class=\"card\" style=\"width:300px; height:600px; float:left; display:inline; margin:10px;\">";
        carList += " <img class=\"card-img-top\" src=\"images/" + car_details[2] + ".jpg\" alt=\"Card image\" style=\"width:100%;height:280px;\">";
        carList += " <div class=\"card-body\">";
        carList += "<h4 class=\"card-title\">" + car_details[1] + " " + car_details[2] + "</h4>";
        carList += "<p class=\"card-text\">";
        carList += "<b>Mileage: </b>" + car_details[4] + " kms<br>";
        carList += "<b>Fuel type: </b>" +  car_details[5] + "<br>";
        carList += "<b>Seats: </b>" +  car_details[6] + "<br>";
        carList += "<b>Price per day: </b>" +  car_details[7] + "<br>";
        carList += "<b>Availability: </b>" +  car_details[9] + "<br>";
        carList += "<p class=\"line-limit-length\"><b>Description: </b>" +  car_details[8] + "</p><br>";
        carList += "<button type=\"button\" class=\"btn btn-primary\" onclick=\"checkAvailability("+car_details[0]+")\">Add to cart</button><br>";
        carList += "</p>";
        carList += " </div>";
        carList += "</div>";
    }
    document.getElementById("container").innerHTML = carList;
}
function checkAvailability(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
             var available = this.responseText;
             console.log(available);
             if(available == "True"){
                alert("Add car to shopping cart successfully");
            }else{
                alert("Sorry, the car is not available now. Please try other cars.");
            }
          }
      };
    xhttp.open("GET", "checkAvailability.php?action=add&id="+id, true);
    xhttp.send();
}
