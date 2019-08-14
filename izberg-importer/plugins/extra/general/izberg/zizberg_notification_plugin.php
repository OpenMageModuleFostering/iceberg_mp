<?php
class Izberg_NotificationPlugin extends Magmi_GeneralImportPlugin
{
  protected $_start;

	public function getPluginInfo()
	{
		return array("name"=>"Izberg notification plugin",
					 "author"=>"Sebfie",
					 "version"=>"1.0.0",
					 "url"=>null
    );
	}

  public function beforeImport()
  {
    $this->_start = time();
  }

	public function afterImport()
	{
		$this->log("notify magento then we finished import","info");
		$this->notify();
		return true;
	}

  public function processItemAfterId(&$item,$params=null)
  {
    // array("product_id"=>$pid,"new"=>$isnew,"same"=>$this->_same,"asid"=>$asid)
    $sql = "INSERT INTO `izberg_magmi_log` (`log_id`, `message`, `extra_info`, `level`, `scope`, `entity_id`, `created_at`) VALUES (null, 'Finished to import in magmi, it tooks: " . $duration . "', NULL, 2, 'catalog_product'," . $params["product_id"] . ", NOW())";
    $this->log($sql);
    $this->exec_stmt($sql);
  }


  public function notify()
  {
    $duration = time() - $this->_start;
    $sql = "INSERT INTO `izberg_magmi_log` (`log_id`, `message`, `extra_info`, `level`, `created_at`) VALUES (null, 'Finished to import in magmi, it tooks: " . $duration . "', NULL, 2, NOW())";
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
