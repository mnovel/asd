<x-sidebar :href="url('')" :logo="asset('storage/template/dist/assets/img/AdminLTELogo.png')">
    <x-sidebar-item name="Dashboard" alias="dashboard" :link="url('report')" icon="fa-solid fa-house-chimney"></x-sidebar-item>

    <x-sidebar-item name="Participant" alias="participant" icon="fa-solid fa-users">
        <x-sidebar-sub-item name="Class" alias="class" :link="route('participant.class')"></x-sidebar-sub-item>
        <x-sidebar-sub-item name="User" alias="user" :link="route('participant.user')"></x-sidebar-sub-item>
        <x-sidebar-sub-item name="Activation" alias="activation" :link="url('participant.activation')"></x-sidebar-sub-item>
    </x-sidebar-item>

    <x-sidebar-item name="TPS" alias="tps" :link="url('tps')" icon="fa-solid fa-person-booth"></x-sidebar-item>

    <x-sidebar-item name="Candidate" alias="candidate" :link="url('candidate')" icon="fa-solid fa-user-tie"></x-sidebar-item>

    <x-sidebar-item name="Voting Sessions" alias="session" :link="url('session')" icon="fa-solid fa-calendar-week"></x-sidebar-item>

    <x-sidebar-item name="Precence" alias="precence" :link="url('precence')" icon="fa-solid fa-clipboard-list"></x-sidebar-item>
</x-sidebar>
