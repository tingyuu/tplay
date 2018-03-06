<?php

/**
 * 1
 * @author auto create
 */
class FcPartnerSmsDetailDto
{
	
	/** 
	 * 公共回传参数
	 **/
	public $extend;
	
	/** 
	 * 短信接收号码
	 **/
	public $rec_num;
	
	/** 
	 * 短信错误码
	 **/
	public $result_code;
	
	/** 
	 * 模板编码
	 **/
	public $sms_code;
	
	/** 
	 * 短信发送内容
	 **/
	public $sms_content;
	
	/** 
	 * 短信接收时间
	 **/
	public $sms_receiver_time;
	
	/** 
	 * 短信发送时间
	 **/
	public $sms_send_time;
	
	/** 
	 * 发送状态 1：等待回执，2：发送失败，3：发送成功
	 **/
	public $sms_status;	
}
?>