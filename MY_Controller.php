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
		  $this->load->helper('scripts');
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
		
			
		public function __data_with_photo_upload($tbl, $sbtn, $upload, $filename, $msg, $redirect, $url_name = null, $url_value = null){
		
				$config['upload_path'] = $upload;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES[$filename]['name'];
            
            //Load upload library and initialize configuration
				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload($filename))
				{
					$uploadData = $this->upload->data();
					$picture = $uploadData['file_name'];

					$data  = $this->input->post();
						unset($data[$sbtn]);
						
						$data[$filename] = $picture;
						
						if(empty($url_name) or is_null($url_name)){
							
							$insertData = $this->dmodel->_insert($tbl,$data);
							if($insertData){
							   msgnpath($msg, base_url($redirect));
							 }
						}else{
							$data[$url_name] =  clean($url_value);
							$insertData = $this->dmodel->_insert($tbl,$data);
							if($insertData){
							   msgnpath($msg, base_url($redirect));
							 }
						}
					
				}

		
		}
		
		
		public function __data_update_with_photo_upload($tbl, $sbtn, $upload, $filename, $msg, $redirect, $id,$url_name = null, $url_value = null){
				//$id = ;
				$where = ['id'=> $id];
				$config['upload_path'] = $upload;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES[$filename]['name'];
            
            //Load upload library and initialize configuration
				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload($filename))
				{
					$uploadData = $this->upload->data();
					$picture = $uploadData['file_name'];

					$data  = $this->input->post();
						unset($data[$sbtn]);
						
						$data[$filename] = $picture;
						
						if(empty($url_name) or is_null($url_name)){
							
							$insertData = $this->dmodel->_update($tbl,$where, $data);
							if($insertData){
							   msgnpath($msg, base_url($redirect));
							 }
						}else{
							$data[$url_name] =  clean($url_value);
							$insertData = $this->dmodel->_update($tbl,$where, $data);
							if($insertData){
							   msgnpath($msg, base_url($redirect));
							 }
						}
					
				}

		
		}
		
		
		
		public function __photo_upload($tbl, $sbtn, $upload, $filename, $msg, $redirect, $id){
				//$id = ;
				$where = ['id'=> $id];
				$config['upload_path'] = $upload;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES[$filename]['name'];
            
            //Load upload library and initialize configuration
				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload($filename))
				{
					$uploadData = $this->upload->data();
					$picture = $uploadData['file_name'];

					$data  = $this->input->post();
						unset($data[$sbtn]);
						
						$data[$filename] = $picture;
						
						$insertData = $this->dmodel->_update($tbl,$where, $data);
							if($insertData){
							   msgnpath($msg, base_url($redirect));
						}
					
				}

		
		}
		
		
		
		public function __call_count($tbl=null, $action = array()){
			//num rows functions.
			if(count($action)==0){
				$all_visible = $this->dmodel-> _num_rows($tbl);
				return   $all_visible;
			}
			else{
				$all_visible = $this->dmodel->_num_rows_where($tbl, $action);
				return  $all_visible;
			}
			 
		}
		
		public function __my_insert($tbl, $sbtn, $msg, $redirect){
			$data = $this->input->post();
				unset($data[$sbtn]);
			$this->dmodel->_insert($tbl,$data);
			msgnpath($msg,base_url($redirect));
		}
		
		
		public function _get_showing_part($tbl = null){
			// counting 
			//getting result 
			
				$get_all = $this->dmodel->_get_all($tbl);
				$darray =  [
			
									'num_rows' => $this->__call_count($tbl),
									'get_all' => $get_all
							];
			
			return $darray;
			
		}
		
		
}
