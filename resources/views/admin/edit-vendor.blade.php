<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    @include('admin.stylesheet')
</head>

<body>
    
    @include('admin.navigation')

    <!-- Right Panel -->
    @if(Auth::user()->id == 1)
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(5259,$translate) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
                </div>
            </div>
        </div>
        
        @if (session('success'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif


@if ($errors->any())
    <div class="col-sm-12">
     <div class="alert  alert-danger alert-dismissible fade show" role="alert">
     @foreach ($errors->all() as $error)
      
         {{$error}}
      
     @endforeach
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
     </div>
    </div>   
 @endif

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                       @if($demo_mode == 'on')
                           @include('admin.demo-mode')
                           @else
                       <form action="{{ route('admin.edit-vendor') }}" method="post" class="setting_form" id="item_form" enctype="multipart/form-data">
                        
                        {{ csrf_field() }}
                        @endif
                        <div class="card">
                           
                           
                           
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                            <?php //echo "<pre>";print_r($edit['userdata']);exit;?>
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2917,$translate) }} <span class="require">*</span></label>
                                                <input id="name" name="name" type="text" class="form-control" value="{{ $edit['userdata']->name }}" required>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(3111,$translate) }} <span class="require">*</span></label>
                                                <input id="username" name="username" type="text" class="form-control" value="{{ $edit['userdata']->username }}" required>
                                            </div>
                                            
                                            
                                                <div class="form-group">
                                                    <label for="email" class="control-label mb-1">{{ Helper::translation(2915,$translate) }} <span class="require">*</span></label>
                                                    <input id="email" name="email" type="email" class="form-control" value="{{ $edit['userdata']->email }}" required>
                                                   
                                                </div>
                                                
                                                <input type="hidden" name="user_type" value="vendor">
                                                
                                                <div class="form-group">
                                                    <label for="password" class="control-label mb-1">{{ Helper::translation(3113,$translate) }}</label>
                                                    <input id="password" name="password" type="text" class="form-control">
                                                    
                                                </div>

                                               <!--  <div class="form-group">
                                                    <label for="address" class="control-label mb-1">{{ trans('labels.address') }} <span class="require">*</span></label>
                                                    <input id="address" name="address" type="text" class="form-control" required value="{{ $edit['userdata']->address }}">
                                                </div> -->

                                                <div class="form-group">
                                                    <label for="phonenumber" class="control-label mb-1">{{ trans('labels.phonenumber') }}  <span class="require">*</span></label>
                                                    <input id="phonenumber" name="phonenumber" type="text" class="form-control" required value="{{ $edit['userdata']->phonenumber }}">
                                                </div>

                                                <div class="form-group">
                                                        <label for="about" class="control-label mb-1">{{ trans('labels.about') }} <span class="require">*</span></label>
                                                        <textarea id="about" name="about" class="form-control" >{{ $edit['userdata']->about }}</textarea>
                                                </div>

                                                   <div class="form-group">
                                                <label for="socialmedialinks" class="control-label mb-1">{{ trans('labels.socialmedialinksfacebook') }}</label>
                                                <input name="socialmedialinks" id="socialmedialinks" type="text"  class="form-control" value="{{  @$edit['userdata']->facebook_url  }}" data-bvalidator="url" required/>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="instagram" class="control-label mb-1">{{ trans('labels.instagram') }}</span></label>
                                                <input name="instagram" id="instagram" type="text"  class="form-control" value="{{  @$edit['userdata']->instagram  }}" data-bvalidator="url" required/>
                                            
                                            </div>

                                           
                                             <div class="form-group">
                                                <label for="linkedin" class="control-label mb-1">{{ trans('labels.twitterurl') }}</span></label>
                                                <input name="twitterurl" id="twitterurl" type="text"  class="form-control"  data-bvalidator="url" required value="{{  @$edit['userdata']->twitter_url   }}"/>
                                            
                                            </div>
                                            <div class="form-group">
                                                <label for="youtube" class="control-label mb-1">{{ trans('labels.youtube') }}</label>
                                                <input name="youtube" id="youtube" type="text"  class="form-control" value="{{  @$edit['userdata']->youtube  }}" data-bvalidator="url" required/>
                                            
                                            </div>
                                                
                                               <!--   <div class="form-group">
                                                    <label for="earnings" class="control-label mb-1">{{ Helper::translation(3106,$translate) }} ({{ $allsettings->site_currency }})</label>
                                                    <input id="earnings" name="earnings" type="text" class="form-control" value="{{ $edit['userdata']->earnings }}">
                                                    
                                                </div> -->

                                                <?php 
                                                //cho "<pre>";print_r($selectedshop);
                                                ?>

                                                 <div class="form-group">
                                                    <label for="earnings" class="control-label mb-1">{{ trans('labels.Shophotelsresturantsspa') }}</label>

                                                 @if(count($data['items']) > 0)
                                                 <select name="item_shop[]" id="item_shop" class="form-control chosen-select" multiple="multiple">

                                                    @foreach($data['items'] as $key=>$value)
                                                        <option value="{{ $value->item_id }}" @if(in_array($value->item_id,$selectedshop)) selected='selected' @endif>{{ $value->item_type }}-{{  $value->item_name }}</option>

                                                    @endforeach
                                                </select>
                                                 @endif

                                                  </div> 
                                                
                                                <div class="form-group">
                                                                    <label for="customer_earnings" class="control-label mb-1">{{ Helper::translation(4956,$translate) }}</label>
                                                                    <input type="file" id="user_photo" name="user_photo" class="form-control-file">
                                                                </div>
                                                @if($edit['userdata']->user_photo != '')
                                                <img height="50" src="{{ url('/') }}/public/storage/users/{{ $edit['userdata']->user_photo }}"  class="userphoto"/>@else <img height="50" src="{{ url('/') }}/public/img/no-user.png"  class="userphoto"/>  @endif
                                                
                                                <input type="hidden" name="save_photo" value="{{ $edit['userdata']->user_photo }}">
                                                
                                                <input type="hidden" name="save_password" value="{{ $edit['userdata']->password }}">
                                                
                                                <input type="hidden" name="edit_id" value="{{ $token }}">

                                                <input type="hidden" name="user_id" value="{{ $edit['userdata']->id }}">
                                                
                                                <input type="hidden" name="page_redirect" value="vendor">
                                        
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                             <div class="col-md-6">
                             
                             
                             
                             
                             </div>
                            
                            
                            <div class="card-footer">
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> {{ Helper::translation(2876,$translate) }}
                                                        </button>
                                                        <button type="reset" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-ban"></i> {{ Helper::translation(4962,$translate) }}
                                                        </button>
                                                    </div>
                                                    
                                                    
                                                 
                            
                        </div> 

                    
                    </form> 
                    
                    </div>
                    

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
    @else
    @include('admin.denied')
    @endif
    <!-- Right Panel -->


   @include('admin.javascript')
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">

<!--   <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script type="text/javascript">
    
    $(".chosen-select").chosen();
</script>

</body>

</html>
