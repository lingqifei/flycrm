<?php
class Common {
	function ajax_json_success($message,$callbackType="",$tabId="",$forwardUrl=""){
		//$callbackType=!empty($callbackType)?"forward":"";
		switch($callbackType){
			case 1:
				$callbackTypeStr="forward";
				break;
			case 2:
				$callbackTypeStr="closeCurrent";
				break;
			default :
				$callbackTypeStr="";
				break;
		}
		$forwardUrl  =!empty($forwardUrl)?ACT.$forwardUrl:"";
		$menu=array(
				  "statusCode"=>"200", 
				  "message"=>$message, 
				  "navTabId"=>$tabId, 
				  "reloadFlag"=>$tabId, 
				  "rel"=>$tabId, 
				  "callbackType"=>$callbackTypeStr,
				  "forwardUrl"=> $forwardUrl
		 );
		 echo json_encode($menu);		
	}
	
/*	<a class="button" href="javascript:;" onclick="testConfirmMsg('demo/common/ajaxDone.html')"><span>确认（是/否）</span></a><br /><br /><br />
	<a class="button" href="javascript:;" onclick="alertMsg.error('您提交的数据有误，请检查后重新提交！')"><span>错误提示</span></a><br /><br /><br />
	<a class="button" href="javascript:;" onclick="alertMsg.info('您提交的数据有误，请检查后重新提交！')"><span>信息提示</span></a><br /><br /><br />
	<a class="button" href="javascript:;" onclick="alertMsg.warn('您提交的数据有误，请检查后重新提交！')"><span>警告提示</span></a><br /><br /><br />
	<a class="button" href="javascript:;" onclick="alertMsg.correct('您的数据提交成功！')"><span>成功提示</span></a><br /><br />	
*/	
	function alert($message,$type,$callbackType=""){
		echo "<script>";
		echo "alertMsg.$type('$message');";
		echo "navTab.closeCurrentTab();";
		echo "</script>";		
	}
}
?>
