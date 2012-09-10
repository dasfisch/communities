<?php
    global $current_user;
    get_currentuserinfo();

    $buttons = array();

    $acts = array('upvote', 'downvote', 'follow');

    if(!isset($id) || empty($id)) {
        $id = $post_id;
    }

    if(isset($actions) && !empty($actions)) {
        foreach($actions as $action) {
            switch($action->action) {
                case 'upvote':
                    $acts['upvote']['action'] = $action;

                    break;
                case 'downvote':
                    $acts['downvote']['action'] = $action;

                    break;
                case 'follow':
                    $acts['follow']['text'] = 'follow';
                    $acts['follow']['myaction'] = '';

                    break;
                default:
                    break;
            }

            if(isset($action->user) && !is_string($action->user) && get_class($action->user) === 'UserAction') {
                if(is_user_logged_in()) {
                    if($current_user->id == $action->user->userId) {
                        switch($action->action) {
                            case 'upvote':
                                $acts['upvote']['myaction'] = ' active';

                                break;
                            case 'downvote':
                                $acts['downvote']['myaction'] = ' active';

                                break;
                            case 'follow':
                                $acts['follow']['text'] = 'following';
                                $acts['follow']['myaction'] = ' active';

                                break;
                            default:
                                break;
                        }
                    }
                }
            } elseif(isset($action->user) && $action->user->id != 0) {
                switch($action->action) {
                    case 'upvote':
                        $acts['upvote']['myaction'] = ' active';
                        $acts['upvote']['nli_reset'] = ',nli_reset:\'deactivate\'';

                        break;
                    case 'downvote':
                        $acts['downvote']['myaction'] = ' active';
                        $acts['downvote']['nli_reset'] = ',nli_reset:\'deactivate\'';

                        break;
                    case 'follow':
                        $acts['follow']['text'] = 'following';
                        $acts['follow']['myaction'] = ' active';

                        break;
                    default:
                        break;
                }
            }
        }
    }

    $downvoteTotal = isset($acts['downvote']['action']->total) ? $acts['downvote']['action']->total : 0;
    $upvoteTotal = isset($acts['upvote']['action']->total) ? $acts['upvote']['action']->total : 0;

    $myActionDownvote = isset($acts['downvote']['myaction']) ? $acts['downvote']['myaction'] : '';
    $myActionFollow = isset($acts['follow']['myaction']) ? $acts['follow']['myaction'] : '';
    $myActionFollowText = isset($acts['follow']['text']) ? 'following' : 'follow';
    $myActionUpvote = isset($acts['upvote']['myaction']) ? $acts['upvote']['myaction'] : '';

    $nliDownvote = isset($acts['downvote']['nli_reset']) ? $acts['downvote']['nli_reset'] : '';
    $nliUpvote = isset($acts['upvote']['nli_reset']) ? $acts['upvote']['nli_reset'] : '';
