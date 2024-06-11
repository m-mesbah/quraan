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
      .ayah {
        padding: 0 .5em;
        display: inline-block;
        position: relative;
      }

      .ayah::after {
        content: "\06DD";
        display: block;
        position: absolute;
        font-size: 1.9em;
        top: 50%;
        left: 50%;
        transform: translate( -50%, -50%);
        
      }
      .container{
        text-align: center;
      }
      h1{
          color: green;
      }
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
      }
    </style>
<div class="container">
    <h3 class="text-success text-center my-5">قرآءة القرآن الكريم</h3>
    <table class="table" dir='rtl'>
        <thead>
            <tr>
            <th scope="col">رقم السورة</th>
            <th scope="col">اسم السورة</th>
            <th scope="col">Surah name</th>
            <th scope="col">عدد الايات</th>
            <th scope="col"> اقرئ</th>
            </tr>
        </thead>
        <tbody id='surah_table'></tbody>
    </table>
</div>
<div class="modal  bg-dark " id="request_table" tabindex="-1" aria-labelledby="showLoginFormLabel" aria-hidden="true" style='display: none;'>
    <div class="modal-dialog" style='max-width: 900px;'>
        <div class="modal-content">
            <div class="modal-header border-0">
                <button onclick="showSurah(0)" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <h5 class="modal-title text-center" id="surahName"></h5><hr>
            <div class="modal-body" id='surahAyat' dir="rtl" style='line-height: 30px;'>
                
            </div>

        </div>
    </div>

</div>

<?php require_once('../../includes/footer.php'); ?>
<script>

  let url = "https://api.alquran.cloud/v1/surah";
  $.ajax({
    type: "get",
    url: url,
    data: null,
    dataType: "JSON",
    success: function (data) {
      var index = 0;
    //   console.log( data.data[113].name);
    $('#surah_table').empty();

      for (soraa in data.data) {
        console.log(data.data[index].name);
          $('#surah_table').append(
            `
                <tr>
                    <th scope="row">${index+1}</th>
                    <td>${data.data[index].name}</td>
                    <td>${data.data[index].englishNameTranslation}</td>
                    <td>${data.data[index].numberOfAyahs}</td>
                    <td><button value='https://api.alquran.cloud/v1/surah/${index+1}' 
                    class="btn btn-success" onclick="showSurah(this.value)">عرض</button></td>
                    
                </tr>
            `
        )
          index++;
          
        }
      
    },
  });


  function showSurah(url){

    $('#request_table').fadeToggle();
    if (url != 0) {
        ajax_request(url)
    }
  }
  function ajax_request(url){
 
  $.ajax({
    type: "get",
    url: url,
    data: null,
    dataType: "JSON",
    success: function (data) {
      var index = 0;
      $('#surahAyat').empty();
      $('#surahName').empty();
      if(data.data.revelationType == 'Meccan')type = "مكية"
      else type = "مدنية"
    
      $('#surahName').append(`${data.data.name} (${type})`);
      console.log(data.data.ayahs[0].text)
      for (soraa in data.data.ayahs) {
          if(url == 'https://api.alquran.cloud/v1/surah/1' && index == 0 ){
            $('#surahAyat').append(`<div class=" text-dark  text-center "  >بِسۡمِ ٱللَّهِ ٱلرَّحۡمَـٰنِ ٱلرَّحِیمِ </span><span class="ayah"> 1 </span></div> <br>`)
              index++ 
              continue
           }
        $('#surahAyat').append(
            ` <span  class=''>${data.data.ayahs[index].text}</span> <span style="cursor:help;" class="ayah" id="https://quranenc.com/api/v1/translation/sura/arabic_moyassar/${data.data.number}" onclick="showTafseer(this.id, '${data.data.ayahs[index].numberInSurah}' )">${data.data.ayahs[index].numberInSurah}</span> `
        )
          index++;
          
        }
      
    },
  });
  
  }

  function showTafseer(url, ayahNumber){
    $.ajax({
    type: "get",
    url: url,
    data: null,
    dataType: "JSON",
    success: function (data) {
      // alert(data.result[ayahNumber-1].translation)
      showAlert(ayahNumber, data.result[ayahNumber-1].translation)
      
    },
  });
  
  }

  function showAlert(title, message) {
    // Create a custom alert box
    const alertBox = document.createElement('div');
    alertBox.className = 'custom-alert';
    alertBox.innerHTML = `
      <h2 class="text-center">${title}</h2> <hr>
      <p dir='rtl'>${message}</p>
      <button class='btn btn-success' onclick="document.body.removeChild(this.parentElement)">اغلاق</button>
    `;
    document.body.appendChild(alertBox);
  }
</script>