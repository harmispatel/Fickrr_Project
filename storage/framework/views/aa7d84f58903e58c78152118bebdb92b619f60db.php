<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    <?php echo $__env->make('admin.stylesheet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
    
    <?php echo $__env->make('admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Right Panel -->
    <?php if(in_array('items',$avilable)): ?>
    <div id="right-panel" class="right-panel">

        
                       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(5442,$translate)); ?></h1>
                    </div>
                </div>
            </div>


            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        
                        <ol class="breadcrumb text-right">
                            
                            <a href="<?php echo e(url('/admin/upload-designer')); ?>" class="btn btn-success btn-sm dropbtn"><i class="fa fa-plus"></i> <?php echo e(trans('labels.Adddesigner')); ?></a>
                           
                            
                        </ol>
                    </div>
                </div>
            </div>
           
        </div>
        
         <?php if(session('success')): ?>
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
<?php endif; ?>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(Helper::translation(5442,$translate)); ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(2920,$translate)); ?></th>
                                           
                                            <th width="100"><?php echo e(Helper::translation(2938,$translate)); ?></th>
                                            <th width="100"><?php echo e(trans('labels.email')); ?></th>
                                            <th width="100"><?php echo e(trans('labels.shopsorrestaraunts')); ?></th>
                                           <!--  <th><?php echo e(Helper::translation(5466,$translate)); ?>?</th>
                                            <th><?php echo e(Helper::translation(5469,$translate)); ?>?</th>
                                            <th><?php echo e(Helper::translation(5472,$translate)); ?>?</th>
                                            <th><?php echo e(Helper::translation(3142,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2873,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2922,$translate)); ?></th> -->
                                             <th><?php echo e(Helper::translation(2922,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                    <?php $no = 1; ?>

                                   
                                    <?php $__currentLoopData = $designer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                    
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                           
                                            <td><a href="<?php echo e(url('/designers')); ?>" target="_blank" class="black-color"><?php echo e(substr($value->name,0,50)); ?></a></td>
                                             <td><?php echo e($value->email); ?></a></td>

                                             <td>
                                                 <?php $designshops=count($value->hasManyDesignershops) > 0 ? $value->hasManyDesignershops : array() ; ?>
                                    
                                                  

                                                <?php $__currentLoopData = $designshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1=>$value1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                
                                                <?php if(!empty(@$value1['shopitem_id'])): ?>
                                    
                                                <?php  $i=DB::table('items')->where('item_id',$value1['shopitem_id'])->first(); ?>
                                                <?php echo e(@$i->item_name); ?> ,

                                                <?php endif; ?>
                                              
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 
                                            </td>
                                            <td><a href="edit-designer/<?php echo e($value->id); ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; <?php echo e(Helper::translation(2923,$translate)); ?></a> 
                                                   <a href="designers/<?php echo e($value->id); ?>" class="btn btn-danger btn-sm" onClick="return confirm('<?php echo e(Helper::translation(5064,$translate)); ?>?');"><i class="fa fa-trash"></i>&nbsp;<?php echo e(Helper::translation(2924,$translate)); ?></a></td>
                                            </td>
                                            
                                            
                                       
                                        </tr>
                                        <?php $no++; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->


   <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>

</html>
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/designers.blade.php ENDPATH**/ ?>