?>
    <form class="actions clearfix" id="comment-actions-<?php echo $id; ?>" method="post" action="">
        <?php
            foreach($options as $option) {
                switch($option) {
                    case 'share':
                        echo return_partial('parts/share', array("url" => $url));

                        break;
                    case 'reply':
                        if(! is_user_logged_in()) { ?>
                            <div class="reply link-emulator" shc:gizmo:options="{moodle: {width:480, target:ajaxdata.ajaxurl, type:'POST', data:{action: 'get_template_ajax', template: 'page-login'}}}" shc:gizmo="moodle">Reply</div>
                        <?php } else { ?>
                            <div class="reply link-emulator" >Reply</div>
                        <?php }

                        break;
                    case 'upvote':
                        ?>
                            <label class="metainfo" shc:gizmo="actions" for="upvote-comment-<?php echo $id; ?>">(<?php echo $upvoteTotal; ?>)</label>
                            <button shc:gizmo="actions" shc:gizmo:options="{actions:{post:{id:<?php echo $id; ?>,name:'upvote',sub_type:'<?php echo $sub_type; ?>',type:'<?php echo $type; ?>'<?php echo $nliUpvote; ?>}}}" type="button" name="upvote" value="helpful" title="Up vote this <?php echo $type; ?>" id="upvote-comment-<?php echo $id; ?>" class="upvote<?php echo $myActionUpvote; ?>">helpful</button>
                        <?php

                        break;
                    case 'downvote':
                        ?>
                            <label class="metainfo" for="downvote-comment-<?php echo $id; ?>">(<?php echo $downvoteTotal; ?>)</label>
                            <button shc:gizmo="actions" shc:gizmo:options="{actions:{post:{id:<?php echo $id; ?>,name:'downvote',sub_type:'<?php echo $sub_type; ?>',type:'<?php echo $type; ?>'<?php echo $nliDownvote; ?>}}}" type="button" name="downvote" value="down vote" title="Down vote this <?php echo $type; ?>" id="downvote-comment-<?php echo $id; ?>" class="downvote<?php echo $myActionDownvote; ?>">down vote</button>
                        <?php

                        break;
                    case 'flag': ?>
                                <button
                                        type="button"
                                        name="button1"
                                        value="flag"
                                        title="Flag this <?php echo $type; ?>"
                                        id="flag-comment-<?php echo $id; ?>"
                                        class="flag"
                                        shc:gizmo="tooltip"
                                        shc:gizmo:options="
                                            {
                                                tooltip: {
                                                    displayData: {
                                                        element: 'flagForm-<?php echo $id; ?>',
                                                        callBack: {
                                                            submit: {
                                                                active: true,
                                                                name: 'submit',
                                                                method:
                                                                    function(event) {
                                                                        var sendData = jQuery(event.target).children().serialize();

                                                                        jQuery.post(
                                                                            ajaxurl + '?action=flag_me',
                                                                            sendData,
                                                                            function() {
                                                                                jQuery('.tooltip').fadeOut();
                                                                            }
                                                                        );

                                                                        event.preventDefault();
                                                                    }
                                                            }
                                                        }
                                                    }, arrowPosition: 'top'
                                                }
                                            }">flag</button>
                        <?php

                        break;
                    case 'follow':
                        if(! is_user_logged_in()) { ?>
                            <button type="button" name="button1" value="follow" title="Follow this <?php echo $type; ?>" id="follow-question-<?php echo $id; ?>" class="follow"
                                            shc:gizmo:options="{moodle:{width:480,target:ajaxdata.ajaxurl,type:'POST',data:{action:'get_template_ajax',template:'page-login'}}}"
                                            shc:gizmo="moodle">
                                            <?php echo $myActionFollowText; ?></button>
                        <?php } else { ?>
                            <button type="button" name="button1" value="follow" title="Follow this <?php echo $type; ?>" id="follow-question-<?php echo $id; ?>" class="follow<?php echo $myActionFollow; ?>"
                                            shc:gizmo:options="{actions:{post:{id:<?php echo $id; ?>,name:'follow',sub_type:'<?php echo $sub_type; ?>',type:'<?php echo $type; ?>'}}}"
                                            shc:gizmo="actions">
                                            <?php echo $myActionFollowText; ?></button>
                        <?php }

                        break;

                }
            }
        ?>
    </form>
    <div id="flagForm-<?php echo $id; ?>" class="hide">
        <form class="flag-form" id="commentForm-<?php echo $id; ?>" method="post" shc:gizmo="transFormer">
            <textarea class="flagField" rows="5" cols="16" name="comment" aria-required="true" shc:gizmo:form="{required: true}"></textarea>
            <input class="kmart_button" type="submit" value="Flag" />
            <input class="kmart_button azure" type="reset" value="Cancel" reset="reset" onclick="jQuery('.tooltip').hide();" />
            <input name="comment_post_ID" id="comment_post_ID" type="hidden" value="<?php echo $post_id; ?>" />
            <input name="comment_parent" id="comment_parent" type="hidden" value="<?php echo $id; ?>" />
            <input name="comment_type" id="comment_type" type="hidden" value="flag">
        </form>
    </div>