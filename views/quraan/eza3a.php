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
        <h3>اذاعات القرآن الكريم</h3>
    </div>

<div class="container">
    <div id='eza3at' class="row  justify-content-between justify-content-sm-center align-items-around my-5" dir='rtl'>
        
    
      
        
    </div>
   
</div>

</main>

<?php require_once('../../includes/footer.php'); ?>

<script>
    
  let url = "https://data-rosy.vercel.app/radio.json";
  $.ajax({
    type: "get",
    url: url,
    data: null,
    dataType: "JSON",
    success: function (data) {
      var index = 0;
    //   console.log( data.data[113].name);
    $('#eza3at').empty();

      for (soraa in data.radios) {
          $('#eza3at').append(
            `
            <div  class="col-md-5 col-sm-7 bg-dark text-center align-content-center  text-decoration-none m-1 p-3"  >
                <h2 class="text-white">${data.radios[index].name}</h2>
                <img class="my-3 w-100 h-auto " src="${data.radios[index].img}" alt="${data.radios[index].name}" >
                <audio controls><source src="${data.radios[index].url}" type="audio/mpeg"></audio>
            </div>
        
            `
        )
          index++;
          
        }
      
    },
  });

</script>