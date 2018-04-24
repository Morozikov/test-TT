<?php

/* @var $this yii\web\View */
use app\models\searchFlight;



$this->title = 'My Yii Application';
?>
<div class="site-index">

   
    <div class="body-content">

        <div class="row">
          <?php
         
       
          	$searchFlight = new searchFlight();
			$searchFlight->send_and_save();
          ?>
        </div>

    </div>
</div>
