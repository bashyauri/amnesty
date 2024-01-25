<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Applicants</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css"> --}}

    {{-- <link rel="stylesheet" type="text/css" href="{{ url('admin/js/select.dataTables.min.css') }}"> --}}
    <style>
        /* Custom CSS styles can be added here */
    </style>
</head>

<body>

    <div id="result">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">

                        <p class="card-title">List of Applicants</p>

                        <div class="row">

                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Phone number</th>
                                                <th>State</th>
                                                <th>LGA</th>
                                                <th>Proposed Course</th>
                                                <th>Jamb Details</th>

                                                <th>SSCE Details</th> <!-- New column for SSCE Details -->
                                                <th>Select Criteria</th> <!-- New column for Select Criteria -->
                                                <th>Comments</th> <!-- New column for Comments -->
                                                <th>Recommend</th> <!-- New column for Recommend -->
                                                <th><th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($applicants as $application)
                                                <tr>
                                                    <td>{{ $application->surname.' '.$application->firstname.' '.$application->m_name}}</td>
                                                    <td>{{ $application->p_number }}</td>
                                                    <td>{{ $application->name }}</td>
                                                    <td>{{ $application->lga }}</td>
                                                    <td>{{ $application->course_name }}</td>
                                                    <td>{{ $application->jambno .'->'. $application->score}}</td>

                                                    <td>
                                                        <!-- SSCE Details -->

                                                            @php
                                                                $grades = $application->exam_grades->chunk(2);
                                                            @endphp

                                                            @foreach ($grades as $gradeRow)

                                                                    @foreach ($gradeRow as $index => $exam_grade)


                                                                                         {{ Str::substr($exam_grade->subject_name, 0, 3) . '-> ' . $exam_grade->grade.';' }}
                                                                                         @if (($index +1) % 3 === 0)
                                                                                         <br>

                                                                                         @endif








                                                                    @endforeach


                                                            @endforeach

                                                    </td>
                                                    <td>
                                                        <!-- Select Criteria -->


                                                            <select name="criteria" class="criteria" required>
                                                                <option value="">choose</option>
                                                                <option value="Merit">Merit</option>
                                                                <option value="ELDS">ELDS</option>
                                                                <option value="Catchment area">Catchment area</option>
                                                            </select>

                                                    </td>
                                                    <td>
                                                        <!-- Comments -->


                                                            <input type="text" name="comments" class="comments">

                                                    </td>
                                                    <td>
                                                        <!-- Recommend -->


                                                            <input type="checkbox" name="recommend" class="recommend-checkbox" value="{{ $application->account_id }}">

                                                    </td>
                                                    <td class="message-container"></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->

            <!-- partial -->
        </div>
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
            crossorigin="anonymous"></script>
        <script src="{{ url('admin/js/custom.js') }}"></script>
        <script src="{{ url('admin/js/ajax.js') }}"></script>
        <script src="{{ url('admin/js/ajax/drop-applicants.js') }}"></script>
        <script src="{{ url('admin/js/ajax/recommend-applicants.js') }}"></script>
        <script src="{{ url('admin/js/ajax/search-course-applicants.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>


        <script>
          new DataTable('#example');


                </script>
</body>

</html>
