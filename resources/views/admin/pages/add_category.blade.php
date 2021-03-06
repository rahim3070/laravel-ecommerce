@extends('admin.admin_master')
@section('admin_content')
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try {
            ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }
    </script>
    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-tachometer home-icon"></i><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
        <li class="active">Category</li>
        <li><a href="{{URL::to('add-category')}}">Add Category</a></li>
    </ul>
    <!-- /.breadcrumb -->
    <!--        <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div>
             /.nav-search -->
</div>
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12 widget-container-col">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h5 class="widget-title">Add Category ...</h5>
                            <div class="widget-toolbar">
                                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
                                <a href="#" data-action="reload"><i class="ace-icon fa fa-refresh"></i></a>
                                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <h3 style="color:green">
                                    <?php
                                    $message = Session::get('message');

                                    if ($message) {
                                        echo $message;
                                        Session::put('message', null);
                                    }
                                    ?>
                                </h3>
                                <div class="row">
                                    <!--'enctype'=>'multipart/form-data' -- For Upload Image-->
                                    {!! Form::open(['url' => '/save-category','method'=>'post','enctype'=>'multipart/form-data']) !!}
                                    <div class="col-xs-12">
                                        <div class="col-lg-6 col-sm-6">
                                            <label class="col-md-4" for="form-field-1">Category Name</label>
                                            <div class="col-md-8">
                                                <input name='category_name' type="text" id="form-field-1" placeholder="Category Name" class="col-xs-12" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <label class="col-md-4" for="form-field-1">Category Description</label>
                                            <div class="col-md-8">
                                                <textarea name='category_description' class="form-control" id="form-field-8" placeholder="Category Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-lg-6 col-sm-6">                                                  
                                            <label class="col-md-4" for="form-field-1">Parent Category</label>
                                            <div class="col-md-8">
                                                <select name='parent_id' class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Parent Category...">
                                                    <option value="0"> </option>
                                                    @foreach($category_info as $c_info)
                                                    @if($c_info->parent_id == 0)
                                                    <option value="{{$c_info->category_id}}">{{$c_info->category_name}}</option>
                                                    <?php
                                                    $sub_category = DB::table('tbl_category')
                                                            ->where('parent_id', $c_info->category_id)
                                                            ->where('publication_status', 1)
                                                            ->where('deletion_status', 0)
                                                            ->get();
                                                    ?>
                                                    @foreach($sub_category as $sc_info)
                                                    <option value="{{$sc_info->category_id}}"> --- {{$sc_info->category_name}}</option>
                                                    @endforeach
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <label class="col-md-4" for="form-field-1">Publication Status</label>
                                            <div class="col-md-8">
                                                <select name='publication_status' class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Publication Status...">
                                                    <option value=""></option>
                                                    <option value="1">Published</option>
                                                    <option value="0">Unpublished</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-lg-6 col-sm-6">
                                            <label class="col-md-4" for="form-field-1">Is Featured</label>
                                            <div class="col-md-8">
                                                <div class="checkbox">
                                                    <label><input name="is_featured" class="ace ace-checkbox-2" type="checkbox" /><span class="lbl"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <label class="col-md-4" for="form-field-1">Category Image</label>
                                            <div class="col-md-8">
                                                <input name="category_image" type="file" id="id-input-file-2" />
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="col-xs-12">
                                        <br>
                                        <div class="col-lg-4 col-sm-4">
                                            <!--<button class="btn btn-info" type="button"><i class="ace-icon fa fa-check bigger-110"></i>Submit</button>-->
                                        </div>
                                        <div class="col-lg-4 col-sm-4">
                                            <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-check bigger-110"></i>Submit</button>
                                        </div>
                                        <div class="col-lg-4 col-sm-4">
                                            <!--<button class="btn btn-info" type="button"><i class="ace-icon fa fa-check bigger-110"></i>Submit</button>-->
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.span -->
            </div>
            <!-- /.row -->
            <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@endsection