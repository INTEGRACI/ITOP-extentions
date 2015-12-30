<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2013 XXXXX
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

Dict::Add('EN US', 'English', 'English', array(
	'Class:ApplicationSolution/Attribute:roles_list' => 'Roles',
	'Class:BusinessProcess/Attribute:roles_list' => 'Roles',
	'Class:Person/Attribute:roles_list' => 'Roles',
	'Class:Ticket/Attribute:securityroles_list' => 'affected roles',
    'Class:Person/Tab:ConflictingRoles' => 'Conflicts',
));


//
// Class: SecurityRole
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:SecurityRole' => 'Security Role',
	'Class:SecurityRole+' => '',
	'Class:SecurityRole/Attribute:name' => 'Name',
	'Class:SecurityRole/Attribute:name+' => '',
	'Class:SecurityRole/Attribute:description' => 'Description',
	'Class:SecurityRole/Attribute:description+' => '',
	'Class:SecurityRole/Attribute:org_id' => 'Organization',
	'Class:SecurityRole/Attribute:org_id+' => '',
	'Class:SecurityRole/Attribute:org_name' => 'Organization Name',
	'Class:SecurityRole/Attribute:org_name+' => 'Common name',
	'Class:SecurityRole/Attribute:occupants_list' => 'Occupants',
	'Class:SecurityRole/Attribute:occupants_list+' => '',
	'Class:SecurityRole/Attribute:documents_list' => 'Documents',
	'Class:SecurityRole/Attribute:documents_list+' => '',
	'Class:SecurityRole/Attribute:conflictingroles_list' => 'Conflicting Roles',
	'Class:SecurityRole/Attribute:conflictingroles_list+' => '',
	'Class:SecurityRole/Attribute:tickets_list' => 'Tickets',
	'Class:SecurityRole/Attribute:tickets_list+' => '',
	'Class:SecurityRole/Attribute:finalclass' => 'Role Type',
	'Class:SecurityRole/Attribute:finalclass+' => '',
));

//
// Class: ApplicationRole
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:ApplicationRole' => 'Application Role',
	'Class:ApplicationRole+' => '',
	'Class:ApplicationRole/Attribute:applicationsolution_id' => 'Application Solution',
	'Class:ApplicationRole/Attribute:applicationsolution_id+' => '',
	'Class:ApplicationRole/Attribute:applicationsolution_name' => 'Application Solution Name',
	'Class:ApplicationRole/Attribute:applicationsolution_name+' => '',
));

//
// Class: BusinessRole
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:BusinessRole' => 'Business Role',
	'Class:BusinessRole+' => '',
	'Class:BusinessRole/Attribute:businessprocess_id' => 'Business process',
	'Class:BusinessRole/Attribute:businessprocess_id+' => '',
	'Class:BusinessRole/Attribute:businessprocess_name' => 'Business process Name',
	'Class:BusinessRole/Attribute:businessprocess_name+' => '',
));

//
// Class: lnkPersonToSecurityRole
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkPersonToSecurityRole' => 'Person/Security Role',
	'Class:lnkPersonToSecurityRole+' => '',
	'Class:lnkPersonToSecurityRole/Attribute:securityrole_id' => 'Security Role',
	'Class:lnkPersonToSecurityRole/Attribute:securityrole_id+' => '',
	'Class:lnkPersonToSecurityRole/Attribute:securityrole_name' => 'Security Role Name',
	'Class:lnkPersonToSecurityRole/Attribute:securityrole_name+' => '',
	'Class:lnkPersonToSecurityRole/Attribute:person_id' => 'Person',
	'Class:lnkPersonToSecurityRole/Attribute:person_id+' => '',
	'Class:lnkPersonToSecurityRole/Attribute:person_name' => 'Person Name',
	'Class:lnkPersonToSecurityRole/Attribute:person_name+' => '',
));

