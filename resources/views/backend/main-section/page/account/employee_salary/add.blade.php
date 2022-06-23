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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Employee-Salary</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Salary</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card-header">
                   
                </div>
        <div class="card-box">
            <div class="row">
                  <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-append">
                        </div>
                        <input type="text" name="date" id="date" class="form-control" data-toggle="flatpicker" placeholder="March 9, 2020">
                    </div>
                    </div>
                 </div>
                  <div class="col-sm-6 col-md-2">
                    <div class="form-group">
                      <div class="input-group">
                        <a id="search"  name="search"  class="btn btn-success btn-block"> Search</a>
                     </div>
                     </div>
                    </div>


            <div class="col-sm-6 col-md-12">
             <div class="table-responsive">
                <div id="DocumentResults">
                    <script id="document-template" type="text/x-handlebars-template">
                 <form action="{{ route('account.salary.store') }}" method="post" >
                     @csrf
                    <table id="demo-foo-filtering" class="table table-bordered table-centered mb-0" data-page-size="5">
                        <thead>
                            <tr>
                           @{{{thsource}}}
                            </tr>
                         </thead>
                         <tbody>
                             @{{#each this}}
                             <tr>
                                 @{{{tdsource}}}	
                             </tr>
                             @{{/each}}
                         </tbody>
                        </table>
                        <input align="center" type="submit" class="btn btn-success waves-effect waves-light" style="margin-top: 10px" value="Save">
                    </script>
                </div>
            </form>
             </div>
            </div>
        </div>
        </div>
        <!-- end row -->
    </div>
    </div>

    <script type="text/javascript">
        $(document).on('click','#search',function(){   
          var date = $('#date').val();
           $.ajax({
            url: "{{ route('account.salary.getemployee')}}",
            type: "get",
            data: {'date':date},
            beforeSend: function() {       
            },
            success: function (data) {
              var source = $("#document-template").html();
              var template = Handlebars.compile(source);
              var html = template(data);
              $('#DocumentResults').html(html);
              $('[data-toggle="tooltip"]').tooltip();
            }
          });
        });
      </script>

@endsection
