<?php
$options = get_option('aboutmagic_options');
$width = (isset($options['layout_width'])) ? $options['layout_width'] : '800px';
$width = "100%";
?>

<script type="text/javascript">
jQuery(function($){
	$('.bar2').mosaic({
		animation	:	'slide'		//fade or slide
	});
	$('.cover').mosaic({
		backdrop  : '.mosaic-backdrop',
		animation	:	'slide',	//fade or slide
		hover_x		:	'400px'		//Horizontal position on hover
	});
});
</script>
<style>
	.mosaic-god {
		float:left;
		position:relative;
		overflow:hidden;
		width:250px;
		height:255px;
	}

	.mosaic-links {
		margin:0px 20px;
	}

	.mosaic-links a {
		margin-left: 10px;
	}

	.mosaic-block {
		background:#003c52 url(../img/progress.gif) no-repeat center center !important;
	}
  .mosaic-backdrop {
		background-color: #FFF !important;
	}
/* 3d9aeb */
	.mosaic-overlay {
		background-color: #FFF !important;
/*		border-left: 1px solid #cacaca;*/
	}
	.mosaic-full {
		background-image: none;
/*		background-color: #3d9aeb !important;*/
/*		color: #000;*/
/*		border-top: 1px solid #acacac;*/
		position:absolute;
		top:0;
		height:100%;
		width:100%;
	}
	#content{ width:<?php echo $width;?>; margin:0px auto; padding:0px 0px; }
	.clearfix{ display: block; height: 0; clear: both; visibility: hidden; }

	.detupper { text-transform:uppercase; }

	.details{ margin:15px 20px; color: #003c52; }
		h4{ font:300 16px 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height:160%; letter-spacing:0.15em; color:#fff;}
		p{ font:300 12px 'Lucida Grande', Tahoma, Verdana, sans-serif; color:#666; }
		a{ text-decoration:none; }

	.image_inside {
		text-align: center;
		padding: 10px 10px 0 10px;
	}
</style>
