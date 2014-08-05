<?php $exp = new Main();

/* Getting post data */

if(isset($_POST['filter'])){
    
    /* Filtering the post data */
        
    $genome = filter_input(INPUT_POST, 'genome', FILTER_SANITIZE_SPECIAL_CHARS);
    $em = filter_input(INPUT_POST, 'em', FILTER_SANITIZE_SPECIAL_CHARS);
    
}

?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="page-header center">
                <h1>List of all experiments</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="span12">
            <h3>Filtering experiments:</h3>
        </div>
        <div class="span12 expFilterDiv">
            <form name="filterForm" method="post" action="?page=experiment">
                
                <!-- Filtering parameters -->
                
                <!-- Genome select box -->
                
                <div class="expFilterBlock">
                    <div class="expFiltTitle">Genome</div><br/>
                    <select name="genome">
                        <option value="0">--- All experiments ---</option>
                        
                        <?php foreach($exp->getAllGenomeList() as $gList){
                            
                            if($genome == $gList[1]){ $selectedGen = "selected='selected'";}
                            echo "<option ".$selectedGen." value='".$gList[1]."'>".$gList[1]."</option>";
                            $selectedGen = "";
                            
                        }?>
                    </select>
                </div>
                
                <!--/ Genome select box -->
                
                <!-- Epigenetic marks select box -->
                
                <div class="expFilterBlock">
                    <div class="expFiltTitle">Epigenetic marks</div><br/>
                    <select name="em">
                        <option value="0">--- All experiments ---</option>
                        
                        <?php foreach($exp->getAllEMList() as $emList){
                            
                            if($em == $emList[1]){ $selectedEM = "selected='selected'";}
                            echo "<option ".$selectedEM." value='".$emList[1]."'>".$emList[1]."</option>";
                            $selectedEM = "";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="expFilterBlock">
                    <input type="submit" name="filter" value="Filter" class="btn btn-primary btnSize">
                </div>
                
                <!--/ Epigenetic marks select box -->
                
                <!--/ Filtering parameters -->
                
            </form>
        </div>
        
        <!-- Table showing filtered result -->
        
        <div class="span12 apiDiv">
            
            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Name of Experiment</th>
                </tr>
                <?php 
                
                foreach($exp->getAllExpList($genome, $em) as $allExpKey => $allExpVal){ ?>
                <tr>
                    <td><?= ++$num; ?></td>
                    <td><a href="?page=experiment&id=<?= $allExpVal[0]; ?>"><?= $allExpVal[0]; ?></a></td>
                    <td><?= $allExpVal[1]; ?></td>
                </tr>
                <?php } $num = 1;?>
            </table>
        </div>
        
        <!--/ Table showing filtered result -->
        
    </div>
</div>