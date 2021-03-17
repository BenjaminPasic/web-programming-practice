<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class CampaignDao extends BaseDao{

  public function __construct(){
    parent::__construct("email_drops");
  }

  public function get_all_email_drops(){
    return $this->query("SELECT * FROM ",[]);
  }

}
