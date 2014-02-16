<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The frontpage layout.
 *
 * @package    theme_magazine
 * @copyright  2010 John Stabinger (http://newschoollearning.com/)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
$showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div id="page">

<!-- start of header -->
	<div id="page-header">
		<div id="header-container">
			<div id="headerinner">

				<div id="headleft">
				</div>
				<div id="headright">
				<?php if ($hasheading) {
            		echo $OUTPUT->lang_menu();
            		echo $OUTPUT->login_info();
            		echo $PAGE->headingmenu;
            	} ?>
				</div>

			</div>
		</div>
	</div>
<!-- end of header -->

<!-- start of logo and menu section -->
	<div id="textcontainer-wrap">
		<div id="textcontainer">
		<?php if (!empty($PAGE->theme->settings->logo)) { ?>
			<div class="thetitle">
				<div class="innertitle">
				</div>
			</div>
		<?php } else { ?>


			<div id="nologo" <?php if(!$hascustommenu) {echo "class='nomenu'";} ?>>
				<a href="<?php echo $CFG->wwwroot; ?>" title="Home"><?php echo $PAGE->heading ?></a>
			</div>
			<?php } ?>

		<div class="rightinfo">
			<div id="menucontainer-wrap">
				<div id="menucontainer">
				<?php if ($hascustommenu) { ?>
 					<div id="custommenu"><?php echo $custommenu; ?></div>
				<?php } ?>

					</div>
				</div>
			</div>

		</div>
	</div>

<!-- end of logo and menu section -->


<!-- start of main content wraps -->
	<div id="ie6-container-wrap">
		<div id="outercontainer">
			<div id="container">
				<div id="innercontainer">

					<div id="jcontrols_button">
						<div class="jcontrolsleft">
						<?php if ($hasnavbar) { ?>
        					<div class="navbar clearfix">
            					<div class="breadcrumb"> <?php echo $OUTPUT->navbar();  ?></div>

        					</div>
        				<?php } ?>
						</div>

						<div class="jcontrolsright">
	  					<?php if ($hasnavbar) {
	   						echo $PAGE->button;
	   					} ?>
						</div>
					</div>

	<!-- start OF moodle CONTENT -->
				<div id="page-content">
        			<div id="region-main-box">
            			<div id="region-post-box">

                				<div id="region-main-wrap">
                    				<div id="region-main">
                        				<div class="region-content">

                            			<?php echo $OUTPUT->main_content() ?>
                        				</div>
                    				</div>
                				</div>

                	<?php if ($hassidepre) { ?>
               		<div id="region-pre" class="block-region">
                    	<div class="region-content">


                        	<?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                    	</div>
                	</div>
                	<?php } ?>

                	<?php if ($hassidepost) { ?>
                 	<div id="region-post" class="block-region">
                    	<div class="region-content">

                        	<?php echo $OUTPUT->blocks_for_region('side-post') ?>
                    	</div>
                	</div>
                	<?php } ?>

            			</div>
        			</div>
   				 </div>
    <!-- END OF CONTENT -->

     			 <div id="jcontrols_bottom">
      			</div>

	<!-- Containers end div above clears both -->
				</div>
			</div>
		</div>
	</div>

<!-- START OF FOOTER -->
	<div id="page-footer">
		<div id="footer-container">
			<div id="footer">

			 <?php if ($hasfooter) {
		 		echo "<div class='johndocsleft'>";
        		echo $OUTPUT->login_info();
       			echo $OUTPUT->home_link();
        		echo $OUTPUT->standard_footer_html();
        		echo "</div>";
       			} ?>

    			<?php if ($hasfooter) { ?>
    			<div class="johndocs">
      				<?php echo page_doc_link(get_string('moodledocslink')) ?>
       			</div>
    			<?php } ?>

			</div>
		</div>
	</div>


</div>


<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>