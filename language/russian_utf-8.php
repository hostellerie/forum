<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | Geeklog Forums Plugin 2.9.0                                               |
// +---------------------------------------------------------------------------+
// | russian_utf-8.php                                                         |
// | Language defines for all text                                             |
// +---------------------------------------------------------------------------+
// | Copyright (C) 2011 by the following authors:                              |
// |    Geeklog Community Members   geeklog-forum AT googlegroups DOT com      |
// |                                                                           |
// | Copyright (C) 2000,2001 by the following authors:                         |
// |    Tony Bibbs       tony AT tonybibbs DOT com                             |
// |                                                                           |
// | Forum Plugin Authors                                                      |
// |    Mr.GxBlock                                        www.gxblock.com      |
// |    Matthew DeWyer   matt AT mycws DOT com            www.cweb.ws          |
// |    Blaine Lang      geeklog AT langfamily DOT ca     www.langfamily.ca    |
// +---------------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or             |
// | modify it under the terms of the GNU General Public License               |
// | as published by the Free Software Foundation; either version 2            |
// | of the License, or (at your option) any later version.                    |
// |                                                                           |
// | This program is distributed in the hope that it will be useful,           |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
// | GNU General Public License for more details.                              |
// |                                                                           |
// | You should have received a copy of the GNU General Public License         |
// | along with this program; if not, write to the Free Software Foundation,   |
// | Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.           |
// +---------------------------------------------------------------------------+

$PLG_forum_MESSAGE1 = 'Forum Plugin Upgrade: Update completed successfully.';
$PLG_forum_MESSAGE2 = 'Forum Plugin upgrade: We are unable to update this version automatically. Refer to the plugin documentation.';
$PLG_forum_MESSAGE5 = 'Forum Plugin Upgrade failed - check error.log';

$LANG_GF00 = array (
    'pluginlabel' => 'Форум',         // What shows up in the siteHeader
    'searchlabel' => 'Форум',
    'statslabel' => 'Всего сообщений форума',
    'statsheading1' => '10 самых просматриваемых тем форума',
    'statsheading2' => '10 тем форума с наибольшим числом ответов',
    'statsheading3' => 'Нет тем для отображения',
    'useradminmenu' => 'Настройки форума',
    'access_denied' => 'Доступ запрещён',
    'autotag_desc_forum' => '[forum: id alternate title] — отображает ссылку на тему форума с текстом «здесь» в качестве заголовка. Можно указать другой заголовок, но это необязательно.'
);


