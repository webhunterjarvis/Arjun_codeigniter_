<?php 
class Dynamic_model extends CI_Model{
/*
**************************************************************************
this is my dynamic model 
**************************************************************************
*/
    public function _insert($tbl,$values){
        $q = $this->db->insert($tbl,$values);
        return true;
    }


    public function _delete($tbl, $values){
        $q = $this->db->delete($tbl, $values);
        return true;

    }


    public function _update($tbl, $where, $values){
       $q =  $this->db->where($where);
       $q =  $this->db->update($tbl, $values);
        return true;
    }

    public function _num_rows($tbl){
        $q = $this->db->get($tbl);
        return $q->num_rows();

    }

    public function _num_rows_where($tbl, $action){
        $q = $this->db->get_where($tbl, $action);
        return $q->num_rows();

    }


    public function _find($tbl, $values){
        $q = $this->db->get_where($tbl,$values);
        if($q->row()){
            return $q->row();
        }else{
            return false;
        }
	}

	
    public function _find_limit_where($tbl, $action){
        $q = $this->db->order_by('id', 'DESC');
        $q = $this->db->LIMIT(10);
        $q = $this->db->get_where($tbl, $action);
        
        return $q->result();
    }


    public function _find_result($tbl, $values){
			$q = $this->db->get_where($tbl,$values);
			if($q->row()){
				return $result();
			}else{
				return false;
			}
    }


    public function _checking($tbl, $values){
        //this finction will return true or false value if someting appear.\
        $q = $this->db->get_where($tbl, $values);
        if($q->row()){
            return true;
        }
        else{
            return false;
        }
    }


    public function _get_all($tbl){
        $q = $this->db->get($tbl);
        return $q->result();
    }


}