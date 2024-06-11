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

<div class="container">
    <h3 class="text-success text-center my-5">استمع الى القرآن الكريم</h3>
    <table class="table" dir='rtl'>
        <thead>
            <tr>
            <th scope="col">رقم السورة</th>
            <th scope="col">اسم السورة</th>
            <th scope="col">عبد الباسط-تجويد</th>
            <th scope="col">عبد الباسط-ترتيل</th>
            <th scope="col"> السديس</th>
            <th scope="col"> هاني الرفاعي</th>
            <th scope="col"> استمع الى قارئ عشوائيا</th>
            </tr>
        </thead>
        <tbody id='surah_table'></tbody>
    </table>
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
      rand = Math.floor(Math.random() * 44)+5;
    //   console.log( data.data[113].name);
    $('#surah_table').empty();
      for (soraa in data.data) {
          $('#surah_table').append(
            `
                <tr>
                    <th scope="row">${index+1}</th>
                    <td>${data.data[index].name}</td>
                    <td><button value='https://api.quran.com/api/v4/chapter_recitations/1' name="${index}" 
                    class="btn btn-success" onclick="showTafseer(this.value, this.name)">استمع</button></td>
                    
                    <td><button value='https://api.quran.com/api/v4/chapter_recitations/2' name="${index}" 
                    class="btn btn-success" onclick="showTafseer(this.value, this.name)">استمع</button></td>
                    
                    <td><button value='https://api.quran.com/api/v4/chapter_recitations/3' name="${index}" 
                    class="btn btn-success" onclick="showTafseer(this.value, this.name)">استمع</button></td>
                    
                    <td><button value='https://api.quran.com/api/v4/chapter_recitations/5' name="${index}" 
                    class="btn btn-success" onclick="showTafseer(this.value, this.name)">استمع</button></td>
                    
                    <td><button value='https://api.quran.com/api/v4/chapter_recitations/${rand}' name="${index}" 
                    class="btn btn-success" onclick="showTafseer(this.value, this.name)">استمع</button></td>
                    
                </tr>
            `
        )
          index++;
          
        }
      
    },
  });


  function showTafseer(url, surah){
    // console.log(url)
    $.ajax({
    type: "get",
    url:url,
    data: null,
    dataType: "JSON",
    success: function (data) {
        console.log(data.audio_files[surah].audio_url)
      showAlert(data.audio_files[surah].audio_url)
      
    },
  });
  
  }

  function showAlert(url) {
    // Create a custom alert box
    const alertBox = document.createElement('div');
    alertBox.className = 'custom-alert';
    alertBox.innerHTML = `
    <audio controls><source src="${url}" type="audio/mpeg"></audio><br>
      <button class='btn btn-success' onclick="document.body.removeChild(this.parentElement)">اغلاق</button>
    `;
    document.body.appendChild(alertBox);
  }
</script>