$LANG_GF01['FORUM']          = 'Forum';
$LANG_GF01['FORUMS']         = 'Forums';
$LANG_GF01['FORUMCATEGORYNAME']  = '%s Forum Category';
$LANG_GF01['FORUMNAME']      = '%s Forum';
$LANG_GF01['ALL']            = 'All'; 
$LANG_GF01['YES']            = 'Yes';
$LANG_GF01['NO']             = 'No';
$LANG_GF01['NEW']            = 'New';
$LANG_GF01['NEXT']           = 'Next';
$LANG_GF01['ERROR']          = 'Error!';
$LANG_GF01['CONFIRM']        = 'Confirm';
$LANG_GF01['UPDATE']         = 'Update';
$LANG_GF01['SAVE']           = 'Save';
$LANG_GF01['CANCEL']         = 'Cancel';
$LANG_GF01['ON']             = 'On: ';
$LANG_GF01['ON2']            = '&nbsp;&nbsp;<b>On: </b>';
$LANG_GF01['BY']             = 'By: ';
$LANG_GF01['RE']             = 'Re: ';
$LANG_GF01['DATE']           = 'Date';
$LANG_GF01['VIEWS']          = 'Views';
$LANG_GF01['REPLIES']        = 'Replies';
$LANG_GF01['NAME']           = 'Name:';
$LANG_GF01['DESCRIPTION']    = 'Description: ';
$LANG_GF01['TOPIC']          = 'Topic';
$LANG_GF01['TOPICS']         = 'Topics';
$LANG_GF01['TOPICSUBJECT']   = 'Topic Subject';
$LANG_GF01['HOMEPAGE']       = 'Home';
$LANG_GF01['SUBJECT']        = 'Subject';
$LANG_GF01['HELLO']          = 'Hello ';
$LANG_GF01['MOVED']          = 'Moved';
$LANG_GF01['POSTS']          = 'Posts';
$LANG_GF01['LASTPOST']       = 'Last Post';
$LANG_GF01['POSTEDON']       = 'Posted on';
$LANG_GF01['POSTEDBY']       = 'Posted By';
$LANG_GF01['PAGES']          = 'Pages';
$LANG_GF01['TODAY']          = 'Today at ';
$LANG_GF01['REGISTERED']     = 'Registered';
$LANG_GF01['ORDERBY']        = 'Order:&nbsp;';
$LANG_GF01['ORDER']          = 'Order:';
$LANG_GF01['USER']           = 'User';
$LANG_GF01['GROUP']          = 'Group';
$LANG_GF01['ANON']           = 'Anonymous';
$LANG_GF01['ADMIN']          = 'Admin';
$LANG_GF01['AUTHOR']         = 'Author';
$LANG_GF01['NOMOOD']         = 'No Mood';
$LANG_GF01['REQUIRED']       = '[Required]';
$LANG_GF01['OPTIONAL']       = '[Optional]';
$LANG_GF01['SUBMIT']         = 'Submit';
$LANG_GF01['PREVIEW']        = 'Preview';
$LANG_GF01['REMOVE']         = 'Remove';
$LANG_GF01['EDIT']           = 'Edit';
$LANG_GF01['DELETE']         = 'Delete';
$LANG_GF01['MERGE']          = 'Merge';
$LANG_GF01['OPTIONS']        = 'Options:';
$LANG_GF01['MISSINGSUBJECT'] = 'Subject empty';
$LANG_GF01['MIGRATE_NOW']    = 'Migrate Now';
$LANG_GF01['no_articles_found']    = 'No articles found.';
$LANG_GF01['FILTERLIST']     = 'Filter List';
$LANG_GF01['SELECTFORUM']    = 'Select Forum';
$LANG_GF01['DELETEAFTER']    = 'Delete Selected Articles After Migration';
$LANG_GF01['MIGRATEARTICLES']    = 'Migrate Selected Articles To';
$LANG_GF01['TITLE']          = 'Title';
$LANG_GF01['COMMENTS']       = 'Comments'; 
$LANG_GF01['SUBMISSIONS']    = 'Submissions';
$LANG_GF01['HTML_FILTER_MSG']  = 'Filtered HTML Allowed';
$LANG_GF01['HTML_FULL_MSG']  = 'Full HTML Allowed';
$LANG_GF01['HTML_MSG']       = 'HTML Allowed';
$LANG_GF01['CENSOR_PERM_MSG']  = 'Censored Content';
$LANG_GF01['ANON_PERM_MSG']    = 'View Anonymous Posts';
$LANG_GF01['POST_PERM_MSG1']    = 'Able to post';
$LANG_GF01['POST_PERM_MSG2']    = 'Anonymous users can post';
$LANG_GF01['GO']             = 'GO';
$LANG_GF01['STATUS']         = 'Status:';
$LANG_GF01['ONLINE']         = 'online';
$LANG_GF01['OFFLINE']        = 'offline';
$LANG_GF01['forumname']      = '';   // Enter name here if you want it to show in the footer of the admin screens
$LANG_GF01['category']       = 'Category: ';
$LANG_GF01['loginreqview']   = 'Sorry you must %s register</a> or %s login </a> to use these forums';
$LANG_GF01['loginreqfeature']   = 'Sorry you must %s register</a> or %s login </a> to use this feature of the forum';
$LANG_GF01['loginreqpost']   = 'Sorry you must register or login to post on these forums';
$LANG_GF01['nolastpostmsg']  = 'N/A';
$LANG_GF01['no_one']         = 'No one.';
$LANG_GF01['TEXTMODE']       = 'Text Mode';
$LANG_GF01['HTMLMODE']       = 'HTML Mode';
$LANG_GF01['TopicPreview']   = 'Topic post preview';
$LANG_GF01['moderator']      = 'Moderator';
$LANG_GF01['admin']          = 'Admin';
$LANG_GF01['DATEADDED']      = 'Date Added';
$LANG_GF01['PREVTOPIC']      = 'Prev Topic';
$LANG_GF01['NEXTTOPIC']      = 'Next Topic';
$LANG_GF01['RESYNC']         = "ReSync";
$LANG_GF01['RESYNCCAT']      = "ReSync Category Forums";  
$LANG_GF01['EDITICON']       = 'Edit';
$LANG_GF01['QUOTEICON']      = 'Quote';
$LANG_GF01['ProfileLink']    = 'Profile';
$LANG_GF01['WebsiteLink']    = 'Website';
$LANG_GF01['PMLink']         = 'PM';
$LANG_GF01['EmailLink']      = 'Email';
$LANG_GF01['FORUMSUBSCRIBE'] = 'Subscribe to this forum';
$LANG_GF01['FORUMUNSUBSCRIBE'] = 'Un-Subscribe to this forum';
$LANG_GF01['FORUMSUBSCRIBE_TRUE'] = 'Subscribe:Enabled';
$LANG_GF01['FORUMSUBSCRIBE_FALSE'] = 'Subscribe:Disabled';
$LANG_GF01['NEWTOPIC']       = 'New Topic';
$LANG_GF01['NEWPOSTS']       = 'New Posts';
$LANG_GF01['NEWFORUMPOSTS']  = 'New Form Posts';
$LANG_GF01['POSTREPLY']      = 'Post Reply';
$LANG_GF01['SubscribeLink']  = 'Subscribe';
$LANG_GF01['unSubscribeLink'] = 'Un-Subscribe';
$LANG_GF01['SubscribeLink_TRUE']  = 'Subscribe:Enabled';
$LANG_GF01['SubscribeLink_FALSE'] = 'Subscribe:Disabled';
$LANG_GF01['SUBSCRIPTIONS']  = 'Subscriptions';
$LANG_GF01['TOP']            = 'Top of Post';
$LANG_GF01['PRINTABLE']      = 'Printable Version';
$LANG_GF01['printed_subject']   = 'Forum Subject: %s';
$LANG_GF01['USERPREFS']      = 'Preferences';
$LANG_GF01['SPEEDLIMIT']     = 'Your last comment was %s seconds ago. This site requires at least %s seconds between forum posts.';
$LANG_GF01['ACCESSERROR']    = 'ACCESS ERROR';
$LANG_GF01['ACTIONS']        = 'Actions';
$LANG_GF01['DELETEALL']      = 'Delete all selected records';
$LANG_GF01['DELCONFIRM']     = 'Are you sure you want to Delete this selected record?';
$LANG_GF01['DELALLCONFIRM']  = 'Are you sure you want to Delete ALL selected records?';
$LANG_GF01['DELCONFIRM_PARENT'] = 'Are you sure you want to Delete this parent topic? It means that any replies it has will also be deleted.';
$LANG_GF01['DELALLCONFIRM_PARENT'] = 'Are you sure you want to Delete ALL selected records? If you have selected parent topics, then any replies to those topics will also be deleted. Parent Topics are the ones that show Views greater than 0.';
$LANG_GF01['STARTEDBY']      = 'Started By';
$LANG_GF01['WARNING']        = 'Warning';
$LANG_GF01['MODERATED']      = 'Moderators: %s';
$LANG_GF01['LASTREPLYBY']    = 'Last reply by:&nbsp;%s';
$LANG_GF01['UID']            = 'UID';
$LANG_GF01['FORUMMENU']      = 'Forum Menu';
$LANG_GF01['INDEXPAGE']      = 'Forum Index';
$LANG_GF01['FEATURE']        = 'Feature';
$LANG_GF01['SETTING']        = 'Setting';
$LANG_GF01['MARKALLREAD']    = 'Mark All Read';
$LANG_GF01['MSG_NO_CAT']     = 'No Categories or Forums Defined';
$LANG_GF01['FORUMPOSTS']     = 'Forum Posts';
$LANG_GF01['FORUMPOST']      = 'Forum Post';
$LANG_GF01['MESSAGE']     	 = 'Message';
$LANG_GF01['HERE']     	     = 'here';

