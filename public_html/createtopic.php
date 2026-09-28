<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | Geeklog Forums Plugin 2.8.0                                               |
// +---------------------------------------------------------------------------+
// | createtopic.php                                                           |
// | Main program to create topics and posts in the forum                      |
// +---------------------------------------------------------------------------+
// | Copyright (C) 2011 by the following authors:                              |
// |    Geeklog Community Members   geeklog-forum AT googlegroups DOT com      |
// |                                                                           |
// | Copyright (C) 2000,2001,2002,2003 by the following authors:               |
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

use Geeklog\Input;

require_once '../lib-common.php'; // Path to your lib-common.php

if (!in_array('forum', $_PLUGINS)) {
    COM_handle404();
    exit;
}

require_once $CONF_FORUM['path_include'] . 'gf_showtopic.php';
require_once $CONF_FORUM['path_include'] . 'gf_format.php';
require_once $CONF_FORUM['path_include'] . 'forum_editor.php';

// Convert the visual editor payload back to the Forum source format before
// the existing validation, spam checks and persistence logic run.
forum_editor_preparePost();

// Posting assets are registered by plugin_getheadercode_forum() while the
// document head is being assembled.
 
// PREVIEW TOPIC
if ($submit == $LANG_GF01['PREVIEW']) {
    $previewitem = array();
    if ($method == 'edit') {
        $previewitem['uid']  = $edittopic['uid'];
        if ($edittopic['uid'] == 1 AND $aname != '') { // Means mod is editing an anonymous post so update anonymous name if not blank
            // reflect updated anonymous user name
            $previewitem['name'] = stripslashes($aname);
        } else {
            $previewitem['name'] = $edittopic['name'];
        }
    } else {
        if ($uid > 1) {
            $previewitem['name'] = stripslashes($aname);
            $previewitem['uid'] = $_USER['uid'];
        } else {
            $previewitem['name'] = stripslashes(urldecode($aname));
            $previewitem['uid'] = 1;
        }
    }
    $previewitem['date']      = time();
    $previewitem['subject']   = gf_checkHTML($subject);
    $previewitem['postmode']  = gf_chkpostmode($postmode,$mode_switch);
    $previewitem['mood']      = $mood;
	if (isset($edittopic)) {
		$previewitem['pid']       = $edittopic['pid'];
		$previewitem['locked']    = $edittopic['locked'];
		$previewitem['forum']     = $edittopic['forum'];
	} else {
		$previewitem['pid']       = 0;
		$previewitem['locked']    = '';
		$previewitem['forum']     = $forum;
	}
    $previewitem['id']        = 0;
    $previewitem['views']     = 0;

    $previewitem['comment'] = trim($comment);

    $preview_header = COM_newTemplate(CTL_plugin_templatePath('forum'));
    $preview_header->set_file (array ('preview_header'=>'submissionform_preview_header.thtml'));
    $preview_header->set_var ('imgset', $CONF_FORUM['imgset']);
    $preview_header->parse ('output', 'preview_header');
    $display .= $preview_header->finish($preview_header->get_var('output'));

    $display .= showtopic($previewitem,'preview');

    $preview_footer = COM_newTemplate(CTL_plugin_templatePath('forum'));
    $preview_footer->set_file (array ('preview_footer'=>'submissionform_preview_footer.thtml'));
    $preview_footer->set_var ('imgset', $CONF_FORUM['imgset']);
    $preview_footer->parse ('output', 'preview_footer');
    $display .= $preview_footer->finish($preview_footer->get_var('output'));

    // If Moderator and editing the parent topic - see if form has sticky or locked checkbox on
    if ($editmoderator AND $isParent) { // so topic either new topic or edit of parent topic
		$locked_val = '';
		$sticky_val = '';				
		if (isset($_POST['locked_switch']) && $_POST['locked_switch'] == 1 ) {
			$locked_val = 'checked="checked"';
		}
		if (isset($_POST['sticky_switch']) && $_POST['sticky_switch'] == 1 ) {
			$sticky_val = 'checked="checked"';
		}
    }
	
	if ($method == 'edit') {
		$silentedit = false;
		if (isset($_POST['silentedit']) && $_POST['silentedit'] == 1 ) {
			$silentedit = true;
		}
	}
}

