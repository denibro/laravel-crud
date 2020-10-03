

		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">

                        <li><a href="/dashboard" class=""><i class="lnr lnr-home"></i><span>Dashboard &nbsp;:&nbsp;{{ auth()->user()->role }} &nbsp;--</span></a></li>

                        @if (auth()->user()->role == 'master' || auth()->user()->role == 'admin')
                        <li><a href="/siswa" class=""><i class="lnr lnr-user"></i> <span>Siswa</span></a></li>
                        @endif

                        @if (auth()->user()->role == 'master')
                        <li><a href="/admins" class=""><i class="lnr lnr-user"></i> <span>Admin</span></a></li>
                        @endif


					</ul>
				</nav>
			</div>
		</div>
