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
                            <a href="{{ url('/admin/products-import-export') }}" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o"></i> {{ Helper::translation(5457,$translate) }}</a>&nbsp;
                               @php $encrypted = $encrypter->encrypt('product'); @endphp
                                <a href="{{ URL::to('/admin/upload-new-item') }}/{{ $encrypted }}" class="btn btn-success btn-sm dropbtn"><i class="fa fa-plus"></i>{{ trans('labels.addItem')}}</a>
                            
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
                                          <!--   <th>{{ Helper::translation(5463,$translate) }}</th> -->
                                            <th width="100">{{ Helper::translation(2938,$translate) }}</th>
                                            <th>{{ trans('labels.stafffav') }}?</th>
                                            <th>{{ trans('labels.isrvyexclusive') }}?</th>
                                          <!--   <th>{{ Helper::translation(5472,$translate) }}?</th> -->
                                            <th>{{ trans('labels.storename') }}</th>
                                            <th>{{ Helper::translation(2873,$translate) }}</th>
                                            <th>{{ Helper::translation(2922,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($itemData['item'] as $item)
                                        <tr>
                                            <td>{{ $no }}</td>

                                       
                                         
                                             <td>{{ substr($item->item_name,0,50) }}</td>
                                            
                                            
                                            <td>

                                              
                                                    @if($item->item_stafffav == 'no')
                                                   <a href="newpItems/{{ $item->item_stafffav }}/{{ $item->item_token }}" style="font-size:12px; color:#0000FF; text-decoration:underline;"> 
                                                {{ $item->item_stafffav }}
                                                   </a>
                                                       <input type="checkbox" name="item_stafffav" id="item_stafffav" value="{{ $item->item_stafffav }}" /> 
                                                 @else 
                                                        <a href="newpItems/{{ $item->item_stafffav }}/{{ $item->item_token }}" style="font-size:12px; color:#0000FF; text-decoration:underline;">{{ $item->item_stafffav }}
                                                        </a>
                                                          <input type="checkbox" name="item_stafffav" id="item_stafffav" value="{{ $item->item_stafffav }}" checked="checked" /> 
                                                 @endif 
                                           
                                            </td>

                                            <td>

                                              
                                            @if($item->tiem_ravybeexc == 1)
                                                   <a href="newpItemsr/{{ $item->tiem_ravybeexc }}/{{ $item->item_token }}" style="font-size:12px; color:#0000FF; text-decoration:underline;"> 
                                                   Yes
                                                   </a>
                                                    <input type="checkbox" name="tiem_ravybeexc" id="tiem_ravybeexc" value="{{ $item->tiem_ravybeexc }}" checked="checked"/> 
                                            @else 
                                                    <a href="newpItemsr/{{ $item->tiem_ravybeexc }}/{{ $item->item_token }}" style="font-size:12px; color:#0000FF; text-decoration:underline;">    No
                                                        </a>
                                                        <input type="checkbox" name="tiem_ravybeexc" id="tiem_ravybeexc" value="{{ $item->tiem_ravybeexc }}" /> 
                                           @endif 
                                           
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
                                               @if(count($userarray) > 0) {{ implode(",",$userarray) }} @endif
                                            </td>
                                            <td>@if($item->item_status == 1) <span class="badge badge-success">{{ Helper::translation(5232,$translate) }}</span> @elseif($item->item_status == 2) <span class="badge badge-danger">{{ Helper::translation(5235,$translate) }}</span> @else <span class="badge badge-warning">{{ Helper::translation(3092,$translate) }}</span> @endif</td>
                                            <td><a href="edit-newItems/{{ $item->item_token }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; {{ Helper::translation(2923,$translate) }}</a> 
                                            @if($demo_mode == 'on') 
                                            <a href="demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a>
                                            @else
                                          <a href="newpItems/{{ $item->item_token }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ Helper::translation(5064,$translate) }}?');"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a>@endif</td> 
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