// DISPLAY Topic Editor for all methods
if ($editorDisplay) {
	/* Check if this user has moderation rights now to allow a post to a locked topic */
    if (!$editmoderator && (
		($method == 'newtopic' && ($newtopic['is_readonly'] == 1 )) || 
		($method == 'postreply' && ( $edittopic['locked'] == 1 || $edittopic['is_readonly'] == 1 )))) {
			
		$display .= COM_showMessageText($LANG_GF02['msg87'], $LANG_GF01['ERROR']); // This topic has been locked by the moderator. No additional posts are permitted
		$display = gf_createHTMLDocument($display);
		COM_output($display);
		
		exit;
    }

    if ($submit == $LANG_GF01['PREVIEW']) {
        $edittopic['subject'] = COM_stripslashes($subject);
    }
	
    if ($method == 'postreply' OR ($method == 'edit' AND $subject == '')) {
        $subject = $edittopic['subject'];
    } else {
        $subject = COM_stripslashes($subject);
    }

    $topicnavbar = COM_newTemplate(CTL_plugin_templatePath('forum'));
    $topicnavbar->set_file (array ('topicnavbar'=>'submissionform_header.thtml'));
    $topicnavbar->set_var ('imgset', $CONF_FORUM['imgset']);
    $topicnavbar->set_var ('navbreadcrumbsimg','<img alt="" src="'.gf_getImage('nav_breadcrumbs').'"' . XHTML . '>');
    $topicnavbar->set_var ('navtopicimg','<img alt="" src="'.gf_getImage('nav_topic').'"' . XHTML . '>');
    $topicnavbar->set_var ('layout_url', $CONF_FORUM['layout_url']);
    $topicnavbar->set_var ('phpself', $_CONF['site_url'] .'/forum/createtopic.php');

    if ($method == 'newtopic' AND $forum > 0 ) {  // User creating a newtopic
    	$topicnavbar->set_var ('category_id', $newtopic['id']);
        $topicnavbar->set_var ('forum_id', $forum);
        $topicnavbar->set_var ('cat_name',$newtopic['cat_name']);
        $topicnavbar->set_var ('forum_name', $newtopic['forum_name']);
    } else {
    	$topicnavbar->set_var ('category_id', $edittopic['id']);
        $topicnavbar->set_var ('forum_id', $edittopic['forum']);
        $topicnavbar->set_var ('cat_name',$edittopic['cat_name']);
        $topicnavbar->set_var ('forum_name', $edittopic['forum_name']);
    }
    // run the subject through the HTML filter to ensure no XSS issues.
    $subject = gf_checkHTML($subject);
    $topicnavbar->set_var ('topic_id', $id);
    $topicnavbar->set_var ('subject', $subject);
    $topicnavbar->set_var ('LANG_HOME', $LANG_GF01['HOMEPAGE']);
    $topicnavbar->set_var('forum_home',$LANG_GF01['INDEXPAGE']);

    $topicnavbar->set_var ('LANG_bhelp', $LANG_GF01['b_help']);
    $topicnavbar->set_var ('LANG_ihelp', $LANG_GF01['i_help']);
    $topicnavbar->set_var ('LANG_uhelp', $LANG_GF01['u_help']);
    $topicnavbar->set_var ('LANG_qhelp', $LANG_GF01['q_help']);
    $topicnavbar->set_var ('LANG_chelp', $LANG_GF01['c_help']);
    $topicnavbar->set_var ('LANG_lhelp', $LANG_GF01['l_help']);
    $topicnavbar->set_var ('LANG_ohelp', $LANG_GF01['o_help']);
    $topicnavbar->set_var ('LANG_phelp', $LANG_GF01['p_help']);
    $topicnavbar->set_var ('LANG_whelp', $LANG_GF01['w_help']);
    $topicnavbar->set_var ('LANG_ahelp', $LANG_GF01['a_help']);
    $topicnavbar->set_var ('LANG_shelp', $LANG_GF01['s_help']);
    $topicnavbar->set_var ('LANG_fhelp', $LANG_GF01['f_help']);
    $topicnavbar->set_var ('LANG_hhelp', $LANG_GF01['h_help']);

    if ($method == 'newtopic') {
        $postmessage = $LANG_GF02['PostTopic'];
        $topicnavbar->set_var ('hidden_method', 'newtopic');
		$topicnavbar->set_var ('hidden_id', $forum);
    } elseif ($method == 'postreply') {
        $postmessage = $LANG_GF02['PostReply'];
        $topicnavbar->set_var ('hidden_method', 'postreply');
		$topicnavbar->set_var ('hidden_id', $pid);
        if ($submit != $LANG_GF01['PREVIEW']) {
            $subject = $LANG_GF01['RE'] . $subject;
        }
        $edittopic['mood'] = '';
        if ($quoteid > 0) {
            $quotesql = DB_query("SELECT * FROM {$_TABLES['forum_topic']} WHERE id='$quoteid'");
            $quotearray = DB_fetchArray($quotesql);
            $quotearray['comment'] = stripslashes($quotearray['comment']);
            if ($CONF_FORUM['pre2.5_mode'] == true ) {
                if ( $quotearray['postmode'] == 'html' || $quotearray['postmode'] == 'HTML' ) {
                    if (!class_exists('StringParser') ) {
                        require_once $CONF_FORUM['path_include'] . 'bbcode/stringparser_bbcode.class.php';
                    }
                    $comment = gf_formatOldPost($quotearray['comment'],'html');
                    $comment = sprintf($CONF_FORUM['quoteformat'],COM_getDisplayName($quotearray['uid']),$comment);
                } else {
                    $quotearray['comment'] = str_replace("&#36;","$", $quotearray['comment']);
                    $comment = sprintf($CONF_FORUM['quoteformat'],COM_getDisplayName($quotearray['uid']),$quotearray['comment']);
                }
            } else {
                $comment = sprintf($CONF_FORUM['quoteformat'],COM_getDisplayName($quotearray['uid']),$quotearray['comment']);
            }
        }
    } elseif ($method == 'edit') {
        $postmessage = $LANG_GF02['EditTopic'];
        $topicnavbar->set_var ('hidden_method', 'edit');
		$topicnavbar->set_var ('hidden_id', $id);
        if ($editmoderator) {
            $username = COM_getDisplayName($edittopic['uid']);
        } elseif ($uid > 1) {
            $username = COM_getDisplayName($uid);
        }

        $subject = $edittopic['subject'];
        if ($submit != $LANG_GF01['PREVIEW']) {
            $comment = str_ireplace('</textarea>','&lt;/textarea&gt;',$edittopic['comment']);
            $postmode = $edittopic['postmode'];
        } else {
            $comment = str_ireplace('</textarea>','&lt;/textarea&gt;',$comment);
            //$postmode = $_POST['postmode']; // leave as is
        }
        if (strstr($edittopic['comment'],'<pre class="forumCode">') === false) {
            $comment = htmlspecialchars($comment,ENT_QUOTES, $CONF_FORUM['charset']);
        }
    }

    if ($uid >= 2) {
        $token = SEC_createToken();
        $topicnavbar->set_var('gltoken_name', CSRF_TOKEN);
        $topicnavbar->set_var('gltoken', $token);
        $topicnavbar->set_var('gltoken_msg', SEC_getTokenExpiryNotice($token, $LANG24[91]));
    } else {
        $topicnavbar->set_var('gltoken_name', 'token');
        $topicnavbar->set_var('gltoken', '1');
    }

    $topicnavbar->parse ('output', 'topicnavbar');
    $display .= $topicnavbar->finish($topicnavbar->get_var('output'));
    
    $submissionform_main = COM_newTemplate(CTL_plugin_templatePath('forum'));
    $submissionform_main->set_file (array ('submissionform_main'=>'submissionform_main.thtml', 
    									   'submissionform_bbcode_help'=>'submissionform_bbcode_help.thtml'));
    
    $blocks = array('submissionform_anontop', 'submissionform_membertop', 'submissionform_moods', 'submissionform_code', 'submissionform_smilies', 'submissionform_options', 'submissionform_option', 'submissionform_gl_topics');
    foreach ($blocks as $block) {
        $submissionform_main->set_block('submissionform_main', $block);
    }      

	$submissionform_main->set_var ('layout_url', $CONF_FORUM['layout_url']);
	$submissionform_main->set_var ('post_message', $postmessage);
	$submissionform_main->set_var ('LANG_NAME', $LANG_GF02['msg33']);
    
	// Keep track if submission options have been added
	$options_exist = false;

    if ($uid < 2) {
        $submissionform_main->set_var ('name', stripcslashes($aname));
        $submissionform_main->parse ('user_name', 'submissionform_anontop');
    } else {
        if (!isset($username) OR $username == '') {
            if ($method == 'edit') {
                if ($editmoderator) {
                    $username = $username;
                } elseif ($useredit == $LANG_GF01['YES']) {
                    $username = COM_getDisplayName($_USER['uid']);
                }
            } else {
                $username = COM_getDisplayName($_USER['uid']);
            }
        } else {
            if ($editmoderator AND $edittopic['uid'] == 1) {
                if ($method == 'edit' AND $aname == '') {
                    $aname = COM_stripslashes($edittopic['name']);
                } else {
                    $aname = COM_stripslashes($aname);
                }
            }
        }

        $submissionform_main->set_var ('username', $username);
        $submissionform_main->set_var ('aname', $aname);
        $submissionform_main->parse ('user_name', 'submissionform_membertop');
    }

    if ($CONF_FORUM['show_moods']) {
        $moodoptions = '';
        if ($mood != '' OR $submit == $LANG_GF01['PREVIEW']) {
            $edittopic['mood'] = $mood;
			$moodoptions = '<option value="">' . $LANG_GF01['NOMOOD'] . "</option>\n";
		} elseif (isset($edittopic['mood']) && $edittopic['mood'] != '') {
			$mood = $edittopic['mood'];
			$moodoptions = '<option value="">' . $LANG_GF01['NOMOOD'] . "</option>\n";
        } else {
            $edittopic['mood'] = '';
			$mood = '';
            $moodoptions = '<option value="" selected="selected">' . $LANG_GF01['NOMOOD'] . "</option>\n";
        }
        if ($dir = @opendir("{$CONF_FORUM['imgset_path']}/moods")) {
            while (($file = readdir($dir)) !== false) {
                if ((strlen($file) > 3) && substr(strtolower(trim($file)), -4, 4) == '.gif') {
                    $file = str_replace('.gif', '', $file);
                    if ($file == $edittopic['mood']) {
                        $moodoptions .= '<option value="' . $file . '" selected="selected">' . $file . "</option>\n";
                    } else {
                        $moodoptions .= '<option value="' . $file . '" style="height:40px; background-repeat: no-repeat; text-align:right; '
                                      . 'background-image:URL(\'' . $CONF_FORUM['layout_url'] . '/image_set/moods/' . $file . '.gif\')">' .$file. "</option>\n";
                    }
                } else {
                    $moodoptions .= '';
                }
            }
            closedir($dir);
        }
        $submissionform_main->set_var ('LANG_MOOD', $LANG_GF02['msg36']);
        $submissionform_main->set_var ('moodoptions', $moodoptions);
        $submissionform_main->parse ('moods', 'submissionform_moods');
    } else {
        $submissionform_main->set_var('moods', '');
    }
    
    // Only for Forum Admins and Moderators on editing the root parent forum topic or a new root parent forum topic post
    if (($method == 'newtopic' OR ($method == 'edit' AND $edittopic['pid'] == 0)) AND $editmoderator) {
        if ($submit != $LANG_GF01['PREVIEW']) {
            $topic_selection_control = TOPIC_getTopicSelectionControl(FORUM_PLUGIN_NAME, $id, false, false, true, false, 2, TOPIC_TYPE_FORUM_TOPIC);
        } else {
            // Since preview make sure grab topic selection from control
            $topic_selection_control = TOPIC_getTopicSelectionControl(FORUM_PLUGIN_NAME, '', false, false, true, false, 2, TOPIC_TYPE_FORUM_TOPIC);
        }
        // If empty then no edit access to any topics so don't show
        if (!empty($topic_selection_control)) {
            $submissionform_main->set_var('LANG_TOPIC', $LANG_ADMIN['topic']);
            $submissionform_main->set_var('LANG_GL_TOPICS_DESC', $LANG_GF02['gl_topics_desc']);

            // When $method = 'newtopic' then $id will = ''
            $submissionform_main->set_var('topic_selection', $topic_selection_control);
            $submissionform_main->parse ('gl_topics', 'submissionform_gl_topics');
        } else {
            $submissionform_main->set_var('gl_topics', '');            
        }
    } else {
        $submissionform_main->set_var('gl_topics', '');
    }

    $sub_dot = '...';
    $sub_none = '';
    $subject = str_replace($sub_dot, $sub_none, $subject);
    if ($method == 'newtopic') {
        $required = $LANG_GF01['REQUIRED'];
    } elseif ($method == 'postreply') {
        $required = $LANG_GF01['OPTIONAL'];
    } elseif ($method == 'edit') {
        if ($isParent) {
            $required = $LANG_GF01['REQUIRED'];
        } else {
            $required = $LANG_GF01['OPTIONAL'];
        }
    }

    // Now check if you need to show the HTML attribute editing buttons and BB code display field
    $chkpostmode = gf_chkpostmode($postmode,$mode_switch);
    if ($chkpostmode != $postmode) {
        $postmode = $chkpostmode;
        $mode_switch = 0;
    }

    $submissionform_main->set_var ('LANG_code', $LANG_GF01['CODE']);
    $submissionform_main->set_var ('LANG_fontcolor', $LANG_GF01['FONTCOLOR']);
    $submissionform_main->set_var ('LANG_fontsize', $LANG_GF01['FONTSIZE']);
    $submissionform_main->set_var ('LANG_closetags', $LANG_GF01['CLOSETAGS']);
    $submissionform_main->set_var ('LANG_codetip', $LANG_GF01['CODETIP']);
    $submissionform_main->set_var ('LANG_tiny', $LANG_GF01['TINY']);
    $submissionform_main->set_var ('LANG_small', $LANG_GF01['SMALL']);
    $submissionform_main->set_var ('LANG_normal', $LANG_GF01['NORMAL']);
    $submissionform_main->set_var ('LANG_large', $LANG_GF01['LARGE']);
    $submissionform_main->set_var ('LANG_huge', $LANG_GF01['HUGE']);

    $submissionform_main->set_var ('LANG_default', $LANG_GF01['DEFAULT']);
    $submissionform_main->set_var ('LANG_dkred', $LANG_GF01['DKRED']);
    $submissionform_main->set_var ('LANG_red', $LANG_GF01['RED']);
    $submissionform_main->set_var ('LANG_orange', $LANG_GF01['ORANGE']);
    $submissionform_main->set_var ('LANG_brown', $LANG_GF01['BROWN']);
    $submissionform_main->set_var ('LANG_yellow', $LANG_GF01['YELLOW']);
    $submissionform_main->set_var ('LANG_green', $LANG_GF01['GREEN']);
    $submissionform_main->set_var ('LANG_olive', $LANG_GF01['OLIVE']);
    $submissionform_main->set_var ('LANG_cyan', $LANG_GF01['CYAN']);
    $submissionform_main->set_var ('LANG_blue', $LANG_GF01['BLUE']);
    $submissionform_main->set_var ('LANG_dkblue', $LANG_GF01['DKBLUE']);
    $submissionform_main->set_var ('LANG_indigo', $LANG_GF01['INDIGO']);
    $submissionform_main->set_var ('LANG_violet', $LANG_GF01['VIOLET']);
    $submissionform_main->set_var ('LANG_white', $LANG_GF01['WHITE']);
    $submissionform_main->set_var ('LANG_black', $LANG_GF01['BLACK']);

    if ($CONF_FORUM['allow_img_bbcode']) {
        $submissionform_main->set_var ('hide_imgbutton_begin','');
        $submissionform_main->set_var ('hide_imgbutton_end','');
    } else {
        $submissionform_main->set_var ('hide_imgbutton_begin','<!--');
        $submissionform_main->set_var ('hide_imgbutton_end','-->');
    }

    $isFrenchEditor = isset($_CONF['language']) && strpos($_CONF['language'], 'french') === 0;
    $editorLabels = $isFrenchEditor
        ? array(
            'bold' => 'Gras',
            'italic' => 'Italique',
            'list' => 'Liste',
            'olist' => 'Liste numérotée',
            'quote' => 'Citation',
            'link' => 'Lien',
            'code' => 'Code'
        )
        : array(
            'bold' => 'Bold',
            'italic' => 'Italic',
            'list' => 'List',
            'olist' => 'Numbered list',
            'quote' => 'Quote',
            'link' => 'Link',
            'code' => 'Code'
        );

    foreach ($editorLabels as $editorLabelKey => $editorLabelValue) {
        $submissionform_main->set_var('LANG_EDITOR_' . strtoupper($editorLabelKey), $editorLabelValue);
    }

    $submissionform_main->set_var ('site_name', $_CONF['site_name']);
    $submissionform_main->parse ('modal_bbcode_help', 'submissionform_bbcode_help');
    
    $submissionform_main->parse ('code', 'submissionform_code');

    if (!$CONF_FORUM['allow_smilies']) {
        $smilies = '';
    } else {
        $smilies =  forumPLG_showsmilies();
    }

    // if this is the first time showing the new submission form - then check if notify option should be on
	if ($submit != $LANG_GF01['PREVIEW']) {
        if (!$isParent) {
            $notifyTopicid = $pid;
        } else {
            $notifyTopicid = $id;
        }

        // If not new topic then check if user has unsubscribed
        if ($notifyTopicid != '') {
            $sql  = "(SELECT id FROM {$_TABLES['forum_watch']} WHERE ((topic_id='$notifyTopicid' AND uid='$uid')) ) UNION ALL "
                  . "(SELECT id FROM {$_TABLES['forum_watch']} WHERE ((forum_id='{$forum}') AND (topic_id='0') AND (uid='$uid')) ) ";
            $notifyquery = DB_query($sql);

            if (DB_getItem($_TABLES['forum_userprefs'],'alwaysnotify', "uid='$uid'") == 1 OR DB_numRows($notifyquery) > 0) {
                $notify = 1;
                // check and see if user has un-subscribed to this topic
                $nid = -$notifyTopicid;
                if ($notifyTopicid > 0 AND DB_getItem($_TABLES['forum_watch'],'id', "forum_id='{$edittopic['forum']}' AND topic_id=$nid AND uid='$uid'") > 1) {
                    $notify = '';
                }
            } else {
                $notify = '';
            }
        } else {
            if (DB_getItem($_TABLES['forum_userprefs'],'alwaysnotify', "uid='$uid'") == 1) {
                $notify = 1;
            } else {
                $notify = '';
            }
        }
    }
	
    $locked_prompt = '';
    $sticky_prompt = '';
    $notify_prompt = '';
    if ($editmoderator) {
		// Only show notifications for new or edit of own posts
		if (($method == 'edit' AND $uid == $edittopic['uid']) OR ($method == 'postreply') OR ($method == 'newtopic')) {
			if ($notify == 1 || (isset($_POST['notify']) && $_POST['notify'] == 1)) {
				$notify_val = 'checked="checked"';
			} else {
				$notify_val = '';
			}
			// Notify Option
			$submissionform_main->set_var ('LANG_OPTION', $LANG_GF02['msg38']);
			$submissionform_main->set_var ('option_name', 'notify');
			$submissionform_main->set_var ('option_checked', $notify_val);
			$submissionform_main->set_var ('option_extra', '');
			$submissionform_main->parse ('option', 'submissionform_option', true);
			$options_exist = true;
		}

        // check that this is the parent topic - only able to make it sticky or locked
        if ($isParent) { // so topic either new topic or edit of parent topic
            if (!isset($locked_val) AND !isset($sticky_val)) {
				$locked_val = '';
				$sticky_val = '';
            	
                if ((!isset($_POST['locked_switch']) AND (isset($edittopic['locked']) AND $edittopic['locked'] == 1)) OR (isset($_POST['locked_switch']) && $_POST['locked_switch'] == 1 )) {
                    $locked_val = 'checked="checked"';
				}
                if ((!isset($_POST['sticky_switch']) AND (isset($edittopic['sticky']) AND $edittopic['sticky'] == 1)) OR (isset($_POST['sticky_switch']) && $_POST['sticky_switch'] == 1 )) {
                    $sticky_val = 'checked="checked"';
                }
			} elseif (!isset($locked_val) AND !isset($sticky_val)) {
				$locked_val = '';
				$sticky_val = '';				
			}

			// Locked Option
			$submissionform_main->set_var ('LANG_OPTION', $LANG_GF02['msg109']);
			$submissionform_main->set_var ('option_name', 'locked_switch');
			$submissionform_main->set_var ('option_checked', $locked_val);
			$submissionform_main->set_var ('option_extra', '');
			$submissionform_main->parse ('option', 'submissionform_option', true);
			// Sticky Option
			$submissionform_main->set_var ('LANG_OPTION', $LANG_GF02['msg61']);
			$submissionform_main->set_var ('option_name', 'sticky_switch');
			$submissionform_main->set_var ('option_checked', $sticky_val);
			$submissionform_main->set_var ('option_extra', '');
			$submissionform_main->parse ('option', 'submissionform_option', true);
			$options_exist = true;
        }
    } else {
        if ($uid > 1) {
            if ($notify == 1) {
                $notify_val = 'checked="checked"';
            } else {
                $notify_val = '';
            }
            // Notify Option
			$submissionform_main->set_var ('LANG_OPTION', $LANG_GF02['msg38']);
			$submissionform_main->set_var ('option_name', 'notify');
			$submissionform_main->set_var ('option_checked', $notify_val);
			$submissionform_main->set_var ('option_extra', '');
			$submissionform_main->parse ('option', 'submissionform_option', true);
			$options_exist = true;
        }
    }

    if ($postmode == 'html' || $postmode == 'HTML') {
        $postmode_msg = $LANG_GF01['TEXTMODE'];
    } else {
         $postmode_msg = $LANG_GF01['HTMLMODE'];
    }
    if ($CONF_FORUM['allow_html'] || forum_modPermission($forum, $uid, 'mod_edit')) {
        
		// Mode Option
		$submissionform_main->set_var ('LANG_OPTION', $postmode_msg);
		$submissionform_main->set_var ('option_name', 'postmode_switch');
		$submissionform_main->set_var ('option_checked', '');
		$postmode_extra = '<input type="hidden" name="postmode" value="' . $postmode . '"' . XHTML . '>';
		$submissionform_main->set_var ('option_extra', $postmode_extra);
		$submissionform_main->parse ('option', 'submissionform_option', true);
		$options_exist = true;
    }

    if ($method == 'edit') {
        if ($CONF_FORUM['pre2.5_mode']) {
            /* Reformat code blocks - version 2.3.3 and prior */
            $comment = str_replace( '<pre class="forumCode">', '[code]', $comment );
            $comment = str_replace( '<pre>', '[code]', $comment );
            $comment = str_replace( '</pre>', '[/code]', $comment );
        }
	
        if ((isset($silentedit) && $silentedit) OR (!isset($silentedit) AND $CONF_FORUM['silent_edit_default'])) {
            $silent_val = 'checked="checked"';
        } else {
			$silent_val = '';
		}

		// Edit Option
		$submissionform_main->set_var ('LANG_OPTION', COM_getTooltip($LANG_GF02['msg190'], $LANG_GF02['msg190b']));
		$submissionform_main->set_var ('option_name', 'silentedit');
		$submissionform_main->set_var ('option_checked', $silent_val);
		$submissionform_main->set_var ('option_extra', '');
		$submissionform_main->parse ('option', 'submissionform_option', true); 
		$options_exist = true;
    }

    $subject = str_replace('"', '&quot;',$subject);

    $submissionform_main->set_unknowns('keep');
    $submissionform_main->set_var ('LANG_SUBJECT', $LANG_GF01['SUBJECT']);
    if ($options_exist) {
    	$submissionform_main->set_var ('LANG_OPTIONS', $LANG_GF01['OPTIONS']);
    	$submissionform_main->parse ('options', 'submissionform_options');
	} else {
		$submissionform_main->set_var ('options', '');
	}
    $submissionform_main->set_var ('LANG_SUBMIT', $LANG_GF01['SUBMIT']);
    $submissionform_main->set_var ('LANG_PREVIEW', $LANG_GF01['PREVIEW']);
    $submissionform_main->set_var ('LANG_CANCEL', $LANG_GF01['CANCEL']);
    $submissionform_main->set_var ('required', $required);
    $submissionform_main->set_var ('subject', $subject);
    $submissionform_main->set_var ('smilies', $smilies);
    $mediagalleryPicker = '';
    if (in_array('mediagallery', $_PLUGINS, true) && function_exists('MG_getMediaPickerButton')) {
        $mediagalleryPicker = MG_getMediaPickerButton(array(
            'target' => 'textarea[name="forum_media_transport"]',
            'label'  => (isset($_CONF['language']) && strpos($_CONF['language'], 'french') === 0)
                ? 'Ajouter un média'
                : 'Add media',
            'class'  => 'uk-button forum-media-picker'
        ));
    }
    $submissionform_main->set_var('mediagallery_picker', $mediagalleryPicker);
    if (!empty($smilies)) {
		$submissionform_main->parse ('smilies', 'submissionform_smilies');
	}
    $submissionform_main->set_var ('hide_notify', ($uid == 1) ? 'none' : '');
    /*
    if ( function_exists('plugin_templatesetvars_captcha') ) {
        plugin_templatesetvars_captcha('forum', $submissionform_main);
    } else {
        if ( function_exists('plugin_templatesetvars_recaptcha') ) {
            plugin_templatesetvars_recaptcha('forum', $submissionform_main);
        } else {
            $submissionform_main->set_var ('captcha','');
        }
    }
    */
    PLG_templateSetVars('forum', $submissionform_main); // Instead of calling plugin_templatesetvars_captcha directly for captcha etc...

    if ($method == 'edit') {
        if ($CONF_FORUM['allow_smilies']) {
            if (function_exists('msg_restoreEmoticons') AND $CONF_FORUM['use_smilies_plugin']) {
                $comment = msg_restoreEmoticons($comment);
            } else {
                $comment = forum_xchsmilies($comment,true);
            }
        }
        $submissionform_main->set_var ('post_message', $comment);
    } else {
        $submissionform_main->set_var ('post_message', htmlspecialchars($comment,ENT_QUOTES, $CONF_FORUM['charset']));
    }
    
    $editorSource = $comment;
    if ($method == 'edit' && $submit != $LANG_GF01['PREVIEW']) {
        $editorSource = $edittopic['comment'];
    } elseif ($method != 'edit') {
        $editorSource = COM_stripslashes($comment);
    } else {
        $editorSource = htmlspecialchars_decode($comment, ENT_QUOTES);
    }

    $submissionform_main->set_var('editor_html', forum_editor_renderSource($editorSource, $postmode));
    $submissionform_main->set_var('editor_render_url', $_CONF['site_url'] . '/forum/editor-render.php');

    $submissionform_main->set_var ('postmode', $postmode);
    $submissionform_main->parse ('output', 'submissionform_main');
    $display .= $submissionform_main->finish($submissionform_main->get_var('output'));
    
    $topicfooter = COM_newTemplate(CTL_plugin_templatePath('forum'));
    $topicfooter->set_file (array (	'topicfooter'=>'submissionform_footer.thtml'));
    
    $topicfooter->set_block('topicfooter', 'topic_review');
    
    $topicfooter->set_var ('imgset', $CONF_FORUM['imgset']);
	$topicfooter->set_var ('layout_url', $CONF_FORUM['layout_url']);
    $topicfooter->set_var ('site_url', $_CONF['site_url']);
	
    // Topic Review
    if (($method != 'newtopic' && $method != 'edit') && ($method == 'postreply' || $submit == $LANG_GF01['PREVIEW'])) {
        if ($CONF_FORUM['show_topicreview']) {
			if ($quoteid > 0) {
				$gotoId = $quoteid;
			} else {
				// Find last post id in topic
				$sql = DB_query("SELECT MAX(id) FROM {$_TABLES['forum_topic']} WHERE pid=$id");
				list($gotoId) = DB_fetchArray($sql);
				if (empty($gotoId)) {
					// Must only be one post in topic
					$gotoId = $id;
				}
			}
			$topicfooter->set_var ('previewlastpostURL', forum_buildForumPostURL($gotoId, '&amp;onlytopic=1'));
        	$topicfooter->parse ('topic_review', 'topic_review');
        } else {
        	$topicfooter->set_var ('topic_review', '');
		}
	} else {
		$topicfooter->set_var ('topic_review', '');
    }
	
	$topicfooter->parse ('output', 'topicfooter');
    $display .= $topicfooter->finish ($topicfooter->get_var('output'));
}

