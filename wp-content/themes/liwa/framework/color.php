<?php
$root =dirname(dirname(dirname(dirname(dirname(__FILE__)))));
//echo $root; 
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
global $theme_option; 
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
$b=$theme_option['main-color'];
$rgba = hex2rgb($b); 
?>
/* Color Theme - Amethyst /Violet/

color - <?php echo $theme_option['main-color']; ?>

/* 01 MAIN STYLES
****************************************************************************************************/
a {
  color: <?php echo $theme_option['main-color']; ?>;
}
::selection {
  color: #fff;
  background: <?php echo $theme_option['main-color']; ?>;
}
::-moz-selection {
  color: #fff;
  background: <?php echo $theme_option['main-color']; ?>;
}
a, a:visited,
#not-found i,
.comment-by span.reply a:hover,
.comment-by span.reply a:hover i,
.widget_archive li a:hover, .widget_categories li a:hover, .widget_meta abbr, .widget_recent_entries li a:hover,
.testimonials-author,
.happy-clients-author,
.dropcap,
.team-name h5:hover,
.meta ul li a:hover,
.list-1 li:before,
.list-2 li:before,
.list-3 li:before,
.list-4 li:before  { color: <?php echo $theme_option['main-color']; ?>; }
.circle-featured i {
	color: <?php echo $theme_option['main-color']; ?>;
}
.shop figcaption {
	color: <?php echo $theme_option['main-color']; ?>;
}
.shop figcaption a {
	background: <?php echo $theme_option['main-color']; ?>;
}
input.search-blog {
	border: thin solid <?php echo $theme_option['main-color']; ?>;
}
.grid figcaption {
	color: <?php echo $theme_option['main-color']; ?>;
}
.grid figcaption a {
	background: <?php echo $theme_option['main-color']; ?>;
}
.menu ul > li.current-menu-parent a.dropdown-toggle, .menu ul li.current-menu-item a,
.menu ul li a:hover,
.menu ul > li:hover > a,
.flickr-widget-blog a:hover { border-color: <?php echo $theme_option['main-color']; ?>; }
.menu ul ul { border-top-color: <?php echo $theme_option['main-color']; ?>; }
.tp-leftarrow:hover,
.tp-rightarrow:hover,
.flexslider .flex-next:hover,
.flexslider .flex-prev:hover,
.featured-box:hover > .circle,
.featured-box:hover > .circle span,
.featured-box:hover > .circle-2,
.featured-box:hover > .circle-3,
.portfolio-item:hover > figure > a .item-description,
.sb-navigation-left:hover,
.sb-navigation-right:hover,
.newsletter-btn,
.search-btn { background-color: <?php echo $theme_option['main-color']; ?>; }
#filters a:hover, .selected { background-color: <?php echo $theme_option['main-color']; ?> !important; }
.premium .plan-price,
.premium .plan-features a.button:hover { background-color: <?php echo $theme_option['main-color']; ?>; }
.premium.plan h3,
.premium .plan-features a.button { background-color: <?php echo $theme_option['main-color']; ?>; }
.featured-box:hover > .circle-2,
.featured-box:hover > .circle-3 { box-shadow: 0 0 0 8px rgba(115,184,25,0.3); }
#current:after,
.pagination .current,
.pagination ul li a:hover,
.tags a:hover,
.button.gray:hover,
.button.light:hover,
.button.color,
input[type="button"],
input[type="submit"],
input[type="button"]:focus,
input[type="submit"]:focus,
.tabs-nav li.active a,
.ui-accordion .ui-accordion-header-active:hover,
.ui-accordion .ui-accordion-header-active,
.trigger.active a,
.trigger.active a:hover,
.skill-bar-value,
.highlight.color,
.notice-box:hover { background: <?php echo $theme_option['main-color']; ?>; }
.pagination ul li > a:hover,
.pagination ul li > span:hover,
.pagination ul li > a:focus,
.pagination ul li > span:focus {
  border-color: #0f5c85;
}
.tabs-nav li a{
	border-bottom-width: 2px;
	border-bottom-style: solid;
	border-bottom-color: <?php echo $theme_option['main-color']; ?>;
}
#search-form .search-text-box {
	background-color: <?php echo $theme_option['main-color']; ?>;
}
.punch_text2 {

}
.text_headline{
	color: <?php echo $theme_option['main-color']; ?>;
	font-weight: bold;
}
.menu ul > li.current-menu-parent a.dropdown-toggle, .menu ul li.current-menu-item a {
	color:<?php echo $theme_option['main-color']; ?>;
}
.menu ul li a:hover{
	color:<?php echo $theme_option['main-color']; ?>;
}
.portfolio-item:hover > figure > a .item-description h5 {
	color: <?php echo $theme_option['main-color']; ?>;
}
.pin-box h4 a:hover, .tline-box h4 a:hover { 
	color:<?php echo $theme_option['main-color']; ?>;
}
.tline-topdate {
	background:<?php echo $theme_option['main-color']; ?>;
}
.blog-cat li:hover h4 {
	color:<?php echo $theme_option['main-color']; ?>;
}
.blog-cat li.blog-cat-done {
  color: <?php echo $theme_option['main-color']; ?>;
}
.blog-cat li.blog-cat-done .blog-cat-name {
  color: <?php echo $theme_option['main-color']; ?>;
}
blockquote {
	border-left: 3px solid <?php echo $theme_option['main-color']; ?>;
}
.plan-price, .woocommerce .woocommerce-message:before, .woocommerce-page .woocommerce-message:before {
	background-color: <?php echo $theme_option['main-color']; ?>;
}
.woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message {
  border-top: 3px solid <?php echo $theme_option['main-color']; ?>;
}
.flat-box:hover i{
	color: <?php echo $theme_option['main-color']; ?>;
}
.mi-slider nav a:hover,
.mi-slider nav a.mi-selected {
	color: <?php echo $theme_option['main-color']; ?>;
}

