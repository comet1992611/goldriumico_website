<div class="page-container">
            <!-- BEGIN SIDEBAR -->
@include('admin.layouts.sidebar')
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
@include('admin.layouts.message')
@include('admin.layouts.error')
<!-- BEGIN PAGE HEADER-->
 @yield('content')
                    
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           
            <!-- END QUICK SIDEBAR -->
        </div>