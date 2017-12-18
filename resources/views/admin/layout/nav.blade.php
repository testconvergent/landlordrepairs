<!-- ========== Left Sidebar Start ========== -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">
		<!--- Divider -->
		<div id="sidebar-menu">
			<ul>
				<li>
					<a href="admin-dashboard" class="<?php if(Request::segment(1)=='admin-dashboard'){echo "active";}?>">
					<i class="fa fa-tachometer" aria-hidden="true"></i><span> Dashboard </span></a>
				</li>
				<li>
					<a href="admin-change-credential" class="<?php if(Request::segment(1)=='admin-change-credential'){echo "active";}?>">
					<i class="fa fa-wrench" aria-hidden="true"></i><span> Change Credential </span></a>
				</li>		
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect<?php if(Request::segment(1) == "admin-customers-list" ||Request::segment(1) == "admin-tradesmen-list" || Request::segment(1) == "admin-customer-details" || Request::segment(1) == "admin-tradesmen-status" || Request::segment(1) == "admin-tradesmen-details"){?>subdrop active<?php } ?>"></i><i class="md ion-person "></i>
					<span>User Management</span> <span class="pull-right"><i class="md md-add"></i></span></a>
					<ul class="list-unstyled">
	                 <li><a href="admin-customers-list" class="<?php if(Request::segment(1) == "admin-customers-list" || Request::segment(1) == "admin-customer-details"){?>active1<?php } ?>">Customers</a></li>
						<li><a href="admin-tradesmen-list" class="<?php if(Request::segment(1) == "admin-tradesmen-list" || Request::segment(1) == "admin-tradesmen-status" || Request::segment(1) == "admin-tradesmen-details"){?>active1<?php } ?>">Tradesmen</a></li>
					</ul>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect<?php if(Request::segment(1) == "admin-package-list" || Request::segment(1) == "admin-edit-package"){?>subdrop active<?php } ?>"></i><i class="fa fa-money" aria-hidden="true"></i>
					<span>Package Management</span> <span class="pull-right"><i class="md md-add"></i></span></a>
					<ul class="list-unstyled">
	                 <li><a href="admin-package-list" class="<?php if(Request::segment(1) == "admin-package-list" || Request::segment(1) == "admin-edit-package"){?>active1<?php } ?>">Package</a></li>
					</ul>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect<?php if(Request::segment(1) == "admin-category-list" || Request::segment(1) == "admin-add-category" || Request::segment(1) == "admin-edit-category"){?>subdrop active<?php } ?>"></i><i class="md ion-cube"></i>
					<span>Category</span> <span class="pull-right"><i class="md md-add"></i></span></a>
					<ul class="list-unstyled">
						<li><a href="admin-category-list" class="<?php if(Request::segment(1) == "admin-category-list" || Request::segment(1) == "admin-add-category" || Request::segment(1) == "admin-edit-category"){?>active1<?php } ?>">Category</a></li>
					</ul>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect<?php if(Request::segment(1) == "admin-posted-job-list"){?>subdrop active<?php } ?>"></i><i class="md ion-cube"></i>
					<span>Job Management</span> <span class="pull-right"><i class="md md-add"></i></span></a>
					<ul class="list-unstyled">
						<li><a href="admin-posted-job-list" class="<?php if(Request::segment(1) == "admin-posted-job-list"){?>active1<?php } ?>">Posted job</a></li>
					</ul>
				</li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- Left Sidebar End -->