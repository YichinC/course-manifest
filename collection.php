<?php
if(!isset($_GET['course'])) {
 echo "url must include ?course=...";
}
else {
 echo $_GET['course'];
}
