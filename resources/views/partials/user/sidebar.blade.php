<div class="gtasb-wrapper">
    <div class="gtasb-container">
        <div class="gtasb-header">
            <h5 class="gtasb-heading">
                <i class="fas fa-user-circle me-2"></i> My Account
            </h5>
        </div>

        <div class="gtasb-content">
            <ul class="gtasb-itemlist">
                <li>
                    <a href="{{ route('user.profile') }}" 
                       class="gtasb-menuitem {{ request()->routeIs('user.profile') ? 'gtasb-active' : '' }}">
                        <i class="fas fa-user me-2"></i>
                        <span>Profile</span>
                        <i class="fas fa-chevron-right gtasb-arrow"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.orders') }}" 
                       class="gtasb-menuitem ">
                        <i class="fas fa-box me-2"></i>
                        <span>My Orders</span>
                        <i class="fas fa-chevron-right gtasb-arrow"></i>
                    </a>
                </li>

                <li>
                    <a href="" 
                       class="gtasb-menuitem ">
                        <i class="fas fa-heart me-2"></i>
                        <span>Wishlist</span>
                        <i class="fas fa-chevron-right gtasb-arrow"></i>
                    </a>
                </li>

                <li>
                    <a href="" 
                       class="gtasb-menuitem ">
                        <i class="fas fa-address-book me-2"></i>
                        <span>Addresses</span>
                        <i class="fas fa-chevron-right gtasb-arrow"></i>
                    </a>
                </li>

              
            </ul>

            <form method="POST" action="{{ route('logout') }}" class="gtasb-logoutform">
                @csrf
                <button type="submit" class="gtasb-logoutbtn">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>