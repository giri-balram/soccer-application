@section('menu')
    <li class="{{ \Request::route()->getName()==='allTeams' ? 'active' : '' }}"><a href="{{ route('allTeams') }}">Teams</a></li>
    <li class="{{\Request::route()->getName()==='allPlayers' ? 'active' : '' }}"><a href="{{ route('allPlayers') }}">Players</a></li>
@endsection