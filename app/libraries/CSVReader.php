<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class CSVReader {

    var $fields;            /** columns names retrieved after parsing */ 
    var $separator = ';';    /** separator used to explode each line */
    var $enclosure = '"';    /** enclosure used to decorate each field */

    var $max_row_size = 9000000;    /** maximum row size to be used for decoding */

    function parse_file($p_Filepath) {
		
        $file = fopen($p_Filepath, 'r');
        $this->fields = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure);
		
        $keys_values = explode(',',$this->fields[0]);
		

        $content    =   array();
        $keys   =   $this->escape_string($keys_values);

        $i  =   1;
		
		/*print_r(fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure));
		exit;*/
        while( ($row = fgetcsv($file, $this->max_row_size, ",", $this->enclosure)) != false ) {            
            if( $row != null ) { // skip empty lines	
                $values =   $row;

			
                if(count($keys) == count($values)){
							
                    $arr    =   array();
                    $new_values =   array();
                    $new_values =   $this->escape_string($values);
                    for($j=0;$j<count($keys);$j++){
                        if($keys[$j] != ""){
							//echo "key:".$keys[$j];
                            $arr[$keys[$j]] =   $new_values[$j];
								// "arr keys:".$arr[$keys[$j]];
                        }
                    }
				
                    $content[$i]=   $arr;
                    $i++;
                }
            }
			/*print_r($content);
			exit;*/
        }
        fclose($file);
		/*print_r($content);exit;*/
        return $content;
    }

    function escape_string($data){
        $result =   array();
        foreach($data as $row){
            $result[]   =   str_replace('"', '',$row);
        }
        return $result;
    }   
	
	
	  function get_size($p_Filepath) {
	  	 $file = fopen($p_Filepath, 'r');
    	    $max_size = $this->max_row_size;
	  	  fclose($file);
		  return $max_size;
	  }
}
 