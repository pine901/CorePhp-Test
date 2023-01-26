<!DOCTYPE html>
<html lang="en">
<head>
  <title>Test</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="View/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
  
<div class="container">
    <!-- Modal -->
  <div class="modal fade" tabindex="-1" id="exampleModal1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">Save Address</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3 >Which address format do you want to save?</h3>
          <ul class="donate-now">
            <li class="original">
              <input type="radio" id="a25" name="amount"  checked/>
              <label for="a25">Original</label>
            </li>
            <li class="standard">
              <input type="radio" id="a50" name="amount" />
              <label for="a50">Standardized (USDT)</label>
            </li>
          </ul>

          <textarea class="form-control address-textarea" id="exampleFormControlTextarea1" rows="5"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id = "saveBtn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <form class="form-horizontal" role="form"  method="post">

        <h1>Address Validator</h1>
        <h2>Validate/Standadizes addresses using USPS</h2>

        <div class="form-group">
          <p class="col-sm-10 help-block">Address Line 1</p>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputAddressLine1" name="address-line1" placeholder="Address Line 1">
          </div>
        </div>

        <div class="form-group">
          <p class="col-sm-10 help-block">Address Line 2</p>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputAddressLine2" name="address-line2" placeholder="Address Line 2">
          </div>
        </div>

        <div class="form-group">
          <p class="col-sm-10 help-block">City</p>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputCityTown" name="city-town" placeholder="City / Town">
          </div>
        </div>

        <div class="form-group">
          <p class="col-sm-10 help-block">State</p>

          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputStateProvinceRegion" name="state-province-region" placeholder="State / Province / Region">
          </div>
        </div>

        <div class="form-group">
          <p class="col-sm-10 help-block">Zip Code</p>

          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputZipPostalCode" name="zip-postal-code" placeholder="Zip / Postal Code">
          </div>
        </div>

        <button type="submit" class="btn-validate" id="btn-submit" data-toggle="modal" data-target="#exampleModal"> VALIDATE</button>
      </form>
      <div class="alert alert-warning alert-dismissible fade show" role="alert" id="error_modal">
        <strong>Error!</strong> Your input data is invalid!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
  </div>
  <div id="demo"></div>
</div>
</body>
  <script>

    var original = "asfdafdadf";
    var standard = "98734928374";

    document.getElementsByName('amount')[0].addEventListener("change", function(event){
            document.getElementById('exampleFormControlTextarea1').value = original;
    });
    document.getElementsByName('amount')[1].addEventListener("change", function(event){
         document.getElementById('exampleFormControlTextarea1').value = standard;
    });
    
    document.getElementById("btn-submit").addEventListener("click", function(event){
        var address1 = document.getElementById('inputAddressLine1').value;
        var address2 = document.getElementById('inputAddressLine2').value;
        var city = document.getElementById('inputCityTown').value;  
        var state = document.getElementById('inputStateProvinceRegion').value;  
        var zipcode = document.getElementById('inputZipPostalCode').value;  
        original = address1 + '\n' + address2+ '\n'+ city+ '\n' + state+ '\n' + zipcode;
        document.getElementById('exampleFormControlTextarea1').value = original;

        event.preventDefault();
        var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "error"){
            $('.alert').removeClass("fade")
            
            const myTimeout = setTimeout(myGreeting, 3000);

            function myGreeting() {
            $('.alert').addClass("fade")
            }

            function myStopFunction() {
            clearTimeout(myTimeout);
            }
        }else{
            $('#exampleModal1').removeClass('fade');
            $('#exampleModal1').modal('show');
            $(".modal-backdrop").css("opacity", 0.6);
            var sAddress1 = JSON.parse(this.responseText).address1["0"];
            console.log(sAddress1);
            var sAddress2 = JSON.parse(this.responseText).address2["0"];
            var sCity = JSON.parse(this.responseText).city["0"];
            var sState = JSON.parse(this.responseText).state["0"];
            var sZipcode = JSON.parse(this.responseText).zip["0"];
            standard = sAddress1 + '\n' + sAddress2+ '\n'+ sCity+ '\n' + sState+ '\n' + sZipcode;
        }

      }
    };
    var params = "address1=" + address1;
    params += "&address2=" + address2;
    params += "&city=" + city;
    params += "&state=" + state;
    params += "&zipcode=" + zipcode;
    xmlhttp.open("POST", "./Controller/controller.php?" + params, true);
    xmlhttp.send();

    });

     document.getElementById("saveBtn").addEventListener("click", function(event){
        var inputText = document.getElementById('exampleFormControlTextarea1').value;
        var arr = inputText.split('\n');
        var address1 = arr[0];
        var address2 = arr[1];
        var city = arr[2];
        var state = arr[3];
        var zipcode = arr[4]
        event.preventDefault();
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "error"){
            alert("Save Error!")
        }else{
           alert("Success!")
        }

      }
    };
    var params = "address1=" + address1;
    params += "&address2=" + address2;
    params += "&city=" + city;
    params += "&state=" + state;
    params += "&zipcode=" + zipcode;
    xmlhttp.open("POST", "./Model/model.php?" + params, true);
    xmlhttp.send();

    });

  </script>
</html>
