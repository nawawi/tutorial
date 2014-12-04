<?php
echo "FILE: ".__FILE__."<br>";
echo "<pre>";
print_r($this);
echo "</pre>";

echo "<b>TEST DB</b><br>";

$result = $this->db->query("select * from users");
print_r($result);
