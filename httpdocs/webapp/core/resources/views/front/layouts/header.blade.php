        <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <!-- begin container-fluid -->
            <div class="container-fluid">
                <!-- begin mobile sidebar expand / collapse button -->
                <div class="navbar-header">
                    <a href="{{url('admin/home')}}" class="navbar-brand">
                        <img class="img-responsive" src="{{ asset('assets/images/logo/logo.png') }}" style="max-width: 60%; ">
                    </a>
                    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <span class="btn btn-primary btn-md">1 BTC = ${{number_format(floatval($btcrate) , $gset->decimalPoint, '.', '')}}</span>
                    </li>
                    <li>
                        <span class="btn btn-primary btn-md" style="margin-left:5px; margin-right: 20px;">1 {{$gset->curCode}} = ${{number_format(floatval($crate) , $gset->decimalPoint, '.', '')}}</span>
                    </li>
                </ul>
                

            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end #header -->