$display = gf_createHTMLDocument($display, '', true);
COM_output($display);

/*
* Function is called to captcha on save. If error in captcha a formatted message will be returned
*/
function gf_passCaptchaCheck($captcha) 
{
	global $LANG_GF01, $LANG03;
	
	$display = '';
	
	if (function_exists('plugin_itemPreSave_captcha') || function_exists('plugin_itemPreSave_recaptcha')) {
		if (function_exists('plugin_itemPreSave_captcha')) {
			$msg = plugin_itemPreSave_captcha('forum', $captcha);
		} else {
			$msg = plugin_itemPreSave_recaptcha('forum');
		}
		if ($msg != '') {
			$display .= COM_showMessageText($msg, $LANG03[17]);
		}
	}
	
	return $display;
}

/*
* Function is called to check spam. If found will display error message to user and does not exit function
*/
function gf_postSpamCheck(&$display, $subject, $comment, $name) 
{
	global $_CONF, $CONF_FORUM;
	
	if ($CONF_FORUM['use_spamx_filter'] == 1) {
		// Check for SPAM
		$spamcheck = '<h1>' . $subject . '</h1><p>' . $comment . '</p>';
		$permanentlink = null; // Really difficult to determine, need to make sure viewed anonymously and what page on. There is no permantlink for the forum post as it could appear on different pages depending on settings
		$result = PLG_checkForSpam(
			$spamcheck, $_CONF['spamx'], $permanentlink, Geeklog\Akismet::COMMENT_TYPE_FORUM_POST,
			$name
		);                
		// Now check the result and redirect to index.php if spam action was taken
		if ($result > 0) {
			// then tell them to get lost ...
			$display .= COM_showMessage($result, 'spamx');
			$display = gf_createHTMLDocument($display);
			COM_output($display);
			exit;
		}
	}
}


