<?php
/**
 * Description of lib
 *
 * @author ::Kallol Basu
 * @Modified By :: Kallol
 *
 */
class Feed_Grabber {



    public function get_feeds($url) {
        return $this->process_feed($this->xml_to_array($this->grab_xml_feeds($url)));
    }

//XML to Array
    public function xml_to_array(&$string) {
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parse_into_struct($parser, $string, $vals, $index);
        xml_parser_free($parser);
        $master_array_xml = array();
        $array_xml = &$master_array_xml;
        foreach ($vals as $temp_row) {
            $temp_tag = $temp_row['tag'];
            if ($temp_row['type'] == 'open') {
                if (isset($array_xml[$temp_tag])) {
                    if (isset($array_xml[$temp_tag][0]))
                        $array_xml[$temp_tag][] = array(); else
                        $array_xml[$temp_tag] = array($array_xml[$temp_tag], array());
                    $child_value = &$array_xml[$temp_tag][count($array_xml[$temp_tag]) - 1];
                } else
                    $child_value = &$array_xml[$temp_tag];
                if (isset($temp_row['attributes'])) {
                    foreach ($temp_row['attributes'] as $temp_key => $v)
                        $child_value['_attribute'][$temp_key] = $v;
                }
                $child_value['_child'] = array();
                $child_value['_child']['_p'] = &$array_xml;
                $array_xml = &$child_value['_child'];
            } elseif ($temp_row['type'] == 'complete') {
                if (isset($array_xml[$temp_tag])) { // same as open
                    if (isset($array_xml[$temp_tag][0]))
                        $array_xml[$temp_tag][] = array(); else
                        $array_xml[$temp_tag] = array($array_xml[$temp_tag], array());
                    $child_value = &$array_xml[$temp_tag][count($array_xml[$temp_tag]) - 1];
                } else
                    $child_value = &$array_xml[$temp_tag];
                if (isset($temp_row['attributes'])) {
                    foreach ($temp_row['attributes'] as $temp_key => $v)
                        $child_value['_attribute'][$temp_key] = $v;
                }
                $child_value['_value'] = (isset($temp_row['value']) ? $temp_row['value'] : '');
            } elseif ($temp_row['type'] == 'close') {
                $array_xml = &$array_xml['_p'];
            }
        }
        $this->_del_p($master_array_xml);
        return $master_array_xml;
    }

//_Internal: Remove recursion in result array
    private function _del_p(&$array_xml) {
        foreach ($array_xml as $temp_key => $v) {
            if ($temp_key === '_p')
                unset($array_xml[$temp_key]);
            elseif (is_array($array_xml[$temp_key]))
                $this->_del_p($array_xml[$temp_key]);
        }
    }

// Array to XML
    public function array_to_xml($array_to_process, $d = 0, $forcetag = '') {
        $temp_rowes = array();
        foreach ($array_to_process as $tag => $temp_row) {
            if (isset($temp_row[0])) {
                $temp_rowes[] = $this->xml_to_array($temp_row, $d, $tag);
            } else {
                if ($forcetag)
                    $tag = $forcetag;
                $sp = str_repeat("\t", $d);
                $temp_rowes[] = "$sp<$tag";
                if (isset($temp_row['_attribute'])) {
                    foreach ($temp_row['_attribute'] as $at => $av)
                        $temp_rowes[] = " $at=\"$av\"";
                }
                $temp_rowes[] = ">" . ((isset($temp_row['_child'])) ? "\n" : '');
                if (isset($temp_row['_child']))
                    $temp_rowes[] = $this->array_to_xml($temp_row['_child'], $d + 1);
                elseif (isset($temp_row['_value']))
                    $temp_rowes[] = $temp_row['_value'];
                $temp_rowes[] = (isset($temp_row['_child']) ? $sp : '') . "</$tag>\n";
            }
        }
        return implode('', $temp_rowes);
    }

// Insert element into Array    
    public function insert_into_array(&$array_xml, $element, $pos) {

        $ar1 = array_slice($array_xml, 0, $pos);
        $ar1[] = $element;

        $array_xml = array_merge($ar1, array_slice($array_xml, $pos));
    }

//Grab xml feeds from url  

    public function grab_xml_feeds($url = NULL) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Coupon Request');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $contents = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
            echo "\n<br />";
            $contents = '';
        } else {
            curl_close($ch);
        }
        if (!is_string($contents) || !strlen($contents)) {
            echo "Failed to get contents.";
            $contents = '';
        }
        return $contents;
    }

//process feeds in required format

    protected function process_feed($array_output = array(), $type = NULL) {
        $blogData = array();
        switch ($type) {
            case 1:
                foreach ($array_output['feed']['_child']['entry'] as $key => $blogpost) {
                    $blogData[$key]['title'] = $blogpost['_child']['title']['_value'];
                    $blogData[$key]['content'] = $blogpost['_child']['content']['_value'];
                }

                break;

            default:
                foreach ($array_output['feed']['_child']['entry'] as $key => $blogpost) {
                    $blogData[$key]['title'] = $blogpost['_child']['title']['_value'];
                    $blogData[$key]['content'] = $blogpost['_child']['content']['_value'];
                }
                break;
        }

        return $blogData;
    }

}

if ($_POST['url']) {
    $feedProcessor = new Feed_Grabber();
    print_r($feedProcessor->get_feeds($_POST['url']));
}


    //echo json_encode($blogData);


    /** type 2 */
    