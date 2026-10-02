<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | Geeklog Forums Plugin 2.9.0                                               |
// +---------------------------------------------------------------------------+
// | chinese_traditional_utf-8.php                                                         |
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
    'pluginlabel' => '論壇',         // What shows up in the siteHeader
    'searchlabel' => '論壇',
    'statslabel' => '論壇貼文總數',
    'statsheading1' => '論壇瀏覽量最高的 10 個主題',
    'statsheading2' => '論壇回覆最多的 10 個主題',
    'statsheading3' => '沒有可報告的主題',
    'useradminmenu' => '論壇偏好設定',
    'access_denied' => '存取被拒绝',
    'autotag_desc_forum' => '[forum: id alternate title] - 顯示指向論壇主題的連結，默認使用“這裡”作為標題。可以指定其他標題，但不是必需的。'
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
    'delete' => '刪除貼文',
    'edit' => '編輯貼文',
    'move' => '移動主題',
    'split' => '分割主題',
    'banippost' => '禁止此 IP 發文',
    'banippostremove' => '解除此 IP 的發文禁令',
    'banip' => '在網站上封鎖 IP',
    'banipremove' => '解除網站上的 IP 封鎖',
    'banipmsg' => '該 IP 已被網站封鎖',
    'banipremovemsg' => '該 IP 的網站封鎖已解除',    
    'movetopic' => '移動主題',
    'movetopicmsg' => '要移動的主題：“<b>%s</b>”',
    'splittopicmsg' => '使用 %s 於 %s 發佈的貼文“<b>%s</b>”建立新主題',
    'selectforum' => '選擇新論壇',
    'lockedpost' => '新增回覆',
    'splitheading' => '分割主題選項：',
    'splitopt1' => '移動從此处開始的所有貼文',
    'splitopt2' => '僅移動此貼文'
);

$LANG_GF04 = array (
    'label_forum' => '論壇資料',
    'label_location' => '位置',
    'label_aim' => 'AIM 使用者名',
    'label_yim' => 'YIM 使用者名',
    'label_icq' => 'ICQ 標识',
    'label_msnm' => 'MS Messenger 名稱',
    'label_interests' => '興趣',
    'label_occupation' => '職業',
);

/* Settings for Additional User profile - Instant Messaging links */
$LANG_GF05 = array ( // No used
    'aim_link'               => '&nbsp;<a href="aim:goim?screenname=',
    'aim_linkend'            => '>',
    'aim_hello'              => '&amp;message=Hi.+Are+you+there?',
    'aim_alttext' => 'AIM:&nbsp;',
    'icq_link'               => '&nbsp;',
    'icq_alttext' => 'ICQ #:&nbsp;',
    'msn_link'               => '&nbsp;<a href="javascript:MsgrApp.LaunchIMUI(',
    'msn_linkend'            => ')">',
    'msn_alttext' => 'Messenger:&nbsp;',
    'yim_link'               => '&nbsp;<a href="ymsgr:sendIM?',
    'yim_linkend' => '">',
    'yim_alttext' => 'YIM:&nbsp;',
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
    'edit' => '編輯',
    'email' => '电子邮件',
    'home' => '首頁',
    'lastpost' => '最後貼文',
    'pm' => 'PM', // private message
    'profile' => '個人資料',
    'quote' => '引用',
    'website' => '網站',
    'newtopic' => '新主題',
    'replytopic' => '發表回覆'
);

/* Block Locations */
$LANG_GF20 = array (
    'blocks_showtopic_name' => '論壇主題顯示',
    'blocks_showtopic_desc' => '每經過 X 個主題貼文後顯示區塊。'
);

// Admin Stats page
$LANG_GF91 = array (
    'gfstats' => '論壇統計',
    'statsmsg' => '總數：',
    'totalcats' => '分類：',
    'totalforums' => '論壇：',
    'totaltopics' => '主題：',
    'totalposts' => '貼文：',
    'totalviews' => '瀏覽量：',
    'avgpmsg' => '平均貼文數/',
    'category' => '分類：',
    'forum' => '論壇：',
    'topic' => '主題：',
    'avgvmsg' => '平均瀏覽量/'
);

