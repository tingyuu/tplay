<?php
/**
 * TOP API: alibaba.aliqin.fc.flow.charge.province request
 * 
 * @author auto create
 * @since 1.0, 2016.03.30
 */
class AlibabaAliqinFcFlowChargeProvinceRequest
{
	/** 
	 * 需要充值的流量
	 **/
	private $grade;
	
	/** 
	 * 唯一流水号
	 **/
	private $outRechargeId;
	
	/** 
	 * 手机号
	 **/
	private $phoneNum;
	
	/** 
	 * 充值原因
	 **/
	private $reason;
	
	private $apiParas = array();
	
	public function setGrade($grade)
	{
		$this->grade = $grade;
		$this->apiParas["grade"] = $grade;
	}

	public function getGrade()
	{
		return $this->grade;
	}

	public function setOutRechargeId($outRechargeId)
	{
		$this->outRechargeId = $outRechargeId;
		$this->apiParas["out_recharge_id"] = $outRechargeId;
	}

	public function getOutRechargeId()
	{
		return $this->outRechargeId;
	}

	public function setPhoneNum($phoneNum)
	{
		$this->phoneNum = $phoneNum;
		$this->apiParas["phone_num"] = $phoneNum;
	}

	public function getPhoneNum()
	{
		return $this->phoneNum;
	}

	public function setReason($reason)
	{
		$this->reason = $reason;
		$this->apiParas["reason"] = $reason;
	}

	public function getReason()
	{
		return $this->reason;
	}

	public function getApiMethodName()
	{
		return "alibaba.aliqin.fc.flow.charge.province";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->grade,"grade");
		RequestCheckUtil::checkNotNull($this->outRechargeId,"outRechargeId");
		RequestCheckUtil::checkNotNull($this->phoneNum,"phoneNum");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
