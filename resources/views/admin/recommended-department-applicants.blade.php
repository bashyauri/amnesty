<!DOCTYPE html>
@php
    use App\Models\User;
@endphp
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="{{ url('admin/js/select.dataTables.min.css') }}">
    <style>
        /* Custom CSS styles can be added here */
    </style>
</head>

<body>

    <div id="search-by-department">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error</strong> {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success</strong> {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                        @endif

                        @if (Auth::guard('admin')->user()->roles->contains('name', 'admin'))
                            <a href="{{ url('admin/export-recommended-pdf') }}"
                                class="btn btn-primary float-right">Export</a>
                        @endif
                        <p class="card-title">List of Recommended Applicants</p>

                        <div class="row">

                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#
                                                </th>
                                                <th>Surname</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Phone number</th>
                                                <th>Remark</th>
                                                @if (Auth::guard('admin')->user()->roles->contains('name', 'superadmin'))
                                                    <th>Department</th>
                                                    <th>Shortlist</th>
                                                @else
                                                    <th>Drop</th>
                                                @endif


                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @forelse ($recommendedApplicants as $index => $applicant)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ User::find($applicant->account_id)->surname }}</td>
                                                    <td>{{ User::find($applicant->account_id)->firstname }}</td>
                                                    <td>{{User::find($applicant->account_id)->m_name }}</td>
                                                    <td>{{ User::find($applicant->account_id)->p_number }}</td>
                                                    <td>{{ User::find($applicant->account_id)->remark }}</td>
                                                    {{--                                                            Check if logged in as superadmin shortlist else drop --}}
                                                    @if (Auth::guard('admin')->user()->roles->contains('name', 'superadmin'))
                                                        <td>{{ $applicant->department?->name }}</td>
                                                        <td><input type="checkbox" name="short-list"
                                                                class="shortlist-checkbox"
                                                                value="{{ $applicant->account_id }}">
                                                        </td>
                                                    @else
                                                        <td><input type="checkbox" name="drop-applicant"
                                                                class="drop-checkbox"
                                                                value="{{ $applicant->account_id }}">
                                                        </td>
                                                    @endif


                                                    <td class="message-container"></td>
                                                @empty
                                                    <p>No record found.</p>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="{{ url('admin/js/custom.js') }}"></script>
    <script src="{{ url('admin/js/ajax.js') }}"></script>
    <script src="{{ url('admin/js/ajax/drop-applicants.js') }}"></script>
    <script src="{{ url('admin/js/ajax/shortlist-applicants.js') }}"></script>
    <script src="{{ url('admin/js/ajax/recommend-applicants.js') }}"></script>
    <script src="{{ url('admin/js/ajax/search-recommended-applicants.js') }}"></script>
    <script src="{{ url('admin/js/ajax/search-course-applicants.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            var dataTable = $('#example').DataTable({

            });


        });


            </script>
</body>

</html>
