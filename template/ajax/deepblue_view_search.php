<?php require_once("inc/init.php");?>
<div class="row">

	<div class="col-sm-12">

		<ul id="myTab1" class="nav nav-tabs table-bordereddered">
			<li class="active">
				<a href="#s1" data-toggle="tab">Search All <i class="fa fa-caret-down"></i></a>
			</li>
			<li>
				<a href="#s2" data-toggle="tab">Users</a>
			</li>
			<li>
				<a href="#s3" data-toggle="tab">Search History</a>
			</li>
			<li class="pull-right hidden-mobile">
				<a href="javascript:void(0);"> <span class="note">About 24,431 results (0.15 seconds) </span> </a>
			</li>
		</ul>

		<div id="myTabContent1" class="tab-content bg-color-white padding-10">
			<div class="tab-pane fade in active" id="s1">
				<h1> Search <span class="semi-bold">Everything</span></h1>
				<br>
				<div class="input-group input-group-lg hidden-mobile">
					<div class="input-group-btn">
						<button id='typeSelect' type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span id='select-show'>Everything</span> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li id='Everything'>
								<a href="javascript:void(0)" id='Everything'>Everything</a>
							</li>
							<li class="divider"></li>
							<li id='Annotations'>
								<a href="javascript:void(0)" id='Annotations'>Annotations</a>
							</li>
							<li id='Experiments'>
								<a href="javascript:void(0)" id='Experiments'>Experiments</a>
							</li>
							<li id='Genomes'>
								<a href="javascript:void(0)" id='Genomes'>Genomes</a>
							</li>
							<li id='Epigenetic Marks'>
								<a href="javascript:void(0)" id='Epigenetic Marks'>Epigenetic Marks</a>
							</li>
							<li id='Bio Sources'>
								<a href="javascript:void(0)" id='Bio Sources'>Bio Sources</a>
							</li>
							<li id='Samples'>
								<a href="javascript:void(0)" id='Samples'>Samples</a>
							</li>
							<li id='Techniques'>
								<a href="javascript:void(0)" id='Techniques'>Techniques</a>
							</li>
							<li id='Projects'>
								<a href="javascript:void(0)" id='Projects'>Projects</a>
							</li>
							<li id='Column types'>
								<a href="javascript:void(0)" id='Column types'>Column types</a>
							</li>
						</ul>
					</div>
					<input id="search_input" class="form-control input-lg" type="text" placeholder="Search again..." id="search-project">
					<div class="input-group-btn">
						<button type="button" id="search_bt" class="btn btn-default">
							&nbsp;&nbsp;&nbsp;<i class="fa fa-fw fa-search fa-lg"></i>&nbsp;&nbsp;&nbsp;
						</button>
					</div>
				</div>

				<!--<h1 class="font-md"> Search Results for <span class="semi-bold">Projects</span><small class="text-danger"> &nbsp;&nbsp;(2,281 results)</small></h1>-->

				<div id="tempSearchResult"></div>

				<!--<div class="text-center">
					<hr>
					<ul class="pagination no-margin">
						<li class="prev disabled">
							<a href="javascript:void(0);">Previous</a>
						</li>
						<li class="active">
							<a href="javascript:void(0);">1</a>
						</li>
						<li>
							<a href="javascript:void(0);">2</a>
						</li>
						<li>
							<a href="javascript:void(0);">3</a>
						</li>
						<li class="next">
							<a href="javascript:void(0);">Next</a>
						</li>
					</ul>
					<br>
					<br>
					<br>
				</div>-->

			</div>

			<div class="tab-pane fade" id="s2">
				<h1> Search <span class="semi-bold">Users</span></h1>
				<br>
				<div class="input-group input-group-lg">
					<input class="form-control input-lg" type="text" placeholder="Search again..." id="search-user">
					<div class="input-group-btn">
						<button type="submit" class="btn btn-default">
							<i class="fa fa-fw fa-search fa-lg"></i>
						</button>
					</div>
				</div>
				<h1 class="font-md"> Search Results for <span class="semi-bold">Users</span><small class="text-danger"> &nbsp;&nbsp;(181 results)</small></h1>
				<br>
				<div class="table-responsive">

					<table id="resultTable" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="width:30px">Pic</th>
								<th>F.Name</th>
								<th>L.Name</th>
								<th>DOB</th>
								<th>Email / Username</th>
								<th>City</th>
								<th>Postal</th>
								<th>Phone</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td><img src="img/avatars/male.png" alt="" width="20"></td><td>Noble</td><td>Saunders</td><td>2002-12-07</td><td>numbers@lipliquid.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>La Puerta</td><td>54076</td><td>558-908-4575</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Anna</td><td>Meeks</td><td>2007-04-05</td><td>carmel@forkform.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Holland</td><td>73490</td><td>255-757-8495<td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Millicent</td><td>Decker</td><td>2007-03-27</td><td>agustin.murray@babyback.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Leona</td><td>45960</td><td>207-445-7704</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Misty</td><td>Mcdowell</td><td>2002-12-09</td><td>mona.doreen@processproduce.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Sweetwater</td><td>94133</td><td>707-118-9601</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr class="danger">
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Cleo</td><td>Blue</td><td>1993-04-30</td><td>collin@berry.info <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Groesbeck</td><td>12764</td><td>543-827-8732</td><td><span class="label label-danger">Disabled</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Eliza</td><td>Proctor</td><td>2003-12-26</td><td>lawanda@event.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Alto</td><td>70454</td><td>453-985-9884</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr class="success">
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Chantel</td><td>Medina</td><td>1993-04-01</td><td>marilynn.lucretia@animalanswer.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Lozano</td><td>46151</td><td>789-917-1518</td><td><span class="label label-primary">ADMIN</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Tisha</td><td>Burns</td><td>1997-10-23</td><td>luella@square.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Dayton</td><td>18943</td><td>510-644-1193</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/female.png" alt=""  width="20"></td><td>Estelle</td><td>Barton</td><td>1993-01-21</td><td>rod.quinton@whilewhip.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Texline</td><td>29712</td><td>786-799-7584</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/female.png" alt=""  width="20"></td><td>Angeline</td><td>Roman</td><td>2002-11-23</td><td>katrina.claire.lindsey@letterlevel.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Ranchitos Las Lomas</td><td>87049</td><td>645-104-7232</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Barrett</td><td>Pearce</td><td>2013-04-16</td><td>katrina.claire.lindsey@smooth.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Flowella</td><td>45074</td><td>234-002-0762</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Margarita</td><td>Lancaster</td><td>2013-11-29</td><td>terra@smokesmooth.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Grand Saline</td><td>50886</td><td>354-908-6520</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/female.png" alt=""  width="20"></td><td>Rebekah</td><td>Hatcher</td><td>2003-01-03</td><td>janelle.lourdes.laurel@antany.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Laureles</td><td>26524</td><td>345-807-9800</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr class="warning">
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Lesley</td><td>Mccall</td><td>2000-07-27</td><td>pam.kelli@recordred.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Eagle Lake</td><td>83430</td><td>255-974-8448</td><td><span class="label label-warning">Inactive</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Josephine</td><td>Cooley</td><td>2006-10-31</td><td>magdalena@accountacid.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Stagecoach</td><td>89756</td><td>502-841-8206</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Joseph</td><td>Dawson</td><td>2013-01-25</td><td>yvonne.annette.june@streetstretch.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Oyster Creek</td><td>94520</td><td>954-256-3614</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Marlin</td><td>Dorsey</td><td>1994-12-08</td><td>jerrod.weston.hershel@specialsponge.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Lubbock</td><td>19131</td><td>510-209-3012</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Reginald</td><td>Nash</td><td>2000-11-26</td><td>mel@officeoil.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Port Mansfield</td><td>24679</td><td>390-385-6930</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Helga</td><td>Johnson</td><td>2000-03-09</td><td>kirby@stiffstill.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Oakhurst</td><td>52280</td><td>443-588-7234</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Silas</td><td>Arrington</td><td>2002-11-30</td><td>lula.lola@judgejump.org <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Bayou Vista</td><td>59377</td><td>729-309-5537</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/female.png" alt=""  width="20"></td><td>Thelma</td><td>Boyer</td><td>2004-10-26</td><td>athena.janel@attemptattention.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Keller</td><td>53463</td><td>958-473-4716</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/female.png" alt=""  width="20"></td><td>Sybil</td><td>Mahoney</td><td>1994-07-16</td><td>lara@water.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Mila Doce</td><td>96556</td><td>129-759-9595</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>David</td><td>Dean</td><td>1992-12-06</td><td>ma.justina.gussie@pumppunishment.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Columbus</td><td>88557</td><td>626-095-2870</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Dina</td><td>Steward</td><td>1997-11-26</td><td>clifton.willard.daryl@far.info <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Mason</td><td>54724</td><td>912-684-8315</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Raymundo</td><td>Massey</td><td>2005-08-30</td><td>lashawn.devon@bentberry.info <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Oak Valley</td><td>95324</td><td>680-005-5225</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Nick</td><td>Mcallister</td><td>2006-07-08</td><td>deann@pleasure.info <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>San Leanna</td><td>17585</td><td>408-044-0598</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Charlene</td><td>Nance</td><td>2013-01-13</td><td>armando.felix.jimmie@ableabout.org <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Edgewater-Paisano</td><td>93799</td><td>476-739-7850</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Judy</td><td>Corbett</td><td>2013-09-15</td><td>morton.jonas.forest@horse.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Roma</td><td>39019</td><td>575-417-6267</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Shauna</td><td>Elmore</td><td>1996-03-29</td><td>mel.marcelo@rootrough.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Channelview</td><td>18778</td><td>419-563-2551</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Archie</td><td>Castillo</td><td>2001-03-11</td><td>walker.tyree@fruitfull.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Martindale</td><td>77003</td><td>197-694-7475</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Ike</td><td>Yates</td><td>2005-08-08</td><td>kathi@fiction.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Denver City</td><td>96627</td><td>562-068-2504</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>James</td><td>Harrell</td><td>2001-07-05</td><td>rolando.clay@bitter.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Sanger</td><td>38876</td><td>971-978-5229</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Hung</td><td>Walsh</td><td>2012-03-10</td><td>rory@acidacross.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Buckholts</td><td>13087</td><td>914-948-4150</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/female.png" alt=""  width="20"></td><td>Frankie</td><td>Porter</td><td>2006-05-28</td><td>aron.leopoldo.everette@businessbut.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Fair Oaks Ranch</td><td>81496</td><td>935-811-1608</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Adrienne</td><td>Dickson</td><td>2000-05-09</td><td>felipe.bennie.gerardo@boiling.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Seabrook</td><td>67641</td><td>204-684-8982</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Ursula</td><td>Covington</td><td>2009-05-16</td><td>brianne.nilda@year.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Richland</td><td>35047</td><td>101-930-4222</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Wendy</td><td>Spence</td><td>1996-02-23</td><td>hilda.gwendolyn@brass.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Slaton</td><td>82159</td><td>936-779-1161</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Sarah</td><td>Mcdaniel</td><td>2003-08-03</td><td>danny@language.com <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Needville</td><td>16354</td><td>805-226-9457</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Bobbi</td><td>Taylor</td><td>2008-09-29</td><td>wesley@sunsupport.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Santa Fe</td><td>56008</td><td>781-448-8791</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Brendan</td><td>Mckay</td><td>2010-02-13</td><td>chong@example.org <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Las Colonias</td><td>63927</td><td>414-598-1649</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Beverley</td><td>Dodson</td><td>2012-08-10</td><td>curt.quentin@crush.info <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Study Butte-Terlingua</td><td>71556</td><td>937-937-2841</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Hassan</td><td>Bullock</td><td>2008-03-12</td><td>lena.christy@historyhole.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Hutchins</td><td>49192</td><td>108-577-5112</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Mack</td><td>Huber</td><td>1999-09-07</td><td>marquita@push.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Waelder</td><td>36982</td><td>812-883-4685</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Petra</td><td>Barnett</td><td>2003-10-24</td><td>elvia.alyce.deirdre@archargument.me <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Pittsburg</td><td>55769</td><td>624-871-4479</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Suzan</td><td>Case</td><td>2012-01-20</td><td>casey@cover.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Littlefield</td><td>30080</td><td>932-088-9855</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Jon</td><td>Mueller</td><td>2012-11-19</td><td>samual.paris@change.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Temple</td><td>30219</td><td>162-525-3454</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Loyd</td><td>Valenzuela</td><td>1993-08-28</td><td>jerrold.robt.hank@seaseat.edu <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Harker Heights</td><td>37310</td><td>295-305-4911</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Tracie</td><td>Ewing</td><td>2013-01-08</td><td>sang.deon@skysleep.info <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Kennard</td><td>67299</td><td>218-444-9426</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Jame</td><td>Cooper</td><td>2013-09-18</td><td>christi@substance.org <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Keene</td><td>84931</td><td>121-381-7120</td><td><span class="label label-success">Active</span></td>
							</tr>
							<tr>
								<td><img src="img/avatars/male.png" alt=""  width="20"></td><td>Clyde</td><td>Hudson</td><td>2008-08-22</td><td>elvia@smilesmoke.info <a href="javascript:void(0);" class="pull-right"><i class="fa fa-key"></i></a></td><td>Sunset</td><td>88755</td><td>561-388-1897</td><td><span class="label label-success">Active</span></td>
							</tr>

						</tbody>
					</table>

				</div>

				<div class="text-center">
					<hr>
					<ul class="pagination no-margin">
						<li class="prev disabled">
							<a href="javascript:void(0);">Previous</a>
						</li>
						<li class="active">
							<a href="javascript:void(0);">1</a>
						</li>
						<li>
							<a href="javascript:void(0);">2</a>
						</li>
						<li>
							<a href="javascript:void(0);">3</a>
						</li>
						<li>
							<a href="javascript:void(0);">4</a>
						</li>
						<li>
							<a href="javascript:void(0);">5</a>
						</li>
						<li class="next">
							<a href="javascript:void(0);">Next</a>
						</li>
					</ul>
					<br>
					<br>
					<br>
				</div>
			</div>

			<div class="tab-pane fade" id="s3">
				<h1> Search <span class="semi-bold">history</span></h1>
				<p class="alert alert-info">
					Your search history is turned off.

				</p>

				<span class="onoffswitch-title">Auto save Search History</span>
				<span class="onoffswitch">
					<input type="checkbox" name="save_history" class="onoffswitch-checkbox" id="save_history" checked="checked">
					<label class="onoffswitch-label" for="save_history"> <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span> <span class="onoffswitch-switch"></span> </label> </span>

			</div>
			<div class='clear'></div>
		</div>

	</div>

