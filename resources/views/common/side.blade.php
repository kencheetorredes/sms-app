<div class="sidebar-menu">
                <div class="logo-col">
                    <a href="/"><img style="width: 55px;" src="{{url('xassets/img/logo-new.png')}}" alt="Logo"></a>
                </div>
                <div class="menus-col">
                    <div class="chat-menus">
                        <ul>
                            <li>
                                <a href="{{route('message.index',CommonLib::currentTwillioNo())}}" class="chat-unread {{ Route::is('message.index') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Inbox">
                                    <i class="bx bxs-inbox"></i>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('message.compose')}}" class="chat-unread {{ Route::is('message.compose') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compose">
                                <i class='bx bxs-comment-edit'></i>
                                </a>
                            </li>
                            
                            <li>
                                <a  href="{{route('contacts.index')}}" class="chat-unread {{ Route::is('contacts.*') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Contact List">
                                    <i class='bx bxs-contact'></i>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('group.index')}}" class="chat-unread {{ Route::is('group.*') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Contact Groups">
                                 <i class='bx bxs-group'></i>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('sms_template.index')}}" class="chat-unread {{ Route::is('sms_template.*') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Template">
                                 <i class='bx bxs-file-doc'></i>
                                </a>
                            </li>
                            @if(CommonLib::getRole() == 0)
                            <li>
                                <a href="{{route('setting.country_code.index')}}" class="chat-unread {{ Route::is('setting.country_code.*') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Country Code">
                                 <i class='bx bxs-flag'></i>
                                </a>
                            </li>

                           

                            <li>
                                <a href="{{route('setting.twillio.index')}}" class="chat-unread {{ Route::is('setting.twillio.*') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Twillio Number">
                                 <i class='bx bxs-phone'></i>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('setting.users.index')}}" class="chat-unread {{ Route::is('setting.users.*') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Users">
                                 <i class='bx bxs-user'></i>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('setting.logs.index')}}" class="chat-unread {{ Route::is('setting.logs.*') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Error Logs">
                                <i class='bx bxs-error'></i>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('setting.bulklogs.index')}}" class="chat-unread {{ Route::is('setting.bulklogs.*') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Bulk Logs">
                                <i class='bx bx-paper-plane'></i>
                                </a>
                            </li>
                            @endif
                            <li>
                            <a href="{{route('otp.index',CommonLib::currentTwillioNo())}}" class="chat-unread {{ Route::is('otp.index') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Otp Inbox">
                                <i class='bx bxs-message'></i>

                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="bottom-menus">
                        <ul>
                            <li class="d-none">
                                <a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
                                    <i class="bx bx-moon"></i>
                                </a>
                                <a href="#" id="light-mode-toggle" class="dark-mode-toggle active">
                                    <i class="bx bx-sun"></i>
                                </a>
                            </li>
                            <li>
                                <div class="avatar avatar-online">
                                    <a href="#" class="chat-profile-icon" data-bs-toggle="dropdown">
                                        <img src="{{url('assets/img/avatar/avatar-2.jpg')}}" alt="">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{ route('auth.profile') }}" class="dropdown-item">Profile </a>
                                        <a href="{{ route('auth.logout') }}" class="dropdown-item">Logout </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>