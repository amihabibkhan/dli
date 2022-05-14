@extends('layouts.admin_layout')

@section('page_title')
    Coupon
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">All Coupon List</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new">
                                Add New
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add a New Coupon</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('coupons.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Offer Title</label>
                                                    <input type="text" class="form-control" name="title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Coupon Code </label>
                                                    <input type="text" class="form-control" name="code">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Offer (percentage)</label>
                                                    <input type="number" class="form-control" name="percentage">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Coupon for</label>
                                                    <select name="course_id" class="form-control" >
                                                        <option disabled selected>Select Course</option>
                                                        @foreach($courses as $single_courses)
                                                            <option value="{{ $single_courses->id }}">{{ $single_courses->title }}</option>
                                                        @endforeach
                                                        <option value="all">For All Course</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Expiry Date </label>
                                                    <input type="date" class="form-control" name="expire">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Offer Title</th>
                            <th>Coupon Code</th>
                            <th>Offer</th>
                            <th>Coupon For</th>
                            <th>Expiry Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @forelse($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->title }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->percentage }}%</td>
                                <td>
                                    @if($coupon->course_id == 'all')
                                        For All Course
                                    @else
                                        {{ $coupon->course->title }}
                                    @endif
                                </td>
                                <td>{{ date_maker($coupon->expire, 'd M, Y') }} </td>
                                <td class="text-center" style="white-space: nowrap">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-secondary mr-2" data-toggle="modal" data-target="#edit{{ $coupon->id }}">
                                        Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edit{{ $coupon->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Coupon</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('coupons.update', $coupon->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Offer Title</label>
                                                            <input type="text" value="{{ $coupon->title }}" class="form-control" name="title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Coupon Code </label>
                                                            <input type="text" value="{{ $coupon->code }}" class="form-control" name="code">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Offer (percentage)</label>
                                                            <input type="number" value="{{ $coupon->percentage }}" class="form-control" name="percentage">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Coupon for</label>
                                                            <select name="course_id" class="form-control" >
                                                                <option disabled selected>Select Course</option>
                                                                @foreach($courses as $single_courses)
                                                                    <option {{ $coupon->course_id == $single_courses->id ? 'selected' : '' }} value="{{ $single_courses->id }}">{{ $single_courses->title }}</option>
                                                                @endforeach
                                                                <option {{ $coupon->course_id == 'all' ? 'selected' : '' }} value="all">For All Course</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Expiry Date </label>
                                                            <input type="date" value="{{ $coupon->expire }}" class="form-control" name="expire">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Coupon</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- delete button  -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $coupon->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $coupon->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Coupon</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                    <div class="modal-body text-center">
                                                        <h5>Are you sure to delete?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success mr-2" data-dismiss="modal">Cancel</button>

                                                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Coupon Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
