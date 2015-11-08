<?php

require_once 'CRM/Core/Page.php';

class CRM_Pcpcontacttab_Page_Pcp extends CRM_Core_Page {

    public function run() {
        CRM_Utils_System::setTitle(ts('Personal Campaign Pages'));
       
        $cid =  mysql_real_escape_string($_GET['cid']);
        $q = "SELECT pcp.*, cp.title as cp_title, (SELECT SUM(cs.amount) FROM civicrm_contribution_soft cs WHERE cs.pcp_id = pcp.id) as amount_raised,(SELECT COUNT(cs.id) FROM civicrm_contribution_soft cs WHERE cs.pcp_id = pcp.id) as no_of_contributions FROM civicrm_pcp pcp LEFT JOIN civicrm_contribution_page cp ON pcp.page_id = cp.id WHERE pcp.contact_id = ".$cid;
       
        $d = CRM_Core_DAO::executeQuery($q);
        $r = $d->fetchAll();

        $this->assign('base_url', CIVICRM_UF_BASEURL);
        $this->assign('data', $r);

        parent::run();
    }

}
