<?php

/**
 * 返回结果对象
 * @author auto create
 */
class BizResult
{
	
	/** 
	 * 错误码
	 **/
	public $err_code;
	
	/** 
	 * 返回结果
	 **/
	public $model;
	
	/** 
	 * 返回信息描述
	 **/
	public $msg;
	
	/** 
	 * true表示成功，false表示失败
	 **/
	public $success;	
}
?>