// User Preference Page
$LANG_GF92 = array (
    'userpreferences' => '使用者偏好設定',
    'setsavemsg' => '設定已保存。',
    'topicspp' => '每頁主題數',
    'topicsppdscp' => '瀏覽論壇首頁時每頁顯示的主題數',
    'postspp' => '每頁貼文數',
    'postsppdscp' => '每頁顯示的貼文數',
    'newpp' => '每頁新貼文數',
    'newppdscp' => '新貼文頁面每頁顯示的新貼文數',
    'popularpp' => '每頁熱門貼文數',
    'popularppdscp' => '熱門頁面每頁顯示的貼文數',
    'popularl' => '熱門阈值',
    'popularldscp' => '主題達到熱門状態所需的貼文數或瀏覽量',
    'searchpp' => '每頁搜尋結果數',
    'searchppdscp' => '搜尋頁面每頁顯示的結果數',
    'memberspp' => '每頁使用者數',
    'membersppdscp' => '使用者報告頁面每頁顯示的使用者數',
    'viewap' => '檢視匿名貼文',
    'viewapdscp' => '設定為“否”將過濾匿名貼文',
    'alwaysn' => '始终通知',
    'alwaysndscp' => '設定為“是”將為您建立或回覆的主題啟用自動通知',
    'notifyoo' => '僅通知一次', 
    'notifyoodscp' => '自上次存取後，對於包含多個新貼文的論壇和主題只發送一次通知。', 
    'showiframe' => '顯示主題回顾',
    'showiframedscp' => '回覆主題時在底部顯示主題回顾',
    'gfsettings' => '論壇設定'
);

// Board Admin
$LANG_GF93 = array (
    'gfboard' => '論壇管理',
    'addcat' => '新增分類',
    'forum' => '論壇',
    'addforum' => '新增論壇',
    'noforum' => '未找到論壇。',
	'category' => '分類',
    'catorder' => '分類順序',
    'catadded' => '分類已新增。',
    'catdeleted' => '分類已刪除',
    'catedited' => '分類已編輯。',
    'forumadded' => '論壇已新增。',
    'forumaddError' => '新增論壇時出错。',
    'forumdeleted' => '論壇已刪除',
    'forummerged' => '論壇已合並',
    'forumnotmerged' => '無法合並論壇，因為沒有其他可合並的論壇。',
    'forumedited' => '論壇已編輯',
    'forumordered' => '論壇順序已編輯',
    'back' => '返回',
    'addnote' => '注意：您可以編輯這些值。',
    'editforumnote' => '編輯論壇詳細資料：<b>“%s”</b>',
    'deleteforumnote' => '是否刪除論壇 <b>“%s”</b>？其中的所有主題也將被刪除。',
    'mergeforumnote' => '將論壇 <b>“%s”</b> 合並到：',
    'editcatnote' => '編輯分類詳細資料：<b>“%s”</b>',
    'deletecatnote' => '是否刪除分類 <b>“%s”</b>？該分類下的所有論壇及主題也將被刪除。',
    'undercat' => '所屬分類',
    'groupaccess' => '群組存取權限：',
    'action' => '操作',
    'forumdescription' => '論壇說明',
    'posts' => '貼文',
    'ordertitle' => '順序',
    'title' => '標題',
    'description' => '說明',
    'ModEdit' => '編輯',
    'ModMove' => '移動',
    'ModStick' => '置顶',
    'ModBan' => '封鎖',
    'addmoderator' => "新增記錄",
    'delmoderator' => " 刪除\\\\n所選項",
    'moderatorwarningtitle' => '警告：未定義論壇',
    'moderatorwarning' => '新增版主前，请先設定論壇分類並至少新增一個論壇',
    'nomoderatorfound' => "未找到版主。",
    'modadded' => "版主已新增。",
	'modnotadded' => "未新增版主。您需要選擇一個或多個論壇、功能，並選擇一個或多個使用者或一個群組。",
    'moddeleted' => "版主已刪除。",
    'modedited' => "版主已編輯。",
    'private' => '私人論壇',
    'filtertitle' => '選擇要檢視的版主記錄',
	'LANG_addmodtitle' => '新版主',
    'addmessage' => '新增新版主',
    'allowedfunctions' => '允許的功能',
    'userrecords' => '使用者記錄',
    'grouprecords' => '群組記錄',
    'filterview' => '篩選视圖',
    'readonly' => '唯讀論壇',
    'readonlydscp' => '只有版主可以在此論壇發文',
    'hidden' => '隱藏論壇',
    'hiddendscp' => '論壇不會顯示在論壇首頁',
    'hideposts' => '隱藏新貼文',
    'hidepostsdscp' => '更新不會顯示在新貼文區塊或 RSS 訂閱中',
    'mod_title' => '論壇版主',
    'allforums' => '所有論壇',
    'namerequired' => '必须填寫名稱。',
	'resyncedmsg' => '已完成所選分類或論壇的重新同步和清理。<br><ul><li>已重新同步 %s 個主題貼文。</li><li>找到並修覆 %s 個孤立主題記錄（沒有父主題）。</li><li>從其他論壇資料表中找到並清理 %s 個孤立記錄。</li></ul>'
);

