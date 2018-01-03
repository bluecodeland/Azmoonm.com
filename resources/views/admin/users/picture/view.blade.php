@extends('layouts.dashboard')

@section('title', 'ذخیره عکس')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default picture-upload">
        <div class="panel-heading">ذخیره عکس</div>
        <div class="panel-body">

  <form id="form-photo" action="{{ URL::to('admin/users/picture/save') }}" method="POST" class="" enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- picture -->
        <div class="col-sm-offset-3 col-sm-6">
          <div class="col-sm-12">

            <div class="panel panel-default">
              <div class="panel-body">
                <img id='sample_picture'>
              </div>
              <div class="panel-footer">
                <div id='controls' class='hidden'>
                  <a href='#' id='rotate_left'  title='Rotate left'><i class='fa fa-rotate-left'></i></a>
                  <a href='#' id='zoom_out'     title='Zoom out'><i class='fa fa-search-minus'></i></a>
                  <a href='#' id='fit'          title='Fit image'><i class='fa fa-arrows-alt'></i></a>
                  <a href='#' id='zoom_in'      title='Zoom in'><i class='fa fa-search-plus'></i></a>
                  <a href='#' id='rotate_right' title='Rotate right'><i class='fa fa-rotate-right'></i></a>
                  <input type="hidden" name="filename" id="filename" value="{{ $user->picture }}">
                  <input type="hidden" name="imageData" id="imageData">
                </div>
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-save "></i> ذخیره عکس
                </button>
              </div>
            </div>

            <script>
              jQuery(function() {
                var picture = $('#sample_picture')

                var camelize = function() {
                  var regex = /[\W_]+(.)/g
                  var replacer = function (match, submatch) { return submatch.toUpperCase() }
                  return function (str) { return str.replace(regex, replacer) }
                }()

                var showData = function (data) {
                  data.scale = parseFloat(data.scale.toFixed(4))
                  for(var k in data) { $('#'+k).html(data[k]) }
                }

                picture.on('load', function() {
                  picture.guillotine({ eventOnChange: 'guillotinechange', width: 300, height: 400 })
                  picture.guillotine('fit')

                  // Show controls and data
                  $('.loading').remove()
                  $('.notice, #controls, #data').removeClass('hidden')
                  showData( picture.guillotine('getData') )

                  document.getElementById('imageData').value = JSON.stringify(picture.guillotine('getData'),true)

                  // Bind actions
                  $('#controls a').click(function(e) {
                    e.preventDefault()
                    action = camelize(this.id)
                    picture.guillotine(action)
                  })

                  // Update data on change
                  picture.on('guillotinechange', function(e, data, action) { 
                    showData(data) 
                    document.getElementById('imageData').value = JSON.stringify(picture.guillotine('getData'),true)
                  })
                  
                })

                // Display random picture
                picture.attr('src', '/uploads/photo/{{ $user->picture }}')

              })

            </script>

          </div>
        </div>
  </form>


        </div>
      </div>
    </div>
  </div>
</div>
@endsection
