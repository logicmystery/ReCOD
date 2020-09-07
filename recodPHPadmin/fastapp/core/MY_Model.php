<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Model
 *
 * @author kallol
 * @version 1.0.1.2
 */
class MY_Model extends CI_Model
{

    //put your code here
    protected $table_name, $joiningArray;

    public function __construct()
    {
        parent::__construct();
        if (!is_dir(ROOTPATH . 'fastapp/cachefiles/' . NODE)) {
            mkdir(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/', 0777);
        }
        if (!is_dir(ROOTPATH . 'uploads/' . NODE)) {
            mkdir(ROOTPATH . 'uploads/' . NODE . '/', 0777);
        }
    }

    public function check()
    {

        if ($this->config->item('check_and_allow_install')) {
            $existsTable = count($this->db->query("SHOW TABLES LIKE '" . $this->table_name . "';")->result_array());
            if (!$existsTable) {
                $this->install();
            }
        }
    }

    public function get_list($condition = NULL, $column = NULL, $limit = null, $start = 0, $likeCondition = NULL, $orderBy = NULL, $groupBy = null, $autoJoin = TRUE)
    {
        $pk = $this->get_primary_key();
        if ($column)
            $this->db->select($column);
        if ($condition)
            $this->db->where($condition);
        if ($likeCondition)
            $this->db->like($likeCondition);
        if ($this->joiningArray && $autoJoin)
            foreach ($this->joiningArray as $joinMeta) {
                $this->db->join($joinMeta['table'], $joinMeta['condition'], isset($joinMeta['type']) ? $joinMeta['type'] : 'left');
            }

        if ($groupBy)
            $this->db->group_by($groupBy);

        if (!empty($pk)) {
            if ($orderBy == NULL) {
                $orderBy = $pk . ' ASC';
            }
            $this->db->order_by($orderBy);
        }

        $query = $this->db->get($this->table_name, $limit, $start, $likeCondition = NULL);

        return $query->result_array();
    }

    public function count_total($condition = NULL, $likeCondition = NULL, $groupBy = NULL)
    {

        $this->db->select('COUNT(*) AS total');
        if ($condition)
            $this->db->where($condition);
        if ($likeCondition)
            $this->db->like($likeCondition);
        if ($groupBy)
            $this->db->group_by($groupBy);
        if ($this->joiningArray)
            foreach ($this->joiningArray as $joinMeta) {
                $this->db->join($joinMeta['table'], $joinMeta['condition'], isset($joinMeta['type']) ? $joinMeta['type'] : 'left');
            }
        //$this->db->stop_cache();
        $query = $this->db->get($this->table_name);
        //pr($this->db->last_query());

        $data = $query->result_array();
        // $this->db->flush_cache();
        if (!empty($groupBy))
            return count($data);
        else
            return intval($data[0]['total']);
    }

    public function count_total_in($condition = NULL, $likeCondition = NULL, $groupBy = null)
    {

        $this->db->select('COUNT(*) AS total');
        if ($condition) {
            $targetKey = array_keys($condition);
            $targetIn = $condition[$targetKey[0]];
            $this->db->where_in($targetKey[0], $targetIn);
        }
        if ($likeCondition)
            $this->db->like($likeCondition);
        if ($groupBy)
            $this->db->group_by($groupBy);
        if ($this->joiningArray)
            foreach ($this->joiningArray as $joinMeta) {
                $this->db->join($joinMeta['table'], $joinMeta['condition'], isset($joinMeta['type']) ? $joinMeta['type'] : 'left');
            }
        //$this->db->stop_cache();
        $query = $this->db->get($this->table_name);
        $data = $query->result_array();
        // $this->db->flush_cache();

        if (!empty($groupBy))
            return count($data);
        else
            return intval($data[0]['total']);
    }

    public function insert_data($dataToInsert, $isMulti = FALSE)
    {
        $this->db->cache_delete_all();
        if ($isMulti) {
            return $this->db->insert_batch($this->table_name, $dataToInsert);
        } else {
            $fields = $this->get_field_list();

            foreach($dataToInsert as $k=>$d2u){
                if($fields[0][$k]['Key']=="PRI"){
                    unset($dataToInsert[$k]);
                }
                if(stripos($fields[0][$k]['Type'],'int')!==false){
                    $dataToInsert[$k] = intval($d2u);
    
                }
            }
            $this->db->insert($this->table_name, $dataToInsert);
            return $this->db->insert_id();
        }
    }

    public function update_data($dataToUpdate, $condition = NULL, $isMulti = FALSE)
    {
        $this->db->cache_delete_all();
        
        if ($isMulti) {
            return $this->db->update_batch($this->table_name, $dataToUpdate, $condition);
        } else {
            $fields = $this->get_field_list();

        foreach($dataToUpdate as $k=>$d2u){
            if($fields[0][$k]['Key']=="PRI"){
                unset($dataToUpdate[$k]);
            }
            if(stripos($fields[0][$k]['Type'],'int')!==false){
                $dataToUpdate[$k] = intval($d2u);

            }
        }
            return $this->db->update($this->table_name, $dataToUpdate, $condition);
        }
    }

    public function delete($param = NULL, $is_multi = FALSE)
    {
        $this->db->cache_delete_all();
        if ($is_multi) {
            if ($param != NULL && is_array($param)) {
                foreach ($param as $key => $valueList) {
                    foreach ($valueList as $value) {
                        $this->db->delete($this->table_name, array($key => $value));
                    }
                }
            }
        } else {
            if ($param == 'all') {
                $this->db->empty_table($this->table_name);
            } else {
                if ($param != NULL && is_array($param))
                    $this->db->delete($this->table_name, $param);
            }
        }
    }

    public function get_list_for_tables($condition = NULL, $column = NULL, $limit = null, $start = NULL, $likeCondition = NULL, $orderBy = NULL, $groupBy = NULL)
    {
        if ($start == NULL) {
            $start = $this->getPaging();
        }
        $dataArry['current_paged_list'] = $this->get_list($condition, $column, $limit, $start, $likeCondition, $orderBy, $groupBy);
        $dataArry['total_rows'] = $this->count_total($condition, $likeCondition, $groupBy);
        return $dataArry;
    }

    public function get_list_for_tables_in($condition = NULL, $column = NULL, $limit = null, $start = NULL, $likeCondition = NULL, $orderBy = NULL)
    {
        if ($start == NULL) {
            $start = $this->getPaging();
        }
        $dataArry['current_paged_list'] = $this->get_list_in($condition, $column, $limit, $start, $likeCondition, $orderBy, $this->get_primary_key());
        $dataArry['total_rows'] = $this->count_total_in($condition, $likeCondition);
        return $dataArry;
    }

    public function get_list_for_dropdown($targetFieldName = null, $condition = NULL, $column = NULL, $limit = null, $start = NULL, $likeCondition = NULL, $orderBy = NULL, $groupBy = null)
    {

        $dataArray = $this->get_list($condition, $column, $limit, $start, $likeCondition, $orderBy, $groupBy);
        $returnArray = array();
        foreach ($dataArray as $key => $dataValue) {
            if ($targetFieldName)
                $returnArray[$dataValue[$this->get_primary_key()]] = $dataValue[$targetFieldName];
            else {
                $returnArray[$dataValue[$this->get_primary_key()]] = $dataValue;
            }
        }
        return $returnArray;;
    }

    protected function getPaging()
    {
        $paging = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        return $paging;
    }

    public function get_primary_key()
    {
        $result_array = null;
        if (file_exists(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/pks_' . $this->table_name . '.txt')) {
            $result_array = json_decode(file_get_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/pks_' . $this->table_name . '.txt'), true);
            return $result_array[0]['Column_name'];
        } else {
            $result_array = NULL;
            try {
                $record_set = $this->db->query('SHOW KEYS FROM ' . $this->table_name . ' where Key_name ="PRIMARY"');
                $result_array = $record_set->result_array();
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            file_put_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/pks_' . $this->table_name . '.txt', json_encode($result_array));
            return $result_array[0]['Column_name'];
        }
    }

    /**
     * need some modification
     */
    public function get_field_list($enablePK = TRUE)
    {
        if (file_exists(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/field_list_' . $this->table_name . '.txt')) {
            $return_array = json_decode(file_get_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/field_list_' . $this->table_name . '.txt'), true);
            return $return_array;
        } else {
            $record_set = $this->db->query('SHOW FIELDS FROM ' . $this->table_name);
            $result_array = $record_set->result_array();
            $return_array = NULL;
            foreach ($result_array as $key => $value) {
                if ($value['Key'] == 'PRI' && $enablePK == FALSE) {
                    continue;
                }
                $return_array[0][$value['Field']] = $value; //this section need modification
            }
            file_put_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/field_list_' . $this->table_name . '.txt', json_encode($return_array));
            return $return_array;
        }
    }

    public function get_list_for_dropdown_in($targetFieldName = null, $condition = NULL, $column = NULL, $limit = null, $start = NULL, $likeCondition = NULL, $orderBy = NULL)
    {

        $dataArray = $this->get_list_in($condition, $column, $limit, $start, $likeCondition, $orderBy);

        $returnArray = array();
        foreach ($dataArray as $key => $dataValue) {
            if ($targetFieldName)
                $returnArray[$dataValue[$this->get_primary_key()]] = $dataValue[$targetFieldName];
            else {
                $returnArray[$dataValue[$this->get_primary_key()]] = $dataValue;
            }
        }
        return $returnArray;;
    }

    public function get_list_in($condition = NULL, $column = NULL, $limit = null, $start = 0, $likeCondition = NULL, $orderBy = NULL, $groupBy = null, $autoJoin = TRUE)
    {
        $pk = $this->get_primary_key();
        if ($column)
            $this->db->select($column);
        if ($condition) {
            $targetKey = array_keys($condition);
            $targetIn = $condition[$targetKey[0]];
            $this->db->where_in($targetKey[0], $targetIn);
        }
        if ($likeCondition)
            $this->db->like($likeCondition);
        if ($this->joiningArray && $autoJoin)
            foreach ($this->joiningArray as $joinMeta) {
                $this->db->join($joinMeta['table'], $joinMeta['condition'], isset($joinMeta['type']) ? $joinMeta['type'] : 'left');
            }

        if ($groupBy)
            $this->db->group_by($groupBy);

        if (!empty($pk)) {
            if ($orderBy == NULL) {
                $orderBy = $pk . ' ASC';
            }
            $this->db->order_by($orderBy);
        }

        $query = $this->db->get($this->table_name, $limit, $start, $likeCondition = NULL);

        return $query->result_array();
    }

    public function updateOrder($previousElementId = NULL, $currentElementId = NULL, $nextElementId = NULL)
    {
        $PK = $this->get_primary_key();
        if ($previousElementId) { }
        $this->db->update($this->table_name, array($PK => '-99'), "$PK = $currentElementId");
        $this->db->update($this->table_name, $data, "$PK = $currentElementId");
        $this->db->update($this->table_name, $data, "id = 4");
    }
}
