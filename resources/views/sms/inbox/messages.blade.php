
                <div>
                    <div class="chat-header">
                        <div class="user-details">
                            <div class="d-lg-none">
                                <ul class="list-inline mt-2 me-2">
                                    <li class="list-inline-item">
                                        <a class="text-muted px-0 left_sides" href="#" data-chat="open">
                                            <i class="fas fa-arrow-left"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-1">
                                <h5>{{$user ? $user->name : $number }}</h5>
                            </div>
                        </div>
                        <div class="chat-options ">
                            <ul class="list-inline">
                                
                                <!-- <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Voice Call">
                                    <a href="javascript:void(0)" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#voice_call">
                                        <i class="bx bx-phone"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item dream_profile_menu">
                                    <a href="javascript:void(0)" class="btn btn-outline-light not-chat-user" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Contact Info">
                                        <i class="bx bx-info-circle"></i>
                                    </a>
                                </li> -->
                               
                            </ul>
                        </div>
                        
                        <!-- /Chat Search -->
                    </div>
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 596px;"><div class="chat-body chat-page-group slimscroll" style="overflow: hidden; width: 100%; height: 790px;">
                        <div class="messages">
                            @foreach ($messages as $message)

                                <div class="chats {{$twillio_no == $message->number ? 'chats-right' : '' }}">
                                    <div class="chat-content">
                                        <div class="message-content">
                                           {{ $message->message }}
                                        </div>
                                        <div class="chat-profile-name done">
                                            <h6><span>{{ date('d',strtotime($message->created_at)) == date('d') ? date('H:s A',strtotime($message->created_at)) :  $list->created_at }}</span>
                                           </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                    </div><div class="slimScrollBar" style="background: rgb(204, 204, 204); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 317.4px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                </div>
                <div class="chat-footer">
                    <form>
                        <div class="replay-forms">
                            <div class="chats forward-chat-msg reply-div d-none">
                                <div class="contact-close_call text-end">
                                    <a href="#" class="close-replay">
                                        <i class="bx bx-x"></i>
                                    </a>
                                </div>
                                <div class="chat-avatar">
                                    <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image">
                                </div>
                                <div class="chat-content">
                                    <div class="chat-profile-name">
                                        <h6>Mark Villiams<span>8:16 PM</span></h6>
                                        <div class="chat-action-btns ms-2">
                                            <div class="chat-action-col">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                </a>
                                                <div class="dropdown-menu chat-drop-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item message-info-left"><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                    <a href="#" class="dropdown-item reply-button"><span><i class="bx bx-share"></i></span>Reply</a>
                                                    <a href="#" class="dropdown-item"><span><i class="bx bx-smile"></i></span>React</a>
                                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                    <a href="#" class="dropdown-item"><span><i class="bx bx-star"></i></span>Star Message</a>
                                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-content reply-content">
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="form-control chat_form" placeholder="Type your message here...">
                        </div>
                        <div class="form-buttons">
                            <button class="btn send-btn" type="submit">
                                <i class="bx bx-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
           