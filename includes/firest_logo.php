<?php if (!empty($home) && $home['logo']=='') { ?>
    <div id="" class="form-text bg-success text-white text-center successMsg"><?php if(@$_SESSION['successMsg']) { echo "<p class='px-3 py-1 m-0' >-".$_SESSION['successMsg']."</p>"; } ?></div>
    
    <form id="add_frist_logo" class=" my-3 add_frist_logo" action="../../handlers/handleFirestHome.php" enctype="multipart/form-data" method="POST">
        <div id="" class="form-text bg-success text-white text-center successMsg"></div>
        <div id="Errs" class="form-text bg-danger text-white"></div>
        <input name="frist_logo" hidden id="" value="logo">

        <div class="form-group">
            <label for="logo ">
                <h4>Add a new logo for the website</h4>
            </label>
            <input name="logo" type="file" accept="image/*" class="form-control pt-2" id="logo">
        </div>


        <button type="submit" id='submit' class="submit_btn btn btn-success  my-3">Add</button>
    </form>


<?php unset( $_SESSION['successMsg'] ); die();
} ?>