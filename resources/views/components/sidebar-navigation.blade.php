@php
$user = auth()->user();
$isOfficial = $user && $user->isOfficial();
@endphp

<div class="sidebar-wrapper">
    <nav class="mt-2"> <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Initialization</li>

        <x-new-nav-link title="Dashboard" bi_icon="bi-speedometer" route="admin.dashboard" />


        <x-new-nav-link-dropdown title="Resident Management" bi_icon="bi bi-person-lines-fill" route="admin.residents*">
            <x-new-nav-link title="Residents" bi_icon="bi bi-person-gear" route="admin.residents.index" />
            @if ($isOfficial)

            <x-new-nav-link title="Add Resident" bi_icon="bi bi-person-fill-add" route="admin.residents.create" />
            @endif

        </x-new-nav-link-dropdown>


        <x-new-nav-link-dropdown title="Health Services" bi_icon="bi bi-hospital" route="admin.health-records*">
            <x-new-nav-link title="Health Records" bi_icon="bi bi-lungs-fill" route="admin.health-records.index" />
            @if ($isOfficial)

            <x-new-nav-link title="Add Record" bi_icon="bi bi-bandaid-fill" route="admin.health-records.create" />
            @endif

        </x-new-nav-link-dropdown>





        </ul> <!--end::Sidebar Menu-->
    </nav>
</div> <!--end::Sidebar Wrapper-->