<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

        <!-- END NOTIFICATION DROPDOWN -->
        <!-- BEGIN INBOX DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

        <!-- END INBOX DROPDOWN -->
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-user">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <div class="dropdown-user-inner">
                    <span class="username username-hide-on-mobile"> {{ Auth::user()->dni }} </span>
                    <img alt="" src="{{ Auth::user()->mostrar_foto }}" /> </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
                <li>
                    <a href="{{url('/logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="icon-key"></i> Salir
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
    </ul>
</div>