<?php
class Baseben_Model extends CI_Model {

    function get($data){
        $db = $this->load->database('default',true);
        if(isset($data['db'])){
            $db = $this->load->database($data['db'],true);
        }

        if(isset($data['key_name']) && isset($data['key'])){
            $db->group_start();
            $db->where($data['key_name'],$data['key']);
            $db->group_end();
        }

        if(isset($data['select']) && is_array($data['select'])){
            $db->select($data['select']);
        }


        if(isset($data['where']) && is_array($data['where'])){
            $db->group_start();
            $db->where($data['where']);
            $db->group_end();
        }


        if(isset($data['join']) && is_array($data['join'])){
            if(is_array($data['join'][0])){
            if(array_keys($data['join'][0]) !== range(0, count($data['join'][0]) - 1)){
                    foreach($data['join'] as $k=>$v){
                        $db->join($v['table_name'],$v['condition'],($v['option'] == '' || $v['option'] == null)?'inner':$v['option']);
                      }  
                } 
              }else{
                  $db->join($data['join'][0],$data['join'][1],(isset($data['join'][2]))?$data['join'][2]:'inner');
              }
        }

        if(isset($data['or_where']) && is_array($data['or_where'])){
            $db->group_start();
            $db->or_where($data['or_where']);
            $db->group_end();
        }

        if(isset($data['where_in']) && is_array($data['where_in'])){
            $db->group_start();
            $db->where_in($data['where_in'][0],$data['where_in'][1]);
            $db->group_end();
        }
        
        if(isset($data['group_by']) && is_array($data['group_by'])){
            $db->group_by($data['group_by']);
        }
        
        if(isset($data['like']) && is_array($data['like'])){
            $db->group_start();
            $db->like($data['like']);
            $db->group_end();
        }

        if(isset($data['or_like']) && is_array($data['or_like'])){
            $db->or_like($data['or_like']);
        }
        
        if(isset($data['order_by']) && is_array($data['order_by'])){
            if(array_keys($data['order_by']) !== range(0, count($data['order_by']) - 1)){
                foreach($data['order_by'] as $k=>$v){
                  $db->order_by($k,$v);
                }  
              }else{
                  $db->order_by($data['order_by'][0],$data['order_by'][1]);
              }
        }
        if(isset($data['limit'])){
            $offset = 0;
            if(isset($data['offset'])){
                $offset = $data['offset'];
            }
            $db->limit($data['limit'], $offset);
        }

        return $db->get($data['table_name'])->result_array();
    }

    function getField($data){
        return $this->db->get($data['table_name'])->list_fields();
    }

    function insert($data){
        $temp_data = $data;
        unset($data['table_name']);
        return $this->db->insert($temp_data['table_name'], $data);
       
    }

    function insert_id($data){
        $temp_data = $data;
        unset($data['table_name']);
       $this->db->insert($temp_data['table_name'], $data);
       return $this->db->insert_id();
       
    }

    
    function update($data)
    {
        $db = $this->load->database('default', true);
        if (isset($data['db'])) {
            $db = $this->load->database($data['db'], true);
            unset($data['db']);
        }

        $temp_data = $data; 

        if(isset($data['key_name']) && isset($data['key'])) {
            if(!empty($data['key_name']) && !empty($data['key'])) {
                $db->where($temp_data['key_name'], $temp_data['key']);
            }
        }

        if(isset($data['where']) && is_array($data['where'])) {
            $db->where($temp_data['where']);
        } 

        unset($data['table_name']);
        unset($data['key_name']);
        unset($data['key']);
        unset($data['where']);

        return $db->update($temp_data['table_name'], $data);
    }

    function delete($data){
        return $this->db->where($data['key_name'],$data['key'])->delete($data['table_name']);
    }

    // Datatable Server Side
    public function datatables($data) 
    {
        $this->set_datatables($data['data_post'], $data['column_search'], $data['column_order'], $data);
        
        if($data['data_post']['length'] != -1)
        $this->db->limit($data['data_post']['length'], $data['data_post']['start']);

        $result = $this->db->get($data['table_name'])->result_array();
        $count  = $this->count_filtered($data);
        
        return array(
            'data' => $result,
            'count_filtered' => $count
        );
    }

