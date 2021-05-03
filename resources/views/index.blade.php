<?php
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedular</title>

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
</head>
<body>
  <div class="container">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success !</h5>
                <p>{{ $message }}</p>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Alert! There were some problems with your input.</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

    <section class="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Add New Board Member
                </h1>
            </div>

            <div class="card-body">
             <row>
              <form class="needs-validation" action="{{ route('new-client') }}" method="POST" novalidate="">
                @csrf
                <div class="form-row">
                  <div class="col-md-3 mb-3">
                    <label for="name"> Client Name </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required="">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="email"> Client Email </label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="" value="" required="">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="domain"> Domain Name </label>
                    <input type="text" class="form-control" id="domain" name="domain" placeholder="" value="" required="">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="dom-link"> Domain Link </label>
                    <input type="text" class="form-control" id="dom-link" name="url" placeholder="" value="" required="">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="start"> Domain Publish Date  </label>
                    <input type="date" class="form-control" id="start" name="start_date" placeholder="" value="" required="">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="end"> Domain Expiary Date</label> <br>
                    <input type="date" class="form-control" id="end" name="end_date"  placeholder="" value="" required="">
                  </div>
                  <div class="col-md-4">
                    <label for="end"></label> <br>
                    <button class="btn btn-primary" name="btn-addteam" type="submit">Create New Client</button>
                  </div>
                </div>
              </form>
            </row>
          </div>
        </div>
    </section>
<hr>
    <section class="content">
        <div class="container-fluid">
            <h2>All Users</h2>
              <table id="example" class="table table-striped table-bordered" style="width:90%; margin: 0px auto;">
                  <thead>
                      <tr>
                          <th>Member ID</th>
                          <th>Client Name</th>
                          <th>Client Email</th>
                          <th>Domain Name</th>
                          <th>Domain Url</th>
                          <th>Start Date</th>
                          <th>Expiary Date</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($data as $info)
                        @php
                                $today_date = Carbon::now();
                                $data_difference = $today_date->diffInDays($info->end_date, false);
                        @endphp
                                    @if($data_difference > 7)
                                        <tr>
                                            <td>{{ $info->id }}</td>
                                            <td>{{ $info->client_name }}</td>
                                            <td>{{ $info->client_email }}</td>
                                            <td>{{ $info->domain }}</td>
                                            <td>{{ $info->domain_url }}</td>
                                            <td>{{ $info->start_date }}</td>
                                            <td>{{ $info->end_date }}</td>
                                        </tr>
                                        @elseif($data_difference < 0)
                                            <tr style="color: red;">
                                                <td>{{ $info->id }}</td>
                                                <td>{{ $info->client_name }}</td>
                                                <td>{{ $info->client_email }}</td>
                                                <td>{{ $info->domain }}</td>
                                                <td>{{ $info->domain_url }}</td>
                                                <td>{{ $info->start_date }}</td>
                                                <td>{{ $info->end_date }}</td>
                                            </tr>
                                        @else
                                            <tr style="color: blue;">
                                                <td>{{ $info->id }}</td>
                                                <td>{{ $info->client_name }}</td>
                                                <td>{{ $info->client_email }}</td>
                                                <td>{{ $info->domain }}</td>
                                                <td>{{ $info->domain_url }}</td>
                                                <td>{{ $info->start_date }}</td>
                                                <td>{{ $info->end_date }}</td>
                                            </tr>
                                        @endif
                      @endforeach
                  </tbody>
              </table>
          </div>
      </section>
    </div>
</body>
</html>