// Language for bbcode toolbar
$LANG_GF01['CODE']           = 'Code';
$LANG_GF01['FONTCOLOR']      = 'Font Color';
$LANG_GF01['FONTSIZE']       = 'Font Size';
$LANG_GF01['CLOSETAGS']      = 'Close Tags';
$LANG_GF01['CODETIP']        = 'Tip: Styles can be applied quickly to selected text';
$LANG_GF01['TINY']           = 'Tiny';
$LANG_GF01['SMALL']          = 'Small';
$LANG_GF01['NORMAL']         = 'Normal';
$LANG_GF01['LARGE']          = 'Large';
$LANG_GF01['HUGE']           = 'Huge';
$LANG_GF01['DEFAULT']        = 'Default';
$LANG_GF01['DKRED']          = 'Dark Red';
$LANG_GF01['RED']            = 'Red';
$LANG_GF01['ORANGE']         = 'Orange';
$LANG_GF01['BROWN']          = 'Brown';
$LANG_GF01['YELLOW']         = 'Yellow';
$LANG_GF01['GREEN']          = 'Green';
$LANG_GF01['OLIVE']          = 'Olive';
$LANG_GF01['CYAN']           = 'Cyan';
$LANG_GF01['BLUE']           = 'Blue';
$LANG_GF01['DKBLUE']         = 'Dark Blue';
$LANG_GF01['INDIGO']         = 'Indigo';
$LANG_GF01['VIOLET']         = 'Violet';
$LANG_GF01['WHITE']          = 'White';
$LANG_GF01['BLACK']          = 'Black';

$LANG_GF01['b_help']         = "Bold text: [b]text[/b]";
$LANG_GF01['i_help']         = "Italic text: [i]text[/i]";
$LANG_GF01['u_help']         = "Underline text: [u]text[/u]";
$LANG_GF01['q_help']         = "Quote text: [quote]text[/quote]";
$LANG_GF01['c_help']         = "Code display: [code]code[/code]";
$LANG_GF01['l_help']         = "List: [list]text[/list]";
$LANG_GF01['o_help']         = "Ordered list: [olist]text[/olist]";
$LANG_GF01['p_help']         = "[img]http://image_url[/img]  or [img w=100 h=200][/img]";
$LANG_GF01['w_help']         = "Insert URL: [url]http://url[/url] or [url=http://url]URL text[/url]";
$LANG_GF01['a_help']         = "Close all open bbCode tags";
$LANG_GF01['s_help']         = "Font color: [color=red]text[/color]  Tip: you can also use color=#FF0000";
$LANG_GF01['f_help']         = "Font size: [size=7]small text[/size]";
$LANG_GF01['h_help']         = "Click to view more detailed help";


$LANG_GF02['msg01']    = 'Sorry you must register to use these forums';
$LANG_GF02['msg02']    = 'You should not be here! Restricted access to this forum only';
$LANG_GF02['msg03']    = 'Please wait while you are redirected';
$LANG_GF02['msg05']    = 'No topics have been created yet.';
$LANG_GF02['msg07']    = 'Online Users:';
$LANG_GF02['msg14']    = 'Sorry, You have been banned from making entries. If you feel this is an error, please contact the <a href="mailto:%s?subject=Forum IP Ban">Site Admin</a>.';
$LANG_GF02['msg18']    = 'Error! Not all required fields were completed or were too short in length.';
$LANG_GF02['msg19']    = 'Your message has been posted.';
$LANG_GF02['msg22']    = '- Forum Post Notification';
				

//$LANG_GF02['msg23a']   = "A reply has been made to the thread '%s' by %s.\n\nThis topic was started by %s in the %s forum.\n\nYou may view the reply at:\n%s\n";
$LANG_GF02['reply_to_thread_msg']   	= "A reply has been made to the thread '%s' by %s.";
$LANG_GF02['topic_started_msg']     	= "This topic was started by %s in the %s forum.";
$LANG_GF02['view_reply_at_msg']     	= "You may view the reply at:";
//$LANG_GF02['msg23b']   = "A new topic '%s' has been posted by %s in the '%s' forum on the %s website.\n\nYou may view it at:\n%s\n";
$LANG_GF02['new_topic_msg']   			= "A new topic '%s' has been posted by %s in the '%s' forum on the %s website.";
$LANG_GF02['view_topic_at_msg']     	= "You may view it at:";
//$LANG_GF02['msg23d']   = "An edit has been made to a post in the thread '%s' by %s.\n\nThis topic was started by %s in the %s forum.\n\nYou may view the edited post at:\n%s\n";
$LANG_GF02['edit_to_post_msg']   	= "An edit has been made to a post in the thread '%s' by %s.";
$LANG_GF02['view_edit_at_msg']     	= "You may view the edited post at:";
//$LANG_GF02['msg26a']   = "\nYou are receiving this email because you have chosen to be notified when a reply has been made to this topic. To stop receiving notifications on this topic go to:\n%s\n";
$LANG_GF02['stop_reply_notify_msg'] 	= "You are receiving this email because you have chosen to be notified when a reply has been made to this topic. To stop receiving notifications on this topic go to:";
//$LANG_GF02['msg26b']   = "\nYou are receiving this email because you have chosen to be notified when a new topic has been posted to this forum. To stop receiving notifications for this forum go to:\n%s\n";
$LANG_GF02['stop_new_notify_msg'] 	= "You are receiving this email because you have chosen to be notified when a new topic has been posted to this forum. To stop receiving notifications for this forum go to:";
//$LANG_GF02['msg25']    = "\nHave a great day! \n";
$LANG_GF02['great_day_msg']     		= "Have a great day!";


