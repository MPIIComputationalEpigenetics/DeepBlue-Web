<?php

$detailedInfo = new Main();
$exp_id = $_GET['id'];


?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="page-header center">
                <h1>Detailed Information for <?= $exp_id; ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span12 versionDiv">
            <h2>
                <?php 
                echo "<pre>";
                print_r($detailedInfo->getExpDetailed($exp_id));
                echo "</pre>";
            ?>
            </h2>
        </div>        
    </div>
</div>