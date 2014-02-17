<?php
namespace schoolERPApp;
class Model_Master_Hostel extends \Model_Table{
	public $table='schoolERPApp_hostel';
	function init(){
		parent::init();

		$this->hasOne('schoolERPApp/Master_FeesHead','schoolERPApp_feeshead_id')->caption('Feeshead name');
		$this->addField('name');
		
		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);
		
		$this->hasMany('schoolERPApp/Master_Item','schoolERPApp_hostel_id');
		$this->hasMany('schoolERPApp/Master_Fees','schoolERPApp_hostel_id');
		$this->hasMany('schoolERPApp/Hostel_RoomAllotment','schoolERPApp_hostel_id');

		$this->add('dynamic_model/Controller_AutoCreator');

     }
	   
	 function beforeSave(){
		$hostel=$this->add('schoolERPApp/Model_Master_Hostel');
		if($this->loaded()){
		$hostel->addCondition('id','<>',$this->id);
		}
		$hostel->addCondition('name',$this['name']);
		$hostel->tryLoadAny();
		if($hostel->loaded()){
		throw $this->exception('It is Already Exist');
		}
	}
     function beforeDelete(){
		if($this->ref('schoolERPApp/Model_Master_Item')->count()->getOne()>0)
		 throw $this->exception('Please Delete Item content');


		if($this->ref('schoolERPApp/Model_Master_Fees')->count()->getOne()>0)
		 throw $this->exception('Please Delete Fees content');
		
		
		if($this->ref('schoolERPApp/Model_Hostel_RoomAllotment')->count()->getOne()>0)
		 throw $this->exception('Please Delete Roomallotment content');
	}
}
		