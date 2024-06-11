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
<div class="container" dir='rtl'>
    <h3 class="text-success text-center my-5">اذكار المسلم</h3>
    <div class="row justify-content-center" id='cats_azkar'></div>
    <h3 class="text-success text-center my-5" id="azkar_title">اذكار الصباح</h3>
    <div class="row" id="azkar">
       
    </div>
    
    
</div>

<?php require_once('../../includes/footer.php'); ?>

<script>
    let url = "https://raw.githubusercontent.com/nawafalqari/azkar-api/56df51279ab6eb86dc2f6202c7de26c8948331c1/azkar.json";
  $.ajax({
    type: "get",
    url: url,
    data: null,
    dataType: "JSON",
    success: function (data) {
    $('#cats_azkar').empty();

      for (zekr of Object.keys(data)) {
        $('#cats_azkar').append(
            `<button class="col-lg-2 col-md-5 col-5 btn btn-success m-1" value="${zekr}" onclick='showAzkar(this.value)' >${zekr}</button>`
        )
       }
       $('#azkar').empty();
       for (zekr of data["أذكار الصباح"]) {
            if(zekr.content == undefined)
            {
                continue
            }
            if(zekr.content == 'stop')
            {
                continue
            }
            $('#azkar').append(
                `
                <div class="card text-white bg-danger mb-3 col-12 my-2"   >
            <div class="card-header text-center">${zekr.category}</div>
            <div class="card-body">
                <h5 class="card-title">التكرار: ${zekr.count}</h5>
                <p class="card-text">${zekr.content}</p><hr>
                <p class="card-text  text-dark">${zekr.description}</p>
            </div>
        </div>
                `
            );

       }
      
    },
  });

  function showAzkar(cat){
    let url = "https://raw.githubusercontent.com/nawafalqari/azkar-api/56df51279ab6eb86dc2f6202c7de26c8948331c1/azkar.json";
  $.ajax({
    type: "get",
    url: url,
    data: null,
    dataType: "JSON",
    success: function (data) {
        var index = 0;
        $('#azkar').empty();
        $('#azkar_title').empty();
        $('#azkar_title').append(`${cat}`);
        
        for (zekr of data[cat]) {
            if(zekr.content == undefined)
            {
                continue
            }
            if(zekr.content == 'stop')
            {
                continue
            }
            $('#azkar').append(
                `
                <div class="card text-white bg-danger mb-3 col-12 my-2"   >
            <div class="card-header text-center">${zekr.category}</div>
            <div class="card-body">
                <h5 class="card-title">التكرار: ${zekr.count}</h5>
                <p class="card-text">${zekr.content}</p><hr>
                <p class="card-text  text-dark">${zekr.description}</p>
            </div>
        </div>
                `
            );

       }
      
    },
  });
  }
</script>