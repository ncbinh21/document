<?php
$CLSuser= new user;

$fullname = 'Damaris Njeri Mwaura';

//get user in system
function getADUserByFullname($fullname)
{

	$array = split(" ",$fullname);
	$firstname = $array[0];
	$lastname = end($array);

	$user = 'binh03';
	$password = 'xxxxxxx';

	if(empty($user) || empty($password)) return false;
 
	$ldap_host= array(
					array(
						"url" => "ldap://pt.int.tenneco.com",
						"ldap_dn" => "DC=pt,DC=int,DC=tenneco,DC=com"
					),
					array(
						"url" => "ldap://amer.int.tenneco.com",
						"ldap_dn" => "DC=amer,DC=int,DC=tenneco,DC=com"
					),
					array(
						"url" => "ldap://aspa.int.tenneco.com",
						"ldap_dn" => "DC=aspa,DC=int,DC=tenneco,DC=com"
					),
					array(
						"url" => "ldap://emea.int.tenneco.com",
						"ldap_dn" => "DC=emea,DC=int,DC=tenneco,DC=com"
					)
				);
				
	foreach($ldap_host as $host)
	{
		$ldap = ldap_connect($host['url']);	
		ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION,3);
		ldap_set_option($ldap,LDAP_OPT_REFERRALS,0);
		if($bind = @ldap_bind($ldap, "pt\\$user", $password)) {
			$filter = "(&(objectCategory=person)(givenName=$firstname*)(sn=$lastname*))";
			$attr = array("SAMAccountName","mail","givenName","sn");
			$result = ldap_search($ldap, $host['ldap_dn'], $filter, $attr) or exit("Unable to search LDAP server");
			if (FALSE !== $result){
				$entries = ldap_get_entries($ldap, $result);
				if($userSelect = getUserSelect($entries, $fullname)) {
					$CLSuser->saveUser("", $userSelect->getLastName, $userSelect->getFirstName, $userSelect->getEmail);
					return;
				}
			}
			ldap_unbind($ldap);
		}
	}
	return false;
}

//get user select
function getUserSelect($listUser,$fullname)
{
	foreach($listUser as $user)
	{
		if ($fullname == $user['givenname']['0'] . ' ' . $user['sn']['0']) {
				return $user;
		}	
	}
	return false;
}
getADUserByFullname($fullname);
?>