// Posts
$LANG_GF95 = array (
    'header1' => '論壇貼文',
    'header2' => '論壇貼文&nbsp;&raquo;&nbsp;%s',
    'notyet' => '此功能尚未實作',
    'delall' => '全部刪除',
    'delallmsg' => '確定要刪除 %s 中的所有貼文吗？',
    'underforum' => '所屬論壇：%s（ID #%s）',
    'moderate' => '審核',
    'nomess' => '未找到貼文。'
);

// Banned IPs
$LANG_GF96 = array (
    'ip' => 'IP',
    'ipaddress' => 'IP 位址',
    'enterip' => '在下方輸入要封鎖的 IP 位址',
    'gfipman' => '按 IP 禁止發文',
    'ban' => '封鎖',
    'noips' => '尚未封鎖任何 IP！',
    'unban' => '解除封鎖',
    'ipbanned' => '該 IP 位址已被禁止發文',
    'banipmsg' => '確定要封鎖 IP“%s”吗？',
    'specip' => '请指定要封鎖的 IP 位址！',
    'ipunbanned' => 'IP 位址已解除封鎖。',
    'ipnotvalid' => 'IP 位址 %s 無效，因此未新增。',
    'noip' => '您沒有提供 IP 位址！'
);

// Subscriptions
$LANG_GF97 = array (
    'gfsubscriptions' => '論壇訂閱'
);

// Smilies
$LANG_GF_SMILIES = array(
    // These strings are used for the "alt" and
    // "title" attribute for the smilies images 
    'biggrin' => '大笑',
    'smile' => '微笑',
    'frown' => '皱眉',
    'eek' => '极客',
    'confused' => '困惑',
    'cool' => '酷',
    'lol' => 'LOL',
    'angry' => '生气',
    'razz' => '调皮',
    'oops' => '糟糕！',
    'surprise' => '惊讶！',
    'cry' => '哭泣',
    'evil' => '邪恶',
    'twisted' => '坏笑',
    'rolleye' => '翻白眼',
    'wink' => '眨眼',
    'exclaim' => '感叹',
    'question' => '疑問',
    'idea' => '主意',
    'arrow' => '箭頭',
    'neutral' => '平静',
    'green' => '绿色笑脸',
    'sick' => '生病',
    'tired' => '疲惫',
    'monkey' => '猴子'
);

// Localization of the Admin Configuration UI
$LANG_configsections['forum'] = array(
    'label' => '論壇',
    'title' => '論壇設定'
);