$LANG_GF02['msg33']    = 'Author: ';
$LANG_GF02['msg36']    = 'Mood:';
$LANG_GF02['msg38']    = 'Notify me of replies ';
$LANG_GF02['msg40']    = 'Sorry, but you have already asked to be notified of replies to this topic.';
$LANG_GF02['msg44']    = 'No notifications found for specified settings.';
$LANG_GF02['msg49']    = '(Read %s times) ';
$LANG_GF02['msg55']    = 'Post Deleted.';
$LANG_GF02['msg56']    = 'IP Banned.';
$LANG_GF02['msg57']    = 'IP removed from being Banned.';
$LANG_GF02['msg59']    = 'Normal Topic';
$LANG_GF02['msg60']    = 'New Post';
$LANG_GF02['msg61']    = 'Sticky Topic';
$LANG_GF02['msg62']    = 'Notify me of replies';
$LANG_GF02['msg64']    = 'Are you sure you want to delete topic %s titled: %s ?';
$LANG_GF02['msg65']    = 'This is a parent topic, so all replies posted to it will also be deleted.<br><br>';
$LANG_GF02['msg68']    = 'Do you really want to remove the ban for the ip address: %s?';
$LANG_GF02['msg69']    = 'Do you really want to ban the ip address: %s?';
$LANG_GF02['msg71']    = 'No function selected, choose a post and then a moderator function. Note: You must be a moderator to perform these functions.';
$LANG_GF02['msg72']    = 'Warning, you do not have rights to perform this moderation function.';
$LANG_GF02['msg74']    = 'Latest %s Forum Posts';
$LANG_GF02['msg75']    = 'Top %s Topics By Views';
$LANG_GF02['msg76']    = 'Top %s Topics By Posts';
$LANG_GF02['msg77']    = 'You should not be here! Restricted access to this forum only.';
$LANG_GF02['msg83']    = 'You need to be signed in to use this forum feature.';
$LANG_GF02['msg84']    = 'Mark all topics read';
$LANG_GF02['msg85']    = 'Page:';
$LANG_GF02['msg86']    = '&nbsp;Last %s posts&nbsp;';
$LANG_GF02['msg87']    = 'Warning: This topic has been locked by the moderator. No additional posts are permitted';
$LANG_GF02['msg88']    = 'Site Users';
$LANG_GF02['msg88b']   = 'Forum Activity Only';
$LANG_GF02['msg89']    = 'My Enabled Notifications';
$LANG_GF02['msg101']   = 'Forum Rules:';
$LANG_GF02['msg103']   = 'Forum Jump:';
$LANG_GF02['msg106']   = 'Select a Forum';
$LANG_GF02['msg107']   = 'Select a User';
$LANG_GF02['msg108']   = 'Active Forum';
$LANG_GF02['msg109']   = 'Locked Topic';
$LANG_GF02['msg110']   = 'Transferring to message edit page..';
$LANG_GF02['msg111']   = 'New Posts Since Last Visit';
$LANG_GF02['msg112']   = 'View all new posts';
$LANG_GF02['msg113']   = 'View new posts';
$LANG_GF02['msg114']   = 'Locked Topic';
$LANG_GF02['msg115']   = 'Sticky Topic W/ New Post';
$LANG_GF02['msg116']   = 'Locked Topic W/ New Post';
$LANG_GF02['msg117']   = 'Search All Forums';
$LANG_GF02['msg118']   = 'Search This Forum';
$LANG_GF02['msg121']   = 'All times are %s. The time is now %s.';
$LANG_GF02['msg134']   = 'Subscription Added';
$LANG_GF02['msg135']   = 'You will now be notified of all posts to this forum.';
$LANG_GF02['msg136']   = 'You must choose a forum to subscribe to.';
$LANG_GF02['msg137']   = 'Notification for topic enabled';
$LANG_GF02['msg138a']  = 'Listed below are all the forum topics you have subscribed to. This means for these subscriptions you will receive an email notification when someone replies to one of your subscribed topics.';
$LANG_GF02['msg138b']  = 'Listed below are all the forums you have subscribed to. This means for these subscriptions you will receive an email notification when a new topic is created in one of these forums, or someone replies to a topic. Please note that deleting a forum subscription will also delete any Forum Topic Exceptions associated with the forum (but not any individual topic notifications).';
$LANG_GF02['msg138c']  = 'Listed below are all the topics that belong to the forum(s) you have subscribed to (see Forum Notifications), but you have unsubscribed from and chosen not to receive any more topic reply email notifications for.';
$LANG_GF02['msg139a']  = 'Listed below are all the forum topics the user you are viewing has subscribed to. This means for these subscriptions the user will receive an email notification when someone replies to one of their subscribed topics. If "All Users" are selected then the User column contains the name of the account the notification is for.';
$LANG_GF02['msg139b']  = 'Listed below are all the forums the user you are viewing has subscribed to. This means for these subscriptions the user will receive an email notification when a new topic is created in one of these forums, or someone replies to a topic. Please note that deleting a forum subscription will also delete any Forum Topic Exceptions associated with the forum (but not any individual topic notifications).  If "All Users" are selected then the User column contains the name of the account the notification is for.';
$LANG_GF02['msg139c']  = 'Listed below are all the topics that belong to the forum(s) the user has subscribed to (see Forum Notifications), but they have unsubscribed from and chosen not to receive any more topic reply email notifications for. If "All Users" are selected then the User column contains the name of the account the notification is for.';
$LANG_GF02['msg142']   = 'Notification saved.';
$LANG_GF02['msg143']   = 'Notification saved but, no email is associated with your user account (or it is invalid). Please add one to your <a href="/usersettings.php">account</a> or you will not receive any notifications.';
$LANG_GF02['msg144']   = 'Return to topic';
$LANG_GF02['msg145']   = 'No email is associated with your user account (or it is invalid). Please add one to your <a href="/usersettings.php">account</a> or you will not receive any notifications.';
$LANG_GF02['msg146']   = 'Notification(s) Deleted.';
$LANG_GF02['msg147']   = 'Forum [printable version of topic %s]';
$LANG_GF02['msg148']   = '';
$LANG_GF02['msg149']   = 'Forum post canceled.';
$LANG_GF02['msg155']   = 'No user posts.';
$LANG_GF02['msg156']   = 'Total number of forum posts:';
$LANG_GF02['msg157']   = 'Last %s Forum Posts';
$LANG_GF02['msg158']   = 'Last %s Forum Posts by %s';
$LANG_GF02['msg159']   = 'Are you sure you want to DELETE these selected Moderator records?';
$LANG_GF02['msg160']   = 'View last page of topic';
$LANG_GF02['msg163']   = 'Post moved';
$LANG_GF02['msg164']   = 'Mark all Categories and Topics Read';
$LANG_GF02['msg166']   = 'ERROR: Invalid topic or Topic not found';
$LANG_GF02['msg167']   = 'Notification Option';
$LANG_GF02['msg168']   = 'Setting of No will disable email notifications';
$LANG_GF02['msg169']   = 'Return to Users listing';
$LANG_GF02['msg170']   = 'Latest Forum Posts';
$LANG_GF02['msg171']   = 'Forum Access Error';
$LANG_GF02['msg172']   = 'Topic does not exist. It possibly has been deleted';
$LANG_GF02['msg173']   = 'Transferring to Post Message page..';
$LANG_GF02['msg174']   = 'Unable to BAN User - Invalid or Empty IP Address';
$LANG_GF02['msg175']   = 'Return to Forum Listing';
$LANG_GF02['msg176']   = 'Select a user';
$LANG_GF02['msg177']   = 'All Users';
$LANG_GF02['msg178']   = 'Parent Posts Only';
$LANG_GF02['msg179']   = 'Content generated in: %s seconds';
$LANG_GF02['msg180']   = 'Forum Posting Alert';
$LANG_GF02['msg181']   = 'You don\'t have access to any other forum as a moderator so you cannot move this topic';
$LANG_GF02['msg182']   = 'Moderator Confirmation';
$LANG_GF02['msg183']   = 'Topic split and moved';
$LANG_GF02['msg186']   = 'New Topic Title';
$LANG_GF02['msg187']   = 'Return to topic - click <a href="%s">here</a>';
$LANG_GF02['msg188']   = 'Click to go directly to last post';
$LANG_GF02['msg189']   = 'Sorry, you ran out of time to edit this post. Edit has been canceled.';
$LANG_GF02['msg190']   = 'Silent Edit';
$LANG_GF02['msg190b']  = 'When enabled and the forum post is saved, no notifications will be sent to users subscribed to this topic (or forum) about this update, and the forum post last updated date will not be changed to the current date and time.';
$LANG_GF02['msg191']   = 'Edit not permitted. Allowable edit time frame expired.';
$LANG_GF02['msg192']   = 'Completed ... Migrated %s topics and %s comments.';
$LANG_GF02['msg193']   = 'Article to Forum Post Migration Tool';
$LANG_GF02['msg194']   = 'Quiet Forum';
$LANG_GF02['msg195']   = 'Click to Jump to Forum';
$LANG_GF02['msg196']   = 'View the main forum index';
$LANG_GF02['msg197']   = 'Mark All Read';
$LANG_GF02['msg198']   = 'Update your forum settings';
$LANG_GF02['msg199']   = 'View or remove forum notifications';
$LANG_GF02['msg200']   = 'Users Report';
$LANG_GF02['msg201']   = 'Popular Topics';
$LANG_GF02['popularforumtopics']   = 'Popular Forum Topics';
$LANG_GF02['poptopisby']   = 'Popular Topics by %s';
$LANG_GF02['by']   = 'By';
$LANG_GF02['replies']   = 'Replies';
$LANG_GF02['views']   = 'Views';
$LANG_GF02['forumsearchresults']   = 'Forum Search Results';
$LANG_GF02['forumsearchfor']   = 'Forum Search results for "%s"';
$LANG_GF02['msg202']   = 'No new posts.';
$LANG_GF02['msg203']   = 'No posts found.';
$LANG_GF02['msg300']   = 'This Forum Post by an anonymous user has been blocked. To enable see your <a href="/forum/userprefs.php">Forum User Preferences</a>.';
$LANG_GF02['msg301']   = 'Really mark all topics in all forums and categories read?';
$LANG_GF02['msg301a']   = 'All topics in all forums and categories have now been marked as read.';
$LANG_GF02['msg302']   = 'Really mark all topics read in this forum?';
$LANG_GF02['msg302a']   = 'All topics in this forum have now been marked as read.';
$LANG_GF02['msg303']   = 'Really mark all topics in all forums in this category read?';
$LANG_GF02['msg303a']   = 'All topics in all forums from this category have now been marked as read.';
$LANG_GF02['PostReply']   = 'Post New Reply';
$LANG_GF02['PostTopic']   = 'Post New Topic';
$LANG_GF02['EditTopic']   = 'Edit Topic';
$LANG_GF02['quietforum']  = 'Forum has no new topics';
$LANG_GF02['adminconfirmation']   = 'Administrator Confirmation';
$LANG_GF02['num_forumposts']   = '%s Forum Post(s)';
$LANG_GF02['gl_topics_desc']   = '<em>Important:</em> These are Geeklog Topics (which you have Edit access for) which can be assigned to the root parent forum topic post (which then applies to the entire fourm topic) or the Forum, or Category itself. If Geeklog Topics are assigned to the Category or Forum they will then be inherited by and items below it (unless that item is assigned to another Geeklog Topic).<br' . XHTML . '><br' . XHTML . '>Since Blocks (and their positions) are assigned to Geeklog Topics this allows you to select the Geeklog Topic you want and then have these Blocks display for the forum topic. This also allows the blocks postion "Forum Show Topic" to be used more effectively.<br' . XHTML . '><br' . XHTML . '>The Geeklog Topic assignment(s) for forum topics does not affect the permissions of the forum (like it does with articles). If the visitor has access to view the forum post but not the topic assigned to it then "All Topics" is assumed. If no Geeklog Topics are assigned to the forum topic then the default "All Topics" is assumed.';
$LANG_GF02['gl_topics_inherit_category'] = '%s (inherited from Category)';
$LANG_GF02['gl_topics_inherit_forum'] = '%s (inherited from Forum)';
$LANG_GF02['gl_topics_inherit_config'] = '%s (inherited from Config)';
$LANG_GF02['gl_topics_assigned']   = 'Geeklog Topic Assigned:';
$LANG_GF02['gl_printed_subject']   = 'Forum Subject: %s';

