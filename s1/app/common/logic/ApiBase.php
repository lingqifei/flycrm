<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */


namespace app\common\logic;

use app\common\error\CodeApiBase;

/**
 * 系统通用逻辑模型
 */
class ApiBase extends LogicBase
{
	/**
	 * API返回数据
	 */
	public function apiReturn($code_data = [], $return_data = [], $return_type = 'json')
	{
		if (is_array($code_data) && array_key_exists(API_CODE_NAME, $code_data)) {

			!empty($return_data) && $code_data['data'] = $return_data;

			$result = $code_data;

		} else if(is_array($code_data) && !array_key_exists(API_CODE_NAME, $code_data)){//支持现有模块的返回代码
			if(!empty($code_data[0]) && $code_data[0]==RESULT_SUCCESS){
				$result[API_CODE_NAME]=1;
				$result[API_MSG_NAME]=$code_data[1];
				$result['data'] = empty($code_data[3])?'':$code_data[3];
			}elseif (!empty($code_data[0]) && $code_data[0]==RESULT_ERROR){
				$result = CodeApiBase::$funCodeError;
                $result[API_MSG_NAME]=$code_data[1];
				$result['data'] = $code_data;

                dlog('这里判断');
                dlog($result);

			}else{
				$result = CodeApiBase::$success;
				$result['data'] = $code_data;
			}
		} else{
			$result = CodeApiBase::$success;
			$result['data'] = $code_data;
		}

		$return_result = $this->checkDataSign($result);
		$return_result['exe_time'] = debug('api_begin', 'api_end');
		return $return_type == 'json' ? json($return_result) : $return_result;
	}

	/**
	 * 检查是否需要响应数据签名
	 */
	public function checkDataSign($data)
	{

//		$info = $this->modelApi->getInfo(['api_url' => URL]);
//
//		$info['is_response_sign'] && !empty($data['data']) && $data['data']['data_sign'] = create_sign_filter($data['data']);

		return $data;
	}

	/**
	 * API错误终止程序
	 */
	public function apiError($code_data = [])
	{
		return throw_response_exception($code_data);
	}

	/**
	 * API提交附加通信参数access_token 参数
	 */
	public function checkAccessToken($param = [])
	{
		if (empty($param['access_token'])) {
			$this->apiError(CodeApiBase::$accessTokenNull);
		} else {
			($param['access_token'] != get_access_token()) && $this->apiError(CodeApiBase::$accessTokenError);
		}
	}

	/**
	 * API提交解析user_token
	 */
	public function checkUserTokenParam($param = [])
	{

		//用户检查，通信息码
		$this->checkAccessToken($param);

		if (empty($param['user_token'])) {
			$this->apiError(CodeApiBase::$userTokenNull);
		} else {
			$decoded_user_token = decoded_user_token($param['user_token']);
			is_string($decoded_user_token) && $this->apiError(CodeApiBase::$userTokenError);
		}
		return $decoded_user_token;
	}


}
