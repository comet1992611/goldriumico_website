<div class="page-sidebar-wrapper">

<div class="page-sidebar navbar-collapse collapse">
 
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
   
        <li class="sidebar-toggler-wrapper hide">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler"> </div>
            <!-- END SIDEBAR TOGGLER BUTTON -->
        </li>
    
        <li class="nav-item  @if(request()->path() == 'admin/home') active open @endif">
            <a href="{{url('admin/home')}}" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">Dashboard</span>
                <span class="selected"></span>
            </a>
        </li>
         <li class="nav-item
            @if(request()->path() == 'admin/manage/userlog') active open
                @elseif(request()->path() == 'admin/manage/users') active open
                @elseif(request()->path() == 'admin/banned/users') active open
                @elseif(request()->path() == 'admin/packages') active open
                @elseif(request()->path() == 'admin/broadcast') active open
                @elseif(request()->path() == 'admin/document') active open
            @endif">
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">User Management</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item @if(request()->path() == 'admin/manage/users') active open @endif">
                    <a href="{{route('withdraw.users')}}" class="nav-link ">
                        <i class="fa fa-users"></i>
                        <span class="title">Users</span>
                    </a>
                </li> 
                
                <li class="nav-item @if(request()->path() == 'admin/manage/userlog') active open @endif">
                    <a href="{{route('withdraw.userlog')}}" class="nav-link ">
                        <i class="fa fa-money"></i>
                        <span class="title">Users Transaction Log</span>
                    </a>
                </li>
                 <li class="nav-item @if(request()->path() == 'admin/broadcast') active open @endif">
                    <a href="{{route('broadcast')}}" class="nav-link ">
                        <i class="icon-envelope"></i>
                        <span class="title">Broadcast Email</span>
                    </a>
                </li> 
                <li class="nav-item @if(request()->path() == 'admin/document') active open @endif">
                    <a href="{{route('document.requests')}}" class="nav-link ">
                        <i class="icon-docs"></i>
                        <span class="title">Documents</span>
                    </a>
                </li> 
                <li class="nav-item @if(request()->path() == 'admin/banned/users') active open @endif">
                    <a href="{{route('new.users')}}" class="nav-link ">
                        <i class="fa fa-times"></i>
                        <span class="title">Banned Users</span>
                    </a>
                </li> 
               
            </ul>
        </li>

        <li class="nav-item
            @if(request()->path() == 'admin/withdraw/requests') active open
              @elseif(request()->path() == 'admin/withdraw/lists') active open
              @elseif(request()->path() == 'admin/withdraw/refunded') active open
              @elseif(request()->path() == 'admin/wmethod') active open
            @endif">
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-id-card-o"></i>
                <span class="title">Withdraw</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item @if(request()->path() == 'admin/withdraw/requests') active open @endif">
                    <a href="{{route('withdraw.requests')}}" class="nav-link ">
                        <i class="fa fa-money"></i>
                        <span class="title">Withdraw Requests</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'admin/withdraw/lists') active open @endif">
                    <a href="{{route('withdraw.lists')}}" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">Withdraw Log</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'admin/withdraw/refunded') active open @endif">
                    <a href="{{route('withdraw.refundlog')}}" class="nav-link ">
                        <i class="fa fa-share"></i>
                        <span class="title">Refund Log</span>
                    </a>
                </li>
            </ul>
        </li>

         

        <li class="nav-item
            @if(request()->path() == 'admin/gateway') active open
                @elseif(request()->path() == 'admin/deposits') active open             
                @elseif(request()->path() == 'admin/deposits/requests') active open                  
            @endif">
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-credit-card"></i>
                <span class="title">Deposit</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item @if(request()->path() == 'admin/gateway') active open @endif">
                    <a href="{{url('admin/gateway')}}" class="nav-link ">
                        <i class="fa fa-credit-card"></i>
                        <span class="title">Deposit Method</span>
                    </a>
                </li> 
                 <li class="nav-item @if(request()->path() == 'admin/deposits/requests') active open @endif">
                    <a href="{{route('deposits.requests')}}" class="nav-link ">
                        <i class="fa fa-indent"></i>
                        <span class="title">Deposit Requests</span>
                    </a>
                </li>    
                <li class="nav-item @if(request()->path() == 'admin/deposits') active open @endif">
                    <a href="{{route('deposits')}}" class="nav-link ">
                        <i class="fa fa-indent"></i>
                        <span class="title">Deposit List</span>
                    </a>
                </li>                   
            </ul>
        </li>
        <li class="nav-item 
            @if(request()->path() == 'admin/gsettings') active open
                @elseif(request()->path() == 'admin/gsettings/email') active open
                @elseif(request()->path() == 'admin/gsettings/sms') active open
            @endif">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-cogs"></i>
                <span class="title">Website Control</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item @if(request()->path() == 'admin/gsettings') active open @endif">
                    <a href="{{url('admin/gsettings')}}" class="nav-link ">
                        <i class="fa fa-cog"></i>
                        <span class="title">General Settings</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'admin/gsettings/email') active open @endif">
                    <a href="{{url('admin/gsettings/email')}}" class="nav-link ">
                        <i class="fa fa-envelope-o"></i>
                        <span class="title">Email Settings</span>
                    </a>
                </li>
                 <li class="nav-item @if(request()->path() == 'admin/gsettings/sms') active open @endif">
                    <a href="{{url('admin/gsettings/sms')}}" class="nav-link ">
                        <i class="fa fa-envelope-o"></i>
                        <span class="title">SMS Settings</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item
            @if(request()->path() == 'admin/menu') active open
               @elseif(request()->path() == 'admin/logo') active open
               @elseif(request()->path() == 'admin/slider') active open
               @elseif(request()->path() == 'admin/about') active open
               @elseif(request()->path() == 'admin/service') active open
               @elseif(request()->path() == 'admin/timeline') active open
               @elseif(request()->path() == 'admin/footer') active open
               @elseif(request()->path() == 'admin/social') active open
               @elseif(request()->path() == 'admin/contac') active open
            @endif">
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-desktop"></i>
                <span class="title"> Interface Control</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item @if(request()->path() == 'admin/logo') active open @endif">
                    <a href="{{route('logo')}}" class="nav-link ">
                        <i class="fa fa-picture-o"></i>
                        <span class="title">Logo and Icon</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'admin/slider') active open @endif">
                    <a href="{{route('slider')}}" class="nav-link ">
                        <i class="fa fa-picture-o"></i>
                        <span class="title">Banner / Slider</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'admin/about') active open @endif">
                    <a href="{{route('about')}}" class="nav-link ">
                        <i class="fa fa-picture-o"></i>
                        <span class="title">About Section</span>
                    </a>
                </li>
                 <li class="nav-item @if(request()->path() == 'admin/service') active open @endif">
                    <a href="{{route('service')}}" class="nav-link ">
                        <i class="fa fa-picture-o"></i>
                        <span class="title">Service Section</span>
                    </a>
                </li>
                
                <li class="nav-item @if(request()->path() == 'admin/timeline') active open @endif">
                    <a href="{{route('timeline')}}" class="nav-link ">
                        <i class="fa fa-tree"></i>
                        <span class="title">Timeline</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'admin/contac') active open @endif">
                    <a href="{{route('contac')}}" class="nav-link ">
                        <i class="fa fa-id-card"></i>
                        <span class="title">Contact Information</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'admin/footer') active open @endif">
                    <a href="{{route('footer')}}" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">Footer Content</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item
            @if(request()->path() == 'admin/charges') active open
                @elseif(request()->path() == 'admin/price') active open
               @elseif(request()->path() == 'admin/policy') active open
            @endif">
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-id-card-o"></i>
                <span class="title">Company Policy</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item @if(request()->path() == 'admin/charges') active open @endif">
                    <a href="{{url('admin/charges')}}" class="nav-link ">
                        <i class="fa fa-money"></i>
                        <span class="title">Charge / Commision</span>
                    </a>
                </li>
                 <li class="nav-item @if(request()->path() == 'admin/price') active open @endif">
                    <a href="{{url('admin/price')}}" class="nav-link ">
                        <i class="fa fa-money"></i>
                        <span class="title">Price</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'admin/policy') active open @endif">
                    <a href="{{url('admin/policy')}}" class="nav-link ">
                        <i class="icon-layers"></i>
                        <span class="title">Policy & Terms</span>
                    </a>
                </li>
                
            </ul>
        </li>



    </ul>

                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
    </div>
                <!-- END SIDEBAR -->
 </div>