$LANG_GF03 = array (
    'delete' => 'Удалить сообщение',
    'edit' => 'Редактировать сообщение',
    'move' => 'Переместить тему',
    'split' => 'Разделить тему',
    'banippost' => 'Запретить публикацию с IP',
    'banippostremove' => 'Снять запрет публикации для IP',
    'banip' => 'Заблокировать IP на сайте',
    'banipremove' => 'Снять блокировку IP на сайте',
    'banipmsg' => 'IP заблокирован на сайте',
    'banipremovemsg' => 'Блокировка IP на сайте снята',    
    'movetopic' => 'Переместить тему',
    'movetopicmsg' => 'Перемещаемая тема: «<b>%s</b>»',
    'splittopicmsg' => 'Создать новую тему из сообщения «<b>%s</b>» пользователя %s от %s',
    'selectforum' => 'Выберите новый форум',
    'lockedpost' => 'Добавить ответ',
    'splitheading' => 'Параметр разделения темы:',
    'splitopt1' => 'Переместить все сообщения начиная отсюда',
    'splitopt2' => 'Переместить только это сообщение'
);

$LANG_GF04 = array (
    'label_forum' => 'Профиль форума',
    'label_location' => 'Местоположение',
    'label_aim' => 'Имя AIM',
    'label_yim' => 'Имя YIM',
    'label_icq' => 'Идентификатор ICQ',
    'label_msnm' => 'Имя MS Messenger',
    'label_interests' => 'Интересы',
    'label_occupation' => 'Род занятий',
);

