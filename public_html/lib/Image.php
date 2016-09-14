<?php

class Image {

	public function __construct(){
	}

	public static function compress($source, $destination, $quality=80, $returnFormat="jpeg"){
		$info = getimagesize($source);
		switch($info['mime']){
			case "image/gif":
				$image = imagecreatefromgif($source);
			break;

			case "image/jpeg":
				$image = imagecreatefromjpeg($source);
			break;

			case "image/png":
				$image = imagecreatefrompng($source);
				imageAlphaBlending($image, true);
				imageSaveAlpha($image, true);
			break;

			default: throw new Exception("IMAGE_MIMETYPE_NOTSUPPORTED"); break;
		}

		switch($returnFormat){
			case "jpeg":
				imagejpeg($image, $destination, $quality);
			break;

			case "png":
				imagepng($image, $destination, $quality);
			break;

			default: throw new Exception("IMAGE_RETURNFORMAT_NOTSUPPORTED"); break;
		}

		return $destination;	
	}


	public static function resize($image, $destination, $width, $height, $crop=false){
		list($width, $height) = getimagesize($image);
		$r = $width / $height;
		if($crop){
			if($width > $height){
				$width = ceil($width - ($width*abs($r - $width/$height)));
			}
			else {
				$height = ceil($height - ($height*abs($r - $width/$height)));
			}

			$newwidth = $width;
			$newheight = $height;
		}
		else {
			if($width/$height > $r){
				$newwidth = $height*$r;
				$newheight = $height;
			}
			else {
				$newheight = $width / $r;
				$newwidth = $width;
			}
		}

		$info = getimagesize($image);
		switch($info['mime']){
			case "image/jpeg":
				$image_p = imagecreatetruecolor($newwidth, $newheight);
				$source = imagecreatefromjpeg($image);		

				imagecopyresampled($image_p, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

				imagejpeg($image_p, $destination, 100);
			break;

			case "image/png":
				$image_p = imagecreatetruecolor($newwidth, $newheight);
				$source = imagecreatefrompng($image);		

				imagecopyresampled($image_p, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

				imagepng($image_p, $destination, 9);
			break;
		}


		
		return $destination;
	}

}