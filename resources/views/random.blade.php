@extends('layouts.app')



@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <h4>Random Anime</h4>
        <div id="anime-details" class="mt-4"></div> <!-- Container to display anime details -->
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'https://api.jikan.moe/v4/random/anime',
            method: 'GET',
            success: function(data) {
                var anime = data.data;
                var $details = $('#anime-details');

                var $content = $('<div></div>').addClass('anime-info');
                var $image = $('<img>').attr('src', anime.images.jpg.image_url).addClass('img-fluid mb-3');
                $content.append($image);
                $content.append('<h2>' + anime.title + '</h2>');
                $content.append('<p><strong>Score:</strong> ' + anime.score + '</p>');
                $content.append('<p><strong>Episodes:</strong> ' + anime.episodes + '</p>');
                $content.append('<p><strong>Status:</strong> ' + anime.status + '</p>');
                $content.append('<p><strong>Synopsis:</strong> ' + anime.synopsis + '</p>');
                $content.append('<p><strong>Genres:</strong> ' + anime.genres.map(genre => genre.name).join(', ') + '</p>');
                $content.append('<p><strong>Source:</strong> ' + anime.source + '</p>');
                $content.append('<p><strong>Season:</strong> ' + anime.season + '</p>');
                $content.append('<p><strong>Themes:</strong> ' + anime.themes.map(theme => theme.name).join(', ') + '</p>');
                $content.append('<p><strong>Demographics:</strong> ' + anime.demographics.map(demographic => demographic.name).join(', ') + '</p>');
                $content.append('<p><strong>Producers:</strong> ' + anime.producers.map(producer => producer.name).join(', ') + '</p>');
                $content.append('<p><strong>Licensors:</strong> ' + anime.licensors.map(licensor => licensor.name).join(', ') + '</p>');
                $content.append('<p><strong>Studios:</strong> ' + anime.studios.map(studio => studio.name).join(', ') + '</p>');
                $content.append('<p><strong>Aired:</strong> ' + anime.aired.string + '</p>');
                $content.append('<p><strong>Duration:</strong> ' + anime.duration + '</p>');
                $content.append('<p><strong>Rating:</strong> ' + anime.rating + '</p>');
                $content.append('<p><strong>Background:</strong> ' + anime.background + '</p>');
                $content.append('<p><strong>Type:</strong> ' + anime.type + '</p>');
                $content.append('<p><strong>Trailer:</strong> <a href="' + anime.trailer_url + '" target="_blank">Watch Trailer</a></p>');
               $content.append('<p><strong>Rank:</strong> ' + anime.rank + '</p>');
                $content.append('<p><strong>Popularity:</strong> ' + anime.popularity + '</p>');
                $content.append('<p><strong>Members:</strong> ' + anime.members + '</p>');
                $content.append('<p><strong>Favorites:</strong> ' + anime.favorites + '</p>');
                $details.append($content);
            },
            error: function(error) {
                console.error('Error fetching random anime:', error);
            }
        });
    });
</script>
@endsection
