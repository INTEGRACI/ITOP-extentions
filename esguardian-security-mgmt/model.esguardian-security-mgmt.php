<?php
//
// File generated by ... on the 2015-12-30T08:02:01+0100
// Please do not edit manually
//

/**
 * Classes and menus for esguardian-security-mgmt (version 1.0.0)
 *
 * @author      iTop compiler
 * @license     http://opensource.org/licenses/AGPL-3.0
 */



abstract class SecurityRole extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			'category' => 'bizmodel,searchable',
			'key_type' => 'autoincrement',
			'name_attcode' => 'name',
			'state_attcode' => '',
			'reconc_keys' => array('name', 'org_id', 'org_name', 'finalclass'),
			'db_table' => 'securityrole',
			'db_key_field' => 'id',
			'db_finalclass_field' => 'finalclass',
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>'name', "default_value"=>'', "is_null_allowed"=>false, "depends_on"=>array(), "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeText("description", array("allowed_values"=>null, "sql"=>'description', "default_value"=>'', "is_null_allowed"=>true, "depends_on"=>array(), "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("org_id", array("targetclass"=>'Organization', "allowed_values"=>null, "sql"=>'org_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("org_name", array("allowed_values"=>null, "extkey_attcode"=>'org_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("occupants_list", array("linked_class"=>'lnkPersonToSecurityRole', "ext_key_to_me"=>'securityrole_id', "ext_key_to_remote"=>'person_id', "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "duplicates"=>false, "depends_on"=>array(), "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("documents_list", array("linked_class"=>'lnkDocumentToSecurityRole', "ext_key_to_me"=>'securityrole_id', "ext_key_to_remote"=>'document_id', "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "duplicates"=>false, "depends_on"=>array(), "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("conflictingroles_list", array("linked_class"=>'lnkSecurityRoleBidirectional', "ext_key_to_me"=>'left_securityrole_id', "ext_key_to_remote"=>'right_securityrole_id', "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "duplicates"=>false, "depends_on"=>array(), "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("tickets_list", array("linked_class"=>'lnkSecurityRoleToTicket', "ext_key_to_me"=>'securityrole_id', "ext_key_to_remote"=>'ticket_id', "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "duplicates"=>false, "depends_on"=>array(), "always_load_in_tables"=>false)));



		MetaModel::Init_SetZListItems('details', array (
  0 => 'name',
  1 => 'org_id',
  2 => 'occupants_list',
  3 => 'documents_list',
));
		MetaModel::Init_SetZListItems('standard_search', array (
  0 => 'name',
  1 => 'org_id',
));
		MetaModel::Init_SetZListItems('list', array (
  0 => 'finalclass',
  1 => 'org_id',
));

	}


	/**
                * Placeholder for backward compatibility (iTop <= 2.1.0)
                * in case an extension attempts to redefine this function...     
                */
 public static function GetRelationQueries($sRelCode){return parent::GetRelationQueries($sRelCode);} 


 function DisplayBareRelations(WebPage $oPage, $bEditMode = false)
                    {
                        parent::DisplayBareRelations($oPage, $bEditMode);

                        $sTicketListAttCode = 'tickets_list';

                        if (MetaModel::IsValidAttCode(get_class($this), $sTicketListAttCode))
                        {
                            // Display one list per leaf class (the only way to display the status as of now)

                            $oAttDef = MetaModel::GetAttributeDef(get_class($this), $sTicketListAttCode);
                            $sLnkClass = $oAttDef->GetLinkedClass();
                            $sExtKeyToMe = $oAttDef->GetExtKeyToMe();
                            $sExtKeyToRemote = $oAttDef->GetExtKeyToRemote();

                            $iTotal = 0;
                            $aSearches = array();

                            foreach (MetaModel::EnumChildClasses('Ticket') as $sSubClass)
                            {
                                if (!MetaModel::HasChildrenClasses($sSubClass))
                                {
                                    $sStateAttCode = MetaModel::GetStateAttributeCode($sSubClass);
                                    if ($sStateAttCode != '')
                                    {
                                        $oSearch = DBSearch::FromOQL("SELECT $sSubClass AS t JOIN $sLnkClass AS lnk ON lnk.$sExtKeyToRemote = t.id WHERE $sExtKeyToMe = :myself AND $sStateAttCode NOT IN ('rejected', 'resolved', 'closed')", array('myself' => $this->GetKey()));
                                        $aSearches[$sSubClass] = $oSearch;

                                        $oSet = new DBObjectSet($oSearch);
                                        $iTotal += $oSet->Count();
                                    }
                                }
                            }

                            $sCount = ($iTotal > 0) ? ' ('.$iTotal.')' : '';
                            $oPage->SetCurrentTab(Dict::S('Class:SecurityRole/Tab:OpenedTickets').$sCount);

                            foreach ($aSearches as $sSubClass => $oSearch)
                            {
                                $sBlockId = __class__.'_opened_'.$sSubClass;
        
                                $oPage->add('<fieldset>');
                                $oPage->add('<legend>'.MetaModel::GetName($sSubClass).'</legend>');
                                $oBlock = new DisplayBlock($oSearch, 'list', false);
                                $oBlock->Display($oPage, $sBlockId, array('menu' => false));
                                $oPage->add('</fieldset>');
                            }
                        }
                    }

}


class ApplicationRole extends SecurityRole
{
	public static function Init()
	{
		$aParams = array
		(
			'category' => 'bizmodel,searchable',
			'key_type' => 'autoincrement',
			'name_attcode' => 'name',
			'state_attcode' => '',
			'reconc_keys' => array('name', 'org_id', 'org_name'),
			'db_table' => 'applicationrole',
			'db_key_field' => 'id',
			'db_finalclass_field' => '',
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("applicationsolution_id", array("targetclass"=>'ApplicationSolution', "allowed_values"=>new ValueSetObjects("SELECT ApplicationSolution WHERE org_id = :this->org_id"), "sql"=>'applicationsolution_id', "is_null_allowed"=>true, "on_target_delete"=>DEL_AUTO, "depends_on"=>array('org_id'), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("applicationsolution_name", array("allowed_values"=>null, "extkey_attcode"=>'applicationsolution_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));



		MetaModel::Init_SetZListItems('details', array (
  0 => 'name',
  1 => 'org_id',
  2 => 'applicationsolution_id',
  3 => 'description',
  4 => 'occupants_list',
  5 => 'conflictingroles_list',
  6 => 'documents_list',
  7 => 'tickets_list',
));
		MetaModel::Init_SetZListItems('standard_search', array (
  0 => 'org_id',
  1 => 'applicationsolution_id',
  2 => 'name',
));
		MetaModel::Init_SetZListItems('list', array (
  0 => 'org_id',
  1 => 'applicationsolution_id',
  2 => 'name',
));

	}


}


class BusinessRole extends SecurityRole
{
	public static function Init()
	{
		$aParams = array
		(
			'category' => 'bizmodel,searchable',
			'key_type' => 'autoincrement',
			'name_attcode' => 'name',
			'state_attcode' => '',
			'reconc_keys' => array('name', 'org_id', 'org_name'),
			'db_table' => 'businessrole',
			'db_key_field' => 'id',
			'db_finalclass_field' => '',
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("businessprocess_id", array("targetclass"=>'BusinessProcess', "allowed_values"=>new ValueSetObjects("SELECT BusinessProcess WHERE org_id = :this->org_id"), "sql"=>'businessprocess_id', "is_null_allowed"=>true, "on_target_delete"=>DEL_AUTO, "depends_on"=>array('org_id'), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("businessprocess_name", array("allowed_values"=>null, "extkey_attcode"=>'businessprocess_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));



		MetaModel::Init_SetZListItems('details', array (
  0 => 'name',
  1 => 'org_id',
  2 => 'businessprocess_id',
  3 => 'description',
  4 => 'occupants_list',
  5 => 'conflictingroles_list',
  6 => 'documents_list',
  7 => 'tickets_list',
));
		MetaModel::Init_SetZListItems('standard_search', array (
  0 => 'org_id',
  1 => 'businessprocess_id',
  2 => 'name',
));
		MetaModel::Init_SetZListItems('list', array (
  0 => 'org_id',
  1 => 'businessprocess_id',
  2 => 'name',
));

	}


}


class lnkPersonToSecurityRole extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			'category' => 'bizmodel',
			'key_type' => 'autoincrement',
			'is_link' => true,
			'name_attcode' => array('securityrole_id', 'person_id'),
			'state_attcode' => '',
			'reconc_keys' => array('securityrole_id', 'person_id'),
			'db_table' => 'lnkpersontosecurityrole',
			'db_key_field' => 'id',
			'db_finalclass_field' => '',
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("securityrole_id", array("targetclass"=>'SecurityRole', "allowed_values"=>null, "sql"=>'securityrole_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("securityrole_name", array("allowed_values"=>null, "extkey_attcode"=>'securityrole_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("person_id", array("targetclass"=>'Person', "allowed_values"=>null, "sql"=>'person_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("person_name", array("allowed_values"=>null, "extkey_attcode"=>'person_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));



		MetaModel::Init_SetZListItems('details', array (
  0 => 'securityrole_id',
  1 => 'person_id',
));
		MetaModel::Init_SetZListItems('standard_search', array (
  0 => 'securityrole_id',
  1 => 'person_id',
));
		MetaModel::Init_SetZListItems('list', array (
  0 => 'securityrole_id',
  1 => 'person_id',
));

	}


}


class lnkSecurityRoleBidirectional extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			'category' => 'bizmodel',
			'key_type' => 'autoincrement',
			'is_link' => true,
			'name_attcode' => array('left_securityrole_id', 'right_securityrole_id'),
			'state_attcode' => '',
			'reconc_keys' => array('left_securityrole_id', 'right_securityrole_id'),
			'db_table' => 'lnksecurityrolebidirectional',
			'db_key_field' => 'id',
			'db_finalclass_field' => '',
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("left_securityrole_id", array("targetclass"=>'SecurityRole', "allowed_values"=>null, "sql"=>'left_securityrole_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("left_securityrole_name", array("allowed_values"=>null, "extkey_attcode"=>'left_securityrole_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("right_securityrole_id", array("targetclass"=>'SecurityRole', "allowed_values"=>null, "sql"=>'right_securityrole_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("right_securityrole_name", array("allowed_values"=>null, "extkey_attcode"=>'right_securityrole_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));



		MetaModel::Init_SetZListItems('details', array (
  0 => 'left_securityrole_id',
  1 => 'right_securityrole_id',
));
		MetaModel::Init_SetZListItems('standard_search', array (
  0 => 'left_securityrole_id',
  1 => 'right_securityrole_id',
));
		MetaModel::Init_SetZListItems('list', array (
  0 => 'left_securityrole_id',
  1 => 'right_securityrole_id',
));

	}


	/**
                * Placeholder for backward compatibility (iTop <= 2.1.0)
                * in case an extension attempts to redefine this function...     
                */
 public function DBInsert(){
                            $this->DBInsertNoReload();
                            $this->Reload();
                            $oMyClone = clone $this;
                            $mem_left = $oMyClone->Get('left_securityrole_id');
                            $mem_right = $oMyClone->Get('right_securityrole_id');
                            $oMyClone->Set('left_securityrole_id',$mem_right);
                            $oMyClone->Set('right_securityrole_id',$mem_left);
                            $oMyClone->DBInsertNoReload();
                            $oMyClone->Reload();
                            return $this->m_iKey;
                } 

	/**
                * Placeholder for backward compatibility (iTop <= 2.1.0)
                * in case an extension attempts to redefine this function...     
                */
 protected function AfterDelete(){
                        $mem_left = $this->Get('right_securityrole_id');
                        $mem_right = $this->Get('left_securityrole_id');
                        $oObjectSet = new DBObjectSet(DBObjectSearch::FromOQL("SELECT lnkSecurityRoleBidirectional WHERE left_securityrole_id='$mem_left' AND  right_securityrole_id='$mem_right'"));
                        $oObjectSet->Seek(0);
                        while ($oObject = $oObjectSet->Fetch())
                        {
                            $oObject->DBDeleteSingleObject();
                        }
                        return;
                } 

}


class lnkDocumentToSecurityRole extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			'category' => 'bizmodel',
			'key_type' => 'autoincrement',
			'is_link' => true,
			'name_attcode' => array('securityrole_id', 'document_id'),
			'state_attcode' => '',
			'reconc_keys' => array('securityrole_id', 'document_id'),
			'db_table' => 'lnkdocumenttosecurityrole',
			'db_key_field' => 'id',
			'db_finalclass_field' => '',
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("securityrole_id", array("targetclass"=>'SecurityRole', "allowed_values"=>null, "sql"=>'securityrole_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("securityrole_name", array("allowed_values"=>null, "extkey_attcode"=>'securityrole_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("document_id", array("targetclass"=>'Document', "allowed_values"=>null, "sql"=>'document_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("document_name", array("allowed_values"=>null, "extkey_attcode"=>'document_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));



		MetaModel::Init_SetZListItems('details', array (
  0 => 'securityrole_id',
  1 => 'document_id',
));
		MetaModel::Init_SetZListItems('standard_search', array (
  0 => 'securityrole_id',
  1 => 'document_id',
));
		MetaModel::Init_SetZListItems('list', array (
  0 => 'securityrole_id',
  1 => 'document_id',
));

	}


}


class lnkSecurityRoleToTicket extends cmdbAbstractObject
{
	public static function Init()
	{
		$aParams = array
		(
			'category' => 'bizmodel',
			'key_type' => 'autoincrement',
			'is_link' => true,
			'name_attcode' => array('ticket_id', 'securityrole_id'),
			'state_attcode' => '',
			'reconc_keys' => array('ticket_id', 'securityrole_id'),
			'db_table' => 'lnksecurityroletoticket',
			'db_key_field' => 'id',
			'db_finalclass_field' => '',
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("ticket_id", array("targetclass"=>'Ticket', "allowed_values"=>null, "sql"=>'ticket_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ticket_ref", array("allowed_values"=>null, "extkey_attcode"=>'ticket_id', "target_attcode"=>'ref', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ticket_title", array("allowed_values"=>null, "extkey_attcode"=>'ticket_id', "target_attcode"=>'title', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("securityrole_id", array("targetclass"=>'SecurityRole', "allowed_values"=>null, "sql"=>'securityrole_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("securityrole_name", array("allowed_values"=>null, "extkey_attcode"=>'securityrole_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeString("impact", array("allowed_values"=>null, "sql"=>'impact', "default_value"=>'', "is_null_allowed"=>true, "depends_on"=>array(), "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeEnum("impact_code", array("allowed_values"=>new ValueSetEnum("manual,computed,not_impacted"), "display_style"=>'list', "sql"=>'impact_code', "default_value"=>'manual', "is_null_allowed"=>false, "depends_on"=>array(), "always_load_in_tables"=>false)));



		MetaModel::Init_SetZListItems('details', array (
  0 => 'ticket_id',
  1 => 'securityrole_id',
  2 => 'impact_code',
));
		MetaModel::Init_SetZListItems('standard_search', array (
  0 => 'ticket_id',
  1 => 'securityrole_id',
  2 => 'impact_code',
));
		MetaModel::Init_SetZListItems('list', array (
  0 => 'ticket_id',
  1 => 'securityrole_id',
  2 => 'impact_code',
));

	}


}
//
// Menus
//
class MenuCreation_esguardian_security_mgmt extends ModuleHandlerAPI
{
	public static function OnMenuCreation()
	{
		global $__comp_menus__; // ensure that the global variable is indeed global !
		$__comp_menus__['ConfigManagement'] = new MenuGroup('ConfigManagement', 20);
		$__comp_menus__['NewRole'] = new NewObjectMenuNode('NewRole', 'SecurityRole', $__comp_menus__['ConfigManagement']->GetIndex(), 9);
		$__comp_menus__['SearchRoles'] = new SearchMenuNode('SearchRoles', 'SecurityRole', $__comp_menus__['ConfigManagement']->GetIndex(), 10);
	}
} // class MenuCreation_esguardian_security_mgmt