//
// Class: lnkSecurityRoleBidirectional
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkSecurityRoleBidirectional' => 'Security Role/Security Role',
	'Class:lnkSecurityRoleBidirectional+' => '',
	'Class:lnkSecurityRoleBidirectional/Attribute:left_securityrole_id' => 'Left Security Role',
	'Class:lnkSecurityRoleBidirectional/Attribute:left_securityrole_id+' => '',
	'Class:lnkSecurityRoleBidirectional/Attribute:left_securityrole_name' => 'Left Security Role Name',
	'Class:lnkSecurityRoleBidirectional/Attribute:left_securityrole_name+' => '',
	'Class:lnkSecurityRoleBidirectional/Attribute:right_securityrole_id' => 'Right Security Role',
	'Class:lnkSecurityRoleBidirectional/Attribute:right_securityrole_id+' => '',
	'Class:lnkSecurityRoleBidirectional/Attribute:right_securityrole_name' => 'Right Security Role Name',
	'Class:lnkSecurityRoleBidirectional/Attribute:right_securityrole_name+' => '',
));

//
// Class: lnkDocumentToSecurityRole
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkDocumentToSecurityRole' => 'Document/Security Role',
	'Class:lnkDocumentToSecurityRole+' => '',
	'Class:lnkDocumentToSecurityRole/Attribute:securityrole_id' => 'Security Role',
	'Class:lnkDocumentToSecurityRole/Attribute:securityrole_id+' => '',
	'Class:lnkDocumentToSecurityRole/Attribute:securityrole_name' => 'Security Role Name',
	'Class:lnkDocumentToSecurityRole/Attribute:securityrole_name+' => '',
	'Class:lnkDocumentToSecurityRole/Attribute:document_id' => 'Document',
	'Class:lnkDocumentToSecurityRole/Attribute:document_id+' => '',
	'Class:lnkDocumentToSecurityRole/Attribute:document_name' => 'Document Name',
	'Class:lnkDocumentToSecurityRole/Attribute:document_name+' => '',
));

//
// Class: lnkSecurityRoleToTicket
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkSecurityRoleToTicket' => 'Security Role/Ticket',
	'Class:lnkSecurityRoleToTicket+' => '',
	'Class:lnkSecurityRoleToTicket/Attribute:ticket_id' => 'Ticket',
	'Class:lnkSecurityRoleToTicket/Attribute:ticket_id+' => '',
	'Class:lnkSecurityRoleToTicket/Attribute:ticket_ref' => 'Ref',
	'Class:lnkSecurityRoleToTicket/Attribute:ticket_ref+' => '',
	'Class:lnkSecurityRoleToTicket/Attribute:ticket_title' => 'Title',
	'Class:lnkSecurityRoleToTicket/Attribute:ticket_title+' => '',
	'Class:lnkSecurityRoleToTicket/Attribute:securityrole_id' => 'Security Role id',
	'Class:lnkSecurityRoleToTicket/Attribute:securityrole_id+' => '',
	'Class:lnkSecurityRoleToTicket/Attribute:securityrole_name' => 'Security Role Name',
	'Class:lnkSecurityRoleToTicket/Attribute:securityrole_name+' => '',
	'Class:lnkSecurityRoleToTicket/Attribute:impact' => 'Impact',
	'Class:lnkSecurityRoleToTicket/Attribute:impact+' => '',
	'Class:lnkSecurityRoleToTicket/Attribute:impact_code' => 'Impact Code',
	'Class:lnkSecurityRoleToTicket/Attribute:impact_code+' => '',
	'Class:lnkSecurityRoleToTicket/Attribute:impact_code/Value:computed' => 'computed',
	'Class:lnkSecurityRoleToTicket/Attribute:impact_code/Value:computed+' => 'computed',
	'Class:lnkSecurityRoleToTicket/Attribute:impact_code/Value:manual' => 'manual',
	'Class:lnkSecurityRoleToTicket/Attribute:impact_code/Value:manual+' => 'manual',
	'Class:lnkSecurityRoleToTicket/Attribute:impact_code/Value:not_impacted' => 'not impacted',
	'Class:lnkSecurityRoleToTicket/Attribute:impact_code/Value:not_impacted+' => 'not impacted',
));

//
// Application Menu
//

Dict::Add('EN US', 'English', 'English', array(
	'Menu:NewRole' => 'Create Role',
	'Menu:NewRole+' => 'Create Role',
	'Menu:SearchRoles' => 'Search Roles',
	'Menu:SearchRoles+' => 'Search Roles',
));
?>
