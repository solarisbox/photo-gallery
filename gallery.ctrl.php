<?php
// Allows us to use undefined variables without PHP notices
error_reporting(E_ALL & ~E_NOTICE);

// Config info for path, files, excerpt length, etc.
define("PHOTOS_PATH", "photos");
define("DESCRIPTION_FILE", "description.txt");
define("THUMBNAILS", "thumbs");

$TPL['gallery_title'] = "My Photo Gallery";
$TPL['gallery_desc'] = "My Photo Galleries From Spain!";
$TPL['controller'] = $_SERVER['PHP_SELF'];


switch ($_REQUEST['act']):

	case "onephoto":
		$TPL['ONE_GALLERY'] = true;

		//get all of the different galleries
		$FP = opendir(PHOTOS_PATH);
		$i = 0;
		while (($DIR = readdir($FP)) !== false)
		{
			if ($DIR == "." || $DIR == "..") continue;

			$PhotoDir = PHOTOS_PATH . "/" . $DIR . "/";
			$ThumbsDir = PHOTOS_PATH . "/" . $DIR . "/" . THUMBNAILS . "/";

			//Opening Thumbs Folder
			$SP = opendir($PhotoDir);
			$TPL['photo_entries'][$i] = 
				array('description' => file_get_contents($PhotoDir . DESCRIPTION_FILE));

			while ($file = readdir($SP))
			{
				if ($file == "." || $file == "..") continue;
				$ext = substr($file, strrpos($file, '.') + 1);
				if (!in_array($ext, array("jpg","jpeg","png","gif"))) continue;
								
				$TPL['photo_entries'][$i]['photos'][] = 
					array('thumbs' => ($PhotoDir . $file),
						'id' => $_REQUEST['id']);		
			}
			$i++;
			closedir($SP);  //Close Thumbs folder
				
		} 
		// echo "<pre>" ;print_r($TPL);
		closedir($FP);

		break;
	case "allphotos":
		$TPL['ALL_GALLERIES'] = true;

		//get all of the different galleries
		$FP = opendir(PHOTOS_PATH);
		$i = 0;
		while (($DIR = readdir($FP)) !== false)
		{
			if ($DIR == "." || $DIR == "..") continue;

			$PhotoDir = PHOTOS_PATH . "/" . $DIR . "/";
			$ThumbsDir = PHOTOS_PATH . "/" . $DIR . "/" . THUMBNAILS . "/";

			//Opening Thumbs Folder
			$SP = opendir($ThumbsDir);
			$TPL['photo_entries'][$i] = 
				array('description' => file_get_contents($PhotoDir . DESCRIPTION_FILE));

			while ($file = readdir($SP))
			{
				if ($file == "." || $file == "..") continue;
				$ext = substr($file, strrpos($file, '.') + 1);
				if (!in_array($ext, array("jpg","jpeg","png","gif"))) continue;
								
				$TPL['photo_entries'][$i]['photos'][] = 
					array('thumbs' => ($ThumbsDir . $file),
						'id' => $_REQUEST['id']);		
			}
			$i++;
			closedir($SP);  //Close Thumbs folder
				
		} 
		// echo "<pre>" ;print_r($TPL);
		closedir($FP);
		
		break;

	//Show The Different Galleries
	default:
		$TPL['DEFAULT_GALLERIES'] = true;

		//get all of the different galleries
		$FP = opendir(PHOTOS_PATH);
		$i = 0;
		while (($DIR = readdir($FP)) !== false)
		{
			if ($DIR == "." || $DIR == "..") continue;

			$PhotoDir = PHOTOS_PATH . "/" . $DIR . "/";
			$ThumbsDir = PHOTOS_PATH . "/" . $DIR . "/" . THUMBNAILS . "/";

			//Opening Thumbs Folder
			$SP = opendir($ThumbsDir);
			$TPL['photo_entries'][$i] = 
				array('description' => file_get_contents($PhotoDir . DESCRIPTION_FILE));

			while ($file = readdir($SP))
			{
				if ($file == "." || $file == "..") continue;
				$ext = substr($file, strrpos($file, '.') + 1);
				if (!in_array($ext, array("jpg","jpeg","png","gif"))) continue;
								
				$TPL['photo_entries'][$i]['photos'][] = 
					array('thumbs' => ($ThumbsDir . $file),
						'id' => $_REQUEST['id']);		
			}
			$i++;
			closedir($SP);  //Close Thumbs folder
				
		} 
		// echo "<pre>" ;print_r($TPL);
		closedir($FP);

		
endswitch;

include "gallery.view.php";
?>