                <div class="list-group">
                    <a href="{{route('home')}}" class="list-group-item">
                        <span class="fa fa-fw fa-home"></span> Dashboard</a>
                    <a href="{{route('yonetim.admin.product')}}" class="list-group-item">
                        <span class="fa fa-fw fa-product-hunt"></span> Products
                        <span class="badge badge-dark badge-pill pull-right">14</span>
                    </a>
                    <a href="{{route('yonetim.admin.categoriler')}}" class="list-group-item">
                        <span class="fa fa-fw fa-dashboard"></span> Categories
                        <span class="badge badge-dark badge-pill pull-right">14</span>
                    </a>
                    <a href="#" class="list-group-item collapsed" data-target="#submenu1" data-toggle="collapse" data-parent="#sidebar"><span class="fa fa-fw fa-list"></span> Categories<span class="caret arrow"></span></a>
				  <div class="list-group collapse" id="submenu1">
					<a href="#" class="list-group-item">Category</a>
					<a href="#" class="list-group-item">Category</a>
				  </div>
                    <a href="{{route('yonetim.admin.user')}}" class="list-group-item">
                        <span class="fa fa-fw fa-users"></span> Users
                        <span class="badge badge-dark badge-pill pull-right">14</span>
                    </a>
                    <a href="{{route('yonetim.admin.siparis')}}" class="list-group-item">
                        <span class="fa fa-fw fa-cart-plus"></span> Orders
                        <span class="badge badge-dark badge-pill pull-right">14</span>
                    </a>
                </div>