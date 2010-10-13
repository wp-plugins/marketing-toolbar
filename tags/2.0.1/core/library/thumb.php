<?php
/*
PHP Thumber class built by Sovit Tamrakar
Author URl: http://ssovit.com

*/
if(!class_exists('Thumber')){
class Thumber
{
	var $old_width = "";
	var $old_height = "";
	var $width = "";
	var $height = "";
	var $src = NULL;
	var $zc = true;
	var $zcd = false;
	var $tmp_image = "";
	var $my_canvas = "";
	var $quality = 90;
	var $mime = "";
	var $ratio = "";
	var $thumb_path = "";
	var $error = false;
	var $upload_dir = "";
	var $upload_url = "";
	var $new_name = "";
	var $def_img = "1.jpg";
	var $dir = NULL;
	var $thumb_url = "";
	var $new_image = "";
	var $thumb_exist = false;
	var $defaultParam = array();
	var $ds=NULL;
	function _mime_type()
	{
		$this->thumb_path = $this->upload_dir.$this->ds.$this->dir;
		checkDir($this->thumb_path);
		$size       = @getimagesize( $this->src );
		if(empty($size)){
			$this->error=true;
		}
		$this->mime = $size[ 'mime' ];
		$nameonly        = substr( basename( $this->src ), 0, strrpos( basename( $this->src ), "." ) );
		$this->new_name  = $nameonly . "-" . $this->width . "x" . $this->height . ".jpg";
		$this->thumb_url =$this->upload_url.$this->ds.$this->dir.$this->ds. $this->new_name;
		$this->new_image = $this->thumb_path .$this->ds. $this->new_name;
		if ( @getimagesize( $this->new_image ) ) {
			$this->thumb_exists = true;
		}
	}
	function _open_image()
	{
		if ( !$this->thumb_exist && !$this->error) {
			if ( stristr( $this->mime, 'gif' ) ) {
				if($this->tmp_image = @imagecreatefromgif( $this->src )){
					$this->error=false;
				}else{
					$this->error=true;
				}
			} elseif ( stristr( $this->mime, 'jpeg' ) ) {
				ini_set( 'gd.jpeg_ignore_warning', 1 );
				if($this->tmp_image = @imagecreatefromjpeg( $this->src )){
					$this->error=false;
				}else{
					$this->error=true;
				}
			} elseif ( stristr( $this->mime, 'png' ) ) {
				if($this->tmp_image = @imagecreatefrompng( $this->src )){
					$this->error=false;
				}else{
					$this->error=true;
				}
			} else {
				$this->error=true;
			}
		}
	}
	function _create_dimensions()
	{
		if ( !$this->thumb_exist && !$this->error) {
			$this->old_width  = imagesx( $this->tmp_image );
			$this->old_height = imagesy( $this->tmp_image );
			$this->ratio      = $this->old_width / $this->old_height;
			if ( $this->width > $this->old_width ) {
				$this->width = round($this->old_width);
			}
			if ( $this->height > $this->old_height ) {
				$this->height = round($this->old_height);
			}
			if ( $this->width && !$this->height ) {
				$this->height = round($this->width / $this->ratio);
			} elseif ( $this->height && !$this->width ) {
				$this->width = round($this->height * $this->ratio);
			} elseif ( !$this->width && !$this->height ) {
				$this->widht  = round($this->old_width);
				$this->height = round($this->old_height);
			}
			$nameonly        = substr( basename( $this->src ), 0, strrpos( basename( $this->src ), "." ) );
			$this->new_name  = $nameonly . "-" . $this->width . "x" . $this->height . ".jpg";
			$this->thumb_url =$this->upload_url.$this->ds.$this->dir.$this->ds. $this->new_name;
			$this->new_image = $this->thumb_path .$this->ds. $this->new_name;
			if ( @getimagesize( $this->new_image ) ) {
				$this->thumb_exists = true;
			}
			$this->my_canvas = imagecreatetruecolor( $this->width, $this->height );
		}
	}
	function _crop_image()
	{
		if ( !$this->thumb_exist && !$this->error) {
			if ( $this->zc ) {
				$src_x = $src_y = 0;
				$src_w = $this->old_width;
				$src_h = $this->old_height;
				$cmp_x = $this->old_width / $this->width;
				$cmp_y = $this->old_height / $this->height;
				if ( $cmp_x > $cmp_y ) {
					$src_w = round( ( $this->old_width / $cmp_x * $cmp_y ) );
					$src_x = round( ( $this->old_width - ( $this->old_width / $cmp_x * $cmp_y ) ) / 2 );
				} elseif ( $cmp_y > $cmp_x ) {
					$src_h = round( ( $this->old_height / $cmp_y * $cmp_x ) );
					$src_y = round( ( $this->old_height - ( $this->old_height / $cmp_y * $cmp_x ) ) / 2 );
				}
				imagecopyresampled( $this->my_canvas, $this->tmp_image, 0, 0, $src_x, $src_y, $this->width, $this->height, $src_w, $src_h );
				$this->zcd = true;
			} else {
				imagecopyresampled( $this->my_canvas, $this->tmp_image, 0, 0, 0, 0, $this->width, $this->height, $this->old_width, $this->old_height );
			}
		}
	}
	function _save_image()
	{
		if ( !$this->thumb_exist && !$this->error) {
			@imagejpeg( $this->my_canvas, $this->new_image, $this->quality );
			@chmod( $this->new_image, 0777 );
		}
	}
	function _create_image()
	{
		$this->_mime_type();
		$this->_open_image();
		$this->_create_dimensions();
		$this->_crop_image();
		$this->_save_image();
	}
	function image( $image = NULL, $width = false, $height = false, $zc = true )
	{
		$this->ds=DIRECTORY_SEPARATOR;
		$this->width  = $width;
		$this->height = $height;
		$this->zc     = $zc;
		$this->src = $image; // check if its a url to image
		if ( !@getimagesize( $this->src ) ) {
			$this->src    = $this->upload_dir.$this->ds.$image; // Try to find it in upload directory
		} else {
			$this->error=true;
		}
		$this->_create_image();
		//if($this->error){return $this->src;}
		return  str_replace( "\\", "/", $this->thumb_url );
	}
}
}
?>