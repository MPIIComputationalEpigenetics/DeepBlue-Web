<?php $api = new Main();?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="page-header center">
                <h1>DeepBlue API List</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span12 apiDiv">
            <?php $api->displayAPIList(); ?>
        </div>        
    </div>
</div>