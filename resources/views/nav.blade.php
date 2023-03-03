<div class="navBar">
    <h3>Mockify</h3>
    <a href="/home">Home</a>
    <a href="/profile">Profile</a>
    <form  action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>