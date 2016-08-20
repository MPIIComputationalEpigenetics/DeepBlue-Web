		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<span class="login-info">
				<i class="fa fa-user"></i>
				<a data-container="body" class="menu-item-parent bootstro" data-bootstro-step=0 data-bootstro-placement="bottom"
					data-bootstro-content="You can view and edit your profile. You can also see your permission level and user-key."
					href="#ajax/profile.php" title="Profile">
					<?php echo $_SESSION['user_name'] ?>
				</a>
			</span>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!-- NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional hre="" links. See documentation for details.
				-->
				<ul>
					<?php
                        $nav_no = 0;
						foreach ($page_nav as $key => $nav_item) {
							//process parent nav
							$nav_htm = '';
							$url = isset($nav_item["url"]) ? $nav_item["url"] : "#";
							$url_target = isset($nav_item["url_target"]) ? 'target="'.$nav_item["url_target"].'"' : "";
							$icon_badge = isset($nav_item["icon_badge"]) ? '<em>'.$nav_item["icon_badge"].'</em>' : '';
							$icon = isset($nav_item["icon"]) ? '<i class="fa fa-lg fa-fw '.$nav_item["icon"].'">'.$icon_badge.'</i>' : "";
							$nav_title = isset($nav_item["title"]) ? $nav_item["title"] : "(No Name)";
							$nav_id = $key.'_id';
							$nav_elevated = isset($nav_item["elevated"]) ? $nav_item["elevated"] : false;
                            $nav_description = isset($nav_item["description"]) ? $nav_item["description"] : "Empty Description";
							$label_htm = isset($nav_item["label_htm"]) ? $nav_item["label_htm"] : "";

							if ($nav_elevated && (!$_SESSION['elevated_user'])) {
								$nav_htm .= '<a id="'.$nav_id.'" data-container="body" class="side-menu" href="'.$url.'" '.$url_target.
									' title="'.$nav_title.'">'.$icon.' <span class="menu-item-parent">'.$nav_title.'</span>'.$label_htm.'</a>';
							}
							else {
								$nav_no = $nav_no + 1;
								$nav_htm .= '<a id="'.$nav_id.'" data-container="body" class="bootstro side-menu" data-bootstro-step='.$nav_no.
									' data-bootstro-placement="right" data-bootstro-content="'.$nav_description.'" href="'.$url.'" '.$url_target.
									' title="'.$nav_title.'">'.$icon.' <span class="menu-item-parent">'.$nav_title.'</span>'.$label_htm.'</a>';
							}

							if (isset($nav_item["sub"]) && $nav_item["sub"])
								$nav_htm .= process_sub_nav($nav_item["sub"]);

							if ($nav_elevated && (!$_SESSION['elevated_user'])) {
								echo '<li '.(isset($nav_item["active"]) ? 'class = "active"' : '').' style="display:none">'.$nav_htm.'</li>';
							}
							else {
								echo '<li '.(isset($nav_item["active"]) ? 'class = "active"' : '').'>'.$nav_htm.'</li>';
							}
						}

						function process_sub_nav($nav_item) {
							$sub_item_htm = "";
                            if (isset($nav_item["sub"]) && $nav_item["sub"]) {
								$sub_nav_item = $nav_item["sub"];
								$sub_item_htm = process_sub_nav($sub_nav_item);
							} else {
								$sub_item_htm .= '<ul>';
								foreach ($nav_item as $key => $sub_item) {
									$url = isset($sub_item["url"]) ? $sub_item["url"] : "#";
									$url_target = isset($sub_item["url_target"]) ? 'target="'.$sub_item["url_target"].'"' : "";
									$icon = isset($sub_item["icon"]) ? '<i class="fa fa-lg fa-fw '.$sub_item["icon"].'"></i>' : "";
                                    $nav_title = isset($sub_item["title"]) ? $sub_item["title"] : "(No Name)";
                                    $label_htm = isset($sub_item["label_htm"]) ? $sub_item["label_htm"] : "";
									$sub_item_htm .=
										'<li '.(isset($sub_item["active"]) ? 'class = "active"' : '').'>
											<a href="'.$url.'" '.$url_target.'>'.$icon.' '.$nav_title.$label_htm.'</a>
											'.(isset($sub_item["sub"]) ? process_sub_nav($sub_item["sub"]) : '').'
										</li>';
								}
								$sub_item_htm .= '</ul>';
							}
							return $sub_item_htm;
						}
					?>
				</ul>

			</nav>
			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->