/*
* Function is called to add and exempt topic notifications as needed
*/
function gf_setnotification($notify, $forum, $id, $uid) 
{
	global $_TABLES;
	
	if ($uid > 1) {
		$nid = -$id;  // Negative Topic ID Value for exemption

		$currentForumNotifyRecID = DB_getItem($_TABLES['forum_watch'],'id', "forum_id='$forum' AND topic_id=0 AND uid='$uid'");
		$currentTopicNotifyRecID = DB_getItem($_TABLES['forum_watch'],'id', "forum_id='$forum' AND topic_id=$id AND uid='$uid'");
		$currentTopicUnNotifyRecID = DB_getItem($_TABLES['forum_watch'],'id', "forum_id='$forum' AND topic_id=$nid AND uid='$uid'");
		// Only insert topic notification if not already subscribed to forum or parent topic
		if ($notify == 1 AND $currentForumNotifyRecID < 1 AND $currentTopicNotifyRecID < 1) {
			$sql = "INSERT INTO {$_TABLES['forum_watch']} (forum_id,topic_id,uid,date_added) ";
			$sql .= "VALUES ('$forum','$id','$uid',now() )";
			DB_query($sql);
		} elseif ($notify == 1 AND $currentTopicUnNotifyRecID > 1) { // Had un-subcribed to topic and now wants to subscribe
			DB_query("DELETE FROM {$_TABLES['forum_watch']} WHERE id=$currentTopicUnNotifyRecID");
		} elseif ($notify == '' AND $currentTopicNotifyRecID > 1) { // Subscribed to topic - but does not want to be notified anymore
			DB_query("DELETE FROM {$_TABLES['forum_watch']} WHERE uid='$uid' AND forum_id='$forum' and topic_id = '$id'");
		} elseif ($notify == '' AND $currentForumNotifyRecID > 1) { // Subscribed to forum - but does not want to be notified about this topic
			DB_query("DELETE FROM {$_TABLES['forum_watch']} WHERE uid='$uid' AND forum_id='$forum' and topic_id = '$id'");
			DB_query("DELETE FROM {$_TABLES['forum_watch']} WHERE uid='$uid' AND forum_id='$forum' and topic_id = '$nid'");
			DB_query("INSERT INTO {$_TABLES['forum_watch']} (forum_id,topic_id,uid,date_added) VALUES ('$forum','$nid','$uid',now() )");
		}
	}
}

