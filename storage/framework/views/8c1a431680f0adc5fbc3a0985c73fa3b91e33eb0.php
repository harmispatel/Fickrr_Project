<!doctype html>

<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->

<?php echo $__env->make('user.common.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- ./end of meta -->

<!--dir="rtl"-->

<body dir="">
     
    <?php echo $__env->make('user.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('user.common.location', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php echo $__env->yieldContent('content'); ?>
	

	<?php echo $__env->make('user.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php echo $__env->make('user.common.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
</body>

</html>

<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/user/layout.blade.php ENDPATH**/ ?>