<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sideMenu" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Events</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="sideMenu">
                <div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sideMenu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Events</a>
                    <ul class="nav navbar-nav">
                        <li class="search">
                            <form id="search" action="search.php" method="post">
                                <input type="text" placeholder="Search">
                                <button type="submit"><i class="icon-search"></i>O</button>
                            </form>
                        </li>
                        <li class="main-nav"><a href="#">FAVORITES</a></li>
                        <li class="main-nav"><a href="#">Search</a></li>
                        <li class="main-nav"><a href="#">MY EVENTS</a></li>
                        <li class="main-nav last"><a href="#">CALENDAR</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
                <p class="copyright">Copyright 2016</p>
            </div><!-- /.navbar-collapse -->

            <div class="event-form">
                <input type="text" id="datepicker">
                <input id="city" type="text" />
                <!--<div class="range">
                    <input id="range" type="range" min="0" max="100" step="1" value="20">
                </div>-->
                <!--<button type="button" onclick="mapGo();">Request data</button>-->
                <!--<button type="button" onclick="resetDoc();">Reset data</button>-->
                <script>
                    $( function() {
                        $( "#datepicker" ).datepicker();
                    } );
                </script>
            </div>

            <div class="view-switcher">
                <span id="mapToggle" class="active" onclick="mapToggleFn();">M</span>
                <span id="listToggle" class="active" onclick="listToggleFn();">L</span>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.container-fluid -->
    </nav>
</header>