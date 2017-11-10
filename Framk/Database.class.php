<?php
 /**
 +------------------------------------------------------------------------------
 * Framk PHP框架
 +------------------------------------------------------------------------------
 * @package  Framk
 * @author   shawn fon <shawn.fon@gmail.com>
 +------------------------------------------------------------------------------
 */
 
class Database {

private $db;
private $transTimes;
/* 
初始化数据库
*/	
	public function __construct(){	

		$this->db = _instance($GLOBALS['DB']['DBtype'],'',1);
				 
	} 
/*
查询结果集并转换为二维数组
*/
	public	function findAll($sql){ 
		$data= array(); $row= array ();	$i=0;
		$result = $this->db->query($sql);	
		if(!$result)return false;
		while ( ($row  = $this->db->fetch_array($result)) ) {	
			$data[$i++]=$row;				
		} 
		$this->db->free_result($result);	
		return $data; 	 
	}	
	/*
	查询结果集数组
	*/
	public	function findOne($sql){
		$result = $this->db->query($sql);						 
		$data=$this->db->fetch_array($result);	
		$this->db->free_result($result);	 
		return $data;
	}
/*
数据记录条数
*/	
	public function countRecords($sql){	
		$result = $this->db->query($sql);	 		
		return $this->db->num_rows($result);		
	}
		
/*
更新数据
*/	
	public function updt($sql){
		$result=$this->db->query($sql);
		if($result){//如果数据操作返回为真	
			$sql=trim($sql);
			$method=strtolower (substr($sql,0,6));
			if($method=='insert'||$method=='replace'){
				return  $this->db->insert_id();	//如果为插入数据操作则返回新增记录的id
			}else{
				return $this->db->affected_rows();//否则返回影响的记录条数，其值有可能大于或等于零，因此在Adtion类方法中返回值大于或等于零表示操作无错误
			}		
		}else{
			return false;
		}	
	}



	/**
    * 启动事务
    * @access function 
    * @return void
    */
	public function begintrans() {
		if ($this->transTimes == 0) {
			$this->db->begintrans();
		}
		$this->transTimes++;
		return true;
	}

    /**
    * 用于非自动提交状态下面的查询提交
    * @access function 
    * @return boolen
    */
    public function commit() {
        if ($this->transTimes > 0) {
           $result = $this->db->commit();
            $this->transTimes = 0;
            if(!$result){
               // throw_exception($this->db->error());
                return false;
            }
        }
        return true;
    }

    /**
    * 事务回滚
    * @access function 
    * @return boolen
    */
    public function rollback() {
        if ($this->transTimes > 0) {
            $result = $this->db->rollback();
            $this->transTimes = 0;
            if(!$result){
               // throw new exception($this->db->error());
				//throw new Exception($this->$error());
                return false;
            }
        }
        return true;
    }
	
    /**
    * 数据库版本号
    * @access function 
    * @return boolen
    */	
	
	public function version(){
		$result = $this->db->version();
		return $result;
	}
	

 /*  +------------------------------------------------------------------------------ */		

} //

?>
 