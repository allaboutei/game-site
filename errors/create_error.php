<?php
if (isset($_SESSION['cerrors']) && $_SESSION['cerrors'] != "") { ?>
    <div class="row">
        <div class="col-sm-12">
            <p class="text-center text-danger font-weight-bold">
                <?php
                echo $_SESSION['cerrors'];
                $_SESSION['cerrors'] = "";
                ?>
            </p>
        </div>
    </div>
    <br /><br />
<?php } ?>