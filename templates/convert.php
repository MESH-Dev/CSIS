<?php /*
* Template Name: Convert
*/
get_header(); ?>

<?php

$row = 1;
$csv = get_template_directory_uri() . '/data/data.csv';

if (($handle = fopen($csv, "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);

    if ($row != 1) {

      for ($c=0; $c < $num; $c++) {
          echo $data[$c];
      }

      echo "<br/>";
    }

    $row++;
  }
  fclose($handle);
}

?>
