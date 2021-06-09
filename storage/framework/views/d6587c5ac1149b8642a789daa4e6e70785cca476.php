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
    <?php
    //use DB;
    ?>
    <!-- Right Panel -->
    <?php if(in_array('items', $avilable)): ?>
        <div id="right-panel" class="right-panel">


            <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


            <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1></h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">

                    </div>
                </div>
            </div>

            <div class="content mt-3">
                <form action="<?php echo e(route('admin.upload-new-item')); ?>" class="setting_form" id="item_form" method="post"
                    enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-md-8 col-lg-9">
                            <div class="upld-item">
                                <div class="item_title">
                                    <input type="text" name="item_name" size="30" value="" id="item_name"
                                        spellcheck="true" autocomplete="off" class=""
                                        placeholder="<?php echo e(trans('labels.itemname')); ?>">
                                </div>
                                <div class="item_parmalink">
                                    <div class="item-edit-slug-box"><strong>Permalink:</strong>
                                        <a href="#"> <?php echo e(URL::TO('/item/')); ?>/<span id="editable-post-name"></span>
                                            <input type="text" name="demo_url" id="demo_url" style="display:none;" value="">

                                        </a>

                                            <button type="button" class="item-edit-slug-btn" id="okbtn"
                                                aria-label="Edit permalink"
                                                onClick="$('#editable-post-name').show();$('#demo_url').hide();$(this).hide();$('#editable-post-name').html('');$('#editable-post-name').html($('#demo_url').val());$('#okbtn').hide(); $('#cacncelbtn').hide();$('#editbtn').show();"
                                                style="display:none;">Ok</button>

                                            <button type="button" class="item-edit-slug-btn" id="cacncelbtn"
                                                aria-label="Edit permalink"
                                                onClick="$('#editable-post-name').html($('#demo_url').val());$(this).hide();$('#demo_url').hide();$('#okbtn').hide();"
                                                style="display:none;">Cancel</button>

                                       

                                        ‎<button type="button" class="item-edit-slug-btn" aria-label="Edit permalink"
                                            id="editbtn"
                                            onClick="$('#demo_url').show();$('#okbtn').show();$('#cacncelbtn').show();$('#demo_url').val($('#item_name').val());$('#editable-post-name').html('');$(this).hide();">Edit</button>
                                        <!-- //demo_url -->
                                    </div>
                                </div>
                                <div class="upld-item-editor">
                                    <textarea name="item_desc" id="summary-ckeditor" rows="6" class="form-control"
                                        data-bvalidator="required"></textarea>
                                </div>
                                <div class="upld-item-detail">
                                    <div class="upld-item-detail-head">
                                        <h2 class="hndle ui-sortable-handle">Product data
                                            <span class="type_box hidden"> —
                                                <label for="product-type">
                                                    <select id="product-type" name="product-type">
                                                        <optgroup label="Product Type">
                                                            <option value="simple" selected="selected">Simple product
                                                            </option>
                                                            <option value="grouped">Grouped product</option>
                                                            <option value="external">External/Affiliate product</option>
                                                            <option value="variable">Variable product</option>
                                                        </optgroup>
                                                    </select>
                                                </label>



                                                <label for="_virtual" class="show_if_simple tips" style="">
                                                    Virtual:
                                                    <input type="checkbox" name="virtual" id="virtual" value="1">
                                                </label>
                                                <label for="_downloadable" class="show_if_simple tips" style="">
                                                    Downloadable:
                                                    <input type="checkbox" name="downloadable" id="downloadable"
                                                        value="1">


                                                </label>

                                                <!--  <label for="location" class="show_if_simple tips" style="">
                                            location:
                                               <input type="text" name="location" id="autocomplete" onFocus="geolocate()"  placeholder=" Location" data-parsley-required="true"  value="" >

                                        </label>
 -->
                                            <?php 

                                         //  echo "<pre>";print_r($manufacturer);
                                            ?>

                                                <label for="location">
                                                    Manufacture
                                                    <select name="manufacturer" id="manufacturer"
                                                        data-bvalidator="required">
                                                        <?php $__currentLoopData = $manufacturer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manfact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($manfact->id); ?>">
                                                                <?php echo e($manfact->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </label>

                                                <!-- <label for="user_id" class="show_if_simple tips" style="display:none;">
                                            Vendor:
                                               <select name="user_id" >
                                                <option value=""></option>
                                                <?php $__currentLoopData = $getvendor['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->username); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                        </label> -->
                                            </span>
                                        </h2>
                                    </div>
                                    <div class="upld-item-tabs">
                                        <div class="row m-0">
                                            <div class="col-md-3 p-0">
                                                <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                                                    <li class="">
                                                        <a class="active" data-toggle="tab" href="#general" role="tab"
                                                            aria-controls="general" aria-selected="true">General</a>
                                                    </li>
                                                    <li class="">
                                                        <a class="" id="inventory-tab" data-toggle="tab"
                                                            href="#inventory" role="tab" aria-controls="inventory"
                                                            aria-selected="false">Inventory</a>
                                                    </li>
                                                    <li class="">
                                                        <a class="" id="shipping-tab" data-toggle="tab" href="#shipping"
                                                            role="tab" aria-controls="shipping"
                                                            aria-selected="false">Shipping</a>
                                                    </li>
                                                    <li class="">
                                                        <a class="" id="linked_products-tab" data-toggle="tab"
                                                            href="#linked_products" role="tab"
                                                            aria-controls="linked_products" aria-selected="false">Linked
                                                            Products</a>
                                                    </li>
                                                    <li class="">
                                                        <a class="" id="advanced-tab" data-toggle="tab" href="#advanced"
                                                            role="tab" aria-controls="advanced"
                                                            aria-selected="false">Advanced</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.col-md-4 -->
                                            <div class="col-md-9 p-0">
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="general" role="tabpanel"
                                                        aria-labelledby="general-tab">
                                                        <div class="options_group">
                                                            <p class="form-field _regular_price_field ">
                                                                <label for="_regular_price">Regular price ($)</label>
                                                                <input type="text" class="short wc_input_price" style=""
                                                                    name="regular_price " id="regular_price " value=""
                                                                    placeholder="">
                                                            </p>
                                                            <p class="form-field _sale_price_field ">
                                                                <label for="_sale_price">Sale price ($)</label>
                                                                <input type="text" class="short wc_input_price" style=""
                                                                    name="extended_price" id="extended_price" value=""
                                                                    placeholder="">
                                                            </p>
                                                        </div>
                                                        <!--   <div class="options_group">
                                                    <p class="form-field">
                                                        <label>Manufacturing</label>
                                                         <select name="manufacturer[]" id="manufacturer" class="short" data-bvalidator="required" multiple="multiple">
                                                            <?php $__currentLoopData = $manufacturer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manfact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                               <option value="<?php echo e($manfact->manufacturers_id); ?>" ><?php echo e($manfact->manufacturers_name); ?></option>
                                               
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </p>
                                                </div> -->

                                                        <div class="options_group" id="hotel_room">
                                                            <p class="form-field">
                                                                <label>Hotels / Resturants / Spa</label>
                                                                <select name="hotels[]" id="hotel" class="short"
                                                                    data-bvalidator="required" multiple="multiple">

                                                                    <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php $user = DB::table('users')
                                                                        ->where('id', $shop->user_id)
                                                                        ->first(); ?>
                                                                        <option value="<?php echo e($shop->item_id); ?>">
                                                                            <?php echo e($shop->item_name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="inventory" role="tabpanel"
                                                        aria-labelledby="inventory-tab">
                                                        <div class="options_group">
                                                            <p class="form-field">
                                                                <label for="_sku"><abbr title="Stock Keeping Unit">SKU</abbr></label>
                                                                <input type="text" class="short" id="sku" name="sku" value="">
                                                                    
                                                            </p>
                                                            <p class="form-field">
                                                                <label for="_manage_stock">Manage stock?</label>
                                                                <input type="checkbox" class="checkbox" id="instodck"
                                                                    name="insdtock" value="yes"
                                                                    onClick="hidedivs(this)"> <span
                                                                    class="description">Enable stock management at product level</span>
                                                                    
                                                            </p>
                                                            <!-- onClick="hidedivs(this)" -->
                                                            <div class="stock_fields" id="stock_fields">
                                                                <p class="form-field _stock_field ">
                                                                    <label for="_stock">Stock quantity</label>
                                                                    <input type="number" class="short wc_input_stock"
                                                                        name="stock_quantity" id="stock_quantity"
                                                                        value="0">
                                                                </p>
                                                                <p class="form-field">
                                                                    <label for="_backorders">Allow backorders?</label>
                                                                    <select id="backorders" name="backorders"
                                                                        class="select short">
                                                                        <option value="0" >Do not
                                                                            allow</option>
                                                                        <option value="1">Allow, but notify
                                                                            customer</option>
                                                                        <option value="2" selected="selected">Allow</option>
                                                                    </select>
                                                                </p>
                                                                <p class="form-field ">
                                                                    <label for="_low_stock_amount">Low stock
                                                                        threshold</label>
                                                                    <input type="number" class="short"
                                                                        name="low_stock_amount" id="low_stock_amount"
                                                                        placeholder="2">
                                                                </p>
                                                            </div>
                                                            <p class="form-field">
                                                                <label for="_stock_status">Stock status</label>
                                                                <select id="instock" name="instock"
                                                                    class="select short">
                                                                    <option value="0">Out of stock</option>
                                                                    <option value="1" selected="selected">In stock
                                                                    </option>
                                                                    <option value="2">On backorder</option>
                                                                </select>
                                                            </p>
                                                        </div>
                                                        <div class="options_group">
                                                            <p class="form-field">
                                                                <label for="_sold_individually">Sold
                                                                    individually</label>
                                                                <input type="checkbox" class="checkbox"
                                                                    name="sold_individually" id="sold_individually"
                                                                    value="1">
                                                                <span class="description">Enable this to only allow one
                                                                    of this item to be bought in a single order</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="shipping" role="tabpanel"
                                                        aria-labelledby="shipping-tab">
                                                        <div class="options_group">
                                                            <p class="form-field _weight_field ">
                                                                <label for="_weight">Weight (kg)</label>
                                                                <input type="text" class="short wc_input_decimal"
                                                                    name="weight" id="weight" value="" placeholder="0">
                                                            </p>
                                                            <p class="form-field">
                                                                <label for="product_length">Dimensions (cm)</label>
                                                                <span class="wrap">
                                                                    <input id="product_length" placeholder="Length"
                                                                        class="input-text wc_input_decimal" size="6"
                                                                        type="text" name="length" value="">
                                                                    <input id="product_width" placeholder="Width"
                                                                        class="input-text wc_input_decimal" size="6"
                                                                        type="text" name="width" value="">
                                                                    <input id="product_height" placeholder="Height"
                                                                        class="input-text wc_input_decimal last"
                                                                        size="6" type="text" name="height" value="">
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="options_group">
                                                            <p class="form-field">
                                                                <label for="product_shipping_class">Shipping
                                                                    class</label>
                                                                <select name="product_shipping_class"
                                                                    id="product_shipping_class" class="select short">
                                                                    <option value="-1" selected="selected">No shipping
                                                                        class</option>
                                                                </select>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="linked_products" role="tabpanel"
                                                        aria-labelledby="linked_products-tab">
                                                        <div class="options_group">
                                                            <p class="form-field">
                                                                <label for="upsell_ids">Upsells</label>
                                                                <select class="short" multiple=""
                                                                    data-placeholder="Search for a product…">
                                                                </select>
                                                            </p>
                                                            <p class="form-field">
                                                                <label for="crosssell_ids">Cross-sells</label>
                                                                <select class="short" multiple=""
                                                                    data-placeholder="Search for a product…">
                                                                </select>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="advanced" role="tabpanel"
                                                        aria-labelledby="advanced-tab">
                                                        <div class="options_group">
                                                            <p class="form-field">
                                                                <label
                                                                    for="_purchase_note"><?php echo e(trans('labels.purchasenote')); ?></label>
                                                                <textarea class="short" style="" name="purchase_note"
                                                                    id="purchase_note" placeholder="" rows="2"
                                                                    cols="20"></textarea>
                                                            </p>
                                                        </div>
                                                        <div class="options_group">
                                                            <p class="form-field menu_order_field ">
                                                                <label for="menu_order">Menu order</label>
                                                                <input type="number" class="short" style=""
                                                                    name="menu_order" id="menu_order" value="0"
                                                                    placeholder="" step="1">
                                                            </p>
                                                        </div>
                                                        <div class="options_group reviews">
                                                            <p class="form-field comment_status_field ">
                                                                <label for="comment_status">Enable reviews</label>
                                                                <input type="checkbox" class="checkbox" style=""
                                                                    name="enable_review" id="enable_review" value="1"
                                                                    checked="checked">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.col-md-8 -->
                                        </div>
                                    </div>
                                </div>
                                <div class="upld-item-detail">
                                    <div class="upld-item-detail-head">
                                        <h2 class="hndle ui-sortable-handle">Product short description</h2>
                                    </div>
                                    <div class="upld-item-detail-body">

                                        <textarea id="editor2" class="ckeditor" name="item_shortdesc"
                                            data-bvalidator="required"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="upld-item-detail">
                                <div class="upld-item-detail-head">
                                    <h2 class="hndle ui-sortable-handle">Publish</h2>
                                </div>
                                <div class="upld-item-detail-body">
                                    <div class="misc-pub-section misc-pub-post-status">
                                        Status: <span id="post-status-display">Published</span>
                                        <a href="#" class="button-link" role="button" id="edit-btn">
                                            <span aria-hidden="true" onClick="showEditOption()">Edit</span>
                                        </a>
                                        <div id="post-status-select" class="" style="display:none;">
                                            <select name="item_status" id="item_status" class="select-custome">
                                                <option selected="selected" value="Published">Yes</option>
                                                <option value="UnPublished">no</option>
                                                <!-- <option value="draft">Draft</option> -->
                                            </select>
                                            <a href="#" class="button-custome" onClick="shoowEditButton(1)">OK</a>
                                            <a href="#" class="button-link" onClick="shoowEditButton(0)">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="misc-pub-section misc-pub-visibility" id="visibility">
                                        Visibility: <span id="post-visibility-display">yes</span>
                                        <a href="#visibility" class="button-link" role="button" id="drop-btn">
                                            <span aria-hidden="true" onClick="showdripstatusOption()">Edit</span>
                                        </a>

                                        <div id="post-visibility-select" class="" style="display:none;">
                                            <input type="radio" name="drop_status" id="drop_status" value="no"
                                               > <label for="visibility-radio-public"
                                                class="selectit">No</label>
                                            <br>
                                            <input type="radio" name="drop_status" id="drop_status" value="yes"  checked="checked">Yes

                                            <br>

                                            <p>
                                                <a href="#visibility" class="button-custome"
                                                    onClick="shoowDropstatusButton(1)">OK</a>
                                                <a href="#visibility" class="button-link"
                                                    onClick="shoowDropstatusButton(0)">Cancel</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="upld-item-detail-footer">
                                    <input type="submit" name="publish" id="publish" class="button button-primary"
                                        value="Publish">
                                </div>
                            </div>
                            <div class="upld-item-detail">
                                <div class="upld-item-detail-head">
                                    <h2 class="hndle ui-sortable-handle">Product categories</h2>
                                </div>
                                <div class="upld-item-detail-body">
                                    <nav class="cat-tab">
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="all-cat-tab" data-toggle="tab"
                                                href="#nav-all-cat" role="tab" aria-controls="nav-all-cat"
                                                aria-selected="true">All categories</a>
                                            <a class="nav-item nav-link" id="nav-most-used-cat-tab" data-toggle="tab"
                                                href="#nav-most-used-cat" role="tab" aria-controls="nav-most-used-cat"
                                                aria-selected="false">Most Used</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content cat-tab-content">
                                        <div class="tab-pane fade show active" id="nav-all-cat" role="tabpanel"
                                            aria-labelledby="nav-all-cat-tab">
                                            <ul class="cat-list">
                                                <!-- <li>
                                            <label class="show_if_simple tips" style="">
                                                <input type="checkbox">
                                                Category 1
                                            </label>
                                        </li>
                                        <li>
                                            <label class="show_if_simple tips" style="">
                                                <input type="checkbox">
                                                Category 2
                                            </label> -->

                                                <?php $__currentLoopData = $catgoriesd['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <!-- <input type="radio" name="subcategory" id="subcategory"  value="category_<?php echo e($menu->cat_id); ?>" /> -->
                                                        <?php echo e($menu->category_name); ?>


                                                        <?php
                                                        $categoryId = $menu->cat_id;
                                                        $value = DB::table('subcategory')
                                                        ->where('drop_status', '=', 'no')
                                                        ->where('subcategory_status', '=', '1')
                                                        ->where('cat_id', '=', $categoryId);
                                                        $value = $value->where(function ($q) {
                                                        $q->where('subcatparent_id', '=',
                                                        null)->orWhere('subcatparent_id', '=', 0);
                                                        });
                                                        $value = $value->orderBy('cat_id', 'desc')->get();

                                                        if (count($value) > 0) { ?>
                                                        <ul>
                                                            <?php foreach ($value as $key => $value1) {
                                                            ?>

                                                            <li><input type="checkbox" name="subcategory[]"
                                                                    id="subcategory"
                                                                    value="<?php echo e($value1->subcat_id); ?>" /> -
                                                                <?php echo e($value1->subcategory_name); ?>




                                                                <?php
                                                                $subcategoryId = $value1->subcat_id;
                                                                $subsubvalue = DB::table('subcategory')
                                                                ->where('drop_status', '=', 'no')
                                                                ->where('subcategory_status', '=', '1')
                                                                ->where('cat_id', '=', $categoryId);
                                                                // $subsubvalue= $subsubvalue->where(function($q){
                                                                $subsubvalue = $subsubvalue->where('subcatparent_id',
                                                                '=', $subcategoryId);
                                                                // });
                                                                $subsubvalue = $subsubvalue->orderBy('cat_id',
                                                                'desc')->get();

                                                                if (count($subsubvalue) > 0) { ?>

                                                                <ul>
                                                                    <?php foreach ($subsubvalue as $key
                                                                    => $subsubvalue) { ?>

                                                                    <li><input type="checkbox" name="subcategory[]"
                                                                            id="subcategory"
                                                                            value="<?php echo e($subsubvalue->subcat_id); ?>" />
                                                                        -- <?php echo e($subsubvalue->subcategory_name); ?> </li>

                                                                    <?php } ?>

                                                                </ul>


                                                                <?php }
                                                                ?>





                                                            </li>

                                                            <?php } ?>
                                                        </ul>
                                                        <?php }
                                                        ?>

                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="nav-most-used-cat" role="tabpanel"
                                            aria-labelledby="nav-most-used-cat-tab">
                                            <ul class="cat-list">
                                                <li>
                                                    <label class="show_if_simple tips" style="">
                                                        <input type="checkbox">
                                                        Category 2
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="show_if_simple tips" style="">
                                                        <input type="checkbox">
                                                        Category 1
                                                    </label>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                    <div class="add-new-cat">
                                        <a href="javascript:void();" class="add-new-cat-link">+ Add new category</a>
                                        <!--  <p class="category-add">
                                    <input type="text" class="text-form-custome">
                                    <select class="text-form-select">
                                        <option value="-1">— Parent category —</option>
                                        <option class="level-0" value="16">test</option>
                                        <option class="level-0" value="15">Uncategorized</option>
                                    </select>
                                    
                                </p> -->
                                        <div id="category_success_msg_div" style="display: none"
                                            class="alert  alert-success alert-dismissible fade show" role="alert">
                                            <span id="category_success_msg"></span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div id="category_err_msg_div" style="display: none"
                                            class="alert  alert-danger alert-dismissible fade show" role="alert">
                                            <span id="category_error_msg"></span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <p class="category-add">

                                        <form method="post" enctype="multipart/form-data">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="text" placeholder="<?php echo e(trans('labels.subCategory')); ?>"
                                                class="text-form-custome" name="subcategory_name" id="subcategory_name">
                                            <label for="name"
                                                class="control-label mb-1"><?php echo e(trans('labels.parentcategory')); ?> <span
                                                    class="require">*</span></label>
                                            <select name="cat_id" id="cat_id" class="text-form-select"
                                                data-bvalidator="required">
                                                <option value=""><?php echo e(Helper::translation(5931, $translate)); ?></option>
                                                <?php $__currentLoopData = $catgoriesd['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($menu->cat_id); ?>"><?php echo e($menu->category_name); ?>

                                                    </option>
                                                    <?php
                                                    $categoryId = $menu->cat_id;
                                                    $value = DB::table('subcategory')
                                                    ->where('drop_status', '=', 'no')
                                                    ->where('subcategory_status', '=', '1')
                                                    ->where('cat_id', '=', $categoryId);
                                                    $value = $value->where(function ($q) {
                                                    $q->where('subcatparent_id', '=', null)->orWhere('subcatparent_id',
                                                    '=', 0);
                                                    });
                                                    $value = $value->orderBy('cat_id', 'desc')->get();

                                                    if (count($value) > 0) {
                                                    foreach ($value as $key => $value1) { ?>

                                                    <option value="<?php echo e($value1->subcat_id); ?>_<?php echo e($menu->cat_id); ?>">
                                                        - <?php echo e($value1->subcategory_name); ?></option>

                                                    <?php }
                                                    }
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <input type="hidden" name="subcategory_status" id="subcategory_status"
                                                value="1" />
                                            <input type="button" onclick="saveSubCategory(this)"
                                                class="button button-custome" value="Add new category">
                                        </form>


                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="upld-item-detail">
                                <div class="upld-item-detail-head">
                                    <h2 class="hndle ui-sortable-handle">Product tags</h2>
                                </div>
                                <div id="tag_success_msg_div" style="display: none"
                                            class="alert  alert-success alert-dismissible fade show" role="alert">
                                            <span id="tag_success_msg"></span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                </div>
                                <div id="tag_err_msg_div" style="display: none"
                                            class="alert  alert-danger alert-dismissible fade show" role="alert">
                                            <span id="tag_error_msg"></span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                </div>
                                <div class="upld-item-detail-body">
                                    <div class="add-tags-main">
                                        <div class="add-tags">
                                            <form method="post" enctype="multipart/form-data">
                                                 <?php echo e(csrf_field()); ?>

                                                <input type="text" class="text-form-custome" name="item_tags"
                                                    id="item_tags">
                                                <input type="button" class="button button-custome" value="Add"
                                                    onClick="addTag(this)">
                                            </form>
                                        </div>
                                        <p class="howto">Separate tags with commas</p>
                                        <ul class="tagchecklist" role="list" id="tagul">
                                            <!-- <li>
                                                <button type="button" id="product_tag-check-num-0" class="ntdelbutton">
                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                </button>&nbsp;tag1
                                            </li>
                                            <li>
                                                <button type="button" id="product_tag-check-num-1" class="ntdelbutton">
                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                </button>&nbsp;tag2
                                            </li>
 -->

                                                   <!--  <li><a href="#" role="button" class="tag-cloud-link">tag1</a></li>
                                                    <li><a href="#" role="button" class="tag-cloud-link">tag2</a></li> -->
                                                    <?php if(count($catgoriesd['tag']) > 0): ?>
                                                        <?php $__currentLoopData = $catgoriesd['tag']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li id="db_<?php echo e($value->tag_id); ?>">
                                                               <!--  <a href="javascript:void(0)" role="button" class="tag-cloud-link" onclick="addTagItem('<?php //echo $value->tag_name; ?>','<?php //echo $value->tag_id; ?>')"><?php echo e($value->tag_name); ?></a> -->

                                                                <button type="button" id="product_tag-check-num-1" class="ntdelbutton" onClick="removeTagItem('<?php echo $value->tag_id; ?>','fa fa-check','<?php echo $value->tag_name; ?>','fa fa-times-circle')">
                                                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                </button>&nbsp;<?php echo e($value->tag_name); ?> <input type="hidden" name="tag_id[]" id="tagstags" value="<?php echo e($value->tag_id); ?>" />
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                
                                        </ul>
                                       <!--  <div class="most-use-tag">
                                            <button type="button" class="button-link">Choose from the most used
                                                tags</button>
                                            <div class="the-tagcloud">
                                                <ul class="wp-tag-cloud">
                                                  
                                                    <?php if(count($catgoriesd['tag']) > 0): ?>
                                                        <?php $__currentLoopData = $catgoriesd['tag']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li id="db_<?php echo e($value->tag_id); ?>">
                                                                    <a href="javascript:void(0)" role="button" class="tag-cloud-link" onclick="addTagItem('<?php echo $value->tag_name; ?>','<?php echo $value->tag_id; ?>')"><?php echo e($value->tag_name); ?></a>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="upld-item-detail">
                                <div class="upld-item-detail-head">
                                    <h2 class="hndle ui-sortable-handle">Product Preview</h2>
                                </div>
                                <div class="upld-item-detail-body">
                                    <div class="item-img-upload">
                                        <!--  <a href="#" class="thickbox"> -->
                                        <!-- <img src="https://analyticsindiamag.com/wp-content/uploads/2018/12/image.jpg" alt=""> -->
                                        <input type="file" name="item_preview" id="item_preview" value=""
                                            class="thickbox " />
                                        <!--  </a> -->
                                        <!-- <a href="#" id="remove-post-thumbnail">Remove product image</a> -->
                                    </div>
                                </div>
                            </div>


                            <div class="upld-item-detail">
                                <div class="upld-item-detail-head">
                                    <h2 class="hndle ui-sortable-handle"><?php echo e(Helper::translation(2950, $translate)); ?>

                                    </h2>
                                </div>
                                <div class="upld-item-detail-body">
                                    <div class="item-img-upload">
                                        <!--  <a href="#" class="thickbox"> -->
                                        <!-- <img src="https://analyticsindiamag.com/wp-content/uploads/2018/12/image.jpg" alt=""> -->
                                        <input type="file" name="item_screenshot[]" class="files" id="item_screenshot"
                                            value="" />
                                        <!--  </a> -->
                                        <!-- <a href="#" id="remove-post-thumbnail">Remove product image</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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


            <?php if($errors->any()): ?>
                <div class="col-sm-12">
                    <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php echo e($error); ?>


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>


        <?php else: ?>
            <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->


    <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script type="text/javascript">

        function removeTagItem(tagid,clsname,tagname,addclsname){
                $("#db_"+tagid).remove();

                var html='<li id="db_'+tagid+'">';

                html=html+'<button type="button" id="product_tag-check-num-1" class="ntdelbutton" onClick="removeTagItem('+tagid+',\''+addclsname+'\',\''+tagname+'\',\''+clsname+'\')">';
                html=html+'<i class="'+clsname+'" aria-hidden="true"></i>';
                html=html+'</button>&nbsp;'+tagname;

                if(clsname == 'fa fa-check'){
                       html=html+'<input type="hidden" name="tag_id[]" id="tagstags" value="'+tagid+'" />'; 
                }
                    
                html=html+'</li>';
                jQuery("#tagul").append(html);

        }

        function addTagItem(tag){
                $("#tagul").append('<li id="'+tag+'"><button type="button" id="product_tag-check-num-1" class="ntdelbutton"><i class="fa fa-times-circle" aria-hidden="true"></i></button>&nbsp;'+tag +'</li>');
        }
        function saveSubCategory(objs) {
            var formData = $(objs).closest("form").serialize();

            $.ajax({
                url: "<?php echo e(route('admin.add-subcategory-ajax')); ?>",
                type: 'post',
                data: formData,
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.success == 1) {
                        jQuery("#cat_id").val('');
                        jQuery("#subcategory_name").val('');
                        jQuery("#category_err_msg_div").hide();
                        jQuery("#category_success_msg_div").show();
                        jQuery("#category_success_msg").text(data.message);

                    }
                },
                error: function(errors) {
                    console.log(errors.responseJSON)
                    jQuery("#category_error_msg").text(errors.responseJSON.message);
                    jQuery("#category_err_msg_div").show();
                    jQuery("#category_success_msg_div").hide();
                }
            });
        }


        function addTag(objs){

             var formData = $(objs).closest("form").serialize();

            $.ajax({
                url: "<?php echo e(route('admin.add-tag-ajax')); ?>",
                type: 'post',
                data: formData,
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.success == 1) {
                        //jQuery("#cat_id").val('');
                        jQuery("#item_tags").val('');
                        jQuery("#tag_err_msg_div").hide();
                        jQuery("#tag_success_msg_div").show();
                        jQuery("#tag_success_msg").text(data.message);
                        jQuery("#tagul").append(data.html);
                    }
                },
                error: function(errors) {
                    console.log(errors.responseJSON)
                    jQuery("#tag_error_msg").text(errors.responseJSON.message);
                    jQuery("#tag_err_msg_div").show();
                    jQuery("#tag_success_msg_div").hide();
                }
            });


        }

        $("#item_name").keyup(function(){
            console.log($(this).val());
           if( $("#demo_url").val() == ''){ $("#demo_url").val($(this).val()) };
        });

        $("#hotel").change(function() {


            console.log($(this).val());
            var test = [0];
            jQuery.ajax({

                url: "<?php echo e(url('/admin/fetch-vendor-hotel-room')); ?>",
                method: 'post',
                data: {

                    sel_room: test,
                    sel_hotel: $(this).val(),

                    "_token": "<?php echo e(csrf_token()); ?>"

                },
                success: function(result) {

                    console.log(result);

                    $(".testtest").remove();
                    //  $("#removerhtml").remove();

                    $("#hotel_room").after(result);

                    //  $("#afteradd").after(result.split("@")[1]);
                    // $("#afteradd").after(result.split("@")[0]);

                    // $("#save_watermark").val('');
                    // $("#removeimg").hide();
                    // $("#watermark_option").val("0"); 
                    // $(obj).remove();




                }

            });


        });



        function showEditOption() {

            $("#post-status-select").show();
            $("#edit-btn").hide();
            var itemstatus = $("#item_status").val();
            $("#post-status-display").html();
            $("#post-status-display").html(itemstatus);
        }

        function shoowEditButton(isok) {
            $("#post-status-select").hide();
            $("#edit-btn").show();
            var itemstatus = $("#item_status").val();
            var poststushtml = $("#post-status-display").html();

            if (isok == 1) {
                $("#post-status-display").html();
                $("#post-status-display").html(itemstatus);

            } else {
                $("#post-status-display").html(poststushtml);
            }
        }

        function showdripstatusOption() {

            $("#post-visibility-select").show();
            $("#drop-btn").hide();

            var itemstatus = $("#drop_status:checked").val();
            $("#post-visibility-display").html();
            $("#post-visibility-display").html(itemstatus);
        }


        function shoowDropstatusButton(isok) {
            $("#post-visibility-select").hide();
            $("#drop-btn").show();
            var itemstatus = $('input[name="drop_status"]:checked').val();
            var poststushtml = $("#post-visibility-display").html();



            if (isok == 1) {
                $("#post-visibility-display").html();
                $("#post-visibility-display").html(itemstatus);

            } else {
                $("#post-visibility-display").html(poststushtml);
            }
        }


        function hidedivs(obj) {

            console.log('hiTEST Test');
            console.log($(obj).checked);
            $("#stock_fields").hide();
            if ($(obj).prop("checked") == true) {
                $("#stock_fields").show();
            }
        }
        $(document).ready(function() {
            'use strict';
            $("#mp4").hide();
            $("#youtube").hide();
            $('#video_preview_type').on('change', function() {
                if (this.value == 'youtube')

                {
                    $("#youtube").show();
                    $("#mp4").hide();
                } else if (this.value == 'mp4') {

                    $("#mp4").show();
                    $("#youtube").hide();

                } else {

                    $("#mp4").hide();
                    $("#youtube").hide();
                }

            });
        });

    </script>

    <script>
        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('autocomplete'), {
                    types: ['geocode']
                });

            autocomplete.setFields(['address_component']);
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            var place = autocomplete.getPlace();
            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    document.getElementById('latitude').value = geolocation.lat;
                    document.getElementById('longitude').value = geolocation.lng;
                });
            }
        }

    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE&libraries=places&callback=initAutocomplete"
        async defer></script>

</body>

</html>
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/product/upload-item.blade.php ENDPATH**/ ?>