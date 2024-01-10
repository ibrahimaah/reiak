<li class="nav-item">
    <a class="nav-link {{ request()->is('/') ? 'active' : 'text-secondary'}}" href="/">
    استطلاعات الرأي
    </a>
</li>
@auth
<li class="nav-item">
    <a class="nav-link {{ request()->is('vote/create') ? 'active' : 'text-secondary' }}" href="{{ route('vote.create') }}">
    اضافة موضوع
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('my-subjects') ? 'active' : 'text-secondary' }}" href="{{ route('vote.my_subjects') }}">
        مواضيعي
    </a>
</li>
@endauth
<li class="nav-item">
    <a class="nav-link text-secondary" href="#" >  دليلك </a>
</li>
<li class="nav-item">
    <a class="nav-link text-secondary" href="#">
    دعوة اصدقاء
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('about') ? 'active' : 'text-secondary' }}" href="{{route('platform.about')}}">
    من نحن
    </a>
</li>
<li class="nav-item">
    <a class="nav-link text-secondary" href="/#contact">
        تواصل معنا
    </a>
</li>