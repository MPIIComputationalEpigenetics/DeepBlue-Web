<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Acknowledgements - DeepBlue Epigenomic Data Server";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$no_main_header = true;
$page_body_prop = array("id"=>"extr-page");
include("inc/header.php");

?>

<?php include("landing_menu.php"); ?>

<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content" class="container">

            <h2 class="text-primary" style="margin: 20px 0;">Acknowledgements</h2>
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            <h3 class="text-primary">Concept, design, and main development</h3>
                            <p class="lead"><a href="mailto:felipe.albrecht@mpi-inf.mpg.de">Felipe Albrecht</a></p>
                            <address>
                                <strong>Max Planck Institute for Informatics</strong><br>
                                <strong>Computational Biology and Applied Algorithmics</strong><br>
                                        Campus E1 4<br>
                                        66123 <a href="http://www.saarbruecken.de/">Saarbrücken</a><br>
                                        <a href="http://www.deutschland.de/en">Germany</a><br>
                                <br>
                                Phone: +49 681 9325 3008
                            </address>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 class="text-primary">Advisors</h3>
                            <p class="lead">Prof. Dr. Dr. Thomas Lengauer</p>
                            <p class="lead">Dr. Christoph Bock</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 class="text-primary">Developers</h3>
                            <p class="lead">Obaro Odiete - Web Interface (php, html, javascript, css) - started: 12.2014</p>

                            <h3 class="text-primary">Former developers</h3>
                            <p class="lead">Natalie Wirth - Server (C++) and data inclusion (python) - 12.2014 to 07.2015</p>
                            <p class="lead">Umidjon Urunov - Web Interface (php, html, javascript, css) - 08.2014 to 11.2014</p>
                            <p class="lead">Fabian Reinartz - Server (C++) and data inclusion (python) - 06.2013 to 03.2014</p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3 class="text-primary">Supporters</h3>
                            <p class="lead"><a href="http://mpi-inf.mpg.de">Max Planck Institute for Computer Science</a></p>
                            <p class="lead"><a href="http://deutsches-epigenom-programm.de">DEEP - DEutsches Epigenom Programm</a></p>
                            <p class="lead"><a href="http://www.blueprint-epigenome.eu">BLUEPRINT - A BLUEPRINT of Haematopoietic Epigenomes</a></p>

                            <p class="lead">This work has been supported by German Science Ministry Grant No. 01KU1216A (DEEP project) and has been performed in the context of EU grant no. HEALTH-F5-2011-282510 (BLUEPRINT project)</p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3 class="text-primary">Logo and colors</h3>
                            <p class="lead"><a href="http://www.pen.ag/">Diego Cadorin - pen.ag</a></p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h3 class="text-primary">Third-party softwares - Server</h3>
                            <p class="lead"><a href="https://www.mongodb.org/">MongoDB</a></p>
                            <p class="lead"><a href="http://www.boost.org/">Boost C++ Libraries</a></p>
                            <p class="lead"><a href="http://expat.sourceforge.net/">Expat XML Parser</a></p>
                            <p class="lead"><a href="http://www.bzip.org/">bzip2</a></p>
                            <p class="lead"><a href="https://github.com/cppformat/cppformat">cppformat</a></p>
                            <p class="lead"><a href="http://luajit.org/">lualit</a></p>
                            <p class="lead"><a href="http://www.partow.net/programming/strtk/">StrTk</a></p>
                            <p class="lead"><a href="https://github.com/jemalloc/jemalloc">jemalloc</a></p>
                            <p class="lead"><a href="http://think-async.com/Urdl/doc/html/index.html">Urdl</a></p>
                            <p class="lead"><a href="https://github.com/temporaer/MDBQ">MDBQ</a></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 class="text-primary">Third-party softwares - Web Front-End</h3>
                            <p class="lead"><a href="https://bootstraphunter.com/theme/smartadmin-responsive-webapp-frontend-BSH01">SmartAdmin - Responsive WebApp + Frontend</a></p>
                            <p class="lead"><a href="http://getbootstrap.com/">Bootstrap</a></p>
                            <p class="lead"><a href="https://fortawesome.github.io/Font-Awesome/icons/">Fonts Awesome</a></p>
                            <p class="lead"><a href="http://morrisjs.github.io/morris.js/">morris.js</a></p>
                            <p class="lead"><a href="http://t4t5.github.io/sweetalert/">Sweet Alert</a></p>
                            <p class="lead"><a href="https://select2.github.io/">Select2</a></p>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
</div>

<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php
    //include required scripts
    include("inc/scripts.php");
?>


<?php
    //include footer
    include("inc/google-analytics.php");
?>