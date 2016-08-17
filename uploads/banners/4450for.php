<?php
function UPC() {

$odd_sum = $even_sum = 0;

for ($i = 1; $i < 12; $i++) 
{
	$digits[$i] = rand(0,9);
	if($i % 2 == 0)
	$even_sum += $digits[$i];
	else
	$odd_sum += $digits[$i];
}

$digits[$i] = 10 - ((3 * $odd_sum + $even_sum) % 10);

return implode('',$digits);
}

function SKU_gen($string, $id = null, $l = 2){
    $results = ''; // empty string
    $vowels = array('a', 'e', 'i', 'o', 'u', 'y'); // vowels
    preg_match_all('/[A-Z][a-z]*/', ucfirst($string), $m); // Match every word that begins with a capital letter, added ucfirst() in case there is no uppercase letter
    foreach($m[0] as $substring){
        $substring = str_replace($vowels, '', strtolower($substring)); // String to lower case and remove all vowels
        $results .= preg_replace('/([a-z]{'.$l.'})(.*)/', '$1', $substring); // Extract the first N letters.
    }
    $results .= '-'. str_pad($id, 4, 0, STR_PAD_LEFT); // Add the ID
    return $results;
}

echo UPC()."<br>";

echo SKU_gen(' HP A9T81B Deskjet 3545 All-In-One Inkjet Printer ',20).'<br>'; 
?>
