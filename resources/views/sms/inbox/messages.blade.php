
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
                                <h5>{{$user ? $user->name : $number }}<br><br></h5>
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
                                            <h6><span>{{ date('d',strtotime($message->created_at)) == date('d') ? date('H:s A',strtotime($message->created_at)) :  $message->created_at }}</span>
                                           </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                    </div><div class="slimScrollBar" style="background: rgb(204, 204, 204); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 317.4px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                </div>
                <div class="chat-footer">
                    <form action="{{route('message.reply')}}" method="post">
                        <div class="replay-forms">
                            <input type="text" name="message" id="chat_msg" class="form-control chat_form" placeholder="Type your message here...">
                        </div>
                        <input type="hidden" name="client_id" value="{{$user ? $user->id : ''}}">
                        <input type="hidden" name="twillio_id" value="{{$twillio_id}}">
                        <div class="form-buttons">
                            <button class="btn send-btn replyBtn {{!$user ? 'disabled' : ''}}" type="submit">
                                <i class="bx bx-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
           