$LANG_confignames['forum'] = array(
    'registration_required' => '檢視貼文需要登入？',
    'registered_to_post' => '發文需要登入？',
    'allow_notification' => '允許通知？',
    'show_topicreview' => '回覆時顯示主題回顾？',
    'allow_user_dateformat' => '允許使用者自訂日期格式？',
    'use_pm_plugin' => '使用私人訊息插件？',
    'show_topics_perpage' => '每頁顯示的主題數',
    'show_posts_perpage' => '每頁顯示的貼文數',
    'show_messages_perpage' => '每頁顯示的訊息行數',
    'show_searches_perpage' => '每頁顯示的搜尋結果數',
    'showblocks' => '論壇頁面顯示的區塊列',
    'usermenu' => '使用者選單類型',
    'likes_forum' => '論壇点赞',
    'recaptcha' => 'reCAPTCHA',
    // ----------------------------------
    'show_subject_length' => '主題最大長度',
    'min_username_length' => '使用者名最小長度',
    'min_subject_length' => '主題最小長度',
    'min_comment_length' => '貼文內容最小長度',
    'views_tobe_popular' => '成為熱門主題所需的瀏覽量',
    'post_speedlimit' => '發文速度限制（秒）',
    'allowed_editwindow' => '允許編輯貼文的時間範圍（秒）',
    'allow_html' => '允許 HTML 模式？',
    'post_htmlmode' => '將 HTML 模式設為默認？',
    'convert_break' => '將換行轉換為 HTML &lt;BR&gt;？',
    'use_censor' => '使用 Geeklog 內容過濾？',
    'use_glfilter' => '使用 Geeklog 過濾？',
    'use_geshi' => '使用 GeSHi 代码格式化？',
    'use_spamx_filter' => '使用 Spam-X 插件？',
    'show_moods' => '啟用心情？',
    'allow_smilies' => '啟用表情符號？',
    'use_smilies_plugin' => '使用表情符號插件？',
    'avatar_width' => '使用者頭像寬度',
    // ----------------------------------
    'show_centerblock' => '啟用中央區塊？',
    'centerblock_homepage' => '僅在首頁啟用？',
    'centerblock_numposts' => '顯示的貼文數量',
    'cb_subject_size' => '主題最大長度',
    'centerblock_where' => '頁面位置',
    // ----------------------------------
    'sideblock_numposts' => '顯示的貼文數量',
    'sb_subject_size' => '主題最大長度',
    'sb_latestpostonly' => '僅顯示最新貼文？',
    'sideblock_enable' => '已啟用',
    'sideblock_isleft' => '在左側顯示區塊',
    'sideblock_order' => '區塊順序',
    'sideblock_topic_option' => '主題選項',
    'sideblock_topic' => '主題',
    'sideblock_group_id' => '群組',
    'sideblock_permissions' => '權限',    
    // ----------------------------------
    'level1' => '等級 1 所需貼文數',
    'level2' => '等級 2 所需貼文數',
    'level3' => '等級 3 所需貼文數',
    'level4' => '等級 4 所需貼文數',
    'level5' => '等級 5 所需貼文數',
    'level1name' => '等級 1 名稱',
    'level2name' => '等級 2 名稱',
    'level3name' => '等級 3 名稱',
    'level4name' => '等級 4 名稱',
    'level5name' => '等級 5 名稱', 
    // ----------------------------------
    'menublock_enable' => '已啟用',
    'menublock_isleft' => '在左側顯示區塊',
    'menublock_order' => '區塊順序',
    'menublock_topic_option' => '主題選項',
    'menublock_topic' => '主題',
    'menublock_group_id' => '群組',
    'menublock_permissions' => '權限' 
);

$LANG_configsubgroups['forum'] = array(
    'sg_main' => '主要設定'
);

$LANG_tab['forum'] = array(
    'tab_main' => '論壇常规設定',
    'tab_topicposting' => '主題發佈',
    'tab_centerblock' => '中央區塊',
    'tab_sideblock' => '貼文區塊',
    'tab_rank' => '等級', 
    'tab_menublock' => '選單區塊'
);

$LANG_fs['forum'] = array(
    'fs_main' => '論壇常规設定',
    'fs_topicposting' => '主題發佈',
    'fs_centerblock' => '中央區塊',
    'fs_sideblock' => '貼文區塊',
    'fs_sideblock_settings' => '區塊設定', 
    'fs_sideblock_permissions' => '區塊權限',    
    'fs_rank' => '等級', 
    'fs_menublock' => '選單區塊',
    'fs_menublock_settings' => '區塊設定', 
    'fs_menublock_permissions' => '區塊權限'    
);

// Note: entries 0, 1, 12, and 41 are the same as in $LANG_configselects['Core']
$LANG_configselects['forum'] = array(
    0 => array('True' => 1, 'False' => 0),
    1 => array('True' => TRUE, 'False' => FALSE),
    5 => array('Top Of Page' => 1, 'After Featured Story' => 2, 'Bottom Of Page' => 3),
    6 => array('左侧区块' => 'leftblocks', '右侧区块' => 'rightblocks', '所有区块' => 'allblocks', '无区块' => 'noblocks'),
    7 => array('区块菜单' => 'blockmenu', '导航栏' => 'navbar', '无' => 'none'),
    12 => array('No access' => 0, 'Read-Only' => 2, 'Read-Write' => 3),
    13 => array('No access' => 0, 'Use' => 2),
    14 => array('No access' => 0, 'Read-Only' => 2),
    15 => array('All' => TOPIC_ALL_OPTION, 'Homepage Only' => TOPIC_HOMEONLY_OPTION, 'Select Topics' => TOPIC_SELECTED_OPTION),
    16 => array('Disabled' => RECAPTCHA_NO_SUPPORT, 'reCAPTCHA V2' => RECAPTCHA_SUPPORT_V2, 'reCAPTCHA V2 Invisible' => RECAPTCHA_SUPPORT_V2_INVISIBLE),
    41 => array('False' => 0, 'Likes and Dislikes' => 1, 'Likes Only' => 2)
);
?>
