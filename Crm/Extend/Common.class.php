<?php
class Common {
	function ajax_json_success($message,$callbackType="",$forwardUrl=""){
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
				  "navTabId"=>"", 
				  "rel"=>"1", 
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
/*		if($callbackType) echo "\$.pdialog.closeCurrent();";
		echo "navTab.closeCurrentTab();";
		echo "</script>";
echo <<<EOD
<textarea style="width:95%;height:200px">
零起飞客户关系管理系统

在线演示地址	http://www.lingqifei.com/
下载地址	http://code.google.com/p/dwz/

官方微博： http://weibo.com/dwzui

零起飞i创始人：
	[北京]杜权(UI设计)		d@j-ui.com
	[杭州]吴平(Ajax开发)	w@j-ui.com
	[北京]张慧华(Ajax开发)	z@j-ui.com

新加入成员：
	[北京]张涛	QQ:122794105
	[北京]冀刚	QQ:63502308	jiweigang2008@tom.com
	[北京]郑应海	QQ:55691650
	[成都]COCO	QQ:80095667
	
有问题尽量发邮件或微博	
</textarea>
EOD;*/
		
	}
}
?>
