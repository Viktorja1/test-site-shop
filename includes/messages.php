<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.08.20
 * Time: 19:28
 */
if (isset($_SESSION['message'])) : ?>
    <div class="message" >
        <p>
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </p>
    </div>
<?php endif ?>