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
                        <h1><?php echo e(trans('labels.shopsorrestaraunts')); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">

                        <?php // echo "<pre>";print_r($viewitem);exit;?>
                        
                       <!--  <ol class="breadcrumb text-right">
                            <a href="<?php echo e(url('/admin/products-import-export')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o"></i> <?php echo e(Helper::translation(5457,$translate)); ?></a>&nbsp;
                       
                               
                              <?php $encrypted = $encrypter->encrypt('hotel'); ?>
                            <a href="<?php echo e(URL::to('/admin/upload-item')); ?>/<?php echo e($encrypted); ?>" class="btn btn-success btn-sm dropbtn"> <i class="fa fa-plus"></i> <?php echo e(Helper::translation(5460,$translate)); ?></a>
                     
                            <button onClick="myFunction()" class="btn btn-success btn-sm dropbtn"> 

                            <div id="myDropdown" class="dropdown-content">
                                <?php $__currentLoopData = $viewitem['type']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item_type->item_type_name != 'product'): ?>
                                <?php $encrypted = $encrypter->encrypt($item_type->item_type_id); ?>
                                <a href="<?php echo e(URL::to('/admin/upload-item')); ?>/<?php echo e($encrypted); ?>"><?php echo e($item_type->item_type_name); ?></a>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                              </button> 
                            
                        </ol> -->

                           <ol class="breadcrumb text-right">
                            <a href="<?php echo e(url('/admin/items-import-export')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o"></i> <?php echo e(trans('labels.vendorstoreimport/export')); ?></a>&nbsp;
                            <button onClick="myFunction()" class="btn btn-success btn-sm dropbtn"><i class="fa fa-plus"></i> <?php echo e(Helper::translation(5460,$translate)); ?></button>
                            <div id="myDropdown" class="dropdown-content">
                                <?php $__currentLoopData = $viewitem['type']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $encrypted = $encrypter->encrypt($item_type->item_type_id); ?>
                                <a href="<?php echo e(URL::to('/admin/upload-item')); ?>/<?php echo e($encrypted); ?>"><?php echo e($item_type->item_type_name); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                            
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

                    <?php 
                   // echo "<pre>";print_r($itemData['item']);
                    ?>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(trans('labels.shopsorrestaraunts')); ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(2920,$translate)); ?></th>
                                            <th><?php echo e(trans('labels.image')); ?></th>
                                            <th width="100"><?php echo e(trans('labels.hotelname')); ?></th>
                                          <!--   <th><?php echo e(Helper::translation(5466,$translate)); ?>?</th>
                                            <th><?php echo e(Helper::translation(5469,$translate)); ?>?</th>
                                            <th><?php echo e(Helper::translation(5472,$translate)); ?>?</th> -->
                                            <th><?php echo e(Helper::translation(3142,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2873,$translate)); ?></th>
                                            <th><?php echo e(trans('labels.vendorstoretype')); ?></th>
                                            <th><?php echo e(trans('labels.location')); ?></th>
                                            <th><?php echo e(Helper::translation(2922,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php if($item->item_thumbnail != ''): ?> <img height="50" width="50" src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($item->item_thumbnail); ?>" alt="<?php echo e($item->item_name); ?>"/><?php else: ?> <img height="50" width="50" src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($item->item_name); ?>" />  <?php endif; ?></td>
                                            <td><a href="<?php echo e(url('/item')); ?>/<?php echo e($item->item_slug); ?>/<?php echo e($item->item_id); ?>" target="_blank" class="black-color"><?php echo e(substr($item->item_name,0,50)); ?></a></td>
                                            
                                         <td>

                                            <?php 

                                            $hasOneUser=$item->hasOneUser ? $item->hasOneUser :  array();
                                            $username='';

                                            if(!empty($hasOneUser)) {
                                                $username=$hasOneUser->username;
                                            }
                                            ?>
                                            <a href="<?php echo e(url('/user')); ?>/<?php echo e($username); ?>" target="_blank" class="black-color"><?php echo e($username); ?></a></td>
                                            <td><?php if($item->item_status == 1): ?> <span class="badge badge-success"><?php echo e(Helper::translation(2970,$translate)); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(Helper::translation(2971,$translate)); ?></span> <?php endif; ?></td>

                                            <td><?php echo e(@$item->item_type); ?></td>
                                            <td><?php echo e(@$item->address); ?></td>
                                          <!--   <td><?php if($item->item_flash_request == 1): ?> <?php if($item->item_flash == 0): ?> <span class="badge badge-danger"><?php echo e(Helper::translation(5475,$translate)); ?></span> <?php else: ?> <span class="badge badge-success"><?php echo e(Helper::translation(5232,$translate)); ?></span> <?php endif; ?> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                           
                                            <td><?php if($item->item_status == 1): ?> <span class="badge badge-success"><?php echo e(Helper::translation(5232,$translate)); ?></span> <?php elseif($item->item_status == 2): ?> <span class="badge badge-danger"><?php echo e(Helper::translation(5235,$translate)); ?></span> <?php else: ?> <span class="badge badge-warning"><?php echo e(Helper::translation(3092,$translate)); ?></span> <?php endif; ?></td> -->
                                            <td><a href="edit-item/<?php echo e($item->item_token); ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; <?php echo e(Helper::translation(2923,$translate)); ?></a> 
                                            <?php if($demo_mode == 'on'): ?> 
                                            <a href="demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;<?php echo e(Helper::translation(2924,$translate)); ?></a>
                                            <?php else: ?>
                                            <a href="items/<?php echo e($item->item_token); ?>" class="btn btn-danger btn-sm" onClick="return confirm('<?php echo e(Helper::translation(5064,$translate)); ?>?');"><i class="fa fa-trash"></i>&nbsp;<?php echo e(Helper::translation(2924,$translate)); ?></a><?php endif; ?>
                                             <a href="paymentsetting/<?php echo e($item->item_id); ?>" class="btn btn-warning btn-sm" >&nbsp;<?php echo e(trans('labels.paymentsetting')); ?></a>
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
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/items.blade.php ENDPATH**/ ?>