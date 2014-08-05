<?php $serverVersion = new Main();?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="page-header center">
                <h1>DeepBlue Server Version</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span12 versionDiv">
            <img src="img/server.png">
            <h2><?php echo $serverVersion->getServerVersion(); ?></h2>
        </div>        
    </div>
</div>