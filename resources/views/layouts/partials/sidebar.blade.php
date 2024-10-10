<x-sidebar :href="route('dashboard')" :logo="asset('storage/assets/img/logo.png')">
    @can('Dashboard')
        <x-sidebar-item name="Dashboard" alias="dashboard" :link="route('dashboard')" icon="fa-solid fa-house-chimney"></x-sidebar-item>
    @endcan
    @role('Participant')
        <x-sidebar-item name="Candidate" alias="listCandidate" :link="route('listCandidate')" icon="fa-solid fa-user-tie"></x-sidebar-item>
    @endrole
    @can('Setting')
        <x-sidebar-item name="Setting" alias="setting" :link="route('setting')" icon="fa-solid fa-gear"></x-sidebar-item>
    @endcan
    @can('Voting Session')
        <x-sidebar-item name="Voting Sessions" alias="votingSession" :link="route('votingSession')" icon="fa-solid fa-calendar-week"></x-sidebar-item>
    @endcan
    @can('Participant')
        <x-sidebar-item name="Participant" alias="participant" icon="fa-solid fa-users">
            <x-sidebar-sub-item name="Class" alias="class" :link="route('participant.class')"></x-sidebar-sub-item>
            <x-sidebar-sub-item name="User" alias="user" :link="route('participant.user')"></x-sidebar-sub-item>
            <x-sidebar-sub-item name="Activation" alias="activation" :link="route('participant.activation')"></x-sidebar-sub-item>
        </x-sidebar-item>
    @endcan
    @can('TPS')
        <x-sidebar-item name="TPS" alias="tps" :link="route('tps')" icon="fa-solid fa-person-booth"></x-sidebar-item>
    @endcan
    @can('Candidate')
        <x-sidebar-item name="Candidate" alias="candidate" :link="route('candidate')" icon="fa-solid fa-user-tie"></x-sidebar-item>
    @endcan
    @can('Registration')
        <x-sidebar-item name="Registration" alias="registration" :link="route('registration')" icon="fa-solid fa-clipboard-list"></x-sidebar-item>
    @endcan
    @can('DPT')
        <x-sidebar-item name="DPT" alias="dpt" :link="route('dpt')" icon="fa-solid fa-id-card"></x-sidebar-item>
    @endcan
    @can('Voting')
        <x-sidebar-item name="Voting" alias="voting" :link="route('voting')" icon="fa-solid fa-id-card"></x-sidebar-item>
    @endcan
</x-sidebar>
