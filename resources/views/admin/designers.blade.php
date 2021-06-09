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
                        <h1>{{ Helper::translation(5442,$translate) }}</h1>
                    </div>
                </div>
            </div>


            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        
                        <ol class="breadcrumb text-right">
                            
                            <a href="{{ url('/admin/upload-designer') }}" class="btn btn-success btn-sm dropbtn"><i class="fa fa-plus"></i> {{ trans('labels.Adddesigner') }}</a>
                           
                            
                        </ol>
                    </div>
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

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ Helper::translation(5442,$translate) }}</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(2920,$translate) }}</th>
                                           
                                            <th width="100">{{ Helper::translation(2938,$translate) }}</th>
                                            <th width="100">{{ trans('labels.email') }}</th>
                                            <th width="100">{{ trans('labels.shopsorrestaraunts') }}</th>
                                           <!--  <th>{{ Helper::translation(5466,$translate) }}?</th>
                                            <th>{{ Helper::translation(5469,$translate) }}?</th>
                                            <th>{{ Helper::translation(5472,$translate) }}?</th>
                                            <th>{{ Helper::translation(3142,$translate) }}</th>
                                            <th>{{ Helper::translation(2873,$translate) }}</th>
                                            <th>{{ Helper::translation(2922,$translate) }}</th> -->
                                             <th>{{ Helper::translation(2922,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                    @php $no = 1; @endphp

                                   
                                    @foreach($designer as $key=>$value)


                                    
                                        <tr>
                                            <td>{{ $no }}</td>
                                           
                                            <td><a href="{{ url('/designers') }}" target="_blank" class="black-color">{{ substr($value->name,0,50) }}</a></td>
                                             <td>{{ $value->email }}</a></td>

                                             <td>
                                                 <?php $designshops=count($value->hasManyDesignershops) > 0 ? $value->hasManyDesignershops : array() ; ?>
                                    
                                                  

                                                @foreach($designshops as $key1=>$value1)

                                                
                                                @if(!empty(@$value1['shopitem_id']))
                                    
                                                <?php  $i=DB::table('items')->where('item_id',$value1['shopitem_id'])->first(); ?>
                                                {{ @$i->item_name }} ,

                                                @endif
                                              
                                                 @endforeach
                                                 
                                            </td>
                                            <td><a href="edit-designer/{{ $value->id }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; {{ Helper::translation(2923,$translate) }}</a> 
                                                   <a href="designers/{{ $value->id }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ Helper::translation(5064,$translate) }}?');"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a></td>
                                            </td>
                                            
                                            
                                       
                                        </tr>
                                        @php $no++; @endphp
                                   @endforeach     
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
