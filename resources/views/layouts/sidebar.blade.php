<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="#" class="app-brand-link">
        <img src="../../assets/svg/icons/dimensi-blue.svg" alt="" height="100%" width="85%">
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li class="menu-item @if (strpos(Request::url(), 'dashboard')) active @endif">
        <a href="/dashboard/index" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboard">Dashboard</div>
        </a>
      </li>
      <li class="menu-item @if (strpos(Request::url(), 'node')) active @endif">
        <a href="/node" class="menu-link">
          <i class="menu-icon tf-icons ti ti-server-2"></i>
          <div data-i18n="Node">Node</div>
        </a>
      </li>
      <li class="menu-item @if (strpos(Request::url(), 'virtual-machine')) active @endif">
        <a href="/virtual-machine" class="menu-link">
          <i class="menu-icon tf-icons ti ti-device-imac"></i>
          <div data-i18n="Virtual Machine">Virtual Machine</div>
        </a>
      </li>
      <li class="menu-item @if (strpos(Request::url(), 'ceph')) active @endif">
        <a href="/ceph" class="menu-link">
          <i class="menu-icon tf-icons ti ti-devices-2"></i>
          <div data-i18n="Ceph">Ceph</div>
        </a>
      </li>

      <!-- <li class="menu-item @if (strpos(Request::url(), 'object-storage')) active @endif">
        <a href="/object-storage" class="menu-link">
          <i class="menu-icon tf-icons ti ti-database"></i>
          <div data-i18n="Object Storage">Object Storage</div>
        </a>
      </li> -->
      <li class="menu-item @if (strpos(Request::url(), 'management-access')) active @endif">
        <a href="/management-access" class="menu-link">
          <i class="menu-icon tf-icons ti ti-user-cog"></i>
          <div data-i18n="Management Access">Management Access</div>
        </a>
      </li>
      <li class="menu-item @if (strpos(Request::url(), 'management-alert')) active @endif">
        <a href="/management-alert" class="menu-link">
          <i class="menu-icon tf-icons ti ti-bell-cog"></i>
          <div data-i18n="Management Alert">Management Alert</div>
        </a>
      </li>
    </ul>
  </aside>
