@extends('backend.layouts.app')
@section('site-title')
    {{__('Blog Page')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 blog-line-after">
                                            <a class="" href="{{ route('admin.blog.index') }}"> All ({{ $counts['total'] ?? 0 }})</a>
                                            <a class="" href="{{ route('admin.blog.publish') }}"> Publish ({{ $counts['publish'] ?? 0 }})</a>
                                            <a class="" href="{{ route('admin.blog.draft') }}"> Daraft ({{ $counts['draft'] ?? 0 }})</a>
                                            <a class="" href="{{ route('admin.blog.trashed') }}"> Trash  ({{ $counts['trashed'] ?? 0 }}) </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <select class="form-select" name="bulk_option" id="bulk_option">
                                                <option value="">{{__('Bulk Action')}}</option>
                                                <option value="delete">{{__('Delete')}}</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="{{ route('admin.blog.draft') }}" method="GET" onchange="this.submit()">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <select name="blog_category_id" class="form-control">
                                                        <option value="all">{{ __('All') }}</option>
                                                        @foreach (get_blog_category_all() as $category)
                                                            <option value="{{ $category->id }}" @selected($categoryId == $category->id)>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <select name="blog_tag_id" class="form-control">
                                                        <option value="all">{{ __('All') }}</option>
                                                        @foreach (get_blog_tag_all() as $tag)
                                                            <option value="{{ $tag->id }}" @selected($tagId == $tag->id)>
                                                                {{ $tag->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($all_blog as $key => $blog)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{ $key }}" role="tab" aria-controls="home" aria-selected="true">{{ get_language_by_slug($key) }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            @foreach($all_blog as $key => $blog)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slider_tab_{{ $key }}" role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default align-middle" id="draft_table">
                                        <thead >
                                            <th class="no-sort">
                                                <div class="mark-all-checkbox">
                                                    <input type="checkbox" class="all-checkbox">
                                                </div>
                                            </th>
                                            <th >{{__('Title')}}</th>
                                            <th class="no-sort">{{__('Image')}}</th>
                                            <th >{{__('Author')}}</th>
                                            <th >{{__('Category')}}</th>
                                            <th class="no-sort">{{__('Tags')}}</th>
                                            <th class="no-sort">{{__('Status')}}</th>
                                            <th >{{__('Date')}}</th>
                                            <th class="no-sort">{{__('Action')}}</th>
                                        </thead>
                                        <tbody >
                                            @foreach($blog as $data)
                                            <tr >
                                                <td >
                                                    <div class="bulk-checkbox-wrapper">
                                                        <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{ $data->id }}">
                                                    </div>
                                                </td>
                                                <td >
                                                    <a href="{{ route('admin.blog.edit', $data->id) }}">{{ $data->title }}</a>
                                                    @if(!empty($data->breaking_news === 1))<small class="breaking-news">{{__('Breaking News')}}</small>@endif
                                                    @if(!empty($data->video_url))<small class="video">{{__('Video')}}</small>@endif
                                                </td>
                                                <td >
                                                    <div class="photo-container">
                                                        <a href="{{ asset($data->BlogImageUrl) }}" class="magnific">
                                                            <img src="{{ asset($data->BlogImageUrl) }}" alt="{{ $data->name }}">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td >{{ $data->author ?? $data->admin->name }}</td>

                                                <td >
                                                    @foreach ($data->categories as $item)
                                                        <a href="{{ route('admin.blog.category.filter', $item->id) }}">{{ $item->name }}</a>
                                                    @endforeach
                                                </td>
                                                <td >
                                                    @forelse ($data->tags as $tag)
                                                        <a href="{{ route('admin.blog.tag.filter', $tag->id) }}">{{ $tag->name }}</a>
                                                    @empty
                                                        --
                                                    @endforelse
                                                </td>
                                                <td >
                                                    @if($data->status == 'draft')
                                                    <span class="alert alert-warning" style="margin-top: 20px;display: inline-block;">{{__('Draft')}}</span>
                                                    @else
                                                    <span class="alert alert-success" style="margin-top: 20px;display: inline-block;">{{__('Publish')}}</span>
                                                    @endif
                                                </td>
                                                <td >{{ date_format($data->created_at,'d M Y') }}</td>
                                                <td >
                                                    <div class="d-flex">
                                                        @include('backend.partials.delete-with-swal', ['url' => route('admin.blog.destroy', $data->id)])
                                                        <a class="btn btn-primary btn-sm me-1" href="{{ route('admin.blog.edit', $data->id) }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                        <form action="{{ route('admin.blog.clone', $data->id) }}" method="post" style="display: inline-block">
                                                            @csrf
                                                            <button type="submit" title="{{__('Clone this to new draft')}}" class="btn btn-secondary btn-sm me-1"><i class="ri-file-copy-line"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script >
        $(document).ready(function() {
            $(document).on('click', '#bulk_delete_btn', function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox = $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function (index, value) {
                    allIds.push($(this).val());
                });
                if (allIds.length > 0 && bulkOption == 'delete') {
                    $(this).text('{{__('Deleting...')}}');

                    axios.delete(route('admin.blog.bulk.action'), {
                        data: {
                            ids: allIds,
                            _token: "{{csrf_token()}}",
                        }
                    })
                    .then(function (response) {
                        location.reload();
                    })
                    .catch(function (error) {
                        console.error('Error:', error.response.data.message);
                    });
                }
            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });

            $('.table-wrap > table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }],

            } );
        } );
    </script>
@endpush
