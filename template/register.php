<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Register - DeepBlue Epigenomic Data Server";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$no_main_header = true;
$page_body_prop = array("id"=>"extr-page");
include("inc/header.php");

?>
<script src='https://www.google.com/recaptcha/api.js'></script>

<div role="navigation" class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a id="logo"  href="<?php echo ASSETS_URL; ?>">
                <img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="DeepBlue Epigenomic Data Server">
            </a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li class="active">
                <a href="<?php echo APP_URL; ?>/index.php">SIGN IN</a>
            </li>
        </ul>
    </div>
</div>


        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                        <h1 class="txt-color-red login-header-big">DeepBlue Epigenomic Data Server</h1>
                        <div class="hero">

                            <div class="pull-left login-desc-box-l">
                                <h4 class="paragraph-header">DeepBlue provides a central data access hub for large collections of epigenomic data. It organizes the data from different sources using controlled vocabularies and ontologies. The data is stored in our server server, where the users can access the data programmatically or by or web interface.</h4>
                                <h4 class="paragraph-header">DeepBlue contains a set of operations designed for operation on epigenomic data, for example, data overlapping and aggregations. The users can execute all the operations in a pipeline fashion in the server and transfer only the meaningful data. DeepBlue is open and free or charge. Request your account and start using it.</h4>
                            </div>

                            <img src="<?php echo ASSETS_URL; ?>/img/logo.png" class="pull-right display-image index-middle-logo" alt="">
                        </div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <br/>
            <div class="navy-line"></div>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <p>DeepBlue is possible because the support of:</p>
            <br/>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6 col-sm-5cols">
                <a href="http://www.mpg.de/en"><img height="80px" src="img/minerva-MPG-small.png"/></a>
            </div>
            <div class="col-xs-6 col-sm-5cols">
                <a href="http://www.mpi-inf.mpg.de/"><img height="80px" src="img/mpilogo-inf-compact.png"/></a>
            </div>
            <div class="col-xs-6 col-sm-5cols">
                <a href="http://www.deutsches-epigenom-programm.de/"><img height="80px" src="img/DEEP_Logo.jpg"/></a>
            </div>
            <div class="col-xs-6 col-sm-5cols">
                <a href="http://www.blueprint-epigenome.eu/"><img height="80px" src="img/blueprint.png"/></a>
            </div>
        </div>
    </div>
</div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                        <div class="well no-padding">

                            <form action="php/deepblue_register.php" method="POST" id="smart-form-register" class="smart-form client-form">
                                <header>
                                    DeepBlue Epigenomic Web Server Registration
                                </header>

                                <fieldset>
                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="username" placeholder="Name">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter your name</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-building-o"></i>
                                            <input type="text" name="affiliation" placeholder="Affiliation">
                                            <b class="tooltip tooltip-bottom-right">Your school, university, or researching center</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email address">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="password" placeholder="Password" id="password">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="passwordConfirm" placeholder="Confirm password">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>
                                </fieldset>

                                <fieldset>
                                    <section>
                                        <label class="checkbox">
                                            <input type="checkbox" name="subscription" id="subscription">
                                            <i></i>I want to keep informed about DeepBlue updates</label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="terms" id="terms">
                                            <i></i>I agree with the <a href="#" data-toggle="modal" data-target="#myModal"> Terms and Conditions </a></label>
                                    </section>
                                </fieldset>

                                <fieldset>
                                    <section>
                                            <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                            <div class="g-recaptcha" data-sitekey="6LdubBcTAAAAAF2nJb8UYIthV5Vy3COkg9FLazMs"></div>
                                    </section>
                                </fieldset>

                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </footer>

                                <div class="message">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Thank you for your registration! Your request is being processed.
                                        Meanwhile, click <a href="php/deepblue_checkuser.php">here</a> to access DeepBlue from an anonymous account.
                                    </p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
                    </div>
                    <div class="modal-body custom-scroll terms-body">

 <div id="left">
 <pre>
DeepBlue Epigenomic Data Server End User License Agreement
-----------------------------------

This is a legal agreement ("Agreement") between you ("Licensee", either an individual or a single entity) and

Max Planck Institut fuer Informatik
Stuhlsatzenhausweg 85
66123 Saarbruecken
Germany,

("MPII" for short) about using the DeepBlue Epigenomic Data Server ("Software") that provides a tool for computational retrieving and analysis of genomes and epigenomes.

Please read the following Agreement carefully.

By using the software or downloading the source code you indicate that you have read and accepted the provisions of the Agreement and that you agree to be bound by all terms and conditions set forth herein. If you do not agree to any of the terms of this Agreement, do not use the Software and destroy any parts or results from the Software in your possession immediately.



1. Copyright

DeepBlue Epigenomic Data Server, including but not limited to the program code, sample programs, any associated files and documentations (the "Software"), is owned by MPII and is protected by copyright laws.


