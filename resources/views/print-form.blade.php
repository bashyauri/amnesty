<!DOCTYPE html>
<html lang="en">

<head>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/form-wizard.css" rel="stylesheet" />
    <style type="text/css">
        body {
            /*padding: 2% 1% 2% 1%;
  color: #111111;
    background-image:url(image/bg2.jpg);
    background-repeat:repeat;
         width: 210mm;
         height: 297mm;*/
            margin-left: auto;
            margin-right: auto;
            padding: 0px;
            ;
            color: #111111;
            background-image: url(image/bg2.jpg);
            background-repeat: repeat;
        }
    </style>
</head>

<body>
    <div class="main">

        <div class="top-container container-fluid border-bottom border-dark row">
            <div class="log0-container col-2 border-right border-dark text-center mb-3 mt-3">
                <img src="{{ asset('assets/img/logos/logo.jpg') }}" alt="logo-image" height="100px" />
            </div>

            <div class="top-container-title col-8 text-center">
                <h5 class="mb-4 font-weight-bolder">WAZIRI UMARU FEDERAL POLYTECHNIC, BIRNIN KEBBI</h5>
                <h5 class="mb-4 font-weight-bold">AMNESTY ADMISSION FORM</h5>
                <h6 class="font-weight-bold">2023/2024 ACADEMIC SESSION </h6>
            </div>

            <div class="log0-container col-2 border-left border-dark text-center mb-3 p-3">

                {!! QrCode::size(100)->generate($fullName . ' Remita:' . $rrr) !!}

            </div>
        </div>

        <div class="row" style="margin:0% 3% 0% 3%; width:95%">
            <div class="span12">
                <div class="row">
                    <div class="span6" style="">
                        <table class="table table-condensed">
                            <tr>
                                <td>
                                    <p class="h6">
                                        If your application is successful you will be <br>invited to present the
                                        original copies of all your credentials for screening on a specified date:
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>
                                    <h2 style="color:red;">Note!!!</h2>
                                    Any discrepancy between your online form and the original credentials will
                                    disqualify you. THANKS!!!.
                                    </p>
                                </td>
                            </tr>

                        </table>

                    </div>
                    <div class="span12" style="">

                        <table width="504" class="table table-condensed">
                            <tbody>
                                <tr>
                                    <th>Application Number</th>

                                </tr>
                                <tr>
                                    <td><Strong>{{ $accountId }}</Strong></td>
                                </tr>
                                <tr>
                                    <th>Remita Number</th>
                                </tr>
                                <tr>
                                    <td><Strong>{{ $rrr }}</Strong></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="row-fluid" style="padding-right:4px">
                    <div>
                        <table class="table table-condensed">
                            <h4><Strong>SECTION A: PERSONAL DETAILS</Strong></h4>
                            <tbody>
                                <tr>
                                    <th>Name in Full: </th>
                                    <td style="width:15%;">{{ $fullName }}</td>
                                    <th style="width:20%;">Matric No:</th>
                                    <td>{{ $matricNo }}</td>
                                    <th style="width:20%;">Gender:</th>
                                    <td>{{ $gender }}</td>

                                </tr>
                                <tr>
                                    <th style="width:20%;">Phone:</th>
                                    <td>{{ auth()->user()->p_number }}</td>
                                    <th style="width:20%;">Email:</th>
                                    <td>{{ auth()->user()->email }}</td>

                                </tr>


                                <tr>
                                    <th colspan="2">Courses Failed:</th>
                                    <td colspan="4">{{ $coursesFailed }}</td>

                                </tr>
                                <tr>
                                    <th colspan="2">CGPA:</th>
                                    <td colspan="4">{{ $cgpa }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Year:</th>
                                    <td colspan="4">{{ $yearFailed }}</td>
                                </tr>

                                <tr>
                                    <th colspan="2" style="color:red;">PROGRAMME APPLIED FOR:</th>


                                    <td colspan="4" style="color:red;">{{ $programName}}</td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="color:red;">DEPARTMENT:</th>


                                    <td colspan="4" style="color:red;">{{ $departmentName}}</td>
                                </tr>
                            </tbody>
                            <table>
                                <hr />
                    </div>
                </div>






                        </table>


                    </div>
                </div>

            </div>
        </div>


        <!-- /Content -->
    </div>


    <!-- /container -->

</body>
<script>
    window.print();
</script>

</html>
