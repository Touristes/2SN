<?php
require_once "dataConnect.php";
// peut-être amenné à changer
// id_stat(int primary_key, auto_increment), id_user(int NULL),begin(boolean), period_start(date), period_end(date NULL), post_troll(int), post_actu(int),
// post_image(int), post_video(int), post_text(int), posts(int), news_du_jour(int), shares_files(int)
// private_message_sends (int), private_message_receives (int)
// id_user NULL correspond au site

//inititalise les stats du site, s'ils n'existent pas
initSiteStat();

function initSiteStat() {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  if (isSiteStatExist() == FALSE) {
  $query = "INSERT INTO stats (begin, period_start, post_troll, post_actu, post_image,"
	." post_video, post_text, news_du_jour, shared_files, private_message_sends, private_message_receives)"
	."values (1, date('now'), 0, 0, 0, 0, 0, 0, 0, 0, 0);";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  }
  dbClose($db);
  return (TRUE);
}

function isSiteStatExist() {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
    $query = "select stat_ref from stats where id_user = NULL;";
  $result = $db->query($query);
  $i = 0;
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $ID = $row[$i];
    }
  dbClose($db);
  if ($i > 0)
    return (TRUE);
  return (FALSE);
}

//fonction générique pour recupérer la valeur d'un champ
function getField($field, $id_user, $begin, $period_start) {
$db = dbConnect();
  if ($db == FALSE)
    return (0);
  if ($begin == 1)
	$query = "select \"".$field."\" from stats where id_user = ".$id_user." AND begin = 1;";
  else if ($begin == 0) {
	$query = "select \"".$field."\" from stats where id_user = ".$id_user." AND begin = 0 "
		."AND period_start = \"".$period_start."\";";
	}
  $result = $db->query($query);
  if ($result == FALSE)
	return (FALSE);
  $i = 0;
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $content = $row[$i];
    }
  if ($i != 1)
	return (FALSE);
  dbClose($db);
  return ($content);
}

//fonction généreique pour modifier la valeur d'un champ
function setField($field, $id_user, $begin, $period_start, $new_value) {
$db = dbConnect();
  if ($db == FALSE)
    return (0);
  if ($begin == 1)
	$query = "update stats set \"".$field."\"=\"".$new_value."\" where id_user = ".$id_user." AND begin = 1;";
  else if ($begin == 0) {
	$query = "update stats set \"".$field."\"=\"".$new_value."\" where id_user = ".$id_user." AND begin = 0 "
		."AND period_start = \"".$period_start."\";";
	}
  $result = $db->query($query);
  if ($result == FALSE)
	return (FALSE);
  dbClose($db);
  return (TRUE);
}

//fonction générique pour incrémenter la valeur d'un champ
function incrementField($field, $id_user, $begin, $period_start) {
	if ($field == "id_stat" || $field == "id_user" || $field == "period_start" || $field == "period_end")
		return (FALSE);
	if (isPeriodClosed($period_start, $id_user) == true)
		return (FALSE);
	if (strpos($field, "post_") != false)
		setField("posts", $id_user, $begin, $period_start, getField("posts", $id_user, $begin, $period_start) + 1)
	if ($id_user != NULL)
		incrementField($field, "NULL", $begin, $period_start);
	return (setField($field, $id_user, $begin, $period_start, getField($field, $id_user, $begin, $period_start) + 1));
}

//liste des fonctions à ajouter

//addUserStat(id_user)
//addUserNewPeriod(id_user, period_start)
//addSiteNewPeriod(period_start)
//closeSitePeriod(period_start)
//closeUserPeriod(id_user, period_start)
//delUserPeriod(id_user, period_start, period_end)
//delSitePeriod(period_start, period_end)
//delUserStats(id_user)
//getSitePeriodList()
//getUserPeriodList($id_user)
//isSitePeriodClosed($period_start)
//isUserPeriodClosed($period_start,$id_user)
//isPeriodClosed($period_start, $id_user)
//getSiteCloseDate($period_start)
//getUSerCloseDate($period_start, $id_user)

//Liste des fonctions pour récupérer les champs de statistique du site depuis sa création

