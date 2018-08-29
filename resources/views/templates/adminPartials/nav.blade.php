<!-- top navigation -->
<div class="top_nav">
 <div class="nav_menu">
   <nav>
     <div class="nav toggle">
       <a id="menu_toggle"><i class="fa fa-bars"></i></a>
     </div>
     <ul class="nav navbar-nav navbar-right">
       <li class="">
               <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   <img src="/storage/{{Auth::user()->avatar}}" alt="" id="crop-avatar" >{{ Auth::user()->name }}
                   <span class=" fa fa-angle-down"></span>
               </a>
           <ul class="dropdown-menu dropdown-usermenu pull-right">
               <li><a href="{{ route('profilAdmin') }}"> Ubah Kata Sandi </a></li>
               <li><a onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"> {{ __('Keluar') }}</a></li>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
               </form>
           </ul>
       </li>
     </ul>
   </nav>
 </div>
</div>
<!-- /top navigation -->
