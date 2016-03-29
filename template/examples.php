<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Examples - DeepBlue Epigenomic Data Server";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "deepblue.css";
$no_main_header = true;
$page_body_prop = array("id"=>"extr-page");
include("inc/header.php");

?>

<style type="text/css">
@media (min-width: 768px) {
    .dl-horizontal dt {
        width:270px;
        white-space: normal;
        text-align: justify;
        text-justify: inter-word;
    }
    .dl-horizontal dd {
        margin-left:300px;
        margin-bottom: 12px;
    }
}

</style>

<?php include("landing_menu.php"); ?>

<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">

            <h1>DeepBlue API - examples</h1>
            <h3>These examples are ready to use - Copy and paste into your favorite python environment. <small>(Python version 2.6 or higher is required.)</small></h3>

            <dl class="dl-horizontal" id="freelance">
                <dt>
                    <h5 id='example-search_experiments'>Searching for experiments</h5>
                    <p>We use the <a href="api.php#api-search"</a>search</a> command to find experiments that contain the texts <i>H3k27AC</i>, <i>blood</i>, and <i>peaks</i> in their metadata.
                    <p>We put the names in single quotes to show that these names must be in the metadata.</p>
                </dt>
                <dd>
                    <script src="https://gist.github.com/felipealbrecht/620d77ed574fb2a90390.js"></script>
                </dd>

                <dt>
                    <h5 id='example-list_experiments'>Listing experiments</h5>
                    <p>We use the <a href="api.php#api-list_experiments"</a>list_experiments</a> command to list all experiments with the corresponding values in theirs metadata.
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/820312cc302a25768c80.js"></script></dd>


                <dt>
                    <h5 id='example-access_extra-metadata'>Accessing the extra-metadata</h5>
                    <p>We use the <a href="api.php#api-info"</a>info</a> command to access an experiment's metadata and its extra-metadata fields.
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/b2a002dc9edf0117133e.js"></script></dd>

                <dt>
                    <h5 id='example-select_epigenomic_data'>Select epigenomic data</h5>
                    <p>We use the <a href="api.php#api-select_experiments"</a>select_experiments</a> command to select all genomic regions from the two informed experiments.</p>
                    <p>We use the <a href="api.php#api-count_regions"</a>count_regions</a> command with the <i>query_id</i> value returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a>.
                    <p>The <a href="api.php#api-count_regions"</a>count_regions</a> command is asynchronous. It means that the user receives a <i>request_id</i> and should use the <a href="api.php#api-info"</a>info</a> command to check the status of this request.</p>
                    <p>The processing is over when the <i>request_status</i> value is <i>done</i> or <i>failed</i>.</p>
                    <p>The request data is retrieved using the <a href="api.php#api-get_request_data"</a>get_request_data</a> command.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/6b503fb93612cab9f47d.js"></script></dd>

                <dt>
                    <h5 id='example-output_columns'>Output with desired columns</h5>
                    <p>We use the <a href="api.php#api-select_experiments"</a>select_experiments</a> command to select the genomic regions from the experiments that are in the chromosome 1, position 0 to 50,000,000.</p>
                    <p>We use the <a href="api.php#api-get_regions"</a>get_regions</a> command with the <i>query_id</i> value returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a> and the desired file columns. The columns <i>@NAME</i> and <i>@BIOSOURCE</i> include the experiment name and the experiment biosource in the row output.</p>
                    <p>The <a href="api.php#api-get_regions"</a>get_regions</a> command is asynchronous. It means that the user receives a <i>request_id</i> and should use the <a href="api.php#api-info"</a>info</a> command to check the status of this request.</p>
                    <p>The processing is over when the <i>request_status</i> value is <i>done</i> or <i>failed</i>.</p>
                    <p>The request data is retrieved using the <a href="api.php#api-get_request_data"</a>get_request_data</a> command.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/9bafb162d8d61f2c234c.js"></script></dd>

                <dt>
                    <h5 id='example-filter_by_metadata'>Filter epigenomic data by metadata</h5>
                    <p>We use the <a href="api.php#api-list_samples">list_samples</a> command to obtain all samples from the biosource <i>myeloid cell</i> from the BLUEPRINT project. The <a href="api.php#api-list_samples">list_samples</a> returns a list of samples with their IDs and content.</p>
                    <p>We extract the IDs from this list and use it in the <a href="api.php#api-select_regions"</a>select_regions</a> command.</p>
                    <p>The <a href="api.php#api-select_regions"</a>select_regions</a> command selects the genomic regions that are in the chromosome 1, position 0 to 50,000 of all experiments that have the given samples IDs.</p>
                    <p>Then, we use the <a href="api.php#api-get_regions"</a>get_regions</a> command with the parameters: <i>query_id</i> returned by the <a href="api.php#api-select_regions"</a>select_regions</a> and the desired file columns. The columns <i>@NAME</i>, <i>SAMPLE_ID</i>, and <i>@BIOSOURCE</i> include the experiment name, the sample ID, and the experiment biosource in the row output.</p>
                    <p>The <a href="api.php#api-get_regions"</a>get_regions</a> command is asynchronous. It means that the user receives a <i>request_id</i> and should use the <a href="api.php#api-info"</a>info</a> command to check the status of this request.</p>
                    <p>The processing is over when the <i>request_status</i> value is <i>done</i> or <i>failed</i>.</p>
                    <p>The request data is retrieved using the <a href="api.php#api-get_request_data"</a>get_request_data</a> command.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/0debbec441804f62c045.js"></script></dd>

                <dt>
                    <h5 id='example-filter_by_region'>Filter epigenomic data by region attributes</h5>
                    <p>We use the <a href="api.php#api-select_experiments"</a>select_experiments</a> command for selecting the genomic regions from the experiments that are in the chromosome 1, position 0 to 50,000,000.</p>
                    <p>We filter the genomic regions that have the value of the column <i>SIGNAL_VALUE</i> higher than 10.</p>
                    <p>We filter the genomic regions that have the value of the column <i>PEAK</i> higher than 1000.</p>
                    <p>Then, we use the <a href="api.php#api-get_regions"</a>get_regions</a> command with the parameters: <i>query_id</i> returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a> and the desired file columns. The columns <i>@NAME</i> and <i>@BIOSOURCE</i> include the experiment name and the experiment biosource in the row output.</p>
                    <p>The <a href="api.php#api-get_regions"</a>get_regions</a> command is asynchronous. It means that the user receives a <i>request_id</i> and should use the <a href="api.php#api-info"</a>info</a> command to check the status of this request.</p>
                    <p>The processing is over when the <i>request_status</i> value is <i>done</i> or <i>failed</i>.</p>
                    <p>The request data is retrieved using the <a href="api.php#api-get_request_data"</a>get_request_data</a> command.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/61b9329decc31c3fa1ec.js"></script></dd>

                <dt>
                    <h5 id='example-find_overlapping'>Find overlapping regions</h5>
                    <p>We use the <a href="api.php#api-select_experiments"</a>select_experiments</a> command to select the genomic regions from the experiments that are in the chromosome 1, position 0 to 50,000,000.</p>
                    <p>We use the <a href="api.php#api-select_annotations"</a>select_annotations</a> command to select the genomic regions in the chromosome 1 of the annotation <i>promoters</i> of the genome assembly <i>GRCh38</i>.</p>
                    <p>The command <a href="api.php#api-intersection"</a>intersection</a> filters all regions of the <i>query_id</i> that overlap with at least one <i>promoters_id</i> region.</p>
                    <p>We use the <a href="api.php#api-get_regions"</a>get_regions</a> command with the parameters: <i>query_id</i> returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a> and the desired file columns. The columns <i>@NAME</i> and <i>@BIOSOURCE</i> include the experiment name and the experiment biosource in the row output.</p>
                    <p>The <a href="api.php#api-get_regions"</a>get_regions</a> command is asynchronous. It means that the user receives a <i>request_id</i> and should use the <a href="api.php#api-info"</a>info</a> command to check the status of this request.</p>
                    <p>The processing is over when the <i>request_status</i> value is <i>done</i> or <i>failed</i>.</p>
                    <p>The request data is retrieved using the <a href="api.php#api-get_request_data"</a>get_request_data</a> command.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/63999ad6da020eedf740.js"></script></dd>

                <dt>
                    <h5 id='example-retrieve_dna'>Retrieve DNA sequences</h5>
                    <p>We use the <a href="api.php#api-select_experiments"</a>select_experiments</a> command to select the genomic regions from the experiments that are in the chromosome 1, position 0 to 50,000,000.</p>
                    <p>We filter the genomic regions that have the value of the column <i>SIGNAL_VALUE</i> higher than 10.</p>
                    <p>We filter the genomic regions that have the value of the column <i>PEAK</i> higher than 1000.</p>
                    <p>The meta-column @LENGTH contains the genomic region length, and we filter the genomic regions where this value is smaller than 2,000.</p>
                    <p>We use the <a href="api.php#api-get_regions"</a>get_regions</a> with the <i>query_id</i> returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a> and the desired file columns. In this case, we use the meta-column @SEQUENCE, that includes the <i>DNA Sequence</i> in the genomic region output.</p>
                    <p>The <a href="api.php#api-get_regions"</a>get_regions</a> command is asynchronous. It means that the user receives a <i>request_id</i> and should use the <a href="api.php#api-info"</a>info</a> command to check the status of this request.</p>
                    <p>The processing is over when the <i>request_status</i> value is <i>done</i> or <i>failed</i>.</p>
                    <p>The request data is retrieved using the <a href="api.php#api-get_request_data"</a>get_request_data</a> command.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/b8f200c6e591dd41bb51.js"></script></dd>

                <dt>
                    <h5 id='example-dna_pattern'>DNA pattern matching operations</h5>
                    <p>We use the <a href="api.php#api-find_pattern"</a>find_pattern</a> command to generate an annotation of the genomic locations where the pattern <i>TATAA</i> happens in the genome assembly <i>GRCh38</i>.</p>
                    <p>The <a href="api.php#api-find_pattern"</a>find_pattern</a> command requires permission to include annotations. If the user (e.g. anonymous user) does not have this permission, an error will be returned. </p>
                    <p>Nevertheless, we have already processed this pattern, and the annotation was generated with the name <i>"Pattern TATAAA (non-overlap) in the genome GRCh38"</i>. We selected the genomic regions of the first chromosome of this annotation with the <a href="api.php#api-select_annotations"</a>select_annotations</a> command.</p>
                    <p>We use the <a href="api.php#api-select_experiments"</a>select_experiments</a> command to select the genomic regions from the experiments that are in the chromosome 1, position 0 to 50,000,000.</p>
                    <p>The command <a href="api.php#api-intersection"</a>intersection</a> filters all regions of the <i>query_id</i> that overlap with at least one <i>tataa_regions</i> region.</p>
                    <p>We use the <a href="api.php#api-get_regions"</a>get_regions</a> with the <i>query_id</i> returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a> and the desired file columns. In this case, we use the meta-column @SEQUENCE, that includes the <i>DNA Sequence</i> in the genomic region output.</p>
                    <p>The <a href="api.php#api-get_regions"</a>get_regions</a> command is asynchronous. It means that the user receives a <i>request_id</i> and should use the <a href="api.php#api-info"</a>info</a> command to check the status of this request.</p>
                    <p>The processing is over when the <i>request_status</i> value is <i>done</i> or <i>failed</i>.</p>
                    <p>The request data is retrieved using the <a href="api.php#api-get_request_data"</a>get_request_data</a> command.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/58740596a2f75ddf11f9.js"></script></dd>

                <dt>
                    <h5 id='example-genes'>Genes</h5>
                    <p>We use the <a href="api.php#api-select_genes"</a>select_genes</a> command to select the gene <i>RP11-34P13</i> from the gene set <i>gencode v23</i>.</p>
                    <p>The selected genes behave like a regular genomic region that, for example, can be filtered by their content.</p>
                    <p>We use the <i>@GENE_ATTRIBUTE</i> meta-column to select the genomic regions that are <i>lincRNA</i>.</p>
                    <p>We use the <a href="api.php#api-get_regions"</a>get_regions</a> with the <i>query_id</i> returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a> and the desired file columns.</p>
                    <p>The <a href="api.php#api-get_regions"</a>get_regions</a> command is asynchronous. It means that the user receives a <i>request_id</i> and should use the <a href="api.php#api-info"</a>info</a> command to check the status of this request.</p>
                    <p>The processing is over when the <i>request_status</i> value is <i>done</i> or <i>failed</i>.</p>
                    <p>The request data is retrieved using the <a href="api.php#api-get_request_data"</a>get_request_data</a> command.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/9a49cc901b57d96867f8.js"></script></dd>

                <dt>
                    <h5 id='example-aggregate_summarize'>Aggregate and summarize regions</h5>
                    <p>We use the <a href="api.php#api-get_regions"</a>get_regions</a> command with the <i>query_id</i> value returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a> and the desired file columns.</p>
                    <p>We use the <a href="api.php#api-select_annotations"</a>select_annotations</a> command to select the genomic regions, from position 0 to 50,000,000 in the chromosome 1 of the annotation <i>CpG Islands</i> of the genome assembly <i>GRCh38</i>.</p>
                    <p>The command <a href="api.php#api-aggregate"</a>aggregate</a> aggregates the <i>query_id</i> regions using the <i>cpg_islands</i> regions as boundaries.</p>
                    <p>The aggregate values can be accessed through the <a href="https://felipealbrecht.gitbooks.io/deepblue-epigenomic-data-server-manual/content/05-working-on/05-09-aggregation.html"><i>@AGG</i></a> meta-columns.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/20ccc22d2f8dd2121bb1.js"></script></dd>

                <dt>
                    <h5 id='example-tiling'>Tiling regions</h5>
                    <p>We use the <a href="api.php#api-get_regions"</a>get_regions</a> command with the <i>query_id</i> value returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a> and the desired file columns.</p>
                    <p>We use the <a href="api.php#api-tiling_regions"</a>tiling_regions</a> command to generate a set of consecutive genomic regions of size 100,000 on the chromosome 1 of the genome assembly <i>GRCh38</i>.</p>
                    <p>The command <a href="api.php#api-aggregate"</a>aggregate</a> aggregates the <i>query_id</i> regions by their column named <i>VALUE</i>, using the <i>cpg_islands</i> regions as boundaries.</p>
                    <p>The aggregation values can be accessed through the <a href="https://felipealbrecht.gitbooks.io/deepblue-epigenomic-data-server-manual/content/05-working-on/05-09-aggregation.html"><i>@AGG</i></a> meta-columns.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/c42b37e39b18d210d6cb.js"></script></dd>


                <dt>
                    <h5 id='example-flanking'>Flanking regions</h5>
                    <p>We use the <a href="api.php#api-select_genes"</a>select_genes</a> command to generate a set of genes from the gene set <i>gencode v19</i>.</p>
                    <p>The <a href="api.php#api-flank"</a>flank</a> command obtains flanking regions based on the existing regions. First, we generate regions that starts 2500bp before the regions and with the length of 2000bp. After, we generate the regions that starts 1500 bases pair after the regions end and have 500 base pairs. We consider the regions strand in both cases.</p>
                    <p>The <a href="api.php#api-merge_queries"</a>merge_queries</a> command merges the region sets defined by the <i>query IDs</i>. We merge the two flanking regions sets with the genes' regions set.</p>
                    <p>We use the <a href="api.php#api-get_regions"</a>get_regions</a> with the <i>query_id</i> that is returned by the <a href="api.php#api-merge_queries"</a>merge_queries</a>.
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/3f3b7439cc270949dcfb.js"></script></dd>

                <dt>
                    <h5 id='example-calculated_columns'>Calculated columns</h5>
                    <p>We use the <a href="api.php#api-get_regions"</a>get_regions</a> command with the <i>query_id</i> value returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a> and the desired file columns.</p>
                    <p>We use the <a href="api.php#api-select_annotations"</a>select_annotations</a> command to select the genomic regions, from position 0 to 50,000,000 in the chromosome 1 of the annotation <i>CpG Islands</i> of the genome assembly <i>GRCh38</i>.</p>
                    <p>The command <a href="api.php#api-aggregate"</a>aggregate</a> aggregates the <i>query_id</i> regions by their column named <i>VALUE</i>, using the <i>cpg_islands</i> regions as boundaries.</p>
                    <p>We select the aggregated regions that aggregated at least one region from the selected experiments (<i>@AGG.COUNT > 0</i>).</p>
                    <p>The aggregation values can be accessed through the <a href="https://felipealbrecht.gitbooks.io/deepblue-epigenomic-data-server-manual/content/05-working-on/05-09-aggregation.html"><i>@AGG</i></a> meta-columns.</p>
                    <p>We use the <a href="api.php#api-get_regions"</a>get_regions</a> with the <i>query_id</i> value returned by the <a href="api.php#api-select_experiments"</a>select_experiments</a> and the desired file columns. We use the <i>@CALCULATED</i> meta-column to transform the aggregate region <i>@AGG.MEAN</i> value to its log scale value.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/a320156ec05f87213d7a.js"></script></dd>

                <dt>
                    <h5 id='example-score_matrix'>Score matrix</h5>
                    <p>The <i>experiments</i> list contains the names of the experiments fow which we want to build a score matrix.</p>
                    <p>We will build the score matrix using the column named <i>VALUE</i>.</p>
                    <p>We select the CpG islands, which will be used as aggregated regions boundaries.</p>
                    <p>The <a href="api.php#api-score_matrix"</a>score_matrix</a> command receives the dictionary with the experiments names and columns that will be used for aggregation, the regions' boundaries, and the operation that will be performed (min, max, mean, var, sd, median, count).</p>
                    <p>The <a href="api.php#api-score_matrix"</a>score_matrix</a> command is asynchronous. It means that the user receives a <i>request_id</i> and should use the <a href="api.php#api-info"</a>info</a> command to check the status of this request.</p>
                    <p>The processing is over when the <i>request_status</i> value is <i>done</i> or <i>failed</i>.</p>
                    <p>The request data is retrieved using the <a href="api.php#api-get_request_data"</a>get_request_data</a> command.</p>
                </dt>
                <dd><script src="https://gist.github.com/felipealbrecht/a555f21642406c3d8676.js"></script></dd>
            </dl>

        </div>
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