function getSiteTotalPostTroll() {
	return (getField("post_troll", NULL, 1, NULL));
}
function getSiteTotalPostActu() {
	return (getField("post_actu", NULL, 1, NULL));
}
function getSiteTotalPostImage() {
	return (getField("post_image", NULL, 1, NULL));
}
function getSiteTotalPostVideo(){
	return (getField("post_video", NULL, 1, NULL));
}
function getSiteTotalPostText() {
	return (getField("post_text", NULL, 1, NULL));
}
function getSiteTotalPost() {
	return (getField("posts", NULL, 1, NULL));
}
function getSiteTotalNewsDuJour() {
	return (getField("news_du_jour", NULL, 1, NULL));
}
function getSiteTotalSharedFiles() {
	return (getField("shared_files", NULL, 1, NULL));
}
function getSiteTotalPrivateMessageSends() {
	return (getField("private_message_sends", NULL, 1, NULL));
}
function getSiteTotalPrivateMessageReceives() {
	return (getField("private_message_receives", NULL, 1, NULL));
}

//Liste des fonctions pour récupérer les champs de statistique du site pour une période donnée

function getSitePeriodPostTroll($period_start) {
	return (getField("post_troll", NULL, 0, $period_start));
}
function getSitePeriodPostActu($period_start) {
	return (getField("post_actu", NULL, 0, $period_start));
}
function getSitePeriodPostImage($period_start) {
	return (getField("post_image", NULL, 0, $period_start));
}
function getSitePeriodPostVideo($period_start) {
	return (getField("post_video", NULL, 0, $period_start));
}
function getSitePeriodPostText($period_start) {
	return (getField("post_text", NULL, 0, $period_start));
}
function getSitePeriodPost($period_start) {
	return (getField("posts", NULL, 0, $period_start));
}
function getSitePeriodNewsDuJour($period_start) {
	return (getField("news_du_jour", NULL, 0, $period_start));
}
function getSitePeriodSharedFiles($period_start) {
	return (getField("shared_files", NULL, 0, $period_start));
}
function getSitePeriodPrivateMessageSends($period_start) {
	return (getField("private_message_sends", NULL, 0, $period_start));
}
function getSitePeriodPrivateMessageReceives($period_start) {
	return (getField("private_message_receives", NULL, 0, $period_start));
}

//Liste des fonctions pour modifier les champs de statistique du site depuis sa création

function setSiteTotalPostTroll($new_value) {
	return (setField("post_troll", NULL, 1, NULL, $new_value));
}
function setSiteTotalPostActu($new_value) {
	return (setField("post_actu", NULL, 1, NULL, $new_value));
}
function setSiteTotalPostImage($new_value) {
	return (setField("post_image", NULL, 1, NULL, $new_value));
}
function setSiteTotalPostVideo($new_value) {
	return (setField("post_video", NULL, 1, NULL, $new_value));
}
function setSiteTotalPostText($new_value) {
	return (setField("post_text", NULL, 1, NULL, $new_value));
}
function setSiteTotalPost($new_value) {
	return (setField("posts", NULL, 1, NULL, $new_value));
}
function setSiteTotalNewsDuJour($new_value) {
	return (setField("news_du_jour", NULL, 1, NULL, $new_value));
}
function setSiteTotalSharedFiles($new_value) {
	return (setField("shared_files", NULL, 1, NULL, $new_value));
}
function setSiteTotalPrivateMessageSends($new_value) {
	return (setField("private_message_sends", NULL, 1, NULL, $new_value));
}
function setSiteTotalPrivateMessageReceives($new_value) {
	return (setField("private_message_receives", NULL, 1, NULL, $new_value));
}

//Liste des fonctions pour modifier les champs de statistique du site pour une periode donnée

