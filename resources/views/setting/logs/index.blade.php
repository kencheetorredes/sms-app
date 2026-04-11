
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
                                <h5 class="pb-3 pt-2">Error Logs<br>
                                <small></h5>
                            </div>
                        </div>
                        
                    </div>
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 596px;">
                        <div class="chat-body chat-page-group slimscroll" style="overflow: hidden; width: 100%; height: 790px;">
                        <div class="messages">
                            <table class="table" id="list_table" data-ispopup="true" data-sort-name="date" data-sort-order="desc" data-explode="action" data-search="true"  data-target="{{route('setting.logs.show')}}" data-row="id" data-toolbar="#toolbar"
                                data-toggle="table" data-url="{{route('setting.logs.lists')}}"  data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200,500,1000]"  >
                                <thead  class="alert alert-light solid alert-square solid bordered">
                                    <tr>
                                        <th data-sortable="true" data-field="date">Date</th>
                                        <th data-field="client_name">Client</th>
                                        <th data-field="number">Number</th>
                                        <th data-field="mobile_">Twillio Number</th>
                                        
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="slimScrollBar" style="background: rgb(204, 204, 204); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 317.4px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                </div>
                
           