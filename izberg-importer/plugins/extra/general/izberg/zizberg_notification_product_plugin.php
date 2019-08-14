<?php
class Izberg_NotificationProductPlugin extends Magmi_ItemProcessor
{
  protected $_start;

	public function getPluginInfo()
	{
		return array("name"=>"Izberg notification product plugin",
					 "author"=>"Sebfie",
					 "version"=>"1.0.0",
					 "url"=>null
    );
	}

  public function processItemAfterId(&$item,$params=null)
  {
    // array("product_id"=>$pid,"new"=>$isnew,"same"=>$this->_same,"asid"=>$asid)
    $sql = "INSERT INTO `izberg_magmi_log` (`log_id`, `message`, `extra_info`, `level`, `scope`, `entity_id`, `created_at`) VALUES (null, 'Updated product ". $params["product_id"] ." from magmi', NULL, 0, 'catalog_product'," . $params["product_id"] . ", NOW())";
    $this->log($sql);
    $this->exec_stmt($sql);
  }

	public function isRunnable()
	{
		return array(true,"");
	}

	public function initialize($params)
	{
	}
}
