<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Home</span>
        </a>
      </li>
      @if(isset(Auth::user()->id))
      @if(Auth::user()->can("Add Role") || Auth::user()->can("Read Role") || Auth::user()->can("Edit Role") || Auth::user()->can("Delete Role"))
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-role" aria-expanded="false" aria-controls="ui-role">
          <i class="mdi mdi-account-convert menu-icon"></i>
          <span class="menu-title">Roles</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-role">
          <ul class="nav flex-column sub-menu">
            @if(Auth::user()->can("Add Role"))
            <li class="nav-item"> <a class="nav-link" href="{{route('role.create')}}">Add New Role</a></li>
            @endif
            @if(Auth::user()->can("Read Role") || Auth::user()->can("Edit Role") || Auth::user()->can("Delete Role"))
            <li class="nav-item"> <a class="nav-link" href="{{route('role.index')}}">Roles</a></li>
            @endif
          </ul>
        </div>
      </li>
      @endif
      @if(Auth::user()->can("Add Staff") || Auth::user()->can("Read Staff") || Auth::user()->can("Edit Staff") || Auth::user()->can("Delete Staff"))
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#staff" aria-expanded="false" aria-controls="staff">
          <i class="mdi mdi-account-multiple-outline menu-icon"></i>
          <span class="menu-title">Staffs</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="staff">
          <ul class="nav flex-column sub-menu">
              @if(Auth::user()->can("Add Staff") )
            <li class="nav-item"> <a class="nav-link" href="{{route('staff.create')}}">Add New Staff</a></li>
              @endif
            @if(Auth::user()->can("Read Staff") || Auth::user()->can("Edit Staff") || Auth::user()->can("Delete Staff"))
            <li class="nav-item"> <a class="nav-link" href="{{route('staff.index')}}">Staff list</a></li>
            @endif
          </ul>
        </div>
      </li>
      @endif
      @if(Auth::user()->can("Add Client") || Auth::user()->can("Read Client") || Auth::user()->can("Edit Client") || Auth::user()->can("Delete Client")) 
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-client" aria-expanded="false" aria-controls="ui-client">
          <i class="mdi mdi-account-multiple-outline menu-icon"></i>
          <span class="menu-title">Clients</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-client">
          <ul class="nav flex-column sub-menu">
            @if(Auth::user()->can("Add Client"))
            <li class="nav-item"> <a class="nav-link" href="{{route('client.create')}}">Add New Client</a></li>
            @endif
            @if(Auth::user()->can("Read Client") || Auth::user()->can("Edit Client") || Auth::user()->can("Delete Client"))
            <li class="nav-item"> <a class="nav-link" href="{{route('client.index')}}">Client list</a></li>
            @endif
          </ul>
        </div>
      </li>
      @endif
      
      @if(Auth::user()->can("Add Member") || Auth::user()->can("Read Member") || Auth::user()->can("Edit Member") || Auth::user()->can("Delete Member"))
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-member" aria-expanded="false" aria-controls="ui-member">
            <i class="mdi mdi-account-multiple-outline menu-icon"></i>
            <span class="menu-title">Members</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-member">
            <ul class="nav flex-column sub-menu">
              @if(Auth::user()->can("Add Member"))
              <li class="nav-item"> <a class="nav-link" href="{{route('member.create')}}">Add New Members</a></li>
              @endif
              @if(Auth::user()->can("Read Member") || Auth::user()->can("Edit Member") || Auth::user()->can("Delete Member"))
              <li class="nav-item"> <a class="nav-link" href="{{route('member.index')}}">Members list</a></li>
              @endif
            </ul>
          </div>
        </li>
      @endif
      <li class="nav-item">
          <a class="nav-link" href="{{route('guardians.index')}}">
            <i class="mdi mdi-account-multiple-outline menu-icon"></i>
            <span class="menu-title">Guardians</span>
          </a>
        </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-event" aria-expanded="false" aria-controls="ui-event">
            <i class="mdi mdi-calendar-outline menu-icon"></i>
            <span class="menu-title">Events</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-event">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{route('event.types')}}">Event Types</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{route('event.index')}}">Events</a></li>
            </ul>
          </div>
        </li>
      @if(Auth::user()->can("Add Institution") || Auth::user()->can("Read Institution") || Auth::user()->can("Edit Institution") || Auth::user()->can("Delete Institution"))
       <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-institution" aria-expanded="false" aria-controls="ui-institution">
          <i class="mdi mdi-domain menu-icon"></i>
          <span class="menu-title">Institutions</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-institution">
          <ul class="nav flex-column sub-menu">
            @if(Auth::user()->can("Add Institution"))
            <li class="nav-item"> <a class="nav-link" href="{{route('institution.create')}}">Add New Institution</a></li>
            @endif
            @if(Auth::user()->can("Read Institution") || Auth::user()->can("Edit Institution") || Auth::user()->can("Delete Institution"))
            <li class="nav-item"> <a class="nav-link" href="{{route('institution.index')}}">Institution list</a></li>
            @endif
          </ul>
        </div>
      </li>
      @endif
      @if(Auth::user()->can("Add Personalities") || Auth::user()->can("Read Personalities") || Auth::user()->can("Edit Personalities") || Auth::user()->can("Delete Personalities"))
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-personality" aria-expanded="false" aria-controls="ui-personality">
          <i class="mdi mdi-account-switch menu-icon"></i>
          <span class="menu-title">Personalities</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-personality">
          <ul class="nav flex-column sub-menu">
            @if(Auth::user()->can("Add Personalities"))
            <li class="nav-item"> <a class="nav-link" href="{{route('personality.create')}}">Add New Personality</a></li>
            @endif
            @if(Auth::user()->can("Read Personalities") || Auth::user()->can("Edit Personalities") || Auth::user()->can("Delete Personalities"))
            <li class="nav-item"> <a class="nav-link" href="{{route('personality.index')}}">Personalities</a></li>
            @endif
          </ul>
        </div>
      </li>
      @endif
      @if(Auth::user()->can("Add Setup Question") || Auth::user()->can("Read Setup Question") || Auth::user()->can("Edit Setup Question") || Auth::user()->can("Delete Setup Question") ||Auth::user()->can("Add Question") || Auth::user()->can("Read Question") || Auth::user()->can("Edit Question") || Auth::user()->can("Delete Question"))
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-question" aria-expanded="false" aria-controls="ui-question">
          <i class="mdi mdi-disqus-outline menu-icon"></i>
          <span class="menu-title">Question Setup</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-question">
          <ul class="nav flex-column sub-menu">
              @if(Auth::user()->can("Add Setup Question"))
                <li class="nav-item"> <a class="nav-link" href="{{route('question.setup')}}">Add New Question Setup</a></li>
              @endif
              @if( Auth::user()->can("Read Setup Question") || Auth::user()->can("Edit Setup Question") || Auth::user()->can("Delete Setup Question") ||Auth::user()->can("Add Question") || Auth::user()->can("Read Question") || Auth::user()->can("Edit Question") || Auth::user()->can("Delete Question"))
                <li class="nav-item"> <a class="nav-link" href="{{route('question.index')}}">Question Setup list</a></li>
              @endif
          </ul>
        </div>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-report" aria-expanded="false" aria-controls="ui-report">
          <i class=" mdi mdi-file-chart menu-icon"></i>
          <span class="menu-title">Report</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-report">
          <ul class="nav flex-column sub-menu">
              @if(Auth::user()->can("Add Setup Question"))
                <li class="nav-item"> <a class="nav-link" href="{{route('report.setup')}}">Generate Report</a></li>
              @endif
          </ul>
        </div>
      </li>
      @endif
    </ul>
  </nav>