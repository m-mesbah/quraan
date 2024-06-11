<?php if ($result_home->num_rows == 0) {
    $_SESSION['firest_home'] = true; ?>
<div class="img-fluid"><img src="../../assets/img/help-me.png" alt="guiding add friest home detailes image" class="img-fluid" style='width: 100%;height:400px;'></div>
<form id="firest_home" class=" my-3 firest_home" action="../../handlers/handleFirestHome.php" enctype="multipart/form-data" method="POST">
        <div id="Errs" class="form-text bg-danger text-white"><?php if(@$_SESSION['errs']) { foreach(@$_SESSION['errs'] as $err){ echo "<p class='px-3 py-1 m-0' >-".$err."</p>"; }} ?></div>
        <input name="frist_home_details" hidden id="" value="frist">

        <div class="form-group">
            <label for="certificates_logo ">
                <h4>Add a new Home Detailes</h4>
            </label><br>
            <label for="about_img">Choose about image</label>
            <input name="about_img" type="file" accept="image/*" class="form-control pt-2" id="about_img">
            <input name="action_h" class="form-control pt-2 my-1" id="action_h" placeholder='Header in action section'>
            <input name="action_p" class="form-control pt-2 my-1" id="action_p" placeholder='paragraph  in action section'>
            <input name="about_h" class="form-control pt-2 my-1" id="about_h" placeholder='Header in about section'>
            <input name="about_p" class="form-control pt-2 my-1" id="about_p" placeholder='Paragrph in about section'>
            <input name="about_h2" class="form-control pt-2 my-1" id="about_h2" placeholder=' Header 2 in about section'>
            <input name="about_p1" class="form-control pt-2 my-1" id="about_p1" placeholder='Paragrph 2 in about section'>
            <input name="about_p2" class="form-control pt-2 my-1" id="about_p2" placeholder='Paragrph 3 in about section'>
            <input name="about_p3" class="form-control pt-2 my-1" id="about_p3" placeholder='Paragrph 4 in about section'>
            <input name="products_h" class="form-control pt-2 my-1" id="products_h" placeholder='header in product section'>
            <input name="products_p" class="form-control pt-2 my-1" id="products_p" placeholder='Paragrph in product section'>
        </div>


        <button type="submit" id='submit' class="submit_btn btn btn-success  my-3">Add</button>
    </form>


<?php unset( $_SESSION['errs'] ); die();
} ?>