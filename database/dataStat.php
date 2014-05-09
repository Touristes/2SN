<?php
require_once "dataConnect.php";
// peut-être amenné à changer
// id_stat(int primary_key, auto_increment), id_user(int NULL),begin(boolean), period_start(date), period_end(date NULL), post_troll(int), post_actu(int),
// post_image(int), post_video(int), post_text(int), posts(int), news_du_jour(int), shares_files(int)
// private_message_sends (int), private_message_receives (int)
// id_user NULL correspond au site

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
//getSiteTotalPostTroll
//getSiteTotalPostActu
//getSiteTotalPostImage
//getSiteTotalPostVideo
//getSiteTotalPostText
//getSiteTotalPost
//getSiteTotalNewsDuJour
//getSiteTotalSharedFiles
//getSiteTotalPrivateMessageSends
//getSiteTotalPrivateMessageReceives
//getSitePeriodPostTroll
//getSitePeriodPostActu
//getSitePeriodPostImage
//getSitePeriodPostVideo
//getSitePeriodPostText
//getSitePeriodPost
//getSitePeriodNewsDuJour
//getSitePeriodSharedFiles
//getSitePeriodPrivateMessageSends
//getSitePeriodPrivateMessageReceives
//getSitePeriodList
//setSiteTotalPostTroll
//setSiteTotalPostActu
//setSiteTotalPostImage
//setSiteTotalPostVideo
//setSiteTotalPostText
//setSiteTotalPost
//setSiteTotalNewsDuJour
//setSiteTotalSharedFiles
//setSiteTotalPrivateMessageSends
//setSiteTotalPrivateMessageReceives
//setSitePeriodPostTroll
//setSitePeriodPostActu
//setSitePeriodPostImage
//setSitePeriodPostVideo
//setSitePeriodPostText
//setSitePeriodPost
//setSitePeriodNewsDuJour
//setSitePeriodSharedFiles
//setSitePeriodPrivateMessageSends
//setSitePeriodPrivateMessageReceives
//incrementSiteTotalPostTroll
//incrementSiteTotalPostActu
//incrementSiteTotalPostImage
//incrementSiteTotalPostVideo
//incrementSiteTotalPostText
//incrementSiteTotalPost
//incrementSiteTotalNewsDuJour
//incrementSiteTotalSharedFiles
//incrementSiteTotalPrivateMessageSends
//incrementSiteTotalPrivateMessageReceives
//incrementSitePeriodPostTroll
//incrementSitePeriodPostActu
//incrementSitePeriodPostImage
//incrementSitePeriodPostVideo
//incrementSitePeriodPostText
//incrementSitePeriodPost
//incrementSitePeriodNewsDuJour
//incrementSitePeriodSharedFiles
//incrementSitePeriodPrivateMessageSends
//incrementSitePeriodPrivateMessageReceives
//getUserTotalPostTroll
//getUserTotalPostActu
//getUserTotalPostImage
//getUserTotalPostVideo
//getUserTotalPostText
//getUserTotalPost
//getUserTotalNewsDuJour
//getUserTotalSharedFiles
//getUserTotalPrivateMessageSends
//getUserTotalPrivateMessageReceives
//getUserPeriodPostTroll
//getUserPeriodPostActu
//getUserPeriodPostImage
//getUserPeriodPostVideo
//getUserPeriodPostText
//getUserPeriodPost
//getUserPeriodNewsDuJour
//getUserPeriodSharedFiles
//getUserPeriodPrivateMessageSends
//getUserPeriodPrivateMessageReceives
//getUserPeriodList
//incrementUserTotalPostTroll
//incrementUserTotalPostActu
//incrementUserTotalPostImage
//incrementUserTotalPostVideo
//incrementUserTotalPostText
//incrementUserTotalPost
//incrementUserTotalNewsDuJour
//incrementUserTotalSharedFiles
//incrementUserTotalPrivateMessageSends
//incrementUserTotalPrivateMessageReceives
//incrementUserPeriodPostTroll
//incrementUserPeriodPostActu
//incrementUserPeriodPostImage
//incrementUserPeriodPostVideo
//incrementUserPeriodPostText
//incrementUserPeriodPost
//incrementUserPeriodNewsDuJour
//incrementUserPeriodSharedFiles
//incrementUserPeriodPrivateMessageSends
//incrementUserPeriodPrivateMessageReceives
?>