function setSitePeriodPostTroll($new_value, $period_start) {
	return (setField("post_troll", NULL, 0, $period_start, $new_value));
}
function setSitePeriodPostActu($new_value, $period_start) {
	return (setField("post_actu", NULL, 0, $period_start, $new_value));
}
function setSitePeriodPostImage($new_value, $period_start) {
	return (setField("post_image", NULL, 0, $period_start, $new_value));
}
function setSitePeriodPostVideo($new_value, $period_start) {
	return (setField("post_video", NULL, 0, $period_start, $new_value));
}
function setSitePeriodPostText($new_value, $period_start) {
	return (setField("post_text", NULL, 0, $period_start, $new_value));
}
function setSitePeriodPost($new_value, $period_start) {
	return (setField("posts", NULL, 0, $period_start, $new_value));
}
function setSitePeriodNewsDuJour($new_value, $period_start) {
	return (setField("news_du_jour", NULL, 0, $period_start, $new_value));
}
function setSitePeriodSharedFiles($new_value, $period_start) {
	return (setField("shared_files", NULL, 0, $period_start, $new_value));
}
function setSitePeriodPrivateMessageSends($new_value, $period_start) {
	return (setField("private_message_sends", NULL, 0, $period_start, $new_value));
}
function setSitePeriodPrivateMessageReceives($new_value, $period_start) {
	return (setField("private_message_receives", NULL, 0, $period_start, $new_value));
}

//Liste des fonctions pour incrémenter les champs de statistique du site depuis sa création