2. License

A license for using the DeepBlue Epigenomic Data Server web service or source code is provided free of charge to researchers working at academic, non-profit organizations on non-commercial projects.
Any commercial use of the software is strictly forbidden (please contact MPII for a free, time-limited, commercial test license).


3. Limited Warranty and Liability

Access to the software is provided on an “as is” basis, and there are no warranties or conditions with respect to its fitness for purpose, its operational state, character, quality, or freedom from defects, or the non-infringement of rights of third parties.

The Licensee acknowledges that Software furnished hereunder is under test. The Licensee is solely responsible for determining the suitability of the Software and accepts full responsibility and risks associated with the use of the Software. In no event will MPII be liable for any damages, including but not limited to any loss of revenue, profit, or data, however caused, directly or indirectly, by the Software or by this Agreement.


4. Maintenance and Support

MPII is not obliged to provide maintenance or support to you. Nor do we guarantee availability of the webserver.


5. Distribution

No distribution is to be made of the Software by you.


6. Privacy

MPII is committed to respecting the privacy and data security of the users of the software. In general, any uploaded data or conducted analyses are exclusively available under the same account data from where they were generated. MPI staff will access and / or view your data only when this is necessary for debugging purposes.
However, due to the software being in test state it may happen that private data becomes erroneously accessible to third persons. MPII cannot take responsibility for any damages caused by such an event.


7. Reproduction of Information

All information is generated for personal and academic, non-commercial use only and, in this context, may be reproduced, in part or in whole and by any means, without charge or further permission from MPII. However, we stipulate that the software has to be cited appropriately.


8. Termination

If the Licensee fails to comply with any term of this Agreement, this Agreement is terminated and the Licensee has no further right to use the Software. On termination, the Licensee shall have no claim on or arising from the Software. The Software and any results generated by it shall be destroyed.


9. Applicable Law and Court of Jurisdiction

This Agreement is made and shall be construed in accordance with the laws of Germany.
Court of Jurisdiction is Saarbruecken, Germany.


10. Construction Clause

If for any reason a court of competent jurisdiction finds any provision of this Agreement, or portion thereof, to be unenforceable, that provision of the Agreement will be enforced to the maximum extent permissible so as to affect the intent of the parties, and the remainder of this Agreement will continue in full force and effect.


11. Entire Agreement

This Agreement constitutes the entire agreement between the Licensee and MPII.
It replaces all other representations.
All modifications or extensions of this Agreement need to be put down in writing.
</pre>
</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" id="i-agree">
                            <i class="fa fa-check"></i> I Agree
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php
    //include required scripts
    include("inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->

<script type="text/javascript">
    runAllForms();

    // Model i agree button
    $("#i-agree").click(function(){
        $this=$("#terms");
        if($this.checked) {
            $('#myModal').modal('toggle');
        } else {
            $this.prop('checked', true);
            $('#myModal').modal('toggle');
        }
    });


    // Validation
    $(function() {
        // Validation
        $("#smart-form-register").validate({
            // jquery.validate ignores hidden fields by default, not validating them.
            ignore: ".ignore",

            // Rules for form validation
            rules : {
                username : {
                    required : true
                },
                email : {
                    required : true,
                    email : true
                },
                password : {
                    required : true,
                    minlength : 3,
                    maxlength : 20
                },
                passwordConfirm : {
                    required : true,
                    minlength : 3,
                    maxlength : 20,
                    equalTo : '#password'
                },
                firstname : {
                    required : true
                },
                lastname : {
                    required : true
                },
                affiliation : {
                    required : true
                },
                terms : {
                    required : true
                },
                hiddenRecaptcha: {
                    required: function () {
                        if (grecaptcha.getResponse() == '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            },

            // Messages for form validation
            messages : {
                login : {
                    required : 'Please enter your login'
                },
                email : {
                    required : 'Please enter your email address',
                    email : 'Please enter a VALID email address'
                },
                password : {
                    required : 'Please enter your password'
                },
                passwordConfirm : {
                    required : 'Please enter your password one more time',
                    equalTo : 'Please enter the same password as above'
                },
                firstname : {
                    required : 'Please enter your first name'
                },
                lastname : {
                    required : 'Please enter your last name'
                },
                affiliation : {
                    required : 'Please enter your affiliation'
                },
                terms : {
                    required : 'You must agree with Terms and Conditions'
                },
                hiddenRecaptcha: {
                    required: "Please prove that you are not a robot"
                }
            },

            // Ajax form submition
            submitHandler : function(form) {
                $(form).ajaxSubmit({
                    success : function() {
                        $("#smart-form-register").addClass('submited');
                    }
                });
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });

    });
</script>

<?php
    include("inc/google-analytics.php");
?>