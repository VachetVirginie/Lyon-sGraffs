<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    @yield('css')
        <link href="{{ asset('css/carroussel.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
    <title>Lyon's Street Graff</title>
</head>
<body>
    @extends('layouts.app')
    <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
  <!-- Overlay -->
  <div class="overlay"></div>

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#bs-carousel" data-slide-to="1"></li>
    <li data-target="#bs-carousel" data-slide-to="2"></li>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>
      <div class="hero">
        <hgroup>
            <h1>Lyon's Street Graff</h1>        
            <h3>Le Street Art pour tous, partout.</h3>
        </hgroup>
        
      </div>
    </div>
    <div class="item slides">
      <div class="slide-2"></div>
      <div class="hero">        
        <hgroup>
            <h1>Découvrez</h1>        
            <h3>Une carte pour trouver toutes les oeuvres autour de vous</h3>
        </hgroup>       
        
      </div>
    </div>
    <div class="item slides">
      <div class="slide-3"></div>
      <div class="hero">        
        <hgroup>
            <h1>Partagez</h1>        
            <h3>Une oeuvre vous plaît, partagez sa localisation </h3>
        </hgroup>
        
      </div>
    </div>
  </div> 
</div>
@section('content')

    <main class="container-fluid">
       
        @isset($user)
            <h2 class="text-title mb-3">{{ __('Photos de ') . $user->name }}</h2>
        @endif
        <div class="card-columns">
            @foreach($images as $image)
                <div class="card">
                    <a href="{{ asset('images/' . $image->name) }}" class="image-link"><img class="card-img-top" src="{{ asset('thumbs/' . $image->name) }}" alt="image"></a>
                    @isset($image->description)
                        <div class="card-body">
                            <p class="card-text">{{ $image->description }}</p>
                        </div>
                    @endisset
                    <div class="card-footer text-muted">
                        <small><em>
                                    <a href="{{ route('user', $image->user->id) }}" data-toggle="tooltip" title="{{ __('Voir les photos de ') . $image->user->name }}">{{ $image->user->name }}</a>
                            </em></small>
                        <small class="pull-right">
                            <em>
                            {{ $image->created_at->formatLocalized('%x') }}
                                @adminOrOwner($image->user_id)
                                
                            

                                <a class="category-edit" id="{{$image->category_id}}" href="{{ route('image.update', ['id' => $image->id] ) }}" data-toggle="tooltip" title="@lang('Changer de catégorie')"><i class="fa fa-edit"></i></a>
                                <div class="modal fade" id="changeCategory" tabindex="-1" role="dialog" aria-labelledby="categoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryLabel">@lang('Changement de la catégorie')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   
                        <div class="form-group">
                            <select class="form-control" name="category_id">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('Envoyer')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a class="form-delete" href="{{ route('image.destroy', $image->id) }}" data-toggle="tooltip" title="@lang('Supprimer cette photo')"><i class="fa fa-trash"></i></a>
                                
                                <form action="{{ route('image.destroy', $image->id) }}" method="POST" class="hide">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                @endadminOrOwner
                            </em>
                        </small>
                    </div>
                </div>
            @endforeach
        </div>

        

        <div class="d-flex justify-content-center">
            {{ $images->links() }}
        </div>
    </main>
    
@endsection

@section('script')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()

            $('.card-columns').magnificPopup({
                delegate: 'a.image-link',
                type: 'image',
                gallery: { enabled: true }
            });

            $('a.form-delete').click(function(e) {
                e.preventDefault();
                let href = $(this).attr('href')
                $("form[action='" + href + "'").submit()
            })
        })
        $('.category-edit').click(function (e) {
        e.preventDefault()
        $('#changeCategory').modal('show')
    })
    $('.category-edit').click(function (e) {
        e.preventDefault()
        $('select').val($(this).attr('id'))
        $('#changeCategory').modal('show')
    })
    $('a.category-edit').click(function (e) {
        e.preventDefault()
        $('select').val($(this).attr('id'))
        console.log("$(this).next().attr('href')", $(this).attr('href'));
        $('form').attr('action', $(this).attr('href'))
        $('#changeCategory').modal('show')
    })
    </script>
  
@endsection

</body>
</html>


