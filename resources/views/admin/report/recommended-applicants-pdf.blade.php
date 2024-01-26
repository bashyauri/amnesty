<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }


        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 1px;
            font-size: 10px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #footer {
            bottom: 0;
            border-top: 0.1pt solid #aaa;
        }

        .page-number:before {
            content: "Page " counter(page);
        }
    </style>
</head>

<body>






    <h4 align="center"> Recommended List for {{ $department->name }}
        {{ config('services.admission.academic_session') }}
    </h4>

    <table id="customers">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Full Name</th>
            <th scope="col">Matric Number</th>
            <th scope="col">Programme</th>
            <th scope="col">Department</th>
            <th scope="col">Cgpa</th>
            <th scope="col">Course(s) Failed</th>
            <th scope="col">Year</th>
            <th scope="col">Remark</th>
            <th scope="col">Comment</th>


        </tr>
        <tbody>

            @foreach ($recommendedApplicants as $index => $applicant)
                <tr>
                    <td style="width: 3%">{{ $index + 1 }}</td>
                    <td style="width: 10%">
                        {{ $applicant->surname . ' ' . $applicant->firstname . ' ' . $applicant->m_name }}</td>
                   <td style="width: 10%">{{ strtoupper($applicant->matric_no)}}</td>
                   <td>{{$applicant->program->name}}</td>
                   <td>{{$applicant->department->name}}</td>
                   <td style="width: 5%">{{$applicant->cgpa}}</td>
                   <td style="width: 3%">{{$applicant->no_of_course}}</td>
                   <td>{{$applicant->year_failed_exam}}</td>
                        <td style="width: 10%">{{ $applicant->remark }}</td>
                    <td style="width: 10%">{{ $applicant->comment }}</td>




                </tr>
            @endforeach


        </tbody>



    </table>
    <script type="text/php">
        if (isset($pdf)) {
            $text = "page {PAGE_NUM} / {PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
<h5>HOD Sign:...............</h5>

</html>
