<!-- sidebar group -->
<div class="sidebar-group left-sidebar chat_sidebar">

<!-- Chats sidebar -->
<div id="chats" class="left-sidebar-wrap sidebar active slimscroll">

    <div class="slimscroll">

       <!-- Left Chat Title -->
       <div class="left-chat-title all-chats d-flex justify-content-between align-items-center">
            <div class="select-group-chat">
                <div class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown">
                        Settings
                    </a>
                </div>
            </div>
       </div>
       <!-- /Left Chat Title -->


        <div class="sidebar-body chat-body" id="chatsidebar">
            
            <!-- /Left Chat Title -->

            <ul class="user-list space-chat">
                <li class="user-list-item chat-user-list " >
                     <a href="#" class="seeMessages" data-target=".chat" data-url="{{route('setting.gateway.index')}}">
                            <div class="users-list-body">
                                <div>
                                    <h5><i class="fas fa-globe  text-primary"></i> Gateway</h5>
                                    <p class="text-muted">Setup SMS gateway</p>
                                </div>  
                        </div>
                    </a>
                    @if(CommonLib::get_gateway() == 2)
                     <a href="#" class="seeMessages" data-target=".chat" data-url="{{route('setting.country_code.index')}}">
                        <div class="users-list-body">
                            <div>
                                <h5><i class="fas fa-mobile-alt  text-primary"></i> Country Code</h5>
                                 <p class="text-muted">Manage mobile country code</p>
                            </div> 
                        </div>
                    </a>

                    <a href="#" class="seeMessages" data-target=".chat" data-url="{{route('setting.twillio.index')}}">
                        <div class="users-list-body">
                            <div>
                                <h5><i class="fas fa-phone  text-primary"></i> Twillio Number</h5>
                                <p class="text-muted">Manage twillio number </p>
                            </div> 
                        </div>
                    </a>
                    @endif
                    <a href="#" class="seeMessages" data-target=".chat" data-url="{{route('setting.users.index')}}">
                        <div class="users-list-body">
                            <div>
                                <h5><i class="fas fa-users  text-primary"></i> Users</h5>
                                <p class="text-muted">Manage all users</p>
                            </div> 
                        </div>
                    </a>

                    <a href="#" class="seeMessages" data-target=".chat" data-url="{{route('setting.logs.index')}}">
                        <div class="users-list-body">
                            <div> 
                                <h5><i class="fas fa-exclamation-triangle  text-primary"></i> Error Logs</h5>
                                <p class="text-muted">View sending logs</p>
                            </div> 
                        </div>
                    </a>

                    <a href="#" class="seeMessages" data-target=".chat" data-url="{{route('setting.bulklogs.index')}}">
                        <div class="users-list-body">
                            <div>
                                <h5><i class="fas fa-exclamation-triangle text-primary"></i> Bulk Error Logs</h5>
                                <p class="text-muted">View Bulk error sending logs</p>
                            </div> 
                        </div>
                    </a>

                </li>
            </ul>
           
        </div>

    </div>

</div>
<!-- / Chats sidebar -->
</div>
<!-- /Sidebar group -->