    public function count_filtered($data)
    {
        unset($data['data_post']['order']);
        unset($data['order_by']);
        $this->db->select(array('count(*) as jml'));
        $this->set_datatables($data['data_post'], $data['column_search'], array(), $data);
        $query = $this->db->get($data['table_name'])->result_array();
        return $query[0]['jml'];
    }

    public function set_datatables($data_post, $columns, $column_order = array(), $data) 
    {
        $i = 0;
        $column_search  = $columns;

        foreach ($column_search as $item) 
        {
            if($data_post['search']['value']) 
            {
                if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like('LOWER('.$item.')', strtolower($data_post['search']['value']));
                }
                else
                {
                    $this->db->or_like('LOWER('.$item.')', strtolower($data_post['search']['value']));
                }
 
                if(count($column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if(isset($data_post['order']) && count($column_order)>0) // here order processing
        {
            $this->db->order_by($column_order[$data_post['order']['0']['column']], $data_post['order']['0']['dir']);
        } 
       

        if (isset($data['where']) && is_array($data['where'])) {
            $this->db->group_start();
            if (count($data['where']) > 0) {
                $this->db->where($data['where']);
            }
            $this->db->group_end();
        }

        if (isset($data['or_where']) && is_array($data['or_where'])) {
            $this->db->group_start();
            $this->db->or_where($data['or_where']);
            $this->db->group_end();
        }

        if(isset($data['where_in']) && is_array($data['where_in'])){
            $this->db->group_start();
            $this->db->where_in($data['where_in'][0],$data['where_in'][1]);
            $this->db->group_end();
        }

        if (isset($data['like']) && is_array($data['like'])) {
            $this->db->group_start();

            foreach($data['like'] as $key => $value) {
                $this->db->like($data['like'][0]);

                if($key > 0) {
                    $this->db->or_like($data['like'][$key]);
                }
            }

            $this->db->group_end();
        }

        if (isset($data['order_by']) && is_array($data['order_by'])) {
            foreach($data['order_by'] as $key => $value) {
                $this->db->order_by($data['order_by'][$key][0], $data['order_by'][$key][1]);
            }
        }
    }

    function getObject($data){
        $db = $this->load->database('default',true);
        if(isset($data['db'])){
            $db = $this->load->database($data['db'],true);
        }

        if(isset($data['key_name']) && isset($data['key'])){
            $db->group_start();
            $db->where($data['key_name'],$data['key']);
            $db->group_end();
        }

        if(isset($data['select']) && is_array($data['select'])){
            $db->select($data['select']);
        }


        if(isset($data['where']) && is_array($data['where'])){
            $db->group_start();
            $db->where($data['where']);
            $db->group_end();
        }


        if(isset($data['join']) && is_array($data['join'])){
            if(is_array($data['join'][0])){
            if(array_keys($data['join'][0]) !== range(0, count($data['join'][0]) - 1)){
                    foreach($data['join'] as $k=>$v){
                        $db->join($v['table_name'],$v['condition'],($v['option'] == '' || $v['option'] == null)?'inner':$v['option']);
                      }  
                } 
              }else{
                  $db->join($data['join'][0],$data['join'][1],(isset($data['join'][2]))?$data['join'][2]:'inner');
              }
        }

        if(isset($data['or_where']) && is_array($data['or_where'])){
            $db->or_where($data['or_where']);
        }

        if(isset($data['where_in']) && is_array($data['where_in'])){
            $db->group_start();
            $db->where_in($data['where_in'][0],$data['where_in'][1]);
            $db->group_end();
        }
        
        if(isset($data['group_by']) && is_array($data['group_by'])){
            $db->group_by($data['group_by']);
        }
        
        if(isset($data['like']) && is_array($data['like'])){
            $db->group_start();
            $db->like($data['like']);
            $db->group_end();
        }

        if(isset($data['or_like']) && is_array($data['or_like'])){
            $db->or_like($data['or_like']);
        }
        
        if(isset($data['order_by']) && is_array($data['order_by'])){
            if(array_keys($data['order_by']) !== range(0, count($data['order_by']) - 1)){
                foreach($data['order_by'] as $k=>$v){
                  $db->order_by($k,$v);
                }  
              }else{
                  $db->order_by($data['order_by'][0],$data['order_by'][1]);
              }
        }
        if(isset($data['limit'])){
            $offset = 0;
            if(isset($data['offset'])){
                $offset = $data['offset'];
            }
            $db->limit($data['limit'], $offset);
        }

        return $db->get($data['table_name']);
    }
}
