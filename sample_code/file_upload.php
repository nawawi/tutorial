<?php
// upload single atau multiple files

if ( isset($_FILES) && !empty($_FILES) ) {
    foreach( $_FILES as $name => $next ) {
        $ok = true;

        // file yang diupload ke server, disimpan dalam tempory folder di server
        $file_tmp = $_FILES[$name]['tmp_name'];

        // nama file yang original. nama file ketika upload
        $file_ori = $_FILES[$name]['name'];

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

