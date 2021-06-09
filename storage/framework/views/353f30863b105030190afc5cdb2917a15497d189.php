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
                            <a href="<?php echo e(url('/admin/products-import-export')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o"></i> <?php echo e(Helper::translation(5457,$translate)); ?></a>&nbsp;
                               <?php $encrypted = $encrypter->encrypt('product'); ?>
                                <a href="<?php echo e(URL::to('/admin/upload-new-item')); ?>/<?php echo e($encrypted); ?>" class="btn btn-success btn-sm dropbtn"><i class="fa fa-plus"></i><?php echo e(trans('labels.addItem')); ?></a>
                            
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
                                          <!--   <th><?php echo e(Helper::translation(5463,$translate)); ?></th> -->
                                            <th width="100"><?php echo e(Helper::translation(2938,$translate)); ?></th>
                                            <th><?php echo e(trans('labels.stafffav')); ?>?</th>
                                            <th><?php echo e(trans('labels.isrvyexclusive')); ?>?</th>
                                          <!--   <th><?php echo e(Helper::translation(5472,$translate)); ?>?</th> -->
                                            <th><?php echo e(trans('labels.storename')); ?></th>
                                            <th><?php echo e(Helper::translation(2873,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2922,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>

                                       
                                         
                                             <td><?php echo e(substr($item->item_name,0,50)); ?></td>
                                            
                                            
                                            <td>

                                              
                                                    <?php if($item->item_stafffav == 'no'): ?>
                                                   <a href="newpItems/<?php echo e($item->item_stafffav); ?>/<?php echo e($item->item_token); ?>" style="font-size:12px; color:#0000FF; text-decoration:underline;"> 
                                                <?php echo e($item->item_stafffav); ?>

                                                   </a>
                                                       <input type="checkbox" name="item_stafffav" id="item_stafffav" value="<?php echo e($item->item_stafffav); ?>" /> 
                                                 <?php else: ?> 
                                                        <a href="newpItems/<?php echo e($item->item_stafffav); ?>/<?php echo e($item->item_token); ?>" style="font-size:12px; color:#0000FF; text-decoration:underline;"><?php echo e($item->item_stafffav); ?>

                                                        </a>
                                                          <input type="checkbox" name="item_stafffav" id="item_stafffav" value="<?php echo e($item->item_stafffav); ?>" checked="checked" /> 
                                                 <?php endif; ?> 
                                           
                                            </td>

                                            <td>

                                              
                                            <?php if($item->tiem_ravybeexc == 1): ?>
                                                   <a href="newpItemsr/<?php echo e($item->tiem_ravybeexc); ?>/<?php echo e($item->item_token); ?>" style="font-size:12px; color:#0000FF; text-decoration:underline;"> 
                                                   Yes
                                                   </a>
                                                    <input type="checkbox" name="tiem_ravybeexc" id="tiem_ravybeexc" value="<?php echo e($item->tiem_ravybeexc); ?>" checked="checked"/> 
                                            <?php else: ?> 
                                                    <a href="newpItemsr/<?php echo e($item->tiem_ravybeexc); ?>/<?php echo e($item->item_token); ?>" style="font-size:12px; color:#0000FF; text-decoration:underline;">    No
                                                        </a>
                                                        <input type="checkbox" name="tiem_ravybeexc" id="tiem_ravybeexc" value="<?php echo e($item->tiem_ravybeexc); ?>" /> 
                                           <?php endif; ?> 
                                           
                                            </td>
                                           
                                            <td>
                                                
                                                <?php 
                                                $userarray=array();
                                                $hasManysProducthotel= $item->hasManysProducthotel ? $item->hasManysProducthotel : array();


                                                if(count($hasManysProducthotel) > 0 || !empty($hasManysProducthotel)){
                                                    foreach($hasManysProducthotel as $key=>$value){

                                                        // 
                                                        $user_ids=DB::table('items')->where('item_id',$value->hotel_id)->select('user_id','item_name')->first();
                                                       // echo "<pre>dfgdfgdfgfdg";print_r($user_ids);exit;
                                                       // $user_id=DB::table('users')->where('id',$user_ids->user_id)->select('name')->first();
                                                        $userarray[]= !empty($user_ids) ? $user_ids->item_name : '';
                                                    }
                                                }
                                                ?>
                                               <?php if(count($userarray) > 0): ?> <?php echo e(implode(",",$userarray)); ?> <?php endif; ?>
                                            </td>
                                            <td><?php if($item->item_status == 1): ?> <span class="badge badge-success"><?php echo e(Helper::translation(5232,$translate)); ?></span> <?php elseif($item->item_status == 2): ?> <span class="badge badge-danger"><?php echo e(Helper::translation(5235,$translate)); ?></span> <?php else: ?> <span class="badge badge-warning"><?php echo e(Helper::translation(3092,$translate)); ?></span> <?php endif; ?></td>
                                            <td><a href="edit-newItems/<?php echo e($item->item_token); ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; <?php echo e(Helper::translation(2923,$translate)); ?></a> 
                                            <?php if($demo_mode == 'on'): ?> 
                                            <a href="demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;<?php echo e(Helper::translation(2924,$translate)); ?></a>
                                            <?php else: ?>
                                          <a href="newpItems/<?php echo e($item->item_token); ?>" class="btn btn-danger btn-sm" onClick="return confirm('<?php echo e(Helper::translation(5064,$translate)); ?>?');"><i class="fa fa-trash"></i>&nbsp;<?php echo e(Helper::translation(2924,$translate)); ?></a><?php endif; ?></td> 
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
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/product/shopitems.blade.php ENDPATH**/ ?>