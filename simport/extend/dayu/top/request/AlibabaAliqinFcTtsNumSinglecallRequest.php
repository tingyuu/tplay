<?php
/**
 * TOP API: alibaba.aliqin.fc.tts.num.singlecall request
 * 
 * @author auto create
 * @since 1.0, 2016.05.24
 */
class AlibabaAliqinFcTtsNumSinglecallRequest
{
	/** 
	 * 被叫号码，支持国内手机号与固话号码,格式如下057188773344,13911112222,4001112222,95500
	 **/
	private $calledNum;
	
	/** 
	 * 被叫号显，传入的显示号码必须是阿里大鱼“管理中心-号码管理”中申请或购买的号码
	 **/
	private $calledShowNum;
	
	/** 
	 * 公共回传参数，在“消息返回”中会透传回该参数；举例：用户可以传入自己下级的会员ID，在消息返回时，该会员ID会包含在内，用户可以根据该会员ID识别是哪位会员使用了你的应用
	 **/
	private $extend;
	
	/** 
	 * TTS模板ID，传入的模板必须是在阿里大鱼“管理中心-语音TTS模板管理”中的可用模板
	 **/
	private $ttsCode;
	
	/** 
	 * 文本转语音（TTS）模板变量，传参规则{"key"："value"}，key的名字须和TTS模板中的变量名一致，多个变量之间以逗号隔开，示例：{"name":"xiaoming","code":"1234"}
	 **/
	private $ttsParam;
	
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

	public function setExtend($extend)
	{
		$this->extend = $extend;
		$this->apiParas["extend"] = $extend;
	}

	public function getExtend()
	{
		return $this->extend;
	}

	public function setTtsCode($ttsCode)
	{
		$this->ttsCode = $ttsCode;
		$this->apiParas["tts_code"] = $ttsCode;
	}

	public function getTtsCode()
	{
		return $this->ttsCode;
	}

	public function setTtsParam($ttsParam)
	{
		$this->ttsParam = $ttsParam;
		$this->apiParas["tts_param"] = $ttsParam;
	}

	public function getTtsParam()
	{
		return $this->ttsParam;
	}

	public function getApiMethodName()
	{
		return "alibaba.aliqin.fc.tts.num.singlecall";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->calledNum,"calledNum");
		RequestCheckUtil::checkNotNull($this->calledShowNum,"calledShowNum");
		RequestCheckUtil::checkNotNull($this->ttsCode,"ttsCode");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
