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
                        <h1>{{ trans('labels.shopsorrestaraunts') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">

                        <?php // echo "<pre>";print_r($viewitem);exit;?>
                        
                       <!--  <ol class="breadcrumb text-right">
                            <a href="{{ url('/admin/products-import-export') }}" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o"></i> {{ Helper::translation(5457,$translate) }}</a>&nbsp;
                       
                               
                              @php $encrypted = $encrypter->encrypt('hotel'); @endphp
                            <a href="{{ URL::to('/admin/upload-item') }}/{{ $encrypted }}" class="btn btn-success btn-sm dropbtn"> <i class="fa fa-plus"></i> {{ Helper::translation(5460,$translate) }}</a>
                     
                            <button onClick="myFunction()" class="btn btn-success btn-sm dropbtn"> 

                            <div id="myDropdown" class="dropdown-content">
                                @foreach($viewitem['type'] as $item_type)
                                @if($item_type->item_type_name != 'product')
                                @php $encrypted = $encrypter->encrypt($item_type->item_type_id); @endphp
                                <a href="{{ URL::to('/admin/upload-item') }}/{{ $encrypted }}">{{ $item_type->item_type_name }}</a>
                                @endif
                                @endforeach
                            </div>
                              </button> 
                            
                        </ol> -->

                           <ol class="breadcrumb text-right">
                            <a href="{{ url('/admin/items-import-export') }}" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o"></i> {{ trans('labels.vendorstoreimport/export') }}</a>&nbsp;
                            <button onClick="myFunction()" class="btn btn-success btn-sm dropbtn"><i class="fa fa-plus"></i> {{ Helper::translation(5460,$translate) }}</button>
                            <div id="myDropdown" class="dropdown-content">
                                @foreach($viewitem['type'] as $item_type)
                                @php $encrypted = $encrypter->encrypt($item_type->item_type_id); @endphp
                                <a href="{{ URL::to('/admin/upload-item') }}/{{ $encrypted }}">{{ $item_type->item_type_name }}</a>
                                @endforeach
                            </div>
                            
                            
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

                    <?php 
                   // echo "<pre>";print_r($itemData['item']);
                    ?>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ trans('labels.shopsorrestaraunts') }}</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(2920,$translate) }}</th>
                                            <th>{{ trans('labels.image') }}</th>
                                            <th width="100">{{  trans('labels.hotelname') }}</th>
                                          <!--   <th>{{ Helper::translation(5466,$translate) }}?</th>
                                            <th>{{ Helper::translation(5469,$translate) }}?</th>
                                            <th>{{ Helper::translation(5472,$translate) }}?</th> -->
                                            <th>{{ Helper::translation(3142,$translate) }}</th>
                                            <th>{{ Helper::translation(2873,$translate) }}</th>
                                            <th>{{ trans('labels.vendorstoretype') }}</th>
                                            <th>{{ trans('labels.location') }}</th>
                                            <th>{{ Helper::translation(2922,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($itemData['item'] as $item)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>@if($item->item_thumbnail != '') <img height="50" width="50" src="{{ url('/') }}/public/storage/items/{{ $item->item_thumbnail }}" alt="{{ $item->item_name }}"/>@else <img height="50" width="50" src="{{ url('/') }}/public/img/no-image.png" alt="{{ $item->item_name }}" />  @endif</td>
                                            <td><a href="{{ url('/item') }}/{{ $item->item_slug }}/{{ $item->item_id }}" target="_blank" class="black-color">{{ substr($item->item_name,0,50) }}</a></td>
                                            
                                         <td>

                                            <?php 

                                            $hasOneUser=$item->hasOneUser ? $item->hasOneUser :  array();
                                            $username='';

                                            if(!empty($hasOneUser)) {
                                                $username=$hasOneUser->username;
                                            }
                                            ?>
                                            <a href="{{ url('/user') }}/{{ $username }}" target="_blank" class="black-color">{{ $username }}</a></td>
                                            <td>@if($item->item_status == 1) <span class="badge badge-success">{{ Helper::translation(2970,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(2971,$translate) }}</span> @endif</td>

                                            <td>{{ @$item->item_type }}</td>
                                            <td>{{ @$item->address }}</td>
                                          <!--   <td>@if($item->item_flash_request == 1) @if($item->item_flash == 0) <span class="badge badge-danger">{{ Helper::translation(5475,$translate) }}</span> @else <span class="badge badge-success">{{ Helper::translation(5232,$translate) }}</span> @endif @else <span>---</span> @endif</td>
                                           
                                            <td>@if($item->item_status == 1) <span class="badge badge-success">{{ Helper::translation(5232,$translate) }}</span> @elseif($item->item_status == 2) <span class="badge badge-danger">{{ Helper::translation(5235,$translate) }}</span> @else <span class="badge badge-warning">{{ Helper::translation(3092,$translate) }}</span> @endif</td> -->
                                            <td><a href="edit-item/{{ $item->item_token }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; {{ Helper::translation(2923,$translate) }}</a> 
                                            @if($demo_mode == 'on') 
                                            <a href="demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a>
                                            @else
                                            <a href="items/{{ $item->item_token }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ Helper::translation(5064,$translate) }}?');"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a>@endif
                                             <a href="paymentsetting/{{ $item->item_id }}" class="btn btn-warning btn-sm" >&nbsp;{{ trans('labels.paymentsetting') }}</a>
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
