<?php
session_start();

require_once('../../controllers/AuthController.php');
require_once('../../HijriDateLib/hijri.class.php');
require_once('../../controllers/DataHandlingController.php');
require_once('../../controllers/DataValidationController.php');
require_once('../../controllers/DBController.php');
require_once '../../vendor/autoload.php';
require_once("../../includes/fun.php");
require_once('../../includes/header.php');
require_once('../../includes/nav.php');
?>

<main >
    <div class="text-center my-4">
        <h3>مواقيت الصلاة</h3>
    </div>

    <div class="container" dir='rtl'>
    <form class="my-2" id='setSalat' action='./salat.php'  method="get" >
        <div id="loginErrs" class="form-text bg-danger text-white"></div>
        <div class="row justify-content-around">
            <div class="mb-3 col-md-4 col-12">
                <label for="country" class="form-label"> البلد</label>
                <select class="form-control" name="country" id="country" onclick="getCities(this.value)">
                </select>
            </div>
            <div class="mb-3 col-md-4 col-12">
                <label for="city" class="form-label">المدينة</label>
                <select class="form-control " name="city" id="city">
                </select>

            </div>
            <div class="mb-3 col-md-4 col-12 align-content-end">
                <button id="submit" id='' class="btn btn-primary d-inline mr-4 submit_btn" >دخول</button>
            </div>
        </div>
        
        
    </form>
    <div id='salat' class="row  justify-content-between justify-content-sm-center align-items-around my-5" dir='rtl'>
        
    
      
        
    </div>
   
</div>

</main>

<?php require_once('../../includes/footer.php'); ?>

<script>
    
  let url = "https://countriesnow.space/api/v0.1/countries";
  $.ajax({
    type: "get",
    url: url,
    data: null,
    dataType: "JSON",
    success: function (data) {
      var index = 0;
    
    $('#country').empty();

      for (country in data.data) {
        $('#country').append(` <option value="${data.data[index].country}" class="text-center" >${data.data[index].country}</option>`)
          index++;
          
        }
      
    },
  });


  function getCities(country_) {
        let url = "https://countriesnow.space/api/v0.1/countries";
        $.ajax({
            type: "get",
            url: url,
            data: null,
            dataType: "JSON",
            success: function (data) {
            var index = 0;
            var index_ = 0;
            
            $('#city').empty();

            for (country in data.data) {
                // console.log(data.data[index].country)
                if(data.data[index].country == country_)
                {
                    console.log(data.data[index].cities)
                    for (city in data.data[index].cities) {
                    $('#city').append(` <option value="${data.data[index].cities[index_]}" class="text-center" >${data.data[index].cities[index_]}</option>`)
                index_++;
                }}
                index++;
                
                }
            
            },
        });
        }
</script>