<?php

class Common_model extends CI_Model {



	############################### Get Value from Database for specific field ########################



	function getValue($tableName, $field_name, $where){

		$query = $this->db->get_where($tableName, $where);

		$row = $query->row_array();

		return $row[$field_name]; exit;

	}



	



	############################### Return array from specific table ########################



	function getData($tableName, $param){

		$query = $this->db->get_where($tableName, $param);

		return $query->result();

	}



	############################### Return all array from specific table ########################



		function getAll($table,$where_clause=NULL,$order_by_fld=NULL,$order_by=NULL,$limit=NULL,$offset=NULL) {

		if($where_clause != '')

			$this->db->where($where_clause);



        if($order_by_fld != '')

		    $this->db->order_by($order_by_fld,$order_by);



		if($limit != '' && $offset !='')

		    $this->db->limit($limit,$offset);		



		$this->db->select('*');

		$this->db->from($table);

		$query = $this->db->get();  

		return $query->result();

	}



	############################### Return a array from specific table ########################



	function getSingle($table,$where_clause=NULL,$order_by_fld=NULL,$order_by=NULL,$limit=NULL,$offset=NULL) {

		if($where_clause != '')

			$this->db->where($where_clause);



        if($order_by_fld != '')

		    $this->db->order_by($order_by_fld,$order_by);



		if($limit != '' && $offset !='')

		    $this->db->limit($limit,$offset);		



		$this->db->select('*');

		$this->db->from($table);

		$query = $this->db->get();  

		 return $query->row(); 

	}



	############################### Delete array from specific table ########################



	function deleteData($table,$where)

	{

		$this->db->delete($table, $where); 

	}



	############################### Update array for specific table ########################



	function updateValue($row,$table,$where_clause) {

		$this->db->where($where_clause);

		$this->db->update($table, $row);

		$temp=$this->db->affected_rows();

		return $temp;



	}



	############################### Count array for specific table ########################



	function getCount($table,$where_clause =NULL,$order_by_fld=NULL,$order_by=null,$limit=null,$offset=null) {

		if($where_clause != '')

			$this->db->where($where_clause);

			

		 if($order_by_fld != '')

		    $this->db->order_by($order_by_fld,$order_by);

			

		if($limit != '' && $offset !='')

		    $this->db->limit($limit,$offset);

			

		 $this->db->select('*');

		 $this->db->from($table);

		 $query = $this->db->get();  

		 return $query->num_rows(); 

	}



	############################### Insert array for specific table ########################



	function insertValue($table, $row)

	{

		$str = $this->db->insert_string($table, $row);        

		$query = $this->db->query($str);    

		$insertid = $this->db->insert_id();

		return $insertid;

	}



	/******************************* My Common Function ************************/



	function getResults($filed='*',$tbl,$where=null,$order_by_fld=null,$order_by='DESC',$limit=null,$offset=null){

		if($tbl){

			$this->db->select($filed,FALSE);

			$this->db->from($tbl);

			if($where != '')

				$this->db->where($where);

			if($order_by_fld != '')

		    	$this->db->order_by($order_by_fld,$order_by);	

			

			if($limit != '' && $offset !='')

		    	$this->db->limit($limit,$offset);

			$query = $this->db->get();	

			return $query->result();

			//echo $this->db->last_query();

		}

		else{

			return FALSE;

		}	

	}

	

	function getResultsObj($filed='*',$tbl,$where=null,$order_by_fld=null,$order_by='DESC',$limit=null,$offset=null){

		if($tbl){

			$this->db->select($filed);

			$this->db->from($tbl);

			if($where != '')

				$this->db->where($where);

			if($order_by_fld != '')

		    	$this->db->order_by($order_by_fld,$order_by);	

			

			if($limit != '' && $offset !='')

		    	$this->db->limit($limit,$offset);

			$query = $this->db->get();	

			return $query->result();

			//echo $this->db->last_query();

		}

		else{

			return FALSE;

		}	

	} 



	function getSingleRow($filed='*',$tbl,$where=NULL,$order_by_fld=NULL,$order_by='DESC',$limit=1,$offset=NULL){

		if($tbl){

			$this->db->select($filed);

			$this->db->from($tbl);

			if($where != '')

				$this->db->where($where);

			if($order_by_fld != '')

		    	$this->db->order_by($order_by_fld,$order_by);	

			if($limit != '' && $offset !='')

		    	$this->db->limit($limit,$offset);

			$query = $this->db->get();

			$this->db->last_query();

			return $query->row_array();

		}

		else{

			return FALSE;

		}

	}



	function getSingleObj($filed='*',$tbl,$where=NULL,$order_by_fld=NULL,$order_by='DESC',$limit=1,$offset=NULL){

		if($tbl){

			$this->db->select($filed);

			$this->db->from($tbl);

			if($where != '')

				$this->db->where($where);

			if($order_by_fld != '')

		    	$this->db->order_by($order_by_fld,$order_by);	

			if($limit != '' && $offset !='')

		    	$this->db->limit($limit,$offset);

			$query = $this->db->get();

			$this->db->last_query();

			return $query->row();

		}

		else{

			return FALSE;

		}

	}

	function getTwoTableData($tbl_1,$tbl_2,$fld_1,$fld_2,$where,$order_by_fld=NULL,$order_by=NULL,$limit=NULL,$offset=NULL){

		$this->db->select("$tbl_1.*");

		$this->db->from($tbl_1);

		$this->db->join("$tbl_2", "$tbl_1.$fld_1 = $tbl_2.$fld_2", 'LEFT');

		if($where != '')

			$this->db->where($where);

		if($order_by_fld != '')

		    $this->db->order_by($order_by_fld,$order_by);



		if($limit != '' && $offset !='')

		    $this->db->limit($limit,$offset);

		

		$query = $this->db->get();  

		return $query->result();

	

	}

	

}



?>