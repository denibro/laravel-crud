

		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">

                        <li><a href="/dashboard" class=""><i class="lnr lnr-home"></i><span>Dashboard &nbsp;:&nbsp;{{ auth()->user()->role }} &nbsp;--</span></a></li>
                        @if (auth()->user()->role == 'siswa')
                        <li><a href="/siswa/{{auth()->user()->id}}/profile" class=""><i class="lnr lnr-user"></i><span>Profile</span></a></li>
                        @endif
                        @if (auth()->user()->role == 'master')
                        <li><a href="/admins" class=""><i class="lnr lnr-user"></i> <span>Admin</span></a></li>
                        @endif
                        @if (auth()->user()->role == 'master' || auth()->user()->role == 'admin')
                        <li><a href="/guru" class=""><i class="lnr lnr-user"></i> <span>Guru</span></a></li>
                        @endif
                        @if (auth()->user()->role == 'master' || auth()->user()->role == 'admin')
                        <li><a href="/siswa" class=""><i class="lnr lnr-user"></i> <span>Siswa</span></a></li>
                        <li><a href="/mapel" class=""><i class="lnr lnr-pencil"></i> <span>Mapel</span></a></li>
                        <li><a href="/posts" class=""><i class="lnr lnr-pencil"></i> <span>Posting</span></a></li>
                        @endif




					</ul>
				</nav>
			</div>
		</div>