function incrementSiteTotalPostTroll() {
	return (incrementField("post_troll", NULL, 1, NULL);
}
function incrementSiteTotalPostActu() {
	return (incrementField("post_actu", NULL, 1, NULL));
}
function incrementSiteTotalPostImage() {
	return (incrementField("post_image", NULL, 1, NULL));
}
function incrementSiteTotalPostVideo() {
	return (incrementField("post_video", NULL, 1, NULL));
}
function incrementSiteTotalPostText() {
	return (incrementField("post_text", NULL, 1, NULL));
}
function incrementSiteTotalPost() {
	return (incrementField("posts", NULL, 1, NULL));
}
function incrementSiteTotalNewsDuJour() {
	return (incrementField("news_du_jour", NULL, 1, NULL));
}
function incrementSiteTotalSharedFiles() {
	return (incrementField("shared_files", NULL, 1, NULL,));
}
function incrementSiteTotalPrivateMessageSends() {
	return (incrementField("private_messagge_sends", NULL, 1, NULL));
}
function incrementSiteTotalPrivateMessageReceives() {
	return (incrementField("private_message_receives", NULL, 1, NULL));
}

//Liste des fonctions pour incrémenter les champs de statistique du site pour une période donnée

function incrementSitePeriodPostTroll($period_start) {
	return (incrementField("post_troll", NULL, 0, $period_start));
}
function incrementSitePeriodPostActu($period_start) {
	return (incrementField("post_actu", NULL, 0, $period_start));
}
function incrementSitePeriodPostImage($period_start) {
	return (incrementField("post_image", NULL, 0, $period_start));
}
function incrementSitePeriodPostVideo($period_start) {
	return (incrementField("post_video", NULL, 0, $period_start));
}
function incrementSitePeriodPostText($period_start) {
	return (incrementField("post_text", NULL, 0, $period_start));
}
function incrementSitePeriodPosts($period_start) {
	return (incrementField("posts", NULL, 0, $period_start));
}
function incrementSitePeriodNewsDuJour($period_start) {
	return (incrementField("news_du_jour", NULL, 0, $period_start));
}
function incrementSitePeriodSharedFiles($period_start) {
	return (incrementField("shared_files", NULL, 0, $period_start));
}
function incrementSitePeriodPrivateMessageSends($period_start) {
	return (incrementField("private_message_sends", NULL, 0, $period_start));
}
function incrementSitePeriodPrivateMessageReceives($period_start) {
	return (incrementField("private_message_receives", NULL, 0, $period_start));
}

//Liste des fonctions pour récupérer les champs de statistique d'un utilisateur depuis la crétion de son compte

function getUserTotalPostTroll($id_user) {
	return (getField("post_troll", $id_user, 1, NULL, $new_value));
}
function getUserTotalPostActu($id_user) {
	return (getField("post_actu", $id_user, 1, NULL, $new_value));
}
function getUserTotalPostImage($id_user) {
	return (getField("post_image", $id_user, 1, NULL, $new_value));
}
function getUserTotalPostVideo($id_user) {
	return (getField("post_video", $id_user, 1, NULL, $new_value));
}
function getUserTotalPostText($id_user) {
	return (getField("post_text", $id_user, 1, NULL, $new_value));
}
function getUserTotalPost($id_user) {
	return (getField("posts", $id_user, 1, NULL, $new_value));
}
function getUserTotalNewsDuJour($id_user) {
	return (getField("news_du_jour", $id_user, 1, NULL, $new_value));
}
function getUserTotalSharedFiles($id_user) {
	return (getField("shared_files", $id_user, 1, NULL, $new_value));
}
function getUserTotalPrivateMessageSends($id_user) {
	return (getField("private_message_sends", $id_user, 1, NULL, $new_value));
}
function getUserTotalPrivateMessageReceives($id_user) {
	return (getField("private_message_receives", $id_user, 1, NULL, $new_value));
}

//Liste des fonctions pour récupérer les champs de statistique d'un utilisateur pour une période donnée

function getUserPeriodPostTroll($id_user, $period_start) {
	return (getField("post_troll", $id_user, 0, $period_start, $new_value));
}
function getUserPeriodPostActu($id_user, $period_start) {
	return (getField("post_actu", $id_user, 0, $period_start, $new_value));
}
function getUserPeriodPostImage($id_user, $period_start) {
	return (getField("post_image", $id_user, 0, $period_start, $new_value));
}
function getUserPeriodPostVideo($id_user, $period_start) {
	return (getField("post_video", $id_user, 0, $period_start, $new_value));
}
function getUserPeriodPostText($id_user, $period_start) {
	return (getField("post_text", $id_user, 0, $period_start, $new_value));
}
function getUserPeriodPost($id_user, $period_start) {
	return (getField("posts", $id_user, 0, $period_start, $new_value));
}
function getUserPeriodNewsDuJour($id_user, $period_start) {
	return (getField("news_du_jour", $id_user, 0, $period_start, $new_value));
}
function getUserPeriodSharedFiles($id_user, $period_start) {
	return (getField("shared_files", $id_user, 0, $period_start, $new_value));
}
function getUserPeriodPrivateMessageSends($id_user, $period_start) {
	return (getField("private_message_sends", $id_user, 0, $period_start, $new_value));
}
function getUserPeriodPrivateMessageReceives($id_user, $period_start) {
	return (getField("private_message_receives", $id_user, 0, $period_start, $new_value));
}

//Liste des fonctions pour modifier les champs de statistique d'un utilisateur depuis la crétion de son compte

function setUserTotalPostTroll($id_user) {
	return (setField("post_troll", $id_user, 1, NULL, $new_value));
}
function setUserTotalPostActu($id_user) {
	return (setField("post_actu", $id_user, 1, NULL, $new_value));
}
function setUserTotalPostImage($id_user) {
	return (setField("post_image", $id_user, 1, NULL, $new_value));
}
function setUserTotalPostVideo($id_user) {
	return (setField("post_video", $id_user, 1, NULL, $new_value));
}
function setUserTotalPostText($id_user) {
	return (setField("post_text", $id_user, 1, NULL, $new_value));
}
function setUserTotalPost($id_user) {
	return (setField("posts", $id_user, 1, NULL, $new_value));
}
function setUserTotalNewsDuJour($id_user) {
	return (setField("news_du_jour", $id_user, 1, NULL, $new_value));
}
function setUserTotalSharedFiles($id_user) {
	return (setField("shared_files", $id_user, 1, NULL, $new_value));
}
function setUserTotalPrivateMessageSends($id_user) {
	return (setField("private_message_sends", $id_user, 1, NULL, $new_value));
}
function setUserTotalPrivateMessageReceives($id_user) {
	return (setField("private_message_receives", $id_user, 1, NULL $new_value));
}

//Liste des fonctions pour modifier les champs de statistique d'un utilisateur pour une période donnée

function setUserPeriodPostTroll($id_user, $period_start) {
	return (setField("post_troll", $id_user, 0, $period_start $new_value));
}
function setUserPeriodPostActu($id_user, $period_start) {
	return (setField("post_actu", $id_user, 0, $period_start $new_value));
}
function setUserPeriodPostImage($id_user, $period_start) {
	return (setField("post_image", $id_user, 0, $period_start $new_value));
}
function setUserPeriodPostVideo($id_user, $period_start) {
	return (setField("post_video", $id_user, 0, $period_start $new_value));
}
function setUserPeriodPostText($id_user, $period_start) {
	return (setField("post_text", $id_user, 0, $period_start $new_value));
}
function setUserPeriodPost($id_user, $period_start) {
	return (setField("posts", $id_user, 0, $period_start $new_value));
}
function setUserPeriodNewsDuJour($id_user, $period_start)  {
	return (setField("news_du_jour", $id_user, 0, $period_start $new_value));
}
function setUserPeriodSharedFiles($id_user, $period_start) {
	return (setField("shared_files", $id_user, 0, $period_start $new_value));
}
function setUserPeriodPrivateMessageSends($id_user, $period_start) {
	return (setField("private_message_sends", $id_user, 0, $period_start $new_value));
}
function setUserPeriodPrivateMessageReceives($id_user, $period_start) {
	return (setField("private_message_receives", $id_user, 0, $period_start $new_value));
}

//Liste des fonctions pour incrémenter les champs de statistique d'un utilisateur depuis la crétion de son compte

function incrementUserTotalPostTroll($id_user) {
	return (incrementField("post_troll", $id_user, 1, NULL));
}
function incrementUserTotalPostActu($id_user) {
	return (incrementField("post_actu", $id_user, 1, NULL));
}
function incrementUserTotalPostImage($id_user) {
	return (incrementField("post_image", $id_user, 1, NULL));
}
function incrementUserTotalPostVideo($id_user) {
	return (incrementField("post_video", $id_user, 1, NULL));
}
function incrementUserTotalPostText($id_user) {
	return (incrementField("post_text", $id_user, 1, NULL));
}
function incrementUserTotalPost($id_user) {
	return (incrementField("posts", $id_user, 1, NULL));
}
function incrementUserTotalNewsDuJour($id_user) {
	return (incrementField("news_du_jour", $id_user, 1, NULL));
}
function incrementUserTotalSharedFiles($id_user) {
	return (incrementField("shared_files", $id_user, 1, NULL));
}
function incrementUserTotalPrivateMessageSends($id_user) {
	return (incrementField("private_message_sends", $id_user, 1, NULL));
}
function incrementUserTotalPrivateMessageReceives($id_user) {
	return (incrementField("private_message_receives", $id_user, 1, NULL));
}

//Liste des fonctions pour incrémenter les champs de statistique d'un utilisateur pour une période donnée

function incrementUserPeriodPostTroll($id_user, $period_start) {
	return (incrementField("post_troll", $id_user, 1, $period_start));
}
function incrementUserPeriodPostActu($id_user, $period_start) {
	return (incrementField("post_actu", $id_user, 1, $period_start));
}
function incrementUserPeriodPostImage($id_user, $period_start) {
	return (incrementField("post_image", $id_user, 1, $period_start));
}
function incrementUserPeriodPostVideo($id_user, $period_start) {
	return (incrementField("post_video", $id_user, 1, $period_start));
}
function incrementUserPeriodPostText($id_user, $period_start) {
	return (incrementField("post_text", $id_user, 1, $period_start));
}
function incrementUserPeriodPost($id_user, $period_start) {
	return (incrementField("posts", $id_user, 1, $period_start));
}
function incrementUserPeriodNewsDuJour($id_user, $period_start) {
	return (incrementField("news_du_jour", $id_user, 1, $period_start));
}
function incrementUserPeriodSharedFiles($id_user, $period_start) {
	return (incrementField("shared_files", $id_user, 1, $period_start));
}
function incrementUserPeriodPrivateMessageSends($id_user, $period_start) {
	return (incrementField("private_message_sends", $id_user, 1, $period_start));
}
function incrementUserPeriodPrivateMessageReceives($id_user, $period_start) {
	return (incrementField("private_message_receives", $id_user, 1, $period_start));
}
?>
