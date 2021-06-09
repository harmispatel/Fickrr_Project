<!doctype html>

<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->

@include('user.common.meta')

<!-- ./end of meta -->

<!--dir="rtl"-->

<body dir="">
     
    @include('user.common.header')

    @include('user.common.location')

	@yield('content')
	

	@include('user.common.footer')

	@include('user.common.scripts')
   
</body>

</html>

