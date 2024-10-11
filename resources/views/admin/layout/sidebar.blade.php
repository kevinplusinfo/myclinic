<aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('/assets/img/doctore.png')}}" alt="Kirit Pandav" class="img-circle elevation-4" alt="User Image" style="">
                <span class="brand-text font-weight-light" style="color:white;">Kirit Pandav</span>
            </div>
            <div class="info text-center">
                <a href="javascript:void(0);" class="d-block text-center">
				</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                    	<i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
            <div class="sidebar-search-results"><div class="list-group"><a href="#" class="list-group-item"><div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div><div class="search-path"></div></a></div></div>
        </div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				{{--
				<li class="nav-item menu-open">
					<a href="#" class="nav-link active">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="./index.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Dashboard v1</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="./index2.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Dashboard v2</p>
							</a>
						</li>
					</ul>
				</li>
				
				--}}
				<li class="nav-item">
					<a href="{{route('patients')}}" class="nav-link  peshant-link">
						<i class=" nav-icon fa-solid fa-user-injured"></i>
						<p>
							Patients
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{route('medicine')}}" class="nav-link  medicine-link" >
						<i class=" nav-icon fa-sharp-duotone fa-solid fa-capsules"></i>&nbsp;
						<p>
							Medicine
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{route('img')}}" class="nav-link  img-link" >
						<i class=" nav-icon fa-sharp-duotone fa-solid fa-capsules"></i>&nbsp;
						<p>
							Img
						</p>
					</a>
				</li>

				<!-- <li class="nav-item">
					<a href="" class="nav-link group-link">
					<i class="nav-icon fas fa-layer-group"></i>
						<p>
							Groups
						</p>
					</a>
				</li>
				<li class="nav-item category-menu">
					<a href="javascript:void(0);" class="nav-link">
						<i class="nav-icon fas fa-th"></i>
						<p>
							Categories
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="" class="nav-link category-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Category</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link sub-category-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Sub Category</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="" class="nav-link exams-link">
						<i class="nav-icon fas fa-graduation-cap"></i>
						<p>
							Exams
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="" class="nav-link coupon-link">
						<i class="nav-icon fas fa-percentage"></i>
						<p>
							Coupon
						</p>
					</a>
				</li>
			
				<li class="nav-item">
					<a href="" class="nav-link">
					<i class="nav-icon fas fa-sign-out-alt"></i>
						<p>
							Logout
						</p>
					</a>
				</li> -->
			</ul>
		</nav>
    </div>
</aside>