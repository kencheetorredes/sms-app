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
                        All<i class="bx bx-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="chat.html">+0930920932</a></li>
                        <li><a class="dropdown-item" href="archive-chat.html">+03949302</a></li>
                    </ul>
                </div>
            </div>
            <div class="add-section">
                <ul>
                    <li><a href="javascript:;" class="user-chat-search-btn"><i class="bx bx-search"></i></a></li>
                </ul>
                <!-- Chat Search -->
                <div class="user-chat-search">
                    <form>
                        <span class="form-control-feedback"><i class="bx bx-search" ></i></span>
                        <input type="text" name="chat-search" placeholder="Search" class="form-control">
                        <div class="user-close-btn-chat"><span class="material-icons">close</span></div>
                    </form>
                </div>
                <!-- /Chat Search -->
            </div>
       </div>
       <!-- /Left Chat Title -->


        <div class="sidebar-body chat-body" id="chatsidebar">
            
            <!-- /Left Chat Title -->

            <ul class="user-list space-chat">
                <li class="user-list-item chat-user-list onloadpage" data-url="{{route('message.lists')}}">
                    
                </li>
            </ul>
           
        </div>

    </div>

</div>
<!-- / Chats sidebar -->
</div>
<!-- /Sidebar group -->