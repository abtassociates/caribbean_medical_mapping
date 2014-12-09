<ul class="nav nav-list">
  <li>
    <a href="/">
      <i class="icon-list"></i>
      <span class="menu-text"> {{ ucfirst ( str_plural($instance->facility_term) ) }} </span>
    </a>
  </li>

  <li>
    <a href="/reports">
      <i class="icon-dashboard"></i>
      <span class="menu-text"> Reports </span>
    </a>
  </li>

  @if(Auth::check())

    @if(Auth::user()->can('alter_users'))
    <li>
      <a href="/users">
        <i class="icon-group"></i>
        <span class="menu-text"> Users </span>
      </a>
    </li>
    @endif

    @if(Auth::user()->can('alter_users'))
    <li>
      <a href="/settings">
        <i class="icon-cog"></i> 
        <span class="menu-text"> Settings </span>
      </a>
    </li>
    @endif

    <li>
      <a href="/account">
        <i class="icon-user"></i>
        <span class="menu-text"> Account </span>
      </a>
    </li>

    <li>
      <a href="/logout">
        <i class="icon-signout"></i>
       <span class="menu-text"> Logout </span> 
      </a>
    </li>

  @else

  <li>
    <a href="/login">
      <i class="icon-signout"></i>
      <span class="menu-text"> Login </span>  
    </a>
  </li>

  @endif

</ul><!-- /.nav-list -->