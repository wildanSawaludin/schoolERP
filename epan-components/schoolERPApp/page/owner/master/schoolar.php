<?php
class page_schoolERPApp_page_owner_master_schoolar extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$crud=$this->add('CRUD')->setModel('schoolERPApp/Master_Schoolar');
		
	}
}