</div>

<!-- end row -->

<script type="text/javascript">
	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();

	/*
	 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
	 * eg alert("my home function");
	 *
	 * var pagefunction = function() {
	 *   ...
	 * }
	 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
	 *
	 * TO LOAD A SCRIPT:
	 * var pagefunction = function (){
	 *  loadScript(".../plugin.js", run_after_loaded);
	 * }
	 *
	 * OR
	 *
	 * loadScript(".../plugin.js", run_after_loaded);
	 */

	// PAGE RELATED SCRIPTS

	// pagefunction

	var pagefunction = function() {

		$("#search-project").focus();

	};

	$('.dropdown-menu li a').click(function(event){

		var selectShow = $('#select-show');
		selectShow.html(event.target.id);
	});

	$("#search_input").keyup(function(event){
	    if(event.keyCode == 13){
	        $("#search_bt").click();
	    }
	});

	$("#search_bt").button().click(function() {
		$search = $('#search_input').val();

		if($search == ''){
			$( "#tempSearchResult" ).empty();
			$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h2>Search text cannot be empty!</h2></div>");
			return;
		}

		var selectShowElement = $('#select-show').html();

		if(selectShowElement != 'Everything'){
			$type = selectShowElement;
		}
		else{
			$type = "";
		}

		var request = $.ajax({
			url: "ajax/server_side/search_server_processing.php",
			dataType: "json",
			data : {
				text : $search,
				types : $type
			}
		});

		request.done( function(data) {
			//alert(JSON.stringify(data));
			$( "#tempSearchResult" ).empty();

			if(data.data == ''){
				$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h2>Your search - "+$search+" - did not match any documents.</h2><ul><li>Make sure all words are spelled correctly.</li><li>Try different keywords.</li><li>Try more general keywords.</li><li>Try fewer keywords.</li></ul></div>");
			}
			else{
				$.each(data.data, function(i, item) {
			    	//$( "#tempSearchResult" ).append(item+'['+i+']'+"####<br/>");
			    	$( "#tempSearchResult" ).append( "<div class='search-results clearfix'><h4><span class='seach-result-title'>"
			    	+item[0]+ " - " + item[1]+ "</span></h4><div><p class='note'><span>" + item[4] +" "+ item[5] +" "+ item[6] +" "+ item[7] +" "+ item[8] +" "+ item[9] + "</span></p><p class='description marginTop'>" + item[2] +"</p></div><div class='searchMetadata'>"+item[3]+"</div></div>" );
		    	});

			}

			/* Make metadata short with MORE button */

			var showChar = 160;
			var ellipsestext = "...";
			var moretext = "<b>MORE<b>";
			var lesstext = "<b>HIDE</b>";

			$('.searchMetadata').each(function() {
				var content = $(this).html();
				var contentLength = content.length;

				if(contentLength > showChar) {

					var c = content.substr(0, showChar);
					var h = content.substr(showChar, contentLength);
					var html = c +' <span class="moreellipses"></b>' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>'+h+'</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

					$(this).html(html);
				}

			});

			$(".morelink").click(function(){
				if($(this).hasClass("less")) {
					$(this).removeClass("less");
					$(this).html(moretext);
				} else {
					$(this).addClass("less");
					$(this).html(lesstext);
				}
				$(this).parent().prev().toggle();
				$(this).prev().toggle();
				return false;
			});



		});

		request.fail( function(jqXHR, textStatus) {

			console.log(jqXHR);
        	console.log('Error: '+ textStatus);

			alert( "error" );
			// alert(jqXHR);
			// alert(textStatus);
		});
	});

	// end pagefunction

	// run pagefunction on load

	pagefunction();

</script>