/* Settings for Additional User profile - Instant Messaging links */
$LANG_GF05 = array ( // No used
    'aim_link'               => '&nbsp;<a href="aim:goim?screenname=',
    'aim_linkend'            => '>',
    'aim_hello'              => '&amp;message=Hi.+Are+you+there?',
    'aim_alttext'            => 'AIM:&nbsp;',
    'icq_link'               => '&nbsp;',
    'icq_alttext'            => 'ICQ #:&nbsp;',
    'msn_link'               => '&nbsp;<a href="javascript:MsgrApp.LaunchIMUI(',
    'msn_linkend'            => ')">',
    'msn_alttext'            => 'Messenger:&nbsp;',
    'yim_link'               => '&nbsp;<a href="ymsgr:sendIM?',
    'yim_linkend'            => '">',
    'yim_alttext'            => 'YIM:&nbsp;',
);


/* Admin Navbar */
$LANG_GF06 = array (
    1   => 'Statistics',
    2   => 'Settings',
    3   => 'Forums',
    4   => 'Moderator',
    5   => 'Migrate',
    6   => 'Posts',
	7   => 'Subscriptions',
    8   => 'Banned IPs'
);


/* User Functions Navbar */
$LANG_GF07 = array (
    1   => 'View Forums',
    2   => 'Preferences',
    3   => 'Popular Topics',
    4   => 'Subscriptions',
    5   => 'Users'
);


/* Forum User Features */
$LANG_GF08 = array (
    1   => 'Topic Notifications',
    2   => 'Forum Notifications',
    3   => 'Forum Topic Exceptions',
);

/* Text for the buttons */
$LANG_GF09 = array (
    'edit' => 'Редактировать',
    'email' => 'Эл. почта',
    'home' => 'Главная',
    'lastpost' => 'Последнее сообщение',
    'pm'       => 'PM', // private message
    'profile' => 'Профиль',
    'quote' => 'Цитировать',
    'website' => 'Веб-сайт',
    'newtopic' => 'Новая тема',
    'replytopic' => 'Ответить'
);

/* Block Locations */
$LANG_GF20 = array (
    'blocks_showtopic_name' => 'Показ темы форума',
    'blocks_showtopic_desc' => 'Показывает блоки после каждых X сообщений темы.'
);

// Admin Stats page
$LANG_GF91 = array (
    'gfstats' => 'Статистика форума',
    'statsmsg' => 'Всего:',
    'totalcats' => 'Категории:',
    'totalforums' => 'Форумы:',
    'totaltopics' => 'Темы:',
    'totalposts' => 'Сообщения:',
    'totalviews' => 'Просмотры:',
    'avgpmsg' => 'Среднее число сообщений на:',
    'category' => 'Категорию:',
    'forum' => 'Форум:',
    'topic' => 'Тему:',
    'avgvmsg' => 'Среднее число просмотров на:'
);

// User Preference Page
$LANG_GF92 = array (
    'userpreferences' => 'Настройки пользователя',
    'setsavemsg' => 'Настройки сохранены.',
    'topicspp' => 'Тем на странице',
    'topicsppdscp' => 'Количество тем на странице списка форумов',
    'postspp' => 'Сообщений на странице',
    'postsppdscp' => 'Количество сообщений на странице',
    'newpp' => 'Новых сообщений на странице',
    'newppdscp' => 'Количество новых сообщений на странице новых сообщений',
    'popularpp' => 'Популярных сообщений на странице',
    'popularppdscp' => 'Количество сообщений на странице популярных тем',
    'popularl' => 'Порог популярности',
    'popularldscp' => 'Количество сообщений или просмотров, после которого тема считается популярной',
    'searchpp' => 'Результатов поиска на странице',
    'searchppdscp' => 'Количество результатов на странице поиска',
    'memberspp' => 'Пользователей на странице',
    'membersppdscp' => 'Количество пользователей на странице отчёта',
    'viewap' => 'Показывать анонимные сообщения',
    'viewapdscp' => 'Значение «Нет» скрывает анонимные сообщения',
    'alwaysn' => 'Всегда уведомлять',
    'alwaysndscp' => 'Значение «Да» включает автоматические уведомления для созданных вами тем и тем, на которые вы отвечали',
    'notifyoo' => 'Уведомлять только один раз', 
    'notifyoodscp' => 'Для форумов и тем с несколькими новыми сообщениями после вашего последнего посещения уведомление будет отправлено только один раз.', 
    'showiframe' => 'Показывать обзор темы',
    'showiframedscp' => 'Показывать обзор темы внизу формы ответа',
    'gfsettings' => 'Настройки форума'
);

