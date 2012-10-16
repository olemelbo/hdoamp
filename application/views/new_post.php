<?php
echo "<h1>Skriv et nytt innlegg</h1>";

echo form_open('post/validate_post');

echo form_input('title','Tittel');

echo "<br />";

echo form_textarea('in_text','Skriv inn ditt innlegg!');

echo "<br />";

echo form_submit('submit','Publiser');


?>