/*
* Function is called to check for notifications that may be setup by forum users
* A record in the forum_watch table is created for each user's subscribed notifications
* Users can subscribe to a complete forum or individual topics.
* If they have both selected - we only want to send one notification - hence the SQL LIMIT 1
*
* This function needs to be called when there is a new topic, new reply, or edit
*/
function gf_chknotifications($topicid, $userid, $editFlag = false, $siteNotificationOnly = false) 
{
    global $_TABLES,$LANG_GF01,$LANG_GF02,$_CONF,$CONF_FORUM, $LANG08, $LANG31;
	
	$result = DB_query("SELECT forum, pid FROM {$_TABLES['forum_topic']} WHERE id = $topicid");
	list($forumid, $pid) = DB_fetchArray($result);		
	$pid_flag = false;
    if ($pid == 0) {
		$pid_flag = true;
        $pid = $topicid;
    }
	
	$mailSubject = "{$_CONF['site_name']} {$LANG_GF02['msg22']}"; // - Forum Post Notification
	$postername = COM_getDisplayName($userid);
	
	// Notify Site Email if enabled in Configuration
    if (isset($_CONF['notification']) && in_array('forum', $_CONF['notification'])) {	
		$topicrec = DB_query("SELECT subject,name,forum FROM {$_TABLES['forum_topic']} WHERE id='$pid'");
		$A = DB_fetchArray($topicrec);
		// Create HTML and plaintext version of email
		$t = COM_newTemplate(CTL_plugin_templatePath('forum', 'emails'));
		
		$t->set_file(array('email_html' => 'post_notification-html.thtml'));
		$t->set_file(array('email_plaintext' => 'post_notification-plaintext.thtml'));

		$t->set_var('email_divider', $LANG31['email_divider']);
		$t->set_var('email_divider_html', $LANG31['email_divider_html']);
		$t->set_var('LB', LB);
		
		// ***************************************************************
		// This code logic is very similar to the user notifications below. If change here make sure it is reflected below
		if ($editFlag) {
			// Edit of existing post then
			$t->set_var('lang_topic_thread_msg', sprintf($LANG_GF02['edit_to_post_msg'], $A['subject'], $postername));
			$t->set_var('lang_topic_started_msg', sprintf($LANG_GF02['topic_started_msg'], $A['name'], $_CONF['site_name']));
			$t->set_var('lang_view_post_at_msg', $LANG_GF02['view_edit_at_msg']);
			$t->set_var('post_url', html_entity_decode(forum_buildForumPostURL($topicid)));			
		} else {
			// New Topic or New Reply
			if ($pid_flag) {
				// New Topic (first post in topic (a parent))
				$forum_name = DB_getItem($_TABLES['forum_forums'], "forum_name", "forum_id='$forumid'");
				
				$t->set_var('lang_topic_thread_msg', sprintf($LANG_GF02['new_topic_msg'], $A['subject'], $A['name'], $forum_name, $_CONF['site_name']));
				$t->set_var('lang_view_post_at_msg', $LANG_GF02['view_topic_at_msg']);
				$t->set_var('post_url', html_entity_decode(forum_buildForumPostURL($pid)));					
			} else {	
				// Reply then
				// Lets find the current last post in $topic
				$sql = DB_query("SELECT MAX(id) FROM {$_TABLES['forum_topic']} WHERE pid=$pid");
				list($lastrecid) = DB_fetchArray($sql);
				
				$t->set_var('lang_topic_thread_msg', sprintf($LANG_GF02['reply_to_thread_msg'], $A['subject'], $postername));
				$t->set_var('lang_topic_started_msg', sprintf($LANG_GF02['topic_started_msg'], $A['name'], $_CONF['site_name']));
				$t->set_var('lang_view_post_at_msg', $LANG_GF02['view_reply_at_msg']);
				$t->set_var('post_url', html_entity_decode(forum_buildForumPostURL($lastrecid)));
			}
		}
		// ***************************************************************
		
		// Output final content
		$message = [];
		$message[] = $t->parse('output', 'email_html');	
		$message[] = $t->parse('output', 'email_plaintext');	
		
		COM_mail($_CONF['site_mail'], $mailSubject, $message, '' , true);
	}

	if (!$siteNotificationOnly) {
		$sql = "SELECT * FROM {$_TABLES['forum_watch']} WHERE ((topic_id = $pid) OR ((forum_id = $forumid) AND (topic_id = 0) )) GROUP BY uid";
		$sqlresult = DB_query($sql);
		$nrows = DB_numRows($sqlresult);

		$site_language = unserialize(DB_getItem($_TABLES['conf_values'], 'value', "group_name='Core' AND name='language'")); // Retrieve original language of site
		$mail_language = $_CONF['language'];
		$last_mail_language = $mail_language;
		$plugin_path = $_CONF['path'] . 'plugins/forum/';

		for ($i =1; $i <= $nrows; $i++) {
			$N = DB_fetchArray($sqlresult);
			// Don't need to send a notification to the user that posted this message and users with NOTIFY disabled
			if ($N['uid'] > 1 AND $N['uid'] != $userid AND $CONF_FORUM['allow_notification'] == '1' ) {
				
				// if the topic_id is 0 for this record - user has subscribed to complete forum. Check if they have opted out of this forum topic.
				if (DB_count($_TABLES['forum_watch'],array('uid','forum_id','topic_id'),array($N['uid'],$forumid,-$topicid)) == 0) {
				   
					// Check if user does not want to receive multiple notifications for same topic and already has been notified
					$userNotifyOnceOption = DB_getItem($_TABLES['forum_userprefs'],'notify_once',"uid='{$N['uid']}'");
					
					// Retrieve the log record for this user if it exists then check if user has viewed this topic yet
					// The logtime value may be 0 which indicates the user has not yet viewed the topic
					$lsql = DB_query("SELECT time FROM {$_TABLES['forum_log']} WHERE uid='{$N['uid']}' AND forum='$forumid' AND topic='$topicid'");

					if (DB_numRows($lsql) == 1) {
						$nologRecord = false;
						list ($logtime) = DB_fetchArray($lsql);
					} else {
						$nologRecord = true;
						$logtime = 0;
					}

					if  ($userNotifyOnceOption == 0 OR ($userNotifyOnceOption == 1 AND ($nologRecord OR $logtime != 0)) ) {
						$topicrec = DB_query("SELECT subject,name,forum FROM {$_TABLES['forum_topic']} WHERE id='$pid'");
						$A = DB_fetchArray($topicrec);
						$userrec = DB_query("SELECT username,email,language,status FROM {$_TABLES['users']} WHERE uid='{$N['uid']}'");
						$B = DB_fetchArray($userrec);
						if ($B['status'] == USER_ACCOUNT_ACTIVE) {
							// Need to send email in user own language if set, else site default
							// Should not use current user language if does not match
							if (empty($B['language'])) {
								$mail_language = $site_language;
							} else {
								$mail_language = $B['language'];
							}
							
							if ($mail_language != $last_mail_language) {
								$langfile = $plugin_path . 'language/' . $mail_language . '.php';
								if (file_exists($langfile)) {
									require $langfile;
									$last_mail_language = $mail_language;
								} else {
									// Use site default language as backup
									$langfile = $plugin_path . 'language/' . $site_language . '.php';
									if (file_exists($langfile)) {
										require $langfile;
										$last_mail_language = $site_language;
									} else {
										require $plugin_path . 'language/english.php';
										$last_mail_language = 'english';
									}
								}
							}
							
							// Create HTML and plaintext version of email
							$t = COM_newTemplate(CTL_plugin_templatePath('forum', 'emails'));
							
							$t->set_file(array('email_html' => 'post_notification-html.thtml'));
							$t->set_file(array('email_plaintext' => 'post_notification-plaintext.thtml'));

							$t->set_var('email_divider', $LANG31['email_divider']);
							$t->set_var('email_divider_html', $LANG31['email_divider_html']);
							$t->set_var('LB', LB);
							
							$t->set_var('site_name', $_CONF['site_name']);
							$t->set_var('site_url', $_CONF['site_url']);
							$t->set_var('site_slogan', $_CONF['site_slogan']);		
									
							$t->set_var('lang_hello_msg', $LANG_GF01['HELLO']);
							$t->set_var('username', $B['username']);
							// ***************************************************************
							// This code logic is very similar to the site notification above. If change here make sure it is reflected above						
							if ($editFlag) {
								// Edit of existing post then
								$t->set_var('lang_topic_thread_msg', sprintf($LANG_GF02['edit_to_post_msg'], $A['subject'], $postername));
								$t->set_var('lang_topic_started_msg', sprintf($LANG_GF02['topic_started_msg'], $A['name'], $_CONF['site_name']));
								$t->set_var('lang_view_post_at_msg', $LANG_GF02['view_edit_at_msg']);
								$t->set_var('post_url', html_entity_decode(forum_buildForumPostURL($topicid)));
							} else {
								// New Topic or New Reply
								if ($pid_flag) {
									// New Topic (first post in topic (a parent))
									$forum_name = DB_getItem($_TABLES['forum_forums'], "forum_name", "forum_id='$forumid'");
									
									$t->set_var('lang_topic_thread_msg', sprintf($LANG_GF02['new_topic_msg'], $A['subject'], $A['name'], $forum_name, $_CONF['site_name']));
									$t->set_var('lang_view_post_at_msg', $LANG_GF02['view_topic_at_msg']);
									$t->set_var('post_url', html_entity_decode(forum_buildForumPostURL($pid)));
									$t->set_var('lang_stop_notify_msg', $LANG_GF02['stop_new_notify_msg']);
									$t->set_var('subscriptions_url', "{$_CONF['site_url']}/forum/notify.php");			
								} else {
									// Reply then
									// Lets find the current last post in $topic
									$sql = DB_query("SELECT MAX(id) FROM {$_TABLES['forum_topic']} WHERE pid=$pid");
									list($lastrecid) = DB_fetchArray($sql);
									
									$t->set_var('lang_topic_thread_msg', sprintf($LANG_GF02['reply_to_thread_msg'], $A['subject'], $postername));
									$t->set_var('lang_topic_started_msg', sprintf($LANG_GF02['topic_started_msg'], $A['name'], $_CONF['site_name']));
									$t->set_var('lang_view_post_at_msg', $LANG_GF02['view_reply_at_msg']);
									$t->set_var('post_url', html_entity_decode(forum_buildForumPostURL($lastrecid)));									
									$t->set_var('lang_stop_notify_msg', $LANG_GF02['stop_reply_notify_msg']);
									$t->set_var('subscriptions_url', "{$_CONF['site_url']}/forum/notify.php");	
								}
							}
							// ***************************************************************
							$t->set_var('lang_great_day_msg', $LANG_GF02['great_day_msg']);
							$t->set_var('lang_admin', $LANG_GF01['ADMIN']);
							
							// Output final content
							$message = [];
							$message[] = $t->parse('output', 'email_html');	
							$message[] = $t->parse('output', 'email_plaintext');								
							
							// Check and see if Site admin has enabled email notifications
							if ($CONF_FORUM['allow_notification']) {
								if ($nologRecord and $userNotifyOnceOption == 1 ) {
									DB_query("INSERT INTO {$_TABLES['forum_log']} (uid,forum,topic,time) VALUES ('{$N['uid']}', '$forumid', '$topicid','0') ");
								}
								if (($B['email'] != '')  AND COM_isEmail($B['email'])) {
									COM_mail($B['email'], $mailSubject, $message, '' , true);
								}
							}
						}
					}
				}
			}
		}
	}
}

?>
