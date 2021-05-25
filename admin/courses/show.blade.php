@extends('layouts.admin')
@section('title', __('Show Course'))
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>


    <div class="row mt-4">
        <div class="col-lg-8 course-content">
            <div class="titles">
                <h2>{{ $course->title }}</h2>
                <h3> {{ $course->sub_title }} </h3>
            </div>
            
            <div class="description">
                <h4> {{__('Description')}} </h4>
                <p class="more">{!! $course->description !!}</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div>
                <div class="course-img">
                    <img height="300" src="{{ asset('images/' . $course->image) }}">
                </div>
                <div class="course-sidbar">
                    <div class="course-info">
                        <div>
                            <i class="fas fa-shopping-bag"></i> <span> {{__('Price')}}: {{ $course->price }} $</span>
                        </div>
                        <div>
                            <i class="fas fa-comment"></i><span> {{__('Language')}}: {{ $course->languge }}</span>
                        </div>
                        <div>
                            <i class="fas fa-rocket"></i><span> {{__('Status')}}: {{ $course->status }}</span>
                        </div>
                        <div>
                            <i class="fas fa-edit"></i><span> {{__('Last updated')}}: {{ $course->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="action">
                        <a href="#" data-url="{{ route('admin.courses.destroy', [$course->id])}}" class="btn btn-danger delete-course">
                            <i class="fas fa-trash"></i>
                        </a>
                        <button  type="button" data-toggle="modal" data-target="#editCourse" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="course-video">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{__('Course Content')}}</h4>
                        <div class="ml-auto"><a href="{{ route('admin.lectures.content', [$course->id])}}"><i class="fas fa-plus"></i>  {{__('Add Lectures')}} </a></div>
                    </div>
                    <div class="card-body">
                      {{__('Add new Lectures to this course')}}
                    </div>
                 </div>
                
            </div>
        </div>
    </div>

    <!-- for modal update-->
    <div class="modal fade " id="editCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> {{__('Edit Course')}} </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.courses.update',[$course->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">{{__('Course Title')}} </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $course->title ) }}" id="title" placeholder="Enter title ">
                        </div>
                        @error('title')
                          <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="form-group row">
                      <label for="sub_title" class="col-sm-3 col-form-label">{{__('Sub Title')}} </label>
                      <div class="col-sm-9">
                       <input type="text" class="form-control @error('sub_title') is-invalid @enderror" name="sub_title" value="{{ old('sub_title',$course->sub_title ) }}" id="sub_title" placeholder="Enter sub title">
                      </div>
                       @error('sub_title')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                  </div>
                
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{__('Category')}} </label>
                    <div class="col-sm-9">
                        <select id="category_id" name="category_id" class="custom-select @error('category_id') is-invalid @enderror">
                            <option value="">-- {{__('Select Category')}} --</option>
                
                            @foreach(App\Category::all() as $category)
                            <option @if ($category->id == $course->category_id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                
                        </select>
                   </div> 
                        @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                          @enderror
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{__('Language')}} </label>
                    <div class="col-sm-9">
                          <select id="lang" name="languge" class="custom-select @error('languge') is-invalid @enderror">
                              <option value="">-- {{__('Select language')}} --</option>
                              <option @if (old('languge')=='English' || $course->languge =='English' ) selected @endif value="English">{{__('English')}} </option>
                              <option @if (old('languge')=='Arabic' || $course->languge =='Arabic') selected @endif value="Arabic">{{__('Arabic')}} </option>
                          </select> 
                    </div>
                        @error('languge')
                            <p class="text-danger">{{ $message }}</p>
                          @enderror
                    </div>
                    <div class="form-group row">
                      <label for="price" class="col-sm-3 col-form-label">{{__('Price')}} </label>
                      <div class="col-sm-9">
                         <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $course->price) }}" id="price" placeholder="price">
                      </div>
                     @error('price')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="form-group row">
                      <label for="description" class="col-sm-3 col-form-label">{{__('Description')}} </label>
                      <div class="col-sm-9">
                        <textarea class="form-control" id="description" name="description" @error('description') is-invalid @enderror" rows="5">{{ old('description', $course->description) }}</textarea>
                      </div>
                      @error('description')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>
                
                    <fieldset class="form-group">
                      <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">{{__('Status')}} </legend>
                        <div class="col-sm-9">
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="published" value="published" @if (old('status') == 'published' || $course->status== 'published') checked @endif>
                              <label class="form-check-label" for="published">
                                {{__('Published')}} 
                              </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="draft" value="draft" @if (old('status') == 'draft' || $course->status== 'draft') checked @endif>
                            <label class="form-check-label" for="draft">
                              {{__('Draft')}} 
                            </label>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                      @error('status')
                          <p class="text-danger">{{ $message }}</p>
                        @enderror
                <div class="form-group row">
                    <div class="custom-file col-sm-8 m-3">
                      <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="customFile">
                      <label class="custom-file-label" for="customFile">{{__('Choose image')}} </label>
                    </div>
                    @error('image')
                          <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="col-sm-3">
                        @if ($course->image)
                        <img height="100" id="course-img" width="100" src="{{ asset('images/' . $course->image) }} " alt="">
                        @endif
                    </div>
                    <input type="hidden" name="img64" id="img64" value="">
                </div>     
                  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
              <button type="submit" class="btn btn-primary">{{__('Update')}} </button>
            </form>
            </div>
          </div>
        </div>
      </div>

     <!-- end modal --> 

@endsection


@section('js')
<script src="{{ asset('js/trumbowyg/trumbowyg.min.js') }}"></script>
<script>
  $('#description').trumbowyg();

  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#course-img').attr('src', e.target.result);
      $('#img64').attr('value', e.target.result);

    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#customFile").change(function() {
  readURL(this);
});
</script>
@endsection

@section('css')
<link href="{{ asset('js/trumbowyg/ui/trumbowyg.min.css') }}" rel="stylesheet">
@endsection