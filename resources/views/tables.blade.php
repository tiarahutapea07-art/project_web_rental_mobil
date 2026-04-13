@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tables</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Rizki Nur Islami</td>
                        <td>Developer</td>
                        <td>Jakarta</td>
                        <td>22</td>
                        <td>2024/01/15</td>
                        <td>$5,000,000</td>
                    </tr>
                    <tr>
                        <td>Aqil Al Adli</td>
                        <td>UI/UX Designer</td>
                        <td>Bandung</td>
                        <td>23</td>
                        <td>2024/02/10</td>
                        <td>$4,500,000</td>
                    </tr>
                    <tr>
                        <td>Flora Rizky Abelia</td>
                        <td>Project Manager</td>
                        <td>Surabaya</td>
                        <td>24</td>
                        <td>2024/03/05</td>
                        <td>$6,000,000</td>
                    </tr>
                    <tr>
                        <td>Tiara Irawati Hutapea</td>
                        <td>QA Tester</td>
                        <td>Yogyakarta</td>
                        <td>21</td>
                        <td>2024/01/20</td>
                        <td>$4,000,000</td>
                    </tr>
                    <tr>
                        <td>Nova Eliza Oktaria</td>
                        <td>Backend Developer</td>
                        <td>Medan</td>
                        <td>23</td>
                        <td>2024/02/18</td>
                        <td>$5,500,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="{{ asset('sbadmin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('sbadmin2/js/demo/datatables-demo.js') }}"></script>
@endsection