.shop-price{
	color: <?php echo $theme_option['main-color']; ?>;
}
.shop-price-detail{
	color: <?php echo $theme_option['main-color']; ?>;
}
.tline-topdate {
	border: 1px solid <?php echo $theme_option['main-color']; ?>;
}
.blog-cat-title, #wp-calendar tbody td#today{
	background: <?php echo $theme_option['main-color']; ?>;
}
.promo-box:hover > .circle-2 {
	background-color: <?php echo $theme_option['main-color']; ?>;
	box-shadow: 0 0 0 8px #0f5c85;
}
a.rsswidget:hover, .searchForm .submitSearch {
	color: <?php echo $theme_option['main-color']; ?>;
}
.woocommerce #content input.button, 
.woocommerce #respond input#submit, 
.woocommerce a.button, 
.woocommerce button.button, 
.woocommerce input.button, 
.woocommerce-page #content input.button, 
.woocommerce-page #respond input#submit, 
.woocommerce-page a.button, 
.woocommerce-page button.button, 
.woocommerce-page input.button,
.woocommerce #content input.button.alt,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce-page #content input.button.alt,
.woocommerce-page #respond input#submit.alt,
.woocommerce-page a.button.alt,
.woocommerce-page button.button.alt,
.woocommerce-page input.button.alt{
	background:<?php echo $theme_option['main-color']; ?>;
	background:-webkit-gradient(linear,left top,left bottom,from(<?php echo $theme_option['main-color']; ?>),to(<?php echo $theme_option['main-color']; ?>));
	background:-webkit-linear-gradient(<?php echo $theme_option['main-color']; ?>,<?php echo $theme_option['main-color']; ?>);
	background:-moz-linear-gradient(center top,<?php echo $theme_option['main-color']; ?> 0,<?php echo $theme_option['main-color']; ?> 100%);
	background:-moz-gradient(center top,<?php echo $theme_option['main-color']; ?> 0,<?php echo $theme_option['main-color']; ?> 100%);
}
.woocommerce .woocommerce-info:before, .woocommerce-page .woocommerce-info:before {
  background-color: <?php echo $theme_option['main-color']; ?>;
}
/************** FOOTER *******************/
#footer {
  background: none repeat scroll 0 0 <?php echo $theme_option['background-footer']; ?>;
  color: <?php echo $theme_option['color-footer']; ?>;
}
#footer-bottom {color: <?php echo $theme_option['color-footer']; ?>;}