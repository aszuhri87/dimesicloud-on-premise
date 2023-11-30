<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="#" class="app-brand-link">
        <img src="../../assets/svg/icons/dimensi-blue.svg" alt="" height="100%" width="85%">
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li class="menu-item @if (Request::is('dashboard')) active @endif">
        <a href="/dashboard" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboard">Dashboard</div>
        </a>
      </li>
      <li class="menu-item @if (Request::is('virtual-machine')) active @endif">
        <a href="/virtual-machine" class="menu-link">
          <i class="menu-icon tf-icons ti ti-device-imac"></i>
          <div data-i18n="Virtual Machine">Virtual Machine</div>
        </a>
      </li>
      <li class="menu-item @if (Request::is('ceph')) active @endif">
        <a href="/monitoring-vm" class="menu-link">
          <i class="menu-icon tf-icons ti ti-device-imac"></i>
          <div data-i18n="CEPH">CEPH</div>
        </a>
      </li>
      <li class="menu-item @if (Request::is('management-alert')) active @endif">
        <a href="/monitoring-vm" class="menu-link">
          <i class="menu-icon tf-icons ti ti-device-imac"></i>
          <div data-i18n="Management Alert">Management Alert</div>
        </a>
      </li>
      <li class="menu-item @if (Request::is('object-storage')) active @endif">
        <a href="/monitoring-vm" class="menu-link">
          <i class="menu-icon tf-icons ti ti-device-imac"></i>
          <div data-i18n="Object Storage">Object Storage</div>
        </a>
      </li>
    </ul>
  </aside>
