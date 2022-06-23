@extends('backend.main-section.body.main')
@section('main')

@php
$usr = Auth::guard()->user();
@endphp

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Exam</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Grade-view</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Grade Point</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card-header">
                    <div class="col-lg-12" align="right"> <button class="btn btn-primary" data-toggle="modal" data-target="#addmodal">Add Point</button> </div>
                </div>
                <div class="card-box">
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-12 text-sm-center form-inline">
                                <div class="form-group mr-2">
                                    <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                        <option value="">Show all</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="demo-foo-filtering" class="table table-bordered table-centered mb-0" data-page-size="5">
                            <thead class="thead-light">  
                            <tr align="center">
                                <th>Grade Name</th>
                                <th>Grade Point</th>
                                <th>Start Marks</th>
                                <th>End Marks</th>
                                <th>Point Ranage</th>
                                <th>Remarks</th>
                                <th style="width: 11%;">Action</th>
                            </tr>
                            </thead>
                                @foreach ($allData as $key=>$gr)
                                <tbody>
                                    <tr align="center">
                                        <td>{{$gr->grade_name}}</td>
                                        <td>{{$gr->grade_point}}</td>
                                        <td>{{$gr->start_marks}}</td>
                                        <td>{{$gr->end_marks}}</td>
                                        <td>{{$gr->start_point}} - {{$gr->end_point}}</td>
                                        <td>{{$gr->remarks}}</td>
                                        <td style="width: 12%;">
                                            @if ($usr->can('Admin.delete'))  <button value="{{$gr->id}}" class="btn btn-xs btn-primary editbtn"><i class="fe-edit"></i></button> @endif
                                            @if ($usr->can('Admin.edit'))  <button value="{{$gr->id}}" class="btn btn-xs btn-danger deletebtn"><i class="fe-x"></i></button> @endif
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            <tfoot>
                                <tr class="active">
                                    <td colspan="8">
                                        <div class="text-right">
                                            <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->


    </div> <!-- container -->

</div> 

@include('backend.code-section.modal.exam.marks.grade.add')
@include('backend.code-section.modal.exam.marks.grade.edit')
@include('backend.code-section.modal.exam.marks.grade.delete')

</div> 

@endsection

@section('scripts')      

@include('backend.code-section.ajax-script.exam.grade')

@endsection