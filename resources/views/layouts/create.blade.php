@extends('welcome')

@section('content')
<div class="col-md-12">
    <div class="col-md-6 text-center" style="margin-left: 24%;">
        Add New Contact
    </div>
    <br>

    <div class="row" style="margin-left: 40%;">
    	<form action="{{ route('contact.store') }}" method="POST">
	    	@csrf
	    	<input type="text" class="form-control" name="name" placeholder="Enter name here...">
	    	<br>
	    	<input type="text" class="form-control" name="phoneNo" placeholder="Enter phone number here">
	    	<br>
	    	<button class="btn btn-warning" type="submit">Save Contact</button>	
    		<br>
    	</form>
    </div>
</div>
@endsection