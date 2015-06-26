<div class="footer">
    <div class="copyright">
        <p class="pull-left sm-pull-reset">
            <span>Copyright <span class="copyright">©</span> <?=date("Y");?> </span>
            <span><?=$HUser->Aplicacao->Titulo;?></span>.
            <span>Todos os direitos reservados. </span>
        </p>
        <p class="pull-right sm-pull-reset">
            <span><a href="#" class="m-r-10">Suporte</a> | <a href="#" class="m-l-10 m-r-10">Termos de Uso</a> | <a href="#" class="m-l-10">Política de Privacidade</a></span>
        </p>
    </div>
</div>
</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<!-- BEGIN BUILDER -->
<div class="builder hidden-sm hidden-xs" id="builder">
    <a class="builder-toggle"><i class="icon-wrench"></i></a>
    <div class="inner">
        <div class="builder-container">
            <a href="#" class="btn btn-sm btn-default" id="reset-style">reset default style</a>
            <h4>Layout options</h4>
            <div class="layout-option">
                <span> Fixed Sidebar</span>
                <label class="switch pull-right">
                    <input data-layout="sidebar" id="switch-sidebar" type="checkbox" class="switch-input" checked>
                    <span class="switch-label" data-on="On" data-off="Off"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>
            <div class="layout-option">
                <span> Sidebar on Hover</span>
                <label class="switch pull-right">
                    <input data-layout="sidebar-hover" id="switch-sidebar-hover" type="checkbox" class="switch-input">
                    <span class="switch-label" data-on="On" data-off="Off"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>
            <div class="layout-option">
                <span> Submenu on Hover</span>
                <label class="switch pull-right">
                    <input data-layout="submenu-hover" id="switch-submenu-hover" type="checkbox" class="switch-input">
                    <span class="switch-label" data-on="On" data-off="Off"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>
            <div class="layout-option">
                <span>Fixed Topbar</span>
                <label class="switch pull-right">
                    <input data-layout="topbar" id="switch-topbar" type="checkbox" class="switch-input" checked>
                    <span class="switch-label" data-on="On" data-off="Off"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>
            <div class="layout-option">
                <span>Boxed Layout</span>
                <label class="switch pull-right">
                    <input data-layout="boxed" id="switch-boxed" type="checkbox" class="switch-input">
                    <span class="switch-label" data-on="On" data-off="Off"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>
            <h4 class="border-top">Color</h4>
            <div class="row">
                <div class="col-xs-12">
                    <div class="theme-color bg-dark" data-main="default" data-color="#2B2E33"></div>
                    <div class="theme-color background-primary" data-main="primary" data-color="#319DB5"></div>
                    <div class="theme-color bg-red" data-main="red" data-color="#C75757"></div>
                    <div class="theme-color bg-green" data-main="green" data-color="#1DA079"></div>
                    <div class="theme-color bg-orange" data-main="orange" data-color="#D28857"></div>
                    <div class="theme-color bg-purple" data-main="purple" data-color="#B179D7"></div>
                    <div class="theme-color bg-blue" data-main="blue" data-color="#4A89DC"></div>
                </div>
            </div>
            <h4 class="border-top">Theme</h4>
            <div class="row row-sm">
                <div class="col-xs-6">
                    <div class="theme clearfix sdtl" data-theme="sdtl">
                        <div class="header theme-left"></div>
                        <div class="header theme-right-light"></div>
                        <div class="theme-sidebar-dark"></div>
                        <div class="bg-light"></div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="theme clearfix sltd" data-theme="sltd">
                        <div class="header theme-left"></div>
                        <div class="header theme-right-dark"></div>
                        <div class="theme-sidebar-light"></div>
                        <div class="bg-light"></div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="theme clearfix sdtd" data-theme="sdtd">
                        <div class="header theme-left"></div>
                        <div class="header theme-right-dark"></div>
                        <div class="theme-sidebar-dark"></div>
                        <div class="bg-light"></div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="theme clearfix sltl" data-theme="sltl">
                        <div class="header theme-left"></div>
                        <div class="header theme-right-light"></div>
                        <div class="theme-sidebar-light"></div>
                        <div class="bg-light"></div>
                    </div>
                </div>
            </div>
            <h4 class="border-top">Background</h4>
            <div class="row">
                <div class="col-xs-12">
                    <div class="bg-color bg-clean" data-bg="clean" data-color="#F8F8F8"></div>
                    <div class="bg-color bg-lighter" data-bg="lighter" data-color="#EFEFEF"></div>
                    <div class="bg-color bg-light-default" data-bg="light-default" data-color="#E9E9E9"></div>
                    <div class="bg-color bg-light-blue" data-bg="light-blue" data-color="#E2EBEF"></div>
                    <div class="bg-color bg-light-purple" data-bg="light-purple" data-color="#E9ECF5"></div>
                    <div class="bg-color bg-light-dark" data-bg="light-dark" data-color="#DCE1E4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END BUILDER -->