// Board Admin
$LANG_GF93 = array (
    'gfboard' => 'Администрирование форума',
    'addcat' => 'Добавить категорию',
    'forum' => 'Форум',
    'addforum' => 'Добавить форум',
    'noforum' => 'Форумы не найдены.',
	'category' => 'Категория',
    'catorder' => 'Порядок категорий',
    'catadded' => 'Категория добавлена.',
    'catdeleted' => 'Категория удалена',
    'catedited' => 'Категория изменена.',
    'forumadded' => 'Форум добавлен.',
    'forumaddError' => 'Ошибка добавления форума.',
    'forumdeleted' => 'Форум удалён',
    'forummerged' => 'Форум объединён',
    'forumnotmerged' => 'Форум нельзя объединить: нет другого доступного форума.',
    'forumedited' => 'Форум изменён',
    'forumordered' => 'Порядок форумов изменён',
    'back' => 'Назад',
    'addnote' => 'Примечание: эти значения можно редактировать.',
    'editforumnote' => 'Редактировать параметры форума: <b>«%s»</b>',
    'deleteforumnote' => 'Удалить форум <b>«%s»</b>? Все его темы также будут удалены.',
    'mergeforumnote' => 'Объединить форум <b>«%s»</b> с:',
    'editcatnote' => 'Редактировать параметры категории: <b>«%s»</b>',
    'deletecatnote' => 'Удалить категорию <b>«%s»</b>? Все форумы и темы в ней также будут удалены.',
    'undercat' => 'В категории',
    'groupaccess' => 'Доступ группы: ',
    'action' => 'Действия',
    'forumdescription' => 'Описание форума',
    'posts' => 'Сообщения',
    'ordertitle' => 'Порядок',
    'title' => 'Заголовок',
    'description' => 'Описание',
    'ModEdit' => 'Редактировать',
    'ModMove' => 'Переместить',
    'ModStick' => 'Закрепить',
    'ModBan' => 'Заблокировать',
    'addmoderator' => "Добавить запись",
    'delmoderator' => " Удалить\\nвыбранные",
    'moderatorwarningtitle' => 'Предупреждение: форумы не определены',
    'moderatorwarning' => 'Создайте категории и хотя бы один форум перед добавлением модераторов',
    'nomoderatorfound' => "Модераторы не найдены.",
    'modadded' => "Модераторы добавлены.",
	'modnotadded' => "Модераторы не добавлены. Выберите один или несколько форумов, функции и одного или нескольких пользователей либо группу.",
    'moddeleted' => "Модераторы удалены.",
    'modedited' => "Модераторы изменены.",
    'private' => 'Закрытый форум',
    'filtertitle' => 'Выберите записи модераторов для просмотра',
	'LANG_addmodtitle' => 'Новый модератор',
    'addmessage' => 'Добавить модератора',
    'allowedfunctions' => 'Разрешённые функции',
    'userrecords' => 'Записи пользователей',
    'grouprecords' => 'Записи групп',
    'filterview' => 'Фильтр просмотра',
    'readonly' => 'Форум только для чтения',
    'readonlydscp' => 'Только модератор может публиковать сообщения в этом форуме',
    'hidden' => 'Скрытый форум',
    'hiddendscp' => 'Форум не отображается в списке форумов',
    'hideposts' => 'Скрывать новые сообщения',
    'hidepostsdscp' => 'Обновления не будут показываться в блоках новых сообщений или RSS-лентах',
    'mod_title' => 'Модераторы форума',
    'allforums' => 'Все форумы',
    'namerequired' => 'Имя обязательно.',
	'resyncedmsg' => 'Повторная синхронизация и очистка выбранной категории или форума завершены.<br><ul><li>Синхронизировано сообщений тем: %s.</li><li>Найдено и исправлено записей тем без родительской темы: %s.</li><li>Найдено и удалено потерянных записей в других таблицах форума: %s.</li></ul>'
);

// Posts
$LANG_GF95 = array (
    'header1' => 'Сообщения форума',
    'header2' => 'Сообщения форума&nbsp;&raquo;&nbsp;%s',
    'notyet' => 'Функция пока не реализована',
    'delall' => 'Удалить всё',
    'delallmsg' => 'Удалить все сообщения из: %s?',
    'underforum' => 'В форуме: %s (ID №%s)',
    'moderate' => 'Модерировать',
    'nomess' => 'Сообщения не найдены.'
);

// Banned IPs
$LANG_GF96 = array (
    'ip'                 => 'IP',
    'ipaddress' => 'IP-адрес',
    'enterip' => 'Введите ниже IP-адрес для блокировки',
    'gfipman' => 'Запрет публикации по IP',
    'ban' => 'Заблокировать',
    'noips' => 'Заблокированных IP пока нет!',
    'unban' => 'Разблокировать',
    'ipbanned' => 'IP-адрес заблокирован для публикации',
    'banipmsg' => 'Заблокировать IP «%s»?',
    'specip' => 'Укажите IP-адрес для блокировки!',
    'ipunbanned' => 'IP-адрес разблокирован.',
    'ipnotvalid' => 'IP-адрес %s недействителен и не был добавлен.',
    'noip' => 'IP-адрес не указан!'
);

// Subscriptions
$LANG_GF97 = array (
    'gfsubscriptions' => 'Подписки форума'
);

// Smilies
$LANG_GF_SMILIES = array(
    // These strings are used for the "alt" and
    // "title" attribute for the smilies images 
    'biggrin' => 'Широкая улыбка',
    'smile' => 'Улыбка',
    'frown' => 'Хмурый',
    'eek' => 'Гик',
    'confused' => 'Смущённый',
    'cool' => 'Крутой',
    'lol'      => 'LOL',
    'angry' => 'Злой',
    'razz' => 'Дразнится',
    'oops' => 'Ой!',
    'surprise' => 'Удивлён!',
    'cry' => 'Плач',
    'evil' => 'Злой',
    'twisted' => 'Коварный',
    'rolleye' => 'Закатывает глаза',
    'wink' => 'Подмигивание',
    'exclaim' => 'Восклицание',
    'question' => 'Вопрос',
    'idea' => 'Идея',
    'arrow' => 'Стрелка',
    'neutral' => 'Нейтральный',
    'green' => 'Мистер Грин',
    'sick' => 'Болен',
    'tired' => 'Устал',
    'monkey' => 'Обезьяна'
);

// Localization of the Admin Configuration UI
$LANG_configsections['forum'] = array(
    'label' => 'Форум',
    'title' => 'Конфигурация форума'
);

