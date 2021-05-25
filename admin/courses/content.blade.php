@extends('layouts.admin')
@section('title', __('Show Course'))
@section('content')
<div class="row mt-4">
  <div class="col-lg-12">
    <div class="">
      <h2>{{ $course->title }}</h2>
    </div>
  </div>
</div>
<div class="row mt-4 justify-content-md-center">
  <div class="col-lg-6">
    <div class="c-content">
      <div class="section-container">
        @foreach($course->sections as $section)
        <section class="section">
          <div class="action-section">
            <a href="#" data-toggle="modal" data-target="#addsection" id="{{$section->id}}"
              data-name="{{$section->name}}" class="edit-section"><i class="far fa-edit"></i></a>
            <a href="#" id="{{$section->id}}" data-url="{{ route('admin.sections.delete', [$section->id])}}"
              class="delete-section"><i class="fas fa-times"></i></a>
          </div>
          <div class="section-title">
            <h4> {{$section->name}} </h4>
          </div>
          <div class="all-lectures-{{$section->id}}">
            @foreach($section->lectures as $lecture)
            <div class="lecture" id="{{$lecture->id}}">
              <div class="lecture-title-{{$lecture->id}}">
                {{$lecture->name}}
                <div class="action-lecture">
                  @if($lecture->type == 'exam')
                  <a href="#" data-toggle="modal" data-target="#addexam" data-sid="{{$section->id}}"
                    data-lid="{{$lecture->id}}" data-name="{{$lecture->name}}" class="edit-exam-modal"><i
                      class="far fa-edit"></i></a>
                  @else
                  <a href="#" data-toggle="modal" data-target="#addlecture" data-sid="{{$section->id}}"
                    data-lid="{{$lecture->id}}" data-name="{{$lecture->name}}" class="edit-lecture-modal"><i
                      class="far fa-edit"></i></a>
                  @endif
                  <a href="#" id="{{$lecture->id}}" data-url="{{ route('admin.lectures.delete', [$lecture->id])}}"
                    class="delete-lecture"><i class="fas fa-times"></i></a>
                </div>
              </div>
              <div class="lecture-resourse-{{$lecture->id}} lecture-items mt-3">
                <div class="video-{{$lecture->id}} float-left float-left-rtl">
                  @if($lecture->type == 'exam')
                  <a href="{{ route('admin.exam.questions', [$course->id , $section->id,$lecture->id])}}">
                    {{__('Add Questions')}} </a>
                  @else
                  <a href="#"> {{$lecture->video}} </a>
                  @endif
                </div>
                <div class="file float-right float-right-rtl">
                  <a href="#">{{$lecture->file}} </a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="add-lecture">
            <a href="#" data-toggle="modal" data-target="#addlecture" data-sid="{{$section->id}}"
              class="add-lecture-modal"><i class="fas fa-plus"></i>{{__('Lecture')}} </a>
            <a href="#" data-toggle="modal" data-target="#addexam" data-sid="{{$section->id}}" class="add-exam-modal"><i
                class="fas fa-plus"></i>{{__('Exam')}} </a>
              
          </div>
          
        </section>
        @endforeach
      </div>

        <a href="#" id="{{ $course->id }}" data-toggle="modal" data-target="#addsection" class="add-section-modal"><i
            class="fas fa-plus"></i> {{__('Section')}} </a>

    </div>
  </div>
</div>

<!-- Modal for add section-->
<div class="modal fade" id="addsection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title save" id="exampleModalLabel">{{__('Add New Section')}} </h5>
        <h5 class="modal-title edit" id="exampleModalLabel">{{__('Update Section')}} </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">{{__('Name')}} </label>
          <div class="col-sm-10">
            <input type="text" class="form-control section-name" name="name" value="" placeholder="Enter section name ">
            <input type="hidden" class="course_id" id="course_id" value="{{ $course->id }}">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}} </button>
        <a data-url="{{ route('admin.sections.store')}}" class="btn btn-primary add-section save"> {{__('Save')}} </a>
        <a data-url="{{ route('admin.sections.update')}}" class="btn btn-primary edit update-section">{{__('Update')}}
        </a>

      </div>

    </div>
  </div>
</div>



<!-- Modal for add lecture-->
<div class="modal fade" id="addlecture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title store-lecture" id="exampleModalLabel">{{__('Add New Lecture')}}</h5>
        <h5 class="modal-title edit-lecture" id="exampleModalLabel">{{__('Update Lecture')}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">{{__('Name')}}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control lecture-name" name="name" value="" placeholder="Enter Lecture name ">
            <input type="hidden" class="course_id" id="course_id" value="{{ $course->id }}">
            <input type="hidden" class="section_id" id="section_id" value="">

          </div>
        </div>
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">{{__('video')}}</label>

          <div class="col-sm-10">
            <input type="file" style="width: 300px" class="custom-file-input form-control video" name="video"
              id="customFile">
            <label style="width: 300px" class="custom-file-label form-control"
              for="customFile">{{__('Choose video')}}</label>
          </div>
          <input type="hidden" name="video64" id="video64" value="">
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
            aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
        <a data-url="{{ route('admin.lectures.store')}}" class="btn btn-primary store-lecture"> {{__('Save')}} </a>
        <a data-url="{{ route('admin.lectures.update')}}" class="btn btn-primary edit-lecture">{{__('Update')}}</a>
      </div>

    </div>
  </div>
</div>

<!-- Modal for add exam-->
<div class="modal fade" id="addexam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title store-exam" id="exampleModalLabel">{{__('Add Exam')}}</h5>
        <h5 class="modal-title edit-exam" id="exampleModalLabel">{{__('Update Exam')}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">{{__('Name')}}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control exam-name" name="name" value="" placeholder="Enter exam name ">
            <input type="hidden" class="course_id" id="course_id" value="{{ $course->id }}">
            <input type="hidden" class="section_id" id="section_id" value="">

          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
        <a data-url="{{ route('admin.exam.store')}}" class="btn btn-primary store-exam"> {{__('Save')}} </a>
        <a data-url="{{ route('admin.exam.update')}}" class="btn btn-primary edit-exam">{{__('Update')}}</a>
      </div>

    </div>
  </div>
</div>


@endsection

@section('js')
<script src="{{ asset('js/course.js') }}"></script>

@endsection