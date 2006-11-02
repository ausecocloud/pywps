<?php
/**********************************************************************
 *
 * purpose: an AJAX interface to Pywps
 *
 * authors: Luca Casagrande (...) and Lorenzo Becchi (lorenzo@ominiverdi.com)
 *
 *   - it should work like this (jachym suggestion): 
 *		1) user will set the server address 
 *		2) webinterface would getcapabilities - all the processes offered by the server 
 * 		3) user would choose some process 
 * 		4) web interface would describe process and create input form for the user
 * 
 *   TODO:
 * 		- tranlate all comments in english
 * 		- stick to the planned interface
 * 
 **********************************************************************
 *
 * Copyright (C) 2006 ominiverdi.org
 *  
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *  
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 **********************************************************************/


// Parametri di default

$script_name = "template_pywps.php";
$map_path = "/home/geko/progetti/pywps/";
$map_file = "spearfish.map";
$img_path = "/var/www/localhost/htdocs/tmp/";
$pywps_path = "/var/www/localhost/htdocs/wps/wpsoutputs/";

// Crea l'oggetto map per il mapfile specificato

if(extension_loaded('MapScript')){
	$map = ms_newMapObj($map_path.$map_file);

// Crea la prima immagine
    
	$map_id = sprintf("%0.6d",rand(0,999999));
        $image_name = "pywps".$map_id.".png";
        $image_url="/tmp/".$image_name;
        $image=$map->draw();
        $image->saveImage($img_path.$image_name);

// Il form viene inviato

if (isset($_POST['submit']))
    {
    include ('mod/r_los.php');
    }
} else {
	$image_url= 'tmp/pywps616979.png';
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>PyQPS Test Project by DokToreAs</title>
		<script type="text/javascript" src="js/xhr.js"></script>
		<script type="text/javascript" src="js/startUp.js"></script>
		<link href="css/screen.css" rel="stylesheet" type="text/css" media="all">
	</head>
	<body>
        
<div id="header">
	<h1>GRASS visibility module</h1>
	<p>
		<strong>r.los</strong> generates a raster map output in which the cells that are visible from a user-specified observer location are marked with integer values that represent the vertical angle (in degrees) required to see those cells (viewshed).

	</p>
	<p><strong>Usage:</strong> click on map to set <em>coords</em>. Use selects to change <em>distance</em> and
	<em>height</em> params.<br>
	Then click on <strong>Go!</strong> button to see overlayed output.
	</p>
</div>
<div id="output">
<img id="outimg" src="<?php echo $image_url;?>" width="640" height="480" />
</div>

<div  id="params">
<form method="post" action="index.php">
	<fieldset>
	<legend>Params</legend>
        <label>X:</label><span id="xvalue_span">0</span> 
		<input type="hidden" name="xvalue" id="xvalue" size="20" maxlength="40" value="599043" />		
        <label>Y:</label><span id="yvalue_span">0</span> 
		<input type="hidden" name="yvalue" id="yvalue" size="20" maxlength="40" value="4921752" />
		<p><label>Max distance where check visibility:<br> (range <span id="maxdist_range"></span>)</label>
		<!--<input type="text" name="maxdist" size="20" maxlength="40" value="" />-->
		<select name="maxdist" id="maxdist">
		</select></p>
		<p><label>Height of the observer:<br> (range <span id="observer_range"></span>)</label>
		<!--<input type="text" name="observer" size="20" maxlength="40" value="" />-->
		<select name="observer" id="observer">
		</select></p>
		<input type="button" name="submit" id="go" value="Go!" />
	</fieldset>
	
	<!-- 
		INTERFACE PARAMS
		this hidden fields for interface params 
	-->
	<input type="hidden" name="map_extent" id="map_extent" value="588913.043478,4913700.000000,610066.956522,4928010.000000">
	<input type="hidden" name="distance_extent" id="distance_extent" value="500,1500">
	<input type="hidden" name="height_extent" id="height_extent" value="1,3">
	

</form>
</div>
<div id="console">
<textarea name="console" id="consolearea">
</textarea>
</div>
</body>
</html>