@extends('welcome')

@section('content')
<div class="col-md-12">
    <div class="col-md-6 offset-3">
        <p>Your IP address is: {{ $ip }}</p>
    </div>
    <div class="col-md-6 float-left">
        Contact Book
    </div>
    <div class="col-md-6 float-right">
        <!-- Button trigger modal -->
{{-- 
<a href="{{ route('contact.create') }}">
    <button type="button" class="btn btn-success mb-5"><i class="fas fa-plus"></i> Add New Contact</button> --}}

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-plus"></i> Add New Contact
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name here...">
                        <br>
                        <input type="text" class="form-control" id="phone" name="phoneNo" placeholder="Enter phone number here">
                        <br>
                        <button class="btn btn-warning" type="submit" id="save">Save Contact</button> 
                        <br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
    <br>
    <br>
<div class="table mt-5">
    <table id="table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Sl.</th>
                <th scope="col">Name</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $data)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $data->name }}</td>
                <td>{{ $data->phoneNo }}</td>
                <td class="pl-5 d-flex justify-content-center">
                    <div class="row">
                        <button class="btn btn-warning mr-3"  data-toggle="modal" data-target="#exampleModal{{$loop->index+1}}"><i class="fas fa-pencil-alt"></i></button>
                        {{ Form::open(['url' => '/contact/'.$data->id, 'method'=>'DELETE']) }}
                        {{ Form::button('', array('class' => 'btn btn-danger btn-xs bold uppercase fas fa-trash-alt', 'type' => 'submit')) }}
                        {{ Form::close() }}
                    </div>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="exampleModal{{$loop->index+1}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit the contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name here...">
                                <br>
                                <input type="text" class="form-control" id="phone" name="phoneNo" placeholder="Enter phone number here">
                                <br>
                                <button class="btn btn-warning" type="submit" id="edtsave">Save Contact</button>
                                <br>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Sl.</th>
                <th scope="col">Name</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Actions</th>
            </tr>
        </tfoot>
    </table>




</div>
</div>
@section('customScript')
    <script>
        $(document).ready(function () {

            {{--var table = $("#table").DataTable({--}}
            {{--    processing : true,--}}
            {{--    serverSide : true,--}}
            {{--    ajax       : "{{ route('contact.index') }}",--}}
            {{--    columns: [--}}
            {{--        {data: 'id', name: 'id'},--}}
            {{--        {data: 'name', name: 'name'},--}}
            {{--        {data: 'phone', name: 'phoneNo'},--}}
            {{--    ]--}}
            {{--});--}}
            {{--var SITEURL = '{{URL::to('')}}';--}}
            {{--$('#laravel_datatable').DataTable({--}}
            {{--    processing: true,--}}
            {{--    serverSide: true,--}}
            {{--    ajax: {--}}
            {{--        url: SITEURL + "ajax-crud-list",--}}
            {{--        type: 'GET',--}}
            {{--    },--}}
            {{--    columns: [--}}
            {{--        // { data: 'id', name: 'name' },--}}
            {{--        { data: 'id', name: 'id', orderable: false,searchable: false },--}}
            {{--        { data: 'name', name: 'name' },--}}
            {{--        { data: 'phoneNo', name: 'phoneNo' },--}}
            {{--    ],--}}
            {{--    order: [[0, 'desc']]--}}
            {{--});--}}

            $(document).on('click', '#save', function (e) {
                e.preventDefault();

                var name = $('#name').val();
                var phone = $('#phone').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ url('contact') }}',
                    type: 'POST',
                    dataType: 'json',
                    data:  {'name' : name, 'phone' : phone},
                })
                .done(function() {
                    // table.ajax.reload();
                    $('#exampleModal').modal('hide');
                    location.reload();
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            });


        });
    </script>
@endsection
@endsection