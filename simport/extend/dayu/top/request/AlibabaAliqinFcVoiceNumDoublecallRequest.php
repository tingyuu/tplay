<?php
/**
 * TOP API: alibaba.aliqin.fc.voice.num.doublecall request
 * 
 * @author auto create
 * @since 1.0, 2016.03.06
 */
class AlibabaAliqinFcVoiceNumDoublecallRequest
{
	/** 
	 * 被叫号码，支持国内手机号与固话号码,格式如下057188773344,13911112222,4001112222,95500
	 **/
	private $calledNum;
	
	/** 
	 * 被叫号码侧的号码显示，传入的显示号码可以是阿里大鱼“管理中心-号码管理”中申请通过的号码。显示号码格式如下057188773344，4001112222，95500。显示号码也可以为主叫号码。
	 **/
	private $calledShowNum;
	
	/** 
	 * 主叫号码，支持国内手机号与固话号码,格式如下057188773344,13911112222,4001112222,95500
	 **/
	private $callerNum;
	
	/** 
	 * 主叫号码侧的号码显示，传入的显示号码必须是阿里大鱼“管理中心-号码管理”中申请通过的号码。显示号码格式如下057188773344，4001112222，95500
	 **/
	private $callerShowNum;
	
	/** 
	 * 公共回传参数，在“消息返回”中会透传回该参数；举例：用户可以传入自己下级的会员ID，在消息返回时，该会员ID会包含在内，用户可以根据该会员ID识别是哪位会员使用了你的应用
	 **/
	private $extend;
	
	/** 
	 * 通话超时时长，如接通后到达120秒时，通话会因为超时自动挂断。若无需设置超时时长，可不传。
	 **/
	private $sessionTimeOut;
	
	private $apiParas = array();
	
	public function setCalledNum($calledNum)
	{
		$this->calledNum = $calledNum;
		$this->apiParas["called_num"] = $calledNum;
	}

	public function getCalledNum()
	{
		return $this->calledNum;
	}

	public function setCalledShowNum($calledShowNum)
	{
		$this->calledShowNum = $calledShowNum;
		$this->apiParas["called_show_num"] = $calledShowNum;
	}

	public function getCalledShowNum()
	{
		return $this->calledShowNum;
	}

	public function setCallerNum($callerNum)
	{
		$this->callerNum = $callerNum;
		$this->apiParas["caller_num"] = $callerNum;
	}

	public function getCallerNum()
	{
		return $this->callerNum;
	}

	public function setCallerShowNum($callerShowNum)
	{
		$this->callerShowNum = $callerShowNum;
		$this->apiParas["caller_show_num"] = $callerShowNum;
	}

	public function getCallerShowNum()
	{
		return $this->callerShowNum;
	}

	public function setExtend($extend)
	{
		$this->extend = $extend;
		$this->apiParas["extend"] = $extend;
	}

	public function getExtend()
	{
		return $this->extend;
	}

	public function setSessionTimeOut($sessionTimeOut)
	{
		$this->sessionTimeOut = $sessionTimeOut;
		$this->apiParas["session_time_out"] = $sessionTimeOut;
	}

	public function getSessionTimeOut()
	{
		return $this->sessionTimeOut;
	}

	public function getApiMethodName()
	{
		return "alibaba.aliqin.fc.voice.num.doublecall";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->calledNum,"calledNum");
		RequestCheckUtil::checkNotNull($this->calledShowNum,"calledShowNum");
		RequestCheckUtil::checkNotNull($this->callerNum,"callerNum");
		RequestCheckUtil::checkNotNull($this->callerShowNum,"callerShowNum");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
