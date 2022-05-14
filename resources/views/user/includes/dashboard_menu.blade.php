<style>
    .active_item{
        background-color: #ffb607;
    }
    .active_item a{
        color: #fff;
    }
    .dashboard .card,
    .dashboard .card .card-header,
    .dashboard .card ul.list-group li{
        border-color: #ffb607;
        border-radius: 0;
    }
    .dashboard .card .card-header{
        color: #fff;
    }
    .dashboard .card .card-header{
        background-color: #ffb607;
    }
</style>


<div class="card">
    <ul class="list-group list-group-flush">
        <li class="list-group-item {{ menu_active('userCourseList') ? 'active_item' : '' }}"><a href="{{ route('userCourseList') }}"><i class="fa fa-list-ul"></i> আমার কোর্স সমূহ</a></li>
        <li class="list-group-item {{ menu_active('shoppingHistory') ? 'active_item' : '' }}"><a href="{{ route('shoppingHistory') }}"><i class="fa fa-shopping-basket"></i> আমার কেনাকাটা</a></li>
        <li class="list-group-item {{ menu_active('accountSettings') ? 'active_item' : '' }}"><a href="{{ route('accountSettings') }}"><i class="fa fa-cog"></i> একাউন্ট সেটিংস</a></li>
        <li class="list-group-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> লগ আউট
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
