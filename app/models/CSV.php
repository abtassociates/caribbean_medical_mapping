<?php

class CSV{

    /**
     * Parse a CSV file to array
     * @param  String $full_path The path to the CSV file
     * @return Array            The parsed output
     */
    public static function file_to_array($full_path)
    {
        ini_set("auto_detect_line_endings", true);
        $rows = array();
        if(($file = @fopen($full_path, 'r')) !== false)
        {
            $fields = array();
            if($file)
            {
                while(($data = fgetcsv($file)) !== false)
                {
                    if(empty($fields))
                    {
                        $fields = $data;
                        $fields = array_map(function($el)
                        {
                            return trim($el);
                        }, $fields);
                        continue;
                    }
                    // if it's NOT just a one element empty line
                    if(count($data)>1 || $data[0])
                    {
                        foreach($data as $key => $val){
                            if (trim($val) === ""){
                               $data[$key] = null;
                            }
                        }

                        $rows[] = array_combine($fields, $data);
                    }

                }
            }
            fclose($file);
        }
        ini_restore("auto_detect_line_endings");
        return $rows;
    }




}

?>