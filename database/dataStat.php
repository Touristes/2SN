<?php
require_once "dataConnect.php";
// peut-être amenné à changer
// id_stat(int primary_key, auto_increment), id_user(int NULL),begin(boolean), period_start(date), period_end(date NULL), post_troll(int), post_actu(int),
// post_image(int), post_video(int), post_text(int), posts(int), news_du_jour(int), shares_files(int)
// private_message_sends (int), private_message_receives (int)
// id_user NULL correspond au site
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

//addUserStat(id_user)
//addUserNewPeriod(id_user, period_start)
//addSiteNewPeriod(period_start)
//closeSitePeriod(period_start)
//closeUserPeriod(id_user, period_start)
//delUserPeriod(id_user, period_start, period_end)
//delSitePeriod(period_start, period_end)
//delUserStats(id_user)
function getField($field, $id_user, $begin, $period_start) {
$db = dbConnect();
  if ($db == FALSE)
    return (0);
  if ($begin == 1)
	$query = "select \"".$field."\" from stats where id_user = \"".$id_user."\" AND begin = 1;";
  else if ($begin == 0) {
	$query = "select \"".$field."\" from stats where id_user = \"".$id_user."\" AND begin = 0 "
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
function setField($field, $id_user, $begin, $period_start, $new_value) {
$db = dbConnect();
  if ($db == FALSE)
    return (0);
  if ($begin == 1)
	$query = "update stats set \"".$field."\"=\"".$new_value."\" where id_user = \"".$id_user."\" AND begin = 1;";
  else if ($begin == 0) {
	$query = "update stats set \"".$field."\"=\"".$new_value."\" where id_user = \"".$id_user."\" AND begin = 0 "
		."AND period_start = \"".$period_start."\";";
	}
  $result = $db->query($query);
  if ($result == FALSE)
	return (FALSE);
  dbClose($db);
  return (TRUE);
}

function incrementField($field, $id_user, $begin, $period_start) {
	if ($field == "id_stat" || $field == "id_user" || $field == "period_start" || $field == "period_end")
		return (FALSE);
	if (strpos($field, "post_") != false)
		setField("posts", $id_user, $begin, $period_start, getField("posts", $id_user, $begin, $period_start) + 1)
	if ($id_user != NULL)
		incrementField($field, "NULL", $begin, $period_start);
	return (setField($field, $id_user, $begin, $period_start, getField($field, $id_user, $begin, $period_start) + 1));
}
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
//getSitePeriodList($period_start)
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
function incrementSiteTotalPostTroll() {
	return (setField("post_troll", NULL, 1, NULL, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSiteTotalPostActu() {
	return (setField("post_actu", NULL, 1, NULL, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSiteTotalPostImage() {
	return (setField("post_image", NULL, 1, NULL, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSiteTotalPostVideo() {
	return (setField("post_video", NULL, 1, NULL, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSiteTotalPostText() {
	return (setField("post_text", NULL, 1, NULL, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSiteTotalPost() {
	return (setField("posts", NULL, 1, NULL, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSiteTotalNewsDuJour() {
	return (setField("news_du_jour", NULL, 1, NULL, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSiteTotalSharedFiles() {
	return (setField("shared_files", NULL, 1, NULL, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSiteTotalPrivateMessageSends() {
	return (setField("private_messagge_sends", NULL, 1, NULL, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSiteTotalPrivateMessageReceives() {
	return (setField("private_message_receives", NULL, 1, NULL, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSitePeriodPostTroll($period_start) {
	return (setField("post_troll", NULL, 0, $period_start, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSitePeriodPostActu($period_start) {
	return (setField("post_actu", NULL, 0, $period_start, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSitePeriodPostImage($period_start) {
	return (setField("post_image", NULL, 0, $period_start, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSitePeriodPostVideo($period_start) {
	return (setField("post_video", NULL, 0, $period_start, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSitePeriodPostText($period_start) {
	return (setField("post_text", NULL, 0, $period_start, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSitePeriodPosts($period_start) {
	return (setField("posts", NULL, 0, $period_start, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSitePeriodNewsDuJour($period_start) {
	return (setField("news_du_jour", NULL, 0, $period_start, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSitePeriodSharedFiles($period_start) {
	return (setField("shared_files", NULL, 0, $period_start, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSitePeriodPrivateMessageSends($period_start) {
	return (setField("private_message_sends", NULL, 0, $period_start, getField("post_troll", NULL, 1, NULL) + 1 ));
}
function incrementSitePeriodPrivateMessageReceives($period_start) {
	return (setField("private_message_receives", NULL, 0, $period_start, getField("post_troll", NULL, 1, NULL) + 1 ));
}
//getUserTotalPostTroll($id_user)
//getUserTotalPostActu($id_user)
//getUserTotalPostImage($id_user)
//getUserTotalPostVideo($id_user)
//getUserTotalPostText($id_user)
//getUserTotalPost($id_user)
//getUserTotalNewsDuJour($id_user)
//getUserTotalSharedFiles($id_user)
//getUserTotalPrivateMessageSends($id_user)
//getUserTotalPrivateMessageReceives($id_user)
//getUserPeriodPostTroll($id_user, $period_start)
//getUserPeriodPostActu($id_user, $period_start)
//getUserPeriodPostImage($id_user, $period_start)
//getUserPeriodPostVideo($id_user, $period_start)
//getUserPeriodPostText($id_user, $period_start)
//getUserPeriodPost($id_user, $period_start)
//getUserPeriodNewsDuJour($id_user, $period_start)
//getUserPeriodSharedFiles($id_user, $period_start)
//getUserPeriodPrivateMessageSends($id_user, $period_start)
//getUserPeriodPrivateMessageReceives($id_user, $period_start)
//getUserPeriodList($id_user, $period_start)
//setUserTotalPostTroll($id_user)
//setUserTotalPostActu($id_user)
//setUserTotalPostImage($id_user)
//setUserTotalPostVideo($id_user)
//setUserTotalPostText($id_user)
//setUserTotalPost($id_user)
//setUserTotalNewsDuJour($id_user)
//setUserTotalSharedFiles($id_user)
//setUserTotalPrivateMessageSends($id_user)
//setUserTotalPrivateMessageReceives($id_user)
//setUserPeriodPostTroll($id_user, $period_start)
//setUserPeriodPostActu($id_user, $period_start)
//setUserPeriodPostImage($id_user, $period_start)
//setUserPeriodPostVideo($id_user, $period_start)
//setUserPeriodPostText($id_user, $period_start)
//setUserPeriodPost($id_user, $period_start)
//setUserPeriodNewsDuJour($id_user, $period_start)
//setUserPeriodSharedFiles($id_user, $period_start)
//setUserPeriodPrivateMessageSends($id_user, $period_start)
//setUserPeriodPrivateMessageReceives($id_user, $period_start)
//incrementUserTotalPostTroll($id_user)
//incrementUserTotalPostActu($id_user)
//incrementUserTotalPostImage($id_user)
//incrementUserTotalPostVideo($id_user)
//incrementUserTotalPostText($id_user)
//incrementUserTotalPost($id_user)
//incrementUserTotalNewsDuJour($id_user)
//incrementUserTotalSharedFiles($id_user)
//incrementUserTotalPrivateMessageSends($id_user)
//incrementUserTotalPrivateMessageReceives($id_user)
//incrementUserPeriodPostTroll($id_user, $period_start)
//incrementUserPeriodPostActu($id_user, $period_start)
//incrementUserPeriodPostImage($id_user, $period_start)
//incrementUserPeriodPostVideo($id_user, $period_start)
//incrementUserPeriodPostText($id_user, $period_start)
//incrementUserPeriodPost($id_user, $period_start)
//incrementUserPeriodNewsDuJour($id_user, $period_start)
//incrementUserPeriodSharedFiles($id_user, $period_start)
//incrementUserPeriodPrivateMessageSends($id_user, $period_start)
//incrementUserPeriodPrivateMessageReceives($id_user, $period_start)
?>
