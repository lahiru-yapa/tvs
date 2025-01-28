<div class="sb2-1">
    <!--== USER INFO ==-->
    <div class="sb2-12">
        <ul>
            <li><img src="images/placeholder.jpg" alt="">
            </li>
            <li>
                <h5>Sanjeewa Motors <span> Godakawela</span></h5>
            </li>
            <li></li>
        </ul>
    </div>
    <!--== LEFT MENU ==-->
    <div class="sb2-13">
        <ul class="collapsible" data-collapsible="accordion">
            <li><a  href="{{ route('dashboard') }}" class="menu-active"><i class="fa fa-bar-chart" aria-hidden="true"></i>
                    Dashboard</a>
            </li>
           

            @if(auth()->check() && auth()->user()->role === 'admin')
            <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i>
                    Users</a>
                <div class="collapsible-body left-sub-menu">
                    <ul>
                        <li><a href="{{ route('alluser') }}">All Users</a></li>
            </li>
            <li><a href="{{ route('adduser') }}">Add New user</a>
            </li>
        </ul>
    </div>
    </li>

    <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i> Shopes</a>
        <div class="collapsible-body left-sub-menu">
            <ul>
                <li><a href="{{ route('allshopes') }}">All Shopes</a></li>
    </li>
    <li><a href="{{ route('addshopes') }}">Add Shopes</a>
    </li>
    </ul>
</div>
</li>

<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-umbrella" aria-hidden="true"></i> Supllier
    </a>
    <div class="collapsible-body left-sub-menu">
        <ul>
            <li><a href="{{ route('allsuppliers') }}">All Supllier</a>
            </li>
            <li><a href="{{ route('addsuppliers') }}">Add New Supllier</a>
            </li>
        </ul>
    </div>
</li>
@endif
<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-h-square" aria-hidden="true"></i>
        Products</a>
    <div class="collapsible-body left-sub-menu">
        <ul>
            <li><a href="{{ route('allproduct') }}">All Products</a>
            </li>
            <li><a href="{{ route('addproduct') }}">Add Products</a>
            </li>
        </ul>
    </div>
</li>
<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-picture-o" aria-hidden="true"></i>
        Invoice</a>
    <div class="collapsible-body left-sub-menu">
        <ul>
            @if(auth()->check() && auth()->user()->role === 'admin')
            <li><a href="{{ route('invoice.index') }}">All Invoice</a></li>
            <li><a href="{{ route('addinvoice') }}">Add Invoice</a></li>
            @endif
            @if(auth()->check() && auth()->user()->role === 'ref')
            <li><a href="{{ route('refinvoice.index') }}">All Invoice</a></li>
            @endif
            @if(auth()->check() && auth()->user()->role === 'stock')
            <li><a href="{{ route('stockinvoice.index') }}">All Invoice</a></li>
            @endif
        </ul>

    </div>
</li>
<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-calendar-o" aria-hidden="true"></i>
        Events</a>
    <div class="collapsible-body left-sub-menu">
        <ul>
            <li><a href="event-all.html">All Events</a>
            </li>
            <li><a href="event-add.html">Add New Event</a>
            </li>
        </ul>
    </div>
</li>

<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-tags" aria-hidden="true"></i> Offers</a>
    <div class="collapsible-body left-sub-menu">
        <ul>
            <li><a href="offers.html">All Offers</a>
            </li>
            <li><a href="offers-add.html">Add New Offers</a>
            </li>
        </ul>
    </div>
</li>
<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-ticket" aria-hidden="true"></i>Suplliers</a>
    <div class="collapsible-body left-sub-menu">
        <ul>
            <li><a href="Main Where House---all.html">Main Where House</a>
            </li>
            <li><a href="package---all.html">Package</a>
            </li>
            <li><a href="sight-see---all.html">Sight Seeings</a>
            </li>
            <li><a href="event---all.html">Events</a>
            </li>
        </ul>
    </div>
</li>
<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-rss" aria-hidden="true"></i> Blog &
        Articals</a>
    <div class="collapsible-body left-sub-menu">
        <ul>
            <li><a href="blog-all.html">All Blogs</a>
            </li>
            <li><a href="blog-add.html">Add Blog</a>
            </li>
        </ul>
    </div>
</li>
<li><a href="social-media.html"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Social Media</a>
</li>
<li><a href="login.html" target="_blank"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
</li>
</ul>
</div>
</div>