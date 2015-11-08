<?php

/**
 * Pcp.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_pcp_Get_spec(&$spec) {
    $spec['contact_id']['api.optional'] = 1;
}

/**
 * Pcp.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_pcp_Get($params) {
    $returnValues = array();
    $contact_id =  mysql_real_escape_string($params['contact_id']);
    
    $moreSql = '';
    if ($contact_id != '') {
        $moreSql .= " WHERE pcp.contact_id = {$contact_id} ";
    }
    
    $q = "SELECT pcp.*, cp.title as cp_title, (SELECT SUM(cs.amount) FROM civicrm_contribution_soft cs WHERE cs.pcp_id = pcp.id) as amount_raised,(SELECT COUNT(cs.id) FROM civicrm_contribution_soft cs WHERE cs.pcp_id = pcp.id) as no_of_contributions FROM civicrm_pcp pcp LEFT JOIN civicrm_contribution_page cp ON pcp.page_id = cp.id {$moreSql}";

    $d = CRM_Core_DAO::executeQuery($q);
    $returnValues = $d->fetchAll();


    // Spec: civicrm_api3_create_success($values = 1, $params = array(), $entity = NULL, $action = NULL)
    return civicrm_api3_create_success($returnValues, $params, 'Pcp', 'Get');
}
