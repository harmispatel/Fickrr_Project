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
    @if(in_array('items',$avilable))
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ trans('labels.aboutdesigner')}}</h1>
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
                       
                        
                        
                      
                        <div class="card">
                           @if($demo_mode == 'on')
                           @include('admin.demo-mode')
                           @else
                        <form action="{{ route('admin.edit-designer') }}" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @endif
                          
                           
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        <input type="hidden" name="id" id="id" value="{{ @$edit['designer']->id }}" />
                                               
                                                <?php $shoparray=array();?>

                                                @if(!empty(@$edit['designer']->hasManyDesignershops))
                                                    @foreach(@$edit['designer']->hasManyDesignershops  as $key=>$value)
                                                    <?php $shoparray[]=$value->shopitem_id; ?>
                                                    @endforeach
                                                @endif


                                            
                                            
                                              <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ trans('labels.designername')}}<span class="require">*</span></label>
                                                 <input type="text" name="designername" id="designername"   placeholder="{{ trans('labels.designername')}}" required="true"  value="{{ @$edit['designer']->name }}" class="form-control" >
                                            </div> 
                                            
                                            <div class="form-group">
                                               <label for="about" class="control-label mb-1">{{ trans('labels.about') }}<span class="require">*</span></label>
                                                <textarea name="about" id="about" rows="6"  class="form-control" data-bvalidator="required">{{ @$edit['designer']->about }}</textarea>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="email" class="control-label mb-1">{{ trans('labels.email') }}<span class="require">*</span></label>
                                                <input name="email" id="email" type="email"  class="form-control" data-bvalidator="required" value="{{  @$edit['designer']->email  }}"/>
                                            
                                            </div>

                                            

                                             <div class="form-group">
                                                <label for="socialmedialinks" class="control-label mb-1">{{ trans('labels.socialmedialinksfacebook') }}</label>
                                                <input name="socialmedialinks" id="socialmedialinks" type="text"  class="form-control" value="{{  @$edit['designer']->facebook  }}"/>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="instagram" class="control-label mb-1">{{ trans('labels.instagram') }}</span></label>
                                                <input name="instagram" id="instagram" type="text"  class="form-control" value="{{  @$edit['designer']->instagram  }}"/>
                                            
                                            </div>

                                             <div class="form-group">
                                                <label for="linkedin" class="control-label mb-1">{{ trans('labels.linkedin') }}</span></label>
                                                <input name="linkedin" id="linkedin" type="text"  class="form-control" value="{{  @$edit['designer']->linkedin  }}"/>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="youtube" class="control-label mb-1">{{ trans('labels.youtube') }}</label>
                                                <input name="youtube" id="youtube" type="text"  class="form-control" value="{{  @$edit['designer']->youtube  }}"/>
                                            
                                            </div>


                                        
                                             <div class="form-group">
                                                <label for="images" class="control-label mb-1">{{ trans('labels.images') }}<span class="require">*</span></label>
                                                <input name="images[]" id="images[]" type="file"  class="form-control" multiple />
                                            
                                            </div>

                                           

                                                    
                                                    @if(!empty(@$edit['designer']->hasManyDesignerimages))

                                                        @foreach(@$edit['designer']->hasManyDesignerimages as $key=>$value)
                                                         &nbsp; <div class="form-group" style="float:left;padding:20px;">
                                                        <img src="{{ url::to('public/storage/items/'.$value->images) }}" width="70px;" />

                                                        <input name="oldimages[]" id="oldimages[]" type="hidden"  value="{{ $value->images }}" multiple />
 </div>
                                                        @endforeach
                                                    @endif


                                               
                                               
                                            
                                           
                                            
                                            
                                          
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                             
                           
                             
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> {{ Helper::translation(2876,$translate) }}</button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> {{ Helper::translation(4962,$translate) }} </button>
                             </div>
                             
                             </div>
                             
                            
                            </form>
                            
                                                    
                                                    
                                                 
                            
                        </div> 

                     
                    
                    
                    </div>
                    

                </div>
            </div><!-- .animated -->
        </div>
 

        <!-- .content -->


    </div><!-- /#right-panel -->
    @else
    @include('admin.denied')
    @endif 
    <!-- Right Panel -->


   @include('admin.javascript')



      
</body>

</html>
