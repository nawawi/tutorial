<?php
echo "FILE: ".__FILE__."<br>";
echo "<br>";
echo "Try browse mvc/users<br>";
echo "Try browse mvc/users/details<br>";
echo "Try browse mvc/users/save<br>";
echo "Try browse mvc/users/update<br>";
echo "Try browse mvc/users/delete<br>";

echo "<br>";
echo "<br>";
echo "<b>TEST object \$this</b><br>";
echo "<pre>";
print_r($this);
echo "</pre>";

echo "<b>TEST DB</b><br>";
echo "<pre>";
$result = $this->db->query("select * from users");
print_r($result);
echo "</pre>";

while( $row = $result->fetch_object() ) {
    echo "<pre>".print_r($row,1)."</pre>";
}