$LANG_confignames['forum'] = array(
    'registration_required' => 'Требуется вход для просмотра сообщений?',
    'registered_to_post' => 'Требуется вход для публикации?',
    'allow_notification' => 'Разрешить уведомления?',
    'show_topicreview' => 'Показывать обзор темы при ответе?',
    'allow_user_dateformat' => 'Разрешить пользовательский формат даты?',
    'use_pm_plugin' => 'Использовать плагин личных сообщений?',
    'show_topics_perpage' => 'Количество тем на странице',
    'show_posts_perpage' => 'Количество сообщений на странице',
    'show_messages_perpage' => 'Количество строк сообщений на странице',
    'show_searches_perpage' => 'Количество результатов поиска на странице',
    'showblocks' => 'Колонки блоков рядом с форумом',
    'usermenu' => 'Тип пользовательского меню',
    'likes_forum' => 'Отметки «Нравится» форума',
    'recaptcha'             => 'reCAPTCHA',
    // ----------------------------------
    'show_subject_length' => 'Максимальная длина темы',
    'min_username_length' => 'Минимальная длина имени пользователя',
    'min_subject_length' => 'Минимальная длина темы',
    'min_comment_length' => 'Минимальная длина сообщения',
    'views_tobe_popular' => 'Число просмотров для статуса популярной темы',
    'post_speedlimit' => 'Интервал публикации (сек.)',
    'allowed_editwindow' => 'Период разрешённого редактирования (сек.)',
    'allow_html' => 'Разрешить режим HTML?',
    'post_htmlmode' => 'Использовать режим HTML по умолчанию?',
    'convert_break' => 'Преобразовывать переносы строк в HTML &lt;BR&gt;?',
    'use_censor' => 'Использовать цензуру Geeklog?',
    'use_glfilter' => 'Использовать фильтрацию Geeklog?',
    'use_geshi' => 'Использовать форматирование кода GeSHi?',
    'use_spamx_filter' => 'Использовать плагин Spam-X?',
    'show_moods' => 'Включить настроения?',
    'allow_smilies' => 'Включить смайлики?',
    'use_smilies_plugin' => 'Использовать плагин смайликов?',
    'avatar_width' => 'Ширина аватара пользователя',
    // ----------------------------------
    'show_centerblock' => 'Включить центральный блок?',
    'centerblock_homepage' => 'Только на главной странице?',
    'centerblock_numposts' => 'Количество показываемых сообщений',
    'cb_subject_size' => 'Максимальная длина темы',
    'centerblock_where' => 'Расположение на странице',
    // ----------------------------------
    'sideblock_numposts' => 'Количество показываемых сообщений',
    'sb_subject_size' => 'Максимальная длина темы',
    'sb_latestpostonly' => 'Показывать только последнее сообщение?',
    'sideblock_enable' => 'Включено',
    'sideblock_isleft' => 'Показывать блок слева',
    'sideblock_order' => 'Порядок блока',
    'sideblock_topic_option' => 'Параметры темы',
    'sideblock_topic' => 'Тема',
    'sideblock_group_id' => 'Группа',
    'sideblock_permissions' => 'Разрешения',    
    // ----------------------------------
    'level1' => 'Число сообщений уровня 1',
    'level2' => 'Число сообщений уровня 2',
    'level3' => 'Число сообщений уровня 3',
    'level4' => 'Число сообщений уровня 4',
    'level5' => 'Число сообщений уровня 5',
    'level1name' => 'Название уровня 1',
    'level2name' => 'Название уровня 2',
    'level3name' => 'Название уровня 3',
    'level4name' => 'Название уровня 4',
    'level5name' => 'Название уровня 5', 
    // ----------------------------------
    'menublock_enable' => 'Включено',
    'menublock_isleft' => 'Показывать блок слева',
    'menublock_order' => 'Порядок блока',
    'menublock_topic_option' => 'Параметры темы',
    'menublock_topic' => 'Тема',
    'menublock_group_id' => 'Группа',
    'menublock_permissions' => 'Разрешения' 
);

$LANG_configsubgroups['forum'] = array(
    'sg_main' => 'Основные настройки'
);

$LANG_tab['forum'] = array(
    'tab_main' => 'Общие настройки форума',
    'tab_topicposting' => 'Публикация тем',
    'tab_centerblock' => 'Центральный блок',
    'tab_sideblock' => 'Блок сообщений',
    'tab_rank' => 'Ранг', 
    'tab_menublock' => 'Блок меню'
);

$LANG_fs['forum'] = array(
    'fs_main' => 'Общие настройки форума',
    'fs_topicposting' => 'Публикация тем',
    'fs_centerblock' => 'Центральный блок',
    'fs_sideblock' => 'Блок сообщений',
    'fs_sideblock_settings' => 'Настройки блока', 
    'fs_sideblock_permissions' => 'Разрешения блока',    
    'fs_rank' => 'Ранг', 
    'fs_menublock' => 'Блок меню',
    'fs_menublock_settings' => 'Настройки блока', 
    'fs_menublock_permissions' => 'Разрешения блока'    
);

// Note: entries 0, 1, 12, and 41 are the same as in $LANG_configselects['Core']
$LANG_configselects['forum'] = array(
    0 => array('True' => 1, 'False' => 0),
    1 => array('True' => TRUE, 'False' => FALSE),
    5 => array('Top Of Page' => 1, 'After Featured Story' => 2, 'Bottom Of Page' => 3),
    6 => array('Левые блоки' => 'leftblocks', 'Правые блоки' => 'rightblocks', 'Все блоки' => 'allblocks', 'Без блоков' => 'noblocks'),
    7 => array('Меню блока' => 'blockmenu', 'Панель навигации' => 'navbar', 'Нет' => 'none'),
    12 => array('No access' => 0, 'Read-Only' => 2, 'Read-Write' => 3),
    13 => array('No access' => 0, 'Use' => 2),
    14 => array('No access' => 0, 'Read-Only' => 2),
    15 => array('All' => TOPIC_ALL_OPTION, 'Homepage Only' => TOPIC_HOMEONLY_OPTION, 'Select Topics' => TOPIC_SELECTED_OPTION),
    16 => array('Disabled' => RECAPTCHA_NO_SUPPORT, 'reCAPTCHA V2' => RECAPTCHA_SUPPORT_V2, 'reCAPTCHA V2 Invisible' => RECAPTCHA_SUPPORT_V2_INVISIBLE),
    41 => array('False' => 0, 'Likes and Dislikes' => 1, 'Likes Only' => 2)
);
?>
