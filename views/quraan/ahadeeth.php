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
<style>
    .custom-alert {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 99999999999;
        max-height: 100vh;
        overflow: auto;
      }
</style>
<div class="container " >
    <h3 class="text-success text-center my-5">احاديث نبوية شريفة</h3>
    <nav aria-label="Page navigation example" class=" d-flex justify-content-center ">
        <ul class="pagination" id='pagination'> </ul>
    </nav>
    <div class="row" id='ahadeeth' dir='rtl'> </div>
    
</div>

<?php require_once('../../includes/footer.php'); ?>

<script>
    let url = "https://hadis-api-id.vercel.app/hadith/abu-dawud?page=1&limit=12";
  $.ajax({
    type: "get",
    url: url,
    data: null,
    dataType: "JSON",
    success: function (data) {
      var index = 0;
      var page_num = 0;
    //   console.log( data.data[113].name);
    $('#ahadeeth').empty();
    $('#pagination').empty();

      for (hadeeth in data.items) {
        console.log(data.items[index].arab);
          $('#ahadeeth').append(
            `
                <div class="card col-lg-4 col-6 my-2 bg-success text-white ">
                    <div class="card-header text-center">
                        ${data.items[index].number}
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                        <p style="height:300px !important; overflow-y:auto;">${data.items[index].arab}</p>
                        <p id='hadeethTrans_${data.items[index].number}' class='d-none' >${data.items[index].id}</p>
                        <div class="text-cneter d-flex justify-content-center"><button class="btn btn-primary" value='${data.items[index].number}' onclick="showTrans(this.value)">ترجمة الحديث</button></div>
                        </blockquote>
                    </div>
                </div>
            `
        )
          index++;
          
        }

      for (hadeeth in data.pagination.pages) {
        console.log(data.pagination.pages[page_num]);
          $('#pagination').append(
            `
            <li class="page-item"><button class="page-link" value="https://hadis-api-id.vercel.app/hadith/abu-dawud?page=${data.pagination.pages[page_num]}&limit=12" onclick="pagination_ahadeeth(this.value)">${data.pagination.pages[page_num]}</button></li>
                
            `
        )
        page_num++;
          
        }

      
    },
  });
  function showTrans(hadeethNum){
    $.ajax({
    type: "get",
    url: url,
    data: null,
    dataType: "JSON",
    success: function (data) {
      // alert(data.result[ayahNumber-1].translation)
      id = 'hadeethTrans_'+hadeethNum 
      hadeethTrans = $("#"+id+"").text();
      showAlert(hadeethTrans,hadeethNum)
      
    },
  });
  
  }

  function showAlert(message,hadeethNum) {
    // Create a custom alert box
    const alertBox = document.createElement('div');
    alertBox.className = 'custom-alert';
    alertBox.innerHTML = `
    <h2 class="text-center">${hadeethNum}</h2> <hr>

      <p dir='rtl'>${message}</p>
      <button class='btn btn-success' onclick="document.body.removeChild(this.parentElement)">اغلاق</button>
    `;
    document.body.appendChild(alertBox);
  }

  function pagination_ahadeeth(url){
    $.ajax({
        type: "get",
        url: url,
        data: null,
        dataType: "JSON",
        success: function (data) {
        var index = 0;
        var page_num = 0;
        //   console.log( data.data[113].name);
        $('#ahadeeth').empty();
        $('#pagination').empty();

        for (hadeeth in data.items) {
            console.log(data.items[index].arab);
            $('#ahadeeth').append(
                `
                    <div class="card col-lg-4 col-6 my-2 bg-success text-white ">
                        <div class="card-header text-center">
                            ${data.items[index].number}
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p style="height:300px !important; overflow-y:auto;">${data.items[index].arab}</p> <hr>
                            <p id='hadeethTrans_${data.items[index].number}' class='d-none' >${data.items[index].id}</p>
                            <div class="text-cneter d-flex justify-content-center"><button class="btn btn-primary" value='${data.items[index].number}' onclick="showTrans(this.value)">ترجمة الحديث</button></div>
                            </blockquote>
                        </div>
                    </div>
                `
            )
            index++;
            
            }

        for (hadeeth in data.pagination.pages) {
            console.log(data.pagination.pages[page_num]);
            $('#pagination').append(
                `
                <li class="page-item"><button class="page-link" value="https://hadis-api-id.vercel.app/hadith/abu-dawud?page=${data.pagination.pages[page_num]}&limit=12" onclick="pagination_ahadeeth(this.value)">${data.pagination.pages[page_num]}</button></li>
                    
                `
            )
            page_num++;
            
            }

        
        },
    });
    }

</script>