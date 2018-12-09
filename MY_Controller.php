<?php 
/****************************************************
*****************************************************
@ Author: Arjun Singh Saini
@ Controller: MY_Controller
@ Author URI: https://devartisan.in
@ Email: webhunterr@gmail.com
@ Description: this is essential script for 
  web developement purpose. its also private use only. 
******************************************************
*****************************************************/
class MY_Controller extends CI_Controller{

	public function __construct(){
        
           parent::__construct();
		  $this->load->helper('security');
    } 

	//dynamic delete function 
    public function __deletebyid($tbl,$rurl, $dmsg, $nodmsg)
	{
		$id =  $this->uri->segment(3);
			if(empty($id)){
				redirect($rurl);
			}
		//checking id is appear then delete.
			$data = ['id'=>$id];
			$checking = $this->dmodel->_checking($tbl,$data);
			if($checking){
				$deletion = $this->dmodel->_delete($tbl,$data);
				msgnpath($dmsg,base_url($rurl));
			}else{
				msgnpath($nodmsg,base_url($rurl));
			}
    }
    
// dynamic update function 
    public function __updatebyid($tbl,$rurl, $umsg, $unomsg, $btn, $udata){
		$id =  $this->uri->segment(3);
		if(empty($id)){
			redirect($rurl);
		}
		//$this->load->view($view);
		//checking id is appear then update.
		$data = ['id'=>$id];
		$checking = $this->dmodel->_checking($tbl,$data);
		if(!$checking){
			msgnpath($unomsg,base_url($rurl));
		}
		if($this->input->post($btn)){
			$update = $this->dmodel->_update($tbl,$data, $udata);
			msgnpath($umsg,base_url($rurl));
		}
	}
	
	
	public function __updatebyidlink($tbl,$rurl, $umsg, $unomsg, $udata)
	{
			$id =  $this->uri->segment(3);
			if(empty($id)){
				redirect($rurl);
			}
			//$this->load->view($view);
			//checking id is appear then update.
			$data = ['id'=>$id];
			$checking = $this->dmodel->_checking($tbl,$data);
			if(!$checking){
				msgnpath($unomsg,base_url($rurl));
				
			}else{
				$update = $this->dmodel->_update($tbl,$data, $udata);
				msgnpath($umsg,base_url($rurl));
			}
	}
			
			
			//inserting all functions 
		public function __insert_module($sbtn, $tbl, $msg){
				if($this->input->post($sbtn)){
					$data = $this->input->post();
					$data = $this->security->xss_clean($data);
					unset($data[$sbtn]);
					$avals = $this->dmodel->_insert($tbl, $data);
					alert($msg);	
				}
		}
		
		
		public function __del_by_tbl_id(){
			//format of calling_ _function_name/table_name/id/url-url(tablename)
			 $tbl = $this->uri->segment(3); //table
			 $id = $this->uri->segment(4); //id
			$path =  $url = $this->uri->segment(5); //path
			$path =  drepaceslash($path); //decoding dash to slash.
			$data = ['id'=>$id]; 
			
			$checking = $this->dmodel->_checking($tbl,$data);
		if($checking){
			$deletion = $this->dmodel->_delete($tbl,$data);
			msgnpath("Record has been deleted.",base_url($path));
			}else{
				msgnpath("Record couldn't be deleted.",base_url($path));
			}
		}
}