</section>
<!-- BEGIN QUICKVIEW SIDEBAR -->
<div id="quickview-sidebar">
<div class="quickview-header">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#chat" data-toggle="tab">Chat</a></li>
        <li><a href="#notes" data-toggle="tab">Notes</a></li>
        <li><a href="#settings" data-toggle="tab" class="settings-tab">Settings</a></li>
    </ul>
</div>
<div class="quickview">
<div class="tab-content">
<div class="tab-pane fade active in" id="chat">
    <div class="chat-body current">
        <div class="chat-search">
            <form class="form-inverse" action="#" role="search">
                <div class="append-icon">
                    <input type="text" class="form-control" placeholder="Search contact...">
                    <i class="icon-magnifier"></i>
                </div>
            </form>
        </div>
        <div class="chat-groups">
            <div class="title">GROUP CHATS</div>
            <ul>
                <li><i class="turquoise"></i> Favorites</li>
                <li><i class="turquoise"></i> Office Work</li>
                <li><i class="turquoise"></i> Friends</li>
            </ul>
        </div>
        <div class="chat-list">
            <div class="title">FAVORITES</div>
            <ul>
                <li class="clearfix">
                    <div class="user-img">
                        <img src="../assets/global/images/avatars/avatar13.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                        <div class="user-name">Bobby Brown</div>
                        <div class="user-txt">On the road again...</div>
                    </div>
                    <div class="user-status">
                        <i class="online"></i>
                    </div>
                </li>
                <li class="clearfix">
                    <div class="user-img">
                        <img src="../assets/global/images/avatars/avatar5.png" alt="avatar" />
                        <div class="pull-right badge badge-danger">3</div>
                    </div>
                    <div class="user-details">
                        <div class="user-name">Alexa Johnson</div>
                        <div class="user-txt">Still at the beach</div>
                    </div>
                    <div class="user-status">
                        <i class="away"></i>
                    </div>
                </li>
                <li class="clearfix">
                    <div class="user-img">
                        <img src="../assets/global/images/avatars/avatar10.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                        <div class="user-name">Bobby Brown</div>
                        <div class="user-txt">On stage...</div>
                    </div>
                    <div class="user-status">
                        <i class="busy"></i>
                    </div>
                </li>
            </ul>
        </div>
        <div class="chat-list">
            <div class="title">FRIENDS</div>
            <ul>
                <li class="clearfix">
                    <div class="user-img">
                        <img src="../assets/global/images/avatars/avatar7.png" alt="avatar" />
                        <div class="pull-right badge badge-danger">3</div>
                    </div>
                    <div class="user-details">
                        <div class="user-name">James Miller</div>
                        <div class="user-txt">At work...</div>
                    </div>
                    <div class="user-status">
                        <i class="online"></i>
                    </div>
                </li>
                <li class="clearfix">
                    <div class="user-img">
                        <img src="../assets/global/images/avatars/avatar11.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                        <div class="user-name">Fred Smith</div>
                        <div class="user-txt">Waiting for tonight</div>
                    </div>
                    <div class="user-status">
                        <i class="offline"></i>
                    </div>
                </li>
                <li class="clearfix">
                    <div class="user-img">
                        <img src="../assets/global/images/avatars/avatar8.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                        <div class="user-name">Ben Addams</div>
                        <div class="user-txt">On my way to NYC</div>
                    </div>
                    <div class="user-status">
                        <i class="offline"></i>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="chat-conversation">
        <div class="conversation-header">
            <div class="user clearfix">
                <div class="chat-back">
                    <i class="icon-action-undo"></i>
                </div>
                <div class="user-details">
                    <div class="user-name">James Miller</div>
                    <div class="user-txt">On the road again...</div>
                </div>
            </div>
        </div>
        <div class="conversation-body">
            <ul>
                <li class="img">
                    <div class="chat-detail">
                        <span class="chat-date">today, 10:38pm</span>
                        <div class="conversation-img">
                            <img src="../assets/global/images/avatars/avatar4.png" alt="avatar 4"/>
                        </div>
                        <div class="chat-bubble">
                            <span>Hi you!</span>
                        </div>
                    </div>
                </li>
                <li class="img">
                    <div class="chat-detail">
                        <span class="chat-date">today, 10:45pm</span>
                        <div class="conversation-img">
                            <img src="../assets/global/images/avatars/avatar4.png" alt="avatar 4"/>
                        </div>
                        <div class="chat-bubble">
                            <span>Are you there?</span>
                        </div>
                    </div>
                </li>
                <li class="img">
                    <div class="chat-detail">
                        <span class="chat-date">today, 10:51pm</span>
                        <div class="conversation-img">
                            <img src="../assets/global/images/avatars/avatar4.png" alt="avatar 4"/>
                        </div>
                        <div class="chat-bubble">
                            <span>Send me a message when you come back.</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="conversation-message">
            <input type="text" placeholder="Your message..." class="form-control form-white send-message" />
            <div class="item-footer clearfix">
                <div class="footer-actions">
                    <i class="icon-rounded-marker"></i>
                    <i class="icon-rounded-camera"></i>
                    <i class="icon-rounded-paperclip-oblique"></i>
                    <i class="icon-rounded-alarm-clock"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="notes">
    <div class="list-notes current withScroll">
        <div class="notes ">
            <div class="row">
                <div class="col-md-12">
                    <div id="add-note">
                        <i class="fa fa-plus"></i>ADD A NEW NOTE
                    </div>
                </div>
            </div>
            <div id="notes-list">
                <div class="note-item media current fade in">
                    <button class="close">×</button>
                    <div>
                        <div>
                            <p class="note-name">Reset my account password</p>
                        </div>
                        <p class="note-desc hidden">Break security reasons.</p>
                        <p><small>Tuesday 6 May, 3:52 pm</small></p>
                    </div>
                </div>
                <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                        <div>
                            <p class="note-name">Call John</p>
                        </div>
                        <p class="note-desc hidden">He have my laptop!</p>
                        <p><small>Thursday 8 May, 2:28 pm</small></p>
                    </div>
                </div>
                <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                        <div>
                            <p class="note-name">Buy a car</p>
                        </div>
                        <p class="note-desc hidden">I'm done with the bus</p>
                        <p><small>Monday 12 May, 3:43 am</small></p>
                    </div>
                </div>
                <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                        <div>
                            <p class="note-name">Don't forget my notes</p>
                        </div>
                        <p class="note-desc hidden">I have to read them...</p>
                        <p><small>Wednesday 5 May, 6:15 pm</small></p>
                    </div>
                </div>
                <div class="note-item media current fade in">
                    <button class="close">×</button>
                    <div>
                        <div>
                            <p class="note-name">Reset my account password</p>
                        </div>
                        <p class="note-desc hidden">Break security reasons.</p>
                        <p><small>Tuesday 6 May, 3:52 pm</small></p>
                    </div>
                </div>
                <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                        <div>
                            <p class="note-name">Call John</p>
                        </div>
                        <p class="note-desc hidden">He have my laptop!</p>
                        <p><small>Thursday 8 May, 2:28 pm</small></p>
                    </div>
                </div>
                <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                        <div>
                            <p class="note-name">Buy a car</p>
                        </div>
                        <p class="note-desc hidden">I'm done with the bus</p>
                        <p><small>Monday 12 May, 3:43 am</small></p>
                    </div>
                </div>
                <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                        <div>
                            <p class="note-name">Don't forget my notes</p>
                        </div>
                        <p class="note-desc hidden">I have to read them...</p>
                        <p><small>Wednesday 5 May, 6:15 pm</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="detail-note note-hidden-sm">
        <div class="note-header clearfix">
            <div class="note-back">
                <i class="icon-action-undo"></i>
            </div>
            <div class="note-edit">Edit Note</div>
            <div class="note-subtitle">title on first line</div>
        </div>
        <div id="note-detail">
            <div class="note-write">
                <textarea class="form-control" placeholder="Type your note here"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="settings">
    <div class="settings">
        <div class="title">ACCOUNT SETTINGS</div>
        <div class="setting">
            <span> Show Personal Statut</span>
            <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
            <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
        </div>
        <div class="setting">
            <span> Show my Picture</span>
            <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
            <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
        </div>
        <div class="setting">
            <span> Show my Location</span>
            <label class="switch pull-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
            <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
        </div>
        <div class="title">CHAT</div>
        <div class="setting">
            <span> Show User Image</span>
            <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
        <div class="setting">
            <span> Show Fullname</span>
            <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
        <div class="setting">
            <span> Show Location</span>
            <label class="switch pull-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
        <div class="setting">
            <span> Show Unread Count</span>
            <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
        <div class="title">STATISTICS</div>
        <div class="settings-chart">
            <div class="clearfix">
                <div class="chart-title">Stat 1</div>
                <div class="chart-number">82%</div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-primary setting1" data-transitiongoal="82"></div>
            </div>
        </div>
        <div class="settings-chart">
            <div class="clearfix">
                <div class="chart-title">Stat 2</div>
                <div class="chart-number">43%</div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-primary setting2" data-transitiongoal="43"></div>
            </div>
        </div>
        <div class="m-t-30" style="width:100%">
            <canvas id="setting-chart" height="300"></canvas>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- END QUICKVIEW SIDEBAR -->
<!-- BEGIN PRELOADER -->
<div class="loader-overlay">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<!-- END PRELOADER -->
<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>

<!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
<script>
    $(document).ready(function(){
        $(".select2").select2();
    });
</script>
    <script>
        var url = "<?php echo URL; ?>";
    </script>

<?
echo "\n<!--JAVASCRIPT-->\n";
\Libs\Helper::LoadMedia("js", [
    "dist/js/builder.js",
    "dist/js/sidebar_hover.js",
    "dist/js/widgets/notes.js",
    "dist/js/quickview.js",
    "dist/js/pages/search.js",
    "dist/js/plugins.js",
    "dist/js/application.js",
    "dist/js/layout.js"
]);
?>
</body>
</html>
