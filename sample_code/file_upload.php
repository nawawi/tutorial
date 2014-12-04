<?php
// upload single atau multiple files

function _check_upload_filename($file, $max_file_length = 260) {
	$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';
	$file_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($file) );
	if ( strlen($file_name) == 0 || strlen($file_name) > $max_file_length ) {
		return false;
	}
	return true;
}

function _get_upload_max_size() {
	$post_max_size = ini_get('post_max_size');
	$unit = strtoupper(substr($post_max_size, -1));
	$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));
	$size = $multiplier*(int)$post_max_size;
	return $size;
}

function _check_upload_post_max_size() {
	$size = _get_upload_max_size();
	if ((int)$_SERVER['CONTENT_LENGTH'] > $size) {
		return false;
	}
	return true;
}

if ( isset($_FILES) && !empty($_FILES) ) {
    if ( !_check_upload_post_max_size() ) {
        echo "File terlalu besar!<br>";
        exit;
    }

    foreach( $_FILES as $name => $next ) {
        $ok = true;

        // file yang diupload ke server, disimpan dalam tempory folder di server
        $file_tmp = $_FILES[$name]['tmp_name'];

        // nama file yang original. nama file ketika upload
        $file_ori = $_FILES[$name]['name'];

        if ( !_check_upload_filename($file_ori) ) {
            echo "File tidak dibenarkan<br>";
            exit;
        }

        // uload directory: tempat simpan file yang diupload
        $dest_dir = "C:/xampp/htdocs/test/upload";

        // hendak filter nama file
        if ( $file_ori == "test.txt" ) {
            echo "File txt tidak dibenarkan!!<br>";
            $ok = false;
        }

        if ( strstr($file_ori,".php" ) ) {
            echo "File PHP tidak dibenarkan!!<br>";
            $ok = false;
        }

        // outputkan info
        echo "FILE TEMP: $file_tmp<br>";
        echo "FILE ORI: $file_ori<br><br>";

        if ( $ok ) {
            // copy temp file ke destination
            if ( move_uploaded_file( $file_tmp, $dest_dir."/".$file_ori ) ) {
                echo "Berjaya: <a href='upload/$file_ori' target='_blank'>$file_ori</a><br>";
            } else {
                echo "Tidak Berjaya: $file_ori<br>";
            }
        }
    }
} else {
    echo "Sila pilih fail<br>";
}

?>

<form action="index.php" method="post" enctype="multipart/form-data">
File 1: <input type="file" name="file1" value=""><br>
File 2: <input type="file" name="file2" value="">
<input type="submit" value="click">
</form>

