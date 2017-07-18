<?php
/**
 * Template Name: Full Width Page
 *
 * @package WordPress
 */
?>
<!DOCTYPE html>
<html>
<head>
	<title>African Banker Magazine</title>
	<style type="text/css">
		body { font-family: arial, helvetica, sans-serif; margin:0;}
		h3{ color: #0089b4; }
		p{ font-size: smaller;}
		.formthing{     width: 100%;
		    height: 21px;
		    margin: 10px;
		    font-size: 16px;
		    padding: 10px 0;
		}
		@media (min-width: 767px) {
		  #actual-form{     
		  	width: 50%;

			}

		}
		input[type=submit] {
		    padding:5px 15px; 
		    background:blue; 
		    border:0 none;
		    cursor:pointer;
		    -webkit-border-radius: 5px;
		    width:100%;
		    border-bottom:grey;
			background: #3498db;
			background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
			background-image: -moz-linear-gradient(top, #3498db, #2980b9);
			background-image: -ms-linear-gradient(top, #3498db, #2980b9);
			background-image: -o-linear-gradient(top, #3498db, #2980b9);
			background-image: linear-gradient(to bottom, #3498db, #2980b9);
			font-family: Arial;
			color: #ffffff;
			font-size: 20px;
			padding: 10px 20px 10px 20px;
			text-decoration: none;
    		margin: 20px 10px;
		}
	</style>
</head>
	<div id="container" style="width:100%; text-align:center">
		<!-- <div id="header" style="margin-bottom:70px; margin-bottom: 70px; border-top: 3px solid darkred;">
			<a target="_blank" href="http://africanbusinessmagazine.com/category/african-banker/"><img src="http://africanbusinessmagazine.com/wordpress/wp-content/themes/africanbusinessmagazine/lib/img/abm-logo.png" width="400px" /></a>
		</div> -->
			<div id="body" style="border-top: 5px solid #cb2311; background-color: lightgrey;">
				<div class="container" style="width:960px; margin-left:auto; margin-right:auto; background-color:white;">
					<div>
						<a target="_blank" href="http://africanbusinessmagazine.com/subscribe/"><img src="http://africanbusinessmagazine.com/wordpress/wp-content/uploads/2016/01/abbb.png" /></a>
					</div>
					<div id="actual-form" style="margin-left:auto; margin-right:auto;">
						<h3>Get your complimentary 12-month subscription</h3>
						<p>Simply fill out your details in the form below to claim your free copy, don't miss out</p>
						<?php 
							$id=11299; 
							$post = get_post($id); 
							$content = apply_filters('the_content', $post->post_content); 
							echo $content;  
						?>
					</div>
				</div>
			</div>
	</div>
</html>