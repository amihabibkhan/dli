@extends('layouts.admin_layout')

@section('page_title')
    Course Module
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Modules/Chapters of {{ $course_info->title }}</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new">
                                Add New
                            </button>
                            <a href="{{ route('courses.index') }}" class="btn btn-success">Back</a>

                            <!-- Modal -->
                            <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add a New Module (Chapter)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('modules.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $course_info->id }}" name="course_id">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Module Title </label>
                                                    <input type="text" class="form-control" name="title">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add Module</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @forelse($modules as $module)

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">{{ $module->title }} ({{ count($module->videos) }} {{ count($module->videos) > 1 ? 'Videos' : 'Video' }})</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="javascript:void(0)" data-toggle="dropdown" id="btnGroupDrop{{ $module->id }}" style="font-size: 26px; color: magenta; margin-right: 10px">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" style="background-color: #9fcdff" aria-labelledby="btnGroupDrop{{ $module->id }}">
                                <a class="dropdown-item" data-toggle="modal" data-target="#new_video{{ $module->id }}" href="#">Add Video</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#update_module{{ $module->id }}" href="#">Update Module</a>
                                <form action="{{ route('modules.destroy', $module->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete this Module?')">Delete Module</button>
                                </form>
                            </div>
                            <!-- Modal update module-->
                            <div class="modal fade" id="update_module{{ $module->id }}" tabindex="-1" role="dialog" aria-labelledby="update_module{{ $module->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Module</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('modules.update', $module->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Module Title </label>
                                                    <input type="text" value="{{ $module->title }}" class="form-control" name="title">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Module</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal new video-->
                            <div class="modal fade" id="new_video{{ $module->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add a New Video to {{ $module->title }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('videos.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $module->id }}" name="module_id">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Video Title</label>
                                                    <input type="text" class="form-control" name="title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Video ID</label>
                                                    <input type="text" class="form-control" placeholder="Video ID" name="link">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Video Source</label>
                                                    <select name="type" class="form-control">
                                                        <option value="1">YouTube</option>
                                                        <option value="2">Vimeo</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="pt-3"><input type="checkbox" name="preview"> Set as Preview Video</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add Video</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table mb-0 table-bordered">
                        @forelse($module->videos as $single_video)
                            <tr>
                                <td>{{ $single_video->title }}</td>
                                <td class="text-center"><a href="https://www.youtube.com/watch?v={{ $single_video->link }}" target="_blank">Preview</a></td>
                                <td class="text-center">Source: {{ $single_video->type == 1 ? 'Youtube Video' : 'Vimeo Video' }}</td>
                                <td class="text-center" style="width: 10%; white-space: nowrap">
                                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#update{{ $single_video->id }}">
                                        Update
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" style="white-space: normal" id="update{{ $single_video->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update video information</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('videos.update', $single_video->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Video Title</label>
                                                            <input type="text" value="{{ $single_video->title }}" class="form-control" name="title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Video ID</label>
                                                            <input type="text" class="form-control" value="{{ $single_video->link }}" placeholder="Video ID" name="link">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Video Source</label>
                                                            <select name="type" class="form-control">
                                                                <option {{ $single_video->type == 1 ? 'selected' : '' }} value="1">YouTube</option>
                                                                <option {{ $single_video->type == 2 ? 'selected' : '' }} value="2">Vimeo</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input {{ $single_video->preview == 1 ? 'checked' : '' }} type="checkbox" name="preview">
                                                            <label for="">Set as Preview Video</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Video</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form style="display: inline-block" action="{{ route('videos.destroy', $single_video->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this video?')">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center">No videos found in this module</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            @empty
                <h2 class="text-center">No modules found</h2>
            @endforelse
        </div>
    </div>
@endsection
