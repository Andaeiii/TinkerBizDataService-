
@include('partials.headscripts')


<div id="sb-site"> 
    @include('partials.logo')   
    @include('sections.head_nav_left')
    @include('sections.head_nav_right')
</div>
@include('sections.sidebar')



    <div id="page-content-wrapper">
        <div id="page-content">
            
                <div class="container">
            
                   @yield('main_body')

                </div>

            

        </div>
    </div>


@include('partials.footscripts')