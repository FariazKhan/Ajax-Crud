@extends('welcome')

@section('content')
<div class="col-md-12">
    <div class="col-md-6 float-left">
        Contact Book
    </div>
    <div class="col-md-6 float-right">
        <!-- Button trigger modal -->
        <a href="{{ route('contact.create') }}"><button type="button" class="btn btn-success mb-5"><i class="fas fa-plus"></i> Add New Contact</button></a>
    </div>

    <div class="table">
        <table class="table table-hover">
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
                    <td>
                        <button class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection