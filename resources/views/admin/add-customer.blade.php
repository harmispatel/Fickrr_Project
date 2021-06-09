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
                        <h1>{{ Helper::translation(5001,$translate) }}</h1>
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
                       <form action="{{ route('admin.add-customer') }}" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
                        
                        {{ csrf_field() }}
                        <div class="card">
                           
                           
                           
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2917,$translate) }} <span class="require">*</span></label>
                                                <input id="name" name="name" type="text" class="form-control" required value="{{ old('name') }}">
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(3111,$translate) }} <span class="require">*</span></label>
                                                <input id="username" name="username" type="text" class="form-control" required  value="{{ old('username') }}">
                                            </div>
                                            
                                                <div class="form-group">
                                                    <label for="email" class="control-label mb-1">{{ Helper::translation(2915,$translate) }} <span class="require">*</span></label>
                                                    <input id="email" name="email" type="email" class="form-control" required  value="{{ old('email') }}">
                                                   
                                                </div>
                                                
                                                <input type="hidden" name="user_type" value="customer">
                                                
                                                <div class="form-group">
                                                    <label for="password" class="control-label mb-1">{{ Helper::translation(3113,$translate) }} <span class="require">*</span></label>
                                                    <input id="password" name="password" type="text" class="form-control" required>
                                                    
                                                </div>

                                                 <div class="form-group">
                                                <label for="socialmedialinks" class="control-label mb-1">{{ trans('labels.socialmedialinksfacebook') }}</label>
                                                <input name="socialmedialinks" id="socialmedialinks" type="text"  class="form-control"  data-bvalidator="url" required value="{{ old('socialmedialinks') }}">
                                            
                                            </div>

                                          

                                            <div class="form-group">
                                                <label for="instagram" class="control-label mb-1">{{ trans('labels.instagram') }}</span></label>
                                                <input name="instagram" id="instagram" type="text"  class="form-control"  data-bvalidator="url" required value="{{ old('instagram') }}"/>
                                            
                                            </div>

                                             <div class="form-group">
                                                <label for="linkedin" class="control-label mb-1">{{ trans('labels.twitterurl') }}</span></label>
                                                <input name="twitterurl" id="twitterurl" type="text"  class="form-control"  data-bvalidator="url" required value="{{ old('twitterurl') }}"/>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="youtube" class="control-label mb-1">{{ trans('labels.youtube') }}</label>
                                                <input name="youtube" id="youtube" type="text"  class="form-control"  data-bvalidator="url" required value="{{ old('youtube') }}"/>
                                            
                                            </div>
                                                
                                             <!--     <div class="form-group">
                                                    <label for="earnings" class="control-label mb-1">{{ Helper::translation(3106,$translate) }} ({{ $allsettings->site_currency }})</label>
                                                    <input id="earnings" name="earnings" type="text" class="form-control">
                                                    
                                                </div> -->
                                                
                                                <div class="form-group">
                                                                    <label for="customer_earnings" class="control-label mb-1">{{ Helper::translation(4956,$translate) }}</label>
                                                                    <input type="file" id="user_photo" name="user_photo" class="form-control-file">
                                                                </div>
                                                
                                                <input type="hidden" name="page_redirect" value="customer">
                                                
                                        
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


</body>

</html>
