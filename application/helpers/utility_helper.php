<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     if ( ! function_exists('asset_url()'))
     {
       function asset_url()
       {
          return base_url().'assets/';
       }
       
     }
     if ( ! function_exists('create_preview_image()'))
     {
        function create_preview_image ( $original_path, $thumbnail_path, $x_thumbnail, $y_thumbnail ) {
    $result = FALSE;
    if ( is_file( $original_path ) && is_readable( $original_path )  ) {
        // Определяем тип изображения
        $image_data = getimagesize( $original_path );
        if ( $image_data && isset( $image_data['mime'] ) ) {
            $tmp_var = explode( '/', $image_data['mime'] );
            $mime = strtolower( array_pop( $tmp_var  ) );
        } else {
            $mime = 'jpeg';
        }
        // Открываем изображение
        switch ( $mime ) {
            case 'jpg':
            case 'jpe':
            case 'jpeg':
                $image_original = imagecreatefromjpeg( $original_path );
                break;
            case 'png':
                $image_original = imagecreatefrompng( $original_path );
                break;
            case 'gif':
                $image_original = imagecreatefromgif( $original_path );
                break;
            case 'wbmp':
                $image_original = imagecreatefromwbmp( $original_path );
                break;
            default:
                return FALSE;
        }
        // Получаем размеры оригинала
        list( $x_original, $y_original ) = $image_data;
        // Создаем миниатюру
        $image_thumbnail = imagecreatetruecolor( $x_thumbnail, $y_thumbnail );
        if ( $mime == 'png' ) {
            // Сохраняем альфа-канал
            imagealphablending( $image_thumbnail, FALSE );
            imagesavealpha( $image_thumbnail, TRUE );
        } elseif ( $mime == 'gif'  ) {
            if ( ( $transparent_index_original = imagecolortransparent( $image_original ) ) ) {
                // Определяем прозрачный цвет и передаем его в миниатюру
                $transparent_color_original = imagecolorsforindex( $image_original, $transparent_index_original );
                $transparent_index_thumbnail = imagecolorallocate(
                    $image_thumbnail,
                    $transparent_color_original['red'],
                    $transparent_color_original['green'],
                    $transparent_color_original['blue']
                );
                imagecolortransparent( $image_thumbnail, $transparent_index_thumbnail );
                imagefill( $image_thumbnail, 0, 0, $transparent_index_thumbnail );
            }
        }
        // Вычисляем размер по ширине
        $x_original_new = (integer) ( $x_thumbnail * ( $y_original / $y_thumbnail ) );
        // Проверяем, не вышли ли за пределы изображения
        if ( $x_original_new > $x_original ) {
            // Вышли. Тогда вычисляем размер по высоте
            $y_original_new = (integer) ( $y_original * ( $x_original / $x_original_new ) );
            $x_original_new = $x_original;
        } else {
            $y_original_new = $y_original;
        }
        // Вычисляем срезы сторон
        $x_indent = $x_original_new - $x_original;
        $y_indent = $y_original_new - $y_original;
        // Вычисляем смещение
        $x_original_offset = ( $x_indent !== 0 ) ? -(integer) ( $x_indent / 2 ) : 0;
        $y_original_offset = ( $y_indent !== 0 ) ? -(integer) ( $y_indent / 2 ) : 0;
 
        echo <<<HTML
            <!-- Отладка, вывод данных и миниатюры -->
            <span style="display: inline-block; float: left; border: 1px solid #eee; margin: 5px; padding: 5px; background: #eee;">
 
                Thumbnail: {$x_thumbnail} x {$y_thumbnail}<br />
                Original: {$x_original} x {$y_original}                Cropped: {$x_original_new} x {$y_original_new}<br />
                Indent: {$x_indent} x {$y_indent}                Offset: {$x_original_offset} x {$y_original_offset}<br />
                <img src="/___/{$thumbnail_path}" />
            </span>
HTML;
 
        // Копируем изображение в миниатюру
        imagecopyresampled( $image_thumbnail, $image_original, 0, 0, $x_original_offset, $y_original_offset, $x_thumbnail, $y_thumbnail, $x_original_new, $y_original_new );
        // Сохраняем миниатюру
        switch ( $mime ) {
            case 'jpg':
            case 'jpe':
            case 'jpeg':
                $result = imagejpeg( $image_thumbnail, $thumbnail_path, 100 );
                break;
            case 'png':
                $result = imagepng( $image_thumbnail, $thumbnail_path );
                break;
            case 'gif':
                $result = imagegif( $image_thumbnail, $thumbnail_path );
                break;
            case 'wbmp':
                $result = imagewbmp( $image_thumbnail, $thumbnail_path );
                break;
        }
        // Очищаем память
        imagedestroy( $image_original );
        imagedestroy( $image_thumbnail );
    }
    if ($result) {
         return '{"status":"success"}';
    } else {
         return '{"status":"false"}';
    }
    
    return $result;
}
 
     }
     if ( ! function_exists('in_array_r()'))
     {
     function in_array_r($elem, $array, $field ) {
        $top = sizeof($array) - 1;

    $bottom = 0;
    while($bottom <= $top)
    {
        if($array[$bottom][$field] == $elem)
            return true;
        else 
            if(is_array($array[$bottom][$field]))
                if(in_multiarray($elem, ($array[$bottom][$field])))
                    return true;

        $bottom++;
    }        
    return false;
}
if ( ! function_exists('createImageFromFile()'))
     {
    function createImageFromFile($filename, $use_include_path = false, $context = null, &$info = null)
{
  // try to detect image informations -> info is false if image was not readable or is no php supported image format (a  check for "is_readable" or fileextension is no longer needed)
  $info = array("image"=>getimagesize($filename));
  $info["image"] = getimagesize($filename);
  if($info["image"] === false) throw new InvalidArgumentException("\"".$filename."\" is not readable or no php supported format");
  else
  {
    // fetches fileconten from url and creates an image ressource by string data
    // if file is not readable or not supportet by imagecreate FALSE will be returnes as $imageRes
    $imageRes = imagecreatefromstring(file_get_contents($filename, $use_include_path, $context));
    // export $http_response_header to have this info outside of this function
    if(isset($http_response_header)) $info["http"] = $http_response_header;
    return $imageRes;
  }
}
}
if ( ! function_exists('thumbnail_center()'))
     {
function thumbnail_center($source = false, $dest = false,$iWidthCenter = 150, $iHeightCenter = 150){
    if ($source === false) {
      return "No, no, no";
    } else 
    {
        $RootFolder = $_SERVER['DOCUMENT_ROOT'].'/';
  //$source = '/'.$source;
  if(file_exists($RootFolder.$dest)){
    
  }
  $jpeg_quality = 80;
  $img_r = createImageFromFile($source);
  $size = getimagesize($source);
  if ($size[0]<$iHeightCenter or $size[1]<$iWidthCenter){
    $Hp=$iHeightCenter-$size[0];
    $Wp=$iWidthCenter-$size[1];
    $size[0] = $size[0]+$Hp;
    $size[1] = $size[1]+$Wp;
    //return '{"status":"false","message":" Высота или ширина больше чем само изображение"}'; 

}

  $iMarginTop = round((($size[0] - $iHeightCenter) / 2));
  $iMarginLeft = round((($size[1] - $iWidthCenter) / 2));
  

      
  $dst_r = ImageCreateTrueColor( $iWidthCenter, $iHeightCenter );
  imageAlphaBlending($dst_r, false);
  imageSaveAlpha($dst_r, true);
  imagecopyresampled($dst_r,$img_r,0,0,intval($iMarginTop),intval($iMarginLeft), $iWidthCenter,$iHeightCenter, intval($iWidthCenter),intval($iHeightCenter));
  if (imagejpeg($dst_r,$dest,$jpeg_quality)) {
    return '{"status":"success","message":" '.$iWidthCenter.' X '.$iHeightCenter.'"}';
  }

  exit;
}
}
}
if ( ! function_exists('human_filesize()'))
     {
function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}
}
function file_force_contents($dir, $contents){
        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';
        foreach($parts as $part)
            if(!is_dir($dir .= "/$part")) mkdir($dir);
        file_put_contents("$dir/$file", $contents);
    }
}